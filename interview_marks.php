<?php 
   include "header.php";  
   include "connection/connection.php"; 
      include "connection/connection_web.php";
      date_default_timezone_set("Asia/Kolkata");
      $date=date('Y-m-d'); 
   ?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <!-- Button trigger modal -->
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-info">
               <div class="card-header ">
                  <h3 class="card-title">Interview Candidates</h3>
               </div>
              
                  <div class="card-body">
                     
<div id="candidate_data_show"></div>
                 
              
     
        
  </div>
         <div class="card-footer">
<center>
             <!-- <input type="button" class="btn btn-primary" name="create" value="Final Submit" onclick="id_card_data_submit();"  > -->
           </center>
         </div>
        
         <!-- /.card-footer -->
      
   </div>
   
   <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
   </div>
</section>
<p id="ajax-loader"></p>

<!-- Modal -->
<?php
   include "footer.php"; 
   
    ?>
    <script type="text/javascript">
      $(window).on('load', function() 
          {
           loaddata();
    
           })


 function correctmarks(id)
{

var code=3;
 var research=parseFloat(document.getElementById(id+'_research').value);
 var ts=parseFloat(document.getElementById(id+'_ts').value);
 var sc=parseFloat(document.getElementById(id+'_sc').value);
 var comm=parseFloat(document.getElementById(id+'_comm').value);
var spinner=document.getElementById("ajax-loader");
if(research<=10 && research>=0 && ts<=15 && ts>=0 && sc<=15 && sc>=0 &&comm<=10 && comm>=0 )
{
     spinner.style.display='block';
  $.ajax({
        url: "web_action.php",
        type: "POST",
        data: {code:code,research:research,ts:ts,sc:sc,comm:comm,id:id},
        success: function(data) {
      

         spinner.style.display='none';
          loaddata();
          
        }
      });
     }
     else{
      alert("Marks are more than max marks")

     }  
       
} 

function lock(id)
{

var code=4;

 var research=parseFloat(document.getElementById(id+'_research').value);
 var ts=parseFloat(document.getElementById(id+'_ts').value);
 var sc=parseFloat(document.getElementById(id+'_sc').value);
 var comm=parseFloat(document.getElementById(id+'_comm').value);
var spinner=document.getElementById("ajax-loader");
if(research<=10 && research>=0 && ts<=15 && ts>=0 && sc<=15 && sc>=0 &&comm<=10 && comm>=0 )
{
 
     spinner.style.display='block';
  $.ajax({
        url: "web_action.php",
        type: "POST",
        data: {code:code,research:research,ts:ts,sc:sc,comm:comm,id:id},
        success: function(data) {
      

         spinner.style.display='none';
          loaddata();
          
        }
      });
    }
     else{
      alert("Marks are more than max marks")

     }



}




 function UpdateMarks(id)
{

var code=1;
 var panel_id=document.getElementById('panel_id').value;
 var research=parseFloat(document.getElementById(id+'_research').value);
 var ts=parseFloat(document.getElementById(id+'_ts').value);
 var sc=parseFloat(document.getElementById(id+'_sc').value);
 var comm=parseFloat(document.getElementById(id+'_comm').value);
var spinner=document.getElementById("ajax-loader");
if(research<=10 && research>=0 && ts<=15 && ts>=0 && sc<=15 && sc>=0 &&comm<=10 && comm>=0 )
{
 
     spinner.style.display='block';
  $.ajax({
        url: "web_action.php",
        type: "POST",
        data: {code:code,research:research,ts:ts,sc:sc,comm:comm,id:id,panel_id:panel_id},
        success: function(data) {
      

         spinner.style.display='none';
          loaddata();
          
        }
      });
    }
     else{
      alert("Marks are more than max marks")

     }     
      
}

function Absent(id)
{
      var r = confirm("realy want to mark abset");  
    if (r == true) {  
var code=5;
var panel_id=document.getElementById('panel_id').value;
 var research=parseFloat(document.getElementById(id+'_research').value);
 var ts=parseFloat(document.getElementById(id+'_ts').value);
 var sc=parseFloat(document.getElementById(id+'_sc').value);
 var comm=parseFloat(document.getElementById(id+'_comm').value);
var spinner=document.getElementById("ajax-loader");
if(research<=10 && research>=0 && ts<=15 && ts>=0 && sc<=15 && sc>=0 &&comm<=10 && comm>=0 )
{
 
     spinner.style.display='block';
  $.ajax({
        url: "web_action.php",
        type: "POST",
        data: {code:code,research:research,ts:ts,sc:sc,comm:comm,id:id,panel_id:panel_id},
        success: function(data) {
      

         spinner.style.display='none';
          loaddata();
          
        }
      });
    }
     else{
      alert("Marks are more than max marks")

     }     
      
   

}
}

function   loaddata()
{
   var code=2;
   var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
  $.ajax({
        url: "web_action.php",
        type: "POST",
        data: {code:code},
        success: function(data) {
      

         spinner.style.display='none';
          $("#candidate_data_show").html(data);
        }
      });
       

}
 </script>