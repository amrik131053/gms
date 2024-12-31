<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use PDF;
use Carbon\Carbon;
class AdmitCardController extends Controller
{
    public function AdmitCards(Request $request)
    { 
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/examforms');
        $AllExamForms=[];
        if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
        // dd($AllExamForms);
        return View('AdmitCard', compact('AllExamForms'));
    }
    
    public function generateAdmitCardPDF(Request $request)
    {
        $resultid = $request->input('FormID');
        $Semesterid = $request->input('Semesterid');
        // dd($resultid);
        $currentDateFormatted = Carbon::now()->format('d-M-Y');
        $Type = $request->input('Type');
        $Course = $request->input('Course');
        $Examination = $request->input('Examination');
        $SubmitFormDate = $request->input('SubmitFormDate');
        $formattedDate = Carbon::parse($SubmitFormDate)->format('d M Y');

        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $token = $request->session()->get('api_token');
    $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        if ($DataResponse->failed()) {
            return view('index', [
                'profileData' => []
                
            ]);
        }
        $resData = $DataResponse->json();
        $profileData=$resData['data'][0];
        $response = Http::withHeaders(['Authorization' => 'Bearer ' .$token,
        ])->post($BaseURL.'Student/examform/'.$resultid);
        if ($response->successful()) {
            $resultsData = $response->json();
               $resultsData1=$resultsData['data'];
               $resultsData=$resultsData['data1'];
               
               $data = [
                    'UniRollNo'=>$profileData['UniRollNo'],
                    'StudentName'=>$profileData['StudentName'],
                    'FatherName'=>$profileData['FatherName'],
                    'Batch'=>$profileData['Batch'],
                    'Course'=>$Course,
                    'Semester'=>$Semesterid,
                    'Examination'=>$Examination,
                    'Type'=>$Type,
                    'SubmitFormDate'=>$currentDateFormatted,
                    'Image'=>$profileData['Image'],
                    'SignaturePath'=>$profileData['SignaturePath'],
                    'SubjectsResult'=>$resultsData
        ];   
        // dd($resultsData1);
        $pdf = PDF::loadView('ViewAdmitCard', ['data' => $data]);
        return $pdf->download('AdmitCard-'.$Examination.'.pdf');
        
    } 
    else 
    {
        return view('AdmitCard')->withErrors(['message' => 'Failed to retrieve  data.']);
    }
    }


    
}
