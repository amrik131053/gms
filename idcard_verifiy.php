<?php 
  ini_set('max_execution_time',0);
  include "header.php";   
?>

  <?php

 $get_pending="SELECT * FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.Status='Applied' ";
 $get_pending_run=sqlsrv_query($conntest,$get_pending);
 if($row_pending=sqlsrv_fetch_array($get_pending_run))
 {
    $data[]=$row_pending['IDNO'];
   //  $data[]=array_push($data,$row_pending['StudentName'],$row_pending['FatherName'],
   //  $row_pending['Course'],$row_pending['Batch'],$row_pending['ClassRollNo'],$row_pending['StudentMobileNo'],$row_pending['DOB']->format('Y-m-d'),
   //  $row_pending['PermanentAddress'],$row_pending['District'],$row_pending['State'],$row_pending['PIN']);
 }
// print_r($data);
?>
<div class="modal fade" id="imageexampleModal" tabindex="-1" role="dialog" aria-labelledby="imageexampleModalLabel" aria-hidden="true" style='z-index:9999;'>
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="imageexampleModalLabel">Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row" id="image_view">
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary"></button> -->
         </div>
      </div>
   </div>
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-md-6 col-lg-6 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Pending&nbsp;(<span id="pending_count"></span>)</h3>
                 <button type="button" onclick="show_all();" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#all_showexampleModal"  style="float:right;">Show All</button>
                 
               </div>
               
                  <div class="card-body">
                  <div class="card-body table-responsive " id="pending_record" style="height:600px;" >
                  
                        </div>
                        </div>
            </div>

         </div>
       
            <div class="col-lg-6 col-md-6 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                  <h3 class="card-title">Rejected&nbsp;(<span id="reject_count"></span>)</h3>
                  <button type="button" class="btn btn-primary btn-xs" onclick="reject_show_idcard();" style="float:right;">Show All</button>
                 
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body"  >
                  <div class=" table-responsive " id="reject_record" style="height:600px;"  >
                   
                        </div>
                        </div>
                 
               </div>
              
            </div>
      
        
      </div>
      
   </div>
 
</section>

<div class="modal fade" id="rejectexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_record_reject">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_record">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="all_showexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      <div id="div_all" >
                  <div class="card" ></div>
                  
               </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<script>
    
    function view_pending(id)
    {
       
               var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=143;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               
               spinner.style.display='none';
                document.getElementById("view_record").innerHTML=response;
                
              }
           });
          
         }
    
    function view_rejected(id){
        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=144;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               
               spinner.style.display='none';
                document.getElementById("view_record_reject").innerHTML=response;
                
              }
           });
          
    }
    function verify_idcard(id){
        // var spinner=document.getElementById("ajax-loader");
    //  spinner.style.display='block';
     var code=145;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               pending_show_idcard();
                   set_count_pending();
                   set_count_reject();
                   show_all();
               if(response=='1')
               {
                   SuccessToast('Success Verifiy');
                  //  pending_show_idcard();
                  //  set_count_pending();
                  //  set_count_reject();
               }
               else
               {

               }
                
              }
           });
          
    }
    function reject_idcard(id){
        // var spinner=document.getElementById("ajax-loader");
    //  spinner.style.display='block';
    var remarks=document.getElementById('Remarks'+id).value;
    if(remarks!='')
    {
     var code=146;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id,remarks:remarks
              },
              success: function(response) 
              {
               reject_show_idcard();
                   set_count_pending();
                   set_count_reject();
                   show_all();
            //    spinner.style.display='none';
               if(response=='1')
               {
                   SuccessToast('Successfully Rejected');
                  
               }
               else
               {

               }
                
              }
           });
         }
         else
         {
            ErrorToast('Enter Remarks','bg-warning');
         }
          
    }
    function pending_show_idcard(){
        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=147;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
               spinner.style.display='none';
               set_count_pending();
               set_count_reject();
               show_all();
               document.getElementById("pending_record").innerHTML=response;
            //    $('#example').DataTable({ 
                    //   "destroy": true, //use for reinitialize datatable
                //    });
              }
           });
          
    }
    function reject_show_idcard(){
        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=148;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
               spinner.style.display='none';
               set_count_pending();
               set_count_reject();
              
               document.getElementById("reject_record").innerHTML=response;
            //    $('#example').DataTable({ 
                    //   "destroy": true, //use for reinitialize datatable
                //    });
              }
           });
          
    }
    function set_count_pending(){
     var code=149;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
              
               document.getElementById("pending_count").innerHTML=response;
               
              }
           });
          
    }
    function set_count_reject(){
     var code=150;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
              
               document.getElementById("reject_count").innerHTML=response;
               
              }
           });
          
    }
    pending_show_idcard();
    reject_show_idcard();

function show_all() {
   var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=151;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
               spinner.style.display='none';
               document.getElementById("div_all").innerHTML=response;
          
              }
           });
                 
      
}

function uploadImage(form, id) {
      var formData = new FormData(form);
      $.ajax({
         url: form.action,
         type: form.method,
         data: formData,
         contentType: false,
         processData: false,
         success: function(response) {
            console.log(response);
            SuccessToast('Successfully Uploaded');
            view_image(id);
            show_all();
         },
         error: function(xhr, status, error) {
            console.log(error);
         }
      });
   }
   function view_image(id) {
                     var code = 152;
                     $.ajax({
                        url: 'action_g.php',
                        type: 'post',
                        data: {
                           uni: id,
                           code: code
                        },
                        success: function(response) {
                           // console.log(response);
                           document.getElementById("image_view").innerHTML = response;
                        }
                     });
                  }
</script>


<?php include "footer.php";  ?>