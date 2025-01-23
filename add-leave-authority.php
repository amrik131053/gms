<?php  
   include "header.php";   
   ?>

   <script type="text/javascript">


function SyncNewStaff()
          {
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=26.9;
           $.ajax({
              url:'action_a.php',
              type:'POST',
              data:{
                 flag:code
              },
              success: function(response) 
              {
                //console.log(response);
                  spinner.style.display='none';
        
          if(response==1){
            
          SuccessToast('Updated Successfully');
               }
           }
           });
          } 




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
            function show_qualification_wise()
          {
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var flag=5;
           $.ajax({
              url:'action_a.php',
              type:'POST',
              data:{
                 flag:flag
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("qualification_wise_show").innerHTML=response;
                 
               }
           });
          } 
                 function show_emp_all_qualification(categoryID)
          {
            var qcode="qualification";
            // alert(categoryID);
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,CategoryId:categoryID,qcode:qcode
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 document.getElementById("CollegeID_Set").value='StandardType='+categoryID;
              }
           });
          }  
           function show_emp_all(categoryID)
          {
            var qcode="category";
            // alert(categoryID);
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,CategoryId:categoryID,qcode:qcode
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
            var qcode="status";
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=59; 
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,status:status,qcode:qcode
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
            var qcode="role";
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,role:role,qcode:qcode
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 document.getElementById("CollegeID_Set").value='RoleID='+role;
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
          function submitLeaveAuthority() {
        
        var recommendID=document.getElementById("recommendID").value;
        var senctionID=document.getElementById("senctionID").value;
     if(recommendID!='' &&  senctionID!='') 
     {

var students = document.getElementsByClassName('empidA');
var len_student = students.length;
var code = 12; 
var student_str = [];
for (var i = 0; i < len_student; i++) {
  if (students[i].checked === true) {
      student_str.push(students[i].value);
  }
}
if (student_str.length === 0 ) {
  ErrorToast('please select atleast one employee','bg-danger');
} else {
  var spinner = document.getElementById("ajax-loader");
  if (spinner) {
      spinner.style.display = 'block';
  }
  $.ajax({
      url: 'action_a.php',
      data: { students: student_str, flag: code,recommendID:recommendID,senctionID:senctionID }, 
      type: 'POST',
      success: function (data) {
          if (spinner) {
              spinner.style.display = 'none';
          }
          // console.log(data);
          SuccessToast('Submit Successfully');
          // alert('Inserted Successfully.');
      },
      error: function (xhr, status, error) {
          if (spinner) {
              spinner.style.display = 'none';
          }
          // alert('An error occurred: ' + error);
      }
  });
}
}
else{
    ErrorToast('please enter recommend authority & senction authority','bg-warning');
}
}
              function show_emp_all_college(collegeId)
          {
            var qcode="college";
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId,qcode:qcode
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 document.getElementById("CollegeID_Set").value='CollegeID='+collegeId;
      
              }
           });
          }    
              function show_emp_all_department(collegeId,department)
          {
            var qcode="department";
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=59;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,collegeId:collegeId,department:department,qcode:qcode
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
                 document.getElementById("CollegeID_SetOnly").value=collegeId;
                 document.getElementById("CollegeID_Set").value='CollegeID='+collegeId;
                 document.getElementById("CollegeID_Set").value='DepartmentID='+department;
              }
           });
          }    
          function view_image(id) {
                     var code = 377;
                     $.ajax({
                        url: 'action_g.php',
                        type: 'post',
                        data: {
                           uni: id,
                           code: code
                        },
                        success: function(response) {
                        //    console.log(response);
                           document.getElementById("image_view").innerHTML = response;
                        }
                     });
                  }
    function search_all_employee_emp_name(emp_name)
          {
            var qcode="search";
            if (emp_name!='') 
            {
            // var spinner=document.getElementById("ajax-loader");
               // spinner.style.display='block';
           var code=59;
            $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,empID:emp_name,qcode:qcode
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
            var qcode="search";
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
                 code:code,empID:emp_name,qcode:qcode
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
               //  console.log(response);
                  spinner.style.display='none';
                 document.getElementById("emp_details_colaped"+empID).innerHTML=response;
                 $('#update_button'+empID).show();
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
        function emp_detail_verify4(id)
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
                  
                 document.getElementById("emp_detail_status_Promotion4").innerHTML=response;
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
function emp_detail_verify21(id)
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
                  
                 document.getElementById("emp_detail_status_21").innerHTML=response;
              }
           });
}
function emp_detail_verify23(id)
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
                  
                 document.getElementById("emp_detail_status_23").innerHTML=response;
              }
           });
}
function emp_detail_verify3(id)
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
                  
                 document.getElementById("emp_detail_status_Promotion3").innerHTML=response;
              }
           });
}




  function uploadPhoto(form) {
    
   var employmentStatus = form.employmentStatus.value;
    var leavingDate = form.leavingDate.value;
    if (employmentStatus == "0" && leavingDate === "") {
        ErrorToast('Please provide a leaving date.', 'bg-warning');
        return false; // Prevent form submission
    }
   var loginId = form.loginId.value;
   var formData = new FormData(form);
      $.ajax({
         url: form.action,
         type: form.method,
         data: formData,
         contentType: false,
         processData: false,
         success: function(response) {
            //  console.log("Console:"+response+"H");
            if (response==1) 
            {
               update_emp_record(loginId);
            SuccessToast('Successfully Updated '+loginId);
                }
             else if(response=='Could not connect to 10.0.10.11')
                {
                 ErrorToast('FTP Server Off' ,'bg-warning');
                }
               else
                {

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
function updateRelievingDate(id, dateValue,empid) {
    var code=13;
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    $.ajax({
              url:'action_a.php',
              type:'POST',
              data:{
                 flag:code,id:id,relievingDate:dateValue
              },
              success: function(response) 
              {
                console.log(response);
                spinner.style.display = 'none';
                if (response == 1) {
               update_emp_record(empid);
               SuccessToast('Successfully Update');
                }
                  
              }
           });
    }
    
function addletters(form) {
    var letter_type=form.letter_type_gen.value;
    var id=form.employeeIDgen.value;
    var refernaceletter=form.refernacelettergen.value;
    var startdateofissueletter=form.startdateofissuelettergen.value;
    var remarksletters=form.remarkslettersgen.value;

    var fileAttachment=form.fileAttachmentgen.value;
    
    if (letter_type === "") {
        ErrorToast('Please select Letters.', 'bg-warning');
        return false;
    }
    if (refernaceletter === "") {
        ErrorToast('Please select reference.', 'bg-warning');
        return false;
    }
    
    if (startdateofissueletter === "") {
        ErrorToast('Please select start date.', 'bg-warning');
        return false;
    }
    if (remarksletters === "") {
        ErrorToast('Please enter remarks.', 'bg-warning');
        return false;
    }
    if (fileAttachment === "") {
        ErrorToast('Please select file.', 'bg-warning');
        return false;
    }
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form); 
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            if (response == 1) {
               update_emp_record(id);
               SuccessToast('Successfully Added');
                } else if (response === 'Could not connect to 10.0.10.11') {
                    ErrorToast('FTP Server Off', 'bg-warning');
                } else if (response == 2) {
                    ErrorToast('size must be less than 500kb', 'bg-warning');
                } else if (response == 3) {
                    ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                } else {
                    ErrorToast('Other Error', 'bg-danger');
                }
                  },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    ErrorToast('Submission failed: ' + error);
                }
            });
        }
