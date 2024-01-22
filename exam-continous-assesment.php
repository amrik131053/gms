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

                            <div class="col-lg-6">
                               
                               D - Detailed   , S - Summary , G - Grade , C - CSV , M  - Marks
                           
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
                                    for($i=1;$i<=12;$i++)
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
                                <button class="btn btn-danger btn-sm " onclick="Search_exam_student1()"><i class="fa fa-search" aria-hidden="true"></i></button>&nbsp;&nbsp;
                                 <button class="btn btn-success btn-sm " onclick="exportCutListExcelgradeca()">Detail</button> 
                                
                                                    &nbsp;&nbsp; <button class="btn btn-success btn-sm " onclick="exportCutListExcel()">Summary</button> 

                                                    <button class="btn btn-success btn-sm " onclick="exportCutListExcelgrade()">G</button> 
                                                     <button class="btn btn-success btn-sm " onclick="exportCutListExcelcsv()">CSV</button> 
                                                     <button class="btn btn-success btn-sm " onclick="exportCutListExcelmarks()">M</button> 


                                                  
                                                       
                              
                            </div>
                            <!-- <div class="col-lg-1 col-md-1 col-sm-13">
                                <label>&nbsp;</label><br>
                               
                                
                            </div> -->
                            


                        </div>
    </div>



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


function edit_stu(id) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 356;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {

            spinner.style.display = 'none';
            document.getElementById("edit_stu").innerHTML = response;

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
     //var userid = document.getElementById('userid').value;

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
</script>