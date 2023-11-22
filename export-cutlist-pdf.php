<?php
session_start();
ini_set('max_execution_time', '0');
include 'connection/connection.php';
$output = '';  
$ctime = date("d-m-Y");
$nowtime = strtotime($ctime);


  $College = "65";
  $Course = "128";
  $Batch = "2023";
  $Semester = "1";
  $Type = "Regular";
  $Group = "NA";
  $Examination = "December 2023";
  // $College = $_POST['College'];
  // $Coursei = $_POST['Course'];
  // $Batch = $_POST['Batch'];
  // $Semester = $_POST['Semester'];
  // $Type = $_POST['Type'];
  // $Group = $_POST['Group'];
  // $Examination = $_POST['Examination'];

  $collegename="SELECT CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
$list_cllegename = sqlsrv_query($conntest,$collegename);
                  
              
                if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $CollegeName=$row_college['CollegeName'] ;
                $CourseName=$row_college['Course'] ;
                
        }

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


$CourseName=$GLOBALS['CourseName'];

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

     $this-> Image('dist/img/new-logo.jpg',10,5,50,9);
     $this-> Image('dist/img/naac-logo.jpg',255,5,33,9);
     $this->SetXY(50,8);
$this->SetFont('Arial','B',10);
$this->MultiCell(200,6,$CourseName,'0','C');

       $this->SetFont('Arial','B',10);
       $this->SetX(50,12);
      $this->MultiCell(200,6,'Cutlist Examination('.$Examination.')',0,'C');
  if($Group!='NA')
  {
$this->SetFont('Arial','B',10);
 $this->SetXY(210,4);
      $this->Cell(123,6,$grp,0,1);
}
$this->SetXY(10,17);
$this->Write(0,'Batch : ');
$this->SetXY(24,15.8);
$this->MultiCell(80,2.7,$Batch,'0');

$this->SetXY(230,17);
$this->Write(0,'Semester :');
$this->SetXY(250,17 );
$this->Write(0,$Semester);
$this->subWrite(0,$ext,'',6,4);
$this->Write(0,'('.$Type.')');



$this->Line(8,21,291,21);

//$this->Line(93,33,292,33);



//Sr No left line 
$this->Line(8,21,8,42);
$this->SetXY(8,23);
$this->Cell(10,6,'Sr No',0,0,'C',0);
$this->Line(19,21,19,42);
 $this->SetXY(19,21);

$this->MultiCell(35,6,'Class Roll No / Uni RollNo',0,'C');

$this->Line(54,21,54,38);

$this->SetXY(37,21);

//$this->MultiCell(21,6,'Uni RollNo',0,'C');

//$this->Line(58,21,58,38);
$this->SetXY(58,21);

$this->MultiCell(20,6,'Name',0,'C');


 $this->Line(79,21,79,38);

$this->SetFont('Arial','b',8);
 
 //$this->Line(121.6,21,121.6,38);
 
//$this->Line(150.2,21,150.2,38);
 
//$this->Line(170.8,21,170.8,38);
 
//$this->Line(199.4,21,199.4,38);

//$this->Line(228,21,228,42);

//$this->Line(264.6,21,264.6,42);

$this->Line(291.3,21,291.3,42);

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

$subcount=0;
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

            $subcount++;
}

$sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='O' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";

$sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {

$Subjects[$subcount]=$row_subject['SubjectCode'] ;
                $SubjectNames[$subcount]=$row_subject['SubjectName'] ;
                $SubjectTypes[$subcount]=$row_subject['SubjectType'] ;

$subcount++;

}


//print_r($Subjects);



for($as=$subcount;$as<12;$as++)
{
   $Subjects[$as]='';
   $SubjectNames[$as]='';
   $SubjectTypes[$as]='';
     $ExternalExam[$as]='';
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




 //print_r($j);


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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=1;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}


// **************************************************page-2*************************************************
if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}
// **************************************page-3**************************************

if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}
// //***************************************page-4**************************************


if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}





// **************************************page-5**************************************

if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}
// //***************************************page-6**************************************


if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}








// **************************************page-7**************************************

if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}


// //***************************************page-8**************************************


if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

  $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}


// **************************************page-9**************************************

