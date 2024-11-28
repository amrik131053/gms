 <?php
session_start();
ini_set('max_execution_time','0');
ob_start();
header("Content-Type: application/xls");
header("Pragma: no-cache");
header("Expires: 0");
include 'connection/connection.php';
$exportCode ='';
$fileName = 'My File';
if (isset($_POST['exportCode']))
{
    $exportCode = $_POST['exportCode'];
}
elseif (isset($_GET['exportCode']))
{
    $exportCode = $_GET['exportCode'];
}

if($exportCode==19 ||$exportCode==27||$exportCode==28||$exportCode==77||$exportCode==78||$exportCode==79||$exportCode==80 ||$exportCode==80.1)
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


if ($exportCode == 10.1)
{
    $count = 1;
    $inchargeID= $_POST['inchargeID'];

 $article = "SELECT distinct IDNo, Name, RoomType, ArticleName,WorkingStatus, room_master.Floor as FloorName ,room_master.RoomNo as RoomName,Corrent_Owner from stock_summary inner join location_master on location_master.ID=stock_summary.LocationID left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type inner join master_article on stock_summary.ArticleCode=master_article.ArticleCode left join faulty_track on faulty_track.article_no=stock_summary.IDNo Where Corrent_owner='$inchargeID'";

   
    echo 'Sr No' ."\t" . 'QR NO' . "\t" .  'Floor' . "\t" . 'Room Name' . "\t" . 'Block' . "\t" . 'Room No.' . "\t". 'Location Owner ID' . "\t";   
     echo "\n";
    $article_run = mysqli_query($conn, $article);
    while ($article_row = mysqli_fetch_array($article_run))
    {
         $article_row['ArticleName'] ;
    


    $lm_ID=$article_row['IDNo'];
    $OfficeName = $article_row['RoomName'];
    $block = $article_row['Name'];
    $RoomType = $article_row['RoomType'];

    $Floor = $article_row['FloorName'];
    $RoomNo = $article_row['RoomName'];
    //$Floor = $article_row['Floor_name'];

    $EmpName=$article_row['Corrent_Owner'];

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
         
        

        echo $count ."\t". $lm_ID . "\t" . $Floor . "\t". $OfficeName . "\t". $block . "\t". $RoomNo . "\t".  $EmpName . "\t";
            
        echo "\n";
             $count++;
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
               
                <th>Units Concession</th>                
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
            $concession=$data1['concession'];
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
                
                <td><b>{$concession}</b></td>            
                <td><b>{$billAmount}</b></td>            
            </tr>";
        
    }
    
    $meterLocationsData.=" <tr>
                <th colspan='10'>Total Amount</th>                                
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
  
} 
else if($ColomName=='StandardType')
{  

    if($value==8)
    {
        $get_category1="SELECT * FROM Staff where  JobStatus='1' ANd  Phd='Yes'"; 
     
    }
    else
    {
     $get_category1="SELECT DISTINCT IDNo,JobStatus,Name,Designation,Department,RoleID,Imagepath,ContactNo,MobileNo,DepartmentID as depid FROM StaffAcademicDetails inner join Staff ON UserName=IDNo  Where JobStatus='1' and StandardType='$collegeId'";
    }
    
}
else
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
          <th>Offical Email</th> 
          <th>Phone</th>
          <th>Ph.D</th>
          
          
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
      $OfficialEmailID = $row['OfficialEmailID'];
      $phone = $row['MobileNo'];
      $Phd = $row['Phd'];
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
                <td>{$OfficialEmailID}</td>
                <td>{$phone}</td>
                <td>{$Phd}</td>
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
cities on cities.id=offer_latter.District where offer_latter.batch='2024'  GROUP BY offer_latter.District";

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
    $batch=$_GET['batch'];   
    if($District>0)
    {   
     $get_student_details="SELECT  *, states.name as StateName, cities.Name as DistrictName
FROM offer_latter_international inner join states on states.id=offer_latter_international.State inner JOIN 
cities on cities.id=offer_latter_international.District  where offer_latter_international.District='$District'ANd  offer_latter_international.batch='$batch' ";
}
else
{
 $get_student_details="SELECT  *, states.name as StateName, cities.Name as DistrictName
FROM offer_latter_international inner join states on states.id=offer_latter_international.State inner JOIN 
cities on cities.id=offer_latter_international.District  where offer_latter_international.batch='$batch' ";   
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
              <th>Reported</th>


              
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
       $ReportedStatus =$row['ReportedStatus'];

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
     $get_consultantName="SELECT * FROM MasterConsultant where ID='".$row['Consultant_id']."' ";
     $get_consultantNameRun=sqlsrv_query($conntest,$get_consultantName);
     if($row_get_consultantName=sqlsrv_fetch_array($get_consultantNameRun))
     {
         $consultantName=$row_get_consultantName['Name'];
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
if ($ReportedStatus>0)
{
        $colorlR='green';
        $ReportedStatusV='Yes';
}
else
{
     $colorlR='red';
        $ReportedStatusV='No';
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
                      <td bgcolor=$colorlR>{$ReportedStatusV}</td>
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
     $get_consultantName="SELECT * FROM MasterConsultant where ID='".$row['Consultant_id']."' ";
     $get_consultantNameRun=sqlsrv_query($conntest,$get_consultantName);
     if($row_get_consultantName=sqlsrv_fetch_array($get_consultantNameRun))
     {
         $consultantName=$row_get_consultantName['Name'];
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
      $purpose=$row['remarks'];
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
    

  $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND remarks='4th Convocation'");
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
           <th>Course Type</th>
           <th>Status</th>
         
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
      $purpose=$row['remarks'];
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
      $statusn = $row['account_verification'];
      if($statusn=='0')
      {
         $Statusprint='Pending at Accounts';
      }
      else if($statusn=='2'){
        $Statusprint='Rejected  by Accounts Branch';
      }
      else if($statusn=='1'){
        $Statusprint='Pending at Registration Branch';
      }
      else if($statusn=='3'){
        $Statusprint='Rejected  by Registration Branch';
      }
      else if($statusn=='4'){
        $Statusprint='Verified by Registration Branch';
      }
      else if($statusn=='5'){
        $Statusprint='Attendance';
      }
      else
      {
        $Statusprint='';
    }

  $query1="Select CollegeName,Course,CourseID,Batch,IDNo,UniRollNo,StudentName,FatherName,EmailID,StudentMobileNo  from Admissions  where  UniRollNo='$Designation'";


  

$stmt2 = sqlsrv_query($conntest,$query1);

if( $stmt2  === false) {

    die( print_r( sqlsrv_errors(), true) );
}
else
{
 while($rowb = sqlsrv_fetch_array($stmt2))
     {
$courseid=$rowb['CourseID'];

$query1t="Select  top(1) CourseType from MasterCourseCodes where CourseID='$courseid' order by Id desc";
$stmtt = sqlsrv_query($conntest,$query1t);
 while($rowt = sqlsrv_fetch_array($stmtt))
     {
        $CourseType=$rowt['CourseType'];
     }

$collegename= $rowb['CollegeName'];
 $batch=$rowb['Batch'];
 $father_name=$rowb['FatherName'];
 $Course=$rowb['Course'];

 
       
            $exportMeter.="<tr>
             <td>{$count}</td>
             <td>{$collegename}</td>
                 <td>{$Course}</td>
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
                 <td>{$CourseType}</td>
                   <td>{$Statusprint}</td>

               
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


      $CheckStudyMaterial="SELECT Course,COUNT(Course) as coursecount FROM offer_latter where offer_latter.batch='2024' GROUP BY Course ";

 

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
             $GetSmartCardDetails="SELECT *,SmartCardDetails.Status as IDcardStatus ,SmartCardDetails.IDNo as StudentSmartCardID FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.status='$statusForIdCard' and PrintDate Between '$fromDateForIdCard 01:00:00.000' and '$toDateFromIdCard 23:59:00.000' and SmartCardDetails.RePrint is NULL order by Admissions.Course ASC  ";
        }
        else
        {
             $GetSmartCardDetails="SELECT *,SmartCardDetails.Status as IDcardStatus,SmartCardDetails.IDNo as StudentSmartCardID FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where  SmartCardDetails.status='$statusForIdCard' and SmartCardDetails.RePrint is NULL order by Admissions.Course ASC  ";
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
     $admissiontype=$_POST['admissiontype'];

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
$subCount=23;
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
    <th>DOB </th>
    <th>Mobile No </th>

    <th>Aadhar Card No </th>
    <th>Category </th>
    <th>Religion </th>
     <th>Gender</th>
    <th>EmailID </th>
    <th>College </th>
    <th>Course </th>
    <th>Batch </th>
    <th>Eligible </th>
    <th>Country </th>
    <th>State </th>
    <th>District </th>
    <th>Nationality </th>
     <th>ABC ID </th>
    <th>Remarks </th>
    <th>Status</th>
    <th>Locked</th>

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
          if ($admissiontype != '') {
            $query .= " AND AdmissionType='$admissiontype'  Order By ClassRollNo ";
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
            $AdharCardNo=$row['AadhaarNo'];
            $EmailID=$row['EmailID'];
            $CollegeName=$row['CollegeName'];
            $Course=$row['Course'];
            $Batch=$row['Batch'];
            $Ereason=$row['EligibilityReason'];
            $Country=$row['country'];
            $State=$row['State'];
            
$ABCID=$row['ABCID'];

if($row['DOB']!='')
{
   $DOB=$row['DOB']->format('d-m-Y');
}
else
{
    $DOB='';
}

            $StatusType=$row['StatusType'];
            $District=$row['District'];
            $Nationality=$row['Nationality'];
            $Refrence=$row['FeeWaiverScheme'];
            $Category=$row['Category'];
            $Religion=$row['Religion'];
            $gender=$row['Sex'];
             $locked=$row['Locked'];
            if($StatusType>0)
            {
                $StatusType='Provisional';

            }
            else
            {
                $StatusType='';

            }


 if($locked>0)
            {
                $lockedtype='Yes';

            }
            else
            {
                $lockedtype='No';

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
            else
            {
                $status=$StatusType." Left";
                $clr1="red";
            }



         
         $exportstudy.="<tr>

         <td>{$SrNo}</td>
         <td>{$IDNo}</td>
         <td>{$ClassRollNo}</td>
         <td>{$UniRollNo}</td>
         <td>{$StudentName}</td>
         <td>{$FatherName}</td>
         <td>{$MotherName}</td>
         <td>{$DOB}</td>
         <td>{$StudentMobileNo}</td>
         <td>{$AdharCardNo}</td>
         <td>{$Category}</td>
          <td>{$Religion}</td>
           <td>{$gender}</td>
         <td>{$EmailID}</td>
         <td>{$CollegeName}</td>
         <td>{$Course}</td>
         <td>{$Batch}</td>
         <td style='background-color:".$clr.";'>{$Eligibility}</td>     
         <td>{$Country}</td>     
         <td>{$State}</td>     
         <td>{$District}</td>     
         <td>{$Nationality}</td>  
         <td>{$ABCID}</td>   
         <td>{$Ereason}</td>     
         <td style='background-color:".$clr1.";'>{$status}</td>     

           <td>{$lockedtype}</td>     
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
 Batch='$Batch' AND SemesterID='$Semester' AND SGroup='$Group' ANd Isverified='1'";

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
      $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjects[$sub]' ANd ExternalExam='Y' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

                            $ExternalExam=$row_exam['ExternalExam'];
                           $exportstudy.="<td style='text-align:center;'>{$ExternalExam}  </td>"; 
                          }
                          else
                          {
                             $exportstudy.="<td style='text-align:center;'>N</td>"; 
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
             if ($Status != '') 
             {

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
             $list_sql.=" AND (ExamForm.Status>='0' or ExamForm.Status='-1' or ExamForm.Status='22') ";
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
                                 else
                                 {
                                     $Eligibility="Not Eligible";
                                     $clr="yellow";
                                     
                                 }


 $trColor="#FFFFFF";                                
if($RegistrationStatus==-1)
{
  $Status="Pending";
  $trColor="#FFFFFF";

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
   $trColor="#ffffff";
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
                                    
                                }else
                                {
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
                               <th style='background-color:black; color:white;'>Country</th>
                               <th style='background-color:black; color:white;'>Nationality</th>
                               <th style='background-color:black; color:white;'>PIN</th>
                               <th style='background-color:black; color:white;'>Lateral</th>
                               <th style='background-color:black; color:white;'>Eligibility</th>
                               <th style='background-color:black; color:white;'>Status</th>
                            
                               ";
//                                <th style='background-color:black; color:white;'>Comment detail</th>
//                                <th>Refrence</th>
//    <th>Team</th>
//    <th>Consultant</th>
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
                                                   $commentdetail = $row['CommentsDetail'];
                                                   $Refrence = $row['FeeWaiverScheme'];
                                                   $City=$row['City'];
                                                   $State=$row['State'];
                                                   $Nationality=$row['Nationality'];
                                                   $country=$row['country'];
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
                                                   <td>{$country}</td>
                                                   <td>{$Nationality}</td>
                                                   <td>{$PIN}</td>
                                                   <td>{$Lateral}</td>
                                                   <td style='background:{$clr}'>{$Eligibility}</td>
                                                   <td style='background:{$clr1}'>{$status}</td>";
                                                //    <td>{$commentdetail}</td>";
            //                                              <td>";
            // $query3 = "SELECT Name, IDNo FROM MasterConsultantRef AS mcr INNER JOIN Staff AS s ON mcr.RefIDNo = s.IDNo WHERE mcr.StudentIDNo = '$IDNo' AND mcr.Type = 'Staff'";
            // $result3 = sqlsrv_query($conntest, $query3);
            // while ($row3 = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC)) {
            //     $idno = $row3['IDNo'];
            //     $name = $row3['Name'];
            //     $exportstudy .= "{$idno} ({$name})<br>";
            // }

            // $exportstudy.="</td><td>";
            // $query2 = "Select * from  MasterConsultantRef as mcr inner join Staff as s on mcr.RefIDNo=s.IDNo where StudentIDNo='$IDNo' AND mcr.Type='Staff'";
            // $result2 = sqlsrv_query($conntest,$query2);
            // while($row2 = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC) )
            // {      
            //     $idnoR = $row2['ID'];
            //     $nameR = $row2['Name'];
            //     $exportstudy .= "{$idnoR} ({$nameR})<br>";
            // }
            // $exportstudy.="</td><td>";
            //  $query2 = "Select * from  MasterConsultantRef as mcr inner join MasterConsultant as s on mcr.RefIDNo=s.ID where StudentIDNo='$IDNo' AND mcr.Type='Consultant'";
            // $result2 = sqlsrv_query($conntest,$query2);
            // while($row21 = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC) )
            // {      
            //     $idnoC = $row21['ID'];
            //     $nameC = $row21['Name'];
            //     $exportstudy .= "{$nameC}<br>";
            // }
            $exportstudy .= "</tr>";
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
<th style='background-color:black; color:white;'>Left</th> ";
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
                                                                  

$getleft="SELECT * FROM Admissions WHERE  Batch='$Batch' and Eligibility='1' and Status='0' and CollegeID='".$row['CollegeID']."' and CourseID='".$row['CourseID']."'AND LateralEntry='$Lateral'AND CourseID!='188' ";
 $getleft_run=sqlsrv_query($conntest,$getleft,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$Totallefts=sqlsrv_num_rows($getleft_run);



$count[0]=$TotalAdmission;
$count[1]=$TotalActive;
$count[2]=$TotalLeft;
$count[3]=$TotalEligibility;

$count[5]=$Totallefts;
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
                                                                                                        
<td>{$Totallefts}</td>

                                                                                       
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
    if($Status=='66')
    {
        $AcceptType=1;
    }
    else
    {
        $AcceptType=0;
    }
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
                
                <th style='background-color:black; color:white;'>Accept Status</th>
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
                 elseif($Status=='66')
 {
    $list_sql.=" AND (ExamForm.Status>='5' and  ExamForm.Status!='6' ANd AcceptType>'0') ";
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

                                     $AcceptType=$row['AcceptType'];
              if($AcceptType>0)
              {
                $pr='(Provisional)';
              }
              else
              {
               $pr=''; 
              }
                                   
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
                                       <td>{$pr}</td>
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
            $RE='<b style="color:blue;">'.$Registration.'</b>|<b style="color:red;">'.$RegistrationReject.'</b>';
            $dep='<b style="color:blue;">'.$Department.'</b>|<b style="color:red;">'.$DepartmentReject.'</b>';
            $AC='<b style="color:blue;">'.$Account.'</b>|<b style="color:red;">'.$AccountReject.'</b>';
            $EE='<b style="color:blue;">'.$Examination1.'</b>|<b style="color:red;">'.$ExaminationReject.'</b>';
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
  
include 'result-pages/result-subject-bind.php';

$subCount=(count($Subjects)*4)+4;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1'>
        <thead>";
include 'result-pages/resultcopyheader.php';

$exportstudy.="<tr>
    <th>SrNo</th>
    
    <th>UniRoll No</th>";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=4>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}

$exportstudy.="<th colspan=2>Grade Detail
    
  </th></tr>   <tr>
    <th></th>
    <th></th>";
     $gtcerdit=0;
    foreach ($Subjects as $key => $SubjectsCode) {

   $amrikc = "SELECT TOP(1) NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCode' ANd Batch='$Batch' ANd SemesterID='$Semester' Order BY SrNo Desc "; 


$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }
         $exportstudy.="<th colspan=4>Credit : {$credit}</th>";
            
        }
   
}


  $exportstudy.="<th colspan=2>Total Credit :{$gtcerdit}
    
  </th></tr>  
   <tr>
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>Marks</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
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
         <th>{$SrNo}</th>
        
         <th>{$UnirollNos}</th>";

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
                                     $grace= $row_exam['Grace'];


include'result-pages/grade_calculator.php'; 
                               



$exportstudy.="<th>{$totalFinal} </th>";
$exportstudy.="<th>{$grade} </th>"; 
$exportstudy.="<th>{$gardep} </th>";
 $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
       $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<th>{$credit} </th>";  

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}     

else
{
$exportstudy.="<th>NA </th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
 $exportstudy.="<th>NA</th>"; 

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
                                      $grace= $row_exam['Grace'];

include'result-pages/grade_calculator.php';


$exportstudy.="<th>{$totalFinal} </th>";
$exportstudy.="<th>{$grade} </th>"; 
$exportstudy.="<th>{$gardep} </th>";

 $amrikc = "SELECT * FROM MasterCourseStructure where  Batch='$Batch' ANd SubjectCode='$SubjectsNew[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<th>{$credit} </th>";  

if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}  
else
{
$exportstudy.="<th>NA </th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA </th>";
 $exportstudy.="<th>NA </th>"; 
  

}


}







  for($sub=0;$sub<$subCountp;$sub++)
        {


$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjectsp[$sub]' AND ExternalExam='Y'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {


            $pmarks=0;



include'result-pages/grade_calculator_practical.php'; 



                     $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
         }


         if(is_numeric($credit))
         {
$totalcredit=$totalcredit+$credit;
         }
$exportstudy.="<th>{$pmarks}</th>"; 
                           $exportstudy.="<th>{$grade} </th>";
$exportstudy.="<th>{$gardep} </th>";
                           if($credit>0)
{
    if(is_numeric($credit))
    {
 $gradevalue=$gardep*$credit;
    }
    else{
       
        $gradevalue=0;
    }
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
$exportstudy.="<th>{$credit} </th>";  
     


} 
else
{
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
}


     }


 for($sub=0;$sub<$subCountop;$sub++)
        {


$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNewop[$sub]' AND ExternalExam='Y'  ANd SubjectType='OP' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {


            $pmarks=0;



include'result-pages/grade_calculator_practicalopen.php'; 



                     $amrikc = "SELECT * FROM MasterCourseStructure where   Batch='$Batch' ANd SubjectCode='$SubjectsNewop[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
         }


         if(is_numeric($credit))
         {
$totalcredit=$totalcredit+$credit;
         }
$exportstudy.="<th>{$pmarks}</th>"; 
                           $exportstudy.="<th>{$grade} </th>";
$exportstudy.="<th>{$gardep} </th>";
                           if($credit>0)
{
    if(is_numeric($credit))
    {
 $gradevalue=$gardep*$credit;
    }
    else{
       
        $gradevalue=0;
    }
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
$exportstudy.="<th>{$credit} </th>";  
     


} 
else
{
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
}


     }




 $exportstudy.="<th>{$totalcredit} </th>"; 

 $sgpa=$gradevaluetotal/$totalcredit;
    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<th>NC </th>";

}
else
 { $exportstudy.="<th>{$sgpa} </th>";}  


          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


include 'result-pages/resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 
      
                                                     

else if($exportCode==53)
{
   
include 'result-pages/result-subject-bind.php';




$subCount=(count($Subjects)*2)+4;
$subCount1=count($Subjects);
$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>";
include'result-pages/resultcopyheader.php';
$exportstudy.="<tr>
    <th>SrNo</th>
  
    <th>UniRoll No</th> ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=2>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}
$exportstudy.="<th colspan=2>Grade Detail
    
  </th></tr>  
   <tr>
    <th></th>
   
    <th></th>";
     $gtcerdit=0;
    foreach ($Subjects as $key => $SubjectsCode) {

  

       $amrikc = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCode' ANd Batch='$Batch' AND SemesterID='$Semester' "; 
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];

        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }       
         $exportstudy.="<th colspan=2>Credit : {$credit}</th>";
        }
   
}


  $exportstudy.="<th colspan=2>Total Credit :{$gtcerdit}
    
  </th></tr> 
    <tr>
   
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>Grade</th><th>Grade Point</th>";
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
         <th>{$SrNo}</th>
        
         <th>{$UnirollNos}</th>";

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
                                     $grace= $row_exam['Grace'];

 include 'result-pages/grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";

$exportstudy.="<th style='color:{$color}'>{$grade}</th>"; 
$exportstudy.="<th style='color:{$color}'>{$gardep} </th>";


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
    if(is_numeric($gardep))
    {$gardep=$gardep;}else{$gardep=0;}
    
     $gradevalue=$gardep*$credit;

 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
   

    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}

} 
else
{
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
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
                                     $grace= $row_exam['Grace'];

                                     include 'result-pages/grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";
$exportstudy.="<th style='color:{$color}'>{$grade} </th>"; 
$exportstudy.="<th style='color:{$color}'>{$gardep}</th>";


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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}   
else
{
$exportstudy.="<th >NA</th>"; 
$exportstudy.="<th >NA</th>";
}

}





  for($sub=0;$sub<$subCountp;$sub++)
        {
           

$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjectsp[$sub]' AND ExternalExam='Y'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {


            $pmarks=0;
   
 include 'result-pages/grade_calculator_practical.php';






                   $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }


            if(is_numeric($credit))
            {
   $totalcredit=$totalcredit+$credit;
            }


                           
                           //$exportstudy.="<td style='text-align:center;'>{$pmarks} </td>"; 
                           $exportstudy.="<th style='color:{$color}'>{$grade} </th>";
