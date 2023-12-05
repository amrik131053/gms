<?php
session_start();
include 'connection/connection.php';


   $reg_id = $_POST["id"];



$dean='';
$head='';

  $get_details = "SELECT * from ValueAddedCertificate  WHERE id= '$reg_id'";
  $stmt1 = sqlsrv_query($conntest,$get_details);

      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
      $reg_id= $row['IDNo'];
      $vcourse = $row['VCourseName'];
      $cid = $row['CertificateId'];
      $session = $row['Session'];
      }
 
$result1 = "SELECT  * FROM Admissions where  IDNo='$reg_id'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
        $IDNo= $row['IDNo'];
         $name = $row['StudentName'];
         $ClassRollNo= $row['ClassRollNo'];
          $CollegeID = $row['CollegeID'];
         $CourseID= $row['CourseID'];
         $univ_rollno= $row['UniRollNo'];
         $father_name = $row['FatherName'];

         $Batch = $row['Batch'];


         $email = $row['EmailID'];
         $phone = $row['StudentMobileNo'];
         $batch = $row['Batch'];


         $college = $row['CollegeName'];
         $course = $row['Course'];


}

 $signature ="SELECT *  FROM VACertificateSignature where CollegeID='$CollegeID' ANd CourseID='$CourseID' ANd Batch='$Batch' ANd Session='$session'";

$stmt1 = sqlsrv_query($conntest,$signature);

      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
      $dean= $row['DeanSignature'];
      $head = $row['HeadSignature'];
      
      }


  



 
 $sqlwww = "SELECT * FROM certificate where Id='$cid' ";

  $result = mysqli_query($conn, $sqlwww);

    while($row = mysqli_fetch_array($result)){
      
$certificates=$row['certificate'];

      $name_h = $row['name_h'];
      $name_w = $row['name_w'];
       
     $fname_h = $row['fname_h'];
      $fname_w = $row['fname_w'];
$font_n = $row['font_n'];
$font_f = $row['font_f'];
$font_r = $row['font_n'];
$font_c = $row['font_c'];
$font_clg = $row['font_clg'];
$font_sr=$row['font_sr'];
      $univ_rollno_h = $row['univ_rollno_h'];
        $univ_rollno_w = $row['univ_rollno_w'];
      $college_h = $row['college_h'];
       $college_w = $row['college_w'];
      $vcourse_h = $row['vcourse_h'];
       $vcourse_w = $row['vcourse_w'];
       
      $srno_w = $row['srno_h'];
      $srno_h = $row['srno_w'];
        $height=$row['height'];

 $width=$row['width'];
  $layout=$row['layout'];
       
    }
  
    require_once('fpdf/fpdf.php');
  require_once('fpdf/fpdi.php');



 
 
// initiate FPDI
$pdf = new FPDI('L');


// add a page
$pdf->AddPage($layout);

//$pdf->AddPage('L');

//$pdf->setSourceFile('../gkuadmin/buspass/images/2.pdf');


//$tplIdx = $pdf->importPage(1);
//$pdf->useTemplate($tplIdx);
 

 

 $pdf->Image('http://gurukashiuniversity.co.in/data-server/VAC/'.$certificates,0,0,$width,$height);

 $pdf->SetFont('Arial','',$font_sr);

 $pdf->SetXY($srno_w,$srno_h);
$pdf->Cell(60,5,$session ,'','L');
$pdf->SetXY(25,5);


 $aa=135;
 $pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',$font_n);

 $pdf->SetXY($name_h,$name_w);
$pdf->Cell(60,5,$name,'','C');
 $pdf->SetTextColor(0,0,0);


//$pdf->SetFont('Arial','BI',$font_f);
$pdf->SetFont('Arial','',$font_f);
$pdf->SetXY($fname_h,$fname_w);
$pdf->Cell(60,5,$father_name,'','L');

$pdf->SetFont('Arial','',$font_r);
$pdf->SetXY($univ_rollno_h,$univ_rollno_w);
$pdf->Cell(60,5, $univ_rollno,'','L');



$pdf->SetFont('Arial','',$font_clg);
$pdf->SetXY($college_h,$college_w);
$pdf->Cell(100,20,$college,'','L');




$pdf->SetXY($vcourse_h,$vcourse_w);

$pdf->SetFont('Arial','',$font_c);
$pdf->Cell(60,5,$vcourse,'','L');


if($dean!='')
{


 $pic = 'data:image/jpeg;base64,'.base64_encode($dean);

$info = getimagesize($pic);

 $extension = explode('/', mime_content_type($pic))[1];


$pdf-> Image($pic,30,170.8,40,13,$extension);

}


if($head!='')
{


 //$pic = 'data:image/jpeg;base64,'.base64_encode($head);

$info = getimagesize($pic);

 $extension = explode('/', mime_content_type($pic))[1];


$pdf-> Image($pic,170,170.8,40,13,$extension);

}



$pdf->Output();

?>