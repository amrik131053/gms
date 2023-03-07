<?php 

  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-lg-12 col-md-12 col-sm-3" >
            <div class="card card-info" >
               <div class="card-header" style="background-color: #223260;">
                  <h3 class="card-title">Stock Summary</h3>
               </div>
                 <form class="form-horizontal" action="all-export.php" method="POST">
                
                  <div class="card-body">
                     <div class="form-group row">
                      
                        <div class="col-lg-2">
                           <label for="inputEmail3" required="" class="col-lg-12 col-form-label">Category Name</label>
                           <select class="form-control" name="CategoryID" id="Category">
                              <option value=" ">Select </option>
                              <?php
                                 $category_select="SELECT *,master_calegories.ID as MCID FROM master_calegories inner join category_permissions on category_permissions.CategoryCode=master_calegories.ID where category_permissions.employee_id='$EmployeeID' ";
                                 $category_select_run=mysqli_query($conn,$category_select);
                                 while ($category_select_row=mysqli_fetch_array($category_select_run)) 
                                 {
                                 echo "<option value='".$category_select_row['MCID']."'>".$category_select_row['CategoryName']."</option>";
                                 }
                                 ?>
                           </select>
                        </div>
                        <div class="col-lg-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label">Article  Name</label>
                           <select class="form-control" name="ArticleName" id="articlebind">
                           </select>
                        </div>
                          <div class="col-lg-2">
                          
                          <label for="inputEmail3" class="col-lg-12 col-form-label">Status</label>
                           <select class="form-control" name="status" id="Status">
                              <option value="1">All</option>
                              <option value="2">Issued</option>
                              <option value="3">Not Issued</option>
                           </select>
                          </div>
                        <div class="col-lg-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Action</label>
                           <button type="button"  class="btn btn-info"  onclick="stock_summary_search_by_article();" >Search</button>
                        </div>
                        <div class="col-lg-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Action</label>
                           <button type="submit" class="btn btn-info"  onclick="exportAll();" >Export</button>
                         
                        </div>
                     </form>
                     </div>
                  </div>
         
              
            </div>
            <!-- /.card -->
         </div>
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Stockś</h3>
                  <!-- <div class="card-tools">
                     <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);">
                        
                     </div>
                  </div> -->
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive " style="height: 400px;" id="search_record">
                  <table class="table table-head-fixed text-nowrap table-bordered " id="example">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Category Name</th>
                           <th>Article Name</th>
                           <th>Specifications</th>
                          <!--  <th>Oprating System</th>
                           <th>Memory</th> -->
                           <th>Action</th>
                         <th>Action</th>
                        </tr>
                     </thead>
                     <tbody >
                        <?php 
                           $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode inner join category_permissions on category_permissions.CategoryCode=c.ID where category_permissions.employee_id='$EmployeeID' order by IDNo DESC ";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
                           $building_num=$building_num+1;
                           ?>
                        <tr>
                           <td><?=$building_row['IDNo'];?></td>
                           <td><?=$building_row['CategoryName'];?></td>
                           <td><?=$building_row['ArticleName'];?></td>
                       <td><?=$building_row['CPU'];?></td>
                         <!--   <td><?=$building_row['OS'];?></td>
                           <td><?=$building_row['Memory'];?></td> -->
                            <td>
                                  <?php
                                 if($building_row['Status']=="0")
                                  {?>
                              <i class="fa fa-edit fa-lg" onclick="stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal" style="color:red;"></i>
                              <?php
                                 }
                                 else if($building_row['Status']==1)
                                 {
                                  ?>
                                   <i class="fa fa-edit fa-lg" onclick="stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal" style="color:red;"></i>

                              <!-- <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i> -->
                              <?php
                                 }
                                 else
                                 {
                                    ?>  <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i><?php
                                 }
                                 ?>

                           </td> 
                           <td>
                             <?php 
                                 if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                                  {
                                     if($building_row['Status']=="1")
                                    {?>
                              <a class="btn btn-warning btn-xs"  onclick="stock_assign(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_assign" style="color: white;">Available</a>
                              <?php
                                 }
                                 else if($building_row['Status']=="2")
                                 {
                                 ?>
                                    <a class="btn btn-danger btn-xs" data-dismiss="modal" onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:white;">Return</a>
                              <?php  # code...
                                 }
                                 else
                                 {
                                    
                                 }
                                 }
                                 else{
                                 
                                 }  ?>
                                 
                           </td>
                           
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
     
   </div>
  
</section>
<!-- Button trigger modal -->
<div class="modal fade" id="view_assign_stock_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-xl" role="document" >
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
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!--  <button type="submit" class="btn btn-primary">Save</button> -->
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="exampleModal_assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-xl" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Stock Assign </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="15">
            <div class="modal-body" id="stock_samry_assign">
               ...
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-xl" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Stock Details </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="11">
            <div class="modal-body" id="stock_samry">
               ...
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="return_stock_Modal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Return Assigned Stock </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            <div class="modal-body" id="return_stock">
               ...
            </div>
           
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!--  <button type="submit" class="btn btn-primary">Save</button> -->
            </div>
         
      </div>
   </div>
</div>
<script type="text/javascript">
               function billDate(billNo) 
               {
                  
                  var code=99;
                  $.ajax(
               {
                url:"action.php ",
                type:"POST",
                data:
                {
                   code:code,billNo:billNo
                },
                success:function(response) 
                {
                  
                   document.getElementById("billdate").innerHTML =response;  
                }
             });
               }
            
   function return_assigned_stock(id)   
      {
         // var id=id1;
         //var RoomType= document.getElementById("RoomType").value;
         //alert(RoomType);
         var code=47;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,articleID:id
            },
            success:function(response) 
            {
               document.getElementById("return_stock").innerHTML =response;
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

      function returnSubmit(id){
   var code=48;
   var returnRemark= document.getElementById("returnRemark").value;
   var workingStatus= document.getElementById("workingStatus").value;
    if (returnRemark!='' && workingStatus!='') 
    {
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,article_id:id,returnRemark:returnRemark,workingStatus:workingStatus
            },
            success:function(response) 
            {  
               console.log(response);
               // location.reload(true);
            }
         });      
    }
    else
    {
      alert("Enter Remarks and Working Status");

    }





      }
</script>
<?php include "footer.php"; 

?>