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
            $profileData = [];
            $DataButtonsExam = [];
            
            if ($token) {
                
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                ])->post($BaseURL . 'Student/dashboard');
    
                $responseExam = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $token
                ])->timeout(10)->post($BaseURL . 'Student/checkbutton');
    
                if ($response->successful()) {
                    $profileData = $response->json();
                    $profileData=$profileData['profile'][0];
                }
                if ($responseExam->successful()) {
                    $DataButtons = $responseExam->json();
                    $DataButtonsExam = $DataButtons['statusopen'][0]['flag'] ?? [];
                }
            }

            $view->with([
                'profileData' => $profileData,
                'DataButtonsExam' => $DataButtonsExam
            ]);
        });
    }
    
}
