<?php
session_start();
include_once("connection/connection.php");
$status=0;
    $email_id = $_REQUEST['email_id'];
    $username = $_REQUEST['username'];
   $sql = "SELECT * FROM Admissions WHERE (IDNo = '$username' or UniRollNo='$username' or ClassRollNo='$username') and Status='1' ";
   $result=sqlsrv_query($conntest,$sql);
     $stmt4=sqlsrv_query($conntest,$sql,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));  
      $ifexist=sqlsrv_num_rows($stmt4);
		if ($ifexist>0) {
			while ($row = sqlsrv_fetch_array($result)) {
				$receviername = $row['StudentName'];
				$recevieremail = $row['EmailID'];
				$IDNo = $row['IDNo'];
			}
			$status = 1;
		}
		else {
        // $_SESSION['error'] = "Kindly provide the right information. Email and Username does not match in database";
       echo  '4';
    }
        if($status == 1)
		{
			$userdeptqry = "SELECT Password  FROM UserMaster where UserName='$IDNo' and ApplicationName='Campus'";
			$userdeptres = sqlsrv_query($conntest, $userdeptqry);
			$userdeptdata = sqlsrv_fetch_array($userdeptres);
			$password  = $userdeptdata['Password']; 
			$fileredirectpath="http://gurukashiuniversity.co.in/LMS";
			$subject='Your Recovered Password';
			// $body="<html></body><div>
		
			// <div>Dear $receviername</div></br></br>
			// 	<div style='padding-top:8px;'>Please use this password to login: <b> $password </b> and click the following link</div>
			// 	<div style='padding-top:10px;'><a href='$fileredirectpath'>Click Here</a></div>
			// 	<div style='padding-top:4px;'>Powered by <a href='https://gku.ac.in/'>gku.ac.in</a></div></div>
			// 	</div></body></html>";
			// Include the email template
ob_start();
include 'email/forgotemailtemplate.php';
$body = ob_get_clean();
			include "email/email_code_forgotpassword.php";
		}
$conn->close();
?>
