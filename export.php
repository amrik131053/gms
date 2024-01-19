 <?php
session_start();
ini_set('max_execution_time', '0');

ob_start();
header("Content-Type: application/xls");
header("Pragma: no-cache");
header("Expires: 0");
include 'connection/connection.php';
$exportCode = '';
$fileName = 'My File';
if (isset($_POST['exportCode']))
{
    $exportCode = $_POST['exportCode'];
}
elseif (isset($_GET['exportCode']))
{
    $exportCode = $_GET['exportCode'];
}

if($exportCode==19 ||$exportCode==27||$exportCode==28)
   {
       include "connection/connection_web.php"; 

   }
   $getCurrentExamination="SELECT * FROM ExamDate";
   $getCurrentExamination_run=sqlsrv_query($conntest,$getCurrentExamination);
   if ($getCurrentExamination_row=sqlsrv_fetch_array($getCurrentExamination_run,SQLSRV_FETCH_ASSOC))
   {

$CurrentExamination=$getCurrentExamination_row['Month'].' '.$getCurrentExamination_row['Year'];

   }
if ($exportCode == 0)
{
    $count = 1;
    $officeOwnerID= $_POST['office_owner'];
    $article = "SELECT * from master_article ";
    echo 'Sr No' . "\t" . 'College Name' . "\t" . 'Floor' . "\t" . 'Room Name' . "\t" . 'Block' . "\t" . 'Room No.' . "\t". 'Location Owner ID' . "\t". 'Location Owner Name' . "\t";
    $article_run = mysqli_query($conn, $article);
    while ($article_row = mysqli_fetch_array($article_run))
    {
        echo $article_row['ArticleName'] . "\t";
    }
    echo "\n";
   if ($officeOwnerID!='') 
     {
         
                        $sql=" SELECT *, colleges.name as clg_name , user.name as employee_name, room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID left join user on location_master.location_owner=user.emp_id WHERE location_master.location_owner='$officeOwnerID'";
                     }
                     else
                     {
                        $sql=" SELECT *, colleges.name as clg_name , user.name as employee_name, room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID left join user on location_master.location_owner=user.emp_id ";

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
    $locationOwner=$data['location_owner'];
    $EmpName=$data['employee_name'];
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
       
        $building_num = 0;
        $arrayCount=0;
        $building = "SELECT * from master_article ";
        $building_run = mysqli_query($conn, $building);
        while ($building_row = mysqli_fetch_array($building_run))
        {
            $building_num = $building_num + 1;
            $articleName = $building_row['ArticleName'];
            $count1 = 0;
            $article_code = $building_row['ArticleCode'];
            $qry="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join location_master on location_master.ID=stock_summary.LocationID where stock_summary.Status='2' and location_master.Type='$RoomType' and location_master.ID='$lm_ID' and stock_summary.ArticleCode='$article_code' order by IDNo DESC";
            $run = mysqli_query($conn, $qry);
            while ($data = mysqli_fetch_array($run))
            {
                $count1++;
            }
             $array[$arrayIndex][]=$count1;
                $arrayCount++;
            //echo $count1 . "\t";
        }
        if(max($array[$arrayIndex])>0)
        {   

        echo $count . "\t" . $clgName . "\t" . $FloorName . "\t". $OfficeName . "\t". $block . "\t". $RoomNo . "\t". $locationOwner . "\t". $EmpName . "\t";
            for($i=0;$i<$arrayCount;$i++)
            {
                echo $array[$arrayIndex][$i]."\t";
            }
        echo "\n";
        }
             
        $count++;
        $arrayIndex++;
    }
}
elseif ($exportCode == 1)
{
    $RoomType = $_POST['roomTypeID'];
    $officeID = $_POST['office_ID'];
    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and location_master.Type='$RoomType' and location_master.ID='$officeID' order by IDNo DESC";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
        $location = "SELECT *, lm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['abc'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
    }
}
elseif ($exportCode == 2)
{
    $count = 1;
    $emp = $_POST['idEmp'];
    $article = "SELECT * from master_article ";
    echo 'Sr No' . "\t" . 'Employee ID' . "\t";
    $article_run = mysqli_query($conn, $article);
    while ($article_row = mysqli_fetch_array($article_run))
    {
        echo $article_row['ArticleName'] . "\t";
    }
    echo "\n";
    echo $count . "\t" . $emp . "\t";
    $building_num = 0;
    $building = "SELECT * from master_article ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $articleName = $building_row['ArticleName'];
        $count1 = 0;
        $article_code = $building_row['ArticleCode'];
        $qry = "SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode  where stock_summary.Status='2' and stock_summary.Corrent_owner='$emp' and stock_summary.ArticleCode='$article_code' order by IDNo DESC";
        $run = mysqli_query($conn, $qry);
        while ($data = mysqli_fetch_array($run))
        {
            $count1++;
        }
        $count1;
        $articleName;
        echo $count1 . "\t";
    }
    echo "\n";
}
elseif ($exportCode == 3)
{
    $emp_id = $_POST['idEmployee'];
    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and stock_summary.Corrent_owner='$emp_id' order by IDNo DESC  ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
        $location = "SELECT *, rm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['RoomNo'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
    }
}
elseif ($exportCode == 4)
{
    $locationOwnerID = $_POST['ownerID'];
    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = " SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and location_master.location_owner='$locationOwnerID' order by IDNo DESC  ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
        $location = "SELECT *, lm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['abc'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
    }
}
elseif ($exportCode == 5)
{
     $CategoryID = $_POST['Category_ID'];
     $ArticleCode = $_POST['Article_ID'];
     $article="SELECT * from master_article where ArticleCode='$ArticleCode'";
     $article_res=mysqli_query($conn,$article);
     while($article_data=mysqli_fetch_array($article_res))
     {
        $article_Name=$article_data['ArticleName'];
     }
     ?>
 <table border="1">
     <tr>
         <th>Sr. No.</th>
         <th>Block</th>
         <th>Room Name</th>
         <th>Room Type</th>
         <th>Room No</th>
         <th>Floor</th>
         <th>Article</th>
         <th>Count</th>
         <th>Employee ID</th>
         <th>Employee Name</th>
     </tr>
     <?php
    // echo 'Sr No' . "\t" . 'Block' . "\t" . 'Room Name' . "\t" . 'Room No' . "\t" . 'Floor' . "\t" . 'Article' . "\t" . 'Count' ."\t" . 'Employee ID' ."\t" . 'Employee Name' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT distinct location_master.ID as lmid , building_master.Name as Bname,location_owner, room_name_master.RoomName as rnm_RoomName,location_master.RoomNo as lmRoomNo, location_master.Floor as Floor_name, RoomType from location_master  left join  building_master on building_master.ID=location_master.Block left JOIN room_master ON room_master.FloorID=location_master.Floor inner join room_type_master  on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {   
        $location_num=0;
        
        $Floor=$building_row['Floor_name'];
        $locationID=$building_row['lmid'];
        // $roomNo=$building_row['lmRoomNo'];
        // $Block=$building_row['Bname'];
        // $room_Name=$building_row['rnm_RoomName'];
        // $locationOwner=$building_row['location_owner'];
        // $EmpName=$building_row['employee_name'];
        $userName='';
        $sql1 = "SELECT * FROM Staff Where IDNo=".$building_row['location_owner'];
        $q1 = sqlsrv_query($conntest, $sql1);
        while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
        {
            $userName = $row['Name'];
        }
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
        $location = "SELECT * from stock_summary where CategoryID='$CategoryID' and ArticleCode='$ArticleCode' and LocationID='$locationID' and Status='2'";
        $location_run = mysqli_query($conn, $location);
        while($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
        }
        if ($location_num!=0) 
        {$building_num++;
           
           ?>
     <tr>
         <td><?=$building_num?></td>
         <td><?=$building_row['Bname']?></td>
         <td><?=$building_row['rnm_RoomName']?></td>
         <td><?=$building_row['RoomType'];?></td>
         <td><?=$building_row['lmRoomNo']?></td>
         <td><?=$FloorName?></td>
         <td><?=$article_Name?></td>
         <td><?=$location_num?></td>
         <td><?=$building_row['location_owner']?></td>
         <td><?=$userName?></td>
     </tr>
     <?php 
           // echo $building_num . "\t" . $Block . "\t" .  $room_Name . "\t" . $roomNo. "\t" . $FloorName . "\t" . $article_Name . "\t" . $location_num ."\t" . $locationOwner ."\t" . $EmpName .  "\n";
        }
    }
    ?>
 </table>
 <?php
}

elseif ($exportCode == 6)
{
     $CategoryID = $_POST['Category_id_'];
     $ArticleCode = $_POST['Article_id_'];
     $LocationID = $_POST['Location_id_'];
    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and stock_summary.CategoryID='$CategoryID' and stock_summary.ArticleCode='$ArticleCode' and stock_summary.LocationID='$LocationID' order by IDNo DESC  ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
        $location = "SELECT *, rm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['RoomNo'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
    }
}

elseif ($exportCode == 7)
{
     $CategoryID = $_POST['Category_id_'];
     $ArticleCode = $_POST['Article_id_'];
     $LocationID = $_POST['Location_id_'];
    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and stock_summary.CategoryID='$CategoryID' and stock_summary.ArticleCode='$ArticleCode' and stock_summary.LocationID='$LocationID' order by IDNo DESC  ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
        $location = "SELECT *, rm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['RoomNo'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
    }
}
elseif ($exportCode == 8)
{
     $RoomType = $_POST['roomTypeID'];
     $officeID = $_POST['office_ID'];
    
    $countforarray=0;
                           $article="SELECT distinct stock_summary.ArticleCode as ssArticaleCode, stock_summary.locationID, ArticleName , colleges.name as clg_name , room_name_master.RoomName , room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.RoomNo,  building_master.Name,room_type_master.RoomType, location_master.Floor as Floor_name FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID where stock_summary.Status='2' and location_master.Type='$RoomType' and location_master.ID='$officeID' order by IDNo DESC";
                           $article_run=mysqli_query($conn,$article);
                           
                           while ($article_row=mysqli_fetch_array($article_run)) 
                           {
                             $OfficeName = $article_row['RoomName'];
   $block = $article_row['Name'];
    $RoomType = $article_row['RoomType'];
    $clgName = $article_row['clg_name'];
    $RoomNo = $article_row['RoomNo'];
    $Floor = $article_row['Floor_name'];
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
                            $stockLocation[]=$article_row['locationID'];
                            $articleName[]=$article_row['ArticleName'];
                            $articleCode[]=$article_row['ssArticaleCode'];
                            $countforarray++;
                          
                           }
                            echo $clgName."\n".'Block- '.$block."\t".$RoomType."\t".'Room No.- '.$RoomNo."\t".'Floor- '.$FloorName."\n";
                           echo 'Sr No' . "\t";
                           for ($i=0; $i <$countforarray ; $i++) 
                           { 
                             echo $articleName[$i]."\t";
                           }
                           echo  "\n";
       for ($i=0; $i < $countforarray; $i++) 
                           { 
                            $innerCount=0;
                              $as="select * from stock_summary where locationID='$stockLocation[$i]' AND ArticleCode='$articleCode[$i]' and Status='2'";
                              $asq=mysqli_query($conn,$as);

                                while ($as1=mysqli_fetch_array($asq)) 
                           {
                            $array[$i][]=$as1['IDNo'];
                            $innerCount++;
                           }
                           $countarray[]=$innerCount;
                           }

                           $maxVal=max($countarray);
              
    $count=0;
    if ($count<$countforarray) 
    {

    for($j=0;$j<$maxVal;$j++)
    { 
        echo $j+1 ."\t";
        for ($i=0; $i <$countforarray ; $i++) 
        {
            //$value= $array[$i][$j];
             
        if (isset($array[$i][$j])) 
        {
            echo  $array[$i][$j];
        } 
        echo "\t";
        }
        echo  "\n";
    }
    $count++;
}
    
}
elseif ($exportCode == 9)
{
    $locationID = $_POST['locationID'];
    $inchargeID = $_POST['inchargeID'];

    
    
    $countforarray=0;
                           $article="SELECT distinct stock_summary.ArticleCode as ssArticaleCode, stock_summary.locationID, ArticleName , colleges.name as clg_name , room_name_master.RoomName , room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.RoomNo,  building_master.Name,room_type_master.RoomType, location_master.Floor as Floor_name FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID where stock_summary.LocationID='$locationID' and employee_id='$inchargeID' order by IDNo DESC";
                           $article_run=mysqli_query($conn,$article);
                           
                           while ($article_row=mysqli_fetch_array($article_run)) 
                           {
                             $OfficeName = $article_row['RoomName'];
   $block = $article_row['Name'];
    $RoomType = $article_row['RoomType'];
    $clgName = $article_row['clg_name'];
    $RoomNo = $article_row['RoomNo'];
    $Floor = $article_row['Floor_name'];
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
                            $stockLocation[]=$article_row['locationID'];
                            $articleName[]=$article_row['ArticleName'];
                            $articleCode[]=$article_row['ssArticaleCode'];
                            $countforarray++;
                          
                           }
                            echo $clgName."\n".'Block- '.$block."\t".$RoomType."\t".'Room No.- '.$RoomNo."\t".'Floor- '.$FloorName."\n";
                           echo 'Sr No' . "\t";
                           for ($i=0; $i <$countforarray ; $i++) 
                           { 
                             echo $articleName[$i]."\t";
                           }
                           echo  "\n";
       for ($i=0; $i < $countforarray; $i++) 
                           { 
                            $innerCount=0;
                              $as="select * from stock_summary where locationID='$stockLocation[$i]' AND ArticleCode='$articleCode[$i]'";
                              $asq=mysqli_query($conn,$as);

                                while ($as1=mysqli_fetch_array($asq)) 
                           {
                            $array[$i][]=$as1['IDNo'];
                            $innerCount++;
                           }
                           $countarray[]=$innerCount;
                           }
                           $maxValue=max($countarray);
              
    $count=0;
    if ($count<$countforarray) 
    {

    for($j=0;$j<$maxValue;$j++)
    { 
        echo $j+1 ."\t";
        for ($i=0; $i <$countforarray ; $i++) 
        {
            //$value= $array[$i][$j];
             
        if (isset($array[$i][$j])) 
        {
            echo  $array[$i][$j];
        } 
        echo "\t";
        }
        echo  "\n";
    }
    $count++;
}
    
}
if ($exportCode == 10)
{
    $count = 1;
    $inchargeID= $_POST['inchargeID'];
    $article = "SELECT distinct ArticleName from master_article inner join stock_summary ON stock_summary.ArticleCode=master_article.ArticleCode INNER JOIN location_master ON location_master.ID=stock_summary.LocationID INNER JOIN building_master ON building_master.ID=location_master.Block inner join category_permissions ON category_permissions.CategoryCode=master_article.CategoryCode where category_permissions.employee_id='$inchargeID' and stock_summary.Status='2' AND building_master.Incharge='$inchargeID'  ";
    echo 'Sr No' . "\t" . 'College Name' . "\t" . 'Floor' . "\t" . 'Room Name' . "\t" . 'Block' . "\t" . 'Room No.' . "\t". 'Location Owner ID' . "\t". 'Location Owner Name' . "\t";
    $article_run = mysqli_query($conn, $article);
    while ($article_row = mysqli_fetch_array($article_run))
    {
        echo $article_row['ArticleName'] . "\t";
    }
    echo "\n";
   
                         // SELECT *,l.ID as l_id, r.Floor as FloorName, r.RoomNo as RoomName from location_master l inner join room_master r on r.RoomNo=l.RoomNo inner join building_master b on b.ID=l.Block  INNER join room_type_master as rtm ON rtm.ID=l.Type Where b.Incharge='$EmployeeID' 
                        $sql=" SELECT *, colleges.name as clg_name , user.name as employee_name, room_name_master.ID as rnm_id,location_master.ID as lm_id,location_master.Floor as Floor_name  FROM location_master inner join building_master b on b.ID=location_master.Block left join room_type_master on room_type_master.ID=location_master.Type left join room_name_master on room_name_master.ID=location_master.RoomName left JOIN building_master on building_master.ID=location_master.Block left join colleges on location_master.CollegeID=colleges.ID left join user on location_master.location_owner=user.emp_id WHERE b.Incharge='$inchargeID'";
                    
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
    $locationOwner=$data['location_owner'];
    $EmpName=$data['employee_name'];
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
       
        $building_num = 0;
        $arrayCount=0;
         
        $building = "SELECT distinct ArticleName, stock_summary.ArticleCode from master_article inner join stock_summary ON stock_summary.ArticleCode=master_article.ArticleCode INNER JOIN location_master ON location_master.ID=stock_summary.LocationID INNER JOIN building_master ON building_master.ID=location_master.Block inner join category_permissions ON category_permissions.CategoryCode=master_article.CategoryCode where category_permissions.employee_id='$inchargeID' and stock_summary.Status='2' AND building_master.Incharge='$inchargeID'";
        $building_run = mysqli_query($conn, $building);
        while ($building_row = mysqli_fetch_array($building_run))
        {
            $building_num = $building_num + 1;
            $articleName = $building_row['ArticleName'];
            $count1 = 0;
            $article_code = $building_row['ArticleCode'];
            $qry="SELECT * FROM stock_summary inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join location_master on location_master.ID=stock_summary.LocationID inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID where stock_summary.Status='2' and location_master.Type='$RoomType' and location_master.ID='$lm_ID' and stock_summary.ArticleCode='$article_code'and category_permissions.employee_id='$inchargeID' order by IDNo DESC";
            $run = mysqli_query($conn, $qry);
            while ($data = mysqli_fetch_array($run))
            {
                $count1++;
            }
             $array[$arrayIndex][]=$count1;
                $arrayCount++;
            //echo $count1 . "\t";
        }
        if(max($array[$arrayIndex])>0)
        {   

        echo $count . "\t" . $clgName . "\t" . $FloorName . "\t". $OfficeName . "\t". $block . "\t". $RoomNo . "\t". $locationOwner . "\t". $EmpName . "\t";
            for($i=0;$i<$arrayCount;$i++)
            {
                echo $array[$arrayIndex][$i]."\t";
            }
        echo "\n";
        }
             
        $count++;
        $arrayIndex++;
    }
}
elseif ($exportCode == 11)
{
    $locationID = $_POST['locationID'];
    $inchargeID = $_POST['inchargeID'];

    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode inner join category_permissions on category_permissions.CategoryCode=stock_summary.CategoryID left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2'  and location_master.ID='$locationID' and employee_id='$inchargeID' order by ArticleName asc";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
        $location = "SELECT *, rm.RoomNo as abc FROM stock_summary ss inner join master_calegories mc on ss.CategoryID=mc.ID INNER join master_article ma on ss.ArticleCode=ma.ArticleCode inner join location_master lm on lm.ID=ss.LocationID inner join room_master rm on rm.FloorID=lm.Floor inner join building_master bm on bm.ID=lm.Block inner join room_type_master rtm on rtm.ID=lm.Type inner join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['RoomNo'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
    }
}






