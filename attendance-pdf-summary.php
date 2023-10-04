<?php 
require('fpdf/fpdf.php');

ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";

$curmnth =$_POST['month'];
$curyear = $_POST['year'];
 $emp_code=$_POST['EmployeeId'];




class CustomPDF extends FPDF {
    function Footer() {
        // Set the position of the footer at 15mm from the bottom
        $this->SetY(-15);
        // Set font and color for the footer text
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
    }
      
}

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





    
$srno=1;
$exportdaily='';

$paiddays=0;
$h=0;

$pdf = new CustomPDF();
$pdf->AliasNbPages();

$sql_staff="select * from Staff where IDNo='$emp_code'";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
           $Department=$row_staff['Department'];
                      $CollegeName=$row_staff['CollegeName'];
             $IDNo=$row_staff['IDNo'];
                  $College=$row_staff['CollegeName'];

 // Enable page numbering



$pdf->AddPage('P', 'A4');
$pdf->SetFont('Arial', 'B', 10);
$pdf->MultiCell(190, 8,"Employee ID :    ".$IDNo, 1, 'l');

$pdf->MultiCell(190, 8, "Name :    ".$Name, 1, 'l');
$pdf->MultiCell(190, 8, "Department :    ".$Department, 1, 'l');
$pdf->MultiCell(190, 8, "College :    ".$CollegeName, 1, 'l');
$pdf->SetXY(10,42);
$pdf->Cell(30,8,"Date", 1,'C');
$pdf->SetXY(40,42);
$pdf->Cell(30, 8,"In Time",1,'C');
$pdf->SetXY(70,42);
$pdf->Cell(30, 8,"Out Time",1,'C');
$pdf->SetXY(100,42);
$pdf->Cell(70, 8,"Remarks",1,'C');
 $pdf->SetXY(170,42);
$pdf->Cell(30, 8,"Count",1,'C');

$srno++;

$y=$pdf->GETY();

for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

   $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo' ";

$pdf->SetXY(10,$y);

$pdf->Cell(30,7,$start,1,'C');


     
      $stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            $intime=$row_staff_att['mytime'];
            $outtime=$row_staff_att['mytime1'];

         


 if($intime!="")
{ 
$myin= $intime->format('H:i');
} 
else
{ 
 $myin="";
}
$pdf->SetXY(40,$y);

$pdf->Cell(30,7,$myin,1,'C');

 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   
   

$pdf->SetXY(70,$y);

$pdf->Cell(30,7,$myout,1,'C');

$holidaycount=0;
$row_count_join=0;
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

//   if($leavedurationtime>0)
// { 
//   $leavecount= -$leavedurationtime;
 
// } 
//  else
//  {
    
//  $leavecount=-1;


//  }


 }


}

if($HolidayName!='' && $printleave!='')
{

$pdf->SetXY(100,$y);

$pdf->Cell(70,7,$HolidayName.$printleave,1,'C');


 
    
}
else if($HolidayName!='' && $printleave=='')
{
$pdf->SetXY(100,$y);

$pdf->Cell(70,7,$HolidayName,1,'C');
}
else if($HolidayName=='' && $printleave!='')

{
 $pdf->SetXY(100,$y);

$pdf->Cell(70,7,$printleave,1,'C');
}
else if ($HolidayName=='' && $printleave=='' && $intime=='' && $outtime=='' )
{


  $joiningdateab="select * from  Staff where DateOfJoining<='$start 00:00:00' AND IDNo='$IDNo'";


 $list_result_joinab = sqlsrv_query($conntest,$joiningdateab, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

                $row_count_joinab = sqlsrv_num_rows($list_result_joinab);  

if($row_count_joinab>0)
            {
           $pdf->SetXY(100,$y);

$pdf->Cell(70,7,"Absent",1,'C');
         
             }
             else
             {
               $pdf->SetXY(100,$y);

$pdf->Cell(70,7,"Late joining ",1,'C');
             }




}

else
{ $pdf->SetXY(100,$y);
    $pdf->Cell(70,7," ",1,'C');
}




$mydaycount=1;
$totaldeduction=1;



if($intime!='' && $outtime!='' && ($outtime>$intime) )
{


$deducation=0;


if($myin>'09:02' && $myin<'11:01')
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

  $pdf->SetXY(170,$y);
$pdf->Cell(30,7,$countday,1,'C');

$paiddays=$paiddays+$countday;
$y=$y+7;


}




}
if($paiddays<>$h)
{  
 $pdf->SetXY(100,$y);

    $pdf->Cell(100,10,"Total Paid Days  :  $paiddays Out of $myenddate  ",1,'C');

    
}
else
{
    $pdf->Cell(100,10,"Total Paid Days  :  0 ",1,'C');
}

}
$pdf->Output();