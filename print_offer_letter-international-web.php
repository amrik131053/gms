<?php 
session_start();
$EmployeeID = $_SESSION['usr'];
include "connection/connection.php";
date_default_timezone_set("Asia/Calcutta");

$sel = $_GET['id_array'];
$id = explode(",", $sel);

foreach ($id as $key => $value) {
    $get_student_details = "SELECT * FROM offer_latter_international WHERE id='$value' AND generate=1";
    $get_student_details_run = mysqli_query($conn, $get_student_details);

    if ($row = mysqli_fetch_array($get_student_details_run)) {
        $name = $row['Name'];
        $FatherName = $row['FatherName'];
        $dob = $row['DOB'];
        $Course = $row['Course'];
        $Gender = $row['Gender'];
        $Class_RollNo = $row['Class_RollNo'];
        $District = $row['District'];
        $State = $row['State'];
        $Session = $row['Session'];
        $PrintDate = $row['PrintDate'];
        $PrintDatew = $row['PrintDate'];
        $Batch = $row['Batch'];
        $RefNo = $row['RefNo'];
        $Duration=$row['Duration'];
        $CollegeName=$row['CollegeName'];
        $Department=$row['Department'];
        $ID_Proof_No=$row['ID_Proof_No'];
        $Consultant_id=$row['Consultant_id'];
        $pstartDate=$row['pstartDate'];
        $deadline=$row['deadline'];

         $get_course_name="SELECT Course,CourseType FROM MasterCourseCodes where CourseID='$Course'";
        $get_course_name_run=sqlsrv_query($conntest,$get_course_name);
        if ($row_course_name=sqlsrv_fetch_array($get_course_name_run)) {
        
            $courseName=$row_course_name['Course'];
             $Type=$row_course_name['CourseType'];
        }

        
  $Duration_leet=$row['Duration'];

  $Lateral=$row['Lateral'];
  if($Lateral=='Yes')
  {
    $Duration_leet=$Duration_leet-1;
    $Leet_Duration="".$Duration_leet." Years Lateral Entry)";
  }
  else
  {
    $Leet_Duration=$Duration." Years)";
  }
         $getCollege="SELECT Distinct Department FROM MasterCourseCodes inner join MasterDepartment ON MasterDepartment.DepartmentID=MasterCourseCodes.DepartmentId
where MasterDepartment.Id='$Department' ";
        $getCollege_run=sqlsrv_query($conntest,$getCollege);
        if ($rowCollege=sqlsrv_fetch_array($getCollege_run)) {
        
            // $collegeName=$rowCollege['CollegeName'];
            $department=$rowCollege['Department'];
        }

        $fee_details="SELECT * FROM master_fee_international where Lateral='$Lateral' ANd course='$Course' ANd batch='$Batch' ";
        $fee_details_run=mysqli_query($conn,$fee_details);
        if ($row_fee=mysqli_fetch_array($fee_details_run))
         {
            $TutionFee=$row_fee['TutionFee'];
            $HostelFee=$row_fee['HostelFee'];
            $RegistrationFee=$row_fee['RegistrationFee'];
           
            $SecurityDeposit=$row_fee['SecurityDeposit'];
            $MessCharges=$row_fee['MessCharges'];
            $otherCharges=$row_fee['otherCharges'];
            $totalAnual=$row_fee['totalAnual'];
           
         }
         else
         {
          $fee_details1="SELECT * FROM master_fee_international where Lateral='$Lateral' ANd course='$Course' ANd batch='$Batch'";
          $fee_details1_run=mysqli_query($conn,$fee_details1);
          if($row_fee1=mysqli_fetch_array($fee_details1_run))
          {
              $TutionFee=$row_fee1['TutionFee'];
              $HostelFee=$row_fee1['HostelFee'];
              $RegistrationFee=$row_fee1['RegistrationFee'];
             
              $SecurityDeposit=$row_fee1['SecurityDeposit'];
              $MessCharges=$row_fee1['MessCharges'];
              $otherCharges=$row_fee1['otherCharges'];
              $totalAnual=$row_fee1['totalAnual'];
            
         }
         else
         {
          $TutionFee="0";
          $HostelFee="0";
          $RegistrationFee="0";
          $SecurityDeposit="0";
          $MessCharges="0";
          $otherCharges="0";
          $totalAnual="0";
       
        
         } 
         }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>International Visa Support Letter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
        }
        .header, .footer {
            text-align: left;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 40px;
        }
        .content {
            margin-bottom: 20px;
        }
        .signature-section {
            margin-top: 40px;
        }
        .enclosures {
            margin-top: 20px;
        }
        /* CSS for page break after each letter */
        @media print {
            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <div class="content">
        <p>Date: <?php echo date('d-m-Y'); ?></p>

        <p>To,<br>
        ___________________________<br>
        ___________________________</p>

        <p><strong>Subject: Offer of Admission to Guru Kashi University (International Students)</strong></p>

        <p>Dear <strong><?php echo $name; ?></strong>,</p>
        We are pleased to inform you that you have been <strong>conditionally</strong> offered admission to
        <strong>Guru Kashi University</strong> for the <strong><?php echo $courseName; ?></strong> commencing on <strong><?php echo $pstartDate;?></strong> for the
          academic session <strong><?php echo $Session;?></strong>. This offer is based on your fulfillment of the 
          admission requirements and submission of all necessary documents as outlined below. 
          <br></br>
          <hr>
        <h5><u>Program Details:</u></h5>
        <ul>
       <li><b>Program Name:</b> <?php echo $courseName; ?></li>
       <li><b>Level of Study: </b> <?=$Type;?></li>
       <li><b>Duration:</b><?=$Duration;?></li>
       <li><b>Faculty/Department:</b><?php echo $department;?></li>
       <li><b>Medium of Instruction: English</b></li>
        </ul>
<hr>
        <h5><u>Fee Structure:</u></h5>
        <p> Below is a detailed breakdown of the fees for your program:  </p>
        <table>
            <tr><td>Category</td><td>Fee(INR)</td></tr>
    <tr>
    <td>Tuition Fee (Per Year) </td><td>&nbsp; &#x20b9;<?php echo $TutionFee;?></td>
    </tr>
    <tr> 
                                  
        <td>Registration Fee</td><td>&nbsp; &#x20b9;<?php echo $RegistrationFee;?></td>
        </tr>
        <tr>  
        <td>Hostel Accommodation Fee</td><td>&nbsp; &#x20b9;<?php echo $HostelFee;?></td>
        </tr>
        <tr>  
        <td>Security Deposit</td><td>&nbsp; &#x20b9;<?php echo $SecurityDeposit;?></td>
        </tr>
        <tr>  
        <td>Mess Charges</td><td>&nbsp; &#x20b9;<?php echo $MessCharges;?></td>
        </tr>
        <tr>  
        <td>Other Academic Charges</td><td>&nbsp; &#x20b9;<?php echo $otherCharges;?></td>
        </tr>
        <tr>  
        <td>Total Annual Fee</td><td>&nbsp; &#x20b9;<?php echo $totalAnual;?></td>
    </tr>
        </table>                              
Note: All fees are quoted in Indian Rupees (INR) and are subject to change as per university policies. 

 




    <div class="enclosures">
        <h5><u>Payment Schedule:</u></h5>
        1.	Initial Deposit: 50% of the total fee must be paid before <b><?php echo $deadline;?></b> to confirm your admission.<br>
        2.	Balance Payment: The remaining 50% must be paid within 45 days of the start of the academic year. <br><br>
       
        <table class="table table-bordered" style="border:1px solid black">
        <b>Please use the following bank account details to transfer the fee:</b>
            <tr><td><b>Bank Name</b>- HDFC BANK LTD</td><td><b>Address</b>- Talwandi Sabo, Punjab-151302</td></tr>
            <tr><td><b>Account Name</b>- Guru Kashi University </td><td><b>Account Number</b>- 50100033779951</td></tr>
            <tr><td><b>Swift Code</b>- HDFCINBB</td><td><b>IFSC/MICR</b>-HDFC0001322/151240102</td></tr>
        </table>
    </div>

    <!-- Add page break after each letter -->
    <div class="page-break"></div>

    <h5><u> Terms and Conditions:</u></h5>

   <h6><b>Admission Confirmation</b>   </h6>

<ul> <li>Your admission will be confirmed only upon the receipt of the initial deposit. Non-payment of the deposit by the specified deadline may result in the cancelation in of of your you admission offer</li>
<li>  All required original documents (academic transcripts, certificates, passport copy, etc.) must be submitted to the International Education Division at the time of registration</li>
</ul>

<h6><b>Refund Policy: </b> </h6>
<li> In the case of visa rejection 100% of the tuition fee (except the registration fee) will be refunded upon submission of the wise rejection letter from the Indian Embassy.</li>
<li> In other cases refund will be processed based on the university's refund policy, which is available on our website .</li>

<h6><b>Hostel and Accommodation</b></h6>
   <li>Accommodation is available on a a first-come, first-served basis and must be reserved in advance.</li>
   <li>The Hostel Accommodation Fee includes room rent, basic basic furniture reserved in advance and maintenance charges</li>
   <li>The student cannot leave the allocated hostel accommodation before completing one year. After one year, he/she can choose other options</li>
   <li>Electricity charges will be billed separately based on actual consumption and must be paid monthly</li>

<h6><b>Health Insurance:</b></h6>
   <li>All international students are required to have a valid health insurance covering the duration of their  stay in India
   Proof of insurance must be submitted before the start of the program</li>

<h6><b>Visa Requirements:</b></h6>
<li> Students must possess a vaid student visas study at Guru Kashi University it is your responsibility to ensure that your visa is obtained and renewed as required.</li>
<li>  The university's IED- International Education Division will assist you with your Foreigners Regional Registration Office (FRRO registration upon your arrival in india.</li>

<h6><b>Academic Requirement</b></h6>
<li>You must be maintaining a minimum attendance of 75% and adhere to all academic and disciplinary regulations set by the university.</li>

<h6><b>Disciplinary Regulations </b></h6>
<li>The university maintains strict code e of conduct and disciplinary regulations. Any violation of university rules may result in penalties, including suspension or expulsion</li>

<h6><b>Exlt and Travel Permissions:</b></h6>
<li>Students who wish to leave the campus for personal reasons must seek permission from the International Education Division at least 48 hours in advance fit out the required forms. advance and fit</li>


<h6><b>Next Steps:</b></h6>
1)Confirm your admission by paying the initial deposit of Amount within 7days<br>

2) Submit the following documents
 <ul> <li> Copy of your valid passport</li>
  <li> Academic transcripts and certificates</li>
   <li>Proof of health insurance Visa copy (upon approval)</li></ul>
3. Make travel arrangements and inform us of your arrival date to arrange airport pickup at iedcoordinator@gku.ac.in or<b> 700 998 5 998</b>
<br>
<br>
We are excited to welcome you to Guru Kashi University and took forward to your academic success. If you have any questions, please do not hesitate to contact the international Education Division at IED helpline <b>700 998 5 998</b><br><br>

Best regards<br>
IED-International Education Division<br>
Guru Kashi University


</body>
</html>
<?php 
    } 
} 
?>
