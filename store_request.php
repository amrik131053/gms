<!-- Main content -->
<?php 
   include "header.php";
   // include "connection/connection.php";
   
   $a=$EmployeeID;
   ?>
<section class="content">
   <div class="row">
      <div class="col-lg-8">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">All Requests</h3>
               <div class="card-tools">
               </div>
            </div>
            <div class="card-body table-responsive " >
               <div class="col-lg-12">
                  <div class="panel panel-primary">
                     <!-- Default panel contents -->
                     <div class="row panel-heading">
                        <h4>Request Articles</h4>
                     </div>
                     <br/>
                     <div  id="message"  style="text-align: center;">
                     </div>
                     <?php 
                        //$rresult = mysqli_query($connection_s,"SELECT DISTINCT category FROM item_category");
                        
                        $rresult = mysqli_query($conn,"SELECT *  FROM user where emp_id='$a'");
                        while($row=mysqli_fetch_array($rresult)) 
                        {
                        
                           $name=$row['name'];
                           $dep=$row['department'];
                        
                        }
                        ?>    
                     <div class="row">
                        <div class="col-sm-12" style="text-align:left;" id ="data">
                           <div id="live_data"></div>
                        </div>
                        <div class="col-lg-3">
                           <lable ><b>Category</b></lable>
                           <?php
                              if($a=='121031'|| $a=='131053'||$a =='170129'||$a=='170675'||$a=='170236'||$a=='101155'||$a=='121400')
                              {
                              ?>
                           <select class="form-control" id ="category" required="">
                              <option value="">Select Category</option>
                              <?php 
                                 $rresult = mysqli_query($connection_s,"SELECT DISTINCT category FROM item_category");
                                 
                                 // $rresult = mysqli_query($connection_s,"SELECT DISTINCT category FROM master_stock where category='Stationery'");
                                 while($row=mysqli_fetch_array($rresult)) 
                                 {
                                 ?>
                              <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                              <?php 
                                 }
                                 ?>
                           </select>
                           <?php }/*else if($a =='170129'){?>
                           <select class="form-control" id ="category" required="">
                              <option value="">Select Category</option>
                              <option value="Stationery">Stationery</option>
                              <option value="Electrical"> Electrical</option>
                              <option value="Carpentory"> Carpentory</option>
                           </select>
                           <?php
                            // }
                              else if($a=='170675'){?>
                           <select class="form-control" id ="category" required="">
                              <option value="">Select Category</option>
                              <option value="Stationery">Stationery</option>
                              <option value="Carpentory"> Carpentory</option>
                              <option value="Plumbing"> Plumbing</option>
                              <option value="Miscellaneous">Miscellaneous</option>
                              <option value="Electrical"> Electrical</option>
                           </select>
                           <?php }*/
                              else
                              {
                              ?>
                           <select class="form-control" id ="category" required="">
                              <option value="">Select Category</option>
                              <option value="Stationery">Stationery</option>
                              <option value="Information Technology">Information Technology</option>
                              <option value="Miscellaneous">Miscellaneous</option>
                              <option value="House Keeping">House Keeping</option>
                              <option value="Sports">Sports</option>
                           </select>
                           <?php 
                              }
                              ?>
                           <br/>
                           <br> 
                        </div>
                        <div class="col-lg-3">
                           <lable ><b>Article</b></lable>
                           <select class="form-control" id="item_name">
                              <option>Select Article </option>
                           </select>
                           <br/>
                        </div>
                        <div class="col-lg-2">
                           <lable ><b>Quantity</b></lable>
                           <input type="number"  placeholder="Quanity" id="quantity"  min="1"  class="form-control">
                           <input type="hidden" name="text"  value="<?php echo $a;?>" id="emp_id" class="form-control">
                           <input type="hidden" name="text"  value="<?php echo $dep;?>" id="department" class="form-control">
                           <input type="hidden" name="text"  value="<?php echo $name;?>" id="name" class="form-control">
                        </div>
                        <div class="col-lg-2">
                           <lable ><b>Specification</b></lable>
                           <input type="text"  placeholder="Specification" id="specification" class="form-control">
                        </div>
                        <div class="col-lg-1">
                           <lable ><b><br></b></lable>
                           <input type="button" name="submit" id="add_request" style="border-radius: 20px" placeholder="submit" class="btn-primary" value="Add">
                        </div>
                     </div>
                  </div>
               </div>
               <div id="show_request">
               </div>
               <!-- ------------- -->
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card" >
            <div class="card-header">
               <h3 class="card-title">Details</h3>
               <div class="card-tools">
               </div>
            </div>
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active"  data-toggle="pill" href="#dd5" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" >
                  Draft</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#d5" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" >
                  Pending</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#d6" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">
                  Verified</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#d2" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" >
                  Approved</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#d3" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" >
                  Issued</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#cancel" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" >
                  Canceled</a>
               </li>
            </ul>
            <div class="card-body table-responsive " >
               <div class="col-lg-4">
                  <div class="list-group"><br/></div>
                  <div class="tab-content">
                     <div id="d5" class="tab-pane fade in  active over_flow" >
                        <?php   
                           $list_sql = "SELECT * FROM ledger where emp_id='$a' AND request_status='pending'  ORDER BY ID DESC ";
                           $result = mysqli_query($connection_s,$list_sql); ?> 
                        <table class="table">
                           <th>Request No</th>
                           <th>Department</th>
                           <th>Date</th>
                           <th>Action</th>
                           <?php 
                              while($row = mysqli_fetch_array($result))  
                                   {  
                              
                              $originalDate=$row['submit_date'];
                                     $newDate = date("d-m-Y", strtotime($originalDate));
                              ?>
                           <tr>
                              <td style="width: 50px;text-align: center;"> <a href="#" onClick="fetch_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td>
                              <td><?php  if($row['designation']=='Dean'){
                                 echo  $row['college'];
                                 }
                                 else
                                 {
                                 echo  $row['college_dept'];
                                 }?></td>
                              <td >  <?php echo $newDate; ?></td>
                              <td style="text-align: center;"> <a href="#" onclick="delete_request(<?php echo $row["id"];?>)"  class="fa fa-trash" data-target=".bs-delete-model-sm" style="color:red" data-toggle="tooltip"  data-placement="top" title="Delete"></a></td>
                           </tr>
                           <?php
                              }
                              
                              
                              
                              ?>
                        </table>
                     </div>
                     <div id="dd5" class="tab-pane fade in   over_flow" >
                        <?php   
                           $list_sql = "SELECT * FROM ledger where emp_id='$a' AND request_status='recommending'  ORDER BY ID DESC ";
                           $result = mysqli_query($connection_s,$list_sql); ?> 
                        <table class="table">
                           <th>Request No</th>
                           <th>Department</th>
                           <th>Date</th>
                           <th>Action</th>
                           <?php 
                              while($row = mysqli_fetch_array($result))  
                                   {  
                              
                              $originalDate=$row['submit_date'];
                                     $newDate = date("d-m-Y", strtotime($originalDate));
                              ?>
                           <tr>
                              <td style="width: 50px;text-align: center;">  <a href="#" onClick="fetch_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td>
                              <td><?php  if($row['designation']=='Dean'){
                                 echo  $row['college'];
                                 }
                                 else
                                 {
                                 echo  $row['college_dept'];
                                 }?></td>
                              <td>  <?php echo $newDate; ?></td>
                              <td style="text-align: center;"> <a href="#" onclick="delete_request(<?php echo $row["id"];?>)"  class="fa fa-trash" data-target=".bs-delete-model-sm" style="color:red" data-toggle="tooltip"  data-placement="top" title="Delete"></a></td>
                           </tr>
                           <?php
                              }
                              
                              
                              
                              ?>
                        </table>
                     </div>
                     <div id="d2" class="tab-pane fade in over_flow ">
                        <?php   
                           $list_sql = "SELECT * FROM ledger where emp_id='$a' AND request_status='approved'  ORDER BY ID DESC ";
                           $result = mysqli_query($connection_s,$list_sql); ?> 
                        <table class="table">
                           <th>Request No</th>
                           <th>Department</th>
                           <th>Date</th>
                           <?php 
                              while($row = mysqli_fetch_array($result))  
                                   {  
                              
                              $originalDate=$row['submit_date'];
                                     $newDate = date("d-m-Y", strtotime($originalDate));
                              ?>
                           <tr>
                              <td style="width: 50px;text-align: center;"> <a href="#" onClick="approved_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td>
                              <td>  <?php echo  $row['college_dept'];?></td>
                              <td>  <?php echo $newDate; ?></td>
                           </tr>
                           <?php
                              }
                              
                              
                              
                              ?>
                        </table>
                     </div>
                     <div id="d6" class="tab-pane fade in over_flow ">
                        <?php   
                           $list_sql = "SELECT * FROM ledger where emp_id='$a' AND request_status='verified'  ORDER BY ID DESC ";
                           $result = mysqli_query($connection_s,$list_sql); ?> 
                        <table class="table">
                           <th>Request No</th>
                           <th>Department</th>
                           <th>Date</th>
                           <?php 
                              while($row = mysqli_fetch_array($result))  
                                   {  
                              
                              $originalDate=$row['submit_date'];
                                     $newDate = date("d-m-Y", strtotime($originalDate));
                              ?>
                           <tr>
                              <td style="width: 50px;text-align: center;"> <a href="#"  onClick="verified_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td>
                              <td>  <?php echo  $row['college_dept'];?></td>
                              <td>  <?php echo $newDate; ?></td>
                           </tr>
                           <?php
                              }
                              
                              
                              
                              ?>
                        </table>
                     </div>
                     <div id="d3" class="tab-pane fade in over_flow ">
                        <?php   
                           $list_sql = "SELECT * FROM ledger where emp_id='$a' AND request_status='issued'  ORDER BY ID DESC ";
                           $result = mysqli_query($connection_s,$list_sql); ?> 
                        <table class="table">
                           <th>Request No</th>
                           <th>Department</th>
                           <th>Date</th>
                           <?php 
                              while($row = mysqli_fetch_array($result))  
                                   {  
                              
                              $originalDate=$row['submit_date'];
                                     $newDate = date("d-m-Y", strtotime($originalDate));
                              ?>
                           <tr>
                              <td style="width: 50px;text-align: center;"> <a href="#"  onClick="issued_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td>
                              <td>  <?php echo  $row['college_dept'];?></td>
                              <td>  <?php echo $newDate; ?></td>
                           </tr>
                           <?php
                              }
                              
                              
                              
                              ?>
                        </table>
                     </div>
                     <div id="cancel" class="tab-pane fade in over_flow ">
                        <?php   
                           $list_sql = "SELECT * FROM ledger where emp_id='$a' AND request_status='Canceled'  ORDER BY ID DESC ";
                           $result = mysqli_query($connection_s,$list_sql); ?> 
                        <table class="table">
                           <th>Request No</th>
                           <th>Department</th>
                           <th>Date</th>
                           <?php 
                              while($row = mysqli_fetch_array($result))  
                                   {  
                              
                              $originalDate=$row['submit_date'];
                                     $newDate = date("d-m-Y", strtotime($originalDate));
                              ?>
                           <tr>
                              <td style="width: 50px;text-align: center;"> <a href="#"  onClick="issued_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td>
                              <td>  <?php echo  $row['college_dept'];?></td>
                              <td>  <?php echo $newDate; ?></td>
                           </tr>
                           <?php
                              }
                              
                              
                              
                              ?>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
   function printdiv() 
   {
   
   var divToPrint=document.getElementById('printrel');
   
   var newWin=window.open('','Print-Window');
   
   newWin.document.open();
   
   newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
   
   
   
   newWin.document.write('<style>.table {width: 100%;max-width: 100%;margin-bottom: 20px;border-collapse: collapse;font-size:14px;}.table tr td{border: 0px solid #000;padding:5px;} #printbtn{display:none;} .page { size: auto;  size: A4 portrait;  margin: 0;  border: 1px solid red}') ;  
   
   
   newWin.document.close();
   
   setTimeout(function(){newWin.close();},10);
   
   }
