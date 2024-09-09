<?php
session_start();
$EmployeeID=$_SESSION['usr'];
require('fpdf/fpdf.php');
include "connection/connection.php";
date_default_timezone_set("Asia/Calcutta");
$today1=date('Y-m-d h:i:s');


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
$get_student_details="SELECT * FROM offer_latter_international where id='$value' AND generate=1";
$get_student_details_run=mysqli_query($conn,$get_student_details);
if ($row=mysqli_fetch_array($get_student_details_run))
 {
    $name=$row['Name'];
    $FatherName=$row['FatherName'];
    $dob=$row['DOB'];
    $Course=$row['Course'];
    $Gender=$row['Gender'];
    $Class_RollNo=$row['Class_RollNo'];
    $District=$row['District'];   
    $State=$row['State'];
    $Session=$row['Session'];
    $PrintDate=$row['PrintDate'];
    $PrintDatew=$row['PrintDate'];
    $Batch=$row['Batch'];
    $RefNo=$row["RefNo"]; 
    $getReffrenceNumbersql = "SELECT * FROM offer_latter_number  Where Batch='$Batch'";
    $getReffrenceNumberstmt = mysqli_query($conn,$getReffrenceNumbersql);  
         if($getReffrenceNumberrow = mysqli_fetch_array($getReffrenceNumberstmt) )
     {    
                 $RefString=$getReffrenceNumberrow["RefString1"];     
                      
     }
       if($PrintDatew!='')

      {$PrintDate = date("d-m-Y", strtotime($PrintDatew));  }
  else
  {
    $PrintDate='';
  }
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

 if($Lateral=='Yes')
  {
    $Batch=$Batch-1;
  }

$fee_details="SELECT * FROM master_fee where consultant_id='$Consultant_id' and Lateral='$Lateral' ANd course='$Course'ANd batch='$Batch'";
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
  $fee_details1="SELECT * FROM master_fee where Lateral='$Lateral' ANd course='$Course'ANd batch='$Batch'";
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
$pdf->Image('offer_letter.jpeg', 0, 0, 210);


$pdf->SetFont('Times', 'B', 11);
$pdf->SetXY(155, 49);


$pdf->Image('dist/img/idcardbg.png', 0, 76, 210);


if($PrintDate!='')
{
$pdf->MultiCell(45, 10,$PrintDate, 0, 'C');
}
// else
// {
// $pdf->MultiCell(45, 10, $today.'-'.$month.'-'.$year, 0, 'C');
// }




$pdf->SetXY(25, 49);
  if($Lateral=='Yes')
  {
    $Batch=$Batch+1;
    $pdf->MultiCell(45, 10, $RefString.$Batch.'/'.$RefNo, 0, 'L');
  }
  else{
$pdf->MultiCell(45, 10, $RefString.$Batch.'/'.$RefNo, 0, 'L');
}
$pdf->SetXY(10, 60);
$pdf->SetFont('Times','U', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->MultiCell(190, 10, 'Offer Letter',0, 'C','0');
 
//$pdf->MultiCell(190, 10, 'TO WHOM IT MAY CONCERN', 0, 'C');

$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 6, 'Subject: Offer Letter -'.$courseName,0, 'J');
 $pdf->SetTextColor(255);
$pdf->MultiCell(70, 6, 'Name :'.$name, 0, 'l','0');
$pdf->SetXY(80, 76);
$pdf->MultiCell(50, 6, 'Gender :'.$Gender,0 , 'l','0');
$pdf->SetXY(130, 76);
$pdf->MultiCell(70, 6, 'Date of Birth :'.$dob,0 , 'l','0');
$pdf->SetXY(10, 82);
$pdf->MultiCell(190, 6, 'Country: ', 0, 'l','0');
 $pdf->SetTextColor(0);
$pdf->MultiCell(190, 6, 'This is to Confirm that the above stated student has been  offered admissions as per the merit(intermediate marks)after the inital security of application in the course mentioned below for academic year 2024-25 ',0, 'J');


$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y+0);

