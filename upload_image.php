<?php 
   include 'connection/connection.php';
   
   /*  $ftp_server1 = "ftp.gurukashiuniversity.in";
      $ftp_user_name1 = "data@gurukashiuniversity.in";
      $ftp_user_pass1 = "Amrik@123";*/


 $ftp_server1 = "10.0.8.10";
  $ftp_user_name1 = "gurukashi";
  $ftp_user_pass1 = "Amrik@123";
   

      $remote_file1 = "";
      $conn_id = ftp_connect($ftp_server1) or die("Could not connect to $ftp_server");
        $login_result = ftp_login($conn_id, $ftp_user_name1, $ftp_user_pass1) or die("Could not login to $ftp_server");
    $allowedTypes = array( "image/JPEG" ,"image/JPG" , "image/jpeg", "image/gif",'image/png');
   
      $code=$_POST['code'];
     
   // image passport size   
    if ($code==1) {
     $question_id=$_POST['id'];
          $aa=$_FILES['skill'];
          $innerCount=count($aa['name']);
          $count=count($aa);
          for ($i=0; $i < $innerCount ; $i++) 
          { 
   
             for ($j=0; $j < $count ; $j++) 
             { 
               if ($j==0) 
               {
                 $dimension='name';
               }
               elseif ($j==1) 
               {
                 $dimension='full_path';
               }
               elseif ($j==2) 
               {
                 $dimension='type';
               }
               elseif ($j==3) 
               {
                 $dimension='tmp_name';
               }
               elseif ($j==4) 
               {
   $dimension='error';
               }
               elseif ($j==5) 
               {
                 $dimension='size';
               }
   
               $a[$i][$dimension]=$aa[$dimension][$i];
              
             }
          }
         ftp_chdir($conn_id, "question_images") or die("Could not change directory");
     for ($i=0; $i < $innerCount ; $i++) 
     { 
       if (in_array($a[$i]['type'],$allowedTypes))
       { 
         $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
         $result = $question_id;
         for ($j = 0; $j < 25; $j++)
         $result .= $characters[mt_rand(0, 21)];
       $image_name =  str_ireplace( array( '\'', '"',
      ',' , '-', '_',' ' ),'', $a[$i]['name']);
         $image_name =$result.$image_name;
         $target_dir = $image_name;
         ftp_pasv($conn_id,true);
         ftp_put($conn_id, $target_dir, $a[$i]['tmp_name'], FTP_BINARY) or die("Could not upload to $ftp_server");
    
          $photoname=$image_name;
          $sql = "INSERT into question_image (image,question_id)values('$photoname','$question_id')";
         $result = mysqli_query($conn,$sql);
        
       }
   
     
     }
         ftp_close($conn_id);
    }
   
   elseif ($code==2) {
        $student_image=$_POST['student_image'];
   $image_name1 = $_FILES['userImage']['name'];   
    $image_size = $_FILES['userImage']['size'];      
   $image_tmp = $_FILES['userImage']['tmp_name'];
   $image_type = $_FILES['userImage']['type']; 
   $image_name =  str_ireplace( array( '\'', '"',
      ',' , '-', '_',' ' ),'', $image_name1);

 $allowedTypes_png = array( 'image/png');

   if (in_array($_FILES['userImage']['type'],$allowedTypes_png) and $image_size<5000000)
   { 
   $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
       $result = 'image';
       for ($i = 0; $i < 25; $i++)
       $result .= $characters[mt_rand(0, 21)];
       $image_name =$student_image.$result.$image_name;
       $target_dir = $image_name;
     ftp_chdir($conn_id, "ID_Card_images") or die("Could not change directory");
       ftp_pasv($conn_id,true);
     ftp_put($conn_id, $target_dir, $image_tmp, FTP_BINARY) or die("Could not upload to $ftp_server");
     ftp_close($conn_id);
   
    $photoname=$image_name;
    $sql = "UPDATE id_card SET image='$photoname' WHERE id='$student_image'";
   
      
      $result = mysqli_query($conn,$sql);
      ?>

      <a class="example-image-link" href="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$photoname;?>" data-lightbox="example-1"><img class="example-image" src="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$photoname;?>" alt="image-1" width="100" height='100' /></a>
<b>Preview</b><?php 
   }
   else
    {
    echo "<p style='color:red;'>Only .PNG/.jpg File Allowed and file size less then 5 MB</p> ";  
   
    } 
               ?>

<?php
   }
   
   
   ?>