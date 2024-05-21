<?php 

include "connection/connection.php";
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

 $sql1 = "SELECT * FROM UserMaster Inner JOin Staff on UserMaster.UserName=Staff.IDNO WHERE ApplicationType='Web' and JobStatus=1 ";
$countSecure=0;
$countNotSecure=0;
$stmt2 = sqlsrv_query($conntest,$sql1);
	 while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
     {
       $password=$row['Password'];
       $Name=$row['Name'];
       $IDNo=$row['IDNo'];
       if(!is_secure_password($password))
       {
        echo "<b style='color:red;'>Password Not Secure</b> ".$Name."(".$IDNo.")";
        $countNotSecure++;
       }
       else{
        echo " <b style='color:green;'>Password Fully  Secure</b> ".$Name."(".$IDNo.")";
        $countSecure++;
       }

       echo "</br>";
     }
     echo "Total Secure :".$countSecure;
     echo "Total Not Secure :".$countNotSecure;
    
 ?>