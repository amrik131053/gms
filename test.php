  <?php
 include "connection/connection.php";

?>
  
  <?php 

  ini_set('max_execution_time', '0');



  //include'sendsms.php';

if(ISSET($_POST['email_imp']))
{  
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
 $a1=$filesop[0];
$a2=$filesop[1];
$a3=$filesop[2];
$a4=$filesop[3];
$a5=$filesop[4];
$a6=$filesop[5];
$a7=$filesop[6];
$a8=$filesop[7];
$a9=$filesop[8];
$a10=$filesop[9];
$a11=$filesop[10];
$a12=$filesop[11];
$a13=$filesop[12];
$a14=$filesop[13];
$a15=$filesop[14];
$a16=$filesop[15];
$a17=$filesop[16];
$a18=$filesop[17];
$a19=$filesop[18];
$a20=$filesop[19];
$a21=$filesop[20];
$a22=$filesop[21];
$a23=$filesop[22];
$a24=$filesop[23];
$a25=$filesop[24];
$a26=$filesop[25];
$a27=$filesop[26];
$a28=$filesop[27];
$a29=$filesop[28];
$a30=$filesop[29];
$a31=$filesop[30];
$a32=$filesop[31];
$a33=$filesop[32];
$a34=$filesop[33];
$a35=$filesop[34];
$a36=$filesop[35];
$a37=$filesop[36];
$a38=$filesop[38];
$a39=$filesop[39];
$a40=$filesop[40];
$a41=$filesop[41];
$a42=$filesop[42];
$a43=$filesop[43];
$a44=$filesop[44];
$a45=$filesop[45];
$a46=$filesop[46];
$a47=$filesop[47];
$a48=$filesop[48];
$a49=$filesop[49];
$a50=$filesop[50];
$a51=$filesop[51];
$a52=$filesop[52];
$a53=$filesop[53];
$a54=$filesop[54];
$a55=$filesop[55];
$a56=$filesop[56];
$a57=$filesop[57];
$a58=$filesop[58];
$a59=$filesop[59];
$a60=$filesop[60];
$a61=$filesop[61];
$a62=$filesop[62];
$a63=$filesop[63];
$a64=$filesop[64];
$a65=$filesop[65];
$a66=$filesop[66];
$a67=$filesop[67];
$a68=$filesop[68];
$a69=$filesop[69];
$a70=$filesop[70];
$a71=$filesop[71];
$a72=$filesop[72];
$a73=$filesop[73];
$a74=$filesop[74];
// $a75=$filesop[75];

	

//echo $query1="INSERT into StudentRegistrationForm (Session,IDNo,Status,SemesterId) Values('$reg_id','$reg_id1','$reg_id2','$reg_id3')";
echo "<br><br>";
 echo  $query1="
  INSERT INTO Staff
  
  
  
  
  
  
  
  
  ([CollegeName]
  ,[IDNo]
  ,[CardID]
  ,[Name]
  ,[FatherName]
  ,[MotherName]
  ,[Designation]
  ,[Department]
  ,[Type]
  ,[ShiftName]
  ,[Gender]
  ,[CorrespondanceAddress]
  ,[PermanentAddress]
  ,[ContactNo]
  ,[MobileNo]
  ,[EmailID]
  ,[DateOfBirth]
  ,[BloodGroup]
  ,[DateOfJoining]
  ,[SalaryAtJoining]
  ,[SalaryAtPresent]
  ,[Qualification]
  ,[PreviousExperience]
  ,[BankName]
  ,[BankAccountNo]
  ,[PANNo]
  ,[Snap]
  ,[Locked]
  ,[DateOfLeaving]
  ,[PF]
  ,[Security]
  ,[EmpCode]
  ,[TotalLeaves]
  ,[Level]
  ,[DesignationLevel]
  ,[AddressLine1]
  ,[AddressLine2]
  ,[AddressLine3]
  ,[SmartCardAccess]
  ,[DepartmentID]
  ,[JobStatus]
  ,[AadhaarCard]
  ,[IsPhysicallyHandicapped]
  ,[Category]
  ,[City]
  ,[District]
  ,[State]
  ,[PostalCode]
  ,[PostOffice]
  ,[Nationality]
  ,[CategoryId]
  ,[PersonalIdentificationMark]
  ,[EmergencyContactNo]
  ,[OfficialMobileNo]
  ,[OfficialEmailID]
  ,[AddressSame]
  ,[BankIFSC]
  ,[EmploymentLetter]
  ,[LeaveRecommendingAuthority]
  ,[LeaveSanctionAuthority]
  ,[DepartmentShortName]
  ,[PrecautionaryDose]
  ,[ShiftID]
  ,[CollegeId])
VALUES('$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$a9','$a10','$a11','$a12','$a13','$a14','$a15','$a16','$a17','$a18','$a19','$a20','$a21','$a22','$a23','$a24','$a25','$a26','$a27','$a28','$a29','$a30','$a31','$a32','$a33','$a34','$a35','$a36','$a37','$a38','$a39','$a40','$a41','$a42''$a43','$a44','$a45','$a46','$a47','$a48','$a49','$a50','$a51','$a52','$a53','$a54','$a55','$a56','$a57','$a58','$a59','$a60','$a61','$a62','$a63','$a64','$a65','$a66','$a67','$a68','$a69','$a70','$a71','$a72','$a73','$a74')
  )";

