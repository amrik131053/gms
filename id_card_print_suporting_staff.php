<?php 
   include "header.php";  
   include "connection/connection.php"; 
   ?>
   <p id="ajax-loader"></p>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
          
         <!-- Button trigger modal -->
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-info">
               <div class="card ">
                  
                <div class="row">
                            <div class="card-body ">
                        <div class="btn-group w-100 mb-2">
                    <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="id_card_pending();bg(this.id);"> ID Card Pending </a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="id_card_printed();bg(this.id);"> ID Card Printed </a>
                    <a class="btn"  id="btn6"  style="background-color:#223260; color: white; border: 1px solid;" onclick="ID_card();bg(this.id);"> ID Card </a>
                  </div>
              </div>
                <!-- </div> -->
              </div>
            </div>

               
    
                  <div class="card-body">
                    <div class="container-fluid">
 
</div>
                     <div class="form-group card-body table-responsive  row ">



<table class="table table-striped" id="example">
         <thead>
          <tr> 
         <th><input type="checkbox" name=""></th>  
         <th>Image</th>            
          <th>Name</th>
         <th>Father Name</th>
          <th>ID</th>
          <th>Department</th>
          <th>Designation</th>
          <th>Mobile Number</th>  
          <th>Address</th> 
          <th>Status</th>      
         
         </tr>
                   </thead>
    <tbody id="d_card_record">
<?php
$sql="SELECT * FROM Staff where   JobStatus='1'";
$result = sqlsrv_query($conntest,$sql); 
while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
{
 

// print_r($row);
$img=$row['Snap'];
    ?>
    
  <tr>
    <td><input type="checkbox" name="" class="sel" value="<?=$row['IDNo'];?>" ></td>
    <td data-toggle="modal" data-target="#modal-lg-upload-image" onclick='photo_modal111(<?=$row['id']?>);photo_modal(<?=$row['IDNo']?>);'> <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($img).'" height="50" width="50" class="img-thumnail" style="border-radius:50%">';?>
        
    </td>
     <td data-toggle="modal" data-target="#modal-lg-edit" onclick='edit_id_card("<?=$row['IDNo'];?>");'><?=$row['Name'];?></td>
      <td><?=$row['FatherName'];?></td>
       <td><?=$row['IDNo'];?></td>
        <td><?=$row['Department'];?></td>
         <td><?=$row['Designation'];?></td>
          <td><?=$row['MobileNo'];?></td>
          <td><?=$row['PermanentAddress']; 
               ?>
            </td>
            <td><?php
            $IDNo=$row['IDNo'];
               $sql1="SELECT * FROM Suporting_staff where IDNo='$IDNo'";
$result1 = mysqli_query($conn,$sql1); 
if($row1=mysqli_fetch_array($result1) )
{
          if ($row1['Status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}
}
?>
            </td>
</tr>

<?php
}
    

?>

    </tbody>
  </table>

  </form>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- <p id="edit_id_card__"></p> -->

<div class="modal fade" id="modal-lg-upload-image">
   <div class="modal-dialog modal-xs">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Upload Image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">

               <div class="col-lg-12" id="">
                          <table class="table " border="1">
   <tr style="background-color: #223260; color: white;">
      <th colspan="2"><center>Passport Size Image</center></th>
   </tr>
   <tr>
      <th>Image <span style="color:red;">(Image should be less than 5 MB)</span></th>
      <th>Action</th>
   </tr>
   <tr>
       <form id="image-upload" action="upload_image.php" method="post" enctype="multipart/form-data">
      <td> 
                  <!-- <label>Image</label> -->
                  <input type="hidden" name="student_image" id="student_image">
                  <input type="hidden" name="code" id="code" value="2">
                  <input type="file" name="userImage" id="userImage" class="form-control" required>
                 
                
                  
              </td>
      <td><input type="submit" class="btn btn-success btn-xs"  value="Submit"></td>
       </form>
   </tr>
   <tr>
      <th colspan="2">
          <div id="img_up">
               <img id="blah_userImage"  width="100">
            </div>
            <div id='img_upload'> </div>
      </th>
      
   </tr>
</table>
                 
               </div>
            </div>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="save" class="btn btn-primary" data-dismiss="modal" type="button">Save</button>
            <!-- <button type="submit" class="btn btn-success">Save changes</button> -->
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-lg-edit">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Update Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">

               <div class="col-lg-12" id="edit_id_card_">
                          
                 
               </div>
            </div>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="save" class="btn btn-primary" data-dismiss="modal" onclick="update_data_id_card()" type="button">Save</button>
            <!-- <button type="submit" class="btn btn-success">Save changes</button> -->
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
 

     $('#modal-lg-upload-image').on('hidden', function(){
    $('#blah_userImage').html('')
});
    function id_card_pending()
    {
           var spinner=document.getElementById("ajax-loader");
      spinner.style.display='block';
     var code=257;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
      spinner.style.display='none';
                document.getElementById("d_card_record").innerHTML=response;
                
              }
           });

    }

    function id_card_printed()
    {
           var spinner=document.getElementById("ajax-loader");
      spinner.style.display='block';
     var code=257;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
      spinner.style.display='none';
                document.getElementById("d_card_record").innerHTML=response;
                
              }
           });
    }  
   
 



      function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }
         
   
