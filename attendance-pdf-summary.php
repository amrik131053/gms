<?php 
require('fpdf/fpdf.php');

ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";

if(isset($_POST['month']))
{
$curmnth =$_POST['month'];
$curyear = $_POST['year'];
$emp_code=$_POST['EmployeeId'];
}
else
{
$curmnth =$_GET['month'];
$curyear = $_GET['year'];
$emp_code=$_GET['EmployeeId'];
}
class CustomPDF extends FPDF {
    function Footer() {
        // Set the position of the footer at 15mm from the bottom
        $this->SetY(-15);
        // Set font and color for the footer text
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
        $this->SetY(-12);
        $this->Cell(0, 10, 'Printed on ' .$GLOBALS['timeStampS'], 0, 0, 'R');
    }   
}
include 'attendance-date-function.php'; 
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
           $Name=trim($row_staff['Name']);
           $Department=$row_staff['Department'];
                      $CollegeName=$row_staff['CollegeName'];
             $IDNo=$row_staff['IDNo'];
                  $College=$row_staff['CollegeName'];

 // Enable page numbering



$pdf->AddPage('P', 'A4');
$pdf->SetXY(10,18);
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(150,0,0);
$pdf->MultiCell(190,8," Attendance Summary Report ".$showmonth.' '.$curyear, 0, 'C');
$pdf->SetTextColor(0,0,0);
$pdf-> Image('dist\img\new-logo.jpg',10,4,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',170,4,30,10);
$pdf->SetXY(10,25);
$pdf->SetFont('Arial', 'B', 9);
$pdf->MultiCell(190, 6,"Employee ID :    ".$IDNo, 1, 'l');
$pdf->MultiCell(190, 6, "Name :    ".$Name, 1, 'l');
$pdf->MultiCell(190, 6, "Department :    ".$Department, 1, 'l');
$pdf->MultiCell(190, 6, "College :    ".$CollegeName, 1, 'l');
$pdf->SetXY(10,49);
$pdf->SetTextColor(255,255,255);
$pdf->multicell(30,6,"Date",1,'C','1');
$pdf->SetXY(40,49);
$pdf->multicell(20, 6,"In Time",1,'C','1');
$pdf->SetXY(60,49);
$pdf->multicell(20, 6,"Out Time",1,'C','1');
$pdf->SetXY(80,49);

$pdf->multicell(75, 6,"Remarks",1,'C','1');

 $pdf->SetXY(155,49);
$pdf->multicell(15, 6,"Count",1,'C','1');
$pdf->SetXY(170,49);
$pdf->multicell(30, 6,"Shift Time",1,'C','1');
$pdf->SetTextColor(0,0,0);
$srno++;
$y=55;

for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

   $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo' ";

$pdf->SetXY(10,$y);

$pdf->Cell(30,6,$start,1,'C');


     
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

$pdf->MultiCell(20,6,$myin,1,'C');

 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   
   

$pdf->SetXY(60,$y);

$pdf->MultiCell(20,6,$myout,1,'C');



$holidaycount=0;

$row_count_join=0;



include 'attendance-calculator.php';

   if($shifttimechnage>0)
{
    $shiftchnageremarks=' Time Exception';
} 
else
{
    $shiftchnageremarks='';
}



if($HolidayName!='' && $printleave!='')
{

$pdf->SetXY(80,$y);

$pdf->Cell(75,6,$HolidayName." (".$printleave.")".$shiftchnageremarks,1,'C');


 
    
}
else if($HolidayName!='' && $printleave=='')
{
$pdf->SetXY(80,$y);

$pdf->Cell(75,6,$HolidayName,1,'C');
}
else if($HolidayName=='' && $printleave!='')

{
 $pdf->SetXY(80,$y);

$pdf->Cell(75,6,$printleave,1,'C');
}
else if ($HolidayName=='' && $printleave=='' && $intime=='' && $outtime=='' )
{


  $joiningdateab="select * from  Staff where DateOfJoining<='$start 00:00:00' AND IDNo='$IDNo'";


 $list_result_joinab = sqlsrv_query($conntest,$joiningdateab, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

                $row_count_joinab = sqlsrv_num_rows($list_result_joinab);  

if($row_count_joinab>0)
            {
           $pdf->SetXY(100,$y);
           $pdf->SetTextColor(255,0,0);
$pdf->Cell(75,6,"Absent",1,'C');
         
             }
             else
             {
               $pdf->SetXY(100,$y);
               $pdf->SetTextColor(255,0,0);
$pdf->Cell(75,6,"Late joining ",1,'C');
             }




}

else
{ $pdf->SetXY(80,$y);
    $pdf->Cell(75,6,$shiftchnageremarks,1,'C');
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

  $pdf->SetXY(154.98,$y);





if($countday<1)
{
    $pdf->SetTextColor(255,0,0);
} 



$pdf->MultiCell(15,6,$countday,1,'C');

 $pdf->SetXY(170,$y);

   if($shifttimechnage>0)
{
    $pdf->SetTextColor(255,0,0);
} 
$pdf->MultiCell(30,6,$fintime1." to ".$fintime5,1,'C');




$pdf->SetTextColor(0,0,0);





$paiddays=$paiddays+$countday;

$y=$y+6;


}




}
if($paiddays<>$h)
{  
 $pdf->SetXY(100,$y);

    $pdf->Cell(100,10,"Total Paid Days  :  $paiddays Out of $myenddate  ",1,'C');

    
}
else
{$pdf->SetXY(100,$y);
    $pdf->Cell(100,10,"Total Paid Days  :  0 ",1,'C');
}

}
$pdf->Output();