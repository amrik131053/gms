<?php 

  include "header.php";   
?>   

<section class="content">
      <div class="container-fluid">
        <div class="row">

          <!-- left column -->
          <div class="col-lg-2 col-md-4 col-sm-3">
 
   <label>College</label>
       <select  name="College" id='College' onchange="courseByCollege(this.value)" class="form-control" required="">
                <option value=''>Select Course</option>
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
              <div class="col-lg-2 col-md-4 col-sm-3">
   
          
 <label>Course</label>
              <select name="Course" id="Course" class="form-control">
                <option value=''>Select Course</option>
                
              </select>
          </div>
  <div class="col-lg-1 col-md-4 col-sm-3">
            




              <label>Session</label>
            <select  id="Session" name="group" class="form-control" required="">
                 <option value="">Session</option>
                       <?php
   $sql="SELECT DISTINCT Session  from Admissions Order by Session Desc ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $Sgroup = $row1['Session']; 
     
    ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }

?>

                
              </select>

        </div>

          <div class="col-lg-1 col-md-4 col-sm-3">
            




              <label>Batch</label>
            <select name="batch"  class="form-control" id="Batch" required="">
              <option value="">Batch</option>
                       <?php 
for($i=2013;$i<=2030;$i++)
{?>
   <option value="<?=$i?>"><?=$i?></option>
<?php }
            ?>

            </select>

        </div>

 <div class="col-lg-1 col-md-4 col-sm-3">
<label> Semester</label>
            <select   id='Semester' class="form-control" required="">
              <option value="">Sem</option>
            <?php 
for($i=1;$i<=12;$i++)
{?>
   <option value="<?=$i?>"><?=$i?></option>
<?php }
            ?>
             
            </select>

</div>


 




 <div class="col-lg-1 col-md-4 col-sm-3" style="text-align: center;">
  <label>Search</label><br>
            <button class="btn btn-danger" onclick="select_mst()"><i  class="fa fa-search" ></i></button>


 
            <button class="btn btn-danger" onclick="exportpdfdata()"><i  class="fa fa-file-pdf" ></i></button>

</div>
 


        <!-- /.row -->
      </div></div>
      <br>
    <div class="row">
          <!-- left column -->
          <div class="col-lg-12 col-md-4 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">

                <div class="row">
                  <div class="col-md-2"><h3 class="card-title">Students</h3>
</div> 

</div>
          



              </div>
        
             <!--  <form class="form-horizontal" action="" method="POST"> -->
                <div class="card-body">
                  <div id="student_search_record">
                  

                  </div>
                </div>
                <div class="card-footer">
                  
                </div>
                <!-- /.card-footer -->
              <!-- </form> -->
            </div>
          </div></section>




<script type="text/javascript">
  
function select_mst()
   {
      
      var CollegeID= document.getElementById("College").value;
       var CourseID= document.getElementById("Course").value;
        var Batch= document.getElementById("Batch").value;
         var Semester= document.getElementById("Semester").value;
          var Session= document.getElementById("Session").value;

      if (Batch!='') 
      {
          
   var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code='367';
            $.ajax({
            url:'action.php',
            data:{code:code,college:CollegeID,course:CourseID,batch:Batch,sem:Semester,session:Session},
            type:'POST',
            success:function(data)
            { 
              console.log(data)
   spinner.style.display='none';

            document.getElementById("student_search_record").innerHTML=data;
            }
          });




      }
      else
      {
         alert("Please Select Batch");
         //document.getElementById("student_IDNO").value ='';
         document.getElementById("student_search_record").innerHTML ='';
      }
   }




  function exportpdfdata()


   {
          var college= document.getElementById("College").value;
          var course= document.getElementById("Course").value;
          var batch= document.getElementById("Batch").value;
          var sem= document.getElementById("Semester").value;
          var session= document.getElementById("Session").value;



  if(batch!='')
 {
  var code=61;
 
 // window.location.href="export.php?college="+college+"&course="+course+"&batch="+batch+"&sem="+sem+"&session="+session+"&exportCode="+code;

 window.open("export.php?college="+college+"&course="+course+"&batch="+batch+"&sem="+sem+"&session="+session+"&exportCode="+code, '_blank');

  }
  
      else
      {
        ErrorToast('Select Appropriate data','bg-danger');
 
      }
}













</script>





















 <?php include "footer.php";  ?>