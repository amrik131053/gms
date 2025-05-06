<?php 
  include "header.php";   
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
                                <script>
                               $( window ).on("load", function() {
                                 //Issue();
});
                                </script>

                                
                        <?php }?>

                    <div id="table_load">
                   
                       

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

</section>
<p id="ajax-loader"></p>


<script type="text/javascript">

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

function IssueStock()
{

var empID = document.getElementById('empID').value;
var empName = document.getElementById('empName').value;
var mobileData = document.getElementById('mobileData').value;

var name = document.getElementById('emp-data').innerHTML;
var code=26.2;
// alert(name);
if(empID!='' && empName!='' && mobileData!='')
{

    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            empid:empID,
            flag:code,
            empName:empName,
            mobileData:mobileData,
            name:name
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



function viewlist(id) { 


 var code = 26.4;
      
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_j.php',
        type: 'POST',
        data: {
            flag: code,id:id
        },
        success: function(response) {
            spinner.style.display = 'none';

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
            console.log(response);
            document.getElementById("issuedstocklist").innerHTML = response;


                    }
    });
}


function submitarticle() {
    var ArticleName = document.getElementById('ArticleName').value;
    var ArticleSpecification = document.getElementById('ArticleSpecification').value;
   

    if (ArticleName != '' ) {
        var code = 25.4;

        var spinner = document.getElementById('ajax-loader');
        spinner.style.display = 'block';
        $.ajax({
            url: 'action_j.php',
            type: 'POST',
            data: {
                flag:code,
                ArticleName:ArticleName,
                ArticleSpecification:ArticleSpecification,
                
            },
            success: function(response) {
//console.log(response);
                spinner.style.display = 'none';
                if (response == 1) {
                    SuccessToast('Successfully Submit');
                    Addarticle();
                     
                } else {
                    ErrorToast('Try Again', 'bg-danger');
                }
            }
        });
    } else {
        ErrorToast('Please Input All Required Filed', 'bg-warning');
    }



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
                console.log(data);
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


}
</script>
</br>
<div>




    <?php 


    include "footer.php";  ?>