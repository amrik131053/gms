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
                        <h6>Reports</h6>
                        <!-- <span class="mr-2"> <button class="btn btn-primary btn-sm"  style="background-color:#D0EDFF; color:black;" data-toggle="tooltip" ><span class="badge"   id="pendingCount"> </span> Pending</button> </span>
                        <span class="mr-2"> <button class="btn btn-danger btn-sm"  style="background-color:;" data-toggle="tooltip" > <span class="badge" id="rejectCount"> </span> Rejected</button> </span>
                        <span class=""> <button class="btn  btn-sm " style="background-color:#F3ED8F; display:none;" data-toggle="tooltip" > <span class="badge" id="Forwardtodean"> </span> Forward to dean</button> </span>
                        <span class="mr-2"> <button class="btn  btn-sm "  style="background-color:#F3ED8F;" data-toggle="tooltip" > <span class="badge" id="Forwardtoaccount"> </span> Forward to account</button> </span>
                        <span class="mr-2"> <button class="btn btn-success btn-sm "  style="" data-toggle="tooltip" > <span class="badge" id="Accepted"> </span> Accepted</button> </span> -->
                        <!-- <span style="float:right;">
      <button class="btn btn-sm ">
         <input type="search"  class="form-control form-control-sm" name="rollNo" id="rollNo" placeholder="Search RollNo">
      </button>
            <button type="button" onclick="searchStudentOnRollNo();" class="btn btn-success btn-sm">
              Search
            </button>
      </span> -->
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
                                <input type='hidden' name='check[]' id='check' value='<?=$CollegeID;?>' class='checkbox'
                                    checked>
                                <?php }?>
                                <select name="College" id='College' onchange="courseByCollege(this.value)"
                                    class="form-control form-control-sm">
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
                                <select name="batch" class="form-control form-control-sm" id="Batch">
                                    <option value="">Select</option>
                                    <?php 
                                    for($i=2013;$i<=2030;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                                ?>

                                </select>

                            </div>
                            <div class="col-lg-1">
                                <label>Session</label>
                                <select class="form-control form-control-sm" id="session">
                                    <option value="2024-25">2024-25</option>
                                    <option value="">Select</option>
                                    <option value="2022-23">2022-23</option>
                                    <option value="2023-24">2023-24</option>
                                    <option value="2024-25">2024-25</option>
                                    <option value="2025-26">2025-26</option>

                                </select>
                            </div>
                            <div class="col-lg-1">
                                <label>Nationality</label>
                                <select class="form-control form-control-sm" id="Nationality_"
                                    onchange="fetch_state(this.value);ShowHideDiv_address(this.value);">
                                    <option value="">Country</option>
                                    <?php 
                  $get_country="SELECT * FROM countries ";
                  $get_country_run=mysqli_query($conn,$get_country);
                  while($row=mysqli_fetch_array($get_country_run))
                  {?>
                                    <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                    <?php }

                 ?>
                                </select>

                            </div>
                            <div class="col-lg-1">
                                <label>State</label>
                                <select class="form-control form-control-sm" id="State_"
                                    onchange="fetch_district(this.value);">
                                    <option value="">State</option>
                                </select>
                            </div>
                            <div class="col-lg-1">
                                <label>District</label>
                                <select class="form-control form-control-sm" id="District"
                                    onchange="admisssion_complete(this.value);">
                                    <option value="">District</option>
                                </select>
                            </div>

                            <div class="col-lg-1">
                                <label>Consultant</label>
                                <select id="Consultant_" class="form-control form-control-sm">
                                    <option value=''>Select Consultant</option>
                                    <?php  $get_consultant="SELECT * FROM MasterConsultant where Status>0"; 

                     $get_consultant_run=sqlsrv_query($conntest,$get_consultant);
                     while($row=sqlsrv_fetch_array($get_consultant_run))
                     {?>

                                    <option value="<?=$row['ID'];?>"><?=$row['Name'];?></option>

                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <label class="" style="font-size:14px;">Action</label><br>
                                <button class="btn btn-danger btn-sm " onclick="fetchCutList()"><i class="fa fa-search"
                                        aria-hidden="true"></i></button>&nbsp;&nbsp;


                                &nbsp;&nbsp; <button class="btn btn-success btn-sm " onclick="exportCutListExcel()"><i
                                        class="fa fa-file-excel"></i></button>

                                        <button class="btn btn-success btn-sm " onclick="exportCutListExcelcount()"><i
                                        class="fa fa-file-excel"></i>&nbsp;&nbsp;Count</button>
                            </div>
                           
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
<script>
$(function() {
    $('[data-toggle="tooltip"]').tooltip()
})


function fetch_state(country_id) {

    var code = '160';
    $.ajax({
        url: 'action_g.php',
        data: {
            country_id: country_id,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {

                $("#State_").html("");
                $("#State_").html(data);
            }
        }
    });

}

function fetch_district(state_id) {
    var code = '161';
    $.ajax({
        url: 'action_g.php',
        data: {
            state_id: state_id,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {

                $("#District").html("");
                $("#District").html(data);
            }
        }
    });

}

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


    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var session = document.getElementById('session').value;
    var Nationality_ = document.getElementById('Nationality_').value;
    var State_ = document.getElementById('State_').value;
    var District = document.getElementById('District').value;
    var Consultant_ = document.getElementById('Consultant_').value;

    if (session != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '378';
        $.ajax({
            url: 'action_g.php',
            data: {
                code: code,
                College: College,
                Course: Course,
                Batch: Batch,
                session: session,
                Nationality_: Nationality_,
                State_: State_,
                District: District,
                Consultant_: Consultant_
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                document.getElementById("show_record").innerHTML = data;
                // cutlistCountDepartment();
            }
        });
    } else {
        ErrorToast('Please Select College', 'bg-warning');
    }
}



function exportCutListExcel() {
    var exportCode = 57;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var session = document.getElementById('session').value;
    var Nationality_ = document.getElementById('Nationality_').value;
    var State_ = document.getElementById('State_').value;
    var District = document.getElementById('District').value;
    var Consultant_ = document.getElementById('Consultant_').value;

    if (session != '') {
        window.open("export.php?exportCode=" + exportCode + "&College=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&session=" + session + "&Nationality_=" +
            Nationality_ + "&State_=" + State_ + "&District=" + District+ "&Consultant_=" + Consultant_, '_blank');

    } else {

        ErrorToast('All input required', 'bg-warning');
    }
}
function exportCutListExcelcount() {
    var exportCode = 58;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var session = document.getElementById('session').value;
    var Nationality_ = document.getElementById('Nationality_').value;
    var State_ = document.getElementById('State_').value;
    var District = document.getElementById('District').value;
    var Consultant_ = document.getElementById('Consultant_').value;

    if (session != '' ) {
        window.open("export.php?exportCode=" + exportCode + "&College=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&session=" + session + "&Nationality_=" +
            Nationality_ + "&State_=" + State_ + "&District=" + District+ "&Consultant_=" + Consultant_, '_blank');

    } else {

        ErrorToast('All input required', 'bg-warning');
    }
}

</script>
<?php

 include "footer.php";  ?>