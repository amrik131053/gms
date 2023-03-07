<?php 
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-lg-5 col-md-5 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Create Room Name</h3>
               </div>
               <form class="form-horizontal" action="action.php" method="POST">
                  <input type="hidden"  name="code" value="16">
                  <div class="card-body">
                     <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Type Name</label>
                        <div class="col-lg-12">
                           <input type="text" name="room_type_Name" name="" required="" class="form-control" id="" placeholder="Name">
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-info">Create</button>
                  </div>
                  <!-- /.card-footer -->
               </form>
            </div>
            <!-- /.card -->
         </div>
         <div class="col-lg-7 col-md-7 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Room Names</h3>
                  <div class="card-tools">
                     <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="room_namesearch(this.value);">
                      
                     </div>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive p-0" style="height: 600px;">
                  <table class="table table-head-fixed text-nowrap">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="search_record">
                        <?php 
                           $room_type_num=0;
                           $room_type="SELECT * FROM room_name_master";
                           $room_type_run=mysqli_query($conn,$room_type);
                           while ($room_type_row=mysqli_fetch_array($room_type_run)) 
                           {
                           $room_type_num=$room_type_num+1;?>
                        <tr>
                           <td><?=$room_type_num;?></td>
                           <td><?=$room_type_row['RoomName'];?></td>
                           <td><i class="fa fa-edit fa-lg"  data-toggle="modal" data-target="#exampleModalCenter" onclick="edit_room_name(<?=$room_type_row['ID'];?>);" style="color:red;"></i></td>
                        </tr>
                        <?php 
                           }
                                      ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="22">
            <div class="modal-body" id="room_name_edit">
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
         </form>
         </div>
      </div>
   </div>
</div>
<?php include "footer.php";

 ?>