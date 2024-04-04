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
                <h3 class="card-title"> Article Image</h3>
              </div>
        
              <form action="action_g.php" method="post">
                        <div class="card-body">
                            <input type="hidden" name="code" value="388" >
                           <label for="inputEmail3" required="" class="col-lg-12 col-form-label">Category Name</label>
                             
                             <select class="form-control" name="CategoryID" id="Category">
                              <option value="">Select </option>
                              <?php
                                 $category_select="SELECT *,master_calegories.ID as MCID FROM master_calegories inner join category_permissions on category_permissions.CategoryCode=master_calegories.ID where category_permissions.employee_id='$EmployeeID' ";
                                 $category_select_run=mysqli_query($conn,$category_select);
                                 while ($category_select_row=mysqli_fetch_array($category_select_run)) 
                                 {
                                 echo "<option value='".$category_select_row['MCID']."'>".$category_select_row['CategoryName']."</option>";
                                 }
                                 ?>
                              </select>

                           <label for="inputEmail3" class="col-lg-12 col-form-label">Article  Name</label>
                            <select class="form-control" name="ArticleName" id="articlebind">
                           </select>
                           <label for="inputEmail3" class="col-lg-12 col-form-label">Image</label>
                           <input type="file" class="form-control" name="fileImage">
                        </div>
                     <div class="card-footer">
                  <button type="button" class="btn btn-info" onclick="uploadArticleImage(this.form);">Submit</button>
             
                </div>
                <!-- /.card-footer -->
            </div>
        </form>
            <!-- /.card -->

          </div>
           
          <div class="col-lg-7 col-md-7 col-sm-3">
            <div class="card card-info">
              <div class="card-header">

                <div class="row">
                
<button type="button" class="btn btn-info" onclick="ViewImage();">View Images</button>
             
                </div>
     </div>
                           
                             

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    

                   
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 600px;" id='view_article'>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<div class="modal fade" id="exampleModal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Articles </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="18">
            <div class="modal-body" id="update_article">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
    function uploadArticleImage(form) {

var CategoryID = form.CategoryID.value;
var ArticleName = form.ArticleName.value;
var fileImage = form.fileImage.value;

if (fileImage === "") {

    ErrorToast('Please select a image.', 'bg-warning');
    return;
}
if (ArticleName.trim() === "") {

    ErrorToast('Please select Article Name.', 'bg-warning');
    return;
}

if (CategoryID === "") {

    ErrorToast('Please select Category.', 'bg-warning');
    return;
}

var formData = new FormData(form);
$.ajax({
    url: form.action,
    type: form.method,
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
        console.log(response);
        if (response == 1) {
            SuccessToast('Photo Uploaded successfully');
            document.getElementById("fileImage").value = "";
        }
        else{
            ErrorToast('Please try after sometime.', 'bg-danger');
        }
    },
    error: function(xhr, status, error) {
        console.log(error);
    }
});
}
   

function  ViewImage() {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
     var Category = document.getElementById('Category').value;
    var article = document.getElementById('articlebind').value;
    // alert(id);
    var code = 365;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,Category:Category,article:article
            
        },
        success: function(response) {

            spinner.style.display = 'none';
            document.getElementById("view_article").innerHTML = response;

        }
    });

}






















    </script>



    <?php include "footer.php";  ?>