/*--------------------------------------------------------Attendance Report-----------------------------------------------------*/
elseif ($exportCode == 12)
{
    $count1=0;
    $startDate=$_GET['startDate'];
    $endDate=$_GET['endDate'];
    $hostel=$_GET['hostel'];
    $hostelNameQry="SELECT * FROM building_master where ID='$hostel'";
    $hostelNameRes=mysqli_query($conn,$hostelNameQry);
    while($hostelNameData=mysqli_fetch_array($hostelNameRes))
    {
        $hostelName=$hostelNameData['Name'];
    }
    echo $hostelName. "\n";
    echo 'Report From '.date("d-M-Y", strtotime($startDate)).' to '.date("d-M-Y", strtotime($endDate)). "\n";
    echo 'Sr No' . "\t" . 'Name' . "\t" . 'University Roll No.' . "\t". 'Class Roll No.' . "\t". 'Room No.' . "\t";

$start_date=$startDate;

while (strtotime($start_date) <= strtotime($endDate)) 
{
    $calendarArray[$count1][]=$start_date;
    echo $start_date . "\t";
    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
}
echo "\n";

    $count=0;
    $totalDays=count($calendarArray[0]);
    
    $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$hostel' and hostel_student_summary.status='0' order by location_master.RoomNo asc";
    $res=mysqli_query($conn,$sql);
    while($data=mysqli_fetch_array($res))
    {
        $count++;
        $studentID=$data['student_id'];
        $result1 = "SELECT  * FROM Admissions where UniRollNo='$studentID' or ClassRollNo='$studentID' or IDNo='$studentID'";
        $stmt1 = sqlsrv_query($conntest,$result1);
        while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
        {
            $studentName= $row['StudentName'];
            $uniRollNo= $row['UniRollNo'];
            $IDNo= $row['IDNo'];
            $classRollNo= $row['ClassRollNo'];
            echo $count . "\t" . $studentName . "\t" . $uniRollNo . "\t".$classRollNo . "\t". $data['RoomNo'] . "\t";
        }
        for ($i=0; $i <$totalDays ; $i++) 
        { 
                $start=$calendarArray[0][$i];
                
        
                $att="select Top (1)*  from  DeviceLogsAll where (EmpCode='$uniRollNo' or EmpCode='$classRollNo' or EmpCode='$IDNo' )ANd LogDateTime between '$start 00:00:00'  and '$start 23:59:59'  ";
                $stmt2 = sqlsrv_query($conntest,$att);
                if($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                {
                    $LogDate= $row1['LogDateTime']->format('h:iA');
                    echo $LogDate . "\t";
                }
                else
                {       
                    $leaveQry="SELECT * FROM hostel_student_leaves where student_id='$IDNo' and (start_date='$start' or '$start' BETWEEN start_date AND end_date)";
                    $leaveRes=mysqli_query($conn,$leaveQry);
                    if ($leaveData=mysqli_fetch_array($leaveRes)) 
                    {
                        echo 'Leave' . "\t";
                    }
                    else
                    {
                        echo 'Absent' . "\t";
                    }
                }
        }
        echo "\n";
    }
    
    $fileName=$hostelName.' Attendance '.$startDate.' - '.$endDate;
   
}
elseif ($exportCode == 13)
{
    $count1=0;
    
    $hostel=$_GET['hostel'];
    $session=$_GET['session'];
    $hostelNameQry="SELECT * FROM building_master where ID='$hostel'";
    $hostelNameRes=mysqli_query($conn,$hostelNameQry);
    while($hostelNameData=mysqli_fetch_array($hostelNameRes))
    {
        $hostelName=$hostelNameData['Name'];
    }
    
    $exportContent="<table border='1' class='table'>
        <tr>
            <th colspan='10'><h1>{$hostelName}</h1></th>
        </tr>
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
        </tr>";
    
    // echo $hostelName. "\n";
    // echo 'Report From '.date("d-M-Y", strtotime($startDate)).' to '.date("d-M-Y", strtotime($endDate)). "\n";
    // echo "Sr. No."."\t"."Room No."."\t"."Class Roll No."."\t"."University Roll No."."\t"."Student Name"."\t"."Father Name"."\t"."Mobile No."."\t"."Father Mobile No."."\t"."Course"."\t"."Semester"."\n";
    $srno=0;
    //$sql="SELECT * from hostel_student_summary inner join location_master on location_master.ID=hostel_student_summary.location_id where session='$session' and Block='$hostel' and hostel_student_summary.status='0' order by RoomNo asc";


 // $sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$building'  AND session='$session' and hostel_student_summary.status='0'  order by hostel_student_summary.status  ASC ";

$sql="SELECT * from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID inner join hostel_student_summary on hostel_student_summary.article_no=stock_summary.IDNo where Block='$hostel'   AND session='$session' and hostel_student_summary.status='0'  order by hostel_student_summary.status ASC ";

    $res=mysqli_query($conn,$sql);
    while($data=mysqli_fetch_array($res))
    {
        $srno++;
        $RoomNo=$data['RoomNo'];
         $studentID=$data['student_id'];
        $RoomNo=$data['RoomNo'];
        $result1 =   "SELECT  * FROM Admissions where IDNo='$studentID'"; 


        $resultq="SELECT   max(SemesterId) as SemesterID FROM ExamForm  where IDNo='$studentID'";
        $stmtq = sqlsrv_query($conntest,$resultq);
        while($rowq = sqlsrv_fetch_array($stmtq, SQLSRV_FETCH_ASSOC) )
        {

            $Semester= $rowq['SemesterID'];

        }



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
            

        }
         $exportContent.="<tr>

         <th>{$srno}</th>
         <td>{$RoomNo}</td>
         <td>{$classRollNo}</td>
         <td>{$uniRollNo}</td>
         <td>{$studentName}</td>
         <td>{$fatherName}</td>
         <td>{$StudentMobileNo}</td>
         <td>{$FatherMobileNo}</td>
         <td>{$Course}</td>
         <td>{$Semester}</td>
         </tr>";



        // echo   $srno."\t".$RoomNo."\t".$classRollNo."\t".$uniRollNo."\t".$studentName."\t".$fatherName."\t".$StudentMobileNo."\t".$FatherMobileNo."\t".$Course."\t".$Semester."\n";
        
    }
    $exportContent.="
    </table>";
    $fileName=$hostelName.' Report ('.$session.')';
            echo $exportContent;
   
}
elseif($exportCode==14)
{
     $count=0;
    $articleID=$_GET['meterNo'];
    
    $sql="SELECT *, meter_reading.ID as mrID from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where article_no='$articleID' ORDER by meter_reading.ID desc";
        
    $exportMeter="<table class='table' border='1'>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Date</th>
                <th>Reading</th>
                <th>Units Consumed</th>
                <th>Rate per Unit</th>
                <th>Bill amount</th>
                
            </tr>
        </thead>";
       
    $res=mysqli_query($conn,$sql);
    while($data=mysqli_fetch_array($res))
    {
        
        $count++;
        $article_num=$data['article_no'];
        
            $room_no=$data['RoomNo'];
            $date=date("d-M-Y",strtotime($data['reading_date']));
            $reading=$data['current_reading'];
            $unitsConsumed=$data['unit'];
            $id=$data['mrID'];
             $unitRate=$data['unit_rate'];
            $billAmount=$data['amount'];
            $block=$data['Name'];
        
       
            $exportMeter.="<tr>
                <td>{$count}</td>
                <td>{$date}</td>
                <td>";
            
                if ($count==1) 
                {
                    $exportMeterHeader="<table class='table' border='1'>
        <thead>
            <tr>
                <th colspan='2'>{$block}</th>                
                <th colspan='2'>Room No.:{$room_no}</th>                
                <th colspan='2'>Meter No.: {$article_num}</th>                
            </tr>
        </thead></table>";
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
                
            </tr>";

    }
    
    $exportMeter.="</table>";
    echo $exportMeterHeader;
    echo $exportMeter;
    $fileName='Meter '.$article_num."'s Report";
}

elseif($exportCode=='15')
{
    $count=0;
    $totalBill=0;
    $building=$_GET['building'];
    $floor=$_GET['floor'];
    $room=$_GET['room'];
    if ($building!='' && $floor=='' && $room=='') 
    {
$sql="SELECT distinct article_no,Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building' order by location_master.RoomNo asc";
    }
    elseif ($building!='' && $floor=='' && $room!='') 
    {
        $sql="SELECT distinct article_no,Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building'  and RoomNo='$room' order by location_master.RoomNo asc";
    }
    elseif ($building!='' && $floor!='' && $room=='') 
    {
        $sql="SELECT distinct article_no,Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building'  and Floor='$floor' order by location_master.RoomNo asc";
    }
    elseif ($building!='' && $floor!='' && $room!='') 
    {
        $sql="SELECT distinct article_no,Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block where Block='$building'  and RoomNo='$room' and Floor='$floor' order by location_master.RoomNo asc";
    }
   if($building=='0')
    {   
         $sql="SELECT distinct article_no,Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block  inner join stock_summary  ss on ss.IDNO=meter_reading.article_no where ss.WorkingStatus='0'   order by building_master.Name desc, location_master.RoomNo asc";
    }


    $meterLocationsData='';
    $meterLocationsData.="<table class='table' border='1' >
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>QR No.</th>
                <th>Building</th>
                <th>Room Name</th>
                <th>Room No.</th>
                <th>
                <table border='1'>
                <tr><th colspan='2'>Owner</th></tr>
                <tr><th>Name</th><th>ID</th></tr>
                </table>
                </th>
                <th>
                <table border='1'>
                <tr><th colspan='2'>Old</th></tr>
                <tr><th>Date</th><th>Reading</th></tr>
                </table>
                </th>
                <th>
                <table border='1'>
                <tr><th colspan='2'>New</th></tr>
                <tr><th>Date</th><th>Reading</th></tr>
                </table>
                </th>
                
                <th>Units Consumed</th>
               
                <th>Bill amount</th>                
            </tr>
        </thead>";
        
    $res=mysqli_query($conn,$sql);
    while($data=mysqli_fetch_array($res))
    {
        $ownerTable='';
        $newDateTable='';
        $oldDateTable='';
        $roomName='';
        
        $count++;
        $article_num=$data['article_no'];
        $buildingName=$data['Name'];
        $readingQry="SELECT *, meter_reading.id as meter_reading_id, room_name_master.RoomName as room_name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block INNER JOIN room_name_master ON room_name_master.ID=location_master.RoomName where article_no='$article_num' ORDER by meter_reading.ID desc";
        $readingRes=mysqli_query($conn,$readingQry);
        if ($data1=mysqli_fetch_array($readingRes)) 
        {
            $meterReadingId=$data1['meter_reading_id'];
            $previousReading='N/A';
            $previousReadingDate='N/A';
            $oldRes=mysqli_query($conn,"SELECT * from meter_reading where article_no='$article_num' and ID<'$meterReadingId' ORDER BY ID desc ");
            if ($data=mysqli_fetch_array($oldRes)) 
            {
                $previousReading=$data['current_reading'];
                $previousReadingDate=date("d-M-Y", strtotime($data['reading_date']));
            }
            $room_no=$data1['RoomNo'];
            $roomName=$data1['room_name'];
            if ($room_no==0) 
            {
              $room_no='N/A';
            }
            $date=date("d-M-Y", strtotime($data1['reading_date']));
            $reading=$data1['current_reading'];
            $unitsConsumed=$data1['unit'];
            $unitRate=$data1['unit_rate'];
            $billAmount=$data1['amount'];
            $totalBill=$totalBill+$billAmount;



            $meterLocation=$data1['location_id'];
            $flag=0;
            $sr=0;
            $locationQry="SELECT distinct Corrent_owner from stock_summary where LocationID='$meterLocation' ORDER by Corrent_owner desc";
            $locationRes=mysqli_query($conn,$locationQry);
            while($locationData=mysqli_fetch_array($locationRes))
            {
              $user='';
              $user=$locationData['Corrent_owner'];
              if (strlen($user)>7) 
              {
                $flag=1;
                $result1 = "SELECT  * FROM Admissions where UniRollNo='$user' or ClassRollNo='$user' or IDNo='$user'";
                $stmt1 = sqlsrv_query($conntest,$result1);
                while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                {
              $sr++;
            
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
              elseif (strlen($user)<3) 
              {
                $flag=1;
                $sql1 = "SELECT * FROM outside_owners Where id='$user'";
                  $q1 = mysqli_query($conn, $sql1);
                  while ($row = mysqli_fetch_array($q1)) 
                  {
                    $userName = $row['name'];
                    
                    $Designation = $row['designation'];
                    $ownerTable.="<tr><td>{$userName}</td><td>{$user}</td></tr>";
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
              $sr++;
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
            $newDateTable.="<tr><td rowspan='{$sr}'>{$date}</td><td rowspan='{$sr}'>{$reading}</td></tr>";
            $oldDateTable.="<tr><td rowspan='{$sr}'>{$previousReadingDate}</td><td rowspan='{$sr}'>{$previousReading}</td></tr>";

        }
       
        if ($count==1) 
                {
                    if ($building=='0') 
                    {
                        $exportMeterHeader="<table class='table' border='1'>
                            <thead>
                                <tr>
                                    <th colspan='13'><h3 style='color:Red'>Meter Reading Report</h3></th>                                
                                </tr>
                            </thead></table>";
                    }
                    else
                    {
                        $exportMeterHeader="<table class='table' border='1'>
                            <thead>
                                <tr>
                                    <th colspan='13'><h3 style='color:Red'>{$buildingName} Meter Reading Report</h3></th>                                
                                </tr>
                            </thead></table>";
                    }
                    
            }
            $meterLocationsData.="<tr>
                <td>{$count}</td>
                <td>{$article_num}</td>
                <td style='color:Red'><b>{$buildingName}</b></td>
                <td>{$roomName}</td>
                <td>{$room_no}</td>
                <td>
                <table border='1' >
                {$ownerTable}
                </table>


                </td>
                <td>
                <table border='1' >
                {$oldDateTable}
                </table>


                </td>
                <td>
                <table border='1' >
                {$newDateTable}
                </table>


                </td>
                <td>{$unitsConsumed}</td>
                
                <td><b>{$billAmount}</b></td>            
            </tr>";
        
    }
    
    $meterLocationsData.=" <tr>
                <th colspan='9'>Total Amount</th>                                
                <th>{$totalBill}</th>                                
            </tr></table>";
    echo $exportMeterHeader;
    echo $meterLocationsData;
    if ($building==0) 
    {
     $fileName="Meter Report";
    }
    else
    {
     $fileName=$buildingName." Meter Report";
    }
}

elseif($exportCode=='16')
{   
    $count=0;
    $building=$_GET['building'];
    $floor=$_GET['floor'];
    $room=$_GET['room'];
     $exportContent='';
    if ($building!='' && $floor=='' && $room=='') 
    {
       $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName,Name from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode inner join building_master on building_master.ID=location_master.Block where Block='$building'";
    }
    elseif ($building!='' && $floor=='' && $room!='') 
    {
        $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName,Name from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode inner join building_master on building_master.ID=location_master.Block where Block='$building' and RoomNo='$room'";
    }
    elseif ($building!='' && $floor!='' && $room=='') 
    {
        $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName,Name from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode inner join building_master on building_master.ID=location_master.Block where Block='$building' and Floor='$floor'";
    }
    elseif ($building!='' && $floor!='' && $room!='') 
    {
        $sql="SELECT distinct Corrent_owner,RoomNo,ArticleName,Name from stock_summary inner join location_master on stock_summary.LocationID=location_master.ID INNER JOIN master_article ON stock_summary.ArticleCode=master_article.ArticleCode inner join building_master on building_master.ID=location_master.Block where Block='$building' and RoomNo='$room' and Floor='$floor'";
    }

    $exportContent="<table class='table' border='1'>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Name</th>
                <th>ID</th>
                <th>Father Name</th>
                <th>Contact No.</th>
                <th>College</th>
                <th>Room No.</th>               
            </tr>
        </thead>";
    $res=mysqli_query($conn,$sql);
    while($data=mysqli_fetch_array($res))
    {
        $flag=0;
        $userID='';
        $userName='';
        $college='';
        $phone='';
        $father_name='';
       $user=$data['Corrent_owner'];
       $hostelName=$data['Name'];
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
        
    
            $exportContent.="<tr>
                <td>{$count} </td>
                <td>{$userName}</td>
                <td>{$userID}</td>
                <td>{$father_name}</td>
                <td>{$phone}</td>
                <td>{$college}</td>
                <td>{$data['RoomNo']}</td>
            </tr>";
        
    }
    }
    }

    $exportContent.="</table>";
     $fileName=$hostelName.' Complete Report';
      $exportMeterHeader="<table class='table' border='1'>
                            <thead>
                                <tr>
                                    <th colspan='7'><h3 style='color:Red'>{$hostelName} Complete Report</h3></th>                                
                                </tr>
                            </thead></table>";
     echo $exportMeterHeader;
    echo $exportContent;
  
}




elseif($exportCode=='17')
{
    $count=0;
    $totalBill=0;
    $building=$_GET['building'];


    $group=mysqli_query($conn,"SELECT *  from group_master where Id='$building'");
                  while($data=mysqli_fetch_array($group))
                  {
 $ids1=$data['LocationID'];
                  }


  $ids = explode(",", $ids1);

 $length=count($ids);
 


    $meterLocationsData='';
    $meterLocationsData.="<table class='table' border='1' >
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>QR No.</th>
                <th>Building</th>
                <th>Room Name</th>
                <th>Room No.</th>
                <th>
                <table border='1'>
                <tr><th colspan='2'>Owner</th></tr>
                <tr><th>Name</th><th>ID</th></tr>
                </table>
                </th>
                <th>
                <table border='1'>
                <tr><th colspan='2'>Old</th></tr>
                <tr><th>Date</th><th>Reading</th></tr>
                </table>
                </th>
                <th>
                <table border='1'>
                <tr><th colspan='2'>New</th></tr>
                <tr><th>Date</th><th>Reading</th></tr>
                </table>
                </th>
                
                <th>Units Consumed</th>
               
                <th>Bill amount</th>                
            </tr>
        </thead>";
        
 for($i=0;$i<$length;$i++)
 {
  
   $sql="SELECT  IDNo,building_master.Name as bname  from  stock_summary  INNer  join location_master on stock_summary.LocationID = location_master.ID  INNer join building_master on building_master.Id=location_master.Block  where location_master.ID='$ids[$i]' AND stock_summary.status='2' ANd ArticleCode='34' ";


    $res=mysqli_query($conn,$sql);
    while($data=mysqli_fetch_array($res))
    {
        $ownerTable='';
        $newDateTable='';
        $oldDateTable='';
        $roomName='';
        
        $count++;
        $article_num=$data['IDNo'];
        $buildingName=$data['bname'];

   $readingQry="SELECT *, meter_reading.id as meter_reading_id, room_name_master.RoomName as room_name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block INNER JOIN room_name_master ON room_name_master.ID=location_master.RoomName where article_no='$article_num' ORDER by meter_reading.ID desc";

        $readingRes=mysqli_query($conn,$readingQry);
        if ($data1=mysqli_fetch_array($readingRes)) 
        {
            $meterReadingId=$data1['meter_reading_id'];
            $previousReading='N/A';
            $previousReadingDate='N/A';
            $oldRes=mysqli_query($conn,"SELECT * from meter_reading where article_no='$article_num' and ID<'$meterReadingId' ORDER BY ID desc ");
            if ($data=mysqli_fetch_array($oldRes)) 
            {
                $previousReading=$data['current_reading'];
                $previousReadingDate=date("d-M-Y", strtotime($data['reading_date']));
            }
            $room_no=$data1['RoomNo'];
            $roomName=$data1['room_name'];
            if ($room_no==0) 
            {
              $room_no='N/A';
            }
            $date=date("d-M-Y", strtotime($data1['reading_date']));
            $reading=$data1['current_reading'];
            $unitsConsumed=$data1['unit'];
            $unitRate=$data1['unit_rate'];
            $billAmount=$data1['amount'];
            $totalBill=$totalBill+$billAmount;



            $meterLocation=$data1['location_id'];
            $flag=0;
            $sr=0;
            $locationQry="SELECT Corrent_owner,multiowner from stock_summary where IDNo='$article_num' ORDER by Corrent_owner desc";
            
            $locationRes=mysqli_query($conn,$locationQry);

            while($locationData=mysqli_fetch_array($locationRes))
            {
              $user='';
              $user=$locationData['Corrent_owner'];
              $multiowner=$locationData['multiowner'];

  if($multiowner>0)
                {

  $locationQrym="SELECT UserId from multiple_owners where ArticleCode='$article_num'";
   $locationRes=mysqli_query($conn,$locationQrym);
   while($locationDatam=mysqli_fetch_array($locationRes))
            {
              $user='';
              $user=$locationDatam['UserId'];
              


 if (strlen($user)>7) 
              {                
                $flag=1;
                $result1 = "SELECT  * FROM Admissions where UniRollNo='$user' or ClassRollNo='$user' or IDNo='$user'";
                $stmt1 = sqlsrv_query($conntest,$result1);
                while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                { $sr++;
                 $ClassRollNo= $row['ClassRollNo'];
                  $UniRollNo= $row['UniRollNo'];
                  $StudentName = $row['StudentName'];
                  $ownerTable.="<tr><td>{$StudentName}</td><td>{$ClassRollNo}/{$UniRollNo}</td></tr>";
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
                    
                    $Designation = $row['designation'];
                    $ownerTable.="<tr><td>{$userName}</td><td>{$user}</td></tr>";
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
              $sr++;
                    $userName = $row['Name'];                        
                    $ownerTable.="<tr><td>{$userName}</td><td>{$user}</td></tr>";
                    
                  }
                }
              }


                }


            }

                else
                {

              if (strlen($user)>7) 
              {                
                $flag=1;
                $result1 = "SELECT  * FROM Admissions where UniRollNo='$user' or ClassRollNo='$user' or IDNo='$user'";
                $stmt1 = sqlsrv_query($conntest,$result1);
                while($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                { $sr++;
                 $ClassRollNo= $row['ClassRollNo'];
                  $UniRollNo= $row['UniRollNo'];
                  $StudentName = $row['StudentName'];
                  $ownerTable.="<tr><td>{$StudentName}</td><td>{$ClassRollNo}/{$UniRollNo}</td></tr>";
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
                    
                    $Designation = $row['designation'];
                    $ownerTable.="<tr><td>{$userName}</td><td>{$user}</td></tr>";
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
              $sr++;
                    $userName = $row['Name'];                        
                    $ownerTable.="<tr><td>{$userName}</td><td>{$user}</td></tr>";
                    
                  }
                }
              }


                }

                       }

            $newDateTable.="<tr><td rowspan='{$sr}'>{$date}</td><td rowspan='{$sr}'>{$reading}</td></tr>";
            $oldDateTable.="<tr><td rowspan='{$sr}'>{$previousReadingDate}</td><td rowspan='{$sr}'>{$previousReading}</td></tr>";

        }
       
        if ($count==1) 
                {
                    if ($building=='0') 
                    {
                        $exportMeterHeader="<table class='table' border='1'>
                            <thead>
                                <tr>
                                    <th colspan='13'><h3 style='color:Red'>Meter Reading Report</h3></th>                                
                                </tr>
                            </thead></table>";
                    }
                    else
                    {
                        $exportMeterHeader="<table class='table' border='1'>
                            <thead>
                                <tr>
                                    <th colspan='13'><h3 style='color:Red'>{$buildingName} Meter Reading Report</h3></th>                                
                                </tr>
                            </thead></table>";
                    }
                    
            }
           
                $meterLocationsData.="<tr>
                <td>{$count}</td>
                <td>{$article_num}</td>
                <td style='color:Red'><b>{$buildingName}</b></td>
                <td>{$roomName}</td>
                <td>{$room_no}</td>
                <td>
                <table border='1' >
                {$ownerTable}
                </table>
                </td>
                <td>
                <table border='1' >
                {$oldDateTable}
                </table>
                </td>
                <td>
                <table border='1' >
                {$newDateTable}
                </table>


                </td>
                <td>{$unitsConsumed}</td>
                
                <td><b>{$billAmount}</b></td>            
            </tr>";
        
    }
    }
    $meterLocationsData.=" <tr>
                <th colspan='9'>Total Amount</th>                                
                <th>{$totalBill}</th>                                
            </tr></table>";
    echo $exportMeterHeader;
    echo $meterLocationsData;

    if ($building==0) 
    {
     $fileName="Meter Report";
    }
    else
    {
     $fileName=$buildingName." Meter Report";
    }

   if ($fileName=='') 
   {   
    $fileName = 'LIMS';
    }
}

elseif($exportCode=='18')
{
    $CollegeID = $_GET['college'];

 $exam = $_GET['examination'];
  
 
  $allow=0;

    


    $questionData='';
    $questionData.="<table class='table'  border=1'>

    <thead>
 <tr>
                 
 
                  <th> Sr No </th>
                <th>Course</th>
                                                
                      
                       <th> Semester</th>
                       <th>Batch</th>
                         <th> Subject Name </th>
                   <th>Subject Code</th>
                                     <th>Subject Type</th>
            <th>No Of Paper </th>
                  
                     <th>Emp ID </th>
                              <th   >Status </th>
                      
                </tr></thead>";
   
 $filenamedata = "Select  Distinct CollegeName from  ExamForm  Where CollegeID='$CollegeID' ";

$stmt = sqlsrv_query($conntest,$filenamedata);  
                     while($p_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                 {
                    $fileName=$p_row['CollegeName'];
}


 $pendingpa = "Select  Distinct es.Course,es.SubjectName,es.SubjectCode,es.SemesterID,es.SubjectType,es.Batch from ExamformSubject es  inner join ExamForm  ef on ef.ID = es.Examid  inner  join MasterCourseStructure mcs on es.SubjectCode=mcs.SubjectCode where es.Examination='$exam' ANd es.ExternalExam='Y' ANd ef.CollegeID='$CollegeID' ANd es.Type='Reappear' order by SemesterID";

$stmt = sqlsrv_query($conntest,$pendingpa);  
                     while($p_row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                 {
                 
                 $Subjectcodes[]=$p_row['SubjectCode'];
                 $SubjectName[]=$p_row['SubjectName'];
                 $SubjectType[]=$p_row['SubjectType'];
                  $Course[]=$p_row['Course'];
                 $Semester[]=$p_row['SemesterID'];
                 $Batch[]=$p_row['Batch'];
                  }
               
             $loop= count($Subjectcodes);

for($i=0,$sr=1;$i<$loop;$i++,$sr++)
{
$emp_id="";
$sql = "SELECT * FROM question_paper_files WHERE SubjectCode='$Subjectcodes[$i]' ANd Course='$Course[$i]' ANd Batch='$Batch[$i]' AND Status>=0";
$z=0;
 $result = mysqli_query($conn, $sql);
     while($row=mysqli_fetch_array($result))
  {

  $emp_id=$row['UpdatedBy'];
   
$z++;
  }  
   $questionData.="<tr >
                <td>{$sr}</td>
                <td>{$Course[$i]}</td>
                <td>{$Semester[$i]}</td>
                <td>{$Batch[$i]}</td>
                <td>{$SubjectName[$i]}</td>
                <td>
                {$Subjectcodes[$i]}
                </td>

                <td>
                {$SubjectType[$i]}
                </td>
                <td>
               
                         {$z}

                </td>
                <td>{$emp_id}</td>
                
                <td></tr>";
        
    }
    
    $questionData.="                                 
                                           
            </tr></table>";
    echo $questionData;
    



if ($fileName=='') 
{   
    $fileName = $CollegeID;
}

}
elseif($exportCode=='19')
{
    $start_date=$_GET['start_date'];
  $end_date=$_GET['end_date'];

  $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND batch='2023' ANd Created_date Between '$start_date' AND  '$end_date' ");
    $counter = 1; 
     
    
        
    $exportMeter="<table class='table' border='1'>
        <thead>
                <tr color='red'>
          <th>Sr. No</th>
          <th>Payment ID</th>
          <th>Ref no</th>
          <th>Name</th>
          <th>Father Name</th>
           <th>Course/Batch</th>
          <th>Email</th> 
          <th>Purpose</th>
          <th>Phone</th>
          <th>Amount</th>
          <th>Transaction Date/ Time</th>
           <th>Admissions Status</th>
            <th>ClassRollNo</th>
         </tr>
        </thead>";
       

         $count=1;
    
     while($row=mysqli_fetch_array($result)) 
        {
      $id = $row['slip_no'];
      $payment_id = $row['payment_id'];
      $name = $row['name'];
      $father_name = $row['father_name'];
      $roll_no = $row['roll_no'];
      $course = $row['course'];
      $sem = $row['sem'];
      $batch=$row['batch'];
      $purpose=$row['purpose'];
      $remarks=$row['remarks'];
      $admissionstatus=$row['merge'];
      $Created_date=$row['Created_date'];
      $Created_time=$row['Created_time'];
      $amount=$row['amount'];
      $email = $row['email'];
      $classRollNo=$row['Class_rollno'];
      $phone = $row['phone'];
        if($admissionstatus>0)
        {
         $adstatus="Admitted";
        }
        else{
$adstatus="Pending";
        }
       
            $exportMeter.="<tr>
                <td>{$count}</td>
                <td>{$payment_id}</td>
                <td>{$id}</td>
                <td>{$name}</td>
                <td>{$father_name}</td>
                <td>{$course}</td>
                <td>{$email}</td>
                <td>{$purpose}</td>
                <td>{$phone}</td>
                <td>{$amount}</td>
                <td>{$Created_date}&nbsp;{$Created_time}</td>
                <td>{$adstatus}</td>
                <td>{$classRollNo}</td>
            </tr>";
$count++;
    }
    
    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;
    $fileName="Admissions Report".$start_date." to ".$end_date;


}
elseif($exportCode==20)
{
  $string=$_GET['CollegeId'];
  $parts = explode('=', $string);
  $ColomName = isset($parts[0]) ? $parts[0] : '';
$value = isset($parts[1]) ? $parts[1] : '';

if ($ColomName=='JobStatus') {
         $get_category1="SELECT * FROM Staff where  $ColomName='$value'";
  
} else
{
         $get_category1="SELECT * FROM Staff where  $ColomName='$value' and JobStatus='1'";

}

            $get_category_run1=sqlsrv_query($conntest,$get_category1);
       $exportMeter="<table class='table' border='1'>
        <thead>
                <tr color='red'>
          <th>Sr. No</th>
          <th>Emp ID</th>
          <th>Name</th>
          <th>FatherName</th>
          <th>MotherName</th>
           <th>College</th>
           <th>Department</th>
           <th>Designation</th>
          <th>Email</th> 
          <th>Phone</th>
          
          
         </tr>
        </thead>";
      $count=1;
     while($row=sqlsrv_fetch_array($get_category_run1,SQLSRV_FETCH_ASSOC))
        {
      $IDNo = $row['IDNo'];
      $Name = $row['Name'];
      $FatherName = $row['FatherName'];
      $MotherName = $row['MotherName'];
      $CollegeName = $row['CollegeName'];
      $Department = $row['Department'];
      $Designation = $row['Designation'];
      $email = $row['EmailID'];
      $phone = $row['MobileNo'];
            $exportMeter.="<tr>
                <td>{$count}</td>
                <td>{$IDNo}</td>
                <td>{$Name}</td>
                <td>{$FatherName}</td>
                <td>{$MotherName}</td>
                <td>{$CollegeName}</td>
                <td>{$Department}</td>
                <td>{$Designation}</td>
                <td>{$email}</td>
                <td>{$phone}</td>
            </tr>";
$count++;
    }
    
    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;
    $fileName="Staff Report";

}

elseif($exportCode==21)
{  
   $get_category1="SELECT * FROM staff_aprisal";
            $get_category_run1=mysqli_query($conn,$get_category1);
       $exportMeter="<table class='table' border='1'>
        <thead>
                <tr color='red'>
                <th>#</th>
                <th>Employee ID</th>
                <th>No. of Lectures</th>
                <th>Employee Category</th>
                <th>Book Published</th>
                <th>No. of Books</th>
                <th>Name of Books</th>
                <th>ISBN</th>
                <th>Research Paper</th>
                <th>No. of Research Papers</th>
                <th>Title of Paper</th>
                <th>Name of Journal</th>
                <th>Publication Index</th>
                <th>Consultancy</th>
                <th>Amount</th>
                <th>Admission</th>
                <th>No. of Admission</th>
                <th>No. of Admission (C)</th>
                <th>Patent</th>
                <th>Patent Detail</th>
                <th>PhD Candidate</th>
                <th>No. of Candidates</th>
                <th>Extra</th>
                <th>Rec Auth</th>
                <th>Rec Auth Status</th>
                <th>Rec Auth Warning</th>
                <th>Rec Auth Behaviour</th>
                <th>Rec Auth Coordination</th>
                <th>Rec Auth Deadline</th>
                <th>Ap Auth</th>
                <th>Ap Auth Status</th>
                <th>Ap Auth Warning</th>
                
                <th>Ap Auth Coordination</th>
                <th>Ap Auth Deadline</th>
                <th>Final Score</th>
                <th>Gross Amount New</th>
                <th>Present Amount</th>
                <th>Last Amount</th>
                <th>Corg</th>
                <th>Start Date</th>
                <th>Review Date</th>
                <th>Approval Date</th>
            </tr>
        </thead>";
    $count = 1;
    while ($row = mysqli_fetch_array($get_category_run1)) {
        $IDNo = $row['emp_id'];
        $no_of_lect = $row['no_of_lect'];
        $ecategory = $row['ecategory'];
        $book_published = $row['book_published'];
        $no_of_books = $row['no_of_books'];
        $name_of_books = $row['name_of_books'];
        $isbn = $row['isbn'];
        $research_paper = $row['research_paper'];
        $no_of_research_paper = $row['no_of_research_paper'];
        $title_of_paper = $row['title_of_paper'];
        $name_of_journal = $row['name_of_journal'];
        $publication_index = $row['publication_index'];
        $consultancy = $row['consultancy'];
        $amount = $row['amount'];
        $admission = $row['admission'];
        $no_of_admission = $row['no_of_admission'];
        $no_of_admission_c = $row['no_of_admission_c'];
        $patent = $row['patent'];
        $p_detail = $row['p_detail'];
        $phd_candidate = $row['phd_candidate'];
        $no_of_candidate = $row['no_of_candidate'];
        $extra = $row['extra'];
        $rec_auth = $row['rec_auth'];
        $rec_auth_status = $row['rec_auth_status'];
        $rec_auth_warning = $row['rec_auth_warning'];
        // $rec_auth_behaviour = $row['rec_auth_behaviour'];
        $rec_auth_coordination = $row['rec_auth_coordination'];
        $rec_auth_deadline = $row['rec_auth_deadline'];
        $ap_auth = $row['ap_auth'];
        $ap_auth_status = $row['ap_auth_status'];
        $ap_auth_warning = $row['ap_auth_warning'];
        $ap_auth_behaviour = $row['ap_auth_behaviour'];
        $ap_auth_coordination = $row['ap_auth_coordination'];
        $ap_auth_deadline = $row['ap_auth_deadline'];
        $final_score = $row['final_score'];
        $gross_amount_new = $row['gross_amount_new'];
        $present_amount = $row['present_amount'];
        $last_amount = $row['last_amount'];
        $corg = $row['corg'];
        $s_date = $row['s_date'];
        $r_date = $row['r_date'];
        $a_date = $row['a_date'];
        $exportMeter .= "<tr>
            <td>{$count}</td>
            <td>{$IDNo}</td>
            <td>{$no_of_lect}</td>
            <td>{$ecategory}</td>
            <td>{$book_published}</td>
            <td>{$no_of_books}</td>
            <td>{$name_of_books}</td>
            <td>{$isbn}</td>
            <td>{$research_paper}</td>
            <td>{$no_of_research_paper}</td>
            <td>{$title_of_paper}</td>
            <td>{$name_of_journal}</td>
            <td>{$publication_index}</td>
            <td>{$consultancy}</td>
            <td>{$amount}</td>
            <td>{$admission}</td>
            <td>{$no_of_admission}</td>
            <td>{$no_of_admission_c}</td>
            <td>{$patent}</td>
            <td>{$p_detail}</td>
            <td>{$phd_candidate}</td>
            <td>{$no_of_candidate}</td>
            <td>{$extra}</td>
            <td>{$rec_auth}</td>
            <td>{$rec_auth_status}</td>
            <td>{$rec_auth_warning}</td>
            <td>{$rec_auth_coordination}</td>
            <td>{$rec_auth_deadline}</td>
            <td>{$ap_auth}</td>
            <td>{$ap_auth_status}</td>
            <td>{$ap_auth_warning}</td>
            <td>{$ap_auth_behaviour}</td>
            <td>{$ap_auth_coordination}</td>
            <td>{$ap_auth_deadline}</td>
            <td>{$final_score}</td>
            <td>{$gross_amount_new}</td>
            <td>{$present_amount}</td>
            <td>{$last_amount}</td>
            <td>{$corg}</td>
            <td>{$s_date}</td>
            <td>{$r_date}</td>
            <td>{$a_date}</td>
        </tr>";
        $count++;
    }

    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;
    $fileName="All Staff Report";

}
elseif($exportCode==22)
{
$sql="SELECT Distinct offer_latter.District , 
  COUNT(*) AS `dist`,states.name as StateName, cities.Name as DistrictName
FROM offer_latter inner join states on states.id=offer_latter.State inner JOIN 
cities on cities.id=offer_latter.District  GROUP BY offer_latter.District";

$exportMeter="<table class='table' border='1'>
        <thead>
                <tr color='red'>
                <th>#</th>
                <th>State</th> <th>District</th><th>Count</th></tr>

    </tr> 
        </thead>";
 $result = mysqli_query($conn,$sql);
$count = 1;


 while($row=mysqli_fetch_array($result))
{
    $State=$row['StateName'];
    $District=$row['DistrictName'];
    $Total=$row['dist'];

 $exportMeter .= "<tr>
            <td>{$count}</td>
            <td>{$State}</td>
            <td>{$District}</td>
            <td>{$Total}</td></td>
        </tr>";
              
                   
   $count++;
   
   }
    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;

   $fileName="CC Report";
}
elseif($exportCode==23)
{    
    $District=$_GET['District'];   
    if($District>0)
    {   
     $get_student_details="SELECT  *, states.name as StateName, cities.Name as DistrictName
FROM offer_latter inner join states on states.id=offer_latter.State inner JOIN 
cities on cities.id=offer_latter.District  where offer_latter.District='$District' ";
}
else
{
 $get_student_details="SELECT  *, states.name as StateName, cities.Name as DistrictName
FROM offer_latter inner join states on states.id=offer_latter.State inner JOIN 
cities on cities.id=offer_latter.District  ";   
}

    $get_student_details_run=mysqli_query($conn,$get_student_details);
    $count = 1;
    $exportMeter="
    <table class='table' border='1'>
               
       <thead>
                          
          <tr color='red'>
                             
             <th>#</th>
                            
             <th>Session</th>
             <th>College Name</th>
             <th>Course</th>
              
             <th>Name</th>
             <th>Father Name</th>
             <th>RollNo</th>
             <th>Gender</th>
             <th>State</th>
             <th>District</th>
             <th>Consultant</th>
              <th>Status</th>
              <th>Verification</th>
              <th>Loan Number</th>
              <th>Application No</th>
              <th>Date Of Verification</th>
               <th>Amount</th>
              <th>UTR Number</th>
              <th>Date Of Payment</th>


              
          </tr>
            
       </thead>
       ";
while($row=mysqli_fetch_array($get_student_details_run)) 
{   
     $name=$row['Name'];    
    $FatherName=$row['FatherName'];    
    $MotherName=$row['MotherName'];    
    $Collegeid=$row['CollegeName'];    
    $Course=$row['Course'];    
    $Department=$row['Department'];    
    $Gender=$row['Gender'];    
    $classroll=$row['Class_RollNo'];
     $loanNumber=$row['loanNumber'];
      $applicationNo=$row['applicationNo'];
       $dateVerification =$row['dateVerification'];
          $UTRNumber=$row['UTRNumber'];
      $loan_amount=$row['loan_amount'];
       $datePayment =$row['datePayment'];

    $statusVerification=$row['statusVerification'];
    $get_colege_course_name="SELECT * FROM MasterCourseCodes where CollegeID='$Collegeid' and DepartmentId='$Department' AND CourseID='$Course'";
    $get_colege_course_name_run=sqlsrv_query($conntest,$get_colege_course_name);
    if ($row_collegecourse_name=sqlsrv_fetch_array($get_colege_course_name_run)) 
    {   
         $courseName=$row_collegecourse_name['Course'];   
          $CollegeName=$row_collegecourse_name['CollegeName']; 
    }   

    $State=$row['StateName'];   
    $status=$row['Status'];   
    $Session=$row['Session'];    
     $Duration=$row['Duration'];    
     $Consultant_id=$row['Consultant_id']; 
     $consultant_details="SELECT * FROM consultant_master where id='$Consultant_id'";
    $consultant_details_run=mysqli_query($conn,$consultant_details); 
    if($row_consultant=mysqli_fetch_array($consultant_details_run))
    {
$consultantName=$row_consultant['state'];
    }  
         $Lateral=$row['Lateral'];    
         $Nationality=$row['Nationality'];    
         $ID_Proof_No=$row['ID_Proof_No'];   




if($classroll>0)
{
    $color='';
}
else
{
$color="red";
}

if($statusVerification>0)
{
    $color1='green';

$verification='Verified';
}
else
{
$color1="";
$verification='';
}



if ($status>0)
{
        $colorl='red';
        $mnStatus='LEFT';
}
else
{
     $colorl='';
        $mnStatus='';
}



    $District=$row['DistrictName'];     
     $exportMeter .= "
       <tr>           
          
          <td>{$count}</td>
          <td>{$Session}</td>
          <td>{$CollegeName}</td>
          <td>{$courseName}</td>
          <td>{$name}</td>
          <td>{$FatherName}</td>

          <td bgcolor=$color>{$classroll}</td>
          <td>{$Gender}</td>
          <td>{$State}</td>
          <td>{$District}</td>
          <td>{$consultantName}</td>
           <td bgcolor=$colorl>{$mnStatus}</td>
             <td bgcolor=$color1>{$verification}</td>

          

              <td >{$loanNumber}</td>
               <td >{$applicationNo}</td>
                <td >{$dateVerification}</td>
                  <td >{$loan_amount}</td>
                    <td >{$UTRNumber}</td>
                      <td >{$datePayment}</td>
       </tr>";                                    
       $count++;    
    }
    $exportMeter.="</table>"; 
       //echo $exportMeterHeader;    
       echo $exportMeter;  
        $fileName="Detailed Report";
}


elseif($exportCode=='24')
{
    $count=0;
    $totalBill=0;
   
   $sql = mysqli_query($conn,"SELECT distinct article_no,Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block  order by building_master.Name desc, location_master.RoomNo asc");

$users=0;

while($data=mysqli_fetch_assoc($sql))

 {
 $ed[]=$data['article_no'];
$users++;
}



//SELECT DISTINCT YEAR(date_added) AS "Year", MONTH(date_added) AS "Month" FROM payments

 
$result2 = mysqli_query($conn,"SELECT Distinct  MONTH(reading_date) AS ProducedMonth  FROM  meter_reading WHERE reading_date BETWEEN '2022-10-31' AND '2023-08-29' ");
 
 $d=0;
 while($row2 = mysqli_fetch_assoc($result2)) {



   $datee[]=$row2['ProducedMonth'];
$d++;
}
$meterLocationsData='';
 
    $meterLocationsData.="<table class='table' border='1' >
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>QR No.</th>
                <th>Building</th>
                <th>Room Name</th>
                <th>Room No.</th>";
                



for($dd=0;$dd<$d;$dd++)
{
$meterLocationsData.="<th>$datee[$dd]</th>";
   
  } 

$meterLocationsData.="<thead>
            <tr></table>";
     





    // $meterLocationsData.=" <tr>
    //             <th colspan='9'>Total Amount</th>                                
    //             <th>{$totalBill}</th>                                
    //         </tr></table>";
    // echo $exportMeterHeader;


    echo $meterLocationsData;
   
     $fileName="Meter Report";

}

elseif($exportCode==25)
{    
    $Consultant=$_GET['Consultant'];   
    // if($District>0)
    // {   
      $get_student_details="SELECT  *, states.name as StateName, cities.Name as DistrictName
FROM offer_latter inner join states on states.id=offer_latter.State inner JOIN 
cities on cities.id=offer_latter.District  where offer_latter.Consultant_id='$Consultant'  ";
// }
// else
// {
//  $get_student_details="SELECT  *, states.name as StateName, cities.Name as DistrictName
// FROM offer_latter inner join states on states.id=offer_latter.State inner JOIN 
// cities on cities.id=offer_latter.District  ";   
// }

    $get_student_details_run=mysqli_query($conn,$get_student_details);
    $count = 1;
    $exportMeter="
    <table class='table' border='1'>
               
       <thead>
                          
          <tr color='red'>
                             
             <th>#</th>
                            
             <th>Session</th>
             <th>College Name</th>
             <th>Course</th>
              
             <th>Name</th>
             <th>Father Name</th>
             <th>RollNo</th>
             <th>Gender</th>
             <th>State</th>
             <th>District</th>
             <th>Consultant</th>
          </tr>
              </tr>        
       </thead>
       ";
while($row=mysqli_fetch_array($get_student_details_run)) 
{   
     $name=$row['Name'];    
    $FatherName=$row['FatherName'];    
    $MotherName=$row['MotherName'];    
    $Collegeid=$row['CollegeName'];    
    $Course=$row['Course'];    
    $Department=$row['Department'];    
    $Gender=$row['Gender'];    
    $classroll=$row['Class_RollNo'];
    $statusVerification=$row['statusVerification'];
    $get_colege_course_name="SELECT * FROM MasterCourseCodes where CollegeID='$Collegeid' and DepartmentId='$Department' AND CourseID='$Course'";
    $get_colege_course_name_run=sqlsrv_query($conntest,$get_colege_course_name);
    if ($row_collegecourse_name=sqlsrv_fetch_array($get_colege_course_name_run)) 
    {   
         $courseName=$row_collegecourse_name['Course'];   
          $CollegeName=$row_collegecourse_name['CollegeName']; 
    }    
    $State=$row['StateName'];   
    $Session=$row['Session'];    
     $Duration=$row['Duration'];    
     $Consultant_id=$row['Consultant_id']; 
     $consultant_details="SELECT * FROM consultant_master where id='$Consultant_id'";
    $consultant_details_run=mysqli_query($conn,$consultant_details); 
    if($row_consultant=mysqli_fetch_array($consultant_details_run))
    {
$consultantName=$row_consultant['state'];
    }  
         $Lateral=$row['Lateral'];    
         $Nationality=$row['Nationality'];    
         $ID_Proof_No=$row['ID_Proof_No'];   
if($classroll>0)
{
    $color='';
}
else
{
$color="red";
}
if($statusVerification>0)
{
    $color1='green';
}
else
{
$color1="";
}
    $District=$row['DistrictName'];     
     $exportMeter .= "
       <tr bgcolor=$color1>           
          
          <td>{$count}</td>
          <td>{$Session}</td>
          <td>{$CollegeName}</td>
          <td>{$courseName}</td>
          <td>{$name}</td>
          <td>{$FatherName}</td>

          <td bgcolor=$color>{$classroll}</td>
          <td>{$Gender}</td>
          <td>{$State}</td>
          <td>{$District}</td>
          <td>{$consultantName}<td>
       </tr>";                                    
       $count++;    
    }
    $exportMeter.="</table>"; 
       //echo $exportMeterHeader;    
       echo $exportMeter;  
        $fileName="Detailed Report";
}

elseif($exportCode==26)
{    
   

$start_date=$_GET['start_date'];
          $end_date=$_GET['end_date'];

          $College=$_GET['College'];
          $Department=$_GET['Department'];



  if($College!=''&& $Department!='')
  {       
$sql_a="select Distinct IDNo from Staff  where jobStatus='1' AND  CollegeID='$College' ANd DepartmentID='$Department'";

}
else if($College!='')
{
$sql_a="select Distinct IDNo from Staff  where jobStatus='1' AND  CollegeID='$College'";

}
else
{
$sql_a="select Distinct IDNo from Staff  where jobStatus='1'";

}



$emp_codes=array();
$stmt = sqlsrv_query($conntest,$sql_a);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
          {
         $emp_codes[]=$row_staff['IDNo'];
          }

 $no_of_emp=count($emp_codes);



function getBetweenDates($startDate,$endDate) {
 $array = array();
 $interval = new DateInterval('P1D');

 $realEnd = new DateTime($endDate);
 $realEnd->add($interval);

 $period = new DatePeriod(new DateTime($startDate), $interval, $realEnd);

 foreach($period as $date) {
   $array[] = $date->format('Y-m-d');
 }

 return $array;
}
$datee = getBetweenDates($start_date,$end_date);


 $no_of_dates=count($datee);


$exportdaily="<table class='table' border='1'>
               
       <thead>
                          
          <tr >
       <th style='color:red;'>Sr No</th><th  style='color:red;'>Name </th><th style='color:red;'>Emp ID</th><th style='color:red;'>College</th>";
 
for($dc=0;$dc<$no_of_dates;$dc++)
{
$exportdaily.="<th colspan='2' style='text-align:center' style='color:red;'> {$datee[$dc]}   </th>";
 }

$exportdaily.="</tr></thead>";
    
$srno=1;
for ($i=0;$i<$no_of_emp;$i++)
{

$sql_staff="select * from Staff where IDNo='$emp_codes[$i]'";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
             $IDNo=$row_staff['IDNo'];
                  $College=$row_staff['CollegeName'];



$exportdaily.="<tr><td>{$srno}</td><td>{$IDNo}</td><td>{$Name}</td><td>{$College}</td>";
 
$srno++;
for ($at=0;$at<$no_of_dates;$at++)
{
   $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1
 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND 
'$start 23:59:00.000' AND EMpCOde='$IDNo' ";

$stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            $intime=$row_staff_att['mytime'];
            $outtime=$row_staff_att['mytime1'];

         

$exportdaily.="<td style='text-align:center'>";
 if($intime!="")
{ 
$myin= $intime->format('h:i');
} 
else
{ 
 $myin="--";
}


$exportdaily.="{$myin}</td style='text-align:center'><td>";
 if($outtime!="")
    { 
        $myout=$outtime->format('h:i');} 
else
 { $myout= "--";}
   
   

$exportdaily.="{$myout}</td>";

 }

}


}

}


   
    $exportdaily.="</table>"; 
       //echo $exportMeterHeader;    
       echo $exportdaily;  
        $fileName="Daily Report";
}


elseif($exportCode=='27')
{
    

  $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND purpose='Conference Educon'");
    $counter = 1; 
     
    
        
    $exportMeter="<table class='table' border='1'>
        <thead>
                <tr color='red'>
          <th>Sr. No</th>
          <th>Payment ID</th>
          <th>Ref no</th>
          <th>Name</th>
          <th>Member Type</th>
           <th>IDNo</th>
             <th>Organisation</th>
            <th>College</th>
             <th>Course</th>
         
          <th>Email</th> 
          <th>Purpose</th>
          <th>Phone</th>
          <th>Amount</th>
          <th>Transaction Date/ Time</th>
          <th>Country</th>
           <th>Accomodation</th>
           <th>Accomodation Type </th>
              <th>Check in Date </th>
                <th>Check out Date </th>
                 <th>Presenting</th>
          <th>Attending</th>
            
         </tr>
        </thead>";
       

         $count=1;
    
     while($row=mysqli_fetch_array($result)) 
        {
      $id = $row['slip_no'];
      $payment_id = $row['payment_id'];
      $name = $row['name'];
      $father_name = $row['father_name'];
      $Designation = $row['roll_no'];
      $Organisation = $row['course'];
      $IdNo = $row['Class_rollno'];
      $batch=$row['batch'];
      $purpose=$row['purpose'];
      $remarks=$row['remarks'];

      $Created_date=$row['Created_date'];
      $Created_time=$row['Created_time'];
       $quali=$row['quali'];
     
      $amount=$row['amount'];
      $email = $row['email'];

      $accomodation=$row['accomodation'];
       $country=$row['country'];
     
      $acctype=$row['acctype'];
      $start=$row['start'];
      $endd=$row['endd'];


      $presenting = $row['presenting'];


      $phone = $row['phone'];

      $attending = $row['attending'];
     
       
            $exportMeter.="<tr>
                <td>{$count}</td>
                <td>{$payment_id}</td>
                <td>{$id}</td>
                <td>{$name}</td>
                <td>{$father_name}</td>
                 <td>{$IdNo}</td>
                 <td>{$Organisation}</td>
                <td>{$Designation}</td>
              
                 <td>{$quali}</td>
                 
                
                <td>{$email}</td>
                <td>{$purpose}</td>
                <td>{$phone}</td>
                <td>{$amount}</td>
                <td>{$Created_date}&nbsp;{$Created_time}</td>
                <td>{$country}</td>
                 <td>{$accomodation}</td>
                  <td>{$acctype}</td>
                   <td>{$start}</td>
                    <td>{$endd}</td>
                    <td>{$presenting}</td>
                     <td>{$attending}</td>

               
            </tr>";
$count++;
    }
    
    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;
    $fileName="Report";


}

elseif($exportCode=='28')
{
    

  $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND purpose='Convocation 2023'");
    $counter = 1; 
     
    
        
    $exportMeter="<table class='table' border='1'>
        <thead>
                <tr color='red'>
          <th>Sr. No</th>
       
        <th>Faculty</th> 
        <th>Program</th>
         <th> Batch</th>
         <th>Uni Roll No</th>
          <th>Name</th>
          <th>Father Name</th>
          
          
             
         
          <th>Email</th> 
             <th>Phone</th>
          <th>Purpose</th>
       
             <th>Payment ID</th>
          <th>Ref no</th>
          <th>Amount</th>
          <th>Transaction Date/ Time</th>
         
         </tr>
        </thead>";
       

         $count=1;
    
     while($row=mysqli_fetch_array($result)) 
        {
      $id = $row['slip_no'];
      $payment_id = $row['payment_id'];
      $name = $row['name'];
      $father_name = $row['father_name'];
      $Designation = $row['roll_no'];





      $Organisation = $row['course'];
      $IdNo = $row['Class_rollno'];
      $batch=$row['batch'];
      $purpose=$row['purpose'];
      $remarks=$row['remarks'];

      $Created_date=$row['Created_date'];
      $Created_time=$row['Created_time'];
       $quali=$row['quali'];
     
      $amount=$row['amount'];
      $email = $row['email'];

      $accomodation=$row['accomodation'];
       $country=$row['country'];
     
      $acctype=$row['acctype'];
      $start=$row['start'];
      $endd=$row['endd'];


      $phone = $row['phone'];


  $query1="Select CollegeName,Course,Batch,IDNo,UniRollNo,StudentName,FatherName,EmailID,StudentMobileNo  from Admissions where  UniRollNo='$Designation'";

$stmt2 = sqlsrv_query($conntest,$query1);

if( $stmt2  === false) {

    die( print_r( sqlsrv_errors(), true) );
}
else
{
 while($rowb = sqlsrv_fetch_array($stmt2))
     {


$collegename= $rowb['CollegeName'];
 $batch=$rowb['Batch'];
 $father_name=$rowb['FatherName'];

 
       
            $exportMeter.="<tr>
             <td>{$count}</td>
             <td>{$collegename}</td>
                 <td>{$Organisation}</td>
                 <td>{$batch}</td>
               <td>{$Designation}</td>
                  <td>{$name}</td>
                <td>{$father_name}</td>
                   <td>{$email}</td>
                <td>{$phone}</td>
                 <td>{$purpose}</td>
                <td>{$payment_id}</td>
                <td>{$id}</td>               
                <td>{$amount}</td>
                <td>{$Created_date}&nbsp;{$Created_time}</td>
                

               
            </tr>";
$count++;
    }
    }
}
    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;
    $fileName="Report";


}

//print detailed
elseif($exportCode==29)
{    
   

include 'attendance-employee-get-export.php';
     
include 'attendance-date-function.php';


$exportdaily="<table class='table' border='1'><tr>";
    
$srno=1;
for ($i=0;$i<$no_of_emp;$i++)
{

  $exportdaily.="<th>
  <table class='table' border='1'>";


$paiddays=0;
$h=0;


$sql_staff="select * from Staff where IDNo='$emp_codes[$i]'";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
           $Department=$row_staff['Department'];
                      $CollegeName=$row_staff['CollegeName'];
             $IDNo=$row_staff['IDNo'];
                  $College=$row_staff['CollegeName'];


  $exportdaily.="<tr><th style='color:red;' colspan=5>Summary Report({$showmonth}-{$curyear})</th></tr>";

$exportdaily.="<tr><td colspan=2>Employee ID</td><td colspan=3 style='text-align:left'>{$IDNo}</td></tr>";
$exportdaily.="<tr><td colspan=2>Name</td><td colspan=3>{$Name}</td></tr>";
$exportdaily.="<tr><td colspan=2>Department</td ><td colspan=3>{$Department}</td></tr>";

$exportdaily.="<tr><td colspan=5><b>{$CollegeName}</b></td></tr>";

$exportdaily.="<tr><td>Date</td><td>In time</td><td>Out Time</td><td>Remarks</td><td>Count</td></tr>";
 
$srno++;

for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

    $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo' ";

     $exportdaily.="<tr><td style='text-align:center'>{$start}</td>";
      $stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            $intime=$row_staff_att['mytime'];
            $outtime=$row_staff_att['mytime1'];

         

$exportdaily.="<td style='text-align:center'>";
 if($intime!="")
{ 
$myin= $intime->format('H:i');
} 
else
{ 
 $myin="";
}


$exportdaily.="{$myin}</td><td style='text-align:center'>";
 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   
   

$exportdaily.="{$myout}</td>";



include 'attendance-calculator.php';


if($HolidayName!='' && $printleave!='')
{

 $exportdaily.="<td>{$HolidayName} {$printleave}</td><td>";
    
}
else if($HolidayName!='' && $printleave=='')
{
 $exportdaily.="<td>{$HolidayName}</td><td>";
}
else if($HolidayName=='' && $printleave!='')
{
 $exportdaily.="<td>{$printleave}</td><td>";
}
else if ($HolidayName=='' && $printleave=='' && $intime=='' && $outtime=='')
{
   $joiningdateab="select * from  Staff where DateOfJoining<='$start 00:00:00' AND IDNo='$IDNo'";


 $list_result_joinab = sqlsrv_query($conntest,$joiningdateab, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

                $row_count_joinab = sqlsrv_num_rows($list_result_joinab);  

if($row_count_joinab>0)
            {
           $exportdaily.="<td bgcolor='red' color='white'>Absent</td><td>";
         
             }
             else
             {
               $exportdaily.="<td bgcolor='green' color='white'>Late Joining</td><td>";
             }



}
else
{
    $exportdaily.="<td>{$print_shift}</td><td>";
}


$exportdaily.="{$countday}</td></tr>";

$paiddays=$paiddays+$countday;


}


}
if($paiddays<>$h)
{ 


    $exportdaily.="<tr><td  style='color:red;' colspan=3>Total Paid Days</td><td colspan=2><b>{$paiddays} out of {$myenddate}</b></td></tr>";
}
else
{
    $exportdaily.="<tr><td colspan=3 color='red'>Total Paid Days</td><td colspan=2><b>0</b></td></tr>";
}


$exportdaily.="</table>";

}


$exportdaily.="</th><th></th>";
}
   
    $exportdaily.="<tr></table>"; 
       //echo $exportMeterHeader;    
       echo $exportdaily;  

        $fileName="$filename ($showmonth-$curyear) Attendance Report ";
}


// print summary


elseif($exportCode==30)
{    
   
include 'attendance-employee-get-export.php';
     
include 'attendance-date-function.php';


$exportdaily="<table class='table' border='1'>
               
       <thead>
                          
          <tr >
       <th style='color:red;'>Sr No</th><th  style='color:red;'>Employee ID </th><th style='color:red;'>Name</th><th style='color:red;'>College</th>";
 

$exportdaily.="<th  style='text-align:center' style='color:red;'>No of  Paid Days</th></tr></thead>";
    
$srno=1;
for ($i=0;$i<$no_of_emp;$i++)
{
    $paiddays=0;
$h=0;

$sql_staff="select * from Staff where IDNo='$emp_codes[$i]'";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
             $IDNo=$row_staff['IDNo'];
                  $College=$row_staff['CollegeName'];



$exportdaily.="<tr><td>{$srno}</td><td>{$IDNo}</td><td>{$Name}</td><td>{$College}</td>";
 

$srno++;
for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

   $start=$datee[$at];

  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo' ";

 
      $stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            $intime=$row_staff_att['mytime'];
            $outtime=$row_staff_att['mytime1'];

         


 if($intime!="")
{ 
$myin= $intime->format('H:i');
} 
else
{ 
 $myin="";
}



 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   
   
include 'attendance-calculator.php';

$paiddays=$paiddays+$countday;


}




}
if($paiddays<>$h)
{
    $exportdaily.="<td><b>{$paiddays}</b></td></tr>";
}
else
{
    $exportdaily.="<td><b>0</b></td></tr>";
}
}
   
}
 $exportdaily.="</table>"; 
       //echo $exportMeterHeader;    
       echo $exportdaily;  
        $fileName="$filename ($showmonth-$curyear) Summary Report";
}