$exportstudy.="<th style='color:{$color}'>{$gardep} </th>";
if($credit>0)
{
    if(is_numeric($credit))
    {
 $gradevalue=$gardep*$credit;
    }
else{
        $gradevalue=0;
    }
   
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}

}
else
{
    $exportstudy.="<th>NA </th>";
    $exportstudy.="<th>NA </th>";  
}

            







          }

 for($sub=0;$sub<$subCountop;$sub++)
        {


$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNewop[$sub]' AND ExternalExam='Y'  ANd SubjectType='OP'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {


            $pmarks=0;



include'result-pages/grade_calculator_practicalopen.php'; 



                     $amrikc = "SELECT * FROM MasterCourseStructure where   Batch='$Batch' ANd SubjectCode='$SubjectsNewop[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
         }


         if(is_numeric($credit))
         {
$totalcredit=$totalcredit+$credit;
         }

                           $exportstudy.="<th>{$grade} </th>";
$exportstudy.="<th>{$gardep} </th>";
                           if($credit>0)
{
    if(is_numeric($credit))
    {
 $gradevalue=$gardep*$credit;
    }
    else{
       
        $gradevalue=0;
    }
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
  
     


} 
else
{
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
}


     }

 $exportstudy.="<th>{$totalcredit} </th>"; 

 $sgpa=$gradevaluetotal/$totalcredit;


    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<th style='color:{$color}'>NC </th>";

}
else
 { $exportstudy.="<th>{$sgpa} </th>";}  

//$exportstudy.="<th>{$nccount} </th>";

          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


include 'result-pages/resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 


            


 else if($exportCode==54)
{
    include 'result-pages/result-subject-bind.php';

$subCount=(count($Subjects)*5)+6;
$subCount1=count($Subjects);
$exportstudy="<table class='table' border='1'>     <thead>";
include 'result-pages/resultcopyheader.php';

$exportstudy.="
    <tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=5>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}

$exportstudy.="<th colspan=2>Grade Detail
    
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
        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }
 
         $exportstudy.="<th colspan=5>Credit : {$credit}</th>";
            }
   
}


  $exportstudy.="<th colspan=2>Total Credit :{$gtcerdit}
    
  </th></tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>CE1/CE3/Att/MST1/MST2/ESE(Grace)</th><th>Marks</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
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
                                      $grace= $row_exam['Grace'];
        include 'result-pages/grade_calculator.php';                              

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
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
                                      $grace= $row_exam['Grace'];
                                     include'result-pages/grade_calculator.php';

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
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


 $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjectsp[$sub]' AND ExternalExam='Y'";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {

            $pmarks=0;


include'result-pages/grade_calculator_practical.php';

$amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
         }


         if(is_numeric($credit))
         {
$totalcredit=$totalcredit+$credit;
         }



                           
                            $exportstudy.="<td style='text-align:center;'>{$pshow}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$pmarks}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
                          

                           if($credit>0)
{
    if(is_numeric($credit))
    {
 $gradevalue=$gardep*$credit;
    }
    else{
        $gradevalue=0; 
    }
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  
           



}
else
{
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
$exportstudy.="<td style='text-align:center;'>NA</td>"; $exportstudy.="<td style='text-align:center;'>NA</td>";
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
}
}

 for($sub=0;$sub<$subCountop;$sub++)
        {


$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNewop[$sub]' AND ExternalExam='Y'  ANd SubjectType='OP' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {


            $pmarks=0;



include'result-pages/grade_calculator_practicalopen.php'; 



                     $amrikc = "SELECT * FROM MasterCourseStructure where   Batch='$Batch' ANd SubjectCode='$SubjectsNewop[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
         }


         if(is_numeric($credit))
         {
$totalcredit=$totalcredit+$credit;
         }
