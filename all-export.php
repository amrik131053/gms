<?php
session_start();
ob_start();
header("Content-Type: application/xls");
header("Pragma: no-cache");
header("Expires: 0");
include 'connection/connection.php';

     $CategoryID = $_POST['CategoryID'];
     $ArticleCode = $_POST['ArticleName'];   
     $status = $_POST['status'];   
if ($status==2)
 {
     echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c left JOIN master_article a ON c.ID=a.CategoryCode  left JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT *,location_master.ID lid FROM stock_summary  left join location_master on stock_summary.LocationID=location_master.ID left join master_calegories on stock_summary.CategoryID=master_calegories.ID left join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.CategoryID='$CategoryID' and stock_summary.ArticleCode='$ArticleCode' and stock_summary.Status='2' order by IDNo DESC ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
  $lid = $building_row['lid'];


       echo  $location = "SELECT *, rm.RoomNo as abc FROM stock_summary ss left join master_calegories mc on ss.CategoryID=mc.ID left join master_article ma on ss.ArticleCode=ma.ArticleCode left join location_master lm on lm.ID=ss.LocationID left join room_master rm on rm.FloorID=lm.Floor left join building_master bm on bm.ID=lm.Block left join room_type_master rtm on rtm.ID=lm.Type left join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id' ANd ss.LocationID='$lid' ";

        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num.$location . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['RoomNo'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
    }
}
elseif ($status==3)
 {
    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c left JOIN master_article a ON c.ID=a.CategoryCode  left JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT * FROM stock_summary  left join location_master on stock_summary.LocationID=location_master.ID left join master_calegories on stock_summary.CategoryID=master_calegories.ID left join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.CategoryID='$CategoryID' and stock_summary.ArticleCode='$ArticleCode' and stock_summary.Status!='2' order by IDNo DESC  ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
        $location = "SELECT *, rm.RoomNo as abc FROM stock_summary ss left join master_calegories mc on ss.CategoryID=mc.ID left join master_article ma on ss.ArticleCode=ma.ArticleCode left join location_master lm on lm.ID=ss.LocationID left join room_master rm on rm.FloorID=lm.Floor left join building_master bm on bm.ID=lm.Block left join room_type_master rtm on rtm.ID=lm.Type left join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['RoomNo'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
}
}
else
{

    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c left JOIN master_article a ON c.ID=a.CategoryCode  left JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT * FROM stock_summary  left join location_master on stock_summary.LocationID=location_master.ID left join master_calegories on stock_summary.CategoryID=master_calegories.ID left join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.CategoryID='$CategoryID' and stock_summary.ArticleCode='$ArticleCode' order by IDNo DESC  ";
    $building_run = mysqli_query($conn, $building);
    while ($building_row = mysqli_fetch_array($building_run))
    {
        $building_num = $building_num + 1;
        $building_row['IDNo'];
        $building_row['ArticleName'];
        $building_row['name'] . '(' . $building_row['Corrent_owner'] . ')';
        $location_num = 0;
        $id = $building_row['IDNo'];
        $location = "SELECT *, rm.RoomNo as abc FROM stock_summary ss left join master_calegories mc on ss.CategoryID=mc.ID left join master_article ma on ss.ArticleCode=ma.ArticleCode left join location_master lm on lm.ID=ss.LocationID left join room_master rm on rm.FloorID=lm.Floor left join building_master bm on bm.ID=lm.Block left join room_type_master rtm on rtm.ID=lm.Type left join room_name_master rnm on rnm.ID=lm.RoomName left join user on ss.Corrent_owner=user.emp_id where ss.IDNo='$id'";
        $location_run = mysqli_query($conn, $location);
        if ($location_row = mysqli_fetch_array($location_run))
        {
            $location_num = $location_num + 1;
            echo $building_num . "\t" . $location_row['ArticleName'] . "\t" . $id . "\t" . $location_row['CPU'] . "\t" . $location_row['Storage'] . "\t" . $location_row['Brand'] . "\t" . $location_row['OS'] . "\t" . $location_row['Memory'] . "\t" . $location_row['Model'] . "\t" . $location_row['Name'] . "\t" . $location_row['Floor'] . "\t" . $location_row['RoomNo'] . "\t" . $location_row['RoomType'] . "\t" . $location_row['RoomName'] . "\t" . $location_row['emp_id'] . "\t" . $location_row['name'] . "\t" . $location_row['designation'] . "\t" . $location_row['department'] . "\n";
        }
    }
}
$fileName = 'LMS';
header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
unset($_SESSION['filterQry']);
ob_end_flush();

