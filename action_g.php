<?php 
   session_start(); 
   ini_set('max_execution_time', '0');
      if(!(ISSET($_SESSION['usr']))) 
      {     
   ?>
<script>
window.location.href = 'index.php';
</script>
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
window.location.href = "index.php";
</script>
<?php }



   include "connection/connection.php";
       $employee_details="SELECT IDNo,Name,Department,CollegeName,Designation,LeaveRecommendingAuthority,LeaveSanctionAuthority FROM Staff Where IDNo='$EmployeeID'";
      $employee_details_run=sqlsrv_query($conntest,$employee_details);
      if ($employee_details_row=sqlsrv_fetch_array($employee_details_run,SQLSRV_FETCH_ASSOC)) {
         $Emp_Name=$employee_details_row['Name'];
         $Emp_Designation=$employee_details_row['Designation'];
         $Emp_CollegeName=$employee_details_row['CollegeName'];
         $Emp_Department=$employee_details_row['Department'];

        //    $Authority=$employee_details_row['LeaveRecommendingAuthority'];
        //   $Recommend=$employee_details_row['LeaveSanctionAuthority'];

         $Authority=$employee_details_row['LeaveSanctionAuthority'];
         $Recommend=$employee_details_row['LeaveRecommendingAuthority']; //new
         if($Emp_Designation=='Vice Chancellor')
         {
            $ViceChancellor=$employee_details_row['IDNo'];
         }
      }
      else
      {
         // echo "inter net off";
      }

      $getRole = mysqli_query($conn,"SELECT * FROM user  where emp_id=$EmployeeID");
      if($row=mysqli_fetch_array($getRole)) 
      {
          $role_id = $row['role_id'];
      }
   
      function getEmployeeName($emplid) 
      {
        include "connection/connection.php";
        $getEmplyeeDetailsWithFunction="SELECT Name FROM Staff Where IDNo='$emplid'";
        $getEmplyeeDetailsWithFunction_run=sqlsrv_query($conntest,$getEmplyeeDetailsWithFunction);
        if ($getEmplyeeDetailsWithFunction_row=sqlsrv_fetch_array($getEmplyeeDetailsWithFunction_run,SQLSRV_FETCH_ASSOC)) {
         echo  $getEmplyeeDetailsWithFunction_row['Name'];
        }
          
       }



   $code = $_POST['code'];
   if($code==224 )
{
       include "connection/ftp.php";
}
 if($code==94)
{
       include "connection/ftp-erp.php";
}
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
    <tbody>
        <?php
         while ($location_row=mysqli_fetch_array($location_run)) 
         {
         $location_num=$location_num+1;?>
        <tr>
            <td><input type="checkbox" class="checkbox v_check" value="<?=$location_row['l_id'];?>"></td>
            <td><?=$location_num;?></td>
            <td><?=$location_row['Name'];?>(<?=$location_row['l_id'];?>)</td>
            <td><?=$location_row['FloorName'];?></td>
            <td><?=$location_row['RoomType'];?>-<?=$location_row['RoomNo'];?> <b>(<?=$location_row['RoomName'];?>)</b>
            </td>
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
    <tbody>
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
            <td><?=$location_row['RoomType'];?>-<?=$location_row['RoomNo'];?> <b>(<?=$location_row['RoomName'];?>)</b>
            </td>
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
            <th data-toggle="modal" onclick="modal_khali(<?=$row['Id'];?>);" data-target="#exampleModalCenter">
                <b><?=$row['GroupName'];?></b>
            </th>
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
    </td>
    <td><?php 
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
         ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th style="width: 1%">
                    #
                </th>
                <th style="width: 20%">
                    Task Name
                </th>
                <th style="width: 25%">
                    Assign By
                </th>
                <th>
                    Task Progress
                </th>

                <th class="">
                    Status
                </th>
                <!--  <th style="width: 10%" class="text-center">
               Status
            </th> -->
                <th class="">
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
                    <br />
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
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0"
                            aria-valuemax="100" style="width: <?=$show_task_row['task_percentage'];?>">
                        </div>
                    </div>
                    <small>
                        <?=$show_task_row['task_percentage'];?> Complete
                    </small>
                </td>

                <td class="project-state">
                    <?php 
                  $status_up="SELECT * FROM task_master Where TokenNo='".$show_task_row['TokenNo']."'";
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
                <!-- <td >
               <input type="hidden" value="<?=$show_task_row['ID'];?>" name="id_status1[]"  id="id_status1">
                          <select class="form-control form-control-sm" name="change_status1[]" id="<?=$show_task_row['TokenNo'];?>_change_status1" onchange="task_submit_with_daily_report(<?=$show_task_row['TokenNo'];?>);" required>
                            
                             <option value="">Select</option>
                             <option value="3">Complete</option>
                             <option value="1">UnderProgress</option>
                            <option value="No">No Action</option> -->
                <!-- </select> -->
                <!-- </td>  -->
                <td class="project-actions ">
                    <a class="btn btn-success btn-sm" onclick="task_timeline(<?=$status_show['TokenNo'];?>);"
                        data-toggle="modal" data-target="#ViewTaskModal" href="#">
                        <i class="fa fa-eye fa-sm"></i>
                    </a>
                    <?php  if ($status_show['Status']==0)
                  {
                  ?>
                    <a class="btn btn-warning btn-sm" href="#" data-toggle="modal" data-target="#ForwardTaskModal"
                        onclick="forward_set_id(<?=$show_task_row['TokenNo'];?>);">
                        <i class="fa fa-share fa-sm" aria-hidden="true"></i>
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
    </table>
    <?php 
      }
      elseif($code==12)
      {
         ?>
    <table class="table table-striped ">
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
                </th>

                <th style="width: 8%" class="text-center">
                    Status
                </th>
                <th class="text-center">
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
                    <br />
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
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0"
                            aria-valuemax="100" style="width: <?=$show_task_row['task_percentage'];?>">
                        </div>
                    </div>
                    <small>
                        <?=$show_task_row['task_percentage'];?> Complete
                    </small>
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
                    <a class="btn btn-success btn-sm" onclick="task_timeline(<?=$status_show['TokenNo'];?>);"
                        data-toggle="modal" data-target="#ViewTaskModal" href="#">
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
                        <h3 class="timeline-header"><b><?=$createBy;?></b><b><?=$Self;?>
                                &nbsp;&nbsp;<?=$EmpName;?></b><a><?=$EmpID_U; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a><b><?=$AssignToempName;?></b><?=$AssignToempID; ?></a>
                        </h3>
                        <div class="timeline-body">
                            <?=$timeline_row['Description'];?>

                        </div>
                        <div class="timeline-footer">
                            <!-- <a class="btn btn-primary btn-sm">Read more</a>
                        <a class="btn btn-danger btn-sm">Delete</a> -->
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57"
                                    aria-valuemin="0" aria-valuemax="100"
                                    style="width: <?=$timeline_row['task_percentage'];?>">
                                </div>
                            </div>
                            <br>
                            <small>
                                <?=$timeline_row['task_percentage'];?> Complete
                            </small>
                            <?PHP 
                     if ($timeline_row['EmpID']==$EmployeeID and $timeline_row['Status']!=3) {
                        // code...
                     ?>
                            <div class="col-lg-3" style="float:right;">
                                <input type="hidden" value="<?=$timeline_row['ID'];?>" name="id_status1[]"
                                    id="id_status1">
                                <select class="form-control form-control-sm" name="change_status1[]"
                                    id="<?=$timeline_row['TokenNo'];?>_change_status1"
                                    onchange="task_submit_with_daily_report(<?=$timeline_row['TokenNo'];?>);" required>

                                    <option value="">Select</option>
                                    <option value="3">Complete</option>
                                    <option value="1">UnderProgress</option>
                                    <!-- <option value="No">No Action</option> -->
                                </select>
                            </div>
                            <?php }?>
                            <div class="row" style="display: none;">
                                <?php  if ( $timeline_row['Status']==3 && $timeline_row['AssignBy']==$EmployeeID && $timeline_row['marks']=='') 
                           {
                              // code...
                             ?>
                                <div class="col-lg-6">
                                    <label>Marks</label>
                                    <input type="number" placeholder="Marks " id="marks" class="form-control">
                                </div>
                                <div class="col-lg-6">
                                    <label>Remarks</label>
                                    <textarea name="" class="form-control" id="remarks"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <input type="button" value="Submit"
                                        onclick="submit_marks(<?=$timeline_row['ID'];?>)" class="btn btn-primary btn-xs"
                                        name="">
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
            $remarks =str_replace("'",'',$_POST['remarks']);
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
        ?>
    <div class="col-lg-12">
        <b style="color: red"> Date: <?php echo $submit_date; ?> </b> <br />
        <b style="color: black">Your Task </b> <br />
        <table class="table ">
            <tr>
                <th style="text-align: center;">SrNo</th>
                <th style="text-align: center;">Task Name</th>
                <th style="text-align: center;">Status</th>
            </tr>
            <?php
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
                <td style="text-align: center;"><?= $TaskName;?></td>
                <td style="text-align: center; color: <?=$clr;?>"><b><?= $tn_status;?></b></td>
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
                <td style="text-align: center;"><?= $naac;?></td>
            </tr>
        </table>
        <hr color="green" size="20px;">
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
          
        $Update_marks="UPDATE task_master SET Status='$change_status',CompleteDate='$CompleteDate',task_percentage='$task_percentage' where TokenNo='$ID'";
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
            <tr>
                <th>#</th>
                <th>Task Name</th>
                <th> Assign By</th>
                <th> Status</th>
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
                    <br />
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
                <td> <?php 
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
                    <?php }?>
                </td>
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
    </table>
    <?php
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
            <table class="table" style="border: 2px solid black">
                <tr>
                    <th>Srno</th>
                    <th> ID </th>
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
        <table class="table" style="border: 2px solid black">
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
            <tr>
                <th>
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
    </table>
    <?php
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
         $Noti_color="text-info";
      }
      elseif($Notification_type=='1')
      {
         $Noti_color="text-success";
      } 
      elseif($Notification_type=='2')
      {
         $Noti_color="text-warning";
      }
      elseif($Notification_type=='3')
      {
         $Noti_color="text-primary";
      }
      elseif($Notification_type=='5')
      {
         $Noti_color="text-danger";
      }
       else
      {
         $Noti_color="text-secondary";
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
      ?>
    <div class="dropdown-divider"></div>
    <a href="all-notification.php" class="dropdown-item dropdown-footer text-success"><b>See All Notifications</b></a><?php
      }
      elseif ($code==27)
      {
        $query_1 = "SELECT * FROM notifications WHERE Status=0 and EmpID='$EmployeeID' ";
       $result_1 = mysqli_query($conn, $query_1);
        $count = mysqli_num_rows($result_1);
       if($count>0)
       {
        echo  $count;
       }
       else
       {
         $count=0;
       }

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
        <tbody>
            <?php 
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
              ?>
            <tr>
                <td colspan="5">
                    <center>
                        <p style='color:red;'>No Record</p>
                    </center>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
    <?php 
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
        <tbody>
            <?php 
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
                <td><a href="<?=$row['Page_link'];?>"><?=$row['Subject'];?></a></td>
                <td><?=$row['Discriptions'];?></td>
                <td><?=$row['SendBy'];?></td>
                <td><?=$row['DateTime'];?></td>
                <td><button class="btn btn-warning btn-sm" onclick="mark_read(<?=$ID;?>);">Mark Read</button></td>
            </tr>
            <?php $sr++; }
            }
            else{
              ?>
            <tr>
                <td colspan="5">
                    <center>
                        <p style='color:red;'>No Record</p>
                    </center>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
    <?php
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
    window.location.href = "transport-vehicle-add.php";
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
                <th><img src="vehicle_image/<?=$row['image'];?>" width="100" height="70"></th>
                <th><?=$row['name_t'];?></th>
                <th><i class="fa fa-edit" onclick="update_vehicle_record(<?=$row['v_id'];?>);" data-toggle="modal"
                        data-target="#update_vehicle_modal"></i></th>
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
      
      $check_flow="SELECT * FROM flow_user Where emp_id='$EmployeeID' and type='1'";
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
         $check_flow_auth="SELECT * FROM flow_auth where type='1'";
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
            <?php  $sr=1; $get_requests="SELECT * ,vehicle_types.name as t_name FROM vehicle_allotment inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id where vehicle_allotment.emp_id='$EmployeeID' order by  vehicle_allotment.id DESC"; 
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
               $status_user_side="<b class='bg-warning'>Approved by Registrar</b>";
               }
               elseif($get_row['status']==5)
               {
                  
               $status_user_side="<b class='bg-success'>Allotted</b>";
               }
                elseif($get_row['status']==6)
               {
                  
               $status_user_side="<b class='bg-warning'>Forward To Registrar</b>";
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
                <td><?=$get_row['t_name'];?></td>
                <td><?=$status_user_side;?> </td>
                <td>
                    <button type="button" data-toggle="modal" data-target="#ViewRequestModal"
                        onclick="view_request_submit(<?=$get_row['token_no'];?>);" class="btn btn-info btn-sm "><i
                            class="fa fa-eye" aria-hidden="true"></i></button>
                    <?php if($get_row['status']==5)
                  {
                      $vehicle_id=$get_row['vehicle_alloted_id'];
                       $get_driver_details="SELECT * FROM vehicle_book_details  where vehicle_id='$vehicle_id'"; 
                  $get_driver_details_run=mysqli_query($conn,$get_driver_details);
                  if($get_driver_details_run_row=mysqli_fetch_array($get_driver_details_run))
                  {  
                  $driver_id=$get_driver_details_run_row['driver_id'];
                  $get_emp_driver="SELECT * FROM Staff Where IDNo='$driver_id' and JobStatus='1'";
                  $get_emp_driver_run=sqlsrv_query($conntest,$get_emp_driver);
                  if($row=sqlsrv_fetch_array($get_emp_driver_run,SQLSRV_FETCH_ASSOC))
                  {     
                     ?>
                    <a href="tel:<?=$row['MobileNo'];?>"><button type="button" class="btn btn-success btn-sm "><i
                                class="fa fa-phone" aria-hidden="true"></i>&nbsp;Driver</button></a>
                    <?php  }
                  }?>
                </td>
                <?php                      }?>
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php  $sr=1; $get_pending="SELECT *,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='0'"; 
         // and vehicle_allotment.status<3
            $get_pending_run=mysqli_query($conn,$get_pending);
            while($get_row=mysqli_fetch_array($get_pending_run))
            {
            
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php  $sr=1; $get_pending="SELECT *,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='1' ";

         // and vehicle_allotment.status<3
            $get_pending_run=mysqli_query($conn,$get_pending);
            while($get_row=mysqli_fetch_array($get_pending_run))
            {
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php  $sr=1; $get_pending="SELECT *,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment.status='2'";
            $get_pending_run=mysqli_query($conn,$get_pending);
            while($get_row=mysqli_fetch_array($get_pending_run))
            {
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            $sr=1; $get_pending="SELECT *,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id   where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='0'"; 
                $get_pending_run=mysqli_query($conn,$get_pending);
                while($get_row=mysqli_fetch_array($get_pending_run))
                {
            
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification_alott(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php  $sr=1;

          $get_pending="SELECT *,vehicle_types.name as v_name,vehicle_allotment.name AS 
e_name FROM vehicle_allotment_process inner join vehicle_allotment 
 ON vehicle_allotment_process.token_no=vehicle_allotment.token_no 
 inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id
   where vehicle_allotment_process.emp_id='$EmployeeID' 
and vehicle_allotment.status!='5' AND vehicle_allotment.status!='2'";  
            $get_pending_run=mysqli_query($conn,$get_pending);
            while($get_row=mysqli_fetch_array($get_pending_run))
            {
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification_alott(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php  $sr=1; $get_pending="SELECT *,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='2'"; 
            $get_pending_run=mysqli_query($conn,$get_pending);
            while($get_row=mysqli_fetch_array($get_pending_run))
            {
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification_alott(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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
            $get_details_token="SELECT * ,vehicle_types.name as t_name,vehicle_allotment.name as e_name FROM vehicle_allotment inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id where vehicle_allotment.token_no='$TokenNo'"; 
                        $get_details_token_run=mysqli_query($conn,$get_details_token);
                        if($get_row_token=mysqli_fetch_array($get_details_token_run))
                        {       
            ?>
            <div>
                <i class="fa fa-stop-circle bg-primary" aria-hidden="true"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i>
                        <?=date("d-m-Y h:i:A", strtotime($get_row_token['submit_date_time']));?></span>
                    <h3 class="timeline-header"><b>Request
                            by&nbsp;&nbsp;:&nbsp;&nbsp;<?=$get_row_token['emp_id'];?></b>&nbsp;&nbsp;<?=$get_row_token['e_name'];?>
                    </h3>
                    <div class="timeline-body table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Vehicle Name</th>
                            </tr>
                            <tr>
                                <td><?=$get_row_token['e_name'];?></td>
                                <td><?=$get_row_token['designation'];?></td>
                                <td><?=$get_row_token['department'];?></td>
                                <td><?=$get_row_token['t_name'];?></td>
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
                                <td><?=date("d-m-Y h:i:A", strtotime($get_row_token['journey_start_date']));?></td>
                                <td><?=date("d-m-Y h:i:A", strtotime($get_row_token['journey_end_date']));?></td>
                            </tr>
                        </table>
                        <input type="hidden" id="time_line_id" value="0">
                        <input type="hidden" id="time_line_token" value="<?=$TokenNo;?>">
                        <input type="hidden" id="time_line_userId" value="<?=$get_row_token['emp_id'];?>">
                        <input type="hidden" id="time_line_forward_remarks">
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
                    <span class="time"><i class="fas fa-clock"></i>
                        <?=date("d-m-Y h:i:A", strtotime($get_details_run_row['date_time']));?></span>
                    <p class="timeline-header">
                        <?=$Self;?>&nbsp;&nbsp;<?=$get_details_run_row['process_name'];?>&nbsp;(<?=$get_details_run_row['process_emp_id'];?>)<?=$forward_to_;?>
                    </p>
                    <!--   <div class="ribbon-wrapper ribbon-sm">
                  <div class="ribbon bg-primary ">
                    Complete
                  </div>
                  </div> -->
                    <div class="timeline-body">
                        <?php 
                     if ($get_details_run_row['remarks']!='')
                      {
                        echo "<b>Remarks: &nbsp;</b>".$get_details_run_row['remarks'];
                     }
                     else
                     {
                     
                     }
                     
                     
                     if ($get_details_run_row['action']==5)
                     {
                     // code...
                     $get_driver_details="SELECT * FROM  vehicle_allotment inner join vehicle_book_details  ON vehicle_allotment.token_no=vehicle_book_details.TokenNo  inner join vehicle ON vehicle.id=vehicle_allotment.vehicle_alloted_id   where vehicle_allotment.token_no='$TokenNo'"; 
                        $get_driver_details_run=mysqli_query($conn,$get_driver_details);
                        if($get_driver_details_run_row=mysqli_fetch_array($get_driver_details_run))
                        {  
                      $driver_id=$get_driver_details_run_row['driver_id'];
                       $get_emp_driver="SELECT * FROM Staff Where IDNo='$driver_id' and JobStatus='1'";
                     $get_emp_driver_run=sqlsrv_query($conntest,$get_emp_driver);
                     while($row=sqlsrv_fetch_array($get_emp_driver_run,SQLSRV_FETCH_ASSOC))
                     {?>
                        <div class="table-responsive">
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
                        </div>
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
    </div>
    <?php 
      }
      elseif($code==48)
      {
      $userId=$_POST['userId'];
      $TokenNo=$_POST['token'];
      $forward_remarks=$_POST['forward_remarks'];
      
           $check_flow="SELECT * FROM flow_user inner join vehicle_allotment ON flow_user.emp_id=vehicle_allotment.emp_id Where flow_user.emp_id='$userId' and vehicle_allotment.token_no='$TokenNo' and flow_user.type='1'";
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
           $check_flow_auth="SELECT * FROM flow_auth where type='1'";
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
             $status_update_after_forward="UPDATE vehicle_allotment SET status='6',flow_index1='$user_flow_id1'  where token_no='$TokenNo'";
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
      $forward_remarks=$_POST['forward_remarks'];
      
           
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
      {?>
    <table class="table table-head-fixed" id="example">
        <thead>
            <tr>
                <th>SrNo</th>
                <th>Image</th>
                <th>EmpID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Edit</th>
                <th>ID Card</th>
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
                        
            
            $aa[]=$row;
               ?>
            <tr>
                <td><?=$sr;?></td>
                <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                </td>
                <td><?=$row['Name'];?></td>
                <td><?=$row['IDNo'];?></td>
                <td><?=$row['Designation'];?></td>
                <td><?=$row['Department'];?>(<?=$row['DepartmentID'];?>)</td>
                <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row['IDNo'];?>);"></i></td>

                   <td> 
<?php 
    $get_card="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row['IDNo']."'";

                        $get_card_run=sqlsrv_query($conntest,$get_card,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                        $color='';
                          if(sqlsrv_num_rows($get_card_run)>0)
                          {
                            
                            $color="red";
                          }  
?>

<?php if($row['DepartmentID']!='81'){
    ?>

     <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printEmpIDCard(<?=$row['IDNo'];?>);"></i>
<?php 
}
else { ?>
    <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printfourthCard(<?=$row['IDNo'];?>);"></i>

    <?php
}?>


          </td>
            </tr>
            <?php $sr++; }
            
            // print_r($aa);
            ?>
        </tbody>
    </table>
    <?php 
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
        <a href="#" class="nav-link">
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
        {?>
    <table class="table table-head-fixed" id="example">
        <thead>
            <tr>
                <th>SrNo</th>
                <th>Image</th>
                <th>EmpID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Edit</th>
                <th>ID Card</th>
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
                <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                </td>
                <td><?=$row['Name'];?></td>
                <td><?=$row['IDNo'];?></td>
                <td><?=$row['Designation'];?></td>
                  <td><?=$row['Department'];?>(<?=$row['DepartmentID'];?>)</td>
                <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row['IDNo'];?>);"></i></td>



               <td> 
<?php 
    $get_card="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row['IDNo']."'";

                        $get_card_run=sqlsrv_query($conntest,$get_card,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                        $color='';
                          if(sqlsrv_num_rows($get_card_run)>0)
                          {
                            
                            $color="red";
                          }  
?>

<?php if($row['DepartmentID']!='81'){
    ?>

     <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printEmpIDCard(<?=$row['IDNo'];?>);"></i>
<?php 
}
else { ?>
    <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printfourthCard(<?=$row['IDNo'];?>);"></i>

    <?php
}?>


          </td>
            </tr>
            <?php $sr++; }?>
        </tbody>
    </table>
    <?php 
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
      {?>
    <table class="table table-head-fixed" id="example">
        <thead>
            <tr>
                <th>SrNo</th>
                <th>Image</th>
                <th>EmpID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Edit</th>
                <th>ID Card</th>
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
                <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                </td>
                <td><?=$row1['Name'];?></td>
                <td><?=$row1['IDNo'];?></td>
                <td><?=$row1['Designation'];?></td>
                <td><?=$row1['Department'];?><?=$row1['DepartmentID'];?></td>
                <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row1['IDNo'];?>);"></i></td>
                      <td> 
<?php 
    $get_card="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row1['IDNo']."'";

                        $get_card_run=sqlsrv_query($conntest,$get_card,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                        $color='';
                          if(sqlsrv_num_rows($get_card_run)>0)
                          {
                            
                            $color="red";
                          }  
?>

<?php if($row1['DepartmentID']!='81'){
    ?>

     <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printEmpIDCard(<?=$row1['IDNo'];?>);"></i>
<?php 
}
else { ?>
    <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printfourthCard(<?=$row1['IDNo'];?>);"></i>

    <?php
}?>


          </td>
            </tr>
            <?php $sr++;
            } }?>
        </tbody>
    </table>
    <?php 
      }
            elseif($code==56)
      {
         $get_category="SELECT Distinct CollegeName,CollegeID FROM MasterCourseCodes Order By CollegeID";
         $get_category_run=sqlsrv_query($conntest,$get_category);

         while($row=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
         {
         
      $CollegeID=$row['CollegeID'];
                $check_college_emp="SELECT * FROM Staff  Where  CollegeId='$CollegeID'";
            $check_college_emp_run=sqlsrv_query($conntest,$check_college_emp,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $emp_counsst_college=sqlsrv_num_rows($check_college_emp_run);
      ?>
    <div class="card">
        <div class="card-header" style="background-color:white!important; color: black !important;">
            <h3 class="card-title" style="font-size: 14px!important" onclick="show_emp_all_college(<?=$CollegeID;?>);"><b><?= $row['CollegeName']; ?>(<?=$CollegeID;?>)</b></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool">
                    <i class="fas fa-edit" onclick="AddleaveAuthority(<?=$CollegeID;?>);"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus" onclick="show_all_depaertment(<?= $CollegeID; ?>);"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0" style="min-height: 0px!important; overflow: hidden !important;">
            <ul class="nav nav-pills flex-column" id="department_wise_show<?= $CollegeID; ?>">
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
             $check_college_emp="SELECT * FROM MasterDepartment  Where  CollegeId='$collegeId' ";
         $check_college_emp_run=sqlsrv_query($conntest,$check_college_emp,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
          while($row=sqlsrv_fetch_array($check_college_emp_run,SQLSRV_FETCH_ASSOC))
                {
          $departmentid=$row['Id'];
             $emp_count="SELECT * FROM Staff  Where  DepartmentID='$departmentid' and CollegeId='$collegeId' and JobStatus='1'";
         $emp_count_run=sqlsrv_query($conntest,$emp_count,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
          $emp_counsst_college=sqlsrv_num_rows($emp_count_run);
      ?>
    <li class="nav-item " onclick="show_emp_all_department('<?=$collegeId;?>','<?=$departmentid;?>');">
        <a href="#" class="nav-link">
            <i class="fas fa-inbox"></i> <?=$row['Department'];?>
            <span class="badge bg-primary float-right"><?=$emp_counsst_college;?></span>
        </a>
    </li>
    <?php 
   $emp_counsst_college=0;
      }
      }
      
      // print_r($aaa);
      
      elseif($code==58)
      {
      ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>SrNo</th>
                <th>Image</th>
                <th>EmpID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Status</th>
                <th>Edit</th>
                <th>ID Card</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sr=1;
            $department=$_POST['department'];
            $collegeId=$_POST['collegeId'];
            
                $get_category1="SELECT * FROM Staff where  CollegeId='$collegeId' and DepartmentID='$department' ANd JobStatus='1' ";
            $get_category_run1=sqlsrv_query($conntest,$get_category1);
            while($row1=sqlsrv_fetch_array($get_category_run1,SQLSRV_FETCH_ASSOC))
            { 
                $emp_pic=base64_encode($row1['Snap']);
               ?>
            <tr>
                <td><?=$sr;?></td>
                <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                </td>
                <td><?=$row1['Name'];?></td>
                <td><?=$row1['IDNo'];?></td>
                <td><?=$row1['Designation'];?></td>
                <td><?=$row1['Department'];?>(<?=$row1['DepartmentID'];?>)</td>
                <td><?php if($row1['JobStatus']==1){echo "<b class='text-success'>Active</b>";}else{echo "<b class='text-danger'>Left</b>";};?>
                </td>
                <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row1['IDNo'];?>);"></i></td>




               
               <td> 
<?php 
    $get_card="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row1['IDNo']."'";

                        $get_card_run=sqlsrv_query($conntest,$get_card,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                        $color='';
                          if(sqlsrv_num_rows($get_card_run)>0)
                          {
                            
                            $color="red";
                          }  
?>

<?php if($row1['DepartmentID']!='81'){
    ?>

     <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printEmpIDCard(<?=$row1['IDNo'];?>);"></i>
<?php 
}
else { ?>
    <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printfourthCard(<?=$row1['IDNo'];?>);"></i>

    <?php
}?>


          </td>
            </tr>
            <?php $sr++;
            } ?>
        </tbody>
    </table>
    <?php 
      }


  elseif($code==58_0)
      {
      ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>SrNo</th>
                <th>Image</th>
                <th>EmpID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Status</th>
                <th>Edit</th>
                <th>ID Card</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sr=1;
          
            $collegeId=$_POST['collegeId'];
            
                $get_category1="SELECT * FROM Staff where  CollegeId='$collegeId'  ANd JobStatus='1' ";
            $get_category_run1=sqlsrv_query($conntest,$get_category1);
            while($row1=sqlsrv_fetch_array($get_category_run1,SQLSRV_FETCH_ASSOC))
            { 
                $emp_pic=base64_encode($row1['Snap']);
               ?>
            <tr>
                <td><?=$sr;?></td>
                <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                </td>
                <td><?=$row1['Name'];?></td>
                <td><?=$row1['IDNo'];?></td>
                <td><?=$row1['Designation'];?></td>
                <td><?=$row1['Department'];?>(<?=$row1['DepartmentID'];?>)</td>
                <td><?php if($row1['JobStatus']==1){echo "<b class='text-success'>Active</b>";}else{echo "<b class='text-danger'>Left</b>";};?>
                </td>
                <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row1['IDNo'];?>);"></i></td>




               
               <td> 
<?php 
    $get_card="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row1['IDNo']."'";

                        $get_card_run=sqlsrv_query($conntest,$get_card,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                        $color='';
                          if(sqlsrv_num_rows($get_card_run)>0)
                          {
                            
                            $color="red";
                          }  
?>

<?php if($row1['DepartmentID']!='81'){
    ?>

     <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printEmpIDCard(<?=$row1['IDNo'];?>);"></i>
<?php 
}
else { ?>
    <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printfourthCard(<?=$row1['IDNo'];?>);"></i>

    <?php
}?>


          </td>
            </tr>
            <?php $sr++;
            } ?>
        </tbody>
    </table>
    <?php 
      }

















         elseif($code==59)
      {
          $search = $_POST['empID'];
      ?>
    <table class="table " id="example">
        <thead>
            <tr>
                <th>SrNo</th>
                <th>Image</th>
                <th>EmpID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Status</th>
                <th>Edit</th>
                <th>ID Card</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sr=1;

             $query = "SELECT *, MasterDepartment.Department as DepartmentName,MasterDepartment.Id  as depid FROM Staff left join MasterDepartment ON Staff.DepartmentId=MasterDepartment.Id Where (IDNo like '%".$search."%' or Name like '%".$search."%') ";
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
               }
               
               ?>
            <tr>
                <td><?=$sr;?></td>
                <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                </td>
                <td><?=$row['Name'];?></td>
                <td><?=$row['IDNo'];?></td>
                <td><?=$row['Designation'];?></td>
                <td><?=$row['DepartmentName'];?>(<?=$row['depid'];?>)</td>
                <td><?php if($row['JobStatus']==1){echo "<b class='text-success'>Active</b>";}else{echo "<b class='text-danger'>Left</b>";};?>
                </td>
                <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row['IDNo'];?>);"></i></td>
                <td>


<?php 
    $get_card="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row['IDNo']."'";

                        $get_card_run=sqlsrv_query($conntest,$get_card,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                        $color='';
                          if(sqlsrv_num_rows($get_card_run)>0)
                          {
                            
                            $color="red";
                          }  
?>

<?php if($row['depid']!='81'){
    ?>

     <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printEmpIDCard(<?=$row['IDNo'];?>);"></i>
<?php 
}
else { ?>
    <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printfourthCard(<?=$row['IDNo'];?>);"></i>

    <?php
}?>

                   
                </td>
            </tr>
            <?php $sr++;
            }
            ?>
        </tbody>
    </table>
    <?php 
      }
            elseif($code==60)
      {
      ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>SrNo</th>
                <th>Image</th>
                <th>EmpID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Status</th>
                <th>Edit</th>
                <th>ID Card</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sr=1;
            $empID=$_POST['empID'];
            
                $get_category1="SELECT *, MasterDepartment.Department as DepartmentName,MasterDepartment.Id  as depid FROM Staff left join MasterDepartment ON Staff.DepartmentId=MasterDepartment.Id Where  IDNo='$empID' ";

                //$get_category1="SELECT * FROM Staff where  IDNo='$empID' ";


            $get_category_run1=sqlsrv_query($conntest,$get_category1);
            while($row1=sqlsrv_fetch_array($get_category_run1,SQLSRV_FETCH_ASSOC))
            { 
                $emp_pic=base64_encode($row1['Snap']);
               ?>
            <tr>
                <td><?=$sr;?></td>
                <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                </td>
                <td><?=$row1['Name'];?></td>
                <td><?=$row1['IDNo'];?></td>
                <td><?=$row1['Designation'];?></td>
                <td><?=$row1['Department'];?></td>
                <td><?php if($row1['JobStatus']==1){echo "<b class='text-success'>Active</b>";}else{echo "<b class='text-danger'>Left</b>";};?>
                </td>
                <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row1['IDNo'];?>);"> </i></td>
                <td><?php 
    $get_card="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row['IDNo']."'";

                        $get_card_run=sqlsrv_query($conntest,$get_card,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                        $color='';
                          if(sqlsrv_num_rows($get_card_run)>0)
                          {
                            
                            $color="red";
                          }  
?>

<?php if($row1['depid']!='81'){
    ?>

     <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printEmpIDCard(<?=$row['IDNo'];?>);"></i>
<?php 
}
else { ?>
    <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printfourthCard(<?=$row['IDNo'];?>);"></i>

    <?php
}?></td>
            </tr>
            <?php $sr++;
            } ?>
        </tbody>
    </table>
    <?php 
      }
      elseif($code==61)
      {
        $DateOfBirth="01-01-1900";
      ?>
    <section class="content">

        <div class="row" style="margin-top: 10px!important;">
            <div class="col-md-12 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>EmpID</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>College</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>ID Card</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $emp_id=$_POST['empID'];
                         $emp_count="SELECT *, MasterDepartment.Department as DepartmentName,MasterDepartment.Id as DepartmentId FROM Staff left join MasterDepartment ON Staff.DepartmentId=MasterDepartment.Id  Where  IDNo='$emp_id' ";
                        $emp_count_run=sqlsrv_query($conntest,$emp_count,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $emp_counsst_college=sqlsrv_num_rows($emp_count_run);
                        if($row1=sqlsrv_fetch_array($emp_count_run,SQLSRV_FETCH_ASSOC))
                        {
                        $emp_pic=base64_encode($row1['Snap']);
                        $DateOfBirth=$row1['DateOfBirth'];
                        $DateOfJoining=$row1['DateOfJoining'];
                        $DateOfLeaving=$row1['DateOfLeaving'];
                         
                        ?>
                        <tr>
                            <td><?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                            </td>
                            <td><?=$row1['Name'];?></td>
                            <td><?=$row1['IDNo'];?></td>
                            <td><?=$row1['Designation'];?></td>
                            <td><?=$row1['CollegeName'];?></td>
                            <td><?=$row1['DepartmentName'];?>(<?=$row1['DepartmentId'];?>)</td>
                            <td><?php if($row1['JobStatus']==1){echo "<b class='text-success'>Active</b>";}else{echo "<b class='text-danger'>Left</b>";};?>
                            </td>
                            <td><i class="fa fa-edit fa-lg" onclick="update_emp_record(<?=$row1['IDNo'];?>);"></i>
                            </td>
                            <td><?php 
    $get_card="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row1['IDNo']."'";

                        $get_card_run=sqlsrv_query($conntest,$get_card,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                        $color='';
                          if(sqlsrv_num_rows($get_card_run)>0)
                          {
                            
                            $color="red";
                          }  
?>

<?php if($row1['DepartmentId']!='81'){
    ?>

     <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printEmpIDCard(<?=$row1['IDNo'];?>);"></i>
<?php 
}
else { ?>
    <i class="fa fa-print fa-lg" style="color:<?=$color;?>" onclick="printfourthCard(<?=$row1['IDNo'];?>);"></i>

    <?php
}?>
 </td>
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
                            <li class="nav-item"><a class="nav-link active" href="#personal_details"
                                    data-toggle="tab">Basic</a></li>
                            <li class="nav-item"><a class="nav-link" href="#contact" data-toggle="tab">Contact</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#employment" data-toggle="tab">Employment</a>
                            </li>
                            <?php   if($role_id==2){
                                            
                                            ?>
                                            <li class="nav-item"><a class="nav-link" href="#idcard" data-toggle="tab">ID Card</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#permissions"
                                    data-toggle="tab">Permissions</a></li>
                            <li class="nav-item"><a class="nav-link" href="#assignCollegeCourseRight"
                                    data-toggle="tab">Assign College Course</a></li>
                            <?php 
                                    }?>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="personal_details">
                                <!-- /.login-logo -->
                                <form action="action_g.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="code" value="94">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Emp. ID</label>
                                                <input type="text" class="form-control" name="loginId"
                                                    value="<?=$row1['IDNo'];?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter name" value="<?=$row1['Name'];?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Father's Name</label>
                                                <input type="text" class="form-control" name="fatherName"
                                                    placeholder="Enter father's name" value="<?=$row1['FatherName'];?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Mother's Name</label>
                                                <input type="text" class="form-control" name="motherName"
                                                    placeholder="Enter mother's name" value="<?=$row1['MotherName'];?>">
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input type="date" class="form-control" name="dob"
                                                    value="<?php echo date("Y-m-d", strtotime($DateOfBirth->format("Y-m-d")));?>">


                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="<?=$row1['Gender'];?>"><?=$row1['Gender'];?>
                                                    </option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="form-control" name="category">
                                                    <option value="<?=$row1['Category'];?>"><?=$row1['Category'];?>
                                                    </option>

                                                    <option>SC</option>
                                                    <option>ST</option>
                                                    <option>OBC</option>
                                                    <option>General</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>PAN Card Number</label>
                                                <input type="text" class="form-control" name="panNumber"
                                                    placeholder="Enter PAN card number" value="<?=$row1['PANNo'];?>">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Upload PAN Card</label>
                                                <input type="file" class="form-control-file" name="panCard">
                                                <i class="fa fa-eye text-success"
                                                    onclick="view_uploaded_document(<?=$row1['IDNo'];?>,'Pan');"
                                                    data-toggle="modal" data-target="#UploadImageDocument"></i>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Aadhar Card Number</label>
                                                <input type="text" class="form-control" name="aadharNumber"
                                                    value="<?=$row1['AadhaarCard'];?>"
                                                    placeholder="Enter Aadhar card number">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Upload Aadhar Card</label>
                                                <input type="file" class="form-control-file" name="aadharCard">
                                                <i class="fa fa-eye text-success"
                                                    onclick="view_uploaded_document(<?=$row1['IDNo'];?>,'Adhar');"
                                                    data-toggle="modal" data-target="#UploadImageDocument"></i>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label> Identification Mark</label>
                                                <textarea rows="1" class="form-control"
                                                    name="personalIdentificationMark"
                                                    rows="3"><?=$row1['PersonalIdentificationMark'];?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-3">


                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" class="form-control-file" name="photo" name="photo">
                                                <i class="fa fa-eye text-success"
                                                    onclick="view_uploaded_document(<?=$row1['IDNo'];?>,'Image');"
                                                    data-toggle="modal" data-target="#UploadImageDocument"></i>
                                            </div>

                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="form-group">
                                                <label>Upload Signature</label>
                                                <input type="file" class="form-control-file" name="signature">
                                                <i class="fa fa-eye text-success"
                                                    onclick="view_uploaded_document(<?=$row1['IDNo'];?>,'Sign');"
                                                    data-toggle="modal" data-target="#UploadImageDocument"></i>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="tab-pane" id="contact">

                                <div class="row">

                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Personal Email ID</label>
                                            <input type="email" class="form-control" name="personalEmail"
                                                placeholder="Enter personal email" value="<?=$row1['EmailID'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Official Email ID</label>
                                            <input type="email" class="form-control" name="officialEmail"
                                                placeholder="Enter official email"
                                                value="<?=$row1['OfficialEmailID'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control" name="mobileNumber"
                                                placeholder="Enter mobile number" value="<?=$row1['MobileNo'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>WhatsApp Number</label>
                                            <input type="text" class="form-control" name="whatsappNumber"
                                                placeholder="Enter WhatsApp number"
                                                value="<?=$row1['WhatsAppNumber'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Emergency Contact No</label>
                                            <input type="text" class="form-control" name="emergencyContactNumber"
                                                placeholder="Enter emergency contact number"
                                                value="<?=$row1['EmergencyContactNo'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Official Mobile Number</label>
                                            <input type="text" class="form-control" name="officialMobileNumber"
                                                placeholder="Enter official mobile number"
                                                value="<?=$row1['OfficialMobileNo'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" name="addressLine1"
                                                placeholder="Enter address line 1" value="<?=$row1['AddressLine1'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" name="addressLine2"
                                                placeholder="Enter address line 2" value="<?=$row1['AddressLine2'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Permanent Address</label>
                                            <input type="text" class="form-control" name="permanentAddress"
                                                placeholder="Enter permanent address"
                                                value="<?=$row1['PermanentAddress'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Correspondence Address</label>
                                            <input type="text" class="form-control" name="correspondenceAddress"
                                                placeholder="Enter correspondence address"
                                                value="<?=$row1['CorrespondanceAddress'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" class="form-control" name="postalCode"
                                                onkeyup="postcode();" id="pincode-input"
                                                value="<?=$row1['PostalCode'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" value="<?=$row1['State'];?>"
                                                id="state_by_post" disabled>
                                            <input type="hidden" class="form-control" name="state" id="state_by_post">

                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>District</label>
                                            <input type="text" class="form-control" value="<?=$row1['District'];?>"
                                                id="district_by_post" placeholder="Enter district" disabled>
                                            <input type="hidden" class="form-control" name="district"
                                                id="district_by_post" placeholder="Enter district">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3">
                                        <div class="form-group">
                                            <label>Nationality</label>
                                            <input type="text" id="nationality" class="form-control"
                                                name="nationality_by_post" value="<?=$row1['Nationality'];?>" readonly>
                                        </div>
                                    </div>
                                    <!--  <div class="col-lg-3 col-12">
                                    <div class="form-group">
                                       <label for="villageCity">Village/City</label>
                                      
                                       <select class="form-control" name="villageCity" id="village_by_post">
                                          <option value=""><?=$row1['Vila'];?></option>
                                       </select>
                                    </div>
                                 </div> -->
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Post Office</label>
                                            <input type="text" class="form-control" name="postOffice"
                                                placeholder="Enter post office">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="employment">

                                <div class="row">
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Name of Organisation</label>

                                            <select class="form-control" name="organisationName"
                                                onchange="fetchDepartment(this.value);">
                                                <option value="<?=$row1['CollegeId'];?>">
                                                    <?=$row1['CollegeName'];?>(<?=$row1['CollegeId'];?>)</option>
                                                <?php  $get_College="SELECT DISTINCT CollegeName,CollegeID FROM MasterCourseCodes ";
                                                $get_CollegeRun=sqlsrv_query($conntest,$get_College);
                                                while($get_CollegeRow=sqlsrv_fetch_array($get_CollegeRun,SQLSRV_FETCH_ASSOC))
                                                {?>
                                                <option value="<?=$get_CollegeRow['CollegeID'];?>">
                                                    <?=$get_CollegeRow['CollegeName'];?>(<?=$get_CollegeRow['CollegeID'];?>)
                                                </option>
                                                <?php }
                                          ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Name of Department</label>

                                            <select class="form-control" name="departmentName" id="departmentName">
                                                <option value="<?=$row1['DepartmentId'];?>">
                                                    <?=$row1['DepartmentName'];?>(<?=$row1['DepartmentId'];?>)</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Designation</label>

                                            <select class="form-control" name="designation">
                                                <option value="<?=$row1['Designation'];?>">
                                                    <?=$row1['Designation'];?></option>
                                                <?php  $get_Designation="SELECT DISTINCT Designation FROM MasterDesignation ";
                                                $get_DesignationRun=sqlsrv_query($conntest,$get_Designation);
                                                while($get_DesignationRow=sqlsrv_fetch_array($get_DesignationRun,SQLSRV_FETCH_ASSOC))
                                                {?>
                                                <option value="<?=$get_DesignationRow['Designation'];?>">
                                                    <?=$get_DesignationRow['Designation'];?></option>
                                                <?php }
                                          ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Date of Joining</label>
                                            <input type="date" class="form-control" name="joiningDate"
                                                value="<?php echo date("Y-m-d", strtotime($DateOfJoining->format("Y-m-d")));?>">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Salary Decided</label>
                                            <input type="text" class="form-control" name="salary"
                                                placeholder="Enter salary" value="<?=$row1['SalaryAtPresent'];?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Type of Employment</label>

                                            <select class="form-control" name="employmentType">

                                                <option value="<?=$row1['Type'];?>"><?=$row1['Type'];?></option>
                                                <option value="Regular">Regular</option>
                                                <option value="Conatct">Conatct</option>
                                                <option value="Guest">Guest</option>
                                                <option value="Adhoc">Adhoc</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Status of Employment</label>
                                            <!-- <input type="text" class="form-control" name="employmentStatus" placeholder="Enter employment status"> -->
                                            <select class="form-control" name="employmentStatus">
                                                <?php if ($row1['JobStatus']==1) {?>

                                                <option value="<?=$row1['JobStatus'];?>"
                                                    style="background-color:green !important;"><b>Active</b>
                                                </option>
                                                <?php }else
                                          {
                                             ?>
                                                <option value="<?=$row1['JobStatus'];?>">DeActive</option>
                                                <?php }
                                          ?>
                                                <option value="1">Active</option>
                                                <option value="0">DeActive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Emp Category </label>

                                            <select class="form-control" name="EmpCategory">

                                                <?php  
                                  $get_defalut_category="SELECT Distinct CategoryId,CategoryFName FROM CategoriesEmp Where CategoryId='".$row1['CategoryId']."' ";
           $get_defalut_category_run=sqlsrv_query($conntest,$get_defalut_category);
           if($row_cate=sqlsrv_fetch_array($get_defalut_category_run,SQLSRV_FETCH_ASSOC))
           {?>
                                                <option value="<?=$row_cate['CategoryId'];?>">
                                                    <?=$row_cate['CategoryFName'];?></option>

                                                <?php }
                                            $get_category="SELECT Distinct CategoryId,CategoryFName FROM CategoriesEmp ";
           $get_category_run=sqlsrv_query($conntest,$get_category);
           while($row_categort=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
           {
      ?>
                                                <option value="<?=$row_categort['CategoryId'];?>">
                                                    <?=$row_categort['CategoryFName'];?></option>
                                                <?php 
      }?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-lg-4 col-12">
                                        <div class="form-group">
                                            <label>Leave Recommending Authority
                                            </label>
                                            <input type="text" class="form-control" name="leaveRecommendingAuthority"
                                                placeholder="Enter leave sanction authority"
                                                value="<?=$row1['LeaveRecommendingAuthority'];?>"
                                                onkeyup="emp_detail_verify2(this.value);">
                                            <?php  
                                                   $getUserDetails1="SELECT Name FROM Staff Where IDNo='".$row1['LeaveRecommendingAuthority']."'";
    $getUserDetailsRun1=sqlsrv_query($conntest,$getUserDetails1);
    if($getUserDetailsRow1=sqlsrv_fetch_array($getUserDetailsRun1,SQLSRV_FETCH_ASSOC))
    {
       ?> <p id="emp_detail_status_2"><b><?=$getUserDetailsRow1['Name'];?></b></p><?php
    }?>


                                        </div>


                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="form-group">
                                            <label>Leave Sanction Authority</label>
                                            <input type="text" class="form-control" name="leaveSanctionAuthority"
                                                placeholder="Enter leave recommending authority"
                                                value="<?=$row1['LeaveSanctionAuthority'];?>"
                                                onkeyup="emp_detail_verify1(this.value);">

                                            <?php  
                                                   $getUserDetails="SELECT Name FROM Staff Where IDNo='".$row1['LeaveSanctionAuthority']."'";
    $getUserDetailsRun=sqlsrv_query($conntest,$getUserDetails);
    if($getUserDetailsRow=sqlsrv_fetch_array($getUserDetailsRun,SQLSRV_FETCH_ASSOC))
    {
        ?>
                                            <p id="emp_detail_status_1"><b><?=$getUserDetailsRow['Name'];?></b></p>
                                            <?php 
       
    }?>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="form-group">
                                            <label>Upload Appointment Letter</label>
                                            <input type="file" class="form-control-file" name="appointmentLetter">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Bank Account No</label>
                                            <input type="text" class="form-control" name="bankAccountNo"
                                                placeholder="Enter bank account number">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Upload Passbook Copy</label>
                                            <input type="file" class="form-control-file" name="passbookCopy">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label> Bank Name</label>
                                            <input type="text" class="form-control" name="employeeBankName"
                                                placeholder="Enter employee bank name">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Bank IFSC code</label>
                                            <input type="text" class="form-control" name="bankIFSC"
                                                placeholder="Enter bank IFSC code">
                                        </div>
                                    </div>
                                </div>



                            </div>
                             <div class="tab-pane" id="idcard">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <table class="table  table-bordered">
                                            <tr>
                                                <th colspan="7">
                                                    <center> ID Card</center>
                                                </th>
                                            </tr>
                                             <tr><td>IDNO</td>
                                                <td>Status</td>
                                             <td>Date</td>
                                             </tr>
<?php 
           $IdCard="SELECT *  FROM TblStaffSmartCardReport where IDNo='".$row1['IDNo']."'"; 
$getUseridcard=sqlsrv_query($conntest,$IdCard);
$countPerms=0;
while($getUseridcardRow=sqlsrv_fetch_array($getUseridcard,SQLSRV_FETCH_ASSOC))
{
?>
                                            <tr><td><?= $getUseridcardRow['IDNo'];?></td>
                                                <td><?= $getUseridcardRow['PrintStatus'];?></td>
                                             <td><?= $getUseridcardRow['UpdateDate']->format('d-m-Y H:i:s');?></td>
                                             </tr><?php }?>

                                           
                                </table> 
                                </div> 
</div>
</div>



                            <div class="tab-pane" id="permissions">

                                <div class="row">
                                    <div class="col-lg-12">

                                        <table class="table  table-bordered">
                                            <tr>
                                                <th colspan="7">
                                                    <center> ERP PERMISSIONS</center>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th> ID</th>
                                                <th>Emp ID</th>
                                                <th>Password</th>
                                                <th>LoginType</th>
                                                <th>RightsLevel</th>
                                                <th>Delete</th>
                                                <th>Update</th>
                                            </tr>
                                            <?php 
$getUserMaster="SELECT * FROM UserMaster Where UserName='$emp_id' ";
$getUserMasterRun=sqlsrv_query($conntest,$getUserMaster);
$countPerms=0;
while($getUserMasterRunRow=sqlsrv_fetch_array($getUserMasterRun,SQLSRV_FETCH_ASSOC))
{
?>
                                            <tr>
                                                <td><?=$getUserMasterRunRow['UserMasterID'];?></td>
                                                <td><?=$getUserMasterRunRow['UserName'];?></td>
                                                <td><?=$getUserMasterRunRow['Password'];?></td>
                                                <td>
                                                    <select class="form-control" id="LoginType">
                                                        <option value="<?=$getUserMasterRunRow['LoginType'];?>">
                                                            <?=$getUserMasterRunRow['LoginType'];?></option>

                                                        <?php 
$getDefalutMenu="SELECT Distinct LoginType FROM LoginTypePerms ";
$getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);
while($getDefalutMenuRunRow=sqlsrv_fetch_array($getDefalutMenuRun,SQLSRV_FETCH_ASSOC))
{
?>

                                                        <option value="<?=$getDefalutMenuRunRow['LoginType'];?>">
                                                            <?=$getDefalutMenuRunRow['LoginType'];?></option>


                                                        <?php 
}?>

                                                </td>
                                                <td>
                                                    <select class="form-control" id="RightsLevel">
                                                        <option value="<?=$getUserMasterRunRow['RightsLevel'];?>">
                                                            <?=$getUserMasterRunRow['RightsLevel'];?></option>

                                                        <?php 
$getDefalutMenu="SELECT Distinct Category FROM DefaultMenu  ";
$getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);
while($getDefalutMenuRunRow=sqlsrv_fetch_array($getDefalutMenuRun,SQLSRV_FETCH_ASSOC))
{
?>

                                                        <option value="<?=$getDefalutMenuRunRow['Category'];?>">
                                                            <?=$getDefalutMenuRunRow['Category'];?></option>


                                                        <?php 
}?>

                                                </td>
                                                <td><button type="button" class="btn btn-danger"
                                                        onclick="deleteRole('<?=$getUserMasterRunRow['UserName'];?>','<?=$getUserMasterRunRow['UserMasterID'];?>');"><i
                                                            class="fa fa-trash text-white"></i></button></td>
                                                <td><button type="button" class="btn btn-success"
                                                        onclick="updateRole('<?=$getUserMasterRunRow['UserName'];?>','<?=$getUserMasterRunRow['UserMasterID'];?>');"><i
                                                            class="fa fa-check text-white fa-1x"></i></button></td>
                                            </tr>

                                            <?php

$countPerms++;
} ?>
                                        </table><?php 
if($countPerms<1)
{
                                                    ?> <table class="table  table-bordered">
                                            <tr>
                                                <th colspan="7">
                                                    <center> ERP PERMISSIONS</center>
                                                </th>
                                            </tr>
                                            <tr>

                                                <th>LoginType</th>
                                                <th>RightsLevel</th>
                                                <th>Action</th>
                                            <tr>

                                                <td>
                                                    <select class="form-control" id="LoginType">
                                                        <option value="">Select</option>

                                                        <?php 
$getDefalutMenu="SELECT Distinct LoginType FROM LoginTypePerms ";
$getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);
while($getDefalutMenuRunRow=sqlsrv_fetch_array($getDefalutMenuRun,SQLSRV_FETCH_ASSOC))
{
?>

                                                        <option value="<?=$getDefalutMenuRunRow['LoginType'];?>">
                                                            <?=$getDefalutMenuRunRow['LoginType'];?></option>


                                                        <?php 
}?>

                                                </td>
                                                <td>
                                                    <select class="form-control" id="RightsLevel">
                                                        <option value="">Select</option>
                                                        <?php 
$getDefalutMenu="SELECT Distinct Category FROM DefaultMenu  ";
$getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);
while($getDefalutMenuRunRow=sqlsrv_fetch_array($getDefalutMenuRun,SQLSRV_FETCH_ASSOC))
{
?>
                                                        <option value="<?=$getDefalutMenuRunRow['Category'];?>">
                                                            <?=$getDefalutMenuRunRow['Category'];?></option>
                                                        <?php 
}?>
                                                </td>

                                                <td><button type="button" class="btn btn-success"
                                                        onclick="addRole('<?=$emp_id;?>','<?=$row1['CollegeName'];?>');"><i
                                                            class="fa fa-plus text-white fa-1x"></i></button></td>
                                            </tr>
                                            <?php 
}
?>
                                        </table>
                                        <?php 

    ?>
                                    </div>

                                </div>


                                <!-- lms permissionsa -->
                                <div class="row">
                                    <div class="col-lg-12">

                                        <table class="table  table-bordered">
                                            <tr>
                                                <th colspan="7">
                                                    <center> LMS PERMISSIONS</center>
                                                </th>
                                            </tr>
                                            <tr>

                                                <th>Emp ID</th>

                                                <th>Role Name</th>
                                                <th>Delete</th>
                                                <th>Update</th>
                                            </tr>
                                            <?php 
$getUser="SELECT * FROM user inner join role_name on user.role_id=role_name.id  Where emp_id='$emp_id' ";
$getUserRun=mysqli_query($conn,$getUser);
$countPerms=0;
while($getUserRunRow=mysqli_fetch_array($getUserRun))
{
?>
                                            <tr>
                                                <td><?=$getUserRunRow['emp_id'];?></td>

                                                <td>
                                                    <select class="form-control" id="LoginType_lms">
                                                        <option value="<?=$getUserRunRow['role_id'];?>">
                                                            <?=$getUserRunRow['role_name'];?></option>

                                                        <?php 
$getDefalutMenu="SELECT Distinct role_name,id FROM role_name ";
$getDefalutMenuRun=mysqli_query($conn,$getDefalutMenu);
while($getDefalutMenuRunRow=mysqli_fetch_array($getDefalutMenuRun))
{
?>

                                                        <option value="<?=$getDefalutMenuRunRow['id'];?>">
                                                            <?=$getDefalutMenuRunRow['role_name'];?></option>


                                                        <?php 
}?>

                                                </td>

                                                <td><button type="button" class="btn btn-danger"
                                                        onclick="lmsDeleteRole('<?=$emp_id;?>');"><i
                                                            class="fa fa-trash text-white"></i></button></td>
                                                <td><button type="button" class="btn btn-success"
                                                        onclick="lmsUpdateRole('<?=$emp_id;?>');"><i
                                                            class="fa fa-check text-white fa-1x"></i></button></td>
                                            </tr>

                                            <?php

$countPerms++;
} ?>
                                        </table><?php 
if($countPerms<1)
{
                                                    ?> <table class="table  table-bordered">
                                            <tr>
                                                <th colspan="7">
                                                    <center> LMS PERMISSIONS</center>
                                                </th>
                                            </tr>
                                            <tr>



                                                <th>Role Name</th>
                                                <th>Action</th>
                                            <tr>

                                                <td>
                                                    <select class="form-control" id="LoginType_lms">
                                                        <option value="">Select</option>

                                                        <?php 
$getDefalutMenu="SELECT Distinct role_name,id FROM role_name ";
$getDefalutMenuRun=mysqli_query($conn,$getDefalutMenu);
while($getDefalutMenuRunRow=mysqli_fetch_array($getDefalutMenuRun))
{
?>

                                                        <option value="<?=$getDefalutMenuRunRow['id'];?>">
                                                            <?=$getDefalutMenuRunRow['role_name'];?></option>


                                                        <?php 
}?>

                                                </td>


                                                <td><button type="button" class="btn btn-success"
                                                        onclick="lmsAddRole('<?=$emp_id;?>');"><i
                                                            class="fa fa-plus text-white fa-1x"></i></button></td>
                                            </tr>
                                            <?php 
}
?>
                                        </table>
                                        <?php 

    ?>
                                    </div>

                                </div>



                                <!-- ------------------------------ -->














                            </div>

                            <div class="tab-pane" id="assignCollegeCourseRight">
                                <div class="row">
                                    <div class="col-lg-6">

                                        <table class="table  table-bordered">
                                            <tr>

                                                <th>College</th>
                                                <th>Department</th>
                                                <th>Course</th>

                                                <th>Update</th>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <select id='CollegeID' onchange="collegeByDepartment(this.value);"
                                                        class="form-control" required>
                                                        <option value=''>Select Faculty</option>
                                                        <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                                                        <option value="<?=$CollegeID;?>"><?=$college;?></option>
                                                        <?php }
                        ?>
                                                    </select>
                                                </td>
                                                <td>

                                                    <select id="Department" class="form-control"
                                                        onchange="fetchcourse()" required>
                                                        <option value=''>Select Department</option>
                                                    </select>

                                                </td>
                                                <td>
                                                    <select id="Course" class="form-control" required>
                                                        <option value=''>Select Course</option>
                                                    </select>
                                                </td>
                                                <td><button type="button" class="btn btn-success"
                                                        onclick="addCollegePermissions(<?=$emp_id;?>);"><i
                                                            class="fa fa-plus text-white fa-1x"></i></button></td>
                                            </tr>
                                        </table>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <select name="College" id='CollegeForsearch' class="form-control">
                                                    <option value=''>Select Faculty</option>
                                                    <?php
                $getUserMaster="SELECT Distinct CollegeID FROM UserAccessLevel where IDNo='$emp_id'   ";
                $getUserMasterRun=sqlsrv_query($conntest,$getUserMaster);
                $countPerms=0;
                while($getUserMasterRunRow=sqlsrv_fetch_array($getUserMasterRun,SQLSRV_FETCH_ASSOC))
                {
                    $getCollegeName="SELECT * FROM MasterCourseCodes where CollegeID='".$getUserMasterRunRow['CollegeID']."'  ";
                $getCollegeNameRun=sqlsrv_query($conntest,$getCollegeName);
                $countPerms=0;
                if($getCollegeNameRunRow=sqlsrv_fetch_array($getCollegeNameRun,SQLSRV_FETCH_ASSOC))
                {
                        ?>
                                                    <option value="<?=$getCollegeNameRunRow['CollegeID'];?>">
                                                        <?=$getCollegeNameRunRow['CollegeName'];?></option>
                                                    <?php }
                }
                        ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-success"
                                                    onclick="searchForDelete(<?=$emp_id;?>);">Search</button>
                                            </div>

                                        </div>
                                        <br>
                                        <div class='table-responsive' style="height:500px;"
                                            id="TableAssignedPermissions">
                                            <table class="table  table-bordered">
                                                <tr>

                                                    <th> <input type="checkbox" id="select_all1"
                                                            onclick="selectForDelete();" class="checkbox"></th>
                                                    <th>ID</th>
                                                    <th>College</th>

                                                    <th>Course</th>
                                                    <th>Delete</th>
                                                </tr>
                                                <?php 
$getUserMaster="SELECT * FROM UserAccessLevel where IDNo='$emp_id'  ";
$getUserMasterRun=sqlsrv_query($conntest,$getUserMaster);
$countPerms=0;
while($getUserMasterRunRow=sqlsrv_fetch_array($getUserMasterRun,SQLSRV_FETCH_ASSOC))
{
    $getCollegeName="SELECT * FROM MasterCourseCodes where CourseID='".$getUserMasterRunRow['CourseID']."'  ";
$getCollegeNameRun=sqlsrv_query($conntest,$getCollegeName);
$countPerms=0;
if($getCollegeNameRunRow=sqlsrv_fetch_array($getCollegeNameRun,SQLSRV_FETCH_ASSOC))
{
    ?>
                                                <tr>

                                                    <td><input type="checkbox" class="checkbox v_check"
                                                            value="<?=$getUserMasterRunRow['AccessLevelID'];?>">
                                                    </td>
                                                    </td>

                                                    <td>
                                                        <?=$getUserMasterRunRow['AccessLevelID'];?>
                                                    </td>
                                                    <td>

                                                        <?=$getCollegeNameRunRow['CollegeName'];?>
                                                    </td>
                                                    <td>
                                                        <?=$getCollegeNameRunRow['Course'];?>
                                                    </td>
                                                    <td><button type="button" class="btn btn-danger btn-xs"
                                                            onclick="deleteCollegeCourse('<?=$getUserMasterRunRow['AccessLevelID'];?>','<?=$getUserMasterRunRow['IDNo'];?>');"><i
                                                                class="fa fa-trash text-white"></i></button></td>
                                                </tr>
                                                <?php
}
}
?>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                            onclick="DeleteCollegeCoursePermissions(<?=$id;?>);"><i
                                                                class="fa fa-trash "></i></button>
                                                    </td>
                                                </tr>
                                            </table>
                                            <?php 

    ?>
                                        </div>
                                    </div>




                                </div>

                            </div>






                            <?php
                          
                            }
                           
                           
                            ?>



                        </div>
                        <!-- /.row -->
                        <div class="card-footer">
                            <div class="row">



                                <button type="button" onclick="uploadPhoto(this.form)" class="btn btn-primary"
                                    id="update_button" style="display:none;">Update</button>




                            </div>

                            <!-- /.container-fluid -->
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
            <input type="text" class="form-control" value="<?=$row['Department'];?>" disabled>
            <input type="hidden" id="collegeId" value="<?=$collegeId;?>">
            <input type="hidden" id="Department" value="<?=$departmentid;?>">
        </div>
        <div class="col-lg-3">
            <label>Recommending</label>
            <input type="text" id="Recommending<?=$departmentid;?>" class="form-control"
                value="<?=$row_auth['Recommending'];?>">
        </div>
        <div class="col-lg-3">
            <label>Section</label>
            <input type="text" id="Senction<?=$departmentid;?>" class="form-control"
                value="<?=$row_auth['Senction'];?>">
        </div>
        <div class="col-lg-2">
            <label>Action</label><br>
            <input type="button" onclick="update_leave_authority(<?=$collegeId;?>,<?=$departmentid;?>);"
                class="btn btn-primary" value="Update">
        </div>
    </div>
    <?php 
      }
      }?>
    <div class="row">
        <div class="col-lg-12">
            <center><button class="btn btn-info" type="button" onclick="sync_leave_auth(<?=$collegeId;?>)">Sync</button>
            </center>
        </div>
    </div>
    <?php     }
      elseif($code==63)
      {
         $collegeId=$_POST['collegeId'];
         $departmentid=$_POST['department'];
         $Recommend=$_POST['Recommending'];
         $Senction=$_POST['Senction'];
      
            $insert_leave_authority="UPDATE leave_authority SET Recommending='$Recommend',Senction='$Senction' WHERE CollegeID='$collegeId' and DepartmentID='$departmentid'";
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
      if ($Senction!='0' && $Recommending!='0' )
       {
        $update_auth="UPDATE Staff SET LeaveSanctionAuthority='$Recommending' ,LeaveRecommendingAuthority='$Senction' where DepartmentID='$departmentid' and CollegeId='$CollegeID'";
      $update_auth_run=sqlsrv_query($conntest,$update_auth);
     
      
      }
      else
      {
      
      }
      }
       if ($update_auth_run==true) {
         echo "1";
      }else
      {
         echo "0";
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php  $sr=1; $get_pending="SELECT *,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id   where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='0'"; 
            $get_pending_run=mysqli_query($conn,$get_pending);
            while($get_row=mysqli_fetch_array($get_pending_run))
            {
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification_approve(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>

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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sr=1; 
            $get_pending="SELECT *,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id  where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='1'"; 
                $get_pending_run=mysqli_query($conn,$get_pending);
                while($get_row=mysqli_fetch_array($get_pending_run))
                {
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification_approve(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sr=1; 
            $get_pending="SELECT * ,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM vehicle_allotment_process inner join vehicle_allotment  ON vehicle_allotment_process.token_no=vehicle_allotment.token_no inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id   where vehicle_allotment_process.emp_id='$EmployeeID' and vehicle_allotment_process.action='2'"; 
                $get_pending_run=mysqli_query($conn,$get_pending);
                while($get_row=mysqli_fetch_array($get_pending_run))
                {
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification_approve(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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

          $check_booking="SELECT * FROM vehicle_book_details WHERE TokenNo='$TokenNo'";
          $check_booking_run=mysqli_query($conn,$check_booking);
          if (mysqli_num_rows($check_booking_run)>0)
           {
            $dates_update_after_forward="UPDATE  vehicle_book_details SET vehicle_id='$vehicle_name',from_date='$journey_start_date',to_date='$journey_end_date',driver_id='$driver' where TokenNo='$TokenNo'";
          }
          else
          {
      $dates_update_after_forward="INSERT into  vehicle_book_details SET vehicle_id='$vehicle_name',from_date='$journey_start_date',to_date='$journey_end_date',driver_id='$driver',TokenNo='$TokenNo'";
             }
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
      $type=$_POST['id'];
      $journey_start_date=$_POST['journey_start_date'];
      $journey_end_date=$_POST['journey_end_date'];
      
      ?>
    <option value="">Select</option>
    <?php 
           $from=date("Y-m-d H:i:s", strtotime($journey_start_date));
          $to=date("Y-m-d H:i:s", strtotime($journey_end_date));
          $show_all_vehicle="SELECT * FROM vehicle where type_id='$type' ";
          $show_all_vehicle_run=$conn->query($show_all_vehicle);
          $v_count=0;
          while($row_all=mysqli_fetch_array($show_all_vehicle_run))
          {
        $chek_booking="SELECT * FROM vehicle_book_details  WHERE  status='0' and vehicle_id='".$row_all['id']."'";
      
          $chek_booking_run=$conn->query($chek_booking);
                         if($row=mysqli_fetch_array($chek_booking_run))
                         {
      $existingStartTime = date('Y-m-d H:i:s', strtotime($row['from_date']));
      $existingEndTime = date('Y-m-d H:i:s', strtotime($row['to_date']));
      // Calculate the overlapping duration
      $overlapDuration = max(0, min(strtotime($existingEndTime), strtotime($to)) - max(strtotime($existingStartTime), strtotime($from)));
      $overlapDurationMinutes = floor($overlapDuration / 60);
      $hours = floor($overlapDurationMinutes / 60);
      $overlapDurationMinutes=($overlapDurationMinutes%60);
      if ($overlapDurationMinutes > 0) 
      {
       $v_count++;
       ?>
    <option value="Not" style="color:red;"><b>Not Available:</b><?=$row_all['name'];?>(<?=$row_all['vehicle_number'];?>)
    </option>
    <?PHP 
      } 
      else 
      { 
         ?>
    <!-- <option value="<?=$row_all['id'];?>"><?=$row_all['name'];?>(<?=$row_all['vehicle_number'];?>)</option> -->
    <?php 
      }
                           }
                           ?>
    <option value="<?=$row_all['id'];?>"><?=$row_all['name'];?>(<?=$row_all['vehicle_number'];?>)</option>
    <?PHP 
      }
      
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
                <th>Requested By</th>
            </tr>
        </thead>
        <tbody>
            <?php  $sr=1; $get_pending="SELECT DISTINCT vehicle_allotment.token_no,vehicle_allotment.submit_date_time,vehicle_types.name as v_name,vehicle_allotment.name as e_name FROM 
            vehicle_allotment_process inner join vehicle_allotment  ON 
            vehicle_allotment_process.token_no=vehicle_allotment.token_no
             inner join vehicle_types ON vehicle_allotment.vehicle_type=vehicle_types.id 
              where  vehicle_allotment.status='5'"; 
                 $get_pending_run=mysqli_query($conn,$get_pending);
                 while($get_row=mysqli_fetch_array($get_pending_run))
                 {
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td onclick="show_timeline_verification_alott(<?=$get_row['token_no'];?>);"><a href="#"><B
                            class="text-primary"><?=$get_row['token_no'];?></B></a></td>
                <td><?=$get_row['v_name'];?></td>
                <!-- <td><?=date("d-m-Y h:i:A", strtotime($get_row['submit_date_time']));?></td> -->
                <td><?=$get_row['e_name'];?></td>
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
      
          $check_flow_auth="SELECT * FROM flow_auth where type='1'";
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
        $check_flow="SELECT status,journey_start_date,journey_end_date FROM  vehicle_allotment  Where token_no='$TokenNo'";
       $check_flow_run=mysqli_query($conn,$check_flow);
       if($check_flow_row=mysqli_fetch_array($check_flow_run))
       {
      
      if ($check_flow_row['status']<=4 && $check_flow_row['status']!=2)
      {
      ?>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <?PHP 
if ($check_flow_row['status']<4) {
?>
        <label class="btn btn-warning  btn-xs ">
            <input type="radio" name="options" onclick="toggleDiv_approve();" id="option_a1" autocomplete="off">
            Available
        </label>
        <?PHP }?>

        <label class="btn btn-danger btn-xs">
            <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
        </label>
        <label class="btn btn-success btn-xs">
            <input type="radio" name="options" onclick="toggleDiv_allotment();" id="option_a3" autocomplete="off">
            Allotment
        </label>
    </div>
    <textarea class="form-control " placeholder="Available Remarks" rows="3" id="comment_approve"
        style="display:none;margin-top: 10px;"></textarea>
    <input type="button" class="btn btn-success btn-xs" id="btn_comment_approve" onclick="approve_by_allotment_auth();"
        value="Submit" style="display:none;">
    <textarea class="form-control " rows="3" placeholder="Rejected Remarks" id="comment_reject"
        style="display:none;margin-top: 10px;"></textarea>
    <input type="button" class="btn btn-success btn-xs" id="btn_comment_reject" onclick="reject_by_allotment_auth();"
        value="Submit" style="display:none;">
    <div class="row">

        <div class="col-lg-12" id="comment_allotment" style="display:none;margin-top: 10px;">
            <div class="row">


                <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary15" onclick="bydriver();" value="ByDriver" name="empc12"
                        checked>
                    <label>
                        Driver
                    </label>
                </div>
                &nbsp;
                &nbsp;
                <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary20" onclick="selfdrive();" value="Self Drive" name="empc12">
                    <label>
                        Self
                    </label>
                </div>
            </div>



            <label>Type of Vehicle</label>
            <select class="form-control" onchange="drop_type_vehicle(this.value);" id="type">
                <option value="">Select</option>
                <?php  $get_type1="SELECT * FROM vehicle_types";
               $get_type_run1=mysqli_query($conn,$get_type1);
               while($row1=mysqli_fetch_array($get_type_run1))
               {?>
                <option value="<?=$row1['id'];?>"><?=$row1['name'];?></option>
                <?php 
               }
               ?>
            </select>
            <input type="hidden" id="journey_start_date" value="<?=$check_flow_row['journey_start_date'];?>">
            <input type="hidden" id="journey_end_date" value="<?=$check_flow_row['journey_end_date'];?>">
            <label> Vehicle</label>
            <select class="form-control" id="vehicle_name">
                <option value="">Select</option>
            </select>
            <div id="self_div" style="display:none;">
                <label>Employee ID</label>
                <input type="number" id="empID_self" class="form-control" placeholder="Search ID"
                    onkeyup="emp_detail_verify(this.value);">
                <p id="emp_detail_status_"></p>
            </div>

            <div id="driver_div">
                <label> Driver Name</label>
                <select class="form-control" id="driver">
                    <?php  $get_type="SELECT * FROM Staff Where Designation='Driver' and JobStatus='1'";
               $get_type_run=sqlsrv_query($conntest,$get_type);
               while($row=sqlsrv_fetch_array($get_type_run,SQLSRV_FETCH_ASSOC))
               {?>
                    <option value="<?=$row['IDNo'];?>"><?=$row['Name'];?>&nbsp;(<?=$row['IDNo'];?>)</option>
                    <?php 
               }
                ?>
                </select>
            </div>
        </div>
    </div>
    <input type="button" class="btn btn-success btn-xs" id="btn_comment_allotment"
        onclick="allotment_by_allotment_auth();" value="Submit" style="display:none;">
    <?php
      }
      elseif($check_flow_row['status']==5)
      {
      ?>
    <form action="transport_allotted_slip.php" method="POST" target="_blank">
        <!-- <input type="hidden" name="token_no" value="<?=$check_flow_row['token_no'];?>"> -->
        <input type="hidden" name="token_no" value="<?=$TokenNo;?>">
        <input type="submit" class="btn btn-primary btn-xs" value="Print">
    </form>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-success btn-xs">
            <input type="radio" name="options" onclick="toggleDiv_allotment();" id="option_a3" autocomplete="off">
            ReAllotment
        </label>
    </div>
    <div class="row">
        <div class="col-lg-12" id="comment_allotment" style="display:none;margin-top: 10px;">


            <div class="row">


                <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary15" onclick="bydriver();" value="ByDriver" name="empc1" checked>
                    <label>
                        Driver
                    </label>
                </div>
                &nbsp;
                &nbsp;
                <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary20" onclick="selfdrive();" value="Self Drive" name="empc1">
                    <label>
                        Self
                    </label>
                </div>
            </div>


            <label>Type of Vehicle</label>
            <select class="form-control" onchange="drop_type_vehicle(this.value);" id="type">
                <option value="">Select</option>
                <?php  $get_type1="SELECT id,name FROM vehicle_types";
               $get_type_run1=mysqli_query($conn,$get_type1);
               while($row1=mysqli_fetch_array($get_type_run1))
               {?>
                <option value="<?=$row1['id'];?>"><?=$row1['name'];?></option>
                <?php 
               }
               ?>
            </select>
            <input type="hidden" id="journey_start_date" value="<?=$check_flow_row['journey_start_date'];?>">
            <input type="hidden" id="journey_end_date" value="<?=$check_flow_row['journey_end_date'];?>">
            <label> Vehicle</label>
            <select class="form-control" id="vehicle_name">
                <option value="">Select</option>

            </select>
            <div id="self_div" style="display:none;">
                <label>Employee ID</label>
                <input type="number" id="empID_self" class="form-control" placeholder="Search ID"
                    onkeyup="emp_detail_verify(this.value);">
                <p id="emp_detail_status_"></p>
            </div>


            <div id="driver_div">
                <label> Driver Name</label>
                <select class="form-control" id="driver">
                    <option value="">Select</option>

                    <?php  $get_type="SELECT IDNo,Name FROM Staff Where Designation='Driver' and JobStatus='1'";
               $get_type_run=sqlsrv_query($conntest,$get_type);
               while($row=sqlsrv_fetch_array($get_type_run,SQLSRV_FETCH_ASSOC))
               {?>
                    <option value="<?=$row['IDNo'];?>"><?=$row['Name'];?>&nbsp;(<?=$row['IDNo'];?>)</option>
                    <?php 
               }
               ?>
                </select>
            </div>

        </div>
    </div>
    <input type="button" class="btn btn-success btn-xs" id="btn_comment_allotment"
        onclick="allotment_by_allotment_auth();" value="Submit" style="display:none;">
    <?php
      }
      else
      {
      
      
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
      ?>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-warning  btn-xs ">
            <input type="radio" name="options" onclick="toggleDiv_recommend();" id="option_a1" autocomplete="off">
            Recommend
        </label>
        <label class="btn btn-danger btn-xs">
            <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
        </label>
    </div>
    <textarea class="form-control " placeholder="Approved Remarks" rows="3" id="comment_recommend"
        style="display:none; margin-top: 10px;"></textarea>
    <input type="button" class="btn btn-success btn-xs" id="btn_comment_recommend" onclick="recommend_by_verify();"
        value="Submit" style="display:none;">
    <textarea class="form-control " rows="3" placeholder="Rejected Remarks" id="comment_reject"
        style="display:none; margin-top: 10px;"></textarea>
    <input type="button" class="btn btn-success btn-xs" id="btn_comment_reject" onclick="reject_by_verify();"
        value="Submit" style="display:none;">
    <?php   // code...
      }
         }
            ?>
    <?php
      }
      
      elseif($code==74)
      {
      $TokenNo=$_POST['Token_No'];
                   $check_flow="SELECT status FROM  vehicle_allotment  Where token_no='$TokenNo'";
      $check_flow_run=mysqli_query($conn,$check_flow);
      if($check_flow_row=mysqli_fetch_array($check_flow_run))
      {
      
      if ($check_flow_row['status']==6)
      {
      ?>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-success  btn-xs ">
            <input type="radio" name="options" onclick="toggleDiv_approve();" id="option_a1" autocomplete="off"> Approve
        </label>
        <label class="btn btn-danger btn-xs">
            <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
        </label>
    </div>
    <textarea class="form-control " placeholder="Approved Remarks" rows="3" id="comment_approve"
        style="display:none;margin-top: 10px;"></textarea>
    <input type="button" class="btn btn-success btn-xs" id="btn_comment_approve" onclick="approve_by_approved_auth();"
        value="Submit" style="display:none;">
    <textarea class="form-control " rows="3" placeholder="Rejected Remarks" id="comment_reject"
        style="display:none;margin-top: 10px;"></textarea>
    <input type="button" class="btn btn-success btn-xs" id="btn_comment_reject" onclick="reject_by_approved_auth();"
        value="Submit" style="display:none;">
    <?php   // code...
      }
      elseif ($check_flow_row['status']==5)
       {
      ?>
    <form action="transport_allotted_slip.php" method="POST" target="_blank">
        <input type="hidden" name="token_no" value="<?=$TokenNo;?>">
        <input type="submit" class="btn btn-primary btn-xs" value="Print">
    </form>
    <?php 
      }
        
      }
      }
      elseif($code==75)
      {?>
    <div class="row">
        <?php 
         $empID=$_POST['emp_id'];
         $get_flow_user="SELECT * FROM flow_user Where emp_id='$empID' and type='1'";
         $get_flow_user_run=$conn->query($get_flow_user);
         if($row=mysqli_fetch_array($get_flow_user_run))
         {
           
              ?>
        <div class="input-group input-group-sm">
            <input type="hidden" id="empID" value="<?=$empID;?>">
            <input type="text" class="form-control" id="flow_value" value="">
            <input type="button" onclick="add_flow(<?=$empID;?>);" class="btn btn-success btn-xs" value="ADD">
        </div>
        <?php 
         }
         else
         {
           
           ?>
        <div class="input-group input-group-sm">
            <input type="hidden" id="empID" value="<?=$empID;?>">
            <input type="text" class="form-control" id="flow_value" value="">
            <input type="button" onclick="add_flow(<?=$empID;?>);" class="btn btn-success btn-xs" value="ADD">
        </div>
        <?php 
         }
         ?>
    </div>
    <?php 
      }
      
      elseif($code==76)
      {?>
    <div class="col-lg-12">
        <table class="table table-bordered border-primary ">
            <tr>
                <th>#</th>
                <th>Date/Vehicle Number</th>
                <th>Vehicle Name</th>
                <th>Status</th>
            </tr>
            <?php 
            $type=$_POST['type'];
            $from1=$_POST['from'];
             $from=date("Y-m-d H:i:s", strtotime($from1));
            $to1=$_POST['to'];
            $to=date("Y-m-d H:i:s", strtotime($to1));
            $show_all_vehicle="SELECT * FROM vehicle where type_id='$type' ";
            $show_all_vehicle_run=$conn->query($show_all_vehicle);
            $sr=1;
            $av_coount=0;
            while($row_all=mysqli_fetch_array($show_all_vehicle_run))
            {
            $chek_booking="SELECT * FROM vehicle_book_details  WHERE status='0' and   vehicle_id='".$row_all['id']."'";
            $chek_booking_run=$conn->query($chek_booking);
                           if($row=mysqli_fetch_array($chek_booking_run))
                           {
            $existingStartTime = date('Y-m-d H:i:s', strtotime($row['from_date']));
            $existingEndTime = date('Y-m-d H:i:s', strtotime($row['to_date']));
            // Calculate the overlapping duration
            $overlapDuration = max(0, min(strtotime($existingEndTime), strtotime($to)) - max(strtotime($existingStartTime), strtotime($from)));
            $overlapDurationMinutes = floor($overlapDuration / 60);
            $hours = floor($overlapDurationMinutes / 60);
            $overlapDurationMinutes=($overlapDurationMinutes%60);
            if ($overlapDurationMinutes > 0) 
            {
            
            ?>
            <tr>
                <td><?=$sr;?></td>
                <td><?=date("d-m-Y h:i:A", strtotime($row['from_date']));?> <b>To</b>
                    <?=date("d-m-Y h:i:A", strtotime($row['to_date']));echo "<br><small class='text-danger'>This time slot is not available. Overlapping duration: ".$hours .'&nbsp;hours and&nbsp;' . $overlapDurationMinutes . " minutes.</small>"; ?>
                </td>
                <td><?=$row_all['name']; ?></td>
                <td><b class="text-danger">Not Availble</b></td>

            </tr>
            <tr>
                <!-- <td colspan="4"><?php ?></td> -->
            </tr>
            <?php
            } 
            else 
            { $av_coount++;
               ?>
            <tr>
                <td><?=$sr;?></td>
                <td><?=$row_all['vehicle_number'];?></td>
                <td><?=$row_all['name'];?></td>
                <td><b class="text-success">Availble</b></td>
            </tr>
            <?php 
            }
                                 }
                                 else
                                 {
                                    $av_coount++;
                                    ?>
            <tr>
                <td><?=$sr;?></td>
                <td><?=$row_all['vehicle_number'];?></td>
                <td><?=$row_all['name'];?></td>
                <td><b class="text-success">Availble</b></td>

            </tr>
            <?php 
            }
            $sr++;   }?>
        </table>
    </div>
    <?php 
      if ($av_coount>0) 
      {
        ?>
    <div class="col-lg-12">
        <label>Station (s) to be visited<span class="text-danger">&nbsp;*</span></label>
        <input type="text" class="form-control" id="station">
    </div>
    <div class="col-lg-12">
        <label>Purpose <span class="text-danger">&nbsp;*</span></label>
        <input type="text" class="form-control" id="purpose">
    </div>
    <div class="col-lg-12">

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onclick="create_request();">Submit</button>
        </div>
    </div>
    <?php 
      }
         }
         elseif($code==77)
         {
      $id=$_POST['id'];
      $marks_as_print="UPDATE degree_print SET Status='1'  WHERE id='$id'";
      $marks_as_print_run=$conn->query($marks_as_print);
      if ($marks_as_print_run==true) 
      {
      echo "1";   // code...
      }
      else
      {
         echo "0";
      }
         } 
               elseif($code==78)
      {

        

         $up_date=$_POST['upload_date'];
         $by_search=$_POST['by_search'];
         $by_search_college=$_POST['by_search_college'];
         $by_search_StreamName=$_POST['by_search_StreamName'];
                   if($by_search!='')
                   {
                    $degree="SELECT * FROM degree_print where StudentName like '%$by_search%' or UniRollNo like '%$by_search%' order by Id ASC "; 
                   }
                   elseif ($by_search_college!='' && $by_search_StreamName!='')
                    {
                    # code...
                    $degree="SELECT * FROM degree_print where Course='$by_search_college' and Stream='$by_search_StreamName'  order by Id ASC  ";                     
                   }
                   elseif ($by_search_college!='')
                    {
                    
                    $degree="SELECT * FROM degree_print where Course='$by_search_college'  order by Id ASC  ";                     
                   }
                   else
                   {
                       $degree="SELECT * FROM degree_print where upload_date='$up_date'  order by Id ASC  ";                     
                   }
                     $degree_run=mysqli_query($conn,$degree);
                     while ($degree_row=mysqli_fetch_array($degree_run)) 
                     {
                      $data1=$degree_row;
                    $uni=$degree_row['UniRollNo'];
                    $get_pending="SELECT Sex FROM Admissions where UniRollNo='$uni'";

                  $get_pending_run=sqlsrv_query($conntest,$get_pending);
                  if($row_pending=sqlsrv_fetch_array($get_pending_run))
                  {
            $data2=$row_pending;

                  } 

                   $data[]=array_merge($data1,$data2);
                    }
                    //   print_r($data);
                     $page = $_POST['page'];
                     $recordsPerPage = 100;
                     $startIndex = ($page - 1) * $recordsPerPage;
                     $pagedData = array_slice($data, $startIndex, $recordsPerPage);
                     
                         echo json_encode($pagedData);
 
 
        
 
                
                     

      }
   elseif($code==79)
   {
      $month="";
      $year="";
      $todate=date('Y-m-d');
      $Stream="";
      $ExtraRow="";
      $Outof="";
      $CollegeName="";
$CourseHead="";
$QrCourse="";
   $file = $_FILES['file']['tmp_name'];
   if(isset($_POST['month']))
   {
   $month=$_POST['month'];
   $year=$_POST['year'];
   $Examination=$month.' '.$year;

   } 
    if(isset($_POST['extra']))
   {
   $ExtraRow=$_POST['extra'];
   }
   $Type=$_POST['type'];
   $handle = fopen($file, 'r');
   $c = 0;
   $firstLine=true;
   while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
   {
    if ($firstLine) {
        $firstLine = false;
        continue; // Skip processing the first line
    }
    
    $StudentName = $filesop[0];
    $UniRollNo = $filesop[1];
    $FatherName = $filesop[2];
    $CollegeName = $filesop[3];
    $CourseHead = $filesop[4];
    $Course = $filesop[5];
    $RegistrationNo = $filesop[6];
    $CGPA = $filesop[7];
    $Outof = $filesop[8];
    $Stream = $filesop[9];
   
    if($filesop[10]=='')
    {
$QrCourse=$Course.'('.$Stream.')';
    }
    else
    {
        $QrCourse = $filesop[10];
    }
    
   
    $checkQuery = "SELECT * FROM `degree_print` WHERE `UniRollNo` = '$UniRollNo'";
    $checkResult = mysqli_query($conn, $checkQuery);
    
    if (mysqli_num_rows($checkResult) > 0) {
        ?>
    <script type="text/javascript">
    alert(' UniRollNo <?php echo $UniRollNo; ?> already exists in the database');
    window.location.href = 'degree_generate.php';
    </script>
    <?php
    } else {
        $insert = "INSERT INTO `degree_print` (`UniRollNo`, `CGPA`, `StudentName`, `FatherName`, `RegistrationNo`, `Course`, `Examination`, `ExtraRow`, `Type`, `Stream`, `upload_date`, `Outof`,`CollegeCsv`,`Course1`,`QrCourse`) VALUES ('$UniRollNo', '$CGPA', '$StudentName', '$FatherName', '$RegistrationNo', '$Course', '$Examination', '$ExtraRow', '$Type', '$Stream', '$todate', '$Outof','$CollegeName','$CourseHead','$QrCourse');";
        $insert_run = mysqli_query($conn, $insert);
    
        if ($insert_run == true) {
            ?>
    <script type="text/javascript">
    alert('Uploaded Success');
    window.location.href = 'degree_generate.php';
    </script>
    <?php
        } else {
            
            echo "Error: " . mysqli_error($conn);
        }
    }
   }
   }
   elseif($code==80)
   {
   $emp_id=$_POST['emp_id'];         
      $result = mysqli_query($conn, "SELECT * FROM flow_user WHERE type='1' and emp_id='$emp_id'");
              if ($row = mysqli_fetch_array($result)) 
              {
                $user_flow_array = $row["flow"];
                $user_flow_array_ar = explode(",", $user_flow_array);
                foreach ($user_flow_array_ar as $key => $value) {
   
                       $staff="SELECT Name FROM Staff Where IDNo='$value'";
         $stmt = sqlsrv_query($conntest,$staff);  
         if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
         {
                  ?>
    <li id="<?php echo $value; ?>"><b><?php echo $value; ?></b>&nbsp;(<?=$row_staff['Name'];?>)</li>
    <?php 
   }
   else
   {
?>
    <li id="<?php echo $value; ?>"><b><?php echo $value; ?></b>(Direct)</li>
    <?php
   }
   }
   ?>
    <i class="fa fa-trash fa-lg text-danger" onclick="delete_flow_transport(<?=$emp_id;?>);"></i>
    <?php  
   }
   else
   {
    echo "<small>-----------No Flow Found----------</small>";
   }
     } 
   
       elseif($code==81)
   {
   $emp_id=$_POST['emp_id'];         
   $item_order=$_POST['item_order']; 
   $up_flow=implode(",", $item_order);
   $update_flow="UPDATE flow_user SET flow='$up_flow' WHERE emp_id='$emp_id' and type='1'";
   $update_flow_run=mysqli_query($conn,$update_flow);
   if ($update_flow_run==true) {
   echo "1";
   }     
   else{
   echo "0";
   }   
   
     }  
   
   elseif($code==82)
   {
   $emp_id=$_POST['emp_id'];         
   $flow_value=$_POST['flow_value']; 
   
   $check_flow="SELECT * FROM flow_user Where emp_id='$emp_id' and type='1'";
   $check_flow_run=mysqli_query($conn,$check_flow);
   $flow_exit=mysqli_num_rows($check_flow_run);
   if ($flow_exit>0) 
   {
   if($row=mysqli_fetch_array($check_flow_run))
   {
   if ($row['flow']=='0') 
   {
   $update_flow = "UPDATE flow_user SET flow ='$flow_value'  WHERE emp_id = '$emp_id' AND type='1'";
   }
   else
   {
   $update_flow = "UPDATE flow_user SET flow = CONCAT(flow, ',', '$flow_value') WHERE emp_id = '$emp_id' AND type='1'";
   }
   }
   
   }
   else
   {
   $update_flow="INSERT into flow_user (emp_id,flow,type)values('$emp_id','$flow_value','1')";
   }
   $update_flow_run=mysqli_query($conn,$update_flow);
   if ($update_flow_run==true) {
   echo "1";
   }     
   else{
   echo "0";
   }   
   
     }
     elseif($code==83)
     {
       $emp_id=$_POST['emp_id'];
          $staff="SELECT Name,Department,Designation,CollegeName,Snap,ContactNo FROM Staff Where IDNo='$emp_id'";
   $stmt = sqlsrv_query($conntest,$staff);  
   if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
   {
   
   $emp_image = $row_staff['Snap'];
   
   
   $name = $row_staff['Name'];
   
   $college = $row_staff['CollegeName'];
   $dep = $row_staff['Department'];
   $designation = $row_staff['Designation'];
   $mob1 = $row_staff['ContactNo'];
   
   
   ?>
    <br>
    <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header badge-success">
            <div class="row">
                <div class="col-lg-11 col-sm-10">
                    <div class="widget-user-image">
                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($emp_image).'" height="30px" width="30px" class="img-circle elevation-2"  style="border-radius:50%"/>';?>
                    </div>
                    <!-- /.widget-user-image -->
                    <h6 class="widget-user-desc"><?=$name; ?> </h6>
                    <h6 class="widget-user-desc"><?= $designation;?></h6>
                    <h6 class="widget-user-desc"> M. <?= $mob1 ?></h6>
                    <h6 class="widget-user-desc"> <?= $dep ?></h6>
                </div>
                <div class="col-lg-1 col-sm-1">
                </div>
            </div>
        </div>
    </div>
    <?php 
   }
   else
   {
         echo "<small style='color:red;text-align:center!important;'>-----------Invalid User ID----------</small>";
   
   }
          }
   
             elseif($code==84)
   {?>
    <div class="row">
        <?php 
      $empID=$_POST['emp_id'];
      $get_flow_user="SELECT * FROM flow_user Where emp_id='$empID' and type='2'";
      $get_flow_user_run=$conn->query($get_flow_user);
      if($row=mysqli_fetch_array($get_flow_user_run))
      {
       
           ?>
        <div class="input-group input-group-sm">
            <input type="hidden" id="empID" value="<?=$empID;?>">
            <input type="text" class="form-control" id="flow_value_in" value="">
            <input type="button" onclick="add_flow_in(<?=$empID;?>);" class="btn btn-success btn-xs" value="ADD">
        </div>
        <!-- </div>  -->
        <?php 
      }
      else
      {
        
        ?>
        <div class="input-group input-group-sm">
            <input type="hidden" id="empID" value="<?=$empID;?>">
            <input type="text" class="form-control" id="flow_value_in" value="">
            <input type="button" onclick="add_flow_in(<?=$empID;?>);" class="btn btn-success btn-xs" value="ADD">
        </div>
        <?php 
      }
      ?>
    </div>
    <?php 
   }
   
          elseif($code==85)
   {
   $emp_id=$_POST['emp_id'];         
         $result = mysqli_query($conn, "SELECT * FROM flow_user WHERE type = '2' and emp_id='$emp_id'");
                 if ($row = mysqli_fetch_array($result)) 
                 {
                   $user_flow_array = $row["flow"];
                   $user_flow_array_ar = explode(",", $user_flow_array);
                   foreach ($user_flow_array_ar as $key => $value)
                    {
                     $staff="SELECT Name FROM Staff Where IDNo='$value'";
            $stmt = sqlsrv_query($conntest,$staff);  
            if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
                     ?>
    <li id="<?php echo $value; ?>"><b><?php echo $value; ?></b>&nbsp;(<?=$row_staff['Name'];?>)</li>
    <?php 
   } 
   else
   {
      ?>
    <li id="<?php echo $value; ?>"><b><?php echo $value; ?></b>(Direct)</li>
    <?php 
   }
   }
   ?>
    <i class="fa fa-trash fa-lg text-danger" onclick="delete_flow_inventry(<?=$emp_id;?>);"></i><?php 
   }
   else
   {
                      echo "<small>-----------No Flow Found----------</small>";
   
   }
   
     } 
   
              elseif($code==86)
   {
   $emp_id=$_POST['emp_id'];         
   $item_order=$_POST['item_order']; 
   $up_flow=implode(",", $item_order);
   $update_flow="UPDATE flow_user SET flow='$up_flow' WHERE emp_id='$emp_id' and type='2'";
   $update_flow_run=mysqli_query($conn,$update_flow);
   if ($update_flow_run==true) {
   echo "1";
   }     
   else{
   echo "0";
   }   
   
     }
     elseif($code==87)
     {
         $emp_id=$_POST['emp_id'];         
   $flow_value=$_POST['flow_value']; 
   
   $check_flow="SELECT * FROM flow_user Where emp_id='$emp_id' and type='2'";
   $check_flow_run=mysqli_query($conn,$check_flow);
   $flow_exit=mysqli_num_rows($check_flow_run);
   if ($flow_exit>0) 
   {
   if($row=mysqli_fetch_array($check_flow_run))
   {
   if ($row['flow']=='0') 
   {
   $update_flow = "UPDATE flow_user SET flow ='$flow_value'  WHERE emp_id = '$emp_id' AND type='2'";
   }
   else
   {
   $update_flow = "UPDATE flow_user SET flow = CONCAT(flow, ',', '$flow_value') WHERE emp_id = '$emp_id' AND type='2'";
   }
   }
   
   }
   else
   {
   $update_flow="INSERT into flow_user (emp_id,flow,type)values('$emp_id','$flow_value','2')";
   }
   $update_flow_run=mysqli_query($conn,$update_flow);
   if ($update_flow_run==true) {
   echo "1";
   }     
   else{
   echo "0";
   }   
     } 
     elseif($code==88)
     {
   $emp_id=$_POST['emp_id'];
   $delete_flow="DELETE FROM  flow_user WHERE  emp_id='$emp_id' and type='1'";
   $delete_flow_run=mysqli_query($conn,$delete_flow);
   if ($delete_flow_run==true) {
   echo "1";
   }
     } 
   
      elseif($code==89)
     {
   $emp_id=$_POST['emp_id'];
   $delete_flow="DELETE FROM  flow_user WHERE  emp_id='$emp_id' and type='2'";
   $delete_flow_run=mysqli_query($conn,$delete_flow);
   if ($delete_flow_run==true) {
   echo "1";
   }
     }
       elseif($code==90)
      {
      $userId=$_POST['userId'];
      $TokenNo=$_POST['token'];
      $forward_remarks=$_POST['forward_remarks'];
      
           $check_flow="SELECT * FROM flow_user inner join vehicle_allotment ON flow_user.emp_id=vehicle_allotment.emp_id Where flow_user.emp_id='$userId' and vehicle_allotment.token_no='$TokenNo' and flow_user.type='1'";
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
           $check_flow_auth="SELECT * FROM flow_auth where type='1'";
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
           if ($get_auth_details_row=sqlsrv_fetch_array($get_auth_details_run,SQLSRV_FETCH_ASSOC)) 
           {
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
           if($insert_request_process_run==true) 
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
 elseif($code==91)
 {
$UniRollNo=$_POST['uni'];
     $get_student_details="SELECT IDNo,Snap,Batch,Sex FROM Admissions where UniRollNo='$UniRollNo'";
                          $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                          if($row_student=sqlsrv_fetch_array($get_student_details_run))
                          {
                              $snap=$row_student['Snap'];
                                 $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime_type = $finfo->buffer($snap);
    $extension = '';
    switch ($mime_type) {
        case 'image/jpeg':
            $extension = 'jpg';
            break;
        case 'image/png':
            $extension = 'png';
            break;
        
    }
    // echo $extension;
    $pic = base64_encode($snap);
    // $pic = base64_encode($pic);
    ?>
    <img src="data:<?php echo $mime_type; ?>;base64,<?php echo $pic; ?>" width="300" height="300">
    <br>
    <a href="data:<?php echo $mime_type; ?>;base64,<?php echo $pic; ?>"
        download="<?php echo $UniRollNo; ?>.<?php echo $extension; ?>"><button class="btn btn-success btn-sm">Download
            Image</button></a>

    <form id="image-upload" name="image-upload" action="action_g.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image" class="form-control input-group-sm">
        <input type="hidden" name="unirollno" value="<?php echo $UniRollNo; ?>">
        <input type="hidden" name="code" value="92">
        <input type="button" value="Upload" class="btn btn-success btn-xs"
            onclick="uploadImage(this.form,'<?php echo $UniRollNo; ?>')">
    </form>
    <div id="result"></div>

    <?php
               
                              
                           

                          }
 }
 else if($code==92)
 {
 
   $UniRollNo=$_POST['unirollno'];
    $get_student_details="SELECT IDNo FROM Admissions where UniRollNo='$UniRollNo'";
                          $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                          if($row_student=sqlsrv_fetch_array($get_student_details_run))
                          {
   $IDNo=$row_student['IDNo'];
}
     $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $type = $_FILES['image']['type'];
     $file_data = file_get_contents($file_tmp);
    $characters = '';
   $result = $IDNo;
   $image_name =$result;
   $ftp_server1 = "10.0.10.11";
   $ftp_user_name1 = "Gurpreet";
   $ftp_user_pass1 = "Guri@123";
   $remote_file1 = "";
   $conn_id = ftp_connect($ftp_server1) or die("Could not connect to $ftp_server");
   $login_result = ftp_login($conn_id, $ftp_user_name1, $ftp_user_pass1) or die("Could not login to $ftp_server1");
   $destdir = 'Students';
   ftp_chdir($conn_id, "Students/") or die("Could not change directory");
   ftp_pasv($conn_id,true);
   file_put_contents($destdir.$image_name.'.PNG',$file_data);
   ftp_put($conn_id,$image_name.'.PNG',$destdir.$image_name.'.PNG',FTP_BINARY) or die("Could not upload to $ftp_server1");
   ftp_close($conn_id);
   $upimage = "UPDATE Admissions SET Snap = ? WHERE UniRollNo = ?";
$params = array($file_data, $UniRollNo);
$upimage_run = sqlsrv_query($conntest, $upimage, $params);
if ($upimage_run === false) {
    $errors = sqlsrv_errors();
    // echo "Error: " . print_r($errors, true);
    // echo "0";
} 
else
 {
    echo "1";
}
 }
 else if($code==93)
 {
   $data=array();
      $page=$_POST['searchData'];

                      $degree="SELECT * FROM degree_print  where UniRollNo='".$page["search"]."'";                     
                     $degree_run=mysqli_query($conn,$degree);
                     while ($degree_row=mysqli_fetch_array($degree_run)) 
                     {
                      
                     $data[]=$degree_row;
                     }
                     // print_r($row_student);
                     echo json_encode($data);
                   
                    // echo print_r($data);

      
 }
elseif($code==94)
{
   
   $loginId = $_POST["loginId"];
   $name = $_POST["name"];
   $fatherName = $_POST["fatherName"];
   $motherName = $_POST["motherName"];
   $designation = $_POST["designation"];
   $dob = $_POST["dob"];
   $gender = $_POST["gender"];
   $category = $_POST["category"];
   $panNumber = $_POST["panNumber"];
   $personalEmail = $_POST["personalEmail"];
   $officialEmail = $_POST["officialEmail"];
   $mobileNumber = $_POST["mobileNumber"];
   $whatsappNumber = $_POST["whatsappNumber"];
   $emergencyContactNumber = $_POST["emergencyContactNumber"];
   $officialMobileNumber = $_POST["officialMobileNumber"];
   $addressLine1 = $_POST["addressLine1"];
   $addressLine2 = $_POST["addressLine2"];
   $PostalCode = $_POST["postalCode"];
   $permanentAddress = $_POST["permanentAddress"];
   $correspondenceAddress = $_POST["correspondenceAddress"];
   $organisationID = $_POST["organisationName"];

 $get_college="SELECT  * FROM MasterCourseCodes where CollegeID='$organisationID' ";
                        $get_collegeRun=sqlsrv_query($conntest,$get_college);
                      if($get_collegeRow=sqlsrv_fetch_array($get_collegeRun,SQLSRV_FETCH_ASSOC))
                                                { 
                                                  $organisationName=$get_collegeRow['CollegeName'];
                                                }
   
   $departmentName = $_POST["departmentName"];
   $get_Department="SELECT  * FROM MasterDepartment where Id='$departmentName' ";
                        $get_DepartmentRun=sqlsrv_query($conntest,$get_Department);
                      if($get_DepartmentRow=sqlsrv_fetch_array($get_DepartmentRun,SQLSRV_FETCH_ASSOC))
                                                { 
                                                  $DepartmentID=$get_DepartmentRow['Department'];
                                             }
   $joiningDate = $_POST["joiningDate"];
    $Nationality1 = $_POST["nationality_by_post"];
   $salary = $_POST["salary"];
   $EmpCategory = $_POST["EmpCategory"];
   $employmentType = $_POST["employmentType"];
   $employmentStatus = $_POST["employmentStatus"];
   $leaveSanctionAuthority1 = $_POST["leaveSanctionAuthority"];
   $leaveRecommendingAuthority1 = $_POST["leaveRecommendingAuthority"];
   $bankAccountNo = $_POST["bankAccountNo"];
   $employeeBankName = $_POST["employeeBankName"];
   $bankIFSC = $_POST["bankIFSC"];

   // Handling file uploads
   $panCard = $_FILES["panCard"]["name"];
   $aadharCard = $_FILES["aadharCard"]["name"];
   $photo = $_FILES["photo"]["name"];
   $signature = $_FILES["signature"]["name"];
   if ($panCard) {
      $panCardTmp = $_FILES["panCard"]["tmp_name"];
      $file_type = str_ireplace("image/", ".", $_FILES['panCard']['type']);
      $panrImageName="PanCard_".$loginId.$file_type;
   ftp_put($conn_id, "Staff/StaffPanCard/$panrImageName", $panCardTmp, FTP_BINARY);
   }
   if ($aadharCard) {
      $aadharCardTmp = $_FILES["aadharCard"]["tmp_name"];
      $file_type = str_ireplace("image/", ".", $_FILES['aadharCard']['type']);
      $adharImageName="AadharCard_".$loginId.$file_type;
   ftp_put($conn_id, "Staff/StaffAadharCard/$adharImageName", $aadharCardTmp, FTP_BINARY); 
   }
   if ($photo) {
      $photoTmp = $_FILES["photo"]["tmp_name"];

      $file_type = str_ireplace("image/", ".", $_FILES['photo']['type']);
  $ImageName=$loginId.'.jpg';
   ftp_put($conn_id, "Staff/$ImageName", $photoTmp, FTP_BINARY);

    $file_data = file_get_contents($photoTmp);

        $upimage = "UPDATE Staff SET Snap = ? WHERE IDNo = ?";
$params = array($file_data, $loginId);
$upimage_run = sqlsrv_query($conntest, $upimage, $params);
   }
   if ($signature) {
      $signatureTmp = $_FILES["signature"]["tmp_name"];
  $file_type = str_ireplace("image/", ".", $_FILES['signature']['type']);
      $SignatureImageName="Signature".$loginId.$file_type;
   ftp_put($conn_id, "Staff/Signature/$SignatureImageName", $signatureTmp, FTP_BINARY);
   }
   $query = "UPDATE Staff SET ";
   $query .= "Name = '$name', ";
   $query .= "FatherName = '$fatherName', ";
   $query .= "MotherName = '$motherName', ";
   $query .= "Designation = '$designation', ";
   $query .= "DateOfBirth = '$dob', ";
   $query .= "Gender = '$gender', ";
   $query .= "Category = '$category', ";
   $query .= "PANNo = '$panNumber' ";
   $query .= ",EmailID = '$personalEmail', ";
   $query .= "OfficialEmailID = '$officialEmail', ";
   $query .= "MobileNo = '$mobileNumber', ";
   $query .= "WhatsAppNumber = '$whatsappNumber', ";
   $query .= "EmergencyContactNo = '$emergencyContactNumber', ";
   $query .= "OfficialMobileNo = '$officialMobileNumber', ";
   $query .= "AddressLine1 = '$addressLine1', ";
   $query .= "AddressLine2 = '$addressLine2', ";
   $query .= "PostalCode = '$PostalCode', ";
   $query .= "PermanentAddress = '$permanentAddress', ";
   $query .= "CorrespondanceAddress = '$correspondenceAddress' ";
   $query .= ",CollegeId = '$organisationID', ";
   $query .= "CollegeName = '$organisationName', ";
   $query .= "Department = '$DepartmentID', ";
   $query .= "DepartmentID = '$departmentName', ";
   $query .= "DateOfJoining = '$joiningDate', ";
   $query .= "Nationality = '$Nationality1', ";
   $query .= "Type = '$employmentType', ";
   $query .= "CategoryId = '$EmpCategory', ";
   $query .= "SalaryAtPresent = '$salary', ";
   $query .= "JobStatus = '$employmentStatus', ";
   $query .= "LeaveRecommendingAuthority = '$leaveRecommendingAuthority1', ";
   $query .= "LeaveSanctionAuthority = '$leaveSanctionAuthority1', ";
   $query .= "BankAccountNo = '$bankAccountNo', ";
   $query .= "BankName = '$employeeBankName', ";
   $query .= "BankIFSC = '$bankIFSC' ";
   $query .= "WHERE IDNo = '$loginId'";
 $query;
   if(sqlsrv_query($conntest,$query))
   {
      echo "1";
       $checkLeaveAlreadySubmited="SELECT * FROM ApplyLeaveGKU WHERE StaffId='$loginId'  and Status!='Approved' and Status!='Reject'";
        $countX=sqlsrv_query($conntest,$checkLeaveAlreadySubmited,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                  $leaveexistCount=sqlsrv_num_rows($countX);
                  if($leaveexistCount>0)
                  {
                  $updateLeaveAuth="UPDATE ApplyLeaveGKU SET SanctionId='$leaveRecommendingAuthority1',AuthorityId='$leaveSanctionAuthority1' where StaffId='$loginId'";
                      sqlsrv_query($conntest,$updateLeaveAuth);

                  }
   }
   else
   {
      echo "0";
   }
//    if ($query_run === false) {
//     $errors = sqlsrv_errors();
//     echo "Error: " . print_r($errors, true);
//     // echo "0";
// } 

}
elseif($code==95)
{
$IDNo=$_POST['IDNo'];
 $Label=$_POST['label'];
if ($Label=='Pan')
 {
                
      
                // echo '<iframe src="http://erp.gku.ac.in:86/Staff/StaffPanCard/PanCard_'.$IDNo.'.pdf" width="100%" height="500px"></iframe>';
             
}
elseif($Label=='Adhar')
{
    // $staff="SELECT AadharPath FROM Staff Where IDNo='$IDNo'";
    //         $stmt = sqlsrv_query($conntest,$staff);  
    //         if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
    //         {
    //         if ($row_staff['AadharPath']!='') 
    //            {
    //              echo '<iframe src="http://erp.gku.ac.in:86/'.str_replace('~/','',$row_staff['AadharPath']).'" width="100%" height="500px"></iframe>';
    //           }
    //           else
    //           {
    //            echo "No Document Fund";
    //           }

    //         }

}
elseif($Label=='Image')
{
    
                echo '<iframe src="http://10.0.10.11/getImage.aspx?ImageID='.$IDNo.'" width="100%" height="500px"></iframe>';
          

}
elseif($Label=='Sign')
{
 // $staff="SELECT Signaturepath FROM Staff Where IDNo='$IDNo'";
 //            $stmt = sqlsrv_query($conntest,$staff);  
 //            if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
 //            {
 //               if ($row_staff['Signaturepath']!='') 
 //               {
                 
 //                   echo '<iframe src="http://erp.gku.ac.in:86/'.str_replace('~/','',$row_staff['Signaturepath']).'" width="100%" height="500px"></iframe>';
 //                }else
 //              {
 //               echos "No Document Fund";
 //              }
 //            }
}
else
{

}

}
elseif($code==96)
{
   $collegeId=$_POST['CollegeId'];
$get_Department="SELECT  Department,Id FROM MasterDepartment Where CollegeId='$collegeId' ";
                                                $get_DepartmentRun=sqlsrv_query($conntest,$get_Department);
                                                while($get_DepartmentRow=sqlsrv_fetch_array($get_DepartmentRun,SQLSRV_FETCH_ASSOC))
                                                {?>
    <option value="<?=$get_DepartmentRow['Id'];?>">
        <?=$get_DepartmentRow['Department'];?>(<?=$get_DepartmentRow['Id'];?>)</option>
    <?php }
}
elseif ($code==97)  // Sic record search
{
   $userId=$_POST['userId'];
   $date=date('Y-m-d');
   // echo strlen($userId);
      $result1 = "SELECT  * FROM Admissions where UniRollNo='$userId' or ClassRollNo='$userId' or IDNo='$userId'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
        $IDNo= $row['IDNo'];
         $StudentName = $row['StudentName'];
         $img= $row['Snap'];
      $pic = 'data://text/plain;base64,' . base64_encode($img);
         $ClassRollNo= $row['ClassRollNo'];
         $UniRollNo= $row['UniRollNo'];
         $father_name = $row['FatherName'];
         $course = $row['Course'];
         $email = $row['EmailID'];
         $phone = $row['StudentMobileNo'];
         $batch = $row['Batch'];
         $college = $row['CollegeName'];
         $courseShortName = $row['CourseShortName'];
         ?>
    <div class="row">
        <div class="col-lg-11">

            <div class="row">
                <div class="col-lg-3">
                    <label>Student Name</label>
                    <input type="text" value="<?=$row['StudentName'];?>" class="form-control" readonly="">
                </div>
                <div class="col-lg-3">
                    <label>Father Name</label>
                    <input type="text" value="<?=$row['FatherName'];?>" class="form-control" readonly="">
                </div>
                <div class="col-lg-3">
                    <label>College Name</label>
                    <input type="text" value="<?=$row['CollegeName'];?>" class="form-control" readonly="">
                </div>
                <div class="col-lg-3">
                    <label>Course</label>
                    <input type="text" value="<?=$row['Course'];?>" class="form-control" readonly="">
                </div>
                <div class="col-lg-3">
                    <!-- <input type="hidden"  value="<?= date('Y-m-d');?>" class="form-control" required="" > -->
                    <label>Apply For</label>
                    <select id="applyfor" name="applyfor" class="form-control" required="" name="applyfor">
                        <option value="">Select option</option>
                        <option value="Degree">Degree</option>
                        <option value="Migration Certificate">Migration Certificate</option>
                        <option value="PDC">PDC</option>
                        <option value="Transcript">Transcript</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Receive By</label>
                    <select id="receive" name="receive" class="form-control" required=""
                        onchange="ShowHideDiv_address(this.value);">
                        <option value="">Select option</option>
                        <option value="By Hand">By Hand</option>
                        <option value="By Post">By Post</option>

                    </select>
                </div>
                <div class="col-lg-3" style="display:none;" id="address_div">
                    <label>Address</label>

                    <textarea class="form-control" rows="1" cols="10" name="address" id="address"></textarea>
                </div>

                <div class="col-lg-3">
                    <label>&nbsp;</label>
                    <button class="btn btn-primary form-control"
                        onclick="assignSystem(<?=$row['IDNo']?>)">Submit</button>
                </div>
            </div>
        </div>
        <div class="col-lg-1">
            <img src="<?=$pic?>" width='90px' height='90%'>

        </div>
    </div>
    <?php
     
   }

}
elseif ($code==98) 
{
   $userId=$_POST['id'];
   $receive=$_POST['receive'];
   $applyfor=$_POST['applyfor'];
   $address=$_POST['address'];
   $sql="INSERT INTO sic_document_record (idno, receive_by, document_type,address, apply_date, status) VALUES ('$userId', '$receive', '$applyfor','$address','$timeStamp', '0')";
   $res=mysqli_query($conn,$sql);
   if ($res==true) 
   {
      echo "Success";
   }

}
elseif($code==99) // home sic 
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where  Status!='8' and Status!='7'   ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);
 include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>
                <td><?php   if($row['status']==0)
                      {
                        echo "Draft";
                      }elseif($row['status']==1)
                      {
                        echo "Under Process";
                      }elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }elseif($row['status']==3)
                      {
                        echo "Under Process";
                      }
                      elseif($row['status']==4)
                      {
                        echo "Posted";
                      }
                      elseif($row['status']==5)
                      {
                        echo "Forward To Verification";
                      }
                       elseif($row['status']==6)
                      {
                        echo "Printed";
                      } 
                      elseif($row['status']==7)
                      {
                        echo "By Post";
                      }
                      elseif($row['status']==8)
                      {
                        echo "Issued";
                      } 
                      elseif($row['status']==9)
                      {
                         echo ' <div class="btn-group">
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#sicActionModal" onclick="postBySic(\'' . $row['ID'] . '\');">By Post</button>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sicActionModal" onclick="handOverToBySic(\'' . $row['ID'] . '\');">By Hand</button>
                      </div>';
                      }
                   ?></td>
                <!-- <td><i class="fa fa-eye fa-lg"></i></td> -->


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==100) // sic
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where  status='9'  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                           include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>
                <td><?php  if($row['status']==0)
                      {
                        echo "Draft";
                      }elseif($row['status']==1)
                      {
                        echo "Printed";
                      }elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }elseif($row['status']==3)
                      {
                        echo "<b>Printed</b>";
                      }
                      elseif($row['status']==4)
                      {
                        echo "Posted";
                      } 
                      elseif($row['status']==6)
                      {
                        echo "Printed";
                      }
                      elseif($row['status']==7)
                      {
                        echo "By Post";
                      }  elseif($row['status']==8)
                      {
                        echo "By Hand";
                      }
                      elseif($row['status']==9)
                      {
                          echo ' <div class="btn-group">
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#sicActionModal" onclick="postBySic(\'' . $row['ID'] . '\');">By Post</button>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sicActionModal" onclick="handOverToBySic(\'' . $row['ID'] . '\');">By Hand</button>
                      </div>';
                      }
                   ?></td>
                <!-- <td><i class="fa fa-eye fa-lg"></i></td> -->


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==101) //sic post
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='7' and speedpostno!=''  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                           include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>
                <td><?php  if($row['status']==0)
                      {
                        echo "Draft";
                      }elseif($row['status']==1)
                      {
                        echo "Printed";
                      }elseif($row['status']==2)
                      {
                        echo "Issued";
                      }elseif($row['status']==3)
                      {
                        echo "<b>Printed</b>";
                      }elseif($row['status']==7)
                      {
                        echo "<b>By Posted</b>";
                      }?></td>
                <!-- <td><i class="fa fa-eye fa-lg"></i></td> -->


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==102) //sic issued
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Issue Date</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='8' or status='7'   ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                          include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['issue_date']?></td>
                <td><?php  if($row['status']==0)
                      {
                        echo "Draft";
                      }elseif($row['status']==1)
                      {
                        echo "Printed";
                      }elseif($row['status']==2)
                      {
                        echo "Issued";
                      }elseif($row['status']==8 && $row['speedpostno']=='')
                      {
                        echo "<b>By Hand</b>";
                      }
                      elseif($row['status']==7 && $row['speedpostno']!='')
                      {
                        echo "<b>By Posted</b>";
                      }?></td>
                <!-- <td><i class="fa fa-eye fa-lg"></i></td> -->


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==103) //sic pending
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='6'  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                           include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>
                <td><?php  if($row['status']==0)
                      {
                        echo "Draft";
                      }elseif($row['status']==1)
                      {
                        echo "Printed";
                      }elseif($row['status']==2)
                      {
                        echo "Issued";
                      }elseif($row['status']==3)
                      {
                        echo "<b>Printed</b>";
                      }
                      elseif($row['status']==4)
                      {
                        echo "Posted";
                      }
                   ?></td>
                <!-- <td><i class="fa fa-eye fa-lg"></i></td> -->


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}

// exam document cell
elseif($code==104) // home exam 
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record  where status='0' ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);
include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                        echo ' <div class="btn-group">
                        <button type="button" class="btn btn-success btn-xs" onclick="acceptByExamBranch(\'' . $row['idno'] . '\');">Accept</button>
                        <button type="button" class="btn btn-danger btn-xs" onclick="rejectByExamBranch(\'' . $row['idno'] . '\');">Reject</button>
                       
                      </div>';
                      }
                      elseif($row['status']==1)
                      {
                        echo "Ready To Print";
                      }
                      elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }
                      elseif($row['status']==3)
                      {
                        echo "<b>Printed</b>";
                      }
                      elseif($row['status']==4)
                      {
                        echo "Completed";
                      }?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==105) // exam ready to print
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='1'  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                           include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                       
                      }
                      elseif($row['status']==1)
                      {
                         echo ' <div class="btn-group">
                        <button type="button" class="btn btn-success btn-xs" onclick="printByExamBranch(\'' . $row['idno'] . '\');">Print</button>
                      </div>';
                      }
                      elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }
                      elseif($row['status']==3)
                      {
                        echo "<b>Printed</b>";
                      }
                      elseif($row['status']==4)
                      {
                        echo "Completed";
                      }?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==106) //exam reject
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='2'  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                          include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                       
                      }
                      elseif($row['status']==1)
                      {
                        echo "Accept";
                        
                      }
                      elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }
                      elseif($row['status']==3)
                      {
                        echo "Printed";
                      }
                      elseif($row['status']==4)
                      {
                        echo "Completed";
                      }?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==107) //exam print 
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='3'  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                          include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                       echo "";
                      }
                      elseif($row['status']==1)
                      {
                         echo "";
                      }
                      elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }
                      elseif($row['status']==3)
                      {
                        echo ' <div class="btn-group">
                        <button type="button" class="btn btn-warning btn-xs" onclick="handOverByExamBranch(\'' . $row['idno'] . '\');">HandOver</button>
                      </div>';
                      }
                      elseif($row['status']==4)
                      {
                        echo "Completed";
                      }?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
// exam verified auth 
elseif($code==108) // home verified by printing section
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='4'   ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);
 include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                        
                      }
                      elseif($row['status']==1)
                      {
                        echo "Printed";
                      }
                      elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }
                      elseif($row['status']==3)
                      {
                        echo "";
                      }
                      elseif($row['status']==4)
                      {
                        echo ' <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs" onclick="acceptByVerifiedAuth(\'' . $row['idno'] . '\');">Accept</button>
                        
                       
                      </div>';
                      }?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==109) // exam verified forwarded
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='5'  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                           include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                       
                      }
                      elseif($row['status']==1)
                      {
                        
                      }
                      elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }
                      elseif($row['status']==3)
                      {
                        echo "Printed";
                      }
                      elseif($row['status']==5)
                      {
                         echo ' <div class="btn-group">
                        <button type="button" class="btn btn-success btn-xs" onclick="verifiedByVerifiedAuth(\'' . $row['idno'] . '\');">Vefified</button>
                      </div>';
                      }?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==110) //exam verifed ok
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status='6'  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                          include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                       
                      }
                      elseif($row['status']==1)
                      {
                        echo "";
                        
                      }
                      elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }
                      elseif($row['status']==3)
                      {
                        echo "";
                      }
                      elseif($row['status']==4)
                      {
                        echo "Posted";
                      } 
                       elseif($row['status']==6)
                      {
                         echo ' <div class="btn-group">
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#verifyActionModal" onclick="PostByVerifiedAuth(\'' . $row['ID'] . '\');">By Post</button>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#verifyActionModal" onclick="handOverToByVerifiedAuth(\'' . $row['ID'] . '\');">HandOver To Sic</button>
                      </div>';
                      }?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==111) //exam handoverto sic 
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Apply Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status>=7  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                          include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['apply_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                       
                      }
                      elseif($row['status']==1)
                      {
                         
                      }
                      elseif($row['status']==2)
                      {
                        echo "Issued";
                      }
                      elseif($row['status']==3)
                      {
                        echo ' <div class="btn-group">
                        <button type="button" class="btn btn-warning btn-xs">HandOver</button>
                      </div>';
                      }
                      elseif($row['status']==7)
                      {
                        echo "By Posted";
                      } elseif($row['status']==8)
                      {
                        echo "By Hand";
                      }
                      ?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==112) // accept by  exam branch
{
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='1' where idno='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==113) // reject by  exam branch
{
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='2' where idno='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==114) // print by  exam branch
{
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='3',print_date='$timeStamp' where idno='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==115) // handover by  exam branch
{
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='4' where idno='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==116) //exam competed
{
   ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>RollNo</th>
                <th>Name</th>
                <th>FatherName</th>
                <th>MotherName</th>
                <th>Course/Department</th>
                <th>Batch</th>
                <th>Mode</th>
                <th>Document</th>
                <th>Print Date</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record where status>=5  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);

                          include "document-section-tr-color.php";
                           ?>
            <tr style='background:<?=$clr;?>'>

                <td><?=$count++?></td>
                <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"
                        alt="User Avatar"></td>
                <td><?=$userId?></td>
                <td><?=$name?></td>
                <td><?=$father_name?></td>
                <td><?=$mother_name?></td>
                <td><?=$Department?></td>
                <td><?=$batch?></td>

                <td><?=$row['receive_by']?></td>
                <td><?=$row['document_type']?></td>
                <td><?=$row['print_date']?></td>

                <td>
                    <?php  if($row['status']==0)
                      {
                       
                      }
                      elseif($row['status']==1)
                      {
                        echo "";
                        
                      }
                      elseif($row['status']==2)
                      {
                        echo "Rejected";
                      }
                      elseif($row['status']==3)
                      {
                        echo "";
                      }
                      elseif($row['status']==4)
                      {
                        echo "Posted";
                      }?>

                </td>


            </tr>
            <?php 
                        }
                    }
                 }
              
             
            ?>
        </tbody>
    </table>
    <?php 
}
elseif($code==117) // accept by  verified auth
{
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='5' where idno='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==118) // verified by  verified auth
{
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='6',print_date='$timeStamp' where idno='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==119) // handOverToByVerifiedAuth
{
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='9' where idno='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==120) // postByVerifiedAuth
{
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='7' where idno='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==121) // postBysic
{
   $IDNo=$_POST['idno'];
?>
    <div class="row">
        <div class="col-lg-4">
            <label>Any ID Proof</label>
            <select class="form-control" id="idproof<?=$IDNo;?>">
                <option value="Adhar Card">Adhar Card</option>
                <option value="Pan Card">Pan Card</option>
                <option value="Voter Card">Voter Card</option>
                <option value="Pass Port">Pass Port</option>
            </select>
        </div>
        <div class="col-lg-4">
            <label> ID Proof No</label>
            <input type="text" class="form-control" id="idproofno<?=$IDNo;?>">
            <input type="hidden" class="form-control" value="<?=$IDNo;?>">
        </div>
        <div class="col-lg-4">

            <label>Speed Post No</label>
            <input type="text" class="form-control" id="speedpostno<?=$IDNo;?>">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="postBySicAction(<?=$IDNo;?>);">Submit</button>
    </div>
    <?php 
}
elseif($code==122) // handBysic
{
 $IDNo=$_POST['idno'];
?>
    <div class="row">
        <div class="col-lg-6">
            <label>Any ID Proof</label>
            <select class="form-control" id="idproof<?=$IDNo;?>">
                <option value="Adhar Card">Adhar Card</option>
                <option value="Pan Card">Pan Card</option>
                <option value="Voter Card">Voter Card</option>
                <option value="Pass Port">Pass Port</option>
            </select>
        </div>
        <div class="col-lg-6">
            <label> ID Proof No</label>
            <input type="text" class="form-control" id="idproofno<?=$IDNo;?>">
            <input type="hidden" class="form-control" value="<?=$IDNo;?>">
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handOverToBySicAction(<?=$IDNo;?>);">Submit</button>
    </div>
    <?php 
}
elseif($code==123) // handBysic
{
$idproof=$_POST['idproof'];
$idproofno=$_POST['idproofno'];
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='8',idproof='$idproof',idproofno='$idproofno', issue_date='$timeStamp' where ID='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==124) // postBysic
{
$idproof=$_POST['idproof'];
$idproofno=$_POST['idproofno'];
$speedpostno=$_POST['speedpostno'];
$IdNo=$_POST['idno'];
$acceptByExamBranch="UPDATE sic_document_record SET status='7',idproof='$idproof',idproofno='$idproofno',speedpostno='$speedpostno' where ID='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}
elseif($code==125) // handByAUTH
{
   $IDNo=$_POST['idno'];
?>
    <div class="row">
        <div class="col-lg-12">
            <label>Emp ID</label>
            <input type="text" id="EmpID" class="form-control">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handBySicAction(<?=$IDNo;?>);">Submit</button>
    </div>
    <?php 
}
elseif($code==126) // handOverToBySICbyAuth
{
$IdNo=$_POST['idno'];
$Empid=$_POST['Empid'];
 $acceptByExamBranch="UPDATE sic_document_record SET status='9' ,sic_emp='$Empid' where ID='$IdNo'";
$acceptByExamBranchRun=mysqli_query($conn,$acceptByExamBranch);
if ($acceptByExamBranchRun==true) {
      echo "1";
}
else
{
   echo "0";
}
}

elseif($code==127) // STAFF APRESAL
{
?><table class="table table-striped">
        <tbody>
            <?php   
                     $yourdata="select * from staff_aprisal where emp_id='$EmployeeID' limit 1 ";
                      $insQryRun=mysqli_query($conn,$yourdata);
                      while ($show_task_row=mysqli_fetch_array($insQryRun))
                                  {?>
            <tr>
                <td> Employment Category</td>
                <td><?=$show_task_row['ecategory'];?></td>
                <td> No of Lecture</td>
                <td><?= $show_task_row['no_of_lect'];?></td>
            </tr>
            <tr>
                <td> Books Published :<?= $show_task_row['book_published'];?> </td>
                <td>No of Books: <?= $show_task_row['no_of_books'];?></td>
                <td>Name of Books: <?= $show_task_row['name_of_books'];?></td>
                <td>ISBN: <?= $show_task_row['isbn'];?></td>
            </tr>
            <tr>
                <td> Research paper Published :<?= $show_task_row['research_paper'];?>
                    (<?= $show_task_row['no_of_research_paper'];?>)</td>
                <td>Title of Paper: <?= $show_task_row['title_of_paper'];?></td>
                <td>Name of Journal: <?= $show_task_row['name_of_journal'];?></td>
                <td>Publication Index: <?= $show_task_row['publication_index'];?></td>
            </tr>
            <tr>
                <td> Consultancy :<?= $show_task_row['consultancy'];?> </td>
                <td>Amount: <?= $show_task_row['amount'];?></td>
                <td>organisation: <?= $show_task_row['corg'];?></td>
            </tr>
            <tr>
                <td> Admission Initative:<?= $show_task_row['admission'];?> </td>
                <td>No of Admission: <?= $show_task_row['no_of_admission'];?></td>
                <td colspan="2">No of Admission without Consultancy <?= $show_task_row['no_of_admission_c'];?></td>
            </tr>
            <tr>
                <td> Patent:<?= $show_task_row['patent'];?> </td>
                <td>Detail: <?= $show_task_row['p_detail'];?></td>
            </tr>
            <tr>
                <td colspan="2"> PhD. Candidate:<?= $show_task_row['phd_candidate'];?> </td>
                <td colspan="2">No Of Candidate: <?= $show_task_row['no_of_candidate'];?></td>
            </tr>
            <tr>
                <td colspan="5"> Other Duty /Task:<?= $show_task_row['extra'];?> </td>
            </tr>
            <?php    } ?>
        </tbody>
    </table>
    <?PHP 
}

elseif($code==128)
{
$yourdata="select * from staff_aprisal where emp_id='$EmployeeID'";
                      $insQryRun=mysqli_query($conn,$yourdata);
                      if(mysqli_num_rows($insQryRun)>0)
                      {
                        echo "1";
                      }
                      else
                      {
                        echo "0";
                      }
                     

}
elseif($code==129)
{
$yourdata="SELECT * from staff_aprisal where ap_auth='$EmployeeID' || rec_auth='$EmployeeID'";   
                      $insQryRun=mysqli_query($conn,$yourdata);
                      if(mysqli_num_rows($insQryRun)>0)
                      {
                        echo "1";
                      }
                      else
                      {
                        echo "0";
                      }
                     

}
elseif($code==130)
{
?>
    <form action="action_g.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="code" value="79">
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>Type</label>
                <input type="text" name="type" class="form-control" value="diploma" readonly>
            </div>
        </div>
        <div class="row container-fluid">

            <div class="col-lg-6">
                <label>Month</label>
                <select name="month" class="form-control" required>
                    <option value="">Select</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="Marchr">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Year</label>
                <select class="form-control" name="year" required>
                    <option value="">Select</option>
                    <?php  for ($i=2015; $i <=date('Y') ; $i++) 
   { ?>
                    <option value="<?=$i;?>"><?=$i;?></option>

                    <?php }  ?>
                </select>
            </div>
            <!-- <div class="col-lg-6">
   <label>Stream</label>
  <input type="text" name="stream" class="form-control">
</div> -->
        </div>
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>File</label>
                <input type="file" name="file" class="form-control" required>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>Action</label><br>
                <input type="submit" class="btn btn-success" value="Upload">
            </div>
        </div>
    </form>
    <br>
    <?php 
                     

}
elseif($code==131)
{
?>
    <form action="action_g.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="code" value="79">
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>Type</label>
                <input type="text" name="type" class="form-control" value="diploma" readonly>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-lg-6">
                <label>Month</label>
                <select name="month" class="form-control" required>
                    <option value="">Select</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="Marchr">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Year</label>
                <select class="form-control" name="year" required>
                    <option value="">Select</option>
                    <?php  for ($i=2015; $i <=date('Y') ; $i++) 
   { ?>
                    <option value="<?=$i;?>"><?=$i;?></option>

                    <?php }  ?>
                </select>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>Extra Row</label>
                <textarea class="form-control" name="extra"
                    rowspan="3">During this One Year course in addition to other subjects, the student has been taught subjects with course contents related to <b>Plant Protection </b>and <b>Pesticides Management.</b></textarea>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>File</label>
                <input type="file" name="file" class="form-control" required>
            </div>
        </div>

        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>Action</label><br>
                <input type="submit" class="btn btn-success" value="Upload">
            </div>
        </div>
    </form>
    <br>
    <?php 

}
elseif($code==132)
{
?>
    <form action="action_g.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="code" value="79">
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>Type</label>
                <input type="text" name="type" class="form-control" value="degree" readonly>


            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-lg-6">
                <label>Month</label>
                <select name="month" class="form-control" required>
                    <option value="">Select</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="Marchr">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label>Year</label>
                <select class="form-control" name="year" required>
                    <option value="">Select</option>
                    <?php  for ($i=2015; $i <=date('Y') ; $i++) 
   { ?>
                    <option value="<?=$i;?>"><?=$i;?></option>

                    <?php }  ?>
                </select>
            </div>
            <!-- <div class="col-lg-12">
                <label>Stream/Specialization/Topic/Thesis/Subjects (Optional)</label>
                 <input type="text" name="stream" class="form-control" > -->
            <!-- <textarea class="form-control" name="stream" rowspan="3"></textarea> -->
            <!-- </div> -->
        </div>
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>File</label>
                <input type="file" name="file" class="form-control" required>
            </div>
        </div>
        <div class="row container-fluid">
            <div class="col-lg-12">
                <label>Action</label><br>
                <input type="submit" class="btn btn-success" value="Upload">
            </div>
        </div>
    </form>
    <br>
    <?php

}


            elseif($code==133)
      {

$Name = $_POST['Name'];
$FatherName = $_POST['FatherName'];
 $months = $_POST['months'];
$Gender = $_POST['Gender'];
// $MobileNo = $_POST['MobileNo'];
$CollegeName = $_POST['CollegeName'];
$Department = $_POST['Department'];
$Course = $_POST['Course'];
// $Batch = $_POST['Batch'];
$Lateral = $_POST['Lateral'];
$PinCode = $_POST['PinCode'];
$Nationality = $_POST['Nationality'];
$State = $_POST['State'];
$District = $_POST['District'];
$Consultant = $_POST['Consultant'];
$duration= $_POST['duration'];
$session = $_POST['session'];
$AdharCardNo = $_POST['AdharCardNo'];
$PassportNo = $_POST['PassportNo'];
$ID_Proof_No=$AdharCardNo.$PassportNo;
$check_exit="SELECT * FROM offer_latter where ID_Proof_No='$ID_Proof_No'";
$check_exit_run=mysqli_query($conn,$check_exit);
$numof_exit=mysqli_num_rows($check_exit_run);
if ($numof_exit>0) {
   echo "2";
}
else
{
 $insert_record = "INSERT INTO `offer_latter` (`Name`, `FatherName`,  `Gender`, `CollegeName`, `Department`, `Course`, `Lateral`, `Nationality`,`District`,`PinCode`, `State`,`Consultant_id`,`Session`,`Duration`,`ID_Proof_No`,`months`,`AddedBy`,`SubmitDate`) VALUES ('$Name','$FatherName','$Gender','$CollegeName','$Department','$Course','$Lateral','$Nationality','$District','$PinCode','$State','$Consultant','$session','$duration','$ID_Proof_No','$months','$EmployeeID','$timeStamp');";
$insert_record_run = mysqli_query($conn, $insert_record);
if ($insert_record_run==true) 
{
   echo "1";
}
else
{
   echo "0";
}
} 
// echo"sadfgasfasd";
      }  
      elseif($code==134)
      {
         $value=$_POST['by_search'];
         if($value!='')
         {
            if($EmployeeID=='131053' || $EmployeeID=='121031' || $EmployeeID=='100001' || $EmployeeID=='170601' || $EmployeeID=='170976' )
            {

                $degree="SELECT * FROM offer_latter where id like '%$value%' or Class_RollNo like '%$value%' or ID_Proof_No like '%$value%'  order by Id DESC "; 
            }
            else
            {
            $degree="SELECT * FROM offer_latter where (id like '%$value%' or Class_RollNo like '%$value%' or ID_Proof_No like '%$value%') and AddedBy='$EmployeeID' order by Id DESC "; 
            }
            $degree_run=mysqli_query($conn,$degree);
            while ($degree_row=mysqli_fetch_array($degree_run)) 
            {
                $data2=$degree_row;
                $CourseID=$degree_row['Course'];

                $get_course="SELECT Course FROM MasterCourseStructure Where CourseId='$CourseID'";
                $get_course_run=sqlsrv_query($conntest,$get_course);
                if($row=sqlsrv_fetch_array($get_course_run))
                {
               $data1=$row;
               $data[]=array_merge($data2,$data1);
          
            }
            
                       
                    
            }

      

            // print_r($row_student);
            $page = $_POST['page'];
            $recordsPerPage = 50;
            $startIndex = ($page - 1) * $recordsPerPage;
            $pagedData = array_slice($data, $startIndex, $recordsPerPage);
            // echo json_encode($pagedData);
         
                echo json_encode($pagedData);
           
         }
         else
         {
            if($EmployeeID=='131053' || $EmployeeID=='121031' || $EmployeeID=='100001' || $EmployeeID=='170601' || $EmployeeID=='170976' )
            {

                
                $degree="SELECT * FROM offer_latter order by Id DESC "; 
            }
            else{
            // $degree="SELECT * FROM offer_latter where Class_RollNo like '%$value%' or ID_Proof_No like '%$value%' and AddedBy='$EmployeeID' order by Id DESC "; 
            $degree="SELECT * FROM offer_latter where AddedBy='$EmployeeID' order by Id DESC "; 
            }
                     $degree_run=mysqli_query($conn,$degree);
                     while ($degree_row=mysqli_fetch_array($degree_run)) 
                     {
                        $data2=$degree_row;
                        $CourseID=$degree_row['Course'];
                        $get_course="SELECT Course FROM MasterCourseStructure Where CourseId='$CourseID'";
                        $get_course_run=sqlsrv_query($conntest,$get_course);
                        if($row=sqlsrv_fetch_array($get_course_run))
                        {
                       $data1=$row;
                       $data[]=array_merge($data2,$data1);
                  
                    }


                    
                     }
                     // print_r($data);
                     $page = $_POST['page'];
                     $recordsPerPage = 50;
                     $startIndex = ($page - 1) * $recordsPerPage;
                     $pagedData = array_slice($data, $startIndex, $recordsPerPage);
                     echo json_encode($pagedData);
          }
      }
          elseif($code==135)
      {
         $state=$_POST['consultant_name'];
          $insert_consultant="INSERT INTO consultant_master (state)values('$state');";
         $insert_consultant_run=mysqli_query($conn,$insert_consultant);
         if ($insert_consultant_run==true)
          {
         echo "1";   
         }
         else
         {
            echo "0";
         }

      }     
       elseif($code==136)
      {
         $college=$_POST['college'];
         $department=$_POST['department'];
         $course=$_POST['course'];
         $applicable=$_POST['applicable'];
         $hostel=$_POST['hostel'];
         $concession=$_POST['concession'];
          $Lateral=$_POST['Lateral'];
         $afterconcession=$_POST['afterconcession'];
         $consultant_id=$_POST['consultant_id'];

         $iffeesalready="SELECT * FROM  master_fee where consultant_id='$consultant_id' and college='$college' and department='$department' and course='$course' ";
         $iffeesalready_run=mysqli_query($conn,$iffeesalready);
         if (mysqli_num_rows($iffeesalready_run)>0) 
         {
echo "2";
         }
          else
          {
          // $insert_consultant="INSERT INTO `master_fee` ( `college`, `department`, `course`, `applicables`, `hostel`, `concession`, `after_concession`, `consultant_id`) VALUES ('$college', '$department', '$course', '$applicable', '$hostel', '$concession', '$afterconcession', '$consultant_id');";

          $insert_consultant="INSERT INTO `master_fee` ( `college`, `department`, `course`, `applicables`, `hostel`, `concession`, `after_concession`, `consultant_id`,`Lateral`) VALUES ('$college', '$department', '$course', '$applicable', '$hostel', '$concession', '$afterconcession', '$consultant_id','$Lateral');";
         $insert_consultant_run=mysqli_query($conn,$insert_consultant);
         if ($insert_consultant_run==true)
          {
         echo "1";   
         }
         else
         {
            echo "0";
         }
      }

      }
       

      elseif($code==137)
      {
         $country_id=$_POST['country'];
         $get_state="SELECT * FROM states where country_id='$country_id'";
         $get_state_run=mysqli_query($conn,$get_state);
         while($row=mysqli_fetch_array($get_state_run))
         {?>
    <option value="<?=$row['name'];?>"><?=$row['name'];?></option>
    <?php }

      }
        elseif ($code==138) 
   {
      $empID=$_POST['id'];
       $staff="SELECT * FROM Staff Where IDNo='$empID'";
       $stmt = sqlsrv_query($conntest,$staff);  
       if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
       {
           $jobStatus=$row_staff['JobStatus'];
           if ($jobStatus=='1') 
           {
            ?>
    <label>Name</label>
    <input type="text" class="form-control" value="<?=$row_staff['Name'];?>" readonly>

    <label>Mobile No</label>
    <input type="text" class="form-control" value="<?=$row_staff['MobileNo'];?>" readonly>

    <?php
        }
           else
           {
               echo "<b>Can not assign to ".$empID;
           }
           // $array[]=$row_staff;
       }
   }  

elseif($code==139)
    {
      $id=$_POST['id'];
      $get_student_details="SELECT * FROM offer_latter  where id='$id'";
$get_student_details_run=mysqli_query($conn,$get_student_details);
if ($row=mysqli_fetch_array($get_student_details_run))
 {
    $name=$row['Name'];
    $FatherName=$row['FatherName'];
    $MotherName=$row['MotherName'];
    $Collegeid=$row['CollegeName'];
    $Course=$row['Course'];
    $Department=$row['Department'];
    $Gender=$row['Gender'];
    $classroll=$row['Class_RollNo'];
    //$Duration=$row['Duration'];

$get_colege_course_name="SELECT * FROM MasterCourseCodes where CollegeID='$Collegeid' and DepartmentId='$Department' ANd (Status='1'  OR Status is NULL)";
$get_colege_course_name_run=sqlsrv_query($conntest,$get_colege_course_name);
if ($row_collegecourse_name=sqlsrv_fetch_array($get_colege_course_name_run)) {

    $courseName=$row_collegecourse_name['Course'];
    $CollegeName=$row_collegecourse_name['CollegeName'];
    $Department=$row_collegecourse_name['DepartmentId'];
$get_department_name="SELECT * FROM MasterDepartment where Id='$Department'";
$get_department_name_run=sqlsrv_query($conntest,$get_department_name);
if ($row_departcourse_name=sqlsrv_fetch_array($get_department_name_run)) {

    $DepartmentName=$row_departcourse_name['Department'];
}

}




$get_course_name="SELECT Course FROM MasterCourseCodes where CourseID='$Course'";
$get_course_name_run=sqlsrv_query($conntest,$get_course_name);
if ($row_course_name=sqlsrv_fetch_array($get_course_name_run)) 
{

    $courseName=$row_course_name['Course'];
}
    $State_id=$row['State'];
    $Session=$row['Session'];
    $Duration=$row['Duration'];
    $Consultant_id=$row['Consultant_id'];
    $Lateral=$row['Lateral'];
    $Nationality=$row['Nationality'];
    $ID_Proof_No=$row['ID_Proof_No'];
    $District_id=$row['District'];
     $months=$row['months'];

       $lStatus=$row['Status'];
    

    

    $get_state="SELECT name FROM states  where id='$State_id'";
    $get_state_run=mysqli_query($conn,$get_state);
    if($row_state=mysqli_fetch_array($get_state_run))
    {
    $State=$row_state['name'];
    }
    $get_district="SELECT name FROM cities  where id='$District_id'";
    $get_district_run=mysqli_query($conn,$get_district);
    if($row_dist=mysqli_fetch_array($get_district_run))
    {
    $District=$row_dist['name'];

    }
     
   $get_country="SELECT name FROM countries  where id='$Nationality'";
                  $get_country_run=mysqli_query($conn,$get_country);
                  if($row=mysqli_fetch_array($get_country_run))
                  {
                    if ($row['name']=='India') {             
$NationalityName='Indian';
                    }else
                    {
$NationalityName=$row['name'];

                    }
                   }
    $fee_details="SELECT * FROM master_fee where consultant_id='$Consultant_id'";
$fee_details_run=mysqli_query($conn,$fee_details);
if ($row_fee=mysqli_fetch_array($fee_details_run))
 {
    $applicables=$row_fee['applicables'];
    $hostel=$row_fee['hostel'];
    $concession=$row_fee['concession'];
    $after_concession=$row_fee['after_concession'];
 }    

 $consultant_details="SELECT * FROM consultant_master where id='$Consultant_id'";
$consultant_details_run=mysqli_query($conn,$consultant_details);
if ($row_consultant=mysqli_fetch_array($consultant_details_run))
 {
    $consultant=$row_consultant['state'];
   
 }


    
}

?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-2">
                    <label>Nationality</label>
                    <?php if($EmployeeID=='121031' ||$EmployeeID=='131053')
                    {?>
                    <select class="form-control" id="Nationality" onchange="fetch_state2(this.value);">
                        <option value="<?=$Nationality;?>"><?=$NationalityName;?></option>
                        <option value="">Select</option>
                        <?php 
                  $get_country="SELECT * FROM countries ";
                  $get_country_run=mysqli_query($conn,$get_country);
                  while($row=mysqli_fetch_array($get_country_run))
                  {?>
                        <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                        <?php }

                 ?>
                    </select>

                    <?php }
                else
                {
                    echo $NationalityName;?>
                    <input type="hidden" value="<?=$Nationality;?>" id="Nationality" readonly="">
                    <?php 
                }?>

                </div>


                <div class="col-lg-2">
                    <label>State</label>
                    <?php if($EmployeeID=='121031' ||$EmployeeID=='131053')
                    {?>
                    <select class="form-control" id="State" onchange="fetch_district2(this.value);">
                        <option value="<?=$State_id;?>"><?=$State;?></option>
                    </select>
                    <br>
                    <?php }
                else
                    {
               echo "<br>";
                    echo $State;

?>
                    <input type="hidden" value="<?=$State_id;?>" id="State" readonly="">
                    <?php 
                }?>

                </div>
                <div class="col-lg-2">
                    <label>District</label>
                    <?php if($EmployeeID=='121031' ||$EmployeeID=='131053')
                    {?>



                    <select class="form-control" id="District1">
                        <option value="<?=$District_id;?>"><?=$District;?></option>

                    </select>
                    <?php }
else
{
                echo "<br>";
                  echo $District;
                  ?>

                    <input type="hidden" value="<?=$District_id;?>" id="District1" readonly="">

                    <?php  }
                 ?>
                </div>

                <div class="col-lg-2">
                    <label>Consultant</label>

                    <?php if($EmployeeID=='121031' ||$EmployeeID=='131053')
                    {?>



                    <select id="Consultant_" class="form-control">
                        <option value="<?=$Consultant_id;?>"><?=$consultant;?></option>
                        <?php  $get_consultant="SELECT * FROM consultant_master "; 
                     $get_consultant_run=mysqli_query($conn,$get_consultant);
                     while($row=mysqli_fetch_array($get_consultant_run))
                     {?>

                        <option value="<?=$row['id'];?>"><?=$row['state'];?></option>

                        <?php }?>
                    </select>

                    <?php }
else
{
   echo "<br><b>";
  echo $consultant;
   echo "</b>";
  ?>


                    <input type="hidden" value="<?=$Consultant_id;?>" id="Consultant_" readonly="">


                    <?php 
}
?>
                </div>


                <div class="col-lg-3">
                    <label>Student Name</label>
                    <input type="text" value="<?=$name;?>" id="Name" class="form-control">
                </div>
                <div class="col-lg-3">
                    <label>Father Name</label>
                    <input type="text" value="<?=$FatherName;?>" id="FatherName" class="form-control">
                </div>

                <div class="col-lg-3">
                    <label>Gender</label>
                    <select id="Gender" class="form-control">
                        <option value="<?=$Gender;?>"><?=$Gender;?></option>
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>



                <div class="col-lg-3">
                    <label>College Name</label>
                    <select id='CollegeName1' onchange="collegeByDepartment1(this.value);" class="form-control"
                        required>
                        <option value='<?=$Collegeid;?>'><?=$CollegeName;?></option>


                        <?php
                     
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option value="<?=$CollegeID;?>"><?=$college;?></option>
                        <?php 
                    }
                        ?>

                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Department</label>
                    <select id="Department1" class="form-control" onchange="fetchcourse1()" required>
                        <option value='<?=$Department;?>'><?=$DepartmentName;?></option>
                    </select>
                </div>


                <div class="col-lg-2">
                    <label>Course</label>
                    <select id="Course1" class="form-control" required>

                        <option value='<?=$Course;?>'><?=$courseName;?></option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Duration</label>
                    <select class="form-control" id="Duration">
                        <option value="<?= $Duration?>"><?= $Duration;?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Course Duration</label>

                    <select class="form-control" id="months">
                        <option value="<?= $months?>"><?= $months;?></option>

                        <option value="0">0 Month</option>
                        <option value="6">6 Month</option>

                    </select>
                </div>




                <div class="col-lg-3">
                    <label>Class RollNo</label>
                    <?php if($EmployeeID=='121031' ||$EmployeeID=='131053') 
                    {?>
                    <input type="number" id="classroll" class="form-control" value="<?=$classroll;?>">
                    <?php }
                  else
                  {
                    if($classroll>0)
                    {
                      echo "<br>";
                      echo $classroll;
                      ?>
                    <input type="hidden" id="classroll" class="form-control" value="<?=$classroll;?>">
                    <?php 
                    }else
                    {?>
                    <input type="number" id="classroll" class="form-control" value="<?=$classroll;?>">
                    <?php
                    }


                  }

                  ?>
                </div>
                <div class="col-lg-2">
                    <label>District</label>
                    <?php if($EmployeeID=='121031' ||$EmployeeID=='131053' || $EmployeeID='170573')
                    {?>

                    <?php if($lStatus>0) {
                           $lcolor='Red';
                        }
                        else
                        {
                          $lcolor='Green';

                        }?>

                    <select class="form-control" id="Status1" style="border-color:<?=$lcolor;?>">
                        <option value="<?=$lStatus;?>">
                            <?php if($lStatus>0) {
                            echo "Left";
                        }
                        else
                        {
                            echo "Active";

                        }?>


                        </option>
                        <option value="0">Active </option>
                        <option value="1">Left</option>



                    </select>
                    <?php }
else
{
                echo "<br>";
        if($lStatus>0) {
                            echo "Left";
                        }
                        else
                        {
                            echo "Active";

                        }?>


                    <input type="hidden" value="<?=$lStatus;?>" id="Status1" readonly="">

                    <?php  }
                 ?>
                </div>
                <div class="col-lg-1">
                    <label>&nbsp;</label>
                    <button class="btn btn-primary" onclick="edit_student_details(<?=$id;?>)">Save</button>
                </div>

            </div>
        </div>
    </div>
    <?php
   
   }
           
   
   
   
   elseif($code==140)
      {
$classroll="";
$duration = $_POST['duration'];
$id = $_POST['id'];
$Name = $_POST['Name'];
$months = $_POST['months'];
$FatherName = $_POST['FatherName'];
$Gender = $_POST['Gender'];
$CollegeName = $_POST['CollegeName'];
$Department = $_POST['Department'];
$Course = $_POST['Course'];
$Nationality = $_POST['Nationality'];
$State = $_POST['State'];
$Consultant = $_POST['Consultant'];
$District = $_POST['District1'];
$status= $_POST['status'];
 
$classroll = $_POST['classroll'];
  $insert_record = "UPDATE  offer_latter SET Name='$Name', FatherName='$FatherName',  Gender='$Gender', CollegeName='$CollegeName', Department='$Department', Course='$Course', Nationality='$Nationality', State='$State',Consultant_id='$Consultant',Class_RollNo='$classroll',UpdateBy='$EmployeeID',District='$District',Duration='$duration',months='$months',Status='$status' where id='$id'";
$insert_record_run = mysqli_query($conn, $insert_record);
if ($insert_record_run==true) 
{
   echo "1";
}
else
{
   echo "0";
}

}
elseif($code==141)
{
   $id=$_POST['id'];
   $degree="SELECT * FROM degree_print where id='$id' ";                     
                     $degree_run=mysqli_query($conn,$degree);
                     if ($degree_row=mysqli_fetch_array($degree_run)) 
                     {
                     $StudentName=$degree_row['StudentName'];
                     $UniRollNo=$degree_row['UniRollNo'];
                     $FatherName=$degree_row['FatherName'];
                     $Examination=$degree_row['Examination'];
                     $Course=$degree_row['Course'];
                     $Stream=$degree_row['Stream'];
                     $QrCourse=$degree_row['QrCourse'];
                     $RegistrationNo=$degree_row['RegistrationNo'];
                     $CGPA=$degree_row['CGPA'];
                     $upload_date=$degree_row['upload_date'];
                     $ExtraRow=$degree_row['ExtraRow'];
                    
                     $Type=$degree_row['Type'];

   } 

 $get_pending="SELECT Sex FROM Admissions where UniRollNo='$UniRollNo'";

                  $get_pending_run=sqlsrv_query($conntest,$get_pending);
                  if($row_pending=sqlsrv_fetch_array($get_pending_run))
                  {
                  echo  $Gender= $row_pending['Sex'];
                  }                 
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <label>Student Name</label>
                    <input type="text" value="<?=$StudentName;?>" id="Name" class="form-control">
                    <label>Uni Roll NOe</label>
                    <input type="text" value="<?=$UniRollNo;?>" id="unirollno" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label>Father Name</label>
                    <input type="text" value="<?=$FatherName;?>" id="FatherName" class="form-control">
                    <label>Upload Date</label>
                    <input type="date" value="<?=$upload_date;?>" id="upload_date" class="form-control">
                </div>
                <div class="col-lg-6">
                    <label>Gender</label>
                    <select id="Gender" class="form-control">
                        <option value="<?=$Gender;?>"><?=$Gender;?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-lg-6">
                    <label>QR Course</label>
                    <input type="text" value="<?=$QrCourse;?>" id="qrcourse" class="form-control">
                </div>
                <div class="col-lg-12">
                    <label>Stream</label>
                    <textarea class="form-control" id="Stream_"><?=$Stream;?></textarea>
                    <!-- <input type="text" value="<?=$FatherName;?>" id="FatherName" class="form-control"> -->
                </div>

                <div class="col-lg-4">
                    <label>&nbsp;</label>
                    <button class="btn btn-primary form-control"
                        onclick="edit_student_details(<?=$id;?>)">Update</button>
                </div>
            </div>
        </div>
    </div>
    <?php 


                     

}
  elseif($code==142)
  {
$id = $_POST['id'];
$Name = $_POST['Name'];
$FatherName = $_POST['FatherName'];
$Stream = $_POST['Stream'];
$Gender = $_POST['Gender'];
$UniRollNo = $_POST['UniRollNo'];
$upload_date = $_POST['upload_date'];
  $insert_record = "UPDATE  degree_print SET StudentName='$Name',FatherName='$FatherName',Stream='$Stream',Gender='$Gender',upload_date='$upload_date'  where id='$id'";
$insert_record_run = mysqli_query($conn, $insert_record);

 $upimage = "UPDATE Admissions SET Sex='$Gender' where UniRollNo='$UniRollNo'";

$upimage_run = sqlsrv_query($conntest,$upimage);


if ($insert_record_run==true) 
{
   echo "1";
}
else
{
   echo "0";
}
  }
  elseif($code==143)
  {
   $id=$_POST['id'];
   $get_pending="SELECT * FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.IDNO='$id' ";
   $get_pending_run=sqlsrv_query($conntest,$get_pending);
   if($row_pending=sqlsrv_fetch_array($get_pending_run))
   {

      $UniRollNo=$row_pending['IDNo'];
      $Snap=$row_pending['Snap'];
      $s_pic=base64_encode($Snap);
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      $mime_type = $finfo->buffer($Snap);
      $extension = '';
      switch ($mime_type) {
          case 'image/jpeg':
              $extension = 'jpg';
              break;
          case 'image/png':
              $extension = 'png';
              break;
          
      }
?>
    <div class="container">
        <div class="container-fluid">
            <div class="card card-primary">


                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->

                        <div class="col-lg-6 text-center text-bold">
                            <img src="dist/img/new-logo.png" alt="logo" width="210">
                            <br><br>
                            <h5 style="background-color: #223260; color: white">
                                <span id="CollegeName" readonly="true"><?= $row_pending['CollegeName']; ?></span>
                            </h5>
                            <?php echo "<img width='100' src='data:image/jpeg;base64," . $s_pic . "' alt='message user image' style='border:groove black;'>"; ?>
                            <br>


                            <br>
                            <a href="data:<?php echo $mime_type; ?>;base64,<?php echo $s_pic; ?>"
                                download="<?php echo $UniRollNo; ?>.<?php echo $extension; ?>"><button
                                    class="btn btn-success btn-sm">Download Image</button></a>
                            <form id="image-upload" name="image-upload" action="action_g.php" method="post"
                                enctype="multipart/form-data">
                                <input type="file" name="image" id="image" class="form-control input-group-sm">
                                <input type="hidden" name="unirollno" value="<?php echo $UniRollNo; ?>">
                                <input type="hidden" name="code" value="153">
                                <input type="button" value="Upload" class="btn btn-success btn-xs"
                                    onclick="uploadImage(this.form,'<?php echo $UniRollNo; ?>')">
                            </form>
                            <div id="result"></div><br>
                            Name: <span id="StudentName" readonly="true"><?= $row_pending['StudentName']; ?></span>
                            <br>
                            RollNo: <span id="ClassRollNo" readonly="true"><?= $row_pending['ClassRollNo']; ?></span>
                            <br>
                            Course: <span id="Course" readonly="true"><?= $row_pending['Course']; ?></span>
                            <br>
                            Batch: <span id="Batch" readonly="true"><?= $row_pending['Batch']; ?></span><br>
                            Valid upto: <span id="ValidUpto" readonly="true"></span><br>
                            <br>
                            <h5 style="background-color: #223260; color: white">Authourity Signature</h5>
                        </div>
                        <div class="col-lg-6 text-center">
                            <b>This is a property of Guru Kashi University</b>
                            <hr>
                            FatherName: <span id="FatherName" readonly="true"><?= $row_pending['FatherName']; ?></span>
                            <br>
                            Mobile: <span id="StudetMobileNo"
                                readonly="true"><?= $row_pending['StudentMobileNo']; ?></span>
                            <br>
                            DOB: <span id="DOB" readonly="true"><?= $row_pending['DOB']->format('d-m-Y'); ?></span>
                            <br>
                            <b><span>Address</span></b><br>
                            <span id="PermanentAddress" readonly="true"><?= $row_pending['PermanentAddress']; ?></span>
                            <br>
                            <span id="State" readonly="true"><?= $row_pending['District']; ?></span>
                            <br>
                            <span id="State" readonly="true"><?= $row_pending['State']; ?></span> PIN-
                            <span id="PIN" readonly="true"><?= $row_pending['PIN']; ?></span>
                            <br>

                            <textarea name="" rows="2" cols="20" id="Remarks<?=$row_pending['IDNO'];?>"
                                class="form-control"
                                placeholder="Rejected Reason"><?= $row_pending['RejectReason']; ?></textarea>
                            <br>
                            <input type="submit" name="" value="Verify"
                                onclick="verify_idcard(<?=$row_pending['IDNO'];?>);" class="btn btn-success">
                            <input type="submit" name="" value="Reject"
                                onclick="reject_idcard(<?=$row_pending['IDNO'];?>);" class="btn btn-danger">
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>

    </div>
    <?php
                 
                  }
                 
                    
                    ?>
    <?php }
   elseif($code==144)
   {
      $id=$_POST['id'];
      $get_pending="SELECT * FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.IDNO='$id' ";
      $get_pending_run=sqlsrv_query($conntest,$get_pending);
      if($row_pending=sqlsrv_fetch_array($get_pending_run))
      {
         $UniRollNo=$row_pending['IDNo'];
         $Snap=$row_pending['Snap'];
         $s_pic=base64_encode($Snap);
 ?>
    <div class="container">
        <div class="container-fluid">
            <div class="card card-primary">

                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->

                        <div class="col-lg-6 text-center text-bold">
                            <img src="dist/img/new-logo.png" alt="logo" width="210">
                            <br><br>
                            <h5 style="background-color: #223260; color: white">
                                <span id="CollegeName" readonly="true"><?= $row_pending['CollegeName']; ?></span>
                            </h5>
                            <?php echo "<img width='100' src='data:image/jpeg;base64," . $s_pic . "' alt='message user image' style='border:groove black;'>"; ?>
                            <br>
                            Name: <span id="StudentName" readonly="true"><?= $row_pending['StudentName']; ?></span>
                            <br>
                            RollNo: <span id="ClassRollNo" readonly="true"><?= $row_pending['ClassRollNo']; ?></span>
                            <br>
                            Course: <span id="Course" readonly="true"><?= $row_pending['Course']; ?></span>
                            <br>
                            Batch: <span id="Batch" readonly="true"><?= $row_pending['Batch']; ?></span><br>
                            Valid upto: <span id="ValidUpto" readonly="true"></span><br>
                            <br>
                            <h5 style="background-color: #223260; color: white">Authourity Signature</h5>
                        </div>
                        <div class="col-lg-6 text-center">
                            <b>This is a property of Guru Kashi University</b>
                            <hr>
                            FatherName: <span id="FatherName" readonly="true"><?= $row_pending['FatherName']; ?></span>
                            <br>
                            Mobile: <span id="StudetMobileNo"
                                readonly="true"><?= $row_pending['StudentMobileNo']; ?></span>
                            <br>
                            DOB: <span id="DOB" readonly="true"><?= $row_pending['DOB']->format('d-m-Y'); ?></span>
                            <br>
                            <b><span>Address</span></b><br>
                            <span id="PermanentAddress" readonly="true"><?= $row_pending['PermanentAddress']; ?></span>
                            <br>
                            <span id="State" readonly="true"><?= $row_pending['District']; ?></span>
                            <br>
                            <span id="State" readonly="true"><?= $row_pending['State']; ?></span> PIN-
                            <span id="PIN" readonly="true"><?= $row_pending['PIN']; ?></span>
                            <hr>
                            <textarea name="" rows="2" cols="20" id="" class="form-control"
                                placeholder="Rejected Reason"><?= $row_pending['RejectReason']; ?></textarea>
                            <br>
                            <input type="submit" name="" value="Verify"
                                onclick="verify_idcard(<?= $row_pending['IDNO']; ?>);" class="btn btn-success">
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>

    </div>
    <?php }
   }
   elseif($code==145)
   {
      $id=$_POST['id'];
      $date=date('Y-m-d h:s:m');
      $get_pending="UPDATE SmartCardDetails SET status='Verified',VerifyDate='$date' Where IDNO='$id' ";
      $get_pending_run=sqlsrv_query($conntest,$get_pending);
      if($get_pending_run==true)
      {
echo "1";
      }
      else
      {
         echo "0";
      }
   }
   elseif($code==146)
   {
      $id=$_POST['id'];
         $remarks =str_replace("'",'',$_POST['remarks']);
      $date=date('Y-m-d h:s:m');
      $get_pending="UPDATE SmartCardDetails SET status='Rejected',RejectDate='$date',RejectReason='$remarks' Where IDNO='$id' ";
      $get_pending_run=sqlsrv_query($conntest,$get_pending);
      if($get_pending_run==true)
      {
echo "1";
      }
      else
      {
         echo "0";
      }
   }
   elseif($code==147)
   {
      ?><table class="table">
        <thead>
            <tr>
                <th>ClassRollNo</th>
                <th>Applied Date</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php 
   
                  $get_pending="SELECT top(10)* FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.Status='Applied' ";
                  $get_pending_run=sqlsrv_query($conntest,$get_pending);
                  while($row_pending=sqlsrv_fetch_array($get_pending_run))
                  {?>

            <tr>
                <td><?=$row_pending['ClassRollNo'];?></td>
                <td><?=$row_pending['ApplyDate']->format('d-M-Y');?></td>
                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"
                        onclick="view_pending(<?=$row_pending['IDNO'];?>);"><i class="fa fa-eye"></i></button></td>


            </tr>
            <?php }?>
        </tbody>
    </table>
    <?php
                  
   }
   elseif($code==148)
   {
      ?><table class="table">
        <thead>
            <tr>
                <th>ClassRollNo</th>
                <th>Applied Date</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody><?php 
   
                  $get_pending="SELECT * FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.Status='Rejected' ";
                  $get_pending_run=sqlsrv_query($conntest,$get_pending);
                  while($row_pending=sqlsrv_fetch_array($get_pending_run))
                  {
                     $Snap=$row_pending['Snap'];
                     $s_pic=base64_encode($Snap);   
                     ?>

            <tr>
                <td><?=$row_pending['ClassRollNo'];?></td>
                <td><?=$row_pending['ApplyDate']->format('d-M-Y');?></td>
                <td> <?php echo "<img width='40' src='data:image/jpeg;base64," . $s_pic . "' alt='message user image'>"; ?>
                </td>
                <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal"
                        onclick="view_pending(<?=$row_pending['IDNO'];?>);"><i class="fa fa-eye"></i></button></td>

            </tr>
            <?php }?>
        </tbody>
    </table><?php
                  
   }
   elseif ($code==149) {
      $count=0;
      $get_pending="SELECT * FROM SmartCardDetails where status='Applied' ";
      $get_pending_run=sqlsrv_query($conntest,$get_pending);
      while($row_pending=sqlsrv_fetch_array($get_pending_run))
      {
         $count++;
      }
      echo $count;
   }
   elseif ($code==150) {
      $count=0;
      $get_pending="SELECT * FROM SmartCardDetails where status='Rejected' ";
      $get_pending_run=sqlsrv_query($conntest,$get_pending);
      while($row_pending=sqlsrv_fetch_array($get_pending_run))
      {
         $count++;
      }
      echo $count;
   }
   elseif ($code==151)
    {
 
      $get_pending="SELECT top(10)* FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.Status='Applied' ";
      $get_pending_run=sqlsrv_query($conntest,$get_pending);
      while($row_pending=sqlsrv_fetch_array($get_pending_run))
      {
         $UniRollNo=$row_pending['IDNo'];
         $Snap=$row_pending['Snap'];
         $s_pic=base64_encode($Snap);
        
         $finfo = new finfo(FILEINFO_MIME_TYPE);
         $mime_type = $finfo->buffer($Snap);
         $extension = '';
         switch ($mime_type) {
             case 'image/jpeg':
                 $extension = 'jpg';
                 break;
             case 'image/png':
                 $extension = 'png';
                 break;
             
         }
   ?>
    <div class="container">
        <div class="container-fluid">
            <div class="card card-primary">

                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->

                        <div class="col-lg-6 text-center text-bold">
                            <img src="dist/img/new-logo.png" alt="logo" width="210">
                            <br><br>
                            <h5 style="background-color: #223260; color: white">
                                <span id="CollegeName" readonly="true"><?= $row_pending['CollegeName']; ?></span>
                            </h5>
                            <?php echo "<img width='100' src='data:image/jpeg;base64," . $s_pic . "' alt='message user image' style='border:groove black;'>"; ?>
                            <br>


                            <br>
                            <a href="data:<?php echo $mime_type; ?>;base64,<?php echo $s_pic; ?>"
                                download="<?php echo $UniRollNo; ?>.<?php echo $extension; ?>"><button
                                    class="btn btn-success btn-sm">Download Image</button></a>
                            <form id="image-upload" name="image-upload" action="action_g.php" method="post"
                                enctype="multipart/form-data">
                                <input type="file" name="image" id="image" class="form-control input-group-sm">
                                <input type="hidden" name="unirollno" value="<?php echo $UniRollNo; ?>">
                                <input type="hidden" name="code" value="153">
                                <input type="button" value="Upload" class="btn btn-success btn-xs"
                                    onclick="uploadImage(this.form,'<?php echo $UniRollNo; ?>')">
                            </form>
                            <div id="result"></div>

                            Name: <span id="StudentName" readonly="true"><?= $row_pending['StudentName']; ?></span>
                            <br>
                            RollNo: <span id="ClassRollNo" readonly="true"><?= $row_pending['ClassRollNo']; ?></span>
                            <br>
                            Course: <span id="Course" readonly="true"><?= $row_pending['Course']; ?></span>
                            <br>
                            Batch: <span id="Batch" readonly="true"><?= $row_pending['Batch']; ?></span><br>
                            Valid upto: <span id="ValidUpto" readonly="true"></span><br>
                            <br>
                            <h5 style="background-color: #223260; color: white">Authourity Signature</h5>
                        </div>
                        <div class="col-lg-6 text-center">
                            <b>This is a property of Guru Kashi University</b>
                            <hr>
                            FatherName: <span id="FatherName" readonly="true"><?= $row_pending['FatherName']; ?></span>
                            <br>
                            Mobile: <span id="StudetMobileNo"
                                readonly="true"><?= $row_pending['StudentMobileNo']; ?></span>
                            <br>
                            DOB: <span id="DOB" readonly="true"><?= $row_pending['DOB']->format('d-m-Y'); ?></span>
                            <br>
                            <b><span>Address</span></b><br>
                            <span id="PermanentAddress" readonly="true"><?= $row_pending['PermanentAddress']; ?></span>
                            <br>
                            <span id="State" readonly="true"><?= $row_pending['District']; ?></span>
                            <br>
                            <span id="State" readonly="true"><?= $row_pending['State']; ?></span> PIN-
                            <span id="PIN" readonly="true"><?= $row_pending['PIN']; ?></span>
                            <br>

                            <textarea rows="2" cols="20" id="Remarks<?=$row_pending['IDNO'];?>" class="form-control"
                                placeholder="Rejected Reason"><?= $row_pending['RejectReason']; ?></textarea>
                            <br>
                            <input type="submit" name="" value="Verify"
                                onclick="verify_idcard(<?=$row_pending['IDNO'];?>);" class="btn btn-success">
                            <input type="submit" name="" value="Reject"
                                onclick="reject_idcard(<?=$row_pending['IDNO'];?>);" class="btn btn-danger">
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>

    </div>
    <?php 
      }
   }
   elseif($code==152)
   {
  $UniRollNo=$_POST['uni'];
       $get_student_details="SELECT IDNo,Snap,Batch,Sex FROM Admissions where IDNo='$UniRollNo'";
                            $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                            if($row_student=sqlsrv_fetch_array($get_student_details_run))
                            {
                                $snap=$row_student['Snap'];
                                   $finfo = new finfo(FILEINFO_MIME_TYPE);
      $mime_type = $finfo->buffer($snap);
      $extension = '';
      switch ($mime_type) {
          case 'image/jpeg':
              $extension = 'jpg';
              break;
          case 'image/png':
              $extension = 'png';
              break;
          
      }
      // echo $extension;
      $pic = base64_encode($snap);
      // $pic = base64_encode($pic);
      ?>
    <img src="data:<?php echo $mime_type; ?>;base64,<?php echo $pic; ?>" width="300" height="300"
        style='border:groove black;'>
    <br>
    <a href="data:<?php echo $mime_type; ?>;base64,<?php echo $pic; ?>"
        download="<?php echo $UniRollNo; ?>.<?php echo $extension; ?>"><button class="btn btn-success btn-sm">Download
            Image</button></a>

    <form id="image-upload" name="image-upload" action="action_g.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image" class="form-control input-group-sm">
        <input type="hidden" name="unirollno" value="<?php echo $UniRollNo; ?>">
        <input type="hidden" name="code" value="153">
        <input type="button" value="Upload" class="btn btn-success btn-xs"
            onclick="uploadImage(this.form,'<?php echo $UniRollNo; ?>')">
    </form>
    <div id="result"></div>

    <?php
                 
                                
                             
  
                            }
   }

   else if($code==153)
   {
     $IDNo=$_POST['unirollno'];
       $file_name = $_FILES['image']['name'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $type = $_FILES['image']['type'];
       $file_data = file_get_contents($file_tmp);
      $characters = '';
     $result = $IDNo;
     $image_name =$result;
     $ftp_server1 = "10.0.10.11";
     $ftp_user_name1 = "Gurpreet";
     $ftp_user_pass1 = "Guri@123";
     $remote_file1 = "";
     $conn_id = ftp_connect($ftp_server1) or die("Could not connect to $ftp_server");
     $login_result = ftp_login($conn_id, $ftp_user_name1, $ftp_user_pass1) or die("Could not login to $ftp_server1");
     $destdir = 'Students';
     ftp_chdir($conn_id, "Students/") or die("Could not change directory");
     ftp_pasv($conn_id,true);
     file_put_contents($destdir.$image_name.'.PNG',$file_data);
     ftp_put($conn_id,$image_name.'.PNG',$destdir.$image_name.'.PNG',FTP_BINARY) or die("Could not upload to $ftp_server1");
     ftp_close($conn_id);
     $upimage = "UPDATE Admissions SET Snap = ? WHERE IDNo = ?";
  $params = array($file_data, $IDNo);
  $upimage_run = sqlsrv_query($conntest, $upimage, $params);
  if ($upimage_run === false) {
      $errors = sqlsrv_errors();
      // echo "Error: " . print_r($errors, true);
      // echo "0";
  } 
  else
   {
      echo "1";
  }
   }

   elseif ($code==154)
    {
 
      $get_pending="SELECT * FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.Status='Rejected' ";
      $get_pending_run=sqlsrv_query($conntest,$get_pending);
      while($row_pending=sqlsrv_fetch_array($get_pending_run))
      {
         $UniRollNo=$row_pending['IDNo'];
         $Snap=$row_pending['Snap'];
         $s_pic=base64_encode($Snap);
        
         $finfo = new finfo(FILEINFO_MIME_TYPE);
         $mime_type = $finfo->buffer($Snap);
         $extension = '';
         switch ($mime_type) {
             case 'image/jpeg':
                 $extension = 'jpg';
                 break;
             case 'image/png':
                 $extension = 'png';
                 break;
             
         }
   ?>
    <div class="container">
        <div class="container-fluid">
            <div class="card card-primary">
                <!-- <div class="card-header"> -->
                <h4 class="text-danger">
                    <center>Reject</center>
                </h4>
                <!-- </div> -->
                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->

                        <div class="col-lg-6 text-center text-bold">
                            <img src="dist/img/new-logo.png" alt="logo" width="210">
                            <br><br>
                            <h5 style="background-color: #223260; color: white">
                                <span id="CollegeName" readonly="true"><?= $row_pending['CollegeName']; ?></span>
                            </h5>
                            <?php echo "<img width='100' src='data:image/jpeg;base64," . $s_pic . "' alt='message user image' style='border:groove black;'>"; ?>
                            <br>


                            <br>
                            <a href="data:<?php echo $mime_type; ?>;base64,<?php echo $s_pic; ?>"
                                download="<?php echo $UniRollNo; ?>.<?php echo $extension; ?>"><button
                                    class="btn btn-success btn-sm">Download Image</button></a>
                            <form id="image-upload" name="image-upload" action="action_g.php" method="post"
                                enctype="multipart/form-data">
                                <input type="file" name="image" id="image" class="form-control input-group-sm">
                                <input type="hidden" name="unirollno" value="<?php echo $UniRollNo; ?>">
                                <input type="hidden" name="code" value="153">
                                <input type="button" value="Upload" class="btn btn-success btn-xs"
                                    onclick="uploadImage(this.form,'<?php echo $UniRollNo; ?>')">
                            </form>
                            <div id="result"></div>

                            Name: <span id="StudentName" readonly="true"><?= $row_pending['StudentName']; ?></span>
                            <br>
                            RollNo: <span id="ClassRollNo" readonly="true"><?= $row_pending['ClassRollNo']; ?></span>
                            <br>
                            Course: <span id="Course" readonly="true"><?= $row_pending['Course']; ?></span>
                            <br>
                            Batch: <span id="Batch" readonly="true"><?= $row_pending['Batch']; ?></span><br>
                            Valid upto: <span id="ValidUpto" readonly="true"></span><br>
                            <br>
                            <h5 style="background-color: #223260; color: white">Authourity Signature</h5>
                        </div>
                        <div class="col-lg-6 text-center">
                            <b>This is a property of Guru Kashi University</b>
                            <hr>
                            FatherName: <span id="FatherName" readonly="true"><?= $row_pending['FatherName']; ?></span>
                            <br>
                            Mobile: <span id="StudetMobileNo"
                                readonly="true"><?= $row_pending['StudentMobileNo']; ?></span>
                            <br>
                            DOB: <span id="DOB" readonly="true"><?= $row_pending['DOB']->format('d-m-Y'); ?></span>
                            <br>
                            <b><span>Address</span></b><br>
                            <span id="PermanentAddress" readonly="true"><?= $row_pending['PermanentAddress']; ?></span>
                            <br>
                            <span id="State" readonly="true"><?= $row_pending['District']; ?></span>
                            <br>
                            <span id="State" readonly="true"><?= $row_pending['State']; ?></span> PIN-
                            <span id="PIN" readonly="true"><?= $row_pending['PIN']; ?></span>
                            <br>

                            <textarea rows="2" cols="20" id="Remarks<?=$row_pending['IDNO'];?>" class="form-control"
                                placeholder="Rejected Reason"><?= $row_pending['RejectReason']; ?></textarea>
                            <br>
                            <input type="submit" name="" value="Verify"
                                onclick="verify_idcard(<?=$row_pending['IDNO'];?>);" class="btn btn-success">
                            <!-- <input type="submit" name="" value="Reject" onclick="reject_idcard(<?=$row_pending['IDNO'];?>);" class="btn btn-danger"> -->
                        </div>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>

    </div>
    <?php 
      }
   }
   elseif($code==155)
   {
      $college=$_POST['college'];
      $department=$_POST['department'];
      $course=$_POST['course'];
      $consultant_id=$_POST['consultant_id'];
      $consultant_id_old=$_POST['consultant_id_old'];
      $Lateral=$_POST['Lateral'];

      $iffeesalready="SELECT * FROM  master_fee where consultant_id='$consultant_id_old' and course='$course' and department='$department' and college='$college' ";
      $iffeesalready_run=mysqli_query($conn,$iffeesalready);
    if($row=mysqli_fetch_array($iffeesalready_run))
    {
      $applicable=$row['applicables'];
      $hostel=$row['hostel'];
      $concession=$row['concession'];
      $afterconcession=$row['after_concession'];
    
       $insert_consultant="INSERT INTO `master_fee` ( `college`, `department`, `course`, `applicables`, `hostel`, `concession`, `after_concession`, `consultant_id`,`Lateral`) VALUES ('$college', '$department', '$course', '$applicable', '$hostel', '$concession', '$afterconcession', '$consultant_id','$Lateral');";
      $insert_consultant_run=mysqli_query($conn,$insert_consultant);
      if ($insert_consultant_run==true)
       {
      echo "1";   
      }
      else
      {
      echo "0";
      }
   }

   }
   elseif($code==156)
   {
      $CollegeName = $_POST['CollegeName'];
      $Department = $_POST['Department'];
      $Course = $_POST['Course'];
      $Batch = $_POST['Batch'];
      $page = $_POST['page'];
      $recordsPerPage = 100;

$baseQuery = "SELECT * FROM MasterCourseCodes WHERE 1 = 1";
if ($CollegeName !== '') {
    $baseQuery .= " AND CollegeID='$CollegeName'";
}
if ($Department !== '') {
    $baseQuery .= " AND DepartmentId='$Department'";
}
if ($Course !== '') {
    $baseQuery .= " AND CourseID='$Course'";
}
if ($Batch !== '') {
    $baseQuery .= " AND Batch='$Batch'";
}
if ($CollegeName !== '') {
    $degree_run = sqlsrv_query($conntest, $baseQuery);
    while ($degree_row = sqlsrv_fetch_array($degree_run)) {
        $data[] = $degree_row;
    }
    $startIndex = ($page - 1) * $recordsPerPage;
    $pagedData = array_slice($data, $startIndex, $recordsPerPage);
    echo json_encode($pagedData);
}
 else 
{
    $degree = "SELECT * FROM MasterCourseCodes ORDER BY Id ASC"; 
    $degree_run = sqlsrv_query($conntest, $degree);
    while ($degree_row = sqlsrv_fetch_array($degree_run)) {                
        $data[] = $degree_row;
    }
    $startIndex = ($page - 1) * $recordsPerPage;
    $pagedData = array_slice($data, $startIndex, $recordsPerPage);
    echo json_encode($pagedData);
}
   }

   elseif($code==157)
    {
      $id=$_POST['id'];
      $baseQuery = "SELECT * FROM MasterCourseCodes WHERE Id='$id'";
      $baseQuery_run=sqlsrv_query($conntest,$baseQuery);
      if($row=sqlsrv_fetch_array($baseQuery_run))
      {
         $ValidUpTo=$row[9];
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <label>Session</label>
                    <select class="form-control" id="Session">
                        <option value="<?=$row[1];?>"><?=$row[1];?></option>
                        <?php 
                  $get_country="SELECT DISTINCT  Session FROM MasterCourseCodes ";
                  $get_country_run=sqlsrv_query($conntest,$get_country);
                  while($row_Session=sqlsrv_fetch_array($get_country_run))
                  {?>
                        <option value="<?=$row_Session['Session'];?>"><?=$row_Session['Session'];?></option>
                        <?php }

                 ?>
                    </select>

                </div>

                <div class="col-lg-4">
                    <label>College Name</label>
                    <select id='CollegeName1' onchange="collegeByDepartment1(this.value);" class="form-control"
                        required>
                        <option value='<?=$row[10];?>'><?=$row[2];?></option>
                        <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option value="<?=$CollegeID;?>"><?=$college;?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Department</label>
                    <select id="Department1" class="form-control" required>
                        <?php 
   $sql11 = "SELECT  Id,DepartmentFullName FROM MasterDepartment WHERE Id='".$row[17]."'";
  $stmt11 = sqlsrv_query($conntest,$sql11); 
         if($row11 = sqlsrv_fetch_array($stmt11) )
  {
?>
                        <option value='<?=$row11["Id"];?>'><?= $row11["DepartmentFullName"];?></option>
                        <?php 
  }
   $sql111 = "SELECT  Id,DepartmentFullName FROM MasterDepartment WHERE collegeId='".$row[10]."' order by Id DESC";
  $stmt111 = sqlsrv_query($conntest,$sql111); 
      while($row111 = sqlsrv_fetch_array($stmt111) )
  {
?>
                        <option value='<?=$row111["Id"];?>'><?= $row111["DepartmentFullName"];?></option>
                        <?php  }?>




                    </select>
                </div>
                <div class="col-lg-4">
                    <label>Course Name</label>
                    <input type="text" id="Course1" class="form-control" value="<?=$row[3];?>">
                </div>
                <div class="col-lg-4">
                    <label>Course Short Name</label>
                    <input type="text" id="CourseShortName" class="form-control" value="<?=$row[4];?>">
                </div>
                <div class="col-lg-2">
                    <label>Batch</label>
                    <select id="Batch1" class="form-control" required>
                        <option value="<?=$row[6];?>"><?=$row[6];?></option>
                        <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                                  ?>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>LateralEntry</label>
                    <select class="form-control" id="LateralEntry">
                        <option value="<?=$row[5];?>"><?=$row[5];?></option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>

                <div class="col-lg-4">

                    <label>Valid UpTo</label>
                    <input type="date" id="ValidUpTo" class="form-control"
                        value="<?php if($ValidUpTo!=''){ echo $row[9]->format('Y-m-d');}?>">
                </div>

                <div class="col-lg-4">
                    <label>ClassRollNo</label>
                    <input type="text" id="ClassRollNo" class="form-control" value="<?=$row[8];?>">

                </div>
                <div class="col-lg-4">
                    <label>EndClassRollNo</label>
                    <input type="text" id="EndClassRollNo" class="form-control" value="<?=$row['EndClassRollNo'];?>">

                </div>
                <div class="col-lg-2">
                    <label>Isopen</label>
                    <select class="form-control" id="Isopen"
                        style="border: 2px solid <?php if($row[19]=='1'){echo 'green';}else{ echo 'red';};?>">
                        <option value="<?=$row[19];?>"><?php if($row[9]=='1'){echo 'Yes';}else{ echo 'No';};?></option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Status</label>
                    <select class="form-control" id="Status"
                        style="border: 2px solid <?php if($row[15]=='1'){echo 'green';}else{ echo 'red';};?>">
                        <option value="<?=$row[15];?>"><?php if($row[15]=='1'){echo 'Yes';}else{ echo 'No';};?></option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Duration</label>
                    <select class="form-control" id="Duration">
                        <option value="<?=$row[20];?>"><?=$row[20];?></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <label>Course Type</label>
                    <select class="form-control" id="CourseType">
                        <option value="<?=$row[21];?>"><?=$row[21];?></option>
                        <option value="UG">UG</option>
                        <option value="PG">PG</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Ph.D">Ph.D</option>
                    </select>
                </div>


                <input type="hidden" id="master_id" class="form-control" value="<?=$row[0];?>">
            </div>
        </div>
    </div>
    <?php
      }
   }
   elseif($code==158)
   {
 $id=$_POST['id'];
 $Session=$_POST['Session'];
 $CollegeName=$_POST['CollegeName'];
 $Course=$_POST['Course'];
 $CourseShortName=$_POST['CourseShortName'];
 $DepartmentId=$_POST['DepartmentId'];
 $CollegeID=$_POST['CollegeID'];
 $Batch=$_POST['Batch'];
 $LateralEntry=$_POST['LateralEntry'];
 $ClassRollNo=$_POST['ClassRollNo'];
 $EndClassRollNo=$_POST['EndClassRollNo'];
 $Isopen=$_POST['Isopen'];
 $Status=$_POST['Status'];
 $Duration=$_POST['Duration'];
 $CourseType=$_POST['CourseType'];
  $insert_record = "UPDATE  MasterCourseCodes SET Session='$Session', CollegeName='$CollegeName',  Course='$Course', CourseShortName='$CourseShortName', DepartmentId='$DepartmentId', CollegeID='$CollegeID', Batch='$Batch',LateralEntry='$LateralEntry',ClassRollNo='$ClassRollNo',EndClassRollNo='$EndClassRollNo',Isopen='$Isopen',Status='$Status',CourseType='$CourseType',Duration='$Duration' where Id='$id'";
 $insert_record_run = sqlsrv_query($conntest, $insert_record);
if ($insert_record_run==true) 
{
echo "1";
}
else
{
   if ($insert_record_run === false) {
      $errors = sqlsrv_errors();
      // echo "Error: " . print_r($errors, true);
      // echo "0";
  }
echo "0";
}
}
elseif($code==159)
{
    $count=0;
    
    foreach($_POST['students'] as $key => $value)
     { 
        $delete="DELETE FROM degree_print WHERE  id=$value";
        $degree_run=mysqli_query($conn,$delete);   
    if($degree_run==true)
    {
        $count++;
    }
      }
 echo $count;
}
elseif($code=='160') 
{
$country_id=$_POST['country_id'];
 $sql = "SELECT  Id,name FROM states WHERE country_id='$country_id' order by name ASC";
$stmt = mysqli_query($conn,$sql); 
?>
    <option value=''>State</option>
    <?php 
       while($row = mysqli_fetch_array($stmt) )

{
?>
    <option value='<?=$row["Id"];?>'><?= $row["name"];?></option>
    <?php   }

}
elseif($code=='161') 
{
$state_id=$_POST['state_id'];
 $sql = "SELECT  id,name FROM cities WHERE state_id='$state_id' order by name ASC";
$stmt = mysqli_query($conn,$sql); 
?>
    <option value=''>State</option>
    <?php 
       while($row = mysqli_fetch_array($stmt) )

{
?>
    <option value='<?=$row["id"];?>'><?= $row["name"];?>(<?=$row["id"];?>)</option>
    <?php   }

}
elseif($code=='162') 
{
    $dist_count=0;
    $count=0;
$District=$_POST['District'];
$State=$_POST['State'];
 $sql1 = "SELECT  count FROM offer_admission_count WHERE District='$District'";
$stmt1 = mysqli_query($conn,$sql1); 
 if($row1 = mysqli_fetch_array($stmt1) )
{
$count=$row1['count'];
}
$sql=" SELECT State,District, COUNT(*) AS `dist` FROM offer_latter WHERE State='$State' and District='$District'";
 $result = mysqli_query($conn,$sql);
 while($row=mysqli_fetch_array($result))
{
    $dist_count=$row['dist']; 
}
 if($count>=$dist_count)
 {
echo "1";
 }
 else{
    echo "0";
 }


}
elseif($code==163)
{
    $District=$_POST['District'];
    $previous_count=$_POST['previous_count'];
    $adm_count=$_POST['adm_count'];
    $sql1 = "SELECT  * FROM offer_admission_count WHERE District='$District'";
    $stmt1 = mysqli_query($conn,$sql1); 
     if($row1 = mysqli_num_rows($stmt1)>0 )
    {
        $insert_record = "UPDATE offer_admission_count SET District='$District',count='$adm_count' where District='$District' ";
    }
    else
    {
    $insert_record = "INSERT INTO offer_admission_count (`District`, `count`) VALUES ('$District','$adm_count');";
    }
    $insert_record_run = mysqli_query($conn, $insert_record);
    if ($insert_record_run==true) 
    {
       echo "1";
    }
    else
    {
       echo "0";
    }

}
elseif($code=='164') 
{
    $count=0;
$District=$_POST['District'];
$State=$_POST['State'];
$sql1 = "SELECT count FROM offer_admission_count WHERE District='$District'";
$stmt1 = mysqli_query($conn,$sql1); 
 if($row1 = mysqli_fetch_array($stmt1) )
{
echo $count=$row1['count'];
 }


}
elseif($code==165)
{


  $list_sqlw5 ="SELECT * from fastival_images ";
  $list_result5 = mysqli_query($conn,$list_sqlw5);
        $i = 1;
        while( $row5 = mysqli_fetch_array($list_result5) )
        {  
            $todaydate=date('Y-m-d');
            $endDate=$row5['end_date'];
         ?>
<tr>
    <td><img src="dist/img/<?=$row5['image'];?>" width="100"></td>

    <th><?=$row5['name'];?></th>
    <th><?=$row5['start_date_'];?></th>
    <th><?=$row5['end_date'];?></th>
    <td><?php 
             if ($row5['start_date_']<= $todaydate &&  $row5['end_date'] >= $todaydate && $row5['logo']=='1' ) 
              {
                 echo "<b style='color:green;'>Show</b>";
              }
              else
              {
               echo "<b style='color:red;'>hide<b>";
              }
              ?></td>
    <td><?php 
             if ($row5['logo']=='1') 
              {
                 echo "<b style='color:green;'>Active</b>";
              }
              else
              {
               echo "<b style='color:red;'>DeActive<b>";
              }
              ?></td>
    <td><i class="fa fa-edit " data-toggle="modal" onclick="edit_start_end_date(<?=$row5['id'];?>);"
            data-target="#exampleModal_edit_permission_exam"></i></td>
</tr>
<?php        }
      ?>
<?php 
}
elseif($code==166)
{
      

    $id=$_POST['id'];
  
    $update_permission="select * from fastival_images  where id='$id'";
   $update_run=mysqli_query($conn,$update_permission);
 if($row=mysqli_fetch_array($update_run))
 {
   ?>
<div class="col-lg-12">
    <label>Start Date</label>
    <input type="date" name="" id="start_date_edit" class="form-control" value="<?=$row['start_date_'];?>">
</div>

<div class="col-lg-12">
    <label>End Date</label>
    <input type="date" name="" id="end_date_edit" class="form-control" value="<?=$row['end_date'];?>">
</div>
<div class="col-lg-12">
    <label>Status</label>
    <select class="form-control" id="status_edit">

        <option value="0">Select</option>
        <option value="1">Show</option>
        <option value="0">Hide</option>
    </select>
</div>
<div class="col-lg-12">
    <label>Action</label><br>
    <input type="button" onclick="update_date_end_date(<?=$id;?>);" class="btn btn-success" value="Update">
</div>
<?php 

 }

   }  
   elseif($code==167)
   {
   $id=$_POST['id'];
   $status=$_POST['status'];
   $start_date_edit=$_POST['start_date_edit'];
   $end_date_edit=$_POST['end_date_edit'];
   $update_permission="UPDATE fastival_images SET start_date_='$start_date_edit',end_date='$end_date_edit',logo='$status' where id='$id'";
   $update_run=mysqli_query($conn,$update_permission);

  if ($update_run==true)
    {
       echo "1";   
    }
   else
    {
       echo "0";
    }

   }
   else if($code==168)
   {
        $title=$_POST['title'];
        $start=$_POST['start'];
        $end=$_POST['end'];
       $file_name = $_FILES['image']['name'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $type = $_FILES['image']['type'];
       $file_data = file_get_contents($file_tmp);
      $characters = '';
     $result = $IDNo;
     $image_name =$result;
     $ftp_server1 = "10.0.8.10";
     $ftp_user_name1 = "gurukashi";
     $ftp_user_pass1 = "Amrik@123";
     $remote_file1 = "";
     $conn_id = ftp_connect($ftp_server1) or die("Could not connect to $ftp_server");
     $login_result = ftp_login($conn_id, $ftp_user_name1, $ftp_user_pass1) or die("Could not login to $ftp_server1");
     $destdir = 'fastival';
     ftp_chdir($conn_id, "fastival/") or die("Could not change directory");
     ftp_pasv($conn_id,true);
     file_put_contents($destdir.$image_name.'.PNG',$file_data);
     ftp_put($conn_id,$image_name.'.PNG',$destdir.$image_name.'.PNG',FTP_BINARY) or die("Could not upload to $ftp_server1");
     ftp_close($conn_id);

     $insert="INSERT into fastival_images(name,start_date_,end_date,logo)values('$title','$start','$end','1') ";
     $insert_run=mysqli_query($conn,$insert);


   }
   elseif($code==169)
   {
    $value=$_POST['by_search'];
    if($value!='')
    {
      
       $degree="SELECT * FROM degree_print where StudentName like '%$value%' or UniRollNo like '%$value%' order by Id ASC "; 
       $degree_run=mysqli_query($conn,$degree);
       while ($degree_row=mysqli_fetch_array($degree_run)) 
       {
        $data[]=$degree_row;
       }
       
       // print_r($row_student);
       $page = $_POST['page'];
       $recordsPerPage = 100;
       $startIndex = ($page - 1) * $recordsPerPage;
       $pagedData = array_slice($data, $startIndex, $recordsPerPage);
       // echo json_encode($pagedData);
    
           echo json_encode($pagedData);
      
    }
    else
    {
        $degree="SELECT * FROM degree_print  order by Id ASC "; 
        $degree_run=mysqli_query($conn,$degree);
        while ($degree_row=mysqli_fetch_array($degree_run)) 
        {
         $data[]=$degree_row;
        }
        
        // print_r($row_student);
        $page = $_POST['page'];
        $recordsPerPage = 100;
        $startIndex = ($page - 1) * $recordsPerPage;
        $pagedData = array_slice($data, $startIndex, $recordsPerPage);
        // echo json_encode($pagedData);
     
            echo json_encode($pagedData);
    }
   }
   elseif($code==170)
   {
      $value=$_POST['by_search'];
      if($value!='')
      {
         
             $degree="SELECT * FROM offer_latter where id like '%$value%' or Class_RollNo like '%$value%' or ID_Proof_No like '%$value%'  order by Id DESC "; 
        
        
         $degree_run=mysqli_query($conn,$degree);
         while ($degree_row=mysqli_fetch_array($degree_run)) 
         {
             $data2=$degree_row;
             $CourseID=$degree_row['Course'];
             $get_course="SELECT Course FROM MasterCourseStructure Where CourseId='$CourseID'";
             $get_course_run=sqlsrv_query($conntest,$get_course);
             if($row=sqlsrv_fetch_array($get_course_run))
             {
            $data1=$row;
            $data[]=array_merge($data2,$data1);
       
         }
         }
         // print_r($row_student);
         $page = $_POST['page'];
         $recordsPerPage = 50;
         $startIndex = ($page - 1) * $recordsPerPage;
         $pagedData = array_slice($data, $startIndex, $recordsPerPage);
         // echo json_encode($pagedData);
      
             echo json_encode($pagedData);
        
      }
      else
      {
          
             $degree="SELECT * FROM offer_latter  order by Id DESC "; 
       
                  $degree_run=mysqli_query($conn,$degree);
                  while ($degree_row=mysqli_fetch_array($degree_run)) 
                  {
                     $data2=$degree_row;
                     $CourseID=$degree_row['Course'];
                     $get_course="SELECT Course FROM MasterCourseStructure Where CourseId='$CourseID'";
                     $get_course_run=sqlsrv_query($conntest,$get_course);
                     if($row=sqlsrv_fetch_array($get_course_run))
                     {
                    $data1=$row;
                    $data[]=array_merge($data2,$data1);
               
                 }
                 
                  }
                  // print_r($data);139

                  $page = $_POST['page'];
                  $recordsPerPage = 50;
                  $startIndex = ($page - 1) * $recordsPerPage;
                  $pagedData = array_slice($data, $startIndex, $recordsPerPage);
                  echo json_encode($pagedData);
       }
   }

   elseif($code==171)
    {
        
      $id=$_POST['id'];
      $get_student_details="SELECT * FROM offer_latter  where id='$id'";
$get_student_details_run=mysqli_query($conn,$get_student_details);
if ($row=mysqli_fetch_array($get_student_details_run))
 {
    $name=$row['Name'];
    $FatherName=$row['FatherName'];
    $MotherName=$row['MotherName'];
    $Collegeid=$row['CollegeName'];
    $Course=$row['Course'];
    $Department=$row['Department'];
    $Gender=$row['Gender'];
    $classroll=$row['Class_RollNo'];
    $loanNumber=$row['loanNumber'];
    $applicationNo=$row['applicationNo'];
    if($row['dateVerification']!='')
    {

        $dateVerification=$row['dateVerification'];
    }
    else
    {
        $dateVerification=date('Y-m-d');
    }
    $statusVerification=$row['statusVerification'];
    




$get_colege_course_name="SELECT * FROM MasterCourseCodes where CollegeID='$Collegeid' and DepartmentId='$Department'";
$get_colege_course_name_run=sqlsrv_query($conntest,$get_colege_course_name);
if ($row_collegecourse_name=sqlsrv_fetch_array($get_colege_course_name_run)) {

    $courseName=$row_collegecourse_name['Course'];
    $CollegeName=$row_collegecourse_name['CollegeName'];
    $Department=$row_collegecourse_name['DepartmentId'];
$get_department_name="SELECT * FROM MasterDepartment where Id='$Department'";
$get_department_name_run=sqlsrv_query($conntest,$get_department_name);
if ($row_departcourse_name=sqlsrv_fetch_array($get_department_name_run)) {

    $DepartmentName=$row_departcourse_name['Department'];
}

}




$get_course_name="SELECT Course FROM MasterCourseCodes where CourseID='$Course'";
$get_course_name_run=sqlsrv_query($conntest,$get_course_name);
if ($row_course_name=sqlsrv_fetch_array($get_course_name_run)) 
{

    $courseName=$row_course_name['Course'];
}
    $State_id=$row['State'];
    $Session=$row['Session'];
    $Duration=$row['Duration'];
    $Consultant_id=$row['Consultant_id'];
    $Lateral=$row['Lateral'];
    $Nationality=$row['Nationality'];
    $ID_Proof_No=$row['ID_Proof_No'];
    $District_id=$row['District'];
     $months=$row['months'];
    
    

    $get_state="SELECT name FROM states  where id='$State_id'";
    $get_state_run=mysqli_query($conn,$get_state);
    if($row_state=mysqli_fetch_array($get_state_run))
    {
    $State=$row_state['name'];
    }
    $get_district="SELECT name FROM cities  where id='$District_id'";
    $get_district_run=mysqli_query($conn,$get_district);
    if($row_dist=mysqli_fetch_array($get_district_run))
    {
    $District=$row_dist['name'];

    }
     
   $get_country="SELECT name FROM countries  where id='$Nationality'";
                  $get_country_run=mysqli_query($conn,$get_country);
                  if($row=mysqli_fetch_array($get_country_run))
                  {
                    if ($row['name']=='India') {             
$NationalityName='Indian';
                    }else
                    {
$NationalityName=$row['name'];

                    }
                   }
    $fee_details="SELECT * FROM master_fee where consultant_id='$Consultant_id'";
$fee_details_run=mysqli_query($conn,$fee_details);
if ($row_fee=mysqli_fetch_array($fee_details_run))
 {
    $applicables=$row_fee['applicables'];
    $hostel=$row_fee['hostel'];
    $concession=$row_fee['concession'];
    $after_concession=$row_fee['after_concession'];
 }    

 $consultant_details="SELECT * FROM consultant_master where id='$Consultant_id'";
$consultant_details_run=mysqli_query($conn,$consultant_details);
if ($row_consultant=mysqli_fetch_array($consultant_details_run))
 {
    $consultant=$row_consultant['state'];
   
 }


    
}

?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-2">
                <label>Nationality</label>
                <input type="text" value="<?=$NationalityName;?>" id="Name" class="form-control" disabled>


            </div>


            <div class="col-lg-2">
                <label>State</label>
                <input type="text" value="<?=$State;?>" id="Name" class="form-control" disabled>


            </div>
            <div class="col-lg-2">
                <label>District</label>
                <input type="text" value="<?=$District;?>" id="Name" class="form-control" disabled>

            </div>




            <div class="col-lg-3">
                <label>Student Name</label>
                <input type="text" value="<?=$name;?>" id="Name" class="form-control" disabled>
            </div>
            <div class="col-lg-3">
                <label>Father Name</label>
                <input type="text" value="<?=$FatherName;?>" id="FatherName" class="form-control" disabled>
            </div>

            <div class="col-lg-3">
                <label>Gender</label>
                <select id="Gender" class="form-control" disabled>
                    <option value="<?=$Gender;?>"><?=$Gender;?></option>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>



            <div class="col-lg-3">
                <label>College Name</label>
                <select id='CollegeName1' onchange="collegeByDepartment1(this.value);" class="form-control" required
                    disabled>
                    <option value='<?=$Collegeid;?>'><?=$CollegeName;?></option>


                    <?php
                     
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                    <option value="<?=$CollegeID;?>"><?=$college;?></option>
                    <?php 
                    }
                        ?>

                </select>
            </div>
            <div class="col-lg-2">
                <label>Department</label>
                <select id="Department1" class="form-control" onchange="fetchcourse1()" disabled>
                    <option value='<?=$Department;?>'><?=$DepartmentName;?></option>
                </select>
            </div>


            <div class="col-lg-2">
                <label>Course</label>
                <select id="Course1" class="form-control" disabled>

                    <option value='<?=$Course;?>'><?=$courseName;?></option>
                </select>
            </div>
            <div class="col-lg-2">
                <label>Duration</label>
                <select class="form-control" id="Duration" disabled>
                    <option value="<?= $Duration?>"><?= $Duration;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
            </div>
            <div class="col-lg-2">
                <label>Course Duration</label>

                <select class="form-control" id="months" disabled>
                    <option value="<?= $months?>"><?= $months;?></option>

                    <option value="0">0 Month</option>
                    <option value="6">6 Month</option>

                </select>
            </div>




            <div class="col-lg-3">
                <label>Class RollNo</label>
                <input type="text" id="classroll" class="form-control" value="<?=$classroll;?>" disabled>


            </div>
            <div class="col-lg-3">
                <label>Loan Account No</label>
                <input type="text" id="loanNumber" class="form-control" value="<?=$loanNumber;?>">


            </div>
            <div class="col-lg-3">
                <label>ApplicationNo</label>
                <input type="text" id="applicationNo" class="form-control" value="<?=$applicationNo;?>">


            </div>
            <div class="col-lg-3">
                <label>Date</label>
                <input type="date" id="dateVerification" class="form-control" value="<?=$dateVerification;?>">


            </div>
            <div class="col-lg-3">
                <label>Status</label>
                <Select class="form-control" id="statusVerification">
                    <?php 
                        if($statusVerification=="0"){
                            ?><option value="<?=$statusVerification;?>">Pending</option>
                    <option value="1">Verified</option>
                    <?php 

                        }else
                        {
?> <option value="<?=$statusVerification;?>">Verified</option>
                    <option value="0">Pending</option>
                    <?php 
                        }
                       ?>
                </Select>


            </div>
            <div class="col-lg-3">
                <label>&nbsp;</label>
                <button class="btn btn-primary form-control" onclick="edit_student_details_a(<?=$id;?>)">Submit</button>
            </div>

        </div>
    </div>
</div>
<?php
   }
   elseif($code==172)
   {
$id = $_POST['id'];
$loanNumber = $_POST['loanNumber'];
$applicationNo = $_POST['applicationNo'];
$statusVerification = $_POST['statusVerification'];
$dateVerification = $_POST['dateVerification'];
 $insert_record = "UPDATE  offer_latter SET loanNumber='$loanNumber', applicationNo='$applicationNo',  statusVerification='$statusVerification', dateVerification='$dateVerification' where id='$id'";
$insert_record_run = mysqli_query($conn, $insert_record);
if ($insert_record_run==true) 
{
echo "1";
}
else
{
echo "0";
}
}
if ($code == 173) {
    // Get the current date
    $todaydate = date('Y-m-d');
  

?>

<table class="table table-bordered table-hover table-head-fixed" id="example">
    <thead>
        <tr>
            <th>Emp ID</th>
            <th>Main Menu</th>
            <th>Insert</th>
            <th>Update</th>
            <th>Delete</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            
            $count = 1;

            if($_POST['empid']!='')
            {
                 $sel_per1 = "SELECT  emp_id FROM special_permission where emp_id='".$_POST['empid']."'";
               
            }else
            {
                $sel_per1 = "SELECT DISTINCT emp_id FROM special_permission";
            }
            $sel_run1 = mysqli_query($conn, $sel_per1);

            while ($r1 = mysqli_fetch_array($sel_run1)) {
                
                $sel_per = "SELECT *, special_permission.id as s_id FROM special_permission INNER JOIN permissions ON permissions.id=special_permission.page_id WHERE special_permission.emp_id='" . $r1['emp_id'] . "' ORDER BY emp_id ASC";
                $sel_run = mysqli_query($conn, $sel_per);

                
                $count = mysqli_num_rows($sel_run) + 1;
            ?>
        <tr style="border: 1px solid red !important">
            <td rowspan='<?= $count; ?>' class="employee-info">
                <?php
                        
                        $staff = "SELECT Name, IDNo, Snap FROM Staff WHERE IDNo='" . $r1['emp_id'] . "'";
                        $stmt = sqlsrv_query($conntest, $staff);

                        if ($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            $Emp_Image = $row_staff['Snap'];
                            $emp_pic = base64_encode($Emp_Image);
                            echo "<label><b><img class='direct-chat-img' src='data:image/jpeg;base64," . $emp_pic . "' alt='message user image'></b></label>";
                            echo "<br><label><b>" . $Emp_Name = $row_staff['Name'] . '(' . $Emp_Name = $row_staff['IDNo'] . "</b></label>";
                        }
                        ?>
            </td>
        </tr>
        <?php
                while ($r = mysqli_fetch_array($sel_run)) {
                    
                    $checked_m = "";
                    $checked_I = "<i class='fa fa-times text-danger' aria-hidden='true'></i>";
                    $checked_U = "<i class='fa fa-times text-danger' aria-hidden='true'></i>";
                    $checked_D = "<i class='fa fa-times text-danger' aria-hidden='true'></i>";
                    $checked_O = "<i class='fa fa-times text-danger' aria-hidden='true'></i>";
                    $checked_m = "checked";

                    
                    if ($r['I'] == '1') {
                        $checked_I = "<i class='fa fa-check text-success' aria-hidden='true'></i>";
                    }
                    if ($r['U'] == '1') {
                        $checked_U = "<i class='fa fa-check text-success' aria-hidden='true'></i>";
                    }
                    if ($r['D'] == '1') {
                        $checked_D = "<i class='fa fa-check text-success' aria-hidden='true'></i>";
                    }
                    if (($r['start_date'] <= $todaydate && $r['end_date'] >= $todaydate) || ($r['start_date'] == '0000-00-00' && $r['end_date'] == '0000-00-00')) {
                        $checked_O = "<i class='fa fa-eye text-success' aria-hidden='true'></i>";
                    } else {
                        $checked_O = "<i class='fa fa-eye-slash text-danger' aria-hidden='true'></i>";
                    }
                ?>
        <tr>
            <td>
                <label><b style="color: #a62535"><?= $r['submenu']; ?><b></label>
            </td>
            <td>
                <label><?= $checked_I; ?></label>
            </td>
            <td>
                <label><?= $checked_U; ?></label>
            </td>
            <td>
                <label><?= $checked_D; ?></label>
            </td>
            <td>
                <input type="date" value="<?= $r['start_date']; ?>" id="sid_<?= $r['s_id']; ?>" class="form-control"
                    onchange="date_change(<?= $r['s_id']; ?>);">
            </td>
            <td>
                <input type="date" value="<?= $r['end_date']; ?>" id="eid_<?= $r['s_id']; ?>" class="form-control"
                    onchange="date_change(<?= $r['s_id']; ?>);">
            </td>
            <td>
                <label><?= $checked_O; ?></label>
            </td>
            <td>
                <label><i class="fa fa-trash-alt text-danger"
                        onclick="delete_special_permission(<?= $r['s_id']; ?>);"></i></label>
            </td>
        </tr>
        <?php
                    
                    $count = 1;
                }
            }
            ?>
    </tbody>
</table>
<?php
}
elseif($code==174)
{
$id = $_POST['id'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$insert_record = "UPDATE  special_permission SET start_date='$start_date', end_date='$end_date' where id='$id'";
$insert_record_run = mysqli_query($conn, $insert_record);
if ($insert_record_run==true) 
{
echo "1";
}
else
{
echo "0";
}
}
elseif($code==175)
{
$id = $_POST['id'];
$insert_record = "DELETE FROM  special_permission  where id='$id'";
$insert_record_run = mysqli_query($conn, $insert_record);
if ($insert_record_run==true) 
{
echo "1";
}
else
{
echo "0";
}
}
 
elseif($code==176)
{
?>
<form action="action_g.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="code" value="79">
    <div class="row container-fluid">
        <div class="col-lg-12">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="certificate" readonly>
        </div>
    </div>
    <div class="row container-fluid">
        <div class="col-lg-6">
            <label>Month</label>
            <select name="month" class="form-control" required>
                <option value="">Select</option>
                <option value="Jan">January</option>
                <option value="Feb">February</option>
                <option value="Mar">March</option>
                <option value="Apr">April</option>
                <option value="May">May</option>
                <option value="Jun">June</option>
                <option value="Jul">July</option>
                <option value="Aug">August</option>
                <option value="Sep">September</option>
                <option value="Oct">October</option>
                <option value="Nov">November</option>
                <option value="Dec">December</option>
            </select>
        </div>
        <div class="col-lg-6">
            <label>Year</label>
            <select class="form-control" name="year" required>
                <option value="">Select</option>
                <?php  for ($i=2015; $i <=date('Y') ; $i++) 
   { ?>
                <option value="<?=$i;?>"><?=$i;?></option>

                <?php }  ?>
            </select>
        </div>
        <!-- <div class="col-lg-12">
                <label>Stream/Specialization/Topic/Thesis/Subjects (Optional)</label>
                 <input type="text" name="stream" class="form-control" > -->
        <!-- <textarea class="form-control" name="stream" rowspan="3"></textarea> -->
        <!-- </div> -->
    </div>
    <div class="row container-fluid">
        <div class="col-lg-12">
            <label>File</label>
            <input type="file" name="file" class="form-control" required>
        </div>
    </div>
    <div class="row container-fluid">
        <div class="col-lg-12">
            <label>Action</label><br>
            <input type="submit" class="btn btn-success" value="Upload">
        </div>
    </div>
</form>
<br>
<?php

}

elseif($code==177)
{
$id = $_POST['id'];


$upd="UPDATE offer_latter SET PrintDate='$timeStamp',PrintDate1='$timeStamp',generate='1'  where id='$id '";

mysqli_query($conn,$upd);



}

elseif($code==178)
{

          echo "JSON is empty";


}

elseif($code==179)
{

       
          $degree="SELECT * FROM offer_latter where statusVerification='0' order by Id DESC "; 
    
               $degree_run=mysqli_query($conn,$degree);
               while ($degree_row=mysqli_fetch_array($degree_run)) 
               {
                  $data2=$degree_row;
                  $CourseID=$degree_row['Course'];
                  $get_course="SELECT Course FROM MasterCourseStructure Where CourseId='$CourseID'";
                  $get_course_run=sqlsrv_query($conntest,$get_course);
                  if($row=sqlsrv_fetch_array($get_course_run))
                  {
                 $data1=$row;
                 $data[]=array_merge($data2,$data1);
            
              }
              

               }

                print_r($data);

               $page = $_POST['page'];
               $recordsPerPage = 10000;
               $startIndex = ($page - 1) * $recordsPerPage;
               $pagedData = array_slice($data, $startIndex, $recordsPerPage);
               echo json_encode($pagedData);
    
}
elseif($code==180)
{

       
          $degree="SELECT * FROM offer_latter where statusVerification='1' order by Id DESC "; 
    
               $degree_run=mysqli_query($conn,$degree);
               while ($degree_row=mysqli_fetch_array($degree_run)) 
               {
                  $data2=$degree_row;
                  $CourseID=$degree_row['Course'];
                  $get_course="SELECT Course FROM MasterCourseStructure Where CourseId='$CourseID'";
                  $get_course_run=sqlsrv_query($conntest,$get_course);
                  if($row=sqlsrv_fetch_array($get_course_run))
                  {
                 $data1=$row;
                 $data[]=array_merge($data2,$data1);
            
              }
              
               }
               // print_r($data);139

               $page = $_POST['page'];
               $recordsPerPage = 10000;
               $startIndex = ($page - 1) * $recordsPerPage;
               $pagedData = array_slice($data, $startIndex, $recordsPerPage);
               echo json_encode($pagedData);
    
}

elseif($code==181)
{?>

<div class="col-lg-12">
    <?php

     $emp_id=$_POST['id'];
       $getUserDetails="SELECT * FROM Staff Where IDNo='$emp_id'";
       $getUserDetailsRun=sqlsrv_query($conntest,$getUserDetails);
       if($getUserDetailsRow=sqlsrv_fetch_array($getUserDetailsRun,SQLSRV_FETCH_ASSOC))
       {
$Name=$getUserDetailsRow['Name'];
$getUserDetailsRow['Snap'];
$Designation=$getUserDetailsRow['Designation'];
$CollegeName=$getUserDetailsRow['CollegeName'];

?>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <label>Name</label>
            <?=$Name;?>

        </div>
        <div class="col-lg-4">
            <label>Designation</label>
            <?=$Designation;?>

        </div>
        <div class="col-lg-4">
            <label>CollegeName</label>
            <?=$CollegeName;?>

        </div>
    </div>
    <br>
    <table class="table  table-bordered">
        <tr>
            <th> ID</th>
            <th>Emp ID</th>
            <th>Password</th>
            <th>LoginType</th>
            <th>RightsLevel</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php 
$getUserMaster="SELECT * FROM UserMaster Where UserName='$emp_id' ";
$getUserMasterRun=sqlsrv_query($conntest,$getUserMaster);
$countPerms=0;
while($getUserMasterRunRow=sqlsrv_fetch_array($getUserMasterRun,SQLSRV_FETCH_ASSOC))
{
?>
        <tr>
            <td><?=$getUserMasterRunRow['UserMasterID'];?></td>
            <td><?=$getUserMasterRunRow['UserName'];?></td>
            <td><?=$getUserMasterRunRow['Password'];?></td>
            <td>
                <select class="form-control" id="LoginType">
                    <option value="<?=$getUserMasterRunRow['LoginType'];?>"><?=$getUserMasterRunRow['LoginType'];?>
                    </option>

                    <?php 
$getDefalutMenu="SELECT Distinct LoginType FROM LoginTypePerms ";
$getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);
while($getDefalutMenuRunRow=sqlsrv_fetch_array($getDefalutMenuRun,SQLSRV_FETCH_ASSOC))
{
?>

                    <option value="<?=$getDefalutMenuRunRow['LoginType'];?>"><?=$getDefalutMenuRunRow['LoginType'];?>
                    </option>


                    <?php 
}?>

            </td>
            <td>
                <select class="form-control" id="RightsLevel">
                    <option value="<?=$getUserMasterRunRow['RightsLevel'];?>"><?=$getUserMasterRunRow['RightsLevel'];?>
                    </option>

                    <?php 
$getDefalutMenu="SELECT Distinct Category FROM DefaultMenu  ";
$getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);
while($getDefalutMenuRunRow=sqlsrv_fetch_array($getDefalutMenuRun,SQLSRV_FETCH_ASSOC))
{
?>

                    <option value="<?=$getDefalutMenuRunRow['Category'];?>"><?=$getDefalutMenuRunRow['Category'];?>
                    </option>


                    <?php 
}?>

            </td>
            <td><button class="btn btn-danger"
                    onclick="deleteRole('<?=$getUserMasterRunRow['UserName'];?>','<?=$getUserMasterRunRow['UserMasterID'];?>');"><i
                        class="fa fa-trash text-white"></i></button></td>
            <td><button class="btn btn-success"
                    onclick="updateRole('<?=$getUserMasterRunRow['UserName'];?>','<?=$getUserMasterRunRow['UserMasterID'];?>');"><i
                        class="fa fa-check text-white fa-1x"></i></button></td>
        </tr>
        <?php

$countPerms++;
}
if($countPerms<1)
{
   ?> <tr>
            <td></td>
            <td><?=$getUserDetailsRow['IDNo'];?></td>
            <td>
                <select class="form-control" id="LoginType">
                    <option value="">Select</option>

                    <?php 
$getDefalutMenu="SELECT Distinct LoginType FROM LoginTypePerms ";
$getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);
while($getDefalutMenuRunRow=sqlsrv_fetch_array($getDefalutMenuRun,SQLSRV_FETCH_ASSOC))
{
?>

                    <option value="<?=$getDefalutMenuRunRow['LoginType'];?>"><?=$getDefalutMenuRunRow['LoginType'];?>
                    </option>


                    <?php 
}?>

            </td>
            <td>
                <select class="form-control" id="RightsLevel">
                    <option value="">Select</option>
                    <?php 
$getDefalutMenu="SELECT Distinct Category FROM DefaultMenu  ";
$getDefalutMenuRun=sqlsrv_query($conntest,$getDefalutMenu);
while($getDefalutMenuRunRow=sqlsrv_fetch_array($getDefalutMenuRun,SQLSRV_FETCH_ASSOC))
{
?>
                    <option value="<?=$getDefalutMenuRunRow['Category'];?>"><?=$getDefalutMenuRunRow['Category'];?>
                    </option>
                    <?php 
}?>
            </td>
            <td></td>
            <td><button class="btn btn-success"
                    onclick="addRole('<?=$getUserDetailsRow['IDNo'];?>','<?=$getUserDetailsRow['CollegeName'];?>');"><i
                        class="fa fa-plus text-white fa-1x"></i></button></td>
        </tr>
        <?php 
}
?>
    </table>
    <?php 
 }
    ?>
</div>
<?php      
}

elseif($code==182)
{
$empid = $_POST['empid'];
$userMasterId = $_POST['userMasterId'];
$insert_record = "DELETE FROM  UserMaster  where UserMasterID='$userMasterId' and UserName='$empid'";
$insert_record_run = sqlsrv_query($conntest, $insert_record);
if ($insert_record_run==true) 
{
echo "1";
}
else
{
echo "0";
}
}
elseif($code==183)
{
$empid = $_POST['empid'];
$userMasterId = $_POST['userMasterId'];
$LoginType = $_POST['LoginType'];
$RightsLevel = $_POST['RightsLevel'];
$insert_record = "UPDATE  UserMaster SET LoginType='$LoginType' ,RightsLevel='$RightsLevel' ,ApplicationType='Web' ,ApplicationName='Campus'   where UserMasterID='$userMasterId' and UserName='$empid'";
$insert_record_run = sqlsrv_query($conntest, $insert_record);
if ($insert_record_run==true) 
{
echo "1";
}
else
{
echo "0";
}
}
elseif($code==184)
{
$empid = $_POST['empid'];
$LoginType = $_POST['LoginType'];
$RightsLevel = $_POST['RightsLevel'];
$CollegeName = $_POST['college'];
 $insert_record="INSERT into UserMaster(UserName,Password,LoginType,RightsLevel,ApplicationType,ApplicationName,CollegeName)values('$empid','$empid','$LoginType','$RightsLevel','Web','Campus','$CollegeName');";
$insert_record_run = sqlsrv_query($conntest, $insert_record);
if ($insert_record_run==true) 
{
echo "1";
}
else
{
echo "0";
}
}
elseif($code==185)
{
    $subject_code=$_POST['subject_code'];
    ?>
<table class="table table-bordered" id="example">
    <thead>
        <?php 
    $getUserDetails="SELECT * FROM Staff Where IDNo='$subject_code'";
    $getUserDetailsRun=sqlsrv_query($conntest,$getUserDetails);
    if($getUserDetailsRow=sqlsrv_fetch_array($getUserDetailsRun,SQLSRV_FETCH_ASSOC))
    {
$Name=$getUserDetailsRow['Name'];
$getUserDetailsRow['Snap'];
$Designation=$getUserDetailsRow['Designation'];
$CollegeName=$getUserDetailsRow['CollegeName'];
$Emp_Image=$getUserDetailsRow['Snap'];
$emp_pic=base64_encode($Emp_Image);


              
    ?>

        <tr style="background-color:#223260; color:white;">
            <td colspan="20">
                <?php   echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image' width='100'>";?>
            </td>
            <td colspan="20">
                <h5><?=$Name;?></h5>
            </td>
            <td colspan="20">
                <h5><?=$Designation;?></h5>
            </td>
            <td colspan="20">
                <h5><?=$CollegeName;?></h5>
            </td>
        </tr>

        <?php }?>
        </tr>
    </thead>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Books Published</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>category</th>
            <th>authors</th>
            <th>publisher</th>
            <th>status_of_paper</th>
            <th>title</th>
            <th>isbn_no</th>
            <th>vol_no</th>
            <th>issue</th>
            <th>page_no</th>
            <th>doi</th>
            <th>publishing_house</th>
            <th>indexing</th>
            <th>database_name</th>
            <th>link</th>
            <th>upload_front_page</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestionQry="SELECT * FROM books_published WHERE emp_id='$subject_code' ";
             $showQuestionRun=mysqli_query($conn_spoc,$showQuestionQry);
             while($showQuestionData=mysqli_fetch_array($showQuestionRun))
             {
             ?>
        <tr style='background-color:#9FE2BF; :white;'>
            <td><?=$showQuestionData['category'];?></td>
            <td><?=$showQuestionData['authors'];?></td>
            <td><?=$showQuestionData['publisher'];?></td>
            <td><?=$showQuestionData['status_of_paper'];?></td>
            <td><?=$showQuestionData['title'];?></td>
            <td><?=$showQuestionData['isbn_no'];?></td>
            <td><?=$showQuestionData['vol_no'];?></td>
            <td><?=$showQuestionData['issue'];?></td>
            <td><?=$showQuestionData['page_no'];?></td>
            <td><?=$showQuestionData['doi'];?></td>
            <td><?=$showQuestionData['publishing_house'];?></td>
            <td><?=$showQuestionData['indexing'];?></td>
            <td><?=$showQuestionData['database_name'];?></td>
            <td><?=$showQuestionData['link'];?></td>
            <td><?=$showQuestionData['upload_front_page'];?></td>
            <td><?=$showQuestionData['comments'];?></td>
            <td><?=$showQuestionData['month_name'];?></td>
            <td><?=$showQuestionData['year_name'];?></td>
            <td><?=$showQuestionData['status_code'];?></td>
            <td><?=$showQuestionData['creation_date'];?></td>
            <td><?=$showQuestionData['updation_date'];?></td>
        </tr>
        <?php 
             //    $srno++;
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Research Publications</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>category</th>
            <th>authors</th>
            <th>type_of_author</th>
            <th>status_of_paper</th>
            <th>type_paper</th>
            <th>title</th>
            <th>date_of_comm</th>
            <th>date_of_accept</th>
            <th>date_of_publication</th>
            <th>name</th>
            <th>level</th>
            <th>volume</th>
            <th>issue</th>
            <th>page_no</th>
            <th>doi</th>
            <th>index_database</th>
            <th>naas_index</th>
            <th>naas_rating</th>
            <th>issn</th>
            <th>impact_factor</th>
            <th>paper_link</th>
            <th>upload_paper</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion1Qry="SELECT * FROM research_publications WHERE emp_id='$subject_code' ";
             $showQuestion1Run=mysqli_query($conn_spoc,$showQuestion1Qry);
             while($showQuestion1Data=mysqli_fetch_array($showQuestion1Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>
            <td><?=$showQuestion1Data['category'];?></td>
            <td><?=$showQuestion1Data['authors'];?></td>
            <td><?=$showQuestion1Data['type_of_author'];?></td>
            <td><?=$showQuestion1Data['status_of_paper'];?></td>
            <td><?=$showQuestion1Data['type_paper'];?></td>
            <td><?=$showQuestion1Data['title'];?></td>
            <td><?=$showQuestion1Data['date_of_comm'];?></td>
            <td><?=$showQuestion1Data['date_of_accept'];?></td>
            <td><?=$showQuestion1Data['date_of_publication'];?></td>
            <td><?=$showQuestion1Data['name'];?></td>
            <td><?=$showQuestion1Data['level'];?></td>
            <td><?=$showQuestion1Data['volume'];?></td>
            <td><?=$showQuestion1Data['issue'];?></td>
            <td><?=$showQuestion1Data['page_no'];?></td>
            <td><?=$showQuestion1Data['doi'];?></td>
            <td><?=$showQuestion1Data['index_database'];?></td>
            <td><?=$showQuestion1Data['naas_index'];?></td>
            <td><?=$showQuestion1Data['naas_rating'];?></td>
            <td><?=$showQuestion1Data['issn'];?></td>
            <td><?=$showQuestion1Data['impact_factor'];?></td>
            <td><?=$showQuestion1Data['paper_link'];?></td>
            <td><?=$showQuestion1Data['upload_paper'];?></td>
            <td><?=$showQuestion1Data['comments'];?></td>
            <td><?=$showQuestion1Data['month_name'];?></td>
            <td><?=$showQuestion1Data['year_name'];?></td>
            <td><?=$showQuestion1Data['status_code'];?></td>
            <td><?=$showQuestion1Data['creation_date'];?></td>
            <td><?=$showQuestion1Data['updation_date'];?></td>
        </tr>
        <?php 
             //    $srno++;
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Admission Initiatives</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>orgDate</th>
            <th>number_of_form_filled</th>
            <th>admission_taken</th>
            <th>program</th>
            <th>branch_id</th>
            <th>intiatives_undertaken</th>
            <th>remarks</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion2Qry="SELECT * FROM admission_initiatives WHERE emp_id='$subject_code' ";
             $showQuestion2Run=mysqli_query($conn_spoc,$showQuestion2Qry);
             while($showQuestion2Data=mysqli_fetch_array($showQuestion2Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>
            <td><?=$showQuestion2Data['emp_id'];?></td>
            <td><?=$showQuestion2Data['orgDate'];?></td>
            <td><?=$showQuestion2Data['number_of_form_filled'];?></td>
            <td><?=$showQuestion2Data['admission_taken'];?></td>
            <td><?=$showQuestion2Data['program'];?></td>
            <td><?=$showQuestion2Data['branch_id'];?></td>
            <td><?=$showQuestion2Data['intiatives_undertaken'];?></td>
            <td><?=$showQuestion2Data['remarks'];?></td>
            <td><?=$showQuestion2Data['comments'];?></td>
            <td><?=$showQuestion2Data['month_name'];?></td>
            <td><?=$showQuestion2Data['year_name'];?></td>
            <td><?=$showQuestion2Data['status_code'];?></td>
            <td><?=$showQuestion2Data['creation_date'];?></td>
            <td><?=$showQuestion2Data['updation_date'];?></td>
        </tr>
        <?php 
             //    $srno++;
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Assign Responsibility</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>emp_id</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>responsibility_assigned</th>
            <th>work_done</th>
            <th>status_code</th>
            <th>comments</th>
            <th>creation_date</th>
            <th>updation_date</th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion4Qry="SELECT * FROM assign_responsibility WHERE emp_id='$subject_code' ";
             $showQuestion4Run=mysqli_query($conn_spoc,$showQuestion4Qry);
             while($showQuestion4Data=mysqli_fetch_array($showQuestion4Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>
            <td><?=$showQuestion4Data['emp_id'];?></td>
            <td><?=$showQuestion4Data['month_name'];?></td>
            <td><?=$showQuestion4Data['year_name'];?></td>
            <td><?=$showQuestion4Data['responsibility_assigned'];?></td>
            <td><?=$showQuestion4Data['work_done'];?></td>
            <td><?=$showQuestion4Data['status_code'];?></td>
            <td><?=$showQuestion4Data['comments'];?></td>
            <td><?=$showQuestion4Data['creation_date'];?></td>
            <td><?=$showQuestion4Data['updation_date'];?></td>
        </tr>
        <?php 
             //    $srno++;
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Award</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>category</th>
            <th>faculty_student_name</th>
            <th>emp_roll</th>
            <th>program</th>
            <th>event_name</th>
            <th>level</th>
            <th>organized_by</th>
            <th>venue</th>
            <th>award_name</th>
            <th>awarding_agency</th>
            <th>agency_type</th>
            <th>upload_proof</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion5Qry="SELECT * FROM award WHERE emp_id='$subject_code' ";
             $showQuestion5Run=mysqli_query($conn_spoc,$showQuestion5Qry);
             while($showQuestion5Data=mysqli_fetch_array($showQuestion5Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>
            <td><?=$showQuestion5Data['category'];?></td>
            <td><?=$showQuestion5Data['faculty_student_name'];?></td>
            <td><?=$showQuestion5Data['emp_roll'];?></td>
            <td><?=$showQuestion5Data['program'];?></td>
            <td><?=$showQuestion5Data['event_name'];?></td>
            <td><?=$showQuestion5Data['level'];?></td>
            <td><?=$showQuestion5Data['organized_by'];?></td>
            <td><?=$showQuestion5Data['venue'];?></td>
            <td><?=$showQuestion5Data['award_name'];?></td>
            <td><?=$showQuestion5Data['awarding_agency'];?></td>
            <td><?=$showQuestion5Data['agency_type'];?></td>
            <td><?=$showQuestion5Data['upload_proof'];?></td>
            <td><?=$showQuestion5Data['comments'];?></td>
            <td><?=$showQuestion5Data['month_name'];?></td>
            <td><?=$showQuestion5Data['year_name'];?></td>
            <td><?=$showQuestion5Data['status_code'];?></td>
            <td><?=$showQuestion5Data['creation_date'];?></td>
            <td><?=$showQuestion5Data['updation_date'];?></td>
        </tr>
        <?php 
             //    $srno++;
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Classes Delivered</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>no_of_classes_assigned</th>
            <th>no_of_classes_delivered</th>
            <th>emerging_subject</th>
            <th>subject_code</th>
            <th>subject_name</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>comments</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion6Qry="SELECT * FROM classes_delivered WHERE emp_id='$subject_code' ";
             $showQuestion6Run=mysqli_query($conn_spoc,$showQuestion6Qry);
             while($showQuestion6Data=mysqli_fetch_array($showQuestion6Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>
            <td><?=$showQuestion6Data['no_of_classes_assigned'];?></td>
            <td><?=$showQuestion6Data['no_of_classes_delivered'];?></td>
            <td><?=$showQuestion6Data['emerging_subject'];?></td>
            <td><?=$showQuestion6Data['subject_code'];?></td>
            <td><?=$showQuestion6Data['subject_name'];?></td>
            <td><?=$showQuestion6Data['month_name'];?></td>
            <td><?=$showQuestion6Data['year_name'];?></td>
            <td><?=$showQuestion6Data['comments'];?></td>
            <td><?=$showQuestion6Data['status_code'];?></td>
            <td><?=$showQuestion6Data['creation_date'];?></td>
            <td><?=$showQuestion6Data['updation_date'];?></td>
        </tr>
        <?php 
             //    $srno++;
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Collaborative</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>collab_agency</th>
            <th>collab_type</th>
            <th>activity_name</th>
            <th>start_date</th>
            <th>end_date</th>
            <th>upload_proof</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>
            <th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion8Qry="SELECT * FROM collaborative WHERE emp_id='$subject_code' ";
             $showQuestion8Run=mysqli_query($conn_spoc,$showQuestion8Qry);
             while($showQuestion8Data=mysqli_fetch_array($showQuestion8Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>
            <td><?=$showQuestion8Data['collab_agency'];?></td>
            <td><?=$showQuestion8Data['collab_type'];?></td>
            <td><?=$showQuestion8Data['activity_name'];?></td>
            <td><?=$showQuestion8Data['start_date'];?></td>
            <td><?=$showQuestion8Data['end_date'];?></td>
            <td><?=$showQuestion8Data['upload_proof'];?></td>
            <td><?=$showQuestion8Data['comments'];?></td>
            <td><?=$showQuestion8Data['month_name'];?></td>
            <td><?=$showQuestion8Data['year_name'];?></td>
            <td><?=$showQuestion8Data['status_code'];?></td>
            <td><?=$showQuestion8Data['creation_date'];?></td>
            <td><?=$showQuestion8Data['updation_date'];?></td>
        </tr>
        <?php 
           
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Consultancy</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>principal_investigator</th>
            <th>co_principal_investigator</th>
            <th>title_of_the_consultancy_project</th>
            <th>company_name</th>
            <th>company_type</th>
            <th>name_of_the_contact_person</th>
            <th>email_id</th>
            <th>phone_no</th>
            <th>amount_sanctioned</th>
            <th>amount_received</th>
            <th>approval_letter_copy</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>

        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion9Qry="SELECT * FROM consultancy WHERE emp_id='$subject_code' ";
             $showQuestion9Run=mysqli_query($conn_spoc,$showQuestion9Qry);
             while($showQuestion9Data=mysqli_fetch_array($showQuestion9Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>

            <td><?=$showQuestion9Data['principal_investigator'];?></td>
            <td><?=$showQuestion9Data['co_principal_investigator'];?></td>
            <td><?=$showQuestion9Data['title_of_the_consultancy_project'];?></td>
            <td><?=$showQuestion9Data['company_name'];?></td>
            <td><?=$showQuestion9Data['company_type'];?></td>
            <td><?=$showQuestion9Data['name_of_the_contact_person'];?></td>
            <td><?=$showQuestion9Data['email_id'];?></td>
            <td><?=$showQuestion9Data['phone_no'];?></td>
            <td><?=$showQuestion9Data['amount_sanctioned'];?></td>
            <td><?=$showQuestion9Data['amount_received'];?></td>
            <td><?=$showQuestion9Data['approval_letter_copy'];?></td>
            <td><?=$showQuestion9Data['comments'];?></td>
            <td><?=$showQuestion9Data['month_name'];?></td>
            <td><?=$showQuestion9Data['year_name'];?></td>
            <td><?=$showQuestion9Data['status_code'];?></td>
            <td><?=$showQuestion9Data['creation_date'];?></td>
            <td><?=$showQuestion9Data['updation_date'];?></td>


        </tr>
        <?php 
           
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Funding Agencies</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>principal_investigator</th>
            <th>co_principal_investigator</th>
            <th>status</th>
            <th>title_of_the_project</th>
            <th>date_of_applying</th>
            <th>date_of_sanction</th>
            <th>agency</th>
            <th>type_agency</th>
            <th>tenure</th>
            <th>amount_sanctioned</th>
            <th>amount_received</th>
            <th>level</th>
            <th>approval_letter</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion11Qry="SELECT * FROM funding_agencies WHERE emp_id='$subject_code' ";
             $showQuestion11Run=mysqli_query($conn_spoc,$showQuestion11Qry);
             while($showQuestion11Data=mysqli_fetch_array($showQuestion11Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>
            <td><?=$showQuestion11Data['principal_investigator'];?></td>
            <td><?=$showQuestion11Data['co_principal_investigator'];?></td>
            <td><?=$showQuestion11Data['status'];?></td>
            <td><?=$showQuestion11Data['title_of_the_project'];?></td>
            <td><?=$showQuestion11Data['date_of_applying'];?></td>
            <td><?=$showQuestion11Data['date_of_sanction'];?></td>
            <td><?=$showQuestion11Data['agency'];?></td>
            <td><?=$showQuestion11Data['type_agency'];?></td>
            <td><?=$showQuestion11Data['tenure'];?></td>
            <td><?=$showQuestion11Data['amount_sanctioned'];?></td>
            <td><?=$showQuestion11Data['amount_received'];?></td>
            <td><?=$showQuestion11Data['level'];?></td>
            <td><?=$showQuestion11Data['approval_letter'];?></td>
            <td><?=$showQuestion11Data['comments'];?></td>
            <td><?=$showQuestion11Data['month_name'];?></td>
            <td><?=$showQuestion11Data['year_name'];?></td>
            <td><?=$showQuestion11Data['status_code'];?></td>
            <td><?=$showQuestion11Data['creation_date'];?></td>
            <td><?=$showQuestion11Data['updation_date'];?></td>

        </tr>
        <?php 
           
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Industrial Visits</h4>
                </center>
            </td>
        </tr>
        <tr>

            <th>institute_id</th>
            <th>faculty_role</th>
            <th>name_company</th>
            <th>location</th>
            <th>name_contact_person</th>
            <th>contact_number</th>
            <th>email_id</th>
            <th>date_of_visit</th>
            <th>number_student_participated</th>
            <th>programme_report</th>
            <th>media_coverage</th>
            <th>sanction_letter</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>


        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion12Qry="SELECT * FROM industrial_visits WHERE emp_id='$subject_code' ";
             $showQuestion12Run=mysqli_query($conn_spoc,$showQuestion12Qry);
             while($showQuestion12Data=mysqli_fetch_array($showQuestion12Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>



            <td><?=$showQuestion12Data['institute_id'];?></td>
            <td><?=$showQuestion12Data['faculty_role'];?></td>
            <td><?=$showQuestion12Data['name_company'];?></td>
            <td><?=$showQuestion12Data['location'];?></td>
            <td><?=$showQuestion12Data['name_contact_person'];?></td>
            <td><?=$showQuestion12Data['contact_number'];?></td>
            <td><?=$showQuestion12Data['email_id'];?></td>
            <td><?=$showQuestion12Data['date_of_visit'];?></td>
            <td><?=$showQuestion12Data['number_student_participated'];?></td>
            <td><?=$showQuestion12Data['programme_report'];?></td>
            <td><?=$showQuestion12Data['media_coverage'];?></td>
            <td><?=$showQuestion12Data['sanction_letter'];?></td>
            <td><?=$showQuestion12Data['comments'];?></td>
            <td><?=$showQuestion12Data['month_name'];?></td>
            <td><?=$showQuestion12Data['year_name'];?></td>
            <td><?=$showQuestion12Data['status_code'];?></td>
            <td><?=$showQuestion12Data['creation_date'];?></td>
            <td><?=$showQuestion12Data['updation_date'];?></td>

        </tr>
        <?php 
           
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Isr Extension</h4>
                </center>
            </td>
        </tr>
        <tr>



            <th>faculty_role</th>
            <th>name_of_the_activity</th>
            <th>location</th>
            <th>name_of_the_partening_ngo</th>
            <th>sector</th>
            <th>type_of_activity</th>
            <th>number_of_faculty_involved</th>
            <th>number_of_students_covered</th>
            <th>date_of_activity</th>
            <th>funded_by</th>
            <th>programme_report_link</th>
            <th>media_coverge_link</th>
            <th>status_code</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>creation_date</th>
            <th>updation_date</th>

        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion13Qry="SELECT * FROM isr_extension WHERE emp_id='$subject_code' ";
             $showQuestion13Run=mysqli_query($conn_spoc,$showQuestion13Qry);
             while($showQuestion13Data=mysqli_fetch_array($showQuestion13Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>




            <td><?=$showQuestion13Data['faculty_role'];?></td>
            <td><?=$showQuestion13Data['name_of_the_activity'];?></td>
            <td><?=$showQuestion13Data['location'];?></td>
            <td><?=$showQuestion13Data['name_of_the_partening_ngo'];?></td>
            <td><?=$showQuestion13Data['sector'];?></td>
            <td><?=$showQuestion13Data['type_of_activity'];?></td>
            <td><?=$showQuestion13Data['number_of_faculty_involved'];?></td>
            <td><?=$showQuestion13Data['number_of_students_covered'];?></td>
            <td><?=$showQuestion13Data['date_of_activity'];?></td>
            <td><?=$showQuestion13Data['funded_by'];?></td>
            <td><?=$showQuestion13Data['programme_report_link'];?></td>
            <td><?=$showQuestion13Data['media_coverge_link'];?></td>
            <td><?=$showQuestion13Data['status_code'];?></td>
            <td><?=$showQuestion13Data['comments'];?></td>
            <td><?=$showQuestion13Data['month_name'];?></td>
            <td><?=$showQuestion13Data['year_name'];?></td>
            <td><?=$showQuestion13Data['creation_date'];?></td>
            <td><?=$showQuestion13Data['updation_date'];?></td>

        </tr>
        <?php 
           
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Paper Presented Conference</h4>
                </center>
            </td>
        </tr>
        <tr>
            <th>category</th>
            <th>authors</th>
            <th>type_of_authors</th>
            <th>status_of_paper</th>
            <th>title_of_conference</th>
            <th>level_of_conference</th>
            <th>title_of_paper</th>
            <th>dates_from</th>
            <th>dates_to</th>
            <th>organised_by</th>
            <th>page_nos</th>
            <th>proceeding_link</th>
            <th>isbn_no</th>
            <th>expenditure_occured</th>
            <th>funded_by</th>
            <th>upload_certificate</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>
        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion14Qry="SELECT * FROM paper_presented_conference WHERE emp_id='$subject_code' ";
             $showQuestion14Run=mysqli_query($conn_spoc,$showQuestion14Qry);
             while($showQuestion14Data=mysqli_fetch_array($showQuestion14Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>
            <td><?=$showQuestion14Data['category'];?></td>
            <td><?=$showQuestion14Data['authors'];?></td>
            <td><?=$showQuestion14Data['type_of_authors'];?></td>
            <td><?=$showQuestion14Data['status_of_paper'];?></td>
            <td><?=$showQuestion14Data['title_of_conference'];?></td>
            <td><?=$showQuestion14Data['level_of_conference'];?></td>
            <td><?=$showQuestion14Data['title_of_paper'];?></td>
            <td><?=$showQuestion14Data['dates_from'];?></td>
            <td><?=$showQuestion14Data['dates_to'];?></td>
            <td><?=$showQuestion14Data['organised_by'];?></td>
            <td><?=$showQuestion14Data['page_nos'];?></td>
            <td><?=$showQuestion14Data['proceeding_link'];?></td>
            <td><?=$showQuestion14Data['isbn_no'];?></td>
            <td><?=$showQuestion14Data['expenditure_occured'];?></td>
            <td><?=$showQuestion14Data['funded_by'];?></td>
            <td><?=$showQuestion14Data['upload_certificate'];?></td>
            <td><?=$showQuestion14Data['comments'];?></td>
            <td><?=$showQuestion14Data['month_name'];?></td>
            <td><?=$showQuestion14Data['year_name'];?></td>
            <td><?=$showQuestion14Data['status_code'];?></td>
            <td><?=$showQuestion14Data['creation_date'];?></td>
            <td><?=$showQuestion14Data['updation_date'];?></td>
        </tr>
        <?php 
           
                }
                ?>
    </tboday>
</table>
<table class="table table-bordered" id="example">
    <thead>
        <tr>
            <td colspan="20">
                <center>
                    <h4>Seminar Workshop Organised</h4>
                </center>
            </td>
        </tr>
        <tr>

            <th>faculty_role</th>
            <th>category</th>
            <th>participant_types</th>
            <th>title_of_the_programme</th>
            <th>from_date</th>
            <th>to_date</th>
            <th>level</th>
            <th>collaborative_agenecy</th>
            <th>resource_person</th>
            <th>designation_contact_details</th>
            <th>organisation</th>
            <th>faculty_organiser</th>
            <th>program_details_wesite_link</th>
            <th>media_coverage</th>
            <th>funding_agency</th>
            <th>expeniture_incurred</th>
            <th>no_of_student_participated</th>
            <th>no_of_student_participated_external</th>
            <th>no_of_faculty_participated</th>
            <th>no_of_faculty_participated_external</th>
            <th>no_of_non_faculty_participated_internal</th>
            <th>no_of_non_faculty_participated_external</th>
            <th>upload_paper</th>
            <th>comments</th>
            <th>month_name</th>
            <th>year_name</th>
            <th>status_code</th>
            <th>creation_date</th>
            <th>updation_date</th>


        </tr>
    </thead>
    <tboday>
        <?php
             $showQuestion14Qry="SELECT * FROM seminar_workshop_organised WHERE emp_id='$subject_code' ";
             $showQuestion14Run=mysqli_query($conn_spoc,$showQuestion14Qry);
             while($showQuestion14Data=mysqli_fetch_array($showQuestion14Run))
             {
             ?>
        <tr style='background-color:#9FE2BF;color:;'>

            <td><?=$showQuestion14Data['faculty_role'];?></td>
            <td><?=$showQuestion14Data['participant_types'];?></td>
            <td><?=$showQuestion14Data['title_of_the_programme'];?></td>
            <td><?=$showQuestion14Data['from_date'];?></td>
            <td><?=$showQuestion14Data['to_date'];?></td>
            <td><?=$showQuestion14Data['level'];?></td>
            <td><?=$showQuestion14Data['collaborative_agenecy'];?></td>
            <td><?=$showQuestion14Data['resource_person'];?></td>
            <td><?=$showQuestion14Data['designation_contact_details'];?></td>
            <td><?=$showQuestion14Data['organisation'];?></td>
            <td><?=$showQuestion14Data['faculty_organiser'];?></td>
            <td><?=$showQuestion14Data['program_details_wesite_link'];?></td>
            <td><?=$showQuestion14Data['media_coverage'];?></td>
            <td><?=$showQuestion14Data['funding_agency'];?></td>
            <td><?=$showQuestion14Data['expeniture_incurred'];?></td>
            <td><?=$showQuestion14Data['no_of_student_participated'];?></td>
            <td><?=$showQuestion14Data['no_of_student_participated_external'];?></td>
            <td><?=$showQuestion14Data['no_of_faculty_participated'];?></td>
            <td><?=$showQuestion14Data['no_of_faculty_participated_external'];?></td>
            <td><?=$showQuestion14Data['no_of_non_faculty_participated_internal'];?></td>
            <td><?=$showQuestion14Data['no_of_non_faculty_participated_external'];?></td>
            <td><?=$showQuestion14Data['upload_paper'];?></td>
            <td><?=$showQuestion14Data['comments'];?></td>
            <td><?=$showQuestion14Data['month_name'];?></td>
            <td><?=$showQuestion14Data['year_name'];?></td>
            <td><?=$showQuestion14Data['status_code'];?></td>
            <td><?=$showQuestion14Data['creation_date'];?></td>
            <td><?=$showQuestion14Data['updation_date'];?></td>

        </tr>
        <?php 
           
                }
                ?>
    </tboday>
</table>
<?php
}

elseif ($code==186) 
{
   $empID=$_POST['id'];
    $staff="SELECT * FROM Staff Where IDNo='$empID' ANd JobStatus='1'";
    $stmt = sqlsrv_query($conntest,$staff);  
    if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
    {
        $jobStatus=$row_staff['JobStatus'];
        if ($jobStatus=='1') 
        {
         ?>

<b><?=$row_staff['Name'];?></b>

<?php
     }
        else
        {
            echo "<b>Can not assign to ".$empID;
        }
        
    }
}  

elseif($code=='187') 
{
$count=0;
$sql=" SELECT offer_latter.State AS o_state, offer_latter.Consultant_id,COUNT(*) AS `total_count`,SUM(CASE WHEN offer_latter.statusVerification = '1' THEN 1 ELSE 0 END) AS `verified_count`, states.name AS StateName, consultant_master.state AS ConsultantName
FROM
offer_latter INNER JOIN states ON states.id = offer_latter.State
INNER JOIN consultant_master ON consultant_master.id = offer_latter.Consultant_id
GROUP BY offer_latter.State, offer_latter.Consultant_id, states.name, consultant_master.state
ORDER BY ConsultantName ASC;";
$result = mysqli_query($conn,$sql);
?>
<table class='table table-bordered'>
    <tr>
        <th>Consultant Name</th>
        <th>District</th>
        <th> Adm Count</th>
        <th>Verified Count</th>
        <th>Export</th>
    </tr> <?php
while($row=mysqli_fetch_array($result))
{

?>
    <tr>
        <td><?=$row['ConsultantName'];?></td>
        <td><?=$row['StateName'];?></td>
        <td><?=$row['total_count'];?></td>
        <td><?=$row['verified_count'];?></td>
        <td><i class="fa fa-file-excel fa-2x text-success" onclick="export_one('<?=$row['Consultant_id'];?>');"></i>
        </td>


        <?php               
                


}
}
elseif($code==188)
{
  $ids=$_POST['subjectIDs'];

 print_r($ids);
  foreach($ids as $key => $id)
  {
     
       $verified_study="DELETE From UserAccessLevel  WHERE AccessLevelID='$id'";
        $verified_study_run=sqlsrv_query($conntest,$verified_study);  

  }
  if ($verified_study_run==true) {
     echo "1";
  }
  else
  {
     echo "0";
  }

} 
elseif($code==189)
{
  $id=$_POST['ID'];
  $empid=$_POST['empid'];
;
        $verified_study="DELETE From UserAccessLevel  WHERE AccessLevelID='$id' and IDNo='$empid'";
        $verified_study_run=sqlsrv_query($conntest,$verified_study);  
  if ($verified_study_run==true) {
     echo "1";
  }
  else
  {
     echo "0";
  }

} 
elseif($code==190)
{
$CollegeID=$_POST['College'];
$id=$_POST['empid'];
    ?>
        <table class="table  table-bordered">
            <tr>

                <th> <input type="checkbox" id="select_all1" onclick="selectForDelete();" class="checkbox"></th>
                <th>ID</th>
                <th>College</th>

                <th>Course</th>
                <th>Delete</th>
            </tr>
            <?php 
       if($CollegeID!='')
       {
$getUserMaster="SELECT * FROM UserAccessLevel where CollegeID='$CollegeID' and IDNo='$id'  ";
} 
else
{
           $getUserMaster="SELECT * FROM UserAccessLevel where  IDNo='$id'  ";

       }
$getUserMasterRun=sqlsrv_query($conntest,$getUserMaster);
$countPerms=0;
while($getUserMasterRunRow=sqlsrv_fetch_array($getUserMasterRun,SQLSRV_FETCH_ASSOC))
{
    $getCollegeName="SELECT * FROM MasterCourseCodes where CourseID='".$getUserMasterRunRow['CourseID']."'  ";
$getCollegeNameRun=sqlsrv_query($conntest,$getCollegeName);
$countPerms=0;
if($getCollegeNameRunRow=sqlsrv_fetch_array($getCollegeNameRun,SQLSRV_FETCH_ASSOC))
{
?>
            <tr>

                <td><input type="checkbox" class="checkbox v_check" value="<?=$getUserMasterRunRow['AccessLevelID'];?>">
                </td>
                </td>

                <td>
                    <?=$getUserMasterRunRow['AccessLevelID'];?>
                </td>
                <td>

                    <?=$getCollegeNameRunRow['CollegeName'];?>
                </td>
                <td>
                    <?=$getCollegeNameRunRow['Course'];?>
                </td>
                <td><button type="button" class="btn btn-danger btn-xs"
                        onclick="deleteCollegeCourse('<?=$getUserMasterRunRow['AccessLevelID'];?>','<?=$getUserMasterRunRow['IDNo'];?>');"><i
                            class="fa fa-trash text-white"></i></button></td>
            </tr>
            <?php
}
}
?>
            <tr>
                <td>
                    <button type="button" class="btn btn-danger btn-xs"
                        onclick="deleteCollegeCoursePermissions(<?=$id;?>);"><i class="fa fa-trash "></i></button>
                </td>
            </tr>
        </table>
        <?php 
} 
elseif($code==191)
{

  $College_ID=$_POST['CollegeID'];
  $Department=$_POST['Department'];
  $Course=$_POST['Course'];
  $empid=$_POST['empid'];

  if($College_ID!='' and $Course=='' )
  {
       $verified_study="SELECT *  From UserAccessLevel  WHERE CollegeID='$College_ID'  and IDNo='$empid'";
    $verified_study_run=sqlsrv_query($conntest,$verified_study);
     $stmt4=sqlsrv_query($conntest,$verified_study,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));  
      $ifexist=sqlsrv_num_rows($stmt4);
if ($ifexist>0) {
          $verified_study1="DELETE From UserAccessLevel  WHERE CollegeID='$College_ID' and IDNo='$empid'";
        sqlsrv_query($conntest,$verified_study1);  

    $getCollegeCourse1="SELECT DISTINCT CollegeID,CourseID From MasterCourseCodes Where CollegeID='$College_ID'  and Status='1'";
    $getCollegeCourseRun1=sqlsrv_query($conntest,$getCollegeCourse1);
    while($row1=sqlsrv_fetch_array($getCollegeCourseRun1))
    {
   $CollegeID=$row1['CollegeID'];
   $CourseID=$row1['CourseID'];
          $inserCollegePermission="INSERT into UserAccessLevel (IDNo,CollegeID,CourseID)values('$empid','$CollegeID','$CourseID')";
        sqlsrv_query($conntest,$inserCollegePermission);
    }
    echo "1";
}
  else
  {
           $getCollegeCourse1="SELECT DISTINCT  CollegeID,CourseID From MasterCourseCodes Where CollegeID='$College_ID'  and Status='1'";
    $getCollegeCourseRun1=sqlsrv_query($conntest,$getCollegeCourse1);
    while($row1=sqlsrv_fetch_array($getCollegeCourseRun1))
    {
   $CollegeID=$row1['CollegeID'];
   $CourseID=$row1['CourseID'];
         $inserCollegePermission="INSERT into UserAccessLevel (IDNo,CollegeID,CourseID)values('$empid','$CollegeID','$CourseID')";
        sqlsrv_query($conntest,$inserCollegePermission);
    }
    echo "1";
  }
  }
  else
  {
     $verified_study="SELECT *  From UserAccessLevel  WHERE CollegeID='$College_ID' and CourseID='$Course'  and IDNo='$empid'";
    $verified_study_run=sqlsrv_query($conntest,$verified_study);
    $stmt4=sqlsrv_query($conntest,$verified_study,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));  
     $ifexist=sqlsrv_num_rows($stmt4);
if ($ifexist>0) {
     $verified_study1="DELETE  From UserAccessLevel  WHERE CollegeID='$College_ID' and CourseID='$Course'  and IDNo='$empid'";
    sqlsrv_query($conntest,$verified_study1);

$getCollegeCourse="SELECT DISTINCT CollegeID,CourseID From MasterCourseCodes Where CollegeID='$College_ID' and CourseID='$Course' and Status='1'";
$getCollegeCourseRun=sqlsrv_query($conntest,$getCollegeCourse);
if($row=sqlsrv_fetch_array($getCollegeCourseRun))
{
$CollegeID=$row['CollegeID'];
$CourseID=$row['CourseID'];
     $inserCollegePermission="INSERT into UserAccessLevel (IDNo,CollegeID,CourseID)values('$empid','$CollegeID','$CourseID')";
    sqlsrv_query($conntest,$inserCollegePermission);
}
echo "1";
}
else
{
 $getCollegeCourse="SELECT DISTINCT CollegeID,CourseID From MasterCourseCodes Where CollegeID='$College_ID' and CourseID='$Course'  and Status='1'";
$getCollegeCourseRun=sqlsrv_query($conntest,$getCollegeCourse);
if($row=sqlsrv_fetch_array($getCollegeCourseRun))
{
$CollegeID=$row['CollegeID'];
$CourseID=$row['CourseID'];
     $inserCollegePermission="INSERT into UserAccessLevel (IDNo,CollegeID,CourseID)values('$empid','$CollegeID','$CourseID')";
    sqlsrv_query($conntest,$inserCollegePermission);
}
echo "1";
}
  }



}

elseif($code==192)
{
    ?>
        <section class="content">
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-tools">
                            <div class="input-group">
                                <button type="button" data-toggle="modal" data-target="#NewDepartmentModal"
                                    value="New Designation" class="btn btn-primary btn-xs"><i class="fa fa-plus"> New
                                        Department</i> </button>
                                &nbsp;
                                &nbsp;
                                <select name="College" id='CollegeID_For_Department'
                                    class="form-control form-control-sm" required="">
                                    <option value=''>Select College</option>
                                    <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {
     $college = $row1['CollegeName']; 
     $CollegeID = $row1['CollegeID'];
    ?>
                                    <option value="<?=$CollegeID;?>"><?= $college;?></option>
                                    <?php    }

?>
                                </select>
                                <input type="button" onclick="search();" value="Search" class="btn btn-success btn-xs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive " id="tab_data">
            </div>
        </section>
        <?php

}
elseif($code==193)
{
    ?>
        <section class="content">
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-tools">
                            <div class="input-group">
                                <button type="button" data-toggle="modal" data-target="#NewDesignationModal"
                                    value="New Designation" class="btn btn-primary btn-xs"><i class="fa fa-plus"> New
                                        Designation</i> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive  " id="tab_data" style="height:600px;">


                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$count=1;
$sql="SELECT *  from MasterDesignation where Status='1' ";

          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

      $Designation = $row1['Designation']; 
            $id = $row1['Id'];
    ?>
                        <tr>
                            <td><?=$count;?></td>
                            <td><?=$Designation;?>(<?= $id;?>)</td>
                            <td>
                                <i class="fa fa-edit fa-lg" onclick="update_designation(<?=$id;?>);" data-toggle="modal"
                                    data-target="#UpdateDesignationModalCenter2" style="color:green;"></i>
                                &nbsp;&nbsp;&nbsp;&nbsp;

                                <i class="fa fa-trash fa-lg" onclick="delete_designation(<?=$id;?>);"
                                    style="color:red;"></i>
                            </td>

                        </tr>
                        <?php 
$count++;
}
// print_r($aaa);
?>



                    </tbody>

                </table>



            </div>
        </section>
        <?php

}
elseif($code=='194') 
{

$CollegeID = $_POST['college']; 
      $shortname = $_POST['department']; 
     
 $updatedep="INSERT  into MasterDesignation (Designation,Status) Values('$shortname','1')";

  $stmt2 = sqlsrv_query($conntest,$updatedep);
 if($stmt2)
 {
   echo '1';
 } 
}

elseif($code=='195') 
{
$Id=$_POST['id'];

$count=1;


   $sql="SELECT  * from MasterDesignation  where Id='$Id' ";


 
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

            $Designation = $row1['Designation']; 
            $id = $row1['Id'];
    ?>

        <div class="row">
            <div class="col-lg-1"><label>ID</label><br><?=$id;?></div>
            <div class="col-lg-4">
                <label>Designation</label>
                <input type="text" value="<?=$Designation ;?>" id="fullname" class="form-control" required="">
            </div>

            <div class="col-lg-1">
                <label>Action</label>
                <button onclick="UpdatedepDesignation(<?=$id;?>)" class="btn btn-primary">Update</button>
            </div>
        </div>


        <?php 
$count++;
}

}
elseif($code=='196') 
{

$id = $_POST['id'];
      $fullname=$_POST['fullname']; 



$updatedep="UPDATE MasterDesignation set Designation='$fullname',Status='1' where Id='$id'";

  $stmt2 = sqlsrv_query($conntest,$updatedep);
  echo "1";
}

elseif($code=='197') 
{
$id = $_POST['id']; 
  $updatedep="DELETE from  MasterDesignation where Id='$id'";

  $stmt2 = sqlsrv_query($conntest,$updatedep);
 if($stmt2)
 {
   echo '1';
 } 
}

elseif($code=='198') 
{
?> <div class="container-fluid">
            <br>
            <center>
                <h3>Add New Staff</h3>
            </center>
            <br>
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Emp. ID</label>
                        <input type="number" class="form-control" id="loginId" value="">
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="Name" placeholder="Enter name" value="">
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="form-group">
                        <label>Designation</label>

                        <select class="form-control" id="designation">
                            <option value="">
                                Select</option>
                            <?php  $get_Designation="SELECT DISTINCT Designation FROM MasterDesignation ";
                                                $get_DesignationRun=sqlsrv_query($conntest,$get_Designation);
                                                while($get_DesignationRow=sqlsrv_fetch_array($get_DesignationRun,SQLSRV_FETCH_ASSOC))
                                                {?>
                            <option value="<?=$get_DesignationRow['Designation'];?>">
                                <?=$get_DesignationRow['Designation'];?></option>
                            <?php }
                                          ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3" style="text-align: left;">
                    <label>College Name</label>
                    <select id='College3' onchange="collegeByDepartment3(this.value);" class="form-control" required>
                        <option value=''>Select Faculty</option>
                        <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option value="<?=$CollegeID;?>"><?=$college;?> (<?=$CollegeID;?>)</option>
                        <?php }
                        ?>
                        <!-- <option value="other">Other</option> -->
                    </select>
                </div>
                <div class="col-lg-3" style="text-align: left;">
                    <label>Department</label>
                    <select id="Department3" class="form-control" onchange="fetchcourse3()" required>
                        <option value=''>Select Department</option>

                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" id="Dob" value="">


                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" id="Gender">
                            <option value="">Select
                            </option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" class="form-control" id="FatherName" placeholder="Enter father's name"
                            value="">
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Conatct Number</label>
                        <input type="number" class="form-control" id="Conatct" placeholder="Contact Number"
                            pattern="[7-9]{1}[0-9]{9}" value="">
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="number" class="form-control" id="Mobile" placeholder="Mobile Number"
                            pattern="[7-9]{1}[0-9]{9}" value="">
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Email ID</label>
                        <input type="email" class="form-control" id="Email" placeholder="Enter Email id "
                            pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" value="">
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Date of Joining</label>
                        <input type="date" class="form-control" id="Doj" value="">
                    </div>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Emp. Categories</label>
                        <select class="form-control" id="category">
                            <option selected="selected" value="Select">Select</option>
                            <option value="1">Default</option>
                            <option value="6">Teaching</option>
                            <option value="7">Non-Teaching</option>
                            <option value="8">Class Four</option>
                            <option value="9">Administration</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea class="form-control" id="Permanent" cols="30" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label>Correspondance Address</label>
                        <textarea class="form-control" id="Correspondance" cols="30" rows="3"></textarea>
                    </div>
                </div>




            </div>
            <div class="card-footer">

                <button type="button" class="btn btn-success" onclick="addEmployee();">Add</button>
            </div>

        </div>

        <?php 
}
elseif($code==199)
{

$loginId=$_POST['loginId'];
$RecommendingAuth=0;
$SenctionAuth=0;
$Name=$_POST['Name'];
$designation=$_POST['designation'];
$CollegeId=$_POST['College3'];
$Department3=$_POST['Department3'];
$get_leave_auth="SELECT * FROM leave_authority where DepartmentID='$Department3' and CollegeID='$CollegeId'";
$get_leave_auth_run=mysqli_query($conn,$get_leave_auth);
if($row_auth=mysqli_fetch_array($get_leave_auth_run))
{
    $SenctionAuth=$row_auth['Recommending'];
     $RecommendingAuth=$row_auth['Senction'];

}
 $getCollegeName="SELECT CollegeName FROM MasterCourseCodes Where CollegeID='$CollegeId'";
$getCollegeNameRun=sqlsrv_query($conntest,$getCollegeName);
if($row=sqlsrv_fetch_array($getCollegeNameRun))
{
     $college=$row['CollegeName'];
}
$getDepartment="SELECT DepartmentFullName FROM  MasterDepartment Where Id='$Department3'";
$getDepartmentRun=sqlsrv_query($conntest,$getDepartment);
if($row1=sqlsrv_fetch_array($getDepartmentRun))
{
    $Department=$row1['DepartmentFullName'];
}
$Group="";
$Dob=$_POST['Dob'];
$Type="";
$Gender=$_POST['Gender'];
$FatherName=$_POST['FatherName'];
$Conatct=$_POST['Conatct'];
$Mobile=$_POST['Mobile'];
$Email=$_POST['Email'];
$Doj=$_POST['Doj'];
$category=$_POST['category'];
$Permanent=$_POST['Permanent'];
$Correspondance=$_POST['Correspondance'];
 $insertEmployee="INSERT into Staff (IDNo,Name,FatherName,Designation,DepartmentID,Department,Type,Gender,CorrespondanceAddress,PermanentAddress,ContactNo,MobileNo,EmailID,DateOfBirth,BloodGroup,DateOfJoining,CategoryId,CollegeId,CollegeName,JobStatus,LeaveRecommendingAuthority,LeaveSanctionAuthority)
Values('$loginId','$Name','$FatherName','$designation','$Department3','$Department','$Type','$Gender','$Correspondance','$Permanent','$Conatct','$Mobile','$Email','$Dob','$Group','$Doj','$category','$CollegeId','$college','1','$RecommendingAuth','$SenctionAuth');";
$insertEmployeeRun=sqlsrv_query($conntest,$insertEmployee);
if($insertEmployeeRun==true)
{



if($category=='6')
{
$LoginType="Staff";
$RightsLevel="Faculty";
}
else
{
    $LoginType="Staff";
    $RightsLevel="Staff";
}
$insert_record="INSERT into UserMaster(UserName,Password,LoginType,RightsLevel,ApplicationType,ApplicationName,CollegeName)values('$loginId','$loginId','$LoginType','$RightsLevel','Web','Campus','$college');";
$insert_record_run = sqlsrv_query($conntest, $insert_record);
if($insert_record_run==true)
{

    echo "1";
}
}
else
{
    echo "0";
}

}
elseif($code==200)
{


    $empid = $_POST['empid'];
    $LoginType = $_POST['LoginType'];
$check_role="SELECT * FROM user WHERE emp_id='$empid'";
$count_run=mysqli_query($conn,$check_role);
$count=mysqli_num_rows($count_run);
if($count>0)
{
$check_role="SELECT * FROM user WHERE emp_id='$empid'";
$role_check_run=mysqli_query($conn,$check_role);
if (mysqli_num_rows($role_check_run)>0)
 {
$insert="UPDATE user SET role_id='$LoginType' WHERE emp_id='$empid'";
$insert_run=mysqli_query($conn,$insert);
if ($insert_run)
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
else
{
    $sql1 = "SELECT Name,CollegeName,Department,Designation FROM Staff Where IDNo='$empid'";
    $q1 = sqlsrv_query($conntest, $sql1);
    if ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC))
     {
    $name = $row['Name'];
    $CollegeName = $row['CollegeName'];
    $Department = $row['Department'];
    $Designation = $row['Designation'];
    $insert="INSERT INTO `user` ( `emp_id`, `name`, `role_id`, `status`, `pass`, `u_permissions`, `college`, `department`, `designation`, `mobile`, `email`, `last_login_date`, `last_login_time`, `image`, `superwiser`, `superwiser_id`, `doj`, `dor`, `spass`, `on_off`)
    VALUES ( '$empid', '$name', $LoginType, 'Authorised', '12345678', '0', '$CollegeName', '$Department', '$Designation', '', '', '', '', '', '','', '', '', NULL, NULL);";
    mysqli_query($conn,$insert);
    $LoginType = $_POST['LoginType'];
    $check_role="SELECT * FROM user WHERE emp_id='$empid'";
    $role_check_run=mysqli_query($conn,$check_role);
    if (mysqli_num_rows($role_check_run)>0)
     {
    $insert="UPDATE user SET role_id='$LoginType' WHERE emp_id='$empid'";
    $insert_run=mysqli_query($conn,$insert);
    if ($insert_run)
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

}
}

elseif($code==201)
{
$empid = $_POST['empid'];
$LoginType = $_POST['LoginType'];
 $insert_record = "UPDATE  user SET role_id='$LoginType'  where  emp_id='$empid'";
$insert_record_run = mysqli_query($conn, $insert_record);
if ($insert_record_run==true) 
{
echo "1";
}
else
{
echo "0";
}
}

elseif($code==202)
{
$empid = $_POST['empid'];
$insert_record = "UPDATE   user SET role_id='0'  where  emp_id='$empid'";
$insert_record_run = mysqli_query($conn, $insert_record);
mysqli_query($conn,"DELETE from special_permission where emp_id='$empid'");
if ($insert_record_run==true) 
{
echo "1";
}
else
{
echo "0";
}
}

elseif($code==203)
{
    ?>


        <table class="table" style="font-size:;">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Employee</th>
                    <th>Apply Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Type</th>
                    <th>Count</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="height:1px" id="">
                <?php 
    $Sr=1;
    
    $getAllleaves="SELECT top 100 *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where Month(StartDate)=Month(CURRENT_TIMESTAMP) AND YEAR(StartDate)=YEAR(CURRENT_TIMESTAMP) order by  ApplyLeaveGKU.Id DESC "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    { 
        if($row['LeaveDurationsTime']!=0)
        {
            $LeaveDurationsTime=$row['LeaveDurationsTime'];
        }
        else
        {
            $LeaveDurationsTime=$row['LeaveDuration'];
        }

        if($row['Status']=='Approved')
        {
            $statusColor="success";
        }
        elseif($row['Status']=='Reject')
        {
            $statusColor="danger";
        }
        else
        {
            $statusColor="warning";
        }
?>
                <tr>
                    <td><?=$Sr;?></td>
                    <td><b>(<?=$row['StaffName'];?>) <?=$row['IDNo'];?></b></td>
                    <td widht="100"><?=$row['ApplyDate']->format('d-m-Y h:s A');?></td>
                    <td widht="100"><?=$row['StartDate']->format('d-m-Y');?></td>
                    <td><?=$row['EndDate']->format('d-m-Y');?></td>
                    <td><?=$row['LeaveTypeName'];?></td>
                    <td><?=$LeaveDurationsTime;?></td>
                    <td><?php echo substr($row['LeaveReason'], 0,50);?></td>
                    <td><b class="text-<?=$statusColor;?>"><?=$row['Status'];?></b></td>
                    <td>
                        <i class="fa fa-eye text-success fa-sm" data-toggle="modal" data-target="#ViewLeaveexampleModal"
                            data-whatever="@mdo" onclick="viewLeaveModal(<?=$row['LeaveID'];?>);"></i>
                        &nbsp;
                        <?php if($role_id=2) {?>
                        <i class="fa fa-trash text-danger fa-sm" onclick="deleteLeaveOne(<?=$row['LeaveID'];?>);"></i>
                        <?php }?>
                    </td>
                </tr>
                <?php

       
        $Sr++;
    }
    // print_r($aa);
    ?>
            </tbody>
        </table>
        <?php

}

elseif($code==204)
{
?> <table class="table" style="font-size:;">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Employee</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Type</th>
                    <th>Count</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="height:1px" id="">
                <?php 
    $emp_id=$_POST['empid'];
     $from=$_POST['from'];
      $month = date('m',strtotime($from));
      $year  = date('Y',strtotime($from));
    $Sr=1;
    
    if($from!='' && $emp_id!='' )
    {
        $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId where Month(StartDate)='$month' AND YEAR(StartDate)='$year'  and   Staff.IDNo='$emp_id' order by  ApplyLeaveGKU.Id DESC  ";
    }
    elseif($emp_id!='' && $from=='')
    {
        $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND  Staff.IDNo='$emp_id' order by ApplyLeaveGKU.Id DESC "; 
    }
    elseif($from!='' && $emp_id=='' )
{
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  Month(StartDate)='$month' AND YEAR(StartDate)='$year' order by  ApplyLeaveGKU.Id DESC  ";
}
else
{
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where Month(StartDate)=Month(CURRENT_TIMESTAMP) AND YEAR(StartDate)=YEAR(CURRENT_TIMESTAMP)  order by  ApplyLeaveGKU.Id DESC "; 
   
}

    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    {
        if($row['LeaveDurationsTime']!=0)
        {
            $LeaveDurationsTime=$row['LeaveDurationsTime'];
        }
        else
        {
            $LeaveDurationsTime=$row['LeaveDuration'];
        }
        if($row['Status']=='Approved')
        {
            $statusColor="success";
        }
        elseif($row['Status']=='Reject')
        {
            $statusColor="danger";
        }
        else
        {
            $statusColor="warning";
        }
?>
                <tr>
                    <td><?=$Sr;?></td>
                    <td><b>(<?=$row['StaffName'];?>)<?=$row['IDNo'];?></b></td>
                    <td widht="100"><?=$row['StartDate']->format('d-m-Y');?></td>
                    <td><?=$row['EndDate']->format('d-m-Y');?></td>
                    <td><?=$row['LeaveTypeName'];?></td>
                    <td><?=$LeaveDurationsTime;?></td>
                    <td><?php echo substr($row['LeaveReason'], 0,50);?></td>
                    <td><b class="text-<?=$statusColor;?>"><?=$row['Status'];?></b></td>
                    <td><i class="fa fa-eye text-success" data-toggle="modal" data-target="#ViewLeaveexampleModal"
                            data-whatever="@mdo" onclick="viewLeaveModal(<?=$row['LeaveID'];?>);"></i>
                        &nbsp;
                        <?php if($role_id=2 | $role_id=18) {?>
                        <i class="fa fa-trash text-danger fa-sm" onclick="deleteLeaveOne(<?=$row['LeaveID'];?>);"></i>
                        <?php }?>
                    </td>
                </tr>
                <?php




       
        $Sr++;
    }
    // print_r($aa);
    ?>
            </tbody>
        </table>
        <?php

}
elseif($code==205)
{
    
  
    $id=$_POST['id'];
       $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
   $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
   if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
   {
    $Emp_Image=$row['Snap'];
    $emp_pic=base64_encode($Emp_Image);
  
  
  
     $StartDate=$row['StartDate'];
    $EndDate=$row['EndDate'];
    $ApplyDate=$row['ApplyDate'];
   
       if($row['LeaveDurationsTime']!=0)
       {
           $LeaveDurationsTime=$row['LeaveDurationsTime'];
       }
       else
       {
           $LeaveDurationsTime=$row['LeaveDuration'];
       }
       if($row['Status']=='Approved')
       {
           $statusColor="success";
       }
       elseif($row['Status']=='Reject')
       {
           $statusColor="danger";
       }
       else
       {
           $statusColor="warning";
       }

      
?>
        <style>
        .leaveViewColor {
            color: black !important;
        }
        </style>
        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-<?=$statusColor;?>">
                <div class="widget-user-image">
                    <?PHP  echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image' style='border: radius 70% !important;width:100px;height:100px;'>"; ?>
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</h3>
                <h5 class="widget-user-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['Designation'];?></h5>
                <h5 class="widget-user-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['MobileNo'];?></h5>
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column" style="color:black;">


                    <div class="col-lg-12"><input type="hidden" id="LeaveID" class="form-control" value="<?=$id;?>"
                            readonly>
                    </div>
                    <!-- <div class="col-lg-12"><label>Employee</label><input type="text" class="form-control"
                    value="(<?=$row['StaffName'];?>)&nbsp;<?=$row['IDNo'];?>" readonly></div> -->
                    <div class="col-lg-12" widht="100"> <label>Start Date</label><input type="date" id="StartDate"
                            class="form-control"
                            value="<?php echo date("Y-m-d", strtotime($StartDate->format("Y-m-d")));?>">
                    </div>
                    <div class="col-lg-12"><label>End Date</label><input type="date" id="EndDate" class="form-control"
                            value="<?php echo date("Y-m-d", strtotime($EndDate->format("Y-m-d")));?>"></div>
                    <div class="col-lg-12"><label>End Date</label><input type="date" id="ApplyDate" class="form-control"
                            value="<?php echo date("Y-m-d", strtotime($ApplyDate->format("Y-m-d")));?>"></div>
                    <div class="col-lg-12">
                        <label>Leave Type</label>
                        <select class="form-control" id="LeaveType">
                            <option value="<?=$row['LeaveTypeId'];?>"><?=$row['LeaveTypeName'];?></option>
                            <?php 
$getLeaveTypes="SELECT * from LeaveTypes";
$getLeaveTypesRun=sqlsrv_query($conntest,$getLeaveTypes);
while($rowType=sqlsrv_fetch_array($getLeaveTypesRun))
{?>
                            <option value="<?=$rowType['Id'];?>"><?=$rowType['Name'];?></option>
                            <?php
 }
?>
                        </select>
                    </div>
                    <div class="col-lg-12"><label>Duration</label>
                        <?php 
if($row['Status']=='Approved')
{?>
                        <input type="text" class="form-control" id="LeaveDuration" value="<?=$LeaveDurationsTime;?>"
                            readonly>
                        <?php 
}
else
{?>
                        <select class="form-control" id="LeaveDuration">
                            <option value="<?=$LeaveDurationsTime;?>"><?=$LeaveDurationsTime;?></option>
                            <option value="0.25">0.25</option>
                            <option value="0.50">0.5</option>
                            <option value="0.75">0.75</option>
                            <option value="0">1</option>
                        </select>
                        <?php
 }
 ?>
                    </div>
                    <div class="col-lg-12"><label>Reason</label><textarea id="LeaveReason"
                            class="form-control"><?=$row['LeaveReason'];?></textarea></div>
                    <li class="nav-item">

                        <a href='#' class="nav-link leaveViewColor"> <label>Status</label><br><b
                                class="text-<?=$statusColor;?>"><?=$row['Status'];?></b>

                        </a>
                    </li>

                    <?php if($row['AuthorityId']==$row['SanctionId'] && $row['RecommendedRemarks']!='' && $row['SanctionRemarks']!=''){
                             ?>
                    <li class="nav-item">

                        <a href='#' class="nav-link leaveViewColor"> <b>Remarks
                                &nbsp;&nbsp;&nbsp;</b><?=$row['RecommendedRemarks'];   ?>&nbsp;<b>By
                                (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>) on
                                <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y H:i:s A');};?></b>
                        </a>
                    </li>
                    <?php if($row['HRRemarks']!='')
                {?>
                    <li class="nav-item">

                        <a href='#' class="nav-link leaveViewColor"> <b>Remarks By Vice Chancellor</b>
                            &nbsp;&nbsp;&nbsp;<?=$row['HRRemarks'];   ?>&nbsp;<b> on
                                <?php if($row['HRApprovedate']!=''){echo $row['HRApprovedate']->format('d-m-Y H:i:s A ');};?></b>
                        </a>
                    </li>
                    <?php }?>
                    <?php }
       else if( $row['AuthorityId']!=$row['SanctionId'] && $row['RecommendedRemarks']!='' && $row['SanctionRemarks']!='' )
        {?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b>Recommend Remarks </b>&nbsp;&nbsp;&nbsp;
                            &nbsp;<?=$row['SanctionRemarks'];  ?>&nbsp;<b> By
                                (<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>) on
                                <?php if($row['SanctionApproveDate']!=''){echo $row['SanctionApproveDate']->format('d-m-Y H:i:s A');};?></b>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor">
                            <b> Sanction Remarks &nbsp;&nbsp;&nbsp;</b>
                            <?=$row['RecommendedRemarks'];   ?> &nbsp; <b>By
                                (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>) on
                                <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y H:i:s A');};?></b>
                            </b></a>
                    </li>
                    <?php if($row['HRRemarks']!='')
                {?>
                    <li class="nav-item">

                        <a href='#' class="nav-link leaveViewColor"> <b>Remarks By Vice Chancellor</b>
                            &nbsp;&nbsp;&nbsp;<?=$row['HRRemarks'];   ?>&nbsp;<b> on
                                <?php if($row['HRApprovedate']!=''){echo $row['HRApprovedate']->format('d-m-Y H:i:s A');};?>
                        </a>
                    </li>
                    <?php }?>
                    <?php }
                               else if($row['SanctionRemarks']!='' && $row['RecommendedRemarks']==''){
                                ?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b>Recommend Remarks </b>&nbsp;&nbsp;&nbsp;
                            &nbsp;<?=$row['SanctionRemarks'];  ?>&nbsp;<b> By
                                (<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>) on
                                <?php if($row['SanctionApproveDate']!=''){echo $row['SanctionApproveDate']->format('d-m-Y H:i:s A');};?></b>
                        </a>
                    </li><?php 
                                                }
                              

                                                if($row['SanctionId']==$row['AuthorityId'])
                                                {
                                                    $checkIfleavepending="SELECT * FROM ApplyLeaveGKU Where  Id='$id' and SanctionRemarks!=''";
                                                    $checkIfleavependingRun=sqlsrv_query($conntest,$checkIfleavepending);
                                                        if($rowcheckIfleavependingRun=sqlsrv_fetch_array($checkIfleavependingRun,SQLSRV_FETCH_ASSOC))
                                                        {
                                                            if($rowcheckIfleavependingRun['Status']=='Reject')
                                                                {?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b> Authority </b>
                            &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-times fa-lg text-danger' aria-hidden='true'></i></b>
                        </a>
                    </li>
                    <?php }else
                                                                {
     
                                                            ?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b> Authority </b>
                            &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-check fa-lg text-success' aria-hidden='true'></i></b>
                        </a>
                    </li><?php 
                                                        }
                                                    }
                                                        else
                                                        { ?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b> Authority </b>
                            &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-hourglass-start fa-lg text-danger' aria-hidden='true'></i></b>
                        </a>
                    </li><?php 
    
                                                        }

                                                }
                                                else
                                                {
                                                $checkIfleavepending="SELECT * FROM ApplyLeaveGKU Where  Id='$id' and SanctionRemarks!=''";
                                                $checkIfleavependingRun=sqlsrv_query($conntest,$checkIfleavepending);
                                                    if($rowcheckIfleavependingRun=sqlsrv_fetch_array($checkIfleavependingRun,SQLSRV_FETCH_ASSOC))
                                                    {
                                                        if($rowcheckIfleavependingRun['Status']=='Reject')
                                                            {?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b>Sanction Authority </b>
                            &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-times fa-lg text-danger' aria-hidden='true'></i></b>
                        </a>
                    </li>
                    <?php }else
                                                            {
 
                                                        ?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b>Recommended Authority </b>
                            &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-check fa-lg text-success' aria-hidden='true'></i></b>
                        </a>
                    </li><?php 
                                                    }
                                                }
                                                    else
                                                    { ?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b>Recommended Authority </b>
                            &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-hourglass-start fa-lg text-danger' aria-hidden='true'></i></b>
                        </a>
                    </li><?php 

                                                    }
                                                    $checkIfleavepending1="SELECT * FROM ApplyLeaveGKU Where  Id='$id' and RecommendedRemarks!=''";
                                                    $checkIfleavepending1Run=sqlsrv_query($conntest,$checkIfleavepending1);
                                                        if($rowcheckIfleavepending1Run=sqlsrv_fetch_array($checkIfleavepending1Run,SQLSRV_FETCH_ASSOC))
                                                        {
                                                            if($rowcheckIfleavepending1Run['Status']=='Reject')
                                                            {?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b>Sanction Authority </b>
                            &nbsp;(<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-times fa-lg text-danger' aria-hidden='true'></i></b>
                        </a>
                    </li>
                    <?php }else
                                                            {

                                                            ?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b>Sanction Authority </b>
                            &nbsp;(<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-check fa-lg text-success' aria-hidden='true'></i></b>
                        </a>
                    </li><?php 
                                                        }
                                                        }
                                                        else
                                                        { ?>
                    <li class="nav-item">
                        <a href='#' class="nav-link leaveViewColor"> <b>Sanction Authority </b>
                            &nbsp;(<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                class='fa fa-hourglass-start fa-lg text-danger' aria-hidden='true'></i></b>
                        </a>
                    </li><?php 
    
                                                        }
                                                    }
                                                
                                                       
                ?>

                    <?php }



}
elseif($code==206)
{
    $LeaveID=$_POST['LeaveID'];
    $StartDate=$_POST['StartDate'];
    $EndDate=$_POST['EndDate'];
    $ApplyDate=$_POST['ApplyDate'];
    $LeaveType=$_POST['LeaveType'];
    $LeaveDuration=$_POST['LeaveDuration'];
    $LeaveReason=$_POST['LeaveReason']; 
         $LeaveUpdate="UPDATE ApplyLeaveGKU SET LeaveTypeId='$LeaveType', StartDate='$StartDate',EndDate='$EndDate',LeaveReason='$LeaveReason',LeaveDurationsTime='$LeaveDuration',ApplyDate='$ApplyDate' Where Id='$LeaveID' ";
        $LeaveUpdateRun=sqlsrv_query($conntest,$LeaveUpdate);
        if($LeaveUpdateRun==true)
        {
           echo "1";
        }
        else
        {
           echo "0";
        }
    }
 elseif ($code==207) {
    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Employee</th>
                                <th>Casual</th>
                                <th>Compansatory Off</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
        $Sr=1;

        $getAllLeaves = "SELECT top 50 * FROM Staff INNER JOIN LeaveBalances ON LeaveBalances.Employee_Id = Staff.IDNo ";
        $getAllLeavesRun = sqlsrv_query($conntest, $getAllLeaves);
        $employeeData = [];
        while ($row = sqlsrv_fetch_array($getAllLeavesRun, SQLSRV_FETCH_ASSOC)) {
            $employeeId = $row['IDNo'];
            if (!isset($employeeData[$employeeId])) {
                $employeeData[$employeeId] = [
                    'Name' => $row['Name'],
                    'Leave1' => 0,
                    'Leave2' => 0,
                    'IDNo' => $row['IDNo'],
                ];
            }
            if ($row['LeaveType_Id'] == '1') {
                $employeeData[$employeeId]['Leave1'] = $row['Balance'];
            } elseif ($row['LeaveType_Id'] == '2') {
                $employeeData[$employeeId]['Leave2'] = $row['Balance'];
            }
        }
        
        foreach ($employeeData as $employeeId => $data) {
            ?>
                            <tr>
                                <td><?= $Sr; ?></td>
                                <td><b>(<?= $data['Name']; ?>)<?= $data['IDNo']; ?></b></td>
                                <td class="editable" data-field="Leave1"><?= $data['Leave1']; ?></td>
                                <td class="editable" data-field="Leave2"><?= $data['Leave2']; ?></td>
                                <td>
                                    <div class="controls">
                                        <button type="button" class="edit-btn btn btn-primary btn-sm"
                                            onclick="editRow(this)"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="save-btn btn btn-success  btn-sm"
                                            onclick="saveRow(this,<?= $data['IDNo']; ?>)" style="display: none;"><i
                                                class="fa fa-check"></i></button>
                                        <button type="button" class="cancel-btn btn btn-danger  btn-sm"
                                            onclick="cancelEdit(this)" style="display: none;"><i class="fa fa-times">
                                            </i> </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
            $Sr++;
        }
     ?>
                        </tbody>
                    </table>
                    <?php
 
 }

 elseif($code==208)
 {
    ?>
                    <table class="table" style="font-size:;">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Employee</th>
                                <th>Casual</th>
                                <th>Compansatory Off</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
       $emp_id = $_POST['empid'];
       $Sr = 1;
       if (!empty($emp_id)) {
           $getAllLeaves = "SELECT * FROM Staff INNER JOIN LeaveBalances ON LeaveBalances.Employee_Id = Staff.IDNo WHERE Staff.IDNo = '$emp_id'";
       } else {
           $getAllLeaves = "SELECT * FROM Staff INNER JOIN LeaveBalances ON LeaveBalances.Employee_Id = Staff.IDNo";
       }
       $getAllLeavesRun = sqlsrv_query($conntest, $getAllLeaves);
       $employeeData = [];
       while ($row = sqlsrv_fetch_array($getAllLeavesRun, SQLSRV_FETCH_ASSOC)) {
           $employeeId = $row['IDNo'];
       
           if (!isset($employeeData[$employeeId])) {
               $employeeData[$employeeId] = [
                   'Name' => $row['Name'],
                   'Leave1' => 0,
                   'Leave2' => 0,
                   'IDNo' => $row['IDNo'],
               ];
           }
           if ($row['LeaveType_Id'] == '1') {
               $employeeData[$employeeId]['Leave1'] = $row['Balance'];
           } elseif ($row['LeaveType_Id'] == '2') {
               $employeeData[$employeeId]['Leave2'] = $row['Balance'];
           }
           else
{
    $employeeData[$employeeId]['Leave2'] = '0';
    $employeeData[$employeeId]['Leave1'] = "0";
}
       }
       
       foreach ($employeeData as $employeeId => $data) {
           ?>
                            <tr>
                                <td><?= $Sr; ?></td>
                                <td><b>(<?= $data['Name']; ?>)<?= $data['IDNo']; ?></b></td>
                                <td class="editable" data-field="Leave1"><?= $data['Leave1']; ?></td>
                                <td class="editable" data-field="Leave2"><?= $data['Leave2']; ?></td>
                                <td>
                                    <div class="controls">
                                        <button type="button" class="edit-btn btn btn-primary  btn-sm"
                                            onclick="editRow(this)"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="save-btn btn btn-success  btn-sm"
                                            onclick="saveRow(this,<?= $data['IDNo']; ?>)" style="display: none;"><i
                                                class="fa fa-check"></i></button>
                                        <button type="button" class="cancel-btn btn btn-danger  btn-sm"
                                            onclick="cancelEdit(this)" style="display: none;"><i class="fa fa-times">
                                            </i> </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
           $Sr++;
       }
     ?>
                        </tbody>
                    </table>
                    <?php
 
 }
 elseif($code==209)
 {

$employeeId=$_POST['employeeId'];
$leave1=$_POST['leave1'];
$leave2=$_POST['leave2'];
$checkLeaveBlacne="SELECT * FROM LeaveBalances WHERE Employee_Id='$employeeId' and LeaveType_Id='2' ";
 $existrow=sqlsrv_query($conntest,$checkLeaveBlacne,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$countblacne=sqlsrv_num_rows($existrow);
if($countblacne>0)
{
$updateLeaveBalance="UPDATE LeaveBalances SET  Balance='$leave2'WHERE Employee_Id='$employeeId' and LeaveType_Id='2' ";
sqlsrv_query($conntest,$updateLeaveBalance);
}
else
{
    $updateLeaveBalance="INSERT INTO LeaveBalances(Employee_Id,Balance,LeaveType_Id)values('$employeeId','$leave2','2') ";
sqlsrv_query($conntest,$updateLeaveBalance);
}

$checkLeaveBlacne1="SELECT * FROM LeaveBalances WHERE Employee_Id='$employeeId' and LeaveType_Id='1' ";
$existrow1=sqlsrv_query($conntest,$checkLeaveBlacne1,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$countblacne1=sqlsrv_num_rows($existrow1);
if($countblacne1>0)
{
    $updateLeaveBalance1="UPDATE LeaveBalances SET  Balance='$leave1'WHERE Employee_Id='$employeeId' and LeaveType_Id='1' ";
sqlsrv_query($conntest,$updateLeaveBalance1);
}
else
{
   $updateLeaveBalance1="INSERT INTO LeaveBalances(Employee_Id,Balance,LeaveType_Id)values('$employeeId','$leave1','1') ";
sqlsrv_query($conntest,$updateLeaveBalance1);


}
 }
elseif($code==210)
{
    ?>

                    <form action="export.php" method="post">
                        <input type="hidden" name="exportCode" value='31' class="form-control ">
                        <div class="row">


                            <div class="col-lg-2">
                                <label>Emp ID</label>
                                <input type="text" name="EmployeeId" id="employeeId_" class="form-control "
                                    placeholder="Emp ID">
                            </div>
                            <div class="col-lg-2">
                                <label>Month</label>
                                <select name="month" id="month" class="form-control ">
                                    <option value="" style="display:none;">MM</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>

                            </div>
                            <div class="col-lg-2">
                                <label>Year</label>
                                <select name="year" id="year" class="form-control ">
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>

                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label>Action</label><br>
                                <input type="button" onclick="showEmpReport();" class="btn btn-primary " value="Show">

                                <input type="submit" class="btn btn-success " value="Download">
                            </div>

                    </form>

            </div>

            <?php 
}

elseif($code==211)
{
    ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group ">
                        <input type="search" class="form-control" name="emp_name" id="empid" placeholder="Emp ID Here">
                        <div class="input-group-append">
                            <button type="button" onclick="" class="btn btn-success btn-sm">
                                <i class="fa fa-search"></i>
                            </button>

                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <?php 
}
elseif($code==212)
{
    ?>

            <div class="row">

                <div class="col-lg-3">
                    <label>Date</label>
                    <input type="date" class="form-control" id="holidayDate">
                </div>
                <div class="col-lg-3">
                    <label>Holiday Name </label>
                    <input type="text" class="form-control" id="holidayName">
                </div>
                <div class="col-lg-3">
                    <label> Discription</label>
                    <input type="text" class="form-control" id="holidayDiscription">
                </div>
                <div class="col-lg-3">
                    <label>Action</label><br>
                    <button type="button" onclick="addHolidayMark();" class="btn btn-success ">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>



            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Discription</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
        $Sr=1;
    $insertHoliday="SELECT * FROM Holidays order by  Id DESC    ";
    $insertHolidayRun=sqlsrv_query($conntest,$insertHoliday);
   while($row=sqlsrv_fetch_array($insertHolidayRun))
   {?>
                        <tr>
                            <td><?= $Sr; ?></td>
                            <td class="editable " data-field="HolidayDate"><?= $row['HolidayDate']->format('Y-m-d'); ?>
                            </td>
                            <td class="editable" data-field="HolidayName"><?= $row['HolidayName']; ?></td>
                            <td class="editable" data-field="Description"><?= $row['Description']; ?></td>
                            <td>
                                <div class="controls">
                                    <button type="button" class="edit-btn btn btn-primary  btn-sm"
                                        onclick="editRow(this)"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="save-btn btn btn-success  btn-sm"
                                        onclick="saveRow(this,<?= $row['Id']; ?>)" style="display: none;"><i
                                            class="fa fa-check"></i></button>
                                    <button type="button" class="cancel-btn btn btn-danger  btn-sm"
                                        onclick="cancelEdit(this)" style="display: none;"><i class="fa fa-times"> </i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteHoliday(<?=$row['Id'];?>);"><i
                                            class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php
   $Sr++;
}
?>
                    <tbody>
                </table>
            </div>
        </div>
        <?php 
}
elseif($code==213)
{
    $holidayDate=$_POST['holidayDate'];
    $holidayName=$_POST['holidayName'];
    $holidayDiscription=$_POST['holidayDiscription'];
    $insertHoliday="INSERT into  Holidays (HolidayName,HolidayDate,Description,UpdatedBy)values('$holidayName','$holidayDate','$holidayDiscription','$EmployeeID')";
    $insertHolidayRun=sqlsrv_query($conntest,$insertHoliday);
    if($insertHolidayRun==true)
      {
        echo "1";
      }
}
elseif($code==214)
{
    $id=$_POST['id'];
    $holidayDate=$_POST['holidayDate'];
    $holidayName=$_POST['holidayName'];
    $description=$_POST['description'];
    $insertHoliday="UPDATE  Holidays SET  HolidayName='$holidayName',HolidayDate='$holidayDate',Description='$description' WHERE Id='$id'";
    $insertHolidayRun=sqlsrv_query($conntest,$insertHoliday);
    if($insertHolidayRun==true)
      {
        echo "1";
      }

}
elseif($code==215)
{
    $id=$_POST['id'];
   
    $insertHoliday="DELETE FROM Holidays  WHERE Id='$id'";
    $insertHolidayRun=sqlsrv_query($conntest,$insertHoliday);
    if($insertHolidayRun==true)
      {
        echo "1";
      }

}
elseif($code==216)
{

     $sql_dates="SELECT DISTINCT CAST(LogDateTime as DATE) as mydate
    from DeviceLogsAll  where LogDateTime Between '2023-09-12 00:00:00.000'  AND 
   '2023-09-26 23:59:00.000'";
   
   $stmt = sqlsrv_query($conntest,$sql_dates);  
               while($row_dates = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
               {
       $data[]=$row_dates['mydate'];
               }
     echo json_encode($data);

}
elseif($code==217)
{
?>
        <table class="table " id="example">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Apply Date</th>
                    <th>Type</th>
                    <th>Count</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="height:1px" id="">
                <?php 
    $Sr=1;
    
    $getAllleaves="SELECT top 100 *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND Staff.IDNo='$EmployeeID' and ApplyLeaveGKU.Status!='Approved' and ApplyLeaveGKU.Status!='Reject' order by  ApplyLeaveGKU.Id DESC "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    { 
      

        if($row['Status']=='Approved')
        {
            $statusColor="success";
        }
        elseif($row['Status']=='Reject')
        {
            $statusColor="danger";
        }
        else
        {
            $statusColor="warning";
        }
?>
                <tr>
                    <td><?=$Sr;?></td>
                    <td widht="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?></td>
                    <td><?=$row['LeaveTypeName'];?></td>
                    <td><?php   if($row['LeaveDurationsTime']!=0)
        {
          echo   $LeaveDurationsTime=$row['LeaveDurationsTime'];
        }
        else
        {
           echo  $LeaveDurationsTime=$row['LeaveDuration'];
        }?></td>
                    <td><b class="text-<?=$statusColor;?>"><?=$row['Status'];?></b></td>
                    <td>
                        <div class="controls">
                            <button type="button" onclick="deleteLeave(<?=$row['LeaveID'];?>);"
                                class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            <button type="button" data-toggle="modal" data-target="#ViewLeaveexampleModal"
                                data-whatever="@mdo" onclick="viewLeaveModal(<?=$row['LeaveID'];?>);"
                                class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button>

                        </div>


                    </td>
                </tr>
                <?php

       
        $Sr++;
        // $aa[]=$row;
    }
    // print_r($aa);
    ?>
            </tbody>
        </table><?php 
}
elseif($code==218)
{
?>
        <table class="table" id="example">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Apply Date</th>
                    <th>Type</th>
                    <th>Count</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
    $Sr=1;
    
    $getAllleaves="SELECT top 100 *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND Staff.IDNo='$EmployeeID' and ApplyLeaveGKU.Status='Approved' order by  ApplyLeaveGKU.Id DESC "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    { 
        if($row['LeaveDurationsTime']!=0)
        {
            $LeaveDurationsTime=$row['LeaveDurationsTime'];
        }
        else
        {
            $LeaveDurationsTime=$row['LeaveDuration'];
        }

        if($row['Status']=='Approved')
        {
            $statusColor="success";
        }
        elseif($row['Status']=='Reject')
        {
            $statusColor="danger";
        }
        else
        {
            $statusColor="warning";
        }
?>
                <tr>
                    <td><?=$Sr;?></td>
                    <td widht="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?></td>
                    <td><?=$row['LeaveTypeName'];?></td>
                    <td><?=$LeaveDurationsTime;?></td>
                    <td><b class="text-<?=$statusColor;?>"><?=$row['Status'];?></b></td>
                    <td> <button type="button" data-toggle="modal" data-target="#ViewLeaveexampleModal"
                            data-whatever="@mdo" onclick="viewLeaveModal(<?=$row['LeaveID'];?>);"
                            class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button></td>
                </tr>
                <?php

       
        $Sr++;
        // $aa[]=$row;
    }
    // print_r($aa);
    ?>
            </tbody>
        </table><?php 
}
elseif($code==219)
{
    ?>
        <table class="table" id="example">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Apply Date</th>
                    <th>Type</th>
                    <th>Count</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
        $Sr=1;
        
        $getAllleaves="SELECT top 100 *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND Staff.IDNo='$EmployeeID' and ApplyLeaveGKU.Status='Reject' order by  ApplyLeaveGKU.Id DESC "; 
        $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
        while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
        { 
            if($row['LeaveDurationsTime']!=0)
            {
                $LeaveDurationsTime=$row['LeaveDurationsTime'];
            }
            else
            {
                $LeaveDurationsTime=$row['LeaveDuration'];
            }
    
            if($row['Status']=='Approved')
            {
                $statusColor="success";
            }
            elseif($row['Status']=='Reject')
            {
                $statusColor="danger";
            }
            else
            {
                $statusColor="warning";
            }
    ?>
                <tr>
                    <td><?=$Sr;?></td>
                    <td widht="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?></td>
                    <td><?=$row['LeaveTypeName'];?></td>
                    <td><?=$LeaveDurationsTime;?></td>
                    <td><b class="text-<?=$statusColor;?>"><?=$row['Status'];?></b></td>
                    <td> <button type="button" data-toggle="modal" data-target="#ViewLeaveexampleModal"
                            data-whatever="@mdo" onclick="viewLeaveModal(<?=$row['LeaveID'];?>);"
                            class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button></td>
                </tr>
                <?php
    
           
            $Sr++;
        }
        ?>
            </tbody>
        </table><?php 
}
elseif ($code==220) {

    $id=$_POST['id'];
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
$getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
{

  $StartDate=$row['StartDate'];
 $EndDate=$row['EndDate'];
 $ApplyDate=$row['ApplyDate'];

    if($row['LeaveDurationsTime']!=0)
    {
        $LeaveDurationsTime=$row['LeaveDurationsTime'];
    }
    else
    {
        $LeaveDurationsTime=$row['LeaveDuration'];
    }
    if($row['Status']=='Approved')
    {
        $statusColor="success";
    }
    elseif($row['Status']=='Reject')
    {
        $statusColor="danger";
    }
    else
    {
        $statusColor="warning";
    }

    $Emp_Image=$row['Snap'];
    $emp_pic=base64_encode($Emp_Image);
  
   
                  
?>

        <style>
        .leaveViewColor {
            color: black !important;
        }
        </style>

        <!-- Widget: user widget style 2 -->
        <div class="card card-widget widget-user-2">
            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-<?=$statusColor;?>">
                    <div class="widget-user-image">
                        <?PHP  echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image' style='border: radius 70% !important;width:100px;height:100px;'>"; ?>
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</h3>
                    <h5 class="widget-user-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['Designation'];?></h5>
                    <h5 class="widget-user-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['MobileNo'];?></h5>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column" style="color:black;">
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b>Leave Type &nbsp;&nbsp;&nbsp;</b><?=$row['LeaveTypeName'];?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b> Start Date
                                    &nbsp;&nbsp;&nbsp;</b><?php echo date("d-m-Y", strtotime($StartDate->format("Y-m-d")));?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b>End Date
                                    &nbsp;&nbsp;&nbsp;</b><?php echo date("d-m-Y", strtotime($EndDate->format("Y-m-d"))); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b> Apply Date
                                    &nbsp;&nbsp;&nbsp;</b><?php echo date("Y-m-d h:i:s A", strtotime($ApplyDate->format("d-m-Y h:s A")));?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b>Duration &nbsp;&nbsp;&nbsp;</b><?=$LeaveDurationsTime;?>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href='http://gurukashiuniversity.co.in/data-server/LeaveFileAttachment/<?=$row['FilePath'];?>'
                                target='_blank' class="nav-link leaveViewColor">
                                <b> View Adjustment File</b> &nbsp;&nbsp;&nbsp;<i
                                    class="fa fa-eye fa-lg text-success"></i>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor">
                                <b> Reason&nbsp;&nbsp;&nbsp; </b> <?=$row['LeaveReason'];?>
                            </a>
                        </li>

                        <?php if($row['AuthorityId']==$row['SanctionId'] && $row['SanctionRemarks']!='' && $row['RecommendedRemarks']!='' ){ ?>
                        <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor"> <b>Remarks
                                    &nbsp;&nbsp;&nbsp;</b><?=$row['RecommendedRemarks'];   ?>&nbsp;<b>By
<<<<<<< HEAD
                                    (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>) On
                                    <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y h:s A');};?></b>
=======
                                    (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)
                                    On
                                    <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y H:i:s A');};?></b>
>>>>>>> fe97a0966a84946ac6a418d910ab6df6cd4ea450
                            </a>
                        </li>
                        <?php if($row['HRRemarks']!='')
                {?>
                        <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor"> <b>Remarks By Vice Chancellor</b>
                                &nbsp;&nbsp;&nbsp;<?=$row['HRRemarks'];?>&nbsp;<b> On
                                    <?php if($row['HRApprovedate']!=''){echo $row['HRApprovedate']->format('d-m-Y h:s A');};?></b>
                            </a>
                        </li>
                        <?php }?>
                        <?php }

if($row['SanctionRemarks']!='' && $row['AuthorityId']!=$row['SanctionId'])
{
    ?> <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor"> <b>Recommend Remarks </b>&nbsp;&nbsp;&nbsp;
<<<<<<< HEAD
                                &nbsp;<?=$row['SanctionRemarks'];  ?>&nbsp;<b> By (<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>) On
                                    <?php if($row['SanctionApproveDate']!=''){echo $row['SanctionApproveDate']->format('d-m-Y h:s A');};?></b>
=======
                                &nbsp;<?=$row['SanctionRemarks'];  ?>&nbsp;<b> By
                                    (<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)
                                    On
                                    <?php if($row['SanctionApproveDate']!=''){echo $row['SanctionApproveDate']->format('d-m-Y H:i:s A');};?></b>
>>>>>>> fe97a0966a84946ac6a418d910ab6df6cd4ea450
                            </a>
                        </li><?php 
                    }

       if($row['RecommendedRemarks']!='' && $row['AuthorityId']!=$row['SanctionId'])
        {?>

                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor">
                                <b> Sanction Remarks &nbsp;&nbsp;&nbsp;</b>
<<<<<<< HEAD
                                <?=$row['RecommendedRemarks'];   ?> &nbsp; <b>By (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>) On
                                    <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y h:s A');};?></b>
=======
                                <?=$row['RecommendedRemarks'];   ?> &nbsp; <b>By
                                    (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)
                                    On
                                    <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y H:i:s A');};?></b>
>>>>>>> fe97a0966a84946ac6a418d910ab6df6cd4ea450
                                </b></a>
                        </li>
                        <?php if($row['HRRemarks']!='')
                {?>
                        <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor"> <b> Remarks By Vice Chancellor
                                    &nbsp;&nbsp;&nbsp;</b><?=$row['HRRemarks'];   ?>&nbsp;<b> On
                                    <?php if($row['HRApprovedate']!=''){echo $row['HRApprovedate']->format('d-m-Y h:s A');};?></b>
                            </a>
                        </li>
                        <?php }?>


                        <?php }
   

if($row['SanctionId']==$row['AuthorityId'])
{
    $checkIfleavepending="SELECT * FROM ApplyLeaveGKU Where  Id='$id' and SanctionRemarks!=''";
    $checkIfleavependingRun=sqlsrv_query($conntest,$checkIfleavepending);
        if($rowcheckIfleavependingRun=sqlsrv_fetch_array($checkIfleavependingRun,SQLSRV_FETCH_ASSOC))
        {
            if($rowcheckIfleavependingRun['Status']=='Reject')
                {?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b> Authority </b>
                                &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-times fa-lg text-danger' aria-hidden='true'></i></b>
                            </a>
                        </li>
                        <?php }else
                {

            ?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b> Authority </b>
                                &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-check fa-lg text-success' aria-hidden='true'></i></b>
                            </a>
                        </li><?php 
        }
    }
        else
        { ?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b> Authority </b>
                                &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-hourglass-start fa-lg text-danger' aria-hidden='true'></i></b>
                            </a>
                        </li><?php 

        }

}
else
{
$checkIfleavepending="SELECT * FROM ApplyLeaveGKU Where  Id='$id' and SanctionRemarks!=''";
$checkIfleavependingRun=sqlsrv_query($conntest,$checkIfleavepending);
    if($rowcheckIfleavependingRun=sqlsrv_fetch_array($checkIfleavependingRun,SQLSRV_FETCH_ASSOC))
    {
        if($rowcheckIfleavependingRun['Status']=='Reject')
            {?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b>Recommended Authority </b>
                                &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-times fa-lg text-danger' aria-hidden='true'></i></b>
                            </a>
                        </li>
                        <?php }else
            {

        ?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b>Recommended Authority </b>
                                &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-check fa-lg text-success' aria-hidden='true'></i></b>
                            </a>
                        </li><?php 
    }
}
    else
    { ?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b>Recommended Authority </b>
                                &nbsp;(<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-hourglass-start fa-lg text-danger' aria-hidden='true'></i></b>
                            </a>
                        </li><?php 

    }
    $checkIfleavepending1="SELECT * FROM ApplyLeaveGKU Where  Id='$id' and RecommendedRemarks!=''";
    $checkIfleavepending1Run=sqlsrv_query($conntest,$checkIfleavepending1);
        if($rowcheckIfleavepending1Run=sqlsrv_fetch_array($checkIfleavepending1Run,SQLSRV_FETCH_ASSOC))
        {
            if($rowcheckIfleavepending1Run['Status']=='Reject')
            {?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b>Sanction Authority </b>
                                &nbsp;(<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-times fa-lg text-danger' aria-hidden='true'></i></b>
                            </a>
                        </li>
                        <?php }else
            {

            ?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b>Sanction Authority </b>
                                &nbsp;(<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-check fa-lg text-success' aria-hidden='true'></i></b>
                            </a>
                        </li><?php 
        }
        }
        else
        { ?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b>Sanction Authority </b>
                                &nbsp;(<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class='fa fa-hourglass-start fa-lg text-danger' aria-hidden='true'></i></b>
                            </a>
                        </li><?php 

        }
    }
?> <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor">
                                <b> Status &nbsp;&nbsp;&nbsp;</b>
                                <?php 
if($row['Status']=='Approved') {
$statusColor="success";
echo "<b class='text-".$statusColor."'>".$row['Status']."&nbsp;&nbsp;&nbsp;<i class='fa fa-check fa-lg' aria-hidden='true'></i></b>";

}
elseif($row['Status']=='Reject') {
$statusColor="danger";
echo "<b class='text-".$statusColor."'>".$row['Status']."&nbsp;&nbsp;&nbsp;<i class='fa fa-times fa-lg' aria-hidden='true'></i></b>";
}
elseif($row['Status']=='Pending to VC') {
$statusColor="info";
echo "<b class='text-".$statusColor."'>".$row['Status']."&nbsp;&nbsp;&nbsp;<i class='fa fa-share' aria-hidden='true'></i></b>";
}
else {
$statusColor="primary";
echo "<b class='text-".$statusColor."'>".$row['Status']."&nbsp;&nbsp;&nbsp;<i class='fa fa-hourglass-start fa-lg' aria-hidden='true'></i></b>";
}
?></b>
                                </b></a>
                        </li>
                    </ul>
                </div>
            </div>

            <?php 
}
}
elseif($code==221)
{
    $id=$_POST['id'];
   
    $insertHoliday="DELETE FROM ApplyLeaveGKU  WHERE Id='$id' and StaffId='$EmployeeID'";
    $insertHolidayRun=sqlsrv_query($conntest,$insertHoliday);
    if($insertHolidayRun==true)
      {
        echo "1";
      }

}
elseif($code==222)
{
   ?>



            <div class="card-body ">
                <div class="stepwizard col-md-offset-3">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-success btn-circle"
                                style='width:30px;height:30px;'></a>

                            <p><b>You</b></p>
                        </div>
                        <?php 
if($Recommend==$Authority)
{
    $getUserDetailsRecomend="SELECT Name,Snap FROM Staff Where IDNo='$Recommend'";
    $getUserDetailsRecomendRun=sqlsrv_query($conntest,$getUserDetailsRecomend);
    if($getUserDetailsRecomendRow=sqlsrv_fetch_array($getUserDetailsRecomendRun,SQLSRV_FETCH_ASSOC))
    {
        $Emp_ImageRecomend=$getUserDetailsRecomendRow['Snap'];
        $emp_picRecomend=base64_encode($Emp_ImageRecomend);              
        ?>
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button"
                                class="btn btn-primary btn-circle"><?php echo  "<img class='btn-circle' src='data:image/jpeg;base64,".$emp_picRecomend."' alt='message user image' style=''>";?></a>
                            <p><?=$getUserDetailsRecomendRow['Name'];?><b>&nbsp;( Authority)</b></p>
                        </div>
                        <?php }
      else
      {?>
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle"><img class='btn-circle'
                                    src="dist/img/crose.png"></a>
                            <p>Please Update Leave Authority</p>
                        </div><?php
        
      }
}
else
{
    $getUserDetailsRecomend="SELECT Name,Snap FROM Staff Where IDNo='$Recommend'";
    $getUserDetailsRecomendRun=sqlsrv_query($conntest,$getUserDetailsRecomend);
    if($getUserDetailsRecomendRow=sqlsrv_fetch_array($getUserDetailsRecomendRun,SQLSRV_FETCH_ASSOC))
    {
        $Emp_ImageRecomend=$getUserDetailsRecomendRow['Snap'];
        $emp_picRecomend=base64_encode($Emp_ImageRecomend);              
        ?>
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button"
                                class="btn btn-primary btn-circle"><?php echo  "<img class='btn-circle' src='data:image/jpeg;base64,".$emp_picRecomend."' alt='message user image' style=''>";?></a>
                            <p><?=$getUserDetailsRecomendRow['Name'];?></p>
                            <!-- <b>&nbsp;(Recommending Authority)</b -->
                        </div>
                        <?php }
      else
      {?>
                        <div class="stepwizard-step">
                            <a href="#step-1" type="button" class="btn btn-primary btn-circle"><img class='btn-circle'
                                    src="dist/img/crose.png"></a>
                            <p>Please Update Leave Recommending Authority</p>
                        </div><?php
        
      }?>
                        <?php 
    $getUserDetailsAuthority="SELECT Name,Snap FROM Staff Where IDNo='$Authority'";
    $getUserDetailsAuthorityRun=sqlsrv_query($conntest,$getUserDetailsAuthority);
    if($getUserDetailsAuthorityRow=sqlsrv_fetch_array($getUserDetailsAuthorityRun,SQLSRV_FETCH_ASSOC))
    {
        $Emp_ImageAuthority=$getUserDetailsAuthorityRow['Snap'];
        $emp_picAuthority=base64_encode($Emp_ImageAuthority);     
        ?>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button"
                                class="btn btn-primary btn-circle"><?php echo  "<img class='btn-circle' src='data:image/jpeg;base64,".$emp_picAuthority."' alt='message user image' style=''>";?></a>
                            <p><?=$getUserDetailsAuthorityRow['Name'];?></p>
                            <!-- <b>&nbsp;(Sanction Authority)</b> -->
                        </div>
                        <?php }
      else
      {?>
                        <div class="stepwizard-step">
                            <a href="#step-2" type="button" class="btn btn-primary btn-circle"><img class='btn-circle'
                                    src="dist/img/crose.png"></a>
                            <p>Please Update Leave Sanction Authority</p>
                        </div><?php
        
      }
      
    }?>


                    </div>
                </div>
                <?php 
if($Recommend!='0' && $Authority!='0' && $Recommend!=NULL && $Authority!=NULL)
{
?>

                <div class="card-header " style="height:auto;">
                    <center><Strong>Apply Leave Online</Strong></center>

                </div>
                <br>
                <form action="action_g.php" method="post">
                    <div class="row">

                        <input type="hidden" name="EmpID" value="<?=$EmployeeID;?>">
                        <input type="hidden" name="code" value="224">
                        <input type="hidden" name="status_leave" value="0">

                        <div class="col-lg-12">
                            <label>Leave Type<span class="text-danger">&nbsp;*</span></label>
                            <select class="form-control" name="LeaveType" id="LeaveType" required>
                                <option value="">Select Type</option>
                                <?php 
      $sql_att23="SELECT DISTINCT LeaveBalances.Balance,LeaveTypes.Name,LeaveTypes.Id FROM LeaveTypes right join LeaveBalances ON LeaveTypes.Id=LeaveBalances.LeaveType_Id where Employee_Id='$EmployeeID' ANd LeaveBalances.Balance>0 order by LeaveTypes.Id ASC"; 
      $stmt = sqlsrv_query($conntest,$sql_att23);  
                  while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                 {
                    ?>
                                <option value="<?=$row['Id'];?>"><?=$row['Name'];?>&nbsp;(<?=$row['Balance'];?>)
                                </option>
                                <?php
     }
     $sql_att2311="SELECT * FROM LeaveTypes where  Id!='1' and Id!='2'"; 
     $stmt11 = sqlsrv_query($conntest,$sql_att2311);  
                 while($row11= sqlsrv_fetch_array($stmt11, SQLSRV_FETCH_ASSOC) )
                {
    ?>
                                <option value="<?=$row11['Id'];?>"><?=$row11['Name'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label>Duration<span class="text-danger">&nbsp;*</span></label><br>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimaryLeave" onclick="singleHideShow();" value="Half"
                                    name="leaveHalfShortRadio" checked>
                                <label>
                                    Half/Short
                                </label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimaryLeave" onclick="dateHideShow();" value="Full"
                                    name="leaveHalfShortRadio">
                                <label>
                                    Full/Multiple
                                </label>
                            </div>
                            <div class="input-group" id="DivLeaveShift">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <b>F</b>&nbsp;&nbsp;<input type="radio" value="1"
                                            name="leaveShift">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>S</b>&nbsp;&nbsp;<input type="radio" value="2" name="leaveShift">
                                    </span>
                                </div>
                                <select class="form-control" name="leaveShort" id="leaveShort">
                                    <option value="">Leave Duration</option>
                                    <option value=".25">0.25</option>
                                    <option value="0.5">0.50</option>
                                    <option value="0.75">0.75</option>

                                </select>
                            </div>

                        </div>

                        <div class="col-lg-12" id="SingleDate">
                            <label>Date<span class="text-danger">&nbsp;*</span></label>
                            <input type="date" class="form-control" id="leaveDate" name="leaveDate"
                                value="<?=date('Y-m-d');?>" min='<?=date("Y-m-d", strtotime("-0 day"));  ?>'>
                        </div>
                        <div class="col-lg-12" id="StartDate" style="display:none;">
                            <label>Start Date<span class="text-danger">&nbsp;*</span></label>
                            <input type="date" class="form-control" id="leaveStartDate" name="leaveStartDate"
                                value="<?=date('Y-m-d');?>" min='<?=date("Y-m-d", strtotime("-0 day"));  ?>'>
                        </div>
                        <div class="col-lg-12 " id="EndDate" style="display:none;">
                            <label>End Date<span class="text-danger">&nbsp;*</span></label>
                            <input type="date" class="form-control" id="leaveEndDate" name="leaveEndDate"
                                value="<?=date('Y-m-d');?>" min='<?=date("Y-m-d", strtotime("-0 day"));  ?>'>
                        </div>
                        <div class="col-lg-12">
                            <label>Leave Reason<span class="text-danger">&nbsp;*</span></label>
                            <textarea Class="form-control" id="leaveReason" name="leaveReason"
                                placeholder="Enter leave reason............" required></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label>Adjustment File<span class="text-danger">&nbsp;*</span></label>
                            <input type="file" class="form-control" name='leaveFile' required>
                        </div>
                        <div class="col-lg-12">
                            <br>
                            <input type="button" onclick="leaveSubmit(this.form);" name="leaveButtonSubmit"
                                class="btn btn-success" value="Submit">
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
            <?php 

}
elseif($code==223)
{
    ?><div class="card-body">
                <div class="card-header">
                    <center>
                        <h6>Attendance Reports</h6>
                    </center>
                </div>
                <br>
                <div class="container-fluid">
                    <form action="attendance-pdf-summary.php" method="post" target="_blank">
                        <div class="btn-group w-100 mb-2">
                            <input type="hidden" name="exportCode" value='31'>
                            <input type="hidden" name="EmployeeId" value='<?=$EmployeeID;?>'>
                            <div class="col-lg-2">
                                <select placeholder="MM" name="month" class="form-control form-control-sm">
                                    <option value="" style="display:none;">MM</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>

                            </div>
                            <div class="col-lg-2">
                                <select placeholder="MM" name="year" class="form-control form-control-sm ">
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>

                                </select>

                            </div>
                            <div class="col-lg-2">
                                <button type='submit' class="btn btn-success btn-sm ">PDF&nbsp;&nbsp;<i
                                        class="fa fa-download" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <?php 

}
elseif($code==224)
{

$EmpID=$_POST['EmpID'];
$LeaveStatus=$_POST['status_leave'];
if($LeaveStatus>0)
{
  $status='Approved';

}
else
{
$status="Pending to Sanction";

}

$LeaveType=$_POST['LeaveType']; // like Casual/Comansantry
if($_POST['leaveHalfShortRadio']!='Full')
{
$leaveHalfShortRadio=$_POST['leaveHalfShortRadio'];
$leaveShift=$_POST['leaveShift']; // like S/F
$leaveShort=$_POST['leaveShort']; //  like  1/4 1/2
}
else
{
$leaveShift="0"; 
$leaveShort="0"; 
}
if($_POST['leaveDate']!='')
{
    $leaveStartDate=$_POST['leaveDate']; //  start date when full leave  
    $leaveEndDate=$_POST['leaveDate']; //  start date when full leave  
}
else
{
    $leaveStartDate=$_POST['leaveStartDate']; //  start date when full leave  
    $leaveEndDate=$_POST['leaveEndDate']; // end date  when full leave 
}
$file_name = $_FILES['leaveFile']['name'];
$file_tmp = $_FILES['leaveFile']['tmp_name'];
$type = $_FILES['leaveFile']['type'];

$startTimeStamp = strtotime($leaveStartDate);
$endTimeStamp = strtotime($leaveEndDate);
$timeDiff = abs($endTimeStamp - $startTimeStamp);
$numberDays = $timeDiff/86400;  // 86400 seconds in one day

$numberDays = intval($numberDays);
$numberDays=$numberDays+1;
 
$leaveReason=str_replace("'","`",$_POST['leaveReason']);

$ApplyDate=date('Y-m-d');

$sql_att23="SELECT * FROM ApplyLeaveGKU WHERE StaffId='$EmpID' and StartDate='$leaveStartDate' and EndDate='$leaveEndDate' and Status!='Approved' and Status!='Reject' ";  
$stmt=sqlsrv_query($conntest,$sql_att23,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$ifLeaveExist=sqlsrv_num_rows($stmt);
if($LeaveType==1|| $LeaveType==2)
{
$checkLeaveAlreadySubmited="SELECT * FROM ApplyLeaveGKU WHERE StaffId='$EmpID' and LeaveTypeId='$LeaveType' and Status!='Approved' and Status!='Reject'";
$countX=sqlsrv_query($conntest,$checkLeaveAlreadySubmited,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                    $leaveexistCount=sqlsrv_num_rows($countX);
}
else
{
    $leaveexistCount=0;
}

                    if($leaveexistCount>0)
                    {
                            echo "2";
                    }
                    else
                    {

                        if($ifLeaveExist<1)
                        {
                if($leaveStartDate>=$ApplyDate || $status=='Approved')
                {
 $string = bin2hex(openssl_random_pseudo_bytes(4));
    $file_name = $_FILES['leaveFile']['name'];
      $file_tmp = $_FILES['leaveFile']['tmp_name'];
      $type = $_FILES['leaveFile']['type'];
       $file_data = file_get_contents($file_tmp);

        $file_name = $EmpID."_".$ApplyDate."_".$string."_".basename($_FILES['leaveFile']['name']);
    
   $target_dir = $file_name;

   $ApplyDate1=date('Y-m-d h:i:s A');
     $destdir = 'LeaveFileAttachment';
     ftp_chdir($conn_id, "LeaveFileAttachment/") or die("Could not change directory");
     ftp_pasv($conn_id,true);
     //file_put_contents(,$file_data);
 ftp_put($conn_id, $target_dir, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");

     ftp_close($conn_id);
     $InsertLeave="INSERT into ApplyLeaveGKU (StaffId,LeaveTypeId,StartDate,EndDate,ApplyDate,LeaveReason,LeaveDuration,LeaveDurationsTime,AuthorityId,SanctionId,LeaveSchoduleTime,Status,FilePath)
 VALUES('$EmpID','$LeaveType'
  ,'$leaveStartDate','$leaveEndDate','$ApplyDate1','$leaveReason','$numberDays','$leaveShort','$Authority','$Recommend','$leaveShift','$status','$file_name')";
  $InsertLeaveRun=sqlsrv_query($conntest,$InsertLeave);

  //for notifications------------------------------
  if( $status!='Approved')
  {
  $Notification1="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`) VALUES ('$Recommend', '$EmployeeID', 'Leave pending to approve', ' ', 'attendence-calendar.php', '$timeStamp', '0')";
  mysqli_query($conn,$Notification1);
  }
//   ----------------------------------------------
                if($InsertLeaveRun==true)
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
                    echo "3";
                }
            }
        else
        {
            echo "4";
        }
    }
}
elseif($code==225)
{
    $empid = $_POST['empid'];
     $LoginType = $_POST['LoginType'];
    
    if($LoginType=='6')
    {
        $role='11';
    }
    else
    {
        $role='12';   
    }
    $check_role="SELECT * FROM user WHERE emp_id='$empid'";
    $count_run=mysqli_query($conn,$check_role);
    $count=mysqli_num_rows($count_run);
    if($count>0)
    {
 $insert="UPDATE user SET role_id='$role' WHERE emp_id='$empid'";
$insert_run=mysqli_query($conn,$insert);
}
else
{
    
}
}
elseif($code==226)
{
    $loginId=$_POST['loginId'];
    $userQry="SELECT * FROM user WHERE emp_id = '$loginId'";
    $userRes=mysqli_query($conn,$userQry);
    if (mysqli_num_rows($userRes)<1) 
    {      
    $staff="SELECT * FROM Staff Where IDNo='$loginId' ";
    $stmt = sqlsrv_query($conntest,$staff);  
    if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
    {
    $IDNo=$row_staff['IDNo'];
    $Name=$row_staff['Name'];
    $Clg=$row_staff['CollegeName'];
    $dept=$row_staff['Department'];
    $Desi=$row_staff['Designation'];
    $contact=$row_staff['ContactNo'];
    $email=$row_staff['EmailID'];
     $in="INSERT INTO user (emp_id, name, college, department, designation, mobile, email) VALUES ('$IDNo', '$Name', ' $Clg','$dept', '$Desi', '$contact', '$email')";
    mysqli_query($conn,$in);
    }
    }
}
elseif($code==227)
{
    $LeaveID=$_POST['LeaveID'];

          $LeaveUpdate="DELETE  FROM ApplyLeaveGKU  Where Id='$LeaveID' ";
        $LeaveUpdateRun=sqlsrv_query($conntest,$LeaveUpdate);
        if($LeaveUpdateRun==true)
        {
           echo "1";
        }
        else
        {
           echo "0";
        }
}
    elseif($code==228)
{
   
   
    $staff=" SELECT  * FROM   LeaveBalances WHERE  IDNo NOT IN (SELECT IDNo FROM Staff)";
    $stmt=sqlsrv_query($conntest,$staff,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
    $emp_count=sqlsrv_num_rows($stmt);
    while($row=sqlsrv_fetch_array($stmt)){
$aa[]=$row;
    }
    print_r($aa);

    }

    elseif($code==229)
    {
    ?>
            <div class=" table-responsive">
                <table class="table " id="example">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>EmpID/Name</th>
                            <th>Apply Date</th>
                            <th>Type</th>
                            <th>Count</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody style="height:1px" id="">
                        <?php 
        $Sr=1;
         $ifLeaveCheckWhenAuth="SELECT IDNo FROM Staff Where LeaveRecommendingAuthority='$EmployeeID' or  LeaveSanctionAuthority='$EmployeeID' and JobStatus='1'";
        $ifLeaveCheckWhenAuthRun=sqlsrv_query($conntest,$ifLeaveCheckWhenAuth);
        while($ifLEaveRow=sqlsrv_fetch_array($ifLeaveCheckWhenAuthRun))
        {
      
              $ifLeaveCheckWhenAuth1="SELECT * FROM ApplyLeaveGKU Where StaffId='".$ifLEaveRow['IDNo']."' and Status!='Approved' and Status!='Reject'";
             
            $ifLeaveCheckWhenAuth1Run=sqlsrv_query($conntest,$ifLeaveCheckWhenAuth1);
            if($ifLEaveRow1=sqlsrv_fetch_array($ifLeaveCheckWhenAuth1Run))
            {
              
              
            if($ifLEaveRow1['AuthorityId']!=$EmployeeID && $ifLEaveRow1['SanctionId']==$EmployeeID)
            {
               $getAllleaves="SELECT  *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND LeaveRecommendingAuthority='$EmployeeID' and ApplyLeaveGKU.Status!='Approved' and ApplyLeaveGKU.Status!='Reject' and  StaffId='".$ifLEaveRow['IDNo']."' order by  ApplyLeaveGKU.Id DESC "; 
            }
            elseif($ifLEaveRow1['SanctionId']!=$EmployeeID && $ifLEaveRow1['AuthorityId']==$EmployeeID)
            {
                $getAllleaves="SELECT  *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND LeaveSanctionAuthority='$EmployeeID' and ApplyLeaveGKU.Status='Pending To Authority'  and ApplyLeaveGKU.Status!='Reject' and  StaffId='".$ifLEaveRow['IDNo']."' order by  ApplyLeaveGKU.Id DESC ";
            }
            elseif($ifLEaveRow1['SanctionId']==$ifLEaveRow1['AuthorityId'])
            {
                $getAllleaves="SELECT  *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND LeaveRecommendingAuthority='$EmployeeID' and  LeaveSanctionAuthority='$EmployeeID' and  StaffId='".$ifLEaveRow['IDNo']."' and  ApplyLeaveGKU.Status!='Approved' and ApplyLeaveGKU.Status!='Reject' order by  ApplyLeaveGKU.Id DESC "; 
                
            }
            else
            {
                 $getAllleaves="SELECT  *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND  StaffId='".$ifLEaveRow['IDNo']."' and  ApplyLeaveGKU.Status='Pending To VC' and  ApplyLeaveGKU.Status!='Approved' and ApplyLeaveGKU.Status!='Reject' order by  ApplyLeaveGKU.Id DESC "; 
                
            }
        
    
        
        $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);

        while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
        {   
            if($row['Status']=='Approved')
            {
                $statusColor="success";
            }
            elseif($row['Status']=='Reject')
            {
                $statusColor="danger";
            }
            elseif($row['Status']=='Pending to VC')
            {
                $statusColor="warning";
            } 
            else
            {
                $statusColor="primary";
            } 
            $ref = $row['ApplyDate'];
            $now = new DateTime();
            $diff = $now->diff($ref);
            $interval = date_diff($ref, $now);
            $monthdown=$interval->format('%m');
         
?>
                        <tr>
                            <td><?=$Sr;?></td>
                            <td><b><?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</b></td>
                            <td width="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?>
                                <?php 

if ($monthdown<1) {?>
                                <span class="badge badge-success"><i class="far fa-clock"></i>&nbsp;<?php
                       
                        
                        if($interval->format('%m')>'0')
                        {
                            echo $interval->format(' %m months ');
                        }
                   
                       if ($diff->d > 0) {
                        printf('%d day%s', $diff->d, $diff->d > 1 ? 's' : '');
                    }
                    
                    if ($diff->h > 0) {
                        if ($diff->d > 0) {
                            echo ' ';
                        }
                        printf('%d hour%s', $diff->h, $diff->h > 1 ? 's' : '');
                    }
                    
                    if ($diff->i > 0) {
                        if ($diff->d > 0 || $diff->h > 0) {
                            echo ' ';
                        }
                        printf('%d minute%s', $diff->i, $diff->i > 1 ? 's' : '');
                    }
                    
                        ?>
                                </span>
                                <?php }else{?>

                                <span class="badge badge-danger"><i class="far fa-clock"></i>
                                    <?php if($monthdown>1){ $es="s";}else{$es="";} printf($monthdown.' month'.$es.' ago');?></span><?php }?>
                            </td>
                            <td><?=$row['LeaveTypeName'];?></td>

                            <td><?php   if($row['LeaveDurationsTime']!=0)
            {
              echo   $LeaveDurationsTime=$row['LeaveDurationsTime'];
            }
            else
            {
               echo  $LeaveDurationsTime=$row['LeaveDuration'];
            }?></td>
                            <td><b class='text-<?=$statusColor;?>'><?=$row['Status'];?></b></td>

                            <td>
                                <div class="controls">

                                    <button type="button" data-toggle="modal" data-target="#viewApprovedLeaveByAuth"
                                        data-whatever="@mdo"
                                        onclick="viewLeaveModalApprovedByAuth(<?=$row['LeaveID'];?>);"
                                        class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button>

                                </div>


                            </td>
                        </tr>
                        <?php
    
           
            $Sr++;
            $aa[]=$row;
        }
         }
        }
        if($Emp_Designation=='Vice Chancellor')
        {
        $ifLeaveCheckWhenAuth1="SELECT  *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND   ApplyLeaveGKU.Status='Pending To VC' order by  ApplyLeaveGKU.Id DESC "; 
        $ifLeaveCheckWhenAuth1Run=sqlsrv_query($conntest,$ifLeaveCheckWhenAuth1);
    while($row=sqlsrv_fetch_array($ifLeaveCheckWhenAuth1Run,SQLSRV_FETCH_ASSOC))
    {   
        if($row['Status']=='Approved')
        {
            $statusColor="success";
        }
        elseif($row['Status']=='Reject')
        {
            $statusColor="danger";
        }
        elseif($row['Status']=='Pending to VC')
        {
            $statusColor="warning";
        } 
        else
        {
            $statusColor="primary";
        } 
     
?>
                        <tr>
                            <td><?=$Sr;?></td>
                            <td><b><?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</b></td>
                            <td width="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?></td>
                            <td><?=$row['LeaveTypeName'];?></td>
                            <td><b class='text-<?=$statusColor;?>'><?=$row['Status'];?></b></td>
                            <td><?php   if($row['LeaveDurationsTime']!=0)
        {
          echo   $LeaveDurationsTime=$row['LeaveDurationsTime'];
        }
        else
        {
           echo  $LeaveDurationsTime=$row['LeaveDuration'];
        }?></td>

                            <td>
                                <div class="controls">

                                    <button type="button" data-toggle="modal" data-target="#viewApprovedLeaveByAuth"
                                        data-whatever="@mdo"
                                        onclick="viewLeaveModalApprovedByAuth(<?=$row['LeaveID'];?>);"
                                        class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button>

                                </div>


                            </td>
                        </tr>
                        <?php

       
        $Sr++;
        // $aa[]=$row;
    }
}
     
        // print_r($aa);
        ?>
                    </tbody>
                </table>
            </div><?php 
    }

    elseif($code==230)
    {
    ?>
            <div class=" table-responsive">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>EmpID/Name</th>
                            <th>Apply Date</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
        $Sr=1;

                  $getAllleaves="SELECT top(20)*,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND  (LeaveRecommendingAuthority='$EmployeeID' or  LeaveSanctionAuthority='$EmployeeID' ) and    ApplyLeaveGKU.Status='Approved' order by  ApplyLeaveGKU.Id DESC "; 
                
   
        $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
        while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
        { 
            if($row['LeaveDurationsTime']!=0)
            {
                $LeaveDurationsTime=$row['LeaveDurationsTime'];
            }
            else
            {
                $LeaveDurationsTime=$row['LeaveDuration'];
            }
    
            if($row['Status']=='Approved')
            {
                $statusColor="success";
            }
            elseif($row['Status']=='Reject')
            {
                $statusColor="danger";
            }
            elseif($row['Status']=='Pending to VC')
            {
                $statusColor="warning";
            } 
            else
            {
                $statusColor="primary";
            } 
            $ref = $row['ApplyDate'];
            $now = new DateTime();
            $diff = $now->diff($ref);
            $interval = date_diff($ref, $now);
            $monthdown=$interval->format('%m');
    ?>
                        <tr>
                            <td><?=$Sr;?></td>
                            <td><b><?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</b></td>
                            <td widht="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?>
                                <?php 

if ($monthdown<1) {?>
                                <span class="badge badge-success"><i class="far fa-clock"></i>&nbsp;<?php
                       
                        
                        if($interval->format('%m')>'0')
                        {
                            echo $interval->format(' %m months ');
                        }
                   
                       if ($diff->d > 0) {
                        printf('%d day%s', $diff->d, $diff->d > 1 ? 's' : '');
                    }
                    
                    if ($diff->h > 0) {
                        if ($diff->d > 0) {
                            echo ' ';
                        }
                        printf('%d hour%s', $diff->h, $diff->h > 1 ? 's' : '');
                    }
                    
                    if ($diff->i > 0) {
                        if ($diff->d > 0 || $diff->h > 0) {
                            echo ' ';
                        }
                        printf('%d minute%s', $diff->i, $diff->i > 1 ? 's' : '');
                    }
                    
                        ?>
                                </span>
                                <?php }else{}?>
                            </td>
                            <td><?=$row['LeaveTypeName'];?></td>
                            <td><b class='text-<?=$statusColor;?>'><?=$row['Status'];?></b></td>
                            <td><?=$LeaveDurationsTime;?></td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#viewApprovedLeaveByAuth"
                                    data-whatever="@mdo" onclick="viewLeaveModalApprovedByAuth(<?=$row['LeaveID'];?>);"
                                    class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button>
                            </td>


                        </tr>
                        <?php
    
           
            $Sr++;
        }

        if($Emp_Designation=='Vice Chancellor')
        {
        $ifLeaveCheckWhenAuth1="SELECT  top(20)*,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND   ApplyLeaveGKU.Status='Approved' and HRRemarks!='' order by  ApplyLeaveGKU.Id DESC "; 
        $ifLeaveCheckWhenAuth1Run=sqlsrv_query($conntest,$ifLeaveCheckWhenAuth1);
    while($row=sqlsrv_fetch_array($ifLeaveCheckWhenAuth1Run,SQLSRV_FETCH_ASSOC))
    {   
        if($row['Status']=='Approved')
        {
            $statusColor="success";
        }
        elseif($row['Status']=='Reject')
        {
            $statusColor="danger";
        }
        elseif($row['Status']=='Pending to VC')
        {
            $statusColor="warning";
        } 
        else
        {
            $statusColor="primary";
        } 
     
?>
                        <tr>
                            <td><?=$Sr;?></td>
                            <td><b><?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</b></td>
                            <td width="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?></td>
                            <td><?=$row['LeaveTypeName'];?></td>
                            <td><b class='text-<?=$statusColor;?>'><?=$row['Status'];?></b></td>
                            <td><?php   if($row['LeaveDurationsTime']!=0)
        {
          echo   $LeaveDurationsTime=$row['LeaveDurationsTime'];
        }
        else
        {
           echo  $LeaveDurationsTime=$row['LeaveDuration'];
        }?></td>

                            <td>
                                <div class="controls">

                                    <button type="button" data-toggle="modal" data-target="#viewApprovedLeaveByAuth"
                                        data-whatever="@mdo"
                                        onclick="viewLeaveModalApprovedByAuth(<?=$row['LeaveID'];?>);"
                                        class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button>

                                </div>


                            </td>
                        </tr>
                        <?php

       
        $Sr++;
        // $aa[]=$row;
    }
}
    // }
        ?>
                    </tbody>
                </table>
            </div><?php 
    } 
    elseif($code==231)
{
    ?>
            <div class=" table-responsive">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>EmpID/Name</th>
                            <th>Apply Date</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
        $Sr=1;
      
        $getAllleaves="SELECT top(20)*,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND  (LeaveRecommendingAuthority='$EmployeeID' or  LeaveSanctionAuthority='$EmployeeID') and    ApplyLeaveGKU.Status='Reject' order by  ApplyLeaveGKU.Id DESC "; 
                
                
     
        $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
        while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
        { 
            if($row['LeaveDurationsTime']!=0)
            {
                $LeaveDurationsTime=$row['LeaveDurationsTime'];
            }
            else
            {
                $LeaveDurationsTime=$row['LeaveDuration'];
            }
    
            if($row['Status']=='Approved')
            {
                $statusColor="success";
            }
            elseif($row['Status']=='Reject')
            {
                $statusColor="danger";
            }
            elseif($row['Status']=='Pending to VC')
            {
                $statusColor="warning";
            } 
            else
            {
                $statusColor="primary";
            } 
    ?>
                        <tr>
                            <td><?=$Sr;?></td>
                            <td><b><?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</b></td>
                            <td widht="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?></td>
                            <td><?=$row['LeaveTypeName'];?></td>
                            <td><b class='text-<?=$statusColor;?>'><?=$row['Status'];?></b></td>
                            <td><?=$LeaveDurationsTime;?></td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#viewApprovedLeaveByAuth"
                                    data-whatever="@mdo" onclick="viewLeaveModalApprovedByAuth(<?=$row['LeaveID'];?>);"
                                    class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button>
                            </td>
                        </tr>
                        <?php
    
           
            $Sr++;
        }
        if($Emp_Designation=='Vice Chancellor')
        {
        $ifLeaveCheckWhenAuth1="SELECT  top(20)*,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND   ApplyLeaveGKU.Status='Reject' and HRRemarks!='' order by  ApplyLeaveGKU.Id DESC "; 
        $ifLeaveCheckWhenAuth1Run=sqlsrv_query($conntest,$ifLeaveCheckWhenAuth1);
    while($row=sqlsrv_fetch_array($ifLeaveCheckWhenAuth1Run,SQLSRV_FETCH_ASSOC))
    {   
        if($row['Status']=='Approved')
        {
            $statusColor="success";
        }
        elseif($row['Status']=='Reject')
        {
            $statusColor="danger";
        }
        elseif($row['Status']=='Pending to VC')
        {
            $statusColor="warning";
        } 
        else
        {
            $statusColor="primary";
        } 
     
?>
                        <tr>
                            <td><?=$Sr;?></td>
                            <td><b><?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</b></td>
                            <td width="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?></td>
                            <td><?=$row['LeaveTypeName'];?></td>
                            <td><b class='text-<?=$statusColor;?>'><?=$row['Status'];?></b></td>
                            <td><?php   if($row['LeaveDurationsTime']!=0)
        {
          echo   $LeaveDurationsTime=$row['LeaveDurationsTime'];
        }
        else
        {
           echo  $LeaveDurationsTime=$row['LeaveDuration'];
        }?></td>

                            <td>
                                <div class="controls">

                                    <button type="button" data-toggle="modal" data-target="#viewApprovedLeaveByAuth"
                                        data-whatever="@mdo"
                                        onclick="viewLeaveModalApprovedByAuth(<?=$row['LeaveID'];?>);"
                                        class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button>

                                </div>


                            </td>
                        </tr>
                        <?php

       
        $Sr++;
        // $aa[]=$row;
    }
}
        ?>
                    </tbody>
                </table>
            </div><?php 
}

elseif ($code==232) {

    $id=$_POST['id'];
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
$getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
{

  $StartDate=$row['StartDate'];
 $EndDate=$row['EndDate'];
 $ApplyDate=$row['ApplyDate'];

    if($row['LeaveDurationsTime']!=0)
    {
        $LeaveDurationsTime=$row['LeaveDurationsTime'];
    }
    else
    {
        $LeaveDurationsTime=$row['LeaveDuration'];
    }
    if($row['Status']=='Approved')
    {
        $statusColor="success";
    }
    elseif($row['Status']=='Reject')
    {
        $statusColor="danger";
    }
    elseif($row['Status']=='Pending to VC')
    {
        $statusColor="warning";
    } 
    else
    {
        $statusColor="primary";
    } 

    $Emp_Image=$row['Snap'];
    $emp_pic=base64_encode($Emp_Image);
  
  
  
    


                  
?>

            <style>
            .leaveViewColor {
                color: black !important;
            }
            </style>

            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-<?=$statusColor;?>">
                    <div class="widget-user-image">
                        <?PHP  echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image' style='border: radius 70% !important;width:100px;height:100px;'>"; ?>
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</h3>
                    <h5 class="widget-user-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['Designation'];?></h5>
                    <h5 class="widget-user-desc">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$row['MobileNo'];?></h5>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column" style="color:black;">
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">

                                <b class="float-left ">Leave Type &nbsp;&nbsp;&nbsp;</b>
                                <span class="float-left ">
                                    <select class="form-control form-control-sm" id="leaveTypeByAuth">

                                        <option value="<?=$row['LeaveTypeId'];?>"><?=$row['LeaveTypeName'];?></option>
                                        <?php 
                    if($row['LeaveTypeId']!='1' && $row['LeaveTypeId']!='2' && $row['Status']!='Approved' && $row['Status']!='Reject' )
                    {
$getLeaveTypes="SELECT * from LeaveTypes where Id!='1' and Id!='2' ";
$getLeaveTypesRun=sqlsrv_query($conntest,$getLeaveTypes);
while($rowType=sqlsrv_fetch_array($getLeaveTypesRun))
{?>
                                        <option value="<?=$rowType['Id'];?>"><?=$rowType['Name'];?></option>
                                        <?php
 }
}
?>
                                    </select>
                                </span>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b> Start Date
                                    &nbsp;&nbsp;&nbsp;</b><?php echo date("d-m-Y", strtotime($StartDate->format("Y-m-d")));?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b>End Date
                                    &nbsp;&nbsp;&nbsp;</b><?php echo date("d-m-Y", strtotime($EndDate->format("Y-m-d"))); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b> Apply Date
<<<<<<< HEAD
                                    &nbsp;&nbsp;&nbsp;</b><?php echo date("Y-m-d h:i:s A", strtotime($ApplyDate->format("Y-m-d h:s A")));?>
=======
                                    &nbsp;&nbsp;&nbsp;</b><?php echo date("d-m-Y h:i:s A", strtotime($ApplyDate->format("Y-m-d H:i:s A")));?>
>>>>>>> fe97a0966a84946ac6a418d910ab6df6cd4ea450
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link leaveViewColor">
                                <b>Duration &nbsp;&nbsp;&nbsp;</b><?=$LeaveDurationsTime;?>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href='http://gurukashiuniversity.co.in/data-server/LeaveFileAttachment/<?=$row['FilePath'];?>'
                                target='_blank' class="nav-link leaveViewColor">
                                <b> View Adjustment File</b> &nbsp;&nbsp;&nbsp;<i
                                    class="fa fa-eye fa-lg text-success"></i>
                            </a>
                        </li>
                        <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor">
                                <b> Reason&nbsp;&nbsp;&nbsp; </b> <?=$row['LeaveReason'];?>
                            </a>
                        </li>

                        <?php if($row['AuthorityId']==$row['SanctionId'] && $row['RecommendedRemarks']!='' && $row['SanctionRemarks']!=''){
                             ?>
                        <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor"> <b>Remarks
                                    &nbsp;&nbsp;&nbsp;</b><?=$row['RecommendedRemarks'];   ?>&nbsp;<b>By
<<<<<<< HEAD
                                    (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>) on
                                    <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y h:s A');};?></b>
=======
                                    (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)
                                    on
                                    <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y H:i:s A');};?></b>
>>>>>>> fe97a0966a84946ac6a418d910ab6df6cd4ea450
                            </a>
                        </li>
                        <?php if($row['HRRemarks']!='')
                {?>
                        <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor"> <b>Remarks By Vice Chancellor</b>
                                &nbsp;&nbsp;&nbsp;<?=$row['HRRemarks'];   ?>&nbsp;<b> on
                                    <?php if($row['HRApprovedate']!=''){echo $row['HRApprovedate']->format('d-m-Y h:s A ');};?></b>
                            </a>
                        </li>
                        <?php }?>
                        <?php }
       else if( $row['AuthorityId']!=$row['SanctionId'] && $row['RecommendedRemarks']!='' && $row['SanctionRemarks']!='' )
        {?>
                        <a href='#' class="nav-link leaveViewColor"> <b>Recommend Remarks </b>&nbsp;&nbsp;&nbsp;
<<<<<<< HEAD
                            &nbsp;<?=$row['SanctionRemarks'];  ?>&nbsp;<b> By (<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>) on
                                <?php if($row['SanctionApproveDate']!=''){echo $row['SanctionApproveDate']->format('d-m-Y h:s A');};?></b>
=======
                            &nbsp;<?=$row['SanctionRemarks'];  ?>&nbsp;<b> By
                                (<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>) on
                                <?php if($row['SanctionApproveDate']!=''){echo $row['SanctionApproveDate']->format('d-m-Y H:i:s A');};?></b>
>>>>>>> fe97a0966a84946ac6a418d910ab6df6cd4ea450
                        </a></li>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor">
                                <b> Sanction Remarks &nbsp;&nbsp;&nbsp;</b>
<<<<<<< HEAD
                                <?=$row['RecommendedRemarks'];   ?> &nbsp; <b>By (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>) on
                                    <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y h:s A');};?></b>
=======
                                <?=$row['RecommendedRemarks'];   ?> &nbsp; <b>By
                                    (<?=$row['AuthorityId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['AuthorityId']);?>)
                                    on
                                    <?php if($row['RecommendedApproveDate']!=''){echo $row['RecommendedApproveDate']->format('d-m-Y H:i:s A');};?></b>
>>>>>>> fe97a0966a84946ac6a418d910ab6df6cd4ea450
                                </b></a>
                        </li>
                        <?php if($row['HRRemarks']!='')
                {?>
                        <li class="nav-item">

                            <a href='#' class="nav-link leaveViewColor"> <b>Remarks By Vice Chancellor</b>
                                &nbsp;&nbsp;&nbsp;<?=$row['HRRemarks'];   ?>&nbsp;<b> on
                                    <?php if($row['HRApprovedate']!=''){echo $row['HRApprovedate']->format('d-m-Y h:s A');};?>
                            </a>
                        </li>
                        <?php }?>
                        <?php }
                               else if($row['SanctionRemarks']!='' && $row['RecommendedRemarks']==''){
                                ?> <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor"> <b>Recommend Remarks </b>&nbsp;&nbsp;&nbsp;
<<<<<<< HEAD
                                &nbsp;<?=$row['SanctionRemarks'];  ?>&nbsp;<b> By (<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>) on
                                    <?php if($row['SanctionApproveDate']!=''){echo $row['SanctionApproveDate']->format('d-m-Y h:s A');};?></b>
=======
                                &nbsp;<?=$row['SanctionRemarks'];  ?>&nbsp;<b> By
                                    (<?=$row['SanctionId'];?>&nbsp;:&nbsp;<?php getEmployeeName($row['SanctionId']);?>)
                                    on
                                    <?php if($row['SanctionApproveDate']!=''){echo $row['SanctionApproveDate']->format('d-m-Y H:i:s A');};?></b>
>>>>>>> fe97a0966a84946ac6a418d910ab6df6cd4ea450
                            </a>
                        </li><?php 
                                                }
                ?>
                        <li class="nav-item">
                            <a href='#' class="nav-link leaveViewColor">
                                <b> Status &nbsp;&nbsp;&nbsp;</b>
                                <?php 
            if($row['Status']=='Approved') {
                $statusColor="success";
                echo "<b class='text-".$statusColor."'>".$row['Status']."&nbsp;&nbsp;&nbsp;<i class='fa fa-check fa-lg' aria-hidden='true'></i></b>";
               
            }
            elseif($row['Status']=='Reject') {
                $statusColor="danger";
                echo "<b class='text-".$statusColor."'>".$row['Status']."&nbsp;&nbsp;&nbsp;<i class='fa fa-times fa-lg' aria-hidden='true'></i></b>";
            }
            elseif($row['Status']=='Pending to VC') {
                $statusColor="info";
                echo "<b class='text-".$statusColor."'>".$row['Status']."&nbsp;&nbsp;&nbsp;<i class='fa fa-share' aria-hidden='true'></i></b>";
            }
            else {
                $statusColor="primary";
                echo "<b class='text-".$statusColor."'>".$row['Status']."&nbsp;&nbsp;&nbsp;<i class='fa fa-hourglass-start fa-lg' aria-hidden='true'></i></b>";
            }
            ?></b>
                                </b></a>
                        </li><?php 
    if($row['Status']!='Approved' && $row['Status']!='Reject'){
    ?>

                        <li class="nav-item">
                            <div class="card">
                                <textarea id="remarksForApproved" cols="10" class='form-control'
                                    placeholder="Write your remakrs.........."></textarea>
                                <small id="error-leave-textarea" class='text-danger' style='display:none;'>Please enter
                                    a value minimum 3 characters.</small>
                            </div>

                        </li>

                        <div class="col-lg-12">
                            <?php }?>


                            <?php if($row['AuthorityId']==$row['SanctionId'] && $LeaveDurationsTime<3 && $row['Status']!='Approved' && $row['Status']!='Reject' && $row['Status']!='Pending to VC'){ ?>

                            <button class="btn btn-success"
                                onclick="approvedLeavesByAuthButton(<?=$id;?>);">Approve</button>
                            <?php if($Emp_Designation!='Vice Chancellor')
                    {?>
                            <button class="btn btn-warning" onclick="forwardToVCLeavesByAuthButton(<?=$id;?>);">Forward
                                To VC</button>
                            <?php }?>
                            <button class="btn btn-danger"
                                onclick="rejectLeavesByAuthButton(<?=$id;?>);">Reject</button>
                            <?php }
        else if($row['AuthorityId']!=$EmployeeID && $row['SanctionId']==$EmployeeID && $row['Status']=='Pending to Sanction')
          {
        ?>
                            <button class="btn btn-success"
                                onclick="recommendLeavesByAuthButton(<?=$id;?>);">Recommend</button>
                            <button class="btn btn-danger"
                                onclick="rejectLeavesByAuthButtonRec(<?=$id;?>);">Reject</button>
                            <?php 
         }
         else if($row['AuthorityId']==$EmployeeID && $row['SanctionId']!=$EmployeeID && $LeaveDurationsTime<3 && $row['Status']=='Pending to Authority')
          {
            ?>
                            <button class="btn btn-success"
                                onclick="approvedLeavesByAuthButton(<?=$id;?>);">Approve</button>
                            <?php if($Emp_Designation!='Vice Chancellor')
                    {?>
                            <button class="btn btn-warning" onclick="forwardToVCLeavesByAuthButton(<?=$id;?>);">Forward
                                To VC</button>
                            <?php }?>
                            <button class="btn btn-danger"
                                onclick="rejectLeavesByAuthButton(<?=$id;?>);">Reject</button>
                            <?php
         }
         else if($row['AuthorityId']==$row['SanctionId'] && $LeaveDurationsTime>2 && ($row['Status']=='Pending to Authority' || $row['Status']=='Pending to Sanction') && $Emp_Designation!='Vice Chancellor')
         {
           ?>

                            <button class="btn btn-warning" onclick="forwardToVCLeavesByAuthButton(<?=$id;?>);">Forward
                                To VC</button>
                            <button class="btn btn-danger"
                                onclick="rejectLeavesByAuthButton(<?=$id;?>);">Reject</button>
                            <?php
        }
        else if($row['AuthorityId']==$EmployeeID && $row['SanctionId']!=$EmployeeID && $LeaveDurationsTime>2 && $row['Status']=='Pending to Authority'  && $Emp_Designation!='Vice Chancellor')
        {
          ?>

                            <button class="btn btn-warning" onclick="forwardToVCLeavesByAuthButton(<?=$id;?>);">Forward
                                To VC</button>
                            <button class="btn btn-danger"
                                onclick="rejectLeavesByAuthButton(<?=$id;?>);">Reject</button>
                            <?php
       }
        else if($row['Status']=='Pending to VC' && $Emp_Designation=='Vice Chancellor')
        {
          ?>

                            <button class="btn btn-success"
                                onclick="approvedLeavesByAuthButtonVC(<?=$id;?>);">Approve</button>
                            <button class="btn btn-danger"
                                onclick="rejectLeavesByAuthButtonVC(<?=$id;?>);">Reject</button>
                            <?php
       }
    }
        ?>




                        </div>
                        <br>

                        <!-- /.widget-user -->
                </div>
                <?php 
}
elseif($code==233)
{
    ?>
                <div class=" table-responsive">
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>EmpID/Name</th>
                                <th>Apply Date</th>
                                <th>Type</th>
                                <th>Count</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
        $Sr=1;
       
        $getAllleaves="SELECT top(20)*,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  YEAR(StartDate)='".date('Y')."' AND  (LeaveRecommendingAuthority='$EmployeeID' or  LeaveSanctionAuthority='$EmployeeID') and    ApplyLeaveGKU.Status='Pending to VC' order by  ApplyLeaveGKU.StartDate DESC "; 
                
        
        $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
        while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
        { 
            if($row['LeaveDurationsTime']!=0)
            {
                $LeaveDurationsTime=$row['LeaveDurationsTime'];
            }
            else
            {
                $LeaveDurationsTime=$row['LeaveDuration'];
            }
    
            if($row['Status']=='Approved')
            {
                $statusColor="success";
            }
            elseif($row['Status']=='Reject')
            {
                $statusColor="danger";
            }
            elseif($row['Status']=='Pending to VC')
            {
                $statusColor="warning";
            } 
            else
            {
                $statusColor="primary";
            } 
    ?>
                            <tr>
                                <td><?=$Sr;?></td>
                                <td><b><?=$row['StaffName'];?>(<?=$row['IDNo'];?>)</b></td>
                                <td widht="100"><?=$row['ApplyDate']->format('Y-m-d h:i:s A');?></td>
                                <td><?=$row['LeaveTypeName'];?></td>
                                <td><b class='text-<?=$statusColor;?>'><?=$row['Status'];?></td>
                                <td><?=$LeaveDurationsTime;?></td>
                                <td> <button type="button" data-toggle="modal" data-target="#viewApprovedLeaveByAuth"
                                        data-whatever="@mdo"
                                        onclick="viewLeaveModalApprovedByAuth(<?=$row['LeaveID'];?>);"
                                        class=" btn btn-success  btn-sm"><i class="fa fa-eye"></i></button></td>
                            </tr>
                            <?php
    
           
            $Sr++;
        }

        ?>
                        </tbody>
                    </table>
                </div><?php 
}
elseif($code==234)
{
    $id=$_POST['id'];
    
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
$getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
{
$Leave_Recom=$row['SanctionId'];
$Leave_Authority=$row['AuthorityId'];
$StaffId=$row['StaffId'];
}
       $remarks =str_replace("'",'',$_POST['remarks']); 
    $dataTime=date('Y-m-d h:s:m.v');
    if($Leave_Recom==$Leave_Authority)
    {
      $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Approved' , RecommendedRemarks='$remarks',RecommendedApproveDate='$dataTime',SanctionRemarks='$remarks',SanctionApproveDate='$dataTime' WHERE Id='$id'";
     
      $Notification1="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$EmployeeID', 'Leave approved', ' ', 'attendence-calendar.php', '$timeStamp', '0','1')";
      mysqli_query($conn,$Notification1);
    }
    else
    {
        $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Approved' , RecommendedRemarks='$remarks',RecommendedApproveDate='$dataTime' WHERE Id='$id'";

        $Notification1="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$EmployeeID', 'Leave approved', ' ', 'attendence-calendar.php', '$timeStamp', '0','1')";
        mysqli_query($conn,$Notification1);
    }
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
    if($updateLeaveAcrodingToActionRun==true)
      {
        echo "1";
      }
      if ($updateLeaveAcrodingToActionRun === false) {
        $errors = sqlsrv_errors();
        // echo "Error: " . print_r($errors, true);
        // echo "0";
    } 

}
elseif($code==235)
{
    $id=$_POST['id'];
    
    $dataTime=date('Y-m-d h:s:m.v');
       $remarks =str_replace("'",'',$_POST['remarks']);
    $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Pending to Authority',SanctionRemarks='$remarks',SanctionApproveDate='$dataTime' WHERE Id='$id'";
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
        {
        $StaffId=$row['StaffId'];
        $Leave_Authority=$row['AuthorityId'];
        }
    if($updateLeaveAcrodingToActionRun==true)
      {
        echo "1";
        $Notification1="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$EmployeeID', 'Leave forwarded', ' ', 'attendence-calendar.php', '$timeStamp', '0','2')";
        mysqli_query($conn,$Notification1);
        $Notification11="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$Leave_Authority', '$StaffId', 'Leave peding to approve', ' ', 'attendence-calendar.php', '$timeStamp', '0','0')";
        mysqli_query($conn,$Notification11);
      }

}
elseif($code==236)
{

    $id=$_POST['id'];
    $dataTime=date('Y-m-d h:s:m.v');
       $remarks =str_replace("'",'',$_POST['remarks']);
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    {
    $Leave_Recom=$row['SanctionId'];
    $Leave_Authority=$row['AuthorityId'];
    $StaffId=$row['StaffId'];
    }
    if($Leave_Recom==$Leave_Authority)
    {

     $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Reject',SanctionRemarks='$remarks', SanctionApproveDate='$dataTime',RecommendedRemarks='$remarks',RecommendedApproveDate='$dataTime'  WHERE Id='$id'";
     $Notification11="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$Leave_Recom', 'Leave Rejected ', ' ', 'attendence-calendar.php', '$timeStamp', '0','3')";
        mysqli_query($conn,$Notification11);
    }
    else
    {
        $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Reject',RecommendedRemarks='$remarks',RecommendedApproveDate='$dataTime' WHERE Id='$id'";
        $Notification11="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$Leave_Authority', 'Leave Rejected ', ' ', 'attendence-calendar.php', '$timeStamp', '0','3')";
        mysqli_query($conn,$Notification11);
    }
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
    if($updateLeaveAcrodingToActionRun==true)
      {
        echo "1";
      }

}
elseif($code==237)
{
    $id=$_POST['id'];
    
    $dataTime=date('Y-m-d h:s:m.v');
       $remarks =str_replace("'",'',$_POST['remarks']);
   
    $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Reject',SanctionRemarks='$remarks',SanctionApproveDate='$dataTime' WHERE Id='$id'";
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    {
    $Leave_Recom=$row['SanctionId'];
    $Leave_Authority=$row['AuthorityId'];
    $StaffId=$row['StaffId'];
    }
    if($updateLeaveAcrodingToActionRun==true)
      {
        echo "1";
        $Notification11="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$Leave_Recom', 'Leave Rejected ', ' ', 'attendence-calendar.php', '$timeStamp', '0','3')";
        mysqli_query($conn,$Notification11);
      }

}
elseif($code==238)
{
    $id=$_POST['id'];
    $dataTime=date('Y-m-d h:s:m.v');
       $remarks =str_replace("'",'',$_POST['remarks']);
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    {
    $Leave_Recom=$row['SanctionId'];
    $Leave_Authority=$row['AuthorityId'];
    $StaffId=$row['StaffId'];
    }
    if($Leave_Recom==$Leave_Authority)
    {
        $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Pending to VC',RecommendedRemarks='$remarks',RecommendedApproveDate='$dataTime',SanctionRemarks='$remarks',SanctionApproveDate='$dataTime' WHERE Id='$id'";
        $Notification11="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$Leave_Authority', 'Leave forwarded to VC', ' ', 'attendence-calendar.php', '$timeStamp', '0','2')";
        mysqli_query($conn,$Notification11);
    }
    else
    {
        $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Pending to VC',RecommendedRemarks='$remarks',RecommendedApproveDate='$dataTime' WHERE Id='$id'";
        $Notification11="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$Leave_Authority', 'Leave forwarded to VC', ' ', 'attendence-calendar.php', '$timeStamp', '0','2')";
        mysqli_query($conn,$Notification11);
    }
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
    if($updateLeaveAcrodingToActionRun==true)
    {
        echo "1";
    }

}
elseif($code==239)
{
    $id=$_POST['id'];
    $dataTime=date('Y-m-d h:s:m.v');
       $remarks =str_replace("'",'',$_POST['remarks']);
     $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Approved',HRRemarks='$remarks',HRApprovedate='$dataTime' WHERE Id='$id'";
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    {
    $Leave_Recom=$row['SanctionId'];
    $Leave_Authority=$row['AuthorityId'];
    $StaffId=$row['StaffId'];
    $Leave_Recom=$row['SanctionId'];
    $Leave_Authority=$row['AuthorityId'];
    $StaffId=$row['StaffId'];
    }
    if($updateLeaveAcrodingToActionRun==true)
    {
        echo "1";
        $Notification11="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$ViceChancellor', 'Leave Approved', ' ', 'attendence-calendar.php', '$timeStamp', '0','1')";
        mysqli_query($conn,$Notification11);
    }
    else
    {
        echo "0";
    }
    
}
elseif($code==240)
{
    $id=$_POST['id'];
    
    $dataTime=date('Y-m-d h:s:m.v');
    $remarks =str_replace("'",'',$_POST['remarks']);
     $updateLeaveAcrodingToAction="UPDATE  ApplyLeaveGKU  SET Status='Reject',HRRemarks='$remarks',HRApprovedate='$dataTime' WHERE Id='$id'";
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
    $getAllleaves="SELECT *,LeaveTypes.Name as LeaveTypeName,Staff.Name as StaffName,ApplyLeaveGKU.Id as LeaveID FROM Staff inner join ApplyLeaveGKU ON Staff.IDNo=ApplyLeaveGKU.StaffId  inner join LeaveTypes ON LeaveTypes.Id=ApplyLeaveGKU.LeaveTypeId  where  ApplyLeaveGKU.Id='$id' "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    {
    $Leave_Recom=$row['SanctionId'];
    $Leave_Authority=$row['AuthorityId'];
    $StaffId=$row['StaffId'];
    }
    if($updateLeaveAcrodingToActionRun==true)
      {
        echo "1";
        $Notification11="INSERT INTO `notifications` (`EmpID`, `SendBy`, `Subject`, `Discriptions`, `Page_link`, `DateTime`, `Status`,`Notification_type`) VALUES ('$StaffId', '$ViceChancellor', 'Leave Rejected ', ' ', 'attendence-calendar.php', '$timeStamp', '0','3')";
        mysqli_query($conn,$Notification11);
      }

}

elseif($code==241)
{
                  $CollegeID=$_POST['CollegeID'];
                  $Course=$_POST['Course'];
                  $Batch=$_POST['Batch'];
                  $Semester=$_POST['Semester'];
?>
                <div class="col-lg-12 ">
                    <div class="card-header">
                        Student Reports
                    </div>
                    <div class="table table-responsive table-bordered table-hover" style="font-size:12px;">
                        <table class="table">
                            <tr>
                                <th>Srno</th>

                                <th>Image</th>
                                <th>UniRollNo</th>
                                <th>ClassRollNo</th>
                                <th>Name</th>
                                <th>FatherName</th>
                                <th>MotherName</th>
                                <th>Course</th>
                                <th>Batch</th>

                                <th>Session</th>
                                <th>Action</th>

                            </tr>
                            <?php 

                         $get_study_scheme="SELECT * FROM Admissions WHERE CollegeID='$CollegeID' and CourseID='$Course' and Batch='$Batch' and Session='$Semester'";
                        $get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                          if(sqlsrv_num_rows($get_study_scheme_run)>0)  
                       {
                        while($get_row=sqlsrv_fetch_array($get_study_scheme_run,SQLSRV_FETCH_ASSOC))
                        {
                            $count_0++;
                            $univ_rollno=$get_row['IDNo'];
                            $photo = $get_row['Snap'];
                          
                            $emp_pic=base64_encode($photo);
                            
                           
                                       ?>
                            <tr>
                                <td><?=$count_0;?></td>

                                <td><?php  echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";?>
                                </td>
                                <td><?=$get_row['UniRollNo'];?></td>
                                <td><?=$get_row['ClassRollNo'];?></td>
                                <td><?=$get_row['StudentName'];?></td>
                                <td><?=$get_row['FatherName'];?></td>
                                <td><?=$get_row['MotherName'];?></td>
                                <td><?=$get_row['Course'];?></td>
                                <td><?=$get_row['Batch'];?></td>

                                <td><?=$get_row['Session'];?></td>
                                <td> <?php echo '<a download="'.$univ_rollno.'.jpg" href="data:image/png;base64,'.base64_encode($photo).'">'; ?>
                                    <BUTTON class="btn btn-danger btn-xs">Download Image</BUTTON>
                                </td>

                            </tr>
                            <?php
                         
                         }
                        

                       }
                       else
                       {
                        echo "<tr><td colspan='16'><center>--No record found--</center></td></tr>";
                       }
                       ?>
                        </table>
                    </div>


                </div>
                <?php
}
elseif($code==242)
{
                  $CollegeID=$_POST['CollegeID'];
                  $Course=$_POST['Course'];
                  $oddeven=$_POST['oddeven'];
                  
                
?>
                <div class="col-lg-12 ">
                    <div class="card-header">
                        Student Reports
                    </div>
                    <div class="table table-responsive table-bordered table-hover" style="font-size:;">
                        <table class="table">
                            <tr>

                                <th>Course</th>
                                <th>Batch</th>
                                <th>Semester</th>
                                <th>Admission Count</th>
                                <th>Exam Form Accepted</th>
                                <th>Exam Form Pending</th>
                                <th>Not Applied</th>


                            </tr>
                            <?php 

                         $get_study_scheme="SELECT * FROM MasterCourseCodes WHERE CollegeID='$CollegeID' and CourseID='$Course'";
                        $get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                        $count_0=0;
                          if(sqlsrv_num_rows($get_study_scheme_run)>0)  
                         {
                         if($get_row=sqlsrv_fetch_array($get_study_scheme_run,SQLSRV_FETCH_ASSOC))
                         {
                            $Duration=$get_row['Duration'];
                         }
                        $currentYears=date('Y');
                         $startBatch=$currentYears-$Duration;
                           $startBatch=$startBatch+1;
                           
                          for($batch=$currentYears;$batch >=$startBatch;$batch-=1) 
                          {
                           $batchArray[]=$batch;
                          }
                            for ($sem=1;$sem <$Duration*2; $sem++) 
                            { 
                            if($sem%2==$oddeven)
                            {
                              $SemArray[]=$sem;

                            }
                        }
                            
                            foreach ($batchArray as $key => $value) {
                               
                             $get_study_scheme="SELECT * FROM Admissions WHERE CollegeID='$CollegeID' and CourseID='$Course' and Batch='$value' ";
                            $get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                            $count=sqlsrv_num_rows($get_study_scheme_run)."<br>";
                              $examFormAccepted="SELECT * FROM ExamForm WHERE SemesterId='".$SemArray[$key]."' and CourseID='$Course' and Batch='$value' and Status='8'";
                            $examFormAccepted_run=sqlsrv_query($conntest,$examFormAccepted,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                            $countExamForm=sqlsrv_num_rows($examFormAccepted_run)."<br>";

                            $examFormAccepted1="SELECT * FROM ExamForm WHERE SemesterId='".$SemArray[$key]."' and CourseID='$Course' and Batch='$value' and Status!='8'";
                            $examFormAccepted_run1=sqlsrv_query($conntest,$examFormAccepted1,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                            $countExamFormPending=sqlsrv_num_rows($examFormAccepted_run1)."<br>";
                            
                            $examFormAccepted12="SELECT  IDNo FROM  Admissions  WHERE IDNo NOT IN (SELECT IDNo FROM ExamForm where SemesterId='".$SemArray[$key]."' and CourseID='$Course' and Batch='$value')";
                            $examFormAccepted_run12=sqlsrv_query($conntest,$examFormAccepted12,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                            $countExamFormNotApply=sqlsrv_num_rows($examFormAccepted_run12)."<br>";


                            if($get_row=sqlsrv_fetch_array($get_study_scheme_run,SQLSRV_FETCH_ASSOC))
                            {
                           ?>
                            <tr>
                                <td><?=$get_row['Course'];?></td>
                                <td><?=$value;?></td>
                                <td><?=$SemArray[$key];?></td>
                                <td><?=$count;?></td>
                                <td><?=$countExamForm;?></td>
                                <td><?=$countExamFormPending;?></td>
                                <td><?=$countExamFormNotApply;?></td>
                            </tr>
                            <?php 

                                 
                            
                        
                        }
                        
                    }
                }

                       ?>
                        </table>
                    </div>


                </div>
                <?php
}
elseif ($code==243) 
{
   $leaveID=$_POST['id'];
   $leaveType=$_POST['type'];
    $updateLeaveAuth="UPDATE ApplyLeaveGKU SET LeaveTypeId='$leaveType' where Id='$leaveID'";
    sqlsrv_query($conntest,$updateLeaveAuth);
}
   else
   {
   
   }
   }
   
   ?>