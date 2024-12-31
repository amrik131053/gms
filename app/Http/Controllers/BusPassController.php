<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class BusPassController extends Controller
{
    public function busPassPage(Request $request)
    {
        $BaseURL=config('app.baseUrl');
        $token = $request->session()->get('api_token');
        $buspassDataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/buspass');
        $routeDataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/transportrootes');
        if ($buspassDataResponse->failed() || $routeDataResponse->failed()) {
            return view('applyBusPass', [
            'buspassData' => [], 
            'routeData' => [] 
        ]);
    }
    $buspassData = $buspassDataResponse->json();
    $buspassData = $buspassData['buspassdeail']['recordset'];
    $routeData = $routeDataResponse->json();
    $routeData=$routeData['data'];
    // dd($buspassData);
    return view('applyBusPass', compact('buspassData', 'routeData'));
}
public function fetchSpots(Request $request)
{
    $BaseURL=config('app.baseUrl');
    $spotId = $request->input('spot_id');
    $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post($BaseURL.'Student/transportspot/' . $spotId);
    if ($response->successful()) {
        $spots = $response->json();
        $spots=$spots['data'];
        return response()->json($spots);
    }
    return response()->json(['error' => 'Unable to fetch spots'], 500);
}
public function submitBusPass(Request $request)
{
    // Validate form inputs
    $request->validate([
        'routeid' => 'required', 
        'spotid' => 'required'   
    ], [
        'routeid.required' => 'Please select a route.',
        'spotid.required' => 'Please select a spot.'
    ]);
    $BaseURL=config('app.baseUrl');
    $routeId = $request->input('routeid');
    $spotId = $request->input('spotid');
    $token = $request->session()->get('api_token');
    if (!$token) {
        return back()->withErrors(['error' => 'Token is missing']);
    }
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        ])->post($BaseURL.'Student/applybuspass/' . $routeId . '/' . $spotId);
        $resp = $response->json();
        if (isset($resp['data']) && $resp['data'] == '1') {
            return back()->with('success', 'Bus pass applied successfully');
        } else {
            return back()->withErrors(['error' => 'Bus Pass Already Applied']);
        }
    }
    
    public function fetchPass(Request $request)
    {
        $BaseURL=config('app.baseUrl');
        $ID = $request->input('ID');
        $token = $request->session()->get('api_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            ])->post($BaseURL.'Student/eachbuspass/' . $ID);

            return $response['data'];
    }
}
