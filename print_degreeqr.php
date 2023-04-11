<?php 

ini_set('max_execution_time', '0');

?>
  <form method="post" enctype="multipart/form-data" class="form-horizontal">
       
            <label>Month</label>
            <br/><label>File Name</label>
            <input type="file" name="file_exl" required>
           
            <br/><br/>
            <input type="submit" value="Upload" class="btn btn-primary btn-block" name="correct">
            </form>
            <?php
// Include the qrlib file
include 'phpqrcode/qrlib.php';

   if (isset($_POST['correct']))
{


 $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 10000000, ',')) !== false)
  {
$RegNo= $filesop[0];
$UniRollNO=$filesop[1];
$name=$filesop[2];
$yoa=$filesop[3];
$course=$filesop[4];
$cgpa=$filesop[5];

$text = "Course:".$course."\nYOA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity RollNo.".$UniRollNO."\nCGPA:".$cgpa;
//$uni=1112301102;
// $path variable store the location where to
// store image and $file creates directory name
// of the QR code file by using 'uniqid'
// uniqid creates unique id based on microtime
$path = 'degreeqr/';
$file = $path.$UniRollNO.".png";

// $ecc stores error correction capability('L')
$ecc = 'L';
$pixel_Size = 10;
$frame_Size = 10;

// Generates QR Code and Stores it in directory given
QRcode::png($text, $file, $ecc, $pixel_Size, 2);

// Displaying the stored QR code from directory
echo "<center><img src='".$file."'></center>";
}
}
?>
