<?php 

include "header.php";
 ?>
 <script type="text/javascript">

      function emp_detail_verify(id){
   var code=51;
    //alert(a);
  
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,
            },
            success:function(response) 
            {  
              
                  document.getElementById("emp_detail_status_").innerHTML =response;
               
               
            }
         });
      }     
       function emp_detail_verify_for(id){
   var code=51;
    //alert(a);
  
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,
            },
            success:function(response) 
            {  
              
                  document.getElementById("emp_detail_status_for").innerHTML =response;
               
               
            }
         });
      } 
                     function team_show() 
                     {
            var x = document.getElementById("other_div");
            var z = document.getElementById("self_div");
            var y = document.getElementById("team_div");
            document.getElementById("other_div").value="";
            document.getElementById("self_div").value="";
            document.getElementById("emp_detail_status_").innerHTML="";


              x.style.display = "none";
              y.style.display = "block";
              z.style.display = "none";

                  }
   function other_show() {
  var x = document.getElementById("team_div");
  var y = document.getElementById("other_div");
  var z = document.getElementById("self_div");
 document.getElementById("team_div").value="";
 document.getElementById("self_div").value="";
 document.getElementById("emp_detail_status_").innerHTML="";
    x.style.display = "none";
    y.style.display = "block";
    z.style.display = "none";


}   
 function self_show() {

  var id = document.getElementById("emp_id").value;
  var x = document.getElementById("team_div");
  var y = document.getElementById("other_div");
  var z = document.getElementById("self_div");
 document.getElementById("emp_detail_status_").innerHTML="";
 document.getElementById("team_div").value="";
 document.getElementById("other_div").value="";

 document.getElementById("self_div").value=id;

    x.style.display = "none";
    y.style.display = "none";
    z.style.display = "block";


} 
                  function forward_team_show() 
                     {
  var x = document.getElementById("forward_other_div");
  document.getElementById("forward_other_div").value="";
  var y = document.getElementById("forward_team_div");
  document.getElementById("emp_detail_status_for").innerHTML="";

    x.style.display = "none";
    y.style.display = "block";

}
   function forward_other_show() {
  var x = document.getElementById("forward_team_div");
  var y = document.getElementById("forward_other_div");
 document.getElementById("forward_team_div").value="";
  document.getElementById("emp_detail_status_for").innerHTML="";

    x.style.display = "none";
    y.style.display = "block";


} 

function create_task()
{
  var task_name = document.getElementById("task_name").value;
  var task_discription = document.getElementById("task_discription").value;
  var team_id = document.getElementById("team_div").value;
  var other_id = document.getElementById("other_div").value;
  var self_id = document.getElementById("self_div").value;
  var assignTo=team_id+other_id+self_id;
  var end_date = document.getElementById("end_date").value;
 var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
     
           var code=10;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,task_name:task_name,task_discription:task_discription,assignTo:assignTo,end_date:end_date
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                // console.log(response);
                if (response==1) {
                  SuccessToast('Success');
                  $("#createTaskModal").modal('hide');
                  my_task();
                }
                else
                {

                }
                 // document.getElementById("question_count").innerHTML=response;
              }
           });
}

function  forward_set_id(id)
{
 document.getElementById("Token_No").value=id;

}
function forward_task()
{
  var forward_remarks = document.getElementById("forward_remarks").value;
  var Token_No = document.getElementById("Token_No").value;
  var team_id = document.getElementById("forward_team_div").value;
  var other_id = document.getElementById("forward_other_div").value;
  var assignTo=team_id+other_id;
  var end_date = document.getElementById("forward_end_date").value;
 var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=13;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,assignTo:assignTo,end_date:end_date,Token_No:Token_No,forward_remarks:forward_remarks
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                if (response==1) {
                  SuccessToast('Success');
                     $("#ForwardTaskModal").modal('hide');
                  my_task();
                }
                else
                {

                }
                 // document.getElementById("question_count").innerHTML=response;
              }
           });
}

function my_task()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=11;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                // console.log(response);

                if (response==1) {
                  SuccessToast('Success');
                  my_task();
                }
                else
                {

                }
                 document.getElementById("data_show").innerHTML=response;
              }
           });
}
function assign_task()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=12;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                // console.log(response);
                if (response==1) {
                  SuccessToast('Success');
                  my_task();
                }
                else
                {

                }
                 document.getElementById("data_show").innerHTML=response;
              }
           });
}
function task_timeline(Token_No)
{
 // alert(Token_No);
 var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=14;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,Token_No:Token_No
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                // console.log(response);
                if (response==1) {
                  SuccessToast('Success');
                }
                else
                {

                }
                 document.getElementById("view_timeline_data").innerHTML=response;
              }
           });
}
function submit_marks(ID)
{
 // alert(Token_No);
  var Marks = document.getElementById("marks").value;
  var Remarks = document.getElementById("remarks").value;
  var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=15;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,ID:ID,Marks:Marks,Remarks:Remarks
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                // console.log(response);
                if (response==1) {
                  SuccessToast('Success');
                  
                  my_task();
                }
                else
                {

                 document.getElementById("view_timeline_data").innerHTML=response;
                }
              }
           });
}

window.onload = function() {
  my_task();
};
 </script>

                  <div class="modal fade" id="ViewTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Task Timeline</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                      <div class="modal-body" id="view_timeline_data">
                           

                      </div>
                      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary" onclick="forward_task();">Submit</button> -->
      </div>
                    </div>
                  </div>
                  </div>
