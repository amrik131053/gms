 <?php
include "header.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <div class="card-tools">
                     <form action="action_g.php" method="post" enctype="multipart/form-data">
                        <div class="input-group input-group-sm">
                           <input type="hidden" name="code" value="79">
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           <input type="file" name="file_exl" class="form-control input-group-sm" required>
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           <input type="submit" class="btn btn-primary btn-xs" value="Upload">
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           <input type="button" onclick="window.location.href='formats/degree.csv'" value="Format" class="btn btn-warning btn-xs">
                        </div>
                     </form>
                  </div>
                  <div class="card-tools">
                     <div class="input-group input-group-sm">
                        <!-- <input type="text" id="searchBox" placeholder="Search">
                        <button class="btn btn-primary" onclick="performSearch();">Search</button> -->
                     </div>
                  </div>
               </div>
               <script>
                  var currentPage = 1;
                  var code = 78;
                  var searchQuery = '';
                    
                  $(document).ready(function() {
                     loadData(currentPage);

                     function loadData(page) {
                        $.ajax({
                           url: 'action_g.php',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                              page: page,
                              code: code,
                              search: searchQuery // Pass the search query to the server
                           },
                           success: function(data) {
                              buildTable(data);
                              updatePagination(page);
                           },
                           error: function() {
                              // Handle error response
                           }
                        });
                     }


                     function buildTable(data) {
                        var table = '<table class="table table-bordered">';
                        table += '<tr>';
                        table += '<div id="pagination"><center><td> <button id="prev-btn" class="btn btn-primary " disabled>Previous</button></td><td colspan="2"></td><td><input type="date" id="date" class="form-control" value="2023-07-14"></td><td> <button onclick="printSelectedRows();" class="btn btn-success " >Diploma Print </button> </td><td> <button onclick="printSelectedRows_all_course();" class="btn btn-success " >Other Print </button> </td><td><button id="next-btn" class="btn btn-primary ">Next</button></center></td></div>';
                        table += '</tr>';
                        table += '<tr><th><input type="checkbox" id="selectAllCheckbox" class="selectAllCheckbox" onchange="toggleSelectAll(this)"></th><th>ID</th><th>Name</th><th>UniRolNo</th><th>FatherName</th><th>Examination</th><th>Course</th></tr>';
                        for (var i = 0; i < data.length; i++) {
                           var unirollno = data[i][2];
                           table += '<tr>';
                           table += '<td><input type="checkbox" name="selectedRows[]" value="' + data[i][0] + '"></td>';
                           table += '<td>' + data[i][0] + '</td>';
                           table += '<td>' + data[i][1] + '</td>';
                           table += '<td data-toggle="modal" data-target="#exampleModal" onclick="view_image(\'' + unirollno + '\');">' + unirollno + '</td>';
                           table += '<td>' + data[i][3] + '</td>';
                           table += '<td>' + data[i][5] + '</td>';
                           table += '<td>' + data[i][6] + '</td>';
                           // table += '<td>';
                           // table += '<form action="print_degree1.php" method="post">';
                           // table += '<input type="hidden" name="code" value="1">';
                           // table += '<input type="hidden" name="p_id" value="' + data[i][0] + '">';
                           // table += '<button type="submit" class="btn border-0 shadow-none" style="background-color:transparent; border: none" formtarget="_blank">';
                           // table += '<i class="fa fa-print" aria-hidden="true"></i>';
                           // table += '</button>';
                           // table += '</form>';
                           // table += '</td>';
                           table += '</tr>';
                        }
                        // table += '<tr>';
                        // table += '<div id="pagination"><center><td> <button id="prev-btn" class="btn btn-primary " disabled>Previous</button></td><td colspan="5"></td><td> <button onclick="printSelectedRows();" class="btn btn-success btn-lg" ><i class="fa fa-print fa-lg"></i> </button> </td><td><button id="next-btn" class="btn btn-primary ">Next</button></center></td></div>';
                        // table += '</tr>';
                        table += '</table>';

                        $('#data-table').html(table);
                     }

                     function updatePagination(page) {
                        var totalPages = Math.ceil(100000 / 100);

                        if (page == 1) {
                           $('#prev-btn').prop('disabled', true);
                        } else {
                           $('#prev-btn').prop('disabled', false);
                        }

                        if (page+1 == totalPages) {
                           $('#next-btn').prop('disabled', true);
                        } else {
                           $('#next-btn').prop('disabled', false);
                        }
                     }

                     $(document).on('click', '.pagination-button', function() {
                        var page = $(this).data('page');
                        currentPage = page;
                        loadData(currentPage);
                     });

                     $(document).on('click', '#prev-btn', function() {
                        if (currentPage > 1) {
                           currentPage--;
                           loadData(currentPage);
                        }
                     });

                     $(document).on('click', '#next-btn', function() {
                        var totalPages = Math.ceil(100000 / 100);
                        if (currentPage < totalPages) {
                           currentPage++;
                           loadData(currentPage);
                        }
                     });
                  });

              function printSelectedRows() {
   var id_array = document.getElementsByName('selectedRows[]');
   var Todate = document.getElementById('date').value;
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      window.open('print_degree2.php?id_array=' + id_array_main+'&Todate='+Todate);
   } else {
      ErrorToast('All Input Required', 'bg-warning');
   }
}     
         function printSelectedRows_all_course() {
   var id_array = document.getElementsByName('selectedRows[]');
   var Todate = document.getElementById('date').value;
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      window.open('print_degree3.php?id_array=' + id_array_main+'&Todate='+Todate);
   } else {
      ErrorToast('All Input Required', 'bg-warning');
   }
}


                  function toggleSelectAll(checkbox) {
                     var checkboxes = document.getElementsByName('selectedRows[]');
                     for (var i = 0; i < checkboxes.length; i++) {
                        checkboxes[i].checked = checkbox.checked;
                     }
                  }

                  function view_image(id) {
                     var code = 91;
                     $.ajax({
                        url: 'action_g.php',
                        type: 'post',
                        data: {
                           uni: id,
                           code: code
                        },
                        success: function(response) {
                           document.getElementById("image_view").innerHTML = response;
                        }
                     });
                  }
               </script>
               <div id="data-table">
                  <!-- <table class="table">
                     <tr>
                        <div id="pagination">
                           <td>
                              <button id="prev-btn" class="btn btn-primary " disabled>Previous</button>
                           </td>
                           <td colspan="4"></td>
                           <td>
                              <button id="next-btn" class="btn btn-primary " style="float:right;">Next</button>
                           </td>
                        </div>
                     </tr>
                  </table> -->
               </div>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
   </div>
   <!-- /.card-header -->
   </div>
   <!-- /.card -->
</section>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row" id="image_view">
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary"></button> -->
         </div>
      </div>
   </div>
</div>
<p id="ajax-loader"></p>
<script type="text/javascript">
   function uploadImage(form, id) {
      var formData = new FormData(form);
      $.ajax({
         url: form.action,
         type: form.method,
         data: formData,
         contentType: false,
         processData: false,
         success: function(response) {
            SuccessToast('Successfully Uploaded');
            view_image(id);
         },
         error: function(xhr, status, error) {
            console.log(error);
         }
      });
   }

   function search_degree_record() {
      var unirollno = document.getElementById('unirollno').value;
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 224;
      $.ajax({
         url: 'action.php',
         type: 'post',
         data: {
            uni: unirollno,
            code: code
         },
         success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("search_record").innerHTML = response;
         }
      });
   }

   function marks_as_print(id) {
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 77;
      $.ajax({
         url: 'action_g.php',
         type: 'post',
         data: {
            id: id,
            code: code
         },
         success: function(response) {
            spinner.style.display = 'none';
            if (response == 1) {
               load_table();
               SuccessToast('Successfully Updated');
            }
         }
      });
   }
</script>
<?php
include "footer.php";
?>
