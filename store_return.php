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
               <h3 class="card-title">Return Articles</h3>
               <div class="card-tools">
               </div>
            </div>
            <div class="card-body table-responsive " >
                <div class="row">
               <div class="col-lg-12">
<div  id="message"  style="text-align: center;">
                  </div>   
          <div class="row">
 <div class="col-sm-12" style="text-align:left;" id ="data">
            <div id="live_data"></div>
          </div>

 

              <div class="col-lg-3">
                    <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $a; ?>">

<label >Category</label>
              <select class="form-control" id ="category" required="">

                <option value="">Select Category</option>  
                <?php 

                 //$rresult = mysqli_query($connection_s,"SELECT DISTINCT category FROM item_category");
             
                $rresult = mysqli_query($connection_s,"SELECT DISTINCT category_name FROM request where  emp_id='$a'");
                while($row=mysqli_fetch_array($rresult)) 
                {
                ?>
                    <option value="<?php echo $row['category_name']; ?>"><?php echo $row['category_name']; ?></option>
                <?php 
                }
                ?>

              </select> 
                
              </div>

               

              <div class="col-lg-3">
                <label >Article</label>
                <select class="form-control" id="item_name">
                <option>Select Article </option>
              </select> 
               
              </div>
              <div class="col-lg-2">
                <label >Quantity</label>
               <input type="number" name="text" placeholder="Quanity" min="1" id="quantity" class="form-control">
               <input type="hidden" name="text"  value="<?php echo $a;?>" id="emp_id" class="form-control">

               </div>
                <div class="col-lg-2">
                   <label >Specification</label>
               <input type="text"  placeholder="Specification" id="specification" class="form-control">
             

               </div>
               <div class="col-lg-1">
                <label ><br></label>
           <input type="button" name="submit" id="add_return" class="btn btn-primary" value="Add">

               </div>
            </div>


                  </div>
              </div>
      
           <br>
               <div class="row">
               <div class="col-lg-12" id="show_request">
               </div>
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
                  <a class="nav-link" data-toggle="pill" href="#d5" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" >
                  Pending</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#d6" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">
                  Accepted</a>
               </li>
             
            </ul>
            <div class="card-body table-responsive " >
               <div class="col-lg-12">
                  <div class="list-group"><br/></div>
                  <div class="tab-content">
 <div id="d5" class="tab-pane fade in  active " >    
<?php   
 $list_sql = "SELECT * FROM ledger_return where emp_id='$a' AND request_status='pending'  ORDER BY ID DESC ";
$result = mysqli_query($connection_s,$list_sql); ?> 
<table class="table">
        <th>Request No</th><th>Department</th><th>Date</th>
        <?php 
 
 while($row = mysqli_fetch_array($result))  
      {  

$originalDate=$row['submit_date'];
        $newDate = date("d-m-Y", strtotime($originalDate));
?>
      <tr>
          <td style="width: 50px;text-align: center;">
           <a href="#"  onClick="fetch_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>
             </td> 
             <td><?php  if($row['designation']=='Dean'){

            echo  $row['college'];
          }
          else
          {
            echo  $row['college_dept'];
          }?></td><td>  <?php echo $newDate; ?></td>
 </tr>
<?php
      }
?>
</table>
          </div>
 <div id="d6" class="tab-pane fade in  ">
  <?php   
 $list_sql = "SELECT * FROM ledger_return where emp_id='$a' AND request_status='Accepted'  ORDER BY ID DESC ";
$result = mysqli_query($connection_s,$list_sql); ?> 

<table class="table">
        <th>Request No</th><th>Department</th><th>Date</th>
        <?php 
 
 while($row = mysqli_fetch_array($result))  
      {  

$originalDate=$row['submit_date'];
        $newDate = date("d-m-Y", strtotime($originalDate));
?>
      
      <tr>
          <td style="width: 50px;text-align: center;"> <a href="#"  onClick="accepted_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td> <td>  <?php echo  $row['college_dept'];?></td><td>  <?php echo $newDate; ?></td>
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
  xmlhttp.open("GET", "store/fetch_return.php?reference_no="+reference_no, true);
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
  xmlhttp.open("GET", "store/approved_request.php?reference_no="+reference_no, true);
    xmlhttp.send();
}



function accepted_request(reference_no) 
{ 

  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("show_request").innerHTML=xmlhttp.responseText;
    }
    }
  xmlhttp.open("GET", "store/accepted_quantity.php?reference_no="+reference_no, true);
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
  xmlhttp.open("GET", "store/issued_request.php?reference_no="+reference_no, true);
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
    <!-- delete  user  -->
function delete_dr(user_id) 
{   
    
    var r = confirm("Do you  really want to Delete");
    if(r == true) {
    
        window.location.href ="store/delete_return.php?user_id="+user_id;
    } else {
        return;
    }
}


    </script>
<script>
     $(function() { 
      $("#category").change(function(e) {
        e.preventDefault();
        var category = $("#category").val();
        var emp_id=$("#emp_id").val();
        var code = "124";
            $.ajax({
            url:'store/category_action.php',
            data:{category:category,code:code,emp_id:emp_id},
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
<script>
     $(function() { 
      $("#add_return").click(function(e) {
        e.preventDefault();
        var category = $("#category").val();
        var item = $("#item_name").val();
        var emp_id = $("#emp_id").val();
        var quantity=$("#quantity").val();
        var specification=$("#specification").val();

       var code = "102";
            $.ajax({
            url:'store/category_action.php',
            data:{category:category,item:item,emp_id:emp_id,specification:specification,quantity:quantity,code:code},
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
                url:"store/my_return.php", 
        data:{emp_id:emp_id},
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
$(document).ready(function(){
  function fetch_data()  
    {  
    var emp_id = $("#emp_id").val();
        $.ajax({  
                url:"store/my_return.php", 
        data:{emp_id:emp_id},       
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
        });  
    } 
  fetch_data();
});
  </script>

<?php 
   include "footer.php";
   
   
   ?>