<!-- ----------------- -->

                  <div class="modal fade" id="ForwardTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Forward Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                      <div class="modal-body">
                            <div class="row">
                              <input type="hidden" name="" id="Token_No">
                 <div class="col-lg-3">
                 <label>Forward To</label>
                </div>
                <div class="col-lg-4">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary3" name="forward1" onclick="forward_team_show();" checked>
                        <label for="radioPrimary2">
                          Team
                        </label>
                      </div>
                </div>
                 <div class="col-lg-4">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary4" onclick="forward_other_show();" name="forward1" >
                        <label for="radioPrimary1">
                          Other
                        </label>
                      </div>
                </div> 
                
               
                </div>
             <div class="row">
              <div class="col-lg-12">
                <select class="form-control" id="forward_team_div">
                  <option value="">Select</option>
                   <?php 
                  $dropdown_team="SELECT * FROM Staff WHERE LeaveRecommendingAuthority='$EmployeeID' or LeaveSanctionAuthority='$EmployeeID' ";
                   $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                 while($dropdown_row_staff = sqlsrv_fetch_array($dropdown_team_run, SQLSRV_FETCH_ASSOC) )
                 {
                     $jobStatus=$dropdown_row_staff['JobStatus'];
                    if ($jobStatus==1) {
                      // code...
                    
                      ?>   
                  <option value="<?=$dropdown_row_staff['IDNo'];?>"><?=$dropdown_row_staff['Name'];?></option>
                     <?php 
                    }
                     // $aaa[]=$dropdown_row_staff;
                 }

                   ?>
                </select>
                <?php  //print_r($aaa);?>
                  <input type="text" class="form-control" placeholder="Emp ID" id="forward_other_div" onkeyup="emp_detail_verify_for(this.value)" style="display: none;">
                    <p id="emp_detail_status_for"></p>
                 
                </div>
                <div class="col-lg-12">
                <label>End Date</label>
                  <input type="date" class="form-control" placeholder="Emp ID" id="forward_end_date">
                </div>
                 <div class="col-lg-12">
                <label>Remarks</label>
                  <textarea  class="form-control"  id="forward_remarks"></textarea>
                </div>
                </div>
                      </div>
                      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="forward_task();">Submit</button>
      </div>
                    </div>
                  </div>
                  </div>

<!-- Modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                      <div class="modal-body">
                        <label>Task Name</label>
                    <input type="text" class="form-control" id="task_name">  

                    <label>Discription</label>
                    <textarea  class="form-control" id="task_discription" ></textarea>

                        <div class="row">
                 <div class="col-lg-3">
                 <label>Assign To</label>
                </div>
                <div class="col-lg-3">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" name="team1" onclick="team_show();" checked>
                        <label for="radioPrimary2">
                          Team
                        </label>
                      </div>
                </div>
                 <div class="col-lg-3">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary1" onclick="other_show();" name="team1" >
                        <label for="radioPrimary1">
                          Other
                        </label>
                      </div>
                </div>
                <div class="col-lg-3">
                  <div class="icheck-primary d-inline">
                    <input type="hidden" value="<?=$EmployeeID;?>" id="emp_id">
                        <input type="radio" id="radioPrimary5" onclick="self_show();" name="team1" >
                        <label for="radioPrimary1">
                          Self
                        </label>
                      </div>
                </div>
               
                </div>
             <div class="row">
              <div class="col-lg-12">
                <select class="form-control" id="team_div">
                  <option value="">Select</option>
                  <?php 
                  $dropdown_team="SELECT * FROM Staff WHERE LeaveRecommendingAuthority='$EmployeeID' or LeaveSanctionAuthority='$EmployeeID'";
                   $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                 while($dropdown_row_staff = sqlsrv_fetch_array($dropdown_team_run, SQLSRV_FETCH_ASSOC) )
                 {
                     $jobStatus=$dropdown_row_staff['JobStatus'];
                     if ($jobStatus==1) {
                      // code...
                      ?>   
                  <option value="<?=$dropdown_row_staff['IDNo'];?>"><?=$dropdown_row_staff['Name'];?></option>
                     <?php 
                    
                     }
                 }
                   ?>
                </select>
                  <input type="text" class="form-control" placeholder="Emp ID" onkeyup="emp_detail_verify(this.value)" id="other_div" style="display: none;">
                  <p id="emp_detail_status_"></p>
                   <input type="hidden" class="form-control" value="<?=$EmployeeID;?>" id="self_div" style="display: none;">
                </div>
                </div>
                       <label>End Date</label>
                    <input type="date" class="form-control" id="end_date">
                    </div>
                
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="create_task();">Submit</button>
      </div>
    </div>
  </div>
</div>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

        <div class="card-header">

          <h3 class="card-title">Task</h3>

          <div class="card-tools">
          <button type="button" data-toggle="modal" data-target="#createTaskModal" class="btn btn-primary" >
             ADD NEW
            </button> 
           <!--  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button> -->
          </div>
        </div>
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active"  data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" onclick="my_task();"><b>My Task</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="assign_task();"><b>Assign Task</b></a>
                     </li>
                  </ul>
        <div class="card-body p-0" id="data_show">
      
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <?php 


include "footer.php";


?>