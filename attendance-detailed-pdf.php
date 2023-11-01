<?php 
ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);
require('fpdf/fpdf.php');

ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";

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
include 'attendance-employee-get-export.php';

include 'attendance-date-function.php';
$srno=1;
$pdf = new CustomPDF();
$pdf->AliasNbPages();


for ($i=0;$i<$no_of_emp;$i++)
{
$paiddays=0;
$h=0;
$pdf->AddPage('P', 'A4');

// $sql_staff="select * from Staff where IDNo='170976'";
$sql_staff="select Name,Department,CollegeName,IDNo from Staff where IDNo='$emp_codes[$i]'";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
           $Department=$row_staff['Department'];
                      $CollegeName=$row_staff['CollegeName'];
             $IDNo=$row_staff['IDNo'];
            }   

 // Enable page numbering




$pdf->SetFont('Arial', 'B', 8);


$pdf->MultiCell(190, 6,"Employee ID :    ".$IDNo, 1, 'l');

$pdf->MultiCell(190, 6, "Name :    ".$Name, 1, 'l');
$pdf->MultiCell(190, 6, "Department :    ".$Department, 1, 'l');
$pdf->MultiCell(190, 6, "College :    ".$CollegeName, 1, 'l');
$pdf->SetXY(10,42);
$pdf->Cell(30,6,"Date", 1,'C');
$pdf->SetXY(40,42);
$pdf->Cell(30, 6,"In Time",1,'C');
$pdf->SetXY(70,42);
$pdf->Cell(30, 6,"Out Time",1,'C');
$pdf->SetXY(100,42);
$pdf->Cell(70, 6,"Remarks",1,'C');
 $pdf->SetXY(170,42);
$pdf->Cell(30, 6,"Count",1,'C');

$srno++;

$y=50;

for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

   $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo' ";

 $pdf->SetXY(10,$y);

$pdf->Cell(30,6,$start,1,'C');


     
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
$pdf->SetXY(40,$y);

$pdf->Cell(30,6,$myin,1,'C');

 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   
   

$pdf->SetXY(70,$y);

$pdf->Cell(30,6,$myout,1,'C');



$holidaycount=0;

$row_count_join=0;



include 'attendance-calculator.php';

if($HolidayName!='' && $printleave!='')
{

$pdf->SetXY(100,$y);

$pdf->Cell(70,6,$HolidayName.$printleave,1,'C');


 
    
}
else if($HolidayName!='' && $printleave=='')
{
$pdf->SetXY(100,$y);

$pdf->Cell(70,6,$HolidayName,1,'C');
}
else if($HolidayName=='' && $printleave!='')
{
 $pdf->SetXY(100,$y);

$pdf->Cell(70,6,$printleave,1,'C');
}
else if ($HolidayName=='' && $printleave=='' && $intime=='' && $outtime=='' )
{
  $joiningdateab="select * from  Staff where DateOfJoining<='$start 00:00:00' AND IDNo='$IDNo'";
 $list_result_joinab = sqlsrv_query($conntest,$joiningdateab, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

      $row_count_joinab = sqlsrv_num_rows($list_result_joinab);  

if($row_count_joinab>0)
            {
           $pdf->SetXY(100,$y);

//$pdf->Cell(70,7,"Absent",1,'C');
         
             }
             else
             {
               $pdf->SetXY(100,$y);

//$pdf->Cell(70,7,"Late joining ",1,'C');
             }

}

else
{ $pdf->SetXY(100,$y);
    $pdf->Cell(70,6," ",1,'C');
}
 


  $pdf->SetXY(170,$y);
if($countday<1)
{
    $pdf->SetTextColor(255,0,0);
}  
$pdf->Cell(30,6,$countday,1,'C');
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

?>