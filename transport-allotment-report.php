<?php 
   ini_set('max_execution_time', '0');
   include "header.php";  
   include '../gkuadmin/DB_connection/connection.php';
   // include "connection/connection.php"; 

if (isset($_POST['checkin_redy'])) {
  $intime=$_POST['intime'];
  $id=$_POST['id'];
     $sql = "UPDATE vehicle_allotment SET action='1' , in_time='$intime' where id='$id'";
$result = mysqli_query($connection_local, $sql);
if ($result) 
{
   ?>
   <script type="text/javascript">
      window.location.href('allotment_report.php');
   </script>
   <?php

   // location: allotment_report.php?
}
else
{

}
}
if (isset($_POST['checkin_in'])) {
  $intime=$_POST['intime'];
  $id=$_POST['id'];
    $sql = "UPDATE vehicle_allotment SET action='2', out_time='$intime'  where id='$id'";

$result = mysqli_query($connection_local, $sql);
if ($result) 
{
   ?>
   <script type="text/javascript">
      window.location.href('allotment_report.php');
   </script>
   <?php

// header("location: allotment_report.php");  # code...
}else
{
  
}
}

?>
   <p id="ajax-loader"></p>
<section class="content">
   <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card-header">
               <h3 class="card-title">Vehicle Report</h3>
            </div>
            <div class="card-body">
                 <table class="table table-bordered table-hover " id="example">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>  Indenter Name</th>
                      <th> Type</th>
                      <th>Date</th>
                      <th>Station</th>
                      <th>Purpose</th>
                      <th>Departure Date/Time</th>
                       <th>Arival Date/Time</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

<?php

 $result = mysqli_query($connection_local," SELECT  *,va.action as action1 ,va.id as idd, va.name as vaname, vd.name as vdname, vd.number as vno
    FROM vehicle_allotment va
    INNER JOIN vehicle_details vd  
         ON vd.id = va.vehicle_no  WHERE 
        va.status='4'  ORDER BY va.id DEsC  limit 50");

                // $result = mysqli_query($connection_local,"SELECT * FROM vehicle_allotment where status='4' ORDER BY status ASC");
                    $counter = 1;
                   while($row=mysqli_fetch_array($result))
                    {
                        $id = $row['idd'];
                        $subject = $row['app_sub'];
                        $desc = $row['app_desc'];
//    if ($desc==1)
//      {
// $typeofvehicle="VAN";
//     }elseif ($desc==2) {
//       $typeofvehicle="TRACTOR";
//     }elseif ($desc==3) {
//       $typeofvehicle="LOADER";
//     }
//     elseif ($desc==4) {
//       $typeofvehicle="CAR";
//     }elseif ($desc==5) {
//       $typeofvehicle="AMBULANCE";
//     }elseif ($desc==6) {
//       $typeofvehicle="PICKUP";
//     }elseif ($desc==7) {
//       $typeofvehicle="BUS";
//     }
                        $action = $row['action1'];
                        $name = $row['vaname'];
                        $vdname = $row['vdname'];
                        $vehicletype = $row['vehicletype'];
                         $submit_date1 = $row['submit_time'];
                         $submit_date=date("d-m-Y", strtotime($submit_date1));
                          $rec_date = $row['attachment'];
                           $end_date = $row['submit_date'];
                             $vno = $row['vno'];
                           $in_time1 = $row['in_time'];
                           if ($in_time1!='') {
                            $in_time= date("d-m-Y h:i:sa ", strtotime($in_time1));
                           }
                          else
                          {
                            $in_time="";
                          }
                           $out_time1 = $row['out_time'];
                           if ($out_time1) {
                            $out_time= date("d-m-Y h:i:sa ", strtotime($out_time1));
                           }
                           else
                           {
                            $out_time="";
                           }
                            $intime = $row['status'];
                              if($intime=='4')
                            {
                              $colr="";
                              $status1='Allotted';
                            } 
                            else
                            {
                              $status1='Replied';
                            }
                            if ($action=='0')
                             {
                              $color='#F55A33';
                               $cl='black';# code...
                            }else if($action=='1')
                            {
                              $color='#F0D917';
                              $cl='black';
                            }else
                            {
                              $color='#6bff90';
                              $cl='black';
                            }
                            ?>

                        <tr class="" style="background:<?=$color;?>; color:<?=$cl;?>">
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $vehicletype.' ('.$vdname; ?>) - (<?=$vno;?>)</td>
                        <td><?=$submit_date;?></td>
                        <td><?= $rec_date; ?></td>
                         <td><?= $end_date; ?></td>
                            <td><?= $in_time; ?></td>
                               <td><?= $out_time; ?></td>
                          <td><?= $status1; ?></td>
                          <td>
                         <i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#exampleModal" onclick="allotment_response(<?=$id;?>);"></i>
                          </td>
                        <td> 
                          <?php if($action=='0'){?>
<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal_redy" data-whatever="@getbootstrap"  onclick="checkin(<?=$id;?>)"> Ready To Go</button>
                         <?php }else if($action=='1'){?>
<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#exampleModal_in" data-whatever="@getbootstrap"  onclick="checkout(<?=$id;?>)">Check In</button>
                        <?php  } else
                        {?>
Completed
                        <?php }?>
                         (<?=$vno;?>)  
                          
                        </td>
                        </tr>
               <?php }?>
             </tbody></table>
            </div>
         </div>
      </div>
   </div>
   
</section>
<div class="modal fade" id="exampleModal_redy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready To Go</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="#" method="post">
      <div class="modal-body" id="checkin_redy">
    
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="checkin_redy" class="btn btn-primary">Submit</button>
      </div>
       </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal_in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="#" method="post">
      <div class="modal-body" id="checkin_in">
    
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="checkin_in" class="btn btn-primary">Submit</button>
      </div>
       </form>
    </div>
  </div>
</div>





<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <!--  <h5 class="modal-title" id="exampleModalLabel"></h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <div id="allotment_response1">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <!--       <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  

  function checkin(id)
  {
  var code=5;
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("checkin_redy").innerHTML=xmlhttp.responseText;

    }
    }
  xmlhttp.open("GET", "../gkuadmin/transport/get_actions.php?id=" + id+"&code="+code, true);
    xmlhttp.send();
// refreshPage();

  }

  function checkout(id)
  {


//alert(id);
  var code=6;
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("checkin_in").innerHTML=xmlhttp.responseText;
    }
    }
  xmlhttp.open("GET", "../gkuadmin/transport/get_actions.php?id=" + id+"&code="+code, true);
    xmlhttp.send();
// refreshPage1();
  }
  
 function allotment_response(id){
  var code=4;
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("allotment_response1").innerHTML=xmlhttp.responseText;
    }
    }
  xmlhttp.open("GET", "../gkuadmin/transport/get_actions.php?id=" + id+"&code="+code, true);
    xmlhttp.send();
}



</script>
<script type="text/javascript">
   
</script>



<?php include "footer.php";

?>