  <?php
 include "connection/connection.php";

?>
  
  <?php 

  ini_set('max_execution_time', '0');



  //include'sendsms.php';

if(ISSET($_POST['email_imp']))
{  
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {

  $reg_id = $filesop[0];
  $reg_id1 =$filesop[1];



$sql = "UPDATE  Staff  SET RoleID = '$reg_id1' WHERE IDNo='$reg_id'";
   

   $list_result = sqlsrv_query($conntest,$sql);


if($list_result === false) {

    die( print_r( sqlsrv_errors(), true) );
}



    

}

}




    ?>


    <form action="" enctype="multipart/form-data" method="post">
          <input type="file" name="file_exl" class="btn btn-warning btn-xs">
          </div>
 <div class="col-sm-1">
         <button type="submit"  name='email_imp' class="btn btn-warning btn-xs">Import</button>
          </div>
</form>
<?php


               
                   
?>
