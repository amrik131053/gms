<?php
ob_clean();
session_start();
date_default_timezone_set("Asia/Kolkata");
$status = 0;
$lockProfile = null;
$user = $_POST["user"];
$pass = $_POST["pass"];
$_SESSION['profileIncomplete'] = 0;
function is_secure_password($password) {
    $min_length = 8;
    if (strlen($password) < $min_length) return false;
    $has_uppercase = preg_match('/[A-Z]/', $password);
    $has_lowercase = preg_match('/[a-z]/', $password);
    $has_digit     = preg_match('/\d/', $password);
    $has_special   = preg_match('/[\W]/', $password); // special characters
    return $has_uppercase && $has_lowercase && $has_digit && $has_special;
}
include 'connection/connection.php';
$sql1 = "SELECT * FROM UserMaster INNER JOIN Staff ON UserMaster.UserName = Staff.IDNO  WHERE UserMaster.UserName = ? AND UserMaster.Password = ? AND UserMaster.ApplicationType = 'Web' AND Staff.JobStatus = 1";
$params1 = array($user, $pass);
$stmt2 = sqlsrv_prepare($conntest, $sql1, $params1);
if (!$stmt2 || !sqlsrv_execute($stmt2)) {
   //  die(print_r(sqlsrv_errors(), true));
}
while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
    $status = 1;
    $lockProfile = $row['ProfileLock'];
}
if ($status == 1 && $lockProfile != 1) {
    $_SESSION['usr'] = $user;
    $_SESSION['user_id']=$user;

include 'activity.php';

      $updateactivity = "INSERT INTO UserActivity
           (IDNo,ActivityType,ActivityDescription,IPAddress,Broswer,DeviceType,CreatedAt)
          Values (?,?,?,?,?,?,?)";

    $paramslog = array($user,'Logged in','New Login',$ipAddress,$browserName,$deviceType,$timeStampS);

    $stmt3 = sqlsrv_query($conntest, $updateactivity,$paramslog);



$updateLoggedIn = "UPDATE UserMaster SET LoggedIn = '0'WHERE UserName = ?  AND ApplicationType = 'Web' AND ApplicationName = 'Campus'";

    $params2 = array($user);
    $stmt3 = sqlsrv_query($conntest, $updateLoggedIn, $params2);
    if ($stmt3 === false) {
        die(print_r(sqlsrv_errors(), true));

    }
    if (is_secure_password($pass)) {
        $_SESSION['secure'] = 0;
        header('Location: Dashboard.php');
    } else {
        $_SESSION['secure'] = 1;
        header('Location: password-change.php');
    }
    exit();
} elseif ($lockProfile == 1 && $status == 1) {
    $_SESSION['incorrect'] = "<p style='color:red;'>Your profile has been temporarily blocked due to multiple attempts to upload images in an incorrect format. Please contact IT Department.</p>";
    header('Location: index.php');
    exit();
} else {
    $_SESSION['incorrect'] = "<p style='color:red;'>Incorrect Password. Try ERP Password.</p>";
    header('Location: index.php');
    exit();
}
?>
