<?php 
  include "header.php";   
?>   
<section class="content">
   <div class="container-fluid">
   <div class="card card-info">
   </div>
   <div class="row">
      <div class="col-lg-12 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header">
               <div class="row">
                  <div class="col-lg-1">
                     <h3 class="card-title " style="font-size: 14px;">Study Scheme</h3>
                  </div>
                  <div class="col-lg-10">
                     <div class="card-tools">
                        <div class="row">
                           <div class="col-lg-1">
                              <div class="input-group-sm">
                               <button class="btn btn-outline-light btn-xs form-control text-xs" onclick="format()">Format</button>
                              </div>
                           </div>
                           <div class="col-lg-2">
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
                                 <select class="form-control" name="semester" id='semester_id'   >
                                    <option value="">Select Semester</option>
                                    
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
      function format() 
      {
         window.location.href = 'http://gurukashiuniversity.co.in/gkuadmin/formats/studyscheme.csv';
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
   </script>
  </br>

<p id="ajax-loader"></p>
<div>



    <?php include "footer.php";  ?>