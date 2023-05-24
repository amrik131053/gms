<?php 
   include "header.php";   
   ?>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card">
            <div class="card-header ">
               <h3 class="card-title">Daily Reports </h3>   
                 <div class="card-tools"> 
                     <div class="input-group input-group-sm" style="width: 200px;"> 
                        <input type="text" id="table_search" class="form-control float-right" placeholder="Search Employee ID" >
                        <input type="button" class="btn btn-primary btn-xs" value="Search" name="" onclick="employeeSearch();">
                        <input type="button" class="btn btn-success btn-xs" value="Print" name="" onclick="print_report_date_wise();">
                        </div>
                     </div>
                  </div>
                  
            </div>
            
            <div class="card-body table-responsive">
               <div class="form-group row" id="search_record_emp">
                   
                   
               </div>
            </div>
        </div>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       
      </div>
    
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->
<script>
      function employeeSearch()
   {
      // alert('id');
    var id=document.getElementById('table_search').value;
      var code=25;
      $.ajax(
      {
         url:"action_g.php ",
         type:"POST",
         data:
         {
            code:code,emp_id:id
         },
         success:function(response) 
         {
            // console.log(response);
            document.getElementById("search_record_emp").innerHTML =response;
          
         },
         error:function()
         {
            alert("error");
         }
      });
   }
</script>

<?php


 include "footer.php";  ?>