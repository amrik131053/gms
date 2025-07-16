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
   {     include "connection/connection.php";
      $getCurrentExamination="SELECT * FROM ExamDate where ExamType='Regular' AND Type='Student'";
      $getCurrentExamination_run=sqlsrv_query($conntest,$getCurrentExamination);

      if ($getCurrentExamination_row=sqlsrv_fetch_array($getCurrentExamination_run,SQLSRV_FETCH_ASSOC))
      {

$CurrentExamination=$getCurrentExamination_row['Month'].' '.$getCurrentExamination_row['Year'];

      }


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
         $code=$_POST['flag'];
     
        if($code==1 || $code==2 || $code==3 || $code==4 || $code==7 || $code==8|| $code==26.2 || $code==28)
        {
            include "connection/ftp-erp.php";
        }
 // Mobile Stock //
        elseif($code==25.3)

   {
     ?><div class="row">
         <div class="col-lg-3">
        <div class="card">
        <div class="card-header">
       
         <b>Add Article</b>
        
       </div>
        </div>
           
              <label>Name of Article</label>
          
                
               <input type="text" name="ArticleName" id="ArticleName" placeholder="Name of Article"  class="form-control">

<label>Description</label>
                <input type="text" name="ArticleSpecification" id='ArticleSpecification' placeholder="Specification"  class="form-control">  
<br>
<button onclick="submitarticle()" class="btn btn-primary">Add</button>
              </div>



               <div class="col-lg-9">
                    <div class="card">
        <div class="card-header">
       
         <b>Manage Article</b>
</div>
         <div id="showarticle"><div>
        
       </div>
        </div>
               </div>

                
                 
          </div>  
         </div>

  <?php 
  sqlsrv_close($conntest); 
}

elseif($code==25.4)

   {
 $ArticleName=$_POST['ArticleName'];
 $ArticleSpecification=$_POST['ArticleSpecification'];
   
 $update1="insert into mobilestockarticle(Name,Description,CreatedBy,CreatedDate,Status)Values
    ('$ArticleName','$ArticleSpecification','$EmployeeID','$timeStampS','0')";




$addrun=mysqli_query($connection_s,$update1);

mysqli_close($connection_s);
echo "1";
      }



elseif($code==25.5)

   {?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created By</th>
            <th>Created Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
         $sr=1;
         $get_group="SELECT * FROM mobilestockarticle";
         $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
            $status=$row['Status'];
            if($status=='1'){
              $show='ON';
              $color='';            
            }
            else
            {
                $show='OFF';   
                $color='red';          
            }
            ?>
        <tr>
            <th><?=$sr;?></th>
            <th>
                <b><input type="text" class="form-control" id='arname<?=$row['ID'];?>' value="<?=$row['Name'];?>" onblur='chnageName(<?=$row['ID'];?>)'></b>
            </th>
            <th><b><?=$row['Description'];?></b></th>
             <th><b><?=$row['CreatedBy'];?></b></th>
             <th><b><?=$row['CreatedDate'];?></b></th>
            <th>

                <div class="form-check form-switch">
                    <select class="form-control" id='toggleForm<?=$row['ID'];?>' onchange="updateStatus(<?=$row['ID'];?>)" style="color: <?=$color;?>">
                         <option value="<?=$status;?>"><?=$show;?></option>
  <option value="1">ON</option>
   <option value="0">OFF</option>
                    </select>
   
 
</div></th>
        </tr>
        <?php 
         $sr++; }
           ?>
    </tbody>
</table>


<?php
      }
      elseif($code==25.6)

   {
 $id=$_POST['id'];
$status=$_POST['status'];

 $asd="Update mobilestockarticle set Status='$status' where ID='$id'";
   
$addrun=mysqli_query($connection_s,$asd);



mysqli_close($connection_s);

echo "1";
      }

// Add Stock //
      elseif($code==25.7)

   {
     ?>
     <div class="row">
         <div class="col-lg-3">
        <div class="card">
        <div class="card-header">
       
         <b>Add Stock</b>
        
       </div>
        </div>
           
              <label>Name of Article</label>
              <select class="form-control" id='articlecode' onchange="showdiv(this.value);">
                <option value="">Select</option>
              <?php $get_group="SELECT * FROM mobilestockarticle";
         $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {?>
            <option value="<?=$row['ID'];?>"><?=$row['Name'];?></option>
            <?php }?>

</select>
           
<div id="showMobile" style="display: none;">
    <label>Mobile Model</label>
<input type="text" id="mobile_model" class="form-control" name="Mobile Model">
 <label>Brand</label>
<input type="text" id="brand" class="form-control" name="brand">
 <label>Configration</label>
<input type="text" id="configuration" class="form-control" name="configuration">
</div>
<div id="showSIM" style="display: none;">
    <label>SIM Number</label>
<input type="text" id="sim_number" class="form-control" name="sim_number">

</div>
<!-- <div id="articlecode">

<label>Quantity</label>
                <input type="number"  id='quantity' placeholder=""  class="form-control">
</div> -->

<br>
<button onclick="submitstock()"  class="btn btn-primary">Add</button>
              </div>



               <div class="col-lg-9">
                    <div class="card">
        <div class="card-header">
       
         <b>Master Stock</b>
</div>
         <div id="showstock">
        </div>        
        </div>  
        </div> 

  <?php 
  sqlsrv_close($conntest); 
}