//single report

else if($exportCode==31)
{

$curmnth =$_POST['month'];
$curyear = $_POST['year'];
 $emp_code=$_POST['EmployeeId'];



//include 'attendance-employee-get-export.php';
     
include 'attendance-date-function.php';


$exportdaily="<table class='table' border='1'>";
    
$srno=1;


$paiddays=0;
$h=0;


$sql_staff="select * from Staff where IDNo='$emp_code'";
$stmt = sqlsrv_query($conntest,$sql_staff);  
            while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
           $Name=$row_staff['Name'];
           $Department=$row_staff['Department'];
                      $CollegeName=$row_staff['CollegeName'];
             $IDNo=$row_staff['IDNo'];
                  $College=$row_staff['CollegeName'];


  $exportdaily.="<tr><th style='color:red;' colspan=5>Attendance Report $showmonth-$curyear </th></tr>";

$exportdaily.="<tr><td colspan=2>Employee ID</td><td colspan=3 style='text-align:left'>{$IDNo}</td></tr>";
$exportdaily.="<tr><td colspan=2>Name</td><td colspan=3>{$Name}</td></tr>";
$exportdaily.="<tr><td colspan=2>Department</td ><td colspan=3>{$Department}</td></tr>";

$exportdaily.="<tr><td colspan=2>College Name</td><td colspan=3>{$CollegeName}</td></tr>";

$exportdaily.="<tr><td>Date</td><td>In time</td><td>Out Time</td><td>Remarks</td><td>Count</td></tr>";
 
$srno++;

for ($at=0;$at<$no_of_dates;$at++)
{
    $HolidayName='';

   $start=$datee[$at];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1 from DeviceLogsAll  where LogDateTime Between '$start 00:00:00.000'  AND '$start 23:59:00.000' AND EMpCOde='$IDNo' ";

     $exportdaily.="<tr><td style='text-align:center'>{$start}</td>";
      $stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
            $intime=$row_staff_att['mytime'];
            $outtime=$row_staff_att['mytime1'];

         

$exportdaily.="<td style='text-align:center'>";
 if($intime!="")
{ 
$myin= $intime->format('H:i');
} 
else
{ 
 $myin="";
}


$exportdaily.="{$myin}</td><td style='text-align:center'>";
 if($outtime!="" && $outtime>$intime)
    { 

        $myout=$outtime->format('H:i');

    } 
else
 { $myout= "";}
   
   

$exportdaily.="{$myout}</td>";

$holidaycount=0;
$row_count_join=0;


include 'attendance-calculator.php';






if($HolidayName!='' && $printleave!='')
{

 $exportdaily.="<td>{$HolidayName} {$printleave}</td><td>";
    
}
else if($HolidayName!='' && $printleave=='')
{
 $exportdaily.="<td>{$HolidayName}</td><td>";
}
else if($HolidayName=='' && $printleave!='')
{
 $exportdaily.="<td>{$printleave}</td><td>";
}


else if ($HolidayName=='' && $printleave=='' && $intime=='' && $outtime=='' )
{


  $joiningdateab="select * from  Staff where DateOfJoining<='$start 00:00:00' AND IDNo='$IDNo'";


 $list_result_joinab = sqlsrv_query($conntest,$joiningdateab, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));

                $row_count_joinab = sqlsrv_num_rows($list_result_joinab);  

if($row_count_joinab>0)
            {
           $exportdaily.="<td bgcolor='red' color='white'>Absent</td><td>";
         
             }
             else
             {
               $exportdaily.="<td bgcolor='green' color='white'>Late Joining</td><td>";
             }


}

else
{
    $exportdaily.="<td>{$print_shift}</td><td>";
}

$exportdaily.="{$countday}</td></tr>";

$paiddays=$paiddays+$countday;


}

}
if($paiddays<>$h)
{
    $exportdaily.="<tr><td  style='color:red;' colspan=3>Total Paid Days</td><td colspan=2><b>{$paiddays} out of {$myenddate}</b></td></tr>";
}
else
{
    $exportdaily.="<tr><td colspan=3 color='red'>Total Paid Days</td><td colspan=2><b>0</b></td></tr>";
}

}
   
    $exportdaily.="<tr></table>"; 
       //echo $exportMeterHeader;    
       echo $exportdaily;  
        $fileName="$Name($IDNo)-$showmonth-$curyear Attendance Report";


}

