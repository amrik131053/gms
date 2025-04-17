<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Marks Permissions</h3>

                    </div>

                    <div class="card-body table-responsive  ">
                        <div class="btn-group w-100 mb-2">
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
                                <button class="btn btn-success btn-sm" onclick="open_examination_permision_search();"><i
                                        class="fa fa-search"></i></button>
                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#modalAssignAllpER"><i class="fa fa-plus"></i></button>

                                <!-- <input type="button" class="btn btn-secondary btn-sm"  value="Add"> -->
                            </span>
                        </div>

                        <div class="row" id="table_load" style="font-size:12px;"> </div>

                    </div>
                </div>



                <!-- <div class="card card-info"> -->
                <!-- <div class="card-header "> -->
                <!-- <h3 class="card-title">Distribution Theory Marks (Pending)</h3> -->
                <!-- <span style="float:right;"> -->
                <!--                         
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
                    </div> -->
                <!-- <div class="card-body table-responsive  ">
                        <div class="row" style="font-size:12px;">
                                       </div> -->
                <!-- <div class="row" id=""></div> -->




                <!-- 
                    </div>



                </div> -->




            </div>


            <div class="col-lg-5 col-md-5 col-sm-5">
                <div class="card card-info">
                    <div class="card-header ">
                       <div class="row"><div class="col-lg-4">Exam Permission</div><div class="col-lg-3">

                        <select  id="noduesexamination" name="examination" class="btn btn-default btn-xs">
                 <option value="">Examination</option>
                       <?php
   $sql="SELECT TOP(1) Examination from ExamForm Order by Examination DesC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {      
     $Sgroup = $row1['Examination']; 
         ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }

?>

                
              </select></div><div class="col-lg-3"> <button class="btn btn-success btn-xs" onclick="createnodues()">Create No Dues</button></div>

                   </div> 

                    </div>
                    <div class="card-body table-responsive  ">
                        <div class="btn-group w-100 mb-2">
                            <a class="btn btn-primary" id="btn1"
                                style="background-color:#223260; color: white; border: 5px solid;"
                                onclick="showRegular(),bg(this.id);"> Regular </a>
                            <a class="btn btn-primary" id="btn2"
                                style="background-color:#223260; color: white; border: 5px solid;"
                                onclick="showReapear(),bg(this.id);"> Reapear</a>
                            <a class="btn btn-primary" id="btn3"
                                style="background-color:#223260; color: white; border: 5px solid;"
                                onclick="showDiploma(),bg(this.id);"> Diploma </a>
                            <a class="btn btn-primary" id="btn4"
                                style="background-color:#223260; color: white; border: 5px solid;"
                                onclick="showPhD(),bg(this.id);"> Ph.D </a>
                        </div>
                        <div class="row" style="font-size:12px;" id="showExamPermissionsTable">



                        </div>







                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class=" ">
                            <div class="card-header ">
                                <h3 class="card-title">Examination Semester Open </h3>
                                        <!-- <input type="date"  id="dateopen" class="form-control"> -->
                            </div>
                            <div class="card-body  ">

                                    <div class="row">
                                             <div class="col-lg-2">
                                    <label>Session</label>
                                    <select id="session" name="session" class="form-control" required>
                                        <option value="">Session</option>
                             <?php       
        
                      $get_country="SELECT  DISTINCT Top(10) Session  FROM MasterCourseCodes Order By Session DEsc"  ;
                      $get_country_run=sqlsrv_query($conntest,$get_country);
                      while($row_Session=sqlsrv_fetch_array($get_country_run))
                      {?>
                         <option value="<?=$row_Session['Session'];?>"><?=$row_Session['Session'];?></option>
              <?php }
    
                     ?>
                                    </select>
                                  


                                </div>
                                        <div class="col-lg-2">
                                            <label>Batch</label>
                                            <select id="BatchOpen" class="form-control" required>

                                                <?php 
                                                for($i=2011;$i<=2030;$i++)
                                                    {?>
                                                                    <option value="<?=$i?>"><?=$i?></option>
                                                                    <?php }
                                                    ?>
                                            </select>
                                        </div>



                                    




                                        <div class="col-lg-2">
                                            <label>Duration </label>
                                            <select class="form-control" id="DurationOpen">
                                            <option value="">Select</option>
                                                        <?PHP 
                                                             $checkOpen="SELECT Distinct Duration  FROM  MasterCourseCodes where Duration!='' and Duration!='0'  order by  Duration ASC";
                                                             $checkOpenRun=sqlsrv_query($conntest,$checkOpen);
                                                             while($row=sqlsrv_fetch_array($checkOpenRun,SQLSRV_FETCH_ASSOC))
                                                             {?>
                                                               <option value="<?=$row['Duration'];?>"><?=$row['Duration'];?> Years</option><?php 
                                                                 
                                                             }
                                                             ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Type</label>
                                            <select class="form-control" id="TypeOpen">
                                                <!-- <option value="">Select</option> -->
                                                <option value="Regular">Regular</option>
                                                <option value="Reappear">Reappear</option>
                                                <!-- <option value="Improvement">Improvement</option>
                                                <option value="Additional">Additional</option> -->
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Action</label><br>
                                            <button class="btn btn-success" onclick="searchSemesterRecord();"><i
                                                    class="fa fa-search"></i></button>
                                            <button class="btn btn-success" onclick="closeSemesterRecord();"><i
                                                    class="fa fa-stop"></i></button>

                                                    <button class="btn btn-danger" onclick="closeSemesterRecord();">Close All</button>
                                        </div>
                                  </div>
                                <div class="" id="showSemesterOpenRecord"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Special Permission</h3>
