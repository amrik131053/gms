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
        <!-- <h6>Registration Form </h6> -->
      <input type="hidden" id="CollegeID_Set">
      <div class="card-tools">
        <div class="input-group ">
          
          <input type="search" class="form-control form-control-sm" name="emp_name" id="empid" placeholder="Roll No Here">
          <div class="input-group-append">
            <button type="button" onclick="searchExamFroms();" class="btn btn-success btn-sm">
              <i class="fa fa-search"></i>
            </button>
      </button>
          </div>
        </div>
      </div>
      <!-- /.card-tools -->
               </div>
              
                  <div class="card-body" >
       <div class="card-body table-responsive" id="allForms">          

         </div>

            </div>

        </div>
    </div>

    
      
   </div>

   </div>

</section>



<script>


function searchExamFroms()
          {
           
       var code=264;
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
               document.getElementById("allForms").innerHTML=response;
            }
         });
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