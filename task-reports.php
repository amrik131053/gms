<?php 
include "header.php";
 ?>
<script type="text/javascript">
window.onload = function() {
    pendingMyTask();
        };
</script>
<div class="page">
   
    <div class="content">
        <div class="card-header"></div>
            <!-- Left Section -->
            <div class="col-lg-12 col-sm-12">
                <form action="action_tms.php" method="post" class="card">
                    <div class="card-status-top bg-primary"></div><br>
                    <div class="card-body d-flex justify-content-between align-items-center">
                    <form id="filterForm">
                     
  <!-- Employee -->
  <select id="employee_id" class="form-control" onchange="fetchTasks()">
    <option value="">-- Select Employee --<?=$role_id;?></option>
    <?php
    // if($role_id=='2')
    // {
     
    // $userDetails="SELECT * FROM users where role_id='0'";
    // }
    // else{
    //   $userDetails="SELECT DISTINCT  users.emp_id,users.name FROM `users` 
    //   inner join task_assignments on task_assignments.user_id=users.emp_id 
    //   INNER JOIN tasks on tasks.id=task_assignments.task_id where users.role_id='0' and tasks.created_by='$user_id' ";
    // }

    //  $userDetails_run=mysqli_query($conn,$userDetails);
    //  while ($userDetails_row=mysqli_fetch_array($userDetails_run))
    //  {
    //  ?>

    //   <option value="<?= $userDetails_row['emp_id'] ?>"><?= $userDetails_row['name'] ?></option>
    <?php //} ?>
  </select>

  <!-- Category -->
  <select id="category_id" class="form-control" onchange="fetchTasks()">
    <option value="">-- All Categories --</option>
    <?php
        //   $room_qry1="SELECT DISTINCT name,master_categories.id as m_id FROM master_categories inner join category_permissions ON category_permissions.category_id=
        //   master_categories.id INNER JOIN tasks ON tasks.task_type_id=master_categories.id  where category_permissions.emp_id='$user_id'  ORDER BY master_categories.name ASC";
        //   // $room_qry1="SELECT DISTINCT name,master_categories.id as m_id FROM master_categories inner join category_permissions ON category_permissions.category_id=
        //   // master_categories.id where category_permissions.emp_id='$user_id'  ORDER BY master_categories.name ASC";
        //   $res_room1=mysqli_query($conn,$room_qry1);
        //   while ($roomData1=mysqli_fetch_array($res_room1)) {
        // ?>
        //   <option value="<?= $roomData1['m_id'] ?>"><?= $roomData1['name'] ?></option>
        <?php //} ?>
  </select>

  <!-- Building -->
  <select id="building_id" class="form-control" onchange="fetchTasks()">
    <option value="">-- All Buildings --</option>
    <?php
        //   $hostelQry="SELECT * FROM building_master ORDER BY Name ASC";
        //   $hostelQry="SELECT DISTINCT building_master.Name,building_master.ID FROM `tasks` inner join location_master ON location_master.ID=tasks.location_id inner join building_master ON building_master.ID=location_master.Block ORDER BY building_master.Name ASC";
        //   $hostelRes=mysqli_query($conn,$hostelQry);
        //   while($hostelData=mysqli_fetch_array($hostelRes)) {
        // ?>
        //   <option value="<?= $hostelData['ID'] ?>"><?= $hostelData['Name'] ?></option>
        <?php// } ?>
      </select>
</form>



                    </div>

                    <div class="card-body" >
                        <div class="card" id="taskResults"></div>
                        
                    </div>
                </form>
            </div>

            <!-- Right Section -->
            
        </div>
    </div>

         

<script>
  function fetchTasks() {
  showLoader();
    var employee_id=document.getElementById("employee_id").value;
var category_id=document.getElementById("category_id").value;
var building_id=document.getElementById("building_id").value;
  $.ajax({
        url: 'action_tms.php',
        type: 'POST',
        data: {
            code: 41,
            employee_id: employee_id,
            category_id:category_id,
            building_id:building_id
        },
        success: function (res) {
          hideLoader();
          $('#taskResults').html(res);
        },
        error: function () {
          hideLoader();
            $('#taskResults').html('<p class="text-danger">Failed to load data.</p>');
        }
    });
}
</script>
<script>

function exportTableToExcel()
      {
            var exportCode='1';
            var employee_id=document.getElementById("employee_id").value;
var category_id=document.getElementById("category_id").value;
var building_id=document.getElementById("building_id").value;
            window.location.href="export.php?employee_id="+employee_id+"&exportCode="+exportCode+"&category_id="+category_id+"&building_id="+building_id;
      }

</script>

<?php 


include "footer.php";


?>