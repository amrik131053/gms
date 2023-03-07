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
               <h3 class="card-title">Menu</h3>
               <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal" style="float: right;">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </button>
            </div>
            <div class="card-body">
               <div class="form-group row">
                 
                  <div class="col-lg-12">
                     
                      <table class="table">
                         
                      <tr>
                         <th>Sr.No</th>
                         <th>Menu </th>
                         <th>Action</th>
                      </tr>
                    
                   
                        <?php 
                        $srno=0;
                           $get_menu="SELECT * FROM master_menu";
                           $get_run=mysqli_query($conn,$get_menu);
                           while ($get_row=mysqli_fetch_array($get_run))
                            {
                              $srno++;

                              ?>
                              <tr>
                                 <td><?=$srno;?></td>
                                 
                                 <td>
                                     <label for="name" class="control-label">
                                       <p class="text-info<?=$get_row['id'];?>" onclick="show_menu_pages(<?=$get_row['id'];?>);"><?=$get_row['menu_name'];?></p>
                                        <p class="text-id<?=$get_row['id'];?>"></p>


                                    </label>
                                     <small id="succcess<?=$get_row['id'];?>" style='size: 5px;color: green;'></small>
                                 </td>
                                 <td><div class="controls">   
                                          <i class="fa fa-edit" id="times<?=$get_row['id'];?>"  onclick="show_text_box_menu(<?=$get_row['id'];?>);" > 
                                          </i> 

                                          <div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" id="crose<?=$get_row['id'];?>" class="btn btn-success btn-xs" 
style='display: none;'><i class="fa fa-check" onclick="data_submit(<?=$get_row['id'];?>)" id="times<?=$get_row['id'];?>"  onclick=""  >   </i> 
</button>

  <button type="button" id="check<?=$get_row['id'];?>" class="btn btn-danger btn-xs "
style='display: none;'><i class="fa fa-times" onclick="cencel_text_box(<?=$get_row['id'];?>)" id="times<?=$get_row['id'];?>"  onclick="">     </i> 
</button>
</div>    </div></td>
                              </tr>


                             

 
                        <?php }
                           ?>
                     </table>  
                  </div>
               </div>
            </div>
           
            <p id="error" style="display: none;"></p>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Permissions</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive  " id="show_all_menu_pages" style="height: 600px;">
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
            <h5 class="modal-title" id="exampleModalLabel">Create Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form class="form-horizontal" action="action.php" method="POST">
            <div class="modal-body">
               <input type="hidden" name="code" value="113">
               <div class="card-body">
                  <div class="form-group row">
                     <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">Menu Name</label>
                     <div class="col-lg-12">
                        <input type="text" class="form-control" required="" name="menu_name" placeholder="Menu Name">
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