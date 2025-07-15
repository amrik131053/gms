<?php 
   include "header.php"; 
  
$tz = 'Asia/Kolkata';   
   date_default_timezone_set($tz);  ?>
   <!-- Modal -->
<div class="modal fade" id="sicActionModal" tabindex="-1" role="dialog" aria-labelledby="sicActionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sicActionModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="sicActionModalLabel_Record">
        
      </div>
      
    </div>
  </div>
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card card-info " id="myCollapsible">
               <div class="card-header">
                  <div class="row">
                     <div class="col-lg-1">
                        <h3 class="card-title">SIC</h3>
                     </div>
                     <div class="col-lg-11">
                        <div class="card-tools">
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" id="userId" placeholder="Employee ID / Roll Number" aria-describedby="button-addon2">
                                    <button class="btn btn-info btn-sm" type="button" id="button-addon2"  onclick="searchUser()"><i class="fa fa-search"></i></button>
                                 </div>
                              </div>
                              <div class="col-lg-4">

                              </div>
                              <div class="col-lg-5">
                                 <form action="sic-document-record-print.php" method="post" target="_blank">   
                                    <div class="input-group input-group-sm">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text bg-danger" id="inputGroup-sizing-sm">Start</span>
                                       </div>
                                       <input required type="datetime-local" class="form-control" name="startDate" aria-describedby="button-addon2">
                                       &nbsp;
                                       <div class="input-group-prepend">
                                          <span class="input-group-text bg-success" id="inputGroup-sizing-sm">End</span>
                                       </div>
                                       <input required type="datetime-local" class="form-control" name="endDate" aria-describedby="button-addon2">
                                       <button class="btn btn-info btn-sm" type="submit" id="button-addon2" ><i class="fa fa-file-export"></i></button>
                                    </div>
                                 </form>
                              </div>
                                 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body collapse"  id="student_search_record">
                  
                  
               </div>
            </div>
         </div>
      
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                        <div class="btn-group w-100 mb-2">
                    <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="sic_home();bg(this.id);"> Pending </a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="sic_printed();bg(this.id);"> Printed </a>
                    <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="sic_posted();bg(this.id);"> Posted </a>
                    <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="sic_issued();bg(this.id);"> Issued </a>
                    <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="sic_pending();bg(this.id);"> Pending </a>   
            </div>
               </div>
               <div class="card-body table-responsive" id="lab_users_data" style="font-size:12px;">

           <table class="table  " id="example" > 
            <thead>
              <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>RollNo</th>
                  <th>Name</th>
                  <th>FatherName</th>
                  <th>MotherName</th>
                  <th>Course/Department</th>
                  <th>Batch</th>
                  <th>Mode</th>
                  <th>Document</th>
                  <th>Apply Date</th>
                  <th>Status</th>
                  <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
           
          </tbody>
        </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
     $(window).on('load', function() 
          {
            sic_home();
         $('#btn1').toggleClass("bg-success"); 
           })
    function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }



   function labUsers() //ok
   {

       var code='99';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });
   }

   function assignSystem(id)  //ok
   {

      var receive=document.getElementById('receive').value;
      var applyfor=document.getElementById('applyfor').value;
      var address=document.getElementById('address').value;
      // var remarks=document.getElementById('remarks').value;
      if (receive!='' && applyfor!='') 
      {
         var code='98';
         $.ajax({
         url:'action_g.php',
         data:{code:code,id:id,receive:receive,applyfor:applyfor,address:address},
         type:'POST',
         success:function(data){
            // console.log(data);
         if(data != "")
         {
            labUsers();
            document.getElementById('userId').value='';
            $("#student_search_record").collapse('hide');
         }
         }
         });
      }
      else
      {
         ErrorToast('Select All Values.','bg-warning');
      }
   }
   function searchUser()  // ok
   {
      var userId=document.getElementById('userId').value;
      // alert(userId);
       var code='97';
         $.ajax({
         url:'action_g.php',
         data:{code:code,userId:userId},
         type:'POST',
         success:function(data){
            // console.log(data);
         if(data != "")
         {
            document.getElementById('student_search_record').innerHTML=data;
            $("#student_search_record").collapse('show');
         }
         }
         });
   }
function sic_home()
{

labUsers();
}
  function sic_printed()
   {
        var code='100';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });

   } 
function sic_posted()
{
  var code='101';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });
}
function sic_issued(){
  var code='102';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });
}
function sic_pending(){

  var code='103';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });
}


function postBySic(IDNo){

  var code='121';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo},
         type:'POST',
         success:function(data)
         {
            
    document.getElementById("sicActionModalLabel_Record").innerHTML=data;

         }
         });
}
function handOverToBySic(IDNo)
{
  var code='122';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo},
         type:'POST',
         success:function(data)
         {      
    document.getElementById("sicActionModalLabel_Record").innerHTML=data;
         }
         });
}
function handOverToBySicAction(IDNo)
{
      var idproof=document.getElementById('idproof'+IDNo).value;

      var idproofno=document.getElementById('idproofno'+IDNo).value;

  var code='123';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo,idproof:idproof,idproofno:idproofno},
         type:'POST',
        success:function(data)
         {
            // console.log(data);
           if (data==1) 
           {
                labUsers();
           }
         }
         });
}
function postBySicAction(IDNo)
{
      var idproof=document.getElementById('idproof'+IDNo).value;

      var idproofno=document.getElementById('idproofno'+IDNo).value;
      var speedpostno=document.getElementById('speedpostno'+IDNo).value;

  var code='124';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo,idproof:idproof,idproofno:idproofno,speedpostno:speedpostno},
         type:'POST',
        success:function(data)
         {
            // console.log(data);
           if (data==1) 
           {
                labUsers();
           }
         }
         });
}

function ShowHideDiv_address(id)
{
   // alert(id);
   if (id=='By Post')
    {
   $('#address_div').show('Slow');
    }
    else
    {
   $('#address_div').hide('Slow');

    }

}
function sicActionModal(IDNo) {
    document.getElementById("sicActionModalLabel_Record").innerHTML=IDNo;
}
</script>
<?php 
   include "footer.php"; 
   ?>