
<?php
 
session_start();
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
$EmployeeID=$_SESSION['usr'];
   include "connection/connection.php";
       $CurrentExaminationGetDate=date('Y-m-d'); 
      $code=$_GET['code'];
      if ($code==1)
       {
        $id=$_GET['id'];
        ?>
<div class="card-body table-responsive p-0 " style="height: 300px;">
<table class="table  text-nowrap">
      <thead>
         <tr>
            <th>IDNo</th>
            <th>Specifications</th>
            <th>Operating System</th>
            <th>Memory</th>
         </tr>
      </thead>
      <tbody> 
         <?php 
            $building_num=0;
            $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode  WHERE s.IDNo='$id'";
            $building_run=mysqli_query($conn,$building);
            while ($building_row=mysqli_fetch_array($building_run)) 
            {
            $building_num=$building_num+1;?>
         <tr><h3 class="text-center"><b><?=$building_row['ArticleName'];?></b></h3>
            <td>
               <input class="form-control" readonly="" type="text" name="IDNo" value="<?=$building_row['IDNo'];?>"> 
            </td>
            <td>
              
                <select class="form-control" name="Processor">
                <?php if ($building_row['CPU']!='') 
                {
                 
                  echo '<option value="'.$building_row['CPU'].'">'.$building_row['CPU'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $cpu="SELECT Distinct Processor FROM specification where Processor!=''";
                     $reslut_cpu=mysqli_query($conn,$cpu);
                     while ($row_cpu=mysqli_fetch_array($reslut_cpu))
                     {
                     ?>
                  <option value="<?php echo $row_cpu['Processor'];?>">
                     <?php echo $row_cpu['Processor'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
              
                <select class="form-control" name="Operating">
                <?php if ($building_row['OS']!='') 
                {
                 
                  echo '<option value="'.$building_row['OS'].' ">'.$building_row['OS'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $os="SELECT Distinct OS FROM specification where OS!=''";
                     $reslut_os=mysqli_query($conn,$os);
                     while ($row_os=mysqli_fetch_array($reslut_os))
                     {
                     ?>
                  <option value="<?php echo $row_os['OS'];?>">
                     <?php echo $row_os['OS'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                  <option value="NA">NA</option>
               </select>
             </td>
            <td>
               <select class="form-control" name="Memory">
                <?php if ($building_row['Memory']!='') 
                {
                 
                  echo '<option value="'.$building_row['Memory'].' ">'.$building_row['Memory'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $Ram="SELECT Distinct RAM FROM specification where RAM!=''";
                     $reslut_ram=mysqli_query($conn,$Ram);
                     while ($row_ram=mysqli_fetch_array($reslut_ram))
                     {
                     ?>
                  <option value="<?php echo $row_ram['RAM'];?>">
                     <?php echo $row_ram['RAM'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
         </tr>
         <tr>
            <th>Storage</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Serial No</th>
         </tr>
         <tr>
            <td>
               
               <select class="form-control" name="Storage">

                 

                  
                  <?php
                  if ($building_row['Storage']!='') 
                {
                 
                  echo '<option value="'.$building_row['Storage'].' ">'.$building_row['Storage'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 


                     $storage="SELECT Distinct Storage FROM specification where Storage!=''";
                     $reslut_storage=mysqli_query($conn,$storage);
                     while ($row_storage=mysqli_fetch_array($reslut_storage))
                     {
                     ?>
                  <option value="<?php echo $row_storage['Storage'];?>">
                     <?php echo $row_storage['Storage'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
               <select class="form-control" name="Brand">
                 
                  <?php
                  if ($building_row['Brand']!='') 
                {
                 
                  echo '<option value="'.$building_row['Brand'].' ">'.$building_row['Brand'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $brand="SELECT Distinct Brand FROM specification Where Brand!=''";
                     $reslut_brand=mysqli_query($conn,$brand);
                     while ($row_brand=mysqli_fetch_array($reslut_brand))
                     {
                     ?>
                  <option value="<?php echo $row_brand['Brand'];?>">
                     <?php echo $row_brand['Brand'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                  <option value="NA">NA</option>
               </select>
            </td>
            <td>
               <select class="form-control" name="Model">
                 

                  <?php
                   if ($building_row['Model']!='') 
                {
                 
                  echo '<option value="'.$building_row['Model'].' ">'.$building_row['Model'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $model="SELECT Distinct Model FROM specification where Model!=''";
                     $reslut_model=mysqli_query($conn,$model);
                     while ($row_model=mysqli_fetch_array($reslut_model))
                     {
                     ?>
                  <option value="<?php echo $row_model['Model'];?>">
                     <?php echo $row_model['Model'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                  <option value="NA">NA</option>
            </td>
            <td><input type="text" name="SerialNo" class="form-control" value=" <?=$building_row['SerialNo'];?>"></td>
         </tr>
         <tr>
            <th>Local Serial No</th>
            <th>Bill No</th>
            <th>Bill Date</th>
         </tr>
         <tr>
         <td><input type="text" name="DeviceSerailNo" class="form-control" value="<?=$building_row['DeviceSerialNo'];?>"></td>
         <td><input type="text" name="BillNo" class="form-control" value="<?=$building_row['BillNo'];?>"></td>
         <td><input type="date" name="BillDate" class="form-control" value="<?=$building_row['BillDate'];?>"></td></tr>

         <?php 
            }
                       ?>
      </tbody>
   </table>
</div>
<?php
   }
   
   else if ($code==2)
       {
         $id=$_GET['id'];
         ?>
<div class="card-body table-responsive p-0 ">
<table class="table table-head-fixed text-nowrap">
<thead>
<tr>
<th>Block</th>
<th>Floor</th>
<th>Room</th>
<th>Type</th>
<th>Owner ID</th>
</tr>
</thead>
<tbody>
<?php 
   $building_num=0;
 $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode  WHERE s.IDNo='$id'";
   $building_run=mysqli_query($conn,$building);
   while ($building_row=mysqli_fetch_array($building_run)) 
   {
   $building_num=$building_num+1;?>
<tr><h3 class="text-center"><b><?=$building_row['ArticleName'];?></b></h3>
<input type="hidden" name="IDNo" value="<?=$building_row['IDNo'];?>">
<td>
<select class="form-control" required="" name="Block_assign" id="Block_assign" onclick="block_assign();">
<option value="">Select</option>
<?php
   $building_select="SELECT Distinct Name,ID FROM building_master";
   $building_select_run=mysqli_query($conn,$building_select);
   while ($building_select_row=mysqli_fetch_array($building_select_run)) 
   {?>
<option value="<?= $building_select_row['ID'];?>">
<?= $building_select_row['Name'];?>
</option> ";
<?php  }
   ?>
</select>
<input class="form-control" type="hidden" name="CategoryID" value="<?=$building_row['CategoryID'];?>"> </td>
<td>
<select class="form-control" required="" name="Floor" id="Floor_assign" onclick="floor();">
<option value="">Select</option>
</select>
<input class="form-control" type="hidden" name="ArticleCode" readonly="" value="<?=$building_row['ArticleCode'];?>"> </td>
<td>
<select class="form-control" required="" name="RoomNo" id="RoomNo" onclick="roomNo();">
<option value="">Select</option>
</select>
</td>
<td>
<select class="form-control" required="" name="RoomType" id="RoomType" onclick="getid();">
<option value="">Select</option>
</select>
</td>
<td>
   <input type="text" name="stockOwner" required="" class="form-control">

<input type="hidden" name="UserID"  class="form-control"> </td>
<input type="hidden" name="iDNo_assing" id="out"> 
</tr>
<?php 
   }
              ?>
</tbody>
</table>
</div>
<?php
   }
    else if ($code==3)
       {
          $id=$_GET['id'];
   $building_master="SELECT * FROM building_master where ID='$id'";
                              $building_master_run=mysqli_query($conn,$building_master);
                              while ($building_master_row=mysqli_fetch_array($building_master_run)) 
                              {?>
<input type="hidden" name="ID" value="<?=$id;?>">
<label>Building Name</label>
<input type="text" class="form-control" name="Name" value="<?=$building_master_row['Name'];?>">
<label>Incharge ID</label>
<input type="text" class="form-control" name="Incharge" value="<?=$building_master_row['Incharge'];?>">
<?php
   }
   
   }
   else if ($code==4)
   {
   $block=$_GET['block'];
   $floor=$_GET['floor'];
   $type=$_GET['type'];
   $RoomNo=$_GET['room'];
   
   $room_type="SELECT * FROM location_master where Block='$block' and Floor='$floor' and RoomNo='$RoomNo' and Type='$type'";
   $room_type_run=mysqli_query($conn,$room_type);
   while ($room_type_row=mysqli_fetch_array($room_type_run)) 
   { 
   echo $room_type_row['ID'];
    ?>

<?php
   }
   
   }
   
   else if ($code==5) 
   {
    $location_num=0;
   ?>

   
       <?php 
            $id=$_GET['id'];     
                 
            $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo,clg.name as CollegeName,rtm.ID as rtmID,rnm.ID as rmnID,clg.ID as clgID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID left JOIN colleges clg ON clg.ID=lm.CollegeID  where lm.ID='$id' ";
            
                $location_run=mysqli_query($conn,$location);
                if ($location_row=mysqli_fetch_array($location_run)) 
                {
                $location_num=$location_num+1;
            ?>
          
            <div class="row">
         <div class="col-lg-3 col-sm-12 col-md-12">
      <label>ID</label>
       <input type="text" name="" class="form-control" value="<?=$id;?>" disabled>
   </div> 
          <div class="col-lg-3 col-sm-12 col-md-12">
      <label>Block</label>
      <input type="text" name="" class="form-control" value="  <?=$location_row['Name'];?>"disabled>
   </div>    
     <div class="col-lg-3 col-sm-12 col-md-12">
       <label>Floor</label>
       <input type="text" name="" class="form-control" value="<?=$location_row['FloorName'];?>" disabled>
   </div>  
   <div class="col-lg-3 col-sm-12 col-md-12">
       <label>Room No</label>
         <input type="text" name="" class="form-control" value="  <?=$location_row['RoomNo'];?>" disabled>
   </div>

   </div> 
   <div class="row"> 
     
       <input type="hidden" name="locationID" id='locationID' value="<?=$id;?>">
                 
           
   <div class="col-lg-2 col-sm-12 col-md-12">
       <label>Room Type</label>
       <select class="form-control" name="RoomType" id="RoomType" required="">
                                 <option value="<?=$location_row['rtmID'];?>"><?=$location_row['RoomType'];?></option>
                                  <?php
                                    $room_type_select="SELECT Distinct RoomType,ID FROM room_type_master";
                                    $room_type_select_run=mysqli_query($conn,$room_type_select);
                                    while ($room_type_select_row=mysqli_fetch_array($room_type_select_run)) 
                                    {?>
                                    <option value="<?= $room_type_select_row['ID'];?>"><?= $room_type_select_row['RoomType'];?></option>
                                   <?php  }
                                    
                                    ?>
                               </select>
   </div>
    <div class="col-lg-2 col-sm-12 col-md-12">
       <label>Room Name</label>
        <select class="form-control" name="RoomName" id="RoomName1" required="">
                                 <option value="<?=$location_row['rmnID'];?>"><?=$location_row['RoomName'];?></option>
                                  <?php
                                    $room_type_select="SELECT Distinct RoomName,ID FROM room_name_master";
                                    $room_type_select_run=mysqli_query($conn,$room_type_select);
                                    while ($room_type_select_row=mysqli_fetch_array($room_type_select_run)) 
                                    {?>
                                    <option value="<?= $room_type_select_row['ID'];?>"><?= $room_type_select_row['RoomName'];?></option>";
                                   <?php  }
                                    
                                    ?>
                               </select>
   </div>     
    <div class="col-lg-2 col-sm-12 col-md-12">
      <label>location_owner </label>
        <input type="text" name="location_owner" class="form-control" id='location_owner' value="<?=$location_row['location_owner'];?>" required="">

    </div> <div class="col-lg-4 col-sm-12 col-md-12">
       <label>College Name</label>
        <select class="form-control" name="College" id="college" required="">
                                 <option value="<?=$location_row['clgID'];?>"><?=$location_row['CollegeName'];?></option>
                                 <?php
                                    $colleges_select="SELECT Distinct name,ID FROM colleges";
                                    $colleges_select_run=mysqli_query($conn,$colleges_select);
                                    while ($colleges_select_row=mysqli_fetch_array($colleges_select_run)) 
                                    {?>
                                    <option value="<?= $colleges_select_row['ID'];?>"><?= $colleges_select_row['name'];?></option>
                                   <?php  }
                                    
                                    ?>
                              </select>
                           </div>
                              <div class="col-lg-1 col-sm-12 col-md-12">
                                 <label>&nbsp;</label>
                               <button  class="btn btn-primary" onclick="update_location(<?=$id;?>)">Update</button>

   </div>     

             
           
          


         <?php
            }
            ?>
   </div>
<?php
   }
   else if ($code==6)
   {
      $id=$_GET['id'];
   $room_type="SELECT * FROM master_article where ArticleCode='$id'";
                         $room_type_run=mysqli_query($conn,$room_type);
                         while ($room_type_row=mysqli_fetch_array($room_type_run)) 
                         { ?>
<input type="hidden" name="id" value="<?=$room_type_row['ArticleCode'];?>">
<label>Article Name</label>
<input type="text" class="form-control" name="Articlename" value="<?=$room_type_row['ArticleName'];?>">
<?php
   }
   
   }
   
   else if ($code==7)
   {
   $id=$_GET['id'];
   $room_type="SELECT * FROM master_calegories where ID='$id'";
     $room_type_run=mysqli_query($conn,$room_type);
     while ($room_type_row=mysqli_fetch_array($room_type_run)) 
     { ?>
<input type="hidden" name="id" value="<?=$room_type_row['ID'];?>">
<label>Category Name</label>
<input type="text" class="form-control" name="CategoryName" value="<?=$room_type_row['CategoryName'];?>">
<?php
   }
   
   }
       else if ($code==8) 
   {
   $location_num=0;
   ?>
<div class="card-body table-responsive p-0" style="height: 100%;">
         <?php 
             $id=$_GET['id'];     
              // echo  $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID INNER join stock_summary ss ON lm.ID=ss.LocationID INNER JOIN master_calegories mc ON mc.ID=ss.CategoryID  INNER join master_article on ss.ArticleCode=master_article.ArticleCode INNER join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id' ";

             $location="SELECT *, lm.RoomNo as Room_No FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName  WHERE ss.IDNo='$id'";
         
            
                $location_run=mysqli_query($conn,$location);
                if ($location_row=mysqli_fetch_array($location_run)) 
                {
                 $location_num=$location_num+1;

                 $EmployeeID=$location_row['Corrent_owner'];
                 if (strlen($EmployeeID)>7) 
                 {
                     $result1 = "SELECT  * FROM Admissions where IDNo='$EmployeeID'"; 
                     $stmt1 = sqlsrv_query($conntest,$result1);
                     while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                     {
                        $IDNo= $row['IDNo'];
                        $ClassRollNo= $row['ClassRollNo'];
                        $img= $row['Snap'];
                        $UniRollNo= $row['UniRollNo'];
                        $name = $row['StudentName'];
                        $father_name = $row['FatherName'];
                        $mother_name = $row['MotherName'];
                        $course = $row['Course'];
                        $email = $row['EmailID'];
                        $phone = $row['StudentMobileNo'];
                        $batch = $row['Batch'];
                        $college = $row['CollegeName'];
                     }
                 }
                 else if(strlen($EmployeeID)>4 && strlen($EmployeeID)<7) 
                 {
                  $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
                  $q1 = sqlsrv_query($conntest, $sql1);
                  while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
                  {
                     $name = $row['Name'];
                     $Department=$row['Department'];
                     $Designation=$row['Designation'];
                     $CollegeName=$row['CollegeName'];
                  } 
                 }
                 
                 else if(strlen($EmployeeID)<3) 
                 {
                 $resultout = "SELECT  * FROM outside_owners where id='$EmployeeID'";

 $building_out=mysqli_query($conn,$resultout);

while ($building_rowo=mysqli_fetch_array($building_out)) 
               {
                           
                 $EmployeeID= $building_rowo['id'];
                 $Designation= $building_rowo['designation'];
                 $name = $building_rowo['name'];
                 $UniRollNo= '';
   
               }
            } 
                 }

if ($EmployeeID!=0) {

      if (strlen($EmployeeID)>7) 
      {
             ?>
            <label>Current Owner</label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
           
            
            <th>Roll No.</th>
            <th>Name</th>
            <th>College</th>
            <th>Course</th>
         </tr>
      </thead>
      <tbody><tr>
           
            <td>
               <?=$ClassRollNo;?>/<?=$UniRollNo;?>
            </td>
            <td>
               <?=$name;?>
            </td>
            <td>
               <?=$college;?>
            </td>
            <td>
               <?=$course;?>
            </td>
         </tr>
      </tbody>
   </table>
   <br>
   <?php
      }
   else if(strlen($EmployeeID)>4 && strlen($EmployeeID)<7) 
      {

            ?>
            <label>Current Owner</label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
           
            
            <th>Employee ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Department</th>
         </tr>
      </thead>
      <tbody><tr>
           
            <td>
               <?=$EmployeeID;?>
            </td>
            <td>
               <?=$name;?>
            </td>
            <td>
               <?=$Designation;?>
            </td>
            <td>
               <?=$Department;?>
            </td>
         </tr>
      </tbody>
   </table>
   <br>
   <?php 
   }
   else
   {
?>

 <label>Current Owner</label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
           
            
            <th>ID</th>
            <th>Name</th>
            <th>Designation</th>
            
         </tr>
      </thead>
      <tbody><tr>
           
            <td>
               <?=$EmployeeID;?>
            </td>
            <td>
               <?=$name;?>
            </td>
            <td>
               <?=$Designation;?>
            </td>
           
         </tr>
      </tbody>
   </table>
  <?php  }

?>
   <label>Location</label>
    <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
           
            <th>Block</th>
            <th>Floor</th>
            <th>Room No</th>
            <th>Room Type</th>
            <th>Room Name</th>
            
         </tr>
      </thead>
      <tbody>
         <tr>
            
            <td>
               <?=$location_row['Name'];?>
            </td>
            <td>
               <?=$location_row['Floor'];?>
            </td>
            <td>
               <?=$location_row['Room_No'];?>
            </td>
            <td>
               <?=$location_row['RoomType'];?>
            </td>
            <td>
               <?=$location_row['RoomName'];?>
            </td>
            
         </tr>
      </tbody>
   </table>
   <br>
   <label>Particular's Description(<?=$id?>)</label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Article </th>
            <th>Specifications</th>
            <th>Storage</th>
            <th>Brand</th>
            <th>OS</th>
            <th>Memory</th>
            <th>Model</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$location_row['ArticleName'];?>
            </td>
            <td>
               <?=$location_row['CPU'];?>
            </td>
            <td>
               <?=$location_row['Storage'];?>
            </td>
            <td>
               <?=$location_row['Brand'];?>
            </td>
            <td>
               <?=$location_row['OS'];?>
            </td>
            <td>
               <?=$location_row['Memory'];?>
            </td>
            <td>
               <?=$location_row['Model'];?>
            </td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
</div>
<?php
   }
   else if ($code==9) 
     {
   $id=$_GET['id'];
   $pageUrl=$_GET['page'];
   $checkStockQry="SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode inner join category_permissions on category_permissions.CategoryCode=c.ID where category_permissions.employee_id='$EmployeeID' and s.IDNo='$id' ";
   $checkStockRes=mysqli_query($conn,$checkStockQry);
   if($checkStockData=mysqli_fetch_array($checkStockRes))
   {
      $stockStatus=$checkStockData['Status'];
   ?>
<form action="action.php" method="post">
   <input type="hidden" name="code" value="20">
   <input type="hidden" name="pageUrl" value="<?=$pageUrl?>">
   <div class="card-body table-responsive p-0 " >
      <table class="table table-head-fixed text-nowrap">
         <thead>
            <tr>
               <th>IDNo</th>
               <th>Specifications</th>
               <th>Operating System</th>
               <th>Memory</th>
            </tr>
         </thead>
         <tbody>
            <?php 
               $building_num=0;
               $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode  WHERE s.IDNo='$id'";
               $building_run=mysqli_query($conn,$building);
               while ($building_row=mysqli_fetch_array($building_run)) 
               {
               $building_num=$building_num+1;?>
           <tr> <h3 class="text-center"><b><?=$building_row['ArticleName'];?>(<?= $articlecode=$building_row['ArticleCode'];?>)</b></h3>
            <td>
               <input class="form-control" readonly="" type="text" name="IDNo" value="<?=$building_row['IDNo'];?>"> 
            </td>
            <td>
              
                <select class="form-control" name="Processor">
                <?php if ($building_row['CPU']!='') 
                {
                 
                  echo '<option value="'.$building_row['CPU'].'">'.$building_row['CPU'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $cpu="SELECT Distinct Processor FROM specification where Processor!=''";
                     $reslut_cpu=mysqli_query($conn,$cpu);
                     while ($row_cpu=mysqli_fetch_array($reslut_cpu))
                     {
                     ?>
                  <option value="<?php echo $row_cpu['Processor'];?>">
                     <?php echo $row_cpu['Processor'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
              
                <select class="form-control" name="Operating">
                <?php if ($building_row['OS']!='') 
                {
                 
                  echo '<option value="'.$building_row['OS'].' ">'.$building_row['OS'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $os="SELECT Distinct OS FROM specification where OS!=''";
                     $reslut_os=mysqli_query($conn,$os);
                     while ($row_os=mysqli_fetch_array($reslut_os))
                     {
                     ?>
                  <option value="<?php echo $row_os['OS'];?>">
                     <?php echo $row_os['OS'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
             </td>
            <td>
               <select class="form-control" name="Memory">
                <?php if ($building_row['Memory']!='') 
                {
                 
                  echo '<option value="'.$building_row['Memory'].' ">'.$building_row['Memory'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $Ram="SELECT Distinct RAM FROM specification where RAM!=''";
                     $reslut_ram=mysqli_query($conn,$Ram);
                     while ($row_ram=mysqli_fetch_array($reslut_ram))
                     {
                     ?>
                  <option value="<?php echo $row_ram['RAM'];?>">
                     <?php echo $row_ram['RAM'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
         </tr>
         <tr>
            <th>Storage</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Serial No</th>
         </tr>
         <tr>
            <td>
               
               <select class="form-control" name="Storage">

                 

                  
                  <?php
                  if ($building_row['Storage']!='') 
                {
                 
                  echo '<option value="'.$building_row['Storage'].' ">'.$building_row['Storage'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 


                     $storage="SELECT Distinct Storage FROM specification where Storage!=''";
                     $reslut_storage=mysqli_query($conn,$storage);
                     while ($row_storage=mysqli_fetch_array($reslut_storage))
                     {
                     ?>
                  <option value="<?php echo $row_storage['Storage'];?>">
                     <?php echo $row_storage['Storage'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
               <select class="form-control" name="Brand">
                 
                  <?php
                  if ($building_row['Brand']!='') 
                {
                 
                  echo '<option value="'.$building_row['Brand'].' ">'.$building_row['Brand'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $brand="SELECT Distinct Brand FROM specification where Brand!=''";
                     $reslut_brand=mysqli_query($conn,$brand);
                     while ($row_brand=mysqli_fetch_array($reslut_brand))
                     {
                     ?>
                  <option value="<?php echo $row_brand['Brand'];?>">
                     <?php echo $row_brand['Brand'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
               <select class="form-control" name="Model">
                 

                  <?php
                   if ($building_row['Model']!='') 
                {
                 
                  echo '<option value="'.$building_row['Model'].' ">'.$building_row['Model'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $model="SELECT Distinct Model FROM specification where Model!=''";
                     $reslut_model=mysqli_query($conn,$model);
                     while ($row_model=mysqli_fetch_array($reslut_model))
                     {
                     ?>
                  <option value="<?php echo $row_model['Model'];?>">
                     <?php echo $row_model['Model'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
            </td>
            <td><input type="text" name="SerialNo" class="form-control" value="<?=$building_row['SerialNo'];?>"></td>
         </tr>
         <tr>
            <th>Local Serial No</th>
             <th>Bill No</th>
              <th>Bill Date</th>
            
         </tr>
         <tr>
         <td><input type="text" name="DeviceSerailNo" class="form-control" value="<?=$building_row['DeviceSerialNo'];?>"></td>
         <td>
            <!-- <input type="text" name="BillNo" class="form-control" value="<?=$building_row['BillNo'];?>"> -->
            <select name="BillNo" class="form-control" onchange="billDate(this.value)">
               <?php 
               if ($building_row['BillNo']) 
               {
                  ?>
                     <option  value="<?=$building_row['BillNo'];?>"> <?=$building_row['BillNo'];?></option>
                  <?php 
               }
               else
               {
                   ?>
                     <option  value=''> Select</option>
                  <?php
               }
            $billSql="SELECT Distinct BillNo from stock_summary";
            $billRes=mysqli_query($conn,$billSql);
            while($billData=mysqli_fetch_array($billRes))
            {
               ?>
               <option value="<?=$billData['BillNo']?>"><?=$billData['BillNo']?></option>
               <?php
            }
            ?> 
            </select>
         </td>
         <td>
            <!-- <input type="date" name="BillDate" class="form-control" value="<?=$building_row['BillDate'];?>"> -->
            <select name="BillDate" class="form-control" id="billdate">
               <?php 
               if ($building_row['BillDate']) 
               {
                  ?>
                     <option  value="<?=$building_row['BillDate'];?>"> <?=$building_row['BillDate'];?></option>
                  <?php 
               }
               else
               {
                   ?>
                     <option  value=''> Select</option>
                  <?php
               }
               ?>
            </select>
         </td>
      </tr>
         <?php 
            }
                       ?>
        
<tr>
    <?php 
    $j=1;  $billSql="SELECT * FROM article_images where article_id='$articlecode' ";
            $billRes=mysqli_query($conn,$billSql);
            while($billData=mysqli_fetch_array($billRes))
            {
               
               ?>
             <td style="width:20%">

              
                     <input type="radio"  id="radioPrimary<?=$j;?>"   value="<?=$billData['id'];?>" name="empc1">
                     <label for="radioPrimary<?=$j;?>">
           <img src="http://gurukashiuniversity.co.in/data-server/articleimages/<?=$billData['image'];?>" style="width:50px;height:50px">
                     </label>
                


         </td>     
              
               <?php
               $j++;
            }
            ?> 
           
         

</tr>


<tr>



            <td>
               <?php 
               // if ($stockStatus!=2) 
               // {
                     ?>
                     <button type="submit" class="btn btn-secondary" style="background-color: #a62532">Submit</button>
                     <?php
               // }
               ?>
            </td>
            </tr>


         </tbody> 
      </table>
   </div>
</form>
</div>
<?php
   }
   else
   {
      ?>
      <div class="alert alert-warning" role="alert">
         You don't have permission for this article. <br> Scan other article. 
      </div> 
      <?php
   }
}
   
   else if ($code==10)
       {
          $id=$_GET['id'];
   $room_name="SELECT * FROM room_name_master where ID='$id'";
                              $room_name_run=mysqli_query($conn,$room_name);
                              while ($room_name_row=mysqli_fetch_array($room_name_run)) 
                              {?>
<input type="hidden" name="id" value="<?=$id;?>">
<input type="text" class="form-control" name="Roomname" value="<?=$room_name_row['RoomName'];?>">
<?php
   }
   
   }
   
   else if ($code==11)
   {
   $id=$_GET['id'];
   ?>
<form action="action.php" method="post">
<input type="hidden" name="code" value="20">
<div class="card-body table-responsive p-0 " style="height: 300px;">
<table class="table  text-nowrap">
<thead>
<tr>
<th>IDNo</th>
<th>Specifications</th>
<th>Operating System</th>
<th>Memory</th>
</tr>
</thead>
<tbody>
<?php 
   $building_num=0;
   $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode  WHERE s.IDNo='$id'";
   $building_run=mysqli_query($conn,$building);
   while ($building_row=mysqli_fetch_array($building_run)) 
   {
   $building_num=$building_num+1;?>
 <tr><h3 class="text-center"><b><?=$building_row['ArticleName'];?></b></h3>
            <td>
               <input class="form-control" readonly="" type="text" name="IDNo" value="<?=$building_row['IDNo'];?>"> 
            </td>
            <td>
              
                <select class="form-control" name="Processor">
                <?php if ($building_row['CPU']!='') 
                {
                 
                  echo '<option value="'.$building_row['CPU'].'">'.$building_row['CPU'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $cpu="SELECT Distinct Processor FROM specification where Processor!=''";
                     $reslut_cpu=mysqli_query($conn,$cpu);
                     while ($row_cpu=mysqli_fetch_array($reslut_cpu))
                     {
                     ?>
                  <option value="<?php echo $row_cpu['Processor'];?>">
                     <?php echo $row_cpu['Processor'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
              
                <select class="form-control" name="Operating">
                <?php if ($building_row['OS']!='') 
                {
                 
                  echo '<option value="'.$building_row['OS'].' ">'.$building_row['OS'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $os="SELECT Distinct OS FROM specification where OS!=''";
                     $reslut_os=mysqli_query($conn,$os);
                     while ($row_os=mysqli_fetch_array($reslut_os))
                     {
                     ?>
                  <option value="<?php echo $row_os['OS'];?>">
                     <?php echo $row_os['OS'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
             </td>
            <td>
               <select class="form-control" name="Memory">
                <?php if ($building_row['Memory']!='') 
                {
                 
                  echo '<option value="'.$building_row['Memory'].' ">'.$building_row['Memory'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $Ram="SELECT Distinct RAM FROM specification where RAM!=''";
                     $reslut_ram=mysqli_query($conn,$Ram);
                     while ($row_ram=mysqli_fetch_array($reslut_ram))
                     {
                     ?>
                  <option value="<?php echo $row_ram['RAM'];?>">
                     <?php echo $row_ram['RAM'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
         </tr>
         <tr>
            <th>Storage</th>
            <th>Brand</th>
            <th>Model</th>
         <th>Serial No</th>
         </tr>
         <tr>
            <td>
               
               <select class="form-control" name="Storage">

                 

                  
                  <?php
                  if ($building_row['Storage']!='') 
                {
                 
                  echo '<option value="'.$building_row['Storage'].' ">'.$building_row['Storage'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 


                     $storage="SELECT Distinct Storage FROM specification where Storage!=''" ;
                     $reslut_storage=mysqli_query($conn,$storage);
                     while ($row_storage=mysqli_fetch_array($reslut_storage))
                     {
                     ?>
                  <option value="<?php echo $row_storage['Storage'];?>">
                     <?php echo $row_storage['Storage'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
               <select class="form-control" name="Brand">
                 
                  <?php
                  if ($building_row['Brand']!='') 
                {
                 
                  echo '<option value="'.$building_row['Brand'].' ">'.$building_row['Brand'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $brand="SELECT Distinct Brand FROM specification where Brand!=''";
                     $reslut_brand=mysqli_query($conn,$brand);
                     while ($row_brand=mysqli_fetch_array($reslut_brand))
                     {
                     ?>
                  <option value="<?php echo $row_brand['Brand'];?>">
                     <?php echo $row_brand['Brand'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
               <select class="form-control" name="Model">
                 

                  <?php
                   if ($building_row['Model']!='') 
                {
                 
                  echo '<option value="'.$building_row['Model'].' ">'.$building_row['Model'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $model="SELECT Distinct Model FROM specification Where Model!=''";
                     $reslut_model=mysqli_query($conn,$model);
                     while ($row_model=mysqli_fetch_array($reslut_model))
                     {
                     ?>
                  <option value="<?php echo $row_model['Model'];?>">
                     <?php echo $row_model['Model'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
            </td>
            <td><input type="text" name="SerialNo" value="<?=$building_row['SerialNo'];?>" class="form-control"></td>
         </tr>
         <tr>
            <th>Local Serial No</th>
            <th>Bill No</th>
            <th>Bill Date</th>
         </tr>
         <tr>
         <td><input type="text" name="DeviceSerailNo" value="<?=$building_row['DeviceSerialNo'];?>" class="form-control"></td>
         <td><input type="text" name="BillNo" value="<?=$building_row['BillNo'];?>" class="form-control"></td>
         <td><input type="date" name="BillDate" value="<?=$building_row['BillDate'];?>" class="form-control"></td>
      </tr>
         <?php 
            }
                       ?>
</tbody>
</table>


</div>
<input type="Submit" name="" value="Update" class="btn btn-success btn-xs">
</form>
</div>
<?php
   }
   elseif ($code=='12')
    {
     $id=$_GET['id'];
     if ($id!='')
      {
         $category_search_num=0;
                              $category_search="SELECT * FROM master_calegories where ID='$id' || CategoryName LIKE '%$id%'";
                              $category_search_run=mysqli_query($conn,$category_search);
                              while ($category_search_row=mysqli_fetch_array($category_search_run)) 
                              {
                              $category_search_num=$category_search_num+1;?>
                           <tr>
                              <td><?=$category_search_num;?></td>
                              <td><?=$category_search_row['CategoryName'];?></td>
                              <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_update" onclick="update_category_search(<?=$category_search_row['ID'];?>);" style="color:#a62532;"></i></td>
                           </tr>
                           <?php 
                              }
     }
     else
     {
        $category_search_num=0;
                              $category_search="SELECT * FROM master_calegories";
                              $category_search_run=mysqli_query($conn,$category_search);
                              while ($category_search_row=mysqli_fetch_array($category_search_run)) 
                              {
                              $category_search_num=$category_search_num+1;?>
                           <tr>
                              <td><?=$category_search_num;?></td>
                              <td><?=$category_search_row['CategoryName'];?></td>
                              <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_update" onclick="update_category_search(<?=$category_search_row['ID'];?>);" style="color:#a62532;"></i></td>
                           </tr>
                           <?php 
                              }
     }
                            
                              
   }
      elseif ($code=='13')
    {
     $id=$_GET['id'];
     if ($id!='')
      {
         $article_search_num=0;
                              $article_search=" SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  where a.ArticleCode='$id' || a.ArticleName LIKE '%$id%'|| c.CategoryName LIKE '%$id%'";
                              $article_search_run=mysqli_query($conn,$article_search);
                              while ($article_search_row=mysqli_fetch_array($article_search_run)) 
                              {
                              $article_search_num=$article_search_num+1;?>
                           <tr>
                        <td><?=$article_search_num;?></td>
                        <td><?=$article_search_row['CategoryName'];?></td>
                        <td><?=$article_search_row['ArticleName'];?></td>
                        <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_update" onclick="update_article(<?=$article_search_row['ArticleCode'];?>);" style="color:#a62532;"></i></td>
                     </tr>
                           <?php 
                              }
     }
     else
     {
        $article_search_num=0;
                              $article_search=" SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode ";
                              $article_search_run=mysqli_query($conn,$article_search);
                              while ($article_search_row=mysqli_fetch_array($article_search_run)) 
                              {
                              $article_search_num=$article_search_num+1;?>
                           <tr>
                        <td><?=$article_search_num;?></td>
                        <td><?=$article_search_row['CategoryName'];?></td>
                        <td><?=$article_search_row['ArticleName'];?></td>
                        <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_update" onclick="update_article(<?=$article_search_row['ArticleCode'];?>);" style="color:#a62532;"></i></td>
                     </tr>
                           <?php 
                              }
     }
                            
                              
   }

         elseif ($code=='14')
    {
     $id=$_GET['id'];
     if ($id!='')
      {
         
                              $building_search=" SELECT * FROM building_master where ID='$id' || Name LIKE '%$id%'";
                              $building_search_run=mysqli_query($conn,$building_search);
                              while ($building_search_row=mysqli_fetch_array($building_search_run)) 
                              {
                              ?>
                          <tr>
                     
                        <td><?=$building_search_row['ID'];?></td>
                        <td><?=$building_search_row['Name'];?></td>
                        <td><i class="fa fa-edit fa-lg" style="color:#a62532;"></i></td>
                     </tr>
                           <?php 
                              }
     }
     else
     {
        $building_search=" SELECT * FROM building_master";
                              $building_search_run=mysqli_query($conn,$building_search);
                              while ($building_search_row=mysqli_fetch_array($building_search_run)) 
                              {
                              ?>
                          <tr>
                     
                        <td><?=$building_search_row['ID'];?></td>
                        <td><?=$building_search_row['Name'];?></td>
                        <td><i class="fa fa-edit fa-lg" style="color:#a62532;"></i></td>
                     </tr>
                           <?php 
                              }
     }
                            
                              
   }

            elseif ($code=='15')
    {
     $id=$_GET['id'];
     if ($id!='')
      {
         
                              
                           $room_type="SELECT * FROM room_type_master where ID='$id' || RoomType LIKE '%$id%'";
                           $room_type_run=mysqli_query($conn,$room_type);
                           while ($room_type_row=mysqli_fetch_array($room_type_run)) 
                           {
                           ?>
                        <tr>
                          <!--  <td><?=$room_type_num;?></td> -->
                          <td><?=$room_type_row['ID'];?></td>
                           <td><?=$room_type_row['RoomType'];?></td>
                           <td><i class="fa fa-edit fa-lg"  data-toggle="modal" data-target="#exampleModalCenter" onclick="edit_room_type(<?=$room_type_row['ID'];?>);" style="color:red;"></i></td>
                        </tr>
                           <?php 
                              }
     }
     else
     {
        $room_type_num=0;
                           $room_type="SELECT * FROM room_type_master";
                           $room_type_run=mysqli_query($conn,$room_type);
                           while ($room_type_row=mysqli_fetch_array($room_type_run)) 
                           {
                           $room_type_num=$room_type_num+1;?>
                        <tr>
                           <td><?=$room_type_num;?></td>
                           <td><?=$room_type_row['RoomType'];?></td>
                           <td><i class="fa fa-edit fa-lg"  data-toggle="modal" data-target="#exampleModalCenter" onclick="edit_room_type(<?=$room_type_row['ID'];?>);" style="color:red;"></i></td>
                        </tr>
                           <?php 
                              }
     }
                            
                              
   }

          elseif ($code=='16')
    {
     $id=$_GET['id'];
     if ($id!='')
      {
         
                              
                       
                          
                           $room_type="SELECT * FROM room_name_master where ID='$id' || RoomName LIKE '%$id%'";
                           $room_type_run=mysqli_query($conn,$room_type);
                           while ($room_type_row=mysqli_fetch_array($room_type_run)) 
                           {
                         ?>
                        <tr>
                           <td><?=$room_type_row['ID'];?></td>
                           <td><?=$room_type_row['RoomName'];?></td>
                           <td><i class="fa fa-edit fa-lg"  data-toggle="modal" data-target="#exampleModalCenter" onclick="edit_room_name(<?=$room_type_row['ID'];?>);" style="color:red;"></i></td>
                        </tr>
                           <?php 
                              }
     }
     else
     {
      
                       
                           $room_type="SELECT * FROM room_name_master";
                           $room_type_run=mysqli_query($conn,$room_type);
                           while ($room_type_row=mysqli_fetch_array($room_type_run)) 
                           {
                           ?>
                        <tr>
                           <td><?=$room_type_row['ID'];?></td>
                           <td><?=$room_type_row['RoomName'];?></td>
                           <td><i class="fa fa-edit fa-lg"  data-toggle="modal" data-target="#exampleModalCenter" onclick="edit_room_name(<?=$room_type_row['ID'];?>);" style="color:red;"></i></td>
                        </tr>
                           <?php 
                              }
     }
                            
                              
   }

                elseif ($code=='17')
    {
     $id=$_GET['id'];
     if ($id!='')
      {
         
                              
                       
                           $location_num=0;
                             $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID where r.Floor like'%$id%' || r.RoomNo like '%$id%' || b.Name like '%$id%' || rnm.RoomName like '%$id%'|| l.location_owner like '%$id%'";
                             ?>
<table class="table table-head-fixed text-nowrap table-bordered" id="example">
   <thead>
      <tr>
         <th>ID</th>
         <th>Block</th>
         <th>Floor</th>
         <th>Room Type/No</th>
         <th>Owner Name</th>
         <th>Action</th>
         <th>Action</th>
         <th>Action</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody  >
              <?php          $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {
                        $location_num=$location_num+1;?>
                     <tr>
                        <td><?=$location_num;?></td>
                        <td><?=$location_row['Name'];?>(<?=$location_row['l_id'];?>)</td>

                        <td><?=$location_row['FloorName'];?></td>
                     
                        <td><?=$location_row['RoomType'];?>-<?=$location_row['RoomNoo'];?> <b>(<?=$location_row['RoomName'];?>)</b></td>
                          <td><?php 
                         echo  "Emp ID:".$empID=$location_row['location_owner'];
                         echo "<br>";
                           $staff="SELECT Name FROM Staff Where IDNo='$empID'";
 $stmt = sqlsrv_query($conntest,$staff);  
while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
     {
echo "<b>".$Emp_Name=$row_staff['Name']."</b>";
     }

                          ?>                 

                          </td>
                        <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_view" onclick="view_location(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
                        <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_serial_no_Modal" onclick="view_serials(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
<?php 
if ($empID!='')
 {
    ?>
                       <!--  <td><input type="submit" class="btn btn-success btn-xs" name="" value="Assign" data-toggle="modal" data-target="#exampleModal_bulk" onclick="bulk_assign_location(<?=$location_row['l_id'];?>);">
                        </td> -->
                        <td><input type="submit" class="btn btn-success btn-xs" name="" value="Assign"  onclick="page_open(<?=$location_row['l_id'];?>);">
                        </td>
                        <?php
}
else {
   ?> <td><input type="submit" class="btn btn-danger btn-xs" name="" value="Update">
                        </td><?php
}
                        ?>
                        <td><form action="stock_report.php" method="post" target="_blank">
                          <input type="hidden" name="ID" value="<?=$location_row['l_id'];?>">
                          <button class="fa fa-print fa-lg" type="submit" style="color: green; border: none; background: none;"></button></form></td>
                     </tr>
                     <?php 
                        }
     }
     else
     {
        $location_num=0;
                       
                              $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID ";

?>
<table class="table table-head-fixed text-nowrap table-bordered" id="example">
   <thead>
      <tr>
         <th>ID</th>
         <th>Block</th>
         <th>Floor</th>
         <th>Room Type/No</th>
         <th>Owner Name</th>
         <th>Action</th>
         <th>Action</th>
         <th>Action</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody  >

                   <?php     $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {
                        $location_num=$location_num+1;?>
                      <tr>
                        <td><?=$location_num;?></td>
                                                <td><?=$location_row['Name'];?>(<?=$location_row['l_id'];?>)</td>

                        <td><?=$location_row['FloorName'];?></td>
                     
                         <td><?=$location_row['RoomType'];?>-<?=$location_row['RoomNoo'];?> <b>(<?=$location_row['RoomName'];?>)</b></td>
                          <td><?php 
                         echo  "Emp ID:".$empID=$location_row['location_owner'];
                         echo "<br>";
                           $staff="SELECT Name FROM Staff Where IDNo='$empID'";
 $stmt = sqlsrv_query($conntest,$staff);  
while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
     {
echo "<b>".$Emp_Name=$row_staff['Name']."</b>";
     }

                          ?>                 

                          </td>
                        <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_view" onclick="view_location(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
                        <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_serial_no_Modal" onclick="view_serials(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
<?php 
if ($empID!='')
 {
    ?>
                       <!--  <td><input type="submit" class="btn btn-success btn-xs" name="" value="Assign" data-toggle="modal" data-target="#exampleModal_bulk" onclick="bulk_assign_location(<?=$location_row['l_id'];?>);">
                        </td> -->
                        <td><input type="submit" class="btn btn-success btn-xs" name="" value="Assign"  onclick="page_open(<?=$location_row['l_id'];?>);">
                        </td>
                        <?php
}
else {
   ?> <td><input type="submit" class="btn btn-danger btn-xs" name="" value="Update">
                        </td><?php
}
                        ?>
                        <td><form action="stock_report.php" method="post" target="_blank">
                          <input type="hidden" name="ID" value="<?=$location_row['l_id'];?>">
                          <button class="fa fa-print fa-lg" type="submit" style="color: green; border: none; background: none;"></button></form></td>
                     </tr>
                     <?php 
                        }
     }
                            
                              
   }
            elseif ($code=='18')
    {
     $id=$_GET['id'];
     if ($id!='')
      {
                  
                            $search_specification="  SELECT * FROM specification where Brand like '%$id%' || RAM like '%$id%' || Processor like '%$id%' || OS like '%$id%' || Model like '%$id%' || Storage like '%$id%' Order by ID ASC";
                           $search_specification_run=mysqli_query($conn,$search_specification);
                           while ($search_specification_row=mysqli_fetch_array($search_specification_run)) 
                           {
                           
                           ?>
                        <tr>
                          <form  action="action.php" method="post">
                           <input type="hidden" name="code" value="23">
                            <input type="hidden" name="id" value="<?=$search_specification_row[0];?>">
                           <td><input type="text" name="col1" class="form-control" value="<?=$search_specification_row[1];?>"></td>
                           <td><input type="text" name="col2" class="form-control"  value="<?=$search_specification_row[2];?>"></td>
                           <td><input type="text" name="col3"class="form-control"  value="<?=$search_specification_row[3];?>"></td>
                           <td><input type="text" name="col4" class="form-control" value="<?=$search_specification_row[4];?>"></td>
                           <td><input type="text" name="col5" class="form-control" value="<?=$search_specification_row[5];?>"></td>
                            <td><input type="text" name="col6" class="form-control" value="<?=$search_specification_row[6];?>"></td>
                            <td><input type="Submit" class="btn btn-warning" value="Update"></td>
                           </form>
                        </tr>
                           <?php 
                              }
     }
     else
     {
        $search_specification="  SELECT * FROM specification Order by ID ASC";
                           $search_specification_run=mysqli_query($conn,$search_specification);
                           while ($search_specification_row=mysqli_fetch_array($search_specification_run)) 
                           {
                           
                           ?>
                        <tr>
                          <form  action="action.php" method="post">
                           <input type="hidden" name="code" value="23">
                            <input type="hidden" name="id" value="<?=$search_specification_row[0];?>">
                           <td><input type="text" name="col1" class="form-control" value="<?=$search_specification_row[1];?>"></td>
                           <td><input type="text" name="col2" class="form-control"  value="<?=$search_specification_row[2];?>"></td>
                           <td><input type="text" name="col3"class="form-control"  value="<?=$search_specification_row[3];?>"></td>
                           <td><input type="text" name="col4" class="form-control" value="<?=$search_specification_row[4];?>"></td>
                           <td><input type="text" name="col5" class="form-control" value="<?=$search_specification_row[5];?>"></td>
                            <td><input type="text" name="col6" class="form-control" value="<?=$search_specification_row[6];?>"></td>
                            <td><input type="Submit" class="btn btn-warning" value="Update"></td>
                           </form>
                        </tr>
                           <?php 
                              }
     }
                            
                              
   }
           elseif ($code==19)
       {

     $id=$_GET['id'];
     if ($id!='')
      {
           $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.IDNo like '%$id%' || c.CategoryName like '%$id%' || a.Articlename like '%$id%' || s.CPU like '%$id%'";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
                           $building_num=$building_num+1;
                           ?>
                        <tr>
                           <td><?=$building_row['IDNo'];?></td>
                           <td><?=$building_row['CategoryName'];?></td>
                           <td><?=$building_row['ArticleName'];?></td>
                           <td><?=$building_row['CPU'];?></td>
                         <!--   <td><?=$building_row['OS'];?></td>
                           <td><?=$building_row['Memory'];?></td> -->
                           <td>
                              <?php
                                 if($building_row['Status']==0)
                                  {?>
                              <i class="fa fa-edit fa-lg" onclick="stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal" style="color:red;"></i>
                              <?php
                                 }
                                  else if($building_row['Status']==1)
                                 {
                                  ?>
                                   <i class="fa fa-edit fa-lg" onclick="stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal" style="color:red;"></i>

                              <!-- <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i> -->
                              <?php
                                 }
                                 else
                                 {
                                    ?>  <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i><?php
                                 }
                                 ?>
                           </td>
                           <td>
                              <?php 
                                 if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                                  {
                                     if($building_row['Status']==1)
                                    {?>
                              <a class="btn btn-warning btn-xs"  onclick="stock_assign(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_assign" style="color: white;">Available</a>
                              <?php
                                 }
                                 else if($building_row['Status']==2)
                                 {
                                 ?>
                             <a class="btn btn-danger btn-xs" data-dismiss="modal" onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:white;">Return</a>
                              <?php  # code...
                                 }
                                 else
                                 {
                                  
                                 }
                                 }
                                 else{

                                 
                                 }  ?>
                           </td>
                        </tr>
                        <?php 
                           }
      }
      else
      {
     $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.IDNo like '%$id%' || c.CategoryName like '%$id%' || a.Articlename like '%$id%' || s.CPU like '%$id%'";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
                           $building_num=$building_num+1;
                           ?>
                        <tr>
                           <td><?=$building_row['IDNo'];?></td>
                           <td><?=$building_row['CategoryName'];?></td>
                           <td><?=$building_row['ArticleName'];?></td>
                           <td><?=$building_row['CPU'];?></td>
                         <!--   <td><?=$building_row['OS'];?></td>
                           <td><?=$building_row['Memory'];?></td> -->
                           <td>
                              <?php
                                 if($building_row['Status']=="0")
                                  {?>
                              <i class="fa fa-edit fa-lg" onclick="stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal" style="color:red;"></i>
                              <?php
                                 }
                                  else if($building_row['Status']==1)
                                 {
                                  ?>
                                   <i class="fa fa-edit fa-lg" onclick="stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal" style="color:red;"></i>

                              <!-- <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i> -->
                              <?php
                                 }
                                 else
                                 {
                                    ?>  <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i><?php
                                 }
                                 ?>
                           </td>
                           <td>
                              <?php 
                                 if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                                  {
                                     if($building_row['Status']=="1")
                                    {?>
                              <a class="btn btn-warning btn-xs"  onclick="stock_assign(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_assign" style="color: white;">Available</a>
                              <?php
                                 }
                                 else if($building_row['Status']=="2")
                                 {
                                 ?>
                              <a class="btn btn-success btn-xs" style="color:white;">Assigned</a>
                              <?php  # code...
                                 }
                                 else
                                 {
                                  
                                 }
                                 }
                                 else{

                                 
                                 }  ?>
                           </td>
                        </tr>
                        <?php 
                           }
      }

    }

               elseif ($code=='20')
    {
     $id=$_GET['id'];
     if ($id!='')
      {
          $scan_stock_num=0;
                           $scan_stock="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.IDNo like '%$id%' || c.CategoryName like '%$id%' || a.Articlename like '%$id%' || s.CPU like '%$id%'  ";
                           $scan_stock_run=mysqli_query($conn,$scan_stock);
                           while ($scan_stock_row=mysqli_fetch_array($scan_stock_run)) 
                           {
                           $scan_stock_num=$scan_stock_num+1;
                           ?>

                        <tr>
                         
                           <td><?=$scan_stock_row['IDNo'];?></td>
                           <td><?=$scan_stock_row['CategoryName'];?></td>
                           <td><?=$scan_stock_row['ArticleName'];?></td>
                           <td><?=$scan_stock_row['CPU'];?></td>
                           <td><?=$scan_stock_row['OS'];?></td>
                           <td><?=$scan_stock_row['Memory'];?></td>
                          
                           <td>
                            <?php 
                           if ($scan_stock_row['CPU']!='' and $scan_stock_row['OS']!='' and $scan_stock_row['Memory']!='' and $scan_stock_row['Brand']!='' and $scan_stock_row['Storage']!='' and $scan_stock_row['Model']!='')
                            {
                              ?>
                                <a   onclick="view_record_qr(<?=$scan_stock_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-eye fa-lg"> </i></a>
                             <?php
                           }
                           else{

                           }  ?>
                           </td>
                        </tr>
                        <?php 
                           }
      }
      else
      {
   $scan_stock_num=0;
                           $scan_stock="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode ";
                           $scan_stock_run=mysqli_query($conn,$scan_stock);
                           while ($scan_stock_row=mysqli_fetch_array($scan_stock_run)) 
                           {
                           $scan_stock_num=$scan_stock_num+1;
                           ?>

                        <tr>
                         
                           <td><?=$scan_stock_row['IDNo'];?></td>
                           <td><?=$scan_stock_row['CategoryName'];?></td>
                           <td><?=$scan_stock_row['ArticleName'];?></td>
                           <td><?=$scan_stock_row['CPU'];?></td>
                           <td><?=$scan_stock_row['OS'];?></td>
                           <td><?=$scan_stock_row['Memory'];?></td>
                          
                           <td>
                            <?php 
                           if ($scan_stock_row['CPU']!='' and $scan_stock_row['OS']!='' and $scan_stock_row['Memory']!='' and $scan_stock_row['Brand']!='' and $scan_stock_row['Storage']!='' and $scan_stock_row['Model']!='')
                            {
                              ?>
                                <a   onclick="view_record_qr(<?=$scan_stock_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-eye fa-lg"> </i></a>
                             <?php
                           }
                           else{

                           }  ?>
                           </td>
                        </tr>
                        <?php 
                           }
      }

    }
    else if ($code==21)
     {
     $user_id = $_GET['user_id'];
     $userQry="SELECT * FROM user WHERE emp_id = '$user_id'";
     $userRes=mysqli_query($conn,$userQry);
     if (mysqli_num_rows($userRes)<1) 
     {      
      $staff="SELECT * FROM Staff Where IDNo='$user_id' ";
      $stmt = sqlsrv_query($conntest,$staff);  
      while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
      {
         $IDNo=$row_staff['IDNo'];
         $Name=$row_staff['Name'];
         $Clg=$row_staff['CollegeName'];
         $dept=$row_staff['Department'];
         $Desi=$row_staff['Designation'];
         $contact=$row_staff['ContactNo'];
         $email=$row_staff['EmailID'];
         mysqli_query($conn,"INSERT INTO user (emp_id, name, college, department, designation, mobile, email) VALUES ('$IDNo', '$Name', ' $Clg','$dept', '$Desi', '$contact', '$email')");
         ;
      }

      } 
        $presult = mysqli_query($conn,"SELECT emp_id, name, u_permissions from user WHERE emp_id = '$user_id'");
        $permissions = "";
        $permissions_array = "";
        $name = $emp_id = "";
        while($row=mysqli_fetch_array($presult))
        {
            $permissions = $row['u_permissions'];
            $emp_id = $row['emp_id'];
            $name = $row['name'];
        }
        $permissions_array = explode(",",$permissions);
       echo "<h4>".$name."(".$emp_id.")</h4>";

$count=0;
        $result1 = mysqli_query($conn,"SELECT DISTINCT mainmenu from permissions  order by mainmenu ASC");

        echo "<form  action = 'action.php' method = 'POST'>";
        echo "<input type='hidden' name='code' value='25'>";
        echo "<input type='hidden' name='user_id' value = '".$user_id."'>";

        while($row1=mysqli_fetch_array($result1))
        {
    $main[]= $row1['mainmenu'];
   $count++;
        }
for($i=0;$i<$count;$i++)
{
echo"<b style='color:#a62532;'>" .$main[$i]."</b>";
$result1 = mysqli_query($conn,"SELECT * from permissions where mainmenu='$main[$i]'");

while($row=mysqli_fetch_array($result1))
        {
          echo "<div class='checkbox'>";
          $checked = 0;
          foreach($permissions_array as $item)
          {
            if($item == $row['id'])
            {
              $checked = 1;
            }
          }
          if($checked)
          {

  
            echo "<label><input type='checkbox' name = 'per[]' value=".$row['id']." checked>"."&nbsp;".$row['submenu']."</label>";
              // echo "<span class='text-right' style='float:right;'><input type='checkbox' name = 'per1[][]' value='R'>&nbsp;<input type='checkbox' name = 'per1[][]' value='W'>&nbsp;<input type='checkbox' name = 'per1[][]' value='D'><input type='checkbox' name = 'per_id[][]' value=".$row['id']."></span>";

         
          }
          else
          {
            echo "<label><input type='checkbox' name = 'per[]' value=".$row['id'].">"."&nbsp;".$row['submenu']."</label> ";
           
            // echo "<span class='text-right' style='float:right;'><input type='checkbox' name = 'per1[][]' value='R'>&nbsp;<input type='checkbox' name = 'per1[][]' value='W'>&nbsp;<input type='checkbox' name = 'per1[][]' value='D'><input type='checkbox' name = 'per_id[][]' value=".$row['id']."></span>";

            

          }
          echo "</div>";
}
}
        
        echo "<input type = 'submit' class = 'btn btn-primary btn-xs' name = ''>";
        echo "</form";
    }
       else if ($code==22) 

       {
    echo  $user_id = $_GET['user_id'];
      echo   $role = $_GET['role'];
        echo "<form  action = 'action.php' method = 'POST'>";
        echo "<input type='hidden' name='code' value='26'>";
        echo "<input type='hidden' name='user_id' value = '".$user_id."'>";

      

        echo "<input type = 'submit' class = 'btn btn-primary btn-xs' name = ''>";
        echo "</form";
    }
        else if ($code==23)
       {
          $id=$_GET['id'];
   $room_name="SELECT * FROM room_type_master where ID='$id'";
                              $room_name_run=mysqli_query($conn,$room_name);
                              while ($room_name_row=mysqli_fetch_array($room_name_run)) 
                              {?>
<input type="hidden" name="id" value="<?=$id;?>">
<input type="text" class="form-control" name="RoomType" value="<?=$room_name_row['RoomType'];?>">
<?php
   }
   
   }
else if($code==24)
{
     $LocationID = $_GET['locationID'];
      $location=" SELECT * from location_master  Where ID='$LocationID' ";
                        $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {?>
     <input type="hidden" name="User_ID" value="<?=$location_row['location_owner'];?>">
 <?php }
?>


                    <input type="hidden" name="locationID" value="<?=$LocationID;?>">
                      
              <input type="hidden" name="code" value="27">
                 <table class="table " id="search_all_item">
                     <thead>
                        <tr>
                            <th><input type="checkbox" id="select_all" ></th>
                           <th>ID</th>
                           <th>Category Name</th>
                           <th>Article Name</th>
                        
                          <!--  <th>Oprating System</th>
                           <th>Memory</th> -->
                           <th>Action</th>
                         
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode WHERE s.Status='1' order by IDNo DESC ";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
                           $building_num=$building_num+1;
                           ?>

                        <tr>
                            <td><input type="checkbox" name="check[]" id="check" value="<?=$building_row['IDNo'];?>" class="checkbox" ></td>
                           <td><?=$building_row['IDNo'];?></td>
                           <td><?=$building_row['CategoryName'];?></td>
                           <td><?=$building_row['ArticleName'];?></td>
                         <!--   <td><?=$building_row['CPU'];?></td> -->
                         <!--   <td><?=$building_row['OS'];?></td>
                           <td><?=$building_row['Memory'];?></td> -->
                        
                           <td>
                              <?php 
                                 if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                                  {
                                     if($building_row['Status']=="1")
                                    {?>
                              <a class="btn btn-warning btn-xs"  onclick="stock_assign(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_assign" style="color: white;">Available</a>
                              <?php                      
                                 }
                                 elseif($building_row['Status']=="0")
                                 {

                                 }
                                 else 
                                 {
                                 ?>
                              <a class="btn btn-success btn-xs" style="color:white;">Assigned</a>

                              <?php 

                                 }
                                 }
                                 else
                                 {
                                 
                                 }  ?>
                                 
                           </td>
                           
                        </tr>
                    
                        <?php 
                           }
                                      ?>
                     </tbody>
                 </table>
                 
            
<?php }

else if($code==25)
{
$ArticleCode=$_GET['articlebind'];
    $LocationID = $_GET['locationID'];
      $location=" SELECT * from location_master  Where ID='$LocationID' ";
                        $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {

     $User_ID = $location_row['location_owner'];
 }
   ?>
                    <input type="hidden" name="locationID" value="<?=$LocationID;?>">
                      <input type="hidden" name="User_ID" value="<?=$User_ID;?>">
              <input type="hidden" name="code" value="27">
                 <table class="table table-striped table-bordered" id='search_item'>
                     <thead>
                        <tr>
                            <th><input type="checkbox" id="select_all" ></th>
                           <th>ID</th>
                           <th>Category Name</th>
                           <th>Article Name</th>
                           
                           <th>Action</th>
                         
                        </tr>
                     </thead>
                     <tbody id="">
                        <?php 
                           $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode WHERE s.Status='1' and s.ArticleCode='$ArticleCode' order by IDNo DESC ";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
                           $building_num=$building_num+1;
                           ?>

                        <tr>
                            <td><input type="checkbox" name="check[]" id="check" value="<?=$building_row['IDNo'];?>" class="checkbox" ></td>
                           <td><?=$building_row['IDNo'];?></td>
                           <td><?=$building_row['CategoryName'];?></td>
                           <td><?=$building_row['ArticleName'];?></td>
                         <!--   <td><?=$building_row['CPU'];?></td> -->
                         <!--   <td><?=$building_row['OS'];?></td>
                           <td><?=$building_row['Memory'];?></td> -->
                          
                           <td>
                              <?php 
                                 if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                                  {
                                     if($building_row['Status']=="1")
                                    {?>
                              <a class="btn btn-warning btn-xs"  onclick="stock_assign(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_assign" style="color: white;">Available</a>
                              <?php                      
                                 }
                                 elseif($building_row['Status']=="0")
                                 {

                                 }
                                 else 
                                 {
                                 ?>
                              <a class="btn btn-success btn-xs" style="color:white;">Assigned</a>

                              <?php 

                                 }
                                 }
                                 else
                                 {
                                 
                                 }  ?>
                                 
                           </td>
                           
                        </tr>
                        <!-- <input type="hidden" name="check[]" value="<?=$building_row['IDNo'];?>"> -->
                        <?php 
                           }
                                      ?>
                     </tbody>
                 </table>
                
           
<?php }
elseif($code==26)
{
      $id=$_GET['id'];
   ?>
<form action="action.php" method="post">
<input type="hidden" name="code" value="20">
<div class="card-body table-responsive p-0 " style="height: 300px;">
<table class="table  text-nowrap">
<thead>
<tr>
<th>IDNo</th>
<th>Specifications</th>
<th>Operating System</th>
<th>Memory</th>
</tr>
</thead>
<tbody>
<?php 
   $building_num=0;
   $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode  WHERE s.IDNo='$id'";
   $building_run=mysqli_query($conn,$building);
   while ($building_row=mysqli_fetch_array($building_run)) 
   {
   $building_num=$building_num+1;?>
 <tr><h3 class="text-center"><b><?=$building_row['ArticleName'];?></b></h3>
            <td>
               <input class="form-control"  type="text" name="IDNo" value="<?=$building_row['IDNo'];?>" disabled> 
            </td>
            <td>
              
                <select class="form-control" name="Processor" disabled>
                <?php if ($building_row['CPU']!='') 
                {
                 
                  echo '<option value="'.$building_row['CPU'].'">'.$building_row['CPU'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $cpu="SELECT Distinct Processor FROM specification where Processor!=''";
                     $reslut_cpu=mysqli_query($conn,$cpu);
                     while ($row_cpu=mysqli_fetch_array($reslut_cpu))
                     {
                     ?>
                  <option value="<?php echo $row_cpu['Processor'];?>">
                     <?php echo $row_cpu['Processor'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
              
                <select class="form-control" name="Operating" disabled>
                <?php if ($building_row['OS']!='') 
                {
                 
                  echo '<option value="'.$building_row['OS'].' ">'.$building_row['OS'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $os="SELECT Distinct OS FROM specification where OS!=''";
                     $reslut_os=mysqli_query($conn,$os);
                     while ($row_os=mysqli_fetch_array($reslut_os))
                     {
                     ?>
                  <option value="<?php echo $row_os['OS'];?>">
                     <?php echo $row_os['OS'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
             </td>
            <td>
               <select class="form-control" name="Memory" disabled>
                <?php if ($building_row['Memory']!='') 
                {
                 
                  echo '<option value="'.$building_row['Memory'].' ">'.$building_row['Memory'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $Ram="SELECT Distinct RAM FROM specification where RAM!=''";
                     $reslut_ram=mysqli_query($conn,$Ram);
                     while ($row_ram=mysqli_fetch_array($reslut_ram))
                     {
                     ?>
                  <option value="<?php echo $row_ram['RAM'];?>">
                     <?php echo $row_ram['RAM'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
         </tr>
         <tr>
            <th>Storage</th>
            <th>Brand</th>
            <th>Model</th>
         <th>Serial No</th>
         </tr>
         <tr>
            <td>
               
               <select class="form-control" name="Storage" disabled>

                 

                  
                  <?php
                  if ($building_row['Storage']!='') 
                {
                 
                  echo '<option value="'.$building_row['Storage'].' ">'.$building_row['Storage'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 


                     $storage="SELECT Distinct Storage FROM specification where Storage!=''" ;
                     $reslut_storage=mysqli_query($conn,$storage);
                     while ($row_storage=mysqli_fetch_array($reslut_storage))
                     {
                     ?>
                  <option value="<?php echo $row_storage['Storage'];?>">
                     <?php echo $row_storage['Storage'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
               <select class="form-control" name="Brand" disabled>
                 
                  <?php
                  if ($building_row['Brand']!='') 
                {
                 
                  echo '<option value="'.$building_row['Brand'].' ">'.$building_row['Brand'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $brand="SELECT Distinct Brand FROM specification where Brand!=''";
                     $reslut_brand=mysqli_query($conn,$brand);
                     while ($row_brand=mysqli_fetch_array($reslut_brand))
                     {
                     ?>
                  <option value="<?php echo $row_brand['Brand'];?>">
                     <?php echo $row_brand['Brand'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
               </select>
            </td>
            <td>
               <select class="form-control" name="Model" disabled>
                 

                  <?php
                   if ($building_row['Model']!='') 
                {
                 
                  echo '<option value="'.$building_row['Model'].' ">'.$building_row['Model'].'</option>'; 
                } else{
                 echo '<option value="NA">Select</option>';
                } 
                     $model="SELECT Distinct Model FROM specification Where Model!=''";
                     $reslut_model=mysqli_query($conn,$model);
                     while ($row_model=mysqli_fetch_array($reslut_model))
                     {
                     ?>
                  <option value="<?php echo $row_model['Model'];?>">
                     <?php echo $row_model['Model'];?>
                  </option>
                  <?php
                     }  
                     
                     ?>
                   <option value="NA">NA</option>
            </td>
            <td><input type="text" name="SerialNo" value="<?=$building_row['SerialNo'];?>" class="form-control" disabled></td>
         </tr>
          <tr>
            <th>Local Serial No</th>
            <th>Bill No</th>
            <th>Bill Date</th>
         </tr>
         <tr>
         <td><input type="text" name="DeviceSerailNo" value="<?=$building_row['DeviceSerialNo'];?>" class="form-control" disabled></td>
         <td><input type="text" name="BillNo" value="<?=$building_row['BillNo'];?>" class="form-control" disabled></td>
         <td><input type="date" name="BillDate" value="<?=$building_row['BillDate'];?>" class="form-control" disabled></td>
      </tr>
         <?php 
            }
                       ?>
</tbody>
</table>
</div>
</form>
</div><?php
}
else if ($code==27) {
   $empID=$_GET['id'];
     $staff="SELECT Name,Designation,Department FROM Staff Where IDNo='$empID'";
 $stmt = sqlsrv_query($conntest,$staff);  
while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
     {?>

<b><?=$row_staff['Name'];?></b>&nbsp;(<?=$row_staff['Designation'];?>)<br><b>Deprtment&nbsp;:&nbsp;</b><?=$row_staff['Department'];?>

    <?php  }
}

else if($code==28)
{
    $id = $_GET['id'];
    $emp_id = $_GET['owner'];
    $sql="SELECT * FROM stock_summary  where IDNo='$id'";
    $result = mysqli_query($conn,$sql);
    $date=date('Y-m-d');
    while($data=mysqli_fetch_array($result))
    {
       $currentOwner=$data['Corrent_owner'];
       $currentLocation=$data['LocationID'];
       $deviceSerialNo=$data['DeviceSerialNo'];
       $workingStatus=$data['WorkingStatus'];
       $referenceNo=$data['reference_no'];
       $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', 'Returned', '$currentLocation', '$emp_id', 'Owner Remove', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
       $res=mysqli_query($conn,$qry);
       if ($res) 
       {
               $delte="DELETE FROM `multiple_owners` WHERE UserId='$emp_id' and ArticleCode='$id'";
   $delt_run=mysqli_query($conn,$delte);
   if ($delt_run==true) {
   $chek="SELECT * FROM multiple_owners where ArticleCode='$id' ";
   $chek_run=mysqli_query($conn,$chek);
    $co=mysqli_num_rows($chek_run);
while($rr=mysqli_fetch_array($chek_run))
{
if ($co>0) 
{
$updateQry="UPDATE stock_summary SET  Corrent_owner='".$rr['UserId']."' WHERE  IDNo='$id'";
               mysqli_query($conn,$updateQry);
}
}
if ($co<1) {
   // code...
   $updateQry="UPDATE stock_summary SET  Corrent_owner='' ,multiowner='0' WHERE IDNo='$id'";
               mysqli_query($conn,$updateQry);
     
}
       }


    }
                       
             
}
}


 elseif ($code==29)
       {

     $CategoryID=$_GET['CategoryID'];
     $ArticleID=$_GET['ArticleID'];
     $Status=$_GET['Status'];
     if ($Status==1)
      {
         $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.Status>'0' and   s.CategoryID='$CategoryID' and s.ArticleCode='$ArticleID'";
     }
     elseif ($Status==2)
 {
 $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.Status='2' and s.CategoryID='$CategoryID' and s.ArticleCode='$ArticleID'";
 }
 elseif($Status==3)
 {
    $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.Status='1' and s.CategoryID='$CategoryID' and s.ArticleCode='$ArticleID' ";
 }
 elseif($Status==4)
 {
    $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.WorkingStatus='1' and s.Status!='3'  and s.CategoryID='$CategoryID' and s.ArticleCode='$ArticleID'";
 }

elseif($Status==5)
 {
    $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.WorkingStatus='1' AND s.Status='3'  and s.CategoryID='$CategoryID' and s.ArticleCode='$ArticleID'";
 }
 elseif($Status==6)
 {
    $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where  s.Status='0'  and s.CategoryID='$CategoryID' and s.ArticleCode='$ArticleID'";
 }






 else
 { $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode Where s.CategoryID='$CategoryID' and s.ArticleCode='$ArticleID'";

 }
          
          ?>
          <table class="table table-head-fixed text-nowrap table-bordered " id="example">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Category Name</th>
                           <th>Article Name</th>
                           <th>Specifications</th>
                           <!-- <th>Oprating System</th> -->
                           <th>Track</th>
                           <th>Action</th>
                         <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
          <?php
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
                           $building_num=$building_num+1;
                           ?>
                       <tr>
                           <td><?=$building_row['IDNo'];?></td>
                           <td><?=$building_row['CategoryName'];?></td>
                           <td><?=$building_row['ArticleName'];?></td>
                       <td><?=$building_row['CPU'];?></td>
                         <!--   <td><?=$building_row['OS'];?></td>
                           <td><?=$building_row['Memory'];?></td> -->

                           <td>  <i class="fa fa-eye fa-lg" onclick="track(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_track" style="color:red;"></i></td>
                            <td>
                                  <?php
                                 if($building_row['Status']=="0")
                                  {?>
                              <i class="fa fa-edit fa-lg" onclick="stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal" style="color:red;"></i>
                              <?php
                                 }
                                 else if($building_row['Status']==1)
                                 {
                                  ?>
                                   <i class="fa fa-edit fa-lg" onclick="stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal" style="color:red;"></i>

                              <!-- <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i> -->
                              <?php
                                 }
                                 else
                                 {
                                    ?>  <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i><?php
                                 }
                                 ?>

                           </td> 
                           <td>
                             <?php 
                                 if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                                  {
                                     if($building_row['Status']=="1" &&  $building_row['WorkingStatus']=='0')
                                    {?>
                              <a class="btn btn-warning btn-xs"  onclick="stock_assign(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_assign" style="color: white;">Available</a>
                              <?php
                                 }
                                  else if ($building_row['Status']=="1" &&  $building_row['WorkingStatus']=='1')
                                    {?>
                              <a class="btn btn-primary btn-xs"  onclick="stock_discard1(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_discard" style="color: white;">Faulty (Return)</a>
                              <?php
                                 }


                                 else if ($building_row['Status']=="2" &&  $building_row['WorkingStatus']=='1')
                                 {
                                 ?>
                                    <a class="btn btn-warning btn-xs"  onclick="stock_discard1(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_discard" style="color: white;">Faulty</a>
                              <?php  # code...
                                 }
                                 else if ($building_row['Status']=="2")
                                 {
                                 ?>
                                    <a class="btn btn-danger btn-xs" data-dismiss="modal" onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:white;">Return</a>
                              <?php  # code...
                                 }
                                 else
                                 {
                                   echo "------"; 
                                 }
                                 }
                                 else{?>
                                 <a class="btn btn-secondary btn-xs"  dstyle="color:white;">Not Updated</a>

                                <?php  }  ?>
                                 
                           </td>
                           
                        </tr>
                        <?php 
                           }
                           ?>
                        </tbody>
                     </table>
                     <?php

    }

   elseif ($code==30) 
    {
      $id=$_GET['id'];
      $article_name='';
      $s=" SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode inner join category_permissions on category_permissions.CategoryCode=c.ID where category_permissions.employee_id='$EmployeeID' and s.Status='1' and s.WorkingStatus='0' and s.IDNo='$id' ";
      //$s="SELECT * FROM stock_summary Where IDNo='$id' and Status=1";
         $ss=mysqli_query($conn,$s);
while($article_data=mysqli_fetch_array($ss))
{
   $article_name=$article_data['ArticleName']; 
?>
   <div class="row">
      <div class="col-sm-2"></div>
   <input type="hidden" name="id" value="<?=$id;?>">
      <div class="col-sm-8" style="padding: 50px;">
         <h3 class="text-center"><b  data-toggle="modal" onclick="updateModalFunction(<?=$id?>)" data-target="#update_modal" type="button"><?=$article_name;?>(<?= $articlecode=$article_data['ArticleCode'];?>)</b></h3>
<label>Article Number </label> 
<input type="text"  class="form-control" value="<?=$id;?>" disabled>
<input type="hidden" name="" id="id" class="form-control" value="<?=$id;?>" required>
<label>Building</label>
<select  class="form-control" onchange="floorSelect(this.value);" name="" id="spotBuilding" required="">
   <optgroup label="Building">
      <option value="">Select</option>
   <?php 
   if ($EmployeeID=='131053' ||  $EmployeeID=='171250' || $EmployeeID=='101480' || $EmployeeID=='121031' || $EmployeeID=='171307' || $EmployeeID=='101346' || $EmployeeID=='170123') 
   {
      $locationBuildingSql="Select * from building_master ";
   }
   else
   {
      $locationBuildingSql="Select * from building_master  where Incharge='$EmployeeID' or infra_incharge='$EmployeeID' or electrical_incharge='$EmployeeID'  ";
   }
   $locationBuildingRes=mysqli_query($conn,$locationBuildingSql);
   while($locationBuildingData=mysqli_fetch_array($locationBuildingRes))
   {
      ?>
      <option value="<?=$locationBuildingData['ID']?>"><?=$locationBuildingData['Name']?></option>
      <?php 
   }
   ?>
</optgroup>
</select>
<label>Floor</label>
<select id='floor' class="form-control" onchange="roomSelect(this.value)">

</select>
<label>Room No.</label>
<select id='roomSelectList' class="form-control" onchange="locationOwner(this.value)">

</select>






<input type="hidden" id="lcm_id" value="">
<label>Current Owner </label>
         <input type="number" name="Employee_ID" id="Employee_ID" class="form-control" onkeyup="emp_detail_verify(this.value);">
         <p id="emp_detail_status_"></p>

         <tr>
    <?php 
    $j=1;  $billSql="SELECT * FROM article_images inner join stock_summary on stock_summary.articleimage=article_images.id where  IDNo='$id'  ";
            $billRes=mysqli_query($conn,$billSql);
            while($billData=mysqli_fetch_array($billRes))
            {
               
               ?>
              <td>

              <div class="icheck-primary d-inline">
                     
                    <img src="http://gurukashiuniversity.co.in/data-server/articleimages/<?=$billData['image'];?>" style="width:100px;height:100px">
                   
                  </div>


              </td>
              
               <?php
               $j++;
            }
            ?> 
            </select>
         



</tr>

<div class="col-lg-8" style="padding: 50px;">
   <?php 
   // echo $id;
}
   
if (mysqli_num_rows($ss)>0)
 {
 ?>
<button type="button" name="" onclick="assigned_one();" class="btn btn-success">Assign</button>
<?php
 }
 else
 {   ?>
<div class="alert alert-warning" role="alert">
   You can't assign this article. <br> check whether already assigned or not.<br>Update details of this article.

</div> 
<div class="alert alert-danger" role="alert">
  Please Refresh page <br> <button class="btn btn-primary btn-xs" onClick="window.location.reload();">Refresh Page</button>
</div> 
   <?php 
   } ?>
</div>
   </div>
</div>
</div>
<?php 


    }
    /*-------------Code 31-39 reserved for permission system--------------------*/

else if ($code==31) //69
    {
   
     $Role_id = $_GET['role_id'];
   $per=array();  
   $main=array(1);
   $count=0;
       $result1 = mysqli_query($conn,"SELECT DISTINCT mainmenu from permissions  order by mainmenu ASC");
   
       echo "<form  action = 'action.php' method = 'POST' target='_blank'>";
       echo "<input type='hidden' name='code' value='110'>";
       echo "<input type='hidden' name='role_id' value='".$Role_id."'";
   
       while($row1=mysqli_fetch_array($result1))
       {
        
   $main[]= $row1['mainmenu'];
   $count++;
       }
       // print_r($main);
   // for($i=0;$i<$count;$i++)
   // {
       foreach ($main as $key => $value) {
          // code... 
          if ($value==1) {
   echo $value;
   }else
   { 
   echo"<b style='color:#a62532;'>".$value."</b>"; 
   ?>
<table class="table">
<tr>
   <th>Main Menu</th>
   <th>View</th>
   <th>Insert</th>
   <th>Update</th>
   <th>Delete</th>
</tr>
<?php 
   $sel_result="SELECT * from permissions where mainmenu='$value'";
   $result1 = mysqli_query($conn,$sel_result);
   while($row=mysqli_fetch_array($result1))
          { $idn=$row['id'];
       $checked_m="";
       $checked_I="";
       $checked_U="";
       $checked_D="";
          
   $sel_per="SELECT * FROM role WHERE role_id='$Role_id' and page_id='$idn'";
   $sel_run=mysqli_query($conn,$sel_per);
   while ($r=mysqli_fetch_array($sel_run))
    {
     if ($r['page_id']!='') 
     {
         $checked_m="checked";
     }
     else
     {
   
     }
     
   if ($r['I']=='1') 
   {
     $checked_I='checked';
   }
   else
   {
   
   }
   if ($r['U']=='1') 
   {
      $checked_U='checked';
   }
   else
   {
   
   }
   if($r['D']=='1') 
   {
      $checked_D='checked';
   }
   else
   {
   
   }
   
   
    } 
    ?>
<?php 
   echo "<div class='checkbox'>";
            ?>
<tr>
   <td>
      <div class="pretty p-default">
         <label><b><?=$row['submenu'];?><b></label>
      </div>
   </td>
   <td>
      <div class="pretty p-default">
         <input type='checkbox' class="checkhour<?=$row['id'];?>" name = 'per[]' id='per[]' onclick='un_check(<?=$row["id"];?>);' value="<?=$row['id']?>" <?=$checked_m?>>
         <div class="state p-success-o">
            <label>&nbsp;</label>
         </div>
      </div>
   </td>
   <td>
      <div class="pretty p-default">
         <input type='checkbox' onClick='check(<?=$row["id"];?>)' name = '<?=$idn?>[]' class='un_check<?=$row['id'];?>' value='I' <?=$checked_I;?> >
         <div class="state p-success-o">
            <label>&nbsp;</label>
         </div>
      </div>
   </td>
   <td>
      <div class="pretty p-default">
         <input type='checkbox' onClick='check(<?=$row["id"];?>)' name = '<?=$idn?>[]' class='un_check<?=$row['id'];?>' value='U' <?=$checked_U;?> >
         <div class="state p-success-o">
            <label>&nbsp;</label>
         </div>
      </div>
   </td>
   <td>
      <div class="pretty p-default">
         <input type='checkbox' onClick='check(<?=$row["id"];?>)' name = '<?=$idn?>[]' class='un_check<?=$row['id'];?>' value='D' <?=$checked_D;?> >
         <div class="state p-success-o">
            <label>&nbsp;</label>
         </div>
      </div>
   </td>
</tr>
<?php 
   echo "</div>";
   
   }
   }
   
   echo "</table>";
   }
   echo "<input type = 'submit' class = 'btn btn-primary btn-xs' name = ''>";
   echo "</form";
   }
   elseif($code==32)  //70
   {
   $user_id = $_GET['user_id'];
   if ($user_id!='')
    {
   $userQry="SELECT * FROM user WHERE emp_id = '$user_id'";
   $userRes=mysqli_query($conn,$userQry);
   if (mysqli_num_rows($userRes)<1) 
   {      
   $staff="SELECT * FROM Staff Where IDNo='$user_id' ";
   $stmt = sqlsrv_query($conntest,$staff);  
   while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
   {
   $IDNo=$row_staff['IDNo'];
   $Name=$row_staff['Name'];
   $Clg=$row_staff['CollegeName'];
   $dept=$row_staff['Department'];
   $Desi=$row_staff['Designation'];
   $contact=$row_staff['ContactNo'];
   $email=$row_staff['EmailID'];
   mysqli_query($conn,"INSERT INTO user (emp_id, name, college, department, designation, mobile, email) VALUES ('$IDNo', '$Name', ' $Clg','$dept', '$Desi', '$contact', '$email')");
   }
   } 
   $presult = mysqli_query($conn,"SELECT emp_id, name from user WHERE emp_id = '$user_id'");
   $name = $emp_id = "";
   while($row=mysqli_fetch_array($presult))
   {
     
     $emp_id = $row['emp_id'];
     $name = $row['name'];
   }
echo "<h4>".$name."(".$emp_id.")</h4>";
   $count=0;
   $result1 = mysqli_query($conn,"SELECT DISTINCT mainmenu from permissions  order by mainmenu ASC");
        echo "<form  action = 'action.php' method = 'POST' target='_blank'>";
   echo "<input type='hidden' name='code' value='25'>";
   echo "<input type='hidden' name='user_id' value = '".$user_id."'>";
   
   
   while($row1=mysqli_fetch_array($result1))
   {
   $main[]= $row1['mainmenu'];
   $count++;
   }
   for($i=0;$i<$count;$i++)
   {
   echo"<b style='color:#a62532;'>" .$main[$i]."</b>";?>
<table class="table">
<tr>
   <th>Main Menu</th>
   <th>View</th>
   <th>Insert</th>
   <th>Update</th>
   <th>Delete</th>
   <!-- <th>Start</th>
   <th>End</th> -->
</tr>
<?php
//  $rr="SELECT *
// FROM special_permission 
// RIGHT JOIN permissions
// ON permissions.id = special_permission.page_id where  mainmenu='$main[$i]' ";
   $result1 = mysqli_query($conn,"SELECT *FROM permissions where mainmenu='$main[$i]'");
   while($row=mysqli_fetch_array($result1))
           { 
            $idn=$row['id'];
        $checked_m="";
        $checked_I="";
        $checked_U="";
        $checked_D="";       
    $sel_per="SELECT * FROM special_permission WHERE emp_id='$emp_id' and page_id='$idn'";
    $sel_run=mysqli_query($conn,$sel_per);
    while ($r=mysqli_fetch_array($sel_run))
     {
      if ($r['page_id']!='') 
      {
          $checked_m="checked";
      }
      else
      {
   
      }
   if ($r['I']=='1') 
   {
      $checked_I='checked';
   }
   else
   {
   
   }
   if ($r['U']=='1') 
   {
       $checked_U='checked';
   }
   else
   {
   
   }
   if($r['D']=='1') 
   {
       $checked_D='checked';
   }
   else
   {
   
   }
   
     } 
     ?>
<?php 
   echo "<div class='checkbox'>";
            ?>
<tr>
   <td>
      <div class="pretty p-default">
         <label><b><?=$row['submenu'];?><b></label>
      </div>
   </td>
   <td>
      <div class="pretty p-default">
         <input type='checkbox' class="checkhour<?=$row['id'];?>" name = 'per[]' id='per[]' onclick='un_check(<?=$row["id"];?>);' value="<?=$row['id']?>" <?=$checked_m?>>
         <div class="state p-success-o">
            <label>&nbsp;</label>
         </div>
      </div>
   </td>
   <td>
      <div class="pretty p-default">
         <input type='checkbox' onClick='check(<?=$row["id"];?>)' name = '<?=$idn?>[]' class='un_check<?=$row['id'];?>' value='I' <?=$checked_I;?> >
         <div class="state p-success-o">
            <label>&nbsp;</label>
         </div>
      </div>
   </td>
   <td>
      <div class="pretty p-default">
         <input type='checkbox' onClick='check(<?=$row["id"];?>)' name = '<?=$idn?>[]' class='un_check<?=$row['id'];?>' value='U' <?=$checked_U;?> >
         <div class="state p-success-o">
            <label>&nbsp;</label>
         </div>
      </div>
   </td>
   <td>
      <div class="pretty p-default">
         <input type='checkbox' onClick='check(<?=$row["id"];?>)' name = '<?=$idn?>[]' class='un_check<?=$row['id'];?>' value='D' <?=$checked_D;?> >
         <div class="state p-success-o">
            <label>&nbsp;</label>
         </div>
      </div>
   </td>
   <!-- <td>
      <div class="pretty p-default">
        
        <input type="date" value="<?=$row['start_date'];?>" name="<?=$idn?>[]" >
      </div>
   </td>
   <td>
      <div class="pretty p-default">
        
     <input type="date" value="<?=$row['end_date'];?>" name="<?=$idn?>[]" >
      </div>
   </td> -->
</tr>
<?php 
   echo "</div>";
   
   }
   echo "</table>";
   }
   
   echo "<input type = 'submit' onclick='submit_special_per(".$user_id.");' class = 'btn btn-primary btn-xs' name = ''>";
   echo "</form";
   }
   else
   {
   echo "<p style='color:red;'>Please Enter Employee ID </p>";
   }
   }
   
   elseif($code==33)   //71
   {
   
   $user_id = $_GET['user_id'];
   $userQry="SELECT * FROM user WHERE emp_id = '$user_id'";
   $userRes=mysqli_query($conn,$userQry);
   if (mysqli_num_rows($userRes)<1) 
   {      
   $staff="SELECT * FROM Staff Where IDNo='$user_id' ";
   $stmt = sqlsrv_query($conntest,$staff);  
   while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
   {
   $IDNo=$row_staff['IDNo'];
   $Name=$row_staff['Name'];
   $Clg=$row_staff['CollegeName'];
   $dept=$row_staff['Department'];
   $Desi=$row_staff['Designation'];
   $contact=$row_staff['ContactNo'];
   $email=$row_staff['EmailID'];
   mysqli_query($conn,"INSERT INTO user (emp_id, name, college, department, designation, mobile, email) VALUES ('$IDNo', '$Name', ' $Clg','$dept', '$Desi', '$contact', '$email')");
   
   }
   
   } 
   
  $presult = sqlsrv_query($conntest,"SELECT IDNo,Name,RoleID from Staff WHERE IDNo = '$user_id'");
   
   $name = $emp_id = "";


   while($row=sqlsrv_fetch_array($presult,SQLSRV_FETCH_ASSOC))
   {
      $permissions = $row['RoleID'];
     $emp_id = $row['IDNo'];
     $name = $row['Name'];
   }
   
   
   echo "<h4>Role Assigned</h4>";
   
   $count=0;
   
   $result1 = mysqli_query($conn,"SELECT DISTINCT role_name,id from role_name where id='$permissions'  order by role_name ASC");
   while($row1=mysqli_fetch_array($result1))
   {
   $main[]= $row1['role_name'];
   $main_id[]= $row1['id'];
   
   $count++;
   }
   for($i=0;$i<$count;$i++)
   {?>
<table class="table">
   <tr>
      <th><b style='color:#a62532;'><?=$main[$i];?></b></th>
      <th><input type="button" class="btn btn-danger btn-xs" onclick="del_role(<?=$user_id;?>);" value="Delete"></th>
   </tr>
</table>
<?php 
   } 
   echo "<br>";
    echo "<h4>Special permissions Assigned</h4>";
    ?>
<table class="table">
   <tr>
      <th>Main Menu</th>
      <!-- <th>View</th> -->
      <th>Insert</th>
      <th>Update</th>
      <th>Delete</th>
   </tr>
   <?php 
      $result1 = mysqli_query($conn,"SELECT * from permissions");
      
      while($row=mysqli_fetch_array($result1))
              { $idn=$row['id'];
           $checked_m="";
           $checked_I="<i class='fa fa-times text-danger' aria-hidden='true'></i>";
           $checked_U="<i class='fa fa-times text-danger' aria-hidden='true'></i>";
           $checked_D="<i class='fa fa-times text-danger' aria-hidden='true'></i>";  
           $flag=0;     
       $sel_per="SELECT * FROM special_permission WHERE emp_id='$user_id' and page_id='$idn' ";
       $sel_run=mysqli_query($conn,$sel_per);
       while ($r=mysqli_fetch_array($sel_run))
        {
      
         if ($r['page_id']!='') 
         {
            $flag=1;
            $checked_m="checked";
            if ($r['I']=='1') 
            {
               $checked_I="<i class='fa fa-check text-success' aria-hidden='true'></i>";
            }
            if ($r['U']=='1') 
            {
                $checked_U="<i class='fa fa-check text-success' aria-hidden='true'></i>";
            }
            if($r['D']=='1') 
            {
                $checked_D="<i class='fa fa-check text-success' aria-hidden='true'></i>";
            }
            
         }
       
        
      }
      if ($flag==1)
      {
         echo "<div class='checkbox'>";
                  ?>
   <tr>
      <td>
         <div class="pretty p-default">
            <label ><b style="color: #a62535"><?=$row['submenu'];?><b></label>
         </div>
      </td>
      <td>
         <div class="pretty p-default">
            <!-- <input type='checkbox'  name = '<?=$idn?>[]' value='I' <?=$checked_I;?>  disabled> -->
            <label>&nbsp;<?=$checked_I;?></label>
         </div>
      </td>
      <td>
         <div class="pretty p-default">
            <!-- <input type='checkbox' name = '<?=$idn?>[]' value='U' <?=$checked_U;?> disabled> -->
            <label>&nbsp;<?=$checked_U;?></label>
         </div>
      </td>
      <td>
         <div class="pretty p-default">
            <!-- <input type='checkbox' name = '<?=$idn?>[]' value='D' <?=$checked_D;?> disabled > -->
            <label>&nbsp;<?=$checked_D;?></label>
         </div>
      </td>
   </tr>
   <?php 
      echo "</div>";
      }
      }
      ?>
</table>
<?php    
   }
   
   elseif($code==34) //72
   {
   $emp_id=$_GET['user_id'];
   
    $get_emp_data = sqlsrv_query($conntest,"SELECT IDNo,Name,Designation from Staff WHERE IDNo = '$emp_id'");
   while($row_emp=sqlsrv_fetch_array($get_emp_data))
   {
     $name = $row_emp['Name'];
     $designation = $row_emp['Designation'];
   }
   ?>

   <div class="modal-body">
            
               <div class="form-group" id="">
                  <h5><b>Role Assigned To :</b> <?=$name;?></h5><br>
                   <h5><b>Designation :</b> <?=$designation;?></h5><br>
                  <select class="form-control" name="" id="role_new" required>
   <option>Select Role</option>
   <?php  
      $role_get="SELECT * FROM role_name";
      $role_run=mysqli_query($conn,$role_get);
      while($role_row=mysqli_fetch_array($role_run))  
      {
         ?> 
   <option value="<?=$role_row['id'];?>"><?=$role_row['role_name'];?></option>
   <?php 
      }
      ?>
</select>
               </div>
            
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <input type="button"  onclick="submit_role(<?=$emp_id;?>);" value="Submit" class="btn btn-primary">
         </div>


<?php }
   elseif($code==35) //76
    {
      $role_id = $_GET['role_id'];
       $id = "";
            $emp_id = "";
            $name = "";
      if ($role_id==0) {
      }
      else
      {
       ?>
       <div class="table-responsive" style="height: 290px;">
<table class="table">
   <?php  
   $sr=1;
      $presult = sqlsrv_query($conntest,"SELECT IDNo,Name from Staff WHERE  RoleID='$role_id'");
      $name = $emp_id = "";
      while($row=sqlsrv_fetch_array($presult))
      {
         //  $id = $row['user_id'];
          $emp_id = $row['IDNo'];
          $name = $row['Name'];
       ?>
   <tr>
      <th><b style='color:#a62532;'><?=$sr;?></b></th>
      <th><b style='color:#a62532;'><?=$name." (".$emp_id;?>)</b></th>
      <input type="hidden" name="" value="<?=$id;?>">
      <th><input type="button" class="btn btn-danger btn-xs" onclick="del_role(<?=$emp_id;?>)" value="Delete"></th>
   </tr>
   <?php 
   $sr++;
      }
      ?>
</table>
</div>
<?php  
   }
   }

elseif($code==36)
{?>
   <table class="table">
      <tr>
             <th>Sr.No</th>
             <th>Main Menu</th>
             <th>Sub Menu</th>
             <th>Link</th>
             <th>Action</th>
          </tr>
          <tr>
              <p id="succcess_page" style="color:green;"></p>
          </tr>
  <?php 
 $menu_id = $_GET['menu_id'];
 $srno=0;
  $show_menu_all_pages = mysqli_query($conn,"SELECT * from permissions   WHERE  master_id='$menu_id'");
     
 while($row=mysqli_fetch_array($show_menu_all_pages))
      {
         $id=$row['id'];
         $srno++;
         ?>
          <tr>
            <td><?=$srno;?></td>
            <td>
              
     
<label id="menu_label<?=$id;?>"><?=$row['mainmenu'];?>


  <input type="hidden" id="main_menu_h<?=$row['id'];?>" value="<?=$row['master_id'];?>">  



  </label>


      <select class="form-control" id="main_menu<?=$row['id'];?>" style='display: none;'  >
          <option value="<?=$row['master_id'];?>"><?=$row['mainmenu'];?></option>

           <?php  $show_menu_all = mysqli_query($conn,"SELECT * from master_menu");
      while($row_menu=mysqli_fetch_array($show_menu_all))
      {?>
 <option value="<?=$row_menu['id'];?>"><?=$row_menu['menu_name'];?></option>
      <?php
       }?>
               </select>



            </td>




             <td>

               <label for="name" class="control-label">
                                       <p class="page_submenu<?=$id;?>"><?=$row['submenu'];?></p>
                                    </label></td>


             <td><label for="name" class="control-label">
                                       <p class="page_sublink<?=$id;?>"><?=$row['page_link'];?></p>
                                    </label></td>
             <td><div class="controls">
                                             <i class="fa fa-edit" id="page_edit<?=$id;?>" onclick="show_text_box_pages(<?=$id;?>);"></i>
                                             <div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" id="page_crose<?=$id;?>" onclick="page_data_submit(<?=$id;?>)" class="btn btn-success btn-xs" style='display:none;'>
<i class="fa fa-check" ></i> 
</button>

&nbsp;&nbsp;
  <button type="button" id="page_check<?=$id;?>" onclick="cencel_text_box_page(<?=$id;?>)" class="btn btn-danger btn-xs "
style='display:none ;'><i class="fa fa-times"  >     </i> 

</button>
</div>  

                                  </div>
                                 </td>
                                
          </tr>
        
       <?php }

       ?>
       <tr>
         <td>#</td>
          <td> <select class="form-control" id="main_menu" >
                  
                  <?php  $show_menu_all = mysqli_query($conn,"SELECT * from master_menu where id='$menu_id'");
      while($row_menu=mysqli_fetch_array($show_menu_all))
      {?>
 <option value="<?=$row_menu['id'];?>"><?=$row_menu['menu_name'];?></option>
      <?php }?>
           <?php  $show_menu_all = mysqli_query($conn,"SELECT * from master_menu");
      while($row_menu=mysqli_fetch_array($show_menu_all))
      {?>
 <option  value="<?=$row_menu['id'];?>"><?=$row_menu['menu_name'];?></option>
      <?php
       }?>
               </select></td>

          <td><input type="text" class="form-control" id="submenu"></td>
          <td><input type="text" class="form-control" id="sub_link"></td>
          <td><input type="button" onclick="new_page_submit()" class="btn btn-success" value="Submit"></td>
       </tr>
       </table><?php 
}

elseif($code==37)
{
    $id=$_GET['menu_id'];
    $menu_name=$_GET['menu_name'];

   $menu_update="UPDATE master_menu SET menu_name='$menu_name' WHERE id='$id'";
   $menu_run=mysqli_query($conn,$menu_update);

   $menu_update1="UPDATE permissions SET mainmenu='$menu_name' WHERE master_id='$id'";
   mysqli_query($conn,$menu_update1);
   if ($menu_run)
    {
     echo "1";  }
   else
   {
       echo "0";
   }
}


elseif($code==38) 
{
    $id=$_GET['submenu_id'];

    $submenu_name=$_GET['submenu_name'];
    $sublink=$_GET['sublink'];

      $menu=$_GET['menu'];

 $get_name="SELECT menu_name FROM master_menu where id='$menu'";
     $get_name_run=mysqli_query($conn,$get_name);
     while($get_name_row=mysqli_fetch_array($get_name_run))
     {
      $menu_name=$get_name_row['menu_name'];
     }

   $submenu_update="UPDATE permissions SET submenu='$submenu_name',master_id='$menu',page_link='$sublink',mainmenu='$menu_name' WHERE id='$id'";
   $submenu_run=mysqli_query($conn,$submenu_update);
   if ($submenu_run)
    {
     echo "1";
      }
   else
   {
       echo "0";
   }
}
elseif($code==39)
{
     $id=$_GET['menu_id'];
     $get_name="SELECT menu_name FROM master_menu where id='$id'";
     $get_name_run=mysqli_query($conn,$get_name);
     while($get_name_row=mysqli_fetch_array($get_name_run))
     {
      $menu_name=$get_name_row['menu_name'];
     }
     $submenu_name=$_GET['submenu_name'];
     $sublink=$_GET['link'];
       $submenu_update="INSERT INTO permissions(mainmenu,submenu,page_link,master_id,type) VALUES('$menu_name','$submenu_name','$sublink','$id','Menu')";
   $submenu_run=mysqli_query($conn,$submenu_update);
   if ($submenu_run)
    {
     echo "1";
      }
   else
   {
       echo "0";
   }
}


//*******************end permissions system **************************************
    elseif ($code==40)
     {
$College = $_GET['College'];
$Course = $_GET['Course'];
  $Batch = $_GET['Batch'];
  $Semester = $_GET['Semester'];
  $Type = $_GET['Type'];
    $Group = $_GET['Group'];
        $Examination = $_GET['Examination'];


$list_sql = "SELECT   ExamForm.Course,ExamForm.ReceiptDate, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ORDER BY Admissions.UniRollNo";

  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;

if($list_result === false) {

    // die( print_r( sqlsrv_errors(), true) );
}
?>
<table class="table"><tr>
   <th><input type="checkbox" id="select_all" onclick="selectAll()">
  </th> </th><th>SrNo</th> <th>Uni RollNo</th>
    <th>Name</th><th>Course</th><th>Sem</th></tr>
   <tr>
   <?php 
        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )

        { 

          $Status= $row['Status'];

          $issueDate=$row['SubmitFormDate'];
                echo "<tr>";
               echo "<td><input type='checkbox' name='check[]' id='check' value='".$row['ID']."' class='checkbox' ></td>";
                echo "<td>".$count++."</td>";
                // echo "<td>".$row['ID']."</td>";
                ?><td>
                 <b> <a href="" onclick="edit_stu(<?= $row['ID'];?>)" style="color:green;text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$row['UniRollNo'];?></a></b>

             </td><td>
                 <b> <a href="" onclick="edit_stu(<?= $row['ID'];?>)" style="color:green;text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$row['StudentName'];?></a></b>

             </td>

                  <?php 
                echo "<td>".$row['Course']."</td>";
                echo "<td>".$row['Semesterid']."</td>";
                  echo "<tr>";


}


?>
</tr></table>


<?php 


 }




 elseif ($code==41) {

  $College = $_GET['College'];
$Course = $_GET['Course'];
  $Batch = $_GET['Batch'];
  $Semester = $_GET['Semester'];

    $Group = $_GET['Group'];
      


  $list_sql = "Select * from MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SemesterID='$Semester' ANd SGroup='$Group'  AND Elective!='O' ";

  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;

if($list_result === false) {

    // die( print_r( sqlsrv_errors(), true) );
}
?>
<table class="table"><tr>
   <th>Select</th><th>SrNo</th> <th>Code</th>
    <th>Subject Name</th></tr>
   
   <?php 
        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )

        {?>

         
             
             <tr>
            
            <td><input type='checkbox' name='subject[]'  id="subjectId" class='newSubject' value='<?= $row['SrNo'];?>'><?= $row['SrNo'];?></td>
             
             <td><?=$count++;?></td>
             
                <td>
                <?=$row['SubjectCode'];?></td>
                  <td><?= $row['SubjectName'];?></td>
             
               
               </tr>




<?php
}?>

<tr> <td colspan="4"><h2> Open Elective</h2></td></tr>
<?php 
//CollegeID!='$College' AND
$list_sql = "Select * from MasterCourseStructure where  Batch='$Batch'ANd SemesterID='$Semester'  AND Elective='O'";

  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;

if($list_result === false) {

    die( print_r( sqlsrv_errors(), true) );
}
?>
<table class="table"><tr>
   <th>Select</th><th>SrNo</th> <th>Code</th>
    <th>Subject Name</th></tr>
   
   <?php 
        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )

        {?>

         
             
             <tr>
            
            <td><input type='checkbox' name='subject[]'  id="subjectId" class='newSubject' value='<?= $row['SrNo'];?>'><?= $row['SrNo'];?></td>
             
             <td><?=$count++;?></td>
             
                <td>
                <?=$row['SubjectCode'];?></td>
                  <td><?= $row['SubjectName'];?></td>
             
               
               </tr>
               <?php
}




?>
<tr><td colspan="4" style="text-align: center;"><input type="button" name="add_subject"  onclick="add_subject_examform()" value="Add Subject" class="btn btn-primary btn-xs"></td></tr>
</table>


<?php 


 }

  else if ($code==42)
     {
   $id=$_GET['id'];
    $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode  WHERE s.IDNo='$id'";
               $building_run=mysqli_query($conn,$building);
               while ($building_row=mysqli_fetch_array($building_run)) 
               {
                  $articleNo=$building_row['IDNo'];
                  $articleName=$building_row['ArticleName'];
               }
               $location="SELECT *, lm.RoomNo as Room_No, lm.ID as locationID FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName  WHERE ss.IDNo='$id'";
         
            
                $location_run=mysqli_query($conn,$location);
                if ($location_row=mysqli_fetch_array($location_run)) 
                {

                  $currentOwner=$location_row['Corrent_owner'];
                  $locationID=$location_row['locationID'];
                  $Block=$location_row['Name'];
                  $Floor=$location_row['Floor'];
                  $RoomNo =$location_row['Room_No'];
                  
               }
if ($articleName=='Meter') 
{
   $checkAssignedQry="SELECT * FROM stock_summary where IDNo='$articleNo' and Status='2'";
   $checkAssignedRes=mysqli_query($conn,$checkAssignedQry);
   if (mysqli_num_rows($checkAssignedRes)>0) 
   {
    
                  ?>
    <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th colspan="2"><center><?=$Block?></center></th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td width="50%">
              <b> <?=$articleName?> :</b> <?=$articleNo?>
            </td>
            <td >
              <b> Room No.:</b> <?=$RoomNo?>
            </td>
         </tr>
      <?php
      $oldReading=0;
     $oldReadingQry="SELECT unit,reading_date, current_reading, unit_rate FROM meter_reading where article_no='$articleNo' order by current_reading desc" ;
     $oldReadingRes=mysqli_query($conn,$oldReadingQry);
     if ($oldReadingData=mysqli_fetch_array($oldReadingRes)) 
     {
      $oldReading=$oldReadingData['current_reading'];
      ?>
      <tr>
         <th colspan="2" class="text-danger"><center>Previous Reading Details</center></th>
      </tr>
         <tr>
            <td>
               <b>Date: </b> <?=$oldReadingData['reading_date'];?>
            </td>
            <td>
               <b> Reading: </b> <?=$oldReading?>
            </td>
         </tr>
         <tr>
            <td >
               <b>Units Consumed:</b> <?=$oldReadingData['unit'];?>
            </td>
            <td >
               <b>Unit Rate: &#8377;</b> <?=$oldReadingData['unit_rate'];?>
            </td>
         </tr>
        <?php
     }
      ?>
      <tr>
         <th colspan="2"><center>New Reading</center></th>
      </tr>
      <tr>
            <td>
               <label>New Reading</label>
               <input class="form-control" type="number" id="reading" value="" min='<?=$oldReading+1?>' onchange="unitsConsumed(this.value,<?=$oldReading?>)"> 
            </td>
            <td>
               <label>Date</label>
               <input class="form-control" type="date" id="date" value="<?php echo date('Y-m-d')?>"> 
            </td>
         </tr>
         <tr>
            <td>
               <label>Units Consumed</label>
               <input type="text" class="form-control" readonly id="unitsConsumed"></td>
            <td>
               <!-- <label>Rate per Unit</label>
               <select id="unitRate" class="form-control">
                  <option value="12.25">&#8377; 12.25</option>
                  <option value="10"> &#8377; 10</option>
               </select> -->
<br>         <button class="btn btn-xs  btn-outline-primary form-control" onclick="insertReading(<?=$articleNo?>,<?=$oldReading?>,<?=$currentOwner?>,<?=$locationID?>)">Submit</button>

            </td>
            </tr>

      </tbody>
   </table>
   <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
      </div>
      <div class="col-lg-4"></div>
   </div>

<?php
}
else
{
   echo '<br><div class="alert alert-danger">
                <strong>Electrical Meter not assigned to any location.  </strong> 
                </div>';
}
}
else
{
   echo '<br><div class="alert alert-danger">
                <strong>Wrong Article </strong> 
                </div>';
}
   }


else if($code=='43')
{


 $allow=0;
 $ucourse = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
 $subject = $_GET['subject'];
 $ecat = $_GET['DistributionTheory'];
 $group = $_GET['group'];
?>

<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"></td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$ucourse."(<b>".$batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subject;?>)<b>




     </td>

<input type="hidden" value="<?= $batch;?>" name="batch">
<input type="hidden" value="<?= $ucourse;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">
<input type="hidden" value="11" name="code">
<input type="hidden" name="ecat" id="ecat" value="<?= $ecat;?>"> 


     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: center;"> Name </th>
                         <th style="width:50px;text-align: center;"> Subject </th>
                   <th style="width:25px;text-align: center;">MST Marks </th>
                    <th style="width:25px;text-align: center;">File </th>
                  <th style="width:25px;text-align: center;">Lock </th>
                      
                </tr>
 <?php
 $i='1';
 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['DistributionTheory'];
 $exam = $_GET['examination'];

 $sql1 = "{ CALL USP_Get_studentbyCollegeInternalMarksDistributionTheory('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory','$group')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

        $count=0;

     while($row = sqlsrv_fetch_array($stmt)){

 //$declare= $row['11'];

//print_r($row);



               
                  
?>
<tr>
<td><?= $i++;?><input type="hidden" name="ids[]" value="<?= $row['id'];?>"  id="ids" class='IdNos'> </td>
<td style="text-align: center"> <?=$row['UniRollNo'];?></td>
<td>  <input type="hidden" name="name[]" value="<?=$row['StudentName'];?>"> <?= $row['StudentName'];?></td>  
                                            
               <td><?= $subject;?>
             <?php  $iidd=$row['id'];?></td>
                           <td style='text-align:center;width: 100px'>  
                              <input type="text" required=""  style="width: 100px" name="mst[]" value="<?=$row['intmarks'];?>" id='marks' class='marks' ></td>
                            
                            <td>
                              <?php
                              $checkmooc="select MOOCattachment from ExamFormSubject where Id='$iidd'";
                              $list_result = sqlsrv_query($conntest,$checkmooc);
                    while($row_staff = sqlsrv_fetch_array( $list_result, SQLSRV_FETCH_ASSOC) )
     {

$moocattchment=$row_staff['MOOCattachment'];
     
     if($moocattchment!='')
     { ?>

<a href="http://erp.gku.ac.in:86/<?=$moocattchment;?>" target="_blank"><i class="fa fa-eye" style="color: green"></i></a>
    
     <?php
  }
     else
     {
      ?>
<i class="fa fa-eye-slash" style="color:red"></i>
     <?php
     }
}


                               ?>
                              

                              </td>


                              <td style='text-align:center;width: 30px'>


                            <?php


                            if($row['Locked']>0)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" onclick="unlock(<?=$row['id'];?>);" ></i>

                                <?php 


                     }
                           else {

                              if($EmployeeID=='131053')
                              {


            ?>   <form action="action.php" method="post" enctype="multipart/form-data">
                 <input type="hidden" name="code" value="358">
                 <input type="hidden" class="form-control" name='id' value="<?=$row['id'];?>">
                 <input type="file" class="form-control"  name="moocfile">
                 <button type="button"  onclick="uploadPhoto(this.form)">

                  <i class="fa fa-upload" ></i></button>
            </form>

            &nbsp;&nbsp;&nbsp;<?php }?>

                               <i class="fa fa-lock-open text-success" onclick="lock(<?=$row['id'];?>);"></i>
                                <?php 
                           
                        }
                           ?>

                        </td> </tr>

<?php 

}
  $flag=$i-1; 

?>
<input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'>

</table>

<p style="text-align: right"><input   type="submit" name="submit" value="Update" onclick="testing();" class="btn btn-danger "  >
<?php 




}
      
else if($code=='44')
{?>
<br>
<input type="checkbox" id="CE1" name="CE1" value="CE1">
<label for="CE1"> CE-1</label>&nbsp;&nbsp;

<input type="checkbox" id="CE2" name="CE2" value="CE2">
<label for="CE2"> CE-2</label>&nbsp;&nbsp;

<input type="checkbox" id="CE3" name="CE3" value="CE3">
<label for="CE3"> CE-3</label>&nbsp;&nbsp;


<input type="checkbox" id="MST1" name="MST1" value="MST1">
<label for="MS1"> MST-1</label>&nbsp;&nbsp;



<input type="checkbox" id="MST2" name="MST2" value="MST2">
<label for="MS2"> MST-2</label>&nbsp;&nbsp;



<input type="checkbox" id="ESE" name="ESE" value="ESE">
<label for="ESE"> ESE</label>&nbsp;&nbsp;



<input type="checkbox" id="Attendance" name="Attendance" value="Attendance">
<label for="Attendance"> Attendance</label><br><br>
 <h3 class="card-title"><i class='btn btn-warning btn-xs' onclick="lockall();">Lock All</i>&nbsp;&nbsp;&nbsp;
                  <i class='btn btn-warning btn-xs' onclick="unlockall();">Unlock All</i>&nbsp;&nbsp;&nbsp;
                  <i class='btn btn-warning btn-xs' onclick="unlockpending();">Unlock Pending</i></h3>
   <?php 

}

else if($code=='45')
{

 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
  $sem = $_GET['sem'];
  $subjectcode = $_GET['subject'];
  $DistributionTheory = $_GET['DistributionTheory'];
  $exam = $_GET['examination'];
 $group = $_GET['group'];
  $allow=0;

 

?>

<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"></td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$CourseID."(<b>".$Batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subjectcode ;?>)<b>




     </td>

<input type="hidden" value="<?= $Batch;?>" name="batch">
<input type="hidden" value="<?= $CourseID;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">

 <input type="hidden" name="" id='practicalidnum' value="<?=$DistributionTheory;?>">

     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: center;"> Name </th>
                         <th style="width:25px;text-align: center;"> Subject Code </th>
                   <th style="width:50px;text-align: center;">Practical Name</th>
            <th style="width:10px;text-align: center;">Exp </th>
                   <th style="width:10px;text-align: center;">Viva </th>
                    <th style="width:10px;text-align: center;">File </th>
                     <th style="width:10px;text-align: center;">Emp ID </th>
                              <th style="width:10px;text-align: center;">Status </th>
                      
                </tr>
                <input type="hidden" name="" id='practicalidnum' value="<?=$DistributionTheory;?>">
 <?php
 $i='1';

$CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
$Batch=$_GET['batch']; 
  $sem = $_GET['sem'];
  $subjectcode = $_GET['subject'];
  
  $DistributionTheory = $_GET['DistributionTheory'];

  $exam = $_GET['examination'];
 $group = $_GET['group'];
  $allow=0;


 $practicle="SELECT  a.ClassRollNo,a.UniRollNo,a.IDNo,a.StudentName,SubjectName,SubjectCode,InternalExam,ExternalExam FROM Admissions a inner join  ExamForm   ef  on a.IDNo = ef.IDNo
inner join ExamFormSubject  efs on ef.ID=efs.Examid 
where a.CollegeID='$CollegeID'ANd a.CourseID='$CourseID' AND ef.Batch='$Batch' ANd ef.SemesterID
='$sem' ANd ef.Examination='$exam' ANd SGroup='$group' ANd SubjectCode='$subjectcode' ANd efs.ExternalExam like'%Y%' order by a.UniRollNo ASC";

$count=1;

  $stmt = sqlsrv_query($conntest,$practicle);  
                     while($p_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                 {
                  $IDNo=$p_row['IDNo'];
                  $unirollNo=trim($p_row['UniRollNo']);
                  ?>
                  <tr><td>
                <?= $count++;?>
              </td>
                 <td>
                  <input type="hidden" name="unirollno[]" value="<?=$unirollNo;?>" class="unirollnos">
                 <?=  $UnirollNo=$p_row['UniRollNo'];?>/<?= $UnirollNo=$p_row['ClassRollNo'];?>
              </td>

              <td>
                 <?=  $StudentName=$p_row['StudentName'];?>
              </td>
                <td>
                  <?=  $subjectcode=$p_row['SubjectName'];?>
                   (<?=  $subjectcode=$p_row['SubjectCode'];?>)
                 
              </td>

               <?php    
                  $practicalnameq="select * from MasterPracticals where id='$DistributionTheory'";
 $stmt1 = sqlsrv_query($conntest,$practicalnameq);  
               while($pn_row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
               {?>
<td>
                 <?= $pn_row['Practical_Name'];?>(<?= $pn_row['Practical_Mark'];?>)</td>
             

            <?php 

               }
                  
                   $marks="select * from PracticalMarks where IDNo='$IDNo' ANd  PID='$DistributionTheory'";
 $stmt2 = sqlsrv_query($conntest,$marks, array(), array( "Scrollable" => 'static' ));  
$row_count = sqlsrv_num_rows($stmt2);
if($row_count>0)
{
               while($m_row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
               {

                $updateby=$m_row['Updateby'];
                ?>
             <td>  <input type='hidden'  name="ids[]" value="<?= $m_row['id'];?>"  id="ids" class='IdNos'>
                          

                           <select id='Pmarks' class="pmarksids">
                              
                               <option value="<?=$m_row['PMarks'];?>"><?=$m_row['PMarks'];?></option>
                            
                                <option value="AB">AB</option>
                              <?php for($p=0;$p<=10;$p++)
                              {?>
                              <option value="<?=$p;?>"><?=$p;?></option>
                           <?php }
                       ?>
                           </select> 

                        </td>
                  <td> 
                           <select id='Vmarks' class="vmarksids">
                              <option value="<?=$m_row['VMarks'];?>"><?=$m_row['VMarks'];?></option>
                              <option value="AB">AB</option>
                              <?php for($p=0;$p<=5;$p++)
                              {?>
                              <option value="<?=$p;?>"><?=$p;?></option>
                           <?php }?>
                           </select> </td>

                            <td> 
                           <select id='Fmarks' class="fmarksids">
                              <option value="<?=$m_row['FMarks'];?>"><?=$m_row['FMarks'];?></option>
                              <option value="AB">AB</option>
                              <?php for($p=0;$p<=5;$p++)
                              {?>
                              <option value="<?=$p;?>"><?=$p;?></option>
                           <?php }?>
                           </select> </td>
                           <td><input type="text" style="width:60px" value="<?= $updateby;?>" id='internalupdatedby'> </td>


                           <td style='text-align:center;width: 10px'>

                          <?php


                            if($m_row['Locked']!=NULL)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" onclick="unlock(<?=$m_row['id'];?>);" ></i>
                                <?php 


                     }
                           else {
                       ?>
                               <i class="fa fa-lock-open text-success" onclick="lock(<?=$m_row['id'];?>);"></i>
                                <?php 
                           }
                           ?> 

                        </td> 

            <?php 

               }
            }
            else
            {
?>
               <td style="background-color: red">  <input type='hidden'  name="ids[]" value=""  id="ids" class='IdNos'>
                           <select id='Pmarks'  class="pmarksids">
                              
                              <option value="">Select</option>
                            
                                <option value="AB">AB</option>
                              <?php for($p=0;$p<=10;$p++)
                              {?>
                              <option value="<?=$p;?>"><?=$p;?></option>
                           <?php }
                       ?>
                           </select> 




                        </td>
                  <td style="background-color: red"> 
                           <select id='Vmarks' class="vmarksids">
                             <option value="">Select</option>
                              <option value="AB">AB</option>
                              <?php for($p=0;$p<=5;$p++)
                              {?>
                              <option value="<?=$p;?>"><?=$p;?></option>
                           <?php }?>
                           </select> </td>

                            <td style='text-align:center;width: 10px'> 
                           <select id='Fmarks' class="fmarksids">
                             <option value="">Select</option>
                              <option value="AB">AB</option>
                              <?php for($p=0;$p<=5;$p++)
                              {?>
                              <option value="<?=$p;?>"><?=$p;?></option>
                           <?php }?>
                           </select> </td>
                           <td><input type="text" style="width:60px" value="" id='internalupdatedby'> </td>


                           <td style='text-align:center;width: 30px'>

                          

                        </td> 

               <?php 
               }
               echo "</tr>";
            

}?>
</table>
<p> <input   type="submit" name="submit" value="Lock" onclick="lockallpractical();" class="btn btn-danger "  >
<input   type="submit" name="submit" value="UnLock" onclick="unlocklockallpractical();" class="btn btn-success " style="margin-left:250px"  >
<input   type="submit" name="submit" value="Update" onclick="testing();" class="btn btn-info" style="margin-left:250px"  >


<?php 
               






}

else if($code=='46')
{

 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
$Batch=$_GET['batch']; 
  $sem = $_GET['sem'];
  $subjectcode = $_GET['subject'];
  
  $DistributionTheory = $_GET['DistributionTheory'];

  $exam = $_GET['examination'];
 $group = $_GET['group'];
  $allow=0;

 

?>

<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"></td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$CourseID."(<b>".$Batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subjectcode ;?>)<b>




     </td>

<input type="hidden" value="<?= $Batch;?>" name="batch">
<input type="hidden" value="<?= $CourseID;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">

 <input type="hidden" name="" id='practicalidnum' value="<?=$DistributionTheory;?>">

     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: center;"> Name </th>
                         <th style="width:25px;text-align: center;"> Subject Code </th>
                   <th style="width:50px;text-align: center;">Practical Name</th>
            <th style="width:10px;text-align: center;">Marks </th>
                  
                     <th style="width:10px;text-align: center;">Emp ID </th>
                              <th style="width:10px;text-align: center;">Status </th>
                      
                </tr>
                <input type="hidden" name="" id='practicalidnum' value="<?=$DistributionTheory;?>">
 <?php
 $i='1';

$CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
$Batch=$_GET['batch']; 
  $sem = $_GET['sem'];
  $subjectcode = $_GET['subject'];
  
  $DistributionTheory = $_GET['DistributionTheory'];

  $exam = $_GET['examination'];
 $group = $_GET['group'];
  $allow=0;


 $practicle="SELECT  a.UniRollNo,a.IDNo,a.StudentName,SubjectName,SubjectCode,InternalExam,ExternalExam FROM Admissions a inner join  ExamForm   ef  on a.IDNo = ef.IDNo
inner join ExamFormSubject  efs on ef.ID=efs.Examid 
where a.CollegeID='$CollegeID'ANd a.CourseID='$CourseID' AND ef.Batch='$Batch' ANd ef.SemesterID
='$sem' ANd ef.Examination='$exam' ANd SGroup='$group' ANd SubjectCode='$subjectcode' ANd efs.ExternalExam like'%Y%' order by a.UniRollNo ASC";

$count=1;

  $stmt = sqlsrv_query($conntest,$practicle);  
                     while($p_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                 {
                  $IDNo=$p_row['IDNo'];
                  ?>
                  <tr><td>
                <?= $count++;?>
              </td>
                 <td>
                  <input type="hidden" name="unirollno[]" value="<?=$p_row['UniRollNo'];?>" class="unirollnos">
                 <?=  $UnirollNo=$p_row['UniRollNo'];?>
              </td>

              <td>
                 <?=  $StudentName=$p_row['StudentName'];?>
              </td>
                <td>
                  <?=  $subjectcode=$p_row['SubjectName'];?>
                   (<?=  $subjectcode=$p_row['SubjectCode'];?>)
                 
              </td>

               <?php    
                  $practicalnameq="select * from MasterWorkshop where id='$DistributionTheory'";
 $stmt1 = sqlsrv_query($conntest,$practicalnameq);  
               while($pn_row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
               {?>
<td>
                 <?= $pn_row['Workshop_Name'];?>(<?= $pn_row['Workshop_Mark'];?>)</td>
             

            <?php 

               }
                  
                   $marks="select * from WorkshopMark where IDNo='$IDNo' ANd  PID='$DistributionTheory'";
 $stmt2 = sqlsrv_query($conntest,$marks, array(), array( "Scrollable" => 'static' ));  
$row_count = sqlsrv_num_rows($stmt2);
if($row_count>0)
{
               while($m_row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
               {

                $updateby=$m_row['Updateby'];
                ?>
             <td>  <input type='hidden'  name="ids[]" value="<?= $m_row['id'];?>"  id="ids" class='IdNos'>
              <input type="text" id='Pmarks'  style="width: 50px" value="<?= $m_row['Marks'];?>" class="pmarksids">
                           
                              
                              

                        </td>
                 

                           <td><input type="text" style="width:60px" value="<?= $m_row['Updateby'];?>" id='internalupdatedby'> </td>


                           <td style='text-align:center;width: 10px'>

                          <?php


                            if($m_row['Locked']!=NULL)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" onclick="unlock(<?=$m_row['id'];?>);" ></i>
                                <?php 


                     }
                           else {
                       ?>
                               <i class="fa fa-lock-open text-success" onclick="lock(<?=$m_row['id'];?>);"></i>
                                <?php 
                           }
                           ?> 

                        </td> 

            <?php 

               }
            }
            else
            {
?>
               <td style="background-color: red">  <input type='hidden'  name="ids[]" value=""  id="ids" class='IdNos'>
                           <input type="text" id='Pmarks' style="width: 50px" value="" class="pmarksids">




                        </td>
                 

                          
                           <td><input type="text" style="width:60px" value="<?= $updateby;?>" id='internalupdatedby'> </td>


                           <td style='text-align:center;width: 30px'>

                          

                        </td> 

               <?php 
               }
               echo "</tr>";
            

}?>
</table>
<p> <input   type="submit" name="submit" value="Lock" onclick="lockallpractical();" class="btn btn-danger "  >
<input   type="submit" name="submit" value="UnLock" onclick="unlocklockallpractical();" class="btn btn-success " style="margin-left:250px"  >
<input   type="submit" name="submit" value="Update" onclick="testing();" class="btn btn-info" style="margin-left:250px"  >


<?php 
               






}
elseif($code==47)
{
  $id = $_GET['id'];
    // $type = $_GET['type'];
    $sql="SELECT * FROM stock_summary  where LocationID='$id' ";
    $result = mysqli_query($conn,$sql);
    $date=date('Y-m-d');
    $count=1;
    while($data=mysqli_fetch_array($result))
    {
       $currentOwner=$data['Corrent_owner'];
       $currentLocation=$data['LocationID'];
       $deviceSerialNo=$data['DeviceSerialNo'];
       $workingStatus=$data['WorkingStatus'];
       $referenceNo=$data['reference_no'];
       $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', 'Remove', '$currentLocation', '$currentOwner', 'Remove All', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
       $res=mysqli_query($conn,$qry);
       if ($res) 
       {
            $updateQry="UPDATE stock_summary SET Corrent_owner='',reference_no=''  WHERE LocationID='$id'";
            mysqli_query($conn,$updateQry);
       }

echo $count++;
    }

}


else if($code=='48')
{
 $CollegeID = $_GET['college'];
 $exam = $_GET['examination'];
  $type = $_GET['type'];
   $allow=0;
  ?>
  <table   class="table"  style="border: 2px solid black"  >
 <tr> <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:50px;text-align:left">Course</th>
                     <th style="width:25px;text-align: center;"> Semester</th>
                       <th style="width:25px;text-align: center;">Batch</th>
                         <th style="width:50px;text-align: center;"> Subject Name </th>
                   <th style="width:50px;text-align: center;">Subject Code</th>
                     <th style="width:50px;text-align: center;">Subject Type</th>
            <th style="width:10px;text-align: center;">No Of Paper </th>
              <th style="width:10px;text-align: center;">Emp ID </th>
              <th style="width:10px;text-align: center;">Status </th>
            </tr>
      
<?php 

 $pendingpa = "Select  Distinct es.Course,es.SubjectName,es.SubjectCode,es.SemesterID,es.SubjectType,es.Batch from ExamformSubject es  inner join ExamForm  ef on ef.ID = es.Examid  inner  join MasterCourseStructure mcs on es.SubjectCode=mcs.SubjectCode where es.Examination='$exam' ANd es.ExternalExam='Y' ANd ef.CollegeID='$CollegeID' ANd es.Type='Reappear' order by SemesterID";

$stmt = sqlsrv_query($conntest,$pendingpa);  
                     while($p_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                 {
                 
                 $Subjectcodes[]=$p_row['SubjectCode'];
                 $SubjectName[]=$p_row['SubjectName'];
                 $SubjectType[]=$p_row['SubjectType'];
                  $Course[]=$p_row['Course'];
                 $Semester[]=$p_row['SemesterID'];
                 $Batch[]=$p_row['Batch'];
                  }
               
             $loop= count($Subjectcodes);



?>
                  

    

<?php 
for($i=0,$sr=1;$i<$loop;$i++,$sr++)
{
$emp_id="";
$sql = "SELECT * FROM question_paper_files WHERE SubjectCode='$Subjectcodes[$i]' ANd Course='$Course[$i]' ANd Batch='$Batch[$i]' AND Status>=0";
$z=0;
 $result = mysqli_query($conn, $sql);
     while($row=mysqli_fetch_array($result))
  {

  $emp_id=$row['UpdatedBy'];
   
$z++;
  }?>    
 <tr><td><?=$sr;?></td><td><?= $Course[$i];?></td><td style="width:25px;text-align: center;"><?=  $Semester[$i];?></td>

   <td style="width:50px;text-align: center;"><?= $Batch[$i];?></td><td style="width:25px;text-align: center;"><?= $SubjectName[$i];?></td><td style="width:25px;text-align: center;"><?= $Subjectcodes[$i];?></td><td style="width:25px;text-align: center;"><?= $SubjectType[$i];?></td><td style="width:25px;text-align: center;"> <b><?=$z;   ?> </b>
</td><td style="width:25px;text-align: center;"><?= $emp_id;?></td><td style="width:25px;text-align: center;"> <?php if($z>0){?><i class="fa fa-check fa-2x" style="color:green"></i><?php }
else{?><i class="fa fa-times fa-2x" style="color:red"></i><?php 
};   ?> 
</td></tr>           

<?php 
}


}


else if($code==49)
{
   $id=$_GET['id'];
   $sql="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode where   IDNo='$id'";
   $result = mysqli_query($conn,$sql);
   $array = array();
   $a=0;
   
   while($row=mysqli_fetch_array($result))
   {
   $a++;
   $array[] = $row;
   //print_r($array);
   }
   
   for ($i=0; $i<$a; $i++)
   { 
   $emp_id=$array[$i]['Corrent_owner'];
   $category=$array[$i]['ArticleName'];
   $working=$array[$i]['WorkingStatus'];
   $issue_date=$array[$i]['IssueDate'];
   $description=$array[$i]['CPU'].' '.$array[$i]['Brand'].' '.$array[$i]['Model'].' '.$array[$i]['DeviceSerialNo'];
   if ($working=='0'||$working=='') 
   {
   $remarks='Working';
   }
   elseif ($working=='1') 
   {
   $remarks='Faulty';
   }
   
   }
   $sql1="SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$emp_id'";
   
   $q1 = sqlsrv_query($conntest,$sql1);
   
   while($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC) )
        {
   $name=$row['Name'];
   $Department=$row['Department'];
   $Designation=$row['Designation'];
   $CollegeName=$row['CollegeName'];
   $img= $row['Snap'];
   $pic = 'data://text/plain;base64,' . base64_encode($img);
   }
   
   
   $location_num=0;
   ?>
<div class="card-body table-responsive p-0" style="height: 100%;">
   <?php 
  $id=$_GET['id'];
      $location="SELECT *, lm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName inner join user on ss.Corrent_owner=user.emp_id WHERE ss.IDNo='$id'";
         $location_run=mysqli_query($conn,$location);
         if ($location_row=mysqli_fetch_array($location_run)) 
         {
          $location_num=$location_num+1;
      ?>

   <br>
    <label>Location</label>
    <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
           
            <th>Block</th>
            <th>Floor</th>
            <th>Room No</th>
            <th>Room Type</th>
            <th>Room Name</th>
            
         </tr>
      </thead>
      <tbody>
         <tr>
            
            <td>
               <?=$location_row['Name'];?>
            </td>
            <td>
               <?=$location_row['Floor'];?>
            </td>
            <td>
               <?=$location_row['abc'];?>
            </td>
            <td>
               <?=$location_row['RoomType'];?>
            </td>
            <td>
               <?=$location_row['RoomName'];?>
            </td>
            
         </tr>
      </tbody>
   </table>
   
   <br>
   <label>Particular's Description(<?=$id?>)</label>
   <table class="table table-head-fixed text-nowrap" border="1" style="border: 2px solid black;">
      <thead>
         <tr>
            <th>Article </th>
            <th>View</th>
            <th>Brand</th>
            <th>OS</th>
            <th>Model</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$location_row['ArticleName'];?>
            </td>
            <td>
               <?=$location_row['CPU'];?>
            </td>
            <td>
               <?=$location_row['Brand'];?>
            </td>
            <td>
               <?=$location_row['OS'];?>
            </td>
            <td>
               <?=$location_row['Model'];?>
            </td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
   <br>
   <div class="row" >
      <div class="col-lg-6">
         <label>Remarks</label>
         <input type="text" id="returnRemark" class="form-control" required>
      </div>
      <div class="col-lg-3">
         <label>Status</label>
         <select id="workingStatus" class="form-control" required>
            <option value="">Select</option>
            <option value="0">Working</option>
            <option value="1">Discard</option>
            
         </select>
      </div>
      <div class="col-lg-3">
         <label>&nbsp;</label>
         <button type="submit" data-dismiss="modal" class="form-control btn-danger btn" onclick="returnSubmita(<?=$id?>)">Update</button>
      </div>
   </div>
   <br>
</div>

<?php 
}
else if($code=='51')
{
 $allow=0;
 $ucourse = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
 $subject = $_GET['subject'];
 $ecat = $_GET['DistributionTheory'];
 $group = $_GET['group'];
 $start=0;
if($ecat=='CE1')
{
$max=20;
}
else if($ecat=='CE3')
{
$max=5;
}

else if($ecat=='MST1')
{
$max=30;
}else if($ecat=='MST2')
{
$max=30;
}
else if($ecat=='ESE')
{
$max=40;
}
else if($ecat=='Attendance')
{
$max=5;
$start=3;
}
?>
<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;">  <?= $ecat ;?> </td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$ucourse."(<b>".$batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subject;?>)<b>




     </td>

<input type="hidden" value="<?= $batch;?>" name="batch">
<input type="hidden" value="<?= $ucourse;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">
<input type="hidden" value="11" name="code">
<input type="hidden" name="ecat" id="ecat" value="<?= $ecat;?>"> 


     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: left;"> Name </th>
                         <th style="width:50px;text-align: left;"> Subject </th>
                   <th style="width:25px;text-align: left;">Marks </th>
                    <th style="width:25px;text-align: left;">Updated By </th>
                     <th style="width:25px;text-align: left;">Updated On </th>
                   
                  <th style="width:25px;text-align: center;">Lock Status </th>
                      
                </tr>
 <?php
 $i='1';
 $srno=1;
 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['DistributionTheory'];
 $exam = $_GET['examination'];

 $sql1 = "{ CALL USP_Get_studentbyCollegeInternalMarksDistributionTheory('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory','$group')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 
  $count=0;
  while($row = sqlsrv_fetch_array($stmt)){

 //$declare= $row['11'];

// print_r($row);

          
                  
?>
<tr>
<td><?= $srno;?><input type="hidden" name="ids[]" value="<?= $row['id'];?>"  id="ids" class='IdNos'> </td>
<td style="text-align: left"> <?=$row['UniRollNo'];?>/<?=$row['ClassRollNo'];?></td>
<td>  <input type="hidden" name="name[]" value="<?=$row['StudentName'];?>"> <?= $row['StudentName'];?></td>  
                                            
               <td>
                  <?= $row['SubjectName'];?>/<?= $subject;?>
             <?php   $iidd=$row['id'];?></td>
                           <td style='text-align:left;width:50px'>  


<?php

 $getdistri="Select Id from DDL_TheroyExamination where Value='$DistributionTheory'" ;
$list_resultdi = sqlsrv_query($conntest,$getdistri);
        $i = 1;
        while( $rowdi = sqlsrv_fetch_array($list_resultdi, SQLSRV_FETCH_ASSOC) )
        {  
            $did=$rowdi['Id'];
        }





     $exam_type=$DistributionTheory;
   $list_sqlw5 ="SELECT * from DDL_TheroyExaminationSemester  as DTES inner join DDL_TheroyExamination as DTE  ON DTE.id=DTES.DDL_TE_ID   Where  DDL_TE_ID='$did' ANd Semesterid='$semID' order by DTES.SemesterId  ASC";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);
        $i = 1;
        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
            $todaydate=date('d-m-Y');
            $endDate=$row5['EndDate']->format('d-m-Y');
         
              if (strtotime($endDate)<strtotime($todaydate)) 
              {
              $dateover=1;
              $show="<b style='color:red;'>Date Over</b>";

              }
              else
              {
               $dateover=0;
               $show="";
              }
              ?>
              
      <?php     
         }
         ?>
<select  name="mst[]"  id='marks_<?=$iidd;?>' class='marks' onchange="savemarks(<?=$iidd;?>)" >

<?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['intmarks']!='')
{
   ?>
    <option value="<?=$row['intmarks'];?>"><?=$row['intmarks'];?></option>

<?php
}

  


   }
   else
   {
   if($row['intmarks']!='')
{
   ?>
    <option value="<?=$row['intmarks'];?>"><?=$row['intmarks'];?></option>

<?php
}

    ?>
     <option value="">Select</option>
      
        <option value='NA'>NA</option>


        <?php 

        if($ecat=='Attendance')
        {?>
          <option value='0'>0</option>


       <?php  }else
       {?>
         <option value='AB'>AB</option>
       <?php } 


for($j=$start;$j<=$max;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
      
                           
     }
      ?>


</select>
<?php 
if($dateover>0)
{
   echo $show;
}?>



                           </td>

                           <td><?=$row['updateby'];?></td>
                           <td><?php 
                           If($row['updatedDate']!='')
                           {
                            echo $row['updatedDate']->format('Y-m-d H:i:s');
                        }?></td>
                            
                            


                              <td style='text-align:center;width: 30px'>


                            <?php


                            if($row['Locked']>0)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" ></i>
                                <!--<i class="fa fa-lock text-danger" onclick="unlock(<?=$row['id'];?>);" ></i>-->

                                <?php 


                     }
                           else {

                           ?>
                               <!-- <i class="fa fa-lock-open text-success" onclick="lock(<?=$row['id'];?>);"></i> -->
                                <i class="fa fa-lock-open text-success" ></i>
                                <?php 
                           
                        }
                           ?>

                        </td> </tr>

<?php 
$srno++;
}
  $flag=$i-1;

?>
<input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'>

</table>

<p style="text-align: right"><input   type="submit" name="submit" value="Lock" onclick="testing();" class="btn btn-danger "  >
<?php 




}

else if($code=='52')
{


 $allow=0;
 $ucourse = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
 $subject = $_GET['subject'];
 $group = $_GET['group'];
 $ecat = $_GET['DistributionTheory'];
 $start=0;

 
?>
<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"></td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$ucourse."(<b>".$batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subject;?>)<b>




     </td>

<input type="hidden" value="<?= $batch;?>" name="batch">
<input type="hidden" value="<?= $ucourse;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">
<input type="hidden" value="11" name="code">
<input type="hidden" name="ecat" id="ecat" value="<?= $ecat;?>"> 


     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: left;"> Name </th>
                         <th style="width:50px;text-align: left;"> Subject </th>
                   <th style="width:25px;text-align: left;">EMarks </th>
                     <th style="width:25px;text-align: left;">FMarks </th>
                       <th style="width:25px;text-align: left;">VMarks </th>
                        <th style="width:25px;text-align: left;">TotalMarks </th>
                    <th style="width:25px;text-align: left;">Updated By </th>
                     <th style="width:25px;text-align: left;">Updated On </th>
                   
                  <th style="width:25px;text-align: center;">Lock Status </th>
                      
                </tr>
 <?php
 $i='1';



 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['DistributionTheory'];
 $exam = $_GET['examination'];
  $group = $_GET['group'];

 $sql1 = "{CALL USP_Get_studentbyCollegeInternalMarksDistributionPractical('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory','$group')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

        $count=0;

     while($row = sqlsrv_fetch_array($stmt)){

 //$declare= $row['11'];

//print_r($row);



               
                  
?>
<tr>
<td><?= $i++;?><input type="hidden" name="ids[]" value="<?= $row['id'];?>"  id="ids" class='IdNos'> </td>
<td style="text-align: left"> <?=$row['UniRollNo'];?>/<?=$row['ClassRollNo'];?></td>
<td>  <input type="hidden" name="name[]" value="<?=$row['StudentName'];?>"> <?= $row['StudentName'];?></td>  




                                            
               <td>
                  <?= $row['SubjectName'];?>/<?= $subject;?>
             <?php   $iidd=$row['id'];?></td>


<?php

$getdistri="Select Id from DDL_TheroyExamination where Value='PracticalNO'" ;
$list_resultdi = sqlsrv_query($conntest,$getdistri);
      
        while( $rowdi = sqlsrv_fetch_array($list_resultdi, SQLSRV_FETCH_ASSOC) )
        {  
            $did=$rowdi['Id'];
        }





     $exam_type=$DistributionTheory;

   $list_sqlw5 ="SELECT * from DDL_TheroyExaminationSemester  as DTES inner join DDL_TheroyExamination as DTE  ON DTE.id=DTES.DDL_TE_ID   Where  DDL_TE_ID='$did' ANd Semesterid='$semID' order by DTES.SemesterId  ASC";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);

        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
            $todaydate=date('d-m-Y');
            $endDate=$row5['EndDate']->format('d-m-Y');
         
              if (strtotime($endDate)<strtotime($todaydate)) 
              {
              $dateover=1;
              $show="<b style='color:red;'>Date Over</b>";

              }
              else
              {
               $dateover=0;
               $show="";
              }
              ?>
              
      <?php     
         }

         ?>

<td>

   <select  name="emst[]"  id='emarks_<?=$iidd;?>' class='emarks' onchange="savepmarks(<?=$iidd;?>)" >
       <option value="<?=$row['experiment'];?>"><?=$row['experiment'];?></option>





<?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['experiment']!='')
{
   ?>
    <option value="<?=$row['experiment'];?>"><?=$row['experiment'];?></option>

<?php
}

  


   }
   else
   {
   if($row['experiment']!='')
{
   ?>
    <option value="<?=$row['experiment'];?>"><?=$row['experiment'];?></option>

<?php
}
?>



 <option value="">Select</option>
  
        <?php 

for($j=$start;$j<=10;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
}
?>
</select>
</td>

<td>

   <select  name="vmst[]"  id='vmarks_<?=$iidd;?>' class='vmarks' onchange="savepmarks(<?=$iidd;?>)" >
        <option value="<?=$row['viva'];?>"><?=$row['viva'];?></option>

   <?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['viva']!='')
{
   ?>
    <option value="<?=$row['viva'];?>"><?=$row['viva'];?></option>

<?php
}

  


   }
   else
   {
   if($row['viva']!='')
{
   ?>
    <option value="<?=$row['viva'];?>"><?=$row['viva'];?></option>

<?php
}
?> <option value="">Select</option>

        <?php 

for($j=$start;$j<=5;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
}
?>
</select>
</td>
<td>

   <select  name="fmst[]"  id='fmarks_<?=$iidd;?>' class='fmarks' onchange="savepmarks(<?=$iidd;?>)" >
       <option value="<?=$row['filem'];?>"><?=$row['filem'];?></option>
 


   <?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['filem']!='')
{
   ?>
    <option value="<?=$row['filem'];?>"><?=$row['filem'];?></option>

<?php
}

  


   }
   else
   {
   if($row['filem']!='')
{
   ?>
    <option value="<?=$row['filem'];?>"><?=$row['filem'];?></option>

<?php
}
?>








 <option value="">Select</option>
   <!--  <option value='S'>S</option>
    <option value='US'>US</option> -->
        <?php 

for($j=$start;$j<=5;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
}
?>
</select>
</td>







                           <td style='text-align:left;width:50px'>  


<!--onchange="savemarks(<?=$iidd;?>)" -->



<input type='text' name="mst[]"  id='marks_<?=$iidd;?>' class='marks' value='<?=$row['intmarks'];?>' readonly style="width: 50px;" >


<?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['intmarks']!='')
{
   ?>
    

<?php
}

  


   }

if($dateover>0)
{
   echo $show;
}
?>



                           </td>

                           <td><?=$row['updateby'];?></td>
                           <td><?php 
                           If($row['updatedDate']!=''){ echo $row['updatedDate']->format('Y-m-d H:i:s');
                        }?></td>
                            
                            


                              <td style='text-align:center;width: 30px'>


                            <?php


                            if($row['Locked']>0)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" ></i>
                                <!--<i class="fa fa-lock text-danger" onclick="unlock(<?=$row['id'];?>);" ></i>-->

                                <?php 


                     }
                           else {

                           ?>
                               <!-- <i class="fa fa-lock-open text-success" onclick="lock(<?=$row['id'];?>);"></i> -->
                                <i class="fa fa-lock-open text-success" ></i>
                                <?php 
                           
                        }
                           ?>

                        </td> </tr>

<?php 

}
  $flag=$i-1;

?>
<input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'>

</table>
<p style="text-align: right"><input   type="submit" name="submit" value="Lock" onclick="testing();" class="btn btn-danger "  >
<?php 
}



else if($code==55)
{
 $allow=0;
 $ucourse = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
 $subject = $_GET['subject'];
$group = $_GET['group'];
 $ecat = $_GET['DistributionTheory'];
 $start=0;
if($ecat=='CE1')
{
$max=20;
}
else if($ecat=='CE3')
{
$max=5;
}

else if($ecat=='MST1')
{
$max=30;
}else if($ecat=='MST2')
{
$max=30;
}
else if($ecat=='ESE')
{
$max=40;
}
else if($ecat=='Attendance')
{
$max=5;
$start=3;
}

?>



<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"> <?= $ecat ;?> </td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$ucourse."(<b>".$batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subject;?>)<b>




     </td>

<input type="hidden" value="<?= $batch;?>" name="batch">
<input type="hidden" value="<?= $ucourse;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">
<input type="hidden" value="11" name="code">
<input type="hidden" name="ecat" id="ecat" value="<?= $ecat;?>"> 


     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: left;"> Name </th>
                         <th style="width:50px;text-align: left;"> Subject </th>
                   <th style="width:25px;text-align: left;">Marks </th>
                  
                    <th style="width:25px;text-align: left;">Updated By </th>
                     <th style="width:25px;text-align: left;">Updated On </th>
                   
                  <th style="width:25px;text-align: center;">Lock Status </th>
                      
                </tr>
 <?php
 $i='1';



 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['DistributionTheory'];
 $exam = $_GET['examination'];

 $sql1 = "{ CALL USP_Get_studentbyCollegeInternalMarksDistributionTheory('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory','$group')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

        $count=0;

     while($row = sqlsrv_fetch_array($stmt)){

 //$declare= $row['11'];

// print_r($row);



               
                  
?>
<tr> <form action="action.php" method="post" enctype="multipart/form-data">
<td><?= $i++;?><input type="hidden" name="ids[]" value="<?= $row['id'];?>"  id="ids" class='IdNos'> </td>
<td style="text-align: left"> <?=$row['UniRollNo'];?>/<?=$row['ClassRollNo'];?></td>
<td>  <input type="hidden" name="name[]" value="<?=$row['StudentName'];?>"> <?= $row['StudentName'];?></td>  
                                            
               <td>
                  <?= $row['SubjectName'];?>/<?= $subject;?>
             <?php   $iidd=$row['id'];?></td>
                           <td style='text-align:left;width:50px'>  


<?php

$getdistri="Select Id from DDL_TheroyExamination where Value='MOOC_Mark'" ;
$list_resultdi = sqlsrv_query($conntest,$getdistri);
        $i = 1;
        while( $rowdi = sqlsrv_fetch_array($list_resultdi, SQLSRV_FETCH_ASSOC) )
        {  
            $did=$rowdi['Id'];
        }





     $exam_type=$DistributionTheory;
   $list_sqlw5 ="SELECT * from DDL_TheroyExaminationSemester  as DTES inner join DDL_TheroyExamination as DTE  ON DTE.id=DTES.DDL_TE_ID   Where  DDL_TE_ID='$did' ANd Semesterid='$semID' order by DTES.SemesterId  ASC";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);
        $i = 1;
        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
            $todaydate=date('d-m-Y');
            $endDate=$row5['EndDate']->format('d-m-Y');
         
              if (strtotime($endDate)<strtotime($todaydate)) 
              {
              $dateover=1;
              $show="<b style='color:red;'>Date Over</b>";

              }
              else
              {
               $dateover=0;
               $show="";
              }
              ?>
              
      <?php     
         }
         ?>
         
<select  name="mst[]"   id='marks_<?=$iidd;?>' class='marks'  >

<?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['intmarks']!='')
{
   ?>
    <option value="<?=$row['intmarks'];?>"><?=$row['intmarks'];?></option>

<?php
}

  


   }
   else
   {
   if($row['intmarks']!='')
{
   ?>
    <option value="<?=$row['intmarks'];?>"><?=$row['intmarks'];?></option>

<?php
}

    ?>
     <option value="">Select</option>
             <option value='S'>S</option>
       <option value='US'>US</option>
        <?php 

for($j=$start;$j<=100;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
      
                           
     }
      ?>


</select>
<?php
if($dateover>0)
{
   echo $show;
}

?>

                
                   </td>




            
             

                           <td><?=$row['updateby'];?></td>
                           <td><?php 
                           If($row['updatedDate']!=''){ echo $row['updatedDate']->format('Y-m-d H:i:s');
                        }?></td>
                            
                            


                              <td style='text-align:center;width: 30px'>


                            <?php


                            if($row['Locked']>0)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" ></i>
                                <!--<i class="fa fa-lock text-danger" onclick="unlock(<?=$row['id'];?>);" ></i>-->

                                <?php 


                     }
                           else {

                           ?>
                               <!-- <i class="fa fa-lock-open text-success" onclick="lock(<?=$row['id'];?>);"></i> -->
                                <i class="fa fa-lock-open text-success" ></i>
                                <?php 
                           
                        }
                           ?>

                        </td> </tr>

<?php 

}
  $flag=$i-1;

?>
<input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'>

</table>
<p style="text-align: right"><input   type="submit" name="submit" value="Lock" onclick="testing();" class="btn btn-danger "  >
<?php 




}



else if($code=='54')
{


 $allow=0;
 $ucourse = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
 $subject = $_GET['subject'];
 $group = $_GET['group'];
 $ecat = $_GET['DistributionTheory'];
 $start=0;

 
?>
<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"></td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$ucourse."(<b>".$batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subject;?>)<b>




     </td>

<input type="hidden" value="<?= $batch;?>" name="batch">
<input type="hidden" value="<?= $ucourse;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">
<input type="hidden" value="11" name="code">
<input type="hidden" name="ecat" id="ecat" value="<?= $ecat;?>"> 


     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: left;"> Name </th>
                         <th style="width:50px;text-align: left;"> Subject </th>
                   <th style="width:25px;text-align: left;">EMarks </th>
                     <th style="width:25px;text-align: left;">FMarks </th>
                       <th style="width:25px;text-align: left;">VMarks </th>
                        <th style="width:25px;text-align: left;">TotalMarks </th>
                    <th style="width:25px;text-align: left;">Updated By </th>
                     <th style="width:25px;text-align: left;">Updated On </th>
                   
                  <th style="width:25px;text-align: center;">Lock Status </th>
                      
                </tr>
 <?php
 $i='1';



 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['DistributionTheory'];
 $exam = $_GET['examination'];
  $group = $_GET['group'];

 $sql1 = "{ CALL USP_Get_studentbyCollegeInternalMarksDistributionPractical('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory','$group')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

        $count=0;

     while($row = sqlsrv_fetch_array($stmt)){

 //$declare= $row['11'];

//print_r($row);



               
                  
?>
<tr>
<td><?= $i++;?><input type="hidden" name="ids[]" value="<?= $row['id'];?>"  id="ids" class='IdNos'> </td>
<td style="text-align: left"> <?=$row['UniRollNo'];?>/<?=$row['ClassRollNo'];?></td>
<td>  <input type="hidden" name="name[]" value="<?=$row['StudentName'];?>"> <?= $row['StudentName'];?></td>  




                                            
               <td>
                  <?= $row['SubjectName'];?>/<?= $subject;?>
             <?php   $iidd=$row['id'];?></td>


<?php

 $getdistri="Select Id from DDL_TheroyExamination where Value='PracticalNO'" ;
$list_resultdi = sqlsrv_query($conntest,$getdistri);
      
        while( $rowdi = sqlsrv_fetch_array($list_resultdi, SQLSRV_FETCH_ASSOC) )
        {  
            $did=$rowdi['Id'];
        }





     $exam_type=$DistributionTheory;
   $list_sqlw5 ="SELECT * from DDL_TheroyExaminationSemester  as DTES inner join DDL_TheroyExamination as DTE  ON DTE.id=DTES.DDL_TE_ID   Where  DDL_TE_ID='$did' ANd Semesterid='$semID' order by DTES.SemesterId  ASC";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);

        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
            $todaydate=date('d-m-Y');
            $endDate=$row5['EndDate']->format('d-m-Y');
         
              if (strtotime($endDate)<strtotime($todaydate)) 
              {
              $dateover=1;
              $show="<b style='color:red;'>Date Over</b>";

              }
              else
              {
               $dateover=0;
               $show="";
              }
              ?>
              
      <?php     
         }
         ?>

<td>

<select  name="emst[]"  id='emarks_<?=$iidd;?>' class='emarks' onchange="savepmarks(<?=$iidd;?>)" >
       <option value="<?=$row['experiment'];?>"><?=$row['experiment'];?></option>
 <option value="">Select</option>
   
        <?php 

for($j=$start;$j<=50;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
?>
</select>
</td>

<td>

   <select  name="vmst[]"  id='vmarks_<?=$iidd;?>' class='vmarks' onchange="savepmarks(<?=$iidd;?>)" >
        <option value="<?=$row['viva'];?>"><?=$row['viva'];?></option>
 <option value="">Select</option>
    
        <?php 

for($j=$start;$j<=25;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
?>
</select>
</td>
<td>

   <select  name="fmst[]"  id='fmarks_<?=$iidd;?>' class='fmarks' onchange="savepmarks(<?=$iidd;?>)" >
       <option value="<?=$row['filem'];?>"><?=$row['filem'];?></option>
 <option value="">Select</option>
    
        <?php 

for($j=$start;$j<=25;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
?>
</select>
</td>







                           <td style='text-align:left;width:50px'>  


<!--onchange="savemarks(<?=$iidd;?>)" -->



<input type='text' name="mst[]"  id='marks_<?=$iidd;?>' class='marks' value='<?=$row['intmarks'];?>' readonly style="width: 50px;" >

<?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['intmarks']!='')
{
   ?>
   

<?php
}

  


   }

if($dateover>0)
{
   echo $show;
}
?>



                           </td>

                           <td><?=$row['updateby'];?></td>
                           <td><?php 
                           If($row['updatedDate']!=''){ echo $row['updatedDate']->format('Y-m-d H:i:s');
                        }?></td>
                            
                            


                              <td style='text-align:center;width: 30px'>


                            <?php


                            if($row['Locked']>0)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" ></i>
                                <!--<i class="fa fa-lock text-danger" onclick="unlock(<?=$row['id'];?>);" ></i>-->

                                <?php 


                     }
                           else {

                           ?>
                               <!-- <i class="fa fa-lock-open text-success" onclick="lock(<?=$row['id'];?>);"></i> -->
                                <i class="fa fa-lock-open text-success" ></i>
                                <?php 
                           
                        }
                           ?>

                        </td> </tr>

<?php 

}
  $flag=$i-1;

?>
<input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'>

</table>
<p style="text-align: right"><input   type="submit" name="submit" value="Lock" onclick="testing();" class="btn btn-danger "  >
<?php 
}

else if($code==53)
{
 $allow=0;
 $ucourse = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
 $subject = $_GET['subject'];
 $ecat = $_GET['DistributionTheory'];
 $start=0;
if($ecat=='CE1')
{
$max=20;
}
else if($ecat=='CE3')
{
$max=5;
}

else if($ecat=='MST1')
{
$max=30;
}else if($ecat=='MST2')
{
$max=30;
}
else if($ecat=='ESE')
{
$max=40;
}
else if($ecat=='Attendance')
{
$max=5;
$start=3;
}

?>



<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"> <?= $ecat ;?> </td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$ucourse."(<b>".$batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subject;?>)<b>




     </td>

<input type="hidden" value="<?= $batch;?>" name="batch">
<input type="hidden" value="<?= $ucourse;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">
<input type="hidden" value="11" name="code">
<input type="hidden" name="ecat" id="ecat" value="<?= $ecat;?>"> 


     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: left;"> Name </th>
                         <th style="width:50px;text-align: left;"> Subject </th>
                   <th style="width:25px;text-align: left;">Marks </th>
                   <th style="width:25px;text-align: left;">Certificate</th>
                    <th style="width:25px;text-align: left;">Updated By </th>
                     <th style="width:25px;text-align: left;">Updated On </th>
                   
                  <th style="width:25px;text-align: center;">Lock Status </th>
                      
                </tr>
 <?php
 $i='1';



 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
  $group = $_GET['group'];
 $DistributionTheory = $_GET['DistributionTheory'];
 $exam = $_GET['examination'];

 $sql1 = "{ CALL USP_Get_studentbyCollegeInternalMarksDistributionTheory('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory','$group')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

        $count=0;

     while($row = sqlsrv_fetch_array($stmt)){

 //$declare= $row['11'];

 //print_r($row);



               
                  
?>
 <form id="fileUploadForm">
<tr> 



<td><?= $i++;?><input type="hidden" name="ids[]" value="<?= $row['id'];?>"  id="ids" class='IdNos'> </td>
<td style="text-align: left"> <?=$row['UniRollNo'];?>/<?=$row['ClassRollNo'];?></td>
<td>  <input type="hidden" name="name[]" value="<?=$row['StudentName'];?>"> <?= $row['StudentName'];?></td>  
                                            
               <td>
                  <?= $row['SubjectName'];?>/<?= $subject;?>
             <?php   $iidd=$row['id'];?></td>
                           <td style='text-align:left;width:50px'> 


<?php

$getdistri="Select Id from DDL_TheroyExamination where Value='MOOC_Mark'" ;
$list_resultdi = sqlsrv_query($conntest,$getdistri);
        $i = 1;
        while( $rowdi = sqlsrv_fetch_array($list_resultdi, SQLSRV_FETCH_ASSOC) )
        {  
            $did=$rowdi['Id'];
        }





     $exam_type=$DistributionTheory;
   $list_sqlw5 ="SELECT * from DDL_TheroyExaminationSemester  as DTES inner join DDL_TheroyExamination as DTE  ON DTE.id=DTES.DDL_TE_ID   Where  DDL_TE_ID='$did' ANd Semesterid='$semID' order by DTES.SemesterId  ASC";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);
        $i = 1;
        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
            $todaydate=date('d-m-Y');
            $endDate=$row5['EndDate']->format('d-m-Y');
         
              if (strtotime($endDate)<strtotime($todaydate)) 
              {
              $dateover=1;
              $show="<b style='color:red;'>Date Over</b>";

              }
              else
              {
               $dateover=0;
               $show="";
              }
              ?>
              
      <?php     
         }
         ?>
          
         
<select  name="mst[]"  name='MOOC_Mark'  id='marks_<?=$iidd;?>' class='marks'  >

<?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['intmarks']!='')
{
   ?>
    <option value="<?=$row['intmarks'];?>"><?=$row['intmarks'];?></option>

<?php
}

  


   }
   else
   {
   if($row['intmarks']!='')
{
   ?>
    <option value="<?=$row['intmarks'];?>"><?=$row['intmarks'];?></option>

<?php
}

    ?>
     <option value="">Select</option>
             <option value='S'>S</option>
       <option value='US'>US</option>
        <?php 

for($j=$start;$j<=100;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
      
                           
     }
      ?>


</select>


</td>




                           <td> 
            <?php 
                       if($row['attachments']!='') 
                           {?>
                           <!--  <a href="<?=$BasURL;?>/StdWorkshopFile/<?=$row['attachments'];?>" target="_blank"><i class='fa fa-eye'></i></a> -->
                          <i class='fa fa-eye' style="color:red"  data-toggle="modal" data-target="#UploadImageDocument" onclick="viewmooc(<?=$iidd;?>)"></i></a>
                        <?php   }?>
                                         <?php  if($row['Locked']>0||$dateover>0)
  {

     }else                       {?>
                 <input type="hidden" name="code" value="358">
                 <input type="hidden" class="form-control" name='id' value="<?=$row['id'];?>">
                 <input type="file" class="form-control" id="moocfile_<?=$iidd;?>"  name="moocfile">

                 <?php 
               
if($dateover>0)
{
   echo $show;
}
else
{
   ?>

<button type="button" class="btn btn-primary" name="form"  onclick="uploadmooc(<?=$row['id'];?>)"><i class='fa fa-upload'></i></button> 

 
<?php
}
}?> </td>


                           <td><?=$row['updateby'];?></td>
                           <td><?php 
                           If($row['updatedDate']!=''){ echo $row['updatedDate']->format('Y-m-d H:i:s');
                        }?></td>
                            
                            


                              <td style='text-align:center;width: 30px'>


                            <?php


                            if($row['Locked']>0)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" ></i>
                                <!--<i class="fa fa-lock text-danger" onclick="unlock(<?=$row['id'];?>);" ></i>-->

                                <?php 


                     }
                           else {

                           ?>
                               <!-- <i class="fa fa-lock-open text-success" onclick="lock(<?=$row['id'];?>);"></i> -->
                                <i class="fa fa-lock-open text-success" ></i>
                                <?php 
                           
                        }
                           ?>

                        </td> </tr> </form>

<?php 

}
  $flag=$i-1;

?>
<input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'>

</table>
<p style="text-align: right"><input   type="submit" name="submit" value="Lock" onclick="testing();" class="btn btn-danger "  >
<?php 




}



else if($code=='56')
{


 $allow=0;
 $ucourse = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
//  $subject = $_GET['subject'];
 $ecat = $_GET['DistributionTheory'];
 $group = $_GET['group'];
?>

<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"></td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$ucourse."(<b>".$batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>()<b>




     </td>

<input type="hidden" value="<?= $batch;?>" name="batch">
<input type="hidden" value="<?= $ucourse;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">
<input type="hidden" value="11" name="code">
<input type="hidden" name="ecat" id="ecat" value="<?= $ecat;?>"> 


     </tr>

 
              </table>

<table   class="table table-bordered table-responsive-lg" style='text-align:center;'  >
 <tr>
                 
 
 <th><input type="checkbox" id="select_all1" onclick="verifiy_select();" class="form-control"></th>
                  <th >Sr No </th>
                <th  >Uni Roll No</th>
                <th  >IDNo</th>
                                                
                      
                       <th > Name </th>
                         <th> Subject </th>
                         <th> CA 1 </th>
                         <th> CA 2 </th>
                         <th> CA 3 </th>
                         <th> Attendance </th>
                   <th >Reappear </th>
                   <th >ESE </th>
                 
                  <!-- <th >Lock </th> -->
                  <!-- <th >Action </th> -->
                      
                </tr>
 <?php
 $i='1';
 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['DistributionTheory'];
 $exam = $_GET['examination'];
 
$sql1 = "SELECT * FROM ExamForm inner join ExamFormSubject ON ExamForm.ID=ExamFormSubject.ExamID inner join Admissions ON Admissions.IDNo=ExamForm.IDNo 
  WHERE ExamForm.CollegeID='$CollegeID' and ExamForm.CourseID='$CourseID' and ExamForm.SemesterId='$semID' and ExamForm.Batch='$Batch'  and
 ExamForm.Examination='$exam' and ExamForm.SGroup='$group' and ExamForm.Type='Reappear' ANd ExamForm.Status='8' AND ExamFormSubject.ExternalExam='Y' order by Admissions.IDNo ASC";
    $stmt = sqlsrv_query($conntest,$sql1);
   if ($stmt === false) {
      $errors = sqlsrv_errors();
      echo "Error: " . print_r($errors, true);  
  } 
        $count=0;
     while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){   
      $subCode=$row['SubjectCode']; 
      $subjecttype=$row['SubjectType']; 
      // $UniRollNo=$row['UniRollNo']; 
      $IDNo=$row['IDNo']; 
      $clr="";
      $status=0;
      $MSTatus=0;
      if($row['ESE']!="")
      {
         $clr="warning";
         $MSTatus=2;
      }
      else 
      {
         $clr="";
         $MSTatus=1;
      }
       $query = "SELECT * FROM Admissions  Where IDNo='$IDNo' order by UniRollNo ASC";
      $result = sqlsrv_query($conntest,$query);
      while($rowAdm = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
      {
       $UniRollNo=$rowAdm['UniRollNo'];
       $ClassRollNo=$rowAdm['ClassRollNo'];
       $CollegeID=$rowAdm['CollegeID'];
       $CourseID=$rowAdm['CourseID'];
       $Batch=$rowAdm['Batch'];

        $getColor="SELECT ResultStatus FROM ResultPreparation WHERE IDNo='$IDNo' and Semester='$semID' and CourseID='$CourseID' and CollegeID='$CollegeID' and Examination='$exam' and Batch='$Batch' and Type='Reappear'
        order by IDNo ASC ";
       $resultgetColor = sqlsrv_query($conntest,$getColor);
       if($rowresultgetColor = sqlsrv_fetch_array($resultgetColor, SQLSRV_FETCH_ASSOC) )
       {
          
       if($rowresultgetColor['ResultStatus']=='0')
       {
          $clr="primary";
          $status=2;
       }
      else if($rowresultgetColor['ResultStatus']=='1')
      {
      $clr="success";
      $status=2;
       }
         else{
            
            $status=1;
       }
      }
   }

?>
<tr class="bg-<?=$clr;?>" >

<td><?php if($MSTatus!=1){}else{?><input type="checkbox" class="checkbox v_check" value="<?= $row['ID'];?>"><?php }?></td>
<td><?= $i++;?>
<input type="hidden"  value="<?= $row['ID'];?>"  id="ExamSubjectID"> 
<input type="hidden" value="<?= $row['IDNo'];?>"  id="ids<?= $row['ID'];?>" > 
<input type="hidden"  value="<?= $row['SubjectCode'];?>"  id="subcode<?= $row['ID'];?>" > 
<input type="hidden"  value="<?= $row['IDNo'];?>"  id="IDNo<?= $row['ID'];?>" > 
</td>

<td style="text-align: center" data-toggle="modal" data-target="#ViewResult" onclick="resultView('<?=$IDNo;?>','<?=$subCode;?>','<?=$row['UniRollNo'];?>');"> <?=$row['UniRollNo'];?>
</td>
<td style="text-align: center" data-toggle="modal" data-target="#ViewResult" onclick="resultView('<?=$IDNo;?>','<?=$subCode;?>','<?=$row['UniRollNo'];?>');"> <?=$row['IDNo'];?></td>


<td>  <input type="hidden" name="name[]" value="<?=$row['StudentName'];?>"> <?= $row['StudentName'];?></td>  
               <td><?=$row['SubjectCode'];?>
             <?php  $iidd=$row['ID'];?></td>               
       <?php 

       if($subjecttype!='P')
       {
         $fatchMarks="SELECT  MAX(CE1) as CA1,MAX(CE2) as CA2,MAX(CE3) as CA3,MAX(Attendance) as Attendance,ID as EID  FROM ExamFormSubject WHERE SubjectCode='$subCode' and Type='Regular' and IDNo='".$row['IDNo']."'
         group by CE1,CE2,CE3,Attendance,ID";
       }
       else{
         $fatchMarks="SELECT  MAX(CE1) as CA1,MAX(CE2) as CA2,MAX(CE3) as CA3,MAX(Attendance) as Attendance,ID as EID  FROM ExamFormSubject WHERE SubjectCode='$subCode' and Examination='May 2024' and IDNo='".$row['IDNo']."'
        group by CE1,CE2,CE3,Attendance,ID";

       }
        


       $RunfatchMarks=sqlsrv_query($conntest,$fatchMarks);
       if ($RunfatchMarks === false) {
          $errors = sqlsrv_errors();
          echo "Error: " . print_r($errors, true);
      } 
       if($RowfatchMarks=sqlsrv_fetch_array($RunfatchMarks,SQLSRV_FETCH_ASSOC))
       {
       ?>    
<td><input class="form-control form-control-sm " type="hidden"  value="<?=$RowfatchMarks['EID'];?>" id="ID<?= $row['ID'];?>" readonly >
<?=$RowfatchMarks['CA1'];?></td>
<td><?=$RowfatchMarks['CA2'];?></td>
<td><?=$RowfatchMarks['CA3'];?></td>
<td><?=$RowfatchMarks['Attendance'];?></td>
<?php }?>
<td>  
<?=$row['pmarks'];?></td> 
<td><?=$row['ESE'];?></td> 
                           
                        <!-- <td>
                           <input type="button" value="Update" class="btn btn-primary btn-sm" onclick="updateMarks('<?=$row['ID'];?>','<?= $row['IDNo'];?>','<?= $row['SubjectCode'];?>');">
                        </td> -->
                     </tr>
                     

<?php 
$clr="";
}
//   $flag=$i-1; 
?>
<!-- <input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'> -->
</table>
<p style="text-align: right">
   <input   type="submit" name="submit" value="Update All" onclick="updateAll();" class="btn btn-danger "  >
   <!-- <input   type="submit" name="submit" value="Result Update All" onclick="resultupdateAll();" class="btn btn-danger "  > -->

<?php 
}
   
else if ($code == 57) {
   $id = $_GET['id'];
   // $sql = "SELECT * from StaffAcademicDetails WHERE Id= $id ";
   $sql = "SELECT * from StaffAcademicDetails inner join MasterQualification ON StaffAcademicDetails.StandardType=MasterQualification.ID WHERE StaffAcademicDetails.Id= $id ";
                                        
   $res = sqlsrv_query($conntest, $sql);
   while ($data = sqlsrv_fetch_array($res)) { 
      ?>
      <label>Qualification:<span style="color: #223260;"><?php echo "   ".$data['QualificationName'];?></span></label></br>
      <label>Course:<span style="color: #223260;"><?php echo  "   ".$data['Course'];?></span></label>
      <embed class="pdf" 
      src="http://erp.gku.ac.in:86/Images/Staff/AcademicDocument/<?=$data['DocumentPath']?>"
            width="100%" height="600">
      <!-- <img src="http://erp.gku.ac.in:86/Images/Staff/AcademicDocument/<?=$data['DocumentPath']?>" class=" elevation-2" style="width: 100%" alt="Academics Image"> -->
                  <?php

   }
}
else if ($code == 57.1) {
   $id = $_GET['id'];
   $sql = "SELECT * from PHDacademic WHERE id= $id ";
   $res = sqlsrv_query($conntest, $sql);
   while ($data = sqlsrv_fetch_array($res)) { 
       $data['DMC'] ;?>
      <label>TopicofResearch:<span style="color: #223260;"><?php echo "   ".$data['TopicofResearch'];?></span></label></br>
      <label>University:<span style="color: #223260;"><?php echo  "   ".$data['University'];?></span></label><br> 
      <hr>
      <label>Compliance Certificate</label>
      <embed class="pdf" 
      src="http://erp.gku.ac.in:86/Images/Staff/PhDThesis/<?=$data['Uploadcertificate']?>"
            width="100%" height="600">  
        <hr> 
        <label>DMC </label>
        <embed class="pdf" src="http://erp.gku.ac.in:86/Images/Staff/PhDThesis/<?=$data['DMC']?>" width="100%" height="600">
        
        <hr> 
        <label>Degree</label>
        <embed class="pdf" src="http://erp.gku.ac.in:86/Images/Staff/PhDThesis/<?=$data['Degree']?>" width="100%" height="600"> 
            <?php

   }
}
else if ($code == 57.2) {
   $id = $_GET['id'];
   $sql = "SELECT * from AdditionalResponsibilities WHERE ID= $id ";
   $res = sqlsrv_query($conntest, $sql);
   while ($data = sqlsrv_fetch_array($res)) { 
      ?>
      <label>Designation:<span style="color: #223260;"><?php echo "   ".$data['Designation'];?></span></label>
      
      <embed class="pdf" 
      src="http://erp.gku.ac.in:86/Images/Staff/AdditionalResponsibilities/<?=$data['FilePath']?>"
            width="100%" height="600">
      <!-- <img src="http://erp.gku.ac.in:86/Images/Staff/AcademicDocument/<?=$data['FilePath']?>" class=" elevation-2" style="width: 100%" alt="Academics Image"> -->
                  <?php

   }
}
else if ($code == 57.3) {
   $id = $_GET['id'];
   $sql = "SELECT * from AdditionalQualifications WHERE id= $id ";
   $res = sqlsrv_query($conntest, $sql);
   while ($data = sqlsrv_fetch_array($res)) { 
      ?>
      <label>Additional Qualifications Type:<span style="color: #223260;"><?php echo "   ".$data['AdditionalQualificationsType'];?></span></label>
      
      <embed class="pdf" 
      src="http://erp.gku.ac.in:86/Images/Staff/Courses/<?=$data['DocumentPath']?>"
            width="100%" height="600">
      <!-- <img src="http://erp.gku.ac.in:86/Images/Staff/AcademicDocument/<?=$data['DocumentPath']?>" class=" elevation-2" style="width: 100%" alt="Academics Image"> -->
                  <?php

   }
}

else if ($code == 57.4) {
   $id = $_GET['id'];
   
   ?>
    <form id="uploadPhdForm" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="code" value="396.6">
    <input type="hidden" name="IDEmployee" id="IDEmployee" value="<?=$emp_id;?>">
    <input type="hidden" name="idphd" id="idphd" value="<?=$id;?>">
    <label>Course Work DMC</label>
    <input type="file" class="form-control-file" name="coursefile" id="coursefile">
    <small style="color: green">*Document must be in .jpg/.jpeg/.png/.pdf format. &nbsp; *Size must be less than 500kb.</small>
    <br><strong id="coursefileError" style="color: red"></strong><br>
    <label>PhD Degree</label>
    <input type="file" class="form-control-file" name="dmcfile" id="dmcfile">
    <small style="color: green">*Document must be in .jpg/.jpeg/.png/.pdf format. &nbsp; *Size must be less than 500kb.</small>
    <br>
    <strong id="dmcfileError" style="color: red"></strong><br>
    <input type="button" class="btn btn-success btn-xs" onclick="upload_dmc_phd()" value="Upload">
    </form>                                  
<?php 
}
else if ($code == 58) {
   $id = $_GET['id'];
   $sql = "SELECT * from StaffExperienceDetails WHERE Id= $id ";
   $res = sqlsrv_query($conntest, $sql);
   while ($data = sqlsrv_fetch_array($res)) { 
      ?>
      <label>Experience Type:<span style="color: #223260;"><?php echo "   ".$data['ExperienceType'];?></span></label></br>
      <label>Organisation:<span style="color: #223260;"><?php echo  "   ".$data['NameofOrganisation'];?></span></label>
      <!-- <label>Designation:<span style="color: #223260;"><?php echo  "   ".$data['Designation'];?></span></label>
      <label>Date of Joining:<span style="color: #223260;"><?php echo  "   ".$data['NameofOrganisation'];?></span></label>
      <label>Date of Leaving:<span style="color: #223260;"><?php echo  "   ".$data['NameofOrganisation'];?></span></label> -->
      <embed class="pdf" 
      src="http://erp.gku.ac.in:86/Images/Staff/ExperienceDocument/<?=$data['DocumentPath']?>"
            width="100%" height="600">
      <!-- <img src="http://erp.gku.ac.in:86/Images/Staff/ExperienceDocument/<?=$data['DocumentPath']?>" class=" elevation-2" style="width: 100%" alt="Experience Image"> -->
                  <?php

   }
}
else if ($code == 58.1) {
   $id = $_GET['id'];
    $sql = "SELECT * from GeneralLetters WHERE Id= $id ";
   $res = sqlsrv_query($conntest, $sql);
   while ($data = sqlsrv_fetch_array($res)) {  
            ?>
      <label>Letter  Type:<span style="color: #223260;"><?php echo "   ".$data['LetterType'];?></span></label></br>
      <label>Remarks<span style="color: #223260;"><?php echo  "   ".$data['Remarks'];?></span></label>
     
    
      <embed class="pdf" 
      src="http://erp.gku.ac.in:86/Images/Staff/GeneralLetters/<?= $data['FileAttachment'];?>"
            width="100%" height="600">
    
                  <?php

   }
}
else if ($code == 59) {

   $id = $_GET['id'];
   $document = $_GET['document'];
   $sql = "SELECT $document from Staff WHERE IDNo= $id ";
   $res = sqlsrv_query($conntest, $sql);
   while ($data = sqlsrv_fetch_array($res)) { 
      if($document=='PANCardpath')
      {
         ?>
         <embed class="pdf" 
               src=
"http://erp.gku.ac.in:86/Images/Staff/StaffPanCard/<?=$data['PANCardpath']?>"
            width="100%" height="600">
                     <?php
      }elseif($document=='AadharPath')
      {
         ?>
          <embed class="pdf" 
               src="http://erp.gku.ac.in:86/Images/Staff/StaffAadharCard/<?=$data['AadharPath']?>"
            width="100%" height="600">
                     <?php
      }
      elseif($document=='Imagepath')
      {
         ?>
         <embed class="pdf" 
               src="http://erp.gku.ac.in:86/Images/Staff/<?=$data['Imagepath']?>"
            width="100%" height="600">
   
                     <?php
      }
      elseif($document=='Bankpassbookpath')
      {
         ?>
          <embed class="pdf" src="http://erp.gku.ac.in:86/Images/Staff/bankpassbook/<?=$data['Bankpassbookpath']?>"
            width="100%" height="600">
                     <?php
      }
     
   }
}
  elseif ($code==60)
     {
      $College = $_REQUEST['College'];
      $Course = $_REQUEST['Course'];
        $Batch = $_REQUEST['Batch'];
        $Semester = $_REQUEST['Semester'];
       $Type = $_REQUEST['Type'];
          $Group = $_REQUEST['Group'];
          $Examination = $_REQUEST['Examination'];
            
            

$list_sql = "SELECT   ExamForm.Course,ExamForm.ReceiptDate, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type,Admissions.ClassRollNo
FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ORDER BY Admissions.UniRollNo";

  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;

if($list_result === false) {

    // die( print_r( sqlsrv_errors(), true) );
}
?>
<table class="table"><tr>
   <th><input type="checkbox" id="select_all" onclick="selectAll()">
  </th> </th><th>SrNo</th> <th>Uni RollNo / Class RollNo</th>
    <th>Name</th><th>Course</th><th>Sem</th></tr>
   <tr>
   <?php 
        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )

        { 

          $Status= $row['Status'];

          $issueDate=$row['SubmitFormDate'];
                echo "<tr>";
               echo "<td><input type='checkbox' name='check[]' id='check' value='".$row['ID']."' class='checkbox' ></td>";
                echo "<td>".$count++."</td>";
                // echo "<td>".$row['ID']."</td>";
                ?><td>
                 <b> <a href="" onclick="edit_stu(<?= $row['ID'];?>)" style="color:green;text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$row['UniRollNo'];?>/<?=$row['ClassRollNo'];?></a></b>

             </td><td>
                 <b> <a href="" onclick="edit_stu(<?= $row['ID'];?>)" style="color:green;text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$row['StudentName'];?></a></b>

             </td>

                  <?php 
                echo "<td>".$row['Course']."</td>";
                echo "<td>".$row['Semesterid']."</td>";
                  echo "<tr>";


      }


?>
</tr></table>


<?php 


 }

 elseif ($code==61) {

  $College = $_GET['College'];
$Course = $_GET['Course'];
  $Batch = $_GET['Batch'];
  $Semester = $_GET['Semester'];
 $type = $_GET['Type'];
    $Group = $_GET['Group'];
      


 $list_sql = "Select * from MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SemesterID='$Semester' ANd SGroup='$Group'  AND Elective!='O' ";

  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;

if($list_result === false) {

    // die( print_r( sqlsrv_errors(), true) );
}
?>
<table class="table"><tr>
   <th>Select</th><th>SrNo</th> <th>Code</th>
    <th>Subject Name</th></tr>
   
   <?php 
        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )

        {?>

         
             
             <tr>
            
            <td><input type='checkbox' name='subject[]'  id="subjectId" class='newSubject' value='<?= $row['SrNo'];?>'><?= $row['SrNo'];?></td>
             
             <td><?=$count++;?></td>
             
                <td>
                <?=$row['SubjectCode'];?></td>
                  <td><?= $row['SubjectName'];?></td>
             
               
               </tr>




<?php
}?>
<tr> <td colspan="4"><h2> Open Elective</h2></td></tr>

<?php 
//CollegeID!='$College' AND
$list_sql = "Select * from MasterCourseStructure where  Batch='$Batch'ANd SemesterID='$Semester'  AND Elective='O'";

  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;

if($list_result === false) {

    die( print_r( sqlsrv_errors(), true) );
}
?>
<table class="table"><tr>
   <th>Select</th><th>SrNo</th> <th>Code</th>
    <th>Subject Name</th></tr>
   
   <?php 
        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )

        {?>

         
             
             <tr>
            
            <td><input type='checkbox' name='subject[]'  id="subjectId" class='newSubject' value='<?= $row['SrNo'];?>'><?= $row['SrNo'];?></td>
             
             <td><?=$count++;?></td>
             
                <td>
                <?=$row['SubjectCode'];?></td>
                  <td><?= $row['SubjectName'];?></td>
             
               
               </tr>



               

<?php
}




 $getCurrentExamination="SELECT * FROM ExamDate WHERE Type='Department' AND ExamType='$type'";

          $getCurrentExamination_run=sqlsrv_query($conntest,$getCurrentExamination);

          if ($getCurrentExamination_row=sqlsrv_fetch_array($getCurrentExamination_run,SQLSRV_FETCH_ASSOC))
          {
      
       $CurrentExamination=$getCurrentExamination_row['Month'].' '.$getCurrentExamination_row['Year'];
       $CurrentExaminationLastDate=$getCurrentExamination_row['CorrectionDate']->format('Y-m-d');
       $CurrentExaminationType=$getCurrentExamination_row['Type'];
       $CurrentExaminationExamType=$getCurrentExamination_row['ExamType'];

          }

if($CurrentExaminationLastDate >= $CurrentExaminationGetDate && $type==$CurrentExaminationExamType && $CurrentExaminationType=='Department')
   {?>
<tr><td colspan="4" style="text-align: center;"><input type="button" name="add_subject"  onclick="add_subject_examform()" value="Add New Subject" class="btn btn-primary btn-xs"><p style="color:red"> Last Date <?=$CurrentExaminationLastDate;?>
</td></tr>



<?php 
}else
{?>
   <tr><td colspan="4" style="text-align: center;"><input type="button"    value="Date Over" class="btn btn-danger btn-xs"></td></tr>
   <?php 

}?></table>
<?php
 }
 else if($code=='62')
 {
 
 ?>

 <table   class="table table-bordered table-responsive-lg" style='text-align:center;'  >
  <tr>             
  <th><input type="checkbox" id="select_all1" onclick="verifiy_select();" class="form-control"></th>
                 <th>Sr No </th>
                 <th>Uni Roll No</th>
                 <th> Name </th>
                 <th> Father Name </th>
                 <th> Type </th>
                 <th>Total Credit </th>
                 <th> SGPA </th>
                 <th> Verified By </th>
                 <th> Action </th>
      
                 </tr>
  <?php
  $i=1;
  $CourseID = $_GET['course'];
  $CollegeID = $_GET['college'];
  $Batch=$_GET['batch']; 
  $semID = $_GET['sem'];
  $exam = $_GET['examination'];
 $sql1 = "SELECT * FROM ResultPreparation as Rp inner join Admissions as Adm ON Adm.IDNo=Rp.IDNo WHERE Rp.Semester='$semID' and Rp.CourseID='$CourseID' and Rp.CollegeID='$CollegeID'
  and Rp.Examination='$exam' and  Rp.Batch='$Batch' ";
     $stmt = sqlsrv_query($conntest,$sql1);
    if ($stmt === false) {
       $errors = sqlsrv_errors();
       echo "Error: " . print_r($errors, true);  
   } 
         $count=0;
      while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
      {   
         $IDNo=$row['IDNo'];
          if($row['ResultStatus']=='1')
          {
         $clr="success";
          }
          else
          {   
          }
 ?>
 <tr class="bg-<?=$clr;?>">
<td><?php if($row['ResultStatus']=='1'){}else{?><input type="checkbox" class="checkbox v_check" value="<?= $row['Id'];?>"><?php }?></td>
 <td><?= $i++;?></td>
 <td style="text-align: center" data-toggle="modal" data-target="#ViewResult" onclick="ViewResultStudent(<?= $row['Id'];?>);"> <?=$row['UniRollNo'];?></td>
 <td><?= $row['StudentName'];?>=<?= $row['Id'];?></td>             
 <td><?= $row['FatherName'];?></td>             
 <td><?= $row['Type'];?></td>             
 <td><?=$row['TotalCredit'];?></td>
 <td><?=$row['Sgpa'];?></td>
 <td><?=$row['VerifiedBy'];?></td>
 <td><button class="btn btn-danger"  onclick="deleteResultOne(<?= $row['Id'];?>,<?= $row['IDNo'];?>);"><i class="fa fa-trash"></i></button></td>
</tr>
 <?php 
 $clr="";
 } 
 ?>
 <tr>
   <td colspan="6"></td>
   <td colspan="1">
   <label for="">ResultNo</label>
   <input   type="text" placeholder="Result No" id="resultNum"  class="form-control"  >
   </td>
   <td colspan="1">
   <label for="">Declare Date</label>   
   <input   type="date" id="decDate"  class="form-control"  ></td>
   <td colspan="1">
   <label for="">&nbsp;</label>  <br>    
   <input   type="submit" name="submit" value="Publish" onclick="publishResult();" class="btn btn-success "  ></td>
 </tr>
 </table>
 <?php 
 }
 else if($code=='63')
 {
 
 ?>

 <table   class="table table-bordered table-responsive-lg" style='text-align:center;'  >
  <tr>             
                 <th>Sr No </th>
                 <th>College Name</th>
                 <th>Course Name</th>
                 <th>Semester</th>
                 <th>Batch</th>
                 <th>Type </th>
                 <th>SGroup</th>
                  <th>Examination</th>
                  <th>Result No</th>
                  <th>Declare Date</th>
                  <th>Publish Date</th>
                  <th>Publish By</th>
                  <th>Action</th>
                 </tr>
  <?php
  $i=1;
  $CourseID = $_GET['course'];
  $CollegeID = $_GET['college'];
  $Batch=$_GET['batch']; 
  $semID = $_GET['sem'];
  $exam = $_GET['examination'];
  $group = $_GET['group'];
  $type = $_GET['type'];
  

 $sql1 = "SELECT * from ResultDeclared WHERE 1=1";
 
 if($semID!='')
 {
 $sql1 .= " and Semester='$semID'";
 }
 if($CourseID!='')
 {
 $sql1 .= "and CourseID='$CourseID'";
 }
 if($CollegeID!='')
 {
 $sql1 .= "and CollegeID='$CollegeID'";
 }
 if($exam!='')
 {
 $sql1 .= "and Examination='$exam'";
 }
 if($Batch!='')
 {
 $sql1 .= " and  Batch='$Batch'";
 }
 if($group!='')
 {
 $sql1 .= "and SGroup='$group'";
 }
 if($type!='')
 {
 $sql1 .= " and Type='$type' ";
 }


     $stmt = sqlsrv_query($conntest,$sql1);
    if ($stmt === false) {
       $errors = sqlsrv_errors();
       echo "Error: " . print_r($errors, true);  
   } 
         $count=0;
      while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
      {   
         $get_colege_College_name="SELECT * FROM MasterCourseCodes where CollegeID='".$row['CollegeID']."'";
         $get_colege_College_name_run=sqlsrv_query($conntest,$get_colege_College_name);
         if ($row_collegeCollege_name=sqlsrv_fetch_array($get_colege_College_name_run)) {
             $CollegeName=$row_collegeCollege_name['CollegeName'];
         }
         $get_colege_course_name="SELECT * FROM MasterCourseCodes where CourseID='".$row['CourseID']."'";
         $get_colege_course_name_run=sqlsrv_query($conntest,$get_colege_course_name);
         if ($row_collegecourse_name=sqlsrv_fetch_array($get_colege_course_name_run)) {
             $Course=$row_collegecourse_name['CollegeName'];
         }

 ?>
 <tr>
 <td><?= $i++;?></td>
 <td><?= $CollegeName;?></td>             
 <td><?= $Course;?></td>             
 <td><?= $row['Semester'];?></td>             
 <td><?= $row['Batch'];?></td>             
 <td><?= $row['Type'];?></td>             
 <td><?=$row['SGroup'];?></td>
 <td><?=$row['Examination'];?></td>
 <td><?=$row['ResultNo'];?></td>
 <td><?=$row['DeclareDate']->format('d-m-Y');?></td>
 <td><?=$row['PublishDate']->format('d-m-Y');?></td>
 <td><?=$row['PublishBy'];?>
   <input type="hidden" id="CollegeID<?=$row['Id'];?>" value="<?= $row['CollegeID'];?>">
   <input type="hidden" id="CourseID<?=$row['Id'];?>" value="<?= $row['CourseID'];?>">
   <input type="hidden" id="Semester<?=$row['Id'];?>" value="<?= $row['Semester'];?>">
   <input type="hidden" id="Batch<?=$row['Id'];?>" value="<?= $row['Batch'];?>">
   <input type="hidden" id="Type<?=$row['Id'];?>" value="<?= $row['Type'];?>">
   <input type="hidden" id="SGroup<?=$row['Id'];?>" value="<?= $row['SGroup'];?>">
   <input type="hidden" id="Examination<?=$row['Id'];?>" value="<?= $row['Examination'];?>">
   <input type="hidden" id="ResultNo<?=$row['Id'];?>" value="<?= $row['ResultNo'];?>">
</td>
 <td> <button class="btn btn-success btn-sm " onclick="exportCutListExcelgraden(<?=$row['Id'];?>)">Geade Sheet </button></td>
</tr>
 <?php 
 $clr="";
 } 
 ?>
 
 </table>
 <?php 
 }


   elseif ($code==65)
     {
$College = $_GET['College'];

  $Batch = $_GET['Batch'];
  

 $list_sql = "SELECT   * FROM  Admissions  where CollegeID='$College' AND Batch='$Batch' AND AdmissionType>0  ORDER BY Admissions.IDNo ASC";

  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;

if($list_result === false) {

    // die( print_r( sqlsrv_errors(), true) );
}
?>
<table class="table"><tr>
   <th><input type="checkbox" id="select_all" onclick="selectAll()"></th>
   <th>SrNo</th> 
   <th>RollNo</th>
   <th>Name</th>
   <th>Course</th>
</tr>
   <tr>
   <?php 
        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )

        { 

          $Status= $row['Status'];
 
          $issueDate=$row['AdmissionDate'];
                echo "<tr>";
               echo "<td><input type='checkbox' name='check[]' id='check' value='".$row['IDNo']."' class='checkbox' ></td>";
                echo "<td>".$count++."</td>";
                echo "<td>".$row['ClassRollNo']."</td>";
               
                ?><td>
                 <b> <?=$row['StudentName'];?></b>

             </td>
             <td>
                 <b> <?=$row['Course'];?></b>

             </td>

                  <?php 
               
                echo "<td></td>";
                  echo "<tr>";


}   


?>
</tr></table>


<?php 


 }
 else if($code==65.1)
{


 $allow=0;
 $course = $_GET['course'];
 $CourseID = $_GET['courseid'];
 $CollegeID = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
 $group = $_GET['group'];
 $cgroup = $_GET['cgroup'];
 $section = $_GET['section'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subjectcode'];
 $subject = $_GET['subject'];
 $exam = $_GET['examination'];
 $OrderBy = $_GET['OrderBy'];
 $lecturenumber = $_GET['lecturenumber'];
 $date = $_GET['date'];
?>

<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="6" style="text-align: center;"></td></tr>
   

 <?php if($semID==1) {$ext="<sup>st</sup>"; } elseif($semID==2){ $ext="<sup>nd</sup>";}
  elseif($semID==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$course."(<b>".$batch."</b>)";?></td><td  style="text-align:left;"><b>Semester :<b><?=$sem.$ext;?><b><td><?= $subject;?>(<?= $subjectcode;?>)</td><td><?= $section;?>(<?= $cgroup;?>)</td>




     </td>
<input type="hidden" value="<?= $lecturenumber;?>" id="lecturenumber">
<input type="hidden" value="<?= $subjectcode;?>" id="subjectcode">
<input type="hidden" value="<?=$semID;?>" id="semester">
<input type="hidden" value="<?= $section;?>" id='section'>

<input type="hidden"  id="cgroup" value="<?= $cgroup;?>">

<input type="hidden" value="<?= $exam;?>" id="examination">

<input type="hidden"  id="date" value="<?= $date;?>"> 
<input type="hidden"  id="Batch" value="<?= $Batch;?>"> 
 </tr>
</table>



<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="text-align: center;"> Sr No </th>
                <th  style="text-align:center">Roll No</th>
                                                
                      
                       <th style="text-align: center;"> Name </th>
            
                   <th style="text-align: center;">Attendance<br> <span><input type="checkbox"  id="select_all" onclick="selectAll()"></span></th>
                 
                  <th style="text-align: center;">Marked By </th>
                      
                </tr>
 <?php
 $i='1';
 if($cgroup!='')
{
 $sql1="Select  a.IDNo,StudentName,UniRollNo,ClassRollNo from ExamForm as ef inner join ExamFormSubject as efs on ef.Id=efs.ExamId 
 inner join Admissions as a on ef.IDNo=a.IDNo  where ef.CollegeID='$CollegeID' and ef.CourseID='$CourseID'
and ef.Semesterid='$semID' and ef.Batch='$Batch' and ef.Status=8 AND SGroup='$group'
    and SubjectCode='$subjectcode' and ef.Examination='$exam' AND a.Section='$section' AND a.ClassGroup='$cgroup'
      ANd  a.Status='1' AND  efs.ExternalExam='Y' order by $OrderBy";

}
else
{
   $sql1="Select  a.IDNo,StudentName,UniRollNo,ClassRollNo from ExamForm as ef inner join ExamFormSubject as efs on ef.Id=efs.ExamId 
 inner join Admissions as a on ef.IDNo=a.IDNo  where ef.CollegeID='$CollegeID' and ef.CourseID='$CourseID'
and ef.Semesterid='$semID' and ef.Batch='$Batch' and ef.Status=8 AND SGroup='$group'
    and SubjectCode='$subjectcode' and ef.Examination='$exam' AND a.Section='$section' 
      ANd  a.Status='1' AND  efs.ExternalExam='Y' order by $OrderBy";
}

$stmt2 = sqlsrv_query($conntest,$sql1);
  
  $count=0;

while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )

{
$IDNo=$row['IDNo'];
$sqlatt="Select Attendance from StudentAttendance where Semester='$semID'  ANd IDNo ='$IDNo' ANd LectureNumber='$lecturenumber' AND SubjectCode='$subjectcode' ANd Section='$section' ANd ClassGroup='$cgroup' AND  Date='$todaydate' ";
      $stmtatt = sqlsrv_query($conntest,$sqlatt);
  
if($rowatt = sqlsrv_fetch_array($stmtatt, SQLSRV_FETCH_ASSOC) )

{
   $st=$rowatt['Attendance'];
}
else
{
  $st='' ;
}
if($st=='1')
{
$value='Checked';
}  
else
{
 $value='';
 }              
?>
<tr>
<td style="text-align: center"><?= $i++;?></td>
<td style="text-align: center"><input type='checkbox' name='check[]' id='check' value='<?=$row['IDNo'];?>' class='checkbox_s' checked  hidden>
   <?php if($OrderBy=='ClassRollNo'){

 echo $row['ClassRollNo'];

   }else{

echo $row['UniRollNo']; 

   }

?>
 
                                          
 <td><?= $row['StudentName'];?></td>
                           <td style='text-align:center'>  
   <input type="checkbox" required="" name="att[]"  id='check' value='1' class='checkbox' <?=$value;?>></td>

                              <td style='text-align:center;'>



                        
                               <!-- <i class="fa fa-lock text-danger" onclick="unlock();" ></i> -->

                                

                        </td> </tr>

<?php 

}
  $flag=$i-1; 

?>
<input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'>




<tr>
<td style="text-align:right" colspan="6"><p style="text-align: right"><input   type="submit" name="submit" value="Update Attendance" onclick="UpdateAttendance();" class="btn btn-danger "  ></td></tr>
   </table>
<?php 




}

  elseif ($code==66) {

  $College = $_GET['College'];
//$Course = $_GET['Course'];
  $Batch = $_GET['Batch'];

 $list_sql = "Select * from MasterCourseStructure where  Batch='$Batch' ANd SemesterID='0'";

  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;

if($list_result === false) {

    // die( print_r( sqlsrv_errors(), true) );
}
?>
<table class="table"><tr>
   <th>Select</th><th>SrNo</th> <th>Code</th>
    <th>Subject Name</th></tr>
   
   <?php 
        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )

        {?>

         
             
             <tr>
            
            <td><input type='checkbox' name='subject[]'  id="subjectId" class='newSubject' value='<?= $row['SubjectCode'];?>'></td>
             
             <td><?=$count++;?></td>
             
                <td>
                <?=$row['SubjectCode'];?></td>
                  <td><?= $row['SubjectName'];?></td>
             
               
               </tr>




<?php
}?>


<tr><td colspan="4" style="text-align: center;"><input type="button" name="add_subject"  onclick="add_subject_prerequite()" value="Pre Requiste" class="btn btn-primary btn-xs"></td></tr>
</table>


<?php 


 }

 else if($code==67)
{


 $allow=0;
 $ucourse = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $sem = $_GET['sem'];
 $subject = $_GET['subject'];
 $group = $_GET['group'];
 $ecat = $_GET['DistributionTheory'];
 $start=0;

 
?>
<!-- <form action="post_action.php" method="post"> -->


<table  class="table table-striped "  style="border: 2px solid black;  ">  

 <tr><td colspan="5" style="text-align: center;"></td></tr>
   

 <?php if($sem==1) {$ext="<sup>st</sup>"; } elseif($sem==2){ $ext="<sup>nd</sup>";}
  elseif($sem==3) {$ext="<sup>rd</sup>"; } else { $ext="<sup>th</sup>";}?>



     <tr><td  style="text-align: left;"><b>Course<b></td><td  style="text-align: left;"><?=$ucourse."(<b>".$batch."</b>)";?></td><td></td><td  style="text-align:left;"><b>Semester<b></td><td  style="text-align: center;"><b><?=$sem.$ext;?>(<?= $subject;?>)<b>




     </td>

<input type="hidden" value="<?= $batch;?>" name="batch">
<input type="hidden" value="<?= $ucourse;?>" name="course">

<input type="hidden" value="<?=$sem;?>" name="sem">
<input type="hidden" value="11" name="code">
<input type="hidden" name="ecat" id="ecat" value="<?= $ecat;?>"> 


     </tr>

 
              </table>

<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 
                  <th style="width:25px;text-align: left;"> Sr No </th>
                <th  style="width:25px;text-align:left">Uni Roll No</th>
                                                
                      
                       <th style="width:25px;text-align: left;"> Name </th>
                         <th style="width:50px;text-align: left;"> Subject </th>
                   <th style="width:25px;text-align: left;">Marks </th>
                    
                        <th style="width:25px;text-align: left;">TotalMarks </th>
                    <th style="width:25px;text-align: left;">Updated By </th>
                     <th style="width:25px;text-align: left;">Updated On </th>
                   
                  <th style="width:25px;text-align: center;">Lock Status </th>
                      
                </tr>
 <?php
 $i='1';



 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['DistributionTheory'];
 $exam = $_GET['examination'];
  $group = $_GET['group'];

 $sql1 = "{ CALL USP_Get_studentbyCollegeInternalMarksDistributionPractical('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory','$group')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

        $count=0;

     while($row = sqlsrv_fetch_array($stmt)){

 //$declare= $row['11'];

//print_r($row);



               
                  
?>
<tr>
<td><?= $i++;?><input type="hidden" name="ids[]" value="<?= $row['id'];?>"  id="ids" class='IdNos'> </td>
<td style="text-align: left"> <?=$row['UniRollNo'];?>/<?=$row['ClassRollNo'];?></td>
<td>  <input type="hidden" name="name[]" value="<?=$row['StudentName'];?>"> <?= $row['StudentName'];?></td>  




                                            
               <td>
                  <?= $row['SubjectName'];?>/<?= $subject;?>
             <?php   $iidd=$row['id'];?></td>


<?php

$getdistri="Select Id from DDL_TheroyExamination where Value='PracticalNO'" ;
$list_resultdi = sqlsrv_query($conntest,$getdistri);
      
        while( $rowdi = sqlsrv_fetch_array($list_resultdi, SQLSRV_FETCH_ASSOC) )
        {  
            $did=$rowdi['Id'];
        }





     $exam_type=$DistributionTheory;

   $list_sqlw5 ="SELECT * from DDL_TheroyExaminationSemester  as DTES inner join DDL_TheroyExamination as DTE  ON DTE.id=DTES.DDL_TE_ID   Where  DDL_TE_ID='$did' ANd Semesterid='$semID' order by DTES.SemesterId  ASC";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);

        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
            $todaydate=date('d-m-Y');
            $endDate=$row5['EndDate']->format('d-m-Y');
         
              if (strtotime($endDate)<strtotime($todaydate)) 
              {
              $dateover=1;
              $show="<b style='color:red;'>Date Over</b>";

              }
              else
              {
               $dateover=0;
               $show="";
              }
              ?>
              
      <?php     
         }
         ?>

<td>

   <select  name="emst[]"  id='emarks_<?=$iidd;?>' class='emarks' onchange="savepmarks(<?=$iidd;?>)" >
       <option value="<?=$row['experiment'];?>"><?=$row['experiment'];?></option>





<?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['experiment']!='')
{
   ?>
    <option value="<?=$row['experiment'];?>"><?=$row['experiment'];?></option>

<?php
}

  


   }
   else
   {
   if($row['experiment']!='')
{
   ?>
    <option value="<?=$row['experiment'];?>"><?=$row['experiment'];?></option>

<?php
}
?>



 <option value="">Select</option>
  
        <?php 

for($j=$start;$j<=25;$j++)
{?>
     <option value='<?=$j;?>'><?=$j;?></option>

 <?php 
}
}
?>
</select>
</td>









                           <td style='text-align:left;width:50px'>  


<!--onchange="savemarks(<?=$iidd;?>)" -->



<input type='text' name="mst[]"  id='marks_<?=$iidd;?>' class='marks' value='<?=$row['intmarks'];?>' readonly style="width: 50px;" >


<?php 

 if($row['Locked']>0||$dateover>0)
  {
                               
   if($row['intmarks']!='')
{
   ?>
    

<?php
}

  


   }

if($dateover>0)
{
   echo $show;
}
?>



                           </td>

                           <td><?=$row['updateby'];?></td>
                           <td><?php 
                           If($row['updatedDate']!=''){ echo $row['updatedDate']->format('Y-m-d H:i:s');
                        }?></td>
                            
                            


                              <td style='text-align:center;width: 30px'>


                            <?php


                            if($row['Locked']>0)
                            {
                               
                               ?>
                               <i class="fa fa-lock text-danger" ></i>
                                <!--<i class="fa fa-lock text-danger" onclick="unlock(<?=$row['id'];?>);" ></i>-->

                                <?php 


                     }
                           else {

                           ?>
                               <!-- <i class="fa fa-lock-open text-success" onclick="lock(<?=$row['id'];?>);"></i> -->
                                <i class="fa fa-lock-open text-success" ></i>
                                <?php 
                           
                        }
                           ?>

                        </td> </tr>

<?php 

}
  $flag=$i-1;

?>
<input type="hidden" value="<?=$flag;?>" readonly="" class="form-control" name='flag'>

</table>
<p style="text-align: right"><input   type="submit" name="submit" value="Lock" onclick="testing();" class="btn btn-danger "  >
<?php 
}

else if ($code == 68) {
   $id = $_GET['id'];
   $sql = "SELECT MOOCattachment from ExamFormSubject WHERE id= $id ";
   $res = sqlsrv_query($conntest, $sql);
   while ($data = sqlsrv_fetch_array($res)) { 
      ?>
      <label>MOOC Attachment:<span style="color: #223260;"></span>

   </label>
      
      <embed class="pdf" 
      src="http://erp.gku.ac.in:86/StdWorkshopFile/<?=$data['MOOCattachment']?>"
            width="100%" height="600">
      <!-- <img src="http://erp.gku.ac.in:86/Images/Staff/AcademicDocument/<?=$data['DocumentPath']?>" class=" elevation-2" style="width: 100%" alt="Academics Image"> -->
                  <?php

   }

}

 else
       {
   
       }
   
        ?>
