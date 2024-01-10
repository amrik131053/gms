<?php 
  include "header.php"; 
  $permissionCount=0;
$permission_qry="SELECT * FROM category_permissions where employee_id='$EmployeeID' and is_admin='1'";
$permission_res=mysqli_query($conn,$permission_qry);
while($permission_data=mysqli_fetch_array($permission_res))
{
   $permissionCount++;
}  
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
                <h3 class="card-title">Faulty Articles &nbsp;&nbsp;&nbsp;
                  </h3>

                <div class="card-tools">
                  <div class="btn-group input-group-sm" style="width: 150px;">
                       <input type="submit" class="form-control float-right btn-danger" id="search_faulty" onclick="buttonSearch(this.value)" value="Completed">
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive " style="height: 800px;" id="search_record">
               <br>
                <table class="table table-head-fixed text-nowrap table-bordered" id="example">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Article</th>
                      <th>Location</th>
                      <th>Owner Name</th>
                      <th>Block Incharge</th>
                      <th>Action</th>
                      <th>Action</th>
                      <th>Print</th>
                      <?php
                      if ($permissionCount>0) 
                      {
                        ?>
                        <th>Assign to</th>
                        <?php
                      }
                      ?>
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody  >
                    <?php 
                        $location_num=0;
                        $categoryCode='';
                        if ($permissionCount>0) 
                        {
                         $location=" SELECT *,room_master.Floor as FloorName,room_master.RoomNo as RoomName,faulty_track.ID as l_id from faulty_track left join location_master on location_master.ID=faulty_track.location_id left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type inner join stock_summary on stock_summary.IDNo=faulty_track.article_no inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID Where  faulty_track.status='1' and faulty_track.direction='Faulty'  and category_permissions.employee_id='$EmployeeID' ";
                        }
                        else
                        {
                       echo  $location=" SELECT *,room_master.Floor as FloorName,room_master.RoomNo as RoomName,faulty_track.ID as l_id from faulty_track left join location_master on location_master.ID=faulty_track.location_id left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type inner join stock_summary on stock_summary.IDNo=faulty_track.article_no inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID Where (building_master.Incharge='$EmployeeID' or building_master.infra_incharge='$EmployeeID' or building_master.electrical_incharge='$EmployeeID' or faulty_track.forwarded_to='$EmployeeID') and  faulty_track.status='1' and faulty_track.direction='Faulty' and category_permissions.employee_id='$EmployeeID' ";
                        }
                        $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {
                           $categoryCode=$location_row['CategoryID'];
                        $location_num=$location_num+1;?>
                     <tr>
                        <td><?=$location_num;?></td>
                        <td><?=$location_row['article_no'];?></td>
                        <td>
                           Block: <?=$location_row['Name'];?> &nbsp;&nbsp;&nbsp;&nbsp; Floor: <?=$location_row['FloorName'];?> <br><?=$location_row['RoomType']."(<b>".$location_row['RoomName'];?></b>)</td>
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
                          <td><?php 

                          if ($categoryCode==1) 
                          {
                               echo  "Emp ID:".$Emp=$location_row['Incharge'];
                          }
                          elseif ($categoryCode==2) 
                          {
                               echo  "Emp ID:".$Emp=$location_row['electrical_incharge'];
                          }
                          elseif ($categoryCode==3) 
                          {
                               echo  "Emp ID:".$Emp=$location_row['infra_incharge'];
                          }

                         echo "<br>";
                           $staff="SELECT Name FROM Staff Where IDNo='$Emp'";
                           $stmt = sqlsrv_query($conntest,$staff);  
                           while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                           {
                              echo "<b>".$EmpName=$row_staff['Name']."</b>";
                           }

                          ?>                 

                          </td>
                        <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_assign_stock_Modal" onclick="working_by_incharge(<?=$location_row['token_no'];?>);" style="color:green;"></i></td>
