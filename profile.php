<?php 
include "header.php";

?>

<style>
    
/* .blink {
    animation: blinker 0.5s linear infinite;


} */

@keyframes blinker {
    50% {
        opacity: 0;
    }
}

input[type=radio]+label {
    background-color: #a62535;
    color: white;
}

input[type=radio]:checked+label {
    color: white;
    background-color: #223260;
}
</style>

<section class="content">

    <div id="showData">
    </div>

</section>

<div class="modal fade" id="uploadPasspoerImage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="action_g.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body " >
                        <input type="hidden" name="code" value="440">
                         <label>Latest Passport Size Image</label>
                        <input type="file" class="form-control-file" name="photoIMage">
                        <small style="color: green">*Document must be in .jpg/.jpeg/.png format. &nbsp; *Size must be less than 500kb.</small><br>
                        <strong id="imgerror1" style="color: red"></strong><br>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button  type="button" class="btn btn-success " onclick="uploadImage(this.form);">Upload</button>
                    </div>
                </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-default-Letters">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Letters</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data-letters">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="UploadImageDocument">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="documentData">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ph.D Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-default-upload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Upload Ph.D Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="modal-body" id="phd_upload_data">

            </div> 

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="modal-default-Experience">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Experience Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data-exp">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" id="data">
                <h2>Are you sure to delete.</h2>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="dlt_confirm">YES</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
function loadCourse() {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '442';

    var academicID = $("#Programs").val();
    $.ajax({
        url: 'action_g.php',
        data: {
            courseID: academicID,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            spinner.style.display = 'none';
            if (data != "") {
                $("#course").html("");
                $("#course").html(data);
            }
        }
    });
}


showProfileData(); 

function showProfileData() {

    var spinner = document.getElementById("ajax-loader");
    const loginId = '<?=$EmployeeID;?>';
    // alert(loginId);
    spinner.style.display = 'block';
    var code = 431;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
           
            document.getElementById("showData").innerHTML = response;
            spinner.style.display = 'none';
        }
    });
}

