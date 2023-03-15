<?php include "header.php"; 

if(!(ISSET($_SESSION['usr']))) 
{
  header('Location:index.php');  
}
else
{
    $permissionCount=0;
$permission_qry="SELECT * FROM category_permissions where employee_id='$EmployeeID' and is_admin='1'";
$permission_res=mysqli_query($conn,$permission_qry);
while($permission_data=mysqli_fetch_array($permission_res))
{
   $permissionCount++;
}
}
?>
<section class="content">
   <div class="container-fluid">
      <?php if ($permissionCount>0) 
      {
?>
      <div class="row">
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
               <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Category</span>
                  <span class="info-box-number">
                  <?php
                     $count_c=0;
                       $Category="SELECT * FROM master_calegories";
                     $reslut=mysqli_query($conn,$Category);
                     while ($row=mysqli_fetch_array($reslut))
                      {
                         $count_c++;
                       }  
                       echo $count_c;
                       ?>
                  </span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
               <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Locations</span>
                  <span class="info-box-number">
                  <?php
                     $count_l=0;
                       $location="SELECT * FROM location_master";
                     $reslut_location=mysqli_query($conn,$location);
                     while ($row_location=mysqli_fetch_array($reslut_location))
                      {
                         $count_l++;
                       }  
                       echo $count_l;
                       ?>
                  </span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
               <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Articles</span>
                  <span class="info-box-number">     <?php
                     $count_a=0;
                       $Articles="SELECT * FROM master_article";
                     $reslut_Articles=mysqli_query($conn,$Articles);
                     while ($row_Articles=mysqli_fetch_array($reslut_Articles))
                      {
                         $count_a++;
                       }  
                       echo $count_a;
                       ?></span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
               <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Total Stock</span>
                  <span class="info-box-number">   <?php
                     $count_s=0;
                       $Stock="SELECT * FROM stock_summary";
                     $reslut_Stock=mysqli_query($conn,$Stock);
                     while ($row_Stock=mysqli_fetch_array($reslut_Stock))
                      {
                         $count_s++;
                       }  
                       echo $count_s;
                       ?></span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </div>







 <div class="row">
   <div class="col-md-6">
      <div class="row">
   <?php 
      $c=0;
      $array=array();
      $sql="SELECT DISTINCT Incharge from building_master where Incharge>0";
      $res=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($res))
      {
         $array[$c]=$data['Incharge'];
         $c++;
      }
      $total=count($array);  
   ?>
         <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">IT Incharges</h3>
            <div class="card-tools">
               <span class="badge badge-danger"><?=$total?> Incharges</span>
            </div>
         </div>
         <div class="card-body p-0">
            <ul class="users-list clearfix">
               <?php
               for ($i=0; $i < $total ; $i++) 
               { 
                  $Emp_Name='';
                             $Emp_Image='';
                             $emp_pic='';
                  $staff="SELECT Name,Snap FROM Staff Where IDNo='$array[$i]'";
                           $stmt = sqlsrv_query($conntest,$staff);  
                           while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                           {
                             $Emp_Name=$row_staff['Name'];
                             $Emp_Image=$row_staff['Snap'];
                             $emp_pic=base64_encode($Emp_Image);
                           }
                  $res='';
                  $data='';
                  $blocks='';
                  $res=mysqli_query($conn,"SELECT Name from building_master where Incharge='$array[$i]'");
                  while($data=mysqli_fetch_array($res))
                  {
                     $blocks.=$data[0]."  ";
                  }
               ?>
               <li>
                  <img src="data:image/jpeg;base64,<?=$emp_pic?>" alt="User Image" height="128px" style="height: 70px; width: 70px;">
                  <a class="users-list-name" href="#"><?=$Emp_Name?></a>
                  <span class="users-list-date"><?=$blocks?></span>
               </li>
               <?php 
            }
            ?>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <?php 
      $c=0;
      $array=array();
      $sql="SELECT DISTINCT infra_incharge from building_master where infra_incharge>0";
      $res=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($res))
      {
         $array[$c]=$data['infra_incharge'];
         $c++;
      }
      $total=count($array);  
   ?>
         <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Infrastructure Incharges</h3>
            <div class="card-tools">
               <span class="badge badge-danger"><?=$total?> Incharges</span>
            </div>
         </div>
         <div class="card-body p-0">
            <ul class="users-list clearfix">
               <?php
               for ($i=0; $i < $total ; $i++) 
               { 
                  $Emp_Name='';
                             $Emp_Image='';
                             $emp_pic='';
                  $staff="SELECT Name,Snap FROM Staff Where IDNo='$array[$i]'";
                           $stmt = sqlsrv_query($conntest,$staff);  
                           while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                           {
                             $Emp_Name=$row_staff['Name'];
                             $Emp_Image=$row_staff['Snap'];
                             $emp_pic=base64_encode($Emp_Image);
                           }
                  $res='';
                  $data='';
                  $blocks='';
                  $res=mysqli_query($conn,"SELECT Name from building_master where Incharge='$array[$i]'");
                  while($data=mysqli_fetch_array($res))
                  {
                     $blocks.=$data[0]."  ";
                  }
               ?>
               <li>
                  <img src="data:image/jpeg;base64,<?=$emp_pic?>" alt="User Image" height="128px" style="height: 70px; width: 70px;">
                  <a class="users-list-name" href="#"><?=$Emp_Name?></a>
                  <span class="users-list-date"><?=$blocks?></span>
               </li>
               <?php 
            }
            ?>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <?php 
      $c=0;
      $array=array();
      $sql="SELECT DISTINCT electrical_incharge from building_master where electrical_incharge>0";
      $res=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($res))
      {
         $array[$c]=$data['electrical_incharge'];
         $c++;
      }
      $total=count($array);  
   ?>
         <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Electrical Incharges</h3>
            <div class="card-tools">
               <span class="badge badge-danger"><?=$total?> Incharges</span>
            </div>
         </div>
         <div class="card-body p-0">
            <ul class="users-list clearfix">
               <?php
               for ($i=0; $i < $total ; $i++) 
               { 
                  $Emp_Name='';
                             $Emp_Image='';
                             $emp_pic='';
                  $staff="SELECT Name,Snap FROM Staff Where IDNo='$array[$i]'";
                           $stmt = sqlsrv_query($conntest,$staff);  
                           while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                           {
                             $Emp_Name=$row_staff['Name'];
                             $Emp_Image=$row_staff['Snap'];
                             $emp_pic=base64_encode($Emp_Image);
                           }
                  $res='';
                  $data='';
                  $blocks='';
                  $res=mysqli_query($conn,"SELECT Name from building_master where Incharge='$array[$i]'");
                  while($data=mysqli_fetch_array($res))
                  {
                     $blocks.=$data[0]."  ";
                  }
               ?>
               <li>
                  <img src="data:image/jpeg;base64,<?=$emp_pic?>" alt="User Image" height="128px" style="height: 70px; width: 70px;">
                  <a class="users-list-name" href="#"><?=$Emp_Name?></a>
                  <span class="users-list-date"><?=$blocks?></span>
               </li>
               <?php 
            }
            ?>
            </ul>
         </div>
      </div>
   </div>
