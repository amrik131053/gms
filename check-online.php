<?php 
include "header.php";
?>
<div class="container-fluid" >
<div class="card" >
<table class="table">
    <thead>
        <tr>
            <th>UserName</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Department</th>
            <th>Status</th>
        </tr>
</thead>
        <tbody id="users">
            <?php 
             $time=time();
             $checkUserOnline="SELECT * FROM UserMaster inner join Staff ON UserMaster.UserName=Staff.IDNo Where UserMaster.ApplicationType='Web' 
             and UserMaster.ApplicationName='Campus' and Staff.JobStatus='1' and UserMaster.ActivityStatus>$time ";
             $checkUserOnlineRun=sqlsrv_query($conntest, $checkUserOnline);
             while($checkUserOnlineRow=sqlsrv_fetch_array($checkUserOnlineRun,SQLSRV_FETCH_ASSOC))
             {
                ?>
                 <tr>
                     <td><?=$checkUserOnlineRow['UserName'];?></td>
                     <td><?=$checkUserOnlineRow['Name'];?></td>
                     <td><?=$checkUserOnlineRow['Designation'];?></td>
                     <td><?=$checkUserOnlineRow['Department'];?></td>
                     <td><?php 
                     echo $onlineStatus="<b class='text-success'>Online</b>";
                 ?></td>
                 </tr>
             
             <?php 
             }?>
</tbody>
</table>
</div>
<script>
// checkonline();
// setInterval(function(){ 
//     checkonline();
//  }, 60000);
//     function checkonline()
//  {
//   var code=392;
//   $.ajax({
//    url:"action_g.php",
//    method:"POST",
//    data:{code:code},
   
//    success:function(response)
//    {
//     console.log(response);
//      document.getElementById('users').innerHTML=response;

//    }
//   });
//  }
</script>
<?php 
include "footer.php";
?>