<?php
session_start();
$EmployeeID=$_SESSION['usr'];
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

        $PrintDatew=$row['PrintDate1'];
    if($PrintDatew!='')

      {$PrintDate = date("d-m-Y", strtotime($PrintDatew));  }
  else
  {
    $PrintDate='';
  }
      
  $Lateral=$row['Lateral'];
  $Duration=$row['Duration'];
  if($Lateral=='Yes')
  {
    $Leet_Duration="Lateral Entry";
    $Duration=$Duration-1;
  }
  else
  {
    $Leet_Duration="";
  }

  
    $Months=$row['months'];
    $Consultant_id=$row['Consultant_id'];
    $Nationality=$row['Nationality'];
   $get_country="SELECT name FROM countries  where id='$Nationality'";
                  $get_country_run=mysqli_query($conn,$get_country);
                  if($row=mysqli_fetch_array($get_country_run))
                  {
                    if ($row['name']=='India') {
                       
$NationalityName='Indian';
                    }else
                    {
$NationalityName=$row['name'];

                    }
                   }

    



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
}
elseif($Duration=='6')
{
    $Duration="Six Years";
}


if($Months>0)
{
    if($Months==6)
    {
    $mduration= 'Six Months';
   }
}
else
{
     $mduration='';
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
// $pdf->SetXY(155, 100);


$pdf->Image('offer_letter.jpeg', 0, 0, 210);
$pdf->SetFont('Times', 'B', 15);
$pdf->SetFont('Times', 'B', 11);
$pdf->SetXY(155, 49);
if($PrintDate!='')
{
$pdf->MultiCell(45, 10,$PrintDate, 0, 'C');
}
else
{
$pdf->MultiCell(45, 10, $today.'-'.$month.'-'.$year, 0, 'C');
}

$pdf->SetXY(25, 49);
$pdf->MultiCell(45, 10, 'GKU/ADM/2023/'.$value, 0, 'L');
// $pdf->SetXY(10, 60);
$pdf->SetXY(10, 60);
$pdf->SetTextColor(0, 0, 0);
//$pdf->MultiCell(190, 10, 'TO WHOM IT MAY CONCERN', 0, 'C');
$pdf->MultiCell(190, 10, 'BONAFIDE CERTIFICATE', 0, 'C');
$pdf->SetFont('Times', '', 12);

//The Admissions will be confirmed after submission of all original eligibility documents (for verification purpose only) and Ist installment of fee at University.
$pdf->MultiCell(190, 6, 'It is certified that '.$ms.' '.$name.' '.$ge.' '.$FatherName.' an '.$NationalityName.' Citizen is admitted in '.$courseName.' '.$Duration.' '.$mduration.''.$Leet_Duration.' programme at Guru Kashi University, Talwandi Sabo, Bathinda , Punjab,India during session '.$Session.'. The student will abide by  university rules and regulations . This letter is valid for admission and is being issued with the approval of Worthy Vice-Chancellor. Further University will assist in placement to eligible Candidate.',0, 'J');
$pdf->MultiCell(190, 6, 'It is certified that Guru Kashi University, Talwandi Sabo established by the Act of the legislature of the state of Punjab, under the "GURU KASHI UNIVERSITY ACT 2011" (Punjab Act no 37 of 2011), to provide education at all levels in all disciplines of higher education. Guru Kashi University is a approved by UGC, New Delhi University under section 2f and empowered to confer degrees as per the section 22(1) of the UGC Act,1956.The University is accredited  with Grade A++ by National Assessment & Accreditation Council (NAAC).',0, 'J');
 //This Letter is valid for Two weeks only.
$X=$pdf->GETX();
$Y=$pdf->GETY();
// $pdf->SetXY($X, $Y+1.5);
// $pdf->SetFont('Times', '', 10);
// $pdf->MultiCell(190, 8, 'Please use the following Bank Account details to transfer the Fee.',0, 'L');
// $pdf->SetFont('Times', '', 11);
// $X=$pdf->GETX();
// $Y=$pdf->GETY();

// $pdf->SetXY($X, $Y+30);

// $pdf->SetXY($X, $Y);
// $pdf->Cell(90, 7, 'BANK NAME', 1, 1, 'L');
// $pdf->SetXY(90+$X, $Y);
// $pdf->Cell(100, 7, 'Indian Bank', 1, 1, 'L');
// $X=$pdf->GETX();
// $Y=$pdf->GETY();

// $pdf->SetFont('Times', '', 11);
// $pdf->Cell(90, 7, 'BANK ADDRESS', 1, 1, 'L');
// $pdf->SetXY(90+$X, $Y);
// $pdf->Cell(100, 7, 'Fatehgarh Nuabad ,Talwandi Sabo, Punjab -151302', 1, 1, 'L');

// $X=$pdf->GETX();
// $Y=$pdf->GETY();

// $pdf->SetFont('Times', '', 11);
// $pdf->Cell(90, 7, 'ACCOUNT NAME', 1, 1, 'L');
// $pdf->SetXY(90+$X, $Y);
// $pdf->Cell(100, 7, 'Guru Kashi University', 1, 1, 'L');

// $X=$pdf->GETX();
// $Y=$pdf->GETY();

// $pdf->SetFont('Times', '', 11);
// $pdf->Cell(90, 7, 'ACCOUNT NUMBER', 1, 1, 'L');
// $pdf->SetXY(90+$X, $Y);
// $pdf->Cell(100, 7, '6058205486', 1, 1, 'L');

// $X=$pdf->GETX();
// $Y=$pdf->GETY();

// $pdf->SetFont('Times', '', 11);
// $pdf->Cell(90, 7, 'IFSC CODE', 1, 1, 'L');
// $pdf->SetXY(90+$X, $Y);
// $pdf->Cell(100, 7, 'IDIB000F009', 1, 1, 'L');

// $X=$pdf->GETX();
// $Y=$pdf->GETY();

// $pdf->SetFont('Times', '', 11);
// $pdf->Cell(90, 7, 'IFSC / MICR', 1, 1, 'L');
// $pdf->SetXY(90+$X, $Y);
// $pdf->Cell(100, 7, 'HDFC0001322/151240102', 1, 1, 'L');


$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X,10+$Y);
 
// $pdf->SetFont('Times', 'B', 9);
// $pdf->MultiCell(190, 8, 'Thanks and Regards,',0, 'R');

$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X,$Y+30);
$pdf-> Image('dist/img/sign-offer.png',$X+159, $Y+20,24,20.5);
$pdf-> Image('dist/img/sign.png',$X+155, $Y+5,30,26.5);
// $pdf->Image('dist/img/sign.png', $X+155, $Y+1, 30);
$pdf->SetFont('Times', 'B', 11);
$pdf->MultiCell(190, 8, 'Director Admissions',0, 'R');
// $pdf->SetXY($X,$Y+5);
// $pdf->MultiCell(190, 8, 'Guru Kashi University',0, 'R');
// $pdf->SetXY($X,$Y+10);
// $pdf->MultiCell(190, 8, 'Talwandi Sabo',0, 'R');
// Output the PDF

// $pdf->AddPage('P', 'A4');
// $pdf->SetXY(85, 1);

}
$pdf->Output();
?>
