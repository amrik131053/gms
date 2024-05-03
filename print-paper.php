<?php
session_start();
ini_set('max_execution_time', '0');
include 'connection/connection.php';
$ctime = date("d-m-Y");
$nowtime = strtotime($ctime);
$id=$_POST['paperId'];
$sql="Select * from question_paper inner join question_exam on question_paper.exam=question_exam.id where question_paper.id='$id'";
$res=mysqli_query($conn,$sql);
while ($data=mysqli_fetch_array($res)) 
{
    $examName=$data['exam_name'];
     $examid=$data['id'];
    $sqlCourse = "SELECT DISTINCT Course,CourseID from MasterCourseStructure WHERE CourseID=".$data['course'];
    $resultCourse = sqlsrv_query($conntest,$sqlCourse);
    while($rowCourse = sqlsrv_fetch_array($resultCourse, SQLSRV_FETCH_ASSOC) )
    {
        $courseName=$rowCourse["Course"]; 
    } 

    $mcq=$data['mcq'];
    $short=$data['short'];
    $long=$data['long'];
    $semester=$data['semester'];
    $maxMarks=$data['max_marks'];
    $time =$data['exam_time'];
    $instruction =$data['instructions'];
    $subjectCode=$data['subject_code'];
     $sqlSubject = "SELECT  SubjectName from MasterCourseStructure WHERE SubjectCode ='".$subjectCode."' AND  CourseID='".$data['course']."'  order by SrNo DESC ";
                    $resultSubject = sqlsrv_query($conntest,$sqlSubject);
                    if($rowSubject= sqlsrv_fetch_array($resultSubject, SQLSRV_FETCH_ASSOC) )
                    {
                        $subjectName=$rowSubject["SubjectName"]; 
                    }
                    // else{
                    //   $sqlSubject1 = "SELECT  SubjectName from MasterCourseStructure WHERE SubjectCode ='".$subjectCode."' AND Isverified='1' and Elective='O'  order by SrNo DESC ";
                    //   $resultSubject1 = sqlsrv_query($conntest,$sqlSubject1);
                    //   if($rowSubject1= sqlsrv_fetch_array($resultSubject1, SQLSRV_FETCH_ASSOC) )
                    //   {
                    //     $subjectName=$rowSubject1["SubjectName"]; 
                    //   }

                    // }

}



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
                  
                  <tr>
                    <th align="left" width="25%" >
                      <img src="logo2.png" width="50px" height="100%">
                    </th>
                      <th   align="center">
                      <span style="font-size: 20px;">GURU KASHI UNIVERSITY</span>
       
<?php 
       $sqlsession = "SELECT * FROM question_session WHERE session_status='1'";
       
$resultsession=mysqli_query($conn,$sqlsession);
                          if($rowsession=mysqli_fetch_array($resultsession))
                          {



$sessionnane=$rowsession['session_name'];

 }



