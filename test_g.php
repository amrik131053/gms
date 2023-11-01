<?php
ini_set('max_execution_time', '0');
include "connection/connection.php";



include 'attendance-employee-get-export.php';
     
include 'attendance-date-function.php';


$exportdaily="<table class='table' border='1'><tr>";
    
$srno=1;
for ($i=0;$i<$no_of_emp;$i++)
{

  $exportdaily.="<th>
  <table class='table' border='1'>";


$paiddays=0;
$h=0;


$sql_staff="select * from Staff where IDNo='$emp_codes[$i]'";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
           $Department=$row_staff['Department'];
                      $CollegeName=$row_staff['CollegeName'];
             $IDNo=$row_staff['IDNo'];
                  $College=$row_staff['CollegeName'];


  $exportdaily.="<tr><th style='color:red;' colspan=5>Summary Report({$showmonth}-{$curyear})</th></tr>";

$exportdaily.="<tr><td colspan=2>Employee ID</td><td colspan=3 style='text-align:left'>{$IDNo}</td></tr>";
$exportdaily.="<tr><td colspan=2>Name</td><td colspan=3>{$Name}</td></tr>";
$exportdaily.="<tr><td colspan=2>Department</td ><td colspan=3>{$Department}</td></tr>";

$exportdaily.="<tr><td colspan=5><b>{$CollegeName}</b></td></tr>";

$exportdaily.="<tr><td>Date</td><td>In time</td><td>Out Time</td><td>Remarks</td><td>Count</td></tr>";
 
$srno++;

for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

    $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo' ";

     $exportdaily.="<tr><td style='text-align:center'>{$start}</td>";
      $stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            $intime=$row_staff_att['mytime'];
            $outtime=$row_staff_att['mytime1'];

         

$exportdaily.="<td style='text-align:center'>";
 if($intime!="")
{ 
$myin= $intime->format('H:i');
} 
else
{ 
 $myin="";
}


$exportdaily.="{$myin}</td><td style='text-align:center'>";
 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   
   

$exportdaily.="{$myout}</td>";



include 'attendance-calculator.php';


if($HolidayName!='' && $printleave!='')
{

 $exportdaily.="<td>{$HolidayName} {$printleave}</td><td>";
    
}
else if($HolidayName!='' && $printleave=='')
{
 $exportdaily.="<td>{$HolidayName}</td><td>";
}
else if($HolidayName=='' && $printleave!='')
{
 $exportdaily.="<td>{$printleave}</td><td>";
}
else if ($HolidayName=='' && $printleave=='' && $intime=='' && $outtime=='')
{
   $joiningdateab="select * from  Staff where DateOfJoining<='$start 00:00:00' AND IDNo='$IDNo'";


 $list_result_joinab = sqlsrv_query($conntest,$joiningdateab, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

                $row_count_joinab = sqlsrv_num_rows($list_result_joinab);  

if($row_count_joinab>0)
            {
           $exportdaily.="<td bgcolor='red' color='white'>Absent</td><td>";
         
             }
             else
             {
               $exportdaily.="<td bgcolor='green' color='white'>Late Joining</td><td>";
             }



}
else
{
    $exportdaily.="<td></td><td>";
}


$exportdaily.="{$countday}</td></tr>";

$paiddays=$paiddays+$countday;


}


}
if($paiddays<>$h)
{ 


    $exportdaily.="<tr><td  style='color:red;' colspan=3>Total Paid Days</td><td colspan=2><b>{$paiddays} out of {$myenddate}</b></td></tr>";
}
else
{
    $exportdaily.="<tr><td colspan=3 color='red'>Total Paid Days</td><td colspan=2><b>0</b></td></tr>";
}


$exportdaily.="</table>";

}


$exportdaily.="</th><th></th>";
}
   
    $exportdaily.="<tr></table>"; 
       //echo $exportMeterHeader;    
       echo $exportdaily;  

        // $fileName="$filename ($showmonth-$curyear) Attendance Report ";