
<?php 

  include "header.php";   
?>

<script>


function checkall()
{

  var inputs = document.querySelectorAll('.newStudents');

      for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = true;

      }
      document.getElementById("check").style.display = "none";
       
      document.getElementById("check1").style.display = "block";
}

function uncheckall()
{

  var inputs = document.querySelectorAll('.newStudents');

        for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = false;
        }
      document.getElementById("check").style.display = "block";
    
        document.getElementById("check1").style.display = "none";
}

</script>
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-lg-2 col-md-4 col-sm-3">

   <label>College</label>
       <select  name="College" id='College' onchange="courseByCollege(this.value)" class="form-control" required="">
                <option value=''>Select Course</option>
                  <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID where UserAccessLevel.IDNo='$EmployeeID' ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {
   
     $college = $row1['CollegeName']; 
     $CollegeID = $row1['CollegeID'];
    ?>
<option  value="<?=$CollegeID;?>"><?= $college;?></option>
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
            <select name="batch"  class="form-control" id="Batch" required="">
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
            <select   id='Semester' class="form-control" required="">
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
              <label>Subject</label>
              <select name="subject" id="Subject" class="form-control" required="">
                <option value="">subject</option>

                
              </select>
            </div>
          </div>


            <div class="col-md-1">
            <div class="form-group">
              <label>Type</label>
              <select name="ecat" id="ecat" class="form-control" required="">
                <option value="CE1">CA-1 & CA-2 </option>
                <option value="MST1">MST-1</option>
                <option value="MST2">MST-2</option> 
                <option value="CE3">CA-3</option>
                <option value="ESE">ESE</option>
                <option value="Attendance">Attendance</option>
             
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
              <select  id="Examination" class="form-control" required="">
                 <option value="">Examination</option>
                 <option  value="May 2025">May 2025</option>

                     <!--   <?php
   $sql="SELECT DISTINCT Examination from ExamForm Order by Examination ASC ";
          $stmt2 = sqlsrv_query($conntest,$sql);
     while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
         {

       
     $Sgroup = $row1['Examination']; 
     
    ?>
<option  value="<?=$Sgroup;?>"><?= $Sgroup;?></option>
<?php    }

?>
 -->
                
              </select>

</div>
 <div class="col-lg-1 col-md-1 col-sm-12">
                                <label>Order By</label>
                                <select id="OrderBy" class="form-control" >
                                    <option value="ClassRollNo">Class RollNo</option>
                                   
                                    <option value="UniRollNo">Uni RollNo</option>
                                    


                                </select>

                            </div>

 <div class="col-lg-1 col-md-4 col-sm-3">
  <label>Search</label><br>
            <button class="btn btn-danger" onclick="select_mst()"><i  class="fa fa-search" ></i></button>


    <button class="btn btn-danger" onclick="exportpdfdata()"><i  class="fa fa-file-pdf" ></i></button> 
</div>

        <!-- /.row -->
      </div>
    </br>
 <div class="row">
          <!-- left column -->
          <div class="col-lg-12 col-md-4 col-sm-3">
   
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
        </div></div>

      <!-- /.container-fluid -->
    </section> 
    <script>
     $(function() { 
      $("#Semester").change(function(e) {
        e.preventDefault();
 
        var course = $("#Course").val();
       var batch = $("#Batch").val();
       var sem = $("#Semester").val();  
           

         
        var code='200.9';
            $.ajax({
            url:'action.php',
            data:{course:course,code:code,batch:batch,sem:sem},
            type:'POST',
            success:function(data)
            { 
              //console.log(data);

             if(data != "")
                {
                
                    $("#Subject").html("");
                    $("#Subject").html(data);
                }
            }
          });
    });
  });
 
 
function select_mst() 
{ 

  var  college = document.getElementById('College').value;
  var  course = document.getElementById('Course').value;
  var  batch = document.getElementById('Batch').value;
  var  sem = document.getElementById('Semester').value; 
  var subject = document.getElementById('Subject').value;
  var  examination = document.getElementById('Examination').value;
  var  group = document.getElementById('group').value;
  var  OrderBy = document.getElementById('OrderBy').value;
    var distributiontheory = document.getElementById('ecat').value;

  if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='' &&distributiontheory!='')
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
      xmlhttp.open("GET", "get_action.php?college="+college+"&course="+course+"&batch="+ batch+ "&sem=" + sem+ "&subject=" + subject+"&DistributionTheory="+distributiontheory+"&examination="+examination+"&group="+group+"&OrderBy="+OrderBy+"&code="+43.1,true);
        xmlhttp.send();  
 }
