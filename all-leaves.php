<?php 
   include "header.php";  
   include "connection/connection.php"; 

   ?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <!-- Button trigger modal -->
         <div class="col-lg-12 col-md-12 col-sm-12">
         
  <div class="card card-outline">
    <div class="card-header">
      <h3 class="card-title">Leaves</h3>
     
     
      <!-- <button type="button" onclick="addNewStaff();" class="btn btn-success btn-xs ">
     Add New Staff
      </button> -->
      <input type="hidden" id="CollegeID_Set">
      <div class="card-tools">
        <div class="input-group ">
       
             <input type="month" id="from" class="form-control form-control-sm">

  
          <input type="search" class="form-control form-control-sm" name="emp_name" id="empid" placeholder="Emp ID Here">
          <div class="input-group-append">
            <button type="button" onclick="search_leave_employee();" class="btn btn-success btn-sm">
              <i class="fa fa-search"></i>
            </button>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            <button type="button" onclick="exportEmployeeLeave();" class="btn btn-success btn-sm ">
        <i class="fa fa-file-excel"></i>
      </button>
          </div>
        </div>
      </div>
      <!-- /.card-tools -->
 
               </div>
              
                  <div class="card-body" >
       <div class="card-body table-responsive">          
<table class="table" style="font-size: " >

  <thead>
         
                  <tr>
          <th>Sr. No</th>
          <th>Employee</th>
          <th>Start Date</th>
          <th>	End Date</th>
           <th>Type</th>
          <th>Count</th>
           <th>Reason</th>  
          
          <th>Status</th>
          <th>Action</th>
       
         </tr>
         </thead>
         <tbody style="height:1px" id="table_load" ></tbody> 
         </table>
         </div>

            </div>

        </div>
    </div>

    
      
   </div>

   </div>

</section>



<script>
    load_leave_data();
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
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }
function search_leave_employee()
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

                console.log(response);
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

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

                console.log(response);
               spinner.style.display='none';
               document.getElementById("view_leave_table_load").innerHTML=response;
            }
         });

     }
</script>
<p id="ajax-loader"></p>

<div class="modal fade" id="ViewLeaveexampleModal" tabindex="-1" role="dialog" aria-labelledby="ViewLeaveexampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
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
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>
<?php
   include "footer.php"; 
   
    ?>