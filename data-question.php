<?php 
   ini_set('max_execution_time', '0');
   include "header.php";  
   include "connection/connection.php"; 
   ?>
   <p id="ajax-loader"></p>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-2">
            <select class="form-control" name="examSession" id="examSession">
               <optgroup label="Examination Session">
                  <?php
                     $sessionSql="SELECT * FROM question_session ORDER BY id asc";
                     $sessionRes=mysqli_query($conn,$sessionSql);
                     while ($sessionData=mysqli_fetch_array($sessionRes) )
                     {
                        if ($sessionData['session_status']==1) 
                        {
                        ?>
                  <option selected value="<?=$sessionData['id']?>"><?=$sessionData['session_name']?></option>
                  <?php   // code...
                     }
                     else
                     {
                        ?>
                  <option value="<?=$sessionData['id']?>"><?=$sessionData['session_name']?></option>
                  <?php
                     }
                     
                     }
                     ?>
               </optgroup>
            </select>
         </div>
         <div class="col-lg-2" >
            <select class="form-control" name="searchingValue" id="searchingValue" onchange="textBoxVisible(this.value)">
               <option value="" selected>Select</option>
               <option value="SubjectCode">Subject Code</option>
               <option value="EmployeeId">Employee Id</option>
               <option value="PaperId">Paper Id</option>
            </select>
         </div>
         <div class="col-lg-2" >
            <input type="text" class="form-control" required="" id="textBox" style="display: none;" placeholder="Code/Emp ID">
         </div>
         <div class="col-lg-2">
            <button type="button" class="btn btn-info" id="searchBtn" style="display: none;"  onclick="searchTextBox()">Search</button>
         </div>
      </div>
      <br>
      <div class="row">
         <!-- left column -->
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Students</h3>
               </div>
               <!--  <form class="form-horizontal" action="" method="POST"> -->
               <div class="card-body" id="question_show" >
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
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

function deleteAllQuestion(SubjectCode,CourseID,Batch,Semester,EmpID)
   {
      document.getElementById("show_upload_q").innerHTML='';
      var a=confirm("Are you sure to delete?");
      if (a==true) 
      {

      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=195;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,subCode:SubjectCode,courseId:CourseID,batch:Batch,sem:Semester,EmpID:EmpID
              },
              success: function(response) 
              {
               console.log(response);
               spinner.style.display='none';
                searchTextBox();
                
              }
           });
      }
   
   
   }
// function cancel_text_box(id)
// {  
//    var batch = $('#Batch1'+id).val();
//     $('#Batch1'+id).parent().text(batch);
//    $('#Batch1'+id).remove(); 

//    var sem = $('#Sem1'+id).val();
//     $('#Sem1'+id).parent().text(sem);
//    $('#Sem1'+id).remove();
    
//    var emp = $('#Emp1'+id).val();
//     $('#Emp1'+id).parent().text(emp);
//    $('#Emp1'+id).remove();

//     $('#editIcon'+id).show();
//     $('#saveIcon'+id).hide();
//   $('#cancelIcon'+id).hide();
// }

// function editAllQuestion(id,SubjectCode)
// {
//    var batch = $('#batch'+id).text();
//    var emp = $('#emp'+id).text();
//    var sem = $('#sem'+id).text();
//  var inputEmp = $('<input id="Emp1'+id+'" class="form-control" type="text" value="' + emp + '" />')
//    var inputBatch = $('<select id="Batch1'+id+'" class="form-control" type="text" value="' + batch + '"></select>')
//    var inputSem = $('<select id="Sem1'+id+'" class="form-control" type="text" value="' + sem + '"></select>')
//    $('#emp'+id).text('').append(inputEmp);
//    $('#saveIcon'+id).show();
//    $('#cancelIcon'+id).show();
//    $('#editIcon'+id).hide();
//    $('#batch'+id).text('').append(inputBatch);
//    var code=151;
//          $.ajax({
//             url:'action.php',
//             type:'POST',
//             data:{
//               code:code,subject_code:SubjectCode
//             },
//             success: function(response) 
//             {
//                // $('#modal-lg-view-question').modal('hide');
//                // searchTextBox();
//                document.getElementById('Batch1'+id).innerHTML=response;  
//               }
//            });

//          $('#sem'+id).text('').append(inputSem);
//    var code=152;
//          $.ajax({
//             url:'action.php',
//             type:'POST',
//             data:{
//               code:code,subject_code:SubjectCode
//             },
//             success: function(response) 
//             {
//                // $('#modal-lg-view-question').modal('hide');
//                // searchTextBox();
//                document.getElementById('Sem1'+id).innerHTML=response;  
//               }
//            });



// }
function editAllQuestion(id,SubjectCode)
{
  var myWindow = window.open("http://gurukashiuniversity.co.in/lms/", "", "width=1300px,height=1000px");
}

function lockQuestions(SubjectCode,CourseID,Batch,Semester,EmpID) 
   {
     //alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
      var a=confirm('Are you sure to lock?');
   //alert(id);
      if (a==true) 
      {
         var code=197;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
              code:code,subCode:SubjectCode,courseId:CourseID,batch:Batch,sem:Semester,EmpID:EmpID
            },
            success: function(response) 
            {
               // $('#modal-lg-view-question').modal('hide');
               searchTextBox();  
              }
           });
      }
   }

   function unlockQuestions(SubjectCode,CourseID,Batch,Semester,EmpID) 
   {
     //alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
      var a=confirm('Are you sure to Unlock?');
   //alert(id);
      if (a==true) 
      {
         var code=196;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
              code:code,subCode:SubjectCode,courseId:CourseID,batch:Batch,sem:Semester,EmpID:EmpID
            },
            success: function(response) 
            {
               // $('#modal-lg-view-question').modal('hide');
               searchTextBox();  
              }
           });
      }
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
               $('#modal-lg-view-question').modal('toggle');
               spinner.style.display='none';
                document.getElementById("show_upload_q").innerHTML=response;
                
              }
           });
   
   
   }
   function textBoxVisible(valueGiven) 
   {
      // alert(valueGiven);
      if (valueGiven=='') 
      {
         document.getElementById('textBox').style.display='none';
         document.getElementById('searchBtn').style.display='none';
      }
      else
      {
         if (valueGiven=='SubjectCode') 
         {
            $("#textBox").attr("placeholder", "Enter Subject Code");
         }
         if (valueGiven=='EmployeeId') 
         {
            $("#textBox").attr("placeholder", "Enter Employee ID");
         }
         if (valueGiven=='PaperId') 
         {
            $("#textBox").attr("placeholder", "Enter Paper ID");
         }
         
         document.getElementById('textBox').style.display='block';
         document.getElementById('searchBtn').style.display='block';
      }
   }

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


   }   function searchTextBox()
   {
   var spinner=document.getElementById("ajax-loader");
   var textBoxValue=document.getElementById('textBox').value;
   var searchingValue=document.getElementById('searchingValue').value;
   var examSession=document.getElementById('examSession').value;
     spinner.style.display='block';
           var code=194;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,textBoxValue:textBoxValue,searchingValue:searchingValue,examSession:examSession
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
                 searchTextBox();
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
   });


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
               $('#modal-lg-view-question').modal('toggle');
               spinner.style.display='none';
                document.getElementById("show_upload_q").innerHTML=response;
                
              }
           });
   
   
   }
   
</script>



<?php include "footer.php";

?>