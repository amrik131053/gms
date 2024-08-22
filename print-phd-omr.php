<?php
require('fpdf/fpdf.php');
$From=$_POST['From']=2501;
$To=$_POST['To']=2600;
// Extend the FPDF class to create a custom class with a footer
class CustomPDF extends FPDF {
    function Footer() {
        // Set the position of the footer at 15mm from the bottom
        $this->SetY(-15);
        // Set font and color for the footer text
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
    }
      function CustomBulletPoint() {
        
$this->Image('dist/img/bullet-point.png', 15, 63, 4);
$this->Image('dist/img/bullet-point.png', 15, 68, 4);
$this->Image('dist/img/bullet-point.png', 15, 73, 4);
$this->Image('dist/img/bullet-point.png', 15, 78, 4);
$this->Image('dist/img/bullet-point.png', 15, 83, 4);
    }
}

// Create a new CustomPDF instance
$pdf = new CustomPDF();
$pdf->AliasNbPages(); // Enable page numbering


for ($p=$From; $p <=$To ; $p++) { 
$pdf->AddPage('P', 'A4');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(85, 1);
$pdf->MultiCell(210, 10, 'Sr. No. '.$p, 0, 'C');
// $pdf->SetXY(10, 10);
$pdf->Image('dist/img/new-logo.png', 10, 10, 88);
$pdf->Image('dist/img/naac-logo.png', 170, 10, 30);
$pdf->Image('dist/img/idcardbg.png', 10,30, 180);
$pdf->Image('dist/img/idcardbg.png', 20,30, 180);
// $pdf->SetFont('Arial', 'B', 30);
// $pdf->SetTextColor(34, 50, 96); 
// $pdf->MultiCell(210, 10, 'GURU KASHI UNIVERSITY', 0, '');
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->SetXY(0, 22);
// $pdf->MultiCell(210, 10, 'Sardulgarh Road, Talwandi Sabo,(Bathinda) Punjab-151302', 0, 'C');
$pdf->SetFont('Arial', '', 15);
$pdf->SetXY(10, 30);
$pdf->SetTextColor(255, 255, 255);
$pdf->MultiCell(190, 10, 'Entrance Test for Admission to M.Sc/Ph.D Programme', 0, 'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(10, 40);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(190, 10, 'Max.Marks: 50                               Answer Sheet For Ques. Paper Set ...........                    Time Allowes: 60 Minutes', 0, 'L');

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(10, 50);
$pdf->MultiCell(190, 10, 'Important Instructions for the Candidates:', 0, 'L');
$pdf->SetXY(20, 60);
$pdf->SetFont('Arial', '', 10);
$pdf->CustomBulletPoint();
$pdf->MultiCell(190, 10, 'Use Blue /Black ball point pen for writing the answers.', 0, 'L');
$pdf->SetXY(20, 65);
$pdf->CustomBulletPoint();
$pdf->MultiCell(190, 10, 'Write the answer in CAPITAL LATTER in the Box against each question number.', 0, 'L');
$pdf->SetXY(20, 70);
$pdf->CustomBulletPoint();
$pdf->MultiCell(190, 10, 'Use of calculator is not allowed.', 0, 'L');

$pdf->SetXY(20, 75);
$pdf->CustomBulletPoint();
$pdf->MultiCell(190, 10, 'All question are compulsory. Each question has only one right answer. No Negative marking for wrong answers.', 0, 'L');
$pdf->SetXY(20, 80);
$pdf->CustomBulletPoint();
$pdf->MultiCell(190, 10, 'Questions attempted with two or more options/overwritten answer will not be evaluated.', 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetXY(20, 90);

$pdf->MultiCell(190, 10, 'Course applied for (M.Sc/Ph.D)____________________Discipline___________________________________', 0, 'L');
$pdf->SetXY(20, 100);

$pdf->MultiCell(190, 10, 'Name of the Candidate (In Capital Letters)...............................................................................................................', 0, 'L');
$pdf->SetXY(20, 110);

$pdf->MultiCell(190, 10, "Father's Name (In Capital Letters)..............................................................................................................................", 0, 'L');
$pdf->SetXY(20, 120);

$pdf->MultiCell(190, 10, "Roll No...................................... Date ..................................Signature of the Candidate...........................................", 0, 'L');
$pdf->SetXY(20, 130);

$pdf->MultiCell(190, 10, "Signature of the Invigilator................................................ Signature Stamp (C.O.E)...............................................", 0, 'L');
$pdf->SetTextColor(0, 0, 0);

// $pdf->SetXY(20, 250);

// $pdf->MultiCell(190, 10, "Total Marks Obtained..................................... (In Words)..................................", 0, 'L');

$header = array('Q.No', 'ANS=A/B/C/D');

// Generate the table
$pdf->SetFont('Arial', 'B', 10);
$x = 9;
$y = 141;
$serialNumber = 1; // Initialize the serial number

for ($i = 1; $i <= 5; $i++) {
    // Add header
    $pdf->SetXY($x, $y);
    $pdf->Cell(10, 9, $header[0], 1);
    $pdf->Cell(25, 9, $header[1], 1);
    $pdf->Ln();

    // Add table data
    $pdf->SetFont('Arial', 'B', 10);
    for ($j = 1; $j <= 10; $j++) {
        $pdf->SetXY($x, $y + 9);

        $pdf->Cell(10, 9, $serialNumber, 1); // Set the serial number
        $pdf->Cell(25, 9, '', 1);
        $pdf->Ln();
        $y = $y + 9;
        $serialNumber++; // Increment the serial number
    }

    // Add horizontal space between tables
    $pdf->Cell(2, 10, '', 0);
    $pdf->Ln(12);
    $x = $x + 39;
    $y = 141;
    // $yr=$pdf->GetY();
}

// Additional MultiCell sections
$pdf->SetXY(10, 246);
$pdf->MultiCell(190, 6, 'Total Marks Obtained...............................................       (In Words)...................................................................................', 0, 'L');

$pdf->SetXY(10, 254);
$pdf->MultiCell(190, 6, 'Signature of the Evaluator.......................................       Signature of the Checking Assistant.......................................', 0, 'L');

$pdf->SetXY(10, 262);
$pdf->MultiCell(190, 6, 'Name of the Evaluator  ............................................       Name of the Checking Assistant.............................................', 0, 'L');

$pdf->SetXY(10, 270);
$pdf->MultiCell(190, 6, 'Employee ID..............................................................        Employee ID..............................................................................', 0, 'L');
}
// Output the PDF
$pdf->Output();
?>
