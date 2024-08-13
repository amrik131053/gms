<?php 
session_start();
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
include "connection/connection.php";
$todaydate=date('Y-m-d');
$timeStamp=date('Y-m-d H-i');
$getCurrentExamination="SELECT * FROM ExamDate";
$getCurrentExamination_run=sqlsrv_query($conntest,$getCurrentExamination);
if ($getCurrentExamination_row=sqlsrv_fetch_array($getCurrentExamination_run,SQLSRV_FETCH_ASSOC))
{

$CurrentExamination=$getCurrentExamination_row['Month'].' '.$getCurrentExamination_row['Year'];

}


if(!(ISSET($_SESSION['usr'])) && !(ISSET($_SESSION['secure']))) 
{?>



<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php 
}
else
{
    
$EmployeeID=$_SESSION['usr'];
$passSecureFlag=$_SESSION['secure'];
// $_SESSION['profileIncomplete']="";
$updatedFlag=$_SESSION['profileIncomplete'];
$spoc_per=0;

$sqlspoc="SELECT * FROM user_login_master where  username='$EmployeeID'";
$result = $conn_spoc->query($sqlspoc);
if ($result->num_rows > 0) 
{
      $spoc_per=1;
      while($rowspoc = $result->fetch_assoc())   
      {
         $spoce_session=$rowspoc["id"];
         $_SESSION['spoc_id']=$spoce_session;
      }
}
 if($EmployeeID==0 || $EmployeeID=='')
{?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php }
 $role_id='0';
   
   $permissions_array = ""; 
   $r[]= ""; 
   $p[]= ""; 
      $id=""; 

 $staff="SELECT Name,Snap,personalIdentificationMark,Designation,Department,DateOfJoining,LeaveSanctionAuthority,CollegeID,RoleID,FatherName,MotherName,DateOfBirth,Gender,PANNo,EmailID,OfficialEmailID,MobileNo,WhatsAppNumber,
EmergencyContactNo,
OfficialMobileNo,
PostalCode,
PermanentAddress,
CorrespondanceAddress,
Nationality,
SalaryAtPresent,SalaryAtPresent,
BankAccountNo,
BankName,
BankIFSC,
State,
District,
PostOffice,
BloodGroup
 FROM Staff Where IDNo='$EmployeeID'";
    $stmt = sqlsrv_query($conntest,$staff);  
   while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
        {
    $Emp_Name=$row_staff['Name'];
    $Emp_Image=$row_staff['Snap'];
    $Emp_Department=$row_staff['Department'];
    $Emp_Designation=$row_staff['Designation'];
    $Emp_CollegeID=$row_staff['CollegeID'];
    $DateOfJoining=$row_staff['DateOfJoining'];
    $LeaveSanctionAuthority=$row_staff['LeaveSanctionAuthority'];
    $role_id =$row_staff['RoleID'];

    $fields = [
        'Father Name' => $row_staff['FatherName'],
        'Mother Name' => $row_staff['MotherName'],
        'Date Of Birth' => $row_staff['DateOfBirth']->format('Y-m-d'),
        'Gender' => $row_staff['Gender'],
        'PANNo' => $row_staff['PANNo'],
        'EmailID' => $row_staff['EmailID'],
        'Official EmailID' => $row_staff['OfficialEmailID'],
        'MobileNo' => $row_staff['MobileNo'],
        'WhatsApp Number' => $row_staff['WhatsAppNumber'],
        'Postal Code' => $row_staff['PostalCode'],
        'Permanent Address' => $row_staff['PermanentAddress'],
        'Correspondance Address' => $row_staff['CorrespondanceAddress'],
        'Bank Account No' => $row_staff['BankAccountNo'],
        'Bank Name' => $row_staff['BankName'],
        'Identification Mark' => $row_staff['personalIdentificationMark'],
        'Bank IFSC' => $row_staff['BankIFSC'],
        'Salary Decided' => $row_staff['SalaryAtPresent'],
        'Country' => $row_staff['Nationality'],
        'State' => $row_staff['State'],
        'District' => $row_staff['District'],
        'PostOffice' => $row_staff['PostOffice'],
        'Blood Group' => $row_staff['BloodGroup']
    ];
    $emptyFields = []; 
    $arrayValue=array();
    foreach ($fields as $key => $value) {
        if (empty($value)) {
            $_SESSION['profileIncomplete']=1;
            $emptyFields[] = $key;
            // break;
        }
      
    }
    $emptyFieldsList = implode(', ', $emptyFields);
        $alertMessage = "Please update the following fields: $emptyFieldsList";

}






   
                 $role_get="SELECT * FROM role WHERE role_id='$role_id'";
           $role_run=mysqli_query($conn,$role_get);
           while($row_role_get=mysqli_fetch_array($role_run))
           {
            $r[]=$row_role_get['page_id'];
           }
             $permisson_get="SELECT * FROM special_permission WHERE  emp_id='$EmployeeID' and (( start_date<= '$todaydate' and end_date >= '$todaydate') OR( start_date<= '0000-00-00' and end_date >= '0000-00-00')) ";
           $permisson_run=mysqli_query($conn,$permisson_get);
           while($row_permisson_get=mysqli_fetch_array($permisson_run))
           {
            $p[]=$row_permisson_get['page_id'];
           }
          
           $array_aa=array_unique((array_merge($r,$p)));
       $urls=array('dashboard.php','not_found.php','bulk_assign.php','password-change.php');
 
       $file= basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
   
   
       if (!in_array($file,$urls))
        { 
        $result1 = mysqli_query($conn,"SELECT id from permissions WHERE page_link = '$file'");
       while($row1=mysqli_fetch_array($result1))
       {
            $id = $row1['id'];
       }
       if(!in_array($id,$array_aa))
       {
        header('Location:not_found.php');
       } 
       else if($passSecureFlag==1)
       {
         header('Location:password-change.php');
       }
       if($updatedFlag==1)
       {
       ?><script>
         alert("<?php echo addslashes($alertMessage); ?>");
         window.location.href='profile.php';
            </script><?php 
            $_SESSION['profileIncomplete']=0;
       }

      
    }
   
   // ----------------------------------------------------------------------------------------
        $code_access="";
      $sel_per="SELECT * FROM special_permission WHERE  page_id='$id' and emp_id='$EmployeeID'";
    $sel_run=mysqli_query($conn,$sel_per);
    while ($r=mysqli_fetch_array($sel_run))
     {
   $InsertButton=$r['I'];
   $UpdateButton=$r['U'];
   $DeleteButton=$r['D'];
   $code_access.=$InsertButton;
   $code_access.=$UpdateButton;
   $code_access.=$DeleteButton;
   }
   if ($code_access=='') {
        $sel_per="SELECT * FROM role WHERE  page_id='$id' and role_id='$role_id'";
    $sel_run=mysqli_query($conn,$sel_per);
    while ($r=mysqli_fetch_array($sel_run))
     {
   $InsertButton=$r['I'];
   $UpdateButton=$r['U'];
   $DeleteButton=$r['D'];
   $code_access.=$InsertButton;
   $code_access.=$UpdateButton;
   $code_access.=$DeleteButton;
   }
   }
   else
   {
   
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Guru Kashi University</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
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

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<style>  
        #blink { 
            font-size: 15px; 
            font-family: serif; 
            color: red; 
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
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard.php" class="nav-link"><i class="fa fa-home fa-2x" style="color:#9c0a0f"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
               <a href="#" class="nav-link">Contact</a>
            </li> -->
            </ul>
            <!-- SEARCH FORM -->
            <!--  <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
               <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
               <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                  </button>
               </div>
            </div>
         </form> -->
            <!-- Right navbar links -->

            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-users" aria-hidden="true"></i>
          <span class="badge badge-danger navbar-badge" id="countOnlineUsers"></span>
        </a> -->
                <!-- </li> -->
                <li class="nav-item" id="error" style="z-index: 999;  max-height: 10px !important;padding-right: 10px;">
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" onclick="show_notification();">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge count" id="count"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="show_notification_tab">



                    </div>
                </li>
                <P class="count"></P>
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($Emp_Image).'" class="user-image img-circle elevation-2"  style="border-radius:50%"/>';?>



                        <span class="d-none d-md-inline"><?= $Emp_Name;?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">

                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($Emp_Image).'" class="user-image img-circle elevation-2"  style="border-radius:50%"/>';?>


                            <p>
                                <?= $Emp_Name;?> - <?= $Emp_Designation;?>
                                <small>Member Since - <?= $DateOfJoining->format('d-M-Y');?> </small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <a class=" btn btn-primary btn-xs" href="mytimeout.php">Time out</a>
                                </div>
                                <div class="col-4 text-center">
                                    <a href="task-manager.php" class=" btn btn-warning btn-xs">My Task</a>
                                </div>
                                <div class="col-4 text-center">
                                    <a href="staff-attendance.php" class=" btn btn-info btn-xs">My Team</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="profile.php" class="btn btn-primary btn-flat">Profile</a>
                            <a href="#" onclick="sessionAlllogout('0');"
                                class="btn btn-danger btn-flat float-center">Sign out all</a>
                            <a href="sign-out.php" class="btn btn-warning btn-flat float-right">Sign out</a>
                        </li>
                    </ul>
                </li>

            </ul>

        </nav>

        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #223260;">
            <!-- Brand Logo -->
            <a href="dashboard.php" class="brand-link" style="background-color: white;">
                <img src="dist/img/new-logo.jpg" alt="AdminLTE Logo" style="width: 230px;">
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                        <?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($Emp_Image).'" height="100" width="100" class="img-thumnail"  style="border-radius:50%"/></center>';?>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?=$Emp_Name;?>(<?=$EmployeeID;?>)</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="dashboard.php" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    <!--LMS-->
                                    Dashboard
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                        <?php 
              if ($spoc_per>0) 
                  {
                 ?>

                        <li class="nav-item has-treeview menu-open">
                            <a href="/spoc/index.php" class="nav-link ">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Spoc Dashboard
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                    <?php
                  $ids = join("','",$array_aa); 
                  $q = mysqli_query($conn,"SELECT permissions.id as pid, submenu, mainmenu,menu_name, page_link FROM permissions INNER 
join master_menu on permissions.master_id=master_menu.id  WHERE permissions.id IN ('$ids') and type = 'Menu' ORDER BY master_menu.priorityorder ASC, permissions.submenu ASC");



                  
                  // prepare data 
                  $groups = Array();
                  while($w = mysqli_fetch_assoc($q)) 
                  {
                    if(!isset($groups[$w['menu_name']])) 
                       $groups[$w['menu_name']] = Array();
                    $groups[$w['menu_name']][] = $w;
                  }
                  // display data
                  echo ' <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
                  foreach($groups as $group_name => $sections) 
                  {
                   // echo "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>".$group_name."<span class='caret'></span></a><ul class='dropdown-menu'>";
                    
                    echo ' <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                       <i class="nav-icon fas fa-copy"></i>
                       <p>
                          '.$group_name.'
                          <i class="fas fa-angle-left right"></i>
                          <!--  <span class="badge badge-info right">6</span> -->
                       </p>
                    </a><ul class="nav nav-treeview">';
                  
                  
                  
                    foreach($sections as $section) 
                    {
                  
                  
                       echo '
                             <li class="nav-item">
                             <a href="'.$section['page_link'].'" class="nav-link">
                                   <i class="far fa-circle nav-icon"></i>
                                   <p>'.$section['submenu'].'</p>
                                </a></li>';
                    }
                    echo ' </ul>';
                  }
                  
                  //echo "</ul>";
                  ?>


                    <li class="nav-item ">
                        <a href="password-change.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="sign-out.php" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>LogOut</p>
                        </a>
                    </li>

                    </ul>


                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
              <a href="https://play.google.com/store/apps/details?id=com.GKUapp&pcampaignid=web_share">
                <small id="blink" ><marquee><b>Download Our Android App on Google Play Store<b></marquee></small>
                </a>
            <p id="ajax-loader"></p>

            <?php  }?>