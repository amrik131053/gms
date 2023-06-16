<?php 
   include "header.php";   
   ?>
   <script type="text/javascript">
      show_category_wise();
   function show_category_wise()
          {
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=50;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("category_wise_show").innerHTML=response;
              }
           });
          } 
           function show_emp_all(categoryID)
          {
            // alert(categoryID);
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=51;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,CategoryId:categoryID
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
              }
           });
          }      
            function show_status_wise()
          {
         
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=52;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("status_wise_show").innerHTML=response;
              }
           });
          }   
            function show_emp_all_status(status)
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=53;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,status:status
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
              }
           });
          }     
            function show_role_wise()
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=54;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("role_wise_show").innerHTML=response;
              }
           });
          }      
            function show_emp_all_role(role)
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=55;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,role:role
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
              }
           });
          }     
             function show_college_wise()
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=56;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
               // console.log(response);

                  spinner.style.display='none';
                 document.getElementById("college_wise_show").innerHTML=response;
              }
           });
          }    
           function show_all_depaertment(collegeId)
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=57;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("department_wise_show"+collegeId).innerHTML=response;
              }
           });
          }      
             

              function show_emp_all_department(collegeId,department)
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=58;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId,department:department
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
              }
           });
          }    

 

   //          function search_all_employee(empID)
   //        {
   //    var spinner=document.getElementById("ajax-loader");
   // spinner.style.display='block';
   //         var code=60;
   //         $.ajax({
   //            url:'action_g.php',
   //            type:'POST',
   //            data:{
   //               code:code,empID:empID
   //            },
   //            success: function(response) 
   //            {
   //                spinner.style.display='none';
   //               document.getElementById("show_record").innerHTML=response;
   //            }
   //         });
   //        }

  // $(document).ready(function()
  //     {
  //        $(document).on('keydown', '.emp_name', function() 
  //        {
  //           $("#emp_name").autocomplete(
  //           {
  //              source: function( request, response ) 
  //              {
  //                 // alert();
  //                 $.ajax(
  //                 {
  //                    url: "action_g.php",
  //                    type: 'post',
  //                    dataType: "json",
  //                    data: 
  //                    {
  //                       search: request.term,code:59
  //                    },
  //                    success: function( data ) 
  //                    {

  //                       response(data);
  //                    }
  //                 });
  //              },
  //              select: function (event, ui) 
  //              {
  //                 $(this).val(ui.item.label); // display the selected text
  //                 var userid = ui.item.value; // selected value
  //                 search_all_employee(userid);
  //                 return false;
  //              }
  //           });
  //        });
  //     }); 
    function search_all_employee_emp_name(emp_name)
          {
            if (emp_name!='') 
            {
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,empID:emp_name
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
          function search_all_employee()
          {
            var emp_name=document.getElementById('emp_name').value;
              if (emp_name!='') 
            {
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,empID:emp_name
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
            function update_emp_record(empID)
          {
            
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=61;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,empID:empID
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
         

              }
           });
        }  
              function AddleaveAuthority(collegeId)
          {
            
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=62;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
         

              },
              error:function(response) {
                 
               console.log(response);
              }
           });
        }    
           function update_leave_authority(collegeId,department)
          {
           
            var Recommending=document.getElementById('Recommending'+department).value;
            var Senction=document.getElementById('Senction'+department).value;
            var spinner=document.getElementById("ajax-loader");
            // alert(Recommending);
               spinner.style.display='block';
           var code=63;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,department:department,Recommending:Recommending,Senction:Senction,collegeId:collegeId
              },
              success: function(response) 
              {
               console.log(response);
                  spinner.style.display='none';
                  if(response==1)
                  {

                  SuccessToast('Successfully Updated');
                 AddleaveAuthority(collegeId);
                     }
                     else
                     {
                        // ErrorToast('bg-danger','Try Again');
                     }
              }
           });
        }
                function sync_leave_auth(collegeId)
          {
            
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=64;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId
              },
              success: function(response) 
              {
               console.log(response);
                  spinner.style.display='none';
                  if(response==1)
                  {

                  SuccessToast('Successfully Sync');
                 
                     }
                     else
                     {
                        // ErrorToast('bg-danger','Try Again');
                     }
              },
              error:function(response) {
                 
               // console.log(response);
              }
           });
        } 

   </script>
 <!-- Content Wrapper. Contains page content -->
  
    <section class="content-header">
  
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
        

          <div class="card ">
            <div class="card-header">
              <h3 class="card-title">CATEGORY</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" >
                  <i class="fas fa-minus" onclick="show_category_wise();"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0" >
                <ul class="nav nav-pills flex-column" id="category_wise_show">
            </ul>
            </div>
            <!-- /.card-body -->
          </div> 
           <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title">STATUS</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus " onclick="show_status_wise();"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column" id="status_wise_show">
               
           
              </ul>
            </div>
            <!-- /.card-body -->
          </div>  
           <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title">ROLE</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus" onclick="show_role_wise();"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column" id="role_wise_show">
               
           
              </ul>
            </div>
            <!-- /.card-body -->
          </div>    
             <div class="card collapsed-card">
            <div class="card-header">
              <h3 class="card-title">COLLEGE</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus" onclick="show_college_wise();"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column" id="college_wise_show">
                
           
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
         
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card  card-outline">
            <div class="card-header">
              <h3 class="card-title">Employee</h3>

              <div class="card-tools">
                
                        <div class="input-group">

                            <input type="search" onblur="search_all_employee_emp_name(this.value);" class="form-control  "   name="emp_name" id="emp_name"   placeholder="Search here">
                            <div class="input-group-append">
                       <button type="button" onclick="search_all_employee();" class="btn  btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            
              <div class="table-responsive " id="show_record">
              
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
           
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
<p id="ajax-loader"></p>

<!-- Modal -->
<?php include "footer.php"; ?>