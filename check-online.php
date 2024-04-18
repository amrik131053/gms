<?php 
include "header.php";
?>
<p id="ajax-loader"></p>
<div class="container-fluid" >
<div class="card" id="loadOnlineData" >

</div>
<script>
loadCheckOnlineData();
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
</script>
<?php 
include "footer.php";
?>