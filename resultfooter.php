<?php $exportstudy.="<tr border='none'><th colspan='".$subCount."' ><b style='font-size:15px;'>NC: Semester not completed.       F: The student has to reappear in internal and/or external examination.      DT: Detained,      NA: Not Applicable,    RL: Result Late,   AB: Absent UMC: Unfair Means Case, RLE: Result Late Due to Eligibilty, RLA: Result Late Due to Award List, * Already Has been Passed, Revaluation should be submitted within 15 Days after the date of declaration of the result.</b></th>         
    </tr>";
 
$fcopspan=(INT)$subCount/3;

    $exportstudy.="<tr style='min-height:100px'>



    <th colspan='".$fcopspan."' ><br><Br><br><Br><b style='font-size:15px;'> Prepared By ________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

        <th colspan='".$fcopspan."' > Checked By   
        ________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th> <th colspan='".$fcopspan."' >Controller of Examinations ________________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </b><br><Br><br><Br></th>         
    </tr>";
   
?>