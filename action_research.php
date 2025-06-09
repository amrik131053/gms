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
       include "connection/connection.php";
   $CurrentExaminationGetDate=date('Y-m-d');
   $EmployeeID=$_SESSION['usr'];
   if ($EmployeeID==0 || $EmployeeID=='') 
      {?>
<script type="text/javascript">
window.location.href = "index.php";
</script>
<?php }
   
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
        $code=$_POST['code'];
     
        if($code==3 || $code==4)
        {
            include "connection/ftp-erp.php";
        }

        if ($code == 1) {
         $search = isset($_POST['search']) ? trim($_POST['search']) : '';
         $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
         $limit = 10;
         $offset = ($page - 1) * $limit;
     
         $where = "WHERE Status = '0'";
         if ($search != '') {
             $search = str_replace("'", "''", $search); // prevent SQL injection
             $where .= " AND (PaperTitle LIKE '%$search%' OR AuthorName LIKE '%$search%' OR IDNo LIKE '%$search%')";
         }
     
         // Get total count
         $countQuery = "SELECT COUNT(*) AS Total FROM Repository $where";
         $countResult = sqlsrv_query($conntest, $countQuery);
         $totalRows = sqlsrv_fetch_array($countResult)['Total'];
         $totalPages = ceil($totalRows / $limit);
     
         // Get paginated records
         $query = "SELECT * FROM (
             SELECT *, ROW_NUMBER() OVER (ORDER BY ID DESC) AS RowNum 
             FROM Repository $where
         ) AS T WHERE T.RowNum BETWEEN " . ($offset + 1) . " AND " . ($offset + $limit);
     
         $result = sqlsrv_query($conntest, $query);
     
         ob_start();
         echo "<table class='table table-bordered'><thead><tr>
               <th>SrNo</th><th>IDNo</th><th>Author Name</th><th>Title</th><th>Faculty</th><th>Journal</th><th>Date</th><th>DOI</th><th>File</th><th>Action</th>
               </tr></thead><tbody>";
               $sr = $offset + 1; 
         while ($row1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
             $college = '';
             $stmt2 = sqlsrv_query($conntest, "SELECT CollegeName FROM MasterCourseCodes WHERE CollegeID='" . $row1['Faculty'] . "'");
             if ($row12 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
                 $college = $row12['CollegeName'];
             }
             echo "<tr>
                     <td>{$sr}</td>
                     <td>{$row1['IDNo']}</td>
                     <td>{$row1['AuthorName']}</td>
                     <td style='width:30%'>{$row1['PaperTitle']}</td>
                     <td>{$college}</td>
                     <td>{$row1['Journal']}</td>
                     <td>" . ($row1['DateofPublication'] ? $row1['DateofPublication']->format('d-m-Y') : '') . "</td>
                     <td>{$row1['DOI']}</td>
                     <td><a href='http://erp.gku.ac.in:86/Images/Repository/{$row1['Documents']}' target='_blank'><i class='fa fa-eye'></i></a></td>
                     <td><i class='fa fa-upload' data-toggle='modal' data-target='#exampleModal_update' onclick='updatePpr({$row1['ID']})'></i></td>
                   </tr>";
                   $sr++;
         }
     
         echo "</tbody></table>";
         $tableHTML = ob_get_clean();
     
         // Generate pagination HTML
         ob_start();
         echo '<nav><ul class="pagination justify-content-center mb-0">';
         for ($i = 1; $i <= $totalPages; $i++) {
             $active = ($i == $page) ? 'active' : '';
             echo "<li class='page-item $active'><a class='page-link' href='javascript:void(0)' onclick='load_data($i)'>$i</a></li>";
         }
         echo '</ul></nav>';
         $paginationHTML = ob_get_clean();
     
         echo json_encode([
             'table' => $tableHTML,
             'pagination' => $paginationHTML
         ]);
     }
     

