<?php
include "connection/connection.php";
 include "connection/connection_web.php"; 
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
// $list=array();
// $month = 12;
// $year = 2023;

// for($d=1; $d<=31; $d++)
// {
//     $time=mktime(12, 0, 0, $month, $d, $year);          
//     if (date('m', $time)==$month)       
//         $list[]=date('Y-m-d-D', $time);
// }
// echo "<pre>";
// print_r($list);
// echo "</pre>";

// $dates = getBetweenDates('2020-01-01', '2023-07-09');
// function getBetweenDates($startDate, $endDate) {
//     $rangArray = [];
 
//     $startDate = strtotime($startDate);
//     $endDate = strtotime($endDate);
 
//     for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400)) {
//         $date = date('Y-m-d', $currentDate);
//         $rangArray[] = $date;
//     }
 
//     return $rangArray;
// }
// print_r($dates);

?>
<form action="#" method="post" enctype="multipart/form-data" >
    <input type="file" name="file_exl" >
    <input type="submit" value="Submit" name="btnsubmit">
</form>
<?php

// if(isset($_POST['btnsubmit']))
// {

// $file = $_FILES['file_exl']['tmp_name'];
// $handle = fopen($file, 'r');
// $c = 0;
// while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
// {
//       echo $empid= $filesop[0];
//       echo $blnce= $filesop[1];
//     echo "<br>";

//     echo $addbalnce="UPDATE LeaveBalances SET Balance=Balance+$blnce where Employee_Id='$empid' and LeaveType_Id='1'";
//     echo "<br>";
//       // $update_study_run=sqlsrv_query($conntest,$addbalnce);  
//   if ($update_study_run==true) 
//   {
//      echo "success";
//   }
//   else
//   {
//    echo"no";
//   }
   
// }
// }

if(isset($_POST['btnsubmit']))
{

$file = $_FILES['file_exl']['tmp_name'];
$handle = fopen($file, 'r');
$c = 0;
while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
{
      echo $empid= $filesop[0];
      echo $blnce= $filesop[1];
    echo "<br>";

    
$result1 = mysqli_query($conn_online,"UPDATE online_payment set SeatNo='$empid' where roll_no='$blnce'");

   // echo $addbalnce="UPDATE LeaveBalances SET Balance=Balance+$blnce where Employee_Id='$empid' and LeaveType_Id='1'";
   // echo "<br>";
      // $update_study_run=sqlsrv_query($conntest,$addbalnce);  
  // if ($update_study_run==true) 
  // {
  //    echo "success";
  // }
  // else
  // {
  //  echo"no";
  // }
   
}
}


?>