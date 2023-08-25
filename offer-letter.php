<?php
include "header.php";
?>
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<div class="modal fade" id="for_add_adm_count" tabindex="-1" role="dialog" aria-labelledby="for_add_adm_countLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_add_adm_countLabel">Add Admission Count</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row" id=''>
            <div class="col-lg-3">
              <label>Nationality</label>  
              <select class="form-control" id="Nationality_1" onchange="fetch_state1(this.value);">
                 <option value="">Country</option>
                 <?php 
                  $get_country="SELECT * FROM countries ";
                  $get_country_run=mysqli_query($conn,$get_country);
                  while($row=mysqli_fetch_array($get_country_run))
                  {?>
                        <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                  <?php }

                 ?>
              </select>
             
            </div> 
            <div class="col-lg-3">
               <label>State</label>  
             <select class="form-control" id="State_1" onchange="fetch_district1(this.value);">
                 <option value="">State</option> 
              </select>
           </div>
           <div class="col-lg-2">
               <label>District</label>  
             <select class="form-control" id="District_1" onchange="admisssion_complete1(this.value);">
                 <option value="">District</option>
              </select>
           </div>
           <div class="col-lg-2">
               <label>Previous Count</label>  
             <input type="number" class="form-control" id="previous_count" readonly>
           </div>
           <div class="col-lg-2">
               <label>Count</label>  
             <input type="number" class="form-control" id="adm_count">
           </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="submit_count();">Save</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="for_report" tabindex="-1" role="dialog" aria-labelledby="for_reportLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_reportLabel">Reports</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row" id='all_record_report'>
               
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="export_all();">Export All</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="for_consultant" tabindex="-1" role="dialog" aria-labelledby="for_consultantLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_consultantLabel">New Consultant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
               <div class="col-lg-9">
                  <input type="text" class="form-control" id="consultant_name" value="">
               </div>
               <div class="col-lg-3">
                  <button class="btn btn-primary" onclick="add_consultant();"><i class="fa fa-plus" ></i>ADD</button>
               </div>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>

</div>
<div class="modal fade" id="for_edit" tabindex="-1" role="dialog" aria-labelledby="for_editLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_editLabel">Record Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit_show">
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>

