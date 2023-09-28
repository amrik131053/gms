<?php

 include "header.php"; 
 include "dashboard-alert.php"; 
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
<style type="text/css">
      #whatsapp-floating-button {
  position: fixed;
  bottom: 80px;
  right: 20px;
  width: 60px;
  height: 60px;
  background-color: ;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  z-index: 99999;
}
</style>
<div id="whatsapp-floating-button">
    <a href="https://api.whatsapp.com/send/?phone=917814679220" title="Chat on whatsapp"> <img src="whatsapp.png" alt="WhatsApp" width="50" height="50">
</a>
  </div>
<section class="content">

   <div class="container-fluid">
   
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info shadow-lg">
              <div class="inner">
              <h5>
              
              <?php  echo $timeStamp =date("d-M-Y",strtotime($todaydate));?>
                 
</h5>
            <p>
            <?= $day = date('l', strtotime($todaydate));?>  

</p>
              </div>
              <div class="icon">
                <i class="far fa-calendar"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success shadow-lg">
              <div class="inner">
                <h5 id='paiddays'></h5>


                <p>Numer of  paid Days</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

<form action="export.php" method="POST">

  <input type="hidden" name="exportCode" value="31">

  <input type="hidden" name="month" value="<?= date('m');?>">

    <input type="hidden" name="EmployeeId" value="<?=$EmployeeID;?>">
    <input type="hidden" name="year" value="<?= date('Y');?>">

              <button type="submit"  class="small-box-footer form-control form-control-sm"  style="text-align:center;border-color:transparent;background-color:#55b355;color: white;font-size: 16px;">

                More info <i class="fas fa-arrow-circle-right"></i>
              </Button>
              </form>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning shadow-lg">
              <div class="inner">
               <h5><b>
              <?php  echo $timeStamp =date("d-M-Y",strtotime($todaydate));?></b></h5>
                <p>  <?php  
                    $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1
 from DeviceLogsAll  where LogDateTime Between '$todaydate 01:00:00.000'  AND 
'$todaydate 23:59:00.000' AND EMpCOde='$EmployeeID' ";

$stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
           {
       $intime=$row_staff_att['mytime'];
             $outtime=$row_staff_att['mytime1'];
}
            ?><b> Intime:</b> <?php if($intime!=""){ echo $intime->format('h:i A');} else { echo "<b style='color:red'>No punch</b>";}?>  &nbsp;&nbsp;
            <b> Outime:</b> <?php if($outtime!="" && $outtime>$intime){ echo $outtime->format('h:i A');} else { echo "<b style='color:red'>No punch</b>";}?>
</p>

                <!-- <p>User Registrations</p> -->
              </div>
              <div class="icon">
                <i class="fa fa-clock"></i>
              </div>
              <a href="attendence-calendar.php" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger ">
              <div class="inner">
                <h5><?php  $sql_att="select count(*) as cc from IssueRegister where IDNo='$EmployeeID'";

$stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
           $bcount=$row_staff_att['cc'];      
}     
                       echo $bcount;
                       ?></h5>

                <p>Book Issued</p>
              </div>
              <div class="icon">
                <i class="fas fa-book"></i>
              </div>
              <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

<div class="row">
         <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box shadow-lg">
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
            <div class="info-box shadow-lg">
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
            <div class="info-box shadow-lg">
               <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
               <div class="info-box-content">
                  <span class="info-box-text">Articles</span>
                  <span class="info-box-number"><?php
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
            <div class="info-box shadow-lg">
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



 






<div class="row">
<?php 

  $qry="SELECT  Incharge,Name from stock_summary inner join location_master on location_master.ID=stock_summary.LocationID inner join building_master on building_master.ID=location_master.Block where Corrent_owner='$EmployeeID' and CategoryID='1' GROUP BY Incharge";
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
<p id="ajax-loader"></p>
<script type="text/javascript">
                        function it_instructor()
                               {
                                  var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
                                // alert(id);
                              var code=280;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code},
                                    success:function(response)
                                    {
                                       spinner.style.display='none';
                                       document.getElementById("it_instructor").innerHTML=response;
                                    }
                                 });
                           }  

                            function Infrastructure()
                               {
                                  var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
                                // alert(id);
                              var code=281;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code},
                                    success:function(response)
                                    {
                                       spinner.style.display='none';
                                       document.getElementById("Infrastructure").innerHTML=response;
                                    }
                                 });
                           } 

                           function Electrical()
                               {
                                  var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
                                // alert(id);
                              var code=282;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code},
                                    success:function(response)
                                    {
                                       spinner.style.display='none';
                                       document.getElementById("Electrical").innerHTML=response;
                                    }
                                 });
                           }   

                             function LocationOwners()
                               {
                                  var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
                                // alert(id);
                              var code=283;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code},
                                    success:function(response)
                                    {
                                       spinner.style.display='none';
                                       document.getElementById("LocationOwners").innerHTML=response;
                                    }
                                 });
                           }


                            function paiddays()
                               {
                                  var spinner=document.getElementById("ajax-loader");
                                  var EmployeeId=<?php echo $EmployeeID;?>

const dateToday = new Date();

   
    const currentMonth = dateToday.getMonth()+1;
    const years = dateToday.getFullYear();

  //  alert(currentMonth);

     spinner.style.display='block';
                                // alert(id);
                              var code=334;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code,month:currentMonth,year:years,EmployeeId:EmployeeId},
                                    success:function(response)
                                    {
                                       spinner.style.display='none';
                                       document.getElementById("paiddays").innerHTML=response;
                                    }
                                 });
                           }




                 $(window).on('load', function() {
                  
        $('#modal-lg-notification').modal('show');

paiddays();
    });          
                        </script>
<?php include "footer.php"; ?> 