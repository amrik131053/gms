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
               Study Material
              <div class="card-tools">
              
                   
                   <div class="input-group input-group-sm">
                   
                 <!-- <select  name="College" id='College' onchange="courseByCollege(this.value);" class="form-control">
                 <option value=''>Select Course</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID  where  IDNo='$EmployeeID'";
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
              -->
             
                    
                     
            
                
                 <!-- <button onclick="SearchReport();" class="btn btn-success btn-sm">Search</button> -->
             
                &nbsp;
                &nbsp;
                &nbsp;
                 <!-- <button onclick="exportStudyMaterial();" class="btn btn-success btn-sm">Export</button> -->
              </div>
            
            </div>
               </div>
               <div class="card-body">
                <div class="row">
                
                  <div class="col-lg-2" style="text-align: left;">
                                <label>College Name</label>
                                <select id='College3' onchange="collegeByDepartment3(this.value);" class="form-control form-control-sm"
                                    required>
                                    <option value=''>Select Faculty</option>
                                    <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                                    <option value="<?=$CollegeID;?>"><?=$college;?> (<?=$CollegeID;?>)</option>
                                    <?php }
                        ?>
                        
                                </select>
                            </div>
                            <div class="col-lg-2" style="text-align: left;">
                                <label>Department</label>
                                <select id="Department3" class="form-control form-control-sm" onchange="fetchcourse3()" required>
                                    <option value=''>Select Department</option>
                                   
                                </select>
                            </div>
                            <div class="col-lg-2" style="text-align: left;">
                                <label>Course</label>
                                <select id="Course3" onchange="courseOnChnageOther(this.value);" class="form-control form-control-sm" required>
                                    <option value=''>Select Course</option>
                                </select>
                            </div>
                            
                           
                            <div class="col-lg-2" style="text-align: left;">
                                <label>Batch</label>
                                <select id="Batch3" class="form-control form-control-sm" required>
                                    <option value="">Batch</option>
                                    <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                               ?>
                                </select>
                            </div>
                       
                 
                            <div class="col-lg-2">
                               <label >Action</label><br>
                               <button onclick="SearchReport();" class="btn btn-success btn-sm">Search</button>
                               <button onclick="exportStudyMaterial();" class="btn btn-success btn-sm">Export</button>
                              </div>
                           </div>
                  
                        <div id="table_load" class="table table-responsive">
                         
                   
                     
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
   function collegeByDepartment3(College) {

var code = '304';
$.ajax({
    url: 'action.php',
    data: {
        College: College,
        code: code
    },
    type: 'POST',
    success: function(data) {
        // console.log(data);
        if (data != "") {

            $("#Department3").html("");
            $("#Department3").html(data);
        }
    }
});

}

function fetchcourse3() {
var College = document.getElementById('College3').value;
var department = document.getElementById('Department3').value;
var code = '305';
$.ajax({
    url: 'action.php',
    data: {
        department: department,
        College: College,
        code: code
    },
    type: 'POST',
    success: function(data) {
        if (data != "") {
            console.log(data);
            $("#Course3").html("");
            $("#Course3").html(data);
        }
    }
});
}
function SearchReport()
          {
      
       var code=244;
       var CollegeID=document.getElementById('College3').value;
       var Department=document.getElementById('Department3').value;
       var Course=document.getElementById('Course3').value;
       var Batch=document.getElementById('Batch3').value;
       if(CollegeID!='')
       {
       var spinner=document.getElementById('ajax-loader');
       spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,
               CollegeID:CollegeID,
               Department:Department,
               Course:Course,
               Batch:Batch
                  },
            success: function(response) 
            {
                
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
      }
      else{
         ErrorToast('Select College','bg-warning');
      }

     }  
function exportStudyMaterial()
          {
 
            var CollegeID=document.getElementById('College3').value;
       var Department=document.getElementById('Department3').value;
       var Course=document.getElementById('Course3').value;
       var Batch=document.getElementById('Batch3').value;
       if(CollegeID!='')
       {
       var exportCode=32;
       window.location.href="export.php?exportCode="+exportCode+"&CollegeID="+CollegeID+"&Department="+Department+"&Course="+Course+"&Batch="+Batch;
       }
       else
       {
        ErrorToast('Select College','bg-warning');
       }
     }  
     </script>
<p id="ajax-loader"></p>
<?php include "footer.php";  ?>