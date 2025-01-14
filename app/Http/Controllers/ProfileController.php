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
        'address' => [
            'required',
            'string',
            "regex:/^[a-zA-Z0-9\s.,-_)(']+$/",

        ],
    ], [
        'bloodgroup.required' => 'Please select a bloodgroup.',
        'gender.required' => 'Please select a gender.',
        'email.required' => 'Please enter  email.',
        'mobile.required' => 'Please enter a mobile.',
        'abcid.required' => 'Please enter a ABC ID.',
        'address.required' => 'Please enter a Address.',
        'address.regex' => 'The details contain invalid characters in address.',
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
        $otr = $request->input('otr') ?? 0;

        // if($profileData['ABCID']!='' || $profileData['ABCID']!=NULL)
        // {
            $abcid = $request->input('abcid');
        // }
        // else
        // {
        //     $abcid ="Smart";

        // }
        // dd($abcid);
            $address = $request->input('address');
            if (!$token) {
                return back()->withErrors(['error' => 'Token is missing']);
            }
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($BaseURL . 'Student/updateprofile/' . $mobile . '/' . $bloodgroup . '/' . $abcid . '/' . $email . '/' . $address.'/'.$otr);
            
            $resp = $response->json();
      
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
    
    public function correctionRequest(Request $request)
    { 
        $correctionData=[];
        $correctionDataHistory=[];
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        $DataResponseCorrection = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/correctiondata');
        $resData = $DataResponse->json()??[];
        $DataResponseCorr = $DataResponseCorrection->json();
        $correctionData=$resData['data'][0] ?? [];
        $correctionDataHistory=$DataResponseCorr['data'] ?? [];
        return view('correctionRequest', compact('correctionData','correctionDataHistory'));
    }
    public function submitCorrectionForm(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'gender' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required',
            'remarks' => 'required',
            'correction' => [
                'required',
                'mimetypes:image/png,image/jpeg,image/jpg,application/pdf',
                'max:5120', // File size limit in KB (5MB = 5120KB)
            ],
        ], [
            'student_name.required' => 'Please enter a student name.',
            'gender.required' => 'Please select a gender.',
            'father_name.required' => 'Please enter a father name.',
            'mother_name.required' => 'Please enter a mother name.',
            'dob.required' => 'Please enter a date of birth.',
            'remarks.required' => 'Please enter remarks.',
            'correction.mimes' => 'The file must be of type: jpg, jpeg, png, or pdf.',
            'correction.max' => 'The file must be less than or equal to 5MB.',
        ]);
        // dd($request->file('fileName')->getMimeType());

        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $student_name = $request->input('student_name');
        $gender = $request->input('gender');
        $father_name = $request->input('father_name');
        $mother_name = $request->input('mother_name');
        $dob = $request->input('dob');
        $mobile = $request->input('mobile');
        $email = $request->input('email');
        $address = $request->input('address');
        $remarks = $request->input('remarks');
    
        if (!$token) {
            return back()->withErrors(['error' => 'Token is missing']);
        }
    
        $file = $request->file('correction');
        $tempPath = $file->getRealPath();
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->attach('correction', file_get_contents($tempPath), $file->getClientOriginalName())
          ->post($BaseURL.'Student/correction/'.$student_name.'/'.$father_name.'/'.$mother_name.'/'.$gender.'/'.$mobile.'/'.$email.'/'.$address.'/'.$dob.'/'.$remarks);
          $resp = $response->json();
        if ($resp['data'] == '1') {
            return back()->with('success', 'Request submit successfully');
        }
         elseif ($resp['data'] == '-1') {
            return back()->with('error', 'Request already in process');
        } 
        elseif ($resp['data'] == '2') {
            return back()->with('error', 'no data change check new details again');
        } 
        else{
            return back()->withErrors(['error' => 'Try Again Later']);
        }
    }
    

}
