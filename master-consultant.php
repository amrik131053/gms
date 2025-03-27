<?php 
  ini_set('max_execution_time',0);
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-md-4 col-lg-4 col-sm-4">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">New Consultant</h3>
               </div>
                  <div class="card-body">
                     <div class="form-group row">  
           <div class="col-lg-6">
                        <label >Name</label>
               
                  <input type="text" class="form-control" id="consultant_name" value="">
               </div>  <div class="col-lg-6">
                  <label>Mobile</label>

                   <input type="text" class="form-control" id="Mobile" value="">
                </div>
                <div class="col-lg-6">
                  
                   <label>Address</label>
                    <input type="text" class="form-control" id="address" value="">
                 </div> 
                 <div class="col-lg-6">
                    <label>Organisation</label>
                     <input type="text" class="form-control" id="organisation" value="">
                  </div>
                 <div class="col-lg-6">
                    <label>Email ID (For Login)</label>
                     <input type="email" class="form-control" id="email" value="">
                  </div>
                 <div class="col-lg-6">
                    <label>Create Password</label>
                     <input type="text" class="form-control" id="password" value="">
                  </div>


                    
               </div>
              <button class="btn btn-primary" onclick="add_consultant();"><i class="fa fa-plus" ></i>ADD</button>
            </div>

      </div>
                       
                         

         </div>
       
            <div class="col-lg-8 col-md-8 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title"></h3>
                     <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                           
                           
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 650px;">
                    <div id='consultant-data'></div>
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

<div  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
              
                  
            <input type="hidden" name="code" value="">
            <div class="modal-body" id="consultant-data-edit">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary" onclick="consultantupdate()">Save</button>
            </div>
               
        
      </div>
   </div>
</div>

<script type="text/javascript">

   function edit_consultant(id)
   
{  
   //alert(id);
var code='26.6';
$.ajax({
url:'action_a.php',
data:{flag:code,id:id},
type:'POST',
success:function(data){
document.getElementById('consultant-data-edit').innerHTML=data;
}
});

}

 ViewConsultant() ;

function consultantupdate() 
{
 
   
        var consultant_m = document.getElementById("Mobile-e").value;
        var consultant_a = document.getElementById("address-e").value;
        var consultant_o = document.getElementById("organisation-e").value;
        var consultant_id = document.getElementById("consultant_id").value;
           var status_e = document.getElementById("status-e").value;  
            var email_e = document.getElementById("email-e").value;

    if (consultant_m!='' && consultant_a!=null && consultant_o!=null ) 
    {
var code=26.7;
      $.ajax({
    url: 'action_a.php',
    data: {consultant_m:consultant_m,consultant_a:consultant_a,consultant_o:consultant_o,flag:code,consultant_id:consultant_id,status_e:status_e,email_e:email_e},
    type: 'POST',
    success: function(response)
     {
    console.log(response);
    if (response==1) {
         SuccessToast('Successfully Updated');
         ViewConsultant();
   }
   else
   {
      ErrorToast('Try after some time ','bg-warning');
   }
  },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
   
    }
  });
}
else
{
   ErrorToast('All Input Required ','bg-warning');
}
}

















function add_consultant() 
{
  // alert();
  
    var consultant_name = document.getElementById("consultant_name").value;
      var consultant_m = document.getElementById("Mobile").value;
        var consultant_a = document.getElementById("address").value;
          var consultant_o = document.getElementById("organisation").value;
          var email = document.getElementById("email").value;
          var password = document.getElementById("password").value;
    if (consultant_name!='' && consultant_name!=null && email!='' && password!='') 
    {
var code=135;
      $.ajax({
    url: 'action_g.php',
    data: {email:email,password:password,consultant_name:consultant_name,consultant_m:consultant_m,consultant_a:consultant_a,consultant_o:consultant_o,code:code},
    type: 'POST',
    success: function(response)
     {
   //  console.log(response);
    if (response==1) {
         SuccessToast('Successfully Inserted');
         ViewConsultant();
   }
   else if (response==3) {
      ErrorToast('email and mobile number already exists ','bg-warning');
         ViewConsultant();
   }
   else
   {
      ErrorToast('Try after some time ','bg-warning');
   }
  },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
   
    }
  });
}
else
{
   ErrorToast('All Input Required ','bg-warning');
}
}

function ViewConsultant() 
{  
var code='26.5';
$.ajax({
url:'action_a.php',
data:{flag:code},
type:'POST',
success:function(data){
document.getElementById('consultant-data').innerHTML=data;
}
});

}
</script>

<?php include "footer.php";  ?>