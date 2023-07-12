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
    $file = 'http://gurukashiuniversity.co.in/gkuadmin/store/request_form.php';
    $id = "";
    $result = mysqli_query($connection1,"SELECT id from permissions WHERE page_link = '$file'");
    while($row=mysqli_fetch_array($result))
    {
        $id = $row['id'];

    }
    if(!in_array($id,$permissions_array))
    {
        echo $file;
        header('Location:not_found.php');
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






<style> 
 .over_flow {
  
   
    height: 530px;
    overflow: scroll;
}
  </style>



<script src="../js/bootstrap.min.js"   type="text/javascript"></script>

</head>

<title>Guru Kashi University
</title>
 <body>
 <div class="container-fluid">
 
     <?php include'../header.php';?>

        <div class="row" style="min-height:600px;">
         
 
<div class="col-lg-5">

<lable ><b>Issued Reports</b></lable><br><br>
  <div class="col-lg-4">

<lable ><b>Category</b></lable>
              <select class="form-control" id ="category" required="">

                <option value="">Select Category</option>  
                <?php                              
                $rresult = mysqli_query($connection_s,"SELECT DISTINCT category FROM master_stock ");
                while($row=mysqli_fetch_array($rresult)) 
                {
                ?>
                    <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                <?php 
                }
                ?>
              </select><br> <lable ><b>start Date</b></lable><input type="date" name="text" placeholder="date" id="date" class="form-control">
              
    </div>

               

              <div class="col-lg-4">
                <lable ><b>Article</b></lable>
                <select class="form-control" id="item_name">
                <option value="">Select Article </option>
              </select>  <br/>
               <lable ><b>End Date</b></lable>

               <input type="date" name="text" placeholder="date" id="datee" class="form-control">
              </div>
              <div class="col-lg-4">
                <lable ><b>Department</b></lable>
               
<select class="form-control" id ="department" required="">

                <option value="">Select Department</option>  
                <?php                              
                $rresult = mysqli_query($connection_s,"SELECT college_dept , name ,emp_id FROM ledger  GROUP BY emp_id ");
                while($row=mysqli_fetch_array($rresult)) 
                {
                ?>
                    <option value="<?php echo $row['emp_id']; ?>"><?php echo $row['college_dept']." (".$row['name'].") >(".$row['emp_id']." ) "; ?></option>
                <?php 
                }
                ?>
              </select>


               <input type="hidden" name="text"  value="<?php echo $a;?>" id="emp_id" class="form-control">

               </div>
               <div class="col-lg-4">
                <br>
                <br>

               <button id="reports" class="btn btn-primary">Search</button>
                </div>
             </div>

             <div class="col-lg-7" id="report_view" style="overflow-x: scroll;height: 600px">

             </div>


























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
        var code = "123";
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
      $("#reports").click(function(e) {
        e.preventDefault();
        var category = $("#category").val();
        var item_name = $("#item_name").val();
         var date1 = $("#date").val();
         var datee = $("#datee").val();
          var department = $("#department").val();
        
        var code = "1";
            $.ajax({
            url:'report_action.php',
            data:{category:category,item_name:item_name,date1:date1,department:department,datee:datee,code:code},
            type:'POST',
            success:function(data){
                if(data != "")
                {
                    $("#report_view").html("");
                    $("#report_view").html(data);
                }




            }
          });
    });
  });


















      $(function() { 
      $("#reports_export").click(function(e) {
        e.preventDefault();
        alert("hello");
        var category = $("#category").val();
        var item_name = $("#item_name").val();
         var date1 = $("#date").val();
         var datee = $("#datee").val();
          var department = $("#department").val();
        
        var code = "1";
            $.ajax({
            url:'export_reports.php',
            data:{category:category,item_name:item_name,date1:date1,department:department,datee:datee,code:code},
            type:'POST',
            success:function(data){
                if(data != "")
                {
                    $("#report_view").html("");
                    $("#report_view").html(data);
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