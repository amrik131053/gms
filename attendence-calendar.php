<?php 
  include "header.php";   
?>  

    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card card-primary">
              <!-- <div > -->
                <!-- THE CALENDAR -->
                <div class="btn-group w-100 mb-2">
                    <a class="btn btn-primary"  id="btn11" style="background-color:#223260; color: white; border: 5px solid;" onclick="showCalendar(),bg(this.id);"> Calendar </a>
                     <a class="btn btn-primary" id="btn22"style="background-color:#223260; color: white; border: 5px solid;" onclick="showApplyLeave(),bg(this.id);"> Apply Leave </a>
                    <a class="btn btn-primary" id="btn33" style="background-color:#223260; color: white; border: 5px solid;" onclick="showReport(),bg(this.id);"> Report </a>
                  </div>
                <div class="card-body table-responsive-lg pd" id="calendar" style=" padding:0px!important;">
              
                </div>
              <!-- </div> -->
         
            </div>
    
          </div>

           <div class="col-md-4">
<?php 
$ifLeaveAuth="SELECT * FROM Staff Where LeaveRecommendingAuthority='$EmployeeID' or  LeaveSanctionAuthority='$EmployeeID'";
$stmt=sqlsrv_query($conntest,$ifLeaveAuth,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$laveAuthCount=sqlsrv_num_rows($stmt);
if($laveAuthCount>0)
{
?>
   <div class=" card card-primary">
        <div class="btn-group w-100 mb-2">
                    <a class="btn btn-primary"  id="btn111" style="background-color:#223260; color: white; border: 1px solid;" onclick="pendingLeavesAuth(),bg(this.id);">Pending  </a>
                     <a class="btn btn-primary" id="btn222"style="background-color:#223260; color: white; border: 1px solid;" onclick="approvedLeavesAuth(),bg(this.id);"> Approved </a>
                    <a class="btn btn-primary "  id="btn333" style="background-color:#223260; color: white; border: 1px solid;" onclick="rejectLeavesAuth(),bg(this.id);"> Reject </a>
                    <a class="btn btn-primary " id="btn444" style="background-color:#223260; color: white; border: 1px solid;" onclick="forwardedLeavesAuth(),bg(this.id);"> Forward </a>
                
                  </div>

         <div  id="table_load_auth_leaves" class="" style="height:auto; font-size:12px; ">
        </div>
   </div>

<?php } ?>
     <div class=" card card-primary">
        <div class="btn-group w-100 mb-2">
                    <a class="btn btn-primary"  id="btn1" style="background-color:#223260; color: white; border: 5px solid;" onclick="pendingLeaves(),bg(this.id);"> Pending </a>
                     <a class="btn btn-primary" id="btn2"style="background-color:#223260; color: white; border: 5px solid;" onclick="approvedLeaves(),bg(this.id);"> Approved </a>
                    <a class="btn btn-primary" id="btn3" style="background-color:#223260; color: white; border: 5px solid;" onclick="rejectLeaves(),bg(this.id);"> Rejected </a>
                
                  </div>

         <div  id="table_load" class="table-responsive" style="height:auto; font-size:12px; ">
        </div>
<div class="text-center" id="div-loader">
<div class="spinner-border" role="status">
</div>
</div>

   
       
                </div>
              </div>
            </div> 
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
 
 
</div>


<div class="modal fade" id="ViewLeaveexampleModal" tabindex="-1" role="dialog" aria-labelledby="ViewLeaveexampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ViewLeaveexampleModalLabel">Leave Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_leave_table_load" style="padding:1px!important;">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="viewApprovedLeaveByAuth" tabindex="-1" role="dialog" aria-labelledby="viewApprovedLeaveByAuthLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewApprovedLeaveByAuthLabel">Leave Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_leave_table_load_ApprovedByAuth" style="padding:1px!important;">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<?php   include "footer.php";   ;?>
<script>
    $(window).on('load', function() 
          {
         $('#btn1').toggleClass("bg-success"); 
         $('#btn11').toggleClass("bg-success"); 
         $('#btn111').toggleClass("bg-success"); 
         pendingLeaves();
         showCalendar();
         pendingLeavesAuth();
        
           })
  function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }
       function  pendingLeaves()
         {
         var code=217;
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
      }


         function approvedLeaves()
         {
          var code=218;
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
         }
      function rejectLeaves()
         {
          var code=219;
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
        }

        function  pendingLeavesAuth()
         {
         var code=229;
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load_auth_leaves").innerHTML=response;
            }
         });
      }
        function  approvedLeavesAuth()
         {
         var code=230;
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load_auth_leaves").innerHTML=response;
            }
         });
      }
        function  rejectLeavesAuth()
         {
         var code=231;
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load_auth_leaves").innerHTML=response;
            }
         });
      }
        function  forwardedLeavesAuth()
         {
         var code=233;
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load_auth_leaves").innerHTML=response;
            }
         });
      }
      

      function  approvedLeavesByAuthButton(id)
         {
         var code=234;
         var remarksForApproved=document.getElementById('remarksForApproved').value;
         if(remarksForApproved!='')
         {

         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id,remarks:remarksForApproved
            },
            success: function(response) 
            {
               spinner.style.display='none';
               if(response==1)
               {
                  SuccessToast('SuccessFully Recommend');
                  pendingLeavesAuth();
                  $('#remarksForApproved').removeClass("is-invalid");
                  $('#viewApprovedLeaveByAuth').modal('hide');
               }
               else
               {

               }
               

            }
         });
      }
      else
      {
         $('#remarksForApproved').toggleClass("is-invalid"); 
      }
      }
      function  recommendLeavesByAuthButton(id)
         {
         var code=235;
         var remarksForApproved=document.getElementById('remarksForApproved').value;
         if(remarksForApproved!='')
         {
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id,remarks:remarksForApproved
            },
            success: function(response) 
            {
               spinner.style.display='none';
               if(response==1)
               {
                  SuccessToast('SuccessFully Recommend');
                  pendingLeavesAuth();
                  $('#remarksForApproved').removeClass("is-invalid");
                  $('#viewApprovedLeaveByAuth').modal('hide');
               }
               else
               {

               }
               
               
            }
         });
      }
      else
      {
         $('#remarksForApproved').toggleClass("is-invalid"); 
      }
      }
      function  rejectLeavesByAuthButton(id)
         {
         var code=236;
         var remarksForApproved=document.getElementById('remarksForApproved').value;
         if(remarksForApproved!='')
         {
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id,remarks:remarksForApproved
            },
            success: function(response) 
            {
               // console.log(response);
               spinner.style.display='none';
               if(response==1)
               {

                  SuccessToast('SuccessFully Reject');
                  pendingLeavesAuth();
                  $('#remarksForApproved').removeClass("is-invalid");
                  $('#viewApprovedLeaveByAuth').modal('hide');
               }
               else
               {

               }
               
            }
         });
 
      }
         else
      {

         $('#remarksForApproved').toggleClass("is-invalid"); 
      }
      }
      function  rejectLeavesByAuthButtonRec(id)
         {
         var code=237;
         var remarksForApproved=document.getElementById('remarksForApproved').value;
         if(remarksForApproved!='')
         {
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id,remarks:remarksForApproved
            },
            success: function(response) 
            {
               spinner.style.display='none';
               if(response==1)
               {
                  SuccessToast('SuccessFully Reject');
                  pendingLeavesAuth();
                  $('#remarksForApproved').removeClass("is-invalid");
                  $('#viewApprovedLeaveByAuth').modal('hide');
               }

               else
               {

               }
               
            }
         });
      }
         else
      {
         $('#remarksForApproved').toggleClass("is-invalid"); 
      }
      }

      function  forwardToVCLeavesByAuthButton(id)
         {
         var code=238;
         var remarksForApproved=document.getElementById('remarksForApproved').value;
         if(remarksForApproved!='')
         {
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id,remarks:remarksForApproved
            },
            success: function(response) 
            {
               spinner.style.display='none';
               if(response==1)
               {
                  SuccessToast('SuccessFully Forward');
                  pendingLeavesAuth();
                  $('#remarksForApproved').removeClass("is-invalid");
                  $('#viewApprovedLeaveByAuth').modal('hide');
               }
               else
               {

               }
               
            }
         });
      }
         else
      {
          $('#remarksForApproved').toggleClass("is-invalid"); 
      }
      }
      function  approvedLeavesByAuthButtonVC(id)
         {
         var code=239;
         var remarksForApproved=document.getElementById('remarksForApproved').value;
         if(remarksForApproved!='')
         {
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id,remarks:remarksForApproved
            },
            success: function(response) 
            {
               console.log(response);
               spinner.style.display='none';
               if(response==1)
               {
                  SuccessToast('SuccessFully Approved');
                  pendingLeavesAuth();
                  $('#remarksForApproved').removeClass("is-invalid");
                  $('#viewApprovedLeaveByAuth').modal('hide');
               }
               else
               {

               }
               
            }
         });
      }
         else
      {
          $('#remarksForApproved').toggleClass("is-invalid"); 
      }
      }

      function  rejectLeavesByAuthButtonVC(id)
         {
         var code=240;
         var remarksForApproved=document.getElementById('remarksForApproved').value;
         if(remarksForApproved!='')
         {
         var spinner=document.getElementById('div-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id,remarks:remarksForApproved
            },
            success: function(response) 
            {
               console.log(response);
               spinner.style.display='none';
               if(response==1)
               {
                  SuccessToast('SuccessFully Reject');
                  pendingLeavesAuth();
                  $('#remarksForApproved').removeClass("is-invalid");
                  $('#viewApprovedLeaveByAuth').modal('hide');
               }

               else
               {

               }
               
            }
         });
      }
         else
      {
         $('#remarksForApproved').toggleClass("is-invalid"); 
      }
      }



        function viewLeaveModal(id)
          {
       var code=220;
        
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
        function viewLeaveModalApprovedByAuth(id)
          {
       var code=232;
        
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
               document.getElementById("view_leave_table_load_ApprovedByAuth").innerHTML=response;
            }
         });

     }
        function deleteLeave(id)
          {

            var a=confirm('Are you sure you want to delete');
  
  if (a==true) {
       var code=221;
        
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
              if(response==1)
              {
                spinner.style.display='none';
                SuccessToast('SuccessFully Deleted');
                pendingLeaves();
              }
            
            }
         });
        }
        else
        {

        }
     }

     function  showCalendar()
     {
      document.getElementById("calendar").innerHTML="";
    function ini_events(ele) {
      
      ele.each(function () {
        var eventObject = {
          title: $.trim($(this).text()) 
        }
        $(this).data('eventObject', eventObject)
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, 
          revertDuration: 0 
        })
      })
    }
 
    ini_events($('#external-events div.external-event'))
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    var Calendar = FullCalendar.Calendar;
    var containerEl = document.getElementById('external-events');
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
     left : '',
        center: 'title',
        right : ''
      },
      'themeSystem': 'bootstrap',
      events    : "fetch_Attendance.php", 
    }
    );
    calendar.render();
        }
    
     function showApplyLeave()
     {
      var code=222;
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
               spinner.style.display='none';
               document.getElementById("calendar").innerHTML=response;
            }
         });
     }
     function showReport()
     {
      var code=223;
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
               spinner.style.display='none';
               document.getElementById("calendar").innerHTML=response;
            }
         });
     }
