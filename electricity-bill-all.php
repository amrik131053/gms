<?php
require('fpdf/fpdf.php');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";



 $id=$_POST['meterReadingId'];

 $sql="SELECT *, meter_reading.ID as mrID from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where meter_reading.ID='$id'";
$res=mysqli_query($conn,$sql);
while ($data=mysqli_fetch_array($res) )
{
  $meterLocation=$data['location_id'];
  $currentOwner=$data['current_owner'];
  $floor=$data['Floor'];
  $article_num=$data['article_no'];
  $room_no=$data['RoomNo'];
  $date=date("d-M-Y", strtotime($data['reading_date']));
  $reading=$data['current_reading'];
  $unitsConsumed=$data['unit'];
  $id=$data['mrID'];
  $unitRate=$data['unit_rate'];
  $billAmount=$data['amount'];
  $building=$data['Name'];
  if ($room_no==0) 
  {
    $room_no='N/A';
  }
  $previousReading='N/A';
  $previousReadingDate='N/A';

    $oldRes=mysqli_query($conn,"SELECT * from meter_reading where article_no='$article_num' and ID<'$id' ORDER BY ID desc ");
    if ($data=mysqli_fetch_array($oldRes)) 
    {
        $previousReading=$data['current_reading'];
        $previousReadingDate=date("d-M-Y", strtotime($data['reading_date']));
    }

  if ($floor==0) 
  {
    $floorName='Ground';
  }
  elseif ($floor==1) 
  {
    $floorName='First';
  }
  elseif ($floor==2) 
  {
    $floorName='Second';
  }
  elseif ($floor==3) 
  {
    $floorName='Third';
  }

  elseif ($floor==4) 
  {
    $floorName='Fourth';
  }

  elseif ($floor==5) 
  {
    $floorName='Fifth';
  }


}
 if (strlen($currentOwner)>7) 
 {
    $result1 = "SELECT  * FROM Admissions where UniRollNo='$currentOwner' or ClassRollNo='$currentOwner' or IDNo='$currentOwner'";
$stmt1 = sqlsrv_query($conntest,$result1);
while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
{

    $IDNo= $row['IDNo'];
    $ClassRollNo= $row['ClassRollNo'];
    $img= $row['Snap'];
    $UniRollNo= $row['UniRollNo'];
    $StudentName = $row['StudentName'];
    $father_name = $row['FatherName'];
    $course = $row['Course'];
    $email = $row['EmailID'];
    $phone = $row['StudentMobileNo'];
    $batch = $row['Batch'];
    $college = $row['CollegeName'];
}
 }
 else
{
  $sql1 = "SELECT * FROM Staff Where IDNo='$currentOwner'";
        $q1 = sqlsrv_query($conntest, $sql1);
        while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
        {
            $userName = $row['Name'];
            $fatherName = $row['FatherName'];
            $CollegeName = $row['CollegeName'];
            $Designation = $row['Designation'];
            $EmailID = $row['EmailID'];
            $ContactNo = $row['ContactNo'];
            if ($ContactNo=='') 
            {
              $ContactNo = $row['MobileNo'];
            }


        }
}


function convertToIndianCurrency($billAmount) {
    $no = round($billAmount);
    $decimal = round($billAmount - ($no = floor($billAmount)), 2) * 100;    
    $digits_length = strlen($no);    
    $i = 0;
    $str = array();
    $words = array(
        0 => '',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety');
    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
    while ($i < $digits_length) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
            $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
        } else {
            $str [] = null;
        }  
    }
    
    $Rupees = implode(' ', array_reverse($str));
    $paise = ($decimal) ? "and ". ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])  ." Paise" : '';
    return ($Rupees ?  $Rupees .'Rupees ' : '') . $paise . " Only";
}

$englishBill=convertToIndianCurrency($billAmount);



















$d=0;
 
class PDF extends FPDF
{
  function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0)
{
  // resize font
  $subFontSizeold = $this->FontSizePt;
  $this->SetFontSize($subFontSize);
  
  // reposition y
  $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
  $subX        = $this->x;
  $subY        = $this->y;
  $this->SetXY($subX, $subY - $subOffset);

  //Output text
  $this->Write($h, $txt, $link);

  // restore y position
  $subX        = $this->x;
  $subY        = $this->y;
  $this->SetXY($subX,  $subY + $subOffset);

  // restore font size
  $this->SetFontSize($subFontSizeold);
}

   function Header()
{ 
// $LocationID  = $GLOBALS['LocationID'];


}





