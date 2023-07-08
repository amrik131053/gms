<?php 
   include "header.php";  
   include "connection/connection.php"; 

   ?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <!-- Button trigger modal -->
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-info">
               <div class="card-header ">

                  <div class="row">
        
         <div class="col-lg-2 col-md-2 col-sm-2">

                  <h3 class="card-title">New Admission</h3>  </div>   
                     <div class="col-lg-2 col-md-2 col-sm-2">  <input type="date"  id='start_date' placeholder="mm/dd/yyyy" required class="form-control"></div>

        <label>To</label>
        <div class="col-lg-2 col-md-2 col-sm-2"> <input type="date" id='end_date' placeholder="mm/dd/yyyy" required class="form-control"></div>
     
         <div class="col-lg-1 col-md-1 col-sm-1">
          <button class="btn btn-info btn-xs"  onclick="searchadmission()">Search</button> <button class="btn btn-info btn-xs" onclick="exportadmission()">Export</button>

        
      </div>
      </div>
               </div>
              
                  <div class="card-body" >
       <div class="card-body table-responsive">          
<table class="table" style="font-size: 14px" >

  <thead>
         
                  <tr>
          <th>Sr. No</th>
          <th>P ID/ Ref no</th>
          <th>Name</th>
          <th>Father Name</th>
           <th>Course/Batch</th>
          <th>Email</th> <th><i class="fa fa-download" style="color: green"></i></th>
          <th>Phone</th>
          <th>Amount</th>
          <th>Transaction Date/ Time</th>
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

<script>
 $(window).on('load', function() 
          {
            load_admission_data();
        
           })

function load_admission_data()
          {
       var code=311;

       
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


function searchadmission()
          {
       var code=312;

       var start_date=document.getElementById('start_date').value;
       var end_date=document.getElementById('end_date').value;

         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,start_date:start_date,end_date:end_date,
                  },
            success: function(response) 
            {


               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }

  function exportadmission() 
      {
         var exportCode=19;

         var start_date=document.getElementById('start_date').value;
       var end_date=document.getElementById('end_date').value;

       alert(start_date);
        if (start_date!='' && end_date!='') 
         {
            // alert("export.php?exportCode="+exportCode+"&hostel="+hostel+"&session="+session);
          window.location.href="export.php?exportCode="+exportCode+"&start_date="+start_date+"&end_date="+end_date;
         }
         else
         {
            alert("Select both dates");
         }
       
        
      }

function confirnation(id)
{
alert(id);
}

</script>
<p id="ajax-loader"></p>



<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<!-- Modal -->
<?php
   include "footer.php"; 
   
    ?>