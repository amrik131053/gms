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
        $code =$_POST['flag'];
      //   if($code==168)
      //   {
      //       include "connection/ftp.php";
      //   }
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
    <li class="nav-item " onclick="show_emp_all_qualification(8);">
        <a href="#" class="nav-link">
            <i class="fas fa-inbox"></i>PHD
            <span class="badge bg-primary float-right"><?=$emp_coun1t;?></span>
        </a>
    </li>
    <?php 
      
      //      print_r($category);
      }
      elseif ($code==6) {
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
                                            <label> File(Latter)</label>
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

<?php 
      }
      if ($code == 7) {
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
            $ShiftID = $employee_details_row['ShiftID'];
            $salary = $employee_details_row['SalaryAtPresent'];
            $from_date = $employee_details_row['DateOfJoining']->format('Y-m-d');
            $to_date = $joiningDate;
    
            // Calculate total experience
            $doa = $employee_details_row['DateOfJoining']->format('Y-m-d');
            $dor = $joiningDate;
            $ts1 = strtotime($doa);
            $ts2 = strtotime($dor);
            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);
            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);
    
            if ($month1 > $month2) {
                $month2 += 12;
                $year2 -= 1;
            }
            $exp_total = ($year1 <= $year2) 
                ? ($year2 - $year1) . " Year " . ($month2 - $month1) . " Month" 
                : "0";
    
            $left_reason = "Promotion";
        }
    
        // Fetch category details
        $get_category = "SELECT DISTINCT CategoryId, CategoryFName FROM CategoriesEmp WHERE CategoryId = '$EmpCategory'";
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
        $get_Department = "SELECT * FROM MasterDepartment WHERE Id = '$DepartmentID'";
        $get_DepartmentRun = sqlsrv_query($conntest, $get_Department);
        if ($get_DepartmentRow = sqlsrv_fetch_array($get_DepartmentRun, SQLSRV_FETCH_ASSOC)) {
            $departmentName = $get_DepartmentRow['Department'];
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
    
                // FTP upload
                $destdir = '/Images/Staff/ExperienceDocument';
                ftp_chdir($conn_id, $destdir) or die("Could not change directory");
                ftp_pasv($conn_id, true);
                ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
                ftp_close($conn_id);
    
                // Update staff details
                $query = "UPDATE Staff SET Designation = '$designationEmp',CollegeId = '$organisationID', CollegeName = '$organisationName',Department = '$departmentName',DepartmentID = '$DepartmentID',DateOfJoining = '$joiningDate',Type = '$employmentType',CategoryId = '$EmpCategory',SalaryAtPresent = '$salaryNew',LeaveRecommendingAuthority = '$leaveRecommendingAuthority1',LeaveSanctionAuthority = '$leaveSanctionAuthority1',ShiftID = '$shiftID',RoleID = '0'WHERE IDNo = '$employeeID'";
                $result = sqlsrv_query($conntest, $query);
                // Logging and additional updates
                $escapedQuery1 = str_replace("'", "''", $query);
                $update1 = "INSERT INTO logbook(userid, remarks, updatedby, date) 
                            VALUES('$employeeID', '$escapedQuery1', '$EmployeeID', '$timeStamp')";
                sqlsrv_query($conntest,$update1);
                if ($result) {
                    echo "1";
                    // Check and update leave authority if applicable
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
                    // Insert into StaffExperienceDetails
                    $insertExp = "INSERT INTO StaffExperienceDetails(ExperienceType, NameofOrganisation, DateofAppointment, DateofLeaving,TimePeriod, Status, UserName, DocumentPath, Reason, Designation,PayScaleORConsolidated, upddate) VALUES('$experienceType','$departmentName','$from_date','$to_date','$exp_total','0','$employeeID', '$file_name', '$left_reason', '$designation', '$salary', '$timeStamp')";
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
     $insertBLance="INSERT into LeaveRecord (LeaveDate,EmployeeID,LeaveTypeID,Balance,AddedBy,AddedDate)Values('$AgainstDate','$leaveEmplID','2','$AddBlance','$EmployeeID','$timeStamp')";
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


           $query1 = "SELECT  Distinct CollegeID  FROM MasterCourseCodes WHERE  CourseID='$course'";
        $getCourseRun1=sqlsrv_query($conntest,$query1);
                                 if($rowCourseName = sqlsrv_fetch_array($getCourseRun1, SQLSRV_FETCH_ASSOC))
                                 { 
                                 $CollegeID=$rowCourseName['CollegeID'];
                                 }


 $queryday = "SELECT  *  FROM TimeTable WHERE  Day='$day' AND LectureNumber='$lecture' AND IDNo='$EmployeeID'";
        $querydayrun=sqlsrv_query($conntest,$queryday);
                                 if($querydayrunrow = sqlsrv_fetch_array($querydayrun, SQLSRV_FETCH_ASSOC))
                                 { 
                                echo "2";
                                 }
                                 else
                                 {

$update1 = "INSERT INTO TimeTable(CollegeID,CourseID,Batch,SemesterID,LectureNumber, IDNo,Day,SubjectCode,Examination,CreatedDate,Section,GroupName) 
            VALUES('$CollegeID','$course', '$batch', '$semester','$lecture','$EmployeeID','$day','$subject','$CurrentExamination','$timeStamp','$section','$group')";
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
     $updateSection="SELECT * FROM CouponRecord ";
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
   }