<button class="btn btn-warning" onclick="format();">Format</button>
                    </div>
                    <div class="card-body  ">

                        <div class="btn-group w-100 mb-2">
                            <!-- <span style="float:right;"> -->
                                <select class="form-control form-control-sm" id='permisisonstatus'><option value="">All</option>
                                    <option value="1">Active</option></select>

                            <input type="text" class="form-control form-control-sm" placeholder="RollNo/IDNO"
                                id="UniRollNo">
                            <button class="btn btn-sm ">
                                <button class="btn btn-success btn-sm" onclick="searchStduentForSepecial();"><i
                                        class="fa fa-search"></i></button>
                                <button class="btn btn-danger  btn-sm" data-toggle="modal"
                                    data-target="#modalAssignBulkUpload"><i class="fa fa-plus"></i></button>
                            </button>

                            <!-- </span> -->
                        </div>

                        <div class="" id="showRecordSepcial"></div>

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
<div class="modal fade" id="modalAssignBulkUpload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bulk Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
            <div class="col-lg-12">
            <form id="submit_exam_form_bulk" method="post" enctype="multipart/form-data" action="action_g.php">
                         
                           <input type="hidden" name="code" value="471">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Semester</label>
                                        <select class="form-control" name="SemesterSepecial" id="SemesterSepecial" required>
                                            <?php  for ($i=1; $i<15 ; $i++) 
                                { ?>
                                            <option value="<?=$i;?>"><?=$i;?></option>

                                            <?php }  ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Type</label>
                                        <select class="form-control" name="TypeSepcial" id="TypeSepcial" required>
                                            <option value="Regular">Regular</option>
                                            <option value="Reappear">Reappear</option>
                                            <option value="Improvement">Improvement</option>
                                            <option value="Additional">Additional</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="">Month</label>
                                        <select class="form-control" name="MonthSepecial" id="MonthSepecial" required>

                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="">Year</label>
                                        <select class="form-control" name="YearSepecial" id="YearSepecial" required>

                                            <?php  for ($i=2015; $i <=date('Y') ; $i++) 
                                        { ?>
                                            <option value="<?=$i;?>"><?=$i;?></option>

                                            <?php }  ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>End Date</label>
                                        <input type="date" name="validDate" id="validDate" class="form-control" required>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>File</label>
                                        <input type="file" name="file_exl" id="file_exl" class="form-control" required>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Action</label><br>
                                        <input type="submit"  class="btn btn-success" value="Upload">
                                    </div>
                              </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </form>
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


