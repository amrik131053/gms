<?php 

include "header.php";
 ?>
 <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
 <script type="text/javascript">

      function pending_requests()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=44;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification_allot").innerHTML=response;
              }
           });
}
function forwarded_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=45;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification_allot").innerHTML=response;
              }
           });
}
function rejected_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=46;
           $.ajax({
              url:'action_g.php',
              type:'POST', 
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification_allot").innerHTML=response;
              }
           });
}
function alloted_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=70;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification_allot").innerHTML=response;
              }
           });
}
    
function show_timeline_verification_alott(token)
 {
     var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=47;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,Token_No:token
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("timeline_allotment").innerHTML=response;
                 // $('#action_button').show('slow');
                 show_action_button_with_status(token);

              }
           });
}

function show_action_button_with_status(token)
 {
     
           var code=72;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,Token_No:token
              },
              success: function(response) 
              {
                  
                 document.getElementById("action_button_dynamic").innerHTML=response;
              }
           });
}

 function emp_detail_verify(id)
 {
     
           var code=138;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                  
                 document.getElementById("emp_detail_status_").innerHTML=response;
              }
           });
}



function allotment_by_allotment_auth(id)
 {
  var id=document.getElementById('time_line_id').value;
  // alert(id);
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var type=document.getElementById('type').value;
  var vehicle_name=document.getElementById('vehicle_name').value;
  var driver=document.getElementById('driver').value;
  var empID_self=document.getElementById('empID_self').value;
  var driver=driver+empID_self;
  // alert(id+token+userId+forward_remarks);
  if (vehicle_name!='Not' && driver!='') 
  {
    var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=68;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id,userId:userId,token:token,type:type,vehicle_name:vehicle_name,driver:driver
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';  
                 if (response==1) 
                 {
                    SuccessToast('Successfully Alloted');
                 show_timeline_verification_alott(token);
                  pending_requests();
                 }
                 else
                 {
                    ErrorToast('Try Again','bg-danger');
                 }
                 

              }
           });
       }
       else if(vehicle_name=='Not')
       {
        ErrorToast('Vehicle Not Available','bg-danger');
       }
       else
       {
        ErrorToast('Select All Required Inputs','bg-warning');
       }
}
function reject_by_allotment_auth() {

    var id=document.getElementById('time_line_id').value;
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var forward_remarks=document.getElementById('comment_reject').value;
 
    var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=49;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id,userId:userId,token:token,forward_remarks:forward_remarks
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                  if (response==1) 
                 {
                    SuccessToast('Successfully Rejected');
                  show_timeline_verification_alott(token);
                  pending_requests();
                 }
                 else
                 {
                    ErrorToast('Try Again','bg-danger');
                 }
                 
                
              }
           });
   
}
function approve_by_allotment_auth()
 {
     
  var id=document.getElementById('time_line_id').value;
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var forward_remarks=document.getElementById('comment_approve').value;
    var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=48;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id,userId:userId,token:token,forward_remarks:forward_remarks
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                  if (response==1) 
                 {
                    SuccessToast('Successfully Approved');
                  show_timeline_verification_alott(token);
                  pending_requests();
                 }
                 else
                 {
                    ErrorToast('Try Again','bg-danger');
                 }
                 

                 
              }
           });
}
 function toggleDiv_approve() {
     $('#comment_reject').hide();
     $('#btn_comment_reject').hide();

      $('#comment_allotment').hide('slow');
     $('#btn_comment_allotment').hide('slow');

     $('#comment_approve').show('slow');
     $('#btn_comment_approve').show('slow');

    }
     function toggleDiv_reject() {
     $('#comment_approve').hide();
     $('#btn_comment_approve').hide();
      $('#comment_allotment').hide('slow');
     $('#btn_comment_allotment').hide('slow');

     $('#comment_reject').show('slow');
     $('#btn_comment_reject').show('slow');
    } 
      function toggleDiv_allotment() {
     $('#comment_approve').hide();
     $('#btn_comment_approve').hide();
     $('#comment_reject').hide('slow');
     $('#btn_comment_reject').hide('slow');

     $('#comment_allotment').show('slow');
     $('#btn_comment_allotment').show('slow');


    }

    function drop_type_vehicle(id) 
{  
   var journey_start_date=document.getElementById('journey_start_date').value; // alert(id);
   var journey_end_date=document.getElementById('journey_end_date').value; // alert(id);
var code=69;
$.ajax({
url:'action_g.php',
data:{id:id,code:code,journey_start_date:journey_start_date,journey_end_date:journey_end_date},
type:'POST',
success:function(data){
if(data != "")
{
    console.log(data);
$("#vehicle_name").html("");
$("#vehicle_name").html(data);
}
}
});

}

window.onload = function() {
  pending_requests();
};


function bydriver()
{
   $('#driver_div').show('Slow');
   $('#self_div').hide('Slow');
   document.getElementById('empID_self').value="";
   document.getElementById('emp_detail_status_').innerHTML="";

    }
    function selfdrive()
    {
     
   $('#self_div').show('Slow');
   $('#driver_div').hide('Slow');
    document.getElementById('driver').value="Select";

    }


 </script>


    <!-- Main content -->
    <section class="content">

<div class="row">
  <div class="col-lg-4">
       <div class="card">

        <div class="card-header">

          <h3 class="card-title">All Requests</h3>

          <div class="card-tools">
         
           
          </div>
        </div>
       <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active"  data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" onclick="pending_requests();">
                       Pending</a>
                     </li>
                   
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="forwarded_requests();">
                      Forward</a>
                     </li> 
                    
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="alloted_requests();">
                        Allotted</a>
                     </li> 
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="rejected_requests();">
                        Reject</a>
                     </li>
                  </ul>
        <div class="card-body table-responsive " id="verification_allot" style="height:400px;">
      
        </div>
        
      </div>
  </div>
  <div class="col-lg-6">
       <div class="card" >

        <div class="card-header">

          <h3 class="card-title">Details</h3>

          <div class="card-tools">
          
           
          </div>
        </div>
       
        <div class="card-body table-responsive " id="timeline_allotment" style="height:440px;font-size: 12px!important;" >
     
        </div>
        
      </div>
  </div>
  <div class="col-lg-2">
<div class="card">

        <div class="card-header">

          <h3 class="card-title">Action</h3>

          <div class="card-tools">
          
           
          </div>
        </div>
       
        <div class="card-body table-responsive " id="action_button_dynamic"  style="height:440px;">
        
          </div>
        
      </div>
  </div>
</div>

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <?php 


include "footer.php";


?>