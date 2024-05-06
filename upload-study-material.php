<?php  
   include "header.php";   
   ?>
<script type="text/javascript">
function courseByCollegeSelf(College) 
{  
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
var code='90.1';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
    spinner.style.display = 'none';
if(data != "")
{
    
$("#Course").html("");
$("#Course").html(data);
}
}
});

}
$(function() { 
      $("#Course").change(function(e) {
        e.preventDefault();
        var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
        var course = $("#Course").val();
       var College = $("#College").val();
      
           

         
        var code='200.2';
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
      
           

         
        var code='200.3';
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
var Topic = form.Topic.value;
var Type = form.Type.value;

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
if (Topic === "") {

    ErrorToast('Please enter topic name.', 'bg-warning');
    return;
}
if (Type === "") {

    ErrorToast('Please select type.', 'bg-warning');
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
            SuccessToast('Leave submit successfully');
            uploadedRecord();
            document.getElementById("Semester").value = "";
            document.getElementById("subject").value = "";
            document.getElementById("courseFile").innerHTML = "";

        } 
        else if(response == 2)
        {
            ErrorToast('The document type does not match the chosen file format', 'bg-warning');
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
   
    var code = 400;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            console.log(response);
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

function viewCourseFile(url) {

        window.open("http://erp.gku.ac.in:86"+url, '_blank');
   

}

</script>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upload Study Material </h3>
                </div>
                <div class="card-body p-2">
                    <form action="action_g.php" method="post">
                        <input type="hidden" value="399" name="code">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>College</label>
                            <select name="College" id='College' onchange="courseByCollegeSelf(this.value)"
                                class="form-control" required="">
                                <option value=''>Select College</option>
                                <?php
                                $sql="SELECT DISTINCT MasterCourseStructure.CollegeName,MasterCourseStructure.CollegeID from MasterCourseStructure
                                  INNER JOIN SubjectAllotment on  SubjectAllotment.SubjectCode = MasterCourseStructure.SubjectCode Where  SubjectAllotment.EmployeeID='$EmployeeID' ";
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
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Course</label>
                            <select name="Course" id="Course" class="form-control">
                                <option value=''>Select Course</option>

                            </select>
                        </div>
                       <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Batch</label>
                            <select name="Batch" class="form-control" id="Batch" required="">
                               
                               
                            </select>
                        </div>
                       <div class="col-lg-12 col-md-12 col-sm-12">
                            <label> Semester</label>
                            <select id='Semester' name="Semester" class="form-control" required="">
                                <option value="">Sem</option>
                                <?php 
                                for($i=1;$i<=12;$i++)
                                {?>
                                <option value="<?=$i?>"><?=$i?></option>
                                <?php }
                                  ?>
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            
                                <label>Subject</label>
                                <select name="subject" id="Subject" class="form-control" required="">
                                    <option value="">Subject</option>
                                </select>            
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">          
                                <label>Docuemnt Type</label>
                                <select name="Type" id="Type" class="form-control" required="">
                                    <option value="PDF">PDF</option>
                                    <option value="PPT">PPT</option>
                                    <option value="Video/Audio">Video/Audio</option>
                                </select>                
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">                     
                                <label>Topic</label>
                               <input type="text" class="form-control" name="Topic" id="Topic">                       
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                                <label>File</label>
                                <input type="file" name="courseFile" id="courseFile" class="form-control" accept=".ppt, .pptx, .pdf, audio/*, video/*">

                           
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                           
                                <br>
                                <button type="button" class="btn btn-success"
                                onclick="uploadSubmit(this.form);">Upload</button>
                             
                           
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


                View Study Material

                    <!-- <span style="float:right;">
                        <button class="btn btn-sm ">
                            <input type="search" 
                                class="form-control form-control-sm" name="emp_name" id="emp_name"
                                placeholder="Search here">
                        </button>
                        <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
                            Search
                        </button>
                    </span> -->

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