function addExperience(form) {
    var experienceType=form.experienceType.value;
var designation=form.designation.value;
var department=form.department.value;
var from_date=form.from_date.value;
var to_date=form.to_date.value;
var salary=form.salary.value;
var left_reason=form.left_reason.value;
var experiencefile=form.experiencefile.value;
if (experienceType === "") {
        ErrorToast('Please select experience type.', 'bg-warning');
        return false;
    }
if (designation === "") {
        ErrorToast('Please enter designation.', 'bg-warning');
        return false;
    }
if (department === "") {
        ErrorToast('Please enter department.', 'bg-warning');
        return false;
    }
if (from_date === "") {
        ErrorToast('Please select from date.', 'bg-warning');
        return false;
    }
if (to_date === "") {
        ErrorToast('Please select to date.', 'bg-warning');
        return false;
    }
if (salary === "") {
        ErrorToast('Please enter salary.', 'bg-warning');
        return false;
    }
if (left_reason === "") {
        ErrorToast('Please enter left reason.', 'bg-warning');
        return false;
    }
if (experiencefile === "") {
        ErrorToast('Please choose experience file.', 'bg-warning');
        return false;
    }

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Added');

                showProfileData();
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('size must be less than 500kb', 'bg-warning');

            } else if (response == 3) {
                ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');

            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function addAcademic(form) {


    var qualification=form.qualification.value;
var course=form.course.value;
var subjects=form.subjects.value;
var mode=form.mode.value;
var school_clg=form.school_clg.value;
var uni_board=form.uni_board.value;
var passing_date=form.passing_date.value;
var academicfile=form.academicfile.value;
if (qualification === "") {
        ErrorToast('Please select qualification.', 'bg-warning');
        return false;
    }
    if (course === "") {
        ErrorToast('Please enter course.', 'bg-warning');
        return false;
    }
    if (subjects === "") {
        ErrorToast('Please enter subjects.', 'bg-warning');
        return false;
    }
    if (mode === "") {
        ErrorToast('Please select mode.', 'bg-warning');
        return false;
    }
    if (school_clg === "") {
        ErrorToast('Please enter school_clg.', 'bg-warning');
        return false;
    }
    if (uni_board === "") {
        ErrorToast('Please enter uni board.', 'bg-warning');
        return false;
    }
    if (passing_date === "") {
        ErrorToast('Please enter passing date.', 'bg-warning');
        return false;
    }

    if (academicfile === "") {
        ErrorToast('Please choose academic file.', 'bg-warning');
        return false;
    }

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Added');

                showProfileData();
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('size must be less than 500kb', 'bg-warning');

            } else if (response == 3) {
                ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');

            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}
function viewAddtionalDocument(id) {
    var code = 57.2;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}

// viewAdditionalDocument
// deleteaddtional
function viewAdditionalDocument(id) {
    var code = 57.3;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}
function addPhd(form) {

    var subject=form.subject.value;
var topic=form.topic.value;
var university=form.university.value;
var supervisor_name=form.supervisor_name.value;
var supervisor_details=form.supervisor_details.value;
var enrollment_date=form.enrollment_date.value;
var registration_date=form.registration_date.value;
var award_date=form.award_date.value;

    if (subject === "") {
        ErrorToast('Please enter subject.', 'bg-warning');
        return false;
    }
    if (topic === "") {
        ErrorToast('Please enter topic.', 'bg-warning');
        return false;
    }
    if (university === "") {
        ErrorToast('Please enter university.', 'bg-warning');
        return false;
    }
    if (supervisor_name === "") {
        ErrorToast('Please enter supervisor_name.', 'bg-warning');
        return false;
    }
    if (supervisor_details === "") {
        ErrorToast('Please enter supervisor_details.', 'bg-warning');
        return false;
    }
    if (enrollment_date === "") {
        ErrorToast('Please enter enrollment_date.', 'bg-warning');
        return false;
    }
    if (registration_date === "") {
        ErrorToast('Please enter registration_date.', 'bg-warning');
        return false;
    }
    if (award_date === "") {
        ErrorToast('Please enter award_date.', 'bg-warning');
        return false;
    }

    var course_work_details=form.course_work_details.value;
if(course_work_details!='No')
{
    var course_work_university=form.course_work_university.value;
    var total_marks=form.total_marks.value;
    var obtained_marks=form.obtained_marks.value;
    var date_of_passing=form.date_of_passing.value;
    var percentage=form.percentage.value;

    if (course_work_university === "") {
        ErrorToast('Please enter course work university.', 'bg-warning');
        return false;
    }
    if (total_marks === "") {
        ErrorToast('Please enter total marks.', 'bg-warning');
        return false;
    }
    if (obtained_marks === "") {
        ErrorToast('Please enter obtained marks.', 'bg-warning');
        return false;
    }
    if (date_of_passing === "") {
        ErrorToast('Please enter date of passing.', 'bg-warning');
        return false;
    }
}
var ugc_rule=form.ugc_rule.value;
if(ugc_rule!='No')
{
    var compliance_certificate=form.compliance_certificate.value;
    if (compliance_certificate === "") {
        ErrorToast('Please choose compliance certificate.', 'bg-warning');
        return false;
    }

}
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Added');
                showProfileData();
            }  
            else if (response == 2) {
                ErrorToast('Please Upload size must be less than 500kb', 'bg-warning');
            } else if (response == 3) {
                ErrorToast('Please Upload must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
            }
            else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}
function additionalQualification(form) {
    var Exam_passed=form.Exam_passed.value;
    var exam_certificate=form.exam_certificate.value;
    if (exam_certificate === "") {
        ErrorToast('Please choose exam certificate.', 'bg-warning');
        return false;
    }
    if (Exam_passed === "") {
        ErrorToast('Please choose exam passed.', 'bg-warning');
        return false;
    }
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Added');
                showProfileData();
            }  
            else if (response == 2) {
                ErrorToast('Please Upload size must be less than 500kb', 'bg-warning');
                document.getElementById("panerror").innerHTML = 'Please Upload size must be less than 500kb';

            } else if (response == 3) {
                ErrorToast('Please Upload must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                document.getElementById("panerror").innerHTML = 'Please Upload must be in jpg/jpeg/png/pdf format';

            }
            else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}



function uploadPanCard(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Uploaded');

                showProfileData();
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('Please Upload size must be less than 500kb', 'bg-warning');
                document.getElementById("panerror").innerHTML = 'Please Upload size must be less than 500kb';

            } else if (response == 3) {
                ErrorToast('Please Upload must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                document.getElementById("panerror").innerHTML = 'Please Upload must be in jpg/jpeg/png/pdf format';

            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function uploadAdharCard(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Uploaded');

                showProfileData();
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('size must be less than 500kb', 'bg-warning');
                document.getElementById("adharerror").innerHTML = 'Please Upload size must be less than 500kb';
               
            } else if (response == 3) {
                ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                
                document.getElementById("adharerror").innerHTML = 'Please Upload must be in jpg/jpeg/png/pdf format';
            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

 function toggleCourseWorkFields() {
        var courseWorkDetails = document.getElementById("course_work_details").value;
        var courseWorkFields = document.getElementById("courseWorkFields");
        if (courseWorkDetails === "Yes") {
            courseWorkFields.classList.remove("d-none");
        } else {
            courseWorkFields.classList.add("d-none");
        }
    }
    function toggleComplianceCertificateField() {
        var ugcRule = document.getElementById("ugc_rule").value;
        var complianceCertificateField = document.getElementById("complianceCertificateField");
        if (ugcRule === "Yes") {
            complianceCertificateField.classList.remove("d-none");
        } else {
            complianceCertificateField.classList.add("d-none");
        }
    }

function uploadImage(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Uploaded');
                $('#uploadPasspoerImage').modal('hide');
                showProfileData();
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('Please Upload Image size must be less than 500kb', 'bg-warning');
                document.getElementById("imgerror").innerHTML = 'Please Upload Image size must be less than 500kb';
                document.getElementById("imgerror1").innerHTML = 'Please Upload Image size must be less than 500kb';

            } else if (response == 3) {
                ErrorToast('Please Upload must be in jpg/jpeg/png format. ', 'bg-warning');
                document.getElementById("imgerror").innerHTML = 'Please Upload Image must be in jpg/jpeg/png format';
                document.getElementById("imgerror1").innerHTML = 'Please Upload Image must be in jpg/jpeg/png format';
            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function uploadPassBook(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Uploaded');

                showProfileData();
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('Please Upload size must be less than 500kb', 'bg-warning');
                document.getElementById("bnkerror").innerHTML = 'Please Upload size must be less than 500kb';

            } else if (response == 3) {
                ErrorToast('Please Upload must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                document.getElementById("bnkerror").innerHTML = 'Please Upload must be in jpg/jpeg/png/pdf format';
            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function postcode() {
    var pincode = document.getElementById("pincode-input").value;
    var countryDisplay = document.getElementById("nationality");
    var stateDisplay = document.getElementById("state_by_post");
    var districtDisplay = document.getElementById("district_by_post");
    // var dropdown = document.getElementById("village_by_post");

    // Clear previous data
    countryDisplay.value = "";
    stateDisplay.value = "";
    districtDisplay.value = "";
    // dropdown.innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response && response[0] && response[0].PostOffice && response[0].PostOffice.length > 0) {
                var Country = response[0].PostOffice[0].Country;
                var State = response[0].PostOffice[0].State;
                var District = response[0].PostOffice[0].District;

                countryDisplay.value = Country;
                stateDisplay.value = State;
                districtDisplay.value = District;

            }
        }
    };

    var url = "https://api.postalpincode.in/pincode/" + pincode;
    xhr.open("GET", url, true);
    xhr.send();
}

function viewAcademicDocumentExp(id) {
    var code = 58;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data-exp").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}
function viewLetters(id) { 
    var code = 58.1;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data-letters").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}


function view_uploaded_document(id, documentP) {
    var code = 59;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("documentData").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code + "&document=" + documentP, true);
    xmlhttp.send();
}

function academic_detail() {
    var x = document.getElementById("marks_type");
    var y = document.getElementById("qualification");
    var z = document.getElementById("test_section");
    var g = document.getElementById("phd_qualification");
    var p = document.getElementById("additional_qualification");
    if (x.style.display === "none") {
        x.style.display = "block";
        g.style.display = "none";
        p.style.display = "none";
        document.getElementById("add_button").innerHTML = "Remove";
        document.getElementById("phd_button").innerHTML = "PHD";
    } else {
        x.style.display = "none";
        y.style.display = "none";
        g.style.display = "none";
        p.style.display = "none";

        document.getElementById("add_button").innerHTML = "Academics";
        var radio = document.querySelector('input[type=radio][name=marks_type]:checked');
        radio.checked = false;
    }
    if (z) {
        z.style.display = "none";
    }
}
function phd_detail() {
    var g = document.getElementById("marks_type");
    var y = document.getElementById("phd_qualification");
    var z = document.getElementById("qualification");
    var p = document.getElementById("additional_qualification");
    if (y.style.display === "none") {
        y.style.display = "block";
        z.style.display = "none";
        g.style.display = "none";
        p.style.display = "none";
        document.getElementById("phd_button").innerHTML = "Remove";
        document.getElementById("add_button").innerHTML = "Academics";
    } else 
    {
        y.style.display = "none";
        z.style.display = "none";
        g.style.display = "none";
        p.style.display = "none";
        document.getElementById("phd_button").innerHTML = "PHD";
    }
   
}
function Qualifications_detail() {
    var g = document.getElementById("marks_type");
    var y = document.getElementById("phd_qualification");
    var z = document.getElementById("qualification");
    var p = document.getElementById("additional_qualification");
    var pp = document.getElementById("Qualifications_type");
    if (p.style.display === "none") {
        y.style.display = "none";
        p.style.display = "block";
        z.style.display = "none";
        g.style.display = "none";
        document.getElementById("Qualifications_button").innerHTML = "Remove";
        document.getElementById("phd_button").innerHTML = "PHD";
        document.getElementById("add_button").innerHTML = "Academics";
    } else 
    {
        y.style.display = "none";
        z.style.display = "none";
        g.style.display = "none";
        p.style.display = "none";
  
        document.getElementById("Qualifications_button").innerHTML = "Additional Qualifications";
        
    }
   
}

function marks() {
    var x = document.getElementById("qualification");
    x.style.display = "block";

    document.getElementById("cgpa_value").readOnly = true;
    document.getElementById("cgpa_value").value = '';
    document.getElementById("total_marks1").readOnly = false;
    document.getElementById("obtained_marks1").readOnly = false;
    document.getElementById("total_marks1").required = true;
    document.getElementById("obtained_marks1").required = true;
}

function cgpa_detail() {
    var x = document.getElementById("qualification");
    x.style.display = "block";
    document.getElementById("cgpa_value").readOnly = false;
    document.getElementById("total_marks1").readOnly = true;
    document.getElementById("total_marks1").value = '';
    document.getElementById("obtained_marks1").readOnly = true;
    document.getElementById("obtained_marks1").value = '';
    document.getElementById("cgpa_value").required = true;
    document.getElementById('percent1').value = '';
}

function calculate_percentage() {
    var val1 = Number(document.getElementById('obtained_marks1').value);
    var val2 = Number(document.getElementById('total_marks1').value);
    // alert(val1+'>'+val2);
    // console.log(val2);
    if (val1 != '' && val2 != '' && val1 != '0' && val2 != '0') {
        if (val1 > val2) {
            alert('obtained marks can not be greater than total marks');
            document.getElementById('obtained_marks1').value = '';
            document.getElementById('total_marks1').value = '';
            document.getElementById('percent1').value = '';
        } else {
            var result = (val1 / val2) * 100;
            var percent = result.toFixed(2);
            document.getElementById('percent1').value = percent;
        }
    }
}
function calculate_percentage1() {
    var val1 = Number(document.getElementById('obtained_marks').value);
    var val2 = Number(document.getElementById('total_marks').value);
    alert(val1+'>'+val2);
    // console.log(val2);
    if (val1 != '' && val2 != '' && val1 != '0' && val2 != '0') {
        if (val1 > val2) {
            alert('obtained marks can not be greater than total marks');
            document.getElementById('obtained_marks').value = '';
            document.getElementById('total_marks').value = '';
            document.getElementById('percentage1').value = '';
        } else {

            var result = (val1 / val2) * 100;
            var percent1 = result.toFixed(2);
            console.log(percent1);
            document.getElementById('percentage1').value = percent1;
        }
    }
}

function viewAcademicDocument(id) {
    var code = 57;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}
function viewPHDDocument(id) {
    var code = 57.1;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}
 
function UploadPHDDocument(id) {
    var code = 57.4; 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("phd_upload_data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
    
}



function viewTestDocument(id) {
    var code = 1;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get-action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}

function deleteAcademics(id) {
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '432';
        var academicID = id;
        //alert(academicID);
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: academicID,
                code: code
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                console.log(data);
                SuccessToast('Successfully Deleted');

                showProfileData();
                // if (data == 1) {
                //     showProfileData();
                // } 
                //  else {
                //     ErrorToast('try again','bg-danger');
                // }

            }
        });
    } else {

    }
}
function deletePHD(id) {
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '432.1';
        var academicID = id;
        //alert(academicID);
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: academicID,
                code: code
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                console.log(data);
                SuccessToast('Successfully Deleted');

                showProfileData();

            }
        });
    } else {

    }
}

