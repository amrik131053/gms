<?php
   session_start();
   ini_set('max_execution_time', '0');
   include 'connection/connection.php';
   $code=$_GET['code'];
   if ($code==1) 
   {
   	$sel=array();
   $sel=$_GET['id_array'];
    $id=explode(",",$sel);
   //print_r($id);
   $left=5;
   $left1=88;
   $down1=5;
   $down=5;
   $count=1;
   $down11=5;
   $output = '';  
   $ctime = date("d-m-Y");
   $nowtime = strtotime($ctime);
   if(!(ISSET($_SESSION['usr'])))
    {
   header('Location:index.php'); 
   }
   else
   	{ 

   	$a=$_SESSION['usr'];
   }

   require_once('fpdf/fpdf.php');
     require_once('fpdf/fpdi.php');
   $pdf = new FPDI();
   $pdf->AddPage('P');
   
   foreach ($id as $key => $value) {
   
   if($count==1 || $count==2 || $count==3 || $count==4 || $count==5)
       {
   
    $pdf-> Image('dist\img\GGSlogo.png',$left,$down,80,10);
   $pdf-> Image('dist\img\idcardbg.png',$left,$down+44,80,6);
   $pdf-> Image('dist\img\ett_sign.png',$left+35,$down+35,18,8);
           $pdf->SetFont('Arial','B',12);
   
   
    $sql="SELECT * FROM id_card where   id='$value'";
   
   $result = mysqli_query($conn,$sql);
    $array = array();
   
   
     while($row=mysqli_fetch_array($result))
   {
   
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left+5,$down+14,20,20);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
    $pdf->SetXY($left+30,$down+13);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left+46,$down+13);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left+30,$down+18);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,'Roll No   :');
    
   $pdf->SetXY($left+46,$down+18);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,$row['classroll']);
   
      $pdf->SetXY($left+30,$down+23);
   $pdf->SetFont('Arial','B',8);
    $pdf->Write(0,'Course   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left+46,$down+23);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,$row['course']);
   
    $pdf->SetXY($left+30,$down+28);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,'Batch     :');
   
   $pdf->SetXY($left+46,$down+28);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,$row['batch']);
   //$pdf->MultiCell(80,2.1,$row['batch']);
   $pdf->SetXY($left+30,$down+33);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,'Valid Up To :');
   
    $newDate = date("d-m-Y", strtotime($row['valid']));
   $pdf->SetXY($left+50,$down+33);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,$newDate);
   
   $pdf->SetXY(18,52);
   $pdf->SetFont('Arial','',30);
   //$pdf->MultiCell(150,10,$row['college'],'','C');
   $pdf->SetXY(65,66);
   $pdf->SetFont('Arial','',30);
   // $pdf->MultiCell(200,0,'& Management');
   $pdf->SetXY($left,$down+46);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'AUTHORISED SIGNATORY','','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left,$down);
    $pdf->MultiCell(80,50,'','1','C');
   
   $pdf->SetXY($left1,$down1);
    $pdf->MultiCell(80,50,'','1','C');
     
   
    $pdf->SetXY($left1,$down1+2);
   $pdf->SetFont('Arial','B',12);
   $pdf->MultiCell(80,3,'This is a property of GGSCE','','C');
   
   $pdf->SetXY($left1+5,$down1+12);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,'F.Name     :');
   
   $pdf->SetXY($left1+23,$down1+12);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,$row['father_name']);
   
    $pdf->SetXY($left1+5,$down1+17);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,'Mobile      :');
   
   $pdf->SetXY($left1+23,$down1+17);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,$row['contact']);
   
    $dobDate = date("d-m-Y", strtotime($row['dob']));
    $pdf->SetXY($left1+5,$down1+22);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,'D.O.B        :');
   
   $pdf->SetXY($left1+23,$down1+22);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,$dobDate);
   
     
    $pdf->SetXY($left1+32,$down1+28);
   $pdf->SetFont('Arial','B',8);
   $pdf->Write(0,'Address:');
   
   $pdf->SetXY($left1,$down1+30);
   $pdf->SetFont('Arial','B',8);
   $sss=strlen($row['address'].$row['District'].$row['State'].$row['Pincode'])+2;
   if ($sss<29) 
   {
   // $pdf->SetXY($left1-20,$down1+33);
   $pdf->MultiCell(80,5,$row['address'].', '.$row['District'].',  '.$row['State'].','.$row['Pincode'],'','C');
   }
   elseif ($sss<58) 
   {
   // $pdf->SetXY($left1-20,$down1+33);
   $pdf->MultiCell(80,4,$row['address'].', '.$row['District'].', '.$row['State'].','.$row['Pincode'],'','C');
   }
   else
   {
       $pdf->SetXY($left1,$down1+30);
   $pdf->MultiCell(80,3,$row['address'].', '.$row['District'].', '.$row['State'].','.$row['Pincode'],'','C');
   }
   
   $pdf->SetXY($left1,$down1+39);
   $pdf->SetFont('Arial','B',9);
   // $pdf->Write(0,'GURU GOBIND SINGH');
   
   $pdf->MultiCell(80,3,'GURU GOBIND SINGH COLLEGE OF EDUCATION','','C');
   
   $pdf->SetXY($left1,$down1+42);
   $pdf->SetFont('Arial','B',9);
   // $pdf->Write(0,'COLLEGE OF EDUCATION');
   
   $pdf->MultiCell(80,3,'Sardulgarh Road ,Talwandi Sabo','','C');
   
   
   $pdf->SetXY($left1,$down1+45);
   $pdf->SetFont('Arial','B',9);
   $pdf->MultiCell(80,3,'Bathinda, Punjab, India (151302)','','C');
   
   
   $down1=$down1+55;
   $left=$left;
   $down=$down+55;
   
   }
   
   
   }
   
   $count++;
   $up="Update id_card set Status='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);
   }
   
   $pdf->Output();
}
elseif($code==2)
{
	$left=10;
   
  $left1=110;
   $down=10;
 $down1=5;
   $down=5;
   $count=1;
   $down11=5;
   
   $output = ''; 
$sel=array();
$sel=$_GET['id_array'];
$id=explode(",",$sel);
// print_r($id);
// echo "buss pass";
  require_once('fpdf/fpdf.php');
  require_once('fpdf/fpdi.php');
   $pdf = new FPDI();
$pdf->AddPage('P');
 foreach ($id as $key => $value) {

  // $pdf-> Image('dist\img\busspass.jpg',10,10,80,50);
         $pdf->SetFont('Arial','B',12);
   
   
    $sql="SELECT * FROM id_card where   id='$value'";
   
   $result = mysqli_query($conn,$sql);
    $array = array();
  
     while($row=mysqli_fetch_array($result))
   {


   	if ($count==1)
   	 {
$left=10;
   
  $left1=110;
   $down=10;
 $down1=5;
   $down=5;
   $count=1;
   $down11=5;

   	 	$pdf-> Image('dist\img\busspass.jpg',$left,$down,87,52);
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left+2,$down+13,17.4,20);
   
    $pdf->SetTextColor(159,39,30);
    $pdf->SetXY($left+6,$down+11);
   $pdf->SetFont('Arial','',10);
   $pdf->Write(0,'E-'.$value);
   $pdf->SetTextColor(0,0,0);
    $pdf->SetXY($left+20,$down+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left+35,$down+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left+20,$down+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Father Name   :');
    
   $pdf->SetXY($left+40,$down+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['father_name']);
   
      $pdf->SetXY($left+20,$down+21);
   $pdf->SetFont('Arial','',7);
    $pdf->Write(0,'Roll No   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left+35,$down+21);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['classroll']);
   
    $pdf->SetXY($left+20,$down+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Course     :');
   
   $pdf->SetXY($left+35,$down+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['course']);
   //$pdf->MultiCell(80,2.1,$row['atch']);


   $pdf->SetXY($left+20,$down+28);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Address  :');
   $pdf->SetXY($left+33,$down+27);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(49,3,$row['address'].' '.$row['District'],'','L');
   
  $pdf->SetXY($left+20,$down+31.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'State  :');
   $pdf->SetXY($left+31,$down+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['State'],'','L');

  $pdf->SetXY($left+52,$down+32);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Pin Code  :');
   $pdf->SetXY($left+66.5,$down+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(15,3,$row['Pincode'],'','l');

 $pdf->SetXY($left+20,$down+35);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Incharge  :');
   $pdf->SetXY($left+35,$down+34);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge'],'','L');

    $pdf->SetXY($left+20,$down+38.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Mobile  :');
   $pdf->SetXY($left+35,$down+37.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge_mobile'],'','L');

 $pdf->SetXY($left,$down+43);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Route Name  :');
   $pdf->SetXY($left+20,$down+41.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['route'],'','L');


 $pdf->SetXY($left,$down+46);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Stopage Name  :');
   $pdf->SetXY($left+22,$down+44.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['spot'],'','L');

    $newDate = date("d-m-Y", strtotime($row['pass_valid']));
   // $pdf->SetXY($left+50,$down+60);
   // $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$newDate);
   
   $pdf->SetXY($left,$down+49);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'Valid UpTo '.$newDate,'','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left,$down);
    $pdf->MultiCell(80,50,'','','C');
   		  $up="Update id_card set buspass_status ='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);
   	}
   	elseif($count==2 )
   	{

   			 	$pdf-> Image('dist\img\busspass.jpg',$left1,$down1,87,52);
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left1+2,$down1+13,17.4,20);
   $pdf->SetTextColor(159,39,30);
    $pdf->SetXY($left1+6,$down1+11);
   $pdf->SetFont('Arial','',10);
   $pdf->Write(0,'E-'.$value);
   // $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
    $pdf->SetXY($left1+20,$down1+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left1+35,$down1+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left1+20,$down1+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Father Name   :');
    
   $pdf->SetXY($left1+40,$down1+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['father_name']);
   
      $pdf->SetXY($left1+20,$down1+21);
   $pdf->SetFont('Arial','',7);
    $pdf->Write(0,'Roll No   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left1+35,$down1+21);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['classroll']);
   
    $pdf->SetXY($left1+20,$down1+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Course     :');
   
   $pdf->SetXY($left1+35,$down1+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['course']);
   //$pdf->MultiCell(80,2.1,$row['atch']);


   $pdf->SetXY($left1+20,$down1+28);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Address  :');
   $pdf->SetXY($left1+33,$down1+27);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(48,3,$row['address'].' '.$row['District'],'','L');
   
  $pdf->SetXY($left1+20,$down1+31.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'State  :');
   $pdf->SetXY($left1+31,$down1+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['State'],'','L');

  $pdf->SetXY($left1+52,$down1+32);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Pin Code  :');
   $pdf->SetXY($left1+66.5,$down1+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(15,3,$row['Pincode'],'','l');

 $pdf->SetXY($left1+20,$down1+35);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Incharge  :');
   $pdf->SetXY($left1+35,$down1+34);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge'],'','L');

    $pdf->SetXY($left1+20,$down1+38.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Mobile  :');
   $pdf->SetXY($left1+35,$down1+37.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge_mobile'],'','L');

 $pdf->SetXY($left1,$down1+43);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Route Name  :');
   $pdf->SetXY($left1+20,$down1+41.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['route'],'','L');


 $pdf->SetXY($left1,$down1+46);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Stopage Name  :');
   $pdf->SetXY($left1+22,$down1+44.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['spot'],'','L');

    $newDate = date("d-m-Y", strtotime($row['pass_valid']));
   // $pdf->SetXY($left1+50,$down1+60);
   // $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$newDate);
   
   $pdf->SetXY($left1,$down1+49);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'Valid UpTo '.$newDate,'','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left1,$down1);
    $pdf->MultiCell(80,50,'','','C');
   
     $up="Update id_card set buspass_status ='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);

   	}

 	if ($count==3)
   	 {
$left=10;
   
  $left1=110;
   $down=88;
 $down1=70;
   $down=70;
   $down11=5;
   	 	
   	 	$pdf-> Image('dist\img\busspass.jpg',$left,$down,87,52);
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left+2,$down+13,17.4,20);
   $pdf->SetTextColor(159,39,30);
    $pdf->SetXY($left+6,$down+11);
   $pdf->SetFont('Arial','',10);
   $pdf->Write(0,'E-'.$value);
   // $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
    $pdf->SetXY($left+20,$down+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left+35,$down+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left+20,$down+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Father Name   :');
    
   $pdf->SetXY($left+40,$down+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['father_name']);
   
      $pdf->SetXY($left+20,$down+21);
   $pdf->SetFont('Arial','',7);
    $pdf->Write(0,'Roll No   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left+35,$down+21);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['classroll']);
   
    $pdf->SetXY($left+20,$down+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Course     :');
   
   $pdf->SetXY($left+35,$down+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['course']);
   //$pdf->MultiCell(80,2.1,$row['atch']);


    $pdf->SetXY($left+20,$down+28);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Address  :');
   $pdf->SetXY($left+33,$down+27);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(49,3,$row['address'].' '.$row['District'],'','L');
   
  $pdf->SetXY($left+20,$down+31.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'State  :');
   $pdf->SetXY($left+31,$down+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['State'],'','L');

  $pdf->SetXY($left+52,$down+32);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Pin Code  :');
   $pdf->SetXY($left+66.5,$down+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(15,3,$row['Pincode'],'','l');

 $pdf->SetXY($left+20,$down+35);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Incharge  :');
   $pdf->SetXY($left+35,$down+34);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge'],'','L');

    $pdf->SetXY($left+20,$down+38.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Mobile  :');
   $pdf->SetXY($left+35,$down+37.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge_mobile'],'','L');

 $pdf->SetXY($left,$down+43);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Route Name  :');
   $pdf->SetXY($left+20,$down+41.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['route'],'','L');


 $pdf->SetXY($left,$down+46);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Stopage Name  :');
   $pdf->SetXY($left+22,$down+44.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['spot'],'','L');

    $newDate = date("d-m-Y", strtotime($row['pass_valid']));
   // $pdf->SetXY($left+50,$down+60);
   // $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$newDate);
   
  $pdf->SetXY($left,$down+49);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'Valid UpTo '.$newDate,'','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left,$down);
    $pdf->MultiCell(80,50,'','','C');
   		  $up="Update id_card set buspass_status ='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);
   	}
   	elseif($count==4 )
   	{

   			$pdf-> Image('dist\img\busspass.jpg',$left1,$down1,87,52);
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left1+2,$down1+13,17.4,20);
   $pdf->SetTextColor(159,39,30);
    $pdf->SetXY($left1+6,$down1+11);
   $pdf->SetFont('Arial','',10);
   $pdf->Write(0,'E-'.$value);
   // $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
    $pdf->SetXY($left1+20,$down1+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left1+35,$down1+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left1+20,$down1+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Father Name   :');
    
   $pdf->SetXY($left1+40,$down1+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['father_name']);
   
      $pdf->SetXY($left1+20,$down1+21);
   $pdf->SetFont('Arial','',7);
    $pdf->Write(0,'Roll No   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left1+35,$down1+21);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['classroll']);
   
    $pdf->SetXY($left1+20,$down1+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Course     :');
   
   $pdf->SetXY($left1+35,$down1+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['course']);
   //$pdf->MultiCell(80,2.1,$row['atch']);


  $pdf->SetXY($left1+20,$down1+28);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Address  :');
   $pdf->SetXY($left1+33,$down1+27);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(48,3,$row['address'].' '.$row['District'],'','L');
   
  $pdf->SetXY($left1+20,$down1+31.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'State  :');
   $pdf->SetXY($left1+31,$down1+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['State'],'','L');

  $pdf->SetXY($left1+48,$down1+32);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Pin Code  :');
   $pdf->SetXY($left1+62.5,$down1+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(15,3,$row['Pincode'],'','l');

 $pdf->SetXY($left1+20,$down1+35);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Incharge  :');
   $pdf->SetXY($left1+35,$down1+34);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge'],'','L');

    $pdf->SetXY($left1+20,$down1+38.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Mobile  :');
   $pdf->SetXY($left1+35,$down1+37.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge_mobile'],'','L');

 $pdf->SetXY($left1,$down1+43);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Route Name  :');
   $pdf->SetXY($left1+20,$down1+41.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['route'],'','L');


  $pdf->SetXY($left1,$down1+46);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Stopage Name  :');
   $pdf->SetXY($left1+22,$down1+44.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['spot'],'','L');

    $newDate = date("d-m-Y", strtotime($row['pass_valid']));
   // $pdf->SetXY($left1+50,$down1+60);
   // $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$newDate);
   
   $pdf->SetXY($left1,$down1+49);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'Valid UpTo '.$newDate,'','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left1,$down1);
    $pdf->MultiCell(80,50,'','','C');
     $up="Update id_card set buspass_status ='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);

   	}

if ($count==5)
   	 {
$left=10;
   
  $left1=110;
   // $down=88;
 $down1=135;
   $down=135;
   $down11=5;
   	 	
   	 	$pdf-> Image('dist\img\busspass.jpg',$left,$down,87,52);
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left+2,$down+13,17.4,20);
   $pdf->SetTextColor(159,39,30);
    $pdf->SetXY($left+6,$down+11);
   $pdf->SetFont('Arial','',10);
   $pdf->Write(0,'E-'.$value);
   // $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
    $pdf->SetXY($left+20,$down+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left+35,$down+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left+20,$down+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Father Name   :');
    
   $pdf->SetXY($left+40,$down+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['father_name']);
   
      $pdf->SetXY($left+20,$down+21);
   $pdf->SetFont('Arial','',7);
    $pdf->Write(0,'Roll No   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left+35,$down+21);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['classroll']);
   
    $pdf->SetXY($left+20,$down+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Course     :');
   
   $pdf->SetXY($left+35,$down+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['course']);
   //$pdf->MultiCell(80,2.1,$row['atch']);


    $pdf->SetXY($left+20,$down+28);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Address  :');
   $pdf->SetXY($left+33,$down+27);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(49,3,$row['address'].' '.$row['District'],'','L');
   
  $pdf->SetXY($left+20,$down+31.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'State  :');
   $pdf->SetXY($left+31,$down+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['State'],'','L');

  $pdf->SetXY($left+52,$down+32);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Pin Code  :');
   $pdf->SetXY($left+66.5,$down+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(15,3,$row['Pincode'],'','l');

 $pdf->SetXY($left+20,$down+35);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Incharge  :');
   $pdf->SetXY($left+35,$down+34);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge'],'','L');

    $pdf->SetXY($left+20,$down+38.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Mobile  :');
   $pdf->SetXY($left+35,$down+37.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge_mobile'],'','L');

 $pdf->SetXY($left,$down+43);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Route Name  :');
   $pdf->SetXY($left+20,$down+41.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['route'],'','L');


 $pdf->SetXY($left,$down+46);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Stopage Name  :');
   $pdf->SetXY($left+22,$down+44.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['spot'],'','L');

    $newDate = date("d-m-Y", strtotime($row['pass_valid']));
   // $pdf->SetXY($left+50,$down+60);
   // $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$newDate);
   
  $pdf->SetXY($left,$down+49);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'Valid UpTo '.$newDate,'','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left,$down);
    $pdf->MultiCell(80,50,'','','C');
   		  $up="Update id_card set buspass_status ='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);
   	}
   	elseif($count==6 )
   	{

   			$pdf-> Image('dist\img\busspass.jpg',$left1,$down1,87,52);
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left1+2,$down1+13,17.4,20);
   $pdf->SetTextColor(159,39,30);
    $pdf->SetXY($left1+6,$down1+11);
   $pdf->SetFont('Arial','',10);
   $pdf->Write(0,'E-'.$value);
   // $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
    $pdf->SetXY($left1+20,$down1+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left1+35,$down1+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left1+20,$down1+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Father Name   :');
    
   $pdf->SetXY($left1+40,$down1+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['father_name']);
   
      $pdf->SetXY($left1+20,$down1+21);
   $pdf->SetFont('Arial','',7);
    $pdf->Write(0,'Roll No   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left1+35,$down1+21);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['classroll']);
   
    $pdf->SetXY($left1+20,$down1+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Course     :');
   
   $pdf->SetXY($left1+35,$down1+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['course']);
   //$pdf->MultiCell(80,2.1,$row['atch']);


  $pdf->SetXY($left1+20,$down1+28);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Address  :');
   $pdf->SetXY($left1+33,$down1+27);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(48,3,$row['address'].' '.$row['District'],'','L');
   
  $pdf->SetXY($left1+20,$down1+31.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'State  :');
   $pdf->SetXY($left1+31,$down1+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['State'],'','L');

  $pdf->SetXY($left1+48,$down1+32);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Pin Code  :');
   $pdf->SetXY($left1+62.5,$down1+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(15,3,$row['Pincode'],'','l');

 $pdf->SetXY($left1+20,$down1+35);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Incharge  :');
   $pdf->SetXY($left1+35,$down1+34);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge'],'','L');

    $pdf->SetXY($left1+20,$down1+38.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Mobile  :');
   $pdf->SetXY($left1+35,$down1+37.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge_mobile'],'','L');

 $pdf->SetXY($left1,$down1+43);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Route Name  :');
   $pdf->SetXY($left1+20,$down1+41.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['route'],'','L');


  $pdf->SetXY($left1,$down1+46);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Stopage Name  :');
   $pdf->SetXY($left1+22,$down1+44.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['spot'],'','L');

    $newDate = date("d-m-Y", strtotime($row['pass_valid']));
   // $pdf->SetXY($left1+50,$down1+60);
   // $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$newDate);
   
   $pdf->SetXY($left1,$down1+49);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'Valid UpTo '.$newDate,'','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left1,$down1);
    $pdf->MultiCell(80,50,'','','C');
   
  $up="Update id_card set buspass_status ='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);
   	}


if ($count==7)
   	 {
$left=10;
   
  $left1=110;
   // $down=88;
 $down1=200;
   $down=200;
   $down11=5;
   	 	
   	 	$pdf-> Image('dist\img\busspass.jpg',$left,$down,87,52);
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left+2,$down+13,17.4,20);
   $pdf->SetTextColor(159,39,30);
    $pdf->SetXY($left+6,$down+11);
   $pdf->SetFont('Arial','',10);
   $pdf->Write(0,'E-'.$value);
   // $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
    $pdf->SetXY($left+20,$down+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left+35,$down+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left+20,$down+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Father Name   :');
    
   $pdf->SetXY($left+40,$down+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['father_name']);
   
      $pdf->SetXY($left+20,$down+21);
   $pdf->SetFont('Arial','',7);
    $pdf->Write(0,'Roll No   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left+35,$down+21);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['classroll']);
   
    $pdf->SetXY($left+20,$down+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Course     :');
   
   $pdf->SetXY($left+35,$down+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['course']);
   //$pdf->MultiCell(80,2.1,$row['atch']);


    $pdf->SetXY($left+20,$down+28);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Address  :');
   $pdf->SetXY($left+33,$down+27);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(49,3,$row['address'].' '.$row['District'],'','L');
   
  $pdf->SetXY($left+20,$down+31.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'State  :');
   $pdf->SetXY($left+31,$down+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['State'],'','L');

  $pdf->SetXY($left+52,$down+32);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Pin Code  :');
   $pdf->SetXY($left+66.5,$down+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(15,3,$row['Pincode'],'','l');

 $pdf->SetXY($left+20,$down+35);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Incharge  :');
   $pdf->SetXY($left+35,$down+34);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge'],'','L');

    $pdf->SetXY($left+20,$down+38.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Mobile  :');
   $pdf->SetXY($left+35,$down+37.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge_mobile'],'','L');

 $pdf->SetXY($left,$down+43);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Route Name  :');
   $pdf->SetXY($left+20,$down+41.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['route'],'','L');


 $pdf->SetXY($left,$down+46);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Stopage Name  :');
   $pdf->SetXY($left+22,$down+44.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['spot'],'','L');

    $newDate = date("d-m-Y", strtotime($row['pass_valid']));
   // $pdf->SetXY($left+50,$down+60);
   // $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$newDate);
   
  $pdf->SetXY($left,$down+49);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'Valid UpTo '.$newDate,'','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left,$down);
    $pdf->MultiCell(80,50,'','','C');
   		  $up="Update id_card set buspass_status ='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);
   	}
   	elseif($count==8 )
   	{

   			$pdf-> Image('dist\img\busspass.jpg',$left1,$down1,87,52);
   $img=$row['image'];
   $pdf-> Image('http://10.0.8.10/data-server/ID_Card_images/'.$img,$left1+2,$down1+13,17.4,20);
   $pdf->SetTextColor(159,39,30);
    $pdf->SetXY($left1+6,$down1+11);
   $pdf->SetFont('Arial','',10);
   $pdf->Write(0,'E-'.$value);
   // $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
    $pdf->SetXY($left1+20,$down1+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Name      :');
   
   $pdf->SetXY($left1+35,$down1+13);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['name']);
   
    $pdf->SetXY($left1+20,$down1+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Father Name   :');
    
   $pdf->SetXY($left1+40,$down1+17);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['father_name']);
   
      $pdf->SetXY($left1+20,$down1+21);
   $pdf->SetFont('Arial','',7);
    $pdf->Write(0,'Roll No   :');
    // $pdf->MultiCell(80,0,'Course :');
   $pdf->SetXY($left1+35,$down1+21);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['classroll']);
   
    $pdf->SetXY($left1+20,$down1+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Course     :');
   
   $pdf->SetXY($left1+35,$down1+24.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,$row['course']);
   //$pdf->MultiCell(80,2.1,$row['atch']);


  $pdf->SetXY($left1+20,$down1+28);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Address  :');
   $pdf->SetXY($left1+33,$down1+27);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(48,3,$row['address'].' '.$row['District'],'','L');
   
  $pdf->SetXY($left1+20,$down1+31.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'State  :');
   $pdf->SetXY($left1+31,$down1+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['State'],'','L');

  $pdf->SetXY($left1+48,$down1+32);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Pin Code  :');
   $pdf->SetXY($left1+62.5,$down1+30.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(15,3,$row['Pincode'],'','l');

 $pdf->SetXY($left1+20,$down1+35);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Incharge  :');
   $pdf->SetXY($left1+35,$down1+34);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge'],'','L');

    $pdf->SetXY($left1+20,$down1+38.5);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Mobile  :');
   $pdf->SetXY($left1+35,$down1+37.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['incharge_mobile'],'','L');

 $pdf->SetXY($left1,$down1+43);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Route Name  :');
   $pdf->SetXY($left1+20,$down1+41.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['route'],'','L');


  $pdf->SetXY($left1,$down1+46);
   $pdf->SetFont('Arial','',7);
   $pdf->Write(0,'Stopage Name  :');
   $pdf->SetXY($left1+22,$down1+44.5);
   $pdf->SetFont('Arial','',7);
   // $pdf->Write(0,$row['address']);
   $pdf->MultiCell(43,3,$row['spot'],'','L');

    $newDate = date("d-m-Y", strtotime($row['pass_valid']));
   // $pdf->SetXY($left1+50,$down1+60);
   // $pdf->SetFont('Arial','',8);
   // $pdf->Write(0,$newDate);
   
   $pdf->SetXY($left1,$down1+49);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(80,3,'Valid UpTo '.$newDate,'','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left1,$down1);
    $pdf->MultiCell(80,50,'','','C');
   

   	}



    $count++;

      $up="Update id_card set buspass_status ='1' where id='$value'";
   $up1 = mysqli_query($conn,$up);

   $left=$left;
   $down=$down+55;
   
   }
}
  $pdf->Output();
}

  else if ($code==3) 
   {
    $sel=array();
   $sel=$_GET['id_array'];
    $id=explode(",",$sel);
   //print_r($id);
   $left=5;
   $left1=86;
   $down1=5;
   $down=5;
   $count=1;
   $down11=5;
   $output = '';  
   $ctime = date("d-m-Y");
   $nowtime = strtotime($ctime);
   if(!(ISSET($_SESSION['usr'])))
    {
   header('Location:index.php'); 
   }
   else
    { 

    $a=$_SESSION['usr'];
   }

   require_once('fpdf/fpdf.php');
     require_once('fpdf/fpdi.php');
   $pdf = new FPDI();
   $pdf->AddPage('P');
   
   foreach ($id as $key => $value) {
   
  
    $pdf-> Image('dist\img\idcard.png',$left+2,$down+2,61,15);
   $pdf-> Image('dist\img\idcardbg.png',$left,$down+104,66,6);
   // $pdf-> Image('dist\img\idcardbg.png',$left,$down+15,57,10);

   $pdf-> Image('dist\img\sign_suporting_staff.png',$left+20,$down+90,30,12);
           $pdf->SetFont('Arial','B',12);
   
   $sql="SELECT * FROM Staff where IDNo='$value'";
$result = sqlsrv_query($conntest,$sql); 
    $array = array();
while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
{
  
     // $img=$row['Snap'];
  // echo $value;
   $pdf-> Image('http://10.0.10.11:86/Images/Staff/'.$value.'.jpg',$left+20,$down+28,27,27);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left,$down+42+20);
   $pdf->SetFont('Arial','B',12);
  
    $pdf->MultiCell(66,5,$row['Name'],'0','C'); 
    
   $pdf->SetXY($left,$down+42+28);
   $pdf->SetFont('Arial','B',12);
 
    $pdf->MultiCell(66,5,$row['IDNo'],'0','C');
  
   $pdf->SetXY($left,$down+42+35);
   $pdf->SetFont('Arial','B',15);
 
    $pdf->MultiCell(66,5,$row['Designation'],'0','C');
   
   $pdf->SetXY($left,$down+105);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',8);
    $pdf->MultiCell(66,4,'AUTHORISED SIGNATORY','0','C'); 

      $pdf->SetXY($left+3,$down+18);
   
   $pdf->SetTextColor(255,255,255);
   $pdf->SetFont('Arial','',11);
    $pdf->MultiCell(50,3,'Guru Kashi University','0','C');
   
   $pdf->SetTextColor(0,0,0);
   
   $pdf->SetXY($left,$down);
    $pdf->MultiCell(66,110,'','1','C');
   
   $pdf->SetXY($left1-10,$down1);
    $pdf->MultiCell(66,110,'','1','C');

    // $pdf->SetXY($left1,$down1);
    $pdf->Line(76,$down+10,142  ,$down+10); // bottom line 
    $pdf->Line(76,$down+10.2,142  ,$down+10.2); // bottom line 

       $pdf->Line(76,$down+75,142  ,$down+75); // top line
       $pdf->Line(76,$down+75.2,142  ,$down+75.2); // top line
   
    $pdf->SetXY($left1-10,$down1+3);
   $pdf->SetFont('Arial','B',12);
   $pdf->MultiCell(66,5,'This is a property of GKU','0','C');
   
   $pdf->SetXY($left1-13+5,$down1+15);
   $pdf->SetFont('Arial','B',11);
   $pdf->Write(0,'F.Name  :');
   
   $pdf->SetXY($left1-13+23,$down1+15);
   $pdf->SetFont('Arial','B',11);
   $pdf->Write(0,$row['FatherName']);
   
   //  $pdf->SetXY($left1-13+5,$down1+22);
   // $pdf->SetFont('Arial','B',11);
   // $pdf->Write(0,'Mobile   :');
   
   // $pdf->SetXY($left1-13+23,$down1+22);
   // $pdf->SetFont('Arial','B',11);
   // $pdf->Write(0,$row['MobileNo']);
   
    $pdf->SetXY($left1-10,$down1+32);
   $pdf->SetFont('Arial','B',11);

   $pdf->MultiCell(66,5,'Address','0','C');
   
   $pdf->SetXY($left1-9,$down1+5+37);
   $pdf->SetFont('Arial','B',11);
   $sss=strlen($row['PermanentAddress'].$row['District'].$row['State'].$row['PostalCode'])+2;
   if ($sss<29) 
   {
   // $pdf->SetXY($left1-10-20,$down1+2+33);
   $pdf->MultiCell(66,2,$row['PermanentAddress'].' '.$row['District'].'  '.$row['State'].' '.$row['PostalCode'],'0','C');
   }
   elseif ($sss<58) 
   {
   // $pdf->SetXY($left1-10-20,$down1+2+33);
   $pdf->MultiCell(66,6,$row['PermanentAddress'].' '.$row['District'].' '.$row['State'].' '.$row['PostalCode'],'0','C');
   }
   else
   {
       $pdf->SetXY($left1-10,$down1+2+37);
   $pdf->MultiCell(66,7,$row['PermanentAddress'].' '.$row['District'].' '.$row['State'].' '.$row['PostalCode'],'0','C');
   }
   
   $pdf->SetXY($left1-10,$down1+40+38);
   $pdf->SetFont('Arial','B',12);
   // $pdf->Write(0,'GURU GOBIND SINGH');
   
   $pdf->MultiCell(66,3,'GURU KASHI UNIVERSITY','','C');
   
   $pdf->SetXY($left1-10,$down1+40+43);
   $pdf->SetFont('Arial','B',11);
   // $pdf->Write(0,'COLLEGE OF EDUCATION');
   
   $pdf->MultiCell(66,3,'Sardulgarh Road ,Talwandi Sabo','','C');
   
   
   $pdf->SetXY($left1-10,$down1+40+47);
   $pdf->SetFont('Arial','B',11);
   $pdf->MultiCell(66,3,'Bathinda, Punjab, India (151302)','','C');
   
     $pdf->SetXY($left1-10,$down1+40+51);
   $pdf->SetFont('Arial','B',11);
   $pdf->MultiCell(66,3,'Phone: +91 99142-83400','','C'); 

       $pdf->SetXY($left1-10,$down1+40+55);
   $pdf->SetFont('Arial','B',11);
   $pdf->MultiCell(66,3,'www.gurukashiuniversity.in','','C');
   if ($count==2 || $count==4 || $count==6 || $count==8 || $count==10 || $count==12 || $count==14) {
   $pdf->AddPage('P');
    $left=5;
   $left1=86;
   $down1=5;
   $down=5;
   }else
   {
   $down1=$down1+120;
   $left=$left;
   $down=$down+120;
 }
   $date=date('Y-m-d');
   $up="INSERT INTO suporting_staff (IDNo,Status,P_Date) values ('$value','1','$date')";
   $up1 =mysqli_query($conn,$up);
   $count++;
   }
   
   }
   $pdf->Output();
}

else
{
}
?>