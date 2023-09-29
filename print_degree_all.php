<?php 
   include 'phpqrcode/qrlib.php';
     date_default_timezone_set("Asia/Kolkata");  
     include 'connection/connection.php'; 
     ?>
     <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" class="notranslate" translate="no">
   <head>
      <meta name="google" content="notranslate" />
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <script type="text/javascript" language="javascript1.2"> 
         document.onmousedown = disableclick;
         function disableclick(e)
         {
           if(event.button == 2)
           {
             alert("Right Click Disabled");
             return false; 
           }
         }
 
      </script>
      <style type="text/css">
         @page {
         size: A4 landscape;
         margin: 0;
         }
         @media print {
         body {
         -webkit-print-color-adjust: exact;
         }
         }
         #footer {
         position: fixed;
         bottom: 93px;
         left: 0;
         width: 100%;
         height: 20px;
         }
      </style>
      <script async src='/cdn-cgi/challenge-platform/h/b/scripts/invisible.js?ts=1650157200'></script>
   </head>
   <?php
           function getOrdinalSuffix($day) {
            if ($day >= 11 && $day <= 13) 
            {
                return "th";
            } 
            else
             {
                $lastDigit = $day % 10;
                switch ($lastDigit) {
                    case 1:
                        return "st";
                    case 2:
                        return "nd";
                    case 3:
                        return "rd";
                    default:
                        return "th";
                }
            }
        }
    $code=$_GET['code'];
    // -------------------------------------------diploma degreee---------------------------------------------------
    if($code==1)
    {
        $dateColumn=$_GET['Todate'];
        $today = date("j", strtotime($dateColumn));
        $month = date("F", strtotime($dateColumn));
        $year = date("Y", strtotime($dateColumn));
        $ordinalSuffix = getOrdinalSuffix($today);
        $sel=array();
        $sel=$_GET['id_array'];
        $id=explode(",",$sel);
        foreach ($id as $key => $value)
               {
                               $degree="SELECT * FROM degree_print where id='$value'";                     
                               $degree=mysqli_query($conn,$degree);
                               if ($degree_row=mysqli_fetch_array($degree)) 
                               {
                                    $name=$degree_row['StudentName'];
                                    $father_name=$degree_row['FatherName'];
                                    $mother_name=$degree_row['MotherName'];
                                    $UnirollNo=$degree_row['UniRollNo'];
                                    $QrCourse=$degree_row['QrCourse'];
                                    if($degree_row['Course1']!='')
                                {
                                   $course_head=$degree_row['Course1'];
                                }
                                else
                                {
                                 $course_head=strtoupper($degree_row['Course']);
                                }
                                    $course=$degree_row['Course'];
                                    $CGPA=$degree_row['CGPA'];
                                    $ExtraRow=$degree_row['ExtraRow'];
                                    $Examination=$degree_row['Examination'];
                                    $RegistrationNo=$degree_row['RegistrationNo'];
                                    

                                  $get_student_details="SELECT Snap,Batch,Sex,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                  $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                  if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                  {
                                      $snap=$row_student['Snap'];
                                      if($row_student['LateralEntry']=='No')
                                      {
                                      $yoa=$row_student['Batch'];
                                   }
                                   else
                                   {
                                         $yoa=$row_student['Batch']+1;

                                      }

                                      $gender=$row_student['Sex'];
                                      $pic=base64_encode($snap);
                                      $RegNo= $degree_row['RegistrationNo'];
                                  }
                                  }
                                            $text = "Course:".$course."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                            $path = 'degreeqr/';
                                            $file = $path.$UnirollNo.".png";
                                            $ecc = 'L';
                                            $pixel_Size = 10;
                                            $frame_Size = 10;
                                            QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                ?>
         
        
           <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
              <span class="notranslate">
                 <div style="height: 74px;"></div>
                 <div class="row">
                    <!-- // space -->
                   <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php 
                        
                        if($RegistrationNo!='')
                        {
                        echo "Registration No. ".$RegistrationNo;
                        }
                        else
                        {

                        }
                        ?></b></div>
                    <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                 </div>
                 <div class="row">
                    <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                       <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                       <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
                    </div>
                 </div>
                 <div class="row">
                    <div style="height: 152px;"></div>
                    <!-- // space -->
                    <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
                 </div>
        
                 <div class="row">
                    <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                       <?php 
                          $ge1="son";
                          $ge="daughter";
                          $ms="Ms.";    
                          $ms1="Mr.";    
                          
                            if ($gender=='Male') 
                          {
                          $ge="daughter";
                          $ms="Ms.";    // code...
                          } 
                          else{
                          $ge1="son"; 
                          $ms1="Mr.";    // code...
                          } 
                       
                          $CGPA = number_format($CGPA, 2);
                           ?>
                       <?php  echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
                       having completed the requirements for the award of this Diploma and having passed the prescribed
                        examination held in <b>".$Examination."</b>   has been conferred with the<b> ".$course."</b> 
                         with <b>CGPA ".$CGPA."</b> on scale of <b>10</b>.";?></i>
                    </div>
                    <div style="height: 3px;"></div>
                    <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                       <?php  echo $ExtraRow;?>
                       </i>
                    </div>
                 </div>
                 <div style="height: 10px;"></div>
                 <div class="row">
                    <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
                 </div>
                 <div style="height: 90px;"></div>
                 <!-- // space -->
                 <div id="footer">
                    <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                       <p>
                          <b><?php  echo "CONTROLLER OF EXAMINATIONS";?></b>
                          <span style="border: ;
                             position: absolute;
                             top: 40px;
                             left: 187px; color: black!important; font-size: 14px;">
                          <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                          <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo "REGISTRAR";?></b>
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php  echo "PRO VICE CHANCELLOR";?></b>
                       </p>
                    </div>
                 </div>
              </span>
        
              <div style="page-break-before: always;"></div>
              </body>
              <?php 
                 }
    }
    // -------------------------------------------Stream degreee---------------------------------------------------
    elseif($code==2)
    {
        $dateColumn=$_GET['Todate'];
        $today = date("j", strtotime($dateColumn));
        $month = date("F", strtotime($dateColumn));
        $year = date("Y", strtotime($dateColumn));
        $ordinalSuffix = getOrdinalSuffix($today);
        $sel=array();
        $sel=$_GET['id_array'];
        $id=explode(",",$sel);
        foreach ($id as $key => $value)
               {
                               $degree="SELECT * FROM degree_print where id='$value'";                     
                               $degree=mysqli_query($conn,$degree);
                               if ($degree_row=mysqli_fetch_array($degree)) 
                               {
                                $name=$degree_row['StudentName'];
                                $father_name=$degree_row['FatherName'];
                                $mother_name=$degree_row['MotherName'];
                                $UnirollNo=$degree_row['UniRollNo'];
                                $Stream=$degree_row['Stream'];
                                $Type=$degree_row['Type'];
                                $course=$degree_row['Course'];
                                $QrCourse=$degree_row['QrCourse'];
                                   if($degree_row['Course1']!='')
                                {
                                   $course_head=$degree_row['Course1'];
                                }
                                else
                                {
                                 $course_head=strtoupper($degree_row['Course']);
                                }
                               
                                $CGPA=$degree_row['CGPA'];

                                $ExtraRow=$degree_row['ExtraRow'];
                                $Examination=$degree_row['Examination'];
                                $RegistrationNo=$degree_row['RegistrationNo'];
                                  $get_student_details="SELECT Snap,Batch,Sex,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                  $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                  if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                  {
                                      $snap=$row_student['Snap'];
                                      if($row_student['LateralEntry']=='No')
                                      {
                                      $yoa=$row_student['Batch'];
                                   }else
                                   {
                                         $yoa=$row_student['Batch']+1;

                                      }
                                      $gender=$row_student['Sex'];
                                      $pic=base64_encode($snap);
                                      $RegNo= $degree_row['RegistrationNo'];
                                  }
                                  }
                                  $CGPA = number_format($CGPA, 2);

                                                   if($RegistrationNo!='')
                                       {
                                                $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                             }
                                             else
                                             {
                                          $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegn. cum Roll No.".$UnirollNo."\nCGPA:".$CGPA;

                                       }
                                            $path = 'degreeqr/';
                                            $file = $path.$UnirollNo.".png";
                                            $ecc = 'L';
                                            $pixel_Size = 10;
                                            $frame_Size = 10;
                                            QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                ?>
       
        
           <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
      <span class="notranslate">
         <div style="height: 74px;"></div>
         <div class="row">
            <!-- // space -->
   <?php   if($RegistrationNo!='')
                        {
                         ?>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                        <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                        <?php 
                        }
                        else
                        {
                          ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                        <?php
                        }
                        ?> </div>
         <div class="row">
            <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
               <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
               <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
            </div>
         </div>
         <div class="row">
            <div style="height: 152px;"></div>
            <!-- // space -->
            <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
         </div>
         <div class="row">
            <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
<?php 
$ge1="son";
$ge="daughter";
$ms="Ms.";    
$ms1="Mr.";    

  if ($gender=='Male') 
{
$ge="<strike>daughter</strike>";
$ms="<strike>Ms.</strike>";    // code...
} 
else{
$ge1="<strike>son</strike>"; 
$ms1="<strike>Mr.</strike>";    // code...
   // code...

}


 
           
               echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>,
                having completed the requirements for the award of ".$Type." and having passed the
                 prescribed examination held in <b>".$Examination."</b>   has been conferred the
                  ".$Type." of <b> ".$course."</b>  of this University in the discipline of <b>".$Stream."</b>
                   with <b>CGPA ".$CGPA."</b> on the scale of <b>10</b> in regular mode.";
               ?></i>
            
         </div>
         <div style="height: 3px;"></div>

            <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
               <?php  //echo $ExtraRow;?>
               </i>
            </div>
         </div>
         <div style="height: 30px;"></div>

         <div class="row">
            <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
         </div>
         <div style="height: 70px;"></div>
         <!-- // space -->
            <div id="footer">
            <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
               <p>
                  <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                     <span style="border: ;
            position: absolute;
            top: 40px;
            left: 255px; color: black!important; font-size: 14px;">
         <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                  <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php//  echo "PRO VICE CHANCELLOR";?></b>
               </p>
            </div>
         </div>
      
      </span>
<div style="page-break-before: always;"></div>    
   </body>
              <?php 
                 }  

    } 
    // -----------------------------plan degree------------------------------
        elseif($code==3)
        {
         $dateColumn=$_GET['Todate'];
         $today = date("j", strtotime($dateColumn));
         $month = date("F", strtotime($dateColumn));
         $year = date("Y", strtotime($dateColumn));
         $ordinalSuffix = getOrdinalSuffix($today);
         $sel=array();
         $sel=$_GET['id_array'];
         $id=explode(",",$sel);
         foreach ($id as $key => $value)
                {
                                $degree="SELECT * FROM degree_print where id='$value'";                     
                                $degree=mysqli_query($conn,$degree);
                                if ($degree_row=mysqli_fetch_array($degree)) 
                                {
                                 $name=$degree_row['StudentName'];
                                 $father_name=$degree_row['FatherName'];
                                 $Stream=$degree_row['Stream'];
                                 $mother_name=$degree_row['MotherName'];
                                 $UnirollNo=$degree_row['UniRollNo'];
                                 $Stream=$degree_row['Stream'];
                                 $Type=$degree_row['Type'];
                                 $course=$degree_row['Course'];
                                 $QrCourse=$degree_row['QrCourse'];
                                    if($degree_row['Course1']!='')
                                 {
                                    $course_head=$degree_row['Course1'];
                                 }
                                 else
                                 {
                                  $course_head=strtoupper($degree_row['Course']);
                                 }
                                
                                 $CGPA=$degree_row['CGPA'];
                                 $ExtraRow=$degree_row['ExtraRow'];
                                 $Examination=$degree_row['Examination'];
                                 $RegistrationNo=$degree_row['RegistrationNo'];
                                   $get_student_details="SELECT Snap,Batch,Sex,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                   $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                   if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                   {
                                       $snap=$row_student['Snap'];
                                       if($row_student['LateralEntry']=='No')
                                       {
                                       $yoa=$row_student['Batch'];
                                    }else
                                    {
                                          $yoa=$row_student['Batch']+1;

                                       }
                                       $gender=$row_student['Sex'];
                                       $pic=base64_encode($snap);
                                       $RegNo= $degree_row['RegistrationNo'];
                                   }
                                   }
                                   $CGPA = number_format($CGPA, 2);
                                                    if($RegistrationNo!='')
                                       {
                                                $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                             }
                                             else
                                             {
                                          $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No. :".$UnirollNo."\nCGPA:".$CGPA;

                                       }
                                             $path = 'degreeqr/';
                                             $file = $path.$UnirollNo.".png";
                                             $ecc = 'L';
                                             $pixel_Size = 10;
                                             $frame_Size = 10;
                                             QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                 ?>
        
         
            <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
       <span class="notranslate">
          <div style="height: 74px;"></div>
          <div class="row">
             <!-- // space -->
    <?php   if($RegistrationNo!='')
                         {
                          ?>
                          <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                         <?php 
                         }
                         else
                         {
                           ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b>&nbsp;&nbsp;&nbsp;</b></div>
                           <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                         <?php
                         }
                         ?> </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
             </div>
          </div>
          <div class="row">
             <div style="height: 152px;"></div>
             <!-- // space -->
             <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
          </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
 <?php 
 $ge1="son";
 $ge="daughter";
 $ms="Ms.";    
 $ms1="Mr.";    
 
   if ($gender=='Male') 
 {
 $ge="<strike>daughter</strike>";
 $ms="<strike>Ms.</strike>";    // code...
 } 
 else{
 $ge1="<strike>son</strike>"; 
 $ms1="<strike>Mr.</strike>";    // code...
    // code...
 
 }
 
 $CGPA = number_format($CGPA,2);
  
            
 echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
 having completed the requirements for the award of ".$Type." and having passed 
 the prescribed examination held in <b>".$Examination."</b>   has been conferred the 
 ".$Type." of <b> ".$course."</b> with <b>CGPA ".$CGPA."</b> on the scale of <b>10</b> in regular mode.";
                ?></i>
             
          </div>
          <div style="height: 3px;"></div>
 
             <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                <?php  //echo $ExtraRow;?>
                </i>
             </div>
          </div>
          <div style="height: 30px;"></div>
 
          <div class="row">
             <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
          </div>
          <div style="height: 70px;"></div>
          <!-- // space -->
             <div id="footer">
             <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                <p>
                   <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                      <span style="border: ;
             position: absolute;
             top: 40px;
             left: 255px; color: black!important; font-size: 14px;">
          <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                   <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php//  echo "PRO VICE CHANCELLOR";?></b>
                </p>
             </div>
          </div>
       
       </span>
 <div style="page-break-before: always;"></div>    
    </body>
               <?php 
                  }  
        }
         //    ------------------------------------ with specialization -------------------------------
        elseif($code==4)
        {
         $dateColumn=$_GET['Todate'];
         $today = date("j", strtotime($dateColumn));
         $month = date("F", strtotime($dateColumn));
         $year = date("Y", strtotime($dateColumn));
         $ordinalSuffix = getOrdinalSuffix($today);
         $sel=array();
         $sel=$_GET['id_array'];
         $id=explode(",",$sel);
         foreach ($id as $key => $value)
                {
                                $degree="SELECT * FROM degree_print where id='$value'";                     
                                $degree=mysqli_query($conn,$degree);
                                if ($degree_row=mysqli_fetch_array($degree)) 
                                {
                                 $name=$degree_row['StudentName'];
                                 $father_name=$degree_row['FatherName'];
                                 $mother_name=$degree_row['MotherName'];
                                 $UnirollNo=$degree_row['UniRollNo'];
                                 $Stream=$degree_row['Stream'];
                                 $Type=$degree_row['Type'];
                                 $course=$degree_row['Course'];
                                 $QrCourse=$degree_row['QrCourse'];
                                    if($degree_row['Course1']!='')
                                 {
                                    $course_head=$degree_row['Course1'];
                                 }
                                 else
                                 {
                                  $course_head=strtoupper($degree_row['Course']);
                                 }
                                
                                 $CGPA=$degree_row['CGPA'];
                                 $ExtraRow=$degree_row['ExtraRow'];
                                 $Examination=$degree_row['Examination'];
                                 $RegistrationNo=$degree_row['RegistrationNo'];
                                   $get_student_details="SELECT Snap,Batch,Sex,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                   $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                   if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                   {
                                       $snap=$row_student['Snap'];
                                       if($row_student['LateralEntry']=='No')
                                       {
                                       $yoa=$row_student['Batch'];
                                    }else
                                    {
                                          $yoa=$row_student['Batch']+1;

                                       }
                                       $gender=$row_student['Sex'];
                                       $pic=base64_encode($snap);
                                       $RegNo= $degree_row['RegistrationNo'];
                                   }
                                   }
                                    $CGPA = number_format($CGPA, 2);
                                                    if($RegistrationNo!='')
                                       {
                                                $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                             }
                                             else
                                             {
                                          $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegn. cum Roll No.".$UnirollNo."\nCGPA:".$CGPA;

                                       }
                                             $path = 'degreeqr/';
                                             $file = $path.$UnirollNo.".png";
                                             $ecc = 'L';
                                             $pixel_Size = 10;
                                             $frame_Size = 10;
                                             QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                 ?>
        
         
            <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
       <span class="notranslate">
          <div style="height: 74px;"></div>
          <div class="row">
             <!-- // space -->
    <?php   if($RegistrationNo!='')
                         {
                          ?>
                          <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                         <?php 
                         }
                         else
                         {
                           ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                         <?php
                         }
                         ?> </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
             </div>
          </div>
          <div class="row">
             <div style="height: 152px;"></div>
             <!-- // space -->
             <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
          </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
 <?php 
 $ge1="son";
 $ge="daughter";
 $ms="Ms.";    
 $ms1="Mr.";    
 
   if ($gender=='Male') 
 {
 $ge="<strike>daughter</strike>";
 $ms="<strike>Ms.</strike>";    // code...
 } 
 else{
 $ge1="<strike>son</strike>"; 
 $ms1="<strike>Mr.</strike>";    // code...
    // code...
 
 }
 

  
            
 echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
 having completed the requirements for the award of ".$Type." and having passed 
 the prescribed examination held in <b>".$Examination."</b>   has been conferred the 
 ".$Type." of <b> ".$course."</b> in the specialization of <b>".$Stream."</b> with <b>CGPA ".$CGPA."</b> on scale of <b>10</b> in regular mode..";

                ?></i>
             
          </div>
          <div style="height: 3px;"></div>
 
             <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                <?php  //echo $ExtraRow;?>
                </i>
             </div>
          </div>
          <div style="height: 30px;"></div>
 
          <div class="row">
             <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
          </div>
          <div style="height: 70px;"></div>
          <!-- // space -->
             <div id="footer">
             <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                <p>
                   <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                      <span style="border: ;
             position: absolute;
             top: 40px;
             left: 255px; color: black!important; font-size: 14px;">
          <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                   <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php//  echo "PRO VICE CHANCELLOR";?></b>
                </p>
             </div>
          </div>
       
       </span>
 <div style="page-break-before: always;"></div>    
    </body>
               <?php 
                  } 
        }
         //    ------------------------------------ Ph.D Degree -------------------------------
        elseif($code==5)
        {
            $dateColumn=$_GET['Todate'];
            $today = date("j", strtotime($dateColumn));
            $month = date("F", strtotime($dateColumn));
            $year = date("Y", strtotime($dateColumn));
            $ordinalSuffix = getOrdinalSuffix($today);
            $sel=array();
            $sel=$_GET['id_array'];
            $id=explode(",",$sel);
            foreach ($id as $key => $value)
                   {
                                   $degree="SELECT * FROM degree_print where id='$value'";                     
                                   $degree=mysqli_query($conn,$degree);
                                   if ($degree_row=mysqli_fetch_array($degree)) 
                                   {
                                    $name=$degree_row['StudentName'];
                                    $father_name=$degree_row['FatherName'];
                                    $mother_name=$degree_row['MotherName'];
                                    $UnirollNo=$degree_row['UniRollNo'];
                                    $Stream=$degree_row['Stream'];
                                    $Type=$degree_row['Type'];
                                    $course_head="Doctor of Philosophy";
                                    $course=$degree_row['Course'];
                                    $CGPA=$degree_row['CGPA'];
                                    $ExtraRow=$degree_row['ExtraRow'];
                                    $Examination=$degree_row['Examination'];
                                    $RegistrationNo=$degree_row['RegistrationNo'];
                                    $QrCourse=$degree_row['QrCourse'];
                                   
                                      $get_student_details="SELECT Snap,Batch,Sex,CollegeName,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                      $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                      if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                      {
                                          $snap=$row_student['Snap'];
                                          if($row_student['LateralEntry']=='No')
                                          {
                                          $yoa=$row_student['Batch'];
                                       }else
                                       {
                                             $yoa=$row_student['Batch']+1;

                                          }
                                          $gender=$row_student['Sex'];
                                          if($degree_row['CollegeCsv']!='')
                                          {
                                             $CollegeName=$degree_row['CollegeCsv'];
                                          }
                                          else
                                          {
                                             $CollegeName=$row_student['CollegeName'];

                                          }
                                          $pic=base64_encode($snap);
                                          $RegNo= $degree_row['RegistrationNo'];
                                      }
                                      } $CGPA = number_format($CGPA, 2);
                                                    if($RegistrationNo!='')
                                       {
                                                $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                             }
                                             else
                                             {
                                          $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegn. cum Roll No.".$UnirollNo."\nCGPA:".$CGPA;

                                       }
                                                $path = 'degreeqr/';
                                                $file = $path.$UnirollNo.".png";
                                                $ecc = 'L';
                                                $pixel_Size = 10;
                                                $frame_Size = 10;
                                                QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                    ?>
             
            
             <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
       <span class="notranslate">
          <div style="height: 74px;"></div>
          <div class="row">
             <!-- // space -->
    <?php   if($RegistrationNo!='')
                         {
                          ?>
                          <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                         <?php 
                         }
                         else
                         {
                           ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                         <?php
                         }
                         ?> </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
             </div>
          </div>
          <div class="row">
             <div style="height: 152px;"></div>
             <!-- // space -->
             <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
          </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:center; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
 <?php 
 $ge1="son";
 $ge="daughter";
 $ms="Ms.";    
 $ms1="Mr.";    
 
   if ($gender=='Male') 
 {
 $ge="<strike>daughter</strike>";
 $ms="<strike>Ms.</strike>";    // code...
 } 
 else{
 $ge1="<strike>son</strike>"; 
 $ms1="<strike>Mr.</strike>";    // code...
    // code...
 
 }
 

  
            

 echo "This is to certify that ".$ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
 and of the<b> ".$CollegeName."</b> has been awarded the Degree of <b>".$course."</b> of this University in 
 ".$Examination.";";
 
 echo "<br>";
 echo "This topic of his/her thesis was";
 echo "<br>";
 echo '"<b>'.$Stream.'</b>"';
                ?></i>
             
          </div>
          <div style="height: 3px;"></div>
 
             <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                <?php  //echo $ExtraRow;?>
                </i>
             </div>
          </div>
          <div style="height: 30px;"></div>
 
          <div class="row">
             <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
          </div>
          <div style="height: 70px;"></div>
          <!-- // space -->
             <div id="footer">
             <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                <p>
                   <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                      <span style="border: ;
             position: absolute;
             top: 40px;
             left: 255px; color: black!important; font-size: 14px;">
          <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                   <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php//  echo "PRO VICE CHANCELLOR";?></b>
                </p>
             </div>
          </div>
       
       </span>
 <div style="page-break-before: always;"></div>    
    </body>
                  <?php 
                     }
        }
         //    ------------------------------------ plan stream-------------------------------
        elseif($code==6)
        {
            $dateColumn=$_GET['Todate'];
            $today = date("j", strtotime($dateColumn));
            $month = date("F", strtotime($dateColumn));
            $year = date("Y", strtotime($dateColumn));
            $ordinalSuffix = getOrdinalSuffix($today);
            $sel=array();
            $sel=$_GET['id_array'];
            $id=explode(",",$sel);
            foreach ($id as $key => $value)
                   {
                                   $degree="SELECT * FROM degree_print where id='$value'";                     
                                   $degree=mysqli_query($conn,$degree);
                                   if ($degree_row=mysqli_fetch_array($degree)) 
                                   {
                                    $name=$degree_row['StudentName'];
                                    $father_name=$degree_row['FatherName'];
                                    $mother_name=$degree_row['MotherName'];
                                    $UnirollNo=$degree_row['UniRollNo'];
                                    $Stream=$degree_row['Stream'];
                                    $Type=$degree_row['Type'];
                                    $QrCourse=$degree_row['QrCourse'];
                                    if($degree_row['Course1']!='')
                                {
                                   $course_head=$degree_row['Course1'];
                                }
                                else
                                {
                                 $course_head=strtoupper($degree_row['Course']);
                                }
                                    $course=$degree_row['Course'];
                                    $CGPA=$degree_row['CGPA'];
                                    $ExtraRow=$degree_row['ExtraRow'];
                                    $Examination=$degree_row['Examination'];
                                    $RegistrationNo=$degree_row['RegistrationNo'];
                                      $get_student_details="SELECT Snap,Batch,Sex,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                      $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                      if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                      {
                                          $snap=$row_student['Snap'];
                                          if($row_student['LateralEntry']=='No')
                                          {
                                          $yoa=$row_student['Batch'];
                                       }else
                                       {
                                             $yoa=$row_student['Batch']+1;

                                          }
                                          $gender=$row_student['Sex'];
                                          $pic=base64_encode($snap);
                                          $RegNo= $degree_row['RegistrationNo'];
                                      }
                                      }
                                       $CGPA = number_format($CGPA, 2);
                                     
                                                       if($RegistrationNo!='')
                                       {
                                                $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                             }
                                             else
                                             {
                                          $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegn. cum Roll No.".$UnirollNo."\nCGPA:".$CGPA;

                                       }
                                             
                                                $path = 'degreeqr/';
                                                $file = $path.$UnirollNo.".png";
                                                $ecc = 'L';
                                                $pixel_Size = 10;
                                                $frame_Size = 10;
                                                QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                    ?>
             
             <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
       <span class="notranslate">
          <div style="height: 74px;"></div>
          <div class="row">
             <!-- // space -->
    <?php   if($RegistrationNo!='')
                         {
                          ?>
                          <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                         <?php 
                         }
                         else
                         {
                           ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                         <?php
                         }
                         ?> </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
             </div>
          </div>
          <div class="row">
             <div style="height: 152px;"></div>
             <!-- // space -->
             <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
          </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
 <?php 
 $ge1="son";
 $ge="daughter";
 $ms="Ms.";    
 $ms1="Mr.";    
 
   if ($gender=='Male') 
 {
 $ge="<strike>daughter</strike>";
 $ms="<strike>Ms.</strike>";    // code...
 } 
 else{
 $ge1="<strike>son</strike>"; 
 $ms1="<strike>Mr.</strike>";    // code...
    // code...
 
 }
 

  
            
 echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
 having completed the requirements for the award of  ".$Type." and having passed 
 the prescribed examination held in <b>".$Examination."</b>   has been conferred the 
 ".$Type." of <b> ".$course." (".$Stream.") "."</b> with <b>CGPA ".$CGPA."</b> on the scale of <b>10</b> in regular mode.";
                ?></i>
             
          </div>
          <div style="height: 3px;"></div>
 
             <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                <?php  //echo $ExtraRow;?>
                </i>
             </div>
          </div>
          <div style="height: 30px;"></div>
 
          <div class="row">
             <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
          </div>
          <div style="height: 70px;"></div>
          <!-- // space -->
             <div id="footer">
             <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                <p>
                   <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                      <span style="border: ;
             position: absolute;
             top: 40px;
             left: 255px; color: black!important; font-size: 14px;">
          <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                   <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php//  echo "PRO VICE CHANCELLOR";?></b>
                </p>
             </div>
          </div>
       
       </span>
 <div style="page-break-before: always;"></div>    
    </body>
                  <?php 
                     }
        }

    //    ------------------------------------ pharmacy doploma-------------------------------
        elseif($code==7)
        {
            $dateColumn=$_GET['Todate'];
            $today = date("j", strtotime($dateColumn));
            $month = date("F", strtotime($dateColumn));
            $year = date("Y", strtotime($dateColumn));
            $ordinalSuffix = getOrdinalSuffix($today);
            $sel=array();
            $sel=$_GET['id_array'];
            $id=explode(",",$sel);
            foreach ($id as $key => $value)
                   {
                                   $degree="SELECT * FROM degree_print where id='$value'";                     
                                   $degree=mysqli_query($conn,$degree);
                                   if ($degree_row=mysqli_fetch_array($degree)) 
                                   {
                                    $name=$degree_row['StudentName'];
                                    $father_name=$degree_row['FatherName'];
                                    $mother_name=$degree_row['MotherName'];
                                    $UnirollNo=$degree_row['UniRollNo'];
                                    $Stream=$degree_row['Stream'];
                                    $QrCourse=$degree_row['QrCourse'];
                                    $Type=$degree_row['Type'];
                                    if($degree_row['Course1']!='')
                                {
                                   $course_head=$degree_row['Course1'];
                                }
                                else
                                {
                                 $course_head=strtoupper($degree_row['Course']);
                                }
                                    $course=$degree_row['Course'];
                                    $CGPA=$degree_row['CGPA'];
                                    $Outof=$degree_row['Outof'];
                                    $ExtraRow=$degree_row['ExtraRow'];
                                    $Examination=$degree_row['Examination'];
                                    $RegistrationNo=$degree_row['RegistrationNo'];
                                      $get_student_details="SELECT Snap,Batch,Sex,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                      $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                      if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                      {
                                          $snap=$row_student['Snap'];
                                          if($row_student['LateralEntry']=='No')
                                          {
                                          $yoa=$row_student['Batch'];
                                       }else
                                       {
                                             $yoa=$row_student['Batch']+1;

                                          }
                                          $gender=$row_student['Sex'];
                                          $pic=base64_encode($snap);
                                          $RegNo= $degree_row['RegistrationNo'];
                                      }
                                      }
                                       $CGPA = number_format($CGPA, 2);
                                                $text = "Course:".$course."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                                $path = 'degreeqr/';
                                                $file = $path.$UnirollNo.".png";
                                                $ecc = 'L';
                                                $pixel_Size = 10;
                                                $frame_Size = 10;
                                                QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                    ?>
             
            
             <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
       <span class="notranslate">
          <div style="height: 74px;"></div>
          <div class="row">
             <!-- // space -->
    <?php   if($RegistrationNo!='')
                         {
                          ?>
                          <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                         <?php 
                         }
                         else
                         {
                           ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                         <?php
                         }
                         ?> </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
             </div>
          </div>
          <div class="row">
             <div style="height: 152px;"></div>
             <!-- // space -->
             <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
          </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
 <?php 
 $ge1="son";
 $ge="daughter";
 $ms="Ms.";    
 $ms1="Mr.";    
 
   if ($gender=='Male') 
 {
 $ge="<strike>daughter</strike>";
 $ms="<strike>Ms.</strike>";    // code...
 } 
 else{
 $ge1="<strike>son</strike>"; 
 $ms1="<strike>Mr.</strike>";    // code...
    // code...
 
 }

 echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
 having completed the requirements for the award of this Diploma and having passed 
 the prescribed examination held in <b>".$Examination."</b> has been conferred the 
<b> ".$course." </b> by <b>securing ".$CGPA." marks out of ".$Outof." marks, with distinction in the subjects(s) ".$Stream."</b> and has satisfactorily completed the pratical training for ".$course."<b> (Part-III)</b>.";

                ?></i>
             
          </div>
          <div style="height: 3px;"></div>
 
             <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                <?php  //echo $ExtraRow;?>
                </i>
             </div>
          </div>
          <div style="height: 30px;"></div>
 
          <div class="row">
             <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
          </div>
          <div style="height: 70px;"></div>
          <!-- // space -->
             <div id="footer">
             <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                <p>
                   <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                      <span style="border: ;
             position: absolute;
             top: 40px;
             left: 255px; color: black!important; font-size: 14px;">
          <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                   <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php//  echo "PRO VICE CHANCELLOR";?></b>
                </p>
             </div>
          </div>
       
       </span>
 <div style="page-break-before: always;"></div>    
    </body>
                  <?php 
                     }
        }
        else if($code==8)
        {
            $dateColumn=$_GET['Todate'];
            $today = date("j", strtotime($dateColumn));
            $month = date("F", strtotime($dateColumn));
            $year = date("Y", strtotime($dateColumn));
            $ordinalSuffix = getOrdinalSuffix($today);
            $sel=array();
            $sel=$_GET['id_array'];
            $id=explode(",",$sel);
            foreach ($id as $key => $value)
                   {
                                   $degree="SELECT * FROM degree_print where id='$value'";                     
                                   $degree=mysqli_query($conn,$degree);
                                   if ($degree_row=mysqli_fetch_array($degree)) 
                                   {
                                        $name=$degree_row['StudentName'];
                                        $father_name=$degree_row['FatherName'];
                                        $mother_name=$degree_row['MotherName'];
                                        $UnirollNo=$degree_row['UniRollNo'];
                                        $QrCourse=$degree_row['QrCourse'];
                                        if($degree_row['Course1']!='')
                                {
                                   $course_head=$degree_row['Course1'];
                                }
                                else
                                {
                                 $course_head=strtoupper($degree_row['Course']);
                                }
                                        $course=$degree_row['Course'];
                                        $CGPA=$degree_row['CGPA'];
                                        $ExtraRow=$degree_row['ExtraRow'];
                                        $Examination=$degree_row['Examination'];
                                        $RegistrationNo=$degree_row['RegistrationNo'];
                                      $get_student_details="SELECT Snap,Batch,Sex,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                      $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                      if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                      {
                                          $snap=$row_student['Snap'];
                                          if($row_student['LateralEntry']=='No')
                                          {
                                          $yoa=$row_student['Batch'];
                                       }else
                                       {
                                             $yoa=$row_student['Batch']+1;

                                          }
                                          $gender=$row_student['Sex'];
                                          $pic=base64_encode($snap);
                                          $RegNo= $degree_row['RegistrationNo'];
                                      }
                                      }
                                        $CGPA = number_format($CGPA, 2);
                                        
                                                $text = "Course:".$course."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                                $path = 'degreeqr/';
                                                $file = $path.$UnirollNo.".png";
                                                $ecc = 'L';
                                                $pixel_Size = 10;
                                                $frame_Size = 10;
                                                QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                    ?>
             
            
               <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
                  <span class="notranslate">
                     <div style="height: 74px;"></div>
                     <div class="row">
                  <?php  
                        
                        if($RegistrationNo!='')
                        {
                         ?>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                        <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                        <?php 
                        }
                        else
                        {
                          ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                        <?php
                        }
                        ?> </div>
                     <div class="row">
                        <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                           <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                           <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
                        </div>
                     </div>
                     <div class="row">
                        <div style="height: 152px;"></div>
                        <!-- // space -->
                        <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
                     </div>
            
                     <div class="row">
                        <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                           <?php 
                              $ge1="son";
                              $ge="daughter";
                              $ms="Ms.";    
                              $ms1="Mr.";    
                              
                                if ($gender=='Male') 
                              {
                              $ge="daughter";
                              $ms="Ms.";    // code...
                              } 
                              else{
                              $ge1="son"; 
                              $ms1="Mr.";    // code...
                              } 
                              if ($gender=='Male') 
                              {
                              $ge="<strike>daughter</strike>";
                              $ms="<strike>Ms.</strike>";    // code...
                              } 
                              else{
                              $ge1="<strike>son</strike>"; 
                              $ms1="<strike>Mr.</strike>";    // code...
                                 // code...
                              
                              }
                            
                               ?>
                           <?php  echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
                           having completed the requirements for the award of this Diploma and having passed the prescribed
                            examination held in <b>".$Examination."</b>   has been conferred with the<b> ".$course."</b> 
                             with <b>CGPA ".$CGPA."</b> on scale of <b>10</b>.";?></i>
                        </div>
                        <div style="height: 3px;"></div>
                        <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                           <?php  //echo $ExtraRow;?>
                           </i>
                        </div>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="row">
                        <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
                     </div>
                     <div style="height: 90px;"></div>
                     <!-- // space -->
                     <div id="footer">
                        <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                           <p>
                              <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                              <span style="border: ;
                                 position: absolute;
                                 top: 40px;
                                 left: 187px; color: black!important; font-size: 14px;">
                              <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                              <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php // echo "PRO VICE CHANCELLOR";?></b>
                           </p>
                        </div>
                     </div>
                  </span>
            
                  <div style="page-break-before: always;"></div>
                  </body>
                  <?php 
                     }
        }
        else if($code==9)
        {
            $dateColumn=$_GET['Todate'];
            $today = date("j", strtotime($dateColumn));
            $month = date("F", strtotime($dateColumn));
            $year = date("Y", strtotime($dateColumn));
            $ordinalSuffix = getOrdinalSuffix($today);
            $sel=array();
            $sel=$_GET['id_array'];
            $id=explode(",",$sel);
            foreach ($id as $key => $value)
                   {
                                   $degree="SELECT * FROM degree_print where id='$value'";                     
                                   $degree=mysqli_query($conn,$degree);
                                   if ($degree_row=mysqli_fetch_array($degree)) 
                                   {
                                    $name=$degree_row['StudentName'];
                                    $father_name=$degree_row['FatherName'];
                                    $mother_name=$degree_row['MotherName'];
                                    $UnirollNo=$degree_row['UniRollNo'];
                                    $Stream=$degree_row['Stream'];
                                    $Type=$degree_row['Type'];
                                    $QrCourse=$degree_row['QrCourse'];
                                    if($degree_row['Course1']!='')
                                {
                                   $course_head=$degree_row['Course1'];
                                }
                                else
                                {
                                 $course_head=strtoupper($degree_row['Course']);
                                }
                                    $course=$degree_row['Course'];
                                    $CGPA=$degree_row['CGPA'];
                                    $ExtraRow=$degree_row['ExtraRow'];
                                    $Examination=$degree_row['Examination'];
                                    $RegistrationNo=$degree_row['RegistrationNo'];
                                      $get_student_details="SELECT Snap,Batch,Sex,CollegeName,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                      $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                      if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                      {
                                          $snap=$row_student['Snap'];
                                          if($row_student['LateralEntry']=='No')
                                          {
                                          $yoa=$row_student['Batch'];
                                       }else
                                       {
                                             $yoa=$row_student['Batch']+1;

                                          }
                                          $gender=$row_student['Sex'];
                                          if($degree_row['CollegeCsv']!='')
                                          {
                                             $CollegeName=$degree_row['CollegeCsv'];
                                          }
                                          else
                                          {
                                             $CollegeName=$row_student['CollegeName'];

                                          }
                                          $pic=base64_encode($snap);
                                          $RegNo= $degree_row['RegistrationNo'];
                                      }
                                      }
                                        $CGPA = number_format($CGPA, 2);
                                                       if($RegistrationNo!='')
                                       {
                                                $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                             }
                                             else
                                             {
                                          $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegn. cum Roll No..".$UnirollNo."\nCGPA:".$CGPA;

                                       }
                                                $path = 'degreeqr/';
                                                $file = $path.$UnirollNo.".png";
                                                $ecc = 'L';
                                                $pixel_Size = 10;
                                                $frame_Size = 10;
                                                QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                    ?>
             
            
             <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
                  <span class="notranslate">
                     <div style="height: 74px;"></div>
                     <div class="row">
                  <?php  
                        
                        if($RegistrationNo!='')
                        {
                         ?>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                        <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                        <?php 
                        }
                        else
                        {
                          ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                        <?php
                        }
                        ?> </div>
                     <div class="row">
                        <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                           <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                           <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
                        </div>
                     </div>
                     <div class="row">
                        <div style="height: 152px;"></div>
                        <!-- // space -->
                        <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
                     </div>
            
                     <div class="row">
                        <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                           <?php 
                              $ge1="son";
                              $ge="daughter";
                              $ms="Ms.";    
                              $ms1="Mr.";    
                              
                                if ($gender=='Male') 
                              {
                              $ge="daughter";
                              $ms="Ms.";    // code...
                              } 
                              else{
                              $ge1="son"; 
                              $ms1="Mr.";    // code...
                              } 
                              if ($gender=='Male') 
                              {
                              $ge="<strike>daughter</strike>";
                              $ms="<strike>Ms.</strike>";    // code...
                              } 
                              else{
                              $ge1="<strike>son</strike>"; 
                              $ms1="<strike>Mr.</strike>";    // code...
                                 // code...
                              
                              }
                            
                               ?>
                          <?php  echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
                          student of <b>".$CollegeName."</b>, having completed the requirements for the award of this ".$Type." and having passed the prescribed
                            examination held in <b>".$Examination."</b>   has been conferred  the ".$Type." of<b> ".$course."</b> 
                             with <b>CGPA ".$CGPA."</b> on scale of <b>10</b>.";?></i>
                        </div>
                        <div style="height: 3px;"></div>
                        <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                           <?php  //echo $ExtraRow;?>
                           </i>
                        </div>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="row">
                        <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
                     </div>
                     <div style="height: 90px;"></div>
                     <!-- // space -->
                     <div id="footer">
                        <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                           <p>
                              <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                              <span style="border: ;
                                 position: absolute;
                                 top: 40px;
                                 left: 187px; color: black!important; font-size: 14px;">
                              <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                              <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php // echo "PRO VICE CHANCELLOR";?></b>
                           </p>
                        </div>
                     </div>
                  </span>
            
                  <div style="page-break-before: always;"></div>
                  </body>
                  <?php 
                     }
        }
      else if($code==10)
        {
            $dateColumn=$_GET['Todate'];
            $today = date("j", strtotime($dateColumn));
            $month = date("F", strtotime($dateColumn));
            $year = date("Y", strtotime($dateColumn));
            $ordinalSuffix = getOrdinalSuffix($today);
            $sel=array();
            $sel=$_GET['id_array'];
            $id=explode(",",$sel);
            foreach ($id as $key => $value)
                   {
                                   $degree="SELECT * FROM degree_print where id='$value'";                     
                                   $degree=mysqli_query($conn,$degree);
                                   if ($degree_row=mysqli_fetch_array($degree)) 
                                   {
                                    $name=$degree_row['StudentName'];
                                    $father_name=$degree_row['FatherName'];
                                    $mother_name=$degree_row['MotherName'];
                                    $UnirollNo=$degree_row['UniRollNo'];
                                    $Stream=$degree_row['Stream'];
                                    $Type=$degree_row['Type'];
                                    $QrCourse=$degree_row['QrCourse'];
                                    if($degree_row['Course1']!='')
                                {
                                   $course_head=$degree_row['Course1'];
                                }
                                else
                                {
                                 $course_head=strtoupper($degree_row['Course']);
                                }
                                    $course=$degree_row['Course'];
                                    $CGPA=$degree_row['CGPA'];
                                    $ExtraRow=$degree_row['ExtraRow'];
                                    $Examination=$degree_row['Examination'];
                                    $RegistrationNo=$degree_row['RegistrationNo'];
                                      $get_student_details="SELECT Snap,Batch,Sex,CollegeName,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                      $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                      if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                      {
                                          $snap=$row_student['Snap'];
                                          if($row_student['LateralEntry']=='No')
                                          {
                                          $yoa=$row_student['Batch'];
                                       }else
                                       {
                                             $yoa=$row_student['Batch']+1;

                                          }
                                          $gender=$row_student['Sex'];
                                          if($degree_row['CollegeCsv']!='')
                                          {
                                             $CollegeName=$degree_row['CollegeCsv'];
                                          }
                                          else
                                          {
                                             $CollegeName=$row_student['CollegeName'];

                                          }
                                          $pic=base64_encode($snap);
                                          $RegNo= $degree_row['RegistrationNo'];
                                      }
                                    //   print_r($row_student);
                                      }
                                       $CGPA = number_format($CGPA, 2);
                                                       if($RegistrationNo!='')
                                       {
                                                $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity Roll No.".$UnirollNo."\nCGPA:".$CGPA;
                                             }
                                             else
                                             {
                                          $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegn. cum Roll No..".$UnirollNo."\nCGPA:".$CGPA;

                                       }
                                                $path = 'degreeqr/';
                                                $file = $path.$UnirollNo.".png";
                                                $ecc = 'L';
                                                $pixel_Size = 10;
                                                $frame_Size = 10;
                                                QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                    ?>
             
            
                
             <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
                  <span class="notranslate">
                     <div style="height: 74px;"></div>
                     <div class="row">
                  <?php  
                        
                        if($RegistrationNo!='')
                        {
                         ?>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                        <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                        <?php 
                        }
                        else
                        {
                          ?> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No. ".$UnirollNo;?></b></div>
                        <?php
                        }
                        ?> </div>
                     <div class="row">
                        <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                           <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                           <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
                        </div>
                     </div>
                     <div class="row">
                        <div style="height: 152px;"></div>
                        <!-- // space -->
                        <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
                     </div>
            
                     <div class="row">
                        <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                           <?php 
                              $ge1="son";
                              $ge="daughter";
                              $ms="Ms.";    
                              $ms1="Mr.";    
                              
                                if ($gender=='Male') 
                              {
                              $ge="daughter";
                              $ms="Ms.";    // code...
                              } 
                              else{
                              $ge1="son"; 
                              $ms1="Mr.";    // code...
                              } 
                              if ($gender=='Male') 
                              {
                              $ge="<strike>daughter</strike>";
                              $ms="<strike>Ms.</strike>";    // code...
                              } 
                              else{
                              $ge1="<strike>son</strike>"; 
                              $ms1="<strike>Mr.</strike>";    // code...
                                 // code...
                              
                              }
                             
                               ?>
                       <?php  echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
                          student of <b>".$CollegeName."</b>, having completed the requirements for the award of this ".$Type." and having passed the prescribed
                            examination held in <b>".$Examination."</b>   has been conferred  the ".$Type." of<b> ".$course."</b> 
                            of this University in the discipline of <b>".$Stream."</b> with <b>CGPA ".$CGPA."</b> on scale of <b>10</b>.";?></i>
                        </div>
                        <div style="height: 3px;"></div>
                        <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                           <?php  //echo $ExtraRow;?>
                           </i>
                        </div>
                     </div>
                     <div style="height: 10px;"></div>
                     <div class="row">
                        <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
                     </div>
                     <div style="height: 90px;"></div>
                     <!-- // space -->
                     <div id="footer">
                        <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                           <p>
                              <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                              <span style="border: ;
                                 position: absolute;
                                 top: 40px;
                                 left: 187px; color: black!important; font-size: 14px;">
                              <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                              <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php // echo "PRO VICE CHANCELLOR";?></b>
                           </p>
                        </div>
                     </div>
                  </span>
            
                  <div style="page-break-before: always;"></div>
                  </body>
                  <?php 
                     }
        }
