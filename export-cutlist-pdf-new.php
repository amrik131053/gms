<?php
session_start();
ini_set('max_execution_time', '0');
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
      $this->Cell(123,6,$Group,0,1);
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

$this->Line(93,38,291,38);



//Sr No left line 
$this->Line(8,21,8,42);
$this->SetXY(7,23);
// $this->Cell(10,6,'Sr No',0,0,'C',0);
$this->MultiCell(9,6,'Sr No',0,'C');
$this->Line(15,21,15,42);
 $this->SetXY(15,21);

$this->MultiCell(35,6,'Class Roll No / Uni RollNo',0,'C');

$this->Line(50,21,50,38);

$this->SetXY(37,21);

//$this->MultiCell(21,6,'Uni RollNo',0,'C');

//$this->Line(58,21,58,38);
$this->SetXY(55,21);

$this->MultiCell(20,6,'Name',0,'C');


 $this->Line(79,21,79,38);

$this->SetFont('Arial','b',8);
 
 //$this->Line(121.6,21,121.6,38);
 
//$this->Line(150.2,21,150.2,38);
 
//$this->Line(170.8,21,170.8,38);
 
//$this->Line(199.4,21,199.4,38);

//$this->Line(228,21,228,42);

//$this->Line(264.6,21,264.6,42);

$this->Line(291.3,21,291.3,38);

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
$this->Write(0,'(T)  Theory       (P)  Practical      (NA)  Not Applicable    ');


}
}






$pdf = new PDF();
$pdf->SetTitle('Guru Kashi University');
$pdf->AliasNbPages();
$SubjectCodeExam= array();
 $IDNos=array();
 $SubjectNames=array();
$SubjectTypes=array();
$UnirollNos=array();
$ClassRollNos=array();
$Examid=array();
$StudentNames=array();
$Snap=array();
$Gender=array();
$Subjects1=array();
$conntest = $GLOBALS['conntest'];


 $subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' AND SGroup='$Group' ";
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

                $Subjects1[]=$row_subject['SubjectCode'] ;

                $SubjectNames[]=$row_subject['SubjectName'] ;

                $SubjectTypes[]=$row_subject['SubjectType'] ;
            $subcount++;
  }
   $sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='O' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";
  $sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {

 $Subjects[$subcount]=$row_subject['SubjectCode'] ;

 $Subjects1[$subcount]=$row_subject['SubjectCode'] ;

                $SubjectNames[$subcount]=$row_subject['SubjectName'] ;
                $SubjectTypes[$subcount]=$row_subject['SubjectType'] ;
  $subcount++;
 }

if($subcount<=11){

    $pageone=$subcount;
}
else
{
    $pageone =11;}

if($subcount>11 && $subcount<=22)
{
   $pagetwo=$subcount;
}
else
{
   $pagetwo=22; 
}

if($subcount>22 && $subcount<=33)
{
   $pagethree=$subcount;
}
else
{
  $pagethree=33;
}
if($subcount>23 && $subcount<=44)
{
   $pagefour=$subcount;
}
else
{
  $pagefour=44;
}
if($subcount>44 && $subcount<=55)
{
   $pagefive=$subcount;
}
else
{
   $pagefive=55; 
}



  $list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo,Admissions.Sex
   FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";
        $j=100;
       
       
                $list_result = sqlsrv_query($conntest,$list_sql);
                    $count = 1;
              if($list_result === false)
                {
               die( print_r( sqlsrv_errors(), true) );
               }
                while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                   {
                $IDNos[]=$row['IDNo'];
                $UnirollNos[]=$row['UniRollNo'];
                $ClassRollNos[]=$row['ClassRollNo'];
                 $Examid[]=$row['ID'];
                 $StudentNames[] =$row['StudentName'];
                                       
                  }

 $i=0;
 //$totalStudent =30;
 $totalStudent = count($IDNos);
 if (empty($IDNos)) {
    $pdf = new FPDF();
    $pdf->AddPage('L');
    $pdf->SetXY(10, 100);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, ' No Record Found!!!!!.', 0, 1, 'C');
 }


 else
 {
//page 1
    for ($p = 0; $p < $totalStudent / 25; $p++) 

    {
        $pdf->AddPage('L');
        $pdf->SetFont('Arial', 'b', 10);
        $x = 79;
        
        for($key=0;$key<$pageone;$key++)
        
         {
        $pdf->SetXY($x, 23);
        $pdf->SetFont('Arial', 'b', 6);
        $pdf->MultiCell(19, 3, $SubjectNames[$key] . " / " . $Subjects[$key] . " /" . $SubjectTypes[$key],0, 'C');
        $x += 19.3; 

    }
   
    $pdf->SetFont('Arial', 'b', 10);
    $pdf->SetXY(8, 30);
    $r=79;
    $g=38;
    for ($i = $p * 25,$y=38; $i < min(($p + 1) * 25,$totalStudent); $i++)
     {
        $pdf->SetXY(8, $y);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(7   , 6,$i+1, 1, 0, 'C', 0);
        $pdf->SetFont('Times','b',8);
        $pdf->SetXY(15,$y);
        $smal =strtolower($StudentNames[$i]);
      $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

      $pdf->SetXY(15,$y);
      $pdf->Cell(35,6,"",1,0,'C',0);
      $pdf->Cell(29,6,"",1,0,'C',0);
      $pdf->SetXY(50,$y);
      $pdf->SetFont('Times','b',6);
      $pdf->MultiCell(29,3,ucwords($smal),0,'l');
        $pdf->SetXY(35,$y);
        $pdf->SetFont('Times','B',8);
        $pdf->SetXY(79,$y);

       $ExternalExam=array();

        for($sub=0;$sub<$pageone;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd 
        SubjectCode='$Subjects[$sub]' AND ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3, 6,$row_exam['ExternalExam'],1, 'C');
            $r += 19.3; 
                          }
                          else 
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3, 6,'N' ,1,'C');
            $r += 19.3; 
                          }
          }

 //print_r($ExternalExam);
  // echo "<br>";

                    
        $y = $y + 6;
        $r=79;
        $g=$g+6; 
    }

 } 