function Footer()
{ 
 $ctime = date("d-m-Y h:i:s A");
 
    // Position at 1.5 cm from bottom
    $this->SetXY(150,-10);
    // Times italic 8
    $this->SetFont('Times','I',12
  );
    // Page number
    $this->Cell(0,10,'Printed on '.$ctime,0,0,'C');
    $this->SetXY(10,-10);
}

}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','b',16);
$pdf->SetXY(4,10);
$pdf->Image('https://recruitment.gurukashiuniversity.in/images/logo-blue.png', 11, 11, 40);
$pdf->MultiCell(200,18,'',1,'C',False);
$pdf->SetXY(4,10);
$pdf->MultiCell(200,9,'Guru Kashi University',0,'C',False);
$pdf->SetFont('Times','b',12);
$pdf->SetXY(4,17);
$pdf->MultiCell(200,9,'(Regd. Office : Electrical Control Room)',0,'C',False);

$pdf->SetXY(4,9);
$pdf->SetTextColor(255,0,0);
$pdf->MultiCell(200,9,'QR No.: '.$article_num,0,'R',False);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Times','b',12);
$pdf->SetXY(4,28);
$pdf->MultiCell(200,246,'',1,'C',False);

$pdf->SetFont('Times','',12);


$pdf->SetXY(5,29);
$y=$pdf->GetY()+1;
// $pdf->MultiCell(197,29,'',0,'C',False);

$pdf->SetFont('Times','b',12);
$pdf->SetXY(6,$y+1);
$x=$pdf->GetX()+1+197;
$pdf->SetTextColor(11,37,68);
$pdf->Cell(195, 8, 'Meter Location Details ', 0, 1, 'C');
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Times','',12);
$y=$pdf->GetY()+1;

$pdf->SetXY(6,$y);
$x=$pdf->GetX()+1+76;
$pdf->Cell(76, 8, 'Block', 1, 1, 'C');

$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+39;
$pdf->Cell(39, 8, 'Floor', 1, 1, 'C');
$pdf->SetXY($x,$y);;
$x=$pdf->GetX()+1+39;
$pdf->Cell(39, 8, 'Room No.', 1, 1, 'C');
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+38;
$pdf->Cell(38, 8, 'Bill No.', 1, 1, 'C');

$y=$pdf->GetY()+1;
$pdf->SetFont('Times','b',12);
$pdf->SetXY(6,$y);
$x=$pdf->GetX()+1+76;
$pdf->Cell(76, 8, $building, 1, 1, 'C');

$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+39;
$pdf->Cell(39, 8, $floorName, 1, 1, 'C');
$pdf->SetXY($x,$y);;
$x=$pdf->GetX()+1+39;
$pdf->Cell(39, 8, $room_no, 1, 1, 'C');
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+38;
$pdf->Cell(38, 8, $id, 1, 1, 'C');





$y=$pdf->GetY()+2;
// $pdf->SetXY(5,$y);
// $pdf->MultiCell(197,64,'',,'C',False);

$pdf->SetFont('Times','b',12);
$pdf->SetXY(6,$y+1);
$x=$pdf->GetX()+1+197;
$pdf->SetTextColor(11,37,68);
$pdf->Cell(195, 8, 'Meter Owner Details ', 0, 1, 'C');
$pdf->SetTextColor(0,0,0);

