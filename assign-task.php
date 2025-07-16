<?php 
include "header.php";
 ?>
<script type="text/javascript">

</script>
<style>
  .checkbox-dropdown {
    position: relative;
  }

  .checkbox-dropdown-menu {
    display: none;
    position: absolute;
    z-index: 1000;
    background: white;
    border: 1px solid #ccc;
    max-height: 250px;
    overflow-y: auto;
    width: 100%;
    padding: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
  }

  .checkbox-dropdown.show .checkbox-dropdown-menu {
    display: block;
  }
</style>
<script>
  function toggleTaskDropdown() {
    document.getElementById("taskDropdown").classList.toggle("show");
  }

  window.addEventListener("click", function(e) {
    const taskDropdown = document.getElementById("taskDropdown");
    if (!taskDropdown.contains(e.target)) {
      taskDropdown.classList.remove("show");
    }
  });
</script>
<script>
  function toggleEmployeeDropdown() {
    document.getElementById("employeeDropdown").classList.toggle("show");
  }

  window.addEventListener("click", function(e) {
    const empDropdown = document.getElementById("employeeDropdown");
    if (!empDropdown.contains(e.target)) {
      empDropdown.classList.remove("show");
    }
  });
</script>
<script>
  window.onload = function() {
    // show_all_assigned_tasks();
        };


