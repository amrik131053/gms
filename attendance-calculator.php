

<?php 




$holidaycount=0;

$sql_holiday="Select * from  Holidays where HolidayDate  Between '$start 00:00:00.000' ANd  '$start 23:59:00.000'";
$stmt = sqlsrv_query($conntest,$sql_holiday);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
 $h++;
 $joiningdate="select * from  Staff where DateOfJoining<='$start 00:00:00' AND IDNo='$IDNo'";


 $list_result_join = sqlsrv_query($conntest,$joiningdate, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

                $row_count_join = sqlsrv_num_rows($list_result_join);  

if($row_count_join>0)
            {
         $holidaycount=1;
          $HolidayName=$row_staff['HolidayName'];
             }
             else
             {
                $holidaycount=0;

                $HolidayName1=$row_staff['HolidayName'];
                $HolidayName="Late Joining"."(" .$HolidayName1.")";
             }

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

 if($leavetypeid==1 ||$leavetypeid==2||$leavetypeid==3||$leavetypeid==8 ||$leavetypeid==12||$leavetypeid==7||$leavetypeid==6)
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



 }


}


$mydaycount=1;
$totaldeduction=1;










$fintime1='09:02';
$fintime2='11:00';
$fintime3='13:00';
$fintime4='15:00';
$fintime5='17:00';

$fouttime1='17:00';
$fouttime2='15:00';
$fouttime3='13:00';
$fouttime4='11:00';
$fouttime5='09:00';








if($start=='2023-10-27'){
$fintime1='08:18';
$fouttime1='16:00';
}

if($intime!='' && $outtime!='' && ($outtime>$intime) )
{


$deducation=0;


if($myin>$fintime1 && $myin<=$fintime2)
{
    $deducation=0.25;
}
else if($myin>$fintime2&& $myin<=$fintime3)
{
    $deducation=0.50;
}

else if($myin>$fintime3 && $myin<=$fintime4)
{
    $deducation=0.75;
}
else if($myin>$fintime4&& $myin<=$fintime5)
{
   $deducation=1;  
}
else if($myin>$fintime5)
{
    $deducation=1;
}
else 
{
   $deducation=0;  
}


$deducationo=0;


if($myout>=$fouttime2&& $myout<$fouttime1)
{
    $deducationo=0.25;
}
else if($myout>=$fouttime3&& $myout<$fouttime2)
{
    $deducationo=0.50;
}

else if($myout>=$fouttime4&& $myout<$fouttime3)
{
    $deducationo=0.75;
}

else if($myout>=$fouttime5&& $myout<$fouttime4)
{
    $deducationo=1;
}

else if($myout>=$fouttime5&& $myout<$fouttime4)
{
    $deducationo=1;
}
else if($myout<$fouttime5)
{
    $deducationo=1;
}
else 
{
  $deducationo=0;  
}
 $totaldeduction=$deducation+$deducationo;

}
else
{
  $totaldeduction=1;  
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
}
?>