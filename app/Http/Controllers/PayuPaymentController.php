<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
class PayuPaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        
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

        $DataResponsedropDownHead = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/feeType');
        $DataResponsedropDown = $DataResponsedropDownHead->json();
        $dropDownHead=$DataResponsedropDown['data'] ?? [];
        
        $DataResponserecentTranscations = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post('http://117.250.20.109:89/Student/transactionsTest');
        $recentTranscations1 = $DataResponserecentTranscations->json();
        $recentTranscations=$recentTranscations1['data'] ?? [];

        $encryptedId = Crypt::encrypt('-1');
        return view('payu.payment_form', compact('details','encryptedId','dropDownHead','recentTranscations'));
    }

    public function showConfirmationOpen(Request $request,$encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $amount=$request->amount;
        $remarks=$request->remarks;
        $feeType=$request->fee_type;
        $semester=$request->semester;
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
        return view('payu.confirmation-fee', compact('amount','remarks','feeType','semester','details'));
    }

    public function showConfirmation(Request $request,$encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://117.250.20.109:89/Student/eachDocRequest/', [
            'requestId' => $id,
        ]);
        
        $submit_details = $response->json()['data'][0] ?? null;
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        if ($DataResponse->failed()) {
            return view('index', [
                'details' => []
                
            ]);
        }
        $resData = $DataResponse->json();
        $details=$resData['data'][0];
        return view('payu.confirmation', compact('submit_details','details'));
    }
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
            'semester'      => 'required|numeric|min:0',
            'requestid'   => 'required|min:1',
        ]);
             $requestid = Crypt::decrypt($validated['requestid']);
        $idno      = Crypt::decrypt($validated['idno']);
        $apiPayload = [
            'idno'         => $idno ?? '',
            'firstname'    => $validated['firstname'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'],
            'amount'       => $validated['amount'],
            'semester'       => $validated['semester'],
            'requestid'    => $requestid,
            'productinfo'  => $validated['productinfo'],
            'remarks'  => $validated['remarks'],
        ];
        $response = Http::post('https://payment.gku.ac.in/api/payu/initiate-web/', $apiPayload);
        $responseData = $response->json();
        return view('payu.payu_redirect', ['payuData' => $responseData]);
    }


    public function syncfee(Request $request)
    {
        $encryptedId=$request->encryptedId;
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([])->post('https://payment.gku.ac.in/api/payu/payment-sync', [
            'transaction_id' => $encryptedId,
        ]);
        $submit_details = $response->json() ?? null;
        return $submit_details;
    }
   
}