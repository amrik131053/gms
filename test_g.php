<?php

//include 'connection/connection.php';
$serverName = "10.0.10.11"; //serverName\instanceName
$connectionInfo = array( "Database"=>"DBgurukashi", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");
$conntest = sqlsrv_connect($serverName,$connectionInfo);

$serverName1 = "10.0.10.11";
$connectionInfo1 = array( "Database"=>"App91", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");

$conn91 = sqlsrv_connect( $serverName1,$connectionInfo1);


$s="select  UserId,LogDate,AttDirection,DeviceId from DeviceLogs_1_2024 where LogDate between '2024-01-19 01:00:00.000' ANd '2024-01-22 23:59:00.000' ";

$ss=sqlsrv_query($conn91,$s);
while($r=sqlsrv_fetch_array($ss,SQLSRV_FETCH_ASSOC))
{   
      $Empcode=$r["UserId"];
     $LogDateTime=$r["LogDate"]->format('Y-m-d H:i:s.v');;

  echo $ser="INSERT INTO DeviceLogsAll(EmpCode,LogDateTime,LogDirection,DeviceShortName,SerialNo) Values('$Empcode','$LogDateTime','Null','28','CPAK222261568')";


 $ssd=sqlsrv_query($conntest,$ser);

 if($ssd === false) {
   
   die( print_r( sqlsrv_errors(), true) );
   }
     


}


/*select  UserId,LogDate,AttDirection,DeviceId from DeviceLogs_1_2024 where LogDate between '2024-01-17 01:00:00.000' ANd '2024-01-17 23:59:00.000'  AND  LEN(UserId) < 7

select *  FROM DeviceLogsAll  where LogDateTime between '2024-01-17 01:00:00.000' ANd '2024-01-17 23:59:00.000'  AND  LEN(EmpCode) < 7*/

?>