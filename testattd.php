
<?php  
ini_set('max_execution_time', '0');
   include "header.php";   
    include "connection/connection_web.php"; 
   ?>
  <div class="card-body ">
    <div class="card-header ">


</div>
<br>

<?php 
// $CollegeName='';


// // echo "SELECT * FROM online_payment where  status='success' AND  remarks='4th Convocation' AND TYPE IS NULL";

// $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND  remarks='4th Convocation' AND TYPE='0'");
  
//   //AND remarks='4th Convocation' and CollegeName is NULL");
  
//     $counter = 1; 
//         while($row=mysqli_fetch_array($result)) 
//         {
//         $id = $row['slip_no'];
//         $user_id = $row['user_id'];
//         $roll_no = $row['roll_no'];
//        echo   $course = $row['course'];
//         $CourseType='';

// echo $sql1 = "SELECT CourseType FROM Admissions inner join MasterCourseCodes on Admissions.CourseID=MasterCourseCodes.CourseID  where UniRollNo='$roll_no'";


// $stmt2 = sqlsrv_query($conntest,$sql1);
//    while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
//      {
//       $CourseType=$row1['CourseType'];
//        }
// //echo "Update online_payment set Type='$CourseType' where slip_no='$id'";

//  $result1 = mysqli_query($conn_online,"UPDATE online_payment set Type='$CourseType' where slip_no='$id'");

// }













 echo $subjectcode="Select Distinct SubjectCode from ExamFormSubject where SubjectType='undefined' AND Type='Reappear' AND Examination='May 2025'";
$get_subjectcode_run=sqlsrv_query($conntest,$subjectcode);
    
 while($row = sqlsrv_fetch_array($get_subjectcode_run, SQLSRV_FETCH_ASSOC))
       {
          $subjectcode=$row["SubjectCode"];
       
       

$subjectcode1="Select * from MasterCourseStructure where SubjectCode='$subjectcode'";
$get_subjectcode_run1=sqlsrv_query($conntest,$subjectcode1);
    
 while($row = sqlsrv_fetch_array($get_subjectcode_run1, SQLSRV_FETCH_ASSOC))
       {
           $subjecttype=$row["SubjectType"];

echo $quesryt="Update ExamFormSubject set SubjectType='$subjecttype' where SubjectCode='$subjectcode'";
$get_subjectcode_run2=sqlsrv_query($conntest,$quesryt);

       }
   }
       
       sqlsrv_close($conntest);






?>
</div>


<!-- Modal -->
<?php include "footer.php"; ?>