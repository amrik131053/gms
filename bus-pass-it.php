<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                    
                        <span class="mr-2"> <button class="btn btn-primary btn-sm"  style="background-color:#D0EDFF; color:black;" data-toggle="tooltip" ><span class="badge"   id="pendingCount"> </span> Pending</button> </span>
                        <span class="mr-2"> <button class="btn btn-danger btn-sm"  style="background-color:;" data-toggle="tooltip" > <span class="badge" id="rejectCount"> </span> Rejected</button> </span>
                        <span class="mr-2"> <button class="btn  btn-sm "  style="background-color:#F3ED8F;" data-toggle="tooltip" > <span class="badge" id="Forwardtoaccount"> </span> Forward to account</button> </span>
                        <span class="mr-2"> <button class="btn btn-success btn-sm "  style="" data-toggle="tooltip" > <span class="badge" id="Accepted"> </span> Printed</button> </span>
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
                                <label>Session</label>
                                <select id="Session" class="form-control form-control-sm" >
                                <option value="<?php   if(date('m')>6)
                                    {  
                                        echo $session='August'.date('Y');
                                       }
                                       else
                                       {
                                    
                                        echo$session='Jan' . date('Y');
                                   }?>"> <?php
                                    if(date('m')>6)
                                    {  
                                        echo $session='August'.date('Y');
                                       }
                                       else
                                       {
                                    
                                        echo $session='Jan' . date('Y');
                                   }
                                   ?></option>
                                    
                                    <?php
                                     $sql="SELECT DISTINCT session from StudentBusPassGKU Order by session ASC ";
                                            $stmt2 = sqlsrv_query($conntest,$sql);
                                        while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                            {                      
                                        $Sgroup = $row1['session']; 
                                        
                                        ?>
                                    <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                    <?php    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <label>Status</label>
                                <select id="Status" class="form-control form-control-sm" >
                                    <option value="All">All</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Rejected</option>
                                    <option value="3">Verified</option>
                                    <option value="5">Ready To Print</option>
                                    <option value="6">Printed</option>                              
                                </select>

                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <label class="" style="font-size:14px;">Action</label><br>
                                <button class="btn btn-danger btn-sm " onclick="fetchCutList()"><i class="fa fa-search" aria-hidden="true"></i></button>&nbsp;&nbsp;
                                <!-- <button class="btn btn-success btn-sm " onclick="printAll()"><i
                                                    class="fa fa-file-excel"></i></button>&nbsp;&nbsp; -->
                                <!-- <button class="btn btn-danger btn-sm " onclick="exportCutListPdf()"><i
                                                    class="fa fa-file-pdf"></i></button> -->
                            </div>
                            <!-- <div class="col-lg-1 col-md-1 col-sm-13">
                                <label>&nbsp;</label><br>
                               
                                
                            </div> -->
                            


                        </div>
                        <div class="table table-responsive" id="show_record"></div>
                    </div>
                   
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </div>


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->

<script>
    fetchCutList();
function printAll()
{
  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=5;
  var Ids=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            Ids.push(verifiy[i].value);
           
        }

    }
   
    if(Ids=='')
  {
    ErrorToast(' Select atleast one' ,'bg-warning');
  }
  else{

      window.open("print_id_card_pass.php?code=" + code + "&id_array=" +Ids, '_blank');
  }
}



function verifiy_select()
{
        if(document.getElementById("select_all1").checked)
        {
            $('.v_check').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.v_check').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.v_check').on('click',function()
    {
        var a=document.getElementsByClassName("v_check:checked").length;
        var b=document.getElementsByClassName("v_check").length;
        
        if(a == b)
        {

            $('#select_all1').prop('checked',true);
        }
        else
        {
            $('#select_all1').prop('checked',false);
        }
    });
 
}




cutlistCountDepartment();
function cutlistCountDepartment() {
    var code = 346;
    var Session = document.getElementById('Session').value;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Session: Session
            },
            success: function(response) {
                console.log(response);
                var data = JSON.parse(response);
                document.getElementById("pendingCount").textContent = data[0];
                document.getElementById("rejectCount").textContent = data[1];
                document.getElementById("Forwardtoaccount").textContent = data[2];
                document.getElementById("Accepted").textContent = data[3];

                




               
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
}




function fetchCutList() {
    var sub_data = 2;
 
   
    var Session = document.getElementById('Session').value;
    var Status = document.getElementById('Status').value;
    
    if (Session != '') {
        var spinner = document.getElementById("ajax-loader");
            spinner.style.display = 'block';
        var code = '338';
        $.ajax({
            url: 'action_g.php',
            data: {
                code: code,
                Status: Status,
                Session: Session,sub_data:sub_data
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                document.getElementById("show_record").innerHTML = data;
                cutlistCountDepartment();
            }
        });
    } else {
        ErrorToast('Please Select Session', 'bg-warning');
    }
}
function searchStudentOnRollNo() {
    var sub_data = 1;
    var rollNo = document.getElementById('rollNo').value;
    if(rollNo!='')
    {
    var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '338';
        $.ajax({
            url: 'action_g.php',
            data: {
                code: code,
                sub_data: sub_data,
                rollNo: rollNo
                
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
    // alert(id);
    var code = 339;
    $.ajax({
        url: 'action_g.php',
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

function exportCutListExcel() {
    var exportCode = 40;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

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


function lockIT(ID)
 {
    var r = confirm("Do you really want to Verifiy");
    if (r == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 340;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                ID: ID
            },
            success: function(response) {
                spinner.style.display = 'none';
                // console.log(response);
                if (response == 1) {
                    
                    SuccessToast('Successfully Verify');
                    edit_stu(ID);
                    fetchCutList();
                    $('.bd-example-modal-xl').modal('hide');
                  
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });
    }
}
function RejectIT(ID)
 {
    var remark = document.getElementById("remarkReject").value;
    let length = remark.length;
    if(remark!='' && length>5)
    {
        var r = confirm("Do you really want to reject?");
        if (r === true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 341;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                ID: ID,
                remarks: remark
            },
            success: function(response) {
                spinner.style.display = 'none';
                // console.log(response);
                if (response == 1) {
                    
                    SuccessToast('Successfully Reject');
                    edit_stu(ID);
                    fetchCutList();
                    $('.bd-example-modal-xl').modal('hide');
                  
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            
        }
    });
}
    }
        else{
        $('#remarkReject').toggleClass("is-invalid");
        $('#error-reject-textarea').show();
    }
}

</script>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bus Pass</h5>
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