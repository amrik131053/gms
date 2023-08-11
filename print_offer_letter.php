<?php
require('fpdf/fpdf.php');
include "connection/connection.php";
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
    $ordinalSuffix = getOrdinalSuffix($today);
// Create a new CustomPDF instance
$pdf = new CustomPDF();
$pdf->AliasNbPages(); // Enable page numbering

 

 $sel=array();
   $sel=$_GET['id_array'];
   $course_table[]=5;
    $id=explode(",",$sel);
    $applicables="";
    $hostel="";
    $concession="";
    $after_concession="";

 function getOrdinalSuffix($day) {
        if ($day >= 11 && $day <= 13) {
            return "th";
        } else {
            $lastDigit = $day % 10;
            switch ($lastDigit) {
                case 1:
                    return "st";
                case 2:
                    return "nd";
                case 3:
                    return "rd";
                default:
                    return "th";
            }
        }
    }


foreach ($id as $key => $value) {
$pdf->AddPage('P', 'A4');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(85, 1);
$get_student_details="SELECT * FROM offer_latter where id='$value'";
$get_student_details_run=mysqli_query($conn,$get_student_details);
if ($row=mysqli_fetch_array($get_student_details_run))
 {
    $name=$row['Name'];
    $FatherName=$row['FatherName'];
    // $MotherName=$row['MotherName'];
    $Course=$row['Course'];
    $Gender=$row['Gender'];
    $Class_RollNo=$row['Class_RollNo'];
$get_course_name="SELECT Course FROM MasterCourseCodes where CourseID='$Course'";
$get_course_name_run=sqlsrv_query($conntest,$get_course_name);
if ($row_course_name=sqlsrv_fetch_array($get_course_name_run)) {

    $courseName=$row_course_name['Course'];
}

    $State=$row['State'];
    $Session=$row['Session'];
    $Duration=$row['Duration'];
    $Consultant_id=$row['Consultant_id'];
    $Lateral=$row['Lateral'];
    $fee_details="SELECT * FROM master_fee where consultant_id='$Consultant_id' and Lateral='$Lateral'";
$fee_details_run=mysqli_query($conn,$fee_details);
if ($row_fee=mysqli_fetch_array($fee_details_run))
 {
    $applicables=$row_fee['applicables'];
    $hostel=$row_fee['hostel'];
    $concession=$row_fee['concession'];
    $after_concession=$row_fee['after_concession'];
 }
 else
 {
     $applicables="0";
    $hostel="0";
    $concession="0";
    $after_concession="0";
 }


    
}

$ge1="son";
$ge="D/o";
$ms="Ms.";    
$ms1="Mr.";    

  if ($Gender=='Male') 
{
$ge="S/o"; 
$ms="Mr.";    // code...
} 
else{
$ge="daughter";
$ms="Ms.";    // code...
   // code...

}
$pdf->Image('offer_letter.jpeg', 0, 0, 210);
$pdf->SetFont('Times', 'B', 11);
$pdf->SetXY(155, 49);
$pdf->MultiCell(45, 10, $today.'-'.$month.'-'.$year, 0, 'C');
$pdf->SetXY(25, 49);
$pdf->MultiCell(45, 10, 'GKU/ADMF/2023/'.$value, 0, 'L');
$pdf->SetXY(10, 60);
$pdf->SetFont('Times', 'B', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->MultiCell(190, 10, 'TO WHOM IT MAY CONCERN', 0, 'C');

$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 6, 'It is certified that Guru Kashi University, Talwandi Sabo established by the Act of the legislature of the state of Punjab, under the "GURU KASHI UNIVERSITY ACT 2011" (Punjab Act no 37 of 2011), to provide education at all levels in all disciplines of higher education. Guru Kashi University is a approved by UGC, New Delhi University under section 2f and empowered to confer degrees as per the section 22(1) of the UGC Act,1956. ',0, 'J');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y+1.5);
$pdf->MultiCell(190, 6, 'It is further certified that '.$ms.' '.$name.' '.$ge.' '.$FatherName.' has been admitted in our university for  his/her '.$courseName.' ('.$Duration.' Years) on Class Roll No. '.$Class_RollNo.'. The candidate must fullfill the eligibility qualifications as per university norms and the candidate will be selected for the on the basis of as per merit ',0, 'J');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y+1.5);
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 6, 'The Fee Structure for '.$courseName.' ('.$Duration.' Years)  as is given below: ',0, 'L');
$pdf->SetFont('Times', '', 10);
  // It is also certified that '.$ms.' '.$name.' '.$ge.' '.$FatherName.' R/O '.$State.'  has been admitted in our University for pursuing his/her '.$courseName.' course in session '.$Session.'.
