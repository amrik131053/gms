 <?php 
   include 'phpqrcode/qrlib.php';
     date_default_timezone_set("Asia/Kolkata");  
     include 'connection/connection.php';
       
         
 function getOrdinalSuffix($day) {
        if ($day >= 11 && $day <= 13) {
            return "th";
        } else {
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

    $today = date("j");
    $month = date("F");
    $year = date("Y");
    $ordinalSuffix = getOrdinalSuffix($today);
 $sel=array();
   $sel=$_GET['id_array'];
    $id=explode(",",$sel);
foreach ($id as $key => $value) {

   $degree="SELECT * FROM degree_print where id='$value'";                     
                       $degree=mysqli_query($conn,$degree);
                       if ($degree_row=mysqli_fetch_array($degree)) 
                       {
                            $name=$degree_row['StudentName'];
                            $father_name=$degree_row['FatherName'];
                            $mother_name=$degree_row['MotherName'];
                            $UnirollNo=$degree_row['UniRollNo'];
                            // $gender=$degree_row['Gender'];
                            $course_head=strtoupper($degree_row['Course']);
                            $CGPA=$degree_row['CGPA'];
                            $ExtraRow=$degree_row['ExtraRow'];
                            $Examination=$degree_row['Examination'];
                            $RegistrationNo=$degree_row['RegistrationNo'];
                          $get_student_details="SELECT Snap,Batch,Sex FROM Admissions where UniRollNo='$UnirollNo'";
                          $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                          if($row_student=sqlsrv_fetch_array($get_student_details_run))
                          {
                              $snap=$row_student['Snap'];
                          }
                          }
                        $pic=base64_encode($snap);
   
                        
   
   
                        $RegNo= $degree_row['RegistrationNo'];
   $UniRollNO=$degree_row['UniRollNo'];
   $name=$degree_row['StudentName'];
   $yoa=$row_student['Batch'];
   $gender=$row_student['Sex'];
   $course=$degree_row['Course'];
   $cgpa=$degree_row['CGPA'];
   
   $text = "Course:".$course."\nYoA:".$yoa."\nName:".$name."\nRegistration No.".$RegNo."\nUniversity RollNo.".$UniRollNO."\nCGPA:".$cgpa;
   $path = 'degreeqr/';
   $file = $path.$UniRollNO.".png";
   $ecc = 'L';
   $pixel_Size = 10;
   $frame_Size = 10;
   // Generates QR Code and Stores it in directory given
   QRcode::png($text, $file, $ecc, $pixel_Size, 2); 
   

      

    

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
         
          // window.onload = function() { window.print(); }
         
           
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
         /*    onload="window.print()"*/
      </style>
      <script async src='/cdn-cgi/challenge-platform/h/b/scripts/invisible.js?ts=1650157200'></script>
   </head>
   <body style="margin:0px; background-image: url('dgree_format1.jpg');background-size: 297mm 210mm; background-repeat: no-repeat; ">
      <span class="notranslate">
         <div style="height: 74px;"></div>
         <div class="row">
            <!-- // space -->
            <div class="col-lg-12 " style="font-family: Baskerville Old Face; line-height: 1.2; width:auto; font-size: 18px; text-align:right;margin-right: 80px;margin-left: 50px;"><b><?php echo "Registration No. ".$RegistrationNo;?></b></div>
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
$ge="<strike>daughter</strike>";
$ms="<strike>Ms.</strike>";    // code...
} 
else{
$ge1="<strike>son</strike>"; 
$ms1="<strike>Mr.</strike>";    // code...
   // code...

}

 ?>

               <?php  echo $ms1."/".$ms."<b> ".$name." </b> ".$ge1."/".$ge." of <b>  ".$father_name."</b>, having completed the requirments for the award of this Diploma and having passed the prescribed examination held in <b>".$Examination."</b>   has been conferred with the<b> ".$course."</b>  with <b>CGPA ".$CGPA."</b> on scale of <b>10</b>.";?></i>
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
      <?php 
}
?>     
   </body>
</html>