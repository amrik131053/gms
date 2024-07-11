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
  <style>  
  
  
        #blink { 
            font-size: 20px; 
            font-family: serif; 
            color: #008000; 
            text-align: center; 
            animation: animate  
                1.5s linear infinite; 
        } 
  
        @keyframes animate { 
            0% { 
                opacity: 0; 
            } 
  
            50% { 
                opacity: 1; 
            } 
  
            100% { 
                opacity: 0; 
            } 
        } 
    </style> 
<body class="hold-transition lockscreen"
    style="background-image: url('dist/img/slider-img01.jpg') !important;   background-repeat: no-repeat !important; background-size: cover !important;">
    <br>
    <div class="col-sm-lg-4 d-flex justify-content-center h-100">
        <!-- <div class="user_card" style="background-image:url('dist/img/flag-1.png');background-size: 410px 100px;background-repeat: no-repeat;background-position-x: center;"> -->
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <?php 
include "fastival.php";
?>
                </div>
            </div>
            <div class=" justify-content-center form_container" style="margin-top: 50px; " id="login_chnge">
                <div style="text-align: center;">
                    <h4 style="color:#223260;"><b>Login Here</b></h4>
                </div></br>

                <form action="login.php" class="sign-in-form" method="post">
                    <div class="input-group mb-3">
                        <input type="hidden" name="code" value="7">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="number" name="user" class="form-control input_user"
                            value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>"
                            placeholder="Employee ID" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password"
                            value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>"
                            name="pass" class="form-control input_pass" placeholder="Password" required>

                    </div>
                    <div class="form-group">
                        <div class=" custom-checkbox">
                            <input type="checkbox" name="remember" id="remember"
                                <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>> <label
                                style="color:#223260;">Remember me</label>
                            <label class="float-right" style="color:#223260;" onclick="forgotpassword();">Forgot
                                Password</label>
                        </div>
                    </div>
                    <button type="submit" name="login" class="btn login_btn">Login</button>
                    <center> <?php
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
                    <center>
                        <p style="margin-top:10px;color:#223260;">For any technical support, please contact
                            <br><b>78146-79220</b>
                            
                        </p>
                        <a href="https://play.google.com/store/apps/details?id=com.GKUapp&pcampaignid=web_share"><small id="blink" ><marquee><b>Download Our Android App on Google Play Store<b></marquee></small></a>
                    </center>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php }?>
<script>
function forgotpassword() {
    var code = 1;
    $.ajax({
        url: 'forgot-password.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
          $("#login_chnge").css("margin-top","0px");
            document.getElementById("login_chnge").innerHTML = response;
        }
    });
}

function backtologin() {
    var code = 2;
    $.ajax({
        url: 'forgot-password.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
          $("#login_chnge").css("margin-top","50px");
            document.getElementById("login_chnge").innerHTML = response;
        }
    });
}
function recoverPassword() {
    var username = document.getElementById("username").value;
    var email_id = document.getElementById("email_id").value;
    if (username != '' && email_id != '') {
        $('.spinner-border').show();
        $.ajax({
            url: 'forgot-password-action.php',
            type: 'POST',
            data: {
                email_id: email_id,
                username: username
            },
            success: function(response) {
                $('.spinner-border').hide();
                if (response == 1) {
                    $('#errorMsg').css('color', 'green');
                    $('#errorMsg').html('Your Password has been sent to your email id!');
                } else if (response == 2) {
                    $('#errorMsg').css('color', 'red');
                    $('#errorMsg').html('Failed to Recover your password, try again');
                } else if (response == 3) {
                    $('#errorMsg').css('color', 'red');
                    $('#errorMsg').html('But Mail could not be sent. Mailer Error');
                } else if (response == 4) {
                    $('#errorMsg').css('color', 'red');
                    $('#errorMsg').html(
                        'Kindly provide the right information. Registered Email ID and Employee ID does not match in database'
                        );
                }
            }
        });
    } else {
        if(username!='' && email_id=='' )
        {
        $('#errorMsg').css('color', 'red');
                    $('#errorMsg').html(
                        'Oops! Enter  Email ID'
                        );
                    }
                    else if(username=='' && email_id!='')
                    {
                        $('#errorMsg').css('color', 'red');
                    $('#errorMsg').html(
                        'Oops! Enter  Employee ID'
                        );
                    }
                    else{
                        $('#errorMsg').css('color', 'red');
                    $('#errorMsg').html(
                        'Oops! Enter Employee ID and Email ID'
                        );
                    }
    }
}
</script>