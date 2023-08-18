<?php 
   include "header.php"; 
    // $code_access;  
   ?>
<script>
   $(document).ready(function(){
   
       $(document).on('keydown','.subject_code', function() {
   
           // Initialize jQuery UI autocomplete
           $("#subject_code").autocomplete({
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
                     // console.log(data);
                 },
                 error: function (error) {
                 // console.log(error);
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
   <div class="row">
      <!-- left column -->
      <div class="col-lg-12 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header">
               <div class="row">
                  <div class="col-lg-4">
               <h3 class="card-title">Upload Questions</h3>
            </div>
              <div class="col-lg-2">

                 <button class="btn btn-primary"  data-toggle="modal" data-target="#modal-lg"  style="text-align:right;">Copy</button>

              </div>
             <b id="total_count"></b>
            </div>

</div>

             <form id="image-upload" name="image-upload"  class="form-horizontal" action="action.php" method="POST" target="_blank" enctype="multipart/form-data">
            <div class="card-body" >
               <div class="row">
                  <input type="hidden" name="code" value="316">
                  <!-- left column -->
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Subject Code<b style="color:red;">*</b></label>
                     <Input type="text"  class="form-control subject_code"  name="subject_code" id="subject_code"  required="" />
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Course<b style="color:red;">*</b></label>
                     <select name="Course" id="Course" class="form-control" onchange="selectSubName(this.value); q_check_count(); total_count();">
                        <option value=''>Select Course</option>
                     </select>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Subject Name<b style="color:red;">*</b></label>
                     <select name="subName" id="subName" class="form-control" onchange="q_check_count(); total_count()">
                        <option value=''>Select Subject</option>
                     </select>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Batch<b style="color:red;">*</b></label>
                     <select name="batch"  class="form-control" id="Batch" required="" onchange="q_check_count(); total_count()">
                        <option value="">Batch</option>
                        <?php 
                           for($i=date('Y', strtotime('-6 year'));$i<=date('Y', strtotime('+0 year'));$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label> Semester<b style="color:red;">*</b></label>
                     <select   id='Semester'name='semester' class="form-control" required="" onchange="q_check_count(); total_count()">
                        <option value="">Sem</option>
                        <?php 
                           for($i=1;$i<=12;$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Unit<b style="color:red;">*</b></label>
                     <select  id='unit'name='unit' class="form-control" required="" onchange="q_check_count(); total_count()">
                        <option value="">Select</option>
                        <?php 
                           for($i=1;$i<=4;$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <!-- /.row -->
               </div>
               <hr>
               <div class="row">
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Type<b style="color:red;">*</b></label>
                     <select id='type'name='type' class="form-control" required="" onchange=" drop_category(); q_check_count(); total_count()">
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
                     <label>Category<b style="color:red;">*</b></label>
                     <select id='category'name='category' class="form-control" required="" onchange="q_check_count(); total_count()">

                     </select>
                  </div>
               </div>
                <hr>
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <b style="color:red; font-family:Serif;">Note: Upload  without Apostrophe ( ' ) symbol</b>
                    
                          <div id="question_divs"></div>

                         
                  </div>
               </div>
               
            </div>
            <?php   $code_access; if ($code_access=='010' || $code_access=='011' || $code_access=='110' || $code_access=='111') 
                                         {
            ?>
            <div class="card-footer" style="text-align: right;">
    <input type="button" value="Submit" class="btn btn-success" id="submitBtn" onclick="submitForm(this.form);" disabled>
</div>

            <?php }  ?>
            <!-- /.card-footer -->
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Copy Question Paper</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

               <div class="row">
                  <div class="col-lg-6" >
                     <label style="text-align:center; color: red;">Copy from </label>
                     <br>

                     <label>College Name</label>

                 <select  name="College" id='Collegecopy' onchange="fetchcourse(this.value);" class="form-control" required>
                 <option value=''>Select Faculty</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID  where IDNo='$EmployeeID'";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 


                 <label>Course</label>
                  <select  id="Coursecopy" name="Course" class="form-control" required >
                     <option value=''>Select Course</option>
                 </select>
         


             

              
                 <label>Batch</label>
                   <select id="Batchcopy" name="batch"  class="form-control" required>
                       <option value="">Batch</option>
                          <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
               
                  

   <label>Unit</label>

                   <select id="unitcopy" name="unit"   class="form-control" required>
                       <option value="">Unit</option>
                          <?php 
                              for($i=1;$i<=4;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
                     <label>Semester</label>

                   <select id="Semestercopy" name="semester"  onchange="fetchcodes()" class="form-control" required>
                       <option value="">Semester</option>
                          <?php 
                              for($i=1;$i<=12;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
 <label>Subject Codes Uploaded by you </label>
                 


                    <select id="Subjectcodecopy" name="semester"  class="form-control" required>
                       

                       <option value="">Subject Code</option>
                          
                 </select>
            
              </div>






                     <div class="col-lg-6">
                        <label style="text-align:center; color: red;">Copy To </label><br>

                        <label>College Name</label>
                 <select  name="College" id='Collegecopy1' onchange="fetchcourse1(this.value);" class="form-control" required>
                 <option value=''>Select Faculty</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where IDNo='$EmployeeID'";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 


                 <label>Course</label>
                  <select  id="Coursecopy1" name="Coursecopy1" class="form-control" required >
                     <option value=''>Select Course</option>
                 </select>
              

             

            
                 <label>Batch</label>
                   <select id="Batchcopy1" name="batch"  class="form-control" required>
                       <option value="">Batch</option>
                          <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>


                <label>Semester</label>

                   <select id="Semestercopy1" name="semester" onchange="fetchcodesnew()"  class="form-control" required>
                       <option value="">Semester</option>
                          <?php 
                              for($i=1;$i<=12;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
<label>Subject Codes </label>

                      <select id="Subjectcodecopy1" name="semester" onchange="checkvalidation(this.value)"  class="form-control" required>
                       

                       <option value="">Subject Code</option>
                          
                 </select>


                 
                     
            
              </div>


               </div>



              <p></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

              <button type="button" class="btn btn-primary"  id='save' onclick="copyquestions()"  style="display:none">Save Changes</button>
              <button type="button" class="btn btn-danger" id='alert'  style="display:none">Already Uploaded</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<script type="text/javascript">


  function submitForm(form) {
    var question_count = document.getElementsByName('question_count_val')[0].value;
    if (!validateForm(form,question_count))
     {
      return; 
    }
    var formData = new FormData(form);
    $.ajax({
      url: form.action,
      type: form.method,
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
         console.log(response);
         if (response>0) {
        SuccessToast('Successfully Uploaded');
           // Empty the textareas after success
           $('.summer').summernote('destroy');
        document.getElementById("question_divs").innerHTML=" ";  
      for (var i = 1; i < question_count; i++) {
        var questionName = 'Question' + i;
        var fieldElement = form.elements[questionName];
        if (fieldElement && fieldElement.nodeName === 'TEXTAREA') {
          fieldElement.value = ''; 
        }
      }
      var typeElement = form.elements['type'];
      if (typeElement) {
        typeElement.value = ''; 
      }

      var categoryElement = form.elements['category'];
      if (categoryElement) {
        categoryElement.value = '';
      }
   }
   else
   {
        ErrorToast('Try after some time!','bg-danger');

   }
      },
      error: function(xhr, status, error) {
        // console.log(error);
      }
    });
 }

  function validateForm(form,questionCount) {
    for (var j = 1; j <=questionCount; j++) {
        var questionName = 'Question' + j;
        var fieldElement = form.elements[questionName];
        if (!fieldElement) { 
            console.error(questionName + ' element does not exist in the form.');
            return false;
        }
        if (fieldElement.nodeName === 'TEXTAREA') {
            var fieldValue = fieldElement.value.trim();
            if (fieldValue === '') {
                ErrorToast(questionName + ' is required.', 'bg-warning');
                return false;
            }
        }
    }
    return true;
}
   function sanitize(string) {
   const map = {
      
      // '"': '``',
      // "'": '`' 
   };
   const reg = /[&<>"'/]/ig;
   return string.replace(reg, (match)=>(map[match]));
   }

   $(function() { 
   $("#subject_code").blur(function(e) {
     e.preventDefault();
   
     var subject_code = $("#subject_code").val();
     var code = "117";
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

   });
   });
 
   function selectSubName(course)
   {
      var subCode=document.getElementById("subject_code").value;
      // alert(subCode);
      var code=118;
      $.ajax({
         url:'action.php',
         type:'POST',
         data:{
            code:code,subCode:subCode,course:course
         },
         success: function(response) 
         {
            //console.log(response);
            document.getElementById("subName").innerHTML=response;
         }
      });
   }
   
  // JavaScript function with the modified logic
function q_check_count() {
   var subCode = sanitize(document.getElementById("subject_code").value);
   var courseId = sanitize(document.getElementById("Course").value);
   var subName = sanitize(document.getElementById("subName").value);
   var batch = sanitize(document.getElementById("Batch").value);
   var sem = sanitize(document.getElementById("Semester").value);
   var unit = sanitize(document.getElementById("unit").value);
   var type = sanitize(document.getElementById("type").value);
   var category = sanitize(document.getElementById("category").value);

   if (subCode !== '' && courseId !== '' && subName !== '' && batch !== '' && sem !== '' && unit !== '' && type !== '' && category !== '') {
      var errorQuestionElement = document.getElementById('error_question');
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 120;
      
      $.ajax({
         url: 'action.php',
         type: 'POST',
         data: {
            code: code,
            subCode: subCode,
            courseId: courseId,
            batch: batch,
            sem: sem,
            unit: unit,
            type: type,
            category: category
         },
         success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
          if (response<1) {
             document.getElementById("submitBtn").disabled = true;
      document.getElementById("question_divs").innerHTML = ' <p style="color:red;" ><b>You Can`t Insert this Question. You have already uploaded for this selection</b></p>';
   } 
   else
    {
       document.getElementById("submitBtn").disabled = false;
      document.getElementById("question_divs").innerHTML = response;
      $('.summer').summernote({focus: false,toolbar: [
    ]});
   }
         }
      });
   } else {
     
      
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
      var type=sanitize(document.getElementById("type").value);
      var category=sanitize(document.getElementById("category").value);
                      if (subCode!='' && courseId!='' && subName!='' && batch!='' && sem!='' && unit!='' && type!='' && category!='') 
      {
         var code=121;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,subCode:subCode,courseId:courseId,batch:batch,sem:sem,unit:unit,type:type,category:category
            },
            success: function(response) 
            {
              document.getElementById("total_count").innerHTML=response;
              
            }
         });
      }
      else
      {
       // alert("Enter all details.");
   
      }
   }
function drop_category()
{
   var unit=sanitize(document.getElementById("unit").value);
      var type=sanitize(document.getElementById("type").value);
         var code=122;
        // alert(unit,type);
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,unit:unit,type:type
            },
            success: function(response) 
            {
              if(response != "")
             {
                 $("#category").html("");
                 $("#category").html(response);
                 //console.log(response);
             }
              
            }
         });
}

    function fetchcourse()
{   
   
  

 var College=document.getElementById('Collegecopy').value;
   
  
var code='317';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
   
if(data != "")
{
    
$("#Coursecopy").html("");
$("#Coursecopy").html(data);
}
}
});

}

 function fetchcourse1(data)
{
var code='317';
$.ajax({
url:'action.php',
data:{College:data,code:code},
type:'POST',
success:function(data){

  


if(data != "")
{
    
$("#Coursecopy1").html("");
$("#Coursecopy1").html(data);
}
}
});

}

 function fetchcodes()
{

 var College=document.getElementById('Collegecopy').value;

 var Course=document.getElementById('Coursecopy').value;

 var Batch=document.getElementById('Batchcopy').value;

 var Semester=document.getElementById('Semestercopy').value;
  var Unit=document.getElementById('unitcopy').value;




var code='318';
$.ajax({
url:'action.php',
data:{College:College,Course:Course,Batch:Batch,Semester:Semester,code:code,Unit:Unit},
type:'POST',
success:function(data){
if(data != "")
{
   // console.log(data);
$("#Subjectcodecopy").html("");
$("#Subjectcodecopy").html(data);
}
}
});

}

 function fetchcodesnew()
{

 var College=document.getElementById('Collegecopy1').value;

 var Course=document.getElementById('Coursecopy1').value;

 var Batch=document.getElementById('Batchcopy1').value;

 var Semester=document.getElementById('Semestercopy1').value;

var code='319';
$.ajax({
url:'action.php',
data:{College:College,Course:Course,Batch:Batch,Semester:Semester,code:code},
type:'POST',
success:function(data){
if(data != "")
{
  
$("#Subjectcodecopy1").html("");
$("#Subjectcodecopy1").html(data);
}
}
});

}


 function checkvalidation(subject_code)
{

 var College=document.getElementById('Collegecopy1').value;

 var Course=document.getElementById('Coursecopy1').value;

 var Batch=document.getElementById('Batchcopy1').value;
    var Unit=document.getElementById('unitcopy').value;

 var Semester=document.getElementById('Semestercopy1').value;

 if(College!=''&& Course!='' && Batch!=''&& Unit!='' && Semester!='')
 {


var code='320';
$.ajax({
url:'action.php',
data:{College:College,Course:Course,Batch:Batch,Semester:Semester,code:code,SubjectCode:subject_code,Unit:Unit},
type:'POST',
success:function(data){
if(data != "")
{
  if(data=='1')
  {
   document.getElementById('alert').style.display='block';
    document.getElementById('save').style.display='none';
  }
  else
  {
     document.getElementById('save').style.display= 'block';
      document.getElementById('alert').style.display='none';
  }

    //console.log(data);

}
}
});
}
else
{

 ErrorToast('Please select Required Fields!','bg-danger');

}

}

function copyquestions()
{
 document.getElementById('save').style.display='none';
   var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
 var College=document.getElementById('Collegecopy').value;
 var Course=document.getElementById('Coursecopy').value;
 var Batch=document.getElementById('Batchcopy').value;
 var Unit=document.getElementById('unitcopy').value;
 var Semester=document.getElementById('Semestercopy').value;
 var SubjectCode=document.getElementById('Subjectcodecopy').value;


 var College1=document.getElementById('Collegecopy1').value;
 var Course1=document.getElementById('Coursecopy1').value;
 var Batch1=document.getElementById('Batchcopy1').value;
 var Semester1=document.getElementById('Semestercopy1').value;
 var SubjectCode1=document.getElementById('Subjectcodecopy').value;







 if(College!=''&& Course!='' && Batch!=''&& Unit!='' && Semester!='' &&SubjectCode!=''&& College1!=''&& Course1!='' && Batch1!='' && Semester1!='' &&SubjectCode1!='')
 {

var code='321';
$.ajax({
url:'action.php',
data:{College:College,Course:Course,Batch:Batch,Semester:Semester,SubjectCode:SubjectCode,Unit:Unit,College1:College1,Course1:Course1,Batch1:Batch1,Semester1:Semester1,SubjectCode1:SubjectCode1,code:code},
type:'POST',
success:function(data){
   spinner.style.display = 'none';
//console.log(data);
if(data != "")
{
  if(data>0)
  {
    SuccessToast('Successfully Uploaded');
  }
  else
  {
     ErrorToast('Unable to copy !','bg-danger'); 
  }

   

}
}
});




}
else
{
    ErrorToast('Please select Required Fields!','bg-danger');
}
}

</script>
</br>
<p id="ajax-loader"></p>
<div>
<?php include "footer.php";  ?>

