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
                     <!-- <div class="col-lg-1">
                        <h3 class="card-title">Reports</h3>
                     </div> -->
                     <div class="col-lg-12">
                        <div class="card-tools">
                           <div class="row">
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <input type="hidden" value="<?= $code_access;?>" id='code_access'>

                                    <select class="form-control" name="Session" id='Session'>
                                       <!-- <option value="">Session</option> -->
                                       <?php
                                       $sessionSql="SELECT Distinct session FROM hostel_student_summary order by session DESC";
                                       $sessionRes=mysqli_query($conn,$sessionSql);
                                       while($sessionData=mysqli_fetch_array($sessionRes))
                                       {
                                          $session=$sessionData['session'];
                                          ?>
                                          <option value="<?=$session?>"><?=$session?></option>
                                          <?php
                                       } 
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostel" id='hostel_id' onchange="hostelFloor(this.value)"  >
                                       <option value="">Select Hostel</option>
                                       <?php
                                       $hostelQry="SELECT * FROM building_master inner join hostel_permissions on hostel_permissions.building_master_id=building_master.ID where emp_id='$EmployeeID'";
                                       $hostelRes=mysqli_query($conn,$hostelQry);
                                       while($hostelData=mysqli_fetch_array($hostelRes))
                                       {
                                          ?>
                                          <option value="<?=$hostelData['ID']?>"><?=$hostelData['Name']?></option>
                                          <?php
                                       }
                                       ?>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostelFloorID" id='hostelFloorID' onchange="hostelRoom(0,this.value)" >
                                       <option value="">Floor</option>
                                       
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostelRoomID" id='hostelRoomID'  >
                                       <option value="">Room No.</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="search_hostel_student()" >Students</button>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="search_hostel_staff()" >Staff</button>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control"  onclick="hostelAvailability()" ><small>Availability</small></button>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="fullReport()" >All</button>
                                 </div>
                              </div>
                              
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="exportHostelReport()" >Export</button>
                                 </div>
                              </div> 

                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
                  <div class="card-body" >
                     <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="hostelStudentsRecord"></div>
                     </div>

                  </div>
            </div>
         </div>
      </div>
   </div>
   <p id="ajax-loader"></p>
   <script type="text/javascript">
       function exportAllHostel(building)
      {
            var exportCode='16';
            var floor=document.getElementById("hostelFloorID").value;
            var room=document.getElementById("hostelRoomID").value;
            // alert(room+' '+floor+' '+building)
          window.location.href="export.php?building="+building+"&exportCode="+exportCode+"&floor="+floor+"&room="+room;
      }

      function fullReport()
      {
         
         var code='114';
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
               $("#hostelStudentsRecord").html("");
               $("#hostelStudentsRecord").html(data);
            }
            }
            });
         }
         else
         {
            alert("Select Hostel");
         }
      }
      function exportHostelReport() 
      {
         var exportCode=13;
        var hostel=document.getElementById("hostel_id").value;
        var session=document.getElementById("Session").value;
        if (hostel!='' && session!='') 
         {
            // alert("export.php?exportCode="+exportCode+"&hostel="+hostel+"&session="+session);
          window.location.href="export.php?exportCode="+exportCode+"&hostel="+hostel+"&session="+session;
         }
         else
         {
            alert("Select both Hostel & Session...");
         }
       
        
      }
      function hostelFloor(id)
      {  var floor='';
         hostelRoom(id,floor);
         var code='81';
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
      function hostelRoom(id,floor)
      {
         if (id==0) 
         {
            id=document.getElementById("hostel_id").value;
         }
         var code='82';
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
      function search_hostel_student()
      {
         
          var code='83';
         var building=document.getElementById("hostel_id").value;
         var session=document.getElementById("Session").value;
          var code_access=document.getElementById("code_access").value;
         
         if (building!=''&& session!='') 
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
            data:{code:code,building:building,floor:floor,room:room,session:session,code_access:code_access},
            type:'POST',
            success:function(data){
            if(data != "")
            {
               spinner.style.display='none';
               $("#hostelStudentsRecord").html("");
               $("#hostelStudentsRecord").html(data);
            }
            }
            });
         }
         else
         {
            alert("Select Hostel");
         }
      }
      function search_hostel_staff()
      {
         
         var code='161';
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
               $("#hostelStudentsRecord").html("");
               $("#hostelStudentsRecord").html(data);
            }
            }
            });
         }
         else
         {
            alert("Select Hostel");
         }
      }
      function student_stockF(locationID,studentID)
      {
         // alert();
         var code_access=document.getElementById("code_access").value;
          var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
         var code='85';
         $.ajax({
         url:'action.php',
         data:{code:code,locationID:locationID,studentID:studentID,code_access:code_access},
         type:'POST',
         success:function(data){
         if(data != "")
         {
            spinner.style.display='none';
            document.getElementById("student_stock_data").innerHTML=data;
         // $("#student_stock_data").html("");
         // $("#student_stock_data").html(data);
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
                  // search_hostel_student();
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
               student_stock(locationID,studentID);
               search_hostel_student();
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
               $("#hostelStudentsRecord").html("");
               $("#hostelStudentsRecord").html(data);
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

<div class="modal fade" id="student_stock1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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