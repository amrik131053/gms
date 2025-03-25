<?php 
session_start();
$EmployeeID=$_SESSION['usr'];
require('fpdf/fpdf.php');
ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";
$univ_rollno=$_GET['id_array'];
$BatchID=$_GET['BatchID'];
class CustomPDF extends FPDF {
    function Footer() {
        // Set the position of the footer at 15mm from the bottom
        $this->SetY(-15);
        // Set font and color for the footer text
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
        $this->SetY(-12);
        // $this->Cell(0, 10, 'Printed on ' .$GLOBALS['timeStampS'], 0, 0, 'R');
    }   
} 

$pdf = new CustomPDF();
$sel=$_GET['id_array'];
$univ_rollno=explode(",",$sel);
foreach ($univ_rollno as $key => $value) {
   
$pdf->AddPage('P', 'A4');   

$srno=1;
$x=0;
$y=20;

$pdf->SetXY(10,18);
$pdf->SetFont('times', 'B', 10);
$pdf->SetXY(10,12);
// $pdf->multicell(190, 5,"Guru Kashi Univerisity",0,'C');
$pdf->SetXY(10,18);
$pdf->multicell(190, 5,"PROVISIONAL ADMIT CARD FOR () EXAMINATION",0,'C');
$pdf->SetTextColor(150,0,0);
$pdf->SetFont('times', 'B', 12);
$pdf->MultiCell(190,8,"  ", 0, 'C');
$pdf->SetTextColor(0,0,0);
$pdf-> Image('dist\img\new-logo.jpg',10,8,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',170,8,30,10);

$pdf->SetXY(10,25);


  $queryCheckStatus = "SELECT COUNT(*) AS PendingCount FROM ResultPreparation WHERE BatchID = '$BatchID' AND DMCStatus != '3'";
$checkStatusRun = sqlsrv_query($conntest, $queryCheckStatus);

if ($checkStatusRun) {
    $row = sqlsrv_fetch_array($checkStatusRun, SQLSRV_FETCH_ASSOC);
    $pendingCount = $row['PendingCount'] ?? 1; 
    if ($pendingCount == 0) {
         $queryUpdateDMCPrint1 = "UPDATE DMCPrint  SET Status = '3', PrintedBy = '$EmployeeID', PrintedOn = '$timeStamp' WHERE Id = '$BatchID'";
         sqlsrv_query($conntest, $queryUpdateDMCPrint1);
    }
    else{
         $queryUpdateDMCPrint = "UPDATE ResultPreparation  SET DMCStatus = '3', DMCprintedBy = '$EmployeeID', DMCprintedOn = '$timeStamp' WHERE ID = '$value'";
        sqlsrv_query($conntest, $queryUpdateDMCPrint); 
    }
    } else {
        echo "";
    }
}
$pdf->Output();