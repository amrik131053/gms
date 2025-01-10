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
        $responseAllExamForms = Http::withHeaders(['Authorization' => 'Bearer ' . $token])->timeout(10)->post($BaseURL . 'Student/allAdmitCard');
        $AllExamForms=[];
        if ($responseAllExamForms->successful()) {
            $AllExamForms = $responseAllExamForms->json()['data']??[];
        }
        return View('AdmitCard', compact('AllExamForms'));
    }
    
    public function generateAdmitCardPDF(Request $request)
    {
        $resultid = $request->input('FormID');
        $currentDateFormatted = Carbon::now()->format('d-M-Y');
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' .$token,
        ])->post($BaseURL.'Student/admitCardPrint/'.$resultid);
        if ($response->successful()) {
            $resultsData = $response->json();
            // dd($resultsData);
               $resultsData1=$resultsData['data1'][0];
               $resultsData=$resultsData['data2'];
               $data = [
                    'UniRollNo'=>$resultsData1['UniRollNo'],
                    'StudentName'=>$resultsData1['StudentName'],
                    'FatherName'=>$resultsData1['FatherName'],
                    'Batch'=>$resultsData1['Batch'],
                    'Course'=>$resultsData1['Course'],
                    'Semester'=>$resultsData[0]['SemesterId'],
                    'Examination'=>$resultsData[0]['Examination'],
                    'Type'=>$resultsData[0]['Type'][0],
                    'SubmitFormDate'=>$currentDateFormatted,
                    'Image'=>$resultsData1['Image'],
                    'SignaturePath'=>$resultsData1['SignaturePath'],
                    'SubjectsResult'=>$resultsData
        ];   
        $pdf = PDF::loadView('ViewAdmitCard', ['data' => $data]);
        return $pdf->download('AdmitCard-'.$resultsData[0]['Examination'].'.pdf');
        
    } 
    else 
    {
        return view('AdmitCard')->withErrors(['message' => 'Failed to retrieve  data.']);
    }
    }


    
}
