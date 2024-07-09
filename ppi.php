<?php  include 'header.php';
 date_default_timezone_set('Asia/Kolkata');
 $a=$EmployeeID;
  $today=date('Y-m-d');
  
 ?>





<div class="modal fade" id="Modaldailytime" tabindex="-1" role="dialog" aria-labelledby="ModaldailyLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="timetable_update">
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="Modaldaily" tabindex="-1" role="dialog" aria-labelledby="ModaldailyLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="show_update">
        </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function update_daily2(id,type)
  {
  

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("show_update").innerHTML=xmlhttp.responseText;
      }
    }
   xmlhttp.open("GET", "uploadslider.php?notice_id=" + id+"&type="+type, true);
   xmlhttp.send();
}
  </script>






<script type="text/javascript">
  function timetable(id)
  {
  

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("timetable_update").innerHTML=xmlhttp.responseText;
      }
    }
   xmlhttp.open("GET", "timetable.php?notice_id=" + id, true);
   xmlhttp.send();
}
  </script>





<script type="text/javascript">
  function update_daily(id,type)
  {
  

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("show_update").innerHTML=xmlhttp.responseText;
      }
    }
   xmlhttp.open("GET", "uploadslider.php?notice_id=" + id+"&type="+type, true);
   xmlhttp.send();
}
  </script>


<script type="text/javascript">
    function lect() {
    // alert(id);
    var  nol= document.getElementById("nol").value;
    var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
                     var code = 448;
                     $.ajax({
                        url: 'action_g.php',
                        type: 'post',
                        data: {
                            nol: nol,
                           code: code
                        },
                        success: function(response) {
                            spinner.style.display = 'none';
                           document.getElementById("lect").innerHTML = response;
                        }
                     });
                  }

  </script>


<p id="ajax-loader"></p>

  <!-- Content Wrapper. Contains page content -->

<section class="content">

    
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Update Your Daily Report</h3>

          <!-- <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div> -->
        </div>
        <div class="card-body">
       



                        <script>
                        $(document).ready(function(){
                            $("#selectas").change(function(){
                                $(this).find("option:selected").each(function(){
                                    var optionValue = $(this).attr("value");
                                    if(optionValue){
                                        $(".box").not("." + optionValue).hide();
                                        $("." + optionValue).show();
                                    } else{
                                        $(".box").hide();
                                    }
                                });
                            }).change();
                        });
                        </script>


  <div class="row">
<p style="color: red;font-size: 14px;font-style:solid">Personal Performance Index(PPI)<br>

  <b  style="text-align: justify;font-size: 13px;color: black">Please give your inputs in terms of teaching, engaging students, conducting tests/ quiz, e-seminars, project work, creative work, counseling of students, research guidance, getting admissions, administration, NAAC related contribution or any other information which you deem fit is in  your own interest and excellence of the university.</b>
<div class="col-lg-6" style="padding-left:20px;padding-right:20px;border-right: solid 2px red" >
	
   <?php if (isset($_SESSION['allready'] ))
    {?>
<div class="alert alert-danger"><?php echo  $_SESSION['allready'] ;?></div>
     <?php 
      } unset($_SESSION['allready']) ;?> 
  
         

<div class="row"><div class="col-sm-12"> <label style="font-size: 12px">Employment Type</label> <br>

	<select class="form-control selectas" id="selectas" required="" name='etype' id="etype">
              <option value="">Select</option><option value="Teaching">Teaching</option>
              <option value="Non-Teaching">Non-Teaching</option>
              </select>
</div>

</div>
        






   <div class="Teaching box"> 
<form action="action_g.php" method="post">
    <input type="hidden" name="code" value="449">

<br>
    	  <?php if( $a=='121031'||$a=='170601'||$a=='131053'||$a=='125256')
          {

         
            ?>

            <input type="text" value="<?= $_SESSION['usr'];?>" name='emp_id'>
           <input type="date"  value="<?= date('Y-m-d');?>" name='date_r'   min='<?= $lastMonth = date("Y-m-d", strtotime("-25 day"));  ?>' max="<?= date('Y-m-d');?>">
<?php 
          } else 
          { ?>
<input type="hidden" value="<?= $_SESSION['usr'];?>" name='emp_id'>
<!--<input type="hidden" value="<?= date('Y-m-d');?>"  name='date_r'>-->


<br>
 <input type="hidden"  value="<?= date('Y-m-d');?>" name='date_r'   max="<?= date('Y-m-d');?>">

  <!-- min='<?= $lastMonth = date("Y-m-d", strtotime("0 day"));  ?>' -->
<!--<select name='date_r' class="form-control">><option value="2021-06-15">2021-06-15</option><option value="2021-06-16">2021-06-16</option></select>-->

         <?php  }?>
    	
