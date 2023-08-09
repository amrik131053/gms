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
   $down=5;
   $count=60;
   $down11=5;
   $output = '';  
     require_once('fpdf/fpdf.php');
     require_once('fpdf/fpdi.php');
   $pdf->AddPage('L');
   $pdf->Rotate(180);

  $pdf-> Image('dist\img\logo.png',$left-210,$down-6,57,14);
   $pdf->Rotate(0);

   $pdf->SetXY($left+30,$down+0);
   $pdf->SetFont('Arial','B',8);
   $pdf->SetTextColor(166,37,53);
   $pdf->SetXY($left,$down+0.2);
   $pdf->MultiCell(221,49,'','1','');
   $pdf->SetXY($left,$down+0.4);
   $pdf->MultiCell(221,49,'','1','');
   $pdf->SetXY($left,$down+0.6);
   $pdf->MultiCell(221,49,'','1','');
   $pdf->SetXY($left,$down+0);
   $pdf->MultiCell(221,49,'','1',''); 
   $pdf->SetXY($left,$down+0.2);
   $pdf->MultiCell(220.8,49,'','1','');
   $pdf->SetXY($left,$down+0.4);
   $pdf->MultiCell(220.7,49,'','1','');
   $pdf->SetXY($left,$down+0.6);
   $pdf->MultiCell(220.6,49,'','1','');
   $pdf->SetXY($left,$down+0);
   $pdf->MultiCell(220.5,49,'','1','');
   $pdf->SetXY($left+0.2,$down+0.2);
   $pdf->MultiCell(220.8,49,'','1','');
   $pdf->SetXY($left+0.3,$down+0.4);
   $pdf->MultiCell(220.7,49,'','1','');
   $pdf->SetXY($left+0.4,$down+0.6);
   $pdf->MultiCell(220.6,49,'','1','');

$pdf-> Image('dist\img\logo.png',$left1,$down1+33,57,14);
   $pdf->SetXY($left1+301,$down+0);
   $pdf->SetFont('Arial','B',8);
   $pdf->SetTextColor(166,37,53);
   $pdf->SetXY($left1,$down1+0.2);
   $pdf->MultiCell(221,49,'','1','');
   $pdf->SetXY($left1,$down1+0.4);
   $pdf->MultiCell(221,49,'','1','');
   $pdf->SetXY($left1,$down1+0.6);
   $pdf->MultiCell(221,49,'','1','');
   $pdf->SetXY($left1,$down1+0);
   $pdf->MultiCell(221,49,'','1',''); 
   $pdf->SetXY($left1,$down1+0.2);
   $pdf->MultiCell(220.8,49,'','1','');
   $pdf->SetXY($left1,$down1+0.4);
   $pdf->MultiCell(220.7,49,'','1','');
   $pdf->SetXY($left1,$down1+0.6);
   $pdf->MultiCell(220.6,49,'','1','');
   $pdf->SetXY($left1,$down1+0);
   $pdf->MultiCell(220.5,49,'','1','');
   $pdf->SetXY($left1+0.2,$down+0.2);
   $pdf->MultiCell(220.8,49,'','1','');
   $pdf->SetXY($left1+0.3,$down+0.4);
   $pdf->MultiCell(220.7,49,'','1','');
   $pdf->SetXY($left1+0.4,$down+0.6);
   $pdf->MultiCell(220.6,49,'','1','');
   $pdf->SetXY($left+0.5,$down+0);
   $pdf->MultiCell(220.5,49,'','1','');




   $pdf->SetXY($left+160,$down+14);
   $pdf->SetFont('Arial','B',20);
   $pdf->SetTextColor(166,37,53);
   $pdf->Rotate(180);
   // $pdf->RotatedText(159,12,'Web Developer',180);
   $pdf->MultiCell(155,12,$Designation,'0','R');

 $pdf->SetFont('Arial','B',20);
    

    $pdf->SetXY('175','10');
      $pdf->SetTextColor(34,47,96);

    //$pdf->MultiCell(150,0,'Coordinator (Accreditation)','0','L');

   $pdf->Rotate(0);


 

// $pdf->RotatedText(159,12,'Hello!',45);
   $pdf->SetXY($left+300,$down+49);
   $pdf->SetFont('Arial','B',45);
   $pdf->SetTextColor(34,47,96);
    // $pdf->StartTransform();          
   // $pdf->Rotate(180);


   $pdf->Rotate(180);


   $pdf->MultiCell(250,25,$Name,'0','R');
   $pdf->Rotate(0);
   $pdf->SetXY('20',$down1);
   $pdf->SetFont('Arial','B',45);
   $pdf->SetTextColor(34,47,96);
   $pdf->MultiCell(250,25,$Name,'0','L');
   $pdf->SetFont('Arial','B',20);
   $pdf->SetXY('50','85');
   //$pdf->MultiCell(250,0,'Coordinator (Accreditation)','0','L');
   $pdf->SetXY(60,$down1+36);
   $pdf->SetFont('Arial','B',20);
   // $pdf->SetXY(20,20);
   $pdf->SetTextColor(166,37,53);
   $pdf->MultiCell(159,12,$Designation,'0','R');
   $pdf->Output();

?>