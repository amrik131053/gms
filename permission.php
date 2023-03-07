<?php 
   include "header.php";   
   ?> 
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <div class="row">
                  <div class="col-lg-4">
                     <h3 class="card-title">Assign Role/Permission /</h3>
                  </div>
                  <div class="col-lg-4">
                     <input type="text" class="form-control" required="" id="user_id" placeholder="EmpID">
                  </div>
                  <div class="col-lg-2">
                     <button type="button" class="btn btn-info" onclick="emp_role()">Search</button>
                  </div>
                  <div class="col-lg-2">
                     <button type="button" class="btn btn-info" onclick="role_drop()" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Assign Role</button>
                  </div>
               </div>
            </div>
            <!-- /.card-header -->
            <div class="row">
               <div class="col-lg-6">
                  <div class="card-body table-responsive  " id="role_assign" style="height: 600px;">
                     <!-- /.card-body -->
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="card-body table-responsive  " id="permission_assign" style="height: 600px;">
                     <!-- /.card-body -->
                  </div>
               </div>
            </div>
            <!-- /.card -->
         </div>
         <!-- /.card -->
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div id="role_drop_dwon">
         <form action="action.php" method="post">
         
      </form>
      </div>
      </div>
   </div>
</div>
<?php include "footer.php";  ?>