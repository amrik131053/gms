
<form action="action.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="code" value="353.1">
                <div class="row">           
                <div class="col-lg-3" id="fileInputContainer" >
                    <label>Employee ID<span class="text-danger">&nbsp;*</span></label>
                    <input type="file" name="casualCountFile" class="form-control">
                </div>

               <div class="col-lg-3">
               <label>Action</label>
             <br>
               <input type="submit"  class="btn btn-success" value="Submit">
                </div>
</div>
</form>


<?php

    
// $result1 = mysqli_query($conn,"SELECT Class_RollNo,NAME,PrintDate,FatherName,MobileNo,DOB,CollegeName,Course FROM offer_latter WHERE
//  PrintDate>'2024-11-30 15:11:06'");

// $counter = 1; 
//         while($row=mysqli_fetch_array($result1)) 
//         {
      
//         $CollegeName = $row['CollegeName'];
//         $Course = $row['Course'];
     

//  $sql1 = "SELECT Course,CollegeName FROM  MasterCourseCodes   where CourseID='$Course' ANd CollegeID='$CollegeName'";


// $stmt2 = sqlsrv_query($conntest,$sql1);
//    while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
//      {
//       $Course=$row1['Course'];
//        $CollegeName=$row1['CollegeName'];
//        }?>


 <!-- <table style="border:1px solid black"><tr><td style="border:1px solid black"><?=$row['NAME'];?></td><td style="border:1px solid black"><?=$row['FatherName'];?></td><td style="border:1px solid black"><?=$row['Class_RollNo'];?></td><td style="border:1px solid black"><?=$Course;?></td><td style="border:1px solid black"><?=$CollegeName;?></td><td style="border:1px solid black"><?=$row['PrintDate'];?></td></tr></table> -->

     <?php 

// }



?>