$exportstudy.="<td style='text-align:center;'>{$pshow}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$pmarks}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
                           if($credit>0)
{
    if(is_numeric($credit))
    {
 $gradevalue=$gardep*$credit;
    }
    else{
       
        $gradevalue=0;
    }
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
$exportstudy.="<th>{$credit} </th>";  
     


} 
else
{
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
}


     }












   $exportstudy.="<td style='text-align:center;'>{$totalcredit} </td>"; 

if($totalcredit>0)
{
  $sgpa=$gradevaluetotal/$totalcredit;   
}
else
{
   $sgpa=0; 
}


    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<td style='text-align:center;color:{$color}'>NC</td>";

}
else
 { $exportstudy.="<td style='text-align:center;'>{$sgpa} </td>";}  

//$exportstudy.="<td style='text-align:center;'>{$nccount} </td>";

          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }

include 'result-pages/resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 

 else if($exportCode==55)
{

include 'result-pages/result-subject-bind.php';

$subCount=(count($Subjects)*5)+4;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1'><thead>"; 
 $exportstudy.="<tr><th colspan='".$subCount."' ><b style='font-size:22px;'>GURU KASHI UNIVERSITY, TALWANDI SABO, BATHINDA (PUNJAB) RESULT NOTIFICATION No. GKU/COE/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;".$Examination."&nbsp;&nbsp;EXAMINATION</b></th></tr>"; 
     $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:16px;text-align:left;'>  &nbsp;&nbsp;&nbsp; Programme:&nbsp;&nbsp;&nbsp;".$CourseName."&nbsp;&nbsp;&nbsp;
    <b style='text-align:center;font-size:16px;'>   &nbsp;&nbsp;&nbsp;Semester:&nbsp;&nbsp;&nbsp;".$Semester."</b>(".$Type.")  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Batch &nbsp;&nbsp;&nbsp;: <b style='text-align:right;'>".$Batch."</b></th></tr>";
    $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th></tr>";
$exportstudy.="<tr><th>SrNo</th><th>UniRoll No</th>";

    foreach ($Subjects as $key => $SubjectsCode) {
$exportstudy.="<th>Subject Name</th><th>Subject Code</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
}
$exportstudy.="<th>Total Credit</th><th>SGPA</th></tr></thead>"; 

    $list_sql = "SELECT  ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination'  ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo  ";
            $j=0;
             $list_result = sqlsrv_query($conntest,$list_sql);
                            $count = 1;
                      if($list_result === false)
                        {
                       die( print_r( sqlsrv_errors(), true) );
                       }
                        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                           {
                         $IDNos=$row['IDNo'];
                        $UnirollNos=$row['UniRollNo'];
                        $ClassRollNos=$row['ClassRollNo'];
                         $Examid=$row['ID'];
                         $StudentNames =$row['StudentName'];     
           $exportstudy.="<tr><td>{$SrNo}</td><td>{$UnirollNos}</td>";
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
                                     $grace= $row_exam['Grace'];


include'result-pages/grade_calculator.php';
$exportstudy.="<td style='text-align:center;color:{$color}'>{$subjectName}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$SubjectCode}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} {$showgradefail}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep}</td>";

 $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
       $credit=$row7c['NoOFCredits'];
         }
       

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<td style='text-align:center'>{$credit} </td>";  

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}     

else
{
$exportstudy.="<td style='text-align:center'>NA</td><td style='text-align:center'>NA</td><td style='text-align:center'>NA</td><td style='text-align:center'>NA</td><td style='text-align:center'>NA</td>"; 
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
                                      $grace= $row_exam['Grace'];

include'result-pages/grade_calculator.php';
$exportstudy.="<td style='text-align:center;color:{$color}'>{$subjectName}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$SubjectCode}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade}{$showgradefail}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep}</td>";

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
else
{

}

}  
else
{
$exportstudy.="<td style='text-align:center'>NA </td>";
$exportstudy.="<td style='text-align:center'>NA</td>"; 
$exportstudy.="<td style='text-align:center'>NA </td>";
 $exportstudy.="<td style='text-align:center'>NA </td>"; 
 $exportstudy.="<td style='text-align:center'>NA </td>"; 
}
}
  for($sub=0;$sub<$subCountp;$sub++)
        {

$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjectsp[$sub]' AND ExternalExam='Y'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {
            $pmarks=0;
       
 include'result-pages/grade_calculator_practical.php';

$amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $SubjectCode=$row7c['SubjectCode'];
             $SubjectName=$row7c['SubjectName'];
             $credit=$row7c['NoOFCredits'];
            }
            if(is_numeric($credit))
            {
$totalcredit=$totalcredit+$credit;
            }
 $exportstudy.="<td style='text-align:center;'>{$SubjectName}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$SubjectCode}</td>"; 
                           $exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
    
if(is_numeric($credit))
{
    $credit=$credit;
}   
else
{
    $credit=0;
}




 if($credit>0)
{
    if(is_numeric($credit))
    {
 $gradevalue=$gardep*$credit;
    }
    else{
        $gradevalue=0; 
    }
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}







$exportstudy.="<td style='text-align:center;'>{$credit} </td>";   
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


 for($sub=0;$sub<$subCountop;$sub++)
        {


$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNewop[$sub]' AND ExternalExam='Y'  ANd SubjectType='OP' ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {


            $pmarks=0;



include'result-pages/grade_calculator_practicalopen.php'; 



                     $amrikc = "SELECT * FROM MasterCourseStructure where   Batch='$Batch' ANd SubjectCode='$SubjectsNewop[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7co = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7co['NoOFCredits'];
             $SubjectCode=$row7co['SubjectCode'];
             $SubjectName=$row7co['SubjectName'];
         }


         if(is_numeric($credit))
         {
$totalcredit=$totalcredit+$credit;
         }
$exportstudy.="<td style='text-align:center;'>{$SubjectName}</td>"; 
                           $exportstudy.="<td style='text-align:center;'>{$SubjectCode}</td>"; 
                           $exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>";
$exportstudy.="<td style='text-align:center;'>{$gardep} </td>";

                           if($credit>0)
{
    if(is_numeric($credit))
    {
 $gradevalue=$gardep*$credit;
    }
    else{
       
        $gradevalue=0;
    }
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
$exportstudy.="<th>{$credit} </th>";  
     


} 
else
{
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
}


     }

$exportstudy.="<td style='text-align:center;'>{$totalcredit} </td>"; 

if($totalcredit>0)
{
  $sgpa=$gradevaluetotal/$totalcredit;   
}
else
{
   $sgpa=0; 
}


// $sgpa=$gradevaluetotal/$totalcredit;


 $sgpa= number_format($sgpa,2);


if($nccount>0)
{
$exportstudy.="<td style='text-align:center;color:{$color}'>NC </td>";
}
else
 { $exportstudy.="<td style='text-align:center;'>{$sgpa}</td>";}  
   $exportstudy.="</tr>";
    $SrNo++; } $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 
     

else if($exportCode==56)
{
    include 'result-pages/result-subject-bind.php';

$subCount=count($Subjects)+4;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1'>
        <thead>  
        <tr> ";
include'result-pages/resultcopyheader.php';


$exportstudy.="<tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
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
                                     $grace= $row_exam['Grace'];
                                    
                                   

 include 'result-pages/grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";

$exportstudy.="<td style='text-align:center;color:{$color}'><b>{$printmark}</b></td>"; 





} 
else
{
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
                                     $grace= $row_exam['Grace'];

                                     include 'result-pages/grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'><b>{$printmark}</b> </td>"; 




}   
else
{
$exportstudy.="<td style='text-align:center'>NA</td>"; 

}

}

  for($sub=0;$sub<$subCountp;$sub++)
        {
           

$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjectsp[$sub]' AND ExternalExam='Y'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {
 $pmarks=0;
    

 include 'result-pages/grade_calculator_practical.php';
//$exportstudy.="<td style='text-align:center;'>{$pmarks} </td>"; 
                           $exportstudy.="<td style='text-align:center;color:{$color}'>{$printmark} </td>";
                       }
else
{
    $exportstudy.="<td style='text-align:center;'>NA </td>";

}

     
          }



for($sub=0;$sub<$subCountop;$sub++)
        {


$list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNewop[$sub]' AND ExternalExam='Y'  ANd SubjectType='OP'  ";  
        $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
                       if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
                          {


            $pmarks=0;



include'result-pages/grade_calculator_practicalopen.php'; 



$exportstudy.="<td style='text-align:center;color:{$color}'>{$printmark} </td>";
                       }
else
{
    $exportstudy.="<td style='text-align:center;'>NA </td>";

}

} 

  $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


