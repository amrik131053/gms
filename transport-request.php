<?php 

include "header.php";
 ?>
 <script type="text/javascript">

      function emp_detail_verify(id)
      {
   var code=51;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,
            },
            success:function(response) 
            {  
              
                   document.getElementById("emp_detail_status_").innerHTML =response;
               
               
            }
         });
      }     

function create_request()
{
  var type = document.getElementById("type").value;
  var from = document.getElementById("from").value;
  var to = document.getElementById("to").value;
  var station = document.getElementById("station").value;
  var purpose = document.getElementById("purpose").value;
  if (station!='' && purpose!='' ) {
 var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
     
           var code=39; 
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,type:type,from:from,to:to,station:station,purpose:purpose
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                  // console.log(response);
                if (response==1) {
                  SuccessToast('Success');
                  $("#createRequestModal").modal('hide');
                  my_transport_request();
                }
                else if(response==2)
                {
                   ErrorToast('Vehicle not available on this date and time','bg-warning');
                   // $("#createTaskModal").modal('hide');
                  // my_task();
                }
                 else if(response==3)
                {
                   ErrorToast('Please Set your Flow ','bg-warning');
                   // $("#createTaskModal").modal('hide');
                  // my_task();
                }
                else
                {
                  ErrorToast('Please try after some time ','bg-danger');
                }
                
              }
           });
         }
         else
         {
                            ErrorToast('All Inputs Required','bg-warning');

         }
}



function my_transport_request()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=40;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("data_show").innerHTML=response;
              }
           });
} 

function view_request_submit(Token_No)
{
 // alert(Token_No);
 var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=47;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,Token_No:Token_No
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("view_timeline_data").innerHTML=response;
              }
           });
}

window.onload = function() {
  my_transport_request();
};
 
function check_availablity()
 {
                 $('#purpose_div').hide();
 var type=document.getElementById('type').value;
 var from=document.getElementById('from').value;
 var to=document.getElementById('to').value;
 if (from!='' && to!='' && type!='') {
 var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';

           var code=76;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,type:type,from:from,to:to
              },
              success: function(response) 
              {
               
                  spinner.style.display='none';
                 document.getElementById("booking_table").innerHTML=response;
                 
              }
           });
         }
         else
         {
          ErrorToast('All Input Required','bg-warning');
         }
}

function show_purpose_div()
 {
  $('#purpose_div').show();
 var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=77;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
               
                  spinner.style.display='none';
                 document.getElementById("purpose_div").innerHTML=response;
              }
           });
}

 </script>

                  <div class="modal fade" id="ViewRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Task Timeline</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

                      <div class="modal-body" id="view_timeline_data" style="font-size:15px !important;">
                           

                      </div>
                      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary" onclick="forward_task();">Submit</button> -->
      </div>
                    </div>
                  </div>
                  </div>



<!-- Modal -->
<div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">New Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                      <div class="modal-body">
                          
                       <div class="row">
                         <div class="col-lg-2">
                          <label>Type of Vehicle</label>
                             <select class="form-control" id="type" >
            <option value="">Select</option>
            <?php  $get_type="SELECT * FROM vehicle_types";
              $get_type_run=mysqli_query($conn,$get_type);
              while($row=mysqli_fetch_array($get_type_run))
              {?>
            <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
            <?php 
              }
             ?>
          </select>
                         </div>
                           <div class="col-lg-4">
                           <label>From Date/Time</label>
                           <input type="datetime-local" class="form-control" id="from">
                         </div>
                         <div class="col-lg-4">
                           <label>To Date/Time</label>
                           <input type="datetime-local" class="form-control" id="to">
                         </div>
                          <div class="col-lg-2">
                           <label>&nbsp;</label><br>
                          <input type="button" class="btn btn-primary" onclick="check_availablity();" value="Search">
                         </div>
                       </div>
                       <div class="row"><br>
                       </div>
                       <div class="row" id="booking_table" >
                    
                       </div>
                       <div class="row" id="purpose_div" >
                       
                       </div>

                   

                      
                    </div>

      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="create_request();">Submit</button>
      </div> -->
    </div>
  </div>
</div>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

        <div class="card-header">

          <h3 class="card-title" style="font-family: baskvill ;"><i>All Requests</i></h3>

          <div class="card-tools">
          <button type="button" data-toggle="modal" data-target="#createRequestModal" class="btn btn-primary" >
            Request <i class="fa fa-plus " aria-hidden="true"></i>
            </button> 
           
          </div>
        </div>
       
        <div class="card-body table-responsive " id="data_show">
      
        </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <?php 


include "footer.php";


?>