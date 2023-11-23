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
                        <h3 class="card-title">Attendance Sheet</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
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



                            <label>Course</label>
                            <select name="Course" id="Course" class="form-control">
                                <option value=''>Select Course</option>

                            </select>


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
for($i=1;$i<=12;$i++)
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


                            <div class="form-group ">
                                
                                </br>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                <button class="btn btn-danger btn-sm " onclick="exportAttendancePdf()"><i
                                        class="fa fa-file-pdf">&nbsp;Attendance Sheet</i></button>
                                        &nbsp;
                                        
                                <button class="btn btn-success btn-sm  " onclick="exportCutListExcel()"><i
                                        class="fa fa-file-excel">&nbsp;Cut List</i></button>  
                                        &nbsp;
                                        
                                <button class="btn btn-danger  btn-sm " onclick="exportCutListPdf()"><i
                                        class="fa fa-file-pdf">&nbsp;Cut List</i></button>
                                        &nbsp;
                                        
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
        window.open("export-cutlist-pdf.php?CollegeId=" + College + "&Course=" + Course + "&Batch=" + Batch +
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
</script>

<?php

 include "footer.php";  ?>