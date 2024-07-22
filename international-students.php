<?php  
   include "header.php";   
   ?>
<script type="text/javascript">

function search_all_employee() {
    var code_access = '<?php echo $code_access; ?>';
    var emp_name = document.getElementById('emp_name').value;
    if (emp_name != '') {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 443;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                code_access: code_access,
                empID: emp_name
            },
            success: function(response) {
                spinner.style.display = 'none';
                document.getElementById("show_record1").innerHTML = response;
                document.getElementById('show_record').innerHTML = "";

            }
        });
    }
}

function searchStudentCollegeWise() {
    var Session = document.getElementById('session1').value;

    var StudentName = document.getElementById('StudentName1').value;
    var CollegeName = document.getElementById('CollegeName1').value;

    var Course = document.getElementById('Course1').value;
    var Batch = document.getElementById('Batch').value;
    var Status = document.getElementById('Status').value;
    var Eligibility = document.getElementById('Eligibility').value;
    var Lateral = document.getElementById('Lateral').value;
    if (Batch != '') { 
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = 454;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                Session: Session,
                CollegeName: CollegeName,
                Course: Course,
                Batch: Batch,
                Eligibility: Eligibility,
                LateralEntry: Lateral,
                StudentName: StudentName,
                Status: Status
            },
            success: function(response) {
                console.log(response);
                spinner.style.display = 'none';
                document.getElementById("show_record1").innerHTML = response;
                document.getElementById('show_record').innerHTML = "";

            }
        });
    }
    else
    {
        ErrorToast("Select Batch its mandatory","bg-warning");
    }
}

function fetchcourse1() {
    var College = document.getElementById('CollegeName1').value;
    var code = '269';
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                //console.log(data);
                $("#Course1").html("");
                $("#Course1").html(data);
            }
        }
    });
}

function fetchcourse() {
    var College = document.getElementById('CollegeName').value;
    var code = '269';
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                // console.log(data);
                $("#Course").html("");
                $("#Course").html(data);
            }
        }
    });
}

function fetch_state1(country_id) {
    alert(country_id);
    var code = '160';
    $.ajax({
        url: 'action_g.php',
        data: {
            country_id: country_id,
            code: code
        },
        type: 'POST',
        success: function(data) {
            console.log(data);
            if (data != "") {

                $("#State_1").html("");
                $("#State_1").html(data);
            }
        }
    });

}

function fetch_district1(state_id) {
    var code = '271';
    alert(state_id);
    $.ajax({
        url: 'action_g.php',
        data: {

            state_id: state_id,
            code: code
        },
        type: 'POST',
        success: function(data) {
            console.log(data);
            if (data != "") {

                $("#District_1").html("");
                $("#District_1").html(data);
            }
        }
    });

}

function lockUser(empID,type) {
    if (confirm("Really want to Lock") == true) {
 var code=445;   
 var  spinner= document.getElementById("ajax-loader");
 spinner.style.display='block';
       $.ajax(
       {
          url:"action_g.php ",
          type:"POST",
          data:
          {
             code:code,id:empID
          },
          success:function(response) 
          {
            console.log(response);
             spinner.style.display='none';
              if (response==1) {
                         SuccessToast('Successfully Locked');
                         if(type=='1')
                {
                    search_all_employee();
                }
                else{

                    searchStudentCollegeWise();
                }
                        }
                        else
                        {
                         ErrorToast('Something went worng','bg-danger' );
                        }
                       
          }
       });
}
else 
{

}
}

