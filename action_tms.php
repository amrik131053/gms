<?php session_start();
date_default_timezone_set("Asia/Kolkata");
$timeStamp=date('Y-m-d H-i');
$todaydate=date('Y-m-d');
ini_set('max_execution_time', '0');
if (!(isset($_SESSION['user_id']))) 
{
?>
<script> window.location.href = 'index.php'; </script> 
<?php
   } 
   else
   {
   $user_id=$_SESSION['user_id'];
   if ($user_id==0 || $user_id=='') 
      {?>
<script type="text/javascript">
   window.location.href="index.php";
</script>
<?php }
   include "connection/connection_web.php";
    $userDetails="SELECT * FROM users Where emp_id='$user_id'";
      $userDetails_run=mysqli_query($conn,$userDetails);
      if ($userDetails_row=mysqli_fetch_array($userDetails_run))
      {
          $role_id = $userDetails_row['role_id'];
        
      }
      else
      {
        
      }
   $code = $_POST['code'];
   if ($code==1)
   {
      $role_id = $_POST['role_id'];
      $per = $_POST['per'];
      
      $in_per = "DELETE FROM role WHERE role_id='$role_id'";
      mysqli_query($conn, $in_per);
      
      foreach ($per as $key => $val) {
          $I = 0;
          $U = 0;
          $D = 0;
      
          if (isset($_POST[$val])) {
              $per1 = $_POST[$val];
              foreach ($per1 as $perm) {
                  if ($perm == 'I') {
                      $I = 1;
                    
                  } elseif ($perm == 'U') {
                      $U = 1;
                  
                  } elseif ($perm == 'D') {
                      $D = 1;
                    
                  }
              }
          }
      
          $in_per = "INSERT INTO role(role_id, page_id, I, U, D) VALUES('$role_id', '$val', '$I', '$U', '$D')";
          mysqli_query($conn, $in_per);
      }
      
    //   echo "<script>window.location.href='role.php';</script>";

      mysqli_close($conn);
   } 

   elseif($code==2) 
   {
   $emp_id=$_POST['emp_id'];
   $del="UPDATE users SET role_id='0' WHERE emp_id='$emp_id'";
   mysqli_query($conn,"DELETE from special_permission where emp_id='$emp_id'");
   $del_run=mysqli_query($conn,$del);
   if ($del_run) {

      echo "1";
    }
   else
   {
       echo "0";
   }
   mysqli_close($conn);
   }

   elseif ($code==3) 
   {
     $role = $_POST['roleName'];
   $role_insert = "INSERT into role_name (role_name)values ('$role')";
   $role_run = mysqli_query($conn, $role_insert);
   if ($role_run == true) {
    echo "1";
  }
 else 
 {
   echo "0 ";
 }
mysqli_close($conn);
}
elseif ($code==4)
{
  $menu_name = $_POST['menu_name'];
$master_menu_insert="INSERT into master_menu (menu_name)values ('$menu_name')";
$master_menu_run = mysqli_query($conn, $master_menu_insert);
if ($master_menu_run == true) {
echo "1";
} 
else
{
   echo "0";
}
mysqli_close($conn);
}
elseif($code==5)        
{
$user_id=$_POST['user_id'];
$per=$_POST['per'];
$per1=array();
 $in_per="DELETE from special_permission where emp_id='$user_id'";
 mysqli_query($conn,$in_per);
foreach($per as $key => $val)
{
    $I=0;
      $U=0;
      $D=0;
       $val;
      $per1=array();
      if (isset($_POST[$val])) 
      {
          $per1=$_POST[$val];
      }
 for ($i=0; $i<=2; $i++) { 
     if (isset($per1[$i])) 
     {
         
     if ($per1[$i]=='I') 
     {
      echo   "I=".$val.'='.$I=1;
     }
     elseif($per1[$i]=='U')
     {
      echo "U=".$val.'='.$U=1;
     }
     elseif ($per1[$i]=='D') 
     {
       echo  "D=".$val.'='.$D=1;
     }
 }       
 }
 $in_per="INSERT into special_permission(emp_id,page_id,I,U,D)values('$user_id','$val','$I','$U','$D')";
mysqli_query($conn,$in_per);
}
mysqli_close($conn);
}

elseif ($code == 6) {
    $role_id = $_POST['role_new'];
    $emp_id = $_POST['emp_id'];

    // Check if employee exists and has role_id = 0
    $check_role = "SELECT * FROM users WHERE emp_id='$emp_id' AND role_id='0'";
    $role_check_run = mysqli_query($conn, $check_role);

    if (mysqli_num_rows($role_check_run) > 0) {
        // Perform the update
        $insert = "UPDATE users SET role_id='$role_id' WHERE emp_id='$emp_id'";
        $insert_run = mysqli_query($conn, $insert);

        if ($insert_run) {
            echo "1"; // success
        } else {
            echo "0"; // update failed
        }
    } 
    else 
    {
        echo "2";
    }

mysqli_close($conn);
}

elseif ($code==7)
{
  $type_name = $_POST['type_name'];
$master_menu_insert="INSERT into master_categories (name,status)values ('$type_name','1')";
$master_menu_run = mysqli_query($conn, $master_menu_insert);
if ($master_menu_run == true) {
echo "1";
} 
else
{
   echo "0";
}
mysqli_close($conn);
}
elseif ($code==8)
{
  $designation_name = $_POST['designation_name'];
$master_menu_insert="INSERT into master_designation (name,status)values ('$designation_name','1')";
$master_menu_run = mysqli_query($conn, $master_menu_insert);
if ($master_menu_run == true) {
echo "1";
} 
else
{
   echo "0";
}
mysqli_close($conn);
}
elseif ($code==9)
{
  $getDesignation="SELECT * FROM master_designation where status='0' order by id ASC";
 $getDesignationRun=mysqli_query($conn,$getDesignation);
 while($row=mysqli_fetch_array($getDesignationRun))
 {
    ?>
<li onclick="show_emp_designation_wise(<?=$row['id'];?>)"><b><?=$row['name'];?></b></li>
    <?php
 }
mysqli_close($conn);
}
elseif ($code==10)
{
  $gettypes="SELECT * FROM master_categories where status='1' order by id ASC";
 $gettypesRun=mysqli_query($conn,$gettypes);
 while($row=mysqli_fetch_array($gettypesRun))
 {
    ?>
<li onclick="show_emp_types_wise(<?=$row['id'];?>)"><b><?=$row['name'];?></b></li>
    <?php
 }
mysqli_close($conn);
}
elseif ($code == 11) {
    $id = $_POST['id'];
    $gettypes = "SELECT users.id, users.emp_id, users.name, master_designation.name as designation,master_categories.name as typename, users.phone, users.email, users.status FROM users left join master_designation ON users.designation=master_designation.id left join master_categories ON users.type_id=master_categories.id WHERE users.designation = '$id' ORDER BY users.id ASC";
    $gettypesRun = mysqli_query($conn, $gettypes);
    $output = '';
    $srno = 1;
    if (mysqli_num_rows($gettypesRun) > 0) {
        $output .= '<table class="table table-bordered">';
        $output .= '<thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Emp ID</th>
                            <th>Designation</th>
                            <th>Type</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead><tbody>';
        while ($row = mysqli_fetch_array($gettypesRun)) {
            $output .= '<tr>
                            <td>' . $srno++ . '</td>
                            <td>' . htmlspecialchars($row['name']) . '</td>
                            <td>' . htmlspecialchars($row['emp_id']) . '</td>
                            <td>' . htmlspecialchars($row['designation']) . '</td>
                            <td>' . htmlspecialchars($row['typename']) . '</td>
                            <td>' . htmlspecialchars($row['phone']) . '</td>
                            <td>' . htmlspecialchars($row['email']) . '</td>
                            <td>' . ($row['status'] == 1 ? '<span class="badge bg-success text-white">Active</span>' : '<span class="badge bg-danger text-white">Inactive</span>') . '</td>
                            <td>
                            <button type="button" onclick="edit_employee_modal(' .$row['emp_id']. ');" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#modal-edit-employee">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            </button>  
                            </td>
                        </tr>';
        }
        $output .= '</tbody></table>';
    } else {
        $output .= '<p>No records found.</p>';
    }

    mysqli_close($conn);
    echo $output;
    exit;
}
elseif ($code == 12) {
    $limit = 10; // Records per page
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Count total records
    $countQuery = "SELECT COUNT(*) AS total 
                   FROM users 
                   LEFT JOIN master_designation ON users.designation = master_designation.id";
    $countResult = mysqli_query($conn, $countQuery);
    $rowCount = mysqli_fetch_assoc($countResult);
    $totalRecords = $rowCount['total'];
    $totalPages = ceil($totalRecords / $limit);

    // Fetch paginated records
    $gettypes = "SELECT users.id, users.emp_id, users.name, 
    master_designation.name as designation, users.phone, users.email, users.status 
    FROM users 
    LEFT JOIN master_designation ON users.designation = master_designation.id 
    LIMIT $limit OFFSET $offset";

    $gettypesRun = mysqli_query($conn, $gettypes);
    $output = '';
    $srno = $offset + 1;

    if (mysqli_num_rows($gettypesRun) > 0) {
        $output .= '<table class="table table-bordered table-striped">';
        $output .= '<thead class="table-dark">
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Emp ID</th>
                            <th>Designation</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead><tbody>';
        while ($row = mysqli_fetch_array($gettypesRun)) {
            $statusBadge = $row['status'] == 1 
                ? '<span class="badge text-white bg-success">Active</span>' 
                : '<span class="badge text-white bg-danger">Inactive</span>';

            $output .= '<tr>
                            <td>' . $srno++ . '</td>
                            <td>' . htmlspecialchars($row['name']) . '</td>
                            <td>' . htmlspecialchars($row['emp_id']) . '</td>
                            <td>' . htmlspecialchars($row['designation']) . '</td>
                            <td>' . htmlspecialchars($row['phone']) . '</td>
                            <td>' . htmlspecialchars($row['email']) . '</td>
                            <td>' . $statusBadge . '</td>
                            <td>
                                <button type="button" onclick="edit_employee_modal(' . $row['emp_id'] . ');" 
                                    class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-edit-employee">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" 
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                        stroke-linejoin="round" class="feather feather-edit">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>';
        }
        $output .= '</tbody></table>';

        // Pagination UI
        $output .= '<br><nav><ul class="pagination justify-content-center">';
        $prevPage = max(1, $page - 1);
        $nextPage = min($totalPages, $page + 1);

        // Prev
        $output .= '<li class="page-item ' . ($page == 1 ? 'disabled' : '') . '">
                        <a class="page-link" href="#" data-page="' . $prevPage . '">Previous</a>
                    </li>';

        // Pages
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            $output .= '<li class="page-item ' . $active . '">
                            <a class="page-link" href="#" data-page="' . $i . '">' . $i . '</a>
                        </li>';
        }

        // Next
        $output .= '<li class="page-item ' . ($page == $totalPages ? 'disabled' : '') . '">
                        <a class="page-link" href="#" data-page="' . $nextPage . '">Next</a>
                    </li>';

        $output .= '</ul></nav>';
    } else {
        $output .= '<p>No records found.</p>';
    }

    mysqli_close($conn);
    echo $output;
    exit;
}

