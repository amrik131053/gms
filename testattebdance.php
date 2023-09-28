
<?php 

include 'connection/connection.php';
$curmnth ="08";
$curyear = 2023;
 $emp_code='131053';

function get_days_in_month($month, $year)
{
    if ($month == "02")
    {
        if ($year % 4 == 0) return 29;
        else return 28;
    }
    else if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12") return 31;
    else return 30;
}
$totDays = get_days_in_month($curmnth, $curyear);

$start_date="$curyear-$curmnth-01";
$currentmonth=date('m');

if($curmnth<>$currentmonth)
{
    $myenddate=$totDays;
}
else
{
$myenddate=$currentdate=date('d');
}

 $end_date="$curyear-$curmnth-$myenddate";

function getBetweenDates($startDate,$endDate) {
 $array = array();
 $interval = new DateInterval('P1D');

 $realEnd = new DateTime($endDate);
 $realEnd->add($interval);

 $period = new DatePeriod(new DateTime($startDate), $interval, $realEnd);

 foreach($period as $date) {
   $array[] = $date->format('Y-m-d');
 }

 return $array;
}
$datee = getBetweenDates($start_date,$end_date);
 $no_of_dates=count($datee);
?>
<table class='table' border='1'><tr>

    <?php 
$srno=1;


?><th><table class='table' border='1'>

<?php
$paiddays=0;
$h=0;


$sql_staff="select * from Staff where IDNo='$EmployeeID'";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
           $Department=$row_staff['Department'];
                      $CollegeName=$row_staff['CollegeName'];
             $IDNo=$row_staff['IDNo'];
                  $College=$row_staff['CollegeName'];

?><tr><th style='color:red;' colspan=5>Summary Report</th></tr>

<tr><td colspan=2>Employee ID</td><td colspan=3 style='text-align:left'><?=$IDNo;?></td></tr>
<tr><td colspan=2>Name</td><td colspan=3><?= $Name;?></td></tr>";
<tr><td colspan=2>Department</td ><td colspan=3><?= $Department;?></td></tr>

<tr><td colspan=2>College Name</td><td colspan=3><?= $CollegeName;?></td></tr>

<tr><td>Date</td><td>In time</td><td>Out Time</td><td>Leave</td><td>Count</td></tr>
 <?php
$srno++;
for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

   $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo' ";

?><tr><td style='text-align:center'><?=$start?></td><?php 
      $stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            $intime=$row_staff_att['mytime'];
            $outtime=$row_staff_att['mytime1'];

         

?><td style='text-align:center'>
    <?php 
 if($intime!="")
{ 
$myin= $intime->format('H:i');
} 
else
{ 
 $myin="";
}
?>

<?= $myin?></td><td style='text-align:center'>
    <?php
 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   ?>
   

<?= $myout?></td>
<?php
$holidaycount=0;

$sql_holiday="Select * from  Holidays where HolidayDate  Between '$start 00:00:00.000' ANd  '$start 23:59:00.000'";
$stmt = sqlsrv_query($conntest,$sql_holiday);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
         $HolidayName=$row_staff['HolidayName'];
 $h++;

         $holidaycount=1;
             }



 $sql_att23="SELECT  Name,LeaveDuration,LeaveDurationsTime,LeaveTypes.Id as leavetypes,
            CASE 
               WHEN StartDate < '$start' THEN '$start'
               ELSE StartDate 
            END AS Leave_Start_Date,
            CASE 
               WHEN EndDate > '$start' THEN '$start'
               ELSE EndDate 
            END AS Leave_End_Date       
FROM        ApplyLeaveGKU   inner join LeaveTypes on ApplyLeaveGKU.LeaveTypeId=LeaveTypes.Id
WHERE       StartDate <= '$start' AND
            EndDate >= '$start' ANd StaffId='$IDNo' ANd Status='Approved'"; 
$leaveName='';
$printleave='';
$leavecount=0;
$stmt = sqlsrv_query($conntest,$sql_att23);  
            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            
           $leavetypeid=$row['leavetypes'];
            $leaveName=$row['Name'];
               $leaveduration=$row['LeaveDuration'];
                   $leavedurationtime=$row['LeaveDurationsTime'];

           }

 if($leaveName!='')
 {
  if($leavedurationtime>0)
{ 
  $printleave=  $leavedurationtime.' day '.$leaveName;

 

} 
 else
 {
    
 $printleave= '1 day '.$leaveName;

 

 }

 if($leavetypeid==1 ||$leavetypeid==2||$leavetypeid==3||$leavetypeid==8 ||$leavetypeid==12)
 {

  if($leavedurationtime>0)
{ 
  $leavecount= $leavedurationtime;
 
} 
 else
 {
    
 $leavecount=1;


 }


 }
 else
 {

  if($leavedurationtime>0)
{ 
  $leavecount= -$leavedurationtime;
 
} 
 else
 {
    
 $leavecount=-1;


 }


 }


}

if($HolidayName!='' && $printleave!='')
{

?><td><?= $HolidayName;?> <?=$printleave;?></td><td><?php
    
}
else if($HolidayName!='' && $printleave=='')
{
?><td><?=$HolidayName;?></td><td><?php
}
else if($HolidayName=='' && $printleave!='')
{
?><td><?=$printleave?></td><td><?php
}
else if ($HolidayName=='' && $printleave=='' && $intime=='' && $outtime=='')
{
   ?><td bgcolor='red' color='white'>Absent</td><td><?php
}
else
{
  ?><td></td><td><?php
}




$mydaycount=1;
$totaldeduction=1;




if($intime!='' && $outtime!='' && ($outtime>$intime) )
{


$deducation=0;


if($myin>'09:03' && $myin<'11:01')
{
    $deducation=0.25;
}
else if($myin>'11:00'&& $myin<'13:01')
{
    $deducation=0.50;
}

else if($myin>'13:00'&& $myin<'15:01')
{
    $deducation=0.75;
}
else if($myin>'15:00'&& $myin<'17:01')
{
   $deducation=1;  
}
else if($myin>'17:00')
{
    $deducation=1;
}
else 
{
   $deducation=0;  
}

$deducationo=0;

if($myout>='15:00'&& $myout<'17:00')
{
    $deducationo=0.25;
}
else if($myout>='13:00'&& $myout<'15:00')
{
    $deducationo=0.50;
}

else if($myout>='11:00'&& $myout<'13:00')
{
    $deducationo=0.75;
}

else if($myout>='09:00'&& $myout<'11:00')
{
    $deducationo=1;
}

else if($myout>='09:00'&& $myout<'11:00')
{
    $deducationo=1;
}
else if($myout<'09:00')
{
    $deducationo=1;
}
else 
{
  $deducationo=0;  
}
 $totaldeduction=$deducation+$deducationo;

}

$countdayn=$mydaycount-$totaldeduction+$holidaycount+$leavecount;

if($countdayn<=1)
{
    if($countdayn<0)
    {
$countday=0;
    }
    else
    {
  $countday=$countdayn;  
}
}
else
{
    $countday=1;
}?>

<?= $countday;?></td></tr>
<?php 

$paiddays=$paiddays+$countday;


}




}
if($paiddays<>$h)
{
  ?><tr><td colspan=3 color='red'>Total Paid Days</td><td colspan=2><b><?=$paiddays?></b></td></tr><?php
}
else
{
  ?><tr><td colspan=3 color='red'>Total Paid Days</td><td colspan=2><b>0</b></td></tr><?php
}

?>
<tr><td colspan=5></td></tr>
<?php

}
?> <?php 



   
?><tr></table> 
      

