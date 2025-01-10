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



  function uploadSubmit() {


  var course=document.getElementById('Course').value;
   var batch=document.getElementById('Batch').value;
  var semester=document.getElementById('Semester').value;
  var day=document.getElementById('Day').value;
   var lecture=document.getElementById('Lecture').value;
   var subject=document.getElementById('Subject').value;
   var section=document.getElementById('Section').value;
   var group=document.getElementById('Group').value;

   if(course!='' && batch!='' && semester!=''&& day!='' && lecture !='' &&subject!='' && section !='' )
   {
  var code = 14;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: {
            flag: code,course:course,batch:batch,semester:semester,day:day,lecture:lecture,subject:subject,section:section,group:group
        },
        success: function(response) {
            console.log(response);


         if(response=='2')
            {

               ErrorToast('You already have a lecture on this day',"bg-danger" );
            }
            else if(response=='1')
            {
               SuccessToast('Succesfully added');
            }
            else
            {
ErrorToast('Already Added by You or Other Employee Contact HOD or Dean For more Detail',"bg-danger" );
            }
           
            spinner.style.display = 'none';
            
            uploadedRecord();
        }
    });
}
else
{
 ErrorToast('Valid input required',"bg-danger" );
}

}
//fetch record
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

function Programwise(id) {
   
    var code = 25;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: {
            flag: code
        },
        success: function(response) {
             console.log(response);
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
        }
    });
}
function GridView(id) {
   
    var code = 25.1;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: {
            flag: code
        },
        success: function(response) {
             console.log(response);
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
        }
    });
}
function Consolidated(id) {
   
    var code = 25.2;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: {
            flag: code
        },
        success: function(response) {
             console.log(response);
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
        }
    });
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
                            <select name="Course" id='Course' 
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
                         <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Day</label>
                                <?php $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];?>
                                <select name="Day" id="Day" class="form-control" required="">
                                    <option value="">Day</option>
                                    <?php foreach ($daysOfWeek as $days)
                                    {
                                    ?>
                                        <option value="<?=$days;?>"><?=$days;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Lecture</label>
                                <select name="Lecture" id="Lecture" class="form-control" required="">
                                    <option value="">Lecture</option>
                                    <?php for($i=1;$i<=8;$i++)
                                    {
                                    ?>
                                        <option value="<?=$i;?>"><?=$i;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                         </div>
                           <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                     <label>Section</label>
                                <select name="Section" id="Section" class="form-control" required="">
                                    <option value="">Section</option>
                                  
                                        <option value="A">A</option>
                                          <option value="B">B</option>
                                            <option value="C">C</option>
                                              <option value="D">D</option>
                                                <option value="E">E</option>
                                  
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>Group</label> <span style="color:red"><b>(if Rerquired)</b></span>
                               <select name="Group" id="Group" class="form-control" required="">
                                    <option value="">Group</option>
                                  
                                        <option value="G1">G1</option>
                                          <option value="G2">G2</option>
                                            <option value="G3">G3</option>
                                              <option value="G4">G4</option>
                                          
                                  
                                </select>
                            </div>
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
                     
                        <button type="button" onclick="Programwise(<?=$EmployeeID;?>);" class="btn btn-success btn-sm">
                            Program Wise
                        </button>
                        <button type="button" onclick="GridView(<?=$EmployeeID;?>);" class="btn btn-success btn-sm">
                            Grid View
                        </button>
                        <button type="button" onclick="Consolidated(<?=$EmployeeID;?>);" class="btn btn-success btn-sm">
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