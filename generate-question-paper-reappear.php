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
                     //console.log(data);
                 },
                 error: function (error) {
                 //console.log(error);
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
                                   
                                    <?php
                                    $examQry="SELECT * FROM question_session order by Id desc";
                                    $examRes=mysqli_query($conn,$examQry);
                                    while ($examData = mysqli_fetch_array($examRes)) 
                                    {
                                       ?>
                                        <option value = "<?=$examData['session_name'];?>" > <?=$examData['session_name'];?> </option> 
                                        <?php
                                    }
                                    ?> 
                                    
                                    
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-2">
                              <div class="input-group-sm">
                                <Input type="text"  class="form-control subject_code" onchange="courseName(this.value)" name="subject_code" id="subject_code"  required="" aria-describedby="button-addon2" placeholder="Subject Code" required />
                                
                                

                              </div>
                           </div> 
                           <div class="col-lg-4">
                              <div class="input-group input-group-sm mb-3">
                                <select class="form-control" id="courseName"  required="" aria-describedby="button-addon2" >
                                </select>

                                <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="searchSubjectCode_paper();"><i class="fa fa-search"></i></button>
                                

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
                
                document.getElementById("courseName").innerHTML=response;
            }
        });
    }
    function generateQuestionPaper_file(CourseID,SubjectCode,Batch,Semester,exam_session,Examination) 
    { 

     
        var code=295;

        var spinner=document.getElementById("ajax-loader");
            spinner.style.display='block';
         
        $.ajax({
            url:'action.php',
            type:'post',
            data:{
                code:code,SubjectCode:SubjectCode,Semester:Semester,CourseID:CourseID,Batch:Batch,Examination:Examination,exam_session:exam_session
            },
            success: function(response)
            {

                
              // console.log(response);
 document.getElementById("table_load").innerHTML='';
              searchSubjectCode_paper();
                           
            spinner.style.display='none';
                
            if (response=='0') 
            {
                SuccessToast("Sucess");
            }
            else if(response=='1')
            {
              ErrorToast("Already Generated",'bg-danger');
            
            }
            else
            {
                ErrorToast('Already Generated','bg-danger');
            }

            }
        });


        // body...
    }
    function dltPaper(id)
    {
        var code=189;
        $.ajax({
            url:'action.php',
            type:'post',
            data:{
                code:code,id:id
            },
            success: function(response)
            {
                searchSubjectCode(0,0,0);
                // location.reload(true);
                
                // console.log(response);
            }
        });
    }
    function searchSubjectCode_paper() 
    {
        
       var examination=document.getElementById('examSession').value;
            var subjectCode=document.getElementById('subject_code').value;
       
            var courseId=document.getElementById('courseName').value;
    
         if(courseId!='')
         {
 var spinner=document.getElementById("ajax-loader");

            spinner.style.display='block';
        // alert(examName+examSession+courseName);
        var code=290;
        $.ajax({
            url:'action.php',
            type:'post',
            data:{
                code:code,subjectCode:subjectCode,courseId:courseId,examination:examination
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
