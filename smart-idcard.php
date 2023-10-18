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
   
      <div class="btn-group ">
        
                  <select class="form-control form-control-sm" id="statusForIdCard">
<option value="">Select</option>

                    <?php 
                    $dropdown="SELECT DISTINCT status FROM SmartCardDetails ";
                    $dropdownRun=sqlsrv_query($conntest,$dropdown);
                    while ($row=sqlsrv_fetch_array($dropdownRun)) {
                  ?>
<option value="<?=$row['status'];?>"><?=$row['status'];?></option>
                  <?php
                    }

                     ?>
                    
                  </select>
                  &nbsp;
                  &nbsp;

                  <input type="date" class="form-control form-control-sm" id="fromDateForIdCard">
                  &nbsp;

                  &nbsp;

                  <input type="date" class="form-control form-control-sm" id="toDateFromIdCard">


                  </div>
                  <!-- <button type="button" class="btn btn-success btn-sm" onclick="empSyncFromStaffToLeave();"><i class="fa fa-retweet" aria-hidden="true"></i></button> -->
    
      <div class="card-tools">
        <div class="input-group ">
      
  
          <input type="search" class="form-control form-control-sm" name="emp_name" id="empid" placeholder="RollNo Here">
          <div class="input-group-append">
            <button type="button" onclick="searchStudentForIDcard();" class="btn btn-success btn-sm">
              <i class="fa fa-search"></i>
            </button>
           
    
          </div>
        </div>
      </div>
      <!-- /.card-tools -->
 
               </div>
              
                  <div class="card-body table-responsive" id="" >
      

            </div>

        </div>
    </div>

    
      
   </div>

   </div>

</section>



<script>



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