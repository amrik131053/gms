<?php
session_start();
$timeStamp=date('Y-m-d H-i');
$todaydate=date('Y-m-d');
 date_default_timezone_set("Asia/Kolkata");
      $date=date('Y-m-d'); 
ini_set('max_execution_time', '0');
   if(!(ISSET($_SESSION['usr']))) 
   {
?>
<script> window.location.href = 'index.php'; </script> 
<?php
   }
   else
   {
   date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)
   
   $EmployeeID=$_SESSION['usr'];
   if ($EmployeeID==0 || $EmployeeID=='') 
      {?>
<script type="text/javascript">
   window.location.href="index.php";
</script>
<?php }
}
   include "connection/connection.php";  
    include "connection/connection_web.php";
 $code = $_POST['code'];
     if ($code=='1') 
     {

      $id= $_POST['id'];
         $panel_id= $_POST['panel_id'];
  
    $reaserch= $_POST['research'];
        $ts= $_POST['ts'];
            $sc= $_POST['sc'];

    $comm= $_POST['comm'];
   
    
  $sql = "INSERT INTO evaluation (recruitment_id,ResearchApptitude,SubjectContent,Communication,TeachingSkills,emp_id,panel_id) VALUES ('$id','$reaserch','$sc','$ts','$comm','$EmployeeID','$panel_id')";
    $res = mysqli_query($conn_recruitment, $sql);
   

                     }
                     else if($code==2)
                     {?>

<div class="card-body table-responsive">
 <table class="table">
  
         <th>Sr No</th> <th>Reg ID</th><th>Name</th><th>Department/Subject</th><th>Research Apptitude (10)</th><th>Teaching Skills(15)</th><th>Subject Content(15)</th><th>Communication(10)</th><th>Action</th>
              
               <?php 

               $sr=1; 

        $panel="SELECT *,basic_detail.id as myid,panel.id as pid FROM  panel_members INNER JOIN panel ON panel.id =panel_members.panel_id 
               inner join basic_detail on panel.PanelSubject=basic_detail.department inner join recruitment as rec on rec.r_id=panel.recruitment  

                WHERE panel_members.emp_id='$EmployeeID' AND panel.interviewDate='$date'  ANd rec.r_status='Active' ANd Eligibility='1' ";

                  $panel_run=mysqli_query($conn_recruitment,$panel);
                                    while ($p_row=mysqli_fetch_array($panel_run)) 
                                    {

                                       ?>
                                       <tr>
         <td><?php echo $sr;?>   </td>
         <td>  <b><?php echo  $muids=$p_row['myid'];?></b>
            <input type="hidden" class="form-control" style="width: 80px;"  value="<?php echo  $pid=$p_row['pid'];?>"  max="10" id="panel_id" >
</td> 
                <td>  <b><?php echo $p_row['candidate_name'];?></b></td> 
                  <td>  <b><?php echo $p_row['department'];?></b></td>
<?php 
 $panel_e="SELECT * FROM  evaluation where recruitment_id='$muids' AND emp_id='$EmployeeID'";

                  $panel_eva=mysqli_query($conn_recruitment,$panel_e);

                  if(mysqli_num_rows($panel_eva)>0)
                  {
                    while ($pe_row=mysqli_fetch_array($panel_eva)) 
                                    {
                                       $updateid=$pe_row['id'];

                                       ?>
                  

                  <td> <input type="number" class="form-control" style="width: 80px;"  max="10" id="<?=$updateid;?>_research" value="<?php echo $pe_row['ResearchApptitude'];?>"></td> 
                   <td> <input type="number" class="form-control" style="width: 80px;" max="15"  id="<?=$updateid;?>_ts"  value="<?php echo $pe_row['TeachingSkills'];?>"></td>
                  <td> <input type="number" class="form-control" style="width: 80px;"   max="15" id="<?=$updateid;?>_sc" value="<?php echo $pe_row['SubjectContent'];?>"></td> 
                  <td> <input type="number" class="form-control" style="width: 80px;"  max="10" id="<?=$updateid;?>_comm" value="<?php echo $pe_row['Communication'];?>"></td> 
                 
                  <td> <?php if($pe_row['status']>0 ||$pe_row['attendance']>0 )
                  { 
                  if($pe_row['attendance']>0)
                  {
                     echo "Absent";
                  }
                  else
                  {
                     echo $pe_row['Score'];
                  }
                  }
                  else
                  {?><button class="btn btn-warning btn-xs" onclick=" correctmarks(<?=$updateid;?>)"> Update</button> <button class="btn btn-danger btn-xs"  onclick="lock(<?=$updateid;?>)">Lock</button>

                 <?php }?>


                     </td>


                                <?php 
                             }
                          }
                          else
                          {?>
                           
<td> <input type="number" class="form-control" style="width: 80px;"  value="0"  max="10" id="<?=$muids;?>_research" ></td> 
                  <td> <input type="number" class="form-control" value="0" max="15" style="width: 80px;"   id="<?=$muids;?>_ts"  ></td> 
                  <td> <input type="number" class="form-control"  value="0" max="15" style="width: 80px;"  id="<?=$muids;?>_sc"  ></td> 
                  <td> <input type="number" class="form-control"  value="0"  max="10" style="width: 80px;" id="<?=$muids;?>_comm"  ></td> 
<td><button class="btn btn-info btn-xs" onclick="UpdateMarks(<?=$muids;?>)">Update</button> 
<button class="btn btn-danger btn-xs" onclick="Absent(<?=$muids;?>)">Absent</button> </td> 
                        <?php  }



                                $sr ++;   }
                                    ?>
                                    </tr>
     </table> </div>

                  <?php    }


   else if ($code=='3') 
     {

      $id= $_POST['id'];
        
  
    $reaserch= $_POST['research'];
        $ts= $_POST['ts'];
            $sc= $_POST['sc'];

    $comm= $_POST['comm'];
   
    $sql = "Update evaluation set ResearchApptitude='$reaserch',SubjectContent='$sc',Communication='$comm',TeachingSkills='$ts' where id='$id'";
$res = mysqli_query($conn_recruitment, $sql);


    
   

                     }

  else if ($code=='4') 
     {

     $id= $_POST['id'];
        
  
    $reaserch= $_POST['research'];
        $ts= $_POST['ts'];
            $sc= $_POST['sc'];

    $comm= $_POST['comm'];

    $score=$reaserch+$ts+$sc+$comm;
   
    $sql = "Update evaluation set ResearchApptitude='$reaserch',SubjectContent='$sc',Communication='$comm',TeachingSkills='$ts',Score='$score',status='1' where id='$id'";
$res = mysqli_query($conn_recruitment, $sql);
       }

   else if ($code=='5') 
     {

     
      $id= $_POST['id'];
        
    $panel_id= $_POST['panel_id'];
    $reaserch= $_POST['research'];
        $ts= $_POST['ts'];
            $sc= $_POST['sc'];

    $comm= $_POST['comm'];
   
    
  echo  $sql = "INSERT INTO evaluation (recruitment_id,ResearchApptitude,SubjectContent,Communication,TeachingSkills,emp_id,attendance,status,Score,panel_id) VALUES ('$id','$reaserch','$sc','$ts','$comm','$EmployeeID','1','1','0','$panel_id')";
    $res = mysqli_query($conn_recruitment, $sql);
   
      }
                  ?>