</script>
<script>
   function fetch_request(reference_no) 
   { 
   
     var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState==4 && xmlhttp.status==200)
       {
         document.getElementById("show_request").innerHTML=xmlhttp.responseText;
       }
       }
     xmlhttp.open("GET", "../gkuadmin/store/fetch_request.php?reference_no=" + reference_no, true);
       xmlhttp.send();
   }
   
   
   function approved_request(reference_no) 
   { 
   
     var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState==4 && xmlhttp.status==200)
       {
         document.getElementById("show_request").innerHTML=xmlhttp.responseText;
       }
       }
     xmlhttp.open("GET", "../gkuadmin/store/approved_request.php?reference_no=" + reference_no, true);
       xmlhttp.send();
   }
   
   
   
   function verified_request(reference_no) 
   { 
   
     var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState==4 && xmlhttp.status==200)
       {
         document.getElementById("show_request").innerHTML=xmlhttp.responseText;
       }
       }
     xmlhttp.open("GET", "../gkuadmin/store/varified_quantity.php?reference_no=" + reference_no, true);
       xmlhttp.send();
   }
   
   
   
   function issued_request(reference_no) 
   { 
   
     var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState==4 && xmlhttp.status==200)
       {
         document.getElementById("show_request").innerHTML=xmlhttp.responseText;
       }
       }
     xmlhttp.open("GET", "../gkuadmin/store/issued_request.php?reference_no=" + reference_no, true);
       xmlhttp.send();
   }
   
   
   
   
   $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip(); 
   });
