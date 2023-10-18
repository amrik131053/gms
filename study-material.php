<?php 
ini_set('max_execution_time', '0');
   include "header.php";   
    $code_access;
   ?>

<section class="content">
   <div class="container-fluid">
      
      <div class="row">
         <div class="col-lg-12 col-sm-6">
            <div class="card card-primary ">
               <div class="card-header">
               study material
              <div class="card-tools">
              
                   
                   <div class="input-group input-group-sm">
                   
                 <select  name="College" id='College' onchange="courseByCollege(this.value);" class="form-control">
                 <option value=''>Select Course</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
             
             
                    
                     
            
                
                 <button onclick="SearchReport();" class="btn btn-success btn-sm">Search</button>
             
                &nbsp;
                &nbsp;
                &nbsp;
                 <button onclick="exportStudyMaterial();" class="btn btn-success btn-sm">Export</button>
              </div>
            
            </div>
               </div>
               <div class="card-body">
                
              
                  
                        <div id="table_load">
                         
                   
                     
                  </div>
               </div>
               <!-- /.card -->
            </div>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>
<script>
function SearchReport()
          {
       var code=244;
       var CollegeID=document.getElementById('College').value;
    //    var Course=document.getElementById('Course').value;
    //    var oddeven=document.getElementById('oddeven').value;
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,CollegeID:CollegeID
                  },
            success: function(response) 
            {
                
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }  
function exportStudyMaterial()
          {
 
       var CollegeID=document.getElementById('College').value;
       var exportCode=32;
       window.location.href="export.php?exportCode="+exportCode+"&CollegeID="+CollegeID;

     }  
     </script>
<p id="ajax-loader"></p>
<?php include "footer.php";  ?>