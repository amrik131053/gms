<?php 

  include "header.php";
  // $array[]=''; 
 $permissionCount=0;
$permission_qry="SELECT * FROM category_permissions where employee_id='$EmployeeID' and is_admin='1'";
$permission_res=mysqli_query($conn,$permission_qry);
while($permission_data=mysqli_fetch_array($permission_res))
{
   $permissionCount++;
}

 
?>
<style type="text/css">
  
.my
   {
   background-color: #a62535;
   color: #fc3;
   }
   input[type=radio] + label {
   background-color: #a62535;
   color: #fc3;
   } 
   input[type=radio]:checked + label {
   color: #fc3;
   background-color:#223260;
   } 
</style>
<style type="text/css">
   h5{
   color: black;
   text-decoration: bold;
   }
</style>
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<section class="content">
   <div class="container-fluid">
      <div class="row">
       
       

        <div class="col-lg-3 col-md-3 col-sm-3" >


   <script>
               function emc1_show() {
               var x = document.getElementById("lect_div");
                 var y = document.getElementById("lect_div1");
                 var z = document.getElementById("after_data");
               x.style.display = "block";
                y.style.display = "none";
 z.style.display = "none";
               
               
               }
                      function emc1_hide() {
               var x = document.getElementById("lect_div");
                var y = document.getElementById("lect_div1");
                 var z = document.getElementById("after_data");

               x.style.display = "none";
                y.style.display = "block";
                 z.style.display = "none";
               }
               
               
            </script>



               <div class="card-header" style="background-color: #223260;">Visitor Entry Form</div>
                  <div class="card card-body" >

                     <div class="btn-group input-group-sm" style="text-align:center;">

                       <input type="radio"  id="ossm"    hidden="" required="" checked=""
                       onclick="emc1_show();" value="Guest" name="empc1">  

                       <label for="ossm" class="btn btn-xs"> Guest</label>


                       <input type="radio"   id="ossm1"  onclick="emc1_hide();" name="Employee" value='2' hidden="" required="">  

                       <label for="ossm1" class="btn  btn-xs"> Employee</label>

                    

                     </div>

        
  <div class="col-md-12" style="display: none;" id="lect_div">      
  <label>Name <span style="color: red">*</span></label>
  <input type="text" name="name_visitor" id="name_visitor" class="form-control">
  <label>Mobile No <span style="color: red">*</span></label>
  <input type="text" name="mobile_visitor" id="mobile_visitor" class="form-control">
  <label>Purpose <span style="color: red">*</span></label>
  <input type="text" name="purpose_visitor" id="purpose_visitor" class="form-control">
  <label>Address <span style="color: red">*</span></label>
  <textarea type="text" name="address_visitor" id="address_visitor" class="form-control"></textarea>
  <br>
  <button   class="btn btn-danger form-control"  onclick="insert_guest_visitor()"> Submit </button>
  </div>

  <div class="col-md-12" style="display: none;" id="lect_div1">
  <br>
  <div class="btn-group input-group-md">
                  <input type="text"  class="form-control" id='employeeId' placeholder="Employee ID." aria-describedby="button-addon2" value="">

                                 
                              <button class="btn btn-danger btn-sm" type="button" id="button-addon2" onclick="employee_search();" name="search"><i class="fa fa-search"></i></button>
                         

 </div>
</div>











   <div id="after_data" style="display:none"> 
  
    

  <label>Name</label>
               <input type="text" name="e_name" id="name" class="form-control"  placeholder="" readonly>

           <label>Mobile No <span style="color: red">*</span></label>

  <input type="text"  id="mobile_e"  class="form-control" readonly>
  <label>Designation</label>
               <input type="text"  id="designation" class="form-control" placeholder="" readonly>
  <label>Department</label>
          <input type="text"  id="department" class="form-control"   placeholder="" readonly>
          <label>Purpose</label>
          <textarea type="text" name="e_purpose" id="e_purpose" class="form-control"></textarea>
           
          <br>
          
          <button   class="btn btn-danger"  onclick="insert_eployee_visitor()"> Submit </button>

