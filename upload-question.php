<?php 
   include "header.php"; 
    $code_access;  
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
               <h3 class="card-title">Upload Questions</h3>
              
             <b id="total_count"></b>
            </div>
            <!--  <form class="form-horizontal" action="" method="POST"> -->
            <div class="card-body" id="" >
               <div class="row">
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
                     <select   id='Semester' class="form-control" required="" onchange="q_check_count(); total_count()">
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
                     <select  id='unit' class="form-control" required="" onchange="q_check_count(); total_count()">
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
                     <select id='type' class="form-control" required="" onchange=" drop_category(); q_check_count(); total_count()">
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
                     <select id='category' class="form-control" required="" onchange="q_check_count(); total_count()">

                     </select>
                  </div>
               </div>
                <hr>
               <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                     <label>Questions<b style="color:red;">*</b> (<b style="color:red; font-family:Serif;">Note: Upload one question at a time without serial  number and without Apostrophe ( ' ) symbol)</b></label>
                       <textarea class="textarea_quetions"  required  id="question" placeholder="Type Questions Here.........."
                          style=" visibility: hidden; min-width:0px;max-height: 0px;"></textarea>
                          <p id="error_question" style="display:none; color: red;"><b>You Can`t Insert this Question. You have already uploaded for this selection</b></p>
                  </div>
               </div>
               
            </div>
            <?php  if ($code_access=='010' || $code_access=='011' || $code_access=='110' || $code_access=='111') 
                                          {
            ?>
            <div class="card-footer" style="text-align: right;">
               <input type="button" name="" value="Submit" class="btn btn-success" onclick="submitQuestion();">
            </div>
            <?php }  ?>
            <!-- /.card-footer -->
            <!-- </form> -->
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>

<script type="text/javascript">


   function sanitize(string) {
   const map = {
      
      // '"': '``',
      // "'": '`' 
   };
   const reg = /[&<>"'/]/ig;
   return string.replace(reg, (match)=>(map[match]));
   }
   function submitQuestion()
   {
      var subCode=sanitize(document.getElementById("subject_code").value);
      var courseId=sanitize(document.getElementById("Course").value);
      var subName=sanitize(document.getElementById("subName").value);
      var batch=sanitize(document.getElementById("Batch").value);
      var sem=sanitize(document.getElementById("Semester").value);
      var unit=sanitize(document.getElementById("unit").value);
      var question=document.getElementById("question").value.replace("'", '`');
      var type=sanitize(document.getElementById("type").value);
      var category=sanitize(document.getElementById("category").value);
      if (subCode!='' && courseId!='' && subName!='' && batch!='' && sem!='' && unit!='' && question!='<p><br></p>' && type!='' && category!='') 
      {
        // alert(subCode+' '+courseId+' '+subName+' '+batch+' '+sem+' '+unit+' '+question+' '+type+' '+category);
        var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
         var code=119;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,subCode:subCode,courseId:courseId,batch:batch,sem:sem,unit:unit,question:question,type:type,category:category
            },
            success: function(response) 
            {
               
                spinner.style.display='none';
              if (response==0)
                   {
                     ErrorToast('You Can`t Insert this Question. You have already uploaded for this selection','bg-danger' );
                     document.getElementById("type").value="";
                     document.getElementById("category").value="";
                     // $('#question').summernote('code', '');
                     // $('#question').summernote('reset');
                     //    $('#question').summernote('destroy');
                     console.log(response);
                  }
                  else
                  {
               
                   SuccessToast('Successfully Inserted');
                   //document.getElementById("question").value="";
                   $('#question').summernote({focus: false});
                   $('#question').summernote('reset');
                   console.log(response);

                  }
            }
         });
      }
      else
      {
         // alert("Enter all details.");
         ErrorToast('Please enter all required details!','bg-warning' );
      }
   
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
                $('#question').summernote({focus: true,toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ]});
              }
              else
              {
               $('#question').hide();
               $('#error_question').show();
                $('#question').summernote('destroy');
               
   
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
              //console.log(response);
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


</script>
</br>
<p id="ajax-loader"></p>
<div>
<?php include "footer.php";  ?>

