<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
class PayuPaymentController extends Controller
{
    public function showConfirmation(Request $request,$encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://10.0.8.181:89/Student/eachDocRequest/', [
            'requestId' => $id,
        ]);
        $submit_details = $response->json()['data'] ?? null;
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        if ($DataResponse->failed()) {
            return view('index', [
                'details' => []
                
            ]);
        }
        $resData = $DataResponse->json();
        $details=$resData['data'][0];
        // dd($submit_details);
        return view('payu.confirmation', compact('submit_details','details'));
    }
  
    // --------------------------------------------------------------------for mobile --------------------------------------------------------------------------
    public function startPaymentAPI(Request $request)
    {
       
   
        $validated = $request->validate([
            'idno'         => 'required',
            'firstname'    => 'required|string|max:150',
            'email'        => 'required|email|max:150',
            'phone'        => 'required|string|max:20',
            'productinfo'  => 'required|string|max:150',
            'remarks'      => 'nullable|string|max:100',
            'amount'       => 'required|numeric|min:1',
            'requestid'       => 'required|min:1',
        ]);

        $idno=$validated['idno'];
        // $token=$validated['token'];
        $requestid=$validated['requestid'];
       
    
        $apiPayload = [
            'IDNo'       => $idno ?? '',
            'Name'       => $validated['firstname'],
            'Email'      => $validated['email'],
            'MobileNo'   => $validated['phone'],
            'Amount'     => $validated['amount'],
            'documentid' => $requestid,
            'Status'     => 'failure',
            'FeeType'    => $validated['productinfo'],
            'Semester'   => 0,
            'Remarks'    => $validated['remarks'] ?? '',
        ];
    
        // $token = $request->session()->get('api_token');
     
        $apiResponse = Http::withHeaders([
            // 'Authorization' => 'Bearer ' . $token,
        ])->post('http://10.0.8.181:89/student/paymentStart/', $apiPayload);
    
        if (!$apiResponse->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment record.',
                'details' => $apiResponse->body(),
            ], 500);
        }
    
        $responseData = $apiResponse->json();
        $txnid        = $responseData['txnid'] ?? null;
        $amount        = $responseData['amount'] ?? null;
    
        if (!$txnid) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction ID not returned by API.',
                'raw'     => $responseData,
            ], 500);
        }
    
        $MERCHANT_KEY  = env('PAYU_MERCHANT_KEY');
        $MERCHANT_SALT = env('PAYU_MERCHANT_SALT');
        $PAYU_BASE_URL = env('PAYU_BASE_URL', 'https://test.payu.in/_payment');
    
        $posted = [
            'key'         => $MERCHANT_KEY,
            'txnid'       => $txnid,
            'amount'      => $amount,
            'productinfo' => $validated['productinfo'],
            'firstname'   => $validated['firstname'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            // 'surl'        => env('PAYU_SUCCESS_URL'),
            // 'furl'        => env('PAYU_SUCCESS_URL'),
            'udf1'        => '0',
            'udf2'        => $validated['remarks'] ?? '',
            'udf3'        => $idno ?? '',
            'udf4'        => $requestid ?? '',
            'udf5'        => '',
            'udf6'        => '',
            'udf7'        => '',
            'udf8'        => '',
            'udf9'        => '',
            'udf10'       => '',
        ];
        
        $hashSequence = [
            $posted['key'] ?? '',
            $posted['txnid'] ?? '',
            $posted['amount'] ?? '',
            $posted['productinfo'] ?? '',
            $posted['firstname'] ?? '',
            $posted['email'] ?? '',
            $posted['udf1'] ?? '',
            $posted['udf2'] ?? '',
            $posted['udf3'] ?? '',
            $posted['udf4'] ?? '',
            $posted['udf5'] ?? '',
            $posted['udf6'] ?? '',
            $posted['udf7'] ?? '',
            $posted['udf8'] ?? '',
            $posted['udf9'] ?? '',
            $posted['udf10'] ?? '',
            $MERCHANT_SALT
        ];
        
        $hash_string = implode('|', $hashSequence);

        $hashString = strtolower(hash('sha512', $hash_string));
        $posted['hash'] = $hashString;
        // error_log('Hello from PayU!'.$PAYU_BASE_URL);
        // \Log::info('PayU payload:', $posted);
        return response()->json($posted);

        
        
        
    }

    // ------------------------------------------for web mode -----------------------------------------------------------------------
    public function startPayment(Request $request)
    {
        $validated = $request->validate([
            'idno'        => 'required',
            'firstname'   => 'required|string|max:150',
            'email'       => 'required|email|max:150',
            'phone'       => 'required|string|max:20',
            'productinfo' => 'required|string|max:150',
            'remarks'     => 'nullable|string|max:100',
            'amount'      => 'required|numeric|min:1',
            'requestid'   => 'required|min:1',
        ]);
    
        $requestid = Crypt::decrypt($validated['requestid']);
        $idno      = Crypt::decrypt($validated['idno']);
        $amount = $request->amount;
      
        $apiPayload = [
            'IDNo'       => $idno ?? '',
            'Name'       => $validated['firstname'],
            'Email'      => $validated['email'],
            'MobileNo'   => $validated['phone'],
            'Amount'     => $validated['amount'],
            'documentid' => $requestid,
            'Status'     => 'failure',
            'FeeType'    => $validated['productinfo'],
            'Semester'   => 0,
            'Remarks'    => $validated['remarks'] ?? '',
        ];
    
        $token = $request->session()->get('api_token');
     
        $apiResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://10.0.8.181:89/student/paymentStart/', $apiPayload);
    
        if (!$apiResponse->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment record.',
                'details' => $apiResponse->body(),
            ], 500);
        }
    
        $responseData = $apiResponse->json();
        $txnid        = $responseData['txnid'] ?? null;
        $amount        = $responseData['amount'] ?? null;
        $amount = number_format((float) $amount, 2, '.', '');
        if (!$txnid) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction ID not returned by API.',
                'raw'     => $responseData,
            ], 500);
        }
    
        $MERCHANT_KEY  = env('PAYU_MERCHANT_KEY');
        $MERCHANT_SALT = env('PAYU_MERCHANT_SALT');
        $PAYU_BASE_URL = env('PAYU_BASE_URL', 'https://test.payu.in/_payment');
        
        // Prepare the posted data
        $posted = [
            'key'         => $MERCHANT_KEY,
            'txnid'       => $txnid,
            'amount'      => $amount,
            'productinfo' => $validated['productinfo'],
            'firstname'   => $validated['firstname'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'surl'        => 'http://127.0.0.1:8000/api/payu/payment-response-web',
            'furl'        => 'http://127.0.0.1:8000/api/payu/payment-response-web',
            'udf1'        => '0',
            'udf2'        => $validated['remarks'] ?? '',
            'udf3'        => $idno ?? '',
            'udf4'        => $requestid ?? '',
            'udf5'        => '',
            'udf6'        => '',
            'udf7'        => '',
            'udf8'        => '',
            'udf9'        => '',
            'udf10'       => '',
        ];

        $hashSequence = [
            $posted['key'],
            $posted['txnid'],
            $posted['amount'],
            $posted['productinfo'],
            $posted['firstname'],
            $posted['email'],
            $posted['udf1'],
            $posted['udf2'],
            $posted['udf3'],
            $posted['udf4'],
            $posted['udf5'],
            $posted['udf6'],
            $posted['udf7'],
            $posted['udf8'],
            $posted['udf9'],
            $posted['udf10'],
            $MERCHANT_SALT,
        ];
        
        $hash_string = implode('|', $hashSequence);
        \Log::info("Hash string: ".$hash_string);
        
        $hash = strtolower(hash('sha512', $hash_string));
        
        $posted['hash'] = $hash;
        return view('payu.payu_redirect', [
            'success'   => true,
            'payu_url'  => $PAYU_BASE_URL,
            'params'    => $posted,
        ]);
    }

