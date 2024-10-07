<!DOCTYPE html>
<html lang="en">

<head>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Guru Kashi University</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <!-- ----------internet status ---------- -->
    <link rel="stylesheet" href="internet_status.css">
    <!-- ----------internet status end ---------- -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="dist/css/jquery-ui.css">


<div class="tab-pane" id="fee">
  <div class="row">
 <?php 
   $timeStamp=date('Y-m-d H:i:s.v');
   $timeStampS=date('Y-m-d H:i:s');
$serverName = "10.0.10.15"; 
$connectionInfo = array( "Database"=>"DBgurukashi", "UID"=>"sa", "PWD"=>"Amrik@123");
$conntes = sqlsrv_connect($serverName,$connectionInfo);
$IDNo=$_REQUEST['IDNo'];
$sql = "SELECT  * FROM Admissions where IDNo='$IDNo'";
$stmt1 = sqlsrv_query($conntes,$sql);
        while($row6 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
         {
            $IDNo= $row6['IDNo'];
            $ClassRollNo= $row6['ClassRollNo'];
            $img= $row6['Image'];
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
            $CollegeID=$row6['CollegeID'];
          }



          ?>
                                    <div class="col-lg-12">
                                    <table class="table" style="border:1px solid black" >
 <tr>
 <td colspan="2"><img src="dist/img/new-logo.png" height="40" width="200"></td>
<td colspan="5"><h5></h5></td>
<td colspan="2"><img src="dist/img/naac-logo.png" height="40" width="100" style="float:right;"></td>
        </tr>
        </table>
        <br>
 <table class="table"  style="border:1px solid black">

 <tr>
 <td style="padding-left: 10px"><b>Rollno: </b></td>

 <td> <?php echo $UniRollNo;?>/<?=$ClassRollNo;?> &nbsp;(<?=$IDNo;?>)</td>
 <td ><b>Name:</b> </td>
 <td colspan="4"><?=$name;?></td>

 <td  rowspan="2" >
 <?php //echo '<img src="'.$BasURL.'Images/Students/'.$img.'" height="200" width="150" class="img-thumnail" />';?>
 </td>
 </tr>
 <tr>
   <td style="padding-left: 10px"><b>College:</b></td>
   <td ><?php echo $college;?></td>
   <td><b>Course:</b></td>
   <td colspan="4"><?=$course;?>(<?=$batch;?>)</td>
</tr>

 </table>






                                        <table class="table  table-bordered">
                                            
<?php

$sqlww = "SELECT sum(Debit) as totaldebit ,sum(Credit)as totalcredit from Ledger where  IDNo='$IDNo'";

$stmt8 = sqlsrv_query($conntes,$sqlww);
while($rowww = sqlsrv_fetch_array($stmt8, SQLSRV_FETCH_ASSOC) )
{
    
    $tdebit=$rowww['totaldebit'];
$tcredit=$rowww['totalcredit'];

  }
 
  $amount=$tdebit-$tcredit;
    ?>                                  

  <tr><td colspan="2" style="color: red;"><b>Total Debit :   <?=$tdebit;?></b></td><td colspan="2" style="color: red;"><b>Total Credit :    <?=$tcredit;?></td>
<td colspan="2"></td>
    <td style="color: red;" colspan="4"><b>Balance :    <?=$amount;?></td>
    </tr>


                                            <tr>
                                                <td><b>Date</b></td>
                                                <td><b>Receipt No</b></td>
                                                 <td><b>Installment</b></td>
                                                 <td><b>Particulars</b></td>
                                               
                                                 <td><b>Ledger</b></td>
                                                 <td><b>Debit</b></td>
                                                 <td><b>Credit</b></td>
                                                 <td><b>Remarks</b></td>

                                                

                                                 <?php  $sql8 = "select  * from  Ledger where IDNo='$IDNo' order by DateEntry DESC";
$stmt8 = sqlsrv_query($conntes,$sql8);
while($row8 = sqlsrv_fetch_array($stmt8, SQLSRV_FETCH_ASSOC) )
{

    ?>                                        
                                             
                                           <tr>  <td>
                                            <?php
                                            if($row8['DateEntry']!='')
                                            {

                                               echo  $row8['DateEntry']->format('d-m-Y h:i:s'); 

                                       
                                        }
                                        ?> 



                                         </td><td><?= $row8['ReceiptNo'];;?></td>
                                            
                                            <td><?= $row8['Semester'];?>   </td>
                                            <td style="width: 300px"><?= $row8['Particulars'];;?></td>

                                            <td><?= $row8['LedgerName'];?>   </td><td><?= $row8['Debit'];;?></td><td><?= $row8['Credit'];;?></td><td><?= $row8['Remarks'];;?></td>
                                               </tr> 
                                          
                                            <?php 
                                                }?>



<?php $sqlww = "SELECT sum(Debit) as totaldebit ,sum(Credit)as totalcredit from Ledger where  IDNo='$IDNo'";

$stmt8 = sqlsrv_query($conntes,$sqlww);
while($rowww = sqlsrv_fetch_array($stmt8, SQLSRV_FETCH_ASSOC) )
{
    
    $tdebit=$rowww['totaldebit'];
$tcredit=$rowww['totalcredit'];

  }
 
  $amount=$tdebit-$tcredit;
    ?>                                  

  <tr><td colspan="2" style="color: red;"><b>Total Debit :   <?=$tdebit;?></b></td><td colspan="2" style="color: red;"><b>Total Credit :    <?=$tcredit;?></td>
<td colspan="2"></td>
    <td style="color: red;" colspan="4"><b>Balance :    <?=$amount;?></td>
    </tr>  
     </table>
                                </div>
                                </div>

                                
                                    
                            </div>

