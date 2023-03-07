<?php
   session_start();
   date_default_timezone_set("Asia/Kolkata");  
   ini_set('max_execution_time', '0');
include 'connection/connection.php';
  $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$output = '';  
$ctime = date("d-m-Y");
$nowtime = strtotime($ctime);
$reference=$_POST['IdNo'];

if(!(ISSET($_SESSION['usr']))) {
header('Location:index.php'); }

else{  
  $a=$_SESSION['usr'];
  $sql2="SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$a'";
  
 $q2 = sqlsrv_query($conntest,$sql2);

 while($row1 = sqlsrv_fetch_array($q2, SQLSRV_FETCH_ASSOC) )
         {
$Name_autho=$row1['Name'];
$desi_autho=$row1['Designation'];
         }
}

$sql="SELECT * FROM stock_description inner join stock_summary on stock_summary.IDNo=stock_description.IDNO inner join master_article on master_article.ArticleCode=stock_summary.ArticleCode  where   stock_description.reference_no='$reference'";
$result = mysqli_query($conn,$sql);
 $array = array();
$a=0;

  while($row=mysqli_fetch_array($result))
{
 $a++;
 $array[] = $row;
 //print_r($array);
}
$remarks='';

for ($i=0; $i<$a; $i++)
 { 
$emp_id=$array[$i]['OwerID'];
$articleID=$array[$i]['IDNO'];
$remarks=$array[$i]['Remarks']."   ";
$category=$array[$i]['ArticleName'];
$working=$array[$i]['WorkingStatus'];
if ($array[$i]['Direction']=='Issued') 
{
   $issue_date=$array[$i]['Date_issue'];
}
if ($array[$i]['Direction']=='Returned') 
{
   $return_date=$array[$i]['Date_issue'];
}
$description=$array[$i]['CPU'].' '.$array[$i]['Brand'].' '.$array[$i]['Model'].' '.$array[$i]['DeviceSerialNo'];
if ($working=='0'||$working=='') 
{
   $WorkingStatus='Working';
}
elseif ($working=='1') 
{
   $WorkingStatus='Faulty';
}

}
$sql1="SELECT Name,Department,Designation,CollegeName,Snap FROM Staff Where IDNo='$emp_id'";
  
 $q1 = sqlsrv_query($conntest,$sql1);

 while($row = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC) )
         {
$name=$row['Name'];
$Department=$row['Department'];
$Designation=$row['Designation'];
$CollegeName=$row['CollegeName'];
 $img= $row['Snap'];
 $pic = 'data://text/plain;base64,' . base64_encode($img);
}

   ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" class="notranslate" translate="no">
   <head>
      <meta name="google" content="notranslate" />
      <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <script async src='/cdn-cgi/challenge-platform/h/b/scripts/invisible.js?ts=1650157200'></script>
   <style type="text/css">
      .underline{
border-bottom: 1px dotted black;
width: 100%;
display: block;
}
   </style>
   </head>
   <!-- onload="window.print()" -->
   <body   oncontextmenu="return false" style="margin:0px;text-align:center ">
      <span class="notranslate">
         <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1000px;height:1000px;  ">
            <tr>
               <td align="center" valign="top"  >
                  <table border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width: 0px;border-color: #999999;width:100%;">
                     <tr>
                        <td>
                           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                 <td></td>
                                 <td width="42%" height="0" align="left" valign="middle"><img src="http://gurukashiuniversity.co.in/gkuadmin/images/web-logo.png" height="60" width="250"></td>
                                 <td  width=''align="left"><span style="font-size: 24px;font-weight: bold;font-family:Arial, Helvetica, sans-serif;"><u>Acknowledgement Slip</u></span>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width:0px;border-color: #999999;margin-top:5px ;">
                     <tr>
                        <td style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px"><strong><br>Employee ID :&nbsp;&nbsp; <?=$emp_id;?> </strong>&nbsp;<strong> <?=$space?>Article Number: <b style="border-bottom: 1px dotted black;"><?=$space.$articleID.$space;?></b></strong><br><br><strong>Mr/Ms. <b style="border-bottom: 1px dotted black;"> <?=$space.$name.$space?> </b> </strong>&nbsp;<strong> <?=$space?>Designation. <b style="border-bottom: 1px dotted black;"><?=$space.$Designation.$space;?></b></strong></td>
                        <td width="0" height="0" align="center" valign="middle" style="padding:0px;border-bottom:0px solid #999999;"> <img src="<?= $pic; ?>" width="100" height="130" border="1"></td>
                     </tr>
                  </table>
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width:0px;border-color: #999999;margin-top:5px ;">
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>College Name :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$CollegeName.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Department :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$Department.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Particular's :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$category.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Description :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$description.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Remarks :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$remarks.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Date of Issue :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$issue_date.$space;?>  </strong></td>
                     </tr>
                     <?php 
                     if (isset($return_date)) 
                     {
                     ?>
                     <tr height="50px">
                        <td width="16%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Date of Return :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$return_date.$space;?>  </strong></td>
                     </tr>
                     <?php 
                        }
                     ?>
                  </table>
                  <table>  
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                  </table>
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width:0px;border-color: #999999;margin-top:5px ;">
                     <tr height="50px">
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px"><strong >Receiver's Signature<br>
                           <small ><?=$name?> </small> </strong>
                        </td>
                        <td  align="right" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px"><strong>Issuing Authority<br>
                           <small><?=$Name_autho;?><br><?=$desi_autho;?></small></strong>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr>
   <td>
      &nbsp;
   </td>
