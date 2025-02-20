<?php 
   session_start(); 
   ini_set('max_execution_time', '0');
   if (!(isset($_SESSION['usr']) || isset($_SESSION['secure']) || isset($_SESSION['profileIncomplete']))) 
   {  
   ?>
<script>
window.location.href = 'index.php';
</script>
<?php
   } 
   else
   {     include "connection/connection.php";
      $getCurrentExamination="SELECT * FROM ExamDate where ExamType='Regular' AND Type='Student'";
      $getCurrentExamination_run=sqlsrv_query($conntest,$getCurrentExamination);

      if ($getCurrentExamination_row=sqlsrv_fetch_array($getCurrentExamination_run,SQLSRV_FETCH_ASSOC))
      {

$CurrentExamination=$getCurrentExamination_row['Month'].' '.$getCurrentExamination_row['Year'];

      }

   $CurrentExaminationGetDate=date('Y-m-d');
   $EmployeeID=$_SESSION['usr'];
   if ($EmployeeID==0 || $EmployeeID=='') 
      {?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php }
   
       $employee_details="SELECT RoleID,IDNo,ShiftID,Name,Department,CollegeName,Designation,LeaveRecommendingAuthority,LeaveSanctionAuthority FROM Staff Where IDNo='$EmployeeID'";
      $employee_details_run=sqlsrv_query($conntest,$employee_details);
      if ($employee_details_row=sqlsrv_fetch_array($employee_details_run,SQLSRV_FETCH_ASSOC)) {
         $Emp_Name=$employee_details_row['Name'];
         $Emp_Designation=$employee_details_row['Designation'];
         $Emp_CollegeName=$employee_details_row['CollegeName'];
         $Emp_Department=$employee_details_row['Department'];
          $role_id = $employee_details_row['RoleID'];
          $ShiftID =$employee_details_row['ShiftID'];
         $Authority=$employee_details_row['LeaveSanctionAuthority'];
         $Recommend=$employee_details_row['LeaveRecommendingAuthority']; //new
       
      }
      else
      {
         // echo "inter net off";
      }
   
      function getEmployeeName($emplid) 
      {
        include "connection/connection.php";
        $getEmplyeeDetailsWithFunction="SELECT Name FROM Staff Where IDNo='$emplid'";
        $getEmplyeeDetailsWithFunction_run=sqlsrv_query($conntest,$getEmplyeeDetailsWithFunction);
        if ($getEmplyeeDetailsWithFunction_row=sqlsrv_fetch_array($getEmplyeeDetailsWithFunction_run,SQLSRV_FETCH_ASSOC)) {
         echo  $getEmplyeeDetailsWithFunction_row['Name'];
        }
       }
        $currentMonthString=date('F');
        $currentMonthInt=date('n');
        $code=$_POST['flag'];
     
        if($code==1 || $code==2 || $code==3 || $code==4 || $code==7 || $code==8)
        {
            include "connection/ftp-erp.php";
        }


// HR/Admin Upload Staff Documents
if($code==1)
      {
         $n=$_POST['scholarship_name'];
          $d=$_POST['scholarship_details'];
           $s=$_POST['scholarship_startdate'];
            $e=$_POST['scholarship_enddate'];
            $date=date('Y-m-d');


         $insert_scholarship="INSERT INTO MasterScholarship (Name,Details,StartDate,EndDate,CreatedBy,CreateOn)values('$n','$d','$s','$e','$EmployeeID',$date)";

         $insert_scholarship_run=sqlsrv_query($conntest,$insert_scholarship);
         if ($insert_scholarship_run==true)
          {
         echo 1;   
         }
         else
         {
            echo 0;
         }
         sqlsrv_close($conntest);
      }     

elseif($code==1.1)

   { 
    echo $id=$_POST['id'];

$get_scholarship="SELECT * FROM MasterScholarship where  ID='$id'"; 

                     $get_scholarship_run=sqlsrv_query($conntest,$get_scholarship);
                     while($row=sqlsrv_fetch_array($get_scholarship_run))
                     {?>
<div class="col-md-12    col-lg-12  col-sm-12   ">
            <div class="card card-info">
                  <div class="card-body">
                     <div class="form-group row">  
           <div class="col-lg-6">
                        <label >Name</label>

                  <input type="text" class="form-control" id="scholarship_name1" value="<?=$row['Name'];?>">
                   <input type="text" class="form-control" id="scholarship_id" value="<?=$row['ID'];?>">
               </div>  <div class="col-lg-6">
                  <label>Details</label>

                   <input type="text" class="form-control" id="details1" value="<?=$row['Details'];?>">
                </div>
                <div class="col-lg-6">
                  
                   <label>Start Date </label>
                    <input type="date" class="form-control" id="startdate1" value="<?=$row['StartDate']->format('Y-m-d');?>">
                 </div> <div class="col-lg-6">
                    <label>End date</label>
                     <input type="date" class="form-control" id="enddate1" value="<?=$row['EndDate']->format('Y-m-d');?>">
                  </div>
                  </div> 

 
                    
               </div>
              
            </div>

      </div>
                       
                         
         </div>
          <?php 

}
}
         elseif($code==1.2)

   { 
      
    $id=$_POST['scholarship_id'];
     $scholarship_name1=$_POST['scholarship_name'];
      $scholarship_details1=$_POST['scholarship_details'];
       $scholarship_startdate1=$_POST['scholarship_startdate'];
        $scholarship_enddate1=$_POST['scholarship_enddate'];
 $get_scholarship="Update  MasterScholarship set Name='$scholarship_name1',Details='$scholarship_details1',StartDate='$scholarship_startdate1' ,EndDate='$scholarship_enddate1' where  ID='$id'"; 

 $get_scholarship_run=sqlsrv_query($conntest,$get_scholarship);
                    
echo 1;

}

elseif($code==1.3)

   { 

    ?> <table class="table table-head-fixed text-nowrap">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>details</th>
                              <th>Start Date </th>
                              <th>End Date</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
 <?php 
          $sr=1;
                            $get_scolarship="SELECT * FROM MasterScholarship  order by ID desc"; 

                     $get_scholarship_run=sqlsrv_query($conntest,$get_scolarship);
                     while($row=sqlsrv_fetch_array($get_scholarship_run))
                     {

                     
                        ?>

                     <tr style="background-color: "><td><?= $sr++;?></td><td><?=$row['Name'];?> <b>(<?=$row['ID'];?>)</b></td><td><?=$row['Details'];?></td><td><?=$row['StartDate']->format('d-m-Y');?></td>
                        <td><?=$row['EndDate']->format('d-m-Y');?></td>
                       
                        <td><i class="fa fa-edit" onclick="edit_scholarship(<?=$row['ID'];?>)" data-toggle="modal" data-target="#exampleModal"></i></td>
                    </tr>
                     
                     <?php }?>

                       </tbody>
                     </table>
<?php }}?>