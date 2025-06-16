<?php
   ini_set('max_execution_time', '0');

$serverName = "10.0.10.11";
$connectionInfo = array( "Database"=>"DBGuruKashi",  "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");

//$connectionInfo = array( "Database"=>"DBGuruKashi",  "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");

$conntest = sqlsrv_connect($serverName,$connectionInfo);

$serverName1 = "10.0.8.181";
$connectionInfo1 = array( "Database"=>"DBGuruKashi", "UID"=>"Amrik", "PWD"=>"Amrik@123");
$conn91 = sqlsrv_connect($serverName1,$connectionInfo1);


$gg="SELECT * from Staff order by IDNo desc";
$ggrun=sqlsrv_query($conn91,$gg);
while($row=sqlsrv_fetch_array($ggrun))
{
   echo  $Id=$row['IDNo'];
   $name=$row['Name'];
     $Designation=$row['Designation'];
   $contact=$row['PermanentAddress'];
 $Updat="UPDATE Staff set Name='$name',PermanentAddress='$contact',Designation='$Designation' where IDNo='$Id'";

$Updatrun=sqlsrv_query($conntest,$Updat);

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
// if(isset($_POST['submitPass'])){
//     $PasswordSet=$_POST['PasswordSet'];
//     $EmployeeID=$_POST['EmployeeID'];
//     $OfficialEmailID=$_POST['OfficialEmailID'];
//     $EmailID=$_POST['EmailID'];
// $getDefalutMenu="UPDATE  UserMaster  SET Password='$PasswordSet' Where UserName='$EmployeeID' and ApplicationName='Campus' ";
// $getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);

// $getDefalutMenu112="UPDATE  Staff  SET OfficialEmailID='$OfficialEmailID',EmailID='$EmailID' Where IDNo='$EmployeeID' ";
// $getDefalutMenu112Run=sqlsrv_query($conntest,$getDefalutMenu112);

// if($getDefalutMenuRun==true)
// {
//     echo "Lock";
// }
// else{
//     echo "0";
// }
// }
// if(isset($_POST['submitPassReset'])){
//     $PasswordSet=$_POST['PasswordSet'];
//     $EmployeeID=$_POST['EmployeeID'];
//     $OfficialEmailIDSet=$_POST['OfficialEmailIDSet'];
//     $EmailIDSet=$_POST['EmailIDSet'];
// $getDefalutMenu="UPDATE  UserMaster  SET Password='$PasswordSet' Where UserName='$EmployeeID' and ApplicationName='Campus' ";
// $getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);

// $getDefalutMenu11="UPDATE  Staff  SET OfficialEmailID='$OfficialEmailIDSet',EmailID='$EmailIDSet' Where IDNo='$EmployeeID' ";
// $getDefalutMenu11Run=sqlsrv_query($conntest,$getDefalutMenu11);
// if($getDefalutMenuRun==true)
// {
//     echo "Unlock";
// }
// else{
//     echo "0";
// }
// }

// ?>
<!-- <form action="#" method="post">
// <input type="text" value="171714" name="EmployeeID">
// <input type="text" value="Manoj@19821" name="PasswordSet">
// <input type="text" value="hodpharmacy@gku.ac.in" name="OfficialEmailID">
// <input type="text" value="drmanoj1711714@gku.ac.in" name="EmailID">
//     <button type="submit" name="submitPass" >Lock</button>
// </form>
// <form action="#" method="post">
// <input type="text" value="171714" name="EmployeeID">
// <input type="text" value="Manoj@1982" name="PasswordSet">
// <input type="text" value="hod.pharmacy@gku.ac.in" name="OfficialEmailIDSet">
// <input type="text" value="drmanoj171714@gku.ac.in" name="EmailIDSet">
//     <button type="submit" name="submitPassReset" >Unlock</button>
// </form>-->