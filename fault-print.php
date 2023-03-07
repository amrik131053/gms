<?php
   session_start();
   date_default_timezone_set("Asia/Kolkata");  
   ini_set('max_execution_time', '0');
include 'connection/connection.php';
  $space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$output = '';  
$ctime = date("d-m-Y");
$nowtime = strtotime($ctime);
//$reference=$_POST['IdNo'];

if(!(ISSET($_SESSION['usr']))) {
header('Location:index.php'); }



   $location_num=-1;
            $id=$_POST['id'];  
            $articleRemark='';
              $aaaa='';
            $count=0;
            
 // $location ="CALL print_track($id)";
 $location ="SELECT *,room_master.Floor as FloorName,room_master.RoomNo as RoomName ,faulty_track.reference_no as ref, stock_summary.Status as ss_status from faulty_track inner join stock_summary on faulty_track.article_no=stock_summary.IDNo INNER join master_article ma on stock_summary.ArticleCode=ma.ArticleCode left join location_master on location_master.ID=faulty_track.location_id left join building_master on building_master.ID=location_master.Block inner join room_master on room_master.RoomNo=location_master.RoomNo INNER join room_type_master as rtm ON rtm.ID=location_master.Type where faulty_track.token_no='$id'";

                $location_run=mysqli_query($conn,$location);

                while ($location_row=mysqli_fetch_array($location_run)) 
                {
                    $Block="Block: <b>".$location_row['Name']." </b>&nbsp;&nbsp;Floor: <b>".$location_row['FloorName']."</b><br>".$location_row['RoomType']."(<b>".$location_row['RoomName']."</b>)";
                    $empID=$location_row['location_owner'];
                  $staff="SELECT Name FROM Staff Where IDNo='$empID'";
                  $stmt = sqlsrv_query($conntest,$staff);  
                  while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
                  {
                     $Emp_Name=$row_staff['Name'];
                  }
// print_r($location_row);
               $count++;
                $location_num=$location_num+1;
                $article_num=$location_row['article_no'];
                $articleDescription="Particular: <b>".$location_row['ArticleName']." </b>&nbsp;&nbsp;<br> Description: <b>".$location_row['CPU']."</b>";
                $locID=$location_row['LocationID'];
                $ref=$location_row['ref'];
                $tokenNum=$location_row['token_no'];
                $emp=$location_row['updated_by'];
               $time=date("d-m-Y h-i", strtotime($location_row['time_stamp']));
                $staff="SELECT * FROM Staff Where IDNo='$emp'";
               $stmt = sqlsrv_query($conntest,$staff);  
               while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
               {
                  $Department=$row_staff['Department'];
                  $Designation=$row_staff['Designation'];
                  $CollegeName=$row_staff['CollegeName'];
                 $Emp_Name=$row_staff['Name'];
                 $Emp_Image=$row_staff['Snap'];
                 $emp_pic=base64_encode($Emp_Image);
               }
                   $aaaa.="<tr><td align='left'></b>";
                    if ($location_row['direction']=='Faulty')
                    {
                        $aaaa.="<div class='text-danger'>";
                    } 
                    elseif ($location_row['direction']=='Review') 
                    {
                       $aaaa.= "<div class='text-warning'>";
                    }
                    elseif ($location_row['direction']=='Working') 
                    {
                        $aaaa.="<div class='text-success'>";
                    }
                      $aaaa.="<b>".$location_row['direction']."</b><br>
                  </div> </td><td align='right'> Remarks: ".$location_row['remarks']."<br>".$Emp_Name."<br>".$time."</td></tr>";
              
            }

            ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en" class="notranslate" translate="no">
   <head>
      <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/adminlte.min.css">
      <link rel="stylesheet" href="style.css">

 <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap.min.css">

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
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <table border="0" class="table">
               <tr>
                  <th colspan="2">Complaint Track</th>
               </tr>
               <tr>
                  <td align="left">Complaint No.: <b><?=$id?></b>
                     <br>
                     <?=$Block?>
                  </td>
                  <td align="right">Article No.: <b><?=$article_num?></b>
                     <br>
                     <?=$articleDescription?>
                  </td>
               </tr>
      <?=$aaaa?>
            </table> 
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> </div>
         </div>
      </div>


      
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