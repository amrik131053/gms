<?php 
  include "header.php";   
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12  col-sm-12 col-lg-12">
                <div class="card card-primary">
                    <div class="btn-group w-100 mb-2">
                        <a class="btn btn-primary" id="btn1"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="newAdmission(),bg(this.id);"> New Admission </a>
                        <a class="btn btn-primary" id="btn2"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="oldAdmission(),bg(this.id);"> Old Admission  </a>
                    </div>
                    <div class="card-body" id="admissionForm" style="">


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.col -->
</section>
<p id="ajax-loader"></p>

<?php   include "footer.php";   ;?>
<script>
$(window).on('load', function() {
    $('#btn1').toggleClass("bg-success");
    newAdmission();
})

function bg(id) {
    $('.btn').removeClass("bg-success");
    $('#' + id).toggleClass("bg-success");
}

function newAdmission() 
{
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
function oldAdmission() 
{
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
            // console.log(data);
            if (data != "") {
                $("#CollegeID").html("");
                $("#CollegeID").html(data);
                document.getElementById('Batch').value="";
            }
        }
    });
}
function fetchcourse() {
    var College = document.getElementById('CollegeID').value;
    var Session = document.getElementById('Session').value;
    var code = 351;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Session: Session,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {
                $("#Course").html("");
                $("#Course").html(data);
                document.getElementById('Batch').value="";
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
            // console.log(data);
          
               
            document.getElementById('Batch').value=data;
            fatchRollNo();
            
        }
    });
}
function fatchRollNo() {
    var College = document.getElementById('CollegeID').value;
    var Course = document.getElementById('Course').value;
    var Session = document.getElementById('Session').value;
    var code = 353;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Course: Course,
            Session: Session,
            code: code
        },
        type: 'POST',
        success: function(data) {
            console.log(data);
            document.getElementById('RollNo').value=data;
            
        }
    });
}



function adharPassChnage(id)
{
   // alert(id);
   if (id=='Indian')
    {
   $('#AdharCard').show();
   $('#IDNoNationlity').hide();
   document.getElementById('IDNoNationlity').value="";
    }
    else if(id=='NRI')
    {
   $('#PassportNo').show();
    $('#AdharCard').hide();
    $('#IDNoNationlity').hide();
    document.getElementById('IDNoNationlity').value="";
    document.getElementById('AdharCard').value="";

    }
    else if(id=='Nepal')
    {
        $('#IDNoNationlity').show();
    $('#AdharCard').hide();
    document.getElementById('AdharCard').value="";

    }
    else if(id=='Bhutan')
    {
        $('#IDNoNationlity').show();
    $('#AdharCard').hide();
    document.getElementById('AdharCard').value="";

    }

}

function leaveSubmit(form) {

    var leaveType = form.LeaveType.value;
    var leaveShort = form.leaveShort.value;
    var leaveReason = form.leaveReason.value;
    var leaveFile = form.leaveFile.value;
    var leaveShift = form.leaveShift.value;
    var leaveHalfShortRadio = form.leaveHalfShortRadio.value;

    if (leaveType === "") {

        ErrorToast('Please select a Leave Type.', 'bg-warning');
        return;
    }
    if (leaveHalfShortRadio != 'Full') {
        if (leaveShort === "") {

            ErrorToast('Please select a Leave Duration.', 'bg-warning');
            return;
        }
        if (leaveShift === "") {

            ErrorToast('Please select a Leave Shift F/S.', 'bg-warning');
            return;
        }
    }
    if (leaveReason.trim() === "") {

        ErrorToast('Please enter a Leave Reason.', 'bg-warning');
        return;
    }

    if (leaveFile === "") {

        ErrorToast('Please upload an Adjustment File.', 'bg-warning');
        return;
    }

    var submitButton = form.querySelector('input[name="leaveButtonSubmit"]');
    submitButton.disabled = true;
    submitButton.value = "Submitting...";

    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            if (response == 1) {
                SuccessToast('Leave submit successfully');
                pendingLeaves();
                document.getElementById("LeaveType").value = "";
                document.getElementById("leaveShort").value = "";
                document.getElementById("leaveReason").innerHTML = "";

            } else if (response == 2) {
                ErrorToast('one leave already pending to Sanction authority.', 'bg-warning');
            } else if (response == 3) {
                ErrorToast("you can't apply back date leave.", 'bg-warning');
            } else if (response == 4) {
                ErrorToast("you con't apply more than one leave same day ", 'bg-warning');
            } else if (response == 5) {
                ErrorToast('Can`t apply leave more then balance.', 'bg-warning');
            }
            else{
                ErrorToast('Please try after sometime.', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        },
        complete: function() {
            submitButton.disabled = false;
            submitButton.value = "Submit";
        }
    });
}
</script>
</body>

</html>