elseif ($code == 13) {
    $id             = $_POST['id'];
    $designation    = $_POST['designation'];
    // $type           = $_POST['type'];
    $name           = $_POST['name'];
    $father_name    = $_POST['father_name'];
    $mother_name    = $_POST['mother_name'];
    $gender         = $_POST['gender'];
    $status         = $_POST['status'];
    // $role_id        = $_POST['role'];
    $dob            = $_POST['dob'];
    $aadhaar_number = $_POST['aadhaar_number'];
    $pan_number     = $_POST['pan_number'];
    $address        = $_POST['address'];
    $country        = $_POST['country'];
    $state          = $_POST['state'];
    $district       = $_POST['district'];
    $phone          = $_POST['phone'];
    $email          = $_POST['email'];
    $username = $email;
    $password = password_hash('User@123', PASSWORD_DEFAULT); // or any default

      // Duplicate checks
      $dupCheck = "SELECT * FROM users WHERE 
      emp_id = '$id' OR 
      pan_number = '$pan_number' OR 
      aadhaar_number = '$aadhaar_number' OR 
      email = '$email' OR 
      phone = '$phone'";

  $dupResult = mysqli_query($conn, $dupCheck);

  if (mysqli_num_rows($dupResult) > 0) {
      while ($row = mysqli_fetch_assoc($dupResult)) {
          if ($row['emp_id'] == $id) {
              echo "EMP_EXISTS";
              exit;
          } elseif ($row['pan_number'] == $pan_number) {
              echo "PAN_EXISTS";
              exit;
          } elseif ($row['aadhaar_number'] == $aadhaar_number) {
              echo "AADHAAR_EXISTS";
              exit;
          } elseif ($row['email'] == $email) {
              echo "EMAIL_EXISTS";
              exit;
          } elseif ($row['phone'] == $phone) {
              echo "PHONE_EXISTS";
              exit;
          }
      }
  }
    $query = "INSERT INTO users 
        (emp_id, name, designation,type_id,father_name, mother_name, gender, status, role_id, dob, aadhaar_number, pan_number, address, country, state, district, phone, email, username, password) 
        VALUES 
        ('$id', '$name','$designation','0', '$father_name', '$mother_name', '$gender', '$status', '0', '$dob', '$aadhaar_number', '$pan_number', '$address', '$country', '$state', '$district', '$phone', '$email', '$username', '$password')";

    if (mysqli_query($conn, $query)) {
        echo 1; // success
    } else {
        echo 0; // failure
    }

    mysqli_close($conn);
    exit;
}

elseif ($code == 14) {
    $id = $_POST['id'];
    // Get employee record
    $query = "SELECT users.*, users.id AS user_id, users.emp_id, users.name, 
    -- master_categories.name AS typename, 
    master_designation.name AS designation_name ,master_designation.id as des_id
FROM users 
-- LEFT JOIN master_categories ON users.type_id = master_categories.id 
LEFT JOIN master_designation ON users.designation = master_designation.id  
WHERE emp_id = '$id' 
LIMIT 1";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
    ?>
    <!-- Store the original ID in hidden field for reference during update -->
    <input type="hidden" id="edit_hidden_id" value="<?= $data['emp_id'] ?>">

    <div class="row ">
      <div class="col-md-6">
        <label class="form-label">Employee ID</label>
        <input type="number" id="createempid" class="form-control" value="<?= $data['emp_id'] ?>" readonly>
      </div>

      <div class="col-md-3">
        <label class="form-label">Designation</label>
        <select id="editdesignation" class="form-select">
          <option value="">Select</option>
          <?php 
          $getDesignation = "SELECT * FROM master_designation WHERE status = '1' ORDER BY id ASC";
          $getDesignationRun = mysqli_query($conn, $getDesignation);
          while ($row = mysqli_fetch_array($getDesignationRun)) {
              $selected = ($row['id'] == $data['des_id']) ? 'selected' : '';
              echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
          } ?>
        </select>
      </div>

      <!-- <div class="col-md-3">
        <label class="form-label">Type</label>
        <select id="edittype" class="form-select">
  <option value="">Select</option>
  <?php
  $gettypes = "SELECT * FROM master_categories WHERE status='1' ORDER BY id ASC";
  $gettypesRun = mysqli_query($conn, $gettypes);
  while($row = mysqli_fetch_array($gettypesRun)) {
      $selected = ($row['id'] == $data['type_id']) ? 'selected' : '';
      echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
  }
  ?>
</select>

      </div> -->
      <div class="col-md-3">
        <label class="form-label">Status</label>
        <select id="editStatus" class="form-select">
          <option value="">Select Status</option>
          <option value="1" <?= ($data['status'] == '1') ? 'selected' : '' ?>>Active</option>
          <option value="0" <?= ($data['status'] == '0') ? 'selected' : '' ?>>DeActive</option>
        </select>
      </div>
     
      <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" id="editname" class="form-control" value="<?= $data['name'] ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">Father's Name</label>
        <input type="text" id="editfather_name" class="form-control" value="<?= $data['father_name'] ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">Mother's Name</label>
        <input type="text" id="editmother_name" class="form-control" value="<?= $data['mother_name'] ?>">
      </div>

      <div class="col-md-3">
        <label class="form-label">Gender</label>
        <select id="editgender" class="form-select">
          <option value="">Select Gender</option>
          <option value="male" <?= ($data['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
          <option value="female" <?= ($data['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
          <option value="other" <?= ($data['gender'] == 'other') ? 'selected' : '' ?>>Other</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Date of Birth</label>
        <input type="date" id="editdob" class="form-control" value="<?= $data['dob'] ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">Aadhaar Number</label>
        <input type="text" id="editaadhaar_number" class="form-control" value="<?= $data['aadhaar_number'] ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">PAN Number</label>
        <input type="text" id="editpan_number" class="form-control" value="<?= $data['pan_number'] ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" id="editphone" class="form-control" value="<?= $data['phone'] ?>">
      </div>

      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" id="editemail" class="form-control" value="<?= $data['email'] ?>">
      </div>

      <div class="col-md-12">
        <label class="form-label">Address</label>
        <input type="text" id="editaddress" class="form-control" value="<?= $data['address'] ?>">
      </div>

      <div class="col-md-3">
        <label class="form-label">Country</label>
        <input type="text" id="editcountry" class="form-control" value="<?= $data['country'] ?>">
      </div>

      <div class="col-md-3">
        <label class="form-label">State</label>
        <input type="text" id="editstate" class="form-control" value="<?= $data['state'] ?>">
      </div>

      <div class="col-md-3">
        <label class="form-label">District</label>
        <input type="text" id="editdistrict" class="form-control" value="<?= $data['district'] ?>">
      </div>

     
    </div>
    </div>
<?php } 


elseif ($code == 15) {
    $id             = $_POST['id'];
    $designation    = $_POST['designation'];
    // $type           = $_POST['type'];
    $name           = $_POST['name'];
    $father_name    = $_POST['father_name'];
    $mother_name    = $_POST['mother_name'];
    $gender         = $_POST['gender'];
    $status         = $_POST['status'];
    // $role_id        = $_POST['role'];
    $dob            = $_POST['dob'];
    $aadhaar_number = $_POST['aadhaar_number'];
    $pan_number     = $_POST['pan_number'];
    $address        = $_POST['address'];
    $country        = $_POST['country'];
    $state          = $_POST['state'];
    $district       = $_POST['district'];
    $phone          = $_POST['phone'];
    $email          = $_POST['email'];

    $dupCheck = "SELECT * FROM users WHERE (
        emp_id = '$id' OR 
        pan_number = '$pan_number' OR 
        aadhaar_number = '$aadhaar_number' OR 
        email = '$email' OR 
        phone = '$phone'
    ) AND emp_id != '$id'";
    

  $dupResult = mysqli_query($conn, $dupCheck);

  if (mysqli_num_rows($dupResult) > 0) {
      while ($row = mysqli_fetch_assoc($dupResult)) {
          if ($row['emp_id'] == $id) {
              echo "EMP_EXISTS";
              exit;
          } elseif ($row['pan_number'] == $pan_number) {
              echo "PAN_EXISTS";
              exit;
          } elseif ($row['aadhaar_number'] == $aadhaar_number) {
              echo "AADHAAR_EXISTS";
              exit;
          } elseif ($row['email'] == $email) {
              echo "EMAIL_EXISTS";
              exit;
          } elseif ($row['phone'] == $phone) {
              echo "PHONE_EXISTS";
              exit;
          }
      }
  }
   $query = "UPDATE users SET 
  name = '$name',
  designation = '$designation',
  father_name = '$father_name',
  mother_name = '$mother_name',
  gender = '$gender',
  status = '$status',
  dob = '$dob',
  aadhaar_number = '$aadhaar_number',
  pan_number = '$pan_number',
  address = '$address',
  country = '$country',
  state = '$state',
  district = '$district',
  phone = '$phone',
  email = '$email'
WHERE emp_id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo 1; // success
    } else {
        echo 0; // failure
    }

    mysqli_close($conn);
    exit;
}

else if ($code==16) 
{
$empID=$_POST['emp_id'];
$count=0;
 $sql="SELECT *,master_categories.ID as MCID from master_categories left join  category_permissions on category_permissions.category_id=master_categories.id where emp_id='$empID'";
$res=mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($res))
{
    $qrqr=$data['MCID'];
    $permissionID[]=$qrqr;
         $aa=array();

    $qry="SELECT * from master_categories where id!='$qrqr'";
    $run=mysqli_query($conn,$qry);
    while($data1=mysqli_fetch_array($run))
    {
         $id=$data1['id'];
        if(!in_array($id, $permissionID))
        {
            $aa[]=$id;
        }
    }
}
if (isset($aa)) {
//print_r($aa);
// code...
$count= count($aa);
}
?>
<input type="hidden" id="empID" value="<?=$empID?>">
<input type="hidden" id="code" value="57">
<div class="row">
<div class="col-lg-6">
   <label>Category</label>
   <select id="Category" class="form-control" required>
      <option value="">Select</option>
      <?php
         if ($count>0) 
         {
             
         
             for ($i=0; $i < $count; $i++) 
         { 
             $q="SELECT * from master_categories where id='$aa[$i]'";
             $w=mysqli_query($conn,$q);
             while($d=mysqli_fetch_array($w))
             {
                 ?>
      <option value="<?=$d['id']?>"><?=$d['name']?></option>
      <?php
         }
         }
         }
         else
         {
         $q="SELECT * from master_categories";
         $w=mysqli_query($conn,$q);
         while($d=mysqli_fetch_array($w))
         {
             ?>
      <option value="<?=$d['id']?>"><?=$d['name']?></option>
      <?php
         }
         }
         ?>
   </select>
</div>
<div class="col-lg-6">
   <label>Admin</label>
   <select class="form-control" id="admin" required>
      <option value="0">No</option>
      <option value="1">Yes</option>
   </select>
</div>
</div>
<br>
<table class="table" border="1">
            <tr>
               <th>Category</th>
               <th>Admin</th>
               <th>Delete</th>
            </tr>
            <?php
               $sql="SELECT *,category_permissions.id as CPID,master_categories.name as cname  from category_permissions inner join master_categories on category_permissions.category_id=master_categories.id where emp_id='$empID'";
               $res=mysqli_query($conn,$sql);
               while($data=mysqli_fetch_array($res))
               {   
                   if ($data['is_admin']=='0') 
                   {
                       $admin='No';
                   }
                   elseif ($data['is_admin']=='1') 
                   {
                       $admin='Yes';
                   }
                  
                   ?>
            <tr>
               <td><?= $data['cname']?></td>
               <td><?= $admin?></td>

               <td><button class="btn btn-danger" type="button" onclick="deleteCategoryPermission(<?=$data['CPID']; ?>,<?=$empID ?>)"  style="">
                 Delete </button>
               </td>
            </tr>
            <?php
               }
               ?>
         </table>
<?php
mysqli_close($conn);
}

elseif ($code==17) 
{
       $empID=$_POST['emp_id'];
       $category=$_POST['Category'];
       $admin=$_POST['admin'];
      //  $mail=$_POST['mail'];
       $sql="INSERT INTO category_permissions (emp_id, category_id,is_admin) VALUES ('$empID', '$category', '$admin');";
        mysqli_query($conn,$sql);

mysqli_close($conn);
}
else if ($code==18) 
{
$ID=$_POST['ID'];
$staff="Delete FROM category_permissions Where id='$ID'";
mysqli_query($conn,$staff);  
mysqli_close($conn);
}

elseif ($code == 19) {
    $limit = 10; // Records per page
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $start = ($page - 1) * $limit;

     $gettypes = "SELECT SQL_CALC_FOUND_ROWS *, 
        master_categories.name as category_name, tasks.id as task_id, task_assignments.status as task_status, 
        tasks.location_id as l_id, users.phone, users.email, users.status 
        FROM users  
        INNER JOIN tasks ON users.emp_id = tasks.created_by 
        left join task_assignments ON  task_assignments.task_id=tasks.id 
        INNER JOIN master_categories ON master_categories.id = tasks.task_type_id 
        WHERE tasks.created_by = '$user_id' order by tasks.id DESC 
        LIMIT $start, $limit ";

    $gettypesRun = mysqli_query($conn, $gettypes);
    $totalResult = mysqli_query($conn, "SELECT FOUND_ROWS() as total");
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalPages = ceil($totalRow['total'] / $limit);

    $output = '';
    $srno = $start + 1;

    if (mysqli_num_rows($gettypesRun) > 0) {
        $output .= '<table class="table table-bordered table-striped align-middle text-center">
                      <thead class="table-dark">
                          <tr>
                              <th>Sr No</th>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Category</th>
                              <th>Location</th>
                              <th>GPS Required</th>
                              <th>Status</th>
                          </tr>
                      </thead><tbody>';

        while ($row = mysqli_fetch_array($gettypesRun)) {
            $ID = $row['l_id'];
            $location = "SELECT *, rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo,
                            lm.ID as L_ID FROM location_master lm 
                            INNER JOIN room_master rm on lm.Floor = rm.FloorID 
                            INNER JOIN room_name_master rnm on lm.RoomName = rnm.ID 
                            INNER JOIN room_type_master rtm on lm.Type = rtm.ID 
                            INNER JOIN building_master bm on lm.Block = bm.ID 
                            WHERE lm.ID = '$ID'";
            $location_run = mysqli_query($conn, $location);
            $Name = $FloorName = $RoomNo = $RoomType = $RoomName = '';

            if ($location_row = mysqli_fetch_array($location_run)) {
                $Name = $location_row['Name'];
                $FloorName = $location_row['FloorName'];
                $RoomNo = $location_row['RoomNo'];
                $RoomType = $location_row['RoomType'];
                $RoomName = $location_row['RoomName'];
            }

            // Task Status Badge
            $statusText = '';
            $badgeColor = '';
            switch ($row['task_status']) {
                case 'pending':
                    $statusText = 'Pending';
                    $badgeColor = 'secondary';
                    break;
                case 'in_progress':
                    $statusText = 'In Progress';
                    $badgeColor = 'warning';
                    break;
                case 'completed':
                    $statusText = 'Completed';
                    $badgeColor = 'success';
                    break;
                default:
                    $statusText = 'Not Assigned';
                    $badgeColor = 'dark';
                    break;
            }

            $output .= '<tr>
                <td>' . $srno++ . '</td>
                <td>' . htmlspecialchars($row['title']) . '</td>
                <td>' . htmlspecialchars($row['description']) . '</td>
                <td>' . htmlspecialchars($row['category_name']) . '</td>
                <td>' . $Name . '-' . $RoomNo . '-' . $FloorName . '-' . $RoomType . '-' . $RoomName . '</td>
              <td>' . (($row['checkin_required'] == 1 || $row['checkout_required'] == 1) ? 'Yes' : 'No') . '</td>

                <td><span class="badge text-white bg-' . $badgeColor . '">' . $statusText . '</span></td>
            </tr>';
        }
        $output .= '</tbody></table>';

        // Pagination links
        $output .= '<br><nav><ul class="pagination justify-content-center">';
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            $output .= '<li class="page-item ' . $active . '"><a class="page-link" href="#" onclick="loadTasks(' . $i . ')">' . $i . '</a></li>';
        }
        $output .= '</ul></nav>';
    } else {
        $output .= '<p class="text-danger text-center">No records found.</p>';
    }

    echo $output;
    exit;
}

