<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
$status=0;
$user=$_POST["user"];
$pass=$_POST["pass"];
$u_permissions = "";
$college = "";
include 'connection/connection.php';
 $sql1 = "SELECT * FROM UserMaster Inner JOin Staff on UserMaster.UserName=Staff.IDNO WHERE UserName ='$user' AND Password='$pass' and ApplicationType='Web' and JobStatus=1";
$stmt2 = sqlsrv_query($conntest,$sql1);
if( $stmt2  === false) {
   // die( print_r( sqlsrv_errors(), true) );
}
else
{
	 while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
     {
       $status=1;
     }
}

	if($status==1)
{
	header("location:dashboard.php");


	}
	
	
else
{
	$_SESSION['incorrect'] = "<p style='color:red;'>Incorrect Password. Try ERP Password .</p>";
	header('Location:index.php');
}
?>
