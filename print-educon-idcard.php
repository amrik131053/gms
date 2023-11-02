<?php   
require_once('fpdf/fpdf.php');
require_once('fpdf/fpdi.php');
   date_default_timezone_set("Asia/Kolkata");  
   include 'connection/connection_web.php';
   // echo "label";
   class PDF extends FPDF
   {
   
   
      function Header()
   { 
    $this->SetTextColor(0,0,0);
    $this->SetFont('Times','b',16);
   
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
   
   // $pdf = new FPDI();
   //$pdf->setSourceFile('idcard.pdf'); 
   $pdf->SetFont('Times','B',40);
   //$pdf->setSourceFile('idcard.pdf');
   $count_idcard_manger=0;
   $count_idcard_players=0;
       
   $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND purpose='Conference Educon' ");
   $counter = 1; 
       while($row=mysqli_fetch_array($result)) 
       {
     $id = $row['slip_no'];
       $user_id = $row['user_id'];
     $payment_id = $row['payment_id'];
     $name = $row['name'];
     $father_name = $row['father_name'];
     $roll_no = $row['roll_no'];
     $course = $row['course'];
     $sem = $row['sem'];
     $batch=$row['batch'];
     $purpose=$row['purpose'];
     $remarks=$row['remarks'];
     $status=$row['status'];
     $Created_date=$row['Created_date'];
     $Created_time=$row['Created_time'];
     $amount=$row['amount'];
     $email = $row['email'];
     $phone = $row['phone'];
      $admissionstatus=$row['merge'];
       }
       $x=10;
       $y=10;
       $pdf->Image('visitor_pass.jpg',$x,$y,95,140);   
       $ls=strlen($user_id);
       if ($ls<15) {
         $pdf->MultiCell(76, 5, strtoupper($user_id),0 , 'C');  // name 
       }
       else
       {
           $pdf->SetFont('Arial','B',12);
       $pdf->MultiCell(76, 5, ucfirst($user_id),0 , 'C');  // name 
       }
           $pdf->SetTextColor(0,0,0);
       // $pdf->SetTextColor(34,50,96);
       $pdf->SetXY($x+1,$y+83);
       // $pdf->SetTextColor(255,255,255);
       $pdf->SetFont('Arial','B',12);
       $pdf->MultiCell(76, 5,$user_id,0, 'C');
       $pdf->SetXY($x+1,$y+88);
       $pdf->SetFont('Arial','B',13);
       if ($user_id==1) 
       {
       $pdf->MultiCell(76, 5,'('.$user_id.')',0, 'C'); // uni name
       }
       else
       {
       
       $pdf->MultiCell(76, 5,'Uni. Roll No. '.$user_id,0, 'C'); // uni name
       }
         
       
        $pdf->SetXY($x,$y+135.5);
        $pdf->SetFont('Arial','B',9);
       //  $pdf->SetTextColor(255,255,255);
        $testy=$pdf->GetY(); 
        $testx=$pdf->GetX()+68;
         //$pdf->MultiCell(94, 5,$s_id[$i],0 , 'R');
          $pdf->SetTextColor(0,0,0,0);
       
          $x=$x-98;
          if ($x>141) 
         {
             $y=130;
             $x=10;
         }
         if ($testy>130 && $testx<73) 
         {   
            if ($i!=$aa-1) {
               $pdf->AddPage('L');
               $x=198;
               $y=10;
           }
           
               
         }
       
    
                                         
       $pdf->Output();
       ?>