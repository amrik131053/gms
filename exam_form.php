<?php

ini_set('max_execution_time', '0');

    include 'header.php';
?>
<p id="ajax-loader"></p>
  <section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
 <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
                <div class="row">
                  <div class="col-lg-4">    
               <h3 class="card-title">Exam From</h3>
                   </div>
                  <div class="col-lg-1">
                     <a href="formats/examform.csv" class="btn btn-warning "> Format</a>
                  </div>
                   <div class="col-lg-3">
                     <input type="text" class="form-control"  id="rollno" placeholder="RollNo">
                  </div>
                  <div class="col-lg-2">
                     <button type="button" class="btn btn-info" onclick="search_exam_form()">Search</button>
                  </div>
                  <div class="col-lg-2">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal_upload" style="float: right;">
               <i class="fa fa-upload" aria-hidden="true"></i>
               </button>  
                  </div>
               </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive  "  style="height: 600px; font-size: 14px;">
                            <table class="table table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Uni Roll No</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Sem</th>
                                        <th>Batch</th>
                                        <th>Examination</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Update</th> 
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_load">
<?php

                $list_sql = "SELECT TOP 100   ExamForm.Course,ExamForm.ReceiptDate, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
                FROM ExamForm INNER JOIN Admissions ON ExamForm.IDNo = Admissions.IDNo ORDER BY ExamForm.ID DESC"; 
                $list_result = sqlsrv_query($conntest,$list_sql);
                 $count = 1;
                if($list_result === false)
                 {
                die( print_r( sqlsrv_errors(), true) );
                }
              while( $row = sqlsrv_fetch_array($list_result, SQLSRV_FETCH_ASSOC) )
                    {
                $Status= $row['Status'];
                $issueDate=$row['SubmitFormDate'];
                echo "<tr>";
                echo "<td>".$count++."</td>";
                echo "<td>".$row['ID']."</td>";
                ?><td>
                <a href="" onclick="edit_stu(<?= $row['ID'];?>)" style="color:#002147;text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$row['UniRollNo'];?></a>
                 </td>
                <?php echo "<td>".$row['StudentName']."</a></td>";
                echo "<td>".$row['Course']."</td>";
                echo "<td>".$row['Semesterid']."</td>";
                echo "<td>".$row['Batch']."</td>";
                echo "<td>".$row['Examination']."</td>";
                if($row['ReceiptDate']!='')
                {
                  $rdate=$row['ReceiptDate']->format('Y-m-d');
                }
                else
                {
                $rdate='';
                }
?>
               <td>
              <?=$row['Type'];?>
              </td>
                <td>
                    <center><?php 

 if($Status==-1)
                {
                  echo "Fee<br>pending";

                }

                elseif($Status==0)
                {
                  echo "Draft";
                }elseif($Status==1)
                {
                  echo 'Forward<br>to<br>dean';
                }

                elseif($Status==2)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Department</b>";
                }
                 elseif($Status==3)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Dean</b>";
                }

                elseif($Status==4)
                {
                  echo 'Forward <br>to<br> Account';
                }
                elseif($Status==5)
                {
                  echo 'Forward <br>to<br> Examination<br> Branch';
                }
                elseif($Status==6)
                {
                  echo "<b style='color:red'>Rejected<br>By<br>Accountant</b>";
                }
                 elseif($Status==7)
                {
                  echo "<b style='color:red'>Rejected_By<br>Examination<br>Branch</b>";
                }           
                elseif($Status==8)
                {
                  echo "<b style='color:green'>Accepted</b>";
                }   ?>        
             </center>
               </td>  
               <td> <?php if($issueDate!='')
               {
               echo $t= $issueDate->format('Y-m-d'); 
               }
               else
               { 
               }
               ?>

              </td>
        <td> 
              <Select id='Status'  class="form-control">
                <option value="-1">Fee pending</option>
                <option value="0">Draft</option>
                <option value="4">Forward to Account</option>
                <option value="5">Forward to Examination Branch</option>
                <option value="8">Accepted</option>
              </Select>
        <input type="button" value="Update" class="btn btn-warning btn-xs" onclick="status_update(<?=$row['ID'];?>);">
    
  </td>
        <td>
            <a href="" style="text-decoration: none;">
