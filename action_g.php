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
          $sql="SELECT * FROM stock_summary  where IDNo='$ArticleCode'";
    $result = mysqli_query($conn,$sql);
    $date=date('Y-m-d');
    while($data=mysqli_fetch_array($result))
    {
       $currentOwner=$data['Corrent_owner'];
       $currentLocation=$data['LocationID'];
       $deviceSerialNo=$data['DeviceSerialNo'];
       $workingStatus=$data['WorkingStatus'];
       $referenceNo=$data['reference_no'];
       $Direction='Owner Add:'.$id;
       $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', '$Direction', '$currentLocation', '$id', 'Add multiowner', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
       mysqli_query($conn,$qry);
    }
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
            $sql="SELECT * FROM stock_summary  where IDNo='$articleID'";
    $result = mysqli_query($conn,$sql);
    $date=date('Y-m-d');
    while($data=mysqli_fetch_array($result))
    {
       $currentOwner=$data['Corrent_owner'];
       $currentLocation=$data['LocationID'];
       $deviceSerialNo=$data['DeviceSerialNo'];
       $workingStatus=$data['WorkingStatus'];
       $referenceNo=$data['reference_no'];
       $Direction='Owner Remove:'.$id;
       $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', '$Direction', '$currentLocation', '$id', 'Remove multiowner:', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
       mysqli_query($conn,$qry);
    }

   if ($delt_run==true) 
   {
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
      if ($co<1)
       {
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
   elseif($code==10)
   {
          $dropdown_team="SELECT * FROM Staff WHERE IDNo='$EmployeeID' ";
                   $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                 if($dropdown_row_staff = sqlsrv_fetch_array($dropdown_team_run, SQLSRV_FETCH_ASSOC) )
                 {
                  $LeaveRecommendingAuthority=$dropdown_row_staff['LeaveSanctionAuthority'];
                 }
      $task_name=$_POST['task_name'];
      $task_discription=$_POST['task_discription'];
      $assignTo=$_POST['assignTo'];

      $end_date=$_POST['end_date'];
      $asign_date=date('Y-m-d');
      $get_token="SELECT  *  from task_master order by ID DESC LIMIT 1 ";
      $get_token_run=mysqli_query($conn,$get_token);
      if($row_token=mysqli_fetch_array($get_token_run))
      {
     $token=$row_token['TokenNo']+1;
      }
      else
      {
      $token="2300";
      }
      $insert_task="INSERT INTO `task_master` (`AssignDate`, `CompleteDate`, `EndDate`, `TaskName`, `Description`, `AssignTo`, `AssignBy`,`EmpID`, `ForwardTo`, `Status`, `TokenNo`) VALUES ('$asign_date', '', '$end_date', '$task_name', '$task_discription', '$assignTo', '$LeaveRecommendingAuthority','$EmployeeID', '', '0', '$token');";
      $insert_task=mysqli_query($conn,$insert_task);
      if ($insert_task==true) 
      {
         if ($EmployeeID==$assignTo) 
         {

         }
         else
         {
         $insert_task_copy="INSERT INTO `task_master` (`AssignDate`, `CompleteDate`, `EndDate`, `TaskName`, `Description`, `AssignTo`, `AssignBy`,`EmpID`, `ForwardTo`, `Status`, `TokenNo`) VALUES ('$asign_date', '', '$end_date', '$task_name', '$task_discription', '$assignTo', '$EmployeeID','$assignTo', '', '0', '$token');";
           mysqli_query($conn,$insert_task_copy);
         }
      }
      else
      {

      }
      if ($insert_task==true)
       {
         echo "1";   
       }
      else
       {
         echo "0";
       }


   }
   elseif($code==11)
   {
      ?>    <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Task Name
                      </th>
                      <th style="width: 30%">
                          Assign By
                      </th>
                      <th>
                          Task Progress
                      </th>
                      <th>Marks</th>
                      <th style="width: 8%" class="text-center">
                          Status
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $sr=1;
                $show_task="SELECT * FROM task_master Where EmpID='$EmployeeID' ";
                $show_task_run=mysqli_query($conn,$show_task);
                while ($show_task_row=mysqli_fetch_array($show_task_run))
                 {
                  $marks=$show_task_row['marks'];
                  $t_ID=$show_task_row['ID'];

                   ?>
                  <tr>
                      <td>
                          <?=$sr;?>
                      </td>
                      <td>
                          <a>
                              <?=$show_task_row['TaskName'];?>
                          </a>
                          <br/>
                          <small>
             <?=$show_task_row['AssignDate'];?>

                          </small>
                      </td>
                      <td>

                          <ul class="list-inline"> 
                              <li class="list-inline-item">
                                      <?php

                 $get_emp_details="SELECT Snap,Name FROM Staff Where IDNo='".$show_task_row['AssignBy']."'";
                  $get_emp_details_run=sqlsrv_query($conntest,$get_emp_details);
                  if($row_staff=sqlsrv_fetch_array($get_emp_details_run,SQLSRV_FETCH_ASSOC))
                  {
                  $Emp_Image=$row_staff['Snap'];
                  $emp_pic=base64_encode($Emp_Image);
                  

                                 echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";} ?>
                              </li>
                            
                          </ul> 
            <b> <?=$row_staff['Name'];?></b>
             (<?=$show_task_row['AssignBy'];?>)
             

                      </td>
                      <td class="project_progress">
                              <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?=$show_task_row['task_percentage'];?>">
                              </div>
                          </div>
                          <small>
                              <?=$show_task_row['task_percentage'];?> Complete
                          </small>
                      </td>
                      <td>
                            
                         <?php if ($marks!='')
                   {
                     echo $marks;
                  }else{ echo "NA";}?>
                      </td>
                      <td class="project-state">
                            <?php 
                        $status_up="SELECT * FROM task_master Where ID='$t_ID'";
                        $status_up_run=mysqli_query($conn,$status_up);
                        if($status_show=mysqli_fetch_array($status_up_run))
                        {
                           $t_token=$status_show['TokenNo'];
                               if ($status_show['Status']==0) {

                              $status="Pending";
                              $status_color="danger";
                           }
                           elseif ($status_show['Status']==1) {
                              $status="Under Process";
                              $status_color="primary";
                              
                           }
                           elseif($status_show['Status']==2)
                           {
                              $status="Forwarded";
                              $status_color="warning";

                           }
                           elseif($status_show['Status']==3)
                           {
                              $status="Complete";
                              $status_color="success";

                           }
                          ?>
                          <span class="badge badge-<?=$status_color;?>"><?=$status;?></span>
                       <?php }?>
                      </td>
                      <td class="project-actions text-right">
                        
                          <a class="btn btn-success btn-sm" onclick="task_timeline(<?=$t_token;?>);" data-toggle="modal" data-target="#ViewTaskModal" href="#">
                              
                             <i class="fa fa-eye fa-lg"></i>
                          </a>
                           <?php  if ($status_show['Status']!=3)
                            {
                          ?>
                          <a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#ForwardTaskModal" onclick="forward_set_id(<?=$t_token;?>);" > 
                              <i class="fa fa-share" aria-hidden="true"></i>
                          </a>
                         <?php 
                          }
                         ?>
                          <!-- <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a> -->
                      </td>
                  </tr>
                <?php
                $sr++;
                 }?>
              </tbody>
          </table><?php 
   }
   elseif($code==12)
   {
      ?>    <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Task Name
                      </th>
                      <th style="width: 30%">
                          Assign To
                      </th>
                      <th>
                          Task Progress
                      </th><th>
                          Marks
                      </th>
                      <th style="width: 8%" class="text-center">
                          Status
                      </th>
                      <th style="width: 20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $sr=1;
                $show_task="SELECT * FROM task_master Where AssignBy='$EmployeeID'  ";
                $show_task_run=mysqli_query($conn,$show_task);
                while ($show_task_row=mysqli_fetch_array($show_task_run))
                 {
                  $t_ID=$show_task_row['ID'];
                   $marks=$show_task_row['marks'];
                  $TokenNo=$show_task_row['TokenNo'];
                   ?>
                  <tr>
                      <td>
                          <?=$sr;?>
                      </td>
                      <td>
                          <a>
                              <?=$show_task_row['TaskName'];?>
                          </a>
                          <br/>
                          <small>
             <?=$show_task_row['AssignDate'];?>

                          </small>
                      </td>
                      <td>

                          <ul class="list-inline"> 

                           <?php  
                           $show_task_="SELECT DISTINCT AssignTo FROM task_master Where TokenNo='$TokenNo' and AssignTo!='$EmployeeID'  ";
                $show_task_run_=mysqli_query($conn,$show_task_);
                while ($show_task_row_=mysqli_fetch_array($show_task_run_))
                 {
                  $AssignTo=$show_task_row_['AssignTo'];

                  ?>
                             <li class="list-inline-item" style="">
                                  <?php

                 $get_emp_details="SELECT Snap,Name FROM Staff Where IDNo='$AssignTo'";
                  $get_emp_details_run=sqlsrv_query($conntest,$get_emp_details);
                  if($row_staff=sqlsrv_fetch_array($get_emp_details_run,SQLSRV_FETCH_ASSOC))
                  {
                  $Emp_Image=$row_staff['Snap'];
                  $emp_pic=base64_encode($Emp_Image);
                  

                                 echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
                              } ?>

             <!-- <SMALL> <?=$row_staff['Name'];?></SMALL><BR> -->
                              </li>

             
                           <?php }?>
                          
                           </ul>

                      </td>
                      <td class="project_progress">
                            <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?=$show_task_row['task_percentage'];?>">
                              </div>
                          </div>
                          <small>
                              <?=$show_task_row['task_percentage'];?> Complete
                          </small>
                      </td>
                      <td>
                                <?php if ($marks!='')
                   {
                     echo $marks;
                  }else{ echo "NA";}?>
                         
                      </td>
                      <td class="project-state">
                        <?php 
                        $status_up="SELECT * FROM task_master Where ID='$t_ID'";
                        $status_up_run=mysqli_query($conn,$status_up);
                        if($status_show=mysqli_fetch_array($status_up_run))
                        {
                           $t_token=$status_show['TokenNo'];

                                if ($status_show['Status']==0) {

                              $status="Pending";
                              $status_color="danger";
                           }
                           elseif ($status_show['Status']==1) {
                              $status="Under Process";
                              $status_color="primary";
                              
                           }
                           elseif($status_show['Status']==2)
                           {
                              $status="Forwarded";
                              $status_color="warning";

                           }
                           elseif($status_show['Status']==3)
                           {
                              $status="Complete";
                              $status_color="success";

                           }
                          ?>
                          <span class="badge badge-<?=$status_color;?>"><?=$status;?></span>
                       <?php }?>
                      </td>
                      <td class="project-actions text-right">
                          <a class="btn btn-success btn-sm" onclick="task_timeline(<?=$t_token;?>);" data-toggle="modal" data-target="#ViewTaskModal" href="#">
                              
                              <i class="fa fa-eye fa-lg"></i>
                          </a>
                          <?php  if ($status_show['Status']!=3) {
                             
                          ?>
                          <a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#ForwardTaskModal" onclick="forward_set_id(<?=$t_token;?>);" >
                             
                            <i class="fa fa-share" aria-hidden="true"></i>
                          </a>
                       <?php }?>
                         
                      </td>
                  </tr>
                <?php
                $sr++;
                 }?>
              </tbody>
          </table>
          <?php 
   }
      
      elseif($code==13)
   {
      $token=$_POST['Token_No'];
      $forward_remarks=$_POST['forward_remarks'];
      $assignTo=$_POST['assignTo'];
      $end_date=$_POST['end_date'];
      $asign_date=date('Y-m-d');
      $get_token="SELECT  *  from task_master where TokenNo='$token' LIMIT 1 ";
      $get_token_run=mysqli_query($conn,$get_token);
      while($row_token=mysqli_fetch_array($get_token_run))
      {
     $token=$row_token['TokenNo'];
     $task_name=$row_token['TaskName'];
      $task_discription=$row_token['Description'];
      }
      $update="UPDATE task_master SET AssignTo='$assignTo',Status='2' where EmpID='$EmployeeID' and TokenNo='$token'";
      $up=mysqli_query($conn,$update);
     if ($up==true) 
       {
         if ($assignTo!=$EmployeeID) {
      $insert_task="INSERT INTO `task_master` (`AssignDate`, `CompleteDate`, `EndDate`, `TaskName`, `Description`, `AssignTo`, `AssignBy`,`EmpID`, `ForwardTo`, `Status`, `TokenNo`) VALUES ('$asign_date', '', '$end_date', '$task_name', '$forward_remarks', '$assignTo', '$EmployeeID','$assignTo', '', '0', '$token');";
      $insert_task=mysqli_query($conn,$insert_task);
   }
   else
        {

       }
   }
       
      if ($insert_task==true)
       {
         echo "1";   
       }
      else
       {
         echo "0";
       }


   }
   elseif($code==14){
      $TokenNo=$_POST['Token_No'];
      ?> 
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <!-- <div class="time-label">
                <span class="bg-red">10 Feb. 2014</span>
              </div> -->
              <!-- /.timeline-label -->
              <!-- timeline item -->

              <?php 
                $timeline="SELECT * FROM task_master where TokenNo='$TokenNo'";
                $timeline_run=mysqli_query($conn,$timeline);
                while ($timeline_row=mysqli_fetch_array($timeline_run)) 
                {
                  $marks=$timeline_row['marks'];
                  $T_ID=$timeline_row['ID'];
                  if ($timeline_row['EmpID']==$EmployeeID) 
                  {
                     $Self="(You)";
                  }
                  else
                  {
                     $Self="";
                  }
                  

                ?>
              <div>
                <?php
                if ($timeline_row['Status']==0) 
                {
                  $envolp="danger";
                  $envolp_msg="Pending";
                  $envolp_icon="clock";
                } elseif ($timeline_row['Status']==1) 
                {
                  $envolp="primary";
                  $envolp_msg="Under Process";
                  $envolp_icon="hourglass-start";


                }elseif ($timeline_row['Status']==2) 
                {
                  $envolp="warning";
                  $envolp_msg="Forward";
                  $envolp_icon="share";


                }elseif ($timeline_row['Status']==3) 
                {
                  $envolp="success";
                  $envolp_msg="Complete";
                  $envolp_icon="check-circle";



                }
                $empID=$timeline_row['EmpID'];
                 $get_emp_details="SELECT Name FROM Staff Where IDNo='$empID'";
                  $get_emp_details_run=sqlsrv_query($conntest,$get_emp_details);
                  if($row_staff=sqlsrv_fetch_array($get_emp_details_run,SQLSRV_FETCH_ASSOC))
                  {
                     if ($timeline_row['EmpID']==$EmployeeID) 
                     {
                     $EmpName="";
                     $EmpID_U="";
                    }
                    else
                    {
                  $EmpName=$row_staff['Name'];
                  $EmpID_U='('.$timeline_row['EmpID'].')';
                    }
                  }
                  else
                  {
                     $EmpName="";
                     $EmpID_U="";
                  }
                    $AssignToempID=$timeline_row['AssignTo'];
                 $get_emp_details1="SELECT Name FROM Staff Where IDNo='$AssignToempID'";
                  $get_emp_details_run1=sqlsrv_query($conntest,$get_emp_details1);
                  if($row_staff1=sqlsrv_fetch_array($get_emp_details_run1,SQLSRV_FETCH_ASSOC))
                  {
                     if ($timeline_row['AssignTo']==$timeline_row['EmpID'])
                      {
                        $AssignToempName="";
                     $AssignToempID="";
                    }
                  else
                   {
                  $AssignToempName=" To &nbsp;&nbsp;".$row_staff1['Name'];
                  $AssignToempID="(".$timeline_row['AssignTo'].")";
                    }
                  }
                  else
                  {
                     $AssignToempName="";
                     $AssignToempID="";
                  }
                 ?>
                <i class="fa fa-<?=$envolp_icon;?> bg-<?=$envolp;?>"></i>
                <div class="timeline-item">
                  <span class="time bg-<?=$envolp;?>"><b> <?=$envolp_msg;?></b></span>
                  <h3 class="timeline-header"><b><?=$Self;?> &nbsp;&nbsp;<?=$EmpName;?></b><a ><?=$EmpID_U; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a ><b><?=$AssignToempName;?></b><?=$AssignToempID; ?></a></h3>

                  <div class="timeline-body">
                  <?=$timeline_row['Description'];?> 
                  <h6 style="text-align:right;"><b>Marks:
                  <?php if ($marks!='')
                   {
                     echo $marks;
                  }else{ echo "NA";}?></b> </h6>
               </div>
                  <div class="timeline-footer">
                    <!-- <a class="btn btn-primary btn-sm">Read more</a>
                    <a class="btn btn-danger btn-sm">Delete</a> -->
                    <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?=$timeline_row['task_percentage'];?>">
                              </div>
                          </div>
                          <small>
                              <?=$timeline_row['task_percentage'];?> Complete
                          </small>
                          <div class="row" >
                          <?php  if ( $timeline_row['Status']==3 && $timeline_row['AssignBy']==$EmployeeID && $timeline_row['marks']=='') 
                          {
                             // code...
                            ?>
                             <div class="col-lg-6">
                              <label>Marks</label>
                              <input type="number" placeholder="Marks " id="marks" class="form-control" >
                             </div>
                             <div class="col-lg-6">
                                <label>Remarks</label>
                          <textarea name="" class="form-control" id="remarks" ></textarea>
                             </div>
                             

                              <div class="col-lg-12">
                             <input type="button" value="Submit" onclick="submit_marks(<?=$T_ID;?>)" class="btn btn-primary btn-xs" name="">
                          </div>
                       <?php }?>
                          </div>
                         
                  </div>
                </div>
              </div>
            <?php   }?>
             
              
            </div>
          </div>
          <!-- /.col -->
        </div>
     <?php 
   }
   elseif($code==15)
   {
      $ID=$_POST['ID'];
      $Marks=$_POST['Marks'];
      $Remarks=$_POST['Remarks'];
      $Update_marks="UPDATE task_master SET Remarks='$Remarks',marks='$Marks' where ID='$ID'";
      $Update_marks_run=mysqli_query($conn,$Update_marks);
      if ($Update_marks_run==true)
       {
      echo "1";   // code...
      }
      else
      {
         echo "0";
      }

   } 
    elseif($code==16)
   {
      $ID=$_POST['ID'];
    
      $Update_marks="UPDATE task_master SET Status='1' where ID='$ID'";
      $Update_marks_run=mysqli_query($conn,$Update_marks);
      if ($Update_marks_run==true)
       {
      echo "1";   // code...
      }
      else
      {
         echo "0";
      }

   }
   elseif($code==17)
   {
      $TodayDate=$_POST['date_r'];
      $change_status1=$_POST['change_status1'];
      $id=$_POST['id'];
      $check_report = "SELECT * FROM daily_report WHERE emp_id ='$EmployeeID' AND submit_date='$TodayDate' ";
      $check_report_run=mysqli_query($conn,$check_report);
      $count_report=mysqli_num_rows($check_report_run);
      if($count_report>0) 
      {
         echo "2";
      }
      else
      {
      $TeachingType=$_POST['TeachingType'];
      $BeforeNoon =str_replace("'", '',$_POST['BeforeNoon']);
      $AfterNoon =str_replace("'", '',$_POST['AfterNoon']);
      $AdmissionWork=$_POST['AdmissionWork'];
      $NAAC=$_POST['NAAC'];
      $FutureVision=$_POST['FutureVision'];
      $TodayTime=date('H-i-s');
      $Insert_daily_report="INSERT INTO `daily_report` ( `emp_id`, `od_act`, `submit_date`, `submit_time`, `admission`, `naac`, `practical`, `sugg`, `bnoon`, `anoon`, `emp_type`, `duty_perform`, `perform_detail`) 
      VALUES ( '$EmployeeID', '', '$TodayDate', '$TodayTime', '$AdmissionWork', '$NAAC', '', '$FutureVision', '$BeforeNoon', '$AfterNoon', '$TeachingType', '', '');";
      $Insert_daily_report_run=mysqli_query($conn,$Insert_daily_report);
if ($Insert_daily_report_run==true) {
   

       

                     $get_report_id="SELECT * FROM daily_report where emp_id='$EmployeeID' and submit_date='$TodayDate' ";
                  $get_report_id_run=mysqli_query($conn,$get_report_id);
                  if ($get_report_id_row=mysqli_fetch_array($get_report_id_run)) 
                  {

                     $in_task="INSERT INTO `daily_task_report` ( `report_id`, `task_id`, `t_status`) VALUES ('".$get_report_id_row['id']."', '$id', '$change_status1');";
                  mysqli_query($conn,$in_task);
                  }

                  }
               
      if ($Insert_daily_report_run==true)
       {
      echo "1";   
      }
      else
      {
         echo "0";
      }
   }
}
   elseif($code==18)
   {
       
             $last_reports="SELECT * FROM daily_report WHERE emp_id='$EmployeeID' Order by submit_date DEsc";
             $last_reports_run=mysqli_query($conn,$last_reports);
             while($last_reports_run_row=mysqli_fetch_array($last_reports_run))
             {
             $emp_id =$last_reports_run_row['emp_id'];
             $emp_type=$last_reports_run_row['emp_type'];
             $bnoon =$last_reports_run_row['bnoon'];
             $anoon =$last_reports_run_row['anoon'];
             $admission =$last_reports_run_row['admission'];  
             $naac = $last_reports_run_row['naac']; 
             $submit_date = $last_reports_run_row['submit_date'];

   if($emp_type=='Non-Teaching')
   {
     ?>    <div class="col-lg-12">
       <b style="color: red"> Date:    <?php echo $submit_date; ?> </b> <br/>
   <b style="color: black">Your Task </b> <br/>
 <table class="table ">
   <tr>
   <th style="text-align: center;">SrNo</th>
   <th style="text-align: center;">Task Name</th>
   <th style="text-align: center;">Status</th>
 </tr><?php
 $s=1;
      $show_task_on_submit="SELECT * FROM task_master inner join daily_task_report ON task_master.ID=daily_task_report.task_id   where daily_task_report.report_id='".$last_reports_run_row['id']."'";
      $show_task_on_submit_run=mysqli_query($conn,$show_task_on_submit);
      while($show_task_on_submit_row=mysqli_fetch_array($show_task_on_submit_run))
      {

      
             $task_id = $show_task_on_submit_row['task_id'];
             $report_id = $show_task_on_submit_row['report_id'];
             $t_status = $show_task_on_submit_row['t_status'];
             $TaskName = $show_task_on_submit_row['TaskName'];
               if ($t_status==0) {

                              $tn_status="Pending";
                              $clr="red";
                              
                           }
                           elseif ($t_status==1) {
                              $tn_status="Under Process";
                              $clr="blue";
                              
                           }
                           elseif($t_status==2)
                           {
                              $tn_status="Forwarded";
                              $clr="yellow";
                              

                           }
                           elseif($t_status==3)
                           {
                              $tn_status="Complete";
                              $clr="green";
                             

                           }
    ?>

<tr>
   <td style="text-align: center;"><?= $s;?></td>
   <td  style="text-align: center;"><?= $TaskName;?></td>
   <td  style="text-align: center; color: <?=$clr;?>"><b><?= $tn_status;?></b></td>
</tr>

<?php  $s++;}

?>
</table>
</div>
<div class="col-lg-12">
  
   <?php 
   $count = 1;
   ?>
   <b>Activity Report</b><br>
     <?php 
      $arrod_act1 = explode(PHP_EOL,$bnoon);  

      foreach($arrod_act1 as $value1)
      {
        echo "<b>".$count++.".</b> ".$value1."<br/>";
      }
   
    
    ?>
        
       <table class="table ">
         <tr>
         <th style="text-align: center;">Admission Work</th>
         <th style="text-align: center;">Research Work</th>
        </tr>
<tr>
   <td style="text-align: center;"><?= $admission;?></td>
   <td  style="text-align: center;"><?= $naac;?></td>
</tr>
</table> 
<hr color="green" size="20px;" > 
</div> 
    <?php
  }
             }
            

   }
    elseif($code==19)
   {
      $ID=$_POST['id'];
      $change_status=$_POST['change_status'];
      if ($change_status==0) {
         $task_percentage='0%';
      }
      elseif ($change_status==1) {
         $task_percentage='20%';
      }
      elseif($change_status==2)
      {
         $task_percentage='60%';    
      }
      else
      {
         $task_percentage='100%';    

      }
      
      if ($change_status==3)
       {
         $CompleteDate=date('Y-m-d');
      }else
      {
         $CompleteDate="0000-00-00";
      }
      
    $Update_marks="UPDATE task_master SET Status='$change_status',CompleteDate='$CompleteDate',task_percentage='$task_percentage' where ID='$ID'";
      $Update_marks_run=mysqli_query($conn,$Update_marks);
      if ($Update_marks_run==true)
       {
       echo "1";   // code...
       }
      else
      {
         echo "0";
      }

   }
   elseif($code==20)
   {?>
 <h6><b>Your Tasks</b></h6>
                     <table class="table">
                        <tbody>
                           <tr><th>#</th>
                      <th>Task Name</th>
                      <th> Assign By</th>
                      <th> Status</th>
                      <th>Action</th>
                  </tr>
                   <?php 
                   $sr=1;
                  $show_daily_task="SELECT * FROM task_master where EmpID='$EmployeeID' and Status!='3'";
                  $show_daily_task_run=mysqli_query($conn,$show_daily_task);

               if (mysqli_num_rows($show_daily_task_run)>0)
                {
                  while ($show_daily_task_row=mysqli_fetch_array($show_daily_task_run))
                   {
                     ?>
                   <tr>
                      <td>
                          <?=$sr;?>
                      </td>
                      <td>
                          <a>
                              <?=$show_daily_task_row['TaskName'];?>
                          </a>
                          <br/>
                          <small>
             <?=$show_daily_task_row['AssignDate'];?>

                          </small>
                      </td>
                      <td>

                          <ul class="list-inline"> 
                              <li class="list-inline-item">
                                      <?php

                 $get_emp_details="SELECT Snap,Name FROM Staff Where IDNo='".$show_daily_task_row['AssignBy']."'";
                  $get_emp_details_run=sqlsrv_query($conntest,$get_emp_details);
                  if($row_staff=sqlsrv_fetch_array($get_emp_details_run,SQLSRV_FETCH_ASSOC))
                  {
                  $Emp_Image=$row_staff['Snap'];
                  $emp_pic=base64_encode($Emp_Image);
                  

                                 echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";} ?>
                              </li>
                            
                          </ul> 
            <b> <?=$row_staff['Name'];?></b>
             (<?=$show_daily_task_row['AssignBy'];?>)
                      </td>
                         <td>         <?php 
                        $status_up="SELECT * FROM task_master Where ID='".$show_daily_task_row['ID']."'";
                        $status_up_run=mysqli_query($conn,$status_up);
                        if($status_show=mysqli_fetch_array($status_up_run))
                        {

                               if ($status_show['Status']==0) {

                              $status="Pending";
                              $status_color="danger";
                           }
                           elseif ($status_show['Status']==1) {
                              $status="Under Process";
                              $status_color="primary";
                              
                           }
                           elseif($status_show['Status']==2)
                           {
                              $status="Forwarded";
                              $status_color="warning";

                           }
                           elseif($status_show['Status']==3)
                           {
                              $status="Complete";
                              $status_color="success";

                           }
                          ?>
                          <span class="badge badge-<?=$status_color;?>"><?=$status;?></span>
                       <?php }?></td>
                        <td class="project-actions text-right">
                        
                          <select class="form-control" id="<?=$show_daily_task_row['ID'];?>_change_status1" onchange="task_submit_with_daily_report(<?=$show_daily_task_row['ID'];?>);">
                          
                             <option value="">Select</option>
                             <option value="3">Complete</option>
                             <option value="1">UnderProgress</option>
                          </select>

                      </td>
                  </tr>
               <?php $sr++;
                }
               }
               else
               {
               echo "<tr><td colspan='5'><center><small style='color:red;'>----------No Taks Found----------</small></center> <td> </tr>";
               }
               ?>
                        </tbody>

                     </table><?php
   }
   elseif($code==22)
   {
    
 $IDs=$_POST['id_status1'];
 $status=$_POST['change_status1'];
      $TodayDate=$_POST['date_r'];
      $check_report = "SELECT * FROM daily_report WHERE emp_id ='$EmployeeID' AND submit_date='$TodayDate' ";
      $check_report_run=mysqli_query($conn,$check_report);
      $count_report=mysqli_num_rows($check_report_run);
      if($count_report>0) 
      {
         echo "2";
      }
      else
      {
      $TeachingType=$_POST['TeachingType'];
      $BeforeNoon =str_replace("'", '',$_POST['BeforeNoon']);
      $AfterNoon =str_replace("'", '',$_POST['AfterNoon']);
      $AdmissionWork=$_POST['AdmissionWork'];
      $NAAC=$_POST['NAAC'];
      $FutureVision=$_POST['FutureVision'];
      $TodayTime=date('H-i-s');
      $Insert_daily_report="INSERT INTO `daily_report` ( `emp_id`, `od_act`, `submit_date`, `submit_time`, `admission`, `naac`, `practical`, `sugg`, `bnoon`, `anoon`, `emp_type`, `duty_perform`, `perform_detail`) 
      VALUES ( '$EmployeeID', '', '$TodayDate', '$TodayTime', '$AdmissionWork', '$NAAC', '', '$FutureVision', '$BeforeNoon', '$AfterNoon', '$TeachingType', '', '');";
      $Insert_daily_report_run=mysqli_query($conn,$Insert_daily_report);
                  if ($Insert_daily_report_run==true)
                     {
                     $get_report_id="SELECT * FROM daily_report where emp_id='$EmployeeID' and submit_date='$TodayDate' ";
                  $get_report_id_run=mysqli_query($conn,$get_report_id);
                  if ($get_report_id_row=mysqli_fetch_array($get_report_id_run)) 
                  {
                     for ($i=0; $i <count($IDs) ; $i++)
                      { 
                        
                      $in_task="INSERT INTO `daily_task_report` ( `report_id`, `task_id`, `t_status`) VALUES ('".$get_report_id_row['id']."', '$IDs[$i]', '$status[$i]');";
                         mysqli_query($conn,$in_task);
                      }
                  }
                  }
      if ($Insert_daily_report_run==true)
       {
      echo "1";   
      }
      else
      {
         echo "0";
      }
   }
   }
   elseif($code==23) // temp master course code update old to new
   {
          
                  $CollegeID=$_POST['CollegeID'];
                  $Course=$_POST['Course'];
                  $Batch=$_POST['Batch'];
                  $Semester=$_POST['Semester'];
              

  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
         $oldSubjectcode= $filesop[0];
         $newSubjectcode = $filesop[1];
         if ($Semester!='') 
         {
             echo    $update_study="UPDATE  MasterCourseStructure SET SubjectCode='$newSubjectcode' WHERE  CollegeID='$CollegeID' and CourseID='$Course' and Batch='$Batch' and  SemesterID='$Semester' and SubjectCode='$oldSubjectcode'";
          }else

          {
            echo    $update_study="UPDATE  MasterCourseStructure SET SubjectCode='$newSubjectcode' WHERE  CollegeID='$CollegeID' and CourseID='$Course' and Batch='$Batch'  and  SubjectCode='$oldSubjectcode'";

          }
             echo "<br>";
         $update_study_run=sqlsrv_query($conntest,$update_study);  
     if ($update_study_run==true) 
     {
        echo "success";
     }
     else
     {
      echo"no";
     }
      
  }

   }
   elseif($code==24)
{

 $CourseID = $_POST['Course'];
 $CollegeID = $_POST['College'];
 $Batch=$_POST['batch']; 
  $sem = $_POST['Sem'];
  $exam = $_POST['examination'];
 $group = $_POST['group'];
 $Type = $_POST['type'];
  $allow=0;

 

?>

<!-- <form action="post_action.php" method="post"> -->



              <div class="row">
             
<div class="col-lg-6">
<table   class="table"  style="border: 2px solid black"  >
 <tr>
                 
 <th>Srno</th>
   <th > ID </th>           
                </tr>
               
 <?php
 $i='1';

$ID=[];
 echo $practicle="SELECT * FROM  ExamForm where CollegeID='$CollegeID' and CourseID='$CourseID' and Batch='$Batch' and SemesterID='$sem' and Type='$Type' and Examination='$exam' and SGroup='$group' ";
$count=1;

  $stmt = sqlsrv_query($conntest,$practicle);  
                     while($p_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                 {
                  
                  ?>
                  <tr>
                     <td>
                <?= $count++;?>
              </td>
              <td> <?=$ID[]=$p_row['ID'];?></td>
             </tr>
               
<?php    
}
// print_r($ID);
?>
</table>
</div>
<!-- <div class="col-lg-6">
<table   class="table"  style="border: 2px solid black"  >
 <tr>             
 <th>Srno</th>
 <th> Subject Code </th>
</tr>
               
 
</table>
</div> -->
<table   class="table"  style="border: 2px solid black"  >
 <tr>             
 <th>Srno</th>
 <th> IDs </th>
</tr>
               
 <?php
echo count($ID);
$count=1;
for ($i=0; $i <count($ID) ; $i++) { 
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
     $oldSubjectcode= $filesop[0];
     $newSubjectcode = $filesop[1];
  $get_exam_id1="SELECT * FROM  ExamFormSubject where ExamId='$ID[$i]' and SubjectCode='$oldSubjectcode'";
 // echo "<br>";
  $stmt_1 = sqlsrv_query($conntest,$get_exam_id1);  
                     while($e_row1 = sqlsrv_fetch_array($stmt_1, SQLSRV_FETCH_ASSOC) )
                 {
                  $eID=$e_row1['ID'];
                         echo  $up="Update ExamformSubject set Subjectcode='$newSubjectcode' where ID='$eID' and SubjectCode='$oldSubjectcode'";
                         sqlsrv_query($conntest,$up);
                         
}
}
                  ?>



               <!--    <tr>
                     <td>
                <?= $count++;?>
              </td>
                <td>
                <?= $ID[$i];?>
              </td>
                 

              <td> <?=$e_row1['ID'];?></td>
             </tr> -->
               
<?php         

// print_r($SubjecodeArray);
?>
</table>
</div>
<?php 
 }

        
}

   else
   {
   
   }
   
}
   ?>     
