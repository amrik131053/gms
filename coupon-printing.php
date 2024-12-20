<?php 
  include "header.php";   
  $todaydate=date('Y-m-d');
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         
            <div class="col-lg-3 col-md-3 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Coupon Entry</h3>
                     <div class="card-tools">
                  
                   </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                     <div class="row">
                        <div class="col-lg-12">
                           <label>Title</label>
                           <input type="text" id="title" class="form-control">
                        </div>
                        <div class="col-lg-12">
                        <label>Type</label>
                        <select id="type" class="form-control">
                           <option value="Lunch">Lunch</option>
                           <option value="BreakFast">BreakFast</option>
                           <option value="Dinner">Dinner</option>
                           <option value="All">All</option>
                        </select>
                        </div>
                        <div class="col-lg-12">
                        <label>Date</label>
                           <input type="date" id="date" class="form-control">
                        </div>
                        <div class="col-lg-12">
                           <label>Action</label><br>
                           <input type="button" value="Submit" onclick="submitCoupon();" class="btn btn-success">
                        </div>
                     </div>
                  </div>
                 
               </div>
              
            </div>
            <div class="col-md-9 col-lg-9 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Entries </h3>
                  
               </div>
             
                  <div class="card-body" id="allDeatils"  >


                  </div>




                  <div class="card-footer">           
                  </div>
                  <!-- /.card-footer -->
              
            </div>

            <!-- /.card -->
         </div>
       
      
        
      </div>
      
   </div>
 <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <div id='Editdetails'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="button" class="btn btn-primary"    onclick="update();" value="Save changes">
       
      </div>
    </div>
  </div>
</div>
</section>
<p id="ajax-loader"></p>

<script type="text/javascript">

    function submitCoupon()
          {
       var code=17;
       var title= document.getElementById("title").value;
       var type= document.getElementById("type").value;
       var date= document.getElementById("date").value;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_a.php',
            type:'POST',
            data:{
               flag:code,type:type,title:title,date:date
                  },
                 success: function(response) 
                { 
                  console.log(response);
               spinner.style.display='none';
               getRecord();
               
            }
         });
     }
     getRecord();
    function getRecord()
          {
       var code=18;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_a.php',
            type:'POST',
            data:{
               flag:code
                  },
                 success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("allDeatils").innerHTML=response;
               
            }
         });
     }
  
     function printCoupon(id) {
             var StartNumber=document.getElementById("StartNumber"+id).value;
            var  EndNumber=document.getElementById("EndNumber"+id).value;  
      window.open('coupon-print-pdf.php?ID=' + id+"&start="+StartNumber+"&end="+EndNumber);
}     
     function printCouponAll(id) {
             var StartNumber=document.getElementById("StartNumber"+id).value;
            var  EndNumber=document.getElementById("EndNumber"+id).value;  
      window.open('coupon-print-pdf-all.php?ID=' + id+"&start="+StartNumber+"&end="+EndNumber);
}     
</script>




<?php include "footer.php";  ?>