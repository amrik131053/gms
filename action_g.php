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
       $employee_details="SELECT Name,Department,CollegeName,Designation FROM Staff Where IDNo='$EmployeeID'";
      $employee_details_run=sqlsrv_query($conntest,$employee_details);
      if ($employee_details_row=sqlsrv_fetch_array($employee_details_run,SQLSRV_FETCH_ASSOC)) {
         $Emp_Name=$employee_details_row['Name'];
         $Emp_Designation=$employee_details_row['Designation'];
         $Emp_CollegeName=$employee_details_row['CollegeName'];
         $Emp_Department=$employee_details_row['Department'];
      }

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
               if ($LeaveRecommendingAuthority!='' or $LeaveRecommendingAuthority!=null)
                {
                  
      $task_name=$_POST['task_name'];
      $task_discription=$_POST['task_discription'];
      $assignTo=$_POST['assignTo'];

      $end_date=$_POST['end_date'];
      $asign_date=date('Y-m-d');
      $get_token="SELECT  *  from task_master order by TokenNo DESC LIMIT 1 ";
      $get_token_run=mysqli_query($conn,$get_token);
      if($row_token=mysqli_fetch_array($get_token_run))
      {
     $token=$row_token['TokenNo']+1;
      }
      else
      {
      $token="2300";
      }
      $insert_task="INSERT INTO `task_master` (`AssignDate`, `CompleteDate`, `EndDate`, `TaskName`, `Description`, `AssignTo`, `AssignBy`,`EmpID`, `ForwardTo`, `Status`, `TokenNo`) VALUES ('$asign_date', '', '$end_date', '$task_name', '$task_discription', '$assignTo', '$LeaveRecommendingAuthority','$EmployeeID', '$EmployeeID', '0', '$token');";
      $insert_task=mysqli_query($conn,$insert_task);
      if ($insert_task==true) 
      {
         if ($EmployeeID==$assignTo) 
         {
             $Notification1="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`) VALUES ('$LeaveRecommendingAuthority', '$EmployeeID', '$task_name', '$task_discription ', 'task-manager.php', '$timeStamp', '0')";
           mysqli_query($conn,$Notification1);

         }
         else
         {
            $Notification="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`) VALUES ('$assignTo', '$EmployeeID', '$task_name', '$task_discription ', 'task-manager.php', '$timeStamp', '0')";
           mysqli_query($conn,$Notification);

           $Notification1="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`) VALUES ('$LeaveRecommendingAuthority', '$EmployeeID', '$task_name', '$task_discription ', 'task-manager.php', '$timeStamp', '0')";
           mysqli_query($conn,$Notification1);

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
    else
    {
      echo "2";
    }



   }
   elseif($code==11)
   {
      ?>    <table class="table table-striped">
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
                      <th  class="text-center">
                        Action
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
                        $status_up="SELECT * FROM task_master Where ID='".$show_task_row['ID']."'";
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
                       <?php }?>
                      </td>
                      <td class="project-actions text-right">
                        
                          <a class="btn btn-success btn-sm" onclick="task_timeline(<?=$status_show['TokenNo'];?>);" data-toggle="modal" data-target="#ViewTaskModal" href="#">
                              
                             <i class="fa fa-eye fa-lg"></i>
                          </a>
                           <?php  if ($status_show['Status']!=3)
                            {
                          ?>
                          <a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#ForwardTaskModal" onclick="forward_set_id(<?=$show_task_row['TokenNo'];?>);" > 
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
      ?>    <table class="table table-striped ">
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
                      <th  class="text-center">
                        Action
                      </th>
                  </tr>
              </thead>
              <tbody>
                <?php
                $sr=1;
                 $show_task11="SELECT DISTINCT TokenNo FROM task_master Where AssignBy='$EmployeeID'  ";
                $show_task_run11=mysqli_query($conn,$show_task11);
                while ($show_task_row11=mysqli_fetch_array($show_task_run11))
                 {
                  $TokenNo1=$show_task_row11['TokenNo'];
                $show_task="SELECT * FROM task_master Where TokenNo='$TokenNo1'";
                $show_task_run=mysqli_query($conn,$show_task);
                if ($show_task_row=mysqli_fetch_array($show_task_run))
                 {
                   $marks=$show_task_row['marks'];
                  $TokenNo=$show_task_row['TokenNo'];
                  $AssignTo=$show_task_row['AssignTo'];
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
                           $show_task_="SELECT DISTINCT AssignTo FROM task_master Where TokenNo='$TokenNo' ";
                $show_task_run_=mysqli_query($conn,$show_task_);
                while ($show_task_row_=mysqli_fetch_array($show_task_run_))
                 {
                  $AssignTo_ui=$show_task_row_['AssignTo'];

                  ?>
                             <li class="list-inline-item" style="">
                                  <?php

                 $get_emp_details="SELECT Snap,Name FROM Staff Where IDNo='$AssignTo_ui'";
                  $get_emp_details_run=sqlsrv_query($conntest,$get_emp_details);
                  while($row_staff=sqlsrv_fetch_array($get_emp_details_run,SQLSRV_FETCH_ASSOC))
                  {
                  $Emp_Image=$row_staff['Snap'];
                  $emp_pic=base64_encode($Emp_Image);
                  

                                 echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
                              } ?>

             <!-- <SMALL> <?=$show_task_row_['AssignBy'];?></SMALL><BR> -->
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
                        $status_up="SELECT * FROM task_master Where ID='".$show_task_row['ID']."'";
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
                       <?php }?>
                      </td>
                      <td class=" text-center">
                          <a class="btn btn-success btn-sm" onclick="task_timeline(<?=$status_show['TokenNo'];?>);" data-toggle="modal" data-target="#ViewTaskModal" href="#">
                              
                              <i class="fa fa-eye fa-lg"></i>
                          </a>
                          <?php  if ($status_show['Status']!=3) {
                             
                          ?>
                         <!--  <a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#ForwardTaskModal" onclick="forward_set_id(<?=$show_task_row['TokenNo'];?>);" >
                             
                            <i class="fa fa-share" aria-hidden="true"></i>
                          </a> -->
                       <?php }?>
                         
                      </td>
                  </tr>
                <?php
                $sr++;
                 } } ?>
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
      $already_token="SELECT * from task_master where TokenNo='$token' and EmpID='$assignTo' and AssignTo='$assignTo' ";
      $already_token_run=mysqli_query($conn,$already_token);
      if($row_token=mysqli_fetch_array($already_token_run))
      {
echo "2";
      }
      else
      {

      $get_token="SELECT  TokenNo,TaskName,Description from task_master where TokenNo='$token' ";
      $get_token_run=mysqli_query($conn,$get_token);
      if($row_token=mysqli_fetch_array($get_token_run))
      {
      $token=$row_token['TokenNo'];
      $task_name=$row_token['TaskName']; 
      $update="UPDATE task_master SET AssignTo='$assignTo',Status='2' where EmpID='$EmployeeID' and TokenNo='$token'";
      $up=mysqli_query($conn,$update);
      }
     if ($up==true) 
       {
       if ($assignTo!=$EmployeeID)
        {
      $insert_task="INSERT INTO `task_master` (`AssignDate`, `CompleteDate`, `EndDate`, `TaskName`, `Description`, `AssignTo`, `AssignBy`,`EmpID`, `ForwardTo`, `Status`, `TokenNo`) VALUES ('$asign_date', '', '$end_date', '$task_name', '$forward_remarks', '$assignTo', '$EmployeeID','$assignTo', '', '0', '$token');";
      $insert_task=mysqli_query($conn,$insert_task);

       $Notification1="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`) VALUES ('$assignTo', '$EmployeeID', '$task_name', '$forward_remarks ', 'task-manager.php', '$timeStamp', '0')";
           mysqli_query($conn,$Notification1);
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
                $timeline="SELECT * FROM task_master where TokenNo='$TokenNo' ";
                $timeline_run=mysqli_query($conn,$timeline);
                while ($timeline_row=mysqli_fetch_array($timeline_run)) 
                {
                  $marks=$timeline_row['marks'];
                  $ForwardBy=$timeline_row['ForwardTo'];
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
               if ($ForwardBy!=0)
                {
                 $createBy="Create By ";
               }
               else
               {
                 $createBy=" ";

               }
                 ?>
                <i class="fa fa-<?=$envolp_icon;?> bg-<?=$envolp;?>"></i>
                <div class="timeline-item">
                  <span class="time bg-<?=$envolp;?>"><b> <?=$envolp_msg;?></b></span>
                  <h3 class="timeline-header"><b><?=$createBy;?></b><b><?=$Self;?> &nbsp;&nbsp;<?=$EmpName;?></b><a ><?=$EmpID_U; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a ><b><?=$AssignToempName;?></b><?=$AssignToempID; ?></a></h3>

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
                             <input type="button" value="Submit" onclick="submit_marks(<?=$timeline_row['ID'];?>)" class="btn btn-primary btn-xs" name="">
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
      echo "1";  

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
                        
                          <!-- <select class="form-control" id="<?=$show_daily_task_row['ID'];?>_change_status1" onchange="task_submit_with_daily_reportpp(<?=$show_daily_task_row['ID'];?>);"> -->
                                                    <select class="form-control" id="<?=$show_daily_task_row['ID'];?>_change_status1">
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
                        $IDs=$_POST['id_status1'];
                        $status=$_POST['change_status1'];

                     $get_report_id="SELECT * FROM daily_report where emp_id='$EmployeeID' and submit_date='$TodayDate' ";
                  $get_report_id_run=mysqli_query($conn,$get_report_id);
                  if ($get_report_id_row=mysqli_fetch_array($get_report_id_run)) 
                  {
                     for ($i=0; $i <count($IDs) ; $i++)
                      { 
                      if ($status[$i]==0)
                        {
                           $task_percentage='0%';
                        }
                        elseif ($status[$i]==1)
                        {
                           $task_percentage='20%';
                        }
                        elseif($status[$i]==2)
                        {
                           $task_percentage='60%';    
                        }
                        else
                        {
                           $task_percentage='100%';    

                        }
                          if ($status[$i]==3)
                         {
                           $CompleteDate=date('Y-m-d');
                         }
                        else
                         {
                           $CompleteDate="0000-00-00";
                         }
                 $Update_marks="UPDATE task_master SET Status='".$status[$i]."',CompleteDate='$CompleteDate',task_percentage='$task_percentage' where ID='$IDs[$i]'";
                    $Update_marks_run=mysqli_query($conn,$Update_marks);

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
?>
</table>
</div>

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
</table>
</div>
<?php 
 }

        
}
elseif($code==25)
{
   ?>

<table class="table">
   <thead>
      <tr><th>
         SrNo
      </th>
      <th>
         Employee ID
      </th>
      <th>Date</th>
      <th>Activity</th>
      <th>Admission</th>
      <th>Research</th>
      <th>No Of Task</th>
      <th>Completed Tasks</th>

      </tr>
 </thead>
 <tbody>
   <?php 
   $sr=1;
$empID=$_POST['emp_id'];
 $get_report_all="SELECT * FROM daily_report WHERE emp_id='$empID'";
$get_report_all_run=mysqli_query($conn,$get_report_all);
while($row_report_print=mysqli_fetch_array($get_report_all_run))
{
 $check_task_all="SELECT * FROM daily_report inner join daily_task_report on daily_report.id=daily_task_report.report_id WHERE daily_report.emp_id='$empID' and daily_report.submit_date='".$row_report_print['submit_date']."'";
$check_task_all_run=mysqli_query($conn,$check_task_all);
$count=mysqli_num_rows($check_task_all_run);

 $check_task_all1="SELECT * FROM daily_report inner join daily_task_report on daily_report.id=daily_task_report.report_id WHERE daily_report.emp_id='$empID' and daily_task_report.t_status='1' and daily_report.submit_date='".$row_report_print['submit_date']."'";
$check_task_all_run1=mysqli_query($conn,$check_task_all1);
$count_complete=mysqli_num_rows($check_task_all_run1);
if($Complete_report=mysqli_fetch_array($check_task_all_run))
{
if($Complete_report['t_status']==1)
{
   $t_status="Under Process";
}
elseif($Complete_report['t_status']==2)
{
$t_status="Forwarded";
}
elseif($Complete_report['t_status']==3)
{
   $t_status="Completed";
}else
{
   $t_status="Pendig";
}
}
   ?>
<tr>
   <td>
      <?=$sr;?>
   </td>
   <td>
      <?=$row_report_print['emp_id'];?>
   </td>
    <td>
      <?=$row_report_print['submit_date'];?>
   </td> 

   <td>
      <?=$row_report_print['bnoon'];?>
   </td>
    <td>
      <?=$row_report_print['admission'];?>
   </td>
    <td>
      <?=$row_report_print['naac'];?>
   </td>
    <td>
      <?=$count;?>
   </td> 
    <td>
      <?=$t_status;?>
   </td> 
</tr>
<?php 
$sr++;
}
?> 
</tbody> 
</table><?php
}
elseif ($code==26) {
    ?>  
     <div class="dropdown-divider"></div>
     <?php 
  $query_1 = "SELECT * FROM notifications WHERE Status=0 and EmpID='$EmployeeID' order by ID DESC LIMIT 3";
  $result_1 = mysqli_query($conn, $query_1);
  $count = mysqli_num_rows($result_1);
    if ($count>0) 
    {
  while ($row=mysqli_fetch_array($result_1)) 
   {?>

            <?php 
    $Noti_color="";
    $ID=$row['ID'];
    $comment_subject=$row['Subject'];
    $comment_text=$row['Discriptions'];
    $comment_status=$row['Status'];
    $Page_link=$row['Page_link'];
    $SendBy=$row['SendBy'];
   $get_emp_details="SELECT Snap,Name FROM Staff Where IDNo='$SendBy'";
                  $get_emp_details_run=sqlsrv_query($conntest,$get_emp_details);
                  if($row_staff=sqlsrv_fetch_array($get_emp_details_run,SQLSRV_FETCH_ASSOC))
                  {
                  $Emp_Image=$row_staff['Snap'];
                  $SendByName=$row_staff['Name'];
                  $emp_pic=base64_encode($Emp_Image);
                              }
    $Notification_type=$row['Notification_type'];
    if ($Notification_type=='0') 
    {
       $Noti_color="text-primary";
    }
    elseif($Notification_type=='1')
    {
       $Noti_color="text-success";
    } 
    elseif($Notification_type=='2')
    {
       $Noti_color="text-warning";
    }
     else
    {
       $Noti_color="text-danger";
    }

    $datetime=$row['DateTime'];?>
          <?php 
    ?>
                   <a href="<?=$Page_link;?>" class="dropdown-item">

          <div class="media">
                <?php echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image' >";?>
              <div class="media-body" onclick="seen_notification(<?=$ID;?>);">
                <h3 class="dropdown-item-title">
                 &nbsp;&nbsp;<b class="<?=$Noti_color;?>"> <?=$comment_subject;?></b>
                  <span class="float-right text-sm text-danger"></span> 
                  <!-- <i class="fas fa-star"></i> -->
                </h3>
                <p class="text-sm">&nbsp;&nbsp;&nbsp;&nbsp;<?=$SendByName;?></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?=$datetime;?></p>
              </div>
            </div>
             </a>
          <?php
      }
      ?><?php
   }
   else
   {
    ?> <a href="#" class="dropdown-item dropdown-footer ">No Notifications</a><?php 
   }
  ?><div class="dropdown-divider"></div>
          <a href="all-notification.php" class="dropdown-item dropdown-footer text-success"><b>See All Notifications</b></a><?php
}
elseif ($code==27)
{
  $query_1 = "SELECT * FROM notifications WHERE Status=0 and EmpID='$EmployeeID' ";
 $result_1 = mysqli_query($conn, $query_1);
 echo $count = mysqli_num_rows($result_1);
}
elseif ($code==28)
{
   $ID=$_POST['n_id'];
  $query_1 = "UPDATE  notifications SET Status='1' WHERE  EmpID='$EmployeeID' and ID='$ID' ";
 $result_1 = mysqli_query($conn, $query_1);
}
elseif ($code==29) {
   ?>
   <table class="table" id="example">
   <thead>
      <tr>
         <th>SrNo</th>
         <th>Subject</th>
         <th>Discription</th>
         <th>Send By</th>
         <th>Date Time</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody><?php 
  $query_1 = "SELECT * FROM notifications WHERE Status=1 and EmpID='$EmployeeID'";
  $result_1 = mysqli_query($conn, $query_1);
  $count = mysqli_num_rows($result_1);
    if ($count>0) 
    {
      $sr=1;
  while ($row=mysqli_fetch_array($result_1)) 
   {
      $ID=$row['ID'];
      ?>

      <tr>
         <td><?=$sr;?></td>
         <td><a href="<?=$row['Page_link'];?>"><b><?=$row['Subject'];?></b></a></td>
         <td><?=$row['Discriptions'];?></td>
         <td><?=$row['SendBy'];?></td>
         <td><?=$row['DateTime'];?></td>
         <td><button class="btn btn-warning btn-sm" onclick="mark_unread(<?=$ID;?>);">Mark UnRead</button></td>
      </tr>
   
   <?php $sr++; }
   ?><?php 
   }
   else{
     ?><tr>
         <td colspan="5"><center><p style='color:red;'>No Record</p></center></td></tr><?php 
   }
   ?></tbody>
</table><?php 
}
elseif ($code==30) {
   ?>
   <table class="table" id="example">
   <thead>
      <tr>
         <th>SrNo</th>
         <th>Subject</th>
         <th>Discription</th>
         <th>Send By</th>
         <th>Date Time</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody><?php 
  $query_1 = "SELECT * FROM notifications WHERE Status=0 and EmpID='$EmployeeID'";
  $result_1 = mysqli_query($conn, $query_1);
  $count = mysqli_num_rows($result_1);
    if ($count>0) 
    {
      $sr=1;
  while ($row=mysqli_fetch_array($result_1)) 
   {
      $ID=$row['ID'];
      ?>

      <tr>
         <td><?=$sr;?></td>
         <td ><a href="<?=$row['Page_link'];?>"><?=$row['Subject'];?></a></td>
         <td><?=$row['Discriptions'];?></td>
         <td><?=$row['SendBy'];?></td>
         <td><?=$row['DateTime'];?></td>
        <td><button class="btn btn-warning btn-sm" onclick="mark_read(<?=$ID;?>);">Mark Read</button></td>
      </tr>
   
   <?php $sr++; }
    
   }
   else{
     ?><tr>
         <td colspan="5"><center><p style='color:red;'>No Record</p></center></td></tr><?php 
      }
   ?></tbody>
</table><?php
}
elseif ($code==31)
{
   $ID=$_POST['id'];
  $query_1 = "UPDATE  notifications SET Status='1' WHERE  EmpID='$EmployeeID' and ID='$ID' ";
 $result_1 = mysqli_query($conn, $query_1);
}
elseif ($code==32)
{
   $ID=$_POST['id'];
  $query_1 = "UPDATE  notifications SET Status='0' WHERE  EmpID='$EmployeeID' and ID='$ID' ";
 $result_1 = mysqli_query($conn, $query_1);
}
elseif ($code==33)
{
   $ID=$_POST['n_id'];
  $query_1 = "UPDATE  notifications SET Web_Status='1' WHERE  EmpID='$EmployeeID' and ID='$ID' ";
 $result_1 = mysqli_query($conn, $query_1);
}
elseif($code==34)
{
$type=$_POST['type'];
 $insert_type="INSERT INTO vehicle_types(name)values('$type')";
$insert_type_run=mysqli_query($conn,$insert_type);
?>
<script type="text/javascript">
   window.location.href="transport-vehicle-add.php";
</script>
<?php 
}
elseif($code==35)
{
$type=$_POST['type'];
$name=$_POST['name'];
$number=$_POST['number'];
$img=$_FILES['image']['name'];
$target_path = "vehicle_image/";  
$target_path = $target_path.basename( $_FILES['image']['name']);   
move_uploaded_file($_FILES['image']['tmp_name'], $target_path)  ;
  $insert_vehicle="INSERT INTO `vehicle` (`name`, `vehicle_number`, `type_id`,`image`) VALUES ( '$name', '$number', '$type','$img');";
$insert_vehicle_run=mysqli_query($conn,$insert_vehicle);
if ($insert_vehicle==true)
 {
echo "1";   // code...
}
else
{
   echo "0";
}
 }
    elseif($code==36)
   {?>
<table class="table">
   <thead>
      <tr>
         <th>#</th>
         <th>Name</th>
         <th>Number</th>
         <th>Image</th>
         <th>Type</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php 
         $sr=1;
         $get_group="SELECT *,vehicle_types.name as name_t ,vehicle.id  as v_id,vehicle.name as v_name FROM vehicle inner join vehicle_types ON vehicle.type_id=vehicle_types.id";
         $get_group_run=mysqli_query($conn,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {?>
      <tr>
         <th><?=$sr;?></th>
         <th><?=$row['v_name'];?></th>
         <th><?=$row['vehicle_number'];?></th>
         <th><img src="vehicle_image/<?=$row['image'];?>" width="100" height="70" ></th>
         <th><?=$row['name_t'];?></th>
         <th><i class="fa fa-edit" onclick="update_vehicle_record(<?=$row['v_id'];?>);" data-toggle="modal" data-target="#update_vehicle_modal" ></i></th> 
         
      </tr>
      <?php
         $sr++; }
           ?>
   </tbody>
</table>
<?php
   }
   elseif($code==37)
   {
       $id=$_POST['id'];
        
          $get_group="SELECT *,vehicle_types.name as name_t ,vehicle_types.id as t_id,vehicle.name as v_name FROM vehicle inner join vehicle_types ON vehicle.type_id=vehicle_types.id where vehicle.id='$id'";
         $get_group_run=mysqli_query($conn,$get_group);
         if($row=mysqli_fetch_array($get_group_run))
         {?>
            <input type="hidden" value="38" name="code">
            <input type="hidden" value="<?=$id;?>" name="id">
            <label>Name</label>
<input type="text" class="form-control" name="name" value="<?=$row['v_name'];?>">  
    <label>Number</label>
<input type="text" class="form-control" name="number" value="<?=$row['vehicle_number'];?>">
<label>Type</label>
 <select class="form-control" name="type">
            <option value="">Select</option>
            <?php  $get_type="SELECT * FROM vehicle_types";
              $get_type_run=mysqli_query($conn,$get_type);
              while($row1=mysqli_fetch_array($get_type_run))
              {?>
            <option value="<?=$row1['id'];?>"><?=$row1['name'];?></option>
            <?php 
              }
             ?>
          </select>
<label>Image</label>
<input type="file" class="form-control" name="image">

    <?php   }
           
   }
   elseif($code==38)
{

$id=$_POST['id'];
$type=$_POST['type'];
$name=$_POST['name'];
$number=$_POST['number'];
$img=$_FILES['image']['name'];
$target_path = "vehicle_image/";  
$target_path = $target_path.basename( $_FILES['image']['name']);   
move_uploaded_file($_FILES['image']['tmp_name'], $target_path)  ;
 echo  $insert_vehicle="UPDATE  vehicle SET  name='$name', vehicle_number='$number',type_id='$type',image='$img' WHERE id='$id'";
$insert_vehicle_run=mysqli_query($conn,$insert_vehicle);
if ($insert_vehicle==true)
 {
echo "1";   // code...
}
else
{
   echo "0";
}
 }
 elseif($code==39) // crreate request
 {
 $type=$_POST['type'];
 $from=$_POST['from'];
 $to=$_POST['to'];
 $station=$_POST['station'];
 $purpose=$_POST['purpose'];
  $check_availble="SELECT id FROM vehicle where type_id='$type'";
 $check_availble_run=mysqli_query($conn,$check_availble);
 while($row=mysqli_fetch_array($check_availble_run))
 {
    $vehicle_array[]=$row['id'];
 }
 $count=0;
 foreach ($vehicle_array as $key => $value) 
 {
   // echo "1";
     $check="SELECT * from vehicle_book_details where vehicle_id='$value' and from_date='$from' and to_date='$to'";
    $check_run=mysqli_query($conn,$check);
    if(mysqli_num_rows($check_run)>0)
    {

       echo "2"; // vehicle not availavle
    }
    else
    {
      $count++;
    }


 }
     
 if ($count>0) 
 {

   $check_flow="SELECT * FROM flow_user Where emp_id='$EmployeeID'";
   $check_flow_run=mysqli_query($conn,$check_flow);
   if($check_flow_row=mysqli_fetch_array($check_flow_run))
   {
$user_flow_str=$check_flow_row['flow'];
$user_flow=explode(",",$user_flow_str);

  
 $get_token="SELECT token_no From vehicle_allotment order by id DESC LIMIT 1";
 $get_token_run=mysqli_query($conn,$get_token);
 if($get_token_row=mysqli_fetch_array($get_token_run))
 {
$TokenNo=$get_token_row['token_no'];
 }
 else
 {
$TokenNo=2300;
 }
 $TokenNo=$TokenNo+1;
  if ($user_flow[0]!=0)
    {
      $get_user_details="SELECT Name,Department,CollegeName,Designation FROM Staff Where IDNo='".$user_flow[0]."'";
      $get_user_details_run=sqlsrv_query($conntest,$get_user_details);
      if ($get_user_details_row=sqlsrv_fetch_array($get_user_details_run,SQLSRV_FETCH_ASSOC)) {
         $Name=$get_user_details_row['Name'];
         $Designation=$get_user_details_row['Designation'];
         $CollegeName=$get_user_details_row['CollegeName'];
         $Department=$get_user_details_row['Department'];
      }
       $insert_request="INSERT INTO `vehicle_allotment` (`emp_id`,`name`,`designation`,`college`,`department`, `token_no`, `station`, `purpose`, `attachment`, `submit_date_time`, `journey_start_date`, `journey_end_date`, `vehicle_type`, `vehicle_alloted_id`, `status`,`flow_index`) VALUES ('$EmployeeID','$Emp_Name','$Emp_Designation','$Emp_CollegeName','$Emp_Department' ,'$TokenNo', '$station', '$purpose', 'NA', '$timeStamp', '$from', '$to', '$type', '0', '0','0');";
      $insert_request_run=mysqli_query($conn,$insert_request);

       $insert_request_process="INSERT INTO `vehicle_allotment_process` (`token_no`, `emp_id`, `name`, `designation`, `college`, `department`, `forward_emp_id`, `farward_name`, `farward_designation`, `farward_college`, `farward_department`, `remarks`, `date_time`, `action`) VALUES ( '$TokenNo', '$user_flow[0]', '$Name', ' $Designation', '$CollegeName', '$Department', NULL, '', '', '', '', NULL, '$timeStamp', '0');";
      $insert_request_process_run=mysqli_query($conn,$insert_request_process);

     }
    else
     {  
      $check_flow_auth="SELECT * FROM flow_auth where type='Transport'";
      $check_flow_auth_run=mysqli_query($conn,$check_flow_auth);
      if($check_flow_auth_row=mysqli_fetch_array($check_flow_auth_run))
      {
         $user_auth_str=$check_flow_auth_row['flow'];
         $user_auth=explode(",",$user_auth_str);
         $get_auth_details="SELECT Name,Department,CollegeName,Designation FROM Staff Where IDNo='".$user_auth[0]."'";
      $get_auth_details_run=sqlsrv_query($conntest,$get_auth_details);
      if ($get_auth_details_row=sqlsrv_fetch_array($get_auth_details_run,SQLSRV_FETCH_ASSOC))
       {
         $Name=$get_auth_details_row['Name'];
         $Designation=$get_auth_details_row['Designation'];
         $CollegeName=$get_auth_details_row['CollegeName'];
         $Department=$get_auth_details_row['Department'];
      }
           $insert_request="INSERT INTO `vehicle_allotment` (`emp_id`,`name`,`designation`,`college`,`department`, `token_no`, `station`, `purpose`, `attachment`, `submit_date_time`, `journey_start_date`, `journey_end_date`, `vehicle_type`, `vehicle_alloted_id`, `status`,`flow_index`,`flow_index1`) VALUES ('$EmployeeID','$Emp_Name','$Emp_Designation','$Emp_CollegeName','$Emp_Department' ,'$TokenNo', '$station', '$purpose', 'NA', '$timeStamp', '$from', '$to', '$type', '0', '3','0','1');";
      $insert_request_run=mysqli_query($conn,$insert_request);

         $insert_request_process="INSERT INTO `vehicle_allotment_process` (`token_no`, `emp_id`, `name`, `designation`, `college`, `department`, `forward_emp_id`, `farward_name`, `farward_designation`, `farward_college`, `farward_department`, `remarks`, `date_time`, `action`) VALUES ( '$TokenNo', '$user_auth[0]', '$Name', ' $Designation', '$CollegeName', '$Department', NULL, '', '', '', '', NULL, '$timeStamp', '0');";
      $insert_request_process_run=mysqli_query($conn,$insert_request_process);
      }

   
     }
      if ( $insert_request_process_run==true) 
      {
      echo "1";   // success
      }
      else
      {
         echo "0"; // error
      }

   }
   else
   {
echo "3"; // flow set please
   }
   

     }
 }
 elseif($code==40) // my  request
 {

   ?>
 <table class="table" id="example">
         <thead>
           <tr>            
             <th>#</th>
             <th>Request No</th>
             <th>Station</th>
             <th>Purpose</th>
             <th>Date of Journey</th>
             <th>Type</th>
             <th>Status</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
            <?php  $sr=1; $get_requests="SELECT * FROM vehicle_allotment where emp_id='$EmployeeID'"; 
                  $get_requests_run=mysqli_query($conn,$get_requests);
                  while($get_row=mysqli_fetch_array($get_requests_run))
                  {
                     if ($get_row['status']==0)
                      {
                     $status_user_side="<b class='bg-primary'>Pending</b>";
                     }
                     elseif($get_row['status']==1)
                     {
                     $status_user_side="<b class='bg-warning'>Process</b>";
                     }
                     elseif($get_row['status']==2)
                     {
                     $status_user_side="<b class='bg-danger'>Reject</b>";
                     }
                     elseif($get_row['status']==3)
                     {
                     $status_user_side="<b class='bg-warning'>Forward To Transport</b>";
                     }
                     elseif($get_row['status']==4)
                     {
                     $status_user_side="<b class='bg-warning'>Forward To Registrar</b>";
                     }
                     elseif($get_row['status']==5)
                     {
                     $status_user_side="<b class='bg-success'>Complete</b>";
                     }
                     else
                     {

                     }


             ?>
            <tr>
               <td><?=$sr;?></td>
               <td><?=$get_row['token_no'];?></td>
               <td><?=$get_row['station'];?></td>
               <td><?=$get_row['purpose'];?></td>
               <td><?=$get_row['journey_start_date'];?></td>
               <td><?=$get_row['vehicle_type'];?></td>
               <td><?=$status_user_side;?></td>
               <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#ViewRequestModal"  onclick="view_request_submit(<?=$get_row['token_no'];?>);"></i></td>
              
            </tr>
         <?php $sr++; }?>
         </tbody>
       </table>
 <?php }
 elseif($code==41) // pendig verification
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php  $sr=1; $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='0'"; 
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }
  elseif($code==42) // forward verification
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php  $sr=1; $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='1'";
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php } 
 elseif($code==43) // reject verification
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php  $sr=1; $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment.status='2'";
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }
  elseif($code==44) // pendig allotement
 {

   ?>
<table class="table" id="example">
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th> 
            </tr>
          </thead>
          <tbody>
             <?php  
              $sr=1; $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='0'"; 
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification_alott(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }
  elseif($code==45) //  forward allotement
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php  $sr=1; $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='1'";  
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification_alott(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }

  elseif($code==46)  //reject allotement
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php  $sr=1; $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='2'"; 
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }
 elseif($code==47)// timeline verification
 {
    $TokenNo=$_POST['Token_No'];
    ?> 
    <!-- <div class="row" > -->
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline" style="font-size: 15px !important;">
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">Token No:<?=$TokenNo;?></span>
              </div>
             <?php 
      $get_details_token="SELECT * FROM  vehicle_allotment   where token_no='$TokenNo'"; 
                  $get_details_token_run=mysqli_query($conn,$get_details_token);
                  if($get_row_token=mysqli_fetch_array($get_details_token_run))
                  {       
   ?>  
              <div >
               <i class="fa fa-stop-circle bg-primary" aria-hidden="true"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> <?=$get_row_token['submit_date_time'];?></span>
                 <h3 class="timeline-header"><b>Request by&nbsp;&nbsp;:&nbsp;&nbsp;<?=$get_row_token['emp_id'];?></b>&nbsp;&nbsp;<?=$get_row_token['name'];?></h3>

                  <div class="timeline-body" >
                    <table class="table">
                       <tr>
                          <th>Name</th>
                          <th>Designation</th>
                          <th>Department</th>
                          <th>Vehicle Name</th>
                       </tr>
                       <tr>
                          <td><?=$get_row_token['name'];?></td>
                          <td><?=$get_row_token['designation'];?></td>
                          <td><?=$get_row_token['department'];?></td>
                          <td><?=$get_row_token['vehicle_type'];?></td>
                         
                       </tr>  
                        <tr>
                          <th>Station</th>
                          <th>Purpose</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                       </tr>
                       <tr>
                          <td><?=$get_row_token['station'];?></td>
                          <td><?=$get_row_token['purpose'];?></td>
                          <td><?=$get_row_token['journey_start_date'];?></td>
                          <td><?=$get_row_token['journey_end_date'];?></td>
                         
                       </tr>
                    </table>
                   <input type="hidden" id="time_line_id" value="0">
               <input type="hidden" id="time_line_token" value="<?=$TokenNo;?>">
               <input type="hidden" id="time_line_userId" value="<?=$get_row_token['emp_id'];?>">
               <input type="hidden" id="time_line_forward_remarks" >
                  </div>
                 <!--  <div class="timeline-footer">
                    
                  </div> -->
                </div>
              </div>
             
             
            <?php



             }
   $get_details="SELECT *,vehicle_allotment_process.name as process_name,vehicle_allotment_process.emp_id as process_emp_id FROM  vehicle_allotment_process inner join vehicle_allotment ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment.token_no='$TokenNo' order by vehicle_allotment_process.id ASC"; 
                  $get_details_run=mysqli_query($conn,$get_details);
                  while($get_details_run_row=mysqli_fetch_array($get_details_run))
                  { 
                     if ($get_details_run_row['action']==0) 
                {
                  $envolp="warning";
                  $envolp_msg="Pending";
                  $envolp_icon="hourglass-start";
                } elseif ($get_details_run_row['action']==1) 
                {
                  $envolp="warning";
                  $envolp_msg="Under Process";
                  $envolp_icon="share";


                }
                elseif ($get_details_run_row['action']==2) 
                {
                  $envolp="danger";
                  $envolp_msg="Reject";
                  $envolp_icon="times";


                } elseif ($get_details_run_row['action']==4) 
                {
                  $envolp="primary";
                  $envolp_msg="Forward";
                  $envolp_icon="times";


                }
                elseif ($get_details_run_row['action']==5) 
                {
                  $envolp="success";
                  $envolp_msg="Complete";
                  $envolp_icon="check-circle";



                } 

                if ($get_details_run_row['forward_emp_id']!=0) 
                {
                  $forward_to_="&nbsp;To&nbsp;(".$get_details_run_row['farward_name'].")";
                }
                else
                {
                   $forward_to_="";

                }
                 if ($get_details_run_row['process_emp_id']==$EmployeeID) 
                  {
                     $Self="(You)";
                  }
                  else
                  {
                     $Self="";
                  }
                  
            ?>
               <div>
            <i class="fa fa-<?=$envolp_icon;?> bg-<?=$envolp;?>" aria-hidden="true"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> <?=$get_details_run_row['date_time'];?></span>
                 <p class="timeline-header"><?=$Self;?>&nbsp;&nbsp;<?=$get_details_run_row['process_name'];?>&nbsp;(<?=$get_details_run_row['process_emp_id'];?>)<?=$forward_to_;?></p>

                  <div class="timeline-body">
               
              
           <b>Remarks:</b>   <?=$get_details_run_row['remarks'];?>
           <?php 
           if ($get_details_run_row['action']==5) {
              // code...
           
           $get_driver_details="SELECT * FROM  vehicle_allotment inner join vehicle_book_details  ON vehicle_allotment.vehicle_alloted_id=vehicle_book_details.vehicle_id  inner join vehicle ON vehicle.id=vehicle_allotment.vehicle_alloted_id   where vehicle_allotment.token_no='$TokenNo'"; 
                  $get_driver_details_run=mysqli_query($conn,$get_driver_details);
                  if($get_driver_details_run_row=mysqli_fetch_array($get_driver_details_run))
                  {  
                $driver_id=$get_driver_details_run_row['driver_id'];
                 $get_emp_driver="SELECT * FROM Staff Where IDNo='$driver_id' and JobStatus='1'";
              $get_emp_driver_run=sqlsrv_query($conntest,$get_emp_driver);
              while($row=sqlsrv_fetch_array($get_emp_driver_run,SQLSRV_FETCH_ASSOC))
              {?>
<table class="table">
   <tr>
      <td><b>Driver ID:</b><?=$row['IDNo'];?></td>
      <td><b>Driver Name:</b><?=$row['Name'];?></td>
      <td><b>Driver Mobile:</b><?=$row['MobileNo'];?></td>
   </tr> 
   <tr>
      <td><b>Vehicle Number:</b><?=$get_driver_details_run_row['vehicle_number'];?></td>
      <td><b>Vehicle Name:</b><?=$get_driver_details_run_row['name'];?></td>
      <td><?=$get_driver_details_run_row['image'];?></td>
   </tr>
</table>
              <?php }
                  }
                  else
                  {

                  }
                  // echo "End";
               }
               else
               {

               }
           ?>
                  </div>
              
                </div>
              </div>

<?php }?>
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          <!-- </div> -->
          <!-- /.col -->
        </div><?php 
 }
 elseif($code==48)
 {
$userId=$_POST['userId'];
$TokenNo=$_POST['token'];
$forward_remarks=$_POST['forward_remarks'];

      $check_flow="SELECT * FROM flow_user inner join vehicle_allotment ON flow_user.emp_id=vehicle_allotment.emp_id Where flow_user.emp_id='$userId' and vehicle_allotment.token_no='$TokenNo'";
   $check_flow_run=mysqli_query($conn,$check_flow);
   if($check_flow_row=mysqli_fetch_array($check_flow_run))
   {
        $user_flow_id=$check_flow_row['flow_index']+1;
      $user_flow_str=$check_flow_row['flow'];
      $user_flow=explode(",",$user_flow_str);
     $user_array_size=count($user_flow);
      if ($user_array_size>$user_flow_id) 
      {
      $get_user_details="SELECT Name,Department,CollegeName,Designation FROM Staff Where IDNo='".$user_flow[$user_flow_id]."'";
      $get_user_details_run=sqlsrv_query($conntest,$get_user_details);
      if ($get_user_details_row=sqlsrv_fetch_array($get_user_details_run,SQLSRV_FETCH_ASSOC))
       {
         $Name=$get_user_details_row['Name'];
         $Designation=$get_user_details_row['Designation'];
         $CollegeName=$get_user_details_row['CollegeName'];
         $Department=$get_user_details_row['Department'];
      }

      $action_update_after_forward="UPDATE vehicle_allotment_process SET forward_emp_id='$user_flow[$user_flow_id]',farward_name='$Name',farward_designation='$Designation',farward_college='$CollegeName',farward_department='$Department',remarks='$forward_remarks', action='1' where token_no='$TokenNo' and emp_id='$EmployeeID'";
      mysqli_query($conn,$action_update_after_forward);

       $insert_request_process="INSERT INTO `vehicle_allotment_process` (`token_no`, `emp_id`, `name`, `designation`, `college`, `department`, `forward_emp_id`, `farward_name`, `farward_designation`, `farward_college`, `farward_department`, `remarks`, `date_time`, `action`) VALUES ( '$TokenNo', '$user_flow[$user_flow_id]', '$Name', ' $Designation', '$CollegeName', '$Department', NULL, '', '', '', '', NULL, '$timeStamp', '0');";
      $insert_request_process_run=mysqli_query($conn,$insert_request_process);
      // $user_flow_id=$user_flow_id+1;
$status_update_after_forward="UPDATE vehicle_allotment SET status='1',flow_index='$user_flow_id' where token_no='$TokenNo'";
      mysqli_query($conn,$status_update_after_forward);
}
    else
     {  
      $check_flow_auth="SELECT * FROM flow_auth where type='Transport'";
      $check_flow_auth_run=mysqli_query($conn,$check_flow_auth);
      if($check_flow_auth_row=mysqli_fetch_array($check_flow_auth_run))
      {
          $check_flow="SELECT * FROM  vehicle_allotment  Where emp_id='$userId' AND token_no='$TokenNo'";
   $check_flow_run=mysqli_query($conn,$check_flow);
   if($check_flow_row=mysqli_fetch_array($check_flow_run))
   {
$user_flow_id1=$check_flow_row['flow_index1'];
   }
         $user_auth_str=$check_flow_auth_row['flow'];
         $user_auth=explode(",",$user_auth_str);
         $auth_array_size=count($user_auth);
          $get_auth_details="SELECT Name,Department,CollegeName,Designation FROM Staff Where IDNo='".$user_auth[$user_flow_id1]."'";
      $get_auth_details_run=sqlsrv_query($conntest,$get_auth_details);
      if ($get_auth_details_row=sqlsrv_fetch_array($get_auth_details_run,SQLSRV_FETCH_ASSOC)) {
         $Name=$get_auth_details_row['Name'];
         $Designation=$get_auth_details_row['Designation'];
         $CollegeName=$get_auth_details_row['CollegeName'];
         $Department=$get_auth_details_row['Department'];
      }

      $action_update_after_forward="UPDATE vehicle_allotment_process SET forward_emp_id='$user_auth[$user_flow_id1]',farward_name='$Name',farward_designation='$Designation',farward_college='$CollegeName',farward_department='$Department',remarks='$forward_remarks', action='1' where token_no='$TokenNo' and emp_id='$EmployeeID'";
      mysqli_query($conn,$action_update_after_forward);

         $insert_request_process="INSERT INTO `vehicle_allotment_process` (`token_no`, `emp_id`, `name`, `designation`, `college`, `department`, `forward_emp_id`, `farward_name`, `farward_designation`, `farward_college`, `farward_department`, `remarks`, `date_time`, `action`) VALUES ( '$TokenNo', '$user_auth[$user_flow_id1]', '$Name', ' $Designation', '$CollegeName', '$Department', NULL, '', '', '', '', NULL, '$timeStamp', '0');";
      $insert_request_process_run=mysqli_query($conn,$insert_request_process);
      $user_flow_id1=$user_flow_id1+1;
        $status_update_after_forward="UPDATE vehicle_allotment SET status='3',flow_index1='$user_flow_id1'  where token_no='$TokenNo'";
      mysqli_query($conn,$status_update_after_forward);
      }
     }
      if ( $insert_request_process_run==true) 
      {
      echo "1";   // success
      }
      else
      {
         echo "0"; // error
      }

   }
   else
   {
echo "3"; // flow set please
   }
     
 
 } 
 elseif($code==49)
 {
$userId=$_POST['userId'];
$TokenNo=$_POST['token'];
$forward_remarks=$_POST['comment_reject'];

      
        $action_update_after_forward="UPDATE vehicle_allotment_process SET date_time='$timeStamp', remarks='$forward_remarks', action='2' where token_no='$TokenNo' and emp_id='$EmployeeID'";

      $insert_request_process_run=mysqli_query($conn,$action_update_after_forward);

      $action_update_after_forward1="UPDATE vehicle_allotment SET  status='2' where token_no='$TokenNo' ";
      mysqli_query($conn,$action_update_after_forward1);

      
      

      if ( $insert_request_process_run==true) 
      {
      echo "1";   // success
      }
      else
      {
         echo "0"; // error
      }
}
   
   elseif($code==50)
   {
      $get_category="SELECT CategoryId,CategoryFName FROM CategoriesEmp ";
      $get_category_run=sqlsrv_query($conntest,$get_category);
      while($row=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
      {
         $Emp_category=$row['CategoryId'];
         $check_count_emp_category_wise="SELECT * FROM Staff Where JobStatus='1' and CategoryId='$Emp_category'";
         $check_count_emp_category_wise_run=sqlsrv_query($conntest,$check_count_emp_category_wise,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
         $emp_count=sqlsrv_num_rows($check_count_emp_category_wise_run);

 
 ?>
               <li class="nav-item " onclick="show_emp_all(<?=$Emp_category;?>);">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> <?=$row['CategoryFName'];?>
                    <span class="badge bg-primary float-right"><?=$emp_count;?></span>
                  </a>
                </li>
                <?php 
      }
      
     


 //      print_r($category);
   }
   elseif($code==51)
   {?><table class="table table-head-fixed" id="example" >
   <thead>
      <tr>
         <th>SrNo</th>
         <th>Image</th>
         <th>EmpID</th>
         <th>Name</th>
         <th>Designation</th>
         <th>Department</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php 
      $sr=1;
      $CategoryId=$_POST['CategoryId'];
      $get_category="SELECT * FROM Staff where CategoryId='$CategoryId' and JobStatus='1'";
      $get_category_run=sqlsrv_query($conntest,$get_category);
      while($row=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
      {
          $emp_pic=base64_encode($row['Snap']);
                  


         ?>

      <tr>
         <td><?=$sr;?></td>
         <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?></td>
         <td><?=$row['Name'];?></td>
         <td><?=$row['IDNo'];?></td>
         <td><?=$row['Designation'];?></td>
         <td><?=$row['Department'];?></td>
         <td><i class="fa fa-edit fa-lg"></i></td>
      </tr>
   
      <?php $sr++; }?>
   </tbody>
</table><?php 
   }
      elseif($code==52)
   {
     $check_count_emp_category_wise="SELECT IDNo FROM Staff Where JobStatus='1'";
         $check_count_emp_category_wise_run=sqlsrv_query($conntest,$check_count_emp_category_wise,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
         $emp_count_active=sqlsrv_num_rows($check_count_emp_category_wise_run);

          $check_count_status_wise="SELECT IDNo FROM Staff Where JobStatus='2'";
         $check_count_status_wise_run=sqlsrv_query($conntest,$check_count_status_wise,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
         $emp_count_left=sqlsrv_num_rows($check_count_status_wise_run);
 
 ?>
               <li class="nav-item " onclick="show_emp_all_status(1);">
                  <a href="#" class="nav-link" >
                    <i class="fas fa-inbox"></i> Active
                    <span class="badge bg-primary float-right"><?=$emp_count_active;?></span>
                  </a>
                </li>
                <li class="nav-item " onclick="show_emp_all_status(2);">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> Left
                    <span class="badge bg-primary float-right"><?=$emp_count_left;?></span>
                  </a>
                </li>
                <?php 
      
      
     


 //      print_r($category);
   }
   elseif($code==53)
   {?><table class="table table-head-fixed" id="example" >
   <thead>
      <tr>
         <th>SrNo</th>
         <th>Image</th>
         <th>EmpID</th>
         <th>Name</th>
         <th>Designation</th>
         <th>Department</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php 
      $sr=1;
      $status=$_POST['status'];
      $get_category="SELECT * FROM Staff where  JobStatus='$status'";
      $get_category_run=sqlsrv_query($conntest,$get_category);
      while($row=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
      {
          $emp_pic=base64_encode($row['Snap']);

         ?>
      <tr>
         <td><?=$sr;?></td>
         <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?></td>
         <td><?=$row['Name'];?></td>
         <td><?=$row['IDNo'];?></td>
         <td><?=$row['Designation'];?></td>
         <td><?=$row['Department'];?></td>
         <td><i class="fa fa-edit fa-lg"></i></td>
      </tr>
   
      <?php $sr++; }?>
   </tbody>
</table><?php 
   }
      elseif($code==54)
   {
      $get_category="SELECT role_name,id FROM role_name ";
      $get_category_run=mysqli_query($conn,$get_category);
      while($row=mysqli_fetch_array($get_category_run))
      {
         $role_id=$row['id'];
         $check_count_role_wise="SELECT * FROM user Where role_id='$role_id'";
         $check_count_emp_category_wise_run=mysqli_query($conn,$check_count_role_wise);
         $emp_count_status=mysqli_num_rows($check_count_emp_category_wise_run);
 ?>
               <li class="nav-item " onclick="show_emp_all_role(<?=$role_id;?>);">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> <?=$row['role_name'];?>
                    <span class="badge bg-primary float-right"><?=$emp_count_status;?></span>
                  </a>
                </li>
                <?php 
      }
      
     


 //      print_r($category);
   }
    elseif($code==55)
   {?><table class="table table-head-fixed" id="example" >
   <thead>
      <tr>
         <th>SrNo</th>
         <th>Image</th>
         <th>EmpID</th>
         <th>Name</th>
         <th>Designation</th>
         <th>Department</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php 
      $sr=1;
      $role_id=$_POST['role'];
      $get_category="SELECT emp_id FROM user where  role_id='$role_id'";
      $get_category_run=mysqli_query($conn,$get_category);
      while($row=mysqli_fetch_array($get_category_run))
      {
          $emp_id=$row['emp_id'];
          $get_category1="SELECT * FROM Staff where  IDNo='$emp_id' and JobStatus='1'";
      $get_category_run1=sqlsrv_query($conntest,$get_category1);
      if($row1=sqlsrv_fetch_array($get_category_run1,SQLSRV_FETCH_ASSOC))
      { 
          $emp_pic=base64_encode($row1['Snap']);
         ?>
      <tr>
         <td><?=$sr;?></td>
         <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?></td>
         <td><?=$row1['Name'];?></td>
         <td><?=$row1['IDNo'];?></td>
         <td><?=$row1['Designation'];?></td>
         <td><?=$row1['Department'];?></td>
         <td><i class="fa fa-edit fa-lg"></i></td>
      </tr>
   
      <?php $sr++;
       } }?>
   </tbody>
</table><?php 
   }
         elseif($code==56)
   {
      $get_category="SELECT Distinct CollegeName,CollegeID FROM MasterCourseCodes   ";
      $get_category_run=sqlsrv_query($conntest,$get_category);
      while($row=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
      {
      
   $CollegeID=$row['CollegeID'];
             $check_college_emp="SELECT * FROM Staff  Where  CollegeId='$CollegeID'";
         $check_college_emp_run=sqlsrv_query($conntest,$check_college_emp,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
         $emp_counsst_college=sqlsrv_num_rows($check_college_emp_run);
 ?> 
                  
         <div class="card ">
            <div class="card-header" style="background-color:white!important; color: black !important;">
              <h3 class="card-title" style="font-size: 14px!important"><b><?=$row['CollegeName'];?></b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" >
                  <i class="fas fa-edit" onclick="AddleaveAuthority(<?=$CollegeID;?>);"></i>
                </button> <button type="button" class="btn btn-tool" data-card-widget="collapse" >
                  <i class="fas fa-plus" onclick="show_all_depaertment(<?=$CollegeID;?>);"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0" style="min-height: 0px!important; overflow: hidden !important;" >
                <ul class="nav nav-pills flex-column" id="department_wise_show<?=$CollegeID;?>">
                  
            </ul>
            </div>
            <!-- /.card-body -->
          </div> 
                <!-- </li>  -->
                <?php 
      }
   }     
       elseif($code==57)
   {
      
   $collegeId=$_POST['collegeId'];
     

             $check_college_emp="SELECT * FROM MasterDepartment  Where  CollegeId='$collegeId'";
         $check_college_emp_run=sqlsrv_query($conntest,$check_college_emp,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
      
          while($row=sqlsrv_fetch_array($check_college_emp_run,SQLSRV_FETCH_ASSOC))
                {
          $departmentid=$row['Id'];
            $emp_count="SELECT * FROM Staff  Where  DepartmentID='$departmentid' and CollegeId='$collegeId'";
         $emp_count_run=sqlsrv_query($conntest,$emp_count,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
          $emp_counsst_college=sqlsrv_num_rows($emp_count_run);
 ?> 
            <li class="nav-item " onclick="show_emp_all_department(<?=$collegeId;?>,<?=$departmentid;?>);">
                  <a href="#" class="nav-link">
                    <i class="fas fa-inbox"></i> <?=$row['Department'];?>
                    <span class="badge bg-primary float-right"><?=$emp_counsst_college;?></span>
                  </a>
                </li>
               
                <?php 
      }
   }

      // print_r($aaa);
   
      elseif($code==58)
   {
   ?><table class="table table-head-fixed" id="example" >
   <thead>
      <tr>
         <th>SrNo</th>
         <th>Image</th>
         <th>EmpID</th>
         <th>Name</th>
         <th>Designation</th>
         <th>Department</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php 
      $sr=1;
      $department=$_POST['department'];
      $collegeId=$_POST['collegeId'];
    
          $get_category1="SELECT * FROM Staff where  CollegeId='$collegeId' and DepartmentID='$department' and JobStatus='1'";
      $get_category_run1=sqlsrv_query($conntest,$get_category1);
      while($row1=sqlsrv_fetch_array($get_category_run1,SQLSRV_FETCH_ASSOC))
      { 
          $emp_pic=base64_encode($row1['Snap']);
         ?>
      <tr>
         <td><?=$sr;?></td>
         <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?></td>
         <td><?=$row1['Name'];?></td>
         <td><?=$row1['IDNo'];?></td>
         <td><?=$row1['Designation'];?></td>
         <td><?=$row1['Department'];?></td>
         <td><i class="fa fa-edit fa-lg"></i></td>
      </tr>
   
      <?php $sr++;
       } ?>
   </tbody>
</table><?php 
   }
      elseif($code==59)
   {
       $search = $_POST['empID'];
?><table class="table table-head-fixed" id="example" >
   <thead>
      <tr>
         <th>SrNo</th>
         <th>Image</th>
         <th>EmpID</th>
         <th>Name</th>
         <th>Designation</th>
         <th>Department</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php 
      $sr=1;
       $query = "SELECT * FROM Staff Where (IDNo like '%".$search."%' or Name like '%".$search."%') and JobStatus='1'";
       $result = sqlsrv_query($conntest,$query);
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
          $emp_pic=base64_encode($row['Snap']);
         if ($row['ContactNo']!='') 
         {
            $mobile=$row['ContactNo'];
         }
         else
         {
            $mobile=$row['MobileNo'];
         }?>
         <tr>
         <td><?=$sr;?></td>
         <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?></td>
         <td><?=$row['Name'];?></td>
         <td><?=$row['IDNo'];?></td>
         <td><?=$row['Designation'];?></td>
         <td><?=$row['Department'];?></td>
         <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row['IDNo'];?>);"></i></td>
      </tr>
   <?php $sr++;
         }
       ?>
   </tbody>
</table><?php 
       
   }
         elseif($code==60)
   {
   ?><table class="table table-head-fixed" id="example" >
   <thead>
      <tr>
         <th>SrNo</th>
         <th>Image</th>
         <th>EmpID</th>
         <th>Name</th>
         <th>Designation</th>
         <th>Department</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody>
      <?php 
      $sr=1;
      $empID=$_POST['empID'];
     
          $get_category1="SELECT * FROM Staff where  IDNo='$empID' and  JobStatus='1'";
      $get_category_run1=sqlsrv_query($conntest,$get_category1);
      while($row1=sqlsrv_fetch_array($get_category_run1,SQLSRV_FETCH_ASSOC))
      { 
          $emp_pic=base64_encode($row1['Snap']);
         ?>
      <tr>
         <td><?=$sr;?></td>
         <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?></td>
         <td><?=$row1['Name'];?></td>
         <td><?=$row1['IDNo'];?></td>
         <td><?=$row1['Designation'];?></td>
         <td><?=$row1['Department'];?></td>
         <td><i class="fa fa-edit fa-lg"></i></td>
      </tr>
   
      <?php $sr++;
       } ?>
   </tbody>
</table><?php 
   }
   elseif($code==61)
   {
   ?> <section class="content">
      <div class="container-fluid">
          <div class="row" style="margin-top: 10px!important;">

          <div class="col-md-12">
            <table class="table">
               <thead>
                    <tr>
        
         <th>Image</th>
         <th>EmpID</th>
         <th>Name</th>
         <th>Designation</th>
         <th>College</th>
         <th>Department</th>
         <th>Action</th>
      </tr>
               </thead>
               <tbody>
                  <?php 
           $emp_id=$_POST['empID'];
            $emp_count="SELECT * FROM Staff  Where  IDNo='$emp_id' and JobStatus='1'";
         $emp_count_run=sqlsrv_query($conntest,$emp_count,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
          $emp_counsst_college=sqlsrv_num_rows($emp_count_run);
          if($row1=sqlsrv_fetch_array($emp_count_run,SQLSRV_FETCH_ASSOC))
          {
          $emp_pic=base64_encode($row1['Snap']);

 ?> 
      <tr>
         
         <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?></td>
         <td><?=$row1['Name'];?></td>
         <td><?=$row1['IDNo'];?></td>
         <td><?=$row1['Designation'];?></td>
         <td><?=$row1['CollegeId'];?></td>
         <td><?=$row1['DepartmentID'];?></td>
         <td><i class="fa fa-edit fa-lg"></i></td>
      </tr>
   
               </tbody>
            </table>
          </div>
       </div>
        <div class="row" style="margin-top: 10px!important;">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2" style="background-color:white!important">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#personal_details" data-toggle="tab">Basic</a></li>
                  <li class="nav-item"><a class="nav-link" href="#contact" data-toggle="tab">Contact</a></li>
                  <li class="nav-item"><a class="nav-link" href="#employment" data-toggle="tab">Employment</a></li>
                </ul>
             </div>
              
             <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="personal_details">
                 
  
    <!-- /.login-logo -->
   
        <form>
          <div class="row">
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="loginId">Login ID</label>
                <input type="text" class="form-control" id="loginId" placeholder="Enter login ID">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" value="<?=$row1['Name'];?>">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="fatherName">Father's Name</label>
                <input type="text" class="form-control" id="fatherName" placeholder="Enter father's name" value="<?=$row1['FatherName'];?>">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="motherName">Mother's Name</label>
                <input type="text" class="form-control" id="motherName" placeholder="Enter mother's name" value="<?=$row1['MotherName'];?>">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" id="designation" placeholder="Enter designation" value="<?=$row1['Designation'];?>">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="text" class="form-control" id="dob" placeholder="mm/dd/yyyy" value="">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender">
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category">
                  <option>SC</option>
                  <option>ST</option>
                  <option>OBC</option>
                  <option>General</option>
                </select>
              </div>
            </div>
          
         
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="panNumber">PAN Card Number</label>
                <input type="text" class="form-control" id="panNumber" placeholder="Enter PAN card number" value="<?=$row1['PANNo'];?>">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="panCard">Upload PAN Card</label>
                <input type="file" class="form-control-file" id="panCard">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="aadharNumber">Aadhar Card Number</label>
                <input type="text" class="form-control" id="aadharNumber" value="<?=$row1['AadhaarCard'];?>" placeholder="Enter Aadhar card number">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="aadharCard">Upload Aadhar Card</label>
                <input type="file" class="form-control-file" id="aadharCard">
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="personalIdentificationMark"> Identification Mark</label>
                <textarea rows="1"  class="form-control" id="personalIdentificationMark"  rows="3"><?=$row1['PersonalIdentificationMark'];?></textarea>
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="nationality">Nationality</label>
                <input type="text" class="form-control" id="nationality"  value="Indian" readonly>
              </div>
            </div>
            <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image">
              </div>
            </div>
               <div class="col-12 col-lg-3">
              <div class="form-group">
                <label for="signature">Upload Signature</label>
                <input type="file" class="form-control-file" id="signature">
              </div>
            </div>
          </div>
         
        </form>

   
 
                   
                  </div>
                 
                  <div class="tab-pane" id="contact">
                 
   
        <form>
          <div class="row">
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="personalEmail">Personal Email ID</label>
                <input type="email" class="form-control" id="personalEmail" placeholder="Enter personal email" value="<?=$row1['EmailID'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="officialEmail">Official Email ID</label>
                <input type="email" class="form-control" id="officialEmail" placeholder="Enter official email" value="<?=$row1['OfficialEmailID'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="mobileNumber">Mobile Number</label>
                <input type="text" class="form-control" id="mobileNumber" placeholder="Enter mobile number" value="<?=$row1['MobileNo'];?>"> 
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="whatsappNumber">WhatsApp Number</label>
                <input type="text" class="form-control" id="whatsappNumber" placeholder="Enter WhatsApp number" value="<?=$row1['WhatsAppNumber'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="emergencyContactNumber">Emergency Contact Number (If Any)</label>
                <input type="text" class="form-control" id="emergencyContactNumber" placeholder="Enter emergency contact number" value="<?=$row1['EmergencyContactNo'];?>">  
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="officialMobileNumber">Official Mobile Number (If Any)</label>
                <input type="text" class="form-control" id="officialMobileNumber" placeholder="Enter official mobile number" value="<?=$row1['OfficialMobileNo'];?>">
              </div>
            </div> 
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="addressLine1">Address Line 1</label>     
                <input type="text" class="form-control" id="addressLine1" placeholder="Enter address line 1" value="<?=$row1['AddressLine1'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="addressLine2">Address Line 2</label>
                <input type="text" class="form-control" id="addressLine2" placeholder="Enter address line 2" value="<?=$row1['AddressLine2'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="permanentAddress">Permanent Address</label>
                <input type="text" class="form-control" id="permanentAddress" placeholder="Enter permanent address" value="<?=$row1['PermanentAddress'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="correspondenceAddress">Correspondence Address</label>
                <input type="text" class="form-control" id="correspondenceAddress" placeholder="Enter correspondence address" value="<?=$row1['CorrespondanceAddress'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="state">State</label>
                <select class="form-control" id="state">
                  <option>Punjab</option>
                  <option>Haryana</option>
                  <option>Delhi</option>
                  <!-- Add more options as needed -->
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="district">District</label>
                <input type="text" class="form-control" id="district" placeholder="Enter district">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="postalCode">Postal Code</label>
                <input type="text" class="form-control" id="postalCode" placeholder="Enter postal code">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="postOffice">Post Office</label>
                <input type="text" class="form-control" id="postOffice" placeholder="Enter post office">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="villageCity">Village/City</label>
                <input type="text" class="form-control" id="villageCity" placeholder="Enter village/city">
              </div>
            </div>
          </div>
          
        </form>
   
                   
                  </div>
                  

                  <div class="tab-pane" id="employment">
                  <form>
          <div class="row">
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="organisationName">Name of Organisation</label>
                <input type="text" class="form-control" id="organisationName" placeholder="Enter organisation name" value="<?=$row1['CollegeName'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="departmentName">Name of Department</label>
                <input type="text" class="form-control" id="departmentName" placeholder="Enter department name" value="<?=$row1['Department'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" id="designation" placeholder="Enter designation" value="<?=$row1['Designation'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="joiningDate">Date of Appointment/Joining</label>
                <input type="date" class="form-control" id="joiningDate" value="">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="leavingDate">Date of Leaving</label>
                <input type="date" class="form-control" id="leavingDate">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="salary">Salary Decided</label>
                <input type="text" class="form-control" id="salary" placeholder="Enter salary" value="<?=$row1['SalaryAtPresent'];?>">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="employmentType">Type of Employment</label>
                <input type="text" class="form-control" id="employmentType" placeholder="Enter employment type">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="employmentStatus">Status of Employment</label>
                <input type="text" class="form-control" id="employmentStatus" placeholder="Enter employment status">
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <div class="form-group">
                <label for="leaveSanctionAuthority">Leave Sanction Authority</label>
                <input type="text" class="form-control" id="leaveSanctionAuthority" placeholder="Enter leave sanction authority" value="<?=$row1['LeaveRecommendingAuthority'];?>"> 
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <div class="form-group">
                <label for="leaveRecommendingAuthority">Leave Recommending Authority </label>
                <input type="text" class="form-control" id="leaveRecommendingAuthority" placeholder="Enter leave recommending authority" value="<?=$row1['LeaveSanctionAuthority'];?>">
              </div>
            </div>
            <div class="col-lg-4 col-12">
              <div class="form-group">
                <label for="appointmentLetter">Upload Appointment Letter</label>
                <input type="file" class="form-control-file" id="appointmentLetter">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="bankAccountNo">Bank Account No</label>
                <input type="text" class="form-control" id="bankAccountNo" placeholder="Enter bank account number">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="passbookCopy">Upload Passbook Copy</label>
                <input type="file" class="form-control-file" id="passbookCopy">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="employeeBankName"> Bank Name</label>
                <input type="text" class="form-control" id="employeeBankName" placeholder="Enter employee bank name">
              </div>
            </div>
            <div class="col-lg-3 col-12">
              <div class="form-group">
                <label for="bankIFSC">Bank IFSC code</label>
                <input type="text" class="form-control" id="bankIFSC" placeholder="Enter bank IFSC code">
              </div>
            </div>
          </div>
        </form>
                  </div>
               
      <?php $sr++;
      // $aaa[]=$row1;
       }
       // print_r($aaa);

       ?> 
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="row">
             <div class="col-lg-12">
             <div class="col-lg-4"></div>
            <div class="col-lg-4">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
             <div class="col-lg-4"></div>
          </div>
       </div>
            
        </div>
       
           
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
   
               
                <?php 
      
   }
    elseif($code==62)
   {

          $collegeId=$_POST['collegeId'];
             $check_college_emp="SELECT * FROM MasterDepartment  Where  CollegeId='$collegeId'";
        $check_college_emp_run=sqlsrv_query($conntest,$check_college_emp,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
      
          while($row=sqlsrv_fetch_array($check_college_emp_run,SQLSRV_FETCH_ASSOC))
      {
         // $aaa[]=$row;
           $departmentid=$row['Id'];
        $get_leave_auth="SELECT * FROM leave_authority where DepartmentID='$departmentid' and CollegeID='$collegeId'";
       $get_leave_auth_run=mysqli_query($conn,$get_leave_auth);
       if($row_auth=mysqli_fetch_array($get_leave_auth_run))
       {

      
 ?>        
               
<div class="row form-group container-fluid">
<div class="col-lg-4">
   <label>Department</label>
   <input type="text"   class="form-control" value="<?=$row['Department'];?>" disabled>
   <input type="text" id="collegeId" value="<?=$collegeId;?>">
   <input type="text" id="Department" value="<?=$departmentid;?>">
</div>
<div class="col-lg-3">
   <label>Recommending</label>
   <input type="text" id="Recommending<?=$departmentid;?>"  class="form-control" value="<?=$row_auth['Recommending'];?>">
   
</div>
<div class="col-lg-3">
   <label>Section</label>
   <input type="text" id="Senction<?=$departmentid;?>"  class="form-control" value="<?=$row_auth['Senction'];?>">
   
</div>
<div class="col-lg-2">
  <label>Action</label><br>
   <input type="button" onclick="update_leave_authority(<?=$collegeId;?>,<?=$departmentid;?>);"  class="btn btn-primary" value="Update">

</div>
</div>
                <?php 
      }
      }?>
<div class="row"><div class="col-lg-12">
   <center><button class="btn btn-info" onclick="sync_leave_auth(<?=$collegeId;?>)">Sync</button></center></div></div>
  <?php     }
   elseif($code==63)
   {
      $collegeId=$_POST['collegeId'];
      $departmentid=$_POST['department'];
      $Recommend=$_POST['Recommending'];
      $Senction=$_POST['Senction'];

    echo    $insert_leave_authority="UPDATE leave_authority SET Recommending='$Recommend',Senction='$Senction' WHERE CollegeID='$collegeId' and DepartmentID='$departmentid'";
      $insert_leave_authority_run=mysqli_query($conn,$insert_leave_authority);
if ($insert_leave_authority_run==true)
 {
echo "1";   // code...
}
else
{
   echo "0";
}

   }
   elseif($code==64)
   {
      $collegeId=$_POST['collegeId'];
$select_department="SELECT * FROM leave_authority where CollegeID='$collegeId' ";
$select_department_run=mysqli_query($conn,$select_department);
while($row=mysqli_fetch_array($select_department_run))
{
   $CollegeID=$row['CollegeID'];
   $departmentid=$row['DepartmentID'];
   $Senction=$row['Senction'];
   $Recommending=$row['Recommending'];
   if ($Senction!='0' && $Recommending!='0' ) {
 echo $update_auth="UPDATE Staff SET LeaveSanctionAuthority='$Recommending' ,LeaveRecommendingAuthority='$Senction' where DepartmentID='$departmentid' and CollegeId='$CollegeID'";
  $update_auth_run=sqlsrv_query($conntest,$update_auth);

}
else
{

}
}
          
   }

    elseif($code==65) // PENDING verification apporove
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php  $sr=1; $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='0'"; 
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification_approve(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }

     elseif($code==66) // APPROVE verification apporove
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php 
              $sr=1; 
              $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='1'"; 
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification_approve(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }
      elseif($code==67) // REJECT verification apporove
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php 
              $sr=1; 
              $get_pending="SELECT * FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='2'"; 
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification_approve(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }

  elseif($code==68) // allotment 
 {
$userId=$_POST['userId'];
$id=$_POST['id'];
$TokenNo=$_POST['token'];
$type=$_POST['type'];
$vehicle_name=$_POST['vehicle_name'];
$driver=$_POST['driver'];

        $status_update_after_forward="UPDATE vehicle_allotment SET status='5',vehicle_alloted_id='$vehicle_name' where token_no='$TokenNo'";
      mysqli_query($conn,$status_update_after_forward);
$set_status_4="SELECT * FROM vehicle_allotment_process WHERE token_no='$TokenNo' ORDER BY id DESC LIMIT 1";
$set_status_4_run=$conn->query($set_status_4);
if($set_status_4_run_row=mysqli_fetch_array($set_status_4_run))
{
        $action_update_after_forward="UPDATE vehicle_allotment_process SET remarks='Alloted',date_time='$timeStamp', action='5' where token_no='$TokenNo' and id='".$set_status_4_run_row['id']."'";
      mysqli_query($conn,$action_update_after_forward);

}

    $get_dates="SELECT journey_start_date,journey_end_date FROM vehicle_allotment where token_no='$TokenNo'";
    $get_dates_run=$conn->query($get_dates);
    if($row=mysqli_fetch_array($get_dates_run))
    {
      $journey_start_date=$row['journey_start_date'];
      $journey_end_date=$row['journey_end_date'];
 $dates_update_after_forward="INSERT into  vehicle_book_details SET vehicle_id='$vehicle_name',from_date='$journey_start_date',to_date='$journey_end_date',driver_id='$driver'";
     $insert_request_process_run= mysqli_query($conn,$dates_update_after_forward);
    }
        
      

      if ( $insert_request_process_run==true) 
      {
      echo "1";   // success
      }
      else
      {
         echo "0"; // error
      }

   }
   elseif($code==69)
   {
$id=$_POST['id'];


$get_cehicle="SELECT * FROM vehicle where type_id='$id'";
$get_cehicle_run=$conn->query($get_cehicle);
while($row_v=mysqli_fetch_array($get_cehicle_run))
{?>
<option value="<?=$row_v['id'];?>"><?=$row_v['name'];?>&nbsp;(<?=$row_v['vehicle_number'];?>)</option>
<?php }
      
    
   

 }
   elseif($code==70)  // allotemented
 {

   ?>
<table class="table" id="example">
      
          <thead>
            <tr>
              <th>#</th>
              <th>Token</th>
              <th>Subject</th>
              <th>Date</th>
             
            </tr>
          </thead>
          <tbody>
             <?php  $sr=1; $get_pending="SELECT * FROM vehicle_allotment where  status='5'"; 
                  $get_pending_run=mysqli_query($conn,$get_pending);
                  while($get_row=mysqli_fetch_array($get_pending_run))
                  {
             ?>
            <tr>
              <td><?=$sr;?></td>
              <td onclick="show_timeline_verification_alott(<?=$get_row['token_no'];?>);"><?=$get_row['token_no'];?></td>
              <td><?=$get_row['vehicle_type'];?></td>
              <td><?=$get_row['submit_date_time'];?></td>
             
            </tr>

         <?php $sr++; }?>
          </tbody>
      
      </table>
 <?php }
  elseif($code==71)
 {
$userId=$_POST['userId'];
$TokenNo=$_POST['token'];
$forward_remarks=$_POST['forward_remarks'];

      $check_flow_auth="SELECT * FROM flow_auth where type='Transport'";
      $check_flow_auth_run=mysqli_query($conn,$check_flow_auth);
      if($check_flow_auth_row=mysqli_fetch_array($check_flow_auth_run))
      {
                   $check_flow="SELECT * FROM  vehicle_allotment  Where emp_id='$userId' AND token_no='$TokenNo'";
   $check_flow_run=mysqli_query($conn,$check_flow);
   if($check_flow_row=mysqli_fetch_array($check_flow_run))
   {
$user_flow_id=$check_flow_row['flow_index1'];
   }
         $user_auth_str=$check_flow_auth_row['flow'];
         $user_auth=explode(",",$user_auth_str);

         $get_auth_details="SELECT Name,Department,CollegeName,Designation FROM Staff Where IDNo='".$user_auth[$user_flow_id]."'";
      $get_auth_details_run=sqlsrv_query($conntest,$get_auth_details);
      if ($get_auth_details_row=sqlsrv_fetch_array($get_auth_details_run,SQLSRV_FETCH_ASSOC)) {
         $Name=$get_auth_details_row['Name'];
         $Designation=$get_auth_details_row['Designation'];
         $CollegeName=$get_auth_details_row['CollegeName'];
         $Department=$get_auth_details_row['Department'];
      }
        $status_update_after_forward="UPDATE vehicle_allotment SET status='4',flow_index1='$user_flow_id' where token_no='$TokenNo'";
      mysqli_query($conn,$status_update_after_forward);

      $action_update_after_forward="UPDATE vehicle_allotment_process SET forward_emp_id='$user_auth[$user_flow_id]',farward_name='$Name',farward_designation='$Designation',farward_college='$CollegeName',farward_department='$Department',remarks='$forward_remarks', action='1' where token_no='$TokenNo' and emp_id='$EmployeeID'";
      mysqli_query($conn,$action_update_after_forward);

         $insert_request_process="INSERT INTO `vehicle_allotment_process` (`token_no`, `emp_id`, `name`, `designation`, `college`, `department`, `forward_emp_id`, `farward_name`, `farward_designation`, `farward_college`, `farward_department`, `remarks`, `date_time`, `action`) VALUES ( '$TokenNo', '$user_auth[$user_flow_id]', '$Name', ' $Designation', '$CollegeName', '$Department', NULL, '', '', '', '', NULL, '$timeStamp', '0');";
      $insert_request_process_run=mysqli_query($conn,$insert_request_process);
      }

  
      if ( $insert_request_process_run==true) 
      {
      echo "1";   // success
      }
      else
      {
         echo "0"; // error
      }

   }
   elseif($code==72)
   {
$TokenNo=$_POST['Token_No'];
                $check_flow="SELECT status FROM  vehicle_allotment  Where token_no='$TokenNo'";
   $check_flow_run=mysqli_query($conn,$check_flow);
   if($check_flow_row=mysqli_fetch_array($check_flow_run))
   {

if ($check_flow_row['status']<=3)
 {
?>   <label class="btn btn-warning  btn-xs ">
                    <input type="radio" name="options" onclick="toggleDiv_approve();" id="option_a1" autocomplete="off"> Approve
                  </label> <label class="btn btn-danger btn-xs">
                    <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
                  </label> <?php   // code...
}
elseif($check_flow_row['status']==4)
{
?><label class="btn btn-success btn-xs">
                    <input type="radio" name="options" onclick="toggleDiv_allotment();" id="option_a3" autocomplete="off"> Allotment
                  </label>
                  <label class="btn btn-danger btn-xs">
                    <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
                  </label><?php
}
elseif($check_flow_row['status']>3)
{
?><label class="btn btn-primary btn-xs">
                    <input type="radio" name="options" onclick="" id="" autocomplete="off"> Print 
                  </label><?php
}
   }
      ?>

                
                  
                <?php
   } 

     elseif($code==73)
   {
$TokenNo=$_POST['Token_No'];
                $check_flow="SELECT status FROM  vehicle_allotment  Where token_no='$TokenNo'";
   $check_flow_run=mysqli_query($conn,$check_flow);
   if($check_flow_row=mysqli_fetch_array($check_flow_run))
   {

if ($check_flow_row['status']<2)
 {
?>    <label class="btn btn-warning  btn-xs ">
                    <input type="radio" name="options" onclick="toggleDiv_recommend();" id="option_a1" autocomplete="off"> Recommend
                  </label>
                    <label class="btn btn-danger btn-xs">
                    <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
                  </label> 
                  <?php   // code...
}
   }
      ?>

                
                  
                <?php
   }

   
   else
   {
   
   }
   }
   ?>     
