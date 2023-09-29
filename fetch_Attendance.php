<?php
session_start();
$EmployeeID=$_SESSION['usr'];
include "connection/connection.php";

if(isset($_POST['monthYears']))
{
  $orderdate = explode('-', $_POST['monthYears']);
  $year  = $orderdate[0];
  $month = $orderdate[1];
  $day   = '01';
}
else
{
  $month = date('m');
  $day = date('d');
  $year = date('Y');
}
  $IDNo=$EmployeeID;
 
 
$data = array();
$start=date('Y-m-d');
$list=array();
function getBetweenDates($startDate, $endDate) {
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
$list = getBetweenDates($year.'-'.$month.'-01', $start);
 $aa=count($list);
for ($i=0; $i <$aa ; $i++)
 { 
  $start_date=$list[$i];
  $sql_att="SELECT  MIN(CAST(LogDateTime as time)) as mytime, MAx(CAST(LogDateTime as time)) as mytime1
from DeviceLogsAll  where LogDateTime Between  '$start_date 00:00:00.000'  AND 
'$start_date 23:59:00.000' AND EMpCOde='$IDNo'  ";
$stmt = sqlsrv_query($conntest,$sql_att);  
           if($row_staff_att = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
          {
            if($row_staff_att['mytime'] === null) //when funch not available
            {

              $sql_att23="SELECT  Name,LeaveDuration,LeaveDurationsTime, CASE  WHEN StartDate < '$start_date' THEN '$start_date'  ELSE StartDate  END AS Leave_Start_Date,CASE  WHEN EndDate > '$start_date' THEN '$start_date' ELSE EndDate  END AS Leave_End_Date FROM  ApplyLeaveGKU  inner join LeaveTypes on ApplyLeaveGKU.LeaveTypeId=LeaveTypes.Id WHERE StartDate <= '$start_date' AND  EndDate >= '$start_date' ANd StaffId='$IDNo' ANd Status='Approved'"; 
  $leaveName='';
  $stmt = sqlsrv_query($conntest,$sql_att23);  
              if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
             {
              $leaveName=$row['Name'];
              if($row['LeaveDurationsTime']!='0')
              {
                $leavedurationtime=$row['LeaveDurationsTime'];

              }
              else
              {
                $leavedurationtime=$row['LeaveDuration'];

              }
                     if($leaveName=='LWS')
                     {
                      $data[] = array(
                        'title'         => $leaveName,
                          'start'         => $start_date,
                          'allDay'        => true,
                          'backgroundColor'=> '#0dcaf0', 
                          'borderColor'   => '#0dcaf0', 
                          'textColor'   => 'white' 
                                        );
                     }
                     else
                     {
                     $data[] = array(
                       'title'         => $leavedurationtime.':'.$leaveName,
                         'start'         => $start_date,
                         'allDay'        => true,
                         'backgroundColor'=> '#0dcaf0', 
                         'borderColor'   => '#0dcaf0', 
                         'textColor'   => 'white' 
                                       );
                                      }
                                   
                                        

                                      }

                                      // check holiday------------------------------------------------------
       $sql_holiday="Select * from  Holidays where HolidayDate  Between '$start_date 00:00:00.000' ANd  '$start_date 23:59:00.000'";
$stmt = sqlsrv_query($conntest,$sql_holiday);  
            if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
            {
         $HolidayName=$row_staff['HolidayName'];
         $data[] = array(
          'title'         => $HolidayName,
            'start'         => $start_date,
            'allDay'        => true,
            'backgroundColor'=> 'white', 
            'borderColor'   => 'white', 
            'textColor'   => 'black' 
                          );
             } 
             else
             {
              
              $sql_att23="SELECT  Name,LeaveDuration,LeaveDurationsTime, CASE  WHEN StartDate < '$start_date' THEN '$start_date'  ELSE StartDate  END AS Leave_Start_Date,CASE  WHEN EndDate > '$start_date' THEN '$start_date' ELSE EndDate  END AS Leave_End_Date FROM  ApplyLeaveGKU  inner join LeaveTypes on ApplyLeaveGKU.LeaveTypeId=LeaveTypes.Id WHERE StartDate <= '$start_date' AND  EndDate >= '$start_date' ANd StaffId='$IDNo' ANd Status='Approved'"; 
              $leaveName='';
              $stmt = sqlsrv_query($conntest,$sql_att23);  
                          if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                         {
                         
                          
                         
                          }
                               else
                               {

              $Other="Absent";
              $data[] = array(
                'title'         => $Other,
                  'start'         => $start_date,
                  'allDay'        => true,
                  'backgroundColor'=> '#dc3545', 
                  'borderColor'   => '#dc3545', 
                  'textColor'   => 'white' 
                                );
                 } //---------------------------------------------------------------------------------------
          }

         



          
        }
            else
            {
              //when funch available
              $InTime=$row_staff_att['mytime']->format('H:i');
              
              $data[] = array(
                'title'   => $InTime,
                 'start'   => $start_date,
                    'backgroundColor'   => "#28a745",
                        'borderColor'   => "#28a745",
                       
                             'allDay'   => true
                                );
              //--------------------------
            }

            if($row_staff_att['mytime1'] === null) //when funch not available
            {
              $OutTime="Holiday";
            }
            else
            {
              $sql_att23="SELECT  Name,LeaveDuration,LeaveDurationsTime,
              CASE  WHEN StartDate < '$start_date' THEN '$start_date' ELSE StartDate  END AS Leave_Start_Date, CASE WHEN EndDate > '$start_date' THEN '$start_date' ELSE EndDate  END AS Leave_End_Date  FROM   ApplyLeaveGKU   inner join LeaveTypes on ApplyLeaveGKU.LeaveTypeId=LeaveTypes.Id
  WHERE StartDate <= '$start_date' AND EndDate >= '$start_date' ANd StaffId='$IDNo' ANd Status='Approved'"; 
  $leaveName='';
  $stmt = sqlsrv_query($conntest,$sql_att23);  
              if($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
             {
              $leaveName=$row['Name'];
              if($row['LeaveDurationsTime']!='0')
              {
                $leavedurationtime=$row['LeaveDurationsTime'];

              }
              else
              {
                $leavedurationtime=$row['LeaveDuration'];

              }
                    //  $Other="Holiday";
                     $data[] = array(
                      'title'         => $leavedurationtime.':'.$leaveName,
                         'start'         => $start_date,
                         'allDay'        => true,
                         'backgroundColor'=> '#0dcaf0', 
                         'borderColor'   => '#0dcaf0', 
                         'textColor'   => 'white' 
                                       );
              }
              $sql_holiday="Select * from  Holidays where HolidayDate  Between '$start_date 00:00:00.000' ANd  '$start_date 23:59:00.000'";
              $stmt = sqlsrv_query($conntest,$sql_holiday);  
                          if($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                          {
                       $HolidayName=$row_staff['HolidayName'];
                       $data[] = array(
                        'title'         => $HolidayName,
                          'start'         => $start_date,
                          'allDay'        => true,
                          'backgroundColor'=> 'white', 
                          'borderColor'   => 'white', 
                          'textColor'   => 'black'
                          
                                        );
                           } 
                           else
                           {
                          

                           }
                           
                           
              //when funch available
              
              $OutTime=$row_staff_att['mytime1']->format('H:i');


              if($InTime<>$OutTime)
              {
              $data[] = array(
                'title'   => $OutTime,
                 'start'   => $start_date,
                    'backgroundColor'   => "#28a745",
                        'borderColor'   => "#28a745",
                             'allDay'   => true
                               );
                              }
                              else
                              {
                                $data[] = array(
                                  'title'   => 'No Punch',
                                   'start'   => $start_date,
                                      'backgroundColor'   => "#ffc107",
                                          'borderColor'   => "#ffc107",
                                          'textColor'   => 'white', 
                                         
                                               'allDay'   => true
                                                 );

                              }
                               //-------------------------------------
            
          }
        
        }
}
echo json_encode($data);

?>