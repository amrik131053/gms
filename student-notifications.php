<?php  
   include "header.php";   
   ?>
<script type="text/javascript">
function uploadNotice(form) {
    

    var subject = form.subject.value;
    var details = form.details.value;
    var file = form.fileatt.value;

if (subject === "") {

    ErrorToast('Please Enter Subject.', 'bg-warning');
    return;
}
if (details === "") {

    ErrorToast('Please Enter Details.', 'bg-warning');
    return;
}
if (file === "") {

    ErrorToast('Please choose file.', 'bg-warning');
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
            showAll();
            // console.log(response);
            if (response == 1) {
                SuccessToast('Successfully Uploaded');
                document.getElementById("subject").value = "";
                document.getElementById("details").value = "";
                document.getElementById("fileAtt").value = "";
            } else if (response == 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else {

            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function uploadOfficeOrder(form) {
    var subject = form.subject.value;
    var details = form.details.value;
    var file = form.fileatt.value;

if (subject === "") {

    ErrorToast('Please Enter Subject.', 'bg-warning');
    return;
}
if (details === "") {

    ErrorToast('Please Enter Details.', 'bg-warning');
    return;
}
if (file === "") {

    ErrorToast('Please choose file.', 'bg-warning');
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
            showAll();
            if (response == 1) {
                SuccessToast('Successfully Uploaded');
                document.getElementById("subject").value = "";
                document.getElementById("details").value = "";
                document.getElementById("fileAtt").value = "";
            } else if (response == 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else {

            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

$(window).on('load', function() {
    $('#btn1').toggleClass("bg-success");
   
    notice();
    showAll();


})

function bg(id) {
    $('.btn').removeClass("bg-success");
    $('#' + id).toggleClass("bg-success");
}


function notice()
{
    var spinner = document.getElementById('ajax-loader');
        spinner.style.display = 'block';
    var code = 317;
 
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
        }
    });
}
function officeOrder()
{    var spinner = document.getElementById('ajax-loader');
        spinner.style.display = 'block';
    var code = 318;
   
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
        }
    });

}
function showAll()
{    var spinner = document.getElementById('ajax-loader');
        spinner.style.display = 'block';
    var code = 321;
   
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            isAdmin: '0'
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("show_record1").innerHTML = response;
        }
    });

}
function showALlAdmin()
{    var spinner = document.getElementById('ajax-loader');
        spinner.style.display = 'block';
    var code = 321;
   
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            isAdmin: '1'
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("show_record1").innerHTML = response;
        }
    });

}

function deleteNotice(id,type){
    var a = confirm('Are you sure you want to delete');

if (a == true) {
    var code = 322;
    var spinner = document.getElementById('ajax-loader');
        spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            type: type,
            id: id
        },
        success: function(response) {
            if (response == 1) {
                spinner.style.display = 'none';
                SuccessToast('SuccessFully Deleted');
                showAll();
                
            }

        }
    });
} else {

}
}
</script>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
           
              <div class="card-header">

                
              <h3 class="card-title">Order </h3>
</div>
                    <div class=" card card-primary">
                    <div class="btn-group w-100 mb-2">
                        <a class="btn btn-primary" id="btn1"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="notice(),bg(this.id);"> Notice </a>
                        <a class="btn btn-primary" id="btn2"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="officeOrder(),bg(this.id);"> Office Order </a>
                     

                    </div>

                    <div id="table_load" class="table-responsive" >

                  
                    </div>
                   



                </div>
              
              
                <!-- /.card-body -->
            </div>
       
        <!-- /.col -->
        <div class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
            <div class="card ">

                <div class="card-header">
                  

                  Uploaded 
                  <div class="card-tools">
                    <?php if($code_access=='111'){ ?>
                    <button  class="btn btn-success btn-xs" onclick="showALlAdmin();">Show All</button>
                    <?php }?>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                   
                        <div class="table-responsive" id="show_record1" style="height:auto;">
                            <!-- Your table to display employee records goes here -->
                        </div>
                      
                    
                    <!-- /.mail-box-messages -->
                </div>
                <!-- /.card-body -->



                <!-- Additional footer content if needed -->
            </div>
        </div>
        <!-- /.card -->
    </div>

    <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<p id="ajax-loader"></p>

<!-- Modal -->
<?php include "footer.php"; ?>