//page-2
 if($subcount>11)
 {
  for ($p = 0; $p < $totalStudent / 25; $p++) 

    {
        $pdf->AddPage('L');
        $pdf->SetFont('Arial', 'b', 10);
        $x = 79;
        
        for($key=$pageone;$key<$pagetwo;$key++)
        
         {
        $pdf->SetXY($x, 23);
        $pdf->SetFont('Arial', 'b', 6);
        $pdf->MultiCell(19, 3, $SubjectNames[$key] . " / " . $Subjects[$key] . " /" . $SubjectTypes[$key],0, 'C');
        $x += 19.3; 

    }
   
    $pdf->SetFont('Arial', 'b', 10);
    $pdf->SetXY(8, 30);
    $r=79;
    $g=38;
    for ($i = $p * 25,$y=38; $i < min(($p + 1) * 25,$totalStudent); $i++)
     {
        $pdf->SetXY(8, $y);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(7   , 6,$i+1, 1, 0, 'C', 0);
        $pdf->SetFont('Times','b',8);
        $pdf->SetXY(15,$y);
        $smal =strtolower($StudentNames[$i]);
      $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

      $pdf->SetXY(15,$y);
      $pdf->Cell(35,6,"",1,0,'C',0);
      $pdf->Cell(29,6,"",1,0,'C',0);
      $pdf->SetXY(50,$y);
      $pdf->SetFont('Times','b',6);
      $pdf->MultiCell(29,3,ucwords($smal),0,'l');
        $pdf->SetXY(35,$y);
        $pdf->SetFont('Times','B',8);
        $pdf->SetXY(79,$y);

       $ExternalExam=array();

        for($sub=$pageone;$sub<$pagetwo;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd SubjectCode='$Subjects[$sub]'AND ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3, 6,$row_exam['ExternalExam'],1, 'C');
            $r += 19.3; 
                          }
                          else 
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3, 6,'N' ,1,'C');
            $r += 19.3; 
                          }
          }

 //print_r($ExternalExam);
  // echo "<br>";

                    
        $y = $y + 6;
        $r=79;
        $g=$g+6; 
    }

 } 

}
//page-3
 if($subcount>22)
 {
  for ($p = 0; $p < $totalStudent / 25; $p++) 

    {
        $pdf->AddPage('L');
        $pdf->SetFont('Arial', 'b', 10);
        $x = 79;
        
        for($key=$pagetwo;$key<$pagethree;$key++)
         {
        $pdf->SetXY($x, 23);
        $pdf->SetFont('Arial', 'b', 6);
       // echo $pagethree;
        $pdf->MultiCell(19, 3, $SubjectNames[$key] . " / " . $Subjects[$key] . " /" . $SubjectTypes[$key],0, 'C');
        $x += 19.3; 
    }
   
    $pdf->SetFont('Arial', 'b', 10);
    $pdf->SetXY(8, 30);
    $r=79;
    $g=38;
    for ($i = $p * 25,$y=38; $i < min(($p + 1) * 25,$totalStudent); $i++)
     {
        $pdf->SetXY(8, $y);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(7   , 6,$i+1, 1, 0, 'C', 0);
        $pdf->SetFont('Times','b',8);
        $pdf->SetXY(15,$y);
        $smal =strtolower($StudentNames[$i]);
      $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

      $pdf->SetXY(15,$y);
      $pdf->Cell(35,6,"",1,0,'C',0);
      $pdf->Cell(29,6,"",1,0,'C',0);
      $pdf->SetXY(50,$y);
      $pdf->SetFont('Times','b',6);
      $pdf->MultiCell(29,3,ucwords($smal),0,'l');
        $pdf->SetXY(35,$y);
        $pdf->SetFont('Times','B',8);
        $pdf->SetXY(79,$y);

       $ExternalExam=array();

        for($sub=$pagetwo;$sub<$pagethree;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd SubjectCode='$Subjects[$sub]'AND ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3, 6,$row_exam['ExternalExam'],1, 'C');
            $r += 19.3; 
                          }
                          else 
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3, 6,'N' ,1,'C');
            $r += 19.3; 
                          }
          }

 //print_r($ExternalExam);
  // echo "<br>";

                    
        $y = $y + 6;
        $r=79;
        $g=$g+6; 
    }

 } 

}

