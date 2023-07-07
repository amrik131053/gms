<?php
include "header.php";
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->

          <div class="col-lg-12 col-md-12 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                     <form action="action_g.php" method="post" enctype="multipart/form-data">
                  <div class="input-group input-group-sm row">
                     <input type="hidden" name="code" value="79">
                 <div class="col-lg-1">
               <a href="formats/degree.csv" >  <input type="button" value="Format" class="btn btn-warning btn-xs"></a>
                    
                 </div>
                     <div class="col-lg-2"> <input type="file"  name="file_exl" class="form-control form-control-sm"  required></div>
                     <div class="col-lg-1"><input type="submit"   class="btn btn-success btn-xs" value="Upload"></div>

                 
                     </form>
                 <div class="card-tools">
                  
                        
                        <form action="print_degree1.php" method="post" target="blank">
                     <div class="input-group input-group-sm">
                       
                        <input type="hidden" name="code" value="2">
                        <input type="text" placeholder="Start" name="start" class="form-control input-group-sm"  required>
                        <input type="text" name="end" placeholder="End" class="form-control" required >
                        <input type="submit"  value="Print"  class="btn btn-primary btn-xs">
                          &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text"  class="form-control " id="unirollno" placeholder="Search" >
                        <input type="button"  class="btn btn-success btn-xs" onclick="search_degree_record();"  value="Search">
                        <!-- &nbsp;&nbsp;&nbsp;&nbsp; -->
                     <!-- <input type="button" value="Receiving " class="btn btn-primary btn-xs" > -->
                     </div>
                     </form>
                  </div> 
                   </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive" >
                  <table class="table table-head-fixed text-nowrap table-bordered " id="">
                     <thead>
                        <tr>
                           <!-- <th>Sr. No.</th> -->

                           <th>Image</th>
                           <th>Name</th>
                           <th>Uni Roll No</th>
                           <th>Father Name</th>
                          
                           <th>Examination</th>
                           <th>Course Name</th>
                           <!-- <th>CGPA</th> -->
                           <th>Action</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="search_record">
                     <?php
                     $count=0;
                     $degree="SELECT * FROM degree_print order by Status ASC";                     
                     $degree_run=mysqli_query($conn,$degree);
                     while ($degree_row=mysqli_fetch_array($degree_run)) 
                     {
                          $get_student_details="SELECT Snap,Batch,Sex FROM Admissions where UniRollNo='".$degree_row['UniRollNo']."'";
                          $get_student_details_run=sqlsrv_query($conntest,$get_student_details);
                          if($row_student=sqlsrv_fetch_array($get_student_details_run))
                          {
                              $snap=$row_student['Snap'];
                              $pic=base64_encode($snap);
                          }
                        $count++;
                        ?>
                        <tr>
                           <!-- <td><?=$count;?></td> -->
                           <td><img src="<?php echo "data:image/jpeg;base64,".$pic;?>" width="50" height="50"></td>
                           <td style="word-wrap: break-word!important;width: 70px;"><?=$degree_row['StudentName'];?></td>
                           <td><?=$degree_row['UniRollNo'];?></td>
                           <td><?=$degree_row['FatherName'];?></td>
                           
                           <td><?=$degree_row['Examination'];?></td>
                           <td><?=$degree_row['Course'];?></td>
                           <!-- <td><?=$degree_row['CGPA'];?></td> -->
                      
                           <td>
                              <form action='print_degree1.php' method='post'>
                                 <input type="hidden" name="code" value="1">
                        <input type='hidden' name='p_id' value="<?=$degree_row['id'];?>">
                        <button type='submit' class='btn border-0 shadow-none' style='background-color:transparent; border:display none' formtarget='_blank' >
                            <i  class='fa fa-print' aria-hidden='true'></i>
                        </button>
                    </form>
                 </td>
                 <td>
                  <?php if ($degree_row['Status']==1) {
                     ?>

                    <b style="color: green;">Printed</b>
                     <?php 
                  }else{
                     ?>
                    <i class="fa fa fa-check" onclick="marks_as_print(<?=$degree_row['id'];?>);"> </i>

                     <?php 
                  } ?>
                 </td>
                        </tr>
                        <?php
                      }
                     ?>
                     </tbody>
                  </table>
               </div>
               <!-- /.card-body -->
            </div>
            <!-- /.card -->
         </div>
         
               <!-- /.card-header -->
              
            </div>
            <!-- /.card -->
         </div>
           
       
      </div>
     
   </div>
  

</section>
<p id="ajax-loader"></p>
<script type="text/javascript">
function search_degree_record()
{
  var unirollno=document.getElementById('unirollno').value;
  var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
   var code=224;
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        uni:unirollno,code:code
      },
      success:function(response)
      {
       spinner.style.display='none';
      document.getElementById("search_record").innerHTML=response;

      }
    });
}

function load_table()
{
  var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
   var code=78;
 $.ajax({
      url:'action_g.php',
      type:'post',
      data:{
        code:code
      },
      success:function(response)
      {
       spinner.style.display='none';
      document.getElementById("search_record").innerHTML=response;

      }
    });
}

function marks_as_print(id)
{
  var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
   var code=77;
 $.ajax({
      url:'action_g.php',
      type:'post',
      data:{
        id:id,code:code
      },
      success:function(response)
      {
       spinner.style.display='none';
// console.log(response);
if (response==1) {
   load_table();
   SuccessToast('Successfully Updated');
}
      // document.getElementById("search_record").innerHTML=response;

      }
    });
}


</script>
<?php 
     

include "footer.php";
?>