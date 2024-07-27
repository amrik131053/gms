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
                     <h3 class="card-title">Staff Profile</h3>
                     <div class="card-tools">
                     <div class="btn-group input-group-sm">
                                 <input type="text"  style="width:150px "  name="student_roll_no" class="form-control" id='student_roll_no' placeholder="Employee ID" aria-describedby="button-addon2" value="">
                              <button class="btn btn-info btn-sm" type="button" id="button-addon2" onclick="staff_search();" name="search"><i class="fa fa-search"></i></button>
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
                  <h3 class="card-title">Staff Entries  </h3>
                  
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


  function staff_search_by_id(rollNo)
   {
          
      var code=257;
      
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
         document.getElementById("student_search_record").innerHTML ='';
      }
   } 


   function staff_search()
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
         document.getElementById("student_search_record").innerHTML ='';
      }
   } 



 $(window).on('load', function() 
          {
          time_out_staff();
          
           })

 

   function time_out_staff() 
   {
       var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
      var code=299;
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
             spinner.style.display='none';
          
            document.getElementById("checked_out_students").innerHTML =response;
         }
      });
   }


 
    function checkin(id)
          {
       var code=288;

       
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,id:id
                  },
                 success: function(response) 
            { // console.log(response);

               spinner.style.display='none';
              time_out_staff() ;
            }
         });

     }

function view_movment_status(id)
{
var code=382;

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
                //console.log(response);
                 // pending();


               spinner.style.display='none';
               document.getElementById("edit_stu").innerHTML=response;
            }
         });

}


 

   function checkout(id)
   {
       var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
      var code=300;
      $.ajax(
      {
         url:"action.php ",
         type:"POST",
         data:
         {
            code:code,id:id
         },
         success:function(response) 
         {
            spinner.style.display='none';
            time_out_staff();
         }
      });
   }
  
</script>



<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"  id="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Movment Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_stu">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>


<?php include "footer.php";  ?>