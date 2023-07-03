<?php

ini_set('max_execution_time', '0');

    include 'header.php';
?>
<p id="ajax-loader"></p>
  <section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
 <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
                <div class="row">
                
    <form action="" enctype="multipart/form-data" method="post">
          <input type="file" name="file_exl" class="btn btn-warning btn-xs">
          </div>
 <div class="col-sm-1">
         <button type="submit"  name='email_imp' class="btn btn-warning btn-xs">Import</button>
          </div>
</form>

               </div>
            </div>
          
          
          

<?php 


if(ISSET($_POST['email_imp']))
{  
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;

  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
    $id = $filesop[0];
    $SubjectName =$filesop[1];

   // $subjecttype = $filesop[2];
   //   $subjectcode= $filesop[3];
   //       $l= $filesop[4];
   //           $t= $filesop[5];
   //               $p= $filesop[6];
   //                 $c= $filesop[7];

//echo $query1="INSERT into StudentRegistrationForm (Session,IDNo,Status,SemesterId) Values('$reg_id','$reg_id1','$reg_id2','$reg_id3')";

 $query1="UPDATE Admissions  Set ClassRollNo='$SubjectName'  where IDNo='$id'";


 // echo $query1="UPDATE MasterCOurseStructure  Set SubjectName='$SubjectName',SubjectType='$subjecttype',
 // SubjectCode='$subjectcode',Lecture='$l' ,Tutorial='$t',Practical='$p',NoOFCredits='$c'  where SrNo='$id'";
echo"<br>";
 $stmt2 = sqlsrv_query($conntest,$query1);

 if( $stmt2  === false) {

     die( print_r( sqlsrv_errors(), true) );
 }
 else
 {
 echo "Inserted";
 }


}

}
?>

            <!-- /.card-header -->
          
            <!-- /.card -->
         </div>
      </div>

      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>   

      <?php include'footer.php';?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
