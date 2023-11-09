<html>
    <head>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/adminlte.min.css">
      <!-- ----------internet status ---------- -->
      <link rel="stylesheet" href="internet_status.css">
      <!-- ----------internet status end ---------- -->
      <link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
 <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="dist/css/jquery-ui.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

<link rel="stylesheet" href="plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-bootstrap/main.min.css">


    </head>
    </html>
    
    <?php
    include "connection/connection.php";
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$sessionNames = scandir(session_save_path());
$allSessions = array();

foreach($sessionNames as $sessionName) {
    $sessionName = str_replace("sess_", "", $sessionName);
    if(strpos($sessionName, ".") === false) { // This skips temp files that aren't sessions
        session_id($sessionName);
        session_start();
        if (!isset($_SESSION['sessionDate'])) {
            $_SESSION['sessionDate'] = date('Y-m-d H:i:s'); // Save the session creation date
        }
        $allSessions[$sessionName] = $_SESSION;
        session_abort();
    }
}
?>
<div class="container ">
<div class="card ">
<table class="table">
    <tr>
        <th>SrNo</th>
        <th>User</th>
        <th>Session ID</th>
        <th>Date/Time</th>
    </tr>
    
<?php 
$count=1;
foreach ($allSessions as $sessionName => $sessionData) 
{
    $getEmplyeeDetailsWithFunction="SELECT Name FROM Staff Where IDNo='".$sessionData['usr']."'";
    $getEmplyeeDetailsWithFunction_run=sqlsrv_query($conntest,$getEmplyeeDetailsWithFunction);
    if ($getEmplyeeDetailsWithFunction_row=sqlsrv_fetch_array($getEmplyeeDetailsWithFunction_run,SQLSRV_FETCH_ASSOC)) {
       $getEmplyeeDetailsWithFunction_row['Name'];
    
    ?>
<tr>
    <td><?=$count;?></td>
    <td><b>(<?=$getEmplyeeDetailsWithFunction_row['Name'];?>)</b><?=$sessionData['usr'];?></td>
    <td><?=$sessionName;?></td>
    <td><?=$sessionData['sessionDate'];?></td>
</tr>

<?php 
$count++;
}
}
?>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>