<?php
include "header.php";
$degree="SELECT * FROM MasterCourseCodes  "; 
$degree_run=sqlsrv_query($conntest,$degree);
while ($degree_row=sqlsrv_fetch_array($degree_run)) 
{
$data[]=$degree_row;
}
// print_r($data);
?>

<div class="modal fade" id="for_edit" tabindex="-1" role="dialog" aria-labelledby="for_editLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="for_editLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_show">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="edit_record();">Update</button>
            </div>
        </div>
    </div>   

</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Mater Course Codes</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body collapse">
                        <div class="row">
                            <div class="col-lg-3" style="text-align: ;">
                                <label>Select Session</label>
                                <br>
                                <select id="session1" class="btn btn-default">
                                    <?php 
for($s='2015';$s<='2030';$s++)
{
  ?>
                                    <option value='<?=$s;?>'><?=$s;?></option>
                                    <?php }?>
                                </select>
                                <select id="session2" class="btn btn-default">
                                    <?php 
for($s1='16';$s1<='31';$s1++)
{
  ?>
                                    <option value='<?=$s1;?>'><?=$s1;?></option>
                                    <?php }?>
                                </select>
                                <select id="session3" class="btn btn-default">
                                    <option value=''></option>
                                    <option value='A'>A</option>
                                    <option value='J'>J</option>
                                </select>
                            </div>
                            <div class="col-lg-3" style="text-align: left;">
                                <label>College Name</label>
                                <select id='College3' onchange="collegeByDepartment3(this.value);" class="form-control"
                                    required>
                                    <option value=''>Select Faculty</option>
                                    <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                                    <option value="<?=$CollegeID;?>"><?=$college;?> (<?=$CollegeID;?>)</option>
                                    <?php }
                        ?>
                        <!-- <option value="other">Other</option> -->
                                </select>
                            </div>
                            <div class="col-lg-2" style="text-align: left;">
                                <label>Department</label>
                                <select id="Department3" class="form-control" onchange="fetchcourse3()" required>
                                    <option value=''>Select Department</option>
                                   
                                </select>
                            </div>
                            <div class="col-lg-2" style="text-align: left;">
                                <label>Course</label>
                                <select id="Course3" onchange="courseOnChnageOther(this.value);" class="form-control" required>
                                    <option value=''>Select Course</option>
                                </select>
                            </div>
                            
                            <div class="col-lg-2" id="typeCourseDiv" style=" display:none;">
                                <label> Course Name</label>
                               <input type="text"  id="CourseNew" class="form-control">
                            </div>
                           
                            <div class="col-lg-2" style="text-align: left;">
                                <label>Batch</label>
                                <select id="Batch3" class="form-control" required>
                                    <option value="">Batch</option>
                                    <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                               ?>
                                </select>
                            </div>
                       
                       
                            <div class="col-lg-3" >

                                <label>First RollNo</label>
                                <input type="text" id="FirstRollNo" class="form-control">
                            </div>
                            <div class="col-lg-3" style="text-align:;">
                                <label>Last RollNo </label>
                                <input type="text" id="LastRollNo" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label>ValidUpto</label>
                                <input type="date" id="ValidUpTo" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label>Lateral Entry</label>
                                <select id="LateralEntry" name="LateralEntry" class="form-control" required>
                                    <option value="No">NO</option>
                                    <option value="Yes">Yes</option>

                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-2" id="DurationDiv" style=" display:none;">
                                <label>Duration</label>
                               
                                <br>
                                <select id="duration1" class="btn btn-default">
                                    <option value=''>Y</option>
                                    <?php 
for($s='1';$s<='10';$s++)
{
  ?>
                                    <option value='<?=$s;?>'><?=$s;?></option>
                                    <?php }?>
                                </select>
                                <select id="duration2" class="btn btn-default">
                                <option value=''>M</option>
                                    <?php 
