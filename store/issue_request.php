
<?php
session_start();
 include '../connection/connection.php';

?>







<div style="border-radius: 2px;border: 2px;border-style: groove;" >

<?php  
$output = '';  
//$ctime = date("d-m-Y");
//$nowtime = strtotime($ctime);
$reference = $_GET['reference_no'];
$sql = '';
$list_sqlw = "SELECT * FROM  ledger where reference_no='$reference'";
$result1 = mysqli_query($connection_s,$list_sqlw); 
while($row = mysqli_fetch_array($result1))  
      { 
$reference_num=$row["reference_no"];
$request_no=$row["id"];
$request_status=$row["request_status"];

$college_dept=$row["college_dept"];
$college=$row["college"];

$name=$row["name"];
$comments=$row["comments"];
$designation=$row["designation"];



$a_autho=$row["approving_athority"];
$a_autho_desig=$row["authority_desig"];
 $a1_date=$row["approved_date"];  
 $a_date=date("d-m-Y", strtotime($a1_date));


$r1_date=$row["submit_date"];
$r_date=date("d-m-Y", strtotime($r1_date));

$v1_date=$row["verify_date"];
$v_date=date("d-m-Y", strtotime($v1_date));

$v_autho=$row["varify_authority"];

$v_id=$row["varify_id"];
$v_designation=$row["varify_desig"];

}




 $list_sql = "SELECT * FROM request where reference_no='$reference'";
$result = mysqli_query($connection_s,$list_sql); 
$count = 1; 

?>  <div class="row"> 
                          <table  class="table table-striped"  id="example"> <tr><th  style="min-width:auto;margin-left: 30px;text-align: left;">
                           No:<b> <?php echo $request_no;?></b></th>  <th   style="text-align: center;"> <h3> Central Store</h3><p style="margin-top: -10px">
                     Guru Kashi University</p></th><th style="text-align: right;" >
                          <img src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $reference_num;?>&code=Code11&multiplebarcodes=false&translate-esc=false&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0' alt='Barcode '/></th></tr> 
 
                         
                     
                   <tr>
                         <th >
                          <h5>College: <?php echo $college;?></h5></th><th style="text-align: center;"> </th><th><h5> Department: <?php echo $college_dept;?></h5></th>

</tr></table>
                       </div>

     <form action="category_action.php" method="post"> <div class="table-responsive">  

           <table class="table table-striped" id="example" > 

      <thead>
               
                     <tr>  
                    <th style="width:15px">Sr no</th>
          <th>Category</th>
          <th style="width: 250px">Article</th>
          <th>Specification</th> <th>Comments</th>
            <th style="width: 50px">Quantity</th>
           
          
                </tr>
           
         
                
      </thead>
<?php 

      
 if(mysqli_num_rows($result) > 0)  
 {   $i=1;
      while($row = mysqli_fetch_array($result))  
      {  


          ?>  
                <tr> 
                  <form action="category_action.php" method="post">

                  <input type="hidden" name="item_code" value="<?php echo $row["item_code"];?>">
                   <input type="hidden" name="category_code" value="<?php echo $row["category_code"];?>"> 

                <input type="hidden" name="code" value="8"> 
                <input type="hidden" name="emp_id" value="<?php echo $a;?>"> 
                 <input type="hidden" name="reference_no" value="<?php echo $reference;?>"> 
                
                    <td> <input type="hidden"  name="id[]" value="<?php echo $row["id"];?>"><?=$i;?></td>  
                    <td><input type="hidden"   value="<?php echo $row["category_code"];?>"><?php echo $row["category_name"];?></td>
              <td><input type="hidden"   value="<?php echo $row["item_code"];?>"><?php echo $row["item_name"];?></td>
          <td><?php echo $row["specification"];?></td>
          <td><?php echo $comments;?></td>


            <td style="width: 50px"><input type="number"  name="app_qty[]" value="<?php if($row["category_name"]=='Electrical'||$row["category_name"]=='Plumbing'){

             echo  $row["quantity"];

              }
              else if($row["category_name"]=='Miscellaneous'AND $row["emp_id"]=='170675'||$row["emp_id"]=='170935'||$row["emp_id"]=='170236')

              {   

 echo  $row["quantity"];

              }
              else if($row["category_name"]=='Carpentory' AND $row["emp_id"]=='170675'||$row["emp_id"]=='170935')

              {   

 echo  $row["quantity"];

              }


              else{ echo $row["quantity"];}?>" style=" width: 60px; font-size: 18px;background: transparent;
    border: none;
    border-bottom: 1px solid #000000;"  ></td>
           
              
          <!--<td>
           <?php if($request_status=='pending')
       {?>
            <a href="#" onclick="delete_dr(<?php echo $row["id"];?>)"  class="glyphicon glyphicon-remove-sign" data-target=".bs-delete-model-sm" data-toggle="tooltip"  data-placement="top" title="Delete"></a><?php }

            else
              {
                echo "Approved";
              }?>
                  </td>-->
                </tr>  
            
    <?php 
    $i=$i+1;  }  
    ?><hr></tbody></table>   
 <?php
 } 
 else  
 {   
?>
  
 <?php }  ?>
 <br/><br/> <p align="center"> <input type="submit" class="btn btn-primary" value="issue"  ></p><br/><br/>


<div class="row"><hr>
  <div class="col-lg-3">

Requested By:<b><br>
<?php echo $name ;?></b><br>

<?php echo $designation ;?><br>

<?php

if($college_dept!="")
{ 
  echo $college_dept ;
}
  else{
  echo $college;
}?><br>
<?php echo $r_date;?>

</div>

<div class="col-lg-2">
</div>
<!--<div class="col-lg-3">

Verified By:<b><br>
<?php echo $v_autho ;?></b><br>

<?php echo $v_designation ;?><br>
<?php echo "Guru Kashi University" ;?>

<br><?php echo $v_date;?>


</div>-->

<div class="col-lg-1">
</div>
<div class="col-lg-3">

Approved By:<b><br>
<?php echo $a_autho ;?></b><br>

<?php echo $a_autho_desig ;?><br>
<?php echo "Guru Kashi University" ;?><br>
<?php echo $a_date;?>

<br>

</div>

</div>



<?php

?><br>




</form>



<script>
     $(function() { 
      $("#hide").click(function(e) {
        e.preventDefault();

      $("#hide").hide();
           
    });
  });
</script>
      </div> 
 

</div>