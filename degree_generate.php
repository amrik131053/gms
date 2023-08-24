<?php
include "header.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="modal fade" id="for_edit" tabindex="-1" role="dialog" aria-labelledby="for_editLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_editLabel">Edit Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit_show">
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button class="btn btn-primary" onclick="edit_student_details(<?=$id;?>)">Submit</button> -->
      </div>
    </div>
  </div>

</div>
<div class="modal fade" id="for_excel" tabindex="-1" role="dialog" aria-labelledby="for_excelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_excelLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <!-- <div class="card "> -->
               
                        <div class="btn-group w-100 mb-2">
                    <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="diploma_agri();bg(this.id);"> Diploma Agri </a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="diploma_other();bg(this.id);"> Diploma Other </a>
                    <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="degree();bg(this.id);"> Degree </a>
                   
                  </div>
              <!-- </div> -->
                <div id="from_show_toggle">
                   
                </div>
            <!-- </div> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <div class="card-tools">
                     <!-- <form action="action_g.php" method="post" enctype="multipart/form-data"> -->
                        <div class="input-group input-group-sm">
                           <!-- <input type="hidden" name="code" value="79"> -->
                         <!--   &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp; -->
                         
                          <input type="date"  class="form-control" value="" id="upload_date">
                          <input type="button" class="btn btn-secondary btn-xs" onclick="date_by_search();" value="Search">
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           <input type="submit" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#for_excel" value="Upload">
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           <input type="button" onclick="window.location.href='formats/degree.csv'" value="Format" class="btn btn-warning btn-xs">
                        </div>
                     <!-- </form> -->
                  </div>
                  <div class="card-tools">
                     <div class="input-group input-group-sm">
                        <!-- <input type="text" id="searchBox" placeholder="Search">
                        <button class="btn btn-primary" onclick="performSearch();">Search</button> -->
                     </div>
                  </div>
               </div>
               <script>
                  function date_by_search() {
                     
                    var currentPage = 1;
                  var code = 78;
                  var searchQuery = '';
                    var upload_date=document.getElementById('upload_date').value;
                    // alert(upload_date);
                        $.ajax({
                           url: 'action_g.php',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                              page: currentPage,
                              code: code,
                              upload_date: upload_date,
                              search: searchQuery // Pass the search query to the server
                           },
                           success: function(data) {
                              buildTable(data);
                              updatePagination(currentPage);
                           },
                           error: function() {
                              // Handle error response
                           }
                        });
                  }
                  var currentPage = 1;
                  var code = 78;
                  var searchQuery = '';
                   const date = new Date();
                  var day = date.getDate();
                   var month = date.getMonth() + 1;
                  var year = date.getFullYear();
                  var upload_date = `${year}-${month}-${day}`;
   
                  // $(document).ready(function() {
                     loadData(currentPage);

                     function loadData(page) {
                    var upload_date=document.getElementById('upload_date').value;
                        $.ajax({
                           url: 'action_g.php',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                              page: page,
                              code: code,
                              upload_date: upload_date,
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
                        table += '<div id="pagination"><center><td> <button id="prev-btn" class="btn btn-primary " disabled>Previous</button></td><td colspan="3"></td><td colspan=""><input type="date" id="date" class="form-control" value="2023-07-14"></td><td colspan="1"> <button onclick="printSelectedRows();" class="btn btn-success " >Diploma Print </button> </td><td colspan="1"> <button onclick="printSelectedRows_all_course();" class="btn btn-success " >Other </button> </td><td><button id="next-btn" class="btn btn-primary ">Next</button></center></td></div>';
                        table += '</tr>';
                        table += '<tr><th><input type="checkbox" id="selectAllCheckbox" class="selectAllCheckbox" onchange="toggleSelectAll(this)"></th><th>Name</th><th>UniRolNo</th><th>FatherName</th><th>Examination</th><th>Course</th><th>CGPA</th><th>Action</th></tr>';
                        for (var i = 0; i < data.length; i++) {
                           var unirollno = data[i][2];
                           table += '<tr>';
                           table += '<td><input type="checkbox" name="selectedRows[]" value="' + data[i][0] + '"></td>';
                           // table += '<td>' + data[i][0] + '</td>';
                           table += '<td>' + data[i][1] + '</td>';
                           table += '<td data-toggle="modal" data-target="#exampleModal" onclick="view_image(\'' + unirollno + '\');">' + unirollno + '</td>';
                           table += '<td>' + data[i][3] + '</td>';
                           table += '<td>' + data[i][5] + '</td>';
                           table += '<td>' + data[i][6] + '</td>';
                           table += '<td>' + data[i][9] + '</td>';
                           table += '<td><button onclick="edit_student('+ data[i][0] +');" data-toggle="modal" data-target="#for_edit" class="btn btn-success btn-xs " ><i class="fa fa-edit"></i></button ></td>';
                          
                           table += '</tr>';
                        }
                        
                        table += '</tr>';
                        table += '<td><button onclick="deleteSelectedRows();" class="btn btn-danger btn-xs " ><i class="fa fa-trash"></i> </button></td>';
                        table += '</tr>';
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
                  // });

              function printSelectedRows()
               {
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


function deleteSelectedRows()
{

  var students=document.getElementsByName('selectedRows[]');
var len_student= students.length; 
var a=confirm("Are you sure you want to delete");
if (a==true) 
{
  var code=159;
  var student_str=[];
   
     for(i=0;i<len_student;i++)
     {
          if(students[i].checked===true)
          {
            student_str.push(students[i].value);
          }
       }
  if((typeof  student_str[0]== 'undefined') )
  {
    ErrorToast('Select atleast one record ', 'bg-warning');
  }
  else
  {
    var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{students:student_str,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            if(data>0)
            {
               SuccessToast('Successfully Delete');

            }
            else
            {

            }
            // console.log(data);
                                }      
});
}
}
else{

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
                           console.log(response);
                           document.getElementById("image_view").innerHTML = response;
                        }
                     });
                  }
               </script>
               <div id="data-table">
                  <div class="card" ><center><marquee><h5 class="text-danger">Please enter the date you'd like to search records</h5></marquee></center></div>
                  
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
 function diploma_other() {
   
      var code = 130;
      $.ajax({
         url: 'action_g.php',
         type: 'post',
         data: {
            code: code
         },
         success: function(response) {
            document.getElementById("from_show_toggle").innerHTML = response;
            document.getElementById("Type_degree").innerHTML = response;
         }
      });
    
 } function diploma_agri()
  {
        var code = 131;
      $.ajax({
         url: 'action_g.php',
         type: 'post',
         data: {
            code: code
         },
         success: function(response) {
            document.getElementById("from_show_toggle").innerHTML = response;
         }
      });
 }function degree() {
        var code = 132;
      $.ajax({
         url: 'action_g.php',
         type: 'post',
         data: {
            code: code
         },
         success: function(response) {
            document.getElementById("from_show_toggle").innerHTML = response;
         }
      });
 }

      function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }

   function uploadImage(form, id) {
      var formData = new FormData(form);
      $.ajax({
         url: form.action,
         type: form.method,
         data: formData,
         contentType: false,
         processData: false,
         success: function(response) {
            console.log(response);
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
   function edit_student(id) 
{  
     
var code='141';
$.ajax({
url:'action_g.php',
data:{id:id,code:code},
type:'POST',
success:function(data){
document.getElementById('edit_show').innerHTML=data;
}
});

}

function edit_student_details(id) {
   // alert(id);
  var Name = document.getElementById('Name').value;
  var FatherName = document.getElementById('FatherName').value;
if(Name!='' && FatherName!='')
{
  var code = 142;
  var data = {
    id: id,
    Name: Name,
    FatherName: FatherName,
    code: code
  };
 
  // Send the AJAX request
  $.ajax({
    url: 'action_g.php',
    data: data,
    type: 'POST',
    success: function(response) {
      // console.log(response); // Log the response for debugging
      if (response==1) {
      SuccessToast('Data Updated successfully');
      date_by_search();
   }
   else
   {
ErrorToast('Try  after some time','bg-danger');

   }
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}
else
{
   ErrorToast('All Input Required','bg-warning');
}s
}

   const date_ = new Date();
var day = String(date_.getDate()).padStart(2, '0');
var month = String(date_.getMonth() + 1).padStart(2, '0');
var year = date_.getFullYear();
var upload_ = `${year}-${month}-${day}`;
document.getElementById('upload_date').value = upload_;

</script>
<?php
include "footer.php";
?>
