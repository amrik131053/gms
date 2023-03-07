   
   <?php 
   include "connection/connection.php";

   $SubjectCode="POLD-254";
    $Semester=2;
    $CourseID=229;
    $examName=1;
    $current_session;
    $questionSessionTrack='';
    // echo $examNameQry="SELECT exam_name FROM question_exam WHERE id='$examName'";
    // $examNameRes=mysqli_query($conn,$examNameQry);
    // if ($examNameData=mysqli_fetch_array($examNameRes)) 
    // {
    //    $questionSessionTrack.=$examNameData['exam_name'].'('.$current_session_name.')';
    // }
    // else
    // {
    //    $questionSessionTrack.=$examName.'('.$current_session_name.')';
    // }
    $date=date('Y-m-d H-i-s');
   //$sql="INSERT INTO question_paper (session, exam, subject_code, course, semester, printed_by, generated_on, status) VALUES ('$current_session', '$examName', '$SubjectCode', '$CourseID', '$Semester', '131053', '$date', '0')";
   //$res=mysqli_query($conn,$sql);

  $qry="SELECT * from question_paper where session='12' and exam='$examName' and subject_code='$SubjectCode' and course='$CourseID' and semester='$Semester' and printed_by='131053'  and status='0' ";
    $run=mysqli_query($conn,$qry);
    while($data=mysqli_fetch_array($run))
    {
        $questionPaperId=$data['id'];
    }
$questionArray=array();
$questionCountQry="Select * from question_generate_count";
        $questionCountRes=mysqli_query($conn,$questionCountQry);
        while($questionCountData=mysqli_fetch_array($questionCountRes))
        {

          $unit=$questionCountData['unit'];
     
             $type=$questionCountData['type'];
           
             $category=$questionCountData['category'];
             
             $count=$questionCountData['count'];



 echo  $questionBankQry="Select Id from question_bank1 where Unit='$unit' and Type='$type' and Category='$category' and SubjectCode='$SubjectCode' and CourseID='$CourseID' and Semester='$Semester'";


             $questionBankRes=mysqli_query($conn,$questionBankQry);

             if ($questionBankData=mysqli_fetch_array($questionBankRes)) 
      {

        $questionArray[]=array_rand($questionBankData);

             
          } 
          else{
            echo  "cantgenearate";
          } 
      }   
 $count2=count($questionArray);
    for ($i=0; $i < $count2; $i++) 
    { 
     echo "INSERT INTO question_paper_details (question_paper_id, question_id) VALUES ($questionPaperId, $questionArray[$i])";
     echo "<br>";    
      }  //mysqli_query($conn,"INSERT INTO question_paper_details (question_paper_id, question_id) VALUES ($questionPaperId,$questionArray[$i])"); 
       // mysqli_query($conn,"Update question_bank set Track= CONCAT(Track, ',$questionSessionTrack') Where Id=".$questionArray[$i]); 

   