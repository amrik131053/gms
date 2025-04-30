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
                <div class="card card-info">
               <div class="card-header">
                  <div class="card-tools">
                     <!-- <form action="action_g.php" method="post" enctype="multipart/form-data"> -->
                        <div class="input-group input-group-sm">

                          <input type="date"  class="form-control" id="upload_date">
                          <input type="button" class="btn btn-secondary btn-xs" onclick="date_by_search();" value="Search">
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           <input type="submit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#for_excel" value="Upload">
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           <input type="button" onclick="window.location.href='formats/degree.csv'" value="Format" class="btn btn-warning btn-xs">
                        </div>
                     <!-- </form> -->
                  </div>
                  <div class="card-tools">
                     </div>
                     <div class="input-group input-group-sm col-lg-8">
              
              <input required type="text" id="RollNoSearch" class="form-control" placeholder="RollNo/Name">
                                   
<input  type="button" class="btn btn-success btn-xs" value="Search" onclick="search_degree_record()">
&nbsp;
&nbsp;
&nbsp;
             <select class="form-control" id="CourseName">
             <option value="">Course Name</option>
               <?php 
               $get_course="SELECT distinct Course FROM degree_print";
               $get_course_run=mysqli_query($conn,$get_course);
               while($get_row=mysqli_fetch_array($get_course_run))
               {?>
                  <option value="<?=$get_row['Course'];?>"><?=$get_row['Course'];?></option>
<?php 
               }?>
             </select>
             <select class="form-control" id="StreamName">
             <option value="">Course Name</option>
               <?php 
               $get_course="SELECT distinct Stream FROM degree_print where Course!='Diploma in pharmacy'";
               $get_course_run=mysqli_query($conn,$get_course);
               while($get_row=mysqli_fetch_array($get_course_run))
               {?>
                  <option value="<?=$get_row['Stream'];?>"><?=$get_row['Stream'];?></option>
<?php 
               }?>
             </select>
  


