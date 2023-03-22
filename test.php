  <?php
 include "connection/connection.php";
  echo  $sql1 = "{CALL USP_Get_studentbyCollegeInternalMarksDistributionPractical(66,118,3,2021,402302,'December 2022',41,'NA')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

        $count=0;
echo $row = sqlsrv_fetch_array($stmt);
     while($row = sqlsrv_fetch_array($stmt)){



print_r($row);

}

               
                   
?>
