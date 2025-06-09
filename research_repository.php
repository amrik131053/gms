<?php 
  ini_set('max_execution_time',0);
  include "header.php";   
?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-3 col-lg-3 col-sm-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">New Paper</h3>
                    </div>
                    <form action="action_research.php" method="post">
                        <input type="hidden" value="3" name="code">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="inputEmail3" class=" col-form-label">IDNo</label>

                                    <input type="text" name="IDNo" id="IDNo" class="form-control" onkeyup="">

                                </div>

                                <div class="col-lg-12">
                                    <label for="inputEmail3" class=" col-form-label">Paper Title</label>
                                    <textarea class="form-control" id="pprTitle" name="pprTitle"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label for="inputEmail3" class=" col-form-label">Author Name</label>
                                    <input type="text" id="pprAuth" name="pprAuth" required class="form-control">
                                </div>



                                <div class="col-lg-12">
                                    <label for="inputEmail3" class=" col-form-label">Faculty</label>
                                    <label>College</label>
                                    <select name="facultyId" id='College' onchange="courseByCollege(this.value)"
                                        class="form-control" required="">
                                        <option value=''>Select Course</option>
                                        <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $college = $row1['CollegeName']; 
     $CollegeID = $row1['CollegeID'];
    ?>
                                        <option value="<?=$CollegeID;?>"><?= $college;?></option>
                                        <?php    }

?>
                                    </select>
                                </div>


                                <div class="col-lg-12">
                                    <label for="inputEmail3" class=" col-form-label">Name of Journal </label>
                                    <input type="text" name="pprJournal" required class="form-control">
                                </div>

                                <div class="col-lg-12">
                                    <label for="inputEmail3" class=" col-form-label">Date of Publication </label>
                                    <input type="date" name="pprPublish" required class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <label for="inputEmail3" class=" col-form-label">DOI /Link </label>
                                    <input type="text" name="pprLink" required class="form-control">
                                </div>

                                <div class="col-lg-12">
                                    <label for="inputEmail3" class=" col-form-label">Attachment</label>
                                    <input type="file" name="pprAttach" required class="form-control">
                                </div>


                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-success"
                                onclick="uploadSubmit(this.form);">Upload</button>
                        </div>
                        <!-- /.card-footer -->
                    </form>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-3">
            <div class="card">
  <div class="card-header">
   <div class="col-lg-2">
      <input type="text" id="search_text" class="form-control" placeholder="Search by title or name or idno" onkeyup="load_data(1)">
   </div>
  </div>
  <div class="card-body table-responsive p-0" style="height: 700px;">
    <div id="search_record"></div>
  </div>
  <div class="card-footer text-center" id="pagination_area">
    <!-- Pagination will be injected here -->
  </div>
</div>


         

            </div>
        </div>
    </div>

</section>
<div class="modal fade" id="exampleModal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Paper </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- <input type="hidden" name="code" value="19"> -->
            <div class="modal-body" id="upload_paper">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-primary">Save</button> -->
            </div>

        </div>
    </div>
</div>



<script type="text/javascript">
load_data();

function load_data(page = 1) {
  var spinner = document.getElementById("ajax-loader");
  spinner.style.display = 'block';
  var search = document.getElementById("search_text").value;

  $.ajax({
    url: 'action_research.php',
    type: 'POST',
    data: {
      code: '1',
      page: page,
      search: search
    },
    success: function(data) {
      spinner.style.display = 'none';
      var response = JSON.parse(data);
      document.getElementById("search_record").innerHTML = response.table;
      document.getElementById("pagination_area").innerHTML = response.pagination;
    }
  });
}


function updatePpr(id) {

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '2';
    $.ajax({
        url: 'action_research.php',
        data: {
            code: code,
            id: id
        },
        type: 'POST',
        success: function(data) {
            spinner.style.display = 'none';

            document.getElementById("upload_paper").innerHTML = data;
        }
    });
}

function uploadSubmit(form) {

    var IDNo = form.IDNo.value;
    var pprTitle = form.pprTitle.value;
    var pprAuth = form.pprAuth.value;
    var facultyId = form.facultyId.value;
    var pprJournal = form.pprJournal.value;
    var pprPublish = form.pprPublish.value;
    var pprLink = form.pprLink.value;
    var pprAttach = form.pprAttach.value;

    if (IDNo === "") {

        ErrorToast('Please enter IDNo.', 'bg-warning');
        return;
    }
    if (facultyId === "") {

        ErrorToast('Please select college.', 'bg-warning');
        return;
    }
    if (pprTitle === "") {

        ErrorToast('Please enter Title.', 'bg-warning');
        return;
    }
    if (pprAuth === "") {

        ErrorToast('Please enter auth.', 'bg-warning');
        return;
    }
    if (pprJournal === "") {

        ErrorToast('Please enter Journal.', 'bg-warning');
        return;
    }
    if (pprPublish === "") {

        ErrorToast('Please enter Publish.', 'bg-warning');
        return;
    }

    if (pprLink === "") {

        ErrorToast('Please enter Link file', 'bg-warning');
        return;
    }
    if (pprAttach === "") {

        ErrorToast('Please choose attach file', 'bg-warning');
        return;
    }

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
                SuccessToast('Submit successfully');
                load_data();
                document.getElementById("IDNo").value = "";
                document.getElementById("pprTitle").innerHTML = "";
                document.getElementById("pprAuth").value = "";
                document.getElementById("College").innerHTML = "";

            } else if (response == 2) {
                ErrorToast('Please upload the file in (.PDF) format only.', 'bg-warning');
            } else {
                ErrorToast('Please try after sometime.', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }

    });
}

function uodateSubmit(form) {

    var pprTitle = form.pprTitleupdate.value;
    var pprAuth = form.pprAuthupdate.value;
    var pprJournal = form.pprJournalupdate.value;

    var pprAttach = form.pprAttachupdate.value;

    if (pprTitle === "") {

        ErrorToast('Please enter Title.', 'bg-warning');
        return;
    }
    if (pprAuth === "") {

        ErrorToast('Please enter auth.', 'bg-warning');
        return;
    }
    if (pprJournal === "") {

        ErrorToast('Please enter Journal.', 'bg-warning');
        return;
    }

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
                SuccessToast('Update successfully');
                load_data();
            } else if (response == 2) {
                ErrorToast('Please upload the file in (.PDF) format only.', 'bg-warning');
            } else {
                ErrorToast('Please try after sometime.', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }

    });
}
</script>

<?php include "footer.php";  ?>