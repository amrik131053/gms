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
      $result1 = "SELECT  * FROM Admissions where IDNo='$IDNo'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
       $UniRollNo= $row['UniRollNo'];
       $img= $row['Image'];
       $name = $row['StudentName'];
       $father_name = $row['FatherName'];
       $mother_name = $row['MotherName'];
       $course = $row['Course'];
       $email = $row['EmailID'];
       $batch = $row['Batch'];
       $college = $row['CollegeName'];
      }
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
$pdf->SetXY(20, $Y+50);
$pdf->MultiCell(60, 10, "Candidate's Name:", 0, 'L');
$pdf->SetFont('Times', 'B', $fontSize);
$pdf->SetXY(80, $Y+50);
$pdf->MultiCell(60, 10, ': '.ucwords(strtolower($name)), 0, 'L');
$pdf->SetFont('Times', '', $fontSize);
$pdf->SetXY(20, $Y+60);
$pdf->MultiCell(60, 10, 'Father`s Name:', 0, 'L');
$pdf->SetXY(80, $Y+60);
$pdf->SetFont('Times', 'B', $fontSize);
$pdf->MultiCell(60, 10, ': '.ucwords(strtolower($father_name)), 0, 'L');

$pdf->SetXY(20, $Y+70);
$pdf->SetFont('Times', '', $fontSize);
$pdf->MultiCell(60, 10, 'Mother`s Name:', 0, 'L');
$pdf->SetXY(80, $Y+70);
$pdf->SetFont('Times', 'B', $fontSize);
$pdf->MultiCell(60, 10, ': '.ucwords(strtolower($mother_name)), 0, 'L');

$pdf->SetXY(20, $Y+80);
$pdf->SetFont('Times', '', $fontSize);
$pdf->MultiCell(60, 10, 'Roll No:', 0, 'L');
$pdf->SetXY(80, $Y+80);
$pdf->SetFont('Times', 'B', $fontSize);
$pdf->MultiCell(60, 10, ': '.$UniRollNo, 0, 'L');
$pdf->SetFont('Times', '', $fontSize);
$pdf->SetXY(20, $Y+90);
$pdf->MultiCell(172, 10, 'It is informed that Guru Kashi University has no objection to continue his/her studies at another University.', 0, 'L');

$pdf->SetXY(20, $Y+110);
$pdf->MultiCell(50, 10, 'He/She last appeared in', 0, 'L');

$pdf->SetXY(70, $Y+110);
$pdf->SetFont('Times', 'B', $fontSize);
$pdf->MultiCell(120, 10, ': '.$course, 0, 'L');
$pdf->SetFont('Times', '', $fontSize);
$pdf->SetXY(20, $Y+120);
$pdf->MultiCell(85, 10, 'Examination of this Univerisity held in', 0, 'L');

$x=$pdf->GetX();
$y=$pdf->GetY();
$pdf->SetXY(99, $Y+120);
$pdf->SetFont('Times', 'B', $fontSize);
$len=strlen($examination);
$pdf->MultiCell(7+$len*2.15, 10, $examination, 0, 'L');

$YY=($len*1.98)+106.2;
$pp=0;
$ppp=9;

if($len==10)
{
    $pp=3;
    $ppp=5.5;
}
if($len==13)
{
    $pp=-1;
    $ppp=9.5;
}
if($len==11)
{
    $pp=1;
    $ppp=7.6;
}
if($len==8)
{
    $pp=1;
    $ppp=7.6;
}

// if($len==11)
// {
//     $YY=128;
// }
// if($len==12)
// {
//     $YY=130;
// }
// if($len==13)
// {
//     $YY=132;
// }
// elseif($len==)
// {
//     $YY=142;
// }
// elseif($len>12)
// {
    // $YY=142;
// }
$pdf->SetXY($YY-$pp, $Y+120);
$pdf->SetFont('Times', '', $fontSize);
$pdf->MultiCell(11, 10,'and', 0, 'L');
$pdf->SetFont('Times', 'B', $fontSize);
$pdf->SetXY($YY+$ppp, $Y+120);
$pdf->MultiCell(37, 10,$result.'.', 0, 'L');
$pdf->SetXY(20, $Y+160);

$yrdata= strtotime($dateofissue);

$dateofissue=date('d F Y', $yrdata);
$pdf->MultiCell(100, 10, 'Date of issue: '.$dateofissue, 0, 'L');
$pdf->SetXY(120, $Y+160);
$pdf->MultiCell(70, 10, 'Dy. Dean (Academics)', 0, 'R');
$pdf->Output();
?>
