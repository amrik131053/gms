<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AcademicsController extends Controller
{
    public function studyMaterial(Request $request)
    {
        $BaseURL = config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
            ->post($BaseURL . 'Student/noofsem');
    
        if ($response->successful()) {
            $semData = $response->json();
            $semData = $semData['semesters']['recordset'];
            return view('studymaterial')->with([
                'semData' => $semData,
                'studyMaterialData' => [], 
            ]);
        } else {
            return view('study-material')->withErrors(['message' => 'Failed to retrieve data.']);
        }
    }
    
    public function fetchsubject(Request $request)
{
    $BaseURL=config('app.baseUrl');
    $semID = $request->input('semid');
    $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post($BaseURL.'Student/subjects/' . $semID);
    if ($response->successful()) {
        $subjectData = $response->json();
        $subjectData=$subjectData['semesters']['recordsets'][0];
        return response()->json($subjectData);
    }
    return response()->json(['error' => 'Unable to fetch spots'], 500);
}
public function searchStudy(Request $request)
{
    $request->validate([
        'semID' => 'required',
        'subID' => 'required'
    ], [
        'semID.required' => 'Please select a semester.',
        'subID.required' => 'Please select a subject.'
    ]);

    $BaseURL = config('app.baseUrl');
    $semID = $request->input('semID');
    $subID = $request->input('subID');
    $token = $request->session()->get('api_token');

    if (!$token) {
        return back()->withErrors(['error' => 'Token is missing']);
    }
    $response = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
        ->post($BaseURL . 'Student/studymaterial/' . $semID . '/' . $subID);

    $response1 = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
        ->post($BaseURL . 'Student/noofsem');
    if ($response1->successful() && $response->successful()) {
        $semData = $response1->json();
        $semData = $semData['semesters']['recordset'];

        $resp = $response->json();
        $studyMaterialData = $resp['material']['recordsets'][0];
        return view('studymaterial')->with([
            'semData' => $semData,
            'studyMaterialData' => $studyMaterialData,
        ]);
    } else {
        
        return back()->withErrors(['error' => 'Failed to retrieve data.']);
    }

}
}