if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}
// //***************************************page-10**************************************


if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}








// **************************************page-11**************************************

if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}
// //***************************************page-12**************************************


if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}

// //***************************************page-8**************************************


if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}


// **************************************page-13**************************************

if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}
// //***************************************page-14**************************************


if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}








// **************************************page-15**************************************

if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}
// //***************************************page-16**************************************


if($j>$i+25)
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
 $pdf->SetXY(79,21);
 $pdf->SetFont('Arial','b',6);
 $pdf->MultiCell(19.3,3,$SubjectNames[0]."  / ".$Subjects[0]." /".$SubjectTypes[0],0,'C'); 
 $pdf->SetXY(98.3,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[1]."  / ".$Subjects[1]." /".$SubjectTypes[1],0,'C');
 $pdf->SetXY(117.6,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[2]."  / ".$Subjects[2]." /".$SubjectTypes[2],0,'C');
 $pdf->SetXY(136.9,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[3]."  / ".$Subjects[3]." /".$SubjectTypes[3],0,'C');
 $pdf->SetXY(156.2,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[4]."  / ".$Subjects[4]." /".$SubjectTypes[4],0,'C');
 $pdf->SetXY(175.5,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[5]."  / ".$Subjects[5]." /".$SubjectTypes[5],0,'C');
 $pdf->SetXY(194.8,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[6]."  / ".$Subjects[6]."/".$SubjectTypes[6],0,'C');
  $pdf->SetXY(214.1,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[7]."  / ".$Subjects[7]." /".$SubjectTypes[7],0,'C');
 $pdf->SetXY(233.4,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[8]."  / ".$Subjects[8]." /".$SubjectTypes[8],0,'C');
 $pdf->SetXY(252.7,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[9]."  / ".$Subjects[9]." /".$SubjectTypes[9],0,'C');

 $pdf->SetXY(272,21);
 $pdf->MultiCell(19.3,3,$SubjectNames[10]."  / ".$Subjects[10]." /".$SubjectTypes[10],0,'C');
$pdf->SetXY(8,50);

for($i=$i,$y=38,$s=$s;$i<$k;$i++,$s++)
{ 
  $pdf->SetXY(8,$y);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(11,6,$s,1,0,'C',0);
  $pdf->SetFont('Times','b',8);
  $pdf->SetXY(19,$y);
  $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

  //$pdf->SetXY(35,$y);

  //$pdf->MultiCell(23,6,$UnirollNos[$i],1,'C');


  $pdf->SetXY(54,$y);

     $sed=Strlen($StudentNames[$i]);
  if($sed>=25)
  {
    $col=3;
  }
  else
  {
    $col=6;
  }
    $pdf->SetFont('Times','B',6);
     $smal =strtolower($StudentNames[$i]);

  $pdf->MultiCell(25,$col,ucwords($smal),1,'L');


  $pdf->SetFont('Times','B',6);

  $pdf->SetXY(79,$y);

$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();






for($sub=0;$sub<12;$sub++)
{
//$ExternalExam=array();



 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd  SubjectCode='$Subjects[$sub]' ";

 $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
     
if($list_result_examsubject === false)
                {
               die( print_r( sqlsrv_errors(), true) );
                }
                if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                   {
                   
                    //$InternalExam[]= $row_exam['InternalExam'];
                     $ExternalExam[]= $row_exam['ExternalExam'];

                   }
                   else
                   {
                    $ExternalExam[]='';
                   }

}


               //print_r($SubjectCodeExam);   
  
$pdf->SetFont('Times','',10);
//$pdf->Cell(14.3,6,$InternalExam[0],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[0],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[1],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[1],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[2],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[2],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[3],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[3],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[4],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[4],1,0,'C',0);
//$pdf->Cell(14.3,6,$InternalExam[5],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[5],1,0,'C',0);
//$pdf->Cell(14.2,6,$InternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[6],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[7],1,0,'C',0);
$pdf->Cell(19.3,6,$ExternalExam[8],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[9],1,0,'C',0);
 $pdf->Cell(19.3,6,$ExternalExam[10],1,0,'C',0);

  $y=$y+5.9;

}

}













$pdf->Output();
  ?>

















