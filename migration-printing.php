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
                                 <input type="text"  style="width:150px "  name="student_roll_no" class="form-control" id='student_roll_no' placeholder="RollNo" aria-describedby="button-addon2" value="">
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
                  <h3 class="card-title">Entries </h3>
                  
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
 <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <div id='Editdetails'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="button" class="btn btn-primary"    onclick="update();" value="Save changes">
       
      </div>
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



     function update()
     {
     
  var srno= document.getElementById("srno").value;
  var idno= document.getElementById("idno").value;

  var examination= document.getElementById("examination_n").value;
   //alert(examination);
var result= document.getElementById("result_n").value;

var mid= document.getElementById("mid").value;
var code="257.4";



         var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php",
            type:"POST",
            data:
            {
               code:code,srno:srno,examination:examination,result:result,mid:mid,idno:idno
            },
            success:function(response) 
            {
              console.log(response);
               spinner.style.display='none';
               if (response == 1) {
                SuccessToast('Data Updated successfully');
                search_by_roll_no_by_id(idno);
               
            } 
            else{
                ErrorToast('Please try after sometime.', 'bg-danger');
            }

               
            }
         });      
     
     }



//  function update(form) {

//     var srno = form.srno.value;
//     var leaveFile = form.migrationfile.value;
   
  
//     if (srno === "") {

//         ErrorToast('Please select a Serial No .', 'bg-warning');
//         return;
//     }
   
//     // if (leaveFile === "") {

//     //     ErrorToast('Please upload an migration File.', 'bg-warning');
//     //     return;
//     // }

//     // var submitButton = form.querySelector('input[name="migrationupload"]');
//     // submitButton.disabled = true;
//     // submitButton.value = "Submitting...";

//     var formData = new FormData(form);
//     $.ajax({
//         url: form.action,
//         type: form.method,
//         data: formData,
//         contentType: false,
//         processData: false,
//         success: function(response) {
//              console.log(response);
//             if (response == 1) {
//                 SuccessToast('data submitted successfully');
               
//             } 
//             else{
//                 ErrorToast('Please try after sometime.', 'bg-danger');
//             }
//         },
//         error: function(xhr, status, error) {
//             // console.log(error);
//         },
       
//     });
// }




































  function edit(ID)
   {
    
          
      var code=257.3;
      var code_access = '<?php echo $code_access; ?>';
      if (ID!='') 
      {
         var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
         $.ajax(
         {
            url:"action.php",
            type:"POST",
            data:
            {
               code:code,ID:ID,code_access:code_access
            },
            success:function(response) 
            {
               spinner.style.display='none';
               document.getElementById("Editdetails").innerHTML =response;
            }
         });
      }
      else
      {
         document.getElementById("Editdetails").innerHTML ='';
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