<?php 
   include "header.php";  
   include "connection/connection_web.php"; 
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">

                        <h6>NAD Report</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                      
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <label>Course</label>
                                <select name="course" id='Course' class="form-control form-control-sm">
                                    <option value=''>Select course</option>
                                    <?php

                                    $sql="SELECT * from course_master";
                                            $stmt2 = mysqli_query($conn_online_odl,$sql);
                                        while($row1 = mysqli_fetch_array($stmt2) )
                                            {
                                        $college = $row1['Name']; 
                                        $CollegeID = $row1['ID'];
                                        ?>
                                    <option value="<?=$CollegeID;?>"><?= $college;?></option>
                                    <?php    }

                                    ?>
                                </select>

                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Batch</label>
                                <select name="batch" class="form-control form-control-sm" id="Batch">
                                    <option value="">Select</option>
                                  
                                    <?php

                                    $sql="SELECT DISTINCT batch from basic_detail order by batch DESC";
                                            $stmt2 = mysqli_query($conn_online_odl,$sql);
                                        while($row1 = mysqli_fetch_array($stmt2) )
                                            {
                                        $Batch = $row1['batch']; 
                                        ?>
                                    <option value="<?=$Batch;?>"><?= $Batch;?></option>
                                    <?php    }

                                    ?>
                                </select>

                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label> Semester</label>
                                <select id='Semester' class="form-control form-control-sm">
                                    <option value="">Select</option>
                                    <?php 
                                    for($i=1;$i<=12;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
                                                ?>

                                </select>

                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Type</label>
                                <select id="Type" class="form-control form-control-sm">
                                    <option value="">Select</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Reappear">Reappear</option>
                                    <option value="Additional">Additional</option>
                                    <option value="Improvement">Improvement</option>


                                </select>

                            </div>



                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Group</label>
                                <select id="Group" class="form-control form-control-sm">
                                    <option value="">Select</option>
                                    <?php
                                            $sql="SELECT DISTINCT Sgroup from MasterCourseStructure Order by Sgroup ASC ";
                                                    $stmt2 = sqlsrv_query($conntest,$sql);
                                                while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                                    {

                                                
                                                $Sgroup = $row1['Sgroup']; 
                                                
                                                ?>
                                    <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                    <?php    }

                                                            ?>
                                </select>

                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <label>Examination</label>
                                <select id="Examination" class="form-control form-control-sm">
                                    <option value="">Select</option>
                                    <option value="Jan 2024">Jan 2024</option>
                                    <option value="July 2024">July 2024</option>
                                   

                                </select>

                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <label class="" style="font-size:14px;">Action</label><br>
                                  <button class="btn btn-success btn-sm " onclick="searchnad()"><i
                                        class="fa fa-search"></i></button>
                             


                            </div>



                        </div>
                        <div class="table table-responsive" id="show_record">



                        </div>
                    </div>

                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </div>


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->

<script>

    function searchnad()
     {
  
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    var Examination = document.getElementById('Examination').value;

var code=364.1;
if( Course!='')
{
var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
              
               Course:Course,
               Batch:Batch,
               Semester:Semester,
               Type:Type,
               Group:Group,
               Examination:Examination
         },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("show_record").innerHTML=response;

               console.log(response);
               if (response==1) {
                
                  //SuccessToast('Successfully Submit');

               }
               else
               {
                  
               }
            }
         });
      }
      else
      {
         ErrorToast('Select Start and End Date','bg-danger');
      }


}

function exportCutListExcelOnlineCourse(Examination,ddate,resultno,resultid) {
   
    // var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    //var Examination = document.getElementById('Examination').value;
    if ( Course != '' && Batch != '' && Semester != '' && Type != '' && Group != '' && Examination !=
        '') {
        window.open("nad-report-odl.php?Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination+ "&DeclareDate=" + ddate+"&ResultNo=" + resultno+"&resultid=" + resultid, '_blank');
    } else {

        ErrorToast('All input required', 'bg-warning');
    }
}
</script>

<?php

 include "footer.php";  ?>