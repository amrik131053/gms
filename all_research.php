<?php 
  ini_set('max_execution_time',0);
  include "header.php";   
?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
        
            <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
  <div class="card-header">
   <div class="col-lg-2">
      <input type="text" id="search_text" class="form-control" placeholder="Search by title or name or idno" onkeyup="load_data(1)">
   </div>
  </div>
  <div class="card-body table-responsive p-0" style="height: 700px;">
    <div id="search_record"></div>
  </div>
  <div class="card-footer text-center" id="pagination_area">
    <!-- Pagination will be injected here -->
  </div>
</div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
load_data();

function load_data(page = 1) {
  var spinner = document.getElementById("ajax-loader");
  spinner.style.display = 'block';
  var search = document.getElementById("search_text").value;

  $.ajax({
    url: 'action_research.php',
    type: 'POST',
    data: {
      code: '5',
      page: page,
      search: search
    },
    success: function(data) {
      spinner.style.display = 'none';
      var response = JSON.parse(data);
      document.getElementById("search_record").innerHTML = response.table;
      document.getElementById("pagination_area").innerHTML = response.pagination;
    }
  });
}

</script>

<?php include "footer.php";  ?>