<?php
require_once('fpdf/fpdf.php');
require_once('fpdf/fpdi.php');
   date_default_timezone_set("Asia/Kolkata");  
   include 'connection/connection_web.php';                            
$refNo=array();
$fname=array();
$designation=array();

$a=0;
  
$aa=0;
$get_official="SELECT * FROM online_payment where  status='success' AND purpose='Conference Educon' ";
    $official_run=mysqli_query($conn_online,$get_official);
    while($data_offical=mysqli_fetch_array($official_run))
    { 
       $s_name[]=$data_offical['name']; 
       $s_id=$data_offical['name']; 
       $s_designation[]=$data_offical['father_name'];
       $s_image[]=$data_offical['father_name'];  
   
       $aa++;
    }        

class PDF extends FPDF
{

}
$pdf = new PDF();

if($aa>0)
{
  $pdf->AddPage('L');
}
                               $x=198; 
                               $y=5;
       for ($i=0; $i<$aa;$i++)
        {
            
$pdf->SetTextColor(255,0,0,0);
$pdf->Image('IDCardEducon.jpg',$x,$y,95,140);   
$pdf->SetFont('times','B',16);
$pdf->SetXY($x+1,$y+68);
$pdf->SetTextColor(0,0,0);
$ls=strlen($s_name[$i]);
if ($ls<15) {
  $pdf->MultiCell(95, 6, strtoupper($s_name[$i]),0 , 'C');  // name 
}
elseif($ls<25)
{
    $pdf->SetFont('times','B',16);
$pdf->MultiCell(95, 6, ucfirst($s_name[$i]),0 , 'C');  // name 
}else
{
    $pdf->SetFont('times','B',16);
$pdf->MultiCell(95, 6, ucfirst($s_name[$i]),0 , 'C');  // name 
}
$pdf->SetTextColor(34,50,96);
$pdf->SetXY($x+1,$y+83);
$pdf->SetTextColor(187,50,65);
$pdf->SetFont('times','B',18);
if($s_designation[$i]=='Student and Research Scholars')
{
$Desi='Research Scholars';
}
elseif($s_designation[$i]=='Participants')
{
    $Desi='Participants';
}
else
{
    $Desi='Organizer';
}

$pdf->MultiCell(95, 5,$Desi,0, 'C');
$pdf->SetXY($x+1,$y+88);
$pdf->SetFont('times','B',13);
 $pdf->SetXY($x,$y+135.5);
 $pdf->SetFont('times','B',9);
 $pdf->SetTextColor(255,255,255);
 $testy=$pdf->GetY(); 
 $testx=$pdf->GetX()+68;
  $pdf->MultiCell(94, 5, $i+1,0 , 'R');
   $pdf->SetTextColor(0,0,0,0);
 $x=$x-98;
  if ($x>141) 
  {
      $y=130;
      $x=10;
  }
  if ($testy>130 && $testx<73) 
  {   
    if ($i!=$aa-1) {
        $pdf->AddPage('L');
        $x=198;
        $y=10;
    }
        
  }

}






$pdf->Output();
?>