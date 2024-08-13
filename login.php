<?php ob_clean();
session_start();
date_default_timezone_set("Asia/Kolkata");
$status=0;
$user=$_POST["user"];
$pass=$_POST["pass"];
$u_permissions = "";
$college = "";
$_SESSION['profileIncomplete']=0;
function is_secure_password($password) {
    
   $min_length = 8;
   
   
   if (strlen($password) < $min_length) {
       return false;
   }
   
   
   $contains_uppercase = preg_match('/[A-Z]/', $password);
   $contains_lowercase = preg_match('/[a-z]/', $password);
   $contains_digit = preg_match('/\d/', $password);
   $contains_special = preg_match('/[\W]/', $password); 
   
   
   if (!$contains_uppercase || !$contains_lowercase || !$contains_digit || !$contains_special) {
       return false;
   }
   
   return true;
}

include 'connection/connection.php';

$sql1 = "SELECT * FROM UserMaster Inner JOin Staff on UserMaster.UserName=Staff.IDNO WHERE UserName ='$user' AND Password='$pass' and ApplicationType='Web' and JobStatus=1 ";

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
   $_SESSION['usr'] = $user;
   $updateLoggedIn = "UPDATE  UserMaster SET LoggedIn='0' where  UserName='$user' and  ApplicationType='Web' and ApplicationName='Campus' ";
   sqlsrv_query($conntest, $updateLoggedIn);
   if (is_secure_password($pass)) {
      header('Location:Dashboard.php'); 
      $_SESSION['secure']=0;
  } 
  else
  {
   $_SESSION['secure']=1;
   header('Location:password-change.php'); 
  }
	}
else
{
	echo $_SESSION['incorrect'] = "<p style='color:red;'>Incorrect Password. Try ERP Password .</p>";
	header('Location:index.php');
}
?>