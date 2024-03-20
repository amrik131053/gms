<?php
session_start();
$EmployeeID=$_SESSION['usr'];
require('fpdf/fpdf.php');
include "connection/connection.php";
date_default_timezone_set("Asia/Calcutta");
$today1=date('Y-m-d h:i:s');
$CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['distributiontheory'];
 $exam = $_GET['examination'];
 $code = $_GET['code'];

// Extend the FPDF class to create a custom class with a footer
class CustomPDF extends FPDF {
    function Footer() {
        // Set the position of the footer at 15mm from the bottom
        $this->SetY(-15);
        // Set font and color for the footer text
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
    }
}

   $today = date("j");
    $month = date("m");
    $year = date("Y");
// Create a new CustomPDF instance
$pdf = new CustomPDF();
$pdf->AliasNbPages(); // Enable page numbering
$pdf->AddPage('P', 'A4');
$pdf->SetFont('times', 'B', 10);
$pdf->SetXY(10,10);
$pdf->multicell(190, 5,"Award List ($exam)",0,'C');
$pdf->SetTextColor(150,0,0);
$pdf->MultiCell(190,8,"  ", 0, 'C');
$pdf->SetTextColor(0,0,0);
$pdf-> Image('dist\img\new-logo.jpg',10,8,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',170,8,30,10);
$X=$pdf->GETX();
$Y=$pdf->GETY();
 $sql11 = "SELECT SubjectName FROM MasterCourseStructure WHERE SubjectCode='$subjectcode'";
$stmt1 = sqlsrv_query($conntest,$sql11);
while($row1 = sqlsrv_fetch_array($stmt1))
{
$pdf->SetXY(10, $Y+7);
$pdf->Cell(150, 4,'Subject Name: '.$row1['SubjectName'],0, 1, 'L');
// echo "kokok";
}
if($code==1)
{
$pdf->SetXY(10, $Y+3);
$pdf->Cell(150, 4,'Batch: '.$Batch,0, 1, 'L');
$pdf->SetXY(160, $Y+7);
$pdf->Cell(40, 4,'Subject Code: '.$subjectcode, 0, 1, 'R');
$pdf->SetXY(160, $Y+3);
$pdf->Cell(40, 4,'Semester: '.$semID, 0, 1, 'R');
$pdf->SetXY($X, $Y+12);
$pdf->Cell(10, 4,'SrNo', 1, 1, 'C');
$pdf->SetXY($X+10, $Y+12);
$pdf->Cell(30, 4,'UniRollNo', 1, 1, 'C');
$pdf->SetXY($X+40, $Y+12);
$pdf->Cell(64, 4,'StudentName', 1, 1, 'C');
$pdf->SetXY($X+104, $Y+12);
$pdf->Cell(22, 4,'CA-1 & CA-2', 1, 1, 'C');
$pdf->SetXY($X+126, $Y+12);
$pdf->Cell(15, 4,'CA-3', 1, 1, 'C');
$pdf->SetXY($X+141, $Y+12);
$pdf->Cell(16, 4,'MST-1', 1, 1, 'C');
$pdf->SetXY($X+157, $Y+12);
$pdf->Cell(15, 4,'MST-2', 1, 1, 'C');
$pdf->SetXY($X+172, $Y+12);
$pdf->Cell(18, 4,'Attandance', 1, 1, 'C');
$pdf->SetFont('Times', 'B', 10);
$sql1 = "{CALL USP_Get_studentbyCollegeInternalMarksDistributionTheory('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 
$SrNo=1;
     while($row = sqlsrv_fetch_array($stmt))
     {
         $X=$pdf->GETX();
         $Y=$pdf->GETY();
$pdf->SetFont('Times', '', 10);
$pdf->SetXY($X, $Y);
$pdf->Cell(10, 4,$SrNo, 1, 1, 'C');
$pdf->SetXY($X+10, $Y);
$pdf->Cell(30, 4,$row['UniRollNo'], 1, 1, 'C');
$pdf->SetXY($X+40, $Y);
$pdf->Cell(64, 4,$row['StudentName'], 1, 1, 'C');
$pdf->SetXY($X+104, $Y);
$pdf->Cell(22, 4,$row['intmarks'], 1, 1, 'C');
$pdf->SetXY($X+126, $Y);
$pdf->Cell(15, 4,$row['intmarks'], 1, 1, 'C');
$pdf->SetXY($X+141, $Y);
$pdf->Cell(16, 4,$row['intmarks'], 1, 1, 'C');
$pdf->SetXY($X+157, $Y);
$pdf->Cell(15, 4,$row['intmarks'], 1, 1, 'C');
$pdf->SetXY($X+172, $Y);
$pdf->Cell(18, 4,$row['intmarks'], 1, 1, 'C');
$pdf->SetFont('Times', 'B', 10);     
    $SrNo++;
if($SrNo%59==0)
{
$pdf->AddPage('P', 'A4');
$pdf->SetXY(10,10);
$pdf->multicell(190, 5,"Registration Form($exam)",0,'C');
$pdf->SetTextColor(150,0,0);
$pdf->MultiCell(190,8,"  ", 0, 'C');
$pdf->SetTextColor(0,0,0);
$pdf-> Image('dist\img\new-logo.jpg',10,8,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',170,8,30,10);
$X=$pdf->GETX();
$Y=$pdf->GETY();
 $sql11 = "SELECT SubjectName FROM MasterCourseStructure WHERE SubjectCode='$subjectcode'";
$stmt1 = sqlsrv_query($conntest,$sql11);
while($row1 = sqlsrv_fetch_array($stmt1))
{
$pdf->SetXY(10,$Y+7);
$pdf->Cell(150, 4,'Subject Name: '.$row1['SubjectName'],0, 1, 'L');
}
$pdf->SetXY(10, $Y+3);
$pdf->Cell(150, 4,'Batch: '.$Batch,0, 1, 'L');
$pdf->SetXY(160, $Y+7);
$pdf->Cell(40, 4,'Subject Code: '.$subjectcode, 0, 1, 'R');
$pdf->SetXY(160, $Y+3);
$pdf->Cell(40, 4,'Semester: '.$semID, 0, 1, 'R');
$pdf->SetXY(10, $Y+12);
$pdf->SetXY(10, $Y+3);
$pdf->Cell(150, 4,'Batch: '.$Batch,0, 1, 'L');
$pdf->SetXY(160, $Y+7);
$pdf->Cell(40, 4,'Subject Code: '.$subjectcode, 0, 1, 'R');
$pdf->SetXY(160, $Y+3);
$pdf->Cell(40, 4,'Semester: '.$semID, 0, 1, 'R');
$pdf->SetXY($X, $Y+12);
$pdf->Cell(10, 4,'SrNo', 1, 1, 'C');
$pdf->SetXY($X+10, $Y+12);
$pdf->Cell(30, 4,'UniRollNo', 1, 1, 'C');
$pdf->SetXY($X+40, $Y+12);
$pdf->Cell(64, 4,'StudentName', 1, 1, 'C');
$pdf->SetXY($X+104, $Y+12);
$pdf->Cell(22, 4,'CA-1 & CA-2', 1, 1, 'C');
$pdf->SetXY($X+126, $Y+12);
$pdf->Cell(15, 4,'CA-3', 1, 1, 'C');
$pdf->SetXY($X+141, $Y+12);
$pdf->Cell(16, 4,'MST-1', 1, 1, 'C');
$pdf->SetXY($X+157, $Y+12);
$pdf->Cell(15, 4,'MST-2', 1, 1, 'C');
$pdf->SetXY($X+172, $Y+12);
$pdf->Cell(18, 4,'Attandance', 1, 1, 'C');
}
}
}
elseif($code==2){
    $pdf->SetXY(10, $Y+3);
    $pdf->Cell(150, 4,'Batch: '.$Batch,0, 1, 'L');
    $pdf->SetXY(160, $Y+7);
    $pdf->Cell(40, 4,'Subject Code: '.$subjectcode, 0, 1, 'R');
    $pdf->SetXY(160, $Y+3);
    $pdf->Cell(40, 4,'Semester: '.$semID, 0, 1, 'R');
    $pdf->SetXY($X, $Y+12);
    $pdf->Cell(10, 4,'SrNo', 1, 1, 'C');
    $pdf->SetXY($X+10, $Y+12);
    $pdf->Cell(30, 4,'UniRollNo', 1, 1, 'C');
    $pdf->SetXY($X+40, $Y+12);
    $pdf->Cell(64, 4,'StudentName', 1, 1, 'C');
    $pdf->SetXY($X+104, $Y+12);
    $pdf->Cell(22, 4,'CA-1 & CA-2', 1, 1, 'C');
    $pdf->SetXY($X+126, $Y+12);
    $pdf->Cell(15, 4,'CA-3', 1, 1, 'C');
    $pdf->SetXY($X+141, $Y+12);
    $pdf->Cell(16, 4,'MST-1', 1, 1, 'C');
    $pdf->SetXY($X+157, $Y+12);
    $pdf->Cell(15, 4,'MST-2', 1, 1, 'C');
    $pdf->SetXY($X+172, $Y+12);
    $pdf->Cell(18, 4,'Attandance', 1, 1, 'C');
    $pdf->SetFont('Times', 'B', 10);
    $sql1 = "{CALL USP_Get_studentbyCollegeInternalMarksDistributionTheory('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory')}";
        $stmt = sqlsrv_prepare($conntest,$sql1);
        if (!sqlsrv_execute($stmt)) {
              echo "Your code is fail!";
        echo sqlsrv_errors($sql1);
        die;
        } 
    $SrNo=1;
         while($row = sqlsrv_fetch_array($stmt))
         {
             $X=$pdf->GETX();
             $Y=$pdf->GETY();
    $pdf->SetFont('Times', '', 10);
    $pdf->SetXY($X, $Y);
    $pdf->Cell(10, 4,$SrNo, 1, 1, 'C');
    $pdf->SetXY($X+10, $Y);
    $pdf->Cell(30, 4,$row['UniRollNo'], 1, 1, 'C');
    $pdf->SetXY($X+40, $Y);
    $pdf->Cell(64, 4,$row['StudentName'], 1, 1, 'C');
    $pdf->SetXY($X+104, $Y);
    $pdf->Cell(22, 4,$row['intmarks'], 1, 1, 'C');
    $pdf->SetXY($X+126, $Y);
    $pdf->Cell(15, 4,$row['intmarks'], 1, 1, 'C');
    $pdf->SetXY($X+141, $Y);
    $pdf->Cell(16, 4,$row['intmarks'], 1, 1, 'C');
    $pdf->SetXY($X+157, $Y);
    $pdf->Cell(15, 4,$row['intmarks'], 1, 1, 'C');
    $pdf->SetXY($X+172, $Y);
    $pdf->Cell(18, 4,$row['intmarks'], 1, 1, 'C');
    $pdf->SetFont('Times', 'B', 10);     
        $SrNo++;
    if($SrNo%59==0)
    {
    $pdf->AddPage('P', 'A4');
    $pdf->SetXY(10,10);
    $pdf->multicell(190, 5,"Registration Form($exam)",0,'C');
    $pdf->SetTextColor(150,0,0);
    $pdf->MultiCell(190,8,"  ", 0, 'C');
    $pdf->SetTextColor(0,0,0);
    $pdf-> Image('dist\img\new-logo.jpg',10,8,55,10);
    $pdf-> Image('dist\img\naac-logo.jpg',170,8,30,10);
    $X=$pdf->GETX();
    $Y=$pdf->GETY();
     $sql11 = "SELECT SubjectName FROM MasterCourseStructure WHERE SubjectCode='$subjectcode'";
    $stmt1 = sqlsrv_query($conntest,$sql11);
    while($row1 = sqlsrv_fetch_array($stmt1))
    {
    $pdf->SetXY(10,$Y+7);
    $pdf->Cell(150, 4,'Subject Name: '.$row1['SubjectName'],0, 1, 'L');
    }
    $pdf->SetXY(10, $Y+3);
    $pdf->Cell(150, 4,'Batch: '.$Batch,0, 1, 'L');
    $pdf->SetXY(160, $Y+7);
    $pdf->Cell(40, 4,'Subject Code: '.$subjectcode, 0, 1, 'R');
    $pdf->SetXY(160, $Y+3);
    $pdf->Cell(40, 4,'Semester: '.$semID, 0, 1, 'R');
    $pdf->SetXY(10, $Y+12);
    $pdf->SetXY(10, $Y+3);
    $pdf->Cell(150, 4,'Batch: '.$Batch,0, 1, 'L');
    $pdf->SetXY(160, $Y+7);
    $pdf->Cell(40, 4,'Subject Code: '.$subjectcode, 0, 1, 'R');
    $pdf->SetXY(160, $Y+3);
    $pdf->Cell(40, 4,'Semester: '.$semID, 0, 1, 'R');
    $pdf->SetXY($X, $Y+12);
    $pdf->Cell(10, 4,'SrNo', 1, 1, 'C');
    $pdf->SetXY($X+10, $Y+12);
    $pdf->Cell(30, 4,'UniRollNo', 1, 1, 'C');
    $pdf->SetXY($X+40, $Y+12);
    $pdf->Cell(64, 4,'StudentName', 1, 1, 'C');
    $pdf->SetXY($X+104, $Y+12);
    $pdf->Cell(22, 4,'CA-1 & CA-2', 1, 1, 'C');
    $pdf->SetXY($X+126, $Y+12);
    $pdf->Cell(15, 4,'CA-3', 1, 1, 'C');
    $pdf->SetXY($X+141, $Y+12);
    $pdf->Cell(16, 4,'MST-1', 1, 1, 'C');
    $pdf->SetXY($X+157, $Y+12);
    $pdf->Cell(15, 4,'MST-2', 1, 1, 'C');
    $pdf->SetXY($X+172, $Y+12);
    $pdf->Cell(18, 4,'Attandance', 1, 1, 'C');
    }
    }
}







        $pdf->Output();