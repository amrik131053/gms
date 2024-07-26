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
      <div class="col-lg-3 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">Request Time out</h3>
              
             <b id="total_count"></b>
            </div>
            <!--  <form class="form-horizontal" action="" method="POST"> -->
            <div class="card-body" id="" >
             
              
                     <label>Purpose<b style="color:red;">*</b></label>
<select  id="purpose" class="form-control" Name='purpose' required >
                         <option value=''>Select </option>
                        <option value='Official'>Official</option>
                        <option value='Personal'>Personal</option>
                        <option value='Leave'>Leave</option>
                     </select>
                     <div id='leavetype'  style="display:none" >

              <label>Leave Type<b style="color:red;">*</b></label>
                 <select  id="leavetype1" class="form-control" Name='leavetype' required  >
                    <option value='NA'>Select</option>
                        <option value='Full'>Remaining Full Time</option>

                        <option value='Half'>Remaining Half Time</option>
                        
                     </select> 
</div>

  <label>Exit Time<b style="color:red;">*</b></label>
  <input type="time" class="form-control" name='exittime' id='exittime'>

                     <label>Location <b style="color:red;">*</b></label>
                     <select  id="location" class="form-control" Name='location'  required >
                         <option value=''>Select </option>
                        <option value='Inside Campus'>Inside Campus</option>
                        <option value='Outside Campus'>Outside Campus</option>
                     </select>                 
                                          
                  
                <label><b style="color:black">Enter Remarks</b></label><textarea rows="3"  class="form-control" id="remarks"></textarea>
   <br>
       
     
      
      <input type="submit" class="form-control btn btn-primary"  name="request_time_out" onclick="Submit_timeout();" >

                    
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

 $list_sql = "SELECT * FROM MovementRegister where Supervisor='$EmployeeID' AND Status='draft' ";
 //
$stmt1 = sqlsrv_query($conntest,$list_sql, array(), array( "Scrollable" => 'static' ));  
$count = sqlsrv_num_rows($stmt1);

?>
     <span class="badge bg-purple"><?=$count;?></span>
     </a>
     </div>
     </div>
    </div>


 <div class="panel-body">
 <div class="card-body" id="" >
  <div class="col-lg-12 col-md-4 col-sm-12">
         <!-- <div class="card-body card"> -->

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


   <!-- </div> -->


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
       var code=286;

       
    
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
       var code=287;

   
    
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
                  pending();
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }


  function cancel(id)
          {
       var code=381;

       
    
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

function view_movment_status(id)
{
var code=382;

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
                //console.log(response);
                 // pending();


               spinner.style.display='none';
               document.getElementById("edit_stu").innerHTML=response;
            }
         });

}





















function Submit_timeout()
{
var code=380;
var purpose=document.getElementById('purpose').value;
var location=document.getElementById('location').value;

var remarks=document.getElementById('remarks').value;
var exittime=document.getElementById('exittime').value;
 if(purpose=='Leave')
 {
    var leavetype=document.getElementById('leavetype1').value;
 }
 else
 {
var leavetype='NA';
 }

if(exittime!='' && purpose!='' && location!=''remarks!='')
{

var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,purpose:purpose,location:location,leavetype:leavetype,remarks:remarks,exittime:exittime
                  },
            success: function(response) 
            {
                //console.log(response);
                  pending();
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
}
}
else
{
    
}
</script>


</br>
<p id="ajax-loader"></p>




<div>



<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"  id="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Movment Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_stu">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>







<?php include "footer.php";  ?>