$(document).ready(function (e) {    // image upload form submit
         $("#image-upload").on('submit',(function(e) {
            e.preventDefault();
            $.ajax({
                  url: "upload_image.php",
               type: "POST",
               data:  new FormData(this),
               contentType: false,
                cache: false,
               processData: false,
               success: function(data)
                {
                  
                  $("#img_up").html(data);
                       show_id_card_record();
                  
                },
              
            });
         }));
       });



  function photo_modal(id) // modal open image upload 
   {
   document.getElementById('student_image').value=id;
   
  
   }

   function photo_modal111(id) // image show passport size
   {
      var spinner=document.getElementById("ajax-loader");
      spinner.style.display='block';
   var code=182;
        $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                
      spinner.style.display='none';
                document.getElementById("img_upload").innerHTML=response;
                
              }
           });
  
   }
 userImage.onchange = evt => {  // image preview
     const [file] = userImage.files
     if (file) {
       blah_userImage.src = URL.createObjectURL(file)
     }
   }
   



   function edit_id_card(id)
   {
     
       var spinner=document.getElementById("ajax-loader");
      spinner.style.display='block';
     var code=179;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {  
      spinner.style.display='none';
                document.getElementById("edit_id_card_").innerHTML=response;
                
              }
           });
   
   
   }

      function show_id_card_record()
   {
      var spinner=document.getElementById("ajax-loader");
      spinner.style.display='block';
     var code=245;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
      spinner.style.display='none';
                document.getElementById("d_card_record").innerHTML=response;
                
              }
           });
   
   
   } 
   function update_data_id_card()
   {  

      var id=document.getElementById("id").value;
      var name=document.getElementById("name").value;
      var father=document.getElementById("father_name").value;
      var batch=document.getElementById("batch").value;
      var college=document.getElementById("college").value;
      var course=document.getElementById("course").value;
      var District=document.getElementById("District").value;
      var address=document.getElementById("address").value;
      var State=document.getElementById("State").value;
      var District=document.getElementById("District").value;
      var route=document.getElementById("route").value;
      var spot=document.getElementById("spot").value;
      var pass_valid=document.getElementById("pass_valid").value;
      var valid=document.getElementById("valid").value;
      var incharge=document.getElementById("incharge").value;
      var Pincode=document.getElementById("Pincode").value;
      var incharge_mobile=document.getElementById("incharge_mobile").value;
      var spinner=document.getElementById("ajax-loader");
      spinner.style.display='block';
         var code=181;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,id:id,name:name,father:father,batch:batch,college:college,course:course,address:address,District:District,State:State,District:District,route:route,spot:spot,pass_valid:pass_valid,incharge:incharge,incharge_mobile:incharge_mobile,valid:valid,Pincode:Pincode
            },
            success: function(response) 
            {
              
                spinner.style.display='none';
              if (response==0)
                   {
                     ErrorToast('ALl Input Required','bg-danger' );
                  }
                  else
                  {
                    show_id_card_record();
                    document.getElementById("edit_id_card__").innerHTML=response;
                   SuccessToast('Successfully ');
                  }
            }
         });
   }

function ID_card()
{

  var id_array=document.getElementsByClassName('sel');
  var len_id= id_array.length;
  var id_array_main=[];
    var code=3;
    for(i=0;i<len_id;i++)
     {
      if(id_array[i].checked===true)
       {
        id_array_main.push(id_array[i].value);
        }
     }
    window.open('print_id_card_pass.php?id_array='+id_array_main+'&code='+code,'_blank');

}


   
</script>
<?php include "footer.php";

?>