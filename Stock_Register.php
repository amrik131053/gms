<?php
 include "connection/connection.php";
 $ID=$_POST['ID'];
 $location=" SELECT * , rm.Floor as FloorName, rm.RoomNo as abc, lm.RoomNo as RoomNo ,lm.ID as L_ID from location_master lm INNER JOIN room_master rm on lm.Floor=rm.FloorID INNER JOIN room_name_master rnm on lm.RoomName=rnm.ID INNER JOIN room_type_master rtm on lm.Type=rtm.ID INNER join building_master bm on lm.Block=bm.ID where lm.ID='$ID'";
            
                $location_run=mysqli_query($conn,$location);
                if ($location_row=mysqli_fetch_array($location_run)) 
                {
                   $LocationID=$location_row['L_ID'];
              $Name=$location_row['Name'];
              $FloorName=$location_row['FloorName'];
              $RoomNo=$location_row['RoomNo'];
              $RoomType=$location_row['RoomType'];         
              $RoomName=$location_row['RoomName'];         
              $location_owner=$location_row['location_owner'];
            }
          
?>
<style>
 #row{
   -webkit-print-color-adjust: exact; 
   }
      tr.border-bottom td {
        border-bottom: 1pt solid #ff000d;
      }
    </style>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" class="notranslate" translate="no"> 
<head>
 <meta name="google" content="notranslate" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" language="javascript1.2"> 
<!--
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
</script>
<script async src='/cdn-cgi/challenge-platform/h/b/scripts/invisible.js?ts=1650157200'></script></head>
<body oncontextmenu="return false" style="margin:0px;text-align:center ">
  
<span class="notranslate">

<!-- ------------------------page 1st-----------------------------------------------------------  --> 
<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1000px;  ">
<tr>
  <td rowspan="3" align="center" valign="top" nowrap ></td>
  <td height="1" align="center" valign="top"></td>
  <td rowspan="3" align="center" valign="top" nowrap ></td>
</tr>
<tr>
  <td align="center" valign="top"  >
    <table border="0" width="100%"  height="1200" align="center" cellpadding="0" cellspacing="0" style=" ">
    <tr>
      <td><table width="100%" height="600" border="0" cellspacing="0" cellpadding="0" >

             <tr>
            <td width="30%" height="0" align="left" valign="middle" style="line-height:18px;padding:5px 0px 5px 20px"> 
      
  </td><br><br><br><br>
            <td  align="center"><h1 style="font-size: 70px;">Stock Register</h1></td>
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 12px;font-weight: bold;font-family:Arial, Helvetica, sans-serif;line-height:18px;padding:0px 0px 0px 25px" >
      </td>
          </tr>
          <tr>
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 13px;font-weight: bold;line-height:18px;padding:5px 0px 5px 20px">  
           <br>
           </td>
            <td  align="center"><h4 style="font-size: 50px;"><?=$RoomName;?></h4></td>
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 12px;font-weight: bold;font-family:Arial, Helvetica, sans-serif;line-height:18px;padding:0px 0px 0px 25px" >
      </td>
          </tr> <tr>
            
            <td colspan="3" align="center"><h4 style="font-size: 40px;">Block- <?=$Name;?> | Floor <?=$FloorName;?> | Room No <?=$RoomNo;?></h4></td>
            
          </tr>
           <tr>
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 13px;font-weight: bold;line-height:18px;padding:5px 0px 5px 20px"></td>
            <td  align="center"><img src="https://www.iaspaper.net/wp-content/uploads/2018/09/Guru-Kashi-University.png" width="500" height="400"></td>
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 12px;font-weight: bold;font-family:Arial, Helvetica, sans-serif;line-height:18px;padding:0px 0px 0px 25px" >
      </td>
          </tr>
            <tr>
            
            <td colspan="3"  align="center"><h1 style="font-size: 70px;">Guru Kashi University</h1></td>
          
          </tr>
          <tr>
          
            <td colspan="3"  align="center"><h5 style="font-size: 40px;">Talwandi Sabo (Bathinda) Punjab ,India</h5></td>
            
          </tr> 
      </table></td>
    </tr>
  </table>
</td>
</tr>
  
</table>
  <div style="page-break-after:always;margin:0px 0px 0px 0px;padding: 0px 0px 0px 0px;"> </div>

<!-- ------------------------page 2nd-----------------------------------------------------------  -->
 