</div>

</div>
 <?php 
      $c=0;
      $sql="SELECT DISTINCT location_owner from location_master where location_owner>0";
      $res=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($res))
      {
         $array[$c]=$data['location_owner'];
         $c++;
      }
      $total=count($array);  
   ?>
<div class="col-md-6" >

      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Location Owners</h3>
            <div class="card-tools">
               <span class="badge badge-danger"><?=$total?> Location Owners</span>
            </div>
         </div>
         <div class="card-body p-0">
            <ul class="users-list clearfix">
               <?php
               for ($i=0; $i < $total ; $i++) 
               { 
                             $Emp_Name='';
                             $Emp_ID='';
                             $Emp_Image='';
                             $emp_pic='';
                  $staff="SELECT Name,Snap,IDNo FROM Staff Where IDNo='$array[$i]'";
                           $stmt = sqlsrv_query($conntest,$staff);  
                           while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                           {
                              $Emp_ID=$row_staff['IDNo'];
                             $Emp_Name=$row_staff['Name'];
                             $Emp_Image=$row_staff['Snap'];
                             $emp_pic=base64_encode($Emp_Image);
                             $emp_id=$array[$i];
                           }
                  $res='';
                  $data='';
                  $blocks='';
                  $res=mysqli_query($conn,"SELECT distinct Name from location_master inner join building_master on building_master.ID=location_master.Block where location_owner='$array[$i]'");
                  while($data=mysqli_fetch_array($res))
                  {
                     $blocks.=$data[0]."  ";
                  }
               
               ?>
               <li>
                  <a href="reports.php">
                     <?php if ($emp_pic) 
                     {
                        ?>
                  <img src="data:image/jpeg;base64,<?=$emp_pic?>" alt="<?=$Emp_Name?>" height="128px" style="height: 40px; width: 40px;">
                     <?php
                     }
                     else
                     {
                        ?>
                  <img src="dummy-user.png" alt="<?=$Emp_Name?>" height="128px" style="height: 70px; width: 70px;">
                        <?php
                     }
                     ?>
                  <a class="users-list-name" href="reports.php"><?=$Emp_Name?>
                 <br> <?=$Emp_ID?>
                  <span class="users-list-date"><?=$blocks?></span>
               </a>
               </a>
               </li>
               <?php 
            }
            ?>
            </ul>
         </div>

