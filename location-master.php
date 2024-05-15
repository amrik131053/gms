<?php 
  include "header.php";   
?>
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-lg-4 col-md-4 col-sm-3" style="display: none;">
          </div>           
          <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
              <div class="card-header">
               
                  <div class="row">
                     <div class="col-lg-1">
                         <h3 class="card-title">Locations &nbsp;&nbsp;&nbsp;
                  <!-- <button  class=" btn btn-success btn-xs" data-toggle="modal" data-target="#AddNewLocation">Add New </button> -->
                  </h3>
                     </div>
                     <div class="col-lg-11">
                        <div class="card-tools">
                           <div class="row">
                              
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostel" id='hostel_id' onchange="floorLocation(this.value)"  >
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
                              <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <select class="form-control" name="hostelFloorID" id='hostelFloorID' onchange="buildingRoom(0,this.value)" >
                                       <option value="">Select Floor</option>
                                       <?php
    $floor_qry="Select distinct Floor from location_master where Floor!='' ";
    $res_floor=mysqli_query($conn,$floor_qry);
    while ($floorData=mysqli_fetch_array($res_floor)) 
    {
       $floorValue='';
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
                              <div class="col-lg-2">
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
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button type="button" class="btn btn-outline-warning btn-sm form-control" onclick="searchLocations()" >Search</button>
                                 </div>
                              </div>
                              <div class="col-lg-1">
                                 <div class="input-group-sm">
                                    <button  class="btn btn-outline-warning btn-sm form-control" data-toggle="modal" data-target="#AddNewLocation">Add New </button>
                                 </div>
                              </div>
                               <div class="col-lg-2">
                                 <div class="input-group-sm">
                                    <button  class="btn btn-outline-warning btn-sm form-control" data-toggle="modal" data-target="#ChangeOwner">Change Owner</button>
                                 </div>
                              </div>
                              
                              
                              
                              <div class="col-lg-1">
                                 <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="locationsearch(this.value);">
                  </div>
                              </div> 

                           </div>
                        </div>
                        
                     </div>
                  </div>

                <div class="card-tools">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive " style="height:1000px;" id="search_record">
               
                <table class="table table-head-fixed text-nowrap table-bordered" id="example">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Block</th>
                      <th>Floor</th>
                    
                     <th>Room Type/No</th>
                      <th>Owner Name</th>
                      <th>Action</th>
                      <th>Action</th>
                      <th>Action</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody  >
                    <?php 
                        $location_num=0;
                        
 $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID order by l.ID limit 20 ";


                       

                        $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {
                        $location_num=$location_num+1;?>
                     <tr>
                        <td><?=$location_num;?></td>
                        <td><?=$location_row['Name'];?>(<?=$location_row['l_id'];?>)</td>
                        <td><?=$location_row['FloorName'];?></td>
                     
                          <td><?=$location_row['RoomType'];?>-<?=$location_row['RoomNoo'];?> <b>(<?=$location_row['RoomName'];?>)</b></td>
                          <td><?php 
                         echo  "Emp ID:".$empID=$location_row['location_owner'];
                         echo "<br>";
                           $staff="SELECT Name FROM Staff Where IDNo='$empID'";
 $stmt = sqlsrv_query($conntest,$staff);  
while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
     {
echo "<b>".$Emp_Name=$row_staff['Name']."</b>";
     }

                          ?>                 

                          </td>
                        <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_view" onclick="view_location(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
                        <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_serial_no_Modal" onclick="view_serials(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
<?php 
if ($empID!='')
 {
    ?>
                        <td><input type="submit" class="btn btn-success btn-xs" name="" value="Assign" data-toggle="modal" data-target="#exampleModal_bulk" onclick="bulk_assign_location(<?=$location_row['l_id'];?>);">
                       <input type="submit" class="btn btn-success btn-xs" name="" value="Assign"  onclick="page_open(<?=$location_row['l_id'];?>);">
                        </td>
                        <?php
}
else {
   ?> <td><input type="submit" class="btn btn-danger btn-xs" name="" value="Update">
                        </td><?php
}
                        ?>
                        <td><form action="stock_report.php" method="post" target="_blank">
                          <input type="hidden" name="ID" value="<?=$location_row['l_id'];?>">
                          <button class="fa fa-print fa-lg" type="submit" style="color: green; border: none; background: none;"></button></form></td>
                     </tr>
                     <?php 
                        }
                                   ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
       
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <p id="ajax-loader"></p>
<script type="text/javascript">
   function floorLocation(id)
      {  var floor='';
         buildingRoom(id,floor);
         var code='81';
         $.ajax({
         url:'action.php',
         data:{code:code,building:id},
         type:'POST',
         success:function(data){
         if(data != "")
         {
            console.log(data);
         $("#hostelFloorID").html("");
         $("#hostelFloorID").html(data);
         }
         }
         });
      } 
       function buildingRoom(id,floor)
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
      function searchLocations()
      {
          
         var code='115';
         var building=document.getElementById("hostel_id").value;
         
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
               $("#search_record").html("");
               $("#search_record").html(data);
               $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
            }
            }
            });
         
         
      }
         function view_serials(location_id)   
      {
         // var id=id1;
         //var RoomType= document.getElementById("RoomType").value;
         //alert(RoomType);
         var code=46;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,location_id:location_id
            },
            success:function(response) 
            {
               document.getElementById("view_serial").innerHTML =response;
               $(document).ajaxStop(function()
               {
                  // window.location.reload();
               });
            },
            error:function()
            {
               alert("error");
            }
         });
      }
    </script>
