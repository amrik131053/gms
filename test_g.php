<?php

include 'connection/connection.php';




$s="SELECT IDNo,Name,Designation from Staff WHERE IDNo='170976'";
$ss=sqlsrv_query($conntest,$s);
while($r=sqlsrv_fetch_array($ss,SQLSRV_FETCH_ASSOC))
{
    $array[]=$r;

}
// echo json_encode($array);
print_r($array);

?>