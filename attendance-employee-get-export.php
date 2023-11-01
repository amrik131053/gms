<?php $curmnth =$_GET['month'];
     $curyear = $_GET['year'];
     $College=$_GET['College'];
     $Department=$_GET['Department'];


  if($College!=''&& $Department!='')
  {       
$sql_a="select Distinct IDNo from Staff  where jobStatus='1' AND  CollegeID='$College' ANd DepartmentID='$Department'";

}
else if($College!='')
{
$sql_a="select Distinct IDNo from Staff  where jobStatus='1' AND  CollegeID='$College'";



}
else
{
$sql_a="select Distinct IDNo from Staff  where jobStatus='1'";

}

if($College!='')
{
	$getCollegeName="Select CollegeName FROM MasterCourseCodes Where  CollegeID='$College'";
$getCollegeNameRun=sqlsrv_query($conntest,$getCollegeName);
if($getCollegeNameRow=sqlsrv_fetch_array($getCollegeNameRun))
{
	$collegeName=$getCollegeNameRow['CollegeName'];
}

$filename=$collegeName;
}
else
{
$filename='';

}



$emp_codes=array();
$stmt = sqlsrv_query($conntest,$sql_a);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
          {
         $emp_codes[]=$row_staff['IDNo'];
          }

 $no_of_emp=count($emp_codes);?>

