<?php 


if($exportCode=='71')
{

$exportstudy.="<tr><th colspan='".$subCount."' ><b style='font-size:22px;'>GURU KASHI UNIVERSITY, TALWANDI SABO, BATHINDA (PUNJAB) RESULT NOTIFICATION No. GKU/COE/".$resultNo."/&nbsp;&nbsp;".$Examination."&nbsp;&nbsp;EXAMINATION</b></th>         
    </tr>"; 

    $exportstudy.="<tr><th colspan='".$subCount."' >  <b style='font-size:16px;style='text-align:left;'>  &nbsp;&nbsp;&nbsp; Programme:&nbsp;&nbsp;&nbsp;".$CourseName."&nbsp;&nbsp;&nbsp;
    <b style='text-align:center;font-size:16px;'>   &nbsp;&nbsp;&nbsp;Semester:&nbsp;&nbsp;&nbsp;".$Semester."</b>(".$Type.")  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Batch &nbsp;&nbsp;&nbsp;: <b style='text-align:right;'>".$Batch."</b></th></tr>";
    $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th></tr>";





}
else if($exportCode!='60')
{
 $exportstudy.="<tr><th colspan='".$subCount."' ><b style='font-size:22px;'>GURU KASHI UNIVERSITY, TALWANDI SABO, BATHINDA (PUNJAB) RESULT NOTIFICATION No. GKU/COE//&nbsp;&nbsp;".$Examination."&nbsp;&nbsp;EXAMINATION</b></th>         
    </tr>"; 

    $exportstudy.="<tr><th colspan='".$subCount."' >  <b style='font-size:16px;style='text-align:left;'>  &nbsp;&nbsp;&nbsp; Programme:&nbsp;&nbsp;&nbsp;".$CourseName."&nbsp;&nbsp;&nbsp;
    <b style='text-align:center;font-size:16px;'>   &nbsp;&nbsp;&nbsp;Semester:&nbsp;&nbsp;&nbsp;".$Semester."</b>(".$Type.")  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Batch &nbsp;&nbsp;&nbsp;: <b style='text-align:right;'>".$Batch."</b></th></tr>";
    $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Result (".$Examination.")</b></th></tr>";
}
else
{

 $exportstudy.="<tr><th colspan='".$subCount."' >  <b style='font-size:16px;style='text-align:left;'>  &nbsp;&nbsp;&nbsp; Programme:&nbsp;&nbsp;&nbsp;".$CourseName."&nbsp;&nbsp;&nbsp;
    <b style='text-align:center;font-size:16px;'>   &nbsp;&nbsp;&nbsp;Semester:&nbsp;&nbsp;&nbsp;".$Semester."</b>(".$Type.")  &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Batch &nbsp;&nbsp;&nbsp;: <b style='text-align:right;'>".$Batch."</b></th></tr>";
    $exportstudy.="<tr><th colspan='".$subCount."'><b style='font-size:20px;'>Consolidated Marks(".$Examination.")</b></th></tr>";

}





    
 ?>