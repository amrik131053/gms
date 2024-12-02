
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Guru Kashi University</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <!-- ----------internet status ---------- -->
    <link rel="stylesheet" href="internet_status.css">
    <!-- ----------internet status end ---------- -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/css/jquery-ui.css">
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

    <link rel="stylesheet" href="plugins/fullcalendar/main.min.css">
    <link rel="stylesheet" href="plugins/fullcalendar-daygrid/main.min.css">
    <link rel="stylesheet" href="plugins/fullcalendar-timegrid/main.min.css">
    <link rel="stylesheet" href="plugins/fullcalendar-bootstrap/main.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

  /* Print styles */
  @media print {
            body {
                font-size: 16px;
                color: #000;
            }

            table {
                width: 100%;
                border-color: black;
                color: black;
            }

            th, td {
                padding: 8px;
                text-align: left;
            }

            tr {
                background-color: #f2f2f2; /* Light background for rows */
            }

            tr:nth-child(even) {
                background-color: #f9f9f9; /* Slightly different background for even rows */
            }

            /* Make sure headings remain bold */
            h5, h3, b {
                font-weight: bold;
                color: black;
            }

            .header, .footer {
                display: none;
            }
        }
    </style>
</head>
<?php
include "connection/connection.php";
$emp_id = $_GET['id'];

$emp_query = "SELECT Staff.*, MasterDepartment.Department as DepartmentName 
              FROM Staff 
              LEFT JOIN MasterDepartment ON Staff.DepartmentId = MasterDepartment.Id 
              WHERE IDNo = '$emp_id'";
$emp_result = sqlsrv_query($conntest, $emp_query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET));
if ($staff = sqlsrv_fetch_array($emp_result, SQLSRV_FETCH_ASSOC)) {
    $name = $staff['Name'];
    $fatherName = $staff['FatherName'];
    $motherName = $staff['MotherName'];
    $designation = $staff['Designation'];
    $dob = $staff['DateOfBirth']; 
    $gender = $staff['Gender'];
    $category = $staff['Category'];
    $panNumber = $staff['PANNo'];
    $personalEmail = $staff['EmailID'];
    $officialEmail = $staff['OfficialEmailID'];
    $mobileNumber = $staff['MobileNo'];
    $whatsappNumber = $staff['WhatsAppNumber'];
    $emergencyContactNumber = $staff['EmergencyContactNo'];
    $officialMobileNumber = $staff['OfficialMobileNo'];
    $addressLine1 = $staff['AddressLine1'];
    $addressLine2 = $staff['AddressLine2'];
    $PostalCode = $staff['PostalCode'];
    $permanentAddress = $staff['PermanentAddress'];
    $correspondenceAddress = $staff['CorrespondanceAddress'];
    $organisationID = $staff['CollegeId'];
    $organisationName = $staff['CollegeName'];
    $DepartmentID = $staff['Department'];
    $departmentName = $staff['DepartmentID']; 
    $joiningDate = $staff['DateOfJoining']; 
    $leavingDate = $staff['DateOfLeaving']; 
    $Nationality1 = $staff['Nationality'];
    $employmentType = $staff['Type'];
    $EmpCategory = $staff['CategoryId'];
    $AadhaarCard = $staff['AadhaarCard'];
    $get_defalut_category="SELECT Distinct CategoryId,CategoryFName FROM CategoriesEmp Where CategoryId='$EmpCategory' ";
    $get_defalut_category_run=sqlsrv_query($conntest,$get_defalut_category);
    if($row_cate=sqlsrv_fetch_array($get_defalut_category_run,SQLSRV_FETCH_ASSOC))
    {
                                                $EmpCategoryName=$row_cate['CategoryFName'];
    }
    $salary = $staff['SalaryAtPresent'];
    $employmentStatus = $staff['JobStatus'];
    $leaveRecommendingAuthority1 = $staff['LeaveRecommendingAuthority'];
    $leaveSanctionAuthority1 = $staff['LeaveSanctionAuthority'];
    $bankAccountNo = $staff['BankAccountNo'];
    $employeeBankName = $staff['BankName'];
    $bankIFSC = $staff['BankIFSC'];
    $shiftID = $staff['ShiftID'];
    $Emp_Image=$staff['Imagepath'];
                       

    $bloodGroup = $staff['BloodGroup'];
    $dob = $staff['DateOfBirth'] ? $staff['DateOfBirth']->format('d-m-Y') : null;
$joiningDate = $staff['DateOfJoining'] ? $staff['DateOfJoining']->format('d-m-Y') : null;
if($employmentStatus!=1)
{
$leavingDate = $staff['DateOfLeaving'] ? $staff['DateOfLeaving']->format('d-m-Y') : null;
}
else{
    $leavingDate="Working";
}
if($employmentStatus==1)
{
    $employmentStatus="Active";
}else{

    $employmentStatus="Left";
}
}

