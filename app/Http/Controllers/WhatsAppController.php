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
    'Authorization' => 'Bearer YOUR_API_TOKEN',
    'Content-Type' => 'application/json',
])->post('https://app.myoperator.co/api/v1/send-template', [
    'customer_contact' => $request->mobile,
    'customer_country_code' => '91',
    'template_name' => 'otp_verification', // use your actual template name
    'template_language' => 'en',
    'components' => [
        [
            'type' => 'BUTTONS',
            'buttons' => [
                [
                    'type' => 'URL',
                    'index' => 0,
                    'text' => 'Copy Code',
                    'format' => 'DYNAMIC',
                    'url' => 'https://www.whatsapp.com/otp/code/?otp_type=COPY_CODE&code_expiration_minutes=10&code=otp{{otp}}',
                    'example' => [
                        'otp' => '123456'
                    ]
                ]
            ]
        ],
        [
            'type' => 'FOOTER',
            'text' => 'This code will expire in 15 min.',
            'code_expiration_minutes' => 15
        ],
        [
            'type' => 'BODY',
            'text' => '{{otp}} is your verification code. For your security, do not share this code.',
            'example' => [
                'otp' => '1234'
            ],
            'add_security_recommendation' => true
        ]
    ],
]);
        return response()->json([
            'status' => $response->status(),
            'body' => $response->json(),
            'raw' => $response->body(),
        ]);
    }        
    
}