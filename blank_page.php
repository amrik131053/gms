<?php 
   include "header.php";   
   ?>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-4 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">----</h3>   
            </div>
            <div class="card-body">
               <div class="form-group row">
                  --
               </div>
            </div>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
            - <h3 class="card-title">-----</h3>
           </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
             <form action="#" method="POST" enctype="multipart/form-data">
               <label>File</label>
                <input type="file" name="file_exl" class="form-control">
                <label>Action</label><br>
                <input type="submit" name="Submit" value="Upload" class="btn btn-primary">
             </form>
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->


<?php

if (isset($_POST['Submit'])) {
   
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
     $IDNo= $filesop[0];
     $Name = $filesop[1];
     $Designation = $filesop[2];
     $Address = $filesop[3];
     $check="SELECT * FROM Staff WHERE IDNo='$IDNo'";
   $check1 = sqlsrv_query($conntest,$check,array(), array( "Scrollable" => 'static' ));
    $cc=0; 
   $row_count = sqlsrv_num_rows($check1);
   if($row_count>0)
   {
    echo   $result1 = "UPDATE Staff SET Name='$Name',Designation='$Designation',PermanentAddress='$Address' WHERE IDNo='$IDNo'";
   $stmt1 = sqlsrv_query($conntest,$result1);
    echo "<br>";
    }
    else
    {
   echo  $result11="INSERT into Staff (IDNo,Name,Designation,PermanentAddress,JobStatus,CollegeName)values('$IDNo','$Name','$Designation','$Address','1','Guru Kashi University')";
     $stmt11 = sqlsrv_query($conntest,$result11);
     echo "<br>";
 
    }
}

}

 include "footer.php";  ?>