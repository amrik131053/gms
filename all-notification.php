<?php 
   include "header.php";   
   ?>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card">
            <div class="card-header ">
               <h3 class="card-title">All Notifications  </h3>   
             
                  </div>
                  
            </div>
               <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active"  data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" onclick="read_notification();"><b>Read</b></a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false" onclick="unread_notification();"><b>UnRead</b></a>
                     </li>
                  </ul>
        
            <div class="card-body table-responsive">
               <div class="form-group row" id="show_notification">
                   
                   
               </div>
            </div>
        </div>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
       
      </div>
    
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->
<script>
  
 $(window).on('load', function() 
          {
           
   read_notification();
           })

   
      function read_notification()
   {
       var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
      var code=29;
      $.ajax(
      {
         url:"action_g.php ",
         type:"POST",
         data:
         {
            code:code
         },
         success:function(response) 
         {
   spinner.style.display='none';
            
            document.getElementById("show_notification").innerHTML =response;
          
         },
         error:function()
         {
            alert("error");
         }
      });
   }   
      function unread_notification()
   {
       var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
      var code=30;
      $.ajax(
      {
         url:"action_g.php ",
         type:"POST",
         data:
         {
            code:code
         },
         success:function(response) 
         {
   spinner.style.display='none';
            
            document.getElementById("show_notification").innerHTML =response;
          
         },
         error:function()
         {
            alert("error");
         }
      });
   }

   function mark_read(id)
    {
       var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
            var code=31;
      $.ajax(
      {
         url:"action_g.php ",
         type:"POST",
         data:
         {
            code:code,id:id
         },
         success:function(response) 
         {
           spinner.style.display='none';
            if (response==1) {
                  SuccessToast('Successfully Read');
               read_notification();
            }
            else
            {
               unread_notification();

            }
          
         },
         error:function()
         {
            alert("error");
         }
      });
   }  
    function mark_unread(id)
    {
       var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
            var code=32;
      $.ajax(
      {
         url:"action_g.php ",
         type:"POST",
         data:
         {
            code:code,id:id
         },
         success:function(response) 
         {
           spinner.style.display='none';
            if (response==1) {
                  SuccessToast('Successfully UnRead');
               unread_notification();
            }
            else
            {
               read_notification();

            }
          
         },
         error:function()
         {
            alert("error");
         }
      });
   }
 
</script>

<?php


 include "footer.php";  ?>