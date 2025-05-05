<?php 
   include "header.php";   
   ?> 
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Assign Role/Permission </h3> 
                <!-- <div class="row">
                  <div class="col-lg-4">
                  </div>
                  <div class="col-lg-4">
                     <input type="text" class="form-control" required="" id="user_id" placeholder="EmpID">
                  </div>
                  <div class="col-lg-2">
                     <button type="button" class="btn btn-info" onclick="emp_role()">Search</button>
                  </div>
                  <div class="col-lg-2">
                     <button type="button" class="btn btn-info" onclick="role_drop()" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Assign Role</button>
                  </div> -->
               <!-- </div> --> 
           
            <div class="card-tools">
            <div class="input-group input-group-sm">
            <input type="text" class="form-control" required="" id="user_id" placeholder="EmpID">
            <button type="button" class="btn btn-primary btn-xs" onclick="emp_role()">Search</button>
            &nbsp;
            <button type="button" class="btn btn-primary btn-xs" onclick="role_drop()" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Assign LMS Role</button>
            &nbsp;
           
            <!--<button type="button" class="btn btn-primary btn-xs" onclick="erp_role_drop()" data-toggle="modal" data-target="#erp_exampleModal" data-whatever="@mdo">Assign ERP Role</button>-->

             <button type="button" class="btn btn-primary btn-xs" onclick="multi_role_drop()" data-toggle="modal" data-target="#erp_exampleModal-mul" data-whatever="@mdo">Multiple Role</button>

            &nbsp;
            <button type="button" class="btn btn-success btn-xs" onclick="view_all_permission()"> Special Permissions</button>
</div>
</div>
            </div>
            <!-- /.card-header -->
            <div class="row"  id="div_diivde" style="font-size:12px;" >
               <div class="col-lg-8">
                  <div class="card-body table-responsive  " id="role_assign" style="height: 600px;">
                     <!-- /.card-body -->
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="card-body table-responsive  " id="permission_assign" style="height: 600px;">
                     <!-- /.card-body -->
                  </div>
               </div>
            </div>
            <!-- <div class="card-body table-responsive  "  style="height: 600px;"> -->
            <div class="row card-body table-responsive "  id="all_permissions"  >
           
                  </div>
                  </div>
            <!-- /.card -->
         <!-- </div> -->
         <!-- /.card -->
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div id="role_drop_dwon">
         <form action="action.php" method="post">
         
      </form>
      </div>
      </div>
   </div>
</div>
<div class="modal fade" id="erp_exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign ERP Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div id="erp_role_drop_dwon">
         <form action="action.php" method="post">
         
      </form>
      </div>
      </div>
   </div>
