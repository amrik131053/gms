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
                  <h3 class="card-title">New Paper</h3>
               </div>
               <form class="form-horizontal" action="#" method="POST" enctype='multipart/form-data'>
                  <div class="card-body">
                     <div class="form-group row">
                        <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">IDNo</label>
                           
                           <input type="text" name="" class="form-control" onkeyup="">
                           
                        </div>
                       
                        <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">Paper Title</label>
                           <textarea class="form-control"></textarea>
                        </div>
                        <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">Author Name</label>
                           <input type="text" name="r_date" required class="form-control">
                        </div>



                        <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">Faculty</label>
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


   <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">Name of Journal </label>
                           <input type="text" name="r_date" required class="form-control">
                        </div>

   <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">Date  of Publication </label>
                           <input type="date" name="r_date" required class="form-control">
                        </div>
<div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">DOI /Link </label>
                           <input type="text" name="r_date" required class="form-control">
                        </div>

<div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">Attachment</label>
                           <input type="file" name="r_date" required class="form-control">
                        </div>


                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" name="submit" class="btn btn-info">Submit</button>
                  </div>
                  <!-- /.card-footer -->
               </form>
            </div>
<?php

if (isset($_POST['submit']))
 {
 
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  $sem=$_POST['sem'];
$status=$_POST['status'];
$session=$_POST['session'];
$rdate=$_POST['r_date'];

  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
 $class_rollno = $filesop[0];

 

$sql = "SELECT  * FROM Admissions where ClassRollNo='$class_rollno'";
$stmt1 = sqlsrv_query($conntest,$sql);


        while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
         {
          $IDNo= $row['IDNo'];
          $stu_name= $row['StudentName'];
         }

$count=0;
$sqlQry="SELECT Session,IDNo,SemesterId from StudentRegistrationForm where  IDNo='$IDNo' and SemesterId='$sem' ";
$stmt11 = sqlsrv_query($conntest,$sqlQry);
while($row11 = sqlsrv_fetch_array($stmt11, SQLSRV_FETCH_ASSOC) )
{
   $count=1;
}

if($count>0)
{

   echo $stu_name."(".$class_rollno.")"." is already registered.<br>";
}
else
{
  //$stu_name."(".$class_rollno.")"." registered allowed.<br>";
 $query="INSERT INTO StudentRegistrationForm(Session,IDNo,SemesterId,RegidtrationDate,Status)

    VALUES ('$session','$IDNo','$sem','$rdate','$status')";

$stmt = sqlsrv_query($conntest,$query);
if( $stmt === false) {

    die( print_r( sqlsrv_errors(), true) );
}
}

}
}
?>


         </div>
       
            <div class="col-lg-8 col-md-8 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">All Papers</h3>
                     <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;"><Button  class="btn btn-primary">Filter</Button>
                           
                           
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 480px;">
                    <div id='search_record'></div>
                  </div>
                 
               </div>
              
            </div>
      
        
      </div>
      
   </div>
 
</section>

<div class="modal fade" id="exampleModal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Category </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="19">
            <div class="modal-body" id="update_category">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="Assign_Permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign Permission </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
               <form action="action.php" method="post">
                  
            <input type="hidden" name="code" value="57">
            <div class="modal-body" id="assignCategoryPermissons">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
               </form>
        
      </div>
   </div>
</div>

<script type="text/javascript">

load_data();
function load_data()
{ 
  
   var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code='1';
            $.ajax({
            url:'action_research.php',
            data:{code:code},
            type:'POST',
            success:function(data)
            { 
   spinner.style.display='none';

            document.getElementById("search_record").innerHTML=data;
            }
          });
 }

      

</script>

<?php include "footer.php";  ?>