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
            <button type="button" class="btn btn-primary btn-xs" onclick="role_drop()" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Assign Role</button>
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
</script>
<?php include "footer.php";  ?>