<?php 
   include "header.php"; 
    $code_access;  
    ?>

<section class="content">
   <div class="container-fluid">
  
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
  $staff="SELECT * FROM Staff Where (LeaveSanctionAuthority='$EmployeeID' OR LeaveRecommendingAuthority='$EmployeeID') ANd JobStatus='1'";

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
<div class="row">

<div class="col-sm-8">               <h3 class="card-title">My Reports</h3>


</div>
<div class="col-sm-4"> 

               <?php if($EmployeeID=='131053'||$EmployeeID=='121031')
             { ?>
              <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="Movements();bg(this.id);">  GKU Movements </a>


                    <!-- <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="adminreports();bg(this.id);"> GKU Report </a> -->
         <?php } ?>

     </div>
 </div>
</div>




 <div class="panel-body">
 <div class="card-body" id="" >
  <div class="col-lg-12 col-md-4 col-sm-12">
         <div class="card-body card">
        <div class="btn-group w-100 mb-2">
                    <a class="btn"  id="btn6" style="background-color:#223260; color: white; border: 1px solid;" onclick="pending();bg(this.id);">Pending </a>
                    <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="acknowledged();bg(this.id);">Granted</a>
                      <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="refused();bg(this.id);"> Refused</a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="Reports();bg(this.id);"> Reports </a>
                    
                   
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


function pending()
          {
            
       var code=285; 

       
    
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


  function grant(id,emp_id)
            {
            var code=297;
            var spinner=document.getElementById('ajax-loader');
            spinner.style.display='block';
            $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,id:id,emp_id:emp_id
                 },
            success: function(response) 
              {

               spinner.style.display='none';
               pending();
               
              }
                });
         }



  function cancel(id,emp_id)
            {
            var code=298;
            var a=confirm('Are you sure want to cancel');
        if (a==true) {
            var spinner=document.getElementById('ajax-loader');
            spinner.style.display='block';
            $.ajax({
            url:'action.php',
            type:'POST',
            data:{
                code:code,id:id,emp_id:emp_id
                 },
            success: function(response) 
              {
                   pending();
               spinner.style.display='none';
               
              }
                });
         }
}

function checkout(id)
          {
            
       var code=300; 
  var a=confirm('Are you reached at your office??');
        if (a==true) {
       
    
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
                console.log(response);
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }

 function Movements()
          {
       var code=302;

    
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




 function adminreports()
          {
       var code=303;

    
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