</div>



  <div class="modal fade bd-example-modal-xl"  id='erp_exampleModal-mul' tabindex="-1" role="dialog" 
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Multi Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="multi_role_drop_dwon">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" onclick="add_addrole()">Save changes</button> 
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
//   function emp_role()
// {
//    $('#div_diivde').show();
//         var code=32; //70
// var user_id= document.getElementById("user_id").value;
// // alert(user_id);
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function() {
//     if (xmlhttp.readyState==4 && xmlhttp.status==200)
//     {
//       //document.getElementById("role_assign").innerHTML='dfgdfg';
//       document.getElementById("role_assign").innerHTML=xmlhttp.responseText;
//       emp_permission();
//       emp_role_all(user_id);
      

//     }
//   }
//   xmlhttp.open("GET", "get_action.php?user_id=" + user_id+"&code="+code, true);
//   xmlhttp.send();
// }
    function view_all_permission() {
      $('#all_permissions').show();
      var user_id= document.getElementById("user_id").value;
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
   var code = 173;
   $.ajax({
      url: 'action_g.php',
      type: 'POST',
      data: {
         code: code,empid:user_id
      },
      success: function(response) {
         // console.log(response);
         spinner.style.display = 'none';
         document.getElementById("all_permissions").innerHTML = response;
         $('#div_diivde').hide();
      }
   });
 
}

function date_change(id) 
{
   // alert(id);
   var start_date= document.getElementById("sid_"+id).value;
   var end_date= document.getElementById("eid_"+id).value;
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
   var code = 174;
   $.ajax({
      url: 'action_g.php',
      type: 'POST',
      data: {
         code: code,id:id,start_date:start_date,end_date:end_date
      },
      success: function(response) {
         // console.log(response);
         spinner.style.display = 'none';
         if(response==1)
         {
            view_all_permission();
            SuccessToast('Updated');
         }else{
            
         }
      }
   });
   
}
function delete_special_permission(id) 
{
   var a=confirm('Are you sure you want to delete special permissions '+id);
   // alert(id);
   if (a==true) {
      var spinner = document.getElementById("ajax-loader");
      
      // alert(id);
      spinner.style.display = 'block';
      var code = 175;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: {
            code: code,id:id
         },
         success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               view_all_permission();
               SuccessToast('Successfully  Delete');
               
            }else
            {
               
            }
         }
      });
   }
 
}
function deleteRole(empid,userMasterId) 
{
   var a=confirm('Are you sure you want to delete  '+empid);
   // alert(id);
   if (a==true) {
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 182;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: {
            code: code,empid:empid,userMasterId:userMasterId
         },
         success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               erp_role_drop();
               SuccessToast('Successfully  Deleted');
               
            }
            else
            {
               
            }
         }
      });
   }
 
}
function updateRole(empid,userMasterId) 
{

   var RightsLevel = document.getElementById("RightsLevel").value;
   var LoginType = document.getElementById("LoginType").value;
      // alert(LoginType+RightsLevel);
   var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 183;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,userMasterId:userMasterId,RightsLevel:RightsLevel,LoginType:LoginType
         },
         success: function(response) 
         {
            console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               // erp_role_drop();
               SuccessToast('Successfully  Updated');
               erp_role_drop();
               
            }
            else
            {
               
            }
         }
      });
   }

function addRole(empid,college) 
{

   var RightsLevel = document.getElementById("RightsLevel").value;
   var LoginType = document.getElementById("LoginType").value;
  
   // alert(LoginType+RightsLevel);
   if(RightsLevel!='' && LoginType!='' )
   {
   var spinner = document.getElementById("ajax-loader");
   // spinner.style.display = 'block';
      var code = 184;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,RightsLevel:RightsLevel,LoginType:LoginType,college:college
         },
         success: function(response) 
         {
            console.log(response);
            // spinner.style.display = 'none';
            if(response=='1')
            {
               erp_role_drop();
               SuccessToast('Successfully  Inserted');
               
            }
            else
            {
               ErrorToast('try','bg-danger' );
            }
         }
      });
   }
   else
   {
      ErrorToast('all inputs required','bg-danger' );
   }
}



function erp_role_drop()
{
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
   var id= document.getElementById("user_id").value;
   var code=181; 
   $.ajax({
      url: 'action_g.php',
      type: 'POST',
      data: {
         code: code,id:id
      },
      success: function(response) {
         // console.log(response);
         spinner.style.display = 'none';
         document.getElementById("erp_role_drop_dwon").innerHTML = response;
      }
   });
}



function multi_role_drop()
{
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
   var id= document.getElementById("user_id").value;
   var code=181.1; 
   $.ajax({
      url: 'action_g.php',
      type: 'POST',
      data: {
         code:code,id:id
      },
      success: function(response) {
         // console.log(response);
         spinner.style.display = 'none';
         document.getElementById("multi_role_drop_dwon").innerHTML = response;
      }
   });
}
function add_addrole()
{
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
   var id= document.getElementById("user_id").value;
      var add_addroleid= document.getElementById("add_addroleid").value;
   if(id!='')
   {

   var code=184.1; 
   $.ajax({
      url: 'action_g.php',
      type: 'POST',
      data: {
         code:code,id:id,add_addroleid:add_addroleid
      },
      success: function(response) {
          console.log(response);
         spinner.style.display = 'none';
          SuccessToast('Successfully  Added');
      }
   });
}
}


</script>
<?php include "footer.php";  ?>