<?php 
include "header.php";
include "connection/connection.php";
?>
<p id="ajax-loader"></p>
<script src="plugins/webcam.js/webcam.js"> </script>
<section class="content">
   <div class="container-fluid">


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
                     <input type="hidden" name="code" value='276'>

                  <div class="row">
                 
                   
               <div class="col-lg-10 col-md-10">


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
                      <div class="card-tools">
                      <a class="btn" style="background-color:#223260; color: white; border: 1px solid;" onclick="showVisitors();"> Show </a>
                      <a class="btn" style="background-color:#223260; color: white; border: 1px solid;" onclick="ID_card();bg(this.id);"> Print </a>
                      <a class="btn" style="background-color:#223260; color: white; border: 1px solid;" onclick="showVisitors_mess();"> OnSpot </a>
                      <a class="btn" style="background-color:#223260; color: white; border: 1px solid;" onclick="onspot_ID_card();bg(this.id);"> Print </a>
                  </div>
                  
               </div>
               <div class="card-body" id="checked_out_students"  >
                
<?php


?>

    </tbody>
  </table> 
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


<script type="text/javascript">
                       $(document).ready(function (e) {    // image upload form submit
         $("#submitGateEntry").on('submit',(function(e) {
            e.preventDefault();
                              
           
            // var student_roll_no = document.getElementById("student_roll_no").value;
            var name = document.getElementById("name").value;
            var designation = document.getElementById("designation").value;
            var father_name = document.getElementById("father_name").value;
            var address = document.getElementById("address").value;
            var userImageCaptured = document.getElementById("userImageCaptured").value;
            if(father_name!='' && name!='' && address!='' && designation!='' && userImageCaptured!='')
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
                      console.log(data);

            }
            else
            {
                // alert(userImageCaptured);
                  // showVisitors(student_roll_no);
                      console.log(data);

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

 function showVisitors()
  {
 var spinner=document.getElementById("ajax-loader");
            spinner.style.display='block';
   // alert(id);
        var code=275;
             $.ajax(
                  {
                      url: 'action.php',
                                    type: 'post',
                                    data:{code:code},
                                    success:function(response)
                                    {
            spinner.style.display='none';

                                       // console.log(response);
                                       document.getElementById("checked_out_students").innerHTML=response;
                                    }
                                 });
                           }

    function showVisitors_mess()
  {
 var spinner=document.getElementById("ajax-loader");
            spinner.style.display='block';
   // alert(id);
        var code=277;
             $.ajax(
                  {
                      url: 'action.php',
                                    type: 'post',
                                    data:{code:code},
                                    success:function(response)
                                    {
            spinner.style.display='none';

                                       // console.log(response);
                                       document.getElementById("checked_out_students").innerHTML=response;
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
function onspot_ID_card()
{

  var id_array=document.getElementsByClassName('sel');
  var len_id= id_array.length;
  var id_array_main=[];
    var code=4;
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