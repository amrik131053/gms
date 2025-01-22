<?php
$Authority_Label='Pending To VC';
$Authority_ID="172027"; 
$alertshow=0;
$lCount=0;
 $LeaveAlert="SELECT * FROM ApplyLeaveGKU where Status!='Approved' and Status!='Reject' and Status!='$Authority_Label' and SanctionId='$EmployeeID' and  AuthorityId='$EmployeeID'";
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
     if($EmployeeID==$Authority_ID)
     {

     $LeaveAlert111="SELECT * FROM ApplyLeaveGKU where  Status='$Authority_Label'  and SanctionId!='$EmployeeID' and  AuthorityId!='$EmployeeID'";
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


     if(date('m')>6)
 {  
  $session='August'.date('Y');
    }
    else
    {
 
   $session='Jan' . date('Y');
}

 $buspass="SELECT * FROM StudentBusPassGKU Inner join Admissions on  StudentBusPassGKU.IDNo=Admissions.IDNo  where StudentBusPassGKU.p_status='1' ANd StudentBusPassGKU.session='$session' AND  Admissions.Status='1'";
 $buspassCount=sqlsrv_query($conntest,$buspass,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
      $pass_count=sqlsrv_num_rows($buspassCount);



         $studentCorerectionSql="SELECT * FROM  StudentCorrectionData  Where Status='0'";
 $studentCorerectionSqlRun=sqlsrv_query($conntest,$studentCorerectionSql,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
          $studentCorerectioncount=sqlsrv_num_rows($studentCorerectionSqlRun);
    

    if($studentCorerectioncount>0)
    {
$alertshow=1;
    } 


         $grievanceSql="SELECT * FROM  StudentGrievanceTrack  Where Action='0' and EmployeeId='$EmployeeID'";
 $grievanceSqlRun=sqlsrv_query($conntest,$grievanceSql,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
          $grievancecount=sqlsrv_num_rows($grievanceSqlRun);
    

    if($grievancecount>0)
    {
$alertshow=1;
    } 
         $buspassp="SELECT * FROM StudentBusPassGKU Inner join Admissions on  StudentBusPassGKU.IDNo=Admissions.IDNo  where StudentBusPassGKU.p_status='5' ANd StudentBusPassGKU.session='$session' AND  Admissions.Status='1'";
 $buspassCountp=sqlsrv_query($conntest,$buspassp,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
          $pass_countp=sqlsrv_num_rows($buspassCountp);
    

    if(($pass_count>0||$pass_countp>0) ANd ($role_id=='2' || $role_id=='3') )
    {
$alertshow=1;
    } 


$buspassa="SELECT * FROM StudentBusPassGKU where  p_status='3' ANd session='$session'";
 $buspassCounta=sqlsrv_query($conntest,$buspassa,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
     $pass_counta=sqlsrv_num_rows($buspassCounta);
         
if($pass_counta>0 ANd $role_id=='22')
    {
$alertshow=1;
    } 


$idcard="SELECT * FROM SmartCardDetails where  Status='Applied'";
 $idcard=sqlsrv_query($conntest,$idcard,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
         $idcard=sqlsrv_num_rows($idcard);
    

    if($idcard>0 ANd ($role_id=='2' || $role_id=='3') )
    {
$alertshow=1;
    } 

$idcardv="SELECT * FROM SmartCardDetails where  Status='Verified'";
 $idcardv=sqlsrv_query($conntest,$idcardv,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
         $idcardv=sqlsrv_num_rows($idcardv);
    

    if($idcardv>0 ANd ($role_id=='2' || $role_id=='3') )
    {
$alertshow=1;
    } 


$Examformaccount="SELECT * FROM ExamForm as ef inner join Admissions as ad on ad.IDNo=ef.IDNo  where  ad.Status='1' ANd  ef.Status='4' ANd Examination='$CurrentExamination'";
 $Examformaccountr=sqlsrv_query($conntest,$Examformaccount,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
  $Examformaccountcr=sqlsrv_num_rows($Examformaccountr);
    

    if($Examformaccountcr>0 ANd $role_id=='22')
    {
$alertshow=1;
    } 




$ExamformRegistration="SELECT * FROM ExamForm as ef inner join Admissions as ad on ad.IDNo=ef.IDNo where  ad.Status='1' ANd ef.Status='-1' ANd Examination='$CurrentExamination'";
 $ExamformRegistrationr=sqlsrv_query($conntest,$ExamformRegistration,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
  $ExamformRegistrationcr=sqlsrv_num_rows($ExamformRegistrationr);
    

    if($ExamformRegistrationcr>0 ANd $role_id=='15')
    {
$alertshow=1;
    }


 $ExamformDean="SELECT * FROM ExamForm as ef inner join Admissions as ad on ad.IDNo=ef.IDNo where  ad.Status='1' ANd ef.Status='0' ANd Examination='$CurrentExamination' ANd ef.CollegeID='$Emp_CollegeID'";
 $ExamformDeanr=sqlsrv_query($conntest,$ExamformDean,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
  $ExamformDeancr=sqlsrv_num_rows($ExamformDeanr);
    

    if($ExamformDeancr>0 ANd $role_id=='13')
    {
$alertshow=1;
    }


    $ExamformExaminination="SELECT * FROM ExamForm as ef inner join Admissions as ad on ad.IDNo=ef.IDNo where  ad.Status='1' ANd ef.Status='5' ANd Examination='$CurrentExamination'";
 $ExamformExamininationr=sqlsrv_query($conntest,$ExamformExaminination,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
  $ExamformExamininationcr=sqlsrv_num_rows($ExamformExamininationr);
    

    if($ExamformExamininationcr>0 ANd $role_id=='5')
    {
$alertshow=1;
    }











if($lCount>0||$count>0)
{
    $alertshow=1;
}

     if($alertshow>0)    
     {?>
<div class="modal fade" id="modal-lg-notification">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body" style='padding:0px;'>
                <div class="col-lg-12" style='padding:0px;'>

                    <div class="card-footer p-0" id="load_alert"><br>
                        
 <?php 

  if($lCount>0)
     {?>
                        <div class="col-md-12">
                          
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


                        <?php }


       
    if($Examformaccountcr>0 ANd $role_id=='22')
    {
        ?>
                         <div class="col-md-12">
                           
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Exam form Pending</span>
                                    <span class="info-box-number"><?=$Examformaccountcr;?></span>

                                </div>
                                <span><a href="exam-account-verification.php"><i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                            </div>
                        </div>


                        <?php }







       
   if($ExamformRegistrationcr>0 ANd $role_id=='15')
    {
        ?>
                         <div class="col-md-12">
                           
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Exam form Pending</span>
                                    <span class="info-box-number"><?=$ExamformRegistrationcr;?></span>

                                </div>
                                <span><a href="registration-verification.php"><i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                            </div>
                        </div>


                        <?php }







       
    if($ExamformDeancr>0 ANd $role_id=='13')
    {
        ?>
                         <div class="col-md-12">
                           
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Exam form Pending</span>
                                    <span class="info-box-number"><?=$ExamformDeancr;?></span>

                                </div>
                                <span><a href="exam-cutlist.php"><i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                            </div>
                        </div>


                        <?php }






       
    if($ExamformExamininationcr>0 ANd $role_id=='5')
    {
        ?>
                         <div class="col-md-12">
                           
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Exam form Pending</span>
                                    <span class="info-box-number"><?=$ExamformExamininationcr;?></span>

                                </div>
                                <span><a href="exam-verification.php"><i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                            </div>
                        </div>


                        <?php }










 if(($pass_count>0 || $pass_countp>0) && ($role_id=='2' || $role_id=='3'))
    {
        ?>
                         <div class="col-md-12">
                          
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                               

                                 <div class="info-box-content">
                                    <span class="info-box-text">Bus Pass  Verification  Pending<span>
                                    <span class="info-box-number"><?=$pass_count;?></span>
                                  

                                </div>

                                 <div class="info-box-content">
                                    <span class="info-box-text">Bus Pass  Print Pending<span>
                                    <span class="info-box-number"><?=$pass_countp;?>&nbsp;&nbsp;</span>

                                </div>
                                 <span class="info-box-number"><a href="bus-pass-it.php"><i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                            </div>
                        </div>


                        <?php }




                        if($pass_counta >0 && $role_id ==22)
    {
        ?>
                         <div class="col-md-12">
                          
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                               

                                 <div class="info-box-content">
                                    <span class="info-box-text">Bus Pass  Account Verification  Pending<span>
                                    <span class="info-box-number"><?=$pass_counta;?></span>
                                  

                                </div>

                                <span class="info-box-number"><a href="bus-pass-account.php">&nbsp; &nbsp;<i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                                
                            </div>
                        </div>


                        <?php }


             if(($idcard>0 ||$idcardv>0)  && ($role_id==2 || $role_id=='3'))
     {?>
                         <div class="col-md-12">
                           
                            <div class="info-box mb-3 bg-danger">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                               

                                 <div class="info-box-content">
                                    <span class="info-box-text">ID card Verification  Pending<span>
                                    <span class="info-box-number"><?=$idcard;?><a href="idcard_verifiy.php">&nbsp; &nbsp;<i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                                  

                                </div>

                                 <div class="info-box-content">
                                    <span class="info-box-text">ID card  Print Pending<span>
                                    <span class="info-box-number"><?=$idcardv;?>&nbsp;&nbsp;<a href="smart-idcard.php"><i class="fa fa-eye"
                                            style="color:white;"></i></a></span>

                                </div>
                                
                            </div>
                        </div>


                        
                        <?php   }
             if($grievancecount>0)
     {?>
                         <div class="col-md-12">
                           
                            <div class="info-box mb-12 bg-dark">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                               

                                 <div class="info-box-content">
                                    <span class="info-box-text">Grievance Request<span>
                                    <span class="info-box-number"><?=$grievancecount;?><a href="grievance.php">&nbsp; &nbsp;<i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                                  

                                </div>

                                
                                
                            </div>
                        </div>



                        <?php   }


           if($studentCorerectioncount>0 && $role_id==15 )
     {?>
                         <div class="col-md-12">
                           
                            <div class="info-box mb-12 bg-primary">
                                <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                               

                                 <div class="info-box-content">
                                    <span class="info-box-text">Student Correction Request<span>
                                    <span class="info-box-number"><?=$studentCorerectioncount;?><a href="student-correction-form.php">&nbsp; &nbsp;<i class="fa fa-eye"
                                            style="color:white;"></i></a></span>
                                  

                                </div>

                                
                                
                            </div>
                        </div>



                        <?php   }
















                        ?>









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