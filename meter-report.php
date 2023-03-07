<?php 

  include "header.php";
  // $array[]=''; 
 $permissionCount=0;
$permission_qry="SELECT * FROM category_permissions where employee_id='$EmployeeID' and is_admin='1'";
$permission_res=mysqli_query($conn,$permission_qry);
while($permission_data=mysqli_fetch_array($permission_res))
{
   $permissionCount++;
}
  
?>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="html5-qrcode.min.js"></script>
<style type="text/css">
  
.my
   {
   background-color: #a62535;
   color: #fc3;
   }
   input[type=radio] + label {
   background-color: #a62535;
   color: #fc3;
   } 
   input[type=radio]:checked + label {
   color: #fc3;
   background-color:#223260;
   } 
</style>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-lg-12 col-md-12 col-sm-3" >
            <div class="card card-info" >
               <div class="card-header" style="background-color: #223260;">
                  <div class="row">
                     <div class="col-lg-1">
                        <h3 class="card-title">Reports</h3>
                     </div>
                     <div class="col-lg-11">
                        <div class="card-tools">
                           <div class="row">
                              
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostel" id='hostel_id' onchange="floorMeter(this.value)"  >
                                       <option value="">Select Building</option>
                                       <?php
                                       $hostelQry="SELECT Distinct building_master.ID as BmId, Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block";
                                       $hostelRes=mysqli_query($conn,$hostelQry);
                                       while($hostelData=mysqli_fetch_array($hostelRes))
                                       {
                                          ?>
                                          <option value="<?=$hostelData['BmId']?>"><?=$hostelData['Name']?></option>
                                          <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostelFloorID" id='hostelFloorID' onchange="meterRoom(0,this.value)" >
                                       <option value="">Select Floor</option>
                                       
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostelRoomID" id='hostelRoomID'  >
                                       <option value="">Select Room No.</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="search_meter_at_location()" >Search</button>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="exportMeterLocations('0')" >Export All</button>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="input-group mb-3 input-group-sm">
                          <button class="btn  btn-outline-light btn-sm"  data-toggle="modal" onclick="scanMeter()" data-target="#meter_modal" type="button" id="button-addon2"><i class="fa fa-qrcode"></i></button>
                                     <input type="text" class="form-control" id='meterNo' placeholder="Meter No..." aria-describedby="button-addon2">
                          <button class="btn  btn-info btn-sm" type="button" id="button-addon2"  onclick="meterReport(0)" ><i class="fa fa-search"></i></button>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <!-- <button type="submit" class="btn btn-outline-warning btn-sm form-control"  onclick="exportData()">Export</button> -->
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                 </div>
                              </div>

                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
                  <div class="card-body" >
                     <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="meterReportData"></div>
                     </div>

                  </div>
            </div>
         </div>
      </div>
   </div>
   <p id="ajax-loader"></p>
   <div class="modal fade" id="meter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLabel">Update </h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
             <div id="" style="text-align: center;">
               <h5>QR Scan</h5>  
    
    <video id="preview" width="100%" height="300px"></video>
    
     
   
      <script type="text/javascript">
      function scanMeter() 
      {
      
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod:2, mirror: false });
      scanner.addListener('scan', function (content) {
       // alert(content);
       $('#meter_modal').modal('hide');
       meterReport(content);
        

});
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[1]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    }
    </script>
     
             </div>    
      </div>
   </div>
