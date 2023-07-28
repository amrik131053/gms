<?php  include "header.php";  ?>
<style type="text/css">
   h5{
   color: black;
   text-decoration: bold;
   }
</style>
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<?php 
   $dropdown_team="SELECT * FROM Staff WHERE IDNo='$EmployeeID' ";
                    $dropdown_team_run = sqlsrv_query($conntest,$dropdown_team);  
                  
                  if($dropdown_row_staff=sqlsrv_fetch_array($dropdown_team_run,SQLSRV_FETCH_ASSOC))
                  $LeaveRecommendingAuthority=$dropdown_row_staff['LeaveSanctionAuthority'];
                   $LeaveSanctionAuthority=$dropdown_row_staff['LeaveRecommendingAuthority'];
                 
   
   
   $dropdown_team1="SELECT * FROM Staff WHERE IDNo='$LeaveRecommendingAuthority' ";
                    $dropdown_team_run1 = sqlsrv_query($conntest,$dropdown_team1);  
                  
                  if($dropdown_row_staff1=sqlsrv_fetch_array($dropdown_team_run1,SQLSRV_FETCH_ASSOC))
                                  $rname=$dropdown_row_staff1['Name'];
                                $rsnap=$dropdown_row_staff1['Snap'];
                                  $rdesignation=$dropdown_row_staff1['Designation'];
   
   
                                   $dropdown_team2="SELECT * FROM Staff WHERE IDNo='$LeaveSanctionAuthority' ";
                    $dropdown_team_run2 = sqlsrv_query($conntest,$dropdown_team2);  
                  
                  if($dropdown_row_staff2=sqlsrv_fetch_array($dropdown_team_run2,SQLSRV_FETCH_ASSOC))
                                  $aname=$dropdown_row_staff2['Name'];
                                $asnap=$dropdown_row_staff2['Snap'];
                                  $adesignation=$dropdown_row_staff2['Designation'];
   
                   
                   ?>
