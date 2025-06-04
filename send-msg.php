<?php

$phone_number_id = "701959619656572"; // from your API
$company_id = "681c3c005f48b343";     // your company ID
$api_key = "K7PZlwEE9tvHJT5wcAuDb1JUjdYpF5Q9UJWPtb1pKD"; // your API key

// Recipient number with country code
$recipient = "918053615639"; 

$country_code = substr($recipient, 0, strlen($recipient) - 10); // "91"
$local_number = substr($recipient, -10);                      // "8053615639"

$postData = [
    "phone_number_id" => $phone_number_id,
    "customer_country_code" => $country_code,
    "customer_number" => $local_number,
    "data" => [
        "type" => "template",
        "template" => [
            "namespace" => "adm_xavier1",  // replace with your WhatsApp template namespace
            "name" => "adm_xavier1",                // the template name you want to send
            "language" => [
                "policy" => "deterministic",        // usually 'deterministic' or 'fallback'
                "code" => "en"
            ],
            "components" => [
                [
                    "type" => "header",
                    "parameters" => [
                        [
                            "type" => "image",
                            "image" => [
                                "id" => "28419e4a-2c5d-446b-83c6-659b27bfee83" // template media id from your example
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "body",
                    "parameters" => [
                        // if your template body has placeholders, pass text here
                        // example: [ { "type": "text", "text": "UserName" } ]
                    ]
                ],
                [
                    "type" => "button",
                    "sub_type" => "url",
                    "index" => 0,
                    "parameters" => [
                        [
                            "type" => "text",
                            "text" => "https://pre.gku.ac.in"
                        ]
                    ]
                ],
                [
                    "type" => "button",
                    "sub_type" => "phone_number",
                    "index" => 1,
                    "parameters" => [
                        [
                            "type" => "phone_number",
                            "phone_number" => "919914283400"
                        ]
                    ]
                ]
            ]
        ]
    ],
    "reply_to" => null,
    "myop_ref_id" => uniqid()
];


$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://publicapi.myoperator.co/chat/messages",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($postData),
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer $api_key",
        "X-MYOP-COMPANY-ID: $company_id",
        "Content-Type: application/json",
        "Accept: application/json"
    ],
]);

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo "Curl error: " . curl_error($curl);
} else {
    echo "Response: " . $response;
}

curl_close($curl);
