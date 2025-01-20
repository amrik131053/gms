<?php 

include "header.php";
 ?>
 <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
 <script type="text/javascript">

      function pending_requests()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=1;
           $.ajax({
              url:'action_b.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("all_requests_show").innerHTML=response;
              }
           });
}
function forwarded_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=6;
           $.ajax({
              url:'action_b.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("all_requests_show").innerHTML=response;
              }
           });
}
// function rejected_requests()
// {
//       var spinner=document.getElementById("ajax-loader");
//    spinner.style.display='block';
//            var code=46;
//            $.ajax({
//               url:'action_g.php',
//               type:'POST', 
//               data:{
//                  code:code
//               },
//               success: function(response) 
//               {
//                   spinner.style.display='none';
//                  document.getElementById("all_requests_show").innerHTML=response;
//               }
//            });
// }
function alloted_requests()
{
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=7;
           $.ajax({
              url:'action_b.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("all_requests_show").innerHTML=response;
              }
           });
}
    
function show_timeline_show_application(token)
 {
     var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=2;
           $.ajax({
              url:'action_b.php',
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
     
           var code=3;
           $.ajax({
              url:'action_b.php',
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
function getSelectedRadioValue() {
    var selectedValue = document.querySelector('input[name="empc121"]:checked').value;
    // console.log("Selected Radio Value:", selectedValue);
    return selectedValue;
}



function allotment_by_allotment_auth(TokenNo) {

    var postData = {};
    var remakrs = document.getElementById('remakrs').value.trim();
    var mode = getSelectedRadioValue();
    if (mode == 0) {
        var roleID = document.getElementById('roleID').value.trim();
        var staff_name = document.getElementById('staff_name').value.trim();

        if (!roleID || !staff_name) {
            ErrorToast('Please fill all required fields in mode 1', 'bg-warning');
            return;
        }

        postData = {
            roleID: roleID,
            staff_name: staff_name
        };
    } else {
        var roleID = 0;
        var organisationName = document.getElementById('organisationName').value.trim();
        var departmentName = document.getElementById('departmentName').value.trim();
        var staff_name = document.getElementById('staff_name').value.trim();


        if (!organisationName || !departmentName || !staff_name) {
            ErrorToast('Please fill all required fields in mode 2', 'bg-warning');
            return;
        }

        postData = {
            organisationName: organisationName,
            departmentName: departmentName,
            staff_name: staff_name
        };
    }

    if (!staff_name || !remakrs) {
        ErrorToast('Select All Required Inputs', 'bg-warning');
        return;
    }
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 8;
    $.ajax({
    url: 'action_b.php',
    type: 'POST',
    data: {
        code:code,
        TokenNo: TokenNo,
        roleID: roleID,
        staff_name: staff_name,
        organisationName: organisationName,
        departmentName: departmentName,
        remakrs: remakrs
    },
    success: function (response) {
        spinner.style.display = 'none';
        console.log(response);
        if (response == 1) {
    SuccessToast('Successfully Alloted');
    show_timeline_show_application(TokenNo);
    pending_requests();
} else {
    ErrorToast('Try Again', 'bg-danger');
}
    }
});
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
                  show_timeline_show_application(token);
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
     
  var token=document.getElementById('time_line_token').value;
  var userId=document.getElementById('time_line_userId').value;
  var forward_remarks=document.getElementById('comment_approve').value;
    var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=9;
           $.ajax({
              url:'action_b.php',
              type:'POST',
              data:{
                 code:code,userId:userId,token:token,forward_remarks:forward_remarks
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                  if (response==1) 
                 {
                    SuccessToast('Successfully Replied');
                  show_timeline_show_application(token);
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
    function fetchDepartment(CollegeId)
{   
   
var code='96';
$.ajax({
url:'action_g.php',
data:{CollegeId:CollegeId,code:code},
type:'POST',
success:function(data){
if(data != "")
{
   //   console.log(data);
$("#departmentName").html("");
$("#departmentName").html(data);
}
}
});

}
    function drop_type_emp(id) 
{  
   
var code=4;
$.ajax({
url:'action_b.php',
data:{id:id,code:code},
type:'POST',
success:function(data){
if(data != "")
{
    // console.log(data);
$("#staff_name").html("");
$("#staff_name").html(data);
}
}
});

}
    function drop_type_emp_dep(id) 
{  
   
var code=5;
$.ajax({
url:'action_b.php',
data:{id:id,code:code},
type:'POST',
success:function(data){
if(data != "")
{
$("#staff_name").html("");
$("#staff_name").html(data);
}
}
});

}

window.onload = function() {
  pending_requests();
};


function bydriver()
{
   $('#role_div').show('Slow');
   $('#self_div').hide('Slow');
   

   document.getElementById('staff_name').value="";
   document.getElementById('organisationName').value="";
   document.getElementById('departmentName').value="";
}
function selfdrive()
{
    
    $('#self_div').show('Slow');
    $('#role_div').hide('Slow');
    document.getElementById('roleID').value="";
    }

    function seachReport() {
    var fromDateForIdCard = document.getElementById("fromDateForIdCard").value;
    var toDateFromIdCard = document.getElementById("toDateFromIdCard").value;
    if (fromDateForIdCard != '' && toDateFromIdCard!='') {
    
        window.open("export.php?exportCode="+68+"&from="+fromDateForIdCard+"&to="+toDateFromIdCard, '_blank');
    } else {
        ErrorToast('Please Select status/date', 'bg-warning');

    }

           }









 </script>


    <!-- Main content -->
    <section class="content">

<div class="row">
  <div class="col-lg-4">
       <div class="card">

        <div class="card-header">

          <h3 class="card-title">All Requests</h3>
          <div class="btn-group ">
                            
                          
                            <!-- <input type="date" class="form-control form-control-sm" id="fromDateForIdCard">
                            &nbsp;
                            &nbsp;
                            <input type="date" class="form-control form-control-sm" id="toDateFromIdCard">
                            <div class="input-group-append">
                               &nbsp;
                               &nbsp;
                               <button type="button" onclick="seachReport();"
                                  class="form-control form-control-sm bg-success">
                               Export
                               </button>
                           
                              
                            </div> -->
                         </div>
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
                        Completed</a>
                     </li> 
                    
                  </ul>
        <div class="card-body table-responsive " id="all_requests_show">
      
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
       
        <div class="card-body table-responsive " id="timeline_allotment" style="font-size: 12px!important;" >
     
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
       
        <div class="card-body table-responsive " id="action_button_dynamic"  >
        
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