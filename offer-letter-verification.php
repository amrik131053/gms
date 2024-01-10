<?php
include "header.php";
?>
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<div class="modal fade" id="for_edit" tabindex="-1" role="dialog" aria-labelledby="for_editLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_editLabel">Record verified</h5>
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
<section class="content">
   <div class="container-fluid">
      <div class="row">
        
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                     <!-- <h5>All Records</h5> -->
                  <div class="card-tools">
                      
                                     <div class="input-group input-group-sm">
                                       
                                     <?php 
                                     if($EmployeeID=='121031' || $EmployeeID=='131053' || $EmployeeID=='170976'  ||  $EmployeeID=='131027' )
                                     {
                                     ?>
                                     <button onclick="all_report();" data-toggle="modal" data-target="#for_report" class="btn btn-success btn-xs " >Report</button > &nbsp;
                                       <button onclick="export_detail();"  class="btn btn-success btn-xs " >Export Report</button >
                                     <?php }?>

                                     &nbsp;&nbsp;
                                       <input  type="button" class="btn btn-success btn-xs" value="Pending" onclick="pending();">&nbsp;&nbsp;
                                       <input  type="button" class="btn btn-success btn-xs" value="Verified" onclick="verified();">&nbsp;&nbsp;
                                    
                                       <input required type="text" id="RollNoSearch" class="form-control" placeholder="Ref.No and RollNo and ID Proof">
                                       <input  type="button" class="btn btn-success btn-xs" value="Search" onclick="by_search_studetn();">
                                       </div>
                              
                    
                  </div>
                  <div class="card-tools">
                     <div class="input-group input-group-sm">
                      
                     </div>
                  </div>
               </div>
               <script>