<!-- <div class="card-footer text-center">
<a href="javascript:">View All Users</a>
</div> -->

</div>

</div>



                  <div class="col-md-12">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title">Application Detail</h5>
                           <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                              </button>
                            
                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                              </button>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <p class="text-center">
                                    <strong>Assigned Articles </strong>
                                 </p>


<?php   $sql_up="SELECT *  FROM master_article inner join category_permissions on category_permissions.CategoryCode=master_article.CategoryCode where employee_id='$EmployeeID' ";
            $res_r_up = mysqli_query($conn, $sql_up);
                                        
                                        while ($data_up = mysqli_fetch_array($res_r_up)) 
                                        {
                                          $postshow=$data_up['ArticleCode']; 
                                          $ArticleName=$data_up['ArticleName']; 
                                          ?>
<div class="progress-group">
   <?= $ArticleName;?>
   <span class="float-right">
   <b>
   <?php
      $count=0;
      $sql_upd="SELECT LocationID FROM stock_summary where ArticleCode='$postshow' and LocationID!=0 and Status='2'";
      $res_sql_upd = mysqli_query($conn, $sql_upd);
      while ($data_sql_upd = mysqli_fetch_array($res_sql_upd)) 
      {
            $count++;
      }
      
      echo $a=$count;
       ?>
   </b>/ <?php
      $countt=0;
       $sql="SELECT LocationID FROM stock_summary where ArticleCode='$postshow' ";
         $res = mysqli_query($conn, $sql);
         while ($data = mysqli_fetch_array($res)) 
         {
               $countt++;
         }
        
         echo $b=$countt;
         ?>
   </span>
      
   <div class="progress progress-sm">
      <?php
      if ($b==0) 
      {
         $b=1;
      }
      ?>
       <div class="progress-bar bg-primary" style="width:<?=($a/$b)*100?>%"></div>
   </div>
</div>
<?php  }?>

                             
                                 

                              </div>
                          
  <div class="col-md-6">
                                 <p class="text-center">
                                    <strong>Updated Articles </strong>
                                 </p>


<?php   $sql="SELECT *  FROM master_article inner join category_permissions on category_permissions.CategoryCode=master_article.CategoryCode where employee_id='$EmployeeID' ";
            $res_r = mysqli_query($conn, $sql);
                                        
                                        while ($data = mysqli_fetch_array($res_r)) 
                                        {
                                          $postshow=$data['ArticleCode']; 
                                          $ArticleName=$data['ArticleName']; 
                                          ?>
<div class="progress-group">
   <?= $ArticleName;?>
   <span class="float-right">

   <b>
   <?php
      $count=0;
      $sql="SELECT LocationID FROM stock_summary where ArticleCode='$postshow' and Status='1'";
      $res = mysqli_query($conn, $sql);
      while ($data = mysqli_fetch_array($res)) 
      {
            $count++;
      }
      
      echo $a=$count;
       ?>
   </b>/ <?php
      $countt=0;
       $sql="SELECT LocationID FROM stock_summary where ArticleCode='$postshow' ";
         $res = mysqli_query($conn, $sql);
         while ($data = mysqli_fetch_array($res)) 
         {
               $countt++;
         }
        
         echo $b=$countt;
         ?>
   </span>
      
   <div class="progress progress-sm">
      <?php
      if ($b==0) 
      {
         $b=1;
      }
      ?>
       <div class="progress-bar bg-primary" style="width:<?=($a/$b)*100?>%"></div>
   </div>
</div>
<?php  }?>

                             
                                 

                              </div>



                           </div>
                        </div>

                      
                     </div>
                  </div>
               </div>
