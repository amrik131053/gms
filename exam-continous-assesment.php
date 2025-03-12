<?php

ini_set('max_execution_time', '0');

    include 'header.php';
?>
<p id="ajax-loader"></p>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-lg-1">
                                <h3 class="card-title">Exam From</h3>
                            </div>
                            <div class="col-lg-2">
                            
                                <input type="text" class="form-control" name="IDNo" id="rollno" placeholder="RollNo">
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-info" onclick="search_exam_form()"> <i
                                        class="fa fa-search" aria-hidden="true"></i></button>
                            </div>

                            <div class="col-lg-4">
                               
                               D - Detailed   , S - Summary , G - Grade , C - CSV , M  - Marks
                           
                            </div>
                            
                              <div class="col-lg-2">
                            
                             
                                <select id="examination2" class="form-control form-control" >
                                    <option value="">Select</option>
                                    <?php
                                     $sql="SELECT DISTINCT Examination from ResultGKU Order by Examination ASC ";
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
                            <div class="col-lg-1">
                                 <button type="button" class="btn btn-info" onclick="search_exam_data()"> <i
                                        class="fa fa-search" aria-hidden="true"></i></button> &nbsp;<button type="button" class="btn btn-info" onclick="export_exam_data()"> <i
                                        class="fa fa-file-excel" aria-hidden="true"></i></button>
                            </div>
                           
                        </div>
                    </div>



<div class="card-body">

     <div class="form-group row">
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <label>College</label>
                                <?php      $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID WHERE MasterCourseCodes.CollegeID!='76' AND MasterCourseCodes.CollegeID!='77' AND MasterCourseCodes.CollegeID!='70' AND IDNo='$EmployeeID' order By CollegeID Asc";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
?>
   <input type='hidden' name='check[]' id='check' value='<?=$CollegeID;?>' class='checkbox' checked >
<?php }?>
                                <select name="College" id='College' onchange="courseByCollege(this.value)"
                                    class="form-control form-control-sm" >
                                    <option value=''>Select College</option>
                                    <?php

                                    $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID  where UserAccessLevel.IDNo='$EmployeeID'";
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
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <label>Course</label>
                                <select name="Course" id="Course" class="form-control form-control-sm">
                                    <option value=''>Select Course</option>

                                </select>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Batch</label>
                                <select name="batch" class="form-control form-control-sm" id="Batch" >
                                    <option value="">Select</option>
                                    <?php 
                                    for($i=2013;$i<=2030;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                                ?>

                                </select>

                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label> Semester</label>
                                <select id='Semester' class="form-control form-control-sm" >
                                    <option value="">Select</option>
                                    <?php 
                                    for($i=0;$i<=12;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                                ?>

                                </select>

                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Type</label>
                                <select id="Type" class="form-control form-control-sm" >
                                    <option value="">Select</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Reappear">Reappear</option>
                                    <option value="Additional">Additional</option>
                                    <option value="Improvement">Improvement</option>


                                </select>

                            </div>



                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Group</label>
                                <select id="Group" class="form-control form-control-sm" >
                                    <option value="">Select</option>
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
                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Examination</label>
                                <select id="Examination" class="form-control form-control-sm" >
                                    <option value="">Select</option>
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

                            <div class="col-lg-3 col-md-3 col-sm-13">
                                <label class="" style="font-size:14px;">Action</label><br>
                                <button class="btn btn-danger btn-sm " onclick="Search_exam_student1()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                
                                                    &nbsp;&nbsp; <button class="btn btn-success btn-sm " onclick="exportCutListExcel()">S</button> 
                                                    &nbsp;&nbsp;<button class="btn btn-success btn-sm " onclick="exportCutListExcelgrade()">G</button> 
                                 <button class="btn btn-success btn-sm " onclick="exportCutListExcelgradeca()">D</button> 

                                                    
                                                     <button class="btn btn-success btn-sm " onclick="exportCutListExcelcsv()">CSV</button> 
                                                     <button class="btn btn-success btn-sm " onclick="exportCutListExcelmarks()">M</button> 
                                                     <br>---- May 2024 onwards------
  <br>

                                                     
                                
                                                    &nbsp;&nbsp; <button class="btn btn-success btn-sm " onclick="exportCutListExceln()">NS</button> <!--63-->
                                                    &nbsp;&nbsp;<button class="btn btn-success btn-sm " onclick="exportCutListExcelgraden()">NG</button> <!--64-->
                                 <button class="btn btn-success btn-sm " onclick="exportCutListExcelgradecan()">ND</button> <!--65-->

                                                    
                                                     <button class="btn btn-success btn-sm " onclick="exportCutListExcelcsvn()">NCSV</button> <!--66-->
                                                     <button class="btn btn-success btn-sm " onclick="exportCutListExcelmarksn()">NM</button> <!--67-->
                                                     <button class="btn btn-success btn-sm " onclick="exportCutListMaster()">Master</button> <!--64.1 -->



                                                  
                                                       
                              
                            </div>
                            <!-- <div class="col-lg-1 col-md-1 col-sm-13">
                                <label>&nbsp;</label><br>
                               
                                
                            </div> -->
                            


                        </div>
    </div>

    <div class="row ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="mr-2"><i class="fa fa-stop text-info" aria-hidden="true"></i> Reverted</span>
                        <span class="mr-2"><i class="fa fa-stop text-warning" aria-hidden="true"></i> Verified</span>
    <span ><i class="fa fa-stop text-success" aria-hidden="true"></i> Published</span>
</div>&nbsp;

                    <!-- /.card-header -->
                    <div class="card-body table-responsive" style="font-size: 14px;" id="live_data_Exam_student">



                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<?php include'footer.php';?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>



<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Exam From Submit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_stu">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>


</div>

</body>

</html>
<script type="text/javascript">


function search_exam_form() {
    var rollNo = document.getElementById('rollno').value;
    var spinner = document.getElementById("ajax-loader");
    var sub_data = 1;
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code =355;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            rollNo: rollNo,
            sub_data: sub_data
        },
        success: function(response) {

            // $('#modal-lg-view-question').modal('toggle');
            spinner.style.display = 'none';
            document.getElementById("live_data_Exam_student").innerHTML = response;

        }
    });
}

