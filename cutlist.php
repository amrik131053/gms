<?php 
   include "header.php";   
   ?>
   <script>

function select_mst() 
{ 
  var  college = document.getElementById('College').value;
  var  course = document.getElementById('Course').value;
   var  batch = document.getElementById('Batch').value;
    var  sem = document.getElementById('Semester').value;
      var  group = document.getElementById('group').value;
      var  type = document.getElementById('type').value;
        
     var  examination = document.getElementById('Examination').value;


 
  if(college!=''&&batch!='' && sem!=''&& examination!='')
 {
   var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code='24';
            $.ajax({
            url:'action_g.php',
            data:{code:code,college:college,course:course,batch:batch,sem:sem,examination:examination,group:group,Type:type},
            type:'POST',
            success:function(data)
            { 
   spinner.style.display='none';

            document.getElementById("live_data").innerHTML=data;
            }
          });
 }
else
{
alert("Please Select Appropriate data");
}
      
}

   </script>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      
      <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
            - <h3 class="card-title">-----</h3>
           </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
               <form action="action_g.php" method="post" enctype="multipart/form-data" target="_blank">
               <div class="row">
                  <input type="hidden" name="code" value="24">
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
            <select   id='Semester' name='Sem' class="form-control" required="">
              <option value="">Sem</option>
            <?php 
for($i=1;$i<=12;$i++)
{?>
   <option value="<?=$i?>"><?=$i?></option>
<?php }
            ?>
             
            </select>

</div>



     



 <div class="col-lg-1 col-md-4 col-sm-3">
  <label>Examination</label>
              <select  id="Examination" name="examination" class="form-control" required="">
                 <option value="">Examination</option>
                       <?php
   $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $Sgroup = $row1['Examination']; 
     
    ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }

?>

                
              </select>

</div>
         <div class="col-lg-1 col-md-4 col-sm-3">
<label> Type</label>
            <select   id='type'name='type' class="form-control" required="">
              <option value="">Sem</option>
                             <?php
   $sql11="SELECT DISTINCT Type from ExamForm Order by Type DESC ";
          $stmt21 = sqlsrv_query($conntest,$sql11);
     while($row11 = sqlsrv_fetch_array($stmt21, SQLSRV_FETCH_ASSOC) )
         {

       
     $Type = $row11['Type']; 
     
    ?>
<option  value="<?=$Type;?>"><?= $Type;?></option>
<?php    }?>
             
            </select>

</div>

 <div class="col-lg-1 col-md-4 col-sm-3">
  <label>Group</label>
              <select  id="group" name="group" class="form-control" required="">
                 <option value="">Group</option>
                       <?php
   $sql="SELECT DISTINCT Sgroup from ExamForm Order by Sgroup ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $Sgroup = $row1['Sgroup']; 
     
    ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }

?>

                
              </select>

</div>
 <div class="col-lg-2 col-md-4 col-sm-3">
   <label>File</label>
 <input type="file"  required class="form-control" name="file_exl">
</div>




 <div class="col-lg-1 col-md-4 col-sm-3">
  <label>Search</label><br>
            <button type="submit" class="btn btn-danger" ><i  class="fa fa-search" ></i></button>

</div>



        <!-- /.row -->
      </div>
      </form>

            </div>
            <div id="live_data">
               
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->
<?php 


 include "footer.php";  ?>