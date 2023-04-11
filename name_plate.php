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
               <h3 class="card-title">Name Plate</h3>   
            </div>
            <div class="card-body">
              
                  <div class="col-lg-12">
                     
                     <form action="print_name_plate.php" method="post" target="_blank">
                     <label>Name</label>
                     <input type="text" class="form-control" name="Name">
                     <label>Designation</label>
                     <input type="text" class="form-control" name="Designation">
                     <label>Action</label><br>
                     <input type="submit" name="" class="btn btn-success" value="Print">
                    </form>
                 
                  </div>
               
            </div>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       
      </div>
     <!--  <div class="col-lg-8 col-md-8 col-sm-12">
         <div class="card card-info"> -->
          <!--   <div class="card-header ">
            - <h3 class="card-title">-----</h3>
           </div> -->
            <!-- /.card-header -->
            <!-- <div class="card-body table-responsive"> -->
              <!-- --- -->
            <!-- </div> -->
            <!-- /.card -->
        <!--  </div>
      </div> -->
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->


<?php include "footer.php";  ?>