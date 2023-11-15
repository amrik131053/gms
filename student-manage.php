<?php  
   include "header.php";   
   ?>
<script type="text/javascript">
function search_all_employee_emp_name(emp_name) {
    if (emp_name != '') {
        // var spinner=document.getElementById("ajax-loader");
        // spinner.style.display='block';
        var code = 266;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                empID: emp_name
            },
            success: function(response) {
                // spinner.style.display='none';
                document.getElementById("show_record1").innerHTML = response;
                // document.getElementById('emp_name').value="";

            }
        });
    }
}

function search_all_employee() {
    var emp_name = document.getElementById('emp_name').value;
    if (emp_name != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 266;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                empID: emp_name
            },
            success: function(response) {
                spinner.style.display = 'none';
                document.getElementById("show_record1").innerHTML = response;
                document.getElementById('show_record').innerHTML = "";

            }
        });
    }
}
function searchStudentCollegeWise() {
    var CollegeName = document.getElementById('CollegeName1').value;
    var Course = document.getElementById('Course1').value;
    var Batch = document.getElementById('Batch').value;
    var Status = document.getElementById('Status').value;
    if (CollegeName != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 270;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                CollegeName: CollegeName,
                Course: Course,
                Batch: Batch,
                Status: Status
            },
            success: function(response) {
                spinner.style.display = 'none';
                document.getElementById("show_record1").innerHTML = response;
                document.getElementById('show_record').innerHTML = "";

            }
        });
    }
}

function updateStudent(empID) {

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 267;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            empID: empID
        },
        success: function(response) {
            //  console.log(response);
            spinner.style.display = 'none';
            document.getElementById("updateRecord").innerHTML = response;
            $('#update_button').show();
            tab();

        }
    });
}


function fetchcourse1() {
    var College = document.getElementById('CollegeName1').value;
    var code = '269';
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                console.log(data);
                $("#Course1").html("");
                $("#Course1").html(data);
            }
        }
    });
}
function fetchcourse() {
    var College = document.getElementById('CollegeName').value;
    var code = '269';
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                // console.log(data);
                $("#Course").html("");
                $("#Course").html(data);
            }
        }
    });
}

function fetch_state1(country_id) {
    alert(country_id);
    var code = '160';
    $.ajax({
        url: 'action_g.php',
        data: {
            country_id: country_id,
            code: code
        },
        type: 'POST',
        success: function(data) {
            console.log(data);
            if (data != "") {

                $("#State_1").html("");
                $("#State_1").html(data);
            }
        }
    });

}

function fetch_district1(state_id) {
    var code = '161';
    $.ajax({
        url: 'action_g.php',
        data: {
            state_id: state_id,
            code: code
        },
        type: 'POST',
        success: function(data) {
            console.log(data);
            if (data != "") {

                $("#District_1").html("");
                $("#District_1").html(data);
            }
        }
    });

}




function uploadPhoto(form) {
    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Updated');
            } else if (response == 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else {

            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}



function exportEmployee() {
    var exportCode = 20;

    var CollegeId = document.getElementById('CollegeID_Set').value;

    if (CollegeId != '') {

        window.location.href = "export.php?exportCode=" + exportCode + "&CollegeId=" + CollegeId;
    } else {
        alert("Select ");
    }


}


function search() {
    var code = 327;

    var college = document.getElementById('CollegeID_For_Department').value;

    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            college: college
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("tab_data").innerHTML = response;
        }
    });

}


function printEmpIDCard(id) {
    var code = 2;
    if (id != '') {
        //  window.location.href="printSmartCardEmp.php?code="+code+"&id="+id,'_blank';
        window.open("printSmartCardStudent.php?code=" + code + "&id=" + id, '_blank');
    } else {
        alert("Select ");
    }

}
</script>

