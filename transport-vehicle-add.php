<?php 

include "header.php";
 ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form class="form-horizontal" action="action_g.php" method="POST">
            <div class="modal-body">
               <input type="hidden" name="code" value="34">
               
                  <div class="form-group row">
                     <div class="col-lg-12">
                     <label>Type Name</label>
                        <input type="text" class="form-control" required="" name="type" placeholder="Type">
                     </div>
                  </div>
               <!-- </div> -->
               <!-- /.card-footer -->
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-success">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="update_vehicle_modal" tabindex="-1" role="dialog" aria-labelledby="update_vehicle_modalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form id="update_vehicle_modal_fun" method="post" action="action_g.php " enctype="multipart/form-data">
         <div class="modal-header">
            <h5 class="modal-title" id="update_vehicle_modalLabel">Create Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
            <div class="modal-body" id="update_vehicle_record">
               
              
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-success">Update</button>
            </div>
            </form>
         
      </div>
   </div>
</div>

    <!-- Main content -->
    <section class="content">

<div class="row">
  <div class="col-lg-4">
       <div class="card">

        <div class="card-header">

          <h3 class="card-title">Add Vehicle</h3>

          <div class="card-tools">
         
           <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus fa-lg"></i></button>
          </div>
        </div>
    
        <div class="card-body table-responsive " style="height:400px;">
          <div class="row">
            <form id="add_type" action="action_g.php " method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
              <input type="hidden" value="35" name="code">
          <label>Type</label>
          <select class="form-control" name="type">
            <option value="">Select</option>
            <?php  $get_type="SELECT * FROM vehicle_types";
              $get_type_run=mysqli_query($conn,$get_type);
              while($row=mysqli_fetch_array($get_type_run))
              {?>
            <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
            <?php 
              }
             ?>
          </select>
             <label>Vehicle Name</label>
             <input type="text" name="name" class="form-control"> 
              <label>Number</label>
             <input type="text" name="number" class="form-control">
             <label>Image</label>
             <input type="file" name="image"  class="form-control">
             <label>Action</label><br>
             <input type="submit"  class="btn btn-success" value="Submit">
            </div>
            </form>
          </div>
        </div>
        
      </div>
  </div>
  <div class="col-lg-8">
       <div class="card">
        <div class="card-header">
          <h3 class="card-title">Details</h3>
          <div class="card-tools">           
          </div>
        </div>     
        <div class="card-body table-responsive " style="height:440px;" id="show_vehicle_record">

        </div>     
      </div>
  </div>
 
</div>
      <!-- Default box -->
   
      <!-- /.card -->

    </section>
    <!-- /.content -->
<script type="text/javascript">

       $(document).ready(function (e) {    // image upload form submit
           $("#add_type").on('submit',(function(e) {
              e.preventDefault();
             
              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "action_g.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
                    // console.log(data);
                    show_vehicle();
                        SuccessToast('Successfully add');
                         spinner.style.display='none';
                  },
                 
              });
           }));
         });

       $(document).ready(function (e) {    // image upload form submit
           $("#update_vehicle_modal_fun").on('submit',(function(e) {
              e.preventDefault();
             
              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "action_g.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
                    // console.log(data);
                        SuccessToast('Successfully Update');
                        show_vehicle();
                         spinner.style.display='none';
                  },
                 
              });
           }));
         });
       show_vehicle();
  function show_vehicle()
   {
      var code=36;
          
   var  spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action_g.php ",
            type:"POST",
            data:
            {
               code:code
            },
            success:function(response) 
            {
               
               spinner.style.display='none';
               document.getElementById("show_vehicle_record").innerHTML =response;
            }
         });
      } 
       function update_vehicle_record(id)
   {
      var code=37;
          // alert(id);
   var  spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action_g.php ",
            type:"POST",
            data:
            {
               code:code,id:id
            },
            success:function(response) 
            {
               // console.log(response);
               spinner.style.display='none';
               document.getElementById("update_vehicle_record").innerHTML =response;
            }
         });
      }
</script>
  <!-- /.content-wrapper -->

  <?php 


include "footer.php";


?>