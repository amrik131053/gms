<?php 
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         
            <div class="col-lg-5 col-md-5 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Student Profile</h3>
                     <div class="card-tools">
                     <div class="btn-group input-group-sm">
                                 <input type="text" name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Uni/Class Roll No." aria-describedby="button-addon2" value="">
                              <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="student_search();" name="search"><i class="fa fa-search"></i></button>
                           </div>
                     
                  </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0"  id="student_search_record">
                     
                  </div>

                 
               </div>
              
            </div>
            <div class="col-md-7 col-lg-7 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Location</h3>
                  
               </div>
             
                  <div class="card-body">
                 <div class="row">
    <div class="col-lg-12" >                 
<p id="Student_success" style="display: none;" >

</p>
</div>


                      

                        <div class="col-lg-6" style="display: none;" >
                           <label for="inputEmail3" class="col-sm-4 col-form-label">Student ID</label>
                           <div class="col-lg-12">
                              <input type="hidden" name="" required="" readonly class="form-control" id="student_IDNO" placeholder="Student ID" value="">
                              <input type="hidden" name="" required="" readonly class="form-control" id="studentRemark" placeholder="Student ID" value="">
                           </div>
                           
                        </div>
                        <div class="col-lg-6">
                           <label for="inputEmail3" class="col-sm-4 col-form-label">Hostel</label>
                           <div class="col-lg-12">
                              <select name="hostel" required id="hostel" onchange="selectFloor(this.value)" class="form-control">
                                 <option value="">Select</option>
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
                        <div class="col-lg-6">
                           <label for="inputEmail3" class="col-sm-4 col-form-label">Floor</label>
                           <div class="col-lg-12">
                              <select name="floor" required id="floorSelect" onchange="roomSelect(this.value)" class="form-control">
                                 <option value="">Select</option>
                                 <script type="text/javascript">
                                 function selectFloor(hostel)
                                 {
                                       // alert(floor);
                                    var code='91';
                                      $.ajax({
                                        url:'action.php',
                                        data:{hostel:hostel,code:code},
                                        type:'POST',
                                        success:function(data){
                                            if(data != "")
                                            {
                                                $("#floorSelect").html("");
                                                $("#floorSelect").html(data);
                                            }
                                        }
                                      });
                                   }
                                    </script>
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
                                       var hostel=document.getElementById("hostel").value;
                                    var code='71';
                                      $.ajax({
                                        url:'action.php',
                                        data:{floor:floor,code:code,hostel:hostel},
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
                                        $("#bedSelectList").html("");
                                    var code='72';
                                       var hostel=document.getElementById("hostel").value;
                                    var floor=document.getElementById('floorSelect').value;
                                      $.ajax({
                                        url:'action.php',
                                        data:{room:room,code:code,floor:floor,hostel:hostel},
                                        type:'POST',
                                        success:function(data){
                                            if(data != "")
                                            {
                                                $("#bedSelectList").html("");
                                                $("#bedSelectList").html(data);
                                                document.getElementById("checkInButton").style.display='block';
                                                document.getElementById("addBedButton").style.display='none';
                                            }
                                            else
                                            {
                                              addBedShow();
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
                                 <option value="2023-24">2023-24</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <label for="inputEmail3" class="col-sm-4 col-form-label">&nbsp;&nbsp;</label>
                           <div class="col-lg-12">
                              <button type="submit" id="addBedButton" class="btn btn-primary form-control" style="display: none;" onclick="addBedAtLocation()">Add Bed</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     <button type="submit" id="checkInButton" class="btn btn-info btn-xs" onclick="studentVerify();">Check In</button>
                     

                    
                  </div>
                  <!-- /.card-footer -->
              
            </div>

            <!-- /.card -->
         </div>
       
      
        
      </div>
      
   </div>
 
</section>


<script type="text/javascript">
   function addBedShow()
   {
      document.getElementById("checkInButton").style.display='none';
      document.getElementById("addBedButton").style.display='block';
   }
   function addBedAtLocation()
   {   
      var code='100';
      var floor=document.getElementById("floorSelect").value;
      var room=document.getElementById("roomSelectList").value;
      var hostel=document.getElementById("hostel").value;
      if (floor==''|| room==''|| hostel=='') 
                  {
                     alert("Enter all the details.");
                  }
                  else
                  {
                     
                   $.ajax(
                     {
                        url:"action.php ",
                        type:"POST",
                        data:
                        {
                           code:code,floor:floor,room:room,hostel:hostel
                        },
                        success:function(response) 
                        {
                          // console.log(response);
                           document.getElementById("Student_success").style.display='block';
                           document.getElementById("Student_success").innerHTML=response;
                           $('#Student_success').delay(5000).fadeOut('slow');


                           document.getElementById("floorSelect").value ='';
                           document.getElementById("roomSelectList").innerHTML ='';
                           document.getElementById("bedSelectList").value ='';
                           document.getElementById("checkInButton").style.display='block';
                           document.getElementById("addBedButton").style.display='none';


                        }
                     });
                  }

   }
   function student_search()
   {
      var code=69;
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
               document.getElementById("student_search_record").innerHTML =response;
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
         document.getElementById("student_search_record").innerHTML ='';
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
                  var hostel=document.getElementById("hostel").value;
                  var studentRemark=document.getElementById("studentRemark").value;
                  var bed=document.getElementById("bedSelectList").value;
                  var session=document.getElementById("session").value;
                  if (floor==''||room==''||bed==''|| session=='' || hostel=='') 
                  {
                     alert("Enter all the details.");
                  }
                  else
                  {

                   $.ajax(
                     {
                        url:"action.php ",
                        type:"POST",
                        data:
                        {
                           code:code,id:ID,floor:floor,room:room,bed:bed,studentRemark:studentRemark,session:session,hostel:hostel
                        },
                        success:function(response) 
                        {
                          // console.log(response);
                           document.getElementById("Student_success").style.display='block';
                           document.getElementById("Student_success").innerHTML=response;
                           $('#Student_success').delay(5000).fadeOut('slow');

                           document.getElementById("floorSelect").value ='';
                           document.getElementById("roomSelectList").value ='';
                           document.getElementById("bedSelectList").value ='';


                        }
                     });
                  }

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