<input  type="button" class="btn btn-success btn-xs" value="Search" onclick="date_by_search()">
&nbsp;
&nbsp;
<select name="College" id='College' onchange="courseByCollege(this.value)"
                                    class="form-control form-control-sm" >
                                    <option value=''>Select College</option>
                                    <?php

                                    $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID  where UserAccessLevel.IDNo='$EmployeeID'";
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
                                
                        
                              
                                <select name="Course" id="Course" class="form-control form-control-sm">
                                    <option value=''>Select Course</option>

                                </select>
                                   <select name="batch" class="form-control form-control-sm" id="Batch" >
                                    <option value="">Select</option>
                                    <?php 
                                    for($i=2013;$i<=2030;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                                ?>

                                </select>
    <input  type="button" class="btn btn-success btn-xs" value="Search" onclick="college_by_search()">
&nbsp;                      
&nbsp;
<select class="form-control" id="code">
<option value="">Select Type</option>
<option value="1">Agri Diploma</option>
<option value="8">Other Diploma</option>
<option value="7">Pharmacy</option>
<option value="3">Plan</option>
<option value="6">Plan Stream</option>
<option value="2">Stream</option>
<option value="4">Specialization</option>
<option value="5">Ph.D</option>
<option value="9">With College</option>
<option value="10">Stream With College</option>
<option value="11">Plan Agri</option>
</select>
<input type="date" id="upload_date1" class="form-control" value="">
 <button onclick="printSelectedRows();" class="btn btn-success btn-sm">Print </button>                   
</div>
                 
               </div>
                    
                           
                          
                        </div>
                        <div class="table">
                        <table class="table" >
                            <thead>
                                <tr>
                              
                                    <th><input type="checkbox" id="select_all1" onclick="verifiy_select();" class="form-control" ></th>
                                    <th>SrNo</th>
                                    <th>UniRolNo</th>
                                    <th>Name</th>
                                    <th>FatherName</th>
                                    <th>Examination</th>
                                    <th>Course</th>
                                    <th>Other</th>
                                    <th>CGPA</th>
                                    <th>QR Course</th>
                                    <th>Gender</th>
                                    <th>Type</th>
                                    <th>Upload Date</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody  id="show_record">

                            </tbody>
                            <tr>
                       <?php if ($code_access=='001' || $code_access=='101' || $code_access=='011' ||  $code_access=='111') { ?>
                       <td><button onclick="deleteSelectedRows();" class="btn btn-danger btn-xs " ><i class="fa fa-trash"></i> </button></td>
                        <?php } ?></td>
                    </tr>
                        </table>

                        </div>
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

// $(function () {
//   $('[data-toggle="tooltip"]').tooltip()
// })

function printSelectedRows()
               {
                var id_array=document.getElementsByClassName('v_check');
                var Todate = document.getElementById('upload_date1').value;
                var code = document.getElementById('code').value;
                var len_id = id_array.length;
                var id_array_main = [];
                for (i = 0; i < len_id; i++) {
                    if (id_array[i].checked === true) {
                        id_array_main.push(id_array[i].value);
                    }
                }
                    if (id_array_main.length > 0 && Todate!='' && code!='')
                        {
                        window.open('print_degree_all.php?id_array=' + id_array_main+'&Todate='+Todate+'&code='+code);
                    }
                        else 
                    {
                        ErrorToast('All Input Required', 'bg-warning');
                    }
            }   
function verifiy_select() {
   // alert();
    if (document.getElementById("select_all1").checked) {
        $('.v_check').each(function() {
            this.checked = true;
        });
    } else {
        $('.v_check').each(function() {
            this.checked = false;
        });
    }

    $('.v_check').on('click', function() {
        var a = document.getElementsByClassName("v_check:checked").length;
        var b = document.getElementsByClassName("v_check").length;

        if (a == b) {

            $('#select_all1').prop('checked', true);
        } else {
            $('#select_all1').prop('checked', false);
        }
    });

}


function college_by_search()
{
 var spinner = document.getElementById("ajax-loader");
 spinner.style.display = 'block';
 var code = 78.1;
 var searchQuery = '';

 var College=document.getElementById('College').value;
 var Course=document.getElementById('Course').value;
 var Batch=document.getElementById('Batch').value;
  // alert(by_search_StreamName);
 $.ajax({
     url: 'action_g.php',
     type: 'POST',
     data: {
         code: code,
         College: College,
         Course: Course,
         Batch: Batch
     },
     success: function(data) {
        document.getElementById('show_record').innerHTML=data;
         spinner.style.display = 'none';

},
     error: function() {     
         // spinner.style.display = 'none';
     }
 });

}




function date_by_search() {

 var spinner = document.getElementById("ajax-loader");
 spinner.style.display = 'block';
 var code = 78;
 var searchQuery = '';
 var upload_date = document.getElementById('upload_date').value;
 var by_search=document.getElementById('RollNoSearch').value;
 var by_search_college=document.getElementById('CourseName').value;
 var by_search_StreamName=document.getElementById('StreamName').value;
  // alert(by_search_StreamName);
 $.ajax({
     url: 'action_g.php',
     type: 'POST',
     data: {
         code: code,
         upload_date: upload_date,
         by_search_college: by_search_college,
         by_search_StreamName: by_search_StreamName
     },
     success: function(data) {
        document.getElementById('show_record').innerHTML=data;
         spinner.style.display = 'none';

},
     error: function() {     
         // spinner.style.display = 'none';
     }
 });
}


function deleteSelectedRows() {
    var students=document.getElementsByClassName('v_check');
var len_student = students.length;
var a = confirm("Are you sure you want to delete");
if (a == true) {
    var code = 159;
    var student_str = [];

    for (i = 0; i < len_student; i++) {
        if (students[i].checked === true) {
            student_str.push(students[i].value);
        }
    }
    if ((typeof student_str[0] == 'undefined')) {
        ErrorToast('Select atleast one record ', 'bg-warning');
    } else {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        $.ajax({
            url: 'action_g.php',
            data: {
                students: student_str,
                code: code
            },
            type: 'POST',
            success: function(data) {
                // console.log(data);
                spinner.style.display = 'none';
                if (data < len_student) {
                    SuccessToast('Successfully Delete');
                    date_by_search();
                } else if (len_student == data) {
                    SuccessToast('Successfully Delete');
                    location.reload(true);
                } else {
                    date_by_search();
                    // ErrorToast('You have can`t permissons for delete','bg-danger');
                }
                // console.log(data);
            }
        });
    }
} else {

}
}

function diploma_other() {

var code = 130;
$.ajax({
    url: 'action_g.php',
    type: 'post',
    data: {
        code: code
    },
    success: function(response) {
        document.getElementById("from_show_toggle").innerHTML = response;
        document.getElementById("Type_degree").innerHTML = response;
    }
});

}

function diploma_agri() {
var code = 131;
$.ajax({
    url: 'action_g.php',
    type: 'post',
    data: {
        code: code
    },
    success: function(response) {
        document.getElementById("from_show_toggle").innerHTML = response;
    }
});
} 

function degree() {
var code = 132;
$.ajax({
    url: 'action_g.php',
    type: 'post',
    data: {
        code: code
    },
    success: function(response) {
        document.getElementById("from_show_toggle").innerHTML = response;
    }
});
}

function certificate() {
var code = 176;
$.ajax({
    url: 'action_g.php',
    type: 'post',
    data: {
        code: code
    },
    success: function(response) {
        document.getElementById("from_show_toggle").innerHTML = response;
    }
});
}
function phd() {
var code = 176.1;
$.ajax({
    url: 'action_g.php',
    type: 'post',
    data: {
        code: code
    },
    success: function(response) {
        document.getElementById("from_show_toggle").innerHTML = response;
    }
});
}




function bg(id) {
$('.btn').removeClass("bg-success");
$('#' + id).toggleClass("bg-success");
}

function uploadImage(form, id) {
var formData = new FormData(form);
$.ajax({
    url: form.action,
    type: form.method,
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
        // console.log(response);
        SuccessToast('Successfully Uploaded');
        view_image(id);
    },
    error: function(xhr, status, error) {
        console.log(error);
    }
});
}

