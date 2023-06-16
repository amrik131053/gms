<?php 

include "header.php";
 ?>
 <script type="text/javascript">
function pending_requests()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=41;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification").innerHTML=response;
              }
           });
}
function forwarded_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=42;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification").innerHTML=response;
              }
           });
}
function rejected_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=43;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("verification").innerHTML=response;
              }
           });
}
function show_timeline_verification(token)
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
                 document.getElementById("show_timeline_verification_div").innerHTML=response;
                 // $('#action_button').show('slow');
                 show_action_button_with_status(token);
              }
           });
}
function recommend_by_verify()
 {
  // alert(id);
  var id=document.getElementById('time_line_id').value;
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var forward_remarks=document.getElementById('comment_recommend').value;
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
                    SuccessToast('Successfully Recommended');
                  show_timeline_verification(token);
                  pending_requests();
                 }
                 else
                 {
                    ErrorToast('Try Again','bg-danger');
                 }
                 
              }
           });
}
function reject_by_verify()
 {
   var id=document.getElementById('time_line_id').value;
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var comment_reject=document.getElementById('comment_reject').value;

   var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=49;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id,userId:userId,comment_reject:comment_reject,token:token
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                  if (response==1) 
                 {
                    SuccessToast('Successfully Rejected');
                  show_timeline_verification(token);
                  pending_requests();
                 }
                 else
                 {
                    ErrorToast('Try Again','bg-danger');
                 }
                 
              }
           });

}
          
 
  window.onload = function() {
  pending_requests();
};

    function toggleDiv_recommend() {
     $('#comment_reject').hide();
     $('#btn_comment_reject').hide();

      $('#comment_recommend').show('slow');
     $('#btn_comment_recommend').show('slow');

    

    }
     function toggleDiv_reject() {
    
      $('#comment_recommend').hide('slow');
     $('#btn_comment_recommend').hide('slow');

     $('#comment_reject').show('slow');
     $('#btn_comment_reject').show('slow');
    } 

    function show_action_button_with_status(token)
 {
     
           var code=73;
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
                        <i class="fa fa-clock fa-lg text-success"></i>&nbsp;&nbsp;Pending</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="forwarded_requests();">
                        <i class="fa fa-share fa-lg text-warning"></i>&nbsp;&nbsp;Forwarded</a>
                     </li> 
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="rejected_requests();">
                        <i class="fa fa-times fa-lg text-danger"></i>&nbsp;&nbsp;Reject</a>
                     </li>
                  </ul>
        <div class="card-body table-responsive " id="verification" style="height:400px;">
      
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
       
        <div class="card-body table-responsive " id="show_timeline_verification_div" style="height:440px;">
    
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
       
        <div class="card-body table-responsive " id="action_button" style="display:">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" id="action_button_dynamic">
                 <!--  <label class="btn btn-warning  btn-xs ">
                    <input type="radio" name="options" onclick="toggleDiv_recommend();" id="option_a1" autocomplete="off"> Recommend
                  </label>
                  <label class="btn btn-danger btn-xs">
                    <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
                  </label>
                  -->
                
                </div>
                    <textarea class="form-control " placeholder="Recommend Remarks" rows="3" id="comment_recommend" style="display:none;"></textarea>
                <input type="button"  class="btn btn-success btn-xs" id="btn_comment_recommend" onclick="recommend_by_verify();"  value="Submit" style="display:none;">


                <textarea class="form-control " rows="3" placeholder="Rejected Remarks" id="comment_reject" style="display:none;"></textarea>
                 <input type="button"  class="btn btn-success btn-xs" id="btn_comment_reject" onclick="reject_by_verify();"  value="Submit" style="display:none;">
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