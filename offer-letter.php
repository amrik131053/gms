<?php
include "header.php";
?>
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
                  <input type="text" class="form-control" id="consultant_name">
               </div>
               <div class="col-lg-3">
                  <button class="btn btn-primary"><i class="fa fa-plus" onclick="add_consultant();"></i>ADD</button>
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
            <div class="row">
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
              <div class="col-lg-3">
                 <label>Applicables Fee</label>
                  <input type="text"id="Applicables"  class="form-control"  required >
              </div>  


              <div class="col-lg-2">
                 <label>Hostel Fee</label>
                 <input type="text" id="Hostel"  class="form-control"  required>
              </div>
              <div class="col-lg-3">
                 <label>University Concession</label>
                 
                 <input type="text" id="UniversityConcession"  class="form-control" onchange="calculation();"  required>
              </div>
              <div class="col-lg-4">
                 <label>Fee After  Concession(Anual)</label>
                 
                 <input type="text" id="FeeAfterConcession"  class="form-control"   readonly>
              </div>  
              <div class="col-lg-1">
                 <label>Action</label><br>
                 
                 <button class="btn btn-success" onclick="submit_fee();">Submit</button>
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
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
             <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card card-info " id="myCollapsible">
               <div class="card-header">
              <div class="card-tools">
                     
                        <div class="input-group input-group-sm">
                          
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
              <select class="form-control" id="Nationality" onchange="country_to_state(this.value); ShowHideDiv_address(this.value);">
                 <option value="">Select</option>
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
              
              <select class="form-control" id="State">

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
            <div class="col-lg-3">
               <label>Student Name</label>
               <input type="text" value="" id="Name" class="form-control" > 
            </div>
            <div class="col-lg-3">
               <label>Father Name</label>
               <input type="text" value="" id="FatherName" class="form-control" > 
            </div>
            
             <div class="col-lg-3">
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
            </div><div class="col-lg-3" style="display: none;" id="PassportNo_div">
               <label>Passport No</label>
              <input type="text" class="form-control" id="PassportNo">
            </div>
           

            <div class="col-lg-3">
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
              <label>Session</label>  
              <select class="form-control" id="session">
                 <option value="">Select</option>
                 <option value="2022-23">2022-23</option>
                 <option value="2023-24">2023-24</option>
                 <option value="2024-25">2024-25</option>
                 <option value="2025-26">2025-26</option>
                 
              </select>
            </div> 

             <div class="col-lg-2">
              <label>Course Duration</label>  
              <select class="form-control" id="duration">
                 <option value="">Select</option>
                 <option value="1">1 Year</option>
                 <option value="2">2 Years</option>
                 <option value="3">3 Years</option>
                 <option value="4">4 Years</option>
                 <option value="5">5 Years</option>
                 <option value="6">6 Years</option>
              </select>
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
                     <h5>All Records</h5>
                  <div class="card-tools">
                       <!--  <form action="sic-document-record-print.php" method="post" target="_blank">   
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
                                 </form> -->
                    
                  </div>
                  <div class="card-tools">
                     <div class="input-group input-group-sm">
                      
                     </div>
                  </div>
               </div>
               <script>


          function date_by_search() {
                     
                    var currentPage = 1;
                  var code = 134;
                  var searchQuery = '';
                    // alert(upload_date);
                        $.ajax({
                           url: 'action_g.php',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                              page: currentPage,
                              code: code,
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
                        table += '<div id="pagination"><td colspan="1"> <button id="prev-btn" class="btn btn-primary " disabled>Previous</button></td><td colspan="">  </td><td colspan=""></td><td><button onclick="printSelectedRows();" class="btn btn-success " >Print</button > <button onclick="printSelectedRows_second();" class="btn btn-success " >Print 2</button> </td><td><button id="next-btn" class="btn btn-primary ">Next</button></td></div>';
                        table += '</tr>';
                        table += '<tr><th width="10"><input type="checkbox" id="selectAllCheckbox" class="selectAllCheckbox" onchange="toggleSelectAll(this)"></th><th width="10">ID</th><th>Name</th><th>Father Name</th><th>Mobile No</th></tr>';
                        for (var i = 0; i < data.length; i++) {
                           var unirollno = data[i][2];
                           table += '<tr>';
                           table += '<td><input type="checkbox" name="selectedRows[]" value="' + data[i][0] + '"></td>';
                           table += '<td>' + data[i][0] + '</td>';
                           table += '<td>' + data[i][1] + '</td>';
                           table += '<td >'+ unirollno+'</td>';
                           // table += '<td>' + data[i][3] + '</td>';
                           table += '<td>' + data[i][5] + '</td>';
                           // table += '<td>' + data[i][6] + '</td>';
                           
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
  
    var CollegeName = document.getElementById("CollegeName").value;
    var Department = document.getElementById("Department").value;
    var Course = document.getElementById("Course").value;
    var Applicables = document.getElementById("Applicables").value;
    var Hostel = document.getElementById("Hostel").value;
    var UniversityConcession = document.getElementById("UniversityConcession").value;
    var FeeAfterConcession = document.getElementById("FeeAfterConcession").value;
    var Consultant = document.getElementById("Consultant").value;
var code=136;
      $.ajax({
    url: 'action_g.php',
    data: {college:CollegeName,department:Department,course:Course,applicable:Applicables,hostel:Hostel,concession:UniversityConcession,afterconcession:FeeAfterConcession,consultant_id:Consultant,code:code},
    type: 'POST',
    success: function(response) {
    
         SuccessToast('Successfully Inserted');
   
  },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
   
    }
  });
}function add_consultant() 
{
  
    var consultant_name = document.getElementById("consultant_name").value;
var code=135;
      $.ajax({
    url: 'action_g.php',
    data: {consultant_name:consultant_name,code:code},
    type: 'POST',
    success: function(response) {
    // console.log(response);
         SuccessToast('Successfully Inserted');
   
  },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
   
    }
  });
}








   function postcode() {
  var pincode = document.getElementById("Pincode").value;
  var countryDisplay = document.getElementById("Nationality");
  var stateDisplay = document.getElementById("State");
  var districtDisplay = document.getElementById("District");
  // var dropdown = document.getElementById("village_by_post");

  // Clear previous data
  countryDisplay.value = "";
  stateDisplay.value = "";
  districtDisplay.value = "";
  // dropdown.innerHTML = "";

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (response && response[0] && response[0].PostOffice && response[0].PostOffice.length > 0) {
        var Country = response[0].PostOffice[0].Country;
        var State = response[0].PostOffice[0].State;
        var District = response[0].PostOffice[0].District;

        countryDisplay.value = Country;
        stateDisplay.value = State;
        districtDisplay.value = District;

        // for (var i = 0; i < response[0].PostOffice.length; i++) {
        //   var option = document.createElement("option");
        //   option.value = i;
        //   option.text = response[0].PostOffice[i].Name;
        //   dropdown.add(option);
        // }
      }
    }
  };

  var url = "https://api.postalpincode.in/pincode/" + pincode;
  xhr.open("GET", url, true);
  xhr.send();
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
  // var PinCode = document.getElementById('Pincode').value;
  var Nationality = document.getElementById('Nationality').value;
  var State = document.getElementById('State').value;
  // var District = document.getElementById('District').value;
  var Lateral = document.querySelector('input[name="Lateral"]:checked').value;
  var Consultant = document.getElementById('Consultant_').value;
  var duration = document.getElementById('duration').value;
  var session = document.getElementById('session').value;
  var AdharCardNo = document.getElementById('AdharCardNo').value;
  var PassportNo = document.getElementById('PassportNo').value;

if(Name!='' && FatherName!='' && Gender!='' && MobileNo!='' && CollegeName!='' && Department!='' && Course!='' && Batch!='' && PinCode!='' && Nationality!='' && State!='' && District!='' )

{
  var code = 133;
  var data = {
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
      date_by_search();
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



function collegeByDepartment1(College) 
{  
     
var code='304';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
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
     console.log(data);
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

</script>
<?php
include "footer.php";
?>
