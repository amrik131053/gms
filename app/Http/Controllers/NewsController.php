<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class NewsController extends Controller
{
    public function showNewsDetails(Request $request)
    { 
        // $BaseURL=config('app.baseUrl');
        // $token = $request->session()->get('api_token');
        // $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' .$token,])->post($BaseURL.'Student/profile');
        // if ($DataResponse->failed()) {
        //     return view('index', [
        //         'profileData' => []
                
        //     ]);
        // }
        // $resData = $DataResponse->json();
        // // dd($resData);
        // $profileData=$resData['data'][0];
        // return view('profile', compact('profileData'));
    }

}