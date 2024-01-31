<?php

date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
   $timeStamp=date('Y-m-d H:i:s.v');
   $timeStampS=date('Y-m-d H:i:s');

$serverName = "10.0.10.11"; //serverName\instanceName
$connectionInfo = array( "Database"=>"DBgurukashi", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");
$conntest = sqlsrv_connect($serverName,$connectionInfo);


$connectionInfo1 = array( "Database"=>"App91", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");
$conn91 = sqlsrv_connect( $serverName,$connectionInfo1);

// $servername1 = "localhost";
// $username1 = "bhagi";
// $password1 = "@Sarbjot@98157";
// $servername1 = "10.0.8.181";
// $username1 = "Local";
// $password1 = "";


$servername1 = "10.0.8.10";
$username1 = "as";
$password1 = "Bathinda@123";
// $servername1 = "localhost";
// $username1 = "root";
// $password1 = "";


$dbname1 = "lims";
 $dbname2 = "store";
 $dbname3 = "spoc";
$conn = new mysqli($servername1, $username1, $password1, $dbname1);
$connection_s = new mysqli($servername1, $username1, $password1, $dbname2);
$conn_spoc = new mysqli($servername1, $username1, $password1, $dbname3);
if ($conn) {



}

if ($conntest)
{
   $staff="SELECT Name,Snap,Designation,Department,DateOfJoining,LeaveSanctionAuthority,CollegeID,RoleID FROM Staff Where IDNo='$EmployeeID'";
   $stmt = sqlsrv_query($conntest,$staff);  
  while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
       {
  $Emp_Name=$row_staff['Name'];
  $Emp_Image=$row_staff['Snap'];
   $Emp_Department=$row_staff['Department'];
    $Emp_Designation=$row_staff['Designation'];
    $Emp_CollegeID=$row_staff['CollegeID'];
   $DateOfJoining=$row_staff['DateOfJoining'];
   $LeaveSanctionAuthority=$row_staff['LeaveSanctionAuthority'];
   $role_id = $row_staff['RoleID'];
       }
   
}







?>