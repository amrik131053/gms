<?php  
$color='black';
$printmark='';
$showgradefail='';
$msttotal='';
$showmarks=$CE1."/".$CE3."/".$att."/".$mst1."/".$mst2."/".$ESe;
if($grace>0)
{
   $showmarks=$showmarks."(".$grace.")";
}

if(is_numeric($mst1))
                                 {
                                $mst1=$mst1;

                                 }
                                 else{$mst1=0;}

                                 if(is_numeric($mst2))    {
                                    $mst2=$mst2;

                                 }
                                 else{$mst2=0;}

                              if($mst1>$mst2) { $msttotal=$mst1; }  else  {  $msttotal=$mst2;   }

                               if(is_numeric($CE1)){$fCE1=$CE1;}else{$fCE1=0;}

if(is_numeric($CE3)){$fCE3=$CE3;}else{$fCE3=0;}
if(is_numeric($msttotal)){$fmsttotal=$msttotal;}else{$fmsttotal=0;}
if(is_numeric($att)){$fatt=$att;}else{$fatt=0;}

if(is_numeric($ESe)){$fESe=$ESe;}else{$fESe=0;}

if(is_numeric($grace)){$fgrace=$grace;}else{$fgrace=0;}
if(is_numeric($ESe)){
$totalFinal=$fCE1+$fCE3+$fatt+$fmsttotal+$fESe+$fgrace;   
}
else
{
$totalFinal=0;

$nccount++;
}


$grade='';
$gardep=0;
if($ESe=='S')
{
$totalFinal=$ESe;
$grade=$ESe;
$gardep=$ESe;
}
else if($ESe=='US')
{
$totalFinal=$ESe;
$grade=$ESe;
$gardep=$ESe;
$nccount++;
$color='red';
}
// else if($ESe=='AB')
// {
// $totalFinal=$ESe;
// $grade=$ESe;
// $gardep=$ESe;
// $nccount++;
// $color='red';
// }

else{ 
if($totalFinal>=90)
{   $grade= "O";
   $gardep=10;
}
else if($totalFinal>=80 &&$totalFinal<90)
{   $grade="A+";
   $gardep=9;
}
else if($totalFinal>=70 &&$totalFinal<80)
{
   $grade="A";
   $gardep=8;
}
else if($totalFinal>=60 &&$totalFinal<70)
{
   $grade="B+";
   $gardep=7;
}
else if($totalFinal>=50 &&$totalFinal<60)
{
   $grade="B";
   $gardep=6;
}
else if($totalFinal>=45 &&$totalFinal<50)
{
   $grade="C";
   $gardep=5;
}
else if($totalFinal>=40 &&$totalFinal<45)
{
   $grade="P";
   $gardep=4;
}
else if($totalFinal<40)
{
   $grade="F";
   $printmark=$totalFinal;
   $showgradefail='-Fail'.'('.$printmark.')';
    $gardep=0;
    $color='red';
     $nccount++;
}
} ?>