<?php
 session_start();
 ini_set("max_execution_time", "0");

 ob_start();
 header("Content-Type: application/xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 include "connection/connection.php";
 include "connection/connection_web.php"; 
 function numberToRomanRepresentation($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}
 $exportCode = "";
 $UniRollNos=array();
 $fileName = "My File";
 $exportstudy = "<table class='table' border='1'>
        <thead>  
        ";
 $ExaminationMonth = "";
 $ExaminationYear = "";
 $resultid = $_GET["resultid"];
 $Course = $_GET["Course"];
 $Batch = $_GET["Batch"];
 $Semester = $_GET["Semester"];
 $DeclareDate=$_GET["DeclareDate"];
 $ResultNo=$_GET["ResultNo"];
$SemesterPrint=numberToRomanRepresentation($Semester);
 $Type = $_GET["Type"];
 $Group = $_GET["Group"];
 $Examination = $_GET["Examination"];
 $exportstudy .= "<tr>
   <th>	ORG_NAME	</th>
   <th>	ORG_NAME_L	</th>
   <th>	ACADMIC_COURSE_ID	</th>
   <th>	COURSE_NAME	</th>
   <th>	COURSE_NAME_L	</th>
   <th>	STREAM	</th>
   <th>	STREAM_L	</th>
   <th>	SESSION 	</th>
   <th>	REGN_NO	</th>
   <th>	RROLL	</th>
   <th>	CNAME	</th>
   <th>	GENDER	</th>
   <th>	DOB	</th>
   <th>	FNAME	</th>
   <th>	MNAME	</th>
   <th>	PHOTO	</th>
   <th>	MRKS_REC_STATUS	</th>
   <th>	RESULT	</th>
   <th>	YEAR	</th>
   <th>	MONTH	</th>
   <th>	DIVISION	</th>
   <th>	GRADE	</th>
   <th>	PERCENT	</th>
   <th>	DOI	</th>
   <th>	SEM	</th>
   <th>	EXAM_TYPE	</th>
   <th>	TOT	</th>
   <th>	TOT_MRKS	</th>
   <th>	TOT_CREDIT	</th>
   <th>	TOT_CREDIT_POINTS	</th>
   <th>	TOT_GRADE_POINTS	</th>
   <th>	GRAND_TOT_MAX	</th>
   <th>	GRAND_TOT_MRKS	</th>
   <th>	GRAND_TOT_CREDIT_POINT	</th>
   <th>	CGPA	</th>
   <th>	REMARKS	</th>
   <th>	SGPA	</th>
   <th>	ABC_ACCOUNT_ID	</th>
   <th>	TERM_TYPE	</th>
   <th>	TOT_GRADE	</th>";


    $subjectn="SELECT * from course_master where id='$Course'";
    $stmt2 = mysqli_query($conn_online_odl,$subjectn);
    while($row1 = mysqli_fetch_array($stmt2) )
       {

$PID="";
$CourseName=$row1["Name"];
// $CollegeName=$row1["CollegeName"];
// $CollegeID=$rown["CollegeID"];
$CourseID=$row1["ID"];
}

//  echo $subject="SELECT * from MasterCourseStructure  where CollegeID='$College' ANd CourseID='$Course' ANd Batch='$Batch' ANd SemesterID='$Semester' ANd Isverified='1'";
// $list_resultsub = sqlsrv_query($conntest, $subject);
$key1=1;
//  while ($rows = sqlsrv_fetch_array($list_resultsub, SQLSRV_FETCH_ASSOC)) {

//     $exportstudy .= "<th>	SUB{$key1}NM	</th>
//    <th>	SUB{$key1}	</th>
//    <th>	SUB{$key1}_TH_MAX	</th>
//    <th>	SUB{$key1}_PR_MAX	</th>
//    <th>	SUB{$key1}_CE_MAX	</th>
//    <th>	SUB{$key1}_TH_MRKS	</th>
//    <th>	SUB{$key1}_PR_MRKS	</th>
//    <th>	SUB{$key1}_CE_MRKS	</th>
//    <th>	SUB{$key1}_TOT	</th>
//    <th>	SUB{$key1}_STAUTS	</th>
//    <th>	SUB{$key1}_GRADE	</th>
//    <th>	SUB{$key1}_GRADE_POINTS	</th>
//    <th>	SUB{$key1}_CREDIT	</th>
//    <th>	SUB{$key1}_CREDIT_POINTS	</th>
//    <th>	SUB{$key1}_REMARKS	</th>
//    <th>	SUB{$key1}_CREDIT_ELIGIBILITY	</th>";
// $key1++;

// }
$subject2="SELECT  Distinct SubjectCode from ResultDetailOnlineGKU  where  ResultID='$resultid'  ";
$list_resultsubs = sqlsrv_query($conntest, $subject2);
$key2=$key1;
 while ($rowss = sqlsrv_fetch_array($list_resultsubs, SQLSRV_FETCH_ASSOC)) {

     $exportstudy .= "<th>  SUB{$key2}NM    </th>
   <th> SUB{$key2}  </th>
   <th> SUB{$key2}_TH_MAX</th>
   <th> SUB{$key2}_PR_MAX   </th>
   <th> SUB{$key2}_CE_MAX   </th>
   <th> SUB{$key2}_TH_MRKS  </th>
   <th> SUB{$key2}_PR_MRKS  </th>
   <th> SUB{$key2}_CE_MRKS  </th>
   <th> SUB{$key2}_TOT  </th>
   <th> SUB{$key2}_STAUTS   </th>
   <th> SUB{$key2}_GRADE    </th>
   <th> SUB{$key2}_GRADE_POINTS </th>
   <th> SUB{$key2}_CREDIT   </th>
   <th> SUB{$key2}_CREDIT_POINTS    </th>
   <th> SUB{$key2}_REMARKS  </th>
   <th> SUB{$key2}_CREDIT_ELIGIBILITY   </th>";
   $key2++;
}




 $exportstudy .= "<th>	AADHAAR_NAME	</th>
                          <th>	ADMISSION_YEAR	</th>
                          </tr>
                        </thead> ";

                     
                        




// $list_sql1="SELECT  * FROM ResultGKU 
// INNER JOIN Admissions ON ResultGKU.UniRollNo = Admissions.UniRollNo
// where Admissions.CollegeID='$College' AND Admissions.CourseID='$Course'AND Admissions.Batch='$Batch' 






// AND ResultGKU.Type='$Type'  ANd ResultGKU.Semester='$Semester' 
// ANd ResultGKU.Examination='$Examination' ANd ResultGKU.ResultNo='$ResultNo'AND ResultGKU.DeclareDate='$DeclareDate'    ORDER BY Admissions.UniRollNo";
 
 $resulrs="SELECT *  from basic_detail  where  course='$Course' AND batch='$Batch' and classrollno!=''   order by classrollno Asc";
$list_resultsub = mysqli_query($conn_online_odl, $resulrs);
$key1=1;
 while ($rows = mysqli_fetch_array($list_resultsub)) 
 {
 
     $resulrs1="SELECT *  from ResultOnlineGKU where  UniRollNo='".$rows['classrollno']."' and  ResultNo='$ResultNo' AND  DeclareDate='$DeclareDate'  and Examination='$Examination' and Semester='$Semester' and Type='$Type'";
    $list_resultsub1 = sqlsrv_query($conntest, $resulrs1);
    $key1=1;
     while ($rows1 = sqlsrv_fetch_array($list_resultsub1, SQLSRV_FETCH_ASSOC)) 
     {
 $UniRollNo=$rows["classrollno"];
 $dob=$rows["dob"];
 $RegistrationNo=$rows["id"];
  $StudentName=$rows["candidate_name"];
 $Gender=$rows["gender"];
  $FatherName=$rows["father_name"];
   $MotherName=$rows["mother_name"];
$AadhaarNo=$rows["adhar_no"];
$Batch=$rows["batch"];
   $Sgpa=$rows1["Sgpa"];

   $TotalCredit=$rows1["TotalCredit"];
$ABCID=$rows["abcid"];
$rID=$rows1["Id"];


if($Gender=='Male')
{
    $Gender='M';
}
else
{
   $Gender='F'; 
}
$p='';
if($Sgpa!='NC')
{
$p='PASS';
}
else
{
$p='FAIL';
}
$CourseNameU=strtoupper($CourseName);
 $orderdate = explode(" ", $Examination);
                            $ExaminationMonth = strtoupper($orderdate[0]);
                            $ExaminationYear = $orderdate[1];
                            if($ExaminationYear=='JAN')
                            {
                                $ExaminationYear="JANUARY";
                            }
                            if($ExaminationYear=='AUG')
                            {
                                $ExaminationYear="AUGUST";
                            }
                            $exportstudy .= "<tr>
                            <td>GURU KASHI UNIVERSITY</td>
                            <td></td>
                            <td>{$PID}</td>
                            <td>{$CourseNameU}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{$RegistrationNo}</td>
                            <td>{$UniRollNo}</td>
                            <td>{$StudentName}</td>
                            <td>{$Gender}</td>
                            <td>{$dob}</td>
                            <td>{$FatherName}</td>
                            <td>{$MotherName}</td>
                            <td></td>
                            <td>O</td>
                            <td>{$p}</td>
                            <td>{$ExaminationYear}</td>
                            <td>{$ExaminationMonth}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{$SemesterPrint}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{$TotalCredit}</td>
                            <td>{$TotalCredit}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{$Sgpa}</td>
                            <td>{$ABCID}</td>
                            <td>SEMESTER</td>
                            <td></td>";
                
         



 $subjectresult="Select  * from ResultDetailOnlineGKU  where ResultID='$rID' order By SubjectCode";
$list_resultsubject = sqlsrv_query($conntest, $subjectresult);

 while($rowsubjects = sqlsrv_fetch_array($list_resultsubject, SQLSRV_FETCH_ASSOC)) {


$SubjectName=$rowsubjects["SubjectName"];
$SubjectCode=$rowsubjects["SubjectCode"];
$SubjectGrade=$rowsubjects["SubjectGrade"];
$SubjectGradePoint=$rowsubjects["SubjectGradePoint"];
$SubjectCredit=$rowsubjects["SubjectCredit"];
// $NoOfCredit='';

//     $subjectcredit="SELECT DISTINCT NoOFCredits from  MasterCourseStructure  where CollegeID='$College' ANd CourseID='$Course' ANd Batch='$Batch' ANd SemesterID='$Semester' ANd SubjectCode='$SubjectCode'";
// $list_resultsubcredit = sqlsrv_query($conntest, $subjectcredit);
// $key1=1;
//  while ($rowcr = sqlsrv_fetch_array($list_resultsubcredit, SQLSRV_FETCH_ASSOC)) {
//     $NoOfCredit=$rowcr['NoOFCredits'];
//  }



         $exportstudy .= " 
                            <td>{$SubjectName}</td>
                            <td>{$SubjectCode}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{$SubjectGrade}</td>
                            <td>{$SubjectGradePoint}</td>
                            <td>{$SubjectCredit}</td>
                            <td>{$SubjectCredit}</td>
                            <td></td>
                            <td></td>";
     
}
     
     $exportstudy .= " <td></td>
             <td>{$Batch}</td></tr>";
         }
        }
 $exportstudy .= "</table>";
 echo $exportstudy;
 $fileName = "gg";
 header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
 unset($_SESSION["filterQry"]);
 ob_end_flush();