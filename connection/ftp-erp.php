 <?php $ftp_server1 = "10.0.10.11";
  //$ftp_server1 = "117.250.20.109";
   $ftp_user_name1 = "Gurpreet";
   $ftp_user_pass1 = "Guri@123";
   $remote_file1 = "";
   $conn_id = ftp_connect($ftp_server1) or die("Could not connect to $ftp_server1");
   $login_result = ftp_login($conn_id, $ftp_user_name1, $ftp_user_pass1) or die("Could not login to $ftp_server1");

?>