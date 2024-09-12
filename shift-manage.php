<?php
include "header.php";
?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class=" card-header">
                    Shift Manage
                </div>

                <div class="card card-body">
                    <div class="row">
                        <div class="col-lg-12  col-sm-12 col-lg-7">
                            <div class="card card-primary">
                                <!-- <div > -->
                                <!-- THE CALENDAR -->
                                <div class="btn-group w-100 mb-2">
                                    <a class="btn btn-primary" id="btn1"
                                        style="background-color:#223260; color: white; border: 5px solid;"
                                        onclick="showManageShift(),bg(this.id);"> Manage </a>
                                    <a class="btn btn-primary" id="btn2"
                                        style="background-color:#223260; color: white; border: 5px solid;"
                                        onclick="showTimingShift(),bg(this.id);">Master Timing </a>
                                    <a class="btn btn-primary" id="btn3"
                                        style="background-color:#223260; color: white; border: 5px solid;"
                                        onclick="showExceptionShift(),bg(this.id);"> Exception Timing </a>
                                    <a class="btn btn-primary" id="btn4"
                                        style="background-color:#223260; color: white; border: 5px solid;"
                                        onclick="showSingleExceptionShift(),bg(this.id);"> Single Exception  </a>
                                </div>
                                <div class=" table-responsive-lg pd" id="table-data"
                                    style=" padding:0px!important;">









                                </div>
                                <!-- </div> -->

                            </div>

                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>

</section>
<div class="modal fade" id="ExceptionChnageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='exceptionChnageModal1'>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ExceptionChnageModal1111" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Record 111</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='exceptionChnageModal11'>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='update_data'>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="UpdateDesignationModalCenter2" tabindex="-1" role="dialog"
    aria-labelledby="UpdateDesignationModalCenter2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">edit Designaion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='update_data_designation'>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="NewDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="NewDepartmentModal"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewDepartmentModal">New Shift</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-10">

                        <label>Name</label>
                        <input type="text" id="shiftName" class="form-control" required>
                        <br>
                        <input type="submit" onclick="save_designation();" value="save" class="btn btn-secondary">

                    </div>
                    <div class="col-lg-1"></div>

                </div>
                <br>




            </div>
        </div>
    </div> 
</div>
<script>
$(window).on('load', function() {
    $('#btn1').toggleClass("bg-success");

})

function bg(id) {
    $('.btn').removeClass("bg-success");
    $('#' + id).toggleClass("bg-success");
}

function showManageShift() {
    var code = 255;
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
            document.getElementById("table-data").innerHTML = response;
        }
    });
}

function showTimingShift() {
    var code = 256;
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
            document.getElementById("table-data").innerHTML = response;
        }
    });
}

function showExceptionShift() {
    var code = 257;
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
            document.getElementById("table-data").innerHTML = response;
        }
    });
}
function showSingleExceptionShift() {
    var code = 258;
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
            document.getElementById("table-data").innerHTML = response;
        }
    });
}
function modalEditSingleException(id) {
    var code = 371;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,id:id
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("exceptionChnageModal1").innerHTML = response;
        }
    });
}
function modalEditExceptionTiming(id) {
    // alert(id);
    var code = 464;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,id:id
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("exceptionChnageModal11").innerHTML = response;
        }
    });
}