function addAditionalDuty(form,id) {
    var organisationNameAddtional=form.organisationNameAddtional.value;
    var departmentAddtional=form.departmentAddtional.value;
    var designationAddtional=form.designationAddtional.value;
    var startDateAddtional=form.startDateAddtional.value;
    var endDateAddtional=form.endDateAddtional.value;
    var remarksAddtional=form.remarksAddtional.value;
    var fileAttachment=form.fileAttachment.value;
    if (organisationNameAddtional === "") {
        ErrorToast('Please select College.', 'bg-warning');
        return false;
    }
    if (departmentAddtional === "") {
        ErrorToast('Please select department.', 'bg-warning');
        return false;
    }
    if (designationAddtional === "") {
        ErrorToast('Please select designation.', 'bg-warning');
        return false;
    }
    if (startDateAddtional === "") {
        ErrorToast('Please select start date.', 'bg-warning');
        return false;
    }
    if (remarksAddtional === "") {
        ErrorToast('Please enter remarks.', 'bg-warning');
        return false;
    }
    if (fileAttachment === "") {
        ErrorToast('Please select file.', 'bg-warning');
        return false;
    }
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    var loginId = formData.get("IDEmployee"); 
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            if (response == 1) {
               update_emp_record(id);
               SuccessToast('Successfully Added');
                } else if (response === 'Could not connect to 10.0.10.11') {
                    ErrorToast('FTP Server Off', 'bg-warning');
                } else if (response == 2) {
                    ErrorToast('size must be less than 500kb', 'bg-warning');
                } else if (response == 3) {
                    ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                } else {
                    ErrorToast('All inputs required', 'bg-danger');
                }
                  },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    ErrorToast('Submission failed: ' + error);
                }
            });
        }
function submitPromition(form) {
   
    var organisationNamePromition = form.organisationNamePromition.value;
    var departmentNamePromition = form.departmentNamePromition.value;
    var designationPromition = form.designationPromition.value;
    var joiningDatePromition = form.joiningDatePromition.value;
    var salaryPromition = form.salaryPromition.value;
    var leaveRecommendingAuthorityPromition = form.leaveRecommendingAuthorityPromition.value;
    var leaveSanctionAuthorityPromition = form.leaveSanctionAuthorityPromition.value;
    var promotionFile = form.promotionFile.value;
    if (organisationNamePromition === "") {
        ErrorToast('Please select College.', 'bg-warning');
        return false; // Prevent form submission
    }
    if (departmentNamePromition === "") {
        ErrorToast('Please select Department.', 'bg-warning');
        return false; // Prevent form submission
    }
    if (designationPromition === "") {
        ErrorToast('Please select Designation.', 'bg-warning');
        return false; // Prevent form submission
    }
    if (joiningDatePromition === "") {
        ErrorToast('Please select joining Date.', 'bg-warning');
        return false; // Prevent form submission
    }
    if (salaryPromition === "") {
        ErrorToast('Please enter salary.', 'bg-warning');
        return false; // Prevent form submission
    }
    if (leaveRecommendingAuthorityPromition === "") {
        ErrorToast('Please enter leave Recommending Authority.', 'bg-warning');
        return false; // Prevent form submission
    }
    if (leaveSanctionAuthorityPromition === "") {
        ErrorToast('Please enter leave Sanction Authority.', 'bg-warning');
        return false; // Prevent form submission
    }
    if (promotionFile === "") {
        ErrorToast('Please enter File.', 'bg-warning');
        return false; // Prevent form submission
    }

    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    var loginId=document.getElementById('loginId').value;
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            console.log(response);
            if (response == 1) {
               update_emp_record(loginId);
           SuccessToast('Successfully Added Promotion');
           $('#promotionData').modal('hide');
       } else if (response === 'Could not connect to 10.0.10.11') {
           ErrorToast('FTP Server Off', 'bg-warning');
       } else if (response == 2) {
           ErrorToast('size must be less than 500kb', 'bg-warning');
       } else if (response == 3) {
           ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
       } else {
           ErrorToast('All inputs required', 'bg-danger');
       }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}
