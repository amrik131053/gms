
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
       <select  name="College" id='College' onchange="courseByCollegeexam(this.value)" class="form-control" required="">
                <option value=''>Select Course</option>
                  <?php
   //$sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";



 $sql="SELECT DISTINCT MasterCourseStructure.CollegeName,MasterCourseStructure.CollegeID from MasterCourseStructure
                                  INNER JOIN SubjectAllotment on  SubjectAllotment.SubjectCode = MasterCourseStructure.SubjectCode Where  SubjectAllotment.EmployeeID='$EmployeeID' ANd SubjectAllotment.Status='1' ";


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



     <div class="col-md-2">
            <div class="form-group">
              <label>Subject</label>
              <select name="subject" id="Subject" class="form-control" required="">
                <option value="">subject</option>

                
              </select>
            </div>
          </div>

            
            <div class="form-group">
              <!-- <label>Type</label> -->
              <select name="ecat" id="ecat" class="form-control" hidden required="">
              <!--   <option value="CE1">CA-1 & CA-2</option>
                <option value="MST1">MST-1 </option>
                  <option value="CE2">CE-2</option> 
                <option value="MST2">MST-2</option> 
                <option value="CE3">CA-3</option> -->
                <option value="ESE">End Semester Exam</option>
                <!-- <option value="Attendance">Attendance</option>
                <option value="Grace">Grace</option> -->
                          </select>
           
            </div>


 <div class="col-md-1">
            <div class="form-group">
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
 </div>



 <div class="col-lg-1 col-md-4 col-sm-3">
  <label>Examination</label>
              <select  id="Examination" class="form-control" required="">
                  <!-- <option value="<?=$CurrentExamination;?>"><?=$CurrentExamination;?></option>  -->

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


<div class="modal fade" id="UploadImageDocument">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="documentData">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
 <div class="row">
          <!-- left column -->
          <div class="col-lg-12 col-md-12 col-sm-12">
   
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Students</h3>
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



     $(function() { 
      $("#Semester").change(function(e) {
        e.preventDefault();
 
        var course = $("#Course").val();
       var batch = $("#Batch").val();
       var sem = $("#Semester").val();  
           

         
        var code='374';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code,batch:batch,sem:sem},
            type:'POST',
            success:function(data)
            { 
              console.log(data);
console.log(data);
             if(data != "")
                {
                
                    $("#Subject").html("");
                    $("#Subject").html(data);
                }
            }
          });
    });
  });
 

function select_mst() 
{ 
  var  college = document.getElementById('College').value;
  var  course = document.getElementById('Course').value;
   var  batch = document.getElementById('Batch').value;
    var  sem = document.getElementById('Semester').value;
         var subject = document.getElementById('Subject').value;
     var  examination = document.getElementById('Examination').value;
var  group = document.getElementById('group').value;

    var distributiontheory = document.getElementById('ecat').value;

  if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='' &&distributiontheory!='')
 {
   var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     
   spinner.style.display='none'; 
       
          document.getElementById("live_data").innerHTML=xmlhttp.responseText;
//Examination_theory_types();
        } 
    }
      xmlhttp.open("GET", "get_action.php?college="+college+"&course="+course+"&batch="+ batch+ "&sem=" + sem+ "&subject=" + subject+"&DistributionTheory="+distributiontheory+"&examination="+examination+"&group="+group+"&code="+53,true);
        xmlhttp.send(); 
 }
else
{
 alert("Please Select Appropriate data ");
}
      
  }

function Examination_theory_types(){
var code=44;

var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     
     
          document.getElementById("live_data_Exam_subjects").innerHTML=xmlhttp.responseText;

        }
    }

      xmlhttp.open("GET", "get_action.php?code="+code,true);
        xmlhttp.send();


}






 function uploadmooc(id) {
  //alert(id);

 var fileInput = document.getElementById("moocfile_"+id);
  var MOOC_Mark = document.getElementById("marks_"+id).value;

if(MOOC_Mark!='')
{
    if (!fileInput.files[0]) {
                 ErrorToast('Attachment required',"bg-danger" );
                return;
            }
var formData = new FormData();
            formData.append("moocfile", fileInput.files[0]);
            formData.append("code",358);
            formData.append("id",id);
              formData.append("MOOC_Mark",MOOC_Mark);

            // Create and send AJAX request
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "action.php", true);
 
            xhr.onload = function () {
            console.log("Server response:",xhr.responseText);
                if (xhr.status === 200) {



                  //  if(xhr.responseText=="Uploaded"){
                     SuccessToast('Successfully Uploaded');
                     select_mst();


                  //  }
                  //  else
                  //  {
                  //    ErrorToast('something went wrong',"bg-danger" );
                  //  }
                 

                   
                } 
                else {
                    statusDiv.innerHTML = "<p style='color:red;'>File upload failed.</p>";
                }
            };

            xhr.onerror = function () {
                statusDiv.innerHTML = "<p style='color:red;'>An error occurred while uploading the file.</p>";
            };

            xhr.send(formData);
          }
          else
          {
        ErrorToast('valid input required',"bg-danger" );
          }
}

function viewmooc(id) {
    var code =68;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("documentData").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}

</script>

<!-- Button trigger modal -->


<!-- Modal -->

    <?php include "footer.php";  ?>