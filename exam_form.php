<?php

ini_set('max_execution_time', '0');

    include 'header.php';
?>
<p id="ajax-loader"></p>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-lg-1">
                                <h3 class="card-title">Exam From</h3>
                            </div>
                            <div class="col-lg-2">
                            
                                <input type="text" class="form-control" name="IDNo" id="rollno" placeholder="RollNo">
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-info" onclick="search_exam_form()"> <i
                                        class="fa fa-search" aria-hidden="true"></i></button>
                            </div>

                            <div class="col-lg-6">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal_upload1" style="float: center;"> Filter

                                </button>
            &nbsp;
            &nbsp;

                              </FORm>
                            </div>
                            <div class="col-lg-1">
                                <a href="formats/examform.csv" class="btn btn-warning "> Format</a>
                            </div>
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exampleModal_upload" style="float: center;">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive" style="font-size: 14px;" id="live_data_Exam_student">



                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<?php include'footer.php';?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>



<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Exam From Submit</h5>
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

<div class="modal fade" id="exampleModal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Exam From Submit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="col-lg-12">
                <form id="submit_exam_form" method="post" enctype="multipart/form-data" action="action.php">
                    <input type="hidden" name="code" value="203">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Sem: </label>
                                <select name="sem" id="semester" class="form-control" required="">
                                    <option value="1">1st </option>
                                    <option value="2">2nd </option>
                                    <option value="3">3rd </option>
                                    <option value="4">4th </option>
                                    <option value="5">5th </option>
                                    <option value="6">6th </option>
                                    <option value="7">7th </option>
                                    <option value="8">8th </option>
                                    <option value="9">9th </option>
                                    <option value="10">10th</option>
                                    <option value="11">11th</option>
                                    <option value="12">12th</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Type</label>
                                <select id="type" name="type" class="form-control" required="">
                                    <option value="">Select</option>
                                    <?php
               $sql="SELECT DISTINCT Type from ExamForm Order by Type ASC ";
               $stmt2 = sqlsrv_query($conntest,$sql);
                while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
             {    
            $Sgroup = $row1['Type'];  
               ?>
                                    <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                    <?php         }
?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Examination</label>
                                <select id="month" name="month" class="form-control" required="">
                                    <option value="">Select</option>
                                    <?php
               $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
                      $stmt2 = sqlsrv_query($conntest,$sql);
                 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                     {    
                 $Sgroup = $row1['Examination'];  
                ?>
                                    <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                    <?php    }
                    ?>
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label>Excel Here:</label>
                                <input type="file" name="file_exl" id="file_exl">
                            </div>
                            <div class="col-lg-6">
                                <label>Status</label>
                                <Select name='Status' id="Status" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="-1">Fee pending</option>
                                    <option value="0">Draft</option>
                                    <option value="4">Forward to Account</option>
                                    <option value="5">Forward to Examination Branch</option>
                                    <option value="8">Accepted</option>
                                </Select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                        <input type="submit" value="Upload" class="btn btn-primary" id="btnimport">



                    </div>
                    <p id="error" style="display: none;"></p>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>




<!-- 
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" >
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exam fsfdFrom Submit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body" id="edit_stu">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> 
      </div>
    </div>
  </div>
</div> -->




<div class="modal fade" id="exampleModal_upload1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Exam From Submit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>



















            <div class="col-lg-12">

               
                <div class="card-body">







                    <div class="row">
                        <!-- left column -->
                        <div class="col-lg-6 col-md-4 col-sm-3">


                            <label>Colleged</label>
                            <select name="College" id='College' onchange="courseByCollege(this.value)"
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
                        <div class="col-lg-6 col-md-4 col-sm-3">


                            <label>Course</label>
                            <select name="Course" id="Course" class="form-control">
                                <option value=''>Select Course</option>

                            </select>
                        </div>


                        <div class="col-lg-6 col-md-4 col-sm-3">





                            <label>Batch</label>
                            <select name="batch" class="form-control" id="Batch" required="">
                                <option value="">Batch</option>
                                <?php 
for($i=2013;$i<=2030;$i++)
{?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php }
            ?>

                            </select>

                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-3">
                            <label> Semester</label>
                            <select id='Semester' class="form-control" required="">
                                <option value="">Sem</option>
                                <?php 
