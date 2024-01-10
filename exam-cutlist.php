<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                    
                        <span class="mr-2"> <button class="btn btn-primary btn-sm"  style="background-color:#D0EDFF; color:black;" data-toggle="tooltip" ><span class="badge"   id="pendingCount"> </span> Pending</button> </span>
                        <span class="mr-2"> <button class="btn btn-danger btn-sm"  style="background-color:;" data-toggle="tooltip" > <span class="badge" id="rejectCount"> </span> Rejected</button> </span>
                        <span class=""> <button class="btn  btn-sm " style="background-color:#F3ED8F; display:none;" data-toggle="tooltip" > <span class="badge" id="Forwardtodean"> </span> Forward to dean</button> </span>
                        <span class="mr-2"> <button class="btn  btn-sm "  style="background-color:#F3ED8F;" data-toggle="tooltip" > <span class="badge" id="Forwardtoaccount"> </span> Forward to account</button> </span>
                        <span class="mr-2"> <button class="btn btn-success btn-sm "  style="" data-toggle="tooltip" > <span class="badge" id="Accepted"> </span> Accepted</button> </span>
                        <span style="float:right;">
      <button class="btn btn-sm ">
         <input type="search"  class="form-control form-control-sm" name="rollNo" id="rollNo" placeholder="Search RollNo">
      </button>
            <button type="button" onclick="searchStudentOnRollNo();" class="btn btn-success btn-sm">
              Search
            </button>
      </span>
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
                            <div class="col-lg-2 col-md-2 col-sm-12">
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

                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <label class="" style="font-size:14px;">Action</label><br>
                                <button class="btn btn-danger btn-sm " onclick="fetchCutList()"><i class="fa fa-search" aria-hidden="true"></i></button>&nbsp;&nbsp;
                               
                                
                                                    &nbsp;&nbsp; <button class="btn btn-success btn-sm " onclick="exportCutListExcel()"><i
                                                    class="fa fa-file-excel"></i></button> 
                                                       
                                <button class="btn btn-danger btn-sm " onclick="exportCutListPdf()"><i
                                                    class="fa fa-file-pdf"></i></button>
                            </div>
                            <!-- <div class="col-lg-1 col-md-1 col-sm-13">
                                <label>&nbsp;</label><br>
                               
                                
                            </div> -->
                            


                        </div>
                        <div class="table table-responsive" id="show_record"></div>
                    </div>
                   
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </div>


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->

<script>

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})




// cutlistCountDepartment();
function cutlistCountDepartment() {
    var code = 323;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                College: College,
                Course: Course,
                Batch: Batch,
                Semester: Semester,
                Type: Type,
                Group: Group,
                Examination: Examination
            },
            success: function(response) {
                // console.log(response);
                var data = JSON.parse(response);
                document.getElementById("pendingCount").textContent = data[0];
                document.getElementById("rejectCount").textContent = data[1];
                document.getElementById("Forwardtodean").textContent = data[2];
                document.getElementById("Forwardtoaccount").textContent = data[3];
                document.getElementById("Accepted").textContent = data[4];

                




               
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
}




function fetchCutList() {
    var sub_data = 2;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    
    if (College != '') {
        var spinner = document.getElementById("ajax-loader");
            spinner.style.display = 'block';
        var code = '273';
        $.ajax({
            url: 'action_g.php',
            data: {
                code: code,
                College: College,
                Course: Course,
                Batch: Batch,
                Semester: Semester,
                Type: Type,
                Group: Group,
                Examination: Examination,sub_data:sub_data
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                document.getElementById("show_record").innerHTML = data;
                cutlistCountDepartment();
            }
        });
    } else {
        ErrorToast('Please Select College', 'bg-warning');
    }
}
function searchStudentOnRollNo() {
    var sub_data = 1;
    var rollNo = document.getElementById('rollNo').value;
    if(rollNo!='')
    {
    var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '273';
        $.ajax({
            url: 'action_g.php',
            data: {
                code: code,
                sub_data: sub_data,
                rollNo: rollNo
                
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                document.getElementById("show_record").innerHTML = data;

            }
        });
    }
    else{
        ErrorToast('Please Enter RollNo', 'bg-warning');
    }
  
}
function edit_stu(id) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 274;
    $.ajax({
        url: 'action_g.php',
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

function sub_code_int_ext_type_update(id,fid) {
    var r = confirm("Do you really want to Change");
    if (r == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var ext = document.getElementById(id + "_Ext").value;
        var code = 275;
        // alert(ext+' '+id);
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                id: id,
                Ext: ext
            },
            success: function(response) {
                // console.log(response);
                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('Successfully Updated');
                    edit_stu(fid);
                  
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });

    }
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
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
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
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export-cutlist-pdf-new.php?CollegeId=" + College + "&Course=" + Course + "&Batch=" + Batch +
            "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
        ErrorToast('All input required','bg-warning');
    }
}



function verify(ExamFromID)
 {
    var r = confirm("Do you really want to Verifiy");
    if (r == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 280;
        $.ajax({ 
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                ExamFromID: ExamFromID
            },
            success: function(response) {
                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('Successfully Verify');
                    edit_stu(ExamFromID);
                    fetchCutList();
                  
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });
    }
}
function lock(ExamFromID)
 {
    var r = confirm("Do you really want to Verifiy");
    if (r == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 281;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                ExamFromID: ExamFromID
            },
            success: function(response) {
                spinner.style.display = 'none';
                console.log(response);
                if (response == 1) {
                    
                    SuccessToast('Successfully Locked');
                    edit_stu(ExamFromID);
                    fetchCutList();
                  
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });
    }
}
</script>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Exam From Submit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_stu">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<?php

 include "footer.php";  ?>