$pdf->MultiCell(190, 6, 'Prgramme Name :'.$courseName, 0, 'l','0');
$pdf->SetXY(10, $Y+8);
$pdf->MultiCell(50, 6, 'Duration of Course : '.$Duration.'Years',0 , 'l','0');
$pdf->SetXY(10, $Y+14);
$pdf->MultiCell(70, 6, 'foudatioan start date : 10-11-2024',0 , 'l','0');
$pdf->SetXY(10, $Y+20);
$pdf->MultiCell(190, 6, 'Foundation fee : Applicable with 100% Scholarship (English)', 0, 'l','0');
$pdf->SetXY(10, $Y+26);
$pdf->MultiCell(70, 6, 'Course start date:10-11-2024',0 , 'l','0');
$pdf->SetXY(10, $Y+33);
$pdf->SetFont('Times', 'B', 10);
$pdf->MultiCell(70, 6, 'Your Program fee Detial',0 , 'l','0');
$pdf->SetFont('Times', '', 10);

$X=$pdf->GETX();
$Y=$pdf->GETY();
$pdf->SetXY($X, $Y+1.5);
$pdf->SetFont('Times', '', 10);

  // It is also certified that '.$ms.' '.$name.' '.$ge.' '.$FatherName.' R/O '.$State.'  has been admitted in our University for pursuing his/her '.$courseName.' course in session '.$Session.'.
 $pdf->SetFont('Times', 'B', 10);
 // $pdf->MultiCell(190, 6, 'Course Name- '.$courseName,0, 'L');
 // $pdf->MultiCell(190, 6, 'Applicables Fees- '.$applicables,0, 'L'); $pdf->MultiCell(190, 6, 'Hostel Fee- '.$hostel,0, 'L');
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

for ($i=$sem; $i <=1 ; $i++)
{ 
if ($i==1) {
   $ss="First";
   // 2024
 $Batchn=(string)$Batch+1; 
   $endye=substr($Batchn, -2);
   $session_split=$Batch.'-'.$endye;
  
}
elseif ($i==2) 
{
   $ss="Second";
   if ($Lateral=='Yes')
 {
$Batchn=(string)$Batch+1;
   $endye=substr($Batchn, -2);
    $session_split=$Batch.'-'.$endye;

  }
  else
  {
    //2023
$Batchn=(string)$Batch+2;
   $endye=substr($Batchn,-2);

   $Batch=$Batch+1;

   $session_split=$Batch.'-'.$endye;

   // $session_split='2024-25';

  }
}
elseif ($i==3) 
{
   $ss="Third";
     

      if ($Lateral=='Yes')
 {
      $Batchn=(string)$Batch+2;
   $endye=substr($Batchn, -2);
    $Batch=$Batch+1;
   $session_split=$Batch.'-'.$endye;
  }
  else
  {
    $Batchn=(string)$Batch+2;
   $endye=substr($Batchn, -2);
    $Batch=$Batch+1;
    $session_split=$Batch.'-'.$endye;

  }
}
elseif ($i==4) 
{
   $ss="Fourth";
     

      if ($Lateral=='Yes')
 {
      $Batchn=(string)$Batch+2;
   $endye=substr($Batchn, -2);
    $Batch=$Batch+1;
   $session_split=$Batch.'-'.$endye;

  }else
  {
   $Batchn=(string)$Batch+2;
   $endye=substr($Batchn, -2);
    $Batch=$Batch+1;
    $session_split=$Batch.'-'.$endye;

  }






}elseif ($i==5)
 {
   $ss="Fifth";

      if ($Lateral=='Yes')
 {
   $Batchn=(string)$Batch+2;
   $endye=substr($Batchn, -2);
    $Batch=$Batch+1;
   $session_split=$Batch.'-'.$endye;
  }else
  {
   $Batchn=(string)$Batch+2;
   $endye=substr($Batchn, -2);
    $Batch=$Batch+1;
   $session_split=$Batch.'-'.$endye;

  }
     
}
elseif ($i==6)
 {
   $ss="Sixth";
      if ($Lateral=='Yes')
 {
     $Batchn=(string)$Batch+2;
   $endye=substr($Batchn, -2);
    $Batch=$Batch+1;
   $session_split=$Batch.'-'.$endye;

  }else
  {
$Batchn=(string)$Batch+2;
   $endye=substr($Batchn, -2);
    $Batch=$Batch+1;
   $session_split=$Batch.'-'.$endye;


  }
      
}



// $session_split=split ("-", $ip);

    $pdf->SetFont('Times', 'B', 10);
    $pdf->SetXY($X, $Y+12);
$pdf->Cell(150, 4, ' Fee Plan -Package/Year-1st to Final', 1, 1, 'l');
  $pdf->SetXY($X+150, $Y+12);
 $pdf->Cell(40, 4, 'Total Amount in USD', 1, 1, 'l');
$pdf->SetFont('Times','B', 10);
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
    $pdf->Cell(160, 6,'Registration fee', 1, 1, 'L');
}
else
{
   $pdf->Cell(60, 6,'Registration Fee (One Time)', 1, 1, 'L');
}



