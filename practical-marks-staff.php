
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
       <select  name="College" id='College' onchange="courseByCollegeexam(this.value)"  class="form-control" required="">
                <option value=''>Select Course</option>
                  <?php
   //$sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where UserAccessLevel.IDNo='$EmployeeID' ";

   $sql="SELECT DISTINCT MasterCourseStructure.CollegeName,MasterCourseStructure.CollegeID from MasterCourseStructure
                                  INNER JOIN SubjectAllotment on  SubjectAllotment.SubjectCode = MasterCourseStructure.SubjectCode Where  SubjectAllotment.EmployeeID='$EmployeeID'";
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

            <div class="col-md-1">
            <div class="form-group">
              <label>Type</label>
              <select name="ecat" id="ecat" class="form-control" required="">
                <option value="CE1">P1</option>
                <option value="MST1">P2 </option>
                 <!-- <option value="CE2">CE-2</option> -->
               <!-- <option value="MST2">P</option>  -->
                <option value="CE3">P3</option>
                 <option value="ESE">P4</option>
                    <option value="Attendance">P5</option>

                
              </select>
            </div>
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


 <div class="col-lg-1 col-md-4 col-sm-3" style="text-align: center;">
  <label>Search</label><br>
            <button class="btn btn-danger" onclick="select_mst()"><i  class="fa fa-search" ></i></button>


 
            <button class="btn btn-danger" onclick="exportpdfdata()"><i  class="fa fa-file-pdf" ></i></button>

</div>
 


        <!-- /.row -->
      </div>
    </br>


 
 <div class="row">
          <!-- left column -->
          <div class="col-lg-12 col-md-4 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">

                <div class="row"><div class="col-md-2"><h3 class="card-title">Students</h3>
</div> 
<!-- <div class="col-lg-1 col-md-12 col-sm-12" style="text-align: center;">
 
            <button class="btn btn-danger" onclick="exportdata()">Format</button>

</div><div class="col-md-2">
  <form  id="submit_csv_marks" method="post" enctype="multipart/form-data" action="action.php">
<input type="hidden" name="code" value="361">
  <input type="file" name="file_exl" id="file_exl" >
</div> <div class="col-md-2">
 <button class="btn btn-danger" type="submit">Upload CSV</i></button>
</div> -->
</div>
    </form>            



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
          

         
        var code='363';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code,batch:batch,sem:sem},
            type:'POST',
            success:function(data)
            { 

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
      xmlhttp.open("GET", "get_action.php?college="+college+"&course="+course+"&batch="+ batch+ "&sem=" + sem+ "&subject=" + subject+"&DistributionTheory="+distributiontheory+"&examination="+examination+"&group="+group+"&code="+52,true);
        xmlhttp.send();
 }
else
      {
        ErrorToast('Select Appropriate data','bg-danger');
 
      }
      
  } 






function testing() 
{
var spinner= document.getElementById("ajax-loader");
var idNos=document.getElementsByClassName('IdNos');
var marks=document.getElementsByClassName('marks');
var ecat=document.getElementById('ecat').value;
var len_student= idNos.length; 
var len_marks= marks.length; 
var lockallowed=0;
var student_str=[];
var marks_str=[];
for(i=0;i<len_student;i++)
     {
        student_str.push(idNos[i].value);
     }
for(i=0;i<len_marks;i++)
     {
      if(marks[i].value!='')
      {
        marks_str.push(marks[i].value);
      }
      else
      {
        var lockallowed=1;
      }
     }
    // alert(student_str);
 if(lockallowed>0)
 {

 ErrorToast('Unable to Lock Update all Marks',"bg-danger" );
}
else {
  spinner.style.display='block';

    $.ajax({
      url:'action.php',
      type:'post',
      data:{
        ids:student_str,mst:marks_str,ecat:ecat,flag:len_student,code:'201'
      },
      success:function(response)
      {
//console.log(response);
        spinner.style.display='none';
       SuccessToast('Successfully Saved');
       select_mst() ;
      }
    });
}

}



