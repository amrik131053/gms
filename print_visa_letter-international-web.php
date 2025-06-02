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
        $courseStartDate=$row['StartDate'];
        $courseEndDate=$row['EndDate']; 
        $District = $row['District'];
            $months=$row['months'];
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
    <span><b style="text-align: right">Refrence No:GKU/IED/VL/2025/00<?=$id;?></b></span>
</span>
</div>
      <p style="font-size: 22px;text-align: center;"><u><b> Final Admission/Visa/Acceptance Letter</b></u></p>
      

      
        <span>Dear <strong><?= $name; ?></strong>,</span></br>
        <span>Congratulation on seeking your admission at Guru Kashi University,Bathinda,Punjab India. we are pleased to confirm the acceptance of your application as an international Student.

            

        
        <table style="font-size:15px;margin-top:10px;">
            <tr>
                <th>Program Name:</th>
                <td><?= $courseName; ?></td>
                
            </tr>
            <tr>
                <th>Duration of the Course:</th>
                <td><?= $Duration; ?> Years  <?php if($months>0){echo $months." Months"; } ;?></td>
                
            </tr>
            <tr>
                <th>Course Start Date</th>
              
                <td><?= $courseStartDate;?> </td>
             
              
              
            </tr>
            <tr>
                <th>Course End Date</th>
                
                <td> <?= $courseEndDate;?> </td>
             
              
              
            </tr>
            <tr>
                <th>Fee  Details</th>
               
                <td> $<?= $TutionFee+$HostelFee;?>  PER YEAR    + $400  ONE TIME CHARGES </td>
             
              
              
            </tr>
              <tr>
                <th>Passport Number</th>
                
                <td><?=$ID_Proof_No;?></td>
             
              
              
            </tr>
        </table>
    <p style="font-size:14;">   <b>Note : </b><i>You are required to pay full fee of first year before arrival & to start your course.</i></p>

<u style="font-size:14;"><b>List of documents that student has to bring along with him/her:</b></u>
 <p style="font-size:17px ;"> 
•   Original Admission and Offer letter.<br>
•   Copy of fee receipt issued by Guru Kashi University or consultant.<br>
•   General medical certificate & Yellow fever & Covid 19 vaccination certificate.<br>
•   Original academic documents of school/college.<br>
•   10 passport size photographs with white background and 6 months’ bank statement (PDF) for FRRO.<br></p>
<p style="font-size:17px ;"> 
The admission is offered on the initial scrutiny of application, however if the student is found ineligible after the complete examination of educational documents, then this offered admission will stand cancelled for the specific program. Hostel fee will be 60 USD per month during the foundation program (March to June). Medical Insurance is mandatory before or on arrival. Terms & conditions as mentioned in an offer letter & as per
 <b>Annexure-A</b> attached with this letter.
 <br>
<b>Disclaimer:</b><i> Guru Kashi University reserves the right to cancel admission at any stage, including after visa approval, if any discrepancies or false information are found. The university's decision shall be final and unchallengeable.</i>




  
     



      
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

<br><br><br><br>
        <hr>
        <div class="footer">
            <p>IED - International Education Division<br>
                Office No. 217, First Floor, Block B, GKU Campus, Sardulgarh Road, Talwandi Sabo, Punjab - 151302<br>
                IED Helpline: 7009396001 | Email: ieddiretor@gku.ac.in | Website: www.gku.ac.in</p>
        </div>
    </div>

<br>
<br><!-- <div class="logo-section">
                <img src="dist/img/logo-join.png" alt="Logo">
   
            </div> -->

            <div class="content" style="margin-left:10px;margin-right: 10px;">
                   <img src="dist/img/logo-join.png" alt="Logo" width="800px">
<p style="font-size: 15px;text-align: center;"><b>ANNEXURE-A</b></p>

<p style="font-size:18px">
<u>Terms and Conditions:</u><br>
<b>Admission Confirmation:</b><br>

•   Your admission will be confirmed only upon up on receipt of the initial deposit. Non-payment of the deposit by the specified deadline may result in the correct of your you admission offer.<br>
•   All required original documents (academic transcripts, certificates, passport copy, etc.) must be submitted to the IED-International Education Division at the time of registration.<br>
<b>Refund Policy</b><br>
•   In case of visa rejection 100% of the tuition fee (except the registration fee) will be refunded upon submission of the wise rejection letter from the Indian Embassy<br>
•   In other cases, refund will be processed based on the university's refund policy, which is available on our website or upon request.<br>
<b>Hostel and Accommodation:</b><br>

•   Accommodation is available on a first-come, first-served basis and must be reserved in advance<br>
•   The Hostel Accommodation Fee includes room rent, basic furniture reserved in advance and maintenance charges Electricity charges are not included in the Hostel accommodation fee. They are calculated based on actual monthly consumption and billed separately, to be paid on a monthly basis.<br>
•   Term Hostel Accommodation AC in the offer letter means refers to the availability and provision of air conditioning as part of the facility<br>
<b>Health Insurance:</b><br>

•   All international students required to have valid health insurance covering the duration of their stay in India. Proof of insurance must be submitted before the start of the program.<br>
<b>Visa Requirements:</b><br>

•   Students must possess a valid student visa study at Guru Kashi University it is your responsibility to ensure that your visa is obtained and renewed as required.<br>
•   The university's International Education Division will assist you with your Foreigners Regional Registration Office (FRRO)Registration upon arrival in India.<br>

<b>Academic Requirement:</b><br>

•   You must maintain a minimum attendance of 75% and adhere to all academic and disciplinary regulations set by the University.<br>
<b>Disciplinary Regulations:</b><br>

•   The university maintains a strict code of conduct and disciplinary regulations. Any violation of university rules code may result in penalties, including suspension or expulsion.<br>
<b>Exit and Travel Permissions:</b><br>

•   Students who wish to leave the campus for personal reasons must seek permission from the Hostel Warden at least 24 hours in advance and fill out the required forms....<br>
<b>Next Steps:</b> Confirm your admission by paying the initial deposit of USD 100 & full fee before your arrival.<br>

<b>Submit the following documents: </b>Copy of your valid passport | Academic transcripts and certificates | Proof of health insurance Visa copy (upon approval). <br>
Make travel arrangements and inform us of your (Arrival date by sharing your air tickets to arrange airport pickup via <b>WhatsApp app or call at +70093-96001 or send email at iedcoodinator@gku.ac.in</b><br>
<b>We are excited to welcome you to Guru Kashi University and took forward to your academic success. If you have any questions, please do not hesitate to contact the international Education Division at 70099-55998</b>

  <div class="signature-section" style="text-align: right; position: relative;">
    <div style="display: inline-block; position: relative;">
        <img src="dist/img/stamp-ied-colored.jpg" alt="Stamp" style="width: 100px; border: 0px solid;">
        <img src="dist/img/signdirector.png" alt="Signature" 
             style="position: absolute; top: 110%; left: 50%; transform: translate(-50%, -50%); width: 150px;">
    </div>
    <p style="margin-top: 20px; text-align: right;">Authorized Signature<br>
       IED - International Education Division</p>
</div>
        <hr>
        <div class="footer">
            <p>IED - International Education Division<br>
                Office No. 217, First Floor, Block B, GKU Campus, Sardulgarh Road, Talwandi Sabo, Punjab - 151302<br>
                IED Helpline: 7009396001 | Email: ieddiretor@gku.ac.in | Website: www.gku.ac.in</p>
        </div>
    </div>

</body>

</html>

<?php 
    } 
} 
?>