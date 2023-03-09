<?php

include "header.php";
?>
<section class="content">
   <div class="container-fluid">
   <div class="row">
      <!-- left column -->
      <!-- Button trigger modal -->
      <div class="col-lg-4 col-md-4 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Local BackUp</h3>
             <!--   <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal" style="float: right;">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </button> -->
            </div>
            <form action="database_backup/local_db.php" method="post" target="_blank">
            <div class="card-body">
               <div class="form-group row">
                  <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">Select Backup</label>
                  <div class="col-lg-12">
                        <SELECT class="form-control" name="db">
        <option value="All">All</option>
      <?php 
$show="show databases";
$show_run=mysqli_query($conn,$show);
while($show_row=mysqli_fetch_array($show_run))

{
if ($show_row[0]!='information_schema' && $show_row[0]!='performance_schema' && $show_row[0]!='phpmyadmin'  && $show_row[0]!='mysql' && $show_row[0]!='test') {
  // code...

  ?>
  <option value="<?=$show_row[0];?>"><?=$show_row[0];?></option>
  <?php 
}
}


      ?>
    </SELECT>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-info">Download</button>
            </div>
            </form>
           <!--  <p id="error" style="display: none;"></p> -->
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
      
      </div>
   <div class="col-lg-4 col-md-4 col-sm-12">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Table BackUp</h3>
             <!--   <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal" style="float: right;">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </button> -->
            </div>
            <form action="database_backup/single_table.php" method="post" target="_blank">
            <div class="card-body">
               <div class="form-group row">
                           <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">Select Database</label>
                  <div class="col-lg-12">
                        <SELECT class="form-control" id="database" name="database" >
      <?php 

$show="show DATABASES";
$show_run=mysqli_query($conn,$show);
while($show_row=mysqli_fetch_array($show_run))
{
    if ($show_row[0] != 'information_schema' && $show_row[0] != 'performance_schema' && $show_row[0] != 'phpmyadmin' && $show_row[0] != 'mysql' && $show_row[0] != 'test' ) 
    {
  ?>
  <option value="<?=$show_row[0];?>"><?=$show_row[0];?></option>
  <?php 
}
}


      ?>
    </SELECT>
                  </div>
                  <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">Select Table</label>
                  <div class="col-lg-12">
                        <SELECT class="form-control" name="db_table" id='db_table'>
      
    </SELECT>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-info">Download</button>
            </div>
            </form>
           <!--  <p id="error" style="display: none;"></p> -->
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
      
      </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
        	<form action="database_backup/web_db.php" method="post" target="_blank">
         <div class="card card-info">
            <div class="card-header ">
               <h3 class="card-title">Web BackUp</h3>
             <!--   <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#exampleModal" style="float: right;">
               <i class="fa fa-plus" aria-hidden="true"></i>
               </button> -->
            </div>
            <div class="card-body">
               <div class="form-group row">
                  <label for="inputEmail3" required="" class="col-sm-3 col-lg-12 col-md-12  col-form-label">Select Backup</label>
                  <div class="col-lg-12">
              <SELECT class="form-control" name="database">
        <option value="All">All</option>
      <?php 
$show="show databases";
$show_run=mysqli_query($connection_web_in_website,$show);
while($show_row=mysqli_fetch_array($show_run))

{
if ($show_row[0]!='information_schema' && $show_row[0]!='performance_schema' && $show_row[0]!='phpmyadmin'  && $show_row[0]!='mysql' && $show_row[0]!='test') {
  // code...

  ?>
  <option value="<?=$show_row[0];?>"><?=$show_row[0];?></option>
  <?php 
}
}


      ?>
    </SELECT>
                  </div>
               </div>
            </div>
            <div class="card-footer">
               <button type="submit" class="btn btn-info">Download</button>
            </div>
        </form>
           <!--  <p id="error" style="display: none;"></p> -->
            <!-- /.card-footer -->
         </div>
         <!-- /.card -->
      
      </div>
    
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>


<script type="text/javascript">
$(function() { 
$("#database").change(function(e) {
e.preventDefault();
var code='205';
var database = $("#database").val();
// alert(database);
$.ajax({
url:'action.php',
data:{database:database,code:code},
type:'POST',
success:function(data){
if(data != "")
{
   // console.log(data);
$("#db_table").html("");
$("#db_table").html(data);
}
}
});
});
});
</script>


<?php 

include "footer.php";
?>