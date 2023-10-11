<?php
 $lCount=0;
 $LeaveAlert="SELECT * FROM ApplyLeaveGKU where Status!='Approved' and Status!='Reject' and Status!='Pending to VC' and SanctionId='$EmployeeID' and  AuthorityId='$EmployeeID'";
 $LeaveAlertCPunt=sqlsrv_query($conntest,$LeaveAlert,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
           $emp_count=sqlsrv_num_rows($LeaveAlertCPunt);
         if($emp_count>0)
         {
         $lCount=$lCount+$emp_count;
         }
             
     $LeaveAlert1="SELECT * FROM ApplyLeaveGKU where  Status='Pending to Sanction' and SanctionId='$EmployeeID' and  AuthorityId!='$EmployeeID'";
     $LeaveAlert1CPunt=sqlsrv_query($conntest,$LeaveAlert1,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
               $emp_count1=sqlsrv_num_rows($LeaveAlert1CPunt);
     if($emp_count1>0)
     {
          $lCount=$lCount+$emp_count1;
     }
     $LeaveAlert11="SELECT * FROM ApplyLeaveGKU where  Status='Pending to Authority' and SanctionId!='$EmployeeID' and  AuthorityId='$EmployeeID'";
     $LeaveAlert11CPunt=sqlsrv_query($conntest,$LeaveAlert11,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
               $emp_count11=sqlsrv_num_rows($LeaveAlert11CPunt);
     if($emp_count11>0)
     {
          $lCount=$lCount+$emp_count11;
     }
     if($Emp_Designation=='Vice Chancellor')
     {

       $LeaveAlert111="SELECT * FROM ApplyLeaveGKU where  Status='Pending to VC'  and SanctionId!='$EmployeeID' and  AuthorityId!='$EmployeeID'";
       $LeaveAlert111CPunt=sqlsrv_query($conntest,$LeaveAlert111,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                 $emp_count111=sqlsrv_num_rows($LeaveAlert111CPunt);
       if($emp_count111>0)
       {
          $lCount=$lCount+$emp_count111;
       }
     }
     $Notification="SELECT * FROM movement where Status='draft' and superwiser_id='$EmployeeID'";
     $Notification_run=mysqli_query($conn,$Notification);
     $count=mysqli_num_rows($Notification_run);
     if($count>0)
     {

     }

     if($lCount>0 || $count>0)
     {?>
<div class="modal fade" id="modal-lg-notification">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body" style='padding:0px;'>
                <div class="col-lg-12" style='padding:0px;'>

                    <div class="card-footer p-0" id="load_alert">
                        <?php  if($lCount>0)
     {?>
                        <div class="col-md-12">
                            <br>
                            <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Leaves Request</span>
                                    <span class="info-box-number"><?=$lCount;?></span>

                                </div>
                                <span><a href="attendence-calendar.php"><i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                            </div>
                        </div>
                        <?php   }
       
    if($count>0)
    {
        ?>
                         <div class="col-md-12">
                            <br>
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Movement Request</span>
                                    <span class="info-box-number"><?=$count;?></span>

                                </div>
                                <span><a href="movement-admin.php"><i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                            </div>
                        </div>

                        <?php }?>

                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>


    </div>

</div>
<?php

} 
?>
<!-- /.modal -->