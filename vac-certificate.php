<?php 
   include "header.php";  

   ?>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-3 col-md-3 col-sm-3">
         <div class="card card-info">
            <div class="card-header ">

<div class="row">
<!-- Button trigger modal -->


     

              <div class="col-lg-3"> <h3 class="card-title">Upload</h3>  </div><div class="col-lg-4">   <button   class="btn btn-warning btn-xs" data-toggle="modal" data-target="#exampleModalLong">Upload Signature</button>  </div> <div class="col-lg-1">
                                <a href="formats/examform.csv" class="btn btn-warning btn-xs ">Format</a>
                            </div>
                         </div>
            </div>

            <div class="card-body"><form action="#" method="post" enctype="multipart/form-data">  
               <div class="form-group row">
                 
                    <input type="hidden"  name="code" value="54">
          
                                 <label>Session</label>
                <select id='Session' name='session' class="form-control" required="">                                 
                <option value=''>Select Session</option>                          
                <option value='2018-19'>2018-19</option>
                <option value='2019-20'>2019-20</option>
                <option value='2020-21'>2020-21</option>
                <option value='2021-22'>2021-22</option>
                <option value='2022-23'>2022-23</option>
                <option value='2023-24'>2023-24</option>
                </select>

<label> Certificate No</label>

<select id="cert" name="cert" class="form-control" required="">      
 <?php $sql = "SELECT DISTINCT certificate,id from certificate";


$i=1;

$result = mysqli_query($conn,$sql);

echo "<option value=''>Choose certificate</option>";
while($row=mysqli_fetch_array($result))
{
?>
<option value="<?=$row['id'];?>"><?=$i;?></option>
<?php
  $i++; 
}?>

</select>

        <br/>   <br/> 
<p  id="certificateid" >

                
              </p>
<label> Value Added Course Name</label>
<textarea class="form-control" name="Vcoursename"></textarea>


<label>Browse Your .csv File:</label>
          <input type="file" class="form-control" name="file_exl" id="file_exl" required="" accept=".csv"> 
          <br/> 
               <br/>
 <input type="submit" name="Import" value="Import" class="form-control btn-info" id="btnimport">
               </div>
            </form>
            </div>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       
      </div>
      <div class="col-lg-9 col-md-9 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
             <h3 class="card-title">Print Certificate</h3>
           </div>


            <div class="row" style="padding-top: 10px;padding-left: 20px;">

               <div class="col-lg-3">
            <!-- /.card-header -->


                   <select name="College" id='College' onchange="courseByCollege(this.value)"
                                    class="form-control" required="">

                <option value=''>Select College</option>
                  <?php

     $sql="SELECT DISTINCT MasterCourseCodes.CollegeName, MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID  where UserAccessLevel.IDNo=$EmployeeID";


          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
  $college = $row1['CollegeName']; 
 
    ?>
<option  value="<?= $row1['CollegeID'];?>"><?= $row1['CollegeName'];?>&nbsp;(<?= $row1['CollegeID'];?>)</option>
<?php    }
?>
              </select>

           </div>
           <div class="col-lg-3">
                 
                                <select name="Course" id="Course" class="form-control">
                                    <option value=''>Select Course</option>

                                </select>
