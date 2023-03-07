<?php 
   include "header.php";   
   ?>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-4 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Roles</h3>
               <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal" style="float: right;">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </button>
            </div>
            <div class="card-body">
               <div class="form-group row">
                  <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">Select Role</label>
                  <div class="col-lg-12">
                     <select class="form-control" name="role" id="role">
                        <option value="0">Select</option>
                        <?php 
                           $get_role="SELECT * FROM role_name";
                           $get_run=mysqli_query($conn,$get_role);
                           while ($get_row=mysqli_fetch_array($get_run))
                            {?>
                        <option value='<?=$get_row['id'];?>'><?=$get_row['role_name'];?></option>
                        ";
                        <?php }
                           ?>
                     </select>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-info" onclick="role_search()">Search</button>
            </div>
            <p id="error" style="display: none;"></p>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Users </h3>
            </div>
            <div class="card-body ">
               <div class="form-group row " id="role_all">
               </div>
            </div>
            <!-- /.card-footer -->
         </div>
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Permissions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive  " id="permissions" style="height: 600px;">
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form class="form-horizontal" action="action.php" method="POST">
            <div class="modal-body">
               <input type="hidden" name="code" value="109">
               <div class="card-body">
                  <div class="form-group row">
                     <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">Role Name</label>
                     <div class="col-lg-12">
                        <input type="text" class="form-control" required="" name="role" placeholder="role">
                     </div>
                  </div>
               </div>
               <!-- /.card-footer -->
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-success">Save changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
<?php include "footer.php";  ?>