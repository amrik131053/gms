<?php 
$readonly1 = new mysqli('119.18.54.49', 'guruk2cy_connect','Amrik@123','guruk2cy_online');
$readonly = new mysqli('119.18.54.49', 'guruk2cy_readonly','Amrik@123','guruk2cy_online');
  require_once('fpdf/fpdf.php');
  $roll_no=$_POST['rollNo'];
  $result = mysqli_query($readonly1,"SELECT * FROM online_payment where  status='success' AND remarks='4th Convocation' AND roll_no='$roll_no' ");

  $counter = 0; 
      while($rowr=mysqli_fetch_array($result)) 
      {
        $counter++;
       $status= $rowr['slip_no'];

      }

// $status=$_POST["slip_no"];
  


   $query = "SELECT * from online_payment where slip_no = '$status' AND status = 'success' ";
    $res = mysqli_query($readonly,$query);
    if($row=mysqli_fetch_array($res))
  {
    $name = $row['name'];
    $father_name = $row['father_name'];
    $roll_no = $row['roll_no'];
    $course = $row['course'];
    $sem = $row['sem'];
     $slip_no = $row['slip_no'];
    $batch = $row['batch'];
    $payment_id = $row['payment_id'];
    $Created_date = $row['Created_date'];
    $Created_date = date("d-m-Y", strtotime($Created_date));
    $amount = $row['amount'];
    $purpose = $row['purpose']; 
    $mobile = $row['phone'];
    $email = $row['email'];
$remarks=$row['remarks'];
$a='(';
$b=')';
  }
  else
  {
    ?>
<script>
  
// window.location.href ="failure.php";


  
   </script>
 <?php  }
  
  $amount_fix = "/-";

  $ones = array(""," One"," Two"," Three"," Four"," Five"," Six"," Seven"," Eight"," Nine"," Ten"," Eleven"," Twelve"," Thirteen"," Fourteen"," Fifteen"," Sixteen"," Seventeen"," Eighteen"," Nineteen");
 
$tens = array("",""," Twenty"," Thirty"," Forty"," Fifty"," Sixty"," Seventy"," Eighty"," Ninety");
 
$triplets = array(""," Thousand"," Million"," Billion"," Trillion"," Quadrillion"," Quintillion"," Sextillion"," Septillion"," Octillion"," Nonillion");
 
 // recursive fn, converts three digits per pass
function convertTri($num, $tri) {
  global $ones, $tens, $triplets;
 
  // chunk the number, ...rxyy
  $r = (int) ($num / 1000);
  $x = ($num / 100) % 10;
  $y = $num % 100;
 
  // init the output string
  $str = "";
 
  // do hundreds
  if ($x > 0)
   $str = $ones[$x] . " Hundred";
 
  // do ones and tens
  if ($y < 20)
   $str .= $ones[$y];
  else
   $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];
 
  // add triplet modifier only if there
  // is some output to be modified...
  if ($str != "")
   $str .= $triplets[$tri];
 
  // continue recursing?
  if ($r > 0)
   return convertTri($r, $tri+1).$str;
  else
   return $str;
 }
 
// returns the number as an anglicized string
function convertNum($num) {
 $num = (int) $num;    // make sure it's an integer
 
 if ($num < 0)
  return "negative".convertTri(-$num, 0);
 
 if ($num == 0)
  return "zero";
 
 return convertTri($num, 0);
}
 
 // Returns an integer in -10^9 .. 10^9
 // with log distribution
 function makeLogRand() {
  $sign = mt_rand(0,1)*2 - 1;
  $val = randThousand() * 1000000
   + randThousand() * 1000
   + randThousand();
  $scale = mt_rand(-9,0);
 
  return $sign * (int) ($val * pow(10.0, $scale));
 }

$amountInWords = convertNum($amount)." Rupees Only";





$pdf = new FPDF();
$pdf->AddPage();
//$pdf->setSourceFile('slip1.pdf');
$pdf->SetFont('Arial','B',16);



  $pdf->Image('https://gku.ac.in/paymentconvo/slip3.png', 0, 0,210 ,297 );

$pdf->SetFont('Times');
$pdf->SetTextColor(256, 0, 0);
$pdf->SetXY(57, 36);
$pdf->SetFont('Times','B',14);
$pdf->Write(0, $slip_no);
$pdf->SetFont('Times','',12);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetXY(155, 36);
$pdf->Write(0, $Created_date);



$pdf->SetXY(32, 45);
$pdf->Write(0, $name);

$pdf->SetXY(115, 45);
$pdf->Write(0, $father_name);

$pdf->SetXY(42, 54.5);
$pdf->Write(0, $roll_no);

$pdf->SetXY(123, 54.5);
$pdf->Write(0, $course);

//$pdf->SetXY(32, 64);
//$pdf->Write(0, $batch);

//$pdf->SetXY(115, 64);
//$pdf->Write(0, $sem);
$pdf->SetFont('Times','',13);
$pdf->SetXY(75, 64);
$pdf->Write(0, $amountInWords);
$pdf->SetFont('Times','',12);
$pdf->SetXY(55, 73.5);
$pdf->Write(0, $remarks);
$pdf->SetFont('Times','',12);
$pdf->SetXY(155, 73.5);
$pdf->Write(0, $payment_id);

$pdf->SetXY(28,83);
$pdf->Write(0, $email);

$pdf->SetXY(125, 83);
$pdf->Write(0, $mobile);

$pdf->SetFont('Times','',14);
$pdf->SetXY(25, 97);

$pdf->Write(0, $amount.$amount_fix);



$pdf->Output();



echo "Success";
?>
