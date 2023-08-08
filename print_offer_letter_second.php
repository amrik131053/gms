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

$get_student_details="SELECT * FROM offer_latter where id='$value'";
$get_student_details_run=mysqli_query($conn,$get_student_details);
if ($row=mysqli_fetch_array($get_student_details_run))
 {
    $name=$row['Name'];
    $FatherName=$row['FatherName'];
    $MotherName=$row['MotherName'];
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
    $Nationality=$row['Nationality'];
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
if ($Duration=='1') {
    $Duration="One Years";
}
elseif($Duration=='2')
{
$Duration="Two Years";
}elseif($Duration=='3')
{
    $Duration="Three Years";
}elseif($Duration=='4')
{
   $Duration="Four Years"; 
}
elseif($Duration=='5')
{
    $Duration="Five Years";
}elseif($Duration=='6')
{
    $Duration="Six Years";
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

$pdf->SetFont('Times', 'B', 15);
$pdf->SetXY(10, 30);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(190, 10, 'TO WHOM IT MAY CONCERN', 0, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->MultiCell(190, 8, 'It is certified that '.$ms.' '.$name.' '.$ge.' '.$FatherName.' an '.$Nationality.' Citizen is provisionally admitted in '.$courseName.' '.$Duration.' programme at Guru Kashi University, Talwandi Sabo, Bathinda , and Punjab, India during session '.$Session.' . The Admissions will be confirmed after submission of all  eligibility documents in original (for verification purpose only) and Ist installment of fee at University. The student will abide by  university rules and regulations . This letter is valid for Admission and is being with the approval of worthy Vice-chancellor. Further University will provide placement of eligibility Candidate only . This Letter is valid for Two weeks only.',0, 'J');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y+3);
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 8, 'Please use the following Bank Account details to transfer the Fee.',0, 'L');
$pdf->SetFont('Times', '', 11);
$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetXY($X, $Y+30);

$pdf->SetXY($X, $Y);
$pdf->Cell(90, 7, 'BANK NAME', 1, 1, 'C');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'HDFC Bank', 1, 1, 'C');
$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 11);
$pdf->Cell(90, 7, 'BANK ADDRESS', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'Talwandi Sabo, Punjab -151302', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 11);
$pdf->Cell(90, 7, 'ACCOUNT NAME', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'Guru Kashi University', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 11);
$pdf->Cell(90, 7, 'ACCOUNT NUMBER', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, '50100033779951', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 11);
$pdf->Cell(90, 7, 'SWIFT CODE', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'HDFCINBB', 1, 1, 'L');

$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetFont('Times', '', 11);
$pdf->Cell(90, 7, 'IFSC / MICR', 1, 1, 'L');
$pdf->SetXY(90+$X, $Y);
$pdf->Cell(100, 7, 'HDFC0001322/151240102', 1, 1, 'L');


$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X,10+$Y);

// $pdf->SetFont('Times', 'B', 9);
// $pdf->MultiCell(190, 8, 'Thanks and Regards,',0, 'R');

$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X,$Y+30);

$pdf->SetFont('Times', 'B', 11);
$pdf->MultiCell(190, 8, 'Director Admissions',0, 'R');
// $pdf->SetXY($X,$Y+5);
// $pdf->MultiCell(190, 8, 'Guru Kashi University',0, 'R');
// $pdf->SetXY($X,$Y+10);
// $pdf->MultiCell(190, 8, 'Talwandi Sabo',0, 'R');
// Output the PDF

$pdf->AddPage('P', 'A4');
$pdf->SetXY(85, 1);
}
$pdf->Output();
?>
