<?php 
require('fpdf/fpdf.php');
ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";
//$univ_rollno=$_POST['IDNo'];

 
   $univ_rollno  ='9618231922';


class CustomPDF extends FPDF {
    function Footer() {
        // Set the position of the footer at 15mm from the bottom
        $this->SetY(-15);
        // Set font and color for the footer text
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
        $this->SetY(-12);
        // $this->Cell(0, 10, 'Printed on ' .$GLOBALS['timeStampS'], 0, 0, 'R');
    }   
} 
$pdf = new CustomPDF();
// $list_sql = "SELECT   ExamForm.Course,ExamForm.ReceiptDate, ExamForm.SGroup,ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
// FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where Admissions.UniRollNo='$univ_rollno' or Admissions.ClassRollNo='$univ_rollno' or Admissions.IDNo='$univ_rollno' ORDER BY ExamForm.ID DESC"; 

// $list_result = sqlsrv_query($conntest,$list_sql);
//  while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
//     { 
//         $SubmitDate=$row['SubmitFormDate']->format('d-m-Y'); 

//     }
        $pdf->AddPage('P', 'A4');  

 
$sql = "SELECT  * FROM Admissions where IDNo='$univ_rollno'";
$stmt1 = sqlsrv_query($conntest,$sql);
if($row6 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
{
$IDNo= $row6['IDNo'];
$Session= $row6['Session'];
$ClassRollNo= $row6['ClassRollNo'];
$img= $row6['Snap'];
$UniRollNo= $row6['UniRollNo'];
$name = $row6['StudentName'];
$father_name = $row6['FatherName'];
$mother_name = $row6['MotherName'];
$aadhaar = $row6['AadhaarNo'];
$course = $row6['Course'];
$email = $row6['EmailID'];
$phone = $row6['StudentMobileNo'];
$batch = $row6['Batch'];
$college = $row6['CollegeName'];
$DOB= $row6['DOB'];
$CourseID=$row6['CourseID'];
$BllodGroup=$row6['BloodGroup'];
$Gender=$row6['Sex'];
$CollegeID=$row6['CollegeID'];
$LEET=$row6['LateralEntry'];
$email=$row6['EmailID'];
$mobile=$row6['StudentMobileNo'];
$religion=$row6['Religion'];
$category=$row6['Category'];
$studenttype=$row6['StudentType'];

$paddress=$row6['PermanentAddress'];
$caddress=$row6['CorrespondanceAddress'];
$doa=$row6['AdmissionDate'];
$Nationality=$row6['Nationality'];
$Country=$row6['country'];
$District=$row6['District'];
$State=$row6['State'];
$Pin=$row6['PIN'];

}
$srno=1;
$x=0;
$y=20;


$pdf->SetFont('times', 'B', 20);
$pdf->SetXY(10,20);
 $pdf->multicell(190, 5,"Guru Kashi Univerisity",0,'C');
$pdf->SetXY(10,25);
$pdf->SetFont('times', 'B', 12);

$pdf->multicell(190, 5,"Admission Form (".$Session.")",0,'C');
$pdf->SetTextColor(150,0,0);
$pdf->MultiCell(190,8,"  ", 0, 'C');
$pdf->SetTextColor(0,0,0);
$pdf-> Image('dist\img\new-logo.jpg',10,8,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',170,8,30,10);
$pdf->SetXY(10,30);
if($img!='')
{
$pic = 'data://text/plain;base64,' . base64_encode($img);

$info = getimagesize($pic);
$extension = explode('/', mime_content_type($pic))[1];


$pdf-> Image($pic,180,30.8,20,21,$extension);
}
$pdf->SetXY(180,30);
$pdf->MultiCell(20, 24,"", 1, '');

$pdf->SetXY(10,30);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(80, 8,"Class RollNo   :  ".$ClassRollNo, 1, 'l');
$pdf->SetXY(90,30);
$pdf->MultiCell(90, 8,"IDNo          :  ".$IDNo, 1, 'l');
;

$pdf->SetXY(10,38);
$pdf->MultiCell(80, 8, "Name              :  ".$name, 1, 'l');
$pdf->SetXY(90,38);
$pdf->MultiCell(90, 8, "Aadhar       :  ".$aadhaar , 1, 'l');

$pdf->SetXY(10,46);
$pdf->MultiCell(80, 8, "Father Name  :  ".$father_name, 1, 'l');
$pdf->SetXY(90,46);
$pdf->MultiCell(90, 8, "Mother Name  :  ".$mother_name, 1, 'l');

if($DOB!=''){

   $mydob=$DOB->format('d-m-Y'); 
}
else
{
$mydob='';
}
$pdf->SetXY(10,54);
$pdf->MultiCell(80, 8, "Date of Birth    :  ".$mydob, 1, 'l');
$pdf->SetXY(90,54);
$pdf->MultiCell(50, 8, "Gender               :  ".$Gender, 1, 'l');

$pdf->SetXY(140,54);
$pdf->MultiCell(60, 8, "Blood Group   :  ".$BllodGroup, 1, 'l');



$pdf->SetXY(10,62);
$pdf->MultiCell(80, 8, "College :  ".$college, 1, 'l');

$pdf->SetXY(90,62);
$pdf->MultiCell(110, 8, "Course             :    ".$course, 1, 'l');


$pdf->SetXY(10,70);
$pdf->MultiCell(80, 8, "Batch              :    ".$batch, 1, 'l');

$pdf->SetXY(90,70);
$pdf->MultiCell(110, 8, "Lateral Entry             :    ".$LEET, 1, 'l');




$pdf->SetXY(10,78);
$pdf->MultiCell(80, 8, "Email              :    ".$email, 1, 'l');

$pdf->SetXY(90,78);
$pdf->MultiCell(110, 8, "Mobile                 :    ".$mobile, 1, 'l');



$pdf->SetXY(10,86);
$pdf->MultiCell(80, 8, "Category         :    ".$category, 1, 'l');

$pdf->SetXY(90,86);
$pdf->MultiCell(110, 8, "Religion      :    ".$religion, 1, 'l');


$pdf->SetXY(10,94);
$pdf->MultiCell(80, 8, "Student Type   :    ".$studenttype, 1, 'l');

$pdf->SetXY(90,94);
$pdf->MultiCell(110, 8, "Nationality:    ".$Nationality, 1, 'l');

$pdf->SetXY(10,102);
$pdf->MultiCell(190, 8, "Permanent Address:    ".$paddress, 1, 'l');

$pdf->SetXY(10,110);
$pdf->MultiCell(190, 8, "Correspondance Address:    ".$caddress, 1, 'l');

$pdf->SetXY(10,118);
$pdf->MultiCell(50, 8, "Country:    ".$Country, 1, 'l');

$pdf->SetXY(60,118);
$pdf->MultiCell(50, 8, "State:    ".$State, 1, 'l');

$pdf->SetXY(110,118);
$pdf->MultiCell(50, 8, "District:    ".$District, 1, 'l');

$pdf->SetXY(160,118);
$pdf->MultiCell(40, 8, "Pin code:    ".$Pin, 1, 'l');











$y=140;
$pdf->SetXY(10,130);
$pdf->SetFont('Arial', 'B', 10);
$pdf->multicell(190, 6,"Document Status",0,'C');
$pdf->SetFont('Arial', '', 9);

 $sql = "select  * from  DocumentStatus where IDNo='$IDNo' AND Status IS NOT NULL ";
$stmt1 = sqlsrv_query($conntest,$sql);
while($row7 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
{
$dicrequired= $row7['DocumentsRequired'];
$docstatus= $row7['Status'];
  if($srno<2){

    $pdf->SetXY(10,$y);
    $pdf->multicell(10,8,"SrNo", 1,'C');
    $pdf->SetXY(20,$y);
    $pdf->multicell(80, 8,"Document",1,'C');
    $pdf->SetXY(100,$y);
    $pdf->multicell(100, 8,"Status",1,'C');
    $y=$y+8;
  }
    $pdf->SetXY(10,$y);
    $pdf->multicell(10,8,$srno, 1,'C');
    $pdf->SetXY(20,$y);
    $pdf->multicell(80, 8,$dicrequired,1,'C');
    $pdf->SetXY(100,$y);
    $pdf->multicell(100, 8,$docstatus,1,'C');
    $pdf->SetXY(180,$y);
    
    $srno++;
    $y=$y+8;
}
$pdf->SetFont('Arial', '', 10);
$YBottom=$pdf->GETY()+5;
$pdf->SetXY(10,$YBottom+5);
$pdf->multicell(190, 5,"I here by certify that all perticulars stated in this form are true to the best of my knowledge & belief. I shall be responsible for any information entered incorrectly by me.",0,'L');

$YBottom=$pdf->GETY();
$pdf->SetXY(10,$YBottom+10);
$pdf->SetFont('Arial', '', 10);

if($doa!=''){

   $mydoa=$doa->format('d-m-Y'); 
}
else
{
$mydoa='';
}
$pdf->multicell(190,5,"Date of Admission : ".$mydoa,0,'L');

    $pdf->multicell(190,5," Signature.............................",0,'R');



$pdf->Output();