//include 'resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 
    elseif($exportCode==57)
    {    
    $College=$_GET['College'];
    $Course=$_GET['Course'];
    $Batch=$_GET['Batch'];
    $session=$_GET['session'];
    $Nationality_=$_GET['Nationality_'];
    $State_=$_GET['State_'];
    $District=$_GET['District'];
    $Consultant_=$_GET['Consultant_'];
    $list_sql="SELECT *, states.name as StateName, cities.Name as DistrictName
    FROM offer_latter inner join states on states.id=offer_latter.State inner JOIN 
    cities on cities.id=offer_latter.District WHERE 1=1 ";
                    if($College!=''){
                        $list_sql.= " AND CollegeName='$College' ";
                    }
                    if($Course!=''){
                    $list_sql.= "AND Course='$Course'";
                    }
                    if($Batch!=''){
                    $list_sql.= "AND Batch='$Batch' ";
                    }
                    if($session!=''){
                    $list_sql.= "AND Session='$session' ";
                    }
                    if($Nationality_!=''){
                    $list_sql.= "AND Nationality='$Nationality_'";
                    }
                    if($State_!=''){
                    $list_sql.= "ANd State='$State_' ";
                    }
                    if($District!=''){
                    $list_sql.= "ANd District='$District'"; 
                    }
                    if($Consultant_!=''){
                    $list_sql.= "ANd Consultant_id='$Consultant_'"; 
                    }
                    $list_sql.= "ORDER BY Status ASC";
                    $list_result = mysqli_query($conn,$list_sql);
                    $count = 1;
  
                  
    
        $count = 1;
        $exportMeter="
        <table class='table' border='1'>
                   
           <thead>
                              
              <tr color='red'>                 
                 <th style='background-color:black; color:white;'>#</th>               
                 <th style='background-color:black; color:white;'>Session</th>
                 <th style='background-color:black; color:white;'>College Name</th>
                 <th style='background-color:black; color:white;'>Course</th>  
                 <th style='background-color:black; color:white;'>Name</th>
                 <th style='background-color:black; color:white;'>Father Name</th>
                      <th style='background-color:black; color:white;'>Mobile No</th>
                 <th style='background-color:black; color:white;'>RollNo</th>
                 <th style='background-color:black; color:white;'>Gender</th>
                 <th style='background-color:black; color:white;'>State</th>
                 <th style='background-color:black; color:white;'>District</th>
                 <th style='background-color:black; color:white;'>Consultant</th>
                  <th style='background-color:black; color:white;'>Status</th>
                  <th style='background-color:black; color:white;'>Verification</th>
                  <th style='background-color:black; color:white;'>Loan Number</th>
                  <th style='background-color:black; color:white;'>Application No</th>
                  <th style='background-color:black; color:white;'>Date Of Verification</th>
                  <th style='background-color:black; color:white;'>Amount</th>
                  <th style='background-color:black; color:white;'>UTR Number</th>
                  <th style='background-color:black; color:white;'>Date Of Payment</th> 
              </tr>          
           </thead>
           ";
           while( $row = mysqli_fetch_array($list_result) )
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


        $get_colege_course_namew="SELECT * FROM Admissions where ClassRollNo='$classroll'";
        $get_colege_course_name_runw=sqlsrv_query($conntest,$get_colege_course_namew);
        if ($row_collegecourse_namew=sqlsrv_fetch_array($get_colege_course_name_runw)) 
        {   
             $StudentMobileNo=$row_collegecourse_namew['StudentMobileNo'];   
            
        }  



        $State=$row['StateName'];   
        $status=$row['Status'];   
        $Session=$row['Session'];    
         $Duration=$row['Duration'];    
         $Consultant_id=$row['Consultant_id']; 
         $get_consultantName="SELECT * FROM MasterConsultant where ID='".$row['Consultant_id']."' ";
         $get_consultantNameRun=sqlsrv_query($conntest,$get_consultantName);
         if($row_get_consultantName=sqlsrv_fetch_array($get_consultantNameRun))
         {
             $consultantName=$row_get_consultantName['Name'];
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
              <td>{$StudentMobileNo}</td>
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

    else if($exportCode==58)
    {
 $CourseID = $_GET['course'];
 $CollegeID = $_GET['college'];
 $Batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $subjectcode = $_GET['subject'];
 $DistributionTheory = $_GET['distributiontheory'];
 $exam = $_GET['examination'];


$sql1 = "{CALL USP_Get_studentbyCollegeInternalMarksDistributionTheory('$CollegeID','$CourseID','$semID','$Batch','$subjectcode','$exam','$DistributionTheory')}";
    $stmt = sqlsrv_prepare($conntest,$sql1);
  
    if (!sqlsrv_execute($stmt)) {
          echo "Your code is fail!";
    echo sqlsrv_errors($sql1);
    die;
    } 

        $SrNo=1;
         $exportstudy="<table class='table' border='1'><thead>"; 
         $exportstudy.="<tr><th>SrNo</th><th>UniRoll No</th><th>Student Name</th><th>Subject Name</th><th>Subject Code</th><th>Marks</th></tr>";

     while($row = sqlsrv_fetch_array($stmt))
     {

   
 

                           
             $exportstudy.="<tr>
             <td>{$SrNo}</td>
             <td>{$row['UniRollNo']}</td>
               <td>{$row['StudentName']}</td>
             <td>{$row['SubjectName']}</td>
              <td>{$row['SubjectCode']}</td>
             <td>{$row['intmarks']}</td>
           
             
             </tr>";
    $SrNo++;
      }       
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName="Theory Report".$subjectcode.'-'.$DistributionTheory;
    
}

else if($exportCode==59)
    {
    $College=$_GET['College'];
    $Course=$_GET['Course'];
    $Batch=$_GET['Batch'];
    $session=$_GET['session'];
    $Nationality_=$_GET['Nationality_'];
    $State_=$_GET['State_'];
    $District=$_GET['District'];
    $Consultant_=$_GET['Consultant_'];
    $exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>";
                $exportstudy.="<thead><tr>
                <th style='background-color:black; color:white;'>#</th>
                <th style='background-color:black; color:white;'>Session</th>
                    <th style='background-color:black; color:white;'>CourseName</th>
                    <th style='background-color:black; color:white;'>Country</th>
                    <th style='background-color:black; color:white;' >State</th>
                    <th style='background-color:black; color:white;' >District</th>
                    <th style='background-color:black; color:white;'>Consultant</th>
                    <th style='background-color:black; color:white;' >Count</th>
                    </tr></thead>";
                        $SrNo=1;
                            $list_sql="SELECT Course, Nationality, State, District,Consultant_id, COUNT(*) AS CourseCount
                            FROM offer_latter
                            WHERE 1=1 ";
                            if($session!=''){
                            $list_sql.= "AND Session='$session' ";
                            }
                    if($Consultant_!=''){
                    $list_sql.= "AND Consultant_id='$Consultant_' "; 
                    }
                    $list_sql.= " GROUP BY Course, Nationality, State, District,Consultant_id
                    ORDER BY Status ASC";
                    $list_result = mysqli_query($conn,$list_sql);
                    $count = 1;
  
                    while( $row = mysqli_fetch_array($list_result) )
                        {
                 $CourseCount=$row['CourseCount'];
                    $get_consultant="SELECT * FROM MasterConsultant where Status>0 and ID='".$row['Consultant_id']."'"; 
                    $get_consultant_run=sqlsrv_query($conntest,$get_consultant);
                    if($row1=sqlsrv_fetch_array($get_consultant_run))
                    {
                    $Consultantname=$row1['Name']; 
                    }
                    $get_course_name="SELECT Course FROM MasterCourseCodes where CourseID='".$row['Course']."'";
                    $get_course_name_run=sqlsrv_query($conntest,$get_course_name);
                    if ($row_course_name=sqlsrv_fetch_array($get_course_name_run)) 
                    {
                    $courseName=$row_course_name['Course'];
                    }
                    $get_country="SELECT * FROM countries where id='".$row['Nationality']."'";
                    $get_country_run=mysqli_query($conn,$get_country);
                    if($row_country=mysqli_fetch_array($get_country_run))
                    {
                    $countryName=$row_country['name'];
                    }
                    $sql = "SELECT  id,name FROM states WHERE id='".$row['State']."' order by name ASC";
                    $stmt = mysqli_query($conn,$sql); 
                    if($row_state = mysqli_fetch_array($stmt) )
                    {
                    $StateName=$row_state['name'];
                    }
                    $sqlDist = "SELECT  id,name FROM cities WHERE id='".$row['District']."' order by name ASC";
                    $stmtsqlDist = mysqli_query($conn,$sqlDist); 
                    if($row_dist = mysqli_fetch_array($stmtsqlDist) )
                    {
                    $DistName=$row_dist['name'];
                    }         
             $exportstudy.="<tr>
             <td>{$SrNo}</td>
             <td>{$session}</td>
             <td>{$courseName}</td>
             <td>{$countryName}</td>
             <td>{$StateName}</td>
             <td>{$DistName}</td>
             <td>{$Consultantname}</td>
             <td>{$CourseCount}</td>
             </tr>";
    $SrNo++;
             }
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName="offer letter Report ";
    }


 else if($exportCode==60)
{
    include 'result-pages/result-subject-bind-new.php';

$subCount=(count($Subjects)*2)+4;
$subCount1=count($Subjects);
$exportstudy="<table class='table' border='1'>     <thead>";
include 'result-pages/resultcopyheader.php';

$exportstudy.="
    <tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=2>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}

$exportstudy.="</tr>   <tr>
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
        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }
 
         $exportstudy.="<th colspan=2>Credit : {$credit}</th>";
            }
   
}


  $exportstudy.="</tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>CE1/CE3/Att/MST1/MST2/ESE</th><th>Marks</th>";
}
       $exportstudy.="</tr> </thead>"; 




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
                                      $grace= $row_exam['Grace'];
        include 'result-pages/grade_calculator.php';                              

$exportstudy.="<td style='text-align:center;'>{$showmarks} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$totalFinal} </td>";
// $exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>"; 
// $exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep} </td>";
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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}     

else
{
$exportstudy.="<td style='text-align:center;'>NA </td>";
$exportstudy.="<td style='text-align:center;'>NA</td>"; 
// $exportstudy.="<td style='text-align:center;'>NA</td>";
//  $exportstudy.="<td style='text-align:center;'>NA</td>"; 
//  $exportstudy.="<td style='text-align:center;'>NA </td>"; 
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
                                      $grace= $row_exam['Grace'];
                                     include'result-pages/grade_calculator.php';

$exportstudy.="<td style='text-align:center;'>{$showmarks} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$totalFinal} </td>";
// $exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} </td>"; 
// $exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep} </td>";

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
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
// $exportstudy.="<td style='text-align:center;'>NA </td>";
//  $exportstudy.="<td style='text-align:center;'>NA </td>"; 
//  $exportstudy.="<td style='text-align:center;'>NA </td>"; 
}


}

//   for($sub=0;$sub<$subCountp;$sub++)
//         {


//  $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$Subjectsp[$sub]' AND ExternalExam='Y'";  
//         $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
//                        if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
//                           {

//             $pmarks=0;


// include'result-pages/grade_calculator_practical.php';

// $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjectsp[$sub]'";  
// $list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

// while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
//          {
//              $credit=$row7c['NoOFCredits'];
//          }


//          if(is_numeric($credit))
//          {
// $totalcredit=$totalcredit+$credit;
//          }



                           
//                             $exportstudy.="<td style='text-align:center;'>{$pshow}</td>"; 
//                            $exportstudy.="<td style='text-align:center;'>{$pmarks}</td>"; 
// //                            $exportstudy.="<td style='text-align:center;'>{$grade} </td>";
// // $exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
                          

//                            if($credit>0)
// {
//     if(is_numeric($credit))
//     {
//  $gradevalue=$gardep*$credit;
//     }
//     else{
//         $gradevalue=0; 
//     }
//  if($gradevalue>0)
//  {
// $gradevaluetotal=$gradevaluetotal+$gradevalue;
//  }
//  else
//  {
//     if($grade=='F' || $grade=='US')
//     {
//     $nccount++;
//     }
//  }
// }
// //$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  
           



// }
// else
// {
// $exportstudy.="<td style='text-align:center;'>NA</td>"; 
// $exportstudy.="<td style='text-align:center;'>NA</td>";
// //  $exportstudy.="<td style='text-align:center;'>NA</td>";
// // $exportstudy.="<td style='text-align:center;'>NA</td>"; 
// // $exportstudy.="<td style='text-align:center;'>NA</td>"; 
// }
// }

//  for($sub=0;$sub<$subCountop;$sub++)
//         {


// $list_sql_examsubject = "SELECT * FROM ExamFormSubject WHERE Examid='$Examid' ANd SubjectCode='$SubjectsNewop[$sub]' AND ExternalExam='Y'  ANd SubjectType='OP' ";  
//         $list_result_examsubject = sqlsrv_query($conntest,$list_sql_examsubject);
//                        if($row_exam = sqlsrv_fetch_array($list_result_examsubject, SQLSRV_FETCH_ASSOC) )
//                           {


//             $pmarks=0;



// include'result-pages/grade_calculator_practicalopen.php'; 



//                      $amrikc = "SELECT * FROM MasterCourseStructure where   Batch='$Batch' ANd SubjectCode='$SubjectsNewop[$sub]'";  
// $list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

// while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
//          {
//              $credit=$row7c['NoOFCredits'];
//          }


//          if(is_numeric($credit))
//          {
// $totalcredit=$totalcredit+$credit;
//          }
// $exportstudy.="<td style='text-align:center;'>{$pshow}</td>"; 
//                            $exportstudy.="<td style='text-align:center;'>{$pmarks}</td>"; 
// //                            $exportstudy.="<td style='text-align:center;'>{$grade} </td>";
// // $exportstudy.="<td style='text-align:center;'>{$gardep} </td>";
//                            if($credit>0)
// {
//     if(is_numeric($credit))
//     {
//  $gradevalue=$gardep*$credit;
//     }
//     else{
       
//         $gradevalue=0;
//     }
//  if($gradevalue>0)
//  {
// $gradevaluetotal=$gradevaluetotal+$gradevalue;
//  }
//  else
//  {
//     if($grade=='F' || $grade=='US')
//     {
//     $nccount++;
//     }
//  }
// }
// //$exportstudy.="<th>{$credit} </th>";  
     


// } 
// else
// {
// $exportstudy.="<th>NA</th>"; 
// $exportstudy.="<th>NA</th>";
// // $exportstudy.="<th>NA</th>"; 
// // $exportstudy.="<th>NA</th>";
// }


//      }












   //$exportstudy.="<td style='text-align:center;'>{$totalcredit} </td>"; 

if($totalcredit>0)
{
  $sgpa=$gradevaluetotal/$totalcredit;   
}
else
{
   $sgpa=0; 
}


    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
//$exportstudy.="<td style='text-align:center;color:{$color}'>NC</td>";

}
else
 { 
   // $exportstudy.="<td style='text-align:center;'>{$sgpa} </td>";
}  

//$exportstudy.="<td style='text-align:center;'>{$nccount} </td>";

          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }

