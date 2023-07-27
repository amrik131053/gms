<?php


session_start();
date_default_timezone_set("Asia/Kolkata");
$timeStamp=date('Y-m-d H-i');
$todaydate=date('Y-m-d');
ini_set('max_execution_time', '0');
   if(!(ISSET($_SESSION['usr']))) 
   {
?>
<script> window.location.href = 'index.php'; </script> 
<?php
   } 
   else
   {

   date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
   
   $EmployeeID=$_SESSION['usr'];
   if ($EmployeeID==0 || $EmployeeID=='') 
      {?>
<script type="text/javascript">
   window.location.href="index.php";
</script>
<?php }
   include "connection/connection.php";


$code = $_POST['code'];
   
   
   if ($code == 1) {


 $dropdown_team="SELECT * FROM Staff WHERE IDNo='$EmployeeID' ";
                      $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                    
                    if($dropdown_row_staff=sqlsrv_fetch_array($dropdown_team_run,SQLSRV_FETCH_ASSOC))
                    $LeaveRecommendingAuthority=$dropdown_row_staff['LeaveSanctionAuthority'];
                     $LeaveSanctionAuthority=$dropdown_row_staff['LeaveRecommendingAuthority'];
                  
                  




 $emp_ctegory=$_POST['emp_ctegory'];
 $nooflecture=$_POST['nooflecture'];
 $bookpub=$_POST['bookpub'];
 $noofbooks=$_POST['noofbooks'];
 $nameofbooks=$_POST['nameofbooks'];
 $isbn=$_POST['isbn'];
 $researchpub=$_POST['researchpub'];
 $noofpaper=$_POST['noofpaper'];
 $titleofpaper=$_POST['titleofpaper'];
 $nameofjour=$_POST['nameofjour'];
 $publicationindex=$_POST['publicationindex'];
 $consultancy=$_POST['consultancy'];
 $amount=$_POST['amount'];
  $corg=$_POST['corg'];
 $admission=$_POST['admission'];
 $noadm=$_POST['noadm'];
 $nocadm=$_POST['noadm'];
 $patent=$_POST['patent'];
 $ptdetail=$_POST['ptdetail'];
 $phdsuperviser=$_POST['phdsuperviser'];
 $phd_detail=$_POST['phd_detail'];
 $otherduty=$_POST['otherduty'];


$insQry="INSERT INTO `staff_aprisal`(`emp_id`,`ecategory`,`no_of_lect`,`book_published`,`no_of_books`,`name_of_books`,`isbn`,`research_paper`,
   `no_of_research_paper`, `title_of_paper`, `name_of_journal`,   `publication_index` ,   `consultancy`, `amount` ,`corg`,
   `admission` ,`no_of_admission` ,`no_of_admission_c`,`patent`,`p_detail` ,`phd_candidate` ,`no_of_candidate` ,`extra`,rec_auth,ap_auth,s_date) 
   
VALUES ('$EmployeeID','$emp_ctegory','$nooflecture','$bookpub','$noofbooks','$nameofbooks','$isbn','$researchpub','$noofpaper','$titleofpaper','$nameofjour','$publicationindex','$consultancy','$amount','$corg','$admission','$noadm','$nocadm','$patent','$ptdetail','$phdsuperviser','$phd_detail','$otherduty','$LeaveRecommendingAuthority',$LeaveSanctionAuthority,'$timeStamp')";

                              $insQryRun=mysqli_query($conn,$insQry);

                              echo "1"; 


   
    
      }


   else if ($code == 2) {?>

 <table class="table table-striped">
   <tr><th>Emp ID</th><th>Emp Category</th><th>Submitted on</th><th>Action</th><th>Status</th></tr>
<?php 
 $yourdata=" SELECT * FROM staff_aprisal where  ap_auth!='$EmployeeID' AND rec_auth='$EmployeeID'";

 $insQryRun=mysqli_query($conn,$yourdata);
 while ($show_task_row=mysqli_fetch_array($insQryRun))
             {?>
  <tr><td>
  <?= $show_task_row['emp_id'];?>
</td><td><?= $show_task_row['ecategory'];?></td>
    <td> <?= $show_task_row['s_date'];?></td>
    <td> <?php $r_auth=$show_task_row['rec_auth_status'];
    if($r_auth >0)
    {?>
      <button class="btn btn-success btn-xs" >Verified</button><?php 
    }
    else
    {?>
      <button class="btn btn-warning btn-xs"  onclick="updte_marks(<?= $show_task_row['id'];?>)" style="text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl">Pending</button>
    <?php }
    ?>
    </td>
<td> <?php $r_auth=$show_task_row['rec_auth_status'];
    if($r_auth >0)
    {?>
      <button class="btn btn-success btn-xs"  onclick="view_marks(<?= $show_task_row['id'];?>)" style="text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl1"><i class="fa fa-eye"></i></button><?php 
    }
    else
    {?>
      <button class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></button>
    <?php }
    ?>
    </td>


 </tr> 
<?php 
}
   }