$get_college="SELECT  * FROM MasterCourseCodes where CollegeID='$organisationID' ";
$get_collegeRun=sqlsrv_query($conntest,$get_college);
if($get_collegeRow=sqlsrv_fetch_array($get_collegeRun,SQLSRV_FETCH_ASSOC))
                        { 
                          $organisationName=$get_collegeRow['CollegeName'];
                        }


$get_Department="SELECT  * FROM MasterDepartment where Id='$departmentName' ";
$get_DepartmentRun=sqlsrv_query($conntest,$get_Department);
if($get_DepartmentRow=sqlsrv_fetch_array($get_DepartmentRun,SQLSRV_FETCH_ASSOC))
                        { 
                          $DepartmentID=$get_DepartmentRow['Department'];
                     }
?>


<table class="">

<tr>
    <td colspan="4">
        <h5><center><b>GURU  KASHI UNIVERSITY</b></center></h5>
        <h5><center><b>Employee Details</b></center></h5>

    </td>
</tr>

<tr style="background:#c0bab9; ">
    <td colspan="4">
        <h5><b>Basic Information</b></h5>

    </td>
</tr>
<tr>
    <td><b>Emp ID:</b> <?=$emp_id;?></td>
    <td><b>Name:</b> <?=$name;?></td>
    <td><b>Father Name:</b> <?=$fatherName;?></td>
    <td rowspan="4">
<?php  echo  "<center><img  src='".$BasURL.'Images/Staff/'.$Emp_Image."' width='170' height='200' alt='message user image'></center>";?>
    </td>
</tr>
<tr>
    <td><b>Mother Name:</b> <?=$motherName;?></td>
    <td><b>Date of Birth:</b> <?=$dob;?></td>
    <td><b>Gender:</b> <?=$gender;?></td>
  
</tr>
<tr>
    <td><b>Category:</b> <?=$category;?></td>
    <td><b>Blood Group:</b> <?=$bloodGroup;?></td>
    <td><b>PAN No:</b> <?=$panNumber;?></td>
   
</tr>
<tr>
    <td colspan="2"><b>Aadhar No:</b> <?=$AadhaarCard;?></td>
    <td><b>Nationality:</b> <?=$Nationality1;?></td>
    
</tr>
<tr style="background:#c0bab9; ">
    <td colspan="4">
        <h5><b>Contact Information</b></h5>

    </td>
</tr>

<tr>
    <td><b>Personal Email ID:</b> <?=$personalEmail;?></td>
    <td><b>Official Email ID:</b> <?=$officialEmail;?></td>
    <td><b>Mobile No:</b> <?=$mobileNumber;?></td>
    <td><b>WhatsApp No:</b> <?=$whatsappNumber;?></td>
</tr>
<tr>
    <td colspan="2"><b>Permanent Address:</b> <?=$permanentAddress;?></td>
    <td colspan="2"><b>Correspondence Address:</b> <?=$correspondenceAddress;?></td>
</tr>
<tr style="background:#c0bab9; ">
    <td colspan="4">
        <h5><b>Employment Information</b></h5>

    </td>
</tr>
<tr>
    <td><b>College Name:</b> <?=$organisationName;?></td>
    <td><b>Department Name:</b> <?=$DepartmentID;?></td>
    <td><b>Designaion:</b> <?=$designation;?></td>
    <td><b>Date of Joining:</b> <?=$joiningDate;?></td>
</tr>
<tr>
    <td><b>Date of Leaving:</b> <?=$leavingDate;?></td>
    <td><b>Employment Type:</b> <?=$employmentType;?></td>
    <td><b>Emp Category:</b> <?=$EmpCategoryName;?></td>
    <td><b>Salary:</b> <?=$salary;?></td>
