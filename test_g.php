<?php 

include "connection/connection.php";

       $check_college_emp="SELECT
    TABLE_NAME
FROM
    INFORMATION_SCHEMA.TABLES order by TABLE_NAME ASC";
        $check_college_emp_run=sqlsrv_query($conntest,$check_college_emp,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
      
          while($row=sqlsrv_fetch_array($check_college_emp_run,SQLSRV_FETCH_ASSOC))
      {

        ?>
       <B><?=$row['TABLE_NAME'];?></B>
      <table border="1">
          <tr>
        <?php 
// $aa[]=$row;
        $get_table_colum="SELECT name FROM sys.columns WHERE object_id = OBJECT_ID('".$row['TABLE_NAME']."')  ";
        $get_table_colum_run=sqlsrv_query($conntest,$get_table_colum);
        while($r=sqlsrv_fetch_array($get_table_colum_run,SQLSRV_FETCH_ASSOC))
        {
?>
            <td><?=$r['name'];?></td>
        <?php 
        }
        ?>  </tr></table><?php
      }
        
// print_r($aa);
        ?>