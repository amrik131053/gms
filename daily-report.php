<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Update Your Daily Report </h3>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="form-group row">
                            <form id="submit_daily_report" action="action_g.php" method="post"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="code" value="22">
                                    <!-- <div class="col-lg-12" id="task_show_after_onchange">
                                        <h6><b>Your Tasks</b></h6>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Task Name</th>
                                                    <th> Assign By</th>
                                                    <th> Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                <?php 
                                                   $sr=1;
                                                   $show_daily_task="SELECT * FROM task_master where EmpID='$EmployeeID' and Status!='3'";
                                                   $show_daily_task_run=mysqli_query($conn,$show_daily_task);
                                                   if (mysqli_num_rows($show_daily_task_run)>0)
                                                {
                                                   while ($show_daily_task_row=mysqli_fetch_array($show_daily_task_run)) {
                                                      ?>
                                                <tr>
                                                    <td>
                                                        <?=$sr;?>
                                                    </td>
                                                    <td>
                                                        <a>
                                                            <?=$show_daily_task_row['TaskName'];?>
                                                        </a>
                                                        <br />
                                                        <small>
                                                            <?=$show_daily_task_row['AssignDate'];?>

                                                        </small>
                                                    </td>
                                                    <td>

                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <?php

                                          $get_emp_details="SELECT Snap,Name FROM Staff Where IDNo='".$show_daily_task_row['AssignBy']."'";
                                             $get_emp_details_run=sqlsrv_query($conntest,$get_emp_details);
                                             if($row_staff=sqlsrv_fetch_array($get_emp_details_run,SQLSRV_FETCH_ASSOC))
                                             {
                                             $Emp_Image=$row_staff['Snap'];
                                             $emp_pic=base64_encode($Emp_Image);
                                             

                                                            echo  "<img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";} ?>
                                                            </li>

                                                        </ul>
                                                        <b> <?=$row_staff['Name'];?></b>
                                                        (<?=$show_daily_task_row['AssignBy'];?>)
                                                    </td>
                                                                                          <td> <?php 
                                                               $status_up="SELECT * FROM task_master Where ID='".$show_daily_task_row['ID']."'";
                                                               $status_up_run=mysqli_query($conn,$status_up);
                                                               if($status_show=mysqli_fetch_array($status_up_run))
                                                               {

                                                                     if ($status_show['Status']==0) {

                                                                     $status="Pending";
                                                                     $status_color="danger";
                                                                  }
                                                                  elseif ($status_show['Status']==1) {
                                                                     $status="Under Process";
                                                                     $status_color="primary";
                                                                     
                                                                  }
                                                                  elseif($status_show['Status']==2)
                                                                  {
                                                                     $status="Forwarded";
                                                                     $status_color="warning";

                                                                  }
                                                                  elseif($status_show['Status']==3)
                                                                  {
                                                                     $status="Complete";
                                                                     $status_color="success";

                                                                  }
                                                               ?>
                                                        <span
                                                            class="badge badge-<?=$status_color;?>"><?=$status;?></span>
                                                        <?php }?>
                                                    </td>
                                                    <td class="text-center">

                                                        <input type="hidden" value="<?=$show_daily_task_row['ID'];?>"
                                                            name="id_status1[]" id="id_status1">
                                                        <!-- <select class="form-control" name="change_status1[]" id="<?=$show_daily_task_row['ID'];?>_change_status1" onchange="task_submit_with_daily_reportpp(<?=$show_daily_task_row['ID'];?>);" required> -->
                                                        <select class="form-control" name="change_status1[]"
                                                            id="<?=$show_daily_task_row['ID'];?>_change_status1"
                                                            required>
                                                            <option value="">Select</option>
                                                            <option value="3">Complete</option>
                                                            <option value="1">UnderProgress</option>
                                                            <!-- <option value="No">No Action</option> -->
                                                        </select>

                                                    </td>
                                                </tr>
                                                <?php $sr++;
                }
            }
               else
               {

               echo "<tr><td colspan='5'><center><small style='color:red;'>----------No Taks Found----------</small></center> <td> </tr>";?>
                                                <input type="hidden" value="NA" name="id_status1[]">
                                                <select class="form-control" name="change_status1[]"
                                                    style="display: none;">
                                                    <option value="NA">Select</option>
                                                </select>
                                                <?php                }
                ?>

                                                <?php
             
                ?>

                                            </tbody>

                                        </table>
    </div> -->
                                    <h6><b>Personal Performance Index(PPI)</b></h6>
                                    <!--   <div class="col-lg-12">
               
                          <select class="form-control " name="TeachingType" id="selectas">
                            <option value="">Select</option>
                             <option value="Non-Teaching">Non-Teaching</option>
                             <option value="Teaching">Teaching</option>
                          </select>
                        </div> -->
                                </div>
                                <?php  
                         $emp_type_details="SELECT * FROM Staff Where IDNo='$EmployeeID'";
                  $emp_type_details_run=sqlsrv_query($conntest,$emp_type_details);
                  if($emp_typerow_staff=sqlsrv_fetch_array($emp_type_details_run,SQLSRV_FETCH_ASSOC))
                  {
                   $EmployeeType=$emp_typerow_staff['Type'];
                }
                if ($EmployeeType!='Regular')
                 {
                
                         ?>
                                <div class="row Teaching box">

                                    <div class="col-lg-12"><br><br>
                                        <input type="hidden" name="TeachingType" value="Teaching">
                                        <small style="color:red;">
                                            <center>Under Maintenance</center>
                                        </small>
                                    </div>
                                </div>
                                <?php }  else{  ?>
                                <div class="row Non-Teaching box">
                                    <div class="col-lg-12">
                                        <label>Date</label>
                                        <input type="hidden" name="TeachingType" value="Non-Teaching">

                                        <input type="date" class="form-control" value="<?= date('Y-m-d');?>" id='date_r'
                                            name="date_r" min='<?= $lastMonth = date("Y-m-d", strtotime("-4 day"));  ?>'
                                            max="<?= date('Y-m-d');?>">
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Activity Report <small style="color:red;">(Please do not write serial
                                                number just press enter for new line)</small></label>
                                        <textarea class="form-control" id="BeforeNoon" name="BeforeNoon"
                                            required></textarea>
                                    </div>
                                    <div class="col-lg-12" style="display:none">
                                        <label>Work Done After Noon<small style="color:red;">(Please do not write serial
                                                number just press enter for new line)</small></label>
                                        <textarea class="form-control" id="AfterNoon" name="AfterNoon">NA</textarea>

                                    </div>
                                    <div class="col-lg-6">
                                        <label>Admission Work</label>
                                        <select class="form-control" name="AdmissionWork" id="AdmissionWork">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Research Work</label>
                                        <select class="form-control" name="NAAC" id="NAAC">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>


                                    <div class="col-lg-12">

                                        <label for="chkPassport1">
                                            <input type="checkbox" id="chkPassport1" />
                                            Future vision/Suggestion
                                        </label>

                                        <div id="dvPassport1" style="display: none">

                                            <input type="text" class="form-control" name="FutureVision"
                                                id="txtPassportNumber1">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <p style="text-align:right;font-weight:bold;"><?= $Emp_Name; ?><br>
                                            <?= date('d-m-Y');?><br>

                                            <input type="submit" onclick="" class="btn btn-primary btn-xs"
                                                value="Submit">
                                        </p>
                                    </div>
                                </div>

                            </form>
                            <?php }?>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title"><?=$Emp_Name;?>'s&nbsp; Reports</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive" id="show_daily_report">
                        <?php
             $last_reports="SELECT * FROM daily_report  WHERE emp_id='$EmployeeID' Order by submit_date DEsc";
             $last_reports_run=mysqli_query($conn,$last_reports);
             while($last_reports_run_row=mysqli_fetch_array($last_reports_run))
             {
             $emp_id =$last_reports_run_row['emp_id'];
             $emp_type=$last_reports_run_row['emp_type'];
             $bnoon =$last_reports_run_row['bnoon'];
             $anoon =$last_reports_run_row['anoon'];
             $admission =$last_reports_run_row['admission'];  
             $naac = $last_reports_run_row['naac']; 
             $submit_date = $last_reports_run_row['submit_date'];
            

   if($emp_type=='Non-Teaching')
   {
      ?> <div class="col-lg-12">
                            <b style="color: red"> Date: <?php echo $submit_date; ?> </b> <br />
                            <b style="color: black">Your Task </b> <br />
                            <table class="table ">
                                <tr>
                                    <th style="text-align: center;">SrNo</th>
                                    <th style="text-align: center;">Task Name</th>
                                    <th style="text-align: center;">Status</th>

                                </tr><?php
 $s=1;
      $show_task_on_submit="SELECT * FROM task_master inner join daily_task_report ON task_master.ID=daily_task_report.task_id   where daily_task_report.report_id='".$last_reports_run_row['id']."'";
      $show_task_on_submit_run=mysqli_query($conn,$show_task_on_submit);
       if (mysqli_num_rows($show_task_on_submit_run)>0)
                {
      while($show_task_on_submit_row=mysqli_fetch_array($show_task_on_submit_run)){

      
             $task_id = $show_task_on_submit_row['task_id'];
             $report_id = $show_task_on_submit_row['report_id'];
              $t_statsdsus = $show_task_on_submit_row['t_status'];
             $TaskName = $show_task_on_submit_row['TaskName'];
               if ($t_statsdsus==0) {

                              $tn_status="Pending";
                              $clr="red";
                              
                           }
                           elseif ($t_statsdsus==1) {
                              $tn_status="Under Process";
                              $clr="blue";
                              
                           }
                           elseif($t_statsdsus==2)
                           {
                              $tn_status="Forwarded";
                              $clr="yellow";

                           }
                           elseif($t_statsdsus==3)
                           {
                              $tn_status="Complete";
                             $clr="green";

                           }
                           else
                           {

                           }
    ?>

                                <tr>
                                    <td style="text-align: center;"><?= $s;?></td>
                                    <td style="text-align: center;"><?= $TaskName;?></td>
                                    <td style="text-align: center;color: <?=$clr;?>"><b><?= $tn_status;?></b></td>
                                </tr>

                                <?php  $s++;
}
}
else
{
    echo "<tr><td colspan='5'><center><small style='color:red;'>----------No Taks yet----------</small></center> <td> </tr>";
}

?>
                            </table>
                        </div>
                        <div class="col-lg-12">

                            <?php 
   $count = 1;
   ?>
                            <b>Activity Report</b><br>
                            <?php 
      $arrod_act1 = explode(PHP_EOL,$bnoon);  

      foreach($arrod_act1 as $value1)
      {
        echo "<b>".$count++.".</b> ".$value1."<br/>";
      }
    
    ?>

                            <table class="table ">
                                <tr>
                                    <th style="text-align: center;">Admission Work</th>
                                    <th style="text-align: center;">Research Work</th>
                                </tr>
                                <tr>
                                    <td style="text-align: center;"><?= $admission;?></td>
                                    <td style="text-align: center;"><?= $naac;?></td>
                                </tr>
                            </table>
                            <hr color="green" size="20px;">
                        </div>
                        <?php
  }
             }

            ?>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->
