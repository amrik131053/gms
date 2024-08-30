<?php 
  include "header.php";   
?>
 <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

<script src="html5-qrcode.min.js"></script>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-sm-3 col-md-12"> 
         <div class="card card-info">
            <div class="card-header">
               <div class="col-lg-2">
                  <div class="input-group input-group-sm">
                     <button class="btn  btn-outline-light btn-sm"  data-toggle="modal" onclick="scanArticle()" data-target="#scan_article_modal" type="button" id="button-addon2">
                     <i class="fa fa-qrcode">gg</i>
                     </button>
                     <input type="text" class="form-control" id='article_No' placeholder="Article No..." aria-describedby="button-addon2">
                     <button class="btn  btn-info btn-sm" type="button" id="button-addon2"  onclick="articleTask(0)">
                     <i class="fa fa-search"></i>
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body table-responsive" id="stock_add">
               <!-- <table class="table table-head-fixed text-nowrap table-bordered" id="example">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Article Name</th>
                        <th>User</th>
                        <th>Print</th>
                     </tr>
                  </thead>
                  <tbody id="search_record"> -->
                    <!-- <?php 
                    $building_num=0;
                    $building="SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode inner join stock_description sd on sd.reference_no=s.reference_no and sd.IDNO=s.IDNo where s.Updated_By='$EmployeeID' and s.Status='2' order by sd.ID desc ";
                    $building_run=mysqli_query($conn,$building);
                    while ($building_row=mysqli_fetch_array($building_run)) 
                    {
                      $building_num=$building_num+1;
                      ?>
                      <tr>
                        <td><?=$building_row['IDNo'];?></td>
                        <td><?=$building_row['ArticleName'];?></td>
                        <td>
                        <?php
                          $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo=".$building_row['Corrent_owner'];
                          $q1 = sqlsrv_query($conntest, $sql1);
                          while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
                          {
                            echo $name = $row['Name'];
                          } 
                        ?>
                        </td>
                        <td>
                          <form action="report-print.php" method="post" target="_blank">
                            <input type="hidden" name="IdNo" value="<?=$building_row['reference_no'];?>">
                            <button class='btn border-0 shadow-none' >
                              <i class="fa fa-print fa-lg"  type='submit'  style="color:blue;"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                      <?php 
                    }
                  ?> -->
                  <!-- </tbody>
               </table> -->
            </div>
         </div>
      </div>
   </div>
</section>  


<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Article</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="update_modal_data">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg" id="returnModal_data" role="document">
    
  </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Inserted Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="View_record_qr">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">View  Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_record_only">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="scan_article_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLabel">Update </h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
             <div id="" style="text-align: center;">
               <h5>QR Scan</h5>  
    
    <video id="preview" width="100%" height="300px"></video>
     
             </div>    
      </div>
   </div>
</div> 
<script type="text/javascript">
    function floorLocation(id)
      {  var floor='';
         buildingRoom(id,floor);
         var code='81';
         $.ajax({
         url:'action.php',
         data:{code:code,building:id},
         type:'POST',
         success:function(data){
         if(data != "")
         {
            console.log(data);
         $("#hostelFloorID").html("");
         $("#hostelFloorID").html(data);
         }
         }
         });
      } 
       function buildingRoom(id,floor)
      {
         if (id==0) 
         {
            id=document.getElementById("hostel_id").value;
         }
         var code='82';
         $.ajax({
         url:'action.php',
         data:{code:code,building:id,floor:floor},
         type:'POST',
         success:function(data){
         if(data != "")
         {
         $("#hostelRoomID").html("");
         $("#hostelRoomID").html(data);
         }
         }
         });
      }
  function re_assign(id)
  {
    var code=173;
    var current_owner= document.getElementById("Employee_ID").value;
    // alert(current_owner);
    $.ajax(
    {
      url:"action.php ",
      type:"POST",
      data:
      {
        code:code,articleID:id,current_owner:current_owner
      },
      success:function(response) 
      {
        if (response==1) 
        {
            articleTask(id);
        }
        if (response==0) 
        {
          ErrorToast(current_owner+' is not a valid Employee ID.','bg-danger');
        }
      }
    });
  }
  function emp_detail_verify(id)
  {
    var code=51;
    $.ajax(
     {
        url:"action.php ",
        type:"POST",
        data:
        {
           code:code,id:id
        },
        success:function(response) 
        {  
          document.getElementById("emp_detail_status_").innerHTML =response;
        }
     });
  }
  function empDetail()
  {
    var code=51;
    var id=document.getElementById("Employee_ID").value;
    // alert(id);
    $.ajax(
     {
        url:"action.php ",
        type:"POST",
        data:
        {
           code:code,id:id
        },
        success:function(response) 
        {  
          document.getElementById("emp_detail_status_").innerHTML =response;
        }
     });
  }
  function updateModalFunction(id,page) 
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("update_modal_data").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET", "get_action.php?id=" + id+"&page=" + page+"&code="+9, true);
    xmlhttp.send();
  }

 
  function scanArticle() 
  {
    alert("sdfs");
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod:2, mirror: false });
    scanner.addListener('scan', function (content) 
    {
      $('#scan_article_modal').modal('hide');
      articleTask(content);
    });
    Instascan.Camera.getCameras().then(function (cameras) 
    {
      if (cameras.length > 0) 
      {
        scanner.start(cameras[1]);
      } 
      else 
      {
        console.error('No cameras found.');
      }
    }).catch(function (e) 
    {
      console.error(e);
    });
    }

  function articleTask(content)
  {
    if (content==0) 
    {
      content=document.getElementById('article_No').value;
    }
    var code=160; 
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            dataType: "json",
            data:
            {
               code:code,articleID:content  
            },
            success:function(response) 
            {
              var l=response.length;
               if(l>0)
               {
                  var flag=response[0]["flag"];
                  var status=response[0]["status"];
               }
               // console.log(status);
               // alert(flag);
               if(status==0)
               {
                update(content,'update-stock.php');
               }
               if(status==1)
               {
                assign(content);
               }
               if(status==2)
               {
                searchReturn(content);
               }
               if (flag==1) 
               {
                  ErrorToast("You don't have permission for this article. Scan other article.",'bg-warning');
               }
               // document.getElementById("stock_add").innerHTML =status;
            },
            error:function()
            {
               alert("error");
            }
         });

    // assign(content);
        // searchReturn(content);
    // update(content);
  }
  function update(content,page) 
  {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET", "get_action.php?id=" + content+"&page=" + page+"&code="+9, true);
    xmlhttp.send();
  }
    
      function assign(content)
      {
        // alert(content);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
          }
        }
        xmlhttp.open("GET", "get_action.php?id=" + content+"&code="+30, true);
        xmlhttp.send();  
      }
       function locationOwner(roomNo)
  {
        document.getElementById('lcm_id').value='';
    
    var code=168;
    var floor = document.getElementById("floor").value;
    var building = document.getElementById("spotBuilding").value;
    // alert(floor);
    $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,roomNo:roomNo,floor:floor,building:building
            },
            success:function(response) 
            {
            // alert(response);
              if (response.includes(",")) 
              {

              var text=response.split(",")
               document.getElementById("Employee_ID").value =text[0];
               document.getElementById("lcm_id").value =text[1];
               empDetail();
              }
            },
            error:function()
            {
               alert("error");
            }
         });

  }
