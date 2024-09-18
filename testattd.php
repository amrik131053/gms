
<?php  
   include "header.php";   
   ?>
  <div class="card-body ">
    <div class="card-header ">


</div>
<br>
<?php 

 $subjectcode="Select Distinct SubjectCode from ExamFormSubject where SubjectType='null'  AND Examination='December 2024'";
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