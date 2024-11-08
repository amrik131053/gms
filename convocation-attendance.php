<?php 
   include "header.php";   
   include "connection/connection_web.php"; 
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                    
                        <span class="mr-2"> <button class="btn btn-primary btn-sm"  style="background-color:#D0EDFF; color:black;" data-toggle="tooltip" ><span class="badge"   id="pendingCount"> </span> Absent</button> </span>
                        <!-- <span class="mr-2"> <button class="btn btn-danger btn-sm"  style="background-color:;" data-toggle="tooltip" > <span class="badge" id="rejectCount"> </span> Rejected</button> </span> -->
                        <!-- <span class=""> <button class="btn  btn-sm " style="background-color:#F3ED8F; display:none;" data-toggle="tooltip" > <span class="badge" id="Forwardtodean"> </span> Forward to dean</button> </span> -->
                        <span class="mr-2"> <button class="btn  btn-sm "  style="background-color:#28a745; color:white;" data-toggle="tooltip" > <span class="badge" id="Forwardtoaccount"> </span> Present</button> </span>
                        <!-- <span class="mr-2"> <button class="btn btn-success btn-sm "  style="" data-toggle="tooltip" > <span class="badge" id="Accepted"> </span> Accepted</button> </span> -->
                        <span style="float:right;">
      <button class="btn btn-sm ">
         <input type="search"  class="form-control form-control-sm" name="rollNo" id="rollNo" placeholder="Search RollNo">
      </button>
            <button type="button" onclick="searchStudentOnRollNo();" class="btn btn-success btn-sm">
              Search
            </button>
      </span>
                    </div>


                    <div class="card-body">
                        <div class="form-group row">
                 
                        
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <label>Status</label>
                                <select id="Status" class="form-control form-control-sm" >
                                    <option value="All">All</option>
                                    <option value="No">Absent</option>
                                    <option value="Yes">Present</option>
                                   
                                </select>

                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-3">


<label>College</label>
    <select  name="CollegeName" id='CollegeName'  class="form-control form-control-sm" required="">
             <option value='All'>All</option>
               <?php
$sql="SELECT DISTINCT CollegeName from online_payment  where remarks='4th Convocation' and  status='success'";
       $stmt2 = mysqli_query($conn_online,$sql);
  while($row1 = mysqli_fetch_array($stmt2) )
      {
  $college = $row1['CollegeName']; 
 ?>
<option  value="<?=$college;?>"><?= $college;?></option>
<?php    }

?>
           </select> 



       </div>
                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <label class="" style="font-size:14px;">Action</label><br>
                                <button class="btn btn-danger btn-sm " onclick="fetchCutList()"><i class="fa fa-search" aria-hidden="true"></i></button>&nbsp;&nbsp;
                                 <button class="btn btn-success btn-sm " onclick="exportBusPassList()"><i
                                                    class="fa fa-file-excel"></i></button>&nbsp;&nbsp;<!--
                                <button class="btn btn-danger btn-sm " onclick="exportCutListPdf()"><i
                                                    class="fa fa-file-pdf"></i></button> -->
                            </div>
                            <!-- <div class="col-lg-1 col-md-1 col-sm-13">
                                <label>&nbsp;</label><br>
                               
                                
                            </div> -->
                            


                        </div>

                        
                       
                   
    
       <div class="card-body table-responsive">          
<table class="table" style="font-size: 14px" >

  <thead>
         
                  <tr>
          <th>Sr. No</th>
          <th>P ID/ Ref no</th>
          <th>Uni Roll NO</th>
          <th>Name</th>
          <th>Course</th>
           <th>Organisation</th>
          <th>Email</th> <th>Purpose</th>  <th><i class="fa fa-download" style="color: green"></i></th>
          <th>Phone</th>
          <th>Amount</th>
          <th>Transaction Date/ Time</th>
         
         </tr>
         </thead>
         <tbody style="height:1px" id="show_record" ></tbody> 
         </table>
         </div>

            </div>



                    </div>
                   
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

           


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->

<script>
fetchCutList();

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})




cutlistCountDepartment();
function cutlistCountDepartment() {
    var code = 392.1;
    //var Session = document.getElementById('Session').value;
        $.ajax({
            url: 'action.php',
            type: 'post',
            data: {
                code: code   
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("pendingCount").textContent = data[0];
                document.getElementById("Forwardtoaccount").textContent = data[1];
                console.log(textContent = data[1]);

            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
}




function fetchCutList() {
    var sub_data = 2;
    var Status = document.getElementById('Status').value;
    var CollegeName = document.getElementById('CollegeName').value;
    
        var spinner = document.getElementById("ajax-loader");
            spinner.style.display = 'block';
        var code = 386.1;
        // alert(code);
        $.ajax({
            url: 'action.php',
            data: {
                code: code,
                Status: Status,
                sub_data:sub_data,
                CollegeName:CollegeName
            },
            type: 'POST',
            success: function(data) {
                // console.log(data)
                spinner.style.display = 'none';
                document.getElementById("show_record").innerHTML = data;
                cutlistCountDepartment();
            }
        });
    } 

function searchStudentOnRollNo() {
    var sub_data = 1;
    var rollNo = document.getElementById('rollNo').value;
    if(rollNo!='')
    {
    var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '386.1';
        $.ajax({
            url: 'action.php',
            data: {
                code: code,
                sub_data: sub_data,
                Rollno: rollNo
                
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                document.getElementById("show_record").innerHTML = data;

            }
        });
    }
    else{
        ErrorToast('Please Enter RollNo', 'bg-warning');
    }
  
}
function edit_stu(id) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 393.1;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {

            spinner.style.display = 'none';
            document.getElementById("edit_stu").innerHTML = response;

        }
    });

}


function exportBusPassList() {
    var exportCode = 80.1;
    //var Session = document.getElementById('Session').value;
    var Status = document.getElementById('Status').value;
    var CollegeName = document.getElementById('CollegeName').value;
    
    if (Status != '') {
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status+ "&CollegeName=" + CollegeName);

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}

function exportCutListPdf() {
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export-cutlist-pdf-new.php?CollegeId=" + College + "&Course=" + Course + "&Batch=" + Batch +
            "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
        ErrorToast('All input required','bg-warning');
    }
}



function lockAC(ID)
 {
     
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 394.1;
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,
                ID: ID
            },
            success: function(response) {
                spinner.style.display = 'none';
                //  console.log(response);
                if (response == 1) {
                    
                    SuccessToast('Successfully Verified');
                 
                    fetchCutList();
                    $('.bd-example-modal-xl').modal('hide');
                  
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });
     
}

function RejectAC(ID)
 {
 
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 395.1;
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,
                ID: ID
            },
            success: function(response) {
                spinner.style.display = 'none';
                //  console.log(response);
                if (response == 1) {
                    
                    SuccessToast('Reject');
                 
                    fetchCutList();
                    $('.bd-example-modal-xl').modal('hide');
                  
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });
  
}
</script>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fee Verification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_stu">
                
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