<table border="0" id="tbl1" align="center" cellpadding="0" cellspacing="0" style="width:1000px;height:1000px;  ">
<tr>
  <td rowspan="3" align="center" valign="top" nowrap ></td>
  <td height="1" align="center" valign="top"></td>
  <td rowspan="3" align="center" valign="top" nowrap ></td>
</tr>
<tr>
  <td align="center" valign="top"  >
    <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0"  >
    <tr>
      <td><table width="100%"  border="0" cellspacing="0" cellpadding="0" >

             <tr >
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 13px;font-weight: bold;line-height:18px;padding:5px 0px 5px 20px"> 
            </td>
             <td  align="center"><h2 style="font-size: 45; text-decoration: underline; text-decoration-thickness: 12%;"><span style=''>&#9755;</span>INDEX<span style=''>&#9754;</span></h2></td>
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 12px;font-weight: bold;font-family:Arial, Helvetica, sans-serif;line-height:18px;padding:0px 0px 0px 25px" >
      </td>
          </tr>
        

          <table border="1" width="100%"  style="border: 1px solid black; border-collapse: collapse;">
            <tr style="font-size: 25px; background-color: #808080; color: white; height: 50px;" id="row">
              <th>Sr. No</td>
              <th>Article Name</th>
              <th>Count</th>
              <th>Page</th>
              
            </tr>
          
  <?php  
              $srno=1;  
             
               $page_start=3;
               $page_end=0;
                    $Count_Article=" SELECT distinct ma.ArticleCode, ma.ArticleName FROM stock_summary ss INNER JOIN master_article ma  ON ma.ArticleCode=ss.ArticleCode  where ss.LocationID='$LocationID' and ss.Status='2'";
                  $Count_Article_run=mysqli_query($conn,$Count_Article);
                while($Count_Article_row=mysqli_fetch_array($Count_Article_run)) 
                { 
                  $c_count=0;
                $articlename=$Count_Article_row['ArticleName'];
                 $articlecode=$Count_Article_row['ArticleCode'];  
                   $CoArticle=" SELECT  * FROM stock_summary ss INNER JOIN master_article ma  ON ma.ArticleCode=ss.ArticleCode  where ss.ArticleCode='$articlecode' and ss.LocationID='$LocationID' and ss.Status='2'";
                  $CoArticle_run=mysqli_query($conn,$CoArticle);
                while($CoArticle_row=mysqli_fetch_array($CoArticle_run)) 
                {
               $c_count++;
                 }
                 if ($articlename=='CPU')
                             {
                 $page=ceil($c_count/10);
                             }else
                             {
                              $page=ceil($c_count/20);
                             }
                 
                 $page_end=$page_start+$page-1;
            ?>
              <tr align="center" style="font-size: 25px;">
              <td><?=$srno;?></td>
              <td><?=$articlename;?></td>
              <td><?=$c_count;?></td>
              <td><?php if ($page_start==$page_end)
               {
               echo $page_start;
                # code...
              } else
              {
                echo $page_start."-".$page_end;
              }?></td>
               </tr>
    <?php 
$srno++;
$page_start=$page_end+1;

}?>
          </table>
  
      </table>
</td>

</tr>
  <!-- <tr>
  <td height="1" align="center" valign="bottom"   >Page No: 2</td>
  </tr> -->
  <table>
    <!-- <tr>
  <td height="1" align="Right" valign="button"   >Page No: 2</td>
  </tr> -->
  </table>
</table>

  <div style="page-break-after:always;margin:0px 0px 0px 0px;padding: 0px 0px 0px 0px;"> </div>





 <!-- ------------------------page 3rd-----------------------------------------------------------  -->

<?php  

// for ($i=1; $i <=$articlecode ; $i++) { 
//  # code...
 $srno=1;  
