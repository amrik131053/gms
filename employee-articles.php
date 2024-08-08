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
                <h3 class="card-title">Articles assigned  &nbsp;&nbsp;&nbsp;
                  </h3>

                <div class="card-tools">

                     <form method="post" action="export.php">
                  <div class="btn-group input-group-sm" style="width: 150px;">
                     <input type="hidden" name="inchargeID" value="<?=$EmployeeID?>">
                     <input type="hidden" name="exportCode" value="10.1">
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
                     <th>Sr. No.</th>
                      <th>Article No.</th>
                      <th>Article Name</th>
                      <th>Location</th>
                      <th>View</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody  id="search_record">
                    <?php 
                    $arrayFaultyArticle[]='';
                        $location_num=0;
              $location=" SELECT distinct token_no, IDNo, Name,  RoomType, ArticleName,WorkingStatus, room_master.Floor as FloorName ,room_master.RoomNo as RoomName from stock_summary inner join location_master on location_master.ID=stock_summary.LocationID left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type inner join master_article on stock_summary.ArticleCode=master_article.ArticleCode left join faulty_track on faulty_track.article_no=stock_summary.IDNo Where Corrent_owner='$EmployeeID' order by token_no desc ";

                       
                        $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {
                           if (!in_array($location_row['IDNo'], $arrayFaultyArticle)) 
                           {
                              // code...
                           
                        $location_num=$location_num+1;?>
                     <tr>
                        <td><?=$location_num;?></td>
                        <td><?=$location_row['IDNo'];?></td>
                        <td><?=$location_row['ArticleName'];?></td>
                        <td>
                           Block: <?=$location_row['Name'];?> &nbsp;&nbsp;&nbsp;&nbsp; Floor: <?=$location_row['FloorName'];?> <br><?=$location_row['RoomType']."(<b>".$location_row['RoomName'];?></b>)</td>
                          
                        <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_assign_stock_Modal" onclick="view_assign_stock(<?=$location_row['IDNo'];?>);" style="color:red;"></i></td>
                        <td>  <?php 
                              if ($location_row['WorkingStatus']==0) 
                              {
                                  ?>
                                  <button type="button" class=" btn btn-warning btn-xs" data-toggle="modal" data-target="#fault_Modal" onclick="fault_description(<?=$location_row['IDNo'];?>)">Mark Faulty </button>
                                  <?php
                              }
                              elseif ($location_row['WorkingStatus']==1) 
                              {
                                 // echo $EmployeeID;
                                 // echo $location_row['ftStatus'];
                                 // echo $location_row['updated_by'];
                                 
                                  ?>
                                  <button type="button" class=" btn btn-dark btn-xs" data-toggle="modal" data-target="#fault_Modal" onclick="track(<?=$location_row['token_no'];?>)">Track</button>
                                  <?php  // code...
                                 
                              }
                              
                              ?>
                        </td>
                        
                        
                     </tr>
                     <?php 
                     $arrayFaultyArticle[]=$location_row['IDNo'];
                     }
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
    function track(id){
   var code=68;
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
   var page=2;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,page:page
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
            <h5 class="modal-title" id="exampleModalLabel">Track</h5>
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

