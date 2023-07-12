<?php 
include 'connection_stroe.php';
print "<br>";
$user_id=$_GET["user_id"];

$result = mysqli_query($connection_s,"UPDATE ledger set request_status='Canceled' where id='$user_id';");
mysqli_close($connection_s);
header('Location:recommend.php');
?>