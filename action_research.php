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
     
        if($code==1 || $code==2 || $code==3 || $code==4 || $code==7 || $code==8 || $code==33)
        {
            include "connection/ftp-erp.php";
        }
if($code=='26.7')
{
   include "connection/connection_web.php"; 
   
  }
if($code==1)
{
?>
 <table class="table table-head-fixed text-nowrap">
                        <thead>
                           <tr>
                              <th>IDNo</th>
                              <th>Name</th>
                              <th>Title</th>
                              <th>Journal</th>
                               <th>Faculty</th>
                                 <th>Date</th>
                                  <th>DOI</th>
                                   <th>File</th>
                                    <th>Action</th>
                           </tr>
                        </thead>
                        <tbody >
                          <?php 
      $sr=1;
    $query = "SELECT TOP(30)* FROM Repository where Status ='0' order by ID desc";
       $result = sqlsrv_query($conntest,$query);
       if($row1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
        $emp_pic=$row1['Image'];
        ?>
        <tr>
            
            <td><?=$row1['IDNo'];?></td>
            <td><?=$row1['AuthorName'];?></td>
            <td><?=$row1['PaperTitle'];?></td>
            <td><?=$row1['Faculty'];?></td>
            <td><?=$row1['Journal'];?></td>
            <td><?=$row1['DateofPublication'];?></td>
             <td><?=$row1['DOI'];?></td>
             <td><?=$row1['Documents'];?></td>
        </tr>
                        </tbody>
                     </table>

  

}
}


}
?>