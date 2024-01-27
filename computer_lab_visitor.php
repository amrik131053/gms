<?php 
   include "header.php"; 
  
$tz = 'Asia/Kolkata';   
   date_default_timezone_set($tz);  ?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12" >
            <div class="card card-info " id="myCollapsible">
               <div class="card-header">
                  <div class="row">
                     <div class="col-lg-1">
                        <h3 class="card-title">Search</h3>
                     </div>
                     <div class="col-lg-11">
                        <div class="card-tools">
                           <div class="row">
                              <div class="col-lg-3">
                                 <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" id="userId" placeholder="Employee ID / Roll Number" aria-describedby="button-addon2">
                                    <button class="btn btn-info btn-sm" type="button" id="button-addon2"  onclick="searchUser()"><i class="fa fa-search"></i></button>
                                 </div>
                              </div>
                              <div class="col-lg-4">

                              </div>
                              <div class="col-lg-5">
                                 <form action="computer-center-visitor-report-print.php" method="post" target="_blank">   
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
                  <h3 class="card-title">Computer Lab Visitor</h3>
                  <div class="card-tools">
                  </div>
               </div>
               <div class="card-body table-responsive" id="lab_users_data">

           <table class="table  " id="example">  <thead>
              <tr>
                  <th>#</th>
                  <th><input type="checkbox" id="select_all1" onclick="verifiy_select();" class=""></th>
                 <th>Image</th>
                 <th>IDNo</th>
                  <th>Name</th>
                  <th>Course / Department</th>
                <th>College</th>
                <th>System Number</th>
                  <th>Entry Time</th>
                  <th>Exit Time</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
            <?php
   $date=date('Y-m-d');
             
               
                
                $sql = "SELECT * FROM computer_lab_entry where entry_time like '$date%' ORDER BY Status ASC ";
                $result = mysqli_query($conn, $sql);
                $count = 1;
                if(mysqli_num_rows($result) > 0)
                {
                  while($row = mysqli_fetch_array($result))
                  {
                     $userId='';
                    if (strlen($row['UserID'])>=7) 
                    {
                        $result1 = "SELECT  * FROM Admissions where UniRollNo='".$row['UserID']."' or ClassRollNo='".$row['UserID']."' or IDNo='".$row['UserID']."'";
                        $stmt1 = sqlsrv_query($conntest,$result1);
                        while($row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC) )
                        {
                           $userId.=$ClassRollNo= $row1['ClassRollNo'];
                           $userId.="/".$UniRollNo= $row1['UniRollNo'];
                           $name = $row1['StudentName'];
                           $college = $row1['CollegeName'];
                           $Department = $row1['Course'];                           
                           $img= $row1['Snap'];
                           $pic = 'data://text/plain;base64,' . base64_encode($img);
                        }
                    }
                    else
                    {
                        $sql1 = "SELECT * FROM Staff Where IDNo='".$row['UserID']."'";
                        $q1 = sqlsrv_query($conntest, $sql1);
                        if ($row1 = sqlsrv_fetch_array($q1, SQLSRV_FETCH_ASSOC)) 
                        {

                           $userId.= $row1['IDNo'];
                           $name = $row1['Name'];
                           $fatherName = $row1['FatherName'];
                           $college = $row1['CollegeName'];
                           $Designation = $row1['Designation'];
                           $Department = $row1['Department'];
                           $EmailID = $row1['EmailID'];
                           $ContactNo = $row1['ContactNo'];
                           if ($ContactNo=='') 
                           {
                              $ContactNo = $row1['MobileNo'];
                           }
                           $img= $row1['Snap'];
                        $pic = 'data://text/plain;base64,' . base64_encode($img);
                        }
                    }
                    if($row["status"] == "1")
                    {
                     ?>
                      <tr style='background:#98FF98; height:30px;'>
                        <?php
                     }
                    else
                    {
                     ?>
                      <tr style='background:#E3F9A6;height:30px;'>
                        <?php
                     }
                     ?>
                      <td><?=$count++?></td>
                       <th>
                          <?php
                       if($row["status"] == "1")
                    {
                     ?>
                     <?php }
                     else {?>
                        <input type="checkbox" class="checkbox v_check" value="<?=$row['id']?>">
                     <?php } ?>

                  </th>
                       <td><img class="img-circle elevation-2" width="50" height="50" style="border-radius:50%" src="<?=$pic?>"  alt="User Avatar"></td>
                       <td><?=$userId?></td>
                       <td><?=$name?></td>
                       <td><?=$Department?></td>
                       <td><?=$college?></td>
                    <td><?=$row['system_number']?></td>
                      <td><?=$row['entry_time']?></td>
                      <?php
                       if($row["status"] == "1")
                    {
                     ?>
                     <td><?=$row['exit_time']?></td>
                      <td><b>Checked Out</b></td>
                        <?php
                     }
                    else
                    {
                     ?>
                      <td></td>
                      <td><i onclick="checkOutLab(<?=$row['id']?>)" class='fa fa-sign-out-alt'></i></td>
                        <?php
                     }
                     ?>

                      
                  </tr>


                      <?php
                  }
                }
            ?>
              <tr>
            <td colspan="13"> <button type="submit" id="type" onclick="verifyAll();" name="update" class="btn btn-success " style="float:right;">Check out all</button></td>
         </tr>
          </tbody>
        </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<script type="text/javascript">
   function labUsers() 
   {
       var code='176';
         $.ajax({
         url:'action.php',
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
   function checkOutLab(id) 
   {
      var code='177';
         $.ajax({
         url:'action.php',
         data:{code:code,id:id},
         type:'POST',
         success:function(data)
         {
            labUsers();
            // location.reload(true);
            // document.getElementById("lab_users_data").innerHTML=data;
            // $('#example').DataTable({ 
                      // "destroy": true, //use for reinitialize datatable
                   // });
         }
         });
   }





function verifyAll()
{
  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=359;

  var subjectIDs=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            subjectIDs.push(verifiy[i].value);
          }
     }
  if((typeof  subjectIDs[0]== 'undefined'))
  {
     //alert(len_student);
    ErrorToast(' Select atleast one ' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action.php',
         data:{subjectIDs:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            //console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully Verified');
            //    search_study_scheme();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
}



   function verifiy_select()
{
        if(document.getElementById("select_all1").checked)
        {
            $('.v_check').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.v_check').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.v_check').on('click',function()
    {
        var a=document.getElementsByClassName("v_check:checked").length;
        var b=document.getElementsByClassName("v_check").length;
        
        if(a == b)
        {

            $('#select_all1').prop('checked',true);
        }
        else
        {
            $('#select_all1').prop('checked',false);
        }
    });
 
} 

   function assignSystem(id) 
   {
      var systemNo=document.getElementById('systemNumber').value;
      var remarks=document.getElementById('remarks').value;
      if (systemNo!='' && remarks!='') 
      {
         var code='175';
         $.ajax({
         url:'action.php',
         data:{code:code,id:id,systemNo:systemNo,remarks:remarks},
         type:'POST',
         success:function(data){
            // console.log(data);
         if(data != "")
         {
            labUsers();
            document.getElementById('userId').value='';
            $("#student_search_record").collapse('hide');
         }
         }
         });
         
      }
      else
      {
         ErrorToast('Select All Values.','bg-warning');
      }
   }
   function searchUser() 
   {
      var userId=document.getElementById('userId').value;
      // alert(userId);
       var code='174';
         $.ajax({
         url:'action.php',
         data:{code:code,userId:userId},
         type:'POST',
         success:function(data){
            // console.log(data);
         if(data != "")
         {
            document.getElementById('student_search_record').innerHTML=data;
            $("#student_search_record").collapse('show');
         }
         }
         });
   }
</script>
<?php 
   include "footer.php"; 
   ?>