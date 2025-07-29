
<?php  
ini_set('max_execution_time', '0');

    include "connection/connection.php"; 
   ?>
  <div class="card-body ">
    <div class="card-header ">


</div>
<br>
<?php 
echo $sql="SELECT * FROM offer_latter WHERE Batch='2025'   ORDER BY id desc";
  echo"<br>";   $result = mysqli_query($conn,$sql);
     $counter = 1; 
        while($row=mysqli_fetch_array($result)) 
        {
         echo $roll_no = $row['Class_RollNo'];
         echo $sql1 = "SELECT State,District FROM Admissions   where ClassRollNo='$roll_no'";

         $stmt2 = sqlsrv_query($conntest,$sql1);
   while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
     {
      $State=$row1['State'];
       $District=$row1['District'];
       }

echo $sqlst="SELECT id FROM states WHERE name='$State'";
echo"<br>";
 $resultst = mysqli_query($conn,$sqlst);
  
        while($row=mysqli_fetch_array($resultst)) 
        {
      
        echo $state_id = $row['id'];
      }


echo $sqldst="SELECT id FROM cities WHERE name='$District' AND state_id='$state_id'";
echo"<br>";
 $resultdst = mysqli_query($conn,$sqldst);
  
        while($rowd=mysqli_fetch_array($resultdst)) 
        {
      
        echo $dist_id = $rowd['id'];
      }

echo"<br>";
  echo    $updatest="Update offer_latter set State='$state_id',District='$dist_id' where Class_RollNo='$roll_no'";
echo"<br>";
 $result1 = mysqli_query($conn,$updatest);




}











//   $subjectcode="SELECT * FROM research_publications WHERE status_code='3' AND year_name='2025'";
// $get_subjectcode_run=mysqli_query($conn_spoc,$subjectcode);
    
//  while($row = mysqli_fetch_array($get_subjectcode_run))
//        {
//           $emp_id=$row["emp_id"];
//           $pprTitle=$row['title'];
//           $pprAuth=$row['authors'];
//         //   $facultyId=$row['facultyId'];
//           $pprJournal=$row['name'];
//           $pprPublish=$row['date_of_publication'];
//           $pprLink=$row['doi'];
       

// $subjectcode1="Select * from Staff where IDNo='$emp_id'";
// $get_subjectcode_run1=sqlsrv_query($conntest,$subjectcode1);
    
//  while($row1 = sqlsrv_fetch_array($get_subjectcode_run1, SQLSRV_FETCH_ASSOC))
//        {
//            $Name=$row1["Name"];
//            $facultyId=$row1["CollegeId"];

//           echo  "<br><br>".$InsertReseatch="INSERT into Repository (IDNo,PaperTitle,AuthorName,Faculty,Journal,DateofPublication,DOI,Documents,Status)
//            VALUES('$emp_id','$pprTitle','$pprAuth','$facultyId','$pprJournal','$pprPublish','$pprLink','','0')";
//             // $InsertResearchPpr=sqlsrv_query($conntest,$InsertReseatch);

//        }
//    }
       
//        sqlsrv_close($conntest);






?>
</div>


<!-- Modal -->
<?php include "footer.php"; ?>