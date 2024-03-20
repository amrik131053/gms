<?php 
   include "header.php"; 
  
$tz = 'Asia/Kolkata';   
   date_default_timezone_set($tz);  ?>
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
   <style>
/* * {
  box-sizing: border-box;
} */

.flex-container {
  display: flex;
  flex-direction: row;
  /* font-size: 30px; */
  text-align: left;
}

.flex-item-left {
  /* background-color: #f1f1f1; */
  padding: 10px;
  flex: 80%;
}

.flex-item-right {
  /* background-color: dodgerblue; */
  padding: 10px;
  flex: 20%;
}
.flex-item-right2 {
  /* background-color: dodgerblue; */
  padding: 10px;
  flex: 100%;
}

/* Responsive layout - makes a one column-layout instead of two-column layout */
@media (max-width: 800px) {
  .flex-container {
    flex-direction: column;
  }
}
</style>
    <script src="plugins/webcam.js/webcam.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info " id="myCollapsible">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-1">
                                <h3 class="card-title">Search</h3>
                            </div>
                            <div class="col-lg-11">
                                <div class="card-tools">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="userId"
                                                    placeholder="Employee ID / Roll Number"
                                                    aria-describedby="button-addon2">
                                                <button class="btn btn-info btn-sm" type="button" id="button-addon2"
                                                    onclick="searchUser()"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">

                                        </div>
                                      
                                      
                                        <div class="col-lg-5">
                                           
                                                <div class="input-group input-group-sm">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-danger"
                                                            id="inputGroup-sizing-sm">Location</span>
                                                    </div>
                                                    <select class="form-control" id="systemNumberSearch">
                                                                <?php 
                                                $getLOcation="SELECT * FROM  building_master";
                                                $getLOcationRun=mysqli_query($conn,$getLOcation);
                                                while ($row=mysqli_fetch_array($getLOcationRun)) {
                                                                ?>
                                                                <option value="<?=$row['ID'];?>"><?=$row['Name'];?></option>
                                                                <?php 
                                                }?>
                                                            </select>
                                                    &nbsp;
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-success"
                                                            id="inputGroup-sizing-sm">Date</span>
                                                    </div>
                                                    <input  type="date" class="form-control"
                                                        id="dateSearch" aria-describedby="button-addon2">
                                                    <button class="btn btn-info btn-sm" type="submit" onclick="searchRecord();"
                                                        id="button-addon2"><i class="fa fa-search"></i></button>
                                                </div>
                                          
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body collapse" id="student_search_record">


                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Guard Locations</h3>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body table-responsive" id="lab_users_data">

                       
                    </div>
                </div>
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
<div class="modal fade" id="EditGuardLocation" tabindex="-1" role="dialog"
    aria-labelledby="EditGuardLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditGuardLocationLabel">View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="view_Guard_Location_Modal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?php   $code_access; if ($code_access=='010' || $code_access=='011' || $code_access=='110' || $code_access=='111') 
                                         {?>
                <button type="button" onclick="UpdateLeave();" class="btn btn-success">Update</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
function editLocation(id) {
var code = 383;
var systemNumberE = document.getElementById('systemNumberE').value;
var spinner = document.getElementById('ajax-loader');
spinner.style.display = 'block';
$.ajax({
    url: 'action_g.php',
    type: 'POST',
    data: {
        code: code,
        id: id,
        systemNumber:systemNumberE
    },
    success: function(response) {
        if(response==1)
        {
            labUsers();
        }
       
        // $('#view_Guard_Location_Modal').modal().hide();
        $('#view_Guard_Location_Modal').modal('hide');


        spinner.style.display = 'none';
    }
});

}
function editGuardLocation(id) {
var code = 382;
var spinner = document.getElementById('ajax-loader');
spinner.style.display = 'block';
$.ajax({
    url: 'action_g.php',
    type: 'POST',
    data: {
        code: code,
        id: id
    },
    success: function(response) {
        // console.log(response);
        spinner.style.display = 'none';
        document.getElementById("view_Guard_Location_Modal").innerHTML = response;
    }
});

}
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
    labUsers();
function labUsers() {
    var code_access = '<?php echo $code_access; ?>';
    var code = '381';
    $.ajax({
        url: 'action_g.php',
        data: {
            code: code,code_access:code_access
        },
        type: 'POST',
        success: function(data) {
            document.getElementById("lab_users_data").innerHTML = data;
            $('#example').DataTable({
                "destroy": true, //use for reinitialize datatable
            });
        }
    });
}

function searchUser() {
    var userId = document.getElementById('userId').value;
    // alert(userId);
    var code = '379';
    $.ajax({
        url: 'action_g.php',
        data: {
            code: code,
            userId: userId
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {
                document.getElementById('student_search_record').innerHTML = data;
                $("#student_search_record").collapse('show');
            }
        }
    });
}
function searchRecord() {
    var systemNumberSearch = document.getElementById('systemNumberSearch').value;
    var dateSearch = document.getElementById('dateSearch').value;
    if(dateSearch!='' && systemNumberSearch!='')
    {

    var code = '384';
    $.ajax({
        url: 'action_g.php',
        data: {
            code: code,
            systemNumberSearch: systemNumberSearch,
            dateSearch:dateSearch
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {
                document.getElementById('student_search_record').innerHTML = data;
                $("#student_search_record").collapse('show');
            }
        }
    });
}
else{
    ErrorToast('All input Required','bg-warning');
}
}


</script>
<?php 
   include "footer.php"; 
   ?>