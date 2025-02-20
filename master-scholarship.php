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
                  <h3 class="card-title">Registartion</h3>
               </div>
             
                  <div class="card-body">
                     <div class="form-group row">  
           <div class="col-lg-6">
                        <label >Name of scholarship</label>
               
                  <input type="text" class="form-control" id="scholarship_name" value="">
               </div>  <div class="col-lg-6">
                  <label> Details</label>

                   <input type="text" class="form-control" id="details" value="">
                </div>
                <div class="col-lg-6">
                  
                  
                                 <label><b>Start Date </b></label>
                                 <input type="date" class="form-control" id="startdate" name="date">
                                 <!--<input type="submit">-->
                               
                    <!--<input type="text" class="form-control" id="address" value="">-->
                 </div> <div class="col-lg-6">
                                 <label><b>End  Date  </b></label>
                                 <input type="date" class="form-control" id="end_date" name="date">
                                 <!--<input type="submit">-->
                                
                  </div>


                    
               </div>
              <button class="btn btn-primary" onclick='add_scholarship();'><i class="fa fa-plus"></i>ADD</button>
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
                    <div id='scholarship-data'></div>
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
            <div class="modal-body" id="scholarship-data-edit">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 
              <button type="submit" class="btn btn-primary" onclick="scholarshipupdate()">Save</button>
            </div>
      </div>
   </div>
</div>

<script type="text/javascript">
 viewScholarshp();

   function edit_scholarship(id)
{  
   //alert(id);
var code='1.1';
$.ajax({
url:'action_c.php',
data:{flag:code,id:id},
type:'POST',
success:function(data){
document.getElementById('scholarship-data-edit').innerHTML=data;
}
});

}
function scholarshipupdate()
{
        var scholarship_name1 = document.getElementById("scholarship_name1").value;
        var scholarship_details1 = document.getElementById("details1").value;
        var scholarship_startdate1 = document.getElementById("startdate1").value;
        var scholarship_enddate1 = document.getElementById("enddate1").value;
        var scholarship_id = document.getElementById("scholarship_id").value;
     //alert(scholarship_enddate1);
    if (scholarship_name!='') 
    {
var code=1.2;
      $.ajax({
    url: 'action_c.php',
    data: {scholarship_name:scholarship_name1,scholarship_details:scholarship_details1,scholarship_startdate:scholarship_startdate1,flag:code,scholarship_enddate:scholarship_enddate1,scholarship_id:scholarship_id},
    type: 'POST',
    success: function(response)
     {
    console.log(response);
    if (response==1) {
         SuccessToast('Successfully Updated');

         ViewScholarship();
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


viewScholarshp();



function add_scholarship() 
{
        var scholarship_name1 = document.getElementById("scholarship_name").value;
        var scholarship_details1 = document.getElementById("details").value;
        var scholarship_startdate1 = document.getElementById("startdate").value;
        var scholarship_enddate1 = document.getElementById('end_date').value;
         (scholarship_startdate1+'-'+scholarship_enddate1+'-')
    if (scholarship_name1!='' && scholarship_details1!=null) 
    {
var code=1;
      $.ajax({
    url: 'action_c.php',
    data: {scholarship_name:scholarship_name1,scholarship_details:scholarship_details1,scholarship_startdate:scholarship_startdate1,scholarship_enddate:scholarship_enddate1,flag:code},
    type: 'POST',
    success: function(response)
     {
    viewScholarshp();
     console.log(response);
    if (response==1) {
         SuccessToast('Successfully Inserted');
        
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

function viewScholarshp() 
{ 

var code='1.3';
$.ajax({
url:'action_c.php',
data:{flag:code},
type:'POST',
success:function(data){

document.getElementById('scholarship-data').innerHTML=data;
}
});

}
</script>

<?php include "footer.php";  ?>