</div>
           <div class="col-lg-3">            
                                <select name="batch" class="form-control" id="Batch" required="">
                                    <option value="">Batch</option>
                                    <?php 
                                    for($i=2018;$i<=2024;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                                ?>

                                </select>
</div>
                          

<div class="col-lg-3">                   


                                <button class="btn btn-success" onclick="search();">Search</button>
                              <button class="btn btn-success" onclick="signature();">Signature</button> 
</div>

</div>
            <div class="card-body table-responsive">
             <div id='show_data'></div>
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>

<script>
function search()
{

 var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
      var college = document.getElementById('College').value;
      var course=document.getElementById('Course').value;
      var batch=document.getElementById('Batch').value;

     var code='348';
            $.ajax({
            url:'action.php',
            data:{college:college,code:code,course:course,batch:batch},
            type:'POST',
              success:function(data){
                
                if(data != "")
                {
                  // console.log(data);
                   spinner.style.display='none';
                    $("#show_data").html("");
                    $("#show_data").html(data);
                }
            }
          });


}



function signature()
{

 var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
      var college = document.getElementById('College').value;
      var course=document.getElementById('Course').value;
      var batch=document.getElementById('Batch').value;

     var code='349';
            $.ajax({
            url:'action.php',
            data:{college:college,code:code,course:course,batch:batch},
            type:'POST',
              success:function(data){
                
                if(data != "")
                {
                  // console.log(data);
                   spinner.style.display='none';
                    $("#show_data").html("");
                    $("#show_data").html(data);
                }
            }
          });


}



















  var spinner = $('#loader');
     $(function() { 
      $("#cert").change(function(e) {
        e.preventDefault();
//spinner.show();
        var college = $("#cert").val();
      
        var code='347';
            $.ajax({
            url:'action.php',
            data:{college:college,code:code},
            type:'POST',
              success:function(data){
                
                if(data != "")
                {
                  //console.log(data);
                  //spinner.hide();
                    $("#certificateid").html("");
                    $("#certificateid").html(data);
                }
            }
          });
    });
  });



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

function deleteAllChecked()
{
  var r = confirm("Do you really want to Delete");
    if (r == true) {
  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=313;
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
    // alert('');

    ErrorToast(' Select atleast one Student' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{certificateID:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully Deleted');
            


               search();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
}
else{

}
}
function deleteSignAll()
{
  var r = confirm("Do you really want to Delete");
    if (r == true) {
  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=314;
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
    // alert('');
    ErrorToast(' Select atleast one ' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{certificateID:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully Deleted');
            //    search_study_scheme();
            signature();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
}
else{

}
}

function deleteSignSingle(id)
{
var r = confirm("Do you really want to Delete");
    if (r == true) {
var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
         var code="315";
  $.ajax({
         url:'action_g.php',
         data:{certificateID:id,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully Deleted');
            //    search_study_scheme();
            signature();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
    }
    else{

    }
  } 
</script>
<?php 

if(isset($_POST["Import"]))
{ 
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  $timeStamp=date('Y-m-d H:i:s.v');
  $session=$_POST['session'];
  $certificateid =$_POST['cert'];
  $Vcoursename =$_POST['Vcoursename'];
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
    if($c>0)
    {
    $univrollno = $filesop[0];
  if ($univrollno!='')
     {
      $result1 = "SELECT  * FROM Admissions where UniRollNo='$univrollno' or ClassRollNo='$univrollno' or IDNo='$univrollno'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
        $IDNo= $row['IDNo'];
      }

  $sql1 = "INSERT INTO ValueAddedCertificate(IDNo,CertificateId,VCourseName,Session,UploadBy,UploadDate) VALUES ('$IDNo','$certificateid','$Vcoursename','$session','$EmployeeID','$timeStamp')";
    $stmt1 = sqlsrv_query($conntest, $sql1);
     }
    }
   $c = $c + 1;
   }
   ?>
<script>alert('Successfully inserted Total: '+<?php echo $c ?>);window.location.href = 'vac-certificate.php';</script>
   <?php 
}

  
if(isset($_POST["UploadSignature"]))
{ 

$CollegeID= $_POST['college_sign'];
$CourseID = $_POST['course_sign'];
$Batch = $_POST['batch_sign'];
$Session = $_POST['session_sign'];


 $head = $_FILES["headsign"]["name"];

 $dean = $_FILES["deansign"]["name"];
  
   if ($head!='' && $dean!='') {
      $headTmp = $_FILES["headsign"]["tmp_name"];
      $deanTmp = $_FILES["deansign"]["tmp_name"]; 

      $head_data = file_get_contents($headTmp);

      $dean_data = file_get_contents($deanTmp);


   $upimage = "INSERT into VACertificateSignature (CollegeID,CourseID,Batch,Session,DeanSignature,HeadSignature)    Values(?,?,?,?,?,?)";

$params = array($CollegeID,$CourseID,$Batch,$Session,$dean_data,$head_data);

$ss=sqlsrv_query($conntest,$upimage,$params);
if($ss==true)
{
  ?>
  <script>alert('Successfully Uploaded');
window.location.href = 'vac-certificate.php';
</script>
     <?php 
}
else
{
  ?>
  <script>alert('Not Uploaded');window.location.href = 'vac-certificate.php';</script>
     <?php 
}
    

}

}
?>



<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="" method="POST" enctype="multipart/form-data">
      <div class="modal-header btn-primary">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Signautre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" style="color: black;">
         <p style="color:red"><b>Signature dimensions must be  width 200 px  height  80 px.</b></p>
           <p style="color:red"><b>image must be  in (.png) format.</b></p>
         <div class="row"> 

            <div class="col-lg-2"> 
 <label>Session</label>    
                <select id='Session' name='session_sign' class="form-control" required="">                                 
                <option value=''>Select Session</option>                          
                <option value='2018-19'>2018-19</option>
                <option value='2019-20'>2019-20</option>
                <option value='2020-21'>2020-21</option>
                <option value='2021-22'>2021-22</option>
                <option value='2022-23'>2022-23</option>
                <option value='2023-24'>2023-24</option>
                </select></div>


   <div class="col-lg-3">
            <!-- /.card-header -->

 <label>College</label> 
                   <select name="college_sign" id='College_1' onchange="courseByCollege1(this.value)"
                                    class="form-control" required="">

                <option value=''>Select College</option>
                  <?php

     $sql="SELECT DISTINCT MasterCourseCodes.CollegeName, MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID  where UserAccessLevel.IDNo=$EmployeeID";


          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
  $college = $row1['CollegeName']; 
 
    ?>
<option  value="<?= $row1['CollegeID'];?>"><?= $row1['CollegeName'];?>&nbsp;(<?= $row1['CollegeID'];?>)</option>
<?php    }
?>
              </select>

           </div>
           <div class="col-lg-3">
                  <label>Course</label> 
                                <select name="course_sign" id="Course1" class="form-control" required>
                                    <option value=''>Select Course</option>

                                </select>
</div>
           <div class="col-lg-3">
            <label>Batch</label>             
                                <select name="batch_sign" class="form-control" id="Batch_1" required="">
                                    <option value="">Batch</option>
                                    <?php 
                                    for($i=2018;$i<=2024;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                                ?>

                                </select>
</div>

 <div class="col-lg-3">        
 <label>Dean Signature</label>    
                               <input type="file" name="deansign" class="form-control" required>
</div>

 <div class="col-lg-3">
 <label>Head Signature</label>             
                               <input type="file" name="headsign" class="form-control" required>
</div>





             </div>
                                
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="UploadSignature">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal -->

<p id="ajax-loader"></p>
<?php


 include "footer.php";  ?>