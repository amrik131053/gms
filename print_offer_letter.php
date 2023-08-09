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
    $fee_details="SELECT * FROM master_fee where consultant_id='$Consultant_id'";
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
$pdf->SetFont('Times', 'B', 15);
$pdf->SetXY(10, 60);
$pdf->SetTextColor(0, 0, 0);

$pdf->MultiCell(190, 10, 'TO WHOM IT MAY CONCERN', 0, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->MultiCell(190, 6, 'It is certify Guru Kashi University, Talwandi Sabo was established by  the act of the legislature of the state of Punjab ,under the GURU KASHI UNIVERSITY ACT 2011 (Punjab Act no 37 of 2011),to provide education at all levels in all disciplines of higher education. Guru Kashi University is a government recognized University with the right to confer degree as per the section 2(f) and 22(l) of the UGC Act, 1956. ',0, 'J');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y+1.5);
$pdf->MultiCell(190, 6, 'It is also certified that '.$ms.' '.$name.' '.$ge.' '.$FatherName.' R/O '.$State.'  has been admitted in our University for pursuing his/her '.$courseName.' course in session '.$Session.'. ',0, 'J');
$pdf->SetFont('Times', 'B', 10);
$pdf->MultiCell(190, 6, 'Course Name- '.$courseName,0, 'L');
$pdf->MultiCell(190, 6, 'Applicables Fees- '.$applicables,0, 'L');
$pdf->MultiCell(190, 6, 'Hostel Fee- '.$hostel,0, 'L');
$pdf->MultiCell(190, 6, 'University Concession- '.$concession,0, 'L');
$pdf->MultiCell(190, 6, 'Fee after Concession (Annual)- '.$after_concession,0, 'L');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y);
$pdf->Cell(160, 10, 'Course/Semester', 1, 1, 'C');
$pdf->SetXY(160+$X, $Y);
$pdf->Cell(30, 10, 'Fees (In Rs.)', 1, 1, 'C');
$X=$pdf->GETX();
$Y=$pdf->GETY();

$sem=1;
$numberofsem=$Duration*2;
if ($Lateral=='Yes')
 {
$Duration=$Duration-1;
$sem=3; 
$numberofsem=$numberofsem;   // code...
}
$fee=$after_concession/2;
for ($i=$sem; $i <=$numberofsem ; $i++)
{ 
$ordinalSuffix = getOrdinalSuffix($i);
$pdf->SetFont('Times', '', 9);
$pdf->Cell(160, 7, $courseName.'  '.$i.''.$ordinalSuffix, 1, 1, 'L');
$pdf->SetXY(160+$X, $Y);
$pdf->Cell(30, 7, $fee.'/-', 1, 1, 'L');
$Y=$Y+7;
}
$pdf->SetFont('Times', 'B', 10);
$pdf->MultiCell(190, 8, 'Please use the following Bank Account details to transfer the Fee.',0, 'L');
$pdf->SetFont('Times', '', 10);
$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetXY($X, $Y+30);

$pdf->SetXY($X, $Y);
$pdf->Cell(90, 7, 'BANK NAME', 1, 1, 'C');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'HDFC Bank', 1, 1, 'C');
$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 7, 'BANK ADDRESS', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'Talwandi Sabo, Punjab -151302', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 7, 'ACCOUNT NAME', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'Guru Kashi University', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 7, 'ACCOUNT NUMBER', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, '50100033779951', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 7, 'SWIFT CODE', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'HDFCINBB', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 9);
$pdf->Cell(90, 7, 'IFSC / MICR', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'HDFC0001322/151240102', 1, 1, 'L');


$X=$pdf->GETX();
$Y=$pdf->GETY();
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
