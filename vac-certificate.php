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
               <h3 class="card-title">Upload Data</h3>   
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
      <div class="col-lg-8 col-md-8 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
             <h3 class="card-title">Print Certificate</h3>
           </div>


            <div class="row" style="padding-top: 10px;padding-left: 20px;"><div class="col-lg-3">
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


                                <button class="btn btn-success">Search</button>
</div>

</div>
            <div class="card-body table-responsive">
             
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>

<script>
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
</script>
<?php 

if(isset($_POST["Import"]))
{ 
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  $timeStamp=date('Y-m-d H-i');
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

      $sql1 = "INSERT INTO vac(IDNo,CertificateId,VCourseName,Session,UploadedBy,UploadDate) VALUES ('$IDNo','$certificateid','$Vcoursename','$session','$EmployeeID','$timeStamp')";
      $sql = mysqli_query($conn,$sql1);
     }
    }
   $c = $c + 1;
   }
}
  ?>
  

<p id="ajax-loader"></p>

<!-- Modal -->


<?php


 include "footer.php";  ?>