<section class="content">
   <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default">
         <div class="card-header">
            <div class="row">
               <div class="col-lg-2">
                  <h4 >Staff Appraisal</h4>
               </div>
               
                <div class="col-lg-8"></div>
                 <div class="col-lg-2">
                  <table style="display:none;" id="approved_button">
                      <tr>
                          <td>
                            <a class="btn btn-danger" href="verify_aprisal.php">
                  &nbsp;<?php 
                     $count=0;
                     
                     //SELECT * FROM staff_aprisal where rec_auth='121031' AND ap_auth='121031' 
                       $list_sql = "SELECT * FROM staff_aprisal where  rec_auth_status='0' AND ap_auth!='$EmployeeID' AND rec_auth='$EmployeeID'";
                     
                     $result = mysqli_query($conn,$list_sql);
                     while($row = mysqli_fetch_array($result))  
                          {
                            $count++;
                          }?>
                  <span class="badge bg-purple"><?=$count;?></span>
                 </a>
              
                          </td>
                          <td>
                           
                                <a class="btn btn-success" href="approve_aprisal.php">
                  &nbsp;
                  <?php 
                     $count=0;
                     
                     
                     $list_sql = "SELECT * FROM staff_aprisal where  (rec_auth_status='0'  AND ap_auth='$EmployeeID' AND rec_auth='$EmployeeID') OR (rec_auth_status='1'  AND ap_auth='$EmployeeID' AND ap_auth_status='0' ) ";
                     
                     $result = mysqli_query($conn,$list_sql);
                     while($row = mysqli_fetch_array($result))  
                          {
                            $count++;
                          }?>
                  <span class="badge bg-purple"><?=$count;?></span>
                 </a>
                
                          </td>
                      </tr>
                  </table>
                  
              </div>
            </div>
            
       </div> 
           
            
        
         <div class="card-body">
            <div class="row">
          <div class="col-lg-2"></div>
             <div class="col-lg-8 table-responsive ">
               <table >
               <tr>
                  <td><?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode($Emp_Image).'" height="100" width="100" class="img-thumnail"  style="border-radius:50%"/></  center>';?><br>
                    <center> <?=$Emp_Name;?>(You)</center>
                  </td>
                  <td width="100px"></td>
                  <?php  if($LeaveRecommendingAuthority!=$LeaveSanctionAuthority){?>
                  <td>
                     <?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode( $rsnap).'" height="100" width="100" class="img-thumnail"  style="border-radius:50%"/></center>';?>
                    <center> <?=$rname;?>(Reporting Officer)</center>
                  </td>
                  <?php }?>
                  <td width="100px"></td>
                  <td>
                     <?php echo '<center><img src="data:image/jpeg;base64,'.base64_encode( $asnap).'" height="100" width="100" class="img-thumnail"  style="border-radius:50%"/></center>';?>
                    <center><?=$aname;?>(Officiating Head)</center>
                  </td>
               </tr>
            </table>
        </div>
    </div>
    <div class="col-lg-2"></div>
         </div>
         <!-- /.c
            ard-header -->
         <div class="card-body">
            <div class="col-md-12" style="text-align: center;">
               <label><b style="color:red;text-align: center"> 1<sup>st</sup> August 2022 to 30<sup>th</sup> July 2023 </b></label>
               <br>
               <b style="color:red;text-align: center"> if you want to add more than one records than separated by ,  for instance   (title of paper1 &nbsp;,&nbsp;title of paper2) </b>
            </div>
            <div class="card-body table-responsive p-0" id="show_table" >
               <table class="table table-striped">
                 <tbody>
                  <?php   
                     $yourdata="select * from staff_aprisal where emp_id='$EmployeeID' limit 1 ";
                      $insQryRun=mysqli_query($conn,$yourdata);
                      while ($show_task_row=mysqli_fetch_array($insQryRun))
                                  {?>
                  <tr>
                     <th> Employment Category</th>
                     <td><?=$show_task_row['ecategory'];?></td>
                     <th> No of Lecture</th>
                     <td><?= $show_task_row['no_of_lect'];?></td>
                  </tr>
                  <tr>
                     <td> <b>Books Published :&nbsp;&nbsp;</b><?= $show_task_row['book_published'];?> </td>
                     <td><b>No of Books:&nbsp;&nbsp;</b> <?= $show_task_row['no_of_books'];?></td>
                     <td><b>Name of Books:&nbsp;&nbsp;</b> <?= $show_task_row['name_of_books'];?></td>
                     <td><b>ISBN:&nbsp;&nbsp;</b> <?= $show_task_row['isbn'];?></td>
                  </tr>
                  <tr>
                     <td> <b>Research paper Published :&nbsp;&nbsp;</b><?= $show_task_row['research_paper'];?> (<?= $show_task_row['no_of_research_paper'];?>)</td>
                     <td><b>Title of Paper:&nbsp;&nbsp;</b> <?= $show_task_row['title_of_paper'];?></td>
                     <td><b>Name of Journal:&nbsp;&nbsp;</b> <?= $show_task_row['name_of_journal'];?></td>
                     <td><b>Publication Index:&nbsp;&nbsp;</b> <?= $show_task_row['publication_index'];?></td>
                  </tr>
                  <tr>
                     <td><b> Consultancy :&nbsp;&nbsp;</b><?= $show_task_row['consultancy'];?> </td>
                     <td><b>Amount: &nbsp;&nbsp;</b><?= $show_task_row['amount'];?></td>
                     <td><b>organisation:&nbsp;&nbsp;</b> <?= $show_task_row['corg'];?></td>
                  </tr>
                  <tr>
                     <td><b> Admission Initative:&nbsp;&nbsp;</b><?= $show_task_row['admission'];?> </td>
                     <td><b>No of Admission:&nbsp;&nbsp;</b> <?= $show_task_row['no_of_admission'];?></td>
                     <td colspan="2"><b>No of Admission without Consultancy&nbsp;&nbsp;</b> <?= $show_task_row['no_of_admission_c'];?></td>
                  </tr>
                  <tr>
                     <td> <b>Patent:&nbsp;&nbsp;</b><?= $show_task_row['patent'];?> </td>
                     <td><b>Detail: &nbsp;&nbsp;</b><?= $show_task_row['p_detail'];?></td>
                  </tr>
                  <tr>
                     <td colspan="2"><b> PhD. Candidate:&nbsp;&nbsp;</b><?= $show_task_row['phd_candidate'];?> </td>
                     <td colspan="2" ><b>No Of Candidate: &nbsp;&nbsp;</b><?= $show_task_row['no_of_candidate'];?></td>
                  </tr>
                  <tr>
                     <td colspan="5"><b> Other Duty /Task:&nbsp;&nbsp;</b><?= $show_task_row['extra'];?> </td>
                  </tr>
                  <?php    } ?>
                  </tbody>
               </table>
            </div>
            <hr>
            <br>
            <div style="display: none;" id="form_show">
            <div class="row">
               <div class="col-md-2">
                  <label>Employment Category <b style="color:red;">*</b></label>
               </div>
               <div class="col-md-2">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimary15"  onclick="emc1_show();" value="Teaching" name="empc1">
                     <label for="radioPrimary15">
                     Teaching
                     </label>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimary16" onclick="emc1_hide();"  value="Non-Teaching" name="empc1" checked="">
                     <label for="radioPrimary16">
                     Non Teaching
                     </label>
                  </div>
               </div>
               <div class="col-md-6" style="display: none;" id="lect_div">
                  <div class="row ">
                     <div class="col-md-4">
                        <label>Weekly Teaching Load <b style="color:red;">*</b></label>
                     </div>
                     <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <input type="number" id='nooflecture' name="" class="form-control">
                        </div>
                        <!-- /.form-group -->
                     </div>
                  </div>
               </div>
            </div>
            <script>
               function emc1_show() {
               var x = document.getElementById("lect_div");
               
               x.style.display = "block";
               
               
               }
                      function emc1_hide() {
               var x = document.getElementById("lect_div");
               
               x.style.display = "none";
               }
               
               
            </script>
            <hr>
            <div class="row">
               <div class="col-md-2">
                  <label>Book Published <b style="color:red;">*</b></label>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb15"  onclick="book_show();" value="Yes" name="book">
                     <label for="radioPrimaryb15">
                     Yes
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb16" onclick="book_hide();" value="No" name="book" checked="">
                     <label for="radioPrimaryb16">
                     No
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryb17" onclick="book_hide();" book="NA" name="book">
                     <label for="radioPrimaryb17">
                     NA
                     </label>
                  </div>
               </div>
               <div class="col-lg-7" style="display: none;" id="book_div" >
                  <div class="row ">
                     <div class="col-md-2">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <label>No of Books</label>
                           <input type="number" name="" id="noofbooks" class="form-control">
                        </div>
                        <!-- /.form-group -->
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Name of Books </label>
                           <input type="text" name=""  id="nameofbooks" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <label>ISBN</label>
                           <input type="text" name=""  id ="isbn" class="form-control">
                        </div>
                        <!-- /.form-group -->
                     </div>
                  </div>
               </div>
            </div>
            <script>
               function book_show() 
               {
               
               
                 var x = document.getElementById("book_div"); 
               
               
               x.style.display = "block";
               
               }  
               
               function book_hide(book) 
               {
               //var book1 = document.getElementById("bookp").value();
                 var x = document.getElementById("book_div"); 
               
               
               x.style.display = "none";
               }
               
               
               
            </script>
            <hr>
            <div class="row">
               <div class="col-md-3">
                  <label>Research Paper Published <b style="color:red;">*</b></label>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryr15"  onclick="research_show();" value="Yes" name="research">
                     <label for="radioPrimaryr15">
                     Yes
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryr16" onclick="research_hide();"  value="No" name="research" checked="">
                     <label for="radioPrimaryr16"> 
                     No
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryr17"  value="NA" onclick="research_hide();" name="research">
                     <label for="radioPrimaryr17">
                     NA
                     </label>
                  </div>
               </div>
           </div>
           <div class="row">
               <div class="col-lg-12" style="display: none;" id="research_div" >
                  <div class="row ">
                     <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <label>Number of Paper</label>
                           <input type="number" name="" id="noofpaper" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <label>Title of Paper</label>
                           <textarea  name=""  id="titleofpaper" class="form-control"></textarea>
                        </div>
                        <!-- /.form-group -->
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label>Name of Journal</label>
                           <textarea  name="" id="nameofjour" class="form-control"></textarea>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label>Publication Index</label>
                           <textarea  name="" id="publicationindex" class="form-control"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <script>
               function research_show() 
               {
               
                 var x = document.getElementById("research_div"); 
               
               x.style.display = "block";
               
               }
               
               function research_hide() 
               
               {
                 var x = document.getElementById("research_div"); 
               
               x.style.display = "none";
               
               }
               
               
            </script>
            <hr>
            <div class="row">
               <div class="col-md-2">
                  <label>Consultancy<b style="color:red;">*</b></label>
               </div>
               <div class="col-md-2">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryc"  value="Yes" onclick="con_show();" name="con">
                     <label for="radioPrimaryc">
                     Yes
                     </label>
                  </div>
               </div>
               <div class="col-md-2">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryc1" value="No" onclick="con_hide();" name="con" checked="">
                     <label for="radioPrimaryc1">
                     No
                     </label>
                  </div>
               </div>
               <div class="col-md-6" style="display: none;" id="con_div">
                  <div class="row ">
                     <div class="col-md-2">
                        <label>Amount <b style="color:red;">*</b></label>
                     </div>
                     <div class="col-md-3">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <input type="number" name="" id="amount" class="form-control">
                        </div>
                        <!-- /.form-group -->
                     </div>
                     <div class="col-md-3">
                        <label>Organisation <b style="color:red;">*</b></label>
                     </div>
                     <div class="col-md-4">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <input type="text" name="" id="corg" class="form-control">
                        </div>
                        <!-- /.form-group -->
                     </div>
                  </div>
               </div>
            </div>
            <script>
               function con_show() {
               var x = document.getElementById("con_div");
               
               x.style.display = "block";
               
               }
                      function con_hide() {
               var x = document.getElementById("con_div");
               
               x.style.display = "none";
               }
               
               
            </script>
            <hr>
            <div class="row">
               <div class="col-md-2">
                  <label>Admission Initiative<b style="color:red;">*</b></label>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryadm"  value="Yes" onclick="adm_show();" name="adm">
                     <label for="radioPrimaryadm">
                     Yes
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryadm1" value="No" onclick="adm_hide();" name="adm" checked="">
                     <label for="radioPrimaryadm1">
                     No
                     </label>
                  </div>
               </div>
               <div class="col-md-8" style="display: none;" id="adm_div">
                  <div class="row ">
                     <div class="col-md-4">
                        <label>No of Admission<b style="color:red;">*</b></label>
                        <input type="number" name="" id="noadm" class="form-control">
                     </div>
                     <div class="col-md-5">
                        <label>No of Admission without consultancy<b style="color:red;">*</b></label>
                        <input type="number" name="" id="nocadm" class="form-control" >
                     </div>
                  </div>
               </div>
            </div>
            <script>
               function adm_show() {
               var x = document.getElementById("adm_div");
               
               x.style.display = "block";
               
               }
                      function adm_hide() {
               var x = document.getElementById("adm_div");
               
               x.style.display = "none";
               }
               
               
            </script>
            <hr>
            <div class="row">
               <div class="col-md-2">
                  <label>Patent<b style="color:red;">*</b></label>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimarypt"  value="Yes" onclick="patent_show();" name="pt">
                     <label for="radioPrimarypt">
                     Yes
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimarypt1" value="No" onclick="patent_hide();" name="pt" checked="">
                     <label for="radioPrimarypt1">
                     No
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimarypt3" value="NA" onclick="patent_hide();" name="pt">
                     <label for="radioPrimarypt3">
                     NA
                     </label>
                  </div>
               </div>
               <div class="col-md-6" style="display: none;" id="patent_div">
                  <div class="row ">
                     <div class="col-md-2">
                        <label>Detail<b style="color:red;">*</b></label>
                     </div>
                     <div class="col-md-8">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <textarea  name=""   id="ptdetail" class="form-control"></textarea>
                        </div>
                        <!-- /.form-group -->
                     </div>
                  </div>
               </div>
            </div>
            <script>
               function patent_show() {
               var x = document.getElementById("patent_div");
               
               x.style.display = "block";
               
               }
                      function patent_hide() {
               var x = document.getElementById("patent_div");
               
               x.style.display = "none";
               }
               
               
            </script>
            <hr>
            <div class="row">
               <div class="col-md-2">
                  <label>Ph.D Candidate Supervised<b style="color:red;">*</b></label>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryphd"  value="Yes" onclick="phd_show();" name="phd">
                     <label for="radioPrimaryphd">
                     Yes
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryphd1"  value="No" onclick="phd_hide();" name="phd" checked="">
                     <label for="radioPrimaryphd1">
                     No
                     </label>
                  </div>
               </div>
               <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                     <input type="radio" id="radioPrimaryphd3" value="NA" onclick="phd_hide();" name="phd">
                     <label for="radioPrimaryphd3">
                     NA
                     </label>
                  </div>
               </div>
               <div class="col-md-6" style="display: none;" id="phd_div">
                  <div class="row ">
                     <div class="col-md-4">
                        <label>No of  candidate<b style="color:red;">*</b></label>
                     </div>
                     <div class="col-md-8">
                        <!-- /.form-group -->
                        <div class="form-group">
                           <input type="number" name="" id="phd_detail" class="form-control">
                        </div>
                        <!-- /.form-group -->
                     </div>
                  </div>
               </div>
            </div>
            <script>
               function phd_show() {
               var x = document.getElementById("phd_div");
               
               x.style.display = "block";
               
               }
                      function phd_hide() {
               var x = document.getElementById("phd_div");
               
               x.style.display = "none";
               }
               
               
            </script>
            <hr>
            <div class="row">
               <div class="col-xl-12">
                  <label>Other Duties /task performed by you<b style="color:red;">*</b></label>
                  <textarea class="form-control" id="otherduty"></textarea>
               </div>
            </div>
            <hr>
            <div class="row">
               <div class="col-xl-12" style="text-align: center;">
                  <button class="btn btn-success" onclick="save_report()">Submit</button>
               </div>
            </div>
        </div>
    </div>
    </div>
