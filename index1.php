<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="dist/css/styles.css">
    <title>Guru Kashi University- LIMS</title>
</head>

<body>
    <div class="container">
        <div class="signin-signup">
            <form action="login.php" class="sign-in-form" method="post">
                <img src="dist/img/logo-login.png" alt="" class="" width="150">
                <h2 class="title">Sign in</h2>
                    <?php
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
                ?>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" name="user" required="">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="pass">
                </div>
                <input type="submit" value="Login" name="login" class="btn" required="">
                
                <br>
                <center>    <p style="margin-top:30px;">For any technical support, please contact <br><b>78146-79220</b>.</p></center>
                
               
            </form>
            <form action="" class="sign-up-form">
                <h2 class="title">Sign up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" placeholder="Email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password">
                </div>
                <!-- <input type="submit" value="Sign up" class="btn"> -->
                <p class="social-text">Or Sign in with social platform</p>
              
                <p class="account-text">Already have an account? <a href="#" id="sign-in-btn2">Sign in</a></p>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
               
                <img src="slider-img01.jpg" alt="" class="image">
            </div>
            <div class="panel right-panel">
               
                <img src="dist/img/logo-login.png" alt="" class="image">
            </div>
        </div>
    </div>
    <!-- <script src="app.js"></script> -->
</body>

</html>