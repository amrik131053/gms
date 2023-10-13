<?php 

   $ftp_server = "10.0.8.10";
   $ftp_user_name = "gurukashi";
   $ftp_user_pass = "Amrik@123";
   $remote_file = "";

   $conn_id = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
   $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass) or die("Could not login to $ftp_server");




   
?>