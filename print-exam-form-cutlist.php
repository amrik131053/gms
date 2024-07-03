<?php 
require('fpdf/fpdf.php');
ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";
$univ_rollno=$_POST['ID'];
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
 $list_sqlw5 ="SELECT * from ExamForm Where  ID='$univ_rollno'";
$list_result5 = sqlsrv_query($conntest,$list_sqlw5);
$i = 1;
if( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
{  
 $IDNo=$row5['IDNo'];
$type=$row5['Type'];
$SemesterId=$row5['Semester'];
$examination=$row5['Examination'];
$examinationss=$row5['Examination'];
$sgroup= $row5['SGroup'];
$receipt_date=$row5['ReceiptDate'];
$receipt_no=$row5['ReceiptNo'];
$formid=$row5['ID'];
$SubmitDate=$row5['SubmitFormDate']->format('d-m-Y'); 
if($receipt_date!='')
{
$rdateas=$receipt_date->format('Y-m-d');}
else
{
$rdateas='';        
} 
if($row5['SubmitFormDate']!=''){ $FormSubmitDate=$row5['SubmitFormDate']->format('d-m-Y H:i:s'); }else {$FormSubmitDate="";}

if($row5['DepartmentVerifiedDate']!=''){$DepartmentVerifiedDate=$row5['DepartmentVerifiedDate']->format('d-m-Y H:i:s');}else{$DepartmentVerifiedDate="";}

if($row5['DeanVerifiedDate']!=''){$DeanVerifiedDate=$row5['DeanVerifiedDate']->format('d-m-Y H:i:s');}else{$DeanVerifiedDate="";}

if($row5['AccountantVerificationDate']!=''){ $AccountantVerificationDate=$row5['AccountantVerificationDate']->format('d-m-Y H:i:s');}else{ $AccountantVerificationDate="";}

if($row5['ExaminationVerifiedDate']!=''){$ExaminationVerifiedDate=$row5['ExaminationVerifiedDate']->format('d-m-Y H:i:s');}else{$ExaminationVerifiedDate="";}

if($row5['RegistraionVerifDate']!=''){$RegistraionVerifDate=$row5['RegistraionVerifDate']->format('d-m-Y H:i:s');}else{$RegistraionVerifDate="";}


if($row5['RejectedDate']!=''){$RejectedDate=$row5['RejectedDate']->format('d-m-Y H:i:s');}else{$RejectedDate="";}

 if($row5['AccountRejectDate']!=''){$AccountRejectDate=$row5['AccountRejectDate']->format('d-m-Y H:i:s');}else{$AccountRejectDate="";}
 $Status=$row5['Status'];
$sql = "SELECT  * FROM Admissions where IDNo='$IDNo'";
$stmt1 = sqlsrv_query($conntest,$sql);
if($row6 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
{
$IDNo= $row6['IDNo'];
$ClassRollNo= $row6['ClassRollNo'];
$img= $row6['Snap'];
$UniRollNo= $row6['UniRollNo'];
$name = $row6['StudentName'];
$father_name = $row6['FatherName'];
$mother_name = $row6['MotherName'];
$course = $row6['Course'];
$email = $row6['EmailID'];
$phone = $row6['StudentMobileNo'];
$batch = $row6['Batch'];
$college = $row6['CollegeName'];
$CourseID=$row6['CourseID'];
$CollegeID=$row6['CollegeID'];


}
$srno=1;
$x=0;
$y=20;

$pdf->SetXY(10,18);
$pdf->SetFont('times', 'B', 12);
$pdf->SetXY(10,12);
// $pdf->multicell(190, 5,"Guru Kashi Univerisity",0,'C');
$pdf->SetXY(10,18);
$pdf->multicell(190, 5,"Registration Form($examinationss)",0,'C');
$pdf->SetTextColor(150,0,0);
$pdf->MultiCell(190,8,"  ", 0, 'C');
$pdf->SetTextColor(0,0,0);
$pdf-> Image('dist\img\new-logo.jpg',10,8,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',170,8,30,10);
$pdf->SetXY(10,25);

$pic = 'data://text/plain;base64,' . base64_encode($img);
$info = getimagesize($pic);
$extension = explode('/', mime_content_type($pic))[1];
$pdf-> Image($pic,180,26.8,20,21,$extension);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(80, 6,"Uni Roll No :    ".$UniRollNo, 1, 'l');
$pdf->SetXY(90,25);
$pdf->MultiCell(90, 6,"Name :    ".$name, 1, 'l');
$pdf->SetXY(180,25);
$pdf->MultiCell(20, 24,"", 1, '');
$pdf->SetXY(10,31);
$pdf->MultiCell(80, 6, "Father Name :    ".$father_name, 1, 'l');
$pdf->SetXY(90,31);
$pdf->MultiCell(90, 6, "Mother Name :    ".$mother_name, 1, 'l');

$pdf->MultiCell(130, 6, "Course :    ".$course, 1, 'l');
$pdf->SetXY(140,37);
$pdf->MultiCell(40, 6, "Batch :    ".$batch, 1, 'l');
$pdf->SetXY(10,43);
$pdf->MultiCell(120, 6, "College :    ".$college, 1, 'l');
$pdf->SetXY(130,43);
$pdf->MultiCell(50, 6, "Semester :    ".$SemesterId." (".$type.")", 1, 'l');
$pdf->SetXY(10,60);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(10,6,"SrNo", 1,'C');
$pdf->SetXY(20,60);
$pdf->multicell(150, 6,"Subject/Subject Code",1,'C');
$pdf->SetXY(170,60);
$pdf->multicell(10, 6,"Int",1,'C');
$pdf->SetXY(180,60);
$pdf->multicell(10, 6,"Ext",1,'C');
$pdf->SetXY(190,60);
$pdf->multicell(10, 6,"Type",1,'C');

$pdf->SetXY(10,49);
$pdf->multicell(190, 11,"",1,'C');
$y=66;

$pdf->SetXY(10,52);
$pdf->SetFont('Arial', 'B', 10);
$pdf->multicell(190, 6,"Subjects in which appearing",0,'C');
$pdf->SetFont('Arial', '', 8);
$amrik = "SELECT * FROM ExamFormSubject where Examid='$univ_rollno'  ANd ExternalExam='Y' order by ExternalExam DESC";  
$list_resultamrik = sqlsrv_query($conntest,$amrik);  
$srno=0;
while($row7 = sqlsrv_fetch_array($list_resultamrik, SQLSRV_FETCH_ASSOC) )
{
  
    $pdf->SetXY(10,$y);
    $pdf->multicell(10,5,$srno+1, 1,'C');
    $pdf->SetXY(20,$y);
    $pdf->multicell(150, 5,$row7['SubjectName'].'('.$row7['SubjectCode'].')',1,'C');
    $pdf->SetXY(170,$y);
    $pdf->multicell(10, 5,$row7['InternalExam'],1,'C');
    $pdf->SetXY(180,$y);
    $pdf->multicell(10, 5,$row7['ExternalExam'],1,'C');
    $pdf->SetXY(190,$y);
    $pdf->multicell(10, 5,$row7['SubjectType'],1,'C');
    $srno++;
    $y=$y+5;
}
$YBottom=$pdf->GETY();
$pdf->SetXY(10,$YBottom);
$pdf->multicell(190, 34 ,"",1,'C');
$pdf->SetXY(10,$YBottom+34);
$pdf->multicell(190, 45,"",1,'C');
$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(10,$YBottom+5);
$pdf->multicell(190, 5,"I have read all the regulations and it's amendments in regard to examination. I found myself eligible to appear in examination.In case university declare me ineligible due to any wrong information submitted in examination form by me, i shall beresponsible for its consequences.",0,'L');
$YBottom=$pdf->GETY();
$pdf->SetXY(10,$YBottom+5);
$pdf->SetFont('Arial', 'B', 10);
$imageUrl = 'http://erp.gku.ac.in:86/images/signature/'.$IDNo.'.PNG';
if($imageUrl!=''){
$type = pathinfo($imageUrl, PATHINFO_EXTENSION);
$data = file_get_contents($imageUrl);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
$info = getimagesize($base64);
$extension = explode('/', mime_content_type($base64))[1];
$pdf-> Image($base64,48,$YBottom+2,30,10,$extension);
$pdf->multicell(190, 5,"Candidate Signature",0,'L');
}
else{

    $pdf->multicell(190, 5,"Candidate Signature.............................",0,'L');
}

$pdf->SetXY(10,$YBottom+5);
$pdf->SetFont('Arial', '', 10);
$pdf->multicell(190, 5,"Date ".$SubmitDate,0,'R');
$pdf->SetFont('Arial', 'B', 10);
$YBottom=$pdf->GETY();
$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(10,$YBottom+5);
$pdf->multicell(190, 5,"Certified that the Candidate has completed the prescribed course of study and fulfilled all the conditions laid down in the regulations for the examination and is eligible to appear in the examination as a regular student of Guru Kashi University.The candidate bears a good moral character and particulars filled by him/her are correct.",0,'L');
$YBottom=$pdf->GETY();
$pdf->SetXY(10,$YBottom+2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->multicell(190, 6,"Head of Department",0,'L');
$pdf->SetXY(10,$YBottom+6);
$pdf->SetFont('Arial', '', 8);
$pdf->multicell(190, 6,$DepartmentVerifiedDate,0,'L');
$pdf->SetXY(10,$YBottom+2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->multicell(190, 5,"Signature of the Dean",0,'R');
$pdf->SetXY(10,$YBottom+6);
$pdf->SetFont('Arial', '', 8);
$pdf->multicell(190, 5,$DeanVerifiedDate,0,'R');


$pdf->SetXY(10,$YBottom+29);
$pdf->multicell(190, 60,"",1,'C');

$pdf->SetXY(10,$YBottom+18);
$pdf->multicell(190, 11,"",1,'C'); 
$pdf->SetXY(10,$YBottom+19);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,128,0);
$pdf->multicell(190, 5,'Form Submission Detail(By Student)',0,'C');
$pdf->SetXY(10,$YBottom+24);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0,0,0);
$pdf->multicell(190, 5,"Form is Submitted by the student on Dated :".$SubmitDate,0,'C');

 if($Status>-1 && $Status!='22') 
{   
    $pdf->SetXY(10,$YBottom+29);
$pdf->multicell(190, 14,"",1,'C'); 
    $pdf->SetXY(10,$YBottom+30);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0,128,0);
    $pdf->multicell(190, 5,"Form Verification Detail(By Registration Branch)",0,'C');
    $pdf->SetXY(10,$YBottom+35);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->multicell(190, 5,"Form is successfully verified by registration branch on Dated : ".$RegistraionVerifDate,0,'C');
}


          if($Status>1 && $Status!='2' && $Status!='3' &&$Status!='22')
{ 
    $pdf->SetXY(10,$YBottom+43);
    $pdf->multicell(190, 12,"",1,'C');
    $pdf->SetXY(10,$YBottom+44);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,128,0);
$pdf->multicell(190, 5,"Form Verification Detail(By Department)",0,'C');

    $pdf->SetXY(10,$YBottom+49);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0,0,0);
$pdf->multicell(190, 5,"Examination cum Registraion form for Examination".$examination." is verfied on".$DepartmentVerifiedDate,0,'C');


$pdf->SetXY(10,$YBottom+55);
$pdf->multicell(190, 12,"",1,'C');

$pdf->SetXY(10,$YBottom+56);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(0,128,0);
$pdf->multicell(190, 5,"Form Verification Detail(By Dean)",0,'C');

$pdf->SetXY(10,$YBottom+61);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0,0,0);
$pdf->multicell(190, 5," Examination cum Registraion form for Examination".$examination." is verfied on".$DeanVerifiedDate,0,'C');


} 


if($Status>4 &&$Status!='6')
{ 
    $pdf->SetXY(10,$YBottom+68);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0,128,0);
    $pdf->multicell(190, 5,"Form Verify Detail(By Accounts)",0,'C'); 

    $pdf->SetXY(10,$YBottom+73);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    $pdf->multicell(190, 5,"Verified by account on Dated ".$AccountantVerificationDate,0,'C'); 
  
      }



      if($Status>5 && $Status!=7&& $Status!=6)
{ 
    $pdf->SetXY(10,$YBottom+80);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetTextColor(0,128,0);
    $pdf->multicell(190, 9,"",1,'C'); 
    $pdf->SetXY(10,$YBottom+81);
    $pdf->multicell(190, 5,"Examination form is successfully accepted on Dated ".$ExaminationVerifiedDate,0,'C'); 
  
      }

    }
// }
$pdf->Output();