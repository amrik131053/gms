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
                        <span class="mr-2"> <button class="btn btn-info btn-sm "><span class="badge" id="currentExamination">Examination</span> </button> </span>
                        <span class="mr-2"> <button class="btn btn-primary btn-sm "><span class="badge" id="pendingCount"></span>Pending </button> </span>
                        <span class="mr-2"> <button class="btn btn-danger btn-sm "><span class="badge" id="rejectCount"></span>Rejeted </button> </span>
                        <span> <button class="btn btn-success btn-sm "><span class="badge" id="verifiedCount"> </span>Accepted</button> </span>
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

                            <!-- <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Batch</label>
                                <select name="batch" class="form-control" id="Batch" >
                                    <option value="">Select</option>
                                    <?php 
                                    for($i=2013;$i<=2030;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                                ?>

                                </select>

                            </div> -->

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



                            <!-- <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Group</label>
                                <select id="Group" class="form-control" >
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

                            </div> -->
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
                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Status</label>
                                <select id="Status" class="form-control form-control-sm" >
                                    <option value="">All</option>
                                    <option value="4">Pending</option>
                                    <option value="5">Verified</option>
                                    <option value="6">Rejected</option>
                                </select>

                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <label>Action</label><br>
                                <button class="btn btn-danger btn-sm " onclick="fetchCutList();"><i class="fa fa-search" aria-hidden="true"></i></button>&nbsp;&nbsp;
                                <button class="btn btn-success btn-sm " onclick="exportExamForm()"><i
                                                    class="fa fa-file-excel"></i></button>&nbsp;&nbsp;
                                <!-- <button class="btn btn-danger " onclick="exportCutListPdf()"><i
                                class="fa fa-file-pdf"></i></button> -->
                               
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-13">
                                <label>&nbsp;</label><br>
                                
                            </div>


                        </div>
                        <div class="table table-responsive" id="show_record"></div>

                        
                    </div>
                    <div class="row ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <span class="mr-2"><i class="fa fa-stop text-primary" aria-hidden="true"></i> Pending</span>
                        <span class="mr-2"><i class="fa fa-stop text-danger" aria-hidden="true"></i> Rejected</span>
    <span ><i class="fa fa-stop text-success" aria-hidden="true"></i> Verified</span>
</div>&nbsp;

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



function verifyAll()
{
  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=326;
  var subjectIDs=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            subjectIDs.push(verifiy[i].value);
          }
     }
  if((typeof  subjectIDs[0]== 'undefined'))
  {
    // alert('');
    ErrorToast(' Select atleast one Student' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{subjectIDs:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully Verified');
            //    search_study_scheme();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
}



function verifiy_select()
{
        if(document.getElementById("select_all1").checked)
        {
            $('.v_check').each(function()
            {
                this.checked = true;
            });
        } 
        else 
        {
             $('.v_check').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.v_check').on('click',function()
    {
        var a=document.getElementsByClassName("v_check:checked").length;
        var b=document.getElementsByClassName("v_check").length;
        
        if(a == b)
        {

            $('#select_all1').prop('checked',true);
        }
        else
        {
            $('#select_all1').prop('checked',false);
        }
    });
 
}

function fetchCutList() {
    var sub_data = 2;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Examination = document.getElementById('Examination').value;
    var Status = document.getElementById('Status').value;
    if (College != '') {
    // alert(Status);
    var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '325';
        $.ajax({
            url: 'action_g.php',
            data: {
                code: code,
                College: College,
                Course: Course,
                Semester: Semester,
                Type: Type,
                Status: Status,
                Examination: Examination,sub_data:sub_data
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                document.getElementById("show_record").innerHTML = data;
                pendingCount();
rejectCount();
verifiedCount();
setcurrentExamination();
                

            }
        });
    } else {
        ErrorToast('Please Select College', 'bg-warning');
    }
  
}

function searchStudentOnRollNo() {
    var sub_data = 1;
    var rollNo = document.getElementById('rollNo').value;
    var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '290';
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
function edit_stu(id) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 327;
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


function exportExamForm() {
    var exportCode = 48;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Examination = document.getElementById('Examination').value;
    var Status = document.getElementById('Status').value;
   
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
             "&Semester=" + Semester + "&Type=" +
            Type + "&Status=" + Status + "&Examination=" + Examination, '_blank');

   
}


function verify(ExamFromID)
 {
    // var r = confirm("Do you really want to Verifiy");
    // if (r == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 328;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                ExamFromID: ExamFromID
            },
            success: function(response) {
                // console.log(response);
                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('Successfully Verify');
                    edit_stu(ExamFromID);
                    fetchCutList();
                    $('.bd-example-modal-xl').modal('hide');
                  
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });
  //  }
}
function reject(ExamFromID) {
   
    var remark = document.getElementById("remarkReject").value;
    let length = remark.length;
    if(remark!='' && length>5)
    {
        // var r = confirm("Do you really want to reject?");
        // if (r === true) {
            
            var spinner = document.getElementById("ajax-loader");
            spinner.style.display = 'block';
            var code = 329;
            $.ajax({
                url: 'action_g.php',
                type: 'POST',
                data: {
                    code: code,
                    remark: remark,
                    ExamFromID: ExamFromID
                },
                success: function(response) {
                    spinner.style.display = 'none';
                    //console.log(response);
                    if (response == 1) {

                        SuccessToast('Successfully rejected');
                        edit_stu(ExamFromID);
                        fetchCutList();
                        $('.bd-example-modal-xl').modal('hide');
                    } else {
                        ErrorToast('Try Again', 'bg-danger');
                    }
                }
            });
        //}
    }else{
        $('#remarkReject').toggleClass("is-invalid");
        $('#error-reject-textarea').show();
    }
   
}



