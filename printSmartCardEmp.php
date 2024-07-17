<?php
session_start();
$EmployeeID=$_SESSION['usr'];

ini_set('max_execution_time', '0');

include 'connection/connection.php';
$result = sqlsrv_query($conntest,"SELECT RoleID FROM Staff  where IDNo=$EmployeeID");
if($row=sqlsrv_fetch_array($result)) 
{
       $role_id=$row['RoleID'];
}
if($role_id=='2' || $role_id=='3' )
{ 
   
require_once('fpdf/fpdf.php');
require_once('fpdf/fpdi.php');
class PDF extends FPDF
{
function Footer()
{ 
$pagenumber = '{nb}';
if($this->PageNo() == 2){
    $this->SetXY(0,62);
    $this->SetFont('Arial','B',9);
$this->MultiCell(53,4,'GURU KASHI UNIVERSITY Sardulgarh Road,Talwandi Sabo Bathinda, Punjab, India(151302) Phone: +91 99142-83400 www.gku.ac.in','','C');
}
if($this->PageNo() == 1){
    $this->SetXY(0,81);
    // $this->SetY(-4);
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(255,255,255);
    $this->MultiCell(53.98,3,'AUTHORISED SIGNATORY','0','C');
}
}
}
// $pdf = new FPDF('P');  // 
$pdf = new PDF('P','mm',array(53.98,85.60));
$pdf->SetAutoPageBreak(false);
$pdf -> AliasNbPages();
$pdf->AddPage('');
$code=$_GET['code'];
$empid=$_GET['id'];
if ($code==1) 
{
   
    $pdf-> Image('dist\img\GKUIDCARDLogo.png',4,2,45,13);
  $sql="SELECT *, MasterDepartment.Department as DepartmentName FROM Staff inner join MasterDepartment ON Staff.DepartmentId=MasterDepartment.Id where   IDNo='$empid'";
    $result = sqlsrv_query($conntest,$sql);
    while($row=sqlsrv_fetch_array($result))
    {
       $name= $row['Name'];
        $pdf->SetFont('Arial','',9);
        $pdf->SetTextColor(255,255,255);
        $pdf-> Image('dist\img\idcardbg.png',0,17,53.98,8);
        $pdf-> Image('dist\img\idcardbg.png',0,80,53.98,6);
        $pdf-> Image('dist\img\signn.jpg',18,73,20,5); 
        $pdf->SetXY(1,18.5);
        $pdf->MultiCell(52,3,$row['CollegeName'],'','C');
    $img= $row['Snap'];
    $pic = 'data://text/plain;base64,' . base64_encode($img);
    $info = getimagesize($pic);
    $extension = explode('/', mime_content_type($pic))[1];
    $pdf-> Image($pic,18,25.8,20,22,$extension);
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
 
    $pdf->SetXY(1,50);
    $pdf->SetFont('Arial','B',8);
    $pdf->SetTextColor(0,0,0);
     $strlen=strlen(trim($row['Name']));
    if($strlen<=23)
    {
        $pdf->Write(3,'Name     :','0','L');
    }
    elseif($strlen>23)
    {
        $pdf->Write(3,'Name     :','0','L');
        $XSet=$pdf->GetY()+10;
    }

    $pdf->SetXY(1.1,$XSet-3);
    $pdf->Write(3,'Emp.No :','0','L');
    $pdf->SetXY(1,$XSet+2);
    $pdf->Write(3,'Desig.    :','0','L');
    $pdf->SetXY(0.9,$XSet+8);
    $pdf->Write(3,'Dept.      :','0','L');
    
    $pdf->SetXY(14.5,50);
         $strlen=strlen(trim($row['Name']));
if($strlen<=23)
{
    $pdf->MultiCell(39,3,trim($row['Name']),'0','L');
}
elseif($strlen>23)
{
    $pdf->MultiCell(39,3,trim($row['Name']),'0','L');
    $XSet=$XSet;
    // $XSet=$pdf->GetY();
}
    $pdf->SetXY(14.5,$XSet-3);
    $pdf->MultiCell(39,3,$row['IDNo'],'0','L');
    $pdf->SetXY(14.5,$XSet+2);
    $pdf->MultiCell(39,3,$row['Designation'],'0','L');
    $pdf->SetXY(14.5,$XSet+8);
    $pdf->MultiCell(39,3,$row['DepartmentName'],'0','L');
    $pdf->SetXY(0,0);
    
    $pdf->SetTextColor(0,0,0);
  
    $pdf->AddPage('P');
    $pdf->SetXY(0,3);
    $pdf->SetFont('Arial','B',10);
    $pdf->line(0,10,1000,10);
    $pdf->line(0,10.1,1000,10.1);
    $pdf->line(0,10.2,1000,10.2);
    $pdf->line(0,60,1000,60);
    $pdf->line(0,60.1,1000,60.1);
    $pdf->line(0,60.2,1000,60.2);
    $pdf->MultiCell(53.98,3,'This is a property of GKU','0','C');
    $pdf->SetXY(1,12);
   
    $pdf->SetFont('Arial','B',8);
    $pdf->Write(3,'F. Name :','0','L');
    $pdf->SetXY(0.8,18);
    $pdf->Write(3,'Mobile    :','0','L');
    $pdf->SetXY(1.1,24);
    $pdf->Write(3,'D.O.B     :','0','L');

    
    $pdf->SetXY(14.5,12);
    $pdf->MultiCell(39,3,$row['FatherName'],'0','L');
    $pdf->SetXY(14.5,18);
    $pdf->MultiCell(39,3,$row['MobileNo'],'0','L');
    $pdf->SetXY(14.5,24);
    $DATE=$row['DateOfBirth']->format('d-m-Y');
    $pdf->MultiCell(39,3,$DATE,'0','L');
    $pdf->SetXY(0,32);
    $pdf->MultiCell(53.98,3,'Address','0','C');
    $pdf->SetXY(0,37);
    $pdf->MultiCell(53,4,$row['PermanentAddress'],'0','C');
    
   }

$date=date('Y-m-d H:i:s');

 $up="INSERT INTO TblStaffSmartCardReport(UpdateDate,PrintStatus,IDNo) values ('$date','Printed','$empid')";

 $stmt1 = sqlsrv_query($conntest,$up);

}


$pdf->Output();
}
else{
    ?>
    <script>window.open("not_found.php");   </script>
    <?php
}
?>