<input type="hidden" name="emp_type" value="Teaching" >

   	<div class="col-sm-12"> <label style="font-size: 12px">No. of Lectures Delivered Today</label><br><select class="form-control"  required="" name='nol' id="nol" onchange="lect()"><option value="">Select</option>
      <option value="0">0</option><option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
		<option value="10">10</option>
             </select>
</div>
<br>
<div id="lect"  style="overflow: scroll;min-height: 0px">



</div>
<label for="chkPassport">
    <input type="checkbox" id="chkPassport3" />
   Ph.D Classes
</label>

<div id="dvPassport3" style="display: none;overflow: scroll;min-height: 0px" >
   



    

<table class="table" id="txtPassportNumber3">
  <tr><th>#</th><th>Course</th><th style="width: 20px">Semester</th><th>Lecture_Time</th><th>Topic</th><th>Total</th><th>Present </th><th>Assignments</th><th style="width: 10px">Seminar</th><th>Class_Test</th><th>Platform</th></tr>
  <?php 
//  $nol=$_GET['nol'];
// $college=$_GET['college'];
for($l=1;$l<=4;$l++)
{
?>


<tr><th><?= $l;?></th><th>
 
<input type="text" name="phd course[]" >
 </th>
  <th style="width: 100px">
  <select name="phd_sem[]" class="form-control"><option value="1">Course Work</option>
  <!--<option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>--></select></th>

 

  <th><select name="phd_time[]" class="form-control"><option value="">Select Timming</option><option value="09:30 AM to 10:15 AM">09:30 AM to 10:30 AM</option>
  <option value="10:15 AM to 11:00 AM">10:40 AM to 11:40 AM</option>
  <option value="11:00 AM to 11:45 AM">11:50 AM to 12:50 PM</option>
  <option value="11:45 AM to 12:30 PM">01:00 PM to 02:00 PM</option>


 </select></th><th><input type="text" style="width:150px" name="phd_topic[]"></th>
 <th><input type="text" style="width:30px" name="phd_total[]"></th>
 <th><input type="text" style="width:30px" name="phd_present[]"></th>
 <th><select name="phd_assignment[]" class="form-control"><option value="">select</option><option value="Yes">Yes</option>
  <option value="No">No</option>
  </select></th><th><select name="phd_seminar[]" class="form-control"><option value="">Select</option><option value="Yes">Yes</option>
  <option value="No">No</option>
  </select></th><th><select name="phd_classtest[]" class="form-control"><option value="">Select</option><option value="Yes">Yes</option>
  <option value="NO">No</option>
  </select></th><th><select name="phd_platform[]" class="form-control" style="width:100px"><option value="">Select</option><option value="MS Team">MS Team</option>
    <option value="Zoom">Zoom</option>
      <option value="Google Meet">Google Meet</option>
        <option value="Google Meet">Google Class Room</option>
  <option value="other">Other</option>
  </select></th></tr>
<?php }?></table>




</div>
<br>
<label>Extra Activity</label>
 <textarea rows="3" cols="50" class="form-control" name="od_act"></textarea>
            <br/>

<div class="row"><div class="col-sm-4"> <label style="font-size: 12px">Admission Work</label> <br><select class="form-control" required="" name='admission'>
              <option value="">Select</option><option value="Yes">Yes</option>
              <option value="No">No</option>
              <option value="NA">NA</option></select>
</div>
<div class="col-sm-3"> <label style="font-size: 12px">NAAC Work </label><br><select class="form-control"  required="" name='naac'><option value="">Select</option><option value="Yes">Yes</option>
              <option value="No">No</option>
              <option value="NA">NA</option></select>
</div>
<div class="col-sm-5">   <label style="font-size: 12px">Virtual  Practical Lab  </label><br><select class="form-control" required="" name='practical'><option value="">Select</option><option value="Yes">Yes</option>
              <option value="No">No</option>
              <option value="NA">NA</option></select>