function search_exam_data() {
    
    var examination = document.getElementById('examination2').value;
    var spinner = document.getElementById("ajax-loader");
   
    spinner.style.display = 'block';
  
    var code =379;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            examination: examination
            
        },
        success: function(response) {

            // $('#modal-lg-view-question').modal('toggle');
            spinner.style.display = 'none';
            document.getElementById("live_data_Exam_student").innerHTML = response;

        }
    });
}


function edit_stu(id,resultStatus,MinDeclareType) {
    // alert(resultStatus);
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 356;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code:code,
            id:id,
            resultStatus:resultStatus,MinDeclareType:MinDeclareType
        },
        success: function(response) {
// console.log(response);
            spinner.style.display = 'none';
            document.getElementById("edit_stu").innerHTML = response;

        }
    });

}

function VerifyResultRegular(ID,Examination,Semester,MinDeclareType){

    // alert(Examination+'-'+Semester);
var spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var code = 455.1;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,ID: ID,Examination:Examination,
                Semester:Semester,MinDeclareType:MinDeclareType
            },
            success: function(response) {
             SuccessToast('Successfully Verified');
             Search_exam_student1();
                spinner.style.display = 'none';
            }
        });
}



function Search_exam_student1() {
    var code = 355;
    var sub_data = 2;
    var College = document.getElementById("College").value;
    var Course = document.getElementById("Course").value;
    var Batch = document.getElementById("Batch").value;
    var Semester = document.getElementById("Semester").value;
    var Type = document.getElementById("Type").value;
    var Group = document.getElementById("Group").value;
    var Examination = document.getElementById("Examination").value;
     var OrderBy='';//var userid = document.getElementById('userid').value;

    if (Batch != '' && Semester != '' && College != '' && Course != '' && Type != '' && Group != '' && Examination !=
        '') {

        //x.style.display = "block";
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';

        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,
                College: College,
                Course: Course,
                Batch: Batch,
                Semester: Semester,
                Type: Type,
                Group: Group,
                OrderBy:OrderBy,
                Examination: Examination,
                sub_data: sub_data
            },
            success: function(response) {
                // $('#modal-lg-view-question').modal('toggle');
                spinner.style.display = 'none';
                document.getElementById("live_data_Exam_student").innerHTML = response;

            }
        });
    }
}

function exportCutListExcel() {
    var exportCode = 52;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}

function exportCutListExcelgrade() {
    var exportCode = 53;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}


function exportCutListExcelgradeca() {
    var exportCode = 54;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}

function exportCutListExcelcsv() {
    var exportCode = 55;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}


function exportCutListExcelmarks() {
    var exportCode = 56;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}


//new may 2024 onwards

function exportCutListExceln() { 
    var exportCode = 63;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}

function exportCutListExcelgraden() {
    var exportCode = 64;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}

function exportCutListExcelgradecan() {
    var exportCode = 65;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}


function exportCutListExcelcsvn() {
    var exportCode = 66;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}


function exportCutListExcelmarksn() {
    var exportCode = 67;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}
function exportCutListMaster() {
    var exportCode = 64.1;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}

//

function export_exam_data() { 
    var exportCode = 82;
   
   var examination = document.getElementById('examination2').value;
   
    if (examination != '' ) {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" +  "&Examination=" + examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}
</script>
