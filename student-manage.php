<?php  
   include "header.php";   
   ?>
   <style>
    .border-dark-green {
        border: 2px solid #006400; /* Dark green color */
    }
</style>
<script type="text/javascript">
function uploadPhotoStudent(form) {
    var formData = new FormData(form);
    // var formData = new FormData(document.getElementById("my-awesome-dropzone"));
    var empID = form.loginId.value;
    // alert(formData);
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
                updateStudent(empID)
                search_all_employee();
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

function passwordreset(id) {

    if (confirm("Really want to Reset Password") == true) {


        var code = 231;
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        $.ajax({
            url: "action.php ",
            type: "POST",
            data: {
                code: code,
                id: id
            },
            success: function(response) {

                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('Password Reset to 12345678');

                } else {
                    ErrorToast('Something went worng', 'bg-danger');
                }
                student_search();
            }
        });
    } else

    {

    }

}

function abcidreset(id) {
    if (confirm("Really want to Reset ABCID") == true) {

        var code = 232;
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        $.ajax({
            url: "action.php ",
            type: "POST",
            data: {
                code: code,
                id: id
            },
            success: function(response) {

                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('ABCID Cleared');

                } else {
                    ErrorToast('Something went worng', 'bg-danger');
                }
                student_search();
            }
        });
    }


}

function UpdateDocumentStatus(id, srno, idno) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 350;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            idno: idno,
            srno: srno,
            id: id,
        },
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            if (response == 1) {
                SuccessToast('Successfully Updated');

            } else {
                ErrorToast('Something went worng', 'bg-danger');
            }


        }
    });
}

function view_image(id) {
    // alert(id);
    var code = 91;
    $.ajax({
        url: 'action_g.php',
        type: 'post',
        data: {
            uni: id,
            code: code
        },
        success: function(response) {
            //    console.log(response);
            document.getElementById("image_view").innerHTML = response;
        }
    });
}

function uploadImage(form, id) {
    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log(response);
            SuccessToast('Successfully Uploaded');
            view_image(id);
            search_all_employee();
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function search_all_employee_emp_name(emp_name) {
    var code_access = '<?php echo $code_access; ?>';
    if (emp_name != '') {
        var code = 266;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                code_access: code_access,
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


    var code_access = '<?php echo $code_access; ?>';
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
                code_access: code_access,
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
    var Session = document.getElementById('session1').value;
    // var session2 = document.getElementById('session2').value;
    // var session3 = document.getElementById('session3').value;
    // if (session1 != '' && session2 != '' && session3!='') {


    //     var Session = session1 + '-' + session2 + '-' + session3;
    // } 
    //     else if(session1 != '' && session2 != '')
    //     {
    //  var Session = session1 + '-' + session2 ;
    //     }
    // else
    //      {
    //         var Session = "";
    //     }
    var StudentName = document.getElementById('StudentName1').value;
    var CollegeName = document.getElementById('CollegeName1').value;
    var Course = document.getElementById('Course1').value;
    var Batch = document.getElementById('Batch').value;
    var Status = document.getElementById('Status').value;
    var Eligibility = document.getElementById('Eligibility').value;
    var admissiontype = document.getElementById('admissiontype').value;
    var Lateral = document.getElementById('Lateral').value;
    if (CollegeName != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 270;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                Session: Session,
                CollegeName: CollegeName,
                Course: Course,
                Batch: Batch,
                Eligibility: Eligibility,
                LateralEntry: Lateral,
                StudentName: StudentName,
                Status: Status,admissiontype:admissiontype
            },
            success: function(response) {
                //console.log(response);
                spinner.style.display = 'none';
                document.getElementById("show_record1").innerHTML = response;
                document.getElementById('show_record').innerHTML = "";

            }
        });
    } 
    else {
        ErrorToast("Select College", "bg-warning");
    }
}
function provisinalRemarks(val)
{
    if(val!='1')
{
    $('#remarksProvisional').show();
}
else{
    $('#remarksProvisional').hide();

}
}
function updateStudent(empID) {
// alert(empID);
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code_access = '<?php echo $code_access; ?>';

    syncdocuments(empID);
    var code = 267;
    $.ajax({ 
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            code_access: code_access,
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
                //console.log(data);
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
    //alert(country_id);
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
    var code = '161.1';
    alert(state_id);
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


function Studentsignup(id, college) {

    var code = 308;

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,
            id: id,
            college: college
        },
        success: function(response) {
            //console.log(response);
            spinner.style.display = 'none';
            student_search();
        }
    });
}



