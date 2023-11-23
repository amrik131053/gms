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
$this->Line(8,21,8,42);
$this->SetXY(8,23);
$this->Cell(10,6,'Sr No',0,0,'C',0);
$this->Line(19,21,19,42);
 $this->SetXY(19,21);
$this->MultiCell(35,6,'Class Roll No / Uni RollNo',0,'C');
$this->Line(54,21,54,38);
$this->SetXY(37,21);
$this->SetXY(55,21);
$this->SetFont('Arial','b',6);
$this->MultiCell(10,6,'Image',0,'C');
$this->SetFont('Arial','b',8);
$this->SetXY(65,23);
$this->Line(64,21,64,38);  //image
$this->MultiCell(20,6,'Signature',0,'C');
$this->Line(85.4,21,85.4,38);
$this->SetFont('Arial','b',8);

 $this->Line(120.8,21,120.8,38);  //subject name 1
 
$this->Line(156.2,21,156.2,38); //subject name 2

$this->Line(191.6,21,191.6,38); //subject name 3

$this->Line(227,21,227,38);  //subject name 4

$this->Line(262.4,21,262.4,42); //subject name 5

$this->Line(291,21,291,42); //subject name 6

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
$this->Write(0,'Signature of Invigilator_______________________');
 $this->SetXY(120,-10);
$this->SetFont('Arial','',8);
$this->Write(0,'Signature of Superintendent_______________________');
 $this->SetXY(210,-10);
$this->SetFont('Arial','',8);
$this->Write(0,'Signature of Dean_______________________');

//$a=$GLOBALS['a'];
 $this->SetXY(10,-5);
$this->SetFont('Arial','',6);
$this->Write(0,'Generated on : '.$ctime.' by ');
$this->SetXY(85,-30);
$this->SetFont('Arial','',6);
// $this->Write(0,'Invigilator______________________ Invigilator___________________ Invigilator_____________________ Invigilator___________________Invigilator____________________Invigilator_____________________');
}
}
$pdf = new PDF();
$pdf->SetTitle('Guru Kashi University');
$pdf->AliasNbPages();
$SubjectCodeExam= array();
$InternalExam= array();
 $ExternalExam= array();
$conntest = $GLOBALS['conntest'];
 $subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' and SubjectType='T'";
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
for($as=$subcount;$as<12;$as++)
{
   $Subjects[$as]='';
   $SubjectNames[$as]='';
   $SubjectTypes[$as]='';
   $ExternalExam[$as]='';
}

$list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo,Admissions.Snap,Admissions.Sex
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
                 $Snap[] =$row['Snap'];
                 $Gender[] =$row['Sex'];           
 }
                // print_r($ExternalExam);
$i=0;
$totalStudent = count($IDNos);