// plan agri
        elseif($code==11)
        {
            $dateColumn=$_GET['Todate'];
            $today = date("j", strtotime($dateColumn));
            $month = date("F", strtotime($dateColumn));
            $year = date("Y", strtotime($dateColumn));
            $ordinalSuffix = getOrdinalSuffix($today);
            $sel=array();
            $sel=$_GET['id_array'];
            $id=explode(",",$sel);
            foreach ($id as $key => $value)
                   {
                                   $degree="SELECT * FROM degree_print where id='$value'";                     
                                   $degree=mysqli_query($conn,$degree);
                                   if ($degree_row=mysqli_fetch_array($degree)) 
                                   {
                                    $name=$degree_row['StudentName'];
                                    $father_name=$degree_row['FatherName'];
                                    $mother_name=$degree_row['MotherName'];
                                    $UnirollNo=$degree_row['UniRollNo'];
                                    $Stream=$degree_row['Stream'];
                                    $Type=$degree_row['Type'];
                                    $QrCourse=$degree_row['QrCourse'];
                                    if($degree_row['Course1']!='')
                                {
                                   $course_head=$degree_row['Course1'];
                                }
                                else
                                {
                                 $course_head=strtoupper($degree_row['Course']);
                                }
                                    $course=$degree_row['Course'];
                                    $CGPA=$degree_row['CGPA'];
                                    $ExtraRow=$degree_row['ExtraRow'];
                                    $Examination=$degree_row['Examination'];
                                    $RegistrationNo=$degree_row['RegistrationNo'];
                                      $get_student_details="SELECT Snap,Batch,Sex,LateralEntry FROM Admissions where UniRollNo='$UnirollNo'";
                                      $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                                      if($row_student=sqlsrv_fetch_array($get_student_details_run))
                                      {
                                          $snap=$row_student['Snap'];
                                          if($row_student['LateralEntry']=='No')
                                          {
                                          $yoa=$row_student['Batch'];
                                       }else
                                       {
                                             $yoa=$row_student['Batch']+1;

                                          }
                                          $gender=$row_student['Sex'];
                                          $pic=base64_encode($snap);
                                          $RegNo= $degree_row['RegistrationNo'];
                                      }
                                      }
                                       $CGPA = number_format($CGPA, 2);
                                     
                                                       if($RegistrationNo!='')
                                       {
                                                $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegistration No.:".$RegNo."\nUniversity Roll No.:".$UnirollNo."\nCGPA:".$CGPA;
                                             }
                                             else
                                             {
                                          $text = "Course:".$QrCourse."\nYoA:".$yoa."\nName:".$name."\nRegn. cum Roll No.:".$UnirollNo."\nCGPA:".$CGPA;

                                       }
                                             
                                                $path = 'degreeqr/';
                                                $file = $path.$UnirollNo.".png";
                                                $ecc = 'L';
                                                $pixel_Size = 10;
                                                $frame_Size = 10;
                                                QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
                    ?>
             
             <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
       <span class="notranslate">
          <div style="height: 74px;"></div>
          <div class="row">
             <!-- // space -->
    <?php   if($RegistrationNo!='')
                         {
                          ?>
                          <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
                         <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "University Roll No. ".$UnirollNo;?></b></div>
                         <?php 
                         }
                         else
                         {
                           ?>
                           <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></div> <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right; margin-right: 80px;margin-left: 50px;"><b><?php echo "Regn. cum Roll No.".$UnirollNo;?></b></div>
                         <?php
                         }
                         ?> </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; width:auto; text-align:right;margin-right: 90px;margin-left: 50px;margin-top: 8px;">
                <img src="<?=$file;?>" width="90" height="90" style="margin-right: 704px;">
                <img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="80" height="90" style="margin-right: 12px;">
             </div>
          </div>
          <div class="row">
             <div style="height: 152px;"></div>
             <!-- // space -->
             <div class="col-lg-12 " style="border:; font-size: 33px; text-align:center; margin-right: 85px;margin-left: 67px; font-family: Baskerville Old Face; color: red;"><i><?php echo $course_head;?></i></div>
          </div>
          <div class="row">
             <div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
 <?php 
 $ge1="son";
 $ge="daughter";
 $ms="Ms.";    
 $ms1="Mr.";    
 
   if ($gender=='Male') 
 {
 $ge="<strike>daughter</strike>";
 $ms="<strike>Ms.</strike>";    // code...
 } 
 else{
 $ge1="<strike>son</strike>"; 
 $ms1="<strike>Mr.</strike>";    // code...
    // code...
 
 }
 

  
            
 echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, 
 having completed the requirements for the award of  ".$Type." and having passed 
 the prescribed examination held in <b>".$Examination."</b>   has been conferred the 
 ".$Type." of <b> ".$course." (".$Stream.") Honours  "."</b> with <b>CGPA ".$CGPA."</b> on the scale of <b>10</b> in regular mode.";
                ?></i>
             
          </div>
          <div style="height: 3px;"></div>
 
             <div class="col-lg-12 " style="border:; font-size: 19px; text-align:justify; margin-right: 85px;margin-left: 67px;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                <?php  //echo $ExtraRow;?>
                </i>
             </div>
          </div>
          <div style="height: 30px;"></div>
 
          <div class="row">
             <div class="col-lg-12 " style="border:; font-family: Baskerville Old Face; font-size: 22px; text-align:center; margin-right: 85px;margin-left: 67px;"><i><?php  echo "Given under the seal of the University";?></i></div>
          </div>
          <div style="height: 70px;"></div>
          <!-- // space -->
             <div id="footer">
             <div class="col-lg-12 " style="border:; font-size: 19px; margin-right: 80px;margin-left: 85.3px; color:#0D729C;">
                <p>
                   <b><?php // echo "CONTROLLER OF EXAMINATIONS";?></b>
                      <span style="border: ;
             position: absolute;
             top: 40px;
             left: 255px; color: black!important; font-size: 14px;">
          <?php echo  $today . "<sup>" . $ordinalSuffix . "</sup> " . $month ." ". $year; ?></span>
                   <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php // echo "REGISTRAR";?></b>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <b><?php//  echo "PRO VICE CHANCELLOR";?></b>
                </p>
             </div>
          </div>
       
       </span>
 <div style="page-break-before: always;"></div>    
    </body>
                  <?php 
                     }
        }
    ?>
         
        <!-- -------------------------------------------------------------------------------  -->

</html>