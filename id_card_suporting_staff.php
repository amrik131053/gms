<?php 
include "header.php";
include "connection/connection.php";
?>
<p id="ajax-loader"></p>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
          
         <!-- Button trigger modal -->
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-info">
               <div class="card ">
                  
                <div class="row">
                            <div class="card-body  ">
                  
                    <a class="btn"  id="btn6"  style="background-color:#223260; color: white; border: 1px solid;" onclick="ID_card();bg(this.id);"> ID Card </a>
                  <!-- </div> -->
              </div>
                <!-- </div> -->
              </div>
            </div>

               
    
                  <div class="card-body">
                    <div class="container-fluid">
 
</div>
                     <div class="form-group card-body table-responsive  row ">



<table class="table table-striped" id="example">
         <thead>
          <tr> 
         <th><input type="checkbox" name=""></th>  
         <th>Image</th>            
          <th>Name</th>
         <th>Father Name</th>
          <th>ID</th>
          <th>Department</th>
          <th>Designation</th>
          <th>Mobile Number</th>  
          <th>Address</th> 
          <th>Status</th>      
         
         </tr>
                   </thead>
    <tbody id="d_card_record">
<?php
$sql="SELECT * FROM Staff where IDNo BETWEEN 1 and 99999 and  JobStatus='1'";
$result = sqlsrv_query($conntest,$sql); 
while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
{
$IDNo=$row['IDNo'];
    ?>
    
  <tr>
    <td><input type="checkbox" name="" class="sel" value="<?=$row['IDNo'];?>" ></td>
    <td> <?php echo '<img src="http://10.0.10.11:86/images/Staff/'.$IDNo.'.jpg" height="50" width="50" class="img-thumnail" style="border-radius:50%">';?>   
    </td>
     <td><?=$row['Name'];?></td>
      <td><?=$row['FatherName'];?></td>
       <td><?=$row['IDNo'];?></td>
        <td><?=$row['Department'];?></td>
         <td><?=$row['Designation'];?></td>
          <td><?=$row['MobileNo'];?></td>
          <td><?=$row['PermanentAddress']; 
               ?>
            </td>
            <td><?php
            $IDNo=$row['IDNo'];
               $sql1="SELECT * FROM Suporting_staff where IDNo='$IDNo'";
$result1 = mysqli_query($conn,$sql1); 
if($row1=mysqli_fetch_array($result1) )
{
          if ($row1['Status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}
}
?>
</td>
</tr>
<?php
}
    

?>

    </tbody>
  </table>

  </form>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<script type="text/javascript">
          
     

function ID_card()
{

  var id_array=document.getElementsByClassName('sel');
  var len_id= id_array.length;
  var id_array_main=[];
    var code=3;
    for(i=0;i<len_id;i++)
     {
      if(id_array[i].checked===true)
       {
        id_array_main.push(id_array[i].value);
        }
     }
    window.open('print_id_card_pass.php?id_array='+id_array_main+'&code='+code,'_blank');
}


   
</script>
<?php include "footer.php";

?>