//include 'result-pages/resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 

  else if($exportCode==61)
    {
 $course = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $session = $_GET['session'];
 
      $category = $_GET["category"];
$list_sql="SELECT * FROM Admissions WHERE 1=1 ";
if($college!=''){
 $list_sql.= " AND CollegeID='$college' ";
}
if($course!=''){
$list_sql.= "AND CourseID='$course'";
}
if($batch!=''){
$list_sql.= "AND Batch='$batch'";
} 
if($session!=''){
$list_sql.= "AND Session='$session' ";
}
if($category!=''){
$list_sql.= "AND Category='$category' ";
}
$list_sql.= "AND Status='1' AND Batch='$batch'  Order BY ClassRollNo ASC";


$q1 = sqlsrv_query($conntest,$list_sql);



$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'><tr><td>Sr No</td><td>Session</td><td>IDNo</td><td>UniRollNo</td><td>Class RollNO</td><td>Name</td>
  <td>Father Name</td> <td>Course</td> <td>Batch</td><td>Fee Category</td><td>Debit</td><td>Credit</td><td>Balance</td></tr>";

  $srno=1;
        while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
        {
$idno=$row['IDNo'];
$exportstudy.="<tr>";

$exportstudy.="<td>{$srno}</td><td>{$row['Session']}</td><td>{$row['IDNo']}</td><td>{$row['ClassRollNo']}</td> <td>{$row['UniRollNo']}</td>
<td>{$row['StudentName']}</td><td>{$row['FatherName']}</td><td>{$row['Course']}</td><td>{$row['Batch']}</td><td>{$row['FeeCategory']}</td>";
 
$Admiss2="SELECT sum(Debit) as totaldebit ,sum(Credit)as totalcredit from ledger   WHERE 1=1" ; 
if($semID!='')
{
 $Admiss2.= " AND SemesterID<='$semID' ";
}
$Admiss2.="AND IDNo='$idno'";

$q2 = sqlsrv_query($conntest, $Admiss2);
 while ($dataw = sqlsrv_fetch_array($q2, SQLSRV_FETCH_ASSOC)) 
 {
  
$tdebit=$dataw['totaldebit'];
$tcredit=$dataw['totalcredit'];
$balanceamount=$tdebit-$tcredit;
$exportstudy.="<td>{$tdebit}</td><td>{$tcredit}</td><td>{$balanceamount}</td>";

 }

          $exportstudy.="</tr>"; 
          $srno++;
        }    
        $exportstudy.="</table>";

        echo $exportstudy;
        $fileName="StudentLedger";
    
}
  else if($exportCode==62)
    {
        $CollegeID=$_REQUEST['CollegeID'];
$Course=$_REQUEST['Course'];
$Batch=$_REQUEST['batch'];
$Semester=$_REQUEST['semester'];

$get_study_scheme="SELECT * FROM MasterCourseStructure WHERE 1=1";
if($CollegeID!='')
{
   $get_study_scheme.="AND CollegeID='$CollegeID'";
}
if($Course!='')
{
$get_study_scheme.=" AND CourseID='$Course'";
}
if($Batch!='')
{
$get_study_scheme.=" AND Batch='$Batch'";
}
if($Semester!='')
{
$get_study_scheme.=" AND SemesterID='$Semester'";
} 
$get_study_scheme_run=sqlsrv_query($conntest,$get_study_scheme,array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
<tr>
<td>CollegeName</td>
<td>Course</td>
<td>Semester</td>
<td>Batch</td>
<td>SubjectName</td>
<td>SubjectType</td>
<td>SubjectCode</td>
<td>Lecture</td>
<td>Tutorial</td>
<td>Practical</td>
<td>NoOFCredits</td>
</tr>";
$srno=1;
while($get_row=sqlsrv_fetch_array($get_study_scheme_run,SQLSRV_FETCH_ASSOC))
  {
$exportstudy.="<tr>";
$exportstudy.="<td>{$get_row['CollegeName']}</td>
<td>{$get_row['Course']}</td>
<td>{$get_row['Semester']}</td>
<td>{$get_row['Batch']}</td>
<td>{$get_row['SubjectName']}</td>
<td>{$get_row['SubjectType']}</td>
<td>{$get_row['SubjectCode']}</td>
<td>{$get_row['Lecture']}</td>
<td>{$get_row['Tutorial']}</td>
<td>{$get_row['Practical']}</td>
<td>{$get_row['NoOFCredits']}</td>
";
  $exportstudy.="</tr>"; 
$srno++;
 }    
$exportstudy.="</table>";
 echo $exportstudy;
 $fileName="Study Scheme";
    
}



else if($exportCode==63)
{
  
//include 'result-pages/result-subject-bind-new.php';
include 'result-pages/result-subject-bind-new2.php';

$subCount=(count($Subjects)*4)+4;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1'>
        <thead>";
include 'result-pages/resultcopyheader.php';

$exportstudy.="<tr>
    <th>SrNo</th>
    
    <th>UniRoll No</th>";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=4>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}

$exportstudy.="<th colspan=2>Grade Detail
    
  </th></tr>   <tr>
    <th></th>
    <th></th>";
     $gtcerdit=0;
    foreach ($Subjects as $key => $SubjectsCode) {

    $amrikc = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCode' ANd Batch='$Batch' ANd SemesterID='$Semester' AND CourseID='$Course' "; 


$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }
         $exportstudy.="<th colspan=4>Credit : {$credit}</th>";
            
        }
   
}
  foreach ($SubjectsNew as $key => $SubjectsCodeop) {

  $amrikop = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCodeop' ANd Batch='$Batch'AND SemesterID='$Semester'";  
  
$list_resultamrikop = sqlsrv_query($conntest,$amrikop);  

while($row7op = sqlsrv_fetch_array($list_resultamrikop, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }
 
         $exportstudy.="<th colspan=5>Credit : {$credit}</th>";
            }
   
}







  $exportstudy.="<th colspan=2>Total Credit :{$gtcerdit}
    
  </th></tr>  
   <tr>
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>Marks</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
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
         <th>{$SrNo}</th>
        
         <th>{$UnirollNos}</th>";

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
                                     $grace= $row_exam['Grace'];


include'result-pages/grade_calculator.php'; 
                               



$exportstudy.="<th>{$totalFinal} </th>";
$exportstudy.="<th>{$grade} </th>"; 
$exportstudy.="<th>{$gardep} </th>";
 $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
       $credit=$row7c['NoOFCredits'];
            }

if(is_numeric($credit))
        {
        $totalcredit=$totalcredit+$credit;
    }
    else
    {
       $credit =0;
    }
 $exportstudy.="<th>{$credit} </th>";  

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}     

else
{
$exportstudy.="<th>NA </th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
 $exportstudy.="<th>NA</th>"; 

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
                                      $grace= $row_exam['Grace'];

include'result-pages/grade_calculator.php';


$exportstudy.="<th>{$totalFinal} </th>";
$exportstudy.="<th>{$grade} </th>"; 
$exportstudy.="<th>{$gardep} </th>";

 $amrikc = "SELECT * FROM MasterCourseStructure where  Batch='$Batch' ANd SubjectCode='$SubjectsNew[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
             $credit=$row7c['NoOFCredits'];
            }

$totalcredit=$totalcredit+$credit;
 $exportstudy.="<th>{$credit} </th>";  

if($credit>0)
{
 $gradevalue=$gardep*$credit;
 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}  
else
{
$exportstudy.="<th>NA </th>";
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA </th>";
 $exportstudy.="<th>NA </th>"; 
  

}


}






 $exportstudy.="<th>{$totalcredit} </th>"; 

 $sgpa=$gradevaluetotal/$totalcredit;
    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<th>NC </th>";

}
else
 { $exportstudy.="<th>{$sgpa} </th>";}  


          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


include 'result-pages/resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 
      
else if($exportCode==64)
{
   
//include 'result-pages/result-subject-bind-new.php';
include 'result-pages/result-subject-bind-new2.php';
$subCount=(count($Subjects)*2)+4;
$subCount1=count($Subjects);
$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>";
include'result-pages/resultcopyheader.php';
$exportstudy.="<tr>
    <th>SrNo</th>
  
    <th>UniRoll No</th> ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=2>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}
$exportstudy.="<th colspan=2>Grade Detail
    
  </th></tr>  
   <tr>
    <th></th>
   
    <th></th>";
     $gtcerdit=0;
    foreach ($Subjects as $key => $SubjectsCode) {

  

       $amrikc = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCode' ANd Batch='$Batch' AND SemesterID='$Semester' AND CourseID='$Course' "; 
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];

        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }       
         $exportstudy.="<th colspan=2>Credit : {$credit}</th>";
        }
   
}

  foreach ($SubjectsNew as $key => $SubjectsCodeop) {

  $amrikop = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCodeop' ANd Batch='$Batch'AND SemesterID='$Semester'";  
  
$list_resultamrikop = sqlsrv_query($conntest,$amrikop);  

while($row7op = sqlsrv_fetch_array($list_resultamrikop, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }
 
         $exportstudy.="<th colspan=5>Credit : {$credit}</th>";
            }
   
}

  $exportstudy.="<th colspan=2>Total Credit :{$gtcerdit}
    
  </th></tr> 
    <tr>
   
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>Grade</th><th>Grade Point</th>";
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
         <th>{$SrNo}</th>
        
         <th>{$UnirollNos}</th>";

         

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
                                     $grace= $row_exam['Grace'];

 include 'result-pages/grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";

$exportstudy.="<th style='color:{$color}'>{$grade}</th>"; 
$exportstudy.="<th style='color:{$color}'>{$gardep} </th>";


  $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
            }


 if(is_numeric($credit))
        {
        $totalcredit=$totalcredit+$credit;
    }
    else
    {
       $credit =0;
    }
 //$exportstudy.="<td style='text-align:center;'>{$credit} </td>";  

if($credit>0)
{
    if(is_numeric($gardep))
    {$gardep=$gardep;}else{$gardep=0;}
    
     $gradevalue=$gardep*$credit;

 if($gradevalue>0)
 {
$gradevaluetotal=$gradevaluetotal+$gradevalue;
 }
 else
 {
   

    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}

} 
else
{
$exportstudy.="<th>NA</th>"; 
$exportstudy.="<th>NA</th>";
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
                                     $grace= $row_exam['Grace'];
                                     include 'result-pages/grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";
$exportstudy.="<th style='color:{$color}'>{$grade} </th>"; 
$exportstudy.="<th style='color:{$color}'>{$gardep}</th>";

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}   
else
{
$exportstudy.="<th >NA</th>"; 
$exportstudy.="<th >NA</th>";
}

}


 $exportstudy.="<th>{$totalcredit} </th>"; 

 $sgpa=$gradevaluetotal/$totalcredit;


    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<th style='color:{$color}'>NC </th>";

}
else
 { $exportstudy.="<th>{$sgpa} </th>";}  

//$exportstudy.="<th>{$nccount} </th>";

          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


include 'result-pages/resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 




 else if($exportCode==65)
{
    include 'result-pages/result-subject-bind-new2.php';

$subCount=(count($Subjects)*5)+6;
$subCount1=count($Subjects);
$exportstudy="<table class='table' border='1'>     <thead>";
include 'result-pages/resultcopyheader.php';

$exportstudy.="
    <tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=5>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
}

$exportstudy.="<th colspan=2>Grade Detail
    
  </th></tr>  

   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
     $gtcerdit=0;


    foreach ($Subjects as $key => $SubjectsCode) {

  $amrikc = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCode' ANd Batch='$Batch'AND SemesterID='$Semester' AND CourseID='$Course'";  

$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }
 
         $exportstudy.="<th colspan=5>Credit : {$credit}</th>";
            }
   
}

    foreach ($SubjectsNew as $key => $SubjectsCodeop) {

  $amrikop = "SELECT Distinct NoOFCredits FROM MasterCourseStructure where SubjectCode='$SubjectsCodeop' ANd Batch='$Batch'AND SemesterID='$Semester'";  
  
$list_resultamrikop = sqlsrv_query($conntest,$amrikop);  

while($row7op = sqlsrv_fetch_array($list_resultamrikop, SQLSRV_FETCH_ASSOC) )
         {
        $credit=$row7c['NoOFCredits'];
        if(is_numeric($credit))
        {
        $gtcerdit=$gtcerdit+$credit;
        }
 
         $exportstudy.="<th colspan=5>Credit : {$credit}</th>";
            }
   
}


  $exportstudy.="<th colspan=2>Total Credit :{$gtcerdit}
    
  </th></tr>   <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>";
    foreach ($Subjects as $key => $SubjectsCode) {
    
    $exportstudy.="<th>CE1/CE3/Att/MST1/MST2/ESE(Grace)</th><th>Marks</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
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
                                      $grace= $row_exam['Grace'];
        include 'result-pages/grade_calculator.php';                              

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

        if(is_numeric($credit))
        {
        $totalcredit=$totalcredit+$credit;
    }
    else
    {
       $credit =0;
    }




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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
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
                                      $grace= $row_exam['Grace'];
                                     include'result-pages/grade_calculator.php';

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
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
 $exportstudy.="<td style='text-align:center;'>{$totalcredit} </td>"; 

if($totalcredit>0)
{
  $sgpa=$gradevaluetotal/$totalcredit;   
}
else
{
   $sgpa=0; 
}


    $sgpa= number_format($sgpa,2);

if($nccount>0)
{
$exportstudy.="<td style='text-align:center;color:{$color}'>NC</td>";

}
else
 { $exportstudy.="<td style='text-align:center;'>{$sgpa} </td>";}  

//$exportstudy.="<td style='text-align:center;'>{$nccount} </td>";

          $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }

include 'result-pages/resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 


