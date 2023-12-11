<?php 
   include "header.php";   
   ?>
<script>
   $(document).ready(function(){
   
       $(document).on('keydown','.subject_code', function() {
   
           // Initialize jQuery UI autocomplete
           $(".subject_code").autocomplete({
                 source: function( request, response ) {
               $.ajax({
         
               url: "action.php",
                 type: 'post',
                 dataType: "json",
                 data: {
                     search: request.term,code:116
                 },
                 success: function( data ) {
                     response( data );
                    // console.log(data);
                 },
                 error: function (error) {
                // console.log(error);
                  }
               });
             },
             select: function (event, ui) {
               $(this).val(ui.item.label); // display the selected text
               var subject_code = ui.item.value; // selected value
   
                       
             return false;
             }
           });
       });
     });
</script>
<section class="content">
   <div class="container-fluid">
   <div class="card card-info">
   </div>
        <div class="row">
          <div class="col-lg-12 col-sm-6">
            <div class="card card-primary card-tabs">
              <div class="card-header">
               <div class="row">
                  <div class="col-lg-2">
                     <h3 class="card-title ">Generate Paper</h3>
                  </div>
                  <div class="col-lg-10">
                     <div class="card-tools">
                        <div class="row">
                           <div class="col-lg-2">
                              <div class="input-group-sm">
                                <select class="form-control" id="examSession" >
                                    <option value="New">New </option>
                                    <option value="Old">Old </option>
                                    
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="input-group-sm">
                                 <select class="form-control" id="examName" required="" >
                                    <option value="">Select Exam</option>
                                    <?php
                                    $examQry="SELECT * FROM question_exam";
                                    $examRes=mysqli_query($conn,$examQry);
                                    while ($examData = mysqli_fetch_array($examRes)) 
                                    {
                                       ?>
                                        <option value = "<?=$examData['id']?>" > <?=$examData['exam_name'];?> </option> 
                                        <?php
                                    }
                                    ?>
                                 </select>
                                 
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="input-group-sm">
                                <Input type="text"  class="form-control subject_code" onchange="courseName(this.value)" name="subject_code" id="subject_code"  required="" aria-describedby="button-addon2" placeholder="Subject Code" required />
                                <!-- <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="searchSubjectCode('0','0')"><i class="fa fa-search"></i></button> -->
                                

                              </div>
                           </div> 
                           <div class="col-lg-4">
                              <div class="input-group input-group-sm mb-3">
                                <select class="form-control" id="courseName"  required="" aria-describedby="button-addon2" >
                                </select>

                                <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="searchSubjectCode('0','0','0')"><i class="fa fa-search"></i></button>
                                

                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="input-group-sm">
                                 
                              </div>
                           </div>
                           <div class="col-lg-1">
                              <div class="input-group-sm">
                              </div>
                           </div>
                           
                           
                        </div>
                     
                     </div>
                  </div>
               </div>
            </div>
              <div class="card-body">
                 <div id="table_load">
                    <div class="card-body table-responsive ">
                    </div>
                </div>
             
              </div>
              <!-- /.card -->
            </div>
          </div>
        
        </div>
   </div>
   <!-- /.container-fluid -->
</section>
  

<script type="text/javascript">
    function courseName(subjectCode) 
    {
        // alert(value);
        var code=139;
        // alert(SubjectCode+' '+Semester+' '+CourseID+' '+examName);
        $.ajax({
            url:'action.php',
            type:'post',
            data:{
                code:code,subjectCode:subjectCode
            },
            success: function(response)
            {
                console.log(response);
                document.getElementById("courseName").innerHTML=response;
            }
        });
    }
    function generateQuestionPaper(SubjectCode,Semester,CourseID,examName) 
    {
        var code=138; 
        var spinner=document.getElementById("ajax-loader");
        //alert(examName);
            spinner.style.display='block';
        // alert(SubjectCode+' '+Semester+' '+CourseID+' '+examName);
        $.ajax({
            url:'action.php',
            type:'post',
            data:{
                code:code,SubjectCode:SubjectCode,Semester:Semester,CourseID:CourseID,examName:examName
            },
            success: function(response)
            {

                // location.reload(true);
                searchSubjectCode(examName,SubjectCode,CourseID);
                document.getElementById("table_load").innerHTML='';
               // document.getElementById('subject_code').value='';
                //document.getElementById('courseName').value='';
            spinner.style.display='none';
                 console.log(response);
            if (response=='Successfully Generated') 
            {
                SuccessToast(response);
            }
            else
            {
                ErrorToast(response,'bg-danger');
            }

            }
        });


        // body...
    }
    function dltPaper(id,SubjectCode)
    {
        var code=189;
        $.ajax({
            url:'action.php',
            type:'post',
            data:{
                code:code,id:id,SubjectCode:SubjectCode
            },
            success: function(response)
            {
                searchSubjectCode(0,0,0);
                // location.reload(true);
                
                // console.log(response);
            }
        });
    }
    function searchSubjectCode(examName,SubjectCode,courseId) 
    {
        if(examName==0)
        {
            examName=document.getElementById('examName').value;
        }
        if (SubjectCode==0) 
        { 
            subjectCode=document.getElementById('subject_code').value;
        }
        if (courseId==0) 
        {
            courseId=document.getElementById('courseName').value;
        }
        if (examName!='') 
        {
        var examSession=document.getElementById('examSession').value;
 var spinner=document.getElementById("ajax-loader");
            spinner.style.display='block';
        // alert(examName+examSession+courseName);
        var code=135;
        $.ajax({
            url:'action.php',
            type:'post',
            data:{
                code:code,examName:examName,examSession:examSession,subjectCode:subjectCode,courseId:courseId
            },
            success: function(response)
            {
                spinner.style.display='none';
                document.getElementById("table_load").innerHTML=response;
            }
        });
}
else
{
  alert('Please Select Exam Name');
}
    
    }
</script>
</br>
<p id="ajax-loader"></p>
<div>
<?php include "footer.php";  ?>
