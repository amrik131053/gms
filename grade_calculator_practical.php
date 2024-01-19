<?php
 $color='black';
 $grade='';
   $gardep=0;

if($pmarks>=90)
{
   $grade= "O";
   $gardep=10;
}
else if($pmarks>=80 &&$pmarks<90)
{
   $grade="A+";
   $gardep=9;
}
else if($pmarks>=70 &&$pmarks<80)
{
   $grade="A";
   $gardep=8;
}
else if($pmarks>=60 &&$pmarks<70)
{
   $grade="B+";
   $gardep=7;
}
else if($pmarks>=50 &&$pmarks<60)
{
   $grade="B";
   $gardep=6;
}
else if($pmarks>=45 &&$pmarks<50)
{
   $grade="C";
   $gardep=5;
}
else if($pmarks>=40 &&$pmarks<45)
{
   $grade="P";
   $gardep=4;
}
else if($pmarks<40)
{
   $grade="F";
   $color='red';
    $gardep=0;
}

?>