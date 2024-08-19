<?php
   ini_set('max_execution_time', '0');
include "connection/connection.php";
// $gg="SELECT IDNo FROM Admissions ";
// $ggrun=sqlsrv_query($conntest,$gg);
// while($row=sqlsrv_fetch_array($ggrun))
// {
//     $IDNo=$row['IDNo'].'.PNG';
//     $ID=$row['IDNo'];
//    echo  "<br>".$up="UPDATE Admissions SET Image='$IDNo' where  IDNo='$ID' and (Image='' or Image Is NUll)";
//  sqlsrv_query($conntest,$up);
// }

// $gg="SELECT IDNo FROM Staff ";
// $ggrun=sqlsrv_query($conntest,$gg);
// while($row=sqlsrv_fetch_array($ggrun))
// {
//     $IDNo=$row['IDNo'].'.PNG';
//     $ID=$row['IDNo'];
//    echo  "<br>".$up="UPDATE Staff SET Imagepath='$IDNo' where  IDNo='$ID' and (Imagepath='' or Imagepath Is NUll)";
//  sqlsrv_query($conntest,$up);
// }
?>
<form  action="#" method="post" enctype="multipart/form-data">
    <label for="">File</label>
    <input type="file" name="file_exl" id="file_exl" class="form-control input-group-sm">
    <label for="">Image</label>
<input type="file" name="image" id="image" class="form-control input-group-sm">
<input type="submit" name="actionFile" value="Upload" class="btn btn-success btn-xs">
</form>
<?php 
if(isset($_POST['actionFile']))
{
    // $RollNO=$_POST['UniRollNo'];
$file_name = $_FILES['image']['name'];
$file_tmp = $_FILES['image']['tmp_name'];
$type = $_FILES['image']['type'];
$file_data = file_get_contents($file_tmp);
$file = $_FILES['file_exl']['tmp_name'];
$handle = fopen($file, 'r');
$c = 0;
while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
{
      $ID= $filesop[0];
     
// $gg="SELECT Snap,IDNo
// FROM Admissions
// WHERE Snap IS NULL OR LEN(CAST(Snap AS VARBINARY(MAX))) = 0 OR Snap = 0x  ";
// $ggrun=sqlsrv_query($conntest,$gg);
// while($row=sqlsrv_fetch_array($ggrun))
// {
// $ID=$row['IDNo'];
$upimage = "UPDATE Admissions SET Snap = ? WHERE IDNo = ?";
$params = array($file_data, $ID);
$upimage_run = sqlsrv_query($conntest, $upimage, $params);

$get_student_details="SELECT Snap,IDNo FROM Admissions where IDNo='$ID'";
$get_student_details_run=sqlsrv_query($conntest,$get_student_details);
if($row_student=sqlsrv_fetch_array($get_student_details_run))
{
    $mimeType="";
    $snap=$row_student['Snap'];
     $pic=base64_encode($snap);
     $dataUrl = 'data:' . $mimeType . ';base64,' . $pic;
     ?>
     <br>
     <?=$ID;?>
     <img src="<?=$dataUrl;?>" alt="" width="100">
     <?php 
}



}
}

?>