<?php

   include "header.php";
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Enquiry</h3>
                    
                    </div>
                    <div class="card-body table-responsive  ">
                        <div class="row" style="min-height:400px;">
                            <div class="col-lg-12">

                                <!-- <form action="#" method="POST"> -->
                                <!-- <input type="hidden" name="code" value="11"> -->

                                <input type="text" id="name" pattern="[A-Za-z ]{0,}" class="form-control"
                                    placeholder="Name" required="" style="height: 40px;">
                                <br>
                                <input type="email" id="email" class="form-control" placeholder="Email Address"
                                    required="" style="height: 40px;">

                                <br>
                                <input type="text" id="phone" class="form-control" minlength="10" maxlength="10"
                                    placeholder="Phone Number" required="" style="height: 40px;">

                                <br>
                                <input type="text" id="course" class="form-control" pattern="[A-Za-z ]{0,}"
                                    placeholder="Course Interested" required="" style="height: 40px;">

                                <br>


                                <select class="form-control" id="sourse" style="height: 40px;" required=""  onchange="ShowDivSource(this.value);">
                                    <option value="">Select Sourse</option>
                                    <option value="News Paper">News Paper</option>
                                    <option value="Website">Website</option>
                                    <option value="Friends">Friends</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Self Motivated">Self Motivated</option>
                                </select>

                                <br>
                                <div id="SourceName1" style='display:none'>
                                <input type="text" placeholder="Teacher Name" class="form-control" id="SourceName" >
                                <br>
</div>
                                <select class="form-control" id="counter" style="height: 40px;" required="">
                                    <option value="">Select Counter</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>

                                <br>
                                <button type="button" onclick="submitEnquiry();" name="submit"
                                    class="btn btn-success">Submit</button>


                                <!-- </form> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="card card-info">
                    <div class="card-header ">
                        <div class="col-lg-2">
                            <h3 class="card-title">Enquiry Data</h3>
                               
                            </div>
                            <div class="col-lg-10">
                                <div class="card-tools">
                                    <div class="row">
                                        <!-- <div class="col-lg-3">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="userId"
                                                    placeholder="Employee ID / Roll Number"
                                                    aria-describedby="button-addon2">
                                                <button class="btn btn-info btn-sm" type="button" id="button-addon2"
                                                    onclick="searchUser()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-8">

                                        </div>
                                        <div class="col-lg-5">
                                            <!-- <form action="adm-enquiry-report-print.php" method="post" -->
                                                <!-- target="_blank"> -->
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-danger"
                                                            id="inputGroup-sizing-sm">Start</span>
                                                    </div>
                                                    <input required type="date" class="form-control"
                                                        name="startDate" id="startDate" aria-describedby="button-addon2">
                                                    &nbsp;
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-success"
                                                            id="inputGroup-sizing-sm">End</span>
                                                    </div>
                                                    <input required type="date" class="form-control"
                                                        name="endDate" id="endDate" aria-describedby="button-addon2">
                                                    <button class="btn btn-info btn-sm" onclick="exportData();" type="button"
                                                        id="StartD"><i class="fa fa-file-export"></i></button> &nbsp;
 <button class="btn btn-info btn-sm" onclick="getRecord();" type="button"
                                                        id="StartD"><i class="fa fa-search"></i></button>

                                                </div>
                                            <!-- </form> -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-body table-responsive  ">
                        <div class="row">
                            <table class="table" id="example" >
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Course </th>
                                        <th>Source</th>
                                        <th>Token Number</th>
                                        <th>Counter No</th>
                                        <th>Response</th>
                                        <th>Action</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="getTable">
                                   
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<p id="ajax-loader"></p>
<script>
    function exportData() {
    var exportCode = 69;
    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;
    if (startDate != '' && endDate != '') {
        window.open("export.php?exportCode=" + exportCode + "&from=" + startDate + "&to=" + endDate, '_blank');
    } else {
        ErrorToast('All input required','bg-warning');
    }
}
    function ShowDivSource(id)
{
   // alert(id);
   if (id=='Teacher')
    {
   $('#SourceName1').show('Slow');
}
else
{
    $('#SourceName1').hide('Slow');
    document.getElementById('SourceName').value="";

    }

}
    getRecord();
