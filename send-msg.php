<?php

// $phone_number_id = "701959619656572";
// $company_id = "681c3c005f48b343";
// $api_key = "K7PZlwEE9tvHJT5wcAuDb1JUjdYpF5Q9UJWPtb1pKD";

// $recipient = "918053615639";
// $country_code = substr($recipient, 0, strlen($recipient) - 10);
// $local_number = substr($recipient, -10);

// $postData = [
//     "phone_number_id" => $phone_number_id,
//     "customer_country_code" => $country_code,
//     "customer_number" => $local_number,
//     "data" => [
//         "type" => "template",
//         "context" => [
//             "template_name" => "adm_xavier1",
//             "template_data" => [
//                 "body" => [
//                     "placeholders" => ["Guru Kashi University"]  // Use your template placeholders here
//                 ]
//             ]
//         ]
//     ],
//     "reply_to" => null,
//     "myop_ref_id" => uniqid()
// ];

// $curl = curl_init();

// curl_setopt_array($curl, [
//     CURLOPT_URL => "https://publicapi.myoperator.co/chat/messages",
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_CUSTOMREQUEST => "POST",
//     CURLOPT_POSTFIELDS => json_encode($postData),
//     CURLOPT_HTTPHEADER => [
//         "Authorization: Bearer $api_key",
//         "X-MYOP-COMPANY-ID: $company_id",
//         "Content-Type: application/json",
//         "Accept: application/json"
//     ],
// ]);

// $response = curl_exec($curl);

// if (curl_errno($curl)) {
//     echo "Curl error: " . curl_error($curl);
// } else {
//     echo "Response: " . $response;
// }

// curl_close($curl);


$phone_number_id = "701959619656572";
$company_id = "681c3c005f48b343";
$api_key = "K7PZlwEE9tvHJT5wcAuDb1JUjdYpF5Q9UJWPtb1pKD";

$recipient = "918053615639";
$country_code = substr($recipient, 0, strlen($recipient) - 10);
$local_number = substr($recipient, -10);

$otpCode = "123456";

$postData = [
    "phone_number_id" => $phone_number_id,
    "customer_country_code" => $country_code,
    "customer_number" => $local_number,
    "data" => [
        "type" => "template",
        "context" => [
            "template_name" => "otp_verification",
            "template_data" => [
                "body" => [
                    "otp" => $otpCode // ✅ For {{otp}} in BODY
                ],
                "buttons" => [
                    [
                        "type" => "url",
                        "index" => 0,
                        "otp" => $otpCode // ✅ For {{otp}} in DYNAMIC URL
                    ]
                ],
                "footer" => [
                    "code_expiration_minutes" => 15
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
