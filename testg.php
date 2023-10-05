<?php
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
// $list=array();
// $month = 12;
// $year = 2023;

// for($d=1; $d<=31; $d++)
// {
//     $time=mktime(12, 0, 0, $month, $d, $year);          
//     if (date('m', $time)==$month)       
//         $list[]=date('Y-m-d-D', $time);
// }
// echo "<pre>";
// print_r($list);
// echo "</pre>";

// $dates = getBetweenDates('2020-01-01', '2023-07-09');
// function getBetweenDates($startDate, $endDate) {
//     $rangArray = [];
 
//     $startDate = strtotime($startDate);
//     $endDate = strtotime($endDate);
 
//     for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400)) {
//         $date = date('Y-m-d', $currentDate);
//         $rangArray[] = $date;
//     }
 
//     return $rangArray;
// }
// print_r($dates);
 date('h:i');

$startTime=32400;
$endTime=61200;
 $currentTime=date('H')*60*60+date('i')*60+date('s');







$C=$currentTime-$startTime;
$E=$endTime-$startTime;
//  echo "<br>".$v=($C/$E)*100
ECHO ((date('H')*60*60+date('i')*60+date('s')-32400)/(61200-32400)) * 100;


?>