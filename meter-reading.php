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
                <input type="submit" name="" data-toggle="modal" onclick="scanMeter()" data-target="#meter_modal"  value="Meter" class="btn btn-primary"> 
               </div>
              <!-- /.card-header -->      
            <div id="stock_add"></div>
              <!-- /.card-body -->
            </div>
        <div class="card-body table-responsive " style="height:700px;" id="tab_data">
                  
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

<div class="modal fade" id="meter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
      <div class="col-lg-8"> <?php //if ($EmployeeID=='131053' || $EmployeeID=='171306' || $EmployeeID=='171091') {
          
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
   
      <script type="text/javascript">
      function scanMeter() 
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
 $('#meter_modal').each(function(){
                    $(this).modal('hide');
});
}
}
xmlhttp.open("GET", "get_action.php?id=" + content+"&code="+42, true);
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




  function insertReading(id,oldReading,currentOwner,locationID)
  {
   
    var currentReading=document.getElementById("reading").value;
    var date=document.getElementById("date").value;
    // var unitRate=document.getElementById("unitRate").value;

    var unitsConsumed=currentReading-oldReading;
    if (currentReading<oldReading) 
    {
      alert("New reading must be greater than previous reading");  
      document.getElementById('reading').value='';
    }
    else
    {


    if (currentReading!='' & date!='' ) 
         {

         var code=102;
          $.ajax(
             {
                url:"action.php ",
                type:"POST",
                data:
                {
                   code:code,currentReading:currentReading,date:date,unitsConsumed:unitsConsumed,currentOwner:currentOwner,locationID:locationID,articleID:id
                },
                success:function(response) 
                {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                    document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
                    $('#tab_data').hide();
                     $('#meter_modal').each(function(){
                                        $(this).modal('hide');
                    });
                    }
                    }
                    xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+42, true);
                    xmlhttp.send();

                   
                }
             });
         }
         else
         {
            alert("Enter all values first...");
         }
      }
  }
  function unitsConsumed(currentReading,oldReading)
  {
    var unitsConsumed=currentReading-oldReading;
    if (currentReading<oldReading) 
    {
      alert("New reading must be greater than previous reading");  
    document.getElementById('reading').value='';
    }
    else
    {

    document.getElementById('unitsConsumed').value=unitsConsumed;
    }
  }
    

function search(){
var code=42;
//alert(id);
var id=document.getElementById("Value_ID").value;
if (id!='')
 {
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_add").innerHTML=xmlhttp.responseText;
 $('#meter_modal').each(function(){
                    $(this).modal('hide');
 });
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+42, true);
xmlhttp.send();
}
else
{
  alert('Article Number not Empty');
}
}

</script>
<script>
function  assigned_one()
{
// var id=id1;
var id= document.getElementById("id").value;
var locationID= document.getElementById("lcm_id").value;
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
// window.location.reload();
// });
},
error:function(){
alert("error");
}
});
}  

</script>
    <?php include "footer.php";

     ?>