function viewAdditionalDocument(id) {
    var code = 57.3;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}
function deleteaddtional(id,emp) {
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '432.5';
        $.ajax({
            url: 'action_g.php',
            data: {
                ID:id,emp_id:emp,code:code
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                console.log(data);
                SuccessToast('Successfully Deleted');
                update_emp_record(emp);

            }
        });
    } else {

    }
}
  function exportEmployee() 
      {
         var exportCode=20;

         var CollegeId=document.getElementById('CollegeID_Set').value;
         var CollegeIDOnly=document.getElementById('CollegeID_SetOnly').value;
         
        if (CollegeId!='') 
         {
           
          window.location.href="export.php?exportCode="+exportCode+"&CollegeId="+CollegeId+"&CollegeIDOnly="+CollegeIDOnly;
         }
         else
         {
            alert("Select ");
         }
      }
  function downloadphdDetails() 
      {
         var exportCode=83;
       
           
          window.location.href="export.php?exportCode="+exportCode;
         
      }


      function view_uploaded_document(id, documentP) {
    var code = 59;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("documentData").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code + "&document=" + documentP, true);
    xmlhttp.send();
}



// function view_uploaded_document(IDNo,Label) {

//     var spinner=document.getElementById("ajax-loader");
//                spinner.style.display='block';
//            var code=95;
//            $.ajax({
//               url:'action_g.php',
//               type:'POST',
//               data:{
//                  code:code,IDNo:IDNo,label:Label
//               },
//               success: function(response) 
//               {
//                // console.log(response);
//                   spinner.style.display='none';
//                  document.getElementById("Show_document").innerHTML=response;

//               },
//               error:function(response) {
                 
//                // console.log(response);
//               }
//            });
   
// }

    function fetchDepartmentPromotion(CollegeId)
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
$("#departmentNamePromition").html("");
$("#departmentNamePromition").html(data);
}
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
    function fetchDepartment1(CollegeId)
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
$("#departmentName1").html("");
$("#departmentName1").html(data);
}
}
});

}




function lmsDeleteRole(empid) 
{
   var a=confirm('Are you sure you want to delete  '+empid);
   if (a==true) {
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 202;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: {
            code: code,empid:empid
         },
         success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               update_emp_record(empid);
               SuccessToast('Successfully  Deleted');
               
            }
            else
            {
               
            }
         }
      });
   }
 
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
               update_emp_record(empid);
               SuccessToast('Successfully  Deleted');
               
            }
            else
            {
               
            }
         }
      });
   }
 
}
function sessionAlllogout(id) {
   var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
  var code=390;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code,id:id},
   success:function(res)
   {
      spinner.style.display = 'none';
   }
  });
}

