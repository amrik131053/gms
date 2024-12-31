<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class SmartCardController extends Controller
{
    public function applysmartCard(Request $request)
    {
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        $SmartCardResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/viewsmartcard');
        $smartCardFlgResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/applybutton');
        $statusSmartcardResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/smartcard');
        
        if ($DataResponse->failed()) {
            return view('index', [
                'SmartCard' => [],
                'MasterCourse' => [],
                'flag' => [],
                'flag1' => []
            ]);
        }
        $SmartCard = $SmartCardResponse->json();
        // dd($SmartCard);
        $MasterCourse=$SmartCard['data1'][0];
        $SmartCard=$SmartCard['data'][0];
        $flag = $smartCardFlgResponse->json();
        $flag=$flag['flag'];
        $flag1 = $statusSmartcardResponse->json();
        $flag1=$flag1['flag'];
        $StatusIDCard = $statusSmartcardResponse->json();
        $StatusIDCard=$StatusIDCard['data'][0]??[];
        // dd($flag);
        return view('smartCard', compact('SmartCard','MasterCourse','flag','flag1','StatusIDCard'));
        
    }

    public function submitSmartCard(Request $request)
    {
        $BaseURL=config('app.baseUrl');
$token = $request->session()->get('api_token');

if (!$token) {
    return back()->withErrors(['error' => 'Token is missing']);
}
$response = Http::withHeaders([
    'Authorization' => 'Bearer ' . $token,
])->post($BaseURL.'Student/applysmartcard');

$resp = $response->json();
// dd($resp);
if (isset($resp['data']) && $resp['data'] == '1') {
    return back()->with('success', 'ID Card applied successfully');
} else {
    return back()->withErrors(['error' => 'Already Applied']);
}
    }
}