</div>
</div>
<div class="row">
<div class="col-sm-4">   <label style="font-size: 12px">Duty Performed as </label><br><select class="form-control" required="" name="duty_perform"><option value="">Select</option><option value="Dean">Dean</option>
              <option value="Class Coordinator">Class Coordinator</option>
              <option value="Head of Department">Head of Department</option>
           <option value="Incharge">Incharge</option>
           <option value="NA">NA</option></select>
</div> <div class="col-sm-8">   <label style="font-size: 12px"> Performed duty in Detail </label><br><textarea rows="3" cols="120" class="form-control" name="perform_detail"></textarea>
</div>
</div>

<label for="chkPassport">
    <input type="checkbox" id="chkPassport" />
    Future vision/Suggestion
</label>

<div id="dvPassport" style="display: none">
   
    <input type="text"  class="form-control"  name="suggestion" id="txtPassportNumber" >
</div>

            <p style="text-align:right;font-weight:bold;"><?= $Emp_Name; ?><br>
            <?= date('d-m-Y');?><br>
           <!--<font color="red"> Under Maintenance</font>-->
      <input type="submit" name="odabtn" id="odabtn1" class="btn btn-primary btn-xs" value="Submit"></p>
            </form></div>
    <div class="Non-Teaching box">
    	<form action="action_g.php" method="post">
        <input type="hidden" name="code" value="449">
    	  <?php if( $a=='121031'||$a=='170601'||$a=='131053'||$a=='125256')
          {?><input type="text" value="<?= $_SESSION['usr'];?>" name='emp_id'>
          
           <input type="date"  value="<?= date('Y-m-d');?>" name='date_r'   min='<?= $lastMonth = date("Y-m-d", strtotime("-20 day"));  ?>' max="<?= date('Y-m-d');?>">
<?php 
          } else
          { ?>
<input type="hidden" value="<?= $_SESSION['usr'];?>" name='emp_id'>
  <br>
 <input type="hidden"  value="<?= date('Y-m-d');?>" name='date_r'   min='<?= $lastMonth = date("Y-m-d", strtotime("-1 day"));  ?>' max="<?= date('Y-m-d');?>">
<!--<select name='date_r' class="form-control">><option value="2021-06-15">2021-06-15</option><option value="2021-06-16">2021-06-16</option></select>-->
         <?php  }?>
    	
<input type="hidden" name="emp_type" value="Non-Teaching" >
 <label>Work Done Before Noon <font size="1" style="color: red">(Please do not write serial number just press enter for new line)</font></label> <textarea rows="3" cols="50" class="form-control" name="bnoon"></textarea><label> Work Done After Noon<font size="1" style="color: red">(Please do not write serial number just press enter for new line)</font></label> 
      <textarea rows="3" cols="50" class="form-control" name="anoon"></textarea>


<div class="row"><div class="col-sm-5"> <label style="font-size: 12px">Admission Work</label> <br><select class="form-control" required="" name='admission'>
              <option value="">Select</option><option value="Yes">Yes</option>
              <option value="No">No</option>
              <option value="NA">NA</option></select>
</div>
<div class="col-sm-6"> <label style="font-size: 12px">NAAC Work </label><br><select class="form-control"  required="" name='naac'><option value="">Select</option><option value="Yes">Yes</option>
              <option value="No">No</option>
              <option value="NA">NA</option></select>
</div>

</div>
       
<label for="chkPassport1">
    <input type="checkbox" id="chkPassport1" />
    Future vision/Suggestion
</label>

<div id="dvPassport1" style="display: none">
   
    <input type="text"  class="form-control"  name="suggestion" id="txtPassportNumber1" >
</div>


            <p style="text-align:right;font-weight:bold;"><?= $Emp_Name; ?><br>
            <?= date('d-m-Y');?><br>
           <!--<font color="red"> Under Maintenance</font>-->
      <input type="submit" name="odabtn" id="odabtn" class="btn btn-primary btn-xs" value="Submit"></p>
            </form>

  </div>

             
<script type="text/javascript">
    $(function () {
        $("#chkPassport3").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport3").show();
            } else {
                $("#dvPassport3").hide();
            }
        });
    });
</script>
        
           


             
<script type="text/javascript">
    $(function () {
        $("#chkPassport1").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport1").show();
            } else {
                $("#dvPassport1").hide();
            }
        });
    });
</script>
            
            <br/>

<script type="text/javascript">
    $(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
            } else {
                $("#dvPassport").hide();
            }
        });
    });
