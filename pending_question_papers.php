
<?php 

  include "header.php";   
?>

<script>


function checkall()
{

  var inputs = document.querySelectorAll('.newStudents');

      for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = true;

      }
      document.getElementById("check").style.display = "none";
       
      document.getElementById("check1").style.display = "block";
}

function uncheckall()
{

  var inputs = document.querySelectorAll('.newStudents');

        for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = false;
        }
      document.getElementById("check").style.display = "block";
    
        document.getElementById("check1").style.display = "none";
}

</script>
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-lg-2 col-md-4 col-sm-3">


   <label>College</label>
       <select  name="College" id='College' onchange="courseByCollege(this.value)" class="form-control" required="">
                <option value=''>Select Course</option>
                  <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where IDNo='$EmployeeID'";
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
<!--            <div class="col-lg-2 col-md-4 col-sm-3">
   
          
 <label>Type</label> -->
              <select name="type" id="type" class="form-control" style="display: none;">
                <option value='Reappear'>Select Course</option>
                <option value='Reappear'>Reappear</option>
                
              </select>
             


        <!--   <div class="col-lg-1 col-md-4 col-sm-3">
            




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
 -->




     

  
         





 <div class="col-lg-1 col-md-4 col-sm-3">
  <label>Examination</label>
              <select  id="Examination" class="form-control" required="">
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
  <label>Search</label><br>
            <button class="btn btn-danger" onclick="select_mst()"><i  class="fa fa-search" ></i></button>

</div>



        <!-- /.row -->
      </div>
    </br>



 <div class="row">
          <!-- left column -->
          <div class="col-lg-12 col-md-4 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">
                <div class="row">
                <div class="col-lg-10 col-md-4 col-sm-3">
                <h3 class="card-title">Students</h3>
              </div>
              <div class="col-lg-2 col-md-4 col-sm-3">

<button class="btn btn-warning btn-xs" onclick="export_pending()">Export</button>
</div>    </div>

              </div>
        
             <!--  <form class="form-horizontal" action="" method="POST"> -->
                <div class="card-body">
                  <div id="live_data">
                  

                  </div>
                </div>
                <div class="card-footer">
                  
                </div>
                <!-- /.card-footer -->
              <!-- </form> -->
            </div>
          </div>







</div>
      <!-- /.container-fluid -->
    </section>
    <script>
     

function select_mst() 
{ 
 // alert('');
  var  college = document.getElementById('College').value;
   var  type = document.getElementById('type').value;
  

     var  examination = document.getElementById('Examination').value;

    

  if(college!=''&& examination!='' &&type!='')
 {
   var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     
   spinner.style.display='none';
       
          document.getElementById("live_data").innerHTML=xmlhttp.responseText;

        }
    }
      xmlhttp.open("GET", "get_action.php?college="+college+"&examination="+examination+"&type="+type+"&code="+48,true);
        xmlhttp.send();
 }
else
{
 alert("Please Select Appropriate data ");
}
      
  }

function export_pending(id)
      {
            var exportCode='18';

             var  college = document.getElementById('College').value;
  

     var  examination = document.getElementById('Examination').value;

            var group=id;
            
          window.location.href="export.php?college="+college+"&examination="+examination+"&exportCode="+exportCode;
      }


</script>

<div>
    <?php include "footer.php";  ?>