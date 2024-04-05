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
<style type="text/css">
   h5{
   color: black;
   text-decoration: bold;
   }
</style>
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<section class="content">
   <div class="container-fluid">
      <div class="row">
       
       


        <div class="col-lg-12 col-md-12 col-sm-12" >

            <div class="card card-info" >
               <div class="card-header" style="background-color: #223260;">Reports</div>
                  <div class="card-body table-responsive">          
<table class="table" style="font-size: 14px" >

<thead>
   <tr>
       <th>#</th>
       <th>Name</th>
       <th>Mobile No.</th>
       <th>Designation</th>
       <th>Department</th>
        <th>Type</th>
       <th>Address</th>
       <th>Entry Time</th>
       <th>Exit Time</th>
       <th>Action</th>
   </tr>
 </thead>
  <tbody style="height:1px" id="table_load" ></tbody> 
         </table>
         </div>

            </div>
         
      </div>
   </div>


</div>
</div>
</section>
   <p id="ajax-loader"></p>


   <script type="text/javascript">
    $(window).on('load', function() 
          {
             fetch_data();
        
           })


    setInterval(function(){
     fetch_data();
  }, 6000);

    function fetch_data()
       {
       var code=343;

       
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
                  },
            success: function(response) 
            {

 
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }

   
      function checkin(id,eid)
       {
       var code=344;

           
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,id:id,eid:eid
                  },
            success: function(response) 
            {

 
               spinner.style.display='none';
               fetch_data();
              
            }
         });

     }

   

    
   
   </script>


<?php include "footer.php"; 
?>