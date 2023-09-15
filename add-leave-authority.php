<?php  
   include "header.php";   
   ?>
   <script type="text/javascript">
      show_category_wise();
   function show_category_wise()
          {
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=50;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("category_wise_show").innerHTML=response;
               }
           });
          } 
           function show_emp_all(categoryID)
          {
            // alert(categoryID);
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=51;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,CategoryId:categoryID
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 document.getElementById("CollegeID_Set").value='CategoryId='+categoryID;
              }
           });
          }      
            function show_status_wise()
          {
         
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=52;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("status_wise_show").innerHTML=response;
              }
           });
          }   
            function show_emp_all_status(status)
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=53;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,status:status
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 document.getElementById("CollegeID_Set").value='JobStatus='+status;
              }
           });
          }     
            function show_role_wise()
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=54;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("role_wise_show").innerHTML=response;
              }
           });
          }      
            function show_emp_all_role(role)
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=55;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,role:role
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 document.getElementById("CollegeID_Set").value='Role='+role;
              }
           });
          }     
             function show_college_wise()
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=56;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
               // console.log(response);

                  spinner.style.display='none';
                 document.getElementById("college_wise_show").innerHTML=response;
              }
           });
          }    
           function show_all_depaertment(collegeId)
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=57;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("department_wise_show"+collegeId).innerHTML=response;
              }
           });
          }      
              

              function show_emp_all_department(collegeId,department)
          {
           
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=58;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId,department:department
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 document.getElementById("CollegeID_Set").value='CollegeID='+collegeId;
                 document.getElementById("CollegeID_Set").value='DepartmentID='+department;
              }
           });
          }    


    function search_all_employee_emp_name(emp_name)
          {
            if (emp_name!='') 
            {
            // var spinner=document.getElementById("ajax-loader");
               // spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,empID:emp_name
              },
              success: function(response) 
              {
                  // spinner.style.display='none';
                  document.getElementById("show_record").innerHTML=response;
         // document.getElementById('emp_name').value="";

              }
           });
        }
          } 
          function search_all_employee()
          {
            var emp_name=document.getElementById('emp_name').value;
              if (emp_name!='') 
            {
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,empID:emp_name
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
         // document.getElementById('emp_name').value="";

              }
           });
        }
          }  
            function update_emp_record(empID)
          {
            
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=61;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,empID:empID
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 $('#update_button').show();
                 tab();

              }
           });
        }  
              function AddleaveAuthority(collegeId)
          {
            
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=62;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
         

              },
              error:function(response) {
                 
               // console.log(response);
              }
           });
        }    
           function update_leave_authority(collegeId,department)
          {
           
            var Recommending=document.getElementById('Recommending'+department).value;
            var Senction=document.getElementById('Senction'+department).value;
            var spinner=document.getElementById("ajax-loader");
            // alert(Recommending);
               spinner.style.display='block';
           var code=63;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,department:department,Recommending:Recommending,Senction:Senction,collegeId:collegeId
              },
              success: function(response) 
              {
               // console.log(response);
                  spinner.style.display='none';
                  if(response==1)
                  {

                  SuccessToast('Successfully Updated');
                 AddleaveAuthority(collegeId);
                     }
                     else
                     {
                        // ErrorToast('bg-danger','Try Again');
                     }
              }
           });
        }
                function sync_leave_auth(collegeId)
          {
            
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=64;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId
              },
              success: function(response) 
              {
               // console.log(response);
                  spinner.style.display='none';
                  if(response==1)
                  {

                  SuccessToast('Successfully Sync');
                 
                     }
                     else
                     {
                        ErrorToast('bg-danger','Try Again');
                     }
              },
              error:function(response) {
                 
               // console.log(response);
              }
           });
        } 
        function emp_detail_verify1(id)
 {
     
           var code=186;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                  
                 document.getElementById("emp_detail_status_1").innerHTML=response;
              }
           });
}

function emp_detail_verify2(id)
 {
     
           var code=186;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                  
                 document.getElementById("emp_detail_status_2").innerHTML=response;
              }
           });
}


  function uploadPhoto(form) {
   var formData = new FormData(form);
      $.ajax({
         url: form.action,
         type: form.method,
         data: formData,
         contentType: false,
         processData: false,
         success: function(response) {
            // console.log(response);
            if (response==1) {
            SuccessToast('Successfully Uploaded');
        }
         },
         error: function(xhr, status, error) {
            console.log(error);
         }
      });
  }

  

