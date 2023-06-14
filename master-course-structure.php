<?php 
  include "header.php";   
?>   
<section class="content">
   <div class="container-fluid">
   <div class="card card-info">
   </div>
   <div class="row">
       
      <div class="col-lg-12 col-md-4 col-sm-12">
         <div class="card-body card">
        <div class="btn-group w-100 mb-2">
                    <a class="btn"  id="btn6" style="background-color:#223260; color: white; border: 1px solid;" onclick="window.location.reload();bg(this.id);"> Upload </a>
                   <!--  <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="Add();bg(this.id);"> Add </a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="Search();bg(this.id);"> Search </a>
                    <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="Move();bg(this.id);"> Move </a>
                    <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="Copy();bg(this.id);"> Copy </a> -->
                    <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="Update();bg(this.id);"> Update </a>
                  </div>

         <div  id="table_load">

<div class="card" >
        <center>
         <h5>
         <b>Study Scheme Upload</b>
        </h5>
        </center>
        </div>
               <form id="upload_study_scheme" method="post" enctype="multipart/form-data" action="action.php">
           <div class="row">
              <div class="col-lg-3">
                  <input type="hidden" name="code" value="256" >
                <label>College Name</label>
                 <select  name="College" id='College' onchange="collegeByDepartment(this.value);" class="form-control" required>
                 <option value=''>Select Faculty</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
              </div>
               <div class="col-lg-2">
                 <label>Department</label>
                  <select  id="Department" name="Department" class="form-control"  onchange="fetchcourse()" required>
                     <option value=''>Select Department</option>
                 </select>
              </div>  


              <div class="col-lg-2">
                 <label>Course</label>
                  <select  id="Course" name="Course" class="form-control" required >
                     <option value=''>Select Course</option>
                 </select>
              </div>


             

              <div class="col-lg-1">
                 <label>Batch</label>
                   <select id="batch" name="batch"  class="form-control" required>
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
                  <input type ="hidden" id="semester" name="semester"  class="form-control" >
                     
            
              </div>   
              <div class="col-lg-2">
               <label>File .xls</label>
               <input type="file" name="file_exl" id="file_exl" class="form-control" name=""  required>
              </div>
              
          
              <div class="col-lg-1">
                 <label>Action</label><br>
                <input type="submit" name="" class="btn btn-success" value="Upload">
              </div>
              <div class="col-lg-1">
                 <label>Format</label><br>
                   <button class="btn btn-warning" type="button" onclick="format();">Download</button>
              </div>
            
            </div>
         </form><br><br>


         <div class="row" id="load_study_scheme">

             
            </div>
        </div>
   </div>
   <!-- /.container-fluid -->

</section>
<p id="ajax-loader"></p>
   <script type="text/javascript">
          $(window).on('load', function() 
          {
         $('#btn6').toggleClass("bg-success"); 
           })
          function format() 
           {
            window.location.href = 'http://gurukashiuniversity.co.in/gkuadmin/formats/studyscheme.csv';
           }
         function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }
 
          function search_study_scheme()
          {
       var code=227;
       var CollegeID=document.getElementById('College').value;
       var Course=document.getElementById('Course').value;
       var batch=document.getElementById('batch').value;
       var semester=document.getElementById('semester').value;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,CollegeID:CollegeID,Course:Course,Batch:batch,Semester:semester
                  },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("load_study_scheme").innerHTML=response;
            }
         });

     }     
        function update_study_scheme_search()
          {
       var code=254;
       var CollegeID=document.getElementById('College').value;
       var Course=document.getElementById('Course').value;
       var batch=document.getElementById('batch').value;
       var semester=document.getElementById('semester').value;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,CollegeID:CollegeID,Course:Course,Batch:batch,Semester:semester
                  },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("load_study_scheme").innerHTML=response;
            }
         });

     }

     function Add()
      {
         var code=225;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
      }

    function fetchcourse()
{   
   
  

 var College=document.getElementById('College').value;
       var department=document.getElementById('Department').value;

var code='305';
$.ajax({
url:'action.php',
data:{department:department,College:College,code:code},
type:'POST',
success:function(data){
if(data != "")
{
     console.log(data);
$("#Course").html("");
$("#Course").html(data);
}
}
});

}
       function Search()
          {
         // $('#'+id).toggleClass("bg-green");

         var code=226;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
        }
function Move(){
 //228
         var code=228;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
        }
