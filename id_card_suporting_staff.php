<?php 
include "header.php";
include "connection/connection.php";
?>
<p id="ajax-loader"></p>
<script src="plugins/webcam.js/webcam.js"> </script>
<section class="content">
    <div class="container-fluid">


        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Supporting Staff</h3>
                <div class="card-tools">
                    <button class="btn btn-success" data-toggle="modal" data-target="#addrecordModal"
                        >
                        New
                    </button>
                </div>
            </div>

            <!-- /.card-header -->
           
        </div>
    </div>

    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><strong>Date: </strong> <?php echo date('d-M-Y'); ?>
                    <!-- <strong>Time: </strong> <span id="timestamp"></span> -->
                </h3>
                <div class="card-tools">
                    <!-- <a class="btn" style="background-color:#223260; color: white; border: 1px solid;" onclick="showVisitors();"> Show </a>
                      <a class="btn" style="background-color:#223260; color: white; border: 1px solid;" onclick="ID_card();bg(this.id);"> Print </a> -->
                    <a class="btn" style="background-color:#223260; color: white; border: 1px solid;"
                        onclick="showVisitors_mess();"> Show </a>
                    <a class="btn" style="background-color:#223260; color: white; border: 1px solid;"
                        onclick="onspot_ID_card();bg(this.id);"> Print </a>
                </div>

            </div>
            <div class="card-body" id="checked_out_students">

                <?php


?>

                </tbody>
                </table>
            </div>

        </div>

        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
    </div>
    </div>
    </div>
</section>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Capture Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-responsive  " border="1">
                    <tr style="background-color: #223260; color: white;">
                        <th colspan="2">
                            <center>Capture Image</center>
                        </th>
                    </tr>
                    <tr>
                        <form id="image-upload" action="action.php" method="post" enctype="multipart/form-data">
                            <td>
                                <input type="hidden" name="userImage" class="image-tag">
                                <div id="my_camera"></div>
                            </td>
                            <td>
                                <div id="results">
                                    <img src="dummy-user.png" width="280px" height="320px">

                                </div><br>
                            </td>

                        </form>
                    </tr>

                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-xs" type=button data-dismiss="modal"
                    value="Take Snapshot" onClick="take_snapshot()">Capture</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default_edit">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_show">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-xs" type=button data-dismiss="modal"
                    value="Take Snapshot" onClick="submit()">Update</button>
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
<div class="modal fade" id="addrecordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="image-upload" name="image-upload" action="action_g.php" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row" id="">
                        <input type="hidden" name="code" value="405">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label>Father Name</label>
                                <input type="text" class="form-control" name="father_name" id="father_name">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" id="designation">
                            </div>


                            <div class="col-lg-6 col-md-6">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label>Image</label>
                                <input type="file" name="image" id="image" class="form-control input-group-sm">
                            </div>

                        </div>
                        <div id="result"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="uploadImage(this.form)">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">

function view_image(id) {
   var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
   //  alert(id);
    var code = 403;
    $.ajax({
        url: 'action_g.php',
        type: 'post',
        data: {
            ID: id,
            code: code
        },
        success: function(response) {
         spinner.style.display = 'none';
            //    console.log(response);
            document.getElementById("image_view").innerHTML = response;
        }
    });
}

function uploadImage(form, id) {
   var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
         spinner.style.display = 'none';
            // console.log(response);

            SuccessToast('Successfully');
          
             showVisitors_mess();
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function showVisitors_mess() {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(id);
    var code = 277;
    $.ajax({
        url: 'action.php',
        type: 'post',
        data: {
            code: code
        },
        success: function(response) {
            spinner.style.display = 'none';

            document.getElementById("checked_out_students").innerHTML = response;
        }
    });
}


function onspot_ID_card() {

    var id_array = document.getElementsByClassName('sel');
    var len_id = id_array.length;
    var id_array_main = [];
    var code = 4;
    for (i = 0; i < len_id; i++) {
        if (id_array[i].checked === true) {
            id_array_main.push(id_array[i].value);
        }
    }
    window.open('print_id_card_pass.php?id_array=' + id_array_main + '&code=' + code, '_blank');
}

function edit_data(id) {
   var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 278;
    $.ajax({
        url: 'action.php',
        type: 'post',
        data: {
            id: id,
            code: code
        },
        success: function(response) {
         spinner.style.display = 'none';
            document.getElementById("edit_show").innerHTML = response;


        }
    });

}

function submit() {
    var student_roll_no = document.getElementById("student_roll_no1").value;
    var name = document.getElementById("name1").value;
    var designation = document.getElementById("designation1").value;
    var father_name = document.getElementById("father_name1").value;
    var address = document.getElementById("address1").value;
    var contractor1 = document.getElementById("contractor1").value;
    var CollegeName1 = document.getElementById("CollegeName1").value;
    var code = 279;
    if (father_name != '' && name != '' && address != '' && designation != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        $.ajax({
            url: 'action.php',
            type: 'post',
            data: {
                code: code,
                student_roll_no: student_roll_no,
                name: name,
                father_name: father_name,
                designation: designation,
                address: address,
                contractor: contractor1,
                CollegeName: CollegeName1
            },
            success: function(data) {
               // console.log(data);
                spinner.style.display = 'none';
                if (data == 1) {
                    SuccessToast('Successfully Update');
                    showVisitors_mess()

                } else {

                }

            },
            error: function(data) {

            }
        });
    } else {
        ErrorToast('Enter All Required', 'bg-warning');
    }
}
</script>
<?php include "footer.php";

?>