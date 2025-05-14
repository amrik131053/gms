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

             $TutionFee="0";
          $HostelFee="0";
          $RegistrationFee="0";
          $SecurityDeposit="0";
          $MessCharges="0";
          $otherCharges="0";
          $totalAnual="0";
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
        $pstartDate = DateTime::createFromFormat('Y-m-d', $pstartDate)->format('d-m-Y');
        $deadline=$row['deadline'];
        $Nationality=$row['Nationality'];
        $id=$row['id'];
        $ActualFee=$row['ActualFee'];

        $TutionFee=$row['TutionFee'];
        $HostelFee=$row['HostelFee'];
        $RegistrationFee=$row['RegistrationFee'];
       
        $SecurityDeposit=$row['SecurityDeposit'];
        $MessCharges=$row['MessCharges'];
        $otherCharges=$row['otherCharges'];
        $totalAnual=$row['totalAnual'];
         $get_coutry_name="SELECT name FROM countries where id='$Nationality'";
        $get_coutry_name_run=mysqli_query($conn,$get_coutry_name);
        if ($row_coutry_name=mysqli_fetch_array($get_coutry_name_run)) {
        
            $NationalityName=$row_coutry_name['name'];
             
        }
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

        // $fee_details="SELECT * FROM master_fee_international where Lateral='$Lateral' ANd course='$Course' ANd batch='$Batch' ";
        // $fee_details_run=mysqli_query($conn,$fee_details);
        // if ($row_fee=mysqli_fetch_array($fee_details_run))
        //  {
        //     $TutionFee=$row_fee['TutionFee'];
        //     $HostelFee=$row_fee['HostelFee'];
        //     $RegistrationFee=$row_fee['RegistrationFee'];
           
        //     $SecurityDeposit=$row_fee['SecurityDeposit'];
        //     $MessCharges=$row_fee['MessCharges'];
        //     $otherCharges=$row_fee['otherCharges'];
        //     $totalAnual=$row_fee['totalAnual'];
           
        //  }
        //  else
        //  {
        //   $fee_details1="SELECT * FROM master_fee_international where Lateral='$Lateral' ANd course='$Course' ANd batch='$Batch'";
        //   $fee_details1_run=mysqli_query($conn,$fee_details1);
        //   if($row_fee1=mysqli_fetch_array($fee_details1_run))
        //   {
        //       $TutionFee=$row_fee1['TutionFee'];
        //       $HostelFee=$row_fee1['HostelFee'];
        //       $RegistrationFee=$row_fee1['RegistrationFee'];
             
        //       $SecurityDeposit=$row_fee1['SecurityDeposit'];
        //       $MessCharges=$row_fee1['MessCharges'];
        //       $otherCharges=$row_fee1['otherCharges'];
        //       $totalAnual=$row_fee1['totalAnual'];
            
        //  }
        //  else
        //  {
        //   $TutionFee="0";
        //   $HostelFee="0";
        //   $RegistrationFee="0";
        //   $SecurityDeposit="0";
        //   $MessCharges="0";
        //   $otherCharges="0";
        //   $totalAnual="0";
       
        
        //  } 
        //  }
        
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

    table {
        width: 100%;
        border-color: black;
        color: black;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    tr {
        background-color: #f2f2f2;
        /* Light background for rows */
    }

    .header,
    .footer {
        text-align: center;
        margin-bottom: 20px;
    }

    .footer {
        margin-top: 20px;
        font-size: 14px;
    }

    .content {
        font-size: 16px;
        margin-bottom: 20px;
    }

    ul {
        margin: 0;
        padding-left: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    table th,
    table td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    .signature-section {
            /* margin-top: 40px; */
            text-align: right;
        }
        .signature-section img {
            max-width: 150px;
            display: block;
            /* margin-bottom: 5px; */
            float: right;
            
        }
        .signature-section p {
            font-size: 0.9em;
            margin: 0;
            
        }
   
    .page-break {
        page-break-after: always;
    }

    .important {
        font-size: 1.2em;
        font-weight: bold;
        color: red;
    }

    .note {
        font-style: italic;
        color: #555;
       
    }

    ul {
        margin-left: 20px;
    }

    li {
        margin-bottom: 10px;
    }

    .terms-conditions {
        margin-top: 20px;
        font-size: 14px;
    }

    @media print {
        body {
            margin: 0;
            font-size: 14px;
            line-height: 1.4;
        }

        .content {
            page-break-inside: avoid;
            /* margin-top: 200px; */
            padding:10px;

        }

        /* .footer {
                position: fixed;
                bottom: 10px;
                width: 100%;
            } */
        table {
            width: 100%;
            border-color: black;
            color: black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        tr {
            background-color: #f2f2f2;
            /* Light background for rows */
        }
    }
    .logo-section {
        text-align: center;
        margin-bottom: 10px; /* Reduced margin */
    }
    .logo-section img {
        width: 100%; /* Full width */
      
        height: 100px; /* Maintain aspect ratio */
        max-height: 150px; /* Constrain the height to avoid pushing content */
    }

    </style>
</head>

<body>
    
    <div class="content">
        <div class="logo-section">
                <img src="dist/img/logo-join.png" alt="Logo">
            </div>
            <div class="signature-section" style="text-align: right; position: relative;">
    <div style="display: inline-block; position: relative;">
        
    </div>
    <span style="margin-top: 10px; text-align: right;">
    <span><b style="text-align: right" >Date: <?= date('d-m-Y'); ?></b></span><br>
    <span><b style="text-align: right">Refrence No:GKU/IED/2025/00<?=$id;?></b></span>
</span>
</div>
      
        <span>To,<br>
            <strong><?= $name; ?></strong><br>
            <b>Father Name-</b> <?= $FatherName; ?><br>
           <b>Country-</b> <?= $NationalityName; ?>
        </span><br>

        <span><strong>Subject: Offer of Admission to Guru Kashi University (International Students)</strong></span><br>
        <span>Dear <strong><?= $name; ?></strong>,</span></br>
        <span>We are pleased to inform you that you have been <strong>conditionally</strong> offered admission to
            <strong>Guru Kashi University</strong> for the <strong><?= $courseName; ?></strong> commencing on
            <strong><?= $pstartDate; ?></strong> for the academic session <strong><?= $Session; ?></strong>. This offer
            is based on your fulfillment of the admission requirements and submission of all necessary documents.</span>

        <table>
            <tr style="background:black;color:white;margin-top:-10px;">
                <td>
                    <h6><b>Program Details:</b></h6>
                </td>
            </tr>
        </table>
        <table style="font-size:12px;margin-top:-10px;">
            <tr>
                <th>Program Name:</th>
                <td><?= $courseName; ?></td>
                <th>Level of Study:</th>
                <td> <?= $Type; ?></td>
            </tr>
            <tr>
                <th>Duration:</th>
                <td><?= $Duration; ?> Years</td>
                <th>Faculty/Department:</th>
                <td> <?= $department; ?></td>
            </tr>
            <tr>
                <th>Medium of Instruction:</th>
                <td>English</td>
                <th></th>
                <th></th>
              
              
            </tr>
        </table>
       

        <table style="margin-top:-10px;">
            <tr style="background:black;color:white;">
                <td>
                    <h6><b>Fee Structure:</b></h6>
                </td>
            </tr>
        </table>

        <table style="font-size:12px; margin-top:-10px;">
            <tr>
                <th colspan="2" style="text-align: center;width: 50%;"><b>One Time Charges</b></th>
                
                <th colspan="2" style="text-align: center;"><b>Fee Per Year</b></th>
                
            </tr>
            <tr>
               <th>Registration Fee </th>
                <td style="text-align: center;">$<?= $RegistrationFee; ?></td> 
               <th>Actual Fee</th>
               <td style="text-align: center;">$<?= $ActualFee; ?></td>
            </tr>
            <tr>
               <th>Misc. Charges</th>
                <td style="text-align: center;">$<?= $MessCharges; ?></td> 
                  <th>Application Fee as per package per year</th>
                     <td style="text-align: center;">$<?= $TutionFee; ?></td>
            </tr>
            <tr>
                 <th>Other Charges </th>
                <td style="text-align: center;">$<?= $otherCharges; ?></td>
                 <th>Hostel Accommodation Fee(AC)</th>
                <td style="text-align: center;">$<?= $HostelFee; ?></td>
            </tr>


            
             <tr>
                <th>Security Deposit</th>
                <td style="text-align: center;">$<?= $SecurityDeposit; ?></td>
         
                <th></th>
                 <th></th>
               
                
            </tr>
             <tr>
                <th>Total</th>
                <td style="text-align: center;"><b>$400</b></td>
         
                <th>Total Fee per year</th>
                 <th style="text-align: center;"> $<?= $TutionFee+$HostelFee;?></th>
                
            </tr>
            <tr>
               
                <td colspan="3" style="text-align:right;"><strong>Grand Total payable:</strong></td>
                <td style="text-align: center;"><strong >$<?= $totalAnual; ?></strong></td>
               
            </tr>
        </table>


        <!-- <h6><b></b></h6> -->
        <span class="note"  >Important: This is an Offer Letter only cannot be used to apply for a study visa.</span>

        <h6><b>Terms and Conditions for Final Admission:</b></h6>

        <h6 style="margin-top: -10px;margin-bottom: -1px;"><b>1. Admission Criteria:</b></h6>
        <span >
            Final admission will be granted only after the student meets the eligibility requirements set by the
            Government of Punjab and the Government of India. All necessary documents supporting the student’s
            eligibility must be submitted as part of the admission process.
        </span>

        <h6><b>2. Hostel Fees and Accommodation Options:</b></h6>
        <ul>
            <li style="margin-top:-10px;"><strong>Hostel fees:</strong> will apply during the foundation program.
                From the second year onwards, students choosing to live off-campus will receive a reduction in their fee
                package i.e. <b>$300 USD/year</b> for non-AC accommodation and <b>$500 USD/year</b> for AC accommodation.
               
            </li>
            <li style="margin-top:-10px;">
                <strong>Additional Charges:</strong> <b>Exam fees:</b> $50 USD per semester. <b>Electricity charges:</b> Calculated based on actual monthly consumption and billed separately.
               
            </li>
        </ul>

        <!-- <h6><b>3. Validity of Offer Letter:</b></h6> -->
        <span >
            <b >This offer letter is valid for 15 days from the date of issue.</b>
        </span><br>
        <!-- <table>
            <tr style="background:black;color:white;">
                <td>
                    <h6><b>Payment Details:</b></h6>
                </td>
            </tr>
        </table> -->
        <table style="font-size:12px; ">
            <b>Please use the following bank account details to transfer the fee:</b>
            <tr>
                <td><b>Bank Name</b>- HDFC BANK LTD</td>
                <td><b>Address</b>- Talwandi Sabo, Punjab-151302</td>
            </tr>
            <tr>
                <td><b>Account Name</b>- Guru Kashi University </td>
                <td><b>Account Number</b>- 50100033779951</td>
            </tr>
            <tr>
                <td><b>Swift Code</b>- HDFCINBB</td>
                <td><b>IFSC/MICR</b>-HDFC0001322/151240102</td>
            </tr>
        </table>
        <div class="signature-section" style="text-align: right; position: relative;">
    <div style="display: inline-block; position: relative;">
        <img src="dist/img/stamp-ied-colored.jpg" alt="Stamp" style="width: 120px; border: 0px solid;">
        <img src="dist/img/signdirector.png" alt="Signature" 
             style="position: absolute; top: 110%; left: 50%; transform: translate(-50%, -50%); width: 150px;">
    </div>
    <p style="margin-top: 20px; text-align: right;">Authorized Signature<br>
       IED - International Education Division</p>
</div>


        <hr>
        <div class="footer">
            <p>IED - International Education Division<br>
                Office No. 304, Second Floor, Block A, GKU Campus, Sardulgarh Road, Talwandi Sabo, Punjab - 151302<br>
                IED Helpline: 700 998 5 998 | Email: ied@gku.ac.in | Website: www.gku.ac.in</p>
        </div>
    </div>
</body>

</html>

<?php 
    } 
} 
?>