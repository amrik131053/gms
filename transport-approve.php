<?php 

include "header.php";
 ?>
 <script type="text/javascript">

                 function pending_requests()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=65;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification_approve").innerHTML=response;
              }
           });
}
function approved_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=66;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification_approve").innerHTML=response;
              }
           });
}
function rejected_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=67;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification_approve").innerHTML=response;
              }
           });
}
function show_timeline_verification_approve(token)
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
                 document.getElementById("timeline_approve").innerHTML=response;
                 show_action_button_with_status(token);
              }
           });
}

function reject_by_approved_auth()
 {
  var id=document.getElementById('time_line_id').value;
  // alert(id);
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var forward_remarks=document.getElementById('comment_reject').value;
 // alert(id+token+userId+forward_remarks);
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
                console.log(response);
                  spinner.style.display='none';
                   if (response==1) 
                 {
                    SuccessToast('Successfully Rejected');
                  show_timeline_verification_approve(token);
                  pending_requests();
                 }
                 else
                 {
                    ErrorToast('bg-danger','Try Again');
                 }
                 
              }
           });
}
function approve_by_approved_auth()
 {
  // alert("jgjg");
  var id=document.getElementById('time_line_id').value;
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var forward_remarks=document.getElementById('comment_approve').value;
 // alert(id+token+userId+forward_remarks);
    var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=71;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id,userId:userId,token:token,forward_remarks:forward_remarks
              },
              success: function(response) 
              {
                console.log(response);
                  spinner.style.display='none';
                   if (response==1) 
                 {
                    SuccessToast('Successfully Approved');
                  show_timeline_verification_approve(token);
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

     $('#comment_approve').show('slow');
     $('#btn_comment_approve').show('slow');

    }
     function toggleDiv_reject() {
     $('#comment_approve').hide();
     $('#btn_comment_approve').hide();


     $('#comment_reject').show('slow');
     $('#btn_comment_reject').show('slow');
    }

    window.onload = function() {
  pending_requests();
};


function show_action_button_with_status(token)
 {
     
           var code=74;
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
                        <i class="fa fa-clock fa-lg text-warning"></i>&nbsp;&nbsp;Pending</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="approved_requests();">
                        <i class="fa fa-check fa-lg text-success"></i>&nbsp;&nbsp;Approved</a>
                     </li> 
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="rejected_requests();">
                        <i class="fa fa-times fa-lg text-danger"></i>&nbsp;&nbsp;Reject</a>
                     </li>
                  </ul>
        <div class="card-body table-responsive " id="verification_approve" style="height:400px;">
     
        </div>
        
      </div>
  </div>
  <div class="col-lg-6">
       <div class="card">

        <div class="card-header">

          <h3 class="card-title">Details</h3>

          <div class="card-tools">
          
           
          </div>
        </div>
       
        <div class="card-body table-responsive " id="timeline_approve" style="height:440px;">
      <!-- ---------- -->
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
        <div class="card-body table-responsive " id="action_button_dynamic" style="height:440px;" >

        </div>
      </div>
  </div>
</div>
      <!-- Default box -->
   
      <!-- /.card -->

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <?php 


include "footer.php";


?>