function saveRowSingle(id) {
    var code = 370;
var StartDate = document.getElementById("StartDate"+id).value;
var EndDate = document.getElementById("EndDate"+id).value;
var intime = document.getElementById("intime"+id).value;
var intime1 = document.getElementById("intime1"+id).value;
var intime2 = document.getElementById("intime2"+id).value;
var intime3 = document.getElementById("intime3"+id).value;
var outtime = document.getElementById("outtime"+id).value;
var outtime1 = document.getElementById("outtime1"+id).value;
var outtime2 = document.getElementById("outtime2"+id).value;
var outtime3 = document.getElementById("outtime3"+id).value;
    $.ajax({
        type: 'POST',
        url: 'action_g.php',
        data: {
            code: code,
            id: id,
            StartDate:StartDate,
            EndDate:EndDate,
            intime: intime,
            intime1: intime1,
            intime2: intime2,
            intime3: intime3,
            outtime: outtime,
            outtime1: outtime1,
            outtime2: outtime2,
            outtime3: outtime3
           
        },
        success: function(response) {
            // console.log(response);
            if(response==1)
            {
            SuccessToast('Successfully Added');
            showSingleExceptionShift();
            }
            else{
                ErrorToast('Try Again','bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
function saveRowSingle11(id) {
var code = 465;
var StartDate = document.getElementById("StartDate"+id).value;
var EndDate = document.getElementById("EndDate"+id).value;
var intime = document.getElementById("intime"+id).value;
var intime1 = document.getElementById("intime1"+id).value;
var intime2 = document.getElementById("intime2"+id).value;
var intime3 = document.getElementById("intime3"+id).value;
var outtime = document.getElementById("outtime"+id).value;
var outtime1 = document.getElementById("outtime1"+id).value;
var outtime2 = document.getElementById("outtime2"+id).value;
var outtime3 = document.getElementById("outtime3"+id).value;
    $.ajax({
        type: 'POST',
        url: 'action_g.php',
        data: {
            code: code,
            id: id,
            StartDate:StartDate,
            EndDate:EndDate,
            intime: intime,
            intime1: intime1,
            intime2: intime2,
            intime3: intime3,
            outtime: outtime,
            outtime1: outtime1,
            outtime2: outtime2,
            outtime3: outtime3
           
        },
        success: function(response) {
            console.log(response);
            if(response==1)
            {
            SuccessToast('Successfully Added');
            showSingleExceptionShift();
            }
            else{
                ErrorToast('Try Again','bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}



function addMasterShift() {

var shiftId = document.getElementById("shiftId").value;
var intime = document.getElementById("intime").value;
var intime1 = document.getElementById("intime1").value;
var intime2 = document.getElementById("intime2").value;
var intime3 = document.getElementById("intime3").value;
var outtime = document.getElementById("outtime").value;
var outtime1 = document.getElementById("outtime1").value;
var outtime2 = document.getElementById("outtime2").value;
var outtime3 = document.getElementById("outtime3").value;
// alert(intime);
var code=259;
if (shiftId === "") {

    ErrorToast('Please select a shiftId.', 'bg-warning');
    return;
}
if (intime === "") {

    ErrorToast('Please select a intime.', 'bg-warning');
    return;
}
    if (intime1 === "") {

        ErrorToast('Please select a intime1.', 'bg-warning');
        return;
    }
    if (intime2 === "") {

        ErrorToast('Please select a intime2.', 'bg-warning');
        return;
    }
    if (intime3 === "") {

        ErrorToast('Please select a intime3.', 'bg-warning');
        return;
    }
if (outtime === "") {

    ErrorToast('Please select a outtime.', 'bg-warning');
    return;
}
    if (outtime1 === "") {

        ErrorToast('Please select a outtime1.', 'bg-warning');
        return;
    }
    if (outtime2 === "") {

        ErrorToast('Please select a outtime2.', 'bg-warning');
        return;
    }
    if (outtime3 === "") {

        ErrorToast('Please select a outtime3.', 'bg-warning');
        return;
    }

    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            shiftId:shiftId,intime:intime,intime1:intime1,intime2:intime2,intime3:intime3,outtime:outtime,outtime1:outtime1,outtime2:outtime2,outtime3:outtime3
        },
        success: function(response) {
           
            //spinner.style.display = 'none';

            if(response==2)
            {
                ErrorToast('Already Exist', 'bg-warning'); 
            }
            else
            {
            SuccessToast('Successfully Added');
        }
 showTimingShift();
        }
    });
}
function addExceptionMasterShift() {

var StartDate = document.getElementById("StartDate").value;
var EndDate = document.getElementById("EndDate").value;
var shiftId = document.getElementById("shiftID").value;
var intime = document.getElementById("intime").value;
var intime1 = document.getElementById("intime1").value;
var intime2 = document.getElementById("intime2").value;
var intime3 = document.getElementById("intime3").value;
var outtime = document.getElementById("outtime").value;
var outtime1 = document.getElementById("outtime1").value;
var outtime2 = document.getElementById("outtime2").value;
var outtime3 = document.getElementById("outtime3").value;
// alert(intime);
var code=260;
if (shiftId === "") {

    ErrorToast('Please select a shiftId.', 'bg-warning');
    return;
}
if (intime === "") {

    ErrorToast('Please select a intime.', 'bg-warning');
    return;
}
    if (intime1 === "") {

        ErrorToast('Please select a intime1.', 'bg-warning');
        return;
    }
    if (intime2 === "") {

        ErrorToast('Please select a intime2.', 'bg-warning');
        return;
    }
    if (intime3 === "") {

        ErrorToast('Please select a intime3.', 'bg-warning');
        return;
    }
if (outtime === "") {

    ErrorToast('Please select a outtime.', 'bg-warning');
    return;
}
    if (outtime1 === "") {

        ErrorToast('Please select a outtime1.', 'bg-warning');
        return;
    }
    if (outtime2 === "") {

        ErrorToast('Please select a outtime2.', 'bg-warning');
        return;
    }
    if (outtime3 === "") {

        ErrorToast('Please select a outtime3.', 'bg-warning');
        return;
    }

    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            shiftId:shiftId,intime:intime,intime1:intime1,intime2:intime2,intime3:intime3,outtime:outtime,outtime1:outtime1,outtime2:outtime2,outtime3:outtime3,EndDate:EndDate,StartDate:StartDate
        },
        success: function(response) {
            // console.log(response);
            showExceptionShift();
            SuccessToast('Successfully Added');
        }
    });
}
function addExceptionSingle() {

var StaffID = document.getElementById("StaffID").value;
var StartDate = document.getElementById("StartDate").value;
var EndDate = document.getElementById("EndDate").value;
var intime = document.getElementById("intime").value;
var intime1 = document.getElementById("intime1").value;
var intime2 = document.getElementById("intime2").value;
var intime3 = document.getElementById("intime3").value;
var outtime = document.getElementById("outtime").value;
var outtime1 = document.getElementById("outtime1").value;
var outtime2 = document.getElementById("outtime2").value;
var outtime3 = document.getElementById("outtime3").value;
// alert(intime);
var code=262;
if (StartDate === "") {

    ErrorToast('Please Enter a StartDate.', 'bg-warning');
    return;
}
if (EndDate === "") {

    ErrorToast('Please Enter a EndDate.', 'bg-warning');
    return;
}
if (StaffID === "") {

    ErrorToast('Please Enter a StaffID.', 'bg-warning');
    return;
}
if (intime === "") {

    ErrorToast('Please select a intime.', 'bg-warning');
    return;
}
    if (intime1 === "") {

        ErrorToast('Please select a intime1.', 'bg-warning');
        return;
    }
    if (intime2 === "") {

        ErrorToast('Please select a intime2.', 'bg-warning');
        return;
    }
    if (intime3 === "") {

        ErrorToast('Please select a intime3.', 'bg-warning');
        return;
    }
if (outtime === "") {

    ErrorToast('Please select a outtime.', 'bg-warning');
    return;
}
    if (outtime1 === "") {

        ErrorToast('Please select a outtime1.', 'bg-warning');
        return;
    }
    if (outtime2 === "") {

        ErrorToast('Please select a outtime2.', 'bg-warning');
        return;
    }
    if (outtime3 === "") {

        ErrorToast('Please select a outtime3.', 'bg-warning');
        return;
    }

    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            StaffID:StaffID,intime:intime,intime1:intime1,intime2:intime2,intime3:intime3,outtime:outtime,outtime1:outtime1,outtime2:outtime2,outtime3:outtime3,EndDate:EndDate,StartDate:StartDate
        },
        success: function(response) {
            // console.log(response);
            showSingleExceptionShift();
            SuccessToast('Successfully Added');
        }
    });
}

function setValueTimeAcrodingToShift(id) 
{
    // alert(id);
    // var shiftId = document.getElementById("shiftId").value;
    var code = 261;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        dataType: 'json',
        data: {
            code: code,
            shiftId: id
        },
        success: function(response) 
        {
        //   console.log(response[0]['Intime']);  
        $("#intime").val(response[0]['Intime']);
        $("#intime1").val(response[0]['Intime1']);
        $("#intime2").val(response[0]['Intime2']);
        $("#intime3").val(response[0]['Intime3']);
        $("#outtime").val(response[0]['Outtime']);
        $("#outtime1").val(response[0]['Outtime1']);
        $("#outtime2").val(response[0]['Outtime2']);
        $("#outtime3").val(response[0]['Outtime3']);
        }
    });
}

function getEmployeeShift(id) 
{
    // alert(id);
    var code = 263;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        dataType: 'json',
        data: {
            code: code,
            staffID: id
        },
        success: function(response) 
        {
        //   console.log(response);  
        $("#intime").val(response[0]['Intime']);
        $("#intime1").val(response[0]['Intime1']);
        $("#intime2").val(response[0]['Intime2']);
        $("#intime3").val(response[0]['Intime3']);
        $("#outtime").val(response[0]['Outtime']);
        $("#outtime1").val(response[0]['Outtime1']);
        $("#outtime2").val(response[0]['Outtime2']);
        $("#outtime3").val(response[0]['Outtime3']);
        }
    });
}

