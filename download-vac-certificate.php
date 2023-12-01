<?php
session_start();
include 'connection/connection.php';


   //$reg_id = $_POST["id"];


 $reg_id = 5;


  $get_details = "SELECT * from vac  WHERE id= '$reg_id'";
  $result = mysqli_query($conn,$get_details);

    while($row = mysqli_fetch_array($result)){
      
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
         $univ_rollno= $row['UniRollNo'];
         $father_name = $row['FatherName'];


         $email = $row['EmailID'];
         $phone = $row['StudentMobileNo'];
         $batch = $row['Batch'];


         $college = $row['CollegeName'];
         $course = $row['Course'];


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

 $pdf->SetFont('Times','',$font_sr);
 $pdf->SetXY($srno_w,$srno_h);
$pdf->Cell(60,5,$session ,'','L');
$pdf->SetXY(25,5);


 $aa=135;
 $pdf->SetTextColor(0,0,0);
$pdf->SetFont('Times','',$font_n);
 $pdf->SetXY($name_h,$name_w);
$pdf->Cell(60,5,$name,'','C');
 $pdf->SetTextColor(0,0,0);


//$pdf->SetFont('Times','BI',$font_f);
$pdf->SetFont('Times','',$font_f);
$pdf->SetXY($fname_h,$fname_w);
$pdf->Cell(60,5,$father_name,'','L');

$pdf->SetFont('Times','',$font_r);
$pdf->SetXY($univ_rollno_h,$univ_rollno_w);
$pdf->Cell(60,5, $univ_rollno,'','L');



$pdf->SetFont('Times','',$font_clg);
$pdf->SetXY($college_h,$college_w);
$pdf->Cell(100,20,$college,'','L');

$pdf->SetXY($vcourse_h,$vcourse_w);$pdf->SetFont('Times','',$font_c);
$pdf->Cell(60,5,$vcourse,'','L');




$pdf->Output();

?>