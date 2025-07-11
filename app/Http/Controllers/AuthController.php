<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Auth;
use Session;
class AuthController extends Controller
{
    // dashboard 
    public function mainDashboard(Request $request)
    {
    $BaseURL=config('app.baseUrl');
    $BaseURLPublic=config('app.baseUrlPublic');
    $token = $request->session()->get('api_token');
    if (!$token) {
        return redirect()->route('index')->withErrors(['error' => 'Session expired or token is missing. Please log in again.']);
    }
    try {
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL.'Student/dashboard');
        $DataButtonsExam = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL.'Student/checkbutton');
        $getNews = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post('http://gurukashiuniversity.co.in/gmsapi/newsread.php');
        $newsConvert = $getNews->json();
        $newsDetails = $newsConvert['data'] ?? [];
        // dd($DataResponse);
        if ($DataResponse->failed()) {
            return view('index', [
                'profileData' => [], 
                'booksCount' => [], 
                'noticeBoard' => [], 
                'booksFine' => [], 
                'examButtonFlag' => [], 
                'officeOrder' => [], 
                'meterDetails' => [], 
                'newsDetails' => [], 
                'smartcardStatus' => [] 
                ])->withErrors(['error' => 'Failed to fetch profile data. Please try again later.']);
            }
            $examStatus = $DataButtonsExam->json();
            $profile = $DataResponse->json();
         
            
            $profileData = $profile['profile'][0] ?? [];
            $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
            $resData = $DataResponse->json();
            $profileData1=$resData['data'][0];
            $IDNo=$profileData1['IDNo'];
            $DataResponseTrack = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post('http://gurukashiuniversity.co.in/odl-api/meterReading/'.$IDNo);
            $DataMeter = $DataResponseTrack->json();
            // dd($DataResponseTrack);
        $officeOrder = $profile['notice'] ?? [];
        $smartcardStatus = $profile['statusIdcard'][0] ?? [];
        $noticeBoard = $profile['order'] ?? [];
        $booksCount = $profile['books'][0] ?? [];
        $booksFine = $profile['finedata'][0] ?? [];
        $examButtonFlag = $profile['statusopen']['flag'] ?? [];
        $meterDetails = $DataMeter[0] ?? [];
        // dd($meterDetails);
        if($profileData['Status']==1)
        {
            return View('welcome', compact('profileData', 'officeOrder','smartcardStatus', 'booksCount', 'noticeBoard','booksFine','examButtonFlag','meterDetails','newsDetails'));
        }
        else{
            cookie()->queue(cookie()->forget('api_token'));
            $request->session()->forget('api_token');
            return redirect()->route('logout');
        }
  

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
                'newsDetails' => [],  
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
            'newsDetails' => [], 
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
            'newsDetails' => [], 
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
            return view('index');
        }
    }
    public function forgotPassword(Request $request)
    {
       
            return view('forgotPassword');
       
    }
    public function forgotPasswordAction(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'email' => 'required|email',
    ], [
        'username.required' => 'The rollno/idno is required.',
        'email.required' => 'The email is required.',
        'email.email' => 'The email must be a valid email address.',
    ]);
    $BaseURL = config('app.baseUrl');
    $username = $request->input('username');
    $email = $request->input('email');
    try {
        $response = Http::get('http://gurukashiuniversity.co.in/GMS/student-forgot-password-action.php', [
            'email_id' => $email,
            'username' => $username,
        ]);
        if ($response->successful()) {
            $resp = $response->json();
            if (isset($resp) && $resp!=4) {
                return back()->with('success', 'Password reset have been sent to your email.');
            } else {
                return back()->withErrors([
                    'error' => 'Kindly provide the right information. Email and Username does not match in database.',
                ])->withInput();
            }
        }
    } catch (\Exception $e) {
        return back()->withErrors([
            'error' => 'An error occurred while processing your request. Please try again later.',
        ])->withInput();
    }
    return back()->withErrors([
        'username' => 'Invalid rollno/idno. Please try again.',
        'email' => 'Invalid email. Please try again.',
    ])->withInput();
}
        public function login(Request $request)
        {
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ], [
        'username.required' => 'The rollno/idno is required.',
        'password.required' => 'The password is required.'
    ]);
    $BaseURL = config('app.baseUrl');
    $response = Http::post($BaseURL . 'Student/login', [
        'username' => $request->input('username'),
        'password' => $request->input('password'),
    ]);

    if ($response->successful()) {
        $token = $response->json('token');
        session(['api_token' => $token]);
        if ($request->has('remember') && $request->input('remember') == 'on') {
            cookie()->queue('api_token', $token, 60 * 24 * 365);  // 1 year
        }
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('index')
            ->withErrors([
                'username' => 'Invalid rollno/idno. Please try again.',
                'password' => 'Invalid password. Please try again.',
            ])
            ->withInput();
    }
}

    // public function login(Request $request)
    // {

    //     $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string',
    //     ], [
    //         'username.required' => 'The rollno/idno is required.',
    //         'password.required' => 'The password is required.'
           
    //     ]);
    //     $BaseURL = config('app.baseUrl');
    //     $response = Http::post($BaseURL . 'Student/login', [
    //         'username' => $request->input('username'),
    //         'password' => $request->input('password'),
    //     ]);
    
    //     if ($response->successful()) {
    //         $token = $response->json('token');
    //         session(['api_token' => $token]);
    //         return redirect()->route('dashboard');
    //     } else {
    //         return redirect()->route('index')
    //             ->withErrors([
    //                 'username' => 'Invalid rollno/idno. Please try again.',
    //                 'password' => 'Invalid password. Please try again.',
    //             ])
    //             ->withInput();
    //     }
    // }
    
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
            cookie()->queue(cookie()->forget('api_token'));
            return back()->with('success', 'Password changed successfully. Logging you out...');
        } else {
            return back()->withErrors(['error' => 'Old Password not exist']);
        }
    }
    // student logout API
    public function logout(Request $request)
    {
         cookie()->queue(cookie()->forget('api_token'));
        $request->session()->forget('api_token');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }


}
