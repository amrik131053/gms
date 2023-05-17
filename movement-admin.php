<?php 
   include "header.php"; 
    $code_access;  
    ?>

<section class="content">
   <div class="container-fluid">
   <div class="card card-info">
   </div>
   <div class="row">
      <!-- left column -->
      <div class="col-lg-4 col-md-4 col-sm-4">
         <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">My Team</h3>
              
             <b id="total_count"></b>
            </div>
            <!--  <form class="form-horizontal" action="" method="POST"> -->
            <div class="card-body" id="" >
             

     <?php 
    $staff="SELECT * FROM Staff Where LeaveSanctionAuthority='$EmployeeID' ANd JobStatus='1'";

    $stmt = sqlsrv_query($conntest,$staff);  
   while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
        {



     $emp_image = $row_staff['Snap'];
  $empid = $row_staff['IDNo'];

      $name = $row_staff['Name'];

      $college = $row_staff['CollegeName'];
      $dep = $row_staff['Department'];
      $designation = $row_staff['Designation'];
      $mob1 = $row_staff['ContactNo'];
     
      $email = $row_staff['EmailID'];
      $superwiser_id = $row_staff['LeaveSanctionAuthority'];

        
?>

<div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header badge-success">
                <div class="row">
                  <div class="col-lg-11 col-sm-10"> <div class="widget-user-image">
                   
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($emp_image).'" height="30px" width="30px" class="img-circle elevation-2"  style="border-radius:50%"/>';?> 
                </div>
                <!-- /.widget-user-image -->
                <h6 class="widget-user-desc"><?=$name; ?>  &nbsp;(<?=$empid; ?>)</h6>
                
                <h6 class="widget-user-desc"><?= $designation;?></h6>
                <h6 class="widget-user-desc"> M. <?= $mob1 ?></h6>
                </div>
                <div class="col-lg-1 col-sm-1">

      </div>
             </div>
               
               


              </div>
          </div>
  <?php
     }

?>

                     
                  </div>
                  <!-- /.row -->
               </div>
            </div>
             
              
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    
  
             
   <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">My Reports</h3>
</div>




 <div class="panel-body">
 <div class="card-body" id="" >
  <div class="col-lg-12 col-md-4 col-sm-12">
         <div class="card-body card">
        <div class="btn-group w-100 mb-2">
                    <a class="btn"  id="btn6" style="background-color:#223260; color: white; border: 1px solid;" onclick="window.location.reload();bg(this.id);">Pending </a>
                    <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="acknowledged();bg(this.id);">Granted</a>
                      <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="refused();bg(this.id);"> Refused</a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="Reports();bg(this.id);"> Reports </a>
                     <?php if($EmployeeID=='131053')
             { ?>
              <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="Copy();bg(this.id);"> Movements </a>
                    <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="Update();bg(this.id);"> GKU Report </a>
         <?php } ?>
                   
                  </div>

         

         <div  id="table_load">

  <table class="table">
        <th>Emp ID</th><th>Name</th><th>Purpose</th><th>Location</th><th>Remarks</th><th>Date/Time</th><th>Action</th>
<?php 

   
     
 
 $list_sql = "SELECT * FROM movement where superwiser_id='$EmployeeID' AND status='Draft'  ORDER BY id DESC";
 //
$result = mysqli_query($conn,$list_sql);
 while($row = mysqli_fetch_array($result))  
      {  


$emp_image = $row['image'];
      $empid = $row['emp_id'];
     $name = $row['name'];
      $college = $row['college'];
  $dep = $row['department'];
      $designation = $row['designation'];
      $mob1 = $row['mobile'];
     
      $email = $row['email'];
       ?> 

        <?php 
 


?>
      
      <tr>
         <td><?php echo $empid;?></td> <td><?php echo  $name;?> </td><td>  <?php echo  $row['purpose'];?> </td><td>  <?php echo   $row['location'];?> </td><td>  <?php echo  $row['description'];?> </td><td>  <?php echo  $row['out_time']."/".$row['out_date'];?> </td><td> 
<form action="#" method="POST" ><input type="hidden" value="<?php echo  $row['id'];?>" name="id"> 
           <input type="submit" value="Grant" class="btn btn-primary btn-xs" name="accept">&nbsp;&nbsp;
       </form><form action="#" method="POST" ><input type="hidden" value="<?php echo  $row['id'];?>" name="id"> <input type="submit" value="Cancel" class="btn btn-primary btn-xs" name="cancel"></form> </td>
 </tr>

<?php



      }



?>
</table>
        </div>


   </div>


</div>
</div>
</div> 
              </div>
             


                  </div>
              
               
            </div>
            
            <!-- /.card-footer -->
            <!-- </form> -->
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>


<?php

if (isset($_POST['accept'])) {

 $id=$_POST['id'];

 $result = mysqli_query($conn,"update movement set status='Ack' where id='$id'");

 ?>
<script> window.location.href="movement-admin.php";</script>

<?php 


}?>

<?php

if (isset($_POST['cancel'])) {

 $id=$_POST['id'];

 $result = mysqli_query($conn,"update movement set status='Refused' where id='$id'");

 ?>
<script> window.location.href="movement-admin.php";</script>

<?php 


}?>

<script type="text/javascript">

 $(window).on('load', function() 
          {
         $('#btn6').toggleClass("bg-success"); 
           })
function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }
  

     function acknowledged()
          {
            
       var code=292;

       
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
                  },
            success: function(response) 
            {
                
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }


  function refused()
            {
            var code=293;
            var spinner=document.getElementById('ajax-loader');
            spinner.style.display='block';
            $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
                 },
            success: function(response) 
              {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
              }
                });
         }

 function Reports()
          {
       var code=294;

       
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
                  },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }



  function checkin(id)
          {
       var code=288;

       
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,id:id
                  },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }










</script>


</br>
<p id="ajax-loader"></p>




<div>











<?php include "footer.php";  ?>

