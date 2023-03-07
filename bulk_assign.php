<?php 
    include "header.php";
    $LocationID=$_GET['ID'];
    if ($LocationID=='') 
    {
        ?>
        <script type="text/javascript">window.location.href = 'location-master.php';</script>
        <?php  
    }
    else
    {
        $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo,clg.name as CollegeName,rtm.ID as rtmID,rnm.ID as rmnID,clg.ID as clgID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID left JOIN colleges clg ON clg.ID=lm.CollegeID  where lm.ID='$LocationID' ";
        $location_run=mysqli_query($conn,$location);
        if ($location_row=mysqli_fetch_array($location_run)) 
        {
        ?>   
            <div class="col-lg-12 col-md-12 col-sm-3">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Location</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);">
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 col-md-12">
                                <label>Block</label>
                                <input type="text" name="" class="form-control" value="  <?=$location_row['Name'];?>"disabled>
                            </div>    
                            <div class="col-lg-3 col-sm-12 col-md-12">
                                <label>Floor</label>
                                <input type="text" name="" class="form-control" value="<?=$location_row['FloorName'];?>" disabled>
                            </div>  
                            <div class="col-lg-3 col-sm-12 col-md-12">
                                <label>Room No</label>
                                <input type="text" name="" class="form-control" value="  <?=$location_row['RoomNo'];?>" disabled>
                            </div>  
                            <div class="col-lg-3 col-sm-12 col-md-12">
                                <label>Room Name</label>
                                <input type="text" name="" class="form-control" value="<?=$location_row['RoomName'];?>" disabled>
                            </div> 
                        </div> 
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-lg-3 col-sm-12 col-md-12">
                                    <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Category Name</label>
                                    <select class="form-control" name="CategoryID" id="Category">
                                        <option value=" ">Select </option>
                                        <?php
                                            $category_select="SELECT * FROM master_calegories";
                                            $category_select_run=mysqli_query($conn,$category_select);
                                            while ($category_select_row=mysqli_fetch_array($category_select_run)) 
                                            {
                                                echo "<option value='".$category_select_row['ID']."'>".$category_select_row['CategoryName']."</option>";
                                            }
                                        ?>
                                    </select>            
                                </div>
                                <div class="col-lg-3 col-sm-12 col-md-12">
                                    <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Article Name</label>
                                    <select class="form-control" required="" id="articlebind" name="ArticleCode">
                                    </select>                                           
                                </div>
                                <div class="col-lg-3 col-sm-12 col-md-12">
                                    <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Action</label>
                                    <input type="submit" name="search" value="Search" class="btn btn-primary">
                                    <input type="hidden" name="" id="location_id_temp" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php  
        }
    ?>
     <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Bulk Assign</h3>
                  <div class="card-tools">
                     <div class="input-group input-group-sm" style="width: 150px;">
                       <!--  <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);">
                         -->
                     </div>
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive " style="height: 400px;">
                    <form action="action.php" method="post">
                        <?php
                        if (isset($_POST['search'])) 
                        {
                            $LocationID=$_GET['ID'];
                            $ArticleCode=$_POST['ArticleCode'];
                            // $LocationID = $_POST['locationID'];
                            $location=" SELECT * from location_master  Where ID='$LocationID' ";
                            $location_run=mysqli_query($conn,$location);
                            while ($location_row=mysqli_fetch_array($location_run)) 
                            {
                                $User_ID = $location_row['location_owner'];
                            }
                                ?>
                                <input type="hidden" name="locationID" value="<?=$LocationID;?>">
                                <input type="hidden" name="User_ID" value="<?=$User_ID;?>">
                                <input type="hidden" name="code" value="27">
                                <table class="table table-striped table-bordered" id='example'>
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select_all" onclick="selectAll()" ></th>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Article Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                    <?php 
                                    $building_num=0;
                                    $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode WHERE s.Status='1' and s.ArticleCode='$ArticleCode' order by IDNo DESC ";
                                    $building_run=mysqli_query($conn,$building);
                                    while ($building_row=mysqli_fetch_array($building_run)) 
                                    {
                                        $building_num=$building_num+1;
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="check[]" id="check" value="<?=$building_row['IDNo'];?>" class="checkbox" ></td>
                                            <td><?=$building_row['IDNo'];?></td>
                                            <td><?=$building_row['CategoryName'];?></td>
                                            <td><?=$building_row['ArticleName'];?></td>
                                            <td>
                                            <?php 
                                            if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                                            {
                                                if($building_row['Status']=="1")
                                                {
                                                ?>
                                                    <a class="btn btn-warning btn-xs"  onclick="stock_assign(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_assign" style="color: white;">Available</a>
                                                <?php                      
                                                }
                                                elseif($building_row['Status']=="0")
                                                {
                                                }
                                                else 
                                                {
                                                ?>
                                                    <a class="btn btn-success btn-xs" style="color:white;">Assigned</a>
                                                <?php 
                                                }
                                            }
                                            else
                                            {
                                            }  
                                            ?>
                                            </td>
                                        </tr>
                        <?php 
                           }
                                      ?>
                     </tbody>
                 </table>
                <?php 
}
else
{ 
    $LocationID = $_GET['ID'];
      $location=" SELECT * from location_master  Where ID='$LocationID' ";
                        $location_run=mysqli_query($conn,$location);
                        while ($location_row=mysqli_fetch_array($location_run)) 
                        {?>
     <input type="hidden" name="User_ID" value="<?=$location_row['location_owner'];?>">
 <?php }
?>


                    <input type="hidden" name="locationID" value="<?=$LocationID;?>">
                      
              <input type="hidden" name="code" value="27">
        <div class="card-body">
                 <table class="table table-bordered table-striped" id="example">
                     <thead>
                        <tr>
                            <th><input type="checkbox" id="select_all" onclick="selectAll()"></th>
                           <th>ID</th>
                           <th>Category Name</th>
                           <th>Article Name</th>
                        
                          <!--  <th>Oprating System</th>
                           <th>Memory</th> -->
                           <th>Action</th>
                         
                        </tr>
                     </thead>
                     <tbody>
                        <?php 
                           $building_num=0;
                           $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode WHERE s.Status='1' order by IDNo DESC ";
                           $building_run=mysqli_query($conn,$building);
                           while ($building_row=mysqli_fetch_array($building_run)) 
                           {
                           $building_num=$building_num+1;
                           ?>

                        <tr>
                            <td><input type="checkbox" name="check[]" id="check" value="<?=$building_row['IDNo'];?>" class="checkbox" ></td>
                           <td><?=$building_row['IDNo'];?></td>
                           <td><?=$building_row['CategoryName'];?></td>
                           <td><?=$building_row['ArticleName'];?></td>
                         <!--   <td><?=$building_row['CPU'];?></td> -->
                         <!--   <td><?=$building_row['OS'];?></td>
                           <td><?=$building_row['Memory'];?></td> -->
                        
                           <td>
                              <?php 
                                 if ($building_row['CPU']!='' and $building_row['OS']!='' and $building_row['Memory']!='' and $building_row['Brand']!='' and $building_row['Storage']!='' and $building_row['Model']!='')
                                  {
                                     if($building_row['Status']=="1")
                                    {?>
                              <a class="btn btn-warning btn-xs"  onclick="stock_assign(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#exampleModal_assign" style="color: white;">Available</a>
                              <?php                      
                                 }
                                 elseif($building_row['Status']=="0")
                                 {

                                 }
                                 else 
                                 {
                                 ?>
                              <a class="btn btn-success btn-xs" style="color:white;">Assigned</a>

                              <?php 

                                 }
                                 }
                                 else
                                 {
                                 
                                 }  ?>
                                 
                           </td>
                           
                        </tr>
                    
                        <?php 
                           }


                                      ?>
                     </tbody>
                 </table>

</div>   

<?php 
}
    ?>

    

           <div class="row">
             <div class="col-lg-4">
                <label>Issue Date</label>
            <input type="date" name="IssueDate" class="form-control" required>
        </div>
       <div class="col-lg-4">

            <?php if ($LocationID!='')
             {
                // code...
            ?><label>Action</label><br>
                 <input type="submit"  class="btn btn-primary" value="Submit">
               <?php  } ?> 
               
               <!-- <button type="submit" class="btn btn-primary">Save</button> -->
           </div>
       </div>
   </form>
   </div>
</div>
</div>  
         


                     <?php include "footer.php";
                 }   ?>