elseif ($code == 20) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $building = $_POST['building'];
    $floor = $_POST['floor'];
    $room = $_POST['room'];
    $roomType = $_POST['roomType'];
  
    // Use the new gps_required field for both checkin and checkout
    $gps_required = isset($_POST['gps_required']) ? $_POST['gps_required'] : 0;
    $checkin_required = $gps_required;
    $checkout_required = $gps_required;
  
    $dupCheck = "SELECT * FROM location_master 
                 WHERE Block = '$building' AND Floor = '$floor' AND RoomNo = '$room' AND Type = '$roomType'";
  
    $dupResult = mysqli_query($conn, $dupCheck);
  
    while ($row = mysqli_fetch_assoc($dupResult)) {
      $location_id = $row['ID'];
    }
  
    $query = "INSERT INTO `tasks` (`title`, `description`, `task_type_id`, `location_id`, `checkin_required`, `checkout_required`, `created_by`, `created_at`) 
              VALUES ('$title', '$description', '$category', '$location_id', '$checkin_required', '$checkout_required', '$user_id', NOW())";
  
    if (mysqli_query($conn, $query)) {
      echo 1; // success
    } else {
      echo 0; // failure
    }
  
    mysqli_close($conn);
    exit;
  }
  
// elseif ($code == 20) {
//   $title=$_POST['title'];
//   $description=$_POST['description'];
//   $category=$_POST['category'];
//   $building=$_POST['building'];
//   $floor=$_POST['floor'];
//   $room=$_POST['room'];
//   $roomType=$_POST['roomType'];
//   $checkin_required=$_POST['checkin_required'];
//   $checkout_required=$_POST['checkout_required'];
//   $dupCheck = "SELECT * FROM location_master WHERE 
//     Block = '$building' and Floor = '$floor' and  RoomNo = '$room' and Type='$roomType'";

// $dupResult = mysqli_query($conn, $dupCheck);

//     while ($row = mysqli_fetch_assoc($dupResult)) {
//            $location_id=$row['ID'];
//     }
//   $query = "INSERT INTO `tasks`(`title`, `description`, `task_type_id`, `location_id`, `checkin_required`, `checkout_required`, `created_by`, `created_at`) 
//   VALUES ('$title','$description','$category','$location_id','$checkin_required','$checkout_required','$user_id',NOW())";

//   if (mysqli_query($conn, $query)) {
//       echo 1; // success
//   } else {
//       echo 0; // failure
//   }

//   mysqli_close($conn);
//   exit;
// }