</div>
  
            
     
      </div>
   </div>

        <div class="col-lg-9 col-md-9 col-sm-9" >

            <div class="card card-info" >
               <div class="card-header" style="background-color: #223260;">Reports</div>
                  <div class="card-body table-responsive">          
<table class="table" style="font-size: 14px" >

<thead>
   <tr>
       <th>#</th>
       <th>Name</th>
       <th>Mobile No.</th>
       <th>Designation</th>
       <th>Department</th>
       <th>Address</th>
       <th>Entry Time</th>
       <th>Exit Time</th>
       <th>Action</th>
   </tr>
 </thead>
  <tbody style="height:1px" id="table_load" ></tbody> 
         </table>
         </div>

            </div>
         
      </div>
   </div>


</div>
</div>
</section>
   <p id="ajax-loader"></p>


   <script type="text/javascript">

    $(window).on('load', function() 
          {
             fetch_data();
        
           })
    function fetch_data()
       {
       var code=342;

       
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
                  },
            success: function(response) 
            {

 
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });

     }

   
  
      function employee_search(id)
      {  
         id=document.getElementById("employeeId").value;
 var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
        var code='145';
         $.ajax({
         url:'action.php',
         data:{code:code,search:id},
         type:'POST',
          dataType: 'json',
         success:function(response){
         if(response != "")
         {
      
           

          
              var id = response[0]['value'];
              
              var name= response[0]['name'];
              var mobile= response[0]['mobile'];
              var designation= response[0]['designation'];
              var department= response[0]['department'];
                // Set value to textboxes  personmeet
                document.getElementById('name').value = name;
                document.getElementById('mobile_e').value =mobile;
                document.getElementById('department').value = department;
                 document.getElementById('designation').value = designation;
               spinner.style.display='none';

            var after = document.getElementById("after_data");
            after.style.display ="block";

         


         }
         }
         });
      } 

     
      function insert_eployee_visitor()
      {
         
          var code='341';
             var idno=document.getElementById("employeeId").value;
             var name=document.getElementById("name").value;
             var mobile=document.getElementById('mobile_e').value 
             var department=   document.getElementById('department').value 
             var designation=   document.getElementById('designation').value
             var purpose=   document.getElementById('e_purpose').value
         
         
         if (purpose!=''&& idno!='' &&mobile!=''&&designation!=''&&department!='') 
         {
         var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
         
            $.ajax({
            url:'action.php',
            data:{code:code,e_name:name,idno:idno,mobile_e:mobile,e_department:department,e_designation:designation,e_purpose:purpose},
            type:'POST',
            success:function(data){
                spinner.style.display='none';
                 
            if(data==1){


                SuccessToast('Successfully Updated');
                         fetch_data();
                           }
                          else
                           {
                           ErrorToast('Try Again','bg-danger' );
                           }
            }
            
            });
         }
        
        
      }

  function insert_guest_visitor()
      {


             var code='28.1';
            
             var name=document.getElementById("name_visitor").value;
             var mobile=document.getElementById('mobile_visitor').value 
             var address=   document.getElementById('address_visitor').value 
  
             var purpose=   document.getElementById('purpose_visitor').value
         
         
         if (purpose!='' &&mobile!='') 
         {
         var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
         
            $.ajax({
            url:'action.php',
            data:{code:code,e_name:name,mobile_e:mobile,address:address,e_purpose:purpose},
            type:'POST',
            success:function(data){
               console.log(data);
                spinner.style.display='none';
                 
            if(data==1){


                SuccessToast('Successfully Updated');
                         fetch_data();
                           }
                          else
                           {
                           ErrorToast('Try Again','bg-danger' );
                           }
            }
            
            });
         }
        
        
      }
  
      function checkout_office(id)
       {
       var code=345;

           
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


               spinner.style.display='none';
               fetch_data();
              
            }
         });

     }
    
   
   </script>



<?php include "footer.php"; 
?>