function submitEnquiry() {
    var code = 409;
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var mobile = document.getElementById('phone').value;
    var course = document.getElementById('course').value;
    var source = document.getElementById('sourse').value;
    var counter = document.getElementById('counter').value;
    var SourceName = document.getElementById('SourceName').value;
    
    if(name=='')
    {
        ErrorToast('Please enter name.', 'bg-warning');
        return;
    }
    // if(email=='')
    // {
    //     ErrorToast('Please enter email.', 'bg-warning');
    //     return;
    // }
    if(mobile=='')
    {
        ErrorToast('Please enter mobile.', 'bg-warning');
        return;
    }
    if(course=='')
    {
        ErrorToast('Please enter course.', 'bg-warning');
        return;
    }
    if(source=='')
    {
        ErrorToast('Please select source.', 'bg-warning');
        return;
    }
    if(counter=='')
    {
        ErrorToast('Please select counter.', 'bg-warning');
        return;
    }
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code:code,
            name: name,
            email: email,
            mobile: mobile,
            course: course,
            source: source,
            counter: counter,
            SourceName:SourceName
        },
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
                SuccessToast('Successfully Submited');
                getRecord();
            }
            else{

            }

        }
    });

}
function updateRecord(id) {
    var code = 412;
    var name = document.getElementById('nameA').value;
    var email = document.getElementById('emailA').value;
    var mobile = document.getElementById('phoneA').value;
    var course = document.getElementById('courseA').value;
    var source = document.getElementById('sourseA').value;
    var counter = document.getElementById('counterA').value;
    var token = document.getElementById('tokenA').value;
    var responseA = document.getElementById('responseA').value;
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    // alert(name);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code:code,
            name: name,
            email: email,
            mobile: mobile,
            course: course,
            source: source,
            counter: counter,
            responseA:responseA,
            token:token,
            id:id
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
                SuccessToast('Successfully  Update');
                getRecord();
            }
            else{
                ErrorToast('Please try after some time.', 'bg-warning');
            }

        }
    });

}
function getRecord() {
    var code='410';

     var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;
       var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code:code,startDate:startDate,endDate:endDate
            
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
         document.getElementById('getTable').innerHTML=response;

        }
    });
}
function update(id) {
    var code='411';
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code:code,id:id
            
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
         document.getElementById('other').innerHTML=response;

        }
    });
}
</script>


<div class="container-fluid">

    <?php

// if (isset($_POST['submit'])) 
// {
//    $email=$_POST['email'];
//    $name=$_POST['name'];
//   $number=$_POST['phone'];
//   $course=$_POST['course'];
//   $sourse=$_POST['sourse'];
//   $counter=$_POST['counter'];
// $submit_date=date('Y-m-d');

//   $query = "SELECT token FROM field_team_admissions ORDER BY token DESC LIMIT 1";

//   $res = mysqli_query($conn,$query);

//   if($row = mysqli_fetch_array($res))

//   {

//     $token = $row['token'] + 1;

//   }

//   else

//   {

//     $token = 100;

//   }

//    $q="INSERT into  field_team_admissions(name,email,mobile,course,sourse,date_time,counter,token) VALUES ('$name','$email','$number','$course','$sourse','$submit_date','$counter','$token')";
            
//          $result = mysqli_query($conn,$q);
//          if ($result)
//           {
          
//              echo "<script>alert('Successfully Submited')</script>";                   
//          }
//          else
//          {
//            echo "<script>alert('error')</script>";
//          }
//          echo "<script>location.href='form.php';</script>";

//   }
//   else
//   {}


?>

    <!-- <div class="row" style="min-height:500px;text-align: center;"> -->
    <!-- <div class="col-lg-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <p style="float: left">Addmision Visitor</p>
                    <br>


                </div>
                <div class="panel-body">

                    <div class="row" style="min-height:400px;">


                        <div class="col-lg-12" style="text-align:left;">

                            <div class="row">
                                <form action="#" method="POST">
                                    <input type="hidden" name="code" value="11">

                                    <input type="text" name="name" pattern="[A-Za-z ]{0,}" class="form-control"
                                        placeholder="Name" required="" style="height: 40px;">
                                    <br>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address"
                                        required="" style="height: 40px;">

                                    <br>
                                    <input type="text" name="phone" class="form-control" minlength="10" maxlength="10"
                                        placeholder="Phone Number" required="" style="height: 40px;">

                                    <br>
                                    <input type="text" name="course" class="form-control" pattern="[A-Za-z ]{0,}"
                                        placeholder="Course Interested" required="" style="height: 40px;">

                                    <br>


                                    <select class="form-control" name="sourse" style="height: 40px;" required="">
                                        <option value="">Select Sourse</option>
                                        <option value="News Paper">News Paper</option>
                                        <option value="Website">Website</option>
                                        <option value="Friends">Friends</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Self Motivated">Self Motivated</option>
                                    </select>
                                    <br>
                                    <select class="form-control" name="counter" style="height: 40px;" required="">
                                        <option value="">Select Counter</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>

                                    <br>
                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>


                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div> -->
    <!-- <div class="col-lg-9">

            <div class="panel panel-primary">
                <div class="panel-heading">


                    <div class="row">
                        <div class="col-lg-2">
                            Create New

                        </div>

                    </div>



                </div> -->
    <!-- Table -->

    <!-- </div> -->
    <script>
    // $(document).ready(function() {
    //     $('#example').DataTable();
    // });
    // 
    </script>
    <script>
    // function update(id) {
    //     var code = '1';
    //     var xmlhttp = new XMLHttpRequest();
    //     xmlhttp.onreadystatechange = function() {
    //         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    //             document.getElementById("other").innerHTML = xmlhttp.responseText;
    //         }
    //     }
    //     xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    //     xmlhttp.send();
    // }
    // 
    </script>
    <!-- <div class="panel-body"> -->

    <!-- </div> -->
    <!-- </div> -->
    <!-- </div> -->

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- <form method="post" action="post_action.php"> -->
                    <div class="modal-body" id="other">





                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>

    <?php include 'footer.php';?>