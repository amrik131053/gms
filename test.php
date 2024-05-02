  <?php
 include "connection/connection.php";

?>
  
  <?php 

  ini_set('max_execution_time', '0');



//  $Admiss="SELECT * from Admissions Where Session='2023-24-A'ANd CourseID='188'";
// $q1 = sqlsrv_query($conntest, $Admiss);
// ?><table class="table"><tr><td>IDNo</td><td>UniRollNo</td><td>Class RollNO</td><td>Name</td>
//   <td>Father Name</td> <td>COurse</td><td>Debit</td><td>Credit</td><td>Balance</td></tr>
//   <?php
//         while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
//         {
// ?><tr><td><?= $row['Session'];?></td><td><?= $row['Batch'];?></td><td><?= $idno= $row['IDNo'];?></td><td><?=$row['ClassRollNo'];?></td> <td><?=$row['UniRollNo'];?></td>
// <td><?=$row['StudentName'];?></td><td><?=$row['FatherName'];?></td><td><?=$row['Course'];?></td>
// <?php 
// $Admiss2="SELECT sum(Debit) as totaldebit ,sum(Credit)as totalcredit from ledger  Where IDNo='$idno'";
// $q2 = sqlsrv_query($conntest, $Admiss2);
//  while ($dataw = sqlsrv_fetch_array($q2, SQLSRV_FETCH_ASSOC)) 
//  {
  
// $tdebit=$dataw['totaldebit'];
// $tcredit=$dataw['totalcredit'];
// $balanceamount=$tdebit-$tcredit;
// ?><td><?=$tdebit;?></td><td><?=$tcredit;?></td><td><?=$balanceamount;?></td>
// <?php 
//  }?>

//           <tr> <?php
//         }

 echo $CourseID = $_GET['course'];
 echo $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['session'];
 

echo $list_sql="SELECT * FROM Admissions WHERE 1=1 ";
if($college!=''){
 $list_sql.= " AND CollegeID='$college' ";
}
if($course!=''){
$list_sql.= "AND CourseID='$course'";
}

if($session!=''){
$list_sql.= "AND Session='$session' ";
}
$list_sql.= "AND Status='1' AND Batch='$batch'";


echo $list_sql;


$q1 = sqlsrv_query($conntest,$list_sql);

$exportstudy="<table class='table'><tr><td>Sr No</td><td>Session</td><td>IDNo</td><td>UniRollNo</td><td>Class RollNO</td><td>Name</td>
  <td>Father Name</td> <td>Course</td> <td>Batch</td><td>Debit</td><td>Credit</td><td>Balance</td></tr>";

  $srno=1;
        while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
        {
$idno=$row['IDNo'];
$exportstudy.="<tr>";
$exportstudy.="<td>{$srno}</<td><td>{$row['Session']}</td><td>{$row['IDNo']}</td><td>{$row['ClassRollNo']}</td> <td>{$row['UniRollNo']}</td>
<td>{$row['StudentName']}</td><td>{$row['FatherName']}</td><td>{$row['Course']}</td><td>{$row['Batch']}</td>";
 
$Admiss2="SELECT sum(Debit) as totaldebit ,sum(Credit)as totalcredit from ledger  Where IDNo='$idno'";
$q2 = sqlsrv_query($conntest, $Admiss2);
 while ($dataw = sqlsrv_fetch_array($q2, SQLSRV_FETCH_ASSOC)) 
 {
  
$tdebit=$dataw['totaldebit'];
$tcredit=$dataw['totalcredit'];
$balanceamount=$tdebit-$tcredit;
$exportstudy.="<td>{$tdebit}</td><td>{$tcredit}</td><td>{$balanceamount}</td>";

 }

          $exportstudy.="<tr>"; 
          $srno++;
        }    
        $exportstudy.="</table>";

        echo $exportstudy;
        $fileName="StudentLedger";