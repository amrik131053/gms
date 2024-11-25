<?php 
  include "header.php";   
  $todaydate=date('Y-m-d');
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         
            <div class="col-lg-3 col-md-3 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Student</h3>
                     <div class="card-tools">
                     <div class="btn-group input-group-sm">
                                 <input type="text"  style="width:150px "  name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Employee ID" aria-describedby="button-addon2" value="">
                              <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="search_by_roll_no();" name="search"><i class="fa fa-search"></i></button>
                           </div>
                   </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0"  id="student_search_record">
                     
                  </div>
                 
               </div>
              
            </div>
            <div class="col-md-9 col-lg-9 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Entries  </h3>
                  
               </div>
             
                  <div class="card-body" id="allDeatils"  >


                  </div>




                  <div class="card-footer">           
                  </div>
                  <!-- /.card-footer -->
              
            </div>

            <!-- /.card -->
         </div>
       
      
        
      </div>
      
   </div>
 
</section>
<p id="ajax-loader"></p>

<script type="text/javascript">


  function search_by_roll_no_by_id(rollNo)
   {
          
      var code=257.2;
      var code_access = '<?php echo $code_access; ?>';
      if (rollNo!='') 
      {
         var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,rollNo:rollNo,code_access:code_access
            },
            success:function(response) 
            {
               spinner.style.display='none';
               document.getElementById("allDeatils").innerHTML =response;
            }
         });
      }
      else
      {
         document.getElementById("allDeatils").innerHTML ='';
      }
   } 


   function search_by_roll_no()
   {
      var code=257.1;
      var code_access = '<?php echo $code_access; ?>';
      var rollNo= document.getElementById("student_roll_no").value;
      if (rollNo!='') 
      {
         var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,rollNo:rollNo,code_access:code_access
            },
            success:function(response) 
            {
               spinner.style.display='none';
               document.getElementById("student_search_record").innerHTML =response;
               search_by_roll_no_by_id(rollNo);
            }
         });
      }
      else
      {
         document.getElementById("student_search_record").innerHTML ='';
      }
   } 



 
    function applyMigration(id)
          {
       var code=468.1;
       var examination= document.getElementById("examination").value;
       var result= document.getElementById("result").value;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id,result:result,examination:examination
                  },
                 success: function(response) 
            { 
                console.log(response);

               spinner.style.display='none';
               search_by_roll_no() ;
            }
         });
     }
  
</script>




<?php include "footer.php";  ?>