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
                  $get_country="SELECT * FROM countries";
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
             <input type="text" class="form-control" id="previous_count" readonly>
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
<div class="modal fade" id="for_fee" tabindex="-1" role="dialog" aria-labelledby="for_feeLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_feeLabel">Fee Strucutre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
            <div class="row" >
              
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
                 <label>Department s</label>
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
             
               
   
             
              <div class="col-lg-3 new_fee_div" id='new_fee_div'>
                 <label>Applicables Fee</label>
                  <input type="number" id="FApplicables"  value="0" class="form-control"   required >
              </div>  

        
      <div class="col-lg-2" >
               <label>Registration Fee</label>
              <input type="text" class="form-control" id="FRegistrationFee">
            </div>
              <div class="col-lg-2" >
               <label>Tution Fee</label>
              <input type="text" class="form-control" id="FTutionFee">
            </div>
              <div class="col-lg-2">
               <label>Hostel Fee</label>
              <input type="text" class="form-control" id="FHostelFee">
            </div>
              <div class="col-lg-2">
               <label>Security Deposit</label>
              <input type="text" class="form-control" id="FSecurityDeposit">
            </div>
              <div class="col-lg-2">
               <label>Mess Charges</label>
              <input type="text" class="form-control" id="FMessCharges">
            </div>
              <div class="col-lg-2">
               <label>Other Academic Charges</label>
              <input type="text" class="form-control" id="FotherCharges">
            </div>
              <div class="col-lg-2">
               <label>Total Annual Fee</label>
              <input type="text" class="form-control" id="FtotalAnual">
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

<div class="col-lg-3">
                 <label>Batch / Admisison Year</label>
                  <select  id="Batch"  class="form-control" required>
                     <option value='2024'>2024</option>
                       <option value='2023'>2023</option>
                 </select>
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
                           <!-- Offer Letter -->
                           <button class="btn btn-warning" data-toggle="modal" data-target="#for_fee"><i class="fa fa-plus" ></i>Fee</button>
                        </div>
                     
                  </div>
               </div>
               <div class="card-body"  id="">
                  
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
           

           
            <div class="col-lg-3">
               <label>Student Name</label>
               <input type="text" value="" id="Name" class="form-control" > 
            </div>
            <div class="col-lg-3">
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
            <div class="col-lg-2" style="display: none;" id="AdharCardNo_div">
               <label>Adhar Card No</label>
               <input type="number" class="form-control" id="AdharCardNo" >
            </div>
            <div class="col-lg-2" style="display: none;" id="PassportNo_div">
               <label>Passport No</label>
              <input type="text" class="form-control" id="PassportNo">
            </div>
           

            <div class="col-lg-2">
                <label>College Name</label>
                 <select   id='CollegeName1' onchange="collegeByDepartment1(this.value);fatchFee();" class="form-control" required>
                 <option value=''>Select Faculty</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID";
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
                  <select  id="Department1"  class="form-control"  onchange="fetchcourse1();fatchFee();" required>
                     <option value=''>Select Department</option>
                 </select>
              </div>  


              <div class="col-lg-2">
                 <label>Course</label>
                  <select   id="Course1" class="form-control" onchange="fatchFee();" required >
                     <option value=''>Select Course</option>
                 </select>
              </div>


             

             
            <div class="col-lg-1">
              <label>Lateral Entry</label> <br>
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb18" onchange="fatchFee();"  value="No" name="Lateral" checked="">
                     <label for="radioPrimaryb18">
                     No
                     </label>
                 
               </div>
         
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb19" onchange="fatchFee();" value="Yes" name="Lateral">
                     <label for="radioPrimaryb19">
                     Yes
                     </label>
                
               </div>
            </div>
            <div class="col-lg-3">
                 <label>Batch / Admisison Year</label>
                  <select  id="Batch"  class="form-control " onchange="fatchFee();" required>
                     <option value='2024'>2024</option>
                       <option value='2023'>2023</option>
                 </select>
              </div> 

             <div class="col-lg-2">
               <label>Date Of Birth</label> <br>
                  <input type='date'  id="DOB"  class="form-control" required >
                    
              </div>
              <div class="col-lg-2">
               <label>Mobile No</label> <br>
                  <input type='text'  id="MobileNo"  class="form-control" required >
                    
              </div>
              <div class="col-lg-2">
               <label>Email</label> <br>
                  <input type='text'  id="Email"  class="form-control" required >
                    
              </div>

<div class="col-lg-3 col-md-3 col-sm-12">
          <label>Category</label>
          <select class="form-control" id="category">
              <option value="">Select</option>
              <option>SC</option>
              <option>ST</option>
              <option>OBC</option>

              <option>General</option>
          </select>
      </div>
      </div>