function dateHideShow() 
{
  $("#SingleDate").hide();
  $("#StartDate").show();
  $("#EndDate").show();                            
  $("#DivLeaveShift").hide(); 
  document.getElementById("leaveDate").value="";                                             
}
function singleHideShow() 
{
 $("#SingleDate").show();
 $("#StartDate").hide();
 $("#EndDate").hide();    
 document.getElementById("leaveStartDate").value="";                
 document.getElementById("leaveEndDate").value="";                
 $("#DivLeaveShift").show();                    
}




function leaveSubmit(form) {

    var leaveType = form.LeaveType.value;
    var leaveShort = form.leaveShort.value;
    var leaveReason = form.leaveReason.value;
    var leaveFile = form.leaveFile.value;
    var leaveShift = form.leaveShift.value;
    var leaveHalfShortRadio = form.leaveHalfShortRadio.value;

    if (leaveType === "") {
       
        ErrorToast('Please select a Leave Type.','bg-warning');
        return;
    }
    if(leaveHalfShortRadio!='Full')
    {
    if (leaveShort === "") {
      
        ErrorToast('Please select a Leave Duration.','bg-warning');
        return;
    }
    if (leaveShift === "") {
        
        ErrorToast('Please select a Leave Shift F/S.','bg-warning');
        return;
    }
   }
    if (leaveReason.trim() === "") {
       
        ErrorToast('Please enter a Leave Reason.','bg-warning');
        return;
    }

    if (leaveFile === "") {
       
        ErrorToast('Please upload an Adjustment File.','bg-warning');
        return;
    }
   
    var submitButton = form.querySelector('input[name="leaveButtonSubmit"]');
    submitButton.disabled = true;
    submitButton.value = "Submitting...";

    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            if (response == 1) {
                SuccessToast('Leave submit successfully');
                pendingLeaves();
                document.getElementById("LeaveType").value="";
                document.getElementById("leaveShort").value="";
                document.getElementById("leaveReason").innerHTML="";
                
            }
            else if (response == 2)
             {
              ErrorToast('one leave already pending to Sanction authority.','bg-warning');
            }
            else if (response == 3)
             {
              ErrorToast("you can't apply back date leave.",'bg-warning');
            }
            else if (response == 4)
             {
              ErrorToast("you con't apply more than one leave same day ",'bg-warning');
            }
             else
              {
                ErrorToast('Please try after sometime.','bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        },
        complete: function() {
            submitButton.disabled = false;
            submitButton.value = "Submit";
        }
    });
}











  
  
</script>
</body>
</html>
