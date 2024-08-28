
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><?php 

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

    function edit_stu(id)
          {

            //alert(id);
               var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=377;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               
               spinner.style.display='none';
                document.getElementById("edit_stu").innerHTML=response;
                
              }
           });
          
         }

function sub_code_int_ext_type_update(id)
           {
        var r = confirm("Do you really want to Change");
          if(r == true) 
           {
         // alert(id);
        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
      var userid = document.getElementById('userid').value;
         var subcode=document.getElementById(id+"_subcode").value;
         var subname=document.getElementById(id+"_subname").value;
         //var int=document.getElementById(id+"_Int").value;
         var ext=document.getElementById(id+"_Ext").value;
         var intm=document.getElementById(id+"_intmarks").value;
         var extm=document.getElementById(id+"_extmarks").value;
         var subtype=document.getElementById(id+"_subtype").value;
         var code=210;
         // alert(subcode+' '+subname+' '+int+' '+ext+' '+intm+' '+extm+''+subtype);
         $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,subcode:subcode,subname:subname,Ext:ext,Intm:intm,Extm:extm,subtype:subtype,userid:userid
              },
              success: function(response) 
              {
                //console.log(response);
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully Updated');
                         Search_exam_student_open();
                           }
                          else
                           {
                           ErrorToast('Can`t Update','bg-danger' );
                           }
                
              }
           });

  }
}     

   function receipt_date_no_update(id)
           {
        var r = confirm("Do you really want to Change");
          if(r == true) 
           {

         // alert(id);
        var spinner=document.getElementById("ajax-loader");
          spinner.style.display='block';
         var rdate=document.getElementById("asreceipt_date").value;
       var rno=document.getElementById("asreceipt_no").value;
        var userid = document.getElementById('userid').value;
      
         var code=211;
         // alert(subcode+' '+subname+' '+int+' '+ext+' '+intm+' '+extm+''+subtype);
         $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,receipt_date:rdate,receipt_no:rno,userid:userid
              },
              success: function(response) 
              {
                // console.log(response);
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully Updated');
                         Search_exam_student_open();
                           }
                          else
                           {
                           ErrorToast('Try Again','bg-danger' );
                           }
                
              }
           });

  }
}


  function exam_type_update(id)
    {
         var r = confirm("Do you really want to Change");
          if(r == true) 
           {
       var type=document.getElementById('type_').value;
       var examination=document.getElementById('examination_').value;
        var sgroup=document.getElementById('sgroup_').value;
         var userid = document.getElementById('userid').value;
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(type+' '+examination);
     var code=208;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,examination:examination,type:type,sgroup:sgroup,userid:userid
              },
              success: function(response) 
              {
               console.log(response);
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully Update');
                          Search_exam_student_open();
                          }
                          else
                          {
                           ErrorToast('Input Wrong ','bg-danger' );
                          }
                
              }
           });
       }
    }


 function Delete_sub_code_int_ext_type_update(id,nid)
    {
         var r = confirm("Do you really want to Delete");
          if(r == true) 
           {

     var r = confirm("it is going to Delete");
          if(r == true) 
           {
      var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
      var userid = document.getElementById('userid').value;
       var subcode=document.getElementById(id+"_subcode").value;
         var subname=document.getElementById(id+"_subname").value;
     
     var code=310;
           $.ajax({
              url:'action.php',
              type:'POST',
              data:{
                 code:code,id:id,userid:userid,subname:subname,subcode:subcode
              },
              success: function(response) 
              {
              
               spinner.style.display='none';
                  if (response=='1')
                           {
                           SuccessToast('Successfully deleted');
                          Search_exam_student_open();
                           edit_stu(nid);
                           }
                          else
                          {
                           ErrorToast('Input Wrong ','bg-danger' );
                          }
                
              }
           });
       }
   }
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


   <label>Colleged</label>
       <select  name="College" id='College' onchange="courseByCollege(this.value)" class="form-control" required="">
                <option value=''>Select Course</option>
                  <?php
   $sql="SELECT DISTINCT MasterCourseCodes.CollegeName,MasterCourseCodes.CollegeID from MasterCourseCodes  INNER JOIN UserAccessLevel on  UserAccessLevel.CollegeID = MasterCourseCodes.CollegeID ";
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
  <label>Search</label><br>
            <button class="btn btn-danger" onclick="Search_exam_student_pre();"><i  class="fa fa-search" ></i></button>

</div>



        <!-- /.row -->
      </div>
    </br>

<p id="ajax-loader"></p>

 <div class="row">
          <!-- left column -->
          <div class="col-lg-8 col-md-4 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Students</h3>
              </div>
        
             <!--  <form class="form-horizontal" action="" method="POST"> -->
                <div class="card-body">
                  <div id="live_data_Exam_student">
                  
                  </div>
                </div>
                <div class="card-footer">
                  
                </div>
                <!-- /.card-footer -->
              <!-- </form> -->
            </div>
          </div>

  <div class="col-lg-4 col-md-4 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Subjects</h3>
              </div>
        
             <!--  <form class="form-horizontal" action="" method="POST"> -->
                <div class="card-body">
                  <div id="live_data_Exam_subjects">
                  
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

   <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" >
     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exam From Submit</h5>
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
<div
    <?php include "footer.php";  ?>