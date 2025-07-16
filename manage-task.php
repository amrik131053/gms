<?php 

include "header.php";
 ?>
<script type="text/javascript">

</script>


<!-- ----------------- -->



<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
            <form action="action_tms.php" method="post" id="permissionForm" class="card">
        <div class="card-header">
            <h3 class="card-title">Manage Task</h3>
            <div class="card-tools">
                <button type="button" data-toggle="modal" data-target="#createTaskModal" class="btn btn-primary">
                    Create Task <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 5l0 14" />
        <path d="M5 12l14 0" />
    </svg>
                </button>
            </div>
        </div>
        <div class="card-body table-responsive " id="data_show">
                          <div class="row">
                            <!-- <div class="card-body table-responsive" id="all_staff_show"> -->
                                <!-- Permissions will be loaded here -->
                            </div>
                        </div>
        </div>
    </form>
    </div>
    <!-- /.card -->

</section>

<!-- Modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
   
    <div class="modal-dialog" role="document">
         <form action="action_tms.php" method="post" id="permissionForm" class="card">
        <div class="modal-content"  style="WIDTH: 781px;">

            <div class="modal-header">
   
                <h5 class="modal-title" id="exampleModalLabel">Create Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            </form>
       <div class=" modal-body row g-3">
    
    <div class="col-md-4">
      <label for="title" class="form-label">Title</label>
      <input type="text" id="title" name="title" class="form-control" placeholder="Enter title">
    </div>

    <div class="col-md-4">
      <label for="description" class="form-label">Description</label>
      <input type="text" id="description" name="description" class="form-control" placeholder="Enter description">
    </div>
    <div class="col-md-4">
      <label for="category" class="form-label">Category</label>
      <select class="form-control" id="category" name="category">
        <?php
          $room_qry1="SELECT DISTINCT name,master_calegories.ID as m_ID FROM master_calegories inner join category_permissions ON category_permissions.category_type_id=
          master_categories.ID where category_permissions.emp_id='$user_id'  ORDER BY master_categories.CategoryName ASC";
          $res_room1=mysqli_query($conn,$room_qry1);
          while ($roomData1=mysqli_fetch_array($res_room1)) {
        ?>
          <option value="<?= $roomData1['m_id'] ?>"><?= $roomData1['name'] ?></option>
        <?php } ?>
    </select>
    </div>
    <!-- Building Dropdown -->
    <div class="col-md-4">
      <label for="hostel_id" class="form-label">Building</label>
      <select class="form-control" name="hostel" id="hostel_id" onchange="floorLocation(this.value)">
        <option value="">Select Building</option>
        <?php
          $hostelQry="SELECT * FROM building_master ORDER BY Name ASC";
          $hostelRes=mysqli_query($conn,$hostelQry);
          while($hostelData=mysqli_fetch_array($hostelRes)) {
        ?>
          <option value="<?= $hostelData['ID'] ?>"><?= $hostelData['Name'] ?></option>
        <?php } ?>
      </select>
    </div>
    <!-- Floor Dropdown -->
    <div class="col-md-4">
      <label for="hostelFloorID" class="form-label">Floor</label>
      <select class="form-control" name="hostelFloorID" id="hostelFloorID" onchange="buildingRoom(0,this.value)">
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
     <div class="col-md-4">
      <label for="hostelRoomID" class="form-label">Room No.</label>
      <select class="form-control" name="hostelRoomID" id="hostelRoomID" onchange="drop_room_type(this.value);">
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
    <div class="col-md-4">
      <label for="roomType" class="form-label">Room Type</label>
      <select class="form-control" name="roomType" id="roomType">
        <option value="">Select Room Type</option>
       
      </select>
    </div>
 <!-- GPS Location Required -->
 <div class="col-md-6 d-flex align-items-center">
  
  <div class="form-check">
    <input class="form-check-input" type="checkbox" id="gps_required" name="gps_required">
    <label class="form-check-label" for="gps_required">GPS Location Required?</label>
  </div>
</div>

            
</div>
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="createTask();">Submit</button>
                
           </div>
        </div>
    </div>
</div>

<script>
  window.onload = function() {
    show_all_tasks();
        };

        function loadTasks(page = 1) {
    $.ajax({
        url: 'action_tms.php',
        type: 'POST',
        data: {
            code: 19,
            page: page
        },
        success: function (res) {
            $('#all_staff_show').html(res);
        },
        error: function () {
            $('#all_staff_show').html('<p class="text-danger">Failed to load data.</p>');
        }
    });
}

// Load first page on page ready
$(document).ready(function () {
    loadTasks();
});

// Handle dynamic click for pagination links
$(document).on('click', '.pagination .page-link', function (e) {
    e.preventDefault();
    const page = $(this).text();
    loadTasks(page);
});

</script>

<?php 


include "footer.php";


?>