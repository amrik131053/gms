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
                        <span class="info-box-icon"  id="TotalStudentCount"><div class="text-center" id="div-loader">
                        <div class="spinner-border" role="status">
                        </div>
                    </div></span>

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
                                <i class="fas fa-eye fa-lg"></i></button>
                        </a>
                    </div>
                    <!-- /.info-box -->
                </div>



                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-primary shadow-lg">
                        <span class="info-box-icon" id="TotalActiveCount"><div class="text-center" id="div-loader">
                        <div class="spinner-border" role="status">
                        </div>
                    </div></span>

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
                                <i class="fas fa-eye fa-lg"></i></button>
                        </a>
                    </div>
                    <!-- /.info-box -->
                </div>




                <!-- ./col -->

               



                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success shadow-lg">
                        <span class="info-box-icon" id="TotalEligibleCount"><div class="text-center" id="div-loader">
                        <div class="spinner-border" role="status">
                        </div>
                    </div></span>

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
                                <i class="fas fa-eye fa-lg"></i></button>
                        </a>
                    </div>
                    <!-- /.info-box -->
                </div>
           
            <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-warning shadow-lg">
                        <span class="info-box-icon" id="TotalNotEligible"><div class="text-center" id="div-loader">
                        <div class="spinner-border" role="status">
                        </div>
                    </div></span>

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
                                <i class="fas fa-eye fa-lg"></i></button>
                        </a>
                    </div>
                    <!-- /.info-box -->
                </div>
                </div>

            <!-- <h3 class="mt-4 mb-4">Social Widgets</h3> -->
            <!-- ----------------------------------------------------------------------------------- -->
            <div class="row">


                <?php      $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];

                        ?>


                <div class="col-md-3">
                    <div class="card card-widget widget-user-2 shadow-lg">
                        <div class=" card-header widget-user-header ">
                            <!-- <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                </div> -->
                            <!-- /.widget-user-image -->
                            <h5 class="widget-user-username" style="font-size: 15px;margin-left:0; ">
                                <b><?=$college;  ?></b></h5>

                            <!-- <h5 class="widget-user-desc">Lead Developer</h5> -->
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Student <span class="float-right badge bg-primary">31</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Active <span class="float-right badge bg-info">5</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Left <span class="float-right badge bg-success">12</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Eligible <span class="float-right badge bg-danger">842</span>
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
      loadDashboard();
      function loadDashboard() {
      var spinner = document.getElementById("div-loader-paid-days");
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
            var data = JSON.parse(response);
            document.getElementById("TotalStudentCount").textContent = data[0];
            document.getElementById("TotalActiveCount").textContent = data[1];
            document.getElementById("TotalNotEligible").textContent = data[2];
            document.getElementById("TotalEligibleCount").textContent = data[3];

        },
        error: function(xhr, status, error) {
            console.error("Error: " + error);
        }
    });
}

    </script>

    <?php

 include "footer.php";  ?>