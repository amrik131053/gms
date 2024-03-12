<?php 
   include "header.php"; 
  
   ?>
<section class="content">
    <section class="content">

        <div class="container-fluid">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-3">
                        <select id="Type" class="form-control form-control-range">
                            <?php $getType="SELECT DISTINCT  Type FROM ExamForm  order by Type DESC ";
                        $gettypeRun=sqlsrv_query($conntest,$getType);
                        while($row=sqlsrv_fetch_array($gettypeRun))
                        {
                        ?>
                            <option value="<?=$row['Type'];?>"><?=$row['Type'];?></option>

                            <?php 
                        }
                             
                                  ?>
                        </select>


                    </div>
                    <div class="col-lg-3">
                        <select id="Batch" class="form-control form-control-range">
                            <option value="">Batch</option>
                            <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php }
                                  ?>
                        </select>

                    </div>
                    <div class="col-lg-2">
                        <select id="Semester" class="form-control form-control-range">
                            <option value="">Sem</option>
                            <?php 
                              for($i=1;$i<=12;$i++)
                                 {?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php }
                                  ?>
                        </select>

                    </div>

                    <div class="col-lg-3">
                        <select id="Examination" class="form-control form-control-range">
                            <?php
                                     $sql="SELECT DISTINCT Examination from ExamForm Order by Examination DESC ";
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
                    <?php  if($code_access!='111')
            {?>
                        <!-- <button class="btn btn-success"
                            onclick="loadDashboard();">
                            Search</button> -->
                            <?php }?>
                            <?php  if($code_access!='000')
            {?>
                        <button class="btn btn-success"
                            onclick="loadMainCount();">
                            Search</button>
<?php }?>

                    </div>

                </div>
            </div>
            <br>
            



            <!-- <h3 class="mt-4 mb-4">Social Widgets</h3> -->
            <?php  if($code_access=='111')
            {?>
            <div class="row">
                <div class="col-md-3">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <!-- <h3 class="widget-user-username">Registration Branch</h3> -->
                            <h5 class="widget-user-desc">Registration Branch</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="dist\img\logo-login.png" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header" id="RegiPending"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Pending</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header" id="RegiRejected"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Rejected</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header" id="RegiVerified"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Verified</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <div class="col-md-3">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <!-- <h3 class="widget-user-username">Alexander Pierce</h3> -->
                            <h5 class="widget-user-desc">Department</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="dist\img\logo-login.png" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header" id="DepartPending"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Pending</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header" id="DepartRejected"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Rejected</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header" id="DepartVerified"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Verified</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <div class="col-md-3">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-info">
                            <!-- <h3 class="widget-user-username"></h3> -->
                            <h5 class="widget-user-desc">Accounts</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="dist\img\logo-login.png" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header" id="AccountPending"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Pending</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header" id="AccountRejected"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Rejected</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header" id="AccountVerified"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Verified</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
                <div class="col-md-3">

                    <div class="card card-widget widget-user">

                        <div class="widget-user-header bg-info">

                            <h5 class="widget-user-desc">Examination</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src="dist\img\logo-login.png" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header " id="ExamPending"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Pending</span>
                                    </div>

                                </div>

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header" id="ExamRejected"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Rejected</span>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header" id="ExamVerified"><b
                                                class="spinner-border spinner-border-sm"></b></h5>
                                        <span class="description-text">Verified</span>
                                    </div>

                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div> 
            </div>
            <?php }
         
            ?>

            <!-- ----------------------------------------------------------------------------------- -->

            <div class="row">

                <?php      $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID WHERE MasterCourseCodes.CollegeID!='76' AND MasterCourseCodes.CollegeID!='77' AND MasterCourseCodes.CollegeID!='70' AND IDNo='$EmployeeID' order By CollegeID Asc";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];


                       

?>
                <div class="col-md-12">
                    <div class="card card-widget widget-user-2 shadow-lg ">

                        <div class="card collapsed-card">
                            <div class="card-header" style="background-color: #28a745 !important;color: white;">
                                <!-- <input type='hidden' name='check[]' id='check' value='<?=$CourseID;?>' class='checkbox' checked> -->
                                <div class=" card-tools">&nbsp;&nbsp;<?=$college;?>(<?=$CollegeID;?>)
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        onclick="exportTotalScordingToCollege(<?=$CollegeID;?>);"
                                        style="float:right;padding:15px;">
                                        <i class="fa fa-download fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-0">
                            <div class=" table-responsive">

                                <table class="table table-bordered table-hover">

                                    <?php 
                                  $getCourse="SELECT Distinct MasterCourseCodes.Course,MasterCourseCodes.CourseID FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID Where ExamForm.CollegeID='$CollegeID' and ExamForm.Examination='$CurrentExamination' ";
                                 $getCourseRun=sqlsrv_query($conntest,$getCourse);
                                 while($rowCourseName = sqlsrv_fetch_array($getCourseRun, SQLSRV_FETCH_ASSOC))
                                 { 
                                    $CourseID=$rowCourseName['CourseID'];
                                    
                                    ?>

                                    <div class="card collapsed-card">
                                        <div class="card-header"
                                            style="background-color: #223260 !important;color: white;">
                                            <input type='hidden' name='check[]' id='check' value='<?=$CourseID;?>'
                                                class='checkbox' checked>
                                            <div class="">&nbsp;&nbsp;<?=$rowCourseName['Course'];?>(<?=$CourseID;?>)

                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    onclick="showBatchsFromCourse(<?=$CourseID;?>);"
                                                    style="float:right;padding:15px;">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool"
                                                    onclick="exportTotalScordingToCourseSumy(<?=$CourseID;?>);"
                                                    style="float:right;padding:15px;">
                                                    <i class="fa fa-download fa-lg"></i>
                                                </button>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <ul class="nav nav-pills flex-column" id="showBatchs<?=$CourseID;?>">

                                                <center><img src="dist/img/div-loader.gif" width="30"
                                                        id="divloader<?=$CourseID;?>" style="display:none !important;">
                                                </center>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <?php
                                 }
