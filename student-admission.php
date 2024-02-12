<?php 
  include "header.php";   
?>

<section class="content">
    <div class="container-fluid">
  <div class="row">

            <div class="col-lg-3  col-sm-3 col-lg-3">
            </div>

            <div class="col-lg-6  col-sm-6 col-lg-6">
               
                    <div class="btn-group w-100 mb-2">
                        <a class="btn btn-primary" id="btn1"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="newAdmission(),bg1(this.id);"> New Admission </a>
                        <a class="btn btn-primary" id="btn2"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="oldAdmission(),bg1(this.id);"> Old Admission </a>
                              <a class="btn btn-primary" id="btn2"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="creditcardAdmission(),bg1(this.id);"> Credit Card </a>
                    </div>
                   
             
            </div>
        </div> 
         <div class="card card-primary">
         <div class="card-body" id="admissionForm" style="">
                    </div>
                </div>
    </div>
    <!-- /.col -->
</section>
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body" style="text-align:left">
                <div class="row" id="testingQuery">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<p id="ajax-loader"></p>
<?php   include "footer.php";   ;?>
<script>
$(window).on('load', function() {
    $('#btn1').toggleClass("bg-success");
    $('#btn3').toggleClass("bg-success");
    newAdmission();
    //successModal(9618234050);

})

function bg1(id) {
    $('.btn11').removeClass("bg-success");
    $('#' + id).toggleClass("bg-success");
}

function bg(id) {
    $('.btnG').removeClass("bg-success");
    $('#' + id).toggleClass("bg-success");
}
function newAdmission() {
    var code = 348;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code 
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("admissionForm").innerHTML = response;
        }
    });
}
function collegeByDepartment(College) {

    var code = '304';
    $.ajax({
        url: 'action.php',
        data: {
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {

                $("#Department").html("");
                $("#Department").html(data);
            }
        }
    });

}

function oldAdmission() {
    var code = 349;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("admissionForm").innerHTML = response;
        }
    });
}

function creditcardAdmission() {
    var code = 367;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("admissionForm").innerHTML = response;
        }
    });
}

function searchStudentOnRollNo() {
    var rollNo = document.getElementById('rollNo').value;
    if (rollNo != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '361';
        $.ajax({
            url: 'action_g.php',
            data: {
                code: code,
                rollNo: rollNo
            },
            type: 'POST',
            success: function(response) {
                spinner.style.display = 'none';
                var data = JSON.parse(response);
                document.getElementById("Nationality").value = data[0];
                document.getElementById("Name").value = data[1];
                document.getElementById("FatherName").value = data[2];
                document.getElementById("MobileNumber").value = data[3];
                if (data[0] == 'Indian') {
        $('#AdharCard').show();
        $('#IDNoNationlity').hide();
        $('#PassportNo').hide();
        document.getElementById('IDNoNationlity').value = "";
        document.getElementById('PassportNumber').value = "";
        document.getElementById("AdharCardNo").value = data[4];
    } else if (data[0] == 'NRI') {
        $('#PassportNo').show();
        $('#AdharCard').hide();
        $('#IDNoNationlity').hide();
        document.getElementById("PassportNumber").value = data[4];
        document.getElementById('IDNoNationlity').value = "";
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('IDNumber').value = "";
    } else if (data[0] == 'Nepal') {
        $('#IDNoNationlity').show();
        $('#AdharCard').hide();
        $('#PassportNo').hide();
        document.getElementById("IDNoNationlity").value = data[4];
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('PassportNumber').value = "";
    } else if (data[0] == 'Bhutan') {
        $('#IDNoNationlity').show();
        $('#AdharCard').hide();
        $('#PassportNo').hide();
        document.getElementById("IDNoNationlity").value = data[4];
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('PassportNumber').value = "";
    }
                
                document.getElementById("Dob").value = data[5];
                document.getElementById("Gender").value = data[6];
                document.getElementById("category").value = data[7];
            }
        });
    } else {
        ErrorToast('Please Enter RollNo', 'bg-warning');
    }
}




