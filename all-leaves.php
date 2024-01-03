<?php 
   include "header.php";  
   include "connection/connection.php"; 

   ?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
  <div class="card card-outline">
    <div class="card-header">
   
      <div class="btn-group">
        
                    <button type="button" class="btn btn-default btn-sm"><b id="actionButtonValue"></b></button>
                    <button type="button" class="btn btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" onclick="manageLeaveBalance();">Leave Balance</a>
                      <a class="dropdown-item"onclick="load_leave_data();" >Manage Leaves</a>
                    </div>
                    &nbsp;
                    &nbsp;
                    &nbsp;
                   
                  </div>

                  <button type="button" class="btn btn-success btn-sm" onclick="empSyncFromStaffToLeave();"><i class="fa fa-retweet" aria-hidden="true"></i></button>
      <input type="hidden" id="CollegeID_Set">
      <div class="card-tools">
        <div class="input-group ">
       
             <input type="month" id="from" class="form-control form-control-sm">

  
          <input type="search" class="form-control form-control-sm" name="emp_name" id="empid" placeholder="Emp ID Here">
          <div class="input-group-append">
            <button type="button" onclick="search_leave_employee();" class="btn btn-success btn-sm">
              <i class="fa fa-search"></i>
            </button>
            <!-- &nbsp;
            &nbsp;
            &nbsp;
            &nbsp; -->
            <!-- <button type="button" onclick="exportEmployeeLeave();" class="btn btn-success btn-sm "> -->
        <!-- <i class="fa fa-file-excel"></i> -->
      </button>
          </div>
        </div>
      </div>
      <!-- /.card-tools -->
 
               </div>
              
                  <div class="card-body" >
       <div class="card-body table-responsive" id="leavebalacne">          

         </div>

            </div>

        </div>
    </div>

    
      
   </div>

   </div>

</section>



<script>

function editRow(button) {
        const row = button.closest('tr');
        const editableFields = row.querySelectorAll('.editable');
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
        editableFields.forEach(field => {
            field.contentEditable = true;
            field.classList.add('editing');
        });
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-block';
        cancelBtn.style.display = 'inline-block';
    }

    function saveRow(button,id) {
        var code=209;
        const row = button.closest('tr');
        const employeeId = id;
        const leave1 = row.querySelector('[data-field="Leave1"]').textContent;
        const leave2 = row.querySelector('[data-field="Leave2"]').textContent;
         const leave3 = row.querySelector('[data-field="Leave3"]').textContent;
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
        row.querySelectorAll('.editable').forEach(field => {
            field.contentEditable = false;
            field.classList.remove('editing');
        });
        editBtn.style.display = 'inline-block';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
        $.ajax({
            type: 'POST',
            url: 'action_g.php', 
            data: {
                code: code,
                employeeId: employeeId,
                leave1: leave1,
                leave2: leave2,
                 leave3: leave3,
            },
            success: function(response) {
               console.log(response);
            SuccessToast('Successfully Added');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function cancelEdit(button) {
        const row = button.closest('tr');
        const editableFields = row.querySelectorAll('.editable');
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
        editableFields.forEach(field => {
            field.contentEditable = false;
            field.classList.remove('editing');
        });
        editBtn.style.display = 'inline-block';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
    }


    load_leave_data();
function empSyncFromStaffToLeave()
          {
         var code=228;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,
                  },
            success: function(response) 
            {
              // console.log(response);
               spinner.style.display='none';

                   SuccessToast('Data synchronization successfully');

            }
         });

     }

function load_leave_data()
          {
         var code=203;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,
                  },
            success: function(response) 
            {
                // console.log(response);
               spinner.style.display='none';
               document.getElementById("leavebalacne").innerHTML=response;
               document.getElementById("actionButtonValue").innerHTML="Manage Leaves";
               $('#from').show('slow');
            }
         });

     }
