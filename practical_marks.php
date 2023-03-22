 
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
            <div class="col-md-1">
            <div class="form-group">
              <label>Type</label>
              <select name="Expeirment" id="Experiment" class="form-control" required="">
                <option value="">Select Experiment</option>
                

                
              </select>
            </div>
 </div>

 <div class="col-lg-1 col-md-4 col-sm-3">
  <label>Group</label>
              <select  id="group" class="form-control" required="">
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





 <div class="col-lg-1 col-md-4 col-sm-3">
  <label>Search</label><br>
            <button class="btn btn-danger" onclick="select_mst()"><i  class="fa fa-search" ></i></button>

</div>



        <!-- /.row -->
      </div>
    </br>



 <div class="row">
          <!-- left column -->
          <div class="col-lg-9 col-md-4 col-sm-3">
   
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

  <div class="col-lg-3 col-md-3 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> Examination wise Lock / Unlock </h3>
              </div> 
                <div class="card-body">
                     <h3 class="card-title"><i class='btn btn-warning btn-xs' onclick="lockall();">Lock All</i>&nbsp;&nbsp;&nbsp;
                  <i class='btn btn-warning btn-xs' onclick="unlockall();">Unlock All</i>&nbsp;&nbsp;&nbsp;
                  <!-- <i class='btn btn-warning btn-xs' onclick="unlockpending();">Unlock Pending</i></h3> -->
              
                </div>
                <div class="card-footer"> </div>
               
            </div>

             <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"> Semester Wise </h3>
              </div> 
                <div class="card-body">
<!--<input type="checkbox" id="CE1" name="CE1" value="1" class="semesterwisetheory">
<label for="CE1">1</label>&nbsp;&nbsp;

<input type="checkbox" id="CE2" name="CE2" value="CE2" class="semesterwisetheory">
<label for="CE2"> 2</label>&nbsp;&nbsp;

<input type="checkbox" id="CE3" name="CE3" value="CE3" class="semesterwisetheory">
<label for="CE3"> 3</label>&nbsp;&nbsp;


<input type="checkbox" id="MST1" name="MST1" value="MST1" class="semesterwisetheory">
<label for="MS1"> 4</label>&nbsp;&nbsp;



<input type="checkbox" id="MST2" name="MST2" value="MST2" class="semesterwisetheory">
<label for="MS2"> 5</label>&nbsp;&nbsp;



<input type="checkbox" id="ESE" name="ESE" value="ESE" class="semesterwisetheory">
<label for="ESE"> 6</label>&nbsp;&nbsp;



