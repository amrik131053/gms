<?php
require('fpdf/fpdf.php');
$servername1 = "localhost";
$username1 = "bhagi";
$password1 = "@Sarbjot@98157";
$dbname1 = "lims";




$code=$_POST['code'];

$conn = new mysqli($servername1, $username1, $password1, $dbname1);   

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
 	 $LocationID=$_POST['iDNo_assing'];
 $building="SELECT * FROM stock_summary AS ss INNER JOIN master_article AS ma ON ss.ArticleCode=ma.ArticleCode  where ss.LocationID='$LocationID'";
 	 //$building="  SELECT * FROM  stock_summary where LocationID='$LocationID'";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {

        $_REQUEST['data']=$building_row['IDNo'];
         $ArticleName[]=$building_row['ArticleName'];
          $ArticleShortName[]=$building_row['ArticleShortName'];

        	$id[]=$building_row['IDNo'];

        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        $fname[]=$filename;
    //display generated file
   // echo '<img src="'.$PNG_WEB_DIR.basename($filename).'">'; 
    // echo "<span>".$_REQUEST['data']."</span>"; 
        $d++;
   }
 } elseif ($code==2)
  {

 $From=$_POST['From'];
  $To=$_POST['To'];
  $building="SELECT * FROM stock_summary AS ss INNER JOIN master_article AS ma ON ss.ArticleCode=ma.ArticleCode  WHERE ss.IDNo BETWEEN $From AND $To;";
  //$building="  SELECT * FROM  stock_summary WHERE IDNo BETWEEN $From AND $To;";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
        $_REQUEST['data']=$building_row['IDNo'];
        	$id[]=$building_row['IDNo'];
             $ArticleName[]=$building_row['ArticleName'];
              $ArticleShortName[]=$building_row['ArticleShortName'];
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        $fname[]=$filename;
  
        $d++;
   }
}
   elseif ($code==3)
    {
 $ArticleCode=$_POST['ArticleCode'];
 $building="SELECT * FROM stock_summary AS ss INNER JOIN master_article AS ma ON ss.ArticleCode=ma.ArticleCode  WHERE ss.ArticleCode=$ArticleCode";

  //$building="  SELECT * FROM  stock_summary WHERE ArticleCode=$ArticleCode";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
        $_REQUEST['data']=$building_row['IDNo'];
        	$id[]=$building_row['IDNo'];
             $ArticleName[]=$building_row['ArticleName'];
              $ArticleShortName[]=$building_row['ArticleShortName'];
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize,2);    
        $fname[]=$filename;
        $d++;
  						   }
 }
 else
 {
 	
 }



class PDF extends FPDF
{

}
$pdf = new PDF();

$x=10;
$y=6;


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
 $pdf->Write(10,'/ '.$ArticleShortName[$j],0);
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

$pdf->Output();
?>