</script>
</div>
<div class="col-lg-6" >
  <div class="panel panel-primary">
  <div class="panel-heading form-control" style="background-color: #002147;color: white">
    <?= $Emp_Name; ?>'s   &nbsp;Report
   <?php  $date=date('Y-m-d');?>
  </div>
  <div class="panel-body" style="overflow: scroll;height: 600px;padding-left:20px">

<?php  
   $sql1 = "SELECT * FROM ProgressReport WHERE UserID ='$a' ";
$log=0;
$stmt2 = sqlsrv_query($conntest,$sql1);
     while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
     {
      
    $emp_id = $row['UserID'];
     $emp_type = $row['EmploymentType'];
    $id ='';
    // $row['id'];
    $od_act = $row['ExtraActivity'];
    $bnoon = $row['WorkDoneBefore'];
    $anoon = $row['WorkDoneAfter'];
    $admission = $row['AdmissionWork'];  
    $naac = $row['NAACWork']; 

    $duty_perform = $row['DutyPerFormAs']; 
     $perform_detail = $row['PerformDutyDetails']; 
    $practical = $row['VirtualPracticalLab']; 
   $submit_date = $row['Date'];
   

   if($emp_type=='Non-Teaching')
   {

    ?> <b style="color: red">Date:  <?php echo $t = $submit_date->format('d-m-Y');    ?>  </b>  <a   onclick="update_daily('<?= $id;?>')"  style="margin-left: 250px;color: #002147" data-toggle="modal" data-target="#Modaldaily">Update</a>
 <br/>
    <?php 
   $count = 1;
    if($od_act!='')
    {
      $arrod_act = explode(PHP_EOL,$od_act);  
   
      foreach($arrod_act as $value)
      {
        echo "<b>".$count++.".</b> ".$value."<br/>";
      }
  }
    
    if($submit_date>'2020-09-13')
      {?>
   <b>Morning</b><br>
     <?php 
      $arrod_act1 = explode(PHP_EOL,$bnoon);  

      foreach($arrod_act1 as $value1)
      {
        echo "<b>".$count++.".</b> ".$value1."<br/>";
      }
    ?><b>Evening</b><br>
     <?php 
      $arrod_act2 = explode(PHP_EOL,$anoon);  

      foreach($arrod_act2 as $value2)
      {
        echo "<b>".$count++.".</b> ".$value2."<br/>";
      }

    }
    ?>        

<table class="table"><tr><th style="text-align: center;">Admission</th><th style="text-align: center;">NAAC</th><th style="text-align: center;">Practical</th></tr>
<tr><td style="text-align: center;"><?= $admission;?></td><td  style="text-align: center;"><?= $naac;?></td><td  style="text-align: center;"><?= $practical;?></td></tr></table>

    <?php
  }


//teaching 
  else
  {  ?>

<b style="color: red"> Date:  <?php echo $t = $submit_date->format('d-m-Y');    ?> </b> 
<!-- <button class="btn btn-success btn-sm"  onclick="update_daily2('<?= $id;?>','<?= $emp_type;?>')" data-toggle="modal" data-target="#Modaldaily"> <a  ></a>Update</button> -->

<br/>
<lable><b>Extra Activity Report</b></lable> <br/>
 <?php 
   $count = 1;
    if($od_act!='')
    {
      $arrod_act = explode(PHP_EOL,$od_act);  
   
      foreach($arrod_act as $value)
      {
        echo "<b>".$count++.".</b> ".$value."<br/>";
      }
  }
?>
<table class="table"><tr><th style="text-align: center;">Admission</th><th style="text-align: center;">NAAC</th><th style="text-align: center;">Virtual Practical Lab</th></tr>
<tr><td style="text-align: center;"><?= $admission;?></td><td  style="text-align: center;"><?= $naac;?></td><td  style="text-align: center;"><?= $practical;?></td></tr>

<tr><th style="text-align: center;">Duty Perform as</th><td  style="text-align: center;" colspan="2"><?= $duty_perform;?></td></tr><tr><td style="text-align: left;" colspan="3"><?= $perform_detail;?></td></tr></table>
<div id="lect"  style="overflow: scroll;min-height: 0px">




<table class="table" style="font-size: 10px">
  <tr><th>#</th><th>Course</th><th style="width: 20px">Semester</th><th>Lecture_Time</th><th  style="width:100%">Topic</th><th>Total</th><th>Present</th><th>Assignments</th><th style="width: 10px">Seminar</th><th>Class_Test</th><th>Platform</th></tr>

<?php 

  $t1 = $submit_date->format('Y-m-d');    
 $result ="SELECT * from ProgressReportLectureDetails where UserID = '$a' AND Date='$t1' ";

$log=0;
$stmt2 = sqlsrv_query($conntest,$result);

if( $stmt2  === false) {

    die( print_r( sqlsrv_errors(), true) );
}
     while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
     {

      
    $emp_id = $row['UserID'];
  
    $course = $row['course'];
    $semester = $row['Semester'];
    $id = $row['SrNo'];
    $time = $row['LectureTime'];
    $topic = $row['Topic'];  
    $present = $row['PresentStudent']; 
   $assignment = $row['AssignmentToday'];
  $seminar = $row['Seminar'];
    $sclass_test = $row['ClassTest'];
      $platfrom = $row['Platform'];
      $total = $row['TotelStudent'];
?>

 <tr><td>#</td><td style="color: blue"> <a   onclick="timetable('<?=$id?>')"  data-toggle="modal" data-target="#Modaldailytime"> <?= $course;?></a></td><td style="width: 20px"><?=$semester;?></td><td><?=$time;?></td><td style="width:100%"><?=$topic;?></td><td><?=$total;?></td><td><?= $present?></td><td><?= $assignment ?></td><td style="width: 10px"><?= $seminar;?></td><td><?=$sclass_test;?></td><td><?= $platfrom;?></td></tr>






<?php

}
?></table>
</div>

<?php 

  }
}
  ?>

















