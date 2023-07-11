<?php 
   include "header.php";  
   include "connection/connection.php"; ?>
    
   
<section class="content">
   <div class="container-fluid">
      <div class="row">
          <div class="row">
         <!-- left column -->
         <!-- Button trigger modal -->
         <div class="col-lg-4 col-md-4 col-sm-4">

            <div class="card card-info">
            <div class="card-header "> <h3 class="card-title">Request From</h3>
            </div>
            </div>
            <div class="card-body" >
           
<div  id="message"  style="text-align: center;"></div>
    <div id="live_data">
      
            </div>
   <div class="row">   

<lable ><b>Category</b></lable>
 
<select class="form-control" id ="category" required="">

                <option value="">Select Category</option>  
                      <option value="Stationery">Stationery</option>
                                  
                  <option value="Carpentory"> Carpentory</option> 

                    <option value="Plumbing"> Plumbing</option> 
                    <option value="Miscellaneous">Miscellaneous</option>  
                    <option value="Electrical"> Electrical</option> 

              </select>  
<br> <lable ><b>Article</b></lable>
                <select class="form-control" id="item_name">
                <option>Select Article </option>
              </select>  <br/>

                <lable ><b>Quantity</b></lable>

               <input type="number"  placeholder="Quanity" id="quantity"  min="1"  class="form-control">
                            
                  <lable ><b>Specification</b></lable>
               <input type="text"  placeholder="Specification" id="specification" class="form-control">
             
         <br><br><br>
              <input type="button" name="submit" id="add_request"  placeholder="submit" class="btn btn-primary" value="Add Article">

               </div>
            </div> </div>















              </div>
            </div>
          </div>





   </div>

</section>



<p id="ajax-loader"></p>


<script>
  $( document ).ready(function() {

 var emp_id = $("#emp_id").val();
        var code = "2";
        
  $.ajax({  
                url:"../gkuadmin/store/my_request.php", 
        data:{emp_id:emp_id,code:code},
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });

 });

</script>

<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<!-- Modal -->
<?php
   include "footer.php"; 
   
    ?>