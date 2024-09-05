
<?php  
   include "header.php";   
   ?>
  <div class="card-body ">
    <div class="card-header ">


</div>
<br>
<form action="action.php" method="post">
<div class="row">
    

    <div class="col-lg-3">
     

    <input type="text" name="EmpID"  placeholder="Employee ID" value="" onblur="empdatashow(this.value)"  class="form-control">
    <span id="employee_name_show"></span>

    <input type="hidden" name="code" value="353">
</div>

          
              
               
               <div class="col-lg-3" id="SingleDate">
              
                   <input type="datetime-local" class="form-control" id="leaveDate" name="leaveDate" value="<?=date('Y-m-d H:i:s');?>" >
                </div>
              
              
            
               
               <div class="col-lg-3">
          
               <input type="button" onclick="CorrectionSubmit(this.form);" name="leaveButtonSubmit" class="btn btn-success" value="Submit">
                </div>
</div>
</form>
</div>
<script>
function CorrectionSubmit(form) { 



    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            if (response == 1) {
                SuccessToast('Printed Success');
                               
                
            }
           
             else
              {
                ErrorToast('Please try after sometime.','bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
        
    });
}
</script><p id="ajax-loader"></p>

<!-- Modal -->
<?php include "footer.php"; ?>