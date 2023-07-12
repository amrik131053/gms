<?php
session_start();
    include '../connection/connection.php';
  

    
if(!(ISSET($_SESSION['usr']))) {
header('Location:index.php');	
	
}

else
{
  $a=$_SESSION['usr'];
    $u_permissions = "";
    $u_permissions = $_SESSION['u_permissions'];
    $permissions_array ="";
    $permissions_array = explode(",",$u_permissions);
    $file = basename($_SERVER['PHP_SELF']);
    $id = "";
    $result = mysqli_query($connection1,"SELECT id from permissions WHERE page_link = '$file'");
    while($row=mysqli_fetch_array($result))
    {
        $id = $row['id'];

    }
    if(!in_array($id,$permissions_array))
    {
        //echo $file;
        //header('Location:not_found.php');
    }
?>									


<!DOCTYPE html><head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link  rel="stylesheet"  href="../css/bootstrap.css" >
<link rel="stylesheet" href="../css/bootstrap.min.css" >
<link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
<link  rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script>

function approving_request(reference_no) 
{ 
 
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("show_request").innerHTML=xmlhttp.responseText;
    }
    }
  xmlhttp.open("GET", "approve_request_validate.php?reference_no=" + reference_no, true);
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
  xmlhttp.open("GET", "approved_request.php?reference_no=" + reference_no, true);
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
  xmlhttp.open("GET", "issued_request.php?reference_no=" + reference_no, true);
    xmlhttp.send();
}

</script>
<script>
  <!-- delete  user  -->
function cancel_request(user_id) 
{ 
  
  var r = confirm("Do you really want to Cancel Request");
  if(r == true) {
  
    window.location.href ="cancel_request_app.php?user_id=" + user_id ;
  } else {
    return;
  }
}


  </script>
<script>







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
	<!-- update  user  -->
function edit_user(user_id) 
{	


var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("edit_user").innerHTML=xmlhttp.responseText;
		
        }
    }
	   xmlhttp.open("GET", "edit_user.php?user_id=" + user_id, true);
        xmlhttp.send();

	
	}
	
	</script>


<script>
	<!-- delete  user  -->
function delete_dr(user_id) 
{	
	
	var r = confirm("Do you really want to Delete");
	if(r == true) {
	
		window.location.href ="delete_article.php?user_id=" + user_id;
	} else {
		return;
	}
}


	</script>



<script>
	<!-- Show user  -->
function reset_user(user_id) 
{	
	var r = confirm("Do you really want to reset defaut password ");
	if(r == true) {
	
		window.location.href ="reset_user.php?user_id=" + user_id;
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
  xmlhttp.open("GET", "permi.php?user_id=" + user_id, true);
  xmlhttp.send();
}

</script>
<script src="../js/bootstrap.min.js"   type="text/javascript"></script>

</head>

<title>Guru Kashi University
</title>
 <body>
 <div class="container-fluid">
 
     <?php include'../header.php';?>

        <div class="row" style="min-height:500px;">
          <div class="col-lg-3">
         <div class="panel panel-primary">
            
                <div class="panel-heading" style="height: 40px"><p>Request Status</p>
                   </div>

              <!-- Table -->
                <div class="list-group"><br/>

                  <ul class="nav nav-pills ">
            <li class="active"><a href="#d5" data-toggle="pill">Pending</a></li>
            <li><a href="#d2" data-toggle="pill">Approved</a></li>
            <li><a href="#d3" data-toggle="pill">Issued</a></li>
         
            
          </ul>
 
  
</div>      
         
 <div class="tab-content">

 <div id="d5" class="tab-pane fade in  active over_flow" >
           
<?php   
 $list_sql = "SELECT * FROM ledger where  request_status='verified'  ORDER BY ID DESC ";
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
          <td style="width: 50px;text-align: center;"> <a href="#" <a href="#" onClick="approving_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td> <td>  <?php echo  $row['college_dept'];?></td><td>  <?php echo $newDate; ?></td><td style="width: 50px;text-align: center;"> <a href="#" <a href="#" onClick="cancel_request(<?php echo $row['id'];?>)"> Cancel </a>  </td>
 </tr>

<?php



      }



?>
</table>

          </div>





 <div id="d2" class="tab-pane fade in over_flow ">



  <?php   
 $list_sql = "SELECT * FROM ledger where  request_status='approved'  ORDER BY ID DESC ";
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
          <td style="width: 50px;text-align: center;"> <a href="#" <a href="#" onClick="approved_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td> <td>  <?php echo  $row['college_dept'];?></td><td>  <?php echo $newDate; ?></td>
 </tr>

<?php



      }



?>
</table>
</div>
       


         <div id="d3" class="tab-pane fade in over_flow ">
        <?php   
 $list_sql = "SELECT * FROM ledger where  request_status='issued'  ORDER BY ID DESC ";
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
          <td style="width: 50px;text-align: center;"> <a href="#" <a href="#" onClick="issued_request(<?php echo $row['reference_no'];?>)"> <?php echo  $row['id'];?> </a>  </td> <td>  <?php echo  $row['college_dept'];?></td><td>  <?php echo $newDate; ?></td>
 </tr>

<?php



      }



?>
</table>


          </div>


</div>


</div>
</div>
 <div class="col-lg-1"  ">
   
       
</div>
  <div class="col-lg-7"  id="show_request">
   
       
</div>

</div>



          </div>



   
<?php include '../footer.php';?>

<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
     $(function() { 
      $("#category").change(function(e) {
        e.preventDefault();

        var category = $("#category").val();
        var code = "1";
            $.ajax({
            url:'category_action.php',
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


<script>
     $(function() { 
      $("#add_request").click(function(e) {
        e.preventDefault();


        var category = $("#category").val();
        var item = $("#item_name").val();
        var emp_id = $("#emp_id").val();
        var quantity=$("#quantity").val();
        var specification=$("#specification").val();

       var code = "2";
            $.ajax({
            url:'category_action.php',
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
                url:"my_request.php", 
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


$(document).ready(function(){
  function fetch_data()  
    {  
    var emp_id = $("#emp_id").val();
        $.ajax({  
                url:"my_request.php", 
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








</body>
</html>
<?php 

}
?>