//csv
 else if($exportCode==66)
{

//include 'result-pages/result-subject-bind-new.php';
include 'result-pages/result-subject-bind-new2.php';





$subCount=(count($Subjects)*5)+4;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1'><thead>"; 
 $exportstudy.="<tr><th colspan='".$subCount."' ><b style='font-size:22px;'>GURU KASHI UNIVERSITY, TALWANDI SABO, BATHINDA (PUNJAB) RESULT NOTIFICATION No. GKU/COE/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;".$Examination."&nbsp;&nbsp;EXAMINATION</b></th></tr>"; 
     $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:16px;text-align:left;'>  &nbsp;&nbsp;&nbsp; Programme:&nbsp;&nbsp;&nbsp;".$CourseName."&nbsp;&nbsp;&nbsp;
    <b style='text-align:center;font-size:16px;'>   &nbsp;&nbsp;&nbsp;Semester:&nbsp;&nbsp;&nbsp;".$Semester."</b>(".$Type.")  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Batch &nbsp;&nbsp;&nbsp;: <b style='text-align:right;'>".$Batch."</b></th></tr>";
    $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th></tr>";
$exportstudy.="<tr><th>SrNo</th><th>UniRoll No</th>";

    foreach ($Subjects as $key => $SubjectsCode) {
$exportstudy.="<th>Subject Name</th><th>Subject Code</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
}
$exportstudy.="<th>Total Credit</th><th>SGPA</th></tr></thead>"; 

    $list_sql = "SELECT ExamForm.AcceptType, ExamForm.ID,Admissions.UniRollNo,Admissions.ClassRollNo,Admissions.StudentName,Admissions.IDNo FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo where ExamForm.CollegeID='$College' AND ExamForm.CourseID='$Course'AND ExamForm.Batch='$Batch' AND ExamForm.Type='$Type' AND ExamForm.Sgroup='$Group'  ANd ExamForm.SemesterID='$Semester' ANd ExamForm.Examination='$Examination'  ANd ExamForm.Status='8'  ORDER BY Admissions.UniRollNo  ";
            $j=0;
             $list_result = sqlsrv_query($conntest,$list_sql);
                            $count = 1;
                      if($list_result === false)
                        {
                       die( print_r( sqlsrv_errors(), true) );
                       }
                        while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                           {
                         $IDNos=$row['IDNo'];

                        $UnirollNos=$row['UniRollNo'];
                          $AcceptType=$row['AcceptType'];
                        $ClassRollNos=$row['ClassRollNo'];
                         $Examid=$row['ID'];
                         $StudentNames =$row['StudentName'];     
           $exportstudy.="<tr><td>{$SrNo}</td><td>{$UnirollNos}</td>";
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
                                     $grace= $row_exam['Grace'];


include'result-pages/grade_calculator.php';

if($AcceptType>0)
{ 
  $grade='RLF' ; 
  $gardep=0;
   $color ='red';
   $showgradefail='';
}



$exportstudy.="<td style='text-align:center;color:{$color}'>{$subjectName}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$SubjectCode}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade} {$showgradefail}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep}</td>";

 $amrikc = "SELECT * FROM MasterCourseStructure where CollegeID='$College' AND CourseID='$Course' AND Batch='$Batch' ANd SubjectCode='$Subjects[$sub]'";  
$list_resultamrikc = sqlsrv_query($conntest,$amrikc);  

while($row7c = sqlsrv_fetch_array($list_resultamrikc, SQLSRV_FETCH_ASSOC) )
         {
       $credit=$row7c['NoOFCredits'];
         }
       

if(is_numeric($credit))
        {
        $totalcredit=$totalcredit+$credit;
    }
    else
    {
       $credit =0;
    }
 $exportstudy.="<td style='text-align:center'>{$credit} </td>";  

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
}     

else
{
$exportstudy.="<td style='text-align:center'>NA</td><td style='text-align:center'>NA</td><td style='text-align:center'>NA</td><td style='text-align:center'>NA</td><td style='text-align:center'>NA</td>"; 
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
                                      $grace= $row_exam['Grace'];

include'result-pages/grade_calculator.php';
$exportstudy.="<td style='text-align:center;color:{$color}'>{$subjectName}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$SubjectCode}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$grade}{$showgradefail}</td>";
$exportstudy.="<td style='text-align:center;color:{$color}'>{$gardep}</td>";

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
    if($grade=='F' || $grade=='US')
    {
    $nccount++;
    }
 }
}
else
{

}

}  
else
{
$exportstudy.="<td style='text-align:center'>NA </td>";
$exportstudy.="<td style='text-align:center'>NA</td>"; 
$exportstudy.="<td style='text-align:center'>NA </td>";
 $exportstudy.="<td style='text-align:center'>NA </td>"; 
 $exportstudy.="<td style='text-align:center'>NA </td>"; 
}
}



$exportstudy.="<td style='text-align:center;'>{$totalcredit} </td>"; 

if($totalcredit>0)
{
  $sgpa=$gradevaluetotal/$totalcredit;   
}
else
{
   $sgpa=0; 
}


// $sgpa=$gradevaluetotal/$totalcredit;


 $sgpa= number_format($sgpa,2);


if($nccount>0)
{
$exportstudy.="<td style='text-align:center;color:{$color}'>NC </td>";
}
else

 { 
if($AcceptType>0)
{
  $sgpa='RLF'; 
   
}


    $exportstudy.="<td style='text-align:center;'>{$sgpa}</td>";}  
   $exportstudy.="</tr>";
    $SrNo++; } $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 
     
 // marks
else if($exportCode==67)
{
    include 'result-pages/result-subject-bind-new.php';

$subCount=count($Subjects)+4;
$subCount1=count($Subjects);

$exportstudy="<table class='table' border='1'>
        <thead>  
        <tr> ";
include'result-pages/resultcopyheader.php';


$exportstudy.="<tr>
    <th>SrNo</th>
    <th>ClassRoll No </th>
    <th>UniRoll No</th>
    <th>Name </th>
   ";
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
  
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
                                     $grace= $row_exam['Grace'];
                                    
                                   

 include 'result-pages/grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";

$exportstudy.="<td style='text-align:center;color:{$color}'><b>{$printmark}</b></td>"; 





} 
else
{
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
                                     $grace= $row_exam['Grace'];

                                     include 'result-pages/grade_calculator.php';
//$exportstudy.="<td style='text-align:center;'>{$totalFinal} </td>";
$exportstudy.="<td style='text-align:center;color:{$color}'><b>{$printmark}</b> </td>"; 




}   
else
{
$exportstudy.="<td style='text-align:center'>NA</td>"; 

}

}




  $exportstudy.="</tr>";
                            
            $SrNo++;    

                        }


//include 'resultfooter.php';
                  
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    } 


    else if($exportCode==68)
    {

        

 $from = $_GET['from'];
 $to = $_GET['to'];
 $sr=1; 

  $get_pending = "
  SELECT DISTINCT 
        va.token_no, 
        va.journey_start_date,
        vt.name AS v_name, 
        va.name AS e_name,
        va.station AS station,
        va.purpose AS purpose,
        va.journey_end_date AS enddate,
        vbd.from_date AS fromDate,
        vbd.driver_id AS driverid
    FROM  vehicle_allotment_process AS vap 
    INNER JOIN  vehicle_allotment AS va ON vap.token_no = va.token_no 
    INNER JOIN   vehicle_types AS vt ON va.vehicle_type = vt.id 
    INNER JOIN  vehicle_book_details AS vbd ON vbd.TokenNo = va.token_no 
    WHERE  va.status = '5'  AND DATE(vbd.from_date) >= '$from'   AND DATE(vbd.from_date) <= '$to'
    ORDER BY  token_no DESC 
 LIMIT 100";
 
 
                 $get_pending_run=mysqli_query($conn,$get_pending);
               

$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
<tr>
<th>#</th>
<th>Employee Name</th>
<th>Driver</th>
<th>Vehicle Name</th>
<th>Station</th>
<th>Purpose</th>
<th>Departure Date/Time</th>
</tr>";
  $srno=1;
  while($get_row=mysqli_fetch_array($get_pending_run))
  {
    $sql1 = "SELECT * FROM Staff Where IDNo='".$get_row['driverid']."'";
    $q1 = sqlsrv_query($conntest, $sql1);
    if ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
    {
        $userName = $row['Name'];
    }
$exportstudy.="<tr>";
$exportstudy.="<td>{$srno}</td>
<td>{$get_row['e_name']}</td>
<td>{$userName}</td>
<td>{$get_row['v_name']}</td>
 <td>{$get_row['station']}</td>
 <td>{$get_row['purpose']}</td>
<td>{$get_row['fromDate']}</td>";

          $exportstudy.="</tr>"; 
          $srno++;
        }    
        $exportstudy.="</table>";

        echo $exportstudy;
        $fileName="vehiclereport";
}
    else if($exportCode==69)
    {
 $from = $_GET['from'];
 $to = $_GET['to'];
 $sr=1; 

 $date=date('Y-m-d');
    $select_add="SELECT * FROM Enquiry where DateEntry BETWEEN '$from 01:09:28.000' and '$to 23:09:28.000'";

                 $select_add_q=sqlsrv_query($conntest,$select_add);
               

$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
<tr>
<th>#</th>
<th>Name</th>
<th>Mobile No</th>
<th>Email</th>
<th>Course</th>
<th>Source</th>
<th>SourceName</th>
<th>Token No</th>
<th>Counter No</th>
<th>Response</th>
<th>Entry Date</th>
</tr>";

while($row=sqlsrv_fetch_array($select_add_q,SQLSRV_FETCH_ASSOC))
{
if($row['Response']!='')
{
$color='#8ccb8c';
}
else
{
$color='#e5070761';
}
$dateEntry=$row['DateEntry']->format('d-m-Y H:i:s');
$exportstudy.="<tr>";
$exportstudy.="
<td>{$sr}</td>
<td>{$row['Name']}</td>
<td>{$row['MobileNo']}</td>
<td>{$row['Email']}</td>
<td>{$row['Course']}</td>
<td>{$row['Source']}</td>
<td>{$row['SourceName']}</td>
<td>{$row['TokenNo']}</td>
<td>{$row['CounterNo']}</td>
<td>{$row['Response']}</td>
<td>{$dateEntry}</td>";
$exportstudy.="</tr>"; 
$sr++;
        }    
        $exportstudy.="</table>";
        echo $exportstudy;
        $fileName="admenquiry";
    
}


else if($exportCode==70)
{
    $CollegeID=$_POST['CollegeName'];
    $CourseID=$_POST['Course1'];
    $Batch=$_POST['Batch'];
    $Session=$_POST['session1'];
   $CollegeName='';
   $CourseName='';
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
$subCount=23;
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
    <th>Religion </th>
     <th>Gender</th>
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
    <th>Status</th>
    <th>Locked</th>

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
            $query .= " AND LateralEntry='$LateralEntry' AND Nationality='NRI'  Order By ClassRollNo ";
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
            $Religion=$row['Religion'];
            $gender=$row['Sex'];
             $locked=$row['Locked'];
            if($StatusType>0)
            {
                $StatusType='Provisional';

            }
            else
            {
                $StatusType='';

            }


 if($locked>0)
            {
                $lockedtype='Yes';

            }
            else
            {
                $lockedtype='No';

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
            else
            {
                $status=$StatusType." Left";
                $clr1="red";
            }



         
         $exportstudy.="<tr>

         <td>{$SrNo}</td>
         <td>{$IDNo}</td>
         <td>{$ClassRollNo}</td>
         <td>{$UniRollNo}</td>
         <td>{$StudentName}</td>
         <td>{$FatherName}</td>
         <td>{$MotherName}</td>
         <td>{$StudentMobileNo}</td>
         <td>{$Category}</td>
          <td>{$Religion}</td>
           <td>{$gender}</td>
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

           <td>{$lockedtype}</td>     
     </tr>";


$SrNo++;
         }
         

    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="Student Report ";
}


      
else if($exportCode==71)
{
   
include 'result-pages/result-subject-bind-reappear.php';

$subCount=(count($Subjects)*2)+4;
$subCount1=count($Subjects);
$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
        <thead>";


 include 'result-pages/resultcopyheader.php';
 
$exportstudy.="<tr>
    <th>SrNo</th>
    <th>UniRoll No</th> ";
    // print_r($SubjectNames);
foreach ($Subjects as $key => $SubjectsCode) {
    $exportstudy.="<th colspan=2>".$SubjectNames[$key]." / ".$SubjectsCode." </th>";
}
$exportstudy.="<th>Total Credit</th><th>SGPA</th>";
$exportstudy.="</tr>";


 $sql1 = "SELECT  *  FROM ResultPreparation WHERE Examination='$Examination' and CollegeID='$College' and CourseID='$Course' and Batch='$Batch' and Semester='$Semester'";
 $stmt = sqlsrv_query($conntest,$sql1);

 
        $SrNo=1;
     while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC))
     {   
      $ID=$row['Id']; 
      $UniRollNo=$row['UniRollNo']; 
      $exportstudy.="<tr>
      <th>{$SrNo}</th>
      <th>{$UniRollNo}</th> ";
foreach ($Subjects as $key => $SubjectsCode) {
 $fatchMarks="SELECT  * FROM  ResultPreparationDetail WHERE  ResultID='$ID' and SubJectCode='$SubjectsCode' ";
    $RunfatchMarks=sqlsrv_query($conntest,$fatchMarks);
    if($RowfatchMarks=sqlsrv_fetch_array($RunfatchMarks,SQLSRV_FETCH_ASSOC))
    {  
    $SubjectGrade=$RowfatchMarks['SubjectGrade'];
    $SubjectGradePoint=$RowfatchMarks['SubjectGradePoint'];
    $SubjectCredit=$RowfatchMarks['SubjectCredit'];
    // $SubjectName=$RowfatchMarks['SubjectName'];
    // $SubjectCode=$RowfatchMarks['SubjectCode'];
    $exportstudy.="
        <th>{$SubjectGrade}</th>
        <th>{$SubjectGradePoint}</th> ";
      } 
      else{
        $exportstudy.="
        <th>NA</th>
        <th>NA</th> ";
      }
    }


    $exportstudy.="
<th>".$row['TotalCredit']."</th>
<th>".$row['Sgpa']."</th>";
     $exportstudy.="</tr>";
     $SrNo++;    
}
// $sgpa= number_format($sgpa,2);
// $exportstudy.="</tr>";
include 'result-pages/resultfooter.php';            
$exportstudy.="</table>";
echo $exportstudy;
$fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;

}