?>

                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                <!-- ----------------------------------------------------------------------------------- -->

                <?php }?>

            </div>
    </section>
    <p id="ajax-loader"></p>
    <script>
    const d = new Date();
    let year = d.getFullYear();
   

    <?php if($code_access=='111'){?>
    loadMainCount();
    <?php }?>

    function exportTotalScordingToCollege(CollegeID) { // college
        var exportCode = 50;
        var Examination = document.getElementById('Examination').value;
        window.open("export.php?exportCode=" + exportCode + "&Examination=" + Examination + "&CollegeID=" + CollegeID,
            '_blank');
    }

    function exportTotalScordingToCourseSumy(CourseID) { // course
        var exportCode = 49;
        var Examination = document.getElementById('Examination').value;
        window.open("export.php?exportCode=" + exportCode + "&Examination=" + Examination + "&CourseID=" + CourseID,
            '_blank');

    }

    function exportTotalScordingToBatchSumy(CourseID, Batch, Sem) { //batch
        var exportCode = 49;

        var Examination = document.getElementById('Examination').value;
        window.open("export.php?exportCode=" + exportCode + "&Examination=" + Examination + "&CourseID=" + CourseID +
            "&Batch=" + Batch + "&Sem=" + Sem, '_blank');
    }

    function exportTotalExamFormNotApplied(Sem, Course, Batch) {
        var exportCode = 36;
        window.location.href = "export.php?exportCode=" + exportCode + "&Sem=" + Sem + "&course=" + Course + "&Batch=" +
            Batch;


    }

    function exportTotalAdm(College, course, Batch) {
        var exportCode = 33;
        window.location.href = "export.php?exportCode=" + exportCode + "&College=" + College + "&course=" + course +
            "&Batch=" + Batch;

    }

    // function loadDashboard() {

    //     var subjects = document.getElementsByClassName('checkbox');
    //     var len_subject = subjects.length;
    //     var subject_str = [];

    //     for (i = 0; i < len_subject; i++) {
    //         if (subjects[i].checked === true) {
    //             subject_str.push(subjects[i].value);
    //         }
    //     }

    //     // for (i = 0; i < len_subject; i++) {
    //     //     var CourseID = subject_str[i];

    //     //    // showBatchsFromCourse(CourseID);

    //     // }


    // }






    function loadMainCount() {
        alert('dfsfdsf');
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var ExaminationA = document.getElementById("Examination").value;
        var TypeA = document.getElementById("Type").value;
        var BatchA = document.getElementById("Batch").value;
        var SemesterA = document.getElementById("Semester").value;

        var code = 337;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Examination: ExaminationA,
                Batch: BatchA,
                Type: TypeA,
                Semester: SemesterA

            },
            success: function(response) {
                //console.log(response);
                spinner.style.display = 'none';
                var data = JSON.parse(response);
                document.getElementById("RegiPending").innerHTML = data[0];
                document.getElementById("RegiRejected").innerHTML = data[1];
                document.getElementById("RegiVerified").innerHTML = data[2];

                document.getElementById("DepartPending").innerHTML = data[3];
                document.getElementById("DepartRejected").innerHTML = data[4];
                document.getElementById("DepartVerified").innerHTML = data[5];

                document.getElementById("AccountPending").innerHTML = data[6];
                document.getElementById("AccountRejected").innerHTML = data[7];
                document.getElementById("AccountVerified").innerHTML = data[8];

                document.getElementById("ExamPending").innerHTML = data[9];
                document.getElementById("ExamRejected").innerHTML = data[10];
                document.getElementById("ExamVerified").innerHTML = data[11];

            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });

    }








 


    function showBatchsFromCourse(CourseID) {

        var ExaminationB = document.getElementById("Examination").value;
        var TypeB = document.getElementById("Type").value;
        var BatchB = document.getElementById("Batch").value;
        var SemesterB = document.getElementById("Semester").value;

        var code = 333;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                Examination: ExaminationB,
                Batch: BatchB,
                Type: TypeB,
                Semester: SemesterB,
                CourseID: CourseID
            },
            success: function(response) {
                // console.log(ExaminationB+BatchB+TypeB+SemesterB)
                // spinner.style.display = 'none';

                if (CourseID !== null) {
                    document.getElementById("showBatchs" + CourseID).innerHTML = response;
                }

                //  loadMainCount();
            }
        });
    }
    </script>

    <?php

 include "footer.php";  ?>