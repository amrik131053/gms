<?php 
  include "header.php";   
?>   

  
<section class="content">
   <div class="container-fluid">
   <div class="card card-info">
   </div>
   <div class="row">
       
      <div class="col-lg-12 col-md-4 col-sm-12">
         <div class="card-body card">
        <div class="btn-group w-100 mb-2">
           <a class="btn" id="btn1" style="background-color:#223260; color: white; border: 10px solid;" onclick="Search();bg(this.id);"> Search </a>
                    <a class="btn"  id="btn2" style="background-color:#223260; color: white; border: 10px solid;" onclick="Daily();bg(this.id);"> Daily Attendance </a>
                 <a class="btn" id="btn3"style="background-color:#223260; color: white; border: 10px solid;" onclick="Monthly();bg(this.id);"> Monthly Attendance </a> 
                   <a class="btn"  id="btn3" style="background-color:#223260; color: white; border: 10px solid;" onclick="holiday();bg(this.id);"> Holiday </a> 
                  <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="concession();bg(this.id);">Concession</a> 
                   
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