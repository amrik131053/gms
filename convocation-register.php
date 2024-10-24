<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        
    
    <div class="row" id="fetched_data">
    <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">
                        <h3 class="card-title">Convocation Registeration</h3>
                        <div class="card-tools">
                        <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="UniRolNo"  placeholder="University Roll No.">  <button  class="btn btn-success btn-sm"  onclick="fetch_data()" >Search</button>

                    </div>
                    </div>
                    </div>
                    <div class="card-body">
                        
                   
                        <div class="form-group row">
                     <div class="col-lg-6">

	<label>Uni Roll No</label> 

	<input type="text" name="UniRollNo"  class="form-control"  id='uni'  placeholder="Uni Roll No" >
		<label>Student Name</label>
	<input type="text" name="Name"  id="name" class="form-control"  placeholder="Student Name" >

	<label>Mobile</label>
	<input type="text" name="Mobile" id="Mobile"   class="form-control"  placeholder="Mobile" required="" minlength="10">
<label>Amount to be Paid</label>
	<input type="text"  name="Amount" id="Ammount"  class="form-control" value="2000" readonly >

						</div>

						<div class="col-lg-6">
								<label>Father Name</label>
								<input type="text" name="FatherName" id="fathername"  class="form-control"  placeholder="Father Name" >
								<label>Course</label>
									<input type="text" name="Course"  id="course" class="form-control"  placeholder="Batch"  required="">
									<label>Email</label>
								<input type="email" name="Email" id="Email"  class="form-control"  placeholder="Email" required="">
									<label>PayU id</label>
								<input type="text" name="payuid" id="payuid"  class="form-control"  placeholder="Payment id/Remarks" required="">
								<label>Action</label><br>
<button type="submit" class=" btn btn-success" name="submit" id="Search-student" onclick="submit();" >Submit</button>
						</div>

                    </div>
                </div>
                <div class="container" id="resultSuccess"></div>
</div>
</div>
</div>
</div>
</section>
<script type="text/javascript">

	function fetch_data()
	{
// alert();
var UniRolNo=document.getElementById('UniRolNo').value;


     var code=1;     
           $.ajax({
              url:'convo-action.php',
              type:'POST',
              data:{
                UniRolNo:UniRolNo,code:code
              },
              success: function(response) 
              {

              	if(response>0)
{
	
	document.getElementById("fetched_data").style.display='block';
	
	put_data();
}
else
{

	alert("No Record Found");

	location.reload(true);
	  
}
              	
          
                 
              }
           });
        
		
	}

	function put_data()
	{
// alert('d');
var UniRolNo=document.getElementById('UniRolNo').value;

          //var spinner=document.getElementById("ajax-loader");
     //spinner.style.display='block';
var code=2;
          
           $.ajax({
              url:'convo-action.php',
              type:'POST',
              data:{
                 UniRolNo:UniRolNo,code:code
              },
              dataType: 'json',
              success: function(response) 
              {
              	 //spinner.style.display='none';
   
                var id = response[0]['id'];
                 var name= response[0]['name'];
                 var fathername= response[0]['fathername'];
                  var course= response[0]['course'];
              
                // Set value to textboxes  personmeet
                document.getElementById('uni').value = id;
                document.getElementById('name').value = name;
                document.getElementById('fathername').value = fathername;
                 document.getElementById('course').value = course;

                 
                 
              
          }
           });
        return false;
		
	
}
function submit()
{
    var uni=document.getElementById('uni').value;
var name=document.getElementById('name').value;
var Mobile=document.getElementById('Mobile').value;
var Ammount=document.getElementById('Ammount').value;
var fathername=document.getElementById('fathername').value;
var course=document.getElementById('course').value;
var Email=document.getElementById('Email').value;
var payuid=document.getElementById('payuid').value;
    var code=3;
          
           $.ajax({
              url:'convo-action.php',
              type:'POST',
              data:{
                uni:uni,name:name,Mobile:Mobile,Ammount:Ammount,fathername:fathername,course:course,Email:Email,payuid:payuid,code:code
              },
              
              success: function(response) 
              {
                console.log(response);
               document.getElementById('resultSuccess').innerHTML=response;
              }
            });

}
</script>

<?php

 include "footer.php";  ?>