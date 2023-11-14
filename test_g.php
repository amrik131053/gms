<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .oil-lamp {
            position: relative;
            width: 150px;
            height: 200px;
            background-color: #f5d76e; /* Base color of the lamp */
            border-radius: 10px 10px 50% 50%;
            margin: 50px auto;
        }

        .lamp-top {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background-color: #f5d76e; /* Match the base color */
            border-radius: 50%;
        }

        .lamp-handle {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 10px;
            height: 60px;
            background-color: #e74c3c; /* Handle color */
            border-radius: 5px;
        }
    </style>
    <title>Oil Lamp</title>
</head>
<body>

<div class="oil-lamp">
    <div class="lamp-top"></div>
    <div class="lamp-handle"></div>
</div>

</body>
</html>





<?php
// ini_set('max_execution_time', '0');
// include "connection/connection.php";



// $srno=1;
// $sql_staff="select IDNo from Staff ";
// $stmt = sqlsrv_query($conntest,$sql_staff);  
//             while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
//             {
       
//              $IDNo=$row_staff['IDNo'];



//   echo $UPdate="UPDATE Staff set SrNo='$srno' where IDNo='$IDNo'";

// $stmt3 = sqlsrv_query($conntest,$UPdate);
// $srno++;
//          } 