else if($exportCode==72)
      {
      
    //   include 'result-pages/result-subject-bind.php';
      include 'result-pages/result-subject-bind-new2.php';
      $subCount=(count($Subjects)*5)+4;
      $subCount1=count($Subjects);
      
      $exportstudy="<table class='table' border='1'><thead>"; 
       $exportstudy.="<tr><th colspan='".$subCount."' ><b style='font-size:22px;'>GURU KASHI UNIVERSITY, TALWANDI SABO, BATHINDA (PUNJAB) RESULT NOTIFICATION No. GKU/COE/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;".$Examination."&nbsp;&nbsp;EXAMINATION</b></th></tr>"; 
           $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:16px;text-align:left;'>  &nbsp;&nbsp;&nbsp; Programme:&nbsp;&nbsp;&nbsp;".$CourseName."&nbsp;&nbsp;&nbsp;
          <b style='text-align:center;font-size:16px;'>   &nbsp;&nbsp;&nbsp;Semester:&nbsp;&nbsp;&nbsp;".$Semester."</b>(".$Type.")  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Batch &nbsp;&nbsp;&nbsp;: <b style='text-align:right;'>".$Batch."</b></th></tr>";
          $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th></tr>";
      $exportstudy.="<tr><th>SrNo</th><th>UniRoll No</th>";
      
          foreach ($Subjects as $key => $SubjectsCode) {
           
      $exportstudy.="<th>Subject Name</th><th>Subject Code</th><th>Grade</th><th>Grade Point</th><th>Credit</th>";
      }
      $exportstudy.="<th>Total Credit</th><th>SGPA</th></tr></thead>";
    //   $exportstudy.="</tr>";
    $group = $_GET['Group'];
    $CourseID = $_GET['Course'];
     $CollegeID = $_GET['CollegeId'];
     $Batch=$_GET['Batch']; 
     $semID = $_GET['Semester'];
     $exam = $_GET['Examination'];
    $sql1 = "SELECT  DISTINCT UniRollNo,Id,TotalCredit,Sgpa FROM ResultPreparation WHERE Examination='$exam' and CollegeID='$CollegeID' and CourseID='$CourseID' and Batch='$Batch' and Semester='$semID'";
    $stmt = sqlsrv_query($conntest,$sql1);
        $SrNo=1;
     while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){   
      $ID=$row['Id']; 
      $UniRollNo=$row['UniRollNo']; 
      $exportstudy.="<tr>
      <th>{$SrNo}</th>
      <th>{$UniRollNo}</th> ";
      $queryR = "SELECT * FROM Admissions inner join ResultGKU on Admissions.UniRollNo=ResultGKU.UniRollNo Where 
      Admissions.UniRollNo='$UniRollNo'  and Semester='$Semester' order by  Admissions.IDNo ASC ";
                 $resultR = sqlsrv_query($conntest,$queryR);
                 while($rowR = sqlsrv_fetch_array($resultR, SQLSRV_FETCH_ASSOC) )
                 {
  $getSub="SELECT * from ResultGKU as RG inner join ResultDetailGKU as RDG ON RG.Id=RDG.ResultID WHERE RDG.ResultID='".$rowR['Id']."' ";
$stmtgetSub = sqlsrv_query($conntest,$getSub);
while($rowS = sqlsrv_fetch_array($stmtgetSub,SQLSRV_FETCH_ASSOC)){ 
      $fatchMarks="SELECT  * FROM  ResultPreparationDetail WHERE  ResultID='$ID' and SubJectCode='".$rowS['SubjectCode']."' ";
       $RunfatchMarks=sqlsrv_query($conntest,$fatchMarks);
       if($RowfatchMarks=sqlsrv_fetch_array($RunfatchMarks,SQLSRV_FETCH_ASSOC))
       {  
    $SubjectGrade=$RowfatchMarks['SubjectGrade'];
    $SubjectGradePoint=$RowfatchMarks['SubjectGradePoint'];
    $SubjectCredit=$RowfatchMarks['SubjectCredit'];
    $SubjectName=$RowfatchMarks['SubjectName'];
    $SubjectCode=$RowfatchMarks['SubjectCode'];
    $exportstudy.="
    <th>".$SubjectName."</th>
    <th>".$SubjectCode."</th> 
    <th>{$SubjectGrade}</th>
    <th>{$SubjectGradePoint}</th> 
    <th>{$SubjectCredit}</th> ";
      } 
      else{
        $exportstudy.="
        <th>NA</th>
        <th>NA</th>
        <th>NA</th>
        <th>NA</th>
        <th>NA</th>
        ";
    }
    
}
                 }
$exportstudy.="
<th>".$row['TotalCredit']."</th>
<th>".$row['Sgpa']."</th>

";
$SrNo++;
}
$exportstudy.="</tr>";

      $exportstudy.="</table>";
echo $exportstudy;
$fileName=$CourseName."-".$Batch."-".$Semester."-".$Type.'-'.$Examination;
    }

else if($exportCode==73)
{
    $StartDate=$_POST['StartDate'];
    $EndDate=$_POST['EndDate'];
    $exportstudy = '';
$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'>
<thead>    
    <tr style='background-color:black; color:white;'>
    <th>SrNo</th>
    <th>Date Of Admissions </th>
    <th>ClassRoll No </th>
    <th>Name </th>
    <th>Father Name </th>
    <th>Mother Name </th>
    <th>Gender </th>
    <th>Mobile No </th>
    <th>Aadhar card  No </th>
    <th>Category </th>
    <th>Scholarship </th>
    <th>EmailID </th>
    <th>College </th>
    <th>Course </th>
    <th>Batch </th>
    <th>Country </th>
    <th>State </th>
    <th>District </th>
    <th>Remarks </th>
    <th>Refrence</th>
    <th>Team</th>
    <th>Consultant</th>
    </tr>
        </thead>";
       
        $SrNo = 1;
      
        $StartDate = date('Y-m-d', strtotime($StartDate)); 
        $EndDate = date('Y-m-d', strtotime($EndDate)); 
        
        $query = "SELECT * FROM Admissions WHERE AdmissionDate BETWEEN ? AND ? ORDER BY IDNo";
        $params = array("$StartDate 01:00:00", "$EndDate 23:59:00");
        $result = sqlsrv_query($conntest, $query, $params); 
        if ($result === false) {
            die(print_r(sqlsrv_errors(), true)); // Handle query error
        } 
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $IDNo = $row['IDNo'];
            $ClassRollNo = $row['ClassRollNo'];
            $UniRollNo = $row['UniRollNo'];
            $StudentName = $row['StudentName'];
            $FatherName = $row['FatherName'];
            $MotherName = $row['MotherName'];
            $StudentMobileNo = $row['StudentMobileNo'];
            $AdharcardNo = $row['AadhaarNo'];
            $EmailID = $row['EmailID'];
            $CollegeName = $row['CollegeName'];
            $Course = $row['Course'];
            $Batch = $row['Batch'];
            $Ereason = $row['EligibilityReason'];
            $Country = $row['country'];
            $State = $row['State'];
            $StatusType = $row['StatusType'];
            $District = $row['District'];
            $Nationality = $row['Nationality'];
            $Refrence = $row['FeeWaiverScheme'];
            $Category = $row['Category'];
            $commentdetail = $row['CommentsDetail'];
            $Scholarship = $row['ScolarShip'];
            $gender = $row['Sex'];
            $AdmissionDate = $row['AdmissionDate']->format('d-m-Y');
            $locked = $row['Locked'];
        
            $exportstudy .= "<tr>
                <td>{$SrNo}</td>
                <td>{$AdmissionDate}</td>
                <td>{$ClassRollNo}</td>
                <td>{$StudentName}</td>
                <td>{$FatherName}</td>
                <td>{$MotherName}</td>
                <td>{$gender}</td>
                <td>{$StudentMobileNo}</td>
                <td>{$AdharcardNo}</td>
                <td>{$Category}</td>
                <td>{$Scholarship}</td>
                <td>{$EmailID}</td>
                <td>{$CollegeName}</td>
                <td>{$Course}</td>
                <td>{$Batch}</td>
                <td>{$Nationality}</td>
                <td>{$State}</td>     
                <td>{$District}</td>
                <td>{$commentdetail}</td>
                <td>";
            $query3 = "SELECT Name, IDNo FROM MasterConsultantRef AS mcr INNER JOIN Staff AS s ON mcr.RefIDNo = s.IDNo WHERE mcr.StudentIDNo = '$IDNo' AND mcr.Type = 'Staff'";
            $result3 = sqlsrv_query($conntest, $query3);
            while ($row3 = sqlsrv_fetch_array($result3, SQLSRV_FETCH_ASSOC)) {
                $idno = $row3['IDNo'];
                $name = $row3['Name'];
                $exportstudy .= "{$idno} ({$name})<br>";
            }

            $exportstudy.="</td><td>";
            $query2 = "Select * from  MasterConsultantRef as mcr inner join Staff as s on mcr.RefIDNo=s.IDNo where StudentIDNo='$IDNo' AND mcr.Type='Staff'";
            $result2 = sqlsrv_query($conntest,$query2);
            while($row2 = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC) )
            {      
                $idnoR = $row2['ID'];
                $nameR = $row2['Name'];
                $exportstudy .= "{$idnoR} ({$nameR})<br>";
            }
            $exportstudy.="</td><td>";
             $query2 = "Select * from  MasterConsultantRef as mcr inner join MasterConsultant as s on mcr.RefIDNo=s.ID where StudentIDNo='$IDNo' AND mcr.Type='Consultant'";
            $result2 = sqlsrv_query($conntest,$query2);
            while($row21 = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC) )
            {      
                $idnoC = $row21['ID'];
                $nameC = $row21['Name'];
                $exportstudy .= "{$nameC}<br>";
            }
            $exportstudy .= "</td></tr>";
            $SrNo++;
        }
        
        
//              $exportstudy.="</td></table></td><td> <table>";
//             $query2 = "Select * from  MasterConsultantRef as mcr inner join Staff as s on mcr.RefIDNo=s.IDNo where ID='$IDNo' AND mcr.Type='Staff'";
//             $result2 = sqlsrv_query($conntest,$query2);
//        while($row2 = sqlsrv_fetch_array($result2, SQLSRV_FETCH_ASSOC) )
//         {      
//             $exportstudy.="<tr><td>";
//             {$dd=$row2['ID'];}
//             {$row2['Name'];}
//              $exportstudy.="</td></tr>";
   
//             }
        // $exportstudy.="</td></tr>";
// $SrNo++;
//          }
         

    $exportstudy.="</table>";
    echo $exportstudy;
    $fileName="Student Report ";
}

