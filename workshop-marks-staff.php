
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
   //$sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where UserAccessLevel.IDNo='$EmployeeID'";


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

            <div class="col-md-1">
            <div class="form-group">
              <label>Type</label>
              <select name="ecat" id="ecat" class="form-control" required="">
                <option value="CE1">W1</option>
                <option value="MST1">W2 </option>
                 <!-- <option value="CE2">CE-2</option> -->
               <!-- <option value="MST2">P</option>  -->
                <option value="CE3">W3</option>
                 <option value="ESE">W4</option>
                    <!-- <option value="Attendance">P5</option> -->

                
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
 


 
 <div class="row">
          <!-- left column -->
          <div class="col-lg-12 col-md-4 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">

                <div class="row">
                  <div class="col-md-2"><h3 class="card-title">Students</h3>
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
          

         
        var code='373';
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


$(document).ready(function(e) { // image upload form submit
    $("#submit_csv_marks").on('submit', (function(e) {
        e.preventDefault();

   var  college = document.getElementById('College').value;
   var  course = document.getElementById('Course').value;
   var  batch = document.getElementById('Batch').value;
   var  sem = document.getElementById('Semester').value;
   var subject = document.getElementById('Subject').value;
   var  examination = document.getElementById('Examination').value;
   var distributiontheory = document.getElementById('ecat').value;

var form_data = new FormData(this);   
form_data.append('file_exl', file_exl);
form_data.append('code',361);
form_data.append('college',college);
form_data.append('course',course) ;             
form_data.append('batch',batch) ;
form_data.append('DistributionTheory',distributiontheory) ;
form_data.append('subject',subject) ;
form_data.append('examination',examination) ;
form_data.append('sem',sem) ;

var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        $.ajax({
            url: "action.php",
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                spinner.style.display = 'none';
                if (data==1) {
                    SuccessToast('Successfully Uploaded');
                    
                    //search_exam_form();

                } 
                else if(data==0)
                {
                    ErrorToast('Invalid CSV File ', 'bg-danger');
                    
                }

                    else {
 ErrorToast('Failed to Upload', 'bg-warning');
                    
                }
            },
        });
    }));
});




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
  

    if(emarks!='' && vmarks!=''&& fmarks!='')
    {


      marks=parseInt(emarks)+parseInt(vmarks)+parseInt(fmarks);

document.getElementById('marks_'+id).value='';

      document.getElementById('marks_'+id).value = marks;


      $.ajax({
      url:'action.php',
      type:'post',
      data:{
        id:id,emarks:emarks,vmarks:vmarks,fmarks:fmarks,marks:marks,ecat:ecat,code:'361'
      },
      success:function(response)
      {
        console.log(response);
         SuccessToast('Successfully Updated');
        //select_mst();      
      }
      });

}
else{
  document.getElementById('marks_'+id).value='';
}

}

function unlock(id)
{

  var marks=document.getElementsByClassName('marks');
  var ecat=document.getElementById('ecat').value;
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        id:id,ecat:ecat,code:'206'
      },
      success:function(response)
      {
 


        SuccessToast('Successfully Unlocked');
        select_mst(); 
       
       
      }
    });
}

function lock(id)
{

  var marks=document.getElementsByClassName('marks');
  var ecat=document.getElementById('ecat').value;
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        id:id,ecat:ecat,code:'207'
      },
      success:function(response)
      {
 
      SuccessToast('Successfully Locked');
        select_mst(); 
        
      }
    });
}

function lockall()
{

  var examination=document.getElementById('Examination').value;
  var ecat=document.getElementById('ecat').value;

 if(examination!='' && ecat!='')
 {
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        examination:examination,ecat:ecat,code:'209'
      },
      success:function(response)
      {
        if(response>0)
        { 
       SuccessToast('Successfully Locked'+"&nbsp;&nbsp;"+ecat+"&nbsp; of &nbsp;"+examination);
        }
        else
        {
          ErrorToast('Unable to Lock',"bg-danger" );
        }
      }
    });
}
else
{

   ErrorToast('Select Examination and Theory Distibution',"bg-danger" );
}
}


function unlockall()
{

  var examination=document.getElementById('Examination').value;
  var semester=document.getElementById('Semester').value;
  var ecat=document.getElementById('ecat').value;

 if(examination!='' && ecat!='' && semester!='')
 {
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        examination:examination,ecat:ecat,semester:semester,code:'215'
      },
      success:function(response)
      {
        if(response>0)
        { 
      SuccessToast('Successfully Unlocked'+"&nbsp;&nbsp;"+semester+"&nbsp;&nbsp;"+ecat+"&nbsp; of &nbsp;"+examination);
        }
        else
        {
          ErrorToast('Unable to Unlock',"bg-danger" );
        }
      }
    });
}
else
{

   ErrorToast('Select Examination , Theory Distibution and Semester',"bg-danger" );
}
}