function deleteCollegeCoursePermissions(id)
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
function deleteCollegeCoursePermissionsAccount(id)
{
  
   var a=confirm('Are you sure you want to delete');
   if (a==true) {
  var verifiy=document.getElementsByClassName('v_checkAccount');
var len_student= verifiy.length; 

  var code=365; //188
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
               searchForDeleteAccount(id);
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
function selectForLeave()
{
        if(document.getElementById("select_all13").checked)
        {
            $('.empidA').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.empidA').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.empidA').on('click',function()
    {
        var a=document.getElementsByClassName("empidA:checked").length;
        var b=document.getElementsByClassName("empidA").length;
        
        if(a == b)
        {

            $('#select_all13').prop('checked',true);
        }
        else
        {
            $('#select_all13').prop('checked',false);
        }
    });
 
}
function selectForDeleteAccount()
{
        if(document.getElementById("select_all1Account").checked)
        {
            $('.v_checkAccount').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.v_checkAccount').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.v_checkAccount').on('click',function()
    {
        var a=document.getElementsByClassName("v_checkAccount:checked").length;
        var b=document.getElementsByClassName("v_checkAccount").length;
        
        if(a == b)
        {

            $('#select_all1Account').prop('checked',true);
        }
        else
        {
            $('#select_all1Account').prop('checked',false);
        }
    });
 
}

function searchForDelete(id) {
var College = document.getElementById('CollegeID').value;
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
function searchForDeleteAccount(id) {
var College = document.getElementById('CollegeIDAccount').value;
var ApplicationType = document.getElementById('ApplicationTypeAccount').value;
var code = '363'; //190
$.ajax({
    url: 'action_g.php',
    data: {
        College: College,empid:id,ApplicationType:ApplicationType,
        code: code
    },
    type: 'POST',
    success: function(data) {
      // console.log(data);
      document.getElementById('TableAssignedPermissionsAccount').innerHTML=data;
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
function lmsUpdateRole(empid) 
{
   var LoginType = document.getElementById("LoginType_lms").value;
   var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 201;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,LoginType:LoginType
         },
         success: function(response) 
         {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               // erp_role_drop();
               SuccessToast('Successfully  Updated');
               update_emp_record(empid);
               
            }
            else
            {
               
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
               update_emp_record(empid);    
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
            // console.log(response);
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
function addCollegePermissionsAccount(empid) 
{
   var CollegeID = document.getElementById("CollegeIDAccount").value;
   var ApplicationType = document.getElementById("ApplicationTypeAccount").value;
   // var Course = document.getElementById("Course").value;
   var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 362; // 191
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,CollegeID:CollegeID,ApplicationType:ApplicationType
         },
         success: function(response) 
         {
            // console.log(response);
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
   function addCollegePermissionsAccordingToCollegeAdd(empid) 
{
   var CollegeID = document.getElementById("College3").value;
   var Department = document.getElementById("Department3").value;
   var Course = "";
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
            if(response==1)
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
function deleteCollegeCourseAccount(ID,empid) 
{
   var a=confirm('Are you sure you want to delete');
  
   if (a==true) {
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
      var code = 364; ///189
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
            if(response==1)
            {
               SuccessToast('Successfully Deleted');
               searchForDeleteAccount(empid);
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
function addEmpInLms(loginId,category) 
{

   
      var code = 226;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,loginId:loginId
         },
         success: function(response) 
         {
        
            lmsAddRoleAcordingToAddEmp(loginId,category);
         }
      });
 
}
function lmsAddRoleAcordingToAddEmp(empid,category) 
{
   
   // alert(category);
 
      var code = 225;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,LoginType:category
         },
         success: function(response) 
         {
           
         }
      });
 
}

function lmsAddRole(empid) 
{

   var LoginType = document.getElementById("LoginType_lms").value;
   // alert(LoginType+RightsLevel);
   if(LoginType!='' )
   {
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
      var code = 200;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: 
         {
            code: code,empid:empid,LoginType:LoginType
         },
         success: function(response) 
         {
            console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
              
               SuccessToast('Successfully  Inserted');
               update_emp_record(empid);
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
function addRole(empid,college) 
{
   var RightsLevel = document.getElementById("RightsLevel").value;
   var LoginType = document.getElementById("LoginType").value;
   // alert(LoginType+RightsLevel);
   if(RightsLevel!='' && LoginType!='' )
   {
   var spinner = document.getElementById("ajax-loader");
   spinner.style.display = 'block';
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
            spinner.style.display = 'none';
            if(response==1)
            {
              
               SuccessToast('Successfully  Inserted');
               update_emp_record(empid);
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



function manageDepartment()
          {
       var code=192;

      
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("show_record").innerHTML=response;
               }
         });

     }
function search()
          {
       var code=327;

       var college=document.getElementById('CollegeID_For_Department').value;
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,college:college},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("tab_data").innerHTML=response;
               }
         });

     }

     function update_dep(id)
          {
       var code=328;

       
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,id:id},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("update_data").innerHTML=response;
               }
         });

     }
     function update_designation(id)
          {
       var code=195;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code,id:id},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("update_data_designation").innerHTML=response;
               manageDesignation();
               }
         });

     }
     function viewPromitonModal(id)
          {
            
             
       var code=6;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action_a.php',
                type:'POST',
                data:{flag:code},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("promotionData").innerHTML=response;
               document.getElementById("loginIdPromotion").value=id;
               }
         });

     }







    function UpdatedepDesignation(id)

   {
       var code=196;
  var fullname=document.getElementById('fullname').value;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code,id:id,fullname:fullname},
                success: function(response) 
               { 
               spinner.style.display='none';
               manageDesignation();
                SuccessToast('Successfully Updated');

              // document.getElementById("update_data").innerHTML=response;
               }
         });

     }

    function Updatedepdata(id)

   {
       var code=329;
 var shortname=document.getElementById('shortname').value;
  var fullname=document.getElementById('fullname').value;
   var college=document.getElementById('CollegeID').value;
      
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,id:id,shortname:shortname,fullname:fullname,college:college},
                success: function(response) 
               { 
               spinner.style.display='none';
                 search();
                SuccessToast('Successfully Updated');

              // document.getElementById("update_data").innerHTML=response;
               }
         });

     }