elseif($code=='21')
{
     $building=$_POST['building'];
     ?>
<option value="">Select Floor</option>
<?php
$floor_qry="Select distinct Floor from location_master where Block='$building'";
// $floor_qry="SELECT distinct location_master.Floor from location_master INNER JOIN tasks ON tasks.location_id=location_master.Floor where location_master.Block='$building'";
$res_floor=mysqli_query($conn,$floor_qry);
while ($floorData=mysqli_fetch_array($res_floor)) 
{
   $floorValue=$floorData['Floor'];
   if ($floorValue=='0') 
      {
         $floorName='Ground';
      }  
      elseif ($floorValue=='1') 
      {
         $floorName='First';
      }  
      elseif ($floorValue=='2') 
      {
         $floorName='Second';
      }  
      elseif ($floorValue=='3') 
      {
         $floorName='Third';
      } 
        elseif ($floorValue=='4') 
       {
          $floorName='Fourth';
       }
       elseif ($floorValue=='5') 
       {
          $floorName='Fifth';
       } 
      if (isset($floorName)) 
      {
          // code...
      
      ?>
<option value="<?=$floorValue?>"><?=$floorName?></option>
<?php
}
}
mysqli_close($conn);
}
elseif($code=='22')
{
$building=$_POST['building'];
$floor=$_POST['floor'];
?>
<option value="">Select Room No.</option>
<?php
if ($floor!='') 
{
    $room_qry="Select RoomNo from location_master where Block='$building' and Floor='$floor'";
    // $room_qry="SELECT distinct location_master.RoomNo from location_master INNER JOIN tasks ON tasks.location_id=location_master.ID
    //  where location_master.Block='$building' and location_master.Floor='$floor'";
}
else
{
    $room_qry="Select RoomNo from location_master where Block='$building'";
}
$res_room=mysqli_query($conn,$room_qry);
while ($roomData=mysqli_fetch_array($res_room)) 
{
   $roomValue=$roomData['RoomNo'];
   ?>
<option value="<?=$roomValue?>"><?=$roomValue?></option>
<?php
} 
mysqli_close($conn);
}
elseif($code=='23')
{
$building=$_POST['block'];
$floor=$_POST['floor'];
$room=$_POST['roomNo'];
?>
<option value="">Select Room Type</option>
<?php

    $room_qry="Select room_name_master.RoomName,RoomType,room_type_master.ID as type_id from location_master inner join room_type_master ON room_type_master.ID=location_master.Type inner join room_name_master ON room_name_master.ID=location_master.RoomName where Block='$building' and Floor='$floor' and RoomNo='$room'";

$res_room=mysqli_query($conn,$room_qry);
while ($roomData=mysqli_fetch_array($res_room)) 
{
   $roomValue=$roomData['RoomType'];
   $type_id=$roomData['type_id'];
   $RoomName=$roomData['RoomName'];
   ?>
<option value="<?=$type_id?>"><?=$roomValue?>(<?=$RoomName;?>)</option>
<?php
} 
mysqli_close($conn);
}
elseif($code=='24')
{
$id=$_POST['category'];
?>
<option value="">Select Staff Name</option>
<?php
          $res = mysqli_query($conn, "SELECT DISTINCT users.emp_id, name FROM users inner join category_permissions ON
          category_permissions.emp_id=users.emp_id where category_permissions.is_admin='0' and category_permissions.category_id='$id' ORDER BY name ASC");
          while ($row = mysqli_fetch_assoc($res)) {
            $emp_id=$row['emp_id'];
            $emp_name=$row['name'];
            ?>
             <div class="form-check" onchange="updateEmployeeButton()">
          <input class="form-check-input" type="checkbox" name="employee_id[]" data-title="<?= $emp_name ?>" value="<?= $emp_id ?>" id="emp<?= $emp_id ?>">
          <label class="form-check-label"  for="emp<?= $emp_id ?>">
            <?= $emp_name ?> (<?= $emp_id ?>)
          </label>
        </div>
        <?php
            // echo "<option value='{$row['emp_id']}'>{$row['name']} ({$row['emp_id']})</option>";
          }
           
mysqli_close($conn);
}
elseif($code=='25')
{
$building=$_POST['block'];
$floor=$_POST['floor'];
$room=$_POST['roomNo'];
$roomType=$_POST['roomType'];
?>
<option value="">Select Task Name</option>
<?php
  $dupCheck = "SELECT * FROM location_master WHERE 
  Block = '$building' and Floor = '$floor' and  RoomNo = '$room' and Type='$roomType'";

$dupResult = mysqli_query($conn, $dupCheck);

  if ($row = mysqli_fetch_assoc($dupResult)) {
         $location_id=$row['ID'];
         $location = "SELECT 
         tasks.id AS tid, 
         tasks.title, 
         rm.Floor AS FloorName, 
         rm.RoomNo AS abc, 
         lm.RoomNo AS RoomNo, 
         lm.ID AS L_ID, 
         rtm.RoomType, 
         rnm.RoomName, 
         bm.Name 
     FROM tasks 
     LEFT JOIN task_assignments ON task_assignments.task_id = tasks.id 
     INNER JOIN location_master lm ON tasks.location_id = lm.ID 
     INNER JOIN room_master rm ON lm.Floor = rm.FloorID 
     INNER JOIN room_name_master rnm ON lm.RoomName = rnm.ID 
     INNER JOIN room_type_master rtm ON lm.Type = rtm.ID 
     INNER JOIN building_master bm ON lm.Block = bm.ID 
     WHERE lm.ID = '$location_id' 
       AND tasks.created_by = '$user_id' 
       AND (task_assignments.status = 'pending' OR task_assignments.status IS NULL)
     GROUP BY tasks.id";
     
     
         $location_run=mysqli_query($conn,$location);
         while ($location_row=mysqli_fetch_array($location_run)) 
         {
            $LocationID=$location_row['L_ID'];
       $Name=$location_row['Name'];
       $FloorName=$location_row['FloorName'];
       $RoomNo=$location_row['RoomNo'];
       $RoomType=$location_row['RoomType'];         
       $RoomName=$location_row['RoomName'];         
       $title=$location_row['title'];
       $tid=$location_row['tid'];
       $RoomName=$location_row['RoomName'];
       ?>
          <div class="form-check" onchange="updateTaskButton()">
          <input class="form-check-input" type="checkbox" name="task_id[]" value="<?= $tid ?>" id="task<?= $tid ?>" data-title="<?= $title ?>">
          <label class="form-check-label" for="task<?= $tid ?>">
            <?= $title ?> (<?= $tid ?>)
          </label>
        </div>
      
       <!-- <option value="<?=$tid?>"><?=$title?>(<?=$tid;?>)</option> -->
       <?php
     }
  
 
} 
mysqli_close($conn);
}
elseif ($code==26) {

$category = $_POST['category'] ?? '';
$hostel = $_POST['hostel'] ?? '';
$floor = $_POST['floor'] ?? '';
$room = $_POST['room'] ?? '';
$roomType = $_POST['roomType'] ?? '';
$task_ids = json_decode($_POST['task_ids'] ?? '[]', true);
$employee_ids = json_decode($_POST['employee_ids'] ?? '[]', true);


if (!$category || empty($task_ids) || empty($employee_ids)) {
  echo "2";
  exit;
}

$inserted = 0;
$skipped = 0;
foreach ($employee_ids as $emp_id) {
  foreach ($task_ids as $task_id) {

    $check_sql = "SELECT 1 FROM task_assignments 
WHERE user_id='$emp_id' AND task_id='$task_id'";
$check_res = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_res) == 0) {
  $query = "INSERT INTO task_assignments (task_id, user_id,status,assigned_at) 
            VALUES ('$task_id', '$emp_id','pending',NOW())";
  mysqli_query($conn, $query);
  $inserted++;
  
}
else{
  $skipped++;
}
  }
}

echo "Inserted: $inserted, Skipped (already assigned): $skipped Tasks";
}

elseif ($code == 27) {
    
 $gettypes = "SELECT *,task_assignments.status as task_status, master_categories.name as category_name,tasks.location_id as l_id,users.phone, users.email, users.status FROM users INNER JOIN tasks ON users.emp_id = tasks.created_by INNER join master_categories ON master_categories.id=tasks.task_type_id INNER JOIN task_assignments ON task_assignments.task_id=tasks.id where users.emp_id='$user_id'
  ";
  $gettypesRun = mysqli_query($conn, $gettypes);
  $output = '';
  $srno = 1;
  if (mysqli_num_rows($gettypesRun) > 0) {
      $output .= '<table class="table table-bordered">';
      $output .= '<thead>
                      <tr>
                          <th>Sr No</th>
                          <th>Assign To</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Category name</th>
                          <th>Location</th>
                          <th>Action</th>
                         
                        
                      </tr>
                  </thead><tbody>';
      while ($row = mysqli_fetch_array($gettypesRun)) {
        $status = $row['task_status'];
        switch ($status) {
          case 'pending':
              $rowColor = '#f8d7da'; // light red
              break;
          case 'accepted':
              $rowColor = '#d1ecf1'; // light blue
              break;
          case 'rejected':
              $rowColor = '#f5c6cb'; // pinkish
              break;
          case 'in_progress':
              $rowColor = '#faeb78'; // pinkish
              break;
          case 'completed':
              $rowColor = '#bcf983'; // light green
              break;
          default:
              $rowColor = '#ffffff'; // white
              break;
      }
        $ID=$row['l_id'];
         $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo ,lm.ID as L_ID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID where lm.ID='$ID'";
                    
                        $location_run=mysqli_query($conn,$location);
                        if ($location_row=mysqli_fetch_array($location_run)) 
                        {
                           $LocationID=$location_row['L_ID'];
                      $Name=$location_row['Name'];
                      $FloorName=$location_row['FloorName'];
                      $RoomNo=$location_row['RoomNo'];
                      $RoomType=$location_row['RoomType'];         
                      $RoomName=$location_row['RoomName'];         
                   
                    }
                    $output .= '<tr style="background-color: ' . $rowColor . ';">
                    <td>' . $srno++ . '</td>
                    <td>' . htmlspecialchars($row['user_id']) . '</td>
                    <td>' . htmlspecialchars($row['title']) . '</td>
                    <td>' . htmlspecialchars($row['description']) . '</td>
                    <td>' . htmlspecialchars($row['category_name']) . '</td>
                    <td>' . $Name . '-' . $FloorName . '-'.$RoomNo.'-' . $RoomType . '-' . $RoomName . '</td>
                    <td>' . htmlspecialchars($row['task_status']) . '</td>
                   
                </tr>';
                
      }
      $output .= '</tbody></table>';
  } else {
      $output .= '<p>No records found.</p>';
  }

  mysqli_close($conn);
  echo $output;
  exit;
}
elseif ($code == 28) { // pending
    
  $gettypes = "SELECT *,tasks.id as  task_a_id ,task_assignments.status as task_status, master_categories.name as
   category_name,tasks.location_id as l_id,users.phone, users.email, users.status
    FROM users INNER JOIN tasks ON users.emp_id = tasks.created_by
     INNER join master_categories ON master_categories.id=tasks.task_type_id
      INNER JOIN task_assignments ON task_assignments.task_id=tasks.id
       where users.emp_id='$user_id' and task_assignments.status='pending' order by task_assignments.id DESC
   ";
   $gettypesRun = mysqli_query($conn, $gettypes);
   $output = '';
   $srno = 1;
   if (mysqli_num_rows($gettypesRun) > 0) {
       $output .= '<table class="table table-bordered" >';
       $output .= '<thead>
                       <tr>
                           <th>Sr No</th>
                           <th>Assign To</th>
                           <th>Title</th>
                           <th>Description</th>
                           <th>Category name</th>
                           <th>Location</th>
                           <th>Status</th>
                           <th>Action</th>
                          
                         
                       </tr>
                   </thead><tbody>';
       while ($row = mysqli_fetch_array($gettypesRun)) {
 
         $ID=$row['l_id'];
          $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo ,lm.ID as L_ID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID where lm.ID='$ID'";
                     
                         $location_run=mysqli_query($conn,$location);
                         if ($location_row=mysqli_fetch_array($location_run)) 
                         {
                            $LocationID=$location_row['L_ID'];
                       $Name=$location_row['Name'];
                       $FloorName=$location_row['FloorName'];
                       $RoomNo=$location_row['RoomNo'];
                       $RoomType=$location_row['RoomType'];         
                       $RoomName=$location_row['RoomName'];         
                    
                     }
                     $output .= '<tr style="background-color:#fdac9f">
                     <td>' . $srno++ . '</td>
                     <td>' . htmlspecialchars($row['user_id']) . '</td>
                     <td>' . htmlspecialchars($row['title']) . '</td>
                     <td>' . htmlspecialchars($row['description']) . '</td>
                     <td>' . htmlspecialchars($row['category_name']) . '</td>
                     <td>' . $Name . '-' . $FloorName . '-'.$RoomNo.'-' . $RoomType . '-' . $RoomName . '</td>
                     <td>' . htmlspecialchars($row['task_status']) . '</td>
                     <td><input type="button" onclick="unAssign('.$row['task_a_id'].','.$row['user_id'].');" class="btn btn-danger" value="UnAssign"></td>
                    
                 </tr>';
                 
       }
       $output .= '</tbody></table>';
   } else {
       $output .= '<p>No records found.</p>';
   }
 
   mysqli_close($conn);
   echo $output;
   exit;
 }

 elseif ($code == 29) { // inprogress
    
  $gettypes = "SELECT *,checkins.*,task_assignments.status as task_status, master_categories.name as category_name,tasks.location_id as l_id,users.phone, users.email, users.status FROM users 
  INNER JOIN tasks ON users.emp_id = tasks.created_by 
  INNER join master_categories ON master_categories.id=tasks.task_type_id 
  INNER JOIN task_assignments ON task_assignments.task_id=tasks.id 
    INNER join checkins ON task_assignments.id=checkins.assignment_id 
  where users.emp_id='$user_id' and (task_assignments.status='in_progress'or task_assignments.status='accepted')
   order by task_assignments.id DESC ";
   $gettypesRun = mysqli_query($conn, $gettypes);
   $output = '';
   $srno = 1;
   if (mysqli_num_rows($gettypesRun) > 0) {
       $output .= '<table class="table table-bordered" >';
       $output .= '<thead>
                       <tr>
                           <th>Sr No</th>
                           <th>Assign To</th>
                           <th>Title</th>
                           <th>Description</th>
                           <th>Category name</th>
                           <th>Location</th>
                           <th>Action</th>
                           <th>Action</th>
                          
                         
                       </tr>
                   </thead><tbody>';
       while ($row = mysqli_fetch_array($gettypesRun)) {
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
        $mapUrl = "https://maps.google.com/maps?q=$latitude,$longitude&z=15&output=embed";
        $checkOutMapUrl=null;
         $ID=$row['l_id'];
          $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo ,lm.ID as L_ID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID where lm.ID='$ID'";
                     
                         $location_run=mysqli_query($conn,$location);
                         if ($location_row=mysqli_fetch_array($location_run)) 
                         {
                            $LocationID=$location_row['L_ID'];
                       $Name=$location_row['Name'];
                       $FloorName=$location_row['FloorName'];
                       $RoomNo=$location_row['RoomNo'];
                       $RoomType=$location_row['RoomType'];         
                       $RoomName=$location_row['RoomName'];         
                    
                     }

                    
                     
                     $output .= '<tr style="background-color:#faeb78">
                     <td>' . $srno++ . '</td>
                     <td>' . htmlspecialchars($row['user_id']) . '</td>
                     <td>' . htmlspecialchars($row['title']) . '</td>
                     <td>' . htmlspecialchars($row['description']) . '</td>
                     <td>' . htmlspecialchars($row['category_name']) . '</td>
                     <td>' . $Name . '-' . $FloorName . '-'.$RoomNo.'-' . $RoomType . '-' . $RoomName . '</td>
                     <td>' . htmlspecialchars($row['task_status']) . '</td>';
                     if (
                      !empty($latitude) && $latitude != 0 &&
                      !empty($longitude) && $longitude != 0
                  ) {
                      $output .= '<td>
                          <button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#locationModal"
                              onclick="showBothMaps(\'' . $mapUrl . '\', \'' . $checkOutMapUrl . '\')">
                              GPS Locations
                          </button>
                      </td>';
                  } else {
                      $output .= '<td><span class="text-muted">No GPS</span></td>';
                  }
                 $output.='</tr>';
                 
       }
       $output .= '</tbody></table>';
   } else {
       $output .= '<p>No records found.</p>';
   }
 
   mysqli_close($conn);
   echo $output;
   exit;
 }
