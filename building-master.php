<?php include "header.php"; ?>

   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-lg-5 col-md-5 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Building Manage</h3>
              </div>
        
              <form class="form-horizontal" action="action.php" method="POST">
                <input type="hidden" name="code" value="3">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" required="" class="col-sm-4 col-form-label">Building Name</label>
                    <div class="col-sm-12">
                      <input type="text" name="BuildingName" class="form-control" id="BuildingName" placeholder="Name">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info"   >Create</button>
               
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
             
          <div class="col-lg-7 col-md-7 col-sm-3">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Buildings</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="buildingsearch(this.value);">

                    
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height:600px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      
                      <th>ID</th>
                      <th>Name</th>
                       <th>Building Incharge</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tbody id="search_record">
                    <?php 
                        $building_num=0;
                        $building="SELECT * FROM building_master order by ID DESC ";
                        $building_run=mysqli_query($conn,$building);
                        while ($building_row=mysqli_fetch_array($building_run)) 
                        {
                        $building_num=$building_num+1;?>
                     <tr>
                      <!--   <td><?=$building_num;?></td> -->
                        <td><?=$building_row['ID'];?></td>
                        <td><?=$building_row['Name'];?></td>
                        <td><?=$building_row['Incharge'];?></td>
                        <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModalCenter" onclick="edit_building(<?=$building_row['ID'];?>);" style="color:#a62532;"></i></td>
                     </tr>
                     <?php 
                        }
                                   ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          
        </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Building</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="40">
            <div class="modal-body" id="edit_building_master">

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
         </form>
         </div>
      </div>
   </div>
    <?php include "footer.php"; ?>