<?php 
$to = 'ratandeep2@gmail.com'; 
$from = 'gurpreetdeveloper@gku.ac.in'; 
$fromName = 'Guru Kashi University'; 
 
$subject = "Happy Birthday !!!!!!!!!!"; 

$htmlContent = '<!DOCTYPE html>

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


                <div class="card-footer row" >
             <div class="text-left">
                    
                    <img src="http://gurukashiuniversity.in/images/logo.png">
                                  
                  </div>
                   
                </div>


                
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                   
                      <h4 class="lead"><b>Dear  AMmrik Singh  </b></h4>
                

                <h5>“Guru Kashi University Wishing you a day filled with happiness and a year filled with joy. Sending you smiles for every moment of your special day.Hope your special day brings you all that your heart desires! Here`s wishing you a day full of pleasant surprises,Have a wonderful time and a very happy birthday!!!!!”  </h5>
                     

 <br>
 <h5 style="color:red">Toll free 1800-120-2624</h5>
                    </div>
                    


                     
                      
                    
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <!--<a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>-->
                    <!--<a href="http://assknk.gurukashiuniversity.co.in/data-server/sic/complaint/$file_name" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> Attachment
                    </a>-->
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
}else{ 
  // echo 'Email sending failed.'; 
}