<i class="fa fa-trash fa-md" onclick="delexam(<?= $row['ID'];?>)" style="color:red"></i></a>
       </td>
                <tr/>
           <?php 
            }
        ?>
      </tbody>
        </table>
            </div>
            <!-- /.card -->
         </div>
      </div>

      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>   
      <?php include'footer.php';?>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>



<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" >
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exam From Submit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body" id="edit_stu">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document"style="width: 700px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EmamFrom Submit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
        <div class="col-lg-12">
         <form id="submit_exam_form" method="post" enctype="multipart/form-data" action="action.php">
        <input type="hidden" name="code" value="203" >
            <div class="card-body">
               <div class="form-group row">
                  <div class="col-lg-6">
                     <label>Sem: </label>
                     <select name="sem" id="semester" class="form-control" required="">
                        <option value="1">1st </option>
                        <option value="2">2nd </option>
                        <option value="3">3rd </option>
                        <option value="4">4th </option>
                        <option value="5">5th </option>
                        <option value="6">6th </option>
                        <option value="7">7th </option>
                        <option value="8">8th </option>
                        <option value="9">9th </option>
                        <option value="10">10th</option>
                        <option value="11">11th</option>
                        <option value="12">12th</option>
                     </select>
                  </div>
                  <div class="col-lg-6">
                     <label>Type</label>
                            <select id="type" name="type" class="form-control" required="">
                       <option value="">Select</option>
                       <?php
               $sql="SELECT DISTINCT Type from ExamForm Order by Type ASC ";
               $stmt2 = sqlsrv_query($conntest,$sql);
                while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
             {    
            $Sgroup = $row1['Type'];  
               ?>
          <option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php         }
?>
              </select>
                  </div>
                  <div class="col-sm-6">
                     <label>Examination</label>
                       <select  id ="month" name="month" class="form-control" required="">
                        <option value="">Select</option>
                       <?php
               $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
                      $stmt2 = sqlsrv_query($conntest,$sql);
                 while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                     {    
                 $Sgroup = $row1['Examination'];  
                ?>
                    <option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                    <?php    }
                    ?>
              </select>
                  </div>
                
                  <div class="col-lg-6">  
                     <label>Excel Here:</label>
                     <input type="file" name="file_exl" id="file_exl" >
                  </div>
                  <div class="col-lg-6">
                     <label>Status</label>
                     <Select name='Status' id="Status"  class="form-control" required>
                        <option value="">Select</option>
                <option value="-1">Fee pending</option>
                <option value="0">Draft</option>
                <option value="4">Forward to Account</option>
                <option value="5">Forward to Examination Branch</option>
                <option value="8">Accepted</option>
              </Select>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               
                <input type="submit" value="Upload"  class="btn btn-primary" id="btnimport">


           
            </div>
            <p id="error" style="display: none;"></p>
            <!-- /.card-footer -->
            </form>
         </div>
         <!-- /.card -->
    
      

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
    </div>
  </div>
</div>

