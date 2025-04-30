<?php
require('fpdf/fpdf.php');
include "connection/connection.php";

// $statusForIdCard = $_GET['status'];
// $fromDateForIdCard = $_GET['from'];
// $toDateFromIdCard = $_GET['to'];

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
$header = array('Sr No','Uni RollNo','Name','DMC SrNo', 'Grade Card No', 'Class RollNo', 'Signature');
$cellWidth = 60;
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
}
else if($col=='Class RollNo')
{
  $pdf->Cell(30, $cellHeight, $col, 1, 0, 'C', 0);
}
else if($col=='Uni RollNo')
{
  $pdf->Cell(30, $cellHeight, $col, 1, 0, 'C', 0);
}
else if($col=='Grade Card No')
{
  $pdf->Cell(25, $cellHeight, $col, 1, 0, 'C', 0);
}
else if($col=='DMC SrNo')
{
  $pdf->Cell(20, $cellHeight, $col, 1, 0, 'C', 0);
}
else if($col=='Print Date')
{
  $pdf->Cell(30, $cellHeight, $col, 1, 0, 'C', 0);
}
else if($col=='Signature')
{
  $pdf->Cell(25, $cellHeight, $col, 1, 0, 'C', 0);
}
else
{
    $pdf->Cell($cellWidth, $cellHeight, $col, 1, 0, 'C', 0);
}
}

$id=$_POST['batchID'];
$sql12 = "SELECT * FROM ResultPreparation as Rp inner join Admissions as Adm ON Adm.IDNo=Rp.IDNo WHERE Rp.BatchID='$id' and Rp.DMCSerialNoStatus='1'";
$GetSmartCardDetailsRun2 = sqlsrv_query($conntest, $sql12);

if ($row2 = sqlsrv_fetch_array($GetSmartCardDetailsRun2, SQLSRV_FETCH_ASSOC)) {
    $DMCprintedOn = $row2['DMCprintedOn']->format('d-m-Y');
    $Examination = $row2['Examination'];
    $Semester = $row2['Semester'];
    $getCourseDetails="SELECT * FROM  MasterCourseCodes WHERE CourseID='".$row2['CourseID']."' and Session='".$row2['Session']."' and Batch='".$row2['Batch']."' ";
    $getCourseDetailsRun = sqlsrv_query($conntest,$getCourseDetails);
    if($row2getCourseDetails=sqlsrv_fetch_array($getCourseDetailsRun))
    {
        $CourseShortName1=$row2getCourseDetails['CourseShortName'];
    
    }
}

$count = 0;
$Srno = 1;
$rowY = 42; 
$rowHeight = $cellHeight; // Use the same height as cell
$pdf-> Image('dist\img\new-logo.jpg',4,2,75,13);
$pdf-> Image('dist\img\naac-logo.jpg',160,2,40,10);
$pdf->SetXY(3, 10);
$pdf->SetFont('Times', 'b', 15);
$pdf->Multicell(205,10, 'DMC Receiving Sheet',0,'C');
$pdf->SetXY(53, 19);
$pdf->SetFont('Times', 'b', 10);
$pdf->Multicell(150,10, $CourseShortName1,0,'R');
$pdf->SetXY(153, 26);
$pdf->SetFont('Times', 'b', 10);
$pdf->Multicell(50,5, "Semester: ".$Semester,0,'R');
$pdf->SetXY(3, 20);
$pdf->SetFont('Times', 'b', 10);
$pdf->Multicell(50,5, "Print On: ".$DMCprintedOn,0,'L');
$pdf->SetXY(3, 25);
$pdf->SetFont('Times', 'b', 10);
$pdf->Multicell(50,5, "Examination: ".$Examination,0,'L');
$pdf->SetFont('Times', 'b', 10);
 $sql1 = "SELECT * FROM ResultPreparation as Rp inner join Admissions as Adm ON Adm.IDNo=Rp.IDNo WHERE Rp.BatchID='$id' and Rp.DMCSerialNoStatus='1'";
$GetSmartCardDetailsRun = sqlsrv_query($conntest, $sql1);

while ($row = sqlsrv_fetch_array($GetSmartCardDetailsRun, SQLSRV_FETCH_ASSOC)) {
    $ClassRollNo = $row['ClassRollNo'];
    $UniRollNo = $row['UniRollNo'];
    $StudentName = $row['StudentName'];
    $Course = $row['Course'];
    $DMCSerialNo = $row['DMCSerialNo'];
    $GradeCardSrNo = $row['GradeCardSrNo'];
    $DMCprintedOn = $row['DMCprintedOn']->format('d-m-Y');
    $getCourseDetails="SELECT * FROM  MasterCourseCodes WHERE CourseID='".$row['CourseID']."' and Session='".$row['Session']."' and Batch='".$row['Batch']."' ";
    $getCourseDetailsRun = sqlsrv_query($conntest,$getCourseDetails);
    if($rowgetCourseDetails=sqlsrv_fetch_array($getCourseDetailsRun))
    {
        $CourseShortName=$rowgetCourseDetails['CourseShortName'];
    
    }
    $pdf->SetXY(3, $rowY);
    $pdf->Cell(10, $cellHeight, $Srno, 1, 0, 'C', 0);
    $pdf->Cell(30, $cellHeight, $UniRollNo, 1, 0, 'C', 0);
    $pdf->SetFont('Times', 'b', 8);
    $pdf->Cell($cellWidth, $cellHeight, $StudentName, 1, 0, 'C', 0);
    $pdf->SetFont('Times', 'b', 10);
    $pdf->Cell(20, $cellHeight, $DMCSerialNo, 1, 0, 'C', 0);
    $pdf->Cell(25, $cellHeight, $GradeCardSrNo, 1, 0, 'C', 0);
    $pdf->Cell(30, $cellHeight, $ClassRollNo, 1, 0, 'C', 0);
    // $pdf->Cell($cellWidth, $cellHeight, $CourseShortName, 1, 0, 'C', 0);
    // $pdf->Cell(30, $cellHeight, $DMCprintedOn, 1, 0, 'C', 0);
    $pdf->Cell(25, $cellHeight, '', 1, 0, 'C', 0);
    $rowY += $rowHeight;
    if($rowY>261)
    {
      $pdf->AddPage();
      $rowY=42;
      $pdf-> Image('dist\img\new-logo.jpg',4,2,75,13);
      $pdf-> Image('dist\img\naac-logo.jpg',160,2,40,10);
      $pdf->SetXY(3, 20);
      $pdf->SetFont('Times', 'b', 15);
      $pdf->Multicell(205,10, '',0,'C');
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
