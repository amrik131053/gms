<?php 
include "connection/connection.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Guru Kashi University</title>
<link  rel="stylesheet"  href="dist/css/adminlte.min.css" >
<link rel="stylesheet" href="dist/css/bootstrap.min.css" >
<link rel="stylesheet" href="dist/css/bootstrap-theme.min.css" >
<link  rel="stylesheet" href="dist/css/style.css" >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<style type="text/css">
.table>tbody>tr>td{
 border: 1px solid #000;
 }
  #watermark{
   display: block; 
      position: absolute;opacity: 0.25;font-size: 8em;width: 100%;text-align: center;z-index: 1000;margin-top:400px;transform: rotate(-20deg);
    }

</style>
<script type="text/javascript">
   function printDiv() 
{

  var divToPrint=document.getElementById('printrel');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.write('<style>.table {width: 100%;max-width: 100%;margin-bottom: 10px;border-collapse: collapse;font-size:14px;}.table tr td{border: 1px solid #000;padding:5px;} #printbtn{display:none;}   #watermark {position: absolute;opacity: 0.25;font-size: 8em;width: 100%;text-align: center;z-index: 1000;margin-top:400px;transform: rotate(-20deg);}</style>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}


</script>
<!--style="text-align: left; padding: 0px 10px-->
<div id='printrel' >
<div id="watermark">
  Internet Result Copy
</div>


        <div style="text-align: center;padding: 5px 100px;">
            <img src="dist/img/logo.jpg" height="70" width="70" />
            <h2 style="font-family: 'Century';text-transform: uppercase;font-weight: bold;">Guru Kashi University</h2>
            <h5 style="font-family: 'Arial';text-transform: uppercase;">Talwandi Sabo, Bathinda, Punjab - 151302.</h5>
            <p style="font-family: 'Arial';font-size: 10px;">(Established by Government of Punjab vide Punjab Act No. 37 of 2011 as per Section 2(f) of UGC Act, 1956)</p>
            <h4 style="font-family: 'Century';">(Internet Result Copy)</h4>
     </div>
<div style="text-align:left;padding: 0px 50px;">

                <?php 


$id=$_GET['id'];

    $sql = "{CALL GetResult('$id')}";
    $stmt = sqlsrv_prepare($conntest, $sql);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql);
    die;
    } 

        $count=0;

     while($row = sqlsrv_fetch_array($stmt)){

 $declare= $row['11'];

//print_r($row);
?>
<div style='padding:0px 0px;'>



<?php if($count=='0')
  {?>
    <table class='table' style='table-layout:fixed;margin-bottom:0px'>
                        <tbody>
     
            <tr>
                  <td><b>Roll No.: </b><?= $row['1'];?></td>
                    <td><b>Name: </b><?= $row['2'];?></td>
                  
                </tr>
                <tr>
                    <td><b>Father's Name: </b><?= $row['3'];?></td>
                    <td><b>Course: </b><?= $row['4'];?> (<?= $row['5'];?>)</td>
                </tr> <tr>
                    <td><b>Semester: </b><?= $row['7'];?></td>
                    <td><b>Examination: </b><?= $row['9'];?> (<?= $row['8'];?> <?= $row['10'];?>)</td>
                </tr>

</tbody></table>

  <?php


   }?>


                   <?php if($count=='0'){

                    ?><table class='table' style='margin-top: 20px'>  
                    <tbody>
<?php 
                   }?>
                  

                       <?php if($count=='0')
  {?>
                     <tr>
                     <?php if($row['12']=='0')  
                     {?>
                       <td><b>Sr. No.</b></td>
                        <td><b>Subjects/Subject Code</b></td>
                        <td style='text-align:center;'><b>Grade (Internal)</b></td>
                        <td style='text-align:center;'><b>Grade (External)</b></td>
                        <td style='text-align:center;'><b>Grade (Total)</b></td>
                        <td style='text-align:center;'><b>Grade Point Value</b></td>

                     <?php }
                     elseif($row['12']=='1')
                     {?>
<td><b>Sr. No.</b></td>
                        <td><b>Subjects/Subject Code</b></td>
                        
                        <td style='text-align:center;'><b>Grade (Total)</b></td>
                        <td style='text-align:center;'><b>Grade Point Value</b></td>

                    <?php  }
                     elseif($row['12']=='2')
                     {?>
<td><b>Sr. No.</b></td>
                        <td><b>Subjects/Subject Code</b></td>
                        <td style='text-align:center;'><b>Marks</b></td>
                    <?php  }
                     ?>  </tr>
                  <?php }?>
                   <tr>
                     <?php if($row['12']=='0')  
                     {?>
                       <td><?= $count+1;?></td>
                        <td><?=$row['15']?> (<?=$row['16']?>)</td>
                        <td style='text-align:center;'><?=$row['20']?></td>
                        <td style='text-align:center;'><?=$row['16']?></td>
                        <td style='text-align:center;'><?=$row['17']?></td>
                        <td style='text-align:center;'><?=$row['18']?></td>

                     <?php }
                     elseif($row['12']=='1')
                     {?>
<td><?= $count+1;?></td><td><?=$row['15']?> (<?=$row['16']?>)</td>
 <td style='text-align:center;'><?=$row['17']?></td>
  <td style='text-align:center;'><?=$row['18']?></td>

                    <?php  }
                     elseif($row['12']=='2')
                     {?>
<td><b><?= $count+1;?></b></td>
                           <td><b><?=$row['15']?> (<?=$row['16']?>)</b></td>
                        
                        <td style='text-align:center;'><?=$row['18']?></td>

                    <?php  }
                    else{}    ?>    </tr>  

<?php


if($row['21']-1==$count)
{
  ?>
<tr>

<?php if($row['12']=='0')  
                     {?>
                       <td colspan="4" style='text-align:center;'><b>Total Number of Credits:<?=$row['14']?></b></td>
                    <td style='text-align:center;' colspan="2"><b>SGPA:<?=$row['13']?></b></td>
                     <?php }

                     elseif($row['12']=='1')
{
                     ?>
   <td colspan="2" style='text-align:center;'><b>Total Number of Credits:<?=$row['14']?></b></td>
                    <td style='text-align:center;' colspan="2"><b>SGPA:<?=$row['13']?></b></td>
                  <?php }
                  elseif($row['12']=='2'){?> <td colspan="2" style='text-align:center;'><b>Total Marks:<?=$row['14']?></b></td>
                    <td style='text-align:center;' ><b>Obtained Marks:<?=$row['13']?></b></td>
                  <?php }
                    ?> 
                  </tr>

                    <?php     
}

$count++;

}


    ?>

  
  
               
</tbody></table>
 <?php


  if($declare!='')
 {?>
Declared On :   <?php echo $t = $declare;} ?>

</div>

</div>

</div>



 <p align="center">

              <i class="fa fa-print fa-2x"  style="color:#002147" id="printbtn" onclick="printDiv()"></i><br></p> 
</body>
</html>
