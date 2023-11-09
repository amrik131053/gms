<?php
ini_set('max_execution_time', '0');
include "connection/connection.php";



$srno=1;
$sql_staff="select IDNo from Staff ";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
       
             $IDNo=$row_staff['IDNo'];



  echo $UPdate="UPDATE Staff set SrNo='$srno' where IDNo='$IDNo'";

$stmt3 = sqlsrv_query($conntest,$UPdate);
$srno++;
         }

