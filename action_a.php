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
;
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
        </table><?php 
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
    // print_r($aa);
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
}




}
    // print_r($aa);
    ?>
            </tbody>
        </table><?php 
          sqlsrv_close($conntest);

// }


// }