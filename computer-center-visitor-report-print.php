<?php
require_once ('fpdf/fpdf.php');
include 'connection/connection.php';
session_start();
if (!(ISSET($_SESSION['usr']))) {
    header('Location:index.php');
} else {
    $a = $_SESSION['usr'];
    $sql12 = "SELECT * FROM Staff WHERE IDNo ='$a' ";
    $stmt12 = sqlsrv_query($conntest, $sql12);
    while ($row12 = sqlsrv_fetch_array($stmt12, SQLSRV_FETCH_ASSOC)) {
        $sname = $row12['Name'];
        $mobno = $row12['MobileNo'];
    }
}
// $date = $_POST['datesearch'];
$j = 0;

$startDate=$_POST['startDate'];
$endDate=$_POST['endDate'];
$sql123 = "SELECT * FROM computer_lab_entry  where entry_time between '$startDate 00:00:00' and '$endDate 11:59:59'  Order by entry_time asc";
$stmt123 = mysqli_query($conn, $sql123);
while ($row123 = mysqli_fetch_array($stmt123)) {
    $IDNo[] = $row123['UserID'];
    $entryTime[] = date('d-m-Y H:i',strtotime($row123['entry_time']));
    $currentDateTime = date('m/d/Y H:i:s');
    $exitTime[] = date('d-m-Y H:i',strtotime($row123['exit_time']));
    $j++;
}
class PDF extends FPDF 
{
    function subWrite($h, $txt, $link = '', $subFontSize = 12, $subOffset = 0) {
        // resize font
        $subFontSizeold = $this->FontSizePt;
        $this->SetFontSize($subFontSize);
        // reposition y
        $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
        $subX = $this->x;
        $subY = $this->y;
        $this->SetXY($subX, $subY - $subOffset);
        //Output text
        $this->Write($h, $txt, $link);
        // restore y position
        $subX = $this->x;
        $subY = $this->y;
        $this->SetXY($subX, $subY + $subOffset);
        // restore font size
        $this->SetFontSize($subFontSizeold);
    }
    function Header() {
        $IDNo[] = $GLOBALS['IDNo'];
        $exitTime[] = $GLOBALS['exitTime'];
        $entryTime[] = $GLOBALS['entryTime'];
        /* Move to the right */
        $this->Image('https://gurukashiuniversity.in/gku/images/logo-blue.png', 10, 10, 38, 10);
        // $this->SetFont('Arial','B',12);
        // $this->SetXY(85,16.5);
        // $this->SetFont('Arial','',7.5);
        // $this->Write(0,'Talwandi Sabo Bathinda');
        $this->SetXY(9, 8);
        $this->SetFont('times', 'b', 10);
        $this->Cell(195, 30, '', 1, 0, 'C', 0);
        $this->SetXY(84, 12);
        $this->Write(0, 'GURU KASHI UNIVERSITY');
        $this->SetXY(89, 18);
        $this->Write(0, ' COMPUTER CENTER');
        $this->SetXY(91, 25);
        $this->Write(0, 'VISITOR REPORT');
        // $this->SetXY(170,22);
        // $this->Write(0,$exitTime);
        // $this->subWrite(0,$exitTime,'',6,4);
        $this->Write(0, '');
        $this->SetXY(9, 32);
        $this->Cell(65, 6, 'ID No.', 1, 0, 'C', 0);
        $this->Cell(65, 6, 'Entry Time', 1, 0, 'C', 0);
        $this->Cell(65, 6, 'Exit Time', 1, 0, 'C', 0);
        // $this->Cell(70,6,'In Time',1,0,'C',0);
        
    }
    // Page footer
    function Footer() {
        //  $ctime = date("d-m-Y");
        //     // Position at 1.5 cm from bottom
        $this->SetXY(180, -10);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}
$pdf = new PDF();
// $pdf->SetTitle('Guru Kashi University');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 10);
$y=38;
// for ($i = 0, $y = 38, $s = 1;$i < $j;$i++, $s++) 
  for ($i=0; $i < $j; $i++) 
  { 
    if ($y>266) 
    {
      $pdf->AddPage();
      $y=38;
      
    }
      
    $pdf->SetXY(9, $y );
    $pdf->Cell(65, 6, $IDNo[$i], 1, 0, 'C', 0);
    $pdf->Cell(65, 6, $entryTime[$i], 1, 0, 'C', 0);
    $pdf->Cell(65, 6, $exitTime[$i], 1, 0, 'C', 0);
    // $pdf->Cell(70,6,$exitTime[$i],1,0,'C',0);
    $y = $y + 6;
}


$pdf->Output();
?>