// $pdf->SetFont('Times', 'B', 10);
// $pdf->MultiCell(190, 6, 'Course Name- '.$courseName,0, 'L');
// $pdf->MultiCell(190, 6, 'Applicables Fees- '.$applicables,0, 'L');
// $pdf->MultiCell(190, 6, 'Hostel Fee- '.$hostel,0, 'L');
// $pdf->MultiCell(190, 6, 'University Concession- '.$concession,0, 'L');
// $pdf->MultiCell(190, 6, 'Fee after Concession (Annual)- '.$after_concession,0, 'L');
$X=$pdf->GETX();
$Y=$pdf->GETY()-10;


$sem=1;
$numberofsem=$Duration;
if ($Lateral=='Yes')
 {
$Duration=$Duration-1;
$sem=2; 
$numberofsem=$numberofsem;   // code...
}
$fee=$after_concession/2;
for ($i=$sem; $i <=$numberofsem ; $i++)
{ 

if ($i==1) {
   $ss="First";
   $session_split='2023-24';
}elseif ($i==2) 
{
   $ss="Second";
      $session_split='2024-25';
}elseif ($i==3) 
{
   $ss="Third";
      $session_split='2025-26';
}elseif ($i==4) 
{
   $ss="Fourth";
      $session_split='2026-27';
}elseif ($i==5)
 {
   $ss="Fifth";
      $session_split='2027-28';
}elseif ($i==6)
 {
   $ss="Sixth";
      $session_split='2028-29';
}

// $session_split=split ("-", $ip);

    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetXY($X, $Y+12);
$pdf->Cell(190, 4, $ss .' Year Tuition Fee '.$session_split, 1, 1, 'C');
$pdf->SetFont('Times', 'B', 10);
$X=$pdf->GETX();
$Y=$pdf->GETY();
$ordinalSuffix = getOrdinalSuffix($i);
$pdf->SetFont('Times', '', 8);
$pdf->Cell(160, 4, '  '.$ss.''.' YEAR Tuition Fee', 1, 1, 'L');
$pdf->Cell(160, 4, '  Hostel Charges (food and accommodation)', 1, 1, 'L');
$pdf->Cell(160, 4, '  Scholarship', 1, 1, 'L');
$pdf->SetFont('Times', 'B', 8);
$pdf->Cell(160, 4, '  Total '.$ss.' Year Fee (After scholarship)', 1, 1, 'L');
$pdf->SetFont('Times', '', 8);
$pdf->SetXY(160+$X, $Y);
$pdf->Cell(30, 4, $applicables.'/-', 1, 1, 'C');
$pdf->SetXY(160+$X, $Y+4);
$pdf->Cell(30, 4, $hostel.'/-', 1, 1, 'C');
$pdf->SetXY(160+$X, $Y+8);
$pdf->Cell(30, 4, $concession.'/-', 1, 1, 'C');
$pdf->SetXY(160+$X, $Y+12);
$pdf->SetFont('Times', 'B', 8);
$pdf->Cell(30, 4, $after_concession.'/-', 1, 1, 'C');
$pdf->SetFont('Times', '', 8);
$Y=$Y+4;

}
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 8, ' Fee will be transfer RTGS/NEFT. University Account detail given below:',0, 'L');
$pdf->SetFont('Times', 'B', 9);
$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetXY($X, $Y);
$pdf->MultiCell(190, 4, 'BANK NAME    :  Indian Bank', 0, 'L');
$pdf->SetXY($X, $Y+4);
$pdf->Cell(190, 4, 'AccountNo          : 6058205486', 0, 'L');

$pdf->SetXY($X, $Y+8);
$pdf->Cell(190, 4, 'IFSC Code          : IDIB000F009', 0, 'L');
$pdf->SetXY($X, $Y+12);
$pdf->Cell(190, 4, 'Branch                : Fatehgarh Naubad, Talwandi Sabo', 0, 'L');
$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf-> Image('dist/img/sign-offer.png',$X+162, $Y+5,24,20.5);
$pdf-> Image('dist/img/sign.png',$X+157, $Y-15,30,26.5);
$pdf->SetXY($X,10+$Y);
$pdf->MultiCell(190, 8, 'Thanks and Regards,',0, 'R');
$pdf->SetFont('Times', 'B', 9);

$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X,$Y);

$pdf->MultiCell(190, 8, 'Director Admissions,',0, 'R');
$pdf->SetFont('Times', '', 9);
$pdf->SetXY($X,$Y+5);
$pdf->MultiCell(190, 8, 'Guru Kashi University',0, 'R');
$pdf->SetXY($X,$Y+10);
$pdf->MultiCell(190, 8, 'Talwandi Sabo',0, 'R');
// Output the PDF

// $pdf->AddPage('P', 'A4');
// $pdf->SetXY(85, 1);
}
$pdf->Output();
?>
