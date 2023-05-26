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
            <form id="eligibility_upload" action="action.php" method="post" enctype="multipart/form-data">
            <div class="card-header ">
               <h3 class="card-title">Eligibility</h3>
               <button type="button" class="btn btn-success btn-xs" style="float: right;">
             <a href="formats/eligibility.csv" style="color:white;"> Format</a>
               </button> 
            </div>
            <div class="card-body">
               <div class="form-group row ">
                &nbsp;&nbsp;  <label style="color:#A62535;">For Eligible:&nbsp;1 &nbsp; For Not Eligible:0</label>
                  <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">File</label>
                  <div class="col-lg-12">
                     <input type="hidden" name="code" value="184">
                      <input type="hidden" name="code_access" value="<?=$code_access;?>">
                     <input type="file" name="file_exl" class="form-control">
                  </div>
               </div>
            </div>
            <div class="card-footer">
                <?php  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
            ?>
               <button type="submit" class="btn btn-info">Submit</button>
            <?php }?>
            </div>
         </form>
            <p id="error" style="display: none;"></p>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
         <div class="card card-info">
            <form id="university_upload" action="action.php" method="post" enctype="multipart/form-data">
            <div class="card-header ">
               <h3 class="card-title">University RollNo </h3>
                <button type="button" class="btn btn-success btn-xs" style="float: right;">
             <a href="formats/university.csv" style="color:white;"> Format</a>
               </button>
            </div>
             <div class="card-body">
               <div class="form-group row">
                  <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">File</label>
                  <div class="col-lg-12">
               
                    <input type="hidden" name="code" value="183">
                    <input type="hidden" name="code_access" value="<?=$code_access;?>">
                     <input type="file" name="file_exl" class="form-control">
                  </div>
               </div>
            </div>
             <div class="card-footer">
                <?php  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
            ?>
               <button type="submit" class="btn btn-info">Submit</button>
            <?php }?>

            </div>
            </form>
            <!-- /.card-footer -->
         </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3">
         <div class="card card-info">
              <form id="abc_upload" action="action.php" method="post" enctype="multipart/form-data">
            <div class="card-header ">
               <h3 class="card-title">ABC ID</h3>
              <button type="button" class="btn btn-success btn-xs" style="float: right;">
             <a href="formats/abc_id.csv" style="color:white;"> Format</a>
               </button>
            </div>
            <div class="card-body">
               <div class="form-group row">
                  <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">File</label>
                  <div class="col-lg-12">
                     <input type="file" name="file_exl" class="form-control">
                     <input type="hidden" name="code_access" value="<?=$code_access;?>">
                     <input type="hidden" name="code" value="186">
                  </div>
               </div>
            </div>
            <div class="card-footer">
                <?php  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
            ?>
               <button type="submit" class="btn btn-info" >Submit</button>
            <?php }?>
            </div>
         </form>
            <p id="error" style="display: none;"></p>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
         <div class="card card-info">
             <form id="registration_upload" action="action.php" method="post" enctype="multipart/form-data">
            <div class="card-header ">
               <h3 class="card-title">Registration Number </h3>
                <button type="button" class="btn btn-success btn-xs" style="float: right;">
             <a href="formats/Registration.csv" style="color:white;"> Format</a>
               </button>
            </div> 
             <div class="card-body">
               <div class="form-group row">
                  <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">File</label>
                  <div class="col-lg-12">
                     <input type="hidden" name="code" value="185">
                     <input type="hidden" name="code_access" value="<?=$code_access;?>">
                     <input type="file" name="file_exl" class="form-control">
                  </div>
               </div>
            </div>
 <style>
    .my
    {
 background-color: #fff;
  color: #fc3;
    }

    input[type=radio] + label {
      background-color: #fff;
  color: #000;
  } 
input[type=radio]:checked + label {
  color: #002147;
  background-color:#fc3;
  
} 
  </style>
             <div class="card-footer">
                <?php  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
            ?>
               <button type="submit" class="btn btn-info">Submit</button>
            <?php }?>
            </div>
         </form>
            <!-- /.card-footer -->
         </div>
      </div>
         <div class="col-lg-4 col-md-4 col-sm-3" >
         <div class="card card-info">
            <div class="card-header " >
               <!-- <h3 class="card-title">Eligibility</h3> -->
              <!--  <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal" style="float: right;">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </button> -->
                <div class="btn-group input-group-sm" style="text-align:center;">
                       <input type="radio"  id="ossm" class="ossm" value='1' name="option" hidden="" required="" checked="">  


                       <label for="ossm" class="btn btn-xs">Class RollNo</label>


                       <input type="radio"   id="ossm1" class="ossm1" name="option" value='2' hidden="" required="">  <label for="ossm1" class="btn  btn-xs">Uni RollNo</label>

                       <input type="radio"   id="ossm2" name="option" value='3' hidden="" required="">  <label for="ossm2" class="btn  btn-xs">ID No</label>

                     </div>
                     <br>
                        <div class="btn-group input-group-sm">
                  <input type="text" name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Uni/Class Roll No." aria-describedby="button-addon2" value="">

                                  <?php  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
            ?>
                              <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="student_search();" name="search"><i class="fa fa-search"></i></button>
                           <?php }?>



                           </div>
            </div>
            <div class="card-body" id="student_search_record" style="font-size:12px;">
               
               
            </div>
           
          
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
     
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<div class="modal fade" id="Updatestudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
<div class="modal-dialog modal-md   " role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id='student_record_for_update' style="text-align:center">
          
 </div>