function save_designation() {
    var code = 254;
    var shiftName = document.getElementById('shiftName').value;

    var spinner = document.getElementById('ajax-loader');

    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            shiftName: shiftName
        },
        success: function(response) {
            search();
            spinner.style.display = 'none';
            SuccessToast('Successfully Added');
        }
    });



}

function delete_dep(id) {
    var a = confirm('Are you sure you want to delete');
    //    alert(id);
    if (a == true) {
        var code = 251;
        var spinner = document.getElementById('ajax-loader');

        spinner.style.display = 'block';
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                id: id
            },
            success: function(response) {
                console.log(response);
                spinner.style.display = 'none';
                search();
                SuccessToast('Successfully Deleted');
                // document.getElementById("tab_data").innerHTML=response;
            }
        });
    } else {

    }
}

function update_dep(id) {
    var code = 252;



    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            spinner.style.display = 'none';
            search();
            document.getElementById("update_data").innerHTML = response;
        }
    });

}

function search() {
    var code = 250;

    var college = document.getElementById('CollegeID_For_Department').value;

    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
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
function searchEmpSingleException() {
    var code = 372;
    var EmployeeID = document.getElementById('empIDSignleException').value;
    if(EmployeeID!='')
    {
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            Employeeid: EmployeeID
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("showSingleExceptionSearch").innerHTML = response;
        }
    });
}
else{
    ErrorToast('Please Enter Emplyee ID','bg-warning');
}

}

function Updatedepdata(id) {
    var code = 253;
    var shiftName = document.getElementById('shiftName').value;



    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id,
            shiftName: shiftName
        },
        success: function(response) {
            spinner.style.display = 'none';
            search();
            SuccessToast('Successfully Updated');

        }
    });

}
</script>


<?php include "footer.php";?>