for($s1='0';$s1<='6';$s1++)
{
  ?>
                                    <option value='<?=$s1;?>'><?=$s1;?></option>
                                    <?php }?>
                                </select>
                               
                            </div>
                        
                <div class="col-lg-2" id="TypeDiv" style="display:none;">
                    <label>Course Type</label>
                    <select class="form-control" id="CourseType"
                       >
                        <option value="">Select</option>
                        <option value="UG">UG</option>
                        <option value="PG">PG</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Ph.D">Ph.D</option>
                    </select>
                </div>
                            
                            
                        </div>
                        <div class="card-footer">
                            
                            <input type="button" name="" class="btn btn-success" value="Add" onclick="addSeriesAndNewCourse();" style="float:right;">
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-3">
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-3">
                                <select id='CollegeName' onchange="collegeByDepartment(this.value);"
                                    class="form-control" required>
                                    <option value=''>Select Faculty</option>
                                    <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                                    <option value="<?=$CollegeID;?>"><?=$college;?> (<?=$CollegeID;?>)</option>
                                    <?php }
                        ?>
                                </select>
                            </div>
                            <div class="col-lg-3">

                                <select id="Department" class="form-control" onchange="fetchcourse()" required>
                                    <option value=''>Select Department</option>
                                </select>
                            </div>


                            <div class="col-lg-3">

                                <select id="Course" class="form-control" required>
                                    <option value=''>Select Course</option>
                                </select>
                            </div>
                            <div class="col-lg-2">

                                <select id="Batch" name="batch" class="form-control" required>
                                    <option value="">Batch</option>
                                    <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                  ?>
                                </select>
                            </div>
                            <div class="col-lg-1">

                                <button type='button' class='btn btn-success'
                                    onclick='by_search_studetn();'>Search</button>
                            </div>
                        </div>

                        <div class="card-tools">
                            <div class="input-group input-group-sm">

                            </div>
                        </div>
                    </div>
                    <script>
                    function by_search_studetn() {

                        var currentPage = 1;
                        var code = 156;
                        var searchQuery = '';
                        var CollegeName = document.getElementById('CollegeName').value;
                        var Department = document.getElementById('Department').value;
                        var Course = document.getElementById('Course').value;
                        var Batch = document.getElementById('Batch').value;

                        $.ajax({
                            url: 'action_g.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                page: currentPage,
                                code: code,
                                CollegeName: CollegeName,
                                Department: Department,
                                Course: Course,
                                Batch: Batch,
                                search: searchQuery // Pass the search query to the server
                            },
                            success: function(data) {

                                buildTable(data);
                                updatePagination(currentPage);
                                console.log(data);
                            },
                            error: function() {
                                // Handle error response
                            }
                        });
                    }
                    var currentPage = 1;
                    var code = 156;
                    var searchQuery = '';
                    var CollegeName = '';
                    var Department = '';
                    var Course = '';
                    var Batch = '';
                    loadData(currentPage);

                    function loadData(page) {
                        // var by_search=document.getElementById('by_search').value;
                        $.ajax({
                            url: 'action_g.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                page: page,
                                code: code,
                                CollegeName: CollegeName,
                                Department: Department,
                                Course: Course,
                                Batch: Batch,
                                search: searchQuery // Pass the search query to the server
                            },
                            success: function(data) {

                                buildTable(data);
                                updatePagination(page);
                            },
                            error: function() {
                                // Handle error response
                            }
                        });
                    }


                    function buildTable(data) {
                        var table = '<table class="table table-bordered">';
                        table += '<tr>';
                        table +=
                            '<div id="pagination"><td colspan="3"> <button id="prev-btn" class="btn btn-primary " disabled>Previous</button></td><td colspan="">  </td><td></td><td></td><td><button id="next-btn" class="btn btn-primary ">Next</button></td></div>';
                        table += '</tr>';
                        table +=
                            '<tr><th width="10">Session</th><th>College</th><th>Course</th><th>ShortName</th><th>Batch</th><th>LateralEntry</th><th>ClassRollNo</th><th>Action</th></tr>';

                        for (var i = 0; i < data.length; i++) {
                            var unirollno = data[i][6];
                            table += '<tr>';
                            table += '<td>' + data[i][1] + '</td>';
                            table += '<td>' + data[i][2] +' ('+ data[i][10] + ')</td>';
                            table += '<td>' + data[i][3] +' ('+ data[i][11] + ')</td>';
                            table += '<td>' + data[i][4] + '</td>';
                            table += '<td >' + unirollno + '</td>';
                            table += '<td >' + data[i][5] + '</td>';
                            table += '<td >' + data[i][8] + '</td>';
                            table += '<td><button onclick="edit_student(' + data[i][0] +
                                ');" data-toggle="modal" data-target="#for_edit" class="btn btn-success btn-xs " ><i class="fa fa-edit"></i></button ></td>';
                            table += '</tr>';
                        }

                        table += '</table>';

                        $('#data-table').html(table);
                    }

                    function updatePagination(page) {
                        var totalPages = Math.ceil(100000 / 100);

                        if (page == 1) {
                            $('#prev-btn').prop('disabled', true);
                        } else {
                            $('#prev-btn').prop('disabled', false);
                        }

                        if (page + 1 == totalPages) {
                            $('#next-btn').prop('disabled', true);
                        } else {
                            $('#next-btn').prop('disabled', false);
                        }
                    }

                    $(document).on('click', '.pagination-button', function() {
                        var page = $(this).data('page');
                        currentPage = page;
                        loadData(currentPage);
                    });

                    $(document).on('click', '#prev-btn', function() {
                        if (currentPage > 1) {
                            currentPage--;
                            loadData(currentPage);
                        }
                    });

                    $(document).on('click', '#next-btn', function() {
                        var totalPages = Math.ceil(100000 / 100);
                        if (currentPage < totalPages) {
                            currentPage++;
                            loadData(currentPage);
                        }
                    });
                    </script>
                    <div id="data-table" class='table-responsive'>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.card-header -->
    </div>
    <!-- /.card -->
