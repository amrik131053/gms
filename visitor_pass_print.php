<?php 

  include "header.php";   
?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
            <div class="col-lg-3 col-md-8 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Insert Visitor Pass</h3>
                  <div class="card-tools">             
                  </div>
               </div>
               <!-- /.card-header -->
       
                <div class="card-body">
                  <div class="form-group row">
                     
                 
                   
                     <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Number of Insert</label>
                    <div class="col-lg-12">
                       <select class="form-control" required=""  id="Number">
                        <?php
                        for ($i=1; $i<51 ; $i++) 
                           { ?>
               <option value='<?= $i;?>'><?= $i?></option>
               <?php                       }
                        ?>


</select>
                    
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit"  value="Submit" onclick="insert_visitor_pass();" class="btn btn-primary">
               
                </div>
            
          </div>
       </div>
      <div class="col-lg-3 col-md-8 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Visitor Pass</h3>
                  <div class="card-tools">             
                  </div>
               </div>
               <!-- /.card-header -->
          <form action="print_visitor_pass.php" method="post" target="_blank">
                <input type="hidden" name="code" value="">
                <div class="card-body">
                  <div class="form-group row">
                     
                    <label for="inputEmail3" required="" class="col-sm-12 col-form-label">From</label>
                    <div class="col-lg-12">
                      <input type="text" name="FromPassNumber" placeholder="Numer" class="form-control" >                        
                    </div>
                     <div class="col-lg-12">
                        <label for="inputEmail3" required="" class="col-sm-12 col-form-label">To</label>
                      <input type="text" name="ToPassNumber" placeholder="Numer" class="form-control">         
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit"  value="Print" class="btn btn-primary">
               
                </div>
             </form>
          </div>
       </div>
</div>
</div>


 
  
<p id="ajax-loader"></p>
</section>
<script type="text/javascript">
      function insert_visitor_pass()
   {

   var spinner=document.getElementById("ajax-loader");
   var P_Number=document.getElementById('Number').value;
   alert(P_Number);
     spinner.style.display='block';
           var code=198;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,P_Number:P_Number
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                  if (response>0) {
                     SuccessToast('SuccessFully Insert');
                  }
                  else
                  {
                     ErrorToast('Try Again','bg-danger');
                  }
                 // document.getElementById("question_count").innerHTML=response;
                 // console.log(response);
              }
           });


   } 
</script>

<?php include "footer.php";  ?>