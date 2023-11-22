<?php
session_start();
include 'connection/connection.php';
$output = '';  
$ctime = date("d-m-Y");
$nowtime = strtotime($ctime);

  $College = $_GET['CollegeId'];
  $Course = $_GET['Course'];
  $Batch = $_GET['Batch'];
  $Semester = $_GET['Semester'];
  $Type = $_GET['Type'];
  $Group = $_GET['Group'];
  $Examination = $_GET['Examination'];

require_once('fpdf/fpdf.php');

class PDF extends FPDF
{

function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0)
{
  // resize font
  $subFontSizeold = $this->FontSizePt;
  $this->SetFontSize($subFontSize);
  
  // reposition y
  $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
  $subX        = $this->x;
  $subY        = $this->y;
  $this->SetXY($subX, $subY - $subOffset);

  //Output text
  $this->Write($h, $txt, $link);

  // restore y position
  $subX        = $this->x;
  $subY        = $this->y;
  $this->SetXY($subX,  $subY + $subOffset);

  // restore font size
  $this->SetFontSize($subFontSizeold);
}
 


  function Header()
{ 



$College = $GLOBALS['College'];
  $Course = $GLOBALS['Course'];
  $Batch = $GLOBALS['Batch'];
  $Semester = $GLOBALS['Semester'];
  $Type = $GLOBALS['Type'];
  $Group = $GLOBALS['Group'];
  $Examination = $GLOBALS['Examination'];

 
 if($Semester==1) {$ext='st'; } elseif($Semester==2){ $ext='nd';}
  elseif($Semester==3) {$ext='rd'; } else { $ext='th';}
    /* Move to the right */

     //$this-> Image('../images/web-logo.png',132,5,33,9);

     $this->SetXY(133,15);
$this->SetFont('Arial','',6);
$this->Write(0,'Talwandi Sabo Bathinda(151302)');

       $this->SetFont('Arial','B',10);
       $this->SetX(123);
      $this->Cell(123,6,'Cutlist Examination('.$Examination.')',0,1);
  if($Group!='NA')
  {
$this->SetFont('Arial','B',10);
 $this->SetXY(210,4);
      $this->Cell(123,6,$grp,0,1);
}
$this->SetXY(10,14);
$this->Write(0,'Course : ');
$this->SetXY(27,13);
$this->MultiCell(80,2.7, $Course.'('.$Batch.')');
$this->SetXY(230,14);
$this->Write(0,'Semester :');
$this->SetXY(250,14 );
$this->Write(0,$Semester);
$this->subWrite(0,$ext,'',6,4);
$this->Write(0,'('.$Type.')');



$this->Line(8,21,292,21);

$this->Line(93,33,292,33);



//Sr No left line 
$this->Line(8,21,8,42);
$this->SetXY(8,23);
$this->Cell(10,6,'Sr No',0,0,'C',0);
$this->Line(19,21,19,42);
 $this->SetXY(19,21);

$this->MultiCell(18,6,'Class Roll No',0,'C');

$this->Line(37,21,37,38);

$this->SetXY(37,21);

$this->MultiCell(21,6,'Uni RollNo',0,'C');

$this->Line(58,21,58,38);
$this->SetXY(58,21);

$this->MultiCell(35,6,'Name',0,'C');


 $this->Line(93,21,93,38);

$this->SetFont('Arial','b',8);
 
 $this->Line(121.6,21,121.6,38);

 $this->SetXY(90,33);

 $this->Cell(22,6,'INT',0,0,'C',0);

 // $this->Line(107.5,33,107.5,38);

  $this->Cell(3,6,'EXT',0,0,'C',0);
 
 //$this->Line(151,21,151,42);
$this->SetXY(120,33);

 

 $this->Cell(20,6,'INT',0,0,'C',0);
 // $this->Line(135,33,135,38);
  $this->Cell(1,6,'EXT',0,0,'C',0);




 
$this->Line(150.2,21,150.2,38);


$this->SetXY(148,33);
 //$this->Line(158,33,158,42);
 $this->Cell(18,6,'INT',0,0,'C',0);
 // $this->Line(143,33,143,42);
  $this->Cell(9,6,'EXT',0,0,'C',0);



 
 $this->Line(178.8,21,178.8,38);

$this->SetXY(177,33);

 //$this->Line(188,33,188,42);
 $this->Cell(22,6,'INT',0,0,'C',0);
  //$this->Line(143,33,143,42);
  $this->Cell(9,6,'EXT',0,0,'C',0);

 
 
  $this->Line(207.4,21,207.4,38);
  $this->SetXY(200,33);
// $this->Line(218,33,218,42);
 $this->Cell(22,6,'INT',0,0,'C',0);
  //$this->Line(143,33,143,42);
  $this->Cell(9,6,'EXT',0,0,'C',0);





$this->Line(236,21,236,42);
$this->SetXY(230,33);
// $this->Line(248,33,248,42);
 $this->Cell(22,6,'INT',0,0,'C',0);
//  $this->Line(143,33,143,42);
  $this->Cell(9,6,'EXT',0,0,'C',0);


 $this->Line(264.6,21,264.6,42);
$this->SetXY(260,33);
 //$this->Line(278,33,278,42);
 $this->Cell(22,6,'INT',0,0,'C',0);
//  $this->Line(143,33,143,42);
  $this->Cell(9,6,'EXT',0,0,'C',0);
$this->Line(292,21,292,42);

}
   

