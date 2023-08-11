<?php include "header.php";
?>

<section class="content">
   <div class="row">
      <div class="col-lg-8">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">All Requests</h3>
               <div class="card-tools">
               </div>
            </div>
            <div class="card-body table-responsive " >
                <div class="row">
               <div class="col-lg-12">
                
                     <div  id="message"  style="text-align: center;">
                     </div>
                      
                     <div class="row">
                        <div class="col-sm-12" style="text-align:left;" id="data">
                           <div id="live_data"></div>
                        </div>
                        
                          
                       
                        <div class="col-lg-3">
                           <label>Article</label>
                           <select class="form-control" id="item_name">
                              <option>Select Article </option>
                           </select>
                         
                        </div>
                        <div class="col-lg-2">
                           <label>Quantity</label>
                           <input type="number"  placeholder="Quanity" id="quantity"  min="1"  class="form-control">
                           <input type="hidden" name="text"  value="<?php echo $a;?>" id="emp_id" class="form-control">
                           <input type="hidden" name="text"  value="<?php echo $dep;?>" id="department" class="form-control">
                           <input type="hidden" name="text"  value="<?php echo $name;?>" id="name" class="form-control">
                        </div>
                        <div class="col-lg-2">
                           <label>Specification</label>
                           <input type="text"  placeholder="Specification" id="specification" class="form-control">
                        </div>

                        <div class="col-lg-1">
                           <label >Action</label><br>
                           <input type="button" name="submit" id="add_request" class="btn btn-primary" value="Add">
                        </div>
                     </div>
                 
               </div>
           </div>
           <br>
               <div class="row">
               <div class="col-lg-12" id="show_request">
               </div>
           </div>
               <!-- ------------- -->
            </div>
         </div>
      </div>
  </div>
</section>



<?php include "footer.php";
?>