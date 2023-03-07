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
          
               <input type="submit" name="" data-toggle="modal" onclick="bbb()" data-target="#qr_modal"  value="Assign" class="btn btn-primary">  
 <input type="submit" name="" data-toggle="modal" onclick="aaa()" data-target="#qr_modal_as"  value="Update" class="btn btn-primary"> 
 <input type="submit" name="" data-toggle="modal" onclick="ccc()" data-target="#qr_modal_return"  value="Return / Search" class="btn btn-danger"> 
               <div class="card-tools">
                     <div class="input-group " style="width: 200px;">
                        
                       <!--  <input type="text" name="table_search" id="Value_ID" class="form-control float-right" placeholder="Search"  >
                        <input type="submit"  onclick="search();"  value="Search" class="btn btn-secondary"> -->
                   
                     </div>

                  </div>
              </div>
              <!-- /.card-header -->      
            <div id="stock_add"></div>
              <!-- /.card-body -->
            </div>
        <div class="card-body table-responsive " style="height:700px;" id="tab_data">
                  <table class="table table-head-fixed text-nowrap table-bordered" id="example">
                     <thead>
                        <tr>
                        
                           <th>ID</th>
                           <!-- <th>Category Name</th> -->
                           <th>Article Name</th>
                           <th>User</th>
                           <!-- <th>CPU</th> -->
                          <!--  <th>Oprating System</th> -->
                           <!-- <th>Memory</th> -->
                           <!-- <th>Action</th> -->
                           <!-- <th>Action</th> -->
                           <th>Print</th>
                          
                        </tr>
                     </thead>
                     <tbody id="search_record">
                        <?php 
                           $building_num=0;
                           $building="SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode inner join stock_description sd on sd.reference_no=s.reference_no and sd.IDNO=s.IDNo where s.Updated_By='$EmployeeID' and s.Status='2' order by sd.ID desc ";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
                           $building_num=$building_num+1;
                           ?>

                        <tr>
                         
                           <td><?=$building_row['IDNo'];?></td>
                           <!-- <td><?=$building_row['CategoryName'];?></td> -->
                           <td><?=$building_row['ArticleName'];?></td>
                           <td>
                                <?php
                                $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo=".$building_row['Corrent_owner'];
                                $q1 = sqlsrv_query($conntest, $sql1);
            while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) {
            echo $name = $row['Name'];
            } 
                                    // $building_row['CPU'];
                                ?>
                              
                            </td>
                           <!-- <td><?=$building_row['OS'];?></td> -->
                           <!-- <td><?=$building_row['Memory'];?></td> -->
                          
                          <!--  <td>
                            <?php 
                           if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                            {
                              ?>
                                <a   onclick="view_record_qr(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModalCenter2" ><i class="fa fa-eye fa-lg"> </i></a>
                             <?php
                           }
                           else{


                           }  ?>
                           </td>
 -->                           <!-- <td>
                               <a   onclick="update_view_record_qr(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-edit fa-lg"> </i></a>
                           </td> -->
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
                                      ?>
                     </tbody>
                  </table>
               </div>
            <!-- /.card -->
          </div>
        
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


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

<div class="modal fade" id="qr_modal_as" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
    <hr>
    or
    <hr>
     <div class="row">
        <div class="col-lg-2"></div>
      <div class="col-lg-8"> <?php //if ($EmployeeID=='131053' || $EmployeeID=='121079' || $EmployeeID=='171091') {
          
       ?>
    <label>Article Number</label>
    <input type="text" name="table_search" id="Value_ID" class="form-control" required>
    <br>
    <input type="submit"  onclick="search();"  value="Search" class="btn btn-secondary"> 
   <?php //}?>
    </div>
    <div class="col-lg-2"></div>

    </div>
<br>
    <?php
    if ($EmployeeID==0) 
    {
      ?>
      <script type="text/javascript">
      function aaa() 
      {
      
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod:2, mirror: false });
      scanner.addListener('scan', function (content) {
       // alert(content);
        var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
$('#tab_data').hide();
 $('#qr_modal_as').each(function(){
                    $(this).modal('hide');
});
}
}
xmlhttp.open("GET", "get_action.php?id=" + content+"&code="+9, true);
xmlhttp.send();

});
      Instascan.Camera.getCameras().then(function (cameras) {
        
          scanner.start(cameras[2]);
        
      }).catch(function (e) {
        console.error(e);
      });
    }
    </script>
      <?php
    }
    else
    {
      ?>
      <script type="text/javascript">
      function aaa() 
      {
      
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod:2, mirror: false });
      scanner.addListener('scan', function (content) {
       // alert(content);
        var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
$('#tab_data').hide();
 $('#qr_modal_as').each(function(){
                    $(this).modal('hide');
});
}
}
xmlhttp.open("GET", "get_action.php?id=" + content+"&code="+9, true);
xmlhttp.send();

});
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[1]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    }
    </script>
      <?php
    }
    ?>

             </div>    
      </div>
   </div>