elseif($code==25.8)

   {?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Model</th>
            <th>Brand</th>
            <th>Configration</th>
            <th>Sim Number</th>
             <th>Status</th>
             <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
         $sr=1;
         $get_group="SELECT  *,ms.Status as mtatus,ms.ID as mID FROM  mobilestockadd  as ms inner join mobilestockarticle as ma  on ma.ID=ms.ArticleID order by ms.Status,ms.ID ASC";
     $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
            
            ?>        <tr>
            <th><?=$sr;?></th>
            <th>
            <b><?=$row['Name'];?>(<?=$row['mID'];?>)</b>
            </th>
             <th><b><?=$row['mobile_model'];?></b></th>
             <th><b><?=$row['brand'];?></b></th>
             <th><b><?=$row['configuration'];?></b></th>
             <th><b><?=$row['sim_number'];?></b></th>
             <th><b>
                <?php if($row['mtatus']=='1')
             {
                echo "Issued";
             }
             else
                {

                }
            ?></b></th>
           

         <th>
            <?php if($row['Action']==1){

// ECHO  "<b class='text-danger'>Suspended</b>";

            }

            else{
              ?>

<button class="btn btn-danger" onclick="suspend(<?=$row['mID'];?>);">Suspend</button>

              <?php
            }?>
          </th>
           <th>
            <?php if($row['Action']==0){
// ECHO  "<b class='text-danger'>Active</b>";

            }
            else{
              ?>

<button class="btn btn-success" onclick="Active(<?=$row['mID'];?>);">Active</button>

              <?php
            }?>
          </th> 
             
          
        </tr>
        <?php
         $sr++; }
           ?>
    </tbody>
</table>




<?php
      }

     elseif($code == 25.9) {

    $articlecode = $_POST['articlecode'];
    // $quantity = $_POST['quantity']; // commented out, but if needed, you can include this
    $mobile_model = $_POST['mobile_model'];
    $brand = $_POST['brand'];
    $configuration = $_POST['configuration'];
    $sim_number = $_POST['sim_number'];

    $result_z = mysqli_query($connection_s, 
        "INSERT INTO mobilestockadd 
       (ArticleID, mobile_model, brand, configuration, sim_number,Status,Action)Add commentMore actions
        VALUES ('$articlecode', '$mobile_model', '$brand', '$configuration', '$sim_number','0','0')"
    );

    // Optional: check if insert was successful
    if ($result_z) {
       
    } else {
        echo "Error: " . mysqli_error($connection_s);
    }

    mysqli_close($connection_s);
}


elseif($code==26)


   {

    $code_access=$_POST['code_access'];?>
<div class="row">
         <div class="col-lg-3">
        <div class="card">
        <div class="card-header">
       
         <b>Issue Request</b>
        
       </div>
       <script>

            </script><br>
               <div class="btn-group input-group-sm" style="text-align:center;">

 <input type="radio"   id="ossm1"  onclick="emc1_hide();" name="Employee"   checked="" value="0" required="" hidden>  

   <input type="radio"  id="ossm"  name="Employee"   required=""  onclick="emc1_show();" value="1" name="empc1" hidden>  

                       <!-- <label for="ossm" class="btn btn-xs">Other</label> -->
    </div>
                      <!-- <div class="col-md-12" style="display: none;" id="lect_div">   
                        <label for="ossm1" class="btn  btn-xs"> Employee</label>

                      <select class="form-control" id='emptype'>
                         
                          <option value="Guest">Guest</option>
                            <option value="Field Team">FieldTeam</option>
                              <option value="Consultant">Consultant</option>
                                <option value="Other">Other</option>

                      </select>   
  <label>Name <span style="color: red">*</span></label>
  <input type="text" name="name_visitor" id="empNames" class="form-control">
  
  <label>Detail <span style="color: red">*</span></label>
  <input type="text"  id="empDetail" class="form-control">
 
  
  </div> -->
<form action="action_j.php" method="post" enctype="multipart/form-data">
    <input type="hidden" value="26.2" name="flag">
  <div class="col-md-12"  id="lect_div1">
 <label>Employee ID</label>
<input type="text" class="form-control" name="empid" id='empID' onblur="emp_detail_verify1(this.value)" >
<span id='emp-data'  style="font-weight:bold"></span><br>
<input type="hidden" id="empdata" name="emp_name">
<label>Article Type</label>
<select class="form-control" name="empName" id="empName" onchange="bus(this.value)"> 
<option value>Select</option>

<?php  
$getDrop="SELECT * FROM mobilestockarticle where status='1' ";
$getDropRun=mysqli_query($connection_s,$getDrop);
while($row=mysqli_fetch_array($getDropRun))
{
?>
<option value="<?=$row['ID'];?>"><?=$row['Name'];?></option>
<?php }?>
<!-- <input type="text" class="form-control"  placeholder="Number" id='empDescription' > -->

<br>
                         
</select>
<label>Article Discription</label>
<select class="form-control" id="mobileData" name="mobileData" > 
</select>

<label>Discription</label>
<input type="text" class="form-control" name="remarks" id='remarks' >

<label>Attachment (Optional)</label>
        <input type="file" class="form-control" id="fileAtt" name="fileatt">
</div>
<br>       
<br>
<button type="button" onclick="IssueStock(this.form)" class="btn btn-primary">Issue Stock</button>

              </div>
</form>
    </div>

               <div class="col-lg-9">
                    <div class="card">
        <div class="card-header">
       
         <b>Master Stock</b>
</div>
         <div id="issuedstocklist"><div>
        
       </div>
        </div>
               </div>

                
                 
          </div>  
         </div>

  <?php 
  sqlsrv_close($conntest); 

      }

