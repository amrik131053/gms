<?php
include "header.php";
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-outline">
                    <div class="card-header">

                        <div class="card-tools">
                            <form action="action_g.php" method="post" enctype="multipart/form-data">
                                <div class="input-group ">
                                    <input type="file" name="fileCertificate" class="form-control form-control-sm">
                                    <input type="hidden" name="code" value="374">
                                    <div class="input-group-append">
                                        <button type="button" onclick="uploadCertificate(this.form);"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-upload"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <div class="card-body">
                        <div class="card-body table-responsive" id="allIploadedCertificate">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<div class="modal fade" id="certificateSettingsModal" tabindex="-1" role="dialog"
    aria-labelledby="certificateSettingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="certificateSettingsModalLabel">View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <p id="demo"></p>
            <div style="border: 1px solid black;padding:8px" onclick="showCoords(event)" id="viewCertificateForSetting">
            <p>Mouse over this box to display the horizontal and vertical coordinates of the mouse pointer.</p>
</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php   $code_access; if ($code_access=='010' || $code_access=='011' || $code_access=='110' || $code_access=='111') 
                                         {?>
                <button type="button" onclick="UpdateLeave();" class="btn btn-success">Update</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script>
load_certifiacte_data();

function load_certifiacte_data() {
    var code = 373;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            document.getElementById("allIploadedCertificate").innerHTML = response;

        }
    });

}


function uploadCertificate(form) {

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
                SuccessToast('Uploaded successfully');
                load_certifiacte_data();
            } else {
                ErrorToast('Please try after sometime.', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }

    });
}

function deleteCertificate(id) {
    var a = confirm('Are you sure you want to delete  ');
    if (a == true) {
        var code = 375;
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
                if (response == 1) {
                    load_certifiacte_data();
                    SuccessToast('SuccessFully Deleted');
                } else {
                    ErrorToast('try again', 'bg-danger');
                }
            }
        });
    }

}

function viewCertificateForSetting(id) {
   
    // var spinner = document.getElementById('ajax-loader');
    // spinner.style.display = 'block';
    // $.ajax({
    //     url: 'action_g.php',
    //     type: 'POST',
    //     data: {
    //         code: code,
    //         id: id
    //     },
    //     success: function(response) {
            // console.log(response);
            // spinner.style.display = 'none';
            window.open("certificate-setting1.php?id=" + id, '_blank');
            
        }
    // });
// }
function showCoords(event) {
    let cX = event.clientX;
  let cY = event.clientY;
  let sX = event.screenX;
  let sY = event.screenY;
  let coords1 = "clientX: " + cX + ", clientY: " + cY;
  let coords2 = "screenX: " + sX + ", screenY: " + sY;
  document.getElementById("demo").innerHTML = coords1 + "<br>" + coords2;
}


</script>















<?php
include "footer.php";
?>