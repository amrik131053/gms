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
                <h4 class="modal-title">Academic Document</h4>
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
</script>
<script>
showProfileData();

function showProfileData() {
    var spinner = document.getElementById("ajax-loader");
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
function addPhd(form) {
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
    if (x.style.display === "none") {
        x.style.display = "block";
        g.style.display = "none";
        document.getElementById("add_button").innerHTML = "Remove";
        document.getElementById("phd_button").innerHTML = "PHD";
    } else {
        x.style.display = "none";
        y.style.display = "none";
        g.style.display = "none";

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
    if (y.style.display === "none") {
        y.style.display = "block";
        z.style.display = "none";
        g.style.display = "none";
        document.getElementById("phd_button").innerHTML = "Remove";
        document.getElementById("add_button").innerHTML = "Academics";
    } else 
    {
        y.style.display = "none";
        z.style.display = "none";
        g.style.display = "none";
        document.getElementById("phd_button").innerHTML = "PHD";
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
</script>

<script>
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