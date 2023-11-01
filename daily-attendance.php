<?php 
  include "header.php";   
?>   

<section class="content">
   <div class="container-fluid">

   <div class="row">
   <div class="card">
              
              
              

               
                
              </div>
              <!-- /.card-body -->
            </div>
      <div class="col-lg-12 col-md-4 col-sm-12">
         <div class="card-body card">
            <div class="card-body table-responsive pad">
        <div class="btn-group w-100 mb-12">
                     <a class="btn" id="btn1" style="background-color:#223260; color: white; border: 10px solid;" onclick="Search();bg(this.id);"> Search </a>
                    <a class="btn"  id="btn2" style="background-color:#223260; color: white; border: 10px solid;" onclick="Daily();bg(this.id);"> Daily Attendance </a>
                   <a class="btn" id="btn3"style="background-color:#223260; color: white; border: 10px solid;" onclick="Monthly();bg(this.id);"> Monthly Attendance </a> 
            
               <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 10px solid;" onclick="holiday();bg(this.id);"> Holiday </a> 
               <a class="btn" id="btn5" style="background-color:#223260; color: white; border: 10px solid;" onclick="Concession();bg(this.id);">Concession</a> 
               <a class="btn" id="btn6" style="background-color:#223260; color: white; border: 10px solid;" onclick="ApplyLeave();bg(this.id);">Apply Leave</a> 
             
</div>
</div>
<div class="card-body card" id="card">
           </div>
         
         <div  id="table_load" class="card-body card table-responsive">
         
        </div>

   </div>
   <!-- /.container-fluid -->

</section>
<p id="ajax-loader"></p>
   <script type="text/javascript">
          $(window).on('load', function() 
          {
         $('#btn1').toggleClass("bg-success"); 
           })
          function format() 
           {
            window.location.href = 'http://gurukashiuniversity.co.in/gkuadmin/formats/studyscheme.csv';
           }
         function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }
         Search();
 function Search(){ 
   var code=210;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("card").innerHTML=response;
            }
         });
}
 function Daily(){ 
   var code=306;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("card").innerHTML=response;
               document.getElementById("table_load").innerHTML="";
            }
         });
}

 function Monthly(){ 

   var code=336;
         var spinner=document.getElementById('ajax-loader');
        
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("card").innerHTML=response;
               document.getElementById("table_load").innerHTML="";
            }
         });
}
 function Concession(){ 

   var code=337;
         var spinner=document.getElementById('ajax-loader');
        
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("card").innerHTML=response;
               document.getElementById("table_load").innerHTML="";
            }
         });
}

function ApplyLeave()
{ 

   var code=338;
         var spinner=document.getElementById('ajax-loader');
        
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("card").innerHTML=response;
               document.getElementById("table_load").innerHTML="";
            }
         });
}


function fetch_leave_Balance(id){
 
   var code=340;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,id:id
               },
            success: function(response) 
            { 
               console.log(response);
               spinner.style.display='none';
              $("#LeaveType").html("");
$("#LeaveType").html(response);
               
            }
         });



}

function cocessionSubmit(form) {



    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            if (response == 1) {
                SuccessToast('Leave submit successfully');
                               
                
            }
            else if (response == 2)
             {
              ErrorToast('one leave already pending to Sanction authority.','bg-warning');
            }
            else if (response == 3)
             {
              ErrorToast("you can't apply back date leave.",'bg-warning');
            }
             else
              {
                ErrorToast('Please try after sometime.','bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
        
    });
}

 function empdatashow(id){ 
   var code=186;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("employee_name_show").innerHTML=response;
               
            }
         });
}


 function holiday(){ 
   var code=212;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("card").innerHTML=response;
               document.getElementById("table_load").innerHTML="";
            }
         });
}
 function addHolidayMark(){ 
   var code=213;
   var holidayDate=document.getElementById('holidayDate').value;
  var holidayName=document.getElementById('holidayName').value;
  var holidayDiscription=document.getElementById('holidayDiscription').value;
  if(holidayDate!='' && holidayName!='' )
  {
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,holidayDate:holidayDate,holidayName:holidayName,holidayDiscription:holidayDiscription
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               if(response==1)
               {
                  SuccessToast('Add Successfully');
                  holiday();
               }
            }
         });
      }
      else
      {
         ErrorToast('All inputs Required','bg-warning');
      }
}
 function deleteHoliday(id){ 
   var code=215;
   var a=confirm('Are you sure you want to delete  ');
   if (a==true) {
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id
               },
            success: function(response) 
            { 
               spinner.style.display='none';
               if(response==1)
               {
                  SuccessToast('Delete Successfully');
                  holiday();
               }
            }
         });
      }
      else
      {

      }
}