else if($exportCode==32)
{


    $CollegeID=$_GET['CollegeID'];
    $CourseID=$_GET['Course'];
    $DepartmentID=$_GET['Department'];
    $Batch=$_GET['Batch'];
    


$SrNo=1;

  $exportstudy="<table class='table' border='1'>
        <thead>
                
    <tr>
        <th>SrNo</th>
        <th>ColegeName</th>
        <th>Course</th>
        <th>Batch</th>
        <th>Semester</th>
        <th>Subject Code </th>
        <th>Document Type </th>
        <th>Employee ID </th>
        <th>Name </th>
        <th>Count </th>
      
      
    </tr>
        </thead>";


        $CheckStudyMaterial="SELECT sm.collegeid,sm.Courseid,sm.batch,sm.SubjectCode,sm.semid,sm.DocumentType,Staff.IDNo,Staff.Name,COUNT(*) as nooflect from  
        StudyMaterial as sm  inner join Staff on sm.Uploadby=Staff.IDNO Where 1=1";
        if($CollegeID!='')
        {
            $CheckStudyMaterial.="AND sm.collegeid='$CollegeID'";
        }
        if($CourseID!='')
        {
        $CheckStudyMaterial.="AND sm.Courseid='$CourseID'";
        }
        if($Batch!='')
        {
        $CheckStudyMaterial.="AND sm.batch='$Batch'";
        }
        
       $CheckStudyMaterial.="group by sm.batch,sm.SubjectCode,sm.semid,sm.DocumentType,Staff.IDNo,Staff.Name ,sm.collegeid,sm.Courseid order by IDNo";
     $CheckStudyMaterialRun=sqlsrv_query($conntest,$CheckStudyMaterial);
     while($row=sqlsrv_fetch_array($CheckStudyMaterialRun,SQLSRV_FETCH_ASSOC))
     {
         
       
        $CheckStudyMaterial1="select Course,CollegeName from  
        MasterCourseStructure Where CollegeID='".$row['collegeid']."' and CourseID='".$row['Courseid']."' and Batch='".$row['batch']."' and SubjectCode='".$row['SubjectCode']."'";
     $CheckStudyMaterialRun1=sqlsrv_query($conntest,$CheckStudyMaterial1);
     if($row1=sqlsrv_fetch_array($CheckStudyMaterialRun1,SQLSRV_FETCH_ASSOC))
     {

         $ColegeName=$row1['CollegeName'];
         $Courseid=$row1['Course'];
     }

     
   $semid=$row['semid'];
$batch=$row['batch'];
$StaffID=$row['IDNo'];
$StaffName=$row['Name'];
$SubjectCode=$row['SubjectCode'];
$nooflect=$row['nooflect'];
$DocumentType=$row['DocumentType'];

 $exportstudy.="<tr>
                <td>{$SrNo}</td>
                <td>{$ColegeName}</td>
                <td>{$Courseid}</td>
                <td>{$batch}</td>
                <td>{$semid}</td>
                 <td>{$SubjectCode}</td>
                 <td>{$DocumentType}</td>
                   <td>{$StaffID}</td>
                    <td>{$StaffName}</td>
                     <td>{$nooflect}</td>
               
                 
            </tr>";


    $SrNo++;
}


    
    $exportstudy.="</table>";
    //echo $exportMeterHeader;
    echo $exportstudy;
    $fileName="Study Material Report";




}
else if($exportCode==33)
{


   $CollegeID=$_GET['College'];
   $Course=$_GET['course'];
   $Batch=$_GET['Batch'];

$SrNo=1;
  $exportstudy="<table class='table' border='1'>
        <thead>            
    <tr>
    <th>SrNo</th>
    <th>IDNo </th>
    <th>RollNo </th>
    <th>Name </th>
    <th>Father Name </th>
    <th>Colege Name</th>
    <th>Course</th>
    <th>Batch</th>
    </tr>
        </thead>";
      $CheckStudyMaterial="SELECT * FROM Admissions WHERE CollegeID='$CollegeID' and CourseID='$Course' and Batch='$Batch' and Status='1'";
    $CheckStudyMaterialRun=sqlsrv_query($conntest,$CheckStudyMaterial);
    while($row=sqlsrv_fetch_array($CheckStudyMaterialRun,SQLSRV_FETCH_ASSOC))
    {
$Batch=$row['Batch'];
$IDNo=$row['IDNo'];
$Name=$row['StudentName'];
$FatherName=$row['FatherName'];
$CollegeName=$row['CollegeName'];
$Course=$row['Course'];
$UniRollNo=$row['UniRollNo'];
 $exportstudy.="<tr>
                <td>{$SrNo}</td>
                <td>{$IDNo}</td>
                <td>{$UniRollNo}</td>
                <td>{$Name}</td>
                 <td>{$FatherName}</td>
                <td>{$CollegeName}</td>
                <td>{$Course}</td>
                <td>{$Batch}</td>      
            </tr>";
    $SrNo++;
}  
    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="Student Adm Report";
}

else if($exportCode==34)
{


   $Sem=$_GET['Sem'];
   $Course=$_GET['course'];
   $Batch=$_GET['Batch'];

$SrNo=1;
  $exportstudy="<table class='table' border='1'>
        <thead>            
    <tr>
    <th>SrNo</th>
    <th>IDNo </th>
    <th>RollNo </th>
    <th>Name </th>
    <th>Father Name </th>
    <th>Colege Name</th>
    <th>Course</th>
    <th>Batch</th>
    </tr>
        </thead>";
      $CheckStudyMaterial="SELECT * FROM ExamForm  inner join Admissions ON Admissions.IDNo=ExamForm.IDNo WHERE ExamForm.SemesterId='$Sem' and ExamForm.CourseID='$Course' and ExamForm.Batch='$Batch' and ExamForm.Status='8' and ExamForm.Type='Regular'";
    $CheckStudyMaterialRun=sqlsrv_query($conntest,$CheckStudyMaterial);
    while($row=sqlsrv_fetch_array($CheckStudyMaterialRun,SQLSRV_FETCH_ASSOC))
    {
$Batch=$row['Batch'];
$IDNo=$row['IDNo'];
$Name=$row['StudentName'];
$FatherName=$row['FatherName'];
$CollegeName=$row['CollegeName'];
$Course=$row['Course'];
$UniRollNo=$row['UniRollNo'];
 $exportstudy.="<tr>
                <td>{$SrNo}</td>
                <td>{$IDNo}</td>
                <td>{$UniRollNo}</td>
                <td>{$Name}</td>
                 <td>{$FatherName}</td>
                <td>{$CollegeName}</td>
                <td>{$Course}</td>
                <td>{$Batch}</td>      
            </tr>";
    $SrNo++;
}  
    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="Student Exam Form Accepted Report";
}
else if($exportCode==35)
{


   $Sem=$_GET['Sem'];
   $Course=$_GET['course'];
   $Batch=$_GET['Batch'];

$SrNo=1;
  $exportstudy="<table class='table' border='1'>
        <thead>            
    <tr>
    <th>SrNo</th>
    <th>IDNo </th>
    <th>RollNo </th>
    <th>Name </th>
    <th>Father Name </th>
    <th>Colege Name</th>
    <th>Course</th>
    <th>Batch</th>
    </tr>
        </thead>";
      $CheckStudyMaterial="SELECT * FROM ExamForm  inner join Admissions ON Admissions.IDNo=ExamForm.IDNo WHERE ExamForm.SemesterId='$Sem' and ExamForm.CourseID='$Course' and ExamForm.Batch='$Batch' and ExamForm.Status!='8' and ExamForm.Type='Regular'";
    $CheckStudyMaterialRun=sqlsrv_query($conntest,$CheckStudyMaterial);
    while($row=sqlsrv_fetch_array($CheckStudyMaterialRun,SQLSRV_FETCH_ASSOC))
    {
$Batch=$row['Batch'];
$IDNo=$row['IDNo'];
$Name=$row['StudentName'];
$FatherName=$row['FatherName'];
$CollegeName=$row['CollegeName'];
$Course=$row['Course'];
$UniRollNo=$row['UniRollNo'];
 $exportstudy.="<tr>
                <td>{$SrNo}</td>
                <td>{$IDNo}</td>
                <td>{$UniRollNo}</td>
                <td>{$Name}</td>
                 <td>{$FatherName}</td>
                <td>{$CollegeName}</td>
                <td>{$Course}</td>
                <td>{$Batch}</td>      
            </tr>";
    $SrNo++;
}  
    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="Student Exam Form Pending Report";
}
else if($exportCode==36)
{


   $Sem=$_GET['Sem'];
   $Course=$_GET['course'];
   $Batch=$_GET['Batch'];

$SrNo=1;
  $exportstudy="<table class='table' border='1'>
        <thead>            
    <tr>
    <th>SrNo</th>
    <th>IDNo </th>
    <th>Class RollNo </th>
    <th> Uni RollNo </th>
    <th>Name </th>
    <th>Father Name </th>
    <th>Colege Name</th>
    <th>Course</th>
    <th>Batch</th>
    </tr>
        </thead>";
      $CheckStudyMaterial="SELECT * FROM Admissions WHERE Admissions.Status='1' AND IDNo NOT IN 
      (SELECT IDNo FROM ExamForm WHERE SemesterId='$Sem' AND CourseID='$Course' AND Batch='$Batch')  AND CourseID='$Course' AND Batch='$Batch'";
    $CheckStudyMaterialRun=sqlsrv_query($conntest,$CheckStudyMaterial);
    while($row=sqlsrv_fetch_array($CheckStudyMaterialRun,SQLSRV_FETCH_ASSOC))
    {
$Batch=$row['Batch'];
$IDNo=$row['IDNo'];
$Name=$row['StudentName'];
$FatherName=$row['FatherName'];
$CollegeName=$row['CollegeName'];
$Course=$row['Course'];
$UniRollNo=$row['UniRollNo'];
$ClassRollNo=$row['ClassRollNo'];
 $exportstudy.="<tr>
                <td>{$SrNo}</td>
                <td>{$IDNo}</td>
                 <td>{$ClassRollNo}</td>
                <td>{$UniRollNo}</td>
                <td>{$Name}</td>
                 <td>{$FatherName}</td>
                <td>{$CollegeName}</td>
                <td>{$Course}</td>
                <td>{$Batch}</td>      
            </tr>";
    $SrNo++;
}  
    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="Student Exam Form Not Applied Report";
}

else if($exportCode==37)
{


  

$SrNo=1;
  $exportstudy="<table class='table' border='1'>
        <thead>            
    <tr>
    <th>SrNo</th>
    <th>Course </th>
    <th>Count </th>
    
  
    </tr>
        </thead>";


      $CheckStudyMaterial="SELECT Course,COUNT(Course) as coursecount FROM offer_latter GROUP BY Course";

 

 $article_run = mysqli_query($conn,$CheckStudyMaterial);
    while ($row = mysqli_fetch_array($article_run))

    {
$countc=$row['coursecount'];
$Course=$row['Course'];


   $CheckStudyMaterial1="select Course,CollegeName from  MasterCourseStructure Where CourseID='$Course'";

     $CheckStudyMaterialRun1=sqlsrv_query($conntest,$CheckStudyMaterial1);
     if($row1=sqlsrv_fetch_array($CheckStudyMaterialRun1,SQLSRV_FETCH_ASSOC))
     {

         $ColegeName=$row1['CollegeName'];
         $Courseid=$row1['Course'];
     }




 $exportstudy.="<tr>
                <td>{$SrNo}</td>
                <td>{$Courseid}</td>
                <td>{$countc}</td>
                    
            </tr>";
    $SrNo++;
}  
    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="credit card ";
}

else if($exportCode==38)
{
    $statusForIdCard=$_GET['status'];
    $fromDateForIdCard=$_GET['from'];
    $toDateFromIdCard=$_GET['to'];

  

$SrNo=1;
  $exportstudy="<table class='table' border='1'>
        <thead>            
    <tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>Name </th>
    <th>College </th>
    <th>Course </th>
    <th>Duration </th>
    <th>Print Date </th>
    
  
    </tr>
        </thead>";


        if($statusForIdCard!='' && $fromDateForIdCard!='' && $toDateFromIdCard!='' )
        {
             $GetSmartCardDetails="SELECT *,SmartCardDetails.Status as IDcardStatus ,SmartCardDetails.IDNo as StudentSmartCardID FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.status='$statusForIdCard' and PrintDate Between '$fromDateForIdCard 01:00:00.000' and '$toDateFromIdCard 23:59:00.000' order by Admissions.Course ASC  ";
        }
        else
        {
             $GetSmartCardDetails="SELECT *,SmartCardDetails.Status as IDcardStatus,SmartCardDetails.IDNo as StudentSmartCardID FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where  SmartCardDetails.status='$statusForIdCard' order by Admissions.Course ASC  ";
        }
         $GetSmartCardDetailsRun=sqlsrv_query($conntest,$GetSmartCardDetails);
         while($row=sqlsrv_fetch_array($GetSmartCardDetailsRun,SQLSRV_FETCH_ASSOC))
         {
            
            $ClassRollNo=$row['ClassRollNo'];
            $StudentName=$row['StudentName'];
            $Course=$row['Course'];
         
            $CollegeName=$row['CollegeName'];
            $getCourseDetails="SELECT * FROM  MasterCourseCodes WHERE CourseID='".$row['CourseID']."' and Session='".$row['Session']."' and Batch='".$row['Batch']."' ";
            $getCourseDetailsRun = sqlsrv_query($conntest,$getCourseDetails);
            if($rowgetCourseDetails=sqlsrv_fetch_array($getCourseDetailsRun))
            {
               
               
                if($rowgetCourseDetails['Duration']==1)
                {
                    $Duration=$rowgetCourseDetails['Duration'].' Year';
                }else{
                    $Duration=$rowgetCourseDetails['Duration'].' Years';
                }
                $ValidUpTo=$rowgetCourseDetails['ValidUpto'];
                $ValidUpTo=$rowgetCourseDetails['ValidUpto']->format('d-m-Y');
            }
            if($row['PrintDate']!='')
            {
               $PrintDate=  $row['PrintDate']->format('d-m-Y H:i:s');
            }
            else
            {
                $PrintDate="";
            }
        
         $exportstudy.="<tr>
         <td>{$SrNo}</td>
         <td>{$ClassRollNo}</td>
         <td>{$StudentName}</td>
         <td>{$CollegeName}</td>
         <td>{$Course}</td>
         <td>{$Duration}</td>
         <td>{$PrintDate}</td>
             
     </tr>";
     $SrNo++;
         } 
    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="Smart card ";
}

else if($exportCode==39)
{
    $CollegeID=$_POST['CollegeName'];
    $CourseID=$_POST['Course1'];
    $Batch=$_POST['Batch'];
    $Session=$_POST['session1'];
   
    $Status=$_POST['Status'];
    $Eligibility=$_POST['Eligibility'];
    $LateralEntry=$_POST['Lateral'];
   if($CourseID!='')
   {
    $collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$CollegeID' ANd CourseID='$CourseID' ";
   }
   else{
    $collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$CollegeID' ";
   
   }
    $list_cllegename = sqlsrv_query($conntest,$collegename);
                      
                  
                    if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
                       {
    
                       // print_r($row);
                    $CollegeName=$row_college['CollegeName'] ;
                    if($CourseID!='')
                    {
                    $CourseName=$row_college['Course'] ;
                    }
                    else{
                        $CourseName="All" ;

                    }
                    
            }
$SrNo=1;
$subCount=20;
$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
<thead>  
<tr>
";

$exportstudy.="<th colspan='".$subCount."' ><b style='font-size:22px;'>".$CollegeName."</b></th>         
</tr><tr>";
$exportstudy.="<th colspan='".$subCount."' ><b style='text-align:left;'>Batch:&nbsp;&nbsp;".$Batch."</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style='text-align:center;'>  Course:&nbsp;&nbsp;".$CourseName."</b></th>        
</tr>
          
    <tr style='background-color:black; color:white;'>
    <th>SrNo</th>
    <th>IDNo </th>
    <th>ClassRoll No </th>
    <th>UniRoll No </th>
    <th>Name </th>
    <th>Father Name </th>
    <th>Mother Name </th>
    <th>Mobile No </th>
    <th>Category </th>
    <th>EmailID </th>
    <th>College </th>
    <th>Course </th>
    <th>Batch </th>
    <th>Eligible </th>
    <th>Country </th>
    <th>State </th>
    <th>District </th>
    <th>Nationality </th>
    <th>Remarks </th>
    <th>Status </th>
    </tr>
        </thead>";


        $SrNo=1;
        $query = "SELECT * FROM Admissions WHERE 1 = 1";
  
        if ($CollegeID != '') {
            $query .= " AND CollegeID='$CollegeID'";
        }
        
        if ($CourseID != '') {
            $query .= " AND CourseID ='$CourseID'";
        }
        
        if ($Batch != '') {
            $query .= " AND Batch='$Batch'";
        }
        
        if ($Status != '') {
            $query .= " AND Status='$Status'";
        }
        
        if ($Session != '') {
            $query .= " AND Session='$Session'";
        }
        if ($Eligibility != '') {
            $query .= " AND Eligibility='$Eligibility'";
        }
        if ($LateralEntry != '') {
            $query .= " AND LateralEntry='$LateralEntry'";
        }
         $result = sqlsrv_query($conntest,$query);
         while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
         {
            
            $IDNo=$row['IDNo'];
            $ClassRollNo=$row['ClassRollNo'];
            $UniRollNo=$row['UniRollNo'];
            $StudentName=$row['StudentName'];
            $FatherName=$row['FatherName'];
            $MotherName=$row['MotherName'];
            $StudentMobileNo=$row['StudentMobileNo'];
            $EmailID=$row['EmailID'];
            $CollegeName=$row['CollegeName'];
            $Course=$row['Course'];
            $Batch=$row['Batch'];
            $Ereason=$row['EligibilityReason'];
            $Country=$row['country'];
            $State=$row['State'];
             $StatusType=$row['StatusType'];
            $District=$row['District'];
            $Nationality=$row['Nationality'];
            $Refrence=$row['FeeWaiverScheme'];
            $Category=$row['Category'];


            if($StatusType>0)
            {
                $StatusType='Provisional';

            }
            else
            {
                $StatusType='';

            }


            if($row['EligibilityReason']!='' && $row['Eligibility']==1)
            {

                $Eligibility="Provisional Eligible";
                $clr="blue";
            }
            else if($row['Eligibility']==1)
            {

                $Eligibility="Eligible";
                $clr="green";
            }
            else{
                $Eligibility="Not Eligible";
                $clr="yellow";
                
            }


            if($row['Status']==1)
            {

                $status=$StatusType." Active";

                $clr1="green";
            }
            else{
                $status=$StatusType." Left";
                $clr1="red";
            }



         
         $exportstudy.="<tr >

         <td>{$SrNo}</td>
         <td>{$IDNo}</td>
         <td>{$ClassRollNo}</td>
         <td>{$UniRollNo}</td>
         <td>{$StudentName}</td>
         <td>{$FatherName}</td>
         <td>{$MotherName}</td>
         <td>{$StudentMobileNo}</td>
         <td>{$Category}</td>
         <td>{$EmailID}</td>
         <td>{$CollegeName}</td>
         <td>{$Course}</td>
         <td>{$Batch}</td>
         <td style='background-color:".$clr.";'>{$Eligibility}</td>     
         <td>{$Country}</td>     
         <td>{$State}</td>     
         <td>{$District}</td>     
         <td>{$Nationality}</td>     
         <td>{$Ereason}</td>     
         <td style='background-color:".$clr1.";'>{$status}</td>     
     </tr>";


$SrNo++;
         }
         

    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="Student Report ";
}

else if($exportCode==40)
{
    $College=$_GET['CollegeId'];
$Course=$_GET['Course'];
$Batch=$_GET['Batch'];
$Semester=$_GET['Semester'];
$Type=$_GET['Type'];
$Group=$_GET['Group'];
$Examination=$_GET['Examination'];

$SrNo=1;
$Subjects=array();
$SubjectNames=array();
$SubjectTypes=array();
$SubjectsNew=array();
$SubjectNamesNew=array();
$SubjectTypesNew=array();





$collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
$list_cllegename = sqlsrv_query($conntest,$collegename);
                  
              
                if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $CollegeName=$row_college['CollegeName'] ;
                $CourseName=$row_college['Course'] ;
                
        }


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1'";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjects[]=$row_subject['SubjectCode'] ;
               $SubjectNames[]=$row_subject['SubjectName'] ;
               $SubjectTypes[]=$row_subject['SubjectType'] ;
}


$sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='O' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";

$sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {

                $SubjectsNew[]=$row_subject['SubjectCode'] ;
                $SubjectNamesNew[]=$row_subject['SubjectName'] ;
                $SubjectTypesNew[]=$row_subject['SubjectType'] ;
}

$Subjects=array_merge($Subjects,$SubjectsNew);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesNew);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesNew);


$subCount=count($Subjects)+4;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>  
        <tr>
       ";

 $exportstudy.="<th colspan='".$subCount."' ><b style='font-size:22px;'>".$CollegeName."</b></th>         
    </tr><tr>";
    $exportstudy.="<th colspan='".$subCount."' ><b style='text-align:left;'>".$Batch."</b> <b style='text-align:center;'>  Course:".$CourseName."</b><b style='text-align:right;'>   Semester:".$Semester."</b></th>        
    </tr>
    <tr>";
    $exportstudy.="<th colspan='".$subCount."'><b style='font-size:20px;'>Cutlist Examination (".$Examination.")</b></th>         
    </tr>
    <tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th >".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
}
  $exportstudy.="</tr>  
        </thead>"; 




    $list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo
    FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";
        
        
                $j=0;
               
               
                        $list_result = sqlsrv_query($conntest,$list_sql);
                            $count = 1;
                      if($list_result === false)
                        {
                       die( print_r( sqlsrv_errors(), true) );
                       }
                        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                           {
                           // print_r($row);
                        $IDNos=$row['IDNo'];
                        $UnirollNos=$row['UniRollNo'];
                        $ClassRollNos=$row['ClassRollNo'];
                         $Examid=$row['ID'];
                         $StudentNames =$row['StudentName'];     
     
      $exportstudy.="<tr>
         <td>{$SrNo}</td>
         <td>{$ClassRollNos}</th>
         <th>{$UnirollNos}</td>
         <td>{$StudentNames}</td>";


         for($sub=0;$sub<$subCount1;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjects[$sub]' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                            $ExternalExam=$row_exam['ExternalExam'];
                           $exportstudy.="<td style='text-align:center;'>{$ExternalExam} </td>"; 
                          }
                          
          }
          $exportstudy.="</tr>";
                            
                        }


                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName="Cutlist EXamination ".$Examination;
    } 


         else if($exportCode==41)
         {
            $ExaminationFatch=$_GET['ExaminationFatch'];
            $subject_code=$_GET['subject_code'];
            $CourseFatch=$_GET['CourseFatch'];
            $subName=$_GET['subName'];
            $SemesterFatch=$_GET['SemesterFatch'];
            $TypeFatch=$_GET['TypeFatch'];
            $BatchFatch=$_GET['BatchFatch'];
         $SrNo=1;
         $subCount=14;
         $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
         <thead>  
         <tr>
         ";
         
         $exportstudy.="<th colspan='".$subCount."' ><b style='font-size:22px;'>".$CourseFatch."</b></th>         
         </tr><tr>";
         $exportstudy.="<th colspan='".$subCount."' ><b style='text-align:left;'>Subject Code:&nbsp;&nbsp;".$subject_code."</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style='text-align:center;'>  Subject Name:&nbsp;&nbsp;".$subName."</b></th>        
         </tr>
                   
             <tr >
             <th style='background-color:black; color:white;'>SrNo</th>
             <th style='background-color:black; color:white;'>IDNo </th>
             <th style='background-color:black; color:white;'>ClassRoll No </th>
             <th style='background-color:black; color:white;'>UniRoll No </th>
             <th style='background-color:black; color:white;'>Name </th>
             <th style='background-color:black; color:white;'>Father Name </th>
             <th style='background-color:black; color:white;'>Mother Name </th>
             <th style='background-color:black; color:white;'>Subject Code </th>
             <th style='background-color:black; color:white;'>Subject Name </th>
             <th style='background-color:black; color:white;'>Course </th>
             <th style='background-color:black; color:white;'>Semester </th>
             <th style='background-color:black; color:white;'>Batch </th>
             <th style='background-color:black; color:white;'>Type </th>
             <th style='background-color:black; color:white;'>Examination </th>
          
             </tr>
             




                 </thead>";
         
         
               
                 $SrNo=1;
                //  $sql_open="SELECT *,ExamFormSubject.Course as CourseName,ExamFormSubject.CollegeName as College, ExamFormSubject.Batch as BatchS from ExamFormSubject inner join Admissions ON Admissions.IDNo=ExamFormSubject.IDNo  where 
                //  ExamFormSubject.Course='$CourseFatch'ANd ExamFormSubject.Type='$TypeFatch' ANd ExamFormSubject.ExternalExam='Y' ANd ExamFormSubject.SubjectCode='$subject_code' ANd ExamFormSubject.SemesterID='$SemesterFatch' AND ExamFormSubject.Examination='$ExaminationFatch' AND ExamFormSubject.Batch='$BatchFatch'";
               $sql_open="SELECT *,ExamFormSubject.Course as CourseName,ExamFormSubject.CollegeName as College, ExamFormSubject.Batch as BatchS  from ExamFormSubject INNER JOIN ExamForm On ExamForm.ID=ExamFormSubject.Examid inner join Admissions On Admissions.IDNo=ExamFormSubject.IDNo where 
               ExamFormSubject.Course='$CourseFatch'ANd ExamFormSubject.Type='$TypeFatch' ANd ExamFormSubject.ExternalExam='Y' 
               ANd ExamFormSubject.SubjectCode='$subject_code' ANd ExamFormSubject.SemesterID='$SemesterFatch' AND 
               ExamFormSubject.Examination='$ExaminationFatch' and ExamFormSubject.Batch='$BatchFatch' and ExamForm.Status='8'";


               
                  $result = sqlsrv_query($conntest,$sql_open);
                  while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC) )
                  {
                     
                     $IDNo=$row['IDNo'];
                     $ClassRollNo=$row['ClassRollNo'];
                     $UniRollNo=$row['UniRollNo'];
                     $StudentName=$row['StudentName'];
                     $FatherName=$row['FatherName'];
                     $MotherName=$row['MotherName'];
                    //  $CollegeName=$row['CollegeName'];
                     $Course=$row['Course'];
                     $Batch=$row['Batch'];
                     $Ereason=$row['EligibilityReason'];
                     $Country=$row['country'];
                     $State=$row['State'];
                     $District=$row['District'];
                     $Nationality=$row['Nationality'];
                     $Refrence=$row['FeeWaiverScheme'];
         
                   
         
         
         
                  
                  $exportstudy.="<tr >
         
                  <td>{$SrNo}</td>
                  <td>{$IDNo}</td>
                  <td>{$ClassRollNo}</td>
                  <td>{$UniRollNo}</td>
                  <td>{$StudentName}</td>
                  <td>{$FatherName}</td>
                  <td>{$MotherName}</td>
                  <td>{$subject_code}</td>
                  <td>{$subName}</td>
                  <td>{$Course}</td>
                  <td>{$SemesterFatch}</td>
                  <td>{$Batch}</td>
                  <td>{$TypeFatch}</td>
                  <td>{$ExaminationFatch}</td>
                  

              </tr>";
         
         
         $SrNo++;
                  }
            
         
             $exportstudy.="</table>";
             echo $exportstudy;
             $fileName="Strength Calculator Report ";
         }


         else if($exportCode==42)
         {
             $College=$_GET['CollegeId'];
         $Course=$_GET['Course'];
         $Semester=$_GET['Semester'];
         $Type=$_GET['Type'];
         $Examination=$_GET['Examination'];
         $Status=$_GET['Status'];               
         $SrNo=1;
         $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
         <thead>  
         <tr>
         ";
         $exportstudy.="<th style='background-color:black; color:white;'>IDNo</th>
             <th style='background-color:black; color:white;'>College Name</th>
             <th style='background-color:black; color:white;'>Course</th>
             <th style='background-color:black; color:white;'>Student Name</th>
             <th style='background-color:black; color:white;'>Gender</th>
             <th style='background-color:black; color:white;'>Category</th>
             <th style='background-color:black; color:white;'>Class Roll No</th>
             <th style='background-color:black; color:white;'>UniRollno</th>
             <th style='background-color:black; color:white;'>Father Name</th>
             <th style='background-color:black; color:white;'>Mother Name</th>
             <th style='background-color:black; color:white;'>EmailID</th>
             <th style='background-color:black; color:white;'>Student Mobile No</th>
             <th style='background-color:black; color:white;'>City</th>
             <th style='background-color:black; color:white;'>State</th>
             <th style='background-color:black; color:white;'>PIN</th>
             <th style='background-color:black; color:white;'>Semester</th>
             <th style='background-color:black; color:white;'>Regidtration Date</th>
             <th style='background-color:black; color:white;'>Registraion Rejected Reason</th>
             <th style='background-color:black; color:white;'>Examination</th>
             <th style='background-color:black; color:white;'>Accountant Reject Reason</th>
             <th style='background-color:black; color:white;'>Register Verified Date</th>
             <th style='background-color:black; color:white;'>Accountant Verification Date</th>
             <th style='background-color:black; color:white;'>Eligibility</th>
             <th style='background-color:black; color:white;'>Registration Status</th>";
             $exportstudy.="</tr></thead>";             
             $list_sql = "SELECT *,ExamForm.Status as ExamStatus
             FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo 
             where 1=1";
              if ($College != '') 
              {
             $list_sql.=" AND ExamForm.CollegeID='$College' ";
              }
              if ($Course != '') {
             $list_sql.="AND ExamForm.CourseID='$Course'  ";
              }
              if ($Type != '') {
             $list_sql.="AND ExamForm.Type='$Type' ";
              }
              if ($Semester != '') {
             $list_sql.=" AND  ExamForm.SemesterID='$Semester' ";
              }
              if ($Examination != '') {
              $list_sql.=" AND ExamForm.Examination='$Examination' ";
              }
             if ($Status != '') {
             if ($Status== '0') {
              $list_sql.=" AND (ExamForm.Status>='0' and  ExamForm.Status!='22') ";
              }
              else
              {  
             $list_sql.=" AND ExamForm.Status='$Status' ";
              }
             }
              if ($Status=='') 
              {
             $list_sql.=" AND (ExamForm.Status='0' or ExamForm.Status='-1' or ExamForm.Status='22') ";
              }
             $list_sql.=" ORDER BY ExamForm.Status"; 
                                 $list_result = sqlsrv_query($conntest,$list_sql);
                                 while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                                    {
                                    // $aa=$row;
                                 $IDNo=$row['IDNo'];
                                 $CollegeName=$row['CollegeName'];
                                 $Course=$row['Course'];
                                 $StudentName=$row['StudentName'];
                                 $Gender=$row['Sex'];
                                 $Category=$row['Category'];
                                 $ClassRollNo=$row['ClassRollNo'];
                                 $UniRollno=$row['UniRollNo'];
                                 $FatherName=$row['FatherName'];
                                 $MotherName=$row['MotherName'];
                                 $EmailID=$row['EmailID'];
                                 $StudentMobileNo=$row['StudentMobileNo'];
                                 $City=$row['City'];
                                 $State=$row['State'];
                                 $PIN=$row['PIN'];
                                 $Semester=$row['Semester'];                           
                                 $Examination=$row['Examination'];
                                //  $Eligibility=$row['Eligibility'];
                                 $RegistrationStatus=$row['ExamStatus'];
                                 if($row['Eligibility']==1)
                                 {
                     
                                     $Eligibility="Eligible";
                                     $clr="green";
                                 }
                                 else if($row['EligibilityReason']!='' && $row['Eligibility']==1)
                                 {
                     
                                     $Eligibility="Provisional Eligible";
                                     $clr="blue";
                                 }
                                 else{
                                     $Eligibility="Not Eligible";
                                     $clr="yellow";
                                     
                                 }


                                 
if($RegistrationStatus==-1)
{
  $Status="Pending";
  $trColor="";

}
 if($RegistrationStatus==22)
{
  $Status="Rejected By Registration Branch";
  $trColor="#FDB9AB";

}
elseif($RegistrationStatus==0)
{
  $Status="Forward to Department";
  $trColor="#CEEDB6";
}
elseif($RegistrationStatus==1)
{
  $Status="Forward to Dean";
  $trColor="#F3ED8F";
}

elseif($RegistrationStatus==2)
{
  $Status="Rejected By Department";
}
 elseif($RegistrationStatus==3)
{
  $Status="Rejected By Dean";
  $trColor="#FFC6C1";
}

elseif($RegistrationStatus==4)
{
  $Status="Forward to Account";
  $trColor="#9FCAF7";
}
elseif($RegistrationStatus==5)
{
  $Status="Forward to Examination Branch";
  $trColor="#9FCAF7";
}

elseif($RegistrationStatus==6)
{
  $Status="Rejected By Accountant";
  $trColor="#FFC6C1";
}
elseif($RegistrationStatus==7)
{
  $Status="Rejected_By Examination Branch";
  $trColor="#FFC6C1";
}           

elseif($RegistrationStatus==8)
{
   $Status="Accepted";
   $trColor="#CEEDB6";
} 




                                 if($row['DeanVerifiedDate']!=''){

                                     $DeanVerifiedDate=$row['DeanVerifiedDate']->format('Y-m-d h:i:s.v');
                                 }else{
                                    $DeanVerifiedDate="";
                                 }
                                 if($row['AccountantVerificationDate']!=''){

                                   
                                    $AccountantVerificationDate=$row['AccountantVerificationDate']->format('Y-m-d h:i:s.v');
                                }else{
                                   $AccountantVerificationDate="";
                                }

                                if($row['ExaminationVerifiedDate']!=''){

                                   
                                    $ExaminationVerifiedDate=$row['ExaminationVerifiedDate']->format('Y-m-d h:i:s.v');
                                }else{
                                   $ExaminationVerifiedDate="";
                                }
                                if($row['RegistraionVerifDate']!=''){

                                    $RegistraionVerifDate=$row['RegistraionVerifDate']->format('Y-m-d h:i:s.v');
                                    
                                }else{
                                   $RegistraionVerifDate="";
                                }
                                
                                   
                                    $DepartmentRejectReason=$row['DepartmentRejectReason'];
                                    $DeanRejectReason=$row['DeanRejectReason'];
                                    $AccountantRejectReason=$row['AccountantRejectReason'];
                                    $ExaminationRejectReason=$row['ExaminationRejectReason'];
                                    $RegistraionRejectedReason=$row['RegistraionRejectedReason'];
                                    $RegisterRejectReason=$row['RegisterRejectReason'];
                                 
       
                                 $exportstudy.="<tr >
                                 
                                 <td style='background:{$trColor}'>{$IDNo}</td>
                                 <td style='background:{$trColor}'>{$CollegeName}</td>
                                 <td style='background:{$trColor}'>{$Course}</td>
                                 <td style='background:{$trColor}'>{$StudentName}</td>
                                 <td style='background:{$trColor}'>{$Gender}</td>
                                 <td style='background:{$trColor}'>{$Category}</td>
                                 <td style='background:{$trColor}'>{$ClassRollNo}</td>
                                 <td style='background:{$trColor}'>{$UniRollno}</td>
                                 <td style='background:{$trColor}'>{$FatherName}</td>
                                 <td style='background:{$trColor}'>{$MotherName}</td>
                                 <td style='background:{$trColor}'>{$EmailID}</td>
                                 <td style='background:{$trColor}'>{$StudentMobileNo}</td>
                                 <td style='background:{$trColor}'>{$City}</td>
                                 <td style='background:{$trColor}'>{$State}</td>
                                 <td style='background:{$trColor}'>{$PIN}</td>
                                 <td style='background:{$trColor}'>{$Semester}</td>
                                 <td style='background:{$trColor}'>{$RegistraionVerifDate}</td>
                                 <td style='background:{$trColor}'>{$RegistraionRejectedReason}</td>
                                 <td style='background:{$trColor}'>{$Examination}</td>
                                 <td style='background:{$trColor}'>{$AccountantRejectReason}</td>
                                 <td style='background:{$trColor}'>{$RegisterRejectReason}</td>
                                 <td style='background:{$trColor}'>{$AccountantVerificationDate}</td>
                                 <td style='background:{$clr}'>{$Eligibility}</td>
                                 <td style='background:{$trColor}'>{$Status}</td>
                                 
                                 
               
                             </tr>";
                 $SrNo++;
                                    }
                 $exportstudy.="</table>";
                 echo $exportstudy;
                 $fileName="Student Registration Report ".$Examination;
                  } 





                  else if($exportCode==43)
                  {
                      $College=$_GET['CollegeId'];
                  $Course=$_GET['Course'];
                  $Semester=$_GET['Semester'];
                  $Type=$_GET['Type'];
                  $Examination=$_GET['Examination'];
                  $Status=$_GET['Status'];               
                  $SrNo=1;
                  $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
                  <thead>  
                  <tr>
                  ";
                  $exportstudy.="<th style='background-color:black; color:white;'>IDNo</th>
                      <th style='background-color:black; color:white;'>College Name</th>
                      <th style='background-color:black; color:white;'>Course</th>
                      <th style='background-color:black; color:white;'>Student Name</th>
                      <th style='background-color:black; color:white;'>Gender</th>
                      <th style='background-color:black; color:white;'>Category</th>
                      <th style='background-color:black; color:white;'>Class Roll No</th>
                      <th style='background-color:black; color:white;'>UniRollno</th>
                      <th style='background-color:black; color:white;'>Father Name</th>
                      <th style='background-color:black; color:white;'>Mother Name</th>
                      <th style='background-color:black; color:white;'>EmailID</th>
                      <th style='background-color:black; color:white;'>Student Mobile No</th>
                      <th style='background-color:black; color:white;'>City</th>
                      <th style='background-color:black; color:white;'>State</th>
                      <th style='background-color:black; color:white;'>PIN</th>
                      <th style='background-color:black; color:white;'>Semester</th>
                      <th style='background-color:black; color:white;'>Regidtration Date</th>
                      <th style='background-color:black; color:white;'>Registraion Rejected Reason</th>
                      <th style='background-color:black; color:white;'>Examination</th>
                      <th style='background-color:black; color:white;'>Accountant Reject Reason</th>
                      <th style='background-color:black; color:white;'>Register Verified Date</th>
                      <th style='background-color:black; color:white;'>Accountant Verification Date</th>
                      <th style='background-color:black; color:white;'>Eligibility</th>
                      <th style='background-color:black; color:white;'>Registration Status</th>";
                      $exportstudy.="</tr></thead>";             
                      $list_sql = "SELECT *,ExamForm.Status as ExamStatus
                      FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo 
                      where 1=1";
                       if ($College != '') 
                       {
                      $list_sql.=" AND ExamForm.CollegeID='$College' ";
                       }
                       if ($Course != '') {
                      $list_sql.="AND ExamForm.CourseID='$Course'  ";
                       }
                       if ($Type != '') {
                      $list_sql.="AND ExamForm.Type='$Type' ";
                       }
                       if ($Semester != '') {
                      $list_sql.=" AND  ExamForm.SemesterID='$Semester' ";
                       }
                       if ($Examination != '') {
                       $list_sql.=" AND ExamForm.Examination='$Examination' ";
                       }
                      if ($Status != '') {
                      if ($Status== '8') {
                       $list_sql.=" AND (ExamForm.Status>='8' and  ExamForm.Status!='7') ";
                       }
                       else
                       {  
                      $list_sql.=" AND ExamForm.Status='$Status' ";
                       }
                      }
                       if ($Status=='') 
                       {
                      $list_sql.=" AND (ExamForm.Status='8' or ExamForm.Status='5' or ExamForm.Status='7') ";
                       }
                      $list_sql.=" ORDER BY ExamForm.Status"; 
                                          $list_result = sqlsrv_query($conntest,$list_sql);
                                          while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                                             {
                                             // $aa=$row;
                                          $IDNo=$row['IDNo'];
                                          $CollegeName=$row['CollegeName'];
                                          $Course=$row['Course'];
                                          $StudentName=$row['StudentName'];
                                          $Gender=$row['Sex'];
                                          $Category=$row['Category'];
                                          $ClassRollNo=$row['ClassRollNo'];
                                          $UniRollno=$row['UniRollNo'];
                                          $FatherName=$row['FatherName'];
                                          $MotherName=$row['MotherName'];
                                          $EmailID=$row['EmailID'];
                                          $StudentMobileNo=$row['StudentMobileNo'];
                                          $City=$row['City'];
                                          $State=$row['State'];
                                          $PIN=$row['PIN'];
                                          $Semester=$row['Semester'];                           
                                          $Examination=$row['Examination'];
                                         //  $Eligibility=$row['Eligibility'];
                                          $RegistrationStatus=$row['ExamStatus'];
                                          if($row['Eligibility']==1)
                                          {
                              
                                              $Eligibility="Eligible";
                                              $clr="green";
                                          }
                                          else if($row['EligibilityReason']!='' && $row['Eligibility']==1)
                                          {
                              
                                              $Eligibility="Provisional Eligible";
                                              $clr="blue";
                                          }
                                          else{
                                              $Eligibility="Not Eligible";
                                              $clr="yellow";
                                              
                                          }
         
         
                                          
         if($RegistrationStatus==-1)
         {
           $Status="Forward to Registration branch";
           $trColor="";
         
         }
          if($RegistrationStatus==22)
         {
           $Status="Rejected By Registration Branch";
           $trColor="#FDB9AB";
         
         }
         elseif($RegistrationStatus==0)
         {
           $Status="Forward to Department";
           $trColor="#CEEDB6";
         }
         elseif($RegistrationStatus==1)
         {
           $Status="Forward to Dean";
           $trColor="#F3ED8F";
         }
         
         elseif($RegistrationStatus==2)
         {
           $Status="Rejected By Department";
         }
          elseif($RegistrationStatus==3)
         {
           $Status="Rejected By Dean";
           $trColor="#FFC6C1";
         }
         
         elseif($RegistrationStatus==4)
         {
           $Status="Forward to Account";
           $trColor="#9FCAF7";
         }
         elseif($RegistrationStatus==5)
         {
           $Status="Pending";
           $trColor="#9FCAF7";
         }
         
         elseif($RegistrationStatus==6)
         {
           $Status="Rejected By Accountant";
           $trColor="#FFC6C1";
         }
         elseif($RegistrationStatus==7)
         {
           $Status="Rejected_By Examination Branch";
           $trColor="#FFC6C1";
         }           
         
         elseif($RegistrationStatus==8)
         {
            $Status="Accepted";
            $trColor="#CEEDB6";
         } 
         
         
         
         
                                          if($row['DeanVerifiedDate']!=''){
         
                                              $DeanVerifiedDate=$row['DeanVerifiedDate']->format('Y-m-d h:i:s.v');
                                          }else{
                                             $DeanVerifiedDate="";
                                          }
                                          if($row['AccountantVerificationDate']!=''){
         
                                            
                                             $AccountantVerificationDate=$row['AccountantVerificationDate']->format('Y-m-d h:i:s.v');
                                         }else{
                                            $AccountantVerificationDate="";
                                         }
         
                                         if($row['ExaminationVerifiedDate']!=''){
         
                                            
                                             $ExaminationVerifiedDate=$row['ExaminationVerifiedDate']->format('Y-m-d h:i:s.v');
                                         }else{
                                            $ExaminationVerifiedDate="";
                                         }
                                         if($row['RegistraionVerifDate']!=''){
         
                                             $RegistraionVerifDate=$row['RegistraionVerifDate']->format('Y-m-d h:i:s.v');
                                             
                                         }else{
                                            $RegistraionVerifDate="";
                                         }
                                         
                                            
                                             $DepartmentRejectReason=$row['DepartmentRejectReason'];
                                             $DeanRejectReason=$row['DeanRejectReason'];
                                             $AccountantRejectReason=$row['AccountantRejectReason'];
                                             $ExaminationRejectReason=$row['ExaminationRejectReason'];
                                             $RegistraionRejectedReason=$row['RegistraionRejectedReason'];
                                             $RegisterRejectReason=$row['RegisterRejectReason'];
                                          
                
                                          $exportstudy.="<tr >
                                          
                                          <td style='background:{$trColor}'>{$IDNo}</td>
                                          <td style='background:{$trColor}'>{$CollegeName}</td>
                                          <td style='background:{$trColor}'>{$Course}</td>
                                          <td style='background:{$trColor}'>{$StudentName}</td>
                                          <td style='background:{$trColor}'>{$Gender}</td>
                                          <td style='background:{$trColor}'>{$Category}</td>
                                          <td style='background:{$trColor}'>{$ClassRollNo}</td>
                                          <td style='background:{$trColor}'>{$UniRollno}</td>
                                          <td style='background:{$trColor}'>{$FatherName}</td>
                                          <td style='background:{$trColor}'>{$MotherName}</td>
                                          <td style='background:{$trColor}'>{$EmailID}</td>
                                          <td style='background:{$trColor}'>{$StudentMobileNo}</td>
                                          <td style='background:{$trColor}'>{$City}</td>
                                          <td style='background:{$trColor}'>{$State}</td>
                                          <td style='background:{$trColor}'>{$PIN}</td>
                                          <td style='background:{$trColor}'>{$Semester}</td>
                                          <td style='background:{$trColor}'>{$RegistraionVerifDate}</td>
                                          <td style='background:{$trColor}'>{$RegistraionRejectedReason}</td>
                                          <td style='background:{$trColor}'>{$Examination}</td>
                                          <td style='background:{$trColor}'>{$AccountantRejectReason}</td>
                                          <td style='background:{$trColor}'>{$RegisterRejectReason}</td>
                                          <td style='background:{$trColor}'>{$AccountantVerificationDate}</td>
                                          <td style='background:{$clr}'>{$Eligibility}</td>
                                          <td style='background:{$trColor}'>{$Status}</td>
                                          
                                          
                        
                                      </tr>";
                          $SrNo++;
                                             }
                          $exportstudy.="</table>";
                          echo $exportstudy;
                          $fileName="Student Exam Form Report ".$Examination;
                           } 

