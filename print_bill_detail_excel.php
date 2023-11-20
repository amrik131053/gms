   <script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script> 


      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Guru Kashi University</title>
   
      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/adminlte.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
      <!-- ----------internet status ---------- -->
      <link rel="stylesheet" href="internet_status.css">
      <!-- ----------internet status end ---------- -->
      <link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
 <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
   <link rel="stylesheet" href="dist/css/jquery-ui.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

<link rel="stylesheet" href="plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-bootstrap/main.min.css">
  
<?php

include 'connection/connection.php';
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
  else
    {   
         $sql="SELECT distinct article_no,Name from meter_reading inner join location_master on location_master.ID=meter_reading.location_id inner join building_master on building_master.ID=location_master.Block  inner join stock_summary  ss on ss.IDNO=meter_reading.article_no where ss.WorkingStatus='0'   order by building_master.Name desc, location_master.RoomNo asc ";
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
                <table>
                <tr><th style='border:0px'>Name</th><th style='border:0px;text-align:right'>ID</th></tr>
                </table>
                </th>
                <th>
                <table >
                
                <tr><th style='border:0px'>Date</th><th style='border:0px'>Reading</th></tr>
                </table>
                </th>
                <th>
                <table >
                
                <tr><th style='border:0px'>Date</th><th style='border:0px'>Reading</th></tr>
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

                  $ownerTable.="<tr style='border:0px'>
                  <td style='border:0px;border-right: 1px solid'>{$StudentName}</td><td style='border:0px'>{$ClassRollNo}/{$UniRollNo}</td></tr>";

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

                    $ownerTable.="<tr style='border:0px'><td style='border:0px;border-right: 1px solid'>{$userName}</td><td style='border:0px'>{$user}</td></tr>";
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
                    $ownerTable.="<tr style='border:0px'><td style='border:0px; border-right: 1px solid' >{$userName}</td><td style='border:0px'>{$user}</td></tr>";
                    
                  }
                }
              }
            }
            $newDateTable.="<tr><td rowspan='{$sr}' style='border:0px;border-right: 1px solid'>{$date}</td><td rowspan='{$sr}' style='border:0px'>{$reading}</td></tr>";
            $oldDateTable.="<tr><td rowspan='{$sr}' style='border:0px;border-right: 1px solid'>{$previousReadingDate}</td><td rowspan='{$sr}' style='border:0px'>{$previousReading}</td></tr>";

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
                <table>
                {$ownerTable}
                </table>


                </td>
                <td>
                <table>
                {$oldDateTable}
                </table>


                </td>
                <td>
                <table>
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
    }?>