<?php
require('fpdf/fpdf.php');
$servername1 = "localhost";
$username1 = "root";
$password1 = "";
$dbname1 = "gku_ms";


$conn = new mysqli($servername1, $username1, $password1, $dbname1);   
//include "header.php";
    //set it to writable location, a place for temp generated PNG files

    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "phpqrcode/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
     $errorCorrectionLevel = 'L';
    // if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
    //     $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
   $d=0;
   $id[]='';
   $fname[]='';



 $building="  SELECT * FROM  stock_summary";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {

        $_REQUEST['data']=$building_row['IDNo'];
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
class PDF extends FPDF
{
// Page header
// function Header()
// {
	// Logo
	// $this->Image('temp\test3af09f630670db10fcef8b119fe2cefd.png',10,6,30);
	
// }

}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$countline=$d/4;
$x=10;
$y=6;

for($j=1;$j<=$d;$j++)
{
$pdf->Image($fname[$j],$x,$y,30);
// $pdf->SetXY($x+12,$y+12);
// $pdf->Cell(0,$j+40,$id[$j],0,$j+40);
$y=$y+35;
}

$pdf->Output();
?>
