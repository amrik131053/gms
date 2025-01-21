<?php 
  ini_set('max_execution_time',0);
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-md-3 col-lg-3 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">My Lectures on <b><?=$day;?> - (<?=$todaydate;?>)</b></h3>
               </div>

      <script type="text/javascript">

</script>
<div class="card-body">
    <div class="row">
<div class="col-lg-4">   <label>Group</label>
                                <select id="Group" class="form-control form-control-sm" >
                                    <option value="NA">NA</option>
                                    <?php
                                            $sql="SELECT DISTINCT Sgroup from MasterCourseStructure where Sgroup!='' Order by Sgroup ASC ";
                                                    $stmt2 = sqlsrv_query($conntest,$sql);
                                                while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                                    {

                                                
                                                $Sgroup = $row1['Sgroup']; 
                                                
                                                ?>
                                    <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                    <?php    }

                                                            ?>
                                </select>
 </div><div class="col-lg-4"> <label>Order By</label>
                                <select id="OrderBy" class="form-control form-control-sm" >
                                    <option value="ClassRollNo">ClassRollNo</option>
                                   
                                    <option value="UniRollNo">UniRollNo</option>
                                    
                                </select> </div>

                                <div class="col-lg-4"> <label>Date</label>

                                    <input type="date" value="<?=$todaydate;?>" class="form-control form-control-sm" name="" id='todate'>
                                 </div>
    </div>

                            
                              
                                    

                        
<?php 
    $Sr=1;

// Examination='$CurrentExamination'
     $getAllleaves="SELECT * FROM TimeTable  where IDNo='171427'  AND Examination='December 2024' AND  Status='1' AND Day='$day'  order by  LectureNumber  ASC "; 
    $getAllleavesRun=sqlsrv_query($conntest,$getAllleaves);
    while($row=sqlsrv_fetch_array($getAllleavesRun,SQLSRV_FETCH_ASSOC))
    { 

      $courseID=$row['CourseID'];
       $college=$row['CollegeID'];
       
  $getAllleaves1 = "SELECT  Distinct Course,SubjectName FROM MasterCourseStructure 
                  WHERE CourseID = '" . $row['CourseID'] . "' 
                  AND CollegeID = '" . $row['CollegeID'] . "' 
                  AND SubjectCode = '" . $row['SubjectCode'] . "' AND Batch = '" . $row['Batch'] . "'";
;
    $getAllleavesRun1=sqlsrv_query($conntest,$getAllleaves1);
    while($row1=sqlsrv_fetch_array($getAllleavesRun1,SQLSRV_FETCH_ASSOC))   

{
 $course= trim($row1['Course']);

?>
<hr>
<button onclick="showCandidates(<?=$college;?>,<?=$row['LectureNumber']?>,'<?=$row['SubjectCode']?>','<?= $courseID;?>','<?=$course;?>','<?=$row['Section']?>','<?=$row['GroupName']?>',<?=$row['Batch'];?>,<?=$row['SemesterID'];?>,'<?=$row['Examination'];?>','<?=$row1['SubjectName'];?>')" class="btn btn-primary">
   <?=$row['LectureNumber'];?> : <?=$row1['SubjectName'];?>(<?=$row['SubjectCode'];?>)<?=$row1['Course'];?>-<?=$row['Section'];?>/<?=$row['GroupName'];?> -Sem:<?=$row['SemesterID'];?></button>
            
                   
        
                
                   
                 
                <?php

       }
        $Sr++;
       
    }
  
    ?>
            <?php 
          sqlsrv_close($conntest);

          ?>
           </div>
            </div>

         </div>
       
            <div class="col-lg-0 col-md-0 col-sm-9">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title"></h3>
                     <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                           
                           
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 800px;">
                     <table class="table table-head-fixed text-nowrap">
                        <thead>
                           <tr>
                             
                           </tr>
                        </thead>
                        <tbody id="live_data">
                       
                        </tbody>
                     </table>
                  </div>
                 
               </div>
              
            </div>
      
        
      </div>
      
   </div>
 
</section>





<script type="text/javascript">

function UpdateAttendance()
{

var lecturenumber=document.getElementById('lecturenumber').value;
var subjectcode =document.getElementById('subjectcode').value;
var semester =document.getElementById('semester').value;
var section =document.getElementById('section').value;
var cgroup=document.getElementById('cgroup').value; 
var examination=document.getElementById('examination').value;
var date =document.getElementById('date').value; 
var batch=document.getElementById('Batch').value;

var students=document.getElementsByClassName('checkbox_s');
var attendance=document.getElementsByClassName('checkbox');
var len_student= students.length; 
var len_attendance= attendance.length;




var code=26.8;
var student_str=[];
var attendance_str=[];
    
    for(i=0;i<len_student;i++)
     {
      if(students[i].checked===true)
       {
        student_str.push(students[i].value);
        }
     }
       
     for(i=0;i<len_attendance;i++)
     {
          if(attendance[i].checked===true)
          {
            attendance_str.push(attendance[i].value);
          }
          else
          {
            attendance_str.push('0');
          }
       }
    

  if((typeof  student_str[0]== 'undefined') || (typeof attendance_str[0]== 'undefined') )
  {
        ErrorToast('Mark student Attedance','bg-warning');
  }else{
    var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
  $.ajax({
         url:'action_a.php',
         data:{students:student_str,attendance:attendance_str,lecturenumber:lecturenumber,subjectcode:subjectcode,semester:semester,section:section,cgroup:cgroup,examination:examination,date:date,batch:batch,flag:code,},
         type:'POST',
         success:function(data) {
            console.log(data);
             if(data==1)
                  {

            spinner.style.display='none';
            SuccessToast('Submit Successfully');
                                }    
                                }  
});
}
}



   function showCandidates(college,lecturenumber,subjectcode,courseid,course,section,cgroup,batch,sem,examination,subject,date) 
{ 
  
var  group = document.getElementById('Group').value;
var  OrderBy = document.getElementById('OrderBy').value;
var  date = document.getElementById('todate').value;

  if(college!=''&&batch!='' && sem!='' && subjectcode!=''&& examination!='' )
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
      xmlhttp.open("GET", "get_action.php?college="+college+"&course="+course+"&courseid="+courseid+"&batch="+ batch+ "&sem=" + sem+ "&subjectcode=" +subjectcode+"&subject=" +subject+" &examination="+examination+"&group="+group+"&cgroup="+cgroup+"&section="+section+"&OrderBy="+OrderBy+"&lecturenumber="+lecturenumber+"&date="+date+"&code="+65.1,true);
        xmlhttp.send();
 }
else
{
 alert("Please Select Appropriate data ");
}
      
  }
</script>

<?php include "footer.php";?>