</tr>
<tr>
    <!-- <td><b>Leave Recommending Authority:</b> <?=$leaveRecommendingAuthority1;?></td>
    <td><b>Leave Sanction Authority:</b> <?=$leaveSanctionAuthority1;?></td> -->
</tr>
<tr>
    <td><b>Job Status:</b> <?=$employmentStatus;?></td>
    <td><b>Bank Account No:</b> <?=$bankAccountNo;?></td>
    <td><b>Bank Name:</b> <?=$employeeBankName;?></td>
    <td><b>Bank IFSC:</b> <?=$bankIFSC;?></td>
</tr>


</div>

<table class="table">
    <!-- Academic Details -->
    <?php
    $sql = "SELECT * FROM StaffAcademicDetails 
            INNER JOIN MasterQualification 
            ON StaffAcademicDetails.StandardType = MasterQualification.ID 
            WHERE StaffAcademicDetails.UserName = $emp_id";

    if ($data = sqlsrv_fetch_array(sqlsrv_query($conntest, $sql))) {
    ?>
    <br>
        <table  style="font-size:14px; ">
        <tr style="background:#c0bab9; ">
    <td colspan="9">
        <h5><b>Academic Details</b></h5>

    </td>
</tr>
            <tr style="background:#c0bab9; ">
                <th>Qualification</th>
                <th>Course</th>
                <th>Mode</th>
                <th>School / College</th>
                <th>University / Board</th>
                <th>Date of Passing</th>
                <th>Obtained</th>
                <th>Total</th>
                <th>CGPA / %</th>
                
            </tr>
            <tbody>
                <?php
                $res = sqlsrv_query($conntest, $sql);
                while ($data = sqlsrv_fetch_array($res)) { ?>
                    <tr>
                        <td><?= $data['QualificationName']; ?></td>
                        <td><?= $data['Course']; ?></td>
                        <td><?= $data['Type']; ?></td>
                        <td><?= $data['University']; ?></td>
                        <td><?= $data['Institute']; ?></td>
                        <td><?= $data['YearofPassing'] ? $data['YearofPassing']->format('d-m-Y') : ""; ?></td>
                        <td><?= $data['ObtainedMarls']; ?></td>
                        <td><?= $data['TotalMarks']; ?></td>
                        <td><?= $data['Percentage']; ?></td>
                       
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</table>

<table class="table">
    <!-- PHD Details -->
    <?php
    $sql1 = "SELECT * FROM PHDacademic WHERE UserName = $emp_id";
    if ($data1 = sqlsrv_fetch_array(sqlsrv_query($conntest, $sql1))) {
    ?>
        
        <table  style="font-size:14px; ">
        <tr style="background:#c0bab9; ">
    <td colspan="15">
        <h5><b>PHD Details</b></h5>

    </td>
</tr>
            <tr style="background:#c0bab9; ">
                <th>SrNo</th>
                <th>University</th>
                <th>Topic of Research</th>
                <th>Name of Supervisor</th>
                <th>Date of Enrollment</th>
                <th>Date of Registration</th>
                <th>Date of Degree</th>
                <th>Subject</th>
                <th>Supervisor Details</th>
                <th>Course Work Details</th>
                <th>Course Work University</th>
                <th>Total Marks</th>
                <th>Obtained Marks</th>
                <th>Date of Passing</th>
                <th>Percentage</th>
                
            </tr>
            <tbody>
                <?php
                $res = sqlsrv_query($conntest, $sql1);
                $SrNo = 1;
                while ($data1 = sqlsrv_fetch_array($res)) { ?>
                    <tr>
                        <td><?= $SrNo++; ?></td>
                        <td><?= $data1['University']; ?></td>
                        <td><?= $data1['TopicofResearch']; ?></td>
                        <td><?= $data1['NameofSupervisor']; ?></td>
                        <td><?= $data1['DateofEnrollment']; ?></td>
                        <td><?= $data1['DateofRegistration']; ?></td>
                        <td><?= $data1['DateofDegree']; ?></td>
                        <td><?= $data1['Subject']; ?></td>
                        <td><?= $data1['SupervisorDetails']; ?></td>
                        <td><?= $data1['CourseWorkDetails']; ?></td>
                        <td><?= $data1['CourseWorkUniversity']; ?></td>
                        <td><?= $data1['TotalMarks']; ?></td>
                        <td><?= $data1['ObtainedMarks']; ?></td>
                        <td><?= $data1['DateofPassing']; ?></td>
                        <td><?= $data1['Percentage']; ?></td>
                       
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</table>

<table class="table">
    <!-- Experience Details -->
    <?php
    $sql = "SELECT * FROM StaffExperienceDetails WHERE UserName = $emp_id";
    if ($data = sqlsrv_fetch_array(sqlsrv_query($conntest, $sql))) {
    ?>
       
        <table  style="font-size:14px; ">
        <tr style="background:#c0bab9; ">
    <td colspan="8">
        <h5 ><b>Experience Details</b></h5>

    </td>
</tr>
            <tr style="background:#c0bab9; ">
                <th>Experience Type</th>
                <th>Designation</th>
                <th>Department / Organization</th>
                <th>Date of Joining</th>
                <th>Date of Leaving</th>
                <th>Total Experience</th>
                <th>Salary</th>
                <th>Reason for Leaving</th>
              
            </tr>
            <tbody>
                <?php
                $res = sqlsrv_query($conntest, $sql);
                while ($data = sqlsrv_fetch_array($res)) { ?>
                    <tr>
                        <td><?= $data['ExperienceType']; ?></td>
                        <td><?= $data['Designation']; ?></td>
                        <td><?= $data['NameofOrganisation']; ?></td>
                        <td><?= $data['DateofAppointment'] ? $data['DateofAppointment']->format('d-m-Y') : ""; ?></td>
                        <td><?= $data['DateofLeaving'] ? $data['DateofLeaving']->format('d-m-Y') : ""; ?></td>
                        <td><?= $data['TimePeriod']; ?></td>
                        <td><?= $data['PayScaleORConsolidated']; ?></td>
                        <td><?= $data['Reason']; ?></td>
                       
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</table>
<table class="table">
    <!-- Experience Details -->
    <?php
    $sql = "SELECT * FROM AdditionalResponsibilities WHERE IDNo = $emp_id";
    if ($data = sqlsrv_fetch_array(sqlsrv_query($conntest, $sql))) {

        $get_college="SELECT  * FROM MasterCourseCodes where CollegeID='".$data['CollegeID']."' ";
$get_collegeRun=sqlsrv_query($conntest,$get_college);
if($get_collegeRow=sqlsrv_fetch_array($get_collegeRun,SQLSRV_FETCH_ASSOC))
                        { 
                          $CollegeName=$get_collegeRow['CollegeName'];
                        }


$get_Department="SELECT  * FROM MasterDepartment where Id=".$data['DepartmentID']." ";
$get_DepartmentRun=sqlsrv_query($conntest,$get_Department);
if($get_DepartmentRow=sqlsrv_fetch_array($get_DepartmentRun,SQLSRV_FETCH_ASSOC))
                        { 
                          $DepartmentName=$get_DepartmentRow['Department'];
                     }
    ?>
       
        <table  style="font-size:14px; ">
        <tr style="background:#c0bab9; ">
    <td colspan="8">
        <h5 ><b>Additional Duty Details</b></h5>

    </td>
</tr>
            <tr style="background:#c0bab9; ">
            <th>CollegeID</th>
      <th>DepartmentID</th>
      <th>Designation</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Ramrks</th>
            </tr>
            <tbody>
                <?php
                $res = sqlsrv_query($conntest, $sql);
                while ($data = sqlsrv_fetch_array($res)) { ?>
                    <tr>
                   <td><?=$CollegeName;?></td>
     <td><?=$DepartmentName;?></td>
     <td><?=$data['Designation'];?></td>
     <td><?=$data['JoiningDate']? $data['JoiningDate']->format('d-m-Y') : ""; ?></td>
     <td><?=$data['RelievingDate']? $data['RelievingDate']->format('d-m-Y') : "Working"; ?></td>
     <td><?=$data['Ramrks'];?></td>
                       
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</table>

<br>
<br>
<p style="float:left;">Print on <?php echo date('d-M-Y h:i:s A');?></p>
<p style="float:right;">Signature <br><?=$name;?>(<?=$emp_id;?>)</p>

                </table>