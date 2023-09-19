<?php
session_start();
ini_set('max_execution_time', '0');
include 'connection/connection.php';
require_once('fpdf/fpdf.php');
require_once('fpdf/fpdi.php');
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
function Footer()
{ 
$this->SetXY(0,62);
$this->SetFont('Arial','B',9);
$pagenumber = '{nb}';
if($this->PageNo() == 2){
$this->MultiCell(53,4,'GURU KASHI UNIVERSITY
Sardulgarh Road,Talwandi Sabo
Bathinda, Punjab, India(151302)
Phone: +91 99142-83400
www.gku.ac.in','','C');
}
}
}

// $pdf = new FPDF('P');  // 
$pdf = new PDF('P','mm',array(53.98,85.60));
$pdf -> AliasNbPages();
$pdf->AddPage('');
$code=$_GET['code'];
$empid=$_GET['id'];
if ($code==1) 
{
   
    $pdf-> Image('dist\img\idcard.png',5,2,45,10);
    $pdf-> Image('dist\img\bgbacksmartcard.jpg',0,80,53.98,6);   
    $pdf-> Image('dist\img\signn.jpg',17.5,72,20,6);   
    $sql="SELECT * FROM Staff where   IDNo='$empid'";
    $result = sqlsrv_query($conntest,$sql);
    while($row=sqlsrv_fetch_array($result))
    {
        $pdf->SetFont('Arial','',9);
        $pdf->SetTextColor(255,255,255);
        $pdf->SetXY(1,15.5);
        $pdf-> Image('dist\img\idcardbg.png',0,14,53.98,8);
        $pdf->MultiCell(52,3,$row['CollegeName'],'','C');
        



    $img= $row['Snap'];
    $pic = 'data://text/plain;base64,' . base64_encode($img);
    $info = getimagesize($pic);
    $extension = explode('/', mime_content_type($pic))[1];
    $pdf-> Image($pic,18,23.5,20,22,$extension);
    $pdf->SetXY(1,47);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetTextColor(0,0,0);
    $pdf->Write(3,'Name     :','0','L');
    $pdf->SetXY(1.1,52);
    $pdf->Write(3,'Emp.No :','0','L');
    $pdf->SetXY(1,57);
    $pdf->Write(3,'Desig.    :','0','L');
    $pdf->SetXY(0.9,62);
    $pdf->Write(3,'Dept.      :','0','L');
    
    $pdf->SetXY(17,47);
    $pdf->MultiCell(52,3,$row['Name'],'0','L');
    $pdf->SetXY(17,52);
    $pdf->MultiCell(52,3,$row['IDNo'],'0','L');
    $pdf->SetXY(17,57);
    $pdf->MultiCell(52,3,$row['Designation'],'0','L');
    $pdf->SetXY(17,62);
    $pdf->MultiCell(52,3,$row['Department'],'0','L');
    
    
    $pdf->SetTextColor(0,0,0);
    $pdf->AddPage('P');
    $pdf->SetXY(0,3);
    $pdf->SetFont('Arial','B',10);
    $pdf->line(0,10,1000,10);
    $pdf->line(0,10.1,1000,10.1);
    $pdf->line(0,10.2,1000,10.2);
    $pdf->line(0,60,1000,60);
    $pdf->line(0,60.1,1000,60.1);
    $pdf->line(0,60.2,1000,60.2);
    $pdf->MultiCell(53.98,3,'This is a property of GKU','0','C');
    $pdf->SetXY(1,12);
    $pdf->SetFont('Arial','B',9);
    $pdf->Write(3,'F. Name   :','0','L');
    $pdf->SetXY(0.9,18);
    $pdf->Write(3,'Mobile No:','0','L');
    $pdf->SetXY(1,24);
    $pdf->Write(3,'D.O.B       :','0','L');

    
    $pdf->SetXY(18.5,12);
    $pdf->MultiCell(52,3,$row['FatherName'],'0','L');
    $pdf->SetXY(18.5,18);
    $pdf->MultiCell(52,3,$row['MobileNo'],'0','L');
    $pdf->SetXY(18.5,24);
    $DATE=$row['DateOfBirth']->format('d-m-Y');
    $pdf->MultiCell(52,3,$DATE,'0','L');
    $pdf->SetXY(0,32);
    $pdf->MultiCell(53,3,'Address:','0','C');
    $pdf->SetXY(0,37);
    $pdf->MultiCell(53,4,$row['PermanentAddress'],'0','C');
    
   }


}


$pdf->Output();
?>