function format() 
           {
            window.location.href = 'http://gurukashiuniversity.co.in/gms/formats/bulkexamform.csv';
           }
$(window).on('load', function() {
    $('#btn1').toggleClass("bg-success");
    showRegular();
})

function bg(id) {
    $('.btn').removeClass("bg-success");
    $('#' + id).toggleClass("bg-success");
}

function searchSemesterRecord() {

    var BatchOpen = document.getElementById('BatchOpen').value;
    var DurationOpen = document.getElementById('DurationOpen').value;
    var TypeOpen = document.getElementById('TypeOpen').value;
    if(TypeOpen=='Reappear' && DurationOpen=='')
     {
    ErrorToast('Please select a Duration.', 'bg-warning');
     return;
     }
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '422'; 
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            BatchOpen: BatchOpen,DurationOpen:DurationOpen,TypeOpen:TypeOpen
        },
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            document.getElementById('showSemesterOpenRecord').innerHTML = response;

        }
    });
}
function closeSemesterRecord() {

    var BatchOpen = document.getElementById('BatchOpen').value;
    var DurationOpen = document.getElementById('DurationOpen').value;
    var TypeOpen = document.getElementById('TypeOpen').value;
    var r = confirm("Do you really want to close");
    if (r == true) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '424';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            BatchOpen: BatchOpen,DurationOpen:DurationOpen,TypeOpen:TypeOpen
        },
        success: function(response) {
             console.log(response);
            spinner.style.display = 'none';
            if (response==1) {
                    SuccessToast('Successfully close');
                    searchSemesterRecord();
                  
                } else {
                    ErrorToast('Input Wrong ', 'bg-danger');
                }


        }
    });
}
else{
    
}
}
function deleteSepecialPermissions(id) {
    var r = confirm("Do you really want to delete");
    if (r == true) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '425';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
           id:id
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            if (response==1) {
                    SuccessToast('Successfully delete');
                    searchStduentForSepecial();
                } else {
                    ErrorToast('try again ', 'bg-danger');
                }


        }
    });
}
else{
    
}
}

function updateperdate(id,vdate,idno)
{
   

  var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '30';
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: {
            flag:code,id:id,vdate:vdate,idno:idno
        },
        success: function(response) {
           console.log(response);
            spinner.style.display = 'none';
            searchStduentForSepecial();
            
        }
    });


}


function searchStduentForSepecial() {
    var uniRollNo = document.getElementById('UniRollNo').value;
 var permisisonstatus = document.getElementById('permisisonstatus').value;

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '418';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            rollNo: uniRollNo,permisisonstatus:permisisonstatus
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById('showRecordSepcial').innerHTML = response;

        }
    });
}

function showRegular() {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '413';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById('showExamPermissionsTable').innerHTML = response;

        }
    });
}

function showReapear() {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '414';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById('showExamPermissionsTable').innerHTML = response;

        }
    });
}

function showDiploma() {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '415';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById('showExamPermissionsTable').innerHTML = response;

        }
    });
}

function showPhD() {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = '416';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById('showExamPermissionsTable').innerHTML = response;

        }
    });
}