//export  admisisons
  else if($exportCode==44)
                   {
                           $Batch=$_GET['Batch'];
                           $Eligible=$_GET['Eligible'];
                           $Lateral=$_GET['Lateral'];
                           $Status=$_GET['Status'];               
                           $SrNo=1;
                           $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
                           <thead>  
                           <tr>
                           ";
                           $exportstudy.="<th style='background-color:black; color:white;'>IDNo</th>
                               <th style='background-color:black; color:white;'>College Name</th>
                               <th style='background-color:black; color:white;'>Course</th>
                               <th style='background-color:black; color:white;'>Batch</th>
                               <th style='background-color:black; color:white;'>Student Name</th>
                               <th style='background-color:black; color:white;'>Gender</th>
                               <th style='background-color:black; color:white;'>Category</th>
                               <th style='background-color:black; color:white;'>Class Roll No</th>
                               <th style='background-color:black; color:white;'>UniRollno</th>
                               <th style='background-color:black; color:white;'>Father Name</th>
                               <th style='background-color:black; color:white;'>Mother Name</th>
                               <th style='background-color:black; color:white;'>EmailID</th>
                               <th style='background-color:black; color:white;'>Student Mobile No</th>
                               <th style='background-color:black; color:white;'>City</th>
                               <th style='background-color:black; color:white;'>State</th>
                               <th style='background-color:black; color:white;'>PIN</th>
                               <th style='background-color:black; color:white;'>Lateral</th>
                               <th style='background-color:black; color:white;'>Eligibility</th>
                               <th style='background-color:black; color:white;'>Status</th>
                               ";
                               $exportstudy.="</tr></thead>";             
                               $list_sql = "SELECT * FROM Admissions  
                               where 1=1";
                    
                                if ($Batch != '') {
                               $list_sql.="AND Batch='$Batch' ";
                                }
                                if ($Eligible != '') {
                               $list_sql.=" AND  Eligibility='$Eligible' ";
                                }
                               if ($Status != '') {
                               
                               $list_sql.=" AND Status='$Status' ";
                                
                               }
                               if ($Lateral != '') {
                               
                               $list_sql.=" AND LateralEntry='$Lateral' ";
                                
                               }
                               $list_sql.=" AND CourseID!='188' ORDER BY CollegeName ASC"; 
                            
                                                   $list_result = sqlsrv_query($conntest,$list_sql);
                                                   while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                                                      {
                                                      // $aa=$row;
                                                   $IDNo=$row['IDNo'];
                                                   $CollegeName=$row['CollegeName'];
                                                   $Course=$row['Course'];
                                                   $StudentName=$row['StudentName'];
                                                   $Gender=$row['Sex'];
                                                   $Category=$row['Category'];
                                                   $ClassRollNo=$row['ClassRollNo'];
                                                   $UniRollno=$row['UniRollNo'];
                                                   $FatherName=$row['FatherName'];
                                                   $MotherName=$row['MotherName'];
                                                   $EmailID=$row['EmailID'];
                                                   $StudentMobileNo=$row['StudentMobileNo'];
                                                   
                                                   $City=$row['City'];
                                                   $State=$row['State'];
                                                   $PIN=$row['PIN'];
                                             
                                                   if($row['Eligibility']==1)
                                                   {
                                       
                                                       $Eligibility="Eligible";
                                                       $clr="green";
                                                   }
                                                   else if($row['EligibilityReason']!='' && $row['Eligibility']==1)
                                                   {
                                       
                                                       $Eligibility="Provisional Eligible";
                                                       $clr="blue";
                                                   }
                                                   else{
                                                       $Eligibility="Not Eligible";
                                                       $clr="yellow";
                                                       
                                                   }
                                                if($row['Status']==1)
                                                {
                                                    $status="Active";
                                                
                                                    $clr1="green";
                                                }else{
                                                    $status="Left";
                                                    $clr1="red";
                                                }
                                                
                                                                    
                                                if($Status=='' && $Eligible=='')
                                                {
                                                    $fileNameA="Students";
                                                }
                                                elseif($Status=='1' && $Eligible=='')
                                                {
                                                    $fileNameA="Active";
                                                }
                                                elseif($Status=='1' && $Eligible=='1')
                                                {
                                                    $fileNameA="Eligible";
                                                }
                                                elseif($Status=='1' && $Eligible=='0')
                                                {
                                                    $fileNameA="Not Eligible";
                                                }
                                                else{
                                                    $fileNameA="";
                                                }
                                                 
                                                    
                         
                                                   $exportstudy.="<tr >
                                                   
                                                   <td>{$IDNo}</td>
                                                   <td>{$CollegeName}</td>
                                                   <td>{$Course}</td>
                                                   <td>{$Batch}</td>
                                                   <td>{$StudentName}</td>
                                                   <td>{$Gender}</td>
                                                   <td>{$Category}</td>
                                                   <td>{$ClassRollNo}</td>
                                                   <td>{$UniRollno}</td>
                                                   <td>{$FatherName}</td>
                                                   <td>{$MotherName}</td>
                                                   <td>{$EmailID}</td>
                                                   <td>{$StudentMobileNo}</td>
                                                   <td>{$City}</td>
                                                   <td>{$State}</td>
                                                   <td>{$PIN}</td>
                                                   <td>{$Lateral}</td>
                                                   <td style='background:{$clr}'>{$Eligibility}</td>
                                                   <td style='background:{$clr1}'>{$status}</td>
                                                   
                                                   
                                 
                                               </tr>";
                                   $SrNo++;
                                                      }
                                   $exportstudy.="</table>";
                                   echo $exportstudy;
                                   $fileName=$Batch." Total ".$fileNameA." Report ";
                                    } 
         


 else if($exportCode==45)
                {
                                            $CollegeID=$_GET['CollegeID'];
                                            $Batch=$_GET['Batch'];
                                            $Eligible=$_GET['Eligible'];
                                            $Status=$_GET['Status'];
                                            $StatusType='';
                                            if($Status==2)
                                            {
                                                $Status=1;
                                                $StatusType=1;

                                            }
                                            if($Status==3)
                                            {

                                                $Status=0;
                                                $StatusType=1;

                                            }
                                            


                                            $Lateral=$_GET['Lateral'];                
                                            $SrNo=1;
                                            $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
                                            <thead>  
                                            <tr>
                                            ";
                                            $exportstudy.="<th style='background-color:black; color:white;'>IDNo</th>
                                                <th style='background-color:black; color:white;'>College Name</th>
                                                <th style='background-color:black; color:white;'>Course</th>
                                                <th style='background-color:black; color:white;'>Batch</th>
                                                <th style='background-color:black; color:white;'>Student Name</th>
                                                <th style='background-color:black; color:white;'>Gender</th>
                                                <th style='background-color:black; color:white;'>Category</th>
                                                <th style='background-color:black; color:white;'>Class Roll No</th>
                                                <th style='background-color:black; color:white;'>UniRollno</th>
                                                <th style='background-color:black; color:white;'>Father Name</th>
                                                <th style='background-color:black; color:white;'>Mother Name</th>
                                                <th style='background-color:black; color:white;'>EmailID</th>
                                                <th style='background-color:black; color:white;'>Student Mobile No</th>
                                                <th style='background-color:black; color:white;'>City</th>
                                                <th style='background-color:black; color:white;'>State</th>
                                                <th style='background-color:black; color:white;'>PIN</th>
                                                <th style='background-color:black; color:white;'>Lateral</th>
                                                <th style='background-color:black; color:white;'>Eligible</th>
                                                <th style='background-color:black; color:white;'>Status</th>
                                                ";
                                                $exportstudy.="</tr></thead>";             
                                                $list_sql = "SELECT * FROM Admissions  
                                                where 1=1";
                                     
                                                 if ($CollegeID != '') {
                                                $list_sql.="AND CollegeID='$CollegeID' ";
                                                 }
                                                 if ($Batch != '') {
                                                $list_sql.="AND Batch='$Batch' ";
                                                 }
                                                 if ($Eligible != '') {
                                                $list_sql.=" AND  Eligibility='$Eligible' ";
                                                 }
                                                if ($Status != '') {
                                                
                                                $list_sql.=" AND Status='$Status' ";
                                                 
                                                }
                                                if ($StatusType != '') {
                                                
                                                $list_sql.=" AND StatusType='$StatusType' ";
                                                 
                                                }
                                                if ($Lateral != '') {
                               
                                                    $list_sql.=" AND LateralEntry='$Lateral' ";
                                                     
                                                    }
                                                $list_sql.=" AND CourseID!='188' ORDER BY CollegeName ASC"; 
                                             
                                                                    $list_result = sqlsrv_query($conntest,$list_sql);
                                                                    while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                                                                       {
                                                                       // $aa=$row;
                                                                    $IDNo=$row['IDNo'];
                                                                    $CollegeName=$row['CollegeName'];
                                                                    $Course=$row['Course'];
                                                                    $StudentName=$row['StudentName'];
                                                                    $Gender=$row['Sex'];
                                                                    $Category=$row['Category'];
                                                                    $ClassRollNo=$row['ClassRollNo'];
                                                                    $UniRollno=$row['UniRollNo'];
                                                                    $FatherName=$row['FatherName'];
                                                                    $MotherName=$row['MotherName'];
                                                                    $EmailID=$row['EmailID'];
                                                                    $StudentMobileNo=$row['StudentMobileNo'];
                                                                    $LateralEntry=$row['LateralEntry'];
                                                                    $City=$row['City'];
                                                                    $State=$row['State'];
                                                                    $PIN=$row['PIN'];


      $StatusType=$row['StatusType'];
            if($StatusType>0)
            {
                $StatusType='Provisional';

            }
            else
            {
                $StatusType='';

            }


                                                              


                                                                   
                                                                   if($row['EligibilityReason']!='' && $row['Eligibility']==1)
                                                                    {
                                                        
                                                                        $Eligibility="Provisional Eligible";
                                                                        $clr="blue";
                                                                    }
                                                                    else  if($row['Eligibility']==1)
                                                                    {
                                                        
                                                                        $Eligibility="Eligible";
                                                                        $clr="green";
                                                                    }
                                                                   
                                                                    else{
                                                                        $Eligibility="Not Eligible";
                                                                        $clr="yellow";
                                                                        
                                                                    }
                                                                 if($row['Status']==1)
                                                                 {
                                                                     $status=$StatusType." Active";
                                                                 
                                                                     $clr1="green";
                                                                 }else{
                                                                     $status=$StatusType." Left";
                                                                     $clr1="red";
                                                                 }
                                                                 
                                                                                     
                                                                 if($Status=='' && $Eligible=='')
                                                                 {
                                                                     $fileNameA="All";
                                                                 }
                                                                 elseif($Status=='1' && $Eligible=='')
                                                                 {
                                                                     $fileNameA="Active";
                                                                 }
                                                                 elseif($Status=='1' && $Eligible=='1')
                                                                 {
                                                                     $fileNameA="Eligible";
                                                                 }
                                                                 elseif($Status=='1' && $Eligible=='0')
                                                                 {
                                                                     $fileNameA="Not Eligible";
                                                                 }
                                                                 else{
                                                                     $fileNameA="";
                                                                 }
                                                                  
                                                                     
                                          
                                                                    $exportstudy.="<tr >
                                                                    
                                                                    <td>{$IDNo}</td>
                                                                    <td>{$CollegeName}</td>
                                                                    <td>{$Course}</td>
                                                                    <td>{$Batch}</td>
                                                                    <td>{$StudentName}</td>
                                                                    <td>{$Gender}</td>
                                                                    <td>{$Category}</td>
                                                                    <td>{$ClassRollNo}</td>
                                                                    <td>{$UniRollno}</td>
                                                                    <td>{$FatherName}</td>
                                                                    <td>{$MotherName}</td>
                                                                    <td>{$EmailID}</td>
                                                                    <td>{$StudentMobileNo}</td>
                                                                    <td>{$City}</td>
                                                                    <td>{$State}</td>
                                                                    <td>{$PIN}</td>
                                                                    <td>{$Lateral}</td>
                                                                    <td style='background:{$clr}'>{$Eligibility}</td>
                                                                    <td style='background:{$clr1}'>{$status}</td>
                                                                    
                                                                    
                                                  
                                                                </tr>";
                                                    $SrNo++;
                                                                       }
                                                    $exportstudy.="</table>";
                                                    echo $exportstudy;
                                                    $fileName=$Batch.' '.$CollegeName.' '.$fileNameA." Students Report ";
                                                     } 


 else if($exportCode==46)
              {
                                                                                 $CollegeID=$_GET['CollegeID'];
                                                                                 $Batch=$_GET['Batch'];
                                                                                 $Eligible=$_GET['Eligible'];
                                                                                 $Status=$_GET['Status']; 
                                                                                 $Lateral=$_GET['Lateral'];  
                                                                                 $CollegeName="";
                                                                                 $Course="";             
                                                                                 $SrNo=1;
                                                                                 $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
                                                                                 <thead>  
                                                                                 <tr>
                                                                                 ";
                                                                                 $exportstudy.="
                                                                                     <th style='background-color:black; color:white;'>College Name</th>
                                                                                     <th style='background-color:black; color:white;'>Course</th>
                                                                                     <th style='background-color:black; color:white;'>Batch</th>
                                                                                     <th style='background-color:black; color:white;'>TotalAdmission</th>
                                                                                     <th style='background-color:black; color:white;'>Active</th>
                                                                                     <th style='background-color:black; color:white;'>Eligible</th>
                                                                                     <th style='background-color:black; color:white;'>Not Eligible</th>
                                                                                     <th style='background-color:black; color:white;'>Lateral</th>
                                                                                    
                                                                                     ";
                                                                                     $exportstudy.="</tr></thead>";             
                                                                                     $list_sql = "SELECT DISTINCT CollegeID,CourseID,CollegeName,Course FROM Admissions  
                                                                                     where 1=1";
                                                                          
                                                                                      if ($CollegeID != '') {
                                                                                     $list_sql.="AND CollegeID='$CollegeID' ";
                                                                                      }
                                                                                      if ($Batch != '') {
                                                                                     $list_sql.="AND Batch='$Batch' ";
                                                                                      }
                                                                                      if ($Eligible != '') {
                                                                                     $list_sql.=" AND  Eligibility='$Eligible' ";
                                                                                      }
                                                                                     if ($Status != '') {
                                                                                     
                                                                                     $list_sql.=" AND Status='$Status' ";
                                                                                      
                                                                                     }
                                                                                     if ($Lateral != '') {
                               
                                                                                        $list_sql.=" AND LateralEntry='$Lateral' ";
                                                                                         
                                                                                        }
                                                                                     $list_sql.=" AND CourseID!='188' ORDER BY CollegeName ASC"; 
                                                                                  
                                                                                                         $list_result = sqlsrv_query($conntest,$list_sql);
                                                                                                         while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                                                                                                            {
                                                                                                                $get_study_scheme="SELECT * FROM Admissions WHERE  Batch='$Batch' and CollegeID='".$row['CollegeID']."' and CourseID='".$row['CourseID']."'AND LateralEntry='$Lateral'AND CourseID!='188' ";
                                                                                                                $get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                                                                                 $TotalAdmission=sqlsrv_num_rows($get_study_scheme_run);
                                                                                                             
                                                                                                                 $getActiveTotal="SELECT * FROM Admissions WHERE  Batch='$Batch' and Status='1' and CollegeID='".$row['CollegeID']."' and CourseID='".$row['CourseID']."'AND LateralEntry='$Lateral'AND CourseID!='188' ";
                                                                                                                 $getActiveTotal_run=sqlsrv_query($conntest,$getActiveTotal,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                                                                                  $TotalActive=sqlsrv_num_rows($getActiveTotal_run);
                                                                                                               
                                                                                                                  $getLeftTotal="SELECT * FROM Admissions WHERE  Batch='$Batch' and Eligibility='0' and Status='1' and CollegeID='".$row['CollegeID']."' and CourseID='".$row['CourseID']."'AND LateralEntry='$Lateral'AND CourseID!='188' ";
                                                                                                                  $getLeftTotal_run=sqlsrv_query($conntest,$getLeftTotal,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                                                                                   $TotalLeft=sqlsrv_num_rows($getLeftTotal_run);
                                                                                                             
                                                                                                                   $getEligibility="SELECT * FROM Admissions WHERE  Batch='$Batch' and Eligibility='1' and Status='1' and CollegeID='".$row['CollegeID']."' and CourseID='".$row['CourseID']."'AND LateralEntry='$Lateral'AND CourseID!='188' ";
                                                                                                                  $getEligibility_run=sqlsrv_query($conntest,$getEligibility,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                                                                                   $TotalEligibility=sqlsrv_num_rows($getEligibility_run);
                                                                                                             
                                                                                                                   $count[0]=$TotalAdmission;
                                                                                                                   $count[1]=$TotalActive;
                                                                                                                   $count[2]=$TotalLeft;
                                                                                                                   $count[3]=$TotalEligibility;

                                                                                                         $CollegeName=$row['CollegeName'];
                                                                                                         $Course=$row['Course'];


                                                                               
                                                                                                         $exportstudy.="<tr >
                                                                                                         
                                                                                                       
                                                                                                         <td>{$CollegeName}</td>
                                                                                                         <td>{$Course}</td>   
                                                                                                         <td>{$Batch}</td>   
                                                                                                         <td>{$TotalAdmission}</td>
                                                                                                         <td>{$TotalActive}</td>
                                                                                                         <td>{$TotalEligibility}</td>
                                                                                                         <td>{$TotalLeft}</td>
                                                                                                         <td>{$Lateral}</td>
                                                                                                        
                                                                                                         
                                                                                                         
                                                                                       
                                                                                                     </tr>";
                                                                                         $SrNo++;
                                                                                                            }
                                                                                         $exportstudy.="</table>";
                                                                                         echo $exportstudy;
                                                                                         $fileName=$Batch.' '.$CollegeName." Students summary ";
                                                                                          } 
      else if($exportCode==47)
      {    
                   
                   $Batch=$_GET['Batch'];
                   $Eligible=$_GET['Eligible'];
                   $Status=$_GET['Status'];               
                   $Lateral=$_GET['Lateral'];  
                   $CollegeName="";
                   $Course="";              
                   $SrNo=1;
                   if($Status=='' && $Eligible=='')
                   {
                       $fileNameA="Students";
                   }
                   elseif($Status=='1' && $Eligible=='')
                   {
                       $fileNameA="Active";
                   }
                   elseif($Status=='1' && $Eligible=='1')
                   {
                       $fileNameA="Eligible";
                   }
                   elseif($Status=='1' && $Eligible=='0')
                   {
                       $fileNameA="Not Eligible";
                   }
                   else{
                       $fileNameA="";
                   }
                   $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
                   <thead>  
                   <tr>
                   ";
              


                       if($Status=='' && $Eligible=='')
                       {
                        $exportstudy.=" <th style='background-color:black; color:white;'>College Name</th>
                        <th style='background-color:black; color:white;'>Course</th>
                        <th style='background-color:black; color:white;'>Batch</th>
                        <th style='background-color:black; color:white;'>Total Admission</th>
                        <th style='background-color:black; color:white;'>Active</th>
                        <th style='background-color:black; color:white;'>Eligible</th>
                        <th style='background-color:black; color:white;'>Eligible</th>
                        <th style='background-color:black; color:white;'>Lateral</th>";
                       }
                       elseif($Status=='1' && $Eligible=='')
                       {
                        $exportstudy.=" 
                        <th style='background-color:black; color:white;'>College Name</th>
                        <th style='background-color:black; color:white;'>Batch</th>
                        <th style='background-color:black; color:white;'>Active</th>
                        <th style='background-color:black; color:white;'>Lateral</th>
                       ";
                       }
                       elseif($Status=='1' && $Eligible=='1')
                       {
                        $exportstudy.=" 
                        <th style='background-color:black; color:white;'>College Name</th>
                        <th style='background-color:black; color:white;'>Batch</th>
                        <th style='background-color:black; color:white;'>Eligibility</th>
                        <th style='background-color:black; color:white;'>Lateral</th>
                        ";
                       }
                       elseif($Status=='1' && $Eligible=='0')
                       {
                        $exportstudy.=" 
                        <th style='background-color:black; color:white;'>College Name</th>
                        <th style='background-color:black; color:white;'>Batch</th>
                        <th style='background-color:black; color:white;'>Not Eligible</th>
                        <th style='background-color:black; color:white;'>Lateral</th>";
                       }
                       else{
                           $fileNameA="";
                       }
                       $exportstudy.="</tr></thead>";             
                       $list_sql = "SELECT DISTINCT CollegeID,CollegeName FROM Admissions  
                       where 1=1";
            
                        if ($Batch != '') {
                       $list_sql.="AND Batch='$Batch' ";
                        }
                        if ($Eligible != '') {
                       $list_sql.=" AND  Eligibility='$Eligible' ";
                        }
                       if ($Status != '') {
                       
                       $list_sql.=" AND Status='$Status' ";
                        
                       }
                       if ($Lateral != '') {
                               
                        $list_sql.=" AND LateralEntry='$Lateral' ";
                         
                        }
                       $list_sql.="  AND CourseID!='188' ORDER BY CollegeName ASC"; 
                    
                                           $list_result = sqlsrv_query($conntest,$list_sql);
                                           while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                                              {
                                                  $get_study_scheme="SELECT * FROM Admissions WHERE  Batch='$Batch' and CollegeID='".$row['CollegeID']."' AND LateralEntry='$Lateral' AND CourseID!='188'";
                                                  $get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                   $TotalAdmission=sqlsrv_num_rows($get_study_scheme_run);
                                               
                                                   $getActiveTotal="SELECT * FROM Admissions WHERE  Batch='$Batch' and Status='1' and CollegeID='".$row['CollegeID']."' AND LateralEntry='$Lateral' AND CourseID!='188'";
                                                   $getActiveTotal_run=sqlsrv_query($conntest,$getActiveTotal,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                    $TotalActive=sqlsrv_num_rows($getActiveTotal_run);
                                                 
                                                    $getLeftTotal="SELECT * FROM Admissions WHERE  Batch='$Batch' and Eligibility='0' and Status='1' and CollegeID='".$row['CollegeID']."' AND LateralEntry='$Lateral' AND CourseID!='188'";
                                                    $getLeftTotal_run=sqlsrv_query($conntest,$getLeftTotal,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                     $TotalLeft=sqlsrv_num_rows($getLeftTotal_run);
                                               
                                                     $getEligibility="SELECT * FROM Admissions WHERE  Batch='$Batch' and Eligibility='1' and Status='1' and CollegeID='".$row['CollegeID']."' AND LateralEntry='$Lateral' AND CourseID!='188'";
                                                    $getEligibility_run=sqlsrv_query($conntest,$getEligibility,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
                                                     $TotalEligibility=sqlsrv_num_rows($getEligibility_run);
                                               
                                                     $count[0]=$TotalAdmission;
                                                     $count[1]=$TotalActive;
                                                     $count[2]=$TotalLeft;
                                                     $count[3]=$TotalEligibility;
                                                                            
                                           $CollegeName=$row['CollegeName'];
                                        //    $Course=$row['Course'];
                                                                            
                 
                                        

                                           if($Status=='' && $Eligible=='')
                                           {
                                            $exportstudy.=" <tr ><td>{$CollegeName}</td>
                                        
                                            <td>{$CollegeName}</td>
                                            <td>{$Batch}</td>
                                            <td>{$TotalAdmission}</td>
                                            <td>{$TotalActive}</td>
                                            <td>{$TotalEligibility}</td>
                                            <td>{$TotalLeft}</td>
                                            <td>{$Lateral}</td>
                                            ";
                                           }
                                           elseif($Status=='1' && $Eligible=='')
                                           {
                                            $exportstudy.=" <tr >
                                            <td>{$CollegeName}</td>
                                            <td>{$Batch}</td>
                                            <td>{$TotalActive}</td>
                                            <td>{$Lateral}</td>
                                            ";
                                           }
                                           elseif($Status=='1' && $Eligible=='1')
                                           {
                                            $exportstudy.=" <tr >
                                            <td>{$CollegeName}</td>
                                            <td>{$Batch}</td>
                                            <td>{$TotalEligibility}</td>
                                            <td>{$Lateral}</td>
                                            ";
                                           }
                                           elseif($Status=='1' && $Eligible=='0')
                                           {
                                            $exportstudy.=" <tr >
                                            <td>{$CollegeName}</td>
                                            <td>{$Batch}</td>
                                            <td>{$TotalLeft}</td>
                                            <td>{$Lateral}</td>";
                                           }
                                           else{
                                               $fileNameA="";
                                           }  
                                           
                                           
                         
                                           $exportstudy.="</tr>";
                           $SrNo++;
                                              }
                           $exportstudy.="</table>";
                           echo $exportstudy;
                           $fileName=$Batch.' Total '.$fileNameA." Students summary ";
                            } 
 else if($exportCode==48)
     {
        $College = isset($_GET['College']) ? $_GET['College'] : '';
    $Course = isset($_GET['Course']) ? $_GET['Course'] : '';
    $Semester = isset($_GET['Semester']) ? $_GET['Semester'] : '';
    $Type = isset($_GET['Type']) ? $_GET['Type'] : '';
    $Status = isset($_GET['Status']) ? $_GET['Status'] : '';
    $Examination = isset($_GET['Examination']) ? $_GET['Examination'] : '';
            $SrNo=1;
            $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
            <thead>  
            <tr>
            ";
            $SrNo=1;
            $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
            <thead>  
            <tr>
            ";
            $exportstudy.="<th style='background-color:black; color:white;'>IDNo</th>
                <th style='background-color:black; color:white;'>College Name</th>
                <th style='background-color:black; color:white;'>Course</th>
              
                <th style='background-color:black; color:white;'>Student Name</th>
                <th style='background-color:black; color:white;'>Gender</th>
                <th style='background-color:black; color:white;'>Category</th>
                <th style='background-color:black; color:white;'>Class Roll No</th>
                <th style='background-color:black; color:white;'>UniRollno</th>
                <th style='background-color:black; color:white;'>Father Name</th>
                <th style='background-color:black; color:white;'>Mother Name</th>
                <th style='background-color:black; color:white;'>EmailID</th>
                <th style='background-color:black; color:white;'>Student Mobile No</th>
              
                <th style='background-color:black; color:white;'>Status</th>
                ";
                $exportstudy.="</tr></thead>";             
                $list_sql = "SELECT   *,ExamForm.Status as ExamStatus
                FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo 
                where Admissions.Status='1' ";
                 if ($College != '') 
                 {
                $list_sql.=" AND ExamForm.CollegeID='$College' ";
                 }
                 if ($Course != '') {
                $list_sql.="AND ExamForm.CourseID='$Course'  ";
                 }
                 if ($Type != '') {
                $list_sql.="AND ExamForm.Type='$Type' ";
                 }
                 if ($Semester != '') {
                $list_sql.=" AND  ExamForm.SemesterID='$Semester' ";
                 }
                 if ($Examination != '') {
                 $list_sql.=" AND ExamForm.Examination='$Examination' ";
                 }
                if ($Status != '') {
                if ($Status== '5') {
                 $list_sql.=" AND (ExamForm.Status>='5' and  ExamForm.Status!='6') ";
                 }
                 else{
                    $list_sql.=" AND ExamForm.Status='$Status' ";
                 }
                }
                 if ($Status=='') 
                 {
                $list_sql.=" AND (ExamForm.Status='4' or ExamForm.Status='5' or ExamForm.Status='6') ";
                 }
                 if ($Examination == '') {
                    $list_sql .= " AND ExamForm.Examination = '$CurrentExamination'";
                }
                $list_sql.="  ORDER BY ExamForm.Status   ASC"; 
             
                                    $list_result = sqlsrv_query($conntest,$list_sql);
                                    while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                                       {
                                       // $aa=$row;
                                    $IDNo=$row['IDNo'];
                                    $CollegeName=$row['CollegeName'];
                                    $Course=$row['Course'];
                                    $StudentName=$row['StudentName'];
                                    $Gender=$row['Sex'];
                                    $Category=$row['Category'];
                                    $ClassRollNo=$row['ClassRollNo'];
                                    $UniRollno=$row['UniRollNo'];
                                    $FatherName=$row['FatherName'];
                                    $MotherName=$row['MotherName'];
                                    $EmailID=$row['EmailID'];
                                    $StudentMobileNo=$row['StudentMobileNo'];
                                    
                                    $Status=$row['ExamStatus'];
                                   
if($Status==-1)
             {
               $StatusShow="<b>Pending</b>";

             }
              if($Status==22)
             {
               $StatusShow="<b>Rejected By Registration Branch</b>";

             }
             elseif($Status==0)
             {
               $StatusShow="<b>Forward to Department</b>";
             }elseif($Status==1)
             {
               $StatusShow='<b>Forward to Dean</b>';
             }

             elseif($Status==2)
             {
               $StatusShow="<b style='color:red'>Rejected By Department</b>";
             }
              elseif($Status==3)
             {
               $StatusShow="<b style='color:red'>Rejected By Dean</b>";
             }

elseif($Status==4)
             {
               $StatusShow='<b>Pending</b>';
             }
elseif($Status==5)
             {
               $StatusShow='<b>Forward to Examination Branch</b>';
             }

elseif($Status==6)
             {
               $StatusShow="<b style='color:red'>Rejected By Accountant</b>";
             }
   elseif($Status==7)
             {
               $StatusShow="<b style='color:red'>Rejected_By Examination Branch</b>";
             }           

elseif($Status==8)
             {
               $StatusShow="<b style='color:green'>Accepted</b>";
             }  
                                       


                                       $exportstudy.=" <tr >
                                       <td>{$IDNo}</td>
                                       <td>{$CollegeName}</td>
                                       <td>{$Course}</td>
                                       <td>{$StudentName}</td>
                                       <td>{$Gender}</td>
                                       <td>{$Category}</td>
                                       <td>{$ClassRollNo}</td>
                                       <td>{$UniRollno}</td>
                                       <td>{$FatherName}</td>
                                       <td>{$MotherName}</td>
                                       <td>{$EmailID}</td>
                                       <td>{$StudentMobileNo}</td>
                                       <td>{$StatusShow}</td>
                                       </tr>";
          }

                    $exportstudy.="</table>";
                    echo $exportstudy;
                    $fileName=" Students Exam Form ";
                     } 
                     else if($exportCode==49)
                     {
                        $CourseID = isset($_GET['CourseID']) ? $_GET['CourseID'] : '';
                         $Examination = isset($_GET['Examination']) ? $_GET['Examination'] : '';
                         $Batch = isset($_GET['Batch']) ? $_GET['Batch'] : '';
                         $Sem = isset($_GET['Sem']) ? $_GET['Sem'] : '';
                            $SrNo=1;
                            $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
                            <thead>  
                            <tr>
                            ";
                            $SrNo=1;
                            $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
                            <thead>  
                            <tr>
                            ";
                            $exportstudy.="<th style='background-color:black; color:white;'>IDNo</th>
                                <th style='background-color:black; color:white;'>College Name</th>
                                <th style='background-color:black; color:white;'>Course</th>
                                <th style='background-color:black; color:white;'>Batch</th>
                                <th style='background-color:black; color:white;'>Semester</th>
                                <th style='background-color:black; color:white;'>Student Name</th>
                                <th style='background-color:black; color:white;'>Gender</th>
                                <th style='background-color:black; color:white;'>Category</th>
                                <th style='background-color:black; color:white;'>Class Roll No</th>
                                <th style='background-color:black; color:white;'>UniRollno</th>
                                <th style='background-color:black; color:white;'>Father Name</th>
                                <th style='background-color:black; color:white;'>Mother Name</th>
                                <th style='background-color:black; color:white;'>EmailID</th>
                                <th style='background-color:black; color:white;'>Student Mobile No</th>
                                <th style='background-color:black; color:white;'>Status</th>
                                ";
                                $exportstudy.="</tr></thead>";             
                                $list_sql = "SELECT   *,ExamForm.Status as ExamStatus,ExamForm.SemesterId
                                FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo 
                                where Admissions.Status='1' ";
                                 if ($CourseID != '') 
                                 {
                                $list_sql.=" AND ExamForm.CourseID='$CourseID' ";
                                 }
                                 if ($Batch != '') 
                                 {
                                $list_sql.=" AND ExamForm.Batch='$Batch' ";
                                 }
                                 if ($Sem != '') 
                                 {
                                $list_sql.=" AND ExamForm.SemesterId='$Sem' ";
                                 }
                               
                                 if ($Examination != '') {
                                 $list_sql.=" AND ExamForm.Examination='$Examination' ";
                                 }
                             
                                $list_sql.="  ORDER BY ExamForm.Status   ASC"; 
                             
                                                    $list_result = sqlsrv_query($conntest,$list_sql);
                                                    while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                                                       {  // $aa=$row;
                                                    $IDNo=$row['IDNo'];
                                                    $CollegeName=$row['CollegeName'];
                                                    $Course=$row['Course'];
                                                    $StudentName=$row['StudentName'];
                                                    $Gender=$row['Sex'];
                                                    $Category=$row['Category'];
                                                    $ClassRollNo=$row['ClassRollNo'];
                                                    $UniRollno=$row['UniRollNo'];
                                                    $FatherName=$row['FatherName'];
                                                    $MotherName=$row['MotherName'];
                                                    $EmailID=$row['EmailID'];
                                                    $StudentMobileNo=$row['StudentMobileNo'];
                                                    $Status=$row['ExamStatus'];
                                                    $Batch=$row['Batch'];
                                                    $SemesterId=$row['SemesterId'];
                                                   
                if($Status==-1)
                             {
                               $StatusShow="<b>Pending</b>";
                
                             }
                              if($Status==22)
                             {
                               $StatusShow="<b>Rejected By Registration Branch</b>";
                
                             }
                             elseif($Status==0)
                             {
                               $StatusShow="<b>Forward to Department</b>";
                             }elseif($Status==1)
                             {
                               $StatusShow='<b>Forward to Dean</b>';
                             }
                
                             elseif($Status==2)
                             {
                               $StatusShow="<b style='color:red'>Rejected By Department</b>";
                             }
                              elseif($Status==3)
                             {
                               $StatusShow="<b style='color:red'>Rejected By Dean</b>";
                             }
                
                elseif($Status==4)
                             {
                               $StatusShow='<b>Pending</b>';
                             }
                elseif($Status==5)
                             {
                               $StatusShow='<b>Forward to Examination Branch</b>';
                             }
                
                elseif($Status==6)
                             {
                               $StatusShow="<b style='color:red'>Rejected By Accountant</b>";
                             }
                   elseif($Status==7)
                             {
                               $StatusShow="<b style='color:red'>Rejected_By Examination Branch</b>";
                             }           
                
                elseif($Status==8)
                             {
                               $StatusShow="<b style='color:green'>Accepted</b>";
                             }  
                                                       
                
                
                                                       $exportstudy.=" <tr >
                                                       <td>{$IDNo}</td>
                                                       <td>{$CollegeName}</td>
                                                       <td>{$Course}</td>
                                                       <td>{$Batch}</td>
                                                       <td>{$SemesterId}</td>
                                                       <td>{$StudentName}</td>
                                                       <td>{$Gender}</td>
                                                       <td>{$Category}</td>
                                                       <td>{$ClassRollNo}</td>
                                                       <td>{$UniRollno}</td>
                                                       <td>{$FatherName}</td>
                                                       <td>{$MotherName}</td>
                                                       <td>{$EmailID}</td>
                                                       <td>{$StudentMobileNo}</td>
                                                       <td>{$StatusShow}</td>
                                                       </tr>";
                          }
                
                                    $exportstudy.="</table>";
                                    echo $exportstudy;
                                    $fileName=$Course." Students Exam Form ";
                                     } 
 else if($exportCode==50)
 {
   
        $SrNo=1;
        $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>  
        <tr>
        ";
        $SrNo=1;
        $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>  
        <tr>
        ";
        $exportstudy.="
            
            <th style='background-color:black; color:white;'>Course</th>
            <th style='background-color:black; color:white;'>Batch</th>
            <th style='background-color:black; color:white;'>Semester</th>
            <th style='background-color:black; color:white;'>Examination</th>
            <th style='background-color:black; color:white;'>Registration Branch</th>
            <th style='background-color:black; color:white;'>Department </th>
            <th style='background-color:black; color:white;'>Account Branch</th>
            <th style='background-color:black; color:white;'>Examination Branch</th>
            <th style='background-color:black; color:white;'>Accepted</th>
           
           
            ";
                   
                               
            $CollegeID=$_GET['CollegeID'];
            
            if($_GET['Examination']!='')
            {
                 $Examination=$_GET['Examination'];
            }else{
                $Examination=$CurrentExamination;
        
            }
            $getCourse="SELECT Distinct ExamForm.Batch,ExamForm.SemesterId,ExamForm.Examination,MasterCourseCodes.Course,ExamForm.CourseID FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID Where  ExamForm.CollegeID='$CollegeID' AND ExamForm.Examination='$Examination' order by ExamForm.Batch ASC ";
            $getCourseRun=sqlsrv_query($conntest,$getCourse);
            while($rowCourseName = sqlsrv_fetch_array($getCourseRun, SQLSRV_FETCH_ASSOC))
            { 
                $CourseID=$rowCourseName['CourseID'];
             $getToTotal="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."'  and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."' ";
            $getToTotal_run=sqlsrv_query($conntest,$getToTotal,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $Total=sqlsrv_num_rows($getToTotal_run);
            
             $getActiveTotal="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and ExamForm.Status='-1' and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."' ";
            $getActiveTotal_run=sqlsrv_query($conntest,$getActiveTotal,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $Registration=sqlsrv_num_rows($getActiveTotal_run);
            
            $getRegReject="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and ExamForm.Status='22' and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."' ";
            $getRegReject_run=sqlsrv_query($conntest,$getRegReject,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $RegistrationReject=sqlsrv_num_rows($getRegReject_run);
            $getRegForward="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and ExamForm.Status='5'  and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."' ";
            $getRegForward_run=sqlsrv_query($conntest,$getRegForward,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $RegistrationForward=sqlsrv_num_rows($getRegForward_run);
           
             $getdpPending="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and (ExamForm.Status='0' or ExamForm.Status='1') and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."' ";
            $getdpPending_run=sqlsrv_query($conntest,$getdpPending,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $Department=sqlsrv_num_rows($getdpPending_run);
            $getDpReject="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and (ExamForm.Status='2' or ExamForm.Status='3')  and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."' ";
            $getDpReject_run=sqlsrv_query($conntest,$getDpReject,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $DepartmentReject=sqlsrv_num_rows($getDpReject_run);
            $getDpForward="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and ExamForm.Status='4'  and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."'";
            $getDpForward_run=sqlsrv_query($conntest,$getDpForward,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $DepartmentForward=sqlsrv_num_rows($getDpForward_run);
           
            $getACPending="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."'  and ExamForm.Status='4' and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."'";
            $getACPending_run=sqlsrv_query($conntest,$getACPending,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $Account=sqlsrv_num_rows($getACPending_run);
            $getACReject="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."'  and ExamForm.Status='6' and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."'";
            $getACReject_run=sqlsrv_query($conntest,$getACReject,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $AccountReject=sqlsrv_num_rows($getACReject_run);
            $getACForward="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."'  and ExamForm.Status='5' and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."'";
            $getACForward_run=sqlsrv_query($conntest,$getACForward,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $AccountForward=sqlsrv_num_rows($getACForward_run);
        
            $getExamPending="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and ExamForm.Status='5' and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."'";
            $getExamPending_run=sqlsrv_query($conntest,$getExamPending,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $Examination1=sqlsrv_num_rows($getExamPending_run);
        
            $getExamReject="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and ExamForm.Status='7' and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."'";
            $getExamReject_run=sqlsrv_query($conntest,$getExamReject,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $ExaminationReject=sqlsrv_num_rows($getExamReject_run);
            $getExamForward="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and ExamForm.Status='8' and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."'";
            $getExamForward_run=sqlsrv_query($conntest,$getExamForward,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $ExaminationForward=sqlsrv_num_rows($getExamForward_run);
        
            $getleftTotal="SELECT Distinct IDNo FROM MasterCourseCodes Inner Join ExamForm ON MasterCourseCodes.CourseID=ExamForm.CourseID WHERE ExamForm.SemesterId='".$rowCourseName['SemesterId']."' and  ExamForm.Batch='".$rowCourseName['Batch']."' and ExamForm.Status='8'  and ExamForm.CourseID='$CourseID' and  ExamForm.Examination='".$rowCourseName['Examination']."'";
            $getleftTotal_run=sqlsrv_query($conntest,$getleftTotal,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
            $Accepeted=sqlsrv_num_rows($getleftTotal_run);

            $Course=$rowCourseName['Course'];
            $Bstch=$rowCourseName['Batch'];
            $sem=$rowCourseName['SemesterId'];
            $RE='<b style="color:blue;">'.$Registration.'</b>/<b style="color:red;">'.$RegistrationReject.'</b>';
            $dep='<b style="color:blue;">'.$Department.'</b>/<b style="color:red;">'.$DepartmentReject.'</b>';
            $AC='<b style="color:blue;">'.$Account.'</b>/<b style="color:red;">'.$AccountReject.'</b>';
            $EE='<b style="color:blue;">'.$Examination1.'</b>/<b style="color:red;">'.$ExaminationReject.'</b>';
            $Accepeted1='<b style="color:green;">'.$Accepeted.'</b>';
             

                                   $exportstudy.=" <tr >
                                   <td>{$Course}</td>
                                   <td>{$Bstch}</td>
                                   <td>{$sem}</td>
                                   <td>{$Examination}</td>
                                   <td>{$RE}</td>
                                   <td>{$dep}</td>
                                   <td>{$AC}</td>
                                   <td>{$EE}</td>
                                   <td>{$Accepeted1}</td>
                                   </tr>";
      }

                $exportstudy.="</table>";
                echo $exportstudy;
                $fileName=" Students Exam Form ";
                 } 

 else if($exportCode==51)
 {
    
    
 $Session=$_GET['Session'];
 $Status=$_GET['Status'];
 
 $SrNo=1;

 


 

 $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
         <thead>  
         <tr>
        ";
 
  $exportstudy.="
     <th>SrNo</th>
     <th>ClassRoll No </th>
     <th>UniRoll No</th>
     <th>Name </th>
     <th>College </th>
     <th>Course  </th>
     <th>Batch  </th>
     <th>Submit Date </th>
     <th>IT Verify Date </th>";
     if($Status=='4')
     {
        $exportstudy.=" <th>Account Reject Date </th>";

     }
     elseif($Status==5){
        $exportstudy.="   <th>Account Verify Date </th>";
        $exportstudy.="<th>Print Date </th>";
     }
     else{
        

     }
     

   $exportstudy.="</tr>  
         </thead>"; 
 
 
 
 if($Status!='5')
 {
    $list_sql="SELECT *,TBM_BusStopageMaster.Spot as SpotName FROM StudentBusPassGKU left join Admissions ON Admissions.IDNo=StudentBusPassGKU.IDNo inner join TBM_BusRootMaster
    ON TBM_BusRootMaster.BusRouteID=StudentBusPassGKU.route_id  inner join TBM_BusStopageMaster ON TBM_BusStopageMaster.StopageID=StudentBusPassGKU.spot_id
     where StudentBusPassGKU.p_status='$Status' and StudentBusPassGKU.session='$Session' order by StudentBusPassGKU.SerialNo ASC  ";
 }
 else
 {
    $list_sql="SELECT *,TBM_BusStopageMaster.Spot as SpotName FROM StudentBusPassGKU left join Admissions ON Admissions.IDNo=StudentBusPassGKU.IDNo inner join TBM_BusRootMaster
    ON TBM_BusRootMaster.BusRouteID=StudentBusPassGKU.route_id  inner join TBM_BusStopageMaster ON TBM_BusStopageMaster.StopageID=StudentBusPassGKU.spot_id
     where StudentBusPassGKU.p_status>='$Status' and StudentBusPassGKU.session='$Session' order by StudentBusPassGKU.SerialNo ASC  ";
 }
        
 $j=0;


         $list_result = sqlsrv_query($conntest,$list_sql);
             $count = 1;
         while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
            {
            // print_r($row);
         $IDNos=$row['IDNo'];
         $UnirollNos=$row['UniRollNo'];
         $ClassRollNos=$row['ClassRollNo'];
          $StudentNames =$row['StudentName'];     
          $College =$row['CollegeID'];     
          $Course =$row['CourseID'];     
          $Batch =$row['Batch'];     
           
          if($row['acverify_date']!=''){$acverify_date=$row['acverify_date']->format('d-m-Y H:i:s');}else{$acverify_date="";} 
          if($row['receipt_date']!=''){ $FormSubmitDate=$row['receipt_date']->format('d-m-Y H:i:s'); }else {$FormSubmitDate="";}
         if($row['print_date']!=''){$print_date=$row['print_date']->format('d-m-Y H:i:s');}else{$print_date="";}
         if($row['SubmitDate']!=''){$SubmitDate=$row['SubmitDate']->format('d-m-Y H:i:s');}else{$SubmitDate="";}
         if($row['itverifydate']!=''){$itverifydate=$row['itverifydate']->format('d-m-Y H:i:s');}else{$itverifydate="";}
         if($row['acrejectdate']!=''){$acrejectdate=$row['acrejectdate']->format('d-m-Y H:i:s');}else{$acrejectdate="";}   
          $collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
          $list_cllegename = sqlsrv_query($conntest,$collegename);
            
                        
          if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
             {
          
             // print_r($row);
          $CollegeName=$row_college['CollegeName'] ;
          $CourseName=$row_college['Course'] ;
          
                  }
       $exportstudy.="<tr>
          <td>{$SrNo}</td>
          <td>{$ClassRollNos}</th>
          <th>{$UnirollNos}</td>
          <td>{$StudentNames}</td>
          <td>{$CollegeName}</td>
          <td>{$CourseName}</td>
          <td>{$Batch}</td>
          <td>{$FormSubmitDate}</td>
          <td>{$itverifydate}</td>";
          if($Status=='4')
          {
            $exportstudy.="<td>{$acrejectdate}</td>";
     
          }
          elseif($Status==5){
            $exportstudy.="<td>{$acverify_date}</td>";
            $exportstudy.="<td>{$print_date}</td>";
          }
          else{
             
     
          }
         
          

           $exportstudy.="</tr>";
            $SrNo++; 
         }
 
 
   
         $exportstudy.="</table>";
         echo $exportstudy;
         $fileName="Bus Pass";
     }

                                           


 else if($exportCode==52)
{
    $College=$_GET['CollegeId'];
$Course=$_GET['Course'];
$Batch=$_GET['Batch'];
$Semester=$_GET['Semester'];
$Type=$_GET['Type'];
$Group=$_GET['Group'];
$Examination=$_GET['Examination'];
$nccount=0;
$SrNo=1;
$Subjectsp=array();
$SubjectNamesp=array();
$SubjectTypesp=array();
$Subjects=array();
$SubjectNames=array();
$SubjectTypes=array();
$SubjectsNew=array();
$SubjectNamesNew=array();
$SubjectTypesNew=array();





$collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
$list_cllegename = sqlsrv_query($conntest,$collegename);
                  
              
                if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $CollegeName=$row_college['CollegeName'] ;
                $CourseName=$row_college['Course'] ;
                
        }


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' ANd (SubjectType like '%T%' OR SubjectType='M' OR SubjectType='S') order by SubjectType";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjects[]=$row_subject['SubjectCode'] ;
               $SubjectNames[]=$row_subject['SubjectName'] ;
               $SubjectTypes[]=$row_subject['SubjectType'] ;
}
$subCountc=count($Subjects);

$sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='O' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";

$sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {

                $SubjectsNew[]=$row_subject['SubjectCode'] ;
                $SubjectNamesNew[]=$row_subject['SubjectName'] ;
                $SubjectTypesNew[]=$row_subject['SubjectType'] ;
}
$subCounto=count($SubjectsNew);


$Subjects=array_merge($Subjects,$SubjectsNew);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesNew);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesNew);


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' AND SubjectType='P' order by SubjectType ";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjectsp[]=$row_subject['SubjectCode'] ;
               $SubjectNamesp[]=$row_subject['SubjectName'] ;
               $SubjectTypesp[]=$row_subject['SubjectType'] ;
}
$subCountp=count($Subjectsp);

$Subjects=array_merge($Subjects,$Subjectsp);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesp);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesp);

$subCount=(count($Subjects)*4)+7;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>  
        <tr>
       ";

 $exportstudy.="<th colspan='".$subCount."' ><b style='font-size:22px;'>".$CollegeName."</b></th>         
    </tr><tr>";
    $exportstudy.="<th colspan='".$subCount."' > Batch :<b style='text-align:left;'>".$Batch."</b> <b style='text-align:center;'>  Course:".$CourseName."</b><b style='text-align:right;'>   Semester:".$Semester."</b></th>        
    </tr>
    <tr>";
    $exportstudy.="<th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th>         
    </tr>
    <tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=4>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}

$exportstudy.="<th colspan=3>Grade Detail
    
  </th></tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
     $gtcerdit=0;
    foreach ($Subjects as $key => $SubjectsCode) {

   $amrikc = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCode' ANd Batch='$Batch' ANd SemesterID='$Semester' "; 


$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        $gtcerdit=$gtcerdit+$credit;
         $exportstudy.="<th colspan=4>Credit : {$credit}</th>";
            }
   
}


  $exportstudy.="<th colspan=3>Total Credit :{$gtcerdit}
    
  </th></tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>Marks</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
}
       $exportstudy.="<th>Total Credit</th><th>SGPA</th><th>Fail Subjects</th></tr> </thead>"; 




    $list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo
    FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";
        
        
                $j=0;
               
               
                        $list_result = sqlsrv_query($conntest,$list_sql);
                            $count = 1;
                      if($list_result === false)
                        {
                       die( print_r( sqlsrv_errors(), true) );
                       }
                        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                           {
                           // print_r($row);
                        $IDNos=$row['IDNo'];
                        $UnirollNos=$row['UniRollNo'];
                        $ClassRollNos=$row['ClassRollNo'];
                         $Examid=$row['ID'];
                         $StudentNames =$row['StudentName'];     
     
      $exportstudy.="<tr>
         <td>{$SrNo}</td>
         <td>{$ClassRollNos}</th>
         <th>{$UnirollNos}</td>
         <td>{$StudentNames}</td>";

$totalcredit=0;
$gradevaluetotal=0;
$nccount=0;


         for($sub=0;$sub<$subCountc;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjects[$sub]' AND ExternalExam='Y'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                              
                                     $CE1=$row_exam['CE1'];
                                     $CE3=$row_exam['CE3'];
                                     $att=$row_exam['Attendance'];        
                                     $mst1=$row_exam['MST1']; 
                                     $mst2= $row_exam['MST2']; 
                                     $ESe= $row_exam['ESE'];
                                    


include'grade_calculator.php';
                               



$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";
$exportstudy.="<td style='text-align:center;'>{$grade} </td>"; 
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
 $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
       $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
    if(is_numeric($gardep)){$gardep=$gardep;}else{$gardep=0;}
 $gradevalue=$gardep*$credit;

 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
}     

else
{
$exportstudy.="<td style='text-align:center;'>NA </td>";
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
$exportstudy.="<td style='text-align:center;'>NA</td>";
 $exportstudy.="<td style='text-align:center;'>NA</td>"; 

}


}
 for($sub=0;$sub<$subCounto;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNew[$sub]'  AND ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                              
                                     $CE1=$row_exam['CE1'];
                                     $CE3=$row_exam['CE3'];
                                     $att=$row_exam['Attendance'];        
                                     $mst1=$row_exam['MST1']; 
                                     $mst2= $row_exam['MST2']; 
                                     $ESe= $row_exam['ESE'];
                                     

include'grade_calculator.php';


$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";
$exportstudy.="<td style='text-align:center;'>{$grade} </td>"; 
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";

 $amrikc = "SELECT * FROM MasterCourseStructure where  Batch='$Batch' ANd SubjectCode='$SubjectsNew[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
}  
else
{
$exportstudy.="<td style='text-align:center;'>NA </td>";
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
$exportstudy.="<td style='text-align:center;'>NA </td>";
 $exportstudy.="<td style='text-align:center;'>NA </td>"; 
  

}


}



  for($sub=0;$sub<$subCountp;$sub++)
        {
            $pmarks=0;
        $practivcal="SELECT * from MasterPracticals inner join PracticalMarks on MasterPracticals.id=PracticalMarks.PID  where CollegeId='$College' ANd CourseId='$Course' ANd Batch='$Batch' AND SubCode='$Subjectsp[$sub]' ANd Session='$Examination' AND IDNO='$IDNos'"; 
$list_resultamrikpr = sqlsrv_query($conntest,$practivcal);  
$pmarks=0;
$pcount=0;
while($row7pr = sqlsrv_fetch_array($list_resultamrikpr, SQLSRV_FETCH_ASSOC) )
         {


if(is_numeric($row7pr['PMarks'])){$p=$row7pr['PMarks'];}else{$p=0;}
if(is_numeric($row7pr['VMarks'])){$v=$row7pr['VMarks'];}else{$v=0;}
if(is_numeric($row7pr['FMarks'])){$f=$row7pr['FMarks'];}else{$f=0;}
$pmarks=$pmarks+$p+$v+$f;

$pcount++;
          } 

       if($pcount>5) 
       {
         $pmarks=round((($pmarks/$pcount)*5));
       }   
       else
       {
        $pmarks=$pmarks;
       }



include'grade_calculator_practical.php';



                     $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;


                           
                           $exportstudy.="<td style='text-align:center;'>{$pmarks}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
                           if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  
                   
          }


 $exportstudy.="<td style='text-align:center;'>{$totalcredit} </td>"; 

 $sgpa=$gradevaluetotal/$totalcredit;
    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<td style='text-align:center;'>NC </td>";

}
else
 { $exportstudy.="<td style='text-align:center;'>{$sgpa} </td>";}  

$exportstudy.="<td style='text-align:center;'>{$nccount} </td>";

          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 
                                                     

else if($exportCode==53)
{
    $College=$_GET['CollegeId'];
$Course=$_GET['Course'];
$Batch=$_GET['Batch'];
$Semester=$_GET['Semester'];
$Type=$_GET['Type'];
$Group=$_GET['Group'];
$Examination=$_GET['Examination'];
$nccount=0;
$SrNo=1;
$Subjectsp=array();
$SubjectNamesp=array();
$SubjectTypesp=array();
$Subjects=array();
$SubjectNames=array();
$SubjectTypes=array();
$SubjectsNew=array();
$SubjectNamesNew=array();
$SubjectTypesNew=array();





$collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
$list_cllegename = sqlsrv_query($conntest,$collegename);
                  
              
                if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $CollegeName=$row_college['CollegeName'] ;
                $CourseName=$row_college['Course'] ;
                
        }


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' ANd (SubjectType like '%T%' OR SubjectType='M' OR SubjectType='S') order by SubjectType";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjects[]=$row_subject['SubjectCode'] ;
               $SubjectNames[]=$row_subject['SubjectName'] ;
               $SubjectTypes[]=$row_subject['SubjectType'] ;
}
$subCountc=count($Subjects);

$sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='O' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";

$sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {

                $SubjectsNew[]=$row_subject['SubjectCode'] ;
                $SubjectNamesNew[]=$row_subject['SubjectName'] ;
                $SubjectTypesNew[]=$row_subject['SubjectType'] ;
}
$subCounto=count($SubjectsNew);


$Subjects=array_merge($Subjects,$SubjectsNew);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesNew);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesNew);


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' AND SubjectType='P' order by SubjectType ";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjectsp[]=$row_subject['SubjectCode'] ;
               $SubjectNamesp[]=$row_subject['SubjectName'] ;
               $SubjectTypesp[]=$row_subject['SubjectType'] ;
}
$subCountp=count($Subjectsp);

$Subjects=array_merge($Subjects,$Subjectsp);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesp);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesp);

$subCount=(count($Subjects)*2)+7;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>  
        <tr>
       ";

 $exportstudy.="<th colspan='".$subCount."' ><b style='font-size:22px;'>".$CollegeName."</b></th>         
    </tr><tr>";
    $exportstudy.="<th colspan='".$subCount."' > Batch :<b style='text-align:left;'>".$Batch."</b> <b style='text-align:center;'>  Course:".$CourseName."</b><b style='text-align:right;'>   Semester:".$Semester."</b></th>        
    </tr>
    <tr>";
    $exportstudy.="<th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th>         
    </tr>
    <tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=2>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}
$exportstudy.="<th colspan=3>Grade Detail
    
  </th></tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
     $gtcerdit=0;
    foreach ($Subjects as $key => $SubjectsCode) {

  

       $amrikc = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCode' ANd Batch='$Batch' AND SemesterID='$Semester' "; 
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        $gtcerdit=$gtcerdit+$credit;
         $exportstudy.="<th colspan=2>Credit : {$credit}</th>";
            }
   
}


  $exportstudy.="<th colspan=3>Total Credit :{$gtcerdit}
    
  </th></tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>Grade</th><th>Grade Point</th>";
}
       $exportstudy.="<th>Total Credit</th><th>SGPA</th><th>Fail Subjects</th></tr> </thead>"; 




    $list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo
    FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";
        
        
                $j=0;
               
               
                        $list_result = sqlsrv_query($conntest,$list_sql);
                            $count = 1;
                      if($list_result === false)
                        {
                       die( print_r( sqlsrv_errors(), true) );
                       }
                        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                           {
                           // print_r($row);
                        $IDNos=$row['IDNo'];
                        $UnirollNos=$row['UniRollNo'];
                        $ClassRollNos=$row['ClassRollNo'];
                         $Examid=$row['ID'];
                         $StudentNames =$row['StudentName'];     
     
      $exportstudy.="<tr>
         <td>{$SrNo}</td>
         <td>{$ClassRollNos}</th>
         <th>{$UnirollNos}</td>
         <td>{$StudentNames}</td>";

$totalcredit=0;
$gradevaluetotal=0;
$nccount=0;
         for($sub=0;$sub<$subCountc;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjects[$sub]' ANd ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                              
                                     $CE1=$row_exam['CE1'];
                                     $CE3=$row_exam['CE3'];
                                     $att=$row_exam['Attendance'];        
                                     $mst1=$row_exam['MST1']; 
                                     $mst2= $row_exam['MST2']; 
                                     $ESe= $row_exam['ESE'];
                                   

 include 'grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";

$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade}</td>"; 
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep} </td>";


  $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 //$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
    if(is_numeric($gardep)){$gardep=$gardep;}else{$gardep=0;}

 $gradevalue=$gardep*$credit;

 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}

} 
else
{
$exportstudy.="<td style='text-align:center'>NA</td>"; 
$exportstudy.="<td style='text-align:center'>NA</td>";
}



}


 for($sub=0;$sub<$subCounto;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNew[$sub]'  ANd ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                              
                                     $CE1=$row_exam['CE1'];
                                     $CE3=$row_exam['CE3'];
                                     $att=$row_exam['Attendance'];        
                                     $mst1=$row_exam['MST1']; 
                                     $mst2= $row_exam['MST2']; 
                                     $ESe= $row_exam['ESE'];
                                    

                                     include 'grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>"; 
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep}</td>";


 $amrikc = "SELECT * FROM MasterCourseStructure where  Batch='$Batch' ANd SubjectCode='$SubjectsNew[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];

            }

