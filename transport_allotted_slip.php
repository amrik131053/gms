<?php
session_start();
ini_set('max_execution_time', '0');
 include 'connection/connection.php';

$output = '';  
$ctime = date("d-m-Y");
$nowtime = strtotime($ctime);
 $token_no= $_POST['token_no'];

if(!(ISSET($_SESSION['usr']))) {
header('Location:index.php'); 
}
else{    $a=$_SESSION['usr'];}
require_once('fpdf/fpdf.php');

class PDF extends FPDF
{

function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0)
{
  // resize font
  $subFontSizeold = $this->FontSizePt;
  $this->SetFontSize($subFontSize);
  
  // reposition y
  $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
  $subX        = $this->x;
  $subY        = $this->y;
  $this->SetXY($subX, $subY - $subOffset);

  //Output text
  $this->Write($h, $txt, $link);

  // restore y position
  $subX        = $this->x;
  $subY        = $this->y;
  $this->SetXY($subX,  $subY + $subOffset);

  // restore font size
  $this->SetFontSize($subFontSizeold);
}
 


  function Header()
{ 

$course  = "";
$batch = '';
$sem  = '';
$type  = '';
$grp  = '';
$examination  = "";

    /* Move to the right */

     //$this-> Image('logo.png',10,5,50,15);

   //  $this->SetXY(12,16);
// $this->SetFont('Times','',6);
// $this->Write(0,'Talwandi Sabo Bathinda(151302)');

       $this->SetFont('Times','B',16);
     //  $this->SetX(88,80);
      //$this->Cell(150,30,'ICT Enabled',0,1);

        $this->SetFont('Times','B',12);



      

}
   

// Page footer
function Footer()
{ 
 $ctime = date("d-m-Y");
 
    // Position at 1.5 cm from bottom
    $this->SetXY(200,-10);
    // Arial italic 8
    $this->SetFont('Times','I',6);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    $this->SetXY(50,-10);
$this->SetFont('Times','',8);

}
}
$pdf = new PDF();

  $get_driver_details="SELECT *,vehicle_allotment.name as e_name,vehicle.name as v_name FROM  vehicle_allotment inner join vehicle_book_details  ON vehicle_allotment.token_no=vehicle_book_details.TokenNo  inner join vehicle ON vehicle.id=vehicle_allotment.vehicle_alloted_id   where vehicle_allotment.token_no='$token_no'"; 
                  $get_driver_details_run=mysqli_query($conn,$get_driver_details);
                  if($get_driver_details_run_row=mysqli_fetch_array($get_driver_details_run))
                  {  
                $driver_id=$get_driver_details_run_row['driver_id'];
                 $get_emp_driver="SELECT * FROM Staff Where IDNo='$driver_id' and JobStatus='1'";
              $get_emp_driver_run=sqlsrv_query($conntest,$get_emp_driver);
              while($row=sqlsrv_fetch_array($get_emp_driver_run,SQLSRV_FETCH_ASSOC))
              {

 
$pdf->SetTitle('Guru Kashi University');
$pdf->AliasNbPages();
$pdf->AddPage('P');

$pdf->SetXY(3.5,30);
$pdf->SetFont('Times','B',13);
// $pdf->Write(0,$array[$i]['room_type']);
//$pdf->cell(200,5,$array[$i]['room_type'],0,1,'C');


   $pdf->SetXY(50,10);
$pdf->SetFont('Times','B',12);
$pdf->Write(0,'GATE PASS (TO BE SUBMITTED ON THE MAIN GATE)');
   $pdf->SetXY(80,15);
$pdf->SetFont('Times','B',12);
$pdf->Write(0,'Allotted Vehicle Details');

$pdf->SetXY(13,30);
$pdf->SetFont('Times','B',11);
$pdf->Write(0,'Type of Vehicle                                _________________________________________');

$pdf->SetXY(80,29);
$pdf->SetFont('Times','',11);
$pdf->Write(0,$get_driver_details_run_row['v_name']);



   $pdf->SetXY(13,37);
$pdf->SetFont('Times','B',11);
$pdf->Write(0,'Vehicle Regd Number                     _________________________________________');

$pdf->SetXY(80,36);
$pdf->SetFont('Times','',11);
$pdf->Write(0,$get_driver_details_run_row['vehicle_number']);

$pdf->SetXY(13,43);
$pdf->SetFont('Times','B',11); 
$pdf->Write(0,'Driver Name                                    _________________________________________' );
$pdf->SetXY(80,42);
$pdf->SetFont('Times','',11);
$pdf->Write(0,$row['Name'].' ('.$row['MobileNo'].')');

$pdf->SetXY(13,50);
$pdf->SetFont('Times','B',11); 
$pdf->Write(0,'From Date                                        _________________________________________' );
$pdf->SetXY(80,49);
$pdf->SetFont('Times','',11);
$startDate=$get_driver_details_run_row['journey_start_date'];
$start=date("d-m-Y h:i:A", strtotime($startDate)); 
$pdf->Write(0,$start);

$pdf->SetXY(13,57);
$pdf->SetFont('Times','B',11); 
$pdf->Write(0,'To Date                                             _________________________________________' );
$pdf->SetXY(80,56);
$pdf->SetFont('Times','',11);
$endDate=$get_driver_details_run_row['journey_end_date'];
$end=date("d-m-Y h:i:A", strtotime($endDate)); 
$pdf->Write(0,$end);



$pdf->SetXY(13,66);
$pdf->SetFont('Times','B',11); 
$pdf->Write(0,'Issued To' );
$pdf->SetXY(80,66);
$pdf->SetFont('Times','',11);
$pdf->Write(0,$get_driver_details_run_row['e_name'].'('.$get_driver_details_run_row['emp_id'].')');




  $pdf->SetXY(160,80);
$pdf->SetFont('Times','B',11);
$pdf->Write(0,'Transport Officer');


$pdf->SetTextColor(0, 0, 0);

//$pdf-> Image($array[$i]['image'],16,60,180,150);


// $pdf->SetXY(13,94);
// $pdf->SetFont('Times','B',12);
// $pdf->Write(0,'Issued To');
// $pdf->cell(200,2,'Issued To',0,1,'C');

// if ($array[$i]['remarks']!='')
//  {
// $pdf->SetXY(10,225);
// $pdf->SetFont('Times','B',12);
// $pdf->Write(0,'ICT Facilities Available :');
// $pdf->SetXY(60, 223);
// $pdf->MultiCell(250,4, $array[$i]['remarks']);
// }
// else
// {
  
// }

}
}
$pdf->Output();
  ?>

