</div>
<div class="modal fade" id="for_fee" tabindex="-1" role="dialog" aria-labelledby="for_feeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_feeLabel">Fee Strucutre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="col-lg-6">
              <label>Fee Applicable</label> <br>
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb16"  value="New" name="FeeType" checked="" onclick="ShowHideDiv_feetype('0');">
                     <label for="radioPrimaryb16">
                     New
                     </label>
                 
               </div>
              
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb17"  value="Old" name="FeeType" onclick="ShowHideDiv_feetype('1');">
                     <label for="radioPrimaryb17">
                     Old
                     </label>
                
               </div>
            </div>
            <div class="row" >
               <div class="col-lg-3">
                 <label>Consultant</label>
                  <select  id="Consultant"  class="form-control" required>
                     <option value=''>Select Consultant</option>
                     <?php  $get_consultant="SELECT * FROM consultant_master "; 
                     $get_consultant_run=mysqli_query($conn,$get_consultant);
                     while($row=mysqli_fetch_array($get_consultant_run))
                     {?>

                     <option value='<?=$row['id'];?>'><?=$row['state'];?></option>
                     
                     <?php }?>
                 </select>
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
               <div class="col-lg-3">
                 <label>Department</label>
                  <select  id="Department"  class="form-control"  onchange="fetchcourse()" required>
                     <option value=''>Select Department</option>
                 </select>
              </div>  


              <div class="col-lg-3">
                 <label>Course</label>
                  <select   id="Course" class="form-control" required >
                     <option value=''>Select Course</option>
                 </select>
              </div>
             
               
                <div class="col-lg-3" id='old_fee_div' style="display:none;">
                 <label>Fee Applicable</label>
                  <select  id="Consultant_old"  class="form-control" required>
                     <option value=''>Select Consultant</option>
                     <?php  $get_consultant="SELECT * FROM consultant_master "; 
                     $get_consultant_run=mysqli_query($conn,$get_consultant);
                     while($row=mysqli_fetch_array($get_consultant_run))
                     {?>

                     <option value='<?=$row['id'];?>'><?=$row['state'];?></option>
                     
                     <?php }?>
                 </select>
              </div> 
             
              <div class="col-lg-3 new_fee_div" id='new_fee_div'>
                 <label>Applicables Fee</label>
                  <input type="number" id="Applicables"  value="0" class="form-control"  onblur="calculation();" required >
              </div>  


              <div class="col-lg-2 new_fee_div" id='new_fee_div'>
                 <label>Hostel Fee</label>
                 <input type="number" id="Hostel"  value="0" class="form-control"  onblur="calculation();"  required>
              </div>
              <div class="col-lg-3 new_fee_div" id='new_fee_div'>
                 <label>University Concession</label>
                 
                 <input type="number" id="UniversityConcession" value="0"  class="form-control" onblur="calculation();"  required>
              </div>
              <div class="col-lg-4 new_fee_div" id='new_fee_div'>
                 <label>Fee After  Concession(Anual)</label>
                 
                 <input type="text" id="FeeAfterConcession"  class="form-control"   readonly>
              </div>  
                     <div class="col-lg-2">
              <label>Lateral Entry</label> <br>

                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb20"  value="No" name="Lateral1" checked="">
                     <label for="radioPrimaryb20">
                     No
                     </label>
                 
               </div>
              
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb21"  value="Yes" name="Lateral1">
                     <label for="radioPrimaryb21">
                     Yes
                     </label>
                
               </div>
            </div>


            <!--   <div class="col-lg-1">
                 <label>Action</label><br>
                 
                 <button class="btn btn-success" onclick="submit_fee();">Submit</button>
              </div>   -->
            </div>
           
              


      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button class="btn btn-success" onclick="submit_fee();">Submit</button>
      </div>
    </div>
  </div>
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
             <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card card-info " id="myCollapsible">
               <div class="card-header">
              <div class="card-tools">
                     
                        <div class="input-group input-group-sm">
                        <button  data-toggle="modal" data-target="#for_add_adm_count" class="btn btn-success " >Add Count</button >
                        &nbsp;
                           &nbsp;
                           &nbsp;
                        <button onclick="all_report();" data-toggle="modal" data-target="#for_report" class="btn btn-success " >Report</button >
                        &nbsp;
                           &nbsp;
                           &nbsp;
                        <button class="btn btn-primary" data-toggle="modal" data-target="#for_consultant"><i class="fa fa-plus" ></i>Consultant</button>
                           &nbsp;
                           &nbsp;
                           &nbsp;
                           <button class="btn btn-warning" data-toggle="modal" data-target="#for_fee"><i class="fa fa-plus" ></i>Fee</button>
                        </div>
                    
                  </div>
               </div>
               <div class="card-body "  id="">
                  
                     <div class="row">
            <div class="col-lg-12">
               
         <div class="row">
                <div class="col-lg-2">
              <label>Nationality</label>  
              <select class="form-control" id="Nationality_" onchange="fetch_state(this.value);ShowHideDiv_address(this.value);">
                 <option value="">Country</option>
                 <?php 
                  $get_country="SELECT * FROM countries ";
                  $get_country_run=mysqli_query($conn,$get_country);
                  while($row=mysqli_fetch_array($get_country_run))
                  {?>
                        <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                  <?php }

                 ?>
              </select>
             
            </div> 
            <div class="col-lg-2">
               <label>State</label>  
             <select class="form-control" id="State_" onchange="fetch_district(this.value);">
                 <option value="">State</option> 
              </select>
           </div>
           <div class="col-lg-2">
               <label>District</label>  
             <select class="form-control" id="District" onchange="admisssion_complete(this.value);">
                 <option value="">District</option>
              </select>
           </div>

            <div class="col-lg-2">
              <label>Consultant</label>  
              <select  id="Consultant_"  class="form-control" >
                     <option value=''>Select Consultant</option>
                     <?php  $get_consultant="SELECT * FROM consultant_master "; 
                     $get_consultant_run=mysqli_query($conn,$get_consultant);
                     while($row=mysqli_fetch_array($get_consultant_run))
                     {?>

                     <option value="<?=$row['id'];?>"><?=$row['state'];?></option>
                     
                     <?php }?>
                 </select>
            </div>
            <div class="col-lg-4">
               <label>Student Name</label>
               <input type="text" value="" id="Name" class="form-control" > 
            </div>
            <div class="col-lg-4">
               <label>Father Name</label>
               <input type="text" value="" id="FatherName" class="form-control" > 
            </div>
            
             <div class="col-lg-2">
               <label>Gender</label>
               <select id="Gender" class="form-control">
                  <option value="">Select</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
               </select>
            </div> 
            <div class="col-lg-3" style="display: none;" id="AdharCardNo_div">
               <label>Adhar Card No</label>
               <input type="number" class="form-control" id="AdharCardNo" >
            </div>
            <div class="col-lg-3" style="display: none;" id="PassportNo_div">
               <label>Passport No</label>
              <input type="text" class="form-control" id="PassportNo">
            </div>
           

            <div class="col-lg-2">
                <label>College Name</label>
                 <select   id='CollegeName1' onchange="collegeByDepartment1(this.value);" class="form-control" required>
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
                  <select  id="Department1"  class="form-control"  onchange="fetchcourse1()" required>
                     <option value=''>Select Department</option>
                 </select>
              </div>  


              <div class="col-lg-2">
                 <label>Course</label>
                  <select   id="Course1" class="form-control" required >
                     <option value=''>Select Course</option>
                 </select>
              </div>


             

             
            <div class="col-lg-2">
              <label>Lateral Entry</label> <br>
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb18"  value="No" name="Lateral" checked="">
                     <label for="radioPrimaryb18">
                     No
                     </label>
                 
               </div>
              
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb19"  value="Yes" name="Lateral">
                     <label for="radioPrimaryb19">
                     Yes
                     </label>
                
               </div>
            </div>


         <!--    <div class="col-lg-2">
              <label>Session</label>   -->
              <select class="form-control" id="session" hidden>
                <option value="2023-24">2023-24</option>
                 <option value="">Select</option>
                 <option value="2022-23">2022-23</option>
                 <option value="2023-24">2023-24</option>
                 <option value="2024-25">2024-25</option>
                 <option value="2025-26">2025-26</option>
                  
              </select>
          <!--  </div>  -->

             <div class="col-lg-3">
                <label>Course Duration</label>  
            
              <select class="form-control" id="duration">
                 <option value="">Select Years</option>
                 <option value="1">1 Year</option>
                 <option value="2">2 Years</option>
                 <option value="3">3 Years</option>
                 <option value="4">4 Years</option>
                 <option value="5">5 Years</option>
                 <option value="6">6 Years</option>
              </select>
            </div>
               <div class="col-lg-2">
                  <label>Course Duration</label>  

              <select class="form-control" id="months">
               
                 <option value="0">0 Month</option>
                 <option value="6">6 Month</option>
                
              </select>
           </div>
               
             <input type="hidden"  class="form-control"  id="Pincode" >
          
             
           </div>
           
            

            <div class="col-lg-12"> <label>&nbsp;</label>
               <p id="submit_record_button_message" style='float:left; color:red;font-size:18px;'></p>
              
               <button class="btn btn-primary " id="submit_record_button" onclick="submit_record()" disabled style='float:right;'>Submit</button>
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
                     <!-- <h5>All Records</h5> -->
                  <div class="card-tools">
                      
                                     <div class="input-group input-group-sm">
                                       
                                       <input required type="text" id="RollNoSearch" class="form-control" placeholder="RollNo and ID Proof">
                                       <input  type="button" class="btn btn-success btn-xs" value="Search" onclick="by_search_studetn();">
                                       </div>
                              
                    
                  </div>
                  <div class="card-tools">
                     <div class="input-group input-group-sm">
                      
                     </div>
                  </div>
               </div>
               <script>


