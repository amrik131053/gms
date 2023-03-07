<?php 
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-md-6 col-lg-6 col-sm-3">
            <div class="card card-info"> 
               <div class="card-header"> 
                  <h3 class="card-title">Category Permission</h3> 
                  <div class="card-tools"> 
                     <div class="input-group input-group-sm" style="width: 150px;"> 
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search Employee ID" onkeyup="categoryEmployeeSearch(this.value);">
                        </div>
                     </div>
                  </div>
                  <div id="search_record_emp_permission">
                  </div>
            </div>
         </div>
            <div class="col-md-6 col-lg-6 col-sm-3">
               <div class="card card-info"> 
                  <div class="card-header"> 
                     <h3 class="card-title">Hostel Permission</h3> 
                     <div class="card-tools"> 
                        <div class="input-group input-group-sm" style="width: 150px;"> 
                           <input type="text" name="table_search" class="form-control float-right" placeholder="Search Employee ID" onkeyup="hostelEmployeeSearch(this.value);">
                        </div>
                     </div>
                  </div>
                  <div id="search_record_hostel_permission">
                  </div>
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
   } function hostelEmployeeSearch(id)
   {
      //alert(id);
      var code=77;
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
            document.getElementById("search_record_hostel_permission").innerHTML =response;
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
   function assignHostelPermission(id)
   {
      //alert(id);
      var code=79;
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
            hostelEmployeeSearch(id);
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
function deleteHostelPermission(id,EmpID) {
    var code = '78';
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
            hostelEmployeeSearch(EmpID);
            //location.reload(true);

        }
    });
}
</script>

<?php include "footer.php";  ?>