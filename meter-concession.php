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
                     
                     <div class="col-lg-11">
                        <div class="card-tools">
                           <div class="row">
                              
                           <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostel" id='hostel_id' onchange="floorMeter(this.value)"  >
                                       <option value="">Select Building</option>
                                       <?php
                                     

if ($role_id=='2')
{
                                       $hostelQry="SELECT Distinct building_master.ID as BmId, Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block";
                                       $hostelRes=mysqli_query($conn,$hostelQry);
                                       while($hostelData=mysqli_fetch_array($hostelRes))
                                       {
                                          ?>
                                          <option value="<?=$hostelData['BmId']?>"><?=$hostelData['Name']?></option>
                                          <?php
                                       }
                                    }else
                                       {
                                       $hostelQry="SELECT * FROM building_master inner join hostel_permissions on hostel_permissions.building_master_id=building_master.ID where emp_id='$EmployeeID'";
                                       $hostelRes=mysqli_query($conn,$hostelQry);
                                       while($hostelData=mysqli_fetch_array($hostelRes))
                                       {
                                          ?>
                                          <option value="<?=$hostelData['ID']?>"><?=$hostelData['Name']?></option>
                                          <?php
                                       }
                                    }
                                       ?>
                                    </select>

                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostelFloorID" id='hostelFloorID' onchange="meterRoom(0,this.value)" >
                                       <option value="">Select Floor</option>
                                       
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-1">
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
                              <!-- <div class="col-lg-2">
                                 <div class="input-group-sm">
                                   <input type="text" class="form-control" id="articleNo">
                                 </div>
                              </div> -->
                              <!-- <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="search_meter_at_location()" >Search</button>
                                 </div>
                              </div> -->

                              <div class="col-lg-2">
                                 <div class="input-group mb-3 input-group-sm">
                          <!-- <button class="btn  btn-outline-light btn-sm"  data-toggle="modal" onclick="scanMeter()" data-target="#meter_modal" type="button" id="button-addon2"><i class="fa fa-qrcode"></i></button> -->
                                     <!-- <input type="text" class="form-control" id='meterNo' placeholder="Meter No..." aria-describedby="button-addon2">
                          <button class="btn  btn-info btn-sm" type="button" id="button-addon2"  onclick="meterReport(0)" ><i class="fa fa-search"></i></button> -->
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

   <script type="text/javascript">

function editConcession(id)
          {
      var spinner=document.getElementById("ajax-loader");
       spinner.style.display='block';
           var code='105.3';
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("update_consessions_modal_data").innerHTML=response;
               }
           });
          } 
      function addConcession(id)
      {
         var code='105.2';
         var concession_value=document.getElementById("concession_value"+id).value;
         // alert(concession_value);
         var spinner=document.getElementById("ajax-loader");
                spinner.style.display='block';
            $.ajax({
            url:'action.php',
            data:{code:code,articleNo:id,concession_value:concession_value},
            type:'POST',
            success:function(data)
            {
               if(data==1)
            {
               SuccessToast('Successfully');
               search_meter_at_location();
            }
            else{
               ErrorToast('All Input Required', 'bg-warning');
            }
                console.log(data);
                spinner.style.display='none';
            }
        });
      }
      function editConcessionUpdate()
      {
         var code='105.4';
         var Tid=document.getElementById("Tid").value;
         var id=document.getElementById("Articleid").value;
         var concession_value=document.getElementById("concessionUpdate").value;
         var statusUpdate=document.getElementById("statusUpdate").value;
         var spinner=document.getElementById("ajax-loader");
                spinner.style.display='block';
            $.ajax({
            url:'action.php',
            data:{code:code,articleNo:id,concession_value:concession_value,statusUpdate:statusUpdate,Tid:Tid},
            type:'POST',
            success:function(data)
            {
               if(data==1)
            {
               SuccessToast('Successfully');
               search_meter_at_location();
            }
            else{
               ErrorToast('All Input Required', 'bg-warning');
            }
                console.log(data);
                spinner.style.display='none';
            }
        });
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
         
         var code='105.1';
         var building=document.getElementById("hostel_id").value;
         if (building!='') 
         {
         var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
            var floor=document.getElementById("hostelFloorID").value;
            var room=document.getElementById("hostelRoomID").value;
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
      // function search_meter_at_location()
      // {
         
      //    var code='105.1';
      //    var articleNo=document.getElementById("articleNo").value;
      //    if (articleNo!='') 
      //    {
      //    var spinner=document.getElementById("ajax-loader");
      //           spinner.style.display='block';
      //       $.ajax({
      //       url:'action.php',
      //       data:{code:code,articleNo:articleNo},
      //       type:'POST',
      //       success:function(data){
      //       if(data != "")
      //       {
      //          spinner.style.display='none';
      //          $("#meterReportData").html("");
      //          $("#meterReportData").html(data);
      //       }
      //       }
      //       });
      //    }
      //    else
      //    {
      //       alert("Select Hostel");
      //    }
      // }
   
   </script>
</section>

<div class="modal fade" id="student_stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content" id="student_stock_data" >
         
      </div>
   </div>
</div>
<div class="modal fade" id="update_consessions_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Return Stock</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
            <!-- <input type="hidden" name="code" value="88"> -->
            <div class="modal-body" id="update_consessions_modal_data">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" onclick="editConcessionUpdate()" class="btn btn-primary">Save</button>
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