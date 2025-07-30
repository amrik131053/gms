<?php
require('fpdf/fpdf.php');
$id=$_POST['id'];
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";


  $list_sqlw= "UPDATE  Migration set IssueDate='$timeStampS' where ID='$id'";
  
     $stmt1 = sqlsrv_query($conntest,$list_sqlw);

   $getStatus="SELECT * FROM Migration where ID='$id'";
   $getStatusRun=sqlsrv_query($conntest,$getStatus);
   if($getStatusRow=sqlsrv_fetch_array($getStatusRun))
   {
      $examination = $getStatusRow['Examination'];
    // $examination="June 2024";
      $status = $getStatusRow['Status'];
      $result = $getStatusRow['Result'];
      $IDNo = $getStatusRow['IDNo'];
      $dateofissue = $getStatusRow['IssueDate']->format('d-m-Y');
      $failDate = $getStatusRow['failDate']->format('d-m-Y');
      $result1 = "SELECT  * FROM Admissions where IDNo='$IDNo'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
       $UniRollNo= trim($row['UniRollNo']);
       $img= $row['Image'];
       $name = $row['StudentName'];
       $father_name = $row['FatherName'];
       $mother_name = $row['MotherName'];
       $course = $row['Course'];
       $email = $row['EmailID'];
       $batch = $row['Batch'];
        $gender = $row['Sex'];
       $college = $row['CollegeName'];
      }
   }



   if($gender=='Male')
   {

$sod=' Son of';
$mr='Mr.';

   }else
   {
$sod=' Daughter of';
$mr='Ms.';

   }
class CustomPDF extends FPDF {
    function Footer() {

       
    }   
} 
$pdf = new CustomPDF();

$pdf->AliasNbPages(); // Enable page numbering
$Y=45;
$fontSize=14;
$pdf->AddPage('P', 'A4');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Times', '', $fontSize);
// $pdf->SetXY(20, $Y+50);
// $pdf->MultiCell(60, 10, "Candidate's Name:", 0, 'L');
// $pdf->SetFont('Times', 'B', $fontSize);
// $pdf->SetXY(80, $Y+50);
// $pdf->MultiCell(100, 10, ': '.ucwords(strtolower($name)), 0, 'L');
// $pdf->SetFont('Times', '', $fontSize);
// $pdf->SetXY(20, $Y+60);
// $pdf->MultiCell(60, 10, 'Father`s Name:', 0, 'L');
// $pdf->SetXY(80, $Y+60);
// $pdf->SetFont('Times', 'B', $fontSize);
// $pdf->MultiCell(100, 10, ': '.ucwords(strtolower($father_name)), 0, 'L');

// $pdf->SetXY(20, $Y+70);
// $pdf->SetFont('Times', '', $fontSize);
// $pdf->MultiCell(60, 10, 'Mother`s Name:', 0, 'L');
// $pdf->SetXY(80, $Y+70);
// $pdf->SetFont('Times', 'B', $fontSize);
// $pdf->MultiCell(100, 10, ': '.ucwords(strtolower($mother_name)), 0, 'L');

// $pdf->SetXY(20, $Y+80);
// $pdf->SetFont('Times', '', $fontSize);
// $pdf->MultiCell(60, 10, 'Roll No:', 0, 'L');
// $pdf->SetXY(80, $Y+80);
// $pdf->SetFont('Times', 'B', $fontSize);
// $pdf->MultiCell(60, 10, ': '.$UniRollNo, 0, 'L');
$pdf->SetFont('Times', '', $fontSize);

$dateString = $examination;
$parts = explode(" ", $dateString);
$year = $parts[1];


//Guru Kashi University has no objection to his/her continuing studies at another University/Board established by law.          



$pdf->SetXY(15, $Y+40);
$pdf->MultiCell(180, 10, 'It is certified that '.$mr .ucwords(strtoupper($name)). $sod.' Sh '.ucwords(strtoupper($father_name)).' was enrolled vide enrolment number '.$UniRollNo.' in '.ucwords(strtoupper($course)).' branch as a regular student of the university from '.$batch.' to '.$year.'.', 0, 'J');


$pdf->SetXY(15, $Y+85);
$pdf->MultiCell(180, 10, 'Guru Kashi University has no objection to his/her continuing studies at another University/Board established by law.           
', 0, 'J');

$pdf->SetXY(20, $Y+160);
$yrdata= strtotime($dateofissue);

$dateofissue=date('d F Y', $yrdata);
$pdf->MultiCell(100, 10, 'Date of issue: '.$dateofissue, 0, 'L');
$pdf->SetXY(120, $Y+160);
$pdf->MultiCell(70, 10, 'Dy. Dean (Academics)', 0, 'R');
$pdf->Output();
?>
