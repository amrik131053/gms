<?php 
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-md-5 col-lg-5 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Create Category</h3>
               </div>
               <form class="form-horizontal" action="" method="POST">
                  <div class="card-body">
                     <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Category Name</label>
                        <div class="col-lg-12">
                           <input type="text" name="" required="" class="form-control" id="CategoryName" placeholder="Name">
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-info" onclick="category_insert();">Create</button>
                     <p id="category_success"></p>
                  </div>
                  <!-- /.card-footer -->
               </form>
            </div>



            <div class="card card-info"> 
               <div class="card-header"> 
                  <h3 class="card-title">Employee Permission</h3> 
                  <div class="card-tools"> 
                     <div class="input-group input-group-sm" style="width: 150px;"> 
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search Employee ID" onkeyup="categoryEmployeeSearch(this.value);">
                        </div>
                     </div>
                  </div>
                  <div id="search_record_emp_permission">
                     
                  </div>
                          
                    
                  <!-- /.card-footer -->
               
            </div>
            <!-- /.card -->
         </div>
       
            <div class="col-lg-7 col-md-7 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Categories</h3>
                     <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                           <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="categorysearch(this.value);">
                           
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 480px;">
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
                              $category_num=0;
                              $category="SELECT * FROM master_calegories";
                              $category_run=mysqli_query($conn,$category);
                              while ($category_row=mysqli_fetch_array($category_run)) 
                              {
                              $category_num=$category_num+1;?>
                           <tr>
                              <td><?=$category_num;?></td>
                              <td><?=$category_row['CategoryName'];?></td>
                              <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_update" onclick="update_category(<?=$category_row['ID'];?>);" style="color:#a62532;"></i></td>
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

<div class="modal fade" id="exampleModal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Category </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="19">
            <div class="modal-body" id="update_category">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="Assign_Permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign Permission </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
               <form action="action.php" method="post">
                  
            <input type="hidden" name="code" value="57">
            <div class="modal-body" id="assignCategoryPermissons">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
               </form>
        
      </div>
   </div>
</div>

<script type="text/javascript">
   function categoryEmployeeSearch(id)
   {
      //alert(id);
      var code=53;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,emp_id:id
         },
         success:function(response) 
         {
            document.getElementById("search_record_emp_permission").innerHTML =response;
            $(document).ajaxStop(function()
            {
               // window.location.reload();
            });
         },
         error:function()
         {
            alert("error");
         }
      });
   } 
   function assignPermission(id)
   {
      //alert(id);
      var code=55;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,emp_id:id
         },
         success:function(response) 
         {
            document.getElementById("assignCategoryPermissons").innerHTML =response;
            $(document).ajaxStop(function()
            {
               // window.location.reload();
            });
         },
         error:function()
         {
            alert("error");
         }
      });
   } 

  function deleteCategoryPermission(id,EmpID) {
    var code = '54';
    var categoryPermissionId = id;
    //alert(categoryPermissionId);
    $.ajax({
        url: 'action.php',
        data: {
            ID: categoryPermissionId,
            code: code
        },
        type: 'POST',
        success: function(data) {

            //console.log(data);
            categoryEmployeeSearch(EmpID);
            //location.reload(true);

        }
    });
}
</script>

<?php include "footer.php";  ?>