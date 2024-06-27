
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


          <div class="col-lg-2 col-md-4 col-sm-3">
            




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



     <!-- <div class="col-md-2">
            <div class="form-group">
              <label>Subject</label>
              <select name="subject" id="Subject" class="form-control" required="">
                <option value="">subject</option>

                
              </select>
            </div>
          </div> -->


            <!-- <div class="col-md-1">
            <div class="form-group">
              <label>Type</label>
              <select name="ecat" id="ecat" class="form-control" required="">
                <option value="CE1">CA-1 & CA-2 /W1/P1</option>
                <option value="MST1">MST-1 /W2/P2</option>
               
                <option value="MST2">MST-2</option> 
                <option value="CE3">CA-3/W3/P3</option>
                <option value="ESE">ESE/W4/P4/S/M</option>
                <option value="Attendance">Attendance/P5</option>
                <option value="Grace">Grace</option>
                          </select>
            </div>
            </div> -->


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
           

         
        var code='200';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code,batch:batch,sem:sem},
            type:'POST',
            success:function(data)
            { 
              //console.log(data);

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
         var subject = "";
     var  examination = document.getElementById('Examination').value;
var  group = document.getElementById('group').value;

    var distributiontheory = "";

  if(college!=''&& batch!='' && sem!='' && examination!='')
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
      xmlhttp.open("GET", "get_action.php?college="+college+"&course="+course+"&batch="+ batch+ "&sem=" + sem+ "&subject=" + subject+"&DistributionTheory="+distributiontheory+"&examination="+examination+"&group="+group+"&code="+56,true);
        xmlhttp.send();
 }
else
{
 alert("Please Select Appropriate data ");
}
      
  }


function updateMarks(id,IDNo,SubjectCode) 
{

  var ca1=document.getElementById('ca1'+id).value;
  var ca2=document.getElementById('ca2'+id).value;
  var ca3=document.getElementById('ca3'+id).value;
  var attendance=document.getElementById('attendance'+id).value;
  var marks=document.getElementById('marks'+id).value;
  if(marks!='')
  {
  var spinner= document.getElementById("ajax-loader");
     spinner.style.display='block';
    $.ajax({
      url:'action.php', 
      type:'post',
      data:{
        id:id,IDNo:IDNo,SubjectCode:SubjectCode,ca1:ca1,ca2:ca2,ca3:ca3,attendance:attendance,marks:marks,code:'376'
      },
      success:function(response)
      {
// console.log(response);
        spinner.style.display='none';
        if(response=='1')
        {
          SuccessToast('Successfully Saved');

        }else{
          ErrorToast('Try Again','bg-danger');
        }
        select_mst() ;
      }
    });
  }
  else{
    
    ErrorToast('enter reappear marks ','bg-warning');
  }
}
function testing() 
{
var spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var idNos=document.getElementsByClassName('IdNos');
  var subjectcode=document.getElementsByClassName('subjectcode');
  // var subcode=document.getElementById('subcode').value;
  var len_student= idNos.length; 
  var len_subjectcode= subjectcode.length; 
  var student_str=[];
  var subjectcodeArray=[];
  for(i=0;i<len_student;i++)
  {
    student_str.push(idNos[i].value);
  }
  // alert(student_str);
     for(i=0;i<len_subjectcode;i++)
     {
        subjectcodeArray.push(subjectcode[i].value);
     }
    $.ajax({
      url:'action.php', 
      type:'post',
      data:{
        ids:student_str,subcode:subjectcodeArray,code:'376'
      },
      success:function(response)
      {
console.log(response);
        spinner.style.display='none';
       SuccessToast('Successfully Saved');
      //  select_mst() ;
      }
    });
}

</script>

<!-- Button trigger modal -->


<!-- Modal -->

    <?php include "footer.php";  ?>