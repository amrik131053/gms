<?php 
include "header.php";
 ?>
<script type="text/javascript">
window.onload = function() {
    pendingMyTask();
        };
</script>

<div class="page">
   
    <div class="content">
        <div class="card-body">
            <!-- Left Section -->
            <div class="col-lg-12 col-sm-12">
                <div  class="card">
                    <div class="card-header" style="padding-right:0px !important;padding-left:0px!important;"></div>
                   
                    <div class="card"  >
                        
                        <div class="row">
                 
                                  <div class="col-md-12">
               
                  <div class="card-body">
                  <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                      <li class="nav-item">
                        <a href="" onclick="pendingMyTask();" class="nav-link active" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-hourglass-high"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.5 7h11" /><path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" /><path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" /></svg>
                         <b class="text-primary"> Pending</b></a>
                      </li>
                      <li class="nav-item">
                        <a href=" " onclick="inprogressMyTask();" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-percentage-10"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c1.92 0 3.7 .601 5.16 1.626l-5.16 7.374z" fill="currentColor" stroke="none" /><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /></svg>
                        <b class="text-warning">Iprogress</b></a>
                      </li>
                      <li class="nav-item">
                        <a href="" onclick="completeMyTask();" class="nav-link" data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/activity -->
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-checks"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12l5 5l10 -10" /><path d="M2 12l5 5m5 -5l5 -5" /></svg>
                        <b class="text-success"> Complete</b></a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body" >
                    <div class="tab-content">
                      <div class="tab-pane active show table-responsive" id="all_data_show">

                      </div>
                    </div>
                  </div>
             
           
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
           
        </div>
    </div>

   
</div>


<?php 


include "footer.php";


?>