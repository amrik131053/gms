
<?php 

  include "header.php";   
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
                  console.log(data);
              },
              error: function (error) {
              console.log(error);
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
      <div class="col-lg-12 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header">
               <div class="row">
                  <div class="col-lg-2">
                     <h3 class="card-title">Question Status</h3>
                  </div>
                  <div class="col-lg-10">
                     <div class="card-tools">
                        <div class="row">
                           <div class="col-lg-3">
                              <div class="input-group-sm">
                                 <select class="form-control" name="college_id" id='college_id' onchange="courseId(this.value);"  >
                                    <option value="">Select College</option>
                                    <?php
                                    $sqlCourse = " SELECT Distinct UserAccessLevel.CollegeID,CollegeName from UserAccessLevel inner join MasterCourseStructure on MasterCourseStructure.CollegeID=UserAccessLevel.CollegeID where IDNo='$EmployeeID' order By CollegeName asc";
                                    $resultCourse = sqlsrv_query($conntest,$sqlCourse);
                                    while($rowCourse = sqlsrv_fetch_array($resultCourse, SQLSRV_FETCH_ASSOC) )
                                    {
                                       ?>
                                       <option value="<?=$rowCourse["CollegeID"]?>"><?=$rowCourse["CollegeName"]?></option>
                                       <?php
                                    } 
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="input-group-sm">
                                 <select class="form-control" name="course_id" id='course_id' onchange="semesterId(this.value)"  >
                                    <option value="">Select Course</option>
                                    <?php
                                    $sqlCourse = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE CollegeID='64'  ORDER BY Course ";
                                    $resultCourse = sqlsrv_query($conntest,$sqlCourse);
                                    while($rowCourse = sqlsrv_fetch_array($resultCourse, SQLSRV_FETCH_ASSOC) )
                                    {
                                       ?>
                                       <option value="<?=$rowCourse["CourseID"]?>"><?=$rowCourse["Course"]?></option>
                                       <?php
                                    } 
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="input-group-sm">
                                 <select name="batch"  class="form-control" id="Batch" required="">
                                    <option value="">Batch</option>
                                    <?php 
                                       for($i=date('Y', strtotime('-6 year'));$i<=date('Y', strtotime('+0 year'));$i++)
                                       {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                       ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="input-group-sm">
                                 <select class="form-control" name="semester" id='semester_id'   >
                                    <option value="">Select Semester</option>
                                    
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="input-group-sm">
                                 <button class="btn btn-outline-warning btn-xs form-control" onclick="viewSubjects()">View</button>
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="input-group-sm">
                                 <button class="btn btn-outline-warning btn-xs form-control">Export</button>
                              </div>
                           </div>
                           
                           
                        </div>
                     
                     </div>
                  </div>
               </div>
            </div>
            <!--  <form class="form-horizontal" action="" method="POST"> -->
            <div class="card-body" id="question_data" >
                  
            </div>
            <div class="card-footer" style="text-align: right;">
            </div>
            <!-- /.card-footer -->
            <!-- </form> -->
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->

</section>
   <script type="text/javascript">
    function search(collegeId)
      {
         var code=130;
         var spinner=document.getElementById("ajax-loader");
      spinner.style.display='block';
         // var course=document.getElementById("course_id").value;
         var batch=document.getElementById("Batch").value;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,collegeId:collegeId,batch:batch
            },
            success: function(response) 
            {
      spinner.style.display='none';
               console.log(response);
               document.getElementById("question_data").innerHTML=response;
            }
         });
      }

       function courseId(collegeId)
      {
         var code=125;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,collegeId:collegeId
            },
            success: function(response) 
            {
               console.log(response);
               document.getElementById("course_id").innerHTML=response;
            }
         });
      }
       function semesterId(course)
      {
         var code=123;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,course:course
            },
            success: function(response) 
            {
               console.log(response);
               document.getElementById("semester_id").innerHTML=response;
            }
         });
      }

      function viewSubjects()
      {
         var code=124;

         var semesterId=document.getElementById("semester_id").value;
         if (semesterId=='') 
         {
            semesterId=0;
         }
         var course=document.getElementById("course_id").value;
         var batch=document.getElementById("Batch").value;
         var spinner=document.getElementById("ajax-loader");
      spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,course:course,semesterId:semesterId,batch:batch
            },
            success: function(response) 
            {
      spinner.style.display='none';

               // console.log(response);
               document.getElementById("question_data").innerHTML=response;
            }
         });
      }
      function sanitize(string) {
     const map = {
         
         '"': '``',
         "'": '`' 
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
         var question=sanitize(document.getElementById("question").value);
         var type=sanitize(document.getElementById("type").value);
         var category=sanitize(document.getElementById("category").value);
         if (subCode!='' && courseId!='' && subName!='' && batch!='' && sem!='' && unit!='' && question!='' && type!='' && category!='') 
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
                  
                   window.setTimeout(function(){
                     location.reload(true);
    }, 3000);
                  document.getElementById('error').innerHTML='<div  class="alert alert-success alert-xs" id="alert">Successfully Assigned</div>';
                  // console.log(response);
               }
            });
         }
         else
         {
            alert("Enter all details.");
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
                    console.log(data);
                }

            }
          });
    });
  });
      // function selectCourse(subCode)
      // {
      //    // alert(subCode);
      //    var code=117;
      //    $.ajax({
      //       url:'action.php',
      //       type:'POST',
      //       data:{
      //          code:code,subCode:subCode
      //       },
      //       success: function(response) 
      //       {
      //          document.getElementById("Course").innerHTML=response;
      //       }
      //    });
      // }
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
               console.log(response);
               document.getElementById("subName").innerHTML=response;
            }
         });
      }
   </script>
  </br>

<p id="ajax-loader"></p>
<div>



    <?php include "footer.php";  ?>