function unlockUser(empID,type) {
    if (confirm("Really want to UnLock") == true) {
 var code=446;   
 var  spinner= document.getElementById("ajax-loader");
 spinner.style.display='block';
       $.ajax(
       {
          url:"action_g.php ",
          type:"POST",
          data:
          {
             code:code,id:empID
          },
          success:function(response) 
          {
            console.log(response);
             spinner.style.display='none';
              if (response==1) {
                         SuccessToast('Successfully UnLocked');
                         if(type=='1')
                {
                    search_all_employee();
                }
                else{

                    searchStudentCollegeWise();
                }
                        }
                        else
                        {
                         ErrorToast('Something went worng','bg-danger' );
                        }
                       
          }
       });
}
else 
{

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

function lockedUnlockAll(status,type)
{
var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=447;
  var subjectIDs=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            subjectIDs.push(verifiy[i].value);
          }
     }
  if((typeof  subjectIDs[0]== 'undefined'))
  {
    // alert('');
    ErrorToast(' Select atleast one Student' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{subjectIDs:subjectIDs,code:code,status:status},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully ');
           
                if(type=='1')
                {
                    search_all_employee();
                }
                else{

                    searchStudentCollegeWise();
                }
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
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
      
      function showDivName() {
            var displayDiv = document.getElementById('unhide');
            var button = document.getElementById('expand');
            var studentNameInput = document.getElementById('StudentName1');

            var displayValue = (displayDiv.style.display === "block") ? "none" : "block";
            button.innerHTML = (displayValue === "block") ? "Search without name" : "Search by name";

            if (displayValue === "none") {
                studentNameInput.value = "";
            }

            displayDiv.style.display = displayValue;
        }
    
function updateStudentdata(id) {
    var batch = document.getElementById('ubatch').value;
    var eligible = document.getElementById('eligible').value;
    var status = document.getElementById('ustatus').value;
    var lock = document.getElementById('ulocked').value;
    var classroll = document.getElementById('classroll').value;
    var uniroll = document.getElementById('uniroll').value;
    var uniroll = document.getElementById('uniroll').value;
    var uniroll = document.getElementById('uniroll').value;
    var Collegechange = document.getElementById('Collegechange').value;
    var coursechange = document.getElementById('coursechange').value;
    var code = 220;
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: "action.php ",
        type: "POST",
        data: {
            code: code,
            batch: batch,
            status: status,
            lock: lock,
            id: id,
            classroll: classroll,
            uniroll: uniroll,
            eligible: eligible,
            coursechange: coursechange,
            Collegechange: Collegechange
        },
        success: function(response) {
            //  console.log(response);
            spinner.style.display = 'none';
            if (response == 1) {
                SuccessToast('Successfully Updated');

            } else {
                ErrorToast('Something went worng', 'bg-danger');
            }

        }
    });
}
    function fetchcourse(id)
{   
var code='325';
$.ajax({
url:'action.php',
data:{College:id,code:code},
type:'POST',
success:function(data){
if(data != "")
{ 
$("#coursechange").html("");
$("#coursechange").html(data);
}
}
});
}
</script>
<div class="modal fade" id="Updatestudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='student_record_for_update' style="text-align:center">

            </div>
            <div class="card-body" id="student_search_recordold" style="font-size:12px;">


            </div>

        </div>
    </div>
</div>
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
                <div class="row" id="image_view">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary"></button> -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="UpdateDesignationModalCenter21" tabindex="-1" role="dialog"
    aria-labelledby="UpdateDesignationModalCenter21" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id='updateRecord'>
            </div>




        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Student </h3>
                    <div class="card-tools">
                    <!-- <button id="expand" class="btn btn-success btn-xs" name="expand" onclick="showDivName();">Search by name</button> -->
                    </div>
                </div>
                <div class="card-body p-2">
                    <form action="export.php" method="post">
                        <input type="hidden" value="70" name="exportCode">
                        <div class="col-lg-12" id="unhide" style="display:none;">
        <label>Name</label>
        <input type="text" class="form-control" name="StudentName1" id="StudentName1" placeholder="Enter Student Name like..">
    </div>
                        <div class="col-lg-12">
                            
                            <label>College Name</label>
                            <select name="CollegeName" id='CollegeName1' onchange="fetchcourse1(this.value);"
                                class="form-control" >
                                <option value=''>Select Faculty</option>
                                <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where UserAccessLevel.IDNo='$EmployeeID' ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row['CollegeName']; 
                        $CollegeID = $row['CollegeID'];
                        ?>
                                <option value="<?=$CollegeID;?>"><?=$college;?></option>
                                <?php }
                        ?>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <label>Course</label>
                            <select id="Course1" name="Course1" class="form-control" >
                                <option value=''>Select Course</option>
                            </select>
                        </div>


                        <div class="col-lg-12 col-12">
                           
                                <label>Batch</label>

                                <select id="Batch" name="Batch" class="form-control"  required>
                                    <option value="">Batch</option>
                                    <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                  ?>
                                </select>
                           
                        </div>
<div class="container">
<div class="row">
                        <div class="col-lg-6" >
                            <label>Session</label>
                           
                            <select id="session1" name="session1" class="form-control">
                                <option value=''>Select Session </option>
                      <?php         

 $sql="SELECT DISTINCT Session from Admissions ORDER By Session Desc";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $session = $row['Session']; 
                        
                        ?>
                                <option value="<?=$session;?>"><?=$session;?></option>
                                <?php }
                        ?>

                              
                            </select>
                           
                        </div>
                        <div class="col-lg-6" >
                            <label>Lateral</label>
                           
                            <select id="Lateral" name="Lateral" class="form-control">
                              
                                <option value='No'>No </option>
                                <option value='Yes'>Yes </option>
                      
                              
                            </select>
                           
                        </div>
                      </div>
                      </div>

                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Status </label>
                                <!-- <input type="text" class="form-control" name="employmentStatus" placeholder="Enter employment status"> -->
                                <select class="form-control" id="Status" name="Status">

                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">DeActive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label>Eligibility </label>
                                <!-- <input type="text" class="form-control" name="employmentStatus" placeholder="Enter employment status"> -->
                                <select class="form-control" id="Eligibility" name="Eligibility">

                                    <option value="">Select</option>
                                    <option value="0">Not Eligible</option>
                                    <option value="1">Eligible</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <br>
                                <button type="button" class="btn btn-warning"
                                    onclick="searchStudentCollegeWise();"><i class=" fa fa-search"></i></button>

    
                                    <button type="submit"  class="btn btn-success  float-right">
                                    
                                    <i class="fa fa-file-excel">&nbsp;&nbsp;</i>

                               


                                </button>
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




                    <span style="float:right;">
                        <button class="btn btn-sm ">
                       <!--      <input type="search" 
                                class="form-control form-control-sm" name="emp_name" id="emp_name"
                                placeholder="Search here"> -->
                        </button>
                       <!--  <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
                            Search
                        </button> -->
                    </span>

                    <input type="hidden" id="CollegeID_Set">


                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <form action="action_g.php" method="post" enctype="multipart/form-data">
                        <div class="table-responsive" id="show_record1" style="height:auto;">
                            <!-- Your table to display employee records goes here -->
                        </div>
                        <div class="table-responsive" id="show_record" style="height:auto;">
                            <!-- Your table to display employee records goes here -->
                        </div>
                    </form>
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