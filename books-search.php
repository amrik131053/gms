<?php

include "header.php";
include "connection/connection.php";



?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card-header">
                    <!-- <h5>Books Issued</h5> -->
                    <span style="float:right;">
                    <button class="btn btn-sm">
                        <select class="form-control form-control-sm" id="Type">
                            <option value="0">Emp ID</option>
                            <option value="1">ACC No</option>
                        </select>
                    </button>
                        <button class="btn btn-sm ">
                            <input type="search" 
                                class="form-control form-control-sm" name="emp_name" id="emp_name"
                                placeholder="Search here">
                        </button>
                        <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
                            Search
                        </button>
                    </span>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="show_record">
                                

                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
include "footer.php";
                       ?>
                       <script>
    
          function search_all_employee()
          {
            
            var emp_name=document.getElementById('emp_name').value;
            var Type=document.getElementById('Type').value;
              if (emp_name!='') 
            {
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=430;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,empID:emp_name,Type:Type
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
         // document.getElementById('emp_name').value="";
              }
           });
           }
          }  
                       </script>