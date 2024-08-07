 <?php  
$College=$_GET['CollegeId'];
$Course=$_GET['Course'];
$Batch=$_GET['Batch'];
$Semester=$_GET['Semester'];
$Type=$_GET['Type'];
$Group=$_GET['Group'];
$Examination=$_GET['Examination'];
if(ISSET($_GET['ResultNo']))
{
$resultNo=$_GET['ResultNo'];
}
else
{
   $resultNo='';
}
$nccount=0;
$SrNo=1;

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


$subjects_sql="select  DIstinct SubjectCode,SubjectName from ResultPreparation inner join 
ResultPreparationDetail on ResultPreparation.Id=ResultPreparationDetail.ResultID where  CollegeID='$College' ANd CourseID='$Course'  ANd Semester='$Semester'  ANd Examination='$Examination'";

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

}

$subCountc=count($Subjects);



?>