<?php
   ini_set('max_execution_time', '0');
include "connection/connection.php";

// $get_student_details = "SELECT * FROM Admissions";
// $get_student_details_run = sqlsrv_query($conntest, $get_student_details);

// $totalSizeBytes = 0;

// while ($row_student = sqlsrv_fetch_array($get_student_details_run)) {
//     $snap = $row_student['Signature'];
//     $imageData = base64_decode($snap);

//     $imageSizeBytes = strlen($imageData);
//     $totalSizeBytes += $imageSizeBytes;

//     $imageSizeKB = $imageSizeBytes / 1024;
//     $imageSizeMB = $imageSizeKB / 1024;

//     $imageSizeKB = number_format($imageSizeKB, 2);
//     $imageSizeMB = number_format($imageSizeMB, 2);


//     echo "IDNo : " . $row_student['IDNo'] . "<br>";
//     // echo "Image size: " . $imageSizeBytes . " bytes<br>";
//     echo "Image size: " . $imageSizeKB . " KB<br>";
//     echo "Image size: " . $imageSizeMB . " MB<br><br>";
// }

// $totalSizeKB = $totalSizeBytes / 1024;
// $totalSizeMB = $totalSizeKB / 1024;
// $totalSizeKB = number_format($totalSizeKB, 2);
// $totalSizeMB = number_format($totalSizeMB, 2);

// // echo "Total size of all images: " . $totalSizeBytes . " bytes<br>";
// // echo "Total size of all images: " . $totalSizeKB . " KB<br>";
// echo "Total size of all images: " . $totalSizeMB . " MB<br>";





$gg="SELECT * FROM Staff where JobStatus='1' ";
$ggrun=sqlsrv_query($conntest,$gg);
while($row=sqlsrv_fetch_array($ggrun))
{
    $Id=$row['IDNo'];
    $name=$row['Name'];
     $email=$row['EmailID'];
      $contact=$row['ContactNo'];
echo $update="Update employee_master set name='$name',email='$email',phone='$contact' where emp_id='$Id'";
 $get_session_run=mysqli_query($conn_spoc,$update);

}

// $gg="SELECT IDNo FROM Staff ";
// $ggrun=sqlsrv_query($conntest,$gg);
// while($row=sqlsrv_fetch_array($ggrun))
// {
//     $IDNo=$row['IDNo'].'.PNG';
//     $ID=$row['IDNo'];
//    echo  "<br>".$up="UPDATE Staff SET Imagepath='$IDNo' where  IDNo='$ID' and (Imagepath='' or Imagepath Is NUll)";
//  sqlsrv_query($conntest,$up);
//}
?>
<!-- <form  action="#" method="post" enctype="multipart/form-data">
    <label for="">File</label>
    <input type="file" name="file_exl" id="file_exl" class="form-control input-group-sm">
    <label for="">Image</label>
<input type="file" name="image" id="image" class="form-control input-group-sm">
<input type="submit" name="actionFile" value="Upload" class="btn btn-success btn-xs">
</form> -->
<?php 
// if(isset($_POST['actionFile']))
// {





//     // $RollNO=$_POST['UniRollNo'];
// $file_name = $_FILES['image']['name'];
// $file_tmp = $_FILES['image']['tmp_name'];
// $type = $_FILES['image']['type'];


// $imageUrl = "dummy.jpg";
// $file_data = file_get_contents($imageUrl);
// if ($file_data === false) {
//     die("Failed to fetch image from URL.");
// }

// $file_data = file_get_contents($file_tmp);
// $file = $_FILES['file_exl']['tmp_name'];
// $handle = fopen($file, 'r');
// $c = 0;
// while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
// {
//       $ID= $filesop[0];
     
// $gg="SELECT Snap,IDNo
// FROM Admissions
// WHERE Snap IS NULL OR LEN(CAST(Snap AS VARBINARY(MAX))) = 0 OR Snap = 0x  ";
// $ggrun=sqlsrv_query($conntest,$gg);
// while($row=sqlsrv_fetch_array($ggrun))
// {
// $ID=$row['IDNo'];
// $upimage = "UPDATE Admissions SET Snap = ? WHERE IDNo = ?";
// $params = array($file_data, $ID);
// $upimage_run = sqlsrv_query($conntest, $upimage, $params);

// $get_student_details="SELECT Snap,IDNo FROM Admissions where IDNo='$ID'";
// $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
// if($row_student=sqlsrv_fetch_array($get_student_details_run))
// {
//     $mimeType="";
//     $snap=$row_student['Snap'];
//      $pic=base64_encode($snap);
//      $dataUrl = 'data:' . $mimeType . ';base64,' . $pic;
//      
 //      <br>
//      <?=$ID;
//      <img src="<?=$dataUrl; alt="" width="100"> -->
 //      <?php  
// }



// }
// }

?>