</script>
<style> 
   .over_flow {
   height: 530px;
   overflow: scroll;
   }
</style>
<script>
   function edit_user(user_id) 
   {   
   var xmlhttp = new XMLHttpRequest();
           xmlhttp.onreadystatechange = function() {
               if (xmlhttp.readyState==4 && xmlhttp.status==200)
           {
           document.getElementById("edit_user").innerHTML=xmlhttp.responseText;
           
           }
       }
          xmlhttp.open("GET", "../gkuadmin/store/edit_user.php?user_id=" + user_id, true);
           xmlhttp.send();
   
       
       }
       
   
   function delete_request(user_id) 
   { 
     
     var r = confirm("Do you really want to Delete");
     if(r == true) {
     
     
       window.location.href ="../gkuadmin/store/delete_request.php?user_id=" + user_id;
     } else {
       return;
     }
   }
   
   function delete_dr(user_id) 
   {   
       
       var r = confirm("Do you really want to Delete");
       if(r == true) {
       
           window.location.href ="../gkuadmin/store/delete_article.php?user_id=" + user_id;
       } else {
           return;
       }
   }
   
   function reset_user(user_id) 
   {   
       var r = confirm("Do you really want to reset defaut password ");
       if(r == true) {
       
           window.location.href ="../gkuadmin/store/reset_user.php?user_id=" + user_id;
       } else {
           return;
       }
   }
   function givep(user_id)
   {
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState==4 && xmlhttp.status==200)
       {
         document.getElementById("permissions").innerHTML=xmlhttp.responseText;
       }
     }
     xmlhttp.open("GET", "../gkuadmin/store/permi.php?user_id=" + user_id, true);
     xmlhttp.send();
   }
   
