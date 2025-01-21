<?php 
session_start();
$EmployeeID=$_SESSION['usr'];
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);
require('fpdf/fpdf.php');

ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";

class CustomPDF extends FPDF {
    function Footer() {
        $this->SetY(-17);
        $this->Cell(10, 10, 'Checked By.................... ', 0, 0, 'L');
        $this->SetY(-17);
        $this->Cell(250, 10, 'Verified By.................. ', 0, 0, 'C');
        $this->SetY(-17);
        $this->Cell(230, 10, 'HR Manager.................. ', 0, 0, 'R');
        // Set the position of the footer at 15mm from the bottom

        // Set font and color for the footer text
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
           $this->SetY(-12);
        $this->Cell(0, 10, 'CL-Casual,CPL-Compansatory,OD-On Duty,BL-Bus Late,SC-Special Casual,DL-Duty,AC-Academic,SH-Second Half,FH-First Half,WV-Winter Vacation ', 0, 0, 'L');
        $this->SetY(-12);
        $this->Cell(0, 10,'Printed on ' .$GLOBALS['timeStampS']. ' by '.$GLOBALS['EmployeeID'].'      Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'R');
        $this->SetY(-12);
       // $this->Cell(0, 10, 'Printed on ' .$GLOBALS['timeStampS']. ' by '.$GLOBALS['EmployeeID'], 0, 0, 'R');
    }
      
}
include 'attendance-employee-get-export.php';

include 'attendance-date-function.php';
$srno=1;
$X=0;
$y=23;
$Height=4.5;
$pdf = new CustomPDF();
$pdf->AliasNbPages();
// $pdf->AddPage('L', 'A4');
// no_of_emp

for ($i=0;$i<$no_of_emp;$i++)
{
$paiddays=0;
$h=0;

if($i%3==0 )
{
    $pdf->AddPage('L', 'A4');
    $X=0;
    $pdf->SetXY($X+65,$y-14);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(150,0,0);
    $pdf->MultiCell(180,8," Attendance Summary Report ".$showmonth.' '.$curyear, 0, 'C');
    $pdf->SetXY($X+65,$y-8);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(180,8,$collegeName, 0, 'C');

}


$pdf-> Image('dist\img\new-logo.jpg',4,4,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',260,4,30,10);


// $sql_staff="select * from Staff where IDNo='170976'";
$sql_staff="select Name,Department,CollegeName,IDNo from Staff where IDNo='$emp_codes[$i]' order by IDNo DESC";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
           $Department=$row_staff['Department'];
                      $CollegeName=$row_staff['CollegeName'];
             $IDNo=$row_staff['IDNo'];
            }   
 // Enable page numbering
$pdf->SetFont('Arial', 'B', 7);



$pdf->SetXY($X+10,$y);
$pdf->MultiCell(33, $Height,"Employee ID : ".$IDNo, 1, 'l');
$pdf->SetXY($X+43,$y);
$pdf->MultiCell(57, $Height," Name : ".$Name, 1, 'l');
$pdf->SetXY($X+10,$y+4.5);
// $pdf->MultiCell(100, 5, "Name :    ".$Name, 1, 'l');
$pdf->MultiCell(90, $Height, "Department :    ".$Department, 1, 'l');
$pdf->SetXY($X+10,$y+8.9);
$pdf->MultiCell(90, $Height, "College :    ".$CollegeName, 1, 'l');
$pdf->SetXY($X+10,$y+13.3);
$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(20,$Height,"Date",1,1,'C');
$pdf->SetXY($X+30,$y+13.3);

$pdf->MultiCell(15, $Height,"In Time",1,1,'C');
$pdf->SetXY($X+45,$y+13.3);

$pdf->MultiCell(15, $Height,"Out Time",1,1,'C');
$pdf->SetXY($X+60,$y+13.3);

$pdf->MultiCell(30, $Height,"Remarks",1,1,'C');
 $pdf->SetXY($X+90,$y+13.3);
$pdf->MultiCell(10, $Height,"Count",1,1,'C');
$pdf->SetTextColor(0,0,0);
$srno++;

$y=$y+13;
for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

   $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo'  ";

 $pdf->SetXY($X+10,$y+4.6);

//$print_start= $start->format('d-m-Y');

$pdf->Cell(20,$Height,$start,1,'C');


     
      $stmt = sqlsrv_query($conntest,$sql_att);  
            if($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
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
$pdf->SetXY($X+30,$y+4.6);

$pdf->MultiCell(15,$Height,$myin,1,'C');

 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   
   

$pdf->SetXY($X+45,$y+4.6);

$pdf->MultiCell(15,$Height,$myout,1,'C');
$holidaycount=0;
$row_count_join=0;

include 'attendance-calculator.php';

$pdf->SetFont('Arial', 'B', 6.5);

if($HolidayName!='' && $printleave!='')
{
$pdf->SetXY($X+60,$y+4.6);

$pdf->Cell(30,$Height,$HolidayName."(".$printShortleave.")",1,'C'); 
}
else if($HolidayName!='' && $printleave=='')
{
$pdf->SetXY($X+60,$y+4.6);

$pdf->Cell(30,$Height,$HolidayName,1,'C');
}
else if($HolidayName=='' && $printleave!='')
{
 $pdf->SetXY($X+60,$y+4.6);

$pdf->Cell(30,$Height,$printShortleave,1,'C');
}
else if ($HolidayName=='' && $printleave=='' && $intime=='' && $outtime=='' )
{
  $joiningdateab="select * from  Staff where DateOfJoining<='$start 00:00:00' AND IDNo='$IDNo' order by IDNo ASC";
 $list_result_joinab = sqlsrv_query($conntest,$joiningdateab, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

      $row_count_joinab = sqlsrv_num_rows($list_result_joinab);  

if($row_count_joinab>0)
            {
           $pdf->SetXY($X+60,$y+4.6);
           $pdf->SetTextColor(255,0,0);
$pdf->Cell(30,$Height,"Absent",1,'C');
         
             }
             else
             {
               $pdf->SetXY($X+60,$y+4.6);

$pdf->Cell(30,$Height,"Late joining ",1,'C');
             }

}

else
{ $pdf->SetXY($X+60,$y+4.6);
    $pdf->Cell(30,$Height,$print_shift,1,'C');
}
 
$pdf->SetFont('Arial', 'B', 7);

  $pdf->SetXY($X+90,$y+4.6);
 
// $y=$pdf->GetY();
$pdf->MultiCell(10,$Height,$countday,1,'C');
$pdf->SetTextColor(0,0,0);
$paiddays=$paiddays+$countday;



}

$y=$y+4.6;
}




if($paiddays<>$h)
{  
    $y=$pdf->GetY();

 $pdf->SetXY($X+10,$y);

    $pdf->Multicell(90,6,"Total Paid Days  :  $paiddays Out of $myenddate  ",1,'R');

    
}
else
{
    $y=$pdf->GetY();
    $pdf->SetXY($X+10,$y);
    $pdf->Multicell(90,6,"Total Paid Days  :  0 ",1,'R');
}


$X=$X+95;
$y=23;
}
$pdf->Output();

?>