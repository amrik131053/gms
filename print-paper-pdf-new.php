<?php
session_start();
require('fpdf/fpdf.php');
ini_set('max_execution_time', '0');
include 'connection/connection.php';
date_default_timezone_set("Asia/Kolkata");  

class CustomPDF extends FPDF {
    const MAX_PAGE_HEIGHT = 265; 

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 20);
        // $this->SetTextColor(128);
        $this->SetXY(5, self::MAX_PAGE_HEIGHT); // Set position for the "Printed By" text
        // $this->Cell(0, 10, 'Printed By ', 0, 0, 'R');
    }

    // function addContentWithCheck($contentHeight) {
        // $remainingSpace = self::MAX_PAGE_HEIGHT - $this->GetY();
        // if (264 > $remainingSpace) {
        //     $this->AddPage('P', 'A4');
        // }
      
        // $this->SetXY(5,10);
        // $this->multicell(200, 5,'264',1,'C');
    
}
$ctime = date("d-m-Y");
$nowtime = strtotime($ctime);
$id=$_POST['paperId'];
$sql="Select * from question_paper inner join question_exam on question_paper.exam=question_exam.id where question_paper.id='$id'";
$res=mysqli_query($conn,$sql);
while ($data=mysqli_fetch_array($res)) 
{
    $examName=$data['exam_name'];
     $examid=$data['id'];
    $sqlCourse = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE CourseID=".$data['course'];
    $resultCourse = sqlsrv_query($conntest,$sqlCourse);
    while($rowCourse = sqlsrv_fetch_array($resultCourse, SQLSRV_FETCH_ASSOC) )
    {
        $courseName=$rowCourse["Course"]; 
    } 

    $mcq=$data['mcq'];
    $short=$data['short'];
    $long=$data['long'];
    $semester=$data['semester'];
    $maxMarks=$data['max_marks'];
    $time =$data['exam_time'];
    $instruction =$data['instructions'];
    $subjectCode=$data['subject_code'];
    $sqlSubject = "SELECT DISTINCT SubjectName from MasterCourseStructure WHERE SubjectCode ='".$subjectCode."' AND Isverified='1' and CourseID=".$data['course'];
                    $resultSubject = sqlsrv_query($conntest,$sqlSubject);
                    if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
                    {
                        $subjectName=$rowSubject["SubjectName"]; 
                    }

}

$sqlsession = "SELECT * FROM question_session WHERE session_status='1'";
       
$resultsession=mysqli_query($conn,$sqlsession);
                          if($rowsession=mysqli_fetch_array($resultsession))
                          {



$sessionnane=$rowsession['session_name'];

 }
                      if ($semester==1) 
                      {
                        $sem="st";
                      }
                      elseif ($semester==2) 
                      {
                        $sem="nd";
                      }
                      elseif ($semester==3) 
                      {
                        $sem="rd";
                      }
                      elseif ($semester>=4) 
                      {
                        $sem="th";
                      }
$pdf = new CustomPDF();

        $pdf->AddPage('P', 'A4');  
