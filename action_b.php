<?php 
   session_start(); 
   ini_set('max_execution_time', '0');
   if (!(isset($_SESSION['usr']) || isset($_SESSION['secure']) || isset($_SESSION['profileIncomplete']))) 
   {  
   ?>
<script>
window.location.href = 'index.php';
</script>
<?php
   } 
   else
   {     
    include "connection/connection.php";
   $EmployeeID=$_SESSION['usr'];
   if ($EmployeeID==0 || $EmployeeID=='') 
      {?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php }
   
       $employee_details="SELECT RoleID,IDNo,ShiftID,Name,Department,CollegeName,Designation,LeaveRecommendingAuthority,LeaveSanctionAuthority FROM Staff Where IDNo='$EmployeeID'";
      $employee_details_run=sqlsrv_query($conntest,$employee_details);
      if ($employee_details_row=sqlsrv_fetch_array($employee_details_run,SQLSRV_FETCH_ASSOC)) {
         $Emp_Name=$employee_details_row['Name'];
         $Emp_Designation=$employee_details_row['Designation'];
         $Emp_CollegeName=$employee_details_row['CollegeName'];
         $Emp_Department=$employee_details_row['Department'];
          $role_id = $employee_details_row['RoleID'];
          $ShiftID =$employee_details_row['ShiftID'];
         $Authority=$employee_details_row['LeaveSanctionAuthority'];
         $Recommend=$employee_details_row['LeaveRecommendingAuthority']; //new
       
      }
      else
      {
         // echo "inter net off";
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
        $currentMonthString=date('F');
        $currentMonthInt=date('n');
        $code =$_POST['code'];
        if($code==1)
        {
            include "connection/ftp-erp.php";
        }
if($code==1) // pendig complaint
        {
        
         ?>
      <table class="table" id="example">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Complain No</th>
                  <th>Complaint Date</th>
                  <th>Title</th>
              </tr>
          </thead>
          <tbody>
              <?php  
              $sr=1; $get_pending="SELECT StudentGrievance.TokenNo,MAX(StudentGrievance.SubmitDate) AS SubmitDate,MAX(StudentGrievance.Subject) AS Subject,MAX(StudentGrievanceTrack.Action) AS Action,
    MAX(StudentGrievanceTrack.EmployeeId) AS EmployeeId FROM  StudentGrievance INNER JOIN   StudentGrievanceTrack ON  StudentGrievance.TokenNo = StudentGrievanceTrack.TokenNo WHERE StudentGrievanceTrack.Action = '0' AND StudentGrievanceTrack.EmployeeId = '$EmployeeID' GROUP BY StudentGrievance.TokenNo;"; 
                  $get_pending_run=sqlsrv_query($conntest,$get_pending);
                  while($get_row=sqlsrv_fetch_array($get_pending_run))
                  {
              ?>
              <tr>
                  <td><?=$sr;?></td>
                  <td onclick="show_timeline_show_application(<?=$get_row['TokenNo'];?>);"><a href="#"><B
                              class="text-primary"><?=$get_row['TokenNo'];?></B></a></td>
                  <td><?=$get_row['SubmitDate']->format('d-m-Y');?></td>
                  <td><?=$get_row['Subject'];?></td>
              </tr>
              <?php $sr++; }?>
          </tbody>
      </table>
      <?php 
       sqlsrv_close($conntest);
  }

  elseif($code==2)// timeline verification
  {
     $TokenNo=$_POST['Token_No'];
     ?>
<div class="col-md-12">

    <div class="timeline" style="font-size: 15px !important;">
        <!-- timeline time label -->
        <div class="time-label">
            <span class="bg-red">Token No:<?=$TokenNo;?></span>
        </div>
        <?php 
        $get_details_token="SELECT * from StudentGrievance inner join StudentGrievanceTrack ON StudentGrievance.TokenNo=StudentGrievanceTrack.TokenNo where StudentGrievance.TokenNo='$TokenNo'"; 
                    $get_details_token_run=sqlsrv_query($conntest,$get_details_token);
                    if($get_row_token=sqlsrv_fetch_array($get_details_token_run))
                    {   
                        $getIDNosql = "SELECT * FROM Admissions Where IDNo='".$get_row_token['StudentIdNo']."' ";
                        $getIDNostmt = sqlsrv_query($conntest,$getIDNosql);  
                            if($getIDNorow = sqlsrv_fetch_array($getIDNostmt, SQLSRV_FETCH_ASSOC) )
                        {         
                            $Name=$getIDNorow['StudentName'];
                            $FatherName=$getIDNorow['FatherName'];
                            $IDNo=$getIDNorow['IDNo'];
                            $ClassRollNo=$getIDNorow['ClassRollNo'];
                            $Session=$getIDNorow['Session'];
                            $Course=$getIDNorow['Course'];
                            $CollegeName=$getIDNorow['CollegeName'];
                            $Nationality=$getIDNorow['Nationality'];
                            $Batch=$getIDNorow['Batch'];
                            $AdmissionDate=$getIDNorow['AdmissionDate']->format('d-m-Y');
                            $MotherName=$getIDNorow['MotherName'];
                            $Sex=$getIDNorow['Sex'];
                            $DOB=$getIDNorow['DOB']->format('d-m-Y');
                            $StudentMobileNo=$getIDNorow['StudentMobileNo'];
                        }    
        ?>
        <div>
            <i class="fa fa-stop-circle bg-primary" aria-hidden="true"></i>
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i>
                    <?=$get_row_token['SubmitDate']->format('d-m-Y H:i:s');?></span>
                <h3 class="timeline-header"><b>Request
                        by&nbsp;&nbsp;:&nbsp;&nbsp;<?=$Name;?></b>&nbsp;&nbsp;<?=$ClassRollNo;?>
                </h3>
                <div class="timeline-body table-responsive">
                <div class="col-lg-12">
                    <table class="" style="background-color: white; width: 100%;">
                       <tbody>
           
                        <tr>
                        <td colspan="16"><strong>Status: <?php if($get_row_token['Status']==1){echo "<b class='text-warning'>Forwarded</b>";} elseif($get_row_token['Status']==2){echo "<b class='text-success'>Completed</b>";}else{
                            echo "<b class='text-primary'>InProcess</b>";
                        }$get_row_token['Status'];?></strong></td>
                       </tr>

                        <tr>
                            <td colspan="16"><strong>Reply:</strong></td>
                        </tr>
                        <tr>
                            <td colspan="8">Application No: <?=$get_row_token['TokenNo'];?></td>
                            <td colspan="8" style="text-align: right;">
                                <!-- <strong>Date: <?=$get_row_token['SubmitDate']->format('d-m-Y H:i:s');?></strong> -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="16"><strong>To</strong></td>
                        </tr>
                        <tr>
                            <td colspan="16">
                            <?=$get_row_token['EmployeeDepartment'];?><br>
                                Guru Kashi University<br>
                                Talwandi Sabo
                            </td>
                        </tr>
                        <tr>
                            <td colspan="16"><strong>Subject:</strong> <?=$get_row_token['Subject'];?></td>
                        </tr>
                        <tr>
                            <td colspan="16">
                                <a href="http://erp.gku.ac.in:86/Images/Grievance/<?=$get_row_token['FilePath'];?>" target="_blank"><strong>Attachments <i class="fa fa-eye"></i></strong></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="16">Respected Sir/Madam,</td>
                        </tr>
                        <tr>
                            <td colspan="16"><?=$get_row_token['Description'];?></td>
                        </tr>
           
                        <tr>
                            <td colspan="16" style="text-align: right;">
                                Your Faithfully,<br>
                                <strong>Name:</strong> <?=$Name;?><br>
                                <strong>Roll No.:</strong> <?=$ClassRollNo;?><br>
                                <strong>Course:</strong><?=$Course;?><br>
                                <?=$CollegeName;?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                        </div>   
                      </div>
                 
            </div>
        </div>

        <?php 
        $get_details="SELECT * from StudentGrievance inner join StudentGrievanceTrack ON StudentGrievance.TokenNo=StudentGrievanceTrack.TokenNo where StudentGrievance.TokenNo='$TokenNo' order by StudentGrievanceTrack.ID ASC"; 
             $get_details_run=sqlsrv_query($conntest,$get_details);
             while($get_details_run_row=sqlsrv_fetch_array($get_details_run))
             { 
                if ($get_details_run_row['Action']==0) 
           {
             $envolp="warning";
             $envolp_msg="Pending";
             $envolp_icon="hourglass-start";
           } elseif ($get_details_run_row['Action']==1) 
           {
             $envolp="warning";
             $envolp_msg="Under Process";
             $envolp_icon="share";
        
        
           }
           elseif ($get_details_run_row['Action']==2) 
           {
             $envolp="danger";
             $envolp_msg="Reject";
             $envolp_icon="times";
        
        
           } 
           elseif ($get_details_run_row['Action']==4) 
           {
             $envolp="primary";
             $envolp_msg="Forward";
             $envolp_icon="times";
        
        
           }
           elseif ($get_details_run_row['Action']==5) 
           {
             $envolp="success";
             $envolp_msg="Complete";
             $envolp_icon="check-circle";
        
        
        
           } 
        
           if ($get_details_run_row['ForrwardToId']!=0) 
           {
             $forward_to_="&nbsp;To&nbsp;<b>(".$get_details_run_row['ForwardToName'].")".$get_details_run_row['ForwardToDepartment']."</b>";
           }
           else
           {
              $forward_to_="";
        
           }
            if ($get_details_run_row['EmployeeId']==$EmployeeID) 
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
                        <?php if($get_details_run_row['ForwardDateTime']!=''){echo $get_details_run_row['ForwardDateTime']->format('d-m-Y H:i:s');}?></span>
                    <p class="timeline-header">
                        <?=$Self;?>&nbsp;&nbsp;<b><?=$get_details_run_row['EmployeeName'];?>&nbsp;(<?=$get_details_run_row['EmployeeDepartment'];?>)</b><?=$forward_to_;?>
                    </p>
                    <!--   <div class="ribbon-wrapper ribbon-sm">
                  <div class="ribbon bg-primary ">
                    Complete
                  </div>
                  </div> -->
                    <div class="timeline-body">
                        <?php 
                     if ($get_details_run_row['EmployeeRemarks']!='')
                      {
                        echo "<b>Remarks: &nbsp;</b>".$get_details_run_row['EmployeeRemarks'];
                     }
                     else
                     {
                     
                     }
                    
                     ?>
                    </div>
                </div>
            </div><?php
             }
            }
        ?>
        <div>
            <i class="fas fa-clock bg-gray"></i>
        </div>
    </div>
    <!-- </div> -->
    <!-- /.col -->
</div>
<?php 
  sqlsrv_close($conntest);

        }
        elseif($code==3)
        {
            $TokenNo=$_POST['Token_No'];
         $check_flow="SELECT * FROM  StudentGrievanceTrack  Where TokenNo='$TokenNo' and EmployeeId='$EmployeeID' ";
        $check_flow_run=sqlsrv_query($conntest,$check_flow);
        if($check_flow_row=sqlsrv_fetch_array($check_flow_run))
        {
       
       if ($check_flow_row['Action']==0 && $check_flow_row['Action']!=2)
       {
       ?>
     <div class="btn-group btn-group-toggle" data-toggle="buttons">
         <?PHP 
 if ($check_flow_row['Action']<1) {
 ?>
         <label class="btn btn-warning  btn-xs ">
             <input type="radio" name="options" onclick="toggleDiv_approve();" id="option_a1" autocomplete="off">
             Reply
         </label>
         <?PHP }?>
 
         <!-- <label class="btn btn-danger btn-xs">
             <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
         </label> -->
         <label class="btn btn-success btn-xs">
             <input type="radio" name="options" onclick="toggleDiv_allotment();" id="option_a3" autocomplete="off">
             Forward
         </label>
     </div>
   
                        <input type="hidden" id="time_line_token" value="<?=$TokenNo;?>">
                        <input type="hidden" id="time_line_userId" value="<?=$check_flow_row['EmployeeId'];?>">
                    
     <textarea class="form-control " placeholder=" Remarks" rows="3" id="comment_approve"
         style="display:none;margin-top: 10px;"></textarea>
     <input type="button" class="btn btn-success btn-xs" id="btn_comment_approve" onclick="approve_by_allotment_auth();"
         value="Submit" style="display:none;">
     <!-- <textarea class="form-control " rows="3" placeholder="Rejected Remarks" id="comment_reject"
         style="display:none;margin-top: 10px;"></textarea>
     <input type="button" class="btn btn-success btn-xs" id="btn_comment_reject" onclick="reject_by_allotment_auth();"
         value="Submit" style="display:none;"> -->
     <div class="row">
 
         <div class="col-lg-12" id="comment_allotment" style="display:none;margin-top: 10px;">
             <div class="row">
 
 
             <div class="icheck-primary d-inline">
    <input type="radio" id="radioPrimary151_role" onclick="bydriver();" value="0" name="empc121" checked>
    <label for="radioPrimary151_role">
        Role
    </label>
</div>
&nbsp;&nbsp;
<div class="icheck-primary d-inline">
    <input type="radio" id="radioPrimary151_name" onclick="selfdrive();" value="1" name="empc121">
    <label for="radioPrimary151_name">
        Name/College
    </label>
</div>

 
 
 
             <div id="role_div" style="display:block;">
             <label>Role</label>
             <select class="form-control" onchange="drop_type_emp(this.value);" id="roleID">
                 <option value="">Select</option>
                 <?php  
    
                   $getRoleName = "SELECT * FROM role_name order by role_name asc ";
                   $getRoleNameRun = mysqli_query($conn, $getRoleName);
                   while($rowGetRoleName = mysqli_fetch_array($getRoleNameRun)) {
               ?>
                   <option value="<?=$rowGetRoleName['id'];?>"><?=$rowGetRoleName['role_name'];?></option>
              
               <?php } ?>
            
             </select>
            
                   </div>
             <div id="self_div" style="display:none;">
             
                                        <div class="form-group">
                                            <label>College</label>

                                            <select class="form-control" id="organisationName" name="organisationName"
                                                onchange="fetchDepartment(this.value);">
                                               
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
                                    
                                   
                                        <div class="form-group">
                                            <label>Department</label>

                                            <select class="form-control" name="departmentName" id="departmentName" onclick="drop_type_emp_dep(this.value);">
                                               
                                            </select>
                                        </div>
                                  
             </div>
             <label> Employee Name</label>
             <select class="form-control" id="staff_name">
                 <option value="">Select</option>
             </select>
            
             <label> Remakrs</label>
             <textarea class="form-control " placeholder=" Remarks" rows="3" id="remakrs"
        ></textarea>
            
         </div>
     </div>
     <input type="button" class="btn btn-success btn-xs" id="btn_comment_allotment"
         onclick="allotment_by_allotment_auth(<?=$TokenNo;?>);" value="Submit" style="display:none;">
     <?php
       }
       elseif($check_flow_row['Action']==2)
       {
       ?>
     <form action="transport_allotted_slip.php" method="POST" target="_blank">
         <input type="hidden" name="token_no" value="<?=$TokenNo;?>">
         <input type="submit" class="btn btn-primary btn-xs" value="Print">
     </form>
    
     <?php
       }
       else
       {
       
       
       }
          }
       sqlsrv_close($conntest);
       } 
       elseif($code==4)
       {
      $roleID=$_POST['id'];
      ?><option value="">Select</option>
    <?php 
          $show_all_Staff="SELECT * FROM Staff where RoleID='$roleID' and JobStatus='1' order by Name ASC ";
          $show_all_Staff_run=sqlsrv_query($conntest,$show_all_Staff);
          while($row_all=sqlsrv_fetch_array($show_all_Staff_run))
          {
        ?>
    <option value="<?=$row_all['IDNo'];?>"><?=$row_all['Name'];?>(<?=$row_all['IDNo'];?>)<?=$row_all['Designation'];?></option>
    <?PHP 
      }
    }
       elseif($code==5)
       {
      $roleID=$_POST['id'];
      ?><option value="">Select</option>
    <?php 
          $show_all_Staff="SELECT * FROM Staff where DepartmentID='$roleID' and JobStatus='1' and DepartmentID!='' order by Name ASC ";
          $show_all_Staff_run=sqlsrv_query($conntest,$show_all_Staff);
          while($row_all=sqlsrv_fetch_array($show_all_Staff_run))
          {
        ?>
    <option value="<?=$row_all['IDNo'];?>"><?=$row_all['Name'];?>(<?=$row_all['IDNo'];?>)<?=$row_all['Designation'];?></option>
    <?PHP 
      }
      sqlsrv_close($conn);
      }
      else if($code==6) // forward complaint
        {
        
         ?>
      <table class="table" id="example">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Complain No</th>
                  <th>Complaint Date</th>
                  <th>Title</th>
              </tr>
          </thead>
          <tbody>
              <?php  
              $sr=1; $get_pending="SELECT StudentGrievance.TokenNo,
    MAX(StudentGrievance.SubmitDate) AS SubmitDate,
    MAX(StudentGrievance.Subject) AS Subject,
    MAX(StudentGrievanceTrack.Action) AS Action,
    MAX(StudentGrievanceTrack.EmployeeId) AS EmployeeId FROM  StudentGrievance INNER JOIN   StudentGrievanceTrack ON  StudentGrievance.TokenNo = StudentGrievanceTrack.TokenNo WHERE StudentGrievanceTrack.Action = '1' AND StudentGrievanceTrack.EmployeeId = '$EmployeeID' GROUP BY StudentGrievance.TokenNo"; 
                  $get_pending_run=sqlsrv_query($conntest,$get_pending);
                  while($get_row=sqlsrv_fetch_array($get_pending_run))
                  {
              ?>
              <tr>
                  <td><?=$sr;?></td>
                  <td onclick="show_timeline_show_application(<?=$get_row['TokenNo'];?>);"><a href="#"><B
                              class="text-primary"><?=$get_row['TokenNo'];?></B></a></td>
                  <td><?=$get_row['SubmitDate']->format('d-m-Y');?></td>
                  <td><?=$get_row['Subject'];?></td>
              </tr>
              <?php $sr++; }?>
          </tbody>
      </table>
      <?php 
       sqlsrv_close($conntest);
  }
      else if($code==7) // completed complaint
        {
        
         ?>
      <table class="table" id="example">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Complain No</th>
                  <th>Complaint Date</th>
                  <th>Title</th>
              </tr>
          </thead>
          <tbody>
              <?php  
              $sr=1; $get_pending="SELECT StudentGrievance.TokenNo,
    MAX(StudentGrievance.SubmitDate) AS SubmitDate,
    MAX(StudentGrievance.Subject) AS Subject,
    MAX(StudentGrievanceTrack.Action) AS Action,
    MAX(StudentGrievanceTrack.EmployeeId) AS EmployeeId FROM  StudentGrievance INNER JOIN   StudentGrievanceTrack ON  StudentGrievance.TokenNo = StudentGrievanceTrack.TokenNo WHERE StudentGrievanceTrack.Action = '2' AND StudentGrievanceTrack.EmployeeId = '$EmployeeID' GROUP BY StudentGrievance.TokenNo;"; 
                  $get_pending_run=sqlsrv_query($conntest,$get_pending);
                  while($get_row=sqlsrv_fetch_array($get_pending_run))
                  {
              ?>
              <tr>
                  <td><?=$sr;?></td>
                  <td onclick="show_timeline_show_application(<?=$get_row['TokenNo'];?>);"><a href="#"><B
                              class="text-primary"><?=$get_row['TokenNo'];?></B></a></td>
                  <td><?=$get_row['SubmitDate']->format('d-m-Y');?></td>
                  <td><?=$get_row['Subject'];?></td>
              </tr>
              <?php $sr++; }?>
          </tbody>
      </table>
      <?php 
       sqlsrv_close($conntest);
  }
  elseif($code==8) // submit 
  {
    $TokenNo = isset($_POST['TokenNo']) ? $_POST['TokenNo'] : "";
     $roleID = isset($_POST['roleID']) ? $_POST['roleID'] : "";
     $staff_name = isset($_POST['staff_name']) ? $_POST['staff_name'] : "";
    $organisationName = isset($_POST['organisationName']) ? $_POST['organisationName'] : "";
    $departmentName = isset($_POST['departmentName']) ? $_POST['departmentName'] : "";
    $remakrs = isset($_POST['remakrs']) ? $_POST['remakrs'] : "";
     $employee_details="SELECT * FROM Staff Where IDNo='$staff_name'";
    $employee_details_run=sqlsrv_query($conntest,$employee_details);
    if ($employee_details_row=sqlsrv_fetch_array($employee_details_run,SQLSRV_FETCH_ASSOC)) {
       $Emp_NameTo=$employee_details_row['Name'];
       $Emp_DesignationTo=$employee_details_row['Designation'];
       $Emp_CollegeNameTo=$employee_details_row['CollegeName'];
       $Emp_DepartmentTo=$employee_details_row['Department'];
    }
  $status_update_after_forward="UPDATE StudentGrievance SET Status='1' where TokenNo='$TokenNo'";
  sqlsrv_query($conntest,$status_update_after_forward);
  $set_status_4="SELECT TOP(1)* FROM StudentGrievanceTrack WHERE TokenNo='$TokenNo' ORDER BY ID DESC";
  $set_status_4_run=sqlsrv_query($conntest,$set_status_4);
  if ($set_status_4_run === false) {
    $errors = sqlsrv_errors();
    echo "Error: " . print_r($errors, true);
    // echo "0"; 
} 
  if($set_status_4_run_row=sqlsrv_fetch_array($set_status_4_run))
  {
      $action_update_after_forward="UPDATE StudentGrievanceTrack SET ForrwardToId='$staff_name',ForwardToName='$Emp_NameTo',ForwardToDesignation='$Emp_DesignationTo',ForwardToCollege='$Emp_CollegeNameTo',ForwardToDepartment='$Emp_DepartmentTo', EmployeeRemarks='$remakrs',ForwardDateTime='$timeStamp', Action='1' where TokenNo='$TokenNo' and ID='".$set_status_4_run_row['ID']."'";
      $insert_request_process_run=sqlsrv_query($conntest,$action_update_after_forward);
      if($insert_request_process_run==true)
      {
        $insertNewRecord="INSERT into  StudentGrievanceTrack (TokenNo,EmployeeId,EmployeeName,EmployeeDesignation,EmployeeCollege,EmployeeDepartment,Action)
        VALUES('$TokenNo','$staff_name','$Emp_NameTo','$Emp_DesignationTo','$Emp_CollegeNameTo','$Emp_DepartmentTo','0')";
        sqlsrv_query($conntest,$insertNewRecord);
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
      sqlsrv_close($conntest);
   }
   elseif($code==9)
   {
   $userId=$_POST['userId'];
   $TokenNo=$_POST['token'];
   $forward_remarks=$_POST['forward_remarks'];
    $action_update_after_forward="UPDATE StudentGrievanceTrack SET Action='2',EmployeeRemarks='$forward_remarks' where TokenNo='$TokenNo' and EmployeeId='$EmployeeID'";
    $insert_request_process_run1= sqlsrv_query($conntest,$action_update_after_forward);
    $status_update_after_forward="UPDATE StudentGrievance SET Status='2' where TokenNo='$TokenNo'";
       $insert_request_process_run= sqlsrv_query($conntest,$status_update_after_forward);
        if ( $insert_request_process_run==$insert_request_process_run1) 
        {
        echo "1";   // success
        }
        else
        {
           echo "0"; // error
        }
     sqlsrv_close($conntest);
   } 

   }