function delete_dep(id)
{
   var a=confirm('Are you sure you want to delete');
   // alert(id);
   if (a==true) {
var code=331;
 var spinner=document.getElementById('ajax-loader');

         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,id:id},
                success: function(response) 
               { 
               	console.log(response);
               spinner.style.display='none';
               search();
                SuccessToast('Successfully Deleted');
              // document.getElementById("tab_data").innerHTML=response;
               }
         });
      }
      else
      {

      }
}
function delete_designation(id)
{
   var a=confirm('Are you sure you want to delete');
   // alert(id);
   if (a==true) {
var code=197;
 var spinner=document.getElementById('ajax-loader');

         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code,id:id},
                success: function(response) 
               { 
               	// console.log(response);
               spinner.style.display='none';
               manageDesignation();
                SuccessToast('Successfully Deleted');
              // document.getElementById("tab_data").innerHTML=response;
               }
         });
      }
      else
      {

      }
}







     	function save()
	{
		var code=330;

       var college=document.getElementById('CollegeIDN').value;
       var department=document.getElementById('department').value;
    
         var spinner=document.getElementById('ajax-loader');

         spinner.style.display='block';
   $.ajax({
                url:'action.php',
                type:'POST',
                data:{code:code,college:college,department:department},
                success: function(response) 
               { 
               	// console.log(response);
               spinner.style.display='none';
               search();
                SuccessToast('Successfully Updated');
              // document.getElementById("tab_data").innerHTML=response;
               }
         });



	}
     	function save_designation()
	{
		var code=194;
       var department=document.getElementById('Designation').value;
    
         var spinner=document.getElementById('ajax-loader');

         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code,department:department},
                success: function(response) 
               { 
               	// console.log(response);
               spinner.style.display='none';
               manageDesignation();
                SuccessToast('Successfully Added');
              // document.getElementById("tab_data").innerHTML=response;
               }
         });



	}

   function manageDesignation()
          {
       var code=193;

      
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("show_record").innerHTML=response;
               }
         });

     }
   function addNewStaff()
          {
       var code=198;

      
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code},
                success: function(response) 
               { 
               spinner.style.display='none';
               document.getElementById("show_record").innerHTML=response;
               }
         });

     }

     
function collegeByDepartment3(College) {

var code = '304';
$.ajax({
    url: 'action.php',
    data: {
        College: College,
        code: code
    },
    type: 'POST',
    success: function(data) {
        // console.log(data);
        if (data != "") {

            $("#Department3").html("");
            $("#Department3").html(data);
        }
    }
});

}

function fetchcourse3() {
var College = document.getElementById('College3').value;
var department = document.getElementById('Department3').value;
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
            console.log(data);
            $("#Course3").html("");
            $("#Course3").html(data);
        }
    }
});
}



function addEmployee()
	{
		var code=199;
       var loginId=document.getElementById('loginId').value;
       var Name=document.getElementById('Name').value;
       var designation=document.getElementById('designation').value;
       var College3=document.getElementById('College3').value;
       var Department3=document.getElementById('Department3').value;
       var Dob=document.getElementById('Dob').value;
       var Gender=document.getElementById('Gender').value;
       var FatherName=document.getElementById('FatherName').value;
       var Conatct=document.getElementById('Conatct').value;
       var Mobile=document.getElementById('Mobile').value;
       var Email=document.getElementById('Email').value;
       var Doj=document.getElementById('Doj').value;
       var category=document.getElementById('category').value;
       var Doj=document.getElementById('Doj').value;
       var bloodGroup=document.getElementById('bloodGroup').value;
       var Permanent=document.getElementById('Permanent').value;
       var Correspondance=document.getElementById('Correspondance').value;
       var shift=document.getElementById('shift').value;
       if (shift!='' && bloodGroup && loginId!='' && Name!='' && designation!='' && College3!='' && Department3!='' && Dob!='' && Gender!='' && FatherName!='' && Conatct!='' && Mobile!='' && Email!='' && Doj!='' && category!='' && Doj!='' && Permanent!='' && Correspondance!='')
       {
       var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code,loginId:loginId,Name:Name,designation:designation,College3:College3,Department3:Department3,
                  Dob:Dob,Gender:Gender,FatherName:FatherName,Conatct:Conatct,Mobile:Mobile,Email:Email,Doj:Doj,
                  category:category,Permanent:Permanent,Correspondance:Correspondance,shift:shift,bloodGroup:bloodGroup},
                success: function(response) 
               { 
                  if(response==1)
               {
            
                  console.log(response);
               spinner.style.display='none';
                SuccessToast('Successfully Added');
                addEmpInLms(loginId,category);
                addCollegePermissionsAccordingToCollegeAdd(loginId);
      document.getElementById('loginId').value="";
       document.getElementById('Name').value="";
       document.getElementById('designation').value="";
       document.getElementById('College3').value="";
       document.getElementById('Department3').value="";
      
       document.getElementById('Dob').value="";
       document.getElementById('bloodGroup').value="";
      
       document.getElementById('Gender').value="";
       document.getElementById('FatherName').value="";
       document.getElementById('Conatct').value="";
       document.getElementById('Mobile').value="";
       document.getElementById('Email').value="";
       document.getElementById('Doj').value="";
       document.getElementById('category').value="";
       document.getElementById('Doj').value="";
       document.getElementById('Permanent').value="";
       document.getElementById('Correspondance').value="";
       document.getElementById('shift').value="";
                   
      }
      else{
         ErrorToast('Try after some time','bg-warning');
      }
               }
         });
	}
   else
   {
      ErrorToast('All Inputs Required','bg-warning');
   }
}