$totalcredit=$totalcredit+$credit;
 //$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
}   
else
{
$exportstudy.="<td style='text-align:center'>NA</td>"; 
$exportstudy.="<td style='text-align:center'>NA</td>";
}

}





  for($sub=0;$sub<$subCountp;$sub++)
        {
            $pmarks=0;
    $practivcal="SELECT * from MasterPracticals inner join PracticalMarks on MasterPracticals.id=PracticalMarks.PID  where CollegeId='$College' ANd CourseId='$Course' ANd Batch='$Batch' AND SubCode='$Subjectsp[$sub]' ANd Session='$Examination' AND IDNO='$IDNos'"; 
$list_resultamrikpr = sqlsrv_query($conntest,$practivcal);  
$pmarks=0;
$pcount=0;
while($row7pr = sqlsrv_fetch_array($list_resultamrikpr, SQLSRV_FETCH_ASSOC) )
         {


if(is_numeric($row7pr['PMarks'])){$p=$row7pr['PMarks'];}else{$p=0;}
if(is_numeric($row7pr['VMarks'])){$v=$row7pr['VMarks'];}else{$v=0;}
if(is_numeric($row7pr['FMarks'])){$f=$row7pr['FMarks'];}else{$f=0;}
$pmarks=$pmarks+$p+$v+$f;


$pcount++;
          }  

if($pcount>5)
{
    $pmarks=round((($pmarks/$pcount)*5));
}
else
{
   $pmarks=$pmarks; 
}

 include 'grade_calculator_practical.php';






                   $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;


                           
                           //$exportstudy.="<td style='text-align:center;'>{$pmarks} </td>"; 
                           $exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep} </td>";
