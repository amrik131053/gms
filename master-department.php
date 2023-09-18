 <?php 
  include "header.php";   
?>
 <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="html5-qrcode.min.js"></script>
   <section class="content">
      <div class="container-fluid">
        <div class="row">
  
           
          <div class="col-lg-12 col-sm-3 col-md-12">
            <div class="card card-info">
              <div class="card-header">
<div class="row">
	<div class="col-lg-2">
                <Button  data-toggle="modal"  data-target="#meter_modal"  value="New Designation" class="btn btn-primary">New Designation </Button>
            </div>
                 
      	    <div class="col-lg-3">
      	  <select  name="College" id='CollegeID'  class="form-control" required="" >

                <option value=''>Select College</option>
                  <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $college = $row1['CollegeName']; 
     $CollegeID = $row1['CollegeID'];
    ?>
<option  value="<?=$CollegeID;?>"><?= $college;?></option>
<?php    }

?>
              </select> 
   </div>
    
    <input type="submit"  onclick="search();"  value="Search" class="btn btn-success"> 


               </div>
            

             
            </div>
        <div class="card-body table-responsive " style="height:700px;" id="tab_data">
                  
               </div>
            <!-- /.card -->
          </div>
        
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Designation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">View  Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  id='update_data'>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="meter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">New Desingation</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            

              
    
    
     <div class="row">
        <div class="col-lg-1"></div>
      <div class="col-lg-10"> 
      	    <label>College</label>
      	  <select  name="College" id='CollegeIDN'  class="form-control" required="">
                <option value=''>Select Course</option>
                  <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $college = $row1['CollegeName']; 
     $CollegeID = $row1['CollegeID'];
    ?>
<option  value="<?=$CollegeID;?>"><?= $college;?>(<?=$CollegeID;?>)</option>
<?php    }

?>
              </select> 
    <label>Designation</label>
    <input type="text" name="table_search" id="department" class="form-control" required>
    <br>
    <input type="submit"  onclick="save();"  value="save" class="btn btn-secondary"> 

    </div>
    <div class="col-lg-1"></div>

    </div>
<br>
   
     
     
                
      </div>
   </div>
</div>

<script>


function search()
          {
       var code=327;

       var college=document.getElementById('CollegeID').value;
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,college:college},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("tab_data").innerHTML=response;
               }
         });

     }

</script>

<script>

function update_dep(id)
          {
       var code=328;

       
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,id:id},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("update_data").innerHTML=response;
               }
         });

     }







    function Updatedepdata(id)

   {
       var code=329;
 var shortname=document.getElementById('shortname').value;
  var fullname=document.getElementById('fullname').value;
   var college=document.getElementById('CollegeID').value;
      
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,id:id,shortname:shortname,fullname:fullname,college:college},
                success: function(response) 
               { 
               spinner.style.display='none';
                 search();
                SuccessToast('Successfully Updated');

              // document.getElementById("update_data").innerHTML=response;
               }
         });

     }


function delete_dep(id)
{
var code=331;
 var spinner=document.getElementById('ajax-loader');

         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,id:id},
                success: function(response) 
               { 
               	console.log(response);
               spinner.style.display='none';
               search();
                SuccessToast('Successfully Deleted');
              // document.getElementById("tab_data").innerHTML=response;
               }
         });

}







     	function save()
	{
		var code=330;

       var college=document.getElementById('CollegeIDN').value;
       var department=document.getElementById('department').value;
    
         var spinner=document.getElementById('ajax-loader');

         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,college:college,department:department},
                success: function(response) 
               { 
               	console.log(response);
               spinner.style.display='none';
               search();
                SuccessToast('Successfully Updated');
              // document.getElementById("tab_data").innerHTML=response;
               }
         });



	}
</script>




    <?php include "footer.php";

     ?>