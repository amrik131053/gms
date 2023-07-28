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
<div class="row">

<div class="col-sm-8">               <h3 class="card-title">My Reports</h3>


</div>
<div class="col-sm-2">
</div> 
<div class="col-sm-2"> 

               <?php if($EmployeeID=='131053' ||$EmployeeID=='121031')
             { ?>
              <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="gku_export();bg(this.id);">GKU Export </a>


                    <!-- <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="adminreports();bg(this.id);"> GKU Report </a> -->
         <?php } ?>

     </div>
 </div>
</div>




 <div class="panel-body">
 <div class="card-body" id="" >
  <div class="col-lg-12 col-md-4 col-sm-12">
         <!-- <div class="card-body card"> -->
        <div class="btn-group w-100 mb-2">
                    <!-- <a class="btn"  id="btn6" style="background-color:#223260; color: white; border: 1px solid;" onclick="pending();bg(this.id);">Pending </a> -->
                    <!-- <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="acknowledged();bg(this.id);">Granted</a>
                      <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="refused();bg(this.id);"> Refused</a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="Reports();bg(this.id);"> Reports </a> -->
                    
                   
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

   <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" >
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verify Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body" id="edit_stu">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="save_rmarks()">Save changes</button>
      </div>
    </div>
  </div>
</div>





   <div class="modal fade bd-example-modal-xl1" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" >
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Verify Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body" id="edit_stu1">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

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
  

   function view_marks(id)
          {
            
       var code=9;
       
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'slefapprisalaction.php',
            type:'POST',
            data:{
               code:code,id:id
                  },
            success: function(response) 
            {
                
               spinner.style.display='none';
               document.getElementById("edit_stu1").innerHTML=response;
            }
         });

     }


     function updte_marks(id)
          {
            
       var code=7;
       
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'slefapprisalaction.php',
            type:'POST',
            data:{
               code:code,id:id
                  },
            success: function(response) 
            {
                
               spinner.style.display='none';
               document.getElementById("edit_stu").innerHTML=response;
            }
         });

     }


function pending()
          {
            
       var code=6;

       
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'slefapprisalaction.php',
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


  function save_rmarks()
            {
var val=0;
var warning_yesno = document.querySelector('input[type=radio][name=warning_yesnoc1App]:checked');
               var  warning_yesno_ctegory=warning_yesno.value;
var recid=document.getElementById('recid').value;    
var appid=document.getElementById('appid').value;    
var muid=document.getElementById('muid').value;    
var warning=document.getElementById('warning').value;
var behaviour=document.getElementById('behaviour').value;
var deadlines=document.getElementById('deadlines').value;
var coordination=document.getElementById('coordination').value;
if (warning_yesno_ctegory=='Yes') {
  if(warning > -1 && warning < 11 && warning!='')
  {

  }
  else
  {
  	 ErrorToast('Warning must be  0 or more','bg-danger');
  	 val=1;
  }
warning_yesno_ctegory="Yes";
}
else
{
    var warning="";
    warning_yesno_ctegory="No";
}
 if(behaviour > -1 && behaviour < 11 && behaviour!='')
  {

  }
  else
  {
  	 ErrorToast('Behaviour must be between  0  to 10 ','bg-danger');
  	 val=1;
  }

 if(deadlines > -1 && deadlines < 11 && deadlines!='')
  {

  }
  else
  {
  	 ErrorToast('Deadlines must be between  0  to 10 ','bg-danger');
  	 val=1;
  }


 if(coordination > -1 && coordination < 11  && coordination!='')
  {

  }
  else
  {
  	 ErrorToast('Coordination must be between  0  to 10 ','bg-danger');
  	 val=1;
  }



if(val>0)
{

      ErrorToast('data must be correct','bg-danger' );
        
}
else
{
var code=8;

               var spinner=document.getElementById('ajax-loader');
            spinner.style.display='block';
            $.ajax({
            url:'slefapprisalaction.php',
            type:'POST',
            data:{
               code:code,muid:muid,warning:warning,behaviour:behaviour,deadlines:deadlines,coordination:coordination,recid:recid,appid:appid,warning_yesno_ctegory:warning_yesno_ctegory
                 },
            success: function(response) 
              { 

              	// console.log(response);

              	spinner.style.display='none';
  	 SuccessToast('Successfully Uploaded');
              
               pending();
               
              }
                });
        }
       
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

     function gku_export()
          {
       var exportCode=21;
    window.location.href="export.php?exportCode="+exportCode;

     }

</script>
</br>
<p id="ajax-loader"></p>




<div>




<script>
               function emc1_show() {
               var x = document.getElementById("warning_div");
               // alert();
               x.style.display = "block";
               
               
               }
                      function emc1_hide() {
               var x = document.getElementById("warning_div");
               
               x.style.display = "none";
             document.getElementById("warning").value="";

               }
               
               
            </script>






<?php include "footer.php";  ?>

