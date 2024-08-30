<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row ">
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


            <div class="col-lg-2 col-md-4 col-sm-3">





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
            <div class="col-md-1">
            <div class="form-group">
              <label>Type</label>
                    <select  id="Type" name="Type" class="form-control" required="">
                 <option value="">Type</option>
                       <?php
   $sql="SELECT DISTINCT Type from ExamForm Order by Type ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $Type = $row1['Type']; 
     
    ?>
<option  value="<?=$Type;?>"><?= $Type;?></option>
<?php    }

?>

                
              </select>
            </div>
 </div>
            <div class="col-md-1">
            <div class="form-group">
              <label>Group</label>
                    <select  id="group" name="group" class="form-control" required="">
                 <option value="">Group</option>
                       <?php
   $sql="SELECT DISTINCT Sgroup from ExamForm Order by Sgroup ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $Sgroup = $row1['Sgroup']; 
     
    ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }

?>

                
              </select>
            </div>
 </div>

            <div class="col-lg-1 col-md-4 col-sm-3">
                <label>Examination</label>
                <select id="Examination" class="form-control" required="">
                    <option value="">Examination</option>
                    <?php
   $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
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


            <div class="col-lg-1 col-md-4 col-sm-3">
                <label>Search</label><br>
                <button class="btn btn-danger" onclick="select_mst()"><i class="fa fa-search"></i></button>
                <button class="btn btn-success btn-sm " onclick="exportCutListExcelgraden()">NG </button> 
                <!-- <button class="btn btn-success btn-sm " onclick="exportCutListExcelcsv()">CSV</button> -->
            </div>



            <!-- /.row -->
        </div>
        </br>



        <div class="row">
            <!-- left column -->
            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Students</h3>
                    </div>

                    <!--  <form class="form-horizontal" action="" method="POST"> -->
                    <div class="card-body">
                        <div id="live_data">


                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                    <!-- /.card-footer -->
                    <!-- </form> -->
                </div>
            </div>







        </div>
        <!-- /.container-fluid -->
        </section>
        <p id="ajax-loader"></p>

        <!-- Modal -->

        <script>



function deleteResultOne(id,IDNo)
{
    var r = confirm("Do you really want to delete");
          if(r == true) 
           {
            var code=463;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id,IDNo:IDNo
              },
              success: function(response) 
              {
               console.log(response);
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully deleted');
                          }
                          else
                          {
                           ErrorToast('Input Wrong ','bg-danger' );
                          }
                
              }
           });

           }
           else{

           }
}










        function deleteAll() {
            var verifiy = document.getElementsByClassName('v_check');
            var len_student = verifiy.length;
            var code = 456;
            var subjectIDs = [];
            for (i = 0; i < len_student; i++) {
                if (verifiy[i].checked === true) {
                    subjectIDs.push(verifiy[i].value);
                }
            }
            if ((typeof subjectIDs[0] == 'undefined')) {
                // alert('');
                ErrorToast(' Select atleast one Student', 'bg-warning');
            } else {
                var spinner = document.getElementById("ajax-loader");
                spinner.style.display = 'block';
                $.ajax({
                    url: 'action_g.php',
                    data: {
                        subjectIDs: subjectIDs,
                        code: code
                    },
                    type: 'POST',
                    success: function(data) {
                        spinner.style.display = 'none';
                        console.log(data);
                        if (data == 1) {
                            SuccessToast('Successfully deleted');
                            //    search_study_scheme();
                            location.reload(true);
                        } else {
                            ErrorToast(' try Again', 'bg-danger');

                        }
                    }
                });
            }
        }



        function verifiy_select() {
            if (document.getElementById("select_all1").checked) {
                $('.v_check').each(function() {
                    this.checked = true;
                });
            } else {
                $('.v_check').each(function() {
                    this.checked = false;
                });
            }

            $('.v_check').on('click', function() {
                var a = document.getElementsByClassName("v_check:checked").length;
                var b = document.getElementsByClassName("v_check").length;

                if (a == b) {

                    $('#select_all1').prop('checked', true);
                } else {
                    $('#select_all1').prop('checked', false);
                }
            });

        }

        function fetchCutList() {
            var sub_data = 2;
            var College = document.getElementById('College').value;
            var Course = document.getElementById('Course').value;
            var Semester = document.getElementById('Semester').value;
            var Type = document.getElementById('Type').value;
            var Examination = document.getElementById('Examination').value;
            var Status = document.getElementById('Status').value;
            if (Examination != '') {
                var spinner = document.getElementById("ajax-loader");
                spinner.style.display = 'block';
                var code = '290';
                $.ajax({
                    url: 'action_g.php',
                    data: {
                        code: code,
                        College: College,
                        Course: Course,
                        Semester: Semester,
                        Type: Type,
                        Status: Status,
                        Examination: Examination,
                        sub_data: sub_data
                    },
                    type: 'POST',
                    success: function(data) {
                        spinner.style.display = 'none';
                        document.getElementById("show_record").innerHTML = data;
                        pendingCount();
                        rejectCount();
                        verifiedCount();


                    }
                });
            } else {
                ErrorToast('Please Select Examination', 'bg-warning');
            }

        }


        function select_mst() 
{ 
 
  var  college = document.getElementById('College').value;
  var  course = document.getElementById('Course').value;
  var  batch = document.getElementById('Batch').value;
  var  sem = document.getElementById('Semester').value; 
  var  examination = document.getElementById('Examination').value;
  //  var  type = document.getElementById('Type').value;
  if(college!=''&& batch!='' && sem!='' && examination!='')
  {
   var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
       if (xmlhttp.readyState==4 && xmlhttp.status==200)
       {     
           spinner.style.display='none';
           
           document.getElementById("live_data").innerHTML=xmlhttp.responseText;
           //Examination_theory_types();
        }
    }
    xmlhttp.open("GET", "get_action.php?college="+college+"&course="+course+"&batch="+ batch+ "&sem=" + sem+"&examination="+examination+"&code="+62,true);
    xmlhttp.send();
}
else
{
    alert("Please Select Appropriate data ");
}

}


