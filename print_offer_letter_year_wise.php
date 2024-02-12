<?php
session_start();
$EmployeeID=$_SESSION['usr'];
require('fpdf/fpdf.php');
include "connection/connection.php";
date_default_timezone_set("Asia/Calcutta");
$today1=date('Y-m-d H:i:s');
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
   $yearFromUI=$_GET['years'];
   $typeFromUII=$_GET['type'];
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
$get_student_details="SELECT * FROM offer_latter where id='$value' AND generate=1";
$get_student_details_run=mysqli_query($conn,$get_student_details);
if ($row=mysqli_fetch_array($get_student_details_run))
 {
    $name=$row['Name'];
    $FatherName=$row['FatherName'];
     //$course1=$row['course'];
    $Course=$row['Course'];
    $Gender=$row['Gender'];
    $Class_RollNo=$row['Class_RollNo'];

    $District=$row['District'];
    $State=$row['State'];
    $Session=$row['Session'];
    //  $PrintDate=$row['PrintDate'];
    //  $PrintDatew=$row['PrintDate'];
     $Batch=$row['Batch'];
    
     $getChecksql11 = "SELECT * FROM offer_latter_track  Where LatterID='$value' and Year='$yearFromUI'";
$getChecksqlRun11=mysqli_query($conn,$getChecksql11);
if($getChecksqlRun11rrow = mysqli_fetch_array($getChecksqlRun11))
{
   $PrintDate1=$getChecksqlRun11rrow["PrintDate"];  
   $PrintDatew=date("d-m-Y", strtotime($PrintDate1));
    $RefNo=$getChecksqlRun11rrow["RefNo"];     
}
else
{

 $getReffrenceNumbersql = "SELECT * FROM offer_latter_number  Where Batch='$year'";
     $getReffrenceNumberstmt = mysqli_query($conn,$getReffrenceNumbersql);  
     
         if($getReffrenceNumberrow = mysqli_fetch_array($getReffrenceNumberstmt) )
     {    
                  
                     $ReffrenceNumber=$getReffrenceNumberrow["RefNumber"]+1;
                  $RefNo='GKU/ADMF/'.$year.'/'.$ReffrenceNumber; 
                   $PrintDatew=date('Y-m-d');  

                



 $upd11="INSERT into  offer_latter_track (LatterID,Year,PrintDate,RefNo,PrintBy)VALUES('$value','$yearFromUI','$today1','$RefNo','$EmployeeID')";
  mysqli_query($conn,$upd11);

  $upd1="UPDATE offer_latter_number SET RefNumber='$ReffrenceNumber' Where Batch='$year'";
  mysqli_query($conn,$upd1);

     }

 }


$Ref=$RefNo;
 
  $Duration=$row['Duration'];
  $Duration_leet=$row['Duration'];

  $Lateral=$row['Lateral'];
  if($Lateral=='Yes')
  {
    $Duration_leet=$Duration_leet-1;
    $Leet_Duration="".$Duration_leet." Years Lateral Entry)";
  }
  else{
    $Leet_Duration=$Duration." Years)";
  }

     $Months=$row['months'];
    $Consultant_id=$row['Consultant_id'];

    $get_course_name="SELECT Course FROM MasterCourseCodes where CourseID='$Course'";
$get_course_name_run=sqlsrv_query($conntest,$get_course_name);
if ($row_course_name=sqlsrv_fetch_array($get_course_name_run)) {

    $courseName=$row_course_name['Course'];
}

    $fee_details="SELECT * FROM master_fee where consultant_id='$Consultant_id' and Lateral='$Lateral' ANd course='$Course' ANd batch='$Batch' ";
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
  $fee_details1="SELECT * FROM master_fee where Lateral='$Lateral' ANd course='$Course' ANd batch='$Batch'";
  $fee_details1_run=mysqli_query($conn,$fee_details1);
  if($row_fee1=mysqli_fetch_array($fee_details1_run))
  {
      $applicables=$row_fee1['applicables'];
      $hostel=$row_fee1['hostel'];
      $concession=$row_fee1['concession'];
      $after_concession=$row_fee1['after_concession'];
 }
 else
 {
  $applicables="0";
  $hostel="0";
  $concession="0";
  $after_concession="0";

 } 
 }


    
}