$flag=0;
$sr=0;
$locationQry="SELECT distinct Corrent_owner from stock_summary where LocationID='$meterLocation' ORDER by Corrent_owner desc";
$locationRes=mysqli_query($conn,$locationQry);
while($locationData=mysqli_fetch_array($locationRes))
{
  $sr++;
  $user='';
  $user=$locationData['Corrent_owner'];
  if (strlen($user)>7) 
  {
    $flag=1;
    $result1 = "SELECT  * FROM Admissions where UniRollNo='$user' or ClassRollNo='$user' or IDNo='$user'";
    $stmt1 = sqlsrv_query($conntest,$result1);
    while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
    {

      $IDNo= $row['IDNo'];
      $ClassRollNo= $row['ClassRollNo'];
      $UniRollNo= $row['UniRollNo'];
      $StudentName = $row['StudentName'];
      $father_name = $row['FatherName'];
      $course = $row['Course'];
      $email = $row['EmailID'];
      $phone = $row['StudentMobileNo'];
      $batch = $row['Batch'];
      $college = $row['CollegeName'];
      $courseShortName = $row['CourseShortName'];
      if ($sr==1) 
      {
        $y=$pdf->GetY()+1;
        $pdf->SetFont('Times','',12);
        $pdf->SetXY(6,$y);
        $x=$pdf->GetX()+1+50.18;
        $pdf->Cell(50.18, 8, 'Uni / Class Roll No.', 1, 1, 'C');

        $pdf->SetXY($x,$y);
        $x=$pdf->GetX()+1+90;
        $pdf->Cell(90, 8, 'Name', 1, 1, 'C');
        $pdf->SetXY($x,$y);;
        $x=$pdf->GetX()+1+53;
        $pdf->Cell(53, 8, 'Course', 1, 1, 'C');
      }

      $y=$pdf->GetY()+1;
      $pdf->SetFont('Times','b',12);
      $pdf->SetXY(6,$y);
      $x=$pdf->GetX()+1+50.18;
      $pdf->Cell(50.18, 8, $UniRollNo.' / '.$ClassRollNo, 1, 1, 'C');

      $pdf->SetXY($x,$y);
      $x=$pdf->GetX()+1+90;
      $pdf->Cell(90, 8, $StudentName, 1, 1, 'C');
      $pdf->SetXY($x,$y);;
      $x=$pdf->GetX()+1+53;
      $pdf->Cell(53, 8, $courseShortName.' ('.$batch.')', 1, 1, 'C');
    }
  }
  elseif (strlen($user)<3) 
  {
    $flag=1;
    $sql1 = "SELECT * FROM outside_owners Where id='$user'";
      $q1 = mysqli_query($conn, $sql1);
      while ($row = mysqli_fetch_array($q1)) 
      {
        $userName = $row['name'];
        
        $Designation = $row['designation'];
        if ($sr==1) 
        {
          $y=$pdf->GetY()+1;
          $pdf->SetFont('Times','',12);
          $pdf->SetXY(6,$y);
          $x=$pdf->GetX()+1+97;
          $pdf->Cell(97, 8, 'Name', 1, 1, 'C');

          $pdf->SetXY($x,$y);;
          $x=$pdf->GetX()+1+97;
          $pdf->Cell(97, 8, 'Designation', 1, 1, 'C');
        }
        $y=$pdf->GetY()+1;
        $pdf->SetFont('Times','b',12);
        $pdf->SetXY(6,$y);
        $x=$pdf->GetX()+1+97;
        $pdf->Cell(97, 8, $userName, 1, 1, 'C');

        $pdf->SetXY($x,$y);;
        $x=$pdf->GetX()+1+97;
        $pdf->Cell(97, 8, $Designation, 1, 1, 'C');
      }
  }
  else
  {
    if ($flag==0) 
    {
      $sql1 = "SELECT * FROM Staff Where IDNo='$user'";
      $q1 = sqlsrv_query($conntest, $sql1);
      while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
      {
        $userName = $row['Name'];
        $fatherName = $row['FatherName'];
        $CollegeName = $row['CollegeName'];
        $Designation = $row['Designation'];
        $EmailID = $row['EmailID'];
        $ContactNo = $row['ContactNo'];
        if ($ContactNo=='') 
        {
          $ContactNo = $row['MobileNo'];
        }
        if ($sr==1) 
        {
          $y=$pdf->GetY()+1;
          $pdf->SetFont('Times','',12);
          $pdf->SetXY(6,$y);
          $x=$pdf->GetX()+1+30;
          $pdf->Cell(30, 8, 'Employee ID', 1, 1, 'C');

          $pdf->SetXY($x,$y);
          $x=$pdf->GetX()+1+85;
          $pdf->Cell(85, 8, 'Name', 1, 1, 'C');
          $pdf->SetXY($x,$y);;
          $x=$pdf->GetX()+1+78;
          $pdf->Cell(78, 8, 'Designation', 1, 1, 'C');
        }
        $y=$pdf->GetY()+1;
        $pdf->SetFont('Times','b',12);
        $pdf->SetXY(6,$y);
        $x=$pdf->GetX()+1+30;
        $pdf->Cell(30, 8, $user, 1, 1, 'C');

        $pdf->SetXY($x,$y);
        $x=$pdf->GetX()+1+85;
        $pdf->Cell(85, 8, $userName, 1, 1, 'C');
        $pdf->SetXY($x,$y);;
        $x=$pdf->GetX()+1+78;
        $pdf->Cell(78, 8, $Designation, 1, 1, 'C');
      }
    }
  }
}




