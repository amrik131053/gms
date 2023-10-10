<?php 
ini_set('max_execution_time', '0');
   include "header.php";   
    $code_access;
   ?>

<section class="content">
   <div class="container-fluid">
      <div class="card card-info">
      </div>
      <div class="row">
         <div class="col-lg-12 col-sm-6">
            <div class="card card-primary ">
               <div class="card-header ">
                <br>
               <div class="row">
              <div class="col-lg-3">
              
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
              </div>
              <div class="col-lg-2">
                
                  <select  id="Course" class="form-control">
                     <option value=''>Select Course</option>
                 </select>
              </div>
              <div class="col-lg-2">
                
                   <select id="batch"  class="form-control">
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
              </div>
              <div class="col-lg-3">
               
                      <select   id='semester' class="form-control">
                        <option value="">SESSION </option>
                    <?php  $GetSession="SELECT DISTINCT Session FROM Admissions ";
                            $GetSessionRun=sqlsrv_query($conntest,$GetSession);
                            while($row=sqlsrv_fetch_array($GetSessionRun))
                            {
                                ?>
    <option value="<?=$row['Session'];?>"><?=$row['Session'];?></option>
                                <?php 
                            }
                    
                    ?>
            
            </select>
              </div>
              <div class="col-lg-2">
                
                 <button onclick="SearchReport();" class="btn btn-success">Search</button>
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
       var code=241;
       var CollegeID=document.getElementById('College').value;
       var Course=document.getElementById('Course').value;
       var batch=document.getElementById('batch').value;
       var semester=document.getElementById('semester').value;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,CollegeID:CollegeID,Course:Course,Batch:batch,Semester:semester
                  },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }  
     </script>
<p id="ajax-loader"></p>
<?php include "footer.php";  ?>