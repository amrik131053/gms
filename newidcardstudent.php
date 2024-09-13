<?php
session_start();
$EmployeeID=$_SESSION['usr'];
ini_set('max_execution_time', '0');
include 'phpqrcode/qrlib.php';
include 'connection/connection.php';
//0F7ACF
$result = sqlsrv_query($conntest,"SELECT RoleID FROM Staff  where IDNo='131053'");
if($row=sqlsrv_fetch_array($result)) 
{
    $role_id=$row['RoleID'];
}
if($role_id=='2' || $role_id=='3' )
{ 

require('fpdf/rotate.php');

class PDF extends PDF_Rotate
{
    function RotatedText($x,$y,$txt,$angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}
function RotatedImage($file,$x,$y,$w,$h,$angle)
{
    //Image rotated around its upper-left corner
    $this->Rotate($angle,$x,$y);
    $this->Image($file,$x,$y,$w,$h);
    $this->Rotate(0);
}
function Footer()
{ 
$pagenumber = '{nb}';
if($this->PageNo() == 1){
    $this->SetXY(0,74);  
    $this->SetFont('Arial','B',7);
    $this->SetTextColor(255,255,255);
    $this->MultiCell(53,2,'Campus Address','','C');
    $this->SetXY(0,77);
    $this->SetFont('Arial','B',6);
$this->MultiCell(53,2.5,' Sardulgarh Road,Talwandi Sabo Bathinda, Punjab, India(151302)  Phone: +91 99142-83400 www.gku.ac.in','0','C');
$this->SetXY(1,68);
$this->SetTextColor(0,0,0);
$this->SetFont('Arial','B',5);
      $this->MultiCell(52,3,'Authorised Signatory','0','R');
}
}
} 
$pdf = new PDF('P','mm',array(53.98,85.60));
$pdf->SetAutoPageBreak(false);
$pdf -> AliasNbPages();
$pdf->AddPage('');
$pdf->line(3,54.5,51,54.5);
$code=$_GET['code'];
$empid=$_GET['id'];
if ($code==1) 
{
    $pdf-> Image('dist\img\new-logo.png',1,1,36,6.5);
    $pdf-> Image('dist\img\naac-logo.png',39,1,14,6.5);
    $sql="SELECT *,SmartCardDetails.Status as SmartCardStatus FROM SmartCardDetails 
    inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO  where SmartCardDetails.IDNo='$empid'  ";
    $result = sqlsrv_query($conntest,$sql);
    if($row=sqlsrv_fetch_array($result))
    {
        $gender=$row['Sex'];
        $ge="";
          if ($gender=='Male') 
        {   
            $ge="S/O"; 
        } 
        else
        {
            $ge="D/O";
        }
         $getCourseDetails="SELECT * FROM  MasterCourseCodes WHERE CourseID='".$row['CourseID']."'  and Batch='".$row['Batch']."' ";
        $getCourseDetailsRun = sqlsrv_query($conntest,$getCourseDetails);
        if($rowgetCourseDetails=sqlsrv_fetch_array($getCourseDetailsRun))
        {
           
            // $ValidUpTo=$rowgetCourseDetails['ValidUpto'];
            $CourseShortName=$rowgetCourseDetails['CourseShortName'];
            $ValidUpTo=$rowgetCourseDetails['ValidUpto']->format('d-m-Y');
            $ValidUpToSess=$rowgetCourseDetails['ValidUpto']->format('y');
        }
       
        // $text="https://gku.ac.in/qr-verfication-student.php?IDNo=".$row['IDNo'];
        // $path = 'degreeqr/';
        // $file = $path.$row['IDNo'].".png";
        // $ecc = 'L';
        // $pixel_Size = 10;
        // $frame_Size = 10;
        // QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
        
        $name= $row['StudentName'];
        $pdf->SetFont('Arial','B',7.5);
        $pdf->SetTextColor(255,255,255);
        $pdf-> Image('dist\img\dummy_qr.jpg',3,65.5,10,10);
        // $pdf-> Image($file,2.5,65.2,11,11);
         $pdf-> Image('dist\img\signn.jpg',37,63,18,5);
         $pdf-> Image('dist\img\idcardbg.png',0,36,55,5);
         $pdf-> Image('dist\img\idcardbg4.png',0,-1,54,90);
         $pdf->SetXY(1,32);
         $pdf->SetTextColor(0,0,0);
         $pdf->SetFont('Arial','B',10);
         $pdf->MultiCell(52,3,$row['ClassRollNo'],'0','C');

         $pdf->SetTextColor(0,0,0);
         $pdf->SetFont('Arial','B',7.5);
        $pdf->SetXY(0,10);
    // $img= $row['Snap'];
     $imageURL=$row['Image'];
     $fullURL = $BasURL.'Images/Students/'. rawurlencode($imageURL);

$ch = curl_init($fullURL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$imageData = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
    curl_close($ch);
    exit;
}
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode != 200) {
    echo 'HTTP error: ' . $httpCode;
    curl_close($ch);
    exit;
}
curl_close($ch);
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->buffer($imageData);
$extension = 'jpeg'; 
switch ($mimeType) {
    case 'image/jpeg':
        $extension = 'jpeg';
        break;
    case 'image/png':
        $extension = 'png';
        break;
    default:
        echo 'Unsupported image type: ' . $mimeType;
        exit;
}

$base64Image = base64_encode($imageData);
$imageSrc = 'data:' . $mimeType . ';base64,' . $base64Image;
    $pdf-> Image($imageSrc,18,12,18,18,$extension);
    $pdf->SetXY(18,12);
    $pdf->MultiCell(18,18,'','1','C');
    $YCount=strlen(strtoupper(trim($row['StudentName'])));
    if($YCount>24)
    {
        $XSet=60;
        $RowsSet=3;
    }
    else
    {
        $XSet=58;
        $RowsSet=3;
    }
    $pdf->SetTextColor(34.2,50,96);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(1,50.7);
    $pdf->SetFont('Arial','B',6);
    $pdf->MultiCell(52,3,"Mobile No:".$row['StudentMobileNo']."  Valid Up to: ".$ValidUpTo,'0','C');
    $pdf->SetXY(1,55.7);
    $pdf->SetFont('Arial','B',6);
    $pdf->MultiCell(52,3,$ge.' '.$row['FatherName'].', '.$row['PermanentAddress'],'0','C');
    $pdf->SetXY(1,50);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetTextColor(255,255,255);
      $strlen=strlen(trim($row['StudentName']));
    $pdf->SetXY(1,$XSet+12);
    $pdf->SetXY(1,37);
    $pdf->SetFont('Arial','B',8);
     $strlen=strlen(trim($row['StudentName']));
    if($strlen<=23)
    {
        $pdf->MultiCell(52,3,trim($row['StudentName']),'0','C');
    }
    elseif($strlen>23 && $strlen<=25)
    {
        $pdf->MultiCell(52,3,ucfirst(trim($row['StudentName'])),'0','C');
        $XSet=$XSet;
    }
    elseif($strlen>33)
    {
        $pdf->SetFont('Arial','B',6);
        $pdf->MultiCell(52,3,trim($row['StudentName']),'0','C');
        $XSet=$XSet;
    }
    elseif($strlen>27 && $strlen<32 )
    {
        $pdf->SetFont('Arial','B',7);
        $pdf->MultiCell(52,3,ucfirst(trim($row['StudentName'])),'0','C');
        $XSet=$XSet;
    }
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(1,$XSet-16.5);
    $pdf->SetFont('Arial','B',5.7);
    $pdf->MultiCell(52,3,strtoupper($CourseShortName).' ('.$row['Batch'].'-'.$ValidUpToSess.')','0','C');
    $pdf->SetXY(1,$XSet-13.4);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',6);
    $pdf->MultiCell(52,3,strtoupper($row['CollegeName']),'0','C');
    $pdf->SetTextColor(0,0,0);
   }
    $date=date('Y-m-d H:i:s');
    $up1="UPDATE SmartCardDetails SET Status='Printed',PrintDate='$date' WHERE IDNO='$empid' ";
    sqlsrv_query($conntest,$up1);
     $desc= "ID Card Print";
   
       $update1="insert into logbook(userid,remarks,updatedby,date)Values('$empid','$desc','$EmployeeID','$timeStamp')";
   
   
   $update_query=sqlsrv_query($conntest,$update1);
   
// $up="INSERT INTO TblStaffSmartCardReport(UpdateDate,PrintStatus,IDNo) values ('$date','Printed','$empid')";
//  $stmt1 = sqlsrv_query($conntest,$up);
}
$pdf->Output();
}
else{
    ?>
<script>
window.open("not_found.php");
</script>
<?php
}
?>