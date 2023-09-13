<?php 
   ini_set('max_execution_time', '0');
   include "header.php";  
   include "connection/connection.php"; 
   ?>
   <p id="ajax-loader"></p>
<section class="content">
   <div class="container-fluid">
       
      <div class="row">
         <!-- left column -->
          
 <div class="col-lg-4">
   <label>Code/Emp ID</label>
                      <input type="text" class="form-control" required="" id="subject_code" placeholder="Emp ID">
                  </div>
                  <div class="col-lg-1">
                     <label>Action</label><br>
                     <button type="button" class="btn btn-info" onclick="search_code()">Search</button>
                  </div>
                  <!-- <div class="col-lg-2">
                     <label>Action</label><br>
                     <button type="button" class="btn btn-warning" onclick="check_question()">Check Question</button>
                  </div>
                   <div class="col-lg-2">
                     <label>Count</label><br>
                     <button type="button" class="btn btn-success" ><b id="question_count"></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                
                  </div> -->
                  
</div>
      <br>
      <br>
 <div class="row">
          <!-- left column -->
          <div class="col-lg-12 col-md-12 col-sm-12">
   
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Reports</h3>
              </div>
        
             <!--  <form class="form-horizontal" action="" method="POST"> -->
      
                 
 <div class="card-body table-responsive"  id="question_show" style="font-size:10px;">
                            
                             
                           </div>
</div>
</div>
</div>
</div>

</section>
<div class="modal fade" id="modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Update Question</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12" id="question">
                  <label>Question</label>          
                  <div class="click2edit" id="question_edit"></div>
                  <input type="hidden" name="" id="question_id">
               </div>
            </div>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="save" class="btn btn-primary" data-dismiss="modal" onclick="save()"  type="button">Save</button>
            <!-- <button type="submit" class="btn btn-success">Save changes</button> -->
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<script type="text/javascript">

   function check_question()
   {

   var spinner=document.getElementById("ajax-loader");
   var subject_code=document.getElementById('subject_code').value;
   // alert(subject_code);
     spinner.style.display='block';
           var code=193;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,subject_code:subject_code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("question_count").innerHTML=response;
              }
           });


   }  
    function search_code()
   {
   var spinner=document.getElementById("ajax-loader");
   var subject_code=document.getElementById('subject_code').value;
     spinner.style.display='block';
           var code=185;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,subject_code:subject_code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("question_show").innerHTML=response;
              }
           });


   }
   function update_question(id)
   {
    
          var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
           var code=131;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("question_edit").innerHTML=response;
                 document.getElementById("question_id").value=id;
                 edit();
              }
           });
        }

        // var edit = function() {
      function edit(){
    $('.click2edit').summernote({focus: true,toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ]});
   }
   // };
   
   var save = function() {
    var markup = $('.click2edit').summernote('code');
    var id=document.getElementById('question_id').value;
        var code=132;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,question_new:markup,id:id
              },
              success: function(response) 
              {
               
                 SuccessToast('Successfully Updated');
                
              }
           });
    $('.click2edit').summernote('destroy');
   };
   
   $('#modal-lg').on('hidden.bs.modal', function () {
    $('.click2edit').summernote('destroy');
      var code_access = '<?php echo $code_access; ?>';
        var subCode=sanitize(document.getElementById("subject_code").value);
      var courseId=sanitize(document.getElementById("Course").value);
      var batch=sanitize(document.getElementById("Batch").value);
      var sem=sanitize(document.getElementById("Semester").value);
      var unit=sanitize(document.getElementById("unit").value);
      var type=sanitize(document.getElementById("type").value);

    if(subject_code!='')
    {
       var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
       var code = "127";
           $.ajax({
           url:'action.php',
           data:{code:code,code_access:code_access,subCode:subCode,courseId:courseId,batch:batch,sem:sem,unit:unit,type:type},
           type:'POST',
           success:function(data){
               spinner.style.display='none';
               // SuccessToast('Successfully Updated');
              document.getElementById("table_load").innerHTML=data;
               $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
           }
         });
    }
    else
    {
      location.reload(true);
       $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });

    }
   })
</script>



<?php include "footer.php";

?>