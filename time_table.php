<?php  
   include "header.php";   
   ?>
<script type="text/javascript">

$(function() { 
      $("#Course").change(function(e) {
        e.preventDefault();
        var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
        var course = $("#Course").val();
       var College = $("#College").val();
      
           

         
        var code='396';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code,College:College},
            type:'POST',
            success:function(data)
            { 
                spinner.style.display = 'none';
             if(data != "")
                {
                
                    $("#Batch").html("");
                    $("#Batch").html(data);
                }
            }
          });
    });
  });
$(function() { 
      $("#Batch").change(function(e) {
        e.preventDefault();
        var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
        var College = $("#College").val();
        var course = $("#Course").val();
        var Batch = $("#Batch").val();
      
           

         
        var code='396.1';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code,College:College,Batch:Batch},
            type:'POST',
            success:function(data)
            { 
                spinner.style.display = 'none';
             if(data != "")
                {
                
                    $("#Semester").html("");
                    $("#Semester").html(data);
                }
            }
          });
    });
  });
$(function() { 
      $("#Semester").change(function(e) {
        e.preventDefault();
        var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
        var course = $("#Course").val();
       var batch = $("#Batch").val();
       var sem = $("#Semester").val();  
           

         
        var code='200.1';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code,batch:batch,sem:sem},
            type:'POST',
            success:function(data)
            { 
                spinner.style.display = 'none';
             if(data != "")
                {
                
                    $("#Subject").html("");
                    $("#Subject").html(data);
                }
            }
          });
    });
  });



  function uploadSubmit(form) {

var College = form.College.value;
var Course = form.Course.value;
var Batch = form.Batch.value;
var Semester = form.Semester.value;
var subject = form.subject.value;
var courseFile = form.courseFile.value;

if (College === "") {

    ErrorToast('Please select college.', 'bg-warning');
    return;
}
if (Course === "") {

    ErrorToast('Please select Course.', 'bg-warning');
    return;
}
if (Batch === "") {

    ErrorToast('Please select Batch.', 'bg-warning');
    return;
}
if (Semester === "") {

    ErrorToast('Please select Semester.', 'bg-warning');
    return;
}
if (subject === "") {

    ErrorToast('Please select subject.', 'bg-warning');
    return;
}

if (courseFile === "") {

    ErrorToast('Please choose course file', 'bg-warning');
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
        // console.log(response);
        if (response == 1) {
            SuccessToast('Submit successfully');
            uploadedRecord();
            document.getElementById("Semester").value = "";
            document.getElementById("subject").value = "";
            document.getElementById("courseFile").innerHTML = "";

        } 
        else if(response == 2)
        {
            ErrorToast('Please upload the file in (.PDF) format only.', 'bg-warning');
        }
        else{
            ErrorToast('Please try after sometime.', 'bg-danger');
        }
    },
    error: function(xhr, status, error) {
        console.log(error);
    }
    
});
}
uploadedRecord();
function uploadedRecord() {
   
    var code = 396.2;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
        }
    });
}

function deleteCourseFile(id) {

var a = confirm('Are you sure you want to delete');

if (a == true) {
    var code = 396;

    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            id: id
        },
        success: function(response) {
            if (response == 1) {
                spinner.style.display = 'none';
                SuccessToast('SuccessFully Deleted');
                uploadedRecord();
            }

        }
    });
} else {

}
}

function viewCourseFile(url)
 {
 if(url.indexOf("CouresUpload")==true)
 {
     window.open("http://erp.gku.ac.in:86/" + url, '_blank');

 }else{

     window.open("http://erp.gku.ac.in:86/CouresUpload/" + url, '_blank');
 }
 }
</script>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Time Table  for - <?=$CurrentExamination;?></h3>
                </div>
                <div class="card-body p-2">
                    <form action="action_g.php" method="post">
                        <input type="hidden" value="397" name="code">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Program</label>
                            <select name="Course" id='Course' onchange="courseByCollegeSelf(this.value)"
                                class="form-control" required="">
                                <option value=''>Select Program</option>
                                <?php
                                $sql="SELECT DISTINCT MasterCourseStructure.Course,MasterCourseStructure.CourseID from MasterCourseStructure
                                  INNER JOIN SubjectAllotment on  SubjectAllotment.SubjectCode = MasterCourseStructure.SubjectCode Where  SubjectAllotment.EmployeeID='$EmployeeID' ";
                                    $stmt2 = sqlsrv_query($conntest,$sql);
                                while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                    {

                                $college = $row1['Course']; 
                                $CollegeID = $row1['CourseID'];
                                ?>
                                <option value="<?=$CollegeID;?>"><?= $college;?></option>
                                <?php    }

                                            ?>
                            </select>
                        </div>
                       
                       <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Batch</label>
                            <select name="Batch" class="form-control" id="Batch" required="">
                               
                                <option value="">Batch</option>
                               
                            </select>
                        </div>
                       <div class="col-lg-12 col-md-12 col-sm-12">
                            <label> Semester</label>
                            <select id='Semester' name="Semester" class="form-control" required="">
                                <option value="">Semester</option>
                                <!-- <?php 
                                for($i=1;$i<=12;$i++)
                                {?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php }
                                  ?> -->
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Subject</label>
                                <select name="subject" id="Subject" class="form-control" required="">
                                    <option value="">Subject</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Day</label>
                                <?php $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];?>
                                <select name="lecture" id="lecture" class="form-control" required="">
                                    <option value="">Day</option>
                                    <?php foreach ($daysOfWeek as $days)
                                    {
                                    ?>
                                        <option value="<?=$days;?>"><?=$days;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Lecture</label>
                                <select name="lecture" id="lecture" class="form-control" required="">
                                    <option value="">Lecture</option>
                                    <?php for($i=1;$i<=8;$i++)
                                    {
                                    ?>
                                        <option value="<?=$i;?>"><?=$i;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                         
                       
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <br>
                                <button type="button" class="btn btn-success"
                                onclick="uploadSubmit(this.form);">Upload</button>
                             
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
            <div class="card card-outline">

                <div class="card-header">


               My Time Table

                    <span style="float:right;">
                     
                        <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
                            Program Wise
                        </button>
                        <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
                            Grid View
                        </button>
                        <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
                           Consolidated
                        </button>
                    </span>

                    <!-- <input type="hidden" id="CollegeID_Set"> -->


                </div>
                <div class="card-body p-0">
                
                        <div class="table-responsive" id="table_load" style="height:auto;">
                         
                        </div> 
                 
                  
                </div>
    
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