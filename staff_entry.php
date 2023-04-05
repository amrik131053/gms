<?php 
  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         
            <div class="col-lg-5 col-md-5 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                     <h3 class="card-title">Staff Profile</h3>
                     <div class="card-tools">
                     <div class="btn-group input-group-sm">
                                 <input type="text" name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Employee ID" aria-describedby="button-addon2" value="">
                              <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="student_search();" name="search"><i class="fa fa-search"></i></button>
                           </div>
                     
                  </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0"  id="student_search_record">
                     
                  </div>

                 
               </div>
              
            </div>
            <div class="col-md-7 col-lg-7 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">  </h3>
                  
               </div>
             
                  <div class="card-body" id="checked_out_students"  >
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
   window.onload = function() {
  //checked_out_student();
};
   function checked_out_student() 
   {
      
      var code=144;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code
         },
         success:function(response) 
         {
            // student_search();
            document.getElementById("checked_out_students").innerHTML =response;
         }
      });
   }
   function gateEntryCheckIn(studentId,direction,gateEntryId)
   {
       // alert(direction);
      var code=142;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,studentId:studentId,direction:direction,gateEntryId:gateEntryId
         },
         success:function(response) 
         {
            checked_out_student();
            student_search();
            // console.log(response);
            // document.getElementById("student_search_record").innerHTML =response;
         }
      });
   }
   function gateEntryCheckOut(studentId,direction)
   {
      // alert(studentId);
      var code=143;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,studentId:studentId,direction:direction
         },
         success:function(response) 
         {
            checked_out_student();
            student_search();
            // document.getElementById("student_search_record").innerHTML =response;
         }
      });
   }
  
   function student_search()
   {
      var code=257;
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
               code:code,rollNo:rollNo
            },
            success:function(response) 
            {
               spinner.style.display='none';
               document.getElementById("student_search_record").innerHTML =response;
            }
         });
      }
      else
      {
         // alert("Please Enter the Roll No.");
         document.getElementById("student_search_record").innerHTML ='';
      }
   } 
   function studentDetail(IDNo)
   {
      var code=141;
      document.getElementById("student_roll_no").value=IDNo;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,rollNo:IDNo
         },
         success:function(response) 
         {
            document.getElementById("student_search_record").innerHTML =response;
         }
      });
      
   }
    
</script>

<?php include "footer.php";  ?>