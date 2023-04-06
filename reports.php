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
                  <h3 class="card-title">Reports</h3>
               </div>
                  <div class="card-body">

                     <?php
                     if ($permissionCount>0) 
                     {
                        
                     ?>
                     <div class="form-group row">
                        <div class="col-lg-2" style="text-align: center;">

                            <label for="inputEmail3" class="col-lg-12 col-form-label">Spot Wise </label>
                         <div class="form-group row"><div class="col-sm-5">
                          
                           <input type="hidden" name="office_owner_ID" class="form-control" id='office_owner_ID' disabled value="<?=$EmployeeID?>">
                           <button type="submit" class="btn btn-info form-control btn-xs"  onclick="officeFilter()" >My Location</button>
                        </div>
                        <div class="col-sm-7">
                          
                           <input type="hidden" name="office_owner_ID" class="form-control" id='office_owner_ID' disabled value="">
                           <button type="submit" class="btn btn-info form-control btn-xs" data-toggle="modal" data-target="#office_filter_modal" >All Locations</button>
                        </div>
                     </div>
                     </div>
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Employee ID</label>
                              <div class="input-group mb-3">
                                <input type="text" name="EmployeeID" class="form-control" id='emp_ID' placeholder="Employee ID" aria-describedby="button-addon2">
                                <button class="btn btn-info" type="button" id="button-addon2"  onclick="employeeFilter()"><i class="fa fa-search"></i></button>
                              </div>
                        </div>
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Location Owner ID</label>
                           <div class="input-group">
                          <select class="form-control" name="EmployeeID" id='location_owner_ID'  >
                             <option value="">Select</option>
                             <?php
                             $loc_owner_ids_res=mysqli_query($conn,"SELECT distinct location_owner from location_master");
                             while($loc_owner_ids_data=mysqli_fetch_array($loc_owner_ids_res))
                             {   
                              $loc_owner_id=$loc_owner_ids_data['location_owner'];    
                              $stmt_drop_loc_owner = sqlsrv_query($conntest,"SELECT IDNo,Name From Staff where IDNo='$loc_owner_id'");  
                              while($row_staff_show_loc_owner = sqlsrv_fetch_array($stmt_drop_loc_owner, SQLSRV_FETCH_ASSOC) )
                                   {
                                       $IDNo_D=$row_staff_show_loc_owner['IDNo'];
                                       $Name_D=$row_staff_show_loc_owner['Name'];

                                       echo "<option value='".$IDNo_D."'>".$Name_D." (".$IDNo_D.")"."</option>";     
                                   }
                             } 
                             ?>

                          </select>
                          <button  class="btn btn-info" type="button" onclick="locationOwnerFilter()"><i class="fa fa-search"></i></button>
                        </div>

                              <!-- <div class="input-group mb-3">
                                <input  type="text" name="EmployeeID" class="form-control" id='location_owner_ID' placeholder="Location Owner ID"aria-describedby="button-addon2">
                                 <button class="btn btn-info" type="button"   onclick="locationOwnerFilter()">
                                    <i class="fa fa-search"></i>
                                 </button>
                              </div> -->
                        
                        </div>
                        <div class="col-sm-2">
                            <input type="hidden"class="form-control" id='location_ownerID' placeholder="Location Owner ID" value="">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Category</label>
                           <select class="form-control" name="category" id="categorySelect" onchange="ArticleList()">
                              <option value="">Select</option>
                              <?php

                                 $category="SELECT  * , master_calegories.ID as McId FROM category_permissions inner join master_calegories on master_calegories.ID=category_permissions.CategoryCode  where employee_id='$EmployeeID' and category_type_id='1'";
                                 $category_run=mysqli_query($conn,$category);
                                 while ($category_row=mysqli_fetch_array($category_run)) 
                                 { 
                                    
                                    ?>
                                 <option value="<?=$category_row['McId']?>"><?=$category_row['CategoryName']?></option>";
                                 
                                 <?php 
                        
                              }
                                 ?>
                           </select>
                           
                        </div>
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Article</label>
      
                        <div class="input-group">
                          <select class="form-control" name="article" id='ArticleSelect' >
                             <option value="">Select</option>
                          </select>
                          <button  class="btn btn-info" type="button" onclick="categoryFilter()"><i class="fa fa-search"></i></button>
                        </div>
                        </div>
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Ledger</label>
                <!--            <input type="text" name="Emp" class="form-control" id='employee' placeholder="Employee ID">
                           <button type="submit" class="btn btn-info form-control" style="margin-top: 10px;" onclick="employeeLedger()" >Search</button> -->
                        <div class="input-group mb-3">
                          <input type="text" name="Emp" class="form-control" id='employee' placeholder="Employee ID" placeholder="Employee ID" aria-describedby="button-addon2">
                          <button class="btn btn-info" type="button" id="button-addon2"  onclick="employeeLedger()" ><i class="fa fa-search"></i></button>
                        </div>
                        </div>
                     </div>
                     <?php
                  }
                  else
                  {

                     $staffShow="SELECT CollegeName From Staff where IDNo='$EmployeeID'";                  
                     $stmtstaffShow = sqlsrv_query($conntest,$staffShow);  
                     while($row_staff_show = sqlsrv_fetch_array($stmtstaffShow, SQLSRV_FETCH_ASSOC) )
                     {
                        $CollegeName=$row_staff_show['CollegeName'];
                     }

                  ?>

                     <div class="form-group row">
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label">Spot Wise</label>
                           <input type="hidden" name="office_owner_ID" class="form-control" id='office_owner_ID' disabled value="<?=$EmployeeID?>">
                           <button type="submit" class="btn btn-info form-control"  onclick="officeFilter()" >Search</button>
                        </div>
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Employee ID</label>
                          <div class="input-group">
                              <select name="EmployeeID" class="form-control" id='emp_ID' >
                                 <option value="">Select</option>
                                 <option value="<?=$EmployeeID?>"><?=$Emp_Name?> (<?=$EmployeeID?>)</option>
                             <?php
                              $_drop_staff="SELECT IDNo,Name From Staff where LeaveRecommendingAuthority='$EmployeeID' and JobStatus='1'";     
                              $stmt_drop_staff = sqlsrv_query($conntest,$_drop_staff);  
                              while($row_staff_show = sqlsrv_fetch_array($stmt_drop_staff, SQLSRV_FETCH_ASSOC) )
                                   {
                                       $IDNo_Drop=$row_staff_show['IDNo'];
                                       $Name_Drop=$row_staff_show['Name'];

                                       echo "<option value='".$IDNo_Drop."'>".$Name_Drop." (".$IDNo_Drop.")"."</option>";     
                                   }
                             ?>
                              </select>
                              <button  class="btn btn-info" type="button" onclick="employeeFilter()"><i class="fa fa-search"></i></button>
                           </div>
                            </div>
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Location Owner</label>
                           <input type="hidden" name="EmployeeID" class="form-control" id='location_owner_ID' disabled value="<?=$EmployeeID?>">
                           <button type="submit" class="btn btn-info form-control"  onclick="locationOwnerFilter()" >Search</button>
                        </div>
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Category</label>
 <input type="hidden"class="form-control" id='location_ownerID' disabled value="<?=$EmployeeID?>">
                           <select class="form-control" name="category" id="categorySelect" onchange="ArticleList()">
                              <option value="">Select</option>
                              <?php

                                 $category="SELECT  * , master_calegories.ID as McId FROM category_permissions inner join master_calegories on master_calegories.ID=category_permissions.CategoryCode  where employee_id='$EmployeeID' and category_type_id='1'";
                                 $category_run=mysqli_query($conn,$category);
                                 while ($category_row=mysqli_fetch_array($category_run)) 
                                 { 
                                    
                                    ?>
                                 <option value="<?=$category_row['McId']?>"><?=$category_row['CategoryName']?></option>";
                                 
                                 <?php 
                        
                                 }
                                 ?>
                           </select>
                           
                        </div>
                        <div class="col-sm-2">
                           <label for="inputEmail3" class="col-lg-12 col-form-label"> Article</label>
                           <div class="input-group">
  <select class="form-control" name="article" id='ArticleSelect' >
     <option value="">Select</option>
  </select>
  <button  class="btn btn-info" type="button" onclick="categoryFilter()"><i class="fa fa-search"></i></button>
</div>

                        </div>
                              
                        <div class="col-sm-3">
                           
                        </div>
                        <div class="col-sm-3">
                          
                        </div>
                       
                        <div class="col-sm-3">
                         
            
                        </div>
                     </div>
                     <?php 
                  }
                  ?> 
                  </div>
              
            </div>
            <!-- /.card -->
         </div>
         <div class="col-lg-12 col-md-12 col-sm-3" id="search_record">
            
         </div>
       
      </div>
     
   </div>
   <p id="ajax-loader"></p>
   <script type="text/javascript">
                                 function ArticleList()
                                 {
                                    var code='35';
                                     var LocationOwnerID= document.getElementById("location_ownerID").value;
                                    var CategoryID = $("#categorySelect").val();
                                    //alert(CategoryID);
                                    $.ajax({
                                    url:'action.php',
                                    data:{CategoryID:CategoryID,code:code,LocationOwnerID:LocationOwnerID},
                                    type:'POST',
                                    success:function(data){
                                    if(data != "")
                                    {
                                    $("#ArticleSelect").html("");
                                    $("#ArticleSelect").html(data);
                                    }
                                    }
                                    });
                                 }
                                 
                              </script>

                        <script type="text/javascript">
                           function officeFilter()
                           {
                              // var id=id1;
                              var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
                              var officeOwnerID= document.getElementById("office_owner_ID").value;
                              //alert(officeOwnerID);
                              var code=29;
                              $.ajax(
                              {
                                 url:"action.php ",
                                 type:"POST",
                                 data:
                                 {
                                    code:code, officeOwnerID:officeOwnerID
                                 },
                                 success:function(response) 
                                 {
                                    document.getElementById("search_record").innerHTML =response;
                                    spinner.style.display='none';
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
                           function employeeFilter()
                           {
                              // var id=id1;
                              var empID= document.getElementById("emp_ID").value;
                               var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
                              // alert(empID);
                              var code=31;
                              $.ajax(
                              {
                                 url:"action.php ",
                                 type:"POST",
                                 data:
                                 {
                                    code:code,emp_id:empID
                                 },
                                 success:function(response) 
                                 {
                                    document.getElementById("search_record").innerHTML =response;
                                     spinner.style.display='none';
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
                           function employeeLedger()
                           {
                              // var id=id1;
                              var empID= document.getElementById("employee").value;
                              // alert(empID);
                              var code=49;
                              $.ajax(
                              {
                                 url:"action.php ",
                                 type:"POST",
                                 data:
                                 {
                                    code:code,emp_id:empID
                                 },
                                 success:function(response) 
                                 {
                                    document.getElementById("search_record").innerHTML =response;
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
                           function locationOwnerFilter()
                           {
                              // var id=id1;

                              var locationOwnerID= document.getElementById("location_owner_ID").value;
                               var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
                              // alert(locationOwnerID);
                              var code=33;
                              $.ajax(
                              {
                                 url:"action.php ",
                                 type:"POST",
                                 data:
                                 {
                                    code:code,locationOwnerID:locationOwnerID
                                 },
                                 success:function(response) 
                                 {
                                    document.getElementById("search_record").innerHTML =response;
                                     spinner.style.display='none';
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
                           function categoryFilter()
                           {
                              // var id=id1;
                              var CategoryID= document.getElementById("categorySelect").value;
                              var ArticleCode= document.getElementById("ArticleSelect").value;
                               var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
                              var LocationOwnerID= document.getElementById("location_ownerID").value;
                              var code=36;
                              $.ajax(
                              {
                                 url:"action.php ",
                                 type:"POST",
                                 data:
                                 {
                                    code:code,CategoryID:CategoryID, ArticleCode:ArticleCode,LocationOwnerID:LocationOwnerID
                                 },
                                 success:function(response) 
                                 {  
                                    console.log(response);
                                    document.getElementById("search_record").innerHTML =response;
                                     spinner.style.display='none';
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



   <script type="text/javascript">
      function view_office_stock(officeID,RoomType)   
      {
         // var id=id1;
          var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
         //var RoomType= document.getElementById("RoomType").value;
         //alert(RoomType);
         var code=30;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,officeID:officeID,RoomType:RoomType
            },
            success:function(response) 
            {
               document.getElementById("loc_modal_data").innerHTML =response;
                spinner.style.display='none';
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
      
      function view_serial_no(officeID,RoomType)   
      { // var id=id1;
          var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
         //var RoomType= document.getElementById("RoomType").value;
         //alert(RoomType);
         var code=45;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,officeID:officeID,RoomType:RoomType
            },
            success:function(response) 
            {
               document.getElementById("view_serial").innerHTML =response;
                spinner.style.display='none';
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
 function view_emp_stock(empID)   
      {
         // var id=id1;
         //var RoomType= document.getElementById("RoomType").value;
          var spinner=document.getElementById("ajax-loader");
                              
          
                              spinner.style.display='block';


         // alert(empID);
         var code=32;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
             
            data:
            {
               code:code,emp:empID
            },
            success:function(response) 
            {
               document.getElementById("view_assign_employee").innerHTML =response;
                spinner.style.display='none';
               $(document).ajaxStop(function()
               {
                  // window.location.reload();
               });
            }
            
         });
      }
function view_location_owner_stock(empID)   
      {
         // var id=id1;
         //var RoomType= document.getElementById("RoomType").value;
          var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
         //alert(RoomType);
         var code=34;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,emp:empID
            },
            success:function(response) 
            {
               document.getElementById("view_assign_office").innerHTML =response;
                spinner.style.display='none';
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
function view_category_article_stock(CategoryID,ArticleCode,locationID)   
      {
         // var id=id1;
         //var RoomType= document.getElementById("RoomType").value;
          var spinner=document.getElementById("ajax-loader");
                              spinner.style.display='block';
         //alert(RoomType);
         var code=37;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,CategoryID:CategoryID, ArticleCode:ArticleCode, locationID:locationID
            },
            success:function(response) 
            {
               document.getElementById("view_assign_office").innerHTML =response;
                spinner.style.display='none';
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
   <!-- ---------------------------------------------------- -->
  <script type="text/javascript">
     function bulk_select(res)
     { 
         var EmpID= document.getElementById("Employee_ID").value;
         var sr= document.getElementById("serial_no").value;
         for (var i = 0; i < sr; i++) 
         {
            if (res==1)
            {
               document.getElementById('current_owner_'+i).value = EmpID;   
               document.getElementById('current_owner_'+i).disabled = true; 
               document.getElementById('assign_button_'+i).style.display = "none"; 

            }
            else
            {
               document.getElementById('current_owner_'+i).value = "";
               document.getElementById('current_owner_'+i).disabled = false; 
               document.getElementById('assign_button_'+i).style.display = "block"; 
            }
         }
     }
// -----------------------------------------------------
  function remove(id,current_owner,RoomType,location_ID){
var code=28;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{

// location.reload(true);
view_office_stock(location_ID,RoomType);
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code+"&owner="+current_owner, true);
xmlhttp.send();
}
  function singleAssign(id,RoomType,location_ID){
   var code=41;
    //alert(id);
   var sr= document.getElementById("sinlge_assign_sr_"+id).value;
   var current_owner= document.getElementById("current_owner_"+sr).value;
   //alert(current_owner);
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,ID:id,current_owner:current_owner
            },
            success:function(response) 
            {
               console.log(response);

               view_office_stock(location_ID,RoomType);
            }
         });
      }


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
       function bulk_assign_id()
     { 
         var EmpID= document.getElementById("Employee_ID").value;
         var sr= document.getElementById("serial_no").value;
         var current_owner='';
         var id='';
         var code='';
         for (var i = 0; i < sr; i++) 
         {
            code=41;
               current_owner= document.getElementById("current_owner_"+i).value;
               id= document.getElementById("assign_"+i).value;
               // alert(current_owner);
               // alert(id);

            $.ajax(
               {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,ID:id,current_owner:current_owner
            },
            success:function(response) 
            {
               location.reload(true);
            }
         });
 
         }
     }

     function fault_description(id){
   var code=42;
   // alert(id);
   //var sr= document.getElementById("sinlge_assign_sr_"+id).value;
   //var current_owner= document.getElementById("current_owner_"+sr).value;
   // alert(current_owner);
   var page=1;
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

      function emp_detail_verify(id,a,b_id){
   var code=51;
    //alert(a);
    if (a!=2) 
    {
      var sr= document.getElementById("sinlge_assign_sr_"+b_id).value;
     //alert(sr);
  }
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
               if (a==2) 
               {
                  document.getElementById("emp_detail_status_").innerHTML =response;
               }
               else 
               {
                  document.getElementById("emp_detail_status_"+sr).innerHTML =response;
               }
            }
         });
      }
   function Article_Num(id,location_ID,RoomType){
   var code=59;
    // alert(location_ID);
      $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,location_ID:location_ID,RoomType:RoomType
            },
            success:function(response) 
            {  
              document.getElementById("search_office_data").innerHTML =''; 
              document.getElementById("search_office_data").innerHTML =response; 
            }
         });
      }
 function Article_Num_emp(id,empID){
   var code=60;
     //alert(id+empID);
      $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:id,empID:empID
            },
            success:function(response) 
            {  
              document.getElementById("table_emp_search_modal").innerHTML =''; 
              document.getElementById("table_emp_search_modal").innerHTML =response; 
            }
         });
      }
      function floorSelect(building)
      {
            // alert(building);
                      $("#roomSelectList").html("");
         
         var code='91';
           $.ajax({
             url:'action.php',
             data:{hostel:building,code:code},
             type:'POST',
             success:function(data){
                 if(data != "")
                 {
                     $("#floor").html("");
                     $("#floor").html(data);
                 }
             }
           });
        }
         function roomSelect(floor)
         {
                                       // alert(floor);
         var spotBuilding=document.getElementById("spotBuilding").value;
         var code='71';
         $.ajax({
              url:'action.php',
              data:{floor:floor,code:code,hostel:spotBuilding},
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
function spotFilter()
{
   // var id=id1;
   var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
   var room= document.getElementById("roomSelectList").value;
   var building= document.getElementById("spotBuilding").value;
   var floor= document.getElementById("floor").value;
   // var officeOwnerID= document.getElementById("office_owner_ID").value;
   //alert(officeOwnerID);
   var code=199;
   $.ajax(
   {
      url:"action.php ",
      type:"POST",
      data:
      {
         code:code, room:room,building:building,floor:floor
      },
      success:function(response) 
      { 
         $('#office_filter_modal').modal('toggle');
         document.getElementById("search_record").innerHTML =response;
         spinner.style.display='none';
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


function nodues(id)
{
   // var id=id1;
   //alert(id);
   var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
  
   var code=233;
   $.ajax(
   {
      url:"action.php ",
      type:"POST",
      data:
      {
         code:code,id:id
      },
      success:function(response) 
      { 
         
         document.getElementById("noduesdata").innerHTML =response;
         spinner.style.display='none';
        
      },
      error:function()
      {
         alert("error");
      }
   });
}

function cleardues(id)
{
    var id=id;
   //alert(id);
   var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
  
   var code=234;
   $.ajax(
   {
      url:"action.php ",
      type:"POST",
      data:
      {
         code:code,id:id
      },
      success:function(response) 
      { 
         
         document.getElementById("noduesreponse").innerHTML =response;
         spinner.style.display='none';
        
      },
      error:function()
      {
         alert("error");
      }
   });
}






  </script>
<!-- --------------------------------------------------------------------- -->

</section>
<!-- Button trigger modal -->
<?php
// print_r($categoryPermissions);
?>


<div class="modal fade" id="noduesmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
<div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">No Dues</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div id="noduesdata">
            
         </div>

   </div>
   </div>
</div>














<div class="modal fade" id="view_assign_stock_office_Modal_location" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
<div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Stock Assigned</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div id="loc_modal_data">
            
         </div>

   </div>
   </div>
</div>
<div class="modal fade" id="office_filter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
<div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Select Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-sm-3 col-lg-3 col-md-3">
                  <select id='spotBuilding' class="form-control" onchange="floorSelect(this.value)">
                     <optgroup label="Select Building">
                        <option value="">All</option>
                        <?php
                        $sql="SELECT distinct Block,Name from location_master lm inner join building_master bm on bm.ID=lm.Block order by Name asc";
                        $res=mysqli_query($conn,$sql);
                        while($data=mysqli_fetch_array($res))
                        {
                           ?>
                           <option value="<?=$data['Block']?>"><?=$data['Name']?></option>
                           <?php 
                        } 
                        ?>
                     </optgroup>
                  </select>
               </div>
               <div class="col-sm-3 col-lg-3 col-md-3">
                  <select id='floor' class="form-control" onchange="roomSelect(this.value)">
                     
                  </select>
               </div>
               <div class="col-sm-3 col-lg-3 col-md-3">
                  <select id='roomSelectList' class="form-control">
                     
                  </select>
               </div>
               <div class="col-sm-3 col-lg-3 col-md-3">
                  <button class="btn btn-info form-control" onclick="spotFilter()">Search</button>
               </div>
            </div>
            
         </div>

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
<div class="modal fade" id="view_assign_stock_employee_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Stock Assigned to Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
            <div class="modal-body" id="view_assign_employee" >
               
            
            </div>
           
            <div class="modal-footer">
              
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!--  <button type="submit" class="btn btn-primary">Save</button> -->
            </div>
         
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
<div class="modal fade" id="return_stock_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
<?php include "footer.php"; 
?>