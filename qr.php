<?php 

  include "header.php";   
?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         
         <div class="col-lg-3 col-md-8 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Room wise QR  </h3>
                  <div class="card-tools">
                     
                  </div>
               </div>
               <!-- /.card-header -->
                        <form action="print-custom.php" method="post" target="_blank">
   <input type="hidden" name="code" value="1">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" required="" class="col-sm-4 col-form-label">Block</label>
                    <div class="col-lg-12">
                       <select class="form-control" required="" name="Block_assign" id="Block_assign" onclick="block_assign();">
<option value="">Select</option>
<?php
   $building_select="SELECT Distinct Name,ID FROM building_master";
   $building_select_run=mysqli_query($conn,$building_select);
   while ($building_select_row=mysqli_fetch_array($building_select_run)) 
   {?>
<option value="<?= $building_select_row['ID'];?>">
<?= $building_select_row['Name'];?>
</option> ";
<?php  }
   ?>
</select>
                    
                

                               <label for="inputEmail3" class="col-sm-4 col-form-label">Floor</label>
                    
                     <select class="form-control" required="" name="Floor" id="Floor_assign" onclick="floor();">
<option value="">Select</option>
</select>


                                 <label for="inputEmail3" class="col-sm-12 col-form-label" id="">Room No</label>
                   
                      
                     <select class="form-control" required="" name="RoomNo" id="RoomNo" onclick="roomNo();">
<option value="">Select</option>
</select>
                               

                               <label for="inputEmail3" class="col-sm-12 col-form-label" id="">Room Name</label>
                   
                      
                      <select class="form-control" required="" name="RoomType" id="RoomType" onclick="getid();">
<option value="">Select</option>
</select>


<input type="text" name="iDNo_assing" id="out"> 

                              
                    </div>

                     <div class="col-lg-12">
                        <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Size</label>
                       <select class="form-control" required="" name="size">
                        <option value="">Select</option>
                        <option value="Large">Large</option>
                        <option value="Small">Small</option>
</select>
                              
                              
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit"  value="Print" class="btn btn-primary">
               
                </div>
             </form>
          </div>
       </div>


         <div class="col-lg-3 col-md-8 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title"> ID Wise QR</h3>
                  <div class="card-tools">
                     
                  </div>
               </div>
               <!-- /.card-header -->
              <!--    <form action="print-mourse.php" method="post" target="_blank"> -->
                        <form action="print-custom.php" method="post" target="_blank">

      <input type="hidden" name="code" value="2">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" required="" class="col-sm-4 col-form-label">From</label>
                    <div class="col-lg-12">
                       <input type="text" name="From" class="form-control" required="" placeholder="From QR Number">

                               <label for="inputEmail3" class="col-sm-4 col-form-label">To</label>
                    
                    <input type="text" name="To" class="form-control" required="" placeholder="End QR Number">
                              
                    </div>
                     <div class="col-lg-12">
                        <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Size</label>
                       <select class="form-control" required="" name="size">
                        <option value="">Select</option>
                        <option value="Large">Large</option>
                        <option value="Small">Small</option>
</select>
                              
                              
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit"  value="Print" class="btn btn-primary">
               
                </div>
             </form>
          </div>
       </div>



         <div class="col-lg-3 col-md-8 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Article wise QR</h3>
                  <div class="card-tools">
                     
                  </div>
               </div>
               <!-- /.card-header -->
                      
                              <form action="print-custom.php" method="post" target="_blank">
      <input type="hidden" name="code" value="3">
                <div class="card-body">
                  <div class="form-group row">
                      <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Category Name</label>
                     <select class="form-control" name="CategoryID" id="Category">
                              <option value=" ">Select </option>
                              <?php
                                 $category_select="SELECT * FROM master_calegories";
                                 $category_select_run=mysqli_query($conn,$category_select);
                                 while ($category_select_row=mysqli_fetch_array($category_select_run)) 
                                 {
                                 echo "<option value='".$category_select_row['ID']."'>".$category_select_row['CategoryName']."</option>";
                                 }
                                 ?>
                           </select>
                    <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Article Name</label>
                    <div class="col-lg-12">
                       <select class="form-control" required="" id="articlebind" name="ArticleCode">


</select>
                              
                              
                    </div>
                   


                     <div class="col-lg-12">
                        <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Size</label>
                       <select class="form-control" required="" name="size">
                        <option value="">Select</option>
                        <option value="Large">Large</option>
                        <option value="Small">Small</option>
</select>
                              
                              
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit"  value="Print" class="btn btn-primary">
               
                </div>
             </form>
          </div>
       </div>
    






</div>
</div>


 
  
</section>

<?php include "footer.php";  ?>