if($examid==4) 
{

}
else
{
  echo "<br>";
echo  $examName ." (".$sessionnane.")" ; 
}
?>
                      <!-- <?=$examName?> -->
                    </th>
                    <th  valign="bottom" align="left" width="25%">
                      Roll No...........................
                    </th>
                  </tr>
                 
                  <tr>
                    <th valign="bottom" colspan="2" align="left">
                      Programme: <?=$courseName?> 
                    </th>
                    
                    <th valign="bottom" align="right">
                     
                      Semester: 
                      <?php
                      echo $semester; 
                      if ($semester==1) 
                      {
                        ?><sup>st</sup><?php
                      }
                      elseif ($semester==2) 
                      {
                        ?><sup>nd</sup><?php
                      }
                      elseif ($semester==3) 
                      {
                        ?><sup>rd</sup><?php
                      }
                      elseif ($semester>=4) 
                      {
                        ?><sup>th</sup><?php
                      }
                      ?>

                    </th>
                  </tr>
                  <tr>
                    <th valign="bottom" align="left">
                      Subject Code: <?=$subjectCode?> 
                    </th>
                    <th  colspan='2' valign="bottom" align="right">
                     
                       Maximum Marks: <?=$maxMarks?> 
                    </th>

                  </tr>
                  
                  <tr>
                    <th  colspan='3' valign="bottom" align="center">
                      <?=$subjectName?> 
                    </th>
                  </tr>
                  <tr>
                    <th  colspan='3' valign="bottom" align="left">
                      Time: <?=$time?> 
                    </th>
                  </tr>
                  <tr>
                    <th  colspan='3' valign="bottom" align="left">
                      Instructions:                      
                            <?=$instruction?>
                      </th>
                  </tr>
                  <tr>
                    <td colspan="3">

                      <table border="0" width="100%">
                        <?php
                        $qType=''; 
                        $partCount=0;
                        $questionCount=0;
                        $mcqCount='a';
                        
                         $qry="Select *,REGEXP_REPLACE(Question,'style=".'[\\d\\D]*?'."','') AS sanitized_question from question_paper_details inner join question_bank on question_bank.Id=question_paper_details.question_id inner join question_type on question_type.id=question_bank.Type inner join question_category on question_category.id=question_bank.Category inner join question_bank_details on question_bank.id=question_bank_details.question_id   where question_paper_id='$id' ORDER BY  Type  asc, Category asc";
                        $run=mysqli_query($conn,$qry);
                        while($row=mysqli_fetch_array($run))
                        { 
                          $img='';
                          $imageQry="Select * from question_image where question_id=".$row['Id'];
                          $imageRes=mysqli_query($conn,$imageQry);
                          while($imageData=mysqli_fetch_array($imageRes))
                          {

                            http://gurukashiuniversity.co.in/data-server/question_images/
                            $img.= "<div><img src='http://gurukashiuniversity.co.in/data-server/question_images/{$imageData['image']}' height='200px'  ></div>";
                           
                          }
                         
                            $questionCount++;
                         
                          

                          if ($qType!=$row['Type']) 
                          {
                            $partCount++;
                            if($partCount==1)
                            {
                              $partCountRoman='I';
                            }
                            elseif($partCount==2)
                            {
                              $partCountRoman='II';
                            }
                            elseif($partCount==3)
                            {
                              $partCountRoman='III';
                            }
                            ?>
                            <tr>
                              <th colspan="3" align="center" style="font-size:20px">
                               <label style="margin-left:100px ;"> Part <?=$partCountRoman?> (<?=$row['type_name']?>)</label>
                               <label style="float: right;">
                                (<?php
                                if ($row['Type']==1) 
                                {
                                  echo $mcq;
                                }
                                elseif ($row['Type']==2) 
                                {
                                  echo $short;
                                }
                                elseif ($row['Type']==3) 
                                {
                                  echo $long;
                                } 
                                ?>)
                                </label>
                              </th>
                            </tr>
                            <?php
                          }
                          
                            ?>
                            <tr>
                              <th width="10%" align="right" >
                                <?=$questionCount?>. 
                                <?php
                                 if ($row['Type']==1) 
                                  {
                                    //echo "({$mcqCount})";

                                  }
                                  ?>
                                &nbsp;<br></th>

                              <th align="left"  ><?=$row['sanitized_question']?>  <?=$row['id']?>
                                <?= $img?><!-- <?php 
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
                                <?php }?> -->


                              </th> 

                              <th align="right">
                          


                                 
                                  <!-- <td><?=$row['Unit']?></td> 
                                <?=$row['category_name']?>(<?=$row['Unit']?>)-->
                            
                             </th>
                            </tr>
                            
                          <?php
                          $qType=$row['Type'];

                          if ($row['Type']==1) 
                          {
                            $mcqCount++;
                          }
                           $mcqCount++;
                            
                        }
                        ?>
                        
                      </table>
                    </td>
                  </tr>
                  <!-- <tr>
                    <td height="1" align="center" valign="top"><img src="images/admit_card_border.png" width="966" height="16"></td>
                  </tr> -->
                </table>


        


                <!-- <div style="page-break-after:always;margin:0px 0px 0px 0px;padding: 0px 0px 0px 0px;"> </div>

                <table border="0" align="center" cellpadding="0" cellspacing="0" style="height:100%;  ">
                  <tr>
                    <td rowspan="3" align="center" valign="top" nowrap><img src="images/admit_card_border11.png" width="16" height="100%" style="margin-top:1px "></td>
                    <td height="1" align="center" valign="top"><img src="images/admit_card_border.png" width="966" height="16"></td>
                    <td rowspan="3" align="center" valign="top" nowrap><img src="images/admit_card_border11.png" width="16" height="100%" style="margin-top:1px "></td>
                  </tr>
                  <tr>
                    <td align="center" valign="top">
                      <table border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width: 1px;border-color: #999999;width:100%;">
                        <tr>
                          <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr align="right">
                                <th colspan="4">Application No. <?= $id;?></th>
                              </tr>
                              <tr bgcolor="#223260" style="color: white;">
                                <th width="10%"></th>
                                <th align="left">Eligibility Tests</th>
                                <th align="right">Test : <?= $data_test_document['test_name']; ?></th>
                                <th width="10%"></th>
                              </tr>
                              <tr>
                                <td colspan="4">
                                  <img src="<?=$ftp_URL?>/tests/<?=$data_test_document['test_document']?>" height='1000px' width='1000px'>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      
                      
                    </td>
                  </tr>
                  <tr>
                    <td height="1" align="center" valign="top"><img src="images/admit_card_border.png" width="966" height="16"></td>
                  </tr>
                </table>


               -->












                </span>
                <!-- <script type="text/javascript">
                (function() {
                  window['__CF$cv$params'] = {
                    r: '6fd182094c9f8483',
                    m: 'hwVN6GXvHYexZclQZJUSrFKHbdNUbXAOx8bVyEvXSpY-1650160206-0-AWTBxiwy+nwRmiSN9/OSS+8sqJOTzghIeKBZNWVr45G9J73BNDNAG5jBvebUOPzrPPyRr8IQtXkh1ua8suq0yOqqmnPJ3Dn3tI/yQA7tItQnRvVBvPcV/YyCARqzHGrbtheadqLJcqrwCijFlPnuYHr0N1tLOHh6ZDxRfnofAoEnZWIRqQcPSAZTLXVOj36x6w==',
                    s: [0x6aa72617c0, 0xc4ac533f3e],
                    u: '/cdn-cgi/challenge-platform/h/b'
                  }
                })();



                window.onload = function() { window.print(); }
                </script> -->
  </body>

  </html>