</div>




<div class="modal fade" id="qr_modal_return" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
            <video id="preview2" width="100%" height="300px"></video>
    <hr>
    or
    <hr>
     <div class="row">
        <div class="col-lg-2"></div>
      <div class="col-lg-8"> <?php //if ($EmployeeID=='131053' || $EmployeeID=='121079' || $EmployeeID=='171091') {
          
       ?>
    <label>Article Number</label>
    <input type="text" name="table_search" id="Value_ID_return" class="form-control" required>
    <br>
    <input type="submit"  onclick="searchReturn(0);"  value="Search" class="btn btn-secondary"> 
   <?php //}?>
    </div>
    <div class="col-lg-2"></div>

    </div>
<br>
      <script type="text/javascript">
      function ccc() 
      {
      
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview2'), scanPeriod:2, mirror: false });
      scanner.addListener('scan', function (content) {
       // alert(content);
        searchReturn(content);


});
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[1]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    }
    </script>
             </div>    
      </div>
   </div>
</div>
<div class="modal fade" id="qr_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog modal-dialog-centered" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Assign Article </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
          <div  style="text-align: center; font-size: 20px;">Scan QR</div>
             <div id="" style="text-align: center;">
              
    <video id="preview1" width="100%" height="300px">
      
      <input type="text" name="">
    </video>
    <hr>
    or
    <hr>
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8">
        <?php // if ($EmployeeID=='131053' || $EmployeeID=='121079' || $EmployeeID=='171091') {
          // code...
       ?>
    <label>Article Number</label>
    <input type="text" name="id" id="id" class="form-control" required>
    <br>
    <input type="submit"  value="Submit" onclick="cc()" class="btn btn-primary">
    <?php // } ?>
    </div>
    <div class="col-lg-2"></div>
    </div>
    <br>
    <script type="text/javascript">
      function cc(id){
        var id=document.getElementById('id').value;
        if (id!='') {
           var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
$('#tab_data').hide();
 $('#qr_modal').each(function(){
                    $(this).modal('hide');
});
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+30, true);
xmlhttp.send();
// window.location.href="lcm.php?id="+id;
}
else{
  alert('Article Not Empty');
}
      }
      function bbb(){

      let scanner = new Instascan.Scanner({ video: document.getElementById('preview1'), scanPeriod:2, mirror: false });
      scanner.addListener('scan', function (content) {
    var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
$('#tab_data').hide();
 $('#qr_modal').each(function(){
                    $(this).modal('hide');
});
}
}
xmlhttp.open("GET", "get_action.php?id=" + content+"&code="+30, true);
xmlhttp.send();
});
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[1]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
    
}

    </script>

             </div>    
      </div>
   </div>
</div>

<script type="text/javascript">
    

function search(){
var code=9;
//alert(id);
var id=document.getElementById("Value_ID").value;
if (id!='')
 {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
 $('#qr_modal_as').each(function(){
                    $(this).modal('hide');
 });
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+9, true);
xmlhttp.send();
}
else
{
  alert('Article Number not Empty');
}
}


function searchReturn(id)   
      {
        if(id==0)
        {
          id=document.getElementById("Value_ID_return").value;
        } 
         //var RoomType= document.getElementById("RoomType").value;
         //alert(RoomType);
         var code=47;
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
              // qr_modal_return
               $('#qr_modal_return').each(function()
               {
                    $(this).modal('hide');
              });
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
    if (returnRemark!='' && workingStatus!='') 
    {
         $.ajax(
         {
            url:"action.php ",
            type:"POST",
            data:
            {
               code:code,article_id:id,returnRemark:returnRemark,workingStatus:workingStatus
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

</script>
<script>
function  assigned_one()
{
// var id=id1;
var id= document.getElementById("id").value;
var locationID= document.getElementById("lcm_id").value;
if(locationID!='' && id!='')
{
//alert(locationID);
var code=15;
var UserID='';
$.ajax({
url:"action.php ",
type:"POST",
data:{
IDNo: id,code:code,iDNo_assing:locationID,UserID:UserID,
},
success:function(response) {
document.getElementById("stock_add").innerHTML =response;
// $(document).ajaxStop(function(){
window.location.reload();
// });
},
error:function(){
alert("error");
}
});
} 
else
{
  alert('invalid Selection');
}
} 

</script>
    <?php include "footer.php";

     ?>