elseif($code==26.1)

   {
 $id=$_POST['id'];
$ArticleName=$_POST['ArticleName'];

$get_group="SELECT * FROM mobilestockarticle where  ID='$id'";   

$sr=1;
         $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
 $oldname=$row['Name'];

}
 $asd="Update mobilestockarticle set Name='$ArticleName' where ID='$id'";
   
$addrun=mysqli_query($connection_s,$asd);

 $update1="insert into trackchnages(userID,newname,oldname,createddate)Values('$EmployeeID','$ArticleName','$oldname','$timeStamp')";

$addrun=mysqli_query($connection_s,$update1);

mysqli_close($connection_s);


      }

if ($code=='26.2')
 {
 
    $empID = $_POST['empid'];
    $empName = $_POST['empName'];
    $empdata = $_POST['emp_name'];
    $mobileData = $_POST['mobileData'];
    $remarks=$_POST['remarks'];
    $photo = $_FILES["fileatt"]["name"];
    $date = date('Y-m-d');
    $time = date('h:i:s');
    $string = bin2hex(openssl_random_pseudo_bytes(4));

    if ($photo) {
        $photoTmp = $_FILES["fileatt"]["tmp_name"];
        $file_type = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($file_type, $allowed_types)) {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            exit;
        }

  $ImageName = $empID . '_' . $string . '.' . $file_type;

$destdir = '/Images/mobilestock';
    ftp_chdir($conn_id, "/Images/mobilestock") or die("Could not change directory");
    ftp_pasv($conn_id,true);
    ftp_put($conn_id, $ImageName, $photoTmp, FTP_BINARY) or die("Could not upload to $ftp_server");
    ftp_close($conn_id);
       
    } 
    else {
        $ImageName = "";
    }
           $insert="insert into mobilestockledger(IDNo,Name,StockID,ArticleID,CreatedDate,CreatedBy,Status,file,Remarks)Values
                                        ('$empID','$empdata','$mobileData','$empName','$timeStamp','$EmployeeID','0','$ImageName','$remarks')";

    $addrun=mysqli_query($connection_s,$insert);

$Status="UPDATE mobilestockadd set Status='1' where ID='$mobileData'";
  $StatusRu=mysqli_query($connection_s,$Status);

      }



    elseif($code==26.3)

   {?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
             
            <th>Employee</th>
           <th>Type</th>
            <th>Model/Sim No</th>
              <th>Issued By</th>
              <th>Remarks</th>
              <th>View</th>

           
            
        </tr>
    </thead>
    <tbody>
        <?php 
         $sr=1;
          $get_group="SELECT *,mobilestockarticle.Name as AName,mobilestockledger.Name as EName,mobilestockledger.ID as ledid FROM  mobilestockledger inner join mobilestockadd ON mobilestockledger.StockID=mobilestockadd.ID inner join mobilestockarticle ON mobilestockarticle.ID=mobilestockadd.ArticleID  where mobilestockledger.Status='0' order by mobilestockledger.ID desc limit 20";
     $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
            
            ?>        <tr>
            <th><?=$sr;?></th>
         
            <th>
                <b><?=$row['EName'];?>(<?=$row['IDNo'];?>)</b>
            </th>
            <th>
                <b><?=$row['AName'];?></b>
            </th>
           
             
               <th><b><?=$row['mobile_model'];?><?=$row['sim_number'];?></b></th>
                <th><b><?=$row['CreatedBy'];?></b></th>
                <th><b><?=$row['Remarks'];?></b></th>

                   <th><b><i class="fa fa-eye" onclick="viewlist(<?=$row['ledid'];?>)" data-toggle="modal" data-target="#exampleModal"></i>
 </b></th>
             
          
        </tr>
        <?php
         $sr++; }
           ?>
    </tbody>
