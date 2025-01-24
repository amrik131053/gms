
  <?php
require('fpdf/fpdf.php');
$SlipID=$_POST['SlipID'];
$lagerName=$_POST['lagerName'];
$session=$_POST['session'];
$collegeName=$_POST['collegeName'];
$IDNo=$_POST['IDNo'];
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";
    $getStatus="SELECT Ledger.Remarks,Ledger.credit,Ledger.CollegeName,Ledger.UserID,Ledger.ClassRollNo,Ledger.UniRollNo,
         Ledger.StudentName,Ledger.FatherName,Ledger.MotherName,Ledger.Sex,Ledger.ReceiptNo,Ledger.DateEntry,Ledger.IDNo,
         Ledger.Course,Ledger.Batch,Ledger.Semester,Ledger.OnAccountof,Ledger.ChequeDraftBank,Ledger.ChequeDraftNo,
         CONVERT(VARCHAR(11),Ledger.ChequeDraftDate,106) as ChequeDraftDate ,Ledger.ModeOfPayment as ModeOfPayment,
         Ledger.Credit as Credit1,Ledger.CashAmount,Ledger.OtherAmount,Ledger.ReferenceNumber  from Ledger 
         Where
         Ledger.CollegeName='$collegeName' And  Ledger.LedgerName='$lagerName' And  Ledger.ReceiptNo='$SlipID' And   Ledger.Session='$session' and IDNo='$IDNo'
";
   $getStatusRun=sqlsrv_query($conntest,$getStatus);
   if($getStatusRow=sqlsrv_fetch_array($getStatusRun))
   {  
        $Remarks=$getStatusRow['Remarks'];
        $credit=$getStatusRow['credit'];
        $CollegeName=$getStatusRow['CollegeName'];
        $UserID=$getStatusRow['UserID'];
        $ClassRollNo=$getStatusRow['ClassRollNo'];
        $UniRollNo=$getStatusRow['UniRollNo'];
        $StudentName=$getStatusRow['StudentName'];
        $FatherName=$getStatusRow['FatherName'];
        $MotherName=$getStatusRow['MotherName'];
        $Sex=$getStatusRow['Sex'];
        $ReceiptNo=$getStatusRow['ReceiptNo'];
        $DateEntry=$getStatusRow['DateEntry']->format('d-m-Y');
        $Course=$getStatusRow['Course'];
        $Batch=$getStatusRow['Batch'];
        $Semester=$getStatusRow['Semester'];
        $OnAccountof=$getStatusRow['OnAccountof'];
        $ChequeDraftBank=$getStatusRow['ChequeDraftBank'];
        $ChequeDraftNo=$getStatusRow['ChequeDraftNo'];
        $ChequeDraftDate=$getStatusRow['ChequeDraftDate'];
        $Credit1=$getStatusRow['Credit1'];
        $CashAmount=$getStatusRow['CashAmount'];
        $OtherAmount=$getStatusRow['OtherAmount'];
        $ModeOfPayment=$getStatusRow['ModeOfPayment'];
        $ReferenceNumber=$getStatusRow['ReferenceNumber'];
      $result1 = "SELECT  * FROM Admissions where IDNo='$IDNo'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
       $UniRollNo= $row['UniRollNo'];
       $img= $row['Image'];
       $name = $row['StudentName'];
       $father_name = $row['FatherName'];
       $mother_name = $row['MotherName'];
       $course = $row['Course'];
       $email = $row['EmailID'];
       $batch = $row['Batch'];
       $college = $row['CollegeName'];
      }
  

      $receiptData = [
        'ReceiptNo' => $ReceiptNo,
        'DateEntry' => $DateEntry,
        'StudentName' => $StudentName,
        'FatherName' => $FatherName,
        'Course' => $Course,
        'Batch' => $Batch,
        'ClassRollNo' => $ClassRollNo,
        'IDNo' => $IDNo,
        'OnAccountof' => $OnAccountof,
        'UniRollNo' => $UniRollNo,
    ];
    
    $paymentData = [
        'ModeOfPayment' => $ModeOfPayment,
        'ChequeDraftNo' => $ChequeDraftNo,
        'Credit' => $Credit1,
    ];
    
    $footerData = [
        'AmountInWords' => $Credit1,
        'ModeOfPayment' => $ModeOfPayment,
    ];
   }