else if ($code == 3) {

$id= $_POST['id'];
 ?>
 <div class="card-body table-responsive p-0" >
 <table class="table table-striped">
  

<?php   
$yourdata="select * from staff_aprisal where id='$id'";
 $insQryRun=mysqli_query($conn,$yourdata);
 while ($show_task_row=mysqli_fetch_array($insQryRun))
             {
               $emp_id= $show_task_row['emp_id'];



     $dropdown_team="SELECT * FROM Staff WHERE IDNo='$emp_id' ";
                      $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                    
                    if($dropdown_row_staff=sqlsrv_fetch_array($dropdown_team_run,SQLSRV_FETCH_ASSOC))
                    $mysnapp=$dropdown_row_staff['Snap'];
                     $myname=$dropdown_row_staff['Name'];
                      $Designation=$dropdown_row_staff['Designation'];
?>

            </td>
    <tr><th><?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($mysnapp).'" height="50" width="50" class="img-thumnail"  style="border-radius:50%"/></  center>';?></th>
      <th><?=  $myname;?></th>
<th><?=$Designation;?></th>


    </tr>





<input type="hidden" value="<?=$id;?>" id="muid" name="">


  <tr><td><b> Employment Category :</b></td><td><?= $show_task_row['ecategory'];?></td>
    <td> No of Lecture</td><td><?= $show_task_row['no_of_lect'];?></td></tr> 


    <tr><td><b>Books Published :</b> <?= $show_task_row['book_published'];?> </td><td>No of Books: <?= $show_task_row['no_of_books'];?></td>
      <td>Name of Books: <?= $show_task_row['name_of_books'];?></td><td>ISBN: <?= $show_task_row['isbn'];?></td>
   </tr>  

   <tr><td> <b>Research paper Published : </b><?= $show_task_row['research_paper'];?> (<?= $show_task_row['no_of_research_paper'];?>)</td>
      <td>Title of Paper: <?= $show_task_row['title_of_paper'];?></td><td>Name of Journal: <?= $show_task_row['name_of_journal'];?></td><td>Publication Index: <?= $show_task_row['publication_index'];?></td>
   </tr>         
         
<tr><td> <b>Consultancy : </b> <?= $show_task_row['consultancy'];?> </td><td>Amount: <?= $show_task_row['amount'];?></td><td>organisation: <?= $show_task_row['corg'];?></td>
      
   </tr>         
   <tr><td> <b>Admission Initative : </b> <?= $show_task_row['admission'];?> </td><td>No of Admission: <?= $show_task_row['no_of_admission'];?></td>
      <td colspan="2">No of Admission without Consultancy <?= $show_task_row['no_of_admission_c'];?></td>
   </tr>             

<tr><td> <b>Patent : </b><?= $show_task_row['patent'];?> </td><td>Detail: <?= $show_task_row['p_detail'];?></td>
      
   </tr> 
   <tr><td colspan="2"> <b>PhD. Candidate : </b><?= $show_task_row['phd_candidate'];?> </td><td colspan="2" >No Of Candidate: <?= $show_task_row['no_of_candidate'];?></td>
      
   </tr>
     <tr><td colspan="5"> <b>Other Duty /Task:</b><?= $show_task_row['extra'];?> </td>
      
   </tr>

          <?php    } ?>

 </tr>
     <tr><td > <b> Warning Issued :</b> <input  type="number" name="" id="warning" class="form-control"></td>
      <td > <b> Behaviour at workplace:</b> <input  type="number" name="" id="behaviour" class="form-control"></td>
      <td > <b> Observing Deadlines:</b> <input  type="number" name="" id="deadlines" class="form-control"></td>
       <td > <b> Team Coordination:</b> <input  type="number" name="" id="coordination" class="form-control"></td>
   </tr>






       </tbody></table>




</div>

<?php }