else if($code==2)
{

	$ID=$_POST['id'];
?>

<?php 
      $sr=1;
   $query = "SELECT * FROM Repository where ID='$ID' order by ID desc";
       $result = sqlsrv_query($conntest,$query);
       if($row1 = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
        ?>
<form action="action_research.php" method="post">
    <input type="hidden" value="4" name="code">
    <input type="hidden" value="<?=$ID;?>" name="ID">
    <label>Employee ID</label>
    <input type="text" name="" class="form-control" value="<?=$row1['IDNo'];?>">
    <label>Name</label>
    <input type="text" class="form-control" name="pprAuthupdate" value="<?=$row1['AuthorName'];?>">
    <label>Paper Title</label>
    <textarea class="form-control" name="pprTitleupdate"><?=$row1['PaperTitle'];?></textarea>
    <input type="hidden" name="" value="<?=$row1['Faculty'];?>">
    <label>Name of Journal</label>
    <textarea class="form-control" name="pprJournalupdate"> <?=$row1['Journal'];?></textarea>
    <label>Date of Publication :</label>
    <?php if($row1['DateofPublication']!=''){echo $row1['DateofPublication']->format('d-m-Y');
            } ?><br>
    <label>Upload File</label>
    <input type="file" class="form-control" name="pprAttachupdate">
    <br>
    <button type="button" class="btn btn-success" onclick="uodateSubmit(this.form);">Update Record</button>
</form>
<?php
}

}
elseif($code==3) 
{
$IDNo=$_POST['IDNo'];
$pprTitle=$_POST['pprTitle'];
$pprAuth=$_POST['pprAuth'];
$facultyId=$_POST['facultyId'];
$pprJournal=$_POST['pprJournal'];
$pprPublish=$_POST['pprPublish'];
$pprLink=$_POST['pprLink'];
$file_name = $_FILES['pprAttach']['name'];
$file_tmp = $_FILES['pprAttach']['tmp_name'];
$file_size =$_FILES['pprAttach']['size'];
$file_type = $_FILES['pprAttach']['type'];
$accepted_type = 'application/pdf';
$date=date('Y-m-d');  
if($file_type == $accepted_type){  
 $string = bin2hex(openssl_random_pseudo_bytes(4));
    $file_name = $_FILES['pprAttach']['name'];
      $file_tmp = $_FILES['pprAttach']['tmp_name'];
      $type = $_FILES['pprAttach']['type'];
       $file_data = file_get_contents($file_tmp);
         $file_title_clean = preg_replace('/\s+/', '_', $pprTitle); // Replaces spaces with underscores
$file_name_raw = basename($_FILES['pprAttach']['name']);
$file_name_clean = preg_replace('/\s+/', '_', $file_name_raw); // Clean original filename
$file_name = $EmployeeID . "_" . $file_title_clean . "_" . $file_name_clean;
     $destdir = 'Images/Repository';
     ftp_chdir($conn_id, "Images/Repository/") or die("Could not change directory");
     ftp_pasv($conn_id,true);
    ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
ftp_close($conn_id);
    echo   $InsertReseatch="INSERT into Repository (IDNo,PaperTitle,AuthorName,Faculty,Journal,DateofPublication,DOI,Documents,Status)
 VALUES('$IDNo','$pprTitle','$pprAuth','$facultyId','$pprJournal','$pprPublish','$pprLink','$file_name','0')";
  $InsertResearchPpr=sqlsrv_query($conntest,$InsertReseatch);
  
                if($InsertResearchPpr==true)
                {
                    echo "1";
                }
                else
                {
                    echo "0";
                } 
            }else{
                echo "2";
            }
            
            sqlsrv_close($conntest);
}
elseif($code == 4) {
   $ID = $_POST['ID'];
   $pprTitle = $_POST['pprTitleupdate'];
   $pprAuth = $_POST['pprAuthupdate'];
   $pprJournal = $_POST['pprJournalupdate'];
   $pprTitle = str_replace("'", "''", $pprTitle);
   $pprAuth = str_replace("'", "''", $pprAuth);
   $pprJournal = str_replace("'", "''", $pprJournal);
   $date = date('Y-m-d');  

   $fileUploaded = isset($_FILES['pprAttachupdate']) && $_FILES['pprAttachupdate']['name'] != '';

   if ($fileUploaded) {
       $file_name = $_FILES['pprAttachupdate']['name'];
       $file_tmp = $_FILES['pprAttachupdate']['tmp_name'];
       $file_type = $_FILES['pprAttachupdate']['type'];
       $accepted_type = 'application/pdf';

       if ($file_type == $accepted_type) {
           $file_title_clean = preg_replace('/\s+/', '_', $pprTitle);
           $file_name_raw = basename($_FILES['pprAttachupdate']['name']);
           $file_name_clean = preg_replace('/\s+/', '_', $file_name_raw);
           $file_name = $EmployeeID . "_" . $file_title_clean . "_" . $file_name_clean;

           $destdir = 'Images/Repository';
           ftp_chdir($conn_id, "Images/Repository/") or die("Could not change directory");
           ftp_pasv($conn_id, true);
           ftp_put($conn_id, $file_name, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
           ftp_close($conn_id);

            $UpdateResearch = "UPDATE Repository  SET PaperTitle = '$pprTitle', AuthorName = '$pprAuth', Journal = '$pprJournal', Documents = '$file_name', Status = '0'
               WHERE ID = '$ID'";
       } else {
           echo "2"; 
           exit;
       }
   } else {

         $UpdateResearch = "UPDATE Repository SET PaperTitle='$pprTitle',AuthorName='$pprAuth',Journal='$pprJournal',Status='0'  WHERE ID = '$ID'";
   }
   $UpdateResearchPpr = sqlsrv_query($conntest, $UpdateResearch);


   if ($UpdateResearchPpr === false) {
       echo "0";
   } 
   else 
   {
       echo "1";
      
   }
 
   

   sqlsrv_close($conntest);
}
}
?>