</table>


<?php
      }

elseif($code==26.4)

   { 

    $id=$_POST['id'];

    ?>
<table class="table">
   
    <tbody>
       
        <?php 
         $sr=1;
    $get_group="SELECT *,mobilestockarticle.Name AS articalName ,mobilestockledger.Name as sName,mobilestockledger.StockID as stockid,mobilestockledger.ID as stockupid From mobilestockledger inner join mobilestockadd on mobilestockledger.StockID=mobilestockadd.ID 
inner JOIN mobilestockarticle ON mobilestockadd.ArticleID=mobilestockarticle.ID where mobilestockledger.ID='$id'";
     $get_group_run=mysqli_query($connection_s,$get_group);
         while($row=mysqli_fetch_array($get_group_run))
         {
            
            ?>        <tr>
            <th>Name :</th>
            
            <th>
                <b><?=$row['sName'];?>(<?=$row['IDNo'];?>)</b>
            </th>
           </tr>
              <tr>
            <th>Type :</th>
            
            <th>
                <b><?=$row['articalName'];?></b>
            </th>
           </tr>

 <tr>
            <th> Details :</th>
            
            <th>
                <b><?=$row['sim_number'];?><?=$row['mobile_model'];?>/ <?=$row['brand'];?> <?= $row['configuration'];?></b>
            </th>
           </tr>

           <tr>
            
            
                   
          
        </tr>
        <?php
        $stockid=$row['stockid'];
        $ledgerid=$row['stockupid'];
        $link=$row['file'];

        
         $sr++; }
           ?>
       <tr><td colspan="2"> <button type="button" class="btn btn-success" onclick="return_stock(<?=$ledgerid;?>,<?=$stockid;?>)" >Return</button>
       <a href="http://erp.gku.ac.in:86//Images/mobilestock/<?=$link;?>" target="_blank"><button type="button" class="btn btn-warning">View File</button></a>
       <button type="button" class="btn btn-primary" onclick="toggleDiv()">Transfar</button>
    <!-- Transfar Stock -->
     <div id="myDiv">
       <form action="action_j.php" method="post" enctype="multipart/form-data">
                <input type="hidden" value="28" name="flag">
                 <input type="hidden" value="<?=$id;?>" name="id">
                   <input type="hidden" value="<?=$stockid;?>" name="stockid">
                     <input type="hidden" value="<?=$ledgerid;?>" name="ledgerid">
            <div class="col-md-12"  id="lect_div1">
                <label>Employee ID</label>
                <input type="text" class="form-control" name="empid" id='empID' onblur="emp_detail_verify1(this.value)" >
                <span id='emp-data'  style="font-weight:bold"></span><br>
                <input type="hidden" id="empdata" name="name"> 
                <label>Discription</label>
                <input type="text" class="form-control" name="remarks" id='remarks' >
                <label>Attachment (Optional)</label>
                <input type="file" class="form-control" id="fileAtt" name="fileatt">
            </div>
                    <br>       
                    <br>
            <button onclick="transferStock(this.form)"  class="btn btn-primary">Issue</button>
            </div>
            </form>
            </div></td>
                  </tr>
                    
                    

                    
    </tbody>
</table>

<?php
      }

      elseif($code==26.5)

   {
 $id=$_POST['id'];
  $stock=$_POST['stockid'];
 

 $asd="UPDATE mobilestockledger set Status='1' where ID='$id'";
   
$addrun=mysqli_query($connection_s,$asd);

 $asd1="UPDATE mobilestockadd set Status='0' where ID='$stock'";
   
$addrun1=mysqli_query($connection_s,$asd1);



echo 1;
    }