</body>
</html>
<script type="text/javascript">

  function status_update(id)
  {
  var r = confirm("Do you really want to Change");
  if(r == true) 
     {
          var status=document.getElementById('Status').value;
          var spinner=document.getElementById("ajax-loader");
          spinner.style.display='block';
          var code=213;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,status:status
              },
              success: function(response) 
              {
               spinner.style.display='none';
                if (response=='1')
                           {
                           SuccessToast('Successfully Update');
                           search_exam_form();
                          }
                          else
                          {
                           ErrorToast('Input Wrong ','bg-danger' );
                          }
                
              }
           });
  }
}  function delexam(id)
  {
  var r = confirm("Do you really want to Delete ");
  if(r == true) 
     {
     var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=212;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
                console.log(response);
               // spinner.style.display='none';
              // search_exam_form();
                if (response=='1')
                           {
                           SuccessToast('Successfully Delete');
                           
                          }
                          else
                          {
                           ErrorToast('Input Wrong ','bg-danger' );
                          }
                
              }
           });
  }
}

    function search_exam_form()
    {
       var rollNo=document.getElementById('rollno').value;
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=202;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,rollNo:rollNo
              },
              success: function(response) 
              {
               // $('#modal-lg-view-question').modal('toggle');
               spinner.style.display='none';
                document.getElementById("table_load").innerHTML=response;
                
              }
           });
    }  function exam_type_update(id)
    {
         var r = confirm("Do you really want to Change");
          if(r == true) 
           {
       var type=document.getElementById('type_').value;
       var examination=document.getElementById('examination_').value;
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(type+' '+examination);
     var code=208;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,examination:examination,type:type
              },
              success: function(response) 
              {
               
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully Update');
                           search_exam_form();
                          }
                          else
                          {
                           ErrorToast('Input Wrong ','bg-danger' );
                          }
                
              }
           });
       }
    }
         $(document).ready(function (e) {    // image upload form submit
           $("#submit_exam_form").on('submit',(function(e) {
              e.preventDefault();
              var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
              $.ajax({
                    url: "action.php",
                 type: "POST",
                 data:  new FormData(this),
                 contentType: false,
                  cache: false,
                 processData: false,
                 success: function(data)
                  {
                     // console.log(data);
                          spinner.style.display='none';
                          if (data=='1')
                           {
                           SuccessToast('Successfully Uploaded');
                             $('#exampleModal_upload').modal('hide');
                           search_exam_form();
                          }
                          else
                          {
                           ErrorToast('Invalid CSV File ','bg-danger' );
                          }
                  }, 
              });
           }));
         });

         function edit_stu(id)
          {
               var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=204;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               
               spinner.style.display='none';
                document.getElementById("edit_stu").innerHTML=response;
                
              }
           });
          
         }
           function sub_code_int_ext_type_update(id)
           {
        var r = confirm("Do you really want to Change");
          if(r == true) 
           {
         // alert(id);
        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
         var subcode=document.getElementById(id+"_subcode").value;
         var subname=document.getElementById(id+"_subname").value;
         var int=document.getElementById(id+"_Int").value;
         var ext=document.getElementById(id+"_Ext").value;
         var intm=document.getElementById(id+"_intmarks").value;
         var extm=document.getElementById(id+"_extmarks").value;
         var subtype=document.getElementById(id+"_subtype").value;
         var code=210;
         // alert(subcode+' '+subname+' '+int+' '+ext+' '+intm+' '+extm+''+subtype);
         $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,subcode:subcode,subname:subname,Int:int,Ext:ext,Intm:intm,Extm:extm,subtype:subtype
              },
              success: function(response) 
              {
                console.log(response);
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully Updated');
                           search_exam_form();
                           }
                          else
                           {
                           ErrorToast('Try Again','bg-danger' );
                           }
                
              }
           });

  }
}       function receipt_date_no_update(id)
           {
        var r = confirm("Do you really want to Change");
          if(r == true) 
           {
         // alert(id);
        var spinner=document.getElementById("ajax-loader");
          spinner.style.display='block';
         var rdate=document.getElementById("asreceipt_date").value;
       var rno=document.getElementById("asreceipt_no").value;
      
         var code=211;
         // alert(subcode+' '+subname+' '+int+' '+ext+' '+intm+' '+extm+''+subtype);
         $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,receipt_date:rdate,receipt_no:rno
              },
              success: function(response) 
              {
                // console.log(response);
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully Updated');
                           search_exam_form();
                           }
                          else
                           {
                           ErrorToast('Try Again','bg-danger' );
                           }
                
              }
           });

  }
}
</script>