<?php 
  include "header.php";   
?>
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
        </div>
        <div class="row">

            <div class="col-lg-12 col-md-4 col-sm-12">
                <div class=" card-header">
                    Subject Allotment
                </div>
                <div class="card-body card">
                    <div class="row">
                        <div class="col-lg-2">
                            <label>College Name</label>
                            <select name="College" id='College' onchange="collegeByDepartment(this.value);"
                                class="form-control form-control-sm">
                                <option value=''>Select College</option>
                                <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where IDNo='$EmployeeID' ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                                <option value="<?=$CollegeID;?>"><?=$college;?></option>
                                <?php }
                        ?>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label>Department</label>
                            <select id="Department" name="Department" class="form-control form-control-sm"
                                onchange="fetchcourse()" required>
                                <option value=''>Select Department</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label>Course</label>
                            <select id="Course" class="form-control form-control-sm">
                                <option value=''>Select Course</option>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label>Batch</label>
                            <select id="batch" class="form-control form-control-sm">
                                <option value="">Batch</option>
                                <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php }
                                  ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <label>Semester</label>
                            <select id='semester' class="form-control form-control-sm">
                                <option value="">Sem</option>
                                <?php 
                        for($i=1;$i<=20;$i++)
                           {?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php }
            ?>
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <label>Group</label>
                            <select id='group' class="form-control form-control-sm">
                                <option value="">Group</option>
                                <?php
   $sql="SELECT DISTINCT Sgroup from MasterCourseStructure ";
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





                        <div class="col-lg-2">
                            <label>Action</label><br>
                            <button onclick="searchShowAllSubject();" class="btn btn-success btn-sm">Search</button>
                        </div>

                    </div>
                    <br>
                    <div class="row" id="load_study_scheme">


                    </div>
                    <div id="dddd"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<p id="ajax-loader"></p>
<script type="text/javascript">
$(window).on('load', function() {
    $('#btn6').toggleClass("bg-success");
})

function format() {
    window.location.href = 'http://gurukashiuniversity.co.in/gkuadmin/formats/studyscheme.csv';
}

function bg(id) {
    $('.btn').removeClass("bg-success");
    $('#' + id).toggleClass("bg-success");
}

// Search();
function searchShowAllSubject() {
    var code = 385;

    var CollegeID = document.getElementById('College').value;

    var Course = document.getElementById('Course').value;

    var batch = document.getElementById('batch').value;

    var semester = document.getElementById('semester').value;

    var group = document.getElementById('group').value;
    var Department = document.getElementById('Department').value;
    
    
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            CollegeID: CollegeID,
            Course: Course,
            Batch: batch,
            Group: group,
            Department: Department,
            Semester: semester
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("load_study_scheme").innerHTML = response;
        }
    });
    
}

function emp_detail_verify2(ii)
{
    // alert(Batch);
    var id = document.getElementById('employeeIDOnkeyUp'+ii).value;
     
           var code=186;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                  
                 document.getElementById("emp_detail_status_2"+ii).innerHTML=response;
              }
           });
}


function submitSubjectAllotment(SrNo,CollegeID,Course,Batch,Semester,Department,SubjectCode) 
{
    var code = 386;
    var id = document.getElementById('employeeIDOnkeyUp'+SrNo).value;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            SrNo: SrNo,CollegeID:CollegeID,Course:Course,Batch:Batch,Semester:Semester,Department:Department,SubjectCode:SubjectCode,id:id
        },
        success: function(response) {

            spinner.style.display = 'none';
            if(response==1)
            {
                SuccessToast('Assigned Success to '+id);
                searchShowAllSubject();

            }
            else{
                ErrorToast('Try ','bg-danger');
            }
            // document.getElementById("dddd").innerHTML = response;
        }
    });
}
function submitSubjectDeAllotment(IDT) 
{
    var code = 387;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            IDT:IDT
        },
        success: function(response) {

            spinner.style.display = 'none';
            if(response==1)
            {
                SuccessToast('De Assigned Success ');
                searchShowAllSubject();

            }
            else{
                ErrorToast('Try ','bg-danger');
            }
            // document.getElementById("dddd").innerHTML = response;
        }
    });
}

function fetchcourse() {
    var College = document.getElementById('College').value;
    var department = document.getElementById('Department').value;

    var code = '305';
    $.ajax({
        url: 'action.php',
        data: {
            department: department,
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

function onchange_sem() {
    var code = '251';
    var CourseID = $("#Course").val();
    var CollegeID = $("#College").val();
    // alert('g');
    $.ajax({
        url: 'action.php',
        data: {
            CourseID: CourseID,
            CollegeID: CollegeID,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {
                $("#from_semester").html("");
                $("#from_semester").html(data);
            }
        }
    });
}

function onchange_batch() {
    var code = '252';
    var CourseID = $("#Course").val();
    var CollegeID = $("#College").val();
    var from_semester = $("#from_semester").val();
    // alert('g');
    $.ajax({
        url: 'action.php',
        data: {
            CourseID: CourseID,
            CollegeID: CollegeID,
            from_semester: from_semester,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {
                $("#from_batch").html("");
                $("#from_batch").html(data);
            }
        }
    });
}
</script>
</br>
<div>




    <?php 


    include "footer.php";  ?>