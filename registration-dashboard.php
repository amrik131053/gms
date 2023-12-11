<?php 
   include "header.php";   
   ?>
<section class="content">
    <section class="content">

        <div class="container-fluid">
            <div class="card-header">
                <select id="Batch" class="form-control form-control-range" onchange="loadDashboard();">
                    <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                    <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                    <option value="<?=$i?>"><?=$i?></option>
                    <?php }
                                  ?>
                </select>

            </div>
            <br>
            <div class="row">



                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info shadow-lg">
                        <span class="info-box-icon" id="TotalStudentCount">
                            <div class="text-center" id="div-loader" style="display:none;">
                                <div class="spinner-border" role="status">
                                </div>
                            </div>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Student</span>
                            <!-- <span class="info-box-number">Book Issued  </span> -->

                            <div class="progress">

                                <div class="progress-bar" style="width: 100%;"></div>
                            </div>
                            <span class="progress-description">
                                &nbsp;
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        <a href="books-issued.php" class="small-box-footer"><button type="submit" class="btn btn-sm "
                                style='color:white;'>
                                <i class="fa fa-download fa-lg"></i></button>
                        </a>
                    </div>
                    <!-- /.info-box -->
                </div>



                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-primary shadow-lg">
                        <span class="info-box-icon" id="TotalActiveCount">
                            <div class="text-center" id="div-loader" style="display:none;">
                                <div class="spinner-border" role="status">
                                </div>
                            </div>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Active</span>
                            <!-- <span class="info-box-number">Book Issued  </span> -->

                            <div class="progress">

                                <div class="progress-bar" style="width: 100%;"></div>
                            </div>
                            <span class="progress-description">
                                &nbsp;
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        <a href="books-issued.php" class="small-box-footer"><button type="submit" class="btn btn-sm "
                                style='color:white;'>
                                <i class="fa fa-download fa-lg"></i></button>
                        </a>
                    </div>
                    <!-- /.info-box -->
                </div>




                <!-- ./col -->





                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success shadow-lg">
                        <span class="info-box-icon" id="TotalEligibleCount">
                            <div class="text-center" id="div-loader" style="display:none;">
                                <div class="spinner-border" role="status">
                                </div>
                            </div>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Eligible</span>
                            <!-- <span class="info-box-number">Book Issued  </span> -->

                            <div class="progress">

                                <div class="progress-bar" style="width: 100%;"></div>
                            </div>
                            <span class="progress-description">
                                &nbsp;
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        <a href="books-issued.php" class="small-box-footer"><button type="submit" class="btn btn-sm "
                                style='color:white;'>
                                <i class="fa fa-download fa-lg"></i></button>
                        </a>
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-warning shadow-lg">
                        <span class="info-box-icon" id="TotalNotEligible">
                            <div class="text-center" id="div-loader" style="display:none;">
                                <div class="spinner-border" role="status">
                                </div>
                            </div>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Not Eligible</span>
                            <!-- <span class="info-box-number">Book Issued  </span> -->

                            <div class="progress">

                                <div class="progress-bar" style="width: 100%;"></div>
                            </div>
                            <span class="progress-description">
                                &nbsp;
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                        <a href="books-issued.php" class="small-box-footer"><button type="submit" class="btn btn-sm "
                                style='color:white;'>
                                <i class="fa fa-download fa-lg"></i></button>
                        </a>
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>

            <!-- <h3 class="mt-4 mb-4">Social Widgets</h3> -->
            <!-- ----------------------------------------------------------------------------------- -->
            <div class="row">


                <?php      $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID WHERE MasterCourseCodes.CollegeID!='76' AND MasterCourseCodes.CollegeID!='77' ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];

                        ?>
                <div class="col-md-3">
                    <div class="card card-widget widget-user-2 shadow-lg">
                        <div class="card-header info-box  shadow-lg">

                            <div class="info-box-content ">
                                <?=$college;?>(<?=$CollegeID;?>)


                            </div>
                            <a href="books-issued.php" class="small-box-footer"><button type="submit"
                                    class="btn btn-sm " style='color:white;'>
                                    <i class="fa fa-download fa-lg"></i></button>
                            </a>
                            <!-- /.info-box-content -->

                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Student <span class="float-right badge bg-info"
                                            id="TSutdent<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Active <span class="float-right badge bg-primary" id="TActive<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Eligible <span class="float-right badge bg-success"
                                            id="TEligible<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Not Eligible <span class="float-right badge bg-warning"
                                            id="TLeft<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
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

    function loadDashboard() {
      $('#div-loader').show();
        var Batch = document.getElementById("Batch").value;
        var code = 298;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch
            },
            success: function(response) {
              $('#div-loader').hide();
                var data = JSON.parse(response);
                document.getElementById("TotalStudentCount").textContent = data[0];
                document.getElementById("TotalActiveCount").textContent = data[1];
                document.getElementById("TotalNotEligible").textContent = data[2];
                document.getElementById("TotalEligibleCount").textContent = data[3];
                loadCollegeCount62(62, Batch);
                loadCollegeCount61(61, Batch);
                loadCollegeCount64(64, Batch);
                loadCollegeCount66(66, Batch);
                loadCollegeCount65(65, Batch);
                loadCollegeCount69(69, Batch);
                loadCollegeCount67(67, Batch);
                loadCollegeCount63(63, Batch);
                loadCollegeCount72(72, Batch);
                loadCollegeCount74(74, Batch);
                loadCollegeCount73(73, Batch);
                loadCollegeCount75(75, Batch);
                loadCollegeCount70(70, Batch);
                loadCollegeCount71(71, Batch);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });



    }

    loadCollegeCount61(61, year);
    loadCollegeCount62(62, year);
    loadCollegeCount63(63, year);
    loadCollegeCount64(64, year);
    loadCollegeCount65(65, year);
    loadCollegeCount66(66, year);
    loadCollegeCount67(67, year);
    loadCollegeCount69(69, year);
    loadCollegeCount70(70, year);
    loadCollegeCount71(71, year);
    loadCollegeCount72(72, year);
    loadCollegeCount73(73, year);
    loadCollegeCount74(74, year);
    loadCollegeCount75(75, year);

    function loadCollegeCount61(CollegeID, Batch) {

        var code = 299;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                // console.log(response);
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    function loadCollegeCount62(CollegeID, Batch) {

        var code = 300;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    function loadCollegeCount63(CollegeID, Batch) {

        var code = 301;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    function loadCollegeCount64(CollegeID, Batch) {

        var code = 302;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }


    function loadCollegeCount65(CollegeID, Batch) {

        var code = 303;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }



    function loadCollegeCount66(CollegeID, Batch) {

        var code = 304;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }


    function loadCollegeCount67(CollegeID, Batch) {

        var code = 305;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }



    function loadCollegeCount69(CollegeID, Batch) {

        var code = 306;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }



    function loadCollegeCount70(CollegeID, Batch) {

        var code = 307;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }


    function loadCollegeCount71(CollegeID, Batch) {

        var code = 308;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }


    function loadCollegeCount72(CollegeID, Batch) {

        var code = 309;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    function loadCollegeCount73(CollegeID, Batch) {

        var code = 310;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    function loadCollegeCount74(CollegeID, Batch) {

        var code = 311;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }


    function loadCollegeCount75(CollegeID, Batch) {

        var code = 312;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID
            },
            success: function(response) {
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TLeft" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }
    </script>

    <?php

 include "footer.php";  ?>