function creditcardsearch() {
    var rollNo = document.getElementById('rollNo').value;
    if (rollNo != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '368';
        $.ajax({
            url: 'action_g.php',
            data: {
                code: code,
                rollNo: rollNo
            },
            type: 'POST',
            success: function(response) {
                console.log(response);
                spinner.style.display = 'none';
                var data = JSON.parse(response);
                document.getElementById("Nationality").value = data[0];
                document.getElementById("Name").value = data[1];
                document.getElementById("FatherName").value = data[2];
                document.getElementById("MobileNumber").value = data[3];
                if (data[0] == 'Indian') {
        $('#AdharCard').show();
        $('#IDNoNationlity').hide();
        $('#PassportNo').hide();
        document.getElementById('IDNoNationlity').value = "";
        document.getElementById('PassportNumber').value = "";
        document.getElementById("AdharCardNo").value = data[4];
    } else if (data[0] == 'NRI') {
        $('#PassportNo').show();
        $('#AdharCard').hide();
        $('#IDNoNationlity').hide();
        document.getElementById("PassportNumber").value = data[4];
        document.getElementById('IDNoNationlity').value = "";
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('IDNumber').value = "";
    } else if (data[0] == 'Nepal') {
        $('#IDNoNationlity').show();
        $('#AdharCard').hide();
        $('#PassportNo').hide();
        document.getElementById("IDNoNationlity").value = data[4];
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('PassportNumber').value = "";
    } else if (data[0] == 'Bhutan') {
        $('#IDNoNationlity').show();
        $('#AdharCard').hide();
        $('#PassportNo').hide();
        document.getElementById("IDNoNationlity").value = data[4];
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('PassportNumber').value = "";
    }
                
                document.getElementById("Dob").value = data[5];
                document.getElementById("Gender").value = data[6];
                document.getElementById("category").value = data[7];
            }
        });
    } else {
        ErrorToast('Please Enter RollNo', 'bg-warning');
    }
}























function fetchCollege() {
    var Session = document.getElementById('Session').value;
    var code = 350;
    $.ajax({
        url: 'action_g.php',
        data: {
            Session: Session,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                $("#CollegeID").html("");
                $("#CollegeID").html(data);
                document.getElementById('Batch').value = "";
                clearFeeDetails();
            }
        }
    });
}
function fetchcourse() {
    var College = document.getElementById('CollegeID').value;
    var Session = document.getElementById('Session').value;
     var Department = document.getElementById('Department').value;
    var code = 351;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Session: Session,Department,Department,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                $("#Course").html("");
                $("#Course").html(data);
                document.getElementById('Batch').value = "";
                clearFeeDetails();
            }
        }
    });
}

function fatchBatch() {
    var College = document.getElementById('CollegeID').value;
    var Course = document.getElementById('Course').value;
    var Session = document.getElementById('Session').value;
    var LateralEntry = document.getElementById('LateralEntry').value;
    var code = 352;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Course: Course,
            Session: Session,
            LateralEntry: LateralEntry,
            code: code
        },
        type: 'POST',
        success: function(data) {
            document.getElementById('Batch').value = data;
        }
    });
}

function getOnChnageDetails(count) {
    var refrene = document.getElementById('refvalue').value;
    var id = document.getElementById('EmID' + refrene + count).value;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    var code = 354;
    $.ajax({
        url: 'action_g.php',
        data: {
            refrene: refrene,
            id: id,
            code: code
        },
        type: 'POST',
        success: function(response) {
            spinner.style.display = 'none';
            var data = JSON.parse(response);
            document.getElementById("RefName" + count).value = data[0];
            document.getElementById("RefContact" + count).value = data[1];
            document.getElementById("RefAddress" + count).value = data[2];
        }
    });
}

function clearFeeDetails() {
    document.getElementById("SemesterForFee").value = "";
    document.getElementById("feeparticulr").value = "";
    document.getElementById("feeTotalDebit").value = "";
    document.getElementById("LateralEntry").value = "";
}

