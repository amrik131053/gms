<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
class PayuPaymentController extends Controller
{
    public function showConfirmation(Request $request)
    {
        $submit_details = $request->all();
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        if ($DataResponse->failed()) {
            return view('index', [
                'details' => []
                
            ]);
        }
        $resData = $DataResponse->json();
        $details=$resData['data'][0];
        // dd($details);
        return view('payu.confirmation', compact('submit_details','details'));
    }

    public function initiatePayment(Request $request)
    {
         // Generate transaction ID
         $txnid = uniqid('txn_');
         $BaseURL=config('app.baseUrl');
         $token = $request->session()->get('api_token');
         $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
         if ($DataResponse->failed()) {
             return view('index', [
                 'userDetails' => []
                 
             ]);
         }
         $resData = $DataResponse->json();
         $userDetails=$resData['data'][0];
         // Insert payment data into the database
         $payment = new Payment();
         $payment->user_id = $userDetails['IDNo']; // Adjust based on your user management
         $payment->fee_type = $request->fee_type;
         $payment->semester = $request->semester;
         $payment->amount = $request->amount;
         $payment->remarks = $request->remarks;
         $payment->txnid = $txnid;
         $payment->status = 'pending';
         $payment->save();
        // Payment initialization logic (as shown earlier)
        $paymentData = [
            'key' => config('payu.merchant_key'),
            'txnid' => uniqid('txn_'),
            'amount' => $request->amount,
            'productinfo' => $request->fee_type . ' - ' . $request->semester,
            'firstname' => $request->student_name,
            'email' => $request->email,
            'phone' => $request->mobile ?? '1234567890',
            'surl' => route('payu.success'),
            'furl' => route('payu.failure'),
            'service_provider' => 'gku',
        ];
        $hashSequence = config('payu.merchant_key') . "|" . $paymentData['txnid'] . "|" . $paymentData['amount'] . "|"
        . $paymentData['productinfo'] . "|" . $paymentData['firstname'] . "|" . $paymentData['email'] . "|||||||||||"
        . config('payu.merchant_salt');
        
        $paymentData['hash'] = strtolower(hash('sha512', $hashSequence));
        // dd($paymentData['hash']);

         // PayU Payment URL
    $payuUrl = config('payu.base_url');

    // Create a form to redirect to PayU
    return response()->view('payu.payment_redirect', compact('paymentData', 'payuUrl'));
}
public function paymentSuccess(Request $request)
{
    $txnid = $request->txnid;

    // Validate hash
    $hashSequence = $request->key . "|" . $txnid . "|" . $request->amount . "|" 
        . $request->productinfo . "|" . $request->firstname . "|" . $request->email . "|||||||||||"
        . config('payu.merchant_salt');
    $generatedHash = strtolower(hash('sha512', $hashSequence));

    if ($generatedHash !== $request->hash) {
        return response()->json(['error' => 'Invalid transaction'], 400);
    }

    // Update payment status to success
    $payment = Payment::where('txnid', $txnid)->first();
    if ($payment) {
        $payment->status = 'success';
        $payment->updated_at = now();
        $payment->save();
    }

    return view('payu.success', ['payment' => $payment]);
}

public function paymentFailure(Request $request)
{
    $txnid = $request->txnid;

    // Update payment status to failed
    $payment = Payment::where('txnid', $txnid)->first();
    if ($payment) {
        $payment->status = 'failed';
        $payment->updated_at = now();
        $payment->save();
    }

    return view('payu.failure', ['payment' => $payment]);
}
}
