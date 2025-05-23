<?php 
   include "header.php";   
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
                                <label>College</label>
                                <?php      $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID WHERE MasterCourseCodes.CollegeID!='76' AND MasterCourseCodes.CollegeID!='77' AND MasterCourseCodes.CollegeID!='70' AND IDNo='$EmployeeID' order By CollegeID Asc";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
?>
                                <input type='hidden' name='check[]' id='check' value='<?=$CollegeID;?>' class='checkbox'
                                    checked>
                                <?php }?>
                                <select name="College" id='College' onchange="courseByCollege(this.value)"
                                    class="form-control form-control-sm">
                                    <option value=''>Select College</option>
                                    <?php

                                    $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID  where UserAccessLevel.IDNo='$EmployeeID'";
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
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <label>Course</label>
                                <select name="Course" id="Course" class="form-control form-control-sm">
                                    <option value=''>Select Course</option>

                                </select>
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Batch</label>
                                <select name="batch" class="form-control form-control-sm" id="Batch">
                                    <option value="">Select</option>
                                    <?php 
                                    for($i=2013;$i<=2030;$i++)
                                    {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php }
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
                                    <?php
                                     $sql="SELECT DISTINCt  Examination FROM ResultGKU order by Examination ASC ";
                                    //  $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
                                            $stmt2 = sqlsrv_query($conntest,$sql);
                                        while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                            {

                                        
                                        $Sgroup = $row1['Examination']; 
                                        
                                        ?>
                                    <option value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
                                    <?php    }

                                    ?>


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
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    // var Group = document.getElementById('Group').value;
    //var Examination = document.getElementById('Examination').value;

var code=364;
if(College!='' && Course!='')
{
var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,
               College:College,
               Course:Course,
               Batch:Batch,
               Semester:Semester,
               Type:Type,
            //    Group:Group
         },
            success: function(response) 
            { 
               spinner.style.display='none';
               document.getElementById("show_record").innerHTML=response;

               //console.log(response);
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

function exportCutListExcel(Examination,ddate,resultno) {
   
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var Group = document.getElementById('Group').value;
    //var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != '' && Type != '' && Group != '' && Examination !=
        '') {
        window.open("nad-report.php?CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Group=" + Group + "&Examination=" + Examination+ "&DeclareDate=" + ddate+"&ResultNo=" + resultno, '_blank');
    } else {

        ErrorToast('All input required', 'bg-warning');
    }
}
</script>

<?php

 include "footer.php";  ?>