function examAccountCount() {  // for count show
    var code = 324;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    var Status = document.getElementById('Status').value;
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
                Status: Status,
                Examination: Examination
            },
            success: function(response) {
                // console.log(response);
                var data = JSON.parse(response);
          
                document.getElementById("pendingCount").textContent = data[0];
                document.getElementById("rejectCount").textContent = data[1];
                document.getElementById("verifiedCount").textContent = data[2];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
}









pendingCount();
rejectCount();
verifiedCount();
setcurrentExamination();
function pendingCount()
 {
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Examination = document.getElementById('Examination').value;
    var Status = document.getElementById('Status').value;
        var code = 324;
        // alert(code);
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                College: College,
                Course: Course,
                Semester: Semester,
                Type: Type,
                Status: Status,
                Examination: Examination
            },
            success: function(response) {
                // console.log(response);
                document.getElementById("pendingCount").innerHTML = response;

            }
        });
    }
function rejectCount()
 {
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Examination = document.getElementById('Examination').value;
    var Status = document.getElementById('Status').value;
        var code = 330;
        // alert(code);
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                College: College,
                Course: Course,
                Semester: Semester,
                Type: Type,
                Status: Status,
                Examination: Examination
            },
            success: function(response) {
                // console.log(response);
                document.getElementById("rejectCount").innerHTML = response;

            }
        });
    }
function verifiedCount()
 {
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Examination = document.getElementById('Examination').value;
    var Status = document.getElementById('Status').value;
        var code = 331;
        // alert(code);
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                College: College,
                Course: Course,
                Semester: Semester,
                Type: Type,
                Status: Status,
                Examination: Examination
            },
            success: function(response) {
                // console.log(response);
                document.getElementById("verifiedCount").innerHTML = response;

            }
        });
    }
function setcurrentExamination()
 {
   
    var Examination = document.getElementById('Examination').value;
        var code = 332;
        // alert(code);
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                Examination: Examination
            },
            success: function(response) {
                // console.log(response);
                document.getElementById("currentExamination").innerHTML = response;

            }
        });
    }

</script>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registration Form</h5>
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
<?php

 include "footer.php";  ?>