//page=4
 if($subcount>33)
 {
  for ($p = 0; $p < $totalStudent / 25; $p++) 

    {
        $pdf->AddPage('L');
        $pdf->SetFont('Arial', 'b', 10);
        $x = 79;
        
        for($key=$pagethree;$key<$pagefour;$key++)
        
         {
        $pdf->SetXY($x, 23);
        $pdf->SetFont('Arial', 'b', 6);
        $pdf->MultiCell(19, 3, $SubjectNames[$key] . " / " . $Subjects[$key] . " /" . $SubjectTypes[$key],0, 'C');
        $x += 19.3; 

    }
   
    $pdf->SetFont('Arial', 'b', 10);
    $pdf->SetXY(8, 30);
    $r=79;
    $g=38;
    for ($i = $p * 25,$y=38; $i < min(($p + 1) * 25,$totalStudent); $i++)
     {
        $pdf->SetXY(8, $y);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(7   , 6,$i+1, 1, 0, 'C', 0);
        $pdf->SetFont('Times','b',8);
        $pdf->SetXY(15,$y);
        $smal =strtolower($StudentNames[$i]);
      $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

      $pdf->SetXY(15,$y);
      $pdf->Cell(35,6,"",1,0,'C',0);
      $pdf->Cell(29,6,"",1,0,'C',0);
      $pdf->SetXY(50,$y);
      $pdf->SetFont('Times','b',6);
      $pdf->MultiCell(29,3,ucwords($smal),0,'l');
        $pdf->SetXY(35,$y);
        $pdf->SetFont('Times','B',8);
        $pdf->SetXY(79,$y);

       $ExternalExam=array();

        for($sub=$pagethree;$sub<$pagefour;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd SubjectCode='$Subjects[$sub]'AND ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3, 6,$row_exam['ExternalExam'],1, 'C');
            $r += 19.3; 
                          }
                          else 
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3,6,'N',1,'C');
            $r += 19.3; 
                          }
          }

 //print_r($ExternalExam);
  // echo "<br>";

                    
        $y = $y + 6;
        $r=79;
        $g=$g+6; 
    }

 } 

}
//page 5
 if($subcount>44)
 {
  for ($p = 0; $p < $totalStudent / 25; $p++) 

    {
        $pdf->AddPage('L');
        $pdf->SetFont('Arial', 'b', 10);
        $x = 79;
        
        for($key=$pagefour;$key<$pagefive;$key++)
        
         {
        $pdf->SetXY($x, 23);
        $pdf->SetFont('Arial', 'b', 6);
        $pdf->MultiCell(19, 3, $SubjectNames[$key] . " / " . $Subjects[$key] . " /" . $SubjectTypes[$key],0, 'C');
        $x += 19.3; 

    }
   
    $pdf->SetFont('Arial', 'b', 10);
    $pdf->SetXY(8, 30);
    $r=79;
    $g=38;
    for ($i = $p * 25,$y=38; $i < min(($p + 1) * 25,$totalStudent); $i++)
     {
        $pdf->SetXY(8, $y);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(7   , 6,$i+1, 1, 0, 'C', 0);
        $pdf->SetFont('Times','b',8);
        $pdf->SetXY(15,$y);
        $smal =strtolower($StudentNames[$i]);
      $pdf->MultiCell(35,6,$ClassRollNos[$i]."/".$UnirollNos[$i],1,'C');

      $pdf->SetXY(15,$y);
      $pdf->Cell(35,6,"",1,0,'C',0);
      $pdf->Cell(29,6,"",1,0,'C',0);
      $pdf->SetXY(50,$y);
      $pdf->SetFont('Times','b',6);
      $pdf->MultiCell(29,3,ucwords($smal),0,'l');
        $pdf->SetXY(35,$y);
        $pdf->SetFont('Times','B',8);
        $pdf->SetXY(79,$y);

       $ExternalExam=array();

        for($sub=$pagefour;$sub<$pagefive;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid[$i]' ANd SubjectCode='$Subjects[$sub]'AND ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3, 6,$row_exam['ExternalExam'],1, 'C');
            $r += 19.3; 
                          }
                          else 
                          {
                            $pdf->SetXY($r, $g);
            $pdf->SetFont('Arial', 'b', 6);
            $pdf->MultiCell(19.3,6,'N',1,'C');
            $r += 19.3; 
                          }
          }

 //print_r($ExternalExam);
  // echo "<br>";

                    
        $y = $y + 6;
        $r=79;
        $g=$g+6; 
    }

 } 

}




}


//echo $subcount;


$pdf->Output();
  ?>