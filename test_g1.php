<form action="#" method="POST" enctype="multipart/form-data">
     <input type="file" name="file_exl" id="">
     <input type="submit" name="submit" id="" value="upload">
</form>
<?php 

// $test=Array ( "0" => "153643", "1" => "153591", "2" => "153555", "3" => "153566", "4" => "153590", "5" => "154267", "6" => "154226", "7" => "154288", "8" => "154240", "9" => "154248", "10" => "153609", "11" => "153644", "12" => "153680", "13" => "153696", "14" => "153713", "15" => "154268", "16" => "154275", "17" => "153611", "18" => "153610", "19" => "153644", "20" => "153681", "21" => "153693" );


// if(array_unique($test))
// {
//      echo "Not unique";
// }
// else
// {
// echo " unique";

// }
include "connection/connection.php";
    if(isset($_POST['submit']))
    {
$file = $_FILES['file_exl']['tmp_name'];
$handle = fopen($file, 'r');
$c = 0;
while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
{
      $oldSubjectcode= $filesop[0];
      $newSubjectcode = $filesop[1];
     
      echo "<br>".$update_study="INSERT into DocumentDetail (SID,Course,DateEntry)VALUES('$newSubjectcode','$oldSubjectcode','$timeStampS')";
      $update_study_run=sqlsrv_query($conntest,$update_study);  
  if ($update_study_run==true) 
  {
     echo "success";
  }
  else
  {
   echo"no";
  }
}
if ($update_study_run === false) {
   $errors = sqlsrv_errors();
   echo "Error: " . print_r($errors, true);
   // echo "0";
} 
}

?>