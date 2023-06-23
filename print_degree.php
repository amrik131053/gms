<?php 
  	require_once('fpdf/fpdf.php');
	require_once('fpdf/fpdi.php');
   date_default_timezone_set("Asia/Kolkata");  
   include 'connection/connection.php';
      $code=$_POST['code'];

   if ($code==1) {
      $id=$_POST['p_id'];
   // echo "label";
   $pdf = new FPDI('L');
   $pdf->AddPage('L');
 $degree="SELECT * FROM degree_print where id='$id'";                     
                     $degree=mysqli_query($conn,$degree);
                     if ($degree_row=mysqli_fetch_array($degree)) 
                     {
                          $name=$degree_row['StudentName'];
                          $father_name=$degree_row['FatherName'];
                          $mother_name=$degree_row['MotherName'];
                          $UnirollNo=$degree_row['UniRollNo'];
                          $course=strtoupper($degree_row['Course']);
                          $CGPA=$degree_row['CGPA'];
                          $ExtraRow=$degree_row['ExtraRow'];
                          $Examination=$degree_row['Examination'];
                          $RegistrationNo=$degree_row['RegistrationNo'];
                        }
                         // $pdf->Image('degree_format1.jpg',10,10,280,190); 
                         $pdf->SetFont('Times','B',12);          
                         $pdf->SetFillColor(255,0,0);
                         $pdf->SetXY(25,16);
                         $pdf->MultiCell(250, 10,'Registration No.'.$RegistrationNo, 0, 'R'); 
                         $pdf->SetXY(25,22);
                         $pdf->MultiCell(250, 10,'University Roll No.'.$UnirollNo, 0, 'R');  

                         $pdf->Image('qr_code_barcode.jpg',35,38,23,23); 


                        $pdf->Image('http://10.0.10.11/Images/Students/9618225325.PNG',245,32,24,24); 


                          $pdf->SetXY(25,100);
                         $pdf->SetFont('Times','B',25);          
                         $pdf->SetTextColor(255,3,0);
                         $pdf->MultiCell(250, 10, $course, 0, 'C');            
                         $pdf->SetFont('Times','B',15);          
                         $pdf->SetXY(15,115);
                          $pdf->SetTextColor(0,0,0);
                         $pdf->MultiCell(260,9,'Mr./Ms. '.$name.'  Son/daughter of '.$father_name.' ,having completed the requirments of award of this Diploma and having the  prescribed examination held in '.$Examination.'   has been conferred with the '.$course.'  with CGPA '.$CGPA.' on scale of 10',0,'L');
                        $pdf->SetXY(15,145);
                        $pdf->MultiCell(260,6,$ExtraRow,0,'L');
                        $pdf->SetXY(15,155);
                        $pdf->MultiCell(260,6,'Given under the seal of the University',0,'C');
                        $pdf->SetXY(20,188);
                         $pdf->SetFont('Times','B',14);          
                        $pdf->MultiCell(90,1,'CONTROLLER OF EXAMINATION',0,'L');
                        $pdf->SetXY(115,188);

                        $pdf->MultiCell(90,1,'REGISTRAR',0,'C');
                        $pdf->SetXY(205,188);

                        $pdf->MultiCell(90,1,'PRO VICE CHANCELLOR',0,'L');
   $pdf->Output();


   }
   elseif($code==2)
   {
       $start=$_POST['start'];
       $end=$_POST['end'];
   // echo "label";
   $pdf = new FPDI('L');

   
 $degree="SELECT * FROM degree_print where UniRollNo BETWEEN $start and $end ";                     
                     $degree=mysqli_query($conn,$degree);
                     while ($degree_row=mysqli_fetch_array($degree)) 
                     {
                        $pdf->AddPage('L');
                          $name=$degree_row['StudentName'];
                          $father_name=$degree_row['FatherName'];
                          $mother_name=$degree_row['MotherName'];
                          $UnirollNo=$degree_row['UniRollNo'];
                          $course=strtoupper($degree_row['Course']);
                          $CGPA=$degree_row['CGPA'];
                          $ExtraRow=$degree_row['ExtraRow'];
                          $Examination=$degree_row['Examination'];
                          $RegistrationNo=$degree_row['RegistrationNo'];
                     
                         // $pdf->Image('degree_format1.jpg',10,10,280,190); 
                         $pdf->SetFont('Times','B',12);          
                         $pdf->SetFillColor(255,0,0);
                         $pdf->SetXY(25,16);
                         $pdf->MultiCell(250, 10,'Registration No.'.$RegistrationNo, 0, 'R'); 
                         $pdf->SetXY(25,22);
                         $pdf->MultiCell(250, 10,'University Roll No.'.$UnirollNo, 0, 'R');  





                         $pdf->Image('qr_code_barcode.jpg',35,38,23,23); 
                         $pdf->Image('http://erp.gku.ac.in/Images/Students/9618225325.PNG',245,32,24,24); 
                          $pdf->SetXY(25,100);
                         $pdf->SetFont('Times','B',25);          
                         $pdf->SetTextColor(255,3,0);
                         $pdf->MultiCell(250, 10, $course, 0, 'C');            
                         $pdf->SetFont('Times','B',15);          
                         $pdf->SetXY(15,115);
                          $pdf->SetTextColor(0,0,0);
                         $pdf->MultiCell(260,9,'Mr./Ms. '.$name.'  Son/daughter of '.$father_name.' ,having completed the requirments of award of this Diploma and having the  prescribed examination held in '.$Examination.'   has been conferred with the '.$course.'  with CGPA '.$CGPA.' on scale of 10',0,'L');
                        $pdf->SetXY(15,145);
                        $pdf->MultiCell(260,6,$ExtraRow,0,'L');
                        $pdf->SetXY(15,155);
                        $pdf->MultiCell(260,6,'Given under the seal of the University',0,'C');
                        $pdf->SetXY(20,188);
                         $pdf->SetFont('Times','B',14);          
                        $pdf->MultiCell(90,1,'CONTROLLER OF EXAMINATION',0,'L');
                        $pdf->SetXY(115,188);

                        $pdf->MultiCell(90,1,'REGISTRAR',0,'C');
                        $pdf->SetXY(205,188);

                        $pdf->MultiCell(90,1,'PRO VICE CHANCELLOR',0,'L');
}
   $pdf->Output();

   }
  
              



 

?>