// Page footer
function Footer()
{ 
 $ctime = date("d-m-Y");
 
    // Position at 1.5 cm from bottom
    $this->SetXY(280,-10);
    // Arial italic 8
    $this->SetFont('Arial','I',6);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    $this->SetXY(50,-10);
$this->SetFont('Arial','',8);
$this->Write(0,'Dean/Principal_______________________');
 $this->SetXY(120,-10);
$this->SetFont('Arial','',8);
$this->Write(0,'Head of Department_______________________');
 $this->SetXY(210,-10);
$this->SetFont('Arial','',8);
$this->Write(0,'Class coordinator_______________________');

//$a=$GLOBALS['a'];
 $this->SetXY(10,-5);
$this->SetFont('Arial','',6);
$this->Write(0,'Generated on : '.$ctime.' by ');
$this->SetXY(120,-4);
$this->SetFont('Arial','',6);
$this->Write(0,'(T)  Theory       (P)  Practical      (NA)  Not Applicable      (INT)  Internal      (EXT)  External  ');


}
}
$pdf = new PDF();
$pdf->SetTitle('Guru Kashi University');
$pdf->AliasNbPages();
$conntest = $GLOBALS['conntest'];

 $subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1'";


 $list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                  
              if($list_Subjects === false)
                {
               die( print_r( sqlsrv_errors(), true) );
               }
                while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $Subjects[]=$row_subject['SubjectCode'] ;
                $SubjectNames[]=$row_subject['SubjectName'] ;
                $SubjectTypes[]=$row_subject['SubjectType'] ;
}




$list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo
FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";


        $j=0;
       
       
                $list_result = sqlsrv_query($conntest,$list_sql);
                    $count = 1;
              if($list_result === false)
                {
               die( print_r( sqlsrv_errors(), true) );
               }
                while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $UnirollNos[]=$row['UniRollNo'];
                $ClassRollNos[]=$row['ClassRollNo'];
                 $Examid[]=$row['ID'];
                 $StudentNames[] =$row['StudentName'];
        
  $j++;
               


      

 }

 $SubjectCodeExam=array();


 //print_r($UnirollNos);


$i=0;
 if($j>25)
  {
   $k=$i+25;
  }
else
{
  $k=$j;
}