<hr>
      <div class="row" >
      <div class="col-lg-2" >
               <label>Registration Fee</label>
              <input type="text" class="form-control" id="RegistrationFee" >
            </div>
              <div class="col-lg-2" >
               <label>Tution Fee</label>
              <input type="text" class="form-control" id="TutionFee" >
            </div>
              <div class="col-lg-2">
               <label>Hostel Fee</label>
              <input type="text" class="form-control" id="HostelFee" >
            </div>
              <div class="col-lg-2">
               <label>Security Deposit</label>
              <input type="text" class="form-control" id="SecurityDeposit" >
            </div>
              <div class="col-lg-2">
               <label>Mess Charges</label>
              <input type="text" class="form-control" id="MessCharges" >
            </div>
              <div class="col-lg-2">
               <label>Other Academic Charges</label>
              <input type="text" class="form-control" id="otherCharges" >
            </div>
              <div class="col-lg-2">
               <label>Total Annual Fee</label>
              <input type="text" class="form-control" id="totalAnual" >
            </div>
              <div class="col-lg-2">
               <label>Program Start Date</label>
              <input type="date" class="form-control" id="pstartDate">
            </div>
              <div class="col-lg-6">
               <label>Deadline</label>
              <input type="text" class="form-control" id="deadline">
            </div>

           

            <div class="col-lg-3">
              
                  <select  id="Batch"  class="form-control" required hidden>
                     <option value='2024'>2024</option>
                       <option value='2023'>2023</option>
                 </select>
              </div> 


         <!--    <div class="col-lg-2">
              <label>Session</label>   -->
              <select class="form-control" id="session" hidden>
                <option value="2024-25">2024-25</option>
                 <option value="">Select</option>
                 <option value="2022-23">2022-23</option>
                 <option value="2023-24">2023-24</option>
                 <option value="2024-25">2024-25</option>
                 <option value="2025-26">2025-26</option>
                  
              </select>
          <!--  </div>  -->

             <!-- <div class="col-lg-3">
                <label>Course Duration</label>  
             -->
              <select class="form-control" id="duration" hidden>
                 <option value="">Select Years</option>
                 <option value="1">1 Year</option>
                 <option value="2">2 Years</option>
                 <option value="3">3 Years</option>
                 <option value="4">4 Years</option>
                 <option value="5">5 Years</option>
                 <option value="6">6 Years</option>
              </select>
            <!-- </div> -->
               <!-- <div class="col-lg-2">
                  <label>Course Duration</label>   -->

              <select class="form-control" id="months" hidden>
               
                 <option value="0">0 Month</option>
                 <option value="6">6 Month</option>
                
              </select>
           <!-- </div> -->
               
             <input type="hidden"  class="form-control"  id="Pincode" >
          
             
           </div>
           
            

            <div class="col-lg-12"> <label>&nbsp;</label>
               <p id="submit_record_button_message" style='float:left; color:red;font-size:18px;'></p>
              




               <button class="btn btn-primary " id="submit_record_button" onclick="submit_record()"  style='float:right;'>Submit</button>
          
            </div>
         </div>
            </div>
            
         </div>
                  
               </div>
            </div>
         </div>
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
              <!--  <div class="card-header">
                     <h5>All Records</h5> 
                  <div class="card-tools">
                      
                                     <div class="input-group input-group-sm">
                                       
                                       <input required type="text" id="RollNoSearch" class="form-control" placeholder="Ref.No and RollNo and ID Proof">
                                       <input  type="button" class="btn btn-success btn-xs" value="Search" onclick="by_search_studetn();">
                                       </div>
                              
                    
                  </div>
                  <div class="card-tools">
                     <div class="input-group input-group-sm">
                      
                     </div>
                  </div>
               </div> -->
               <script>


