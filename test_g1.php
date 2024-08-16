<?php
   ini_set('max_execution_time', '0');
include "connection/connection.php";
// $gg="SELECT IDNo FROM Admissions ";
// $ggrun=sqlsrv_query($conntest,$gg);
// while($row=sqlsrv_fetch_array($ggrun))
// {
//     $IDNo=$row['IDNo'].'.PNG';
//     $ID=$row['IDNo'];
//    echo  "<br>".$up="UPDATE Admissions SET Image='$IDNo' where  IDNo='$ID' and (Image='' or Image Is NUll)";
//  sqlsrv_query($conntest,$up);
// }

$gg="SELECT IDNo FROM Staff ";
$ggrun=sqlsrv_query($conntest,$gg);
while($row=sqlsrv_fetch_array($ggrun))
{
    $IDNo=$row['IDNo'].'.PNG';
    $ID=$row['IDNo'];
   echo  "<br>".$up="UPDATE Staff SET Imagepath='$IDNo' where  IDNo='$ID' and (Imagepath='' or Imagepath Is NUll)";
 sqlsrv_query($conntest,$up);
}

?>