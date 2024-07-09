<?php 
   include "header.php";  
   include "connection/connection.php"; 
   ?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <!-- Button trigger modal -->
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-info">
               <div class="card-header ">
                  <h3 class="card-title">ID Card</h3>
               </div>
              
                  <div class="card-body">
                     <div class="form-group row">

                      
                        <div class="col-lg-3">
                           <label>Student Name</label>
                           <input type="text" class="form-control" id="name" required="">
                         </div>
                         <div class="col-lg-3">
                           <label>Father Name</label>
                           <input type="text" class="form-control" id="father" required="">
                        </div>
                        <div class="col-lg-3">
                           <label>Class Rollno</label>
                           <input type="text" class="form-control" id="Classroll" required="">
                         </div>
                         <div class="col-lg-3">
                           <label>DOB</label>
                           <input type="date" class="form-control" id="DOB" required="">
                        </div>
                        <div class="col-lg-3">
                           <label>Batch</label> 
                           <select class="form-control" id="batch" required="">
                              <option>Select</option>
                              <?php
                                 for($i=2016;$i<=2030;$i++)
                                 {
                                   ?>
                              <option value="<?=$i;?>"><?=$i;?></option>
                              <?php
                                 }
                                 
                                 
                                                        ?>
                           </select>
                        </div>
                        <div class="col-lg-3">
                          <label>Valid Up To</label>
                           <input type="date" class="form-control" id="valid"required="" >
                        </div>
                        <div class="col-lg-3">
                           <label>College Name</label>
                           <select id="college" id="college" class="form-control" required="">
                              <option value=''>Select College</option>
                              <?php
                                 $sql = "SELECT CollegeID FROM UserAccessLevel WHERE IDNo='$EmployeeID' ";
                                 
                                 $sql="SELECT DISTINCT MasterCourseCodes.CollegeName from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID  where UserAccessLevel.IDNo='$EmployeeID' ";
                                          $stmt2 = sqlsrv_query($conntest,$sql);
                                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                         {
                                 
                            
                                     $college = $row1['CollegeName']; 
                                    ?>
                             <option  value="<?= $college;?>"><?= $college;?></option> 
                              <?php    }?>
                           </select>
                          
                        </div>
                        <div class="col-lg-3">
                           <label>Course</label>
                           <select class="form-control" id="course" id="course"required="">
                              <option value=" ">Select</option>
                              <option value="D.El.Ed.">D.El.Ed.</option>
                           </select>
                        </div>
                        <div class="col-lg-3">
                           <label>Phone Number</label>
                           <input type="text" class="form-control" id="contact"required="">
                        </div>
                        <div class="col-lg-4">
                           <label>Address</label>
                           <textarea  rows="1" type="text" class="form-control" id="address"required=""> </textarea> 
                        </div>
                        <div class="col-lg-3">
                           <label> <b>District</b></label>
                           <input id="District" placeholder="District" required=""  class="form-control"  rows="4" cols="50">
                        </div>
                        <div class="col-lg-3">
                           <label> <b>State</b></label>
                           <input id="State" placeholder="State" required=""  class="form-control"  rows="4" cols="50">
                        </div>
                         <div class="col-lg-3">
                           <label> <b>Pin Code</b></label>
                           <input id="Pincode" placeholder="Pin Code" required=""  class="form-control"  rows="4" cols="50">
                        </div>
                      
                     </div>
                  </div>
              
            </div>
        
         <div class="card-footer">
<center>
             <input type="button" class="btn btn-primary" name="create" value="Generate" onclick="id_card_data_submit();"  >
           </center>
         </div>
        
         <!-- /.card-footer -->
      
   </div>
   
   <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
   </div>
</section>
<p id="ajax-loader"></p>
<script type="text/javascript">

function id_card_data_submit()
{
      var name=document.getElementById("name").value;
      var father=document.getElementById("father").value;
      var Classroll=document.getElementById("Classroll").value;
      var DOB=document.getElementById("DOB").value;
      var batch=document.getElementById("batch").value;
      var valid=document.getElementById("valid").value;
      var college=document.getElementById("college").value;
      var course=document.getElementById("course").value;
      var contact=document.getElementById("contact").value;
      var District=document.getElementById("District").value;
      var address=document.getElementById("address").value;
      var State=document.getElementById("State").value;
      var Pincode=document.getElementById("Pincode").value;
      var District=document.getElementById("District").value;
       // alert(District);
         if (name!='' && father!='' && Classroll!='' && DOB!='' && batch!='' && valid!='' && college!='' && course!='') 
        {
        var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
         var code=178;
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,name:name,father:father,Classroll:Classroll,DOB:DOB,batch:batch,valid:valid,college:college,course:course,contact:contact,address:address,District:District,State:State,Pincode:Pincode,District:District
            },
            success: function(response) 
            {
              
                spinner.style.display='none';
              if (response==0)
                   {
                     ErrorToast('You Can`t Insert this Question. You have already uploaded for this selection','bg-danger' );
                   document.getElementById("name").value='';
      document.getElementById("father").value='';
      document.getElementById("Classroll").value='';
      document.getElementById("DOB").value='';
      document.getElementById("batch").value='';
      document.getElementById("valid").value='';
      document.getElementById("college").value='';
      document.getElementById("course").value='';
      document.getElementById("contact").value='';
      document.getElementById("District").value='';
      document.getElementById("address").value='';
      document.getElementById("State").value='';
      document.getElementById("Pincode").value='';
      document.getElementById("District").value='';
                  }
                  else
                  {
                   SuccessToast('Successfully Inserted');
              

                  }
            }
         });
   }
   else
   {
    ErrorToast('All Input Required','bg-danger' );
   }
   
   
}
</script>
<!-- Modal -->
<?php
   include "footer.php"; 
   
    ?>