for($i=1;$i<=12;$i++)
{?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php }
            ?>

                            </select>

                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-3">
                            <label>Type</label>
                            <select id="Type" class="form-control" required="">
                                <option value="">Select</option>
                                <option value="Regular">Regular</option>
                                <option value="Reappear">Reappear</option>
                                <option value="Additional">Additional</option>
                                <option value="Improvement">Improvement</option>


                            </select>

                        </div>

                        <div class="col-lg-6    col-md-4 col-sm-3">
                            <label>Group</label>
                            <select id="Group" class="form-control" required="">
                                <option value="">Group</option>
                                <?php
   $sql="SELECT DISTINCT Sgroup from MasterCourseStructure Order by Sgroup ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $Sgroup = $row1['Sgroup']; 
     
    ?>
                                <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                <?php    }

?>


                            </select>

                        </div>

                        <div class="col-lg-6 col-md-4 col-sm-3">
                            <label>Examination</label>
                            <select id="Examination" class="form-control" required="">
                                <option value="">Examination</option>
                                <?php
   $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $Sgroup = $row1['Examination']; 
     
    ?>
                                <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                <?php    }

?>


                            </select>

                        </div>


                        <div class="col-lg-6 col-md-4 col-sm-3">
                            <label>Search</label><br>
                            <button class="btn btn-danger" onclick="Search_exam_student1()"><i
                                    class="fa fa-search"></i></button>

                        </div>



                        <!-- /.row -->
                    </div>


                </div>

                <p id="error" style="display: none;"></p>
                <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->



            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
























</div>

</body>

</html>
<script type="text/javascript">
function status_update(id,IDNo) {
    var status = document.getElementById(id + '_status').value;
    // alert(status);
   // alert(IDNo);
    var r = confirm("Do you really want to Change");
    if (r == true) {

        //var status=document.getElementById('Status').value;
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 213;
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,
                id: id,IDNo:IDNo,
                status: status
            },
            success: function(response) {
                spinner.style.display = 'none';
                if (response == '1') {
                    SuccessToast('Successfully Update');
                    search_exam_form();
                } else {
                    ErrorToast('Input Wrong ', 'bg-danger');
                }

            }
        });
    }
}

function delexam(id,IDNo,Sem,Examination,Type) {
    var r = confirm("Do you really want to Delete ");
    if (r == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        //  var userid = document.getElementById('userid').value;
        var code = 212;
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,userid:IDNo,Sem:Sem,Examination:Examination,Type:Type,id: id
            },
            success: function(response) {
               // console.log(response);
                spinner.style.display = 'none';
                search_exam_form();
                Search_exam_student1();
                if (response == '1') {
                    SuccessToast('Successfully Delete');

                } else {
                    ErrorToast('Input Wrong ', 'bg-danger');
                }

            }
        });
    }
}

function search_exam_form() {
    var rollNo = document.getElementById('rollno').value;
    var spinner = document.getElementById("ajax-loader");
    var sub_data = 1;
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 202;
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code,
            rollNo: rollNo,
            sub_data: sub_data
        },
        success: function(response) {

            // $('#modal-lg-view-question').modal('toggle');
            spinner.style.display = 'none';
            document.getElementById("live_data_Exam_student").innerHTML = response;

        }
    });
}


function exam_type_update(id) {
    var r = confirm("Do you really want to Change");
    if (r == true) {
        var type = document.getElementById('type_').value;


        var userid = document.getElementById('userid').value;
        var examination = document.getElementById('examination_').value;
        var sgroup = document.getElementById('sgroup_').value;
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        // alert(type+' '+examination);
        var code = 208;
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,
                id: id,
                examination: examination,
                type: type,userid:userid,
                sgroup: sgroup,
            },
            success: function(response) {

                spinner.style.display = 'none';
                if (response == '1') {
                    SuccessToast('Successfully Update');
                    search_exam_form();
                } else {
                    ErrorToast('Input Wrong ', 'bg-danger');
                }

            }
        });
    }
}