function Copy(){ //229
var code=229;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
}
function Update(){ 

//230
   var code=230;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
}
// function Upload()
// { //241
//   var code=241;
//          var spinner=document.getElementById('ajax-loader');
//          spinner.style.display='block';
//          $.ajax({
//             url:'action.php',
//             type:'POST',
//             data:{
//                code:code
//                },
//             success: function(response) 
//             { 
//                spinner.style.display='none';
//                document.getElementById("table_load").innerHTML=response;
//             }
//          });
// }


   $(document).ready(function (e) {    // image upload form submit
           $("#upload_study_scheme").on('submit',(function(e) {
              e.preventDefault();

              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "action.php",
                 type: "POST",
                 data:  new FormData(this),
                 // dataType:'json',
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
                      console.log(data);
                          spinner.style.display='none';
                          if (data==1)
                           {
                           SuccessToast('Successfully Uploaded');
                          update_study_scheme_search();

                          }
                          else
                          {
                           ErrorToast(data,'bg-danger' );
                           update_study_scheme_search();
                          }
                  }, 
              });
           }));
         });




function add_submit()
{
   var CollegeID=document.getElementById('College').value;
   var CourseID=document.getElementById('Course').value;
   var batch=document.getElementById('batch').value;
   var semester=document.getElementById('semester').value;
   var subject_name=document.getElementById('subject_name').value;
   var subject_code=document.getElementById('subject_code').value;
   var subject_type=document.getElementById('subject_type').value;
   var subject_group=document.getElementById('subject_group').value;
   var int_marks=document.getElementById('int_marks').value;
   var ext_marks=document.getElementById('ext_marks').value;
   var elective=document.getElementById('elective').value;
   var lecture=document.getElementById('lecture').value;
   var practical=document.getElementById('practical').value;
   var tutorials=document.getElementById('tutorials').value;
   var credits=document.getElementById('credits').value;
   if ( CollegeID!='' && CourseID!='' && batch!='' && semester!='' && subject_name!='' && subject_code!='' && subject_type!='' && subject_group!='' && int_marks!='' && ext_marks!='' && elective!='' && lecture!='' && practical!='' && tutorials!='' && credits!='') 
   {
   var code=242;

         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
               CollegeID:CollegeID,
               CourseID:CourseID,
               batch:batch,
               semester:semester,
               subject_name:subject_name,
               subject_code:subject_code,
               subject_type:subject_type,
               subject_group:subject_group,
               int_marks:int_marks,
               ext_marks:ext_marks,
               elective:elective,
               lecture:lecture,
               practical:practical,
               tutorials:tutorials,
               credits:credits
               },
            success: function(response) 
            { 
              
               spinner.style.display='none';
               if (response==1) {
                  SuccessToast('Successfully Submit');
               }
               else
               {
                  ErrorToast('Try Again','bg-danger');
               }
            }
         });
      }
      else
      {
         ErrorToast('Please Input All Required Filed','bg-warning');
      }



}


function delete_study_scheme(id)
{
 
       
var a=confirm('Are you sure to Delete');

   var code=291;
   if (a==true) {

         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({ url:'action.php',
            type:'POST',
            data:{id:id,code:code}, success: function(response) 
            { 
              
               spinner.style.display='none';
               
               if (response==1) {
                update_study_scheme_search();
                  SuccessToast('Successfully Deleted');
               }
               else
               {
                  ErrorToast('Try Again','bg-danger');
               }
            }




         });

   }
}
function update_study_scheme(srno)
{
  
   var subject_name=document.getElementById('subject_name'+srno).value;
    // alert(subject_name);
   var subject_code=document.getElementById('subject_code'+srno).value;
   var subject_type=document.getElementById('subject_type'+srno).value;
   var int_marks=document.getElementById('int_marks'+srno).value;
   var ext_marks=document.getElementById('ext_marks'+srno).value;
   var elective=document.getElementById('elective'+srno).value;
   var lecture=document.getElementById('lecture'+srno).value;
   var practical=document.getElementById('practical'+srno).value;
   var tutorials=document.getElementById('tutorials'+srno).value;
   var credits=document.getElementById('credits'+srno).value;
   if (subject_name!='' && subject_code!='' && subject_type!='' &&  int_marks!='' && ext_marks!='' && elective!='' && lecture!='' && practical!='' && tutorials!='' && credits!='') 
   {
    var a=confirm('Are you sure to Update');
   var code=255;
   if (a==true) {

         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
               subject_name:subject_name,
               subject_code:subject_code,
               subject_type:subject_type,
               int_marks:int_marks,
               ext_marks:ext_marks,
               elective:elective,
               lecture:lecture,
               practical:practical,
               tutorials:tutorials,
               credits:credits,
               srno:srno
               },
            success: function(response) 
            { 
              
               spinner.style.display='none';
               // console.log(response);
               if (response==1) {
                update_study_scheme_search()
                  SuccessToast('Successfully Submit');
               }
               else
               {
                  ErrorToast('Try Again','bg-danger');
               }
            }
         });
      }
      else
      {

      }
  }
  else
  {
         ErrorToast('Please Input All Required Filed','bg-warning');

  }



}

