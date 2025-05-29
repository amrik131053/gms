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


                       
                    

                     </div>

        
  <div class="col-md-12" style="display: none;" id="lect_div">  
  <label>Discription</label>
<input type="text" class="form-control" name="remarks" id='remarks' ><br>   
  <input type="file" id="musicFile" accept="audio/*">
  
  <br><br>
  <button   class="btn btn-danger form-control"  onclick="playMusic()"> Submit </button>
  </div>

  <div class="col-md-12" style="display: none;" id="lect_div1">
  <br>
  <div class="btn-group input-group-md">
                  <input type="text"  class="form-control" id='employeeId' placeholder="Employee ID." aria-describedby="button-addon2" value="">

                                 
                              <button class="btn btn-danger btn-sm" type="button" id="button-addon2" onclick="employee_search();" name="search"><i class="fa fa-search"></i></button>
                         

 </div>
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
       <th>Audio.</th>
       
       <button onclick="playMusic()">Play</button>
  <audio   id="musicPlayer" controls=""></audio>
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
   
 function playMusic() {
      var musicFile = document.getElementById("musicFile").files[0];
      var musicPlayer = document.getElementById("musicPlayer");
      musicPlayer.src = URL.createObjectURL(musicFile);
      musicPlayer.play();
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

     
     
    
   
   </script>



<?php include "footer.php"; 
?>