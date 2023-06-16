<?php 

include "header.php";
 ?>
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




function allotment_by_allotment_auth()
 {
  var id=document.getElementById('time_line_id').value;
  // alert(id);
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var type=document.getElementById('type').value;
  var vehicle_name=document.getElementById('vehicle_name').value;
  var driver=document.getElementById('driver').value;
  // alert(id+token+userId+forward_remarks);
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
                  spinner.style.display='none';  
                 if (response==1) 
                 {
                    SuccessToast('Successfully Alloted');
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
function reject_by_allotment_auth() {

    var id=document.getElementById('time_line_id').value;
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var forward_remarks=document.getElementById('comment_approve').value;
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
                
                  spinner.style.display='none';
                  if (response==1) 
                 {
                    SuccessToast('Successfully Rejected');
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
    // alert(id);
var code=69;
$.ajax({
url:'action_g.php',
data:{id:id,code:code},
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
       
        <div class="card-body table-responsive " id="action_button" style="display:;">
      
          <div class="btn-group btn-group-toggle" data-toggle="buttons" id="action_button_dynamic">
          


            
               <!--    <label class="btn btn-warning  btn-xs ">
                    <input type="radio" name="options" onclick="toggleDiv_approve();" id="option_a1" autocomplete="off"> Approve
                  </label>
                  <label class="btn btn-danger btn-xs">
                    <input type="radio" name="options" onclick="toggleDiv_reject();" id="option_a2" autocomplete="off"> Reject
                  </label>
                  <label class="btn btn-success btn-xs">
                    <input type="radio" name="options" onclick="toggleDiv_allotment();" id="option_a3" autocomplete="off"> Allotment
                  </label>
                 -->
                </div>
                <textarea class="form-control " placeholder="Approved Remarks" rows="3" id="comment_approve" style="display:none;"></textarea>
                <input type="button"  class="btn btn-success btn-xs" id="btn_comment_approve" onclick="approve_by_allotment_auth();"  value="Submit" style="display:none;">


                <textarea class="form-control " rows="3" placeholder="Rejected Remarks" id="comment_reject" style="display:none;"></textarea>
                 <input type="button"  class="btn btn-success btn-xs" id="btn_comment_reject" onclick="reject_by_allotment_auth();"  value="Submit" style="display:none;">
<div class="row">
     <div class="col-lg-12" id="comment_allotment" style="display:none;">
                          <label>Type of Vehicle</label>
                             <select class="form-control"onchange="drop_type_vehicle(this.value);" id="type" >
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
                          <label> Vehicle</label>

          <select class="form-control" id="vehicle_name" >
           
          </select>
                          <label> Driver Name</label>

          <select class="form-control" id="driver" >
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
                 <input type="button"  class="btn btn-success btn-xs" id="btn_comment_allotment" onclick="allotment_by_allotment_auth();"  value="Submit" style="display:none;">
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