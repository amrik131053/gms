  

 <!DOCTYPE html><head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link  rel="stylesheet"  href="../css/bootstrap.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="../css/bootstrap.min.css" >
<link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
<link  rel="stylesheet" href="../css/style.css" >
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.min.js"   type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<style type="text/css">
  .borderless td, .borderless th {
    border: none;
 
}  table.borderless td,table.borderless th{
     border: none !important;
}
</style>

</head>
<title>Guru Kashi University</title><br><br>

 
<?php  

  include "connection/connection.php";
    

  $result = mysqli_query($conn,"SELECT * FROM feedback where category='1'   ");
  $counter = 1;
  while($row=mysqli_fetch_array($result)) 
            { 
   ?><br><br>
   <img src="http://gurukashiuniversity.co.in/gkuadmin/images/web-logo.png" style="margin-top: -30px;width:250px;height: 60px">
               

<CENTER><h5><b><u>FEEDBACK OF STUDENT</u></b></h5></CENTER>
  
      <table class="table borderless " >
        
        <tr style="margin-top:1px;">
        <td><b>Email:&nbsp;&nbsp;&nbsp;&nbsp;</b><?= $row['info1']; ?> </td>
        <td> <b>Programme:&nbsp;&nbsp;&nbsp;&nbsp; </b><?= $row['info2'];?></td>
      </tr>
      <!-- <tr>
        <td><b>Academic year:&nbsp;&nbsp;&nbsp;&nbsp;</b><?= $row['info3']; ?> </td>
        <td> <b>College:&nbsp;&nbsp;&nbsp;&nbsp; </b> <?= $row['info4']; ?> </td>
      </tr> -->
      
      </table><div class="row">
   <!--  <label> <b>Name : </b></label><?= $row['info1']; ?> -->
    

   <!-- <div class="form-group">
    <label> <b>Programme:</b></label><?= $row['info2'];?>
  

  </div> -->
  
   <!-- <div class="form-group">
    <label> <b>Academic year:</b></label>
    <?= $row['info3']; ?>
    
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1"><b>College: </b></label>
  
   <?= $row['info4']; ?> 
  </div> -->
  <div class="form-group">
   <label> <b>1.The contents of the curriculum are in conformity with the learning outcomes:
</b></label><br><?= $row['question1']; ?>

</div>
<div class="form-group">
<label> <b>2.The curriculum is as per the need of students:
</b></label><br><?= $row['question2']; ?>
 
</div>

<div class="form-group" >
 <label> <b>3.The contents of the course have been presented from simple to complex form:       
</b></label><br>
<?= $row['question3']; ?>
</div>
<div class="form-group">
<label> <b>4.The curriculum provides opportunity for the conducting research and project related activities:
</b></label><br><?= $row['question4']; ?>

</div>

<div class="form-group">
<label> <b>5.The curriculum is balanced with theoretical and practical knowledge
</b>:</label><br>
<?= $row['question5']; ?>
</div>
<div class="form-group">
<label> <b>6.Curriculum is taught with suitable teaching techniques :</b></label><br>
<?= $row['question6']; ?>
</div>

<div class="form-group">
<label> <b>7.The contents of the curriculum are in tune with the UGC-NET/CSIR examinations
:</b></label><br>
 <?= $row['question7']; ?>
</div>

<div class="form-group">
<label> <b>8.The curriculum has the potential in developing the habit of self- learning
</b></label><br>
 <?= $row['question8']; ?>
</div>
<div class="form-group">
<label> <b>9.The learning outcomes of the curriculum are of global standards
:</b></label><br><?= $row['question9']; ?>
 
</div><div class="form-group">
<label> <b>10.The curriculum has focus on skill development
</b>:</label><br>
 <?= $row['question10']; ?>

    </div>


<div class="form-group">
<label> <b>11.Evaluation of the course is appropriate to discriminate the students
</b>:</label><br>
<?= $row['question11']; ?>
</div>
<div class="form-group">
<label> <b>12.Any suggestion for improving the curriculum :
</b><br></label>
<?= $row['question12']; ?>

 
</div>


    </div>
    
</form>
</div>

</div>
<div class="pagebreak"> </div>

<?php } ?>

<style type="text/css">
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
</style>
<script type="text/javascript">

$(document).ready(function () {
    window.print();
});

</script>