<div class="modal fade" id="view_serial_no_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Device Serial No.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="export.php" method="post">
            <input type="hidden" name="code" value="">
            <div class="modal-body" id="view_serial">
               ...
            </div>
           
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary" >Export</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!--  <button type="submit" class="btn btn-primary">Save</button> -->
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="AddNewLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-md" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
            <div class="modal-body">
               <div class="row">
            <!--   <div class="card-header"> -->
                <!-- <h3 class="card-title">Location Master</h3> -->
            <!--   </div> -->
        
              <form class="form-horizontal" action="action.php" method="POST">
                <input type="hidden" name="code" value="4">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" required="" class="col-sm-4 col-form-label">Block</label>
                    <div class="col-lg-12">
                       <select class="form-control" name="Block" id="block" required="">
                                 <option value="">Select</option>
                                 <?php
                                    $building_select="SELECT Distinct Name,ID FROM building_master";
                                    $building_select_run=mysqli_query($conn,$building_select);
                                    while ($building_select_row=mysqli_fetch_array($building_select_run)) 
                                    {?>
                                    <option value="<?=$building_select_row['ID'];?>"><?=$building_select_row['Name'];?></option>";
                                   <?php  
                                    }
                                    ?>
                              </select>
 <label for="inputEmail3" required="" class="col-sm-12 col-form-label">College Name</label>
                     <select class="form-control" name="College" id="" required="">
                                 <option value="">Select</option>
                                 <?php
                                    $colleges_select="SELECT Distinct name,ID FROM colleges";
                                    $colleges_select_run=mysqli_query($conn,$colleges_select);
                                    while ($colleges_select_row=mysqli_fetch_array($colleges_select_run)) 
                                    {?>
                                    <option value="<?=$colleges_select_row['ID'];?>"><?=$colleges_select_row['name'];?></option>";
                                   <?php  }
                                    
                                    ?>
                              </select>
                

                               <label for="inputEmail3" class="col-sm-4 col-form-label">Floor</label>
                    
                      <select class="form-control" name="Floor" id="Floor" required="">
                                 <option value="">Select</option>
                                 <option value="0">Ground</option>
                                 <option value="1">First</option>
                                 <option value="2">Second</option>
                                 <option value="3">Third</option>
                                  <option value="4">Fourth</option>
                                
                              </select>


                                 <label for="inputEmail3" class="col-sm-12 col-form-label" id="">Room No</label>
                   
                      
                      <select class="form-control" name="RoomNo" id="RoomNo" required="">
                                 <option value="">Select</option>
                               </select>

                                <label for="inputEmail3" class="col-sm-12 col-form-label" id="">Room Type</label>
                   
                      
                      <select class="form-control" name="RoomType" id="RoomNo" required="">
                                 <option value="">Select</option>
                                  <?php
                                    $room_type_select="SELECT Distinct RoomType,ID FROM room_type_master";
                                    $room_type_select_run=mysqli_query($conn,$room_type_select);
                                    while ($room_type_select_row=mysqli_fetch_array($room_type_select_run)) 
                                    {?>
                                    <option value="<?= $room_type_select_row['ID'];?>"><?= $room_type_select_row['RoomType'];?></option>";
                                   <?php  }
                                    
                                    ?>
                               </select>

                               <label for="inputEmail3" class="col-sm-12 col-form-label" id="">Room Name</label>
                   
                      
                      <select class="form-control" name="RoomName" id="RoomName" required="">
                                 <option value="">Select</option>
                                  <?php
                                    $room_type_select="SELECT Distinct RoomName,ID FROM room_name_master";
                                    $room_type_select_run=mysqli_query($conn,$room_type_select);
                                    while ($room_type_select_row=mysqli_fetch_array($room_type_select_run)) 
                                    {?>
                                    <option value="<?= $room_type_select_row['ID'];?>"><?= $room_type_select_row['RoomName'];?></option>";
                                   <?php  }
                                    
                                    ?>
                               </select>

                                <label for="inputEmail3" class="col-sm-12 col-form-label" id="">Loation Owner(optional)</label>
                   
                      
                      <input type="text" name="location_owner" class="form-control" onkeyup="emp_details(this.value);">
                      <br>
                     <p id="emp_details_name"></p>
                  <button type="submit" class="btn btn-info" >Create</button> 

                    </div>
                  </div>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
              
            </div>
           
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!--  <button type="submit" class="btn btn-primary">Save</button> -->
            </div>
      </div>
   </div>
