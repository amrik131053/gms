<?php 

  include "header.php";   
?>   




<section class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">
  <div class="card card-info">
                    <div class="card-header ">
  <div class="row">
   <div class="col-lg-5 col-md-12">

  <h3 class="card-title">Results</h3>
</div> 


<div class="col-lg-6 col-md-12 col-sm-12" style="text-align: center;">
 
         <span style="float:right;">
                        <button class="btn btn-sm ">
                            <input type="search" 
                                class="form-control form-control-sm" name="emp_name" id="rollno"
                                placeholder="Search here">
                        </button>
                        <button type="button" onclick="search_result();" class="btn btn-success btn-sm">
                            Search
                        </button>
                    </span>
</div>
</div>
 
     
  

</div>
<div class="card-body">
                  <div id="show_record1">
                  

                  </div>
</div>

</div></div>
</div>
</section>
<script>
function search_result() {
   
    var rollno = document.getElementById('rollno').value;
    if (rollno != '') {
     
        //var spinner = document.getElementById("ajax-loader");
        //spinner.style.display = 'block';
        var code = 395;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,rollno:rollno
            },
            success: function(response) {
                //spinner.style.display = 'none';
                document.getElementById("show_record1").innerHTML = response;
              

            }
        });
    }
}
</script>
 <?php include "footer.php";  ?>