// prepare Degree //
if($code==31)
               {
                $sub_data=$_POST['sub_data']; 

               

               if($sub_data==1) 
               {
                  $univ_rollno=$_POST['rollNo'];


                   if($_POST['rollNo'] !=''  ANd is_numeric($univ_rollno)) 
                   {




                $list_sql = "SELECT ExamForm.SemesterID,
ExamForm.CourseID,
ExamForm.CollegeID,
ExamForm.Batch,  Admissions.ClassRollNo,ExamForm.Course,ExamForm.ReceiptDate,ExamForm.SGroup, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
               FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where (Admissions.UniRollNo='$univ_rollno' or Admissions.ClassRollNo='$univ_rollno' or Admissions.IDNo='$univ_rollno') ANd ExamForm.Type='Regular' AND Admissions.Status='1' ORDER BY ExamForm.ID DESC"; 
}
else if ($_POST['rollNo'] !='') 
{
  $list_sql = "SELECT ExamForm.SemesterID,
ExamForm.CourseID,
ExamForm.CollegeID,
ExamForm.Batch,  Admissions.ClassRollNo,ExamForm.Course,ExamForm.ReceiptDate,ExamForm.SGroup, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
               FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where (Admissions.UniRollNo='$univ_rollno' or Admissions.ClassRollNo='$univ_rollno' )AND Admissions.Status='1' ANd ExamForm.Type='Regular' ORDER BY ExamForm.ID DESC"; 
}

 else
            {
               $list_sql = "SELECT TOP 150  Admissions.ClassRollNo, ExamForm.Course,ExamForm.ReceiptDate,ExamForm.SGroup,, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo ORDER BY ExamForm.ID DESC"; 
            }

            }
 else if($sub_data==2)
{

$College = $_POST['College'];
$Course = $_POST['Course'];
  $Batch = $_POST['Batch'];
  $Semester = $_POST['Semester'];
  $Type = $_POST['Type'];
    $Group = $_POST['Group'];
        $Examination = $_POST['Examination'];
         $OrderBy = $_POST['OrderBy'];
if($OrderBy!='')
{
$list_sql = "SELECT ExamForm.SemesterID,ExamForm.DegreeStatus,
ExamForm.CourseID,
ExamForm.CollegeID,
ExamForm.Batch,  Admissions.ClassRollNo,ExamForm.Course,ExamForm.ReceiptDate,ExamForm.SGroup, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination'ANd ExamForm.Status='8' AND Admissions.Status='1' ANd Type='Regular' ORDER BY Admissions.$OrderBy";
}
else
{
   $list_sql = "SELECT ExamForm.SemesterID,ExamForm.DegreeStatus,
ExamForm.CourseID,
ExamForm.CollegeID,
ExamForm.Batch,   Admissions.ClassRollNo,ExamForm.Course,ExamForm.ReceiptDate,ExamForm.SGroup, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination'ANd ExamForm.Status='8' AND Admissions.Status='1' ANd Type='Regular' ORDER BY Admissions.UniRollNo";
}

}
?>

<table class="table table-bordered" id="example">
                                <thead>
                                    <tr >
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Uni Roll No</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Sem</th>
                                        <th>Batch</th>
                                        <th>Examination</th>
                                        <th>Type</th>
                                        <th>Group</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                       
                                       
                                    </tr>
                                </thead>
                                <tbody>
<?php
                $list_result = sqlsrv_query($conntest,$list_sql);
                    $count = 1;
                        $DeclareType='2';
                        $MinDeclareType='2';
               if($list_result === false)
                {
               die( print_r( sqlsrv_errors(), true) );
               }
                while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                   {
                     $clr="";
                                                 
                       $DegreeStatus=$row['DegreeStatus'];
                      
                    if($DegreeStatus<0)
                    {
                       $clr="warning";
                      
                    }
                   else if($DegreeStatus>0)
                   {
                   $clr="success";
                  
                    }
                  
                      else{   
                        $clr="";
                    }
                   
                $Status= $row['Status'];
                $issueDate=$row['SubmitFormDate'];

                ?>
                <tr class="bg-<?=$clr;?>">
                <td><?= $count++;?>
            
               </td>
                <td><?= $row['ID']?></td>
                
                <td>
                 
                <a href=""  onclick="edit_stu(<?= $row['ID'];?>,<?=$DeclareType;?>,<?=$MinDeclareType;?>)" style="color:#002147; text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl">
                  <?=$row['UniRollNo'];?>/<?=$row['ClassRollNo'];?> </a>
             </td>
             <td>
                <b><a href=""  onclick="edit_stu(<?= $row['ID'];?>,'<?=$DeclareType;?>','<?=$MinDeclareType;?>')" style="color:#002147; text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl">
                  <?=$row['StudentName'];?></a></b>
          </a>
                   </td>
      <?php
                echo "<td>".$row['Course']."</td>";
                echo "<td>".$row['Semesterid']."</td>";
                echo "<td>".$row['Batch']."</td>";
                echo "<td>".$row['Examination']."</td>";
                     if($row['ReceiptDate']!='')
                     {
                       $rdate=$row['ReceiptDate']->format('Y-m-d');
                     }
                     else 
                     {
                     $rdate='';
                     }
?>
               <td>
                <?=$row['Type'];?></td>
                <td><?= $row['SGroup'];?></td>

                <td  style="width:100px"><center><?php 

 if($Status==-1)
                {
                  echo "Forward to Registration";

                }
                elseif($Status==0)
                {
                  echo "Draft";
                }elseif($Status==1)
                {
                  echo 'Forward<br>to<br>Department';
                }

                elseif($Status==2)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Dean</b>";
                }
                 elseif($Status==3)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Dean</b>";
                }

 elseif($Status==4)
                {
                  echo 'Forward <br>to<br> Account';
                }
 elseif($Status==5)
                {
                  echo 'Forward <br>to<br> Examination<br> Branch';
                }

 elseif($Status==6)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Accountant</b>";
                }
      elseif($Status==7)
                {
                  echo "<b style='color:red'>Rejected_By<br>Examination<br>Branch</b>";
                }           