function showDivName() {
    var displayDiv = document.getElementById('unhide');
    var button = document.getElementById('expand');
    var studentNameInput = document.getElementById('StudentName1');

    var displayValue = (displayDiv.style.display === "block") ? "none" : "block";
    button.innerHTML = (displayValue === "block") ? "Search without name" : "Search by name";

    if (displayValue === "none") {
        studentNameInput.value = "";
    }

    displayDiv.style.display = displayValue;
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
        window.open("print-admission-from.php?code=" + code + "&IDNo=" + id, '_blank');
    } else {
        alert("Select ");
    }

}

function printSmartCardForStudent(id) {
    var code = 248;
    var print = 0;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            // console.log(response);
            if (response == '1') {
                window.open("newidcardstudent.php?id=" + id + "&code=" + 1 + "&print=" + 0, '_blank');
                searchStudentForIDcard();
            } else {
                ErrorToast(response, 'bg-warning');
            }

        }
    });
}
function printladger(id) {
                window.open("ledger-print.php?IDNo=" + id, '_blank');
                searchStudentForIDcard();
}


function reprintSmartCardForStudent(id) {
    var code = 248;
    var print = 1;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            // console.log(response);
            if (response == 1) {
                // window.open("printSmartCardStudent.php?id=" + id + "&code=" + 1 + "&print=" + 1, '_blank');
                window.open("newidcardstudent.php?id=" + id + "&code=" + 1 + "&print=" + 1, '_blank');
                searchStudentForIDcard();
            } else {
                ErrorToast(response, 'bg-warning');
            }

        }
    });
}

function StudentUpdatedata(id) {

    var code = 219;

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,
            IDNo: id
        },
        success: function(response) {

            spinner.style.display = 'none';

            document.getElementById("student_search_recordold").innerHTML = '';
            document.getElementById("student_record_for_update").innerHTML = response;
        }
    });
}


 function daily_data() {

    var code = 396.3;
    StartDate=document.getElementById("StartDate").value;
    EndDate=document.getElementById("EndDate").value;
    var spinner = document.getElementById("ajax-loader");
  


    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,StartDate:StartDate,EndDate:EndDate
                },
        success: function(response) {

            spinner.style.display = 'none';

            document.getElementById("show_record1").innerHTML = response;
        }
    });
}
function daily_data_summary() {

    var code = 396.4;
    StartDate=document.getElementById("StartDate").value;
    EndDate=document.getElementById("EndDate").value;
    var spinner = document.getElementById("ajax-loader");

   

    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,StartDate:StartDate,EndDate:EndDate
                },
        success: function(response) {

            spinner.style.display = 'none';

            document.getElementById("show_record1").innerHTML = response;
        }
    });
}

  function showCoursefromadmissions(CollegeID) {


       var code = 396.5;
    StartDate=document.getElementById("StartDate").value;
    EndDate=document.getElementById("EndDate").value;

               $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,CollegeID: CollegeID,StartDate:StartDate,EndDate:EndDate
            },
            success: function(response) {
               
              //spinner.style.display = 'none';

                if (CollegeID !== null) {
                    document.getElementById("showBatchs" + CollegeID).innerHTML = response;
                }

                //  loadMainCount();
            }
        });
    }

function changecourse(id) {

    var code = 322;

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,
            IDNo: id
        },
        success: function(response) {

            spinner.style.display = 'none';

            document.getElementById("student_record_for_update").innerHTML = response;
        }
    });
}

function updateStudentdata(id) {


    var batch = document.getElementById('ubatch').value;
    var eligible = document.getElementById('eligible').value;
    var status = document.getElementById('ustatus').value;
    var lock = document.getElementById('ulocked').value;
    var classroll = document.getElementById('classroll').value;
    var uniroll = document.getElementById('uniroll').value;
    var uniroll = document.getElementById('uniroll').value;
    var uniroll = document.getElementById('uniroll').value;

    var Collegechange = document.getElementById('Collegechange').value;
    var coursechange = document.getElementById('coursechange').value;


    var code = 220;

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,
            batch: batch,
            status: status,
            lock: lock,
            id: id,
            classroll: classroll,
            uniroll: uniroll,
            eligible: eligible,
            coursechange: coursechange,
            Collegechange: Collegechange

        },
        success: function(response) {
            //  console.log(response);
            spinner.style.display = 'none';
            if (response == 1) {
                SuccessToast('Successfully Updated');

            } else {
                ErrorToast('Something went worng', 'bg-danger');
            }

        }
    });
}


function fetchcourse(id) {


    var code = '325';
    $.ajax({
        url: 'action.php',
        data: {
            College: id,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {

                $("#coursechange").html("");
                $("#coursechange").html(data);
            }
        }
    });

}

