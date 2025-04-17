<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row ">

        <div class="col-lg-3 col-md-3 col-sm-3">
    <div class="card card-info">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">All Batches</h3>
            <button class="btn btn-danger ms-auto" onclick="searchPrintedDMC()">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <div class="card-body" id="live_data">
        </div>
    </div>
</div>


        <!-- <div class="row"> -->

            <!-- left column -->
            <div class="col-lg-9 col-md-9 col-sm-9">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Students</h3>
                        <input type="hidden"  id="batchIDSet">
                    </div>

                    <!--  <form class="form-horizontal" action="" method="POST"> -->
                    <div class="card-body">
                        <div class="row ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="mr-2"><i class="fa fa-stop text-warning" aria-hidden="true"></i>
                                Pending</span>
                            <!-- <span class="mr-2"><i class="fa fa-stop text-white" style="border:1px solid black;"
                                    aria-hidden="true"></i> Pending</span> -->
                            <span><i class="fa fa-stop text-success" aria-hidden="true"></i> Printed</span>
                        </div>&nbsp;
                        <div id="live_data_record">


                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                    <!-- /.card-footer -->
                    <!-- </form> -->
                </div>
            </div>







        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->

<script>

function searchPrintedDMC() {
   
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
           spinner.style.display = 'none';
           document.getElementById("live_data").innerHTML = xmlhttp.responseText;
           //Examination_theory_types();
       }
   }
   xmlhttp.open("GET", "get_action.php?code=" + 75.1, true);
   xmlhttp.send();

}
searchPrintedDMC();
function searchDMConCLickPRinted(id,college,course,batch,sem,type,SGroup,examination) {

var spinner = document.getElementById("ajax-loader");
document.getElementById('batchIDSet').value=id;
spinner.style.display = 'block';
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        spinner.style.display = 'none';
        document.getElementById("live_data_record").innerHTML = xmlhttp.responseText;
        //Examination_theory_types();
    }
}
xmlhttp.open("GET", "get_action.php?college=" + college + "&course=" + course + "&batch=" + batch + "&sem=" +
    sem + "&examination=" + examination+ "&type=" + type + "&SGroup=" + SGroup+ "&id=" + id  + "&code=" + 76.1, true);
xmlhttp.send();


}
function ViewResultStudent(ID) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 456.1;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            ID: ID
        },
        success: function(response) {
            spinner.style.display = 'none';
            console.log(response);
            document.getElementById("ViewResultData").innerHTML = response;
            //  loadMainCount();
        }
    });
}

function applySerialNumbers() {
    let start = parseInt(document.getElementById('startSerial').value);
    if (isNaN(start)) {
        alert('Please enter a valid starting serial number');
        return;
    }

    let inputs = document.querySelectorAll('.dmc_srno_input');

    inputs.forEach((input, index) => {
        let serial = start + index;
        input.value = serial;
        let onchangeAttr = input.getAttribute('onchange');
        let match = onchangeAttr.match(/updateDmcSrno\([^,]+,\s*(\d+)\)/);
        if (match && match[1]) {
            let id = match[1];
            updateDmcSrno(serial, id);
        } else {
            console.warn("ID not found in onchange attribute:", onchangeAttr);
        }
    });
}



function updateDmcSrno(Srno,ID) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 472;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            Srno: Srno,
            ID: ID
        },
        success: function(response) {
            spinner.style.display = 'none';
            console.log(response);
            if(response==1)
           {
            SuccessToast('Successfully Update');
           }
          else{
            ErrorToast(response, 'bg-warning');
          }
            // document.getElementById("ViewResultData").innerHTML = response;
            //  loadMainCount();
        }
    });
}
function finalLock(ID) {
    var r = confirm("Do you really want to lock");
    if (r == true) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 473;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            ID: ID
        },
        success: function(response) {
            spinner.style.display = 'none';
            console.log(response);
            if(response==1)
           {
            SuccessToast('Successfully Lock');
           }
          else{
            ErrorToast(response, 'bg-warning');
          }
    
        }
    });
}
}

function DMCPrint(id,BatchID) {
    var BatchID=document.getElementById('batchIDSet').value;
    var verifiy = document.getElementsByClassName('v_check');
    var len_student = verifiy.length;
    var subjectIDs = [];
    for (i = 0; i < len_student; i++) {
        if (verifiy[i].checked === true) {
            subjectIDs.push(verifiy[i].value);
        }
    }
    if(id!='NA'){
        window.open('dmc_print.php?id_array='+id+ "&BatchID=" + BatchID,'_blank');    
    }
    else
    {
    if ((typeof subjectIDs[0] == 'undefined')) {
        ErrorToast(' Select atleast one Student', 'bg-warning');
    } else {
      
        window.open('dmc_print.php?id_array='+subjectIDs+ "&BatchID=" + BatchID,'_blank');    
    }
   }
}



</script>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Results</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_stu">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-xl " id="ViewResult" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Results</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ViewResultData">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<?php

 include "footer.php";  ?>