function updatePermissons(id,type) {
    var MonthEdit = document.getElementById('MonthEdit').value;
    var YearEdit = document.getElementById('YearEdit').value;
    var Examination = MonthEdit + '' + YearEdit;
    var StartDate = document.getElementById('StartDateEdit').value;
    var EndDate = document.getElementById('EndDateEdit').value;
    if (StartDate <= EndDate && StartDate != '' && EndDate != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 417;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                id: id,
                StartDate: StartDate,
                EndDate: EndDate,
                MonthEdit: MonthEdit,
                YearEdit: YearEdit
            },
            success: function(response) {
                // console.log(response);
                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('Successfully Update');
                    if (type == '1') {
                        showRegular();
                    } else if (type == '2') {
                        showReapear();
                    } else if (type == '3' || type == '4') {
                        showDiploma();
                    } else if (type == '5' || type == '6') {
                        showPhD();
                    }
                } else {
                    ErrorToast('Input Wrong ', 'bg-danger');
                }


            }
        });
    } else {
        ErrorToast('Start date cannot be greater than end date ', 'bg-warning');
    }
}

function submitSpecial(id, IDNo) {
    var SemesterSepecial = document.getElementById('SemesterSepecial').value;
    var TypeSepcial = document.getElementById('TypeSepcial').value;
    var MonthSepecial = document.getElementById('MonthSepecial').value;
    var YearSepecial = document.getElementById('YearSepecial').value;
    var validDate = document.getElementById('validDate').value;
    if (validDate != '') {

        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 419;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                id: id,
                IDNo: IDNo,
                SemesterSepecial: SemesterSepecial,
                TypeSepcial: TypeSepcial,
                MonthSepecial: MonthSepecial,
                YearSepecial: YearSepecial,
                validDate: validDate
            },
            success: function(response) {
                console.log(response);
                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('Successfully');
                    searchStduentForSepecial();

                } else {
                    ErrorToast('try Again ', 'bg-danger');
                }


            }
        });
    } else {
        ErrorToast('End Date required ', 'bg-warning');

    }
}






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

function editExam(id, Etype) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 265;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id,
            Etype: Etype
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

function createnodues()
{
      var examination = document.getElementById('noduesexamination').value;
      alert(examination);
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
   
    var code = 29;
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: {
            flag: code,
            examination: examination
        },
        success: function(response) {

            spinner.style.display = 'none';
console.log(response);
                SuccessToast('No Dues Created Success');
              

                
            

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

function openSubmit() {
    var BatchOpen = document.getElementById('BatchOpen').value;
    var DurationOpen = document.getElementById('DurationOpen').value;
    var TypeOpen = document.getElementById('TypeOpen').value;
    var checkboxes = document.getElementsByClassName('sel11');
    var inputBoxes = document.getElementsByClassName('sel22');
    var checkboxValues = [];
    var inputValues = [];

    for (var i = 0; i < checkboxes.length; i++) {
        var checkbox = checkboxes[i];
        var inputBox = inputBoxes[i];

        if (checkbox.checked) {
            checkboxValues.push('1');
        } else {
            checkboxValues.push('0');
        }

        inputValues.push(inputBox.value);
    }

    // alert(inputValues + '=' + checkboxValues);

    if (checkboxValues.length === 0) {
        ErrorToast('Select at least one sem', 'bg-warning');
    } else if (BatchOpen !== '' && checkboxes.length > 0) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 423;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                id_array_main: checkboxValues,
                BatchOpen: BatchOpen,
                DurationOpen: DurationOpen,
                TypeOpen: TypeOpen,
                lenarraySem_main: inputValues
            },
            success: function(response) {
                // console.log(response);
                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('Successfully');
                    searchSemesterRecord();
                } else {
                    ErrorToast('Try again', 'bg-danger');
                }
            }
        });
    } else {
        ErrorToast('All inputs required', 'bg-warning');
    }
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



$(document).ready(function(e) { // image upload form submit
    $("#submit_exam_form_bulk").on('submit', (function(e) {
        e.preventDefault();

        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        $.ajax({
            url: "action_g.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                spinner.style.display = 'none';
                    SuccessToast('Successfully Uploaded');
                    $('#modalAssignBulkUpload').modal('hide');
        
            },
        });
    }));
});
</script>

<?php include "footer.php";  ?>