<?php 
if ($empID!='')
 {
    ?>
                       <!--  <td><input type="submit" class="btn btn-success btn-xs" name="" value="Assign" data-toggle="modal" data-target="#exampleModal_bulk" onclick="bulk_assign_location(<?=$location_row['l_id'];?>);">
                        </td> -->
                        <td><i class="fa fa-eye fa-lg text-warning" data-toggle="modal" data-target="#view_serial_no_Modal" onclick="review_faulty(<?=$location_row['token_no'];?>);"></i>
                        </td>
                        <td><form method="post" action="fault-print.php" target="_blank"><button type="submit" class='btn border-0 shadow-none' style='background-color:transparent; border:display none'><i class="fa fa-print fa-lg text-primary" >
                           <input type="hidden" name="id" value="<?=$location_row['token_no'];?>">
                       </i></button></form></td>
                        <?php
}
else {
   ?> <td><input type="submit" class="btn btn-danger btn-xs" name="" value="Update">
                        </td><?php
}
                        ?>
                        <?php
                      if ($permissionCount>0) 
                      {    
                        ?>
                        <td>
                           <div class="input-group" style="max-width: 150px;">

                           <select name="assignTo" id="assignTo_<?=$location_row['l_id'];?>" class="form-control" required>
                              <?php 
                              $id11=$location_row['l_id'];
                              $assignRes=mysqli_query($conn,"SELECT forwarded_to from faulty_track where id='$id11'");
                              while($assignData=mysqli_fetch_array($assignRes))
                              {
                                 if ($assignData['forwarded_to']>0) 
                                 {
                                 ?>
                                 <option value=""><?=$assignData['forwarded_to']?></option>
                                 <?php
                                 }
                                 else 
                                 {
                                 ?>
                                 <option value="">Select</option>
                                 <?php
                                 }
                              }

                            echo   $_drop_staff="SELECT IDNo,Name From Staff where LeaveSanctionAuthority='$EmployeeID' and JobStatus='1'";     
                              $stmt_drop_staff = sqlsrv_query($conntest,$_drop_staff);  
                              while($row_staff_show = sqlsrv_fetch_array($stmt_drop_staff, SQLSRV_FETCH_ASSOC) )
                                   {
                                       $IDNo_Drop=$row_staff_show['IDNo'];
                                       $Name_Drop=$row_staff_show['Name'];
                                      
                                       echo "<option value='".$IDNo_Drop."'>".$Name_Drop." (".$IDNo_Drop.")"."</option>";     
                                   }
                            
                              ?>
                           </select>
                           <button  class="btn btn-info" type="button" onclick="assignEmployee(<?=$location_row['l_id'];?>)"><i class="fa fa-arrow-right"></i></button>
                           <p id="assignToMessage_<?=$location_row['l_id'];?>"></p>
                           </div>
                        </td>
                        <?php
                      }
                      ?>
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
<script type="text/javascript">
   function assignEmployee(id) {
      // alert(id);
      var empId= document.getElementById("assignTo_"+id).value;
      if (empId!='') 
      {

       var code=67;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
                code:code,id:id, empId:empId
            },
            success:function(response) 
            {
                  window.location.reload();
            },
            error:function()
            {
               alert("error");
            }
         });
      // body...
      }
      else
      {
         document.getElementById("assignToMessage_"+id).innerHTML="Select any one.";
      }
   }
   function view_office_stock(location_id)   
      {
         // var id=id1;
         //var RoomType= document.getElementById("RoomType").value;
         //alert(RoomType);
         var code=56;
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
               document.getElementById("view_assign_office").innerHTML =response;
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
      function fault_description(id){
   var code=42;
   // alert(id);
   //var sr= document.getElementById("sinlge_assign_sr_"+id).value;
   //var current_owner= document.getElementById("current_owner_"+sr).value;
   // alert(current_owner);
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,
            },
            success:function(response) 
            {  
               document.getElementById("fault_description").innerHTML =response;
               // location.reload(true);
            }
         });
      }
      function working_by_incharge(id){
   var code=61;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,
            },
            success:function(response) 
            {  
               document.getElementById("view_assign").innerHTML =response;
               // location.reload(true);
            }
         });
      }
      function review_faulty(id){
   var code=63;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,
            },
            success:function(response) 
            {  
               document.getElementById("view_serial").innerHTML =response;
               // location.reload(true);
            }
         });
      } 
      function complaintSolved(id){
   var code=66;
   // alert(id);
   //var sr= document.getElementById("sinlge_assign_sr_"+id).value;
   //var current_owner= document.getElementById("current_owner_"+sr).value;
   // alert(current_owner);
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,
            },
            success:function(response) 
            {  
               document.getElementById("fault_description").innerHTML =response;
               // location.reload(true);
            }
         });
      }
      function buttonSearch(buttonValue)
      {
         var x= document.getElementById("search_faulty");
         var a='';
         //alert(buttonValue);
         if (buttonValue=='Completed') 
         {
            x.value='Pending';
            a=0;
         }
         else if (buttonValue=='Pending') 
         {
            x.value='Completed';
            a=1;
         }  
         searchRecordFaulty(a);
 
      }
      function searchRecordFaulty(id){
   var code=65;
   // alert(id);
   //var sr= document.getElementById("sinlge_assign_sr_"+id).value;
   //var current_owner= document.getElementById("current_owner_"+sr).value;
   // alert(current_owner);
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,
            },
            success:function(response) 
            {  
               document.getElementById("search_record").innerHTML =response;
               // location.reload(true);
            }
         });
      }
    </script>
    <div class="modal fade" id="view_assign_stock_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mark Working</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
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
<div class="modal fade" id="view_serial_no_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="">
            <div class="modal-body" id="view_serial">
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
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="28">
            <div class="modal-body" id="view_location">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="view_assign_stock_office_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Stock Assigned</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="export.php" method="post">
            <div class="modal-body" id="view_assign_office">
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
<div class="modal fade" id="fault_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Completed</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            
            <div class="modal-body" id="fault_description">
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
    <?php 
    include "footer.php"; ?>

