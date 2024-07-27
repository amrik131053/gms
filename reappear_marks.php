
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
            <button class="btn btn-success btn-sm " onclick="exportCutListExcelgraden()">NG</button> 
            <button class="btn btn-success btn-sm " onclick="exportCutListExcelcsv()">CSV</button> 
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
  function exportCutListExcelgraden() {
    var exportCode = 71;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = "Reappear";
    var Group = document.getElementById('group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
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
      //  select_mst() ;z
      }
    });
}

function resultView(ID,SubCode,UniRollNo){
// alert(ID);.
var Semester=document.getElementById('Semester').value;
var Examination=document.getElementById('Examination').value;
var spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var code = 451;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                SubCode: SubCode,
                UniRollNo: UniRollNo,
                Semester: Semester,
                Examination: Examination,
                ID: ID
            },
            success: function(response) {
                // console.log(ExaminationB+BatchB+TypeB+SemesterB)
                spinner.style.display = 'none';
                console.log(response);
                    document.getElementById("ViewResultData").innerHTML = response;
             
                //  loadMainCount();
            }
        });
}

function showSubResult() {
  
}

function submitResultCombined(ID) {
var code=452;
var r = confirm("Do you really want to Verifiy");
if (r == true) {
var Semester = document.getElementById('Semester').value;
var Examination = document.getElementById('Examination').value;
var Type = document.getElementById('Type').value;
var cgpa = document.getElementById('cgpa').value;
var creditTotal = document.getElementById('creditTotal').value;
var subNames=document.getElementsByClassName('subNames'+ID);
var subNameSize= subNames.length; 
var subNameArray=[];  
for(i=0;i<subNameSize;i++){if(subNames[i].value.trim() !== ''){ subNameArray.push(subNames[i].value); }}
var subCodes=document.getElementsByClassName('subCodes'+ID);
var subCodesSize= subCodes.length; 
var subCodesArray=[];  
for(i=0;i<subCodesSize;i++){if(subCodes[i].value.trim() !== ''){ subCodesArray.push(subCodes[i].value); }}
var agrade=document.getElementsByClassName('agrade'+ID);
var agradeSize= agrade.length; 
var agradeArray=[];  
for(i=0;i<agradeSize;i++){if(agrade[i].value.trim() !== ''){ agradeArray.push(agrade[i].value); }}
var bgradePoint=document.getElementsByClassName('bgradePoint'+ID);
var bgradePointSize= bgradePoint.length; 
var bgradePointArray=[];  
for(i=0;i<bgradePointSize;i++){if(bgradePoint[i].value.trim() !== ''){ bgradePointArray.push(bgradePoint[i].value); }}
var ccredit=document.getElementsByClassName('ccredit'+ID);
var ccreditSize= ccredit.length; 
var ccreditArray=[];  
for(i=0;i<ccreditSize;i++){if(ccredit[i].value.trim() !== ''){ ccreditArray.push(ccredit[i].value); }}
// alert(ccreditSize);
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            Semester: Semester,
            Examination: Examination,
            subNameArray:subNameArray,
            subCodesArray:subCodesArray,
            agradeArray:agradeArray,
            bgradePointArray:bgradePointArray,
            ccreditArray:ccreditArray,
            Type: Type,
            cgpa: cgpa,
            creditTotal: creditTotal,
            ID: ID
        },
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);     
            if(response==1)
            {
              SuccessToast('Successfully Updated');
              select_mst();
            }
            else{
              ErrorToast('try again','bg-warning');
            }
        },
        error: function(xhr, status, error) {
            spinner.style.display = 'none';
            console.error('Error:', error); 
        }
    });
  }
}

function verifiy_select()
{
        if(document.getElementById("select_all1").checked)
        {
            $('.v_check').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.v_check').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.v_check').on('click',function()
    {
        var a=document.getElementsByClassName("v_check:checked").length;
        var b=document.getElementsByClassName("v_check").length;
        
        if(a == b)
        {

            $('#select_all1').prop('checked',true);
        }
        else
        {
            $('#select_all1').prop('checked',false);
        }
    });
 
} 


function updateAll()
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

  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=453;
  var examIDs=[];  
  var subCodesArray=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            examIDs.push(verifiy[i].value);
            var  eID = document.getElementById('ID'+verifiy[i].value).value; 
            subCodesArray.push(eID);
          }
     }
    //  for(j=0;j<len_student1;j++){if(verifiy1[j].value.trim() !== ''){ subCodesArray.push(verifiy1[j].value); }}
    //  alert(subCodesArray);
    //  console.log(examIDs);
  if((typeof  examIDs[0]== 'undefined'))
  {
    ErrorToast(' Select atleast one Student' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{examIDs:examIDs,college:college,
              course:course,
              batch:batch,
              sem:sem,
              examination:examination,
              group:group,code:code,subCodesArray:subCodesArray},
              type:'POST',
              success:function(data) {
                  spinner.style.display='none';
              console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully Updated');
            //    search_study_scheme();
            select_mst();
            }
            else if (data==2) 
            {
              ErrorToast('enter reappear/ESE marks' ,'bg-primary');
            //    search_study_scheme();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
  }
}
else
{

}
}
function exportCutListExcelcsv() {
    var exportCode = 72;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = "Reappear";
    var Group = document.getElementById('group').value;
    var Examination = document.getElementById('Examination').value;

    if (College != '' && Course != '' && Batch != '' && Semester != ''&& Type != '' && Group != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination, '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}

function resultupdateAll()
{
  var  examination = document.getElementById('Examination').value;
  var  sem = document.getElementById('Semester').value; 
  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=455;
  var examIDs=[];  
  var eIDArray=[];  
  var IDNoArray=[];  
  var subcodeArray=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            examIDs.push(verifiy[i].value);
            var  eID = document.getElementById('ID'+verifiy[i].value).value; 
            eIDArray.push(eID);
            var  subcode = document.getElementById('subcode'+verifiy[i].value).value; 
            subcodeArray.push(subcode);
            var  IDNo = document.getElementById('IDNo'+verifiy[i].value).value; 
            IDNoArray.push(IDNo);
          }
     }
  if((typeof  examIDs[0]== 'undefined'))
  {
    ErrorToast(' Select atleast one Student' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{examIDs:examIDs,code:code,subCodesArray:subcodeArray,IDNoArray:IDNoArray,eIDArray:eIDArray,Examination:examination,Semester:sem},
              type:'POST',
              success:function(data) {
                  spinner.style.display='none';
              console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully Updated');
            //    search_study_scheme();
            select_mst();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
  }

}
</script>

<!-- Button trigger modal -->
<div class="modal fade bd-example-modal-xl " id="ViewResult" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Results</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ViewResultData">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

    <?php include "footer.php";  ?>