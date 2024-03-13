 <?php  $College=$_GET['CollegeId'];
$Course=$_GET['Course'];
$Batch=$_GET['Batch'];
$Semester=$_GET['Semester'];
$Type=$_GET['Type'];
$Group=$_GET['Group'];
$Examination=$_GET['Examination'];
$nccount=0;
$SrNo=1;
$Subjectsp=array();
$SubjectNamesp=array();
$SubjectTypesp=array();
$Subjects=array();
$SubjectNames=array();
$SubjectTypes=array();
$SubjectsNew=array();
$SubjectNamesNew=array();
$SubjectTypesNew=array();
$SubjectsNewop=array();
                $SubjectNamesNewop=array();
                $SubjectTypesNewop=array();





$collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
$list_cllegename = sqlsrv_query($conntest,$collegename);
                  
              
                if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $CollegeName=$row_college['CollegeName'] ;
                $CourseName=$row_college['Course'] ;
                
        }


 $subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd   Sgroup='$Group' ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' ANd (SubjectType like '%T%' OR SubjectType='M' OR SubjectType='S')  order by SubjectType";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjects[]=$row_subject['SubjectCode'] ;
               $SubjectNames[]=$row_subject['SubjectName'] ;
               $SubjectTypes[]=$row_subject['SubjectType'] ;
}
$subCountc=count($Subjects);

$sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='O' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";

$sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {
                $SubjectsNew[]=$row_subject['SubjectCode'] ;
                $SubjectNamesNew[]=$row_subject['SubjectName'] ;
                $SubjectTypesNew[]=$row_subject['SubjectType'] ;
                   }


$subCounto=count($SubjectsNew);
$Subjects=array_merge($Subjects,$SubjectsNew);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesNew);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesNew);


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd Batch='$Batch' ANd   Sgroup='$Group' AND SemesterID='$Semester' ANd Isverified='1' AND SubjectType='P' order by SubjectType ";


$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjectsp[]=$row_subject['SubjectCode'] ;
               $SubjectNamesp[]=$row_subject['SubjectName'] ;
               $SubjectTypesp[]=$row_subject['SubjectType'] ;
}



$subCountp=count($Subjectsp);

$Subjects=array_merge($Subjects,$Subjectsp);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesp);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesp);


$sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='OP' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";

$sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {
                $SubjectsNewop[]=$row_subject['SubjectCode'] ;
                $SubjectNamesNewop[]=$row_subject['SubjectName'] ;
                $SubjectTypesNewop[]=$row_subject['SubjectType'] ;
                   }




$subCountop=count($SubjectsNewop);

$Subjects=array_merge($Subjects,$SubjectsNewop);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesNewop);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesNewop);
?>