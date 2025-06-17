<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['dashboard', 'header', 'footer', 'smartCard'], function ($view) {
            $token = session()->get('api_token');
            $BaseURL = config('app.baseUrl');
            $BaseURLPublic=config('app.baseUrlPublic');
            $profileData = [];
            $DataButtonsExam = [];
            $meterDetails = []; 
    
            if ($token) {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post($BaseURL . 'Student/dashboard');
    
                $responseExam = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token
                ])->timeout(10)->post($BaseURL . 'Student/checkbutton');
    
                if ($response->successful()) {
                    $profileData = $response->json();
                    $profileData = $profileData['profile'][0];
                }
    
                if ($responseExam->successful()) {
                    $DataButtons = $responseExam->json();
                    $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];
                }
    
                $DataResponse = Http::withHeaders(['Authorization' => 'Bearer ' . $token])
                    ->post($BaseURL . 'Student/profile');
    
                $resData = $DataResponse->json();
                $profileData1 = $resData['data'][0] ?? [];
                $IDNo = $profileData1['IDNo'] ?? null;
                if ($IDNo) {
                    $DataResponseTrack = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $token
                    ])->post($BaseURLPublic.'/student/meterReading/' . $IDNo);
    
                    if ($DataResponseTrack->successful()) {
                        $DataMeter = $DataResponseTrack->json();
                        $meterDetails = $DataMeter[0] ?? [];
                    }
                }
            }
            $view->with([
                'profileData' => $profileData,
                'menubar' => $meterDetails,
                'DataButtonsExam' => $DataButtonsExam
            ]);
        });
    }
    
    
}