<hr style="background-color: red;height: 3px;margin-bottom: -1px">

<?php


//$date
 $sql1 = "SELECT * FROM ProgressReport WHERE UserID ='$a' Order by Date DEsc";

$log=0;
$stmt2 = sqlsrv_query($conntest,$sql1);

if( $stmt2  === false) {

    die( print_r( sqlsrv_errors(), true) );
}
     while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
     {
      
    $emp_id = $row['UserID'];
    $emp_type = $row['EmploymentType'];
    $id ='';
    // $row['id'];
    $od_act = $row['ExtraActivity'];
    $bnoon = $row['WorkDoneBefore'];
    $anoon = $row['WorkDoneAfter'];
    $admission = $row['AdmissionWork'];  
    $naac = $row['NAACWork']; 

    $duty_perform = $row['DutyPerFormAs']; 
     $perform_detail = $row['PerformDutyDetails']; 
    $practical = $row['VirtualPracticalLab']; 
   $submit_date = $row['Date'];



      if($emp_type=='Non-Teaching')
   {
    ?>
   <b style="color: red"> Date:    <?php echo $t = $submit_date->format('d-m-Y');    ?> </b> <!-- <button type="button"  onclick="update_daily('<?= $id;?>')" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Modaldaily">
Edit
</button>--> <br/>
   <?php 
   $count = 1;
    /*if($od_act!='')
    {
      $arrod_act = explode(PHP_EOL,$od_act);  
   
      foreach($arrod_act as $value)
      {
        echo "<b>".$count++.".</b> ".$value."<br/>";
      }
  }
    */
    
    if($submit_date>'2020-09-13')
      {?>
   <b>Morning</b><br>
     <?php 
      $arrod_act1 = explode(PHP_EOL,$bnoon);  

      foreach($arrod_act1 as $value1)
      {
        echo "<b>".$count++.".</b> ".$value1."<br/>";
      }
    ?><b>Evening</b><br>
     <?php 
      $arrod_act2 = explode(PHP_EOL,$anoon);  

      foreach($arrod_act2 as $value2)
      {
        echo "<b>".$count++.".</b> ".$value2."<br/>";
      }
    }
    ?>
        
       <table class="table"><tr><th style="text-align: center;">Admission</th><th style="text-align: center;">NAAC</th>



        </tr>
<tr><td style="text-align: center;"><?= $admission;?></td><td  style="text-align: center;"><?= $naac;?></td></tr></table>   
    <?php
  }


    


if($emp_type=='Teaching')
   {
?>
  <b style="color: red"> Date:  <?php echo $t = $submit_date->format('d-m-Y');    ?>  </b> <br>

<lable><b>Extra Activity Report</b></lable> <br/>
 <?php 
   $count = 1;
    if($od_act!='')
    {
      $arrod_act = explode(PHP_EOL,$od_act);  
   
      foreach($arrod_act as $value)
      {
        echo "<b>".$count++.".</b> ".$value."<br/>";
      }
  }
?>
<table class="table"><tr><th style="text-align: center;">Admission</th><th style="text-align: center;">NAAC</th><th style="text-align: center;">Virtual Practical Lab</th></tr>
<tr><td style="text-align: center;"><?= $admission;?></td><td  style="text-align: center;"><?= $naac;?></td><td  style="text-align: center;"><?= $practical;?></td></tr>

<tr><th style="text-align: center;">Duty Perform as</th><td  style="text-align: center;" colspan="2"><?= $duty_perform;?></td></tr><tr><td style="text-align: left;" colspan="3"><?= $perform_detail;?></td></tr></table>
<div id="lect"  style="overflow: scroll;min-height: 0px">


<table class="table" style="font-size: 10px">
  <tr><th>#</th><th>Course</th><th style="width: 20px">Semester</th><th>Lecture_Time</th><th style="width: 100%">Topic</th><th>Total</th><th>Present</th><th>Assignments</th><th style="width: 10px">Seminar</th><th>Class_Test</th><th>Platform</th></tr>

<?php 

 $t1 = $submit_date->format('Y-m-d');    

 $sql22 = "SELECT * from ProgressReportLectureDetails where UserID = '$a' AND Date='$t1'";
 $log=0;
$stmt2 = sqlsrv_query($conntest,$sql22);

     while($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
     {
   $emp_id = $row['UserID'];
  
    
    $course = $row['course'];
    $semester = $row['Semester'];
    $time = $row['LectureTime'];
    $topic = $row['Topic'];  
    $total = $row['TotelStudent']; 
    $present = $row['PresentStudent']; 
   $assignment = $row['AssignmentToday'];
  $seminar = $row['Seminar'];
    $sclass_test = $row['ClassTest'];
      $platfrom = $row['Platform'];
?>

 <tr><td>#</td><td> <?= $course;?></td><td style="width: 20px"><?=$semester;?></td><td><?=$time;?></td><td style="width: 100%"><?=$topic;?></td><td><?=$total;?></td><td><?= $present?></td><td><?= $assignment ?></td><td style="width: 10px"><?= $seminar;?></td><td><?=$sclass_test;?></td><td><?= $platfrom;?></td></tr>

<?php

}
?>  </table>
   </div>

<?php 
}
}


  

  //echo "-----------MAY ------------";
// echo "<br>";
   
  /* $connection_web_in =  new mysqli('103.18.70.83:3306','amrik','Bhagi@131053', 'mst_marks');

  $result = mysqli_query( $connection_web_in,"SELECT * from odactivity where emp_id = '$a' AND id<'4216' order BY submit_date Asc,id DESC ");
  while($row=mysqli_fetch_array($result))
  {
    $emp_id = $row['emp_id'];
    $od_act = $row['od_act']; 
    $submit_date = $row['submit_date'];
    ?>
      <b style="color: red"> Date:   <?php echo $date1 = date("d-m-Y", strtotime($submit_date))?> </b> 
    <br/>
    <?php 
      $arrod_act = explode(PHP_EOL,$od_act);  
      $count = 1;
      foreach($arrod_act as $value)
      {
        echo "<b>".$count++.".</b> ".$value."<br/>";
      }
    ?>
          
    <?php
  }*/
  ?>





  </div>
  </div>
  
  </div>
</div>

























        </div>
       
      
     
      </div>
  

    </section>

 
      
      </div><!--/. container-fluid -->
   
    <!-- Main content -->
    <!--<section class="content">

    
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          Start creating your amazing application!
        </div>
       
        <div class="card-footer">
          Footer
        </div>
     
      </div>
  

    </section>-->
    <!-- /.content -->

  <!-- /.content-wrapper -->


<script>
     $(function() { 
      $("#college").change(function(e) {
        e.preventDefault();

        var college= $("#college").val();
alert("college");
        var code='10121';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code},
            type:'POST',
            success:function(data){
                if(data != "")
                {
                    $("#course").html("");
                    $("#course").html(data);
                }
            }
          });
    });
  });
</script>
  <?php include 'footer.php';?>

 
</div>
<!-- ./wrapper -->
<script src="styles/dist/js/jquery.min.js" type="text/javascript"></script>
<!-- jQuery -->

</body>
</html>