function printEmpRecordPdf(id) {
   var code=1;
        if (id!='') 
         {  
          window.open("print-employee-record.php?code="+code+"&id="+id,'_blank');
         }
         else
         {
            alert("Select ");
         }
      
}
function printEmpIDCardNew(id) {
   var code=1;
        if (id!='') 
         {  
         //  window.location.href="printSmartCardEmp.php?code="+code+"&id="+id,'_blank';
         //  window.open("printSmartCardEmp.php?code="+code+"&id="+id,'_blank');
          window.open("newidcard.php?code="+code+"&id="+id,'_blank');
         }
         else
         {
            alert("Select ");
         }
      
}


function printfourthCard(id) {
   var code=3;
        if (id!='') 
         {  
         //  window.location.href="printSmartCardEmp.php?code="+code+"&id="+id,'_blank';
          window.open("print_id_card_pass.php?code="+code+"&id_array="+id,'_blank');
         }
         else
         {
            alert("Select ");
         }
      
}

function copyToClipboard(text) {
    const el = document.createElement('textarea');
    el.value = text;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
   //  alert('Password copied to clipboard');
}

function showErpRole(id) {
var ApplicationType = document.getElementById('ApplicationType').value;
// alert(id);
var code = '277';
$.ajax({
    url: 'action_g.php',
    data: {
        ApplicationType: ApplicationType,empid:id,
        code: code
    },
    type: 'POST',
    success: function(data) {
      // console.log(data);
      document.getElementById('onchnageErpRoleshow').innerHTML=data;
    }
});

}


function deleteRoleAll(empid,ApplicationName) 
{
   var a=confirm('Are you sure you want to delete role of  '+empid+' Application Name '+ApplicationName);
   // alert(id);
   if (a==true) {
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 278;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: {
            code: code,empid:empid,ApplicationName:ApplicationName
         },
         success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               update_emp_record(empid);
               SuccessToast('Role Deleted Successfully');
               
            }
            else
            {
               
            }
         }
      });
   }
 
}
function resetPassword(empid,ApplicationName) 
{
   var a=confirm('Are you sure you want to Reset Password of  '+empid+' Application Name '+ApplicationName);
   // alert(id);
   if (a==true) {
      var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
      var code = 279;
      $.ajax({
         url: 'action_g.php',
         type: 'POST',
         data: {
            code: code,empid:empid,ApplicationName:ApplicationName
         },
         success: function(response) {
            // console.log(response);
            spinner.style.display = 'none';
            if(response==1)
            {
               update_emp_record(empid);
               SuccessToast('Password Reset Successfully  Reset');
               
            }
            else
            {
               
            }
         }
      });
   }
 
}







// profile function

function addExperience(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
           
                SuccessToast('Successfully Added');
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('size must be less than 500kb', 'bg-warning');

            } else if (response == 3) {
                ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');

            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function addAcademic(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    // alert(form);
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
          
                SuccessToast('Successfully Added');

            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('size must be less than 500kb', 'bg-warning');

            } else if (response == 3) {
                ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');

            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function uploadPanCard(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    var loginId = formData.get("IDEmployee"); // Corrected syntax
   //  alert(loginId);
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
               update_emp_record(loginId);
                SuccessToast('Successfully Uploaded');

             
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('Please Upload size must be less than 500kb', 'bg-warning');
                document.getElementById("panerror").innerHTML = 'Please Upload size must be less than 500kb';

            } else if (response == 3) {
                ErrorToast('Please Upload must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                document.getElementById("panerror").innerHTML = 'Please Upload must be in jpg/jpeg/png/pdf format';

            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function uploadAdharCard(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    var loginId = formData.get("IDEmployee"); // Corrected syntax
    // alert(form);
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
               update_emp_record(loginId);
                SuccessToast('Successfully Uploaded');
               
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('size must be less than 500kb', 'bg-warning');
                document.getElementById("adharerror").innerHTML = 'Please Upload size must be less than 500kb';
               
            } else if (response == 3) {
                ErrorToast('Document must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                
                document.getElementById("adharerror").innerHTML = 'Please Upload must be in jpg/jpeg/png/pdf format';
            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}
function viewPHDDocument(id) {
    var code = 57.1;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}
function viewAddtionalDocument(id) {
    var code = 57.2;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}
function dlt_data(id,emp_id) {
    var code = '435.1';
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var ID = id;
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: ID,emp_id:emp_id,
                code: code
            },
            type: 'POST',
            success: function(data) {
                console.log(data);
                spinner.style.display = 'none';
                SuccessToast('Successfully Deleted');
                update_emp_record(emp_id);
               
            }
        });
    } else {}
}
function deletePHD(id,emp_id) {
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '432.2';
        var academicID = id;
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: academicID,emp_id:emp_id,
                code: code
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                // console.log(data);
                SuccessToast('Successfully Deleted');
                update_emp_record(emp_id);

            }
        });
    } else {

    }
}
function deleteAddtional(id,emp_id) {
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var code = '432.3';
        var academicID = id;
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: academicID,emp_id:emp_id,
                code: code
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
               //  console.log(data);
                SuccessToast('Successfully Deleted');
                update_emp_record(emp_id);

            }
        });
    } else {

    }
}
function uploadImage(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    var loginId = formData.get("IDEmployee"); // Corrected syntax
    // alert(form);
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
               update_emp_record(loginId);
                SuccessToast('Successfully Uploaded');
                $('#uploadPasspoerImage').modal('hide');
               
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('Please Upload Image size must be less than 500kb', 'bg-warning');
                document.getElementById("imgerror").innerHTML = 'Please Upload Image size must be less than 500kb';
                document.getElementById("imgerror1").innerHTML = 'Please Upload Image size must be less than 500kb';

            } else if (response == 3) {
                ErrorToast('Please Upload must be in jpg/jpeg/png format. ', 'bg-warning');
                document.getElementById("imgerror").innerHTML = 'Please Upload Image must be in jpg/jpeg/png format';
                document.getElementById("imgerror1").innerHTML = 'Please Upload Image must be in jpg/jpeg/png format';
            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function uploadPassBook(form) {
    var spinner = document.getElementById("ajax-loader");
    spinner.style.display = 'block';
    var formData = new FormData(form);
    var loginId = formData.get("IDEmployee"); // Corrected syntax
    // alert(form);
    $.ajax({
        url: 'action_a.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            if (response == 1) {
               update_emp_record(loginId);
                SuccessToast('Successfully Uploaded');

             
            } else if (response === 'Could not connect to 10.0.10.11') {
                ErrorToast('FTP Server Off', 'bg-warning');
            } else if (response == 2) {
                ErrorToast('Please Upload size must be less than 500kb', 'bg-warning');
                document.getElementById("bnkerror").innerHTML = 'Please Upload size must be less than 500kb';

            } else if (response == 3) {
                ErrorToast('Please Upload must be in jpg/jpeg/png/pdf format. ', 'bg-warning');
                document.getElementById("bnkerror").innerHTML = 'Please Upload must be in jpg/jpeg/png/pdf format';
            } else {
                ErrorToast('All inputs required', 'bg-danger');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            ErrorToast('Submission failed: ' + error);
        }
    });
}

