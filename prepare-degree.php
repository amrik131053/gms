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
                            
                            <div class="col-lg-2">
                            <label >Roll No.</label>
                                <input type="text" class="form-control form-control-sm" name="IDNo" id="rollno" placeholder="RollNo">
                            </div>

                            <div class="col-lg-1">
                                <label >&nbsp;&nbsp;</label><br>    
                                <button type="button" class="btn btn-info btn-xs" onclick="search_exam_form()"> <i
                                        class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <div class="col-lg-2">
                            <label >Course</label>
                                <input type="text" class="form-control form-control-sm" name="CourseD" id="CourseD" placeholder="Course">
                            </div>
                            <div class="col-lg-0">
                            <label>QR Course</label>
                                <input type="text" class="form-control form-control-sm" name="QR Course" id="QRCourse" placeholder="QR Course">
                            </div>
                            <div class="col-lg-1">
                            <label>Type</label>
                                <input type="text" class="form-control form-control-sm" name="DType" id="DType" placeholder="Type">
                            </div>
                            <div class="col-lg-1">
                            <label>Stream</label>
                                <input type="text" class="form-control form-control-sm" name="Stream" id="Stream" placeholder="Stream">
                            </div>
                            <div class="col-lg-1">
                            <label>YOA</label>
                                <input type="text" class="form-control form-control-sm" name="DType" id="YearOfAdmission" placeholder="Year Of Admission">
                            </div>
                            <div class="col-lg-1">
                            <label>&nbsp;&nbsp;</label><br>
                                <button type="button" class="btn btn-primary btn-sm" onclick="setSessionData()" >Set Session</button>
                            </div>  

                            <div class="col-lg-1">
                               <label>&nbsp;&nbsp;</label><br>
                                <button type="button" class="btn btn-warning btn-sm" onclick="clearSessionData()">Clear  </button>
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
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <label>Passing Examination</label>
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

                            <div class="col-lg-1 col-md-3 col-sm-13">
                                <label class="" style="font-size:14px;">Action</label><br>
                                <button class="btn btn-danger btn-sm " onclick="Search_exam_selection()"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Degree Generate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_stu">
                ...
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-danger " onclick="reject_degree();">Reject<i class="fa fa-view" aria-hidden="true"></i></button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" onclick="Verify_digree();">Generate<i class="fa fa-view" aria-hidden="true"></i></button><br><br>
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
    var code =31;
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,
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



function edit_stu(id,resultStatus,MinDeclareType) {
    // alert(resultStatus);
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 32;
    $.ajax({
        url: 'action_j.php',
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




function Search_exam_selection() {
    var code = 31;
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
        $.ajax({
            url: 'action_j.php',
            type: 'POST',
            data: {
                flag: code,
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
                // console.log(response);
                document.getElementById("live_data_Exam_student").innerHTML = response;

            }
        });
    }
    else{
        ErrorToast('please select all inputs','bg-danger');
    }
}

function Show_result() {
    var getsgpa = document.getElementsByClassName('v_check');
    var getcredit = document.getElementsByClassName('c_check');
 var CourseD = document.getElementById("CourseD").value;
    var QRCourse = document.getElementById("QRCourse").value;
    var DType = document.getElementById("DType").value;
    var Stream = document.getElementById("Stream").value;
    var YearOfAdmission = document.getElementById("YearOfAdmission").value;


    var len_sgpa = getsgpa.length;
    var sgpa = [];
       var credit = [];
    for (i = 0; i < len_sgpa; i++) {
        if (getsgpa[i].checked === true) {
            sgpa.push(getsgpa[i].value);
             credit.push(getcredit[i].value);
        }
    }
    if ((typeof sgpa[0] == 'undefined')) {
        ErrorToast(' Select atleast one sgpa', 'bg-warning');
    }
     else 
     { 
    const overall = calculateOverallSGPA(sgpa, credit);    
     document.getElementById("showTotalSGPA").innerHTML = overall;
      document.getElementById("DTypeshow").innerHTML = DType;
       document.getElementById("Streamshoe").innerHTML = Stream;
         document.getElementById("showCourse").innerHTML = CourseD;
     document.getElementById("post_sgpa").value = overall;


    }
}
function calculateOverallSGPA(sgpaArr, creditArr) {
  if (sgpaArr.length !== creditArr.length) {
    throw new Error("SGPA and Credit arrays must be the same length.");
  }
  let totalWeightedSGPA = 0;
  let totalCredits = 0;
  for (let i = 0; i < sgpaArr.length; i++) {
    const sgpaVal = parseFloat(sgpaArr[i]);
    const creditVal = parseInt(creditArr[i]);
    totalWeightedSGPA += sgpaVal * creditVal;
    totalCredits += creditVal;
  }
  const overallSGPA = totalWeightedSGPA / totalCredits;
  return overallSGPA.toFixed(2); // Rounded to 2 decimal places
}

function edit_stu(id,resultStatus,MinDeclareType) {
    // alert(resultStatus);
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 32;
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag:code,
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


function reject_degree() {
    var code = 33.1;

   
     var eid = document.getElementById("eid").value;

   
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,eid:eid
           
        },
        success: function(response) {
            
            Search_exam_selection();
            SuccessToast('Successfully Verified');
        }
    });
}