$pagebottomNumber=3;
    $Page_Article=" SELECT distinct ma.ArticleCode, ma.ArticleName FROM stock_summary ss INNER JOIN master_article ma  ON ma.ArticleCode=ss.ArticleCode  where ss.LocationID='$LocationID' and ss.Status='2'";
                  $Page_Article_run=mysqli_query($conn,$Page_Article);
                while($Page_Article_row=mysqli_fetch_array($Page_Article_run)) 
                { 
                  
                $ArticleNameHead=$Page_Article_row['ArticleName'];
                $ArticleCodeHead=$Page_Article_row['ArticleCode'];
 ?>


<table border="0" align="center" cellpadding="0" cellspacing="0" style="width:1000px;height:1000px;  ">

<tr>
  <td align="center" valign="top">

    <table border="0" width="100%" align="center" cellpadding="0" cellspacing="0" >

    <tr>
      <td><table width="100%"  border="0" cellspacing="1" cellpadding="1">
             <tr>
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 13px;font-weight: bold;line-height:18px;padding:5px 0px 5px 20px"> 
       </td>
            <td  align="center"><h2 style="font-size: 40px;"><?=$ArticleNameHead;?></h2></td>
            <td width="30%" height="0" align="left" valign="middle" style="font-size: 12px;font-weight: bold;font-family:Arial, Helvetica, sans-serif;line-height:18px;padding:0px 0px 0px 25px" >
      </td>
          </tr>  


          <table border="1" width="100%"  style="border: 1px solid black; border-collapse: collapse;">
            <tr style="font-size: 25px;  background-color: #808080; color: white; height: 50px;" id="row">
              <th style="">Sr. No</th>
              <th>QR No</th>
              <th>Bill No.</th>
                
                <th>Bill Date</th>
              <th>Specifications</th>
              <th>Device Serial No</th>
              <th>Local Serial No</th>
              <th>Date of Issue</th>
        <!-- <th>Received On</th> -->
            <!--   <th>Remarks</th> -->
              

              
            </tr>
          
                 <?php  
            
             
               $Countforpage=0;
                   $description="SELECT  * FROM stock_summary ss INNER JOIN master_article ma  ON ma.ArticleCode=ss.ArticleCode  where ss.LocationID='$LocationID' and ss.ArticleCode='$ArticleCodeHead ' and ss.Status='2'";            
            
                  $description_run=mysqli_query($conn,$description);
                while($description_row=mysqli_fetch_array($description_run)) 
                {
                  
              $Countforpage++;
              
            ?>
               <tr align="center" style="font-size: 25px;">
            
           <TD><?=$srno;?></TD>
          <TD>&nbsp;<?=$description_row['IDNo'];?>&nbsp;</TD>
           <TD><?=$description_row['BillNo'];?></TD>
           <TD><?=$description_row['BillDate'];?></TD>
            <td> <div style="max-height: 120px;align-content: center;">
               <?php 
            
               echo $description_row['CPU']."-".$description_row['Storage']."-".$description_row['Memory']."-".$description_row['OS']."-".$description_row['Brand']."-".$description_row['Model'];?>
            </div></td>
              <td>
              <?=$description_row['SerialNo'];?>
            </td>
            <td>
              <?=$description_row['DeviceSerialNo'];?>
            </td>
            <td>
               <?=$description_row['IssueDate'];?>
            </td>
          
               
         </tr>
    <?php 
 $srno++;

if($srno==11 and $ArticleNameHead=='CPU')
  {?>
    <tr height="250px" style="border-left: 1px solid #fff;border-right: 1px solid #fff;" ><td colspan="">
  
 <p style="page-break-before: always;">&nbsp; Page No:<?=$pagebottomNumber;?></p></td></tr>
<?php 
  }


}

$pagebottomNumber++;
?>
          </table>
  
      </table>
</td>
</tr>
  <tr>
  <td height="1" align="center" valign="bottom" > </td>
  </tr>
</table>

<p style="align:left;">Page No:<?=$pagebottomNumber;?></p>
  <div style="page-break-after:always;margin:0px 0px 0px 0px;padding: 0px 0px 0px 0px;"> </div> 
 <!-- ------------------------page 4th-----------------------------------------------------------  -->
<?php 
 // $pagebottomNumber++;

$srno=1;
if ($srno>=10) {
  ?><?php
}
}

?>


  </span>
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6fd182094c9f8483',m:'hwVN6GXvHYexZclQZJUSrFKHbdNUbXAOx8bVyEvXSpY-1650160206-0-AWTBxiwy+nwRmiSN9/OSS+8sqJOTzghIeKBZNWVr45G9J73BNDNAG5jBvebUOPzrPPyRr8IQtXkh1ua8suq0yOqqmnPJ3Dn3tI/yQA7tItQnRvVBvPcV/YyCARqzHGrbtheadqLJcqrwCijFlPnuYHr0N1tLOHh6ZDxRfnofAoEnZWIRqQcPSAZTLXVOj36x6w==',s:[0x6aa72617c0,0xc4ac533f3e],u:'/cdn-cgi/challenge-platform/h/b'}})();</script></body>
</html>
 
