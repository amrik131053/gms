<?php

include "connection/connection.php";


if (isset($_POST['btn'])) 
{
	// code...
$univ_rollno=$_POST['uni'];
$result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno'";

   $update_run1=sqlsrv_query($conntest,$result1);
   if ($row=sqlsrv_fetch_array($update_run1,SQLSRV_FETCH_ASSOC)) {
   $IDNo=$row['IDNo'];

  $update_student="UPDATE UserMaster SET Password='12345678' where UserName='$IDNo'";
   $update_run=sqlsrv_query($conntest,$update_student);
   if ($update_run==TRUE) 
   {
   echo "Successfully";
   }
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<form action="#" method="post">
<input type="text" name="uni">
<button type="submit" name="btn">Update</button>
</form>
</body>
</html>