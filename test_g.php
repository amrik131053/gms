<?php
include "connection/connection.php";

$sql="SELECT * from MasterShiftTime ";
$stmt2 = sqlsrv_query($conntest,$sql);
while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
{
$aa[]=$row1;
}
print_r($aa);

echo "<br>-------------------------------------------------------";

$sql1="SELECT * from MasterShift ";
$stmt21 = sqlsrv_query($conntest,$sql1);
while($row11 = sqlsrv_fetch_array($stmt21, SQLSRV_FETCH_ASSOC) )
{
$aa1[]=$row11;
}
print_r($aa1);