<input type="checkbox" id="Attendance" name="Attendance" value="Attendance" class="semesterwisetheory">
<label for="Attendance"> 7</label><br><br>
 <h3 class="card-title">
                  <i class='btn btn-warning btn-xs' onclick="unlockSemester();">Unlock All</i>&nbsp;&nbsp;&nbsp;
                  <i class='btn btn-warning btn-xs' onclick="unlockSemesterpending();">Unlock Pending</i></h3> -->


                  <!-- <div id="live_data_Exam_subjects"></div> -->
                    
                
                </div>
                <div class="card-footer"> </div>
               
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

             if(data != "")
                {
                
                    $("#Subject").html("");
                    $("#Subject").html(data);
                }
            }
          });
    });
  });


     $(function() { 
      $("#Examination").change(function(e) {
        e.preventDefault();
 
        var college = $("#College").val();
       var batch = $("#Batch").val();
       var sem = $("#Semester").val();  
       var course = $("#Course").val();
       var subject = $("#Subject").val();
       var examination = $("#Examination").val();  
          

         
        var code='236';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code,batch:batch,sem:sem,examination:examination,subject:subject,college:college},
            type:'POST',
            success:function(data)
            { 

             if(data != "")
                {
                
                    $("#Experiment").html("");
                    $("#Experiment").html(data);
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
      var  group = document.getElementById('group').value;
         var subject = document.getElementById('Subject').value;
     var  examination = document.getElementById('Examination').value;

    var distributiontheory = document.getElementById('Experiment').value;
 
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
      xmlhttp.open("GET", "get_action.php?college="+college+"&course="+course+"&batch="+ batch+ "&sem=" + sem+ "&subject=" + subject+"&DistributionTheory="+distributiontheory+"&examination="+examination+"&group="+group+"&code="+45,true);
        xmlhttp.send();
 }
else
{
alert("Please Select Appropriate data");
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

function testing() 
{
  
var   spinner= document.getElementById("ajax-loader");
   //spinner.style.display='block';
  var unirollno=document.getElementsByClassName('unirollnos');
  var pmarks=document.getElementsByClassName('pmarksids');
    var vmarks=document.getElementsByClassName('vmarksids');
       var fmarks=document.getElementsByClassName('fmarksids');
                     var practicalid=document.getElementById('practicalidnum').value;
               var internalupdatedby=document.getElementById('internalupdatedby').value;

  
  var len_student= unirollno.length; 


  var student_str=[];
  var pmarks_str=[];
    var vmarks_str=[];
      var fmarks_str=[];

    for(i=0;i<len_student;i++)
     {
        student_str.push(unirollno[i].value);
         pmarks_str.push(pmarks[i].value);
           vmarks_str.push(vmarks[i].value);
          fmarks_str.push(fmarks[i].value);
     }
    
     

    $.ajax({
      url:'action.php',
      type:'post',
      data:{
        student_str:student_str,pmarks_str:pmarks_str,vmarks_str:vmarks_str,fmarks_str:fmarks_str,len_student:len_student,practicalid:practicalid,internalupdatedby:internalupdatedby,code:'262'
      },
      success:function(response)
      {
console.log(response);
        spinner.style.display='none';
       SuccessToast('Successfully Saved');
       select_mst() ;
      }
    });
}


function unlock(id)
{
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        id:id,code:'240'
      },
      success:function(response)
      {
 console.log(response);

      SuccessToast('Successfully Unlocked');
        select_mst(); 
        
      }
    });
}

function lock(id)
{
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        id:id,code:'239'
      },
      success:function(response)
      {
 console.log(response);
      SuccessToast('Successfully Locked');
        select_mst(); 
        
      }
    });
}

function lockall()
{

  var examination=document.getElementById('Examination').value;
 

 if(examination!='')
 {
 	var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        examination:examination,code:237
      },
      success:function(response)
      {
      	spinner.style.display='none';
        if(response>0)
        { 
       SuccessToast('Successfully Locked'+"&nbsp;&nbsp;All Practicle of &nbsp; of &nbsp;"+examination);
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

   ErrorToast('Select Examination',"bg-danger" );
}
}


function unlockall()
{

  var examination=document.getElementById('Examination').value;
 

 if(examination!='')
 {
 	var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        examination:examination,code:238
      },
      success:function(response)
      {
      	spinner.style.display='none';
        if(response>0)
        { 
       SuccessToast('Successfully Unlocked'+"&nbsp;&nbsp;All Practicle of &nbsp; of &nbsp;"+examination);
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

   ErrorToast('Select Examination',"bg-danger" );
}
}



function  lockallpractical()
{

  var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var idNos=document.getElementsByClassName('IdNos');

  var pid_length= idNos.length; 
 

  var pid_data=[];
  
    for(i=0;i<pid_length;i++)
     {
        pid_data.push(idNos[i].value);
     }
code=260;
  $.ajax({
    url:'action.php',
    type:'post',
    data:{code:code,pid_data:pid_data,pid_length:pid_length},

    success:function(response)
    {
 spinner.style.display='none';
      

        if(response>0)
        { 
       SuccessToast('Successfully Locked');
        select_mst();
        }
        else
        {
          ErrorToast('Unable to Lock',"bg-danger" );
        }
      }
  });
}


function  unlocklockallpractical()
{

  var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var idNos=document.getElementsByClassName('IdNos');

  var pid_length= idNos.length; 
 

  var pid_data=[];
  
    for(i=0;i<pid_length;i++)
     {
        pid_data.push(idNos[i].value);
     }
code=261;
  $.ajax({
    url:'action.php',
    type:'post',
    data:{code:code,pid_data:pid_data,pid_length:pid_length},

    success:function(response)
    {
 spinner.style.display='none';
      

        if(response>0)
        { 
       SuccessToast('Successfully Locked');
        select_mst();
        }
        else
        {
          ErrorToast('Unable to Lock',"bg-danger" );
        }
      }
  });
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







</script>

<div>
    <?php include "footer.php";  ?>