<?php }
else
{
   ?>
<div class="row">
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
               <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Category</span>
                  <span class="info-box-number">
                  <?php
                     $count_c=0;
                       $Category="SELECT DISTINCT CategoryID FROM stock_summary WHERE Corrent_owner='$EmployeeID'";
                     $reslut=mysqli_query($conn,$Category);
                     while ($row=mysqli_fetch_array($reslut))
                      {
                         $count_c++;
                       }  
                       echo $count_c;
                       ?>
                  </span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
               <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Locations</span>
                  <span class="info-box-number">
                  <?php
                     $count_l=0;
                       $location="SELECT DISTINCT LocationID FROM stock_summary WHERE Corrent_owner='$EmployeeID'";
                     $reslut_location=mysqli_query($conn,$location);
                     while ($row_location=mysqli_fetch_array($reslut_location))
                      {
                         $count_l++;
                       }  
                       echo $count_l;
                       ?>
                  </span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
               <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Articles</span>
                  <span class="info-box-number">     <?php
                     $count_a=0;
                       $Articles="SELECT DISTINCT ArticleCode FROM stock_summary WHERE Corrent_owner='$EmployeeID'";
                     $reslut_Articles=mysqli_query($conn,$Articles);
                     while ($row_Articles=mysqli_fetch_array($reslut_Articles))
                      {
                         $count_a++;
                       }  
                       echo $count_a;
                       ?></span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
               <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Total Stock</span>
                  <span class="info-box-number">   <?php
                     $count_s=0;
                       $Stock="SELECT * FROM stock_summary where Corrent_owner='$EmployeeID'";
                     $reslut_Stock=mysqli_query($conn,$Stock);
                     while ($row_Stock=mysqli_fetch_array($reslut_Stock))
                      {
                         $count_s++;
                       }  
                       echo $count_s;
                       ?></span>
               </div>
               <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
         </div>
         <!-- /.col -->
      </div>





<?php 
if ($permissionCount>0) 
{
?>


 <div class="row">
                  <div class="col-md-12">
                     <div class="card">
                        <div class="card-header">
                           <h5 class="card-title">Application Detail</h5>
                           <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                              </button>
                            
                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                              </button>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-6">
                                 <p class="text-center">
                                    <strong>Issued Articles </strong>
                                 </p>


<?php   $sql_up="SELECT *  FROM master_article ";
            $res_r_up = mysqli_query($conn, $sql_up);
                                        
                                        while ($data_up = mysqli_fetch_array($res_r_up)) 
                                        {
                                          $postshow=$data_up['ArticleCode']; 
                                          $ArticleName=$data_up['ArticleName']; 
                                          ?>
<div class="progress-group">
   <?= $ArticleName;?>
   <span class="float-right">
   <b> 
   <?php
      $count=0;
      $sql_upd="SELECT LocationID FROM stock_summary where ArticleCode='$postshow' and LocationID!=0 and Status='2' and Corrent_owner='$EmployeeID' ";
      $res_sql_upd = mysqli_query($conn, $sql_upd);
      while ($data_sql_upd = mysqli_fetch_array($res_sql_upd)) 
      {
            $count++;
      }
      
      echo $a=$count;
       ?>
   </b>/ <?php
      $countt=0;
       $sql="SELECT LocationID FROM stock_summary where ArticleCode='$postshow' ";
         $res = mysqli_query($conn, $sql);
         while ($data = mysqli_fetch_array($res)) 
         {
               $countt++;
         }
        
         echo $b=$countt;
         ?>
   </span>
      
   <div class="progress progress-sm">
      <?php
      if ($b==0) 
      {
         $b=1;
      }
      ?>
       <div class="progress-bar bg-primary" style="width:<?=($a/$b)*100?>%"></div>
   </div>
</div>
<?php  }?>

                             
                                 

                              </div>
                          
  <div class="col-md-6">
                                 <p class="text-center">
                                    <strong>Updated Articles </strong>
                                 </p>


<?php   $sql="SELECT *  FROM master_article ";
            $res_r = mysqli_query($conn, $sql);
                                        
                                        while ($data = mysqli_fetch_array($res_r)) 
                                        {
                                          $postshow=$data['ArticleCode']; 
                                          $ArticleName=$data['ArticleName']; 
                                          ?>
<div class="progress-group">
   <?= $ArticleName;?>
   <span class="float-right">

   <b>
   <?php
      $count=0;
      $sql="SELECT LocationID FROM stock_summary where ArticleCode='$postshow' and Status='1' and Corrent_owner='$EmployeeID'";
      $res = mysqli_query($conn, $sql);
      while ($data = mysqli_fetch_array($res)) 
      {
            $count++;
      }
      
      echo $a=$count;
       ?>
   </b>/ <?php
      $countt=0;
       $sql="SELECT LocationID FROM stock_summary where ArticleCode='$postshow' and Corrent_owner='$EmployeeID'";
         $res = mysqli_query($conn, $sql);
         while ($data = mysqli_fetch_array($res)) 
         {
               $countt++;
         }
        
         echo $b=$countt;
         ?>
   </span>
      
   <div class="progress progress-sm">
      <?php
      if ($b==0) 
      {
         $b=1;
      }
      ?>
       <div class="progress-bar bg-primary" style="width:<?=($a/$b)*100?>%"></div>
   </div>
</div>
<?php  }?>

                             
                                 

                              </div>



                           </div>
                        </div>

                      
                     </div>
                  </div>
               </div>






<?php }

}
?>
<div class="row">
<?php 

