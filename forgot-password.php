<?php 
session_start();
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Guru Kashi University</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
       <link rel="stylesheet" href="dist/css/adminlte.min.css">
       <link rel="stylesheet" href="dist/css/index-page.css">
</head>
<body class="hold-transition lockscreen" style="background-image: url('dist/img/slider-img01.jpg') !important;   background-repeat: no-repeat !important; background-size: cover !important;">
<br>
<div class="col-sm-lg-4 d-flex justify-content-center h-100" >
      <!-- <div class="user_card" style="background-image:url('dist/img/flag-1.png');background-size: 410px 100px;background-repeat: no-repeat;background-position-x: center;"> -->
        <!-- <div class=" justify-content-center form_container" style="margin-top: 50px; " id="login_chnge" > -->
           <div class="user_card login-box">
           <div class="d-flex justify-content-center" >
          <div class="brand_logo_container" >
<?php 
include "fastival.php";
?>
          </div>
        </div>
  <div class="">
    <div class="card-header text-center">
      <h4 style="color:#223260;"><b>Forgot Password</h4>
    </div>
    <div class="card-body">
      <!-- <p class="login-box-msg" style="color:#223260;">You forgot your password? Here you can easily retrieve a new password.</p> -->
      <!-- <form  action="forgot-password-action.php"  method="post"> -->
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="number" class="form-control" name="username" id="username" placeholder="Employee ID">
        
         
          
        </div>
         
        <div class="input-group mb-3">
        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input type="email" class="form-control" name="email_id" id="email_id" placeholder="Registered Email ID.....">
         
        </div>
        
        <div class="row">
          <div class="col-12">
      
            <button type="submit" name="submit" onclick="recoverPassword();" class="btn login_btn">  <span  class="spinner-border spinner-border-sm " role="status" aria-hidden="true"  style="display:none;"></span>&nbsp;Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      <!-- </form> -->
      <p class="mt-3 mb-1">
        <a href="index.php" style="color:#223260;">Login</a>
      </p>
    </div>
    <center><b><small id="errorMsg"></small><b></center>
    <!-- /.login-card-body -->
  </div>
        </div>
    </div>
</div>
<!-- <p id="ajax-loader"></p> -->
</body>
<script>
function recoverPassword() 
{
   // alert(id);
   var username= document.getElementById("username").value;
   var email_id= document.getElementById("email_id").value;
   if(username!='' && email_id!='')
   {
    $('.spinner-border').show();
   $.ajax({
      url: 'forgot-password-action.php',
      type: 'POST',
      data: {
        email_id:email_id,username:username
      },
      success: function(response) {
         console.log(response);
        $('.spinner-border').hide();
         if(response==1)
         {  
            $('#errorMsg').css('color','green');
$('#errorMsg').html('Your Password has been sent to your email id!');
         }
         else if(response==2)
         {
            $('#errorMsg').css('color','red');
$('#errorMsg').html('Failed to Recover your password, try again');
         }
         else if(response==3)
         { 
            $('#errorMsg').css('color','red');
$('#errorMsg').html('But Mail could not be sent. Mailer Error');
         }
         else if(response==4)
         {
            $('#errorMsg').css('color','red');
$('#errorMsg').html('Kindly provide the right information. Email and Username does not match in database');
         }
        
      }
   });
}
else{

}
}
    </script>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>



