function student_search1() {

    var code = 323;
    var code_access = '<?php echo $code_access; ?>';
    var rollNo = document.getElementById("student_roll_no1").value;
    var option = 1;

    //   alert(rollNo);

    if (rollNo != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        $.ajax({
            url: "action.php ",
            type: "POST",
            data: {
                code: code,
                rollNo: rollNo,
                option: option,
                code_access: code_access
            },
            success: function(response) {
                //   console.log(response);
                spinner.style.display = 'none';
                document.getElementById("student_search_recordold").innerHTML = response;
            }
        });
    } else {
        // alert("Please Enter the Roll No.");
        document.getElementById("student_search_recordold").innerHTML = 'Enter Roll No';
    }
}

function movefee(nid) {
    var code = 324;

    var oldid = document.getElementById("oldid").value;



    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,
            oldid: oldid,
            nid: nid
        },
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            SuccessToast('Successfully Moved');

        }
    });




}

function changecourse(id) {

    var code = 322;

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,
            IDNo: id
        },
        success: function(response) {

            spinner.style.display = 'none';

            document.getElementById("student_record_for_update").innerHTML = response;
        }
    });
}



function syncdocuments(idno) {




    var code = 304;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            idno: idno
        },
        success: function(response) {

            console.log(response);


        }
    });



}


function generateSmartCardForStudent(id) {
    //alert(id);
    var code = 351;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            //console.log(response);
            if (response == '1') {

                SuccessToast('Successfuly Generated');

            } else {
                ErrorToast(response, 'bg-warning');
            }

        }
    });
}
function basicLock() {
    if (confirm("Really want to Lock basic details") == true) {


var StudentName=document.getElementById("StudentName").value;
var fatherName=document.getElementById("fatherName").value;
var motherName=document.getElementById("motherName").value;
var dob=document.getElementById("dob").value;
var gender=document.getElementById("gender").value;
var aadharNo=document.getElementById("aadharNo").value;
var loginId=document.getElementById("loginId").value;
    var code = 467;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,StudentName:StudentName,fatherName:fatherName,motherName:motherName,dob:dob,gender:gender,aadharNo:aadharNo,loginId:loginId
        },
        success: function(response) {
            console.log(response);
            if (response ==1) {

                SuccessToast('Successfuly Locked');
                updateStudent(loginId);
            } else 
            {
                ErrorToast('Try Again','bg-warning');
            }

        }
    });
}
}
function basicUnLock(loginId) {
    if (confirm("Really want to Un-Lock basic details") == true) {

    var code = 468;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,loginId:loginId
        },
        success: function(response) {
            console.log(response);
            if (response==1) {

                SuccessToast('Successfuly UnLocked');
                updateStudent(loginId);
            } else 
            {
                ErrorToast('Try Again','bg-warning');
            }

        }
    });
}
}


function exportLockedBasicExcel() {
    var exportCode = 81;
   var  CollegeName1=document.getElementById('CollegeName1').value;
   var Course1=document.getElementById('Course1').value;
   var Batch=document.getElementById('Batch').value;
   var session1=document.getElementById('session1').value;
   var Lateral=document.getElementById('Lateral').value;
   var Status=document.getElementById('Status').value;
   var Eligibility=document.getElementById('Eligibility').value;
  
    if (CollegeName1 != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeName1=" + CollegeName1
         + "&Course1=" + Course1 +
            "&Batch=" + Batch + "&session1=" + session1 + "&Lateral=" +
            Lateral + "&Status=" + Status + "&Eligibility=" + Eligibility, '_blank');

    } else {
        alert("Select ");
    }
}






