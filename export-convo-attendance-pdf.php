<?php
require_once ('fpdf/fpdf.php');
include 'connection/connection.php';
include "connection/connection_web.php"; 
session_start();

if (!isset($_SESSION['usr'])) {
    header('Location:index.php');
    exit;
} 

$a = $_SESSION['usr'];
$sql12 = "SELECT * FROM Staff WHERE IDNo = ?";
$params12 = array($a);
$stmt12 = sqlsrv_query($conntest, $sql12, $params12);
if ($row12 = sqlsrv_fetch_array($stmt12, SQLSRV_FETCH_ASSOC)) {
    $sname = $row12['Name'];
    $mobno = $row12['MobileNo'];
}

$CollegeName = $_GET['CollegeName'] ?? 'All';
$Status = $_GET['Status'] ?? 'All';
$Type = $_GET['Type'] ?? 'All';
$j = 0;

$qry = "SELECT * FROM online_payment WHERE status='success' AND remarks='4th Convocation'";
if ($Status !== 'All') {
    $qry .= " AND attending='$Status'";
}
if ($CollegeName !== 'All') {
    $qry .= " AND CollegeName='$CollegeName'";
}
if ($Type !== 'All') {
    $qry .= " AND Type='$Type'";
}
$qry .= " ORDER By roll_no,course ASC";
$result = mysqli_query($conn_online, $qry);


$IDNo = $name = $father_name =$course= [];


while ($row = mysqli_fetch_array($result)) {
    $IDNo[] = $row['roll_no'];
    $name[] = $row['name'];
    $father_name[] = $row['father_name'];
    $course[] = $row['course'];
    // $course = $row['course'];
    $j++;
}

class PDF extends FPDF {
    private $collegeName;
    private $course;

    public function __construct($collegeName) {
        parent::__construct();
        $this->collegeName = $collegeName;
    }


    function Header() {
        // Logo
        $this->Image('dist/img/new-logo.jpg', 10, 10, 38, 10);
        $this->SetXY(9, 8);
        $this->SetFont('times', 'B', 13);
        $this->Cell(195, 30, '', 1, 0, 'C', 0);
      
        $this->SetFont('times', 'B', 12);
        $this->SetXY(70, 22);
        // if ($this->course !== 'All') {
        //     $this->Write(0, $this->course);
        // } 
        $this->SetXY(70, 28);
        if ($this->collegeName !== 'All') {
            $this->Write(0, $this->collegeName);
        } 

  
        $this->SetFont('times', 'B', 10);
        $this->SetXY(9, 32);
        $this->Cell(25, 6, 'Uni Roll No.', 1, 0, 'C', 0);
        $this->Cell(55, 6, 'Name', 1, 0, 'C', 0);
        $this->Cell(60, 6, 'Father Name', 1, 0, 'C', 0);
        $this->Cell(55, 6, 'Course', 1, 0, 'C', 0);
    }
    
    function Footer() {
        $this->SetXY(180, -10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF($CollegeName); 
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 10);

$y = 38;
for ($i = 0; $i < $j; $i++) { 
    if ($y > 266) { 
        $pdf->AddPage();
        $y = 38;
    }
    
    $pdf->SetXY(9, $y);
    $pdf->Cell(25, 6, $IDNo[$i], 1, 0, 'C', 0);
    $pdf->Cell(55, 6, $name[$i], 1, 0, 'C', 0);
    $pdf->Cell(60, 6, $father_name[$i], 1, 0, 'C', 0);
    $pdf->Cell(55, 6, $course[$i], 1, 0, 'C', 0);
    $y += 6;
}

// Output the PDF
$pdf->Output();
?>
