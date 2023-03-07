<?php
require('fpdf/fpdf.php');
$servername1 = "localhost";
$username1 = "bhagi";
$password1 = "@Sarbjot@98157";
$dbname1 = "lims";


$IDNo=$_POST['IDNo'];
$LocationID=$_POST['LocationID'];
$Article=$_POST['ArticleName'];
  $Name="";
                                $FloorName="";
                                  $RoomNo="";
                                  $RoomType="";
                                  $RoomName="";  
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
   

 $building="  SELECT * FROM  stock_summary Where IDNo='$IDNo'";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {

        $_REQUEST['data']=$building_row['IDNo'];
        	$id=$building_row['IDNo'];

        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    //display generated file
   // echo '<img src="'.$PNG_WEB_DIR.basename($filename).'">'; 
    // echo "<span>".$_REQUEST['data']."</span>"; 
        $d++;
   }

      
            $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID where lm.ID='$LocationID' ";
             $location_run=mysqli_query($conn,$location);
                           while ($location_row=mysqli_fetch_array($location_run)) 
                           {
                            $Name=$location_row['Name'];
                            $FloorName=$location_row['FloorName'];
                            $RoomNo=$location_row['RoomNo'];
                            $RoomType=$location_row['RoomType'];
                            $RoomName=$location_row['RoomName'];
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
 $pdf->SetFont('Times','B',12);
  $pdf->SetXY(10,5);
$pdf->Cell(0,0,'Article Name',0,0);
$pdf->SetFont('Times','',12);
  $pdf->SetXY(10,10);
$pdf->Cell(0,0,$Article,0,0);

$pdf->SetFont('Times','B',12);
   $pdf->SetXY(50,5);
$pdf->Cell(0,0,'Block',0,0);
$pdf->SetFont('Times','',12);
  $pdf->SetXY(50,10);
$pdf->Cell(0,0,$Name,0,0);

$pdf->SetFont('Times','B',12);
$pdf->SetXY(80,5);
$pdf->Cell(0,0,'Floor',0,0);
$pdf->SetFont('Times','',12);
 $pdf->SetXY(80,10);
$pdf->Cell(0,0,$FloorName, 0,0);

$pdf->SetFont('Times','B',12);
$pdf->SetXY(110,5);
$pdf->Cell(0,0,'Room No',0,0);
$pdf->SetFont('Times','',12);
 $pdf->SetXY(110,10);
$pdf->Cell(0,0,$RoomNo,0,0);

$pdf->SetFont('Times','B',12);
$pdf->SetXY(140,5);
$pdf->Cell(0,0,'Room Type',0,0);
$pdf->SetFont('Times','',12);
 $pdf->SetXY(140,10);
$pdf->Cell(0,0,$RoomType,0,0);

$pdf->SetFont('Times','B',12);
$pdf->SetXY(175,5);
$pdf->Cell(0,0,'Room Name',0,0);
$pdf->SetFont('Times','',12);
 $pdf->SetXY(175,10);

$pdf->Cell(0,0,$RoomName,0,0);
if ($Article=='Computer') 
{
 
   $pdf->Image($filename,10,20,30);
     $pdf->Image($filename,40,20,30);
       $pdf->Image($filename,70,20,30);
         $pdf->Image($filename,100,21,20);
  
  
}
  else if($Article=='Laptop' ||  $Article=='Mobile' || $Article=='Scanner')
  {
  
         $pdf->Image($filename,10,20,20);

  }

  else if ($Article=='Speeker') {

    $pdf->Image($filename,10,20,20);
   $pdf->Image($filename,40,20,20);
         $pdf->Image($filename,70,20,20);
  //  
  }
  else
  {

  }
$pdf->Output();
?>
