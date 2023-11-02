<?php 
require('fpdf/fpdf.php');
ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";
$univ_rollno=$_POST['IDNo'];
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
        $this->Cell(0, 10, 'Printed on ' .$GLOBALS['timeStampS'], 0, 0, 'R');
    }   
} 
$pdf = new CustomPDF();
$list_sql = "SELECT   ExamForm.Course,ExamForm.ReceiptDate, ExamForm.SGroup,ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where Admissions.UniRollNo='$univ_rollno' or Admissions.ClassRollNo='$univ_rollno' or Admissions.IDNo='$univ_rollno' ORDER BY ExamForm.ID DESC"; 

$list_result = sqlsrv_query($conntest,$list_sql);
 while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
    { 
        $pdf->AddPage('P', 'A4');  
 $id = $row['ID'];
 $list_sqlw5 ="SELECT * from ExamForm Where  ID='$id'";
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
if($receipt_date!='')
{
$rdateas=$receipt_date->format('Y-m-d');}
else
{
$rdateas='';        
} 
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
$pdf->multicell(190, 5,"Examination Form($examinationss)",0,'C');
$pdf->SetTextColor(150,0,0);
$pdf->MultiCell(190,8,"  ", 0, 'C');
$pdf->SetTextColor(0,0,0);
$pdf-> Image('dist\img\new-logo.jpg',10,4,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',170,4,30,10);
$pdf->SetXY(10,25);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(80, 6,"Uni Roll No :    ".$UniRollNo, 1, 'l');
$pdf->SetXY(90,25);
$pdf->MultiCell(110, 6,"Name :    ".$name, 1, 'l');

$pdf->MultiCell(80, 6, "Father Name :    ".$father_name, 1, 'l');
$pdf->SetXY(90,31);
$pdf->MultiCell(110, 6, "Mother Name :    ".$mother_name, 1, 'l');

$pdf->MultiCell(140, 6, "Course :    ".$course, 1, 'l');
$pdf->SetXY(150,37);
$pdf->MultiCell(50, 6, "Batch :    ".$batch, 1, 'l');
$pdf->SetXY(10,43);
$pdf->MultiCell(140, 6, "College :    ".$college, 1, 'l');
$pdf->SetXY(150,43);
$pdf->MultiCell(50, 6, "Semester :    ".$SemesterId, 1, 'l');
$pdf->SetXY(10,60);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(30,6,"SrNo", 1,'C');
$pdf->SetXY(40,60);
$pdf->multicell(100, 6,"Subject Name/Subject Code",1,'C');
$pdf->SetXY(140,60);
$pdf->multicell(20, 6,"Int",1,'C');
 $pdf->SetXY(160,60);
$pdf->multicell(20, 6,"Ext",1,'C');
$pdf->SetXY(180,60);
$pdf->multicell(20, 6,"Type",1,'C');

$y=66;
$pdf->SetFont('Arial', '', 8);
$amrik = "SELECT * FROM ExamFormSubject where Examid='$id' order by ExternalExam DESC";  
$list_resultamrik = sqlsrv_query($conntest,$amrik);  
$srno=0;
while($row7 = sqlsrv_fetch_array($list_resultamrik, SQLSRV_FETCH_ASSOC) )
         {
$pdf->SetXY(10,$y);
$pdf->multicell(30,8,$srno+1, 1,'C');
$pdf->SetXY(40,$y);
$pdf->multicell(100, 8,$row7['SubjectName'].'('.$row7['SubjectCode'].')',1,'C');
$pdf->SetXY(140,$y);
$pdf->multicell(20, 8,$row7['InternalExam'],1,'C');
 $pdf->SetXY(160,$y);
$pdf->multicell(20, 8,$row7['ExternalExam'],1,'C');
$pdf->SetXY(180,$y);
$pdf->multicell(20, 8,$row7['SubjectType'],1,'C');
$srno++;
$y=$y+8;
}
$pdf->SetFont('Arial', '', 10);
$YBottom=$pdf->GETY();
$pdf->SetXY(10,$YBottom+5);
$pdf->multicell(190, 5,"I have read all the regulations and it's amendments in regard to examination. 
I found myself eligible to appear in examination. In case university declare me ineligible due to any 
wrong information submitted in examination form by me, i shall be responsible for its consequences.",0,'L');
$YBottom=$pdf->GETY();
$pdf->SetXY(10,$YBottom+5);
$pdf->multicell(190, 5,"Candidate Signature...................",0,'L');
$pdf->SetXY(10,$YBottom+5);
$pdf->multicell(190, 5,"Date.............................",0,'R');

    }
}
$pdf->Output();