
<div style="border-radius: 2px;border: 2px;border-style: groove;" >

<?php  
include '../connection/connection.php';

$output = '';  
//$ctime = date("d-m-Y");
//$nowtime = strtotime($ctime);
$reference = $_GET['reference_no'];
$sql = '';


$list_sqlw = "SELECT * FROM  ledger_return where reference_no='$reference'";
$result1 = mysqli_query($connection_s,$list_sqlw); 
while($row = mysqli_fetch_array($result1))  
      { 
$reference_num=$row["reference_no"];
$request_no=$row["id"];
$request_status=$row["request_status"];

$college_dept=$row["college_dept"];
$college=$row["college"];

$name=$row["name"];
$designation=$row["designation"];
$r1_date=$row["submit_date"];
$r_date=date("d-m-Y", strtotime($r1_date));

$v1_date=$row["verify_date"];
$v_date=date("d-m-Y", strtotime($v1_date));

$v_autho=$row["varify_authority"];

$v_id=$row["varify_id"];
$v_designation=$row["varify_desig"];




}

 $list_sql = "SELECT * FROM returned where reference_no='$reference'";
$result = mysqli_query($connection_s,$list_sql); 
$count = 1; 
?>
                           <div class="row"> 
                          <table  class="table table-striped"  id="example"> <tr><th  style="min-width:auto;margin-left: 30px;text-align: left;">
                           No:<b> <?php echo $request_no;?></b></th>  <th   style="text-align: center;"> <h1> Central Store</h1><p style="margin-top: -10px">
                     Guru Kashi University</p></th><th style="text-align: right;" >
                          <img src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $reference_num;?>&code=Code11&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0' alt='Barcode '/></th></tr> 
 
                         
                     
                   <tr>
                         <th >
                          <h4>College: <?php echo $college;?></h4></th><th style="text-align: center;"> </th><th><h4> Department: <?php echo $college_dept;?></h4></th>

</tr></table>
                       </div>

     <form action="category_action.php" method="post"> <div class="table-responsive">  

           <table class="table table-striped" id="example" >  

      <thead>
                <tr>  
                    <th style="width=15px">Sr no</th>
          <th>Category</th>
          <th style="width: 120px">Article</th>
          <th>Specification</th>
            <th style="width: 40px">Quantity</th>
           
          <th style="width: 40px">Accepted</th>
           <th style="width: 40px">Not Working</th>
                </tr>
      </thead><tbody>

        <?php  
 if(mysqli_num_rows($result) > 0)  
 {  $i=1;
      while($row = mysqli_fetch_array($result))  
      {   
          ?>  
                <tr> 
                <input type="hidden" name="code" value="3"> 
                
                    <td> <input type="hidden"  name="id[]" value="<?php echo $row["id"];?>"><?= $i;?></td>  
                    <td><?php echo $row["category_name"];?></td>
              <td><?php echo $row["item_name"];?></td>
          <td><?php echo $row["specification"];?></td>
            <td style="width: 40px;text-align: center;"><?php echo $row["quantity"];?></td>
               <td style="width: 40px;text-align: center;"><?php echo $row["acceptable_qty"];?></td>
                 <td style="width: 40px;text-align: center;"><?php echo $row["notworking_qty"];?></td>
        
                </tr>  
            
    <?php 
    $i++;  }  
 } 
 else  
 {   
?>
  
 <?php }  ?>
 </tbody></table> 
<br>
<div class="row"><hr>
  <div class="col-lg-3">

Request By:<br><b>
<?php echo $name ;?></b><br>

<?php echo $designation ;?><br>

<?php

if($college_dept!="")
{ 
  echo $college_dept ;
}
  else{
  echo $college;

}?><br><b> <?php  echo $r_date  ?> </b>





</div>

<div class="col-lg-2">
</div>
<!--<div class="col-lg-4">

Verified By:<b><br>
<?php echo $v_autho ;?></b><br>

<?php echo $v_designation ;?><br>
<?php echo "Guru Kashi University" ;?>
<br><b> <?php  echo $v_date  ?> </b>

<br>

</div>-->

<div class="col-lg-2">
</div>


</div>

</form>

      </div> 
 

</div>