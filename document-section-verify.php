<?php 
   include "header.php"; 
  
$tz = 'Asia/Kolkata';   
   date_default_timezone_set($tz);  ?>
   <!-- Modal -->
<div class="modal fade" id="verifyActionModal" tabindex="-1" role="dialog" aria-labelledby="verifyActionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="verifyActionModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="sicActionModalLabel_Record">
        
      </div>
      
    </div>
  </div>
</div>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card card-info " id="myCollapsible">
               <div class="card-header">
                  <div class="row">
                     <div class="col-lg-1">
                        <h3 class="card-title">Examination</h3>
                     </div>
                     <div class="col-lg-11">
                        <div class="card-tools">
                           <div class="row">
                             
                              <div class="col-lg-7">

                              </div>
                              <div class="col-lg-5">
                                 <form action="verify-document-record-print.php" method="post" target="_blank">   
                                    <div class="input-group input-group-sm">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text bg-danger" id="inputGroup-sizing-sm">Start</span>
                                       </div>
                                       <input required type="datetime-local" class="form-control" name="startDate" aria-describedby="button-addon2">
                                       &nbsp;
                                       <div class="input-group-prepend">
                                          <span class="input-group-text bg-success" id="inputGroup-sizing-sm">End</span>
                                       </div>
                                       <input required type="datetime-local" class="form-control" name="endDate" aria-describedby="button-addon2">
                                       <button class="btn btn-info btn-sm" type="submit" id="button-addon2" ><i class="fa fa-file-export"></i></button>
                                    </div>
                                 </form>
                              </div>
                                 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body collapse"  id="student_search_record">
                  
                  
               </div>
            </div>
         </div>
      
         <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                        <div class="btn-group w-100 mb-2">
                    <a class="btn" id="btn1"style="background-color:#223260; color: white; border: 1px solid;" onclick="verify_home();bg(this.id);"> Home </a>
                    <a class="btn" id="btn2" style="background-color:#223260; color: white; border: 1px solid;" onclick="verify_issued();bg(this.id);"> Issued </a>
                    <a class="btn" id="btn3" style="background-color:#223260; color: white; border: 1px solid;" onclick="verify_forward();bg(this.id);"> Forwarded </a>
                    <a class="btn"  id="btn4" style="background-color:#223260; color: white; border: 1px solid;" onclick="verify_verified();bg(this.id);"> Verified </a>
                    <!-- <a class="btn"  id="btn5" style="background-color:#223260; color: white; border: 1px solid;" onclick="verify_pending();bg(this.id);"> Pending </a>    -->
            </div>
               </div>
               <div class="card-body table-responsive" id="lab_users_data" style="font-size:12px;">

           <table class="table  " id="example" > 
            <thead>
              <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>RollNo</th>
                  <th>Name</th>
                  <th>FatherName</th>
                  <th>MotherName</th>
                  <th>Course/Department</th>
                  <th>Batch</th>
                  <th>Mode</th>
                  <th>Document</th>
                  <th>Apply Date</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM sic_document_record  where status='4'  ORDER BY status ASC";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    
                        $result1 = "SELECT  * FROM Admissions where IDNo='".$row['idno']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $father_name = $row1['FatherName'];
                           $mother_name = $row1['MotherName'];
                           $college = $row1['CollegeName'];
                           $batch = $row1['Batch'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);
                    include "document-section-tr-color.php";
                           ?>
                             <tr style='background:<?=$clr;?>'>
                        <?php
                     
                     ?>
                      <td><?=$count++?></td>
                       <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"  alt="User Avatar"  onClick="verifyActionModal(<?=$row['idno'];?>);"></td>
                       <td><?=$userId?></td>
                       <td><?=$name?></td>
                       <td><?=$father_name?></td>
                       <td><?=$mother_name?></td>
                       <td><?=$Department?></td>
                       <td><?=$batch?></td>
                       
                    <td><?=$row['receive_by']?></td>
                      <td><?=$row['document_type']?></td>
                      <td><?=$row['apply_date']?></td>
                      <td><?php  if($row['status']==0)
                      {
                        echo "Draft";
                      }elseif($row['status']==1)
                      {
                        echo "Printed";
                      }elseif($row['status']==2)
                      {
                        echo "Issued";
                      }elseif($row['status']==3)
                      {
                        echo "Rejected";
                      }elseif($row['status']==4)
                      {
                        echo "Posted";
                      }?></td>
                      <td>
                        <?php  if($row['status']==0)
                      {
                       echo"";
                      }
                      elseif($row['status']==1)
                      {
                        echo "Printed";
                      }
                      elseif($row['status']==2)
                      {
                        echo "Issued";
                      }
                      elseif($row['status']==3)
                      {
                        echo ' <div class="btn-group">
                        <button type="button" class="btn btn-success btn-xs">Accept</button>
                        
                       
                      </div>';
                      }
                      elseif($row['status']==4)
                      {
                        echo ' <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-xs" onclick="acceptByVerifiedAuth(\'' . $row['idno'] . '\');">Accept</button>
                        
                       
                      </div>';
                      }?>
                       
                    </td>
                   
            
                  </tr>
                  <?php 
                        }
                    }
                 }
              
             
            ?>
          </tbody>
        </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
     $(window).on('load', function() 
          {
         $('#btn1').toggleClass("bg-success"); 
           })
    function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }
   function labUsers() //ok
   {
       var code='108';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });
   }
function verify_home()
{
labUsers();
}
  function verify_issued()
   {
        var code='111';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });

   }
function verify_forward()
{
  var code='109';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });
}
function verify_verified(){
  var code='110';
         $.ajax({
         url:'action_g.php',
         data:{code:code},
         type:'POST',
         success:function(data)
         {
            document.getElementById("lab_users_data").innerHTML=data;
            $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
         }
         });
}

function acceptByVerifiedAuth(IDNo)
 {
      var code='117';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo},
         type:'POST',
         success:function(data)
         {
            console.log(data);
           if (data==1) 
           {
                labUsers();
           }
         }
         });
 }
 function verifiedByVerifiedAuth(IDNo)
 {
      var code='118';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo},
         type:'POST',
         success:function(data)
         {
            console.log(data);
           if (data==1) 
           {
                labUsers();
           }
         }
         });
 }
function handBySicAction(IDNo){
    
    var Empid=document.getElementById("EmpID").value;
   var code='126';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo,Empid:Empid},
         type:'POST',
         success:function(data)
         {
            console.log(data);
           if (data==1) 
           {
                labUsers();
           }
         }
         });
}
 
 function PostByVerifiedAuth(IDNo){
  var code='121';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo},
         type:'POST',
         success:function(data)
         {
            
    document.getElementById("sicActionModalLabel_Record").innerHTML=data;

         }
         });
}
function handOverToByVerifiedAuth(IDNo)
{
  var code='125';
         $.ajax({
         url:'action_g.php',
         data:{code:code,idno:IDNo},
         type:'POST',
         success:function(data)
         {      
    document.getElementById("sicActionModalLabel_Record").innerHTML=data;
         }
         });
}
function verifyActionModal(IDNo) {
    document.getElementById("verifyActionModalLabel_Record").innerHTML=IDNo;
}
</script>
<?php 
   include "footer.php"; 
   ?>