<?php 
session_start();
$EmployeeID=$_SESSION['usr'];
ini_set('max_execution_time', '0');
date_default_timezone_set("Asia/Kolkata");  
   include "connection/connection.php";
$univ_rollno=$_GET['id_array'];
$BatchID=$_GET['BatchID'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        /* margin: 10; */
        
        padding: 10px;
        font-size: 14px;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .uptd {
        border: 2px solid black;
        width: 50%;
        /* Ensures each column takes equal width */
        text-align: left;
        padding: 3px;
        font-weight: 600;
    }

    .downtd1 {
        border: 2px solid black;
        width: 10%;
        /* Ensures each column takes equal width */
        text-align: center;
        padding: 3px;
        font-weight: 600;

    }

    .downtd2 {
        border: 2px solid black;
        width: 40%;
        /* Ensures each column takes equal width */
        text-align: center;
        padding: 3px;
        font-weight: 600;

    }

    .downtd3 {
        border: 2px solid black;
        width: 17%;
        /* Ensures each column takes equal width */
        text-align: center;
        padding: 3px;
        font-weight: 600;

    }

    .downtd11 {
        border: 2px solid black;
        width: 10%;
        /* Ensures each column takes equal width */
        text-align: center;
        padding: 3px;
        font-weight: 600;

    }

    .marksTable {
        margin-top: 16px;
    }

    .heading1 {
        font-weight: 600;
        transform: scaleX(0.9);
        font-size: 20px;
        text-align: center;
        margin: 0;
        margin-bottom: 8px;
        color: black;
    }

    .heading2 {
        /* font-family:Arial, Helvetica, sans-serif; */
        font-weight: 600;
        transform: scaleX(0.9);
        font-size: 18px;
        text-align: center;
        margin: 0;
        margin-bottom: 20px;
    }

    @media print {
    @page {
        size: A4;
        margin: 10mm 10mm 20mm 10mm; /* More space at the bottom */
    }

    .footer {
        position: fixed;
        bottom: 10mm; /* Ensures it's inside the page margin */
        left: 0;
        right: 13px;
        width: 97%;
        /* border:groove; */
        text-align: right;
        font-weight: bold;
    }
    .gcsno,
    .srno {
        position: fixed;
        font-weight: 600;
        font-size: 12px;
    }

    .gcsno {
        right: 13px;
        top: -2mm; /* Adjusted for print */
    }

    .srno {
        left: 13px;
        top: -2mm; /* Adjusted for print */
    }
}

    
    </style>
</head>

<?php

function convertSemesterToWords($semester) {
    $words = [
        1 => 'FIRST', 2 => 'SECOND', 3 => 'THIRD', 4 => 'FOURTH', 
        5 => 'FIFTH', 6 => 'SIXTH', 7 => 'SEVENTH', 8 => 'EIGHTH', 9 => 'NINTH', 10 => 'TENTH'
    ];
    return $words[$semester] ?? strtoupper($semester); // Convert to uppercase if not found
}


   $sel=$_GET['id_array'];
   $id=explode(",",$sel);
foreach ($id as $key => $value) {
   
// $ID=$_POST['ID'];
$query = "SELECT * FROM Admissions inner join ResultPreparation as rd on Admissions.IDNo=rd.IDNo   Where  rd.Id='$value'  order by  rd.ID Desc  ";
$result = sqlsrv_query($conntest,$query);
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
{
 // echo $row['IDNo'];
  $IDNo= $row['IDNo'];
  $UniRollNo= $row['UniRollNo'];
  $ResultID= $row['Id'];
  $Type= $row['Type'];
  if ($key > 0) { ?>
<div style="page-break-before: always;"></div>
<?php }
?>

<body>
    <div>
        <!-- <p class="srno">Sr. No.</p> -->
        <p class="gcsno">Grade Card Serial No. C78990 <?=$row['GradeCardSrNo'];?></p>
        <div style="margin-top: 25%;">
            <div>
                <p class="heading1"><?= strtoupper($row['Course']); ?></p>
                <p class="heading2">STATEMENT OF GRADES: <?= convertSemesterToWords($row['Semester']); ?> SEMESTER</p>
            </div>
            <div>
                <table>
                    <tr>
                        <td class="uptd">Name: <?=$row['StudentName'];?></td>
                        <td class="uptd">University Roll No. <?=$row['UniRollNo'];?></td>
                    </tr>
                    <tr>
                        <td class="uptd">Father's Name: <?=$row['FatherName'];?></td>
                        <td class="uptd">Year of Admission: <?=$row['Batch'];?></td>
                    </tr>
                    <tr>
                        <td class="uptd">Mother's Name: <?=$row['MotherName'];?></td>
                        <td class="uptd"><?=$row['Examination'];?> Examination</td>
                    </tr>
                </table>
            </div>
        </div>

        <?php 
        if($row['Timestamp'] != '') {
            $decdate = $row['Timestamp']->format('d-m-Y h:i:s');
        } else {
            $decdate = '';
        }
        ?>

        <div class="marksTable">
            <table>
                <tr>
                    <td class="downtd1">Subject Code</td>
                    <td class="downtd2">Subject</td>
                    <td class="downtd3">Number of Credits</td>
                    <td class="downtd3">Grade</td>
                    <td class="downtd3">Grade Point Value Per Credit</td>
                </tr>
                <?php  
                $query1 = "SELECT * FROM ResultPreparationDetail Where ResultID='$ResultID'";
                $SrNo = 1;
                $result1 = sqlsrv_query($conntest, $query1);
                while ($row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) {
                ?>
                <tr>
                    <td class="downtd1"><?=$row1['SubjectCode'];?></td>
                    <td class="downtd2" style="text-align: left;"><?=$row1['SubjectName'];?></td>
                    <td class="downtd3"><?= $creditold = $row1['SubjectCredit']?></td>
                    <td class="downtd3"><?=$row1['SubjectGrade'];?></td>
                    <td class="downtd3"><?= $oldgradepoint = $row1['SubjectGradePoint'];?></td>
                </tr>
                <?php $SrNo++; } ?>

                <tr>
                    <td class="downtd1" colspan="2">Total Number of Credits</td>
                    <td class="downtd3"><?= $totalcredit = $row['TotalCredit'];?></td>
                    <td class="downtd3">SGPA</td>
                    <td class="downtd3"><?=$row['Sgpa']?></td>
                </tr>
            </table>
            <p style="margin-left: 16px; font-weight: 600;">
                Date of issue: <?= date('d F Y'); ?>
            </p>
        </div>
    </div>

    <!-- Signature at the footer -->
    <div class="footer">
    Controller of Examinations
</div>

</body>

<?php
  $queryCheckStatus = "SELECT COUNT(*) AS PendingCount FROM ResultPreparation WHERE BatchID = '$BatchID' AND DMCStatus != '3'";
$checkStatusRun = sqlsrv_query($conntest, $queryCheckStatus);

if ($checkStatusRun) {
    $row = sqlsrv_fetch_array($checkStatusRun, SQLSRV_FETCH_ASSOC);
    $pendingCount = $row['PendingCount'] ?? 1; 
    if ($pendingCount == 0) {
         $queryUpdateDMCPrint1 = "UPDATE DMCPrint  SET Status = '3', PrintedBy = '$EmployeeID', PrintedOn = '$timeStamp' WHERE Id = '$BatchID'";
         sqlsrv_query($conntest, $queryUpdateDMCPrint1);
    }
    else{
         $queryUpdateDMCPrint = "UPDATE ResultPreparation  SET DMCStatus = '3', DMCprintedBy = '$EmployeeID', DMCprintedOn = '$timeStamp' WHERE ID = '$value'";
        sqlsrv_query($conntest, $queryUpdateDMCPrint); 
    }
    } else {
        echo "";
    }
    ?>
<?php         
}
 
}?>