$pdf->SetXY(70, $Y);
$pdf->Cell(30, 6,'USD', 1, 1, 'C');
$pdf->SetXY(100, $Y);
$pdf->Cell(60, 6,'100', 1, 1, 'C');
$pdf->SetXY(150+$X, $Y);
$pdf->Cell(40, 6, '100', 1, 1, 'C');
$pdf->SetXY(10, $Y+6);

$pdf->Cell(60, 6,'Other Charges (One Time)', 1, 1, 'L');

$pdf->SetXY(70, $Y+6);
$pdf->Cell(30, 6,'USD', 1, 1, 'C');
$pdf->SetXY(100, $Y+6);
$pdf->Cell(60, 6,'100', 1, 1, 'C');

$pdf->SetXY(150+$X, $Y+6);


$pdf->Cell(40, 6, '100', 1, 1, 'C');



$pdf->SetXY(10, $Y+12);

$pdf->Cell(60, 6,'Misc Charges (One Time)', 1, 1, 'L');

$pdf->SetXY(70, $Y+12);
$pdf->Cell(30, 6,'USD', 1, 1, 'C');
$pdf->SetXY(100, $Y+12);
$pdf->Cell(60, 6,'200', 1, 1, 'C');
$pdf->SetXY(150+$X, $Y+12);

$pdf->Cell(40, 6, '200', 1, 1, 'C');

$pdf->SetXY(10, $Y+18);

$pdf->Cell(60, 6,'Actual Fee', 1, 1, 'L');

$pdf->SetXY(70, $Y+18);
$pdf->Cell(30, 6,'USD', 1, 1, 'C');
$pdf->SetXY(100, $Y+18);
$pdf->Cell(60, 6,'4000', 1, 1, 'C');

$pdf->SetXY(150+$X, $Y+18);

$pdf->MultiCell(40, 12, '6600',1, 'C');


$pdf->SetXY(10, $Y+24);

$pdf->Cell(60, 6,' Fee Package plan /year', 1, 1, 'L');

$pdf->SetXY(70, $Y+24);
$pdf->Cell(30, 6,'USD', 1, 1, 'C');
$pdf->SetXY(100, $Y+24);
$pdf->Cell(60, 6,'2600', 1, 1, 'C');




$pdf->SetXY($X, $Y+30);
$pdf->SetFont('Times', '', 10);
$pdf->MultiCell(190, 6, 'Note: THIS IS AN OFFER LETTER AND STUDY VISA MUST NOT BE ISSUED BASED ON THIS OFFERLETTER.',0, 'L');

$pdf->SetXY(10, $Y+30);
$pdf->SetFont('Times','', 10);
$pdf->MultiCell(190, 6, '
For the Final admission, student has to fulfill the admission on criteria stipulated by Government of Punjab &amp; Government of India. Moreover, he/she has to submitted all necessary documents in support of his/her eligibility for admission in above mentioned program. Hostel fee is chargeable during the foundation program. If the student is willing to stay off campus from 2 nd year of the studies, then his/her tuition fee will be 2000 USD/year. Exam fee will be 50 USD per semester. This offer letter is valid for 15 days.',0, 'L');













//$pdf->SetXY(160+$X, $Y+8);
 if($concession>0)
 {


//$pdf->Cell(30, 4, $concession.'/-', 1, 1, 'C');

//$pdf->SetXY(160+$X, $Y+12);
}

$Y=$Y+30;






}




$pdf->SetXY(10, $Y+28);
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




$pdf-> Image('dist/img/sign-offer.png',$X-30, $Y+5,24,20.5);
$pdf-> Image('dist/img/sign.png',$X-30, $Y-12,30,26.5);

// $pdf-> Image('dist/img/sign-offer.png',150,230,24,20.5);

// $pdf-> Image('dist/img/sign.png',150, 200,30,26.5);

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
 $upd="UPDATE offer_latter SET PrintBy='$EmployeeID' where id='$value'";
mysqli_query($conn,$upd);
}
$pdf->Output();
?>