//Page -1

 $pdf->AddPage('L');
 $pdf->SetFont('Arial','b',10);
 $pdf->SetXY(93,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(28,3,$SubjectNames[0]."  / ".$Subjects[0]." (".$SubjectTypes[0].")",0,'C'); 
 $pdf->SetXY(122,21);
 $pdf->MultiCell(28,3,$SubjectNames[1]."  / ".$Subjects[1]." (".$SubjectTypes[1].")",0,'C');
 $pdf->SetXY(151,21);
 $pdf->MultiCell(28,3,$SubjectNames[2]."  / ".$Subjects[2]." (".$SubjectTypes[2].")",0,'C');
  $pdf->SetXY(180,21);
  $pdf->MultiCell(28,3,$SubjectNames[3]."  / ".$Subjects[3]." (".$SubjectTypes[3].")",0,'C');
  $pdf->SetXY(208,21);
  $pdf->MultiCell(28,3,$SubjectNames[4]."  / ".$Subjects[4]." (".$SubjectTypes[4].")",0,'C');
  $pdf->SetXY(236,21);
  $pdf->MultiCell(28,3,$SubjectNames[5]."  / ".$Subjects[5]." (".$SubjectTypes[5].")",0,'C');
  $pdf->SetXY(264,21);
  $pdf->MultiCell(28,3,$SubjectNames[6]."  / ".$Subjects[6]." (".$SubjectTypes[6].")",0,'C');

$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=1;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
   $pdf->MultiCell(16,6,$ClassRollNos[$i],1,'C');

  $pdf->SetXY(35,$y);

  $pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(58,$y);
   $sed=Strlen($StudentNames[$i]);
  if($sed>=18)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
  $pdf->MultiCell(35,$col,$StudentNames[$i],1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(93,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();

for($sub=0;$sub<8;$sub++)
{

 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                     
                  
                  $InternalExam[]= $row_exam['InternalExam'];

                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[5],1,0,'C',0);
$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(13.2,6,$ExternalExam[6],1,0,'C',0);

  $y=$y+5.9;

}


// **************************************************page-2*************************************************
if($j>25)
  {
   $k=$i+25;
  }
else
{
  $k=$j;
}
if($j>$i)
{
 $pdf->AddPage('L');
 $pdf->SetFont('Arial','b',10);
 $pdf->SetXY(93,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(28,3,$SubjectNames[0]."  / ".$Subjects[0]." (".$SubjectTypes[0].")",0,'C'); 
 $pdf->SetXY(122,21);
 $pdf->MultiCell(28,3,$SubjectNames[1]."  / ".$Subjects[1]." (".$SubjectTypes[1].")",0,'C');
 $pdf->SetXY(151,21);
 $pdf->MultiCell(28,3,$SubjectNames[2]."  / ".$Subjects[2]." (".$SubjectTypes[2].")",0,'C');
  $pdf->SetXY(180,21);
  $pdf->MultiCell(28,3,$SubjectNames[3]."  / ".$Subjects[3]." (".$SubjectTypes[3].")",0,'C');
  $pdf->SetXY(208,21);
  $pdf->MultiCell(28,3,$SubjectNames[4]."  / ".$Subjects[4]." (".$SubjectTypes[4].")",0,'C');
  $pdf->SetXY(236,21);
  $pdf->MultiCell(28,3,$SubjectNames[5]."  / ".$Subjects[5]." (".$SubjectTypes[5].")",0,'C');
  $pdf->SetXY(264,21);
  $pdf->MultiCell(28,3,$SubjectNames[6]."  / ".$Subjects[6]." (".$SubjectTypes[6].")",0,'C');

$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
   $pdf->MultiCell(16,6,$ClassRollNos[$i],1,'C');

  $pdf->SetXY(35,$y);

  $pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(58,$y);
   $sed=Strlen($StudentNames[$i]);
  if($sed>=18)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
  $pdf->MultiCell(35,$col,$StudentNames[$i],1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(93,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();

for($sub=0;$sub<8;$sub++)
{

 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                     
                  
                  $InternalExam[]= $row_exam['InternalExam'];

                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[5],1,0,'C',0);
$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(13.2,6,$ExternalExam[6],1,0,'C',0);

  $y=$y+5.9;

}
}
//***************************************page-3**************************************
 if($j>25)
  {
   $k=$i+25;
  }
else
{
  $k=$j;
}
if($j>$i)
{
 $pdf->AddPage('L');
 $pdf->SetFont('Arial','b',10);
 $pdf->SetXY(93,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(28,3,$SubjectNames[0]."  / ".$Subjects[0]." (".$SubjectTypes[0].")",0,'C'); 
 $pdf->SetXY(122,21);
 $pdf->MultiCell(28,3,$SubjectNames[1]."  / ".$Subjects[1]." (".$SubjectTypes[1].")",0,'C');
 $pdf->SetXY(151,21);
 $pdf->MultiCell(28,3,$SubjectNames[2]."  / ".$Subjects[2]." (".$SubjectTypes[2].")",0,'C');
  $pdf->SetXY(180,21);
  $pdf->MultiCell(28,3,$SubjectNames[3]."  / ".$Subjects[3]." (".$SubjectTypes[3].")",0,'C');
  $pdf->SetXY(208,21);
  $pdf->MultiCell(28,3,$SubjectNames[4]."  / ".$Subjects[4]." (".$SubjectTypes[4].")",0,'C');
  $pdf->SetXY(236,21);
  $pdf->MultiCell(28,3,$SubjectNames[5]."  / ".$Subjects[5]." (".$SubjectTypes[5].")",0,'C');
  $pdf->SetXY(264,21);
  $pdf->MultiCell(28,3,$SubjectNames[6]."  / ".$Subjects[6]." (".$SubjectTypes[6].")",0,'C');

$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
   $pdf->MultiCell(16,6,$ClassRollNos[$i],1,'C');

  $pdf->SetXY(35,$y);

  $pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(58,$y);
   $sed=Strlen($StudentNames[$i]);
  if($sed>=18)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
  $pdf->MultiCell(35,$col,$StudentNames[$i],1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(93,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();

for($sub=0;$sub<8;$sub++)
{

 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                     
                  
                  $InternalExam[]= $row_exam['InternalExam'];

                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[5],1,0,'C',0);
$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(13.2,6,$ExternalExam[6],1,0,'C',0);

  $y=$y+5.9;

}
}
//***************************************page-4**************************************
 if($j>25)
  {
   $k=$i+25;
  }
else
{
  $k=$j;
}
if($j>$i)
{
 $pdf->AddPage('L');
 $pdf->SetFont('Arial','b',10);
 $pdf->SetXY(93,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(28,3,$SubjectNames[0]."  / ".$Subjects[0]." (".$SubjectTypes[0].")",0,'C'); 
 $pdf->SetXY(122,21);
 $pdf->MultiCell(28,3,$SubjectNames[1]."  / ".$Subjects[1]." (".$SubjectTypes[1].")",0,'C');
 $pdf->SetXY(151,21);
 $pdf->MultiCell(28,3,$SubjectNames[2]."  / ".$Subjects[2]." (".$SubjectTypes[2].")",0,'C');
  $pdf->SetXY(180,21);
  $pdf->MultiCell(28,3,$SubjectNames[3]."  / ".$Subjects[3]." (".$SubjectTypes[3].")",0,'C');
  $pdf->SetXY(208,21);
  $pdf->MultiCell(28,3,$SubjectNames[4]."  / ".$Subjects[4]." (".$SubjectTypes[4].")",0,'C');
  $pdf->SetXY(236,21);
  $pdf->MultiCell(28,3,$SubjectNames[5]."  / ".$Subjects[5]." (".$SubjectTypes[5].")",0,'C');
  $pdf->SetXY(264,21);
  $pdf->MultiCell(28,3,$SubjectNames[6]."  / ".$Subjects[6]." (".$SubjectTypes[6].")",0,'C');

$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
   $pdf->MultiCell(16,6,$ClassRollNos[$i],1,'C');

  $pdf->SetXY(35,$y);

  $pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(58,$y);
   $sed=Strlen($StudentNames[$i]);
  if($sed>=18)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
  $pdf->MultiCell(35,$col,$StudentNames[$i],1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(93,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();

for($sub=0;$sub<8;$sub++)
{

 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                     
                  
                  $InternalExam[]= $row_exam['InternalExam'];

                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[5],1,0,'C',0);
$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(13.2,6,$ExternalExam[6],1,0,'C',0);

  $y=$y+5.9;

}
}

if($j>25)
  {
   $k=$i+25;
  }
else
{
  $k=$j;
}
if($j>$i)
{
 $pdf->AddPage('L');
 $pdf->SetFont('Arial','b',10);
 $pdf->SetXY(93,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(28,3,$SubjectNames[0]."  / ".$Subjects[0]." (".$SubjectTypes[0].")",0,'C'); 
 $pdf->SetXY(122,21);
 $pdf->MultiCell(28,3,$SubjectNames[1]."  / ".$Subjects[1]." (".$SubjectTypes[1].")",0,'C');
 $pdf->SetXY(151,21);
 $pdf->MultiCell(28,3,$SubjectNames[2]."  / ".$Subjects[2]." (".$SubjectTypes[2].")",0,'C');
  $pdf->SetXY(180,21);
  $pdf->MultiCell(28,3,$SubjectNames[3]."  / ".$Subjects[3]." (".$SubjectTypes[3].")",0,'C');
  $pdf->SetXY(208,21);
  $pdf->MultiCell(28,3,$SubjectNames[4]."  / ".$Subjects[4]." (".$SubjectTypes[4].")",0,'C');
  $pdf->SetXY(236,21);
  $pdf->MultiCell(28,3,$SubjectNames[5]."  / ".$Subjects[5]." (".$SubjectTypes[5].")",0,'C');
  $pdf->SetXY(264,21);
  $pdf->MultiCell(28,3,$SubjectNames[6]."  / ".$Subjects[6]." (".$SubjectTypes[6].")",0,'C');

$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
   $pdf->MultiCell(16,6,$ClassRollNos[$i],1,'C');

  $pdf->SetXY(35,$y);

  $pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(58,$y);
   $sed=Strlen($StudentNames[$i]);
  if($sed>=18)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
  $pdf->MultiCell(35,$col,$StudentNames[$i],1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(93,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();

for($sub=0;$sub<8;$sub++)
{

 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                     
                  
                  $InternalExam[]= $row_exam['InternalExam'];

                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[5],1,0,'C',0);
$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(13.2,6,$ExternalExam[6],1,0,'C',0);

  $y=$y+5.9;

}
}

//***************************************page-5**************************************
 if($j>25)
  {
   $k=$i+25;
  }
else
{
  $k=$j;
}
if($j>$i)
{
 $pdf->AddPage('L');
 $pdf->SetFont('Arial','b',10);
 $pdf->SetXY(93,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(28,3,$SubjectNames[0]."  / ".$Subjects[0]." (".$SubjectTypes[0].")",0,'C'); 
 $pdf->SetXY(122,21);
 $pdf->MultiCell(28,3,$SubjectNames[1]."  / ".$Subjects[1]." (".$SubjectTypes[1].")",0,'C');
 $pdf->SetXY(151,21);
 $pdf->MultiCell(28,3,$SubjectNames[2]."  / ".$Subjects[2]." (".$SubjectTypes[2].")",0,'C');
  $pdf->SetXY(180,21);
  $pdf->MultiCell(28,3,$SubjectNames[3]."  / ".$Subjects[3]." (".$SubjectTypes[3].")",0,'C');
  $pdf->SetXY(208,21);
  $pdf->MultiCell(28,3,$SubjectNames[4]."  / ".$Subjects[4]." (".$SubjectTypes[4].")",0,'C');
  $pdf->SetXY(236,21);
  $pdf->MultiCell(28,3,$SubjectNames[5]."  / ".$Subjects[5]." (".$SubjectTypes[5].")",0,'C');
  $pdf->SetXY(264,21);
  $pdf->MultiCell(28,3,$SubjectNames[6]."  / ".$Subjects[6]." (".$SubjectTypes[6].")",0,'C');

$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
   $pdf->MultiCell(16,6,$ClassRollNos[$i],1,'C');

  $pdf->SetXY(35,$y);

  $pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(58,$y);
   $sed=Strlen($StudentNames[$i]);
  if($sed>=18)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
  $pdf->MultiCell(35,$col,$StudentNames[$i],1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(93,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();

for($sub=0;$sub<8;$sub++)
{

 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                     
                  
                  $InternalExam[]= $row_exam['InternalExam'];

                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[5],1,0,'C',0);
$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(13.2,6,$ExternalExam[6],1,0,'C',0);

  $y=$y+5.9;

}
}

if($j>25)
  {
   $k=$i+25;
  }
else
{
  $k=$j;
}
if($j>$i)
{
 $pdf->AddPage('L');
 $pdf->SetFont('Arial','b',10);
 $pdf->SetXY(93,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(28,3,$SubjectNames[0]."  / ".$Subjects[0]." (".$SubjectTypes[0].")",0,'C'); 
 $pdf->SetXY(122,21);
 $pdf->MultiCell(28,3,$SubjectNames[1]."  / ".$Subjects[1]." (".$SubjectTypes[1].")",0,'C');
 $pdf->SetXY(151,21);
 $pdf->MultiCell(28,3,$SubjectNames[2]."  / ".$Subjects[2]." (".$SubjectTypes[2].")",0,'C');
  $pdf->SetXY(180,21);
  $pdf->MultiCell(28,3,$SubjectNames[3]."  / ".$Subjects[3]." (".$SubjectTypes[3].")",0,'C');
  $pdf->SetXY(208,21);
  $pdf->MultiCell(28,3,$SubjectNames[4]."  / ".$Subjects[4]." (".$SubjectTypes[4].")",0,'C');
  $pdf->SetXY(236,21);
  $pdf->MultiCell(28,3,$SubjectNames[5]."  / ".$Subjects[5]." (".$SubjectTypes[5].")",0,'C');
  $pdf->SetXY(264,21);
  $pdf->MultiCell(28,3,$SubjectNames[6]."  / ".$Subjects[6]." (".$SubjectTypes[6].")",0,'C');

$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
   $pdf->MultiCell(16,6,$ClassRollNos[$i],1,'C');

  $pdf->SetXY(35,$y);

  $pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(58,$y);
   $sed=Strlen($StudentNames[$i]);
  if($sed>=18)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
  $pdf->MultiCell(35,$col,$StudentNames[$i],1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(93,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();

for($sub=0;$sub<8;$sub++)
{

 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                     
                  
                  $InternalExam[]= $row_exam['InternalExam'];

                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[5],1,0,'C',0);
$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(13.2,6,$ExternalExam[6],1,0,'C',0);

  $y=$y+5.9;

}
}




























$i=0;
 if($j>25)
  {
   $k=$i+25;
  }
else
{
  $k=$j;
}



//***********************************************************************************************Page -1/1****************************************************************

 $pdf->AddPage('L');
 $pdf->SetFont('Arial','b',10);
 $pdf->SetXY(93,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(28,3,$SubjectNames[8]."  / ".$Subjects[8]." (".$SubjectTypes[8].")",0,'C'); 
 $pdf->SetXY(122,21);
 $pdf->MultiCell(28,3,$SubjectNames[9]."  / ".$Subjects[9]." (".$SubjectTypes[9].")",0,'C');
 $pdf->SetXY(151,21);
 $pdf->MultiCell(28,3,$SubjectNames[2]."  / ".$Subjects[2]." (".$SubjectTypes[2].")",0,'C');
  $pdf->SetXY(180,21);
  $pdf->MultiCell(28,3,$SubjectNames[3]."  / ".$Subjects[3]." (".$SubjectTypes[3].")",0,'C');
  $pdf->SetXY(208,21);
  $pdf->MultiCell(28,3,$SubjectNames[4]."  / ".$Subjects[4]." (".$SubjectTypes[4].")",0,'C');
  $pdf->SetXY(236,21);
  $pdf->MultiCell(28,3,$SubjectNames[5]."  / ".$Subjects[5]." (".$SubjectTypes[5].")",0,'C');
  $pdf->SetXY(264,21);
  $pdf->MultiCell(28,3,$SubjectNames[6]."  / ".$Subjects[6]." (".$SubjectTypes[6].")",0,'C');

$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=1;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
   $pdf->MultiCell(16,6,$ClassRollNos[$i],1,'C');

  $pdf->SetXY(35,$y);

  $pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(58,$y);
   $sed=Strlen($StudentNames[$i]);
  if($sed>=18)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
  $pdf->MultiCell(35,$col,$StudentNames[$i],1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(93,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();

for($sub=0;$sub<8;$sub++)
{

 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                     
                  
                  $InternalExam[]= $row_exam['InternalExam'];

                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[0],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[1],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[2],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[3],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[4],1,0,'C',0);
$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(14.3,6,$ExternalExam[5],1,0,'C',0);
$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(13.2,6,$ExternalExam[6],1,0,'C',0);

  $y=$y+5.9;

}























$pdf->Output();
  ?>

















