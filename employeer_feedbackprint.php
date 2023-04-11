  

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
    

  $result = mysqli_query($conn,"SELECT * FROM feedback where category='5'   ");
  $counter = 1;
  while($row=mysqli_fetch_array($result)) 
            { 
   ?><br><br>
   <img src="http://gurukashiuniversity.co.in/gkuadmin/images/web-logo.png" style="margin-top: -30px;width:250px;height: 60px">
               

<CENTER><h5><b><u>FEEDBACK OF EMPLOYER</u></b></h5></CENTER>
  
      <table class="table borderless h" >
         <tr>
        <td><b>Name:&nbsp;&nbsp;&nbsp;&nbsp;</b><?= $row['info2']; ?> </td>
        <td> <b>Email:&nbsp;&nbsp;&nbsp;&nbsp; </b> <?= $row['info1']; ?> </td>
      </tr>
        <tr style="margin-top:1px;">
        <td><b>Designation&nbsp;&nbsp;&nbsp;&nbsp;</b><?= $row['info3']; ?> </td>
      <td> <b>Contact:&nbsp;&nbsp;&nbsp;&nbsp; </b><?= $row['info5'];?></td>  
      </tr>
       </tr>
        <tr style="margin-top:1px;">
       <td colspan="2"> <b>Organization:&nbsp;&nbsp;&nbsp;&nbsp; </b><?= $row['info4'];?></td>
        
      </tr>
      
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
   <label> <b>1.The subject matter/knowledge of the students meets the Industry Standard.

</b></label><br><?= $row['question1']; ?>

</div>
<div class="form-group">
<label> <b>2.The syllabus of the programmes are job-oriented, skill-based, and value-oriented.

</b></label><br><?= $row['question2']; ?>
 
</div>

<div class="form-group" >
 <label> <b>3.The curriculum is effective for the development of entrepreneurship skills.

</b></label><br>
<?= $row['question3']; ?>
</div>
<div class="form-group">
<label> <b>4.The curriculum focuses on developing employability and technical skills. 

</b></label><br><?= $row['question4']; ?>

</div>

<div class="form-group">
<label> <b>5.The curriculum is based on global, national and regional needs.

</b>:</label><br>
<?= $row['question5']; ?>
</div>
<div class="form-group">
<label> <b>6.The curriculum integrates crosscutting issues relevant to Professional Ethics, Gender, Human Values, Environment and Sustainability into the courses.

</b></label><br>
<?= $row['question6']; ?>
</div>

<div class="form-group">
<label> <b>7.Soft skills, life skills and employability skills are developed through curriculum. 

:</b></label><br>
 <?= $row['question7']; ?>
</div>


<div class="form-group">
<label> <b>8.Any other remark or opinion 

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