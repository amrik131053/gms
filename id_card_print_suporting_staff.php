<?php 
   include "header.php";   
   ?>
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
   <style type="text/css">
     .arrow-1 {
  width:100px;
  height:30px;
  display: flex;
}
.arrow-1:before {
  content: "";
  background: currentColor;
  width:15px;
  clip-path: polygon(0 10px,calc(100% - 15px) 10px,calc(100% - 15px) 0,100% 50%,calc(100% - 15px) 100%,calc(100% - 15px) calc(100% - 10px),0 calc(100% - 10px));
  animation: a1 1.5s infinite linear;
}
@keyframes a1 {
  90%,100%{flex-grow: 1}
}

   </style>
    <script src="plugins/webcam.js/webcam.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
   <script>

      $(document).ready(function()
      {
         $(document).on('keydown', '.personmeet', function() 
         {
            $("#personmeet").autocomplete(
            {
               source: function( request, response ) 
               {
                  $.ajax(
                  {
                     url: "action.php",
                     type: 'post',
                     dataType: "json",
                     data: 
                     {
                        search: request.term,code:145
                     },
                     success: function( data ) 
                     {
                        response( data );
                     }
                  });
               },
               select: function (event, ui) 
               {
                  $(this).val(ui.item.label); // display the selected text
                  var userid = ui.item.value; // selected value
                  document.getElementById('personmeet_id').value = ui.item.value;
                  document.getElementById('designation').value = ui.item.designation;
                  document.getElementById('department').value = ui.item.department;
                  document.getElementById('empMobile').value = ui.item.mobile;
                  return false;
               }
            });
         });
      });

   function student_search()
   {
      var code=271;
      var rollNo= document.getElementById("student_roll_no").value;
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
               code:code,rollNo:rollNo
            },
            success:function(response) 
            {
               spinner.style.display='none';
               showVisitors(rollNo);
               document.getElementById("student_search_record").innerHTML =response;
               // document.getElementById("live_data").innerHTML =response;
            }
         });
      }
      else
      {
         ErrorToast('Please Enter the IDNo.','bg-warning');
      }
   }  

</script>
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    // $('.filter-container').filterizr({gutterPixels: 3});
    // $('.btn[data-filter]').on('click', function() {
    //   $('.btn[data-filter]').removeClass('active');
    //   $(this).addClass('active');
    // });
  })
</script>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12" >
            
                  
              
            <div class="card card-info collapsed-card" >
               <div class="card-header">
                  <h3 class="card-title">Supporting Staff</h3>
                  <div class="card-tools">
                     <button type="button"
                          class="btn btn-outline-light btn-sm"
                          data-card-widget="collapse"
                          data-toggle="tooltip"
                          title="Collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  </div>
               </div>
              
               <!-- /.card-header -->
               <div class="card-body " >
                   <form id="submitGateEntry" action="action.php" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="code" value='272'>
                  <div class="row">
                 
                   
               <div class="col-lg-10 col-md-10">


                  <div class="row" >
                     <div class="col-lg-3 col-md-3">
                        <label>IDNo</label>
                         <div class="btn-group input-group-md  ">
                                 <input type="text" name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Enter IDNo " aria-describedby="button-addon2" value="">
                              <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="student_search();" name="search"><i class="fa fa-search"></i></button>
                           </div>
                     </div>      
               </div>
<div class="row" id="student_search_record">
    <div class="col-lg-3 col-md-3">
   <label>Name</label>
<input type="text" class="form-control"  name="name" id="name">
</div>
 <div class="col-lg-3 col-md-3">
   <label>Father Name</label>
<input type="text" class="form-control"  name="father_name" id="father_name">
</div>
<div class="col-lg-3 col-md-3">
   <label>Designation</label>
<input type="text" class="form-control"  name="designation" id="designation">
</div>
 <div class="col-lg-3 col-md-3">
   <label>Address</label>
<input type="text" class="form-control"  name="address" id="address">
</div>
</div>

       



            </div>
            <div class="col-lg-2 col-md-2" >
               <input type='hidden' name='userImageCaptured' id='userImageCaptured'  class='image-tag form-control'>
               <div class="col-lg-12 col-md-12" data-target='#modal-default'  data-toggle='modal' id='image_captured'>
                  <img src="dummy-user.png" width="100%" height="130px" >

                           
               </div>
               <br>
               <br>
               <!-- <label>&nbsp;</label> -->
               <div class="col-lg-12 col-md-12">
                  <input type="submit" name="entrybtn" id="entrybtn" class="btn form-control btn-info ">
               </div>
            </div>
      </div>
                  </form>

               </div>
            </div>
         </div>
         
         <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title"><strong>Date: </strong> <?php echo date('d-M-Y'); ?>
                     <!-- <strong>Time: </strong> <span id="timestamp"></span> -->
                  </h3>
               </div>
               <div class="card-body" id="checked_out_students"  >
                  <div id="live_data" class="table table-striped table-responsive">
                     
                  </div>
               
               </div>
               
               <!-- /.card-footer -->
            </div>
            <!-- /.card -->
         </div>
      </div>
   </div>
