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
                <h3 class="card-title">Locations &nbsp;&nbsp;&nbsp;
                  </h3>

                <div class="card-tools">

                     <form method="post" action="export.php">
                  <div class="btn-group input-group-sm" style="width: 150px;">
                     <input type="hidden" name="inchargeID" value="<?=$EmployeeID?>">
                     <input type="hidden" name="exportCode" value="10">
                    <input type="submit" class="form-control float-right btn-danger" value="Export">
                  </div>
                     </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive " style="height: 800px;">
               <br>
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
                    </tr>
                  </thead>
                  <tbody  id="search_record">
                    <?php 
                        $location_num=0;
                        

  $location="SELECT *,lm.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo FROM stock_summary ss INNER JOIN location_master lm  ON ss.LocationID=lm.ID  INNER JOIN building_master bm ON 
 bm.ID=lm.block  inner join room_master r on r.RoomNo=lm.RoomNo 
 INNER join room_type_master as rtm ON rtm.ID=lm.Type inner join room_name_master 
rnm on lm.RoomName=rnm.ID 
  INNER JOIN  category_permissions  cp ON cp.CategoryCode=ss.CategoryID    WHERE cp.employee_id='$EmployeeID' AND bm.Incharge='$EmployeeID' group by lm.ID,r.Floor,r.RoomNo";


                    // echo    $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID Where b.Incharge='$EmployeeID' ";


                        $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {
                        $location_num=$location_num+1;?>
                     <tr>
                        <td><?=$location_num;?></td>
                        <td><?=$location_row['Name'];?></td>
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
                        <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_serial_no_Modal" onclick="view_serials(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
<?php 
if ($empID!='')
 {
    ?>
                       <!--  <td><input type="submit" class="btn btn-success btn-xs" name="" value="Assign" data-toggle="modal" data-target="#exampleModal_bulk" onclick="bulk_assign_location(<?=$location_row['l_id'];?>);">
                        </td> -->
                        <td><i class="fa fa-eye fa-lg" onclick="view_office_stock(<?=$location_row['l_id'];?>);" data-toggle="modal" data-target="#view_assign_stock_office_Modal" style="color:red;"></i>
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
<script type="text/javascript">
   function updateModalFunction(id,page) 
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("update_modal_data").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id+"&page=" + page+"&code="+9, true);
    xmlhttp.send();
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
      function working(id){
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
    </script>
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
            <h5 class="modal-title" id="exampleModalLabel">Fault Description</h5>
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
<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Article</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="update_modal_data">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
    <?php 
    include "footer.php"; ?>