function postcode(pincode) {
  var pincode = document.getElementById("pincode-input").value;
  var countryDisplay = document.getElementById("nationality");
  var stateDisplay = document.getElementById("state_by_post");
  var districtDisplay = document.getElementById("district_by_post");
  // var dropdown = document.getElementById("village_by_post");

  // Clear previous data
  countryDisplay.value = "";
  stateDisplay.value = "";
  districtDisplay.value = "";
  // dropdown.innerHTML = "";

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (response && response[0] && response[0].PostOffice && response[0].PostOffice.length > 0) {
        var Country = response[0].PostOffice[0].Country;
        var State = response[0].PostOffice[0].State;
        var District = response[0].PostOffice[0].District;

        countryDisplay.value = Country;
        stateDisplay.value = State;
        districtDisplay.value = District;

        // for (var i = 0; i < response[0].PostOffice.length; i++) {
        //   var option = document.createElement("option");
        //   option.value = i;
        //   option.text = response[0].PostOffice[i].Name;
        //   dropdown.add(option);
        // }
      }
    }
  };

  var url = "https://api.postalpincode.in/pincode/" + pincode;
  xhr.open("GET", url, true);
  xhr.send();
}

  function exportEmployee() 
      {
         var exportCode=20;

         var CollegeId=document.getElementById('CollegeID_Set').value;
         
        if (CollegeId!='') 
         {
           
          window.location.href="export.php?exportCode="+exportCode+"&CollegeId="+CollegeId;
         }
         else
         {
            alert("Select ");
         }
       
        
      }

function view_uploaded_document(IDNo,Label) {

    var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=95;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,IDNo:IDNo,label:Label
              },
              success: function(response) 
              {
               // console.log(response);
                  spinner.style.display='none';
                 document.getElementById("Show_document").innerHTML=response;

              },
              error:function(response) {
                 
               // console.log(response);
              }
           });
   
}

    function fetchDepartment(CollegeId)
{   
   
var code='96';
$.ajax({
url:'action_g.php',
data:{CollegeId:CollegeId,code:code},
type:'POST',
success:function(data){
if(data != "")
{
   //   console.log(data);
$("#departmentName").html("");
$("#departmentName").html(data);
}
}
});

}




function deleteRole(empid,userMasterId) 
{
   var a=confirm('Are you sure you want to delete  '+empid);
   // alert(id);
   if (a==true) {
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 182;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: {
            code: code,empid:empid,userMasterId:userMasterId
         },
         success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               erp_role_drop();
               SuccessToast('Successfully  Deleted');
               
            }
            else
            {
               
            }
         }
      });
   }
 
}

function DeleteCollegeCoursePermissions(id)
{
   var a=confirm('Are you sure you want to delete');
   if (a==true) {
  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 

  var code=188;
  var subjectIDs=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            subjectIDs.push(verifiy[i].value);
          }
       }
     


  if((typeof  subjectIDs[0]== 'undefined'))
  {
    alert('Select atleast one ');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{subjectIDs:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            if (data==1) 
            {
               searchForDelete(id);
                SuccessToast('Successfully Deleted');
               
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
   }
   else
   {

   }
}
function selectForDelete()
{
        if(document.getElementById("select_all1").checked)
        {
            $('.v_check').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.v_check').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.v_check').on('click',function()
    {
        var a=document.getElementsByClassName("v_check:checked").length;
        var b=document.getElementsByClassName("v_check").length;
        
        if(a == b)
        {

            $('#select_all1').prop('checked',true);
        }
        else
        {
            $('#select_all1').prop('checked',false);
        }
    });
 
}

function searchForDelete(id) {
var College = document.getElementById('CollegeForsearch').value;
var code = '190';
$.ajax({
    url: 'action_g.php',
    data: {
        College: College,empid:id,
        code: code
    },
    type: 'POST',
    success: function(data) {
      // console.log(data);
      document.getElementById('TableAssignedPermissions').innerHTML=data;
    }
});

}
function fetchcourse() {



var College = document.getElementById('CollegeID').value;
var department = document.getElementById('Department').value;

var code = '305';
$.ajax({
    url: 'action.php',
    data: {
        department: department,
        College: College,
        code: code
    },
    type: 'POST',
    success: function(data) {
        if (data != "") {
            //   console.log(data);
            $("#Course").html("");
            $("#Course").html(data);
        }
    }
});

}
function updateRole(empid,userMasterId) 
{

   var RightsLevel = document.getElementById("RightsLevel").value;
   var LoginType = document.getElementById("LoginType").value;
      // alert(LoginType+RightsLevel);
   var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 183;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,userMasterId:userMasterId,RightsLevel:RightsLevel,LoginType:LoginType
         },
         success: function(response) 
         {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               // erp_role_drop();
               SuccessToast('Successfully  Updated');
               erp_role_drop();
               
            }
            else
            {
               
            }
         }
      });
   }
