<?php
session_start();
$EmployeeID=$_SESSION['usr'];
ini_set('max_execution_time', '0');
include 'phpqrcode/qrlib.php';
include 'connection/connection.php';

$result = sqlsrv_query($conntest,"SELECT RoleID FROM Staff  where IDNo='131053'");
if($row=sqlsrv_fetch_array($result)) 
{
    $role_id=$row['RoleID'];
}
if($role_id=='2' || $role_id=='3' )
{ 
   
// require_once('fpdf/fpdf.php');
// require_once('fpdf/fpdi.php');
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
// if($this->PageNo() == 2){
//     $this->SetXY(0,60);
//     $this->SetFont('Arial','B',9);
// $this->MultiCell(53,4,'GURU KASHI UNIVERSITY Sardulgarh Road,Talwandi Sabo Bathinda, Punjab, India(151302) Phone: +91 99142-83400 www.gku.ac.in','','C');
// }
if($this->PageNo() == 1){
    $this->SetXY(0,74);
    //  $this->SetY(-4);  
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
// $pdf = new FPDF('P');  // 
$pdf = new PDF('P','mm',array(53.98,85.60));
$pdf->SetAutoPageBreak(false);
$pdf -> AliasNbPages();
$pdf->AddPage('');
//    $pdf->line(0,73,1000,73);
   $pdf->line(3,56,51,56);
  // $pdf->line(0,73.1,1000,70.1);
    


$code=$_GET['code'];
$empid=$_GET['id'];
if ($code==1) 
{
   
    $pdf-> Image('dist\img\new-logo.png',1,1,36,6.5);
    $pdf-> Image('dist\img\naac-logo.png',39,1,14,6.5);
  $sql="SELECT *, MasterDepartment.Department as DepartmentName FROM Staff inner join MasterDepartment ON Staff.DepartmentId=MasterDepartment.Id where   IDNo='$empid'";
    $result = sqlsrv_query($conntest,$sql);
    while($row=sqlsrv_fetch_array($result))
    {
        $text="https://gku.ac.in/qr-verification-staff.php?IDNo=".$row['IDNo'];
        $path = 'degreeqr/';
        $file = $path.$row['IDNo'].".png";
        $ecc = 'L';
        $pixel_Size = 10;
        $frame_Size = 10;
        QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
        
        $name= $row['Name'];
        $pdf->SetFont('Arial','B',7.5);
        $pdf->SetTextColor(255,255,255);
        // $pdf-> Image($file,3,65.5,10,10);
        $pdf-> Image($file,2.5,65.2,11,11);
         $pdf-> Image('dist\img\signn.jpg',37,63,18,5);
         $pdf-> Image('dist\img\idcardbg1.png',0,40,55,5);
         $pdf-> Image('dist\img\idcardback.png',0,-1,54,90);
         $pdf->SetXY(18.6,35.5);
         $pdf->SetTextColor(0,0,0);
        //  $pdf->Rotate(90);
         $pdf->SetFont('Arial','B',10);
         $pdf->MultiCell(17,3,$row['IDNo'],'0','C');
        //  $pdf->Rotate(0);
        //  $pdf-> Image('dist\img\barcode.png',5,19.5,8,15);
         $pdf->SetTextColor(0,0,0);
         $pdf->SetFont('Arial','B',7.5);
        $pdf->SetXY(0,10);
    // $img= $row['Snap'];
    $imageURL=$row['Imagepath'];
    $fullURL = $BasURL.'Images/Staff/'. rawurlencode($imageURL);

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
    $pdf-> Image($imageSrc,18,16,18,18,$extension);
    $pdf->SetXY(18,16);
    $pdf->MultiCell(18,18,'','1','C');
    $YCount=strlen(strtoupper(trim($row['Name'])));
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
    $pdf->SetXY(0,10);
    $pdf->SetTextColor(0,0,0);
    // // $pdf->Rotate(180);
    // //  $pdf->Rotate(0);
    $pdf->SetFont('Arial','B',8);
    $pdf->MultiCell(56,3,strtoupper($row['CollegeName']),'0','C');
    $pdf->SetTextColor(0,0,0);
    $pdf->SetXY(1,52.5);
    $pdf->SetFont('Arial','B',5.8);
    $pdf->MultiCell(52,3,"Emergency No:".$row['MobileNo']."     Blood Group: ".$row['BloodGroup'],'0','C');
    $pdf->SetXY(1,57);

    $pdf->SetFont('Arial','B',6);
    $pdf->MultiCell(52,3,$row['PermanentAddress'],'0','C');
   
    $pdf->SetXY(1,50);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetTextColor(255,255,255);
     $strlen=strlen(trim($row['Name']));
    if($strlen<=23)
    {
    //    $pdf->Write(3,'Name     :','0','L');
    }
    elseif($strlen>23)
    {
        $pdf->Write(3,'Name     :','0','L');
        $XSet=$pdf->GetY()+10;
    }

    $pdf->SetXY(1,$XSet+12);

    $pdf->SetXY(1,41);
    $pdf->SetFont('Arial','B',8);
         $strlen=strlen(trim($row['Name']));
if($strlen<=23)
{
    $pdf->MultiCell(52,3,trim($row['Name']),'0','C');
}
elseif($strlen>23)
{
    $pdf->MultiCell(52,3,trim($row['Name']),'0','C');
    $XSet=$XSet;
    // $XSet=$pdf->GetY();
}
$pdf->SetTextColor(0,0,0);
    $pdf->SetXY(1,$XSet-13.2);
    $pdf->SetFont('Arial','B',5.7);
      $strlend=strlen(trim($row['Designation']));
if($strlend<=23)
{
    $pdf->MultiCell(52,3,strtoupper($row['Designation']),'','C');
}
else
{
     $pdf->MultiCell(52,3,$row['Designation'],'','C');
}
    $pdf->SetXY(1,$XSet-9);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',6);
    $pdf->MultiCell(52,3,strtoupper($row['DepartmentName']),'0','C');
    $pdf->SetTextColor(0,0,0);
   }

$date=date('Y-m-d H:i:s');

$up="INSERT INTO TblStaffSmartCardReport(UpdateDate,PrintStatus,IDNo) values ('$date','Printed','$empid')";

 $stmt1 = sqlsrv_query($conntest,$up);

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