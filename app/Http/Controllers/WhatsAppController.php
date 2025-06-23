<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsAppController extends Controller
{
    public function sendOtpToWhatsApp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits_between:10,15',
            'otp' => 'required|digits:6',
        ]);
        $otp = $request->otp;
        $mobile = $request->mobile;
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer K7PZlwEE9tvHJT5wcAuDb1JUjdYpF5Q9UJWPtb1pKD',
                'X-MYOP-COMPANY-ID' => '681c3c005f48b343',
            ])->post('https://publicapi.myoperator.co/chat/messages', [
                'phone_number_id' => '701959619656572',
                'myop_ref_id' => 'fghfghfghjfgj585',
                'customer_country_code' => '91',
                'customer_number' => $mobile,
                'reply_to' => null,
                'data' => [
                    'type' => 'template',
                    'context' => [
                        'template_name' => 'otp_auth',
                        'body' => [
                            'otp' => $otp
                        ],
                        'buttons' => [
                            [
                                'otp' => $otp,
                                'index' => 0
                            ]
                        ]
                    ]
                ]
            ]);
    
            return response()->json([
                'status' => $response->status(),
                'body' => $response->json()
            ]);
        }
}