else if($code==4)
{

$muid=$_POST['muid'];
 $warning=$_POST['warning'];
 $behaviour=$_POST['behaviour'];
 $deadlines=$_POST['deadlines'];
 $coordination=$_POST['coordination'];


echo $update_rec="Update staff_aprisal  set  rec_auth_status='1',rec_auth_warning='$warning',
rec_auth_behavour='$behaviour',rec_auth_coordination='$coordination', rec_auth_deadline='$deadlines'
where id='$muid'";

 $insQryRun=mysqli_query($conn,$update_rec);

}


else if ($code == 5) {

$id= $_POST['id'];
 ?>
 <div class="card-body table-responsive p-0" >
 <table class="table table-striped">
  

<?php   
$yourdata="select * from staff_aprisal where id='$id'";
 $insQryRun=mysqli_query($conn,$yourdata);
 while ($show_task_row=mysqli_fetch_array($insQryRun))
             {
               $emp_id= $show_task_row['emp_id'];



     $dropdown_team="SELECT * FROM Staff WHERE IDNo='$emp_id' ";
                      $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                    
                    if($dropdown_row_staff=sqlsrv_fetch_array($dropdown_team_run,SQLSRV_FETCH_ASSOC))
                    $mysnapp=$dropdown_row_staff['Snap'];
                     $myname=$dropdown_row_staff['Name'];
                      $Designation=$dropdown_row_staff['Designation'];
?>

            </td>
    <tr><th><?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($mysnapp).'" height="50" width="50" class="img-thumnail"  style="border-radius:50%"/></  center>';?></th>
      <th><?=  $myname;?></th>
<th><?=$Designation;?></th>


    </tr>





<input type="hidden" value="<?=$id;?>" id="muid" name="">


  <tr><td><b> Employment Category :</b></td><td><?= $show_task_row['ecategory'];?></td>
    <td> No of Lecture</td><td><?= $show_task_row['no_of_lect'];?></td></tr> 


    <tr><td><b>Books Published :</b> <?= $show_task_row['book_published'];?> </td><td>No of Books: <?= $show_task_row['no_of_books'];?></td>
      <td>Name of Books: <?= $show_task_row['name_of_books'];?></td><td>ISBN: <?= $show_task_row['isbn'];?></td>
   </tr>  

   <tr><td> <b>Research paper Published : </b><?= $show_task_row['research_paper'];?> (<?= $show_task_row['no_of_research_paper'];?>)</td>
      <td>Title of Paper: <?= $show_task_row['title_of_paper'];?></td><td>Name of Journal: <?= $show_task_row['name_of_journal'];?></td><td>Publication Index: <?= $show_task_row['publication_index'];?></td>
   </tr>         
         
<tr><td> <b>Consultancy : </b> <?= $show_task_row['consultancy'];?> </td><td>Amount: <?= $show_task_row['amount'];?></td><td>organisation: <?= $show_task_row['corg'];?></td>
      
   </tr>         
   <tr><td> <b>Admission Initative : </b> <?= $show_task_row['admission'];?> </td><td>No of Admission: <?= $show_task_row['no_of_admission'];?></td>
      <td colspan="2">No of Admission without Consultancy <?= $show_task_row['no_of_admission_c'];?></td>
   </tr>             

<tr><td> <b>Patent : </b><?= $show_task_row['patent'];?> </td><td>Detail: <?= $show_task_row['p_detail'];?></td>
      
   </tr> 
   <tr><td colspan="2"> <b>PhD. Candidate : </b><?= $show_task_row['phd_candidate'];?> </td><td colspan="2" >No Of Candidate: <?= $show_task_row['no_of_candidate'];?></td>
      
   </tr>
     <tr><td colspan="5"> <b>Other Duty /Task:</b><?= $show_task_row['extra'];?> </td>
      
   </tr>

         

 </tr>
     <tr><td > <b> Warning Issued :</b> <input  type="number" name=""  value="<?= $show_task_row['rec_auth_warning'];?>" id="warning" class="form-control" readonly></td>
      <td > <b> Behaviour at workplace:</b> <input  type="number" name="" value="<?= $show_task_row['rec_auth_behavour'];?>" id="behaviour" class="form-control" readonly></td>
      <td > <b> Observing Deadlines:</b> <input  type="number" name="" 
         value="<?= $show_task_row['rec_auth_deadline'];?>"  id="deadlines" class="form-control" readonly></td>
       <td > <b> Team Coordination:</b> <input  type="number" name="" value="<?= $show_task_row['rec_auth_coordination'];?>" id="coordination" class="form-control" readonly></td>
   </tr>
 <?php    } ?>





       </tbody></table>




</div>

<?php }


   else if ($code == 6) {?>

 <table class="table table-striped">
   <tr><th>Emp ID</th><th>Emp Category</th><th>Submitted on</th><th>Action</th><th>Status</th></tr>
<?php 
 $yourdata="SELECT * FROM staff_aprisal where  (rec_auth_status='0'  AND ap_auth='$EmployeeID' AND rec_auth='$EmployeeID') OR (rec_auth_status='1'  AND ap_auth='$EmployeeID' ) ";

 $insQryRun=mysqli_query($conn,$yourdata);
 while ($show_task_row=mysqli_fetch_array($insQryRun))
             {?>
  <tr><td>
  <?= $show_task_row['emp_id'];?>
</td><td><?= $show_task_row['ecategory'];?></td>
    <td> <?= $show_task_row['s_date'];?></td>
    <td> <?php $a_auth=$show_task_row['ap_auth_status'];
    if($a_auth >0)
    {?>
      <button class="btn btn-success btn-xs" >Verified</button><?php 
    }
    else
    {?>
      <button class="btn btn-warning btn-xs"  onclick="updte_marks(<?= $show_task_row['id'];?>)" style="text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl">Pending</button>
    <?php }
    ?>
    </td>
<td> <?php $a_auth=$show_task_row['ap_auth_status'];
    if($a_auth >0)
    {?>
      <button class="btn btn-success btn-xs"  onclick="view_marks(<?= $show_task_row['id'];?>)" style="text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl1"><i class="fa fa-eye"></i></button><?php 
    }
    else
    {?>
      <button class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i></button>
    <?php }
    ?>
    </td>


 </tr> 
<?php 
}
   }



