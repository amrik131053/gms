<?php 
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         
            <div class="col-lg-3 col-md-3 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Staff Profile</h3>
                     <div class="card-tools">
                     <div class="btn-group input-group-sm">
                                 <input type="text"  style="width:150px "  name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Employee ID" aria-describedby="button-addon2" value="">
                              <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="student_search();" name="search"><i class="fa fa-search"></i></button>
                           </div>
                     
                  </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0"  id="student_search_record">
                     
                  </div>

                 
               </div>
              
            </div>
            <div class="col-md-9 col-lg-9 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Staff Entries  </h3>
                  
               </div>
             
                  <div class="card-body" id="checked_out_students"  >
                     <table class="table">
  
        <th>Emp ID</th><th>Name</th><th>Purpose</th><th>Location</th><th>Exit Date/Time</th><th>Remarks</th><th>Action</th>
       <?php 
 $list_sql = "SELECT * FROM movement where  (status='Ack' OR status='check-out')  AND location='Outside Campus'   ORDER BY id DESC ";
 //
$result = mysqli_query($conn,$list_sql);
while($row=mysqli_fetch_array($result)) 
  {
     $emp_image = $row['image'];
      $empid = $row['emp_id'];
      $name = $row['name'];
      $college = $row['college'];
      $dep = $row['department'];
      $designation = $row['designation'];
      $mob1 = $row['mobile'];
     
      $email = $row['email'];
     $status= $row['status']; ?> 
 

      
      <tr>
         <td><?php echo $empid;?> </td> <td><?php echo  $name;?> </td><td>  <?php echo  $row['purpose'];?> </td><td>  <?php echo   $row['location'];?> </td><td>  <?php echo  $row['out_time']."/".$row['out_date'];?> </td><td>  <?php echo  $row['description'];?></td>
         <td> <?php if($status=='Ack')
         {?>  
            <form action="" method="POST">
               <input type="hidden" value="<?php echo  $row['id'];?>" name="id"> 

         <input type="hidden" value="<?php echo  $row['purpose'];?>" name="purpose"><button class="btn btn-success btn-xs"  name='checkout' type="Submit">Check Out
         </button> </form>
      <?php 
   }
      else if($status=='check-out' AND $row['purpose']!='Leave' ) {
         ?>
      
         <form action="" method="POST">
               <input type="hidden" value="<?php echo  $row['id'];?>" name="id"> 

         <input type="hidden" value="<?php echo  $row['purpose'];?>" name="purpose"><button class="btn btn-danger btn-xs"  name='checkin' type="Submit">Check in
         </button></form> 
         <?php }
         else {
            echo " on Leave";
         }?>

      </td>
 </tr>

<?php



      }



if (isset($_POST['checkout'])) {

 echo $id=$_POST['id'];

echo $purpose=$_POST['purpose'];

if($purpose!='Leave')
{
   $result = mysqli_query($conn,"update movement set status='check-out' where id='$id'");
}
else
{
   echo "ye to gya";

 $result = mysqli_query($conn,"update movement set status='check-out' where id='$id'");
}
 ?>
<script> window.location.href="staff_entry.php";</script>

<?php 


}



?>
</table>
                  </div>

                  <div class="card-footer">           
                  </div>
                  <!-- /.card-footer -->
              
            </div>

            <!-- /.card -->
         </div>
       
      
        
      </div>
      
   </div>
 
</section>
<p id="ajax-loader"></p>

<script type="text/javascript">
   window.onload = function() {
  //checked_out_student();
};
   function checked_out_student() 
   {
      
      var code=144;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code
         },
         success:function(response) 
         {
            // student_search();
            document.getElementById("checked_out_students").innerHTML =response;
         }
      });
   }
   function gateEntryCheckIn(studentId,direction,gateEntryId)
   {
       // alert(direction);
      var code=142;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,studentId:studentId,direction:direction,gateEntryId:gateEntryId
         },
         success:function(response) 
         {
            checked_out_student();
            student_search();
            // console.log(response);
            // document.getElementById("student_search_record").innerHTML =response;
         }
      });
   }
   function gateEntryCheckOut(studentId,direction)
   {
      // alert(studentId);
      var code=143;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,studentId:studentId,direction:direction
         },
         success:function(response) 
         {
            checked_out_student();
            student_search();
            // document.getElementById("student_search_record").innerHTML =response;
         }
      });
   }
  
   function student_search()
   {
      var code=257;
      var rollNo= document.getElementById("student_roll_no").value;
      if (rollNo!='') 
      {
         var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,rollNo:rollNo
            },
            success:function(response) 
            {
               spinner.style.display='none';
               document.getElementById("student_search_record").innerHTML =response;
            }
         });
      }
      else
      {
         // alert("Please Enter the Roll No.");
         document.getElementById("student_search_record").innerHTML ='';
      }
   } 
   function studentDetail(IDNo)
   {
      var code=141;
      document.getElementById("student_roll_no").value=IDNo;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,rollNo:IDNo
         },
         success:function(response) 
         {
            document.getElementById("student_search_record").innerHTML =response;
         }
      });
      
   }
    
</script>

<?php include "footer.php";  ?>