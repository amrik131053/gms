<?php 
  include "header.php";   
?>
<style>

#myDiv {
  display: none; /* Initially hidden */
  padding: 20px;
  
}
</style>

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
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
        </div>
        <div class="row">

            <div class="col-lg-12 col-md-4 col-sm-12">
            <div class=" card-header">
           Stock Management
            <span style="float:right;">
      <!-- <button class="btn btn-xs ">
         <input type="search"  class="form-control form-control-sm" name="rollNo" id="rollNo" placeholder="Emp ID">
      </button>
            <button type="button" onclick="addlmsRole();" class="btn btn-success btn-sm">
              Search
            </button> -->
            <button type="button" onclick="exportExcel()" class="btn btn-success btn-sm">

<i class="fa fa-file-excel">&nbsp;&nbsp;Download</i>

</button>
      </span>
</div>
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id='viewlistdiv'>
        ...
      </div>
      <div class="modal-footer">

       
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>       




                <div class="card-body card">
                <?php 
                              
                              if ($code_access!='000') 
                              { 
                                 ?>
                    <div class="btn-group w-100 mb-2">
                    
          
                        <a class="btn " id="btn1" style="background-color:#223260; color: white; border: 1px solid;"
                            onclick="Addarticle();bg(this.id);"> Manage Article </a>


                        <a class="btn " id="btn2" style="background-color:#223260; color: white; border: 1px solid;"
                            onclick="AddStock();bg(this.id);"> Manage Stock
                       <!-- <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="Move();bg(this.id);"> Move </a> -->
                  <?php  } ?>
                        <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="Issue();bg(this.id);"> Issue Register </a> 
                        
                       <!--  <a class="btn " id="btn5" style="background-color:#223260; color: white; border: 1px solid;"
                            onclick="Update();bg(this.id);"> Update </a>
                            
                        <a class="btn " id="btn8" style="background-color:#223260; color: white; border: 1px solid;"
                            onclick="addRoleLMS();bg(this.id);"> Assign Role </a>
                            <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="reports();bg(this.id);">Reports</a>  -->

                              
                            
                    </div>
                        <?php 
                                                             if ($code_access=='000') 
                             { 
                                ?>
                              

                                
                        <?php }?>

                    <div id="table_load">
                   
                       

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

</section>
  <script>
                               $( window ).on("load", function() {
                                 Issue();
                                  $('#btn4').toggleClass("bg-success");
});
                                </script>
<p id="ajax-loader"></p>


<script type="text/javascript">
function toggleDiv() {
    // alert(hhjk);
    var div = document.getElementById("myDiv");
    if (div.style.display === "none") {
      div.style.display = "block";
    } else {
      div.style.display = "none";
    }
  }

function return_stock(id,stockid)
{


 var spinner = document.getElementById('ajax-loader');

           var code=26.5;
           $.ajax({
              url:'action_j.php',
              type:'POST',
              data:{
                 flag:code,id:id,stockid:stockid
              },
              success: function(response) 
              {
                // console.log(response);
                   spinner.style.display = 'none';

            SuccessToast('Successfully Submit');
              
//Issue();
              }
           });


}

function exportExcel() {
    var exportCode = 84.1;
 
        window.open("export.php?exportCode=" + exportCode, '_blank');
}

$(window).on('load', function() {
    $('#btn6').toggleClass("bg-success");
})

function format() {
    window.location.href = 'http://gurukashiuniversity.co.in/gkuadmin/formats/studyscheme.csv';
}

function bg(id) {
    $('.btn').removeClass("bg-success");
    $('#' + id).toggleClass("bg-success");
}

function emc1_show() {
               var x = document.getElementById("lect_div");
                 var y = document.getElementById("lect_div1");
                 var z = document.getElementById("after_data");
               x.style.display = "block";
                y.style.display = "none";

               
               
               }
                      function emc1_hide() {
                      
               var x = document.getElementById("lect_div");
                var y = document.getElementById("lect_div1");
                 var z = document.getElementById("after_data");

               x.style.display = "none";
                y.style.display = "block";
               
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
                  
                 document.getElementById("emp-data").innerHTML=response;
                 document.getElementById("empdata").value=response;
                 document.getElementById("empName").value=response;

              }
           });
}

function bus(id)

{
    // alert ('chibi bus '+id);
    var code=34;
           $.ajax({
              url:'action_j.php',
              type:'POST',
              data:{
                 flag:code,id:id
              },
              success: function(response) 
              {
                  
                 document.getElementById("mobileData").innerHTML=response;
               

              }
           });
}

function Issue11Stock()
{

var empID = document.getElementById('empID').value;
var empName = document.getElementById('empName').value;
var mobileData = document.getElementById('mobileData').value;
var nameEmp = document.getElementById('name').value;
var remarks= document.getElementById('remarks').value;
var name = document.getElementById('emp-data').innerHTML;
var code=26.2;
alert(name);
if(empID!='' && empName!='' && mobileData!='')
{

    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            empID:empID,
            flag:code,
            empName:empName,
            mobileData:mobileData,
            nameEmp:name,
            remarks:remarks,
            name:emp-data
        },
        success: function(response) {
           // console.log(response);
            spinner.style.display = 'none';
            SuccessToast('Successfully Submit');
            Issue();

        }
    });
}
else
{
    ErrorToast('Try Again', 'bg-danger');
}

}



