  <?php
 include "connection/connection.php";

?>
  
  <?php 

  ini_set('max_execution_time', '0');



 $Admiss="SELECT * from Admissions Where Session='2023-24-A'ANd CourseID='188'";
$q1 = sqlsrv_query($conntest, $Admiss);
?><table class="table"><tr><td>IDNo</td><td>UniRollNo</td><td>Class RollNO</td><td>Name</td>
  <td>Father Name</td> <td>COurse</td><td>Debit</td><td>Credit</td><td>Balance</td></tr>
  <?php
        while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
        {
?><tr><td><?= $row['Session'];?></td><td><?= $row['Batch'];?></td><td><?= $idno= $row['IDNo'];?></td><td><?=$row['ClassRollNo'];?></td> <td><?=$row['UniRollNo'];?></td>
<td><?=$row['StudentName'];?></td><td><?=$row['FatherName'];?></td><td><?=$row['Course'];?></td>
<?php 
$Admiss2="SELECT sum(Debit) as totaldebit ,sum(Credit)as totalcredit from ledger  Where IDNo='$idno'";
$q2 = sqlsrv_query($conntest, $Admiss2);
 while ($dataw = sqlsrv_fetch_array($q2, SQLSRV_FETCH_ASSOC)) 
 {
  
$tdebit=$dataw['totaldebit'];
$tcredit=$dataw['totalcredit'];
$balanceamount=$tdebit-$tcredit;
?><td><?=$tdebit;?></td><td><?=$tcredit;?></td><td><?=$balanceamount;?></td>
<?php 
 }?>

          <tr> <?php
        }