function Verify_digree() {
    var code = 33;

    var IDNo = document.getElementById("post_idno").value;
    var UniRollNo = document.getElementById("post_unino").value;
    var Name = document.getElementById("post_name").value;
    var Fname = document.getElementById("post_fname").value;
    var Mname = document.getElementById("post_mname").value;
    var College = document.getElementById("post_college").value;
    var Course = document.getElementById("post_course").value;
 
    var Examination = document.getElementById("post_examination").value;
    var SGPA = document.getElementById("post_sgpa").value;
    var CourseD = document.getElementById("CourseD").value;
    var QRCourse = document.getElementById("QRCourse").value;
    var post_collgeId = document.getElementById("post_collgeId").value;
    var post_courseid = document.getElementById("post_courseid").value;

     var eid = document.getElementById("eid").value;

    var Batch = document.getElementById("Batch").value;

     var DType = document.getElementById("DType").value;
    var Stream = document.getElementById("Stream").value;


    var YearOfAdmission = document.getElementById("YearOfAdmission").value;

if(SGPA!='')
{
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,
            IDNo: IDNo,
            UniRollNo: UniRollNo,
            Name: Name,
            Fname: Fname,
            Mname: Mname,
            College: College,eid:eid,
            Course: Course,
            Batch :Batch,
            Examination: Examination,
            SGPA: SGPA,
            CourseD: CourseD,
            QRCourse: QRCourse,
            DType: DType,
            Stream: Stream,
            YearOfAdmission: YearOfAdmission,CollegeID:post_collgeId,CourseID:post_courseid
        },
        success: function(response) {
            console.log(response);
            Search_exam_selection();
            SuccessToast('Successfully Verified');
        }
    });
}
else
{
   ErrorToast('Calculate CGPA', 'bg-warning');  
}
}
getSessionData();
function setSessionData() {
      sessionStorage.setItem("CourseD",document.getElementById('CourseD').value);
      sessionStorage.setItem("QRCourse",document.getElementById('QRCourse').value);
      sessionStorage.setItem("DType",document.getElementById('DType').value);
      sessionStorage.setItem("Stream",document.getElementById('Stream').value);
      sessionStorage.setItem("YearOfAdmission",document.getElementById('YearOfAdmission').value);
    }

    function getSessionData() {
      var CourseD = sessionStorage.getItem("CourseD");
      var QRCourse = sessionStorage.getItem("QRCourse");
      var DType = sessionStorage.getItem("DType");
      var Stream = sessionStorage.getItem("Stream");

      let storedUser1 = sessionStorage.getItem("CourseD");
       let storedUser2 = sessionStorage.getItem("QRCourse");
        let storedUser3 = sessionStorage.getItem("DType");
         let storedUser4 = sessionStorage.getItem("Stream");
                  let storedUser5 = sessionStorage.getItem("YearOfAdmission");

                  document.getElementById('CourseD').value=storedUser1;
document.getElementById('QRCourse').value=storedUser2;
document.getElementById('DType').value=storedUser3;
document.getElementById('Stream').value=storedUser4;
document.getElementById('YearOfAdmission').value=storedUser5;

    }

    // Function to clear session data
    function clearSessionData() {
    sessionStorage.removeItem("CourseD");
    sessionStorage.removeItem("QRCourse");
    sessionStorage.removeItem("DType");
    sessionStorage.removeItem("Stream");
    sessionStorage.removeItem("YearOfAdmission");
    alert("Are you Sure Clear Session")
    location.reload();
}




</script>
