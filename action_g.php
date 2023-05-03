<?php
   session_start();
   
   ini_set('max_execution_time', '0');
      if(!(ISSET($_SESSION['usr']))) 
      {
   ?>
<script> window.location.href = 'index.php'; </script> 
<?php
   }
   else
   {
   date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
   $timeStamp=date('Y-m-d H-i-s');
   $EmployeeID=$_SESSION['usr'];
   if ($EmployeeID==0 || $EmployeeID=='') 
      {?>
<script type="text/javascript">
   window.location.href="index.php";
</script>
<?php }
   include "connection/connection.php";
   
   $code = $_POST['code'];
   
   if($code=='1')
   {
       $count=0;
       $building=$_POST['building'];
       $floor=$_POST['floor'];
       $room=$_POST['room'];
      $location_num=0;
                           
        if ($building=='' && $floor=='' && $room=='') 
       {
   
         $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID ";
   
         
       }
       elseif ($building=='' && $floor=='' && $room!='') 
       {
          $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where  l.RoomNo='$room'";
       }
       elseif ($building=='' && $floor!='' && $room=='') 
       {
        $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.IDpe  where l.Floor='$floor'";
       }
       elseif ($building=='' && $floor!='' && $room!='') 
       {
          $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where l.Floor='$floor' and l.RoomNo='$room'";
       }
       elseif ($building!='' && $floor=='' && $room=='') 
       {
        $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where Block='$building'";
       }
       elseif ($building!='' && $floor=='' && $room!='') 
       {
        $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where Block='$building' and l.RoomNo='$room'";
       }
       elseif ($building!='' && $floor!='' && $room=='') 
       {
          $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where Block='$building'  and l.Floor='$floor'";
       }
       elseif ($building!='' && $floor!='' && $room!='') 
       {
           $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID where Block='$building' and l.RoomNo='$room' and l.Floor='$floor'";   
       }
                         
   
                           $location_run=mysqli_query($conn,$location);
                           ?>
<table class="table table-head-fixed text-nowrap table-bordered" id="example">
   <thead>
      <tr>
         <th><input type="checkbox" id="select_all1" onclick="verifiy_select();" class="form-control"></th>
         <th>ID</th>
         <th>Block</th>
         <th>Floor</th>
         <th>Room Type/No</th>
         <th>Owner Name</th>
      </tr>
   </thead>
   <tbody  >
      <?php
         while ($location_row=mysqli_fetch_array($location_run)) 
         {
         $location_num=$location_num+1;?>
      <tr>
         <td><input type="checkbox" class="checkbox v_check" value="<?=$location_row['l_id'];?>"></td>
         <td><?=$location_num;?></td>
         <td><?=$location_row['Name'];?>(<?=$location_row['l_id'];?>)</td>
         <td><?=$location_row['FloorName'];?></td>
         <td><?=$location_row['RoomType'];?>-<?=$location_row['RoomNo'];?> <b>(<?=$location_row['RoomName'];?>)</b></td>
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
      </tr>
      <?php 
         }
         ?>
   </tbody>
</table>
<?php
   }
   elseif($code==2)
   {
   
      $id=$_POST['id'];
      $groupname=$_POST['groupname'];
   if($_POST['subjectIDs'] == "")
   {
   $per = 0;
   }
   else
   {
   $per = implode(",",$_POST['subjectIDs']);
   }
   if ($id==0) 
         {
   
        $verified_study="INSERT into group_master (GroupName,LocationID) values('$groupname','$per')";
         $verified_study_run=mysqli_query($conn,$verified_study); 
        }
      else
      {
       $verified_study="UPDATE  group_master SET LocationID=CONCAT(LocationID,',$per') where Id='$groupname'";
         $verified_study_run=mysqli_query($conn,$verified_study); 
         } 
          if ($verified_study_run==true)
           {
      echo "1";
   }
   else
   {
      echo "0";
   }
   }
    elseif($code==3)
   {?>
<table class="table table-head-fixed text-nowrap table-bordered" id="example">
   <thead>
      <tr>
         <th>ID</th>
         <th>Block</th>
         <th>Floor</th>
         <th>Room Type/No</th>
         <th>Owner Name</th>
      </tr>
   </thead>
   <tbody  >
      <?php
         $count=0;
         $building=$_POST['id'];
         $get_locations="SELECT LocationID FROM group_master where Id='$building'";
         $get_locations_run=mysqli_query($conn,$get_locations);
         while($r=mysqli_fetch_array($get_locations_run))
         {
         $ids=$r['LocationID'];
         }
         
         $location_num=0;
                             
          $ids=explode(',',$ids);
          $ids=array_unique($ids);
          foreach ($ids as $key => $value) {
            
          $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where l.ID='$value'";
                           
         
                             $location_run=mysqli_query($conn,$location);
                             ?>
      <?php
         while ($location_row=mysqli_fetch_array($location_run)) 
         {
         $location_num=$location_num+1;?>
      <tr>
         <td><?=$location_num;?></td>
         <td><?=$location_row['Name'];?>(<?=$location_row['l_id'];?>)</td>
         <td><?=$location_row['FloorName'];?></td>
         <td><?=$location_row['RoomType'];?>-<?=$location_row['RoomNo'];?> <b>(<?=$location_row['RoomName'];?>)</b></td>
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
      </tr>
      <?php 
         }
         }
         ?>
   </tbody>
</table>
<?php
   }
   elseif($code==4)
   {
   $id=$_POST['id'];
   $delte="DELETE FROM `group_master` WHERE Id='$id'";
   $delt_run=mysqli_query($conn,$delte);
   if ($delt_run==true) 
   {
   echo "1";   // code...
   }
   else
   {
   echo "0";
   }
   }
   elseif($code==5)
   {?>
<table class="table" id="">
   <thead>
      <tr>
         <th>#</th>
         <th>Name</th>
         <th>Action</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php 
         $sr=1;
         $get_group="SELECT * FROM group_master";
         $get_group_run=mysqli_query($conn,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {?>
      <tr>
         <th><?=$sr;?></th>
         <th data-toggle="modal" onclick="modal_khali(<?=$row['Id'];?>);" data-target="#exampleModalCenter" ><b><?=$row['GroupName'];?></b></th>
         <th><i class="fa fa-eye" onclick="show_group_member(<?=$row['Id'];?>);"></i></th>
         <th><i class="fa fa-trash" onclick="group_delete(<?=$row['Id'];?>);"></i></th>
      </tr>
      <?php
         $sr++; }
           ?>
   </tbody>
</table>
<?php
   }
   elseif($code==6)
   {
      $id=$_POST['id'];
      $location_ID=$_POST['location_ID'];
      $ArticleCode=$_POST['ArticleCode'];
      $In="INSERT into  multiple_owners(UserId,ArticleCode) values('$id','$ArticleCode')"; 
      $in_run=mysqli_query($conn,$In);
      $In1="UPDATE stock_summary SET multiowner='1' where IDNo='$ArticleCode'"; 
      $in_run1=mysqli_query($conn,$In1);
   } 
   elseif($code==7)
   {
      $id=$_POST['id'];
      
      $In="SELECT * FROM  multiple_owners  WHERE ArticleCode='$id'"; 
      $in_run=mysqli_query($conn,$In);
      while($row=mysqli_fetch_array($in_run))
      {
         ?>
         <tr>
            <td>
<?=$empID=$row['UserId'];?>
</td>
<td>
<?=$row['ArticleCode'];?>
</td> <td><?php 
       $staff="SELECT * FROM Staff Where IDNo='$empID'";
       $stmt = sqlsrv_query($conntest,$staff);  
       if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
       {
           $jobStatus=$row_staff['JobStatus'];
           if ($jobStatus=='1') 
           {
               echo "<b>".$Emp_Name=$row_staff['Name'];
           }
           else
           {
               echo "<b>Can not assign to ".$empID;
           }
           // $array[]=$row_staff;
       }
       ?>
      </td>
      <th><i class="fa fa-trash" onclick="owner_delete(<?=$empID;?>,<?=$row['ArticleCode'];?>);"></i></th>
<?php       }

   }
   else if ($code==8) 
   {
      $empID=$_POST['id'];
       $staff="SELECT * FROM Staff Where IDNo='$empID'";
       $stmt = sqlsrv_query($conntest,$staff);  
       if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
       {
           $jobStatus=$row_staff['JobStatus'];
           if ($jobStatus=='1') 
           {
               echo "<b>".$Emp_Name=$row_staff['Name'];
           }
           else
           {
               echo "<b>Can not assign to ".$empID;
           }
           $array[]=$row_staff;
       }
   //print_r($array);
   }
    elseif($code==9)
   {
   $id=$_POST['id'];
   $articleID=$_POST['articleID'];
   $delte="DELETE FROM `multiple_owners` WHERE UserId='$id' and ArticleCode='$articleID'";
   $delt_run=mysqli_query($conn,$delte);
   if ($delt_run==true) {
      // code...
   
   $chek="SELECT * FROM multiple_owners where ArticleCode='$articleID' ";
   $chek_run=mysqli_query($conn,$chek);
    $co=mysqli_num_rows($chek_run);
while($rr=mysqli_fetch_array($chek_run))
{
if ($co>0) 
{
$updateQry="UPDATE stock_summary SET  Corrent_owner='".$rr['UserId']."' WHERE  IDNo='$articleID'";
               mysqli_query($conn,$updateQry);
}
}
if ($co<1) {
   // code...
   $updateQry="UPDATE stock_summary SET  Corrent_owner='' WHERE IDNo='$articleID'";
               mysqli_query($conn,$updateQry);
}

 if ($delt_run==true) 
   {
   echo "1";   // code...
   }
   else
   {
   echo "0";
   }

}
else
{

}
  
   }
   else
   {
   
   }
   }
   ?>