$pdf->SetAutoPageBreak(true,10);
        $pdf->SetFont('times', 'B', 20);
        $pdf->SetXY(5,10);
        $pdf-> Image('dist/img/logo-login.png',5,5,20,15);
        $pdf->SetXY(5,10);
         $pdf->multicell(200, 5,"GURU KASHI UNIVERSITY",0,'C');
        $pdf->SetXY(5,5);
        $pdf->SetFont('times', 'B', 10);
         $pdf->multicell(200, 5," Roll No...........................",0,'R');
         $pdf->SetXY(5,17);
         $pdf->SetFont('times', 'B', 10);
         $pdf->multicell(200, 5,$examName ." (".$sessionnane.")",0,'C');
         $pdf->SetFont('times', 'B', 10);
         $pdf->SetXY(5,21);
         $pdf->multicell(200, 5,"Course/Discipline:".$courseName,0,'L');
         $pdf->SetXY(5,21);
         $pdf->multicell(200, 5,"Semester: ".$semester.$sem,0,'R');
         $pdf->SetXY(5,26);
         $pdf->multicell(200, 5,"Subject Code:".$subjectCode,0,'L');
         $pdf->SetXY(5,26);
         $pdf->multicell(200, 5,"Maximum Marks: ".$maxMarks,0,'R');
         $pdf->SetXY(5,31);
         $pdf->multicell(200, 5,"Time: ".$time,0,'L');
         $pdf->SetXY(5,40);
         $pdf->multicell(200, 5,"Instructions:",0,'L');
         $pdf->SetXY(5,45);
         $pdf->multicell(200, 5,"(i) All questions are compulsory from Part I:",0,'L');
         $pdf->SetXY(5,50);
         $pdf->multicell(200, 5,"(ii) All questions are compulsory from Part II:",0,'L');
         $pdf->SetXY(5,55);
         $pdf->multicell(200, 5,"(iii) Attempt any one question from Part III:",0,'L');
        $pdf->SetXY(10,25);
        $pdf->SetFont('times', 'B', 12);
        

        $qType=''; 
        $partCount=0;
        $questionCount=1;
        $mcqCount1='a';
        $y=65;
        $i=1;
        $qry="Select *,REGEXP_REPLACE(Question,'style=".'[\\d\\D]*?'."','') AS sanitized_question from question_paper_details inner join question_bank on question_bank.Id=question_paper_details.question_id inner join question_type on question_type.id=question_bank.Type inner join question_category on question_category.id=question_bank.Category inner join question_bank_details on question_bank.id=question_bank_details.question_id   where question_paper_id='$id' ORDER BY  Type  asc, Category asc";
        $run=mysqli_query($conn,$qry);
        while($row=mysqli_fetch_array($run))
        { 

          $img='';
          $imageQry="Select * from question_image where question_id=".$row['Id'];
          $imageRes=mysqli_query($conn,$imageQry);
          while($imageData=mysqli_fetch_array($imageRes))
          {
            $img.= "http://gurukashiuniversity.co.in/data-server/question_images/{$imageData['image']}'";
           
          }
          if ($row['Type']!=1) 
          {
            $questionCount++;
          }
          

          if ($qType!=$row['Type']) 
          {
            $partCount++;
            if($partCount==1)
            {
              $partCountRoman='I';
            }
            elseif($partCount==2)
            {
              $partCountRoman='II';
            }
            elseif($partCount==3)
            {
              $partCountRoman='III';
            }
       
                if ($row['Type']==1) 
                {
                  $typ= $mcq;
                }
                elseif ($row['Type']==2) 
                {
                  $typ= $short;
                }
                elseif ($row['Type']==3) 
                {
                  $typ= $long;
                } 
               $pdf->SetXY(5,$y-3);
               $pdf->SetFont('times', 'B', 12);
           
               if ($row['Type']==1) 
               {
                 $Marks= $mcq;
               }
               elseif ($row['Type']==2) 
               {
                 $Marks= $short;
               }
               elseif ($row['Type']==3) 
               {
                 $Marks= $long;
               } 
               $pdf->multicell(200, 5,"Part ".$partCountRoman.' ('.$row['type_name'].')',0,'C');
               $pdf->SetXY(5,$y-2);
          $pdf->multicell(200, 5,"(".$Marks.')        ',0,'R');
         
        //   $pdf->multicell(200, 5,"",0,'C');
        $y=$y+3;
          }
          $qCount=strlen($row['sanitized_question']);
          $pdf->SetFont('times', 'B', 10);
          if ($row['Type']==1) 
          {
          
            $pdf->SetXY(5,$y);
          if($qCount<100)
          {
              $pdf->multicell(200, 4,$questionCount.' ('.$mcqCount1.' ) '.$row['sanitized_question'],0,'L');
              $y=$y+1;
            }
            elseif($qCount<200)
            {
                $pdf->multicell(200, 4,$questionCount.' ('.$mcqCount1.') '.$row['sanitized_question'],0,'L');
                $y=$y+2;
            }
            elseif($qCount<300)
            {
                $pdf->multicell(200, 4,$questionCount.' ('.$mcqCount1.') '.$row['sanitized_question'],0,'L');
                $y=$y+3;
            }
            else
            {
                $pdf->multicell(200, 4,$questionCount.' ('.$mcqCount1.') '.$row['sanitized_question'],0,'L');
                $y=$y+3;
            }
            $pdf->SetFont('times', 'B', 8);
            $pdf->multicell(200, 4,$row['category_name'].'('.$row['Unit'].')   ',0,'R');
            $pdf->SetFont('times', 'B', 10);
          }
          else
          {
            $pdf->SetXY(5,$y);
            if($qCount<100)
            {
                $pdf->multicell(200, 4,'Q.'.$questionCount.': '.$row['sanitized_question'],0,'L');
                if($img!=''){
                    $pdf-> Image($img,48,2,30,10);

                }
                $y=$y+1;
              }
              elseif($qCount<200)
              {
                  $pdf->multicell(200, 4,'Q.'.$questionCount.': '.$row['sanitized_question'],0,'L');
                   if($img!=''){
                    $pdf-> Image($img,48,2,30,10);

                }
                  $y=$y+2;
              }
              elseif($qCount<300)
              {
                  $pdf->multicell(200, 4,'Q.'.$questionCount.': '.$row['sanitized_question'],0,'L');
                   if($img!=''){
                    $pdf-> Image($img,48,2,30,10);

                }
                  $y=$y+3;
              }
              $pdf->SetFont('times', 'B', 8);
              $pdf->multicell(200, 4,$row['category_name'].'('.$row['Unit'].')    ',0,'R');
              $pdf->SetFont('times', 'B', 10);
          }
      
            if($row['Type']==1)
            {
               $y=$y+2;
            $mcqCount=strlen('A) '.$row['OptionA'].'B) '.$row['OptionB'].'C) '.$row['OptionC'].'D) '.$row['OptionD']);
                if($mcqCount<100)
                { $pdf->SetXY(10,$y+5);
                    $pdf->multicell(190, 2,'A) '.$row['OptionA'],0,'L');
                    $pdf->SetXY(10,$y+10);
                    $pdf->multicell(190, 2,'B) '.$row['OptionB'],0,'L');
                    $pdf->SetXY(10,$y+15);
                    $pdf->multicell(190, 2,'C) '.$row['OptionC'],0,'L');
                    $pdf->SetXY(10,$y+20);
                    $pdf->multicell(190, 2,'D) '.$row['OptionD'],0,'L');
                    $y=$y+1;
                 
                }
                elseif($mcqCount<200)
                { $pdf->SetXY(10,$y+5);
                    $pdf->multicell(190, 4,'A) '.$row['OptionA'],0,'L');
                    $pdf->SetXY(10,$y+10);
                $pdf->multicell(190, 4,'B) '.$row['OptionB'],0,'L');
                $pdf->SetXY(10,$y+15);
                $pdf->multicell(190, 4,'C) '.$row['OptionC'],0,'L');
                $pdf->SetXY(10,$y+20);
                $pdf->multicell(190, 4,'D) '.$row['OptionD'],0,'L');
                    $y=$y+2;
                   
                }
                elseif($mcqCount<300)
                { $pdf->SetXY(10,$y+5);
                    $pdf->multicell(190, 2,'A) '.$row['OptionA'],0,'L');
                    $pdf->SetXY(10,$y+10);
                $pdf->multicell(190, 2,'B) '.$row['OptionB'],0,'L');
                $pdf->SetXY(10,$y+15);
                $pdf->multicell(190, 2,'C) '.$row['OptionC'],0,'L');
                $pdf->SetXY(10,$y+20);
                $pdf->multicell(190, 2,'D) '.$row['OptionD'],0,'L');
                    $y=$y+3;
                   
                }
                elseif($mcqCount<400)
                { $pdf->SetXY(10,$y+5);
                    $pdf->multicell(190, 3,'A) '.$row['OptionA'],0,'L');
                    $pdf->SetXY(10,$y+10);
                $pdf->multicell(190, 3,'B) '.$row['OptionB'],0,'L');
                $pdf->SetXY(10,$y+15);
                $pdf->multicell(190, 3,'C) '.$row['OptionC'],0,'L');
                $pdf->SetXY(10,$y+20);
                $pdf->multicell(190, 3,'D) '.$row['OptionD'],0,'L');
                    $y=$y+4;
                   
                }
                else
                { $pdf->SetXY(10,$y+5);
                    $pdf->multicell(190, 4,'A) '.$row['OptionA'],0,'L');
                    $pdf->SetXY(10,$y+13);
                $pdf->multicell(190, 4,'B) '.$row['OptionB'],0,'L');
                $pdf->SetXY(10,$y+20);
                $pdf->multicell(190, 4,'C) '.$row['OptionC'],0,'L');
                $pdf->SetXY(10,$y+24);
                $pdf->multicell(190, 4,'D) '.$row['OptionD'],0,'L');
                    $y=$y+5;
                   
                }
               
               

            }
               
            // $pdf->SetXY(10,$y+30);
            // $pdf->multicell(190, 4,'D) '.$y,0,'L');
     
          if($y>230 || $y>235)
          {
            $pdf->AddPage('P', 'A4');
            $y=10;  
          }
          else{
            if($row['Type']==1)
            {
                
                $y=$y+28;
            }
            else{
                $y=$y+10;
            }
          }
          $qType=$row['Type'];
          if ($row['Type']==1) 
          {
            $mcqCount1++;
          }
        }



















        $pdf->Output();

?>