function savepmarks(id)
{

  var emarks=document.getElementById('emarks_'+id).value;
   var vmarks=document.getElementById('vmarks_'+id).value
    var fmarks=document.getElementById('fmarks_'+id).value
     var ecat=document.getElementById('ecat').value;
       var  sem = document.getElementById('Semester').value;
  

    if(emarks!='' && vmarks!=''&& fmarks!='')
    {


      marks=parseInt(emarks)+parseInt(vmarks)+parseInt(fmarks);

document.getElementById('marks_'+id).value='';

      document.getElementById('marks_'+id).value = marks;


      $.ajax({
      url:'action.php',
      type:'post',
      data:{
        id:id,emarks:emarks,vmarks:vmarks,fmarks:fmarks,marks:marks,ecat:ecat,sem:sem,code:'361'
      },
      success:function(response)
      {
        if(response==1)
        {

         SuccessToast('Successfully Updated');
        }
        else if(response==0)
        {
           ErrorToast('something went wrong','bg-danger');

        }
         else if(response==2)
        {
 ErrorToast('Date Over','bg-danger');
        }
         
      }
      });

}
else{
  document.getElementById('marks_'+id).value='';
}

}




//Semester unlock





   function exportdata()


   {
          var  college = document.getElementById('College').value;
  var  course = document.getElementById('Course').value;
   var  batch = document.getElementById('Batch').value;
    var  sem = document.getElementById('Semester').value;
         var subject = document.getElementById('Subject').value;
     var  examination = document.getElementById('Examination').value;
var exportCode='58';
    var distributiontheory = document.getElementById('ecat').value;

  if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='' &&distributiontheory!='')
 {
   
   window.location.href="export.php?exportCode="+exportCode+"&college="+college+"&course="+course+"&batch="+batch+"&sem="+sem+"&subject="+subject+"&examination="+examination+"&distributiontheory="+distributiontheory;

    }
      else
      {
        ErrorToast('Select Appropriate data','bg-danger');
 
      }
}

   function exportpdfdata()


   {
          var  college = document.getElementById('College').value;
  var  course = document.getElementById('Course').value;
   var  batch = document.getElementById('Batch').value;
    var  sem = document.getElementById('Semester').value;
         var subject = document.getElementById('Subject').value;
     var  examination = document.getElementById('Examination').value;
     var  group = document.getElementById('group').value;

    var distributiontheory = document.getElementById('ecat').value;

  if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='' &&distributiontheory!='' && group!='')
 {
  var code=1;
   
  window.open("print-award-theory.php?group="+group+"&college="+college+"&course="+course+"&batch="+batch
   +"&sem="+sem+"&subject="+subject+"&examination="+examination+"&distributiontheory="+distributiontheory+"&code="+code, '_blank');


  //  window.location.href="print-award-theory.php?group="+group+"&college="+college+"&course="+course+"&batch="+batch
  //  +"&sem="+sem+"&subject="+subject+"&examination="+examination+"&distributiontheory="+distributiontheory+"&code="+code,"_blank";

    }
    else if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='')
    {
       var code=2;
       window.open("print-award-theory.php?group="+group+"&college="+college+"&course="+course+"&batch="+batch+"&sem="+
      sem+"&subject="+subject+"&examination="+examination+"&distributiontheory="+distributiontheory+"&code="+code, '_blank');
      // window.location.href="print-award-theory.php?group="+group+"&college="+college+"&course="+course+"&batch="+batch+"&sem="+
      // sem+"&subject="+subject+"&examination="+examination+"&distributiontheory="+distributiontheory+"&code="+code,"_blank";

    }
      else
      {
        ErrorToast('Select Appropriate data','bg-danger');
 
      }
}








</script>

<div>
    <?php include "footer.php";  ?>