function dateHideShow() 
{
  $("#SingleDate").hide();
  $("#StartDate").show();
  $("#EndDate").show();                            
  $("#DivLeaveShift").hide(); 
  document.getElementById("leaveDate").value="";                                             
}
function singleHideShow() 
{
 $("#SingleDate").show();
 $("#StartDate").hide();
 $("#EndDate").hide();    
 document.getElementById("leaveStartDate").value="";                
 document.getElementById("leaveEndDate").value="";                
 $("#DivLeaveShift").show();                    
}


function editRow(button) {
        const row = button.closest('tr');
        const editableFields = row.querySelectorAll('.editable');
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
        editableFields.forEach(field => {
            field.contentEditable = true;
            field.classList.add('editing');
        });
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-block';
        cancelBtn.style.display = 'inline-block';
    }

    function saveRow(button,id) {
        var code=214;
        const row = button.closest('tr');
        const employeeId = id;
        const holidayDate = row.querySelector('[data-field="HolidayDate"]').textContent;
        const holidayName = row.querySelector('[data-field="HolidayName"]').textContent;
        const description = row.querySelector('[data-field="Description"]').textContent;
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
      //   alert(HolidayName);
        row.querySelectorAll('.editable').forEach(field => {
            field.contentEditable = false;
            field.classList.remove('editing');
        });
        editBtn.style.display = 'inline-block';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
        $.ajax({
            type: 'POST',
            url: 'action_g.php', 
            data: {
                code:code,id:employeeId,holidayDate:holidayDate,holidayName:holidayName,description:description
            },
            success: function(response) {
               console.log(response);
            SuccessToast('SuccessFully');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    function cancelEdit(button) {
        const row = button.closest('tr');
        const editableFields = row.querySelectorAll('.editable');
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        const cancelBtn = row.querySelector('.cancel-btn');
        editableFields.forEach(field => {
            field.contentEditable = false;
            field.classList.remove('editing');
        });
        editBtn.style.display = 'inline-block';
        saveBtn.style.display = 'none';
        cancelBtn.style.display = 'none';
    }

 function export_daily_attendance() 
      {
         var exportCode=26;

  var College=document.getElementById('College').value;
  var Department=document.getElementById('Department').value;
  var start_date=document.getElementById('start_date').value;
  var end_date=document.getElementById('end_date').value;

  if(start_date!='' && end_date!='')
   {
   window.location.href="export.php?exportCode="+exportCode+"&College="+College+"&Department="+Department+"&start_date="+start_date+"&end_date="+end_date;
    }
      else
      {
        ErrorToast('Select Start and End Date','bg-danger');
 
      }
}


 function export_count_attendance()


   {
         var exportCode=29;

  var College=document.getElementById('College').value;
  var Department=document.getElementById('Department').value;



  var month=document.getElementById('month').value;
  var year=document.getElementById('year').value;

  if(month!='' && year!='')
   {
   window.location.href="export.php?exportCode="+exportCode+"&College="+College+"&Department="+Department+"&month="+month+"&year="+year;
    }
      else
      {
        ErrorToast('Select Start and End Date','bg-danger');
 
      }
}

 function pdf_count_attendance()
   {  
var exportCode="";
  var College=document.getElementById('College').value;
  var Department=document.getElementById('Department').value;
  var month=document.getElementById('month').value;
  var year=document.getElementById('year').value;

  if(month!='' && year!='')
   {
   window.location.href="attendance-detailed-pdf.php?exportCode="+exportCode+"&College="+College+"&Department="+Department+"&month="+month+"&year="+year;
    }
      else
      {
        ErrorToast('Select Start and End Date','bg-danger');
 
      }
}



 function export_count_summary()


   {
      var exportCode=30;

  var College=document.getElementById('College').value;
  var Department=document.getElementById('Department').value;



  var month=document.getElementById('month').value;
  var year=document.getElementById('year').value;

  if(month!='' && year!='')
   {
   window.location.href="export.php?exportCode="+exportCode+"&College="+College+"&Department="+Department+"&month="+month+"&year="+year;
    }
      else
      {
        ErrorToast('Select Start and End Date','bg-danger');
 
      }
}




function search_daily_attendance()
{
  

  var College=document.getElementById('College').value;
  var Department=document.getElementById('Department').value;

   var start_date=document.getElementById('start_date').value;

   var end_date=document.getElementById('end_date').value;

   //var attendance=document.getElementById('Attendance').value;
var code=307;
if(start_date!='' && end_date!='')
{
var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
               start_date:start_date,
               end_date:end_date,
               College:College,
               Department:Department
         },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;

               //console.log(response);
               if (response==1) {
                
                  //SuccessToast('Successfully Submit');

               }
               else
               {
                  
               }
            }
         });
      }
      else
      {
         ErrorToast('Select Start and End Date','bg-danger');
      }
      }


      function showEmpReport()
                               {
                                  var employeeId=document.getElementById("employeeId_").value;
                                  var month=document.getElementById("month").value;
                                  var year=document.getElementById("year").value;
                                  
                                  var spinner=document.getElementById("ajax-loader");
                             spinner.style.display='block';
                                
                              var code=335;
                                 $.ajax(
                                 {
                                    url: 'action.php',
                                    type: 'post',
                                    data:{code:code,month:month,year:year,EmployeeId:employeeId},
                                    success:function(response)
                                    {
                                       spinner.style.display='none';
                                       document.getElementById("table_load").innerHTML=response;
                                    }
                                 });
                           }







                           function leaveSubmit(form) {

    var leaveType = form.LeaveType.value;
    var Empid = form.EmpID.value;
    var leaveShort = form.leaveShort.value;
    var leaveReason = form.leaveReason.value;
    // var leaveFile = form.leaveFile.value;
    var leaveShift = form.leaveShift.value;
    var leaveHalfShortRadio = form.leaveHalfShortRadio.value;

   if (Empid === "") {
       
        ErrorToast('Please Enter Employee ID.','bg-warning');
        return;
    }
    if (leaveType === "") {
       
        ErrorToast('Please select a Leave Type.','bg-warning');
        return;
    }
    if(leaveHalfShortRadio!='Full')
    {
    if (leaveShort === "") {
      
        ErrorToast('Please select a Leave Duration.','bg-warning');
        return;
    }
    if (leaveShift === "") {
        
        ErrorToast('Please select a Leave Shift F/S.','bg-warning');
        return;
    }
   }
    if (leaveReason.trim() === "") {
       
        ErrorToast('Please enter a Leave Reason.','bg-warning');
        return;
    }

    // if (leaveFile === "") {
       
    //     ErrorToast('Please upload an Adjustment File.','bg-warning');
    //     return;
    // }
   
    var submitButton = form.querySelector('input[name="leaveButtonSubmit"]');
    submitButton.disabled = true;
    submitButton.value = "Submitting...";

    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            if (response == 1) {
                SuccessToast('Leave submit successfully');
                
                document.getElementById("LeaveType").value="";
                document.getElementById("leaveShort").value="";
                document.getElementById("leaveReason").innerHTML="";
                
            }
            else if (response == 2)
             {
              ErrorToast('one leave already pending to Sanction authority.','bg-warning');
            }
            else if (response == 3)
             {
              ErrorToast("you can't apply back date leave.",'bg-warning');
            }
             else
              {
                ErrorToast('Please try after sometime.','bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        },
        complete: function() {
            submitButton.disabled = false;
            submitButton.value = "Submit";
        }
    });
}




</script>
      
       

  </br>
<div>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>


    <?php 


    include "footer.php";  ?>