function floorSelect(building)
      {
            // alert(building);
        document.getElementById('lcm_id').value='';
                      $("#roomSelectList").html("");
                      $("#floor").html("");
         
         var code='91';
           $.ajax({
             url:'action.php',
             data:{hostel:building,code:code},
             type:'POST',
             success:function(data){
                 if(data != "")
                 {
                     $("#floor").html("");
                     $("#floor").html(data);
                 }
             }
           });
        }
        function roomSelect(floor)
         {
        document.getElementById('lcm_id').value='';
          $("#roomSelectList").html("");


         var spotBuilding=document.getElementById("spotBuilding").value;
         var code='71';
         $.ajax({
              url:'action.php',
              data:{floor:floor,code:code,hostel:spotBuilding},
              type:'POST',
              success:function(data){
                  if(data != "")
                  {
                      $("#roomSelectList").html("");
                      $("#roomSelectList").html(data);
                  }
              }
            });
         }

function reAssignModal(id)
{

         var code=172;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,articleID:id
            },
            success:function(response) 
            {
               document.getElementById("returnModal_data").innerHTML =response;
            },
            error:function()
            {
               alert("error");
            }
         });
}
function returnModal(id)
{

         var code=171;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,articleID:id
            },
            success:function(response) 
            {
               document.getElementById("returnModal_data").innerHTML =response;
            },
            error:function()
            {
               alert("error");
            }
         });
}
function searchReturn(id)   
      {
        
         var code=170;
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,articleID:id
            },
            success:function(response) 
            {
            
               document.getElementById("stock_add").innerHTML =response;
               $(document).ajaxStop(function()
               {
                  // window.location.reload();
               });
            },
            error:function()
            {
               alert("error");
            }
         });
      }


      function returnSubmit(id){
   var code=48;
   var returnRemark= document.getElementById("returnRemark").value;
   var workingStatus= document.getElementById("workingStatus").value;
   var locationID= document.getElementById("locationID").value;
    if (returnRemark!='' && workingStatus!='' && locationID!='') 
    {
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,article_id:id,returnRemark:returnRemark,workingStatus:workingStatus,locationID:locationID
            },
            success:function(response) 
            {  
               // console.log(response);
               location.reload(true);
            }
         });      
    }
    else
    {
      alert("Enter Remarks and Working Status");

    }





      }

     
          

      

function  assigned_one()
{
  var stockOwner=document.getElementById("Employee_ID").value;
  var code=169;
  $.ajax(
  {
    url:"action.php ",
    type:"POST",
    data:
    {
      code:code,emp:stockOwner
    },
    success:function(response) 
    {  
      if (response==1) 
      {  
        var id= document.getElementById("id").value;
        var locationID= document.getElementById("lcm_id").value;
        if(locationID!='' && id!='')
        {
          code=15;
          var UserID='';
          $.ajax(
          {
            url:"action.php ",
            type:"POST",
            data:
            {
              IDNo: id,code:code,iDNo_assing:locationID,UserID:UserID,stockOwner:stockOwner
            },
            success:function(response) 
            {
              document.getElementById("stock_add").innerHTML =response;
              window.location.reload();
            },
            error:function()
            {
              alert("error");
            }
          });
        } 
        else
        {
          alert('invalid Selection');
        }
      }
      else
      {
        ErrorToast(stockOwner+' is not a valid Employee ID.','bg-danger');
      }
    }
  }); 
} 

</script>
    <?php include "footer.php";

     ?>