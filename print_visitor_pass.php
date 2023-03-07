<?php
ini_set('max_execution_time', 0); 
include 'connection/connection.php';
require('fpdf/fpdf.php');
$FromPassNumber=$_POST['FromPassNumber'];
$ToPassNumber=$_POST['ToPassNumber'];
include "phpqrcode/qrlib.php";
                                    $PNG_TEMP_DIR = 'phpqrcode/temp/';
                                    if (!file_exists($PNG_TEMP_DIR))
                                        mkdir($PNG_TEMP_DIR);

                                    $filename = $PNG_TEMP_DIR . 'test.png';
$Aid=array();
$name=array();
//$uni_name[]="";
$refNo=array();
$fname=array();
$designation=array();

$a=0;
       
  $qry="SELECT distinct id,reference_no FROM gate_entry_qr where id BETWEEN $FromPassNumber AND $ToPassNumber ";
    $run=mysqli_query($conn,$qry);
    while($data1=mysqli_fetch_array($run))
    {   $refNo='';
         $refNo=$data1['reference_no'];
         $Aid[]=$data1['id'];
         
  

                                        $url='http://gurukashiuniversity.co.in/lms/qrdata.php?ref='.$refNo;
                                    $filename = $PNG_TEMP_DIR . 'test' . md5($url) . '.png';
                                    QRcode::png($url, $filename);
   $a++;                                 $fname[]=$filename;
}
         
      
class PDF extends FPDF
{

}
$pdf = new PDF();
$pdf->AddPage("");

                               $x=2; 
                               $y=10;
       for ($i=0; $i<$a;$i++)
        {

$pdf->SetTextColor(0,0,0,0);
$pdf->Image('gatepass.jpg',$x,$y,68,108);   
   
$pdf->SetFont('Arial','B',7);
$pdf->SetXY($x+26,$y+88);
$pdf->SetTextColor(255,255,255,255);
$pdf->MultiCell(40, 3,ucfirst('Sardulgarh Road,Talwandi Sabo'),0 , 'C');  
$pdf->SetXY($x+26,$y+91);
$pdf->MultiCell(40, 3,ucfirst('Bathinda, Punjab, India(151302)'),0 , 'C');
$pdf->SetXY($x+26,$y+94);
$pdf->MultiCell(40, 3,ucfirst('Phone:+91 99142-83400'),0 , 'C');

$pdf->SetXY($x+26,$y+97);
$pdf->MultiCell(40, 3,'gurukashiuniversity.in',0 , 'C'); 
$pdf->SetTextColor(255,255,255,255);
$pdf->SetXY($x+12.5,$y+38.5);
$pdf->SetFont('Arial','B',50);
   if($Aid[$i]<10){
   $pdf->MultiCell(45, 10, '0'.$Aid[$i], 0, 'C');
   } else
   {
      $pdf->MultiCell(45, 10, $Aid[$i], 0, 'C');
   }
$pdf->Image($fname[$i],$x+2,$y+85,21.5,21.5); // QR Image

$pdf->Image('idcard.png',$x+7.8,$y+61,50,13);

$pdf->SetXY($x,$y+108);
$testy=$pdf->GetY(); 
$testx=$pdf->GetX()+69;
$pdf->SetTextColor(0,0,0,0);
 $x=$x+69;
  if ($x>141) 
  {
      $y=130;
      $x=2;
  }
  if ($testy>230 && $testx>207) 
  {   
    if ($i!=$a-1) {
        $pdf->AddPage();
        $x=2;
        $y=10;
    }
        
  }

}


$pdf->Output();
?>