<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ProfileController extends Controller
{
    public function showProfilePage(Request $request)
    { 
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        if ($DataResponse->failed()) {
            return view('index', [
                'profileData' => []
                
            ]);
        }
        $resData = $DataResponse->json();
        // dd($resData);
        $profileData=$resData['data'][0];
        return view('profile', compact('profileData'));
    }

public function submitProfileForm(Request $request)
{
    // Validate form inputs
    $request->validate([
        'bloodgroup' => 'required', 
        'gender' => 'required', 
        'email' => 'required', 
        'mobile' => 'required', 
        'abcid' => 'required', 
        'address' => 'required' 
    ], [
        'bloodgroup.required' => 'Please select a bloodgroup.',
        'gender.required' => 'Please select a gender.',
        'email.required' => 'Please enter  email.',
        'mobile.required' => 'Please enter a mobile.',
        'abcid.required' => 'Please enter a ABC ID.',
        'address.required' => 'Please enter a Address.'
    ]);
    $BaseURL=config('app.baseUrl');
    $token = $request->session()->get('api_token');
    $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        if ($DataResponse->failed()) {
            return view('index', [
                'profileData' => []
                
            ]);
        }
        $resData = $DataResponse->json();
        $profileData=$resData['data'][0];
        $bloodgroup = $request->input('bloodgroup');
        $gender = $request->input('gender');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $otr = $request->input('otr');
        if($profileData['ABCID']!='' || $profileData['ABCID']!=NULL)
        {
            $abcid = $request->input('abcid');
        }
        else
        {
            $abcid ="Smart";

        }
            $address = $request->input('address');
            if (!$token) {
                return back()->withErrors(['error' => 'Token is missing']);
            }
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($BaseURL . 'Student/updateprofile/' . $mobile . '/' . $bloodgroup . '/' . $abcid . '/' . $email . '/' . $address.'/'.$otr);
            
            $resp = $response->json();
            // dd($resp);
            if (isset($resp['data'][0]) && $resp['data'][0] == '1') {
                return back()->with('success', ' Update Successfully');
            } else {
                return back()->withErrors(['error' => 'Try After Sometime']);
            }
    }
    
    public function uploadImage(Request $request)
    {
        $request->validate([
            'inputImage' => [
                'required', 
                'mimes:jpg,jpeg,png', 
                'max:500'
            ]
        ], [
            'inputImage.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
            'inputImage.max' => 'The image must be less than or equal to 500 KB.'
           
        ]);
    if ($request->hasFile('inputImage')) {
        $image = $request->file('inputImage');
        $tempPath = $image->getRealPath();
        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->attach('image', file_get_contents($tempPath), $image->getClientOriginalName())
        ->post($BaseURL . 'Student/image');
        if ($response->successful()) {
                    return back()->with('success', ' Image Uploaded Successfully');
                } else {
                    return back()->withErrors(['error' => 'Try After Sometime']);
                }
    }
    }
    public function uploadsignature(Request $request)
    {
        $request->validate([
            'inputSign' => [
                'required', 
                'mimes:jpg,jpeg,png', 
                'max:500'
            ]
        ], [
            'inputSign.mimes' => 'The signature must be a file of type: jpg, jpeg, png.',
            'inputSign.max' => 'The signature must be less than or equal to 500 KB.'
             
        ]);
    if ($request->hasFile('inputSign')) {
        $inputSign = $request->file('inputSign');
        $tempPath = $inputSign->getRealPath();
        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->attach('image', file_get_contents($tempPath), $inputSign->getClientOriginalName())
        ->post($BaseURL . 'Student/signature');
        if ($response->successful()) {
                    return back()->with('success', ' Signature Uploaded Successfully');
                } else {
                    return back()->withErrors(['error' => 'Try After Sometime']);
                }
    }
    }
    
    

}