if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
//$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  
                   
          }


 $exportstudy.="<td style='text-align:center'>{$totalcredit} </td>"; 

 $sgpa=$gradevaluetotal/$totalcredit;
    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<td style='text-align:center;color:{$color}'>NC</td>";

}
else
 { $exportstudy.="<td style='text-align:center'>{$sgpa} </td>";}  

$exportstudy.="<td style='text-align:center'>{$nccount} </td>";

          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 


            


 else if($exportCode==54)
{
    $College=$_GET['CollegeId'];
$Course=$_GET['Course'];
$Batch=$_GET['Batch'];
$Semester=$_GET['Semester'];
$Type=$_GET['Type'];
$Group=$_GET['Group'];
$Examination=$_GET['Examination'];
$nccount=0;
$SrNo=1;
$Subjectsp=array();
$SubjectNamesp=array();
$SubjectTypesp=array();
$Subjects=array();
$SubjectNames=array();
$SubjectTypes=array();
$SubjectsNew=array();
$SubjectNamesNew=array();
$SubjectTypesNew=array();





$collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
$list_cllegename = sqlsrv_query($conntest,$collegename);
                  
              
                if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $CollegeName=$row_college['CollegeName'] ;
                $CourseName=$row_college['Course'] ;
                
        }


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' ANd (SubjectType like '%T%' OR SubjectType='M' OR SubjectType='S') order by SubjectType";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjects[]=$row_subject['SubjectCode'] ;
               $SubjectNames[]=$row_subject['SubjectName'] ;
               $SubjectTypes[]=$row_subject['SubjectType'] ;
}
$subCountc=count($Subjects);

$sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='O' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";

$sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {

                $SubjectsNew[]=$row_subject['SubjectCode'] ;
                $SubjectNamesNew[]=$row_subject['SubjectName'] ;
                $SubjectTypesNew[]=$row_subject['SubjectType'] ;
}
$subCounto=count($SubjectsNew);


$Subjects=array_merge($Subjects,$SubjectsNew);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesNew);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesNew);


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' AND SubjectType='P' order by SubjectType ";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjectsp[]=$row_subject['SubjectCode'] ;
               $SubjectNamesp[]=$row_subject['SubjectName'] ;
               $SubjectTypesp[]=$row_subject['SubjectType'] ;
}
$subCountp=count($Subjectsp);

$Subjects=array_merge($Subjects,$Subjectsp);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesp);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesp);

$subCount=(count($Subjects)*5)+7;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>  
        <tr>
       ";

 $exportstudy.="<th colspan='".$subCount."' ><b style='font-size:22px;'>".$CollegeName."</b></th>         
    </tr><tr>";
    $exportstudy.="<th colspan='".$subCount."' > Batch :<b style='text-align:left;'>".$Batch."</b> <b style='text-align:center;'>  Course:".$CourseName."</b><b style='text-align:right;'>   Semester:".$Semester."</b></th>        
    </tr>
    <tr>";
    $exportstudy.="<th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th>         
    </tr>
    <tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=5>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}

$exportstudy.="<th colspan=3>Grade Detail
    
  </th></tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
     $gtcerdit=0;


    foreach ($Subjects as $key => $SubjectsCode) {

  $amrikc = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCode' ANd Batch='$Batch'AND SemesterID='$Semester' ";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        $gtcerdit=$gtcerdit+$credit;
         $exportstudy.="<th colspan=5>Credit : {$credit}</th>";
            }
   
}


  $exportstudy.="<th colspan=3>Total Credit :{$gtcerdit}
    
  </th></tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>CE1/CE3/Att/mst1/mst2/ese</th><th>Marks</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
}
       $exportstudy.="<th>Total Credit</th><th>SGPA</th></tr> </thead>"; 




    $list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo
    FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";
        
        
                $j=0;
               
               
                        $list_result = sqlsrv_query($conntest,$list_sql);
                            $count = 1;
                      if($list_result === false)
                        {
                       die( print_r( sqlsrv_errors(), true) );
                       }
                        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                           {
                           // print_r($row);
                        $IDNos=$row['IDNo'];
                        $UnirollNos=$row['UniRollNo'];
                        $ClassRollNos=$row['ClassRollNo'];
                         $Examid=$row['ID'];
                         $StudentNames =$row['StudentName'];     
     
      $exportstudy.="<tr>
         <td>{$SrNo}</td>
         <td>{$ClassRollNos}</th>
         <th>{$UnirollNos}</td>
         <td>{$StudentNames}</td>";

$totalcredit=0;
$gradevaluetotal=0;
$nccount=0;
         for($sub=0;$sub<$subCountc;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjects[$sub]' AND ExternalExam='Y'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                              
                                     $CE1=$row_exam['CE1'];
                                     $CE3=$row_exam['CE3'];
                                     $att=$row_exam['Attendance'];        
                                     $mst1=$row_exam['MST1']; 
                                     $mst2= $row_exam['MST2']; 
                                     $ESe= $row_exam['ESE'];
        include 'grade_calculator.php';                              

$exportstudy.="<td style='text-align:center;'>{$showmarks} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$totalFinal} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>"; 
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep} </td>";
 $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
       $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
    if(is_numeric($gardep)){$gardep=$gardep;}else{$gardep=0;}
 $gradevalue=$gardep*$credit;

 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
}     

else
{
$exportstudy.="<td style='text-align:center;'>NA </td>";
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
$exportstudy.="<td style='text-align:center;'>NA</td>";
 $exportstudy.="<td style='text-align:center;'>NA</td>"; 
 $exportstudy.="<td style='text-align:center;'>NA </td>"; 
}


}
 for($sub=0;$sub<$subCounto;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNew[$sub]'  AND ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                              
                                     $CE1=$row_exam['CE1'];
                                     $CE3=$row_exam['CE3'];
                                     $att=$row_exam['Attendance'];        
                                     $mst1=$row_exam['MST1']; 
                                     $mst2= $row_exam['MST2']; 
                                     $ESe= $row_exam['ESE'];
                                     
                                     include'grade_calculator.php';

$exportstudy.="<td style='text-align:center;'>{$showmarks} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$totalFinal} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>"; 
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep} </td>";

 $amrikc = "SELECT * FROM MasterCourseStructure where  Batch='$Batch' ANd SubjectCode='$SubjectsNew[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
else
{

}

}  
else
{
$exportstudy.="<td style='text-align:center;'>NA </td>";
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
$exportstudy.="<td style='text-align:center;'>NA </td>";
 $exportstudy.="<td style='text-align:center;'>NA </td>"; 
 $exportstudy.="<td style='text-align:center;'>NA </td>"; 
}


}



  for($sub=0;$sub<$subCountp;$sub++)
        {
            $pmarks=0;
        $practivcal="SELECT * from MasterPracticals inner join PracticalMarks on MasterPracticals.id=PracticalMarks.PID  where CollegeId='$College' ANd CourseId='$Course' ANd Batch='$Batch' AND SubCode='$Subjectsp[$sub]' ANd Session='$Examination' AND IDNO='$IDNos'"; 
$list_resultamrikpr = sqlsrv_query($conntest,$practivcal);  
$pmarks=0;
$pcount=0;
$pshow='';
$smarks='0';
while($row7pr = sqlsrv_fetch_array($list_resultamrikpr, SQLSRV_FETCH_ASSOC) )
         {


if(is_numeric($row7pr['PMarks'])){$p=$row7pr['PMarks'];}else{$p=0;}
if(is_numeric($row7pr['VMarks'])){$v=$row7pr['VMarks'];}else{$v=0;}
if(is_numeric($row7pr['FMarks'])){$f=$row7pr['FMarks'];}else{$f=0;}

$smarks=$p+$v+$f;
$pmarks=$pmarks+$p+$v+$f;
$pshow=$smarks.'/'.$pshow;

$pcount++;
          }  

if($pcount>5)
{
    $pmarks=round((($pmarks/$pcount)*5));
}
else
{
   $pmarks=$pmarks; 
}

include'grade_calculator_practical.php';

$amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;


                           
                            $exportstudy.="<td style='text-align:center;'>{$pshow}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$pmarks}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
                           if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  
                   
          }


 $exportstudy.="<td style='text-align:center;'>{$totalcredit} </td>"; 

 $sgpa=$gradevaluetotal/$totalcredit;

    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<td style='text-align:center;color:{$color}'>NC </td>";

}
else
 { $exportstudy.="<td style='text-align:center;'>{$sgpa} </td>";}  

$exportstudy.="<td style='text-align:center;'>{$nccount} </td>";

          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 

 else if($exportCode==55)
{
    $College=$_GET['CollegeId'];
$Course=$_GET['Course'];
$Batch=$_GET['Batch'];
$Semester=$_GET['Semester'];
$Type=$_GET['Type'];
$Group=$_GET['Group'];
$Examination=$_GET['Examination'];
$nccount=0;
$SrNo=1;
$Subjectsp=array();
$SubjectNamesp=array();
$SubjectTypesp=array();
$Subjects=array();
$SubjectNames=array();
$SubjectTypes=array();
$SubjectsNew=array();
$SubjectNamesNew=array();
$SubjectTypesNew=array();





$collegename="select CollegeName,Course from MasterCOurseCodes where  CollegeID='$College' ANd CourseID='$Course' ";
$list_cllegename = sqlsrv_query($conntest,$collegename);
                  
              
                if( $row_college= sqlsrv_fetch_array($list_cllegename, SQLSRV_FETCH_ASSOC) )
                   {

                   // print_r($row);
                $CollegeName=$row_college['CollegeName'] ;
                $CourseName=$row_college['Course'] ;
                
        }


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' ANd (SubjectType like '%T%' OR SubjectType='M' OR SubjectType='S') order by SubjectType";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjects[]=$row_subject['SubjectCode'] ;
               $SubjectNames[]=$row_subject['SubjectName'] ;
               $SubjectTypes[]=$row_subject['SubjectType'] ;
}
$subCountc=count($Subjects);

$sql_open="SELECT Distinct SubjectCode,SubjectName,SubjectType from ExamFormSubject where Batch='$Batch'ANd CollegeName='$CollegeName'  ANd Course='$CourseName'ANd SubjectType='O' ANd ExternalExam='Y' ANd SubjectCode>'100' ANd SemesterID='$Semester'";

$sql_openq = sqlsrv_query($conntest,$sql_open);
         
                if($row_subject= sqlsrv_fetch_array($sql_openq, SQLSRV_FETCH_ASSOC) )
                   {

                $SubjectsNew[]=$row_subject['SubjectCode'] ;
                $SubjectNamesNew[]=$row_subject['SubjectName'] ;
                $SubjectTypesNew[]=$row_subject['SubjectType'] ;
}
$subCounto=count($SubjectsNew);


$Subjects=array_merge($Subjects,$SubjectsNew);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesNew);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesNew);


$subjects_sql="SELECT SubjectCode,SubjectName,SubjectType from MasterCourseStructure where CollegeID='$College' ANd CourseID='$Course'ANd
 Batch='$Batch' AND SemesterID='$Semester' ANd Isverified='1' AND SubjectType='P' order by SubjectType ";
$list_Subjects = sqlsrv_query($conntest,$subjects_sql);
                 
             if($list_Subjects === false)
               {
              die( print_r( sqlsrv_errors(), true) );
              }
               while( $row_subject= sqlsrv_fetch_array($list_Subjects, SQLSRV_FETCH_ASSOC) )
                  {

                  // print_r($row);
               $Subjectsp[]=$row_subject['SubjectCode'] ;
               $SubjectNamesp[]=$row_subject['SubjectName'] ;
               $SubjectTypesp[]=$row_subject['SubjectType'] ;
}
$subCountp=count($Subjectsp);

$Subjects=array_merge($Subjects,$Subjectsp);
$SubjectNames=array_merge($SubjectNames,$SubjectNamesp);
$SubjectTypes=array_merge($SubjectTypes,$SubjectTypesp);

$subCount=(count($Subjects)*5)+4;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>  
        <tr>
       ";

 $exportstudy.="<th colspan='".$subCount."' ><b style='font-size:22px;'>".$CollegeName."</b></th>         
    </tr><tr>";
    $exportstudy.="<th colspan='".$subCount."' > Batch :<b style='text-align:left;'>".$Batch."</b> <b style='text-align:center;'>  Course:".$CourseName."</b><b style='text-align:right;'>   Semester:".$Semester."</b></th>        
    </tr>
    <tr>";
    $exportstudy.="<th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th>         
    </tr>
    <tr>
    <th>SrNo</th>
  
    <th>UniRoll No</th>
  
   ";

     $gtcerdit=0;


    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>Subject Name</th><th>Subject Code</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
}
       $exportstudy.="<th>Total Credit</th><th>SGPA</th></tr> </thead>"; 




    $list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo
    FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination' ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo ";
        
        
                $j=0;
               
               
                        $list_result = sqlsrv_query($conntest,$list_sql);
                            $count = 1;
                      if($list_result === false)
                        {
                       die( print_r( sqlsrv_errors(), true) );
                       }
                        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                           {
                           // print_r($row);
                        $IDNos=$row['IDNo'];
                        $UnirollNos=$row['UniRollNo'];
                        $ClassRollNos=$row['ClassRollNo'];
                         $Examid=$row['ID'];
                         $StudentNames =$row['StudentName'];     
     
      $exportstudy.="<tr>
         <td>{$SrNo}</td>
         <th>{$UnirollNos}</td>
         ";

$totalcredit=0;
$gradevaluetotal=0;
$nccount=0;
         for($sub=0;$sub<$subCountc;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjects[$sub]' AND ExternalExam='Y'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                              
                                     $CE1=$row_exam['CE1'];
                                      $subjectName=$row_exam['SubjectName'];
                                      $SubjectCode=$row_exam['SubjectCode'];
                                     $CE3=$row_exam['CE3'];
                                     $att=$row_exam['Attendance'];        
                                     $mst1=$row_exam['MST1']; 
                                     $mst2= $row_exam['MST2']; 
                                     $ESe= $row_exam['ESE'];
                                   


include'grade_calculator.php';

$exportstudy.="<td style='text-align:center;color:{$color}'>{$subjectName} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$SubjectCode} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep} </td>";
 $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
       $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
    if(is_numeric($gardep)){$gardep=$gardep;}else{$gardep=0;}
 $gradevalue=$gardep*$credit;

 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
}     

else
{
$exportstudy.="<td style='text-align:center;'>NA </td>";
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
$exportstudy.="<td style='text-align:center;'>NA</td>";
 $exportstudy.="<td style='text-align:center;'>NA</td>"; 
 $exportstudy.="<td style='text-align:center;'>NA </td>"; 
}


}
 for($sub=0;$sub<$subCounto;$sub++)
        {
        $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNew[$sub]'  AND ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                              
                                     $CE1=$row_exam['CE1'];
                                     $CE3=$row_exam['CE3'];
                                      $subjectName=$row_exam['SubjectName'];
                                      $SubjectCode=$row_exam['SubjectCode'];
                                     $att=$row_exam['Attendance'];        
                                     $mst1=$row_exam['MST1']; 
                                     $mst2= $row_exam['MST2']; 
                                     $ESe= $row_exam['ESE'];
                                    

include'grade_calculator.php';


$exportstudy.="<td style='text-align:center;color:{$color}'>{$subjectName} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$SubjectCode} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep} </td>";

 $amrikc = "SELECT * FROM MasterCourseStructure where  Batch='$Batch' ANd SubjectCode='$SubjectsNew[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
else
{




}

}  
else
{
$exportstudy.="<td style='text-align:center;'>NA </td>";
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
$exportstudy.="<td style='text-align:center;'>NA </td>";
 $exportstudy.="<td style='text-align:center;'>NA </td>"; 
 $exportstudy.="<td style='text-align:center;'>NA </td>"; 
}


}



  for($sub=0;$sub<$subCountp;$sub++)
        {
            $pmarks=0;
        $practivcal="SELECT * from MasterPracticals inner join PracticalMarks on MasterPracticals.id=PracticalMarks.PID  where CollegeId='$College' ANd CourseId='$Course' ANd Batch='$Batch' AND SubCode='$Subjectsp[$sub]' ANd Session='$Examination' AND IDNO='$IDNos'"; 
$list_resultamrikpr = sqlsrv_query($conntest,$practivcal);  
$pmarks=0;
$pcount=0;
$pshow='';
$smarks='0';
while($row7pr = sqlsrv_fetch_array($list_resultamrikpr, SQLSRV_FETCH_ASSOC) )
         {


if(is_numeric($row7pr['PMarks'])){$p=$row7pr['PMarks'];}else{$p=0;}
if(is_numeric($row7pr['VMarks'])){$v=$row7pr['VMarks'];}else{$v=0;}
if(is_numeric($row7pr['FMarks'])){$f=$row7pr['FMarks'];}else{$f=0;}

$smarks=$p+$v+$f;
$pmarks=$pmarks+$p+$v+$f;
$pshow=$smarks.'/'.$pshow;

$pcount++;
          }  

if($pcount>5)
{
    $pmarks=round((($pmarks/$pcount)*5));
}
else
{
   $pmarks=$pmarks; 
}
 include'grade_calculator_practical.php';

$amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $SubjectCode=$row7c['SubjectCode'];
             $SubjectName=$row7c['SubjectName'];
             $credit=$row7c['NoOFCredits'];


            }

$totalcredit=$totalcredit+$credit;


                           
                            $exportstudy.="<td style='text-align:center;'>{$SubjectName}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$SubjectCode}</td>"; 
                           $exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
                           if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    $nccount++;
 }
}
$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  
                   
          }


 $exportstudy.="<td style='text-align:center;'>{$totalcredit} </td>"; 

 $sgpa=$gradevaluetotal/$totalcredit;
    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<td style='text-align:center;color:{$color}'>NC </td>";

}
else
 { $exportstudy.="<td style='text-align:center;'>{$sgpa} </td>";}  



          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 
     

















header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
unset($_SESSION['filterQry']);
ob_end_flush();