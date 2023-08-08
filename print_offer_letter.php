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

// Create a new CustomPDF instance
$pdf = new CustomPDF();
$pdf->AliasNbPages(); // Enable page numbering

 
$pdf->AddPage('P', 'A4');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(85, 1);
 $sel=array();
   $sel=$_GET['id_array'];
   $course_table[]=5;
    $id=explode(",",$sel);
    $applicables="";
    $hostel="";
    $concession="";
    $after_concession="";
foreach ($id as $key => $value) {

$get_student_details="SELECT * FROM offer_latter where id='$value'";
$get_student_details_run=mysqli_query($conn,$get_student_details);
if ($row=mysqli_fetch_array($get_student_details_run))
 {
    $name=$row['Name'];
    $FatherName=$row['FatherName'];
    $MotherName=$row['MotherName'];
    $Course=$row['Course'];
    $State=$row['State'];
    $Session=$row['Session'];
    $Duration=$row['Duration'];
    $Consultant_id=$row['Consultant_id'];
    $Lateral=$row['Lateral'];
    $fee_details="SELECT * FROM master_fee where consultant_id='$Consultant_id'";
$fee_details_run=mysqli_query($conn,$fee_details);
if ($row_fee=mysqli_fetch_array($fee_details_run))
 {
    $applicables=$row_fee['applicables'];
    $hostel=$row_fee['hostel'];
    $concession=$row_fee['concession'];
    $after_concession=$row_fee['after_concession'];
 }

    
}


$pdf->SetFont('Times', 'B', 15);
$pdf->SetXY(10, 30);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(190, 10, 'TO WHOM IT MAY CONCERN', 0, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->MultiCell(190, 8, 'It is certify Guru Kashi University, Talwandi Sabo was established by  the act of the legislature of the state of Punjab ,under the GURU KASHI UNIVERSITY ACT 2011 (Punjab Act no 37 of 2011),to provide education at all levels in all disciplines of higher education. Guru Kashi University is a government recognized University with the right to confer degree as per the section 2(f) and 22(l) of the UGC Act, 1956. ',0, 'L');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y);
$pdf->MultiCell(190, 8, 'It is also certified that '.$name.' '.$FatherName.' '.$State.'  has been admitted in our University for pursuing his/her '.$Course.' course in session '.$Session.'. ',0, 'L');
$pdf->SetFont('Times', 'B', 10);
$pdf->MultiCell(190, 8, 'Course Name- '.$Course,0, 'L');
$pdf->MultiCell(190, 8, 'Applicables Fees- '.$applicables,0, 'L');
$pdf->MultiCell(190, 8, 'Hostel Fee- '.$hostel,0, 'L');
$pdf->MultiCell(190, 8, 'University Concession- '.$concession,0, 'L');
$pdf->MultiCell(190, 8, 'Fee after Concession (Annual)- '.$after_concession,0, 'L');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y);
$pdf->Cell(90, 10, 'Course/Semester', 1, 1, 'C');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 10, 'Fees (In Rs.)', 1, 1, 'C');
$X=$pdf->GETX();
$Y=$pdf->GETY();

if ($Lateral=='Yes')
 {
$Duration=$Duration-1;    // code...
}

$numberofsem=$Duration*2;
for ($i=1; $i <=$numberofsem ; $i++)
{ 
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(90, 10, $Course.' '.$i, 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 10, 'Fees (In Rs.)', 1, 1, 'L');
$Y=$Y+10;
}



$pdf->MultiCell(190, 8, 'Please use the following Bank Account details to transfer the Fee.',0, 'L');
$pdf->SetXY($X, $Y+30);

$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y);
$pdf->Cell(90, 10, 'BANK NAME', 1, 1, 'C');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 10, 'HDFC Bank', 1, 1, 'C');
$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 10, 'BANK ADDRESS', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 10, 'Talwandi Sabo, Punjab -151302', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 10, 'ACCOUNT NAME', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 10, 'Guru Kashi University', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 10, 'ACCOUNT NUMBER', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 10, '50100033779951', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 10, 'SWIFT CODE', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 10, 'HDFCINBB', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 10, 'IFSC / MICR', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 10, 'HDFC0001322/151240102', 1, 1, 'L');


$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X,10+$Y);

$pdf->SetFont('Times', 'B', 9);
$pdf->MultiCell(190, 8, 'Thanks and Regards,',0, 'R');

$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X,$Y);

$pdf->SetFont('Times', '', 9);
$pdf->MultiCell(190, 8, 'Director Admissions,',0, 'R');
$pdf->SetXY($X,$Y+5);
$pdf->MultiCell(190, 8, 'Guru Kashi University',0, 'R');
$pdf->SetXY($X,$Y+10);
$pdf->MultiCell(190, 8, 'Talwandi Sabo',0, 'R');
// Output the PDF

$pdf->AddPage('P', 'A4');
$pdf->SetXY(85, 1);
}
$pdf->Output();
?>
