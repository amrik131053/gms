<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-info">
                    <div class="card-header ">
                        <!-- <h3 class="card-title">Permissions</h3> -->
                        <span style="float:right;">

                            <button class="btn btn-sm ">
                                <select class="form-control form-control-sm" id="exam_type">
                                    <option value="">Select</option>
                                    <?php 
                                                $sql="SELECT DISTINCT id,Name from DDL_TheroyExamination  ";
                                       $stmt2 = sqlsrv_query($conntest,$sql);
                                 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                       {?>
                                    <option value="<?=$row1['id'];?>"><?=$row1['Name'];?></option>
                                    <?php }?>
                                </select>
                            </button>
                            <input type="button" class="btn btn-secondary btn-sm"
                                onclick="open_examination_permision_search();" value="Search">
                            <input type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                data-target="#modalAssignAllpER" value="Add">
                        </span>
                    </div>
                    <div class="card-body table-responsive  ">
                        <div class="row" id="table_load" style="font-size:12px;"> </div>

                    </div>
                </div>



                <div class="card card-info">
                    <div class="card-header ">
                        <!-- <h3 class="card-title">Distribution Theory Marks (Pending)</h3> -->
                        <span style="float:right;">
                        
                        <button class="btn btn-sm ">
                        <select class="form-control form-control-sm" id="exam_type">
                                    <option value="">Select</option>
                                    <?php 
                                                $sql="SELECT DISTINCT id,Name from DDL_TheroyExamination  ";
                                       $stmt2 = sqlsrv_query($conntest,$sql);
                                 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                       {?>
                                    <option value="<?=$row1['id'];?>"><?=$row1['Name'];?></option>
                                    <?php }?>
                                </select>
                        </button>
                        <input type="button" class="btn btn-secondary btn-sm"
                                    onclick="open_examination_permision_search();" value="Search">
                                    <input type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#modalAssignAllpER" value="Add">
                    </span>
                    </div>
                    <div class="card-body table-responsive  ">
                        <div class="row" style="font-size:12px;">
                                       </div>
                        <!-- <div class="row" id=""></div> -->





                    </div>



                </div>




            </div>


            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Examination Permission</h3>

                    </div>
                    <div class="card-body table-responsive  ">
                        <div class="row" style="font-size:12px;">

                            <table class="table">
                                <tr>
                                    <th>Examination </th>
                                    <th>Close Date</th>
                                    <th> Type</th>
                                    <th> Action</th>

                                </tr>
                                <?php $getExamPermission="SELECT * FROM ExamDate";
$getExamPermissionRun=sqlsrv_query($conntest,$getExamPermission);
while($getExamPermissionRow=sqlsrv_fetch_array($getExamPermissionRun))
{
   // $aa[]=$getExamPermissionRow;
?>
                                <tr>
                                    <td><?=$getExamPermissionRow['Month'];?> <?=$getExamPermissionRow['Year'];?> </td>
                                    <td><?=$getExamPermissionRow['LastDate']->format('d-m-Y');?></td>
                                    <td> <?=$getExamPermissionRow['Type'];?>
                                    </td>
                                    <td><button class="btn btn" data-toggle="modal" data-target="#editExamAllPermission"
                                            onclick="editExam(<?=$getExamPermissionRow['id'];?>);"><i
                                                class="fa fa-edit"></i></button></td>

                                </tr>
                                <?php }
   // print_r($aa);
   ?>
                            </table>

                        </div>

                        <br>
                        <div class="row" id=""></div>





                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Special Permission</h3>

                    </div>
                    <div class="card-body table-responsive  ">
                        <div class="row">
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="RollNo">
                            </div>
                            <div class="col-lg-2">
                                <input type="button" class="btn btn-secondary"
                                    onclick="open_examination_permision_search();" value="Search">

                            </div>
                            <div class="col-lg-2">
                                <input type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#modalAssignAllpER" value="Add">
                            </div>
                        </div>
                        <br>
                        <div class="row" id="" style="font-size:12px;"></div>

                    </div>
                </div>
            </div>

        </div>







    </div>


