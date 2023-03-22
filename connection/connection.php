<?php
 
$serverName = "103.18.70.79"; //serverName\instanceName
$connectionInfo = array( "Database"=>"DBgurukashi", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");
$conntest = sqlsrv_connect( $serverName,$connectionInfo);

$connectionInfo1 = array( "Database"=>"App91", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");
$conn91 = sqlsrv_connect( $serverName,$connectionInfo1);

$connection_web_in_website= new mysqli('119.18.54.49:3306', 'guruk2cy_connect','Amrik@123','guruk2cy_website');



// $servername1 = "localhost";
// $username1 = "root";
// $password1 = "";
// $dbname1 = "lims";

$servername1 = "localhost";
$username1 = "bhagi";
$password1 = "@Sarbjot@98157";
$dbname1 = "lims";



$conn = new mysqli($servername1, $username1, $password1, $dbname1);


if ($conn) {

}


?>