if($Months>0)
{

    $mduration= $Months.' Months';
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
if($typeFromUII==1)
{
}
else{
  $pdf->Image('offer_letter.jpeg', 0, 0, 210);
}
$pdf->SetFont('Times', 'B', 11);
$pdf->SetXY(155, 50);
if($PrintDatew!='')
{
$pdf->MultiCell(45, 10,$PrintDatew, 0, 'C');
}
// else
// {
// $pdf->MultiCell(45, 10, $today.'-'.$month.'-'.$year, 0, 'C');
// }

$pdf->SetXY(25, 50);
$pdf->MultiCell(45, 10, $RefNo, 0, 'L');
$pdf->SetXY(10, 60);
$pdf->SetFont('Times','U', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->MultiCell(190, 10, '  FEE DEMAND LETTER  ',0, 'C','');
 
//$pdf->MultiCell(190, 10, 'TO WHOM IT MAY CONCERN', 0, 'C');

$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 6, 'It is certified that Guru Kashi University, Talwandi Sabo established by the Act of the legislature of the state of Punjab, under the "GURU KASHI UNIVERSITY ACT 2011" (Punjab Act no 37 of 2011), to provide education at all levels in all disciplines of higher education. Guru Kashi University is a approved by UGC, New Delhi University under section 2f and empowered to confer degrees as per the section 22(1) of the UGC Act,1956.The University is accredited  with Grade A++ by National Assessment & Accreditation Council (NAAC).',0, 'J');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y+1.5);
$pdf->MultiCell(190, 6, 'It is further certified that '.$ms.' '.$name.' '.$ge.' '.$FatherName.' has been admitted in our university for  his/her '.$courseName.' ( '.$Leet_Duration.''. $mduration.' on Class Roll No. '.$Class_RollNo.'.The candidate had fullfilled the eligibility qualifications as per university norms and the candidate is admitted  on the basis of merit',0, 'J');
$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y+1.5);
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 6, 'The Fee Structure for '.$courseName.' ( '.$Leet_Duration.''. $mduration.'  as is given below: ',0, 'L');
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

for ($i=$yearFromUI; $i <=$yearFromUI ; $i++)
{ 

if ($i==1) {
   $ss="First";
   $session_split='2023-24';
}elseif ($i==2) 
{
   $ss="Second";
   if ($Lateral=='Yes')
 {
      $session_split='2023-24';
  }else
  {
    $session_split='2024-25';

  }
}elseif ($i==3) 
{
   $ss="Third";
     

      if ($Lateral=='Yes')
 {
      $session_split='2024-25';
  }else
  {
     $session_split='2025-26';

  }
}
elseif ($i==4) 
{
   $ss="Fourth";
     

      if ($Lateral=='Yes')
 {
      $session_split='2025-26';
  }else
  {
   $session_split='2026-27';

  }






}elseif ($i==5)
 {
   $ss="Fifth";

      if ($Lateral=='Yes')
 {
      $session_split='2026-27';
  }else
  {
  $session_split='2027-28';

  }
     
}
elseif ($i==6)
 {
   $ss="Sixth";
      if ($Lateral=='Yes')
 {
      $session_split='2027-28';
  }else
  {
 $session_split='2028-29';

  }
      
}


// $session_split=split ("-", $ip);

    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetXY($X, $Y+12);
$pdf->Cell(190, 4, $ss .' Year Academic and Hostel Fee '.$session_split, 1, 1, 'C');
$pdf->SetFont('Times', 'B', 10);
$X=$pdf->GETX();
$Y=$pdf->GETY();
$ordinalSuffix = getOrdinalSuffix($i);
$pdf->SetFont('Times', '', 8);
//$pdf->Cell(160, 4, '  '.$ss.''.' YEAR Tuition Fee', 1, 1, 'L');
//$pdf->Cell(160, 4, '  Hostel Charges (food and accommodation)', 1, 1, 'L');

 if($concession>0)
 {
//$pdf->Cell(160, 4, '  Scholarship', 1, 1, 'L');
}
$pdf->SetFont('Times', 'B', 8);

if($concession>0)
 {
    $pdf->Cell(160, 6,$ss.' Year Academic and Hostel Fee (including Mess charges)', 1, 1, 'L');
}
else
{
   $pdf->Cell(160, 6,$ss.' Year Academic and Hostel Fee (including Mess charges)', 1, 1, 'L');
}


$pdf->SetFont('Times', '', 8);
$pdf->SetXY(160+$X, $Y);
//$pdf->Cell(30, 4, $applicables.'/-', 1, 1, 'C');
//$pdf->SetXY(160+$X, $Y+4);
//$pdf->Cell(30, 4, $hostel.'/-', 1, 1, 'C');
//$pdf->SetXY(160+$X, $Y+8);
 if($concession>0)
 {


//$pdf->Cell(30, 4, $concession.'/-', 1, 1, 'C');

//$pdf->SetXY(160+$X, $Y+12);
}
$pdf->SetFont('Times', 'B', 8);
$pdf->Cell(30, 6, $after_concession.'/-', 1, 1, 'C');
$pdf->SetFont('Times', '', 8);
$Y=$Y-2;

}