function by_search_studetn() {
                    
                     var currentPage = 1;
                   var code = 134;
                   var searchQuery = '';
                     var by_search=document.getElementById('RollNoSearch').value;
                     // alert(by_search);
                         $.ajax({
                            url: 'action_g.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                               page: currentPage,
                               code: code,
                               by_search: by_search,
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
                  var code = 134;
                  var searchQuery = '';
                    var by_search="";


                     loadData(currentPage);

                     function loadData(page) {
                        // var by_search=document.getElementById('by_search').value;
                        $.ajax({
                           url: 'action_g.php',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                              page: page,
                              code: code,
                              by_search: by_search,
                              search: searchQuery // Pass the search query to the server
                           },
                           success: function(data) {
                              // console.log(data);
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
                        table += '<div id="pagination"><td colspan="3"> <button id="prev-btn" class="btn btn-primary " disabled>Previous</button></td><td colspan="">  </td><td colspan=""></td><td><button onclick="printSelectedRows();" class="btn btn-success " >Print</button ></td><td> <button onclick="printSelectedRows_second();" class="btn btn-success " >Print 2</button> </td><td><button id="next-btn" class="btn btn-primary ">Next</button></td></div>';
                        table += '</tr>';
                        table += '<tr><th width="10"><input type="checkbox" id="selectAllCheckbox" class="selectAllCheckbox" onchange="toggleSelectAll(this)"></th><th width="10">ID</th><th>Class RollNo</th><th>ID Proof</th><th>Name</th><th>Father Name</th><th>Course</th><th>Action</th></tr>';

                        for (var i = 0; i < data.length; i++) {
                           var unirollno = data[i][2];
                           table += '<tr>';
                           table += '<td><input type="checkbox" name="selectedRows[]" value="' + data[i][0] + '"></td>';
                           table += '<td>' + data[i][0] + '</td>';
                           table += '<td>' + data[i][20] + '</td>';
                           table += '<td>' + data[i][6] + '</td>';
                           table += '<td>' + data[i][1] + '</td>';
                           table += '<td >'+ unirollno+'</td>';
                           table += '<td >'+ data[i][29]+'</td>';
                           // table += '<td >'+ data[i][30]+'</td>';
                           table += '<td><button onclick="edit_student('+ data[i][0] +');" data-toggle="modal" data-target="#for_edit" class="btn btn-success btn-xs " ><i class="fa fa-edit"></i></button ></td>';
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
            

              function printSelectedRows() {
               // alert();
   var id_array = document.getElementsByName('selectedRows[]');
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      window.open('print_offer_letter.php?id_array=' + id_array_main);
   } else {
      ErrorToast('All Input Required', 'bg-warning');
   }
}     
         function printSelectedRows_second() {
   var id_array = document.getElementsByName('selectedRows[]');
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      window.open('print_offer_letter_second.php?id_array='+id_array_main);
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

                
               </script>
               <div id="data-table">
                 
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
function calculation() {
   var Applicables = document.getElementById("Applicables").value;

    var Hostel = document.getElementById("Hostel").value;
    var UniversityConcession = document.getElementById("UniversityConcession").value;

FeeAfterConcession_new=parseInt(Applicables)+parseInt(Hostel);
FeeAfterConcession=parseInt(FeeAfterConcession_new)-parseInt(UniversityConcession);

document.getElementById("FeeAfterConcession").value=FeeAfterConcession;
}

function submit_fee() 
{
   var FeeType = document.querySelector('input[name="FeeType"]:checked').value;
   if(FeeType=='New')
{
    var CollegeName = document.getElementById("CollegeName").value;
    var Department = document.getElementById("Department").value;
    var Course = document.getElementById("Course").value;
    var Applicables = document.getElementById("Applicables").value;
    var Hostel = document.getElementById("Hostel").value;
    var UniversityConcession = document.getElementById("UniversityConcession").value;
    var FeeAfterConcession = document.getElementById("FeeAfterConcession").value;
    var Consultant = document.getElementById("Consultant").value;
     var Lateral = document.querySelector('input[name="Lateral1"]:checked').value;


if (CollegeName!='' && Department!='' && Course!='' && Applicables !='' && Hostel!='' && UniversityConcession!='') 
{

var code=136;
      $.ajax({
    url: 'action_g.php',
    data: {college:CollegeName,department:Department,course:Course,applicable:Applicables,hostel:Hostel,concession:UniversityConcession,afterconcession:FeeAfterConcession,consultant_id:Consultant,code:code,Lateral:Lateral},
    type: 'POST',
    success: function(response) {
      console.log(response);
      if (response==1) {
    
         SuccessToast('Successfully Inserted');
      }
      else if(response==2)
      {
          ErrorToast('fee already added  ','bg-warning');
      } else
      {
          ErrorToast('try after some time  ','bg-danger');
      }
   
  },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
   
    }
  });
}

else
{
   ErrorToast('All Input Required ','bg-warning');
}
}
else
{
    var CollegeName = document.getElementById("CollegeName").value;
    var Department = document.getElementById("Department").value;
    var Course = document.getElementById("Course").value;
    var Lateral = document.querySelector('input[name="Lateral1"]:checked').value;
    var Consultant = document.getElementById("Consultant").value;
    var Consultant_old = document.getElementById("Consultant_old").value;
   //  alert(CollegeName+'-'+Department+'-'+Course+'-'+Lateral+'-'+Consultant+'-'+Consultant_old);
    if (CollegeName!='' && Department!='' && Course!='' ) 
{
var code=155;
      $.ajax({
    url: 'action_g.php',
    data: {Lateral:Lateral,college:CollegeName,department:Department,course:Course,consultant_id:Consultant,consultant_id_old:Consultant_old,code:code},
    type: 'POST',
    success: function(response) {
      console.log(response);
      if (response==1) {
    
         SuccessToast('Successfully Inserted');
      }
      else
      {
          ErrorToast('try after some time  ','bg-danger');
      }
   
  },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
   
    }
  });
}

else
{
   ErrorToast('All Input Required ','bg-warning');
}
}
}

function add_consultant() 
{
  // alert();
    var consultant_name = document.getElementById("consultant_name").value;
    if (consultant_name!='' && consultant_name!=null) 
    {
var code=135;
      $.ajax({
    url: 'action_g.php',
    data: {consultant_name:consultant_name,code:code},
    type: 'POST',
    success: function(response)
     {
    // console.log(response);
    if (response=='1') {
         SuccessToast('Successfully Inserted');
   }
   else
   {
      ErrorToast('Try after some time ','bg-warning');
   }
  },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
   
    }
  });
}
else
{
   ErrorToast('All Input Required ','bg-warning');
}
}

//    function postcode() {
//   var pincode = document.getElementById("Pincode").value;
// //   var countryDisplay = document.getElementById("Nationality");
//   var stateDisplay = document.getElementById("State_");
//   var districtDisplay = document.getElementById("District");
//   // var dropdown = document.getElementById("village_by_post");

//   // Clear previous data
// //   countryDisplay.value = "";
//   stateDisplay.value = "";
//   districtDisplay.value = "";
//   // dropdown.innerHTML = "";

//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function() {
//     if (xhr.readyState === 4 && xhr.status === 200) {
//       var response = JSON.parse(xhr.responseText);
//       if (response && response[0] && response[0].PostOffice && response[0].PostOffice.length > 0) {
//       //   var Country = response[0].PostOffice[0].Country;
//         var State = response[0].PostOffice[0].State;
//         var District = response[0].PostOffice[0].District;

//       //   countryDisplay.value = Country;
//         stateDisplay.value = State;
//         districtDisplay.value = District;

//         // for (var i = 0; i < response[0].PostOffice.length; i++) {
//         //   var option = document.createElement("option");
//         //   option.value = i;
//         //   option.text = response[0].PostOffice[i].Name;
//         //   dropdown.add(option);
//         // }
//       }
//     }
//   };

//   var url = "https://api.postalpincode.in/pincode/" + pincode;
//   xhr.open("GET", url, true);
//   xhr.send();
// }
function edit_student_details(id) {
   // alert(id);
  var Name = document.getElementById('Name').value;
  var FatherName = document.getElementById('FatherName').value;
  // var MotherName = document.getElementById('MotherName').value;
  var Gender = document.getElementById('Gender').value;
  // var MobileNo = document.getElementById('MobileNo').value;
  var CollegeName = document.getElementById('CollegeName1').value;
  var Department = document.getElementById('Department1').value;
  var Course = document.getElementById('Course1').value;
  // var Batch = document.getElementById('batch').value;
  // var PinCode = document.getElementById('Pincode').value;
  var Nationality = document.getElementById('Nationality').value;
  var State = document.getElementById('State').value;
//   var District = document.getElementById('District1').value;
  // var Lateral = document.querySelector('input[name="Lateral"]:checked').value;
  var Consultant = document.getElementById('Consultant_').value;
   var duration = document.getElementById('Duration').value;
  // var session = document.getElementById('session').value;
  // var AdharCardNo = document.getElementById('AdharCardNo').value;
  // var PassportNo = document.getElementById('PassportNo').value;
  var classroll = document.getElementById('classroll').value;
  var District = document.getElementById('District1').value;

if(District!='' && Name!='' && FatherName!='' && Gender!='' && CollegeName!='' && Department!='' && Course!=''  && Nationality!='' && State!=''&& Consultant!='' )
{
  var code = 140;
  var data = {
    id: id,
    Name: Name,
    FatherName: FatherName,
    // MotherName: MotherName,
    Gender: Gender,
    // MobileNo: MobileNo,
    CollegeName: CollegeName,
    Department: Department,
    Course: Course,
    // Batch: Batch,
    // PinCode: PinCode,
    Nationality: Nationality,
    State: State,
    // District: District,
    Consultant: Consultant,
    // Lateral: Lateral,
    duration: duration,
    // session: session,
    // AdharCardNo: AdharCardNo,
    // PassportNo: PassportNo,
    classroll: classroll,
    District1: District,
    code: code
  };
 
  // Send the AJAX request
  $.ajax({
    url: 'action_g.php',
    data: data,
    type: 'POST',
    success: function(response) {
      // console.log(response); // Log the response for debugging
      // alert('Data submitted successfully!');
      if (response==1) {
      SuccessToast('Data submitted successfully');
      // date_by_search();
   }
   else if(response==2)
   {
ErrorToast('ID Proof Already Exist','bg-warning');
   }
   else
   {
ErrorToast('Try  after some time','bg-danger');

   }
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
      // alert('An error occurred while submitting data. Please try again.');
    }
  });
}
else
{
   ErrorToast('All Input Required','bg-warning');
}
}
function submit_record() {
  var Name = document.getElementById('Name').value;
  var FatherName = document.getElementById('FatherName').value;
  // var MotherName = document.getElementById('MotherName').value;
  var Gender = document.getElementById('Gender').value;
  // var MobileNo = document.getElementById('MobileNo').value;
  var CollegeName = document.getElementById('CollegeName1').value;
  var Department = document.getElementById('Department1').value;
  var Course = document.getElementById('Course1').value;
  // var Batch = document.getElementById('batch').value;
  var PinCode = document.getElementById('Pincode').value;
  var Nationality = document.getElementById('Nationality_').value;
  var State = document.getElementById('State_').value;
  var District = document.getElementById('District').value;
  var Lateral = document.querySelector('input[name="Lateral"]:checked').value;
  var Consultant = document.getElementById('Consultant_').value;
  var duration = document.getElementById('duration').value;
   var months = document.getElementById('months').value;
  var session = document.getElementById('session').value;
  var AdharCardNo = document.getElementById('AdharCardNo').value;
  var PassportNo = document.getElementById('PassportNo').value;


if(State!='' && District!='' && Name!='' && FatherName!='' && Gender!='' && CollegeName!='' && Department!='' && Course!='' && session!='' && duration!='' && Consultant!='' &&months!='')
 
{
   if(AdharCardNo!='' || PassportNo!='')
   {
  var code = 133;
  var data = {
    Name: Name,
    FatherName: FatherName,
    months:months,
    // MotherName: MotherName,
    Gender: Gender,
    // MobileNo: MobileNo,
    CollegeName: CollegeName,
    Department: Department,
    Course: Course,
    // Batch: Batch,
    PinCode: PinCode,
    Nationality: Nationality,
    State: State,
    District: District,
    Consultant: Consultant,
    Lateral: Lateral,
    duration: duration,
    session: session,
    AdharCardNo: AdharCardNo,
    PassportNo: PassportNo,
    code: code
  };
 
  // Send the AJAX request
  $.ajax({
    url: 'action_g.php',
    data: data,
    type: 'POST',
    success: function(response) {
      // console.log(response); // Log the response for debugging
      // alert('Data submitted successfully!');
      if (response==1) {
      SuccessToast('Data submitted successfully');
   }
   else if(response==2)
   {
ErrorToast('ID Proof Already Exist','bg-warning');
   }
   else
   {
ErrorToast('Try  after some time','bg-danger');

   }
    },
    error: function(xhr, status, error) {
      // console.error(xhr.responseText);
      // alert('An error occurred while submitting data. Please try again.');
    }
  });
}
}
else
{
   ErrorToast('All Input Required','bg-warning');
}
}

function submit_count() {
 
  var Nationality = document.getElementById('Nationality_1').value;
  var State = document.getElementById('State_1').value;
  var District = document.getElementById('District_1').value;
  var previous_count = document.getElementById('previous_count').value;
  var adm_count = document.getElementById('adm_count').value;
if(State!='' && District!='' && adm_count!='')
{
  var code = 163;
  var data = {
    Nationality: Nationality,
    State: State,
    District: District,
    previous_count: previous_count,
    adm_count: adm_count,
    code: code
  };
 
  // Send the AJAX request
  $.ajax({
    url: 'action_g.php',
    data: data,
    type: 'POST',
    success: function(response) {
      if (response==1) {
         admisssion_complete1(District);
      SuccessToast('Data submitted successfully');
   }
    },
    error: function(xhr, status, error) {
      // console.error(xhr.responseText);
      // alert('An error occurred while submitting data. Please try again.');
    }
  });
}
else{

}
}

function all_report() 
{  
   var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
var code='326';
$.ajax({
url:'action.php',
data:{code:code},
type:'POST',
success:function(data){
   spinner.style.display='none';
document.getElementById('all_record_report').innerHTML=data;
}
});
}
function edit_student(id) 
{  
var code='139';
$.ajax({
url:'action_g.php',
data:{id:id,code:code},
type:'POST',
success:function(data){
document.getElementById('edit_show').innerHTML=data;
}
});

}

function collegeByDepartment1(College) 
{  
     
var code='304';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
   // console.log(data);
if(data != "")
{
     
$("#Department1").html("");
$("#Department1").html(data);
}
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
   function fetchcourse1()
{   
 var College=document.getElementById('CollegeName1').value;
       var department=document.getElementById('Department1').value;
var code='305';
$.ajax({
url:'action.php',
data:{department:department,College:College,code:code},
type:'POST',
success:function(data)
{
if(data != "")
{
     // console.log(data);
$("#Course1").html("");
$("#Course1").html(data);
}
}
});
}
function ShowHideDiv_address(id)
{
   // alert(id);
   if (id=='101')
    {
   $('#AdharCardNo_div').show('Slow');
   $('#PassportNo_div').hide('Slow');
   document.getElementById('PassportNo').value="";
    }
    else
    {
   $('#PassportNo_div').show('Slow');
    $('#AdharCardNo_div').hide('Slow');
    document.getElementById('AdharCardNo').value="";

    }

}
function ShowHideDiv_feetype(id)
{
   // alert(id);
   if (id=='0')
    {
   $('.new_fee_div').show('Slow');
   $('#old_fee_div').hide('Slow');
   document.getElementById("CollegeName").value="";
   document.getElementById("Department").value="";
   document.getElementById("Course").value="";
   document.getElementById("Applicables").value="";
   document.getElementById("Hostel").value="";
   document.getElementById("UniversityConcession").value="";
   document.getElementById("FeeAfterConcession").value="";
   document.getElementById("Consultant").value="";
   // document.getElementById("Consultant_old").value="";
    }
    else
    {
   $('#old_fee_div').show('Slow');
    $('.new_fee_div').hide('Slow');
   document.getElementById("CollegeName").value="";
   document.getElementById("Department").value="";
   document.getElementById("Course").value="";
   document.getElementById("Applicables").value="";
   document.getElementById("Hostel").value="";
   document.getElementById("UniversityConcession").value="";
   document.getElementById("FeeAfterConcession").value="";
   document.getElementById("Consultant").value="";
   // document.getElementById("Consultant_old").value="";

    }

}
function export_all() 
      {
         var exportCode='22';

          window.location.href="export.php?exportCode="+exportCode;
      
      }
function export_one(district) 
      {
         // alert(district);
         var exportCode='23';
          window.location.href="export.php?exportCode="+exportCode+"&District="+district;
      }


      function fetch_state(country_id) 
{  
     
var code='160';
$.ajax({
url:'action_g.php',
data:{country_id:country_id,code:code},
type:'POST',
success:function(data){
   // console.log(data);
if(data != "")
{
     
$("#State_").html("");
$("#State_").html(data);
}
}
});

}
function fetch_district(state_id) 
{       
var code='161';
$.ajax({
url:'action_g.php',
data:{state_id:state_id,code:code},
type:'POST',
success:function(data){
   // console.log(data);
if(data != "")
{
     
$("#District").html("");
$("#District").html(data);
}
}
});

}

function fetch_state2(country_id) 
{  
     
var code='160';
$.ajax({
url:'action_g.php',
data:{country_id:country_id,code:code},
type:'POST',
success:function(data){
   // console.log(data);
if(data != "")
{
     
$("#State").html("");
$("#State").html(data);
}
}
});

}
function fetch_district2(state_id) 
{       
var code='161';
$.ajax({
url:'action_g.php',
data:{state_id:state_id,code:code},
type:'POST',
success:function(data){
   console.log(data);
if(data != "")
{
     
$("#District1").html("");
$("#District1").html(data);
}
}
});

}
function admisssion_complete(district)
{
   var code='162';
   var State = document.getElementById('State_').value;
$.ajax({
url:'action_g.php',
data:{District:district,State:State,code:code},
type:'POST',
success:function(data){
   if(data==1)
   {
      document.getElementById("submit_record_button").disabled = false;
      document.getElementById("submit_record_button_message").innerHTML ="";
console.log(data);
   }

   else if(data=='0')
   {
      document.getElementById("submit_record_button").disabled = true;
      document.getElementById("submit_record_button_message").innerHTML ="admissions already  completed for this district";

      console.log(data);
   }
   else{

   }
}
});

}


function fetch_state1(country_id) 
{  
     
var code='160';
$.ajax({
url:'action_g.php',
data:{country_id:country_id,code:code},
type:'POST',
success:function(data){
   // console.log(data);
if(data != "")
{
     
$("#State_1").html("");
$("#State_1").html(data);
}
}
});

}
function fetch_district1(state_id) 
{       
var code='161';
$.ajax({
url:'action_g.php',
data:{state_id:state_id,code:code},
type:'POST',
success:function(data){
   // console.log(data);
if(data != "")
{
     
$("#District_1").html("");
$("#District_1").html(data);
}
}
});

}
function admisssion_complete1(district)
{
   var code='164';
   var State = document.getElementById('State_').value;
   $.ajax({
      url:'action_g.php',
      data:{District:district,State:State,code:code},
      type:'POST',
      success:function(data){

    document.getElementById('previous_count').value=data;
  
}
});

}
</script>
<?php
include "footer.php";
?>