</section>


<div class="modal fade" id="modal-default">
   <div class="modal-dialog modal-lg ">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Capture Image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <table class="table table-responsive  " border="1">
               <tr style="background-color: #223260; color: white;">
                  <th colspan="2">
                     <center>Capture Image</center>
                  </th>
               </tr>
               <tr>
                  <form id="image-upload" action="action.php" method="post" enctype="multipart/form-data">
                     <td>
                        <input type="hidden" name="userImage" class="image-tag">
                        <div id="my_camera"></div>
                     </td>
                     <td>
                        <div id="results">
                     <img src="dummy-user.png" width="280px" height="320px">
                        
                     </div><br>
                     </td>
                     
                  </form>
               </tr>
               
            </table>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success btn-xs" type=button data-dismiss="modal" value="Take Snapshot" onClick="take_snapshot()">Capture</button>
         </div>
      </div>
   </div>
</div>



<p id="ajax-loader"></p>
<script type="text/javascript">

 
                           function ShowHideDiv() {
                               var ddlPassport = document.getElementById("pord");
                               var dvPassport = document.getElementById("dvPassport");
                               var personmeet = document.getElementById("personmeet");

                               // var response_d = document.getElementById("response_d");
                               dvPassport.style.display = ddlPassport.value == "Department" ? "block" : "none";
                               if (ddlPassport.value == "Person" ) 
                               {
                                 personmeet.removeAttribute("disabled");
                               }
                               else
                               {
                                 personmeet.setAttribute("disabled", "");
                               }
                              
                           
                             }
                        </script>
                        <script>
                           $(function() {
                            $("#pord").change(function(e) {
                              e.preventDefault();
                              document.getElementById('personmeet').value = "";
                              document.getElementById('personmeet_id').value = "";
                              document.getElementById('department').value = "";
                               document.getElementById('designation').value = "";
                               document.getElementById('empMobile').value = "";
                               document.getElementById('dep').value = "";
                            });
                           });
                        </script>
                        <script>
                           $(function() {
                            $("#dep").change(function(e) {
                              e.preventDefault();
                           
                              var college = $("#dep").val();
                              var code ="146";
                              // AJAX
                              $.ajax({
                                url: 'action.php',
                                type: 'post',
                                data:{college:college,code:code},
                                dataType: 'json',
                                success:function(response){
                                var len = response.length;
                                // console.log(response);
                                if(len > 0)
                                {
                                    // Set value to textboxes  personmeet
                                    document.getElementById('personmeet').value = response[0]['name'];
                                    document.getElementById('personmeet_id').value = response[0]['id'];
                                    document.getElementById('designation').value =  response[0]['designation'];
                                    document.getElementById('department').value = response[0]['department'];
                                    document.getElementById('empMobile').value = response[0]['mobile'];
                                 }
                              }
                              });
                              return false;
                           });
                           });
                        </script>
                        <script type="text/javascript">

                            $(document).ready(function (e) {    // image upload form submit
         $("#submitGateEntry").on('submit',(function(e) {
            e.preventDefault();
                              
           
            var student_roll_no = document.getElementById("student_roll_no").value;
            var name = document.getElementById("name").value;
            var designation = document.getElementById("designation").value;
            var father_name = document.getElementById("father_name").value;
            var address = document.getElementById("address").value;
            var userImageCaptured = document.getElementById("userImageCaptured").value;
            if(father_name!='' && name!='' && address!='' && designation!='')
            {
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
                     spinner.style.display='none';
            if (data==1) 
            {

            }
            else
            {
                  showVisitors(student_roll_no);
                      

                  SuccessToast('Successfully Inserted');
            document.getElementById("userImageCaptured").value="";
             document.getElementById('image_captured').innerHTML = ' <img src="dummy-user.png" width="100%" height="130px">';
            document.getElementById("name").value='';
            document.getElementById("designation").value='';
            document.getElementById("father_name").value='';
            document.getElementById("address").value='';

            }
    
                },
               error: function(data)
               {
                 
               }
            });
         }
         else{
            ErrorToast('Enter All Required','bg-warning');
         }
         }));
       }); 
                            Webcam.set({
        width: 140*2,
        height: 160*2,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.set('constraints',{
        facingMode: "environment"
    });
  
    Webcam.attach( '#my_camera' );

                            function take_snapshot() {

        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = "<img src='"+data_uri+"'>";
            document.getElementById("userImageCaptured").value=data_uri;
                        
            document.getElementById('image_captured').innerHTML = "<img src='"+data_uri+"' width='100%' >";
        } );
    }

                           // window.onload = function() {
                           //    showVisitors('');
                           // };

                       

                           function showVisitors(id)
                           {

                              // alert(id);
                              var code=259;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code,id:id},
                                    success:function(response)
                                    {

                                       // console.log(response);
                                       document.getElementById("live_data").innerHTML=response;
                                    }
                                 });
                           }


                     
                        </script>
                    
<?php include "footer.php";  ?>