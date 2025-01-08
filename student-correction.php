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
                <h3 class="card-title">All  &nbsp;&nbsp;&nbsp;
                  </h3>

                <div class="card-tools">

                     <!-- <form method="post" action="export.php"> -->
                  <div class="btn-group input-group-sm" style="width: 150px;">
                     <!-- <input type="hidden" name="inchargeID" value="<?=$EmployeeID?>">
                     <input type="hidden" name="exportCode" value="10">
                    <input type="submit" class="form-control float-right btn-danger" value="Export"> -->
                  </div>
                     <!-- </form> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive " style="height: 800px;">
               <br>
                <table class="table table-head-fixed text-nowrap table-bordered" id="example">
                  <thead>
                    <tr>
                     <th>Sr. No.</th>
                      <th>IDNo</th>
                      <th>Name</th>
                      <th>Father Name</th>
                      <th>Mother Name</th>
                      <th>Gender</th>
                      <th>Mobile No</th>
                      <th>Email ID</th>
                      <th>Address</th>
                      <th>Status</th>
                      <th>Submit Date</th>
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody  id="search_record">
                    <?php 
                         $arrayFaultyArticle[]='';
                         $StuCorection_num=0;
                         $StuCorection=" SELECT * FROM StudentCorrectionData  ";
                         $StuCorection_run=sqlsrv_query($conntest,$StuCorection);
                        while ($StuCorection_row=sqlsrv_fetch_array($StuCorection_run)) 
                        {
                           if (!in_array($StuCorection_row['IDNo'], $arrayFaultyArticle)) 
                           {
                        $StuCorection_num=$StuCorection_num+1;?>
                        <tr>
                        <td><?=$StuCorection_num;?></td>
                        <td><?=$StuCorection_row['IDNo'];?></td>
                        <td><?=$StuCorection_row['StudentName'];?></td>
                        <td><?=$StuCorection_row['FatherName'];?></td>
                        <td><?=$StuCorection_row['MotherName'];?></td>
                        <td><?=$StuCorection_row['Gender'];?></td>
                        <td><?=$StuCorection_row['MobileNo'];?></td>
                        <td><?=$StuCorection_row['EmailID'];?></td>
                        <td><?=$StuCorection_row['Address'];?></td>
                        <td><?php if($StuCorection_row['Status']==1){
                            echo "Success";
                        }else{
                            echo "Pending";
                        };?></td>
                        <td><?=$StuCorection_row['SubmitDate']->format('d-m-Y');?></td>
                       </tr>
                     <?php 
                     $arrayFaultyArticle[]=$StuCorection_row['IDNo'];
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