public function paymentResponseMobile(Request $request)
{
    // dd($request);
    $MERCHANT_SALT = env('PAYU_MERCHANT_SALT');

    $mihpayid      = $request->mihpayid ?? '';
    $status      = $request->status ?? '';
    $email       = $request->email ?? '';
    $phone       = $request->phone ?? '';
    $firstname   = $request->firstname ?? '';
    $productinfo = $request->productinfo ?? '';
    $amount      = $request->amount ?? '';
    $txnid       = $request->txnid ?? '';
    $key         = $request->key ?? '';
    $udf1         = $request->udf1 ?? '';
    $udf2         = $request->udf2 ?? '';
    $udf3         = $request->udf3 ?? '';
    $udf4         = $request->udf4 ?? '';
    $posted_hash = $request->hash ?? '';
    
    $additionalCharges = $request->has('additionalCharges')
        ? trim((string)$request->additionalCharges)
        : null;
    
    if ($additionalCharges) {
        $retHashSeq = $additionalCharges . '|'
                    . $MERCHANT_SALT . '|'
                    . $status .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    . $udf4 .'|'
                    . $udf3 .'|'
                    . $udf2 .'|'
                    . $udf1 .'|'
                    . $email . '|'
                    . $firstname . '|'
                    . $productinfo . '|'
                    . $amount . '|'
                    . $txnid . '|'
                    . $key;
    } else {
        $retHashSeq = $MERCHANT_SALT . '|'
                    . $status .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    . $udf4 .'|'
                    . $udf3 .'|'
                    . $udf2 .'|'
                    . $udf1 .'|'
                    . $email . '|'
                    . $firstname . '|'
                    . $productinfo . '|'
                    . $amount . '|'
                    . $txnid . '|'
                    . $key;
    }

    $hash = strtolower(hash('sha512', $retHashSeq));
    
    if ($hash !== $posted_hash) {
        return "Invalid Transaction. Hash mismatch.";
    }
    
    $updatePayload = [
        'IDNo' => $udf3,
        'txnid' => $txnid,
        'mihpayid' => $mihpayid,
        'Status' => $status,
        'Amount' => $amount,
        'Remarks' => $udf2,
        'sem' => $udf1,
        'Name' => $firstname,
        'Email' => $email,
        'MobileNo' => $phone,
        'FeeType' => $productinfo,
    ];
    $token = session('api_token');
 
    $updatePayload['IDNo']      = (int) $updatePayload['IDNo'] ?? 0;
$updatePayload['mihpayid']  = (int) $updatePayload['mihpayid'] ?? 0;
$updatePayload['Amount']    = (float) $updatePayload['Amount'] ?? 0;
$updatePayload['sem']       = (int) $updatePayload['sem'] ?? 0;
$updatePayload['MobileNo']  = (int) $updatePayload['MobileNo'] ?? 0;

$apiResponse = Http::withHeaders([
    'Authorization' => 'Bearer ' . $token,
])->post('http://10.0.8.181:89/student/updatePayment/', $updatePayload);
$responseData = $apiResponse->json();
    $flag = $responseData['flag'] ?? null;
    if ($status === 'success' && $flag == '1') {
        $html = "
            <html>
             <head><title>Payment Success</title></head>
                <script>
                    window.onload = function() {
                        if (window.ReactNativeWebView && window.ReactNativeWebView.postMessage) {
                            const payload = {
                                status: 'success',
                                txnid: '{$txnid}',
                                amount: '{$amount}'
                            };
                            window.ReactNativeWebView.postMessage(JSON.stringify(payload));
                        }
                    }
                </script>
            </html>
        ";
        return response($html, 200)->header('Content-Type', 'text/html');
    } else {
        $error_message = 'Transaction failed.';
        $html = "
            <html>
       
                <script>
                    window.onload = function() {
                        if (window.ReactNativeWebView && window.ReactNativeWebView.postMessage) {
                            const payload = {
                                status: 'failed',
                                txnid: '{$txnid}',
                                reason: '{$error_message}'
                            };
                            window.ReactNativeWebView.postMessage(JSON.stringify(payload));
                        }
                    }
                </script>
            </html>
        ";
        return response($html, 200)->header('Content-Type', 'text/html');
    }
    
    
    
}
public function paymentResponse(Request $request)
{
    // dd($request);
    $MERCHANT_SALT = env('PAYU_MERCHANT_SALT');

    $mihpayid      = $request->mihpayid ?? '';
    $status      = $request->status ?? '';
    $email       = $request->email ?? '';
    $phone       = $request->phone ?? '';
    $firstname   = $request->firstname ?? '';
    $productinfo = $request->productinfo ?? '';
    $amount      = $request->amount ?? '';
    $txnid       = $request->txnid ?? '';
    $key         = $request->key ?? '';
    $udf1         = $request->udf1 ?? '';
    $udf2         = $request->udf2 ?? '';
    $udf3         = $request->udf3 ?? '';
    $udf4         = $request->udf4 ?? '';
    $posted_hash = $request->hash ?? '';
    
    $additionalCharges = $request->has('additionalCharges')
        ? trim((string)$request->additionalCharges)
        : null;
    
    if ($additionalCharges) {
        $retHashSeq = $additionalCharges . '|'
                    . $MERCHANT_SALT . '|'
                    . $status .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    . $udf4 .'|'
                    . $udf3 .'|'
                    . $udf2 .'|'
                    . $udf1 .'|'
                    . $email . '|'
                    . $firstname . '|'
                    . $productinfo . '|'
                    . $amount . '|'
                    . $txnid . '|'
                    . $key;
    } else {
        $retHashSeq = $MERCHANT_SALT . '|'
                    . $status .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    .'|'
                    . $udf4 .'|'
                    . $udf3 .'|'
                    . $udf2 .'|'
                    . $udf1 .'|'
                    . $email . '|'
                    . $firstname . '|'
                    . $productinfo . '|'
                    . $amount . '|'
                    . $txnid . '|'
                    . $key;
    }

    $hash = strtolower(hash('sha512', $retHashSeq));
    
    if ($hash !== $posted_hash) {
        return "Invalid Transaction. Hash mismatch.";
    }
    
    $updatePayload = [
        'IDNo' => $udf3,
        'txnid' => $txnid,
        'mihpayid' => $mihpayid,
        'Status' => $status,
        'Amount' => $amount,
        'Remarks' => $udf2,
        'sem' => $udf1,
        'Name' => $firstname,
        'Email' => $email,
        'MobileNo' => $phone,
        'FeeType' => $productinfo,
    ];
    $token = session('api_token');

    $updatePayload['IDNo']      = (int) $updatePayload['IDNo'] ?? 0;
$updatePayload['mihpayid']  = (int) $updatePayload['mihpayid'] ?? 0;
$updatePayload['Amount']    = (float) $updatePayload['Amount'] ?? 0;
$updatePayload['sem']       = (int) $updatePayload['sem'] ?? 0;
$updatePayload['MobileNo']  = (int) $updatePayload['MobileNo'] ?? 0;

$apiResponse = Http::withHeaders([
    'Authorization' => 'Bearer ' . $token,
])->post('http://10.0.8.181:89/student/updatePayment/', $updatePayload);
$responseData = $apiResponse->json();
    $flag = $responseData['flag'] ?? null;
 
if ($status === 'success' && $flag == '1') {
    $payload = [
        'txnid'     => $txnid,
        'mihpayid'  => $mihpayid,
        'amount'    => $amount,
    ];

    $encrypted = Crypt::encrypt($payload);

    return redirect()->route('payu.success', ['data' => $encrypted]);
} else {
    $error_message = 'Transaction failed.';

    $payload = [
        'txnid'         => $txnid,
        'status'        => $status,
        'amount'        => $amount,
        'error_message' => $error_message,
    ];

    $encrypted = Crypt::encrypt($payload);

    return redirect()->route('payu.failure', ['data' => $encrypted]);
}

    // if ($status === 'success' && $flag=='1') {
    //     return redirect()->route('payu.success', compact(
    //         'txnid',
    //         'mihpayid',
    //         'amount'
    //     ));
    // } else {
    //     $error_message = 'Transaction failed.';
    //     return redirect()->route('payu.failure', compact(
    //         'txnid',
    //         'status',
    //         'amount',
    //         'error_message'
    //     ));
    // }
}

