<?php 
$holidaycount=0;
$print_shift='';
$ShiftID='';
   $shiftIDrecord="SELECT  
    ShiftID,
    CASE 
        WHEN StartDate < '$start' THEN '$start'
        ELSE StartDate 
    END AS Leave_Start_Date,   
     CASE 
        WHEN EndDate > '$start' THEN '$start'
        ELSE EndDate 
    END AS Leave_End_Date       
         FROM MasterSHiftRoaster 
           WHERE StartDate <= '$start' 
               AND EndDate >= '$start' 
                     AND IDNO = '$IDNo'";

$stmtr = sqlsrv_query($conntest,$shiftIDrecord);  
            if($row_staff_sr = sqlsrv_fetch_array($stmtr, SQLSRV_FETCH_ASSOC) )
            {
                     $ShiftID=$row_staff_sr['ShiftID'];
            }  


if($ShiftID!='')
{

}
else
{
$sql_staff_s="select ShiftID from Staff where IDNo='$IDNo' order by IDNo DESC";
$stmt = sqlsrv_query($conntest,$sql_staff_s);  
            if($row_staff_s = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
          
             $ShiftID=$row_staff_s['ShiftID'];
            }  

}



 $sql_holiday="Select * from  Holidays where HolidayDate  Between '$start 00:00:00.000' ANd  '$start 23:59:00.000' AND ShiftID='$ShiftID'";
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
  $sql_att23="SELECT  ApplyLeaveGKU.Id as LeaveID,ApplyLeaveGKU.FilePath,Name,ShortName,LeaveDuration,LeaveDurationsTime,LeaveSchoduleTime,LeaveTypes.Id as leavetypes,
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
$LeaveSchoduleTime='';
$printhalf='';
$printleaveonduty='';
$printShortleave='';
$leavecount=0;
$leavecount_n=0;
$stmt = sqlsrv_query($conntest,$sql_att23);  
            while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            $LeaveID=$row['LeaveID'];
            $FilePathLeave=$row['FilePath'];
            $leavetypeid=$row['leavetypes'];
             $leaveName=$row['Name'];
            $leaveShortName=$row['ShortName'];
            $leaveduration=$row['LeaveDuration'];
            $leavedurationtime=$row['LeaveDurationsTime'];
             $LeaveSchoduleTime=$row['LeaveSchoduleTime'];
          if($LeaveSchoduleTime==1)
          {
            $printhalf='(FH)';
          } 
          elseif ($LeaveSchoduleTime==2)

            {
$printhalf='(SH)';
            }            
           

 if($leaveName!='')
 {
  if($leavedurationtime>0)
{ 

    $printleaveonduty=$leaveName;

  $printleave=$printleave.' '.$leavedurationtime.' '.$leaveName.$printhalf;
 
  $printShortleave=$printShortleave .' '.$leavedurationtime.' '.$leaveShortName .$printhalf;
} 
 else
 {
    
 $printleave=$leaveName;
 $printShortleave=$leaveShortName;

 }

 if($leavetypeid==1 ||$leavetypeid==2||$leavetypeid==3||$leavetypeid==8 ||$leavetypeid==12||$leavetypeid==7||$leavetypeid==6||$leavetypeid==26||$leavetypeid==13|| $leavetypeid==15)
 {

  if($leavedurationtime>0)
{ 
  $leavecount= $leavecount+$leavedurationtime;
 
} 
 else
 {
    
 $leavecount=1;

 }

 }

 else
 {

  if($leavedurationtime>0 && $leavedurationtime<1)
{ 
  $leavecount_n=$leavecount-$leavedurationtime;
 
} 
 else
 {
    
 //$leavecount_n=0-1;

 }



 }


}
}

$mydaycount=1;
$totaldeduction=1;
$shifttimechnage=0;


 $sql_att234="SELECT * ,
            CASE 
               WHEN StartDate < '$start' THEN '$start' 
               ELSE StartDate 
            END AS Shift_Start_Date,
            CASE 
               WHEN EndDate > '$start' THEN '$start'
               ELSE EndDate 
            END AS Shift_End_Date       
FROM MadamSingleEmployeeException where StartDate <= '$start' AND
            EndDate >= '$start' ANd  IDNo='$IDNo' "; 


$stmt4 = sqlsrv_query($conntest,$sql_att234);  
            if($row = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC) )
           {
           $shifttimechnage=1; 
     $fintime1=$row['Intime'];
        $fintime2=$row['Intime1'];
        $fintime3=$row['Intime2'];
        $fintime4=$row['Intime3'];
        $fintime5=$row['Outtime'];


        $fouttime1=$row['Outtime'];
        $fouttime2=$row['Outtime1'];
        $fouttime3=$row['Outtime2'];
        $fouttime4=$row['Outtime3'];
        $fouttime5=$row['Intime'];


      
            }

else
  
  {

       $sql_att234="SELECT * ,
            CASE 
               WHEN StartDate < '$start' THEN '$start'
               ELSE StartDate 
            END AS Shift_Start_Date,
            CASE 
               WHEN EndDate > '$start' THEN '$start'
               ELSE EndDate 
            END AS Shift_End_Date       
FROM        
 MadamShiftTime where StartDate <= '$start' AND
            EndDate >= '$start' ANd Exception='1' ANd ShiftId='$ShiftID'"; 


$stmt4 = sqlsrv_query($conntest,$sql_att234);  
            if($row3 = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC) )
           {

       $fintime1=$row3['Intime'];
        $fintime2=$row3['Intime1'];
        $fintime3=$row3['Intime2'];
        $fintime4=$row3['Intime3'];
        $fintime5=$row3['Outtime'];


        $fouttime1=$row3['Outtime'];
        $fouttime2=$row3['Outtime1'];
        $fouttime3=$row3['Outtime2'];
        $fouttime4=$row3['Outtime3'];
        $fouttime5=$row3['Intime'];

 $shifttimechnage=1; 
        
            }

else
{
  $sql_att235="SELECT * FROM   MadamShiftTime Where ShiftId='$ShiftID' ANd Exception='0' "; 


$stmt4 = sqlsrv_query($conntest,$sql_att235);  
            while($row5 = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC) )
           {
        $fintime1=$row5['Intime'];
        $fintime2=$row5['Intime1'];
        $fintime3=$row5['Intime2'];
        $fintime4=$row5['Intime3'];
        $fintime5=$row5['Outtime'];


        $fouttime1=$row5['Outtime'];
        $fouttime2=$row5['Outtime1'];
        $fouttime3=$row5['Outtime2'];
        $fouttime4=$row5['Outtime3'];
        $fouttime5=$row5['Intime'];

            }


}




}

if($leavecount!=1)
{
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
else if($myin>$fintime4 && $myin<=$fintime5)
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

else if($myout>=$fouttime5 && $myout<$fouttime4)
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

}
else
{
$leavecount=1;

}


if($holidaycount>0)
{
   $totaldeduction=0; 
}

 $countdayn=$mydaycount+$holidaycount+$leavecount-$totaldeduction;

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

if($leavecount_n!=0 && $countday==1)
{

  $countday=$countday+$leavecount_n;
}

if($countday<1 && $countday>0)
{
    //$pdf->SetTextColor(255,0,0);
    $print_shift= $fintime1."  to  ".$fintime5;


}
   if($shifttimechnage>0)
{
    $print_shift= $fintime1."  to  ".$fintime5;
} 
?>