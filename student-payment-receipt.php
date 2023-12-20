<?php  
   include "header.php";   
   ?>
<script type="text/javascript">

function searchStudentPayment() {
    var code_access = '<?php echo $code_access; ?>';
    var IDNoRollNO = document.getElementById('IDNoRollNO').value;
    if (IDNoRollNO != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 316;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                code_access: code_access,
                IDNoRollNO: IDNoRollNO
            },
            success: function(response) {
                spinner.style.display = 'none';
                document.getElementById("show_record1").innerHTML = response;
                document.getElementById('show_record').innerHTML = "";

            }
        });
    }
}





function printEmpIDCard(id) {
    var code = 2;
    if (id != '') {
        //  window.location.href="printSmartCardEmp.php?code="+code+"&id="+id,'_blank';
        window.open("print-admission-from.php?code=" + code + "&IDNo=" + id, '_blank');
    } else {
        alert("Select ");
    }

}

function printSmartCardForStudent(id) {
    var code = 248;
    var print = 0;
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
                window.open("printSmartCardStudent.php?id=" + id + "&code=" + 1 + "&print=" + 0, '_blank');
                searchStudentForIDcard();
            } else {
                ErrorToast(response, 'bg-warning');
            }

        }
    });
}
</script>
<div class="modal fade" id="Updatestudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='student_record_for_update' style="text-align:center">

            </div>
            <div class="card-body" id="student_search_recordold" style="font-size:12px;">


            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="UpdateDesignationModalCenter21" tabindex="-1" role="dialog"
    aria-labelledby="UpdateDesignationModalCenter21" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='updateRecord'>
            </div>




        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="card card-outline">
            <div class="card-header">
                <span style="float:right;">
                    <button class="btn btn-sm ">
                        <input type="search" class="form-control form-control-sm" name="IDNoRollNO" id="IDNoRollNO"
                            placeholder="Search here">
                    </button>
                    <button type="button" onclick="searchStudentPayment();" class="btn btn-success btn-sm">
                        Search
                    </button>
                </span>

                <input type="hidden" id="CollegeID_Set">


            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <form action="action_g.php" method="post" enctype="multipart/form-data">
                    <div class="table-responsive" id="show_record1" style="height:auto;">
                        <!-- Your table to display employee records goes here -->
                    </div>
                    <div class="table-responsive" id="show_record" style="height:auto;">
                        <!-- Your table to display employee records goes here -->
                    </div>
                </form>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->



            <!-- Additional footer content if needed -->
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

<p id="ajax-loader"></p>

<!-- Modal -->
<?php include "footer.php"; ?>