public function paymentSuccess(Request $request)
{
    try {
        $data = Crypt::decrypt($request->get('data'));

        return view('payu.success', [
            'txnid'    => $data['txnid'],
            'mihpayid' => $data['mihpayid'],
            'amount'   => $data['amount'],
        ]);
    } catch (\Exception $e) {
        abort(403, 'Invalid or tampered data.');
    }
}

public function paymentFailure(Request $request)
{
    try {
        $data = Crypt::decrypt($request->get('data'));

        return view('payu.failure', [
            'txnid'         => $data['txnid'],
            'status'        => $data['status'],
            'amount'        => $data['amount'],
            'error_message' => $data['error_message'],
        ]);
    } catch (\Exception $e) {
        abort(403, 'Invalid or tampered data.');
    }
}



//     public function initiatePayment(Request $request)
//     {
//          // Generate transaction ID
//          $txnid = uniqid('txn_');
//          $BaseURL=config('app.baseUrl');
//          $token = $request->session()->get('api_token');
//          $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
//          if ($DataResponse->failed()) {
//              return view('index', [
//                  'userDetails' => []
                 
//              ]);
//          }
//          $resData = $DataResponse->json();
//          $userDetails=$resData['data'][0];
//          // Insert payment data into the database
//          $payment = new Payment();
//          $payment->user_id = $userDetails['IDNo']; // Adjust based on your user management
//          $payment->fee_type = $request->fee_type;
//          $payment->semester = $request->semester;
//          $payment->amount = $request->amount;
//          $payment->remarks = $request->remarks;
//          $payment->txnid = $txnid;
//          $payment->status = 'pending';
//          $payment->save();
//         // Payment initialization logic (as shown earlier)
//         $paymentData = [
//             'key' => config('payu.merchant_key'),
//             'txnid' => uniqid('txn_'),
//             'amount' => $request->amount,
//             'productinfo' => $request->fee_type . ' - ' . $request->semester,
//             'firstname' => $request->student_name,
//             'email' => $request->email,
//             'phone' => $request->mobile ?? '1234567890',
//             'surl' => route('payu.success'),
//             'furl' => route('payu.failure'),
//             'service_provider' => 'gku',
//         ];
//         $hashSequence = config('payu.merchant_key') . "|" . $paymentData['txnid'] . "|" . $paymentData['amount'] . "|"
//         . $paymentData['productinfo'] . "|" . $paymentData['firstname'] . "|" . $paymentData['email'] . "|||||||||||"
//         . config('payu.merchant_salt');
        
