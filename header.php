<?php
session_start();
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
   include "connection/connection.php";
   $todaydate=date('Y-m-d');
$timeStamp=date('Y-m-d H-i');
if(!(ISSET($_SESSION['usr']))) 
{?>

<script type="text/javascript">
    window.location.href="index.php";
</script>
<?php }
else
{
 $EmployeeID=$_SESSION['usr'];
 if($EmployeeID==0 || $EmployeeID=='')
{?>
<script type="text/javascript">
   window.location.href="index.php";
</script>
<?php }
 $role_id='0';
   
   $permissions_array = ""; 
   $r[]= ""; 
   $p[]= ""; 
      $id=""; 
       $result = mysqli_query($conn,"SELECT * FROM user  where emp_id=$EmployeeID");
       while($row=mysqli_fetch_array($result)) 
       {
           $user_id = $row['user_id'];
           $emp_id = $row['emp_id'];
           $name = $row['name'];
           $emp_image = $row['image'];
           $status = $row['status'];
           // -------------------------------------
           $role_id = $row['role_id'];
           // -------------------------------------
       }
       
   
                 $role_get="SELECT * FROM role WHERE role_id='$role_id'";
           $role_run=mysqli_query($conn,$role_get);
           while($row_role_get=mysqli_fetch_array($role_run))
           {
            $r[]=$row_role_get['page_id'];
           }
            $permisson_get="SELECT * FROM special_permission WHERE  emp_id='$EmployeeID'";
           $permisson_run=mysqli_query($conn,$permisson_get);
           while($row_permisson_get=mysqli_fetch_array($permisson_run))
           {
            $p[]=$row_permisson_get['page_id'];
           }
          
           $array_aa=array_unique((array_merge($r,$p)));
       $urls=array('dashboard.php','not_found.php','bulk_assign.php');
 
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
    }
    $staff="SELECT Name,Snap,Designation,Department,DateOfJoining,LeaveSanctionAuthority FROM Staff Where IDNo='$EmployeeID'";
    $stmt = sqlsrv_query($conntest,$staff);  
   while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
        {
   $Emp_Name=$row_staff['Name'];
   $Emp_Image=$row_staff['Snap'];
    $Emp_Department=$row_staff['Department'];
     $Emp_Designation=$row_staff['Designation'];
    $DateOfJoining=$row_staff['DateOfJoining'];
    $LeaveSanctionAuthority=$row_staff['LeaveSanctionAuthority'];
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
            <li class="nav-item" id="error" style="z-index: 999;  max-height: 10px !important;padding-right: 10px;"></li>
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
                <a href="employee-articles.php" class=" btn btn-info btn-xs">My Stock</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
            <a href="sign-out.php" class="btn btn-default btn-flat float-right">Sign out</a>
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
         <img src="dist/img/Logo.png" alt="AdminLTE Logo"
            style="width: 230px;">
         </a>
         <!-- Sidebar -->
         <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                  <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
                   <?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($Emp_Image).'" height="100" width="100" class="img-thumnail"  style="border-radius:50%"/></center>';?>
               </div>
               <div class="info">
                  <a href="#" class="d-block"><?=$Emp_Name;?></a>
               </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
               <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
               <li class="nav-item has-treeview menu-open">
                  <a href="dashboard.php" class="nav-link ">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                        Dashboard
                        <!-- <i class="right fas fa-angle-left"></i> -->
                     </p>
                  </a>
               </li>
            </ul>
    <?php
                  $ids = join("','",$array_aa); 
                  $q = mysqli_query($conn," SELECT permissions.id as pid, submenu, mainmenu, page_link FROM permissions INNER 
join master_menu on permissions.master_id=master_menu.id  WHERE permissions.id IN ('$ids') and type = 'Menu' ORDER BY master_menu.priorityorder ASC");



                  
                  // prepare data 
                  $groups = Array();
                  while($w = mysqli_fetch_assoc($q)) 
                  {
                    if(!isset($groups[$w['mainmenu']])) 
                       $groups[$w['mainmenu']] = Array();
                    $groups[$w['mainmenu']][] = $w;
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
                           <a href="sign-out.php" class="nav-link">
                                 <i class="nav-icon fas fa-copy"></i>
                                 <p>LogOut</p>
                              </a></li>

                 </ul>
             

            </nav>
            <!-- /.sidebar-menu -->
         </div>
         <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <br><p id="ajax-loader"></p>
   
   <?php  }?>
    