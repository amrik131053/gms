<?php
 $color='black';
 $grade='';
 $printmark='';
  $gardep=0;
 $practivcal="SELECT * from MasterPracticals inner join PracticalMarks on MasterPracticals.id=PracticalMarks.PID  where CollegeId='$College' ANd CourseId='$Course' ANd Batch='$Batch' AND SubCode='$SubjectsNewop[$sub]' ANd Session='$Examination' AND IDNO='$IDNos'"; 
$list_resultamrikpr = sqlsrv_query($conntest,$practivcal);  
$pmarks=0;
$pcount=0;
$pshow='';
$smarks=0;
while($row7pr = sqlsrv_fetch_array($list_resultamrikpr, SQLSRV_FETCH_ASSOC) )
         {
$absent=0;

$p1=$row7pr['PMarks'];
$v1=$row7pr['VMarks'];
$f1=$row7pr['FMarks'];

if(is_numeric($p1))
               {
                  $p=$p1;
               }
           
                else if($p1 =='AB')
                  {
                     $p='AB';
                  }
           
            else
               { 
                     $p='0';
               }

            if(is_numeric($v1))
               {
                  $v=$v1;
               }
            // else if(($v1 =='S') || ($v1 =='US'))
            //  {
            //    $pmarks=$v1;
            // }
            else if($v1 =='AB')
            {
               $v='AB';
            }
            else{
               $v='0';
            }

            if(is_numeric($f1))
            {

              $f=$f1;}

              // else if(($f1=='S') OR ($f1=='US') ) 
              //   {$pmarks=$f1;

              // }
              else if($f1=='AB')
              {
               $f='AB';}else{$f=0;} 



          
              // $smarks=0;
            if(is_numeric($p1))
               {
                $p=$p1;
              }
                    else if(($p1 =='S') || ($p1 =='US'))
             {
               $pmarks=$p1;
            }
            else
            {$p=0;$absent++;}

            if(is_numeric($v1))
               {$v=$v1;}
              else if(($v1 =='S') || ($v1 =='US'))
             {
               $pmarks=$v1;
            }

            else{
               $v='0'; $absent++;
            }

            if(is_numeric($f1))
              {$f=$f1;}
             else if(($f1 =='S') || ($f1 =='US'))
             {
               $pmarks=$f1;
            }

            else{$f=0; $absent++;}
                      
           $smarks=$p+$v+$f;

           if(is_numeric($pmarks))
             {

              $pmarks=$pmarks+$smarks;

             } 

                
            else if(($pmarks =='S') || ($pmarks =='US'))
            {

              $pmarks=$pmarks;

            }
             else
             {
              $smarks=$p1; 
             }

 if($absent>2)
{
   $smarks='AB';
} 
else
{


}
$pshow=$pshow.'/'.$smarks;

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