function deleteaddtional(id) {
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '432.4';
        var academicID = id;
        //alert(academicID);
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: academicID,
                code: code
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                console.log(data);
                SuccessToast('Successfully Deleted');

                showProfileData();

            }
        });
    } else {

    }
}


function updateStaffSelf() {

    var loginId = document.getElementById('loginId').value;
    var fatherName = document.getElementById('fatherName').value;
    var motherName = document.getElementById('motherName').value;
    var dob = document.getElementById('dob').value;
    var gender = document.getElementById('gender').value;
    var category = document.getElementById('category').value;
    var panNumber = document.getElementById('panNumber').value;
    var aadharNumber = document.getElementById('aadharNumber').value;
    var personalIdentificationMark = document.getElementById('personalIdentificationMark').value;
    var personalEmail = document.getElementById('personalEmail').value;
    var officialEmail = document.getElementById('officialEmail').value;
    var mobileNumber = document.getElementById('mobileNumber').value;
    var whatsappNumber = document.getElementById('whatsappNumber').value;
    var permanentAddress = document.getElementById('permanentAddress').value;
    var correspondenceAddress = document.getElementById('correspondenceAddress').value;
    var postalCode = document.getElementById('postalCode').value;
    var state_by_post = document.getElementById('state_by_post').value;
    var district_by_post = document.getElementById('district_by_post').value;
    var postOffice = document.getElementById('postOffice').value;
    var bankAccountNo = document.getElementById('bankAccountNo').value;
    var employeeBankName = document.getElementById('employeeBankName').value;
    var bankIFSC = document.getElementById('bankIFSC').value;
    var nationality_by_post = document.getElementById('nationality_by_post').value;
    var bloodgroup = document.getElementById('bloodgroup').value;
    var salary = document.getElementById('salary').value;
    // alert(bankIFSC);
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 437;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            loginId: loginId,
            fatherName: fatherName,
            motherName: motherName,
            dob: dob,
            gender: gender,
            category: category,
            panNumber: panNumber,
            aadharNumber: aadharNumber,
            personalIdentificationMark: personalIdentificationMark,
            personalEmail: personalEmail,
            officialEmail: officialEmail,
            mobileNumber: mobileNumber,
            whatsappNumber: whatsappNumber,
            permanentAddress: permanentAddress,
            correspondenceAddress: correspondenceAddress,
            postalCode: postalCode,
            state_by_post: state_by_post,
            district_by_post: district_by_post,
            postOffice: postOffice,
            bankAccountNo: bankAccountNo,
            employeeBankName: employeeBankName,
            bankIFSC: bankIFSC,
            bloodgroup: bloodgroup,
            salary: salary,
            nationality_by_post: nationality_by_post
        },
        success: function(response) {

            // console.log(response);
            spinner.style.display = 'none';
            if (response == 1) {

                showProfileData();
                SuccessToast('Successfully Updated', 'bg-success');
            } else {
                ErrorToast('Try again', 'bg-warning');
            }
        }
    });
}
</script>

