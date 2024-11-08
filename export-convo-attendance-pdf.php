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
$j = 0;

// Build query based on filters
$qry = "SELECT * FROM online_payment WHERE status='success' AND remarks='4th Convocation'";
if ($Status !== 'All') {
    $qry .= " AND attending='$Status'";
}
if ($CollegeName !== 'All') {
    $qry .= " AND CollegeName='$CollegeName'";
}
$qry .= " ORDER By roll_no ASC";
$result = mysqli_query($conn_online, $qry);

// Initialize data arrays for PDF content
$IDNo = $name = $father_name = [];

// Fetch data and populate arrays
while ($row = mysqli_fetch_array($result)) {
    $IDNo[] = $row['roll_no'];
    $name[] = $row['name'];
    $father_name[] = $row['father_name'];
    $j++;
}

// Define PDF class with custom header and footer
class PDF extends FPDF {
    private $collegeName;

    // Constructor to accept CollegeName
    public function __construct($collegeName) {
        parent::__construct();
        $this->collegeName = $collegeName;
    }

    // Header function
    function Header() {
        $this->Image('dist/img/new-logo.jpg', 10, 10, 38, 10);
        $this->SetXY(9, 8);
        $this->SetFont('times', 'B', 13);
        $this->Cell(195, 30, '', 1, 0, 'C', 0);
        // $this->SetXY(15, 12);
    
        // Display College Name if it's not 'All'
        $this->SetXY(70, 25);
        if ($this->collegeName !== 'All') {
            $this->Write(0, $this->collegeName);
        } 
        $this->SetFont('times', 'B', 10);
        // Table headers
        $this->SetXY(9, 32);
        $this->Cell(65, 6, 'Uni Roll No.', 1, 0, 'C', 0);
        $this->Cell(65, 6, 'Name', 1, 0, 'C', 0);
        $this->Cell(65, 6, 'Father Name', 1, 0, 'C', 0);
    }
    
    // Footer function
    function Footer() {
        $this->SetXY(180, -10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Pass CollegeName to PDF instance
$pdf = new PDF($CollegeName);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 10);

$y = 38;
for ($i = 0; $i < $j; $i++) { 
    if ($y > 266) { // Add new page if content overflows
        $pdf->AddPage();
        $y = 38;
    }
    
    $pdf->SetXY(9, $y);
    $pdf->Cell(65, 6, $IDNo[$i], 1, 0, 'C', 0);
    $pdf->Cell(65, 6, $name[$i], 1, 0, 'C', 0);
    $pdf->Cell(65, 6, $father_name[$i], 1, 0, 'C', 0);
    $y += 6;
}

// Output the PDF
$pdf->Output();
?>
