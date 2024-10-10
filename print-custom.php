<?php
require('fpdf/fpdf.php');
include "connection/connection.php";
// $servername1 = "localhost";
// $username1 = "bhagi";
// $password1 = "@Sarbjot@98157";
// $dbname1 = "lims";

$code=$_POST['code'];

// $conn = new mysqli($servername1, $username1, $password1, $dbname1);   

    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "phpqrcode/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    $filename = $PNG_TEMP_DIR.'test.png';
    
  
     $errorCorrectionLevel = 'L';
    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
   $d=0;
   $id[]='';
   $fname[]='';
    $ArticleName[]="";
    $ArticleShortName[]="";
 if ($code==1) {

$size=$_POST['size'];
     $LocationID=$_POST['iDNo_assing'];
 $building="SELECT * FROM stock_summary AS ss INNER JOIN master_article AS ma ON ss.ArticleCode=ma.ArticleCode  where ss.LocationID='$LocationID'";
    
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {

        $_REQUEST['data']=$building_row['IDNo'];
        $ArticleShortName[]=$building_row['ArticleShortName'];

         $ArticleName[]=$building_row['ArticleName'];

            $id[]=$building_row['IDNo'];

        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        $fname[]=$filename;
   
        $d++;
   }
 } elseif ($code==2)
  {

$size=$_POST['size'];
 $From=$_POST['From'];
  $To=$_POST['To'];
  $building="SELECT * FROM stock_summary AS ss INNER JOIN master_article AS ma ON ss.ArticleCode=ma.ArticleCode  WHERE ss.IDNo BETWEEN $From AND $To;";
  //$building="  SELECT * FROM  stock_summary WHERE IDNo BETWEEN $From AND $To;";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
        $_REQUEST['data']=$building_row['IDNo'];
            $id[]=$building_row['IDNo'];
            $ArticleShortName[]=$building_row['ArticleShortName'];
             $ArticleName[]=$building_row['ArticleName'];
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        $fname[]=$filename;
        $d++;
   }
}
   elseif ($code==3)
    {

$size=$_POST['size'];
 $ArticleCode=$_POST['ArticleCode'];
 $building="SELECT * FROM stock_summary AS ss INNER JOIN master_article AS ma ON ss.ArticleCode=ma.ArticleCode  WHERE ss.ArticleCode=$ArticleCode AND ss.status='0' ";

  //$building="  SELECT * FROM  stock_summary WHERE ArticleCode=$ArticleCode";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
        $_REQUEST['data']=$building_row['IDNo'];
            $id[]=$building_row['IDNo'];
            $ArticleShortName[]=$building_row['ArticleShortName'];
             $ArticleName[]=$building_row['ArticleName'];
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        $fname[]=$filename;
        $d++;
                           }
 }
 elseif ($code==4)
  {

$size=$_POST['size'];
 $articlecodes = explode(",",$_POST['articlesArray']);
//  print_r($articlecodes);
foreach ($articlecodes as $key => $value) {
   
   $building="SELECT * FROM stock_summary AS ss INNER JOIN master_article AS ma ON ss.ArticleCode=ma.ArticleCode  WHERE ss.IDNo='$value'";
  //$building="  SELECT * FROM  stock_summary WHERE IDNo BETWEEN $From AND $To;";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
        $_REQUEST['data']=$building_row['IDNo'];
            $id[]=$building_row['IDNo'];
            $ArticleShortName[]=$building_row['ArticleShortName'];
             $ArticleName[]=$building_row['ArticleName'];
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        $fname[]=$filename;
        $d++;
   }
}
}
 else
 {
    
 }

// print_r($ArticleShortName);


 class PDF extends FPDF
{

}
if ($size=='Large') {
$pdf = new PDF();
$x=10;
$y=15;
$pdf->AddPage();
$pdf->SetFont('Times','',8);
for($j=1;$j<=$d;$j++)
{
    for($i=1;$i<=1;$i++)
{
$pdf->Image($fname[$j],$x,$y,30);
$pdf->SetXY($x+1,$y+25);
 $pdf->Write(10,$id[$j],0);
 $pdf->SetXY($x+12,$y+25);
 foreach ($ArticleShortName as $key => $value) {
 }
    if (!empty($value))
    {
       $pdf->Write(10,'/'.$ArticleShortName[$j],0);
    }
    else
    {
       $pdf->Write(10,'/'.$ArticleName[$j],0);
    }





$x=$x+35;
if($x>180)
{
    $x=10;
    $y=$y+35;
}
if ($y>250)
{
    $pdf->AddPage();
        $x=10;
        $y=6;
}
}
}
}
else
{

  $pdf = new PDF();
$x=10;
$y=6;
$pdf->AddPage();
$pdf->SetFont('Times','',8);
for($j=1;$j<=$d;$j++)
{
    for($i=1;$i<=1;$i++)
{
$pdf->Image($fname[$j],$x,$y,20);
$pdf->SetXY($x+0,$y+16);
 $pdf->Write(10,$id[$j],0);
 $pdf->SetXY($x+10,$y+16);
 foreach ($ArticleShortName as $key => $value) {
 }
    if (!empty($value))
    {
       $pdf->Write(10,'/'.$ArticleShortName[$j],0);
    }
    else
    {
       $pdf->Write(10,'/'.$ArticleName[$j],0);
    }

$x=$x+25;
if($x>180)
{
    $x=10;
    $y=$y+25;
}
if ($y>235)
{
    $pdf->AddPage();
        $x=10;
        $y=6;
}
}
}
}

$pdf->Output();
?>