</section>
<!-- Button trigger modal -->
<!-- Modal -->

<p id="ajax-loader"></p>
<script type="text/javascript">
function edit_record() {
    var id = document.getElementById('master_id').value;
    var CollegeID = document.getElementById('CollegeName1').value;
    var Department = document.getElementById('Department1').value;
    var Course = document.getElementById('Course1').value;
    var CourseShortName = document.getElementById('CourseShortName').value;
    var Batch = document.getElementById('Batch1').value;
    var session = document.getElementById('Session').value;
    var selectBoxCollegeName1 = document.getElementById("CollegeName1");
    var selectedIndex = selectBoxCollegeName1.selectedIndex;
    var CollegeName = selectBoxCollegeName1.options[selectedIndex].text; // Fix: Removed ()
    var LateralEntry = document.getElementById('LateralEntry').value;
    var ClassRollNo = document.getElementById('ClassRollNo').value;
    var EndClassRollNo = document.getElementById('EndClassRollNo').value;
    var Isopen = document.getElementById('Isopen').value;
    var Status = document.getElementById('Status').value;
    var CourseType = document.getElementById('CourseType').value;
    var Duration = document.getElementById('Duration').value;
    if (CollegeID != '' && Department != '') {
        var code = 158;
        var data = {
            id: id,
            code: code,
            Session: session,
            CollegeName: CollegeName,
            Course: Course,
            CourseShortName: CourseShortName,
            DepartmentId: Department,
            CollegeID: CollegeID,
            Batch: Batch,
            LateralEntry: LateralEntry,
            ClassRollNo: ClassRollNo,
            Isopen: Isopen,
            EndClassRollNo: EndClassRollNo,
            CourseType: CourseType,
            Duration: Duration,
            Status: Status
        };
        // Send the AJAX request
        $.ajax({
            url: 'action_g.php',
            data: data,
            type: 'POST',
            success: function(response) {
                //  console.log(response); // Log the response for debugging
                if (response == 1) {
                    by_search_studetn();
                    SuccessToast('Data submitted successfully');
                } else {
                    ErrorToast('Try after some time', 'bg-danger');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    } else {
        ErrorToast('All input required', 'bg-warning');
    }
}

function addSeriesAndNewCourse() {
var session1=document.getElementById('session1').value;
var session2=document.getElementById('session2').value;
var session3=document.getElementById('session3').value;

    if (session1 != '' && session2 != '' && session3!='') 
    {
        var Session = session1 + '-' + session2 + '-' + session3;
    } 
    else if(session1 != '' && session2 != '')
    {
        var Session = session1 + '-' + session2 ;
    }
    else
     {
        var Session = "";
    }

var College3=document.getElementById('College3').value;
var Department3=document.getElementById('Department3').value;
var Course=document.getElementById('Course3').value;
var CourseNew=document.getElementById('CourseNew').value;
var Batch3=document.getElementById('Batch3').value;
var FirstRollNo=document.getElementById('FirstRollNo').value;
var LastRollNo=document.getElementById('LastRollNo').value;
var ValidUpTo=document.getElementById('ValidUpTo').value;
var LateralEntry=document.getElementById('LateralEntry').value;
var durationYears=document.getElementById('duration1').value;
var durationMonth=document.getElementById('duration2').value;

var CourseType=document.getElementById('CourseType').value;
   

    if (College3!='' &&Department3!='' &&Batch3!='' &&FirstRollNo!='' &&LastRollNo!='' &&ValidUpTo!='' &&LateralEntry!='' &&CourseType && durationYears!='')

    {
        var code = 305;
        var data = {
            Session:Session,
College3:College3,
Department3:Department3,
Course:Course,
CourseNew:CourseNew,
Batch3:Batch3,
FirstRollNo:FirstRollNo,
LastRollNo:LastRollNo,
ValidUpTo:ValidUpTo,
LateralEntry:LateralEntry,
durationYears:durationYears,
durationMonth:durationMonth,
CourseType:CourseType,
            code: code
        };
        $.ajax({
            url: 'action_g.php',
            data: data,
            type: 'POST',
            success: function(response) {
                console.log(response);
                if (response == 1) {
                    SuccessToast('Data submitted successfully');
                } else if (response == 2) {
                    ErrorToast('ID Proof Already Exist', 'bg-warning');
                } else {
                    ErrorToast('Try  after some time', 'bg-danger');

                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // alert('An error occurred while submitting data. Please try again.');
            }
        });
    } else {
        ErrorToast('All Input Required', 'bg-warning');
    }
}



function edit_student(id) {
    // alert(id);  
    var code = '157';
    $.ajax({
        url: 'action_g.php',
        data: {
            id: id,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);

            document.getElementById('edit_show').innerHTML = data;
        }
    });

}

function collegeByDepartment1(College) {

    var code = '304';
    $.ajax({
        url: 'action.php',
        data: {
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {

                $("#Department1").html("");
                $("#Department1").html(data);
            }
        }
    });

}

function fetchcourse1() {
    var College = document.getElementById('CollegeName1').value;
    var department = document.getElementById('Department1').value;
    var code = '305';
    $.ajax({
        url: 'action.php',
        data: {
            department: department,
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                // console.log(data);
                $("#Course1").html("");
                $("#Course1").html(data);
            }
        }
    });
}

function collegeByDepartment3(College) {

    var code = '304';
    $.ajax({
        url: 'action.php',
        data: {
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {

                $("#Department3").html("");
                $("#Department3").html(data);
            }
        }
    });

}
 
function fetchcourse3() {
    var College = document.getElementById('College3').value;
    var department = document.getElementById('Department3').value;
    var code = '305';
    $.ajax({
        url: 'action.php',
        data: {
            department: department,
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                console.log(data);
                $("#Course3").html("");
                $("#Course3").html(data);
            }
        }
    });
}
function courseOnChnageOther(value) {
    // alert(value);
   if(value=='other')
   {
$('#typeCourseDiv').show();
$('#DurationDiv').show();
$('#TypeDiv').show();
}
else
{
       $('#typeCourseDiv').hide();
       $('#DurationDiv').hide();
$('#TypeDiv').hide();

   }
}



function fetchcourse() {



    var College = document.getElementById('CollegeName').value;
    var department = document.getElementById('Department').value;

    var code = '305';
    $.ajax({
        url: 'action.php',
        data: {
            department: department,
            College: College,
            code: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                //   console.log(data);
                $("#Course").html("");
                $("#Course").html(data);
            }
        }
    });

}
</script>
<?php
include "footer.php";
?>