function search_degree_record() {
var unirollno = document.getElementById('RollNoSearch').value;
var spinner = document.getElementById("ajax-loader");
spinner.style.display = 'block';
var code = 224;
$.ajax({
    url: 'action.php',
    type: 'post',
    data: {
        uni: unirollno,
        code: code
    },
    success: function(response) {
        spinner.style.display = 'none';
        document.getElementById("show_record").innerHTML = response;
    }
});
}

function marks_as_print(id) {
var spinner = document.getElementById("ajax-loader");
spinner.style.display = 'block';
var code = 77;
$.ajax({
    url: 'action_g.php',
    type: 'post',
    data: {
        id: id,
        code: code
    },
    success: function(response) {
        spinner.style.display = 'none';
        if (response == 1) {
            load_table();
            SuccessToast('Successfully Updated');
        }
    }
});
}

function edit_student(id) {

var code = '141';
$.ajax({
    url: 'action_g.php',
    data: {
        id: id,
        code: code
    },
    type: 'POST',
    success: function(data) {
        document.getElementById('edit_show').innerHTML = data;
    }
});

} 
function view_image(id) {
    // alert(id);
                     var code = 91;
                     $.ajax({
                        url: 'action_g.php',
                        type: 'post',
                        data: {
                           uni: id,
                           code: code
                        },
                        success: function(response) {
                        //    console.log(response);
                           document.getElementById("image_view").innerHTML = response;
                        }
                     });
                  }
function edit_student_details(id) {
// alert(id);
var Name = document.getElementById('Name').value;
var UniRollNo = document.getElementById('unirollno').value;
var upload_date = document.getElementById('upload_date21').value;
var FatherName = document.getElementById('FatherName').value;
var Gender = document.getElementById('Gender').value;
var Stream_ = document.getElementById('Stream_').value;
var Cgpa = document.getElementById('CGPA').value;
var examination = document.getElementById('examination').value;
var YearOfAdmission = document.getElementById('YearOfAdmission').value;

if (Name != '' && FatherName != '') {
    var code = 142;
    var data = {
        id: id,
        Name: Name,
        FatherName: FatherName,
        Stream: Stream_,
        Gender: Gender,
        UniRollNo: UniRollNo,
        upload_date: upload_date,
        YearOfAdmission:YearOfAdmission,
        Cgpa: Cgpa,examination:examination,
        code: code
    };

    // Send the AJAX request
    $.ajax({
        url: 'action_g.php',
        data: data,
        type: 'POST',
        success: function(response) {
            console.log(response); // Log the response for debugging
            if (response == 1) {
                SuccessToast('Data Updated successfully');
                // date_by_search();
            } else {
                ErrorToast('Try  after some time', 'bg-danger');

            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
} else {
    ErrorToast('All Input Required', 'bg-warning');
}
}



const date_ = new Date();
var day = String(date_.getDate()).padStart(2, '0');
var month = String(date_.getMonth() + 1).padStart(2, '0');
var year = date_.getFullYear();
var upload_ = `${year}-${month}-${day}`;
document.getElementById('upload_date').value = upload_;
</script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="image_view">22
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary"></button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="for_edit" tabindex="-1" role="dialog" aria-labelledby="for_editLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="for_editLabel">Edit Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_show">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button class="btn btn-primary" onclick="edit_student_details(<?=$id;?>)">Submit</button> -->
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="for_excel" tabindex="-1" role="dialog" aria-labelledby="for_excelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="for_excelLabel">Upload Records</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="btn-group w-100 mb-2">
                    <a class="btn" id="btn1" style="background-color:#223260; color: white; border: 1px solid;"
                        onclick="diploma_agri();bg(this.id);"> Diploma Agri </a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;"
                        onclick="diploma_other();bg(this.id);"> Diploma Other </a>
                    <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;"
                        onclick="degree();bg(this.id);"> Degree </a>

                    <a class="btn" id="btn4" style="background-color:#223260; color: white; border: 1px solid;"
                        onclick="certificate();bg(this.id);">Cetrificate </a>
                    <a class="btn" id="btn5" style="background-color:#223260; color: white; border: 1px solid;"
                        onclick="phd();bg(this.id);">PHD </a>

                </div>

                <div id="from_show_toggle">

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Send message</button> -->
            </div>
        </div>
    </div>
</div>
<?php

 include "footer.php";  ?>