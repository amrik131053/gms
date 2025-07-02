<?php
include "connection/connection.php";
// $sql = "
//    SELECT
// Password,
//     IDNo,
//     ClassRollNo,
//     StudentName,
//     Course,
//     StudentMobileNo
// FROM Admissions inner join UserMaster ON Admissions.IDNo=UserMaster.UserName
// WHERE CAST(AdmissionDate AS DATE) BETWEEN '2025-06-30' AND '2025-06-30' and Password!='12345678'
// ORDER BY IDNo DESC;
// ";
// $sql = "
//    SELECT
// Password,
//     IDNo,
//     ClassRollNo,
//     StudentName,
//     Course,
//     StudentMobileNo
// FROM Admissions inner join UserMaster ON Admissions.IDNo=UserMaster.UserName
// WHERE IDNo='9618248485'
// ORDER BY IDNo DESC;
// ";

$stmt = sqlsrv_query($conntest, $sql);

if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $MobileNumber = $row['StudentMobileNo'];
    $IDNo = $row['IDNo'];
    $sql1 = "SELECT Password FROM UserMaster WHERE UserName='$IDNo'";
$stmt1 = sqlsrv_query($conntest, $sql1);
if ($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
    $password = $row1['Password'];
}
    $ClassRollNo = $row['ClassRollNo'];
    $Name = $row['StudentName'];
    $CourseName = $row['Course'];
    echo $MobileNumber.'='.$password.'='.$ClassRollNo.'='.$Name.'='.$CourseName.'</br>';
    sendWhatsappMessage($MobileNumber, $password, $ClassRollNo, $Name, $CourseName);
}

sqlsrv_close($conntest);

// -----------------------------
// Function to send WhatsApp message
// -----------------------------

function sendWhatsappMessage($MobileNumber, $password, $ClassRollNo, $Name, $CourseName)
{
    $apiUrl = 'https://publicapi.myoperator.co/chat/messages';
    $payload = [
        "phone_number_id" => "701959619656572",
        "myop_ref_id" => "formreject_" . uniqid(),
        "customer_country_code" => "91",
        "customer_number" => "$MobileNumber",
        "reply_to" => null,
        "data" => [
            "type" => "template",
            "context" => [
                "template_name" => "copy_copy_adm_new",
                "body" => [
                    "label" => "Password",
                    "code" => "$password",
                    "rollno" => "$ClassRollNo",
                    "candidatename" => "$Name",
                    "coursename" => "$CourseName"
                ]
            ]
        ]
    ];

    $headers = [
        "Content-Type: application/json",
        "Authorization: Bearer K7PZlwEE9tvHJT5wcAuDb1JUjdYpF5Q9UJWPtb1pKD",
        "X-MYOP-COMPANY-ID: 681c3c005f48b343"
    ];

    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

    // optionally disable SSL check for testing
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        // echo "cURL ERROR: " . curl_error($ch) . "\n";
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo "</br>Sent to $MobileNumber - HTTP Status: $httpCode\n";
        // echo "Response: $response\n";
    }

    curl_close($ch);
}