function viewLetters(id) {
    var code = 58.1;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data-letters").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}


function viewAcademicDocumentExp(id) {
    var code = 58;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data-exp").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}

function view_uploaded_document(id, documentP) {
    var code = 59;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("documentData").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code + "&document=" + documentP, true);
    xmlhttp.send();
}

function academic_detail() {
    var x = document.getElementById("marks_type");
    var y = document.getElementById("qualification");
    var z = document.getElementById("test_section");

    if (x.style.display === "none") {
        x.style.display = "block";
        document.getElementById("add_button").innerHTML = "Remove";
    } else {
        x.style.display = "none";
        y.style.display = "none";

        document.getElementById("add_button").innerHTML = "Academics";
        var radio = document.querySelector('input[type=radio][name=marks_type]:checked');
        radio.checked = false;
    }
    if (z) {
        z.style.display = "none";
    }
}

function marks() {
    var x = document.getElementById("qualification");
    x.style.display = "block";

    document.getElementById("cgpa_value").readOnly = true;
    document.getElementById("cgpa_value").value = '';
    document.getElementById("total_marks").readOnly = false;
    document.getElementById("obtained_marks").readOnly = false;
    document.getElementById("total_marks").required = true;
    document.getElementById("obtained_marks").required = true;
}

function cgpa_detail() {
    var x = document.getElementById("qualification");
    x.style.display = "block";
    document.getElementById("cgpa_value").readOnly = false;
    document.getElementById("total_marks").readOnly = true;
    document.getElementById("total_marks").value = '';
    document.getElementById("obtained_marks").readOnly = true;
    document.getElementById("obtained_marks").value = '';
    document.getElementById("cgpa_value").required = true;
    document.getElementById('percent').value = '';
}

function calculate_percentage() {
    var val1 = document.getElementById('obtained_marks').value;
    var val2 = document.getElementById('total_marks').value;
    if (val1 != '' && val2 != '' && val1 != '0' && val2 != '0') {
        if (val1 > val2) {
            alert('obtained marks can not be greater than total marks');
            document.getElementById('obtained_marks').value = '';
            document.getElementById('total_marks').value = '';
            document.getElementById('percent').value = '';
        } else {
            var result = (val1 / val2) * 100;
            var percent = result.toFixed(2);
            document.getElementById('percent').value = percent;
        }
    }
}

function viewAcademicDocument(id) {
    var code = 57;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}

function viewTestDocument(id) {
    var code = 1;
    //alert(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("data").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "get-action.php?id=" + id + "&code=" + code, true);
    xmlhttp.send();
}

function dlt_data_letters(id)
{
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var loginId = document.getElementById("loginId").value;
        var code = '432.6';
        var academicID = id;
        //alert(academicID);
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: academicID,
                code: code
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                // console.log(data);
                SuccessToast('Successfully Deleted');
                update_emp_record(loginId);
                // if (data == 1) {
                //     showProfileData();
                // } 
                //  else {
                //     ErrorToast('try again','bg-danger');
                // }

            }
        });
    } else {

    }

}

function deleteAcademics(id) {
    var a = confirm('Are you sure you want to delete');
    if (a == true) {
        var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
        var loginId = document.getElementById("loginId").value;
        var code = '432';
        var academicID = id;
        //alert(academicID);
        $.ajax({
            url: 'action_g.php',
            data: {
                ID: academicID,
                code: code
            },
            type: 'POST',
            success: function(data) {
                spinner.style.display = 'none';
                // console.log(data);
                SuccessToast('Successfully Deleted');
                update_emp_record(loginId);
                // if (data == 1) {
                //     showProfileData();
                // } 
                //  else {
                //     ErrorToast('try again','bg-danger');
                // }

            }
        });
    } else {

    }
}