//         $paymentData['hash'] = strtolower(hash('sha512', $hashSequence));
//         // dd($paymentData['hash']);

//          // PayU Payment URL
//     $payuUrl = config('payu.base_url');

//     // Create a form to redirect to PayU
//     return response()->view('payu.payment_redirect', compact('paymentData', 'payuUrl'));
// }
// public function paymentSuccess(Request $request)
// {
//     $txnid = $request->txnid;

//     // Validate hash
//     $hashSequence = $request->key . "|" . $txnid . "|" . $request->amount . "|" 
//         . $request->productinfo . "|" . $request->firstname . "|" . $request->email . "|||||||||||"
//         . config('payu.merchant_salt');
//     $generatedHash = strtolower(hash('sha512', $hashSequence));

//     if ($generatedHash !== $request->hash) {
//         return response()->json(['error' => 'Invalid transaction'], 400);
//     }

//     // Update payment status to success
//     $payment = Payment::where('txnid', $txnid)->first();
//     if ($payment) {
//         $payment->status = 'success';
//         $payment->updated_at = now();
//         $payment->save();
//     }

//     return view('payu.success', ['payment' => $payment]);
// }

// public function paymentFailure(Request $request)
// {
//     $txnid = $request->txnid;

//     // Update payment status to failed
//     $payment = Payment::where('txnid', $txnid)->first();
//     if ($payment) {
//         $payment->status = 'failed';
//         $payment->updated_at = now();
//         $payment->save();
//     }

//     return view('payu.failure', ['payment' => $payment]);
// }
}