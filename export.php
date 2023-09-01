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

if($exportCode==19)
   {
       include "connection/connection_web.php"; 

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
         $sql="SELECT distinct article_no,Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block  order by building_master.Name desc, location_master.RoomNo asc";
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
    $District=$row['DistrictName'];     
     $exportMeter .= "
       <tr color='red'>           
          
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



header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
unset($_SESSION['filterQry']);
ob_end_flush();