</div>
</section>
            <script>
               function save_report()
                       {
                    var code=1;
               
                   var validation=0; 
               var emp = document.querySelector('input[type=radio][name=empc1]:checked');
               var  emp_ctegory=emp.value;
               var nooflecture=document.getElementById('nooflecture').value;
                
                 var book = document.querySelector('input[type=radio][name=book]:checked');
               var bookpub=book.value;
               var noofbooks=document.getElementById('noofbooks').value;
               var nameofbooks=document.getElementById('nameofbooks').value;
               var isbn=document.getElementById('isbn').value;
               
                var research = document.querySelector('input[type=radio][name=research]:checked');
               
               var researchpub=research.value;
               
               
               var noofpaper=document.getElementById('noofpaper').value;
               var titleofpaper=document.getElementById('titleofpaper').value;
                 var nameofjour=document.getElementById('nameofjour').value;
                   var publicationindex=document.getElementById('publicationindex').value;
               
               var con = document.querySelector('input[type=radio][name=con]:checked');
               var consultancy=con.value;
               var amount=document.getElementById('amount').value;
                var corg=document.getElementById('corg').value;
               
               var adm = document.querySelector('input[type=radio][name=adm]:checked');
               var admission=adm.value;
               var noadm=document.getElementById('noadm').value;
               var nocadm=document.getElementById('nocadm').value;   
               
               
               
               var pt = document.querySelector('input[type=radio][name=pt]:checked');
               var patent=pt.value;
               var ptdetail=document.getElementById('ptdetail').value;
               
               var phd = document.querySelector('input[type=radio][name=phd]:checked');
               var phdsuperviser=phd.value;
               var phd_detail=document.getElementById('phd_detail').value;
               
               var otherduty=document.getElementById('otherduty').value;
               
               
               if(emp_ctegory=='Teaching' && nooflecture!='')
               {
               
               }
               else if(emp_ctegory!='Teaching')
               {
               
               }
               else
               {
               validation=1
               ErrorToast('Update weekly Teaching Load ','bg-danger' );
               }
               
               if(bookpub=='Yes' &&noofbooks!=''&& nameofbooks!==''&&isbn!='')
               {
               
               }
               else if(bookpub!='Yes')
               {
               
               }
               else
               {
               validation=1;
               ErrorToast('Update Book Detail','bg-danger' );
               
               
               }
               if(researchpub=='Yes' &&noofpaper!=''&& titleofpaper!==''&&nameofjour!=''&&publicationindex!='')
               {
               
               }
               else if(researchpub!='Yes')
               {
               
               }
               else
               {
               validation=1;
                ErrorToast('Update Research Paper Detail','bg-danger' );
               
               }
               if(admission=='Yes' && noadm!='' && nocadm!='')
               {
               
               }
               else if(admission!='Yes')
               {}
               else
               {
               validation=1;
                ErrorToast('Update Admission Detail','bg-danger' );
               
               }
               
               
               
               if(consultancy=='Yes' && amount!='' && corg!='')
               {
               
               }
               else if(consultancy!='Yes')
               {}
               else
               {
               validation=1;
               ErrorToast('Update Consultancy Detail','bg-danger' );
               
               }
               
               if(patent=='Yes' && ptdetail!='')
               {
               
               }
               else if(patent!='Yes')
               {}
               else
               {
               validation=1;
               ErrorToast('Update Patent Detail','bg-danger' );
               
               }
               
               if(phdsuperviser=='Yes' && phd_detail!='')
               {
               
               }
               else if(phdsuperviser!='Yes')
               {}
               else
               {
               validation=1;
               ErrorToast('Update Ph.d Detail','bg-danger' );
               
               }
               
               
               
               var otherduty=document.getElementById('otherduty').value;
               
               if(validation>0)
               {
               ErrorToast('please check details carefully','bg-danger')
               }
               else
               {
               var spinner=document.getElementById('ajax-loader');
                      spinner.style.display='block';
                      $.ajax({
                         url:'slefapprisalaction.php',
                         type:'POST',
                         data:{
                            emp_ctegory:emp_ctegory,nooflecture:nooflecture,bookpub:bookpub,noofbooks:noofbooks,nameofbooks:nameofbooks,isbn:isbn,researchpub:researchpub,noofpaper:noofpaper,titleofpaper:titleofpaper,nameofjour:nameofjour,publicationindex:publicationindex,consultancy:consultancy,amount:amount,admission:admission,noadm:noadm,nocadm:noadm,patent:patent,ptdetail:ptdetail,phdsuperviser:phdsuperviser,phd_detail:phd_detail,otherduty:otherduty,corg:corg,code:code
                               },
                         success: function(response) 
                         {
               
                            spinner.style.display='none';
                               if (response=='1')
                                        {
                                        SuccessToast('Successfully Uploaded');
                                        // location.reload(true);
                                        show_table_after_submit();

                           
                            }
                           else
                                       {
                                        ErrorToast('Unable to Upload','bg-danger' );
                                       }
               
                         }
                      });
               
                  }
               
               }


                 function show_table_after_submit()
          {
   //    var spinner=document.getElementById("ajax-loader");
   // spinner.style.display='block';
           var code=127;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                  // spinner.style.display='none';
                form_div();
                 document.getElementById("show_table").innerHTML=response;
              }
           });
          }

          function form_div() 

          {
    var div = document.getElementById("form_show");
                  var code=128;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                // console.log(response);
                if (response==1) {
                        div.style.display = "none";
                }
                else
                {
                        div.style.display = "block";

                }
              }
           });
}   

      function approved_div() 

          {
    var div = document.getElementById("approved_button");
                  var code=129;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
                // console.log(response);
                if (response==1) {
                        div.style.display = "block";
                }
                else
                {
                        div.style.display = "none";

                }
              }
           });
}
approved_div();
form_div();
            </script>
         </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
      </div>
   </div>
   <!-- /.card -->
   <!-- SELECT2 EXAMPLE -->
   <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<?php  include "footer.php";  ?>