<?php 
   include "header.php"; 
    ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">My Team</h3>
                        <b id="total_count"></b>
                    </div>
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row">
                                <?php 
                                                $staff="SELECT * FROM Staff Where (LeaveSanctionAuthority='$EmployeeID' OR LeaveRecommendingAuthority='$EmployeeID') ANd JobStatus='1' order by  Designation,RoleID DESC";
                                                    $stmt = sqlsrv_query($conntest,$staff);  
                                                while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                                                        {
                                                    $emp_image = $row_staff['Snap'];
                                                    $empid = $row_staff['IDNo'];
                                                    $name = $row_staff['Name'];
                                                    $college = $row_staff['CollegeName'];
                                                    $dep = $row_staff['Department'];
                                                    $designation = $row_staff['Designation'];
                                                    $mob1 = $row_staff['ContactNo'];
                                                    $email = $row_staff['EmailID'];
                                                    $superwiser_id = $row_staff['LeaveSanctionAuthority'];              
                                              
                                                  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1
                                            from DeviceLogsAll  where LogDateTime Between '$todaydate 01:00:00.000'  AND 
                                            '$todaydate 23:59:00.000' AND EMpCOde='$empid' ";
                            $stmt2 = sqlsrv_query($conntest,$sql_att);  
                            if($row_staff_att = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                            {
                            $intime=$row_staff_att['mytime'];
                            $outtime=$row_staff_att['mytime1'];
                            }
                            if($intime=='' && $outtime=='' )
                            {
                                $bg="danger";
                            }
                            else{
                                $bg="success";
                                
                            }
                            ?>
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                        </div>
                                        <div class="card-body pt-0 bg-<?=$bg;?> ">
                                            <div class="row ">
                                                <div class="col-7">
                                                    <br>
                                                    <h2 class="lead"><b><?=$name; ?>(<?=$empid;?>)</b></h2>
                                                    <p ><b>Designation: </b>
                                                        <?= $designation;?> </p>
                                                    <p ><b>Department: </b> <?= $dep;?> </p>
                                                    <ul class="ml-4 mb-0 fa-ul ">
                                                          <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span> Mobile No:
                                                            <?= $mob1 ?></li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <br>
                                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($emp_image).'" height="100px" width="100px" alt="user-avatar" class="img-circle"/>';?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-left">
                                                <b>In: <?php if($intime!=""){ echo "<b class='text-success'>".$intime->format('h:i A')."</b>";} else { echo "<b class='text-danger'>No punch</b>";}?></b>
                                                &nbsp;
                                                &nbsp;
                                                <b>Out: <?php if($outtime!="" && $outtime>$intime){ echo "<b class='text-success'>".$outtime->format('h:i A')."</b>";} else { echo "<b class='text-danger'>No punch</b>";}?></b>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<p id="ajax-loader"></p>




<?php include "footer.php";  ?>