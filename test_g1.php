<!-- <form action="#" method="POST" enctype="multipart/form-data">
     <input type="file" name="file_exl" id="">
     <input type="submit" name="submit" id="" value="upload">
</form> -->
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
// include "connection/connection.php";
//     if(isset($_POST['submit']))
//     {
// $file = $_FILES['file_exl']['tmp_name'];
// $handle = fopen($file, 'r');
// $c = 0;
// while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
// {
//       $oldSubjectcode= $filesop[0];
//       $newSubjectcode = $filesop[1];
     
//       echo "<br>".$update_study="INSERT into DocumentDetail (SID,Course,DateEntry)VALUES('$newSubjectcode','$oldSubjectcode','$timeStampS')";
//       $update_study_run=sqlsrv_query($conntest,$update_study);  
//   if ($update_study_run==true) 
//   {
//      echo "success";
//   }
//   else
//   {
//    echo"no";
//   }
// }
// if ($update_study_run === false) {
//    $errors = sqlsrv_errors();
//    echo "Error: " . print_r($errors, true);
//    // echo "0";
// } 
// }


?>
<form id="image-upload" name="image-upload" action="#" method="post" enctype="multipart/form-data">
   <label for="">Image</label>
        <input type="file" name="image" id="image" class="form-control input-group-sm">

        <input type="hidden" name="unirollno" value="<?php echo $UniRollNo; ?>">
        <!-- <input type="hidden" name="code" value="92"> -->
         <label for="">csv</label>
        <input type="file" name="file_exl" >
        <input type="submit" name="uploads" value="Upload" class="btn btn-success btn-xs"
            onclick="uploadImage(this.form,'<?php echo $UniRollNo; ?>')">
    </form>

    <?php 
    if(isset($_POST['uploads']))
 {
 $file = $_FILES['file_exl']['tmp_name'];
$handle = fopen($file, 'r');
$c = 0;
while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
{
      $IDNo= $filesop[0];
     $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $type = $_FILES['image']['type'];
     $file_data = file_get_contents($file_tmp);
    $characters = '';
   $result = $IDNo;
   $image_name =$result;
     $destdir = 'Students';
   ftp_chdir($conn_id,"Images/Students/") or die("Could not change directory");
   ftp_pasv($conn_id,true);
   file_put_contents($destdir.$image_name.'.PNG',$file_data);
   ftp_put($conn_id,$image_name.'.PNG',$destdir.$image_name.'.PNG',FTP_BINARY) or die("Could not upload to $ftp_server1");
   ftp_close($conn_id);

   $upimage = "UPDATE Admissions SET Snap = ? WHERE IDNo = ?";
$params = array($file_data,$IDNo);
$upimage_run = sqlsrv_query($conntest, $upimage, $params);
if ($upimage_run === false) {
    $errors = sqlsrv_errors();
    // echo "Error: " . print_r($errors, true);
    // echo "0"; 
} 
else
 {
    echo "1";
}
}

sqlsrv_close($conntest);
 }