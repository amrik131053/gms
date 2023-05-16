<?php 
   include "header.php"; 
    $code_access;  
    ?>
<script>
   $(document).ready(function(){
   
       $(document).on('keydown','.subject_code', function() {
   
           // Initialize jQuery UI autocomplete
           $("#subject_code").autocomplete({
                 source: function( request, response ) {
               $.ajax({
         
               url: "action.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,code:116
                 },
                 success: function( data ) {
                     response( data );
                     // console.log(data);
                 },
                 error: function (error) {
                 // console.log(error);
                  }
               });
             },
             select: function (event, ui) {
               $(this).val(ui.item.label); // display the selected text
               var subject_code = ui.item.value; // selected value
   
                       
             return false;
             }
           });
       });
     });
</script>
<section class="content">
   <div class="container-fluid">
   <div class="card card-info">
   </div>
   <div class="row">
      <!-- left column -->
      <div class="col-lg-3 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">Request Time out</h3>
              
             <b id="total_count"></b>
            </div>
            <!--  <form class="form-horizontal" action="" method="POST"> -->
            <div class="card-body" id="" >
             
                <form  method="post"  class="form-horizontal" enctype="multipart/form-data">   
                     <label>Purpose<b style="color:red;">*</b></label>

                     <input type="hidden"  name="IDNo" id="IDNo" value="<?= $EmployeeID;?>">
                     <select  id="purpose" class="form-control" Name='purpose' >
                        <option value='Official'>Official</option>
                        <option value='Personal'>Personal</option>
                        <option value='Leave'>Leave</option>
                     </select>
                
                 
                     <label>Location <b style="color:red;">*</b></label>
                     <select  id="location" class="form-control" Name='location' >
                        <option value='Inside Campus'>Inside Campus</option>
                        <option value='Outside Campus'>Outside Campus</option>
                     </select>                 
                                          
                  
                <label><b style="color:black">Enter Remarks</b></label><textarea rows="3"  class="form-control" name="remarks"></textarea>
   <br>
       
     
      
      <input type="submit" class="form-control btn btn-primary"  name="request_time_out" >
   </form>
                    
                  </div>
                  <!-- /.row -->
               </div>
            </div>
             
              
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    
  
             
   <div class="card card-info">
            <div class="card-header">
                <div class="row">
<div class="col-sm-10"><h3 class="card-title">My Time out's</h3></div>
<div class="col-sm-2">
 <a class="btn btn-app bg-success">
                  <span class="badge bg-purple">891</span>
                  <i class="fas fa-users"></i> Requests
                </a>


            </div>
                </div>
               


                



</div>
<?php







if (isset($_POST['request_time_out'])) {




 $purpose=$_POST['purpose'];
$location= $_POST['location'];
$remarks= $_POST['remarks'];
$exit_date =date('Y-m-d');


date_default_timezone_set("Asia/Kolkata"); 
$exit_time = date('H:i');
 $status='draft';


  $staff="SELECT * FROM Staff Where IDNo='$EmployeeID'";
    $stmt = sqlsrv_query($conntest,$staff);  
   while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
        {

    // $emp_image = $row_staff['image'];
      $empid = $row_staff['IDNo'];

      $name = $row_staff['Name'];

      $college = $row_staff['CollegeName'];
      $dep = $row_staff['Department'];
      $designation = $row_staff['Designation'];
      $mob1 = $row_staff['ContactNo'];
     
      $email = $row_staff['EmailID'];
      $superwiser_id = $row_staff['LeaveSanctionAuthority'];

        }






  $result = mysqli_query($conn,"INSERT into movement(emp_id,purpose,location,description,out_date,out_time,status,superwiser_id,college,department,designation,mobile,email,image,name)
                                                 values ('$EmployeeID','$purpose','$location','$remarks','$exit_date','$exit_time','$status','$superwiser_id','$college','$dep','$designation','$mob1','$email','$emp_image','$name')");

?>
<script> window.location.href="mytimeout.php";</script>

<?php }

?>
 <div class="panel-body">
 <div class="card-body" id="" >
  <div class="col-lg-12 col-md-4 col-sm-12">
         <div class="card-body card">
        <div class="btn-group w-100 mb-2">
                    <a class="btn"  id="btn6" style="background-color:#223260; color: white; border: 1px solid;" onclick="window.location.reload();bg(this.id);">Pending </a>
                    <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="acknowledged();bg(this.id);">Acknowledged</a>
                      <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="refused();bg(this.id);"> Refused</a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="Reports();bg(this.id);"> Reports </a>
                  
                  <!--   <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="Copy();bg(this.id);"> Copy </a>
                    <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="Update();bg(this.id);"> Update </a> -->
                  </div>

         

         <div  id="table_load">

  <table class="table">
        <th>Emp ID</th><th>Name</th><th>Purpose</th><th>Location</th><th>Remarks</th><th>Date/Time</th>
<?php 

   
     
 
 $list_sql = "SELECT * FROM movement where emp_id='$EmployeeID' AND status='draft'  ORDER BY id DESC ";
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
      
      <tr><form action="#" method="POST" >
         <td><?php echo $empid;?><input type="hidden" value="<?php echo  $row['id'];?>" name="id"> </td> <td><?php echo  $name;?> </td><td>  <?php echo  $row['purpose'];?> </td><td>  <?php echo   $row['location'];?> </td><td>  <?php echo  $row['description'];?> </td><td>  <?php echo  $row['out_time']."/".$row['out_date'];?> </td>
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
       var code=285;

       var IDNo=document.getElementById('IDNo').value;
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,IDNo:IDNo
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
       var code=286;

       var IDNo=document.getElementById('IDNo').value;
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,IDNo:IDNo
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
       var code=287;

       var IDNo=document.getElementById('IDNo').value;
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,IDNo:IDNo
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