$y=$pdf->GetY()+2;
$pdf->SetXY(103.5,$y);
$pdf->MultiCell(0.1,27,'',1,'C',true);

$pdf->SetFont('Times','b',12);
$pdf->SetXY(6,$y+1);
$x=$pdf->GetX()+1+98;
$pdf->SetTextColor(11,37,68);
$pdf->Cell(98, 8, 'Previous Reading Details', 0, 1, 'C');

$pdf->SetXY($x,$y+1);
$x=$pdf->GetX()+1+98;
$pdf->Cell(98, 8, 'Current Reading Details', 0, 1, 'C');
$pdf->SetTextColor(0,0,0);

$y=$pdf->GetY()+1;
$pdf->SetFont('Times','',12);
$pdf->SetXY(6,$y);
$x=$pdf->GetX()+1+48;
$pdf->Cell(48, 8, 'Date', 1, 1, 'C');

$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+48+0.5;
$pdf->Cell(47.5, 8, 'Reading', 1, 1, 'C');
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+25;
$pdf->Cell(25, 8, 'Date', 1, 1, 'C');
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+38+8;
$pdf->Cell(38+8, 8, 'Reading', 1, 1, 'C');
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+17+8;
$pdf->Cell(17+8, 8, 'Units', 1, 1, 'C');
// $pdf->SetXY($x,$y);
// $x=$pdf->GetX()+1+15;
// $pdf->Cell(15, 8, 'Rate', 1, 1, 'C');

$y=$pdf->GetY()+1;
$pdf->SetFont('Times','b',12);
$pdf->SetXY(6,$y);
$x=$pdf->GetX()+1+48;
$pdf->Cell(48, 8, $previousReadingDate, 1, 1, 'C');

$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+48+0.5;
$pdf->Cell(47.5, 8, $previousReading, 1, 1, 'C');
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+25;
$pdf->Cell(25, 8, $date, 1, 1, 'C');
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+38+8;
$pdf->Cell(38+8, 8, $reading, 1, 1, 'C');
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+17+8;
$pdf->Cell(17+8, 8, $unitsConsumed, 1, 1, 'C');
// $pdf->SetXY($x,$y);
// $x=$pdf->GetX()+1+15;
// $pdf->Cell(15, 8, $unitRate, 1, 1, 'C');



$y=$pdf->GetY()+1;
$pdf->SetXY(5,$y);
$pdf->MultiCell(197,20,'',1,'C',False);


$pdf->SetXY(6,$y+1);
$y=$pdf->GetY()+1;


$pdf->SetFont('Times','',12);
$pdf->SetXY(6,$y);
$x=$pdf->GetX()+1+48;
$pdf->SetTextColor(11,37,68);
$pdf->Cell(48, 17, 'Bill Amount Payable', 1, 1, 'C');
$pdf->SetTextColor(0,0,0);
  $pdf->SetTextColor(255,0,0);
$pdf->SetFont('Times','b',12);
$pdf->SetXY($x,$y);
$pdf->Cell(146, 8, 'Rs. '.$billAmount.' Only', 1, 1, 'C');

$y=$pdf->GetY()+1;
$pdf->SetXY($x,$y);
$x=$pdf->GetX()+1+146;
$pdf->Cell(146, 8, $englishBill, 1, 1, 'C');

  $pdf->SetTextColor(0,0,0);















$srno=1;          
$page_start=3;
$page_end=0;
$a_count=0;
for($i=0,$y=38;$i<$a_count;$i++)
{ 
  $pdf->SetXY(10,$y);           
  $pdf->Cell(10,6,$i+1,1,0,'C',0);
  $pdf->Cell(57,6,$articlename[$i],1,0,'C',0);
  $pdf->Cell(61,6,$count[$i],1,0,'C',0);
  $pdf->Cell(65,6,$p[$i],1,0,'C',0);
  $y=$y+6;

}
  $srno=1;  
$pagebottomNumber=3;
$page_number=0;



$pdf->Output();
?>
