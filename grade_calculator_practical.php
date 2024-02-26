<?php
 $color='black';
 $grade='';
 $printmark='';
   $gardep=0;
 $practivcal="SELECT * from MasterPracticals inner join PracticalMarks on MasterPracticals.id=PracticalMarks.PID  where CollegeId='$College' ANd CourseId='$Course' ANd Batch='$Batch' AND SubCode='$Subjectsp[$sub]' ANd Session='$Examination' AND IDNO='$IDNos'"; 
$list_resultamrikpr = sqlsrv_query($conntest,$practivcal);  
$pmarks=0;
$pcount=0;
$pshow='';
$smarks='';
while($row7pr = sqlsrv_fetch_array($list_resultamrikpr, SQLSRV_FETCH_ASSOC) )
         {
$absent=0;
if(is_numeric($row7pr['PMarks']))
               {
                  $p=$row7pr['PMarks'];
               }
            else if($row7pr['PMarks'] =='S' OR $row7pr['PMarks'] =='US') 
                {
                  $pmarks=$row7pr['PMarks'];
                } 
                else if($row7pr['PMarks'] =='AB')
                  {
                     $p='AB';
                  }
            else
               { 
                     $p=0;
               }

            if(is_numeric($row7pr['VMarks']))
               {$v=$row7pr['VMarks'];}
            else if($row7pr['VMarks'] =='S' OR $row7pr['VMarks'] =='US' ) {$pmarks=$row7pr['VMarks'];}else if($row7pr['VMarks'] =='AB'){$v='AB';}else{$v=0;}

            if(is_numeric($row7pr['FMarks'])){$f=$row7pr['FMarks'];}else if($row7pr['FMarks'] =='S' OR $row7pr['FMarks'] =='US' ) {$pmarks=$row7pr['FMarks'];}else if($row7pr['FMarks'] =='AB'){$f='AB';}else{$f=0;} 
            if($pmarks=='S' OR $pmarks=='US')
            {
               $pmarks=$row7pr['PMarks'];
                $smarks=$pmarks;
            }
            else
            {
            if(is_numeric($p)){$p=$p;}else{$p=0;$absent++;}

            if(is_numeric($v)){$v=$v;}else{$v=0; $absent++;}

            if(is_numeric($f)){$f=$f;}else{$f=0; $absent++;}
           
           $smarks1=$p+$v+$f;
  $smarks=$p+$v+$f;
           $pmarks=$pmarks+$smarks1;
          }

 if($absent>2)
{
   $smarks='AB';
} 
else
{

}
$pshow=$pshow.'/'.$p.'/'.$v.'/'.$f;

$pcount++;
 } 

       if(is_numeric($pmarks))
          {
if($pcount>5)
{
    $pmarks=round((($pmarks/$pcount)*5));
}
else
{
   $pmarks=$pmarks; 
}
          }
          else
{
   $pmarks=$pmarks; 
}

   if(is_numeric($pmarks))
   {
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
   $printmark=$pmarks;
    $gardep=0;
}
   }
   else
   {
    if($pmarks=='AB')  
    {
      $grade="F";
    }

    else{
   $grade=$pmarks;
    }
   $printmark=$pmarks;
   $gardep=0;
   }
?>