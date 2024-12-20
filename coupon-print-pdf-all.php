<?php
require('fpdf/fpdf.php');
date_default_timezone_set("Asia/Kolkata");
include "connection/connection.php";

// Validate input
$id = isset($_GET['ID']) ? intval($_GET['ID']) : null;
$StartNumber = isset($_GET['start']) ? intval($_GET['start']) : null;
$EndNumber = isset($_GET['end']) ? intval($_GET['end']) : null;

if (!$id || !$StartNumber || !$EndNumber || $EndNumber < $StartNumber) {
    die("Invalid input parameters.");
}

$list_sqlw = "UPDATE CouponRecord SET SrStart=?, SrEnd=? WHERE ID=?";
$params = [$StartNumber, $EndNumber, $id];
$stmt1 = sqlsrv_query($conntest, $list_sqlw, $params);
if (!$stmt1) {
    die("Failed to update database.");
}

$getStatus = "SELECT * FROM CouponRecord WHERE ID=?";
$getStatusRun = sqlsrv_query($conntest, $getStatus, [$id]);
if (!$getStatusRun || !($getStatusRow = sqlsrv_fetch_array($getStatusRun))) {
    die("Failed to fetch data.");
}

$Title = $getStatusRow['Title'];
$Type = $getStatusRow['Type'];
$EventDate = $getStatusRow['EventDate']->format('d M Y');

class CustomPDF extends FPDF {
    public $loopCount = 0; 

    function Footer() {
        $this->SetY(-39); 
        $this->SetFont('Times', 'B', 14);

           $this->SetX(10);
    $this->MultiCell(25, 5, $this->loopCount+1, 0, 'C');
    $this->SetFont('Times', 'B', 12);
    $this->SetXY(10, -33);
    $this->MultiCell(25, 5, $GLOBALS['EventDate'], 0, 'C'); 
    $this->SetFont('Times', 'B', 7);
    $this->SetXY(39, -35.5);
    $this->MultiCell(28.5, 2.7, $GLOBALS['Title'], 0, 'C');
    $this->SetFont('Times', 'B', 14);
    $this->SetXY(8, -20);
    $this->MultiCell(30, 6, 'Breakfast', 0, 'C');


        $this->SetXY(76, -39);
        $this->MultiCell(25, 5, $this->loopCount+1, 0, 'C'); 
        $this->SetFont('Times', 'B', 12);
        $this->SetXY(75, -33);
        $this->MultiCell(25, 5, $GLOBALS['EventDate'], 0, 'C'); 
        $this->SetFont('Times', 'B', 7);
        $this->SetXY(105, -35.5);
        $this->MultiCell(28.5, 2.7, $GLOBALS['Title'], 0, 'C');
        $this->SetFont('Times', 'B', 14);
        $this->SetXY(74, -20);
        $this->MultiCell(30, 6, 'Lunch', 0, 'C');

        $this->SetXY(143, -39);
        $this->MultiCell(25, 5, $this->loopCount+1, 0, 'C'); 
        $this->SetFont('Times', 'B', 12);
        $this->SetXY(142, -33);
        $this->MultiCell(25, 5, $GLOBALS['EventDate'], 0, 'C'); 
        $this->SetFont('Times', 'B', 7);
        $this->SetXY(172, -35.5);
        $this->MultiCell(28.5, 2.7, $GLOBALS['Title'], 0, 'C');
        $this->SetFont('Times', 'B', 14);
        $this->SetXY(141, -20);
        $this->MultiCell(30, 6, 'Dinner', 0, 'C');
    }
}

$pdf = new CustomPDF();
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Times', 'B', 14);

$x = 10; $p = 76; $q = 143;
$y = 17.8; $yy = 21.5;
$g = 17.8; $gg = 21.5;
$r = 17.8; $rr = 21.5;
$total = $EndNumber - $StartNumber + 1;
$pdf->AddPage('P', 'A4');
if (!file_exists('dist/img/CouponAll.jpg')) {
    die("Background image not found.");
}
$pdf->Image('dist/img/CouponAll.jpg', 5, 6, 200, 280);
$loopCount = $StartNumber - 1; 

for ($j = $StartNumber; $j <= $EndNumber; $j++) {
    $loopCount++; 
    $pdf->loopCount = $loopCount; 

    $pdf->SetXY($x, $y);
    $pdf->MultiCell(25, 5, $loopCount, 0, 'C'); 
    $pdf->SetFont('Times', 'B', 12);
    $pdf->SetXY($x, $y+6);
    $pdf->MultiCell(25, 5, $EventDate, 0, 'C'); 
    $pdf->SetFont('Times', 'B', 7);
    $pdf->SetXY($x + 29, $yy);
    $pdf->MultiCell(28.5, 2.7, $Title, 0, 'C');
    $pdf->SetFont('Times', 'B', 14);
    $pdf->SetXY($x - 2, $yy + 15);
    $pdf->MultiCell(30, 6, 'Breakfast', 0, 'C');
    $yy += 40;
    $y += 40;


    $pdf->SetXY($p, $g);
    $pdf->MultiCell(25, 5, $loopCount, 0, 'C'); 

    $pdf->SetFont('Times', 'B', 12);
    $pdf->SetXY($p, $g+6);
    $pdf->MultiCell(25, 5, $EventDate, 0, 'C'); 
    $pdf->SetFont('Times', 'B', 7);
    $pdf->SetXY($p + 29, $gg);
    $pdf->MultiCell(28.5, 2.7, $Title, 0, 'C');
    $pdf->SetFont('Times', 'B', 14);
    $pdf->SetXY($p - 2, $gg + 15);
    $pdf->MultiCell(30, 6, 'Lunch', 0, 'C');
    $gg += 40;
    $g += 40;

    $pdf->SetXY($q, $r);
    $pdf->MultiCell(25, 5, $loopCount, 0, 'C'); 
    $pdf->SetFont('Times', 'B', 12);
    $pdf->SetXY($q, $r+6);
    $pdf->MultiCell(25, 5, $EventDate, 0, 'C'); 
    $pdf->SetFont('Times', 'B', 7);
    $pdf->SetXY($q + 29, $rr);
    $pdf->MultiCell(28.5, 2.7, $Title, 0, 'C');
    $pdf->SetFont('Times', 'B', 14);
    $pdf->SetXY($q - 2, $rr + 15);
    $pdf->MultiCell(30, 6,'Dinner', 0, 'C');
    $rr += 40;
    $r += 40;


    if ($g>240 ) {
        $pdf->AddPage('P', 'A4');
        $pdf->Image('dist/img/CouponAll.jpg', 5, 6, 200, 280);
        $loopCount=$loopCount+1;
        $x = 10;
        $p = 76;
        $q = 143;
        $y = 17.8;
        $yy = 21.5;
        $g = 17.8;
        $gg = 21.5;
        $r = 17.8;
        $rr = 21.5;
        $j=$j+1;
    }

}

$pdf->Output();
?>