</div>
<div class="modal fade" id="exampleModal_bulk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Stock Assign </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
   
         <div class="row">
           <div class="col-lg-1 col-sm-12 col-md-12">
            </div>
                     <div class="col-lg-3 col-sm-12 col-md-12">
                      <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Category Name</label>
                     <select class="form-control" name="CategoryID" id="Category">
                              <option value=" ">Select </option>
                              <?php
                                 $category_select="SELECT * FROM master_calegories";
                                 $category_select_run=mysqli_query($conn,$category_select);
                                 while ($category_select_row=mysqli_fetch_array($category_select_run)) 
                                 {
                                 echo "<option value='".$category_select_row['ID']."'>".$category_select_row['CategoryName']."</option>";
                                 }
                                 ?>
                           </select>            
          </div>

                       <div class="col-lg-3 col-sm-12 col-md-12">
                           <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Article Name</label>
                       <select class="form-control" required="" id="articlebind" name="ArticleCode">
</select>                                           </div>
                 <div class="col-lg-3 col-sm-12 col-md-12">
                  <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Action</label>
                  <input type="submit" onclick="Search_Available_record()" value="Search" class="btn btn-primary">
                  <input type="hidden" name="" id="location_id_temp" >
               </div>
               
             
         
       </div>
       
    <form action="action.php" method="post">

<div class="card-body table-responsive p-0" style="height: 400px;">
      
            <div class="modal-body" id="view_bulk_data">
               

                    



                   
                </div>
           
           </div>
           <div class="container-fluid">
             <div class="col-lg-4">
                <label>Issue Date</label>
            <input type="date" name="IssueDate" class="form-control" required>
        </div></div>
        <br>
            <div class="modal-footer">
                 <input type="submit"  class="btn btn-primary" value="Submit">
                
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!-- <button type="submit" class="btn btn-primary">Save</button> -->
            </div>
              </form>
         </div>

      </div>
   </div>
</div>


<div class="modal fade" id="exampleModal_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Location Update </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>

 
       
           
            <div class="modal-body" >
               <div id='Update_location'></div>
<div id="view_location" ></div>

               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
            </div>
      





      </div>
   </div>
</div>





<div class="modal fade" id="ChangeOwner" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Owner</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
<div class="card-body">
   <div class="row">
      
      <div class="col-lg-4"> <label>Old Owner ID</label>
             <input type="number" name="ownerID" class="form-control" id='oldowner'  onkeyup="emp_details1(this.value);"> <br>

               <p id="emp_details_name1"></p>  </div>
               <div class="col-lg-4">
         <label>Location</label>
         <select class="form-control" name="blockForOwnerChnage" id="blockForOwnerChnage" onchange="showAssignedLocations(this.value);">
                                 <option value="">Select</option>
                                 <?php
                                    $building_select="SELECT Distinct Name,ID FROM building_master";
                                    $building_select_run=mysqli_query($conn,$building_select);
                                    while ($building_select_row=mysqli_fetch_array($building_select_run)) 
                                    {?>
                                    <option value="<?=$building_select_row['ID'];?>"><?=$building_select_row['Name'];?></option>";
                                   <?php  }
                                    
                                    ?>
                              </select>
      </div>
      <div class="col-lg-4"> <label>New Owner ID</label>
             <input type="number" name="ownerID" class="form-control" id='newowner'  onkeyup="emp_details2(this.value);"> <br>

               <p id="emp_details_name2"></p>    </div>
      
   </div>