function viewlist(id,stock) { 


 var code = 26.4;
      
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,id:id,stock:stock
        },
        success: function(response) {
            spinner.style.display = 'none';
// console.log(response);
            document.getElementById("viewlistdiv").innerHTML = response;

            
        }
    });


}
 

function chnageName(id) { 
    var code = 26.1;
        var ArticleName = document.getElementById('arname'+id).value;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,id:id,ArticleName:ArticleName
        },
        success: function(response) {
            spinner.style.display = 'none';

            document.getElementById("table_load").innerHTML = response;

            show_article();
        }
    });
}


function Addarticle() { 
    var code = 25.3;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code
        },
        success: function(response) {
            spinner.style.display = 'none';

            document.getElementById("table_load").innerHTML = response;

            show_article();
        }
    });
}

function Issue() { 
    var code = 26;
var code_access ='<?php echo $code_access; ?>';

    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,code_access:code_access
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
            Issuedstock();

                    }
    });
}

function Issuedstock() { 
    var code = 26.3;


    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            // console.log(response);
            document.getElementById("issuedstocklist").innerHTML = response;


                    }
    });
}

// document.querySelector('form').addEventListener('submit', function(e) {
//     e.preventDefault();
//     IssueStock(this); 
// });

function IssueStock(form) {
    var empID = form.empID.value.trim();
    var empdata=form.empdata.value.trim();
    var empName = form.empName.value.trim();
    var mobileData = form.mobileData.value.trim();
    var remarks = form.remarks.value.trim();
    var fileInput = form.fileatt;
    var nameElement = document.getElementById("nameElementId");
    var name = nameElement ? nameElement.innerText.trim() : "";
    if (empID === "") {
        ErrorToast('Please Enter empID.', 'bg-warning');
        return;
    }
    
    if (mobileData === "") {
        ErrorToast('Please Enter article discription.', 'bg-warning');
        return;
    }
    if (remarks === "") {
        ErrorToast('Please Enter remarks.', 'bg-warning');
        return;
    }
    // if (fileInput.files.length === 0) {
    //     ErrorToast('Please choose a file.', 'bg-warning');
    //     return;
    // }
    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
         console.log(response);
            // if (response == '1') {
                Issue();
                SuccessToast('Successfully Uploaded');
            //     form.empName.value = "";
            //     form.mobileData.value = "";
            //     form.remarks.value = "";
            //     form.fileatt.value = null; // resets file input
            // } else if (response.includes('10.0.10.11')) {
            //     ErrorToast('FTP Server Off', 'bg-warning');
            // } else {
            //     ErrorToast('Unexpected response: ' + response, 'bg-danger');
            // }
        },
        error: function(xhr, status, error) {
            console.log("AJAX error:", error);
            ErrorToast('AJAX request failed.', 'bg-danger');
        }
    });
}
function transferStock(form) {
    var empID = form.empID.value.trim();
    var empdata=form.empdata.value.trim();
    var empName = form.empName.value.trim();
    var mobileData = form.mobileData.value.trim();
    var remarks = form.remarks.value.trim();
    var fileInput = form.fileatt;
    var nameElement = document.getElementById("nameElementId");
    var name = nameElement ? nameElement.innerText.trim() : "";
    if (empID === "") {
        ErrorToast('Please Enter empID.', 'bg-warning');
        return;
    }
    
    if (mobileData === "") {
        ErrorToast('Please Enter article discription.', 'bg-warning');
        return;
    }
    if (remarks === "") {
        ErrorToast('Please Enter remarks.', 'bg-warning');
        return;
    }
    // if (fileInput.files.length === 0) {
    //     ErrorToast('Please choose a file.', 'bg-warning');
    //     return;
    // }
    var formData = new FormData(form);
    $.ajax({
        url: form.action,
        type: form.method,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
        //  console.log(response);
            // if (response == '1') {
                SuccessToast('Successfully Uploaded');
                form.empName.value = "";
                form.mobileData.value = "";
                form.remarks.value = "";
            //     form.fileatt.value = null; // resets file input
            // } else if (response.includes('10.0.10.11')) {
            //     ErrorToast('FTP Server Off', 'bg-warning');
            // } else {
            //     ErrorToast('Unexpected response: ' + response, 'bg-danger');
            // }
        },
        error: function(xhr, status, error) {
            console.log("AJAX error:", error);
            ErrorToast('AJAX request failed.', 'bg-danger');
        }
    });
}