</script>
   
<script>
function toggleLeavingDate(selectElement) {
    var leavingDateField = document.getElementById('leavingDateField');
    var leavingDateInput = document.getElementById('leavingDate');

    if (selectElement.value == '0') { // DeActive
        leavingDateField.style.display = 'block';
        leavingDateInput.setAttribute('required', 'required'); // Make field required
    } else {
        leavingDateField.style.display = 'none';
        leavingDateInput.removeAttribute('required'); // Remove required
    }
}

</script>
<!-- Small modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="image_view">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary"></button> -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="promotionMOdal" tabindex="-1" role="dialog" aria-labelledby="promotionMOdalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="promotionMOdalLabel">Promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="promotionData">
               
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary"></button> -->
            </div>
        </div>
    </div>
</div>



<!-- <div class="modal fade" id="UploadImageDocument" tabindex="-1" role="dialog" aria-labelledby="UploadImageDocumentTitle" aria-hidden="true">
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
</div> -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Academic Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-default-Letters">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Letters</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data-letters">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-default-Experience">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Experience Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data-exp">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">View  Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  id='update_data'>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="UpdateDesignationModalCenter2" tabindex="-1" role="dialog" aria-labelledby="UpdateDesignationModalCenter2" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">edit Designaion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  id='update_data_designation'>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="UploadImageDocument">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="documentData">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="NewDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="NewDepartmentModal" aria-hidden="true" >
   <div class="modal-dialog " role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
           <h5 class="modal-title" id="NewDepartmentModal">New Department</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
  
     <div class="row">
        <div class="col-lg-1"></div>
      <div class="col-lg-10"> 
      	    <label>College</label>
      	  <select  name="College" id='CollegeIDN'  class="form-control" required="">
                <option value=''>Select Course</option>
                  <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         { 
     $college = $row1['CollegeName']; 
     $CollegeID = $row1['CollegeID'];
    ?>
<option  value="<?=$CollegeID;?>"><?= $college;?>(<?=$CollegeID;?>)</option>
<?php    }

?>
              </select> 
    <label>Designation</label>
    <input type="text" name="table_search" id="department" class="form-control" required>
    <br>
    <input type="submit"  onclick="save();"  value="save" class="btn btn-secondary"> 

    </div>
    <div class="col-lg-1"></div>

    </div>
<br>
   
     
     
                
      </div>
   </div>
</div>
<div class="modal fade" id="NewDesignationModal" tabindex="-1" role="dialog" aria-labelledby="NewDesignationModal" aria-hidden="true" >
   <div class="modal-dialog  " role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
           <h5 class="modal-title" id="NewDesignationModal">New Designation</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
     <div class="row">
        <div class="col-lg-1"></div>
      <div class="col-lg-10"> 
  
    <label>Designation</label>
    <input type="text" name="table_search" id="Designation" class="form-control" required>
    <br>
    <input type="submit"  onclick="save_designation();"  value="save" class="btn btn-secondary"> 

    </div>
    <div class="col-lg-1"></div>

    </div>
<br>
   
     
     
                
      </div>
   </div>
</div>

<button id="scrollToggle" onclick="scrollable();" class="unique-btn">Scroll Down</button>

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
 <div class="card">
          <div class="card-header">
        <h3 class="card-title">QUALIFICATION</h3>
           <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" onclick="show_qualification_wise();">
              <i class="fas fa-plus"></i>
               </button>
           </div>
             </div>
       <div class="card-body p-0">
         <ul class="nav nav-pills flex-column" id="qualification_wise_show">
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
<?php if($role_id==2)
{?>
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
<?php }?>

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
     
      <button type="button" onclick="exportEmployee();" class="btn btn-success btn-sm ">
        <i class="fa fa-file-excel"></i>
      </button>
      <?php if($role_id==2){?>
      <button type="button" onclick="manageDepartment();" class="btn btn-success btn-sm ">
      Manage Department
      </button>
        <?php }?>
      <button type="button" onclick="manageDesignation();" class="btn btn-success btn-sm ">
      Manage Designation
      </button>
    
      <button type="button" onclick="addNewStaff();" class="btn btn-success btn-sm ">
     Add New Staff
      </button>
      <button type="button" onclick="SyncNewStaff();" class="btn btn-success btn-sm ">
     Sync to SPOC
      </button>

      <span style="float:right;">
      <button class="btn btn-sm ">
         <input type="search" onblur="search_all_employee_emp_name(this.value);" class="form-control form-control-sm" name="emp_name" id="emp_name" placeholder="Search here">
      </button>
            <button type="button" onclick="search_all_employee();" class="btn btn-success btn-sm">
              Search
            </button>
      </span>
      <input type="hidden" id="CollegeID_Set">
      <input type="hidden" id="CollegeID_SetOnly">

      <!-- <div class="card-tools">
        <div class="input-group ">
          <input type="search" onblur="search_all_employee_emp_name(this.value);" class="form-control form-control-sm" name="emp_name" id="emp_name" placeholder="Search here">
          <div class="input-group-append">
            <button type="button" onclick="search_all_employee();" class="btn btn-success btn-xs">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </div> -->
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