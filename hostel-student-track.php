<?php 
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         
            <div class="col-lg-12 col-md-12 col-sm-12">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Student Profile</h3>
                     <div class="card-tools">
                     <div class="btn-group input-group-sm">
                                 <input type="text" name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Uni/Class Roll No." aria-describedby="button-addon2" value="">
                              <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="student_search_track();" name="search"><i class="fa fa-search"></i></button>
                           </div>
                     
                  </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0"  id="student_track_search_record">
                     
                  </div>

                 
               </div>
              
            </div>
            <div class="col-md-7 col-lg-7 col-sm-3" style="display:none">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Student</h3>
               </div>
               <form class="form-horizontal" action="" method="POST">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-lg-6" style="display: none;" >
                           <label for="inputEmail3" class="col-sm-4 col-form-label">Student ID</label>
                           <div class="col-lg-12">
                              <input type="hidden" name="" required="" readonly class="form-control" id="student_IDNO" placeholder="Student ID" value="">
                              <input type="hidden" name="" required="" readonly class="form-control" id="studentRemark" placeholder="Student ID" value="">
                           </div>
                           
                        </div>
                        <!-- <div class="col-lg-6">
                           <label for="inputEmail3" class="col-sm-4 col-form-label">Floor</label>
                           <div class="col-lg-12">
                              <select name="floor" required id="floorSelect" onchange="roomSelect(this.value)" class="form-control">
                                 <option value="">Select</option>
                                 <?php
                                 $floor_qry="Select distinct Floor from location_master where location_owner='$EmployeeID'";
                                 $res_floor=mysqli_query($conn,$floor_qry);
                                 while ($floorData=mysqli_fetch_array($res_floor)) 
                                 {
                                    $floorValue=$floorData['Floor'];
                                    if ($floorValue=='0') 
                                       {
                                          $floorName='Ground';
                                       }  
                                       elseif ($floorValue=='1') 
                                       {
                                          $floorName='First';
                                       }  
                                       elseif ($floorValue=='2') 
                                       {
                                          $floorName='Second';
                                       }  
                                       elseif ($floorValue=='3') 
                                       {
                                          $floorName='Third';
                                       } 
                                       ?>
                                       <option value="<?=$floorValue?>"><?=$floorName?></option> 
                                       <?php
                                 }
                                 ?>
                              </select>
                           </div>
                           
                        </div>
                        <div class="col-lg-6">
                           <label for="inputEmail3" class="col-sm-4 col-form-label">Room No.</label>
                           <div class="col-lg-12">
                              <select name="room_no" id="roomSelectList" onchange="bedSelect(this.value)" required class="form-control">
                                 <option value="">Select</option>
                                    <script type="text/javascript">
                                 function roomSelect(floor)
                                 {
                                       // alert(floor);
                                    var code='71';
                                      $.ajax({
                                        url:'action.php',
                                        data:{floor:floor,code:code},
                                        type:'POST',
                                        success:function(data){
                                            if(data != "")
                                            {
                                                $("#roomSelectList").html("");
                                                $("#roomSelectList").html(data);
                                            }
                                        }
                                      });
                                   }
                                    </script>
                                 </select>
                           </div>
                           
                        </div>
                        <div class="col-lg-6">
                           <label for="inputEmail3" class="col-sm-4 col-form-label">Bed No.</label>
                           <div class="col-lg-12">
                              <select name="room_no" required id="bedSelectList" class="form-control">
                                 <option value="">Select</option>
                                 <script type="text/javascript">
                                 function bedSelect(room)
                                 {
                                       // alert(room);
                                    var code='72';
                                    var floor=document.getElementById('floorSelect').value;
                                      $.ajax({
                                        url:'action.php',
                                        data:{room:room,code:code,floor:floor},
                                        type:'POST',
                                        success:function(data){
                                            if(data != "")
                                            {
                                                $("#bedSelectList").html("");
                                                $("#bedSelectList").html(data);
                                            }
                                        }
                                      });
                                   }
                                    </script>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <label for="inputEmail3" class="col-sm-4 col-form-label">Session</label>
                           <div class="col-lg-12">
                              <select name="room_no" required id="session" class="form-control">
                                 <option value="">Select</option>
                                 <option value="2022-23">2022-23</option>
                              </select>
                           </div>
                        </div> -->
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-info" onclick="studentVerify();">Check In</button>
                     <p id="Student_success"></p>
                  </div>
                  <!-- /.card-footer -->
               </form>
            </div>

            <!-- /.card -->
         </div>
       
      
        
      </div>
      
   </div>
 
</section>


<script type="text/javascript">
   function student_search_track()
   {
      var code=84;
      var rollNo= document.getElementById("student_roll_no").value;
      if (rollNo!='') 
      {
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
               document.getElementById("student_track_search_record").innerHTML =response;
               code=70;
               $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,rollNo:rollNo
            },dataType:"json",
            success:function(response) 
            {
               var l=response.length;
               if(l>0)
               {
                  var IDNo=response[0]["IDNo"];
                  var Class=response[0]["ClassRollNo"];
                  var Uni=response[0]["UniRollNo"];
                  var Name=response[0]["StudentName"];

               }
               document.getElementById("student_IDNO").value =IDNo;
               document.getElementById("studentRemark").value =Name+"("+Class+"/"+Uni+")";
               
            }
         });

            }
         });
      }
      else
      {
         alert("Please Enter the Roll No.");
         document.getElementById("student_IDNO").value ='';
         document.getElementById("student_track_search_record").innerHTML ='';
      }
   }
    function studentVerify()
   {
      var code=73;
      var ID=document.getElementById("student_IDNO").value;
      if (ID!='') 
      {
     // alert(ID);
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:ID
            },
            success:function(response) 
            {
               if (response) 
               {
                  alert(response);
               }
               else
               {
                  code='74';
                  var floor=document.getElementById("floorSelect").value;
                  var room=document.getElementById("roomSelectList").value;
                  var studentRemark=document.getElementById("studentRemark").value;
                  var bed=document.getElementById("bedSelectList").value;
                  var session=document.getElementById("session").value;
                  if (floor==''||room==''||bed==''||session=='') 
                  {
                     alert("Enter all the details.");
                  }
                  // alert(bed);
                   $.ajax(
                     {
                        url:"action.php ",
                        type:"POST",
                        data:
                        {
                           code:code,id:ID,floor:floor,room:room,bed:bed,studentRemark:studentRemark,session:session
                        },
                        success:function(response) 
                        {
                           document.getElementById("Student_success").innerHTML=response;
                           
                        }
                     });

               }

            }
         });
      }
      else
      {
         alert("Enter correct Roll number.")
      }
   }
  
</script>

<?php include "footer.php";  ?>