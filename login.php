<?php
session_start();
date_default_timezone_set("Asia/Kolkata");

//$_SESSION['usr']=$_GET["UserId"];
$status=0;
// echo $user1=$_GET["UserId"];
//echo $pwd=$_GET["pwd"];
$user=$_POST["user"];
$pass=$_POST["pass"];
//$pass=$_POST["pass"];
$u_permissions = "";
$college = "";
include 'connection/connection.php';
 $sql1 = "SELECT * FROM UserMaster WHERE UserName ='$user' AND Password='$pass' and ApplicationType='Web'";
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
$sql = "SELECT * from user where emp_id='$user'";

$result = mysqli_query($conn, $sql);

while($re=mysqli_fetch_array($result))
{
	$u_permissions = $re['u_permissions'];
	// $autho=$re["status"];
	$college = $re["college"];
	$_SESSION['show_lastlogin_date'] = $re['last_login_date'];
	$_SESSION['show_lastlogin_time'] = $re['last_login_time'];
}


	
$autho="Authorised";
if($status==1)
{
	if($autho=='Authorised')
	{
		$_SESSION['u_permissions'] = $u_permissions;
		$_SESSION['usr'] = $user;
		$_SESSION['college'] = $college;
		$login_date = date("d-m-Y");
		$login_time = date("h:i:s a");
		$_SESSION['login_date'] = $login_date;
		$_SESSION['login_time'] = $login_time;
		header("location:dashboard.php");


				if(!empty($_POST["remember"])) {
//COOKIES for username
setcookie ("user_login",$_POST["user"],time()+ (10 * 365 * 24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["pass"],time()+ (10 * 365 * 24 * 60 * 60));
} else {
if(isset($_COOKIE["user_login"])) {
setcookie ("user_login","");
if(isset($_COOKIE["userpassword"])) {
setcookie ("userpassword","");
				}
			}
	header("location:dashboard.php");
	}
	}
	else
	{
		$_SESSION['not_valid'] = "<p style='color:red;'>You are not a Valid User.</p>";
			header('Location:http://10.0.10.11:86');
	}
}
else
{
	$_SESSION['incorrect'] = "<p style='color:red;'>Incorrect Password. Try ERP Password .</p>";
	header('Location:index.php');
}
?>