$qry="SELECT DISTINCT Incharge,Name from stock_summary inner join location_master on location_master.ID=stock_summary.LocationID inner join building_master on building_master.ID=location_master.Block where Corrent_owner='$EmployeeID' and CategoryID='1'";
$resl=mysqli_query($conn,$qry);
while ($dataIncharge=mysqli_fetch_array($resl)) 
{  
   $BlockName=$dataIncharge['Name'];
   $incID=$dataIncharge['Incharge'];
   $Emp_Name='';
                             $Emp_Image='';
                             $emp_pic='';
                  $staff="SELECT * FROM Staff Where IDNo='$incID'";
                           $stmt = sqlsrv_query($conntest,$staff);  
                           while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                           {
                             $EmailID=$row_staff['EmailID'];
                             $Emp_Name=$row_staff['Name'];
                             $Emp_Image=$row_staff['Snap'];
                             $emp_pic=base64_encode($Emp_Image);
                             $Designation=$row_staff['Designation'];
                             $Department=$row_staff['Department'];
                             $ContactNo=$row_staff['ContactNo'];
                             $aa=$row_staff;

                           

?>


   <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header  border-bottom-0">
                  IT Incharge (<?=$BlockName?>)
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?=$Emp_Name?></b></h2>
                      <p class="text-muted text-sm"> <?=$Designation?> /
                       <?=$Department?> </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> <?=$EmailID?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone-alt"></i></span> Phone: <?=$ContactNo?></li>
                        <!-- <li class="small"><span class="fa-li"></span><i class="fas fa-lg fa-phone-alt"> <a href="tel:<?=$ContactNo?>"> <?=$ContactNo?></a></i></li> -->
                        <!-- <li class="small"><span class="fa-li"></span><small><i class="fas fa-lg fa-envelope"> <a href="mailto:<?=$EmailID?>"><?=$EmailID?> </a></i></small></li> -->
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="data:image/jpeg;base64,<?=$emp_pic?>" alt="" style="height: 120px; width: 120px" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                     <button class="btn btn-xs btn-success">
                    <small><i class="fas fa-lg fa-phone-alt"> <a href="tel:<?=$ContactNo?>" style='color: white;'>Call</a></i></small>
                        
                     </button> 
                     <button class="btn btn-xs btn-primary">
                    <small><i class="fas fa-lg fa-envelope"> <a href="mailto:<?=$EmailID?>" style='color: white;'>Send Mail</a></i></small>
                        
                     </button>
                  </div>
                </div>
              </div>
            </div>

<?php 
}
}
$qry="SELECT DISTINCT electrical_incharge,Name from stock_summary inner join location_master on location_master.ID=stock_summary.LocationID inner join building_master on building_master.ID=location_master.Block where Corrent_owner='$EmployeeID' and CategoryID='2'";
$resl=mysqli_query($conn,$qry);
while ($dataIncharge=mysqli_fetch_array($resl)) 
{  

   $BlockName=$dataIncharge['Name'];
   $incID=$dataIncharge['electrical_incharge'];
   $Emp_Name='';
                             $Emp_Image='';
                             $emp_pic='';
                  $staff="SELECT * FROM Staff Where IDNo='$incID'";
                           $stmt = sqlsrv_query($conntest,$staff);  
                           while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                           {
                             $EmailID=$row_staff['EmailID'];
                             $Emp_Name=$row_staff['Name'];
                             $Emp_Image=$row_staff['Snap'];
                             $emp_pic=base64_encode($Emp_Image);
                             $Designation=$row_staff['Designation'];
                             $Department=$row_staff['Department'];
                             $ContactNo=$row_staff['ContactNo'];
                             $aa=$row_staff;

                          

?>


   <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header  border-bottom-0">
                  Electrical Incharge (<?=$BlockName?>)
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?=$Emp_Name?></b></h2>
                      <p class="text-muted text-sm"> <?=$Designation?> /
                       <?=$Department?> </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> <?=$EmailID?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone-alt"></i></span> Phone: <?=$ContactNo?></li>
                        <!-- <li class="small"><span class="fa-li"></span><i class="fas fa-lg fa-phone-alt"> <a href="tel:<?=$ContactNo?>"> <?=$ContactNo?></a></i></li> -->
                        <!-- <li class="small"><span class="fa-li"></span><small><i class="fas fa-lg fa-envelope"> <a href="mailto:<?=$EmailID?>"><?=$EmailID?> </a></i></small></li> -->
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="data:image/jpeg;base64,<?=$emp_pic?>" alt="" style="height: 120px; width: 120px" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                     <button class="btn btn-xs btn-success">
                    <small><i class="fas fa-lg fa-phone-alt"> <a href="tel:<?=$ContactNo?>" style='color: white;'>Call</a></i></small>
                        
                     </button> 
                     <button class="btn btn-xs btn-primary">
                    <small><i class="fas fa-lg fa-envelope"> <a href="mailto:<?=$EmailID?>" style='color: white;'>Send Mail</a></i></small>
                        
                     </button>
                  </div>
                </div>
              </div>
            </div>

<?php 

}
}