function ViewResultStudent(ID){
    var spinner= document.getElementById("ajax-loader");
    spinner.style.display='block';
    var code = 456;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                ID: ID   
            },
            success: function(response) {
                spinner.style.display = 'none';
                console.log(response);
                    document.getElementById("ViewResultData").innerHTML = response;
     //  loadMainCount();
            }
        });
}
  function publishResult(ID){
    var sgroup = document.getElementById('group').value;
    var resultNum = document.getElementById('resultNum').value;
    var  decDate = document.getElementById('decDate').value;
    var verifiy = document.getElementsByClassName('v_check');
            var len_student = verifiy.length;
            var subjectIDs = [];
            for (i = 0; i < len_student; i++) {
                if (verifiy[i].checked === true) {
                    subjectIDs.push(verifiy[i].value);
                }
            }
            if ((typeof subjectIDs[0] == 'undefined')) {
                // alert('');
                ErrorToast(' Select atleast one Student', 'bg-warning');
            } else {
if(resultNum!='' && decDate!='' )
{
var spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var code = 457;
        $.ajax({
            url: 'action_g.php',
            type: 'POST',
            data: {
                code: code,
                ID: ID,
                resultNum:resultNum,
                decDate:decDate,
                sgroup:sgroup,
                ResultIDs:subjectIDs
            },
            success: function(response) {
                spinner.style.display = 'none';
                console.log(response)
                // if(response==1){
                    SuccessToast('Successfully Publish');
                    select_mst();
                // }
                // else{
                //     ErrorToast('try Again','bg-danger');
                // }
                
            }
        });
    }
    else{
        ErrorToast('Please enter ResultNo/declareDate ','bg-warning');

    }
    }
}
function exportCutListExcelgraden() {
    // alert();
    var exportCode = 71;
    var College = document.getElementById('College').value;
    var Course = document.getElementById('Course').value;
    var Batch = document.getElementById('Batch').value;
    var Semester = document.getElementById('Semester').value;
    var Type = document.getElementById('Type').value;
    var group = document.getElementById('group').value;
    var Examination = document.getElementById('Examination').value;
    if (College != '' && Course != '' && Batch != '' && Semester != '' && Examination != '') {
        window.open("export.php?exportCode=" + exportCode + "&CollegeId=" + College + "&Course=" + Course +
            "&Batch=" + Batch + "&Semester=" + Semester + "&Type=" +
            Type + "&Examination=" +  Examination + "&Group=" +  group , '_blank');

    } else {
       
        ErrorToast('All input required','bg-warning');
    }
}


        </script>
        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Results</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="edit_stu">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bd-example-modal-xl " id="ViewResult" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Results</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ViewResultData">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
        <?php

 include "footer.php";  ?>