else
{
 alert("Please Select Appropriate data ");
}
      
  }



function lock(id,idno)
{

  var marks=document.getElementsByClassName('marks');
  var ecat=document.getElementById('ecat').value;
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        id:id,ecat:ecat,idno:idno,code:'207'
      },
      success:function(response)
      {
 
      SuccessToast('Successfully Locked');
        select_mst(); 
        
      }
    });
}

function lockall()
{

  var examination=document.getElementById('Examination').value;
  var ecat=document.getElementById('ecat').value;

 if(examination!='' && ecat!='')
 {
 $.ajax({
      url:'action.php',
      type:'post',
      data:{
        examination:examination,ecat:ecat,code:'209'
      },
      success:function(response)
      {
        if(response>0)
        { 
       SuccessToast('Successfully Locked'+"&nbsp;&nbsp;"+ecat+"&nbsp; of &nbsp;"+examination);
        }
        else
        {
          ErrorToast('Unable to Lock',"bg-danger" );
        }
      }
    });
}
else
{

   ErrorToast('Select Examination and Theory Distibution',"bg-danger" );
}
}


  function exportpdfdata()


   {
          var  college = document.getElementById('College').value;
  var  course = document.getElementById('Course').value;
   var  batch = document.getElementById('Batch').value;
    var  sem = document.getElementById('Semester').value;
         var subject = document.getElementById('Subject').value;
     var  examination = document.getElementById('Examination').value;
 var  group = document.getElementById('group').value;
    var distributiontheory = document.getElementById('ecat').value;



  var OrderBy = document.getElementById('OrderBy').value;



  if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='' &&distributiontheory!='')
 {
  var code=1;
   
window.open(
  "print-award-theory.php?college=" + college +
  "&course=" + course +
  "&batch=" + batch +
  "&sem=" + sem +
  "&subject=" + subject +
  "&examination=" + examination +
  "&distributiontheory=" + distributiontheory +
  "&group=" + group +
  "&OrderBy=" + OrderBy +
  "&code=" + code,
  "_blank"
);


    }
    else if(college!=''&&batch!='' && sem!='' && subject!=''&& examination!='')
    {
       var code=2;
      window.location.href="print-award-theory.php?college="+college+"&course="+course+"&batch="+batch+"&sem="+sem+"&subject="+subject+"&examination="+examination+"&distributiontheory="+distributiontheory+"&group="+group+"&OrderBy="+OrderBy+"&code="+code,"_blank";

    }
      else
      {
        ErrorToast('Select Appropriate data','bg-danger');
 
      }
}

  function uploadPhoto(form) {

   var formData = new FormData(form);
      $.ajax({

         url: form.action,
         type: form.method,
         data: formData,
         contentType: false,
         processData: false,
         success: function(response) {
             //console.log(response);
            if (response==1) 
            {
            SuccessToast('Successfully Updated');
            select_mst(); 
                }
             else if(response=='Could not connect to 10.0.10.11')
                {
                 ErrorToast('FTP Server Off' ,'bg-warning');
                }
               else
                {

                 }
         },
         error: function(xhr, status, error) {
            console.log(error);
         }
      });
  }


function savemarks(id,idno)
{ 

var   spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var marks=document.getElementById('marks_'+id).value;
   var ecat=document.getElementById('ecat').value;
     var  sem = document.getElementById('Semester').value;

  $.ajax({
      url:'action.php',
      type:'post',
      data:{
        id:id,marks:marks,ecat:ecat,sem:sem,idno:idno,code:'360.1'
      },
      success:function(response)
      { 
        spinner.style.display='none';
         console.log(response); 
       if(response==1)
        {
       SuccessToast('Successfully Updated');
            select_mst(); 
        }
        else if(response==0)
        {
           ErrorToast('something went wrong','bg-danger');

        }
         else if(response==2)
        {
 ErrorToast('Date Over','bg-danger');
        }


     
       
       
      }
    });

}


</script>

<!-- Button trigger modal -->


<!-- Modal -->

    <?php include "footer.php";  ?>