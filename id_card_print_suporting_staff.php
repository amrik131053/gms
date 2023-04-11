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
      var code=258;
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
                     <input type="hidden" name="code" value='147'>
                  <div class="row">
                 
                   
               <div class="col-lg-10 col-md-10">


                  <div class="row"  id="">
                     <div class="col-lg-3 col-md-3">
                        <label>ID No</label>
                       <input type="text" id="student_roll_no" class="form-control" onchange="student_search();">
                     </div> 
                    
                     
                        
                         <div class="col-lg-3 col-md-3">
                        <label>Want to meet with <span style="color: red">*</span></label>
                        <input type="text"  name="personmeet" id="personmeet" disabled class="form-control personmeet">
                        <input type="hidden" name="personmeet_id" id="personmeet_id" class="form-control" value="">
                        </div>
                         <div class="col-lg-3 col-md-3">
                           <label>Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control" value="" disabled="">
                        </div>
                         <div class="col-lg-3 col-md-3">
                           <label>Department</label>
                        <input type="text" name="department" id="department" class="form-control" value="" disabled="">
                        </div>
                        <div class="col-lg-3 col-md-3">
                           <label>Employee Mobile</label>
                        <input type="text" name="empMobile" id="empMobile" class="form-control" value="" disabled="">
                        </div>
                         <div class="col-lg-3 col-md-3">
                        <label>Name <span style="color: red">*</span></label>
                        <input type="text" name="name" id="name" class="form-control">
                     </div>
                      <div class="col-lg-3 col-md-3">
                        <label>Mobile No. <span style="color: red">*</span></label>
                        <input type="text" name="mob" id="mob" class="form-control">
                     </div>
                      <div class="col-lg-3 col-md-3">
                        <label>Vehicle Registration No. <span style="color: red"></span></label>
                        <input type="text" name="vehicle" id="vehicle" class="form-control">
                     </div>
                      <div class="col-lg-3 col-md-3">
                        <label>ID Proof <span style="color: red">*</span></label>
                        <!-- <input type="text" name="proof" id="proof" class="form-control"> -->
                        <select class="form-control"  name="proof" id="proof" >
                        <option value="">Select</option>
                        <option value="Adhaar card">Adhaar Card</option>
                        <option value="Pan card">Pan Card</option>
                        <option value="Voter Card">Voter Card</option>
                        <option value="other">Other</option>
                        </select>
                     </div>
                      <div class="col-lg-3 col-md-3">
                        <label>ID Proof Number <span style="color: red">*</span></label>
                        <input type="text" name="id_proof_no" id="id_proof_no" class="form-control">
                     </div> 
                     <div class="col-lg-3 col-md-3">
                        <label>Purpose <span style="color: red">*</span></label>
                        <input type="text" name="purpose" id="purpose" class="form-control">
                     </div> 
                     <div class="col-lg-3 col-md-3">
                        <label> Visitor Pass No <span style="color: red">*</span></label>
                        <!-- <input type="text" name="passno" id="passno" class="form-control passno"><br/> -->
                        <select class="form-control"  name="passno" id="passno"  >
                           <!-- <optgroup label="Pass Number"> -->
                              
                           <option value="">Select</option>
                           <?php 
                              $gatePassQry="SELECT distinct gate_entry_qr.id as passId from gate_entry_qr inner join gate_entry_visitor on gate_entry_visitor.gate_pass_no=gate_entry_qr.id where gate_entry_visitor.status!='0'";
                              $gatePassRes=mysqli_query($conn,$gatePassQry);
                              while($gatePassData=mysqli_fetch_array($gatePassRes))
                              {
                                 $gatePassCheckQry="SELECT * from gate_entry_visitor where status='0' and gate_pass_no=".$gatePassData['passId'];
                                 $gatePassCheckRes=mysqli_query($conn,$gatePassCheckQry);
                                 if (mysqli_num_rows($gatePassCheckRes)<1) 
                                 {
                                 ?>
                                    <option value="<?=$gatePassData['passId']?>"><?=$gatePassData['passId']?></option>
                                 <?php
                                 }
                              }
                           ?>
                           <!-- </optgroup> -->

                        </select>
                     </div>
               </div>


       



            </div>
            <div class="col-lg-2 col-md-2" >
               <input type='hidden' name='userImageCaptured' id='userImageCaptured'  class='image-tag form-control'>
               <div class="col-lg-12 col-md-12" data-target='#modal-default'  data-toggle='modal' id='image_captured'>
                  <img src="dummy-user.png" width="100%" height="130px">

                           
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
                  <div id="live_data">
                     
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
            <table class="table " border="1">
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
                     <td><div id="results">
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

<div class="modal fade" id="check-out-modal">
   <div class="modal-dialog modal-lg ">
      <div class="modal-content" id="check-out-modal-data">

      </div>
   </div>
</div>

<p id="ajax-loader"></p>
<script type="text/javascript">
   function checkoutModal(visitorId) 
   {
      // alert(visitorId);
      var code=150;
      $.ajax(
      {
         url: 'action.php',
         type: 'post',
         data:{code:code, visitorId:visitorId},
         success:function(response)
         {
            document.getElementById("check-out-modal-data").innerHTML=response; 

            showVisitors();
         }
      });
   }
 
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
            var personmeet_id = document.getElementById("personmeet_id").value;
            var name = document.getElementById("name").value;
            var mob = document.getElementById("mob").value;
            var vehicle = document.getElementById("vehicle").value;
            var proof = document.getElementById("proof").value;
            var id_proof_no = document.getElementById("id_proof_no").value;
            var purpose = document.getElementById("purpose").value;
            var passno = document.getElementById("passno").value;
            var userImageCaptured = document.getElementById("userImageCaptured").value;
            if(personmeet_id!='' && name!='' && mob!='' && vehicle!='' && proof!='' && id_proof_no!='' && purpose!='' && passno!='' && userImageCaptured!='')
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
                  showVisitors();
                     spinner.style.display='none';
                     location.reload(true);
    
                },
               error: function(data)
               {
                 
               }
            });
         }
         else{
            alert('Enter All');
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

                           window.onload = function() {
                              showVisitors();
                           };

                           function checkOutVisitor(id)
                           {
                              var code=149;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code, id:id},
                                    success:function(response)
                                    {
                                       showVisitors();
                                    }
                                 });

                           }

                           function showVisitors()
                           {
                              var code=259;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code},
                                    success:function(response)
                                    {
                                       // console.log(response);
                                       document.getElementById("live_data").innerHTML=response;
                                    }
                                 });
                           }


                           function submitEntry() 
                           {
                              var personmeet_id = document.getElementById("personmeet_id").value;
                              var name = document.getElementById("name").value;
                              var mob = document.getElementById("mob").value;
                              var vehicle = document.getElementById("vehicle").value;
                              var proof = document.getElementById("proof").value;
                              var id_proof_no = document.getElementById("id_proof_no").value;
                              var purpose = document.getElementById("purpose").value;
                              var passno = document.getElementById("passno").value;
                              if(personmeet_id!='' && name!='' && mob!='' && vehicle!='' && proof!='' && id_proof_no!='' && purpose!='' && passno!='')
                              {
                                 var code=147;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{personmeet_id:personmeet_id,name:name,mob:mob,vehicle:vehicle,proof:proof,id_proof_no:id_proof_no,purpose:purpose,passno:passno, code:code},
                                    success:function(response)
                                    {
                                       showVisitors();
                                       location.reload(true);
                                    }
                                 });

                              }
                           }
                        </script>
                    
<script type="text/javascript">

</script>
<?php include "footer.php";  ?>