<div class="modal fade" id="UploadImageDocument" tabindex="-1" role="dialog" aria-labelledby="UploadImageDocumentTitle"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="Show_document">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='update_data'>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="UpdateDesignationModalCenter21" tabindex="-1" role="dialog"
    aria-labelledby="UpdateDesignationModalCenter21" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">edit Designaion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='updateRecord'>
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="NewDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="NewDepartmentModal"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewDepartmentModal">New Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <label>College</label>
                    <select name="College" id='CollegeIDN' class="form-control" required="">
                        <option value=''>Select Course</option>
                        <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         { 
     $college = $row1['CollegeName']; 
     $CollegeID = $row1['CollegeID'];
    ?>
                        <option value="<?=$CollegeID;?>"><?= $college;?>(<?=$CollegeID;?>)</option>
                        <?php    }
?>
                    </select>
                    <label>Designation</label>
                    <input type="text" name="table_search" id="department" class="form-control" required>
                    <br>
                    <input type="submit" onclick="save_designation();" value="save" class="btn btn-secondary">

                </div>
                <div class="col-lg-1"></div>

            </div>
            <br>
        </div>
    </div>
</div>
<div class="modal fade" id="NewDesignationModal" tabindex="-1" role="dialog" aria-labelledby="NewDesignationModal"
    aria-hidden="true">
    <div class="modal-dialog  " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewDesignationModal">New Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">

                    <label>Designation</label>
                    <input type="text" name="table_search" id="Designation" class="form-control" required>
                    <br>
                    <input type="submit" onclick="save_designation();" value="save" class="btn btn-secondary">

                </div>
                <div class="col-lg-1"></div>

            </div>
            <br>

        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Student</h3>
                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body p-0">
                        <div class="col-lg-12">
                            <label>College Name</label>
                            <select name="CollegeName" id='CollegeName1' onchange="fetchcourse1(this.value);"
                                class="form-control" required>
                                <option value=''>Select Faculty</option>
                                <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row['CollegeName']; 
                        $CollegeID = $row['CollegeID'];
                        ?>
                                <option value="<?=$CollegeID;?>"><?=$college;?></option>
                                <?php }
                        ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label>Department</label>
                            <select id="Course1" name="Course1" class="form-control" required>
                                <option value=''>Select Course</option>
                            </select>
                        </div>


                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Batch</label>

                                <select id="Batch" class="form-control" required>
                        <option value="">Batch</option>
                        <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                                  ?>
                    </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Status </label>
                                <!-- <input type="text" class="form-control" name="employmentStatus" placeholder="Enter employment status"> -->
                                <select class="form-control" id="Status">
                                  
                                    <option value="1">Active</option>
                                    <option value="0">DeActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Status </label><br>
                                <button type="button" class="btn btn-success" onclick="searchStudentCollegeWise();">Search</button>
                            </div>
                        </div>


                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-outline">

                    <div class="card-header">

                        <button type="button" onclick="exportEmployee();" class="btn btn-success btn-sm ">
                            <i class="fa fa-file-excel"></i>
                        </button>


                        <span style="float:right;">
                            <button class="btn btn-sm ">
                                <input type="search" onblur="search_all_employee_emp_name(this.value);"
                                    class="form-control form-control-sm" name="emp_name" id="emp_name"
                                    placeholder="Search here">
                            </button>
                            <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
                                Search
                            </button>
                        </span>
                        <input type="hidden" id="CollegeID_Set">


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <form action="action_g.php" method="post" enctype="multipart/form-data">
                            <div class="table-responsive" id="show_record1" style="height:auto;">
                                <!-- Your table to display employee records goes here -->
                            </div>
                            <div class="table-responsive" id="show_record" style="height:auto;">
                                <!-- Your table to display employee records goes here -->
                            </div>
                        </form>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->



                    <!-- Additional footer content if needed -->
                </div>
            </div>
            <!-- /.card -->
        </div>

        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<p id="ajax-loader"></p>

<!-- Modal -->
<?php include "footer.php"; ?>