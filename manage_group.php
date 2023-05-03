<?php 
   include "header.php";   
   ?>
<section class="content">
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-lg " role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle"></h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card-tools">
                        <div class="row">
                           <input type="hidden" id="m_id" name="">
                           <div class="col-lg-3">
                              <div class="input-group-sm">
                                 <select class="form-control" name="hostel" id='hostel_id'  >
                                    <option value="">Select Building</option>
                                    <?php
                                       $hostelQry="SELECT * FROM building_master order by Name asc";
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
                           <div class="col-lg-3">
                              <div class="input-group-sm">
                                 <select class="form-control" name="hostelFloorID" id='hostelFloorID' onchange="buildingRoom(0,this.value)" >
                                    <option value="">Select Floor</option>
                                    <?php
                                       $floor_qry="Select distinct Floor from location_master where Floor!='' ";
                                       $res_floor=mysqli_query($conn,$floor_qry);
                                       while ($floorData=mysqli_fetch_array($res_floor)) 
                                       {
                                          $floorValue='';
                                         echo  $floorValue=$floorData['Floor'];
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
                                             elseif ($floorValue=='4') 
                                             {
                                                $floorName='Fourth';
                                             }
                                             elseif ($floorValue=='5') 
                                             {
                                                $floorName='Fifth';
                                             } 
                                       
                                       
                                             if ($floorValue!='') 
                                             {
                                                 // code...
                                             
                                             ?>
                                    <option value="<?=$floorValue?>"><?=$floorName?></option>
                                    <?php
                                       }
                                       }?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="input-group-sm">
                                 <select class="form-control" name="hostelRoomID" id='hostelRoomID'  >
                                    <option value="">Select Room No.</option>
                                    <?php
                                       $room_qry="Select distinct RoomNo from location_master order by RoomNo asc ";
                                       
                                       $res_room=mysqli_query($conn,$room_qry);
                                       while ($roomData=mysqli_fetch_array($res_room)) 
                                       {
                                       $roomValue=$roomData['RoomNo'];
                                       ?>
                                    <option value="<?=$roomValue?>"><?=$roomValue?></option>
                                    <?php
                                       } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-3">
                              <div class="input-group-sm">
                                 <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="searchlocationfor_group()" >Search</button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body table-responsive" id="all_group_member">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" onclick="get_array_value();" class="btn btn-primary">Save changes</button>
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-4 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">All Group</h3>
            </div>
            <div class="card-body">
               <div class="form-group row">
                  <div class="card-body table-responsive" id="all_gro">
                     <table class="table" id="">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Action</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $sr=1;
                              $get_group="SELECT * FROM group_master";
                              $get_group_run=mysqli_query($conn,$get_group);
                              while($row=mysqli_fetch_array($get_group_run))
                              {?>
                           <tr>
                              <th><?=$sr;?></th>
                              <th data-toggle="modal" onclick="modal_khali(<?=$row['Id'];?>);" data-target="#exampleModalCenter" ><b><?=$row['GroupName'];?></b></th>
                              <th><i class="fa fa-eye" onclick="show_group_member(<?=$row['Id'];?>);" style="color: green;"></i></th> <th><i class="fa fa-trash" onclick="group_delete(<?=$row['Id'];?>);" style="color: red;"></i></th>
                           </tr>
                           <?php
                              $sr++; }
                                ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
      </div>
      <div class="col-lg-8 col-md-8 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <button type="button" onclick="modal_khali('0');" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
               Create Group
               </button>
               <!-- <h3 class="card-title">-----</h3> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive" id="show_group_member_">
            </div>
            <!-- /.card -->
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>
<script type="text/javascript">
   function modal_khali(id) {
             $("#all_group_member").html("");
            document.getElementById("hostel_id").value='';
            document.getElementById("hostelFloorID").value='';
            document.getElementById("hostelRoomID").value='';
            document.getElementById("m_id").value=id;
            if (id==0) {
   
            document.getElementById("exampleModalLongTitle").innerHTML="Create Group ";
            }
            else
            {
            document.getElementById("exampleModalLongTitle").innerHTML="Update Group";
   
            }
   }
   
   function get_array_value()
   {
   var un_verifiy=document.getElementsByClassName('v_check');
   var len_student= un_verifiy.length; 
   
   var subjectIDs=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(un_verifiy[i].checked===true)
          {
            subjectIDs.push(un_verifiy[i].value);
          }
       }
   if((typeof  subjectIDs[0]== 'undefined'))
   {

    ErrorToast('Select atleast one Location','bg-warning');
   }
   else
   {
         fun(subjectIDs);
   }
   }
        function fun(subjectIDs)
         {
   
   var id=document.getElementById("m_id").value;
   if (id==0) 
   {
   var GroupName=prompt ("This is a prompt box", "Hello world");
   }
   else
   {
   var GroupName=id;
   }
   if (GroupName!=null)
   {
   var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
          var code=2;
   $.ajax({
   
         url:'action_g.php',
         data:{subjectIDs:subjectIDs,code:code,groupname:GroupName,id:id},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            if (data==1) 
            {
               all_gro();
                SuccessToast('Successfully');
               
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');
   
            }
            }      
   });
   }
   else
   {
   
   }
   }
   function verifiy_select()
   {
        if(document.getElementById("select_all1").checked)
        {
            $('.v_check').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.v_check').each(function()
             {
                this.checked = false;
            });
        }
   
    $('.v_check').on('click',function()
    {
        var a=document.getElementsByClassName("v_check:checked").length;
        var b=document.getElementsByClassName("v_check").length;
        
        if(a == b)
        {
   
            $('#select_all1').prop('checked',true);
        }
        else
        {
            $('#select_all1').prop('checked',false);
        }
    });
   
   }
   function show_group_member(id)
   {
      var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
      var code=3;
    $.ajax({
            url:'action_g.php',
            data:{code:code,id:id},
            type:'POST',
            success:function(data){
            if(data != "")
            {
               spinner.style.display='none';
               $("#show_group_member_").html("");
               $("#show_group_member_").html(data);
               $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
            }
            }
            });
   }   function all_gro()
   {
      var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
      var code=5;
    $.ajax({
            url:'action_g.php',
            data:{code:code},
            type:'POST',
            success:function(data){
            if(data != "")
            {
               spinner.style.display='none';
               // $("#show_group_member_").html("");
               $("#all_gro").html(data);
               $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
            }
            }
            });
   }
   function group_delete(id)
   {
      var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
      var code=4;
    $.ajax({
            url:'action_g.php',
            data:{code:code,id:id},
            type:'POST',
            success:function(data){
            if(data != "")
            {
               // console.log(data);
               spinner.style.display='none';
              if (data==1) {
               all_gro();
               SuccessToast('Successfully Deleted');
              }
              else
              {
               ErrorToast('Try Again','bg-danger');
              }
            }
            }
            });
   }
        function searchlocationfor_group()
      {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
         var code='1';
         var building=document.getElementById("hostel_id").value;
         var spinner=document.getElementById("ajax-loader");
                            spinner.style.display='block';
            var floor=document.getElementById("hostelFloorID").value;
            var room=document.getElementById("hostelRoomID").value;
            $.ajax({
            url:'action_g.php',
            data:{code:code,building:building,floor:floor,room:room},
            type:'POST',
            success:function(data){
            if(data != "")
            {
               spinner.style.display='none';
               $("#all_group_member").html("");
               $("#all_group_member").html(data);
               $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
            }
            }
            });
         
         
      }
</script>
<!-- Modal -->
<?php 
   include "footer.php";  ?>