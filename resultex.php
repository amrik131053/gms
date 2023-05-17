<?php
 $serverName = "103.18.70.79"; //serverName\instanceName
$connectionInfo = array( "Database"=>"DBgurukashi", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");
$conntest = sqlsrv_connect( $serverName,$connectionInfo);

$connectionInfo1 = array( "Database"=>"App91", "UID"=>"sa", "PWD"=>"b2y3rt78374&*#&$");
$conn91 = sqlsrv_connect( $serverName,$connectionInfo1);

$connection_web_in_website= new mysqli('119.18.54.49:3306', 'guruk2cy_connect','Amrik@123','guruk2cy_website');

$servername1 = "localhost";
$username1 = "root";
$password1 = "";
$dbname1 = "lims";
$conn = new mysqli($servername1, $username1, $password1, $dbname1);
if ($conn) {
}
?>
  <?php
  header("Content-Type: application/xls");
header("Pragma: no-cache");
header("Expires: 0"); 
  	echo 'Sr No' . "\t" . 'UniRollNo' . "\t" . 'Name' . "\t" . 'Father Name' . "\t" . '1' . "\t" . '2' . "\t" . '3' . "\t" . '4' . "\t" . '5' . "\t" . '6' . "\t\n";

$sql="select UniRollNo,StudentName,FatherName,MotherName from Admissions  where CourseID='119'AND Batch='2019' ANd UniRollNo !='' order By UniRollNo ASC";
     $count=1;
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      { 
                  
                      	$UniRollNo = $row1['UniRollNo'];
                         $NAme = $row1['StudentName']; 

                          
                        $fNAme = $row1['FatherName'];

                      echo  $count. "\t" . $UniRollNo . "\t" . $NAme . "\t". $fNAme . "\t";
                      
                         
                     






 for($ss=1;$ss<=6;$ss++)
{
 $sqle="select Distinct SGPA from ResultGKU   where UniRollNo='$UniRollNo'  ANd Semester ='$ss' ANd SGPA!='NC' order by SGPA DESc ";

 $stmt2e = sqlsrv_query($conntest,$sqle);
                     while($row1e = sqlsrv_fetch_array($stmt2e, SQLSRV_FETCH_ASSOC))
                      { $sgpa = $row1e['SGPA'];
                      	  echo  $sgpa . "\t" ;


}
}?>

<?php header("Content-Disposition: attachment; filename=" . $sgpa . ".xls");
$count++;
}
                        ?>

