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
     
        if($code==1 || $code==2 || $code==3 || $code==4 || $code==7 || $code==8)
        {
            include "connection/ftp-erp.php";
        }

// prepare Degree
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

}

