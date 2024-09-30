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
        $ID_Proof_No=$row['ID_Proof_No'];
         $get_course_name="SELECT Course,CourseType FROM MasterCourseCodes where CourseID='$Course'";
        $get_course_name_run=sqlsrv_query($conntest,$get_course_name);
        if ($row_course_name=sqlsrv_fetch_array($get_course_name_run)) {
        
            $courseName=$row_course_name['Course'];
             $Type=$row_course_name['CourseType'];
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
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

    <div class="header">
        <p>International Education Division</p>
        <p>Guru Kashi University</p>
        <p>Sardoolgarh Road, Talwandi Sabo</p>
        <p>Contact Number: [University Contact Number]</p>
        <p>Website: <a href="https://www.gku.ac.in" target="_blank">www.gku.ac.in</a></p>
        <p>Email: <a href="mailto:ieddirector@gku.ac.in">ieddirector@gku.ac.in</a></p>
        <hr>
    </div>

    <div class="content">
        <p>Date: <?php echo date('d-m-Y'); ?></p>

        <p>To,<br>
        The Visa Officer,<br>
        ___________________________<br>
        ___________________________</p>

        <p><strong>Subject: Visa Application Support and Acceptance of Admission for <?php echo $name; ?></strong></p>

        <p>Dear Sir/Madam,</p>

        <p>We are pleased to inform you that <strong style="color:red;"><?php echo $name; ?></strong style="color:red;">, holder of passport number <strong style="color:red;"><?=$ID_Proof_No;?></strong>, has been offered admission to <strong style="color:red;">Guru Kashi University</strong> in the program <strong style="color:red;"><?php echo $courseName; ?></strong> commencing from <strong style="color:red;">[Program Start Date]</strong> for the academic session <strong style="color:red;"><?php echo $Session; ?></strong>.</p>

        <h4>Program Details:</h4>
        <ul>
            <li><b>Program Name:</b> <?php echo $courseName; ?></li>
            <li><b>Level of Study:</b> <?=$Type;?></li>
            <li><b>Program Duration:</b><?=$Duration;?></li>
            <li><b>Start Date:</b></li>
            <li><b>End Date (Expected):</b></li>
        </ul>

        <h4>University Information:</h4>
        <ul>
            <li><b>University Name:</b> Guru Kashi University</li>
            <li><b>University Address:</b> Sardoolgarh Road, Talwandi Sabo, Punjab India-151302</li>
            <li><b>University Contact Number:</b></li>
            <li><b>Website:</b> <a href="https://www.gku.ac.in" target="_blank">www.gku.ac.in</a></li>
            <li><b>International Education Division Contact:</b> 700 998 5 998</li>
            <li><b>Email:</b> <a href="mailto:ieddirector@gku.ac.in">ieddirector@gku.ac.in</a></li>
        </ul>

        <p>Guru Kashi University is a recognized institution by the <b>University Grants Commission (UGC)</b> and is accredited with an <b>NAAC A++</b> rating. The university has been a preferred destination for international students from over 25 countries, including Asia and Africa, for its world-class education and state-of-the-art facilities.</p>

        <h4>Student's Commitment:</h4>
        <p><strong><?php echo $name; ?></strong> has accepted the offer and is in the process of completing all admission formalities, including the payment of fees and submission of documents. The university provides comprehensive support, including assistance with visa formalities, accommodation, and Foreigners Regional Registration Office (FRRO) registration upon the student's arrival in India.</p>
        <p>The student will be residing in university accommodation located on campus, which includes meals, security, and basic services. In addition, Guru Kashi University provides full support for academic guidance and cultural orientation.</p>

        <h4>Purpose of Visa:</h4>
        <p>The purpose of this letter is to support <strong><?php echo $name; ?></strong> in obtaining a student visa for the duration of their studies at Guru Kashi University. The student visa is essential for their enrollment and successful completion of the academic program.</p>

        <h4>Declaration:</h4>
        <p>We confirm that Guru Kashi University has offered admission to <strong><?php echo $name; ?></strong> and that the university will provide all necessary support to the student during their stay in India. Kindly grant the necessary student visa to <strong><?php echo $name; ?></strong> for the duration of their studies.</p>
        <p>Please feel free to contact us for any further information or verification regarding this admission. We appreciate your support and cooperation in processing the student visa for <strong><?php echo $name; ?></strong>.</p>
        <p>We look forward to welcoming <strong><?php echo $name; ?></strong> to our university and are confident that their academic journey with us will be both rewarding and enriching.</p>
        <p>Thank you for your time and consideration.</p>
    </div>

    <div class="signature-section">
        <p>Yours sincerely,</p>
        <p><strong>IED- International Education Division</strong></p>
        <p>Guru Kashi University</p>
        <p><b>Email: </b><a href="mailto:ied@gku.ac.in">ied@gku.ac.in</a></p>
        <p><b>Phone:</b> 700 998 5 998</p>
    </div>

    <div class="enclosures">
        <h4>Enclosures:</h4>
        <ul>
            <li>Copy of Admission Offer Letter</li>
            <li>Passport Copy of <b><?php echo $name; ?></b></li>
            <li>Payment Receipt/Proof of Initial Deposit</li>
        </ul>
    </div>

    <!-- Add page break after each letter -->
    <div class="page-break"></div>

</body>
</html>
<?php 
    } 
} 
?>
