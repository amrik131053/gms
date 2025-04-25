<?php 
session_start();
$EmployeeID = $_SESSION['usr'];
ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");
$timeStamp = date("Y-m-d H:i:s");

include "connection/connection.php";

$univ_rollno = $_GET['id_array'];
$BatchID = $_GET['BatchID'];
$Abbrevation=$_GET['Abbrevation'];

function convertSemesterToWords($semester) {
    $words = [
        1 => 'FIRST', 2 => 'SECOND', 3 => 'THIRD', 4 => 'FOURTH', 
        5 => 'FIFTH', 6 => 'SIXTH', 7 => 'SEVENTH', 8 => 'EIGHTH', 
        9 => 'NINTH', 10 => 'TENTH'
    ];
    return $words[$semester] ?? strtoupper($semester);
}

$sel = $_GET['id_array'];
$id = explode(",", $sel);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grade Card</title>
    <style>
        body {
            padding: 10px;
            font-size: 14px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .uptd, .downtd1, .downtd2, .downtd3, .downtd11 {
            border: 2px solid black;
            text-align: center;
            padding: 3px;
            font-weight: 600;
        }
        .uptd {
            width: 50%;
            text-align: left;
        }
        .downtd1 { width: 10%; }
        .downtd2 {
            width: 40%;
            text-align: left;
        }
        .downtd3, .downtd11 {
            width: 8%;
        }
        .marksTable {
            margin-top: 16px;
        }
        .heading1 {
            font-weight: 600;
            font-size: 20px;
            text-align: center;
            margin: 0 0 8px 0;
            color: black;
        }
        .heading2 {
            font-weight: 600;
            font-size: 18px;
            text-align: center;
            margin: 0 0 20px 0;
        }
    
        @media print {
    body {
        margin: 0;
    }

    .header, .footer {
        position: fixed;
        font-family:'times';
        left: 0;
        right: 0;
        height: 60px;
        background: #f1f1f1;
        text-align: right;
        padding: 10px 0;
        font-size: 10px;
        
    }
    .footer {
        position: fixed;
        font-family:'times';
        left: 0;
        right: 0;
        height: 60px;
        background: #f1f1f1;
        text-align: right;
        padding: 10px 0;
        font-size: 16px;
        
    }

    .header {
        top: 0;
        right:11px;
        position: fixed;
    }

    
    .footer {
        bottom: 0;
        right:11px;
    }

    .content {
        margin-top: 80px;
        margin-bottom: 80px;
    }

    .page-break {
        page-break-before: always;
    }
    .signature {
        position: absolute;
        bottom: 20px; /* Adjust the space from the bottom */
        right: 20px; /* Adjust the space from the right */
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        padding: 5px;
        border-top: 1px solid #000;
    }
}
    </style>
</head>
<body>
<?php
function getGradeCardSrNo($conntest, $id) {
    $query = "SELECT GradeCardSrNo FROM Admissions 
              INNER JOIN ResultPreparation as rd ON Admissions.IDNo = rd.IDNo 
              WHERE rd.Id = ? ORDER BY rd.ID DESC";
    $stmt = sqlsrv_query($conntest, $query, [$id]);
    if ($stmt && $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        return $row['GradeCardSrNo'];
    }
    return '';
}

foreach ($id as $key => $value) {
    $gradeCardNo = getGradeCardSrNo($conntest, $value);

    $query = "SELECT * FROM Admissions 
              INNER JOIN ResultPreparation as rd ON Admissions.IDNo = rd.IDNo 
              WHERE rd.Id = '$value' 
              ORDER BY rd.ID DESC";
    $result = sqlsrv_query($conntest, $query);

    if ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $ResultID = $row['Id'];

        if ($key > 0) echo '<div class="page-break"></div>';
?>

<div style="text-align: right; font-weight: bold; font-size: 14px; margin-bottom: 10px; margin-right: 9px;  display: inline-block; float: right;">
    <div style="text-align: left" >
        <?php if($row['RegistrationNo'] != '') { ?>
            Registration No. <?= $row['RegistrationNo']; ?><br>
        <?php } ?>
        Grade Card Serial No. <?= $row['GradeCardSrNo']; ?>
    </div>
</div>
    <!-- ✅ Footer -->
    <div class="footer">
   <b> Controller of Examinations</b>
    </div>

    <div class="content">
        <div>
            <div style="margin-top: 25%;">
               <?php  if($row['DMCCourse']!='')
               {?>
                 <p class="heading1"><?= strtoupper($row['DMCCourse']); ?></p>
              <?php  }
               else
               { ?>
<p class="heading1"><?= strtoupper($row['Course']); ?></p>

            <?php   }?>
                
                <p class="heading2">STATEMENT OF GRADES: <?= convertSemesterToWords($row['Semester']); ?> SEMESTER</p>
            </div>
            <table>
                <tr>
                    <td class="uptd">Name: <?= ucwords(strtolower($row['StudentName'])); ?></td>
                    <td class="uptd">University Roll No. <?= $row['UniRollNo']; ?></td>
                </tr>
                <tr>
                    <td class="uptd">Father's Name: <?= ucwords(strtolower($row['FatherName'])); ?></td>
                    <td class="uptd">Year of Admission: <?= $row['YearOfAdmission']; ?></td>
                </tr>
                <tr>
                    <td class="uptd">Mother's Name: <?= ucwords(strtolower($row['MotherName'])); ?></td>
                    <td class="uptd"><?= $row['Examination']; ?> Examination</td>
                </tr>
            </table>
            <div class="marksTable">
            <table>
                <tr>
                    <td class="downtd1">Subject Code</td>
                    <td class="downtd3">Subject</td>
                    <td class="downtd1">Number of Credits</td>
                    <td class="downtd1">Grade</td>
                    <td class="downtd1">Grade Point Value Per Credit</td>
                </tr>
                <?php
                $query1 = "SELECT * FROM ResultPreparationDetail WHERE ResultID = '$ResultID'";
                $result1 = sqlsrv_query($conntest, $query1);
                while ($row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) {
                ?>
                <tr>
                    <td class="downtd1"><?= $row1['SubjectCode']; ?></td>
                    <td class="downtd2"><?= $row1['SubjectName']; ?></td>
                    <td class="downtd3"><?php  if($row1['SubjectCredit']>0)
                    {
                        echo $row1['SubjectCredit'];
                    }
                    else
                    {
echo  "NC";
                        
                        }?></td>
                    
                    <td class="downtd3"><?= $row1['SubjectGrade']; ?></td>
                    <td class="downtd3"><?= $row1['SubjectGradePoint']; ?></td>
                </tr>
                <?php } ?>
                <tr >
                    <td class="downtd1" colspan="2" style="height: 40px;">Total Number of Credits</td>
                    <td class="downtd3"><?= $row['TotalCredit']; ?></td>
                    <td class="downtd3">SGPA</td>
                    <td class="downtd3"><?= $row['Sgpa']; ?></td>
                </tr>
            </table>
            <p style="margin-left: 10px; font-weight: 600;">
                Date of issue: <?= date('d F Y'); ?>
            </p>
             <p style="margin-left: 10px; font-weight: 600;">
              <?=$Abbrevation;?>
            </p>
        </div>
        </div>
    </div>
   
<?php 
    } // end while
 
} // end foreach

foreach ($id as $value) {
    $queryUpdate = "UPDATE ResultPreparation 
                    SET DMCStatus = '3', DMCprintedBy = '$EmployeeID', DMCprintedOn = '$timeStamp' 
                    WHERE ID = '$value'";
    sqlsrv_query($conntest, $queryUpdate);
}


$queryPendingCheck = "SELECT COUNT(*) AS PendingCount  
                      FROM ResultPreparation  
                      WHERE BatchID = '$BatchID' AND DMCStatus != '3'";
$result = sqlsrv_query($conntest, $queryPendingCheck);
if ($result && ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))) {
    $pendingCount = $row['PendingCount'] ?? 1;
    if ($pendingCount == 0) {
        $queryUpdateBatch = "UPDATE DMCPrint 
                             SET Status = '3', PrintedBy = '$EmployeeID', PrintedOn = '$timeStamp' 
                             WHERE Id = '$BatchID'";
        sqlsrv_query($conntest, $queryUpdateBatch);
    }
}
?>
</body>
</html>
