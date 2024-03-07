<?php
 session_start();
 ini_set("max_execution_time", "0");

 ob_start();
 header("Content-Type: application/xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 include "connection/connection.php";
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
  $list_sql1 = "SELECT  * FROM ExamForm 
 INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo 
 where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' 
 AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' 
 ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";
 $j = 0;
 $list_result1 = sqlsrv_query($conntest, $list_sql1);
 $count = 0;
 while ($row1 = sqlsrv_fetch_array($list_result1, SQLSRV_FETCH_ASSOC)) {
 $UniRollNos[]=$row1["UniRollNo"];
 }
 $NumberofSubjects=array();
foreach ($UniRollNos as $key => $value) 
{
      $getResullt1 =
         "select *,MasterCourseStructure.NoOFCredits from  ResultDetailGKU inner join ResultGKU on ResultDetailGKU.ResultID=ResultGKU.id inner join MasterCourseStructure ON MasterCourseStructure.SubjectCode=ResultDetailGKU.SubjectCode where ResultDetailGKU.UniRollNo='" .
         $value .
         "' and Sgpa!='NC' and  ResultGKU.Type='$Type'  ANd ResultGKU.Semester='$Semester' ANd ResultGKU.Examination='$Examination'";
     $list_getResullt1 = sqlsrv_query($conntest, $getResullt1);
     if($row_getResullt1 = sqlsrv_fetch_array($list_getResullt1,SQLSRV_FETCH_ASSOC)) 
     {
        $NumberofSubjects[]=$row_getResullt1["SubjectCode"];
    }
}
foreach ($NumberofSubjects as $key1 => $value1) {
    $key1=$key1+1;
    $exportstudy .= "<th>	SUB{$count}NM	</th>
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
 $exportstudy .= "<th>	AADHAAR_NAME	</th>
                          <th>	ADMISSION_YEAR	</th>
                          </tr>
                        </thead> ";
 $SrNo = 1;
 $collegename = "select CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
 $list_cllegename = sqlsrv_query($conntest, $collegename);
 if ($row_college = sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC)) {
     // print_r($row);
     $CollegeName = $row_college["CollegeName"];
     $CourseName = $row_college["Course"];
 }
 $list_sql = "SELECT  * FROM ExamForm 
 INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo 
 where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' 
 AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' 
 ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";
 $j = 0;
 $list_result = sqlsrv_query($conntest, $list_sql);
 while ($row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC)) {
     $IDNos = $row["IDNo"];
     $UnirollNos = $row["UniRollNo"];
     $ClassRollNos = $row["ClassRollNo"];
     $RegistrationNo = $row["RegistrationNo"];
     $Examid = $row["ID"];
     $StudentNames = $row["StudentName"];
     $FatherName = $row["FatherName"];
     $MotherName = $row["MotherName"];
     if($row["Sex"]=='Male')
     {
        $Gender ="M";
     }
     else
     {
        $Gender ="F";
     }
     $ABCID = $row["ABCID"];
     $AadhaarNo = $row["AadhaarNo"];
     $Batch = $row["Batch"];
     $c = 0;
     $Subjects =array();
     $SubjectName =array();
     $SubjectCode =array();
     $SubjectGrade =array();
     $NoOfCredit =array();
     $SubjectCredit =array();
     $getResullt = "SELECT *,MasterCourseStructure.NoOFCredits from  ResultDetailGKU inner join ResultGKU on ResultDetailGKU.ResultID=ResultGKU.id inner join MasterCourseStructure ON MasterCourseStructure.SubjectCode=ResultDetailGKU.SubjectCode where ResultDetailGKU.UniRollNo='$UnirollNos'  and ResultGKU.Type='$Type'  ANd ResultGKU.Semester='$Semester' ANd ResultGKU.Examination='$Examination'";
     $list_getResullt = sqlsrv_query($conntest, $getResullt);
     while ($row_getResullt = sqlsrv_fetch_array($list_getResullt,SQLSRV_FETCH_ASSOC)) {
         $SubjectName = $row_getResullt["SubjectName"];
         $SubjectCode = $row_getResullt["SubjectCode"];
         $SubjectGrade = $row_getResullt["SubjectGrade"];
         $TotalCredit = $row_getResullt["TotalCredit"];
         $Sgpa = $row_getResullt["Sgpa"];
         $NoOfCredit = $row_getResullt["NoOFCredits"];
         $SubjectCredit = $row_getResullt["SubjectCredit"];
         $c++;
     
     }
     if ($Sgpa == "NC") {
         $Sgpa1 = "NC";
     } else {
         $Sgpa1 = "Pass";
     }
                            $orderdate = explode(" ", $Examination);
                            $ExaminationMonth = $orderdate[0];
                            $ExaminationYear = $orderdate[1];
                            $exportstudy .= "<tr>
                            <td></td>
                            <td></td>
                            <td>{$Course}</td>
                            <td>{$CourseName}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{$RegistrationNo}</td>
                            <td>{$UnirollNos}</td>
                            <td>{$StudentNames}</td>
                            <td>{$Gender}</td>
                            <td></td>
                            <td>{$FatherName}</td>
                            <td>{$MotherName}</td>
                            <td></td>
                            <td></td>
                            <td>{$Sgpa1}</td>
                            <td>{$ExaminationYear}</td>
                            <td>{$ExaminationMonth}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{$Semester}</td>
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
        // foreach ($SubjectName as $id => $val) {
            for ($id=0; $id < $c ; $id++) { 
              
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
                            <td></td>
                            ";
     }
     $exportstudy .= " <td>{$AadhaarNo}</td>
             <td>{$Batch}</td></tr>";
             $c++;
 }
 $exportstudy .= "</table>";
 echo $exportstudy;
 $fileName = "gg";
 header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
 unset($_SESSION["filterQry"]);
 ob_end_flush();

