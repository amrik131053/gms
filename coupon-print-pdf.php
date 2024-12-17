<?php
require('fpdf/fpdf.php');
$id = $_GET['ID'];
$StartNumber = $_GET['start'];
$EndNumber = $_GET['end'];
date_default_timezone_set("Asia/Kolkata");
include "connection/connection.php";

$list_sqlw = "UPDATE  CouponRecord set SrStart='$StartNumber' ,SrEnd='$EndNumber' where ID='$id'";
$stmt1 = sqlsrv_query($conntest, $list_sqlw);

$getStatus = "SELECT * FROM CouponRecord where ID='$id'";
$getStatusRun = sqlsrv_query($conntest, $getStatus);
if ($getStatusRow = sqlsrv_fetch_array($getStatusRun)) {
    $Title = $getStatusRow['Title'];
    $Type = $getStatusRow['Type'];
    $EventDate = $getStatusRow['EventDate']->format('d M Y');
}

class CustomPDF extends FPDF {
    function Footer() {
   
    }   
}

$pdf = new CustomPDF();
$fontSize = 16;

$Y = 31.5;
$x = 22;
$yy = 54;
$yyy = 37;

$pdf->AddPage('P', 'A4');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Times', 'B', $fontSize);
$pdf->Image('dist/img/coupon.jpg', 1, 10, 200, 275);

for ($i = $StartNumber; $i <= $EndNumber; $i++) {
 
    $pdf->SetXY($x, $Y);
    $pdf->MultiCell(25, 5, $i, 0, 'C');

    $pdf->SetFont('Times', 'B','10');
    $pdf->SetXY($x + 34, $Y + 4.2); 
    $pdf->MultiCell(39, 3.5, $Title, 0, 'C');
    $pdf->SetFont('Times', 'B', $fontSize);

    $pdf->SetXY($x - 8, $yy);
    $pdf->MultiCell(40, 10, $Type, 0, 'C');
  
    $pdf->SetXY($x - 8, $yyy);
    $pdf->SetFont('Times', 'B','12');
    $pdf->MultiCell(40, 10, $EventDate, 0, 'C');
    $pdf->SetFont('Times', 'B', $fontSize);
 
    if ($i % 2 != 0) {
       
        $x = 113;
    } else {
       
        $x = 22;
        $Y += 53;
        $yy += 53;
        $yyy += 53;
    }

    if (($i - $StartNumber + 1) % 10 == 0 && $i != $EndNumber) {
        $pdf->AddPage('P', 'A4');
        $pdf->Image('dist/img/coupon.jpg', 1, 10, 200, 275);

        $Y = 31.5;
        $x = 22;
        $yy = 54;
        $yyy = 37;
    }
}

$pdf->Output();
?>
