<?php 
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Specification</h3>
                  <div class="card-tools">
                     <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="specification_search(this.value);">
                        
                     </div>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive p-0" style="height: 600px;">
                  <table class="table table-head-fixed text-nowrap">
                     <thead>
                        <tr>
                           <th>Brand</th>
                           <th>RAM</th>
                           <th>Model</th>
                           <th>Memory</th>
                           <th>Specification</th>
                           <th>OS</th>
                           <th>Action</th>
                          
                        </tr>

                     </thead>
                     <tbody >
                           <tr>
                          <form  action="action.php" method="post">
                           <input type="hidden" name="code" value="24">
                            <input type="hidden" name="id" value="<?=$specification_row[0];?>">
                           <td><input type="text" name="col1" class="form-control" value=""></td>
                           <td><input type="text" name="col2" class="form-control"  value=""></td>
                           <td><input type="text" name="col3"class="form-control"  value=""></td>
                           <td><input type="text" name="col4" class="form-control" value=""></td>
                           <td><input type="text" name="col5" class="form-control" value=""></td>
                            <td><input type="text" name="col6" class="form-control" value=""></td>
                            <td><input type="Submit"  class="btn btn-success" value="Add"></td>
                           </form>
                        </tr>
                     </tbody>
                  </table >
                  <table class="table table-head-fixed text-nowrap">
                     <thead>
                        <tr>
                           <th>Brand</th>
                           <th>RAM</th>
                           <th>Model</th>
                           <th>Memory</th>
                           <th>Specification</th>
                           <th>OS</th>
                           <th>Action</th>
                          
                        </tr>

                     </thead>
                     <tbody id="search_record">
                        <?php   
                           $specification="  SELECT * FROM specification Order by ID ASC";
                           $specification_run=mysqli_query($conn,$specification);
                           while ($specification_row=mysqli_fetch_array($specification_run)) 
                           {
                           
                           ?>
                        <tr>
                          <form  action="action.php" method="post">
                           <input type="hidden" name="code" value="23">
                            <input type="hidden" name="id" value="<?=$specification_row[0];?>">
                           <td><input type="text" name="col1" class="form-control" value="<?=$specification_row[1];?>"></td>
                           <td><input type="text" name="col2" class="form-control"  value="<?=$specification_row[2];?>"></td>
                           <td><input type="text" name="col3"class="form-control"  value="<?=$specification_row[3];?>"></td>


                           <td> 

                            <input type="text" name="col4" class="form-control" value="<?=$specification_row[4];?>"> </td>


                           <td><textarea name="col5" class="form-control"><?=$specification_row[5];?></textarea>

                              <!-- <input type="text" name="col5" class="form-control" value="<?=$specification_row[5];?>"> --></td>
                            <td><input type="text" name="col6" class="form-control" value="<?=$specification_row[6];?>"></td>
                            <td><input type="Submit" class="btn btn-warning" value="Update"></td>
                           </form>
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
       
      </div>
     
   </div>
  
</section>
<!-- Button trigger modal -->

<?php include "footer.php";


 ?>