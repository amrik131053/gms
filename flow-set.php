<?php 
   include "header.php";   
   ?>
<script type="text/javascript">
   function search_flow() {
      var code=75;
         var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
      var emp_id=document.getElementById('emp_id').value;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:emp_id
         },
          success: function(response) 
           {
                spinner.style.display='none';
              document.getElementById("data_show").innerHTML=response;
              reorder();
              user_details();
              search_flow_inventry();
              reorder_inventry();
           }
   
      });
   } 
   function add_flow(id) {
      var code=82;
         
      var flow_value=document.getElementById('flow_value').value;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:id,flow_value:flow_value
         },
          success: function(response) 
           {
                // spinner.style.display='none';
                reorder();
           }
   
      });
   } 
     function add_flow_in(id) {
      var code=87;
         
      var flow_value=document.getElementById('flow_value_in').value;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:id,flow_value:flow_value
         },
          success: function(response) 
           {
               // console.log(response); 
                reorder_inventry();
   
              
           }
   
      });
   }   
   
    function reorder() {
      var code=80;
         var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
      var emp_id=document.getElementById('empID').value;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:emp_id
         },
          success: function(response) 
           {
                spinner.style.display='none';
              document.getElementById("reorder").innerHTML=response;
           }
   
      });
   }   
    function user_details() {
      var code=83;
         
        var emp_id=document.getElementById('emp_id').value;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:emp_id
         },
          success: function(response) 
           {
                
              document.getElementById("User_details").innerHTML=response;
           }
   
      });
   }
     function search_flow_inventry() {
      var code=84;
   
      var emp_id=document.getElementById('emp_id').value;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:emp_id
         },
          success: function(response) 
           {
              
              document.getElementById("data_show_inventry").innerHTML=response;
              
              
           }
   
      });
   } 
      function reorder_inventry() {
      var code=85;
   
      var emp_id=document.getElementById('empID').value;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:emp_id
         },
          success: function(response) 
           {
              
              document.getElementById("reorder_in").innerHTML=response;
           }
   
      });
   }
   function delete_flow_transport(id)
    {
   var code=88;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:id
         },
          success: function(response) 
           {
            if (response==1)
            {
              reorder();
              reorder_inventry();
           }
        }
   
      });
   } 
   
    function delete_flow_inventry(id)
    {
   var code=89;
      $.ajax({
         url:'action_g.php',
         type:'POST',
         data:{
            code:code,emp_id:id
         },
          success: function(response) 
           {
            if (response==1)
            {
              reorder();
              reorder_inventry();
           }
        }
   
      });
   }
</script>
<section class="content ">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-4 col-md-4 col-sm-3">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Flow </h3>
            </div>
            <div class="card-body">
               <div class="input-group input-group-sm"> 
                  <input type="text" class="form-control" id="emp_id">
                  <button class="btn btn-primary btn-xs" onclick="search_flow();">Search</button>
               </div>
               <div id="User_details" class="text-center"></div>
            </div>
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Transport</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive" >
               <div id="data_show">
               </div>
               <br>
               <div class="row">
                  <div  class="col-lg-12">
                     <div class="gallery">
                        <ul class="reorder-gallery " id="reorder">
                        </ul>
                     </div>
                  </div>
               </div>
               <div></div>
            </div>
            <!-- /.card -->
         </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Inventry</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive" >
               <div id="data_show_inventry">
               </div>
               <br>
               <div class="row">
                  <div  class="col-lg-12">
                     <div class="gallery_in">
                        <ul class="reorder-gallery_in " id="reorder_in">
                        </ul>
                     </div>
                  </div>
               </div>
               <div></div>
            </div>
         </div>
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>
<style type="text/css">
<style>
   .reorder-gallery { list-style: none !important; }
   .reorder-gallery li { margin-bottom:10px; padding:5px; background-color:#3BB9FF;cursor:move;list-style: none !important;}
   .reorder-gallery li.ui-state-highlight { height: 1.0em; background-color:#F0F0F0;border:#ccc 2px dotted;}
   .reorder-gallery_in { list-style: none; }
   .reorder-gallery_in li { margin-bottom:10px; padding:5px; background-color:#3BB9FF;cursor:move;list-style: none !important;}
   .reorder-gallery_in li.ui-state-highlight { height: 1.0em; background-color:#F0F0F0;border:#ccc 2px dotted;}
</style>
</style>
<script type="text/javascript">
   $(document).ready(function(){   
       $("ul.reorder-gallery").sortable({      
           update: function( event, ui ) {
               updateOrder();
           }
       });  
   });
   function updateOrder() {    
       var item_order = new Array();
       $('ul.reorder-gallery li').each(function() {
           item_order.push($(this).attr("id"));
       });
       var code=81;
      var emp_id=document.getElementById('emp_id').value;
       // var order_string = 'order='+item_order;
       $.ajax({
           type: "POST",
           url: "action_g.php",
           data:{emp_id:emp_id,item_order:item_order,code:code},
           cache: false,
           success: function(data){  
            // console.log(data);
            if (data==1) {
               SuccessToast('Success');
            }
           }
       });
   }
   
   $(document).ready(function(){   
       $("ul.reorder-gallery_in").sortable({      
           update: function( event, ui ) {
               updateOrder_in();
           }
       });  
   });
   function updateOrder_in() {    
       var item_order = new Array();
       $('ul.reorder-gallery_in li').each(function() {
           item_order.push($(this).attr("id"));
       });
       var code=86;
      var emp_id=document.getElementById('emp_id').value;
       // var order_string = 'order='+item_order;
       $.ajax({
           type: "POST",
           url: "action_g.php",
           data:{emp_id:emp_id,item_order:item_order,code:code},
           cache: false,
           success: function(data){  
            // console.log(data);
            if (data==1) {
               SuccessToast('Success');
            }
           }
       });
   }
   
   
   
</script>
<?php
   include "footer.php";  ?>