<script>
function dlt_data(id) {
    var code = '435';
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var ID = id;
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: ID,
                code: code
            },
            type: 'POST',
            success: function(data) {
                console.log(data);
                spinner.style.display = 'none';
                // if (data == 1) {
                SuccessToast('Successfully Deleted');
                showProfileData();
                // } else {
                //     ErrorToast('try again','bg-danger');
                // }
            }
        });
    } else {}
}








function printEmpRecordPdf(id) {
   // alert("dssf");
   var code=1;
        if (id!='') 
         {  
          window.open("print-employee-record.php?code="+code+"&id="+id,'_blank');
         }
         else
         {
            alert("Select ");
         }
      
}

function upload_dmc_phd() {
    var form = document.getElementById("uploadPhdForm");
    var courseFileInput = document.getElementById("coursefile");
    var dmcFileInput = document.getElementById("dmcfile");
    if (!courseFileInput.files[0] || !dmcFileInput.files[0]) {
        ErrorToast('Both attachments are required', "bg-danger");
        return;
    }
    var formData = new FormData(form); 
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "action.php", true);
    xhr.onload = function () {
    if (xhr.status === 200) {
        var response = xhr.responseText; 
        SuccessToast('Successfully Uploaded');
    } else {
        ErrorToast('File upload failed. Please try again.', "bg-danger");
    }
};
    xhr.onerror = function () {
        ErrorToast('An error occurred during the file upload.', "bg-danger");
    };
    xhr.send(formData);
}


