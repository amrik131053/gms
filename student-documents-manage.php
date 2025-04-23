<?php 
   include "header.php";   
   ?>
<style>
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked+.slider {
    background-color: #28a745;
}

input:checked+.slider:before {
    transform: translateX(26px);
}
</style>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                        <div class="d-flex align-items-center gap-2 mb-3" style="max-width: 500px;">
                            <select name="College" id="CollegeID" class="form-control me-2" required>
                                <option value="">Select</option>
                                <?php
        $sql = "SELECT DISTINCT MasterCourseCodes.CollegeName, MasterCourseCodes.CollegeID 
                FROM MasterCourseCodes  
                INNER JOIN UserAccessLevel 
                ON UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID";
        $stmt2 = sqlsrv_query($conntest, $sql);
        while ($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) { 
            $college = $row1['CollegeName']; 
            $CollegeID = $row1['CollegeID'];
        ?>
                                <option value="<?= $CollegeID; ?>"><?= $college; ?> (<?= $CollegeID; ?>)</option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-success" onclick="searchDocumentsCollege();">Search</button>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive" id="show_record">

                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->
<script>



function searchDocumentsCollege() {
    var collegeid = document.getElementById('CollegeID').value;
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '31';
    $.ajax({
        url: 'action_a.php',
        data: {
            flag: code,
            collegeid: collegeid
        },
        type: 'POST',
        success: function(data) {
            spinner.style.display = 'none';
            document.getElementById("show_record").innerHTML = data;
        }
    });
}


$(document).on('change', '.toggle-status', function() {
    var DocumentID = $(this).data('serial');
    var newStatus = $(this).is(':checked') ? 1 : 0;
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 32;
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: {
            DocumentID: DocumentID,
            is_active: newStatus,
            flag: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            if (response == 1)
                SuccessToast('Status updated successfully');
        },
        error: function() {
            ErrorToast('Failed to update status.', 'bg-danger');
        }
    });
});
</script>

<?php include "footer.php";  ?>