for ($p = 0; $p < $totalStudent / 10; $p++) {
    $pdf->AddPage('L');
    $pdf->SetFont('Arial', 'b', 10);
    $x = 87;
    for ($subIndex = 0; $subIndex < 6; $subIndex++) {
        $pdf->SetXY($x, 23);
        $pdf->SetFont('Arial', 'b', 6);
        $pdf->MultiCell(28, 3, $SubjectNames[$subIndex] . " / " . $Subjects[$subIndex] . " /" . $SubjectTypes[$subIndex],0, 'C');
        $pdf-> Image('dist/img/dummyDate.png',$x+6,33,19,4);
        $x += 35; 
    }
    $pdf->SetFont('Arial', 'b', 10);
    $pdf->SetXY(8, 50);
    for ($i = $p * 10,$y=38; $i < min(($p + 1) * 10, $totalStudent); $i++) {
        $pdf->SetXY(8, $y);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(11, 14, $i+1, 1, 0, 'C', 0);
        $pdf->SetFont('Times','b',8);
        $pdf->SetXY(19,$y);
        $smal =strtolower($StudentNames[$i]);
      $pdf->MultiCell(35,5,$ClassRollNos[$i]."/".$UnirollNos[$i].ucwords($smal),0,'C');
      $pdf->SetXY(19,$y);
      $pdf->Cell(35,14,"",1,0,'C',0);
        $pdf->SetXY(35,$y);
        $pdf->SetFont('Times','B',6);
        $pdf->SetXY(54,$y);
 
      $pic = 'data://text/plain;base64,' . base64_encode($Snap[$i]);
      $info = getimagesize($pic);
      $extension = explode('/', mime_content_type($pic))[1];
      $imageUrl = 'http://10.0.10.11/images/signature/'.$IDNos[$i].'.PNG';
      if($imageUrl!=''){
      $type = pathinfo($imageUrl, PATHINFO_EXTENSION);
      $data = file_get_contents($imageUrl);
      $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      $infoSign = getimagesize($base64);
      $extensionSign = explode('/', mime_content_type($base64))[1];
      
                }    
      $pdf->SetFont('Times','',10);
      $pdf->Cell(10,14,"",1,0,'C',0);
      if($extension!='webp'){
      
          $pdf-> Image($pic,55,$y+2,8,8,$extension);
      }else{
          if($Gender[$i]=='Male')
          {
              $pdf-> Image('dist/img/male.png',55,$y+2,8,8);
          }
          else{
              $pdf-> Image('dist/img/female.png',55,$y+2,8,8);
          }

      }
      if($extensionSign!='webp'){
      
          $pdf-> Image($base64,65,$y+2,19,8,$extensionSign);
      }else{
          if($Gender[$i]=='Male')
          {
              $pdf-> Image('dist/img/boxed-bg.png',65,$y+2,19,8);
          }
          else{
              $pdf-> Image('dist/img/boxed-bg.png',65,$y+2,19,8);
            }
        }
        $pdf->Cell(21.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(28.6,14,"",1,0,'C',0);
 
        $y = $y + 14;
                }
         
}

if($subcount>7)
{
for ($p = 0; $p < $totalStudent / 10; $p++) {
    
    $pdf->AddPage('L');
    $pdf->SetFont('Arial', 'b', 10);
    $x = 87;
    for ($subIndex = 6; $subIndex < 12; $subIndex++) {
        $pdf->SetXY($x, 23);
        $pdf->SetFont('Arial', 'b', 6);
        $pdf->MultiCell(28, 3, $SubjectNames[$subIndex] . " / " . $Subjects[$subIndex] . " /" . $SubjectTypes[$subIndex], 0, 'C');
        $pdf-> Image('dist/img/dummyDate.png',$x+6,33,19,4);
        $x += 35; 
      
    }
    $pdf->SetFont('Arial', 'b', 10);
    $pdf->SetXY(8, 50);
    for ($i = $p * 10,$y=38; $i < min(($p + 1) * 10, $totalStudent); $i++) {
        $pdf->SetXY(8, $y);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(11, 14, $i+1, 1, 0, 'C', 0);
        $pdf->SetFont('Times','b',8);
        $pdf->SetXY(19,$y);
        $smal =strtolower($StudentNames[$i]);
      $pdf->MultiCell(35,5,$ClassRollNos[$i]."/".$UnirollNos[$i].ucwords($smal),0,'C');
      $pdf->SetXY(19,$y);
      $pdf->Cell(35,14,"",1,0,'C',0);
        $pdf->SetXY(35,$y);
        $pdf->SetFont('Times','B',6);
        $pdf->SetXY(54,$y);
 
      $pic = 'data://text/plain;base64,' . base64_encode($Snap[$i]);
      $info = getimagesize($pic);
      $extension = explode('/', mime_content_type($pic))[1];
      $imageUrl = 'http://10.0.10.11/images/signature/'.$IDNos[$i].'.PNG';
      if($imageUrl!=''){
      $type = pathinfo($imageUrl, PATHINFO_EXTENSION);
      $data = file_get_contents($imageUrl);
      $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      $infoSign = getimagesize($base64);
      $extensionSign = explode('/', mime_content_type($base64))[1];
      
                }    
      $pdf->SetFont('Times','',10);
      $pdf->Cell(10,14,"",1,0,'C',0);
      if($extension!='webp'){
      
          $pdf-> Image($pic,55,$y+2,8,8,$extension);
      }else{
          if($Gender[$i]=='Male')
          {
              $pdf-> Image('dist/img/male.png',55,$y+2,8,8);
          }
          else{
              $pdf-> Image('dist/img/female.png',55,$y+2,8,8);
          }

      }
      if($extensionSign!='webp'){
      
          $pdf-> Image($base64,65,$y+2,19,8,$extensionSign);
      }else{
          if($Gender[$i]=='Male')
          {
              $pdf-> Image('dist/img/boxed-bg.png',65,$y+2,19,8);
          }
          else{
              $pdf-> Image('dist/img/boxed-bg.png',65,$y+2,19,8);
            }
            
        }

        // foreach ($Examid as $key => $examID) {
        //     foreach ($Subjects as $key => $SubjectsCode) {
           
        //   $list_sql_examsubject = "SELECT ExternalExam FROM ExamFormSubject WHERE Examid='$examID' ANd  SubjectCode='$SubjectsCode' ";
        //  $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
        //                 while( $row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
        //                    {
                        
        //                    $ExternalExam[]=$row_exam['ExternalExam'];
        //                    }
        //                 }
        //                 }
        $pdf->Cell(21.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(28.6,14,"",1,0,'C',0);

        
    

        $y = $y + 14;
                }
                // print_r($ExternalExam);
            }   
}

if($subcount>13)
{   
for ($p = 0; $p < $totalStudent / 10; $p++) {
    
    $pdf->AddPage('L');
    $pdf->SetFont('Arial', 'b', 10);
    $x = 87;
    for ($subIndex = 12; $subIndex < 18; $subIndex++) {
        $pdf->SetXY($x, 23);
        $pdf->SetFont('Arial', 'b', 6);
        $pdf->MultiCell(28, 3, $SubjectNames[$subIndex] . " / " . $Subjects[$subIndex] . " /" . $SubjectTypes[$subIndex], 0, 'C');
        $pdf-> Image('dist/img/dummyDate.png',$x+6,33,19,4);
        $x += 35; 
      
    }
    $pdf->SetFont('Arial', 'b', 10);
    $pdf->SetXY(8, 50);
    for ($i = $p * 10,$y=38; $i < min(($p + 1) * 10, $totalStudent); $i++) {
        $pdf->SetXY(8, $y);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(11, 14, $i+1, 1, 0, 'C', 0);
        $pdf->SetFont('Times','b',8);
        $pdf->SetXY(19,$y);
        $smal =strtolower($StudentNames[$i]);
      $pdf->MultiCell(35,5,$ClassRollNos[$i]."/".$UnirollNos[$i].ucwords($smal),0,'C');
      $pdf->SetXY(19,$y);
      $pdf->Cell(35,14,"",1,0,'C',0);
        $pdf->SetXY(35,$y);
        $pdf->SetFont('Times','B',6);
        $pdf->SetXY(54,$y);
 
      $pic = 'data://text/plain;base64,' . base64_encode($Snap[$i]);
      $info = getimagesize($pic);
      $extension = explode('/', mime_content_type($pic))[1];
      $imageUrl = 'http://10.0.10.11/images/signature/'.$IDNos[$i].'.PNG';
      if($imageUrl!=''){
      $type = pathinfo($imageUrl, PATHINFO_EXTENSION);
      $data = file_get_contents($imageUrl);
      $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      $infoSign = getimagesize($base64);
      $extensionSign = explode('/', mime_content_type($base64))[1];
      
                }    
      $pdf->SetFont('Times','',10);
      $pdf->Cell(10,14,"",1,0,'C',0);
      if($extension!='webp'){
      
          $pdf-> Image($pic,55,$y+2,8,8,$extension);
      }else{
          if($Gender[$i]=='Male')
          {
              $pdf-> Image('dist/img/male.png',55,$y+2,8,8);
          }
          else{
              $pdf-> Image('dist/img/female.png',55,$y+2,8,8);
          }

      }
      if($extensionSign!='webp'){
      
          $pdf-> Image($base64,65,$y+2,19,8,$extensionSign);
      }else{
          if($Gender[$i]=='Male')
          {
              $pdf-> Image('dist/img/boxed-bg.png',65,$y+2,19,8);
          }
          else{
              $pdf-> Image('dist/img/boxed-bg.png',65,$y+2,19,8);
            }
            
        }
        $pdf->Cell(21.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(35.4,14,"",1,0,'C',0);
        $pdf->Cell(28.6,14,"",1,0,'C',0);


      

        

        $y = $y + 14;
                }
                // print_r($ExternalExam);
            }   
}
$pdf->Output();
  ?>

















