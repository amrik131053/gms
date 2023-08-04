<?php
include "header.php";
?>
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
             <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card card-info " id="myCollapsible">
               <div class="card-header">
                  <div class="row">
                     <div class="col-lg-3">
                        <h3 class="card-title">Create Offer Latter</h3>
                     </div>
                     <div class="col-lg-9">
                        <div class="card-tools">
                           <div class="row">
                              <div class="col-lg-3">
                                 
                              </div>
                              <div class="col-lg-4">

                              </div>
                              <div class="col-lg-5">
                                
                              </div>
                                 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body "  id="">
                  
                     <div class="row">
            <div class="col-lg-12">
               
         <div class="row">
            <div class="col-lg-3">
               <label>Student Name</label>
               <input type="text" value="" id="Name" class="form-control" > 
            </div>
            <div class="col-lg-3">
               <label>Father Name</label>
               <input type="text" value="" id="FatherName" class="form-control" > 
            </div>
             <div class="col-lg-3">
               <label>Mother  Name</label>
               <input type="text" value="" id="MotherName" class="form-control" > 
            </div>
             <div class="col-lg-3">
               <label>Gender</label>
               <input type="text" value="" id="Gender" class="form-control" > 
            </div>
            <div class="col-lg-2">
               <label>Mobile No</label>
               <input type="text" value="" id="MobileNo"  class="form-control" > 
            </div>

            <div class="col-lg-3">
                <label>College Name</label>
                 <select   id='CollegeName' onchange="collegeByDepartment(this.value);" class="form-control" required>
                 <option value=''>Select Faculty</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
              </div>
               <div class="col-lg-2">
                 <label>Department</label>
                  <select  id="Department"  class="form-control"  onchange="fetchcourse()" required>
                     <option value=''>Select Department</option>
                 </select>
              </div>  


              <div class="col-lg-2">
                 <label>Course</label>
                  <select   id="Course" class="form-control" required >
                     <option value=''>Select Course</option>
                 </select>
              </div>


             

              <div class="col-lg-1">
                 <label>Batch</label>
                   <select id="batch"   class="form-control" required>
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
      
                     
              </div> 
            <div class="col-lg-2">
              <label>Lateral Entry</label> <br>
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb16"  value="No" name="Lateral" checked="">
                     <label for="radioPrimaryb16">
                     No
                     </label>
                 
               </div>
              
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb17"  value="Yes" name="Lateral">
                     <label for="radioPrimaryb17">
                     Yes
                     </label>
                
               </div>
            </div>
            <div class="col-lg-2">
              <label>Pin Code</label>  
              <input type="text" value="" id="Pincode" class="form-control">
            </div>
            <div class="col-lg-2">
              <label>Nationality</label>  
              <input type="text" value="" id="Nationality" class="form-control" >
            </div> <div class="col-lg-2">
              <label>State</label>  
              <input type="text" value="" id="State" class="form-control" >
            </div><div class="col-lg-2">
              <label>District</label>  
              <input type="text" value="" id="District" class="form-control" >
            </div>
            

            <div class="col-lg-3">
               <label>&nbsp;</label>
               <button class="btn btn-primary form-control" onclick="submit_record()">Submit</button>
            </div>
         </div>
            </div>
            
         </div>
                  
               </div>
            </div>
         </div>
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <div class="card-tools">
                        <form action="sic-document-record-print.php" method="post" target="_blank">   
                                     <div class="input-group input-group-sm">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text bg-danger" id="inputGroup-sizing-sm">Start</span>
                                       </div>
                                       <input required type="datetime-local" class="form-control" name="startDate" aria-describedby="button-addon2">
                                       &nbsp;
                                       <div class="input-group-prepend">
                                          <span class="input-group-text bg-success" id="inputGroup-sizing-sm">End</span>
                                       </div>
                                       <input required type="datetime-local" class="form-control" name="endDate" aria-describedby="button-addon2">
                                       <button class="btn btn-info btn-sm" type="submit" id="button-addon2" ><i class="fa fa-file-export"></i></button>
                                    </div>
                                 </form>
                    
                  </div>
                  <div class="card-tools">
                     <div class="input-group input-group-sm">
                      
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
                        table += '<div id="pagination"><center><td> <button id="prev-btn" class="btn btn-primary " disabled>Previous</button></td><td colspan="4"></td><td> <button onclick="printSelectedRows();" class="btn btn-success " >Diploma Print </button> </td><td><button id="next-btn" class="btn btn-primary ">Next</button></center></td></div>';
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
                           
                           table += '</tr>';
                        }
                        
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
                           console.log(response);
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
function submit_record() {
  var Name = document.getElementById('Name').value;
  var FatherName = document.getElementById('FatherName').value;
  var MotherName = document.getElementById('MotherName').value;
  var Gender = document.getElementById('Gender').value;
  var MobileNo = document.getElementById('MobileNo').value;
  var CollegeName = document.getElementById('CollegeName').value;
  var Department = document.getElementById('Department').value;
  var Course = document.getElementById('Course').value;
  var Batch = document.getElementById('batch').value;
  var PinCode = document.getElementById('Pincode').value;
  var Nationality = document.getElementById('Nationality').value;
  var State = document.getElementById('State').value;
  var District = document.getElementById('District').value;
  var Lateral = document.querySelector('input[name="Lateral"]:checked').value;

alert(Name+'-'+FatherName+'-'+MotherName+'-'+Gender+'-'+MobileNo+'-'+CollegeName+'-'+Department+'-'+Course+'-'+Batch+'-'+PinCode+'-'+Nationality+'-'+State+'-'+District+'-'+Lateral);


  var code = 133;
  var data = {
    Name: Name,
    FatherName: FatherName,
    MotherName: MotherName,
    Gender: Gender,
    MobileNo: MobileNo,
    CollegeName: CollegeName,
    Department: Department,
    Course: Course,
    Batch: Batch,
    PinCode: PinCode,
    Nationality: Nationality,
    State: State,
    District: District,
    Lateral: Lateral,
    code: code
  };

  // Send the AJAX request
  $.ajax({
    url: 'action_g.php',
    data: data,
    type: 'POST',
    success: function(response) {
      console.log(response); // Log the response for debugging
      alert('Data submitted successfully!');
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
      alert('An error occurred while submitting data. Please try again.');
    }
  });
}

    function fetchcourse()
{   
   
  

 var College=document.getElementById('CollegeName').value;
       var department=document.getElementById('Department').value;

var code='305';
$.ajax({
url:'action.php',
data:{department:department,College:College,code:code},
type:'POST',
success:function(data)
{
if(data != "")
{
     console.log(data);
$("#Course").html("");
$("#Course").html(data);
}
}
});

}

</script>
<?php
include "footer.php";
?>
