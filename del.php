<?php
include "connection/connection.php";

   $ID="19";
     $staff="Delete FROM Location_master Where ID='$ID'";
  mysqli_query($conn,$staff);  


     

?>