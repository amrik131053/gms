<?php
session_start();

ini_set('max_execution_time', '0');
   if(!(ISSET($_SESSION['usr']))) 
   {
?>
<script> window.location.href = 'index.php'; </script> 
<?php
   }
   else
   {
   date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
   $timeStamp=date('Y-m-d H-i-s');
   $EmployeeID=$_SESSION['usr'];
   if ($EmployeeID==0 || $EmployeeID=='') 
      {?>
<script type="text/javascript">
   window.location.href="index.php";
</script>
<?php }
   include "connection/connection.php";
    $permissionCount=0;
   $permission_qry="SELECT * FROM category_permissions where employee_id='$EmployeeID' and is_admin='1'";
   $permission_res=mysqli_query($conn,$permission_qry);
   while($permission_data=mysqli_fetch_array($permission_res))
   {
      $permissionCount++;
   }
   $code = $_POST['code'];
   
    $get_session="SELECT * FROM question_session where session_status='1'";
      $get_session_run=mysqli_query($conn,$get_session);
      if ($get_row=mysqli_fetch_array($get_session_run))
       {
      $current_session=$get_row['id'];    // code...
      $current_session_name=$get_row['session_name'];    // code...
      }
   
   
   if ($code == 1) {
       $CategoryName = $_POST['CategoryName'];
       $category_insert = "INSERT into master_calegories (CategoryName)values ('$CategoryName')";
       $category_run = mysqli_query($conn, $category_insert);
       if ($category_run == true) {
   
          ?>
<script > window.location.href = 'category-manage.php'; </script> 
   <?php
      } else {
          echo "Ohh yaar ";
      }
      } else if ($code == 2) {
      $ArticleName = $_POST['ArticleName'];
      $CategoryID = $_POST['CategoryID'];
      $Article_insert = "INSERT into master_article (CategoryCode,ArticleName)values ('$CategoryID','$ArticleName')";
      $Article_run = mysqli_query($conn, $Article_insert);
      if ($Article_run == true) {
         ?>
   <script> window.location.href = 'article-manage.php'; 
</script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   } else if ($code == 3) {
   $BuildingName = $_POST['BuildingName'];
   
   $Building_insert = "INSERT into building_master (Name)values ('$BuildingName')";
   $Building_run = mysqli_query($conn, $Building_insert);
   if ($Building_run == true) {
        ?>
<script > window.location.href = 'building-master.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   } else if ($code == 4) {
   $RoomType = $_POST['RoomType'];
   $Block = $_POST['Block'];
   $Floor = $_POST['Floor'];
   $RoomNo = $_POST['RoomNo'];
   $RoomName = $_POST['RoomName'];
   $location_owner = $_POST['location_owner'];
   $College = $_POST['College'];
   $Building_insert = "INSERT into location_master (Block,Floor,RoomNo,location_owner,Type,RoomName,CollegeID)values ('$Block','$Floor','$RoomNo','$location_owner','$RoomType','$RoomName','$College')";
    $Building_run = mysqli_query($conn, $Building_insert);
    if ($Building_run == true) {
   ?>
<script> window.location.href = 'location-master.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   } else if ($code == 5) {
   $ID = $_POST['CategoryID'];
   
   ?>
<option value = ""> Select </option>
<?php
   $article = "SELECT * FROM master_article where CategoryCode='$ID' ";
   $article_run = mysqli_query($conn, $article);
   while ($article_row = mysqli_fetch_array($article_run)) {
      ?>
<option value ="<?=$article_row['CategoryCode']?>" > <?=$article_row['ArticleName'];?></option>
<?php
   }
   
   } else if ($code == 6) {
   $ArticleName = $_POST['ArticleName'];
   $CategoryID = $_POST['CategoryID'];
   
   
   $Summury_insert = "INSERT into stock_summary (CategoryCode,ArticleCode)values ('$CategoryID','$ArticleName')";
   $Summury_run = mysqli_query($conn, $Summury_insert);
   if ($Summury_run == true) {
       echo "Successfully Insert";
   } else {
       echo "Ohh yaar ";
   }
   
   } else if ($code == 7) {
   $id = $_POST['id'];
   
   
   $del_category = "DELETE from master_calegories where ID='$id'";
   $del_run = mysqli_query($conn, $del_category);
   if ($del_run == true) {
       echo "Successfully Insert";
   } else {
       echo "Ohh yaar ";
   }
   
   } else if ($code == 8) {
   $ID = $_POST['CategoryID'];
   
   ?>
<option value = ""> Select </option>
<?php
   $article = "SELECT * FROM master_article where CategoryCode='$ID' ";
   $article_run = mysqli_query($conn, $article);
   while ($article_row = mysqli_fetch_array($article_run)) {
      ?>
<option value = "<?=$article_row['ArticleCode']?>" > <?=$article_row['ArticleName'];?></option>
<?php
   }
   } else if ($code == 9) {
   $ID = $_POST['buildingID'];
   ?>
<option value = ""> Select </option>
<?php
   $article = "SELECT DISTINCT Floor FROM room_master ";
   $article_run = mysqli_query($conn, $article);
   while ($article_row = mysqli_fetch_array($article_run)) {
      ?>
<option value = "<?=$article_row['Floor']?>" > <?=$article_row['Floor'];?> </option>
<?php
   }
   
   } else if ($code == 10) {
   $ArticleName = $_POST['ArticleName'];
   $CategoryID = $_POST['CategoryID'];
   
   
   $Summury_insert = "INSERT into stock_summary (CategoryID,ArticleCode)values ('$CategoryID','$ArticleName')";
   $Summury_run = mysqli_query($conn, $Summury_insert);
   if ($Summury_run == true) {
       $description_insert = "INSERT into stock_description (IDNo)values ('')";
       mysqli_query($conn, $description_insert);
       ?>
<script> window.location.href = 'stock-summary.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   
   }
   else if ($code == 11) {
   $IDNo = $_POST['IDNo'];
   $Processor = $_POST['Processor'];
   $Operating = $_POST['Operating'];
   $Memory = $_POST['Memory'];
   $Storage = $_POST['Storage'];
   $Brand = $_POST['Brand'];
   $Model = $_POST['Model'];
   $SerialNo = $_POST['SerialNo'];
   $DeviceSerailNo = $_POST['DeviceSerailNo'];
   $BillNo = $_POST['BillNo'];
   $BillDate = $_POST['BillDate'];
   
   $Summury_insert = "UPDATE  stock_summary SET CPU='$Processor',OS='$Operating',Memory='$Memory',Storage='$Storage',Brand='$Brand',Model='$Model',SerialNo='$SerialNo',DeviceSerialNo='$DeviceSerailNo',Updated_By='$EmployeeID',Status='1',BillNo='$BillNo',BillDate='$BillDate' where IDNo='$IDNo'";
   $Summury_run = mysqli_query($conn, $Summury_insert);
   if ($Summury_run == true) {
       ?>
<script> window.location.href = 'stock-summary.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   }
   
   else if ($code == 12) {
   $ID = $_POST['Floor'];
   ?>
<option value = "" > Select </option>
<?php
   $article = "SELECT * FROM room_master where FloorID='$ID' ";
   $article_run = mysqli_query($conn, $article);
   while ($article_row = mysqli_fetch_array($article_run)) {
      ?>
<option value = "<?=$article_row['RoomNo']?>" > <?=$article_row['RoomNo'];?> </option>
<?php
   }
   } else if ($code == 13) {
   $ID = $_POST['Floor'];
   $block = $_POST['block'];
   
   ?>
<option value = "" > Select </option>
<
option value = "" > Select < /option> <?php
   $article = "SELECT *  from location_master l inner join room_type_master r on r.ID=l.Type  WHERE l.Floor='$ID' and l.Block='$block' ";
   $article_run = mysqli_query($conn, $article);
   while ($article_row = mysqli_fetch_array($article_run)) {
      ?>
<option value = "<?=$article_row['RoomNo']?>" > <?=$article_row['RoomNo'];?> </option>
<?php
   }
   
   } else if ($code == 14) {
   $ID = $_POST['Floor'];
   ?>
<option value = "" > Select </option>
<?php
   $article = "SELECT DISTINCT r.Floor, r.FloorID from location_master l inner join room_master r on r.FloorID=l.Floor where l.Block='$ID'";
   $article_run = mysqli_query($conn, $article);
   while ($article_row = mysqli_fetch_array($article_run)) {
      ?>
<option value = "<?=$article_row['FloorID']?>" > <?=$article_row['Floor'];?> </option>
<?php
   }
   } 
   else if ($code==15) 
   {
   $stockOwner=$_POST['stockOwner'];
   $ID = $_POST['IDNo'];
   $LocationID = trim($_POST['iDNo_assing']);
   $UserID = $_POST['UserID'];
   $date=date('Y-m-d');
    $one=date("His");
   $two= date("myd");
   $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
   $four=substr(str_shuffle($one.$two.$three),1,8);
   $result =$one.$three.$two.$four;
   
   $locationOwnerQry="SELECT location_owner from location_master Where ID='$LocationID'";
   $locationOwnerRes=mysqli_query($conn,$locationOwnerQry);
   while($locationOwnerData=mysqli_fetch_array($locationOwnerRes))
   {
   $UserID=$locationOwnerData['location_owner'];
   }
   
   $s="SELECT * FROM stock_summary Where IDNo='$ID' and Status=1";
   $ss=mysqli_query($conn,$s);
   if (mysqli_num_rows($ss)>0) 
   {
      $room_type_insert = "UPDATE  stock_summary SET LocationID='$LocationID',Corrent_owner='$stockOwner',IssueDate='$date' ,Status='2', reference_no='$result', Updated_By='$EmployeeID' where IDNo='$ID'";
   
   $type_run = mysqli_query($conn,$room_type_insert);
   
   
   if ($type_run == true) {
       $description_insert="INSERT INTO stock_description (IDNo,Date_issue,Direction,LocationID,OwerID,Remarks,WorkingStatus,DeviceSerialNo,Updated_By,reference_no) values ('$ID','$date','Issued','$LocationID','$stockOwner','Issued','0','0','$EmployeeID','$result')";
       mysqli_query($conn, $description_insert);
      ?>
<script> window.location.href='stock-summary.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   }
   else
   {
   echo "Already Assigned or ";
   }
   
   } else if ($code == 16) {
   $room_Name = $_POST['room_type_Name'];
   $room_type_insert = "INSERT into room_name_master (RoomName)values ('$room_Name')";
   $type_run = mysqli_query($conn, $room_type_insert);
   if ($type_run) {
      ?>
<script> window.location.href='room-type.php'; </script> 
<?php
   } else {
       echo "please Try After Sometime... ";
   }
   
   } else if ($code == 17) {
   $ID = $_POST['Floor'];
   $block = $_POST['block'];
   $room = $_POST['RoomNo'];
   ?>
<option value = "" > Select </option>
<?php
   $article = "SELECT *  from location_master l inner join room_type_master r on r.ID=l.Type  WHERE l.Floor='$ID' and l.Block='$block' and l.RoomNo='$room'";
   $article_run = mysqli_query($conn, $article);
   while ($article_row = mysqli_fetch_array($article_run)) {
      ?>
<option value = "<?=$article_row['Type']?>"> <?=$article_row['RoomType'];?>  </option>
<?php
   }
   
   } else if ($code == 18) {
   $ID = $_POST['id'];
   $Articlename = $_POST['Articlename'];
   $room_type_insert = "UPDATE  master_article SET ArticleName='$Articlename' where ArticleCode='$ID'";
   $type_run = mysqli_query($conn, $room_type_insert);
   if ($type_run == true) {
      ?>
<script > window.location.href = 'article-manage.php'; </script> 
<?php
   }
   } else if ($code == 19) {
   $ID = $_POST['id'];
   $CategoryName = $_POST['CategoryName'];
   $room_type_insert = "UPDATE  master_calegories SET CategoryName='$CategoryName' where ID='$ID'";
   $type_run = mysqli_query($conn, $room_type_insert);
   if ($type_run == true) {
      ?>
<script > window.location.href = 'category-manage.php'; </script> 
<?php
   }
   } 
   else if ($code == 20) {
      $pagelink=$_POST['pageUrl'];
   $IDNo = $_POST['IDNo'];
   $Processor = $_POST['Processor'];
   $Operating = $_POST['Operating'];
   $Memory = $_POST['Memory'];
   $Storage = $_POST['Storage'];
   $Brand = $_POST['Brand'];
   $Model = $_POST['Model'];
   $SerialNo = $_POST['SerialNo'];
   $DeviceSerailNo = $_POST['DeviceSerailNo'];
   
   $BillNo = $_POST['BillNo'];
   $BillDate = $_POST['BillDate'];
      $currentLocation='0';
      $currentOwner='0';
      $workingStatus='0';
      $referenceNo='0';
   $Summury_status_check="SELECT * FROM stock_summary where IDNo='$IDNo' and Status='2'";
   $Status_Summury_run = mysqli_query($conn, $Summury_status_check);
   if (mysqli_num_rows($Status_Summury_run)>0) 
   {
      if ($rowData=mysqli_fetch_array($Status_Summury_run)) {
         // code...
      
      $workingStatus=$rowData['WorkingStatus'];
      $currentLocation=$rowData['LocationID'];
      $currentOwner=$rowData['Corrent_owner'];
      $referenceNo=$rowData['reference_no'];
   }
      $Summury_insert = "UPDATE  stock_summary SET CPU='$Processor',OS='$Operating',Memory='$Memory',Storage='$Storage',Brand='$Brand',Model='$Model',SerialNo='$SerialNo',DeviceSerialNo='$DeviceSerailNo',Updated_By='$EmployeeID',BillNo='$BillNo',BillDate='$BillDate' where IDNo='$IDNo'";
   }
   else
   {
      $Summury_insert = "UPDATE  stock_summary SET CPU='$Processor',OS='$Operating',Memory='$Memory',Storage='$Storage',Brand='$Brand',Model='$Model',SerialNo='$SerialNo',DeviceSerialNo='$DeviceSerailNo',Updated_By='$EmployeeID',Status='1',BillNo='$BillNo',BillDate='$BillDate' where IDNo='$IDNo'";
   }
   
   $Summury_run = mysqli_query($conn, $Summury_insert);
   if ($Summury_run == true) 
   {
      $date=date('Y-m-d');
      $qry2="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$IDNo', '$date', 'Updated', '$currentLocation', '$currentOwner', 'Updated', '$workingStatus', '$DeviceSerailNo', '$EmployeeID','$referenceNo')";
            $res=mysqli_query($conn,$qry2);
       ?>
<script > window.location.href = '<?=$pagelink?>'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   
   } else if ($code == 21) {
   $id = $_POST['id'];
   $RoomType = $_POST['RoomType'];
   $room_type_insert = "UPDATE  room_type_master SET RoomType='$RoomType' WHERE ID='$id'";
   $type_run = mysqli_query($conn, $room_type_insert);
   if ($type_run == true) {
      ?>
<script > window.location.href = 'room-type.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   } else if ($code == 22) {
   $id = $_POST['id'];
   $Roomname = $_POST['Roomname'];
   $room_name_insert = "UPDATE  room_name_master SET RoomName='$Roomname' WHERE ID='$id'";
   $name_run = mysqli_query($conn, $room_name_insert);
   if ($name_run == true) {
      ?>
<script > window.location.href = 'room-name.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   } else if ($code == 23) {
   $id = $_POST['id'];
   $col1 = $_POST['col1'];
   $col2 = $_POST['col2'];
   $col3 = $_POST['col3'];
   $col4 = $_POST['col4'];
   $col5 = $_POST['col5'];
   $col6 = $_POST['col6'];
   
   
   $specification_update = "UPDATE  specification SET Brand='$col1',RAM='$col2',Model='$col3',Storage='$col4',Processor='$col5',OS='$col6' WHERE ID='$id'";
   $update_run = mysqli_query($conn, $specification_update);
   if ($update_run == true) {
      ?>
<script > window.location.href = 'specifications.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   } else if ($code == 24) {
   $id = $_POST['id'];
   $col1 = $_POST['col1'];
   $col2 = $_POST['col2'];
   $col3 = $_POST['col3'];
   $col4 = $_POST['col4'];
   $col5 = $_POST['col5'];
   $col6 = $_POST['col6'];
   $specification_insert = "INSERT Into specification (Brand,RAM,Model,Storage,Processor,OS) values ('$col1','$col2','$col3','$col4','$col5','$col6')";
   $insert_run = mysqli_query($conn, $specification_insert);
   if ($insert_run == true) {
      ?>
<script > window.location.href = 'specifications.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   }
   elseif($code==25)        
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
         echo $val;
         $per1=array();
         if (isset($_POST[$val])) 
         {
             $per1=$_POST[$val];
         }
    for ($i=0; $i<=2; $i++) { 
        //echo $val."-".$per1[$i];
        echo  "<br>";
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
        else
        {
        }
    }       
    }
   $in_per="INSERT into special_permission(emp_id,page_id,I,U,D)values('$user_id','$val','$I','$U','$D')";
   mysqli_query($conn,$in_per);
   }
   
   echo "<script>window.close();</script>";
   }
   elseif ($code==26) {
   $room_type_Name = $_POST['room_type_Name'];
   $room_type_insert = "INSERT into room_type_master(RoomType)values ('$room_type_Name')";
   $type_run = mysqli_query($conn,$room_type_insert);
   if ($type_run) {
       ?>
<script>window.location.href='room-type.php'; </script>  
<?php  } 
   else 
   {
       echo "please Try After Sometime... ";
   }
   
   } 
   elseif($code==27)
   {
   $check=$_POST['check'];
   //print_r($check);
   foreach ($check as $item) {
         $item;
    $LocationID = $_POST['locationID'];
     $UserID =$_POST['User_ID'];
    $date=$_POST['IssueDate'];
   $one=date("His");
   $two= date("myd");
   $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
   $four=substr(str_shuffle($one.$two.$three),1,8);
   $result =$one.$three.$two.$four;
   
       $room_type_insert = "UPDATE  stock_summary SET LocationID='$LocationID',Corrent_owner='0',IssueDate='$date' ,Updated_By='$EmployeeID',WorkingStatus='0', Status='2', reference_no='$result' where IDNo='$item'";
    $type_run = mysqli_query($conn, $room_type_insert);
   if ($type_run == true) {
        $description_insert="INSERT INTO stock_description (IDNo,Date_issue,Direction,LocationID,OwerID,Remarks,WorkingStatus,DeviceSerialNo,Updated_By,reference_no) values ('$item','$date','Issued','$LocationID','0','Issued','0','0','$EmployeeID','$result')";
      mysqli_query($conn, $description_insert);
      ?>
<script > window.location.href='location-master.php'; </script>  
<?php
   } else {
       echo "Ohh yaar ";
   }
   } 
   }
   elseif ($code==28) {
   $LocationID=$_POST['locationID'];
    $location_owner = $_POST['location_owner'];
    $type =$_POST['RoomType'];
    $roomname=$_POST['RoomName'];
    $College=$_POST['College'];
      $update_location = "UPDATE  location_master SET Type='$type',location_owner='$location_owner',RoomName='$roomname',CollegeID='$College' where ID='$LocationID'";
   $type_run = mysqli_query($conn, $update_location);
   if ($type_run == true) {
      ?>
<script > window.location.href='location-master.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   
   }
   
   else if ($code == 29) {
   // echo $RoomTypeID = $_POST['RoomType'];
   $officeOwnerID= $_POST['officeOwnerID'];
   ?>
<form action="export.php" method="post">
   <input type="hidden" name="exportCode" value="0">
   <input type="hidden" name="office_owner" value="<?=$officeOwnerID?>">
   <div class="card card-info">
      <div class="card-header">
         <h3 class="card-title">Spot Wise Stocks</h3>
         <div class="card-tools">
            <div class="row">
               <div class="btn-group btn-group-xs" style="width: 150px;">
                  <button type="submit" class="form-control float-right btn-success" style="margin-top: -5px;">
                  Export
                  </button>
               </div>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <!-- <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);" >
                  </div> -->
            </div>
         </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0" style="height: 400px;">
         <table class="table table-head-fixed text-nowrap" id="example">
            <?php 
               $category="SELECT * FROM category_permissions where employee_id='$EmployeeID'";
                          $category_run=mysqli_query($conn,$category);
                          if (mysqli_num_rows($category_run)>0) 
                          {
                            ?>
            <thead>
               <tr>
                  <th>Sr. No.</th>
                  <th>College Name</th>
                  <th>Floor</th>
                  <th>Room Name</th>
                  <th>Room No.</th>
                  <th>View</th>
                  <?php
                     while ($category_row=mysqli_fetch_array($category_run)) 
                     { 
                         $cat_id_array[]=$category_row['CategoryCode'];
                     }
                     $arrayCatCount=count($cat_id_array);
                     for($i=0;$i<$arrayCatCount;$i++)
                     {
                         $cat_id=$cat_id_array[$i];           
                         if ($officeOwnerID!='') 
                         {
                             $article="SELECT distinct ArticleName from stock_summary inner join master_article ON stock_summary.ArticleCode=master_article.ArticleCode INNER JOIN location_master ON location_master.ID=stock_summary.LocationID where stock_summary.Status='2' AND location_master.location_owner='$officeOwnerID' and master_article.CategoryCode='$cat_id' order by master_article.ArticleCode asc";
                         }             
                         else
                         {
                         $article="SELECT * from master_article where CategoryCode='$cat_id' order by master_article.ArticleCode asc";
                         }
                         $article_run=mysqli_query($conn,$article);
                         while ($article_row=mysqli_fetch_array($article_run)) 
                         {
                             ?>
                  <th><?=$article_row['ArticleName']?></th>
                  <?php
                     }
                     }
                     
                     ?>
               </tr>
            </thead>
            <tbody>
               <?php
                  $srNO=1;
                  if ($officeOwnerID!='') 
                  {       
                  
                      $sql=" SELECT *, colleges.shortname as clg_name ,room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID WHERE location_master.location_owner='$officeOwnerID' order by location_master.ID asc";
                  }
                  else
                  {
                      $sql=" SELECT *, colleges.shortname as clg_name ,room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID order by location_master.ID asc ";
                  }
                  $arrayIndex=0;
                  $res_r = mysqli_query($conn, $sql);
                  while ($data = mysqli_fetch_array($res_r)) 
                  {
                      $lm_ID=$data['lm_id'];
                      $OfficeName = $data['RoomName'];
                      $block = $data['Name'];
                      $RoomType = $data['Type'];
                      $officeID = $data['rnm_id'];
                      $clgName = $data['clg_name'];
                      $RoomNo = $data['RoomNo'];
                      $Floor = $data['Floor_name'];
                      if ($Floor == 0)
                      {
                          $FloorName = 'Ground';
                      }
                      elseif ($Floor == 1)
                      {
                          $FloorName = 'First';
                      }
                      elseif ($Floor == 2)
                      {
                          $FloorName = 'Second';
                      }
                      elseif ($Floor == 3)
                      {
                          $FloorName = 'Third';
                      }
                      elseif ($Floor == 4)
                      {
                          $FloorName = 'Fourth';
                      }
                          $arrayCount=0;
                      for($k=0;$k<$arrayCatCount;$k++)
                      {
                          $cat_id=$cat_id_array[$k];
                          $building_num=0;
                          if ($officeOwnerID!='') 
                          {
                              $building="SELECT distinct ArticleCode  from stock_summary inner join location_master on location_master.ID=stock_summary.LocationID where CategoryID='$cat_id' and location_owner='$officeOwnerID' order by ArticleCode asc ";
                          }
                          else
                          {
                              $building="SELECT * from master_article where CategoryCode='$cat_id' order by ArticleCode asc ";
                          }
                          $building_run=mysqli_query($conn,$building);
                          while ($building_row=mysqli_fetch_array($building_run)) 
                          {
                              $building_num=$building_num+1;
                                  $name='';
                             
                              $count=0;
                              $article_code=$building_row['ArticleCode'];
                           $qry="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join location_master on location_master.ID=stock_summary.LocationID where stock_summary.Status='2' and location_master.Type='$RoomType' and location_master.ID='$lm_ID' and stock_summary.ArticleCode='$article_code' and master_article.CategoryCode='$cat_id' ";
                              $run=mysqli_query($conn,$qry);
                              while($data=mysqli_fetch_array($run))
                              {
                                  $count++;
                                  $name=$data['ArticleName'];
                              }
                              $array[$arrayIndex][]=$count;
                              $arrayCount++;
                          }
                      }
                     
                      if(max($array[$arrayIndex])>0)
                      {
                          ?>
               <tr>
                  <td><?=$srNO?></td>
                  <td><?=$clgName?> </td>
                  <td><?=$FloorName?> </td>
                  <td><?=$OfficeName?>(<?=$block?>  Block)</td>
                  <td><?=$RoomNo?> </td>
                  <td>
                     <i class="fa fa-eye fa-lg" onclick="view_office_stock(<?=$lm_ID;?>,<?=$RoomType?>);" data-toggle="modal" data-target="#view_assign_stock_office_Modal_location" style="color:red;"></i>
                     <i class="fa fa-eye fa-lg" onclick="view_serial_no(<?=$lm_ID;?>,<?=$RoomType?>);" data-toggle="modal" data-target="#view_serial_no_Modal" style="color:blue;"></i>
                  </td>
                  <?php
                     for($i=0;$i<$arrayCount;$i++)
                     { 
                         ?>
                  <td>
                     <!-- <?=print_r($array[$arrayIndex])?> -->
                     <?=$array[$arrayIndex][$i]?>
                  </td>
                  <?php
                     }
                     ?>
               </tr>
               <?php
                  $srNO++;
                  }
                  $arrayIndex++;
                  }
                  ?>
            </tbody>
            <?php }
               // print_r($array); ?>
         </table>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</form>
<?php
   }
   else if ($code == 30) {
       $RoomType = $_POST['RoomType'];
       $location_ID_ = $_POST['officeID'];
   
   
   ?>
<div class="modal-body">
   <div class="row">
      <div class="col-lg-3">
         <label>Employee ID </label>
         <input type="number" name="Employee_ID" id="Employee_ID" class="form-control" onkeyup="emp_detail_verify(this.value,2,0);">
         <p id="emp_detail_status_"></p>
      </div>
      <div class="col-lg-2">
         <label>Assign</label>
         <br>
         <input type="radio" name="bulk_assign" onclick="bulk_select(this.value);" id="bulk_assign" value="0" hidden> 
         <label for="bulk_assign" class="btn btn-info btn-xs">Clear</label>
         &nbsp;
         <input type="radio" name="bulk_assign" onclick="bulk_select(this.value);" id="bulk_assign11" value="1" hidden>
         <label for="bulk_assign11" class="btn btn-outline-info btn-xs">&nbsp;All&nbsp;</label>
      </div>
      <div class="col-lg-2" >
         <label>Action</label>
         <button type="button" name="assignAll" id="assignAll" class=" btn btn-primary btn-xs" onclick="bulk_assign_id()">Bulk Assign</button>
      </div>
      <div class="col-lg-2"></div>
      <div class="col-lg-3">
         <label> Search Article </label>
         <input type="number" name="ArticleNum" id="ArticleNum" class="form-control" onkeyup="Article_Num(this.value,<?=$location_ID_?>,<?=$RoomType?>);">
      </div>
   </div>
   <br>
   <div class="card-body table-responsive p-0" style="height: 400px;">
      <table class="table table-head-fixed text-nowrap" border="1">
         <thead>
            <tr>
               <th>Sr. no.</th>
               <th>ID</th>
               <!-- <th>Category Name</th> -->
               <th>Article</th>
               <th>View</th>
               <!--  <th>Oprating System</th>
                  <th>Memory</th> -->
               <th>Status</th>
               <th>Assigned To</th>
               <th>Action</th>
               <?php
                  if ($permissionCount>0) 
                  {
                   ?>
               <th>Return</th>
               <?php
                  }
                       ?>
            </tr>
         </thead>
         <tbody id="search_office_data">
            <?php 
               $building_num=0;
               $sr=0;
               $arrayFaultyArticle[]='';
               $category="SELECT * FROM category_permissions where employee_id='$EmployeeID'";
                    $category_run=mysqli_query($conn,$category);
                    while ($category_row=mysqli_fetch_array($category_run)) 
                    { 
                        $cat_id_array[]=$category_row['CategoryCode'];
                    }
                    $arrayCatCount=count($cat_id_array);
               for($k=0;$k<$arrayCatCount;$k++)
                {
                    $cat_id=$cat_id_array[$k];
               // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
               $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join faulty_track on faulty_track.article_no=stock_summary.IDNo where stock_summary.Status='2'  and location_master.ID='$location_ID_' AND master_article.CategoryCode='$cat_id' order by token_no and ArticleName DESC ";
               $building_run=mysqli_query($conn,$building);
               while ($building_row=mysqli_fetch_array($building_run)) 
               {
                if (!in_array($building_row['IDNo'], $arrayFaultyArticle)) 
               {
                $EmployeeID=$building_row['Corrent_owner'];
                $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
               $q1 = sqlsrv_query($conntest, $sql1);
               while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) {
               $name = $row['Name'];
               }
               
               $building_num=$building_num+1;
               ?>
            <tr>
               <td><?=$building_num?></td>
               <td><?=$building_row['IDNo'];?>
                  <?php 
                     if ($building_row['Corrent_owner']=='0')
                     {
                      ?>
                  <input type="hidden" class="form-control" name="IDNO" id="assign_<?=$sr?>" value="<?=$building_row['IDNo'];?>">
                  <?php
                     }
                     ?>
               </td>
               <td><?=$building_row['ArticleName'];?></td>
               <td>
                  <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
               </td>
               <td>
                  <?php 
                     if ($building_row['WorkingStatus']==0) 
                     {
                       ?>
                  <a class="btn btn-success btn-xs" style="color:white;"> Working</a>
                  <?php
                     }
                     elseif ($building_row['WorkingStatus']==1) 
                     {
                        ?>
                  <a class="btn btn-warning btn-xs"> Faulty </a>
                  <?php
                     }
                       ?>
               </td>
               <?php if ($building_row['Corrent_owner']!='0')
                  {
                     if (strlen($building_row['Corrent_owner'])>7) 
             {
               $result1 = "SELECT  * FROM Admissions where UniRollNo='$EmployeeID' or ClassRollNo='$EmployeeID' or IDNo='$EmployeeID'";
               $stmt1 = sqlsrv_query($conntest,$result1);
               while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
               {
           
                 $IDNo= $row['IDNo'];
                 $ClassRollNo= $row['ClassRollNo'];
                 $UniRollNo= $row['UniRollNo'];
                 $name = $row['StudentName'];
   
               }
            }
                  ?>
               <td>
                  <div class="row" id="sinlge_assign1" >
                     <div class="col-lg-8">
                        <?=$name;?> (<?=$building_row['Corrent_owner'];?>)
                     </div>
                     <div class="col-lg-4">
                        <button type="button" onclick="remove(<?=$building_row['IDNo'];?>,<?=$building_row['Corrent_owner'];?>,<?=$RoomType?>,<?=$location_ID_?>);"  class="btn-xs btn btn-danger">Remove</button>
                     </div>
                  </div>
               </td>
               <?php
                  }
                  else
                  {
                  ?>
               <td>
                  <div class="row" id="sinlge_assign">
                     <div class="col-lg-8">
                        <input type="number" class="form-control" name="current_owner" id="current_owner_<?=$sr?>" value="" onkeyup="emp_detail_verify(this.value,1,<?=$building_row['IDNo'];?>);">
                        <p id="emp_detail_status_<?=$sr?>"></p>
                        <input type="hidden" class="form-control" name="sinlge_assign_sr" id="sinlge_assign_sr_<?=$building_row['IDNo'];?>" value="<?=$sr?>">
                     </div>
                     <div class="col-lg-4" id="assign_button_<?=$sr?>">
                        <button type="button" class="btn-xs btn btn-primary" onclick="singleAssign(<?=$building_row['IDNo'];?>,<?=$RoomType?>,<?=$location_ID_?>);">Assign</button>
                     </div>
                  </div>
               </td>
               <?php
                  $sr++;
                   }
                   ?>
               <td>
                  <?php 
                     if ($building_row['WorkingStatus']==0) 
                     {
                         ?>
                  <button type="button" class=" btn btn-warning btn-xs" data-toggle="modal" data-target="#fault_Modal" onclick="fault_description(<?=$building_row['IDNo'];?>)">Mark Faulty </button>
                  <?php
                     }
                     elseif ($building_row['WorkingStatus']==1) 
                     {
                         ?>
                  <button type="button" class=" btn btn-dark btn-xs" data-toggle="modal" data-target="#fault_Modal" onclick="track(<?=$building_row['token_no'];?>)">Track</button>
                  <?php  // code...
                     }
                       ?>
               </td>
               <?php
                  if ($permissionCount>0) 
                  {
                   ?>
               <td>
                  <i class="fa fa-arrow-left fa-lg" onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:red;"></i>
               </td>
               <?php
                  }
                       ?>
            </tr>
            <?php 
               $arrayFaultyArticle[]=$building_row['IDNo'];
               }
                  }
                         }    ?>
         </tbody>
      </table>
   </div>
   <input type="hidden" name="serial_no" value="<?=$sr?>" id='serial_no'>
</div>
<div class="modal-footer">
   <?php
      if ($permissionCount>0) 
      {
       ?>
   <!-- <form action="stock_report.php" method="post" target="_blank">
      <input type="hidden" name="ID" value="<?=$location_ID_?>">
      <button class="fa fa-print fa-lg" type="submit" style="color: green; border: none; background: none;"></button>
   </form> -->
   <input type="submit" class="btn btn-success btn-xs" name="" value="Assign"  onclick="page_open(<?=$location_ID_?>);">
   <?php
      }
       ?>
       <form action="stock_report.php" method="post" target="_blank">
      <input type="hidden" name="ID" value="<?=$location_ID_?>">
      <button class="fa fa-print fa-lg" type="submit" style="color: green; border: none; background: none;"></button>
   </form>
   <form action="export.php" method="post">
      <input type="hidden" name="exportCode" value="1">
      <input type="hidden" name="roomTypeID" value="<?=$RoomType?>">
      <input type="hidden" name="office_ID" value="<?=$location_ID_?>">
      <button type="submit" class="btn btn-primary btn-xs" >Export</button>
   </form>
   <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
   <!--  <button type="submit" class="btn btn-primary">Save</button> -->
</div>
<?php
   }
   else if ($code == 31) {
        $empID = $_POST['emp_id'];
        if ($empID!='') {
            // code...
        
   
   ?>
<form action="export.php" method="post">
   <input type="hidden" name="exportCode" value="2">
   <input type="hidden" name="idEmp" value="<?=$empID?>">
   <div class="card card-info">
      <div class="card-header">
         <h3 class="card-title">Stocks assigned to Employee</h3>
         <div class="card-tools">
            <div class="row">
               <div class="btn-group btn-group-xs" style="width: 150px;">
                  <button type="submit" class="form-control float-right btn-success" style="margin-top: -5px;">Export</button>
               </div>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <div class="input-group input-group-xs" style="width: 150px;">

               
                  <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);" > -->
                  
                  </div>
            </div>
         </div>
      </div>

<?php  $result1 = "SELECT  * FROM Staff where IDNo='$empID'";
               $stmt1 = sqlsrv_query($conntest,$result1);
               while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
               {
           
                 $StaffName= $row['Name'];
                 $Department= $row['Department'];
                 $UniRollNo= $row['MotherName'];
                 $Designation = $row['Designation'];
   
               }?>
 <div class="card card-widget widget-user-2" style="width:400px" id="printableArea">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header badge-success">
                <div class="row">
                  <div class="col-lg-11 col-sm-10"> <div class="widget-user-image">
                  
                </div>
                <!-- /.widget-user-image -->
                <h6 class="widget-user-username"><b> <?= $StaffName ;?>  (<?=$empID?>) </b></h6>
                <h6 class="widget-user-desc"><?= $Designation;?>(<?= $Department;?>)</h6>
                </div>
                <div class="col-lg-1 col-sm-1">

  
       <i class="fa fa-eye fa-lg" onclick="view_emp_stock(<?=$empID?>);" data-toggle="modal" data-target="#view_assign_stock_employee_Modal" style="color:yellow;"></i><br>

<br>
<?php
                  if ($permissionCount>0) 
                  {
                   ?>
     <b> <i class="fa fa-arrow-right" onclick="nodues(<?=$empID?>);" data-toggle="modal" data-target="#noduesmodal" style="color:yellow;"></i></b>
  <?php }?>
      
      </div>
             </div>
               
               


              </div>


              <div class="card-footer p-0">
                <ul class="nav flex-column">


<?php
                     $article="SELECT distinct ArticleName,stock_summary.ArticleCode as acode  from master_article inner join stock_summary ON stock_summary.ArticleCode=master_article.ArticleCode INNER JOIN location_master ON location_master.ID=stock_summary.LocationID inner join category_permissions ON category_permissions.CategoryCode=master_article.CategoryCode where  stock_summary.Status='2' and  stock_summary.Corrent_owner='$empID' and employee_id='$EmployeeID' ";
                     
                     $article_run=mysqli_query($conn,$article);
                     while ($article_row=mysqli_fetch_array($article_run)) 
                     {
                          $count=0;
                         ?>
                  

                  <li class="nav-item">
                     <li class="nav-link"><b><?=$article_row['ArticleName']?> :&nbsp;&nbsp;&nbsp; </b> 
<?php  $article_code=$article_row['acode'];

                         $qry="SELECT * FROM stock_summary   where Status='2' and Corrent_owner='$empID' and ArticleCode='$article_code' order by IDNo DESC";
                      $run=mysqli_query($conn,$qry);
                      while($data=mysqli_fetch_array($run))
                      {
                          $count++;
                      }
                    echo   $count;
                     ?>


                       


                        </li>
                  </li>
                
                  <?php
                     }
                     
                     ?>             
                     


                  
                   
                  
                  
                </ul>
              </div>
            </div>



      <!-- /.card-header -->
    <!--   <div class="card-body table-responsive p-0" style="height: 400px;">
         <table class="table table-head-fixed text-nowrap" >
            <?php 
               ?>
            <thead>
               <tr>
                  <th>Employee ID</th>
                  <th>View</th>
                  <?php
                     $article="SELECT distinct ArticleName  from master_article inner join stock_summary ON stock_summary.ArticleCode=master_article.ArticleCode INNER JOIN location_master ON location_master.ID=stock_summary.LocationID inner join category_permissions ON category_permissions.CategoryCode=master_article.CategoryCode where  stock_summary.Status='2' and  stock_summary.Corrent_owner='$empID' and employee_id='$EmployeeID' ";
                     // $article="SELECT * from master_article where CategoryCode='$cat_id'";
                     $article_run=mysqli_query($conn,$article);
                     while ($article_row=mysqli_fetch_array($article_run)) 
                     {
                         ?>
                  <th><?=$article_row['ArticleName']?></th>
                  <?php
                     }
                     
                     ?>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td><?=$empID?> </td>
                  <td><i class="fa fa-eye fa-lg" onclick="view_emp_stock(<?=$empID?>);" data-toggle="modal" data-target="#view_assign_stock_employee_Modal" style="color:red;"></i></td>
                  <?php 
                     $building_num=0;
                     
                     $building="SELECT distinct ArticleName, stock_summary.ArticleCode as MA_AC from master_article inner join stock_summary ON stock_summary.ArticleCode=master_article.ArticleCode INNER JOIN location_master ON location_master.ID=stock_summary.LocationID inner join category_permissions ON category_permissions.CategoryCode=master_article.CategoryCode where  stock_summary.Status='2' and  stock_summary.Corrent_owner='$empID' and employee_id='$EmployeeID'";
                     $building_run=mysqli_query($conn,$building);
                     while ($building_row=mysqli_fetch_array($building_run)) 
                     {
                     $building_num=$building_num+1;
                     $count=0;
                      $article_code=$building_row['MA_AC'];
                      $qry="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode  where stock_summary.Status='2' and stock_summary.Corrent_owner='$empID' and stock_summary.ArticleCode='$article_code' order by IDNo DESC";
                      $run=mysqli_query($conn,$qry);
                      while($data=mysqli_fetch_array($run))
                      {
                          $count++;
                      }
                      $count;
                     ?>
                  <td><?=$count?></td>
                  <?php 
                     }
                                ?>
               </tr>
            </tbody>
            <?php 
               // }
                ?>  
         </table>
      </div> -->
    
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</form>
<?php
   }
   }
   else if ($code == 32) {
     $emp_id=$_POST['emp'];
                               $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$emp_id'";
   $q1 = sqlsrv_query($conntest, $sql1);
   while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) {
       $name = $row['Name'];
       $empID_=$emp_id;
   }
   
   
   ?>
<div class="card-body table-responsive p-0" style="height: 400px;">
   <div class="row">
      <div class="col-lg-8">
         <?php if (isset($empID_)) 
            {
             ?> 
         <h4><?=$name;?>(<?=$empID_?>)</h4>
         <?php  // code...
            } 
            ?>
      </div>
      <div class="col-lg-4">
         <label> Search Article</label>
      <input type="number" name="ArticleNum" id="ArticleNum" class="form-control" onkeyup="Article_Num_emp(this.value,<?=$empID_?>);">
      </div>
   </div>
   <br>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Sr. No.</th>
            <th>ID</th>
            <th>Article</th>
            <th>View</th>
            <?php
               if ($permissionCount>0) 
               {
                ?>
            <th>Print</th>
            <th>Return</th>
            <?php
               }
               ?>
         </tr>
      </thead>
      <tbody id='table_emp_search_modal'>
         <?php 
            $building_num=0;
            // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
            $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join category_permissions on category_permissions.CategoryCode=master_article.CategoryCode  where stock_summary.Status='2' and stock_summary.Corrent_owner='$emp_id' and category_permissions.employee_id='$EmployeeID' order by IDNo DESC ";
            $building_run=mysqli_query($conn,$building);
            while ($building_row=mysqli_fetch_array($building_run)) 
            {
            $building_num=$building_num+1;
            
            $emp_id=$building_row['Corrent_owner'];
            
            ?>
         <tr>
            <td><?=$building_num?></td>
            <td><?=$building_row['IDNo'];?></td>
            <td><?=$building_row['ArticleName'];?></td>
            <td>
               <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
            </td>
            <?php
               if ($permissionCount>0) 
               {
                ?>
            <td>
               <form action="report-print.php" method="post" target="_blank">
                  <input type="hidden" name="IdNo" value="<?=$building_row['reference_no'];?>">
                  <button class='btn border-0 shadow-none' >
                  <i class="fa fa-print fa-lg"  type='submit'  style="color:blue;"></i>
                  </button>
               </form>
            </td>
            <td>
               <i class="fa fa-arrow-left fa-lg" data-dismiss="modal" onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:red;"></i>
            </td>
            <?php
               }
                ?>
         </tr>
         <?php 
            }
                       ?>
      </tbody>
   </table>

   <form action="export.php" method="post">
      <input type="hidden" name="exportCode" value="3">
      <input type="hidden" name="idEmployee" value="<?=$emp_id?>">
      <br>
      <div class="row">
         <div class="col-lg-10"></div>
         <div class="col-lg-2">
            <button type="submit" class="btn btn-primary form-control" >Export</button>
         </div>
      </div>
   </form>
</div>
<?php
   }
   else if ($code == 33) {
        $locationOwnerID = $_POST['locationOwnerID'];
   
   
   ?>
<form action="export.php" method="post" target="_blank">

   <div class="card card-info">
      <div class="card-header">
         <h3 class="card-title">Stocks assigned to Owner</h3>
         <div class="card-tools">
            <div class="row">
               <div class="btn-group btn-group-xs" style="width: 150px;">
<input type="hidden" name="office_owner" value="<?=$locationOwnerID;?>">
<input type="hidden" name="exportCode" value="0">
                  <button type="submit" class="form-control float-right btn-success" style="margin-top: -5px;">Export</button>
               </div>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <!-- <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);" >
                  
                  </div> -->
            </div>
         </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0" style="height: 400px;">
         <table class="table table-head-fixed text-nowrap" >
            <thead>
               <tr>
                  <th>Location Owner</th>
                  <th>View</th>
                  <?php
                     $article="SELECT distinct ArticleName FROM category_permissions inner join master_article on master_article.CategoryCode=category_permissions.CategoryCode inner join stock_summary on stock_summary.ArticleCode=master_article.ArticleCode inner join location_master on location_master.ID=stock_summary.LocationID where employee_id='$EmployeeID' and Status='2' and location_owner='$locationOwnerID'";
                     $article_run=mysqli_query($conn,$article);
                     while ($article_row=mysqli_fetch_array($article_run)) 
                     {
                     ?>
                  <th><?=$article_row['ArticleName']?></th>
                  <?php
                     }
                     ?>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td><?=$locationOwnerID?>  </td>
                  <td><i class="fa fa-eye fa-lg" onclick="view_location_owner_stock(<?=$locationOwnerID?>);" data-toggle="modal" data-target="#view_assign_stock_office_Modal" style="color:red;"></i></td>
                  <?php 
                     $building_num=0;
                     $building="SELECT distinct ArticleName, stock_summary.ArticleCode FROM category_permissions inner join master_article on master_article.CategoryCode=category_permissions.CategoryCode inner join stock_summary on stock_summary.ArticleCode=master_article.ArticleCode inner join location_master on location_master.ID=stock_summary.LocationID where employee_id='$EmployeeID' and Status='2' and location_owner='$locationOwnerID'";
                     $building_run=mysqli_query($conn,$building);
                     while ($building_row=mysqli_fetch_array($building_run)) 
                     {
                     $building_num=$building_num+1;
                          // $articleName=$building_row['ArticleName'];
                     $count=0;
                      $article_code=$building_row['ArticleCode'];
                      $qry="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join location_master on location_master.ID=stock_summary.LocationID where stock_summary.Status='2' and location_master.location_owner='$locationOwnerID' and stock_summary.ArticleCode='$article_code' order by IDNo DESC";
                      $run=mysqli_query($conn,$qry);
                      while($data=mysqli_fetch_array($run))
                      {
                          $count++;
                      }
                      $count;
                      $articleName;
                     ?>
                  <td><?=$count?></td>
                  <?php 
                     }
                                ?>
               </tr>
            </tbody>
         </table>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</form>
<?php
   }
   else if ($code == 34) {
       if (isset($_POST['emp'])) {
           // code...
       $locationOwnerID=$_POST['emp'];
       }
       else
       {
   
       $locationOwnerID='';
       }
   
   ?>
<input type="hidden" name="ownerID" value="<?=$locationOwnerID?>">
<input type="hidden" name="exportCode" value="4">
<div class="card-body table-responsive p-0" style="height: 400px;">
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Sr. No.</th>
            <th>ID</th>
            <!-- <th>Category Name</th> -->
            <th>Article</th>
            <th>View</th>
            <th>Assigned To</th>
            <?php
               if ($permissionCount>0) 
               {
                ?>
            <th>Return</th>
            <?php
               }
                    ?>
         </tr>
      </thead>
      <tbody>
         <?php 
            $building_num=0;
            // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
            $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join category_permissions on category_permissions.CategoryCode=master_article.CategoryCode where stock_summary.Status='2' and location_master.location_owner='$locationOwnerID' and category_permissions.employee_id='$EmployeeID' order by IDNo DESC ";
            $building_run=mysqli_query($conn,$building);
            while ($building_row=mysqli_fetch_array($building_run)) 
            {
            $building_num=$building_num+1;
            
            
            $EmployeeID=$building_row['Corrent_owner'];
             $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
            $q1 = sqlsrv_query($conntest, $sql1);
            while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) {
            $name = $row['Name'];
            }
            ?>
         <tr>
            <td><?=$building_num?></td>
            <td><?=$building_row['IDNo'];?></td>
            <!-- <td><?=$building_row['CategoryName'];?></td> -->
            <td><?=$building_row['ArticleName'];?></td>
            <!--   <td><?=$building_row['CPU'];?></td> -->
            <!--   <td><?=$building_row['OS'];?></td>
               <td><?=$building_row['Memory'];?></td> -->
            <td>
               <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
            </td>
            <td>
               <?php 
                  if (isset($name))
                  {
                  echo $name." (".$building_row['Corrent_owner'].")";
                      // code...
                  }
                  ?>
            </td>
            <?php
               if ($permissionCount>0) 
               {
                ?>
            <td>
               <i class="fa fa-arrow-left fa-lg" data-dismiss="modal" onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:red;"></i>
            </td>
            <?php
               }
                    ?>
         </tr>
         <?php
            unset($name); 
               }
                          ?>
      </tbody>
   </table>
</div>
<?php
   }
   elseif($code == 35)
   {
       $categoryID=$_POST['CategoryID'];
       $location_ownerID= $_POST['LocationOwnerID'];
        ?>
<option value="">Choose</option>
";
<?php 
   // $article="SELECT  * FROM master_article where CategoryCode='$categoryID'";
    if ($location_ownerID>0) 
    {
   
   $article="SELECT distinct stock_summary.ArticleCode as Article_code,ArticleName from location_master inner join stock_summary on location_master.ID=stock_summary.LocationID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode where location_owner='$location_ownerID' and master_article.CategoryCode='$categoryID'";
   }
   else
   {
   $article="SELECT distinct stock_summary.ArticleCode as Article_code,ArticleName from  stock_summary  inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode WHERE Status='2' and master_article.CategoryCode='$categoryID'";
   }
   
   
    $article_run=mysqli_query($conn,$article);
    while ($article_row=mysqli_fetch_array($article_run)) 
    {
    echo "<option value='".$article_row['Article_code']."'>".$article_row['ArticleName']."</option>";
    }
   }
   
   else if ($code == 36) {
   $CategoryID = $_POST['CategoryID'];
   $ArticleCode = $_POST['ArticleCode'];
   $location_ownerID= $_POST['LocationOwnerID'];
   $article="SELECT * from master_article where ArticleCode='$ArticleCode'";
   $article_res=mysqli_query($conn,$article);
   while($article_data=mysqli_fetch_array($article_res))
   {
   $article_Name=$article_data['ArticleName'];
   }
   
   
   ?>
<form action="export.php" method="post">
   <input type="hidden" name="Category_ID" value="<?=$CategoryID?>">
   <input type="hidden" name="Article_ID" value="<?=$ArticleCode?>">
   <input type="hidden" name="exportCode" value="5">
   <div class="card card-info">
      <div class="card-header">
         <h3 class="card-title">Category Wise Stocks</h3>
         <div class="card-tools">
            <div class="row">
               <div class="btn-group btn-group-xs" style="width: 150px;">
                  <button type="submit" class="form-control float-right btn-success" style="margin-top: -5px;">Export</button>
               </div>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <!-- <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);" >
                  
                  </div> -->
            </div>
         </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0" style="height: 400px;">
         <table class="table table-head-fixed text-nowrap" >
            <thead>
               <tr>
                  <th>Block</th>
                  <th>Room Name</th>
                  <th>Room No.</th>
                  <th>Floor</th>
                  <th>Article</th>
                  <th>Count</th>
                  <th>Employee ID</th>
                  <th>Employee Name</th>
                  <th>View</th>
               </tr>
            </thead>
            <tbody>
               <?php                
                  if ($location_ownerID!='') 
                  {
                  $location_qry="SELECT distinct location_master.ID as lmid, user.name as employee_name , building_master.Name as Bname,location_owner, room_name_master.RoomName as rnm_RoomName,location_master.RoomNo as lmRoomNo, location_master.Floor as Floor_name from location_master  left join  building_master on building_master.ID=location_master.Block left JOIN room_master ON room_master.FloorID=location_master.Floor left join room_name_master on room_name_master.ID=location_master.RoomName left join user on location_master.location_owner=user.emp_id where location_master.location_owner='$location_ownerID'";
                  }
                  else
                  {
                  $location_qry="SELECT distinct location_master.ID as lmid, user.name as employee_name , building_master.Name as Bname,location_owner, room_name_master.RoomName as rnm_RoomName,location_master.RoomNo as lmRoomNo, location_master.Floor as Floor_name from location_master  left join  building_master on building_master.ID=location_master.Block left JOIN room_master ON room_master.FloorID=location_master.Floor left join room_name_master on room_name_master.ID=location_master.RoomName left join user on location_master.location_owner=user.emp_id";
                  }
                  $location_result=mysqli_query($conn,$location_qry);
                  while($location_data=mysqli_fetch_array($location_result))
                  {
                      $count=0;
                      $locationID=$location_data['lmid'];
                      $roomNo=$location_data['lmRoomNo'];
                      $Block=$location_data['Bname'];
                       $Floor=$location_data['Floor_name'];
                      $room_Name=$location_data['rnm_RoomName'];
                      $locationOwner=$location_data['location_owner'];
                      $EmpName=$location_data['employee_name'];
                      ?>
               <?php 
                  if ($Floor==0) 
                  {
                      $FloorName='Ground';
                  }
                  elseif ($Floor==1) 
                  {
                      $FloorName='First';
                  }
                  elseif ($Floor==2) 
                  {
                      $FloorName='Second';
                  }
                  elseif ($Floor==3) 
                  {
                      $FloorName='Third';
                  }
                  elseif ($Floor==4) 
                  {
                      $FloorName='Fourth';
                  }
                  
                  ?>
               <?php
                  $sql="SELECT * from stock_summary where CategoryID='$CategoryID' and ArticleCode='$ArticleCode' and LocationID='$locationID' and Status='2'";  
                             
                  $run=mysqli_query($conn,$sql);
                  while($data=mysqli_fetch_array($run))
                  {
                     $count++;
                  }
                  
                  ?>
               <?php 
                  if ($count!=0) 
                  {
                      
                  ?>
               <tr>
                  <td><?=$Block?></td>
                  <td><?=$room_Name?></td>
                  <td><?=$roomNo?></td>
                  <td><?=$FloorName?></td>
                  <td><?=$article_Name?></td>
                  <td><?=$count?></td>
                  <td><?=$locationOwner?></td>
                  <td><?=$EmpName?></td>
                  <td><i class="fa fa-eye fa-lg" onclick="view_category_article_stock(<?=$CategoryID?>,<?=$ArticleCode?>,<?=$locationID?>);" data-toggle="modal" data-target="#view_assign_stock_office_Modal" style="color:red;"></i></td>
               </tr>
               <?php 
                  }
                  ?>
               <?php
                  }
                  ?>
               <!--  <tr>        
                  <td><?=$CategoryID?>  </td>
                  </tr>
                  -->   
            </tbody>
         </table>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</form>
<?php
   }
    
   
   
   else if ($code == 37) {
       $CategoryID=$_POST['CategoryID'];
       $ArticleCode=$_POST['ArticleCode'];
       $locationID=$_POST['locationID'];
   
   ?>
<input type="hidden" name="Category_id_" value="<?=$CategoryID?>">
<input type="hidden" name="Article_id_" value="<?=$ArticleCode?>">
<input type="hidden" name="Location_id_" value="<?=$locationID?>">
<input type="hidden" name="exportCode" value="6">
<div class="card-body table-responsive p-0" style="height: 400px;">
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Sr. No.</th>
            <th>ID</th>
            <th>Article</th>
            <th>View</th>
            <th>Assigned To</th>
            </th>
            <?php
               if ($permissionCount>0) 
               {
                ?>
            <th>
               Return
               </td>
               <?php
                  }
                       ?>
         </tr>
      </thead>
      <tbody>
         <?php 
            $building_num=0;
            // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
            $building="  SELECT * FROM stock_summary  inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode where stock_summary.Status='2' and stock_summary.CategoryID='$CategoryID' and stock_summary.ArticleCode='$ArticleCode' and stock_summary.LocationID='$locationID' order by IDNo DESC ";
            $building_run=mysqli_query($conn,$building);
            while ($building_row=mysqli_fetch_array($building_run)) 
            {
            $building_num=$building_num+1;
            
            $EmployeeID=$building_row['Corrent_owner'];
             $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
            $q1 = sqlsrv_query($conntest, $sql1);
            while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) {
            $name = $row['Name'];
            }
            ?>
         <tr>
            <td><?=$building_num?></td>
            <td><?=$building_row['IDNo'];?></td>
            <td><?=$building_row['ArticleName'];?></td>
            <td>
               <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
            </td>
            <td>
               <?php 
                  if (isset($name)) 
                  {
                      ?>
               <?=$name;?>(<?=$building_row['Corrent_owner'];?>)
               <?php 
                  }
                      ?>
            </td>
            <?php
               if ($permissionCount>0) 
               {
                ?>
            <td>
               <i class="fa fa-arrow-left fa-lg" data-dismiss="modal" onclick="
                  (<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:red;"></i>
            </td>
            <?php
               }
                    ?>
         </tr>
         <?php 
            unset($name);
               }
                          ?>
      </tbody>
   </table>
</div>
<?php
   }
   
   else if ($code == 38) 
   {
       $clgID = $_POST['clg'];
   
   
   ?>
<input type="hidden" name="exportCode" value="0">
<div class="card card-info">
   <div class="card-header">
      <h3 class="card-title">Locations</h3>
      <div class="card-tools">
         <div class="row">
            <div class="input-group input-group-sm" style="width: 150px;">
               <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);"> -->
            </div>
         </div>
      </div>
   </div>
   <!-- /.card-header -->
   <div class="card-body table-responsive p-0" style="height: 400px;">
      <table class="table table-head-fixed text-nowrap" >
         <thead>
            <tr>
               <th>College Name</th>
               <th>Floor</th>
               <th>Room Name</th>
               <th>Room No.</th>
               <th>View</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $sql = "SELECT *, colleges.name as clg_name ,room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID WHERE location_master.CollegeID='$clgID' ";
               $res_r = mysqli_query($conn, $sql);
               
               while ($data = mysqli_fetch_array($res_r))
               {
                   $lm_ID=$data['lm_id'];
                   $OfficeName = $data['RoomName'];
                   $block = $data['Name'];
                   $RoomType = $data['Type'];
                   $officeID = $data['rnm_id'];
                   $clgName = $data['clg_name'];
                   $RoomNo = $data['RoomNo'];
                   $Floor = $data['Floor_name'];
                   if ($Floor == 0)
                   {
                       $FloorName = 'Ground';
                   }
                   elseif ($Floor == 1)
                   {
                       $FloorName = 'First';
                   }
                   elseif ($Floor == 2)
                   {
                       $FloorName = 'Second';
                   }
                   elseif ($Floor == 3)
                   {
                       $FloorName = 'Third';
                   }
                   elseif ($Floor == 4)
                   {
                       $FloorName = 'Fourth';
                   }
               
               ?>
            <tr>
               <td><?=$clgName?> </td>
               <td><?=$FloorName?> </td>
               <td><?=$OfficeName?>(<?=$block?>  Block)</td>
               <td><?=$RoomNo?> </td>
               <td><button class="btn btn-xs" type='submit' style="color:red;" onclick="location_Stock(<?=$lm_ID?>)"><i class="fa fa-eye fa-lg"></i></button></td>
            </tr>
            <?php
               }
               ?>
         </tbody>
      </table>
   </div>
   <!-- /.card-body -->
</div>
<?php
   }
   elseif ($code=='39') 
   {                       
   ?>
<div class="card card-info">
   <div class="card-header">
      <h3 class="card-title">Stocks</h3>
      <div class="card-tools">
         <div class="row">
            <div class="input-group input-group-sm" style="width: 150px;">
               <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);">
            </div>
         </div>
      </div>
   </div>
   <!-- /.card-header -->
   <div class="card-body table-responsive p-0" style="height: 400px;">
      <table class="table table-head-fixed text-nowrap" >
         <thead>
            <tr>
               <th>ID</th>
               <!-- <th>Category Name</th> -->
               <th>Article</th>
               <th>View</th>
               <!--  <th>Oprating System</th>
                  <th>Memory</th> -->
               <th>Status</th>
               <th>Assigned To</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $location=$_POST['Location_id'];
                $building_num=0;
                // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
                $building="  SELECT * FROM stock_summary left join master_calegories on stock_summary.CategoryID=master_calegories.ID left join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and stock_summary.LocationID='$location'  order by IDNo DESC ";
                $building_run=mysqli_query($conn,$building);
                while ($building_row=mysqli_fetch_array($building_run)) 
                {
                $building_num=$building_num+1;
                ?>
            <tr>
               <td><?=$building_row['IDNo'];?></td>
               <!-- <td><?=$building_row['CategoryName'];?></td> -->
               <td><?=$building_row['ArticleName'];?></td>
               <!--   <td><?=$building_row['CPU'];?></td> -->
               <!--   <td><?=$building_row['OS'];?></td>
                  <td><?=$building_row['Memory'];?></td> -->
               <td>
                  <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
               </td>
               <td>
                  <a class="btn btn-success btn-xs" style="color:white;">Assigned</a>
               </td>
               <td><?=$building_row['name'];?>(<?=$building_row['Corrent_owner'];?>)</td>
            </tr>
            <?php 
               }    
               ?>
         </tbody>
      </table>
   </div>
   <!-- /.card-body -->
</div>
<?php        
   }
   
   elseif ($code==40) {
       
        $building=$_POST['Name'];
        $Incharge=$_POST['Incharge'];
        $ID=$_POST['ID'];
         $update_building = "UPDATE  building_master SET Name='$building',Incharge='$Incharge' where ID='$ID'";
       $building_run = mysqli_query($conn, $update_building);
       if ($building_run == true) {
          ?>
<script > window.location.href='building-master.php'; </script> 
<?php
   } else {
       echo "Ohh yaar ";
   }
   
   }elseif ($code==41) {
   
    $articleID=$_POST['ID'];
    $Incharge=$_POST['current_owner'];
   
                       
   $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$Incharge' and JobStatus='1'";
   $q1 = sqlsrv_query($conntest, $sql1);
   while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
   {
   //$name = $row['Name'];
   
    $datetime   = new DateTime(); //this returns the current date time
    $one=date("His");
   $two= date("myd");
   $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
   $four=substr(str_shuffle($one.$two.$three),1,8);
   $result =$one.$three.$two.$four;
    
    $updateCurrentOwner = "UPDATE  stock_summary SET Corrent_owner='$Incharge' , reference_no='$result' where IDNo='$articleID'";
   $building_run = mysqli_query($conn, $updateCurrentOwner);
   if ($building_run==true) 
   {
   $sql="SELECT * FROM stock_summary  where IDNo='$articleID'";
   $result = mysqli_query($conn,$sql);
   $date=date('Y-m-d');
   while($data=mysqli_fetch_array($result))
   {
      $currentOwner=$data['Corrent_owner'];
      $currentLocation=$data['LocationID'];
      $deviceSerialNo=$data['DeviceSerialNo'];
      $workingStatus=$data['WorkingStatus'];
      $referenceNo=$data['reference_no'];
      $id=$data['IDNo'];
      $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', 'Issued', '$currentLocation', '$currentOwner', 'Owner Change', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
      $res=mysqli_query($conn,$qry);
   }
   }
   
   }
   
   }
   elseif($code==42)
   {
   $location_num=0;
   $pageID=$_POST['page'];
   ?>
<div class="card-body table-responsive " style="height: 100%;">
   <?php 
      $id=$_POST['id'];     
      $location="SELECT *, rm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
      
      
          $location_run=mysqli_query($conn,$location);
          if ($location_row=mysqli_fetch_array($location_run)) 
          {
          $location_num=$location_num+1;
      ?>
   <label>Current Owner</label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Department</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$location_row['emp_id'];?>
            </td>
            <td>
               <?=$location_row['name'];?>
            </td>
            <td>
               <?=$location_row['designation'];?>
            </td>
            <td>
               <?=$location_row['department'];?>
            </td>
         </tr>
      </tbody>
   </table>
   <br>
   <label>Particular's Description(<?=$id?>) -  <?=$location_row['ArticleName'];?></label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>View</th>
            <th>Storage</th>
            <th>Brand</th>
            <th>Memory</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$location_row['CPU'];?>
            </td>
            <td>
               <?=$location_row['Storage'];?>
            </td>
            <td>
               <?=$location_row['Brand'];?>
            </td>
            <td>
               <?=$location_row['Memory'];?>
            </td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
   <br><br>
   <div class="row">
      <input type="hidden" name="user_id" value="<?=$EmployeeID?>">
      <input type="hidden" name="pageID" value="<?=$pageID?>">
      <input type="hidden" name="Incharge_ID" value="<?=$location_row['Incharge'];?>">
      <input type="hidden" name="current_owner_id" value="<?=$location_row['emp_id'];?>">
      <input type="hidden" name="reference_no" value="<?=$location_row['reference_no'];?>">
      <input type="hidden" name="location_id" value="<?=$location_row['LocationID'];?>">
      <input type="hidden" name="article_id" value="<?=$id?>">
      <div class="col-lg-8">
         <?php 
            if($location_row['WorkingStatus']==0)
            {
                ?>
         <label>Fault Description</label>
         <?php
            }
            elseif ($location_row['WorkingStatus']==1) 
            {
                ?>
         <label>Remarks</label>
         <?php
            }
            ?>
         <br>
         <textarea name="faultDetail" id="faultDetail" value="" required class="form-control"></textarea>           
      </div>
      <div class="col-lg-4">
         <label>&nbsp;</label>
         <br>
         <?php 
            if($location_row['WorkingStatus']==0)
            {
                ?>
         <input type="hidden" name="code" value="43">
         <button type="submit" class="form-control btn-warning btn">Mark Faulty</button>
         <?php
            }
            elseif ($location_row['WorkingStatus']==1) 
            {
                ?>
         <input type="hidden" name="code" value="44">
         <button type="submit" class="form-control btn-success btn">Mark Working</button>
         <?php
            }
            ?>
      </div>
   </div>
</div>
<?php
   }
   elseif ($code=='43') 
   {
    $empID=$_POST['user_id'];
    $pageID=$_POST['pageID'];
    $inchargeID=$_POST['Incharge_ID'];
    $referenceNo=$_POST['reference_no'];
    $currentOwnerID=$_POST['current_owner_id'];
    $locationID=$_POST['location_id'];
    $articleID=$_POST['article_id'];
    $faultDescription=$_POST['faultDetail'];
    $Date=date('Y-m-d');
    $sql="UPDATE stock_summary SET WorkingStatus='1' where IDNo='$articleID'";
    $res=mysqli_query($conn,$sql);
    if ($res) 
    {
         $ins="INSERT INTO stock_description (IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus,  Updated_By, reference_no) VALUES ('$articleID','$Date', 'Faulty','$locationID','$currentOwnerID','$faultDescription','1','$empID','$referenceNo')";
        mysqli_query($conn,$ins);
        $tokenQry="SELECT token_no FROM faulty_track ORDER BY token_no Desc ";
        $tokenRes=mysqli_query($conn,$tokenQry);
        if ($tokenData=mysqli_fetch_array($tokenRes)) 
        {
            $token=$tokenData['token_no'];
            $token=$token+1;
        }
        $insFaultyTrack="INSERT INTO faulty_track ( article_no, location_id,time_stamp,  direction, remarks, reference_no, working_status, status, updated_by, token_no) VALUES ('$articleID', '$locationID','$timeStamp', 'Faulty', '$faultDescription', '$referenceNo', '1', '1', '$EmployeeID','$token')";
        mysqli_query($conn,$insFaultyTrack);
        
        
        $array_cp_mail_user=array();
   $mail="SELECT * from stock_summary inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID where IDNo='$articleID' and send_mail='1' and is_admin='1'";
            $mail_run=mysqli_query($conn,$mail);
            while ($mail_row=mysqli_fetch_array($mail_run)) 
            {
                $empID='';
                $empID=$mail_row['employee_id'];
                $sql2322="SELECT * FROM Staff Where IDNo='$empID'";
                $q12322 = sqlsrv_query($conntest,$sql2322);
                while($row323 = sqlsrv_fetch_array($q12322, SQLSRV_FETCH_ASSOC) )
                {
                    if ($row323['OfficialEmailID']) 
                    {
                        $array_cp_mail_user[]=$row323['OfficialEmailID'];
        
                    }
                    else
                    {
                        $array_cp_mail_user[]=$row323['EmailID'];
                    }
                    // $array_cp_mail_user[]=$row323['EmailID'];
                }
            }
            $sql1="SELECT * FROM Staff Where IDNo='$inchargeID'";
        $q1 = sqlsrv_query($conntest,$sql1);
        while($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC) )
        {
            if ($row['OfficialEmailID']) 
                    {
                        $array_cp_mail_user[]=$row['OfficialEmailID'];
        
                    }
                    else
                    {
                        $array_cp_mail_user[]=$row['EmailID'];
                    }
            $inchargeName=$row['Name'];
        } 
            $to=array();
        $sql22="SELECT * FROM Staff Where IDNo='$EmployeeID'";
        $q122 = sqlsrv_query($conntest,$sql22);
        while($row1 = sqlsrv_fetch_array($q122, SQLSRV_FETCH_ASSOC) )
        {
          $email=$row1['EmailID'];
          $SenderName=$row1['Name'];
          $Designation=$row1['Designation'];
        }
        $location="SELECT *, lm.RoomNo as Room_No FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName  WHERE ss.IDNo='$articleID'";
            $location_run=mysqli_query($conn,$location);
            if ($location_row=mysqli_fetch_array($location_run)) 
            {
              $block= $location_row['Name'];
              $floor= $location_row['Floor'];
              $roomNo= $location_row['Room_No'];
              $RoomType= $location_row['RoomType'];
              $roomName= $location_row['RoomName'];
            }
            
   
   
   $body="";
   $body.="
   
   <!DOCTYPE html>
   <html lang='en'>
   <head>
   <meta charset='utf-8'>
   <meta name='viewport' content='width=device-width, initial-scale=1'>
   <meta http-equiv='x-ua-compatible' content='ie=edge'>
   
   <title></title>
   
   <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' rel='stylesheet'>
   </head>
   <div class='wrapper' style='font-family: Arial, Helvetica, sans-serif;'>
   <div class='content-wrapper '>
   <div class='content'>
      <div class='container'>
         <div class='row'>
            <div class='col-lg-12 col-sm-12 col-md-12 col-xs-12' >
               <div class='card' style='margin-top:10px;'>
                  <div class='card-body' >
                     <div class='row'>
                      <div class='col-lg-4 col-sm-4 col-md-4 col-xs-4'>
                         <img src='https://recruitment.gurukashiuniversity.in/images/logo-blue.png' alt='GKU logo' class='brand-image' width='200px' height='50px'>
                      </div>
                      <div class='col-lg-4 col-sm-4 col-md-4 col-xs-4'>
                      </div>
                      <div class='col-lg-4 col-sm-4 col-md-4 col-xs-4'>
                      </div>
                     </div>
                     <div class='row' style='margin-top:15px'>
                       <div class='col-lg-12 col-sm-12 col-md-12 col-xs-12'>
                        <label style='color: #223260;  font-size: 16px'>
                          <h5 style='color: #a62535; font-size: 16px'>
                            Dear
                            <span style='text-transform: uppercase ;'>
                             <i> <b>{$inchargeName}</b></i>
                              </span></h5></label>
                                <label style='color: #223260;   font-size: 15px'>Article No. <label style='color:#a62535'>{$articleID}</label> is marked faulty.
                                Details as followed.<br><br>
                                <label style='color: #a62535;   font-size: 16px'>
                                Complaint No. - {$token}
                                <br>
                                Block- {$block}
                                <br>
                                Floor- {$floor}
                                <br>
                                Room No.- {$roomNo}
                                <br>
                                Type- {$RoomType}
                                <br>
                                Name- {$roomName}
                                <br>
                                Remark- {$faultDescription}
                                </label>
                        </label>
                      </div>
                    </div>
                    <div class='row'>
                    <br>
                      Regards<br>{$SenderName}<br>({$Designation})
                      <div class='col-lg-12 col-xs-12 col-md-12 col-sm-12' style='text-align: center;'>
                        <label>
                          <h6>
                            <b>
                                <hr style='background-color: #223260'>
                          <a href='http://gurukashiuniversity.co.in/lms' style='color: #223260;   font-size: 20px'>Click here to login.</a>
                                <hr style='background-color: #223260'>
                            </b>
                          </h6>
                        </label>
                      </div>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   </div>
   </html>";
   
   $to=implode(", ",$array_cp_mail_user); 
   
   $from = $email; 
   $fromName = $SenderName; 
   $subject = $articleID." Status Faulty (".$token.")"; 
   $headers = "MIME-Version: 1.0" . "\r\n"; 
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
   $headers .= 'From: LIMS Updation<'.$from.'>' . "\r\n"; 
   mail($to, $subject, $body, $headers);
   
   
        
   
    }
   if ($pageID==2) 
   {
   ?>
<script > window.location.href='employee-articles.php'; </script> 
<?php
   }
   elseif ($pageID==1) 
   {
   ?>
<script > window.location.href='reports.php'; </script> 
<?php
   }
   }
   elseif ($code=='44') 
   {
       $empID=$_POST['user_id'];
       $referenceNo=$_POST['reference_no'];
       $currentOwnerID=$_POST['current_owner_id'];
       $locationID=$_POST['location_id'];
       $articleID=$_POST['article_id'];
       $faultDescription=$_POST['faultDetail'];
       $Date=date('Y-m-d');
       $sql="UPDATE stock_summary SET WorkingStatus='0' where IDNo='$articleID'";
       $res=mysqli_query($conn,$sql);
       if ($res) 
       {
            $ins="INSERT INTO stock_description (IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus,  Updated_By, reference_no) VALUES ('$articleID','$Date', 'Working','$locationID','$currentOwnerID','$faultDescription','0','$empID','$referenceNo')";
           mysqli_query($conn,$ins);
       }
          $qry="SELECT * from building_master where Incharge='$EmployeeID'";
       $res=mysqli_query($conn,$qry);
       if (mysqli_num_rows($res)>0) {
   ?>
<script > window.location.href='location-incharge.php'; </script> 
<?php
   }
   else
   {
   ?>
<script > window.location.href='reports.php'; </script> 
<?php
   }
   
   }
   
   
   else if ($code == 45) {
       $RoomType = $_POST['RoomType'];
       $officeID = $_POST['officeID'];
   
   
   ?>
<input type="hidden" name="exportCode" value="8">
<input type="hidden" name="roomTypeID" value="<?=$RoomType?>">
<input type="hidden" name="office_ID" value="<?=$officeID?>">
<div class="card-body table-responsive p-0" style="height: 400px;">
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Sr. No.</th>
            <?php
               $countforarray=0;
               $article="SELECT distinct stock_summary.ArticleCode as as11, stock_summary.locationID, ArticleName FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and location_master.Type='$RoomType' and location_master.ID='$officeID' order by IDNo DESC";
               $article_run=mysqli_query($conn,$article);
               while ($article_row=mysqli_fetch_array($article_run)) 
               {
               $stockLocation[]=$article_row['locationID'];
               $articleName[]=$article_row['ArticleName'];
               $articleCode[]=$article_row['as11'];
                
               ?>
            <th><?=$articleName[$countforarray]?></th>
            <?php 
               $countforarray++;
               ?>
            <?php
               }
               
               
               
               for ($i=0; $i < $countforarray; $i++) 
               { 
                $innerCount=0;
                  $as="select * from stock_summary where locationID='$stockLocation[$i]' AND ArticleCode='$articleCode[$i]' and Status='2'";
                  $asq=mysqli_query($conn,$as);
               
                    while ($as1=mysqli_fetch_array($asq)) 
               {
                $array[$i][]=$as1['IDNo'];
               
               // $cpu[]='' $as1['IDNo'];
                $innerCount++;
               }
               $countarray[]=$innerCount;
               
               ?>
            <?php
               }
               if (isset($countarray)) 
               {
                    $maxValue=max($countarray);
               }
               else
               {
                $maxValue=0;
               }
               ?>
         </tr>
      </thead>
      <tbody>
         <?php
            $count=0;
            if ($count<$countforarray) 
            {
            
            for($j=0;$j<$maxValue;$j++)
            { 
                ?>
         <tr>
            <td><?= $j+1;?></td>
            <?php
               for ($i=0; $i <$countforarray ; $i++) 
               {
                   //$value= $array[$i][$j];
                   ?>
            <td>
               <?php 
                  if (isset($array[$i][$j])) 
                  {
                      echo  $array[$i][$j];
                  } 
                  ?>
            </td>
            <?php
               }
               ?>
         </tr>
         <?php
            }
            $count++;
            }
            ?>
      </tbody>
   </table>
</div>
<input type="hidden" name="serial_no" value="<?=$sr?>" id='serial_no'>
<?php
   unset($maxValue);
   }
   
   
   
   
   else if ($code == 46) {
       $locationID = $_POST['location_id'];
   
   
   ?>
<input type="hidden" name="exportCode" value="9">
<input type="hidden" name="locationID" value="<?=$locationID?>">
<input type="hidden" name="inchargeID" value="<?=$EmployeeID?>">
<div class="card-body table-responsive p-0" style="height: 400px;">
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Sr. No.</th>
            <?php
               $countforarray=0;
               $article="SELECT distinct stock_summary.ArticleCode as as11, stock_summary.locationID, ArticleName FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID where stock_summary.LocationID='$locationID' and category_permissions.employee_id='$EmployeeID' order by IDNo DESC";
               $article_run=mysqli_query($conn,$article);
               while ($article_row=mysqli_fetch_array($article_run)) 
               {
               $stockLocation[]=$article_row['locationID'];
               $articleName[]=$article_row['ArticleName'];
               $articleCode[]=$article_row['as11'];
                
               ?>
            <th><?=$articleName[$countforarray]?></th>
            <?php 
               $countforarray++;
               ?>
            <?php
               }
               
               
               
               for ($i=0; $i < $countforarray; $i++) 
               { 
                $innerCount=0;
                  $as="select * from stock_summary where locationID='$stockLocation[$i]' AND ArticleCode='$articleCode[$i]' ";
                  $asq=mysqli_query($conn,$as);
               
                    while ($as1=mysqli_fetch_array($asq)) 
               {
                $array[$i][]=$as1['IDNo'];
               
               // $cpu[]='' $as1['IDNo'];
                $innerCount++;
               }
               $countarray[]=$innerCount;
               
               ?>
            <?php
               }
               if (isset($countarray)) 
               {
                    $maxValue=max($countarray);
               }
               else
               {
                $maxValue=0;
               }
               ?>
         </tr>
      </thead>
      <tbody>
         <?php
            $count=0;
            if ($count<$countforarray) 
            {
            
            for($j=0;$j<$maxValue;$j++)
            { 
                ?>
         <tr>
            <td><?=$j+1;?></td>
            <?php
               for ($i=0; $i <$countforarray ; $i++) 
               {
                   //$value= $array[$i][$j];
                   ?>
            <td>
               <?php 
                  if (isset($array[$i][$j])) 
                  {
                      echo  $array[$i][$j];
                  } 
                  ?>
            </td>
            <?php
               }
               ?>
         </tr>
         <?php
            }
            $count++;
            }
            ?>
      </tbody>
   </table>
</div>
<input type="hidden" name="serial_no" value="<?=$sr?>" id='serial_no'>
<?php
   unset($maxValue);
   
   }
   elseif($code=='47')
   {
   $id=$_POST['articleID'];
   $sql="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode where   IDNo='$id'";
   $result = mysqli_query($conn,$sql);
   $array = array();
   $a=0;
   
   while($row=mysqli_fetch_array($result))
   {
   $a++;
   $array[] = $row;
   //print_r($array);
   }
   
   for ($i=0; $i<$a; $i++)
   { 
   $emp_id=$array[$i]['Corrent_owner'];
   $category=$array[$i]['ArticleName'];
   $working=$array[$i]['WorkingStatus'];
   $issue_date=$array[$i]['IssueDate'];
   $description=$array[$i]['CPU'].' '.$array[$i]['Brand'].' '.$array[$i]['Model'].' '.$array[$i]['DeviceSerialNo'];
   if ($working=='0'||$working=='') 
   {
   $remarks='Working';
   }
   elseif ($working=='1') 
   {
   $remarks='Faulty';
   }
   
   }
   $sql1="SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$emp_id'";
   
   $q1 = sqlsrv_query($conntest,$sql1);
   
   while($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC) )
        {
   $name=$row['Name'];
   $Department=$row['Department'];
   $Designation=$row['Designation'];
   $CollegeName=$row['CollegeName'];
   $img= $row['Snap'];
   $pic = 'data://text/plain;base64,' . base64_encode($img);
   }
   
   
   $location_num=0;
   ?>
<div class="card-body table-responsive p-0" style="height: 100%;">
   <?php 
      $id=$_POST['articleID'];
      $location="SELECT *, lm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName inner join user on ss.Corrent_owner=user.emp_id WHERE ss.IDNo='$id'";
         $location_run=mysqli_query($conn,$location);
         if ($location_row=mysqli_fetch_array($location_run)) 
         {
          $location_num=$location_num+1;
      ?>
   <table class="table table-head-fixed text-nowrap" border="0" style="border: 2px solid black;">
      <tr>
         <td>Employee ID: </td>
         <th><?=$location_row['emp_id'];?></th>
         <td>Name: </td>
         <th> <?=$location_row['name'];?></th>
         <td rowspan="2" style="text-align: right;">
            <img src="<?= $pic; ?>" width="100" height="130" border="1">
         </td>
      </tr>
      <tr>
         <td>Designation: </td>
         <th><?=$location_row['designation'];?></th>
         <td>Department: </td>
         <th><?=$location_row['department'];?></th>
      </tr>
   </table>
   <br>
    <label>Location</label>
    <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
           
            <th>Block</th>
            <th>Floor</th>
            <th>Room No</th>
            <th>Room Type</th>
            <th>Room Name</th>
            
         </tr>
      </thead>
      <tbody>
         <tr>
            
            <td>
               <?=$location_row['Name'];?>
            </td>
            <td>
               <?=$location_row['Floor'];?>
            </td>
            <td>
               <?=$location_row['abc'];?>
            </td>
            <td>
               <?=$location_row['RoomType'];?>
            </td>
            <td>
               <?=$location_row['RoomName'];?>
            </td>
            
         </tr>
      </tbody>
   </table>
   
   <br>
   <label>Particular's Description(<?=$id?>)</label>
   <table class="table table-head-fixed text-nowrap" border="1" style="border: 2px solid black;">
      <thead>
         <tr>
            <th>Article </th>
            <th>View</th>
            <th>Brand</th>
            <th>OS</th>
            <th>Model</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$location_row['ArticleName'];?>
            </td>
            <td>
               <?=$location_row['CPU'];?>
            </td>
            <td>
               <?=$location_row['Brand'];?>
            </td>
            <td>
               <?=$location_row['OS'];?>
            </td>
            <td>
               <?=$location_row['Model'];?>
            </td>
         </tr>
         <?php
            }
            ?>
      </tbody>
   </table>
   <br>
   <div class="row" >
      <div class="col-lg-6">
         <label>Remarks</label>
         <input type="text" id="returnRemark" class="form-control" required>
      </div>
      <div class="col-lg-3">
         <label>Status</label>
         <select id="workingStatus" class="form-control" required>
            <option value="">Select</option>
            <option value="0">Working</option>
            <option value="1">Faulty</option>
         </select>
      </div>
      <div class="col-lg-3">
         <label>&nbsp;</label>
         <button type="submit" data-dismiss="modal" class="form-control btn-danger btn" onclick="returnSubmit(<?=$id?>)">Return</button>
      </div>
   </div>
   <br>
</div>
<?php
   }
   elseif($code=='48')
   {
       $id=$_POST['article_id'];
       $workingStatus=$_POST['workingStatus'];
       $returnRemark=$_POST['returnRemark'];
       $date=date('Y-m-d');
       $sql="SELECT * FROM stock_summary  where IDNo='$id'";
       $result = mysqli_query($conn,$sql);
       while($data=mysqli_fetch_array($result))
       {
          $currentOwner=$data['Corrent_owner'];
          $currentLocation=$data['LocationID'];
          $deviceSerialNo=$data['DeviceSerialNo'];
          $referenceNo=$data['reference_no'];
          $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', 'Returned', '$currentLocation', '$currentOwner', '$returnRemark', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
          $res=mysqli_query($conn,$qry);
          if ($res) 
          {    
           if ($workingStatus==1) 
           {
               $tokenQry="SELECT token_no FROM faulty_track ORDER BY token_no Desc ";
           $tokenRes=mysqli_query($conn,$tokenQry);
           if ($tokenData=mysqli_fetch_array($tokenRes)) 
           {
               $token=$tokenData['token_no'];
               $token=$token+1;
           }
               $insFaultyTrack="INSERT INTO faulty_track ( article_no, location_id,  direction, remarks, reference_no, working_status, status, updated_by, token_no, time_stamp) VALUES ('$id', '$currentLocation', 'Faulty', '$returnRemark', '$referenceNo', '1', '1', '$EmployeeID', '$token', '$timeStamp')";
               mysqli_query($conn,$insFaultyTrack);
           }
               $updateQry="UPDATE stock_summary SET LocationID=0, Corrent_owner='',reference_no='' ,  Status=1, WorkingStatus='$workingStatus' WHERE IDNo='$id'";
               mysqli_query($conn,$updateQry);
          }
   
   
       }
   
   
   }
   
   
   
   else if ($code == 49) 
   {
       $EmployeeID = $_POST['emp_id'];
       if ($EmployeeID!='') {
            
        
   
   ?>
<div class="card card-info">
   <div class="card-header">
      <h3 class="card-title">Employee Ledger</h3>
      <div class="card-tools">
         <div class="row">
            <div class="btn-group btn-group-xs" style="width: 150px;">
               <!-- <button type="submit" class="form-control float-right btn-success" style="margin-top: -5px;">Export</button> -->
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="input-group input-group-sm" style="width: 150px;">
               <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="stock_summary_search(this.value);" >
            </div>
         </div>
      </div>
   </div>
   <!-- /.card-header -->
   <div class="card-body table-responsive p-0" style="height: 1000px;">
      <?php
         $emp_id = $EmployeeID;
         $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
         $q1 = sqlsrv_query($conntest, $sql1);
         while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) {
             $name = $row['Name'];
             $Department = $row['Department'];
             $Designation = $row['Designation'];
             $CollegeName = $row['CollegeName'];
             $img = $row['Snap'];
             $pic = 'data://text/plain;base64,' . base64_encode($img);
         }
         ?>
      <br>
      <table class="table table-head-fixed text-nowrap" border="0" style="border: 2px solid black;">
         <tr>
            <td>Employee ID: </td>
            <th><?=$EmployeeID; ?></th>
            <td>Name: </td>
            <th> <?=$name ?></th>
            <td rowspan="2" style="text-align: right;">
               <img src="<?=$pic; ?>" width="100" height="130" border="1">
            </td>
         </tr>
         <tr>
            <td>Designation: </td>
            <th><?=$Designation; ?></th>
            <td>Department: </td>
            <th><?=$Department ?></th>
         </tr>
      </table>
      <br>
      <label>Particular's Description</label>
      <table class="table table-head-fixed text-nowrap" border="1" style="border: 2px solid black;">
         <tr>
            <th>Sr. No.</th>
            <th>Article ID</th>
            <th>Article </th>
            <th>Issue Date</th>
            <th>Return Date</th>
            <th>Print</th>
         </tr>
         <?php
            $location_num = 0;
            $returnArray[] = '';
            $array = array();
            $sql = "SELECT distinct reference_no FROM stock_description  where OwerID='$EmployeeID' ORDER BY Direction desc";
            $result = mysqli_query($conn, $sql);
            $arrayReference = array();
            while ($row = mysqli_fetch_array($result)) 
            {
                $ref = $row['reference_no'];
                $sql_ref = "SELECT * FROM stock_description left join stock_summary on stock_summary.IDNo=stock_description.IDNo left join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join master_calegories on stock_summary.CategoryID=master_calegories.ID INNER join master_article ma on stock_summary.ArticleCode=ma.ArticleCode where stock_description.reference_no='$ref' and OwerID='$EmployeeID' and (Direction='Issued' or Direction='Returned')  ORDER BY Direction desc";
                $resultRef = mysqli_query($conn, $sql_ref);
                while ($rowRef = mysqli_fetch_array($resultRef)) 
                {
                    $category = $rowRef['ArticleName'];
                    $articleName = $rowRef['ArticleName'];
                    $id = $rowRef['IDNo'];
                    if (!in_array($ref, $returnArray)) 
                    {
                        $location_num = $location_num + 1;
                        $returnid = '';
                        $location = "SELECT * from stock_description left join stock_summary ss on ss.IDNo=stock_description.IDNo WHERE OwerID='$EmployeeID'  and stock_description.IDNo='$id' and stock_description.reference_no='$ref'";
                        $location_run = mysqli_query($conn, $location);
                        while ($location_row = mysqli_fetch_array($location_run)) 
                        {
                            $location_row['Direction'];
                            if ($location_row['Direction'] == 'Returned') 
                            {
                                $returnid = $location_row['IDNo'];
                                $return = $location_row['Date_issue'];
                            } 
                            elseif ($location_row['Direction'] == 'Issued') 
                            {
                                $direction = $location_row['Direction'];
                                $issue_date = $location_row['Date_issue'];
                            }
                        }
                ?>
         <tr>
            <td>
               <?=$location_num; ?>
            </td>
            <td>
               <?=$id; ?>
            </td>
            <td>
               <?=$articleName; ?>
            </td>
            <td>
               <?php
                  if ($direction == 'Issued') {
                      echo $issue_date;
                      unset($direction);
                  }
                  ?> 
            </td>
            <td>
               <?php
                  if (isset($return)) {
                      echo $return;
                      unset($return);
                  }
                  ?> 
            </td>
            <td>
               <form action="report-print.php" method="post" target="_blank">
                  <input type="hidden" name="IdNo" value="<?=$ref; ?>">
                  <button class='btn border-0 shadow-none' >
                  <i class="fa fa-print fa-lg"  type='submit'  style="color:blue;"></i>
                  </button>
               </form>
            </td>
         </tr>
         <?php
            $returnArray[] = $ref;
            }
            }
            }
            }
            ?>
      </table>
      <br>
   </div>
   <!-- /.card-body -->
</div>
<!-- /.card -->
<?php
   }
   else if ($code == 50) {
     $EmployeeID=$_POST['emp'];
   
   
   ?>
<div class="card-body table-responsive p-0" style="height: 400px;">
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>ID</th>
            <!-- <th>Category Name</th> -->
            <th>Article</th>
            <th>View</th>
            <!--  <th>Oprating System</th>
               <th>Memory</th> -->
            <th>Status</th>
            <th>Assigned To</th>
            <th>Print</th>
            <th>Return</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            $building_num=0;
            // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
            $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and stock_summary.Corrent_owner='$EmployeeID' order by IDNo DESC ";
            $building_run=mysqli_query($conn,$building);
            while ($building_row=mysqli_fetch_array($building_run)) 
            {
            $building_num=$building_num+1;
            ?>
         <tr>
            <td><?=$building_row['IDNo'];?></td>
            <!-- <td><?=$building_row['CategoryName'];?></td> -->
            <td><?=$building_row['ArticleName'];?></td>
            <!--   <td><?=$building_row['CPU'];?></td> -->
            <!--   <td><?=$building_row['OS'];?></td>
               <td><?=$building_row['Memory'];?></td> -->
            <td>
               <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
            </td>
            <td>
               <a class="btn btn-success btn-xs" style="color:white;">Assigned</a>
            </td>
            <td><?=$building_row['name'];?>(<?=$building_row['Corrent_owner'];?>)</td>
            <td>
               <form action="report-print.php" method="post" target="_blank">
                  <input type="hidden" name="IdNo" value="<?=$building_row['IDNo'];?>">
                  <button class='btn border-0 shadow-none' >
                  <i class="fa fa-print fa-lg"  type='submit'  style="color:blue;"></i>
                  </button>
               </form>
            </td>
            <td>
               <i class="fa fa-arrow-left fa-lg" data-dismiss="modal" onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:red;"></i>
            </td>
         </tr>
         <?php 
            }
                       ?>
      </tbody>
   </table>
   <form action="export.php" method="post">
      <input type="hidden" name="exportCode" value="3">
      <input type="hidden" name="idEmployee" value="<?=$EmployeeID?>">
      <br>
      <div class="row">
         <div class="col-lg-10"></div>
         <div class="col-lg-2">
            <button type="submit" class="btn btn-primary form-control" >Export</button>
         </div>
      </div>
   </form>
</div>
<?php
   }
   
   
   else if ($code==51) 
   {
      $empID=$_POST['id'];
       $staff="SELECT * FROM Staff Where IDNo='$empID'";
       $stmt = sqlsrv_query($conntest,$staff);  
       if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
       {
           $jobStatus=$row_staff['JobStatus'];
           if ($jobStatus=='1') 
           {
               echo "<b>".$Emp_Name=$row_staff['Name'];
           }
           else
           {
               echo "<b>Can not assign to ".$empID;
           }
           $array[]=$row_staff;
       }
   //print_r($array);
   }
   
   elseif($code==52)
   {
        $id=$_POST['id'];
        $LocationID = $_POST['lcm_id'];
   $s="SELECT * FROM stock_summary Where IDNo='$id' and LocationID='$LocationID'";
   $ss=mysqli_query($conn,$s);
   if (mysqli_num_rows($ss)>0) 
   {
      ?>
<br>
<div class="alert alert-danger" role="alert">
   Oops ! Already Assigned 
</div>
<?php 
   }
   else
   {
   
   $get_owner="SELECT * FROM location_master Where ID='$LocationID'";
   $ssget_owner=mysqli_query($conn,$get_owner);
   while ($get_owner_row=mysqli_fetch_array($ssget_owner)) 
   {
       $location_owner=$get_owner_row['location_owner'];
   }
   
   
   
   $s="SELECT * FROM stock_summary Where IDNo='$id' and Status!=0";
   $ss=mysqli_query($conn,$s);
   if (mysqli_num_rows($ss)>0) {
        $date=date('Y-m-d');
          $room_type_insert = "UPDATE  stock_summary SET LocationID='$LocationID',IssueDate='$date',WorkingStatus='0', Status='2',Corrent_owner='$location_owner' where IDNo='$id'";
        $type_run = mysqli_query($conn, $room_type_insert);
       if (mysqli_num_rows($type_run)>0) {
            $description_insert="INSERT INTO stock_description (IDNo,Date_issue,Direction,LocationID,OwerID,Remarks,WorkingStatus,DeviceSerialNo,Updated_By) values ('$id','$date','Issued','$LocationID',' ','Issued','0','0','')";
          mysqli_query($conn, $description_insert);
          ?>
<br> 
<div class="alert alert-success" role="alert">
   Successfully Assigned Article=<?=$id;?>
</div>
<?php
   } 
   else
    {
      ?>
<br>    
<div class="alert alert-danger" role="alert">
   Oops ! Already Assigned1
</div>
<?php
   }
   }
   else
   {
    ?>
<br>  
<div class="alert alert-warning" role="alert">
   Oops ! Details Not Update
</div>
<?php
   }
   }
   }
   
   else if ($code==53) 
   {
     ?>
<div class="card-body">
   <div class="form-group row" >
      <div class="col-lg-12">
         <?php
            $empID=$_POST['emp_id'];
            
             $staff="SELECT * FROM Staff Where IDNo='$empID'";
             $stmt = sqlsrv_query($conntest,$staff);  
             if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
             {
                 echo "<b>".$Emp_Name=$row_staff['Name']."(".$row_staff['IDNo'].")";
                 $emp=$row_staff['IDNo'];
                 ?>
         <!-- <input type="text" name="emp" id="emp" value="<?=$emp?>"> -->
         <table class="table" border="1">
            <tr>
               <th>Category</th>
               <th>Admin</th>
               <th>Mail</th>
               <th>Delete</th>
            </tr>
            <?php
               $sql="SELECT *,category_permissions.ID as CPID from category_permissions inner join master_calegories on category_permissions.CategoryCode=master_calegories.ID where employee_id='$empID' and category_type_id='1'";
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
                   if ($data['send_mail']=='0') 
                   {
                       $mail='Off';
                   }
                   elseif ($data['send_mail']=='1') 
                   {
                       $mail='On';
                   }
               
                   ?>
            <tr>
               <td><?= $data['CategoryName']?></td>
               <td><?= $admin?></td>
               <td><?= $mail?></td>
               <td><i class=" fa fa-trash " id="dlt"  type="button" onclick="deleteCategoryPermission(<?=$data['CPID']; ?>,<?=$empID ?>)" data-toggle="modal"  style="color: #223260;padding-left: 20px;padding-top: 5px">
                  </i>
               </td>
            </tr>
            <?php
               }
               ?>
         </table>
      </div>
   </div>
</div>
<div class="card-footer">
   <?php 
      if (isset($emp))
      {
      ?>
   <input type="hidden" name="" value="<?=$emp?>">
   <button type="submit" class="btn btn-info" data-toggle="modal" onclick="assignPermission(<?=$emp?>)" data-target="#Assign_Permission">Assign Permessions</button>
   <?php
      }
      ?>
   <p id="category_success"></p>
</div>
<?php
   }
   unset($emp);
   //print_r($array);
   }
   else if ($code==54) 
   {
   $ID=$_POST['ID'];
   $staff="Delete FROM category_permissions Where ID='$ID'";
   mysqli_query($conn,$staff);  
   
   
   }
   else if ($code==55) 
   {
   $empID=$_POST['emp_id'];
   $count=0;
   $sql="SELECT *,master_calegories.ID as MCID from master_calegories left join  category_permissions on category_permissions.CategoryCode=master_calegories.ID where employee_id='$empID' and category_type_id='1'";
   $res=mysqli_query($conn,$sql);
   while($data=mysqli_fetch_array($res))
   {
       $qrqr=$data['MCID'];
       $permissionID[]=$qrqr;
            $aa=array();
   
       $qry="SELECT * from master_calegories where ID!='$qrqr'";
       $run=mysqli_query($conn,$qry);
       while($data1=mysqli_fetch_array($run))
       {
            $id=$data1['ID'];
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
<input type="hidden" name="empID" value="<?=$empID?>">
<input type="hidden" name="code" value="57">
<div class="row">
   <div class="col-lg-4">
      <label>Category</label>
      <select name="Category" class="form-control" required>
         <option value="">Select</option>
         <?php
            if ($count>0) 
            {
                
            
                for ($i=0; $i < $count; $i++) 
            { 
                $q="SELECT * from master_calegories where ID='$aa[$i]'";
                $w=mysqli_query($conn,$q);
                while($d=mysqli_fetch_array($w))
                {
                    ?>
         <option value="<?=$d['ID']?>"><?=$d['CategoryName']?></option>
         <?php
            }
            }
            }
            else
            {
            $q="SELECT * from master_calegories";
            $w=mysqli_query($conn,$q);
            while($d=mysqli_fetch_array($w))
            {
                ?>
         <option value="<?=$d['ID']?>"><?=$d['CategoryName']?></option>
         <?php
            }
            }
            ?>
      </select>
   </div>
   <div class="col-lg-4">
      <label>Admin</label>
      <select class="form-control" name="admin" required>
         <option value="0">No</option>
         <option value="1">Yes</option>
      </select>
   </div>
   <div class="col-lg-4">
      <label>Mail</label>
      <select class="form-control" name="mail" required>
         <option value="0">Off</option>
         <option value="1">On</option>
      </select>
   </div>
</div>
<?php
   }
   else if ($code == 56) {
       $locationID = $_POST['location_id'];
   ?>
<input type="hidden" name="exportCode" value="11">
<input type="hidden" name="locationID" value="<?=$locationID?>">
<input type="hidden" name="inchargeID" value="<?=$EmployeeID?>">
<div class="card-body table-responsive p-0" style="height: 400px;">
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Sr. No.</th>
            <th>ID</th>
            <!-- <th>Category Name</th> -->
            <th>Article</th>
            <th>View</th>
            <th>Update</th>
            <!--  <th>Oprating System</th>
               <th>Memory</th> -->
            <th>Status</th>
            <th>Assigned To</th>
            <!-- <th>Action</th> -->
         </tr>
      </thead>
      <tbody>
         <?php 
            $building_num=0;
            $sr=0;
            $category="SELECT * FROM category_permissions where employee_id='$EmployeeID'";
                 $category_run=mysqli_query($conn,$category);
                 while ($category_row=mysqli_fetch_array($category_run)) 
                 { 
                     $cat_id_array[]=$category_row['CategoryCode'];
                 }
                 $arrayCatCount=count($cat_id_array);
            for($k=0;$k<$arrayCatCount;$k++)
             {
                 $cat_id=$cat_id_array[$k];
            // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
                $building="SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.LocationID='$locationID' and stock_summary.CategoryID='$cat_id' order by IDNo DESC";
            $building_run=mysqli_query($conn,$building);
            while ($building_row=mysqli_fetch_array($building_run)) 
            {
             $EmployeeID=$building_row['Corrent_owner'];
             $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
            $q1 = sqlsrv_query($conntest, $sql1);
            while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) {
            $name = $row['Name'];
            }
            
            $building_num=$building_num+1;
            ?>
         <tr>
            <td><?=$building_num?></td>
            <td><?=$building_row['IDNo'];?>
               <?php 
                  if ($building_row['Corrent_owner']=='0')
                  {
                   ?>
               <input type="hidden" class="form-control" name="IDNO" id="assign_<?=$sr?>" value="<?=$building_row['IDNo'];?>">
               <?php
                  }
                  ?>
            </td>
            <!-- <td><?=$building_row['CategoryName'];?></td> -->
            <td><?=$building_row['ArticleName'];?></td>
            <!--   <td><?=$building_row['CPU'];?></td> -->
            <!--   <td><?=$building_row['OS'];?></td>
               <td><?=$building_row['Memory'];?></td> -->
            <td>
               <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" data-dismiss="modal" style="color:red;"></i>
            </td>
            <td>
               <i class="fa fa-edit fa-lg" data-toggle="modal" onclick="updateModalFunction(<?=$building_row['IDNo'];?>,'location-incharge.php')" data-target="#update_modal"></i>
            </td>
            <td>
               <?php 
                  if ($building_row['WorkingStatus']==0) 
                  {
                    ?>
               <a class="btn btn-success btn-xs" style="color:white;"> Working</a>
               <?php
                  }
                  elseif ($building_row['WorkingStatus']==1) 
                  {
                     ?>
               <a class="btn btn-warning btn-xs"> Faulty </a>
               <?php
                  }
                    ?>
            </td>
            <?php if ($building_row['Corrent_owner']!='0')
               {
               ?>
            <td>
               <div class="row" id="sinlge_assign1" >
                  <div class="col-lg-8">
                     <?=$name;?> (<?=$building_row['Corrent_owner'];?>)
                  </div>
                  <div class="col-lg-4">
                     <!-- <button type="button" onclick="remove(<?=$building_row['IDNo'];?>,<?=$building_row['Corrent_owner'];?>);"  class="btn-xs btn btn-danger">Remove</button> -->
                  </div>
               </div>
            </td>
            <?php
               }
               else
               {
               
               
               
               ?>
            <td>
            </td>
            <?php
               $sr++;
                }
                ?>
            <!--  <?php 
               if ($building_row['WorkingStatus']==0) 
               {
                   ?>
               <td><button type="button" class=" btn btn-warning btn-xs" data-toggle="modal" data-target="#fault_Modal" onclick="fault_description(<?=$building_row['IDNo'];?>)">Mark Faulty </button></td>
               <?php
                  }
                  elseif ($building_row['WorkingStatus']==1) 
                  {
                      ?>
               <td><button type="button" class=" btn btn-success btn-xs" data-toggle="modal" data-target="#fault_Modal" onclick="working(<?=$building_row['IDNo'];?>)">Mark Working</button></td>
               <?php
                  }
                    ?> -->
         </tr>
         <?php 
            }
                   }    ?>
      </tbody>
   </table>
</div>
<input type="hidden" name="serial_no" value="<?=$sr?>" id='serial_no'>
<?php
   }
   elseif ($code==57) 
   {
          $empID=$_POST['empID'];
          $category=$_POST['Category'];
          $admin=$_POST['admin'];
          $mail=$_POST['mail'];
          $sql="INSERT INTO category_permissions (employee_id, category_type_id, CategoryCode, is_admin,send_mail) VALUES ('$empID', 1, '$category', '$admin', '$mail');";
           mysqli_query($conn,$sql);
           ?>
<script > window.location.href='category-manage.php'; </script> 
<?php
   }
   elseif($code==58)
   {   
       echo $ref_no=$_POST['articleID'];
       ?>
<table class="table">
   <tr>
      <th> Article No.</th>
      <th> Date</th>
      <th> Direction</th>
      <th> Remark</th>
   </tr>
   <?php
      $sql="SELECT  * FROM stock_description where reference_no='$ref_no' and Direction!='Issued' order by ID asc";
      $res=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($res))
      {
          ?>
   <tr>
      <td><?=$data['IDNO']?></td>
      <td><?=$data['Date_issue']?></td>
      <td><?=$data['Direction']?></td>
      <td><?=$data['Remarks']?></td>
   </tr>
   <?php
      }
      ?>
</table>
<?php
   }
   elseif ($code==59) 
   {   
       $RoomType=$_POST['RoomType'];
       $location_ID=$_POST['location_ID'];
       $ArticleQrID=$_POST['id'];
       $building_num=0;
       $sr=0;
       $category="SELECT * FROM category_permissions where employee_id='$EmployeeID'";
       $category_run=mysqli_query($conn,$category);
       while ($category_row=mysqli_fetch_array($category_run)) 
       { 
           $cat_id_array[]=$category_row['CategoryCode'];
       }
       $arrayCatCount=count($cat_id_array);
       for($k=0;$k<$arrayCatCount;$k++)
       {
           $cat_id=$cat_id_array[$k];
           $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode  where stock_summary.Status='2' and location_master.ID='$location_ID' AND master_article.CategoryCode='$cat_id' and stock_summary.IDNo like '%$ArticleQrID%' order by IDNo DESC ";
           $building_run=mysqli_query($conn,$building);
           while ($building_row=mysqli_fetch_array($building_run)) 
           {
               $EmployeeID=$building_row['Corrent_owner'];
               $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
               $q1 = sqlsrv_query($conntest, $sql1);
               while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
               {
                   $name = $row['Name'];
               }
               $building_num=$building_num+1;
               ?>
<tr>
   <td><?=$building_num?> </td>
   <td><?=$building_row['IDNo'];?>
      <?php 
         if ($building_row['Corrent_owner']=='0')
         {
             ?>
      <input type="hidden" class="form-control" name="IDNO" id="assign_<?=$sr?>" value="<?=$building_row['IDNo'];?>">
      <?php
         }
         ?>
   </td>
   <td><?=$building_row['ArticleName'];?></td>
   <td>
      <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
   </td>
   <td>
      <?php 
         if ($building_row['WorkingStatus']==0) 
         {
             ?>
      <a class="btn btn-success btn-xs" style="color:white;"> Working</a>
      <?php
         }
         elseif ($building_row['WorkingStatus']==1) 
         {
             ?>
      <a class="btn btn-warning btn-xs"> Faulty </a>
      <?php
         }
         ?>
   </td>
   <?php if ($building_row['Corrent_owner']!='0')
      {
          ?>
   <td>
      <div class="row" id="sinlge_assign1" >
         <div class="col-lg-8">
            <?=$name;?> (<?=$building_row['Corrent_owner'];?>)
         </div>
         <div class="col-lg-4">
            <button type="button" onclick="remove(<?=$building_row['IDNo'];?>,<?=$building_row[ 'Corrent_owner'];?>,<?=$RoomType?>,<?=$location_ID?>);"  class="btn-xs btn btn-danger">Remove</button>
         </div>
      </div>
   </td>
   <?php
      }
      else
      {
          ?>
   <td>
      <div class="row" id="sinlge_assign">
         <div class="col-lg-8">
            <input type="number" class="form-control" name="current_owner" id="current_owner_<?=$sr?>" value="" onkeyup="emp_detail_verify(this.value,1,<?=$building_row['IDNo'];?>);">
            <p id="emp_detail_status_<?=$sr?>"></p>
            <input type="hidden" class="form-control" name="sinlge_assign_sr" id="sinlge_assign_sr_<?=$building_row['IDNo'];?>" value="<?=$sr?>">
         </div>
         <div class="col-lg-4" id="assign_button_<?=$sr?>">
            <button type="button" class="btn-xs btn btn-primary" onclick="singleAssign(<?=$building_row['IDNo'];?>,<?=$RoomType?>,<?=$location_ID?>);">Assign</button>
         </div>
      </div>
   </td>
   <?php
      $sr++;
      }
      ?>
   <td>
      <?php 
         if ($building_row['WorkingStatus']==0) 
         {
             ?>
      <button type="button" class=" btn btn-warning btn-xs" data-toggle="modal" data-target="#fault_Modal" onclick="fault_description(<?=$building_row['IDNo'];?>)">Mark Faulty </button>
      <?php
         }
         elseif ($building_row['WorkingStatus']==1) 
         {
             ?>
      <button type="button" class=" btn btn-success btn-xs" data-toggle="modal" data-target="#fault_Modal" onclick="working(<?=$building_row['IDNo'];?>)">Mark Working</button>
      <?php
         }
         ?>
   </td>
   <?php
      if ($permissionCount>0) 
      {
          ?>
   <td>
      <i class="fa fa-arrow-left fa-lg" onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:red;"></i>      
   </td>
   <?php
      }
      ?>
</tr>
<?php 
   }
   } 
   }
   elseif ($code==60) 
   {   
   $empID=$_POST['empID'];
   $ArticleQrID=$_POST['id'];
   $building_num=0;
   $sr=0;
   $category="SELECT * FROM category_permissions where employee_id='$EmployeeID'";
   $category_run=mysqli_query($conn,$category);
   while ($category_row=mysqli_fetch_array($category_run)) 
   { 
   $cat_id_array[]=$category_row['CategoryCode'];
   }
   $arrayCatCount=count($cat_id_array);
   for($k=0;$k<$arrayCatCount;$k++)
   {
   $cat_id=$cat_id_array[$k];
   $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode  where stock_summary.Status='2' and stock_summary.Corrent_owner='$empID' AND master_article.CategoryCode='$cat_id' and stock_summary.IDNo like '%$ArticleQrID%' order by IDNo DESC ";
   $building_run=mysqli_query($conn,$building);
   while ($building_row=mysqli_fetch_array($building_run)) 
   {
       $EmployeeID=$building_row['Corrent_owner'];
       $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
       $q1 = sqlsrv_query($conntest, $sql1);
       while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
       {
           $name = $row['Name'];
       }
       $building_num=$building_num+1;
       ?>
<tr>
   <td><?=$building_num?></td>
   <td><?=$building_row['IDNo'];?></td>
   <td><?=$building_row['ArticleName'];?></td>
   <td>
      <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
   </td>
   <?php
      if ($permissionCount>0) 
      {
       ?>
   <td>
      <form action="report-print.php" method="post" target="_blank">
         <input type="hidden" name="IdNo" value="<?=$building_row['reference_no'];?>">
         <button class='btn border-0 shadow-none' >
         <i class="fa fa-print fa-lg"  type='submit'  style="color:blue;"></i>
         </button>
      </form>
   </td>
   <td>
      <i class="fa fa-arrow-left fa-lg"  onclick="return_assigned_stock(<?=$building_row['IDNo'];?>);" data-toggle="modal" data-target="#return_stock_Modal" style="color:red;"></i>
   </td>
   <?php
      }
       ?>
</tr>
<?php 
   }
   } 
   }
   
   elseif($code==61)
   {
   $location_num=0;
   ?>
<div class="card-body table-responsive " style="height: 100%;">
   <?php 
      $id=$_POST['id'];   
      $articleRemark='';
      $tokenNum='';
      $aaaa='';
      $count=0;
      
      $location="SELECT *,faulty_track.reference_no as ref, stock_summary.Status as ss_status from faulty_track inner join stock_summary on faulty_track.article_no=stock_summary.IDNo INNER join master_article ma on stock_summary.ArticleCode=ma.ArticleCode where faulty_track.token_no='$id' and faulty_track.status=1";
          $location_run=mysqli_query($conn,$location);
          while ($location_row=mysqli_fetch_array($location_run)) 
          {
              $count++;
              $stockSummaryStatus=$location_row['ss_status'];
              $currentOwner=$location_row['Corrent_owner'];
          $location_num=$location_num+1;
          $article_num=$location_row['article_no'];
          $articleName=$location_row['ArticleName'];
          $articleDescription=$location_row['CPU'];
          $articleStorage=$location_row['Storage'];
          $articleBrand=$location_row['Brand'];
          $articleMemory=$location_row['Memory'];
          $locID=$location_row['LocationID'];
          $ref=$location_row['ref'];
          $tokenNum=$location_row['token_no'];
          $emp=$location_row['updated_by'];
          $time=date("d-m-Y h-i", strtotime($location_row['time_stamp']));
      
          $staff="SELECT Name,Snap FROM Staff Where IDNo='$emp'";
                     $stmt = sqlsrv_query($conntest,$staff);  
                     while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                     {
                       $Emp_Name=$row_staff['Name'];
                       $Emp_Image=$row_staff['Snap'];
                       $emp_pic=base64_encode($Emp_Image);
                     }
      
      
      
      
      
          if ($count%2!=0) 
              {
             $aaaa.="<div class='direct-chat-msg'>
              <div class='direct-chat-infos clearfix'>
                <span class='direct-chat-name float-left'>".$Emp_Name."</span>
                <span class='direct-chat-timestamp float-right'>".$time."</span>
              </div>
              
              <img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
      
              if ($location_row['direction']=='Faulty')
              {
                  $aaaa.="<div class='direct-chat-text bg-danger'>";
              } 
              elseif ($location_row['direction']=='Review') 
              {
                 $aaaa.= "<div class='direct-chat-text bg-warning'>";
              }
              elseif ($location_row['direction']=='Working') 
              {
                  $aaaa.="<div class='direct-chat-text bg-success'>";
              }
                $aaaa.=$location_row['remarks']."
              </div>
             
            </div>";
        }
        else
        {
          $aaaa.="<div class='direct-chat-msg right'>
              <div class='direct-chat-infos clearfix'>
                <span class='direct-chat-name float-right'>".$Emp_Name."</span>
                <span class='direct-chat-timestamp float-left'>".$time."</span>
              </div>
              
              <img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
      
              if ($location_row['direction']=='Faulty')
              {
                  $aaaa.="<div class='direct-chat-text bg-danger'>";
              } 
              elseif ($location_row['direction']=='Review') 
              {
                 $aaaa.= "<div class='direct-chat-text bg-warning'>";
              }
              elseif ($location_row['direction']=='Working') 
              {
                  $aaaa.="<div class='direct-chat-text bg-success'>";
              }
                $aaaa.=$location_row['remarks']."
              </div>
             
            </div>";
        }
          
         
      }
      
      
      ?>
   <label>Particular's Description(<?=$article_num;?>) -  <?=$articleName;?></label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Description</th>
            <th>Storage</th>
            <th>Brand</th>
            <th>Memory</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$articleDescription;?>
            </td>
            <td>
               <?=$articleStorage;?>
            </td>
            <td>
               <?= $articleBrand;?>
            </td>
            <td>
               <?=$articleMemory;?>
            </td>
         </tr>
      </tbody>
   </table>
   <br>
   <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
         <h3 class="card-title">Comments</h3>
         <div class="card-tools">
            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"><?=$count?></span>
         </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <!-- Conversations are loaded here -->
         <div class="direct-chat-messages">
            <!-- Message. Default to the left -->
            <?php echo $aaaa;?>
         </div>
         <!-- /.card-body -->
         <!-- /.card-footer-->
      </div>
      <div class="card-footer">
         <div class="input-group">
            <input type="text" name="faultDetail" id="faultDetail" value="" required placeholder="Type Message ..." class="form-control">
            <span class="input-group-append">
            <input type="hidden" name="code" value="62">
            <button type="submit" class="btn btn-primary">Mark Working</button>
            </span>
         </div>
      </div>
      <!--/.direct-chat -->
   </div>
   <br>
   <div class="row">
      <input type="hidden" name="tokenNum" value="<?=$tokenNum?>">
      <input type="hidden" name="user_id" value="<?=$EmployeeID?>">
      <input type="hidden" name="current_owner_id" value="<?=$currentOwner;?>">
      <input type="hidden" name="reference_no" value="<?=$ref;?>">
      <input type="hidden" name="ssStatus" value="<?=$stockSummaryStatus;?>">
      <input type="hidden" name="location_id" value="<?=$locID;?>">
      <input type="hidden" name="article_id" value="<?=$article_num;?>">
      <!--  <input type="text" name="user_id" value="<?=$EmployeeID?>">
         <input type="text" name="current_owner_id" value="<?=$location_row['Corrent_owner'];?>">
         <input type="text" name="reference_no" value="<?=$location_row['ref'];?>">
         <input type="text" name="ssStatus" value="<?=$location_row['ss_status'];?>">
         <input type="text" name="location_id" value="<?=$location_row['LocationID'];?>">
         <input type="text" name="article_id" value="<?=$location_row['article_no'];?>"> -->
      <!-- <div class="col-lg-8">
         <label>Remarks</label>
         
         <br>
         <textarea name="faultDetail" id="faultDetail" value="" required class="form-control"></textarea>           
         </div>
         <div class="col-lg-4">
         <label>&nbsp;</label>
         <br>
         
         <button type="submit" class="form-control btn-success btn">Mark Working</button>
         
            
         </div> -->
   </div>
</div>
<?php
   }
   elseif ($code=='62') 
   {
    $tokenNumber=$_POST['tokenNum'];
    $empID=$_POST['user_id'];
    $referenceNo=$_POST['reference_no'];
    $ssStatus=$_POST['ssStatus'];
    $currentOwnerID=$_POST['current_owner_id'];
    $locationID=$_POST['location_id'];
    $articleID=$_POST['article_id'];
    $faultDescription=$_POST['faultDetail'];
    $Date=date('Y-m-d');
   
    $sql="UPDATE stock_summary SET WorkingStatus='0' where IDNo='$articleID'";
    $res=mysqli_query($conn,$sql);
    if ($res) 
    {       
   
            $insFaultyTrack="INSERT INTO faulty_track (article_no, location_id,  direction, remarks, reference_no, working_status, status, updated_by, token_no, time_stamp) VALUES ('$articleID', '$locationID', 'Working', '$faultDescription', '$referenceNo', '0', '0', '$EmployeeID', '$tokenNumber' , '$timeStamp')";
            mysqli_query($conn,$insFaultyTrack);
            mysqli_query($conn,"UPDATE faulty_track set status='0' where article_no='$articleID'");
            if ($ssStatus!='1') 
            {
                 $ins="INSERT INTO stock_description (IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus,  Updated_By, reference_no) VALUES ('$articleID','$Date', 'Working','$locationID','$currentOwnerID','$faultDescription','0','$empID','$referenceNo')";
                mysqli_query($conn,$ins);
                // code...
            }
   
   
   
   $array_cp_mail_user=array();
   $mail="SELECT * from stock_summary inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID where IDNo='$articleID' and send_mail='1' and is_admin='1'";
            $mail_run=mysqli_query($conn,$mail);
            while ($mail_row=mysqli_fetch_array($mail_run)) 
            {
                $empID='';
                $empID=$mail_row['employee_id'];
                $sql22="SELECT * FROM Staff Where IDNo='$empID'";
                $q122 = sqlsrv_query($conntest,$sql22);
                while($row1 = sqlsrv_fetch_array($q122, SQLSRV_FETCH_ASSOC) )
                {
                    if ($row1['OfficialEmailID']) 
                    {
                        $array_cp_mail_user[]=$row1['OfficialEmailID'];
        
                    }
                    else
                    {
                        $array_cp_mail_user[]=$row1['EmailID'];
                    }
                }
            }
            $to=array();
       //  print_r($to);    
       //  print_r($array_cp_mail_user);    
       // echo count($array_cp_mail_user);
   $location="SELECT *, lm.RoomNo as Room_No FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName  WHERE ss.IDNo='$articleID'";
            $location_run=mysqli_query($conn,$location);
            if ($location_row=mysqli_fetch_array($location_run)) 
            {
              $block= $location_row['Name'];
              $floor= $location_row['Floor'];
              $roomNo= $location_row['Room_No'];
              $RoomType= $location_row['RoomType'];
              $roomName= $location_row['RoomName'];
            }
   $to_qry="SELECT * from faulty_track where token_no='$tokenNumber' order by ID asc";
   $to_res=mysqli_query($conn,$to_qry);
   if ($to_data=mysqli_fetch_array($to_res)) 
   {
    $empID='';
                $empID=$to_data['updated_by'];
                $sql22="SELECT * FROM Staff Where IDNo='$empID'";
                $q122 = sqlsrv_query($conntest,$sql22);
                while($row1 = sqlsrv_fetch_array($q122, SQLSRV_FETCH_ASSOC) )
                {
                    if ($row1['OfficialEmailID']) 
                    {
                        $array_cp_mail_user[]=$row1['OfficialEmailID'];
        
                    }
                    else
                    {
                        $array_cp_mail_user[]=$row1['EmailID'];
                    }
                    $recieverName=$row1['Name'];
                }
   }
   $sql23="SELECT * FROM Staff Where IDNo='$EmployeeID'";
                $q123 = sqlsrv_query($conntest,$sql23);
                while($row123 = sqlsrv_fetch_array($q123, SQLSRV_FETCH_ASSOC) )
                {
                    $from=$row123['EmailID'];
                    $fromName=$row123['Name'];
                    $Designation=$row123['Designation'];
                }
   
   $to=implode(", ",$array_cp_mail_user);
   $body="";
   $body.="
   
   <!DOCTYPE html>
   <html lang='en'>
   <head>
   <meta charset='utf-8'>
   <meta name='viewport' content='width=device-width, initial-scale=1'>
   <meta http-equiv='x-ua-compatible' content='ie=edge'>
   
   <title></title>
   
   <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700' rel='stylesheet'>
   </head>
   <div class='wrapper' style='font-family: Arial, Helvetica, sans-serif;'>
   <div class='content-wrapper '>
   <div class='content'>
      <div class='container'>
         <div class='row'>
            <div class='col-lg-12 col-sm-12 col-md-12 col-xs-12' >
               <div class='card' style='margin-top:10px;'>
                  <div class='card-body' >
                     <div class='row'>
                      <div class='col-lg-4 col-sm-4 col-md-4 col-xs-4'>
                         <img src='https://recruitment.gurukashiuniversity.in/images/logo-blue.png' alt='GKU logo' class='brand-image' width='200px' height='50px'>
                      </div>
                      <div class='col-lg-4 col-sm-4 col-md-4 col-xs-4'>
                      </div>
                      <div class='col-lg-4 col-sm-4 col-md-4 col-xs-4'>
                      </div>
                     </div>
                     <div class='row' style='margin-top:15px'>
                       <div class='col-lg-12 col-sm-12 col-md-12 col-xs-12'>
                        <label style='color: #223260;  font-size: 16px'>
                          <h5 style='color: #a62535; font-size: 16px'>
                            Dear
                            <span style='text-transform: uppercase ;'>
                             <i> <b>{$recieverName}</b></i>
                              </span></h5></label>
                                <label style='color: #223260;   font-size: 15px'>Article No. <label style='color:#a62535'>{$articleID}</label> is working now.<br>
                                Details as followed.<br><br>
                                <label style='color: #a62535;   font-size: 16px'>
                                Complaint No. - {$tokenNumber}
                                <br>
                                Block- {$block}
                                <br>
                                Floor- {$floor}
                                <br>
                                Room No.- {$roomNo}
                                <br>
                                Type- {$RoomType}
                                <br>
                                Name- {$roomName}
                                <br>
                                Remark- {$faultDescription}
   
                                </label>
                        </label>
                      </div>
                    </div>
                                <br>
                    <div class='row'>
                        Regards<br>{$fromName}<br>({$Designation})
                      <div class='col-lg-12 col-xs-12 col-md-12 col-sm-12' style='text-align: center;'>
                        <label>
                          <h6>
                            <b>
                                <hr style='background-color: #223260'>
                          <a href='http://gurukashiuniversity.co.in/lms' style='color: #223260;   font-size: 20px'>Click here to login.</a>
                          <hr style='background-color: #223260'>
   
                            </b>
                          </h6>
                        </label>
                      </div>
                       </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   </div>
   </html>";
   echo $body;
   echo $to;
   // $to = $inchargeEmail; 
   // $from = $email; 
   // $fromName = $SenderName; 
   $subject = $articleID." Status Working (".$tokenNumber.")"; 
   $headers = "MIME-Version: 1.0" . "\r\n"; 
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
   $headers .= 'From: LIMS Updation <'.$from.'>' . "\r\n"; 
   mail($to, $subject, $body, $headers);
   
    }
       ?>
<script> window.location.href='faulty-articles.php'; </script> 
<?php
   }
   elseif($code==63)
       {
      $location_num=-1;
      ?>
<div class="card-body table-responsive " style="height: 100%;">
   <?php 
      $id=$_POST['id'];  
      $articleRemark=''; 
      $aaaa='';
      $count=0;
      $location="SELECT *,faulty_track.reference_no as ref, stock_summary.Status as ss_status from faulty_track inner join stock_summary on faulty_track.article_no=stock_summary.IDNo INNER join master_article ma on stock_summary.ArticleCode=ma.ArticleCode where faulty_track.token_no='$id' and faulty_track.status=1";
          $location_run=mysqli_query($conn,$location);
          while ($location_row=mysqli_fetch_array($location_run)) 
          { $count++;
               $stockSummaryStatus=$location_row['ss_status'];
              $currentOwner=$location_row['Corrent_owner'];
          $location_num=$location_num+1;
          $article_num=$location_row['article_no'];
          $articleName=$location_row['ArticleName'];
          $articleDescription=$location_row['CPU'];
          $articleStorage=$location_row['Storage'];
          $articleBrand=$location_row['Brand'];
          $articleMemory=$location_row['Memory'];
          $locID=$location_row['LocationID'];
          $ref=$location_row['ref'];
          $tokenNum=$location_row['token_no'];
          $emp=$location_row['updated_by'];
          $time=date("d-m-Y h-i", strtotime($location_row['time_stamp']));
      
          $staff="SELECT Name,Snap FROM Staff Where IDNo='$emp'";
                     $stmt = sqlsrv_query($conntest,$staff);  
                     while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                     {
                       $Emp_Name=$row_staff['Name'];
                       $Emp_Image=$row_staff['Snap'];
                       $emp_pic=base64_encode($Emp_Image);
                     }
      
      
      
      
      
          if ($count%2!=0) 
              {
             $aaaa.="<div class='direct-chat-msg'>
              <div class='direct-chat-infos clearfix'>
                <span class='direct-chat-name float-left'>".$Emp_Name."</span>
                <span class='direct-chat-timestamp float-right'>".$time."</span>
              </div>
              
              <img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
      
              if ($location_row['direction']=='Faulty')
              {
                  $aaaa.="<div class='direct-chat-text bg-danger'>";
              } 
              elseif ($location_row['direction']=='Review') 
              {
                 $aaaa.= "<div class='direct-chat-text bg-warning'>";
              }
              elseif ($location_row['direction']=='Working') 
              {
                  $aaaa.="<div class='direct-chat-text bg-success'>";
              }
                $aaaa.=$location_row['remarks']."
              </div>
             
            </div>";
        }
        else
        {
          $aaaa.="<div class='direct-chat-msg right'>
              <div class='direct-chat-infos clearfix'>
                <span class='direct-chat-name float-right'>".$Emp_Name."</span>
                <span class='direct-chat-timestamp float-left'>".$time."</span>
              </div>
              
              <img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
      
              if ($location_row['direction']=='Faulty')
              {
                  $aaaa.="<div class='direct-chat-text bg-danger'>";
              } 
              elseif ($location_row['direction']=='Review') 
              {
                 $aaaa.= "<div class='direct-chat-text bg-warning'>";
              }
              elseif ($location_row['direction']=='Working') 
              {
                  $aaaa.="<div class='direct-chat-text bg-success'>";
              }
                $aaaa.=$location_row['remarks']."
              </div>
             
            </div>";
        }
          
      
      
          
          if ($articleRemark!='') {
              // code...
          $articleRemark.="<b style='color:red'><br>Review ".$location_num."</b> : ".$location_row['remarks']."- <b style='color:blue'>".$Emp_Name."</b>";
          }
          else{
              $articleRemark.=$location_row['remarks']."- <b style='color:blue'>".$Emp_Name."</b>";
          }
      }
      
      ?>
   <label>Particular's Description(<?=$article_num;?>) -  <?=$articleName;?></label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Description</th>
            <th>Storage</th>
            <th>Brand</th>
            <th>Memory</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$articleDescription;?>
            </td>
            <td>
               <?=$articleStorage;?>
            </td>
            <td>
               <?= $articleBrand;?>
            </td>
            <td>
               <?=$articleMemory;?>
            </td>
         </tr>
      </tbody>
   </table>
   <br>
   <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
         <h3 class="card-title">Comments</h3>
         <div class="card-tools">
            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"><?=$count?></span>
         </div>
      </div>
      <div class="card-body">
         <div class="direct-chat-messages">
            <?php echo $aaaa;?>
         </div>
      </div>
      <div class="card-footer">
         <div class="input-group">
            <input type="text" name="faultDetail" id="faultDetail" value="" required placeholder="Type Message ..." class="form-control">
            <span class="input-group-append">
            <input type="hidden" name="code" value="64">
            <button type="submit" class="btn btn-primary">Send</button>
            </span>
         </div>
      </div>
   </div>
   <input type="hidden" name="tokenNum" value="<?=$tokenNum?>">
   <input type="hidden" name="user_id" value="<?=$EmployeeID?>">
   <input type="hidden" name="current_owner_id" value="<?=$currentOwner;?>">
   <input type="hidden" name="reference_no" value="<?=$ref;?>">
   <input type="hidden" name="ssStatus" value="<?=$stockSummaryStatus;?>">
   <input type="hidden" name="location_id" value="<?=$locID;?>">
   <input type="hidden" name="article_id" value="<?=$article_num;?>">
</div>
<?php
   }
   elseif ($code=='64') 
   {
    $tokenNumber=$_POST['tokenNum'];
    $empID=$_POST['user_id'];
    $referenceNo=$_POST['reference_no'];
    $ssStatus=$_POST['ssStatus'];
    $currentOwnerID=$_POST['current_owner_id'];
    $locationID=$_POST['location_id'];
    $articleID=$_POST['article_id'];
    $faultDescription=$_POST['faultDetail'];
    $Date=date('Y-m-d');
    $insFaultyTrack="INSERT INTO faulty_track (article_no, location_id,  direction, remarks, reference_no, working_status, status, updated_by,token_no, time_stamp) VALUES ('$articleID', '$locationID', 'Review', '$faultDescription', '$referenceNo', '1', '1', '$EmployeeID','$tokenNumber','$timeStamp')";
    mysqli_query($conn,$insFaultyTrack);
   ?>
<script> window.location.href='faulty-articles.php'; </script> 
<?php
   }
   elseif ($code=='65') 
   {
       $faultyStatus=$_POST['id'];
   
                           ?>
<table class="table table-head-fixed text-nowrap table-bordered" id="example">
   <thead>
      <tr>
         <th>ID</th>
         <th>Article</th>
         <th>Location</th>
         <th>Owner Name</th>
         <th>Block Incharge</th>
         <?php 
            if ($faultyStatus==1) 
            {
              ?>
         <th>Mark Working</th>
         <th>Review</th>
         <th>Print</th>
         <?php
            if ($permissionCount>0) 
            {
              ?>
         <th>Assign to</th>
         <?php
            }
            ?>
         <?php
            }
            elseif ($faultyStatus==0) 
            {
            ?>
         <th>View</th>
         <th>Print</th>
         <?php
            }
            ?>
         <!-- <th>Action</th> -->
      </tr>
   </thead>
   <tbody>
      <?php
         $location_num=0;
         if ($permissionCount>0) 
         {
             if ($faultyStatus==1) 
             {
                 $location=" SELECT *,room_master.Floor as FloorName,room_master.RoomNo as RoomName,faulty_track.ID as l_id from faulty_track left join location_master on location_master.ID=faulty_track.location_id left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type Where   faulty_track.status='1' and faulty_track.direction='Faulty' ";
             }
             elseif($faultyStatus==0)
             {
                 $location=" SELECT *,room_master.Floor as FloorName,room_master.RoomNo as RoomName,faulty_track.ID as l_id from faulty_track left join location_master on location_master.ID=faulty_track.location_id left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type Where  faulty_track.status='0' and faulty_track.direction='Working' ";
             }                        
         }
         else
         {
         
             if ($faultyStatus==1) 
             {
                 $location=" SELECT *,room_master.Floor as FloorName,room_master.RoomNo as RoomName,faulty_track.ID as l_id from faulty_track left join location_master on location_master.ID=faulty_track.location_id left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type Where (building_master.Incharge='$EmployeeID' or faulty_track.forwarded_to='$EmployeeID') and  faulty_track.status='1' and faulty_track.direction='Faulty' ";
             }
             elseif($faultyStatus==0)
             {
                 $location=" SELECT *,room_master.Floor as FloorName,room_master.RoomNo as RoomName,faulty_track.ID as l_id from faulty_track left join location_master on location_master.ID=faulty_track.location_id left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type Where (building_master.Incharge='$EmployeeID' or faulty_track.forwarded_to='$EmployeeID') and  faulty_track.status='0' and faulty_track.direction='Working' ";
             }
         }
         
         $location_run=mysqli_query($conn,$location);
         while ($location_row=mysqli_fetch_array($location_run)) 
         {
         $location_num=$location_num+1;?>
      <tr>
         <td><?=$location_num;?></td>
         <td><?=$location_row['article_no'];?></td>
         <td>
            Block: <?=$location_row['Name'];?> &nbsp;&nbsp;&nbsp;&nbsp; Floor: <?=$location_row['FloorName'];?> <br><?=$location_row['RoomType']."(<b>".$location_row['RoomName'];?></b>)
         </td>
         <td><?php 
            echo  "Emp ID:".$empID=$location_row['location_owner'];
            echo "<br>";
              $staff="SELECT Name FROM Staff Where IDNo='$empID'";
              $stmt = sqlsrv_query($conntest,$staff);  
              while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
              {
                 echo "<b>".$Emp_Name=$row_staff['Name']."</b>";
              }
            
             ?>                 
         </td>
         <td><?php 
            echo  "Emp ID:".$Emp=$location_row['Incharge'];
            echo "<br>";
              $staff="SELECT Name FROM Staff Where IDNo='$Emp'";
              $stmt = sqlsrv_query($conntest,$staff);  
              while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
              {
                 echo "<b>".$EmpName=$row_staff['Name']."</b>";
              }
            
             ?>                 
         </td>
         <?php 
            if ($faultyStatus==1) 
            {
              ?>
         <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_assign_stock_Modal" onclick="working_by_incharge(<?=$location_row['token_no'];?>);" style="color:green;"></i></td>
         <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_serial_no_Modal" onclick="review_faulty(<?=$location_row['token_no'];?>);" style="color:red;"></i></td>
         <td>
            <form method="post" action="fault-print.php" target="_blank"><button type="submit" class='btn border-0 shadow-none' style='background-color:transparent; border:display none'><i class="fa fa-print fa-lg" style="color:red;">
               <input type="hidden" name="id" value="<?=$location_row['token_no'];?>">
               </i></button>
            </form>
         </td>
         <?php
            if ($permissionCount>0) 
            {
              ?>
         <td>
            <div class="input-group" style="max-width: 150px;">
               <select name="assignTo" id="assignTo_<?=$location_row['l_id'];?>" class="form-control" required>
                  <?php 
                     $id11=$location_row['l_id'];
                     $assignRes=mysqli_query($conn,"SELECT forwarded_to from faulty_track where id='$id11'");
                     while($assignData=mysqli_fetch_array($assignRes))
                     {
                        if ($assignData['forwarded_to']>0) 
                        {
                        ?>
                  <option value=""><?=$assignData['forwarded_to']?></option>
                  <?php
                     }
                     else 
                     {
                     ?>
                  <option value="">Select</option>
                  <?php
                     }
                     }
                     
                     $_drop_staff="SELECT IDNo,Name From Staff where LeaveSanctionAuthority='$EmployeeID' and JobStatus='1'";     
                     $stmt_drop_staff = sqlsrv_query($conntest,$_drop_staff);  
                     while($row_staff_show = sqlsrv_fetch_array($stmt_drop_staff, SQLSRV_FETCH_ASSOC) )
                       {
                           $IDNo_Drop=$row_staff_show['IDNo'];
                           $Name_Drop=$row_staff_show['Name'];
                          
                           echo "<option value='".$IDNo_Drop."'>".$Name_Drop." (".$IDNo_Drop.")"."</option>";     
                       }
                     
                     ?>
               </select>
               <button  class="btn btn-info" type="button" onclick="assignEmployee(<?=$location_row['l_id'];?>)"><i class="fa fa-arrow-right"></i></button>
               <p id="assignToMessage_<?=$location_row['l_id'];?>"></p>
            </div>
         </td>
         <?php
            }
            
            ?>
         <?php
            }
            elseif ($faultyStatus==0) 
            {
            ?>
         <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#fault_Modal" onclick="complaintSolved(<?=$location_row['token_no'];?>);" style="color:red;"></i></td>
         <td>
            <form method="post" action="fault-print.php" target="_blank"><button type="submit" class='btn border-0 shadow-none' style='background-color:transparent; border:display none'><i class="fa fa-print fa-lg" style="color:red;">
               <input type="hidden" name="id" value="<?=$location_row['token_no'];?>">
               </i></button>
            </form>
         </td>
         <?php
            }
            ?>
      </tr>
      <?php 
         }
         ?>
   </tbody>
</table>
<?php
   }
   elseif ($code=='66')
        {
      $location_num=-1;
      ?>
<div class="card-body table-responsive " style="height: 100%;">
   <?php 
      $id=$_POST['id'];  
      $articleRemark='';
        $aaaa='';
      $count=0; 
      $location="SELECT *,faulty_track.reference_no as ref, stock_summary.Status as ss_status from faulty_track inner join stock_summary on faulty_track.article_no=stock_summary.IDNo INNER join master_article ma on stock_summary.ArticleCode=ma.ArticleCode where faulty_track.token_no='$id' and faulty_track.status=0";
          $location_run=mysqli_query($conn,$location);
          while ($location_row=mysqli_fetch_array($location_run)) 
          {
              $count++;
          $location_num=$location_num+1;
          $article_num=$location_row['article_no'];
          $articleName=$location_row['ArticleName'];
          $articleDescription=$location_row['CPU'];
          $articleStorage=$location_row['Storage'];
          $articleBrand=$location_row['Brand'];
          $articleMemory=$location_row['Memory'];
          $locID=$location_row['LocationID'];
          $ref=$location_row['ref'];
          $tokenNum=$location_row['token_no'];
          $emp=$location_row['updated_by'];
         $time=date("d-m-Y h-i", strtotime($location_row['time_stamp']));
      
          $staff="SELECT Name,Snap FROM Staff Where IDNo='$emp'";
                     $stmt = sqlsrv_query($conntest,$staff);  
                     while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                     {
                       $Emp_Name=$row_staff['Name'];
                       $Emp_Image=$row_staff['Snap'];
                       $emp_pic=base64_encode($Emp_Image);
                     }
                     
         if ($count%2!=0) 
              {
             $aaaa.="<div class='direct-chat-msg'>
              <div class='direct-chat-infos clearfix'>
                <span class='direct-chat-name float-left'>".$Emp_Name."</span>
                <span class='direct-chat-timestamp float-right'>".$time."</span>
              </div>
              
              <img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
      
              if ($location_row['direction']=='Faulty')
              {
                  $aaaa.="<div class='direct-chat-text bg-danger'>";
              } 
              elseif ($location_row['direction']=='Review') 
              {
                 $aaaa.= "<div class='direct-chat-text bg-warning'>";
              }
              elseif ($location_row['direction']=='Working') 
              {
                  $aaaa.="<div class='direct-chat-text bg-success'>";
              }
                $aaaa.=$location_row['remarks']."
              </div>
             
            </div>";
        }
        else
        {
          $aaaa.="<div class='direct-chat-msg right'>
              <div class='direct-chat-infos clearfix'>
                <span class='direct-chat-name float-right'>".$Emp_Name."</span>
                <span class='direct-chat-timestamp float-left'>".$time."</span>
              </div>
              
              <img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
      
              if ($location_row['direction']=='Faulty')
              {
                  $aaaa.="<div class='direct-chat-text bg-danger'>";
              } 
              elseif ($location_row['direction']=='Review') 
              {
                 $aaaa.= "<div class='direct-chat-text bg-warning'>";
              }
              elseif ($location_row['direction']=='Working') 
              {
                  $aaaa.="<div class='direct-chat-text bg-success'>";
              }
                $aaaa.=$location_row['remarks']."
              </div>
             
            </div>";
        }
      }
      
      ?>
   <label>Particular's Description(<?=$article_num;?>) -  <?=$articleName;?></label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Description</th>
            <th>Storage</th>
            <th>Brand</th>
            <th>Memory</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$articleDescription;?>
            </td>
            <td>
               <?=$articleStorage;?>
            </td>
            <td>
               <?= $articleBrand;?>
            </td>
            <td>
               <?=$articleMemory;?>
            </td>
         </tr>
      </tbody>
   </table>
   <br>
   <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
         <h3 class="card-title">Comments</h3>
         <div class="card-tools">
            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"><?=$count?></span>
         </div>
      </div>
      <div class="card-body">
         <div class="direct-chat-messages">
            <?php echo $aaaa;?>
         </div>
      </div>
   </div>
   <br>
</div>
<?php
   }
   elseif($code=='67')
   {
    $id=$_POST['id'];
    $empID=$_POST['empId'];
    mysqli_query($conn,"UPDATE faulty_track set forwarded_to='$empID' where ID='$id'");
   
   }
   elseif ($code=='68')
     {
   $location_num=-1;
   
   ?>
<div class="card-body table-responsive " style="height: 100%;">
   <?php 
      $id=$_POST['id'];  
      $articleRemark=''; 
      $aaaa='';
      $count=0;
      $location="SELECT *,faulty_track.reference_no as ref, stock_summary.Status as ss_status from faulty_track inner join stock_summary on faulty_track.article_no=stock_summary.IDNo INNER join master_article ma on stock_summary.ArticleCode=ma.ArticleCode where faulty_track.token_no='$id'";
          $location_run=mysqli_query($conn,$location);
          while ($location_row=mysqli_fetch_array($location_run)) 
          {
              $count++;
          $location_num=$location_num+1;
          $article_num=$location_row['article_no'];
          $articleName=$location_row['ArticleName'];
          $articleDescription=$location_row['CPU'];
          $articleStorage=$location_row['Storage'];
          $articleBrand=$location_row['Brand'];
          $articleMemory=$location_row['Memory'];
          $locID=$location_row['LocationID'];
          $ref=$location_row['ref'];
          $tokenNum=$location_row['token_no'];
          $emp=$location_row['updated_by'];
         $time=date("d-m-Y h-i", strtotime($location_row['time_stamp']));
      
          $staff="SELECT Name,Snap FROM Staff Where IDNo='$emp'";
                     $stmt = sqlsrv_query($conntest,$staff);  
                     while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                     {
                       $Emp_Name=$row_staff['Name'];
                       $Emp_Image=$row_staff['Snap'];
                       $emp_pic=base64_encode($Emp_Image);
                     }
      
         if ($count%2!=0) 
              {
             $aaaa.="<div class='direct-chat-msg'>
              <div class='direct-chat-infos clearfix'>
                <span class='direct-chat-name float-left'>".$Emp_Name."</span>
                <span class='direct-chat-timestamp float-right'>".$time."</span>
              </div>
              
              <img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
      
              if ($location_row['direction']=='Faulty')
              {
                  $aaaa.="<div class='direct-chat-text bg-danger'>";
              } 
              elseif ($location_row['direction']=='Review') 
              {
                 $aaaa.= "<div class='direct-chat-text bg-warning'>";
              }
              elseif ($location_row['direction']=='Working') 
              {
                  $aaaa.="<div class='direct-chat-text bg-success'>";
              }
                $aaaa.=$location_row['remarks']."
              </div>
             
            </div>";
        }
        else
        {
          $aaaa.="<div class='direct-chat-msg right'>
              <div class='direct-chat-infos clearfix'>
                <span class='direct-chat-name float-right'>".$Emp_Name."</span>
                <span class='direct-chat-timestamp float-left'>".$time."</span>
              </div>
              
              <img class='direct-chat-img' src='data:image/jpeg;base64,".$emp_pic."' alt='message user image'>";
      
              if ($location_row['direction']=='Faulty')
              {
                  $aaaa.="<div class='direct-chat-text bg-danger'>";
              } 
              elseif ($location_row['direction']=='Review') 
              {
                 $aaaa.= "<div class='direct-chat-text bg-warning'>";
              }
              elseif ($location_row['direction']=='Working') 
              {
                  $aaaa.="<div class='direct-chat-text bg-success'>";
              }
                $aaaa.=$location_row['remarks']."
              </div>
             
            </div>";
        }
      }
      
      
      
      ?>
   <label>Particular's Description(<?=$article_num;?>) -  <?=$articleName;?></label>
   <table class="table table-head-fixed text-nowrap" border="1">
      <thead>
         <tr>
            <th>Description</th>
            <th>Storage</th>
            <th>Brand</th>
            <th>Memory</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$articleDescription;?>
            </td>
            <td>
               <?=$articleStorage;?>
            </td>
            <td>
               <?= $articleBrand;?>
            </td>
            <td>
               <?=$articleMemory;?>
            </td>
         </tr>
      </tbody>
   </table>
   <br>
   <div class="card direct-chat direct-chat-primary">
      <div class="card-header">
         <h3 class="card-title">Comments</h3>
         <div class="card-tools">
            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary"><?=$count?></span>
         </div>
      </div>
      <div class="card-body">
         <div class="direct-chat-messages">
            <?php echo $aaaa;?>
         </div>
      </div>
   </div>
   <br>
</div>
<?php
   }
   
   elseif($code=='69')
   {
   $univ_rollno=$_POST['rollNo'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno' or IDNo='$univ_rollno'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
   
    $IDNo= $row['IDNo'];
    $ClassRollNo= $row['ClassRollNo'];
    $img= $row['Snap'];
    $UniRollNo= $row['UniRollNo'];
    $name = $row['StudentName'];
    $father_name = $row['FatherName'];
    $course = $row['Course'];
    $email = $row['EmailID'];
    $phone = $row['StudentMobileNo'];
    $batch = $row['Batch'];
    $college = $row['CollegeName'];
   ?>
<div class="row">
<div class="col-lg-1"></div>
<div class="col-lg-10">
<?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($img).'" height="100" width="100" class="img-thumnail"  style="border-radius:50%"/></center>';?>
<p><b>NAME</b>:&nbsp;&nbsp;&nbsp;<?php echo $name; ?></p>
<hr style="margin-top: 0px;margin-bottom: 3px">
<p><b>Father Name </b> :&nbsp;&nbsp;&nbsp;<?php echo $father_name; ?></p>
<p><b>Class Roll NO</b> : <?= $ClassRollNo ;?></p>
<hr style="margin-top: 0px;margin-bottom: 3px">
<p><b>Uni Roll NO</b> :<?php if($UniRollNo!=''){ echo $UniRollNo;}else{echo "<font style='color:red'>Not Issued</font>";} ?></p>
<hr style="margin-top: 0px;margin-bottom: 3px">
<p><b>ID NO</b> :<?php if($IDNo!=0){ echo $IDNo;}else{echo "<font style='color:red'>Need to Signup</font>";} ?></p>
<hr style="margin-top: 0px;margin-bottom: 3px">
<p><b>Contact :</b>&nbsp;&nbsp;&nbsp;<?php echo $phone; ?></p>
<p><b>Batch :</b>&nbsp;&nbsp;&nbsp;<?php echo $batch; ?></p>
<p><b>College: </b>&nbsp;&nbsp;&nbsp;<?php echo $college; ?></p>
<p><b>Course: </b>&nbsp;&nbsp;&nbsp;<?php echo $course; ?></p>
<?Php
   }   
   
   }
   elseif($code=='70')
   {
   $univ_rollno=$_POST['rollNo'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
     $IDNo= $row['IDNo'];
     $ClassRollNo= $row['ClassRollNo'];
     $img= $row['Snap'];
     $UniRollNo= $row['UniRollNo'];
     $name = $row['StudentName'];
     $father_name = $row['FatherName'];
     $course = $row['Course'];
     $email = $row['EmailID'];
     $phone = $row['StudentMobileNo'];
     $batch = $row['Batch'];
     $college = $row['CollegeName'];
     $detail[]=array("IDNo"=>$IDNo,"ClassRollNo"=>$ClassRollNo,"UniRollNo"=>$UniRollNo,"StudentName"=>$name);
   
   }   
   echo json_encode($detail);
   exit;
   
   }
   elseif($code=='71')
   {       
     ?>
     <optgroup label="Select Room No.">
<option value="">Select</option>
<?php
   $floor=$_POST['floor'];
   $hostel=$_POST['hostel'];
   $room_qry="Select Distinct RoomNo,RoomType,rnm.RoomName from location_master lm INNER JOIN room_type_master rtm ON lm.Type=rtm.ID  INNER JOIN room_name_master rnm ON lm.RoomName=rnm.ID  where  Floor='$floor' and Block='$hostel'";
   $res_room=mysqli_query($conn,$room_qry);
   while ($roomData=mysqli_fetch_array($res_room)) 
   {
      $roomValue=$roomData['RoomNo'];
      ?>
<option value="<?=$roomData['RoomNo']?>"><?=$roomData['RoomNo']?>(<?=$roomData['RoomType']?> - <?=$roomData['RoomName']?>)</option>
<?php
   } 
   ?>
</optgroup>
   <?php
   }
   elseif($code=='72')
   {       
   
   $floor=$_POST['floor'];
   $room=$_POST['room'];
   $hostel=$_POST['hostel'];
   $room_qry="Select ID from location_master where  Floor='$floor' and RoomNo='$room' and Block='$hostel'";
   $res_room=mysqli_query($conn,$room_qry);
   while ($roomData=mysqli_fetch_array($res_room)) 
   {
      $locationId=$roomData['ID'];
      $qry="SELECT distinct IDNo from stock_summary INNER JOIN master_article ON master_article.ArticleCode=stock_summary.ArticleCode left join hostel_student_summary on stock_summary.IDNo=hostel_student_summary.article_no where LocationID='$locationId' AND ArticleName='Bed' and (hostel_student_summary.status!='0' or hostel_student_summary.status is NULL)";
      $res=mysqli_query($conn,$qry);
      while($data=mysqli_fetch_array($res))
      {
           $IDNo=$data['IDNo'];
           $flag=0;
           $flagQry="SELECT * from hostel_student_summary where article_no='$IDNo' and status='0'";
           $flagRes=mysqli_query($conn,$flagQry);
           while($flagData=mysqli_fetch_array($flagRes))
           {
                   $flag++;
           }
           if ($flag==0) 
           {
           
           ?>
<option value="<?=$IDNo?>"><?=$IDNo?></option>
<?php
   }
   }
   } 
   }
   elseif($code=='73')
   {       
   
   $studentId=$_POST['id'];
   $sql="SELECT * from hostel_student_summary where student_id='$studentId' and status='0'";
   $res=mysqli_query($conn,$sql);
   while($data=mysqli_fetch_array($res))
   {
   echo "User Already Assigned";
   }
   
   
   }
   elseif($code=='74')
   {       
   $hostel=$_POST['hostel'];
   $floor=$_POST['floor'];
   $room=$_POST['room'];
   $bed=$_POST['bed'];
   $studentId=$_POST['id'];
   $session=$_POST['session'];
   $studentRemark=$_POST['studentRemark'];
   
   $bedCheckQry="Select * from hostel_student_summary where article_no='$bed' and status='0'";
   $bedCheckRes=mysqli_query($conn,$bedCheckQry);
   if (mysqli_num_rows($bedCheckRes)>0) 
   {
   echo '<div class="alert alert-danger">
   <strong>Bed Already Assigned.</strong> 
   </div>';
   }
   else
   {
   
   
   
   $location="Select ID from location_master where  Floor='$floor' and RoomNo='$room' and Block='$hostel'";
   $res_location=mysqli_query($conn,$location);
   while ($locationData=mysqli_fetch_array($res_location)) 
   {
   $locationId=$locationData['ID'];
   $date=date('Y-m-d');
   $one=date("His");
   $two= date("myd");
   $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
   $four=substr(str_shuffle($one.$two.$three),1,8);
   $result =$one.$three.$two.$four;
   $stockSql="SELECT * from stock_summary where IDNo='$bed' and Status='2'";
   $stockRes=mysqli_query($conn,$stockSql);
   if ($dataSql=mysqli_fetch_array($stockRes)) 
   {
   $currentOwner=$dataSql['Corrent_owner'];
   $referenceNo=$dataSql['reference_no'];
   $locID=$dataSql['LocationID'];
   $studentRemark='Assigned To Student '.$studentRemark;
   $description_ins="INSERT INTO stock_description (IDNo,Date_issue,Direction,LocationID,OwerID,Remarks,WorkingStatus,DeviceSerialNo,Updated_By,reference_no) values ('$bed','$date','Returned','$locID','$currentOwner','$studentRemark','0','0','$EmployeeID','$referenceNo')";
       mysqli_query($conn, $description_ins);
   }
   $room_type_insert = "UPDATE  stock_summary SET LocationID='$locationId',Corrent_owner='$studentId',IssueDate='$date' ,Status='2', reference_no='$result' where IDNo='$bed'";
   $type_run = mysqli_query($conn,$room_type_insert);
   if ($type_run == true) 
   {
   $description_insert="INSERT INTO stock_description (IDNo,Date_issue,Direction,LocationID,OwerID,Remarks,WorkingStatus,DeviceSerialNo,Updated_By,reference_no) values ('$bed','$date','Issued','$locationId','$studentId','Issued','0','0','$EmployeeID','$result')";
   mysqli_query($conn, $description_insert);
   $hostelIns="INSERT INTO hostel_student_summary (article_no, student_id, location_id, session , status,  check_in_date, reference_no) VALUES ( '$bed', '$studentId', '$locationId','$session', '0',  '$date',  '$result')";
   mysqli_query($conn,$hostelIns);
   
   echo '<div class="alert alert-success">
   <strong>Success!</strong> 
   </div>';
   } 
   else 
   {
   echo "Ohh yaar ";
   }
   }
   } 
   }
   elseif($code=='75')
   {
   $count=0;
   $univ_rollno=$_POST['rollNo'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno' or IDNo='$univ_rollno'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
   $IDNo= $row['IDNo'];
   }
   $building_num=0;
   $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join building_master on building_master.ID=location_master.Block where stock_summary.Status='2' and location_master.location_owner='$EmployeeID' and Corrent_owner='$IDNo' order by IDNo DESC ";
   $building_run=mysqli_query($conn,$building);
   while ($building_row=mysqli_fetch_array($building_run)) 
   {
   $EmployeeID=$building_row['Corrent_owner'];
   $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
   $q1 = sqlsrv_query($conntest, $sql1);
   while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
   {
   $name = $row['Name'];
   }
   if ($building_num==0) 
   {
   ?>
<label><?=$building_row['Name'];?></label>
<table class="table">
   <?php
      }
      $studentStockAssigned[$building_num][]=$building_row['IDNo'];
      $studentStockAssigned[$building_num][]=$building_row['ArticleName'];
      $studentStockAssigned[$building_num][]=$building_row['RoomNo'];
      unset($name); 
      $building_num=$building_num+1;
      }
      
      if ($building_num>0) 
      {
      ?>
   <tr>
      <th>Sr No.</th>
      <th>Article No.</th>
      <th>Article Name</th>
      <th>Room No.</th>
      <th>View</th>
      <th>Check Out</th>
   </tr>
   <?php 
      }
          // print_r($studentStockAssigned);
          for ($i=0; $i < $building_num ; $i++) 
          { 
              ?>
   <tr>
      <td><?=$i+1?></td>
      <?php
         for ($j=0; $j < 3; $j++) 
         { 
             ?>
      <td><?=$studentStockAssigned[$i][$j]?></td>
      <?php
         }
         ?>
      <td>
         <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$studentStockAssigned[$i][0]?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
      </td>
      <td>
         <?php if ($building_num<2 || $studentStockAssigned[$i][1]!='Bed') 
            {
             ?>   
         <i class="fa fa-arrow-left fa-lg" onclick="check_out(<?=$studentStockAssigned[$i][0]?>,<?=$IDNo?>);" style="color:red;"></i>
         <?php }
            ?>
      </td>
   </tr>
   <?php
      }
      ?>
</table>
<?php
   }
   elseif($code=='76')
   {
       $articleId=$_POST['id'];
       $studentRemark=$_POST['studentRemark'];
       $date=date('Y-m-d');
       $one=date("His");
       $two= date("myd");
       $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
       $four=substr(str_shuffle($one.$two.$three),1,8);
       $result =$one.$three.$two.$four;
       $stockSql="SELECT * from stock_summary where IDNo='$articleId' and Status='2'";
       $stockRes=mysqli_query($conn,$stockSql);
       if ($dataSql=mysqli_fetch_array($stockRes)) 
       {
           $currentOwner=$dataSql['Corrent_owner'];
           $referenceNo=$dataSql['reference_no'];
           $locID=$dataSql['LocationID'];
           $studentRemark='Student Checked-Out'.$studentRemark;
           $description_ins="INSERT INTO stock_description (IDNo,Date_issue,Direction,LocationID,OwerID,Remarks,WorkingStatus,DeviceSerialNo,Updated_By,reference_no) values ('$articleId','$date','Returned','$locID','$currentOwner','$studentRemark','0','0','$EmployeeID','$referenceNo')";
           mysqli_query($conn, $description_ins);
           $hostelIns="UPDATE hostel_student_summary SET status='1', check_out_date='$date' WHERE reference_no='$referenceNo'";
           mysqli_query($conn,$hostelIns);
       }
       $locOwnerQry="SELECT location_owner from location_master Where ID='$locID'";
       $locOwnerRes=mysqli_query($conn,$locOwnerQry);
       while($locOwnerData=mysqli_fetch_array($locOwnerRes))
       {
           $locOwner=$locOwnerData['location_owner'];
       }
   
       $room_type_insert = "UPDATE  stock_summary SET LocationID='$locID',Corrent_owner='$locOwner',IssueDate='$date' ,Status='2', reference_no='$result' where IDNo='$articleId'";
       $type_run = mysqli_query($conn,$room_type_insert);
       if ($type_run == true) 
       {
           $description_insert="INSERT INTO stock_description (IDNo,Date_issue,Direction,LocationID,OwerID,Remarks,WorkingStatus,DeviceSerialNo,Updated_By,reference_no) values ('$articleId','$date','Issued','$locID','$locOwner','Issued','0','0','$EmployeeID','$result')";
           mysqli_query($conn, $description_insert);
       } 
   }
   else if ($code==77) 
   {
       ?>
<div class="card-body">
   <div class="form-group row" >
      <div class="col-lg-12">
         <?php
            $empID=$_POST['emp_id'];
            
             $staff="SELECT * FROM Staff Where IDNo='$empID'";
             $stmt = sqlsrv_query($conntest,$staff);  
             if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
             {
                 echo "<b>".$Emp_Name=$row_staff['Name']."(".$row_staff['IDNo'].")";
                 $emp=$row_staff['IDNo'];
                 ?>
         <!-- <input type="text" name="emp" id="emp" value="<?=$emp?>"> -->
         <table class="table" border="1">
            <tr>
               <th>Building</th>
               <th>Delete</th>
            </tr>
            <?php
               $sql="SELECT *,hostel_permissions.ID as HPID from hostel_permissions inner join building_master on hostel_permissions.building_master_id=building_master.ID where emp_id='$empID'";
               $res=mysqli_query($conn,$sql);
               while($data=mysqli_fetch_array($res))
               {   
                   ?>
            <tr>
               <td><?= $data['Name']?></td>
               <td><i class=" fa fa-trash " id="dlt"  type="button" onclick="deleteHostelPermission(<?=$data['HPID']; ?>,<?=$empID ?>)" data-toggle="modal"  style="color: #223260;padding-left: 20px;padding-top: 5px">
                  </i>
               </td>
            </tr>
            <?php
               }
               ?>
         </table>
      </div>
   </div>
</div>
<div class="card-footer">
   <?php 
      if (isset($emp))
      {
      ?>
   <input type="hidden" name="" value="<?=$emp?>">
   <button type="submit" class="btn btn-info" data-toggle="modal" onclick="assignHostelPermission(<?=$emp?>)" data-target="#Assign_Permission">Assign Permessions</button>
   <?php
      }
      ?>
   <p id="category_success"></p>
</div>
<?php
   }
   unset($emp);
   //print_r($array);
   }
   else if ($code==78) 
   {
   $ID=$_POST['ID'];
   $staff="Delete FROM hostel_permissions Where ID='$ID'";
   mysqli_query($conn,$staff);  
   
   
   }
   else if ($code==79) 
   {
   $empID=$_POST['emp_id'];
   $count=0;
   $staff="SELECT * FROM Staff Where IDNo='$empID' ";
     $stmt = sqlsrv_query($conntest,$staff);  
     while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
     {
       $Emp_name=$row_staff['Name'];
     }
       $sql="SELECT * FROM hostel_permissions inner join building_master on building_master.ID=hostel_permissions.building_master_id where emp_id='$empID'";
       $result = mysqli_query($conn,$sql);
       $hostel = "";
       $hostel_array =array();
       while($row=mysqli_fetch_array($result))
       {
           $hostel_array[] = $row['building_master_id'];
           $building_name = $row['Name'];
       }
       //$hostel_array = explode(",",$hostel);
      echo "<h4>".$Emp_name."(".$empID.")</h4>";
       $count=0;
       $result1 = mysqli_query($conn,"SELECT * from building_master inner join block_type_master on building_master.type=block_type_master.id where block_type_master.type='hostel'");
       echo "<form  action = 'action.php' method = 'POST'>";
       echo "<input type='hidden' name='code' value='80'>";
       echo "<input type='hidden' name='user_id' value = '".$empID."'>";
       while($row1=mysqli_fetch_array($result1))
       {
           $allHostel[]= $row1['ID'];
           $count++;
       }
       $count=count($hostel_array);
       $countAllHostel=count($allHostel);
   for($i=0;$i<$countAllHostel;$i++)
   {
         $checked = 0;
         echo "<div class='checkbox'>";
         for($j=0;$j<$count;$j++)
         {
           if($allHostel[$i] == $hostel_array[$j])
           {
             $checked = 1;
           }
         }
         $hostelName="SELECT * from building_master where ID='$allHostel[$i]'";
         $hostelRes=mysqli_query($conn,$hostelName);
         while($hostelData=mysqli_fetch_array($hostelRes))
         {
           $HostelName=$hostelData['Name'];
         }
         if($checked==0)
         {
               echo "<label><input type='checkbox' name = 'per[]' value=".$allHostel[$i].">"."&nbsp;".$HostelName."</label> ";
         }
          
         echo "</div>";
   
       }
       echo "<input type = 'submit' class = 'btn btn-primary btn-xs' name = ''>";
       echo "</form";
   }
   elseif ($code==80) 
   {
    $user_id = $_POST["user_id"];
    $per = $_POST['per'];
   if ($_POST["per"] == "") 
   {
       $per = 0;
   } 
   else 
   {
    $count=count($per);
    for($i=0;$i<$count;$i++)
    {  
      $sql="SELECT * from hostel_permissions where emp_id='$user_id' and building_master_id='$per[$i]'";
       $res=mysqli_query($conn,$sql);
       if(mysqli_num_rows($res)<1)
       {
           $ins="INSERT INTO hostel_permissions (emp_id, building_master_id) VALUES ('$user_id', '$per[$i]')";
           mysqli_query($conn,$ins);
   
       }
   
    }
   }
   
    // $result = mysqli_query($conn, "UPDATE user set u_permissions = '$per' where emp_id = '$user_id'");
   ?>
<script> window.location.href = 'master-permission.php'; </script> 
<?php
   }
   elseif($code=='81')
   {
       echo $building=$_POST['building'];
        ?>
<option value="">Select Floor</option>
<?php
   $floor_qry="Select distinct Floor from location_master where Block='$building'";
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
         if (isset($floorName)) 
         {
             // code...
         
         ?>
<option value="<?=$floorValue?>"><?=$floorName?></option>
<?php
   }
   }
   
   }
   elseif($code=='82')
   {
   $building=$_POST['building'];
   $floor=$_POST['floor'];
   ?>
<option value="">Select Room No.</option>
<?php
   if ($floor!='') 
   {
       $room_qry="Select RoomNo from location_master where Block='$building' and Floor='$floor'";
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
   
   }
   elseif($code=='83')
   {   
   $count=0;
   $building=$_POST['building'];
   $floor=$_POST['floor'];
   $room=$_POST['room'];
   if ($building!='' && $floor=='' && $room=='') 
   {
      $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$building' and hostel_student_summary.status='0'";
   }
   elseif ($building!='' && $floor=='' && $room!='') 
   {
       $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$building' and hostel_student_summary.status='0' and RoomNo='$room'";
   }
   elseif ($building!='' && $floor!='' && $room=='') 
   {
       $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$building' and hostel_student_summary.status='0' and Floor='$floor'";
   }
   elseif ($building!='' && $floor!='' && $room!='') 
   {
       $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$building' and hostel_student_summary.status='0' and RoomNo='$room' and Floor='$floor'";
   }
   
   ?>
<table class="table">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Name</th>
         <th>Class/Uni Roll No.</th>
         <th>Father Name</th>
         <th>Contact No.</th>
         <th>Course</th>
         <th>Room No.</th>
         <th>Bed No.</th>
         <th>Image</th>
         <th>Checked In </th>
         <th>Action</th>
         <th>Attendance</th>
      </tr>
   </thead>
   <?php
      $res=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($res))
      {
          $IDNo=$data['student_id'];
          $result1 = "SELECT  * FROM Admissions where IDNo='$IDNo'";
          $stmt1 = sqlsrv_query($conntest,$result1);
          while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
          {
              $IDNo= $row['IDNo'];
              $ClassRollNo= $row['ClassRollNo'];
              $img= base64_encode($row['Snap']);
              $UniRollNo= $row['UniRollNo'];
              $name = $row['StudentName'];
              $father_name = $row['FatherName'];
              $course = $row['Course'];
              $email = $row['EmailID'];
              $phone = $row['StudentMobileNo'];
              $batch = $row['Batch'];
              $college = $row['CollegeName'];
          }
          $sql1="SELECT * from hostel_student_summary where status='0' and student_id='$IDNo'";
          $res1=mysqli_query($conn,$sql1);
          while($data1=mysqli_fetch_array($res1))
          {
              $locationID=$data1['location_id'];
          }
      
          $count++;
          ?>
   <tr>
      <td><?=$count?></td>
      <td><?=$name?></td>
      <td><?= $ClassRollNo ;?>/<?= $UniRollNo ;?></td>
      <td><?=$father_name?></td>
      <td><?=$phone?></td>
      <td><?=$course?></td>
      <td><?=$data['RoomNo']?></td>
      <td><?=$data['article_no']?></td>
      <td>
         <center><img src="data:image/jpeg;base64,<?=$img?>" height="50" width="50" class="img-thumnail"  style="border-radius:50%"/></center>
      </td>
      <td><?=$data['check_in_date']?></td>
      <td><i class="fa fa-edit fa-lg" onclick="student_stock(<?=$locationID?>,<?=$IDNo?>);" data-toggle="modal" data-target="#student_stock" style="color:blue;"></i></td>
      <td><i class="fa fa-eye fa-lg" onclick="studentAttendance(<?=$IDNo?>);" data-toggle="modal" data-target="#student_attendance" style="color:red;"></i></td>
   </tr>
   <?php
      }
      ?>
</table>
<?php
   }
   
   elseif($code=='84')
   {
   $univ_rollno=$_POST['rollNo'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
       $IDNo= $row['IDNo'];
       $ClassRollNo= $row['ClassRollNo'];
       $img= base64_encode($row['Snap']);
       $UniRollNo= $row['UniRollNo'];
       $name = $row['StudentName'];
       $father_name = $row['FatherName'];
       $course = $row['Course'];
       $email = $row['EmailID'];
       $phone = $row['StudentMobileNo'];
       $batch = $row['Batch'];
       $college = $row['CollegeName'];
       $sql="SELECT distinct student_id from hostel_student_summary where student_id='$IDNo'";
       $res=mysqli_query($conn,$sql);
       if (mysqli_num_rows($res)>0) 
       {
           $roomNo='';
               $floor='';
            $qry="SELECT *, location_master.RoomNo as lmRoomNo,room_master.Floor as rmFloor from hostel_student_summary inner join location_master on location_master.ID=hostel_student_summary.location_id INNER JOIN room_master ON room_master.RoomNo=location_master.RoomNo  where student_id='$IDNo' and status='0'";
           $run=mysqli_query($conn,$qry);
           while($data=mysqli_fetch_array($run))
           {
               $roomNo=$data['lmRoomNo'];
               $floor=$data['rmFloor'];
           }
   
   ?>
<div class="row">
<div class="col-lg-12">
<table class="table">
   <thead>
      <tr>
         <td>Name :</td>
         <td><b><?=$name?></b></td>
         <td>Father Name :</td>
         <td><b><?=$father_name?></b></td>
         <td>Class/Uni Roll No.</td>
         <td><b><?= $ClassRollNo ;?>/<?= $UniRollNo ;?></b></td>
         <td rowspan="2" width="12%">
            <center><img src="data:image/jpeg;base64,<?=$img?>" height="100%" width="100%" class="img-thumnail"  style="border-radius:5%"/></center>
         </td>
      </tr>
      <tr>
         <td>Room No. :</td>
         <td><b><?=$roomNo?></b></td>
         <td>Floor :</td>
         <td><b><?=$floor?></b></td>
         <td>Course :</td>
         <td><b><?= $course ;?></b></td>
      </tr>
   </thead>
</table>
<br>
<table class="table">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Article No.</th>
         <th>Article Name</th>
         <th>Issue Date</th>
         <th>Return Date</th>
      </tr>
   </thead>
   <tbody>
      <?php 
         $location_num = 0;
         $returnArray[] = '';
         $array = array();
         $sql = "SELECT distinct reference_no FROM stock_description  where OwerID='$IDNo' ORDER BY Direction desc";
         $result = mysqli_query($conn, $sql);
         $arrayReference = array();
         while ($row = mysqli_fetch_array($result)) 
         {
             $ref = $row['reference_no'];
             $sql_ref = "SELECT * FROM stock_description left join stock_summary on stock_summary.IDNo=stock_description.IDNo left join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join master_calegories on stock_summary.CategoryID=master_calegories.ID INNER join master_article ma on stock_summary.ArticleCode=ma.ArticleCode where stock_description.reference_no='$ref' and OwerID='$IDNo' and (Direction='Issued' or Direction='Returned')  ORDER BY Direction desc";
             $resultRef = mysqli_query($conn, $sql_ref);
             while ($rowRef = mysqli_fetch_array($resultRef)) 
             {
                 $category = $rowRef['ArticleName'];
                 $articleName = $rowRef['ArticleName'];
                 $id = $rowRef['IDNo'];
                 if (!in_array($ref, $returnArray)) 
                 {
                     $location_num = $location_num + 1;
                     $returnid = '';
                     $location = "SELECT * from stock_description left join stock_summary ss on ss.IDNo=stock_description.IDNo WHERE OwerID='$IDNo'  and stock_description.IDNo='$id' and stock_description.reference_no='$ref'";
                     $location_run = mysqli_query($conn, $location);
                     while ($location_row = mysqli_fetch_array($location_run)) 
                     {
                         $location_row['Direction'];
                         if ($location_row['Direction'] == 'Returned') 
                         {
                             $returnid = $location_row['IDNo'];
                             $return = $location_row['Date_issue'];
                         } 
                         elseif ($location_row['Direction'] == 'Issued') 
                         {
                             $direction = $location_row['Direction'];
                             $issue_date = $location_row['Date_issue'];
                         }
                     }
                     ?>
      <tr>
         <td>
            <?=$location_num; ?>
         </td>
         <td>
            <?=$id; ?>
         </td>
         <td>
            <?=$articleName; ?>
         </td>
         <td>
            <?php
               if ($direction == 'Issued') 
               {
                   echo $issue_date;
                   unset($direction);
               }
               ?> 
         </td>
         <td>
            <?php
               if (isset($return)) 
               {
                   echo $return;
                   unset($return);
               }
               ?> 
         </td>
         <!-- <td>
            <form action="report-print.php" method="post" target="_blank">
                            <input type="hidden" name="IdNo" value="<?=$ref; ?>">
                              <button class='btn border-0 shadow-none' >
                                <i class="fa fa-print fa-lg"  type='submit'  style="color:blue;"></i>
                              </button>
                          </form>
            </td> -->
      </tr>
      <?php
         $returnArray[] = $ref;
         }
         }
         }
         ?>
   </tbody>
</table>
<?Php
   }
   }   
   }
   elseif($code=='85')
   {
   $locationID=$_POST['locationID'];
   $studentID=$_POST['studentID'];
   $flag=0;
   $assignCheckQry="Select * from location_master where ID='$locationID' and location_owner='$EmployeeID'";
   $assignCheckRes=mysqli_query($conn,$assignCheckQry);
   if (mysqli_fetch_array($assignCheckRes)) 
   {
       $flag=1;
   }
   ?>
<div class="modal-header">
   <h5 class="modal-title" id="exampleModalLabel">Student Stock</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<!-- <input type="hidden" name="code" value="88"> -->
<div class="modal-body" >
   <?php
      $count=0;
      $univ_rollno=$studentID;
      $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno' or IDNo='$univ_rollno'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
          $IDNo= $row['IDNo'];
      }
      $building_num=0;
      $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join building_master on building_master.ID=location_master.Block where stock_summary.Status='2'  and Corrent_owner='$IDNo' order by IDNo DESC ";
      $building_run=mysqli_query($conn,$building);
      while ($building_row=mysqli_fetch_array($building_run)) 
      {
          if ($building_num==0) 
          {
          ?>
   <label><?=$building_row['Name'];?></label>
   <table class="table">
      <?php
         }
         $studentStockAssigned[$building_num][]=$building_row['IDNo'];
         $studentStockAssigned[$building_num][]=$building_row['ArticleName'];
         $studentStockAssigned[$building_num][]=$building_row['RoomNo'];
         unset($name); 
         $building_num=$building_num+1;
         }
         
         if ($building_num>0) 
         {
         ?>
      <tr>
         <th>Sr No.</th>
         <th>Article No.</th>
         <th>Article Name</th>
         <th>Room No.</th>
         <th>View</th>
         <?php if ($flag==1) 
            {
                ?>
         <th>Check Out</th>
         <?php
            }
            ?>
      </tr>
      <?php 
         }
             // print_r($studentStockAssigned);
             for ($i=0; $i < $building_num ; $i++) 
             { 
                 ?>
      <tr>
         <td><?=$i+1?></td>
         <?php
            for ($j=0; $j < 3; $j++) 
            { 
                ?>
         <td><?=$studentStockAssigned[$i][$j]?></td>
         <?php
            }
            ?>
         <td>
            <i class="fa fa-eye fa-lg" onclick="view_assign_stock(<?=$studentStockAssigned[$i][0]?>);" data-toggle="modal" data-target="#view_assign_stock_Modal" style="color:red;"></i>
         </td>
         <?php if ($flag==1) 
            {
                ?>
         <td>
            <?php if ($building_num<2 || $studentStockAssigned[$i][1]!='Bed') 
               {
                ?>   
            <i class="fa fa-arrow-left fa-lg" onclick="check_out(<?=$studentStockAssigned[$i][0]?>,<?=$IDNo?>,<?=$locationID?>);" style="color:red;"></i>
            <?php }
               ?>
         </td>
         <?php
            }
            ?>
      </tr>
      <?php
         }
         ?>
   </table>
   <?php
      if ($flag==1 && $building_num>0) 
      {
      ?>
   <input type="hidden" name="studentID" id="studentID" value="<?=$studentID?>" required>
   <div class="row">
      <div class="col-lg-4">
         <label>Category</label>
         <div class="input-group">
            <select name="categoryId" required class="form-control" onchange="article_at_location(this.value,<?=$locationID?>)">
               <option value="">Select</option>
               <?php
                  $sql="SELECT distinct CategoryName,ID from master_calegories inner join stock_summary on master_calegories.ID=stock_summary.CategoryID where LocationID='$locationID'";
                  $res=mysqli_query($conn,$sql);
                  while($data=mysqli_fetch_array($res))
                  {
                      ?>
               <option value="<?=$data['ID']?>"><?=$data['CategoryName']?></option>
               <?php
                  }
                  ?>
            </select>
         </div>
      </div>
      <div class="col-lg-4">
         <label>Aticle Type</label>
         <div class="input-group">
            <select name="articleID" required class="form-control" id="articleID" onchange="article_number_at_location(this.value,<?=$locationID?>)">
               <option value="">Select</option>
            </select>
         </div>
      </div>
      <div class="col-lg-4">
         <label>Aticle Number</label>
         <div class="input-group">
            <select name="articleNum" required class="form-control" id="articleNum">
               <option value="">Select</option>
            </select>
         </div>
      </div>
   </div>
   <?php
      }
      else
      {
          ?>
   <script type="text/javascript">
      $("[data-dismiss=modal]").trigger({ type: "click" });
      search_hostel_student();
   </script>
   <?php
      }
      ?>
</div>
<div class="modal-footer">
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
   <?php
      if ($flag==1 && $building_num>0) 
      {
          ?>
   <button type="submit" onclick="assignStudentStock(<?=$locationID?>)" class="btn btn-primary">Save</button>
   <?php
      }
      ?>
</div>
<?php
   }
   elseif($code=='86')
   {   
       ?>
<option value="">Select</option>
<?php
   $locationID=$_POST['locationID'];
   $categoryID=$_POST['categoryID'];
   $sql="SELECT distinct stock_summary.ArticleCode,ArticleName from master_article inner join stock_summary on master_article.ArticleCode=stock_summary.ArticleCode where LocationID='$locationID' and CategoryID='$categoryID' AND ArticleName!='Bed'";
               $res=mysqli_query($conn,$sql);
               while($data=mysqli_fetch_array($res))
               {
                   ?>
<option value="<?=$data['ArticleCode']?>"><?=$data['ArticleName']?></option>
<?php
   }
   
   }
   elseif($code=='87')
   {   
   ?>
<option value="">Select</option>
<?php
   $locationID=$_POST['locationID'];
   $articleID=$_POST['articleID'];
   $sql="SELECT distinct IDNo,Corrent_owner  from  stock_summary where LocationID='$locationID' and ArticleCode='$articleID'";
               $res=mysqli_query($conn,$sql);
               while($data=mysqli_fetch_array($res))
               {
                   $count=0;
                   $count=strlen($data['Corrent_owner']);
                   if ($count<7) 
                   {
                       ?>
<option value="<?=$data['IDNo']?>"><?=$data['IDNo']?></option>
<?php
   }
   }
   
   }
   elseif($code=='88')
   {
   $studentID=$_POST['studentID'];
   $articleNum=$_POST['articleNum'];
   $sql="SELECT * FROM stock_summary  where IDNo='$articleNum'";
   $result = mysqli_query($conn,$sql);
   $date=date('Y-m-d');
   while($data=mysqli_fetch_array($result))
   {
   $currentOwner=$data['Corrent_owner'];
   $currentLocation=$data['LocationID'];
   $deviceSerialNo=$data['DeviceSerialNo'];
   $workingStatus=$data['WorkingStatus'];
   $referenceNo=$data['reference_no'];
   $id=$data['IDNo'];
   $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', 'Returned', '$currentLocation', '$currentOwner', 'Assigned to student', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
   $res=mysqli_query($conn,$qry);
   }
   $datetime   = new DateTime(); //this returns the current date time
   $one=date("His");
   $two= date("myd");
   $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
   $four=substr(str_shuffle($one.$two.$three),1,8);
   $result =$one.$three.$two.$four;
   $updateCurrentOwner = "UPDATE  stock_summary SET Corrent_owner='$studentID' , reference_no='$result' where IDNo='$articleNum'";
   $building_run = mysqli_query($conn, $updateCurrentOwner);
   if ($building_run==true) 
   {
   $sql="SELECT * FROM stock_summary  where IDNo='$articleNum'";
   $result = mysqli_query($conn,$sql);
   $date=date('Y-m-d');
   while($data=mysqli_fetch_array($result))
   {
   $currentOwner=$data['Corrent_owner'];
   $currentLocation=$data['LocationID'];
   $deviceSerialNo=$data['DeviceSerialNo'];
   $workingStatus=$data['WorkingStatus'];
   $referenceNo=$data['reference_no'];
   $id=$data['IDNo'];
   echo  $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', 'Issued', '$currentLocation', '$currentOwner', 'Issued', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
   $res=mysqli_query($conn,$qry);
   }
   }
   }
   elseif($code=='89')
   {
   $studentID=$_POST['studentID'];
   $articleNum=$_POST['id'];
   $sql="SELECT * from master_article inner join stock_summary on master_article.ArticleCode=stock_summary.ArticleCode where Corrent_owner='$studentID'  AND ArticleName!='Bed'";
   $result = mysqli_query($conn,$sql);
   while($data=mysqli_fetch_array($result))
   {
   echo $data['IDNo'];
   }
   
   }
   //----Amrik Sir----//
   elseif($code=='90') 
   {
   $College=$_POST['College'];
   
   
    $sql = "SELECT DISTINCT Course,CourseID FROM MasterCourseCodes WHERE CollegeID='$College' order by Course ASC";
   
   $stmt = sqlsrv_query($conntest,$sql);  
   echo "<option value=''>Course</option>";
          while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
   
   {
   
   echo "<option value='".$row["CourseID"]."'>".$row["Course"]."</option>";
   }
   
   }
   
  elseif($code=='91')
   {       
   ?>
   <optgroup label="Select Floor">
<option value="">Select</option>
<?php
   $hostel=$_POST['hostel'];
   $floor_qry="Select distinct rm.Floor,lm.Floor as floorId from location_master lm inner join room_master rm on rm.RoomNo=lm.RoomNo where BLOCK='$hostel'";
   $res_floor=mysqli_query($conn,$floor_qry);
   while ($floorData=mysqli_fetch_array($res_floor)) 
   {
         ?>
<option value="<?=$floorData['floorId']?>"><?=$floorData['Floor']?></option>
<?php
   }
   ?>
</optgroup>
   <?php
   }
   elseif($code=='92')
   {
   $monthYear=date('M-Y');
   $month=date('m');
   if ($month<10) 
   {
      $dummyMonthTable=str_split($month);
      $month=$dummyMonthTable[1];
   }
   $todaydate=date('d');
   $year=date('Y');
   $studentID=$_POST['studentID'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$studentID' or ClassRollNo='$studentID' or IDNo='$studentID'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
       $IDNo= $row['IDNo'];
       $studentName= $row['StudentName'];
       $classRollNo= $row['ClassRollNo'];
       $uniRollNo= $row['UniRollNo'];
       $fatherName= $row['FatherName'];
       $stuMobNo= $row['StudentMobileNo'];
       $stuCollege= $row['CollegeName'];
       $stuCourse= $row['Course'];
       $stuBatch= $row['Batch'];
   }
   ?>
<div class="modal-header">
   <link href="calendar.css" rel="stylesheet" type="text/css">
   <h5 class="modal-title" id="exampleModalLabel"><b><?=$studentName?></b>'s Attendance (<?=$monthYear?>)</h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body" >
   <div class="row">
      <div class="col-lg-6">
         <label>
         Name: <?=$studentName;?>
         </label>
      </div>
      <div class="col-lg-6">
         <label>
         Father Name: <?=$fatherName;?>
         </label>
      </div>
      <div class="col-lg-6">
         <label>
         Roll No.: <?=$classRollNo?>/<?=$uniRollNo;?>
         </label>
      </div>
      <div class="col-lg-6">
         <label>
         Mobile No.: <?=$stuMobNo;?>
         </label>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <?php
            include 'Calendar.php';
            $calendar = new Calendar(date('Y-m-d'));
            for($d=1; $d<=$todaydate; $d++)
            {
                $time=mktime(12, 0, 0, $month, $d, $year);          
                if (date('m', $time)==$month)
                {
                    $datedummy=date('Y-m-d',$time);
                }   
                $att="select Top (1)* from  DeviceLogs_".$month."_".$year." where (UserId='$uniRollNo' or UserId='$classRollNo' )ANd LogDate between '$datedummy 00:00:00' and '$datedummy 23:59:59' order by DeviceLogId desc ";    
                $list_result = sqlsrv_query($conn91,$att, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                $row_count = sqlsrv_num_rows($list_result);  
                if($row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                {
                    $logdate= $row['LogDate']->format('H:i:s');
                    if($logdate!='')
                    {
                        $punch=$row['LogDate'];
                        $mytime=$punch->format('h:i:s');
                        $mydate=$punch->format('Y-m-d');
                        $calendar->add_event($mytime,$mydate,1,'green');
                    }
                }
                else
                {
                    $leaveQry="SELECT * FROM hostel_student_leaves where student_id='$IDNo' and (start_date='$datedummy' or '$datedummy' BETWEEN start_date AND end_date)";
                    $leaveRes=mysqli_query($conn,$leaveQry);
                    if ($leaveData=mysqli_fetch_array($leaveRes)) 
                    {
                        $calendar->add_event('on leave',$datedummy,1,'orange');
                        
                    }
                    else
                    {
                        $calendar->add_event('Absent',$datedummy,1,'red');
                    }
                }
            }
            //$calendar->add_event('Holiday', '2021-02-16', 7);
            ?>
         <?=$calendar?>
      </div>
   </div>
</div>
<div class="modal-footer">
   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<?php
   }
   elseif($code=='93')
   {
        $startDaily=date('Y-m-d');
       $count1=0;
       $startDate=$_POST['startDate'];
       $endDate=$_POST['endDate'];
       $hostel=$_POST['hostel'];
       $type='1';
   
       $limit_per_page = $_POST['limit'];
       if (isset($_POST['type'])) 
       {
           $type = $_POST['type'];
       }
       $page = "";
       if(isset($_POST["page_no"]))
       {
           $page = $_POST["page_no"];
       }
       else
       {
           $page = 1;
       }
       $offset = ($page - 1) * $limit_per_page;
   
       $sql_total="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$hostel' and hostel_student_summary.status='0' order by location_master.ID asc ";
       $records = mysqli_query($conn,$sql_total);
       $total_record = mysqli_num_rows($records);
      $total_pages = ceil($total_record/$limit_per_page);
       
       ?>
<div class="row">
   <?php
      if (!isset($_POST['input'])) 
      {
      ?>
   <div class="col-lg-2">
      <label>Rows</label>
      <select name="rowsInResult" onchange="studentCalenderAttendance(<?=$page?>,this.value,<?=$type?>)">
         <option value="<?=$limit_per_page?>"><?=$limit_per_page?></option>
         <option value="5">5</option>
         <option value="10">10</option>
         <option value="25">25</option>
         <option value="50">50</option>
         <option value="100">100</option>
      </select>
   </div>
   <div class="col-lg-1">
      <div class="input-group-sm">
         <div class="input-group-sm">
            <?php if ($type==0) 
               {
               ?>
            <input type="button" id="hideShowButton" class="btn btn-outline-info btn-sm form-control" onclick="hideShowTime(<?=$page?>,<?=$limit_per_page?>,this.value)" value='Show Time'>
            <?php
               }
               else
               {
               ?>
            <input type="button" id="hideShowButton" class="btn btn-outline-info btn-sm form-control" onclick="hideShowTime(<?=$page?>,<?=$limit_per_page?>,this.value)" value='Hide Time'>
            <?php
               }
               ?>
         </div>
      </div>
   </div>
   <?php
      }
      else
      {
        $input='All';
        ?>
   <div class="col-lg-2">
      <label>Rows</label>
      <select name="rowsInResult" onchange='dailyAttendance("<?=$startDaily?>","All",<?=$page?>,this.value)'>
         <option value="<?=$limit_per_page?>"><?=$limit_per_page?></option>
         <option value="5">5</option>
         <option value="10">10</option>
         <option value="25">25</option>
         <option value="50">50</option>
         <option value="100">100</option>
      </select>
   </div>
   <?php
      }
      ?>
</div>
<table class="table table-responsive" id="example">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Name</th>
         <th>Uni. Roll No.</th>
         <th>Class Roll No.</th>
         <th>Room No.</th>
         <?php
            $start_date=$startDate;
            
            while (strtotime($start_date) <= strtotime($endDate)) 
            {
                $calendarArray[$count1][]=$start_date;
                ?>
         <th>
            <?php
               if ($type==0) 
               {
                   echo date("d", strtotime($start_date));
               } 
               else
               {
                   echo date("d-M-Y", strtotime($start_date));
               }
               
               ?>
         </th>
         <?php
            $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
            }
            ?>
      </tr>
   </thead>
   <tbody>
      <?php
         $count=$offset;
         $totalDays=count($calendarArray[0]);
         
         $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$hostel' and hostel_student_summary.status='0' order by location_master.ID asc LIMIT {$offset},{$limit_per_page}";
         $res=mysqli_query($conn,$sql);
         
         while($data=mysqli_fetch_array($res))
         {
             $count++;
             ?>
      <tr>
         <?php
            $studentID=$data['student_id'];
            $result1 = "SELECT  * FROM Admissions where UniRollNo='$studentID' or ClassRollNo='$studentID' or IDNo='$studentID'";
            $stmt1 = sqlsrv_query($conntest,$result1);
            while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
            {
                $studentName= $row['StudentName'];
                $studentUniRollNo= $row['UniRollNo'];
                $classRollNo= $row['ClassRollNo'];
                $IDNo= $row['IDNo'];
                ?>
         <td><?=$count?></td>
         <td><?=$studentName?></td>
         <td><?=$studentUniRollNo?></td>
         <td><?=$classRollNo?></td>
         <td><?=$data['RoomNo']?></td>
         <?php
            $uniRollNo= $row['UniRollNo'];
            }
            for ($i=0; $i <$totalDays ; $i++) 
            { 
                $start=$calendarArray[0][$i];
                ?>
         <td>
            <?php
               $att="select Top (1)*  from  DeviceLogsAll where (EmpCode='$uniRollNo' or EmpCode='$classRollNo' or EmpCode='$IDNo' )ANd LogDateTime between '$start 00:00:00'  and '$start 23:59:59'  ";
               $stmt2 = sqlsrv_query($conntest,$att);
               if($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
               {
                   $LogDate= $row1['LogDateTime']->format('h:iA');
                   if ($type==0) 
                   {
                       echo "<b class='btn-success' style='border-radius:50%'> &nbsp&nbspP&nbsp&nbsp </b>";
                   }
                   else
                   {
                       echo $LogDate;
                   }
               }
               else
               {       
                   $leaveQry="SELECT * FROM hostel_student_leaves where student_id='$IDNo' and (start_date='$start' or '$start' BETWEEN start_date AND end_date)";
                   $leaveRes=mysqli_query($conn,$leaveQry);
                   if ($type==0) 
                   {
                       if ($leaveData=mysqli_fetch_array($leaveRes)) 
                       {
                           echo "<b class='btn-primary'  style='border-radius:50%; '> &nbsp&nbspL&nbsp&nbsp </b>";
                       }
                       else
                       {
                           echo "<b class='btn-danger' style='border-radius:50%'> &nbsp&nbspA&nbsp&nbsp </b>";
                       }
                   }
                   else
                   {
                       if ($leaveData=mysqli_fetch_array($leaveRes)) 
                       {
                           echo "<b class='text-warning'>Leave</b>";
                       }
                       else
                       {
                           echo "<b class='text-danger'>Absent</b>";
                       }
                   }
               }
               ?>
         </td>
         <?php
            }
            ?>
      </tr>
      <?php
         }
         ?>
   </tbody>
</table>
<center>
   <?php
      for($i=1; $i <= $total_pages; $i++)
          {
            if($i == $page)
            {
              $class_name = "bg-danger";
            }
            else
            {
              $class_name = "bg-success";
            }
            if (!isset($_POST['input'])) 
            {
                ?>
   <button class='<?=$class_name?> btn btn-xs' id='<?=$i?>' style='min-width: 20px;' onclick='studentCalenderAttendance(<?=$i?>,<?=$limit_per_page?>,<?=$type?>)'><?=$i?></button>
   <?php
      }
      else
      {
        $input='All';
        ?>
   <button class='<?=$class_name?> btn btn-xs' id='<?=$i?>' style='min-width: 20px;' onclick='dailyAttendance("<?=$startDaily?>","All",<?=$i?>,<?=$limit_per_page?>)'><?=$i?></button>
   <?php
      }
      }
      ?>
</center>
<?php
   }
   elseif($code=='94')
   {
       $count1=0;
       $startDate=$_POST['startDate'];
       $endDate=$_POST['endDate'];
       $hostel=$_POST['hostel'];
       ?>
<table class="table table-responsive" id="example">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Name</th>
         <th>Uni. Roll No.</th>
         <th>Class Roll No.</th>
         <th>Room No.</th>
         <?php
            $start_date=$startDate;
            
            while (strtotime($start_date) <= strtotime($endDate)) 
            {
                $calendarArray[$count1][]=$start_date;
                ?>
         <th><?=  date("d-M-Y", strtotime($start_date));?></th>
         <?php
            $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
            }
            ?>
      </tr>
   </thead>
   <tbody>
      <?php
         $count=0;
         $totalDays=count($calendarArray[0]);
         
         $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$hostel' and hostel_student_summary.status='0' order by location_master.ID asc";
         $res=mysqli_query($conn,$sql);
         while($data=mysqli_fetch_array($res))
         {
            
             ?>
      <tr>
         <?php
            $studentID=$data['student_id'];
            $result1 = "SELECT  * FROM Admissions where UniRollNo='$studentID' or ClassRollNo='$studentID' or IDNo='$studentID'";
            $stmt1 = sqlsrv_query($conntest,$result1);
            while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
            {
                $studentName= $row['StudentName'];
                $studentUniRollNo= $row['UniRollNo'];
                $IDNo= $row['IDNo'];
                
                $classRollNo= $row['ClassRollNo'];
                $uniRollNo= $row['UniRollNo'];
            }
            for ($i=0; $i <$totalDays ; $i++) 
            { 
                    $start=$calendarArray[0][$i];
                    ?>
         <?php
            $att="select Top (1)*  from  DeviceLogsAll where (EmpCode='$uniRollNo' or EmpCode='$classRollNo' or EmpCode='$IDNo' )ANd LogDateTime between '$start 00:00:00'  and '$start 23:59:59'  ";
            $stmt2 = sqlsrv_query($conntest,$att);
            if($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
            {
                $LogDate= $row1['LogDateTime']->format('h:iA');
                $LogDate;
            }
            else
            {   $count++;     
                ?>
         <td><?=$count?></td>
         <td><?=$studentName?></td>
         <td><?=$studentUniRollNo?></td>
         <td><?=$classRollNo?></td>
         <td><?=$data['RoomNo']?></td>
         <td>
            <?php
               $leaveQry="SELECT * FROM hostel_student_leaves where student_id='$IDNo' and (start_date='$start' or '$start' BETWEEN start_date AND end_date)";
               $leaveRes=mysqli_query($conn,$leaveQry);
               if ($leaveData=mysqli_fetch_array($leaveRes)) 
               {
                   echo "<b class='text-warning'>Leave</b>";
               }
               else
               {
                   echo "<b class='text-danger'>Absent</b>";
               }
               ?>
         </td>
         <?php
            }
            
            }
            ?>
      </tr>
      <?php
         }
         ?>
   </tbody>
</table>
<?php
   }
   
   elseif($code=='95')
   {   
       $count=0;
        $location_num=0;
       $building=$_POST['building'];
       $floor=$_POST['floor'];
       $room=$_POST['room'];
       if ($building!='' && $floor=='' && $room=='') 
       {
        $sql="SELECT distinct location_master.RoomNo,Name,location_master.ID as location_id, room_master.Floor as FloorName, room_master.RoomNo as RoomName from location_master  inner join room_master  on room_master.RoomNo=location_master.RoomNo inner join building_master  on building_master.ID=location_master.Block  INNER join room_type_master as rtm ON rtm.ID=location_master.Type inner  join stock_summary on stock_summary.LocationID=location_master.ID inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode where ArticleName='Bed' and Block='$building' ";
       }
       elseif ($building!='' && $floor=='' && $room!='') 
       {
           $sql="SELECT distinct location_master.RoomNo,Name,location_master.ID as location_id, room_master.Floor as FloorName, room_master.RoomNo as RoomName from location_master  inner join room_master  on room_master.RoomNo=location_master.RoomNo inner join building_master  on building_master.ID=location_master.Block  INNER join room_type_master as rtm ON rtm.ID=location_master.Type inner  join stock_summary on stock_summary.LocationID=location_master.ID inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode  where ArticleName='Bed' and Block='$building' and location_master.RoomNo='$room'";
       }
       elseif ($building!='' && $floor!='' && $room=='') 
       {
           $sql="SELECT distinct location_master.RoomNo,Name,location_master.ID as location_id, room_master.Floor as FloorName, room_master.RoomNo as RoomName from location_master  inner join room_master  on room_master.RoomNo=location_master.RoomNo inner join building_master  on building_master.ID=location_master.Block  INNER join room_type_master as rtm ON rtm.ID=location_master.Type inner  join stock_summary on stock_summary.LocationID=location_master.ID inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode  where ArticleName='Bed' and Block='$building' and location_master.Floor='$floor'";
       }
       elseif ($building!='' && $floor!='' && $room!='') 
       {
           $sql="SELECT distinct location_master.RoomNo,Name,location_master.ID as location_id, room_master.Floor as FloorName, room_master.RoomNo as RoomName from location_master  inner join room_master  on room_master.RoomNo=location_master.RoomNo inner join building_master  on building_master.ID=location_master.Block  INNER join room_type_master as rtm ON rtm.ID=location_master.Type inner  join stock_summary on stock_summary.LocationID=location_master.ID inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode  where ArticleName='Bed' and Block='$building' and location_master.RoomNo='$room' and location_master.Floor='$floor'";
       }
   
       ?>
<table class="table">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Floor</th>
         <th>Room No.</th>
        <!--  <th>Bed</th> -->
        <!--  <th>Students</th> -->
         <th>Availability</th>
      </tr>
   </thead>
   <tbody>
      <?php 
         $res=mysqli_query($conn,$sql);
         while($data=mysqli_fetch_array($res))
         {
             $location_num=$location_num+1;?>
      <tr>
         <td><?=$location_num;?></td>
         <td><?=$data['FloorName'];?></td>
         <td><?=$data['RoomNo'];?></td>
         <?php
            $locationID='';
            $locationID=$data['location_id'];
            $bedCount=0;
            $studentCount=0;
            $studentClassRollNo='';
            $stockQry="SELECT * from stock_summary inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode where ArticleName='Bed' and LocationID='$locationID' ";
            $stockRes=mysqli_query($conn,$stockQry);
            while($stockData=mysqli_fetch_array($stockRes))
            {
                $bedCount++;
                $currentOwner='';
                $currentOwner=$stockData['Corrent_owner'];
                if ($stockData['Corrent_owner']!='0') 
                {
                $result1 = "SELECT  * FROM Admissions where UniRollNo='$currentOwner' or ClassRollNo='$currentOwner' or IDNo='$currentOwner'";
                $stmt1 = sqlsrv_query($conntest,$result1);
                while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                {
                    $studentCount++;
                    $ClassRollNo='';
                    $ClassRollNo= $row['ClassRollNo'];
                    if ($studentClassRollNo!='') 
                    {
                        $studentClassRollNo.="<br>";
                    }
                    if ($ClassRollNo!='') 
                    {
                        $studentClassRollNo.="<b class='text-info'>".$ClassRollNo."</b>";
                    }
                    else
                    {
                        $studentClassRollNo.=$row['UniRollNo'];
                    }
                }
             }
            
            }
            
            ?>
        <!--  <td>
            <?=$bedCount;?>
         </td> -->
       <!--   <td>
            <?php 
               if ($studentClassRollNo!='') 
               {
                   echo $studentClassRollNo;
               }
               else
               {
                   echo $studentCount;
               }
               ?>
         </td> -->
         <td>
            <?php
               $availability=$bedCount-$studentCount;
               if($availability>0)
               {
                   echo "<b class='text-success'>".$availability."</b>";
               }
               else
               {
                   echo "<b class='text-danger'>".$availability."</b>";
               }
               ?>
         </td>
         <?php
            }
            ?>
   </tbody>
</table>
<?php
   }
   elseif($code==96)
   {
       $hostel=$_POST['building'];
       $session=$_POST['session'];
       ?>
<table class="table">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Room No.</th>
         <th>Class Roll No.</th>
         <th>University Roll No.</th>
         <th>Student Name</th>
         <th>Father Name</th>
         <th>Mobile No.</th>
         <th>Father Mobile No.</th>
         <th>Course</th>
         <th>Semester</th>
      </tr>
   </thead>
   <tbody>
      <?php
         $srno=0;
         $sql="SELECT * from hostel_student_summary inner join location_master on location_master.ID=hostel_student_summary.location_id where session='$session' and Block='$hostel'";
         $res=mysqli_query($conn,$sql);
         while($data=mysqli_fetch_array($res))
         {
             $srno++;
             $RoomNo=$data['RoomNo'];
             $studentID=$data['student_id'];
             $RoomNo=$data['RoomNo'];
             $result1 = "SELECT   FatherMobileNo,StudentMobileNo,StudentName,UniRollNo,FatherName,Course, ClassRollNo, max(SemesterId) as SemesterID FROM StudentRegistrationForm inner join Admissions on StudentRegistrationForm.IDNo=Admissions.IDNo where Admissions.UniRollNo='$studentID' or Admissions.ClassRollNo='$studentID' or Admissions.IDNo='$studentID' group by ClassRollNo ,StudentName,  UniRollNo, FatherName, Course,StudentMobileNo,FatherMobileNo";
             $stmt1 = sqlsrv_query($conntest,$result1);
             while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
             {
         
                 $studentName= $row['StudentName'];
                 $FatherMobileNo= $row['FatherMobileNo'];
                 $StudentMobileNo= $row['StudentMobileNo'];
                 $classRollNo= $row['ClassRollNo'];
                 $uniRollNo= $row['UniRollNo'];
                 $fatherName= $row['FatherName'];
                 $Course= $row['Course'];
                 $Semester= $row['SemesterID'];
         
             }
             ?>
      <tr>
         <td><?=$srno?></td>
         <td><?=$RoomNo?></td>
         <td><?=$classRollNo?></td>
         <td><?=$uniRollNo?></td>
         <td><?=$studentName?></td>
         <td><?=$fatherName?></td>
         <td><?=$StudentMobileNo?></td>
         <td><?=$FatherMobileNo?></td>
         <td><?=$Course?></td>
         <td><?=$Semester?></td>
      </tr>
      <?php
         }
         ?>
   </tbody>
</table>
<?php
   }
   elseif($code=='97')
   {
   $univ_rollno=$_POST['studentRollNo'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno' or IDNo='$univ_rollno'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
   
       $IDNo= $row['IDNo'];
       $ClassRollNo= $row['ClassRollNo'];
       $img= $row['Snap'];
       $UniRollNo= $row['UniRollNo'];
       $name = $row['StudentName'];
       $father_name = $row['FatherName'];
       $course = $row['Course'];
       $email = $row['EmailID'];
       $phone = $row['StudentMobileNo'];
       $batch = $row['Batch'];
       $college = $row['CollegeName'];
   
       $sql="SELECT * from hostel_student_summary inner join location_master on hostel_student_summary.location_id=location_master.ID inner join building_master on building_master.ID=location_master.Block inner join hostel_permissions on hostel_permissions.building_master_id=building_master.ID where student_id='$IDNo' and hostel_student_summary.status='0' and hostel_permissions.emp_id='$EmployeeID'";
       $res=mysqli_query($conn,$sql);
       if($data=mysqli_fetch_array($res))
       {
   
          
       
   ?>
<br>
<table class="table" border="1">
   <tr>
      <td>Name: <?=$name?></td>
      <td>Father Name: <?=$father_name?></td>
      <td rowspan="2"><?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($img).'" height="100%" width="100%" class="img-thumnail"/></center>';?></td>
   </tr>
   <tr>
      <td>Course: <?=$course?></td>
      <td>Batch: <?=$batch?></td>
   </tr>
</table>
<?Php
   }
   
   }   
   
   }
   elseif($code=='98')
   {
   $univ_rollno=$_POST['studentRollNo'];
   $leaveRemark=$_POST['leaveRemark'];
   $endDate=$_POST['endDate'];
   $startDate=$_POST['startDate'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno' or IDNo='$univ_rollno'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
   
     $IDNo= $row['IDNo'];
   }
   $qry="SELECT * FROM hostel_student_leaves where student_id='$IDNo' and '$startDate'  BETWEEN start_date and end_date";
   $run=mysqli_query($conn,$qry);
   if ($data=mysqli_fetch_array($run)) 
   {
     ?>
<label class="text-danger">Leave already applied for <?=$startDate?></label>
<?php
   }
   else
   {
       $sql="INSERT INTO hostel_student_leaves ( student_id, start_date, end_date,  remarks) VALUES ('$IDNo', '$startDate', '$endDate', '$leaveRemark')";
       $res=mysqli_query($conn,$sql);
       if ($res==true) 
       {
           ?>
<label class="text-success">Leave Applied Successfully.</label>
<?php
   }
   }
   
   }
   elseif($code=='99')
   {   
   $billNo=$_POST['billNo'];
   $sql="SELECT distinct BillDate from stock_summary where BillNo='$billNo'";
   $res=mysqli_query($conn,$sql);
   while($data=mysqli_fetch_array($res))
   { 
       ?>
<option value="<?=$data['BillDate']?>"><?=$data['BillDate']?></option>
<?php
   }
   }
   
   
   elseif($code=='100') 
   { 
   $item='';
   $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode WHERE s.Status='1' and ArticleName='Bed' order by IDNo DESC ";
   $building_run=mysqli_query($conn,$building);
   if ($building_row=mysqli_fetch_array($building_run)) 
   {
       $item=$building_row['IDNo'];
       $hostel=$_POST['hostel'];
       $floor=$_POST['floor'];
       $room=$_POST['room'];
       $location="Select * from location_master where  Floor='$floor' and RoomNo='$room' and Block='$hostel'";
       $res_location=mysqli_query($conn,$location);
       while ($locationData=mysqli_fetch_array($res_location)) 
       {
         $LocationID=$locationData['ID'];
         $LocationOwner=$locationData['location_owner'];
       }
       $date=date('Y-m-d');
       $one=date("His");
       $two= date("myd");
       $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
       $four=substr(str_shuffle($one.$two.$three),1,8);
       $result =$one.$three.$two.$four;
       echo $room_type_insert = "UPDATE  stock_summary SET LocationID='$LocationID',Corrent_owner='0',IssueDate='$date' ,Updated_By='$EmployeeID',WorkingStatus='0', Status='2', reference_no='$result' where IDNo='$item'";
       $type_run = mysqli_query($conn, $room_type_insert);
       if ($type_run == true) 
       {
       echo   $description_insert="INSERT INTO stock_description (IDNo,Date_issue,Direction,LocationID,OwerID,Remarks,WorkingStatus,DeviceSerialNo,Updated_By,reference_no) values ('$item','$date','Issued','$LocationID','0','Issued','0','0','$EmployeeID','$result')";
           mysqli_query($conn, $description_insert);
           echo '<div class="alert alert-success">
               <strong>Bed Added Successfully in Room No.: '.$room.' </strong> 
               </div>';
       } 
       else 
       {
           echo "Ohh yaar ";
       }
   }
   else
   {
       echo '<div class="alert alert-danger">
               <strong>Bed not availabe in stock. Contact to Estate Office. </strong> 
               </div>';
   }
   
   }
   
   elseif($code=='101')
   {
   $values = array();
   
   $values1 = array();
   
   foreach($_POST['subjects'] as $key => $SrNo) { 
   $sql="SELECT * from MasterCourseStructure where SrNo='$SrNo' ";
         $stmt2 = sqlsrv_query($conntest,$sql);
    while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
        {
   $SubjectCode = $row1['SubjectCode']; 
   
   foreach($_POST['students'] as $key => $Examid) { 
   $sql1="SELECT * from ExamForm where ID='$Examid' ";
         $stmt3 = sqlsrv_query($conntest,$sql1);
    while($row1 = sqlsrv_fetch_array($stmt3, SQLSRV_FETCH_ASSOC) )
        {
   
           $sql="SELECT * from ExamFormSubject where Examid='$Examid' and SubjectCode='$SubjectCode' ";
          $stmt4 = sqlsrv_query($conntest,$sql, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
          $count=sqlsrv_num_rows($stmt4);
         if ($count>0)
          {
           echo "<br>";
           echo "Already submitted".$SubjectCode;
   
           }
        else
          {
           $sql_in="SELECT * from ExamForm where ID='$Examid' ";
         $stmt_in = sqlsrv_query($conntest,$sql_in);
    while($row_in = sqlsrv_fetch_array($stmt_in, SQLSRV_FETCH_ASSOC) )
        {
   $IDNoi= $row_in['IDNo'];
   $CollegeNamei= $row_in['CollegeName'];
   $Coursei= $row_in['Course'];
   $Examinationi= $row_in['Examination'];
   $Batchi= $row_in['Batch'];
   $Semesteridi= $row_in['Semesterid'];
   $Semesteri=$row_in['Semester'];
     $Typei=$row_in['Type'];
   $FormDatei=$row_in['SubmitFormDate']->Format('Y-m-d H:i:s.v');
   }
   $sql_in1="SELECT * from MasterCourseStructure where SrNo='$SrNo' ";
         $stmt2 = sqlsrv_query($conntest,$sql_in1);
    while($rowin1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
        {
   $SubjectCodei = $rowin1['SubjectCode']; 
   
    $SubjectNamei = $rowin1['SubjectName'];
   
    $SubjectTypei = $rowin1['SubjectType']; 
   
   }
   
   
   echo $insersub= "Insert into ExamFormSubject(IDNo,Examid,CollegeName,Course,Batch,SemesterID,Semester,Examination,SubjectName,SubjectCode,SubjectType,Status,InternalExam,ExternalExam,Type,SubmitFormDate)Values('$IDNoi','$Examid','$CollegeNamei','$Coursei','$Batchi','$Semesteridi','$Semesteri','$Examinationi','$SubjectNamei','$SubjectCodei','$SubjectTypei','0','Y','Y','$Typei','$FormDatei')";
     $stmtinsert = sqlsrv_query($conntest,$insersub);     
   if($stmtinsert === false) {
   
   die( print_r( sqlsrv_errors(), true) );
   }
           }
   
   
   } 
   }
   
   
   } 
   
   }
   
   
   }
   
   elseif($code=='102')
   {   
   $oldReading=0;
   $bill=0;
   $currentReading=$_POST['currentReading'];
   $unitsConsumed=$_POST['unitsConsumed'];
   $articleID=$_POST['articleID'];
   $locationID=$_POST['locationID'];
   $date=$_POST['date'];
   // $unitRate=$_POST['unitRate'];
   $qry="SELECT electricity_bill_charges.unit_rate from  location_master  INNER JOIN electricity_bill_charges ON electricity_bill_charges.ID=location_master.electric_charges_id where location_master.ID='$locationID'";
   $run=mysqli_query($conn,$qry);
   while($data1=mysqli_fetch_array($run))
   {
       $unitRate=$data1['unit_rate'];
   
   }
   $currentOwner=$_POST['currentOwner'];
   $bill=$unitsConsumed*$unitRate;
   
   $oldReadingQry="SELECT unit,reading_date, current_reading FROM meter_reading where article_no='$articleID' order by current_reading desc" ;
   $oldReadingRes=mysqli_query($conn,$oldReadingQry);
   if ($oldReadingData=mysqli_fetch_array($oldReadingRes)) 
   {
       $oldReading=$oldReadingData['current_reading'];
   }
   if ($currentReading<$oldReading) 
   {
       echo "error";
   }
   else
   {   
       $ins="INSERT INTO meter_reading (article_no, location_id, current_owner, reading_date, current_reading, unit,unit_rate,amount) VALUES ('$articleID','$locationID','$currentOwner','$date','$currentReading','$unitsConsumed','$unitRate','$bill')";
       mysqli_query($conn,$ins);
       
   }
   
   }
   
   elseif($code=='103')
   {
   echo $building=$_POST['building'];
    ?>
<option value="">Select Floor</option>
<?php
   $floor_qry="SELECT Distinct Floor from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building'";
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
         ?>
<option value="<?=$floorValue?>"><?=$floorName?></option>
<?php
   }
   
   }
   elseif($code=='104')
   {
   $building=$_POST['building'];
   $floor=$_POST['floor'];
   ?>
<option value="">Select Room No.</option>
<?php
   if ($floor!='') 
   {
       $room_qry="SELECT Distinct RoomNo from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building' and Floor='$floor'";
   }
   else
   {
       $room_qry="SELECT Distinct RoomNo from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building'";
   }
   $res_room=mysqli_query($conn,$room_qry);
   while ($roomData=mysqli_fetch_array($res_room)) 
   {
      $roomValue=$roomData['RoomNo'];
      ?>
<option value="<?=$roomValue?>"><?=$roomValue?></option>
<?php
   } 
   
   }
   elseif($code=='105')
   {   
   $count=0;
   $totalBill=0;
   $building=$_POST['building'];
   $floor=$_POST['floor'];
   $room=$_POST['room'];
   
   ?>
<div class="row">
   <div class="col-lg-1">
      <div class="input-group-sm">
         <button type="submit" class="btn btn-outline-danger btn-sm form-control"  onclick="exportMeterLocations(<?=$building?>)">Export</button>
      </div>
   </div>
</div>
<?php
   if ($building!='' && $floor=='' && $room=='') 
   {
      $sql="SELECT distinct article_no from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building' order by location_master.RoomNo asc ";
   }
   elseif ($building!='' && $floor=='' && $room!='') 
   {
       $sql="SELECT distinct article_no from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building'  and RoomNo='$room' order by location_master.RoomNo asc ";
   }
   elseif ($building!='' && $floor!='' && $room=='') 
   {
       $sql="SELECT distinct article_no from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building'  and Floor='$floor' order by location_master.RoomNo asc ";
   }
   elseif ($building!='' && $floor!='' && $room!='') 
   {
       $sql="SELECT distinct article_no from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building'  and RoomNo='$room' and Floor='$floor' order by location_master.RoomNo asc ";
   }
   
   $meterLocationsData='';
   $meterLocationsData.="<table class='table table-striped table-responsive'>
       <thead>
           <tr>
               <th>Sr. No.</th>
               <th>Meter No.</th>
               <th>Room No.</th>
               <th>Date</th>
               <th>Owner</th>
               <th>Reading</th>
               <th>Units Consumed</th>
               <th>Rate per Unit</th>
               <th>Bill amount</th>
               <th>Action</th>
               <th>Bill</th>
               
           </tr>
       </thead>";
       
   $res=mysqli_query($conn,$sql);
   while($data=mysqli_fetch_array($res))
   {
       $ownerTable='';
       
       $count++;
       $article_num=$data['article_no'];
       $readingQry="SELECT *, meter_reading.ID as mrID from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where article_no='$article_num' ORDER by meter_reading.ID desc";
       $readingRes=mysqli_query($conn,$readingQry);
       if ($data1=mysqli_fetch_array($readingRes)) 
       {
           $room_no=$data1['RoomNo'];
           $date=date("d-M-Y", strtotime($data1['reading_date']));
           $reading=$data1['current_reading'];
           $unitsConsumed=$data1['unit'];
           $unitRate=$data1['unit_rate'];
           $billAmount=$data1['amount'];
           $totalBill=$totalBill+$billAmount;
           $id=$data1['mrID'];
   
           $meterLocation=$data1['location_id'];
           $flag=0;
           $sr=0;
           $locationQry="SELECT distinct Corrent_owner from stock_summary where LocationID='$meterLocation' ORDER by Corrent_owner desc";
           $locationRes=mysqli_query($conn,$locationQry);
           while($locationData=mysqli_fetch_array($locationRes))
           {
             $sr++;
             $user='';
             $user=$locationData['Corrent_owner'];
             if (strlen($user)>7) 
             {
               $flag=1;
               $result1 = "SELECT  * FROM Admissions where UniRollNo='$user' or ClassRollNo='$user' or IDNo='$user'";
               $stmt1 = sqlsrv_query($conntest,$result1);
               while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
               {
           
                 $IDNo= $row['IDNo'];
                 $ClassRollNo= $row['ClassRollNo'];
                 $UniRollNo= $row['UniRollNo'];
                 $StudentName = $row['StudentName'];
                 $father_name = $row['FatherName'];
                 $course = $row['Course'];
                 $email = $row['EmailID'];
                 $phone = $row['StudentMobileNo'];
                 $batch = $row['Batch'];
                 $college = $row['CollegeName'];
                 $courseShortName = $row['CourseShortName'];
   
                 $ownerTable.="<tr><td>{$StudentName}</td><td>{$ClassRollNo}/{$UniRollNo}</td></tr>";
   
               }
             }
             else
             {
               if ($flag==0) 
               {
                 $sql1 = "SELECT * FROM Staff Where IDNo='$user'";
                 $q1 = sqlsrv_query($conntest, $sql1);
                 while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
                 {
                   $userName = $row['Name'];
                   $fatherName = $row['FatherName'];
                   $CollegeName = $row['CollegeName'];
                   $Designation = $row['Designation'];
                   $EmailID = $row['EmailID'];
                   $ContactNo = $row['ContactNo'];
                   if ($ContactNo=='') 
                   {
                     $ContactNo = $row['MobileNo'];
                   }
                   $ownerTable.="<tr><td>{$userName}</td><td>{$user}</td></tr>";
                   
                 }
               }
             }
           }
   
   
   
   
       }
      
           $meterLocationsData.="<tr>
               <td >{$count}</td>
               <td>{$article_num}</td>
               <td>{$room_no}</td>
               <td>{$date}</td>
               <td>
               <table >
               {$ownerTable}
               </table>
   
   
               </td>
               <td>{$reading}</td>
               <td>{$unitsConsumed}</td>
               <td>{$unitRate}</td>
               <td>{$billAmount}</td>
               <td><button class='btn btn-xs' type='submit' style='color:red;' onclick='meterReadings({$article_num})' data-toggle='modal'  data-target='#meter_reading_modal'><i class='fa fa-eye fa-lg'></i></button></td>
               <td>
                   <form action='electricity-bill.php' method='post'>
                       <input type='hidden' name='meterReadingId' value='{$id}'>
                       <button type='submit' class='btn border-0 shadow-none' style='background-color:transparent; border:display none' formtarget='_blank' name='abcs' id='abc'>
                           <i  class='fa fa-print' aria-hidden='true'></i>
                       </button>
                   </form>
               </td>
               
           </tr>";
       
   }
   
   $meterLocationsData.="<tr>
               <th colspan='8'>Total Amount</th>                                
               <th>{$totalBill}</th>                                
               <th></th>                                
               <th></th>                                
           </tr></table>";
   echo $meterLocationsData;
   }
   elseif($code=='106')
   {   
   $count=0;
   $articleID=$_POST['meterNo'];
   ?>
<div class="row">
   <div class="col-lg-1">
      <div class="input-group-sm">
         <button type="submit" class="btn btn-outline-danger btn-sm form-control"  onclick="exportData(<?=$articleID?>)">Export</button>
      </div>
   </div>
</div>
<?php
   $sql="SELECT *, meter_reading.ID as mrID from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where article_no='$articleID' ORDER by meter_reading.ID desc";
       
   $exportMeter="<table class='table table-striped table-responsive'>
       <thead>
           <tr>
               <th>Sr. No.</th>
               <th>Meter No.</th>
               <th>Room No.</th>
               <th>Date</th>
               <th>Reading</th>
               <th>Units Consumed</th>
               <th>Rate per Unit</th>
               <th>Bill amount</th>
               <th>Bill</th>
               
           </tr>
       </thead>";
      
   $res=mysqli_query($conn,$sql);
   while($data=mysqli_fetch_array($res))
   {
       
       $count++;
       $article_num=$data['article_no'];
       
           $room_no=$data['RoomNo'];
           $date=date("d-M-Y", strtotime($data['reading_date']));
           $reading=$data['current_reading'];
           $unitsConsumed=$data['unit'];
           $id=$data['mrID'];
            $unitRate=$data['unit_rate'];
           $billAmount=$data['amount'];
       
      
           $exportMeter.="<tr>
               <td>{$count}</td>
               <td>{$article_num}</td>
               <td>{$room_no}</td>
               <td>{$date}</td>
               <td>";
           
               if ($count==1) 
               {
                   
                   $exportMeter.=$reading." <i class='fa fa-pen text-danger' data-toggle='modal'  data-target='#update_meter_reading_modal' onclick='updateMeterReading({$id},{$article_num})'></i>";
               }
               else
               {
                  $exportMeter.=$reading;
               }
               
               $exportMeter.="</td>
               <td>{$unitsConsumed}</td>
               <td>{$unitRate}</td>
               <td>{$billAmount}</td>
               <td>
                   <form action='electricity-bill.php' method='post'>
                       <input type='hidden' name='meterReadingId' value='{$id}'>
                       <button type='submit' class='btn border-0 shadow-none' style='background-color:transparent; border:display none' formtarget='_blank' >
                           <i  class='fa fa-print' aria-hidden='true'></i>
                       </button>
                   </form>
               </td>
               
           </tr>";
   
   }
   
   $exportMeter.="</table>";
   echo $exportMeter;
   
   }
   elseif($code=='107')
   {
   $id=$_POST['id'];
   $articleNum=$_POST['articleNum'];
   $updateReading=$_POST['reading'];
   // $unitRate=$_POST['unitRate'];
   $qry="SELECT electricity_bill_charges.unit_rate from meter_reading INNER JOIN location_master ON location_master.ID=meter_reading.location_id INNER JOIN electricity_bill_charges ON electricity_bill_charges.ID=location_master.electric_charges_id where meter_reading.ID='$id'";
   $run=mysqli_query($conn,$qry);
   while($data1=mysqli_fetch_array($run))
   {
       $unitRate=$data1['unit_rate'];
   
   }
   $previousReading=0;
   $oldRes=mysqli_query($conn,"SELECT * from meter_reading where article_no='$articleNum' ORDER BY ID desc LIMIT 1,1 ");
   if ($data=mysqli_fetch_array($oldRes)) 
   {
       $previousReading=$data['current_reading'];
   }
    $previousReading;
   if ($updateReading>$previousReading) 
   {
      $unitsConsumed=$updateReading-$previousReading;
      $bill=$unitsConsumed*$unitRate;
   mysqli_query($conn,"UPDATE meter_reading SET current_reading='$updateReading', unit='$unitsConsumed',unit_rate='$unitRate',amount='$bill' WHERE ID='$id'");
   }
   
   
   }
   elseif($code=='108')
   {
   $id=$_POST['id'];
   $articleNum=$_POST['articleNum'];
   $oldRes=mysqli_query($conn,"SELECT * from meter_reading where article_no='$articleNum' ORDER BY ID desc  ");
   if ($data=mysqli_fetch_array($oldRes)) 
   {
       $previousReading=$data['current_reading'];
       $unitRate=$data['unit_rate'];
   }
   ?>
<div class="row">
   <div class="col-lg-4">
      <label>Meter No. :</label>
      <input type="text" readonly disabled value="<?=$articleNum?>" class="form-control">
   </div>
   <div class="col-lg-4">
      <label>Reading :</label>
      <input type="number" id='reading' value="<?=$previousReading?>" class="form-control">
   </div>
   <!-- <div class="col-lg-4">
      <label>Unit Rate :</label>
      <select id="unitRate" class="form-control">
           <option value="<?=$unitRate?>">&#8377; <?=$unitRate?></option>
           <option value="10"> &#8377; 10</option>
           <option value="12.25">&#8377; 12.25</option>
        </select> 
      </div> -->
   <div class="col-lg-4">
      <label>&nbsp;</label>
      <button class="btn btn-xs btn-outline-info form-control" onclick="updateReading(<?=$id?>,<?=$articleNum?>)">Save</button>
   </div>
</div>
<?php
   }
   
   //*****************************permission syatem********************
   
    elseif ($code==109) //105
       {
       
         $role = $_POST['role'];
      
       $role_insert = "INSERT into role_name (role_name)values ('$role')";
       $role_run = mysqli_query($conn, $role_insert);
       if ($role_run == true) {?>
<script > window.location.href = 'role.php'; </script> <?php 
   } else {
       echo "Ohh yaar ";
   }
   
   }
   elseif($code==110) //104
   {
     
    $role_id=$_POST['role_id'];
    $per=$_POST['per'];
     $in_per="DELETE from role where role_id='$role_id'";
     mysqli_query($conn,$in_per);
    foreach($per as $key => $val)
    {
        $I=0;
          $U=0;
          $D=0;
     $per1=$_POST[$val];
     for ($i=0; $i<=2; $i++) { 
         //echo $val."-".$per1[$i];
         echo  "<br>";
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
         else
         {
   
         }
     }    
     }
       $in_per="INSERT into role(role_id,page_id,I,U,D) values('$role_id','$val','$I','$U','$D')";
      mysqli_query($conn,$in_per);
   }
   echo "<script>window.close();</script>";
   }
   elseif($code==111) 
   {
   
   $emp_id=$_POST['emp_id'];
   $del="UPDATE user SET role_id='0' WHERE emp_id='$emp_id'";
   mysqli_query($conn,"DELETE from special_permission where emp_id='$emp_id'");
   $del_run=mysqli_query($conn,$del);
   if ($del_run) {?>
<div  class="alert alert-success alert-xs" id="alert">Successfully Delete</div>
<?php }
   else
   {
       echo "error";
   }
   }
   elseif($code==112) 
   {
   $role_id=$_POST['role_new'];
   $emp_id=$_POST['emp_id'];
   $check_role="SELECT * FROM user WHERE emp_id='$emp_id' and role_id='0'";
   $role_check_run=mysqli_query($conn,$check_role);
   if (mysqli_num_rows($role_check_run)>0)
    {
   $insert="UPDATE user SET role_id='$role_id' WHERE emp_id='$emp_id'";
   $insert_run=mysqli_query($conn,$insert);
   if ($insert_run)
    {
   ?>    
<div  class="alert alert-success alert-xs" id="alert">Successfully Assigned</div>
<?php 
   }
   else
   {
     ?>    
<div  class="alert alert-danger" id="alert">Error</div>
<?php 
   }
   }
   else
   {
    ?>    
<div  class="alert alert-danger" id="alert">Already Assigned</div>
<?php 
   }
   
   }
   
   //**********************end Permission sytem ***************************
   elseif ($code==113) //105
    {
      $menu_name = $_POST['menu_name'];
    $master_menu_insert="INSERT into master_menu (menu_name)values ('$menu_name')";
    $master_menu_run = mysqli_query($conn, $master_menu_insert);
    if ($master_menu_run == true) {?>
<script > window.location.href = 'master-menu.php'; </script> <?php 
   } 
   else
    {
       echo "Ohh yaar ";
   }
   
   }
   
   
   elseif($code=='114')
   {   
    $count=0;
    $building=$_POST['building'];
    $floor=$_POST['floor'];
    $room=$_POST['room'];
     ?>
<div class="row">
   <div class="col-lg-1">
      <div class="input-group-sm">
         <button type="submit" class="btn btn-outline-danger btn-sm form-control"  onclick="exportAllHostel(<?=$building?>)">Export</button>
      </div>
   </div>
</div>
<?php
   if ($building!='' && $floor=='' && $room=='') 
   {
      $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode where Block='$building'";
   }
   elseif ($building!='' && $floor=='' && $room!='') 
   {
       $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode where Block='$building' and RoomNo='$room'";
   }
   elseif ($building!='' && $floor!='' && $room=='') 
   {
       $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode where Block='$building' and Floor='$floor'";
   }
   elseif ($building!='' && $floor!='' && $room!='') 
   {
       $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode where Block='$building' and RoomNo='$room' and Floor='$floor'";
   }
   // $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode where Block='$building' ";
   
   ?>
<table class="table">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Name</th>
         <th>Class/Uni Roll No.</th>
         <th>Father Name</th>
         <th>Contact No.</th>
         <th>Course</th>
         <th>Room No.</th>
         <!-- <th>Bed No.</th> -->
         <th>Image</th>
      </tr>
   </thead>
   <?php
      $res=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($res))
      {
          $img='dummy-user.png';
          $flag=0;
          $userID='';
          $userName='';
          $college='';
          $phone='';
          $father_name='';
          
          $user=$data['Corrent_owner'];
          // $user=$locationData['Corrent_owner'];
      if (strlen($user)>7) 
      {
      $flag=1;
      $result1 = "SELECT  * FROM Admissions where UniRollNo='$user' or ClassRollNo='$user' or IDNo='$user'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
        $IDNo= $row['IDNo'];
        $ClassRollNo= $row['ClassRollNo'];
        $UniRollNo= $row['UniRollNo'];
        $userName=$StudentName = $row['StudentName'];
        $father_name = $row['FatherName'];
        $course = $row['Course'];
        $email = $row['EmailID'];
        $phone = $row['StudentMobileNo'];
        $batch = $row['Batch'];
        $college = $row['CollegeName'];
        $courseShortName = $row['CourseShortName'];
      $img= 'data:image/jpeg;base64,'.base64_encode($row['Snap']);
        $userID=$ClassRollNo.'/'.$UniRollNo;
        
      }
      }
      elseif (strlen($user)<3) 
      {
      $flag=1;
      $sql1 = "SELECT * FROM outside_owners Where id='$user'";
        $q1 = mysqli_query($conn, $sql1);
        while ($row = mysqli_fetch_array($q1)) 
        {
          $userName = $row['name'];
          // $userID = $row['id'];
          
          $Designation = $row['designation'];
          
        }
      }
      else
      {
      if ($flag==0) 
      {
        $sql1 = "SELECT * FROM Staff Where IDNo='$user'";
        $q1 = sqlsrv_query($conntest, $sql1);
        while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
        {
          $userID=$row['IDNo'];
          $userName = $row['Name'];
          $father_name = $row['FatherName'];
          $college = $row['CollegeName'];
          $Designation = $row['Designation'];
          $EmailID = $row['EmailID'];
          $img= 'data:image/jpeg;base64,'.base64_encode($row['Snap']);
          $phone = $row['ContactNo'];
          if ($phone=='') 
          {
            $phone = $row['MobileNo'];
          }
        }
      }
      }
      
         
          
          if ($userID != '') 
          {
              if ( $data['ArticleName']!='Meter') 
              {
                  // code...
              
            $count++;
          
          ?>
   <tr>
      <td><?=$count?> </td>
      <td><?=$userName?></td>
      <td><?= $userID;?></td>
      <td><?=$father_name?></td>
      <td><?=$phone?></td>
      <td><?=$college?></td>
      <td><?=$data['RoomNo']?></td>
      <!-- <td><?=$data['IDNo']?> (<?=$data['ArticleName']?>)</td> -->
      <td>
         <center><img src="<?=$img?>" height="50" width="50" class="img-thumnail"  style="border-radius:50%"/></center>
      </td>
   </tr>
   <?php
      }
      }
      }
      ?>
</table>
<?php
   }
   
   
   
   elseif($code=='115')
   {
       $count=0;
       $building=$_POST['building'];
       $floor=$_POST['floor'];
       $room=$_POST['room'];
      $location_num=0;
                           
        if ($building=='' && $floor=='' && $room=='') 
       {

         $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID ";

         
       }
       elseif ($building=='' && $floor=='' && $room!='') 
       {
          $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where  l.RoomNo='$room'";
       }
       elseif ($building=='' && $floor!='' && $room=='') 
       {
        $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.IDpe  where l.Floor='$floor'";
       }
       elseif ($building=='' && $floor!='' && $room!='') 
       {
          $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where l.Floor='$floor' and l.RoomNo='$room'";
       }
       elseif ($building!='' && $floor=='' && $room=='') 
       {
        $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where Block='$building'";
       }
       elseif ($building!='' && $floor=='' && $room!='') 
       {
        $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where Block='$building' and l.RoomNo='$room'";
       }
       elseif ($building!='' && $floor!='' && $room=='') 
       {
          $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID  where Block='$building'  and l.Floor='$floor'";
       }
       elseif ($building!='' && $floor!='' && $room!='') 
       {
           $location=" SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomNoo from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type  inner join room_name_master  rnm on l.RoomName=rnm.ID where Block='$building' and l.RoomNo='$room' and l.Floor='$floor'";   
       }
                         
   
                           $location_run=mysqli_query($conn,$location);
                           ?>
<table class="table table-head-fixed text-nowrap table-bordered" id="example">
   <thead>
      <tr>
         <th>ID</th>
         <th>Block</th>
         <th>Floor</th>
         <th>Room Type/No</th>
         <th>Owner Name</th>
         <th>Action</th>
         <th>Action</th>
         <th>Action</th>
         <th>Action</th>
      </tr>
   </thead>
   <tbody  >
      <?php
         while ($location_row=mysqli_fetch_array($location_run)) 
         {
         $location_num=$location_num+1;?>
      <tr>
         <td><?=$location_num;?></td>
         <td><?=$location_row['Name'];?>(<?=$location_row['l_id'];?>)</td>
         <td><?=$location_row['FloorName'];?></td>
         <td><?=$location_row['RoomType'];?>-<?=$location_row['RoomNo'];?> <b>(<?=$location_row['RoomName'];?>)</b></td>
         <td><?php 
            echo  "Emp ID:".$empID=$location_row['location_owner'];
            echo "<br>";
              $staff="SELECT Name FROM Staff Where IDNo='$empID'";
            $stmt = sqlsrv_query($conntest,$staff);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
            echo "<b>".$Emp_Name=$row_staff['Name']."</b>";
            }
            
             ?>                 
         </td>
         <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_view" onclick="view_location(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
         <td><i class="fa fa-eye fa-lg" data-toggle="modal" data-target="#view_serial_no_Modal" onclick="view_serials(<?=$location_row['l_id'];?>);" style="color:green;"></i></td>
         <?php 
            if ($empID!='')
             {
                ?>
         <td><input type="submit" class="btn btn-success btn-xs" name="" value="Assign" data-toggle="modal" data-target="#exampleModal_bulk" onclick="bulk_assign_location(<?=$location_row['l_id'];?>);">
            <input type="submit" class="btn btn-success btn-xs" name="" value="Assign"  onclick="page_open(<?=$location_row['l_id'];?>);">
         </td>
         <?php
            }
            else {
               ?> 
         <td><input type="submit" class="btn btn-danger btn-xs" name="" value="Update">
         </td>
         <?php
            }
                                    ?>
         <td>
            <form action="stock_report.php" method="post" target="_blank">
               <input type="hidden" name="ID" value="<?=$location_row['l_id'];?>">
               <button class="fa fa-print fa-lg" type="submit" style="color: green; border: none; background: none;"></button>
            </form>
         </td>
      </tr>
      <?php 
         }
         ?>
   </tbody>
</table>
<?php
   }
   
   elseif($code==116)
   {
       $search = $_POST['search'];
       $query = "SELECT Distinct SubjectCode from UserAccessLevel inner join MasterCourseStructure on MasterCourseStructure.CourseID=UserAccessLevel.CourseID where IDNo='$EmployeeID' and SubjectCode like '%".$search."%'";
       $result = sqlsrv_query($conntest,$query);
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
           $response[] = array("value"=>$row['SubjectCode'],"label"=>$row['SubjectCode']);
       }
       echo json_encode($response);
       exit;
   
   }
   
   elseif($code==117)
   {
      $subject_code = $_POST['subject_code'];
      $sql = "SELECT Distinct MasterCourseStructure.Course,MasterCourseStructure.CourseID from UserAccessLevel inner join MasterCourseStructure on MasterCourseStructure.CourseID=UserAccessLevel.CourseID where IDNo='$EmployeeID' and SubjectCode ='$subject_code' AND Isverified='1'  ORDER BY Course ";
     // echo $sql = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE SubjectCode ='$subject_code' AND Isverified='1'  ORDER BY Course ";
       $result = sqlsrv_query($conntest,$sql);
       echo "<option value=''>Select Course</option>";
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
           echo "<option value='".$row["CourseID"]."'>".$row["Course"]."</option>"; 
       }
   }
   elseif($code==118)
   {
       $subject_code = $_POST['subCode'];
       $course = $_POST['course'];
      $sql = "SELECT DISTINCT SubjectName from MasterCourseStructure WHERE SubjectCode ='$subject_code' AND Isverified='1' and CourseID='$course' ";
       $result = sqlsrv_query($conntest,$sql);
       // echo "<option value=''>Select Course</option>";
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
           echo "<option value='".$row["SubjectName"]."'>".$row["SubjectName"]."</option>"; 
       }
   }
   elseif($code==119)
   {
    $subCode=$_POST['subCode'];
      $courseId=$_POST['courseId'];
      $batch=$_POST['batch'];
      $sem=$_POST['sem'];
      $unit=$_POST['unit'];
      // $question=$_POST['question'];
      $question=str_replace("'", '',$_POST['question']);
      
      $type=$_POST['type'];
      $category=$_POST['category'];

      $getCollegeID="SELECT CollegeID FROM MasterCourseStructure WHERE CourseID='$courseId'";
      $runCollegeID=sqlsrv_query($conntest,$getCollegeID);
      if ($row=sqlsrv_fetch_array($runCollegeID,SQLSRV_FETCH_ASSOC))
       {
      $CollegeID=$row['CollegeID'];    // code...
      }
       $number=$unit.$type.$category;
      
      $question_count=0;
      $count=0;
          $showQuestionQry="SELECT count(*) as qc FROM question_bank WHERE Type='$type' and Category='$category' and Batch='$batch' and CourseID='$courseId'  and SubjectCode='$subCode'  and Unit='$unit' and Semester='$sem'";
                        $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                        if($showQuestionData=mysqli_fetch_array($showQuestionRun))
                        {
                        $count=$showQuestionData['qc']; 
                         
                        }
                       
                        $sh="SELECT * FROM question_count WHERE number='$number' ORDER BY Id desc ;";
                        $s=mysqli_query($conn,$sh);
                        if($sho=mysqli_fetch_array($s))
                        { 
                        $question_count=$sho['question_count'];      
                        }
                        if ($count<$question_count && $EmployeeID>0 )
                         {
                        $insQry="CALL insert_question_bank('$subCode','$CollegeID','$type','$unit','$batch','$sem','$courseId','$category','$question','$EmployeeID','$current_session')";
                              $insQryRun=mysqli_query($conn,$insQry);
                              echo "1"; 
                         }
                        else
                         {   
                           echo "0";  
                         }
                      
   
   }
   elseif($code==120)
   {
      $subCode=$_POST['subCode'];
      $courseId=$_POST['courseId'];
      $batch=$_POST['batch'];
      $sem=$_POST['sem'];
      $unit=$_POST['unit'];
      $question=$_POST['question'];
      $type=$_POST['type'];
      $category=$_POST['category'];
      $getCollegeID="SELECT CollegeID FROM MasterCourseStructure WHERE CourseID='$courseId'";
      $runCollegeID=sqlsrv_query($conntest,$getCollegeID);
      if ($row=sqlsrv_fetch_array($runCollegeID,SQLSRV_FETCH_ASSOC))
       {
       $CollegeID=$row['CollegeID'];    // code...
      }
      $number=$unit.$type.$category;
      $count=0;
      $showQuestionQry="SELECT * FROM question_bank WHERE Type='$type' and Category='$category' and Batch='$batch' and CourseID='$courseId'  and SubjectCode='$subCode' and CollegeID='$CollegeID' and Unit='$unit' and Semester='$sem' ORDER BY Id desc ;";
                        $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                        while($showQuestionData=mysqli_fetch_array($showQuestionRun))
                        { 
                        $count++;      
                        }
                        $count;
                        $sh="SELECT * FROM question_count WHERE number='$number' ORDER BY Id desc ;";
                        $s=mysqli_query($conn,$sh);
                        while($sho=mysqli_fetch_array($s))
                        { 
                       $question_count=$sho['question_count'];      
                        }
                        if ($count>=$question_count) {
                            echo "0";
                        }
                        else
                        {
                           echo "1";
                        }
   
   }
   elseif($code==121)
   {
      $subCode=$_POST['subCode'];
      $courseId=$_POST['courseId'];
      $batch=$_POST['batch'];
      $sem=$_POST['sem'];
      $unit=$_POST['unit'];
      $question=$_POST['question'];
      $type=$_POST['type'];
      $category=$_POST['category'];
      $getCollegeID="SELECT CollegeID FROM MasterCourseStructure WHERE CourseID='$courseId'";
      $runCollegeID=sqlsrv_query($conntest,$getCollegeID);
      if ($row=sqlsrv_fetch_array($runCollegeID,SQLSRV_FETCH_ASSOC))
       {
       $CollegeID=$row['CollegeID'];    // code...
      }
      $number=$unit.$type.$category;
      $count=0;
      $showQuestionQry="SELECT * FROM question_bank WHERE Type='$type' and Category='$category' and Batch='$batch' and CourseID='$courseId'  and SubjectCode='$subCode' and CollegeID='$CollegeID' and Unit='$unit' and Semester='$sem' ORDER BY Id desc ;";
                        $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                        while($showQuestionData=mysqli_fetch_array($showQuestionRun))
                        { 
                        $count++;      
                        }
                         ?> <span class="badge badge-warning" style="float:right;"><b id="upload_count"><?php echo "Uploaded ".$count; ?></b></span><?php 
   $sh="SELECT * FROM question_count WHERE number='$number' ORDER BY Id desc ;";
   $s=mysqli_query($conn,$sh);
   while($sho=mysqli_fetch_array($s))
   { ?>
<span class="badge badge-success" style="float:right;"><b id="upload_count"><?php  echo"Total : ".$sho['question_count'];?></b></span>
<?php
   }
   
   
   }
   elseif($code==122)
   {
   $unit=$_POST['unit'];
   $type=$_POST['type'];
   $number=$unit.$type;
   ?>
<option value="">Select</option>
<?php 
   $cehck_category="SELECT * FROM question_count where number like'$number%'";
   $cehck_category_run=mysqli_query($conn,$cehck_category);
   while($r=mysqli_fetch_array($cehck_category_run))
   {
   $IDNo=$r['number']%10;
   
   
   
                         $questionCategoryQry="SELECT id,category_name FROM question_category where id='$IDNo'";
                         $questionCategoryRes=mysqli_query($conn,$questionCategoryQry);
                         while($questionCategoryData=mysqli_fetch_array($questionCategoryRes))
                         {
                            ?>
<option value="<?=$questionCategoryData['id']?>"><?=$questionCategoryData['category_name']?></option>
<?php
   }
   }
   
   }
   elseif ($code==123) 
{
    $courseId=$_POST['course'];
    ?>
    <option value="">Select Semester</option>
    <?php
    $sqlSubject = "SELECT DISTINCT SemesterID from MasterCourseStructure WHERE CourseID ='$courseId' AND Isverified='1' ";
    $resultSubject = sqlsrv_query($conntest,$sqlSubject);
    while($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
    {
        ?>
        <option value="<?=$rowSubject["SemesterID"]?>"><?=$rowSubject["SemesterID"]?></option>; 
        <?php
    }
}
elseif ($code==124) 
{
    $courseId=$_POST['course'];
    $semesterId=$_POST['semesterId'];
    $batch=$_POST['batch'];
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Batch</th>
                <th>Semester</th>

                <th>Status</th>
            </tr>
        </thead>
        <?php 
        $sr=0;
        if($semesterId==0)
        {
            $showQuestionQry="SELECT DISTINCT SubjectCode,SemesterID,CourseID,Batch FROM MasterCourseStructure WHERE CourseID='$courseId' and Batch='$batch' order by SemesterID";
        }
        else
        {
            $showQuestionQry="SELECT DISTINCT SubjectCode,CourseID,Batch,SemesterID FROM MasterCourseStructure WHERE CourseID='$courseId' and SemesterID='$semesterId' and Batch='$batch' order by SemesterID";
        }
        $showQuestionRun= sqlsrv_query($conntest,$showQuestionQry);
        while($showQuestionData=sqlsrv_fetch_array($showQuestionRun, SQLSRV_FETCH_ASSOC))
        {
            $subCode='';
            $lockStatusData='';
            $lockStatusData="<b class='text-danger'>Pending</b>";
            $subCode=$showQuestionData['SubjectCode'];
            $showQuestionLockQry="Select * from question_bank inner join question_session on question_session.id=question_bank.Exam_Session where SubjectCode='$subCode' and CourseID='".$showQuestionData['CourseID']."' and Batch='$batch' and question_session.session_status='1'";
            $showQuestionLockRun=mysqli_query($conn,$showQuestionLockQry);
            while($showQuestionLockData=mysqli_fetch_array($showQuestionLockRun))
            {
                $showQuestionLockSql="Select * from question_bank inner join question_session on question_session.id=question_bank.Exam_Session where SubjectCode='$subCode' and CourseID='".$showQuestionData['CourseID']."' and Batch='$batch' and  lock_status='0' and question_session.session_status='1'";
            $showQuestionLockRes=mysqli_query($conn,$showQuestionLockSql);
                if (mysqli_num_rows($showQuestionLockRes)>0) 
                {
                    $lockStatusData="<b class='text-danger'>Pending</b>";
                }
                else 
                {
                    $lockStatusData="<i class='fa fa-lock text-success'></i>";
                }
            }
            $sr++;
            ?>
            <tr>
                <td><?=$sr?></td>
              
                <td>
                    <?php
                    $sqlSubject = "SELECT DISTINCT SubjectName from MasterCourseStructure WHERE SubjectCode ='".$showQuestionData['SubjectCode']."' AND Isverified='1' and CourseID='".$showQuestionData['CourseID']."' ";
                    $resultSubject = sqlsrv_query($conntest,$sqlSubject);
                    if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
                    {
                        echo $rowSubject["SubjectName"]; 
                    }
                    ?>
                </td>
                <td><?=$showQuestionData['SubjectCode']?></td>
                <td><?=$showQuestionData['Batch']?></td>
                <td><?=$showQuestionData['SemesterID']?></td>
                <td><?=$lockStatusData?></i></td>
            </tr>
            <?php 
        }
        ?>
    </table>
<?php
}
elseif ($code==125) 
{
    $collegeId=$_POST['collegeId'];
    ?>
    <option value="">Select Course</option>
    <?php
    $sqlCourse = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE CollegeID='$collegeId'  ORDER BY Course ";
    $resultCourse = sqlsrv_query($conntest,$sqlCourse);
    while($rowCourse = sqlsrv_fetch_array($resultCourse, SQLSRV_FETCH_ASSOC) )
    {
        ?>
        <option value="<?=$rowCourse["CourseID"]?>"><?=$rowCourse["Course"]?></option>
        <?php
    } 
                                    
}
   elseif($code==126)
   {?>
<table class="table" id="example">
   <thead>
      <tr>
         <th>#</th>
         <th>Question</th>
         <th>Type</th>
         <th>Category</th>
         <th>Batch</th>
         <th>Course</th>
         <th>Subject Name</th>
         <th>Subject</th>
      </tr>
   </thead >
   <tbody >
      <?php 
         $srno=1;
            $showQuestionQry="SELECT * FROM question_bank AS qb INNER JOIN question_category AS qc ON qb.Category=qc.id INNER JOIN
         question_type AS qt ON qb.`Type`=qt.id INNER JOIN question_session as qs ON qb.Exam_Session=qs.id WHERE UpdatedBy='$EmployeeID' and qs.session_status='1' order by qb.Id DESC LIMIT 10  ";
            $showQuestionRun=mysqli_query($conn,$showQuestionQry);
            while($showQuestionData=mysqli_fetch_array($showQuestionRun))
            {
               $CourseID=$showQuestionData['CourseID'];
             $SubjectCode=$showQuestionData['SubjectCode'];
         $sql = "SELECT DISTINCT Course,CourseID,SubjectName from MasterCourseStructure WHERE CourseID ='$CourseID'and SubjectCode ='$SubjectCode' AND Isverified='1'  ORDER BY Course ";
         $result = sqlsrv_query($conntest,$sql);
         if($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
         {
         $CourseName=$row["Course"]; 
         $SubjectName=$row["SubjectName"]; 
         }
         
               ?>
      <tr>
         <td><?=$srno;?></td>
         <td><?=$showQuestionData['Question']?></td>
         <td><?=$showQuestionData['type_name']?></td>
         <td><?=$showQuestionData['category_name']?></td>
         <td><?=$showQuestionData['Batch']?></td>
         <td><?=$CourseName;?></td>
         <td><?=$SubjectName;?></td>
         <td><?=$showQuestionData['SubjectCode']?></td>
      </tr>
      <?php 
         $srno++;
         }?>
   </tbody>
</table>
<?php 
   }
   elseif($code==127)
   {
       $subject_code=$_POST['subCode'];
      $courseId=$_POST['courseId'];
      $batch=$_POST['batch'];
      $sem=$_POST['sem'];
      $unit=$_POST['unit'];
      $type=$_POST['type'];
        $code_access=$_POST['code_access'];
   ?>
<div class="card-body table-responsive ">
   <table class="table" id="example">
      <thead>
         <tr>
            <th>#</th>
            <th>Question</th>
            <th>Unit</th>
            <th>Type</th>
            <th>Category</th>
            <th>Batch</th>
            <th>Semester</th>
            <!-- <th>Course</th> -->
            <th>Subject Name</th>
            <th>Subject code</th>
            
            <th>Upload</th>
         </tr>
      </thead >
      <tbody >
         <?php 
            $srno=1;
                $showQuestionQry="SELECT * FROM question_bank AS qb INNER JOIN question_category AS qc ON qb.Category=qc.id INNER JOIN
            question_type AS qt ON qb.`Type`=qt.id INNER JOIN question_session as qs ON qb.Exam_Session=qs.id inner join question_bank_details on qb.id=question_bank_details.question_id WHERE UpdatedBy='$EmployeeID' and SubjectCode ='$subject_code' and lock_status='0' and qs.session_status='1' and  CourseID='$courseId' and Batch='$batch' and Semester='$sem' and Unit='$unit' and Type='$type'  ";
               $showQuestionRun=mysqli_query($conn,$showQuestionQry);
               while($showQuestionData=mysqli_fetch_array($showQuestionRun))
               {
                  $CourseID=$showQuestionData['CourseID'];
                  $Semester=$showQuestionData['Semester'];
                $SubjectCode=$showQuestionData['SubjectCode'];
            $sql = "SELECT DISTINCT Course,CourseID,SubjectName from MasterCourseStructure WHERE CourseID ='$CourseID'and SubjectCode ='$SubjectCode' AND Isverified='1'  ORDER BY Course ";
            $result = sqlsrv_query($conntest,$sql);
            if($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
            {
            $CourseName=$row["Course"]; 
            $SubjectName=$row["SubjectName"]; 
            }
            
                  ?>
         <tr>
            <td><?=$srno;?></td>
             <?php 
                                         if ($code_access=='010' || $code_access=='011' || $code_access=='110' || $code_access=='111') 
                                          {
            ?><td data-toggle="modal" data-target="#modal-lg" onclick="update_question(<?=$showQuestionData['Id']?>);"><?=$showQuestionData['Question']?></td>

                                   <?php }
                                   else
                                       {?>
                                       <td> <?=$showQuestionData['Question']?></td>
                                  <?php }?>
            <td><?=$showQuestionData['Unit']?></td>
            <td><?=$showQuestionData['type_name']?></td>
            <td><?=$showQuestionData['category_name']?></td>
            <td><?=$showQuestionData['Batch']?></td>
              <td><?=$showQuestionData['Semester']?></td>
       <!--      <td><?=$CourseName;?></td> -->
            <td><?=$SubjectName;?></td>
            <td><?=$showQuestionData['SubjectCode']?></td>
          
            <td>    <?php   
                                            if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                            { 
                                             ?>
                                          <i class="fa fa-upload" data-toggle="modal" data-target="#modal-lg-image"  onclick="upload_image_question(<?=$showQuestionData['Id']?>);" style="color:red;"></i>
                                       <?php 
                                        }
                                           
                                           if ($code_access=='001' || $code_access=='011' || $code_access=='101' || $code_access=='111') 
                                            { 
                                             ?>

                                             &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-trash" onclick="delete_question(<?=$showQuestionData['Id']?>);"></i>
                                   <?php  }
                                  ?></td>
         </tr>
         <?php 
            $srno++;
            }?>
      </tbody>
   </table>
</div>
<?php 
   }
   elseif ($code==128) 
   {
        $subject_code = $_POST['subject_code'];
       ?>
<table class="table" id="example1">
   <thead>
      <tr>
         <th>#</th>
         <th>Course Name</th>
         <th>Subject Name</th>
         <th>Subject Code</th>
         <th>Batch</th>
         <th>Status</th>
         <th>Action</th>
      </tr>
   </thead>
   <?php 
      $sr=0;
      
          $showQuestionQry="SELECT Distinct SubjectCode,CourseID,Batch,Semester,lock_status FROM question_bank AS qb INNER JOIN question_category AS qc ON qb.Category=qc.id INNER JOIN
                      question_type AS qt ON qb.`Type`=qt.id INNER JOIN question_session as qs ON qb.Exam_Session=qs.id WHERE UpdatedBy='$EmployeeID' and SubjectCode ='$subject_code' and qs.session_status='1' ";
                         $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                         while($showQuestionData=mysqli_fetch_array($showQuestionRun))
                         {
                            $CourseID=$showQuestionData['CourseID'];
                          $SubjectCode=$showQuestionData['SubjectCode'];
                          $Batch=$showQuestionData['Batch'];
                          $Semester=$showQuestionData['Semester'];
                          $question_count_selection="Select * from question_count ";
                          $question_count_selection_run=mysqli_query($conn,$question_count_selection);
                          
                       
                            $qry="SELECT  * from question_bank  where SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' and Semester='$Semester' and Exam_Session='$current_session' and lock_status=0 ";
                          $run=mysqli_query($conn,$qry);
                          if(mysqli_num_rows($run)>0)
                          {
                              $lockStatusData="<i onclick=lockQuestions('$SubjectCode','$CourseID','$Batch','$Semester') class='fa fa-lock-open text-success'></i>";
                          }
                          else
                          {
                              $lockStatusData="<i class='fa fa-lock text-danger'></i>";
                          }
                          while ($question_count_selection_row=mysqli_fetch_array($question_count_selection_run)) 
                          {
                             
                              $question_count_all=$question_count_selection_row['question_count'];
                         $unitCount=intval($question_count_selection_row['number']/100);
                         $typeCount=intval(($question_count_selection_row['number']%100)/10);
                         $categoryCount=intval($question_count_selection_row['number']%10);
                          $sql="SELECT  * from question_bank  where SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' and Semester='$Semester' and Exam_Session='$current_session' and Type='$typeCount' and Category='$categoryCount' and Unit='$unitCount' ";
                          $res=mysqli_query($conn,$sql);
                          $QUC_count1=mysqli_num_rows($res);
                          // echo ' Q= '.$QUC_count1;
                          if ($QUC_count1<$question_count_all) 
                          {
                              $lockStatusData="<b style='color:red;'>Questions Pending</b>";
                 
                          }
      
      
                          }
      
                           
          $sr++;
          ?>
   <tr>
      <td><?=$sr?></td>
      <td>  <?php 
         $sqlSubject = "SELECT DISTINCT Course from MasterCourseStructure WHERE SubjectCode ='".$SubjectCode."' AND Isverified='1' and CourseID='".$CourseID."' ";
         $resultSubject = sqlsrv_query($conntest,$sqlSubject);
         if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
         {
             echo $rowSubject["Course"]; 
         }
         ?></td>
      <td> 
         <?php 
            $sqlSubject = "SELECT DISTINCT SubjectName from MasterCourseStructure WHERE SubjectCode ='".$SubjectCode."' AND Isverified='1' and CourseID='".$CourseID."' ";
            $resultSubject = sqlsrv_query($conntest,$sqlSubject);
            if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
            {
                echo $rowSubject["SubjectName"]; 
            }
            ?>
      </td>
      <td><?=$showQuestionData['SubjectCode']?></td>
      <td><?=$showQuestionData['Batch']?></td>
      <td><?=$lockStatusData?></td>
      <td>
         <?php if ($showQuestionData['lock_status']!=0) {
            ?> <i class="fa fa-eye-slash" aria-hidden="true"></i><?php
            }
            else
            { 
                ?>
         <i class="fa fa-eye text-success fa-lg" onclick="view_question('<?=$SubjectCode;?>','<?=$CourseID;?>','<?=$Batch;?>','<?=$Semester;?>')" data-toggle="modal" 
            data-target="#modal-lg-view-question" ></i>
         <?php 
            }
              ?>
      </td>
   </tr>
   <?php 
      }
      ?>
</table>
<?php
   }
   elseif ($code == 129 ) 
{
    $year = $_POST['year'];
    $month = $_POST['month'];
    $sessionName=$month." ".$year;
    $sql = "INSERT INTO question_session (session_name, session_status) VALUES ('$sessionName', '1')";
    $res = mysqli_query($conn, $sql);
    if ($res) 
    {    
        echo $sql1 = "UPDATE question_session SET session_status='0' WHERE session_name!='$sessionName'";
        mysqli_query($conn, $sql1);
    } 
    else 
    {
        echo " Not Updated";
    }
}
elseif ($code==130) 
{
    $collegeId=$_POST['collegeId'];
    // $semesterId=$_POST['semesterId'];
    $batch=$_POST['batch'];
    ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Course</th>
                <th>Batch</th>
                <th>Sem</th>
                <th>Status</th>
            </tr>
        </thead>
        <?php 
        $sr=0;
        $showQuestionQry="SELECT DISTINCT SubjectCode,CourseID,CollegeID,Batch,SemesterID FROM MasterCourseStructure WHERE CollegeID='$collegeId' order by  SemesterID asc,Batch Desc,CourseID desc";
        $showQuestionRun= sqlsrv_query($conntest,$showQuestionQry);
        while($showQuestionData=sqlsrv_fetch_array($showQuestionRun, SQLSRV_FETCH_ASSOC))
        {
            $subCode='';
            $lockStatusData='';
            $lockStatusData="<b class='text-danger'>Pending</b>";
            $subCode=$showQuestionData['SubjectCode'];
            $showQuestionLockQry="Select * from question_bank inner join question_session on question_session.id=question_bank.Exam_Session where SubjectCode='$subCode' and CourseID='".$showQuestionData['CourseID']."' and Batch='$batch' and question_session.session_status='1'";
            $showQuestionLockRun=mysqli_query($conn,$showQuestionLockQry);
            while($showQuestionLockData=mysqli_fetch_array($showQuestionLockRun))
            {
                $showQuestionLockSql="Select * from question_bank inner join question_session on question_session.id=question_bank.Exam_Session where SubjectCode='$subCode' and CourseID='".$showQuestionData['CourseID']."' and Batch='$batch' and  lock_status='0' and question_session.session_status='1'";
            $showQuestionLockRes=mysqli_query($conn,$showQuestionLockSql);
                if (mysqli_num_rows($showQuestionLockRes)>0) 
                {
                    $lockStatusData="<b class='text-danger'>Pending</b>";
                }
                else 
                {
                    $lockStatusData="<i class='fa fa-lock text-success'></i>";
                }
            }
            $sr++;
            ?>
            <tr>
                <td><?=$sr?></td>
              
                <td>
                    <?php
                    $sqlSubject = "SELECT DISTINCT SubjectName from MasterCourseStructure WHERE SubjectCode ='".$showQuestionData['SubjectCode']."' AND Isverified='1' and CourseID='".$showQuestionData['CourseID']."' ";
                    $resultSubject = sqlsrv_query($conntest,$sqlSubject);
                    if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
                    {
                        echo $rowSubject["SubjectName"]; 
                    }
                    ?>
                </td>
                <td><?=$showQuestionData['SubjectCode']?></td>
                <td><?=$showQuestionData['CourseID']?></td>
                <td><?=$showQuestionData['Batch']?></td>
                <td><?=$showQuestionData['SemesterID']?></td>
                <td><?=$lockStatusData?></i></td>
            </tr>
            <?php 
        }
        ?>
    </table>
<?php
}
   elseif($code==131)
   {
       $id=$_POST['id'];
       
      $sql = "SELECT * from question_bank_details WHERE question_id ='$id'";
       $result = mysqli_query($conn,$sql);
       while($row = mysqli_fetch_array($result))
       {
           echo $row["Question"]; 
       }
   }
   elseif($code==132)
   {
       $id=$_POST['id'];
       $question=$_POST['question_new'];
       $edit="UPDATE question_bank_details SET Question='$question' WHERE question_id='$id'";
       $edit_run=mysqli_query($conn,$edit);
   
   }
   elseif($code==133)
                  
   { 
       $subCode=$_POST['subCode'];
        $courseId=$_POST['courseId'];
         $batch=$_POST['batch'];
       $sem=$_POST['sem'];
       $edit="UPDATE question_bank SET lock_status='1' WHERE SubjectCode='$subCode' and CourseID='$courseId' and Batch='$batch' and Semester='$sem'";
       $edit_run=mysqli_query($conn,$edit);
   
   }
   elseif($code==134)             
   { 
       $flag=0;
       $SubjectCode=$_POST['subCode'];
        $CourseID=$_POST['courseId'];
         $Batch=$_POST['batch'];
       $Semester=$_POST['sem'];
      $sr=0;
      for($i=1;$i<=4;$i++)
      {
      ?>    
            <div class="card collapsed-card" id="card<?=$i?>">
               <div class="card-header"  data-card-widget="collapse" onclick="showQuestionData(<?=$i?>,'<?=$SubjectCode?>',<?=$CourseID?>,<?=$Batch?>,<?=$Semester?>)">
                  <h5 class="card-title">Unit <?=$i?></h5>
                  <div class="card-tools">
                     <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus" onclick="showQuestionData(<?=$i?>,'<?=$SubjectCode?>',<?=$CourseID?>,<?=$Batch?>,<?=$Semester?>)"></i>
                     </button> -->
                     <button type="button" class="btn btn-tool" >
                        <i class="fas fa-eye text-warning"></i>
                     </button>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row" id="row<?=$i?>">
               
                  </div>
               </div>
            </div>
            <?php
         }
      
   }

elseif ($code==135) 
{
    $subjectCode=$_POST['subjectCode'];
    $examSession=$_POST['examSession'];
    $examName=$_POST['examName'];
    $courseId=$_POST['courseId'];
    ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>#</th>
                <th>Course Name</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Batch</th>
                <!-- <th>Session</th> -->
                <th>Action</th>
                <th>Paper Id</th>
          
            </tr>
        </thead>
        <?php 
        $sr=0;
        if ($examSession=='New') 
        {
           $sql="SELECT Distinct SubjectCode,CourseID,Semester,Batch FROM question_bank  inner join question_session on question_bank.Exam_Session=question_session.id  WHERE SubjectCode ='$subjectCode'    and CourseID='$courseId' and session_status='1' ";
        }
        elseif ($examSession=='Old') 
        {
            $sql="SELECT Distinct SubjectCode,CourseID,Semester,Batch FROM question_bank  inner join question_session on question_bank.Exam_Session=question_session.id  WHERE SubjectCode ='$subjectCode'    and CourseID='$courseId' and session_status='0' ";
        }
        $res=mysqli_query($conn,$sql);
        while($data=mysqli_fetch_array($res))
        {
         $Semester=$data['Semester'];
         $sqlSubject = "SELECT Course,SubjectName from MasterCourseStructure WHERE SubjectCode ='".$subjectCode."' AND Isverified='1' and CourseID='".$courseId."' ";
                    $resultSubject = sqlsrv_query($conntest,$sqlSubject);
                    if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
                    {
                        $CourseName=$rowSubject["Course"]; 
                        $SubjectName=$rowSubject["SubjectName"]; 
                    }
            
                         ?>
                <tr>
                <td><?=1?></td>
                <td><?=$CourseName?></td>
                <td><?=$SubjectName?>(<?=$subjectCode?>)</td>
                <td><?=$data['Batch']?></td>
                <td><?=$data['Semester']?></td>
                <!-- <td><?=$data['session_name']?></td> -->
                <td><?php
                    $checkGenerateQry="Select * from question_paper where session='$current_session' and exam='$examName' and subject_code='$subjectCode' and course='$courseId' and semester=".$data['Semester']." and status='0'";
                    $checkGenerateRes=mysqli_query($conn,$checkGenerateQry);
                    if ($data1=mysqli_fetch_array($checkGenerateRes)) 
                    {
                        ?>
                    <form action="print-paper.php" method="post" target="_blank">
                        <input type="hidden" name="paperId" value="<?=$data1['id']?>">
                    <!-- <span class="bg-info" style="border-radius: 10px">&nbsp;&nbsp;Print&nbsp;&nbsp;</span> -->
                        <button type="submit" class="btn-outline-warning btn" aria-labelledby="dLabel"> <i class="fa fa-print text-info fa-2x" style="border-radius: 10px" ></i></button>
                    </form>
                    <?php 
                    }                    
                    else
                    {

                    ?>
                    <button class="btn btn-xs btn-success"   style="border-radius: 50px; font-size: 16px;" onclick="generateQuestionPaper('<?=$subjectCode?>','<?=$Semester?>','<?=$courseId?>','<?=$examName?>')">Generate</button>
                    <?php 
                    }
                    ?>
                </td>
                <td>

                  <?php
                if ($EmployeeID=='131053') 
                    {
                    
                    ?>
                    <i class="fa fa-trash text-danger fa-2x" onclick="dltPaper(<?=$data1['id']?>)" ><?=$data1['id']?></i>
                    <?php 
                    }
                    else
                    {
                     ?>
                    <i class="fa text-danger fa-2x"  ><?=$data1['id']?></i>
                    <?php
                     
                    }
                    ?>
                  
                </td>

                 
                
            </tr>
                <?php
            }
        ?>
    </table>
<?php

}

   elseif($code==136)
   { ?> <div class="card-body table-responsive p-0">
         <table class="table table-head-fixed text-nowrap">  <tr><?php 
                               $Q_id=$_POST['id'];
                                $get_image="SELECT image,id FROM question_image WHERE question_id='$Q_id'";
                                $get_run=mysqli_query($conn,$get_image);
                                while($get_row=mysqli_fetch_array($get_run))
                                {?>
                                 
                               
                                    <td>
<img src="http://gurukashiuniversity.co.in/data-server/question_images/<?=$get_row['image'];?>" width="130" height="150">
<br>
<i class="fa fa-times fa-lg" style="color:red;"aria-hidden="true" onclick='dlt_image(<?=$get_row['id'];?>);'></i></td>
<?php }
?></tr>
</table>
</div><?php
   }
      elseif($code==137)
   {  
                               $Q_id=$_POST['id'];
                                $get_image="DELETE  FROM question_image WHERE id='$Q_id'";
                                $get_run=mysqli_query($conn,$get_image);
                               
   }

elseif ($code==138)
{
    $SubjectCode=$_POST['SubjectCode'];
    $Semester=$_POST['Semester'];
    $CourseID=$_POST['CourseID'];
    $examName=$_POST['examName'];
    $current_session;
    $questionSessionTrack='';
    
    $date=date('Y-m-d H-i-s');
 $flag=0;
   if($SubjectCode!=''&& $examName>0 &&$CourseID!='')
{
   if($examName=='1')
   {
      $questionCountQry="Select * from question_generate_count where unit='1' or unit='2' ";
      $flag=1;
   }

   elseif ($examName=='2') 
   {
         $questionCountQry="Select * from question_generate_count where unit='3'";
      $flag=1;
     
   }
   elseif($examName=='3')
   {
      $questionCountQry="Select * from question_generate_count where unit='4'";
      $flag=1;

   }
   else
   {
      $flag=0;
      echo 'Select Exam Please';
   }


}
else
{
   echo"Select Exam Please";
}

   if ($flag>0) 
   {
      $examNameQry="SELECT exam_name FROM question_exam WHERE id='$examName'";
    $examNameRes=mysqli_query($conn,$examNameQry);
    if ($examNameData=mysqli_fetch_array($examNameRes)) 
    {
       $questionSessionTrack.=$examNameData['exam_name'].'('.$current_session_name.')';
    }
    else
    {
       $questionSessionTrack.=$examName.'('.$current_session_name.')';
    }
         $questionCountRes=mysqli_query($conn,$questionCountQry);
         while($questionCountData=mysqli_fetch_array($questionCountRes))
         {
            $unit=$questionCountData['unit'];
            $type=$questionCountData['type'];  
            $category=$questionCountData['category'];
            $count=$questionCountData['count'];

            if ($type=='2' && ($category=='3' || $category=='4') && $unit=='1') 
            {
               $unit=rand(1,2);
            }
            elseif ($type=='3' && ($category=='2' || $category=='3') && $unit=='1') 
            {
               $unit=rand(1,2);
            }
        
             $questionBankQry1="Select Id from question_bank where Unit='$unit' and Type='$type' and Category='$category' and SubjectCode='$SubjectCode' and CourseID='$CourseID' and Semester='$Semester' order by Rand() limit $count ";
            $questionBankRes1=mysqli_query($conn,$questionBankQry1);

             while($questionBankData1=mysqli_fetch_array($questionBankRes1))
         {
                $questionArray[]=$questionBankData1['Id'];

         }   
                   
         
         }    
         // print_r($questionArray);

       $countarray=count($questionArray);


        if(!array_unique($questionArray))
{
    echo 'Please Regenerate';
    print_r($questionArray);
}
else
{
    
$gene=0;
    if($examName==1 && $countarray==16) 
    {
$gene=1;
    }
    elseif(($examName==2 || $examName==3)&& $countarray==13)
    {
$gene=1;
    } 
    else
    {
      $gene=0;
    }


        if ($gene>0) 
        {
            $sql="INSERT INTO question_paper (session, exam, subject_code, course, semester, printed_by, generated_on, status) VALUES ('$current_session', '$examName', '$SubjectCode', '$CourseID', '$Semester', '$EmployeeID', '$date', '0')";
            $res=mysqli_query($conn,$sql);
            $qry="SELECT id from question_paper ORDER BY id DESC LIMIT 1 ";
            $run=mysqli_query($conn,$qry);
            while($data=mysqli_fetch_array($run))
            {
               $questionPaperId=$data['id'];
            }
            echo 'Successfully Generated';
         
    for ($i=0; $i < $countarray; $i++) 
    { 
          
        mysqli_query($conn,"INSERT INTO question_paper_details (question_paper_id, question_id) VALUES ($questionPaperId, $questionArray[$i])"); 
        mysqli_query($conn,"Update question_bank set Track= CONCAT(Track, ',$questionSessionTrack') Where Id=".$questionArray[$i]); 

    }
 }
 else
 {
   echo "Cant Generate due to insufficent data ";
 }
 }
 }
} 




elseif ($code==139)
{
    $SubjectCode=$_POST['subjectCode'];
    
    $sqlCourse = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE SubjectCode='$SubjectCode'  ORDER BY Course ";
    $resultCourse = sqlsrv_query($conntest,$sqlCourse);
    while($rowCourse = sqlsrv_fetch_array($resultCourse, SQLSRV_FETCH_ASSOC) )
    {
        ?>
        <option value="<?=$rowCourse["CourseID"]?>"><?=$rowCourse["Course"]?></option>
        <?php
    } 
} 
  elseif($code==140) ///delete question
   {  
     $Q_id=$_POST['id'];
     $sql="SELECT * from question_bank where id=$Q_id";
      $res=mysqli_query($conn,$sql);
      if ($data=mysqli_fetch_array($res)) 
      {
         mysqli_query($conn,"INSERT INTO question_bank_deleted (SubjectCode, CollegeID, Unit, Type, Category, Batch, CourseID, Semester, Question, UpdatedBy, lock_status, Exam_Session, DeletedBy, QuestionID) VALUES ('".$data['SubjectCode']."', '".$data['CollegeID']."', '".$data['Unit']."', '".$data['Type']."', '".$data['Category']."', '".$data['Batch']."', '".$data['CourseID']."', '".$data['Semester']."', '".$data['Question']."', '".$data['UpdatedBy']."', '".$data['lock_status']."', '".$data['Exam_Session']."', '$EmployeeID', '".$data['id']."')");
      $get_image="DELETE  FROM question_bank WHERE id='$Q_id'";
      $get_run=mysqli_query($conn,$get_image);
      }
                            
   }


elseif($code=='141')
   {
   $univ_rollno=$_POST['rollNo'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno' or IDNo='$univ_rollno'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
   
    $IDNo= $row['IDNo'];
    $ClassRollNo= $row['ClassRollNo'];
    $img= $row['Snap'];
    $UniRollNo= $row['UniRollNo'];
    $name = $row['StudentName'];
    $father_name = $row['FatherName'];
    $course = $row['Course'];
    $email = $row['EmailID'];
    $phone = $row['StudentMobileNo'];
    $batch = $row['Batch'];
    $college = $row['CollegeName'];
    $result2 = "SELECT  * FROM MasterCourseCodes where CollegeID=".$row['CollegeID']." and CourseID=".$row['CourseID']." and Batch=".$row['Batch'];
   $stmt2 = sqlsrv_query($conntest,$result2);
   while($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
   {
       $validUpto = $row2['ValidUpto'];
   }
   if($validUpto!='')
   {
  $validUpto= $validUpto->format('d-M-Y');
   }
   else
   {
     $validUpto='';
   }
   
   $sql="SELECT * from hostel_student_summary inner join location_master on location_master.ID=hostel_student_summary.location_id inner join building_master on building_master.ID=location_master.Block where student_id='$IDNo' and status='0'";
   $res=mysqli_query($conn,$sql);
   while($data=mysqli_fetch_array($res))
   {
     $building =$data['Name'];
   }
   ?>
   
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($img).'" height="100" width="100" class="img-circle elevation-2"  style="border-radius:50%"/>';?>
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><b><?=$name; ?></b></h3>
                <h5 class="widget-user-desc"><?= $ClassRollNo ;?>/<?php if($UniRollNo!=''){ echo $UniRollNo;}else{echo "<font style='color:red'>Uni Roll No. Not Issued</font>";} ?></h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                     <li class="nav-link"><b>Father Name </b> :&nbsp;&nbsp;&nbsp;<?= $father_name; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>Contact</b> :&nbsp;&nbsp;&nbsp;<?= $phone; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>Batch</b> :&nbsp;&nbsp;&nbsp;<?= $batch; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>College</b> :&nbsp;&nbsp;&nbsp;<?= $college; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>Course</b> :&nbsp;&nbsp;&nbsp;<?= $course; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>Valid Upto</b> :&nbsp;&nbsp;&nbsp;<b class="text-danger"><?= $validUpto; ?></b></li>
                  </li>
                  <?php 
                  if(isset($building))
                  {
                  ?>
                  <li class="nav-item">
                     <li class="nav-link"><b>Hostel</b> :&nbsp;&nbsp;&nbsp;<?= $building; ?></li>
                  </li>
                  
                           <?php 
                           $qry="SELECT * from gate_entry_hostel where studentId='$IDNo' and direction='0'";
                           $run=mysqli_query($conn,$qry);
                           if (mysqli_num_rows($run)>0) 
                           {
                              $gateEntryId='';
                              $checkOutTime='';
                              if ($dataDirection=mysqli_fetch_array($run)) 
                              {
                                 $gateEntryId=$dataDirection['id'];
                                 $checkOutTime=date("d-M-Y H:i A", strtotime($dataDirection['check_out_time']));
                              }                              
                           ?>
                           <li class="nav-item">
                     <li class="nav-link"><b>Check Out Time</b> :&nbsp;&nbsp;&nbsp;<?= $checkOutTime; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link">
                        <span class="float-right badge ">
                           <button class="btn-xs btn btn-success" onclick="gateEntryCheckIn(<?=$IDNo?>,'1',<?=$gateEntryId?>)">
                              Check In 
                           </button>
                           </span>
                     </li>
                  </li>
                           <?php
                           } 
                           else
                           {
                           ?><li class="nav-item">
                     <li class="nav-link">
                        <span class="float-right badge ">
                           <button class="btn-xs btn btn-danger" onclick="gateEntryCheckOut(<?=$IDNo?>,0)">
                              Check Out 
                           </button>
                           </span>
                     </li>
                  </li>
                           <?php
                           } 
                           ?>
                        

                  <?php 
                  }
                  ?>
                </ul>
              </div>
            </div>
         
   <?Php
}   
   
   }
   elseif($code=='142')
   {
      $studentId=$_POST['studentId'];
      $direction=$_POST['direction'];
      $gateEntryId=$_POST['gateEntryId'];
      // UPDATE gate_entry_hostel SET id=2, studentId=9618214860, check_in_time='0000-00-00 00:00:00', check_out_time='2023-01-16 13:01:16', direction=0 WHERE id=2;

     echo $sql="update gate_entry_hostel set check_in_time='$timeStamp', direction='$direction' where id='$gateEntryId'";
      $res=mysqli_query($conn,$sql);

   }
   elseif($code=='143')
   {
      $studentId=$_POST['studentId'];
      $direction=$_POST['direction'];
      $sql="INSERT INTO gate_entry_hostel ( studentId, check_out_time, direction) VALUES ('$studentId','$timeStamp','$direction')";
      $res=mysqli_query($conn,$sql);

   }
   
elseif($code=='144')
{       
   ?>
   <div class="table-responsive">
      <table class="table" id="example">
         <tr>
            <th>Sr. No.</th>
            <th>Roll Number</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Action</th>
         </tr>
         
      

   <?php 
   $sr=0;
   $sql="SELECT * FROM gate_entry_hostel where direction='0'";
   $res=mysqli_query($conn,$sql);
   while ($data=mysqli_fetch_array($res)) 
   {
      $result1 = "SELECT  * FROM Admissions where IDNo=".$data['studentId'];
      $stmt1 = sqlsrv_query($conntest,$result1);
      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
         $IDNo= $row['IDNo'];
         $ClassRollNo= $row['ClassRollNo'];
         $img= $row['Snap'];
         $UniRollNo= $row['UniRollNo'];
         $name = $row['StudentName'];
         $father_name = $row['FatherName'];
         $course = $row['Course'];
         $email = $row['EmailID'];
         $phone = $row['StudentMobileNo'];
         $batch = $row['Batch'];
         $college = $row['CollegeName'];
      }
      $sr++;
      ?>
      <tr onclick="studentDetail(<?=$IDNo?>)">
            <th><?=$sr?></th>
            <td><?=$ClassRollNo?>/<?=$UniRollNo?></td>
            <td><?=$name?></td>
            <td><?=$father_name?></td>
            <td><i class="fa fa-arrow-left text-success" >
                              
                           </i></td>
         </tr>

      <?php
   }
   ?>
   </table>
   </div>
   <?php
}
    
   elseif($code==145)
   {
       $search = $_POST['search'];

       $query = "SELECT * FROM Staff Where (IDNo like '%".$search."%' or Name like '%".$search."%') and JobStatus='1'";
       $result = sqlsrv_query($conntest,$query);
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
         if ($row['ContactNo']!='') 
         {
            $mobile=$row['ContactNo'];
         }
         else
         {
            $mobile=$row['MobileNo'];
         }
           $response[] = array("value"=>$row['IDNo'],"department"=>$row['Department'],"mobile"=>$mobile,"designation"=>$row['Designation'],"label"=>$row['Name'].' ('.$row['Department'].')');
       }
       echo json_encode($response);
       exit;
   }
elseif($code == 146)
{
   $college=$_POST['college'];
   $query = "SELECT * FROM gate_visit_deparment WHERE department_id='$college'";
   $result = mysqli_query($conn,$query);
   while( $row = mysqli_fetch_array($result) )
   {
      $userid = $row['emp_id'];
   }
  $result1 = "SELECT * FROM Staff where IDNo='$userid'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
   {
       if ($row1['ContactNo']!='') 
         {
            $mobile=$row1['ContactNo'];
         }
         else
         {
            $mobile=$row1['MobileNo'];
         }
           $response[] = array("id"=>$row1['IDNo'],"department"=>$row1['Department'],"mobile"=>$mobile,"designation"=>$row1['Designation'],"name"=>$row1['Name']);
   }
  // encoding array to json format
  echo json_encode($response);
  exit;
}
elseif ($code==147) 
{
   $link=$_POST['userImageCaptured'];
   $personmeet_id=$_POST['personmeet_id'];
   $name=$_POST['name'];
   $mob=$_POST['mob'];
   $vehicle=$_POST['vehicle'];
   $proof=$_POST['proof'];
   $id_proof_no=$_POST['id_proof_no'];
   $purpose=$_POST['purpose'];
   $passno=$_POST['passno'];

   $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
   $result = 'image';
   for ($i = 0; $i < 25; $i++)
   $result .= $characters[mt_rand(0, 4)];
   $image_name =$player_id.$result;

   $ftp_server1 = "10.0.8.10";
   $ftp_user_name1 = "gurukashi";
   $ftp_user_pass1 = "Amrik@123";
   $remote_file1 = "";
   $conn_id = ftp_connect($ftp_server1) or die("Could not connect to $ftp_server");
   $login_result = ftp_login($conn_id, $ftp_user_name1, $ftp_user_pass1) or die("Could not login to $ftp_server1");
   $destdir = 'dummy_images/';

   ftp_chdir($conn_id, "gate_entry") or die("Could not change directory");
   ftp_pasv($conn_id,true);

   file_put_contents($destdir.$image_name.'.jpg', file_get_contents($link));
   ftp_put($conn_id,$image_name.'.jpg',$destdir.$image_name.'.jpg',FTP_BINARY) or die("Could not upload to $ftp_server1");
   ftp_close($conn_id);
   $sql="INSERT INTO gate_entry_visitor (meeting_person_id, visitor_name, visitor_mobile, visitor_vehicle_no, visitor_id_proof, visitor_id_proof_no, meeting_purpose, gate_pass_no, entry_time, status, visitor_image) VALUES ('$personmeet_id','$name','$mob','$vehicle','$proof','$id_proof_no','$purpose','$passno','$timeStamp','0','$image_name.jpg')";
   mysqli_query($conn,$sql);
}
elseif($code==148)
{
   ?>
   <div class=" table-responsive">
                        <table class="table  " id="example">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Image</th>
                                 <th>Name</th>
                                 <th>Mobile No.</th>
                                 <th>Vehicle No.</th>
                                 <th>Proof</th>
                                 <!-- <th>Meeting Person</th>
                                 <th>Purpose</th>
                                 <th>Entry Time</th>
                                 <th>Exit Time</th> -->
                                 <th>Status</th>
                                 <!-- <th>print</th> -->
                              </tr>
                           </thead>
                           <tbody>
                               <?php
                $entry_date = date('Y-m-d');
                $sql = "SELECT * FROM gate_entry_visitor WHERE (entry_time like '$entry_date%')  ORDER BY status,id DESC";
                $result = mysqli_query($conn, $sql);

                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     if($row["status"] == "1")
                     {
                        ?>
                        <tr style='background:#98FF98; '>
                        <?php
                     }
                     else
                     {
                        ?>
                        <tr style='background:#E3F9A6; '>
                        <?php
                     }
                     ?>

                      <td><?=$count++?></td>
                      <td>
                        <div class="filter-container p-0 row">
                           <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                              <a href="http://gurukashiuniversity.co.in/data-server/gate_entry/<?=$row['visitor_image']?>" data-toggle="lightbox" data-title="<?=$row['visitor_name']?>">
                                 <img src="http://gurukashiuniversity.co.in/data-server/gate_entry/<?=$row['visitor_image']?>"  height="50" width="50" class="img-circle elevation-2"  style="border-radius:50%" alt="image"/>
                              </a>
                           </div>
                        </div>
                     </td>
                   <!-- <img src="http://gurukashiuniversity.co.in/data-server/gate_entry/<?=$row['visitor_image']?>" height="50" width="50" class="img-circle elevation-2"  style="border-radius:50%"></td> -->
                      <td><?=$row['visitor_name']?></td>
                      <td><?=$row['visitor_mobile']?></td>
                      <td><?=$row['visitor_vehicle_no']?></td>
                      <td><?=$row['visitor_id_proof']?> </td>
                      <!-- <td><?php
                        $result1 = "SELECT * FROM Staff where IDNo=".$row['meeting_person_id'];
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                          echo $row1['Name']." (".$row1['Department'].")";
                        }
                      ?></td>
                      <td><?=$row["meeting_purpose"]?></td> -->
                      <?php
                      if($row["status"] == "1")
                     {
                        ?>
                      <!-- <td><?=date("d-M-Y H:i A", strtotime($row["entry_time"]))?></td>
                      <td><?=date("d-M-Y H:i A", strtotime($row["exit_time"]))?></td> -->
                      <td data-target='#check-out-modal' onclick="checkoutModal('<?=$row["id"]?>')"  data-toggle='modal'><b>Checked Out</b></td>
                        <?php
                     }
                     else
                     {
                        ?>
                        <!-- <td><?=date("d-M-Y H:i A", strtotime($row["entry_time"]))?></td>
                        <td></td> -->
                        <td data-target='#check-out-modal' onclick="checkoutModal('<?=$row["id"]?>')"  data-toggle='modal'>
                               <!-- <input type = 'hidden' name='visitid' value="<?=$row["id"]?>">
                               <input type = 'hidden' name='mob' value="<?=$row["visitor_mobile"]?>"> -->
                               <button type='submit' class='btn btn primary' name='checkout'><i class='fa fa-sign-out-alt'></i></button>
                        </td>
                               <?php
                     }
                      ?>
                        <!-- <td>
                              <form method = 'post' action='print_receipt.php'>
                              <input type = 'hidden' name='id' value="<?=$row["id"]?>">
                              <button type='submit' class='btn btn primary'><i class='fa fa-print'></i></button>
                              </form>
                            </td> -->
                         </tr>
                  <?php
                  }
                }
                
            ?>
                              
                           </tbody>
                        </table>
                     </div>
                     <?php
}

elseif($code==149)
{
   $id=$_POST['id'];
   $sql="UPDATE gate_entry_visitor SET  exit_time='$timeStamp', status='1' WHERE id='$id'";
   mysqli_query($conn,$sql);

}
elseif($code==150)
{
   $visitorId=$_POST['visitorId'];
   ?>

   <div class="modal-header">
            <h4 class="modal-title">Visitor Detail</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">

            <!-- Widget: user widget style 2 -->
            
            <!-- /.widget-user -->
          
            
                        
                               <?php
                $entry_date = date('Y-m-d');
                $sql = "SELECT * FROM gate_entry_visitor WHERE id='$visitorId'";
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
                     <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="http://gurukashiuniversity.co.in/data-server/gate_entry/<?=$row['visitor_image']?>"  alt="User Avatar">   
                </div>
                <div class="widget-user-image float-right">
                  <img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$empImg?>"  alt="User Avatar">   
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username "><b><?=$row['visitor_name']?></b>
                  <div class="row">
                     <div class="col-lg-4"></div>
                     <div class="col-lg-4 arrow-1 text-center text-danger"></div>
                     <!-- <div class="col-lg-4"></div> -->
                  </div>
                </h3>
                <h5 class="widget-user-desc float-right"><?=$empName?>&nbsp;</h5>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4  border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?=$row['visitor_mobile']?></h5>
                      <span class="description-header"><i class="fa fa-phone-alt"></i></span>
                    </div>
                    <!-- /.description-block -->
                  </div><div class="col-sm-4  border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?=date("H:i A", strtotime($row["entry_time"]))?></h5>
                      <span class="description-header">In</span>
                    </div>
                    <!-- /.description-block -->
                  </div><div class="col-sm-4 ">
                    <div class="description-block">
                      <h5 class="description-header">
                        <?php 
                        if($row["status"] == "1")
                     {
                        echo date("H:i A", strtotime($row["exit_time"]));
                      
                     }
                     else
                     {
                        ?>
                              <i class='fa fa-sign-out-alt' data-dismiss="modal" onclick="checkOutVisitor('<?=$row["id"]?>')"></i>
                               <?php
                     }
                     ?>
                      </h5>
                      <span class="description-header">Out</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <?php 
         }
         ?>


          
                                          
         
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-success btn-xs" type=button data-dismiss="modal" value="Take Snapshot" onClick="take_snapshot()">Capture</button> -->
         </div>
         <?php
}

elseif($code==151)
   {
      $subject_code = $_POST['subject_code'];
      $sql = "SELECT Distinct MasterCourseStructure.Batch from UserAccessLevel inner join MasterCourseStructure on MasterCourseStructure.CourseID=UserAccessLevel.CourseID where IDNo='$EmployeeID' and SubjectCode ='$subject_code' AND Isverified='1'";
     // echo $sql = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE SubjectCode ='$subject_code' AND Isverified='1'  ORDER BY Course ";
       $result = sqlsrv_query($conntest,$sql);
       echo "<option value=''>Batch</option>";
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
           echo "<option value='".$row["Batch"]."'>".$row["Batch"]."</option>"; 
       }
   }
   elseif($code==152)
   {
      $subject_code = $_POST['subject_code'];
      $sql = "SELECT Distinct MasterCourseStructure.SemesterID from UserAccessLevel inner join MasterCourseStructure on MasterCourseStructure.CourseID=UserAccessLevel.CourseID where IDNo='$EmployeeID' and SubjectCode ='$subject_code' AND Isverified='1'";
     // echo $sql = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE SubjectCode ='$subject_code' AND Isverified='1'  ORDER BY Course ";
       $result = sqlsrv_query($conntest,$sql);
       echo "<option value=''>Sem</option>";
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
           echo "<option value='".$row["SemesterID"]."'>".$row["SemesterID"]."</option>"; 
       }
   }
  elseif($code==153)
   {
       $CollegeID = $_POST['CollegeID'];
       $CourseID = $_POST['CourseID'];
       $Batch = $_POST['Batch'];
       $count = $_POST['count'];
       $Semester = $_POST['Semester'];
       $subject_code = $_POST['SubjectCode'];
       $code_access=$_POST['code_access'];
      ?>
<div class="table-responsive ">
   <table class="table" id="example-<?=$count?>">
      <thead>
         <tr>
            <th>#</th>
            <th>Question</th>
            <th>Unit</th>
            <th>Type</th>
            <th>Category</th>
            <th>Action</th>
         </tr>
      </thead >
      <tbody >
      <?php 
         $srno=1;
         $showQuestionQry="SELECT * FROM question_bank AS qb INNER JOIN question_category AS qc ON qb.Category=qc.id INNER JOIN question_type AS qt ON qb.`Type`=qt.id INNER JOIN question_session as qs ON qb.Exam_Session=qs.id WHERE  SubjectCode ='$subject_code' and CourseID='$CourseID' and Batch='$Batch' and Semester='$Semester' and CollegeID='$CollegeID'  and qs.session_status='1'  ";
         $showQuestionRun=mysqli_query($conn,$showQuestionQry);
         while($showQuestionData=mysqli_fetch_array($showQuestionRun))
         {
         ?>
            <tr>
               <td><?=$srno;?></td>
               <td> <?=$showQuestionData['Question']?></td>
               <td><?=$showQuestionData['Unit']?></td>
               <td><?=$showQuestionData['type_name']?></td>
               <td><?=$showQuestionData['category_name']?></td>
               <td>    
               <?php   
               if ($code_access=='001' || $code_access=='011' || $code_access=='101' || $code_access=='111') 
               { 
                  ?>                  
                  &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-trash" onclick="delete_question('<?=$showQuestionData['Id']?>','<?=$count?>','<?=$CollegeID?>','<?=$CourseID?>','<?=$subject_code?>','<?=$Batch?>','<?=$Semester?>');"></i>
                  <?php  
               }
               ?>
               </td>
            </tr>
            <?php 
            $srno++;
         }
         ?>
      </tbody>
   </table>
</div>
<?php 
   }
   elseif($code==154)
   {
      $lockStatus=$_POST['lockStatus'];
      if ($lockStatus==0) 
      {
         $lockStatusClass='fa fa-lock-open text-danger';
      }
      else
      {
         $lockStatusClass='fa fa-lock text-success';
      }
      ?>
      <div class="container">
                  <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-body">
                           <table class="table table-condensed table-striped">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>College</th>
                                    <th>Course</th>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Batch</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php
                              $sr=0;
                              $sql="Select distinct SubjectCode,CourseID,CollegeID,Batch,Semester from question_bank inner join question_session on question_session.id=question_bank.Exam_Session where lock_status='$lockStatus' and question_session.session_status='1' order by CollegeID asc, CourseID asc, Batch asc, Semester asc ";
                              $res=mysqli_query($conn,$sql);
                              while($data=mysqli_fetch_array($res))
                              {
                                 $sr++;
                                 $query = "SELECT * from MasterCourseStructure where SubjectCode ='".$data['SubjectCode']."' AND CourseID ='".$data['CourseID']."' AND CollegeID ='".$data['CollegeID']."' AND Batch ='".$data['Batch']."' AND SemesterID ='".$data['Semester']."' AND Isverified='1'  ORDER BY Course";
                                 $result = sqlsrv_query($conntest,$query);
                                 if($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
                                 {
                                    ?>
                                    <tr  data-toggle="collapse" data-target="#table-content-<?=$sr?>" onclick="viewAllQuestions('<?=$sr?>','<?=$data['CollegeID']?>','<?=$data['CourseID']?>','<?=$data['SubjectCode']?>','<?=$data['Batch']?>','<?=$data['Semester']?>')" class="accordion-toggle table-danger">
                                       <td><?=$sr?></td>
                                       <td><?=$row['CollegeName']?></td>
                                       <td><?=$row['Course']?></td>
                                       <td><?=$row['SubjectName']?></td>
                                       <td><?=$data['SubjectCode']?></td>
                                       <td><?=$data['Batch']?></td>
                                       <td><?=$data['Semester']?></td>
                                       <td><i class='<?=$lockStatusClass?>'></i></td>
                                    </tr>
                                    <tr>
                                       <td colspan="8" class="hiddenRow">
                                          <div class="accordian-body collapse" id="table-content-<?=$sr?>">
                                          </div>
                                       </td>
                                    </tr>
                                    <?php
                                 }
                              }
                              ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
      <?php
   }
   elseif($code==155)
   {
       ?>
       <button type="submit" onclick="check111()">check</button>
<table class="table" id="example1">
   <thead>
      <tr>
         <th>#</th>
         <th>Course Name</th>
         <th>Subject Name</th>
         <th>Subject Code</th>
         <th>Batch</th>
         <th>Status</th>
         <th>Action</th>
      </tr>
   </thead>
   <?php 
      $sr=0;
      $showQuestionQry="SELECT Distinct SubjectCode,CourseID,Batch,Semester,lock_status FROM question_bank AS qb INNER JOIN question_category AS qc ON qb.Category=qc.id INNER JOIN question_type AS qt ON qb.`Type`=qt.id INNER JOIN question_session as qs ON qb.Exam_Session=qs.id WHERE lock_status=0 and qs.session_status='1' ";
      $showQuestionRun=mysqli_query($conn,$showQuestionQry);
      while($showQuestionData=mysqli_fetch_array($showQuestionRun))
      {
         $CourseID=$showQuestionData['CourseID'];
         $SubjectCode=$showQuestionData['SubjectCode'];
         $Batch=$showQuestionData['Batch'];
         $Semester=$showQuestionData['Semester'];
         $question_count_selection="Select * from question_count ";
         $question_count_selection_run=mysqli_query($conn,$question_count_selection);
         $lockStatusData='';
         $flag=0;
         $lockStatusData="<i onclick=lockQuestions('$SubjectCode','$CourseID','$Batch','$Semester') class='fa fa-lock-open text-success'></i>";
         while ($question_count_selection_row=mysqli_fetch_array($question_count_selection_run)) 
         {
            $question_count_all=$question_count_selection_row['question_count'];
            $unitCount=intval($question_count_selection_row['number']/100);
            $typeCount=intval(($question_count_selection_row['number']%100)/10);
            $categoryCount=intval($question_count_selection_row['number']%10);
            $sql="SELECT  * from question_bank  where SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' and Semester='$Semester' and Exam_Session='$current_session' and Type='$typeCount' and Category='$categoryCount' and Unit='$unitCount' ";
            $res=mysqli_query($conn,$sql);
            $QUC_count1=mysqli_num_rows($res);
            if ($QUC_count1<$question_count_all) 
            {
               $flag=1;
            }
         }

         if ($flag==0) 
         {
         $sr++;
          ?>
   <tr>
      <td>
         <?=$sr?>
            <input type="checkbox" name="array[]" class="check_1" value="<?=$showQuestionData['SubjectCode']?>=SubjectCode<?=$showQuestionData['CourseID']?>=CourseID<?=$showQuestionData['Batch']?>=Batch<?=$showQuestionData['Semester']?>=Semester">
         </td>
      <td>  <?php 
         $sqlSubject = "SELECT DISTINCT Course from MasterCourseStructure WHERE SubjectCode ='".$SubjectCode."' AND Isverified='1' and CourseID='".$CourseID."' ";
         $resultSubject = sqlsrv_query($conntest,$sqlSubject);
         if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
         {
             echo $rowSubject["Course"]; 
         }
         ?></td>
      <td> 
         <?php 
            $sqlSubject = "SELECT DISTINCT SubjectName from MasterCourseStructure WHERE SubjectCode ='".$SubjectCode."' AND Isverified='1' and CourseID='".$CourseID."' ";
            $resultSubject = sqlsrv_query($conntest,$sqlSubject);
            if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
            {
                echo $rowSubject["SubjectName"]; 
            }
            ?>
      </td>
      <td><?=$showQuestionData['SubjectCode']?></td>
      <td><?=$showQuestionData['Batch']?></td>
      <td><?=$lockStatusData?></td>
      <td>
         <?php if ($showQuestionData['lock_status']!=0) {
            ?> <i class="fa fa-eye-slash" aria-hidden="true"></i><?php
            }
            else
            { 
                ?>
         <i class="fa fa-eye text-success fa-lg" onclick="view_question('<?=$SubjectCode;?>','<?=$CourseID;?>','<?=$Batch;?>','<?=$Semester;?>')" data-toggle="modal" 
            data-target="#modal-lg-view-question" ></i>
         <?php 
            }
              ?>
      </td>
   </tr>
   <?php
   } 
      }
      ?>
</table>

      <div class="container">
                  <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-body">
                           <table class="table table-condensed table-striped">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>College</th>
                                    <th>Course</th>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                    <th>Batch</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php
                              $sr=0;
                              $sql="Select distinct SubjectCode,CourseID,CollegeID,Batch,Semester from question_bank inner join question_session on question_session.id=question_bank.Exam_Session where lock_status='0' and question_session.session_status='1' order by CollegeID asc, CourseID asc, Batch asc, Semester asc ";
                              $res=mysqli_query($conn,$sql);
                              while($data=mysqli_fetch_array($res))
                              {
                                 $sr++;
                                 $query = "SELECT * from MasterCourseStructure where SubjectCode ='".$data['SubjectCode']."' AND CourseID ='".$data['CourseID']."' AND CollegeID ='".$data['CollegeID']."' AND Batch ='".$data['Batch']."' AND SemesterID ='".$data['Semester']."' AND Isverified='1'  ORDER BY Course";
                                 $result = sqlsrv_query($conntest,$query);
                                 if($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
                                 {
                                    ?>
                                    <tr  data-toggle="collapse" data-target="#table-content-<?=$sr?>" onclick="viewAllQuestions('<?=$sr?>','<?=$data['CollegeID']?>','<?=$data['CourseID']?>','<?=$data['SubjectCode']?>','<?=$data['Batch']?>','<?=$data['Semester']?>')" class="accordion-toggle table-danger">
                                       <td><?=$sr?></td>
                                       <td><?=$row['CollegeName']?></td>
                                       <td><?=$row['Course']?></td>
                                       <td><?=$row['SubjectName']?></td>
                                       <td><?=$data['SubjectCode']?></td>
                                       <td><?=$data['Batch']?></td>
                                       <td><?=$data['Semester']?></td>
                                       <td><i class='fa fa-eye'></i></td>
                                    </tr>
                                    <tr>
                                       <td colspan="8" class="hiddenRow">
                                          <div class="accordian-body collapse" id="table-content-<?=$sr?>">
                                          </div>
                                       </td>
                                    </tr>
                                    <?php
                                 }
                              }
                              ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
      <?php






   }
   elseif($code==156)
      { 
       $SubjectCode=$_POST['subCode'];
        $CourseID=$_POST['courseId'];
         $Batch=$_POST['batch'];
       $Semester=$_POST['sem'];
      $sr=0;
      ?>
      <div class="card-body table-responsive " >
<table class="table" id="example">
   <tr>
      <th>Unit</th>
      <th>Type</th>
      <th>Category</th>
      <th>Total Questions</th>
      <th>Uploaded</th>
      <th>Status</th>
   </tr>
   <?php 
      $question_count_selection="Select * from question_count order by number ASC ";
      $question_count_selection_run=mysqli_query($conn,$question_count_selection);
      while ($question_count_selection_row=mysqli_fetch_array($question_count_selection_run)) 
      {
      ?>
   <?php 
      $sr++;
      $unitCount=intval($question_count_selection_row['number']/100);
      $typeCount=intval(($question_count_selection_row['number']%100)/10);
      $categoryCount=intval($question_count_selection_row['number']%10);
      $question_count_all=$question_count_selection_row['question_count'];
      $sql="SELECT  * from question_bank  where SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' and Semester='$Semester' and Exam_Session='$current_session' and Type='$typeCount' and Category='$categoryCount' and Unit='$unitCount' ";
      $res=mysqli_query($conn,$sql);
      $QUC_count1=mysqli_num_rows($res);
      $QUC_count1;
      $pending="SELECT * FROM question_bank as qb INNER JOIN question_category as qc ON qb.Category=qc.id INNER JOIN question_type as qt ON qb.Type=qt.id WHERE qt.id='$typeCount' and qc.id='$categoryCount'  ";
      $pending_run=mysqli_query($conn,$pending);   
      while($question_pending_row=mysqli_fetch_array($pending_run)) 
      {
      $category_name=$question_pending_row['category_name'];
      $type_name=$question_pending_row['type_name'];
      } 
      ?>
   <tr>
      <?php
         if (($sr-1)%10==0) 
         {
             ?>
      <td rowspan="10" align="center"><?=$unitCount;?></td>
      <?php 
         }
         if (($sr>=1 && $sr<=5) || ($sr>=11 && $sr<=15) || ($sr>=21 && $sr<=25) || ($sr>=31 && $sr<=35)  ) 
         {
             if (($sr-1)%5==0) {
         ?>
      <td rowspan="5"><?=$type_name;?></td>
      <?php
         } 
         }
         elseif (($sr>=6 && $sr<=8) || ($sr>=16 && $sr<=18) || ($sr>=26 && $sr<=28) || ($sr>=36 && $sr<=38)  ) 
         {
              if (($sr-1)%5==0) {
         ?>
      <td rowspan="3"><?=$type_name;?></td>
      <?php 
         }
         }
         elseif (($sr>=9 && $sr<=10) || ($sr>=19 && $sr<=20) || ($sr>=29 && $sr<=30) || ($sr>=39 && $sr<=40)  ) 
         {
              if (($sr+1)%2==0) {
         ?>
      <td rowspan="2"><?=$type_name;?></td>
      <?php 
         }
         }
         ?>
      <td><?=$category_name;?></td>
      <td><?=$question_count_all;?></td>
      <td><?=$QUC_count1;?></td>
       <td><?php 
    if($question_count_all<=$QUC_count1) 
    {
       echo '<i class="fa fa-check" aria-hidden="true" style="color:green;"></i>';  
   } 
      else
      {
    echo '<i class="fa fa-hourglass-end" aria-hidden="true" style="color:red;"></i>'; 
      } ?></td>
   </tr>
   <?php 
      }
      ?>
</table>
</div>
<?php 
   }
    elseif($code==157)
   {
      ?>
      <option value="">Select</option>
      <?php 
      $gatePassQry="SELECT * from gate_entry_qr";
      $gatePassRes=mysqli_query($conn,$gatePassQry);
      while($gatePassData=mysqli_fetch_array($gatePassRes))
      {
         $gatePassCheckQry="SELECT * from gate_entry_visitor where status='0' and gate_pass_no=".$gatePassData['id'];
         $gatePassCheckRes=mysqli_query($conn,$gatePassCheckQry);
         if (mysqli_num_rows($gatePassCheckRes)<1) 
         {
         ?>
            <option value="<?=$gatePassData['id']?>"><?=$gatePassData['id']?></option>
         <?php
         }
      }
   }

      elseif($code==158)
   {
      $code_access=$_POST['code_access'];
      ?>
<label>Subject Code<b style="color:red;">*</b></label>
                        <div class="input-group">
                           <Input type="text"  class="form-control subject_code"  name="subject_code" id="subject_code1"  required="" />
                           <!-- <input type="button" name="" value="Search" id="subject_code_search"> -->
                           <button class="btn btn-success" onclick="subject_code_search_lock()"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="card-body table-responsive " id="table_load_lock">
                           <table class="table" id="example1">
   <thead>
      <tr>
         <th>#</th>
         <th>Course Name</th>
         <th>Subject Name</th>
         <th>Subject Code</th>
         <th>Batch</th>
         <th>Questions</th>
         <th>View</th>
      </tr>
   </thead>
   <tbody>
   <?php 
      $sr=0;
       $get_session="SELECT * FROM question_session where session_status='1'";
      $get_session_run=mysqli_query($conn,$get_session);
      if ($get_row=mysqli_fetch_array($get_session_run))
       {
      $current_session=$get_row['id'];    // code...
      }
   
          $showQuestionQry="SELECT Distinct SubjectCode,CourseID,Batch,Semester,lock_status,count(*) as totalQuestions FROM question_bank AS qb INNER JOIN question_category AS qc ON qb.Category=qc.id INNER JOIN
                      question_type AS qt ON qb.`Type`=qt.id INNER JOIN question_session as qs ON qb.Exam_Session=qs.id WHERE UpdatedBy='$EmployeeID' and qs.session_status='1' group by SubjectCode,CourseID,Batch,Semester ";
                         $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                         while($showQuestionData=mysqli_fetch_array($showQuestionRun))
                         {
                            $CourseID=$showQuestionData['CourseID'];
                          $SubjectCode=$showQuestionData['SubjectCode'];
                          $Batch=$showQuestionData['Batch'];
                          $Semester=$showQuestionData['Semester'];
                          
                          // $question_count_selection="Select * from question_count ";
                          // $question_count_selection_run=mysqli_query($conn,$question_count_selection);
                          
                       
                          //   $qry="SELECT  * from question_bank  where SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' and Exam_Session='$current_session' and lock_status=0 ";
                          // $run=mysqli_query($conn,$qry);
                          // if(mysqli_num_rows($run)>0)
                          // {
                          //     // $lockStatusData="<i onclick=lockQuestions('$SubjectCode','$CourseID','$Batch','$Semester') class='fa fa-lock-open text-success'></i>";
                          //  $lockStatusData='<i onclick="lockQuestions('."'$SubjectCode'".','."$CourseID".','."$Batch".','."$Semester".')" class="fa fa-lock-open text-success"></i>';
                          // }
                          // else
                          // {
                          //     $lockStatusData="<i class='fa fa-lock text-danger'></i>";
                          // }
                         //  while ($question_count_selection_row=mysqli_fetch_array($question_count_selection_run)) 
                         //  {
                             
                         //      $question_count_all=$question_count_selection_row['question_count'];
                         // $unitCount=intval($question_count_selection_row['number']/100);
                         // $typeCount=intval(($question_count_selection_row['number']%100)/10);
                         // $categoryCount=intval($question_count_selection_row['number']%10);
                         //  $sql="SELECT  * from question_bank  where SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' and Semester='$Semester' and Exam_Session='$current_session' and Type='$typeCount' and Category='$categoryCount' and Unit='$unitCount' ";
                         //  $res=mysqli_query($conn,$sql);
                         //  $QUC_count1=mysqli_num_rows($res);
                         //  // echo ' Q= '.$QUC_count1;
                         //  if ($QUC_count1<$question_count_all) 
                         //  {
                         //      $lockStatusData="<b style='color:red;'>Questions Pending</b>";
                 
                         //  }
      
      
                         //  }
      
                           
          $sr++;
          ?>
   <tr>
      <td><?=$sr?></td>
      <td>  <?php 
         $sqlSubject = "SELECT DISTINCT Course from MasterCourseStructure WHERE SubjectCode ='".$SubjectCode."' AND Isverified='1' and CourseID='".$CourseID."' ";
         $resultSubject = sqlsrv_query($conntest,$sqlSubject);
         if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
         {
             echo $rowSubject["Course"]; 
         }
         ?></td>
      <td> 
         <?php 
            $sqlSubject = "SELECT DISTINCT SubjectName from MasterCourseStructure WHERE   SubjectCode ='".$SubjectCode."' AND Isverified='1' and CourseID='".$CourseID."' ";
            $resultSubject = sqlsrv_query($conntest,$sqlSubject);
            if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
            {
                echo $rowSubject["SubjectName"]; 
            }
            ?>
      </td>
      <td><?=$showQuestionData['SubjectCode']?></td>
      <td><?=$showQuestionData['Batch']?></td>
      <td>
         <?php
               if ($showQuestionData['totalQuestions']>=130) 
               {
                  if ($showQuestionData['lock_status']==0) 
                  {
                     ?>
                        <i onclick="lockQuestions('<?=$SubjectCode?>','<?=$CourseID?>','<?=$Batch?>','<?=$Semester?>')" class="fa fa-lock-open text-success"></i>
                     <?php
                  }
                  else
                  {
                     ?>
                        <i class="fa fa-lock text-danger"></i>
                     <?php
                  }
                  ?>

                  <?php
                  
               }
               else
               {
                  echo $showQuestionData['totalQuestions'];      
               }
         ?>   
         </td>
      <!-- <td><?=$lockStatusData?></td> -->
      <td>
         <?php if ($showQuestionData['lock_status']!=0) {
            ?> <i class="fa fa-eye-slash" aria-hidden="true"></i><?php
            }
            else
            { 
                ?>
         <i class="fa fa-eye text-success fa-lg" onclick="view_question('<?=$SubjectCode;?>','<?=$CourseID;?>','<?=$Batch;?>','<?=$Semester;?>')" ></i>
         <?php 
            }
              ?>
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
   elseif($code==159)
   {
      $code_access=$_POST['code_access'];
      ?>
               <div class="row">
                  <!-- left column -->
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Subject Code<b style="color:red;">*</b></label>
                     <Input type="text"  class="form-control subject_code" onchange="load_course()"  name="subject_code" id="subject_code"  required="" />
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Course<b style="color:red;">*</b></label>
                     <select name="Course" id="Course" class="form-control" >
                        <option value=''>Select Course</option>
                     </select>
                  </div>
                 
                  <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Batch<b style="color:red;">*</b></label>
                     <select name="batch"  class="form-control" id="Batch" required="" onchange="">
                        <option value="">Batch</option>
                        <?php 
                           for($i=date('Y', strtotime('-6 year'));$i<=date('Y', strtotime('+0 year'));$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <div class="col-lg-1 col-md-4 col-sm-3">
                     <label> Semester<b style="color:red;">*</b></label>
                     <select   id='Semester' class="form-control" required="" onchange="">
                        <option value="">Sem</option>
                        <?php 
                           for($i=1;$i<=12;$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                  <div class="col-lg-1 col-md-4 col-sm-3">
                     <label>Unit<b style="color:red;">*</b></label>
                     <select  id='unit' class="form-control" required="" onchange="">
                        <option value="">Select</option>
                        <?php 
                           for($i=1;$i<=4;$i++)
                           {?>
                        <option value="<?=$i?>"><?=$i?></option>
                        <?php }
                           ?>
                     </select>
                  </div>
                   <div class="col-lg-2 col-md-4 col-sm-3">
                     <label>Type<b style="color:red;">*</b></label>
                     <select id='type' class="form-control" required="" onchange=" drop_category();">
                        <option value="">Select</option>
                        <?php
                           $questionTypeQry="SELECT * FROM question_type";
                           $questionTypeRes=mysqli_query($conn,$questionTypeQry);
                           while($questionTypeData=mysqli_fetch_array($questionTypeRes))
                           {
                              ?>
                        <option value="<?=$questionTypeData['id']?>"><?=$questionTypeData['type_name']?></option>
                        <?php
                           }
                           ?>
                     </select>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-3">
                      <label>Action<b style="color:red;"></b></label>
                      <button class="form-control btn btn-success" id="subject_code_search" onclick="subject_code_search_update()">Search</button>
                  </div>
                  <!-- /.row -->
               </div>
<!-- <label>Subject Code<b style="color:red;">*</b></label>
                        <div class="input-group">
                           <Input type="text"  class="form-control subject_code"  name="subject_code" id="subject_code"  required="" />
                       
                           <button class="btn btn-success" id="subject_code_search"><i class="fa fa-search"  onclick="subject_code_search_update()"></i></button>
                        </div> -->
                        <div id="table_load">
                           <div class="card-body table-responsive ">
                              <table class="table" id="example">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Question</th>
                                       <th>Type</th>
                                       <th>Category</th>
                                       <th>Batch</th>
                                       <th>Sem</th>
                                      <!--  <th>Course</th> -->
                                       <th>Subject Name</th>
                                       <th>Subject Code</th>
                                      
                                       <th>Action</th>
                                    </tr>
                                 </thead >
                                 <tbody >
                                    <?php 
                                       $srno=1;
                                          $showQuestionQry="SELECT * FROM question_bank AS qb INNER JOIN question_category AS qc ON qb.Category=qc.id INNER JOIN
                                       question_type AS qt ON qb.`Type`=qt.id INNER JOIN question_session as qs ON qb.Exam_Session=qs.id  WHERE UpdatedBy='$EmployeeID' and lock_status='0' and qs.session_status='1' order by qb.Id  DESC LIMIT 0   ";
                                          $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                                          while($showQuestionData=mysqli_fetch_array($showQuestionRun))
                                          {
                                             $CourseID=$showQuestionData['CourseID'];
                                           $SubjectCode=$showQuestionData['SubjectCode'];
                                           
                                           
                                       $sql = "SELECT DISTINCT Course,CourseID,SubjectName from MasterCourseStructure WHERE CourseID ='$CourseID'and SubjectCode ='$SubjectCode' AND Isverified='1'  ORDER BY Course ";
                                       $result = sqlsrv_query($conntest,$sql);
                                       if($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
                                       {
                                       $CourseName=$row["Course"]; 
                                       $SubjectName=$row["SubjectName"]; 
                                       }
                                       
                                             ?>
                                    <tr>
                                       <td><?=$srno;?></td>
                                         <?php 
                                         if ($code_access=='010' || $code_access=='011' || $code_access=='110' || $code_access=='111') 
                                          {
            ?><td data-toggle="modal" data-target="#modal-lg" onclick="update_question(<?=$showQuestionData['Id']?>);"><?=$showQuestionData['Question']?></td>

                                   <?php }
                                   else
                                       {?>
                                       <td> <?=$showQuestionData['Question']?></td>
                                  <?php }?>
                                       <td><?=$showQuestionData['type_name']?></td>
                                       <td><?=$showQuestionData['category_name']?></td>
                                       <td><?=$showQuestionData['Batch']?></td>
                                        <td><?=$showQuestionData['Semester']?></td>
                                    <!--    <td><?=$CourseName;?></td> -->
                                       <td><?=$SubjectName;?></td>
                                       <td><?=$showQuestionData['SubjectCode']?></td>
                                   
                                       <td>
                                            <?php   
                                            if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                            { 
                                             ?>
                                          <i class="fa fa-upload" data-toggle="modal" data-target="#modal-lg-image"  onclick="upload_image_question(<?=$showQuestionData['Id']?>);" style="color:red;"></i>
                                       <?php 
                                        }
                                           
                                           if ($code_access=='001' || $code_access=='011' || $code_access=='101' || $code_access=='111') 
                                            { 
                                             ?>

                                             &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash" onclick="delete_question(<?=$showQuestionData['Id']?>);"></i>
                                   <?php  }
                                  ?>
                                       </td>
                                    </tr>
                                    <?php 
                                       $srno++;
                                       }?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
   <?php }

   elseif($code==160)
   {
      $articleID=$_POST['articleID'];
      $flag=0;
      $articleStatus='aa';
       $sql="SELECT *,stock_summary.status as stockStatus FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID where stock_summary.IDNo='$articleID' and category_permissions.employee_id='$EmployeeID'";
      $res=mysqli_query($conn,$sql);
      if ($data=mysqli_fetch_array($res)) 
      {
         $articleStatus=$data['stockStatus'];
         if ($articleStatus==0) 
         {
            
         }
      }
      else
      {
         $flag=1;
      }
         $response[] = array("flag"=>$flag,"status"=>$articleStatus);
         echo json_encode($response);



      // $category="SELECT * FROM category_permissions where employee_id='$EmployeeID'";
      // $category_run=mysqli_query($conn,$category);
      // while ($category_row=mysqli_fetch_array($category_run)) 
      // { 
      //   $cat_id_array[]=$category_row['CategoryCode'];
      // }
      // $arrayCatCount=count($cat_id_array);
      // for($k=0;$k<$arrayCatCount;$k++)
      // {
      //   $cat_id=$cat_id_array[$k];
      //   $building="  SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode  where stock_summary.Status='2' and location_master.ID='$location_ID' AND master_article.CategoryCode='$cat_id' and stock_summary.IDNo like '%$ArticleQrID%' order by IDNo DESC ";
      //   $building_run=mysqli_query($conn,$building);
      //   while ($building_row=mysqli_fetch_array($building_run)) 
      //   {
      //       $EmployeeID=$building_row['Corrent_owner'];
      //       $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$EmployeeID'";
      //       $q1 = sqlsrv_query($conntest, $sql1);
      //       while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
      //       {
      //          $name = $row['Name'];
      //       }
      //       $building_num=$building_num+1;
      //    }
      // }
   }
   elseif($code=='161')
   {   
   $count=0;
   $building=$_POST['building'];
   $floor=$_POST['floor'];
   $room=$_POST['room'];
   if ($building!='' && $floor=='' && $room=='') 
   {
      $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode where ArticleName='Bed'and Block='$building'";
   }
   elseif ($building!='' && $floor=='' && $room!='') 
   {
       $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode where ArticleName='Bed'and Block='$building' and RoomNo='$room'";
   }
   elseif ($building!='' && $floor!='' && $room=='') 
   {
       $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode where ArticleName='Bed'and Block='$building' and Floor='$floor'";
   }
   elseif ($building!='' && $floor!='' && $room!='') 
   {
       $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner JOIN master_article  on master_article.ArticleCode=stock_summary.ArticleCode where ArticleName='Bed'and Block='$building' and RoomNo='$room' and Floor='$floor'";
   }
   
   ?>
<table class="table">
   <thead>
      <tr>
         <th>Sr. No.</th>
         <th>Name</th>
         <!-- <th>Class/Uni Roll No.</th> -->
         <th>Father Name</th>
         <th>Contact No.</th>
         <th>Designation</th>
         <th>Department</th>
         <th>Room No.</th>
         <th>Bed No.</th>
         <th>Image</th>
         <!-- <th>Checked In </th> -->
       
      </tr>
   </thead>
   <?php
      $res=mysqli_query($conn,$sql);
      while($data=mysqli_fetch_array($res))
      {
          $IDNo=$data['Corrent_owner'];
          $result1 = "SELECT  * FROM Staff where IDNo='$IDNo'";
          $stmt1 = sqlsrv_query($conntest,$result1);
          while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
          {
              $IDNo= $row['IDNo'];
             
              $img= base64_encode($row['Snap']);
             
              $name = $row['Name'];
              $father_name = $row['FatherName'];
               $designation = $row['Designation'];
              $email = $row['EmailID'];
              $phone = $row['MobileNo'];
              $department = $row['Department'];
              $college = $row['CollegeName'];
          
          $sql1="SELECT * from hostel_student_summary where status='0' and student_id='$IDNo'";
          $res1=mysqli_query($conn,$sql1);
          while($data1=mysqli_fetch_array($res1))
          {
              $locationID=$data1['location_id'];
          }
      
          $count++;
          ?>
   <tr>
      <td><?=$count?></td>
      <td><?=$name?></td>
      <!-- <td><?= $ClassRollNo ;?>/<?= $UniRollNo ;?></td> -->
      <td><?=$father_name?></td>
      <td><?=$phone?></td>
      <td><?=$designation?></td>
      <td><?=$department?></td>
      <td><?=$data['RoomNo']?></td>
      <td><?=$data['IDNo']?></td>
      <td>
         <center><img src="data:image/jpeg;base64,<?=$img?>" height="50" width="50" class="img-thumnail"  style="border-radius:50%"/></center>
      </td>
      <!-- <td><?=$data['issue_date']?></td> -->
   </tr>
   <?php
}
      }
      ?>
</table>
<?php
   }
   elseif($code==168)
   {
      $roomNo=$_POST['roomNo'];
      $floor=$_POST['floor'];
      $building=$_POST['building'];
      $sql="SELECT * FROM location_master where Floor='$floor' and RoomNo='$roomNo' and Block='$building' ";
      $res=mysqli_query($conn,$sql);
      if ($data=mysqli_fetch_array($res)) 
      {
         echo $data['location_owner'].",".$data['ID'];
      }
   }
 elseif($code==169)
   {
      $empID=$_POST['emp'];
      $flag=0;
      $query = "SELECT * FROM Staff Where IDNo='$empID' and JobStatus='1'";
       $result = sqlsrv_query($conntest,$query);
       while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
       {
         $flag=1;
       }
       echo $flag;
   }
elseif($code==170)
{
   $id=$_POST['articleID'];
   $sql="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode where   IDNo='$id'";
   $result = mysqli_query($conn,$sql);
   $array = array();
   $a=0;
   while($row=mysqli_fetch_array($result))
   {
      $a++;
      $array[] = $row;
   }
   
   for ($i=0; $i<$a; $i++)
   { 
      $emp_id=$array[$i]['Corrent_owner'];
      $category=$array[$i]['ArticleName'];
      $working=$array[$i]['WorkingStatus'];
      $issue_date=$array[$i]['IssueDate'];
      $description=$array[$i]['CPU'].' '.$array[$i]['Brand'].' '.$array[$i]['Model'].' '.$array[$i]['DeviceSerialNo'];
      if ($working=='0'||$working=='') 
      {
         $remarks='Working';
      }
      elseif ($working=='1') 
      {
         $remarks='Faulty';
      }
   }
   $sql1="SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$emp_id'";
   $q1 = sqlsrv_query($conntest,$sql1);
   while($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC) )
   {
      $name=$row['Name'];
      $Department=$row['Department'];
      $Designation=$row['Designation'];
      $CollegeName=$row['CollegeName'];
      $img= $row['Snap'];
      $pic = 'data://text/plain;base64,' . base64_encode($img);
   }   
   $location_num=0;
   ?>
   <div class="card-body table-responsive p-0" style="height: 100%;">
      <?php 
      $id=$_POST['articleID'];
      $location="SELECT *, lm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName  WHERE ss.IDNo='$id'";
         $location_run=mysqli_query($conn,$location);
         if ($location_row=mysqli_fetch_array($location_run)) 
         {
          $location_num=$location_num+1;
          $sql1 = "SELECT * FROM Staff Where IDNo='".$location_row['Corrent_owner']."'";
         $q1 = sqlsrv_query($conntest, $sql1);
         if ($row1 = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
         {
            $img= $row1['Snap'];
            $pic = 'data://text/plain;base64,' . base64_encode($img);
         
      ?>
   <table class="table table-head-fixed text-nowrap" border="0" style="border: 2px solid black;">
      <tr>
         <td>Employee ID: </td>
         <th><?=$location_row['Corrent_owner'];?></th>
         <td>Name: </td>
         <th> <?=$row1['Name'];?></th>
         <td rowspan="2" style="text-align: right;">
            <img src="<?= $pic; ?>" width="100" height="130" border="1">
         </td>
      </tr>
      <tr>
         <td>Designation: </td>
         <th><?=$row1['Designation'];?></th>
         <td>Department: </td>
         <th><?=$row1['Department'];?></th>
      </tr>
   </table>
    <label>Location</label>
    <table class="table table-head-fixed text-nowrap" border="1" style="border: 2px solid black;">
      <thead>
         <tr>
           
            <th>Block</th>
            <th>Floor</th>
            <th>Room No</th>
            <th>Room Type</th>
            <th>Room Name</th>
            
         </tr>
      </thead>
      <tbody>
         <tr>
            
            <td>
               <?=$location_row['Name'];?>
            </td>
            <td>
               <?=$location_row['Floor'];?>
            </td>
            <td>
               <?=$location_row['abc'];?>
            </td>
            <td>
               <?=$location_row['RoomType'];?>
            </td>
            <td>
               <?=$location_row['RoomName'];?>
            </td>
            
         </tr>
      </tbody>
   </table>
   <label>Particular's Description(<?=$id?>)</label>
   <table class="table table-head-fixed text-nowrap" border="1" style="border: 2px solid black;">
      <thead>
         <tr>
            <th>Article </th>
            <th>View</th>
            <th>Brand</th>
            <th>OS</th>
            <th>Model</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>
               <?=$location_row['ArticleName'];?>
            </td>
            <td>
               <?=$location_row['CPU'];?>
            </td>
            <td>
               <?=$location_row['Brand'];?>
            </td>
            <td>
               <?=$location_row['OS'];?>
            </td>
            <td>
               <?=$location_row['Model'];?>
            </td>
         </tr>
         <?php
      }
            }
            ?>
      </tbody>
   </table>
   <br>
   <div class="row">
      <div class="col-lg-6"></div>
      <div class="col-lg-2 col-sm-2 col-md-2">
         <button class="btn btn-success form-control" data-toggle="modal" onclick="updateModalFunction(<?=$id?>,'update-stock.php')" data-target="#update_modal">Update</button>
      </div>
      <div class="col-lg-2 col-sm-2 col-md-2">
         <button class="btn btn-warning form-control" data-toggle="modal" onclick="reAssignModal(<?=$id?>)" data-target="#returnModal">Owner Change</button>
      </div>
      <div class="col-lg-2 col-sm-2 col-md-2">
         <button class="btn btn-danger form-control" data-toggle="modal" onclick="returnModal(<?=$id?>)" data-target="#returnModal">Return</button>
      </div> 
   </div>
   
  
</div>
<?php
}
elseif($code==171)
{
   $id=$_POST['articleID'];
   ?>
   <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Return (<?=$id?>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      
<div class="row" >
      <div class="col-lg-6">
         <label>Remarks</label>
         <input type="text" id="returnRemark" class="form-control" required>
      </div>
      <div class="col-lg-3">
         <label>Status</label>
         <select id="workingStatus" class="form-control" required>
            <option value="">Select</option>
            <option value="0">Working</option>
            <option value="1">Faulty</option>
         </select>
      </div>
      <div class="col-lg-3">
         <label>&nbsp;</label>
         <button type="submit" data-dismiss="modal" class="form-control btn-danger btn" onclick="returnSubmit(<?=$id?>)">Return</button>
      </div>
   </div>
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
<?php
}
elseif($code==172)
{
   $id=$_POST['articleID'];
   ?>
   <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Owner Change (<?=$id?>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      
<div class="row" >
      <div class="col-lg-8">
         <label>Employee ID </label>
         <input type="number" name="Employee_ID" id="Employee_ID" class="form-control" onkeyup="emp_detail_verify(this.value);">
         <p id="emp_detail_status_"></p>
         
      </div>
      <div class="col-lg-4 col-sm-3 col-md-3">
         <label>&nbsp;</label>
         <button type="submit" data-dismiss="modal" class="form-control btn-danger btn" onclick="re_assign(<?=$id?>)">Change Owner</button>
      </div>
   </div>
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
<?php
}
elseif($code==173)
{
   $flag=0;
   $articleID = $_POST['articleID'];
   $emp_id = $_POST['current_owner'];
   $sql1 = "SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$emp_id' and JobStatus='1'";
   $q1 = sqlsrv_query($conntest, $sql1);
   if ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
   {
      $flag=1;
      $sql="SELECT * FROM stock_summary  where IDNo='$articleID'";
      $result = mysqli_query($conn,$sql);
      $date=date('Y-m-d');
      while($data=mysqli_fetch_array($result))
      {
         $currentOwner=$data['Corrent_owner'];
         $currentLocation=$data['LocationID'];
         $deviceSerialNo=$data['DeviceSerialNo'];
         $workingStatus=$data['WorkingStatus'];
         $referenceNo=$data['reference_no'];
         $qry="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$articleID', '$date', 'Returned', '$currentLocation', '$currentOwner', 'Owner Change by $EmployeeID', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
         $res=mysqli_query($conn,$qry);
         if ($res) 
         {
            $updateQry="UPDATE stock_summary SET Corrent_owner='',reference_no=''  WHERE IDNo='$articleID'";
            mysqli_query($conn,$updateQry);
         }
      }                  
      $datetime   = new DateTime(); //this returns the current date time
      $one=date("His");
      $two= date("myd");
      $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
      $four=substr(str_shuffle($one.$two.$three),1,8);
      $result =$one.$three.$two.$four;
      $updateCurrentOwner = "UPDATE  stock_summary SET Corrent_owner='$emp_id' , reference_no='$result' where IDNo='$articleID'";
      $building_run = mysqli_query($conn, $updateCurrentOwner);
      if ($building_run==true) 
      {
         $sql2="SELECT * FROM stock_summary  where IDNo='$articleID'";
         $result2 = mysqli_query($conn,$sql2);
         $date=date('Y-m-d');
         while($data=mysqli_fetch_array($result2))
         {
            $currentOwner=$data['Corrent_owner'];
            $currentLocation=$data['LocationID'];
            $deviceSerialNo=$data['DeviceSerialNo'];
            $workingStatus=$data['WorkingStatus'];
            $referenceNo=$data['reference_no'];
            $id=$data['IDNo'];
            $qry2="INSERT INTO stock_description ( IDNO, Date_issue, Direction, LocationID, OwerID, Remarks, WorkingStatus, DeviceSerialNo, Updated_By, reference_no) VALUES ('$id', '$date', 'Issued', '$currentLocation', '$currentOwner', 'Owner Change by $EmployeeID', '$workingStatus', '$deviceSerialNo', '$EmployeeID','$referenceNo')";
            $res=mysqli_query($conn,$qry2);
         }
      }
   }  
   echo $flag;      
}
elseif ($code==174) 
{
   $userId=$_POST['userId'];
   $date=date('Y-m-d');
   // echo strlen($userId);
   if (strlen($userId)>=7) 
   {
      $result1 = "SELECT  * FROM Admissions where UniRollNo='$userId' or ClassRollNo='$userId' or IDNo='$userId'";
      $stmt1 = sqlsrv_query($conntest,$result1);
      if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
      {
        $IDNo= $row['IDNo'];
         $StudentName = $row['StudentName'];
         $img= $row['Snap'];
      $pic = 'data://text/plain;base64,' . base64_encode($img);
        $qry="SELECT * from computer_lab_entry where UserID='$IDNo' and status='0' and entry_time like '$date%'";
        $run=mysqli_query($conn,$qry);
        if (mysqli_num_rows($run)<1) 
        {
           // code...
        
         $ClassRollNo= $row['ClassRollNo'];
         $UniRollNo= $row['UniRollNo'];
         $father_name = $row['FatherName'];
         $course = $row['Course'];
         $email = $row['EmailID'];
         $phone = $row['StudentMobileNo'];
         $batch = $row['Batch'];
         $college = $row['CollegeName'];
         $courseShortName = $row['CourseShortName'];
         ?>
         <div class="row">
            <div class="col-lg-11">
               
         <div class="row">
            <div class="col-lg-3">
               <label>Student Name</label>
               <input type="text" value="<?=$row['StudentName'];?>" class="form-control" readonly=""> 
            </div>
            <div class="col-lg-3">
               <label>Father Name</label>
               <input type="text" value="<?=$row['FatherName'];?>"class="form-control" readonly=""> 
            </div>
            <div class="col-lg-6">
               <label>College Name</label>
               <input type="text" value="<?=$row['CollegeName'];?>"class="form-control" readonly="">  
            </div>
            <div class="col-lg-3">
               <label>Course</label>
               <input type="text" value="<?=$row['Course'];?>"class="form-control" readonly="">  
            </div>
            <div class="col-lg-3">
               <!-- <input type="hidden"  value="<?= date('Y-m-d');?>" class="form-control" required="" > -->
               <label>System Number</label>
               <input type="text" class="form-control" id="systemNumber" placeholder="System Number" required="">
            </div>
            <div class="col-lg-3">
               <label>Remarks</label>
               <input type="text" class="form-control" id="remarks" placeholder="Remarks" required="">
            </div>
            <div class="col-lg-3">
               <label>&nbsp;</label>
               <button class="btn btn-primary form-control" onclick="assignSystem(<?=$row['IDNo']?>)">Submit</button>
            </div>
         </div>
            </div>
            <div class="col-lg-1">
               <img src="<?=$pic?>" width='100px' height='100%'>
            
            </div>
         </div>
                  <?php
      }
      else
      {
        if ($dataUser=mysqli_fetch_array($run)) 
         {
         ?>
         
            <div class="card card-widget collapsed-card">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="<?=$pic?>" alt="User Image">
                  <span class="username"><?=$StudentName?> (Already Assigned)</span>
                  <span class="username">System No.- <?=$dataUser['system_number']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entry Time - <?=date('H:i A',strtotime($dataUser['entry_time']))?> Today</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                 <i onclick="checkOutLab(<?=$dataUser['id']?>)" class='fa fa-sign-out-alt' style='font-size: 23px;'></i>
                </div>
              </div>
              <div class="card-body">
                
              </div>
              <div class="card-footer card-comments">
                
               
              </div>
              <div class="card-footer">
                
              </div>
            </div>
          
         <?php
         // echo $userName." Already Assigned";
      }
      }
     
      }
      else
      {
         echo 'Not valid Input';
      }
   }
   else
   {
      $sql1 = "SELECT * FROM Staff Where IDNo='$userId'";
      $q1 = sqlsrv_query($conntest, $sql1);
      if ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
      {
         $IDNo= $row['IDNo'];
         $userName = $row['Name'];
         $img= $row['Snap'];
      $pic = 'data://text/plain;base64,' . base64_encode($img);
         $qry="SELECT * from computer_lab_entry where UserID='$IDNo' and status='0' and entry_time like '$date%'";
        $run=mysqli_query($conn,$qry);
        if (mysqli_num_rows($run)<1) 
        {
         $fatherName = $row['FatherName'];
         $CollegeName = $row['CollegeName'];
         $Designation = $row['Designation'];
         $EmailID = $row['EmailID'];
         $ContactNo = $row['ContactNo'];
         if ($ContactNo=='') 
         {
            $ContactNo = $row['MobileNo'];
         }
         ?>
         <div class="row">
            <div class="col-lg-11">  
         <div class="row">
            <div class="col-lg-3">
               <label>Employee Name</label>
               <input type="text"  value="<?=$row['Name'];?>" class="form-control" readonly="">
            </div>
            <div class="col-lg-3">
               <label>Department</label>
               <input type="text"  value="<?=$row['Department'];?>"class="form-control" readonly=""> 
            </div>
            <div class="col-lg-3">
               <label>Designation</label>
               <input type="text"  value="<?=$row['Designation'];?>"class="form-control" readonly="">   
            </div>
            <div class="col-lg-3">
               <label>College Name</label>
               <input type="text"  value="<?=$row['CollegeName'];?>"class="form-control" readonly="">  
            </div>
            <div class="col-lg-3">
               <label>Contact No.</label>
               <input type="text"  value="<?=$ContactNo;?>"class="form-control" readonly="">   
            </div>
            <div class="col-lg-3">
               <label>System Number</label>
               <input type="text"  class="form-control" id="systemNumber" placeholder="System Number" required="">
            </div>
            <div class="col-lg-3">
               <label>Remarks</label>
               <input type="text"  class="form-control" id="remarks" placeholder="Remarks" required="">
            </div>
            <div class="col-lg-3">
               <label>&nbsp;</label>
               <button class="btn btn-primary form-control" onclick="assignSystem(<?=$row['IDNo']?>)" >Submit</button>
            </div>
         </div>
            </div>
            <div class="col-lg-1">
               <img src="<?=$pic?>" width='100px' height='100%'>
            
            </div>
         </div>
         <?php
      }
      else
      {
         if ($dataUser=mysqli_fetch_array($run)) 
         {
         ?>
         
            <div class="card card-widget collapsed-card">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="<?=$pic?>" alt="User Image">
                  <span class="username"><?=$userName?> (Already Assigned)</span>
                  <span class="username">System No.- <?=$dataUser['system_number']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Entry Time - <?=date('H:i A',strtotime($dataUser['entry_time']))?> Today</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                  <i onclick="checkOutLab(<?=$dataUser['id']?>)" class='fa fa-sign-out-alt' style='font-size: 23px;'></i>

                </div>
              </div>
              <div class="card-body">
                
              </div>
              <div class="card-footer card-comments">
                
               
              </div>
              <div class="card-footer">
                
              </div>
            </div>
          
         <?php
         // echo $userName." Already Assigned";
      }
      }
      }
      else
      {
         echo 'Not valid Input';
      }
   }

}

elseif ($code==175) 
{
   $userId=$_POST['id'];
   $systemNo=$_POST['systemNo'];
   $remarks=$_POST['remarks'];
   $sql="INSERT INTO computer_lab_entry (UserID, system_number, remarks, entry_time, status) VALUES ('$userId', '$systemNo', '$remarks', '$timeStamp', '0')";
   $res=mysqli_query($conn,$sql);
   if ($res==true) 
   {
      echo "Success";
   }

}
elseif ($code==176) 
{
   $date=date('Y-m-d');

   ?>
   <table class="table  " id="example">  <thead>
              <tr>
                  <th>#</th>
                 <th>Image</th>
                 <th>IDNo</th>
                  <th>Name</th>
                  <th>Course / Department</th>
                <th>College</th>
                <th>System Number</th>
                  <th>Entry Time</th>
                  <th>Exit Time</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM computer_lab_entry  where entry_time like '$date%' ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    if (strlen($row['UserID'])>=7) 
                    {
                        $result1 = "SELECT  * FROM Admissions where UniRollNo='".$row['UserID']."' or ClassRollNo='".$row['UserID']."' or IDNo='".$row['UserID']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $college = $row1['CollegeName'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);
                        }
                    }
                    else
                    {
                        $sql1 = "SELECT * FROM Staff Where IDNo='".$row['UserID']."'";
                        $q1 = sqlsrv_query($conntest, $sql1);
                        if ($row1 = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
                        {

                           $userId.= $row1['IDNo'];
                           $name = $row1['Name'];
                           $fatherName = $row1['FatherName'];
                           $college = $row1['CollegeName'];
                           $Designation = $row1['Designation'];
                           $Department = $row1['Department'];
                           $EmailID = $row1['EmailID'];
                           $ContactNo = $row1['ContactNo'];
                           if ($ContactNo=='') 
                           {
                              $ContactNo = $row1['MobileNo'];
                           }
                           $img= $row1['Snap'];
                        $pic = 'data://text/plain;base64,' . base64_encode($img);
                        }
                    }
                    if($row["status"] == "1")
                    {
                     ?>
                      <tr style='background:#98FF98; height:30px;'>
                        <?php
                     }
                    else
                    {
                     ?>
                      <tr style='background:#E3F9A6;height:30px;'>
                        <?php
                     }
                     ?>
                      <td><?=$count++?></td>
                       <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"  alt="User Avatar"></td>
                       <td><?=$userId?></td>
                       <td><?=$name?></td>
                       <td><?=$Department?></td>
                       <td><?=$college?></td>
                    <td><?=$row['system_number']?></td>
                      <td><?=$row['entry_time']?></td>
                      <?php
                       if($row["status"] == "1")
                    {
                     ?>
                     <td><?=$row['exit_time']?></td>
                      <td><b>Checked Out</b></td>
                        <?php
                     }
                    else
                    {
                     ?>
                      <td></td>
                      <td><i onclick="checkOutLab(<?=$row['id']?>)" class='fa fa-sign-out-alt'></i></td>
                        <?php
                     }
                     ?>

                      
                  </tr>
                      <?php
                  }
                }
            ?>
          </tbody>
        </table>
   <?php

}
elseif ($code==177) 
{
   $id=$_POST['id'];
   
   $sql="UPDATE computer_lab_entry set exit_time='$timeStamp', status='1' where id='$id'";
   $res=mysqli_query($conn,$sql);
   if ($res==true) 
   {
      echo "Success";
   }

}
elseif ($code==178) 
{ 
$name = $_POST['name'];
$father= $_POST['father'];
$Classroll = $_POST['Classroll'];
$college=$_POST['college'];
$course =  $_POST['course'];
$contact = $_POST['contact'];
$valid = $_POST['valid'];
$batch = $_POST['batch'];
$dob = $_POST['DOB'];
$Address = $_POST['address'];
$District = $_POST['District'];
$State = $_POST['State'];
$Pincode = $_POST['Pincode'];
$Pincode = $_POST['Pincode'];
       $sql = "INSERT into id_card(name,father_name,classroll,dob,valid,batch,college,course, contact,address,District,State,Pincode) values('$name', '$father', '$Classroll','$dob','$valid','$batch','$college', '$course', '$contact','$Address','$District','$State','$Pincode')";
      $result = mysqli_query($conn,$sql);
      if($result != 0)
      {        
 

         echo "<div class='alert alert-success'>Record updated successfully</div>";
      }
      else
      {
         echo("Error description: " . mysqli_error($connection_web_in_c));
      }

}elseif ($code==179) 
{ 
$id=$_POST['id'];
$get_edit_card="Select * FROM id_card where id='$id'";
$get_edit_card_run=mysqli_query($conn,$get_edit_card);
if ($row=mysqli_fetch_array($get_edit_card_run))
 {

$name=$row['name'];   
$father_name=$row['father_name'];   
$dob=$row['dob'];   
$valid=$row['valid'];   
$college=$row['college'];   
$course=$row['course'];   
$classroll=$row['classroll'];   
$tehsil=$row['tehsil'];   
$District=$row['District'];   
$State=$row['State'];   
$Pincode=$row['Pincode'];   
$route=$row['route'];   
$spot=$row['spot'];   
$contact=$row['contact'];   
$batch=$row['batch'];   
$address=$row['address'];   
$pass_valid=$row['pass_valid'];   
$buspass_status=$row['buspass_status'];   
$incharge=$row['incharge'];   
$incharge_mobile=$row['incharge_mobile'];   

}

?>

<div class="row">
   
   <div class="col-lg-3">
      <input type="hidden" id="id" value="<?=$id;?>">
      <label>Name</label>
      <input type="text" id="name" value="<?=$name;?>" class="form-control">
   </div>
   <div class="col-lg-3">
       <label>Father Name</label>
        <input type="text" id="father_name" value="<?=$father_name;?>" class="form-control">
   </div>
   <div class="col-lg-3">
       <label>DOB</label>
        <input type="text" id="dob" value="<?=$dob;?>" class="form-control">
   </div>
   <div class="col-lg-3">
    <label>College Name</label>
        <input type="text" id="college" value="<?=$college;?>" class="form-control">
   </div>
  
</div>
<div class="row">
   
   
   <div class="col-lg-3">
       <label>Course Name</label>
        <input type="text" id="course" value="<?=$course;?>" class="form-control">
   </div>
   <div class="col-lg-3">
       <label>Batch</label>
        <input type="text" id="batch" value="<?=$batch;?>" class="form-control">
   </div>
   <div class="col-lg-3">
       <label>District Name</label>
        <input type="text" id="District" value="<?=$District;?>" class="form-control">
   </div>
   <div class="col-lg-3">
       <label>State</label>
        <input type="text" id="State" value="<?=$State;?>" class="form-control">
   </div>
</div>
<div class="row">
   
 
  
   <div class="col-lg-3">
    <label>Pin Code</label>
        <input type="text" id="Pincode" value="<?=$Pincode;?>" class="form-control">
   </div><div class="col-lg-3">
    <label>Route Name</label>
        <input type="text" id="route" value="<?=$route;?>" class="form-control">
   </div>
    <div class="col-lg-3">
       <label>Spot Name</label>
        <input type="text" id="spot" value="<?=$spot;?>" class="form-control">
   </div>
   <div class="col-lg-3">
       <label>Address</label>
        <input type="text" id="address" value="<?=$address;?>" class="form-control">
   </div>
</div>

<div class="row">
   
   
  
   <div class="col-lg-3">
       <label>Incharge Name</label>
        <input type="text" id="incharge" value="<?=$incharge;?>" class="form-control">
   </div><div class="col-lg-3">
       <label>Incharge Mobile</label>
        <input type="text" id="incharge_mobile" value="<?=$incharge_mobile;?>" class="form-control">
   </div>
   <div class="col-lg-3">
       <label>Valid Up To Pass</label>
        <input type="date" id="pass_valid" value="<?=$pass_valid;?>" class="form-control">
   </div>
   <div class="col-lg-3">
       <label>Valid Up To Course</label>
        <input type="date" id="valid" value="<?=$valid;?>" class="form-control">
   </div>

  
</div>

<?php 

}
elseif($code==181)
{
$id=$_POST['id'];
$name=$_POST['name'];       
$college=$_POST['college'];   
$course=$_POST['course'];         
$District=$_POST['District'];   
$State=$_POST['State'];      
$route=$_POST['route'];   
$spot=$_POST['spot'];      
$batch=$_POST['batch'];   
$address=$_POST['address'];   
$pass_valid=$_POST['pass_valid'];
$Pincode=$_POST['Pincode'];  
$valid=$_POST['valid'];    
$incharge=$_POST['incharge'];   
$incharge_mobile=$_POST['incharge_mobile'];

      
  $sql="UPDATE `id_card` SET `name`='$name',  `college`='$college', `course`='$course', `batch`='$batch', `address`='$address', `District`='$District', `State`='$State', `route`='$route', `spot`='$spot', `incharge`='$incharge', `incharge_mobile`='$incharge_mobile', `pass_valid`='$pass_valid',`Pincode`='$Pincode',`valid`='$valid' WHERE `id`='$id'";
      $result = mysqli_query($conn,$sql);
      if($result==TRUE)
      {        
         echo "1";
      }
      else
      {
         echo "0";
      }

}

  
   elseif($code==182) // show image when modal click
   { 
      $id=$_POST['id'];
    $image_get="SELECT image FROM id_card WHERE id='$id'";
   $image_run=mysqli_query($conn,$image_get);
   while($row=mysqli_fetch_array($image_run))
   { 
      if($row['image']!='') {
         
         ?> 
            <a class="example-image-link" href="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$row['image'];?>" data-lightbox="example-1"><img class="example-image" src="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$row['image'];?>" alt="image-1" width="100" height='100' />
<b style="color:green;"><i class="fa fa-eye fa-lg" aria-hidden="true" ></i>Preview</b></a>
<?php
   }
   }
   }
     elseif($code==183)
   { 
 $code_access=$_POST['code_access'];
  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
   $univ_rollno= $filesop[0];
     $class_rollno = $filesop[1];
    
    if ($univ_rollno!='' and $class_rollno!='')
    {
     $sqlsrb = "UPDATE  Admissions SET UniRollNo = '$univ_rollno' WHERE ClassRollNo='$class_rollno'";
     $list_result = sqlsrv_query($conntest,$sqlsrb);
    }
    else
    {

    }
    $c++;
}

      if ($c>0)
       {
      echo "1";
      }
      else
      {
      echo "0";
      }

}
   }

   elseif($code==184)
   {
    $code_access=$_POST['code_access'];
  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
                  $file = $_FILES['file_exl']['tmp_name'];
                  $handle = fopen($file, 'r');
                  $c = 0;
                  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
                  {
                    $class_rollno = $filesop[0];
                    $status = $filesop[1];   
                    $sql = "UPDATE  Admissions set  Eligibility='$status' where UniRollNo='$class_rollno'";
                 $result = sqlsrv_query($conntest,$sql);
                if($result=== false)
                 {
                    die( print_r( sqlsrv_errors(), true) );
                 }
                
                    $c = $c + 1;
                    
                  }
                 if ($c>0)
                      {
                     echo "1";
                     }
                     else
                     {
                     echo "0";
                     } 
                }
      }
elseif($code==185)
{
 $code_access=$_POST['code_access'];
  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
                  
                  $file = $_FILES['file_exl']['tmp_name'];
                  $handle = fopen($file, 'r');
                  $c = 0;
                  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
                  {
                    $class_rollno = $filesop[0];
                    $status = $filesop[1];   
                    $sql = "UPDATE  Admissions set  RegistrationNo='$status' where UniRollNo='$class_rollno'";
                $result = sqlsrv_query($conntest,$sql);
                if($result=== false) {
                
                    die( print_r( sqlsrv_errors(), true) );
                }
                
                    $c = $c + 1;
                    
                  }
                   if ($c>0)
                      {
                     echo "1";
                     }
                     else
                     {
                     echo "0";
                     } 
               }
                
}

elseif($code==186)
{
  $code_access=$_POST['code_access'];
  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
                                          {
                  
                  $file = $_FILES['file_exl']['tmp_name'];
                  $handle = fopen($file, 'r');
                  $c = 0;
                  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
                  {
                    $class_rollno = $filesop[0];
                    $status = $filesop[1];   
                    $sql = "UPDATE  Admissions set  ABCID='$status' where UniRollNo='$class_rollno'";
                $result = sqlsrv_query($conntest,$sql);
                if($result=== false) {
                
                    die( print_r( sqlsrv_errors(), true) );
                }
                
                    $c = $c + 1;
                    
                  }
                   if ($c>0)
                      {
                     echo "1";
                     }
                     else
                     {
                     echo "0";
                     } 
               }
                
}
elseif($code=='187')
   {
        $code_access=$_POST['code_access'];
  if ($code_access=='100' || $code_access=='101' || $code_access=='110' || $code_access=='111') 
    {                                 

   $univ_rollno=$_POST['rollNo'];
   $result1 = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno' or ClassRollNo='$univ_rollno' or IDNo='$univ_rollno'";
   $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC))
   {
   
    $IDNo= $row['IDNo'];
    $ClassRollNo= $row['ClassRollNo'];
    $img= $row['Snap'];
    $UniRollNo= $row['UniRollNo'];
    $name = $row['StudentName'];
    $father_name = $row['FatherName'];
    $course = $row['Course'];
    $email = $row['EmailID'];
    $phone = $row['StudentMobileNo'];
    $batch = $row['Batch'];
    $college = $row['CollegeName'];
    $RegistrationNo = $row['RegistrationNo'];
    $abcid = $row['ABCID'];
    $Status = $row['Status'];
    $collegeId = $row['CollegeID'];
    $courseId= $row['CourseID'];
    $Status = $row['Status'];
        $Locked=$row['Locked'];
    $validUpto=$row['ValidUpTo'];
   }
  if($validUpto!='')
  {
$validUpto=$validUpto->format('d-M-Y');
  }else
  {
   $validUpto='';
  }
 ?>

   
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header badge-success">
                <div class="row">
                  <div class="col-lg-11 col-sm-10"> <div class="widget-user-image">
                  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($img).'" height="50" width="50" class="img-circle elevation-2"  style="border-radius:50%"/>';?>
                </div>
                <!-- /.widget-user-image -->
                <h6 class="widget-user-username"><b><?=$name; ?></b></h6>
                <h6 class="widget-user-desc">Class Roll No&nbsp;:&nbsp;<?php if($ClassRollNo!=''){ echo $ClassRollNo;}else{echo "<b class='text-warning' style='font-size:16px'>Not Updated</b>";} ?><br>Uni Roll No&nbsp;:&nbsp;<?php if($UniRollNo!=''){ echo $UniRollNo;}else{echo "<b class='text-warning' style='font-size:16px'>Not Issued yet</b>";} ?><br>IDNO&nbsp;:&nbsp;<?=$IDNo;?></h6>
                </div>
                <div class="col-lg-1 col-sm-1">
<?php 
  if($EmployeeID==131053 ||$EmployeeID==121031 ||$EmployeeID==171601) {?>
        <button class="btn btn-warning btn-xs" data-toggle="modal"  onclick="StudentUpdatedata(<?= $IDNo;?>)" data-target="#Updatestudentmodal" style="text-align:right"><i class="fa fa fa-edit"></i></button>
        <?php
     }

?>
      </div>
             </div>
               
               


              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                     <li class="nav-link"><b>Father Name </b> :&nbsp;&nbsp;&nbsp;<?= $father_name; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>Contact</b> :&nbsp;&nbsp;&nbsp;<?= $phone; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>Batch</b> :&nbsp;&nbsp;&nbsp;<?= $batch; ?></li>
                  </li>
                   <li class="nav-item">
                     <li class="nav-link"><b>ABC ID</b> :&nbsp;&nbsp;&nbsp;<?php if($abcid!=''){echo $abcid;} else { echo 'NA';} ?></li>
                     
                  </li>

                   <li class="nav-item">
                     <li class="nav-link"><b>Registration Number</b> :&nbsp;&nbsp;&nbsp;<?= $RegistrationNo; ?></li>
                  <li class="nav-item">
                     <li class="nav-link"><b>College</b> :&nbsp;&nbsp;&nbsp;<?= $college; ?></li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>Course</b> :&nbsp;&nbsp;&nbsp;<?= $course; ?></li>
                  </li>
                  </li>
                  <li class="nav-item">
                     <li class="nav-link"><b>Valid Upto</b> :&nbsp;&nbsp;&nbsp;<b class="text-danger"><?php echo $validUpto; ?></b>
                     </li> <li class="nav-link"><b>Status</b> :&nbsp;&nbsp;&nbsp;<?php if ($Status==0)  {
                        echo "<b class='text-danger'>Left</b>";
                     } else{
                        echo "<b class='text-success' style='font-size:16px'>Active</b>";
                     } ?> &nbsp;&nbsp;&nbsp;
<?php if ($Locked==1)  {?>
   <b class="text-danger">
   <i class="fa fa-lock" ></i></b> 

                       
                     <?php }
                     else
                        {
                           echo "<b class='text-success'><i class='fa fa-lock-open'></i></b>";

                        }?>






                  </b>
                     </li>
                  </li>
                  
                  
                </ul>
              </div>
            </div>
         
   <?php
 
   }
   else
   {
      echo "Not Permissions";
   }
   }

 elseif($code==188)
   {
      $flag=0;
      $SubjectCode=$_POST['subCode'];
      $CourseID=$_POST['courseId'];
      $Batch=$_POST['batch'];
      $Semester=$_POST['sem'];
      $unit=$_POST['unit'];
      $sr=0;
      ?>

      <div class="card-body table-responsive " >
<table class="table" id="example">
   <tr>
      <th>#</th>
      <th>Unit</th>
      <th>Type</th>
      <th>Category</th>
      <th>Total Questions</th>
      <th>Uploaded</th>
      <th>Status</th>
   </tr>
   <?php 
      $question_count_selection="Select *,SUBSTRING(number, 1, 1) as Unit from question_count INNER JOIN question_category ON SUBSTRING(NUMBER, 3, 1)=question_category.id INNER JOIN question_type as qt ON SUBSTRING(NUMBER, 2, 1)=qt.id where number like '$unit%' order by number ASC ";
      $question_count_selection_run=mysqli_query($conn,$question_count_selection);
      while ($question_count_selection_row=mysqli_fetch_array($question_count_selection_run)) 
      {
       
         $sr++;
         ?>

   <tr>
           
      <td ><?=$sr;?></td>
      <!-- <td align="center"><?=$question_pending_row['Unit'];?></td> -->
      <td ><?=$question_count_selection_row['Unit'];?></td>
      <td ><?=$question_count_selection_row['type_name'];?></td>
      <td><?=$question_count_selection_row['category_name'];?></td>
      <td><?=$question_count_selection_row['question_count'];?></td>
      <!-- <td><?=$question_pending_row['question_count'];?></td> -->
      <?php
      if ($EmployeeID!='131053')
       {
      $sql="SELECT COUNT(*) AS qc from question_count left join question_bank as qb ON SUBSTRING(number, 1, 1)=Unit AND SUBSTRING(number, 2, 1)=Type AND SUBSTRING(number, 3, 1)=Category  WHERE SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' AND Semester='$Semester' AND Exam_Session='$current_session' and UpdatedBy='$EmployeeID' and number=".$question_count_selection_row['number']." GROUP BY Unit,TYPE,Category";
        
      }
      else
      {
      $sql="SELECT COUNT(*) AS qc from question_count left join question_bank as qb ON SUBSTRING(number, 1, 1)=Unit AND SUBSTRING(number, 2, 1)=Type AND SUBSTRING(number, 3, 1)=Category  WHERE SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' AND Semester='$Semester' AND Exam_Session='$current_session' and number=".$question_count_selection_row['number']." GROUP BY Unit,TYPE,Category";

      }
      $res=mysqli_query($conn,$sql);
      if($question_pending_row=mysqli_fetch_array($res)) 
      {
      $category_name=$question_count_selection_row['category_name'];
      $type_name=$question_count_selection_row['type_name'];
      ?>
      <td><?=$question_pending_row['qc'];?></td>
      <!-- <td><?=$QUC_count1;?></td> -->
       <td><?php 
    if($question_count_selection_row['question_count']<=$question_pending_row['qc']) 
    {
       echo '<i class="fa fa-check" aria-hidden="true" style="color:green;"></i>';  
   } 
      else
      {

    echo '<i class="fa fa-hourglass-end" aria-hidden="true" style="color:red;"></i>'; 
      } ?></td>
   <?php 
}
else
{
   ?>
   <td>0</td>
   <td>
      <?php 
    echo '<i class="fa fa-hourglass-end" aria-hidden="true" style="color:red;"></i>'; 
       ?></td>
      <?php
}
?>
   </tr>
  
  <?php    }

?>
</table>
</div>
<?php 
   }

   elseif($code==189)
   {  
      $Q_id=$_POST['id'];
      $get_image="DELETE  FROM question_paper WHERE id='$Q_id'";
      $get_run=mysqli_query($conn,$get_image);
                               
   }


 elseif ($code=='190')
    {
      $IDNo=$_POST['IDNo'];
 $query4="UPDATE UserMaster SET Password='12345678' WHERE LoginType='Student' AND UserName='$IDNo'";
$stmt4 = sqlsrv_query($conntest,$query4);
if ($stmt4==true)
 {
echo "1";   
}
else
{
   echo "0";
}
   }
        elseif ($code=='191')
    {
      $IDNo=$_POST['IDNo'];
       $Batch=$_POST['Batch'];
 $result1 = "UPDATE Admissions SET Batch='$Batch' where IDNo='$IDNo'";
$stmt1 = sqlsrv_query($conntest,$result1);
if ($stmt1==true)
 {
echo "1";   
}
else
{
   echo "0";
}
   }
elseif($code==192)
{
   $subject_code=$_POST['subject_code'];

                                       $srno=1;

                                          $showQuestionQry="SELECT *,REGEXP_REPLACE(Question,'style=".'[\\d\\D]*?'."','') AS sanitized_question FROM question_paper_details INNER JOIN question_paper ON question_paper_id=question_paper.id 
INNER JOIN question_bank ON question_id=question_bank.id inner join question_bank_details ON question_bank.id=question_bank_details.question_id 
WHERE subject_code='$subject_code' or UpdatedBy='$subject_code' order by Type ";
                                          $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                                          while($showQuestionData=mysqli_fetch_array($showQuestionRun))
                                          {
                                       ?>
                                       <tr>
                                          <td><?=$srno;?>( <?=$showQuestionData['Id']?>: <?=$showQuestionData['Unit']?>:<?=$showQuestionData['Type']?>:<?=$showQuestionData['Category']?>)</td>
                                      <td data-toggle="modal" data-target="#modal-lg" onclick="update_question(<?=$showQuestionData['Id']?>);"><?=$showQuestionData['sanitized_question']?></td>
                               
                                    </tr>
                                    <?php 
                                       $srno++;
                                       }

}
elseif($code==193)
{
   $subject_code=$_POST['subject_code'];
       $showQuestionQry="SELECT * from question_bank where SubjectCode='$subject_code' or UpdatedBy='$subject_code'";
                                          $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                                       echo  $rowcount=mysqli_num_rows($showQuestionRun);
                                         
}
elseif($code==194)
{
   $textBoxValue=$_POST['textBoxValue'];
   $examSession=$_POST['examSession'];
   $searchingValue=$_POST['searchingValue'];
   if ($searchingValue=='SubjectCode') 
   {
      $sql="SELECT distinct  SubjectCode, CollegeID, Batch, CourseID, Semester, UpdatedBy, lock_status,  count(*) as questionCount from question_bank where SubjectCode='$textBoxValue' and Exam_Session='$examSession' GROUP BY SubjectCode, CollegeID, Batch, CourseID, Semester, UpdatedBy";
      $flag=1;
   }
   elseif ($searchingValue=='EmployeeId') 
   {
      $sql="SELECT distinct  SubjectCode, CollegeID, Batch, CourseID, Semester, UpdatedBy, lock_status,  count(*) as questionCount from question_bank where UpdatedBy='$textBoxValue' and Exam_Session='$examSession' GROUP BY SubjectCode, CollegeID, Batch, CourseID, Semester, UpdatedBy";
      $flag=1;
   }
   elseif ($searchingValue=='PaperId') 
   {
      $sql="Select * from question_paper inner join question_exam on question_paper.exam=question_exam.id where question_paper.id='$textBoxValue'";
      $res=mysqli_query($conn,$sql);
      while ($data=mysqli_fetch_array($res)) 
      {
         $examName=$data['exam_name'];
         $sqlCourse = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE CourseID=".$data['course'];
         $resultCourse = sqlsrv_query($conntest,$sqlCourse);
         while($rowCourse = sqlsrv_fetch_array($resultCourse, SQLSRV_FETCH_ASSOC) )
         {
             $courseName=$rowCourse["Course"]; 
         } 
         $mcq=$data['mcq'];
         $short=$data['short'];
         $long=$data['long'];
         $semester=$data['semester'];
         $maxMarks=$data['max_marks'];
         $time =$data['exam_time'];
         $instruction =$data['instructions'];
         $subjectCode=$data['subject_code'];
         $sqlSubject = "SELECT DISTINCT SubjectName from MasterCourseStructure WHERE SubjectCode ='".$subjectCode."' AND Isverified='1' and CourseID=".$data['course'];
         $resultSubject = sqlsrv_query($conntest,$sqlSubject);
         if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
         {
            $subjectName=$rowSubject["SubjectName"]; 
         }
      }
      $flag=0;
   }
   if ($flag==1) 
   {
   $res=mysqli_query($conn,$sql);
   $sr=0;
   ?>
   <table class="table">
      <tr>
         <th>#</th>
         <th>Employee Id</th>
         <th>Subject Code</th>
         <th>Batch</th>
         <th>Semester</th>
         <th>Questions</th>
         <th>Action</th>
         <!-- <th>Delete</th> -->
      </tr>
   <?php
   while($data=mysqli_fetch_array($res))
   {
      $SubjectCode=$data['SubjectCode'];
      $CourseID=$data['CourseID'];
      $Batch=$data['Batch'];
      $Semester=$data['Semester'];
      $sr++;
      ?>
      <tr>
         <td><?=$sr?></td>
         <td><span class="text-info<?=$sr;?>" id="emp<?=$sr;?>"><?=$data['UpdatedBy']?></span></td>
         <td><?=$data['SubjectCode']?></td>
         <td> <span class="text-info<?=$sr;?>" id="batch<?=$sr;?>"> <?=$data['Batch']?></span></td>
         <td><span class="text-info<?=$sr;?>" id="sem<?=$sr;?>"><?=$data['Semester']?></span></td>
         <td><?=$data['questionCount']?></td>
         <td>
            
            <i class="fa fa-eye fa-lg" style="color:green;" onclick="view_question('<?=$SubjectCode;?>','<?=$CourseID;?>','<?=$Batch;?>','<?=$Semester;?>')"  ></i>&nbsp;&nbsp;
            <i class="fa fa-trash fa-lg text-danger" onclick="deleteAllQuestion('<?=$SubjectCode;?>','<?=$CourseID;?>','<?=$Batch;?>','<?=$Semester;?>',<?=$data['UpdatedBy'];?>)"  ></i>&nbsp;&nbsp;
            <i class="fa fa-edit fa-lg text-dark" id="editIcon<?=$sr;?>"  onclick="editAllQuestion('<?=$sr;?>','<?=$SubjectCode?>')"  ></i>&nbsp;&nbsp;
         

            <?php
            if ($data['questionCount']>=130) 
               {
                  if ($data['lock_status']==0) 
                  {
                     ?>
                        <i onclick="lockQuestions('<?=$SubjectCode?>','<?=$CourseID?>','<?=$Batch?>','<?=$Semester?>',<?=$data['UpdatedBy']?>)" class="fa fa-lock-open text-success"></i>
                     <?php
                  }
                  else
                  {
                     ?>
                        <i onclick="unlockQuestions('<?=$SubjectCode?>','<?=$CourseID?>','<?=$Batch?>','<?=$Semester?>',<?=$data['UpdatedBy']?>)" class="fa fa-lock text-info"></i>
                     <?php
                  }
                  ?>

                  <?php
                  
               }
            ?>
         </td>
      </tr>
      <?php 
      
   }
   ?>
   </table>
   <?php
   }
   elseif($flag==0)
   {
      ?>
      <table border="0" align="center" cellpadding="0" cellspacing="0" style="height:100%;  " width="100%">
                  <!-- <tr>
                    <td rowspan="3" align="center" valign="top" nowrap><img src="images/admit_card_border11.png" width="16" height="100%" style="margin-top:1px "></td>
                    <td height="1" align="center" valign="top"><img src="images/admit_card_border.png" width="966" height="16"></td>
                    <td rowspan="3" align="center" valign="top" nowrap><img src="images/admit_card_border11.png" width="16" height="100%" style="margin-top:1px "></td>
                  </tr> -->
                  <tr>
                    <th align="left" width="31%" >
                      <img src="logo2.png" width="80px" height="100%">
                    </th>
                    
                    <th  colspan='2' valign="bottom" align="right">
                      University Registration No...........................
                    </th>
                  </tr>
                  <tr>
                    <th colspan='3' valign="bottom" align="center">
                      <span style="font-size: 30px;">GURU KASHI UNIVERSITY</span>
                      <br>
                      <?=$examName?>
                    </th>
                  </tr>
                  <tr>
                    <th valign="bottom" colspan="2" align="left">
                      Course/Discipline: <?=$courseName?> 
                    </th>
                    
                    <th valign="bottom" align="right">
                     
                      Semester: 
                      <?php
                      echo $semester; 
                      if ($semester==1) 
                      {
                        ?><sup>st</sup><?php
                      }
                      elseif ($semester==2) 
                      {
                        ?><sup>nd</sup><?php
                      }
                      elseif ($semester==3) 
                      {
                        ?><sup>rd</sup><?php
                      }
                      elseif ($semester>=4) 
                      {
                        ?><sup>th</sup><?php
                      }
                      ?>

                    </th>
                  </tr>
                  <tr>
                    <th valign="bottom" align="left">
                      Subject Code: <?=$subjectCode?> 
                    </th>
                    <th  colspan='2' valign="bottom" align="right">
                     
                       Maximum Marks: <?=$maxMarks?> 
                    </th>

                  </tr>
                  
                  <tr>
                    <th  colspan='3' valign="bottom" align="center">
                      <?=$subjectName?> 
                    </th>
                  </tr>
                  <tr>
                    <th  colspan='3' valign="bottom" align="left">
                      Time: <?=$time?> 
                    </th>
                  </tr>
                  <tr>
                    <th  colspan='3' valign="bottom" align="left">
                      Instructions:
                      <table border="0" width="100%">
                        <tr>
                          <th width="12%" align="right">
                            
                          </th>
                          <th align="left">
                            <?=$instruction?>
                          </th>
                        </tr>
                      </table>
                    </th>
                  </tr>
                  <tr>
                    <td colspan="3">

                      <table border="0" width="100%">
                        <?php
                        $qType=''; 
                        $partCount=0;
                        $questionCount=1;
                        $mcqCount='a';
                        
                        $qry="Select *,REGEXP_REPLACE(Question,'style=".'[\\d\\D]*?'."','') AS sanitized_question,question_bank_details.question_id as questionId1 from question_paper_details inner join question_bank on question_bank.Id=question_paper_details.question_id inner join question_type on question_type.id=question_bank.Type inner join question_category on question_category.id=question_bank.Category inner join question_bank_details on question_bank.id=question_bank_details.question_id   where question_paper_id='$textBoxValue' ORDER BY  Type  asc, Category asc";
                        $run=mysqli_query($conn,$qry);
                        while($row=mysqli_fetch_array($run))
                        { 
                          $img='';
                          $imageQry="Select * from question_image where question_id=".$row['Id'];
                          $imageRes=mysqli_query($conn,$imageQry);
                          while($imageData=mysqli_fetch_array($imageRes))
                          {

                            http://gurukashiuniversity.co.in/data-server/question_images/
                            $img.= "<div><img src='http://gurukashiuniversity.co.in/data-server/question_images/{$imageData['image']}' height='200px'  ></div>";
                           
                          }
                          if ($row['Type']!=1) 
                          {
                            $questionCount++;
                          }
                          

                          if ($qType!=$row['Type']) 
                          {
                            $partCount++;
                            if($partCount==1)
                            {
                              $partCountRoman='I';
                            }
                            elseif($partCount==2)
                            {
                              $partCountRoman='II';
                            }
                            elseif($partCount==3)
                            {
                              $partCountRoman='III';
                            }
                            ?>
                            <tr>
                              <th colspan="3" align="center" style="font-size:20px">
                               <label style="margin-left:100px ;"> Part <?=$partCountRoman?> (<?=$row['type_name']?>)</label>
                               <label style="float: right;">
                                (<?php
                                if ($row['Type']==1) 
                                {
                                  echo $mcq;
                                }
                                elseif ($row['Type']==2) 
                                {
                                  echo $short;
                                }
                                elseif ($row['Type']==3) 
                                {
                                  echo $long;
                                } 
                                ?>)
                                </label>
                              </th>
                            </tr>
                            <?php
                          }
                          
                            ?>
                            <tr valign="top">
                              <th width="10%" align="right"><p><?=$questionCount?>. 
                                <?php
                                 if ($row['Type']==1) 
                                  {
                                    echo "({$mcqCount})";
                                  }
                                  ?>
                                &nbsp;</p></th>
                              <th data-toggle="modal" data-target="#modal-lg" onclick="update_question(<?=$row['questionId1']?>);" align="left"><?=$row['sanitized_question']?>
                                <?= $img?>
                              </th>
                              <th align="right">
                                <p><table>
                                <tr>
                                  <!-- <td><?=$row['Unit']?></td> -->
                                  <td><?=$row['category_name']?>(<?=$row['Unit']?>)</td>
                                </tr>
                              </table></p></th>
                            </tr>
                            
                          <?php
                          $qType=$row['Type'];
                          if ($row['Type']==1) 
                          {
                            $mcqCount++;
                          }
                        }
                        ?>
                        
                      </table>
                    </td>
                  </tr>
                  <!-- <tr>
                    <td height="1" align="center" valign="top"><img src="images/admit_card_border.png" width="966" height="16"></td>
                  </tr> -->
                </table>
<?php
   }

}
elseif($code==195)
   {  
      $SubjectCode=$_POST['subCode'];
      $CourseID=$_POST['courseId'];
      $Batch=$_POST['batch'];
      $Semester=$_POST['sem'];
      $EmpID=$_POST['EmpID'];
      $get_image="DELETE  FROM question_bank WHERE SubjectCode='$SubjectCode' and CourseID='$CourseID' and Batch='$Batch' and Semester='$Semester' and UpdatedBy='$EmpID'";
      $get_run=mysqli_query($conn,$get_image);
                               
   }

   elseif($code==196)
   { 
       $subCode=$_POST['subCode'];
        $courseId=$_POST['courseId'];
         $batch=$_POST['batch'];
       $sem=$_POST['sem'];
      $EmpID=$_POST['EmpID'];

       $edit="UPDATE question_bank SET lock_status='0' WHERE SubjectCode='$subCode' and CourseID='$courseId' and Batch='$batch' and Semester='$sem' and UpdatedBy='$EmpID'";
       $edit_run=mysqli_query($conn,$edit);
   
   }
   
   elseif($code==197)               
   { 
       $subCode=$_POST['subCode'];
        $courseId=$_POST['courseId'];
         $batch=$_POST['batch'];
       $sem=$_POST['sem'];
      $EmpID=$_POST['EmpID'];

       $edit="UPDATE question_bank SET lock_status='1' WHERE SubjectCode='$subCode' and CourseID='$courseId' and Batch='$batch' and Semester='$sem' and UpdatedBy='$EmpID'";
       $edit_run=mysqli_query($conn,$edit);
   
   }

elseif($code==198)
{
  $P_Number=$_POST['P_Number'];

  for ($i=1; $i<=$P_Number ; $i++)
   { 
 $one=date("His");
   $two= date("myd");
   $three= substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,8);
   $four=substr(str_shuffle($one.$two.$three),1,8);
   $result =$one.$three.$two.$four;
        $showQuestionQry="INSERT into gate_entry_qr (reference_no)values('$result')";
                                          $showQuestionRun=mysqli_query($conn,$showQuestionQry);
                                      if ($showQuestionRun==true)
                                       {
                                      echo "1";  
                                      }
                                      else
                                      {
                                       echo "0";
                                      }
}
}
elseif($code == 199)
 {
   // echo $RoomTypeID = $_POST['RoomType'];
   $room1= $_POST['room'];
   $building1= $_POST['building'];
   $floor1= $_POST['floor'];
   ?>
<form action="export.php" method="post">
   <input type="hidden" name="exportCode" value="0">
   <input type="hidden" name="office_owner" value="<?=$officeOwnerID?>">
   <div class="card card-info">
      <div class="card-header">
         <h3 class="card-title">Spot Wise Stocks</h3>
         <div class="card-tools">
            <div class="row">
               <div class="btn-group btn-group-xs" style="width: 150px;">
                  <button type="submit" class="form-control float-right btn-success" style="margin-top: -5px;">
                  Export
                  </button>
               </div>
            </div>
         </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0" style="height: 400px;">
         <table class="table table-head-fixed text-nowrap" id="example">
            <?php 
               $category="SELECT * FROM category_permissions where employee_id='$EmployeeID'";
                          $category_run=mysqli_query($conn,$category);
                          if (mysqli_num_rows($category_run)>0) 
                          {
                            ?>
            <thead>
               <tr>
                  <th>Sr. No.</th>
                  <th>College Name</th>
                  <th>Floor</th>
                  <th>Room Name</th>
                  <th>Room No.</th>
                  <th>View</th>
                  <?php
                     while ($category_row=mysqli_fetch_array($category_run)) 
                     { 
                         $cat_id_array[]=$category_row['CategoryCode'];
                     }
                     $arrayCatCount=count($cat_id_array);
                     for($i=0;$i<$arrayCatCount;$i++)
                     {
                         $cat_id=$cat_id_array[$i];           
                         
                         $article="SELECT * from master_article where CategoryCode='$cat_id' order by master_article.ArticleCode asc";
                         
                         $article_run=mysqli_query($conn,$article);
                         while ($article_row=mysqli_fetch_array($article_run)) 
                         {
                             ?>
                  <th><?=$article_row['ArticleName']?></th>
                  <?php
                     }
                     }
                     
                     ?>
               </tr>
            </thead>
            <tbody>
               <?php
                  $srNO=1;
                  if ($building1=='' && $floor1=='' && $room1=='') 
                  {
                     $sql=" SELECT *, colleges.shortname as clg_name ,room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID order by location_master.ID asc ";
                     $flag=1;
                  }
                  elseif ($building1!='' && $floor1=='' && $room1=='') 
                  {
                     $sql=" SELECT *, colleges.shortname as clg_name ,room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID where location_master.Block='$building1' order by location_master.ID asc ";
                     $flag=1;
                  }
                  elseif ($building1!='' && $floor1!='' && $room1=='') 
                  {
                     $sql=" SELECT *, colleges.shortname as clg_name ,room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID where location_master.Floor='$floor1' and location_master.Block='$building1' order by location_master.ID asc ";
                     $flag=1;
                  }
                  elseif ($building1!='' && $floor1!='' && $room1!='') 
                  {
                     $sql=" SELECT *, colleges.shortname as clg_name ,room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID where location_master.Floor='$floor1' and location_master.Block='$building1' and location_master.RoomNo='$room1' order by location_master.ID asc ";
                     $flag=1;
                  }
                  else
                  {
                     $flag=0;
                  }
                  if ($flag==1) 
                  {           
                  $arrayIndex=0;
                  $res_r = mysqli_query($conn, $sql);
                  while($data = mysqli_fetch_array($res_r)) 
                  {
                      $lm_ID=$data['lm_id'];
                      $OfficeName = $data['RoomName'];
                      $block = $data['Name'];
                      $RoomType = $data['Type'];
                      $officeID = $data['rnm_id'];
                      $clgName = $data['clg_name'];
                      $RoomNo = $data['RoomNo'];
                      $Floor = $data['Floor_name'];

                      if ($Floor == 0)
                      {
                          $FloorName = 'Ground';
                      }
                      elseif ($Floor == 1)
                      {
                          $FloorName = 'First';
                      }
                      elseif ($Floor == 2)
                      {
                          $FloorName = 'Second';
                      }
                      elseif ($Floor == 3)
                      {
                          $FloorName = 'Third';
                      }
                      elseif ($Floor == 4)
                      {
                          $FloorName = 'Fourth';
                      }
                          $arrayCount=0;

                      for($k=0;$k<$arrayCatCount;$k++)
                      {
                          $cat_id=$cat_id_array[$k];
                          $building_num=0;
                           $building="SELECT * from master_article where CategoryCode='$cat_id' order by ArticleCode asc ";
                          $building_run=mysqli_query($conn,$building);
                          while ($building_row=mysqli_fetch_array($building_run)) 
                          {
                              $building_num=$building_num+1;
                                  $name='';
                             
                              $count=0;
                              $article_code=$building_row['ArticleCode'];
                           $qry="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join location_master on location_master.ID=stock_summary.LocationID where stock_summary.Status='2' and location_master.Type='$RoomType' and location_master.ID='$lm_ID' and stock_summary.ArticleCode='$article_code' and master_article.CategoryCode='$cat_id' ";
                              $run=mysqli_query($conn,$qry);
                              while($data=mysqli_fetch_array($run))
                              {
                                  $count++;
                                  $name=$data['ArticleName'];
                              }
                              $array[$arrayIndex][]=$count;
                              $arrayCount++;
                          }
                      }

                     
                      if(max($array[$arrayIndex])>0)
                      {
                          ?>
               <tr>
                  <td><?=$srNO?></td>
                  <td><?=$clgName?> </td>
                  <td><?=$FloorName?> </td>
                  <td><?=$OfficeName?>(<?=$block?>  Block)</td>
                  <td><?=$RoomNo; ?> </td>
                  <td>
                     <i class="fa fa-eye fa-lg" onclick="view_office_stock(<?=$lm_ID;?>,<?=$RoomType?>);" data-toggle="modal" data-target="#view_assign_stock_office_Modal_location" style="color:red;"></i>
                     <i class="fa fa-eye fa-lg" onclick="view_serial_no(<?=$lm_ID;?>,<?=$RoomType?>);" data-toggle="modal" data-target="#view_serial_no_Modal" style="color:blue;"></i>
                  </td>
                  <?php
                     for($i=0;$i<$arrayCount;$i++)
                     { 
                     ?>
                  <td>
                    
                     <?=$array[$arrayIndex][$i];?>
                  </td>

                  <?php
                     }

                     ?>
               </tr>

               <?php
                  $srNO++;
                  }
                  $arrayIndex++;
                  }
               }
               else
               {
                  ?>
                  <tr>
                     <th colspan="100%">
                        
                  <h3 class="alert-warning text-danger" >&nbsp;&nbsp;&nbsp;&nbsp; <b>Wrong Selection!!!.........</b> </h3>
                     </th>
                  </tr>
               
                  <?php
               }

                  ?>
            </tbody>
            <?php 
         }
               ?>
         </table>
      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.card -->
</form>
<?php
   }

               elseif($code==202)
               {
               $univ_rollno=$_POST['rollNo'];
               if ($univ_rollno!='') 
               {
               $list_sql = "SELECT   ExamForm.Course,ExamForm.ReceiptDate, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
               FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where Admissions.UniRollNo='$univ_rollno' ORDER BY ExamForm.ID DESC"; 
                $list_result = sqlsrv_query($conntest,$list_sql);
                    $count = 1;
               if($list_result === false)
                {
               die( print_r( sqlsrv_errors(), true) );
               }
                while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                   {
                $Status= $row['Status'];
                $issueDate=$row['SubmitFormDate'];
                echo "<tr>";
                echo "<td>".$count++."</td>";
                echo "<td>".$row['ID']."</td>";
                ?><td>
                <a href="" onclick="edit_stu(<?= $row['ID'];?>)" style="color:#002147;text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$row['UniRollNo'];?></a></td>
                  <?php echo "<td>".$row['StudentName']."</a></td>";
                echo "<td>".$row['Course']."</td>";
                echo "<td>".$row['Semesterid']."</td>";
                echo "<td>".$row['Batch']."</td>";
                echo "<td>".$row['Examination']."</td>";
                     if($row['ReceiptDate']!='')
                     {
                       $rdate=$row['ReceiptDate']->format('Y-m-d');
                     }
                     else
                     {
                     $rdate='';
                     }
?>
               <td>
                <?=$row['Type'];?></td>
                <td><center><?php 

 if($Status==-1)
                {
                  echo "Fee<br>pending";

                }
                elseif($Status==0)
                {
                  echo "Draft";
                }elseif($Status==1)
                {
                  echo 'Forward<br>to<br>dean';
                }

                elseif($Status==2)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Department</b>";
                }
                 elseif($Status==3)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Dean</b>";
                }

 elseif($Status==4)
                {
                  echo 'Forward <br>to<br> Account';
                }
 elseif($Status==5)
                {
                  echo 'Forward <br>to<br> Examination<br> Branch';
                }

 elseif($Status==6)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Accountant</b>";
                }
      elseif($Status==7)
                {
                  echo "<b style='color:red'>Rejected_By<br>Examination<br>Branch</b>";
                }           

elseif($Status==8)
                {
                  echo "<b style='color:green'>Accepted</b>";
                }   ?>        
</center>
               </td>
                
               <td> <?php if($issueDate!='')
               {
               echo $t= $issueDate->format('Y-m-d'); 

               }else{ 

               }?>

              </td>
  <td> 
 <Select id='Status'  class="form-control">
                <option value="-1">Fee pending</option>
                <option value="0">Draft</option>
                <option value="4">Forward to Account</option>
                <option value="5">Forward to Examination Branch</option>
                <option value="8">Accepted</option>
              </Select>
        <input type="button" value="Update" class="btn btn-warning btn-xs" onclick="status_update(<?=$row['ID'];?>);">
          </td>
          <td>
            <a href="" style="text-decoration: none;">
<i class="fa fa-trash fa-md" onclick="delexam(<?=$row['ID'];?>)" style="color:red"></i></a>
            </td>
                <tr/>
           <?php 
            }
        ?>
        <tr>
            
</tr>
<?php 
}
else
{
$list_sql = "SELECT TOP 150   ExamForm.Course,ExamForm.ReceiptDate, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo ORDER BY ExamForm.ID DESC"; 
  $list_result = sqlsrv_query($conntest,$list_sql);

        $count = 1;
if($list_result === false)
 {
die( print_r( sqlsrv_errors(), true) );
}
  while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
        {
          $Status= $row['Status'];
          $issueDate=$row['SubmitFormDate'];
                echo "<tr>";
                // echo "<td><input type='checkbox' name='amrik[]' class='checkBoxClass' value='".$row['ID']."'></td>";
                echo "<td>".$count++."</td>";
                echo "<td>".$row['ID']."</td>";
                ?><td>
                <a href="" onclick="edit_stu(<?= $row['ID'];?>)" style="color:#002147;text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$row['UniRollNo'];?></a></td>
                  <?php echo "<td>".$row['StudentName']."</a></td>";
                echo "<td>".$row['Course']."</td>";
                echo "<td>".$row['Semesterid']."</td>";
                echo "<td>".$row['Batch']."</td>";
               
                echo "<td>".$row['Examination']."</td>";
               // echo "<td>".$row['Type']."</td>";
if($row['ReceiptDate']!='')
{
  $rdate=$row['ReceiptDate']->format('Y-m-d');
}
else
{
$rdate='';
}
?>
               <td>
             <?=$row['Type'];?>
        </td>
                <td>
                    <center><?php 

 if($Status==-1)
                {
                  echo "Fee<br>pending";

                }

                elseif($Status==0)
                {
                  echo "Draft";
                }elseif($Status==1)
                {
                  echo 'Forward<br>to<br>dean';
                }

                elseif($Status==2)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Department</b>";
                }
                 elseif($Status==3)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Dean</b>";
                }

 elseif($Status==4)
                {
                  echo 'Forward <br>to<br> Account';
                }
 elseif($Status==5)
                {
                  echo 'Forward <br>to<br> Examination<br> Branch';
                }

 elseif($Status==6)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Accountant</b>";
                }
      elseif($Status==7)
                {
                  echo "<b style='color:red'>Rejected_By<br>Examination<br>Branch</b>";
                }           

elseif($Status==8)
                {
                  echo "<b style='color:green'>Accepted</b>";
                }   ?>        
</center>
               </td>
                
               <td> <?php if($issueDate!='')
               {
               echo $t= $issueDate->format('Y-m-d'); 

               }else{ 

               }?>

              </td>
  <td> 
 <Select id='Status'  class="form-control">
                <option value="-1">Fee pending</option>
                <option value="0">Draft</option>
                <option value="4">Forward to Account</option>
                <option value="5">Forward to Examination Branch</option>
                <option value="8">Accepted</option>
              </Select>
        <input type="button" value="Update" class="btn btn-warning btn-xs" onclick="status_update(<?=$row['ID'];?>);">

          </td>

          <!-- <td style="text-align: center;">  <i class="fa fa-print fa-2x" onclick="result(<?= $row['Id'];?>)" style="color:#002147"></i>
          </td> -->
          <td>
            <a href="" style="text-decoration: none;">
<i class="fa fa-trash fa-md" onclick="delexam(<?=$row['ID'];?>)" style="color:red"></i></a>


            </td>
                <tr/>
           <?php 
            }
        
}
   }
   elseif($code==203)
   {
  $file = $_FILES['file_exl']['tmp_name'];
  $handle = fopen($file, 'r');
  $c = 0;
  while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
  {
     $univ_rollno = $filesop[0];
 $sem=$_POST['sem'];
 if ($sem==1) {
   $semester='First';
 }
 elseif ($sem==2) {
   $semester='Second';
 }
 elseif ($sem==3) {
  $semester='Third';
 }
 elseif ($sem==4) {
   $semester='Fourth';
 }
 elseif ($sem==5) {
  $semester='Fifth';
 }
 elseif ($sem==6) {
   $semester='Sixth';
 }
 elseif ($sem==7) {
   $semester='Seventh';
 }
 elseif ($sem==8) {
   $semester='Eight';
 }
 else
 {
  $semester='Nine';
 }
 $type=$_POST['type'];
 $month=$_POST['month'];
 $Status=$_POST['Status'];
unset($subject);
unset($SubjectCode);
unset($SubjectType);
$examination=$month;
$sql = "SELECT  * FROM Admissions where UniRollNo='$univ_rollno'";
$stmt1 = sqlsrv_query($conntest,$sql);
        if($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
         {
            $IDNo= $row['IDNo'];
            $ClassRollNo= $row['ClassRollNo'];
            $img= $row['Snap'];
            $UniRollNo= $row['UniRollNo'];
            $name = $row['StudentName'];
            $father_name = $row['FatherName'];
            $mother_name = $row['MotherName'];
            $course = $row['Course'];
            $email = $row['EmailID'];
            $phone = $row['StudentMobileNo'];
            $batch = $row['Batch'];
            $college = $row['CollegeName'];
            $CourseID=$row['CourseID'];
            $CollegeID=$row['CollegeID'];
          }
 $result1 = "SELECT * FROM MasterCourseStructure where CourseID='$CourseID' and Batch='$batch' and SemesterID='$sem' and IsVerified='1' ";
        $s_counter = 0;
        $stmt2 = sqlsrv_query($conntest,$result1);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {
          $subject[]=$row1['SubjectName'];   
          $SubjectCode[]=$row1['SubjectCode'];
          $SubjectType[]=$row1['SubjectType'];      
         $s_counter++;         
}
      $receipt_date=   date("Y-m-d");
 $query="INSERT INTO ExamForm (IDNo,CollegeName,CollegeID,Course,CourseID,Batch,SemesterID,Type,SGroup,Examination,Status,SubmitFormDate,ReceiptNo,ReceiptDate,DepartmentVerifiedDate,DeanVerifiedDate, Amount,AccountantVerificationDate,ExaminationVerifiedDate,Semester)
   VALUES ('$IDNo','$college','$CollegeID','$course','$CourseID','$batch','$sem','$type','NA','$examination','$Status','$receipt_date','0','$receipt_date','$receipt_date','$receipt_date','0','$receipt_date','$receipt_date','$semester')";
$stmt = sqlsrv_query($conntest,$query);
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}
else{
 $sql_limit = "SELECT TOP 1 * FROM ExamForm ORDER BY Id DESC";
$stmt1 = sqlsrv_query($conntest,$sql_limit);
if( $stmt1  === false) {
    die( print_r( sqlsrv_errors(), true) );
}
while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) ) {

  $cutlist_id= $row1['ID'];
}
// print_r($subject);
// echo $s_counter;
       for($a=0;$a<$s_counter;$a++)
       {
         $subjectName= $subject[$a];
       $sub_code= $SubjectCode[$a];
      $int= 'Y';
      $ext= 'Y';
      $total= $SubjectType[$a];
      if($sub_code!='')
      {
       $query1="INSERT INTO ExamFormSubject(IDNo,Examid,Batch,CollegeName,Course,SemesterID,SubjectName,SubjectCode,InternalExam,ExternalExam,SubmitFormDate,Status,AccountantVerificationDate,SubjectType,Examination,Semester,Type)
          VALUES ('$IDNo','$cutlist_id','$batch','$college','$course','$sem','$subjectName','$sub_code','$int','$ext','$receipt_date','0','$receipt_date','$total','$examination','$semester','$type')";
      $stmt2 = sqlsrv_query($conntest,$query1);
      }
       }
}
}
          if($stmt2==true)
          {
            echo "1";
          }
         else
          {
            echo "0";
          }
   }
   elseif($code==204)
   {
  $id = $_POST['id'];
  $list_sqlw5 ="SELECT * from ExamForm Where  ID='$id'";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);
        $i = 1;
        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
             $IDNo=$row5['IDNo'];
             $type=$row5['Type'];
             $examination=$row5['Examination'];
             $receipt_date=$row5['ReceiptDate'];
             $receipt_no=$row5['ReceiptNo'];
             $formid=$row5['ID'];
             if($receipt_date!='')
             {
              $rdateas=$receipt_date->format('Y-m-d');}
           else
            {
              $rdateas='';        
            } 
       }
 $sql = "SELECT  * FROM Admissions where IDNo='$IDNo'";
$stmt1 = sqlsrv_query($conntest,$sql);
        while($row6 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
         {
            $IDNo= $row6['IDNo'];
            $ClassRollNo= $row6['ClassRollNo'];
            $img= $row6['Snap'];
            $UniRollNo= $row6['UniRollNo'];
            $name = $row6['StudentName'];
            $father_name = $row6['FatherName'];
            $mother_name = $row6['MotherName'];
            $course = $row6['Course'];
            $email = $row6['EmailID'];
            $phone = $row6['StudentMobileNo'];
            $batch = $row6['Batch'];
            $college = $row6['CollegeName'];
            $CourseID=$row6['CourseID'];
            $CollegeID=$row6['CollegeID'];
          }
?>
 <div class="card-body table-responsive ">
<table class="table table-bordered"  border="1">
 <tr style="border: 1px black solid" height="30" >
 <td style="padding-left: 10px"><b>Rollno: </b></td>
 <td> <?php echo $UniRollNo;?></td>
 <td colspan="1"><b>Name:</b> </td>
 <td colspan="4"><?=$name;?></td>
 <td rowspan="3" colspan="2" style="border:0">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($img).'" height="200" width="150" class="img-thumnail" />';?>
             </td>
 </tr>
 <tr style="border: 1px black solid"height="30">
   <td style="padding-left: 10px"><b>College:</b></td>
   <td colspan="1"><?php echo $college;?></td>
   <td><b>Course:</b></td>
   <td colspan="4"><?=$course;?></td>
 </tr>
 <tr style="border: 1px black solid"height="30"  >
   <td style="padding-left: 10px"><b>Examination :</b></td>
   <td colspan="1">
       <select  id="examination_" class="form-control" required="">
                 <option value="<?=$examination;?>"><?=$examination;?></option>
                       <?php
   $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {    
     $Sgroup = $row1['Examination'];  
    ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }
?>
              </select>


      <?php ?>
         

      </td>
   <td><b>Type:</b></td>
   <td colspan="3">
             <select  id="type_" class="form-control" required="">
                 <option value="<?=$type;?>"><?=$type;?></option>
                       <?php
   $sql="SELECT DISTINCT Type from ExamForm Order by Type ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {    
     $Sgroup = $row1['Type'];  
    ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }
?>
              </select>
   </td>
   <td colspan="1"><button type="button"  onclick="exam_type_update(<?=$formid;?>);"  class="btn btn-primary"><i class="fa fa-check"></i></button></td>
 </tr>
 <th colspan="1">Receipt Date:</th>
   <td colspan="4">
   <input type="text"  class="form-control" name="receipt_date" id="asreceipt_date" value="<?= $rdateas;?>" placeholder="ReceiptDate"></td>
   <tH colspan="1">Receipt No:</tH>
   <td><input type="text" name="receipt_date" id="asreceipt_no" class="form-control"  value="<?= $receipt_no;?>" placeholder="ReceiptNo" ></td> 
   <td><button type="submit" id="type" onclick="receipt_date_no_update(<?=$formid;?>);" name="correct" class="btn btn-success "><i class="fa fa-check"></i></button></td>
</tr>
</table>
<table class="table table-striped" border="1">
<tr>
   <th>SrNo</th>
  <th>Subject Name</th>
  <th width="12%">Subject Code</th>
  <th width="8%">Int</th>
  <th width="8%">Ext</th>
  <th width="8%">Type</th>
  <th width="7%">Int Marks</th>
  <th width="7%">Ext Marks</th>
  <th width="7%">Action</th>
</tr>


<?php 

 $amrik = "SELECT * FROM ExamFormSubject where Examid='$id'";  
$list_resultamrik = sqlsrv_query($conntest,$amrik);  
if($list_resultamrik === false) 
{
    die( print_r( sqlsrv_errors(), true) );
}
$sr=0;
while($row7 = sqlsrv_fetch_array($list_resultamrik, SQLSRV_FETCH_ASSOC) )
         { $sr++;
            ?>

         <tr>
            <td width="10"><?=$sr;?></td>
  <td colspan="1">
   <input   class="form-control"  type="text" id="<?=$row7['ID'];?>_subname"  value="<?= $row7['SubjectName'];?>"></td>
   <td colspan="1"><input  class="form-control"  type="text" id="<?=$row7['ID'];?>_subcode" value="<?=$row7['SubjectCode'];?>">
   </td>
  <td>
    <select  id="<?=$row7['ID'];?>_Int"  class="form-control" >
      <option><?=$row7['InternalExam'];?></option>
    <option value="Y">Y</option>
    <option value="N">N</option>
  </select></td>
  <td>
      <select  id="<?=$row7['ID'];?>_Ext"  class="form-control" >  
      <option><?php echo $row7['ExternalExam'];?></option>
    <option value="Y">Y</option>
    <option value="N">N</option>
  </select>
  </td>
  <td>
      <select  id="<?=$row7['ID'];?>_subtype"  class="form-control" >
      <option><?=$row7['SubjectType'];?></option>
      <option value="T">T</option>
      <option value="P">P</option>
     </select>
  </td>
  <td><input type="text"  class="form-control"  style="width:" value="<?php echo $row7['intmarks']; ?>" id="<?=$row7['ID'];?>_intmarks">
    
  </td>
  <td><input type="text"  class="form-control"  style="width:" value="<?php echo $row7['extmarks']; ?>" id="<?=$row7['ID'];?>_extmarks">
    
  </td>
       <td>
  <button type="submit" id="type" onclick="sub_code_int_ext_type_update(<?=$row7['ID'];?>);" name="update" class="btn btn-primary"><i class="fa fa-check"></i></button>



</td>




<p id="resuccess"></p>


</tr>


         <?php }
         ?>
</table>
</div>
         <?php 
   }
    elseif($code==205)
   {

  $database = $_POST['database'];
  $servername = "localhost";
  $username = "$username1";
  $password = "$password1";
    $conn = new mysqli($servername, $username, $password, $database);
        $conn->set_charset("utf8");
  $show="show TABLES";
$show_run=mysqli_query($conn,$show);
while($show_row=mysqli_fetch_array($show_run))
{
  ?>
  <option value="<?=$show_row[0];?>"><?=$show_row[0];?></option>
  <?php 
}

  }
   elseif ($code ==200)
    {
      $course= $_POST['course'];

$batch= $_POST['batch'];

$sem= $_POST['sem'];



  $sql = "SELECT DISTINCT SubjectName,SubjectCode,SubjectType FROM MasterCourseStructure WHERE CourseID ='$course' AND SemesterID='$sem' ANd Batch='$batch' ";


 $stmt2 = sqlsrv_query($conntest,$sql);
 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
 {
   ?>
   <option value='<?= $row1["SubjectCode"];?>'><?= $row1["SubjectName"];?>(<?= $row1["SubjectCode"];?>)/<?= $row1["SubjectType"];?></option>";
 <?php 
 }

   }


 // multiple update masrks  
 else  if($code==201)
{       
$ids =$_POST['ids']; 
 $mst=$_POST['mst'];
$ecat=$_POST['ecat'];
   $flag=$_POST['flag'];
 for($i=0;$i<$flag;$i++)
  {
 echo $list_sqlw= "update ExamFormSubject set $ecat='$mst[$i]' where ID='$ids[$i]'";
  $stmt1 = sqlsrv_query($conntest,$list_sqlw);
 if ($stmt1==true) 
 {
   echo "1";
 }
 else
 {
  echo "0";
 }
}
}
//unlock one student 
 else  if($code==206)
{       

$id =$_POST['id'];  
$ecat=$_POST['ecat'];
if($ecat=='ESE')
{
$ecat='MoocLocked';
}
else
{
  $ecat=$ecat."Locked"; 
}
 

 echo $list_sqlw= "update ExamFormSubject set $ecat=NULL where ID='$id'";
  $stmt1 = sqlsrv_query($conntest,$list_sqlw);
 if ($stmt1==true) 
 {
   echo "1";
 }
 else
 {
  echo "0";
 }
}

//lock one
 else  if($code==207)
{       

$id =$_POST['id'];  
$ecat=$_POST['ecat'];
  
if($ecat=='ESE')
{
$ecat='MoocLocked';
}
else
{
  $ecat=$ecat."Locked"; 
}


 echo $list_sqlw= "update ExamFormSubject set $ecat='1' where ID='$id'";
  $stmt1 = sqlsrv_query($conntest,$list_sqlw);
 if ($stmt1==true) 
 {
   echo "1";
 }
 else
 {
  echo "0";
 }
}


 else  if($code==208)
{
       $id =$_POST['id'];  
       $examination=$_POST['examination'];
       $type=$_POST["type"];
       $sq="Update ExamForm set Type='$type',Examination='$examination' Where ID='$id'"; 
       $list = sqlsrv_query($conntest,$sq);
       if ($list==true) 
       {
       echo "1";   // code...
       }
       else
       {
         echo "0";
       }

}
// lock all
 else  if($code==209)
{       

$examination=$_POST['examination'];  
$ecat=$_POST['ecat'];
if($ecat=='ESE')
{
$ecat1='MoocLocked';
}
else
{
  $ecat1=$ecat."Locked"; 
}
$list_sqlw= "update ExamFormSubject set $ecat1='1' where Examination='$examination'";
$stmt1 = sqlsrv_query($conntest,$list_sqlw);
 if ($stmt1==true) 
 {
   echo "1";
 }
 else
 {
  echo "0";
 }
}



elseif($code==210)
{
 $id =$_POST['id'];
   $Ext =$_POST['Ext'];
    $Int =$_POST['Int'];
     $Intm =$_POST['Intm'];
      $Extm =$_POST['Extm'];
       $subname =$_POST['subname'];
        $subcode =$_POST['subcode'];
        $subtype =$_POST['subtype'];
      $sq="Update ExamFormSubject set ExternalExam='$Ext',InternalExam='$Int',intmarks='$Intm', extmarks='$Extm',SubjectName='$subname',SubjectCode='$subcode',SubjectType='$subtype' Where ID='$id'"; 
     $list = sqlsrv_query($conntest,$sq);
      if ($list==true )
    {
  echo "1";
    }
   else
    {
    echo "0";
    }
}
elseif($code==211)
{
    $rdate =$_POST['receipt_date'];
    $rno =$_POST['receipt_no'];
    $id =$_POST['id'];
    $sq="Update ExamForm set ReceiptNo='$rno',ReceiptDate='$rdate' Where ID='$id'"; 
    $list = sqlsrv_query($conntest,$sq);
       if ($list==true )
       { 
         echo "1";
       }
       else
       {
         echo "0";
       }
}
elseif($code==212)
{
    $id=$_POST['id'];
    echo  $sq1="Delete FROM ExamForm  Where ID='$id'"; 
    $list1 = sqlsrv_query($conntest,$sq1);
   echo   $sq2="Delete FROM ExamFormSubject  Where examid='$id'"; 
     $list2 = sqlsrv_query($conntest,$sq2);
   if($list1==true and $list2==true)
       {
         echo "1";
       }
       else
       {
         echo "0";
       }
}
elseif($code==213)
{
    $id = $_POST['id'];
    $status = $_POST['status'];
     $sq="Update ExamForm set Status='$status' Where ID='$id'"; 
     $list2 = sqlsrv_query($conntest,$sq);
   if ($list2==true)
       {
         echo "1";
       }
       else
       {
         echo "0";
       }
}


elseif($code==214)
{
   ?>
<table class="table">
<tr>
   <th>Type</th>
   <th>Semester</th>
   <th>Start Date</th>
   <th>End Date</th>
   <th>Status</th>
   <th>Action</th>
</tr>
   <?php 
     $exam_type=$_POST['exam_type'];
  $list_sqlw5 ="SELECT * from DDL_TheroyExaminationSemester  as DTES inner join DDL_TheroyExamination as DTE  ON DTE.id=DTES.DDL_TE_ID   Where  DDL_TE_ID='$exam_type' order by DTES.SemesterId  ASC";
  $list_result5 = sqlsrv_query($conntest,$list_sqlw5);
        $i = 1;
        while( $row5 = sqlsrv_fetch_array($list_result5, SQLSRV_FETCH_ASSOC) )
        {  
            $todaydate=date('d-m-Y');
            $endDate=$row5['EndDate']->format('d-m-Y');
         ?> 
           <tr>
               <td><?=$row5['Name'];?></td>
              <td><?=$row5['SemesterId'];?></td>
              <th><?=$row5['StartDate']->format('d-m-Y');?></th>
              <th><?=$row5['EndDate']->format('d-m-Y');?></th>
              <td><?php 
              if (strtotime($endDate)<strtotime($todaydate)) 
              {
                 echo "<b style='color:red;'>Over</b>";
              }
              else
              {
               echo "<b style='color:green;'>Open<b>";
              }
              ?></td>
              <td><i class="fa fa-edit " data-toggle="modal" onclick="edit_start_end_date(<?=$exam_type;?>,<?=$row5['SemesterId'];?>);" data-target="#exampleModal_edit_permission_exam"></i></td>
           </tr>
      <?php        }
      ?>   
</table>
<?php 
}


// lock all
else  if($code==215)
{       

$examination=$_POST['examination'];  
$ecat=$_POST['ecat'];
$semester=$_POST['semester'];

if($ecat=='ESE')
{
$ecat='MoocLocked';
}
else
{
  $ecat=$ecat."Locked"; 
}

$list_sqlw= "update ExamFormSubject set $ecat=NULL where Examination='$examination' ANd SemesterID='$semester'";
$stmt1 = sqlsrv_query($conntest,$list_sqlw);
 if ($stmt1==true) 
 {
   echo "1";
 }
 else
 {
  echo "0";
 }


}
else  if($code==216)
{       

$examination=$_POST['examination'];  
$ecat=$_POST['ecat'];
$semester=$_POST['semester'];
if($ecat=='ESE')
{
$ecat='MoocLocked';
}
else
{
  $ecat=$ecat."Locked"; 
}

 $list_sqlw= "update ExamFormSubject set $ecat1=NULL where Examination='$examination' ANd  SemesterID='$semester' ANd  ($ecat='' OR $ecat IS NULL )";
$stmt1 = sqlsrv_query($conntest,$list_sqlw);
 if ($stmt1==true) 
 {
   echo "1";
 }
 else
 {
  echo "0";
 }
}

else if($code==217)
{       
$college=$_POST['college'];  
$course=$_POST['course']; 
$batch=$_POST['batch']; 
 $examination=$_POST['examination'];  
//$ecat=$_POST['ecat'];
$semester=$_POST['semester'];
//$ecat1=$ecat."Locked";
$Examid=array();
echo $sql="SELECT * from ExamForm where CollegeID='$college' ANd CourseID='$course' ANd Batch='$batch' ANd Examination='$examination' ANd SemesterID='$semester' ";
 $stmt2 = sqlsrv_query($conntest,$sql);
   while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
       {

 $Examid[]=$row1['ID'];
           }
 $length =sizeof($Examid);

foreach($_POST['distributiontheory_str'] as $key => $disti) { 
$disti=$disti."Locked";
 for ($th=0;$th<$length;$th++)
 {


echo $list_sqlw= "update ExamFormSubject set $disti=NULL where Examid='$Examid[$th]' ";
    $stmt2 = sqlsrv_query($conntest,$list_sqlw);
 }
}

}

else if($code==218)
{       
$college=$_POST['college'];  
$course=$_POST['course']; 
$batch=$_POST['batch']; 
 $examination=$_POST['examination'];  
//$ecat=$_POST['ecat'];
$semester=$_POST['semester'];
//$ecat1=$ecat."Locked";
$Examid=array();
 $sql="SELECT * from ExamForm where CollegeID='$college' ANd CourseID='$course' ANd Batch='$batch' ANd Examination='$examination' ANd SemesterID='$semester' ";
 $stmt2 = sqlsrv_query($conntest,$sql);
   while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
       {

 $Examid[]=$row1['ID'];
           }
 $length =sizeof($Examid);

foreach($_POST['distributiontheory_str'] as $key => $disti) { 
$disti1=$disti."Locked";
 for ($th=0;$th<$length;$th++)
 {


 $list_sqlw= "update ExamFormSubject set $disti1=NULL where Examid='$Examid[$th]' ANd  ($disti='' OR $disti IS NULL )  ";
    $stmt2 = sqlsrv_query($conntest,$list_sqlw);
 }
}

}

   elseif($code==219)
   {                                
  
$IDNo= $_POST['IDNo'];
   $result1 = "SELECT  * FROM Admissions INNER JOIN UserMaster on Admissions.IDNO=UserMaster.UserName  where Admissions.IDNo='$IDNo'";
     $stmt1 = sqlsrv_query($conntest,$result1);
   while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC))
   {     
    $IDNo= $row['IDNo'];
    $ClassRollNo= $row['ClassRollNo'];
    $img= $row['Snap'];
    $UniRollNo= $row['UniRollNo'];
    $name = $row['StudentName'];
    $CourseID=$row['CourseID'];
    $CollegeID=$row['CollegeID'];
    $father_name = $row['FatherName'];
    $Course = $row['Course'];
    $email = $row['EmailID'];
    $phone = $row['StudentMobileNo'];
    $Batch = $row['Batch'];
    $college = $row['CollegeName'];
    $RegistrationNo = $row['RegistrationNo'];
    $abcid = $row['ABCID'];
    $Status = $row['Status'];
    $Locked = $row['Locked'];
    $validUpto='NA';
    $password= $row['Password'];
          }
?>


     <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header badge-success">
                <div class="row">
                  <div class="col-lg-11 col-sm-10"> <div class="widget-user-image">
                  <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($img).'" height="50" width="50" class="img-circle elevation-2"  style="border-radius:50%"/>';?>
                </div>
                <!-- /.widget-user-image -->
                <h6 class="widget-user-username"><b><?=$name; ?></b></h6>
                <h6 class="widget-user-desc">Class Roll No&nbsp;:&nbsp;<?php if($ClassRollNo!=''){ echo $ClassRollNo;}else{echo "<b class='text-warning' style='font-size:16px'>Not Updated</b>";} ?><br>Uni Roll No&nbsp;:&nbsp;<?php if($UniRollNo!=''){ echo $UniRollNo;}else{echo "<b class='text-warning' style='font-size:16px'>Not Issued yet</b>";} ?><br>IDNO&nbsp;:&nbsp;<?=$IDNo;?></h6>
                </div>
                <div class="col-lg-1 col-sm-1">

        </div>
             </div>
               
               


              </div>

              <div class="card-footer p-0" style="text-align: left;">
                <ul class="nav flex-column">
                  <li class="nav-item">
                     <li class="nav-link"><b>Father Name </b> :&nbsp;&nbsp;&nbsp;<?= $father_name; ?></li>
                  </li>
                
                  <li class="nav-item">
                     <li class="nav-link"><b>Batch</b>&nbsp;&nbsp;&nbsp;:
                        <select class="btn btn-md" id="ubatch" >
<option value="<?=$Batch;?>"><?=$Batch;?></option>
                        <?php
for($i=$Batch-5;$i<$Batch+5;$i++)
{?>
<option value="<?=$i;?>"><?=$i;?></option>
<?php 
}                     ?>
                  </select>
                  </li>
                  </li>



                   <li class="nav-item">
                     <li class="nav-link"><b>ABC ID</b> :&nbsp;&nbsp;&nbsp;<?php if($abcid!=''){echo $abcid; 

?><button class="btn btn-warning btn-xs" style="margin-left: 50px" onclick="abcidreset(<?= $IDNo;?>)" >Clear ABC ID</button> <?php 
                     } else {

                        echo "NA";
                      } ?>  </li>

                        <li class="nav-link"><b>Password</b> :&nbsp;&nbsp;&nbsp;<?php echo $password; 

?><button class="btn btn-warning btn-xs" style="margin-left: 50px" onclick="passwordreset(<?= $IDNo;?>)" >Reset Password</button> <?php 
                      ?>  </li>
                     
      <li class="nav-link"><b>College</b> :&nbsp;&nbsp;&nbsp;<?= $college; ?>&nbsp;<b>(<?= $CollegeID;?>)</b></li>
                 
                     <li class="nav-link"><b>Course</b> :&nbsp;&nbsp;&nbsp;<?= $Course; ?>&nbsp;<b>(<?= $CourseID;?>)</b></li>
         
                
                    



                     <li class="nav-link"><b>Status</b> :&nbsp;&nbsp;&nbsp;<b class="text-danger">


<?php if ($Status==0)  {

                        echo "Left";?>  
                     <?php } else{
                        echo "Active";?>   
                     <?php
                     } ?></b>

                        <select class="btn btn-md" id='ustatus'>

<option value="<?=$Status;?>">Select</option>
<option value="1">Active</option>
<option value="0">Left</option>

                     ?>
                  </select>


                     </li>
     <li class="nav-link"><b>Lock Status</b> :&nbsp;&nbsp;&nbsp;


<?php if ($Locked==1)  {?>
   <b class="text-danger">
   <i class="fa fa-lock"></i></b> 

                       
                     <?php }
                     else
                        {
                           echo "<b class='text-success'><i class='fa fa-lock-open'></i></b>";

                        }?>

                        <select class="btn btn-md" id='ulocked'>

<option value="<?=$Locked;?>">Select</option>
<option value="0">Unlock</option>
<option value="1">Lock</option>



                     ?>
                  </select>
                     </li>
                  </li>                                  
                </ul>
              </div>
            </div>  </div>   
<div class="modal-footer">    
   <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">Close</button>
   <button type="submit" class="btn btn-primary btn-xs" onclick="updateStudentdata(<?= $IDNo;?>)">Update</button>
   </div>
       
<?php 
       }
   
   
elseif($code==220)
{
      
   $batch=$_POST['batch'];
    $status=$_POST['status'];
   $lock=$_POST['lock'];
   $id=$_POST['id'];
   
   $update_student="UPDATE Admissions SET Batch='$batch',Status='$status',Locked='$lock' where IDNo='$id'";
   $update_run=sqlsrv_query($conntest,$update_student);


    $update_studentb="UPDATE Ledger  SET Batch='$batch' where IDNo='$id'";
   $update_runb=sqlsrv_query($conntest,$update_studentb);


  if ($update_runb==true)
    {
       echo "1";
      // die( print_r( sqlsrv_errors(), true) );
   }
   else
   {
       echo "0";
      // die( print_r( sqlsrv_errors(), true) );

   }

   }

elseif($code==221)
{
      
   $semester=$_POST['id_array_main'];
    $exam_type=$_POST['exam_type'];
   $start_date=$_POST['start_date'];
   $end_date=$_POST['end_date'];
   foreach($semester as $key => $val)
   {
    $update_permission="UPDATE DDL_TheroyExaminationSemester SET StartDate='$start_date',EndDate='$end_date' where DDL_TE_ID='$exam_type' and SemesterId='$val'";
   $update_run=sqlsrv_query($conntest,$update_permission);
}
  if ($update_run==true)
    {
       echo "1";
      // die( print_r( sqlsrv_errors(), true) );
   }
   else
   {
       echo "0";
      // die( print_r( sqlsrv_errors(), true) );

   }

   }
   elseif($code==222)
{
      

   $id=$_POST['id'];
   $semester=$_POST['sem'];
  
    $update_permission="select * from DDL_TheroyExaminationSemester where DDL_TE_ID='$id' and SemesterId='$semester'";
   $update_run=sqlsrv_query($conntest,$update_permission);
 if($row=sqlsrv_fetch_array($update_run,SQLSRV_FETCH_ASSOC))
 {
   ?>
<div class="col-lg-12">
   <label>Start Date</label>
   <input type="date" name="" id="start_date_edit" class="form-control" value="<?=$row['StartDate']->format('Y-m-d');?>">
</div>

<div class="col-lg-12">
    <label>End Date</label>
   <input type="date" name="" id="end_date_edit" class="form-control" value="<?=$row['StartDate']->format('Y-m-d');?>">
</div>
<div class="col-lg-12">
    <label>Action</label><br>
   <input type="button" onclick="update_date_end_date(<?=$id;?>,<?=$semester;?>);"  class="btn btn-success" value="Update">
</div>
<?php 

 }

   }  
    elseif($code==223)
   {
   $id=$_POST['id'];
   $semester=$_POST['sem'];
   $start_date_edit=$_POST['start_date_edit'];
   $end_date_edit=$_POST['end_date_edit'];
   $update_permission="UPDATE DDL_TheroyExaminationSemester SET StartDate='$start_date_edit',EndDate='$end_date_edit' where DDL_TE_ID='$id' and SemesterId='$semester'";
   $update_run=sqlsrv_query($conntest,$update_permission);

  if ($update_run==true)
    {
       echo "1";   
    }
   else
    {
       echo "0";
    }

   } 
    elseif($code==224)
 {
      $univ_rollno=$_POST['uni'];
   
                     $count=0;
                     $degree="SELECT * FROM degree_print where UniRollNo='$univ_rollno'";                     
                     $degree_run=mysqli_query($conn,$degree);
                     while ($degree_row=mysqli_fetch_array($degree_run)) 
                     {
                        $count++;
                        ?>
                        <tr>
                           <td><?=$count;?></td>
                           <td><?=$degree_row['StudentName'];?></td>
                           <td><?=$degree_row['UniRollNo'];?></td>
                           <td><?=$degree_row['FatherName'];?></td>
                           <td><?=$degree_row['MotherName'];?></td>
                           <td><?=$degree_row['Examination'];?></td>
                           <td><?=$degree_row['Course'];?></td>
                           <td><?=$degree_row['CGPA'];?></td>
                      
                           <td>
                              <form action='print_degree.php' method='post'>
                                 <input type="hidden" name="code" value="1">
                        <input type='hidden' name='p_id' value="<?=$degree_row['id'];?>">
                        <button type='submit' class='btn border-0 shadow-none' style='background-color:transparent; border:display none' formtarget='_blank' >
                            <i  class='fa fa-print' aria-hidden='true'></i>
                        </button>
                    </form>
                 </td>
                        </tr>
                        <?php
                      }
                  
   }

elseif($code==231)
   {
      
      $id=$_POST['id'];
   
  $update_student="UPDATE UserMaster SET Password='12345678' where UserName='$id'";
   $update_run=sqlsrv_query($conntest,$update_student);
 
  if ($update_run==true)
    {
       echo "1";
      
   }
   else
   {
          echo "0";
   
   }
   }

elseif($code==232)
   {
    $id=$_POST['id'];
   
   $update_student="UPDATE Admissions SET ABCID=NULL where IDNo='$id'";
   $update_run=sqlsrv_query($conntest,$update_student);
 
  if ($update_run==true)
    {
       echo "1";
      
   }
   else
   {
          echo "0";
   
   }
   }
elseif($code==233)
   {
   $id=$_POST['id'];
   
 $result1 = "SELECT  * FROM Staff where IDNo='$id'";
               $stmt1 = sqlsrv_query($conntest,$result1);
               while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
               {
           
                 $StaffName= $row['Name'];
                  $empID= $row['IDNo'];
                 $Department= $row['Department'];
                 $UniRollNo= $row['MotherName'];
                 $Designation = $row['Designation'];
   
               }?>
               <div class="row">
                  <div class="col-lg-6">
 <div class="card card-widget widget-user-2" style="width:400px" id="printableArea">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header badge-success">
                <div class="row">
                  <div class="col-lg-11 col-sm-10"> <div class="widget-user-image">
                  
                </div>
                <!-- /.widget-user-image -->
                <h6 class="widget-user-username"><b> <?= $StaffName ;?>  (<?=$empID?>) </b></h6>
                <h6 class="widget-user-desc"><?= $Designation;?>(<?= $Department;?>)</h6>
                </div>
                <div class="col-lg-1 col-sm-1">

  
       
      
      </div>
             </div>
               
               


              </div>


              <div class="card-footer p-0">
                <ul class="nav flex-column">


<?php
                     $article="SELECT distinct ArticleName,stock_summary.ArticleCode as acode  from master_article inner join stock_summary ON stock_summary.ArticleCode=master_article.ArticleCode INNER JOIN location_master ON location_master.ID=stock_summary.LocationID inner join category_permissions ON category_permissions.CategoryCode=master_article.CategoryCode where  stock_summary.Status='2' and  stock_summary.Corrent_owner='$empID' and employee_id='$EmployeeID' ";
                     
                     $article_run=mysqli_query($conn,$article);
                     while ($article_row=mysqli_fetch_array($article_run)) 
                     {
                          $count=0;
                         ?>
                  

                  <li class="nav-item">
                     <li class="nav-link"><b><?=$article_row['ArticleName']?> :&nbsp;&nbsp;&nbsp; </b> 
<?php  $article_code=$article_row['acode'];

                         $qry="SELECT * FROM stock_summary   where Status='2' and Corrent_owner='$empID' and ArticleCode='$article_code' order by IDNo DESC";
                      $run=mysqli_query($conn,$qry);
                      while($data=mysqli_fetch_array($run))
                      {
                          $count++;
                      }
                    echo   $count;
                     ?>


                       


                        </li>
                  </li>
                
                  <?php
                     }
                     
                     ?>             
                     


                  
                   
                  
                  
                </ul>
              </div>
            </div>
         </div>

         <div class="col-lg-5"><div  id='noduesreponse'></div><button class="btn btn-success" onclick="cleardues(<?= $empID?>)">Clear Dues</button></div>
 <?php 
 
   }


elseif($code==234)
   {
   $id=$_POST['id'];

   $result1 = "SELECT count(*) as count FROM location_master WHERE location_owner='$id'";
               $run=mysqli_query($conn,$result1);
                      while($data=mysqli_fetch_array($run))
               {           
                  $loc=$data['count'];
               }

if($loc>0)
{
  echo "<div class='alert alert-danger' role='alert'>  Unable  to clear dues, ower of $loc locations </div>";
}
else{


   $result1 = "SELECT * from stock_summary where Corrent_owner='$id'";

               $run=mysqli_query($conn,$result1);
                      while($data=mysqli_fetch_array($run))
               {           
                 echo  $loc=$data['LocationID'];
               }


}

            }

elseif($code==235)
   {
   $oldowner=$_POST['oldowner'];
   $newowner=$_POST['newowner'];

   $result1 = "SELECT count(*) as count FROM location_master WHERE location_owner='$oldowner'";
               $run=mysqli_query($conn,$result1);
                      while($data=mysqli_fetch_array($run))
               {           
                  $loc=$data['count'];
               }

if($loc>0)
{



 $staff="SELECT count(IDNO) as noofemp  FROM Staff Where IDNo='$newowner'";
 $stmt = sqlsrv_query($conntest,$staff);  
 while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
     {

    $noofemp =$row_staff['noofemp'];

       }


if($noofemp>0)
{
  $result1 ="UPDATE location_master set location_owner='$newowner' where location_owner='$oldowner'";

               $run=mysqli_query($conn,$result1);
                 echo "<div class='alert alert-success' role='alert'> $loc location Owner Changed Success </div>";    
 
}
else{

 
           echo "<div class='alert alert-danger' role='alert'> Employee does not exist </div>";    

}
}
else
{
    echo "<div class='alert alert-danger' role='alert'> Not a location Owner </div>";    
}
}

 elseif ($code ==236)
    {
      $course= $_POST['course'];

$batch= $_POST['batch'];

$sem= $_POST['sem'];

$college= $_POST['college'];

$subject= $_POST['subject'];

$examination= $_POST['examination'];


   $sql = "SELECT id,Practical_Name  FROM MasterPracticals WHERE CourseID ='$course' AND SemesterID='$sem' ANd Batch='$batch' ANd SubCode='$subject' ANd Session='$examination' ANd  CollegeID='$college' ";


 $stmt2 = sqlsrv_query($conntest,$sql);
 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
 {
   ?>
   <option value='<?= $row1["id"];?>'><?= $row1["Practical_Name"];?></option>";
 <?php 
 }

   }

 elseif ($code ==237)
    {
      

$examination= $_POST['examination'];

$practicals=array();

$sql = "SELECT id  FROM MasterPracticals WHERE  Session='$examination'";

$stmt2 = sqlsrv_query($conntest,$sql);
 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
 {
   $practicals[]=$row1['id'];

 }
 $length =sizeof($practicals);

for($pr=0;$pr<$length;$pr++)
{
  echo  $sql = "UPDATE PracticalMarks  set Locked='1' WHERE  PID='$practicals[$pr]'";

$stmt2 = sqlsrv_query($conntest,$sql);

   }
   echo "1";


}
 elseif ($code ==238)
    {
      

$examination= $_POST['examination'];

$practicals=array();

$sql = "SELECT id  FROM MasterPracticals WHERE  Session='$examination'";

$stmt2 = sqlsrv_query($conntest,$sql);
 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
 {
   $practicals[]=$row1['id'];

 }
 $length =sizeof($practicals);

for($pr=0;$pr<$length;$pr++)
{
  echo  $sql = "UPDATE PracticalMarks  set Locked=NULL WHERE  PID='$practicals[$pr]'";

$stmt2 = sqlsrv_query($conntest,$sql);

   }
   echo "1";


}

elseif($code==239)
   {
    $id=$_POST['id'];
   
    echo $sql = "UPDATE PracticalMarks  set Locked='1' WHERE  id='$id'";

$stmt2 = sqlsrv_query($conntest,$sql);
 
  if ($stmt2==true)
    {
       echo "1";
      
   }
   else
   {
          echo "0";
   
   }
   }

elseif($code==240)
   {
    $id=$_POST['id'];
   
    echo $sql = "UPDATE PracticalMarks  set Locked=NULL WHERE  id='$id'";

$stmt2 = sqlsrv_query($conntest,$sql);
 
  if ($stmt2==true)
    {
       echo "1";
      
   }
   else
   {
          echo "0";
   
   }
   }

 elseif($code==225)

   {
     ?>
        <div class="card">
        <center>
         <h5>
         <b>ADD</b>
        </h5>
        </center>
        </div>
           <div class="row">
              <div class="col-lg-3">
                <label>College Name</label>
                 <select  name="College" id='College' onchange="courseByCollege(this.value);" class="form-control">
                 <option value=''>Select Course</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
              </div>
              <div class="col-lg-3">
                 <label>Course</label>
                  <select  id="Course" class="form-control">
                     <option value=''>Select Course</option>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label>Batch</label>
                   <select id="batch"  class="form-control">
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label>Semester</label>
                      <select   id='semester' class="form-control">
                       <option value="">Sem</option>
                     <?php 
                        for($i=1;$i<=14;$i++)
                           {?>
                     <option value="<?=$i?>"><?=$i?></option>
                     <?php }
            ?>
            </select>
              </div>
            
            </div>
             <div class="row">
              <div class="col-lg-3">
                <label>Subject Name</label>
                <input type="text" id="subject_name" class="form-control">
              </div>
              <div class="col-lg-3">
                 <label>Subject Code</label>
                <input type="text" id="subject_code" class="form-control">

              </div>
              <div class="col-lg-3">
                 <label>Subject Type</label>
                 <select class="form-control" id="subject_type">
                    <option value="">Select</option>
                    <option value="T">Theory</option>
                    <option value="P">Practical</option>
                    <option value="M">MOOC</option>
                    <option value="V">Value Added</option>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label>Subject Group</label>
                    <select id="subject_group" class="form-control" required="">
                        <option value="">Group</option>
                       <?php
                           $sql="SELECT DISTINCT Sgroup from MasterCourseStructure Order by Sgroup ASC ";
                                  $stmt2 = sqlsrv_query($conntest,$sql);
                                 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                     {
                                     $Sgroup = $row1['Sgroup']; 
                                        ?>
                              <option  value="<?=$Sgroup;?>"><?=$Sgroup;?></option>
                              <?php    }
                                          ?>      
              </select>
              </div>
           </div>
         <div class="row">
            
              <div class="col-lg-3">
                <label>Int. Max Marks</label>
                <input type="number"  id="int_marks" class="form-control">

              </div>
              <div class="col-lg-3">
                 <label>Ext. Max Marks</label>
                <input type="number" id="ext_marks" class="form-control">

              </div>
              <div class="col-lg-3">
                 <label>Elective</label>
                 <select class="form-control" id="elective">
                   
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label>Lecture</label>
                <input type="text" id="lecture" class="form-control">

              </div>
           </div>
        <div class="row">
              <div class="col-lg-3">
                <label>Practical</label>
                <input type="text" id="practical" class="form-control">
              </div>
              <div class="col-lg-3">
                 <label>Tutorials</label>
                <input type="text" id="tutorials" class="form-control">
              </div>
              <div class="col-lg-3">
                 <label>No OF Credits</label>
                <input type="text" id="credits" class="form-control">
              </div>
              <div class="col-lg-3">
              </div>
           </div><br>
        <div class="row text-center">
         
           <button class="btn btn-success" onclick="add_submit();">Submit</button>
        
        </div>

  <?php  
}
 elseif($code==226)
   {
     ?>
        <div class="card">
        <center>
         <h5>
         <b>Study Scheme Search</b>
        </h5>
        </center>
        </div>
           <div class="row">
              <div class="col-lg-3">
                <label>College Name</label>
                 <select  name="College" id='College' onchange="courseByCollege(this.value);" class="form-control">
                 <option value=''>Select Course</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
              </div>
              <div class="col-lg-2">
                 <label>Course</label>
                  <select  id="Course" class="form-control">
                     <option value=''>Select Course</option>
                 </select>
              </div>
              <div class="col-lg-2">
                 <label>Batch</label>
                   <select id="batch"  class="form-control">
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label>Semester</label>
                      <select   id='semester' class="form-control">
                       <option value="">Sem</option>
                     <?php 
                        for($i=1;$i<=14;$i++)
                           {?>
                     <option value="<?=$i?>"><?=$i?></option>
                     <?php }
            ?>
            </select>
              </div>
              <div class="col-lg-2">
                 <label>Action</label><br>
                 <button onclick="search_study_scheme();" class="btn btn-success">Search</button>
              </div>
            
            </div>
<br>
            <div class="row" id="load_study_scheme">

             
            </div>
        </div>

  <?php  
}
elseif($code==227)
{
                  $CollegeID=$_POST['CollegeID'];
                  $Course=$_POST['Course'];
                  $Batch=$_POST['Batch'];
                  $Semester=$_POST['Semester'];
?>
                  <div class="col-lg-6 ">
                  <div class="card-header">
                     Study Scheme
                  </div>
                     <div  class="table table-responsive table-bordered table-hover" style="font-size:12px;">
                        <table class="table">
                           <tr>
                              <th>Srno</th>
                              <th>Course</th>
                              <th>Batch</th>
                              <th>Semester</th>
                              <th>Name</th>
                              <th>Code</th>
                              <th>Type</th>
                                 <td><input type="checkbox" id="select_all" onclick="un_verifiy_select();"></td>
                           </tr>
                     <?php 

                         $get_study_scheme="SELECT * FROM MasterCourseStructure WHERE CollegeID='$CollegeID' and CourseID='$Course' and Batch='$Batch' and SemesterID='$Semester' and IsVerified='0'";
                        $get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme);
                        $count_0=0;
                        while($get_row=sqlsrv_fetch_array($get_study_scheme_run,SQLSRV_FETCH_ASSOC))
                        {
                            $count_0++;
                           ?>
                              <tr>
                                 <td><?=$count_0;?></td>
                                 <td><?=$get_row['Course'];?></td>
                                 <td><?=$get_row['Batch'];?></td>
                                 <td><?=$get_row['Semester'];?></td>
                                 <td><?=$get_row['SubjectName'];?></td>
                                 <td><?=$get_row['SubjectCode'];?></td>
                                 <td><?=$get_row['SubjectType'];?></td>
                                 <td><input type="checkbox" class="checkbox un_check"  value="<?=$get_row['SrNo'];?>"></td>
                       
                              </tr>
                        <?php
                         // print_r($get_row);
                         }
                       
                       ?>
                    </table>
                  </div>
                   <?php  
                  if ($count_0>0)
                        {   
                 ?>
                  <input type="button" value="Verify" class="btn btn-success" onclick="verifiy();">
                  <?php  } ?>
                  </div>
                   
                      <div class="col-lg-6">
                   <div class="card-header">
                    Varified Study Scheme
                  </div>

                    <div class="table-responsive " style="font-size:12px;">
                        <table class="table table-bordered table-hover">
                           <tr>
                              <th>Course</th>
                              <th>Batch</th>
                              <th>Semester</th>
                              <th>Name</th>
                              <th>Code</th>
                              <th>Type</th>
                              <th><input type="checkbox"  id="select_all1" onclick="verifiy_select();" ></th>
                           </tr>
                     <?php 
                         $get_study_scheme="SELECT * FROM MasterCourseStructure WHERE CollegeID='$CollegeID' and CourseID='$Course' and Batch='$Batch' and SemesterID='$Semester' and IsVerified=1";
                        $get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme);
                        $count_1=0;
                        while($get_row=sqlsrv_fetch_array($get_study_scheme_run,SQLSRV_FETCH_ASSOC))
                        {
                            $count_1++;
                           ?>
                              <tr>   
                                 <td><?=$get_row['Course'];?></td>
                                 <td><?=$get_row['Batch'];?></td>
                                 <td><?=$get_row['Semester'];?></td>
                                 <td><?=$get_row['SubjectName'];?></td>
                                 <td><?=$get_row['SubjectCode'];?></td>
                                 <td><?=$get_row['SubjectType'];?></td>
                                 <td><input type="checkbox" class="checkbox v_check" value="<?=$get_row['SrNo'];?>"></td>   
                              </tr>
                        <?php 
                     }  
                       ?>
                    </table>
                  </div>
                  <?php  
                  if ($count_1>0)
                        {   
                 ?>
                  <input type="button" value="<< UnVerify" onClick="un_verifiy();" class="btn btn-success">
                  <?php  } ?>
               </div>
<?php
}
elseif($code==228)
   {
     ?>
        <div class="card">
        <center>
         <h5>
         <b>Move</b>
        </h5>
        </center>
        </div>
           <div class="row">
              <div class="col-lg-6">
                <label>College Name</label>
                 <select  name="College" id='College' onchange="courseByCollege(this.value);" class="form-control">
                 <option value=''>Select</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
              </div>
               <div class="col-lg-6">
                 <label>Course</label>
                  <select  id="Course" onchange="onchange_sem();"  class="form-control">
                     <option value=''>Select</option>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label> From Semester</label>
                      <select   id='from_semester' onchange="onchange_batch();" class="form-control">
                       <option value="">Select</option>
                  
            </select>
              </div>
               <div class="col-lg-3">
                 <label> To Semester</label>
                      <select   id='to_semester' class="form-control">
                                             <option value="">Batch</option>

                     <?php 
                        for($i=1;$i<=14;$i++)
                           {?>
                     <option value="<?=$i?>"><?=$i?></option>
                     <?php }
            ?>
            </select>
              </div>
             
              <div class="col-lg-3">
                 <label>From Batch</label>
                   <select id="from_batch"  class="form-control">
                                              <option value="">Batch</option>

                          
                 </select>
              </div> 
              <div class="col-lg-3">
                 <label> To Batch</label>
                   <select id="to_batch"  class="form-control">
                                              <option value="">Batch</option>

                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
              </div>
              <div class="col-lg-2">
                 <!-- <label>Action</label> -->
                  <br>
                 <button onclick="move_study_scheme();" class="btn btn-success">Move</button>
              </div>
            
            </div>
<br>
            <div class="row" id="load_study_scheme">

             
            </div>
        </div>

  <?php  
}

elseif($code==229)
   {
     ?>
        <div class="card">
        <center>
         <h5>
         <b>Copy</b>
        </h5>
        </center>
        </div>
           <div class="row">
              <div class="col-lg-6">
                <label>College Name</label>
                 <select  name="College" id='College' onchange="courseByCollege(this.value);" class="form-control">
                 <option value=''>Select Course</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
              </div>
               <div class="col-lg-6">
                 <label>Course</label>
                  <select  id="Course" onchange="onchange_sem();"  class="form-control">
                     <option value=''>Select Course</option>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label> From Semester</label>
                      <select   id='from_semester' onchange="onchange_batch();" class="form-control">
                       <option value="">Select</option>
                
            </select>
              </div>
             
             
              <div class="col-lg-3">
                 <label>From Batch</label>
                   <select id="from_batch"  class="form-control">
                       <option value="">Batch</option>
                       
                 </select>
              </div> 
            
              <div class="col-lg-3">
                 <label> To Sem</label>
                   <select id="to_semester"  class="form-control">
                       <option value="">Batch</option>
                          <?php 
                              for($i=1;$i<=15;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
              </div><div class="col-lg-3">
                 <label> To Batch</label>
                   <select id="to_batch"  class="form-control">
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
              </div>
              <div class="col-lg-2">
                 <!-- <label>Action</label> -->
                  <br>
                 <button onclick="copy_study_scheme();" class="btn btn-success">Move</button>
              </div>
            
            </div>
<br>
            <div class="row" id="load_study_scheme">

             
            </div>
        </div>

  <?php  
}
elseif($code==230)
   {
     ?>
        <div class="card">
        <center>
         <h5>
         <b>Study Scheme Update</b>
        </h5>
        </center>
        </div>
           <div class="row">
              <div class="col-lg-3">
                <label>College Name</label>
                 <select  name="College" id='College' onchange="courseByCollege(this.value);" class="form-control">
                 <option value=''>Select Course</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
              </div>
              <div class="col-lg-2">
                 <label>Course</label>
                  <select  id="Course" class="form-control">
                     <option value=''>Select Course</option>
                 </select>
              </div>
              <div class="col-lg-2">
                 <label>Batch</label>
                   <select id="batch"  class="form-control">
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label>Semester</label>
                      <select   id='semester' class="form-control">
                       <option value="">Sem</option>
                     <?php 
                        for($i=1;$i<=14;$i++)
                           {?>
                     <option value="<?=$i?>"><?=$i?></option>
                     <?php }
            ?>
            </select>
              </div>
              <div class="col-lg-2">
                 <label>Action</label><br>
                 <button onclick="update_study_scheme_search();" class="btn btn-success">Search</button>
              </div>
            
            </div>
<br>
            <div class="row" id="load_study_scheme">

             
            </div>
        </div>

  <?php  
}
elseif($code==241)
   {
     ?>
        <div class="card">
        <center>
         <h5>
         <b>Study Scheme Upload</b>
        </h5>
        </center>
        </div>
               <form id="upload_study_scheme" method="post" enctype="multipart/form-data" action="action.php">
           <div class="row">
              <div class="col-lg-3">
                  <input type="hidden" name="code" value="256" >
                <label>College Name</label>
                 <select  name="College" id='College' onchange="courseByCollege(this.value);" class="form-control">
                 <option value=''>Select Course</option>
                  <?php
                  $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
                        ?>
                        <option  value="<?=$CollegeID;?>"><?=$college;?></option>
                 <?php }
                        ?>
               </select> 
              </div>
              <div class="col-lg-3">
                 <label>Course</label>
                  <select  id="Course" name="Course" class="form-control">
                     <option value=''>Select Course</option>
                 </select>
              </div>
              <div class="col-lg-3">
                 <label>Batch</label>
                   <select id="batch" name="batch"  class="form-control">
                       <option value="">Batch</option>
                          <?php 
                              for($i=2013;$i<=2030;$i++)
                                 {?>
                               <option value="<?=$i?>"><?=$i?></option>
                           <?php }
                                  ?>
                 </select>
              </div>
              <div class="col-lg-2">
               <label>File .xls</label>
               <input type="file" name="file_exl" id="file_exl" class="form-control" name="" >
              </div>
          
              <div class="col-lg-1">
                 <label>Action</label><br>
                <input type="submit" name="" class="btn btn-success" value="Upload">
              </div>
            
            </div>
         </form>
        </div>

  <?php  
}
elseif($code==242)
{
      $SemesterID="";
      $semester="";
      $CollegeID=$_POST['CollegeID'];
      $SemesterID=$_POST['semester'];
      $CourseID=$_POST['CourseID'];
      $get_college_name="SELECT CollegeName,Course FROM MasterCourseCodes WHERE CollegeID='$CollegeID' and CourseID='$CourseID'";
         $get_college_name_run=sqlsrv_query($conntest,$get_college_name);           
         while($college_row=sqlsrv_fetch_array($get_college_name_run,SQLSRV_FETCH_ASSOC))
               {
               $CollegeName=$college_row['CollegeName'];                          
               $Course=$college_row['Course'];
               }
                  $get_semester="SELECT Semester FROM MasterCourseStructure WHERE SemesterID='$SemesterID'";
                  $get_semester_run=sqlsrv_query($conntest,$get_semester);        
                        while($sem_row=sqlsrv_fetch_array($get_semester_run,SQLSRV_FETCH_ASSOC))
                        {
                     $semester=$sem_row['Semester'];                          
                       }

               $batch=$_POST['batch'];
               $subject_name=$_POST['subject_name'];
               $subject_code=$_POST['subject_code'];
               $subject_type=$_POST['subject_type'];
               $subject_group=$_POST['subject_group'];
               $int_marks=$_POST['int_marks'];
               $ext_marks=$_POST['ext_marks'];
               $elective=$_POST['elective'];
               $lecture=$_POST['lecture'];
               $practical=$_POST['practical'];
               $tutorials=$_POST['tutorials'];
               $credits=$_POST['credits'];


               $add_study_scheme="INSERT INTO MasterCourseStructure (CollegeName,CollegeID,Course,CourseID,Batch,SemesterID,Semester,SubjectName,SubjectType,SubjectCode,Elective,IntMaxMarks,ExtMaxMarks,Lecture,Tutorial,Practical,SGroup,NoOFCredits,Isverified) VALUES('$CollegeName','$CollegeID','$Course','$CourseID','$batch','$SemesterID','$semester','$subject_name','$subject_type','$subject_code','$elective','$int_marks','$ext_marks','$lecture','$tutorials','$practical','$subject_group','$credits','0')";
               $add_study_scheme_run=sqlsrv_query($conntest,$add_study_scheme);
                  if ($add_study_scheme_run==true)
                   {
                  echo "1";   
                  }
                  else
                  {
                  echo "0";
                  }
 }
 elseif($code==243)
 {
   $ids=$_POST['subjectIDs'];

  // print_r($ids);
   foreach($ids as $key => $id)
   {
      // echo $id;
       $verified_study="UPDATE  MasterCourseStructure SET Isverified='1' WHERE SrNo='$id'";
         $verified_study_run=sqlsrv_query($conntest,$verified_study);  

   }
   if ($verified_study_run==true) {
      echo "1";
   }
   else
   {
      echo "0";
   }

 } 
 elseif($code==244)
 {
   $ids=$_POST['subjectIDs'];

  // print_r($ids);
   foreach($ids as $key => $id)
   {
      // echo $id;
       $verified_study="UPDATE  MasterCourseStructure SET Isverified='0' WHERE SrNo='$id'";
         $verified_study_run=sqlsrv_query($conntest,$verified_study);  

   }
   if ($verified_study_run==true) {
      echo "1";
   }
   else
   {
      echo "0";
   }

 }

elseif($code==260)
   {
      $pid_data =$_POST['pid_data']; 
 $pid_length=$_POST['pid_length'];


 for($i=0;$i<$pid_length;$i++)
  {
 $list_sqlw= "UPDATE  PracticalMarks set Locked='1' where id='$pid_data[$i]'";
  
  $stmt1 = sqlsrv_query($conntest,$list_sqlw);
}
 if ($stmt1==true) 
 {
   echo "1"; 
 }
 else
 {
  echo "0";
 }
   
   
}

elseif($code==261)
   {
      $pid_data =$_POST['pid_data']; 
 $pid_length=$_POST['pid_length'];


 for($i=0;$i<$pid_length;$i++)
  {
 $list_sqlw= "UPDATE  PracticalMarks set Locked=NULL where id='$pid_data[$i]'";
  
  $stmt1 = sqlsrv_query($conntest,$list_sqlw);
}
 if ($stmt1==true) 
 {
   echo "1";
 }
 else
 {
  echo "0";
 }
   
   
}

elseif($code==262)
   {
 $student_str =$_POST['student_str']; 
 $pmarks_str=$_POST['pmarks_str'];
 $vmarks_str=$_POST['vmarks_str'];
 $fmarks_str=$_POST['fmarks_str'];
 $len_student=$_POST['len_student'];
 $practicalid=$_POST['practicalid'];
 $internalupdatedby=$_POST['internalupdatedby'];
 for($i=0;$i<$len_student;$i++)

  {

 echo $sql1 = "{CALL AddPracticalMarks('$practicalid','$student_str[$i]','$pmarks_str[$i]','$vmarks_str[$i]','$fmarks_str[$i]','$internalupdatedby')}";

    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

 }

   
   
}


elseif ($code ==263)
    {
      $course= $_POST['course'];

$batch= $_POST['batch'];

$sem= $_POST['sem'];

$college= $_POST['college'];

$subject= $_POST['subject'];

$examination= $_POST['examination'];


   $sql = "SELECT id,Workshop_Name  FROM MasterWorkshop WHERE CourseID ='$course' AND SemesterID='$sem' ANd Batch='$batch'ANd SubCode='$subject' ANd Session='$examination' ANd  CollegeID='$college' ";


 $stmt2 = sqlsrv_query($conntest,$sql);
 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
 {
   ?>
   <option value='<?= $row1["id"];?>'><?= $row1["Workshop_Name"];?></option>";
 <?php 
 }

   }
elseif($code==264)
   {
      $pid_data =$_POST['pid_data']; 
 $pid_length=$_POST['pid_length'];


 for($i=0;$i<$pid_length;$i++)
  {
  $list_sqlw= "UPDATE  WorkshopMark set Locked='1' where id='$pid_data[$i]'";
  
  $stmt1 = sqlsrv_query($conntest,$list_sqlw);
}
 if ($stmt1==true) 
 {
  echo "1";
 }
else
{
 echo "0";
}
   
   
}

elseif($code==265)
   {
      $pid_data =$_POST['pid_data']; 
 $pid_length=$_POST['pid_length'];


 for($i=0;$i<$pid_length;$i++)
  {
  $list_sqlw= "UPDATE  WorkshopMark set Locked=NULL where id='$pid_data[$i]'";
  
  $stmt1 = sqlsrv_query($conntest,$list_sqlw);
}
 if ($stmt1==true) 
 {
  echo "1";
 }
else
{
 echo "0";
}
   
   
}

elseif($code==266)
   {
 $student_str =$_POST['student_str']; 
 $pmarks_str=$_POST['pmarks_str'];
 $len_student=$_POST['len_student'];
 $practicalid=$_POST['practicalid'];
 $internalupdatedby=$_POST['internalupdatedby'];
 for($i=0;$i<$len_student;$i++)

  {

 echo $sql1 = "{CALL AddWorkshopMarks('$practicalid','$student_str[$i]','$pmarks_str[$i]','$internalupdatedby')}";

    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

 }

   
   
}

elseif ($code ==267)
    {
      

$examination= $_POST['examination'];

$practicals=array();

$sql = "SELECT id  FROM MasterWorkshop WHERE  Session='$examination'";

$stmt2 = sqlsrv_query($conntest,$sql);
 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
 {
   $practicals[]=$row1['id'];

 }
 $length =sizeof($practicals);

for($pr=0;$pr<$length;$pr++)
{
  echo  $sql = "UPDATE WorkshopMark  set Locked='1' WHERE  PID='$practicals[$pr]'";

$stmt2 = sqlsrv_query($conntest,$sql);

   }
   echo "1";

 
}
 elseif ($code ==268)
    {
      

$examination= $_POST['examination'];

$practicals=array();

$sql = "SELECT id  FROM MasterWorkshop WHERE  Session='$examination'";

$stmt2 = sqlsrv_query($conntest,$sql);
 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
 {
   $practicals[]=$row1['id'];

 }
 $length =sizeof($practicals);

for($pr=0;$pr<$length;$pr++)
{
  echo  $sql = "UPDATE workshopMark  set Locked=NULL WHERE  PID='$practicals[$pr]'";

$stmt2 = sqlsrv_query($conntest,$sql);

   }
   echo "1";


}
elseif($code==269)
   {
    $id=$_POST['id'];
   
    echo $sql = "UPDATE WorkshopMark  set Locked='1' WHERE  id='$id'";

$stmt2 = sqlsrv_query($conntest,$sql);
 
  if ($stmt2==true)
    {
       echo "1";
      
   }
   else
   {
          echo "0";
   
   }
   }

elseif($code==270)
   {
    $id=$_POST['id'];
   
    echo $sql = "UPDATE WorkshopMark  set Locked=NULL WHERE  id='$id'";

$stmt2 = sqlsrv_query($conntest,$sql);
 
  if ($stmt2==true)
    {
       echo "1";
      
   }
   else
   {
          echo "0";
   
   }
   }
  elseif($code==245)
 {
$sql="SELECT * FROM id_card order by id ASC";
$result = mysqli_query($conn,$sql); 
while($row=mysqli_fetch_array($result))
{?>
    
  <tr>
    <td><input type="checkbox" name="" class="sel" value="<?=$row['id'];?>"></td>
    <td data-toggle="modal" data-target="#modal-lg-upload-image" onclick='photo_modal111(<?=$row['id']?>);photo_modal(<?=$row['id']?>);'><img src="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$row['image'];?>" style='width: 50px;height: 50px; border-radius: 50%;'></td>
     <td data-toggle="modal" data-target="#modal-lg-edit" onclick='edit_id_card("<?=$row['id'];?>");'><?=$row['name'];?></td>
      <td><?=$row['father_name'];?></td>
       <td><?=$row['course'];?></td>
        <td><?=$row['classroll'];?></td>
         <td><?=$row['college'];?></td>
          <td><?=$row['batch'];?></td>
          <td><?php
          if ($row['Status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
            <td><?php
          if ($row['buspass_status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
</tr>
<?php
    }
 } 

  elseif($code==246)
 {
$sql="SELECT * FROM id_card where Status='0'  order by id ASC";
$result = mysqli_query($conn,$sql); 
while($row=mysqli_fetch_array($result))
{?>
    
  <tr>
    <td><input type="checkbox" name="" class="sel" value="<?=$row['id'];?>"></td>
    <td data-toggle="modal" data-target="#modal-lg-upload-image" onclick='photo_modal111(<?=$row['id']?>);photo_modal(<?=$row['id']?>);'><img src="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$row['image'];?>" style='width: 50px;height: 50px; border-radius: 50%;'></td>
     <td data-toggle="modal" data-target="#modal-lg-edit" onclick='edit_id_card("<?=$row['id'];?>");'><?=$row['name'];?></td>
      <td><?=$row['father_name'];?></td>
       <td><?=$row['course'];?></td>
        <td><?=$row['classroll'];?></td>
         <td><?=$row['college'];?></td>
          <td><?=$row['batch'];?></td>
          <td><?php
          if ($row['Status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
            <td><?php
          if ($row['buspass_status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
</tr>
<?php
    }
 } 

  elseif($code==247)
 {
$sql="SELECT * FROM id_card where Status='1'  order by id ASC";
$result = mysqli_query($conn,$sql); 
while($row=mysqli_fetch_array($result))
{?>
    
  <tr>
    <td><input type="checkbox" name="" class="sel" value="<?=$row['id'];?>"></td>
    <td data-toggle="modal" data-target="#modal-lg-upload-image" onclick='photo_modal111(<?=$row['id']?>);photo_modal(<?=$row['id']?>);'><img src="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$row['image'];?>" style='width: 50px;height: 50px; border-radius: 50%;'></td>
     <td data-toggle="modal" data-target="#modal-lg-edit" onclick='edit_id_card("<?=$row['id'];?>");'><?=$row['name'];?></td>
      <td><?=$row['father_name'];?></td>
       <td><?=$row['course'];?></td>
        <td><?=$row['classroll'];?></td>
         <td><?=$row['college'];?></td>
          <td><?=$row['batch'];?></td>
          <td><?php
          if ($row['Status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
            <td><?php
          if ($row['buspass_status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
</tr>
<?php
    }
 } 

  elseif($code==248)
 {
$sql="SELECT * FROM id_card where buspass_status='0'  order by id ASC";
$result = mysqli_query($conn,$sql); 
while($row=mysqli_fetch_array($result))
{?>
    
  <tr>
    <td><input type="checkbox" name="" class="sel" value="<?=$row['id'];?>"></td>
    <td data-toggle="modal" data-target="#modal-lg-upload-image" onclick='photo_modal111(<?=$row['id']?>);photo_modal(<?=$row['id']?>);'><img src="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$row['image'];?>" style='width: 50px;height: 50px; border-radius: 50%;'></td>
     <td data-toggle="modal" data-target="#modal-lg-edit" onclick='edit_id_card("<?=$row['id'];?>");'><?=$row['name'];?></td>
      <td><?=$row['father_name'];?></td>
       <td><?=$row['course'];?></td>
        <td><?=$row['classroll'];?></td>
         <td><?=$row['college'];?></td>
          <td><?=$row['batch'];?></td>
          <td><?php
          if ($row['Status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
            <td><?php
          if ($row['buspass_status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
</tr>
<?php
    }
 }  

 elseif($code==249)
 {
$sql="SELECT * FROM id_card where buspass_status='1'  order by id ASC";
$result = mysqli_query($conn,$sql); 
while($row=mysqli_fetch_array($result))
{?>
    
  <tr>
    <td><input type="checkbox" name="" class="sel" value="<?=$row['id'];?>"></td>
    <td data-toggle="modal" data-target="#modal-lg-upload-image" onclick='photo_modal111(<?=$row['id']?>);photo_modal(<?=$row['id']?>);'><img src="http://gurukashiuniversity.co.in/data-server/ID_Card_images/<?=$row['image'];?>" style='width: 50px;height: 50px; border-radius: 50%;'></td>
     <td data-toggle="modal" data-target="#modal-lg-edit" onclick='edit_id_card("<?=$row['id'];?>");'><?=$row['name'];?></td>
      <td><?=$row['father_name'];?></td>
       <td><?=$row['course'];?></td>
        <td><?=$row['classroll'];?></td>
         <td><?=$row['college'];?></td>
          <td><?=$row['batch'];?></td>
          <td><?php
          if ($row['Status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
            <td><?php
          if ($row['buspass_status']==1)
           {?><P style="color:red;">Printed</P><?php
            
          }
          else
{?><P style="color:blue;">Pending</P>
  <?php


}?>
            </td>
</tr>
<?php
    }
 }
 elseif($code==250)
 {
       $CourseID=$_POST['CourseID'];
       $CollegeID=$_POST['CollegeID'];
       $from_batch=$_POST['from_batch'];
       $from_semester=$_POST['from_semester'];
       $to_batch=$_POST['to_batch'];
       $to_semester=$_POST['to_semester'];
       $get_semester="SELECT Semester FROM MasterCourseStructure WHERE SemesterID='$to_semester'";
       $get_semester_run=sqlsrv_query($conntest,$get_semester);        
             while($sem_row=sqlsrv_fetch_array($get_semester_run,SQLSRV_FETCH_ASSOC))
                   {
                   $semester=$sem_row['Semester'];                          
                   }
        $verified_study="UPDATE  MasterCourseStructure SET Batch='$to_batch',SemesterID='$to_semester',Semester='$semester' WHERE Batch='$from_batch' and SemesterID='$from_semester' and CourseID='$CourseID' and CollegeID='$CollegeID'";
         $verified_study_run=sqlsrv_query($conntest,$verified_study);  

         if ($verified_study_run==true) 
         {
            echo "1";
         }
         else
         {
            echo "0";
         }

 }
elseif($code==251)
{?>
    <option  value="">Select</option>
    <?php 
   $CourseID=$_POST['CourseID'];
       $CollegeID=$_POST['CollegeID'];
     $sql1="SELECT DISTINCT SemesterID from MasterCourseStructure  Where CourseID='$CourseID' and CollegeID='$CollegeID' ";
                     $stmt22 = sqlsrv_query($conntest,$sql1);
                     while($row11 = sqlsrv_fetch_array($stmt22, SQLSRV_FETCH_ASSOC))
                      {   
                        $SemesterID = $row11['SemesterID']; 
                        
                        ?>
                        <option  value="<?=$SemesterID;?>"><?=$SemesterID;?></option>
                 <?php }
}
elseif($code==252)
{?>
    <option  value="">Select</option>
    <?php 
   $CourseID=$_POST['CourseID'];
       $CollegeID=$_POST['CollegeID'];
       $from_semester=$_POST['from_semester'];
     $sql1="SELECT DISTINCT Batch from MasterCourseStructure  Where CourseID='$CourseID' and CollegeID='$CollegeID' and SemesterID='$from_semester' ";
                     $stmt22 = sqlsrv_query($conntest,$sql1);
                     while($row11 = sqlsrv_fetch_array($stmt22, SQLSRV_FETCH_ASSOC))
                      {   
                        $Batch = $row11['Batch']; 
                        
                        ?>
                        <option  value="<?=$Batch;?>"><?=$Batch;?></option>
                 <?php }
}
 elseif($code==253)
 {
   $semester="";
      $CollegeID=$_POST['CollegeID'];
       $from_semester=$_POST['from_semester'];
      $CourseID=$_POST['CourseID'];
       $from_batch=$_POST['from_batch'];
       $to_batch=$_POST['to_batch'];
       $to_semester=$_POST['to_semester'];
      $get_college_name="SELECT CollegeName,Course FROM MasterCourseCodes WHERE CollegeID='$CollegeID' and CourseID='$CourseID'";
         $get_college_name_run=sqlsrv_query($conntest,$get_college_name);           
         while($college_row=sqlsrv_fetch_array($get_college_name_run,SQLSRV_FETCH_ASSOC))
               {
               $CollegeName=$college_row['CollegeName'];                          
               $Course=$college_row['Course'];
               }
                  $get_semester="SELECT DISTINCT Semester FROM MasterCourseStructure WHERE SemesterID='$to_semester'";
                  $get_semester_run=sqlsrv_query($conntest,$get_semester);        
                        while($sem_row=sqlsrv_fetch_array($get_semester_run,SQLSRV_FETCH_ASSOC))
                        {
                     $semester=$sem_row['Semester'];                          
                       }

      $add_study_scheme="SELECT * FROM  MasterCourseStructure  WHERE Batch='$from_batch' and SemesterID='$from_semester' and CourseID='$CourseID' and CollegeID='$CollegeID' ";
         $verified_study_run=sqlsrv_query($conntest,$add_study_scheme);  

      while($row=sqlsrv_fetch_array($verified_study_run,SQLSRV_FETCH_ASSOC))
      {

               $subject_name=$row['SubjectName'];
               $subject_code=$row['SubjectCode'];
               $subject_type=$row['SubjectType'];
               $subject_group=$row['SGroup'];
               $int_marks=$row['IntMaxMarks'];
               $ext_marks=$row['ExtMaxMarks'];
               $elective=$row['Elective'];
               $lecture=$row['Lecture'];
               $practical=$row['Practical'];
               $tutorials=$row['Tutorial'];
               $credits=$row['NoOFCredits'];

         $verified_study1="INSERT INTO MasterCourseStructure (CollegeName,CollegeID,Course,CourseID,Batch,SemesterID,Semester,SubjectName,SubjectType,SubjectCode,Elective,IntMaxMarks,ExtMaxMarks,Lecture,Tutorial,Practical,SGroup,NoOFCredits,Isverified) VALUES('$CollegeName','$CollegeID','$Course','$CourseID','$to_batch','$to_semester','$semester','$subject_name','$subject_type','$subject_code','$elective','$int_marks','$ext_marks','$lecture','$tutorials','$practical','$subject_group','$credits','0')";
         $verified_study_run1=sqlsrv_query($conntest,$verified_study1);  
      }

         if ($verified_study_run1==true) 
         {
            echo "1";
         }
         else
         {
            echo "0";
         }

 }
 elseif($code==254)
{
                  $CollegeID=$_POST['CollegeID'];
                  $Course=$_POST['Course'];
                  $Batch=$_POST['Batch'];
                  $Semester=$_POST['Semester'];
?>
                  <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <div class="card-header">
                     Study Scheme Update
                  </div>
                     <div  class="table table-responsive table-bordered table-hover" style="font-size:12px;">
                        <table class="table">
                           <thead>
                           <tr>
                              <th>Srno</th>
                              <th>Name</th>
                              <th>Code</th>
                              <th colspan="3">Type</th>
                              <th>Int Marks</th>
                              <th>Ext Marks</th>
                              <th colspan="3">Elective</th>
                              <th>Lacture</th>
                              <th>Practical</th>
                              <th>Tutorial</th>
                              <th>No of Credits</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                     <?php 

                         $get_study_scheme="SELECT * FROM MasterCourseStructure WHERE CollegeID='$CollegeID' and CourseID='$Course' and Batch='$Batch' and SemesterID='$Semester' and IsVerified='1'";
                        $get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme);
                        $count_0=0;
                        while($get_row=sqlsrv_fetch_array($get_study_scheme_run,SQLSRV_FETCH_ASSOC))
                        {
                            $count_0++;
                           ?> 

                              <tr>
                                 <td><?=$count_0;?></td>
                                 <td><input type="text" class="form-control" id="subject_name<?=$get_row['SrNo'];?>" value="<?=$get_row['SubjectName'];?>">
                                    </td>
                                 <td colspan=""><input type="text" id="subject_code<?=$get_row['SrNo'];?>" class="form-control" value="<?=$get_row['SubjectCode'];?>"></td>
                                 <td colspan="3">
                                    <select class="form-control" id="subject_type<?=$get_row['SrNo'];?>">
                                       <option value="<?=$get_row['SubjectType'];?>"><?=$get_row['SubjectType'];?></option>
                                        <option value="T">Theory</option>
                                         <option value="P">Practical</option>
                                         <option value="M">MOOC</option>
                                         <option value="V">Value Added</option>
                                    </select>
                                    </td>
                                 <td><input type="text" id="int_marks<?=$get_row['SrNo'];?>" class="form-control" value="<?=$get_row['IntMaxMarks'];?>"></td>
                                 <td><input type="text" id="ext_marks<?=$get_row['SrNo'];?>" class="form-control" value="<?=$get_row['ExtMaxMarks'];?>"></td>
                                 <td colspan="3">
                                    <select class="form-control" id="elective<?=$get_row['SrNo'];?>">
                                       <option value="<?=$get_row['Elective'];?>"><?=$get_row['Elective'];?></option>
                                        <option value="YES">Yes</option>
                                         <option value="NO">No</option>
                                       
                                    </select>
                                 </td>
                                 <td><input type="text" id="lecture<?=$get_row['SrNo'];?>" class="form-control" value="<?=$get_row['Lecture'];?>"></td>
                                 <td><input type="text" id="practical<?=$get_row['SrNo'];?>" class="form-control" value="<?=$get_row['Practical'];?>"></td>
                                 <td><input type="text" id="tutorials<?=$get_row['SrNo'];?>" class="form-control" value="<?=$get_row['Tutorial'];?>"></td>
                                 <td><input type="text" id="credits<?=$get_row['SrNo'];?>" class="form-control" value="<?=$get_row['NoOFCredits'];?>"></td>
                                 <td><input type="text" value="<?=$get_row['SrNo'];?>"><button class="btn btn-success btn-xs" onclick="update_study_scheme('<?=$get_row['SrNo'];?>');" ><i class="fa fa-check" aria-hidden="true" style="color:white;" ></i></button></td>
                       
                              </tr>
                        <?php
                         // print_r($get_row);
                         }
                       
                       ?>
                    </tbody>
                    </table>
                  </div>
             
                  </div>
              
<?php
}
elseif($code==255)
{
              
               $SrNo=$_POST['srno'];
               $subject_name=$_POST['subject_name'];
               $subject_code=$_POST['subject_code'];
               $subject_type=$_POST['subject_type'];
               $int_marks=$_POST['int_marks'];
               $ext_marks=$_POST['ext_marks'];
               $elective=$_POST['elective'];
               $lecture=$_POST['lecture'];
               $practical=$_POST['practical'];
               $tutorials=$_POST['tutorials'];
               $credits=$_POST['credits'];
                $update_study="UPDATE  MasterCourseStructure SET SubjectName='$subject_name',SubjectType='$subject_type',SubjectCode='$subject_code',Elective='$elective',IntMaxMarks='$int_marks',ExtMaxMarks='$ext_marks',Lecture='$lecture',Tutorial='$tutorials',Practical='$practical',NoOFCredits='$credits' WHERE SrNo='$SrNo'";
         $update_study_run=sqlsrv_query($conntest,$update_study);  

         if ($update_study_run==true) 
         {
            echo "1";
         }
         else
         {
            echo "0";
         }
}
 elseif($code==256)
   {
            $file = $_FILES['file_exl']['tmp_name'];
            $CollegeID=$_POST['College'];
            $CourseID=$_POST['Course'];
             $batch=$_POST['batch'];
            $get_college_name="SELECT CollegeName,Course FROM MasterCourseCodes WHERE CollegeID='$CollegeID' and CourseID='$CourseID'";
         $get_college_name_run=sqlsrv_query($conntest,$get_college_name);           
         while($college_row=sqlsrv_fetch_array($get_college_name_run,SQLSRV_FETCH_ASSOC))
               {
               $CollegeName=$college_row['CollegeName'];                          
               $Course=$college_row['Course'];
               }
               
             $handle = fopen($file, 'r');
             $c = 0;
             while(($filesop = fgetcsv($handle, 1000, ',')) !== false)
            {
            $SemesterID = $filesop[0];
            $Semester = $filesop[1];
            $SubjectName = $filesop[2];
            $SubjectType = $filesop[3];
            $SubjectCode = $filesop[4];
            $SubjectShortName = $filesop[5];
            $Elective = $filesop[6];
            $IntMaxMarks = $filesop[7];
            $ExtMaxMarks = $filesop[8];
            $Lacture = $filesop[9];
            $Tutorials = $filesop[10];
            $Practical = $filesop[11];
            $NoOfCredits = $filesop[12];
            $SubjectGroup = $filesop[13];

                $add_study_scheme2="INSERT INTO MasterCourseStructure (CollegeName,CollegeID,Course,CourseID,Batch,SemesterID,Semester,SubjectName,SubjectType,SubjectCode,Elective,IntMaxMarks,ExtMaxMarks,Lecture,Tutorial,Practical,SGroup,NoOFCredits,Isverified,SubjectShortName) VALUES('$CollegeName','$CollegeID','$Course','$CourseID','$batch','$SemesterID','$Semester','$SubjectName','$SubjectType','$SubjectCode','$Elective','$IntMaxMarks','$ExtMaxMarks','$Lacture','$Tutorials','$Practical','$SubjectGroup','$NoOfCredits','0','$SubjectShortName')";
                 $add_study_scheme_run2=sqlsrv_query($conntest,$add_study_scheme2);
            }
                  // if ($add_study_scheme_run2==true)
                  //  {
                  // echo "1";   
                  // }
                  // else
                  // {
                  // echo "0";
                  // }
   }
 else
{
echo "select code";
}
} 
   
   ?>