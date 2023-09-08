<?php
   session_start();
   ini_set('max_execution_time', '0');
   include 'connection/connection.php';

$Name=$_POST['Name'];
$Designation=$_POST['Designation'];
require('fpdf/rotate.php');

class PDF extends PDF_Rotate
{
function RotatedText($x,$y,$txt,$angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}
function RotatedImage($file,$x,$y,$w,$h,$angle)
{
    //Image rotated around its upper-left corner
    $this->Rotate($angle,$x,$y);
    $this->Image($file,$x,$y,$w,$h);
    $this->Rotate(0);
}
}
$pdf=new PDF();
   $left=5;
   $left1=5;
   $down1=58.8;
   $down=9;
   $count=60;
   $down11=5;
   $output = '';  
     require_once('fpdf/fpdf.php');
     require_once('fpdf/fpdi.php');
   $pdf->AddPage('L');
   $pdf->Rotate(180);

  $pdf-> Image('dist\img\new-logo.png',$left-208,$down-41,50,10);
  $pdf-> Image('dist\img\naac-logo.png',$left-23,$down-41.5,30,12);
   $pdf->Rotate(0);

   $pdf->SetXY($left+30,$down+0);
   $pdf->SetFont('Arial','B',8);
   $pdf->SetTextColor(166,37,53);
   $pdf->SetXY($left,$down+0.2);
   $pdf->MultiCell(221,46,'','1','');
   $pdf->SetXY($left,$down+0.4);
   $pdf->MultiCell(221,46,'','1','');
   $pdf->SetXY($left,$down+0.6);
   $pdf->MultiCell(221,46,'','1','');
   $pdf->SetXY($left,$down+0);
   $pdf->MultiCell(221,46,'','1',''); 
   $pdf->SetXY($left,$down+0.2);
   $pdf->MultiCell(220.8,46,'','1','');
   $pdf->SetXY($left,$down+0.4);
   $pdf->MultiCell(220.7,46,'','1','');
   $pdf->SetXY($left,$down+0.6);
   $pdf->MultiCell(220.6,46,'','1','');
   $pdf->SetXY($left,$down+0);
   $pdf->MultiCell(220.5,46,'','1','');
   $pdf->SetXY($left+0.2,$down+0.2);
   $pdf->MultiCell(220.8,46,'','1','');
   $pdf->SetXY($left+0.3,$down+0.4);
   $pdf->MultiCell(220.7,46,'','1','');
   $pdf->SetXY($left+0.4,$down+0.6);
   $pdf->MultiCell(220.6,46,'','1','');

$pdf-> Image('dist\img\new-logo.png',$left1+2,$down1+3,45,10);
 $pdf-> Image('dist\img\naac-logo.png',$left+188,$down+52.5,30,12);
   $pdf->SetXY($left1+301,$down+0);
   $pdf->SetFont('Arial','B',8);
   $pdf->SetTextColor(166,37,53);
   $pdf->SetXY($left1,$down1+0.2);
   $pdf->MultiCell(221,46,'','1','');
   $pdf->SetXY($left1,$down1+0.4);
   $pdf->MultiCell(221,46,'','1','');
   $pdf->SetXY($left1,$down1+0.6);
   $pdf->MultiCell(221,46,'','1','');
   $pdf->SetXY($left1,$down1+0);
   $pdf->MultiCell(221,46,'','1',''); 
   $pdf->SetXY($left1,$down1+0.2);
   $pdf->MultiCell(220.8,46,'','1','');
   $pdf->SetXY($left1,$down1+0.4);
   $pdf->MultiCell(220.7,46,'','1','');
   $pdf->SetXY($left1,$down1+0.6);
   $pdf->MultiCell(220.6,46,'','1','');
   $pdf->SetXY($left1,$down1+0);
   $pdf->MultiCell(220.5,46,'','1','');
   $pdf->SetXY($left1+0.2,$down+0.2);
   $pdf->MultiCell(220.8,46,'','1','');
   $pdf->SetXY($left1+0.3,$down+0.4);
   $pdf->MultiCell(220.7,46,'','1','');
   $pdf->SetXY($left1+0.4,$down+0.6);
   $pdf->MultiCell(220.6,46,'','1','');
   $pdf->SetXY($left+0.5,$down+0);
   $pdf->MultiCell(220.5,46,'','1','');




   $pdf->SetXY($left+221,$down+13);
   $pdf->SetFont('Arial','B',20);
   $pdf->SetTextColor(166,37,53);
   $pdf->Rotate(180);
   // $pdf->RotatedText(159,12,'Web Developer',180);
   $pdf->MultiCell(221,12,$Designation,'0','C');

 $pdf->SetFont('Arial','B',20);
    

    $pdf->SetXY('175','10');
      $pdf->SetTextColor(34,47,96);

    //$pdf->MultiCell(150,0,'Coordinator (Accreditation)','0','L');

   $pdf->Rotate(0);


 

// $pdf->RotatedText(159,12,'Hello!',45);
   $pdf->SetXY($left+221,$down+37);
   $pdf->SetFont('Arial','B',42);
   $pdf->SetTextColor(34,47,96);
   $pdf->Rotate(180);
   $pdf->MultiCell(221,25,$Name,'0','C');
   $pdf->Rotate(0);
   $pdf->SetXY('5',$down1+9);
   $pdf->SetFont('Arial','B',42);
   $pdf->SetTextColor(34,47,96);
   $pdf->MultiCell(221,25,$Name,'0','C');
   $pdf->SetFont('Arial','B',20);
   $pdf->SetXY(210,'85');
   //$pdf->MultiCell(250,0,'Coordinator (Accreditation)','0','L');
   $pdf->SetXY(5,$down1+34);
   $pdf->SetFont('Arial','B',20);
   // $pdf->SetXY(20,20);
   $pdf->SetTextColor(166,37,53);
   $pdf->MultiCell(221,12,$Designation,'0','C');
   $pdf->Output();

?>