<?php 
   include "header.php";   
   ?>
<section class="content">
    <section class="content">

        <div class="container-fluid">
            <div class="card-header">
                <div class="row">
                <div class="col-lg-6">
                <select id="Batch" class="form-control form-control-range" onchange="loadDashboard();">
                    <option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
                    <?php 
                              for($i=2011;$i<=2030;$i++)
                                 {?>
                    <option value="<?=$i?>"><?=$i?></option>
                    <?php }
                                  ?>
                </select>

                                 </div>
                                 <div class="col-lg-6">
                                 <select id="Lateral" class="form-control form-control-range" onchange="loadDashboard();">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                    <?php 
                             
                                  ?>
                </select>


                                 </div>
                                 </div>
            </div>
            <br>


            <!-- <h3 class="mt-4 mb-4">Social Widgets</h3> -->
            <!-- ----------------------------------------------------------------------------------- -->
            <div class="row">


                <?php      $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID WHERE MasterCourseCodes.CollegeID!='76' AND MasterCourseCodes.CollegeID!='77' AND MasterCourseCodes.CollegeID!='70' AND IDNo='$EmployeeID' order By CollegeID Asc";
                     $stmt2 = sqlsrv_query($conntest,$sql);
                     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC))
                      {   
                        $college = $row1['CollegeName']; 
                        $CollegeID = $row1['CollegeID'];
?>
   <input type='hidden' name='check[]' id='check' value='<?=$CollegeID;?>' class='checkbox' checked >

                        

                <div class="col-md-3">
                    <div class="card card-widget widget-user-2 shadow-lg">
                        <div class="card-header info-box  shadow-lg">

                            <div class="info-box-content ">
                                <?=$college;?>(<?=$CollegeID;?>)


                            </div>
                            <a href="#" class="small-box-footer"><button type="submit"
                                    class="btn btn-sm " style='color:white;' onclick="exportTotalScordingToCollegeSumy(<?=$CollegeID;?>,'','');">
                                    <i class="fa fa-download fa-lg"></i></button>
                            </a>
                            <!-- /.info-box-content -->

                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'','');">
                                    <i class="fa fa-download fa-sm text-info"></i>&nbsp;&nbsp;Total Student <span class="float-right badge bg-info"
                                            id="TSutdent<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"  onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'1','');">
                                    <i class="fa fa-download fa-sm text-primary"></i> &nbsp;&nbsp;Active <span class="float-right badge bg-primary" id="TActive<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link"  onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'2','');">
                                    <i class="fa fa-download fa-sm text-primary"></i> &nbsp;&nbsp; Provisional Active<span class="float-right badge bg-success"
                                            id="PActive<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="#" class="nav-link"  onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'0','');">
                                    <i class="fa fa-download fa-sm text-danger"></i> &nbsp;&nbsp; Left<span class="float-right badge bg-success"
                                            id="TLeft<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a href="#" class="nav-link"  onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'3','');">
                                    <i class="fa fa-download fa-sm text-danger"></i> &nbsp;&nbsp; Provisional Left<span class="float-right badge bg-success"
                                            id="PLeft<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link"  onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'1','1');">
                                    <i class="fa fa-download fa-sm text-success"></i> &nbsp;&nbsp; Eligible<span class="float-right badge bg-success"
                                            id="TEligible<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"  onclick="exportTotalScordingToCollege(<?=$CollegeID;?>,'1','0');">
                                    <i class="fa fa-download fa-sm text-warning"></i>&nbsp;&nbsp;Not Eligible  <span class="float-right badge bg-warning"
                                            id="TNEligible<?=$CollegeID;?>">
                                            <div class="text-center" id="div-loader<?=$CollegeID;?>">
                                                <div class="spinner-border spinner-grow-sm" role="status">
                                                </div>
                                            </div>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ----------------------------------------------------------------------------------- -->
                <?php }?>
            </div>
    </section>
    <p id="ajax-loader"></p>
    <script>
    const d = new Date();
    let year = d.getFullYear();
    loadDashboard();

    function exportTotalScordingToStatus(Status,Eligible) {
    var exportCode = 44;
    var Batch = document.getElementById('Batch').value;
    var Lateral = document.getElementById('Lateral').value;

        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch+ "&Eligible=" + Eligible+ "&Lateral=" + Lateral, '_blank');

}



function exportTotalScordingToCollege(CollegeID,Status,Eligible) {
    var exportCode = 45;
    var Batch = document.getElementById('Batch').value;
    var Lateral = document.getElementById('Lateral').value;
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch+ "&Eligible=" + Eligible+ "&Lateral=" + Lateral+ "&CollegeID=" + CollegeID, '_blank');
}
function exportTotalScordingToCollegeSumy(CollegeID,Status,Eligible) {
    var exportCode = 46;
    var Batch = document.getElementById('Batch').value;
    var Lateral = document.getElementById('Lateral').value;
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch+ "&Eligible=" + Eligible+ "&Lateral=" + Lateral+ "&CollegeID=" + CollegeID, '_blank');

}




function exportTotalScordingToStatusSummary(Status,Eligible) {
    var exportCode = 47;
    var Batch = document.getElementById('Batch').value;
    var Lateral = document.getElementById('Lateral').value;
        window.open("export.php?exportCode=" + exportCode + "&Status=" + Status + "&Batch=" + Batch+ "&Eligible=" + Eligible+ "&Lateral=" + Lateral, '_blank');
}


 







    function loadDashboard() {
      $('#div-loader').show();
        var Batch = document.getElementById("Batch").value;
        var Lateral = document.getElementById("Lateral").value;
        var subjects=document.getElementsByClassName('checkbox');
        var len_subject= subjects.length;
  

 var subject_str=[];
    
    for(i=0;i<len_subject;i++)
     {
      if(subjects[i].checked===true)
       {
        subject_str.push(subjects[i].value);
        }
     }
            
                for(i=0;i<len_subject;i++)
        {
         var a=subject_str[i];

loadCollegeCount(a,Batch,Lateral);
  }
    
    }

  


    function loadCollegeCount(CollegeID, Batch,Lateral) {

        var code = 299;
        $.ajax({
            url: 'action_g.php',
            type: 'post',
            data: {
                code: code,
                Batch: Batch,
                CollegeID: CollegeID,
                Lateral: Lateral
            },
            success: function(response) {
                // console.log(response);
                var data = JSON.parse(response);
                document.getElementById("TSutdent" + CollegeID).textContent = data[0];
                document.getElementById("TActive" + CollegeID).textContent = data[1];
                document.getElementById("TNEligible" + CollegeID).textContent = data[2];
                document.getElementById("TEligible" + CollegeID).textContent = data[3];

                   document.getElementById("PActive" + CollegeID).textContent = data[4];
                document.getElementById("TLeft" + CollegeID).textContent = data[5];
                document.getElementById("PLeft" + CollegeID).textContent = data[6];
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }


  
    </script>

    <?php

 include "footer.php";  ?>