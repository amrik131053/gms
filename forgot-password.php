<?php
session_start();
$code=$_POST['code'];
if($code==1)
{
    ?>

<div class="card-header text-center" >
    <h4 style="color:#223260;"><b>Forgot Password</h4>
</div>
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
    <div class="input-group mb-3">
        <button type="submit" name="submit" onclick="recoverPassword();" class="btn login_btn"> <span
                class="spinner-border spinner-border-sm " role="status" aria-hidden="true"
                style="display:none;"></span>&nbsp;Request new password</button>
                </div> 
                <div class="input-group mb-3">
                <button type="button" name="button" onclick="backtologin();" class="btn btn-danger btn-block "><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back to Login</button>
</div>      
    </div>
    <!-- /.col -->
</div>
<center><b><small id="errorMsg"></small><b></center>
<!-- /.login-card-body -->
<?php 
}
elseif($code==2)
{
  ?>
  
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
                        <p style="margin-top:30px;color:#223260;">For any technical support, please contact
                            <br><b>78146-79220</b></p>
                    </center>


                </form><?php
}

?>