$(document).ready(function(e) { // image upload form submit
    $("#submit_exam_form").on('submit', (function(e) {
        e.preventDefault();

        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        $.ajax({
            url: "action.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                spinner.style.display = 'none';
                if (data==1) {
                    SuccessToast('Successfully Uploaded');
                    $('#exampleModal_upload').modal('hide');
                    //search_exam_form();

                } 
                else if(data==0)
                {
                    ErrorToast('Invalid CSV File ', 'bg-danger');
                    
                }

                    else {
 ErrorToast('Already Exist', 'bg-warning');
                    
                }
            },
        });
    }));
});

function edit_stu(id) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
    var code = 204;
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

function sub_code_int_ext_type_update(id) {
    var r = confirm("Do you really want to Change");
    if (r == true) {
        // alert(id);
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var subcode = document.getElementById(id + "_subcode").value;
        var userid = document.getElementById('userid').value;
        var subname = document.getElementById(id + "_subname").value;
        var int = document.getElementById(id + "_Int").value;
        var ext = document.getElementById(id + "_Ext").value;
        var intm = document.getElementById(id + "_intmarks").value;
        var extm = document.getElementById(id + "_extmarks").value;
        var subtype = document.getElementById(id + "_subtype").value;
        var code = 210;
        // alert(subcode+' '+subname+' '+int+' '+ext+' '+intm+' '+extm+''+subtype);
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,
                id: id,
                subcode: subcode,
                subname: subname,userid:userid,
                Int: int,
                Ext: ext,
                Intm: intm,
                Extm: extm,
                subtype: subtype
            },
            success: function(response) {
                console.log(response);
                spinner.style.display = 'none';
                if (response == '1') {
                    SuccessToast('Successfully Updated');
                    search_exam_form();
                    Search_exam_student1();
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });

    }
}

function receipt_date_no_update(id) {
    var r = confirm("Do you really want to Change");
    if (r == true) {
         //alert(id);
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var rdate = document.getElementById("asreceipt_date").value;
        var rno = document.getElementById("asreceipt_no").value;
        var userid = document.getElementById('userid').value;
        var code = 211;
        // alert(subcode+' '+subname+' '+int+' '+ext+' '+intm+' '+extm+''+subtype);
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,
                id: id,
                receipt_date: rdate,userid:userid,
                receipt_no: rno
            },
            success: function(response) {
                 //console.log(response);
                spinner.style.display = 'none';
                if (response == '1') {
                    SuccessToast('Successfully Updated');
                    search_exam_form();
                    Search_exam_student1();
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }

            }
        });

    }
}


function Search_exam_student1() {

    var code = 202;
    var sub_data = 2;
    var College = document.getElementById("College").value;
    var Course = document.getElementById("Course").value;
    var Batch = document.getElementById("Batch").value;
    var Semester = document.getElementById("Semester").value;
    var Type = document.getElementById("Type").value;
    var Group = document.getElementById("Group").value;
    var Examination = document.getElementById("Examination").value;
     //var userid = document.getElementById('userid').value;

    if (Batch != '' && Semester != '' && College != '' && Course != '' && Type != '' && Group != '' && Examination !=
        '') {

        //x.style.display = "block";
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';

        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                code: code,
                College: College,
                Course: Course,
                Batch: Batch,
                Semester: Semester,
                Type: Type,
                Group: Group,
                Examination: Examination,
                sub_data: sub_data
            },
            success: function(response) {
                // $('#modal-lg-view-question').modal('toggle');
                spinner.style.display = 'none';
                document.getElementById("live_data_Exam_student").innerHTML = response;

            }
        });
    }
}



 function Delete_sub_code_int_ext_type_update(id,nid)
    {
         var r = confirm("Do you really want to Delete");
          if(r == true) 
           {

     var r = confirm("it is going to Delete");
          if(r == true) 
           {
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
      var userid = document.getElementById('userid').value;
       var subcode=document.getElementById(id+"_subcode").value;
         var subname=document.getElementById(id+"_subname").value;
     
     var code=310;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,userid:userid,subname:subname,subcode:subcode
              },
              success: function(response) 
              {
               //console.log(response);
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully deleted');
                           Search_exam_student();
                          

                           edit_stu(nid);


                          }
                          else
                          {
                           ErrorToast('Input Wrong ','bg-danger' );
                          }
                
              }
           });
       }
   }
 }
</script>