//  elseif ($code == 30) {  //complete
    
//   $gettypes = "SELECT *,task_assignments.status as task_status,
//   task_assignments.task_id as task_s_id,
//   task_assignments.id as task_a_id,
//         task_assignments.remarks,
//       task_assignments.work_image,
//    checkins.latitude as latitudeCheckIn,
//       checkins.longitude as longitudeCheckIn,
//       checkouts.latitude as latitudeCheckOut,
//       checkouts.longitude as longitudeCheckOut,
//        master_categories.name as category_name,tasks.location_id as l_id,users.phone, users.email, users.status FROM users 
//   INNER JOIN tasks ON users.emp_id = tasks.created_by
//    INNER join master_categories ON master_categories.id=tasks.task_type_id 
//    INNER JOIN task_assignments ON task_assignments.task_id=tasks.id 
//      INNER JOIN checkins ON task_assignments.id = checkins.assignment_id 
//   LEFT JOIN checkouts ON task_assignments.id = checkouts.assignment_id 
//    where users.emp_id='$user_id' and task_assignments.status='completed'
//    ";
//    $gettypesRun = mysqli_query($conn, $gettypes);
//    $output = '';
//    $srno = 1;
//    if (mysqli_num_rows($gettypesRun) > 0) {
//        $output .= '<table class="table table-bordered">';
//        $output .= '<thead>
//                        <tr>
//                            <th>Sr No</th>
//                            <th>Assign To</th>
//                            <th>Title</th>
//                            <th>Description</th>
//                            <th>Category name</th>
//                            <th>Location</th>
//                             <th>Accept Time</th>
//                           <th>Start Time</th>
//                           <th>Complete Time</th>
                          
//                           <th>Duration</th>
//                            <th>Status</th>
//                            <th>Image</th>
//                            <th>Action</th>
                          
                         
//                        </tr>
//                    </thead><tbody>';
//        while ($row = mysqli_fetch_array($gettypesRun)) {
//         $latitudeCheckIn = $row['latitudeCheckIn'];
//         $longitudeCheckIn = $row['longitudeCheckIn'];
//         $latitudeCheckOut = $row['latitudeCheckOut'];
//         $longitudeCheckOut = $row['longitudeCheckOut'];

//         $checkInMapUrl = "https://maps.google.com/maps?q=$latitudeCheckIn,$longitudeCheckIn&z=15&output=embed";
//         $checkOutMapUrl = "https://maps.google.com/maps?q=$latitudeCheckOut,$longitudeCheckOut&z=15&output=embed";

//         $getTimes="SELECT 
//         id,
//         task_id,
//         user_id,
//         status,
//         assigned_at,
//         accepted_at,
//         rejected_at,
//         start_at,
//         compete_at,
      
//         TIMEDIFF(accepted_at, assigned_at) AS time_to_accept,
//         TIMEDIFF(start_at, accepted_at) AS time_to_start,
//         TIMEDIFF(compete_at, start_at) AS time_to_complete,
//         TIMEDIFF(compete_at, assigned_at) AS total_duration
      
//       FROM task_assignments
//       WHERE compete_at IS NOT NULL AND task_id = '".$row['task_s_id']."';
//       ";
//       $getTimesRun = mysqli_query($conn, $getTimes);
//       if ($getTimesRunRow = mysqli_fetch_array($getTimesRun)) {
      
//         $accept_at=$getTimesRunRow['accepted_at'];
//         $total_duration=$getTimesRunRow['total_duration'];
//         $start_at=$getTimesRunRow['start_at'];
//         $compete_at=$getTimesRunRow['compete_at'];
//       }
//          $ID=$row['l_id'];
//           $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo ,lm.ID as L_ID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID where lm.ID='$ID'";
                     
//                          $location_run=mysqli_query($conn,$location);
//                          if ($location_row=mysqli_fetch_array($location_run)) 
//                          {
//                             $LocationID=$location_row['L_ID'];
//                        $Name=$location_row['Name'];
//                        $FloorName=$location_row['FloorName'];
//                        $RoomNo=$location_row['RoomNo'];
//                        $RoomType=$location_row['RoomType'];         
//                        $RoomName=$location_row['RoomName'];         
                    
//                      }
//                      $output .= '<tr style="background-color:#bcf983">
//                      <td>' . $srno++ . '</td>
//                      <td>' . htmlspecialchars($row['user_id']) . '</td>
//                      <td>' . htmlspecialchars($row['title']) . '</td>
//                      <td>' . htmlspecialchars($row['description']) . '</td>
//                      <td>' . htmlspecialchars($row['category_name']) . '</td>
//                      <td>' . $Name . '-' . $FloorName . '-'.$RoomNo.'-' . $RoomType . '-' . $RoomName . '</td>
                       
//               <td>' . htmlspecialchars($accept_at) . '</td>
//               <td>' . htmlspecialchars($start_at) . '</td>
//               <td>' . htmlspecialchars($compete_at) . '</td>
//               <td>' .$total_duration . '</td>
//                      <td>' . htmlspecialchars($row['task_status']) . '</td><td>';
// if($row['work_image']!=''){
//                      $output .= '<button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#viewTaskModal"
//                      onclick="viewTaskDetails(' . $row['task_a_id'] . ')">
//                     View
//                  </button>';
// }
// else{
//   $output.= 'No Image';
// }
// $output.='</td>';
//                      if (
//                       !empty($latitudeCheckIn) && $latitudeCheckIn != 0 &&
//                       !empty($longitudeCheckIn) && $longitudeCheckIn != 0 &&
//                       !empty($latitudeCheckOut) && $latitudeCheckOut != 0 &&
//                       !empty($longitudeCheckOut) && $longitudeCheckOut != 0
//                   ) {
//                       $output .= '<td>
//                           <button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#locationModal"
//                               onclick="showBothMaps(\'' . $checkInMapUrl . '\', \'' . $checkOutMapUrl . '\')">
//                               GPS Locations
//                           </button>
//                       </td>';
//                   } else {
//                       $output .= '<td><span class="text-muted">No GPS</span></td>';
//                   }
//                  $output.='</tr>';
                 
//        }
//        $output .= '</tbody></table>';
//    } else {
//        $output .= '<p>No records found.</p>';
//    }
 