else if ($code == 7) {

$id= $_POST['id'];
 ?>
 <div class="card-body table-responsive p-0" >
 <table class="table table-striped">
  

<?php   
$yourdata="select * from staff_aprisal where id='$id'";
 $insQryRun=mysqli_query($conn,$yourdata);
 while ($show_task_row=mysqli_fetch_array($insQryRun))
             {
               $emp_id= $show_task_row['emp_id'];
               $r_id= $show_task_row['rec_auth'];
               $a_id= $show_task_row['ap_auth'];



     $dropdown_team="SELECT * FROM Staff WHERE IDNo='$emp_id' ";
                      $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                    
                    if($dropdown_row_staff=sqlsrv_fetch_array($dropdown_team_run,SQLSRV_FETCH_ASSOC))
                    $mysnapp=$dropdown_row_staff['Snap'];
                     $myname=$dropdown_row_staff['Name'];
                      $Designation=$dropdown_row_staff['Designation'];
?>

            </td>
    <tr><th><?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($mysnapp).'" height="50" width="50" class="img-thumnail"  style="border-radius:50%"/></  center>';?></th>
      <th><?=  $myname;?></th>
<th><?=$Designation;?></th>


    </tr>



<input type="hidden" value="<?=$r_id;?>" id="recid" name="">
<input type="hidden" value="<?=$a_id;?>" id="appid" name="">

<input type="hidden" value="<?=$id;?>" id="muid" name="">


  <tr><td><b> Employment Category :</b></td><td><?= $show_task_row['ecategory'];?></td>
    <td> No of Lecture</td><td><?= $show_task_row['no_of_lect'];?></td></tr> 


    <tr><td><b>Books Published :</b> <?= $show_task_row['book_published'];?> </td><td>No of Books: <?= $show_task_row['no_of_books'];?></td>
      <td>Name of Books: <?= $show_task_row['name_of_books'];?></td><td>ISBN: <?= $show_task_row['isbn'];?></td>
   </tr>  

   <tr><td> <b>Research paper Published : </b><?= $show_task_row['research_paper'];?> (<?= $show_task_row['no_of_research_paper'];?>)</td>
      <td>Title of Paper: <?= $show_task_row['title_of_paper'];?></td><td>Name of Journal: <?= $show_task_row['name_of_journal'];?></td><td>Publication Index: <?= $show_task_row['publication_index'];?></td>
   </tr>         
         
<tr><td> <b>Consultancy : </b> <?= $show_task_row['consultancy'];?> </td><td>Amount: <?= $show_task_row['amount'];?></td><td>organisation: <?= $show_task_row['corg'];?></td>
      
   </tr>         
   <tr><td> <b>Admission Initative : </b> <?= $show_task_row['admission'];?> </td><td>No of Admission: <?= $show_task_row['no_of_admission'];?></td>
      <td colspan="2">No of Admission without Consultancy <?= $show_task_row['no_of_admission_c'];?></td>
   </tr>             

<tr><td> <b>Patent : </b><?= $show_task_row['patent'];?> </td><td>Detail: <?= $show_task_row['p_detail'];?></td>
      
   </tr> 
   <tr><td colspan="2"> <b>PhD. Candidate : </b><?= $show_task_row['phd_candidate'];?> </td><td colspan="2" >No Of Candidate: <?= $show_task_row['no_of_candidate'];?></td>
      
   </tr>
     <tr><td colspan="5"> <b>Other Duty /Task:</b><?= $show_task_row['extra'];?> </td>
      
   </tr></tr>
     <tr><td > <b> Warning Issued :</b> <input  type="number" name=""  value="<?= $show_task_row['rec_auth_warning'];?>" class="form-control" readonly></td>
      <td > <b> Behaviour at workplace:</b> <input  type="number" name="" value="<?= $show_task_row['rec_auth_behavour'];?>"  class="form-control" readonly></td>
      <td > <b> Observing Deadlines:</b> <input  type="number" 
         value="<?= $show_task_row['rec_auth_deadline'];?>" class="form-control" readonly></td>
       <td > <b> Team Coordination:</b> <input  type="number" name="" value="<?= $show_task_row['rec_auth_coordination'];?>"  class="form-control" readonly></td>
   </tr>

          <?php    } ?>

 </tr>
     <tr><td > <b> Warning Issued :</b> <input  type="number" name="" id="warning" class="form-control"></td>
      <td > <b> Behaviour at workplace:</b> <input  type="number" name="" id="behaviour" class="form-control"></td>
      <td > <b> Observing Deadlines:</b> <input  type="number" name="" id="deadlines" class="form-control"></td>
       <td > <b> Team Coordination:</b> <input  type="number" name="" id="coordination" class="form-control"></td>
   </tr>






       </tbody></table>




</div>

<?php 
}
else if($code==8)
{

$recid=$_POST['recid'];
$appid=$_POST['appid'];
$muid=$_POST['muid'];
 $warning=$_POST['warning'];
 $behaviour=$_POST['behaviour'];
 $deadlines=$_POST['deadlines'];
 $coordination=$_POST['coordination'];

if($recid!=$appid)
{
   $update_rec="Update staff_aprisal  set  ap_auth_status='1',ap_auth_warning='$warning',
ap_auth_behaviour='$behaviour',ap_auth_coordination='$coordination', ap_auth_deadline='$deadlines'
where id='$muid'";
 $insQryRun=mysqli_query($conn,$update_rec);
}
else
{

$update_rec="Update staff_aprisal  set  ap_auth_status='1',ap_auth_warning='$warning',
ap_auth_behaviour='$behaviour',ap_auth_coordination='$coordination', ap_auth_deadline='$deadlines'
where id='$muid'";
$update_rec1="Update staff_aprisal  set  rec_auth_status='1',rec_auth_warning='$warning',
rec_auth_behavour='$behaviour',rec_auth_coordination='$coordination', rec_auth_deadline='$deadlines'
where id='$muid'";

 $insQryRun=mysqli_query($conn,$update_rec);
 $insQryRun=mysqli_query($conn,$update_rec1);
}

 
 
}