elseif($Status==8)
                {
                  echo "<b style='color:green'>Accepted</b>";
                }   ?>        
</center>
               </td>
                
               <td> <?php if($issueDate!='')
               {
               echo $t= $issueDate->format('Y-m-d'); 

               }
               else{ 

               }?>

              </td>
  
               </tr>
           <?php 
            }?>

            </tbody>
        </table>
            <?php
    
        
    sqlsrv_close($conntest);
   }



elseif($code==32)
   {
  $id = $_POST['id'];
 
  
  $list_sqlw5 ="SELECT * from ExamForm Where ID='$id'";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);
        $i = 1;
        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
             $IDNo=$row5['IDNo'];
             $type=$row5['Type'];
             $SemesterID=$row5['Semesterid'];
             $examination=$row5['Examination'];
             $examinationss=$row5['Examination'];
             $sgroup= $row5['SGroup'];
             $receipt_date=$row5['ReceiptDate'];
             $receipt_no=$row5['ReceiptNo'];
             $formid=$row5['ID'];
             if($receipt_date!='')
             {
              $rdateas=$receipt_date->format('Y-m-d');}
           else
            {
              $rdateas='';        
            } 
       }
 $sql = "SELECT  * FROM Admissions where IDNo='$IDNo'";
$stmt1 = sqlsrv_query($conntest,$sql);
        while($row6 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
         {
            $IDNo= $row6['IDNo'];
            $ClassRollNo= $row6['ClassRollNo'];
            $img= $row6['Image'];
            $gender=$row6['Sex'];
            $UniRollNo= $row6['UniRollNo'];
            $name = $row6['StudentName'];
            $father_name = $row6['FatherName'];
            $mother_name = $row6['MotherName'];
            $course = $row6['Course'];
            $email = $row6['EmailID'];
            $phone = $row6['StudentMobileNo'];
            $batch = $row6['Batch'];
            $college = $row6['CollegeName'];
            $CourseID=$row6['CourseID'];
            $Batch=$row6['Batch'];
            $CollegeID=$row6['CollegeID'];


          }



?>



 <div class="card-body table-responsive ">
<table class="table table-bordered"  border="1">
 <tr style="border: 1px black solid" height="30" >
 <td style="padding-left: 10px"><b>Rollno: </b></td>

 <input type="hidden" value="<?=$IDNo;?>" name="" id='userid'>
 <td> <?php echo $UniRollNo;?>/<?php echo $ClassRollNo;?>  &nbsp;(<?=$IDNo;?>)</td>
 <td colspan="1"><b>Name:</b> </td>
 <td colspan="4"><?=$name;?></td>
 <td rowspan="3" colspan="2" style="border:0">
                            <?php echo '<img src="'.$BasURL.'Images/Students/'.$img.'" height="150" width="120" class="img-thumnail" />';?>
             </td>
 </tr>
 <tr style="border: 1px black solid"height="30">
   <td style="padding-left: 10px"><b>Father Name:</b></td>
   <td colspan="1"><?php echo $father_name;?></td>
   <td><b>Mother Name:</b></td>
   <td colspan="4"><?=$mother_name;?></td>
 </tr>
 <tr style="border: 1px black solid"height="30">
   <td style="padding-left: 10px"><b>College:</b></td>
   <td colspan="1"><?php echo $college;?></td>
   <td><b>Course:</b></td>
   <td colspan="4"><?=$course;?></td>
 </tr>
        


</tr>
</table>
<table class="table table-striped" border="1">



<?php 
$srNo=1;
$search=$UniRollNo;
$query = "SELECT * FROM Admissions inner join ResultGKU on Admissions.UniRollNo=ResultGKU.UniRollNo Where  Admissions.UniRollNo='$UniRollNo' AND ResultGKU.SGPA!='NC' Order By Semester ";
?>
    <table class="table">
        <th><input type="checkbox" id="select_all1" onclick="verifiy_select();" class="form-control"></th>

        <th>Semester</th>
        <th>Examination</th>
        <th>SGPA</th>
        <th>Total Credit</th>
        <th>Sub Total</th>
        <th>Type</th>
        <th>Declare Date</th>
       <?php 
       $CGPA=0;
$SGPATotal=0;
$creditTotal=0;
       $result = sqlsrv_query($conntest,$query);
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {

$semester=$row['Semester'];
$exam=$row['Examination'];
$Examination=$row['Examination'];
$type=$row['Type'];
$idno=$row['IDNo'];
$accepttype='';

  $acceptstatus="SELECT AcceptType,Status from ExamForm  where  Semesterid='$semester' ANd Examination='$exam' ANd Type='$type' ANd IDNo='$idno'";
 $result1 = sqlsrv_query($conntest,$acceptstatus);
       while($row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC) )
       {
        $accepttype=$row1['AcceptType'];
        $acceptstatus=$row1['Status'];
       }

       ?>
        <tr> <th><input type="checkbox"class="form-control checkbox v_check" value="<?=$row['Sgpa'];?>">
                <input type="hidden"class="checkbox c_check" value="<?=$row['TotalCredit'];?>"></th>
           
            <td><?=$row['Semester'];?></td>
            <td><?=$row['Examination'];?> </td>

           <?php if($accepttype=='1')
            {?><td style="color:red"><b>RLF</b></td>
              
            <?php
        }  else
            {
            ?> <td><?=$row['Sgpa']?></td> 
            <?php
        }?>
            <td><?=$row['TotalCredit'];?></td>
            <td><?=$row['Sgpa']*$row['TotalCredit'];?></td>

            <td><?=$row['Type'];?></td>
            <td>
                <?php if($row['DeclareDate']!='')
{
    $decdate=$row['DeclareDate']->format('d-m-Y');
}else
{
     $decdate='';
}
?>
                <?= $decdate;?></td>
           
            <?php 
     $srNo++;
  $creditTotal=$creditTotal+ $row['TotalCredit'];

 // $SGPATotal=$SGPATotal+$row['TotalCredit']*$row['Sgpa'];

 }

 sqlsrv_close($conntest);
 ?>

