<?php
session_start();
ini_set('max_execution_time', '0');
include 'connection/connection.php';
$ctime = date("d-m-Y");
$nowtime = strtotime($ctime);
 
$subjectcode=$_POST['SubjectCode'];
$batch=$_POST['Batch'];
$Exam_Session=$_POST['Exam_Session'];
$Semester=$_POST['Semester'];
?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html lang="en" class="notranslate" translate="no">

  <head>
    <meta name="google" content="notranslate" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <!-- <script type="text/javascript" language="javascript1.2"> 

  document.onmousedown = disableclick;
  function disableclick(e)
  {
    if(event.button == 2)
    {
      alert("Right Click Disabled");
      return false; 
    }
  }
  //-->
    <!-- </script> -->

    <script async src='/cdn-cgi/challenge-platform/h/b/scripts/invisible.js?ts=1650157200'></script>
  </head>
<!-- onload="window.print()" -->
  <body   oncontextmenu="return false" style="margin:0px;text-align:center "> <span class="notranslate">




                <!-- <div style="page-break-after:always;margin:0px 0px 0px 0px;padding: 0px 0px 0px 0px;"> </div> -->

                <table border="0" align="center" cellpadding="0" cellspacing="0" style="height:100%;  " width="100%">
                  <!-- <tr>
                    <td rowspan="3" align="center" valign="top" nowrap><img src="images/admit_card_border11.png" width="16" height="100%" style="margin-top:1px "></td>
                    <td height="1" align="center" valign="top"><img src="images/admit_card_border.png" width="966" height="16"></td>
                    <td rowspan="3" align="center" valign="top" nowrap><img src="images/admit_card_border11.png" width="16" height="100%" style="margin-top:1px "></td>
                  </tr> -->
                  <tr>
                    
                  </tr>
                  <tr>
                    <th colspan='3' valign="bottom" align="center">
                      <span style="font-size: 30px;">GURU KASHI UNIVERSITY</span>
                      <br>
               
                    </th>
                  </tr>
                  <tr>
                    <th valign="bottom" colspan="2" align="left">
                   
                    </th>
                    
                    <th valign="bottom" align="right">
                     
                      

                    </th>
                  </tr>
                  <tr>
                    <th valign="bottom" align="left">
                     
                    </th>
                    <th  colspan='2' valign="bottom" align="right">
                     
                      
                    </th>

                  </tr>
                  
                  <tr>
                    <th  colspan='3' valign="bottom" align="center">
                  
                    </th>
                  </tr>
                  <tr>
                    <th  colspan='3' valign="bottom" align="left">
                     
                    </th>
                  </tr>
                 
                  <tr>
                    <td colspan="3">

                      <table border="0" width="100%">
                        <?php
                       
                        $count=1;
                     $qry=" Select *,REGEXP_REPLACE(Question,'style=".'[\\d\\D]*?'."','') AS sanitized_question  from  question_bank  inner join question_type on question_type.id=question_bank.Type inner join question_category 
 on question_category.id=question_bank.Category inner join question_bank_details 
 on question_bank.id=question_bank_details.question_id   where SubjectCode='$subjectcode' ANd Batch='$batch' ANd question_bank.Exam_session='$Exam_Session'  ANd Semester='$Semester' order by Unit";
                        $run=mysqli_query($conn,$qry);
                        while($row=mysqli_fetch_array($run))
                        { 
                          $img='';
                          $imageQry="Select * from question_image where question_id=".$row['Id'];
                          $imageRes=mysqli_query($conn,$imageQry);
                          while($imageData=mysqli_fetch_array($imageRes))
                          {

                             $img.= "<div><img src='http://gurukashiuniversity.co.in/data-server/question_images/{$imageData['image']}' height='200px'  ></div>";
                           
                          }
                        
?>
                         
                            <tr>
                              <th colspan="3" align="center" style="font-size:20px">
                               </label>
                               <label style="float: right;">
                                
                                </label>
                              </th>
                            </tr>
                           
                            <tr valign="top">
                              <th width="10%" align="right"><p> 
                               <?= $count++;?>
                                &nbsp;</p></th>
                              <th align="left"><?=$row['Question']?>
                                <?= $img?>

                                <?php 
                                if($row['OptionA']!='')
                                {?>
                                   (A) &nbsp; <?=$row['OptionA']?> 
                                <?php }?> &nbsp;&nbsp;&nbsp;
                                <?php 
                                if($row['OptionB']!='')
                                {?>
                                   (B) &nbsp; <?=$row['OptionB']?> 
                                <?php }?>&nbsp;&nbsp;&nbsp;

 <?php 
                                if($row['OptionC']!='')
                                {?>
                                   (C) &nbsp; <?=$row['OptionC']?> 
                                <?php }?>&nbsp;&nbsp;&nbsp;

                                 <?php 
                                if($row['OptionD']!='')
                                {?>
                                   (D) &nbsp; <?=$row['OptionD']?> 
                                <?php }?>
                              </th>
                              <th align="right">
                                <p><table>
                                <tr>
                                 
                                  <td>Unit-<?=$row['Unit']?>-<?=$row['type_name']?>(<?=$row['category_name']?>)</td>
                                </tr>
                              </table></p></th>
                            </tr>
                            
                          <?php
                          
                        }
                        ?>
                        
                      </table>
                    </td>
                  </tr>
                 
                </table>


        











                </span>
              
  </body>

  </html>