</script> 
<div class="page">
    
    <div class="content">
        <div class="card-body" >
            <!-- Left Section -->
            <div class="col-lg-12 col-sm-6">
                <form action="action_tms.php" method="post" class="card" >
                    <div class="card-status-top bg-primary" ></div>
                    <div class="card-header d-flex justify-content-between align-items-center" style="background-color:#223260;color:white;">
                        <h4 class="card-title mb-0">Assign Task</h4>

                    </div>

                    <div class="modal-body row g-4">
                        <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="code" id="code" value="26">
      <label for="category" class="form-label">Category</label>
      <select class="form-control" id="category" name="category" onchange="drop_emp_with_category(this.value);drop_tasks();">
        <option value="">Select Category</option>
        <?php
          // $room_qry1="SELECT DISTINCT name,master_categories.id as m_id FROM master_categories inner join category_permissions ON category_permissions.category_id=
          // master_categories.id INNER JOIN tasks ON tasks.task_type_id=master_categories.id  where category_permissions.emp_id='$user_id'  ORDER BY master_categories.name ASC";
          // $room_qry1="SELECT DISTINCT name,master_categories.id as m_id FROM master_categories inner join category_permissions ON category_permissions.category_id=
          // master_categories.id where category_permissions.emp_id='$user_id'  ORDER BY master_categories.name ASC";
        //   $res_room1=mysqli_query($conn,$room_qry1);
        //   while ($roomData1=mysqli_fetch_array($res_room1)) {
        // ?>
          <!-- <option value="<?= $roomData1['m_id'] ?>"><?= $roomData1['name'] ?></option>
        <?php //} ?> -->
      </select>
    </div>

    <!-- Building Dropdown -->
    <div class="col-md-4">
      <label for="hostel_id" class="form-label">Building</label>
      <select class="form-control" name="hostel" id="hostel_id" onchange="floorLocation(this.value);drop_tasks();">
        <option value="">Select Building</option>
        <?php
          // $hostelQry="SELECT * FROM building_master ORDER BY Name ASC";
          // $hostelQry="SELECT DISTINCT building_master.Name,building_master.ID FROM `tasks` inner join location_master ON location_master.ID=tasks.location_id inner join building_master ON building_master.ID=location_master.Block ORDER BY building_master.Name ASC";
          // $hostelRes=mysqli_query($conn,$hostelQry);
          // while($hostelData=mysqli_fetch_array($hostelRes)) {
        ?>
          <option value="<?= $hostelData['ID'] ?>"><?= $hostelData['Name'] ?></option>
        <?php //} ?>
      </select>
    </div>

    <!-- Floor Dropdown -->
    <div class="col-md-4">
      <label for="hostelFloorID" class="form-label">Floor</label>
      <select class="form-control" name="hostelFloorID" id="hostelFloorID" onchange="buildingRoom(0,this.value);drop_tasks();">
        <option value="">Select Floor</option>
        <?php
          $floor_qry="SELECT DISTINCT Floor FROM location_master WHERE Floor != ''";
          $res_floor=mysqli_query($conn,$floor_qry);
          while ($floorData=mysqli_fetch_array($res_floor)) {
            $floorValue = $floorData['Floor'];
            if ($floorValue != '') {
              switch ($floorValue) {
                case '0': $floorName = 'Ground'; break;
                case '1': $floorName = 'First'; break;
                case '2': $floorName = 'Second'; break;
                case '3': $floorName = 'Third'; break;
                case '4': $floorName = 'Fourth'; break;
                case '5': $floorName = 'Fifth'; break;
                case '-1': $floorName = 'Basement'; break;
                default: $floorName = $floorValue; break;
              }
        ?>
          <option value="<?= $floorValue ?>"><?= $floorName ?></option>
        <?php }} ?>
      </select>
    </div>

    <!-- Room Dropdown -->
    <div class="col-md-4 col-sm-12">
      <label for="hostelRoomID" class="form-label">Room No.</label>
      <select class="form-control" name="hostelRoomID" id="hostelRoomID" onchange="drop_room_type(this.value);drop_tasks();">
        <option value="">Select Room No.</option>
        <?php
          $room_qry="SELECT DISTINCT RoomNo FROM location_master ORDER BY RoomNo ASC";
          $res_room=mysqli_query($conn,$room_qry);
          while ($roomData=mysqli_fetch_array($res_room)) {
        ?>
          <option value="<?= $roomData['RoomNo'] ?>"><?= $roomData['RoomNo'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-lg-4 col-sm-12">
      <label for="roomType" class="form-label">Room Type</label>
      <select class="form-control" name="roomType" id="roomType" onchange="drop_tasks();">
        <option value="">Select Room Type</option>
       
      </select>
    </div>
<!-- Tasks -->
<div class="col-lg-4 col-sm-12">
  <label class="form-label">Tasks</label>
  <div class="checkbox-dropdown" id="taskDropdown">
    <button type="button" class="btn btn-light form-control text-start" onclick="toggleTaskDropdown()">Select Tasks</button>
    <div class="checkbox-dropdown-menu border p-2" id="task_id" style="display: none;">
    
    </div>
  </div>
  <div id="selectedTasks" class="mt-2 text-muted small"></div>
</div>

<!-- Employees -->
<div class="col-lg-4 col-sm-12">
  <label class="form-label">Employees</label>
  <div class="checkbox-dropdown" id="employeeDropdown">
    <button type="button" class="form-control" onclick="toggleEmployeeDropdown()">Select Employees</button>
    <div class="checkbox-dropdown-menu border p-2" id="employee_id" style="display: none;">
 
    
    </div>
  </div>
  <div id="selectedEmployees" class="mt-2 text-muted small"></div>
</div>


<!-- <div class="col-lg-4 col-sm-12">
  <label class="form-label">Tasks</label>
  <div class="checkbox-dropdown" id="taskDropdown">
    <button type="button" class="btn btn-light form-control text-start" onclick="toggleTaskDropdown()">Select Tasks</button>
    <div class="checkbox-dropdown-menu" id="task_id">
     
    </div>
  </div>
</div>


<div class="col-lg-4 col-sm-12">
  <label class="form-label">Employees</label>
  <div class="checkbox-dropdown" id="employeeDropdown">
    <button type="button" class="btn btn-light form-control text-start" onclick="toggleEmployeeDropdown()">Select Employees</button>
    <div class="checkbox-dropdown-menu" id="employee_id">
      
       
    
    </div>
  </div>
</div> -->




    <!-- <div class="col-md-6">
        <label class="form-label">Select Employee</label>
        <select class="form-control" name="employee_id" id="employee_id">
          <option value="">Select Employee</option>
         
        </select>
      </div> -->
                        </div>
                        <br>
                   <div class="card-footer">
                    <button type="button" class="btn btn-primary" onclick="assignTask();">Submit</button>
                   </div>     
                    </div>
                </form>
            </div>

            <!-- Right Section -->
            <!-- <div class="col-lg-7 col-sm-12">
                <form action="action.php" method="post" id="permissionForm" class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h4 class="card-title">All Assigned Tasks </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="card-body table-responsive" id="all_assigned_show" >

                            </div>
                        </div>
                       
                    </div>
                </form>
            </div> -->
        </div>
    </div>


         

<script>
  // Toggle dropdowns
  function toggleTaskDropdown() {
    document.getElementById('task_id').style.display =
      document.getElementById('task_id').style.display === 'block' ? 'none' : 'block';
  }

  function toggleEmployeeDropdown() {
    document.getElementById('employee_id').style.display =
      document.getElementById('employee_id').style.display === 'block' ? 'none' : 'block';
  }

  // Update buttons and show selected values

  function updateTaskButton() {
    let checkboxes = document.querySelectorAll('#task_id input[type="checkbox"]:checked');
    let titles = Array.from(checkboxes).map(cb => cb.getAttribute('data-title'));
    // document.querySelector('#taskDropdown button').textContent = titles.length > 0 ? titles.join(', ') : 'Select Tasks';
    document.getElementById('selectedTasks').textContent = titles.length > 0 ? 'Selected: ' + titles.join(', ') : '';
  }

  function updateEmployeeButton() {
    let checkboxes = document.querySelectorAll('#employee_id input[type="checkbox"]:checked');
    let titles = Array.from(checkboxes).map(cb => cb.getAttribute('data-title'));
    // document.querySelector('#employeeDropdown button').textContent = titles.length > 0 ? titles.join(', ') : 'Select Employees';
    document.getElementById('selectedEmployees').textContent = titles.length > 0 ? 'Selected: ' + titles.join(', ') : '';
  }


  // Close dropdowns when clicking outside
  document.addEventListener('click', function(event) {
    const taskDropdown = document.getElementById('taskDropdown');
    const employeeDropdown = document.getElementById('employeeDropdown');

    if (!taskDropdown.contains(event.target)) {
      document.getElementById('task_id').style.display = 'none';
    }
    if (!employeeDropdown.contains(event.target)) {
      document.getElementById('employee_id').style.display = 'none';
    }
  });
</script>

<?php 


include "footer.php";


?>