<!-- <tR><td colspan="3" ><td> <p style="color: Red"><b><?= number_format($SGPATotal/$creditTotal,2);?></b></p></td>

    <td><?=$creditTotal;?></td>
        <td><?=$SGPATotal;?></td>
<td></td>
<td></td>
    </tR> -->

</table>
<button type="button" class="btn btn-info" onclick="Show_result();">Show Result  <i class="fa fa-view" aria-hidden="true"></i></button>
<input type="hidden"  value="<?=$IDNo;?>" id="post_idno">
<input type="hidden"  value="<?php echo $UniRollNo;?>" id="post_unino">
<input type="hidden"  value="<?=$name;?>" id="post_name">
<input type="hidden"  value="<?php echo $father_name;?>" id="post_fname">
<input type="hidden"  value="<?=$mother_name;?>" id="post_mname">
<input type="hidden"  value="<?php echo $college;?>" id="post_college">
<input type="hidden"  value="<?=$course;?>" id="post_course">
<input type="hidden"  value="<?= $examination;?>" id="post_examination">

<input type="hidden"  value="<?= $CollegeID;?>" id="post_collgeId">
<input type="hidden"  value="<?= $CourseID;?>" id="post_courseid">
<input type="hidden"  value="<?= $Batch;?>" id="Batch">
<input type="hidden"  value="<?= $id;?>" id="eid">
<input type="hidden" value="" id="post_sgpa">

<div class="col-lg-12 " style="border:; font-size: 21.5px; text-align:justify;  ;line-height: 1.6;  font-family: Baskerville Old Face; "><i>
                       <?php 
                          $ge1="son";
                          $ge="daughter";
                          //$ms="Ms.";    
                          //$ms1="Mr.";    
                          
                            if ($gender!='Male') 
                          {
                          $ge="daughter";
                          $ms="Ms.";    // code...
                          } 
                          else{
                          $ge="son"; 
                          $ms="Mr.";    // code...
                          }                                                 
                           ?>
                       <?php  echo $ms."<b> ".$name." </b> ".$ge." of <b>  ".$father_name."</b>, 
                       having completed the requirements for the award of  <b  id='DTypeshow' style='color:red'>___</b> and having passed the prescribed
                        examination held in <b>".$Examination."</b>, has been conferred the<b> <b  id='showCourse' style='color:red'></b> in the specialization of <b  id='Streamshoe' style='color:red'>___</b> with <b>CGPA <b  id='showTotalSGPA' style='color:red'>___</b> on the scale of <b>10</b>.";?></i>
                    </div>
                  
                   
          


        
</div>

 



<div class="col-lg-2">
                               <!--  <button type="button" class="btn btn-info" onclick="button_verify(<?=$UniRollNo;?>)"> <i
                                        class="fa fa-view" aria-hidden="true"></i></button> -->
                            </div>
<?php
} 