</div>
</div>
<script type="text/javascript">
 
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}


















      $(document).ready(function (e) {    // image upload form submit
           $("#university_upload").on('submit',(function(e) {
              e.preventDefault();
              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "action.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
                     //console.log(data);
                         
                          spinner.style.display='none';
                          if (data==1) {
                           SuccessToast('Successfully Uploaded');
                           document.getElementById('file_exl').value='';
                          }
                          else
                          {
                           ErrorToast('Invalid CSV File ','bg-danger' );
                          }
                  },
                 
              });
           }));
         }); 

         $(document).ready(function (e) {    // image upload form submit
           $("#eligibility_upload").on('submit',(function(e) {
              e.preventDefault();
              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "action.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
                     //console.log(data);
                         
                          spinner.style.display='none';
                          if (data==1) {
                           SuccessToast('Successfully Uploaded');
                           document.getElementById('file_exl').value='';
                          }
                          else
                          {
                           ErrorToast('Invalid CSV File ','bg-danger' );
                          }
                  },
                 
              });
           }));
         });
         $(document).ready(function (e) {    // image upload form submit
           $("#registration_upload").on('submit',(function(e) {
              e.preventDefault();
              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "action.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
                     //console.log(data);
                         
                          spinner.style.display='none';
                          if (data==1) {
                           SuccessToast('Successfully Uploaded');
                           document.getElementById('file_exl').value='';
                          }
                          else
                          {
                           ErrorToast('Invalid CSV File ','bg-danger' );
                          }
                  },
                 
              });
           }));
         });     $(document).ready(function (e) {    // image upload form submit
           $("#abc_upload").on('submit',(function(e) {
              e.preventDefault();
              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "action.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
                     //console.log(data);
                         
                          spinner.style.display='none';
                          if (data==1) {
                           SuccessToast('Successfully Uploaded');
                           document.getElementById('file_exl').value='';
                          }
                          else
                          {
                           ErrorToast('Invalid CSV File ','bg-danger' );
                          }
                  },
                 
              });
           }));
         });



   function student_search()
   {
     
      var code=187;
      var code_access = '<?php echo $code_access; ?>';
      var rollNo= document.getElementById("student_roll_no").value;
         var option = $("input[type=radio][name=option]:checked").val();
       
      

      if (rollNo!='') 
      {
          var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,rollNo:rollNo,option:option,code_access:code_access
            },
            success:function(response) 
            {
               spinner.style.display='none';
               document.getElementById("student_search_record").innerHTML =response;
            }
         });
      }
      else
      {
         // alert("Please Enter the Roll No.");
         document.getElementById("student_search_record").innerHTML ='';
      }
   } 



   function StudentUpdatedata(id)
   {
      
      var code=219;
          
   var  spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,IDNo:id
            },
            success:function(response) 
            {
               
               spinner.style.display='none';
               document.getElementById("student_record_for_update").innerHTML =response;
            }
         });
      }
      

 function updateStudentdata(id)
 {

   var  batch = document.getElementById('ubatch').value;
   var  status = document.getElementById('ustatus').value;
   var  lock = document.getElementById('ulocked').value;
   var  classroll = document.getElementById('classroll').value;
    var uniroll = document.getElementById('uniroll').value;
   var code=220;   
   alert(uniroll);
   var  spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,batch:batch,status:status,lock:lock,id:id,classroll:classroll,uniroll:uniroll
            },
            success:function(response) 
            {
             
               spinner.style.display='none';
                if (response==1) {
                           SuccessToast('Successfully Updated');
                           
                          }
                          else
                          {
                           ErrorToast('Something went worng','bg-danger' );
                          }
              student_search();
            }
         });
 }
   
function passwordreset(id)
 {
   
if (confirm("Really want to Reset Password") == true) {
 

   var code=231;   
   var  spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id
            },
            success:function(response) 
            {
             
               spinner.style.display='none';
                if (response==1) {
                           SuccessToast('Password Reset to 12345678');
                           
                          }
                          else
                          {
                           ErrorToast('Something went worng','bg-danger' );
                          }
              student_search();
            }
         });
 }
 else 

{
  
}
  
}

function abcidreset(id)
 {
   if (confirm("Really want to Reset ABCID") == true) {
 
   var code=232;   
   var  spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id
            },
            success:function(response) 
            {
             
               spinner.style.display='none';
                if (response==1) {
                           SuccessToast('ABCID Cleared');
                           
                          }
                          else
                          {
                           ErrorToast('Something went worng','bg-danger' );
                          }
              student_search();
            }
         });
 }


}




</script>



















<?php include "footer.php";  ?>