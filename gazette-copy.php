<?php include "header.php";
 ?> <section class="content">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gazette Copy </h3>
                    <div class="card-tools">

                    </div>
                </div>
                <div class="card-body p-2">
                <div class="row">
                    <!-- left column -->
                    <div class="col-lg-2 col-md-4 col-sm-3">


                        <label>College</label>
                        <select name="College" id='College' onchange="courseByCollege(this.value)" class="form-control"
                            required="">
                            <option value=''>Select Course</option>
                            <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $college = $row1['CollegeName']; 
     $CollegeID = $row1['CollegeID'];
    ?>
                            <option value="<?=$CollegeID;?>"><?= $college;?></option>
                            <?php    }

?>
                        </select>



                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-3">


                        <label>Course</label>
                        <select name="Course" id="Course" class="form-control">
                            <option value=''>Select Course</option>

                        </select>
                    </div>


                    <div class="col-lg-1 col-md-4 col-sm-3">





                        <label>Batch</label>
                        <select name="batch" class="form-control" id="Batch" required="">
                            <option value="">Batch</option>
                            <?php 
for($i=2013;$i<=2030;$i++)
{?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php }
            ?>

                        </select>

                    </div>

                    <div class="col-lg-1 col-md-4 col-sm-3">
                        <label> Semester</label>
                        <select id='Semester' class="form-control" required="">
                            <option value="">Sem</option>
                            <?php 
for($i=1;$i<=12;$i++)
{?>
                            <option value="<?=$i?>"><?=$i?></option>
                            <?php }
            ?>

                        </select>

                    </div>
                    <div class="col-lg-1 col-md-4 col-sm-3">
                        <label> Action</label><br>
                        <button class="btn btn-primary" onclick="search_record();">Search</button>

                    </div>
                    
                </div>
                <br>
                <div class="table-responsive" id="show_record">
</div>
                </div>
            </div>
        </div>
     </div>
       
</section>
<p id="ajax-loader"></p>

<script>
function search_record() {
    var spinner = document.getElementById("ajax-loader");
        spinner.style.display = 'block';
    var college = document.getElementById('College').value;
    var course = document.getElementById('Course').value;
    var batch = document.getElementById('Batch').value;
    var sem = document.getElementById('Semester').value;
    if(college!='')
    {
    var code = '272';
    $.ajax({
        url: 'action_g.php',
        data: {
            code: code,
            college: college,
            course: course,
            batch: batch,
            sem: sem
        },
        type: 'POST',
        success: function(data) {
            spinner.style.display = 'none';
            document.getElementById("show_record").innerHTML = data;

        }
    });
}
else{
    ErrorToast('Please Select College','bg-warning');
}
}
</script>

<?php include "footer.php";
 ?>