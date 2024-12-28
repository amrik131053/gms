                  <?php 
require('fpdf/fpdf.php');
ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";
   $college=$_POST['College'];
   $course=$_POST['Course'];
   $yoa=$_POST['Batch'];
   $session=$_POST['sessions'];
   $no_sem=$_POST['no_sem'];
   $count=0;
class CustomPDF extends FPDF {
    function Footer() {
        // Set the position of the footer at 15mm from the bottom
        $this->SetY(-15);
        // Set font and color for the footer text
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(128);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
        $this->SetY(-12);
        // $this->Cell(0, 10, 'Printed on ' .$GLOBALS['timeStampS'], 0, 0, 'R');
    }   
} 
$pdf = new CustomPDF();

        // $pdf->AddPage('P', 'A4');  
 $sql = "SELECT  * FROM Admissions where CollegeID='$college'AND CourseID='$course'AND Batch='$yoa' and Session='$session' AND Status>'0' order by UniRollNo desc";
$stmt1 = sqlsrv_query($conntest,$sql);
while($row6 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
{
$IDNo= $row6['IDNo'];
$ClassRollNo= $row6['ClassRollNo'];
$img= $row6['Snap'];
$UniRollNo= $row6['UniRollNo'];
$name = $row6['StudentName'];
$father_name = $row6['FatherName'];
$mother_name = $row6['MotherName'];
$course = $row6['Course'];
$email = $row6['EmailID'];
$phone = $row6['StudentMobileNo'];
$batch = $row6['Batch'];
$college = $row6['CollegeName'];
$CourseID=$row6['CourseID'];
$CollegeID=$row6['CollegeID'];
$Gender=$row6['Sex'];
$imageURL=$row6['Image'];
$fullURL = $BasURL.'Images/Students/'. rawurlencode($imageURL);

if($CollegeID==0)
{
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
    // echo $fullURL;
    // $pdf-> Image('dist/img/male.png',180,26.8,20,21);
    // echo 'HTTP error: ' . $httpCode;
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
}
else{
$extension="png";
    $imageSrc="dist/img/male.png";
}



$srno=1;
$x=0;
$y=20;
$pdf->AddPage('P', 'A4');  
$pdf->SetXY(10,18);
$pdf->SetFont('times', 'B', 12);
$pdf->SetXY(10,12);
// $pdf->multicell(190, 5,"Guru Kashi Univerisity",0,'C');
$pdf->SetXY(10,18);
$pdf->multicell(190, 5,"Origional Document Receiving Form",0,'C');
$pdf->SetTextColor(150,0,0);
$pdf->MultiCell(190,8,"  ", 0, 'C');
$pdf->SetTextColor(0,0,0);
$pdf-> Image('dist\img\new-logo.jpg',10,8,55,10);
$pdf-> Image('dist\img\naac-logo.jpg',170,8,30,10);
$pdf->SetXY(10,25);
if($imageURL!='')
{
// $pic = 'data://text/plain;base64,' . base64_encode($img);
// $info = getimagesize($pic);
// $extension = explode('/', mime_content_type($pic))[1];
// $pdf-> Image($pic,180,26.8,20,21,$extension);
$pdf-> Image($imageSrc,180,26.8,20,21,$extension);
}else
{

// if($Gender=='Male')
// {
//     $pdf-> Image('dist/img/male.png',180,26.8,20,21);
// }else{
//     $pdf-> Image('dist/img/female.png',180,26.8,20,21);

// }
}
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(80, 7,"Class/Uni Roll No :    ".$ClassRollNo.' / '.$UniRollNo, 1, 'l');
$pdf->SetXY(90,25);
$pdf->MultiCell(90, 7,"Name :    ".$name, 1, 'l');
$pdf->SetXY(180,25);
$pdf->MultiCell(20, 28,"", 1, '');
$pdf->SetXY(10,32);
$pdf->MultiCell(80, 7, "Father Name :    ".$father_name, 1, 'l');
$pdf->SetXY(90,32);
$pdf->MultiCell(90, 7, "Mother Name :    ".$mother_name, 1, 'l');

$pdf->MultiCell(130, 7, "Course :    ".$course, 1, 'l');
$pdf->SetXY(140,39);
$pdf->MultiCell(40, 7, "Batch :    ".$batch, 1, 'l');
$pdf->SetXY(10,46);
$pdf->MultiCell(170, 7, "College :    ".$college, 1, 'l');
// $pdf->SetXY(140,46);
// $pdf->MultiCell(40, 7, "Semester :    ", 1, 'l');
$pdf->SetXY(10,60);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(10,6,"SEM", 1,'C');
$pdf->SetXY(20,60);
$pdf->multicell(30, 6,"EXAMINATION",1,'C');
$pdf->SetXY(50,60);
$pdf->multicell(20, 6,"Sr.No",1,'C');
$pdf->SetXY(70,60);
$pdf->multicell(30, 6,"DMC NO",1,'C');
$pdf->SetXY(100,60);
$pdf->multicell(20, 6,"SGPA",1,'C');
$pdf->SetXY(120,60);
$pdf->multicell(20, 6,"CREDIT",1,'C');
$pdf->SetXY(140,60);
$pdf->multicell(20, 6,"D.O.I",1,'C');
$pdf->SetXY(160,60);
$pdf->multicell(40, 6,"Signature/Date",1,'C');

$y=66;



for($i=1;$i<$no_sem+1;$i++)
{
if($i==1)
{
    $sem="st";
}elseif($i==2)
{
    $sem="nd";
}
elseif($i==3)
{
    $sem="rd";
}
else
{
    $sem="th";
}
    $pdf->SetXY(10,$y);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->multicell(10,10,$i.$sem, 1,'C');
$pdf->SetXY(20,$y);
$pdf->multicell(30, 10,"",1,'C');
$pdf->SetXY(50,$y);
$pdf->multicell(20, 10,"",1,'C');
$pdf->SetXY(70,$y);
$pdf->multicell(30, 10,"",1,'C');
$pdf->SetXY(100,$y);
$pdf->multicell(20, 10,"",1,'C');
$pdf->SetXY(120,$y);
$pdf->multicell(20, 10,"",1,'C');
$pdf->SetXY(140,$y);
$pdf->multicell(20, 10,"",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 10,"",1,'C');
    
    $y=$y+10;

}
$pdf->SetXY(10,$y+4);
$pdf->multicell(190,6,"PROVISIONAL DEGREE CERTIFICATE", 1,'C');

$y=$y+10;
$pdf->SetXY(10,$y);
// $pdf->multicell(190,6,"PROVISIONAL DEGREE CERTIFICATE", 1,'C');

$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(20,6,"Sr.No", 1,'C');
$pdf->SetXY(30,$y);
$pdf->multicell(70, 6,"PDC No.",1,'C');
$pdf->SetXY(100,$y);
$pdf->multicell(60, 6,"D.O.I",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 6,"Signature/Date",1,'C');
$y=$y+6;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(20,10,"", 1,'C');
$pdf->SetXY(30,$y);
$pdf->multicell(70, 10,"",1,'C');

$pdf->SetXY(100,$y);
$pdf->multicell(60, 10,"",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 10,"",1,'C');



$pdf->SetXY(10,$y+16);
$pdf->multicell(190,6,"ORIGINAL DEGREE", 1,'C');

$y=$y+22;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(20,6,"Sr.No", 1,'C');
$pdf->SetXY(30,$y);
$pdf->multicell(30, 6,"DEGREE NO.",1,'C');
$pdf->SetXY(60,$y);
$pdf->multicell(40, 6,"PASSING EXAMINATION",1,'C');
$pdf->SetXY(100,$y);
$pdf->multicell(30, 6,"CGPA",1,'C');
$pdf->SetXY(130,$y);
$pdf->multicell(30, 6,"D.O.I",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 6,"Signature/Date",1,'C');
$y=$y+6;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(20,10,"", 1,'C');
$pdf->SetXY(30,$y);
$pdf->multicell(30, 10,".",1,'C');
$pdf->SetXY(60,$y);
$pdf->multicell(40, 10,"",1,'C');
$pdf->SetXY(100,$y);
$pdf->multicell(30, 10,"",1,'C');
$pdf->SetXY(130,$y);
$pdf->multicell(30, 10,"",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 10,"",1,'C');



$pdf->SetXY(10,$y+16);
$pdf->multicell(190,6,"TRANSCRIPT", 1,'C');

$y=$y+22;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(20,6,"Sr.No", 1,'C');
$pdf->SetXY(30,$y);
$pdf->multicell(70, 6,"TRANSCRIPT NO.",1,'C');
$pdf->SetXY(100,$y);
$pdf->multicell(30, 6,"CGPA",1,'C');
$pdf->SetXY(130,$y);
$pdf->multicell(30, 6,"D.O.I",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 6,"Signature/Date",1,'C');
$y=$y+6;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(20,10,"", 1,'C');
$pdf->SetXY(30,$y);
$pdf->multicell(70, 10,"",1,'C');
$pdf->SetXY(100,$y);
$pdf->multicell(30, 10,"",1,'C');
$pdf->SetXY(130,$y);
$pdf->multicell(30, 10,"",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 10,"",1,'C');




$pdf->SetXY(10,$y+16);
$pdf->multicell(190,6,"MIGRATION", 1,'C');

$y=$y+22;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(20,6,"Sr.No", 1,'C');
$pdf->SetXY(30,$y);
$pdf->multicell(70, 6,"MIGRATION NO.",1,'C');
$pdf->SetXY(100,$y);
$pdf->multicell(60, 6,"D.O.I",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 6,"Signature/Date",1,'C');
$y=$y+6;
$pdf->SetXY(10,$y);
$pdf->SetFont('Arial', 'B', 9);
$pdf->multicell(20,10,"", 1,'C');
$pdf->SetXY(30,$y);
$pdf->multicell(70, 10,"",1,'C');

$pdf->SetXY(100,$y);
$pdf->multicell(60, 10,"",1,'C');
$pdf->SetXY(160,$y);
$pdf->multicell(40, 10,"",1,'C');













// $pdf->SetFont('Arial', '', 10);
// $YBottom=$pdf->GETY()+5;
// $pdf->SetXY(10,$YBottom+5);
// $pdf->multicell(190, 5,"I have read all the regulations and it's amendments in regard to examination. I found myself eligible to appear in examination. In case university declare me ineligible due to any wrong information submitted in examination form by me, i shall be responsible for its consequences.",0,'L');
// $YBottom=$pdf->GETY();
// $pdf->SetXY(10,$YBottom+10);
// $pdf->SetFont('Arial', 'B', 10);
// // $imageUrl = 'http://10.0.10.11/images/signature/'.$IDNo.'.PNG';
// // if($imageUrl!=''){
// // $type = pathinfo($imageUrl, PATHINFO_EXTENSION);
// // $data = file_get_contents($imageUrl);
// // $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
// // $info = getimagesize($base64);
// // $extension = explode('/', mime_content_type($base64))[1];
// // $pdf-> Image($base64,48,$YBottom+2,30,10,$extension);
// // $pdf->multicell(190, 5,"Candidate Signature",0,'L');
// // }
// // else{

//     $pdf->multicell(190, 5,"Candidate Signature.............................",0,'L');
// // }

// $pdf->SetXY(10,$YBottom+15);
// $pdf->SetFont('Arial', '', 10);
// // $pdf->multicell(190, 5,"Date ".$SubmitDate,0,'R');
// $pdf->SetFont('Arial', 'B', 10);
// $YBottom=$pdf->GETY();
// $pdf->SetFont('Arial', '', 10);
// $pdf->SetXY(10,$YBottom+5);
// $pdf->multicell(190, 5,"Certified that the Candidate has completed the prescribed course of study and fulfilled all the conditions laid down in the regulations for the examination and is eligible to appear in the examination as a regular student of Guru Kashi University.The candidate bears a good moral character and particulars filled by him/her are correct.",0,'L');
// $YBottom=$pdf->GETY();
// $pdf->SetXY(10,$YBottom+5);
// // $pdf->multicell(190, 6,"Head of Department",0,'L');
// $pdf->SetXY(10,$YBottom+15);
// $pdf->SetFont('Arial', 'B', 10);
// $pdf->multicell(190, 5,"Signature of the Dean",0,'R');

    }
// }
$pdf->Output();