<?php
session_start();
$EmployeeID=$_SESSION['usr'];

ini_set('max_execution_time', '0');

include 'connection/connection.php';
$staff="SELECT Name,Snap,Designation,Department,DateOfJoining,LeaveSanctionAuthority,CollegeID,RoleID FROM Staff Where IDNo='$EmployeeID'";
$stmt = sqlsrv_query($conntest,$staff);  
while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
    {
$Emp_Name=$row_staff['Name'];
$Emp_Image=$row_staff['Snap'];
$Emp_Department=$row_staff['Department'];
 $Emp_Designation=$row_staff['Designation'];
 $Emp_CollegeID=$row_staff['CollegeID'];
$DateOfJoining=$row_staff['DateOfJoining'];
$LeaveSanctionAuthority=$row_staff['LeaveSanctionAuthority'];
$role_id = $row_staff['RoleID'];
    }
if( $role_id=='3' ||  $role_id=='2' )
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
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(255,255,255);
    $this->MultiCell(53.98,3,'AUTHORISED SIGNATORY','0','C');
}
}
} 
$pdf = new PDF('P','mm',array(53.98,85.60));
$pdf->SetAutoPageBreak(false);
$pdf -> AliasNbPages();
$pdf->AddPage('');
$code=$_GET['code'];
$empid=$_GET['id'];
if($code==1)
{


$eprint=$_GET['print'];




    $pdf-> Image('dist\img\GKUIDCARDLogo.png',4,2,45,13);
    $sql="SELECT *,SmartCardDetails.Status as SmartCardStatus FROM SmartCardDetails 
    inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO  where SmartCardDetails.IDNo='$empid'  ";
    $result = sqlsrv_query($conntest,$sql);
    if($row=sqlsrv_fetch_array($result))
    {
         $getCourseDetails="SELECT * FROM  MasterCourseCodes WHERE CourseID='".$row['CourseID']."'  and Batch='".$row['Batch']."' ";
        $getCourseDetailsRun = sqlsrv_query($conntest,$getCourseDetails);
        if($rowgetCourseDetails=sqlsrv_fetch_array($getCourseDetailsRun))
        {
           
            // $ValidUpTo=$rowgetCourseDetails['ValidUpto'];
            $CourseShortName=$rowgetCourseDetails['CourseShortName'];
            $ValidUpTo=$rowgetCourseDetails['ValidUpto']->format('d-m-Y');
        }

if($CourseShortName!='')
{
        $name= $row['StudentName'];
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(255,255,255);
        $pdf-> Image('dist\img\idcardbg.png',0,17,53.98,9);
        $pdf-> Image('dist\img\idcardbg.png',0,80,53.98,6);
        $pdf-> Image('dist\img\signn.jpg',18,73,20,5); 
        $collegeLen=strlen($rowgetCourseDetails['CollegeName']);
        if($collegeLen<25)
        {
            $ClgC=4;
            $ClgY=19;
        }elseif($collegeLen<30)
        {
            $ClgC=4;
            $ClgY=19;
        }
        else
        {
            $ClgC=4;
            $ClgY=17.5;
        }
        $pdf->SetXY(1,$ClgY);
        $pdf->MultiCell(52,$ClgC,$rowgetCourseDetails['CollegeName'],'0','C');
        $img= $row['Image'];
        $pic = $BasURL.'Images/Students/'.$img;
        // $info = getimagesize($pic);
        // $extension = explode('/', mime_content_type($pic))[1];
        $pdf-> Image($pic,18,26.8,20,21);
        $YCount=strlen(strtoupper($row['StudentName']));
        if($YCount>18)
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
    $pdf->Write(3,'Name     :','0','L');
    $pdf->SetXY(1,$XSet-3);
    $pdf->Write(3,'Roll No  :','0','L');
    $pdf->SetXY(1,$XSet+2);
    $pdf->Write(3,'Course  :','0','L');
    $pdf->SetXY(1,$XSet+7);
    $pdf->Write(3,'Batch    :','0','L');
    $pdf->SetXY(0.9,$XSet+12);
    $pdf->Write(3,'Valid Up To. :','0','L');
    

    
    $pdf->SetXY(14.5,50);

    $pdf->MultiCell(39,$RowsSet,strtoupper($row['StudentName']),'0','L');
    $pdf->SetXY(14.5,$XSet-3);
    $pdf->MultiCell(39,3,$row['ClassRollNo'],'0','L');
    $pdf->SetXY(14.5,$XSet+2);
    $pdf->MultiCell(39,3,$CourseShortName,'0','L');
    $pdf->SetXY(14.5,$XSet+7);
    $pdf->MultiCell(39,3,$row['Batch'],'0','L');
    $pdf->SetXY(20.5,$XSet+12);
    $pdf->MultiCell(39,3,$ValidUpTo,'0','L');
    $pdf->SetXY(0,0);
    
    $pdf->SetTextColor(0,0,0);
    $YCountBack=strlen(strtoupper($row['FatherName']));
    if($YCountBack>18)
    {
        $XSetBack=24;
        $RowsSetBack=3;
    }
    else
    {
        $XSetBack=24;
        $RowsSetBack=3;
    }
    $pdf->AddPage('P');
    $pdf->SetXY(0,1);
    $pdf->SetFont('Arial','B',9);
    $pdf->line(0,10,1000,10);
    $pdf->line(0,10.1,1000,10.1);
    $pdf->line(0,10.2,1000,10.2);
    $pdf->line(0,60,1000,60);
    $pdf->line(0,60.1,1000,60.1);
    $pdf->line(0,60.2,1000,60.2);
    $pdf->MultiCell(53.98,4,'This is a property of Guru Kashi University','0','C');
    $pdf->SetXY(1,12);
    $pdf->SetFont('Arial','B',9);
    $pdf->Write(3,'F. Name :','0','L');
    $pdf->SetXY(0.8,$XSetBack-5);
    $pdf->Write(3,'Mobile    :','0','L');
    $pdf->SetXY(1.1,$XSetBack+1);
    $pdf->Write(3,'D.O.B     :','0','L');

  
    $pdf->SetXY(16.5,12);
    $pdf->MultiCell(39,$RowsSetBack,strtoupper($row['FatherName']),'0','L');
    $pdf->SetXY(16.5,$XSetBack-5);
    $pdf->MultiCell(39,3,$row['StudentMobileNo'],'0','L');
    $pdf->SetXY(16.5,$XSetBack+1);
    $DATE=$row['DOB']->format('d-m-Y');
    $pdf->MultiCell(39,3,$DATE,'0','L');
    $pdf->SetXY(0,$XSetBack+8);
    $pdf->MultiCell(53.98,3,'Address','0','C');
    $pdf->SetXY(0.4,$XSetBack+13);
    $pdf->MultiCell(53,4,strtoupper($row['PermanentAddress'].', PIN CODE-'.$row['PIN']),'0','C');
    

   

$date=date('Y-m-d H:i:s');

$up="UPDATE Admissions SET ValidUpTo='$ValidUpTo' WHERE IDNo='$empid'";
 sqlsrv_query($conntest,$up);
 
 if($eprint>0)

{

    $up1="UPDATE SmartCardDetails SET Status='Printed',RePrint='$eprint' WHERE IDNO='$empid' ";

    sqlsrv_query($conntest,$up1);

    $desc= "ID Card Reprint";

    $update1="insert into logbook(userid,remarks,updatedby,date)Values('$empid','$desc','$EmployeeID','$timeStamp')";


$update_query=sqlsrv_query($conntest,$update1);

}
else
{
 $up1="UPDATE SmartCardDetails SET Status='Printed',PrintDate='$date' WHERE IDNO='$empid' ";
 sqlsrv_query($conntest,$up1);
  $desc= "ID Card Print";

    $update1="insert into logbook(userid,remarks,updatedby,date)Values('$empid','$desc','$EmployeeID','$timeStamp')";


$update_query=sqlsrv_query($conntest,$update1);
}


 // $up11="UPDATE MAsterCourseCodes SET CourseShortName='$CourseShortName'  WHERE CourseID='".$row['CourseID']."' and Session='".$row['Session']."' and Batch='".$row['Batch']."'  ";
 //  sqlsrv_query($conntest,$up11);
}
}
}
elseif($code==2)
{
    $pdf-> Image('dist\img\GKUIDCARDLogo.png',4,2,45,13);
    $sql="SELECT *,SmartCardDetails.Status as SmartCardStatus FROM SmartCardDetails 
    right join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO  where SmartCardDetails.IDNO='$empid' or Admissions.IDNo='$empid'   ";
    $result = sqlsrv_query($conntest,$sql);
    if($row=sqlsrv_fetch_array($result))
    {
          $getCourseDetails="SELECT * FROM  MasterCourseCodes WHERE CourseID='".$row['CourseID']."'  and Batch='".$row['Batch']."' ";
        $getCourseDetailsRun = sqlsrv_query($conntest,$getCourseDetails);
        if($rowgetCourseDetails=sqlsrv_fetch_array($getCourseDetailsRun))
        {
           
            // $ValidUpTo=$rowgetCourseDetails['ValidUpto'];
            $CourseShortName=$rowgetCourseDetails['CourseShortName'];
            $ValidUpTo=$rowgetCourseDetails['ValidUpto']->format('d-m-Y');
        }
        $name= $row['StudentName'];
        $pdf->SetFont('Arial','',10);
        $pdf->SetTextColor(255,255,255);
        $pdf-> Image('dist\img\idcardbg.png',0,17,53.98,9);
        $pdf-> Image('dist\img\idcardbg.png',0,80,53.98,6);
        $pdf-> Image('dist\img\signn.jpg',20.5,75,13,4); 
        $collegeLen=strlen($rowgetCourseDetails['CollegeName']);
        if($collegeLen<25)
        {
            $ClgC=4;
            $ClgY=19;
        }elseif($collegeLen<30)
        {
            $ClgC=4;
            $ClgY=19;
        }
        else
        {
            $ClgC=4;
            $ClgY=17.5;
        }
        $pdf->SetXY(1,$ClgY);
        $pdf->MultiCell(52,$ClgC,$rowgetCourseDetails['CollegeName'],'0','C');
        $img= $row['Image'];
        $pic = $BasURL.'Images/Students/'.$img;
        // $pic = 'data://text/plain;base64,' . base64_encode($img);
        // $info = getimagesize($pic);
        // $extension = explode('/', mime_content_type($pic))[1];
        $pdf-> Image($pic,18,26.8,20,21);
        $YCount=strlen(strtoupper(trim($row['StudentName'])));
        if($YCount>18)
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
    $pdf->Write(3,'Name     :','0','L');
    $pdf->SetXY(1,$XSet-3);
    $pdf->Write(3,'Roll No  :','0','L');
    $pdf->SetXY(1,$XSet+2);
    $pdf->Write(3,'Course  :','0','L');
    $pdf->SetXY(1,$XSet+7);
    $pdf->Write(3,'Batch    :','0','L');
    $pdf->SetXY(0.9,$XSet+12);
    $pdf->Write(3,'Valid Up To. :','0','L');
    

       
    $pdf->SetXY(14.5,50);

    $pdf->MultiCell(39,$RowsSet,strtoupper(trim($row['StudentName'])),'0','L');
    $pdf->SetXY(14.5,$XSet-3);
    $pdf->MultiCell(39,3,$row['ClassRollNo'],'0','L');
    $pdf->SetXY(14.5,$XSet+2);
    $pdf->MultiCell(39,3,strtoupper($CourseShortName),'0','L');
    $pdf->SetXY(14.5,$XSet+7);
    $pdf->MultiCell(39,3,$row['Batch'],'0','L');
    $pdf->SetXY(20.5,$XSet+12);
    $pdf->MultiCell(39,3,$ValidUpTo,'0','L');
    $pdf->SetXY(0,0);
    
    $pdf->SetTextColor(0,0,0);
    $YCountBack=strlen(strtoupper($row['FatherName']));
    if($YCountBack>18)
    {
        $XSetBack=24;
        $RowsSetBack=3;
    }
    else
    {
        $XSetBack=24;
        $RowsSetBack=3;
    }
    $pdf->AddPage('P');
    $pdf->SetXY(0,1);
    $pdf->SetFont('Arial','B',9);
    $pdf->line(0,10,1000,10);
    $pdf->line(0,10.1,1000,10.1);
    $pdf->line(0,10.2,1000,10.2);
    $pdf->line(0,60,1000,60);
    $pdf->line(0,60.1,1000,60.1);
    $pdf->line(0,60.2,1000,60.2);
    $pdf->MultiCell(53.98,4,$YCountBack.'This is a property of Guru Kashi University','0','C');
    $pdf->SetXY(1,12);
    $pdf->SetFont('Arial','B',9);
    $pdf->Write(3,'F. Name :','0','L');
    $pdf->SetXY(0.8,$XSetBack-5);
    $pdf->Write(3,'Mobile    :','0','L');
    $pdf->SetXY(1.1,$XSetBack+1);
    $pdf->Write(3,'D.O.B     :','0','L');

  
    $pdf->SetXY(16.5,12);
    $pdf->MultiCell(39,$RowsSetBack,strtoupper($row['FatherName']),'0','L');
    $pdf->SetXY(16.5,$XSetBack-5);
    $pdf->MultiCell(39,3,$row['StudentMobileNo'],'0','L');
    $pdf->SetXY(16.5,$XSetBack+1);
    $DATE=$row['DOB']->format('d-m-Y');
    $pdf->MultiCell(39,3,$DATE,'0','L');
    $pdf->SetXY(0,$XSetBack+8);
    $pdf->MultiCell(53.98,3,'Address','0','C');
    $pdf->SetXY(0.4,$XSetBack+13);
    $pdf->MultiCell(53,4,strtoupper($row['PermanentAddress'].', PIN CODE-'.$row['PIN']),'0','C');
    

   

$date=date('Y-m-d H:i:s');

$up="UPDATE Admissions SET ValidUpTo='$ValidUpTo' WHERE IDNo='$empid' ";
 sqlsrv_query($conntest,$up);

 $up11="UPDATE MAsterCourseCodes SET CourseShortName='$CourseShortName',ValidUpto='$ValidUpTo'  WHERE CourseID='".$row['CourseID']."' and Session='".$row['Session']."' and Batch='".$row['Batch']."'  ";
  sqlsrv_query($conntest,$up11);
}
}

$pdf->Output();
}
else
{
    ?>
<script>window.location="not_found.php";   </script>
<?php
}
?>