function copyToClipboard(text) {
    const el = document.createElement('textarea');
    el.value = text;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
    // alert('Password copied to clipboard');
}
</script>
<div class="modal fade" id="Updatestudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='student_record_for_update' style="text-align:center">

            </div>
            <div class="card-body" id="student_search_recordold" style="font-size:12px;">


            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="image_view">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary"></button> -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="UpdateDesignationModalCenter21" tabindex="-1" role="dialog"
    aria-labelledby="UpdateDesignationModalCenter21" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='updateRecord'>
            </div>




        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Student </h3>
                    <div class="card-tools">
                        <button id="expand" class="btn btn-success btn-xs" name="expand" onclick="showDivName();">Search
                            by name</button>
                    </div>
                </div>
                <div class="card-body p-2">
                    <form action="export.php" method="post">
                        <input type="hidden" value="39" name="exportCode">
                        <div class="col-lg-12" id="unhide" style="display:none;">
                            <label>Name</label>
                            <input type="text" class="form-control" name="StudentName1" id="StudentName1"
                                placeholder="Enter Student Name like..">
                        </div>
                        <div class="col-lg-12">

                            <label>College Name</label>
                            <select name="CollegeName" id='CollegeName1' onchange="fetchcourse1(this.value);"
                                class="form-control" required>
                                <option value=''>Select Faculty</option>
                                <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where UserAccessLevel.IDNo='$EmployeeID' ";
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
                            <label>Course</label>
                            <select id="Course1" name="Course1" class="form-control">
                                <option value=''>Select Course</option>
                            </select>
                        </div>


                        <div class="col-lg-12 col-12">

                            <label>Batch</label>

                            <select id="Batch" name="Batch" class="form-control">
                                <option value="">Batch</option>
                                <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php }
                                  ?>
                            </select>

                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Session</label>

                                    <select id="session1" name="session1" class="form-control">
                                        <option value=''>Select Session </option>
                                        <?php         

 $sql="SELECT DISTINCT Session from Admissions ORDER By Session Desc";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $session = $row['Session']; 
                        
                        ?>
                                        <option value="<?=$session;?>"><?=$session;?></option>
                                        <?php }
                        ?>


                                    </select>

                                </div>
                                <div class="col-lg-6">
                                    <label>Lateral</label>

                                    <select id="Lateral" name="Lateral" class="form-control">

                                        <option value='No'>No </option>
                                        <option value='Yes'>Yes </option>


                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Status </label>
                                <!-- <input type="text" class="form-control" name="employmentStatus" placeholder="Enter employment status"> -->
                                <select class="form-control" id="Status" name="Status">

                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">DeActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Eligibility </label>
                                <!-- <input type="text" class="form-control" name="employmentStatus" placeholder="Enter employment status"> -->
                                <select class="form-control" id="Eligibility" name="Eligibility">

                                    <option value="">Select</option>
                                    <option value="0">Not Eligible</option>
                                    <option value="1">Eligible</option>
                                </select>
                            </div>
                        </div>

                           <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Admission Type </label>
                                <!-- <input type="text" class="form-control" name="employmentStatus" placeholder="Enter employment status"> -->
                                <select class="form-control" id="admissiontype" name="admissiontype">

                                   <option value="">Normal</option>
              <option value="1">Pre Requisite</option>
              <option value="2">Foundation</option>
              <option value="3">Migration</option>


                                </select>

                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <br>
                                <button type="button" class="btn btn-success"
                                    onclick="searchStudentCollegeWise();">Search</button>


                                <button type="submit" class="btn btn-success  float-right">

                                    <i class="fa fa-file-excel">&nbsp;&nbsp;Download</i>

                        


                                </button>
                      </br></br>
                                <?php if($role_id==2 || $role_id==15)
                                            {?>
                                <button type="button" onclick="exportLockedBasicExcel()" class="btn btn-success btn-sm">

                                    <i class="fa fa-file-excel">&nbsp;&nbsp;Download Basic Locked</i>

                                </button>
                                <?php }?>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
            <div class="card ">

                <div class="card-header">

                    <div class="row">
                        <div class="col-lg-5">
                           
                            <form action="export.php" method="post" target="_blank">
                                <input type="hidden" value="73" name="exportCode">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger" id="inputGroup-sizing-sm">Start</span>
                                    </div>
                          <input required type="date" class="form-control" id="StartDate" name="StartDate"
                                        aria-describedby="button-addon2">
                                    &nbsp;
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success" id="inputGroup-sizing-sm">End</span>
                                    </div>
                                    <input required type="date" class="form-control" id="EndDate" name="EndDate"
                                        aria-describedby="button-addon2">
                                    <button class="btn btn-info btn-sm" type="submit" id="button-addon2"><i
                                            class="fa fa-file-export"></i></button>
                                </div>
                            </form>
                            
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-success btn-sm" onclick="daily_data();"><i class="fa fa-search"></i></button>
                        </div>
                          <div class="col-lg-1">
                            <button class="btn btn-success btn-sm" onclick="daily_data_summary();"><i class="fa fa-users"></i></button>
                        </div>
                        <div class="col-lg-5">
                            <span style="float:right;">
                                <button class="btn btn-sm ">
                                    <input type="search" class="form-control form-control-sm" name="emp_name"
                                        id="emp_name" placeholder="Search here">
                                </button>
                                <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
                                    Search
                                </button>
                            </span>
                        </div>
                    </div>

                    <input type="hidden" id="CollegeID_Set">
                </div>

           
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
            </div>
            <!-- </form> -->

            <!-- /.card-header -->


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