function uploadmooc(id) {

  var fileInput = document.getElementById("moocfile_"+id);
 
  if(MOOC_Mark!='')
{
    if (!fileInput.files[0]) {
                 ErrorToast('Attachment required',"bg-danger" );
                return;
            }
             var formData = new FormData();
             formData.append("moocfile", fileInput.files[0]);
             formData.append("code",358);
             formData.append("id",id);
             formData.append("MOOC_Mark",MOOC_Mark);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "action.php", true);
            xhr.onload = function () {
            console.log("Server response:",xhr.responseText);
                if (xhr.status === 200) {
                     SuccessToast('Successfully Uploaded');
                     select_mst();
                        } 
                else {
                    statusDiv.innerHTML = "<p style='color:red;'>File upload failed.</p>";
                }
            };

            xhr.onerror = function () {
                statusDiv.innerHTML = "<p style='color:red;'>An error occurred while uploading the file.</p>";
            };

            xhr.send(formData);
          }
          else
          {
        ErrorToast('valid input required',"bg-danger" );
          }
}

function dateOnChnage() {
    var doa = $("#doj").val();
    var dor = $("#dor").val();
    var code = 434;
    if (doa == null || doa == "" || dor == null || dor == "") {
        // alert("Select Date of Joining");
        ErrorToast('Select Date of Joining', 'bg-warning');
        document.getElementById("dor").value = '';
    } else if (doa > dor) {
        ErrorToast('Date of Joining must be older that date of leaving', 'bg-warning');
        document.getElementById("dor").value = '';
        document.getElementById("doj").value = '';
    } else {

        $.ajax({
            url: 'action_g.php',
            data: {
                doa: doa,
                dor: dor,
                code: code
            },
            type: 'POST',
            success: function(data) {
                console.log(data)
                document.getElementById("exp_total").value = data;

            }
        });
    }
}
</script>

<?php
include "footer.php";
?>