function addCollegePermissions(empid) 
{

   // alert(empid);
   var CollegeID = document.getElementById("CollegeID").value;
   var Department = document.getElementById("Department").value;
   var Course = document.getElementById("Course").value;
   var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 191;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,CollegeID:CollegeID,Department:Department,Course:Course
         },
         success: function(response) 
         {
            console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               // erp_role_drop();
               SuccessToast('Successfully  Added');
               update_emp_record(empid);
               
            
            }
            else
            {
               
            }
         }
      });
   }


function deleteCollegeCourse(ID,empid) 
{
   var a=confirm('Are you sure you want to delete');
  
   if (a==true) {
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
      var code = 189;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,ID:ID,empid:empid
         },
         success: function(response) 
         {
            // console.log(response);
            spinner.style.display = 'none';
            if(response=='1')
            {
             
               SuccessToast('Successfully Deleted');
               searchForDelete(empid);
            }
            else
            {
               ErrorToast('try','bg-danger' );
            }
         }
      });
   }
   else
   {

   }
}


function addRole(empid,college) 
{

   var RightsLevel = document.getElementById("RightsLevel").value;
   var LoginType = document.getElementById("LoginType").value;
  
   // alert(LoginType+RightsLevel);
   if(RightsLevel!='' && LoginType!='' )
   {
   var spinner = document.getElementById("ajax-loader");
   // spinner.style.display = 'block';
      var code = 184;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,RightsLevel:RightsLevel,LoginType:LoginType,college:college
         },
         success: function(response) 
         {
            // console.log(response);
            // spinner.style.display = 'none';
            if(response=='1')
            {
               erp_role_drop();
               SuccessToast('Successfully  Inserted');
               
            }
            else
            {
               ErrorToast('try','bg-danger' );
            }
         }
      });
   }
   else
   {
      ErrorToast('all inputs required','bg-danger' );
   }
}
   </script>
 <!-- Content Wrapper. Contains page content -->
  
   

<!-- Small modal -->
<!-- Modal -->
<div class="modal fade" id="UploadImageDocument" tabindex="-1" role="dialog" aria-labelledby="UploadImageDocumentTitle" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="Show_document">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">


      <div class="card">
  <div class="card-header">
    <h3 class="card-title">CATEGORY</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="show_category_wise();">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column" id="category_wise_show">
      <!-- Some content can be added here -->
    </ul>
  </div>
  <!-- /.card-body -->
</div>
 
        <div class="card collapsed-card">
  <div class="card-header">
    <h3 class="card-title">STATUS</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="show_status_wise();">
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column" id="status_wise_show">
      <!-- Your content goes here -->
    </ul>
  </div>
</div>

        <div class="card collapsed-card">
  <div class="card-header">
    <h3 class="card-title">ROLE</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="show_role_wise();">
        <i class="fas fa-plus" ></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column" id="role_wise_show">
      <!-- Content for role-wise data will be added here dynamically through JavaScript -->
    </ul>
  </div>
  <!-- /.card-body -->
</div>

<div class="card collapsed-card">
  <div class="card-header">
    <h3 class="card-title">COLLEGE</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="show_college_wise();">
        <i class="fas fa-plus" ></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">
    <ul class="nav nav-pills flex-column" id="college_wise_show">
      <!-- Content for college-wise data will be added here dynamically through JavaScript -->
    </ul>
  </div>
  <!-- /.card-body -->
</div>

         
        </div>
        <!-- /.col -->
      <div class="col-md-9">
  <div class="card card-outline">
    <div class="card-header">
      <!-- <h3 class="card-title">Employee</h3> -->
      <button type="button" onclick="exportEmployee();" class="btn btn-success btn-xs">
        <i class="fa fa-file-excel"></i>
      </button>
      <input type="hidden" id="CollegeID_Set">

      <div class="card-tools">
        <div class="input-group">
          <input type="search" onblur="search_all_employee_emp_name(this.value);" class="form-control" name="emp_name" id="emp_name" placeholder="Search here">
          <div class="input-group-append">
            <button type="button" onclick="search_all_employee();" class="btn btn-default">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <form action="action_g.php" method="post" enctype="multipart/form-data">
        <div class="table-responsive" id="show_record" style="height:auto;">
          <!-- Your table to display employee records goes here -->
        </div>
      </form>
      <!-- /.mail-box-messages -->
    </div>
    <!-- /.card-body -->
    
   
                       
      <!-- Additional footer content if needed -->
    </div>
  </div>
  <!-- /.card -->
</div>

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
 
<p id="ajax-loader"></p>

<!-- Modal -->
<?php include "footer.php"; ?>