<?php 
   include "header.php";  
   include "connection/connection.php"; 

   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-outline">
                    <div class="card-header">


                      
                        <div class="btn-group ">
                            <select class="form-control form-control-sm" id="statusForIdCard">
                               <option value="">Select</option>
                               <?php 
                                  $dropdown="SELECT DISTINCT status FROM SmartCardDetails ";
                                  $dropdownRun=sqlsrv_query($conntest,$dropdown);
                                  while ($row=sqlsrv_fetch_array($dropdownRun)) {
                                  ?>
                               <option value="<?=$row['status'];?>"><?=$row['status'];?></option>
                               <?php
                                  }
                                  
                                   ?>
                            </select>
                            &nbsp;
                            &nbsp;
                            <input type="date" class="form-control form-control-sm" id="fromDateForIdCard">
                            &nbsp;
                            &nbsp;
                            <input type="date" class="form-control form-control-sm" id="toDateFromIdCard">
                            &nbsp;
                            &nbsp;
                            <input type="search" class="form-control form-control-sm" id="RollNo"
                               placeholder="RollNo Here">
                            <div class="input-group-append">
                               &nbsp;
                               &nbsp;
                               <button type="button" onclick="searchStudentForIDcard();"
                                  class="form-control form-control-sm bg-success">
                               Search
                               </button>
                               &nbsp;
                               &nbsp;
                               <button type="button" class="form-control form-control-sm bg-warning"><b
                                  id="verified_count"></b></button>
                            </div>
                         </div>
                         <div class="card-tools">
                            <div class="input-group ">
                               &nbsp;
                               &nbsp;
                               <button type="button" class="form-control form-control-sm bg-success" onclick="exportPdfSmartCard();"><i
                                  class="fa fa-file-pdf" ></i></button>
                               &nbsp;
                               &nbsp;
                               <button type="button" class="form-control form-control-sm bg-success" onclick="exportExcelSmartCard();"><i
                                  class="fa fa-file-excel"></i></button>
                            </div>
                         </div>

                    </div>

                  
                        <div class="card-body table-responsive" id="search_record">

                        </div>

                   

                </div>
            </div>



        </div>

    </div>

</section>


<script>
function searchStudentForIDcard() {
    var statusForIdCard = document.getElementById("statusForIdCard").value;
    var fromDateForIdCard = document.getElementById("fromDateForIdCard").value;
    var toDateFromIdCard = document.getElementById("toDateFromIdCard").value;
    var RollNo = document.getElementById("RollNo").value;
    if (statusForIdCard != '') {

        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 245;
        $.ajax({
            url: "action_g.php ",
            type: "POST",
            data: {
                code: code,
                statusForIdCard: statusForIdCard,
                fromDateForIdCard: fromDateForIdCard,
                toDateFromIdCard: toDateFromIdCard,
                RollNo: RollNo
            },
            success: function(response) {
                set_count_verifed(statusForIdCard, fromDateForIdCard, toDateFromIdCard);
                document.getElementById("search_record").innerHTML = response;
                spinner.style.display = 'none';

            },
            error: function() {
                // alert("error");
            }
        });
    } else {
        ErrorToast('Please Select status/date', 'bg-warning');

    }

}


function viewLeaveModalSmartCard(id) {
    //  alert(id);
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 143;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            //  console.log(response);
            spinner.style.display = 'none';
            document.getElementById("view_record").innerHTML = response;

        }
    });

}


function applied_idcard(id) {

    var code = 246;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            searchStudentForIDcard();
            viewLeaveModalSmartCard(id);

            if (response == '1') {
                SuccessToast('Successfully Applied');

            } else {

            }

        }
    });

}

function left_idcard(id) {

    var code = 247;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            searchStudentForIDcard();
            viewLeaveModalSmartCard(id);
            if (response == '1') {
                SuccessToast('Successfully Left');

            } else {

            }

        }
    });

}

function verify_idcard(id) {

    var code = 145;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            searchStudentForIDcard();
            viewLeaveModalSmartCard(id);
            if (response == '1') {
                SuccessToast('Success Verifiy');

            } else {

            }

        }
    });

}

function printSmartCardForStudent(id) 
{
    var code = 248;
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
                window.open("printSmartCardStudent.php?id=" + id+"&code="+1, '_blank');
                searchStudentForIDcard();
            } else {
                ErrorToast(response, 'bg-warning');
            }

        }
    });
}

function printSingleSmartCardForStudent(id) 
{
    var code = 248;
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
                window.open("printSmartCardStudent.php?id=" + id+"&code="+2, '_blank');
                searchStudentForIDcard();
            } else {
                ErrorToast(response, 'bg-warning');
            }

        }
    });
}


function exportPdfSmartCard() 
{
    var statusForIdCard = document.getElementById("statusForIdCard").value;
    var fromDateForIdCard = document.getElementById("fromDateForIdCard").value;
    var toDateFromIdCard = document.getElementById("toDateFromIdCard").value;
    var RollNo = document.getElementById("RollNo").value;
    if (statusForIdCard != '') {
    
        window.open("smartcardpdf.php?status="+statusForIdCard+"&from="+fromDateForIdCard+"&to="+toDateFromIdCard, '_blank');
    } else {
        ErrorToast('Please Select status/date', 'bg-warning');

    }

           }
   
function exportExcelSmartCard() 
{
   var statusForIdCard = document.getElementById("statusForIdCard").value;
    var fromDateForIdCard = document.getElementById("fromDateForIdCard").value;
    var toDateFromIdCard = document.getElementById("toDateFromIdCard").value;
    var RollNo = document.getElementById("RollNo").value;
    if (statusForIdCard != '') {
        var code = 38;
        window.open("export.php?status=" + statusForIdCard+"&from="+fromDateForIdCard+"&to="+toDateFromIdCard+"&exportCode="+code, '_blank');
    } else {
        ErrorToast('Please Select status/date', 'bg-warning');

    }
}

function set_count_verifed(status, from, to) {
    var code = 249;
    //  var spinner=document.getElementById('div-loader');
    //      spinner.style.display='block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            status: status,
            from: from,
            to: to
        },
        success: function(response) {


            // spinner.style.display='none';
            document.getElementById("verified_count").innerHTML = response;

        }
    });

}

function left_idcard(id) {

    var code = 247;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            searchStudentForIDcard();
            viewLeaveModalSmartCard(id);
            if (response == '1') {
                SuccessToast('Success Verifiy');

            } else {

            }

        }
    });

}

function reject_idcard(id) {

    var remarks = document.getElementById('Remarks' + id).value;
    //  alert(remarks);
    if (remarks != '') {
        var code = 146;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                id: id,
                remarks: remarks
            },
            success: function(response) {
                searchStudentForIDcard();
                viewLeaveModalSmartCard(id);

                if (response == '1') {
                    SuccessToast('Successfully Rejected');

                } else {

                }

            }
        });
    } else {
        ErrorToast('Enter Remarks', 'bg-warning');
    }

}
</script>
<p id="ajax-loader"></p>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="view_record">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ViewLeaveexampleModal" tabindex="-1" role="dialog"
    aria-labelledby="ViewLeaveexampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewLeaveexampleModalLabel">View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="view_leave_table_load">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button type="button" onclick="UpdateLeave();" class="btn btn-success">Update</button>

            </div>
        </div>
    </div>
</div>
<?php
   include "footer.php"; 
   
    ?>