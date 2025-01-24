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
$IDEmployee=$_POST['IDEmployee'];
$file_name = $_FILES['panCard']['name'];
$file_tmp = $_FILES['panCard']['tmp_name'];
$file_size =$_FILES['panCard']['size'];
$file_type = $_FILES['panCard']['type'];
$allowedTypes = array(
    'image/png',
    'image/jpg',
    'image/jpeg',
    'application/pdf'
);
if (in_array($_FILES['panCard']['type'], $allowedTypes))
    {
if ($file_size < 550000)
    { 
$date=date('Y-m-d');  
$string = bin2hex(openssl_random_pseudo_bytes(4));
$file_data = file_get_contents($file_tmp);
$file_name = $IDEmployee."_".strtotime($date)."_".$string."_".basename($_FILES['panCard']['name']);
$destdir = '/Images/Staff/StaffPanCard';
    ftp_chdir($conn_id, "/Images/Staff/StaffPanCard/") or die("Could not change directory");
    ftp_pasv($conn_id,true);
    ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
    ftp_close($conn_id);
     $insertExp="UPDATE Staff SET PANCardpath='$file_name' where IDNo='$IDEmployee'";
$result = sqlsrv_query($conntest, $insertExp);
if($result==true)
{
    echo "1";
}
else
{
    echo "0";
}
    }
    else
    {
        echo "2"; // size 500kb
    }
}
else{
    echo "3";
}
    sqlsrv_close($conntest);
}
elseif($code==2)
{
    $IDEmployee=$_POST['IDEmployee'];
$file_name = $_FILES['aadharCard']['name'];
$file_tmp = $_FILES['aadharCard']['tmp_name'];
$file_size =$_FILES['aadharCard']['size'];
$file_type = $_FILES['aadharCard']['type'];
$allowedTypes = array(
    'image/png',
    'image/jpg',
    'image/jpeg',
    'application/pdf'
);
if (in_array($_FILES['aadharCard']['type'], $allowedTypes))
    {
if ($file_size < 550000)
    { 
$date=date('Y-m-d');  
$string = bin2hex(openssl_random_pseudo_bytes(4));
$file_data = file_get_contents($file_tmp);
$file_name = $IDEmployee."_".strtotime($date)."_".$string."_".basename($_FILES['aadharCard']['name']);
$destdir = '/Images/Staff/StaffAadharCard';
    ftp_chdir($conn_id, "/Images/Staff/StaffAadharCard/") or die("Could not change directory");
    ftp_pasv($conn_id,true);
    ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
    ftp_close($conn_id);
    $insertExp="UPDATE Staff SET AadharPath='$file_name' where IDNo='$IDEmployee'";
    $result = sqlsrv_query($conntest, $insertExp);
    if($result==true)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
    }
    else
    {
        echo "2"; // size 500kb
    }
}else{
    echo "3";
}
    sqlsrv_close($conntest);
}
elseif($code==3)
{
    $IDEmployee=$_POST['IDEmployee'];
$file_name = $_FILES['photoIMage']['name'];
$file_tmp = $_FILES['photoIMage']['tmp_name'];
$file_size =$_FILES['photoIMage']['size'];
$file_type = $_FILES['photoIMage']['type'];
$allowedTypes = array(
    'image/png',
    'image/jpg',
    'image/jpeg'
);
if (in_array($_FILES['photoIMage']['type'], $allowedTypes))
    {
if ($file_size < 550000)
    { 
$date=date('Y-m-d');  
$string = bin2hex(openssl_random_pseudo_bytes(4));
$file_data = file_get_contents($file_tmp);
$file_name = $IDEmployee."_".strtotime($date)."_".$string."_".basename($_FILES['photoIMage']['name']);
$destdir = '/Images/Staff';
    ftp_chdir($conn_id, "/Images/Staff/") or die("Could not change directory");
    ftp_pasv($conn_id,true);
    ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
    ftp_close($conn_id);
     $insertExp="UPDATE Staff SET Imagepath='$file_name' where IDNo='$IDEmployee'";
    $result = sqlsrv_query($conntest, $insertExp);
    if($result==true)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
    }
    else
    {
        echo "2"; // size 500kb
    }
}
else{
    echo "3"; // format wrong
}
    sqlsrv_close($conntest);
}
elseif($code==4)
{
   $IDEmployee=$_POST['IDEmployee'];
   $file_name = $_FILES['passbookCopy']['name'];
   $file_tmp = $_FILES['passbookCopy']['tmp_name'];
   $file_size =$_FILES['passbookCopy']['size'];
   $file_type = $_FILES['passbookCopy']['type'];
   $allowedTypes = array(
      'image/png',
      'image/jpg',
      'image/jpeg',
      'application/pdf'
   );
   if (in_array($_FILES['passbookCopy']['type'], $allowedTypes))
   {
      if ($file_size < 550000)
      { 
         $date=date('Y-m-d');  
         $string = bin2hex(openssl_random_pseudo_bytes(4));
         $file_data = file_get_contents($file_tmp);
         $file_name = $IDEmployee."_".strtotime($date)."_".$string."_".basename($_FILES['passbookCopy']['name']);
         $destdir = '/Images/Staff/bankpassbook';
         ftp_chdir($conn_id, "/Images/Staff/bankpassbook/") or die("Could not change directory");
         ftp_pasv($conn_id,true);
         ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
         ftp_close($conn_id);
         $insertExp="UPDATE Staff SET Bankpassbookpath='$file_name' where IDNo='$IDEmployee'";
         $result = sqlsrv_query($conntest, $insertExp);
         if($result==true)
         {
            echo "1";
         }
         else
         {
            echo "0";
         }
      }
      else
      {
         echo "2"; // size 500kb
      }
   }else{
      echo "3"; // file format
   }
   sqlsrv_close($conntest);
}

  elseif($code==5)
        {
           $get_category="SELECT ID,QualificationName FROM MasterQualification ";
           $get_category_run=sqlsrv_query($conntest,$get_category);
           while($row=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
           {
              $Emp_category=$row['ID'];
    $check_count_emp_category_wise="SELECT DISTINCT UserName FROM StaffAcademicDetails inner join Staff ON UserName=IDNo  Where JobStatus='1' and StandardType='$Emp_category'";
              $check_count_emp_category_wise_run=sqlsrv_query($conntest,$check_count_emp_category_wise,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
              $emp_count=sqlsrv_num_rows($check_count_emp_category_wise_run);
      ?>
    <li class="nav-item " onclick="show_emp_all_qualification(<?=$Emp_category;?>);">
        <a href="#" class="nav-link">
            <i class="fas fa-inbox"></i> <?=$row['QualificationName'];?>
            <span class="badge bg-primary float-right"><?=$emp_count;?></span>
           
        </a>
    </li>
    <?php 
      }
$check_count_emp="SELECT DISTINCT IDNo FROM  Staff   Where JobStatus='1' and Phd='Yes'";
              $check_count_emp_catego_run=sqlsrv_query($conntest,$check_count_emp,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
              $emp_coun1t=sqlsrv_num_rows($check_count_emp_catego_run);
      ?>
    <li class="nav-item " >
        <a href="#" class="nav-link" >
            <i class="fas fa-inbox"></i>PHD
            <button class="btn m-1 badge bg-primary float-right" onclick="show_emp_all_qualification(8);"><?=$emp_coun1t;?></button>
            <button class="btn m-1 badge bg-primary float-right" onclick="show_emp_all_qualification(8);"><i class="fa fa-eye"></i></button>
            <button class="btn m-1 badge bg-success float-right" onclick="downloadphdDetails(8);"> <i class="fa fa-download"></i></button>
        </a>
    </li>
    <?php 
      
      //      print_r($category);
      }
       elseif($code==6){
?>
<form action="action_a.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="flag" value="7">
        <input type="hidden" class="form-control" name="loginIdPromotion" id="loginIdPromotion"
                                                    value="" readonly>
 <div class="row">
 <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Name of Organisation</label>
                                            <select class="form-control" name="organisationNamePromition"
                                                onchange="fetchDepartmentPromotion(this.value);">
                                               
                                                <?php  $get_College="SELECT DISTINCT CollegeName,CollegeID FROM MasterCourseCodes ";
                                                $get_CollegeRun=sqlsrv_query($conntest,$get_College);
                                                while($get_CollegeRow=sqlsrv_fetch_array($get_CollegeRun,SQLSRV_FETCH_ASSOC))
                                                {?>
                                                <option value="<?=$get_CollegeRow['CollegeID'];?>">
                                                    <?=$get_CollegeRow['CollegeName'];?>(<?=$get_CollegeRow['CollegeID'];?>)
                                                </option>
                                                <?php }
                                          ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Name of Department</label>
                                            <select class="form-control" name="departmentNamePromition" id="departmentNamePromition">
                                           

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <select class="form-control" name="designationPromition">
                                               
                                                <?php  $get_Designation="SELECT DISTINCT Designation FROM MasterDesignation ";
                                                $get_DesignationRun=sqlsrv_query($conntest,$get_Designation);
                                                while($get_DesignationRow=sqlsrv_fetch_array($get_DesignationRun,SQLSRV_FETCH_ASSOC))
                                                {?>
                                                <option value="<?=$get_DesignationRow['Designation'];?>">
                                                    <?=$get_DesignationRow['Designation'];?></option>
                                                <?php }
                                          ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Date of Joining</label>
                                            <input type="date" class="form-control" name="joiningDatePromition"
                                                value="">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-12">
                                        <div class="form-group">
                                            <label>Salary Decided</label>
                                            <input type="text" class="form-control" name="salaryPromition"
                                                placeholder="Enter salary" value="">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-12">
                                        <div class="form-group">
                                            <label>Type of Employment</label>
                                            <select class="form-control" name="employmentTypePromition">
                                               
                                                <option value="Regular">Regular</option>
                                                <option value="Conatct">Conatct</option>
                                                <option value="Guest">Guest</option>
                                                <option value="Adhoc">Adhoc</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Emp Category </label>
                                            <select class="form-control" name="EmpCategoryPromition">
                                                                                    <?php  
                                                                  
                                                                                $get_category="SELECT Distinct CategoryId,CategoryFName FROM CategoriesEmp ";
                                            $get_category_run=sqlsrv_query($conntest,$get_category);
                                            while($row_categort=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
                                            {
                                        ?>
                                                                                    <option value="<?=$row_categort['CategoryId'];?>">
                                                                                        <?=$row_categort['CategoryFName'];?></option>
                                                                                    <?php 
                                        }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label>Shift</label>
                                            <!-- <input type="text" class="form-control" name="employmentStatus" placeholder="Enter employment status"> -->
                                            <select class="form-control" name="shiftPromition">
                                                <?php  
                                                                    $get_category="SELECT * FROM MasterShift ";
                                    $get_category_run=sqlsrv_query($conntest,$get_category);
                                    while($row_categort=sqlsrv_fetch_array($get_category_run,SQLSRV_FETCH_ASSOC))
                                    {
                                ?>
                                                                            <option value="<?=$row_categort['Id'];?>">
                                                                                <?=$row_categort['ShiftName'];?></option>
                                                                            <?php 
                                }?>
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label> Recommending Authority
                                            </label>
                                            <input type="text" class="form-control" name="leaveRecommendingAuthorityPromition"
                                                placeholder="Enter leave sanction authority"
                                                
                                                onkeyup="emp_detail_verify3(this.value);">
                                                <p id="emp_detail_status_Promotion3"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label> Sanction Authority</label>
                                            <input type="text" class="form-control" name="leaveSanctionAuthorityPromition"
                                                placeholder="Enter leave recommending authority"
                                                
                                                onkeyup="emp_detail_verify4(this.value);">
                                                <p id="emp_detail_status_Promotion4"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label> File(Letter)</label>
                                         <input type="file" name="promotionFile" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-12">
                                        <div class="form-group">
                                            <label> Action</label></br>
                                         <input type="button" onclick="submitPromition(this.form);" value="Submit"  class="btn btn-success">
                                        </div>
                                    </div>
                                    </div>
                            </form>

<?php }



      elseif ($code==6.1) {
       ?><div class="card">
        <center>
         <h5>
         <b>Study Scheme Update</b>
        </h5>
        </center>
        </div>

          <div class="row"> 
                  <div class="col-lg-3 col-sm-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Scheme </h3>
                    <div class="card-tools">
                        
                    </div>
                </div>
                <div class="card-body p-2">
                
                <label>College Name</label>
                 <select  name="College" id='College' onchange="collegeByDepartment(this.value);" class="form-control form-control-sm" required>
                 <option value=''>Select Faculty</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select>
              
                 <label>Department</label>
                  <select  id="Department" name="Department" class="form-control form-control-sm"  onchange="fetchcourse()" required>
                     <option value=''>Select Department</option>
                 </select>
            
                 <label>Course</label>
                  <select  id="Course" name="Course" class="form-control form-control-sm" required >
                     <option value=''>Select Course</option>
                 </select>
                 <label> Session</label>
                                    <select id="session" name="session" class="form-control form-control-sm" required>
                                        <option value="">Session</option>
                             <?php       
        
                      $get_country="SELECT DISTINCT Session FROM MasterCourseCodes Order By Session DEsc"  ;
                      $get_country_run=sqlsrv_query($conntest,$get_country);
                      while($row_Session=sqlsrv_fetch_array($get_country_run))
                      {?>
                         <option value="<?=$row_Session['Session'];?>"><?=$row_Session['Session'];?></option>
              <?php }
    
                     ?>
                                    </select>
             
                 <label>Batch</label>
                  <br>
                      
                          <?php 
                              for($i=2020;$i<=2030;$i++)
                                 {?>
                              <label>
        <input type="checkbox" name="batch" value="<?php $i;?>">
<?=$i;?>
    </label>
                           <?php }
                                  ?>
          
                                    
                                  
        <br>

                         
                 <label>Semester</label>
                             <br>
                     <?php 
                        for($i=1;$i<=12;$i++)
                           {?> <label>
                           <input type="checkbox" name="semester" value="<?php $i;?>">&nbsp;<?=$i;?>&nbsp;</label>
                     <?php }
            ?>
          
      
            
                 <br>
 <label> Elective Type</label>
                                    <select id="session" name="session" class="form-control form-control-sm" required>
                                        <option value="">All</option>
                             <?php       
        
                      $get_country="SELECT DISTINCT Elective FROM MasterCourseStructure where Elective!='' AND 
                       Batch>2020"  ;
                      $get_country_run=sqlsrv_query($conntest,$get_country);
                      while($row_Session=sqlsrv_fetch_array($get_country_run))
                      {?>
                         <option value="<?=$row_Session['Elective'];?>"><?=$row_Session['Elective'];?></option>
              <?php }
    
                     ?>
                                    </select>
<br>
                 <button onclick="update_study_scheme_search();" class="btn btn-success btn-sm">Search</button>
                 <button onclick="exportStudyScheme();" class="btn btn-success btn-sm">Download</button>
              </div>
            
            </div>
        </div>

         <div class="col-lg-9 col-sm-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Scheme </h3>
                    <div class="card-tools">
                        
                    </div>
                </div>
                <div class="card-body p-2">
                
               
              </div>
            
            </div>
        </div>
    </div>

<?php 
      }
      else if ($code == 7) {
        // Fetch promotion-related data from the form
        $organisationID = $_POST['organisationNamePromition'];
        $DepartmentID = $_POST['departmentNamePromition'];
        $designationEmp = $_POST['designationPromition'];
        $joiningDate = $_POST['joiningDatePromition'];
        $salaryNew = $_POST['salaryPromition'];
        $employmentType = $_POST['employmentTypePromition'];
        $EmpCategory = $_POST['EmpCategoryPromition'];
        $employeeID = $_POST['loginIdPromotion'];
        $shiftID = $_POST['shiftPromition'];
        $leaveRecommendingAuthority1 = $_POST['leaveRecommendingAuthorityPromition'];
        $leaveSanctionAuthority1 = $_POST['leaveSanctionAuthorityPromition'];
    
        // Fetch employee details
        $employee_details = "SELECT * FROM Staff WHERE IDNo = '$employeeID'";
        $employee_details_run = sqlsrv_query($conntest, $employee_details);
    
        if ($employee_details_row = sqlsrv_fetch_array($employee_details_run, SQLSRV_FETCH_ASSOC)) {
            $Emp_Name = $employee_details_row['Name'];
            $designation = $employee_details_row['Designation'];
            $Emp_CollegeName = $employee_details_row['CollegeName'];
            $Emp_Department = $employee_details_row['Department'];
            $DepartmentIDO = $employee_details_row['DepartmentID'];
            $CategoryId = $employee_details_row['CategoryId'];
            $ShiftID = $employee_details_row['ShiftID'];
            $salary = $employee_details_row['SalaryAtPresent'];
            $from_date = $employee_details_row['DateOfJoining']->format('Y-m-d');
            $to_date = $joiningDate;
    
            if($employee_details_row['DateOfPromotion']!='') 
            {
                $doa = $employee_details_row['DateOfPromotion']->format('Y-m-d'); 
             } else{
                 
                $doa = $employee_details_row['DateOfJoining']->format('Y-m-d'); 
            }
            $dor = $joiningDate;
            $ts1 = strtotime($doa);
            $ts2 = strtotime($dor);
            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);
            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);
            $total_months = ($year2 - $year1) * 12 + ($month2 - $month1);
            $exp_total = max($total_months, 0);

            // // Calculate total experience
            // $doa = $employee_details_row['DateOfJoining']->format('Y-m-d');
            // $dor = $joiningDate;
            // $ts1 = strtotime($doa);
            // $ts2 = strtotime($dor);
            // $year1 = date('Y', $ts1);
            // $year2 = date('Y', $ts2);
            // $month1 = date('m', $ts1);
            // $month2 = date('m', $ts2);
    
            // if ($month1 > $month2) {
            //     $month2 += 12;
            //     $year2 -= 1;
            // }
            // $exp_total = ($year1 <= $year2) 
            //     ? ($year2 - $year1) . " Year " . ($month2 - $month1) . " Month" 
            //     : "0";
    
            $left_reason = "Promotion";
        }
    
        // Fetch category details
        $get_category = "SELECT DISTINCT CategoryId, CategoryFName FROM CategoriesEmp WHERE CategoryId = '$CategoryId'";
        $get_category_run = sqlsrv_query($conntest, $get_category);
        if ($row_category = sqlsrv_fetch_array($get_category_run, SQLSRV_FETCH_ASSOC)) {
            $experienceType = $row_category['CategoryFName'];
        }
    
        // Fetch college details
        $get_college = "SELECT * FROM MasterCourseCodes WHERE CollegeID = '$organisationID'";
        $get_collegeRun = sqlsrv_query($conntest, $get_college);
        if ($get_collegeRow = sqlsrv_fetch_array($get_collegeRun, SQLSRV_FETCH_ASSOC)) {
            $organisationName = $get_collegeRow['CollegeName'];
        }
    
        // Fetch department details
        $get_Department = "SELECT * FROM MasterDepartment WHERE Id = '$DepartmentIDO'";
        $get_DepartmentRun = sqlsrv_query($conntest, $get_Department);
        if ($get_DepartmentRow = sqlsrv_fetch_array($get_DepartmentRun, SQLSRV_FETCH_ASSOC)) {
            $departmentName= $get_DepartmentRow['Department']." (Guru Kashi University)";
        }
        // Fetch department details
        $get_Department1 = "SELECT * FROM MasterDepartment WHERE Id = '$DepartmentID'";
        $get_DepartmentRun1 = sqlsrv_query($conntest, $get_Department1);
        if ($get_DepartmentRow1 = sqlsrv_fetch_array($get_DepartmentRun1, SQLSRV_FETCH_ASSOC)) {
            $departmentName1= $get_DepartmentRow1['Department'];
        }
    
        // File upload handling
        $file_name = $_FILES['promotionFile']['name'];
        $file_tmp = $_FILES['promotionFile']['tmp_name'];
        $file_size = $_FILES['promotionFile']['size'];
        $file_type = $_FILES['promotionFile']['type'];
        $allowedTypes = ['image/png', 'image/jpg', 'application/pdf', 'image/jpeg'];
    
        if (in_array($file_type, $allowedTypes)) {
            if ($file_size < 550000) {
                $date = date('Y-m-d');
                $string = bin2hex(openssl_random_pseudo_bytes(4));
                $file_data = file_get_contents($file_tmp);
                $file_name = "{$employeeID}_" . strtotime($date) . "_{$string}_" . basename($file_name);

                $destdir = '/Images/Staff/ExperienceDocument';
                ftp_chdir($conn_id, $destdir) or die("Could not change directory");
                ftp_pasv($conn_id, true);
                ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
                ftp_close($conn_id);
                 $query = "UPDATE Staff SET Designation = '$designationEmp',CollegeId = '$organisationID', CollegeName = '$organisationName',Department = '$departmentName1',DepartmentID = '$DepartmentID',DateOfPromotion = '$joiningDate',Type = '$employmentType',CategoryId = '$EmpCategory',SalaryAtPresent = '$salaryNew',LeaveRecommendingAuthority = '$leaveRecommendingAuthority1',LeaveSanctionAuthority = '$leaveSanctionAuthority1',ShiftID = '$shiftID',RoleID = '0'WHERE IDNo = '$employeeID'";
                $result = sqlsrv_query($conntest, $query);
                $escapedQuery1 = str_replace("'", "''", $query);
                $update1 = "INSERT INTO logbook(userid, remarks, updatedby, date) 
                            VALUES('$employeeID', '$escapedQuery1', '$EmployeeID', '$timeStamp')";
                sqlsrv_query($conntest,$update1);
                
                if ($result) {
                    echo "1";
                    $checkLeaveAlreadySubmitted = "SELECT * FROM ApplyLeaveGKU WHERE StaffId = '$employeeID' AND Status NOT IN ('Approved', 'Reject')";
                    $countX = sqlsrv_query($conntest, $checkLeaveAlreadySubmitted, [], ["Scrollable" => SQLSRV_CURSOR_KEYSET]);
                    $leaveExistCount = sqlsrv_num_rows($countX);
                    if ($leaveExistCount > 0) {
                        $updateLeaveAuth = "UPDATE ApplyLeaveGKU 
                                            SET SanctionId = '$leaveRecommendingAuthority1', 
                                                AuthorityId = '$leaveSanctionAuthority1' 
                                            WHERE StaffId = '$employeeID' AND Status NOT IN ('Approved', 'Reject')";
                        sqlsrv_query($conntest, $updateLeaveAuth);
                    }
                    $insertExp = "INSERT INTO StaffExperienceDetails(ExperienceType, NameofOrganisation, DateofAppointment, DateofLeaving,TimePeriod, Status, UserName, DocumentPath, Reason, Designation,PayScaleORConsolidated, upddate,ExperienceCategory)
                     VALUES('$experienceType','$departmentName','$from_date','$to_date','$exp_total','0','$employeeID', '$file_name', '$left_reason', '$designation', '$salary', '$timeStamp','1')";
                    sqlsrv_query($conntest, $insertExp);
                   
                    $escapedQuery = str_replace("'", "''", $insertExp);
                    $update12 = "INSERT INTO logbook(userid, remarks, updatedby, date)VALUES('$employeeID', '$escapedQuery', '$EmployeeID', '$timeStamp')";
                    sqlsrv_query($conntest,$update12);
                } else {
                    echo "0"; // Update failed
                }
            } else {
                echo "2"; // File size exceeds limit
            }
        } else {
            echo "3"; // Invalid file type
        }
        
    }
    
elseif ($code==8) {
                $employeeID=$_POST['employeeID'];
                $Exam_passed=$_POST['Exam_passed'];
                // $exam_certificate=$_POST['exam_certificate'];
                $file_name = $_FILES['exam_certificate']['name'];
                $file_tmp = $_FILES['exam_certificate']['tmp_name'];
                $file_size =$_FILES['exam_certificate']['size'];
                $file_type = $_FILES['exam_certificate']['type'];
                $allowedTypes = array(
                    'image/png',
                    'image/jpg',
                    'application/pdf',
                    'image/jpeg'
                );
                if (in_array($_FILES['exam_certificate']['type'], $allowedTypes))
                    {
                if ($file_size < 550000)
                    { 
                $date=date('Y-m-d');  
                $string = bin2hex(openssl_random_pseudo_bytes(4));
                $file_data = file_get_contents($file_tmp);
                $file_name = $employeeID."_".strtotime($date)."_".$string."_".basename($_FILES['exam_certificate']['name']);
                $destdir = '/Images/Staff/Courses';
                    ftp_chdir($conn_id, "/Images/Staff/Courses/") or die("Could not change directory");
                    ftp_pasv($conn_id,true);
                    ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
                    ftp_close($conn_id);
                $insertExp="INSERT into AdditionalQualifications(AdditionalQualificationsType,DocumentPath,upddate,UserName)
                VALUES('$Exam_passed','$file_name','$timeStamp','$employeeID')";
                 sqlsrv_query($conntest, $insertExp); 
                 echo "1";
               
                 $escapedQuery = str_replace("'", "''", $insertExp);
                 $update12="insert into logbook(userid,remarks,updatedby,date)Values('$employeeID','$escapedQuery','$EmployeeID','$timeStamp')";
                 sqlsrv_query($conntest,$update12);
                    }
                    else
                    {
                        echo "2"; //kb
                    }
                }
                else
                {
                    echo "3"; // format
                }

}
elseif($code==9)
   {
    
 
                  ?>
  
        <div class="card">
        
       
       
           <div class="row">
            <div class="col=lg-2">
                 <div class="card-header">
                    
                  </div>
                   <div class="card-body">
              
                <label>College Name</label>
                 <select  name="College" id='College' onchange="collegeByDepartment(this.value);" class="form-control form-control-sm">
                 <option value=''>Select Course</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where IDNo='$EmployeeID' ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
             
                                    <label>Department</label>
                                    <select id="Department" name="Department" class="form-control form-control-sm"
                                        onchange="fetchcourse()" required>
                                        <option value=''>Select Department</option>
                                    </select>
                             
                 <label>Course</label>
                  <select  id="Course" class="form-control form-control-sm">
                     <option value=''>Select Course</option>
                 </select>
            
                 <label>Batch</label>
                   <select id="batch"  class="form-control form-control-sm">
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
            
                 <label>Semester</label>
              <br>
                       
                     <?php 
                        for($i=1;$i<=12;$i++)
                           {
                            if($i==7)
                             { ?>
                            <br>
                          <?php }?>
                            <input type="checkbox" name="<?=$i;?>" style="width:30px;height:20px"  value='<?=$i;?>'>
                            <label for="<?=$i;?>" style="width:25px;height:20px;text-align: center;border:2px red solid;display: inline-block;" > <?=$i;?></label>
                    
                    
                     <?php }
            ?>
<br>
         
                 <label>Group</label>
                      <select   id='group' class="form-control form-control-sm">
                       <option value="">Group</option>
                       <?php
   $sql="SELECT DISTINCT Sgroup from MasterCourseStructure ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {    
     $Sgroup = $row1['Sgroup'];  
    ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }
?>
            </select>
             





        
                <br>
                 <button onclick="search_data();" class="btn btn-success btn-sm">Search</button> &nbsp; &nbsp;
                 <button onclick="export_data();" class="btn btn-success btn-sm">Export</button>
         
            
            </div>
          </div>
<br>
            

         
            <div class="col-lg-10">
              <div class="row" id="load_study_scheme">

             
            </div>
          </div>
        </div>
           </div>
         </div>

  <?php  
  sqlsrv_close($conntest);
}

elseif($code==10)
{
   
    $outtime="No Punch";
     $date=$_POST['date'];
     $id=$_POST['id'];
     if($_POST['intime']!='')
     {
         $intime=$_POST['intime'];
     }
     else{
        $intime="No Punch";
     }
     if($_POST['outtime']!='')
     {
         $outtime=$_POST['outtime'];
     }
     else{
        $outtime="No Punch";
     }
    
        ?>
<div class="row">
    <input type="hidden" id="leaveEmplID" value="<?=$id;?>">
    <div class="col-lg-3"><label>Against Date</label><input type="text" id="AgainstDate" value="<?=$date;?>" readonly class="form-control"></div>
    <div class="col-lg-3"><label>InTime</label><input type="text" value="<?=$intime;?>" readonly class="form-control"></div>
    <div class="col-lg-3"><label>OutTime</label><input type="text" value="<?=$outtime;?>" readonly class="form-control"></div>
    <div class="col-lg-3">
        <label>Leave Balance</label>
    <select class="form-control" name="AddBlance" id="AddBlance">
                                        <option value="1">Full</option>
                                        <option value="0.25">0.25</option>
                                        <option value="0.5">0.50</option>
                                        <option value="0.75">0.75</option>
                                    </select>
    </div>
</div>

                                <?php 
}
elseif($code==11)
{

$leaveEmplID=$_POST['leaveEmplID'];
$AgainstDate=$_POST['AgainstDate'];
$AddBlance=$_POST['AddBlance'];
 $deductionBLance="UPDATE LeaveBalances SET Balance=Balance+$AddBlance where Employee_Id='$leaveEmplID' and LeaveType_Id='2'";
$deductionBLanceRun=sqlsrv_query($conntest,$deductionBLance);
if($deductionBLanceRun)
{
     $insertBLance="INSERT into LeaveRecord (LeaveDate,EmployeeID,LeaveTypeID,Balance,AddedBy,AddedDate,Monthly)Values('$AgainstDate','$leaveEmplID','2','$AddBlance','$EmployeeID','$timeStamp','0')";
$insertBLanceRun=sqlsrv_query($conntest,$insertBLance);
if($insertBLanceRun==true)
{
    echo "1";
}
else{
    echo "0";
}
}

}
elseif($code==12)
{
    $recommendID=$_POST['recommendID'];
    $senctionID=$_POST['senctionID'];
    foreach($_POST['students'] as $key => $value)
    { 
        $up="UPDATE Staff SET LeaveRecommendingAuthority = '$recommendID',LeaveSanctionAuthority = '$senctionID' where IDNo='$value'";
        sqlsrv_query($conntest,$up);
        $checkLeaveAlreadySubmited="SELECT * FROM ApplyLeaveGKU WHERE StaffId='$value'  and Status!='Approved' and Status!='Reject'";
        $countX=sqlsrv_query($conntest,$checkLeaveAlreadySubmited,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
        $leaveexistCount=sqlsrv_num_rows($countX);
        if($leaveexistCount>0)
        {
            $updateLeaveAuth="UPDATE ApplyLeaveGKU SET SanctionId='$recommendID',AuthorityId='$senctionID' where StaffId='$value' and Status!='Approved' and Status!='Reject'";
            sqlsrv_query($conntest,$updateLeaveAuth);
            
        }
    }
    
}
elseif($code==13)
{
    $id = $_POST['id'];
    $relievingDate = $_POST['relievingDate'];
    $query = "UPDATE AdditionalResponsibilities SET RelievingDate = ? WHERE ID = ? ";
    $params = [$relievingDate, $id];
    $stmt = sqlsrv_query($conntest, $query, $params);
    if ($stmt) {
        echo "1";
    } else {
        echo "0";
    }
}
elseif($code==14)
{
   
    $course=$_POST['course'];
    $batch=$_POST['batch'];
    $semester=$_POST['semester'];
    $day=$_POST['day'];
    $lecture=$_POST['lecture'];
    $subject=$_POST['subject'];
    $section=$_POST['section'];
    $group=$_POST['group'];

if($day=='Monday'){$order=1;}else if($day=='Tuesday'){$order=2;}else if($day=='Wednesday'){$order=3;}else if($day=='Thursday'){$order=4;}else if($day=='Friday'){$order=5;}else if($day=='Saturday'){$order=6;}else if($day=='Sunday'){$order=7;}

           $query1 = "SELECT  Distinct CollegeID  FROM MasterCourseCodes WHERE  CourseID='$course'";
        $getCourseRun1=sqlsrv_query($conntest,$query1);
                                 if($rowCourseName = sqlsrv_fetch_array($getCourseRun1, SQLSRV_FETCH_ASSOC))
                                 { 
                                 $CollegeID=$rowCourseName['CollegeID'];
                                 }


 $queryday = "SELECT  *  FROM TimeTable WHERE  Day='$day' AND LectureNumber='$lecture' AND IDNo='$EmployeeID' AND Status>0 ANd Examination='$CurrentExamination'";
        $querydayrun=sqlsrv_query($conntest,$queryday);
                                 if($querydayrunrow = sqlsrv_fetch_array($querydayrun, SQLSRV_FETCH_ASSOC))
                                 { 
                                echo "2";
                                 }
                                 else
                                 {

   $update1 = "INSERT INTO TimeTable(CollegeID,CourseID,Batch,SemesterID,LectureNumber, IDNo,Day,SubjectCode,Examination,CreatedDate,Section,GroupName,Status,DayOrder) 
            VALUES('$CollegeID','$course', '$batch', '$semester','$lecture','$EmployeeID','$day','$subject','$CurrentExamination','$timeStamp','$section','$group','1','$order')";
                sqlsrv_query($conntest,$update1);
if ($update1){
        echo "1";
    } else {
        echo "0";
    }
   }  
    
}
elseif ($code==15) {
    $student_id=$_POST['student_id'];
    $value=$_POST['value'];
     $updateSection="UPDATE Admissions SET Section='$value' where IDNo='$student_id'";
    $updateSectionRun=sqlsrv_query($conntest,$updateSection);
    if($updateSectionRun==true)
    {
        echo "1";
    }
    else{
        echo "0";
    }
}
elseif ($code==16) {
    $student_id=$_POST['student_id'];
    $value=$_POST['value'];
     $updateSection="UPDATE Admissions SET ClassGroup='$value' where IDNo='$student_id'";
    $updateSectionRun=sqlsrv_query($conntest,$updateSection);
    if($updateSectionRun==true)
    {
        echo "1";
    }
    else{
        echo "0";
    }
}
elseif ($code==17) {
    $title=$_POST['title'];
    $type=$_POST['type'];
    $date=$_POST['date'];
      $updateSection="INSERT into CouponRecord (Title,Type,EventDate)
     Values('$title','$type','$date')";
    $updateSectionRun=sqlsrv_query($conntest,$updateSection);
    if($updateSectionRun==true)
    {
        echo "1";
    }
    else{
        echo "0";
    }
}
elseif ($code==18) {
    ?>
<table class="table table-bordered">
<tr>
    <th>SrNo</th>
    <th>Title</th>
    <th>Type</th>
    <th>Date</th>
    <th>Start</th>
    <th>End</th>
    <th>Action</th>
</tr>
<?php 
   $Sr=1;
     $updateSection="SELECT * FROM CouponRecord order by ID Desc ";
    $updateSectionRun=sqlsrv_query($conntest,$updateSection);
    while($row=sqlsrv_fetch_array($updateSectionRun,SQLSRV_FETCH_ASSOC))
    {
          ?>
      
         <tr>
        <td><?=$Sr;?></td>
        <td><?=$row['Title'];?></td>
        <td><?=$row['Type'];?></td>
        <td><?=$row['EventDate']->format('d-m-Y');?></td>
        <td><input type="number" class="form-control"   id="StartNumber<?=$row['ID'];?>" value="<?=$row['SrStart'];?>"></td>
        <td><input type="number" class="form-control"  id="EndNumber<?=$row['ID'];?>" value="<?=$row['SrEnd'];?>">
    </td>
        <td>
            <?php if($row['Type']=='All'){
?>
                <button type="submit" class="btn btn-success" onclick="printCouponAll('<?=$row['ID'];?>');"><i class="fa fa-print"></i></button>
  <?php          }else{
                ?>
<button type="submit" class="btn btn-success" onclick="printCoupon('<?=$row['ID'];?>');"><i class="fa fa-print"></i></button>

                <?php 
            }?>
        </td>
        </tr>

    <?php
        $Sr++; 
    }
   ?>
   </table><?php 
}
elseif ($code==19)
 {
    $Count=$_POST['CountType'];
    $Type=$_POST['Type'];
    $file = $_FILES['casualCountFile']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  { 
if($c>0)
{
  $EmpID=$filesop[0];
  $Update="UPDATE LeaveBalances SET Balance=Balance+$Count Where Employee_Id='$EmpID' and LeaveType_Id='$Type'";
 $ss=sqlsrv_query($conntest,$Update);
 if($ss=true)
 {
     $insertBLance="INSERT into LeaveRecord (LeaveDate,EmployeeID,LeaveTypeID,Balance,AddedBy,AddedDate,Monthly)Values('$timeStamp','$EmpID','$Type','$Count','$EmployeeID','$timeStamp','0')";
     $insertBLanceRun=sqlsrv_query($conntest,$insertBLance);
 }
}
$c++;
}
   }
   elseif($code=='20') 
   {
    $sub_data=$_POST['sub_data'];
    if ($sub_data == 2) {
        $from = $_POST['from'];
        $to = $_POST['to'];
        $Status = $_POST['Status'];
        $dateColumn = "";
        if ($Status == '0') {
            $dateColumn = "StudentCorrectionData.SubmitDate";
        } elseif ($Status == '1') {
            $dateColumn = "StudentCorrectionData.VerifiedDate";
        } elseif ($Status == '2') {
            $dateColumn = "StudentCorrectionData.RejectDate";
        }

        if ($Status != 'All') {
           
            if ($Status == '0') {
                $StuCorection = "
                    SELECT Top 50 *,StudentCorrectionData.Status as ActionStatus,Admissions.FatherName as SFatherName,Admissions.MotherName as SMotherName, 
                           Admissions.Sex as SGender FROM StudentCorrectionData INNER JOIN Admissions ON Admissions.IDNo = StudentCorrectionData.IDNo 
                    WHERE StudentCorrectionData.Status = '$Status' ORDER BY $dateColumn ASC";  
            } else {
    
                 $StuCorection = "
                    SELECT Top 50 *,StudentCorrectionData.Status as ActionStatus,Admissions.FatherName as SFatherName,Admissions.MotherName as SMotherName,Admissions.Sex as SGender
                    FROM StudentCorrectionData INNER JOIN Admissions ON Admissions.IDNo = StudentCorrectionData.IDNo WHERE StudentCorrectionData.Status = '$Status' AND $dateColumn BETWEEN '$from 00:00:00' AND '$to 23:59:59'
                    ORDER BY $dateColumn ASC";
            }
        } else {
   
            $StuCorection = "
                SELECT TOP 50 *,StudentCorrectionData.Status as ActionStatus,Admissions.FatherName as SFatherName,Admissions.MotherName as SMotherName,Admissions.Sex as SGender
                FROM StudentCorrectionData INNER JOIN Admissions ON Admissions.IDNo = StudentCorrectionData.IDNo WHERE $dateColumn BETWEEN '$from 00:00:00' AND '$to 23:59:59'
                ORDER BY StudentCorrectionData.SubmitDate DESC";
        }
    }
    
     else {
        $rollno = $_POST['Rollno'];
        if (is_numeric($rollno)) {
             $StuCorection = "
                SELECT *, 
                       StudentCorrectionData.Status as ActionStatus, 
                       Admissions.FatherName as SFatherName, 
                       Admissions.MotherName as SMotherName, 
                       Admissions.Sex as SGender
                FROM StudentCorrectionData 
                INNER JOIN Admissions 
                ON Admissions.IDNo = StudentCorrectionData.IDNo 
                WHERE Admissions.IDNo = '$rollno' 
                      OR Admissions.UniRollNo = '$rollno'  OR Admissions.ClassRollNo = '$rollno'
                ORDER BY StudentCorrectionData.SubmitDate ASC";
        } else {
             $StuCorection = "
                SELECT *, 
                       StudentCorrectionData.Status as ActionStatus, 
                       Admissions.FatherName as SFatherName, 
                       Admissions.MotherName as SMotherName, 
                       Admissions.Sex as SGender
                FROM StudentCorrectionData 
                INNER JOIN Admissions 
                ON Admissions.IDNo = StudentCorrectionData.IDNo 
                WHERE Admissions.UniRollNo = '$rollno' 
                      OR Admissions.ClassRollNo = '$rollno'
                ORDER BY StudentCorrectionData.SubmitDate ASC";
        }
    }
    
   
    
    ?>
    <table class="table table-bordered" id="example">
                             <thead>
                                 <tr style='font-size:14px;'>
                                 <th>SrNo</th>
                                <th>UniRollNo</th>
                                <th>ClassRollNo</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Mother Name</th>
                                <th>Gender</th>
                               
                                <th>Status</th>
                                <th>Submit Date</th>
                                 </tr>
                             </thead>
                             <tbody>
                                <?php 
  $arrayFaultyArticle[]='';
  $StuCorection_num=0;
  $StuCorection_run=sqlsrv_query($conntest,$StuCorection);
  if($StuCorection_run === false)
  {
 die( print_r( sqlsrv_errors(), true) );
 }
 while ($StuCorection_row=sqlsrv_fetch_array($StuCorection_run)) 
 {
    $clr= "";
    if($StuCorection_row['ActionStatus']==1){
        $clr="success";
    }else if($StuCorection_row['ActionStatus']==2){
        $clr="danger";
    }else{
        $clr= "primary";
    };
 
 $StuCorection_num=$StuCorection_num+1;?>
 <tr class="bg-<?=$clr;?>">
 <td><?=$StuCorection_num;?></td>
 <td onclick="edit_stu(<?=$StuCorection_row['ID'];?>);"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$StuCorection_row['UniRollNo'];?></td>
 <td onclick="edit_stu(<?=$StuCorection_row['ID'];?>);"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$StuCorection_row['ClassRollNo'];?></td>
 <td><?=$StuCorection_row['StudentName'];?></td>
 <td><?=$StuCorection_row['SFatherName'];?></td>
 <td><?=$StuCorection_row['SMotherName'];?></td>
 <td><?=$StuCorection_row['SGender'];?></td>
 <td><?php if($StuCorection_row['ActionStatus']==1){
     echo "Success";
 }else{
     echo "Pending";
 };?></td>
 <td><?=$StuCorection_row['SubmitDate']->format('d-m-Y');?></td>
</tr>
<?php 
$arrayFaultyArticle[]=$StuCorection_row['IDNo'];
 
 }   
 ?>
  </tbody>
  </table><?php   
  sqlsrv_close($conntest);
   }
   elseif($code==21)
   {
   $count=array(); 

     $list_sql="SELECT *  FROM StudentCorrectionData  INNER JOIN Admissions  ON Admissions.IDNo = StudentCorrectionData.IDNo  WHERE StudentCorrectionData.Status = '0' ";
      $list_sql_run=sqlsrv_query($conntest,$list_sql,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
      $Pending=sqlsrv_num_rows($list_sql_run);

      $list_sqlRejected="SELECT *  FROM StudentCorrectionData  INNER JOIN Admissions  ON Admissions.IDNo = StudentCorrectionData.IDNo  WHERE StudentCorrectionData.Status = '2'";
        $list_sqlRejected_run=sqlsrv_query($conntest,$list_sqlRejected,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
        $Rejeted=sqlsrv_num_rows($list_sqlRejected_run);

         

            $list_sqlAccepted="SELECT *  FROM StudentCorrectionData  INNER JOIN Admissions  ON Admissions.IDNo = StudentCorrectionData.IDNo  WHERE StudentCorrectionData.Status = '1'";
              $list_sqlAccepted_run=sqlsrv_query($conntest,$list_sqlAccepted,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
              $Accepted=sqlsrv_num_rows($list_sqlAccepted_run);
        
   
      $count[0]=$Pending;
      $count[1]=$Rejeted;
      $count[2]=$Accepted;
    echo json_encode($count);
    sqlsrv_close($conntest);
   }

   else if($code==22)
   {
    $IDNo=$_POST['id'];
     $sql = "SELECT *,StudentCorrectionData.Status as ActionStatus,Admissions.StudentName as SStudentName,Admissions.DOB as SDOB,Admissions.FatherName as SFatherName,Admissions.MotherName as SMotherName,Admissions.Sex as SGender FROM StudentCorrectionData 
                INNER JOIN Admissions  ON Admissions.IDNo = StudentCorrectionData.IDNo  WHERE StudentCorrectionData.ID = '$IDNo'";
    $stmt1 = sqlsrv_query($conntest,$sql);
            while($row6 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
             {
                $ID= $row6['ID'];
                $IDNo= $row6['IDNo'];
                $ClassRollNo= $row6['ClassRollNo'];
                $img= $row6['Image'];
                $FilePath= $row6['FilePath'];
                $UniRollNo= $row6['UniRollNo'];
                $name = $row6['SStudentName'];
                $father_name = $row6['SFatherName'];
                $mother_name = $row6['SMotherName'];
                $status = $row6['ActionStatus'];
                 $dob = $row6['SDOB']->format('d-m-Y');
                $gender = $row6['Sex'];
                $Nname = $row6['StudentName'];
                $Nfather_name = $row6['FatherName'];
                $Nmother_name = $row6['MotherName'];
                $remakrsbystudent = $row6['StudentRemarks'];
                 $Ndob = $row6['DateOfBirth']->format('d-m-Y');
                $Ngender = $row6['Gender'];
                $UpdateBy = $row6['UpdateBy'];
                $clr="";
                if($name!=$Nname)
                {
                    $clr1="danger";
                }
                if($father_name!=$Nfather_name)
                {
                    $clr2="danger";
                }
                if($mother_name!=$Nmother_name)
                {
                    $clr3="danger";
                }
                if($dob!=$Ndob)
                {
                    $clr4="danger";
                }
                if($gender!=$Ngender)
                {
                    $clr5="danger";
                }


                $course = $row6['Course'];
                $email = $row6['EmailID'];
                $phone = $row6['StudentMobileNo'];
                $batch = $row6['Batch'];
                $college = $row6['CollegeName'];
                $CourseID=$row6['CourseID'];
                $CollegeID=$row6['CollegeID'];
              }
    ?>
    <div class="card-body table-responsive">
 <table class="table"  style="border:1px solid black">

 <tr>
 <td colspan="2"><b>IDNo:</b> &nbsp;<?php echo $IDNo;?></td>
 <td colspan="4"><b>Class Roll No:</b> &nbsp;<?php echo $ClassRollNo;?></td>
   <td  colspan="4" ><b>Uni Roll No: </b> &nbsp;<?=$UniRollNo;?></td>
 </tr>
 <tr>
 <td ><b>Name:</b> </td>
 <td colspan="8"><?=$name;?></td>
 <td  rowspan="5" >
 <?php echo '<img src="'.$BasURL.'Images/Students/'.$img.'" height="100" width="100" class="img-thumnail" />';?>
 </td>
 </tr>
  <tr>
   <td><b>Father Name:</b></td>
   <td ><?php echo $father_name;?></td>
   <td><b>Mother Name:</b></td>
   <td ><?=$mother_name;?></td>
 </tr>
 <tr>
   <td><b>College:</b></td>
   <td ><?php echo $college;?></td>
   <td><b>Course:</b></td>
   <td colspan="7"><?=$course;?></td>
 </tr>
 <tr>
   <td><b>DOB:</b></td>
   <td ><?php echo $dob;?></td>
   <td><b>Gender:</b></td>
   <td colspan="7"><?=$gender;?></td>
 </tr>
   <tr>
        </table>
 <table class="table"  style="border:1px solid black">
 <tr class="bg-dark">
 <td colspan="5"><b  style="float:left">Old Details</b></td>
 <td colspan="5"><b  style="float:left">New Details</b></td>
 </tr>
 <tr class="text-<?=$clr1;?>">
 <td ><b>Name:</b> </td>
 <td colspan="4"><?=$name;?></td>
 <td ><b>Name:</b> </td>
 <td colspan="4"><?=$Nname;?></td>
 </tr>
    <tr class="text-<?=$clr2;?>">
    <td><b>Father Name:</b></td>
    <td colspan="4" ><?php echo $father_name;?></td>
    <td colspan="4"><b>Father Name:</b></td>
    <td ><?php echo $Nfather_name;?></td>
 </tr>
    <tr class="text-<?=$clr3;?>">
    <td><b>Mother Name:</b></td>
   <td colspan="4"><?=$mother_name;?></td>
    <td colspan="4"><b>Mother Name:</b></td>
   <td ><?=$Nmother_name;?></td>
 </tr>
 <tr class="text-<?=$clr4;?>">
   <td><b>DOB:</b></td>
   <td colspan="4"><?php echo $dob;?></td>
   <td colspan="4"><b>DOB:</b></td>
   <td ><?php echo $Ndob;?></td>
 </tr>
 <tr class="text-<?=$clr5;?>">
 <td><b>Gender:</b></td>
 <td colspan="4"><?=$gender;?></td>
 <td colspan="4"><b>Gender:</b></td>
 <td ><?=$Ngender;?></td>
 </tr>
 <tr>

 <td colspan="10"><b>Remmarks by Student:</b>&nbsp;&nbsp;<?php echo $remakrsbystudent;?></td>
 </tr>
 <tr>

 <td colspan="10"><b>Attachment:</b>&nbsp;&nbsp;<a href="http://erp.gku.ac.in:86/Images/Correction/<?=$FilePath;?>" target="_blank"><i class="fa fa-eye"></i></a></td>
 </tr>
 
  <?php 
  if($status=='0' )
  {?>
 <tr>
 <td colspan="10"><b>Remarks:</b>
 <textarea id="remarksForApproved" cols="10" class='form-control'
                                    placeholder="Write your remakrs.........."></textarea>
                                <small id="error-leave-textarea" class='text-danger' style='display:none;'>Please enter
                                    a value minimum 3 characters.</small>
</td>
 </tr>
 <?php
 }
 else{
    ?>
<tr>
    <td colspan="10">
       Updated By: <?=$UpdateBy;?>
    </td>
 </tr>
    <?php
 }
 ?>
 <tr>
 <td>
    <?php if($status=='0' )
    {
        ?>
 <input type="button" value="Reject" class="btn btn-danger" onclick="rejectbutton('<?=$ID;?>','<?=$IDNo;?>');">
 <input type="button" value="Verified" class="btn btn-success" onclick="Verifiedbutton('<?=$ID;?>','<?=$IDNo;?>');">
 <?php 
}
else if($status=='2'){
    ?>
    
     <input type="button" value="Verified" class="btn btn-success" onclick="Verifiedbutton('<?=$ID;?>','<?=$IDNo;?>');">
    <?php }
else{
    ?>
    <?php }?>
    
</td>
 </tr>

   <tr>
        </table>
        <?php 
   }
   elseif($code==23)
{

    $id=$_POST['id'];
    $IDNo=$_POST['IDNo'];
       $remarks =str_replace("'",'',$_POST['remarks']);
       $updateLeaveAcrodingToAction="UPDATE  StudentCorrectionData  SET UpdateBy='$EmployeeID',Status='2',Remarks='$remarks', RejectDate='$timeStamp' WHERE ID='$id'";
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
    $escapedQuery1 = str_replace("'", "''", $updateLeaveAcrodingToAction);
    $update1 = "INSERT INTO logbook(userid, remarks, updatedby, date) VALUES('$IDNo', '$escapedQuery1', '$EmployeeID', '$timeStamp')";
            sqlsrv_query($conntest,$update1);
            if($updateLeaveAcrodingToActionRun === false) {
   
                die( print_r( sqlsrv_errors(), true) );
                }
    if($updateLeaveAcrodingToActionRun==true)
      {
        echo "1";
      }
      else{
        echo "0";
      }
      sqlsrv_close($conntest);
}
   elseif($code==24)
{

    $id=$_POST['id'];
    $IDNo=$_POST['IDNo'];
    $sql = "SELECT * FROM StudentCorrectionData   WHERE ID = '$id'";
$stmt1 = sqlsrv_query($conntest,$sql);
if($row6 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
 {
    $ID= $row6['ID'];
    $IDNo = trim($row6['IDNo']);
    $Nname = trim($row6['StudentName']);
    $Nfather_name = trim($row6['FatherName']);
    $Nmother_name = trim($row6['MotherName']);
    $Ndob = $row6['DateOfBirth']->format('Y-m-d');
    $Ngender = trim($row6['Gender']);
     $updateLeaveAcrodingToAction="UPDATE  Admissions  SET StudentName='$Nname',FatherName='$Nfather_name',MotherName='$Nmother_name',DOB='$Ndob',Sex='$Ngender' WHERE IDNo='$IDNo'";
    $updateLeaveAcrodingToActionRun=sqlsrv_query($conntest,$updateLeaveAcrodingToAction);
 }
 $updateLeaveAcrodi="UPDATE  StudentCorrectionData  SET UpdateBy='$EmployeeID',Status='1',VerifiedDate='$timeStamp' WHERE ID='$id'";
 sqlsrv_query($conntest,$updateLeaveAcrodi);
    $escapedQuery1 = str_replace("'", "''", $updateLeaveAcrodingToAction);
    $update1 = "INSERT INTO logbook(userid, remarks, updatedby, date) VALUES('$IDNo', '$escapedQuery1', '$EmployeeID', '$timeStamp')";
            sqlsrv_query($conntest,$update1);
    if($updateLeaveAcrodingToActionRun==true)
      {
        echo "1";
      }
      else{
        echo "0";
      }
      sqlsrv_close($conntest);
}
//time for faculty side
elseif($code==25) 
{
   $CollegeName="";
$CourseName="";
$SubjectName="";
?>
        <table class="table " id="example">
        
            <tbody style="height:1px" id="">
                <?php 
    $Sr=1;
    
    $getprograms="SELECT Distinct CourseID  FROM TimeTable  where IDNo='$EmployeeID'  AND Examination='$CurrentExamination' AND  Status='1' order by  CourseID  DESC "; 
    $getprogramsRun=sqlsrv_query($conntest,$getprograms);
    while($getprogramsrow=sqlsrv_fetch_array($getprogramsRun,SQLSRV_FETCH_ASSOC))
    { 
  //echo $getprogramsrow['CourseID'];

 $getAllcourse1 = "SELECT  Distinct Course FROM MasterCourseStructure 
                  WHERE CourseID = '" . $getprogramsrow['CourseID'] . "'"  ;

    $etAllcourse1Run=sqlsrv_query($conntest,$getAllcourse1);
    while($rowcourse=sqlsrv_fetch_array($etAllcourse1Run,SQLSRV_FETCH_ASSOC))   

{
  ?>

  <tr>
                    <th colspan="6" style="text-align: center;color: red"><?=$rowcourse['Course'];?></th></tr>

                <tr>
                    <th>Sr. No</th>
                    <th>Day</th>
                    <th>Lecture</th>
                  <!--   <th>College</th> -->
                    
                    <th>Semester</th>
                    <th>Batch</th>
                    <th>Subject</th>
                 
                 
                </tr>
            <?php 
}
  $getAllleaves="SELECT * FROM TimeTable  where IDNo='$EmployeeID'  AND Examination='$CurrentExamination' AND  Status='1' AND CourseID='" .$getprogramsrow['CourseID']. "'  order by  DayOrder  ASC "; 

    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    { 
  $getAllleaves1 = "SELECT  Distinct Course,SubjectName FROM MasterCourseStructure 
                  WHERE CourseID = '" . $row['CourseID'] . "' 
                  AND CollegeID = '" . $row['CollegeID'] . "' 
                  AND SubjectCode = '" . $row['SubjectCode'] . "' AND Batch = '" . $row['Batch'] . "'";
    $getAllleavesRun1=sqlsrv_query($conntest,$getAllleaves1);
    while($row1=sqlsrv_fetch_array($getAllleavesRun1,SQLSRV_FETCH_ASSOC))   

{


?>
                <tr>
                    <td><?=$Sr;?></td>  <td><?=$row['Day'];?></td><td><?=$row['LectureNumber'];?></td>
                   <!--  <td><?=$row1['CollegeName'];?></td> -->
                    
                    <td><?=$row['SemesterID'];?></td>
                    <td><?=$row['Batch'];?>-<?=$row['Section'];?>/<?=$row['GroupName'];?></td>
                    <td><?=$row1['SubjectName'];?>(<?=$row['SubjectCode'];?>)</td>
                    
                    
                    <td>
               
                        </div>


                    </td>
                </tr>
                <?php

       }
        $Sr++;
        // $aa[]=$row;
    }
}
    // print_r($aa);
    ?>
 </tbody>
</table>
        
        <?php 
          sqlsrv_close($conntest);

}
elseif($code==25.1) 
{
    $CollegeName="";
$CourseName="";
$SubjectName="";
?>
        <table class="table " id="example">
          
            <tbody style="height:1px" id="">
                <?php 
    $Sr=1;
    
    $getprograms="SELECT Distinct CourseID  FROM TimeTable  where IDNo='$EmployeeID'  AND Examination='$CurrentExamination' AND  Status='1' order by  CourseID  DESC "; 
    $getprogramsRun=sqlsrv_query($conntest,$getprograms);
    while($getprogramsrow=sqlsrv_fetch_array($getprogramsRun,SQLSRV_FETCH_ASSOC))
    { 
  //echo $getprogramsrow['CourseID'];

 $getAllcourse1 = "SELECT  Distinct Course FROM MasterCourseStructure 
                  WHERE CourseID = '" . $getprogramsrow['CourseID'] . "'"  ;

    $etAllcourse1Run=sqlsrv_query($conntest,$getAllcourse1);
    while($rowcourse=sqlsrv_fetch_array($etAllcourse1Run,SQLSRV_FETCH_ASSOC))   

{
  ?>
  <tr>
                    <th colspan="9" style="text-align: center;border: 1px solid red;"><?=$rowcourse['Course'];?></th></tr>

<tr style="border: 1px solid red;"><th style="border: 1px solid red;">Day / Lecture No</th><th style="text-align: center;border: 1px solid red">1</th><th style="text-align: center;border: 1px solid red">2</th><th style="text-align: center;border: 1px solid red">3</th>
    <th style="text-align: center;border: 1px solid red">4</th><th style="text-align: center;border: 1px solid red">5</th><th style="text-align: center;border: 1px solid red">6</th><th style="text-align: center;border: 1px solid red">7</th>
    <th style="text-align: center;border: 1px solid red">8</th></tr>


<?php
// Define the start and end dates
$start_date = new DateTime('2025-01-06'); // Start date
$end_date = new DateTime('2025-01-11');   // End date

// Add 1 day to include the end date in the loop
$end_date->modify('+1 day');

// Loop through each day
$interval = new DateInterval('P1D'); // 1 day interval
$date_range = new DatePeriod($start_date, $interval, $end_date);

foreach ($date_range as $date) {

 

   $day_name = $date->format('l'); // Get the day name
    
    if ($day_name === 'Sunday') {
        continue; // Skip Sundays
    }
    

?>


<tr><td style="border: 1px solid red;"><?=$day_name;?></td>

    <?php 

for($i=1;$i<=8;$i++)
{
    $getAllleaves="SELECT * FROM TimeTable  where IDNo='$EmployeeID'  AND Examination='$CurrentExamination' AND  Status='1' AND CourseID='" .$getprogramsrow['CourseID']. "' ANd Day='$day_name' AND LectureNumber='$i'  order by  DayOrder  ASC "; 

  
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    { 
  $getAllleaves1 = "SELECT  Distinct Course,SubjectName FROM MasterCourseStructure 
                  WHERE CourseID = '" . $row['CourseID'] . "' 
                  AND CollegeID = '" . $row['CollegeID'] . "' 
                  AND SubjectCode = '" . $row['SubjectCode'] . "' AND Batch = '" . $row['Batch'] . "'";
;
    $getAllleavesRun1=sqlsrv_query($conntest,$getAllleaves1);
    if($row1=sqlsrv_fetch_array($getAllleavesRun1,SQLSRV_FETCH_ASSOC))   

{
?><td style="border: 1px solid red;">Semester -<?=$row['SemesterID'];?> &nbsp; <?=$row1['SubjectName'];?> (<?=$row['SubjectCode'];?>) <?=$row['Batch'];?>-<?=$row['Section'];?>/<?=$row['GroupName'];?></td>
  <?php

       }
       
        $Sr++;
        // $aa[]=$row;
    }
    else
    {?>
        <td style="border: 1px solid red" style="text-align: center;min-width: 500px;"></td>
    <?php }
}
}
?></tr>






                    <?php 
}




}

    ?>
            </tbody>
        </table><?php 
          sqlsrv_close($conntest);

}


elseif($code==25.2) 
{
    $CollegeName="";
$CourseName="";
$SubjectName="";
?>
        <table class="table " id="example">
          
            <tbody style="height:1px" id="">
                <?php 
    $Sr=1;
    
//     $getprograms="SELECT Distinct CourseID  FROM TimeTable  where IDNo='$EmployeeID'  AND Examination='$CurrentExamination' AND  Status='1' order by  CourseID  DESC"; 
//     $getprogramsRun=sqlsrv_query($conntest,$getprograms);
//     while($getprogramsrow=sqlsrv_fetch_array($getprogramsRun,SQLSRV_FETCH_ASSOC))
//     { 
//   //echo $getprogramsrow['CourseID'];
//  $getAllcourse1 = "SELECT  Distinct Course FROM MasterCourseStructure 
//                   WHERE CourseID = '" . $getprogramsrow['CourseID'] . "'"  ;

//     $etAllcourse1Run=sqlsrv_query($conntest,$getAllcourse1);
//     while($rowcourse=sqlsrv_fetch_array($etAllcourse1Run,SQLSRV_FETCH_ASSOC))   

// {
//   ?>
  <!-- <tr>
                    <th colspan="9" style="text-align: center;border: 1px solid red;"><?=$rowcourse['Course'];?></th></tr> -->

<tr style="border: 1px solid red;"><th style="border: 1px solid red;">Day / Lecture No</th><th style="text-align: center;border: 1px solid red">1</th><th style="text-align: center;border: 1px solid red">2</th><th style="text-align: center;border: 1px solid red">3</th>
    <th style="text-align: center;border: 1px solid red">4</th><th style="text-align: center;border: 1px solid red">5</th><th style="text-align: center;border: 1px solid red">6</th><th style="text-align: center;border: 1px solid red">7</th>
    <th style="text-align: center;border: 1px solid red">8</th></tr>


<?php
// Define the start and end dates
$start_date = new DateTime('2025-01-06'); // Start date
$end_date = new DateTime('2025-01-11');   // End date

// Add 1 day to include the end date in the loop
$end_date->modify('+1 day');

// Loop through each day
$interval = new DateInterval('P1D'); // 1 day interval
$date_range = new DatePeriod($start_date, $interval, $end_date);

foreach ($date_range as $date) {

 

   $day_name = $date->format('l'); // Get the day name
    
    if ($day_name === 'Sunday') {
        continue; // Skip Sundays
    }
    

?>


<tr><td style="border: 1px solid red;"><?=$day_name;?></td>

    <?php 

for($i=1;$i<=8;$i++)
{
    $getAllleaves="SELECT * FROM TimeTable  where IDNo='$EmployeeID'  AND Examination='$CurrentExamination' AND  Status='1'  ANd Day='$day_name' AND LectureNumber='$i'  order by  DayOrder  ASC "; 

  
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    if($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    { 
  $getAllleaves1 = "SELECT  Distinct Course,SubjectName FROM MasterCourseStructure 
                  WHERE CourseID = '" . $row['CourseID'] . "' 
                  AND CollegeID = '" . $row['CollegeID'] . "' 
                  AND SubjectCode = '" . $row['SubjectCode'] . "' AND Batch = '" . $row['Batch'] . "'";
;
    $getAllleavesRun1=sqlsrv_query($conntest,$getAllleaves1);
    if($row1=sqlsrv_fetch_array($getAllleavesRun1,SQLSRV_FETCH_ASSOC))   

{
?><td style="border: 1px solid red;">Semester -<?=$row['SemesterID'];?> &nbsp; <?=$row1['SubjectName'];?> (<?=$row['SubjectCode'];?>) <?=$row['Batch'];?>-<?=$row['Section'];?>/<?=$row['GroupName'];?></td>
  <?php

       }
       
        $Sr++;
        // $aa[]=$row;
    }
    else
    {?>
        <td style="border: 1px solid red" style="text-align: center;min-width: 500px;"></td>
    <?php }
}
}
?></tr>
 <?php 

   sqlsrv_close($conntest);                 

}

elseif($code==25.3)

   {
     ?><div class="row">
         <div class="col-lg-3">
        <div class="card">
        <div class="card-header">
       
         <b>Add Article</b>
        
       </div>
        </div>
           
              <label>Name of Article</label>
                <input type="text" name="ArticleName" id='ArticleName'placeholder="Name of Article"  class="form-control">

<label>Description</label>
                <input type="text" name="ArticleSpecification" id='ArticleSpecification' placeholder="Specification"  class="form-control">
<br>
<button onclick="submitarticle()"  class="btn btn-primary">Add</button>
              </div>



               <div class="col-lg-9">
                    <div class="card">
        <div class="card-header">
       
         <b>Manage Article</b>
</div>
         <div id="showarticle"><div>
        
       </div>
        </div>
               </div>

                
                 
          </div>  
         </div>

  <?php 
  sqlsrv_close($conntest); 
}

elseif($code==25.4)

   {
 $ArticleName=$_POST['ArticleName'];
 $ArticleSpecification=$_POST['ArticleSpecification'];
   
 $update1="insert into masterarticleadmisisoncell(Name,Description,CreatedBy,CreatedDate,Status)Values
    ('$ArticleName','$ArticleSpecification','$EmployeeID','$timeStampS','0')";




$addrun=mysqli_query($connection_s,$update1);

mysqli_close($connection_s);
echo "1";
      }



elseif($code==25.5)

   {?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created By</th>
            <th>Created Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
         $sr=1;
         $get_group="SELECT * FROM masterarticleadmisisoncell";
         $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
            $status=$row['Status'];
            if($status=='1'){
              $show='ON';
              $color='';            
            }
            else
            {
                $show='OFF';   
                $color='red';          
            }
            ?>
        <tr>
            <th><?=$sr;?></th>
            <th>
                <b><input type="text" class="form-control" id='arname<?=$row['ID'];?>' value="<?=$row['Name'];?>" onblur='chnageName(<?=$row['ID'];?>)'></b>
            </th>
            <th><b><?=$row['Description'];?></b></th>
             <th><b><?=$row['CreatedBy'];?></b></th>
             <th><b><?=$row['CreatedDate'];?></b></th>
            <th>

                <div class="form-check form-switch">
                    <select class="form-control" id='toggleForm<?=$row['ID'];?>' onchange="updateStatus(<?=$row['ID'];?>)" style="color: <?=$color;?>">
                         <option value="<?=$status;?>"><?=$show;?></option>
  <option value="1">ON</option>
   <option value="0">OFF</option>
                    </select>
   
 
</div></th>
        </tr>
        <?php 
         $sr++; }
           ?>
    </tbody>
</table>


<?php
      }
      elseif($code==25.6)

   {
 $id=$_POST['id'];
$status=$_POST['status'];

 $asd="Update masterarticleadmisisoncell set Status='$status' where ID='$id'";
   
$addrun=mysqli_query($connection_s,$asd);



mysqli_close($connection_s);

echo "1";
      }

elseif($code==25.7)

   {
     ?><div class="row">
         <div class="col-lg-3">
        <div class="card">
        <div class="card-header">
       
         <b>Add Stock</b>
        
       </div>
        </div>
           
              <label>Name of Article</label>
              <select class="form-control" id='articlecode'>
              <?php $get_group="SELECT * FROM masterarticleadmisisoncell";
         $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {?>
            <option value="<?=$row['ID'];?>"><?=$row['Name'];?></option>
            <?php }?>
</select>

<label>Quantity</label>
                <input type="number"  id='quantity' placeholder=""  class="form-control">
<br>
<button onclick="submitstock()"  class="btn btn-primary">Add</button>
              </div>



               <div class="col-lg-9">
                    <div class="card">
        <div class="card-header">
       
         <b>Master Stock</b>
</div>
         <div id="showstock"><div>
        
       </div>
        </div>
               </div>

                
                 
          </div>  
        </div> 

  <?php 
  sqlsrv_close($conntest); 
}

elseif($code==25.8)

   {?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Total Stock</th>
            <th>Issued Stock</th>
            <th>Balance</th>
            
        </tr>
    </thead>
    <tbody>
        <?php 
         $sr=1;
          $get_group="SELECT * FROM  masterstockadmissioncell  as ms inner join masterarticleadmisisoncell as ma  on ma.ID=ms.ArticleID";
     $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
            
            ?>        <tr>
            <th><?=$sr;?></th>
            <th>
                <b><?=$row['Name'];?>(<?=$row['ID'];?>)</b>
            </th>
            <th><b><?=$row['TotalStock'];?></b></th>
             <th><b><?=$row['IssuedStock'];?></b></th>

                 <th><b><?= $row['TotalStock']-$row['IssuedStock'];?></b></th>
             
          
        </tr>
        <?php
         $sr++; }
           ?>
    </tbody>
</table>


<?php
      }
      elseif($code==25.9)

   {
 $articlecode=$_POST['articlecode'];
 $quantity=$_POST['quantity'];
   
if($quantity>0)
{
 $update1="insert into puchaserecordadmisisoncell(ArticleID,Stock,UpdateBy,Date)Values
    ('$articlecode','$quantity','$EmployeeID','$timeStampS')";

 $get_group_run=mysqli_query($connection_s,$update1);


 $sql = "SELECT * FROM  masterstockadmissioncell WHERE ArticleID ='$articlecode'";
$result = mysqli_query($connection_s,$sql);

if ($result->num_rows == 0) 
{

$result_z = mysqli_query($connection_s,"INSERT into masterstockadmissioncell(ArticleID,TotalStock)
                                                   values ('$articlecode','$quantity')");
}
else
{
while($row=mysqli_fetch_array($result))
{   
     $stock_quantity=$row["TotalStock"];
}
$new_quantity=$stock_quantity+$quantity;

$result = mysqli_query($connection_s, "UPDATE masterstockadmissioncell set TotalStock='$new_quantity' WHERE ArticleID ='$articlecode'");

}

mysqli_close($connection_s);

}
      }


elseif($code==26)


   {

    $code_access=$_POST['code_access'];?>
<div class="row">
         <div class="col-lg-3">
        <div class="card">
        <div class="card-header">
       
         <b>Issue Request</b>
        
       </div>
       <script>

            </script><br>
               <div class="btn-group input-group-sm" style="text-align:center;">

 <input type="radio"   id="ossm1"  onclick="emc1_hide();" name="Employee"   checked="" value="0" required="" hidden>  

                       <label for="ossm1" class="btn  btn-xs"> Employee</label>

                       <input type="radio"  id="ossm"  name="Employee"   required=""  onclick="emc1_show();" value="1" name="empc1" hidden>  

                       <label for="ossm" class="btn btn-xs">Other</label>
    </div>
                      <div class="col-md-12" style="display: none;" id="lect_div">   
                        <label for="ossm1" class="btn  btn-xs"> Employee</label>

                      <select class="form-control" id='emptype'>
                         
                          <option value="Guest">Guest</option>
                            <option value="Field Team">FieldTeam</option>
                              <option value="Consultant">Consultant</option>
                                <option value="Other">Other</option>

                      </select>   
  <label>Name <span style="color: red">*</span></label>
  <input type="text" name="name_visitor" id="empNames" class="form-control">
  
  <label>Detail <span style="color: red">*</span></label>
  <input type="text"  id="empDetail" class="form-control">
 
  
  </div>

  <div class="col-md-12"  id="lect_div1">
 <label>Employee ID</label>
<input type="text" class="form-control" name="" id='empID' onblur="emp_detail_verify1(this.value)" >
<span id='emp-data' style="font-weight:bold"></span>
<input type="hidden" class="form-control" name="" id='empName' readonly><br>
<input type="text" class="form-control"  placeholder="Description" id='empDescription' >

<br>
                         


</div>

<br>
        <table class="table-bordered">
       <tr>   
        <th>#</th>
<th>Name of Article</th><th>Quantity</th></tr>
 
<?php  
if($code_access!='000')
{
 $get_group="SELECT * FROM masterarticleadmisisoncell ma  inner join masterstockadmissioncell ms  on ma.ID=ms.ArticleID where  ms.TotalStock>ms.IssuedStock";   
}
else
{
  $get_group="SELECT * FROM masterarticleadmisisoncell ma  inner join masterstockadmissioncell ms  on ma.ID=ms.ArticleID where  ms.TotalStock>ms.IssuedStock ANd Status='1'";   
}
$sr=1;
         $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {

            ?>

        <tr>   
<td width="10%" style="text-align:center;"><?=$sr;?></td>
<td width="30%"><?=$row['Name'];?><input type="hidden" class="form-control article" value="<?=$row['ArticleID'];?>" name="article[]" id="article">

<b>(<?php echo "Balance-". $balance=$row['TotalStock']-$row['IssuedStock'];?>)</b>
</td>
<td width="10%">  

    <select name="quantity[]" class="form-control quantity" value="0" id="article_value<?=$row['ID'];?>">
<?php  for($i=0;$i<=$balance;$i++)
{?>
 <option value="<?= $i;?>"><?= $i;?></option>
<?php }
?>    
</select>
</td>
<input type="hidden"  class="form-control remarks" id="remakrs<?=$row['ID'];?>" name="remarks[]"></tr>    
            


            <?php 

            $sr++;}?>

<input type="hidden"  value="<?=$sr-1;?>" class="form-control" id="flag">
</table>
               
<br>
<button onclick="IssueStock()"  class="btn btn-primary">Issue Stock</button>
              </div>

    </div>

               <div class="col-lg-9">
                    <div class="card">
        <div class="card-header">
       
         <b>Master Stock</b>
</div>
         <div id="issuedstocklist"><div>
        
       </div>
        </div>
               </div>

                
                 
          </div>  
         </div>

  <?php 
  sqlsrv_close($conntest); 




      }

        elseif($code==26.1)

   {
 $id=$_POST['id'];
$ArticleName=$_POST['ArticleName'];

$get_group="SELECT * FROM masterarticleadmisisoncell where  ID='$id'";   

$sr=1;
         $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
 $oldname=$row['Name'];

}
 $asd="Update masterarticleadmisisoncell set Name='$ArticleName' where ID='$id'";
   
$addrun=mysqli_query($connection_s,$asd);

 $update1="insert into trackchnages(userID,newname,oldname,createddate)Values('$EmployeeID','$ArticleName','$oldname','$timeStamp')";

$addrun=mysqli_query($connection_s,$update1);

mysqli_close($connection_s);


      }


   elseif($code==26.2)

   {
 $empID=$_POST['empid'];
  $empName=$_POST['empName'];
   $empDetail=$_POST['empDetail'];
    $emptype=$_POST['emptype'];


    $ids=$_POST['ids'];
    $qnt=$_POST['quantity'];
    $flag2= $_POST['flag2'];
    $ids=$_POST['ids'];
    $qnt=$_POST['quantity'];
    $rem=$_POST['remarks'];

$insert="insert into ledgeradmissioncell(IDNo,Name,Type,Remarks,CreatedDate,CreatedBy)Values
                                        ('$empID','$empName','$emptype','$empDetail','$timeStamp','$EmployeeID')";

$addrun=mysqli_query($connection_s,$insert);
$select="Select ID from  ledgeradmissioncell  order by ID Desc limit 1";
$get_group_run=mysqli_query($connection_s,$select);
 if($row=mysqli_fetch_array($get_group_run))
         {
 $REfno=$row['ID'];

}

   for($i=0;$i<$flag2;$i++)
   {
  $Issuedqty=$qnt[$i];
 $issue="insert into requestadmissioncell(reference_no,item_code,quantity,specification)Values
                                        ('$REfno','$ids[$i]','$qnt[$i]','$rem[$i]')";

$addissue=mysqli_query($connection_s,$issue);

 $asdws="select IssuedStock from  masterstockadmissioncell  where ArticleID='$ids[$i]'";
   $addruns=mysqli_query($connection_s,$asdws);

   while($row=mysqli_fetch_array($addruns))

{
   $IssuedStock=$row['IssuedStock'];
  
    $cstock=$IssuedStock+$Issuedqty;

 $asdw="Update masterstockadmissioncell set IssuedStock='$cstock' where ArticleID='$ids[$i]'";
   
$addrun=mysqli_query($connection_s,$asdw);


}




   }



      }

    elseif($code==26.3)

   {?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
               <th>Request No</th>
            <th>Name</th>
            <th>Type</th>
            <th>Remarks</th>
              <th>Issued By</th>
              <th>View</th>

           
            
        </tr>
    </thead>
    <tbody>
        <?php 
         $sr=1;
          $get_group="SELECT * FROM  ledgeradmissioncell  order by ID desc limit 10";
     $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
            
            ?>        <tr>
            <th><?=$sr;?></th>
            <th>
                <b><?=$row['ID'];?></b>
            </th>
            <th>
                <b><?=$row['Name'];?>(<?=$row['IDNo'];?>)</b>
            </th>
           
             <th><b><?=$row['Type'];?></b></th>
               <th><b><?=$row['Remarks'];?></b></th>
                <th><b><?=$row['CreatedBy'];?></b></th>

                   <th><b><i class="fa fa-eye" onclick="viewlist(<?=$row['ID'];?>)" data-toggle="modal" data-target="#exampleModal"></i>
 </b></th>
             
          
        </tr>
        <?php
         $sr++; }
           ?>
    </tbody>
</table>


<?php
      }

elseif($code==26.4)

   { 

    $id=$_POST['id'];

    ?>
<table class="table">
    <thead>
        <tr> <th colspan="5" style="text-align: center;">
                Request Number :<b><?=$id;?></b>
            </th></tr>
        <tr>
            <th>#</th>
              
            <th>Name</th>
            <th>Quantity</th>
            <th>Remarks</th>
            

           
            
        </tr>
    </thead>
    <tbody>
       
        <?php 
         $sr=1;
          $get_group="SELECT  * ,ma.Name as aName,ma.ID as AId FROM requestadmissioncell AS  rs inner join masterarticleadmisisoncell AS ma on rs.item_code=ma.ID  where reference_no='$id'";
     $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
            
            ?>        <tr>
            <th><?=$sr;?></th>
            
            <th>
                <b><?=$row['aName'];?>(<?=$row['AId'];?>)</b>
            </th>
           
             <th><b><?=$row['quantity'];?></b></th>
               <th><b><?=$row['specification'];?></b></th>
              

                   
          
        </tr>
        <?php
         $sr++; }
           ?>
    </tbody>
</table>


<?php
      }

elseif($code==26.5)

   { 

    

    ?> <table class="table table-head-fixed text-nowrap">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Address</th>
                              <th>Organisation</th>

                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                        
    
                       
                      
   <?php 
          $sr=1;
                            $get_consultant="SELECT * FROM MasterConsultant  order by ID desc"; 

                     $get_consultant_run=sqlsrv_query($conntest,$get_consultant);
                     while($row=sqlsrv_fetch_array($get_consultant_run))
                     {

                      if($row['Status'] == 0) {
                           $color='red'; 
                        }
                        else
                        {
                          $color='';  
                        }
                 

                        ?>

                     <tr style="background-color: <?=$color;?>"><td><?= $sr++;?></td><td><?=$row['Name'];?> <b>(<?=$row['ID'];?>)</b></td><td><?=$row['Mobile'];?></td><td><?=$row['Address'];?></td>
                        <td><?=$row['Organisation'];?></td>
                        <!-- <td><?php echo ($row['Status'] == 1) ? 'Active' : 'Inactive'; ?></td> -->
                        <td><i class="fa fa-edit" onclick="edit_consultant(<?=$row['ID'];?>)" data-toggle="modal" data-target="#exampleModal"></i></td>
                    </tr>
                     
                     <?php }?>  </tbody>
                     </table>


<?php
      }
elseif($code==26.6)

   { 
    $id=$_POST['id'];

$get_consultant="SELECT * FROM MasterConsultant where  ID='$id'"; 

                     $get_consultant_run=sqlsrv_query($conntest,$get_consultant);
                     while($row=sqlsrv_fetch_array($get_consultant_run))
                     {?>
<div class="col-md-12    col-lg-12  col-sm-12   ">
            <div class="card card-info">
               
             
                  <div class="card-body">
                     <div class="form-group row">  
           <div class="col-lg-6">
                        <label >Name</label>
               
                  <input type="text" class="form-control" id="consultant_name" value="<?=$row['Name'];?>">
                   <input type="hidden" class="form-control" id="consultant_id" value="<?=$row['ID'];?>">
               </div>  <div class="col-lg-6">
                  <label>Mobile</label>

                   <input type="text" class="form-control" id="Mobile-e" value="<?=$row['Mobile'];?>">
                </div>
                <div class="col-lg-6">
                  
                   <label>Address</label>
                    <input type="text" class="form-control" id="address-e" value="<?=$row['Address'];?>">
                 </div> <div class="col-lg-6">
                    <label>Organisation</label>
                     <input type="text" class="form-control" id="organisation-e" value="<?=$row['Organisation'];?>">
                  </div>
                  </div> <div class="col-lg-6">
                       <label>Status</label>
                    <select class="form-control" id="status-e">
                          <option value='<?=$row['Status'];?>'><?php echo ($row['Status'] == 1) ? 'Active' : 'Inactive'; ?></option>
                        <option value='1'>Active</option>
                         <option value='0'>InActive</option>

                    </select>
                 
                     
                  </div>


                    
               </div>
              
            </div>

      </div>
                       
                         

         </div>
                     
                     <?php 

    


}
}
elseif($code==26.7)

   { 
      

    $id=$_POST['consultant_id'];
     $consultant_m=$_POST['consultant_m'];
      $consultant_a=$_POST['consultant_a'];
       $consultant_o=$_POST['consultant_o'];
        $status_e=$_POST['status_e'];
     


 $get_consultant="Update  MasterConsultant set Mobile='$consultant_m',Address='$consultant_a',Organisation='$consultant_o' ,Status='$status_e' where  ID='$id'"; 

 $get_consultant_run=sqlsrv_query($conntest,$get_consultant);
                    
echo 1;

}
elseif($code==26.8)

   { 
     $students=$_POST['students'];
     $attendance=$_POST['attendance'];
     $lecturenumber=$_POST['lecturenumber'];
     $subjectcode=$_POST['subjectcode'];
     $semester=$_POST['semester'];
     $section=$_POST['section'];
     $cgroup=$_POST['cgroup'];
     $examination=$_POST['examination'];
     $date=$_POST['date'];
     $batch=$_POST['batch'];

   // $values = array();
   
   // $values1 = array();
     //print_r($attendance);
   
   for($i=0;$i<5;$i++) { 

 $sql="SELECT * from StudentAttendance where IDNo='$students[$i]' AND SubjectCode='$subjectcode' AND LectureNumber='$lecturenumber' ANd Date='$date'";
         $stmt2 = sqlsrv_query($conntest,$sql);
          $stmt_c = sqlsrv_query($conntest,$sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
           $count=sqlsrv_num_rows($stmt_c);
           if($count>0)
           {
    while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
        {
   $DataID= $row1['ID']; 

 $update="Update StudentAttendance set Attendance='$attendance[$i]' where ID='$DataID'";
$stupdate = sqlsrv_query($conntest,$update); 
        }




   }
   else
   {

 $insersub= "INSERT INTO StudentAttendance(IDNo,LectureNumber,SubjectCode,Semester,Section,ClassGroup,Attendance,Date,CreatedDate,CreatedBy,Batch,Session)VALUES
           ('$students[$i]','$lecturenumber','$subjectcode','$semester','$section','$cgroup','$attendance[$i]','$date','$timeStampS','$EmployeeID','$batch','$examination')";

 $stmtinsert = sqlsrv_query($conntest,$insersub); 

   }

                  


}

echo 1;

}

elseif($code==26.9)
   {
$staff="SELECT *
 FROM Staff where DepartmentID!='81'";

 $stmt = sqlsrv_query($conntest,$staff);  
   while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
        {
    $name=$row_staff['Name'];
    $emp_id=$row_staff['IDNo'];
    $email=$row_staff['EmailID'];
    $phone=$row_staff['MobileNo'];
    $birth=$row_staff['DateOfBirth'];
    $gender=$row_staff['Gender'];
    $design=$row_staff['Designation'];
    $status=$row_staff['JobStatus'];
    $address=$row_staff['PermanentAddress'];
    $city='';
    $state='';
    $role_id='8';
       
 $Emp_CollegeID=$row_staff['CollegeId'];
if($Emp_CollegeID=='61')
{
    $dept_id=11;
        $institute_id=1;
}
else if ($Emp_CollegeID=='62')
{
$dept_id=21;
        $institute_id=11;
}
else if ($Emp_CollegeID=='63')
{
    $dept_id=12;
        $institute_id=2;
}

else if ($Emp_CollegeID=='64')
{
    $dept_id=13;
        $institute_id=3;
}
else if ($Emp_CollegeID=='65')
{
    $dept_id=17;
        $institute_id=7;
}
else if ($Emp_CollegeID=='66')
{
    $dept_id=14;
        $institute_id=4;
}
else if ($Emp_CollegeID=='67' ||$Emp_CollegeID=='69'||$Emp_CollegeID=='74')
{
    $dept_id=23;
        $institute_id=13;
}

else if ($Emp_CollegeID=='71')
{
    $dept_id=16;
        $institute_id=6;
}
else if ($Emp_CollegeID=='72')
{
    $dept_id=20;
        $institute_id=10;
}
else if ($Emp_CollegeID=='73')
{
    $dept_id=15;
        $institute_id=5;
}
else if ($Emp_CollegeID=='75')
{
    $dept_id=19;
        $institute_id=9;
}
else if ($Emp_CollegeID=='76')
{
    $dept_id=24;
        $institute_id=14;
}

  $password=$emp_id;
     
$check="SELECT  * from employee_master where emp_id='$emp_id'";
$checkdata=mysqli_query($conn_spoc,$check);
   if (mysqli_num_rows($checkdata)>0)
   {
$Updateqry="Update employee_master set institute_id='$institute_id', dept_id='$dept_id', name='$name', email='$email', phone='$phone', 
            designation='$design', sex='$gender', birthday='', address='$address',status_code='$status' where emp_id='$emp_id'";
            $Updateqryres=mysqli_query($conn_spoc,$Updateqry);

if($status!='1')
        {
           $sql = "delete from user_login_master where username='$emp_id'" ; 
            $intress=$conn_spoc->query($sql); 
        }
   }
else
    {
if($status!='1')
{
}
else
{
 $insertqry="INSERT INTO `employee_master`(`institute_id`, `dept_id`, `emp_id`,`new_emp_id`, `name`, `email`, `phone`, 
            `designation`, `sex`, `birthday`, `address`,`status_code`) VALUES 
            ('$institute_id','$dept_id','$emp_id','$emp_id','$name','$email','$phone','$design','$gender','','$address','1')";
            $insertres=mysqli_query($conn_spoc,$insertqry);

         if ($insertres) 
       {
        $checku="SELECT  * from user_login_master where username='$emp_id'";
$checkdatau=mysqli_query($conn_spoc,$checku);
   if (mysqli_num_rows($checkdatau)>0)
   {

   }else
   {

                $insertqryu="INSERT INTO `user_login_master`(`username`, `password`, `role_id`) VALUES ('$emp_id','$password','$role_id')";
            $insertresu=mysqli_query($conn_spoc,$insertqryu);  
            }            
           
       }
}



}
  
 
//while
   } 
    echo 1;
}

}