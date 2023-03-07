<?php 
  ini_set('max_execution_time',0);
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-md-4 col-lg-4 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Registartion</h3>
               </div>
               <form class="form-horizontal" action="#" method="POST" enctype='multipart/form-data'>
                  <div class="card-body">
                     <div class="form-group row">
                        <div class="col-lg-6">
                        <label for="inputEmail3" class=" col-form-label">Session</label>
                           <select name="session" required class="form-control">
                              <option value="">Select</option>
                              <?php
                                 $result1 = "select Distinct  RegistrationSession from  StudentRegistaionMaster ";
                                $stmt2 = sqlsrv_query($conntest,$result1);
                                 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                 {
                                    ?>
                                    <option value="<?= $row1['RegistrationSession'];?>"> <?=$row1['RegistrationSession'];?></option>
                                 <?php
                                 }
?>
                           </select>
                           
                        </div>
                        <div class="col-lg-6">
                        <label for="inputEmail3" class=" col-form-label">Semster</label>
                           <select name="sem" required class="form-control">
                              <option value="">Select</option>
                              <?php
                              for ($i=1; $i <=12 ; $i++) 
                              { 
                                 ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                 <?php
                              } 
                              ?>
                           </select>
                        </div> 
                        <div class="col-lg-6">
                        <label for="inputEmail3" class=" col-form-label">Status</label>
                           <select name="status" required class="form-control">
                              <option value="">Select</option>
                              <option value="0">Registration</option>
                              <option value="4">Direct Registered</option>
                           </select>
                        </div>
                        <div class="col-lg-6">
                        <label for="inputEmail3" class=" col-form-label">Date</label>
                           <input type="date" name="r_date" required class="form-control">
                        </div>
                        <div class="col-lg-12">
                        <label for="inputEmail3" class=" col-form-label">Excel</label>
                           <input type="file" name="file_exl" required="" class="form-control">
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

<!-- 
            <div class="card card-info"> 
               <div class="card-header"> 
                  <h3 class="card-title">Employee Permission</h3> 
                  <div class="card-tools"> 
                     <div class="input-group input-group-sm" style="width: 150px;"> 
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search Employee ID" onkeyup="categoryEmployeeSearch(this.value);">
                        </div>
                     </div>
                  </div>
                  <div id="search_record_emp_permission">
                     
                  </div>
                          
                    
                
               
            </div> -->
            <!-- /.card -->
         </div>
       
            <div class="col-lg-8 col-md-8 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title"></h3>
                     <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                           
                           
                        </div>
                     </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0" style="height: 480px;">
                     <table class="table table-head-fixed text-nowrap">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody id="search_record">
                       
                        </tbody>
                     </table>
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
   function categoryEmployeeSearch(id)
   {
      //alert(id);
      var code=53;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,emp_id:id
         },
         success:function(response) 
         {
            document.getElementById("search_record_emp_permission").innerHTML =response;
            $(document).ajaxStop(function()
            {
               // window.location.reload();
            });
         },
         error:function()
         {
            alert("error");
         }
      });
   } 
   function assignPermission(id)
   {
      //alert(id);
      var code=55;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,emp_id:id
         },
         success:function(response) 
         {
            document.getElementById("assignCategoryPermissons").innerHTML =response;
            $(document).ajaxStop(function()
            {
               // window.location.reload();
            });
         },
         error:function()
         {
            alert("error");
         }
      });
   } 

  function deleteCategoryPermission(id,EmpID) {
    var code = '54';
    var categoryPermissionId = id;
    //alert(categoryPermissionId);
    $.ajax({
        url: 'action.php',
        data: {
            ID: categoryPermissionId,
            code: code
        },
        type: 'POST',
        success: function(data) {

            //console.log(data);
            categoryEmployeeSearch(EmpID);
            //location.reload(true);

        }
    });
}
</script>

<?php include "footer.php";  ?>