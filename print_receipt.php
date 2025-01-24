
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
        if($Sex=='Male')
        {
            $gender="S/o";
        }
        else{
            $gender="D/o";
        }
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
        $ChequeDraftBank=$getStatusRow['ChequeDraftBank'];
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
  
      $number = $Credit1;
    $no = floor($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'One', '2' => 'Two',
     '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'six',
     '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
     '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
     '13' => 'Thirteen', '14' => 'Fourteen',
     '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
     '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
     '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
     '60' => 'Sixty', '70' => 'Seventy',
     '80' => 'Eighty', '90' => 'Ninety');
    $digits = array('', 'hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_1) {
      $divider = ($i == 2) ? 10 : 100;
      $number = floor($no % $divider);
      $no = floor($no / $divider);
      $i += ($divider == 10) ? 1 : 2;
      if ($number) {
         $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
         $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
         $str [] = ($number < 21) ? $words[$number] .
             " " . $digits[$counter] . $plural . " " . $hundred
             :
             $words[floor($number / 10) * 10]
             . " " . $words[$number % 10] . " "
             . $digits[$counter] . $plural . " " . $hundred;
      } else $str[] = null;
   }
   $str = array_reverse($str);
   $result = implode('', $str);
   $points = ($point) ?
     "." . $words[$point / 10] . " " . 
           $words[$point = $point % 10] : '';
   $ammountInwords= $result . "Rupees " . $points;


      $receiptData = [
        'ReceiptNo' => $ReceiptNo,
        'DateEntry' => $DateEntry,
        'StudentName' => $StudentName,
        'FatherName' => $FatherName,
        'Course' => $Course,
        'Batch' => $Batch,
        'ClassRollNo' => $ClassRollNo,
        'IDNo' => $IDNo,
        'gender' => $gender,
        'OnAccountof' => $OnAccountof,
        'UniRollNo' => $UniRollNo,
    ];
    
    $paymentData = [
        'ModeOfPayment' => $ModeOfPayment,
        'ChequeDraftNo' => $ChequeDraftNo,
        'ChequeDraftBank' => $ChequeDraftBank,
        'Credit' => $Credit1,
    ];
    
    $footerData = [
        'AmountInWords' => $ammountInwords,
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
        $X=10;
        $Y=15;
                $this->SetXY($X, $Y);
        // Add University Logo
        $this->Image('dist/img/logo-login.png', 10, 10, 20);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Guru Kashi University', 0, 1, 'C');
        $this->SetXY($X, $Y+6);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, $this->collegeName, 0, 1, 'C');
        $this->SetXY($X, $Y+11);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 10, 'Sardulgarh Road, Talwandi Sabo ', 0, 1, 'C');
        // $this->Ln(10); // Line break
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
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 4, 'Receipt No: ' . $details['ReceiptNo'], 0, 1,'L');
        $this->SetXY($X, $Y);
        $this->Cell(0, 4, 'Date: ' . $details['DateEntry'], 0, 1,'R');


        $this->SetXY($X, $Y+6);
        $this->Cell(35, 4, 'Received From: ', 0, 0);
        $this->SetXY($X+35, $Y+5.5);
        $this->Cell(0, 5, $details['StudentName'] .' '. $details['gender'].' ' . $details['FatherName'],'B', 0, 1);

        $this->SetXY($X, $Y+12);
        $this->Cell(35, 4, 'Course: ', 0, 0);
        $this->SetXY($X+35, $Y+11.5);
    
        $this->Cell(130, 5, $details['Course'],'B', 0, 1);
        $this->SetXY($X+159, $Y+12);
        $this->Cell(20, 4, "Batch:",'', 1,'R');
        $this->SetXY($X+178, $Y+11.5);
        $this->Cell(12, 5,$details['Batch'],'B', 1,'R');

        $this->SetXY($X, $Y+18);
        $this->Cell(35, 4, 'Class Roll No: ', 0, 0);
        $this->SetXY($X+35, $Y+17.5);
        $this->Cell(91, 5, $details['ClassRollNo'],'B', 0, 1);

        $this->SetXY($X+126, $Y+18);
        $this->Cell(25, 4, "ID/Reg. No: ", 0, 1,'L');

        $this->SetXY($X+152, $Y+17.5);
        $this->Cell(38, 5, $details['IDNo'], 'B', 1,'L');
                 
        $this->SetXY($X, $Y+23);
        $this->Cell(35, 4, 'On Account of:', 0, 0);
        $this->SetXY($X+35, $Y+22.5);
        $this->Cell(95, 5, $details['OnAccountof'],'B', 0, 1);

        $this->SetXY($X+130, $Y+23);

        $this->Cell(30, 4, "Uni Roll No:", 0, 1,'R');
        $this->SetXY($X+160, $Y+23);
        $this->Cell(30, 5, $details['UniRollNo'], 'B', 1,'R');
    }

    // Add Payment Details
    function AddPaymentDetails($payment)
    {
 
        $X=10;
        $Y=28;
        $this->SetXY($X, $Y+40);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(10, 7, 'S.No.', 1, 0, 'C');
        $this->Cell(140, 7, 'Particulars', 1, 0, 'C');
        $this->Cell(40, 7, 'Amount', 1, 1, 'C');

        $this->SetFont('Arial', 'B', 10);
        if ($payment['ModeOfPayment'] != 'Cash') {
            $this->Cell(10, 15, '1', 1, 0, 'C');
            $this->Cell(140, 7, 'Cheque/Draft No: ' . $payment['ChequeDraftNo'], 1, 0);
            $this->SetXY($X+10, $Y+54);
            $this->Cell(140, 8, 'Bank: ' . $payment['ChequeDraftBank'], 1, 0);
            $this->SetXY($X+150, $Y+47);
            $this->Cell(40, 15, $payment['Credit'], 1, 1,'C');
        } else {
            $this->Cell(10, 7, '1', 1, 0, 'C');
            $this->Cell(140, 7, 'Cash Payment', 1, 0);
            $this->Cell(40, 7, $payment['Credit'], 1, 1,'C');
        }

        $this->SetFont('Arial', 'B', 11);
        $this->Cell(150, 7, 'Total', 1, 0, 'R');
        $this->Cell(40, 7, $payment['Credit'], 1, 1, 'C');
    }

    // Add Footer Details
    function AddFooterDetails($footer)
    {
          $X=$this->GETX();
    $Y=$this->GETY();
        $this->SetXY($X, $Y+2);
        // $this->Ln(10); // Line break
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 4, 'Received Rs. ' , 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->SetXY($X+24, $Y+2);
        $this->Cell(126, 4, $footer['AmountInWords'] . ' by ' . $footer['ModeOfPayment'], 0, 1);
        $this->SetFont('Arial', 'B', 10);
        $X=$this->GETX();
        $this->SetXY($X+150, $Y+2);
        $this->Cell(7, 4, ' by ', 0, 1);
        $this->SetFont('Arial', '', 10);
        $this->SetXY($X+157, $Y+2);
        $this->Cell(0, 4, $footer['ModeOfPayment'], 0, 1);

            // $this->Ln(10); // Line break
            // $this->SetFont('Arial', 'B', 10);
            // $this->Cell(0, 10, 'Cashier Signature', 0, 1, 'R');
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