function unlockpending()
{

  var examination=document.getElementById('Examination').value;
  var ecat=document.getElementById('ecat').value;
   var semester=document.getElementById('Semester').value;

 if(examination!='' && ecat!='' && semester!='')
 {
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        examination:examination,ecat:ecat,semester:semester,code:'216'
      },
      success:function(response)
      {

        if(response>0)
        { 
       SuccessToast('Successfully Unlocked'+"&nbsp;&nbsp;"+semester+"&nbsp;&nbsp;"+ecat+"&nbsp; of &nbsp;"+examination);
        }
        else
        {
          ErrorToast('Unable to Unlock',"bg-danger" );
        }
      }
    });
}
else
{

   ErrorToast('Select Examination , Theory Distibution and Semester',"bg-danger" );
}
}

//Semester unlock

function unlockSemester()
{
  var college=document.getElementById('College').value;
  var course=document.getElementById('Course').value;
  var examination=document.getElementById('Examination').value;
  var batch=document.getElementById('Batch').value;
  var semester=document.getElementById('Semester').value;

  var distributiontheory=document.getElementsByClassName('semesterwisetheory');
  var len_distribution= distributiontheory.length;
  var distributiontheory_str=[];
    for(i=0;i<len_distribution;i++)
     {
      if(distributiontheory[i].checked===true)
       {
        distributiontheory_str.push(distributiontheory[i].value);
        }
     }
if(typeof  distributiontheory_str[0]== 'undefined') 
  {
    ErrorToast('Please select atleast one theory distribution',"bg-danger" );
  }
  else{   

  if(examination!='' && batch!='' && semester!='' && college!='' && course!='')
 {
  alert(distributiontheory_str[0]);
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        examination:examination,college:college,course:course,batch:batch,semester:semester,distributiontheory_str:distributiontheory_str,code:'217'
      },
      success:function(response)
      {

 
       SuccessToast('Successfully Unlocked'+"&nbsp;&nbsp;"+semester+"&nbsp;&nbsp;"+ecat+"&nbsp; of &nbsp;"+examination);
       
      }
    });
}
else
{

   ErrorToast('Select Examination , Theory Distibution,Batch,College and Semester',"bg-danger" );
}
}
}

function unlockSemesterpending()
{  
  var college=document.getElementById('College').value;
  var course=document.getElementById('Course').value;
  var examination=document.getElementById('Examination').value;
  var batch=document.getElementById('Batch').value;
  var semester=document.getElementById('Semester').value;
  var distributiontheory=document.getElementsByClassName('semesterwisetheory');
  var len_distribution= distributiontheory.length;
  var distributiontheory_str=[];
    for(i=0;i<len_distribution;i++)
     {
      if(distributiontheory[i].checked===true)
       {
        distributiontheory_str.push(distributiontheory[i].value);
        }
     }
if(typeof  distributiontheory_str[0]== 'undefined') 
  {
    ErrorToast('Please select atleast one theory distribution',"bg-danger" );
  }
  else{   

  if(examination!='' && batch!='' && semester!='' && college!='' && course!='')
 {
  alert(distributiontheory_str[0]);
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        examination:examination,college:college,course:course,batch:batch,semester:semester,distributiontheory_str:distributiontheory_str,code:'218'
      },
      success:function(response)
      {
    
       SuccessToast('Successfully Unlocked'+"&nbsp;&nbsp;"+semester+"&nbsp;&nbsp;"+ecat+"&nbsp; of &nbsp;"+examination);
       
      }
    });
}
else
{

   ErrorToast('Select Examination , Theory Distibution,Batch,College and Semester',"bg-danger" );
}
}
}



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

    var distributiontheory = document.getElementById('ecat').value;

  if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='' &&distributiontheory!='')
 {
  var code=1;
   
   window.location.href="print-award-theory.php?college="+college+"&course="+course+"&batch="+batch+"&sem="+sem+"&subject="+subject+"&examination="+examination+"&distributiontheory="+distributiontheory+"&code="+code;

    }
    else if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='')
    {
       var code=2;
      window.location.href="print-award-theory.php?college="+college+"&course="+course+"&batch="+batch+"&sem="+sem+"&subject="+subject+"&examination="+examination+"&distributiontheory="+distributiontheory+"&code="+code;

    }
      else
      {
        ErrorToast('Select Appropriate data','bg-danger');
 
      }
}








</script>

<div>
    <?php include "footer.php";  ?>