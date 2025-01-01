<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // dashboard 
    public function mainDashboard(Request $request)
    {
    $BaseURL=config('app.baseUrl');

    $token = $request->session()->get('api_token');
    if (!$token) {
        return redirect()->route('index')->withErrors(['error' => 'Session expired or token is missing. Please log in again.']);
    }
    try {
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL.'Student/dashboard');
        $DataButtonsExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL.'Student/checkbutton');
        if ($DataResponse->failed()) {
            return view('index', [
                'profileData' => [], 
                'booksCount' => [], 
                'noticeBoard' => [], 
                'booksFine' => [], 
                'examButtonFlag' => [], 
                'officeOrder' => [], 
                'meterDetails' => [], 
                'smartcardStatus' => [] 
                ])->withErrors(['error' => 'Failed to fetch profile data. Please try again later.']);
            }
            $examStatus = $DataButtonsExam->json();
            $profile = $DataResponse->json();
         
            $profileData = $profile['profile'][0] ?? [];
            $DataMeterBills = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post('http://gurukashiuniversity.co.in/odl-api/meterReading.php?IDNo='.$profileData['IDNo']);
        $DataMeter = $DataMeterBills->json();
        $officeOrder = $profile['order'] ?? [];
        $smartcardStatus = $profile['statusIdcard'][0] ?? [];
        $noticeBoard = $profile['notice'] ?? [];
    
        $booksCount = $profile['books'][0] ?? [];
        $booksFine = $profile['finedata'][0] ?? [];
        $examButtonFlag = $profile['statusopen']['flag'] ?? [];
        $meterDetails = $DataMeter['data'][0] ?? [];
      
       return View('welcome', compact('profileData', 'officeOrder','smartcardStatus', 'booksCount', 'noticeBoard','booksFine','examButtonFlag','meterDetails'));

    } catch (RequestException $e) {
   
        if ($e->getCode() === 28) {
            return view('index', [
                 'profileData' => [], 
                'booksCount' => [], 
                'noticeBoard' => [], 
                'booksFine' => [],
                'examButtonFlag' => [], 
                'officeOrder' => [] ,
                'meterDetails' => [], 
                'smartcardStatus' => []
            ])->withErrors(['error' => 'The server took too long to respond. Please try again later.']);
        }

        return view('index', [
            'profileData' => [], 
            'booksCount' => [], 
            'noticeBoard' => [], 
            'booksFine' => [], 
            'examButtonFlag' => [],
            'officeOrder' => [] ,
            'meterDetails' => [], 
            'smartcardStatus' => []
        ])->withErrors(['error' => 'An error occurred while fetching data. Please try again later.']);

    } catch (\Exception $e) {

        return view('index', [
            'profileData' => [], 
            'booksCount' => [], 
            'noticeBoard' => [], 
            'booksFine' => [], 
            'examButtonFlag' => [],
            'officeOrder' => [] ,
            'meterDetails' => [], 
            'smartcardStatus' => []
        ])->withErrors(['error' => 'An unexpected error occurred. Please try again later.']);
    }
}



    // student login API
    public function loginPage(Request $request)
    {
        $token = $request->session()->get('api_token');
        if($token)
        {
            return redirect()->route('dashboard');
        }
        else{
            return view('index')->withErrors(['message' => 'Page Not fund.']);
        }
    }
    public function login(Request $request)
    {
        $BaseURL=config('app.baseUrl');
        // dd($BaseURL);
        $response = Http::post($BaseURL.'Student/login', [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
            
        ]);
        if ($response->successful()) {
            $token = $response->json('token');
            session(['api_token' => $token]);
            return redirect()->route('dashboard');
    } else {
        return redirect()->route('index')
        ->withErrors(['error' => 'Invalid username or password. Please try again.']);
        }
    }
    public function showPasswordChangeForm()
    {
        return view('changePassword');
    }

    public function passwordchangeAction(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required|same:newpassword'
        ], [
            'oldpassword.required' => 'Please enter old password.',
            'newpassword.required' => 'Please enter new password.',
            'confirmpassword.required' => 'Please confirm the new password.',
            'confirmpassword.same' => 'The confirm password does not match the new password.'
        ]);

        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');

        if (!$token) {
            return back()->withErrors(['error' => 'Token is missing']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post($BaseURL.'Student/passwordchange/' . $oldpassword . '/' . $newpassword);

        $resp = $response->json();

        if (isset($resp['Response']) && $resp['Response'] == '1') {
            return back()->with('success', 'Password changed successfully');
        } else {
            return back()->withErrors(['error' => 'Old Password not exist']);
        }
    }
    // student logout API
    public function logout(Request $request)
    {
        $request->session()->forget('api_token');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }


}