//    mysqli_close($conn);
//    echo $output;
//    exit;
//  }
elseif ($code == 30) {  //complete

    $limit = 5; // number of records per page
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $offset = ($page - 1) * $limit;
  
    $gettypes = "SELECT SQL_CALC_FOUND_ROWS *,
      task_assignments.status as task_status,
      task_assignments.task_id as task_s_id,
      task_assignments.id as task_a_id,
      task_assignments.remarks,
      task_assignments.work_image,
      checkins.latitude as latitudeCheckIn,
      checkins.longitude as longitudeCheckIn,
      checkouts.latitude as latitudeCheckOut,
      checkouts.longitude as longitudeCheckOut,
      master_categories.name as category_name,
      tasks.location_id as l_id,
      users.phone, users.email, users.status 
    FROM users 
    INNER JOIN tasks ON users.emp_id = tasks.created_by
    INNER JOIN master_categories ON master_categories.id = tasks.task_type_id 
    INNER JOIN task_assignments ON task_assignments.task_id = tasks.id 
    INNER JOIN checkins ON task_assignments.id = checkins.assignment_id 
    LEFT JOIN checkouts ON task_assignments.id = checkouts.assignment_id 
    WHERE users.emp_id = '$user_id' AND task_assignments.status = 'completed' order by task_assignments.id DESC
    LIMIT $limit OFFSET $offset ";
  
    $gettypesRun = mysqli_query($conn, $gettypes);
  
    $totalQuery = mysqli_query($conn, "SELECT FOUND_ROWS() as total");
    $totalRow = mysqli_fetch_assoc($totalQuery);
    $totalRecords = $totalRow['total'];
    $totalPages = ceil($totalRecords / $limit);
  
    $output = '';
    $srno = $offset + 1;
  
    if (mysqli_num_rows($gettypesRun) > 0) {
        $output .= '<table class="table table-bordered" >';
        $output .= '<thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Assign To</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category name</th>
                            <th>Location</th>
                            <th>Accept Time</th>
                            <th>Start Time</th>
                            <th>Complete Time</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead><tbody>';
  
        while ($row = mysqli_fetch_array($gettypesRun)) {
            $latitudeCheckIn = $row['latitudeCheckIn'];
            $longitudeCheckIn = $row['longitudeCheckIn'];
            $latitudeCheckOut = $row['latitudeCheckOut'];
            $longitudeCheckOut = $row['longitudeCheckOut'];
  
            $checkInMapUrl = "https://maps.google.com/maps?q=$latitudeCheckIn,$longitudeCheckIn&z=15&output=embed";
            $checkOutMapUrl = "https://maps.google.com/maps?q=$latitudeCheckOut,$longitudeCheckOut&z=15&output=embed";
  
            $getTimes = "SELECT 
                accepted_at,
                start_at,
                compete_at,
                TIMEDIFF(compete_at, assigned_at) AS total_duration
            FROM task_assignments
            WHERE compete_at IS NOT NULL AND task_id = '".$row['task_s_id']."'";
  
            $getTimesRun = mysqli_query($conn, $getTimes);
            $accept_at = $start_at = $compete_at = $total_duration = '';
  
            if ($getTimesRunRow = mysqli_fetch_array($getTimesRun)) {
                $accept_at = $getTimesRunRow['accepted_at'];
                $start_at = $getTimesRunRow['start_at'];
                $compete_at = $getTimesRunRow['compete_at'];
                $total_duration = $getTimesRunRow['total_duration'];
            }
  
            $ID = $row['l_id'];
            $location = "SELECT *, rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo, lm.ID as L_ID 
                FROM location_master lm 
                INNER JOIN room_master rm on lm.Floor=rm.FloorID 
                INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID 
                INNER JOIN room_type_master rtm on lm.Type=rtm.ID 
                INNER JOIN building_master bm on lm.Block=bm.ID 
                WHERE lm.ID='$ID'";
  
            $location_run = mysqli_query($conn, $location);
            $Name = $FloorName = $RoomNo = $RoomType = $RoomName = '';
  
            if ($location_row = mysqli_fetch_array($location_run)) {
                $Name = $location_row['Name'];
                $FloorName = $location_row['FloorName'];
                $RoomNo = $location_row['RoomNo'];
                $RoomType = $location_row['RoomType'];
                $RoomName = $location_row['RoomName'];
            }
  
            $output .= '<tr style="background-color:#bcf983">
                <td>' . $srno++ . '</td>
                <td>' . htmlspecialchars($row['user_id']) . '</td>
                <td>' . htmlspecialchars($row['title']) . '</td>
                <td>' . htmlspecialchars($row['description']) . '</td>
                <td>' . htmlspecialchars($row['category_name']) . '</td>
                <td>' . $Name . '-' . $FloorName . '-' . $RoomNo . '-' . $RoomType . '-' . $RoomName . '</td>
                <td>' . htmlspecialchars($accept_at) . '</td>
                <td>' . htmlspecialchars($start_at) . '</td>
                <td>' . htmlspecialchars($compete_at) . '</td>
                <td>' . $total_duration . '</td>
                <td>' . htmlspecialchars($row['task_status']) . '</td><td>';
  
            if ($row['work_image'] != '') {
                $output .= '<button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#viewTaskModal"
                    onclick="viewTaskDetails(' . $row['task_a_id'] . ')"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></button>';
            } else {
                $output .= 'No Image';
            }
  
            $output .= '</td>';
  
            if (
                !empty($latitudeCheckIn) && $latitudeCheckIn != 0 &&
                !empty($longitudeCheckIn) && $longitudeCheckIn != 0 &&
                !empty($latitudeCheckOut) && $latitudeCheckOut != 0 &&
                !empty($longitudeCheckOut) && $longitudeCheckOut != 0
            ) {
                $output .= '<td>
                    <button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#locationModal"
                        onclick="showBothMaps(\'' . $checkInMapUrl . '\', \'' . $checkOutMapUrl . '\')">
                        GPS Locations
                    </button>
                </td>';
            } else {
                $output .= '<td><span class="text-muted">No GPS</span></td>';
            }
  
            $output .= '</tr>';
        }
  
        $output .= '</tbody></table>';
  
//        // Pagination buttons
// $output .= '<div class="pagination mt-2">';
// for ($i = 1; $i <= $totalPages; $i++) {
//     $active = ($i == $page) ? 'active-page' : '';
//     $output .= '<button class="pagination-link ' . $active . '" data-page="' . $i . '">' . $i . '</button> ';
// }
// $output .= '</div>';

  
    } else {
        $output .= '<p>No records found.</p>';
    }
  
    mysqli_close($conn);
    echo $output;
    exit;
  }
  
 elseif ($code == 31) {
  $task_id = $_POST['task_id'];  // ID of the task
  $user_id = $_POST['user_id'];  // ID of the employee/user

  // Check if record exists
   $check_sql = "SELECT * FROM task_assignments WHERE task_id = '$task_id' AND user_id = '$user_id'";
  $check_res = mysqli_query($conn, $check_sql);

  if (mysqli_num_rows($check_res) > 0) {
      // Delete the assignment
      $delete_sql = "DELETE FROM task_assignments WHERE task_id = '$task_id' AND user_id = '$user_id'";
      if (mysqli_query($conn, $delete_sql)) {
          echo   "1";
      } else {
         
          echo   "0";
      }
  } else {
     
      echo   "2";
  }

}
elseif ($code == 32) { // pending
    
   $gettypes = "SELECT 
    t.*,
    ta.status AS task_status, 
    t.id as task_a_id,
    master_categories.name as category_name,
    ta.assigned_at
FROM tasks t
JOIN task_assignments ta ON t.id = ta.task_id 
INNER JOIN master_categories on master_categories.id=t.task_type_id
WHERE ta.user_id = '$user_id' and (ta.status='pending' or ta.status='accepted') order by t.id DESC;
";
   $gettypesRun = mysqli_query($conn, $gettypes);
   $output = '';
   $srno = 1;
   if (mysqli_num_rows($gettypesRun) > 0) {
       $output .= '<table class="table table-bordered" >';
       $output .= '<thead>
                       <tr>
                           <th>Sr No</th>
                           <th>Assign By</th>
                           <th>Title</th>
                           <th>Description</th>
                           <th>Category name</th>
                           <th>Location</th>
                           <th>Status</th>
                           <th>Action</th>
                          
                         
                       </tr>
                   </thead><tbody>';
       while ($row = mysqli_fetch_array($gettypesRun)) {
 
         $ID=$row['location_id'];
          $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo ,lm.ID as L_ID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID where lm.ID='$ID'";
                     
                         $location_run=mysqli_query($conn,$location);
                         if ($location_row=mysqli_fetch_array($location_run)) 
                         {
                            $LocationID=$location_row['L_ID'];
                       $Name=$location_row['Name'];
                       $FloorName=$location_row['FloorName'];
                       $RoomNo=$location_row['RoomNo'];
                       $RoomType=$location_row['RoomType'];         
                       $RoomName=$location_row['RoomName'];         
                    
                     }
                     $output .= '<tr style="background-color:">
                     <td>' . $srno++ . '</td>
                     <td>' . htmlspecialchars($row['created_by']) . '</td>
                     <td>' . htmlspecialchars($row['title']) . '</td>
                     <td>' . htmlspecialchars($row['description']) . '</td>
                     <td>' . htmlspecialchars($row['category_name']) . '</td>
                     <td>' . $Name . '-' . $FloorName . '-'.$RoomNo.'-' . $RoomType . '-' . $RoomName . '</td>
                     <td>' . htmlspecialchars($row['task_status']) . '</td>
                     <td>';
if($row['task_status']=='pending')
{
  $output .= '<input type="button" onclick="clickToaccept('.$row['task_a_id'].','.$user_id.');" class="btn btn-warning" value="Accepet">';
}
else if($row['task_status']=='accepted'){
  $output .= '<input type="button" onclick="clickToStart('.$row['task_a_id'].','.$user_id.');" class="btn btn-primary" value="Start Now">';
}
    
                    
                $output .= ' </td> </tr>';
                 
       }
       $output .= '</tbody></table>';
   } else {
       $output .= '<p>No records found.</p>';
   }
 
   mysqli_close($conn);
   echo $output;
   exit;
 }

 elseif ($code == 33) { // inprogress
  $gettypes = "SELECT 
                  t.*,
                  ta.status AS task_status, 
                  t.id as task_a_id,
                  checkins.*,
                  master_categories.name as category_name,
                  ta.assigned_at
              FROM tasks t
              JOIN task_assignments ta ON t.id = ta.task_id 
              INNER JOIN master_categories on master_categories.id=t.task_type_id
              INNER join checkins ON ta.id=checkins.assignment_id 
              WHERE ta.user_id = '$user_id' and ta.status='in_progress' order by ta.task_id DESC";
  
  $gettypesRun = mysqli_query($conn, $gettypes);
  $output = '';
  $srno = 1;

  if (mysqli_num_rows($gettypesRun) > 0) {
      $output .= '<table class="table table-bordered" >';
      $output .= '<thead>
                      <tr>
                          <th>Sr No</th>
                          <th>Assign By</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Category name</th>
                          <th>Location</th>
                          <th>Status</th>
                          
                          <th>Action</th>
                      </tr>
                  </thead><tbody>';
      
      while ($row = mysqli_fetch_array($gettypesRun)) {
          $ID = $row['location_id'];
          $location = "SELECT *, rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo, lm.ID as L_ID 
                      FROM location_master lm 
                      INNER JOIN room_master rm ON lm.Floor = rm.FloorID 
                      INNER JOIN room_name_master rnm ON lm.RoomName = rnm.ID 
                      INNER JOIN room_type_master rtm ON lm.Type = rtm.ID 
                      INNER JOIN building_master bm ON lm.Block = bm.ID 
                      WHERE lm.ID = '$ID'";

          $location_run = mysqli_query($conn, $location);
          if ($location_row = mysqli_fetch_array($location_run)) {
              $LocationID = $location_row['L_ID'];
              $Name = $location_row['Name'];
              $FloorName = $location_row['FloorName'];
              $RoomNo = $location_row['RoomNo'];
              $RoomType = $location_row['RoomType'];
              $RoomName = $location_row['RoomName'];
          } else {
              $Name = $FloorName = $RoomNo = $RoomType = $RoomName = 'N/A';
          }

          $latitude = $row['latitude'];
          $longitude = $row['longitude'];
          $mapUrl = "https://maps.google.com/maps?q=$latitude,$longitude&z=15&output=embed";
          $checkOutMapUrl=null;
          $output .= '<tr>
                          <td>' . $srno++ . '</td>
                          <td>' . htmlspecialchars($row['created_by']) . '</td>
                          <td>' . htmlspecialchars($row['title']) . '</td>
                          <td>' . htmlspecialchars($row['description']) . '</td>
                          <td>' . htmlspecialchars($row['category_name']) . '</td>
                          <td>' . $Name . '-' . $FloorName . '-' . $RoomNo . '-' . $RoomType . '-' . $RoomName . '</td>
                          <td>' . htmlspecialchars($row['task_status']) . '</td>';
                        //   if (
                        //     !empty($latitude) && $latitude != 0 &&
                        //     !empty($longitude) && $longitude != 0
                        // ) {
                        //     $output .= '<td>
                        //         <button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#locationModal"
                        //             onclick="showBothMaps(\'' . $mapUrl . '\', \'' . $checkOutMapUrl . '\')">
                        //             GPS Locations
                        //         </button>
                        //     </td>';
                        // } else {
                        //     $output .= '<td><span class="text-muted">No GPS</span></td>';
                        // }
                  $output .= '<td>';        

          if ($row['task_status'] == 'in_progress') {
            
            $output .= '<button class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#completeTaskModal"
            onclick="prepareCompleteTask(' . $row['task_a_id'] . ',' . $user_id . ')">Click To Complete</button>';
        


              // $output .= '<input type="button" onclick="clickToComplete(' . $row['task_a_id'] . ',' . $user_id . ');" class="btn btn-warning" value="Complete">';
          } else if ($row['task_status'] == 'completed') {
              $output .= 'Completed';
          }

          $output .= '</td></tr>';
      }

      $output .= '</tbody></table>';
  } else {
      $output .= '<p>No records found.</p>';
  }

  mysqli_close($conn);
  echo $output;
  exit;
}

