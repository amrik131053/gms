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
                        All Results
                        <!-- <span class="mr-2"> <button class="btn btn-primary btn-sm "><span class="badge" id="pendingCount"></span> Pending</button> </span>
                        <span class="mr-2"> <button class="btn btn-danger btn-sm "><span class="badge" id="rejectCount"></span>Rejected </button> </span>
                        <span> <button class="btn btn-success btn-sm "><span class="badge" id="verifiedCount"> </span>Accepted</button> </span>
                        <span style="float:right;">
      <button class="btn btn-sm ">
         <input type="search"  class="form-control form-control-sm" name="rollNo" id="rollNo" placeholder="Search RollNo">
      </button>
            <button type="button" onclick="searchStudentOnRollNo();" class="btn btn-success btn-sm">
              Search
            </button>
      </span> -->
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
       

                        </div>
                        <div class="table table-responsive" id="show_record"></div>

<?php 
 $getResultID="SELECT Top(50)* FROM ResultPreparation ORDER by Id DESC ";
?>


<table class="table table-bordered" id="example">
                             <thead>
                                 <tr style="font-size:14px;">
                                 <th><input type="checkbox" id="select_all1" onclick="verifiy_select();" class=""></th>
                                     <th>ID</th>
                                     <th>College</th>
                                     <th>Course</th>
                                     <th>Batch</th>
                                     <th>Semester</th>
                                     <th>Type</th>
                                     <th>Examination</th>
                                     <!-- <th >Action</th> -->
                                 </tr>
                             </thead>
                             <tbody>
<?php
            $getResultIDRun = sqlsrv_query($conntest,$getResultID);
             while( $row = sqlsrv_fetch_array($getResultIDRun, SQLSRV_FETCH_ASSOC) )
                {
                    $getCollegeName="SELECT * FROM MasterCourseCodes where CourseID='".$row['CourseID']."'  ";
                    $getCollegeNameRun=sqlsrv_query($conntest,$getCollegeName);
                    if($getCollegeNameRunRow=sqlsrv_fetch_array($getCollegeNameRun,SQLSRV_FETCH_ASSOC))
                    {
$CourseName=$getCollegeNameRunRow['Course'];
                    }
                    $getCollegeName1="SELECT * FROM MasterCourseCodes where CollegeID='".$row['CollegeID']."'  ";
                    $getCollegeName1Run=sqlsrv_query($conntest,$getCollegeName1);
                    if($getCollegeName1RunRow=sqlsrv_fetch_array($getCollegeName1Run,SQLSRV_FETCH_ASSOC))
                    {
$CollegeName=$getCollegeName1RunRow['CollegeName'];
                    }
        ?>
             <tr style="background-color:<?=$trColor;?>;font-size:14px;">
             <td><input type="checkbox" class="checkbox v_check" value="<?=$row['Id'];?>"></td>
          <td><?=$row['Id'];?> </td>
          <td><?=$CollegeName;?> </td>
          <td><?=$CourseName;?></td>
          <td><?=$row['Batch'];?></td>
          <td><?=$row['Semester'];?></td>
          <td><?=$row['Type'];?></td>
          <td><?=$row['Examination'];?></td>   
       <!-- <td><i class="fa fa-trash fa-lg text-danger" data-toggle="modal"  data-target=".bd-example-modal-xl" onclick=" delete_trash(<?= $row['Id'];?>)"></i>&nbsp;&nbsp;
         </td> -->
            </tr>
        <?php 
                    
         }?>
        <tr>
            <td colspan="13"> <button type="submit" id="type" onclick="deleteAll();" name="update" class="btn btn-danger " style="float:right;">Delete</button></td>
         </tr>

         </tbody>
     </table>

                        
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



function deleteAll()
{
  var verifiy=document.getElementsByClassName('v_check');
  var len_student= verifiy.length; 
  var code=456;
  var subjectIDs=[];   
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            subjectIDs.push(verifiy[i].value);
          }
     }
  if((typeof  subjectIDs[0]== 'undefined'))
  {
    // alert('');
    ErrorToast(' Select atleast one Student' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{subjectIDs:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully deleted');
            //    search_study_scheme();
            window.onload = function() {};
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
}



function verifiy_select()
{
        if(document.getElementById("select_all1").checked)
        {
            $('.v_check').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.v_check').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.v_check').on('click',function()
    {
        var a=document.getElementsByClassName("v_check:checked").length;
        var b=document.getElementsByClassName("v_check").length;
        
        if(a == b)
        {

            $('#select_all1').prop('checked',true);
        }
        else
        {
            $('#select_all1').prop('checked',false);
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
                Examination: Examination,sub_data:sub_data
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




</script>
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registration Form</h5>
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
<?php

 include "footer.php";  ?>