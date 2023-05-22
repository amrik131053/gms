<?php 
   include "header.php";  
   include "connection/connection.php"; 
      include "connection/connection_web.php";
      date_default_timezone_set("Asia/Kolkata");
      $date=date('Y-m-d'); 
   ?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <!-- Button trigger modal -->
         <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-info">
               <div class="card-header ">
                  <h3 class="card-title">Interview Candidates</h3>
               </div>
              
                  <div class="card-body">
                     <div class="card-body table-responsive">
 <table class="table">
  
         <th>Sr No</th> <th>Reg ID</th><th>Name</th><th>Department/Subject</th><th>ResearchApptitude</th><th>SubjectContent</th><th>Communication</th><th>TeachingSkills</th><th>Action</th>
               <?php 

               $sr=1; 

               $panel="SELECT *,basic_detail.id as myid FROM  panel_members INNER JOIN panel ON panel.id =panel_members.panel_id 
               inner join basic_detail on panel.PanelSubject=basic_detail.department inner join recruitment as rec on rec.r_id=panel.recruitment 

                WHERE panel_members.emp_id='$EmployeeID' AND panel.interviewDate='$date'  ANd rec.r_status='Active' ANd Eligibility='1' ";

                  $panel_run=mysqli_query($conn_recruitment,$panel);
                                    while ($p_row=mysqli_fetch_array($panel_run)) 
                                    {

                                       ?>
                                       <tr>
         <td><?php echo $sr;?> </td>
         <td>  <b><?php echo  $muids=$p_row['myid'];?></b></td> 
                <td>  <b><?php echo $p_row['candidate_name'];?><?php echo $p_row['recruitment'];?></b></td> 
                  <td>  <b><?php echo $p_row['department'];?></b></td>
<?php 
 $panel_e="SELECT * FROM  evaluation where recruitment_id='$muids'";

                  $panel_eva=mysqli_query($conn_recruitment,$panel_e);

                  if(mysqli_num_rows($panel_eva)>0)
                  {
                    while ($pe_row=mysqli_fetch_array($panel_eva)) 
                                    {

                                       ?>
                  

                  <td> <input type="number" class="form-control" style="width: 80px;" value="<?php echo $pe_row['ResearchApptitude'];?>"></td> 
                  <td> <input type="number" class="form-control" style="width: 80px;" value="<?php echo $pe_row['SubjectContent'];?>"></td> 
                  <td> <input type="number" class="form-control" style="width: 80px;" value="<?php echo $pe_row['Communication'];?>"></td> 
                  <td> <input type="number" class="form-control" style="width: 80px;" value="<?php echo $pe_row['TeachingSkills'];?>"></td>
                  <td><button class="btn btn-warning btn-xs"> Update</button> <button class="btn btn-danger btn-xs"> Lock</button></td>


                                <?php 
                             }
                          }
                          else
                          {?>
<td> <input type="number" class="form-control" style="width: 80px;" ></td> 
                  <td> <input type="number" class="form-control" style="width: 80px;" ></td> 
                  <td> <input type="number" class="form-control" style="width: 80px;" ></td> 
                  <td> <input type="number" class="form-control" style="width: 80px;" ></td> 
<td><button class="btn btn-info btn-xs">Update</button> </td> 
                        <?php  }



                                $sr ++;   }
                                    ?>
                                    </tr>
     </table>
                  </div>
              
     
        
  </div>
         <div class="card-footer">
<center>
             <input type="button" class="btn btn-primary" name="create" value="Final Submit" onclick="id_card_data_submit();"  >
           </center>
         </div>
        
         <!-- /.card-footer -->
      
   </div>
   
   <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
   </div>
</section>
<p id="ajax-loader"></p>

<!-- Modal -->
<?php
   include "footer.php"; 
   
    ?>