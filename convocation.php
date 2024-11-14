<?php 
   include "header.php";  
   include "connection/connection_web.php"; 
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

                  <h3 class="card-title">Convocation </h3>  </div>   
                  <!--
                     <div class="col-lg-2 col-md-2 col-sm-2">  <input type="date"  id='start_date' placeholder="mm/dd/yyyy" required class="form-control"></div>

        <label>To</label>
        <div class="col-lg-2 col-md-2 col-sm-2"> <input type="date" id='end_date' placeholder="mm/dd/yyyy" required class="form-control"></div> -->
       
        <div class="col-lg-1 col-md-1 col-sm-1">
         
           
         <button class="btn btn-info btn-xs" onclick="exportadmission()">Export</button> 
       
     </div>
         <div class="col-lg-2 col-md-1 col-sm-1">
         
           
          <!-- <button class="btn btn-info btn-xs" onclick="RejectedByAccount()">Rejected By Account</button> 
        
      </div>
        
      <div class="col-lg-1 col-md-1 col-sm-1">
         
           
         <button class="btn btn-info btn-xs" onclick="NotEligible()">Not Eligible</button> 
       
     </div>
     <div class="col-lg-1 col-md-1 col-sm-1">
         
           
         <button class="btn btn-info btn-xs" onclick="Verified()">Verified</button> 
       
     </div>
     <div class="col-lg-1 col-md-1 col-sm-1">
         
           
         <button class="btn btn-info btn-xs" onclick="Attedance()">Final List</button> 
       
     </div> -->
         <!-- <div class="col-lg-1 col-md-1 col-sm-1">
       <button class="btn btn-info btn-xs" onclick="exportsummary()">Export Summary</button> 
        
      </div> -->

</div>
      </div>
               </div>
              
                  <div class="card-body" >
                  <div class="form-group row">
                 
                        
                 <div class="col-lg-2 col-md-2 col-sm-12">
                     <label>Status</label>
                     <select id="Status" class="form-control form-control-sm" >
                         <option value="All">All</option>
                         <option value="No">Absent</option>
                         <option value="Yes">Present</option>
                        
                        
                     </select>

                 </div>
                 <div class="col-lg-2 col-md-4 col-sm-3">


<label>College</label>
<select  name="CollegeName" id='CollegeName'  class="form-control form-control-sm" required="">
  <option value='All'>All</option>
    <?php
$sql="SELECT DISTINCT CollegeName from online_payment  where remarks='4th Convocation' and status='success' ";
$stmt2 = mysqli_query($conn_online,$sql);
while($row1 = mysqli_fetch_array($stmt2) )
{
$college = $row1['CollegeName']; 
?>
<option  value="<?=$college;?>"><?= $college;?></option>
<?php    }

?>
</select> 



</div>
<div class="col-lg-2 col-md-2 col-sm-12">
                     <label>Type</label>
                     <select id="Type" class="form-control form-control-sm" >
                         <option value="All">All</option>
                         <option value="UG">UG</option>
                         <option value="PG">PG</option>
                         <option value="Ph.D">Ph.D</option>
                         <option value="Diploma">Diploma</option>
                     </select>

                 </div>
                 <div class="col-lg-2 col-md-2 col-sm-13">
                     <label class="" style="font-size:14px;">Action</label><br>
                     <!-- <button class="btn btn-danger btn-sm " onclick="fetchCutList()"><i class="fa fa-search" aria-hidden="true"></i></button>&nbsp;&nbsp; -->
                      <button class="btn btn-danger btn-sm " onclick="exportAttendancePdfWithoutIMage()"><i
                                         class="fa fa-file-pdf"></i></button>&nbsp;&nbsp;<!--
                     <button class="btn btn-danger btn-sm " onclick="exportCutListPdf()"><i
                                         class="fa fa-file-pdf"></i></button> -->
                 </div>
                 <!-- <div class="col-lg-1 col-md-1 col-sm-13">
                     <label>&nbsp;</label><br>
                    
                     
                 </div> -->
                 


             </div>
       <div class="card-body table-responsive">          
<table class="table" style="font-size: 14px" >

  <thead>
         
                  <tr>
          <th>Sr. No</th>
          <th>P ID/ Ref no</th>
          <th>Uni Roll NO</th>
          <th>Name</th>
          <th>Course</th>
           <th>Organisation</th>
          <th>Email</th> <th>Purpose</th>  <th><i class="fa fa-download" style="color: green"></i></th>
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


<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" >
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Admission Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      

       <div class="modal-body" >
         <div id ="abc"></div>
      <table class="table" style="font-size: 14px" >

  <thead>
         
                  <tr>
          <th>Sr. No</th>
          <th>P ID/ Ref no</th>
          <th>Name</th>
          <th>Father Name</th>
           <th>Course/Batch</th>
          <th>Email</th> 
          <th>Purpose</th> 
          <th><i class="fa fa-download" style="color: green"></i></th>
          <th>Phone</th>
          <th>Amount</th>
          <th>Transaction Date/ Time</th>
         </tr>
         </thead>
         <tbody style="height:1px" id="edit_stu" ></tbody> 
         </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
















<script>
function exportAttendancePdfWithoutIMage() {
    var CollegeName = document.getElementById('CollegeName').value;
    var Type = document.getElementById('Type').value;
    var Status = document.getElementById('Status').value;
    if (CollegeName != '') {
        window.open("export-convo-attendance-pdf.php?CollegeName=" + CollegeName + "&Status=" + Status+ "&Type=" + Type, '_blank');

    } else {
        alert("Select ");
    }
}
function exportBusPassList() {
    var exportCode = 80.1;
    //var Session = document.getElementById('Session').value;
    var Status = document.getElementById('Status').value;
    var CollegeName = document.getElementById('CollegeName').value;
    
    if (Status != '') {
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status+ "&CollegeName=" + CollegeName);

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}
 $(window).on('load', function() 
          {
            load_comnference_data();
        
           })

function load_comnference_data()
          {
       var code=333;

       
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


 
  function exportadmission() 
      {
         var exportCode=28;

        
          window.location.href="export.php?exportCode="+exportCode;
        
        
      }


  function exportsummary() 
      {
         var exportCode=77;

        
          window.location.href="export.php?exportCode="+exportCode;
        
        
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