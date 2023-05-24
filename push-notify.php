<?php
session_start();
$EmployeeID=$_SESSION['usr'];
include "connection/connection.php";

  $query_1 = "SELECT * FROM notifications WHERE Web_Status=0 and EmpID='$EmployeeID'";
  $result_1 = mysqli_query($conn, $query_1);
  $count = mysqli_num_rows($result_1);
    if ($count>0) 
    {
  if ($row=mysqli_fetch_array($result_1)) 
   {
      $ID=$row['ID'];
      $SendBy=$row['SendBy'];
    $get_emp_details="SELECT Snap,Name FROM Staff Where IDNo='$SendBy'";
                  $get_emp_details_run=sqlsrv_query($conntest,$get_emp_details);
                  if($row_staff=sqlsrv_fetch_array($get_emp_details_run,SQLSRV_FETCH_ASSOC))
                  {
                  $Emp_Image=$row_staff['Snap'];
                  $SendByName=$row_staff['Name'];
                  
                              
$webNotificationPayload['title'] = $row['Subject'];
$webNotificationPayload['body'] = "By ".$SendByName;
$webNotificationPayload['icon'] = 'http://gurukashiuniversity.co.in/lms/dist/img/logo.jpg';
$webNotificationPayload['url'] = $row['Page_link'];
$webNotificationPayload['id'] = $row['ID'];
echo json_encode($webNotificationPayload);
}
}
}
exit();
?>