<?php 
   include "header.php"; 
    ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header">

                         <div class="row"><div class="col-lg-3">My Team</div> <div class="col-lg-3">

                            <input type="date" class="form-control"  id='startDate' value="<?= $todaydate;?>" >
                        </div> <div class="col-lg-3"> <button class="btn btn-info btn-sm" onclick="getRecord();" type="button" ><i class="fa fa-search"></i></button></div></div>
                       

                        <b id="total_count"></b>
                    </div>
                    <div class="card card-solid"> 
                        <div class="card-body pb-0">
                            <div class="row" id='getTable'>
                              



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<p id="ajax-loader"></p>

<script>
     getRecord();
function getRecord() {

    var code='450';

     var startDate = document.getElementById('startDate').value;
    
       var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code:code,startDate:startDate
            
        },
        success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
         document.getElementById('getTable').innerHTML=response;

        }
    });
}
</script>

<?php include "footer.php";  ?>