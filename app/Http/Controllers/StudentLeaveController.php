<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class StudentLeaveController extends Controller
{
    public function applyHostelLeave(Request $request)
    { 
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        $resData = $DataResponse->json();
        $profileData=$resData['data'][0];
        $IDNo=$profileData['IDNo'];
        $DataResponseTrack = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post('http://119.250.20.109:94/student/showAllLeaves/',
        [
            'studentId' => $IDNo,
        ]);
        $DataTracks = $DataResponseTrack->json();
        $leaveHistory=$DataTracks ?? [];
        return view('applyHostelLeave',compact('leaveHistory'));
    }
    public function submitHostelLeaveForm(Request $request)
    {
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'application_subject' => ['required', 'regex:/^[a-zA-Z0-9\s.,-]+$/'],
        ], [
            'startDate.required' => 'Please select start date.',
            'endDate.required' => 'Please select end date.',
           'application_subject.regex' => "Please do not use special characters like (' , . ? ~ / # $ ! ^ * & )in the subject.",
        ]);
    
        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        $resData = $DataResponse->json();
        $profileData=$resData['data'][0];
        $studentIDNo=$profileData['IDNo'];
    
        if (!$token) {
            return back()->withErrors(['error' => 'Token is missing']);
        }
    
        if (!$studentIDNo) {
            return back()->withErrors(['error' => 'Student ID is missing']);
        }
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $application_subject = $request->input('application_subject');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://119.250.20.109:94/student/studentApplyLeave', [
            'studentId' => $studentIDNo,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'remarks' => $application_subject,
        ]);
        $resp = $response->json();
        if (isset($resp['affectedRows']) >0) {
            return back()->with('success', 'Leave Applied Suucessfully');
        } else {
            return back()->withErrors(['error' => 'Unexpected error. Try again later.']);
        }
    }
    

}

?>