elseif ($exportCode == 74)
{
    $RoomType = $_POST['roomTypeID'];
    $officeID = $_POST['office_ID'];
    echo 'Sr No' . "\t" . 'Article' . "\t" . 'Article ID' . "\t" . 'Specifications' . "\t" . 'Storage' . "\t" . 'Brand' . "\t" . 'OS' . "\t" . 'Memory' . "\t" . 'Model' . "\t" . 'Block' . "\t" . 'Floor' . "\t" . 'Room No' . "\t" . 'Room Type' . "\t" . 'Room Name' . "\t" . 'Employee ID' . "\t" . 'Employee Name' . "\t" . 'Designation' . "\t" . 'Department' . "\n";
    $building_num = 0;
    // $building="  SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode  INNER JOIN stock_summary s ON s.ArticleCode=a.ArticleCode order by IDNo DESC ";
    $building = "SELECT * FROM stock_summary  inner join location_master on stock_summary.LocationID=location_master.ID inner join master_calegories on stock_summary.CategoryID=master_calegories.ID inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode left join user on user.emp_id=stock_summary.Corrent_owner where stock_summary.Status='2' and location_master.Block='$RoomType'" ;
  // and location_master.ID='$officeID' order by IDNo DESC";
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
else if($exportCode==75)
{
  $CollegeID=array();
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
      <th style='background-color:black; color:white;'>Type</th>
      <th style='background-color:black; color:white;'>Examination</th>
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
                  
           $Type=$_REQUEST['Type'];
           $Batch=$_REQUEST['Batch'];
           $Semester=$_REQUEST['Semester'];
           $Examination=$_REQUEST['Examination'];
           $Confirmation=$_REQUEST['Confirmation'];

    $getCourse1=" SELECT Admissions.*,  ExamForm.Batch,ExamForm.SemesterId,ExamForm.Examination,ExamForm.Course,ExamForm.CourseID,ExamForm.Status as ExamStatus
    FROM Admissions Inner Join ExamForm ON Admissions.IDNo=ExamForm.IDNo Where  ExamForm.Examination='$Examination' and ExamForm.Type='$Type'";
    if($_REQUEST['Batch']!='')
    {
    $getCourse1.=" AND ExamForm.Batch='$Batch'"; 
    }
    if($_REQUEST['Semester']!='')
    {
     $getCourse1.="AND  ExamForm.SemesterId='$Semester'"; 
    }
    if($_REQUEST['Confirmation']=='Yes')
    {
     $getCourse1.="AND  ExamForm.CourseID!='188'"; 
    }
     $getCourse1.="order by ExamForm.Batch ASC ";
    //  echo $getCourse1;
 $getCourseRun1=sqlsrv_query($conntest,$getCourse1);
 while($row = sqlsrv_fetch_array($getCourseRun1, SQLSRV_FETCH_ASSOC))
 { 
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
                                        <td>{$Type}</td>
                                        <td>{$Examination}</td>
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
                     $fileName="All Students Exam Form ";
                 
            }


 else if($exportCode==76)
    {
 $course = $_GET['course'];
 $college = $_GET['college'];
 $batch=$_GET['batch']; 
 $semID = $_GET['sem'];
 $session = $_GET['session'];
 
      $category = $_GET["category"];
$list_sql="SELECT * FROM Admissions WHERE 1=1 ";
if($college!=''){
 $list_sql.= " AND CollegeID='$college' ";
}
if($course!=''){
$list_sql.= "AND CourseID='$course'";
}
if($batch!=''){
$list_sql.= "AND Batch='$batch'";
} 
if($session!=''){
$list_sql.= "AND Session='$session' ";
}
if($category!=''){
$list_sql.= "AND Category='$category' ";
}
$list_sql.= "AND Status='1' AND Batch='$batch' ANd Nationality='NRI'  Order BY ClassRollNo ASC";


$q1 = sqlsrv_query($conntest,$list_sql);



$exportstudy="<table class='table' border='1' style=' font-family: 'Times New Roman', Times, serif;'><tr><td>Sr No</td><td>Session</td><td>IDNo</td><td>UniRollNo</td><td>Class RollNO</td><td>Name</td>
  <td>Father Name</td> <td>Course</td> <td>Batch</td><td>Fee Category</td><td>Debit</td><td>Credit</td><td>Balance</td></tr>";

  $srno=1;
        while ($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
        {
$idno=$row['IDNo'];
$exportstudy.="<tr>";

$exportstudy.="<td>{$srno}</td><td>{$row['Session']}</td><td>{$row['IDNo']}</td><td>{$row['ClassRollNo']}</td> <td>{$row['UniRollNo']}</td>
<td>{$row['StudentName']}</td><td>{$row['FatherName']}</td><td>{$row['Course']}</td><td>{$row['Batch']}</td><td>{$row['FeeCategory']}</td>";
 
$Admiss2="SELECT sum(Debit) as totaldebit ,sum(Credit)as totalcredit from ledger   WHERE 1=1" ; 
if($semID!='')
{
 $Admiss2.= " AND SemesterID<='$semID' ";
}
$Admiss2.="AND IDNo='$idno'";

$q2 = sqlsrv_query($conntest, $Admiss2);
 while ($dataw = sqlsrv_fetch_array($q2, SQLSRV_FETCH_ASSOC)) 
 {
  
$tdebit=$dataw['totaldebit'];
$tcredit=$dataw['totalcredit'];
$balanceamount=$tdebit-$tcredit;
$exportstudy.="<td>{$tdebit}</td><td>{$tcredit}</td><td>{$balanceamount}</td>";

 }

          $exportstudy.="</tr>"; 
          $srno++;
        }    
        $exportstudy.="</table>";

        echo $exportstudy;
        $fileName="StudentLedger";
    
}


 else if($exportCode==77)
{
  $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND remarks='4th Convocation'");
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
      $purpose=$row['remarks'];
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
$Course=$rowb['Course'];
 
       
            $exportMeter.="<tr>
             <td>{$count}</td>
             <td>{$collegename}</td>
                 <td>{$Course}</td>
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

 elseif($exportCode=='78')
{
    
    $Status=$_GET['Status'];

    if($Status==1)
      {
         $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND remarks='4th Convocation' AND  account_verification>'0' ANd account_verification!='2' ");
      }
      
      else
      {
       
  $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND remarks='4th Convocation' AND  account_verification='$Status'");
        } 
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
           <th>Course Type</th>
         
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
      $purpose=$row['remarks'];
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


  $query1="Select CollegeName,Course,CourseID,Batch,IDNo,UniRollNo,StudentName,FatherName,EmailID,StudentMobileNo  from Admissions  where  UniRollNo='$Designation'";


  

$stmt2 = sqlsrv_query($conntest,$query1);

if( $stmt2  === false) {

    die( print_r( sqlsrv_errors(), true) );
}
else
{
 while($rowb = sqlsrv_fetch_array($stmt2))
     {
$courseid=$rowb['CourseID'];

$query1t="Select  top(1) CourseType from MasterCourseCodes where CourseID='$courseid' order by Id desc";
$stmtt = sqlsrv_query($conntest,$query1t);
 while($rowt = sqlsrv_fetch_array($stmtt))
     {
        $CourseType=$rowt['CourseType'];
     }

$collegename= $rowb['CollegeName'];
 $batch=$rowb['Batch'];
 $father_name=$rowb['FatherName'];
 $Course=$rowb['Course'];

 
       
            $exportMeter.="<tr>
             <td>{$count}</td>
             <td>{$collegename}</td>
                 <td>{$Course}</td>
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
                 <td>{$CourseType}</td>

               
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
 elseif($exportCode=='79')
{
    

  
    $counter = 1; 
     
    
        
    $exportMeter="<table class='table' border='1'>
        <thead>
                <tr color='red'>
          <th>Sr. No</th>
       
      
       
         <th>Uni Roll No</th>
          <th>Name</th>
          <th>Father Name</th>
          
           <th>Program</th>
         <th> Batch</th>
             
         
          <th>Email</th> 
             <th>Phone</th>
       
       
         
         </tr>
        </thead>";
       

         $count=1;
    
     $result = mysqli_query($connection_web_in_website,"SELECT * FROM alumni where id>682781  ");
    $counter = 1; 
        while($row=mysqli_fetch_array($result)) 
        {
      $id = $row['id'];
      $image = $row['image'];
     // $payment_id = $row['payment_id'];
      $name = $row['name'];
      $father_name = $row['father_name'];
      $roll_no = $row['uni_roll_no'];
      $course = $row['course'];
     // $sem = $row['sem'];
      $batch=$row['batch'];
      $purpose=$row['gender'];
      $remarks='';
      $status=$row['status'];
      $Created_date='';
      $Created_time='';
      $amount='';
      $email = $row['email'];
      $phone = $row['wmobile_no'];


  
     
            $exportMeter.="<tr>
             <td>{$count}</td>
           
                
             
              <td>{$roll_no}</td>
                  <td>{$name}</td>
                <td>{$father_name}</td>
                 <td>{$course}</td>
                 <td>{$batch}</td>
                   <td>{$email}</td>
                <td>{$phone}</td>
               
               
               
                

               
            </tr>";
 $count++;
    }
    
    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;
    $fileName="Report";


}
elseif($exportCode=='80')
{
    
    $Status=$_GET['Status'];
   
  $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND remarks='4th Convocation' AND  attending='$Status'");
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
           <th>Course Type</th>
          <th>Status</th>
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

     $statusn= $row['account_verification'];

  if($statusn=='1')
  {
     $Statusprint='Pending at Registration Branch';
  }else if($statusn=='3'){
    $Statusprint='Rejected  by  Registration Branch';
  }
  else if($statusn=='4'){
    $Statusprint='Verified  by  Registration Branch';
  }
  else
  {$Statusprint='';}

      $Organisation = $row['course'];
      $IdNo = $row['Class_rollno'];
      $batch=$row['batch'];
      $purpose=$row['remarks'];
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


  $query1="Select CollegeName,Course,CourseID,Batch,IDNo,UniRollNo,StudentName,FatherName,EmailID,StudentMobileNo  from Admissions  where  UniRollNo='$Designation'";


  

$stmt2 = sqlsrv_query($conntest,$query1);

if( $stmt2  === false) {

    die( print_r( sqlsrv_errors(), true) );
}
else
{
 while($rowb = sqlsrv_fetch_array($stmt2))
     {
$courseid=$rowb['CourseID'];

$query1t="Select  top(1) CourseType from MasterCourseCodes where CourseID='$courseid' order by Id desc";
$stmtt = sqlsrv_query($conntest,$query1t);
 while($rowt = sqlsrv_fetch_array($stmtt))
     {
        $CourseType=$rowt['CourseType'];
     }

$collegename= $rowb['CollegeName'];
 $batch=$rowb['Batch'];
 $father_name=$rowb['FatherName'];
 $Course=$rowb['Course'];

 
       
            $exportMeter.="<tr>
             <td>{$count}</td>
             <td>{$collegename}</td>
                 <td>{$Course}</td>
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
                 <td>{$CourseType}</td>
                  <td>{$Statusprint}</td>

               
            </tr>";
$count++;
    }
    }
}
    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;
    $fileName="Eligibility Report";


}
elseif($exportCode=='80.1')
{
    
    $Status=$_GET['Status'];
    $CollegeName=$_GET['CollegeName'];
      $qry = "SELECT * FROM online_payment WHERE status='success' AND remarks='4th Convocation'";
      if ($Status !== 'All') {
          $qry .= " AND attending='$Status'";
      }
      if ($CollegeName != 'All') {
          $qry .= " AND CollegeName='$CollegeName'";
      }  
      $result=mysqli_query($conn_online,$qry);
//   $result = mysqli_query($conn_online,"SELECT * FROM online_payment where  status='success' AND remarks='4th Convocation' AND  attending='$Status'");
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
           <th>Course Type</th>
          <th>Status</th>
          <th>Present/Absent</th>
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
     $statusn= $row['account_verification'];
  if($statusn=='1')
  {
     $Statusprint='Pending at Registration Branch';
  }else if($statusn=='3'){
    $Statusprint='Rejected  by  Registration Branch';
  }
  else if($statusn=='4'){
    $Statusprint='Verified  by  Registration Branch';
  }
  else
  {$Statusprint='';}
$attending=$row['attending'];
  if($attending=='Yes')
        {
         $adstatus="Present";
        }
        else if($attending=='No')
        {
         $adstatus="Absent";
        }
        else{
$adstatus="Pending";
        }
      $Organisation = $row['course'];
      $IdNo = $row['Class_rollno'];
      $batch=$row['batch'];
      $purpose=$row['remarks'];
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


  $query1="Select CollegeName,Course,CourseID,Batch,IDNo,UniRollNo,StudentName,FatherName,EmailID,StudentMobileNo  from Admissions  where  UniRollNo='$Designation'";


  

$stmt2 = sqlsrv_query($conntest,$query1);

if( $stmt2  === false) {

    die( print_r( sqlsrv_errors(), true) );
}
else
{
 while($rowb = sqlsrv_fetch_array($stmt2))
     {
$courseid=$rowb['CourseID'];

$query1t="Select  top(1) CourseType from MasterCourseCodes where CourseID='$courseid' order by Id desc";
$stmtt = sqlsrv_query($conntest,$query1t);
 while($rowt = sqlsrv_fetch_array($stmtt))
     {
        $CourseType=$rowt['CourseType'];
     }

$collegename= $rowb['CollegeName'];
 $batch=$rowb['Batch'];
 $father_name=$rowb['FatherName'];
 $Course=$rowb['Course'];

 
       
            $exportMeter.="<tr>
             <td>{$count}</td>
             <td>{$collegename}</td>
                 <td>{$Course}</td>
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
                 <td>{$CourseType}</td>
                  <td>{$Statusprint}</td>
                  <td>{$adstatus}</td>

               
            </tr>";
$count++;
    }
    }
}
    $exportMeter.="</table>";
    //echo $exportMeterHeader;
    echo $exportMeter;
    $fileName="Convocation Final Report";


}

elseif ($exportCode == 81) {
   
    $CollegeName1 = $_GET['CollegeName1'] ?? '';
    $Course1 = $_GET['Course1'] ?? '';
    $Batch = $_GET['Batch'] ?? '';
    $session1 = $_GET['session1'] ?? '';
    $Lateral = $_GET['Lateral'] ?? '';
    $Status = $_GET['Status'] ?? '';
    $Eligibility = $_GET['Eligibility'] ?? '';

    $sr = 1;
    $select_add = "SELECT * FROM Admissions WHERE (BasicLocked = '1' OR BasicLocked = '0')";

    if ($CollegeName1 !== '') {
        $select_add .= " AND CollegeID = '" . addslashes($CollegeName1) . "'";
    }
    if ($Course1 !== '') {
        $select_add .= " AND CourseID = '" . addslashes($Course1) . "'";
    }
    if ($Batch !== '') {
        $select_add .= " AND Batch = '" . addslashes($Batch) . "'";
    }
    if ($session1 !== '') {
        $select_add .= " AND Session = '" . addslashes($session1) . "'";
    }
    if ($Status !== '') {
        $select_add .= " AND Status = '" . addslashes($Status) . "'";
    }
    if ($Eligibility !== '') {
        $select_add .= " AND Eligibility = '" . addslashes($Eligibility) . "'";
    }
    if ($Lateral !== '') {
        $select_add .= " AND LateralEntry = '" . addslashes($Lateral) . "'";
    }

    $select_add_q = sqlsrv_query($conntest, $select_add);


    if ($select_add_q === false) {
        die("Query failed: " . print_r(sqlsrv_errors(), true));
    }

    $exportstudy = "<table class='table' border='1' style='font-family: Times New Roman, Times, serif;'>
        <tr>
            <th>#</th>
            <th>ClassRollNo</th>
            <th>UniRollNo</th>
            <th>Name</th>
            <th>FatherName</th>
            <th>MotherName</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Adhaar Card</th>
            <th>Status</th>
        </tr>";

    while ($row = sqlsrv_fetch_array($select_add_q, SQLSRV_FETCH_ASSOC)) {
      
        $dob = isset($row['DOB']) && $row['DOB'] !== '' ? $row['DOB']->format('Y-m-d') : '';

        if ($row['BasicLocked'] != '1') {
            $color = '#8ccb8c';
            $status = "Unlocked";
        } else {
            $color = '#e5070761';
            $status = "Locked";
        }

        $exportstudy .= "
        <tr>
            <td>{$sr}</td>
            <td>{$row['ClassRollNo']}</td>
            <td>{$row['UniRollNo']}</td>
            <td>{$row['StudentName']}</td>
            <td>{$row['FatherName']}</td>
            <td>{$row['MotherName']}</td>
            <td>{$dob}</td>
            <td>{$row['Sex']}</td>
            <td>{$row['AadhaarNo']}</td>
            <td>{$status}</td>
        </tr>";
        $sr++;
    }

    $exportstudy .= "</table>";

   
    echo $exportstudy;

    $fileName = "Locked Basic Details";
}

header("Content-Disposition: attachment; filename=" . $fileName . ".xls");
unset($_SESSION['filterQry']);
ob_end_flush();