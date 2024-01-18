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
    require_once('fpdf/forcejustify.php');


 
 
// initiate FPDI
$pdf = new FPDI('L');


// add a page
$pdf->AddPage($layout);

//$pdf->AddPage('L');

//$pdf->setSourceFile('../gkuadmin/buspass/images/2.pdf');


//$tplIdx = $pdf->importPage(1);
//$pdf->useTemplate($tplIdx);
 

 

 $pdf->Image('http://gurukashiuniversity.co.in/data-server/as/last.jpg',0,0,$width,$height);

 $pdf->SetFont('Arial','',$font_sr);



 $aa=135;
 $pdf->SetTextColor(0,0,0);

$pdf->SetFont('Arial','',$font_n);

 $pdf->SetXY(20,90);
 $pdf->SetTextColor(231,161,55);
 $pdf->SetFont('Arial','',32);
$pdf->MultiCell(270,5,$name,'','C');

 $pdf->SetXY(20,105);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetFont('Arial','',18);
 $pdf->MultiCell(257,12,"in recognition of their dedication, commitment, and successful completion of the online course  Fundamental of Digital Marketing . The duration of course was from August 2023 to  December 2023 with 3 hours a week.",'0','C','0');






if($dean!='')
{


 $pic = 'data:image/jpeg;base64,'.base64_encode($dean);

$info = getimagesize($pic);

 $extension = explode('/', mime_content_type($pic))[1];

 $pdf->SetXY(30,185); 
  $pdf->SetFont('Arial','',14);

$pdf->MultiCell(80,3,"Course Coordinator" ,'','C');


//$pdf-> Image($pic,40,170,40,13,$extension);


}


if($head!='')
{


 $pic = 'data:image/jpeg;base64,'.base64_encode($head);

$info = getimagesize($pic);

 $extension = explode('/', mime_content_type($pic))[1];
$pdf->SetXY(210,185); 
  $pdf->SetFont('Arial','',14);

$pdf->MultiCell(80,3,"Director" ,'','C');

//$pdf-> Image($pic,219,170.8,40,13,$extension);

}








$pdf->Output();

?>