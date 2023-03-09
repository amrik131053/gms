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
                     <a href="../formats/examform.csv" class="btn btn-warning "> Format</a>
                  </div> <div class="col-lg-3">
                     <input type="text" class="form-control"  id="rollno" placeholder="RollNo">
                  </div>
                  <div class="col-lg-2">
                     <button type="button" class="btn btn-info" onclick="search_exam_form()">Search</button>
                  </div>
                  <div class="col-lg-2">
                <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal_upload" style="float: right;">
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

$list_sql = "SELECT TOP 150   ExamForm.Course,ExamForm.ReceiptDate, ExamForm.Status,ExamForm.ID,ExamForm.Examination,Admissions.UniRollNo,Admissions.StudentName,Admissions.IDNo,ExamForm.SubmitFormDate,ExamForm.Semesterid,ExamForm.Batch,ExamForm.Type
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
                // echo "<td><input type='checkbox' name='amrik[]' class='checkBoxClass' value='".$row['ID']."'></td>";
                echo "<td>".$count++."</td>";
                echo "<td>".$row['ID']."</td>";
                ?><td>
                <a href="" onclick="edit_stu(<?= $row['ID'];?>)" style="color:#002147;text-decoration: none;"  data-toggle="modal"  data-target=".bd-example-modal-xl"><?=$row['UniRollNo'];?></a></td>
                  <?php echo "<td>".$row['StudentName']."</a></td>";
                echo "<td>".$row['Course']."</td>";
                echo "<td>".$row['Semesterid']."</td>";
                echo "<td>".$row['Batch']."</td>";
               
                echo "<td>".$row['Examination']."</td>";
               // echo "<td>".$row['Type']."</td>";
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
              <select onchange="re(<?=$row["ID"];?>)"  id='re1<?=$row["ID"];?>' class="form-control">
                <option value=""><?=$row['Type'];?></option>
                <option value="Reappear" >Reappear</option>
                 <option value="Regular" >Regular</option>
            </select>
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

               }else{ 

               }?>

              </td>
  <td style="text-align: center;"> 
<form action="" method="post">
              <input type="hidden" name="ID" value="<?= $row['ID'];?>">
  <Select name='Status'  class="form-control">
  <option value="-1">Fee pending</option>
  
  <option value="0">Draft</option>
  <option value="4">Forward to Account</option>
    <option value="5">Forward to Examination Branch</option>
    <option value="8">Accepted</option>

</Select>


<input type="submit" class="btn btn-warning btn-xs" name='dverify'>

</form>

          </td>

          <!-- <td style="text-align: center;">  <i class="fa fa-print fa-2x" onclick="result(<?= $row['Id'];?>)" style="color:#002147"></i>
          </td> -->
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
    <div class="modal-content" id="edit_stu">
  
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
                        <option value="Regular">Regular</option>
                        <option value="Reappear">Reappear</option>
                        <option value="Additional">Additional</option>
                     </select>
                  </div>
                  <div class="col-sm-6">
                     <label>Month</label>
                     <select class="form-control" id ="month" required="" name="month" required="">
                        <option value="May">May</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August </option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                        <option value="Golden Chance">Golden Chance</option>
                     </select>
                  </div>
                  <div class="col-sm-6">
                     <label>Year </label>
                     <select class="form-control"  required="" name="year">
                        <option value="2021">2021</option>
                        <?php for($sem=2016;$sem<=2030;$sem++)
                           {
                           ?>
                        <option value="<?=$sem;?>"><?=$sem;?></option>
                        <?php  } ?>
                     </select>
                  </div>
                  <div class="col-lg-6">  
                     <label>Excel Here:</label>
                     <input type="file" name="file_exl" id="file_exl" >
                  </div>
                  <div class="col-lg-6">
                     <label>Status</label>
                     <select class="form-control">
                        <option>Select</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               
                <input type="submit" value="Upload"  class="btn btn-primary btn-xs" id="btnimport">


           
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
    $(document).ready(function(){
    $(document).on('keydown','.result_no_s', function() 
    {
        // Initialize jQuery UI autocomplete
        $("#resultno").autocomplete({
              source: function( request, response ) 
              {
            $.ajax({
        //alert("adad");
            url: "action.php",
              type: 'post',
              dataType: "json",
              data: {
                  search: request.term,code:1
              },
              success: function( data ) {
                  response( data );
              }
            });
          },
          select: function (event, ui) {
            $(this).val(ui.item.label); // display the selected text
            var resultno = ui.item.value; // selected value          
          return false;
          }
        });
    });
  });
  function delexam(id){
 var code=63;
      
     

  var r = confirm("Do you really want to Delete");
  if(r == true) 
  {
//alert(id);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          document.getElementById("resuccess").innerHTML=xmlhttp.responseText;
}
    }
   xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
    xmlhttp.send();
  }
}
  function correct(id){
  var code=621;
  var r = confirm("Do you really want to Change");
  if(r == true) 
  {

   var rdate=document.getElementById("asreceipt_date").value;
       var rno=document.getElementById("asreceipt_no").value;
      
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          document.getElementById("resuccess").innerHTML=xmlhttp.responseText;
}
    }
   xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code+"&rdate="+rdate+"&rno="+rno, true);
    xmlhttp.send();
  }
}

  function ty(id){
 var code=62;
      
     

  var r = confirm("Do you really want to Change");
  if(r == true) 
  {
// alert(id);
 var subcode=document.getElementById(id+"_subcode").value;
  var subname=document.getElementById(id+"_subname").value;
   var int=document.getElementById(id+"_Int").value;
       var ext=document.getElementById(id+"_Ext").value;
        var intm=document.getElementById(id+"_intmarks").value;
         var extm=document.getElementById(id+"_extmarks").value;
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          document.getElementById("resuccess").innerHTML=xmlhttp.responseText;
}
    }
   xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code+"&Ext="+ext+"&Int="+int+"&Intm="+intm+"&Extm="+extm+"&subcode="+subcode+"&subname="+subname, true);
    xmlhttp.send();
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
               // $('#modal-lg-view-question').modal('toggle');
               spinner.style.display='none';
                document.getElementById("edit_stu").innerHTML=response;
                
              }
           });
          
         }
</script>