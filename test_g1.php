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
    <input type="text" name="UniRollNo" id="">
<input type="file" name="image" id="image" class="form-control input-group-sm">
<input type="submit" name="actionFile" value="Upload" class="btn btn-success btn-xs">
</form>
<?php 

if(isset($_POST['actionFile']))
{
    $RollNO=$_POST['UniRollNo'];
$file_name = $_FILES['image']['name'];
$file_tmp = $_FILES['image']['tmp_name'];
$type = $_FILES['image']['type'];
$file_data = file_get_contents($file_tmp);
// $gg="SELECT Snap,IDNo
// FROM Admissions
// WHERE Snap IS NULL OR LEN(CAST(Snap AS VARBINARY(MAX))) = 0 ";
// $ggrun=sqlsrv_query($conntest,$gg);
// while($row=sqlsrv_fetch_array($ggrun))
// {
// $ID=$row['IDNo'];
$upimage = "UPDATE Admissions SET Snap = ? WHERE IDNo = ?";
$params = array($file_data, $RollNO);
$upimage_run = sqlsrv_query($conntest, $upimage, $params);
// }
}


?>