</div> 
<div class="modal fade" id="meter_reading_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Meter Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="meter_data">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="update_meter_reading_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Meter Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="update_meter_data">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

   <script type="text/javascript">
      function exportData(meterNo) 
      {
            var exportCode='14';
          window.location.href="export.php?meterNo="+meterNo+"&exportCode="+exportCode;
      }

      function exportMeterLocations(building)
      {
            var exportCode='15';
            var floor=document.getElementById("hostelFloorID").value;
            var room=document.getElementById("hostelRoomID").value;
          window.location.href="export.php?building="+building+"&exportCode="+exportCode+"&floor="+floor+"&room="+room;
      }

      function updateMeterReading(id,articleNum) 
      {
         var code=108;
         $.ajax(
         {

            url:'action.php',
            data:{code:code,id:id,articleNum:articleNum},
            type:'POST',
            success:function(data)
            {
                $("#update_meter_data").html("");
                $("#update_meter_data").html(data);
            }
         });

      }

      function updateReading(id,articleNum)
      {
         var code=107;
         var reading=document.getElementById("reading").value;
         // var unitRate=document.getElementById("unitRate").value;
          // alert(unitRate);
         $.ajax(
         {

            url:'action.php',
            data:{code:code,id:id,reading:reading,articleNum:articleNum},
            type:'POST',
            success:function(data)
            {
               console.log(data);
               if ($('#meter_reading_modal').is(':visible'))
               {
                  meterReadings(articleNum);
                  search_meter_at_location();
               }
               else
               {
                  meterReport(articleNum);
               }
                $('#update_meter_reading_modal').modal('hide');

            }
         });
      }
      function meterReadings(meterNo)
      {
         
         if (meterNo==0) 
         {
            meterNo=document.getElementById("meterNo").value;
         }
         if (meterNo!='') 
         {
            var code=106;
             $.ajax(
             {
               url:'action.php',
               data:{code:code,meterNo:meterNo},
               type:'POST',
               success:function(data)
               {
                  if(data != "")
                  {
                     $("#meter_data").html("");
                     $("#meter_data").html(data);
                  }
               }
            
            });  
         }
      }
      function meterReport(meterNo)
      {
         
         if (meterNo==0) 
         {
            meterNo=document.getElementById("meterNo").value;
         }
         if (meterNo!='') 
         {
            var code=106;
             $.ajax(
             {
               url:'action.php',
               data:{code:code,meterNo:meterNo},
               type:'POST',
               success:function(data)
               {
                  if(data != "")
                  {
                     $("#meterReportData").html("");
                     $("#meterReportData").html(data);
                  }
               }
            
            });  
         }
      }
      
    
      
      function floorMeter(id)
      {  var floor='';
         meterRoom(id,floor);
         var code='103';
         $.ajax({
         url:'action.php',
         data:{code:code,building:id},
         type:'POST',
         success:function(data){
         if(data != "")
         {
         $("#hostelFloorID").html("");
         $("#hostelFloorID").html(data);
         }
         }
         });
      } 
      function meterRoom(id,floor)
      {
         if (id==0) 
         {
            id=document.getElementById("hostel_id").value;
         }
         var code='104';
         $.ajax({
         url:'action.php',
         data:{code:code,building:id,floor:floor},
         type:'POST',
         success:function(data){
         if(data != "")
         {
         $("#hostelRoomID").html("");
         $("#hostelRoomID").html(data);
         }
         }
         });
      }
      function search_meter_at_location()
      {
         
         var code='105';
         var building=document.getElementById("hostel_id").value;
         if (building!='') 
         {
         var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
            var floor=document.getElementById("hostelFloorID").value;
            var room=document.getElementById("hostelRoomID").value;
            // alert(building);
            // alert(floor);
            // alert(room);
            $.ajax({
            url:'action.php',
            data:{code:code,building:building,floor:floor,room:room},
            type:'POST',
            success:function(data){
            if(data != "")
            {
               spinner.style.display='none';
               $("#meterReportData").html("");
               $("#meterReportData").html(data);
            }
            }
            });
         }
         else
         {
            alert("Select Hostel");
         }
      }
      function student_stock(locationID,studentID)
      {
         // alert(studentID);
          var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
         var code='85';
         $.ajax({
         url:'action.php',
         data:{code:code,locationID:locationID,studentID:studentID},
         type:'POST',
         success:function(data){
         if(data != "")
         {
            spinner.style.display='none';
         $("#student_stock_data").html("");
         $("#student_stock_data").html(data);
         }
         }
         });
      }
      function article_at_location(categoryID,locationID)
      {
          var code='86';
         $.ajax({
         url:'action.php',
         data:{code:code,locationID:locationID,categoryID:categoryID},
         type:'POST',
         success:function(data){
         if(data != "")
         {

         $("#articleID").html("");
         $("#articleID").html(data);
         }
         }
         });
      }
      function article_number_at_location(articleID,locationID)
      {
          var code='87';
         $.ajax({
         url:'action.php',
         data:{code:code,locationID:locationID,articleID:articleID},
         type:'POST',
         success:function(data){
         if(data != "")
         {
               
         $("#articleNum").html("");
         $("#articleNum").html(data);
         }
         }
         });
      }
      function assignStudentStock(locationID)
      {
         var code='88';
         var studentID=document.getElementById("studentID").value;
         var articleNum=document.getElementById("articleNum").value;
         if (articleNum!='' && studentID!='') 
         {
            $.ajax(
            {
               url:'action.php',
               data:{code:code,articleNum:articleNum,studentID:studentID},
               type:'POST',
               success:function(data)
               {
                  // $('#student_stock').hide();
                  //$("[data-dismiss=modal]").trigger({ type: "click" });
                  // search_meter_at_location();
                   student_stock(locationID,studentID)
               }
            });
         }
         else
         {
            alert("Select all values");
         }
      }
       function check_out(ID,studentID,locationID)
   {
      // var code=89;
      // alert(code);
      // alert(studentID);
      var code=76;
      var a=confirm("Are you sure to check out" + " " + ID);
      if (a==true) 
      {
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:ID,studentID:studentID
            },
            success:function(response) 
            {
               // returnStudentStock(studentID)
               student_stock(locationID,studentID)
               //alert("success");
               // location.reload(true);
            }
         });
      }
   }

      function returnStudentStock(rollNo)
      {
         code=75;
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
               document.getElementById("return_student_stock_data").innerHTML =response;  
            }
         });
      }