elseif ($code == 34) {  // completed tasks
  $gettypes = "SELECT 
      t.*,
      ta.status AS task_status, 
      ta.id as task_a_id,
      ta.task_id as task_s_id,
      ta.remarks,
      ta.work_image,
      master_categories.name as category_name,
      checkins.latitude as latitudeCheckIn,
      checkins.longitude as longitudeCheckIn,
      checkouts.latitude as latitudeCheckOut,
      checkouts.longitude as longitudeCheckOut,
      ta.assigned_at,
      t.location_id,
      t.created_by
  FROM tasks t
  JOIN task_assignments ta ON t.id = ta.task_id 
  INNER JOIN master_categories ON master_categories.id = t.task_type_id
  INNER JOIN checkins ON ta.id = checkins.assignment_id 
  LEFT JOIN checkouts ON ta.id = checkouts.assignment_id 
  WHERE ta.user_id = '$user_id' AND ta.status = 'Completed' order by ta.id DESC";

  $gettypesRun = mysqli_query($conn, $gettypes);
  $output = '';
  $srno = 1;

  if (mysqli_num_rows($gettypesRun) > 0) {
    
      $output .= '<table class="table table-bordered" >';
      $output .= '<thead>
                      <tr>
                          <th>Sr No</th>
                          <th>Assign By</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Category name</th>
                          <th>Location</th>
                          <th>Accept Time</th>
                          <th>Start Time</th>
                          <th>Complete Time</th>
                          
                          <th>Duration</th>
                          <th>Status</th>

                          <th>Actions</th>
                      </tr>
                  </thead><tbody>';

      while ($row = mysqli_fetch_array($gettypesRun)) {
          $latitudeCheckIn = $row['latitudeCheckIn'];
          $longitudeCheckIn = $row['longitudeCheckIn'];
          $latitudeCheckOut = $row['latitudeCheckOut'];
          $longitudeCheckOut = $row['longitudeCheckOut'];

          $checkInMapUrl = "https://maps.google.com/maps?q=$latitudeCheckIn,$longitudeCheckIn&z=15&output=embed";
          $checkOutMapUrl = "https://maps.google.com/maps?q=$latitudeCheckOut,$longitudeCheckOut&z=15&output=embed";

          $getTimes="SELECT 
  id,
  task_id,
  user_id,
  status,
  assigned_at,
  accepted_at,
  rejected_at,
  start_at,
  compete_at,

  TIMEDIFF(accepted_at, assigned_at) AS time_to_accept,
  TIMEDIFF(start_at, accepted_at) AS time_to_start,
  TIMEDIFF(compete_at, start_at) AS time_to_complete,
  TIMEDIFF(compete_at, assigned_at) AS total_duration

FROM task_assignments
WHERE compete_at IS NOT NULL AND task_id = '".$row['task_s_id']."';
";
$getTimesRun = mysqli_query($conn, $getTimes);
if ($getTimesRunRow = mysqli_fetch_array($getTimesRun)) {

  $accept_at=$getTimesRunRow['accepted_at'];
  $total_duration=$getTimesRunRow['total_duration'];
  $start_at=$getTimesRunRow['start_at'];
  $compete_at=$getTimesRunRow['compete_at'];
}

$status = $row['task_status'];
switch ($status) {
  case 'pending':
      $rowColor = '#f8d7da'; // light red
      break;
  case 'accepted':
      $rowColor = '#d1ecf1'; // light blue
      break;
  case 'rejected':
      $rowColor = '#f5c6cb'; // pinkish
      break;
  case 'in_progress':
      $rowColor = '#faeb78'; // pinkish
      break;
  case 'completed':
      $rowColor = '#bcf983'; // light green
      break;
  default:
      $rowColor = '#ffffff'; // white
      break;
}
          // Location Details
          $ID = $row['location_id'];
          $locationDetails = '';
          $locationQuery = "SELECT *, rm.Floor AS FloorName, rm.RoomNo AS abc, lm.RoomNo AS RoomNo, lm.ID AS L_ID 
                            FROM location_master lm 
                            INNER JOIN room_master rm ON lm.Floor = rm.FloorID 
                            INNER JOIN room_name_master rnm ON lm.RoomName = rnm.ID 
                            INNER JOIN room_type_master rtm ON lm.Type = rtm.ID 
                            INNER JOIN building_master bm ON lm.Block = bm.ID 
                            WHERE lm.ID = '$ID'";

          $location_run = mysqli_query($conn, $locationQuery);
          if ($location_row = mysqli_fetch_array($location_run)) {
              $Name = $location_row['Name'];
              $FloorName = $location_row['FloorName'];
              $RoomNo = $location_row['RoomNo'];
              $RoomType = $location_row['RoomType'];
              $RoomName = $location_row['RoomName'];
              $locationDetails = "$Name - $FloorName - $RoomNo - $RoomType - $RoomName";
          }

          // Table Row
          $output .= '<tr style="background-color: ' . $rowColor . ';">
              <td>' . $srno++ . '</td>
              <td>' . htmlspecialchars($row['created_by']) . '</td>
              <td>' . htmlspecialchars($row['title']) . '</td>
              <td>' . htmlspecialchars($row['description']) . '</td>
              <td>' . htmlspecialchars($row['category_name']) . '</td>
              <td>' . htmlspecialchars($locationDetails) . '</td>
              <td>' . htmlspecialchars($accept_at) . '</td>
              <td>' . htmlspecialchars($start_at) . '</td>
              <td>' . htmlspecialchars($compete_at) . '</td>
              <td>' .$total_duration . '</td>
              <td>' . htmlspecialchars($row['task_status']) . '</td><td>';
              if($row['work_image']!=''){
              $output .= '<button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#viewTaskModal"
    onclick="viewTaskDetails(' . $row['task_a_id'] . ')">
   <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
</button>';
              }
              $output.='</td>';
            //   if (
            //     !empty($latitudeCheckIn) && $latitudeCheckIn != 0 &&
            //     !empty($longitudeCheckIn) && $longitudeCheckIn != 0 &&
            //     !empty($latitudeCheckOut) && $latitudeCheckOut != 0 &&
            //     !empty($longitudeCheckOut) && $longitudeCheckOut != 0
            // ) {
            //     $output .= '<td>
            //         <button class="btn btn-info " data-bs-toggle="modal" data-bs-target="#locationModal"
            //             onclick="showBothMaps(\'' . $checkInMapUrl . '\', \'' . $checkOutMapUrl . '\')">
            //             GPS Locations
            //         </button>
            //     </td>';
            // } else {
            //     $output .= '<td><span class="text-muted">No GPS</span></td>';
            // }
            
      }

      $output .= '</tbody></table>';
  } else {
      $output .= '<p>No records found.</p>';
  }

  mysqli_close($conn);
  echo $output;
  exit;
}


 elseif ($code == 35) {
  $task_id = $_POST['task_id'];  // ID of the task
  $user_id = $_POST['user_id'];  // ID of the employee/user

  // Check if record exists
   $check_sql = "SELECT * FROM task_assignments WHERE task_id = '$task_id' AND user_id = '$user_id' and status='pending'";
  $check_res = mysqli_query($conn, $check_sql);

  if (mysqli_num_rows($check_res) > 0) {
      $accept_sql = "UPDATE task_assignments SET status='accepted',accepted_at=NOW() WHERE task_id = '$task_id' AND user_id = '$user_id'";
      if (mysqli_query($conn, $accept_sql)) {
          echo   "1";
      } else {
         
          echo   "0";
      }
  } else {
     
      echo   "2";
  }

}

elseif ($code == 36) {
  $task_id = $_POST['task_id'];
  $user_id = $_POST['user_id'];

  // Example: Add your logic to check if check-in is required
  // You can either store it in a column or calculate dynamically
  $checkin_required = false;

   $check_query = "SELECT t.checkin_required FROM tasks t 
                  INNER JOIN task_assignments ta ON t.id = ta.task_id 
                  WHERE t.id = '$task_id' AND ta.user_id = '$user_id'";
  
  $result = mysqli_query($conn, $check_query);
  if ($row = mysqli_fetch_assoc($result)) {
      $checkin_required = ($row['checkin_required'] == 1); // assuming 1 = required
  }

  echo json_encode([
      'checkin_required' => $checkin_required
  ]);
  exit;
}

elseif ($code == 37) {
  $task_id = $_POST['task_id'];
  $user_id = $_POST['user_id'];

  $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
  $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;
  // Fetch task requirements (checkin/checkout flags)
   $taskQuery = "SELECT checkin_required, checkout_required FROM tasks WHERE id = '$task_id'";
  $taskRun = mysqli_query($conn, $taskQuery);
  $taskInfo = mysqli_fetch_assoc($taskRun);

  $checkin_required = $taskInfo['checkin_required'];
  $checkout_required = $taskInfo['checkout_required'];

  // If checkout is required, then latitude/longitude must be present
  if ($checkin_required && (empty($latitude) || empty($longitude) || $latitude == 0 || $longitude == 0)) {
      echo json_encode([
          'status' => 'error',
          'message' => 'CheckIn location is required to complete this task.'
      ]);
      exit;
  }

  // Get assignment_id safely
  $getAssignment = mysqli_query($conn, "SELECT id FROM task_assignments WHERE task_id = '$task_id' AND user_id = '$user_id'");
  if ($row = mysqli_fetch_assoc($getAssignment)) {
      $assignment_id = $row['id'];

      // Insert into checkins table
      $insert = "INSERT INTO checkins (
          assignment_id,
          checkin_time,
          latitude,
          longitude
      ) VALUES (
          '$assignment_id',
          NOW(),
          " . ($latitude ? "'$latitude'" : "NULL") . ",
          " . ($longitude ? "'$longitude'" : "NULL") . "
      )";

      // Update task_assignments status
      $update = "UPDATE task_assignments 
                 SET start_at = NOW(), status = 'in_progress' 
                 WHERE user_id = '$user_id' AND task_id = '$task_id' 
                 AND (status = 'accepted' OR status = 'pending')";

      mysqli_query($conn, $update); 

      if (mysqli_query($conn, $insert)) {
          echo json_encode(['status' => 'success', 'message' => 'Task started and check-in recorded.']);
      } else {
          echo json_encode(['status' => 'error', 'message' => 'Failed to record check-in.', 'error' => mysqli_error($conn)]);
      }
  } else {
      echo json_encode(['status' => 'error', 'message' => 'Assignment not found.']);
  }

  exit;
}
elseif ($code == 38) {
  $task_id = $_POST['task_id'];
  $user_id = $_POST['user_id'];

  // Example: Add your logic to check if check-in is required
  // You can either store it in a column or calculate dynamically
  $checkout_required = false;

   $check_query = "SELECT t.checkout_required FROM tasks t 
                  INNER JOIN task_assignments ta ON t.id = ta.task_id 
                  WHERE t.id = '$task_id' AND ta.user_id = '$user_id'";
  
  $result = mysqli_query($conn, $check_query);
  if ($row = mysqli_fetch_assoc($result)) {
      $checkout_required = ($row['checkout_required'] == 1); // assuming 1 = required
  }

  echo json_encode([
      'checkout_required' => $checkout_required
  ]);
  exit;
}

