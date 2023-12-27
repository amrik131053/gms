<?php 
   include "header.php"; 
    
   ?>
<section class="content">
    <section class="content">

        <div class="container-fluid">
            <div class="card-header">
                <div class="row">
                    <!-- <div class="col-lg-4">
                        <select id="Batch" class="form-control form-control-range" onchange="loadDashboard();">
                            <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                            <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php }
                                  ?>
                        </select>

                    </div> -->
                    <!-- <div class="col-lg-4">
                        <select id="Lateral" class="form-control form-control-range" onchange="loadDashboard();">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                            <?php 
                             
                                  ?>
                        </select>


                    </div> -->
                    <div class="col-lg-4">
                        <select id="Examination" class="form-control form-control-range" onchange="loadDashboard();">
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
                </div>
            </div>
            <br>
            



            <!-- <h3 class="mt-4 mb-4">Social Widgets</h3> -->
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
                        <!-- <div class="card-header info-box  shadow-lg" style="background-color: #28a745 !important;color: white;"> -->

                            
                                


                            <!-- <a href="#" class="small-box-footer">
                                <button type="submit" class="btn btn-sm"style="float:right !important;color:white;"
                                    onclick="exportTotalScordingToCollegeSumy(<?=$CollegeID;?>,'','');" >
                                    <i class="fa fa-download fa-lg"></i></button>
                            </a> -->
                         

                        <!-- </div> -->
                        <div class="card collapsed-card">
                        <div class="card-header" style="background-color: #28a745 !important;color: white;">
                                    <input type='hidden' name='check[]' id='check' value='<?=$CourseID;?>' class='checkbox' checked>
                                        <div class=" card-tools">&nbsp;&nbsp;<?=$college;?>(<?=$CollegeID;?>)
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                onclick="exportTotalScordingToCollege(<?=$CollegeID;?>);" style="float:right;padding:15px;">
                                                <i class="fa fa-download fa-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                      </div>
                        <div class="card-footer p-0">
                            <div class=" table-responsive" >

                                <table class="table table-bordered table-hover">
                              
                                    <?php 
                                  $getCourse="SELECT Distinct MasterCourseCodes.Course,MasterCourseCodes.CourseID FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID Where ExamForm.CollegeID='$CollegeID' and ExamForm.Examination='$CurrentExamination' ";
                                 $getCourseRun=sqlsrv_query($conntest,$getCourse);
                                 while($rowCourseName = sqlsrv_fetch_array($getCourseRun, SQLSRV_FETCH_ASSOC))
                                 { 
                                    $CourseID=$rowCourseName['CourseID'];
                                    
                                    ?>
                               
                                    <div class="card collapsed-card">
                                    <div class="card-header" style="background-color: #223260 !important;color: white;">
                                    <input type='hidden' name='check[]' id='check' value='<?=$CourseID;?>' class='checkbox' checked>
                                        <div class="">&nbsp;&nbsp;<?=$rowCourseName['Course'];?>(<?=$CourseID;?>)
                                        <div style="float:right;">
                                        <span class="mr-10"> <button class="btn btn-primary btn-xs ">
                                            <span class="badge" id="pendingCount<?=$CourseID;?>"> </span>Pending </button> </span>
                                               <span class="mr-2"> <button class="btn btn-danger btn-xs "><span class="badge" id="rejectCount<?=$CourseID;?>"> </span>Rejected </button> </span>
                                            <span> <button class="btn btn-success btn-xs " ><span class="badge"id="verifiedCount<?=$CourseID;?>"> </span>Verified </button> </span>
                                        
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                onclick="showBatchsFromCourse(<?=$CourseID;?>);" style="float:right;padding:15px;">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" 
                                                onclick="exportTotalScordingToCourseSumy(<?=$CourseID;?>);" style="float:right;padding:15px;">
                                                <i class="fa fa-download fa-lg"></i>
                                            </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="nav nav-pills flex-column" id="showBatchs<?=$CourseID;?>">

                                        </ul>
                                    </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <?php }?>

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
    loadDashboard();
    function exportTotalScordingToCollege(CollegeID) { // college
        var exportCode = 50;
        var Examination = document.getElementById('Examination').value;
        window.open("export.php?exportCode=" + exportCode + "&Examination=" + Examination + "&CollegeID=" + CollegeID, '_blank');
    }

    function exportTotalScordingToCourseSumy(CourseID) { // course
        var exportCode = 49;
        var Examination = document.getElementById('Examination').value;
        window.open("export.php?exportCode=" + exportCode + "&Examination=" + Examination + "&CourseID=" + CourseID, '_blank');

    }

    function exportTotalScordingToBatchSumy(CourseID,Batch,Sem) { //batch
        var exportCode = 49;
       
        var Examination = document.getElementById('Examination').value;
        window.open("export.php?exportCode=" + exportCode + "&Examination=" + Examination + "&CourseID=" + CourseID+ "&Batch=" + Batch+ "&Sem=" + Sem, '_blank');
    }
    function exportTotalExamFormNotApplied(Sem,Course,Batch) {
       var exportCode=36;
        window.location.href="export.php?exportCode="+exportCode+"&Sem="+Sem+"&course="+Course+"&Batch="+Batch;
    
   
}
function exportTotalAdm(College,course,Batch) {
       var exportCode=33;
       window.location.href="export.php?exportCode="+exportCode+"&College="+College+"&course="+course+"&Batch="+Batch;
       
     }

    function loadDashboard() {
      
        var spinner = document.getElementById("ajax-loader");
spinner.style.display = 'block';
        var subjects = document.getElementsByClassName('checkbox');
        var len_subject = subjects.length;
        var subject_str = [];

        for (i = 0; i < len_subject; i++) {
            if (subjects[i].checked === true) {
                subject_str.push(subjects[i].value);
            }
        }

        for (i = 0; i < len_subject; i++) {
            var a = subject_str[i];

                  showBatchsFromCourse(a);
                  pendingCount(a);
                 rejectCount(a);
                 verifiedCount(a);
        }

    }



    function showBatchsFromCourse(CourseID) {
        // var Batch = document.getElementById("Batch").value;
        // var Lateral = document.getElementById("Lateral").value;
        var Examination = document.getElementById("Examination").value;
var spinner = document.getElementById("ajax-loader");
spinner.style.display = 'block';
var code = 333;
$.ajax({
    url: 'action_g.php',
    type: 'POST',
    data: {
        code: code,
        CourseID: CourseID,
        // Batch:Batch,
        // Lateral:Lateral,
        Examination:Examination
    },
    success: function(response) {
        spinner.style.display = 'none';
        document.getElementById("showBatchs"+CourseID).innerHTML = response;
    }
});
}












