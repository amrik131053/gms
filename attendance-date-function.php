<?php
function get_days_in_month($month,$year)
{
    if ($month == "02")
    {
        if ($year % 4 == 0) return 29;
        else return 28;
    }
    else if ($month == "01" || $month == "03" || $month == "05" || $month == "07" || $month == "08" || $month == "10" || $month == "12") return 31;
    else return 30;
}


$totDays = get_days_in_month($curmnth,$curyear);

$start_date="$curyear-$curmnth-01";

$currentmonth=date('m');

function getShortMonthNameByNumber($monthNum)
   { switch ($monthNum) {
        case 1:
            return "January";
        case 2:
            return "February";
        case 3:
            return "March";
             case 4:
            return "April";
             case 5:
            return "May";

             case 6:
            return "June"; 
            case 7:
            return "July";
             case 8:
            return "August";
             case 9:
            return "September";
             case 10:
            return "October";
             case 11:
            return "November";
             case 12:
            return "December";

       }
    }

$showmonth= getShortMonthNameByNumber($curmnth);

if($curmnth<>$currentmonth)
{
    $myenddate=$totDays;
}
else
{
$myenddate=$currentdate=date('d');
}

 $end_date="$curyear-$curmnth-$myenddate";


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

?>