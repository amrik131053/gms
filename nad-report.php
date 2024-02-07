 <?php
session_start();
ini_set('max_execution_time', '0');

ob_start();
header("Content-Type: application/xls");
header("Pragma: no-cache");
header("Expires: 0");
include 'connection/connection.php';
$exportCode = '';
$fileName = 'My File';
$exportstudy="<table class='table' border='1'>
        <thead>  
        ";
$exportstudy.="<tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";

   $exportstudy.="</table>";
   echo $exportstudy;
   $fileName='gg';
   


header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
unset($_SESSION['filterQry']);
ob_end_flush();