function pendingCount(a)
 {
    var spinner = document.getElementById("ajax-loader");
spinner.style.display = 'block';
    var Examination = document.getElementById('Examination').value;
        var code = 334;

        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
              
                CourseID: a,
                
                Examination: Examination
            },
            success: function(response) {
                spinner.style.display = 'none';
                document.getElementById("pendingCount"+a).innerHTML = response;

            }
        });
    }
function rejectCount(a)
 {
  
    var Examination = document.getElementById('Examination').value;
    var spinner = document.getElementById("ajax-loader");
spinner.style.display = 'block';
        var code = 335;
        // alert(code);
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
              
              CourseID: a,
              
              Examination: Examination
            },
            success: function(response) {
                // console.log(response);
                spinner.style.display = 'none';
                document.getElementById("rejectCount"+a).innerHTML = response;

            }
        });
    }
function verifiedCount(a)
 {
    var spinner = document.getElementById("ajax-loader");
spinner.style.display = 'block';
    var Examination = document.getElementById('Examination').value;
        var code = 336;
        // alert(code);
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
              
              CourseID: a,
              
              Examination: Examination
            },
            success: function(response) {
                spinner.style.display = 'none';
                // console.log(response);
                document.getElementById("verifiedCount"+a).innerHTML = response;

            }
        });
    }
    </script>

    <?php

 include "footer.php";  ?>