</tr>
         <tr>
            <td>
               <hr>
            </td>
         </tr>
<tr>
   <td>
      &nbsp;
   </td>
</tr>
<!--------------------------------------------------------------------->
    
            <tr>
               <td align="center" valign="top"  >
                  <table border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width: 0px;border-color: #999999;width:100%;">
                     <tr>
                        <td>
                           <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                 <td></td>
                                 <td width="42%" height="0" align="left" valign="middle"><img src="http://gurukashiuniversity.co.in/gkuadmin/images/web-logo.png" height="60" width="250"></td>
                                 <td  width=''align="left"><span style="font-size: 24px;font-weight: bold;font-family:Arial, Helvetica, sans-serif;"><u>Acknowledgement Slip</u></span>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width:0px;border-color: #999999;margin-top:5px ;">
                     <tr>
                        <td style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px"><strong><br>Employee ID :&nbsp;&nbsp; <?=$emp_id;?> </strong>&nbsp;<strong> <?=$space?>Article Number: <b style="border-bottom: 1px dotted black;"><?=$space.$articleID.$space;?></b></strong><br><br><strong>Mr/Ms. <b style="border-bottom: 1px dotted black;"> <?=$space.$name.$space?> </b> </strong>&nbsp;<strong> <?=$space?>Designation. <b style="border-bottom: 1px dotted black;"><?=$space.$Designation.$space;?></b></strong></td>
                        <td width="0" height="0" align="center" valign="middle" style="padding:0px;border-bottom:0px solid #999999;"> <img src="<?= $pic; ?>" width="100" height="130" border="1"></td>
                     </tr>
                  </table>
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width:0px;border-color: #999999;margin-top:5px ;">
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>College Name :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$CollegeName.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Department :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$Department.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Particular's :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$category.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Description :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$description.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Remarks :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$remarks.$space;?>  </strong></td>
                     </tr>
                     <tr height="50px">
                        <td width="15%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Date of Issue :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$issue_date.$space;?>  </strong></td>
                     </tr>
                     <?php 
                     if (isset($return_date)) 
                     {
                     ?>
                     <tr height="50px">
                        <td width="16%" align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;"><strong>Date of Return :</strong></td> 
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px ;" class="underline"><strong><?=$space.$return_date.$space;?>  </strong></td>
                     </tr>
                     <?php 
                        }
                        unset($return_date);
                     ?>
                  </table>
                  <table>  
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                     <tr>
                        <td>&nbsp;</td>
                     </tr>
                  </table>
                  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-style: solid; border-width:0px;border-color: #999999;margin-top:5px ;">
                     <tr height="50px">
                        <td  align="left" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px"><strong >Receiver's Signature<br>
                           <small ><?=$name?> </small> </strong>
                        </td>
                        <td  align="right" valign="top" style="font-size:20px;;font-family:Arial, Helvetica, sans-serif;padding-left:5px"><strong>Issuing Authority<br>
                           <small><?=$Name_autho;?><br><?=$desi_autho;?></small></strong>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>


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