</div>
<div id="chnagesowner"></div>
<div id="showAllAssignedLocation"></div>
     

           
            <div class="modal-body" id="view_location">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" onclick="ChangeOwner();">Change Owner</button>
            </div>
         
      </div>
   </div>
</div>
<script>
// function ChangeOwner(){

// var oldowner= document.getElementById("oldowner").value;
// var  newowner = document.getElementById("newowner").value;
// var  blockForOwnerChnage = document.getElementById("blockForOwnerChnage").value;
// var code=235;
// if(oldowner!=''&& newowner!='')
// {
// $.ajax({
// url:"action.php",
// type:"POST",
// data:{code:code,oldowner:oldowner,newowner:newowner,blockForOwnerChnage:blockForOwnerChnage},
// success:function(response) {
  
// document.getElementById("chnagesowner").innerHTML =response;
// },
// error:function(){
// alert("error");
// }
// });
// }
// else
// {
//    document.getElementById("chnagesowner").innerHTML ="<div class='alert alert-danger' role='alert'> Incorrect Data</div>";
// }
// }

function showAssignedLocations(id) {
   var oldowner= document.getElementById("oldowner").value;
   // alert(oldowner);
   var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
   var code=407;
   $.ajax({
url:"action_g.php",
type:"POST",
data:{code:code,oldowner:oldowner,id:id},
  success:function(response){  
   spinner.style.display='none';
  
        document.getElementById("showAllAssignedLocation").innerHTML=response;

         }
         });

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

function ChangeOwner()
{

  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var oldowner= document.getElementById("oldowner").value;
var  newowner = document.getElementById("newowner").value;
var  blockForOwnerChnage = document.getElementById("blockForOwnerChnage").value;
var code=235;
  var locationid=[];  
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            locationid.push(verifiy[i].value);
          }
     }
     if(oldowner!=''&& newowner!='')
{
  if((typeof  locationid[0]== 'undefined'))
  {
    ErrorToast(' Select atleast one Student' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';

$.ajax({
url:"action.php",
type:"POST",
data:{code:code,oldowner:oldowner,newowner:newowner,blockForOwnerChnage:blockForOwnerChnage,locationid:locationid},
success:function(response) {
   spinner.style.display='none';
   console.log(response);
   if(response>0)
   {
      SuccessToast('location Owner Changed Successfully');
      showAssignedLocations(blockForOwnerChnage);
   }
   else if(response=='Not')
   {
      ErrorToast(' Not a location Owner','bg-danger' );
   }
   else if(response=='EmployeeNot'){
      
      ErrorToast('  Employee does not exist ','bg-danger' );
   }
},
error:function(){
alert("error");
}
});
}


}
else{
   ErrorToast(' all inputs required' ,'bg-warning');
}
}
function update_location(id)
{
code=28;
var RoomType= document.getElementById("RoomType").value;
var RoomName= document.getElementById("RoomName1").value;
var location_owner= document.getElementById("location_owner").value;
var College = document.getElementById("college").value;


if(College!='' && RoomName!='' && RoomType!='')
{
$.ajax({
url:"action.php",
type:"POST",
data:{code:code,College:College,locationID:id,location_owner:location_owner,RoomType:RoomType,RoomName:RoomName},
  success:function(data){
         if(data != "")
         {
         
          SuccessToast('Successfully Updated');
searchLocations();
        //document.getElementById("Update_location").innerHTML ="<div class='alert alert-success' role='alert'> Updated Successfully</div>";





         }
         }
         });
}
else
{
   ErrorToast('Invalid data','bg-danger' );
   //document.getElementById("Update_location").innerHTML ="<div class='alert alert-danger' role='alert'> Incorrect Data</div>";
}
}



</script>












    <?php 
    include "footer.php"; ?>

