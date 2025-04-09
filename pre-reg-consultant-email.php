<?php
session_start();
include_once("connection/connection.php");
$status=0;
    $id = $_REQUEST['id'];
   
   $sql = "SELECT * FROM MasterConsultant WHERE ID='$id' and Status='1' ";
   $result=sqlsrv_query($conntest,$sql);
     $stmt4=sqlsrv_query($conntest,$sql,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));  
      $ifexist=sqlsrv_num_rows($stmt4);
        if ($ifexist>0) {
            while ($row = sqlsrv_fetch_array($result)) {
                $receviername = $row['Name'];
                $recevieremail = $row['Email'];
                      $organisationName = $row['Organisation'];
            }
            $status = 1;
        }
        else {
        // $_SESSION['error'] = "Kindly provide the right information. Email and Username does not match in database";
       echo  '4';
    }
        if($status == 1)
        {
           
ob_start();
include 'email/preregtemp.php';
$body = ob_get_clean();
            include "email/email_code_adm.php";
        }
$conn->close();
?>
