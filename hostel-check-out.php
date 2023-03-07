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
                     <h3 class="card-title">Student Profile</h3>
                     <div class="card-tools">
                     <div class="btn-group input-group-sm">
                                 <input type="text" name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Uni/Class Roll No." aria-describedby="button-addon2" value="">
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
                  <h3 class="card-title">Student</h3>
               </div>
               <form class="form-horizontal" action="" method="POST">
                  <div class="card-body">
                     <div class="row" id="studentStock">
                        
                     </div>
                  </div>
                  <!-- <div class="card-footer">
                     <button type="submit" class="btn btn-info" onclick="studentVerify();">Check In</button>
                     <p id="Student_success"></p>
                  </div> -->
                  <!-- /.card-footer -->
               </form>
            </div>

            <!-- /.card -->
         </div>
       
      
        
      </div>
      
   </div>

 
</section>
<div class="modal fade" id="view_assign_stock_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Stock Assigned Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="">
            <div class="modal-body" id="view_assign">
               ...
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <!--  <button type="submit" class="btn btn-primary">Save</button> -->
            </div>
         </form>
      </div>
   </div>
</div>

<script type="text/javascript">
   function student_search()
   {
      var code=69;
      var rollNo= document.getElementById("student_roll_no").value;
      if (rollNo!='') 
      {
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
               document.getElementById("student_search_record").innerHTML =response;
               code=75;
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
               document.getElementById("studentStock").innerHTML =response;  
            }
         });

            }
         });
      }
      else
      {
         alert("Please Enter the Roll No.");
         document.getElementById("student_IDNO").value ='';
         document.getElementById("student_search_record").innerHTML ='';
      }
   }
    function check_out(ID,studentID)
   {
      // var code=89;
      // alert(code);
      // alert(studentID);
      var code=76;
      var a=confirm("Are you sure to check out" + " " + ID);
      if (a==true) 
      {
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,id:ID,studentID:studentID
            },
            success:function(response) 
            {
               student_search()
               //alert("success");
               // location.reload(true);
            }
         });
      }
   }
  
</script>

<?php include "footer.php";  ?>