class CustomPDF extends FPDF {
    function Footer() {

       
    }   
} 

class PDF extends FPDF
{
    // $X=$pdf->GETX();
    // $Y=$pdf->GETY();

    // Page Header
    function Header()
    {
        // Add University Logo
        $this->Image('dist/img/logo-login.png', 10, 10, 20);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Guru Kashi University', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'College Name: ' . $this->collegeName, 0, 1, 'C');
        $this->Ln(10); // Line break
    }

    // Footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Add Receipt Details
    function AddReceiptDetails($details)
    {
        $X=10;
$Y=35;
        $this->SetXY($X, $Y);
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Receipt No: ' . $details['ReceiptNo'], 0, 1,'L');
        $this->SetXY($X, $Y);
        $this->Cell(0, 10, 'Date: ' . $details['DateEntry'], 0, 1,'R');


        $this->Cell(50, 3, 'Received From: ', 0, 0);
        $this->Cell(0, 3, $details['StudentName'] . ' ' . $details['FatherName'], 0, 1);

        $this->SetXY($X, $Y+17);
        $this->Cell(50, 3, 'Course: ', 0, 0);
        $this->Cell(0, 3, $details['Course'], 0, 1);
        $this->SetXY($X, $Y+14);
        $this->Cell(0, 10, "Batch:".$details['Batch'], 0, 1,'R');

        $this->SetXY($X, $Y+24);
        $this->Cell(50, 3, 'Class Roll No: ', 0, 0);
        $this->Cell(0, 3, $details['ClassRollNo'], 0, 1);

        $this->SetXY($X, $Y+20);
        $this->Cell(0, 10, "ID/Reg. No: ".$details['IDNo'], 0, 1,'R');

        $this->Cell(50, 3, 'On Account of: ', 0, 0);
        $this->Cell(0, 3, $details['OnAccountof'], 0, 1);

        $this->SetXY($X, $Y+27);

        $this->Cell(0, 10, "Uni Roll No:".$details['UniRollNo'], 0, 1,'R');
    }

    // Add Payment Details
    function AddPaymentDetails($payment)
    {
 
        $X=10;
        $Y=35;
        $this->SetXY($X, $Y+40);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 10, 'S. No.', 1, 0, 'C');
        $this->Cell(130, 10, 'Particulars', 1, 0, 'C');
        $this->Cell(40, 10, 'Amount', 1, 1, 'C');

        $this->SetFont('Arial', '', 10);
        if ($payment['ModeOfPayment'] != 'Cash') {
            $this->Cell(10, 10, '1', 1, 0, 'C');
            $this->Cell(130, 10, 'Cheque/Draft No: ' . $payment['ChequeDraftNo'], 1, 0);
            $this->Cell(40, 10, $payment['Credit'], 1, 1);
        } else {
            $this->Cell(10, 10, '1', 1, 0, 'C');
            $this->Cell(130, 10, 'Cash Payment', 1, 0);
            $this->Cell(40, 10, $payment['Credit'], 1, 1);
        }

        $this->SetFont('Arial', 'B', 10);
        $this->Cell(140, 10, 'Total', 1, 0, 'R');
        $this->Cell(40, 10, $payment['Credit'], 1, 1, 'C');
    }

    // Add Footer Details
    function AddFooterDetails($footer)
    {
        // $this->Ln(10); // Line break
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Received Rs. ' . $footer['AmountInWords'] . ' by ' . $footer['ModeOfPayment'], 0, 1);

        $this->Ln(10); // Line break
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Cashier Signature', 0, 1, 'R');
    }
}


// Generate PDF
$pdf = new PDF();
$pdf->collegeName = $collegeName;

// Add Page
$pdf->AddPage();

// Add Receipt Details
$pdf->AddReceiptDetails($receiptData);

// Add Payment Details
$pdf->AddPaymentDetails($paymentData);

// Add Footer Details
$pdf->AddFooterDetails($footerData);

// Output PDF
$pdf->Output('I', 'receipt.pdf'); // 'I' for inline display, 'D' for download
