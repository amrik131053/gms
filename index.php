<?php 
session_start();

 if(isset($_SESSION['usr']))
{
header('Location:Dashboard.php');

}
else
{


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
      <div class="user_card">
        <div class="d-flex justify-content-center" >
          <div class="brand_logo_container" >
<?php 
include "fastival.php";
?>
           
           

          </div>
        </div>
        <div class=" justify-content-center form_container" style="margin-top: 50px; " id="login_chnge" >
          
            <div  style="text-align: center;" >
              <h4 style="color:#223260;">Login Here</h4>
           </div></br>
         
        <form action="login.php" class="sign-in-form" method="post" >
            <div class="input-group mb-3">
                 <input type="hidden" name="code" value="7">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="user" class="form-control input_user" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" placeholder="Employee ID" required>
            </div>
            <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>" name="pass" class="form-control input_pass"  placeholder="Password" required>

            </div>
            <div class="form-group">
              <div class=" custom-checkbox">
             <input type="checkbox" name="remember" id="remember"   <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> > <label  style="color:#223260;">Remember me</label>
            <a href="forgot-password.php"><label class="float-right" style="color:#223260;">Forgot Password</label></a>
              </div>
            </div>
             
          <button type="submit"  name="login" class="btn login_btn">Login</button>
         <center>  <?php
                    if(isset($_SESSION['incorrect']))
                    {
                        echo $_SESSION['incorrect'];
                    }
                    unset($_SESSION['incorrect']);
                    if(isset($_SESSION['not_valid']))
                    {
                        echo $_SESSION['not_valid'];
                    }   
                    unset($_SESSION['not_valid']);
                ?></center>
           <center> <p style="margin-top:30px;color:#223260;">For any technical support, please contact <br><b>78146-79220</b></p></center>
         
          
          </form>
        </div>

    </div>
</div>
</body>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 
<?php }?>

