<?php 
   include 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>



  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Guru Kashi University</title>
  <link rel="icon" href="images/favicon.ico" type="image/gif">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="assets/dist/css/style.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js">    </script>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<style type="text/css">
.table>tbody>tr>td{
 border: 1px solid #000;
 }
  #watermark{
   display: block;
      position: absolute;opacity: 0.25;font-size: 5em;width: 100%;text-align: center;z-index: 1000;margin-top:300px;transform: rotate(-20deg);
    }

</style>
<script type="text/javascript">
   function printDiv() 
{

  var divToPrint=document.getElementById('printrel');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.write('<style>.table {width: 100%;max-width: 100%;margin-bottom: 10px;border-collapse: collapse;font-size:14px;}.table tr td{border: 1px solid #000;padding:5px;} #printbtn{display:none!important;}   #watermark {position: absolute;opacity: 0.25;font-size: 5em;width: 100%;text-align: center;z-index: 1000;margin-top:300px;transform: rotate(-20deg);}</style>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}


</script>
<!--style="text-align: left; padding: 0px 10px-->
<div id='printrel' >
<div id="watermark">
  Internet Result Copy online Degree
</div>


        <div style="text-align: center;padding: 5px 100px;">
            <img src="images/logoo.png" height="70" width="70" />
            <h2 style="font-family: 'Century';text-transform: uppercase;font-weight: bold;">Guru Kashi University</h2>
            <h5 style="font-family: 'Arial';text-transform: uppercase;">Talwandi Sabo, Bathinda, Punjab - 151302.</h5>
            <p style="font-family: 'Arial';font-size: 10px;">(Established by Government of Punjab vide Punjab Act No. 37 of 2011 as per Section 2(f) of UGC Act, 1956)</p>
            <h4 style="font-family: 'Century';">(Internet Result Copy online Degree)</h4>
     </div>
<div style="text-align:left;padding: 0px 50px;">

                <?php 


$id=$_POST['id'];
 $rollno=$_POST['UniRollNo'];

 $sql = "SELECT *,d.course as mycourse from basic_detail inner join discipline as d on d.id=basic_detail.course where basic_detail.classrollno='$rollno'";

  $res=mysqli_query($connection_local,$sql);
  while ($data=mysqli_fetch_array($res)) 
  {
        $candidateName=$data['candidate_name'];                  
    $candidateFather=$data['father_name'];
     $candidateCourse=$data['mycourse'];          
  }
 $api_url = 'http://gurukashiuniversity.co.in/odl-api/getresult.php?UniRollNo='.$rollno;
// Read JSON file
$json_data = file_get_contents($api_url);
// Decode JSON data into HP array
$response_data = json_decode($json_data);
$array = json_decode($json_data, true);
// print_r($array);
// All user data exists in 'data' object
$user_data = $response_data;
$count= $response_data[8];
 $SGPA=$user_data[3];
 $TotalCredit=$user_data[7];
  $declatedate=$user_data[6];
?>
    <table class='table' style='table-layout:fixed;margin-bottom:0px'>

                        <?php 
                        $Srno=1;
 //foreach ($user_data as $key=> $user) {
    for ($i=0; $i <1; $i++) { 
     
?>
      <tr>
                  <td><b>Roll No.: </b><?= $user_data[1]; ?></td>
                    <td><b>Name: </b><?=$candidateName;?></td>  
                </tr>
                <tr>
                    <td><b>Father's Name: </b><?=$candidateFather;?></td>
                    <td><b>Course:<?=$candidateCourse;?> </b> (Online Degree)</td>
                </tr> <tr>
                    <td><b>Semester: </b><?= $user_data[2]; ?></td>
                    <td><b>Examination: </b><?= $user_data[4]; ?> (<?= $user_data[5]; ?>)</td>
                </tr>
                <?php 
                        
$Srno++;

}
$api_url = 'http://gurukashiuniversity.co.in/odl-api/getresultshow.php?ResultID='.$id;
// Read JSON file
$json_data = file_get_contents($api_url);
// Decode JSON data into PHP array
$response_data1 = json_decode($json_data, true);
$user_data1 = $response_data1;
?>
</table><br><table class='table' style='table-layout:fixed;margin-bottom:0px'><tr>
<td width="10%"><b><center>Sr. No.</center></b></td>
                        <td width="60%"><b>Subjects/Subject Code</b></td>
                        
                        <td style='text-align:center;' width="20%"><b>Grade (Total)</b></td>
                        <td style='text-align:center;' width="20%"><b>Grade Point Value</b></td></tr><?php

                         // Traverse array and display user data

$count=1;
 foreach ($user_data1 as $key => $value) {
   ?>
   <tr>
 <td><b><center><?=$count;?><center></b></td>
                        <td><b><?= $user_data1[$key]['SubjectName'];?>/<?= $user_data1[$key]['SubjectCode'];?></b></td>
                        
                         <td style='text-align:center;'><b><?= $user_data1[$key]['SubjectGrade'];?></b></td>
                         <td style='text-align:center;'><b><?= $user_data1[$key]['SubjectGradePoint'];?></b></td></tr>
 <?php 
 ?>
 <div style='padding:0px 0px;'>




<?php
$count++; }?>
<tr>
  <td colspan="2" style='text-align:center;'><b>Total Number of Credits:&nbsp;<?=$TotalCredit;?></b></td>
                    <td style='text-align:center;' colspan="2"><b>SGPA:&nbsp;<?=$SGPA;?></b></td>
</tr>

</tbody></table>
<br>
<b>Declare Date:</b>&nbsp;<?=$declatedate;?>
</div>

</div>

</div>

<br><br><br>

 <p align="center">

              <i class="fa fa-print fa-2x"  style="color:#002147" id="printbtn" onclick="printDiv()"></i><br></p> 
</body>
</html>