function by_search_studetn() {  
                    
                     var currentPage = 1;
                   var code = 134;
                   var searchQuery = '';
                     var by_search=document.getElementById('RollNoSearch').value;
                     var spinner=document.getElementById("ajax-loader");
   //   spinner.style.display='block';
                         $.ajax({
                            url: 'action_g.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                               page: currentPage,
                               code: code,
                               by_search: by_search,
                               search: searchQuery 
                            },
                            success: function(data) {
            if (Object.keys(data).length === 0) {
               ErrorToast('No Record Found', 'bg-warning');
                spinner.style.display = 'none';
               } else {
                
                 
                  buildTable(data);
                  updatePagination(currentPage);
                  spinner.style.display = 'none';
            }
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


                     //loadData(currentPage);

                     function loadData(page) {

                        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
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
            if (Object.keys(data).length === 0) {
               ErrorToast('No Record Found', 'bg-warning');
                spinner.style.display = 'none';
               } else {
                
                 
                  buildTable(data);
                  updatePagination(currentPage);
                  spinner.style.display = 'none';
            }
        },
                           error: function() {
                              // Handle error response
                           }
                        });
                     }


                     

                     function updatePagination(page) {
                        var totalPages = Math.ceil(100000 / 50);

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
                        var totalPages = Math.ceil(100000 / 50);
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
         function printletterhead1SelectedRows() {
   var id_array = document.getElementsByName('selectedRows[]');
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      window.open('print_offer_letter_plan.php?id_array='+id_array_main);
   } else {
      ErrorToast('All Input Required', 'bg-warning');
   }
}
         function printletterhead2SelectedRows() {
   var id_array = document.getElementsByName('selectedRows[]');
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      window.open('print_offer_letter_second_plan.php?id_array='+id_array_main);
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



function edit_student_details(id) {

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
    var months = document.getElementById('months').value;
 var RegistrationFee = document.getElementById('RegistrationFee').value;
  var TutionFee = document.getElementById('TutionFee').value;
   var HostelFee = document.getElementById('HostelFee').value;
  // var Lateral = document.querySelector('input[name="Lateral"]:checked').value;
  var Consultant = document.getElementById('Consultant_').value;
   var duration = document.getElementById('Duration').value;
  // var session = document.getElementById('session').value;
  // var AdharCardNo = document.getElementById('AdharCardNo').value;
  // var PassportNo = document.getElementById('PassportNo').value;
  var classroll = document.getElementById('classroll').value;
  var District = document.getElementById('District1').value;
 var Status1 = document.getElementById('Status1').value;
if(District!='' && Name!='' && FatherName!='' && Gender!='' && CollegeName!='' && Department!='' && Course!=''  && Nationality!='' && State!=''&& Consultant!='' )
{
  var code = 140;
  var data = {
    id: id,
    Name: Name,
    FatherName: FatherName,
    Gender: Gender,
    CollegeName: CollegeName,
    Department: Department,
    Course: Course,
    Nationality: Nationality,
    State: State,
    RegistrationFee:RegistrationFee,
    HostelFee:HostelFee,
    TutionFee:TutionFee,
    Consultant: Consultant,
    duration: duration,
    session: session,
 AdharCardNo: AdharCardNo,
    PassportNo: PassportNo,
    months:months,
    classroll: classroll,
    District1: District,  status:Status1,
    code: code
  };
 
  // Send the AJAX request
  $.ajax({
    url: 'action_g.php',
    data: data,
    type: 'POST',
    success: function(response) {
      console.log(response); // Log the response for debugging
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
function fatchFee()
{
   var CollegeName = document.getElementById('CollegeName1').value;
   var Department = document.getElementById('Department1').value;
   var Course = document.getElementById('Course1').value;
   var Batch = document.getElementById('Batch').value;
   var Lateral = document.querySelector('input[name="Lateral"]:checked').value;

   // alert(CollegeName+"="+Department+"="+Course+"="+Batch+"="+Lateral);
var code=133.2;
   $.ajax({
    url: 'action_g.php',
    data:{code:code,CollegeName:CollegeName,Department:Department,Course:Course,Batch:Batch,Lateral:Lateral},
    type: 'POST',
    dataType: 'json',
    success: function(response) {
        console.log(response); 
      
                document.getElementById('TutionFee').value=response.TutionFee;
                document.getElementById('HostelFee').value=response.HostelFee;
                document.getElementById('RegistrationFee').value=response.RegistrationFee;
                document.getElementById('SecurityDeposit').value=response.SecurityDeposit;
                document.getElementById('MessCharges').value=response.MessCharges;
                document.getElementById('otherCharges').value=response.otherCharges;
                document.getElementById('totalAnual').value=response.totalAnual;
    }
   })
}
function submit_record() {
  var Name = document.getElementById('Name').value;
  var FatherName = document.getElementById('FatherName').value;
  // var MotherName = document.getElementById('MotherName').value;
  var Gender = document.getElementById('Gender').value;
   var CollegeName = document.getElementById('CollegeName1').value;
   var Department = document.getElementById('Department1').value;
   var Course = document.getElementById('Course1').value;
   var MobileNo = document.getElementById('MobileNo').value;
   var DOB = document.getElementById('DOB').value;
   var Category = document.getElementById('category').value;
    var Batch = document.getElementById('Batch').value;
    var DOB = document.getElementById('DOB').value;
  var Nationality = document.getElementById('Nationality_').value;
    var Lateral = document.querySelector('input[name="Lateral"]:checked').value;

  var HostelFee = document.getElementById('HostelFee').value;
  var TutionFee = document.getElementById('TutionFee').value;
   var RegistrationFee = document.getElementById('RegistrationFee').value;
  var session = document.getElementById('session').value;
  var AdharCardNo = document.getElementById('AdharCardNo').value;
  var PassportNo = document.getElementById('PassportNo').value;
  var SecurityDeposit=document.getElementById('SecurityDeposit').value;
var MessCharges=document.getElementById('MessCharges').value;
var otherCharges=document.getElementById('otherCharges').value;
var totalAnual=document.getElementById('totalAnual').value;
var pstartDate=document.getElementById('pstartDate').value;
var deadline=document.getElementById('deadline').value;

if( Name!='' && FatherName!='' && Gender!='' && CollegeName!='' && Department!='' && Course!='' && session!=''  &&months!=''&& RegistrationFee!=''&& HostelFee!='' && TutionFee!='' && SecurityDeposit!='' && MessCharges!='' &&
otherCharges!='' &&
totalAnual!='' &&
pstartDate!='' &&
deadline!='')
 
{
   
   if(AdharCardNo!='' || PassportNo!='')
   {
  var code = 133.1;
   // alert(HostelFee);
  var data = {
    Name: Name,FatherName: FatherName,Gender: Gender,MobileNo: MobileNo,CollegeName: CollegeName,Department: Department,Course: Course,Batch: Batch,Nationality: Nationality,  
    Lateral: Lateral,DOB:DOB,session: session,AdharCardNo: AdharCardNo,PassportNo: PassportNo,Category :Category,code:code,RegistrationFee:RegistrationFee,TutionFee:TutionFee,HostelFee:HostelFee
   ,SecurityDeposit:SecurityDeposit,
MessCharges:MessCharges,
otherCharges:otherCharges,
totalAnual:totalAnual,
pstartDate:pstartDate,
deadline:deadline
   };
 
  // Send the AJAX request
  $.ajax({
    url: 'action_g.php',
    data: data,
    type: 'POST',
    success: function(response) {
        console.log(response); // Log the response for debugging
      // alert('Data submitted successfully!');
      if (response==1) {
      SuccessToast('Data submitted successfully');


      //loadData(currentPage);

   }
   else if(response==2)
   {
ErrorToast('ID Proof Already Exist','bg-warning');
   } else if(response==3)
   {
ErrorToast('Seats Full ','bg-warning');
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
function submit_fee() 
{
    var CollegeName = document.getElementById("CollegeName").value;
    var Department = document.getElementById("Department").value;
    var Batch = document.getElementById("Batch").value;
    var Course = document.getElementById("Course").value;
    var HostelFee = document.getElementById('FHostelFee').value;
    var TutionFee = document.getElementById('FTutionFee').value;
   var RegistrationFee = document.getElementById('FRegistrationFee').value;
   var SecurityDeposit=document.getElementById('FSecurityDeposit').value;
   var MessCharges=document.getElementById('FMessCharges').value;
   var otherCharges=document.getElementById('FotherCharges').value;
   var totalAnual=document.getElementById('FtotalAnual').value;
     var Lateral = document.querySelector('input[name="Lateral1"]:checked').value;
if (CollegeName!='' && Department!='' && Course!='' && HostelFee!='' &&
TutionFee!='' && RegistrationFee!='' && SecurityDeposit!='' && MessCharges!='' && otherCharges!='' && totalAnual!='') 
{
var code=136.1;
      $.ajax({
    url: 'action_g.php',
    data: {college:CollegeName,department:Department,course:Course,code:code,
      Lateral:Lateral,
      Batch:Batch,
      HostelFee:HostelFee,
      TutionFee:TutionFee,
      RegistrationFee:RegistrationFee,
      SecurityDeposit:SecurityDeposit,
      MessCharges:MessCharges,
      otherCharges:otherCharges,
      totalAnual:totalAnual
    },
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


function generate_student(id) 
{  
var code='177';
$.ajax({
url:'action_g.php',
data:{id:id,code:code},
type:'POST',
success:function(data){

SuccessToast('Generated successfully');
loadData(currentPage);

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
   console.log(data);
if(data != "")
{
     
$("#Department1").html("");
$("#Department1").html(data);
}
}
});

}
function collegeByDepartment(College) 
{  
     
var code='304';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
   console.log(data);
if(data != "")
{
     
$("#Department").html("");
$("#Department").html(data);
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
// count 
function export_all() 
      {
         var exportCode='22';

          window.location.href="export.php?exportCode="+exportCode; 
      
      }


function export_one(district,batch)  
      {
         // alert(district);
         var exportCode='23';
          window.location.href="export.php?exportCode="+exportCode+"&District="+district+"&batch="+batch;
      }

      //report 
function export_detail(batch) 
      {
         var exportCode='23';

      window.location.href="export.php?exportCode="+exportCode+"&batch="+batch+"&District="+0;
      
      }

      function export_course_wise_count() 
      {
         var exportCode='37';

      window.location.href="export.php?exportCode="+exportCode;
      
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
    console.log(data);
    document.getElementById('previous_count').value=data;
  
}
});

}
</script>
<?php
include "footer.php";
?>