function getFeeDetails() {
    var semesterSelect = document.getElementById("SemesterForFee");
    var selectedOption = semesterSelect.options[semesterSelect.selectedIndex];
    var SemesterForFee = selectedOption.text;
    // var SemesterForFee = document.getElementById('SemesterForFee').value;
    var College = document.getElementById('CollegeID').value;
    var Course = document.getElementById('Course').value;
    var Session = document.getElementById('Session').value;
    var LateralEntry = document.getElementById('LateralEntry').value;
    var FeeCategory = document.getElementById('feecategory').value;
    var Batch = document.getElementById('Batch').value;
    if (College === '') {
        ErrorToast('Please select a College', 'bg-warning');
        document.getElementById("SemesterForFee").value = "";
        return;
    }
    if (Course === '') {
        ErrorToast('Please select a Course', 'bg-warning');
         document.getElementById("SemesterForFee").value = "";
        return;
    }
    if (LateralEntry === '') {
        ErrorToast('Please select Lateral Entry status', 'bg-warning');
         document.getElementById("SemesterForFee").value = "";
        return;
    }
    if (FeeCategory === '') {
        ErrorToast('Please select a Fee Category', 'bg-warning');
         document.getElementById("SemesterForFee").value = "";
        return;
    }
    if (SemesterForFee === '') {
        ErrorToast('Please select a Semester', 'bg-warning');
         document.getElementById("SemesterForFee").value = "";
        return;
    }
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    var code = 355;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Course: Course,
            Session: Session,
            LateralEntry: LateralEntry,
            FeeCategory: FeeCategory,
            Batch: Batch,
            SemesterForFee: SemesterForFee,
            code: code
        },
        type: 'POST',
        success: function(response) {
            spinner.style.display = 'none';
            console.log(response);
            var data = JSON.parse(response);
            document.getElementById("feeparticulr").value = data[0];
            document.getElementById("feeTotalDebit").value = data[1];
        }
    });
}
function getFeeDetailsTable() {
    var semesterSelect = document.getElementById("SemesterForFee");
    var selectedOption = semesterSelect.options[semesterSelect.selectedIndex];
    var SemesterForFee = selectedOption.text;
    var College = document.getElementById('CollegeID').value;
    var Course = document.getElementById('Course').value;
    var Session = document.getElementById('Session').value;
    var LateralEntry = document.getElementById('LateralEntry').value;
    var FeeCategory = document.getElementById('feecategory').value;
    var Batch = document.getElementById('Batch').value;
    var code = 356;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Course: Course,
            Session: Session,
            LateralEntry: LateralEntry,
            FeeCategory: FeeCategory,
            Batch: Batch,
            SemesterForFee: SemesterForFee,
            code: code
        },
        type: 'POST',
        success: function(response) {
            document.getElementById("feeDetailTable").innerHTML = response;
        }
    });
}
function adharPassChnage(id) {
    // alert(id);
    if (id == 'Indian') {
        $('#AdharCard').show();
        $('#IDNoNationlity').hide();
        $('#PassportNo').hide();
        document.getElementById('IDNoNationlity').value = "";
    } else if (id == 'NRI') {
        $('#PassportNo').show();
        $('#AdharCard').hide();
        $('#IDNoNationlity').hide();
        document.getElementById('IDNoNationlity').value = "";
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('PassportNumber').value = "";
        document.getElementById('IDNumber').value = "";
    } else if (id == 'Nepal') {
        $('#IDNoNationlity').show();
        $('#AdharCard').hide();
        $('#PassportNo').hide();
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('PassportNumber').value = "";
    } else if (id == 'Bhutan') {
        $('#IDNoNationlity').show();
        $('#AdharCard').hide();
        $('#PassportNo').hide();
        document.getElementById('AdharCardNo').value = "";
        document.getElementById('PassportNumber').value = "";
    }
}
function onchnagereff(ref) {
    document.getElementById('refvalue').value = ref;
    var refvalueCount = document.getElementById('refvalueCount').value;
    document.getElementById("RefName1").value = "";
    document.getElementById("RefContact1").value = "";
    document.getElementById("RefAddress1").value = "";
    document.getElementById("tableTeam").innerHTML = "";
    $('#tableTeamOhter').show();
    if (ref == 'Staff') {
        $('#accordingToReffStaff').show();
        $('#accordingToReffStudent').hide();
        $('#accordingToReffConsoultant').hide();
    } else if (ref == 'Student') {
        $('#accordingToReffStudent').show();
        $('#accordingToReffStaff').hide();
        $('#accordingToReffConsoultant').hide();
    } else if (ref == 'Consultant') {
        $('#accordingToReffConsoultant').show();
        $('#accordingToReffStaff').hide();
        $('#accordingToReffStudent').hide();
    }
}
function submitNewAdmissions() {
    var Nationality = document.getElementById('Nationality').value;
    if (Nationality == 'Indian') {
        var idproof = document.getElementById('AdharCardNo').value;
    } else if (Nationality == 'NRI') {
        var idproof = document.getElementById('PassportNumber').value;
    } else if (Nationality == 'Nepal') {
        var idproof = document.getElementById('IDNumber').value;
    } else if (Nationality == 'Bhutan') {
        var idproof = document.getElementById('IDNumber').value;
    }
    var Name = document.getElementById('Name').value;
    var FatherName = document.getElementById('FatherName').value;
    var MobileNumber = document.getElementById('MobileNumber').value;
    var Dob = document.getElementById('Dob').value;
    var Gender = document.getElementById('Gender').value;
    var category = document.getElementById('category').value;
    var feecategory = document.getElementById('feecategory').value;
    var scholaship = document.getElementById('scholaship').value;
    var Session = document.getElementById('Session').value;
    var CollegeID = document.getElementById('CollegeID').value;
    var Course = document.getElementById('Course').value;
    var LateralEntry = document.getElementById('LateralEntry').value;
    var Batch = document.getElementById('Batch').value;
    var Comments = document.getElementById('Comments').value;
    var refvalue = document.getElementById('refvalue').value;
    var EmIDTeam = document.getElementById('EmID' + refvalue + '1').value;
    if (refvalue == 'Team') {
        var verifiy = document.getElementsByClassName('v_check');
        var len_student = verifiy.length;
        var subjectIDs = [];
        for (i = 0; i < len_student; i++) {
            subjectIDs.push(verifiy[i].value);
        }
    } else {
        var subjectIDs = [];
    }
    if (EmIDTeam != '') {
        var RefName = document.getElementById('RefName1').value;
        var RefContact = document.getElementById('RefContact1').value;
        var RefAddress = document.getElementById('RefAddress1').value;
    } else {
        var RefName = "";
        var RefContact = "";
        var RefAddress = "";
    }
    for (i = 1; i < len_student + 1; i++) {
        var EmIDTeam = document.getElementById('EmID' + refvalue + i).value;
        var RefName = document.getElementById('RefName' + i).value;
        var RefContact = document.getElementById('RefContact' + i).value;
        var RefAddress = document.getElementById('RefAddress' + i).value;
    }
    var semesterSelect = document.getElementById("SemesterForFee");
    var selectedOption = semesterSelect.options[semesterSelect.selectedIndex];
    var selectedSemesterID = selectedOption.value;
    var SemesterForFee = selectedOption.text;
    var feeparticulr = document.getElementById('feeparticulr').value;
    var feeTotalDebit = document.getElementById('feeTotalDebit').value;
    if (Nationality === '') {
        ErrorToast('Please select a Nationality', 'bg-warning');
        return;
    }
    if (Name === '') {
        ErrorToast('Please enter a Name', 'bg-warning');
        return;
    }
    if (FatherName === '') {
        ErrorToast('Please Enter a FatherName', 'bg-warning');
        return;
    }
    if (MobileNumber === '') {
        ErrorToast('Please Enter a MobileNumber', 'bg-warning');
        return;
    }
    if (idproof === '') {

        ErrorToast('Please enter a idproof', 'bg-warning');
        return;
    }
    if (Dob === '') {
        ErrorToast('Please select a Dob', 'bg-warning');
        return;
    }
    if (Gender === '') {
        ErrorToast('Please select a Gender', 'bg-warning');
        return;
    }
    if (category === '') {
        ErrorToast('Please select a category', 'bg-warning');
        return;
    }
    if (feecategory === '') {
        ErrorToast('Please select a feecategory', 'bg-warning');
        return;
    }
    if (scholaship === '') {
        ErrorToast('Please select a scholaship', 'bg-warning');
        return;
    }
    if (Session === '') {
        ErrorToast('Please select a Session', 'bg-warning');
        return;
    }
    if (CollegeID === '') {
        ErrorToast('Please select a College', 'bg-warning');
        return;
    }
    if (Course === '') {
        ErrorToast('Please select a Course', 'bg-warning');
        return;
    }
    if (LateralEntry === '') {
        ErrorToast('Please select a LateralEntry', 'bg-warning');
        return;
    }
    if (Batch === '') {
        ErrorToast('Please Enter a Batch', 'bg-warning');
        return;
    }
    if (Comments === '') {
        ErrorToast('Please Enter a Comments', 'bg-warning');
        return;
    }
    if (SemesterForFee === '') {
        ErrorToast('Please select a SemesterForFee', 'bg-warning');
        return;
    }
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    var code = 357;
    $.ajax({
        url: 'action_g.php',
        data: {
            Nationality: Nationality,
            Name: Name,
            FatherName: FatherName,
            MobileNumber: MobileNumber,
            idproof: idproof,
            Dob: Dob,
            Gender: Gender,
            category: category,
            feecategory: feecategory,
            scholaship: scholaship,
            Session: Session,
            CollegeID: CollegeID,
            Course: Course,
            LateralEntry: LateralEntry,
            Batch: Batch,
            Comments: Comments,
            refvalue: refvalue,
            EmID: EmIDTeam,
            subjectIDs: subjectIDs,
            RefName: RefName,
            RefContact: RefContact,
            RefAddress: RefAddress,
            SemesterForFee: SemesterForFee,
            SemesterID: selectedSemesterID,
            feeparticulr: feeparticulr,
            feeTotalDebit: feeTotalDebit,
            code: code
        },
        type: 'POST',
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            if (response == 1) {
                ErrorToast('Server is busy Try Again ', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('Server is busy Click Again', 'bg-warning');
            } else if (response == 3) {
                ErrorToast('Student  Already Exist', 'bg-warning');
            } 
            else if (response == 4) {
                ErrorToast('Roll Number Series Over', 'bg-warning');
            } 
            else if (response == 5) {
                ErrorToast('Fee Not Updated', 'bg-warning');
            } 

            else {
                var data = JSON.parse(response);
                successModal(data[0]);
                document.getElementById('Name').value = "";
                document.getElementById('FatherName').value = "";
                document.getElementById('MobileNumber').value = "";
                document.getElementById('Dob').value = "";
            }
        }
    });
}