function show_article() {

        var code = 25.5;
    $.ajax({
        url: 'action_j.php',
        data: {
            
            flag: code
        },
        type: 'POST',
        success: function(data) {
            if (data != "") {
                // console.log(data);
                $("#showarticle").html("");
                $("#showarticle").html(data);
            }
        }
    });

}
function updateStatus(id)
{

var status=document.getElementById('toggleForm'+id).value;
       
       //alert(value);  
   var code = 25.6;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag:code,id:id,status:status
        },
        success: function(response) {
            //console.log(response);
            spinner.style.display = 'none';
            show_article();
            //AddStock();
            
        }
    });
}
function suspend(id) {
     var r = confirm("Do you really want to Suspend ");
    if (r == true) {
    var code = 29;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,id:id
        },
        success: function(response) {
            console.log(response);
            SuccessToast('Successfully Suspended');
            spinner.style.display = 'none';
           show_stock();
        }
    });
}
}
function AddStock() { 
    var code = 25.7;
    var spinner = document.getElementById('ajax-loader');

    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
            
           show_stock();
        }
    });
}
function show_stock() {


    var code = 25.8;
    $.ajax({
        url: 'action_j.php',
        data: {
            
            flag: code
        },
        type: 'POST',
        success: function(data) {
            
                //console.log(data);
                $("#showstock").html("");
                $("#showstock").html(data);
            
        }
    });

}
function submitstock() { 
    
    var code = 25.9;
    
     var articlecode = document.getElementById('articlecode').value;
    //  var quantity = document.getElementById('quantity').value;
    var mobile_model = document.getElementById('mobile_model').value;
    var brand = document.getElementById('brand').value;
    var configuration = document.getElementById('configuration').value;
    var sim_number = document.getElementById('sim_number').value;

    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    // alert(submitstock);
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,
            articlecode:articlecode,
            mobile_model:mobile_model,
            brand:brand,
            configuration:configuration,
            sim_number:sim_number
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("table_load").innerHTML = response;
            AddStock();
          show_stock();

        }
    });
     
}


</script>

 <script>
function showdiv(value) {

// alert(value);
  if(value==2)
  {
    $('#showSIM').show();
     $('#showMobile').hide();
  }
  else
  {
    $('#showMobile').show();
    $('#showSIM').hide();
  }

function  forward_set_id(id)
{
 document.getElementById("Token_No").value=id;

}
function forward_task()
{
  var forward_remarks = document.getElementById("forward_remarks").value;
  var Token_No = document.getElementById("Token_No").value;
  var team_id = document.getElementById("forward_team_div").value;
  var other_id = document.getElementById("forward_other_div").value;
  var assignTo=team_id+other_id;
  var end_date = document.getElementById("forward_end_date").value;
 // var spinner=document.getElementById("ajax-loader");
 //   spinner.style.display='block';
           var code=13;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,assignTo:assignTo,end_date:end_date,Token_No:Token_No,forward_remarks:forward_remarks
              },
              success: function(response) 
              {
                  // spinner.style.display='none';
                // console.log(response);
                if (response==1) {
                  SuccessToast('Success');
                     $("#ForwardTaskModal").modal('hide');
                  my_task();
                }
                else if(response==2)
                {
                   ErrorToast('Already assign','bg-warning');
                }
                else
                {

                }
                 
              }
           });
}
      function task_submit_with_daily_report(id) 
     {
 var spinner=document.getElementById("ajax-loader");
  var change_status=document.getElementById(id+"_change_status1").value;
alert(id);
   spinner.style.display='block';
           var code=19;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,change_status:change_status,id:id
              },
              success: function(response) 
              {
                // console.log(response);
                  spinner.style.display='none';
                  show_task_after_chnage();
                  my_task();
                  task_timeline(id);

              }
           });
   } 
    function show_task_after_chnage() 
     {

           var code=20;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                 document.getElementById("task_show_after_onchange").innerHTML=response;
              }
           });
   }
function my_task()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=11;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  spinner.style.display='none';
                 document.getElementById("data_show").innerHTML=response;
              }
           });
}
function assign_task()
{
 
      var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=12;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
               {
                  spinner.style.display='none';
                 document.getElementById("data_show").innerHTML=response;
              }
           });
}
function task_timeline(Token_No)
{
 // alert(Token_No);
 var spinner=document.getElementById("ajax-loader");
   spinner.style.display='block';
           var code=14;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,Token_No:Token_No
              },
              success: function(response) 
              {
                  spinner.style.display='none';
             
                 document.getElementById("view_timeline_data").innerHTML=response;
              }
           });
}
function submit_marks(ID)
{
 // alert(Token_No);
  var Marks = document.getElementById("marks").value;
  var Remarks = document.getElementById("remarks").value;
  
           var code=15;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,ID:ID,Marks:Marks,Remarks:Remarks
              },
              success: function(response) 
              {
                  
                if (response==1) {
                  SuccessToast('Success');
                    $("#ViewTaskModal").modal('hide');
                  my_task();
                }
                else
                {
                 document.getElementById("view_timeline_data").innerHTML=response;
                }
              }
           });
}

window.onload = function() {
  my_task();
};
}
</script>
</br>
<div>




    <?php 


    include "footer.php";  ?>