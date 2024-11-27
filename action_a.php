<?php 
   session_start(); 
   ini_set('max_execution_time', '0');
   if (!(isset($_SESSION['usr']) || isset($_SESSION['secure']) || isset($_SESSION['profileIncomplete']))) 
   {  
   ?>
<script>
window.location.href = 'index.php';
</script>
<?php
   } 
   else
   {
   $CurrentExaminationGetDate=date('Y-m-d');
   $EmployeeID=$_SESSION['usr'];
   if ($EmployeeID==0 || $EmployeeID=='') 
      {?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php }
        include "connection/connection.php";
       $employee_details="SELECT RoleID,IDNo,ShiftID,Name,Department,CollegeName,Designation,LeaveRecommendingAuthority,LeaveSanctionAuthority FROM Staff Where IDNo='$EmployeeID'";
      $employee_details_run=sqlsrv_query($conntest,$employee_details);
      if ($employee_details_row=sqlsrv_fetch_array($employee_details_run,SQLSRV_FETCH_ASSOC)) {
         $Emp_Name=$employee_details_row['Name'];
         $Emp_Designation=$employee_details_row['Designation'];
         $Emp_CollegeName=$employee_details_row['CollegeName'];
         $Emp_Department=$employee_details_row['Department'];
          $role_id = $employee_details_row['RoleID'];
          $ShiftID =$employee_details_row['ShiftID'];
         $Authority=$employee_details_row['LeaveSanctionAuthority'];
         $Recommend=$employee_details_row['LeaveRecommendingAuthority']; //new
       
      }
      else
      {
         // echo "inter net off";
      }
   
      function getEmployeeName($emplid) 
      {
        include "connection/connection.php";
        $getEmplyeeDetailsWithFunction="SELECT Name FROM Staff Where IDNo='$emplid'";
        $getEmplyeeDetailsWithFunction_run=sqlsrv_query($conntest,$getEmplyeeDetailsWithFunction);
        if ($getEmplyeeDetailsWithFunction_row=sqlsrv_fetch_array($getEmplyeeDetailsWithFunction_run,SQLSRV_FETCH_ASSOC)) {
         echo  $getEmplyeeDetailsWithFunction_row['Name'];
        }
       }
        $currentMonthString=date('F');
        $currentMonthInt=date('n');
        $code =$_POST['flag'];
      //   if($code==168)
      //   {
      //       include "connection/ftp.php";
      //   }
        if($code==1 || $code==2 || $code==3 || $code==4 )
        {
            include "connection/ftp-erp.php";
        }

// HR/Admin Upload Staff Documents
if($code==1)
{
$IDEmployee=$_POST['IDEmployee'];
$file_name = $_FILES['panCard']['name'];
$file_tmp = $_FILES['panCard']['tmp_name'];
$file_size =$_FILES['panCard']['size'];
$file_type = $_FILES['panCard']['type'];
$allowedTypes = array(
    'image/png',
    'image/jpg',
    'image/jpeg',
    'application/pdf'
);
if (in_array($_FILES['panCard']['type'], $allowedTypes))
    {
if ($file_size < 550000)
    { 
$date=date('Y-m-d');  
$string = bin2hex(openssl_random_pseudo_bytes(4));
$file_data = file_get_contents($file_tmp);
$file_name = $IDEmployee."_".strtotime($date)."_".$string."_".basename($_FILES['panCard']['name']);
$destdir = '/Images/Staff/StaffPanCard';
    ftp_chdir($conn_id, "/Images/Staff/StaffPanCard/") or die("Could not change directory");
    ftp_pasv($conn_id,true);
    ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
    ftp_close($conn_id);
     $insertExp="UPDATE Staff SET PANCardpath='$file_name' where IDNo='$IDEmployee'";
$result = sqlsrv_query($conntest, $insertExp);
if($result==true)
{
    echo "1";
}
else
{
    echo "0";
}
    }
    else
    {
        echo "2"; // size 500kb
    }
}
else{
    echo "3";
}
    sqlsrv_close($conntest);
}
elseif($code==2)
{
    $IDEmployee=$_POST['IDEmployee'];
$file_name = $_FILES['aadharCard']['name'];
$file_tmp = $_FILES['aadharCard']['tmp_name'];
$file_size =$_FILES['aadharCard']['size'];
$file_type = $_FILES['aadharCard']['type'];
$allowedTypes = array(
    'image/png',
    'image/jpg',
    'image/jpeg',
    'application/pdf'
);
if (in_array($_FILES['aadharCard']['type'], $allowedTypes))
    {
if ($file_size < 550000)
    { 
$date=date('Y-m-d');  
$string = bin2hex(openssl_random_pseudo_bytes(4));
$file_data = file_get_contents($file_tmp);
$file_name = $IDEmployee."_".strtotime($date)."_".$string."_".basename($_FILES['aadharCard']['name']);
$destdir = '/Images/Staff/StaffAadharCard';
    ftp_chdir($conn_id, "/Images/Staff/StaffAadharCard/") or die("Could not change directory");
    ftp_pasv($conn_id,true);
    ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
    ftp_close($conn_id);
    $insertExp="UPDATE Staff SET AadharPath='$file_name' where IDNo='$IDEmployee'";
    $result = sqlsrv_query($conntest, $insertExp);
    if($result==true)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
    }
    else
    {
        echo "2"; // size 500kb
    }
}else{
    echo "3";
}
    sqlsrv_close($conntest);
}
elseif($code==3)
{
    $IDEmployee=$_POST['IDEmployee'];
$file_name = $_FILES['photoIMage']['name'];
$file_tmp = $_FILES['photoIMage']['tmp_name'];
$file_size =$_FILES['photoIMage']['size'];
$file_type = $_FILES['photoIMage']['type'];
$allowedTypes = array(
    'image/png',
    'image/jpg',
    'image/jpeg'
);
if (in_array($_FILES['photoIMage']['type'], $allowedTypes))
    {
if ($file_size < 550000)
    { 
$date=date('Y-m-d');  
$string = bin2hex(openssl_random_pseudo_bytes(4));
$file_data = file_get_contents($file_tmp);
$file_name = $IDEmployee."_".strtotime($date)."_".$string."_".basename($_FILES['photoIMage']['name']);
$destdir = '/Images/Staff';
    ftp_chdir($conn_id, "/Images/Staff/") or die("Could not change directory");
    ftp_pasv($conn_id,true);
    ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
    ftp_close($conn_id);
     $insertExp="UPDATE Staff SET Imagepath='$file_name' where IDNo='$IDEmployee'";
    $result = sqlsrv_query($conntest, $insertExp);
    if($result==true)
    {
        echo "1";
    }
    else
    {
        echo "0";
    }
    }
    else
    {
        echo "2"; // size 500kb
    }
}
else{
    echo "3"; // format wrong
}
    sqlsrv_close($conntest);
}
elseif($code==4)
{
   $IDEmployee=$_POST['IDEmployee'];
   $file_name = $_FILES['passbookCopy']['name'];
   $file_tmp = $_FILES['passbookCopy']['tmp_name'];
   $file_size =$_FILES['passbookCopy']['size'];
   $file_type = $_FILES['passbookCopy']['type'];
   $allowedTypes = array(
      'image/png',
      'image/jpg',
      'image/jpeg',
      'application/pdf'
   );
   if (in_array($_FILES['passbookCopy']['type'], $allowedTypes))
   {
      if ($file_size < 550000)
      { 
         $date=date('Y-m-d');  
         $string = bin2hex(openssl_random_pseudo_bytes(4));
         $file_data = file_get_contents($file_tmp);
         $file_name = $IDEmployee."_".strtotime($date)."_".$string."_".basename($_FILES['passbookCopy']['name']);
         $destdir = '/Images/Staff/bankpassbook';
         ftp_chdir($conn_id, "/Images/Staff/bankpassbook/") or die("Could not change directory");
         ftp_pasv($conn_id,true);
         ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
         ftp_close($conn_id);
         $insertExp="UPDATE Staff SET Bankpassbookpath='$file_name' where IDNo='$IDEmployee'";
         $result = sqlsrv_query($conntest, $insertExp);
         if($result==true)
         {
            echo "1";
         }
         else
         {
            echo "0";
         }
      }
      else
      {
         echo "2"; // size 500kb
      }
   }else{
      echo "3"; // file format
   }
   sqlsrv_close($conntest);
}
else{
   
   
}
}