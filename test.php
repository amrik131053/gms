  <?php
 include "connection/connection.php";

?>
  
  <?php 

  ini_set('max_execution_time', '0');



  //include'sendsms.php';

// if(ISSET($_POST['email_imp']))
// {  
//   $file = $_FILES['file_exl']['tmp_name'];
//   $handle = fopen($file, 'r');
//   $c = 0;
//   while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
//   {

//   $reg_id = $filesop[0];
//   $reg_id1 =$filesop[1];



// $sql = "UPDATE  Staff  SET RoleID = '$reg_id1' WHERE IDNo='$reg_id'";
   

//    $list_result = sqlsrv_query($conntest,$sql);


// if($list_result === false) {

//     die( print_r( sqlsrv_errors(), true) );
// }


// }

// }
if(ISSET($_POST['email_imp']))
{ 
$file = $_FILES['file_exl']['tmp_name'];
$handle = fopen($file, 'r');
$c = 0;
while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
{
$oldSubjectcode= $filesop[0];
$newSubjectcode = $filesop[1];
   $update_study="UPDATE  MasterCourseStructure SET SubjectCode='$newSubjectcode'  WHERE  SubjectCode='$oldSubjectcode'";
sqlsrv_query($conntest,$update_study);
// $updateQuestions="UPDATE question_bank SET SubjectCode='$newSubjectcode' WHERE SubjectCode='$oldSubjectcode' ";
// mysqli_query($conn,$updateQuestions);

 $update_ExamFormSubject="UPDATE  ExamFormSubject SET SubjectCode='$newSubjectcode'  WHERE  SubjectCode='$oldSubjectcode'";
sqlsrv_query($conntest,$update_ExamFormSubject);


 $update_MasterPracticals="UPDATE  MasterPracticals SET SubCode='$newSubjectcode',SubjectType='$newSubjectcode'  WHERE  SubCode='$oldSubjectcode'";
sqlsrv_query($conntest,$update_MasterPracticals);

echo "<br>";
// $update_study_run=sqlsrv_query($conntest,$update_study);  
// if ($update_study_run==true) 
// {
// echo "success";
// }
// else
// {
// echo"no";
// }

}
}

    ?>


    <form action="#" enctype="multipart/form-data" method="post">
          <input type="file" name="file_exl" class="btn btn-warning btn-xs">
          </div>
 <div class="col-sm-1">
         <button type="submit"  name='email_imp' class="btn btn-warning btn-xs">Import</button>
          </div>
</form>
<?php


               
                   
?>
