<?php 
  ini_set('max_execution_time',0);
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-md-4 col-lg-4 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">ADD</h3>
               </div>
               <form class="form-horizontal" action="#" method="POST" enctype='multipart/form-data'>
                  <div class="card-body">
                     <div class="form-group row">

                     <form id="image-upload" name="image-upload" action="action_g.php" method="post" enctype="multipart/form-data">
    
        <input type="hidden" name="code" value="168">
    
    </form>
                        <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">Title</label>
                        <input type="text" name="title" required class="form-control">
                           
                        </div>
                        <div class="col-lg-6">
                        <label for="inputEmail3" class=" col-form-label">Start</label>
                        <input type="date" name="start" required class="form-control">
                        </div> 
                        <div class="col-lg-6">
                        <label for="inputEmail3" class=" col-form-label">End</label>
                        <input type="date" name="end" required class="form-control">
                        </div>
                      
                        <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">File</label>
                        <input type="file" name="image" id="image" class="form-control input-group-sm">
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                  <input type="button" value="Upload" class="btn btn-success "
            onclick="uploadImage(this.form);">
                  </div>
                  <!-- /.card-footer -->
               </form>
            </div>

         </div>
       
            <div class="col-lg-8 col-md-8 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">All Fastivals</h3>
                     <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                           
                           
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 480px;">
                     <table class="table table-head-fixed text-nowrap">
                        <thead>
                           <tr>
                              <th>Image</th>
                              <th>Title</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Display</th>
                              <th>Logo</th>
                              <!-- <th>Dashboard</th> -->
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="table_load">
                      
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
    
   function uploadImage(form) {
      var formData = new FormData(form);
      $.ajax({
         url: form.action,
         type: form.method,
         data: formData,
         contentType: false,
         processData: false,
         success: function(response) {
            // console.log(response);
            SuccessToast('Successfully Uploaded');
         },
         error: function(xhr, status, error) {
            // console.log(error);
         }
      });
   }

    open_examination_permision_search();
      function open_examination_permision_search()
      {
        var id=0;
        //  var exam_type=document.getElementById('exam_type').value;
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
  // alert(exam_type);
     var code=165;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               
               spinner.style.display='none';
                document.getElementById("table_load").innerHTML=response;
                
              }
           });
    }
    function edit_start_end_date(id)
      {
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
  // alert(exam_type);
     var code=166;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
            //    console.log(response);
               spinner.style.display='none';
                document.getElementById("edit_start_end_date_load").innerHTML=response;
                
              }
           });
    } 

    function update_date_end_date(id)
      {
         var start_date_edit=document.getElementById('start_date_edit').value;
         var end_date_edit=document.getElementById('end_date_edit').value;
         var status=document.getElementById('status_edit').value;
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
  // alert(exam_type);
     var code=167;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id,start_date_edit:start_date_edit,end_date_edit:end_date_edit,status:status
              },
              success: function(response) 
              {
            
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully Update');
                           open_examination_permision_search();
                          }
                          else
                          {
                           ErrorToast('Input Wrong ','bg-danger' );
                          }
                
                
              }
           });
    }  
</script>
<div class="modal fade" id="exampleModal_edit_permission_exam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      
       
            <div class="card-body" id="edit_start_end_date_load">
      
            </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
    </div>
  </div>
<?php include "footer.php";  ?>