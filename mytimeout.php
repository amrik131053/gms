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

                     <input type="text"  name="IDNo" id="IDNo" value="<?= $EmployeeID;?>">
                     <select  id="purpose" class="form-control" Name='purpose' >
                        <option value='Offcial'>Official</option>
                        <option value='Personal'>Personal</option>
                     </select>
                
                 
                     <label>Location <b style="color:red;">*</b></label>
                     <select  id="location" class="form-control" Name='location' >
                        <option value='Inside Campuse'>Inside Campus</option>
                        <option value='Outside Campus'>Outside Campus</option>
                     </select>                 
                                          
                  
                <label><b style="color:black">Enter Remarks</b></label>

      <textarea rows="3"  class="form-control">
      </textarea>
   <br>
       
     
      
      <input type="submit" class="form-control btn btn-primary"  name="qpupload" >
   </form>
                    
                  </div>
                  <!-- /.row -->
               </div>
            </div>
             
              
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    
  
             
   <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">My Time out's</h3>
</div>

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
       <th>Photo</th> <th>Emp ID</th><th>Name</th><th>Purpose</th><th>Location</th><th>Remarks</th><th>Date/Time</th>
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
          <td style="width: 50px;text-align: center;"> <p style="text-align: center"><img src="images/faculty/<?=$emp_image;?>" style="border-radius:50%;height: 50px;width:50px"></p> </td><td><?php echo $empid;?><input type="hidden" value="<?php echo  $row['id'];?>" name="id"> </td> <td><?php echo  $name;?> </td><td>  <?php echo  $row['purpose'];?> </td><td>  <?php echo   $row['location'];?> </td><td>  <?php echo  $row['description'];?> </td><td>  <?php echo  $row['out_time']."/".$row['out_date'];?> </td>
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
      alert(IDNo);
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
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