// successModal(9618224520);
function successModal(IDNo)
 {
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $('#successModal').modal('show');
    var code = 358;
    $.ajax({
        url: 'action_g.php',
        data: {
            IDNo: IDNo,
            code: code
        },
        type: 'POST',
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById('testingQuery').innerHTML = response;
        }
    });
}
function onchnagereffteam(count) {
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    document.getElementById('refvalue').value = 'Team';
    document.getElementById('refvalueCount').value = count;
    document.getElementById('tableTeamOhter').style.display = 'none';
    var code = 360;
    $.ajax({
        url: 'action_g.php',
        data: {
            code: code
        },
        type: 'POST',
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById('tableTeam').innerHTML = response;
        }
    });
}
var rowCount = 2;
function addRow() {
    var dynamicID = rowCount;
    var row = "<tr id='" + dynamicID + "'>" +
        "<td class='form-group' style='position: relative'>" +
        "<input type='text' onblur='getOnChnageDetails(" + dynamicID + ");' class='form-control v_check' id='EmIDTeam" +
        dynamicID + "' placeholder='Enter ID'>" +
        "<div class='justify-content-center' style='position: absolute; width: 100%; left: 50%;'></div>" +
        "</td>" +
        "<td class='form-group' style='position: relative'>" +
        "<input type='text' class='form-control' id='RefName" + dynamicID + "' readonly>" +
        "<div class='justify-content-center' style='position: absolute; width: 100%; left: 50%;'></div>" +
        "</td>" +
        "<td class='form-group' style='position: relative'>" +
        "<input type='text' class='form-control' id='RefContact" + dynamicID + "' readonly>" +
        "<div class='justify-content-center' style='position: absolute; width: 100%; left: 50%;'></div>" +
        "</td>" +
        "<td class='form-group' style='position: relative'>" +
        "<input type='text' class='form-control' id='RefAddress" + dynamicID + "' readonly>" +
        "<div class='justify-content-center' style='position: absolute; width: 100%; left: 50%;'></div>" +
        "</td>" +
        "<td><button onclick='deleteRow(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>" +
        "</tr>";

    document.getElementById("myList").insertAdjacentHTML('beforeend', row);
    rowCount++;
}
function deleteRow(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
</script>
</body>

</html>