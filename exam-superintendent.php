<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-4 col-md-4 col-sm-3">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Cut List</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-13">
                                <label>College</label>
                                <select name="College" id='College' onchange="courseByCollege(this.value)"
                                    class="form-control" required="">
                                    <option value=''>Select Course</option>
                                    <?php
                                    $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                                            $stmt2 = sqlsrv_query($conntest,$sql);
                                        while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                            {
                                        $college = $row1['CollegeName']; 
                                        $CollegeID = $row1['CollegeID'];
                                        ?>
                                                                        <option value="<?=$CollegeID;?>"><?= $college;?></option>
                                                                        <?php    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-13">


                                <label>Course</label>
                                <select name="Course" id="Course" class="form-control">
                                    <option value=''>Select Course</option>

                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-3">





                                <label>Batch</label>
                                <select name="batch" class="form-control" id="Batch" required="">
                                    <option value="">Batch</option>
                                    <?php 
                                    for($i=2013;$i<=2030;$i++)
                                    {?>
                                                                        <option value="<?=$i?>"><?=$i?></option>
                                                                        <?php }
                                                ?>

                                </select>

                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-3">
                                <label> Semester</label>
                                <select id='Semester' class="form-control" required="">
                                    <option value="">Sem</option>
                                    <?php 
                                    for($i=0;$i<=12;$i++)
                                    {?>
                                                                        <option value="<?=$i?>"><?=$i?></option>
                                                                        <?php }
                                                ?>

                                </select>

                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-3">
                                <label>Type</label>
                                <select id="Type" class="form-control" required="">
                                    <option value="">Select</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Reappear">Reappear</option>
                                    <option value="Additional">Additional</option>
                                    <option value="Improvement">Improvement</option>


                                </select>

                            </div>



                            <div class="col-lg-6    col-md-4 col-sm-3">
                                <label>Group</label>
                                <select id="Group" class="form-control" required="">
                                    <option value="">Group</option>
                                    <?php
                                            $sql="SELECT DISTINCT Sgroup from MasterCourseStructure Order by Sgroup ASC ";
                                                    $stmt2 = sqlsrv_query($conntest,$sql);
                                                while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                                    {

                                                
                                                $Sgroup = $row1['Sgroup']; 
                                                
                                                ?>
                                    <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                    <?php    }

                                                            ?>


                                </select>

                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-3">
                                <label>Examination</label>
                                <select id="Examination" class="form-control" required="">
                                    <option value="">Examination</option>
                                    <?php
                                    $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
                                            $stmt2 = sqlsrv_query($conntest,$sql);
                                        while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                            {

                                        
                                        $Sgroup = $row1['Examination']; 
                                        
                                        ?>
                                                                        <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                                                        <?php    }

                                    ?>


                                </select>

                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-13">
                                <div class="form-group-xs  ">
                                    <br>
                                    <div class="row ">

                                        <div class="col-lg-5 col-md-12 col-sm-13">
                                            <!-- <button class="btn btn-danger btn-xs " onclick="exportAttendancePdf()"><i
                                                    class="fa fa-file-pdf">&nbsp;Attendance Sheet</i></button><br><br> -->
                                            <button class="btn btn-danger btn-xs " onclick="exportAttendancePdfWithoutIMage()"><i
                                                    class="fa fa-file-pdf">&nbsp;Attendance Sheet</i></button><br><br>
                                            <!-- <button class="btn btn-danger btn-xs " onclick="exportAttendancePdfWithoutIMage()"><i
                                                    class="fa fa-file-pdf">&nbsp;Attendance Sheet Without Image</i></button> -->
                                            &nbsp;
                                        </div>
                                        <div class="col-lg-3 col-md-12 col-sm-13">
                                            <button class="btn btn-success btn-xs  " onclick="exportCutListExcel()"><i
                                                    class="fa fa-file-excel">&nbsp;Cut List</i></button>
                                            &nbsp;
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-13">
                                            <button class="btn btn-danger  btn-xs " onclick="exportCutListPdf()"><i
                                                    class="fa fa-file-pdf">&nbsp;Cut List</i></button>


                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </div>
            <div class="col-lg-4 col-md-4 col-sm-3" style="">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Strength Calculator</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                                <label>Examination</label>
                                <select id="ExaminationFatch" name="ExaminationFatch" class="form-control" required="">
                                    <option value="">Examination</option>
                                    <?php
                                    $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
                                            $stmt2 = sqlsrv_query($conntest,$sql);
                                        while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                            {

                                        
                                        $Sgroup = $row1['Examination']; 
                                        
                                        ?>
                                                                        <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                                                        <?php    }

                                    ?>


                                </select>

                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label>SubJect Code</label>
                                <Input type="text"  class="form-control subject_code"  name="subject_code" id="subject_code"  required="" />

                            </div>
                           
                            <div class="col-lg-12 col-md-12 col-sm-13">


                                <label>Course</label>
                                <select name="CourseFatch" id="CourseFatch" class="form-control" onchange="selectSubName(this.value);">
                        <!-- <option value=''>Select Course</option> -->
                     </select>
                            </div>

                           

                          
                            



                            <div class="col-lg-6    col-md-4 col-sm-3">
                                <label>Subject</label>
                                <select name="subName" id="subName" class="form-control">
                        <option value=''>Select Subject</option>
                     </select>

                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label> Semester</label>
                                <select id='SemesterFatch' name="SemesterFatch" class="form-control" required="">
                                    <option value="">Sem</option>
                                    <?php 
                                    for($i=1;$i<=12;$i++)
                                    {?>
                                                                        <option value="<?=$i?>"><?=$i?></option>
                                                                        <?php }
                                                ?>

                                </select>

                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                               
                                <label>Batch</label>
                                <select id='BatchFatch' name="BatchFatch" class="form-control" >
                              
                                    <option value="">Batch</option>
                                    <?php 
                                    for($i=2013;$i<=2030;$i++)
                                    {?>
                                                                        <option value="<?=$i?>"><?=$i?></option>
                                                                        <?php }
                                                ?>

                                </select>

                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label>Type</label>
                                <select id="TypeFatch" name="TypeFatch" class="form-control" required="">
                                    <option value="">Select</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Reappear">Reappear</option>
                                    <option value="Additional">Additional</option>
                                    <option value="Improvement">Improvement</option>


                                </select>

                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-13">
                                <div class="form-group-xs  ">
                                    <br>
                                    <div class="row ">

                                       
                                        <div class="col-lg-8 col-md-12 col-sm-13">
                                            <button class="btn btn-success btn-xs  " onclick="exportCalculatorExcel()"><i
                                                    class="fa fa-file-excel">&nbsp;Download</i></button>
                                            &nbsp;
                                            <button class="btn btn-warning btn-xs  " onclick="calculateResult()">&nbsp;Calculate</button>
                                        </div>
                                       
                                        <div class="col-lg-4 col-md-12 col-sm-13">
                                        <p id="CalculateResult" style='font-size:20px; color:green;'></p>
                                        </div>
                                     
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </div>
            <!-- <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Cut List</h3>
                    </div>
                   
                    <div class="card-body table-responsive">

                    </div>
                  
                </div>
            </div> -->
            <!-- <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Strength Calculator</h3>
                    </div>
                   
                    <div class="card-body table-responsive">

                    </div>
                   
                </div>
            </div> -->
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->

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


 $(function() { 
   $("#subject_code").blur(function(e) {
     e.preventDefault();

     alert("sdfsf");
   
     var subject_code = $("#subject_code").val();
     var code = "117.1";
         $.ajax({
         url:'action.php',
         data:{subject_code:subject_code,code:code},
         type:'POST',
         success:function(data){
             if(data != "")
             {
                 $("#CourseFatch").html("");
                 $("#CourseFatch").html(data);
                 //console.log(data);
             }
   
         }
       });

         var code='152.1';
         $.ajax({
         url:'action.php',
         data:{subject_code:subject_code,code:code},
         type:'POST',
         success:function(data){
             if(data != "")
             {
                 $("#SemesterFatch").html("");
                 $("#SemesterFatch").html(data);
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
      var code=118.1;
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
   function calculateResult()
   {
    var ExaminationFatch = document.getElementById('ExaminationFatch').value;
    var subject_code = document.getElementById('subject_code').value;
    var CourseFatch = document.getElementById('CourseFatch');
    var CourseFatchtext = CourseFatch.options[CourseFatch.selectedIndex].innerHTML;
    var subName = document.getElementById('subName').value;
    var SemesterFatch = document.getElementById('SemesterFatch').value;
    var TypeFatch = document.getElementById('TypeFatch').value;
    var BatchFatch = document.getElementById('BatchFatch').value;
      var code=271;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,ExaminationFatch:ExaminationFatch,subject_code:subject_code,
            CourseFatchtext:CourseFatchtext,subName:subName,SemesterFatch:SemesterFatch,BatchFatch:BatchFatch,
TypeFatch:TypeFatch,
         },
         success: function(response) 
         {
            // console.log(response);
            document.getElementById("CalculateResult").innerHTML=response;
         }
      });
   }
function exportCutListExcel() {
    var exportCode = 40;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
        alert("Select ");
    }
}

function exportCutListPdf() {
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '') {
        window.open("export-cutlist-pdf-new.php?CollegeId=" + College + "&Course=" + Course + "&Batch=" + Batch +
            "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
        alert("Select ");
    }
}

function exportAttendancePdf() {
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '') {
        window.open("export-attendance-pdf.php?CollegeId=" + College + "&Course=" + Course + "&Batch=" + Batch +
            "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
        alert("Select ");
    }
}
function exportAttendancePdfWithoutIMage() {
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '') {
        window.open("export-attendance-pdf-new.php?CollegeId=" + College + "&Course=" + Course + "&Batch=" + Batch +
            "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
        alert("Select ");
    }
}
function exportCalculatorExcel() {
    var exportCode=41;
    var ExaminationFatch = document.getElementById('ExaminationFatch').value;
    var subject_code = document.getElementById('subject_code').value;
    var CourseFatch = document.getElementById('CourseFatch');
    var CourseFatchtext = CourseFatch.options[CourseFatch.selectedIndex].innerHTML;
    var subName = document.getElementById('subName').value;
    var SemesterFatch = document.getElementById('SemesterFatch').value;
    var TypeFatch = document.getElementById('TypeFatch').value;
    var BatchFatch = document.getElementById('BatchFatch').value;
    if (ExaminationFatch != '') {
        window.open("export.php?exportCode=" + exportCode +"&ExaminationFatch=" + ExaminationFatch + "&subject_code=" + subject_code + "&CourseFatch=" + CourseFatchtext +
            "&subName=" + subName + "&SemesterFatch=" +
            SemesterFatch + "&TypeFatch=" + TypeFatch+"&BatchFatch="+BatchFatch, '_blank');

    } else {
        alert("Select ");
    }
}
</script>

<?php

 include "footer.php";  ?>