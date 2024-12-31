<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use PDF;
class ResultController extends Controller
{
    public function allresults(Request $request)
    {
      $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' .$token,
        ])->post($BaseURL.'Student/results');
        if ($response->successful()) {
            $resultsData = $response->json();
               $resultsData=$resultsData['data'];
            return view('results')->with('resultsData', $resultsData);
        } 
        else 
        {
            return view('index')->withErrors(['message' => 'Failed to retrieve  data.']);
        }
    }
    public function generateResultPDF(Request $request)
    {
        $resultid = $request->input('ResultID');
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' .$token,
        ])->post($BaseURL.'Student/results/'.$resultid);
        if ($response->successful()) {
            $resultsData = $response->json();
               $resultsData=$resultsData['data'];
        //  dd($resultsData);
        
        $data = [
            'UniRollNo'=>$resultsData[0]['UniRollNo'],
            'StudentName'=>$resultsData[0]['StudentName'],
            'FatherName'=>$resultsData[0]['FatherName'],
            'Course'=>$resultsData[0]['Course'],
            'Semester'=>$resultsData[0]['Semester'],
            'Examination'=>$resultsData[0]['Examination'],
            'Type'=>$resultsData[0]['Type'],
            'TotalCredit'=>$resultsData[0]['TotalCredit'],
            'Sgpa'=>$resultsData[0]['Sgpa'],
            'DeclareDate'=>$resultsData[0]['DeclareDate'],
            'SubjectsResult'=>$resultsData
        ];   
        $pdf = PDF::loadView('ViewResult', $data);
       
        return $pdf->download('result-pdf.pdf');
    } 
    else 
    {
        return view('results')->withErrors(['message' => 'Failed to retrieve  data.']);
    }
    }
}