</script>
<script>
   $(document).ready(function () {
         $("#ckbCheckAll1").click(function () {
             $(".checkBoxClass").prop('checked', $(this).prop('checked'));
         });
     });
   
</script>
<script>
   $(function() { 
    $("#category").change(function(e) {
      e.preventDefault();
   
      var category = $("#category").val();
      var code = "123";
          $.ajax({
          url:'../gkuadmin/store/category_action.php',
          data:{category:category,code:code},
          type:'POST',
          success:function(data){
              if(data != "")
              {
                  $("#item_name").html("");
                  $("#item_name").html(data);
              }
   
   
   
   
          }
        });
   });
   });
</script>
<!-- <script src="http://gurukashiuniversity.co.in/gkuadmin/js/jquery.min.js" type="text/javascript"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script> -->
<script>
   $(function() { 
    $("#add_request").click(function(e) {
      e.preventDefault();
      var category = $("#category").val();
      var item = $("#item_name").val();
      var emp_id = $("#emp_id").val();
      var department = $("#department").val();
      var name = $("#name").val();
      var quantity=$("#quantity").val();
      var specification=$("#specification").val();
   
     var code = "2";
          $.ajax({
          url:'../gkuadmin/store/category_action.php',
          data:{category:category,item:item,emp_id:emp_id,department:department,name:name,specification:specification,quantity:quantity,code:code},
          type:'POST',
          success:function(data){
              if(data != "")
              {
                  $("#message").html("");
                  $("#message").html(data);
   
   
                  $('#specification').val("");
                  $('#quantity').val("");
                   $('#category').val("");
                 
   
   
              }
              
          
           $.ajax({  
              url:"../gkuadmin/store/my_request.php", 
      data:{emp_id:emp_id,code:code},
              method:"POST",  
              success:function(data){  
                   $('#live_data').html(data);  
              }  
         });
         
      }
   
   
   
   
   
   
        });
   });
   });
</script>
<script>
   $( document ).ready(function() {
   
   var emp_id = $("#emp_id").val();
         var code = "2";
         
   $.ajax({  
                 url:"../gkuadmin/store/my_request.php", 
         data:{emp_id:emp_id,code:code},
                 method:"POST",  
                 success:function(data){  
                      $('#live_data').html(data);  
                 }  
            });
   
   });
   
</script>
<script>
   $(document).ready(function(){
     function fetch_data()  
       {  
        var code = "2";
       var emp_id = $("#emp_id").val();
           $.ajax({  
                   url:"../gkuadmin/store/my_request.php", 
           data:{emp_id:emp_id,code:code},       
                   method:"POST",  
                   success:function(data){  
                        $('#live_data').html(data);  
                   }  
           });  
       } 
     fetch_data();
   });
     
</script>
<!-- /.content -->
<?php 
   include "footer.php";
   
   
   ?>