function studentAttendance(studentID)
      {
         code=92;
               $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,studentID:studentID
            },
            success:function(response) 
            {
               document.getElementById("student_attendance_data").innerHTML =response;  
            }
         });
      }


      function hostelAvailability()
      {
         
         var code='95';
         var building=document.getElementById("hostel_id").value;
         if (building!='') 
         {
         var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
            var floor=document.getElementById("hostelFloorID").value;
            var room=document.getElementById("hostelRoomID").value;
            // alert(building);
            // alert(floor);
            // alert(room);
            $.ajax({
            url:'action.php',
            data:{code:code,building:building,floor:floor,room:room},
            type:'POST',
            success:function(data){
            if(data != "")
            {
               spinner.style.display='none';
               $("#meterReportData").html("");
               $("#meterReportData").html(data);
            }
            }
            });
         }
         else
         {
            alert("Select Hostel");
         }
      }

   </script>
</section>

<div class="modal fade" id="student_stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content" id="student_stock_data" >
         
      </div>
   </div>
</div>
<div class="modal fade" id="return_student_stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Return Stock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
            <!-- <input type="hidden" name="code" value="88"> -->
            <div class="modal-body" id="return_student_stock_data">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" onclick="assignStudentStock()" class="btn btn-primary">Save</button>
            </div>
      </div>
   </div>
</div>
<div class="modal fade" id="student_attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content" id="student_attendance_data" >
         
      </div>
   </div>
</div>
<div class="modal fade" id="view_assign_stock_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Stock Assigned Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="">
            <div class="modal-body" id="view_assign">
               ...
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!--  <button type="submit" class="btn btn-primary">Save</button> -->
            </div>
         </form>
      </div>
   </div>
</div>

<?php include "footer.php"; 
?>