</section>
<p id="ajax-loader"></p>


<div class="modal fade" id="editExamAllPermission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body" id="editExamPermisson">

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal_edit_permission_exam" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body" id="edit_start_end_date_load">

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAssignAllpER" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body" id="edit_start_end_date_load">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <label>Type</label>
                        <select class="form-control" id="load_semester">
                            <option value="">Select</option>
                            <?php 
                                       $sql="SELECT DISTINCT id,Name from DDL_TheroyExamination  ";
                              $stmt2 = sqlsrv_query($conntest,$sql);
                        while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                              {?>
                            <option value="<?=$row1['id'];?>"><?=$row1['Name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-lg-12">
                        <label>Semster</label><br>
                        <div class="row text-center">
                            <div class="col-lg-2 col-sm-6 custom-control custom-checkbox">1
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="1">2
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="2">
                            </div>
                            <div class="col-lg-2 col-sm-6 custom-control custom-checkbox">3
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="3">4
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="4">
                            </div>
                            <div class="col-lg-2 col-sm-6 custom-control custom-checkbox">5
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="5">6
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="6">
                            </div>
                            <div class="col-lg-2 col-sm-6 custom-control custom-checkbox">7
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="7">8
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="8">
                            </div>
                            <div class="col-lg-2 col-sm-6 custom-control custom-checkbox">9
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="9">10
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="10">
                            </div>
                            <div class="col-lg-2 col-sm-6 custom-control custom-checkbox">11
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="11">12
                                <input type="checkbox" class="form-control  sel" id="customCheckbox4" value="12">
                            </div>
                        </div>

                        <p id="sem_"></p>

                    </div>
                    <div class="col-lg-12">
                        <label>Start Date</label>
                        <input type="date" class="form-control" id="start_date">
                    </div>
                    <div class="col-lg-12">
                        <label>End Date</label>
                        <input type="date" class="form-control" id="end_date">
                    </div>
                    <div class="col-lg-12">
                        <label>Action</label><br>
                        <input type="button" onclick="open_examination_permision();" class="btn btn-warning"
                            value="Update">

                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<script type="text/javascript">
function update_date_end_date(id, Semester) {
    var start_date_edit = document.getElementById('start_date_edit').value;
    var end_date_edit = document.getElementById('end_date_edit').value;
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(exam_type);
    var code = 223;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            id: id,
            sem: Semester,
            start_date_edit: start_date_edit,
            end_date_edit: end_date_edit
        },
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            if (response == '1') {
                SuccessToast('Successfully Update');
                open_examination_permision_search();
            } else {
                ErrorToast('Input Wrong ', 'bg-danger');
            }


        }
    });
}

function editExam(id) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 265;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            document.getElementById("editExamPermisson").innerHTML = response;

        }
    });
}

function edit_start_end_date(id, Semester) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(exam_type);
    var code = 222;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            id: id,
            sem: Semester
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            document.getElementById("edit_start_end_date_load").innerHTML = response;

        }
    });
}

function open_examination_permision_search() {
    var exam_type = document.getElementById('exam_type').value;
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(exam_type);
    var code = 214;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            exam_type: exam_type
        },
        success: function(response) {

            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;

        }
    });
}

function open_examination_permision() {
    var exam_type = document.getElementById('load_semester').value;
    var start_date = document.getElementById('start_date').value;
    var end_date = document.getElementById('end_date').value;
    var id_array = document.getElementsByClassName('sel');
    var len_id = id_array.length;
    var id_array_main = [];
    var code = 1;
    for (i = 0; i < len_id; i++) {
        if (id_array[i].checked === true) {
            id_array_main.push(id_array[i].value);
        }
    }
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(exam_type);
    var code = 221;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            id_array_main: id_array_main,
            exam_type: exam_type,
            start_date: start_date,
            end_date: end_date
        },
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            // document.getElementById("sem_").innerHTML=response;
            if (response == '1') {
                SuccessToast('Successfully Update');

            } else {
                ErrorToast('Input Wrong ', 'bg-danger');
            }

        }
    });
}
</script>

<?php include "footer.php";  ?>