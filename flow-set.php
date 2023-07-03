<?php 
   include "header.php";   
   ?>
   <script type="text/javascript">
      function search_flow() {
         var code=75;
            var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
         var emp_id=document.getElementById('emp_id').value;
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,emp_id:emp_id
            },
             success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("data_show").innerHTML=response;
              }

         });
      }
     
   </script>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-4 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">----</h3>   
            </div>
            <div class="card-body">
               <div class="form-group row">
                 <input type="text" class="form-control" id="emp_id">
                 <button class="btn btn-primary btn-xs" onclick="search_flow();">Search</button>
               </div>
            </div>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
            - <h3 class="card-title">-----</h3>
           </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive" id="data_show">
            
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->


<?php


 include "footer.php";  ?>