function move_study_scheme()
{
   var CollegeID=document.getElementById('College').value;
   var CourseID=document.getElementById('Course').value;
   var from_batch=document.getElementById('from_batch').value;
   var from_semester=document.getElementById('from_semester').value;
   var to_batch=document.getElementById('to_batch').value;
   var to_semester=document.getElementById('to_semester').value;
   var code=250;
  
   if ( CollegeID!='' && CourseID!='' && from_batch!='' && from_semester!='' && to_batch!='' && to_semester!='') 
   {
    var a=confirm('Are you sure to Move \n Batch '+from_batch+' To '+to_batch+'\n Semester '+from_semester+' To '+to_semester);
if (a==true) {
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
               CollegeID:CollegeID,
               CourseID:CourseID,
               from_batch:from_batch,
               from_semester:from_semester,
               to_batch:to_batch,
               to_semester:to_semester,
               
               },
            success: function(response) 
            { 
              // console.log(response);
               spinner.style.display='none';
               if (response==1) 
               {
                  SuccessToast('Successfully Move');
               }
               else
               {
                  ErrorToast('Try Again','bg-danger');
               }
            }
         });
      }
      else
      {
        
      }
}
else
{
 ErrorToast('Please Input All Required Filed','bg-warning');
}


}
function copy_study_scheme()
{
   var CollegeID=document.getElementById('College').value;
   var CourseID=document.getElementById('Course').value;
   var from_batch=document.getElementById('from_batch').value;
   var from_semester=document.getElementById('from_semester').value;
   var to_batch=document.getElementById('to_batch').value;
   var to_semester=document.getElementById('to_semester').value;
   var code=253;
  
   if ( CollegeID!='' && CourseID!='' && from_batch!='' && from_semester!='' ) 
   {
    var a=confirm('Are you sure to Copy \n Batch '+from_batch+' \n Semester '+from_semester+'To \n Batch '+to_batch+' \n Semester '+to_semester);
if (a==true) {
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
               CollegeID:CollegeID,
               CourseID:CourseID,
               from_batch:from_batch,
               from_semester:from_semester,
               to_batch:to_batch,
               to_semester:to_semester
             
               
               },
            success: function(response) 
            { 
              // console.log(response);
               spinner.style.display='none';
               if (response==1) 
               {
                  SuccessToast('Successfully Copy');
               }
               else
               {
                  ErrorToast('Try Again','bg-danger');
               }
            }
         });
      }
      else
      {
        
      }
}
else
{
 ErrorToast('Please Input All Required Filed','bg-warning');
}


}


function verifiy()
{
  var verifiy=document.getElementsByClassName('un_check');
var len_student= verifiy.length; 
  var code=243;
  var subjectIDs=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            subjectIDs.push(verifiy[i].value);
          }
       }
     


  if((typeof  subjectIDs[0]== 'undefined'))
  {
    alert('Select atleast one Subject');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action.php',
         data:{subjectIDs:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully Verified');
               search_study_scheme();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
}
function un_verifiy()
{
  var un_verifiy=document.getElementsByClassName('v_check');
var len_student= un_verifiy.length; 
  var code=244;
  var subjectIDs=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(un_verifiy[i].checked===true)
          {
            subjectIDs.push(un_verifiy[i].value);
          }
       }
     


  if((typeof  subjectIDs[0]== 'undefined'))
  {
    alert('Select atleast one Subject');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action.php',
         data:{subjectIDs:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully UnVerified');
               search_study_scheme();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
}


function un_verifiy_select()
{
        if(document.getElementById("select_all").checked)
        {
            $('.un_check').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.un_check').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.un_check').on('click',function()
    {
        var a=document.getElementsByClassName("un_check:checked").length;
        var b=document.getElementsByClassName("un_check").length;
        
        if(a == b)
        {

            $('#select_all').prop('checked',true);
        }
        else
        {
            $('#select_all').prop('checked',false);
        }
    });
 
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

function onchange_sem()
{
var code='251';
var CourseID = $("#Course").val();
var CollegeID = $("#College").val();
// alert('g');
$.ajax({
url:'action.php',
data:{CourseID:CourseID,CollegeID:CollegeID,code:code},
type:'POST',
success:function(data){
    // console.log(data);
if(data != "")
{
$("#from_semester").html("");
$("#from_semester").html(data);
}
}
});
}
function onchange_batch()
{
var code='252';
var CourseID = $("#Course").val();
var CollegeID = $("#College").val();
var from_semester = $("#from_semester").val();
// alert('g');
$.ajax({
url:'action.php',
data:{CourseID:CourseID,CollegeID:CollegeID,from_semester:from_semester,code:code},
type:'POST',
success:function(data){
    // console.log(data);
if(data != "")
{
$("#from_batch").html("");
$("#from_batch").html(data);
}
}
});
}

   </script>
  </br>
<div>




    <?php 


    include "footer.php";  ?>