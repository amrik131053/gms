  <!DOCTYPE html>
  <html>
  <head>
  		<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script> 
 <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- <script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script> -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>
<?php
ini_set('max_execution_time', 0); 
include 'connection/connection.php';
if(isset($_GET['ref']))
{
    $refNo=$_GET['ref'];
     $sql="SELECT *,gev.status as visitorStatus  FROM gate_entry_visitor gev inner join gate_entry_qr geq on geq.id=gev.gate_pass_no WHERE reference_no='$refNo' order by gev.id desc limit 1";


                $entry_date = date('Y-m-d');
                // $sql = "SELECT * FROM gate_entry_visitor WHERE id='1'";
                $result = mysqli_query($conn, $sql);

                $count = 1;
                  while($row = mysqli_fetch_array($result))
                  {  
                     $result1 = "SELECT * FROM Staff where IDNo=".$row['meeting_person_id'];
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $empName=$row1['Name'];
                           $empDep=$row1['Department'];
                           $empImg="data:image/jpeg;base64,".base64_encode($row1['Snap']);
                        }

                     ?>
<br>
<div class="row">
  <div class="col-md-4">
    <div class="card card-widget widget-user">
      <div class="widget-user-header bg-info">
        <!-- <a   href="http://gurukashiuniversity.co.in/data-server/gate_entry/<?=$row['visitor_image']?>"> -->
          <h3 class="widget-user-username"><b><?=$row['visitor_name']?></b></h3>
        <!-- </a>       -->
      </div>
      <div class="widget-user-image">
        <!-- <a   href="http://gurukashiuniversity.co.in/data-server/gate_entry/<?=$row['visitor_image']?>"> -->
          <img class="img-circle elevation-2" src="http://gurukashiuniversity.co.in/data-server/gate_entry/<?=$row['visitor_image']?>" alt="User Avatar">
        <!-- </a> -->
      </div>
      <div class="card-footer p-0">
        <br><br>
        <ul class="nav flex-column">
          <li class="nav-item">
            <li href="#" class="nav-link">
              Mobile <span class="float-right badge bg-primary"><?=$row['visitor_mobile']?></span>
            </li>
          </li>
          <li class="nav-item">
            <li href="#" class="nav-link">
              In <span class="float-right badge bg-info"><?=date("H:i A", strtotime($row["entry_time"]))?></span>
            </li>
          </li>
          <li class="nav-item">
            <li href="#" class="nav-link">
              Out 
                <?php 
                if($row["visitorStatus"] == "1")
                {
                  ?>
                  <span class="float-right badge bg-success">
                  <?php
                  echo date("H:i A", strtotime($row["exit_time"]));
                  ?>
                </span>
                  <?php
                }
                else
                {
                  ?>
                  <span class="float-right badge bg-danger">In Campus</span>
                  <?php
                }
                ?>
            </li>
          </li>
          <li class="nav-item">
            <li href="#" class="nav-link">
              View 
              <span class="float-right badge bg-light">
                <div class="filter-container p-0 row">
                  <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                    <a href="http://gurukashiuniversity.co.in/data-server/gate_entry/<?=$row['visitor_image']?>" data-toggle="lightbox" data-title="<?=$row['visitor_name']?>">
                      <i class="fa fa-eye fa-2x"></i>
                    </a>
                  </div>
                </div>
              </span>
            </li>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
            <?php 
         }
       }
         ?>
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

  })
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
</html>
