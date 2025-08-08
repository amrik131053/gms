<?php 
   include "header.php";   
   ?>
<section class="content">
    <section class="content">

        <div class="container-fluid">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-12">
                        <select id="Session" name="session1" class="form-control" onchange="loadDashboard();">
                            <?php         
 $sessionSql="SELECT Distinct session FROM hostel_student_summary order by session DESC";
 $sessionRes=mysqli_query($conn,$sessionSql);
 while($sessionData=mysqli_fetch_array($sessionRes))
 {
    $session=$sessionData['session'];
    ?>
                            <option value="<?=$session?>"><?=$session?></option>
                            <?php
 } 
 ?>


                        </select>

                    </div>
                    
                </div>
            </div>
            <br>


            <!-- <h3 class="mt-4 mb-4">Social Widgets</h3> -->
            <!-- ----------------------------------------------------------------------------------- -->
            <div class="row">


                <?php   
                
                

                                       $hostelQry="SELECT * FROM building_master inner join hostel_permissions on hostel_permissions.building_master_id=building_master.ID where emp_id='$EmployeeID'";
                                       $hostelRes=mysqli_query($conn,$hostelQry);
                                       while($hostelData=mysqli_fetch_array($hostelRes))
                                       {
                        $college = $hostelData['Name']; 
                        $CollegeID = $hostelData['ID'];
?>
                <input type='hidden' name='check[]' id='check' value='<?=$CollegeID;?>' class='checkbox' checked>



                <div class="col-md-3">
                    <div class="card card-widget widget-user-2 shadow-lg">
                        <div class="card-header info-box  shadow-lg">

                            <div class="info-box-content ">
                                <?=$college;?>(<?=$CollegeID;?>)

                            </div>
                            
                          
                            <a href="#" class="small-box-footer"><button type="submit" class="btn btn-sm "
                                    style='color:white;'
                                    onclick="exportTotalScordingToCollegeSumyAll(<?=$CollegeID;?>,'','');">
                                    All
                                    <i class="fa fa-download fa-lg"></i></button>
                            </a>
                            <!-- /.info-box-content -->

                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                               
                                <li class="nav-item" style="display:none">
                                    <a href="#" class="nav-link"
                                        onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'');">
                                        <i class="fa fa-download fa-sm text-info"></i>&nbsp;&nbsp;Total Student <span
                                            class="float-right badge bg-info" id="TSutdent<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"
                                        onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'0');">
                                        <i class="fa fa-download fa-sm text-primary"></i> &nbsp;&nbsp;Total Student 
                                        <span
                                            class="float-right badge bg-primary" id="TActive<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>&nbsp;&nbsp;
                                        <span
                                            class="float-right badge bg-danger" id="ALeft<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"
                                        onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'1');">
                                        <i class="fa fa-download fa-sm text-danger"></i> &nbsp;&nbsp; Left<span
                                            class="float-right badge bg-success" id="TLeft<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link"
                                        onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'2');">
                                        <i class="fa fa-download fa-sm text-warning"></i> &nbsp;&nbsp; On Leave<span
                                            class="float-right badge bg-success" id="PActive<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"
                                        >
                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;Total Rooms <span
                                            class="float-right badge bg-warning" id="TotalRoom<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; Total Beds in Hostel<span
                                            class="float-right badge bg-success" id="TEligible<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; Available Bed<span
                                            class="float-right badge bg-success" id="PLeft<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                               

                                <!-- <li class="nav-item">
                                    <a href="#" class="nav-link"
                                        onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'1','0');">
                                        <i class="fa fa-download fa-sm text-warning"></i>&nbsp;&nbsp;Final Year Students
                                        <span class="float-right badge bg-warning" id="TNEligible<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ----------------------------------------------------------------------------------- -->
                <?php }?>
            </div>

    </section>
    <p id="ajax-loader"></p>
    <script>
    const d = new Date();
    let year = d.getFullYear();
    loadDashboard();

    function exportTotalScordingToStatus(Status, Eligible) {
        var exportCode = 44;
        var Batch = document.getElementById('Session').value;
        var Lateral = document.getElementById('Lateral').value;

        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch + "&Eligible=" +
            Eligible + "&Lateral=" + Lateral, '_blank');

    }



    function exportTotalScordingToCollege(CollegeID, Status) {
        var exportCode = 88;
        var Batch = document.getElementById('Session').value;
        // var Lateral = document.getElementById('Lateral').value;
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch + "&CollegeID=" + CollegeID, '_blank');
    }

    function exportTotalScordingToCollegeSumy(CollegeID, Status, Eligible) {
        var exportCode = 86;
        var Batch = document.getElementById('Session').value;
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch + "&Eligible=" +
            Eligible+ "&CollegeID=" + CollegeID, '_blank');

    }
    function exportTotalScordingToCollegeSumyAll(CollegeID, Status, Eligible) {
        var exportCode = 87;
        var Batch = document.getElementById('Session').value;
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch + "&Eligible=" +
            Eligible+ "&CollegeID=" + CollegeID, '_blank');

    }




    function exportTotalScordingToStatusSummary(Status, Eligible) {
        var exportCode = 47;
        var Batch = document.getElementById('Session').value;
        var Lateral = document.getElementById('Lateral').value;
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch + "&Eligible=" +
            Eligible + "&Lateral=" + Lateral, '_blank');
    }










    function loadDashboard() {
        $('#div-loader').show();
        var Batch = document.getElementById("Session").value;
        // var Lateral = document.getElementById("Lateral").value;
        var subjects = document.getElementsByClassName('checkbox');
        var len_subject = subjects.length;


        var subject_str = [];

        for (i = 0; i < len_subject; i++) {
            if (subjects[i].checked === true) {
                subject_str.push(subjects[i].value);
            }
        }

        for (i = 0; i < len_subject; i++) {
            var a = subject_str[i];

            loadCollegeCount(a, Batch);
        }

    }




    function loadCollegeCount(CollegeID, Batch) {
        // alert(CollegeID);
        var code = 477;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                console.log(response);
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                // document.getElementById("TNEligible" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];

                document.getElementById("PActive" + CollegeID).textContent = data[4];
                document.getElementById("TLeft" + CollegeID).textContent = data[5];
                document.getElementById("PLeft" + CollegeID).textContent = data[6];
                document.getElementById("ALeft" + CollegeID).textContent = data[7];
                document.getElementById("TotalRoom" + CollegeID).textContent = data[8];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }
    </script>

    <?php

 include "footer.php";  ?>