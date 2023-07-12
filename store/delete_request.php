<?php 
ob_start();
include '../connection/connection.php';
$as=$_GET["user_id"];
echo $sql = "DELETE from ledger where id='$as'";



if ($connection_s->query($sql) === TRUE) {
    header('Location:../store_request.php');
} else {
    echo "Error deleting record";
}
$connection_s->close();
ob_end_flush();
?> 