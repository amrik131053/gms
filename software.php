<?php 
   include "header.php";   
   include"connection/ftp.php";
   ?>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <?php
if($EmployeeID =='105201'|| $EmployeeID=='131053')
{
 ?>
      <div class="col-lg-4 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Uploads</h3>
             
            </div>
            <form method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="card-body">
               <div class="form-group row">
                    <label>File Name</label>
            
            <input type="text" name="doc_name" class="form-control" required>

            <input type="hidden" name="doc_type"  value="Software">
            <br/>  
            <label>File Category</label>
            <select name="doc_category" class="form-control" required>
              <option value="">Select File Category</option>
              <option value="Open Source">Open Source</option>
              <option value="License">License</option> 
                   <option value="Driver">Driver</option> 
                         <option value="Trial">Trial</option> 
            </select>


            <br/>     <br/>
            <label>Browse File</label>
            <input type="file" name="fileToUpload"  accept=".exe , .zip, .rar" required class="form-control">
           <br/>
            
          
               </div>
            </div>
            <div class="card-footer">
              <?php if($login_result)
              {?>
    <input type="submit" value="Upload" class="btn btn-primary btn-block" name="uploadbtn">
              <?php }
              else
              {
echo "FTP Server Off";
              }
          ?>
            </div>
              </form>
          
            <!-- /.card-footer -->
         </div>
      
     
      </div>
       <div class="col-lg-8 col-md-8 col-sm-12">
    <?php 

  }

    ?>
      <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">My Software</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive  " style="height: 600px;">
              <table class="table">
                <thead>
                  <tr>
                    <th>SrNo</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th style="text-align: center;">Link</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
  if($EmployeeID=='105201'|| $EmployeeID=='131053')
  { 
   $sql = "SELECT * FROM software ORDER BY id Desc";
 }
else
{
   $sql = "SELECT * FROM software where doc_category!='License' ORDER BY id Desc";

}
  
  $result = mysqli_query($conn, $sql);
  $counter = 1;
  if(mysqli_num_rows($result) > 0)
  {
    while($row = mysqli_fetch_assoc($result))
    {
      extract($row);
      $id=$row['id'];
      $file= $row['doc_file'];
      ?>
      <tr>
        <td><?= $counter++; ?></td>
        <td><?= $row['doc_name']; ?></td>
        <td><?= $row['doc_type']; ?></td>
        <td><?= $row['doc_category']; ?></td>
        <td style="text-align: center;">
          <?php 
  if($EmployeeID=='105201'|| $EmployeeID=='131053')
  { ?>
        <a href="http://assknk.gurukashiuniversity.co.in/data-server/software/<?= $row['doc_file'];?>" title="Copy Link"><i class="fa fa-download"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;


        <i class="fa fa-trash" style="color:red" onclick="deletesoft(<?=$id;?>,'<?=$file;?>')"></i>

<?php }
else
{ ?>
 <a href="http://assknk.gurukashiuniversity.co.in/data-server/software/<?= $row['doc_file'];?>" title="Copy Link"><i class="fa fa-download"></i></a>
<?php }
  ?>

        </td>



         
       
      </tr>    

      <?php
    }
  }
  else
  {
    ?><tr>
          <td colspan="7">    <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Files Found ... </td>
        </tr>
      <?php }?>
                </tbody>
              </table>
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<!-- Modal -->
<?php 
 if(isset($_POST['uploadbtn']))
  {
    $doc_type = $_POST['doc_type'];
    $doc_name = $_POST['doc_name'];
    $doc_category = $_POST['doc_category'];

     $status='';
   

 $file_name = date('d-m-Y').basename($_FILES["fileToUpload"]["name"]); 
// Check if image file is a actual image or fake image
   $filename = $_FILES["fileToUpload"]["name"];
       $file_tmp =$_FILES["fileToUpload"]['tmp_name'];
    //$file_name = $_FILES['doc_file']['name'];
    $file_name = uniqid().$file_name;
   $target_dir = $file_name;

     $conn_id = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
  
  $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass) or die("Could not login to $ftp_server");
  ftp_chdir($conn_id, "software/") or die("Could not change directory");
  //ftp_chmod($conn_id, 0644, $file) or die("Could not change permissions");
  ftp_put($conn_id, $target_dir, $file_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
  ftp_close($conn_id);


  
    $sqlupload = "INSERT INTO software (doc_type,doc_name,doc_category,doc_file,status) VALUES ('$doc_type','$doc_name','$doc_category','$file_name','$status')"; 
    if(mysqli_query($conn,$sqlupload))
    {
?>

      <script> window.location.href="software.php";</script>
   <?php  }
    else
    {
      //echo "Error:<br>" . mysqli_error($connection_web_in);
    }
  }
 include "footer.php"; 

  ?>
  <script>
  function deletesoft(id,file)
   {

    var r = confirm("Do you really want to Delete ");
  if(r == true) 
     {
        
        
      var code=309;
      
     var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,file:file
            },
            success:function(response) 
            {
              console.log(response);
               spinner.style.display='none';
          location.reload(true);
            }
         });
      }
   } 
 </script>