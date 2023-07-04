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
                  <!-- <h3 class="card-title">All Records</h3> -->
                 <div class="card-tools">

                        <form action="print_degree1.php" method="post" target="blank">
                     <div class="input-group input-group-sm" style="width: auto;">
                        <input type="hidden" name="code" value="2">
                        <input type="text" placeholder="Start" name="start" class="form-control"  required>
                        <input type="text" name="end" placeholder="End" class="form-control" required >
                        <input type="submit"  value="Print"  class="btn btn-primary btn-xs">
                          &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text"  class="form-control " id="unirollno" placeholder="Search" >
                        <input type="button"  class="btn btn-success btn-xs" onclick="search_degree_record();"  value="Search">
                     </div>
                     </form>
                  </div> 
               </div>
               <!-- /.card-header -->
               <div class="card-body table-responsive" >
                  <table class="table table-head-fixed text-nowrap table-bordered " id="example">
                     <thead>
                        <tr>
                           <th>Sr. No.</th>
                           <th>Name</th>
                           <th>Uni Roll No</th>
                           <th>Father Name</th>
                          
                           <th>Examination</th>
                           <th>Course Name</th>
                           <th>CGPA</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody id="search_record">
                     <?php
                     $count=0;
                     $degree="SELECT * FROM degree_print";                     
                     $degree_run=mysqli_query($conn,$degree);
                     while ($degree_row=mysqli_fetch_array($degree_run)) 
                     {
                        $count++;
                        ?>
                        <tr>
                           <td><?=$count;?></td>
                           <td><?=$degree_row['StudentName'];?></td>
                           <td><?=$degree_row['UniRollNo'];?></td>
                           <td><?=$degree_row['FatherName'];?></td>
                           
                           <td><?=$degree_row['Examination'];?></td>
                           <td><?=$degree_row['Course'];?></td>
                           <td><?=$degree_row['CGPA'];?></td>
                      
                           <td>
                              <form action='print_degree1.php' method='post'>
                                 <input type="hidden" name="code" value="1">
                        <input type='hidden' name='p_id' value="<?=$degree_row['id'];?>">
                        <button type='submit' class='btn border-0 shadow-none' style='background-color:transparent; border:display none' formtarget='_blank' >
                            <i  class='fa fa-print' aria-hidden='true'></i>
                        </button>
                    </form>
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
console.log(response);
      document.getElementById("search_record").innerHTML=response;

      }
    });
}
</script>
<?php 
     

include "footer.php";
?>