elseif ($code == 39) {
  $task_id = $_POST['task_id'];
  $user_id = $_POST['user_id'];
  $remarks = $_POST['remarks'] ?? null;

  $latitude = $_POST['latitude'] ?? null;
  $longitude = $_POST['longitude'] ?? null;

  $upload_dir = "uploads/";
  $file_name = null;

  if (!empty($_FILES['work_image']['name'])) {
      $file_name = time() . '_' . basename($_FILES['work_image']['name']);
      $target_file = $upload_dir . $file_name;

      if (!move_uploaded_file($_FILES['work_image']['tmp_name'], $target_file)) {
          echo json_encode(['status' => 'error', 'message' => 'Failed to upload image.']);
          exit;
      }
  }

  $taskQuery = "SELECT checkin_required, checkout_required FROM tasks WHERE id = '$task_id'";
  $taskRun = mysqli_query($conn, $taskQuery);
  $taskInfo = mysqli_fetch_assoc($taskRun);

  $checkout_required = $taskInfo['checkout_required'];

  if ($checkout_required && (empty($latitude) || empty($longitude) || $latitude == 0 || $longitude == 0)) {
      echo json_encode(['status' => 'error', 'message' => 'CheckOut location is required to complete this task.']);
      exit;
  }

  $getAssignment = mysqli_query($conn, "SELECT id FROM task_assignments WHERE task_id = '$task_id' AND user_id = '$user_id'");
  if ($row = mysqli_fetch_assoc($getAssignment)) {
      $assignment_id = $row['id'];

      if ($checkout_required) {
          $insert = "INSERT INTO checkouts (assignment_id, checkout_time, latitude, longitude)
                     VALUES ('$assignment_id', NOW(), " . ($latitude ? "'$latitude'" : "NULL") . ", " . ($longitude ? "'$longitude'" : "NULL") . ")";
          if (!mysqli_query($conn, $insert)) {
              echo json_encode(['status' => 'error', 'message' => 'Failed to record checkout.', 'error' => mysqli_error($conn)]);
              exit;
          }
      }

      // Update task_assignments
      $query = "UPDATE task_assignments 
                SET status='completed', compete_at=NOW(), remarks=?, work_image=? 
                WHERE task_id=? AND user_id=? AND status='in_progress'";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ssii", $remarks, $file_name, $task_id, $user_id);
      $stmt->execute();

      echo json_encode(['status' => 'success', 'message' => 'Task completed successfully.']);
  } else {
      echo json_encode(['status' => 'error', 'message' => 'Assignment not found.']);
  }

  exit;
}

// elseif ($code == 39) {
//   $task_id = $_POST['task_id'];
//   $user_id = $_POST['user_id'];

//   $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
//   $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;
//   // Fetch task requirements (checkin/checkout flags)
//   $taskQuery = "SELECT checkin_required, checkout_required FROM tasks WHERE id = '$task_id'";
//   $taskRun = mysqli_query($conn, $taskQuery);
//   $taskInfo = mysqli_fetch_assoc($taskRun);

//   $checkin_required = $taskInfo['checkin_required'];
//   $checkout_required = $taskInfo['checkout_required'];

//   // If checkout is required, then latitude/longitude must be present
//   if ($checkout_required && (empty($latitude) || empty($longitude) || $latitude == 0 || $longitude == 0)) {
//       echo json_encode([
//           'status' => 'error',
//           'message' => 'CheckOut location is required to complete this task.'
//       ]);
//       exit;
//   }

//   // Get assignment_id safely
//   $getAssignment = mysqli_query($conn, "SELECT id FROM task_assignments WHERE task_id = '$task_id' AND user_id = '$user_id'");
//   if ($row = mysqli_fetch_assoc($getAssignment)) {
//       $assignment_id = $row['id'];

//       // Insert into checkouts table
//       $insert = "INSERT INTO checkouts (
//           assignment_id,
//           checkout_time,
//           latitude,
//           longitude
//       ) VALUES (
//           '$assignment_id',
//           NOW(),
//           " . ($latitude ? "'$latitude'" : "NULL") . ",
//           " . ($longitude ? "'$longitude'" : "NULL") . "
//       )";

//       // Update task_assignments status
//       $update = "UPDATE task_assignments  
//                  SET compete_at = NOW(), status = 'completed' 
//                  WHERE user_id = '$user_id' AND task_id = '$task_id' 
//                  AND status = 'in_progress'";

//       mysqli_query($conn, $update); 

//       if (mysqli_query($conn, $insert)) {
//           echo json_encode(['status' => 'success', 'message' => 'Task completed and check-out recorded.']);
//       } else {
//           echo json_encode(['status' => 'error', 'message' => 'Failed to record check-out.', 'error' => mysqli_error($conn)]);
//       }
//   } else {
//       echo json_encode(['status' => 'error', 'message' => 'Assignment not found.']);
//   }

//   exit;
// }


// if ($code == 40) {
//   $task_id = $_POST['task_id'];
//   $user_id = $_POST['user_id'];
//   $remarks = $_POST['remarks'];
//   $upload_dir = "uploads/";

//   if (!empty($_FILES['work_image']['name'])) {
//       $file_name = time() . '_' . basename($_FILES['work_image']['name']);
//       $target_file = $upload_dir . $file_name;

//       if (move_uploaded_file($_FILES['work_image']['tmp_name'], $target_file)) {
//           // Save to DB
//           $query = "UPDATE task_assignments SET status='completed', compete_at=NOW(), remarks=?, work_image=? 
//                     WHERE task_id=? AND user_id=?";
//           $stmt = $conn->prepare($query);
//           $stmt->bind_param("ssii", $remarks, $file_name, $task_id, $user_id);
//           $stmt->execute();

//           echo json_encode(["status" => "success", "message" => "Task completed with remarks and image."]);
//       } else {
//           echo json_encode(["status" => "error", "message" => "Failed to upload image."]);
//       }
//   } else {
//       echo json_encode(["status" => "error", "message" => "Please upload a work image."]);
//   }
// }
elseif ($code == 40) {
  $task_a_id = $_POST['task_a_id'];
  $query = "SELECT remarks, work_image FROM task_assignments WHERE id = '$task_a_id'";
  $result = mysqli_query($conn, $query);

  if ($row = mysqli_fetch_assoc($result)) {
      echo json_encode([
          'status' => 'success',
          'remarks' => $row['remarks'],
          'work_image' => $row['work_image']
      ]);
  } else {
      echo json_encode(['status' => 'error', 'message' => 'Data not found.']);
  }
  exit;
}
elseif ($code == 41) {

    $employeeId = $_POST['employee_id'] ?? '';
    $categoryId = $_POST['category_id'] ?? '';
    $buildingId = $_POST['building_id'] ?? '';

    if($role_id==2)
    {
    $sql = "SELECT tasks.title, task_assignments.status, task_assignments.user_id AS employee_id,
                   building_master.Name AS BlockName,
                   master_categories.name AS CategoryName
            FROM tasks
            INNER JOIN location_master ON location_master.ID = tasks.location_id
            LEFT JOIN building_master ON building_master.ID = location_master.Block
            LEFT JOIN master_categories ON master_categories.id = tasks.task_type_id
            LEFT JOIN task_assignments ON task_assignments.task_id = tasks.id
            WHERE task_assignments.status IN ('pending', 'inprogress', 'completed')";

    }
    else{

    $sql = "SELECT tasks.title, task_assignments.status, task_assignments.user_id AS employee_id,
                   building_master.Name AS BlockName,
                   master_categories.name AS CategoryName
            FROM tasks
            INNER JOIN location_master ON location_master.ID = tasks.location_id
            LEFT JOIN building_master ON building_master.ID = location_master.Block
            LEFT JOIN master_categories ON master_categories.id = tasks.task_type_id
            LEFT JOIN task_assignments ON task_assignments.task_id = tasks.id
            WHERE task_assignments.status IN ('pending', 'inprogress', 'completed') and tasks.created_by='$user_id'";
    }

    if (!empty($employeeId)) {
        $sql .= " AND task_assignments.user_id = '$employeeId'";
    }
    if (!empty($categoryId)) {
        $sql .= " AND tasks.task_type_id = '$categoryId'";
    }
    if (!empty($buildingId)) {
        $sql .= " AND building_master.ID = '$buildingId'";
    }

    $stmt = mysqli_query($conn, $sql);

    if (mysqli_num_rows($stmt) > 0) {
        // Export Button aligned to the right
        echo '<br><div class="d-flex justify-content-end mb-2">';
        echo '<button onclick="exportTableToExcel()" class="btn btn-success">Export to Excel</button>';
        echo '</div>';

        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered" id="taskTable">';
        echo '<thead><tr>
                <th>#</th>
                <th>Employee</th>
                <th>Title</th>
                <th>Category</th>
                <th>Building</th>
                <th>Status</th>
              </tr></thead><tbody>';

        $i = 1;
        while ($task = mysqli_fetch_assoc($stmt)) {
            $rowClass = '';
            switch (strtolower($task['status'])) {
                case 'completed':
                    $rowClass = 'table-success';
                    break;
                case 'inprogress':
                    $rowClass = 'table-warning';
                    break;
                case 'pending':
                    $rowClass = 'table-danger';
                    break;
            }

            echo "<tr class='$rowClass'>
                    <td>$i</td>
                    <td>{$task['employee_id']}</td>
                    <td>{$task['title']}</td>
                    <td>{$task['CategoryName']}</td>
                    <td>{$task['BlockName']}</td>
                    <td>" . ucfirst($task['status']) . "</td>
                  </tr>";
            $i++;
        }

        echo '</tbody></table></div>';
    } else {
        echo "<div class='alert alert-info'>No tasks found.</div>";
    }
}

  

   else
   {
      echo "select code";
   }

} 
   
   ?>