elseif($code==33)
    
 {
                  $IDNo = $_POST['IDNo'];
                  $UniRollNo = trim($_POST['UniRollNo']);
                  $Name = ucwords(strtolower($_POST['Name']));
                  $Fname = ucwords(strtolower($_POST['Fname']));
                 
                  $Mname = $_POST['Mname'];
                  $College = $_POST['College'];
                  $Course = $_POST['Course'];
                   $CollegeID = $_POST['CollegeID'];
                  $CourseID = $_POST['CourseID'];
                
                   $Examination = $_POST['Examination'];
                   $SGPA = $_POST['SGPA'];
                   $CourseD=$_POST['CourseD'];
                    $QRCourse=$_POST['QRCourse'];
                    $DType=$_POST['DType'];
                    $Stream=$_POST['Stream'];
                    $eid=$_POST['eid'];
                    $YearOfAdmission=$_POST['YearOfAdmission'];

  $CollegeID=$_POST['CollegeID'];
                    $CourseID=$_POST['CourseID'];
$Batch=$_POST['Batch'];
                    $ExtraRow='a';
                    $Outof='b';
                    $CollegeCsv='c';
                    $Title='d';


               $insert = "INSERT INTO `degree_print` (`UniRollNo`, `CGPA`, `StudentName`, `FatherName`, `RegistrationNo`, `Course`, `Examination`, `ExtraRow`, `Type`, `Stream`, `upload_date`, `Outof`, `CollegeCsv`, `Course1`, `QrCourse`, `Title`,`CollegeID`,`CourseID`,`Batch`) 
                 VALUES ('$UniRollNo', '$SGPA', '$Name', '$Fname', '$UniRollNo', '$Course', '$Examination', '$ExtraRow', '$DType', '$Stream', '$timeStamp','$Outof', '$CollegeCsv', '$CourseD', '$QRCourse', '$Title','$CollegeID','$CourseID','$Batch')";
        
        

 $insert_run = mysqli_query($conn, $insert);
  $Status="UPDATE ExamForm set DegreeStatus='1' where ID='$eid'";

        $result = sqlsrv_query($conntest,$Status);
 }
elseif($code==33.1)
    
 {
                 
                    $eid=$_POST['eid'];
                   
        
        


  $Status="UPDATE ExamForm set DegreeStatus='-1' where ID='$eid'";

        $result = sqlsrv_query($conntest,$Status);
 }
 elseif($code==34)
    
 {
                 
                    $id=$_POST['id'];
          ?>
          <option value="">Select</option>
          <?php         
 $Status="SELECT * FROM mobilestockadd where ArticleID='$id' ANd Status!='1' and Action!='1'";
  $StatusRu=mysqli_query($connection_s,$Status);
while($row=mysqli_fetch_array($StatusRu))
{
    ?>
<option value="<?=$row['ID'];?>"><?=$row['mobile_model'];?><?=$row['sim_number'];?></option>
    <?php
 }
}
elseif($code==25.7)

   {
     ?>
     <!-- <div class="row">
         <div class="col-lg-3">
        <div class="card">
        <div class="card-header">
       
         <b>Add Stock</b>
        
       </div>
        </div> -->
           
              


<!-- <div id="articlecode">

<label>Quantity</label>
                <input type="number"  id='quantity' placeholder=""  class="form-control">
</div> -->



  <?php 
  
}

else if ($code == 28)
 {
    $empID = $_POST['empid'];
    $id = $_POST['id'];
    // $empName = $_POST['empName'];
    $empdata = $_POST['name'];
    // $mobileData = $_POST['mobileData'];
    $remarks=$_POST['remarks'];
    $stockid=$_POST['stockid'];
    $ledgerid=$_POST['ledgerid'];
    $photo = $_FILES["fileatt"]["name"];
    $date = date('Y-m-d');
    $time = date('h:i:s');
    $string = bin2hex(openssl_random_pseudo_bytes(4));
    
    if ($photo) {
        $photoTmp = $_FILES["fileatt"]["tmp_name"];
        $file_type = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($file_type, $allowed_types)) {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            exit;
        }

  $ImageName = $empID . '_' . $string . '.' . $file_type;

$destdir = '/Images/mobilestock';
    ftp_chdir($conn_id, "/Images/mobilestock") or die("Could not change directory");
    ftp_pasv($conn_id,true);
    ftp_put($conn_id, $ImageName, $photoTmp, FTP_BINARY) or die("Could not upload to $ftp_server");
    ftp_close($conn_id);
       
    } 
    else {
        $ImageName = "";
    }
    
         $insert="UPDATE mobilestockledger SET IDNo='$empID',file='$ImageName',Name='$empdata',StockID='$stockid',ArticleID='$ledgerid',CreatedDate='$timeStamp',CreatedBy='$EmployeeID',Status='0',file='$ImageName',Remarks='$remarks'WHERE ID='$id'";
         

    $addrun=mysqli_query($connection_s,$insert);
    ?>
    <script type="text/javascript">
window.location.href = 'mobile-stock.php';
</script>
<?php


      }
      elseif($code==29)
      {
                 
                    $id=$_POST['id'];
   $Status="UPDATE mobilestockadd set Action='1' where ID='$id'";

        $result = mysqli_query($connection_s,$Status);
 }
    elseif($code==30)
      {
                 
                    $id=$_POST['id'];
   $Status="UPDATE mobilestockadd set Action='0' where ID='$id'";

        $result = mysqli_query($connection_s,$Status);
 }
 
}