else if ($code == 9) {

$id= $_POST['id'];
 ?>
 <div class="card-body table-responsive p-0" >
 <table class="table table-striped">
  

<?php   
$yourdata="select * from staff_aprisal where id='$id'";
 $insQryRun=mysqli_query($conn,$yourdata);
 while ($show_task_row=mysqli_fetch_array($insQryRun))
             {
               $emp_id= $show_task_row['emp_id'];



     $dropdown_team="SELECT * FROM Staff WHERE IDNo='$emp_id' ";
                      $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                    
                    if($dropdown_row_staff=sqlsrv_fetch_array($dropdown_team_run,SQLSRV_FETCH_ASSOC))
                    $mysnapp=$dropdown_row_staff['Snap'];
                     $myname=$dropdown_row_staff['Name'];
                      $Designation=$dropdown_row_staff['Designation'];
?>

            </td>
    <tr><th><?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($mysnapp).'" height="50" width="50" class="img-thumnail"  style="border-radius:50%"/></  center>';?></th>
      <th><?=  $myname;?></th>
<th><?=$Designation;?></th>


    </tr>





<input type="hidden" value="<?=$id;?>" id="muid" name="">


  <tr><td><b> Employment Category :</b></td><td><?= $show_task_row['ecategory'];?></td>
    <td> No of Lecture</td><td><?= $show_task_row['no_of_lect'];?></td></tr> 


    <tr><td><b>Books Published :</b> <?= $show_task_row['book_published'];?> </td><td>No of Books: <?= $show_task_row['no_of_books'];?></td>
      <td>Name of Books: <?= $show_task_row['name_of_books'];?></td><td>ISBN: <?= $show_task_row['isbn'];?></td>
   </tr>  

   <tr><td> <b>Research paper Published : </b><?= $show_task_row['research_paper'];?> (<?= $show_task_row['no_of_research_paper'];?>)</td>
      <td>Title of Paper: <?= $show_task_row['title_of_paper'];?></td><td>Name of Journal: <?= $show_task_row['name_of_journal'];?></td><td>Publication Index: <?= $show_task_row['publication_index'];?></td>
   </tr>         
         
<tr><td> <b>Consultancy : </b> <?= $show_task_row['consultancy'];?> </td><td>Amount: <?= $show_task_row['amount'];?></td><td>organisation: <?= $show_task_row['corg'];?></td>
      
   </tr>         
   <tr><td> <b>Admission Initative : </b> <?= $show_task_row['admission'];?> </td><td>No of Admission: <?= $show_task_row['no_of_admission'];?></td>
      <td colspan="2">No of Admission without Consultancy <?= $show_task_row['no_of_admission_c'];?></td>
   </tr>             

<tr><td> <b>Patent : </b><?= $show_task_row['patent'];?> </td><td>Detail: <?= $show_task_row['p_detail'];?></td>
      
   </tr> 
   <tr><td colspan="2"> <b>PhD. Candidate : </b><?= $show_task_row['phd_candidate'];?> </td><td colspan="2" >No Of Candidate: <?= $show_task_row['no_of_candidate'];?></td>
      
   </tr>
     <tr><td colspan="5"> <b>Other Duty /Task:</b><?= $show_task_row['extra'];?> </td>
      
   </tr>

         

 </tr>
     <tr><td > <b> Warning Issued :</b> <input  type="number" name=""  value="<?= $show_task_row['rec_auth_warning'];?>" id="warning" class="form-control" readonly></td>
      <td > <b> Behaviour at workplace:</b> <input  type="number" name="" value="<?= $show_task_row['rec_auth_behavour'];?>" id="behaviour" class="form-control" readonly></td>
      <td > <b> Observing Deadlines:</b> <input  type="number" name="" 
         value="<?= $show_task_row['rec_auth_deadline'];?>"  id="deadlines" class="form-control" readonly></td>
       <td > <b> Team Coordination:</b> <input  type="number" name="" value="<?= $show_task_row['rec_auth_coordination'];?>" id="coordination" class="form-control" readonly></td>
   </tr>
   </tr>
     <tr><td > <b> Warning Issued :</b> <input  type="number" name=""  value="<?= $show_task_row['ap_auth_warning'];?>" id="warning" class="form-control" readonly></td>
      <td > <b> Behaviour at workplace:</b> <input  type="number" name="" value="<?= $show_task_row['ap_auth_behaviour'];?>" id="behaviour" class="form-control" readonly></td>
      <td > <b> Observing Deadlines:</b> <input  type="number" name="" 
         value="<?= $show_task_row['ap_auth_deadline'];?>"  id="deadlines" class="form-control" readonly></td>
       <td > <b> Team Coordination:</b> <input  type="number" name="" value="<?= $show_task_row['ap_auth_coordination'];?>" id="coordination" class="form-control" readonly></td>
   </tr>
 <?php    } ?>





       </tbody></table>




</div>

<?php }












   }