function pending() {
                    
                    var currentPage = 1;
                  var code = 179;
                  var searchQuery = '';
                    
                    var spinner=document.getElementById("ajax-loader");
    spinner.style.display='block';
                        $.ajax({
                           url: 'action_g.php',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                              page: currentPage,
                              code: code,
                             
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
function verified() {
                    
                    var currentPage = 1;
                  var code = 180;
                  var searchQuery = '';
                    
                    var spinner=document.getElementById("ajax-loader");
    spinner.style.display='block';
                        $.ajax({
                           url: 'action_g.php',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                              page: currentPage,
                              code: code,
                             
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

function by_search_studetn() {
                    
                     var currentPage = 1;
                   var code = 170;
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
                                
                                    // console.log(data);
                                    buildTable(data);
                                    updatePagination(currentPage);
                                 
                              },
                            error: function() {
                               // Handle error response
                            }
                         });
                   }



                  var currentPage = 1;
                  var code = 170;
                  var searchQuery = '';
                    var by_search="";


                     loadData(currentPage);

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
                               console.log(data);
                              spinner.style.display='none';
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
                          table += '<div id="pagination"><td colspan="1"> <button id="prev-btn" class="btn btn-primary " disabled><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></td><td></td><td colspan=""> <select class="form-control" id="type"><option value="1">letter head</option><option value="2">Without letter head</option></select> </td><td colspan="2"><button onclick="printletterhead1SelectedRows();" class="btn btn-success " >letter 1</button >&nbsp;<button onclick="printletterhead2SelectedRows();" class="btn btn-success " >letter 2</button >&nbsp;<button onclick="printletterhead3SelectedRows();" class="btn btn-success " >letter 3</button ></td><td colspan="1"><select class="form-control" id="yearwise"><option value="1">First</option><option value="2">Second</option><option value="3">Three</option><option value="4">Four</option></select></td><td colspan="1"><button onclick="printYearWiseLAtter();" class="btn btn-success " ><i class="fa fa-print"></i></button > </td><td><button id="next-btn" class="btn btn-primary "><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></td></div>';



                        // table += '<div id="pagination"><td colspan="1"> <button id="prev-btn" class="btn btn-primary " disabled><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></td><td colspan="">  </td><td colspan="1"></td><td colspan="2"></td><td colspan=""></td><td> </td><td><button id="next-btn" class="btn btn-primary "><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button></td></div>';
                        table += '</tr>';
                        table += '<tr><th width="10"><input type="checkbox" id="selectAllCheckbox" class="selectAllCheckbox" onchange="toggleSelectAll(this)" style="width:50px;"></th><th width="10">ID</th><th>Class RollNo</th><th>ID Proof</th><th>Name</th><th>Father Name</th><th>Course</th><th>Action</th></tr>';

                       var userid="<?php echo $EmployeeID; ?>";

                        for (var i = 0; i < data.length; i++) {
                           var unirollno = data[i][2];

                            var status = data[i][18];

                           var unirollno = data[i][2];
                           var generate=data[i][33];
                             if(data[i][31]==1){
                               table += '<tr style="background-color:#52BE80;">';

                           }
                           else{
                           table += '<tr>';
                           }
                           table += '<td>';
                           if(generate>0){

                            table +='<input type="checkbox" name="selectedRows[]" value="' + data[i][0] + '">';
                        }

                            table += '</td>';
 






                        
                           
                           table += '<td>' + data[i][0] + '</td>';
                           table += '<td>' + data[i][20] + '</td>';
                           table += '<td>' + data[i][6] + '</td>';
                           table += '<td>' + data[i][1] + '</td>';
                           table += '<td >'+ unirollno+'</td>';
                           table += '<td >'+ data[i][37]+'</td>';
                           // table += '<td >'+ data[i][30]+'</td>';


                           table += '<td>';
                           if(userid=='131027' ||userid=='131053' ||userid=='121031')
                           {
table +='<button onclick="edit_student('+ data[i][0] +');" data-toggle="modal" data-target="#for_edit" class="btn btn-success btn-xs " ><i class="fa fa-eye"></i></button >&nbsp;';
}

 if(userid!='131027' )
                           {

table += '<button onclick="edit_student_a('+ data[i][0] +');" data-toggle="modal" data-target="#for_edit_a" class="btn btn-success btn-xs " ><i class="fa fa-edit"></i></button >&nbsp;';}
                           
                           if(generate<=0)
                           {

table +='<button onclick="generate_student('+ data[i][0] +');"  class="btn btn-danger btn-xs " ><i class="fa fa-plus"> </i></button >';
                      }

 if(status>0)
                           {


table +='<button   class="btn btn-danger btn-xs " >LEFT</button >';
                      }



           table += '</td>';
                           table += '</tr>';
                        }
                        
                        table += '</table>';

                        $('#data-table').html(table);
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
            var type=document.getElementById('type').value;
   var id_array = document.getElementsByName('selectedRows[]');
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      if(type==1)
      {

         window.open('print_offer_letter_plan.php?id_array='+id_array_main);
      }
      else{
         
         window.open('print_offer_letter.php?id_array='+id_array_main);
      }

   } else {
      ErrorToast('All Input Required', 'bg-warning');
   }
}
function printletterhead2SelectedRows() {
   var type=document.getElementById('type').value;
var id_array = document.getElementsByName('selectedRows[]');
var len_id = id_array.length;
var id_array_main = [];
for (i = 0; i < len_id; i++) {
if (id_array[i].checked === true) {
id_array_main.push(id_array[i].value);
}
}
if (id_array_main.length > 0) {
   if(type==1)
      {

window.open('print_offer_letter_second_plan.php?id_array='+id_array_main);
      }
      else{
         window.open('print_offer_letter_second.php?id_array='+id_array_main);
      }
} else {
ErrorToast('All Input Required', 'bg-warning');
}
}
function printletterhead3SelectedRows() {
            var type=document.getElementById('type').value;
   var id_array = document.getElementsByName('selectedRows[]');
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      if(type==1)
      {
      window.open('print_offer_letter_third_plan.php?id_array='+id_array_main);
   }
   else{
      
      window.open('print_offer_letter_third.php?id_array='+id_array_main);
      }
   } else {
      ErrorToast('All Input Required', 'bg-warning');
   }
}
         function printYearWiseLAtter() {
   var id_array = document.getElementsByName('selectedRows[]');
   var years=document.getElementById('yearwise').value;
   var len_id = id_array.length;
   var id_array_main = [];
   for (i = 0; i < len_id; i++) {
      if (id_array[i].checked === true) {
         id_array_main.push(id_array[i].value);
      }
   }
   if (id_array_main.length > 0) {
      window.open('print_offer_letter_year_wise.php?id_array='+id_array_main+'&years='+years);
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

<div class="modal fade" id="for_edit_a" tabindex="-1" role="dialog" aria-labelledby="for_editLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="for_editLabel">Record Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit_show_a">
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
      </div>
    </div>
  </div>

</div>


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
         <button type="button" class="btn btn-success" onclick="export_detail();">Export Details</button>
        <button type="button" class="btn btn-success" onclick="export_all();">Export Count</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   function all_report() 
{  
   var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
var code='187';
$.ajax({
url:'action_g.php',
data:{code:code},
type:'POST',
success:function(data){
   spinner.style.display='none';
document.getElementById('all_record_report').innerHTML=data;
}
});
}
function edit_student_details_a(id) {
    var loanNumber = document.getElementById('loanNumber').value;
    var applicationNo = document.getElementById('applicationNo').value;
    var statusVerification = document.getElementById('statusVerification').value;



 var UTRNumber = document.getElementById('UTRNumber').value;
 var loan_amount = document.getElementById('loan_amount').value;
 var datePayment = document.getElementById('datePayment').value;





    var dateVerification = document.getElementById('dateVerification').value;
    // alert(loanNumber+"="+applicationNo+"="+statusVerification+"="+dateVerification);
if(loanNumber!='' && applicationNo!='' && statusVerification!='' && dateVerification!='')
{
  var code = 172;
  var data = {
    id: id,
    loanNumber: loanNumber,
    applicationNo: applicationNo,
    statusVerification: statusVerification,
    dateVerification: dateVerification,UTRNumber:UTRNumber,loan_amount:loan_amount,datePayment:datePayment,
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
      SuccessToast('Verification successfully');
      // date_by_search();
      loadData(currentPage);
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
//   var District = document.getElementById('District1').value;
  // var Lateral = document.querySelector('input[name="Lateral"]:checked').value;
  var Consultant = document.getElementById('Consultant_').value;
   var duration = document.getElementById('Duration').value;
  // var session = document.getElementById('session').value;
  // var AdharCardNo = document.getElementById('AdharCardNo').value;
   var leet = document.getElementById('leet').value;
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
  leet:leet,
    months:months,
    classroll: classroll,
    District1: District,status:Status1,
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
      // console.error(xhr.responseText);
      // alert('An error occurred while submitting data. Please try again.');
    }
  });
}
else
{
   ErrorToast('All Input Required','bg-warning');
}
}












// function all_report() 
// {  
//    var spinner=document.getElementById("ajax-loader");
//      spinner.style.display='block';
// var code='326';
// $.ajax({
// url:'action.php',
// data:{code:code},
// type:'POST',
// success:function(data){
//    spinner.style.display='none';
// document.getElementById('all_record_report').innerHTML=data;
// }
// });
// }
function edit_student(id) 
{  
    var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
var code='171';
$.ajax({
url:'action_g.php',
data:{id:id,code:code},
type:'POST',
success:function(data){
    spinner.style.display='none';
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
   //   console.log(data);
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



function export_one(Consultant) 
      {
         // alert(Consultant);
         var exportCode='25';
          window.location.href="export.php?exportCode="+exportCode+"&Consultant="+Consultant;
      }


function export_detail() 
      {
         var exportCode='23';

      window.location.href="export.php?exportCode="+exportCode+"&District="+0;
      
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
function edit_student_a(id) 
{  
var code='139';
$.ajax({
url:'action_g.php',
data:{id:id,code:code},
type:'POST',
success:function(data){
document.getElementById('edit_show_a').innerHTML=data;
}
});

}
</script>
<?php
include "footer.php";
?>
