<?php 
session_start();
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Guru Kashi University</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
       <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<style type="text/css">
        /* Coded with love by Mutiullah Samim */
        body,
        html {
            margin: 0;
            padding: 0;
            height: ;
            background: ;
        }
        .user_card {
            height: 450px;
            width: 380px;
            margin-top: auto;
            margin-bottom: auto;
            background: white;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius:;

        }
        .brand_logo_container {
            position: absolute;
            height: 170px;
            width: 170px;
            top: -100px;
            border-radius: 50%;
            background:#223260 ;
            padding: 10px;
            text-align: center;
             box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            
            
        }
        .brand_logo {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            border: 2px solid white;
            
        }
        .form_container {
            margin-top: 100px;
            padding: 20px;
        }
        .login_btn {
            width: 100%;
            background: #223260 !important;
            color: white !important;
        }
        .login_btn:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

      

        .login_container {
            padding: 0 2rem;
        }
        .input-group-text {
            background: #223260 !important;
            color: white !important;
            border: 0 !important;
            border-radius: 0.25rem 0 0 0.25rem !important;

        }
        .input_user,
        .input_pass:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }
        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #223260 !important;


        }
  





}

</style>

<body class="hold-transition lockscreen" style="background-image: url('dist/img/slider-img01.jpg') !important;   background-repeat: no-repeat !important; background-size: cover !important;">
<br>


<div class="col-sm-lg-4 d-flex justify-content-center h-100">
      <div class="user_card" >
        <div class="d-flex justify-content-center">
          <div class="brand_logo_container" >
            <img src="dist/img/logo.jpg" class="brand_logo" alt="Logo">
          </div>
        </div>
        <div class=" justify-content-center form_container" style="margin-top: 50px; " id="login_chnge">
          
            <div  style="text-align: center;">
              <h4>Login Here</h4>
           </div></br>
         
        <form action="login.php" class="sign-in-form" method="post">
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
             <input type="checkbox" name="remember" id="remember"   <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?> > <label>Remember me</label>
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
           <center> <p style="margin-top:30px;">For any technical support, please contact <br><b>78146-79220</b></p></center>
         
          
          </form>
        </div>
        


    </div>
</div>
</body>
<!-- /.center -->

<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--Model Popup ends-->
 


