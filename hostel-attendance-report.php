<?php 

  include "header.php";
  // $array[]=''; 
 $permissionCount=0;
$permission_qry="SELECT * FROM category_permissions where employee_id='$EmployeeID' and is_admin='1'";
$permission_res=mysqli_query($conn,$permission_qry);
while($permission_data=mysqli_fetch_array($permission_res))
{
   $permissionCount++;
}
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-3" >
            <div class="card card-info" >
               <div class="card-header" style="background-color: #223260;">
                  <div class="row">
                     <div class="col-lg-1">
                        <h3 class="card-title">Reports</h3>
                     </div>
                     <div class="col-lg-11">
                        <div class="card-tools">
                           <div class="row">
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostel" id='hostel_id'  >
                                       <option value="">Select Hostel</option>
                                       <?php
                                       $hostelQry="SELECT * FROM building_master inner join hostel_permissions on hostel_permissions.building_master_id=building_master.ID where emp_id='$EmployeeID'";
                                       $hostelRes=mysqli_query($conn,$hostelQry);
                                       while($hostelData=mysqli_fetch_array($hostelRes))
                                       {
                                          ?>
                                          <option value="<?=$hostelData['ID']?>"><?=$hostelData['Name']?></option>
                                          <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              
                              <div class="col-lg-2">
                                 <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                       <button class="btn btn-outline-info" type="button">Start</button>
                                    </div>
                                    <input type="date" class="form-control" id="startMonthCalender" onchange="emptyEndDate()" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                       <button class="btn btn-outline-info" type="button">End</button>
                                    </div>
                                    <input type="date" id="endMonthCalender" class="form-control" onchange="dateCompare(this.value)" aria-describedby="basic-addon1">
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="studentCalenderAttendance(1,10,0)">Search</button>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="exportStudentCalenderAttendance()">Export</button>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    
                                    <?php $start=date('Y-m-d');?>
                                    <input type="button" class="btn btn-outline-warning btn-sm form-control" id='dailyAttendanceButton' onclick="dailyAttendance('<?=$start?>',this.value,1,10)"  value='Today'>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" data-toggle="modal" data-target="#apply_Leave_Modal" onclick="clearModal()" >Apply Leave</button>
                                 </div>
                              </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
                  <div class="card-body" >
                     <div class="row">
                        <div class="col-lg-12" id="student_attendance_data"></div>
                     </div>
                  </div>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="apply_Leave_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apply Student Leave</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
            <!-- <input type="hidden" name="code" value="88"> -->
            <div class="modal-body">
               <div class="row">
                  <div class="col-lg-4">
                     <div class="input-group-sm">
                        <label>Student Roll No.</label>
                        <input type="text" name="studentRollNo" id="studentRollNo" placeholder="Enter Class/Uni Roll No..." class="form-control">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="input-group-sm">
                        <label>Start Date</label>
                        <input type="date" class="form-control" id="startLeaveDate" onchange="emptyEndLeaveDate()" aria-describedby="basic-addon1">
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="input-group-sm">
                        <label>End Date</label>
                        <input type="date" class="form-control" id="endLeaveDate" onchange="dateLeaveCompare(this.value)" aria-describedby="basic-addon1">
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="input-group-sm">
                        <label>Leave Remark</label>
                        <textarea type="text" name="leaveRemark" id="leaveRemark" placeholder="Reason of leave..." class="form-control"></textarea>
                     </div>
                  </div>
                  <div class="col-lg-12" id="leaveAppliedFor" style="display: none;">  
                     
                  </div>
               </div>
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" onclick="applyLeave()" class="btn btn-primary">Save</button>
            </div>
      </div>
   </div>
</div>
    <p id="ajax-loader"></p>
   <script type="text/javascript">
      function hideShowTime(page,limit,type)
      {
            if (type=='Show Time') 
            {
               document.getElementById("hideShowButton").value='Hide Time'
               studentCalenderAttendance(page,limit,1);
            }
            else 
            {
               document.getElementById("hideShowButton").value='Show Time'
               studentCalenderAttendance(page,limit,0);
            }
            

      }
      function applyLeave() 
      {
         var startDate =document.getElementById("startLeaveDate").value;
         var endDate =document.getElementById("endLeaveDate").value;
         var leaveRemark =document.getElementById("leaveRemark").value;
         var studentRollNo =trim(document.getElementById("studentRollNo").value);
         if (startDate!='' & endDate!='' & leaveRemark!='' & studentRollNo!='') 
         {

         var code=98;
          $.ajax(
             {
                url:"action.php ",
                type:"POST",
                data:
                {
                   code:code,studentRollNo:studentRollNo,leaveRemark:leaveRemark,endDate:endDate,startDate:startDate
                },
                success:function(response) 
                {
                   document.getElementById("leaveAppliedFor").style.display='block';
                   document.getElementById("leaveAppliedFor").innerHTML =response;  
                }
             });
         }
         else
         {
            alert("Enter all values first...");
         }
      }
      function emptyEndDate() 
      {
               document.getElementById("endMonthCalender").value='';
      }
      function emptyEndLeaveDate() 
      {
               document.getElementById("endLeaveDate").value='';
      }
      function dateCompare(endDate)
      {
         var startDate=document.getElementById("startMonthCalender").value;
         if (startDate!='') 
         {
            if (startDate>endDate) 
            {
               alert("End Date must be greater then or equal to Start Date.");
               document.getElementById("endMonthCalender").value='';
            }
         }
         else
         {
            alert("Select Start Date...");
               document.getElementById("endMonthCalender").value='';
         }
      }
      function clearModal()
      {
         document.getElementById("startLeaveDate").value='';
         document.getElementById("endLeaveDate").value='';
         document.getElementById("leaveRemark").value='';
         document.getElementById("leaveAppliedFor").style.display='none';
         document.getElementById("studentRollNo").value='';
      }
      function dateLeaveCompare(endDate)
      {
         var startDate=document.getElementById("startLeaveDate").value;
         if (startDate!='') 
         {
            if (startDate>endDate) 
            {
               alert("End Date must be greater then or equal to Start Date.");
               document.getElementById("endLeaveDate").value='';
            }
            else
            {
               var studentRollNo=document.getElementById("studentRollNo").value;
               $.ajax(
             {
                url:"action.php ",
                type:"POST",
                data:
                {
                   code:97,studentRollNo:studentRollNo
                },
                success:function(response) 
                {
                  if (response) 
                  {
                     document.getElementById("leaveAppliedFor").style.display='block';
                   document.getElementById("leaveAppliedFor").innerHTML =response;  
                  }
                  else
                  {
                     alert("You can't apply leave for this student...");
                     emptyEndLeaveDate();
                  }

                   
                }
             });

            }
         }
         else
         {
            alert("Select Start Date...");
               document.getElementById("endLeaveDate").value='';
         }
      }
function studentCalenderAttendance(page,limit,type)
      {
        var code=93;
        // alert(page);
        var hostel=document.getElementById("hostel_id").value;
        var startDate=document.getElementById("startMonthCalender").value;
        var endDate=document.getElementById("endMonthCalender").value;
        // alert(startDate);
        // alert(endDate);
        if (hostel!='') 
        {
            if (startDate!='' & endDate!='') 
            {
               
              var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
                   $.ajax(
             {
                url:"action.php ",
                type:"POST",
                data:
                {
                   code:code,hostel:hostel,startDate:startDate,endDate:endDate,page_no:page,limit:limit,type:type
                },
                success:function(response) 
                {
                   spinner.style.display='none';
                   document.getElementById("student_attendance_data").innerHTML =response;  
                }
             });
             }
             else
             {
                alert("Select Dates.");
             }
         }
         else
         {
               alert("Select Hostel");
         }
      }
      function exportStudentCalenderAttendance()
      {

        var exportCode=12;
        var hostel=document.getElementById("hostel_id").value;
        var startDate=document.getElementById("startMonthCalender").value;
        var endDate=document.getElementById("endMonthCalender").value;
         // alert("export.php?exportCode="+exportCode+"&hostel="+hostel+"&startDate="+startDate+"&endDate="+endDate);
         if (hostel=='' || startDate=='' || endDate=='') 
         {
            alert("Select all values...");

         }
         else
         {
             var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
            window.location.href="export.php?exportCode="+exportCode+"&hostel="+hostel+"&startDate="+startDate+"&endDate="+endDate;
            setTimeout(function()
            {  
                spinner.style.display='none';
            }, 25000);
         }
        
          
      }
      function dailyAttendance(startDate,input,page,limit)
      {
        
          var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
         // alert(spinner);
        var hostel=document.getElementById("hostel_id").value;
        var endDate=startDate;
        if (input=='Absent') 
         {
            var code=94;
            document.getElementById('dailyAttendanceButton').value='Today';
         }
         else
         { 
            var code=93;
            document.getElementById('dailyAttendanceButton').value='Absent';
         }
               $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,hostel:hostel,startDate:startDate,endDate:endDate,input:input,page_no:page,limit:limit
            },
            success:function(response) 
            {
               spinner.style.display='none';
               document.getElementById("student_attendance_data").innerHTML =response;  
            }
         });
      }
      
   </script>
</section>
<?php include "footer.php"; 
?>