<script>
$(document).ready(function() {
    $("#selectas").change(function() {
        $(this).find("option:selected").each(function() {
            var optionValue = $(this).attr("value");
            if (optionValue) {
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else {
                $(".box").hide();
            }
        });
    }).change();
});

$(function() {
    $("#chkPassport1").click(function() {
        if ($(this).is(":checked")) {
            $("#dvPassport1").show();
        } else {
            $("#dvPassport1").hide();
        }
    });
});

$(document).ready(function(e) {
    $("#submit_daily_report").on('submit', (function(e) {
        e.preventDefault();
        //            var spinner=document.getElementById("ajax-loader");
        // spinner.style.display='block';
        $.ajax({
            url: "action_g.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                // spinner.style.display='none';
                if (data == 1) {
                    SuccessToast('Successfully Submited');
                    show_daily_report();
                } else if (data == 2) {
                    ErrorToast('Today Report Already Submited', 'bg-warning');

                } else {
                    ErrorToast('Try after some time', 'bg-danger');

                }
            },

        });
    }));
});

function show_daily_report() {

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var code = 18;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            spinner.style.display = 'none';

            show_task_after_chnage();
            document.getElementById("show_daily_report").innerHTML = response;
        }
    });
}

function task_submit_with_daily_report(id) {
    var spinner = document.getElementById("ajax-loader");
    var change_status = document.getElementById(id + "_change_status1").value;
    // alert(id);
    spinner.style.display = 'block';
    var code = 19;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            change_status: change_status,
            id: id
        },
        success: function(response) {
            spinner.style.display = 'none';
            // show_task_after_chnage();
        }
    });
}

function show_task_after_chnage() {

    var code = 20;
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            document.getElementById("task_show_after_onchange").innerHTML = response;
        }
    });
}
</script>

<?php


 include "footer.php";  ?>