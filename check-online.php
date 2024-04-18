<?php 
include "header.php";
?>
<style>

a.avatar-link{
    position: relative;
    display: inline-block;
}

.img-box img.user-avatar{
    border-radius: 50%;
    display: block;
}

.user-status {
    border-radius: 50%;
    height: 10px;
    position: absolute;
    right: -5px;
    bottom: 25px;
    width: 10px;
    background-color: green;
}

.img-box img.user-avatar[width="140"] + .user-status{
   right: 16px;
   bottom: 15px;
}

</style>
<p id="ajax-loader"></p>
<div class="container-fluid" >
  <div class="card-header">
  Total Active Users:<small id="countOnlineUsers"></small>
    
  </div>
<div class="card table-responsive" id="loadOnlineData" >

</div>
<script>
loadCheckOnlineData();
loadCountOnlineUsers();
setInterval(function(){ 
    loadCheckOnlineData();
 }, 60000);
function loadCheckOnlineData() {
    var spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var code=392;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code},
   success:function(res)
   {
    spinner.style.display='none';
    document.getElementById('loadOnlineData').innerHTML=res;
    loadCountOnlineUsers();
   }
  });
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

function loadCountOnlineUsers() {
  var code=393;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code},
   success:function(res)
   {
    document.getElementById('countOnlineUsers').innerHTML=res;
   }
  });
}
</script>
<?php 
include "footer.php";
?>