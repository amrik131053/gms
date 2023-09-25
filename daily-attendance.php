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
                    <a class="btn"  id="btn6" style="background-color:#223260; color: white; border: 1px solid;" onclick="Daily();bg(this.id);"> Daily Attendance </a>
                   <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="Add();bg(this.id);"> Monthly Attendance </a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="Search();bg(this.id);"> Search </a>
                   <!-- <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="Move();bg(this.id);"> Move </a>
                    <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="Copy();bg(this.id);"> Copy </a> -->
                    <!-- <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="Update();bg(this.id);"> Update </a> -->
                  </div>

           <div class="row" id="card">
           </div>
<br><br>

         <div  id="table_load" class="table-responsive">

              
        
        

         
        </div>
   </div>
   <!-- /.container-fluid -->

</section>
<p id="ajax-loader"></p>
   <script type="text/javascript">
          $(window).on('load', function() 
          {
         $('#btn6').toggleClass("bg-success"); 
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

 function Daily(){ 

//230
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
            }
         });
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