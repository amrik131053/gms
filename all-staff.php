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
  <div class="mb-3 text-end">
    <input type="text" id="searchIDNo" placeholder="Search by IDNo" class="form-control form-control-sm" style="width: 200px; display: inline-block;">
    <button class="btn btn-primary btn-sm" onclick="loadStaff(1)">Search</button>
</div>

  </div>
<div class="card table-responsive" id="loadOnlineData" >

</div>
<script>

function verifyImage(idNo, action) {
    if (!confirm("Are you sure you want to " + action + " this image?")) return;

    fetch('action_g.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'code=392.2&id=' + encodeURIComponent(idNo) + '&action=' + encodeURIComponent(action)
    })
    .then(res => res.text())
    .then(data => {
        alert(data);
        loadStaff(); // Refresh the current page
    });
}

loadStaff(page = 1);


function loadStaff(page = 1) 
{
    var spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
   const idNo = document.getElementById('searchIDNo').value;
  var code=392.1;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code,page:page,idNo:idNo},
   success:function(res)
   {
    spinner.style.display='none';
    document.getElementById('loadOnlineData').innerHTML=res;
   }
  });
}


</script>
<?php 
include "footer.php";
?>