$qry="SELECT DISTINCT infra_incharge,Name from stock_summary inner join location_master on location_master.ID=stock_summary.LocationID inner join building_master on building_master.ID=location_master.Block where Corrent_owner='$EmployeeID' and CategoryID='3'";
$resl=mysqli_query($conn,$qry);
while ($dataIncharge=mysqli_fetch_array($resl)) 
{  
   $BlockName=$dataIncharge['Name'];
   $incID=$dataIncharge['infra_incharge'];
   $Emp_Name='';
                             $Emp_Image='';
                             $emp_pic='';
                  $staff="SELECT * FROM Staff Where IDNo='$incID'";
                           $stmt = sqlsrv_query($conntest,$staff);  
                           while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                           {
                             $EmailID=$row_staff['EmailID'];
                             $Emp_Name=$row_staff['Name'];
                             $Emp_Image=$row_staff['Snap'];
                             $emp_pic=base64_encode($Emp_Image);
                             $Designation=$row_staff['Designation'];
                             $Department=$row_staff['Department'];
                             $ContactNo=$row_staff['ContactNo'];
                             $aa=$row_staff;

                        

?>


   <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header  border-bottom-0">
                  Infrastructure Incharge (<?=$BlockName?>)
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?=$Emp_Name?></b></h2>
                      <p class="text-muted text-sm"> <?=$Designation?> /
                       <?=$Department?> </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> <?=$EmailID?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone-alt"></i></span> Phone: <?=$ContactNo?></li>
                        <!-- <li class="small"><span class="fa-li"></span><i class="fas fa-lg fa-phone-alt"> <a href="tel:<?=$ContactNo?>"> <?=$ContactNo?></a></i></li> -->
                        <!-- <li class="small"><span class="fa-li"></span><small><i class="fas fa-lg fa-envelope"> <a href="mailto:<?=$EmailID?>"><?=$EmailID?> </a></i></small></li> -->
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="data:image/jpeg;base64,<?=$emp_pic?>" alt="" style="height: 120px; width: 120px" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                     <button class="btn btn-xs btn-success">
                    <small><i class="fas fa-lg fa-phone-alt"> <a href="tel:<?=$ContactNo?>" style='color: white;'>Call</a></i></small>
                        
                     </button> 
                     <button class="btn btn-xs btn-primary">
                    <small><i class="fas fa-lg fa-envelope"> <a href="mailto:<?=$EmailID?>" style='color: white;'>Send Mail</a></i></small>
                        
                     </button>
                  </div>
                </div>
              </div>
            </div>

<?php 
}
}
?></div>

   </div>
</section>
<?php include "footer.php"; ?> 