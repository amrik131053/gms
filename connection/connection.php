<?php
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$timeStamp=date('Y-m-d H:i:s.v');
$timeStampS=date('Y-m-d H:i:s');
$todaydate=date('Y-m-d');
$day=date('l'); 


// ----------------local DB-------------------------------
// $username="Amrik";
//  $password="Amrik@123";
// $serverName = "10.0.8.181"; 
 //$servername1 = "localhost";
// $username1 = "guri";
// $password1 = "Guri@123";
//-----------------LIve DB------------------------------------
$username="sa";
$password = "b2y3rt78374&*#&$";
$serverName = "10.0.10.11";


 $servername1 = "10.0.8.10";
 $username1 = "as";
 $password1 = "Bathinda@123";
// -----------------------------------------------------------------
$connectionInfo = array( "Database"=>"DBGuruKashi",  "UID"=>"$username", "PWD"=>"$password",    "Encrypt" => "no",     "TrustServerCertificate" => true );
$conntest = sqlsrv_connect($serverName,$connectionInfo);


if ($conntest === false) {
    die("Connection failed: " . print_r(sqlsrv_errors(), true));
}



$connectionInfo1 = array( "Database"=>"App91", "UID"=>"$username", "PWD"=>"$password");
$conn91 = sqlsrv_connect( $serverName,$connectionInfo1);

$dbname1 = "lims";
$dbname2 = "store";
$dbname3 = "spoc";
$conn = new mysqli($servername1, $username1, $password1, $dbname1);
$connection_s = new mysqli($servername1, $username1, $password1, $dbname2);
$conn_spoc = new mysqli($servername1, $username1, $password1, $dbname3);
if ($conntest ) {
//echo "success";
}
if ($conntest)
{
}
$BasURL="http://erp.gku.ac.in:86/";

?>