function search_leave_employee()
          {
            var buttonActionValue=document.getElementById("actionButtonValue").innerHTML;
            if(buttonActionValue!='Leave Blance')
            {
       var code=204;
         var from=document.getElementById('from').value;
         var empid=document.getElementById('empid').value;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,from:from,empid:empid
                  },
            success: function(response) 
            {

                // console.log(response);
               spinner.style.display='none';
               document.getElementById("leavebalacne").innerHTML=response;
            }
         });
        }else
        {
            var code=208;
         var empid=document.getElementById('empid').value;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,empid:empid
                  },
            success: function(response) 
            {

                // console.log(response);
               spinner.style.display='none';
               document.getElementById("leavebalacne").innerHTML=response;
            }
         });

        }

     }
function viewLeaveModal(id)
          {

       var code=205;
        
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id
                  },
            success: function(response) 
            {

                // console.log(response);
               spinner.style.display='none';
               document.getElementById("view_leave_table_load").innerHTML=response;
            }
         });

     }

function deleteLeaveOne(LeaveID)
          {
            var a=confirm('Are you sure you want to delete  ');
   if (a==true) {
       var code=227;
        var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,LeaveID:LeaveID
                  },
            success: function(response) 
            {
   
               spinner.style.display='none';
               if(response==1)
               {
                  search_leave_employee();
                SuccessToast('SuccessFully Deleted');
               }
               else
               {
                ErrorToast('try again','bg-danger');
               }
            }
         });
      }

     }
function UpdateLeave()
          {
       var code=206;
       var LeaveID=document.getElementById('LeaveID').value;
        var StartDate=document.getElementById('StartDate').value;
        var EndDate=document.getElementById('EndDate').value;
        var ApplyDate=document.getElementById('ApplyDate').value;
        var LeaveType=document.getElementById('LeaveType').value;
        var LeaveDuration=document.getElementById('LeaveDuration').value;
        var LeaveReason=document.getElementById('LeaveReason').value;
        var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,LeaveID:LeaveID,StartDate:StartDate,EndDate:EndDate,ApplyDate:ApplyDate,LeaveType:LeaveType,LeaveDuration:LeaveDuration,LeaveReason:LeaveReason
                  },
            success: function(response) 
            {
                 console.log(response);
               spinner.style.display='none';
               if(response==1)
               {
                 viewLeaveModal(LeaveID);
                 search_leave_employee();
                SuccessToast('SuccessFully Updated');
               }
               else
               {
                ErrorToast('try again','bg-danger');
               }
            }
         });

     }
     function manageLeaveBalance()
          {

       var code=207;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
                  },
            success: function(response) 
            {

                // console.log(response);
               spinner.style.display='none';
               document.getElementById("leavebalacne").innerHTML=response;
               document.getElementById("actionButtonValue").innerHTML="Leave Blance";
               $('#from').hide('slow');
              
            }
         });

     }
     function show_text_box_pages(id)
  {
 var submenu = $('.page_submenu'+id).text();


 var link = $('.page_sublink'+id).text();

 var submenu = $('<input id="page_submenu'+id+'" class="form-control" type="text" value="' + submenu + '" />')

 var link = $('<input id="page_sublink'+id+'" class="form-control" type="text" value="' + link + '" />')

 $('#page_crose'+id).show();
  $('#page_check'+id).show();   
  $('#page_edit'+id).hide(); 
    $('#menu_label'+id).hide();
    $('#main_menu'+id).show();
 $('.page_submenu'+id).text('').append(submenu);
  $('.page_sublink'+id).text('').append(link);
  }



</script>
<p id="ajax-loader"></p>

<div class="modal fade" id="ViewLeaveexampleModal" tabindex="-1" role="dialog" aria-labelledby="ViewLeaveexampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ViewLeaveexampleModalLabel">View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_leave_table_load">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
       <button type="button" onclick="UpdateLeave();" class="btn btn-success">Update</button>

      </div>
    </div>
  </div>
</div>
<?php
   include "footer.php"; 
   
    ?>