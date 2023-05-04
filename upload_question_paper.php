<?php 
   include "header.php"; 
    $code_access;  
    ?>
<script>
   $(document).ready(function(){
   
       $(document).on('keydown','.subject_code', function() {
   
           // Initialize jQuery UI autocomplete
           $("#subject_code").autocomplete({
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
      <!-- left column -->
      <div class="col-lg-3 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">Upload Questions</h3>
              
             <b id="total_count"></b>
            </div>
            <!--  <form class="form-horizontal" action="" method="POST"> -->
            <div class="card-body" id="" >
             
                <form  method="post"  class="form-horizontal" enctype="multipart/form-data">   <!-- left column -->
                
                     <label>Subject Code<b style="color:red;">*</b></label>
                     <Input type="text"  class="form-control subject_code"  name="SubjectCode" id="subject_code"  required="" />
                 
                     <label>Course<b style="color:red;">*</b></label>
                     <select  id="Course" class="form-control" Name='Course' onchange="selectSubName(this.value); " required>
                        <option value=''>Select Course</option>
                     </select>
                
                 
                     <label>Subject Name<b style="color:red;">*</b></label>
                     <select  id="subName" name="Subject" class="form-control" required>
                        <option value=''>Select Subject</option>
                     </select>
                
                 
                     <label>Batch<b style="color:red;">*</b></label>
                     <select   class="form-control" id="Batch" name='Batch' required="" >
                        <option value="">Batch</option>
                        <?php 
                           for($i=date('Y', strtotime('-6 year'));$i<=date('Y', strtotime('+0 year'));$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                 
                 
                     <label> Semester<b style="color:red;">*</b></label>
                     <select   id='Semester' class="form-control" required="" Name='Semester'>
                        <option value="">Sem</option>
                        <?php 
                           for($i=1;$i<=12;$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  
                <lable><b style="color:red">Upload Paper (only .docx Allowed)</b></lable>

       <Input type="file"   class="form-control"  name="file1" accept=".doc,.docx"       required=""/>
       <Input type="file"   class="form-control"  name="file2" accept=".doc,.docx"       required=""/>
       <Input type="file"   class="form-control"  name="file3" accept=".doc,.docx"       required=""/>
      
   <br>
       
     
      
      <input type="submit" class="form-control btn btn-primary"  name="qpupload" >
   </form>
                    
                  </div>
                  <!-- /.row -->
               </div>
            </div>
             
              
                  <div class="col-lg-9 col-md-9 col-sm-9">
                    
  
             
   <div class="card card-info">
            <div class="card-header">
                <h4>Uploaded </h4>
</div>

 <div class="panel-body">
 <div class="card-body" id="" >
   <?php 

 if(isset($_POST['delete']))
  {
$id=$_POST['id'];





$result = mysqli_query($conn,"Update question_paper_files set Status='-1' WHERE Id='$id'");


echo("<script>alert('Successfully Deleted')</script>");
  

}


 if(isset($_POST['qpupload']))
  {
   $status=0;
$SubjectCode=$_POST['SubjectCode'];
$CourseID=$_POST['Course'];
$Batch=$_POST['Batch'];
$Semester=$_POST['Semester'];


    $get_session="SELECT * FROM question_session where session_status='1'";
      $get_session_run=mysqli_query($conn,$get_session);
      if ($get_row=mysqli_fetch_array($get_session_run))
       {
      $current_session=$get_row['id'];    // code...
      $current_session_name=$get_row['session_name'];    // code...
      }


 $sql = "SELECT * from  MasterCourseStructure  where  SubjectCode ='$SubjectCode' ANd CourseID='$CourseID' ";
     
       $result = sqlsrv_query($conntest,$sql);
       
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
          $CollegeName=$row['CollegeName'];
          $CollegeID=$row['CollegeID'];
           $Course=$row['Course'];
          $CourseID=$row['CourseID'];
           $SubjectName=$row['SubjectName'];
       }
   










if($EmployeeID!='')
{
 echo $sql = "SELECT *  FROM question_paper_files WHERE SubjectCode='$SubjectCode' AND  Course='$Course' AND Batch='$Batch' ANd Examination='$current_session'";

 $result = mysqli_query($conn, $sql);
   if (mysqli_num_rows($result)>0)
    {

echo("<script>alert('Allready Uploaded')</script>");

echo("<script>location.href ='upload_question_paper.php';</script>");

}
else
{

  $dir =trim($Course);
  $my_dir =trim($Course)."/".trim($SubjectCode);

$errors= array();

  for($i=1;$i<=3;$i++){
   $file_name =$_FILES['file'.$i]['name'];
   $file_size =$_FILES['file'.$i]['size'];
   $file_tmp =$_FILES['file'.$i]['tmp_name'];
   $file_type=$_FILES['file'.$i]['type']; 

$allowedTypes = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                      

if (in_array($file_type,$allowedTypes))
{

}
else
{
echo("<script>alert('Wrong Format only docx')</script>");
   $message="Wrong Format only docx allowed";
  $status=1;
}

}
if($status==0)
{
  //for($i=1;$i<=4;$i++)
 for($i=1;$i<=3;$i++){
   $file_name =$_FILES['file'.$i]['name'];
 $file_size =$_FILES['file'.$i]['size'];

    $file_tmp =$_FILES['file'.$i]['tmp_name'];
  $file_type=$_FILES['file'.$i]['type'];

     

        $desired_dir="QuestionPaper"."/".$dir;

        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir",0777,true);   // Create directory if it does not exist
            }

   $desired_dirb="$desired_dir"."/".trim($Batch);
          if(is_dir($desired_dirb)==false){
                mkdir("$desired_dirb",0777,true);   // Create directory if it does not exist
            }
                        $desired_dir2="$desired_dirb"."/".trim($Semester);
          if(is_dir($desired_dir2)==false){
                mkdir("$desired_dir2",0777,true);   // Create directory if it does not exist
            }
              $desired_dir3="$desired_dir2"."/".trim($SubjectCode);
            if(is_dir($desired_dir3)==false){
                mkdir("$desired_dir3",0777,true);   // Create directory if it does not exist
            }

            if(is_dir("$desired_dir3/".$file_name)==false){
             
             $ffile=$SubjectCode.uniqid().$file_name;
                move_uploaded_file($file_tmp,"$desired_dir3/".$ffile);



 $sql = "INSERT INTO question_paper_files(CollegeName,CollegeID,Course,CourseID,Batch,Semester,SubjectCode,SubjectName,PaperFile,UpdatedBy,Status,Examination)VALUES('$CollegeName','$CollegeID','$Course','$CourseID','$Batch','$Semester','$SubjectCode','$SubjectName','$ffile','$EmployeeID','0','$current_session')";
    $result = mysqli_query($conn,$sql);
            
            }else{                  // rename the file if another one exist
                $new_dir="$desired_dir3/".$file_name.time();
                 rename($file_tmp,$new_dir) ;       
            }
     
        }else{
                print_r($errors);
                 $message="error a gyi";
        }

   
  if(empty($error)){
    $message="Uploaded Sucessfully";
  }
}
}
else{
echo $status;
  $message= "Wrong Format";
}


//echo("<script>location.href ='upload_paper.php';</script>");
}
  }
}

?>
<table class="table" id="example" >
   <thead> 
 <tr><th>Sr No</th> <th>Course</th><th>Batch</th><th>Semester</th><th>Subject Name</th><th>Subject Code</th><th>Question Paper</th><th colspan="2">Action</th></tr>

</thead>
    <tbody>

 <?php

  $count=0;
  $sql = "SELECT DISTINCT CourseID,Batch,SubjectCode FROM question_paper_files  inner join question_session on 
question_paper_files.Examination=question_session.Id
  WHERE UpdatedBy='$EmployeeID' ANd question_session.session_status='1'";

    $result = mysqli_query($conn,$sql);
     while($row=mysqli_fetch_array($result))
      {
    
   $course1[]=$row["CourseID"];
   $subject_code[]=$row["SubjectCode"];
   $count++;
  }
 $count;
for($w=0;$w<$count;$w++)
  {
   $r=$w;   

  $sql = "SELECT *  FROM question_paper_files WHERE SubjectCode='$subject_code[$w]' AND  CourseID='$course1[$w]'  AND UpdatedBy='$EmployeeID' ANd Status>=0";

$z=0;
 $result = mysqli_query($conn, $sql);
     while($row=mysqli_fetch_array($result))
  {
 $z++;
  }

  $sql = "SELECT *  FROM question_paper_files WHERE SubjectCode='$subject_code[$w]' AND  CourseID='$course1[$w]'  AND UpdatedBy='$EmployeeID' ANd Status>=0";

$p=0;
 $result = mysqli_query($conn, $sql);
     while($row=mysqli_fetch_array($result))
  { 
    ?>
    <!-- <tr><td><?= $row['Course'];?>ghfgh</td></tr> -->

  <tr> <?php if($p==0)
  {?>
   <td rowspan="<?=$z;?>" style="vertical-align : middle;text-align:center;"><?=$r+1;?></td><td rowspan="<?=$z;?>" style="vertical-align : middle;text-align:center;">
      <?= $row['Course'];?></td>
<td rowspan="<?=$z;?>" style="vertical-align : middle;text-align:center;"><?= $row['Batch'];?></td>
<td rowspan="<?=$z;?>" style="vertical-align : middle;text-align:center;"><?= $row['Semester'];?></td>
<td rowspan="<?=$z;?>" style="vertical-align : middle;text-align:center;">

   <?= $row['SubjectName'];?></td>
   <td rowspan="<?=$z;?>" style="vertical-align : middle;text-align:center;"><?= $row['SubjectCode'];?></td>
  <?php }?>
  <td>

 
    <a href="QuestionPaper/<?= $row['Course'];?>/<?= $row['Batch'];?>/<?= $row['Semester'];?>/<?= $row['SubjectCode'];?>/<?= $row['PaperFile'];?>">
   Paper-<?=$p+1;?></a></td>


 
<td  style="vertical-align : middle;text-align:center;">
   <?php  if($row['Status']==0)

  {?>

<form action="" method="POST">
  <input  type="hidden"  name="id" class="form-control" value="<?= $row['Id'];?>">
  <input type="submit" name="delete"  class= "btn btn-danger btn-xs" value="Delete">
</form>

<?php }else
{
  echo "<i class='fa fa-check'  style='color:green'></i>";
}
?>  </td>

<!-- <?php if($p==0)
  {?>
    <input  type="hidden"  name="id" class="form-control" value="<?= $row['Id'];?>">
    <td rowspan="<?=$z;?>" style="vertical-align : middle;text-align:center;" data-toggle="modal" data-target="#exampleModal"><button  class="btn btn-primary btn-xs" onclick="addnew(<?= $row['Id'];?>)">Upload New Paper</button> </td>
      
 <?php }?> -->
  </tr>
  <?php $p++;
}
} ?>

</tbody>

</table>
</div>
</div> 
              </div>
             


                  </div>
              
               
            </div>
            <?php  if ($code_access=='010' || $code_access=='011' || $code_access=='110' || $code_access=='111') 
                                          {
            ?>
            <div class="card-footer" style="text-align: right;">
               <input type="button" name="" value="Submit" class="btn btn-success" onclick="submitQuestion();">
            </div>
            <?php }  ?>
            <!-- /.card-footer -->
            <!-- </form> -->
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</section>

<script type="text/javascript">


  

   $(function() { 
   $("#subject_code").blur(function(e) {
     e.preventDefault();
   
     var subject_code = $("#subject_code").val();
     var code = "117";
         $.ajax({
         url:'action.php',
         data:{subject_code:subject_code,code:code},
         type:'POST',
         success:function(data){
             if(data != "")
             {
                 $("#Course").html("");
                 $("#Course").html(data);
                 
             }
   
         }
       });

         var code='151';
         $.ajax({
         url:'action.php',
         data:{subject_code:subject_code,code:code},
         type:'POST',
         success:function(data){
             if(data != "")
             {
                 $("#Batch").html("");
                 $("#Batch").html(data);
                
             }
   
         }
       });

         var code='152';
         $.ajax({
         url:'action.php',
         data:{subject_code:subject_code,code:code},
         type:'POST',
         success:function(data){
             if(data != "")
             {
                 $("#Semester").html("");
                 $("#Semester").html(data);
                 // console.log(data);
             }
   
         }
       });

   });
   });
 
   function selectSubName(course)
   {
      var subCode=document.getElementById("subject_code").value;
      // alert(subCode);
      var code=118;
      $.ajax({
         url:'action.php',
         type:'POST',
         data:{
            code:code,subCode:subCode,course:course
         },
         success: function(response) 
         {
            //console.log(response);
            document.getElementById("subName").innerHTML=response;
         }
      });
   }
   


function Uploadpaper()
   {
      var subCode=document.getElementById("subject_code").value;
      // alert(subCode);
      var code=118;
      $.ajax({
         url:'action.php',
         type:'POST',
         data:{
            code:code,subCode:subCode,course:course
         },
         success: function(response) 
         {
            //console.log(response);
            document.getElementById("subName").innerHTML=response;
         }
      });
   }
   



</script>


</br>
<p id="ajax-loader"></p>




<div>
<?php include "footer.php";  ?>

