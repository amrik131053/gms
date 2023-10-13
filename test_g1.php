<?php
// (date('H')*60*60+date('i')*60+date('s')-32400 /61200-32400) * 100;
date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
// echo $dataTime=date('Y-m-d h:s A');
// ECHO $timeStamp=date('Y-m-d H:i:s.v');
     $now = new DateTime("2010-07-28 01:11:50");
$ref = new DateTime("2010-07-30 05:56:40");
$diff = $now->diff($ref);
// printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
$bdate = strtotime('2011-11-04'); 
$edate = strtotime('2011-12-03');
$age = ((date('Y',$edate) - date('Y',$bdate)) * 12) + (date('m',$edate) - date('m',$bdate));
// Creates DateTime objects
$datetime1 = date_create('2016-06-01');
$datetime2 = date_create('2018-09-21');

// Calculates the difference between DateTime objects
$interval = date_diff($datetime1, $datetime2);

// Printing result in years & months format
echo $interval->format('%R%y years %m months');
?>

