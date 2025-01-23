<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class GrievanceController extends Controller
{
    
    public function grievance(Request $request)
    { 
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        $DataResponseTrack = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/grievance');
        $DataTracks = $DataResponseTrack->json();
        $dropDownTrak=$DataTracks['grievances'] ?? [];
        $DataResponsedropDownHead = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/grievancehead');
        $DataResponsedropDown = $DataResponsedropDownHead->json();
        $dropDownHead=$DataResponsedropDown['data'] ?? [];
// dd($dropDownHead);
        $resData = $DataResponse->json()??[];
        $grievanceData=$resData['data'][0] ?? [];

        $grievanceDataHistory=$DataTracks['data'] ?? [];
        return view('grievance', compact('grievanceData','grievanceDataHistory','dropDownTrak','dropDownHead'));
    }
    public function submitGrievanceForm(Request $request)
    {
                $request->validate([
                    'application_to' => 'required',
                    'application_subject' => [
                        'required',
                        'string',
                        "regex:/^[a-zA-Z0-9\s.,-_)(']+$/",
                    ],
                    'application_details' => [
                        'required',
                        'string',
                        "regex:/^[a-zA-Z0-9\s.,-_)(']+$/",
                    ],

                    'application_file' => [
                        'nullable', 
                        'mimetypes:image/png,image/jpeg,image/jpg,application/pdf',
                        'max:5120', 
                    ],
                ], [
                    'application_to.required' => 'Please select to.',
                    'application_subject.required' => 'The subject is required.',
                    'application_subject.regex' => 'The subject contains invalid characters.',
                    'application_details.required' => 'The application details are required.',
                    'application_details.regex' => 'The details contain invalid characters.',
                    'application_file.mimes' => 'The file must be of type: jpg, jpeg, png, or pdf.',
                    'application_file.max' => 'The file must be less than or equal to 5MB.',
                ]);
        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $application_to = $request->input('application_to');
        $application_to_name = "SIC";
        $application_subject = $request->input('application_subject');
        $application_details = $request->input('application_details');
        if (!$token) {
            return back()->withErrors(['error' => 'Token is missing']);
        }
        if ($request->hasFile('application_file')) {
            $file = $request->file('application_file');
            $tempPath = $file->getRealPath();
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->attach('application_file', file_get_contents($tempPath), $file->getClientOriginalName())
              ->post($BaseURL . 'Student/submitgrievance/' . $application_to . '/' . $application_to_name . '/' . $application_subject . '/' . $application_details);
        } else {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post($BaseURL . 'Student/submitgrievance/' . $application_to . '/' . $application_to_name . '/' . $application_subject . '/' . $application_details);
        }
        
       $resp = $response->json();
        if ($resp['flag'] == '1') {
            return back()->with('success',$resp['message']);
        } elseif ($resp['flag'] == '0') {
            return back()->with('error', 'please try after some times..');
        } else {
            return back()->withErrors(['error' => 'Try again later']);
        }
    }
    

    public function complaintTrack(Request $request)
    {
        $BaseURL = config('app.baseUrl');
        $complaintno = $request->input('complaintno');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
            ->post($BaseURL . 'Student/grievance/' . $complaintno);

        if ($response->successful()) {
            $resp = $response->json();
            if (empty($resp)) {
                return response()->json(['error' => 'No data found'], 404);
            }
            $examSubjectNormalData = $resp['data'] ?? [];
            return response()->json([
                'trackingData' => $examSubjectNormalData,  
            ]);
        } else {
            return response()->json(['error' => 'Request failed'], $response->status());
        }
    }
    

}