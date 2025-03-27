<?php
   date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
   $timeStamp=date('Y-m-d H:i:s.v');
   $timeStampS=date('Y-m-d H:i:s');
      $todaydate=date('Y-m-d');
   $day=date('l'); 
   
$serverName = "10.0.8.181"; //serverName\instanceName
$connectionInfo = array( "Database"=>"DBGuruKashi",  "UID"=>"Amrik", "PWD"=>"Amrik@123");

// $serverName = "117.250.20.109";
// $connectionInfo = array( "Database"=>"DBGuruKashi",  "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");

//$connectionInfo = array( "Database"=>"DBGuruKashi",  "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");

$conntest = sqlsrv_connect($serverName,$connectionInfo);
$connectionInfo1 = array( "Database"=>"App91", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");
$conn91 = sqlsrv_connect( $serverName,$connectionInfo1);


$servername1 = "10.0.8.10";
//$servername1 = "117.250.20.111";

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

}

$BasURL="http://erp.gku.ac.in:86/";

?>