<?php
 session_start();
 ini_set("max_execution_time", "0");

 ob_start();
 header("Content-Type: application/xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 include "connection/connection.php";
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
 $College = $_GET["CollegeId"];
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

    $subjectn="SELECT * from MasterCOurseCodes  where CollegeID='$College' ANd CourseID='$Course' ANd Batch='$Batch'";
$list_resultsubn = sqlsrv_query($conntest, $subjectn);

 while($rown = sqlsrv_fetch_array($list_resultsubn, SQLSRV_FETCH_ASSOC)) {


$PID=$rown["PID"];
$CourseName=$rown["Course"];
$CollegeName=$rown["CollegeName"];
}

 $subject="SELECT * from MasterCourseStructure  where CollegeID='$College' ANd CourseID='$Course' ANd Batch='$Batch' ANd SemesterID='$Semester' ANd Isverified='1'";
$list_resultsub = sqlsrv_query($conntest, $subject);
$key1=1;
 while ($rows = sqlsrv_fetch_array($list_resultsub, SQLSRV_FETCH_ASSOC)) {

    $exportstudy .= "<th>	SUB{$key1}NM	</th>
   <th>	SUB{$key1}	</th>
   <th>	SUB{$key1}_TH_MAX	</th>
   <th>	SUB{$key1}_PR_MAX	</th>
   <th>	SUB{$key1}_CE_MAX	</th>
   <th>	SUB{$key1}_TH_MRKS	</th>
   <th>	SUB{$key1}_PR_MRKS	</th>
   <th>	SUB{$key1}_CE_MRKS	</th>
   <th>	SUB{$key1}_TOT	</th>
   <th>	SUB{$key1}_STAUTS	</th>
   <th>	SUB{$key1}_GRADE	</th>
   <th>	SUB{$key1}_GRADE_POINTS	</th>
   <th>	SUB{$key1}_CREDIT	</th>
   <th>	SUB{$key1}_CREDIT_POINTS	</th>
   <th>	SUB{$key1}_REMARKS	</th>
   <th>	SUB{$key1}_CREDIT_ELIGIBILITY	</th>";
$key1++;

}
$subject2="SELECT  Distinct SubjectCode from ExamFormSubject  where CollegeName='$CollegeName' ANd Course='$CourseName' ANd Batch='$Batch' ANd SemesterID='$Semester' ANd SubjectType='O'";
$list_resultsubs = sqlsrv_query($conntest, $subject2);
$key2=$key1;
 while ($rowss = sqlsrv_fetch_array($list_resultsubs, SQLSRV_FETCH_ASSOC)) {

     $exportstudy .= "<th>  SUB{$key2}NM    </th>
   <th> SUB{$key2}  </th>
   <th> SUB{$key2}_TH_MAX   </th>
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

$list_sql1="SELECT  * FROM ResultGKU 
INNER JOIN Admissions ON ResultGKU.UniRollNo = Admissions.UniRollNo
where Admissions.CollegeID='$College' AND Admissions.CourseID='$Course'AND Admissions.Batch='$Batch' 
AND ResultGKU.Type='$Type'  ANd ResultGKU.Semester='$Semester' 
ANd ResultGKU.Examination='$Examination' ANd ResultGKU.ResultNo='$ResultNo'AND ResultGKU.DeclareDate='$DeclareDate'    ORDER BY Admissions.UniRollNo";
 $list_result1 = sqlsrv_query($conntest, $list_sql1);
 while ($row1 = sqlsrv_fetch_array($list_result1, SQLSRV_FETCH_ASSOC)) {
 $UniRollNo=$row1["UniRollNo"];
 $RegistrationNo=$row1["RegistrationNo"];
  $StudentName=$row1["StudentName"];
 $Gender=$row1["Sex"];
  $FatherName=$row1["FatherName"];
   $MotherName=$row1["MotherName"];
$AadhaarNo=$row1["AadhaarNo"];
$Batch=$row1["Batch"];
   $Sgpa=$row1["Sgpa"];

   $TotalCredit=$row1["TotalCredit"];
$ABCID=$row1["ABCID"];
$rID=$row1["Id"];


if($Gender='Male')
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

 $orderdate = explode(" ", $Examination);
                            $ExaminationMonth = strtoupper($orderdate[0]);
                            $ExaminationYear = $orderdate[1];
                            $exportstudy .= "<tr>
                            <td></td>
                            <td></td>
                            <td>{$PID}</td>
                            <td>{$CourseName}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{$RegistrationNo}</td>
                            <td>{$UniRollNo}</td>
                            <td>{$StudentName}</td>
                            <td>{$Gender}</td>
                            <td></td>
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
                            <td></td>
                            <td></td>";
                
         



$subjectresult="Select  * from ResultDetailGKU  where ResultID='$rID' order By SubjectCode";
$list_resultsubject = sqlsrv_query($conntest, $subjectresult);

 while($rowsubjects = sqlsrv_fetch_array($list_resultsubject, SQLSRV_FETCH_ASSOC)) {


$SubjectName=$rowsubjects["SubjectName"];
$SubjectCode=$rowsubjects["SubjectCode"];
$SubjectGrade=$rowsubjects["SubjectGrade"];
$SubjectCredit=$rowsubjects["SubjectCredit"];
$NoOfCredit='';

    $subjectcredit="SELECT DISTINCT NoOFCredits from  MasterCourseStructure  where CollegeID='$College' ANd CourseID='$Course' ANd Batch='$Batch' ANd SemesterID='$Semester' ANd SubjectCode='$SubjectCode'";
$list_resultsubcredit = sqlsrv_query($conntest, $subjectcredit);
$key1=1;
 while ($rowcr = sqlsrv_fetch_array($list_resultsubcredit, SQLSRV_FETCH_ASSOC)) {
    $NoOfCredit=$rowcr['NoOFCredits'];
 }


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
                            <td>{$SubjectCredit}</td>
                            <td>{$NoOfCredit}</td>
                            <td>{$NoOfCredit}</td>
                            <td></td>
                            <td></td>";
     
}
     
     $exportstudy .= " <td>{$AadhaarNo}</td>
             <td>{$Batch}</td></tr>";
         }
 $exportstudy .= "</table>";
 echo $exportstudy;
 $fileName = "gg";
 header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
 unset($_SESSION["filterQry"]);
 ob_end_flush();