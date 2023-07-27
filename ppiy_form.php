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
      <div class="col-lg-5 col-md-5 col-sm-5">
         <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">Personal Performance Index</h3>
              
            
            </div>
            <!--  <form class="form-horizontal" action="" method="POST"> -->
            <div class="card-body" id="" >
              <b style="color:red;text-align: center"> 1<sup>st</sup> August 2022 to 30<sup>th</sup> July 2023 </b>
                
                <form  method="post"  class="form-horizontal" enctype="multipart/form-data">   
                     <label>Faculty Category <b style="color:red;">*</b></label>

                     <input type="hidden"  name="IDNo" id="IDNo" value="<?= $EmployeeID;?>">

                     <select  id="faculty_type" class="form-control" Name='faculty_type' required >
                         <option value=''>Select </option>
                        <option value='Teaching'>Teaching</option>
                        <option value='Non-Teaching'>Non-Teaching</option>
                     
                     </select>


                      <input type="text"  class="form-control" name="teaching_load" id='teaching_load'>
                
                 <label>Book Published <b style="color:red;">*</b></label>
                  <select  id="book" class="form-control" Name='book' required >
                         <option value=''>Select </option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>
                          <option value='Not Applicable'>Not Applicable</option>
                     
                     </select>

                 <label>Research Paper Published <b style="color:red;">*</b></label>
                  <select  id="research_paper" class="form-control" Name='research_paper' required >
                         <option value=''>Select </option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>
                          <option value='Not Applicable'>Not Applicable</option>
                     
                     </select>



 <label>Consultancy<b style="color:red;">*</b></label>
                  <select  id="consultancy" class="form-control" Name='consultancy' required >
                         <option value=''>Select </option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>                                           
                     </select>


<label>Admission Participation<b style="color:red;">*</b></label>
                  <select  id="consultancy" class="form-control" Name='consultancy' required >
                         <option value=''>Select </option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>                                           
                     </select>


<label>Patient<b style="color:red;">*</b></label>
                  <select  id="patient" class="form-control" Name='patient' required >
                         <option value=''>Select </option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>   
                         <option value='Not Applicable'>Not Applicable</option>                                        
                     </select>

<label>Ph.D Candidate Supervised<b style="color:red;">*</b></label>
                  <select  id="patient" class="form-control" Name='patient' required >
                         <option value=''>Select </option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>   
                         <option value='Not Applicable'>Not Applicable</option>                                        
                     </select>

<label>Eligibility Enhanced <b style="color:red;">*</b></label>
                  <select  id="patient" class="form-control" Name='patient' required >
                         <option value=''>Select </option>
                        <option value='Yes'>Yes</option>
                        <option value='No'>No</option>   
                                                              
                     </select>


                     <div id='leavetype'  style="display:none" >
              <label>Leave Type<b style="color:red;">*</b></label>
                 <select  id="leavetype" class="form-control" Name='leavetype' required  >
                    <option value='NA'>Select </option>
                        <option value='Full'>Remaining Full Time</option>

                        <option value='Half'>Remaining Half Time</option>
                        
                     </select> 
</div>

                     <label>Location <b style="color:red;">*</b></label>
                     <select  id="location" class="form-control" Name='location'  required >
                         <option value=''>Select </option>
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
 <a class="btn btn-danger" href="movement-admin.php">
                  
                <i class="fas fa-walking"></i> &nbsp;
<?php 
 $count=0;
  $list_sql = "SELECT * FROM movement where superwiser_id='$EmployeeID' AND status='draft' ";
 //
$result = mysqli_query($conn,$list_sql);
 while($row = mysqli_fetch_array($result))  
      {
        $count++;
      }?>

                  <span class="badge bg-purple"><?=$count;?></span>
                </a>


            </div>
                </div>
               


                



</div>
<?php







if (isset($_POST['request_time_out'])) {




 $purpose=$_POST['purpose'];
$location= $_POST['location'];
 $leavetype= $_POST['leavetype'];
$remarks= $_POST['remarks'];
$exit_date =date('Y-m-d');

$noti=$purpose."(".$location.")";

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






$result = mysqli_query($conn,"INSERT into movement(emp_id,purpose,location,description,out_date,out_time,status,superwiser_id,college,department,designation,mobile,email,image,name,mleave,request_time,request_date)
                    values ('$EmployeeID','$purpose','$location','$remarks','$exit_date','$exit_time','$status','$superwiser_id','$college','$dep','$designation','$mob1','$email','$emp_image','$name','$leavetype','$exit_time','$exit_date')");



$Notification="INSERT INTO notifications (EmpID, SendBy, Subject, Discriptions, Page_link, DateTime, Status,Notification_type) VALUES ('$superwiser_id', '$EmployeeID', 'Time out Request','$noti', 'movement-admin.php','$timeStamp','0','0')";
           mysqli_query($conn,$Notification);

?>
<script> window.location.href="mytimeout.php";</script>

<?php }

?>
 <div class="panel-body">
 <div class="card-body" id="" >
  <div class="col-lg-12 col-md-4 col-sm-12">
         <div class="card-body card">

        <div class="btn-group w-100 mb-2">
                    <a class="btn"  id="btn6" style="background-color:#223260; color: white; border: 1px solid;" onclick="pending();bg(this.id);">My Request</a>
                    <!-- <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="acknowledged();bg(this.id);">Acknowledged</a> -->
                      <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="refused();bg(this.id);"> Refused</a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="Reports();bg(this.id);"> Reports </a>

                    
                  
                  <!--   <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="Copy();bg(this.id);"> Copy </a>
                    <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="Update();bg(this.id);"> Update </a> -->
                  </div>

         

         <div  id="table_load">


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


$(document).ready(function(){
    $('#purpose').on('change', function() {

            if ( this.value == 'Leave')
      
      {
        $("#leavetype").show();
      }
      else
      {
        $("#leavetype").hide();
      }
    });
});




 $(window).on('load', function() 
          {
            pending();
         $('#btn6').toggleClass("bg-success"); 
           })


function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }
  


     function pending()
          {
       var code=296;

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
                  pending();
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

