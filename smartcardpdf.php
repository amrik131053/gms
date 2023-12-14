<?php
require('fpdf/fpdf.php');
include "connection/connection.php";

$statusForIdCard = $_GET['status'];
$fromDateForIdCard = $_GET['from'];
$toDateFromIdCard = $_GET['to'];

class PDF extends FPDF
{
    function checkNewPage($rowHeight)
    {
        if ($this->GetY() + $rowHeight > $this->PageBreakTrigger) {
            $this->AddPage();
            $this->SetY(20); // Adjust the Y position as needed
        }
    }

    function Footer()
    {
        $ctime = date("d-m-Y");

        $this->SetXY(180, -10);
        $this->SetFont('Times', 'I', 12);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        $this->SetXY(10, -10);
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times', '', 8);

// Define table structure
$header = array('Sr No', 'Class RollNo', 'Name', 'Course', 'Print Date', 'Signature');
$cellWidth = 45;
$cellHeight = 10;

// $pdf->SetXY(90, 20);
// $pdf->SetFont('Times', 'b', 20);
// $pdf->Write(0, 'INDEX');


$pdf->SetFont('Times', 'b', 10);

// Draw table header
$pdf->SetXY(3, 32);
foreach ($header as $col) {
  if($col=='Sr No')
  {
    $pdf->Cell(10, $cellHeight, $col, 1, 0, 'C', 0);
}else if($col=='Class RollNo')
{
  $pdf->Cell(30, $cellHeight, $col, 1, 0, 'C', 0);
}
else if($col=='Print Date')
{
  $pdf->Cell(30, $cellHeight, $col, 1, 0, 'C', 0);
}
else
{
    $pdf->Cell($cellWidth, $cellHeight, $col, 1, 0, 'C', 0);
}
}

$count = 0;
$Srno = 1;
$rowY = 42; 
$rowHeight = $cellHeight; // Use the same height as cell
$pdf-> Image('dist\img\new-logo.jpg',4,2,75,13);
$pdf-> Image('dist\img\naac-logo.jpg',160,2,40,10);
$pdf->SetXY(3, 20);
$pdf->SetFont('Times', 'b', 15);
$pdf->Multicell(205,10, 'Student Smart Card ',0,'C');
$pdf->SetFont('Times', 'b', 10);
if ($statusForIdCard != '' && $fromDateForIdCard != '' && $toDateFromIdCard != '') {
     $GetSmartCardDetails = "SELECT *,SmartCardDetails.Status as IDcardStatus ,SmartCardDetails.IDNo as StudentSmartCardID FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.status='$statusForIdCard' and PrintDate Between '$fromDateForIdCard 01:00:00.000' and '$toDateFromIdCard 23:59:00.000' and SmartCardDetails.RePrint is NULL order by Admissions.Course ASC  ";
} else {
     $GetSmartCardDetails = "SELECT *,SmartCardDetails.Status as IDcardStatus,SmartCardDetails.IDNo as StudentSmartCardID FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where  SmartCardDetails.status='$statusForIdCard' and SmartCardDetails.RePrint is NULL order by Admissions.Course ASC  ";
}
$GetSmartCardDetailsRun = sqlsrv_query($conntest, $GetSmartCardDetails);

while ($row = sqlsrv_fetch_array($GetSmartCardDetailsRun, SQLSRV_FETCH_ASSOC)) {
    $ClassRollNo = $row['ClassRollNo'];
    $StudentName = $row['StudentName'];
    $Course = $row['Course'];
      $getCourseDetails="SELECT * FROM  MasterCourseCodes WHERE CourseID='".$row['CourseID']."' and Session='".$row['Session']."' and Batch='".$row['Batch']."' ";
    $getCourseDetailsRun = sqlsrv_query($conntest,$getCourseDetails);
    if($rowgetCourseDetails=sqlsrv_fetch_array($getCourseDetailsRun))
    {
        $CourseShortName=$rowgetCourseDetails['CourseShortName'];
      
        $ValidUpTo=$rowgetCourseDetails['ValidUpto'];
        $ValidUpTo=$rowgetCourseDetails['ValidUpto']->format('d-m-Y');
    }
    if ($row['PrintDate'] != '') {
        $PrintDate = $row['PrintDate']->format('d-m-Y');
    } else {
        $PrintDate = "";
    }

    $pdf->SetXY(3, $rowY);
    $pdf->Cell(10, $cellHeight, $Srno, 1, 0, 'C', 0);
    $pdf->Cell(30, $cellHeight, $ClassRollNo, 1, 0, 'C', 0);
    $pdf->SetFont('Times', 'b', 8);
    $pdf->Cell($cellWidth, $cellHeight, $StudentName, 1, 0, 'C', 0);
    $pdf->SetFont('Times', 'b', 10);
    $pdf->Cell($cellWidth, $cellHeight, $CourseShortName, 1, 0, 'C', 0);
    $pdf->Cell(30, $cellHeight, $PrintDate, 1, 0, 'C', 0);
    $pdf->Cell($cellWidth, $cellHeight, '', 1, 0, 'C', 0);
    $rowY += $rowHeight;
    if($rowY>261)
    {
      $pdf->AddPage();
      $rowY=42;
      $pdf-> Image('dist\img\new-logo.jpg',4,2,75,13);
      $pdf-> Image('dist\img\naac-logo.jpg',160,2,40,10);
      $pdf->SetXY(3, 20);
      $pdf->SetFont('Times', 'b', 15);
      $pdf->Multicell(205,10, 'Student Smart Card ',0,'C');
      $pdf->SetFont('Times', 'b', 10);
      $pdf->SetXY(3, 32);
foreach ($header as $col) {
  if($col=='Sr No')
  {
    $pdf->Cell(10, $cellHeight, $col, 1, 0, 'C', 0);
}else if($col=='Class RollNo')
{
  $pdf->Cell(30, $cellHeight, $col, 1, 0, 'C', 0);
}
else if($col=='Print Date')
{
  $pdf->Cell(30, $cellHeight, $col, 1, 0, 'C', 0);
}
else
{
    $pdf->Cell($cellWidth, $cellHeight, $col, 1, 0, 'C', 0);
}
}
    }
    $count++;
    $Srno++;
}

$pdf->Output();
?>
