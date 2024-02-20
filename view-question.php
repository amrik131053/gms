<?php 
ini_set('max_execution_time', '0');
   include "header.php";   
    $code_access;
   ?>
<script>
   $(document).ready(function(){
   
       $(document).on('keydown','.subject_code', function() {
   
           // Initialize jQuery UI autocomplete
           $(".subject_code").autocomplete({
                 source: function( request, response ) {
               $.ajax({
         
               url: "action.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,code:116
                 },
                 success: function( data ) {
                     response( data );
                     //console.log(data);
                 },
                 error: function (error) {
                 //console.log(error);
                  }
               });
             },
             select: function (event, ui) {
               $(this).val(ui.item.label); // display the selected text
               var subject_code = ui.item.value; // selected value
   
                       
             return false;
             }
           });
       });
     });
</script>
<section class="content">
   <div class="container-fluid">
      <div class="card card-info">
      </div>
      <!--  <div class="row"> -->
      <!-- left column -->
      <!-- <div class="col-lg-12 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">Upload Questions</h3>
              
             <b id="total_count"></b>
            </div> -->
      <!--  <form class="form-horizontal" action="" method="POST"> -->
      <!--  <div class="card-body" id="" >
         <div class="row"> -->
      <!-- left column -->
      <!--   <div class="col-lg-2 col-md-4 col-sm-3">
         <label>Subject Code<b style="color:red;">*</b></label>
         <Input type="text"  class="form-control subject_code"  name="subject_code" id="subject_code"  required="" />
         </div> -->
      <!-- /.row -->
      <!--  </div>
         </div> -->
      <!-- /.card-footer -->
      <!-- </form> -->
      <!--   </div> -->    
      <div class="row">
         <div class="col-lg-12 col-sm-6">
            <div class="card card-primary card-tabs">
               <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active"  data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" onclick="update_questions();">Update</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="locked_questions();">Lock</a>
                     </li>
                  </ul>
               </div>
               <div class="card-body">
                  <div class="tab-content" id="data_loaded">
                     <div class="row">
                  <!-- left column -->
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Subject Code<b style="color:red;">*</b></label>
                     <Input type="text"  class="form-control subject_code" onchange="load_course()"  name="subject_code" id="subject_code"  required="" />
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Course<b style="color:red;">*</b></label>
                     <select name="Course" id="Course" class="form-control" >
                        <option value=''>Select Course</option>
                     </select>
                  </div>
                 <!--  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Subject Name<b style="color:red;">*</b></label>
                     <select name="subName" id="subName" class="form-control" onchange="">
                        <option value=''>Select Subject</option>
                     </select>
                  </div> -->
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Batch<b style="color:red;">*</b></label>
                     <select name="batch"  class="form-control" id="Batch" required="" onchange="">
                        <option value="">Batch</option>
                        <?php 
                           for($i=date('Y', strtotime('-6 year'));$i<=date('Y', strtotime('+0 year'));$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <div class="col-lg-1 col-md-4 col-sm-3">
                     <label> Semester<b style="color:red;">*</b></label>
                     <select   id='Semester' class="form-control" required="" onchange="">
                        <option value="">Sem</option>
                        <?php 
                           for($i=1;$i<=12;$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <div class="col-lg-1 col-md-4 col-sm-3">
                     <label>Unit<b style="color:red;">*</b></label>
                     <select  id='unit' class="form-control" required="" onchange="">
                        <option value="">Select</option>
                        <?php 
                           for($i=1;$i<=4;$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                   <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Type<b style="color:red;">*</b></label>
                     <select id='type' class="form-control" required="" >
                        <option value="">Select</option>
                        <?php
                           $questionTypeQry="SELECT * FROM question_type";
                           $questionTypeRes=mysqli_query($conn,$questionTypeQry);
                           while($questionTypeData=mysqli_fetch_array($questionTypeRes))
                           {
                              ?>
                        <option value="<?=$questionTypeData['id']?>"><?=$questionTypeData['type_name']?></option>
                        <?php
                           }
                           ?>
                     </select>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                      <label>Action<b style="color:red;"></b></label>
                      <button class="form-control btn btn-success" id="subject_code_search" onclick="subject_code_search_update()">Search</button>
                  </div>
                  <!-- /.row -->
               </div>
               <hr>
                  
                        <div id="table_load">
                           <div class="card-body table-responsive ">
                              <table class="table" id="example">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Question</th>
                                       <th>Type</th>
                                       <th>Category</th>
                                       <th>Batch</th>
                                       <th>Sem</th>
                                    <!--    <th>Course</th> -->
                                       <th>Subject Name</th>
                                       <th>Subject Code</th>
                                      
                                       <th>Action</th>
                                    </tr>
                                 </thead >
                                 <tbody >
                                    <?php 
                                       $srno=1;
                                          $showQuestionQry="SELECT * FROM question_bank AS qb INNER JOIN question_category AS qc ON qb.Category=qc.id INNER JOIN
                                       question_type AS qt ON qb.`Type`=qt.id INNER JOIN question_session as qs ON qb.Exam_Session=qs.id WHERE UpdatedBy='$EmployeeID' and lock_status='0' and qs.session_status='1' order by qb.Id DESC LIMIT 0  ";
                                          $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                                          while($showQuestionData=mysqli_fetch_array($showQuestionRun))
                                          {
                                             $CourseID=$showQuestionData['CourseID'];
                                           $SubjectCode=$showQuestionData['SubjectCode'];
                                            
                                            
                                       $sql = "SELECT DISTINCT Course,CourseID,SubjectName from MasterCourseStructure WHERE CourseID ='$CourseID'and SubjectCode ='$SubjectCode' AND Isverified='1'  ORDER BY Course ";
                                       $result = sqlsrv_query($conntest,$sql);
                                       if($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
                                       {
                                       $CourseName=$row["Course"]; 
                                       $SubjectName=$row["SubjectName"]; 
                                       }
                                       
                                             ?>
                                    <tr>
                                       <td><?=$srno;?></td>
                                         <?php 
                                         if ($code_access=='010' || $code_access=='011' || $code_access=='110' || $code_access=='111') 
                                          {
            ?><td data-toggle="modal" data-target="#modal-lg" onclick="update_question(<?=$showQuestionData['Id'];?>,<?=$showQuestionData['Type'];?>);"><?=$showQuestionData['Question']?></td>

                                   <?php }
                                   else
                                       {?>
                                       <td> <?=$showQuestionData['Question']?></td>
                                  <?php }?>
                                       <td><?=$showQuestionData['type_name']?></td>
                                       <td><?=$showQuestionData['category_name']?></td>
                                       <td><?=$showQuestionData['Batch']?></td>
                                        <td><?=$showQuestionData['Semester']?></td>
                                      <!--  <td><?=$CourseName;?></td> -->
                                       <td><?=$SubjectName;?></td>
                                       <td><?=$showQuestionData['SubjectCode']?></td>
                                   
                                       <td>
                                            <?php   
                                            if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                            { 
                                             ?>
                                          <i class="fa fa-upload" data-toggle="modal" data-target="#modal-lg-image"  onclick="upload_image_question(<?=$showQuestionData['Id']?>);" style="color:red;"></i>
                                       <?php 
                                        }
                                           
                                           if ($code_access=='001' || $code_access=='011' || $code_access=='101' || $code_access=='111') 
                                            { 
                                             ?>

                                             &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_question(<?=$showQuestionData['Id']?>);"></i>
                                   <?php  }
                                  ?>
                                       </td>
                                    </tr>
                                    <?php 
                                       $srno++;
                                       }?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                   
                     
                  </div>
               </div>
               <!-- /.card -->
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
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
                  <!-- <label>Question</label>           -->
                  <div class="" id="question_edit"></div>
                  <input type="hidden"  id="question_id">
                  <input type="hidden"  id="type_id">
               </div>
            </div>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button  class="btn btn-primary" data-dismiss="modal" onclick="save()" type="button">Save</button>
            <!-- <button type="submit" class="btn btn-success">Save changes</button> -->
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-lg-image">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Upload Question Image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-lg-12" id="">
                  <form  name="add_name" id="add_name" action="upload_image.php" method="post" enctype="multipart/form-data">
                     <!-- <form name="add_name" id="add_name" action="action.php" method="post"> -->
                     <input type="hidden" id="code" name="code" value="1">
                     <input type="hidden" name="id" id="set_question_id">
                     <div class="table-responsive">
                        <table class="table table-bordered" id="dynamic_field">
                           <tr>
                              <td><input type="file" id="skill" name="skill[]"  class="form-control name_list" required></td>
                              <td><button type="button" name="add" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                           </tr>
                        </table>
                        <input type="submit" name="submit" id="submit" class="btn btn-success" value="Submit" />
                     </div>
                     <hr>
                  </form>
               </div>
               <div class="col-lg-12" id="img_q">
                  
                           
                       
               </div>
            </div>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-lg-view-question">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Uploaded Questions</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="show_upload_q">
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <!--  <button type="submit" class="btn btn-success">Save changes</button> -->
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<script type="text/javascript">
    function showQuestionData(unit,SubjectCode,CourseID,Batch,Semester)
   {
      // alert(unit);
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=188;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,subCode:SubjectCode,courseId:CourseID,batch:Batch,sem:Semester,unit:unit
              },
              success: function(response) 
              {
               // $('#modal-lg-view-question').modal('toggle');
               spinner.style.display='none';
                document.getElementById("row"+unit).innerHTML=response;
                
              }
           });

   }


function load_course()
{
   
     var subject_code =$("#subject_code").val();
     var code = "117";
     //alert(subject_code);
         $.ajax({
         url:'action.php',
         data:{subject_code:subject_code,code:code},
         type:'POST',
         success:function(data){
             if(data != "")
             {
                 $("#Course").html("");
                 $("#Course").html(data);
                 // console.log(data);
             }
   
         }
       });

         var code='151';
         $.ajax({
         url:'action.php',
         data:{subject_code:subject_code,code:code},
         type:'POST',
         success:function(data){
             if(data != "")
             {
                 $("#Batch").html("");
                 $("#Batch").html(data);
                 // console.log(data);
             }
   
         }
       });

         var code='152';
         $.ajax({
         url:'action.php',
         data:{subject_code:subject_code,code:code},
         type:'POST',
         success:function(data){
             if(data != "")
             {
                 $("#Semester").html("");
                 $("#Semester").html(data);
                 // console.log(data);
             }
   
         }
       });

  }


function update_questions()
{
   var code_access = '<?php echo $code_access; ?>';
       var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=159;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,code_access:code_access
              },
              success: function(response) 
              {
         
            document.getElementById('data_loaded').innerHTML=response;
                         spinner.style.display='none';

              }
           });
}
function locked_questions()
{
   var code_access = '<?php echo $code_access; ?>';
       var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=158;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                  code:code,code_access:code_access
              },
              success: function(response) 
              {
         
            document.getElementById('data_loaded').innerHTML=response;
                         spinner.style.display='none';

              }
           });
}



             $('#modal-lg-image').on('hidden.bs.modal', function () {
      var subCode = $("#subject_code").val();

       var code_access = '<?php echo $code_access; ?>';
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
           data:{
code:code,code_access:code_access,subCode:subCode,courseId:courseId,batch:batch,sem:sem,unit:unit,type:type
           },
           type:'POST',
           success:function(data){
               spinner.style.display='none';
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
    }
   })
   function dlt_image(id)
   {
      
      var userid= document.getElementById('set_question_id').value;
          var a=confirm('Are you sure you want to delete Image');
   if (a==true) {
  var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';

      var code=137;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                 upload_image_question(userid);
                SuccessToast('Successfully Delete');
                         spinner.style.display='none';

              }
           });
        }
        else
        {

        }
   }
   $(document).ready(function (e) {    // image upload form submit
           $("#add_name").on('submit',(function(e) {
              e.preventDefault();
             var id= document.getElementById('set_question_id').value;
              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "upload_image.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
   
                      upload_image_question(id);
                        SuccessToast('Successfully Uploaded');
                         spinner.style.display='none';
                  },
                 
              });
           }));
         });
   
   function delete_question(id)
   {
          var a=confirm('Are you sure you want to delete this Question');
   if (a==true) {
  var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';

      var code=140;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                  SuccessToast('Successfully Delete');
                 
                  var code_access = '<?php echo $code_access; ?>';
                    var subCode=sanitize(document.getElementById("subject_code").value);
      var courseId=sanitize(document.getElementById("Course").value);
      var batch=sanitize(document.getElementById("Batch").value);
      var sem=sanitize(document.getElementById("Semester").value);
      var unit=sanitize(document.getElementById("unit").value);
      var type=sanitize(document.getElementById("type").value);

                  if(subject_code!='')
                  {
                     // var spinner=document.getElementById("ajax-loader");
                     spinner.style.display='block';
                     var code = "127";
                     $.ajax(
                     {
                        url:'action.php',
                        data:{code:code,code_access:code_access,subCode:subCode,courseId:courseId,batch:batch,sem:sem,unit:unit,type:type},
                        type:'POST',
                        success:function(data)
                        {
                           spinner.style.display='none';
                         // SuccessToast('Successfully Updated');
                           document.getElementById("table_load").innerHTML=data;
                           $('#example').DataTable({ "destroy": true});
                        }
                     });
                  }
                  else
                  {
                     location.reload(true);
                  }
              }
           });
        }
   }
   
   $(document).ready(function(){
   var i=1;
   $('#add').click(function(){
   i++;
   $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="file" name="skill[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
   });
      
   $(document).on('click', '.btn_remove', function(){
   var button_id = $(this).attr("id"); 
   $('#row'+button_id+'').remove();
   });
   });
   
   
   function upload_image_question(id)
   
   {
   // alert(id);
    document.getElementById("set_question_id").value=id;
      var code=136;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                document.getElementById("img_q").innerHTML=response;
                
              }
           });
   
   }
   
   
   function view_question(SubjectCode,CourseID,Batch,Semester)
   {
      document.getElementById("show_upload_q").innerHTML='';

      
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=134;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,subCode:SubjectCode,courseId:CourseID,batch:Batch,sem:Semester
              },
              success: function(response) 
              {
               // $('#modal-lg-view-question').modal('toggle');
               spinner.style.display='none';
                document.getElementById("show_upload_q").innerHTML=response;
                
              }
           });
   }
   function lockQuestions(SubjectCode,CourseID,Batch,Semester) 
   {
     //alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
      var a=confirm('Are you sure you want to Lock');
   //alert(id);
   if (a==true) {
       var code=133;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,subCode:SubjectCode,courseId:CourseID,batch:Batch,sem:Semester
              },
              success: function(response) 
              {
               $('#modal-lg-view-question').modal('hide');
                locked_questions();
                
              }
           });
        }
        else
      {
   
      }
   }
   
     function sanitize(string) {
     const map = {
        
        '"': '``',
        "'": '`' 
     };
     const reg = /[&<>"'/]/ig;
     return string.replace(reg, (match)=>(map[match]));
     }

       
     function subject_code_search_update()
     {
       var subCode=sanitize(document.getElementById("subject_code").value);
      var courseId=sanitize(document.getElementById("Course").value);
      var batch=sanitize(document.getElementById("Batch").value);
      var sem=sanitize(document.getElementById("Semester").value);
      var unit=sanitize(document.getElementById("unit").value);
      var type=sanitize(document.getElementById("type").value);

      var code_access = '<?php echo $code_access; ?>';
       var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
       var code = "127";
           $.ajax({
           url:'action.php',
           data:{code:code,code_access:code_access,subCode:subCode,courseId:courseId,batch:batch,sem:sem,unit:unit,type:type

           },
           type:'POST',
           success:function(data){
               spinner.style.display='none';
              document.getElementById("table_load").innerHTML=data;
               $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
           }
         });

     }


     function subject_code_search_lock()
   {

     
      mrjida(0);
      $('#example1').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
   }
 
    function mrjida(subject_code) 
    {
     if (subject_code==0) 
     {
        subject_code = $("#subject_code1").val();   
     }
       var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
       var code = "128";
           $.ajax({
           url:'action.php',
           data:{subject_code:subject_code,code:code},
           type:'POST',
           success:function(data){
              //console.log(data);
               spinner.style.display='none';
              document.getElementById("table_load_lock").innerHTML=data;
              $('#example1').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
   
           }
         });
    }
     
     function q_check_count()
     {
        var subCode=sanitize(document.getElementById("subject_code").value);
        var courseId=sanitize(document.getElementById("Course").value);
        var subName=sanitize(document.getElementById("subName").value);
        var batch=sanitize(document.getElementById("Batch").value);
        var sem=sanitize(document.getElementById("Semester").value);
        var unit=sanitize(document.getElementById("unit").value);
        var question=sanitize(document.getElementById("question").value);
        var type=sanitize(document.getElementById("type").value);
        var category=sanitize(document.getElementById("category").value);
                        if (subCode!='' && courseId!='' && subName!='' && batch!='' && sem!='' && unit!='' && type!='' && category!='') 
        {
          //alert(subCode+' '+courseId+' '+subName+' '+batch+' '+sem+' '+unit+' '+type+' '+category);
          var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
           var code=120;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,subCode:subCode,courseId:courseId,batch:batch,sem:sem,unit:unit,question:question,type:type,category:category
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                if (response>0) {
                 $('#question').show();
                 $('#error_question').hide();
                  
                }
                else
                {
                 $('#question').hide();
                 $('#error_question').show();
                 
     
                 document.getElementById("question").value="";
                }
              }
           });
        }
        else
        {
         //  alert("Enter all details.");
     
        }
     }
   function total_count()
     {
        var subCode=sanitize(document.getElementById("subject_code").value);
        var courseId=sanitize(document.getElementById("Course").value);
        var subName=sanitize(document.getElementById("subName").value);
        var batch=sanitize(document.getElementById("Batch").value);
        var sem=sanitize(document.getElementById("Semester").value);
        var unit=sanitize(document.getElementById("unit").value);
        var question=sanitize(document.getElementById("question").value);
        var type=sanitize(document.getElementById("type").value);
        var category=sanitize(document.getElementById("category").value);
                        if (subCode!='' && courseId!='' && subName!='' && batch!='' && sem!='' && unit!='' && type!='' && category!='') 
        {
          //alert(subCode+' '+courseId+' '+subName+' '+batch+' '+sem+' '+unit+' '+type+' '+category);
           var code=121;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,subCode:subCode,courseId:courseId,batch:batch,sem:sem,unit:unit,question:question,type:type,category:category
              },
              success: function(response) 
              {
                document.getElementById("total_count").innerHTML=response;
                
              }
           });
        }
        else
        {
         //  alert("Enter all details.");
     
        }
     }
   function update_question(id,type_id)
   {
    
          var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
           var code=131;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,type_id:type_id
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("question_edit").innerHTML=response;
                 document.getElementById("question_id").value=id;
                 document.getElementById("type_id").value=type_id;
                 // edit();
              }
           });
        }
   
   // var edit = function() {
   //    function edit(){
   //  $('.click2edit').summernote({focus: true,toolbar: [
   //    // [groupName, [list of button]]
   //    ['style', ['bold', 'italic', 'underline', 'clear']],
   //    ['fontsize', ['fontsize']],
   //    ['color', ['color']],
   //    ['para', ['ul', 'ol', 'paragraph']],
   //    ['height', ['height']]
   //  ]});
   // }
   // };
   
function save() {
    var id = document.getElementById('question_id').value;
    var type_id = document.getElementById('type_id').value;
    if (type_id==1) {

    var Question = document.getElementById('Question').value;
    var QuestionA = document.getElementById('QuestionA').value;
    var QuestionB = document.getElementById('QuestionB').value;
    var QuestionC = document.getElementById('QuestionC').value;
    var QuestionD = document.getElementById('QuestionD').value;

    }
    else
    {
      var Question = document.getElementById('Question').value;
    var QuestionA = "";
    var QuestionB = "";
    var QuestionC = "";
    var QuestionD = "";
    }

    var code = 132;
    var requestData = {
        code: code,
        id: id,
        Question: Question,
        QuestionA: QuestionA,
        QuestionB: QuestionB,
        QuestionC: QuestionC,
        QuestionD: QuestionD,
        type_id: type_id
    };

    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: requestData,
        dataType: 'text', 
        success: function(response) {
            // console.log(response);
         subject_code_search_update();
            SuccessToast('Successfully Updated');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // console.error(textStatus, errorThrown);
           
        }
    });
}
   
   $('#modal-lg').on('hidden.bs.modal', function () {
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
</br>
<p id="ajax-loader"></p>
<div>
<?php include "footer.php";  ?>