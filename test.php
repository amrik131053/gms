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
  $reg_id = $filesop[0];
  // echo  $reg_id1 =$filesop[1];

    //echo  $reg_id2 = (int)$filesop[2];
    //echo  $reg_id3 = $filesop[3];

//echo $query1="INSERT into StudentRegistrationForm (Session,IDNo,Status,SemesterId) Values('$reg_id','$reg_id1','$reg_id2','$reg_id3')";

  $query1="Select CollegeName,Course,IDNo,UniRollNo,StudentName,FatherName,EmailID,StudentMobileNo  from Admissions where  UniRollNo='$reg_id'";

$stmt2 = sqlsrv_query($conntest,$query1);

if( $stmt2  === false) {

    die( print_r( sqlsrv_errors(), true) );
}
else
{
 //$row = sqlsrv_fetch_array($stmt2);
  ?>
  <table border="1">

  <?php    while($row = sqlsrv_fetch_array($stmt2))
     {
?><tr><td><?= $row['CollegeName'];?></td><td><?= $row['Course'];?></td><td><?= $row['UniRollNo'];?></td><td><?= $row['StudentName'];?></td><td><?= $row['FatherName'];?></td><td><?= $row['EmailID'];?></td><td><?= $row['StudentMobileNo'];?></td></tr>

<!-- 
echo $Email=$row['EmailID'];
echo "<br>";-->
<?php 

}
?>
</table>
<?php 
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
