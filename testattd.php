
<?php  
ini_set('max_execution_time', '0');

    include "connection/connection.php"; 
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













  $subjectcode="SELECT * FROM research_publications WHERE status_code='3' AND year_name='2025'";
$get_subjectcode_run=mysqli_query($conn_spoc,$subjectcode);
    
 while($row = mysqli_fetch_array($get_subjectcode_run))
       {
          $emp_id=$row["emp_id"];
          $pprTitle=$row['title'];
          $pprAuth=$row['authors'];
        //   $facultyId=$row['facultyId'];
          $pprJournal=$row['name'];
          $pprPublish=$row['date_of_publication'];
          $pprLink=$row['doi'];
       

$subjectcode1="Select * from Staff where IDNo='$emp_id'";
$get_subjectcode_run1=sqlsrv_query($conntest,$subjectcode1);
    
 while($row1 = sqlsrv_fetch_array($get_subjectcode_run1, SQLSRV_FETCH_ASSOC))
       {
           $Name=$row1["Name"];
           $facultyId=$row1["CollegeId"];

          echo  "<br><br>".$InsertReseatch="INSERT into Repository (IDNo,PaperTitle,AuthorName,Faculty,Journal,DateofPublication,DOI,Documents,Status)
           VALUES('$emp_id','$pprTitle','$pprAuth','$facultyId','$pprJournal','$pprPublish','$pprLink','','0')";
            // $InsertResearchPpr=sqlsrv_query($conntest,$InsertReseatch);

       }
   }
       
       sqlsrv_close($conntest);






?>
</div>


<!-- Modal -->
<?php include "footer.php"; ?>