$stmt2 = sqlsrv_query($conntest,$query1);

if($stmt2 === false) {

  die( print_r( sqlsrv_errors(), true) );
}
}
}









// echo $sql = "UPDATE cresults SET batch='$reg_id' WHERE batch='$roll_no'";

// $sql231 = mysqli_query($replicate_old,$sql);

/*$sql = "UPDATE  Admissions SET UniRollNo = '$roll_no' WHERE ClassRollNo='$reg_id'";
   

   $list_result = sqlsrv_query($conn,$sql);


if($list_result === false) {

    die( print_r( sqlsrv_errors(), true) );
}



    

}

}




     //$name = $filesop[0];
   //  $pass = $filesop[1];     
//$phone = $filesop[0];
    // $email = $filesop[2]; 
      

/*   
$sendsms = new Sendsms("http://sms5.thinknext.co.in","A2075919440f80ba68d8d01e8335b901a","GKUniv");
$dlr_url = 'done.php';
$v_message = "Dear Candidate,
link for your online exam is  http://103.18.70.81/ptest/
login ID and Password is registered mobile Number
Test will Start at 3 PM  on dated 30.07.2020 ";


    
   $sendsms->send_sms($phone, $v_message,"done.php");
    
  

   /*
                 $to = $email; 
$from = 'online.gkuniv@gmail.com'; 
$fromName = 'Guru Kashi University'; 
 
$subject = " Interview Schedule"; 

$htmlContent = '
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title></title>
 
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://www.gurukashiuniversity.in/styles/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://www.gurukashiuniversity.in/styles/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


  <script src="https://www.gurukashiuniversity.in/styles/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://www.gurukashiuniversity.in/styles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://www.gurukashiuniversity.in/styles/dist/js/adminlte.min.js"></script>

<script src="https://www.gurukashiuniversity.in/styles/dist/js/demo.js"></script>

</head>
   <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">


                <div class="card-footer row" style="background-color: #002147;height:10px">
             <div class="text-left">
                    
                   
                                  
                  </div>
                   
                </div>


                
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                   
                      <h4 class="lead"><b>Dear '.$name.'</b></h4>
                

                <h5>
Greetings from Guru Kashi University,
Talwandi Sabo, Bathinda(Punjab).
 </h5>
                    

 <h5 style="color:#002147">

Please find the Attachment for Interview schedule
</h5>
<br>


 <a href="http://gurukashiuniversity.in/amrik/Guidelines for Interview.pdf" class="btn btn-sm bg-teal">Find the attachment
                      <i class="fas fa-comments"></i>
                    </a>

                    <br><br>
 

Thanks & Regards
<br>
Guru Kashi University<br>
Talwandi Sabo.<br>

                  </div>
                 </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <!--<a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>-->

               
<br>

                
                  </div>
                </div>
              </div>
            </div>
           
         
          </div>
        </div>
        <!-- /.card-body -->
      
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </section>';


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
//$headers .= 'Cc: welcome@example.com' . "\r\n"; 
//$headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
 
// Send email 
if(mail($to, $subject, $htmlContent, $headers)){ 
   // echo 'Email has sent successfully.'; 
}*/

/*
$sql = "UPDATE entrance_exam SET roll_no = '$roll_no' WHERE reg_id='$reg_id'";
    $result = mysqli_query($connection_web_in,$sql);
    if($result)
    {
      echo "<div class='alert alert-success'>Password is Changed Successfully</div>";
    }*/


    ?>


    <form action="" enctype="multipart/form-data" method="post">
          <input type="file" name="file_exl" class="btn btn-warning btn-xs">
          </div>
 <div class="col-sm-1">
         <button type="submit"  name='email_imp' class="btn btn-warning btn-xs">Import</button>
          </div>
</form>
<?php

//   echo  $sql1 = "{CALL USP_Get_studentbyCollegeInternalMarksDistributionPractical(66,118,3,2021,402302,'December 2022',41,'NA')}";
//     $stmt = sqlsrv_prepare($conntest,$sql1);
  
//     if (!sqlsrv_execute($stmt)) {
//           echo "Your code is fail!";
//     echo sqlsrv_errors($sql1);
//     die;
//     } 

//         $count=0;
// echo $row = sqlsrv_fetch_array($stmt);
//      while($row = sqlsrv_fetch_array($stmt)){



// print_r($row);

//}

               
                   
?>