if($District!='593' AND $District!='581')


{

if($Months>0)
{
if ($i==1) {
   $ss="First";
   $session_split='2023-24';
}elseif ($i==2) 
{
   $ss="Second";
   if ($Lateral=='Yes')
 {
      $session_split='2023-24';
  }else
  {
    $session_split='2024-25';

  }
}elseif ($i==3) 
{
   $ss="Third";
     

      if ($Lateral=='Yes')
 {
      $session_split='2024-25';
  }else
  {
     $session_split='2025-26';

  }
}
elseif ($i==4) 
{
   $ss="Fourth";
     

      if ($Lateral=='Yes')
 {
      $session_split='2025-26';
  }else
  {
   $session_split='2026-27';

  }






}elseif ($i==5)
 {
   $ss="Fifth";

      if ($Lateral=='Yes')
 {
      $session_split='2026-27';
  }else
  {
  $session_split='2027-28';

  }
     
}
elseif ($i==6)
 {
   $ss="Sixth";
      if ($Lateral=='Yes')
 {
      $session_split='2027-28';
  }else
  {
 $session_split='2028-29';

  }
      
}
    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetXY($X, $Y+12);
$pdf->Cell(190, 4, $ss.' Year Academic  and Hostel Fee '.$session_split, 1, 1, 'C');
$pdf->SetFont('Times', 'B', 10);
$X=$pdf->GETX();
$Y=$pdf->GETY();
$ordinalSuffix = getOrdinalSuffix($i);
$pdf->SetFont('Times', '', 8);
//$pdf->Cell(160, 4, '  '.$ss.''.' YEAR Tuition Fee', 1, 1, 'L');
//$pdf->Cell(160, 4, '  Hostel Charges (food and accommodation)', 1, 1, 'L');

 if($concession>0)
 {
//$pdf->Cell(160, 4, '  Scholarship', 1, 1, 'L');
}
$pdf->SetFont('Times', 'B', 8);

if($concession>0)
 {
    $pdf->Cell(160, 6,$ss.' Year Academic and Hostel Fee (including Mess charges)', 1, 1, 'L');
}
else
{
   $pdf->Cell(160, 6,$ss.' Year Academic and Hostel Fee (including Mess charges)', 1, 1, 'L');
}


$pdf->SetFont('Times', '', 8);
$pdf->SetXY(160+$X, $Y);
//$pdf->Cell(30, 4, $applicables.'/-', 1, 1, 'C');
//$pdf->SetXY(160+$X, $Y+4);
//$pdf->Cell(30, 4, $hostel.'/-', 1, 1, 'C');
//$pdf->SetXY(160+$X, $Y+8);
 if($concession>0)
 {


//$pdf->Cell(30, 4, $concession.'/-', 1, 1, 'C');

//$pdf->SetXY(160+$X, $Y+12);
}
$pdf->SetFont('Times', 'B', 8);
$pdf->Cell(30, 6, $fee.'/-', 1, 1, 'C');
$pdf->SetFont('Times', '', 8);
$Y=$Y-2;


}

}

$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 8, ' Fee will be transfer RTGS/NEFT. University Account detail given below:',0, 'L');
$pdf->SetFont('Times', '', 11);
$X=$pdf->GETX();
$Y=$pdf->GETY();

$pdf->SetXY($X, $Y);
$pdf->Cell(190, 4,'Bank Name         :   Indian Bank', 0, 'L');
$pdf->SetXY($X, $Y+5);
$pdf->Cell(190, 4,'AccountNo          :   6058205486', 0, 'L');

$pdf->SetXY($X, $Y+10);
$pdf->Cell(190, 4,'IFSC Code          :   IDIB000F009', 0, 'L');
$pdf->SetXY($X, $Y+15);
$pdf->Cell(190, 4,'Branch                :   Fatehgarh Naubad, Talwandi Sabo', 0, 'L');
$pdf->SetXY($X, $Y+20);
$pdf->Cell(190, 4,'Account Name    :   Guru Kashi University', 0, 'L');
$X=$pdf->GETX();
$Y=$pdf->GETY();




//$pdf-> Image('dist/img/sign-offer.png',$X-30, $Y+5,24,20.5);
//$pdf-> Image('dist/img/sign.png',$X-30, $Y-12,30,26.5);

if($typeFromUII==1)
{
    $pdf-> Image('dist/img/sign-offer.png',160,170,24,20.5);

 $pdf-> Image('dist/img/sign.png',160, 150,30,26.5);
}

else{
 
}


 

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

}
$pdf->Output();
?>
