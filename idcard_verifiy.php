<?php 
  ini_set('max_execution_time',0);
  include "header.php";   
?>
  <?php

// $get_pending="SELECT PIN,State,District,PermanentAddress,StudentName,FatherName,Course,Batch,ClassRollNo,StudentMobileNo FROM SmartCardDetails inner join Admissions ON Admissions.IDNo=SmartCardDetails.IDNO where SmartCardDetails.Status='Applied' ";
// $get_pending_run=sqlsrv_query($conntest,$get_pending);
// if($row_pending=sqlsrv_fetch_array($get_pending_run))
// {
    // $data[]=$row_pending;
    // $data[]=array_push($data,$row_pending['StudentName'],$row_pending['FatherName'],
    // $row_pending['Course'],$row_pending['Batch'],$row_pending['ClassRollNo'],$row_pending['StudentMobileNo'],$row_pending['DOB']->format('Y-m-d'),
    // $row_pending['PermanentAddress'],$row_pending['District'],$row_pending['State'],$row_pending['PIN']);
//  }
// print_r($data);
?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <div class="col-md-6 col-lg-6 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Pending&nbsp;(<span id="pending_count"></span>)</h3>
                 <button type="button" onclick="show_all();" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#all_showexampleModal"  style="float:right;">Show All</button>
                 
               </div>
               
                  <div class="card-body">
                  <div class="card-body table-responsive " id="pending_record" style="height:600px;" >
                  
                        </div>
                        </div>
            </div>

         </div>
       
            <div class="col-lg-6 col-md-6 col-sm-3">
               <div class="card card-info">
                  <div class="card-header">
                  <h3 class="card-title">Rejected&nbsp;(<span id="reject_count"></span>)</h3>
                  <button type="button" class="btn btn-primary btn-xs" onclick="reject_show_idcard();" style="float:right;">Show All</button>
                 
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body"  >
                  <div class=" table-responsive " id="reject_record" style="height:600px;"  >
                   
                        </div>
                        </div>
                 
               </div>
              
            </div>
      
        
      </div>
      
   </div>
 
</section>

<div class="modal fade" id="rejectexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_record_reject">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_record">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="all_showexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
      <div id="div_all">
                  <div class="card" ><center><marquee><h5 class="text-danger">Please enter the date you'd like to search records</h5></marquee></center></div>
                  
               </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<script>
    
    function view_pending(id)
    {
       
               var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=143;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               
               spinner.style.display='none';
                document.getElementById("view_record").innerHTML=response;
                
              }
           });
          
         }
    
    function view_rejected(id){
        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     // alert(SubjectCode+' '+CourseID+' '+Batch+' '+Semester);
     var code=144;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               
               spinner.style.display='none';
                document.getElementById("view_record_reject").innerHTML=response;
                
              }
           });
          
    }
    function verify_idcard(id){
        // var spinner=document.getElementById("ajax-loader");
    //  spinner.style.display='block';
     var code=145;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
            //    console.log(response);
            //    spinner.style.display='none';
               if(response=='1')
               {
                   SuccessToast('Success Verifiy');
                   pending_show_idcard();
                   set_count_pending();
                   set_count_reject();
               }
               else
               {

               }
                
              }
           });
          
    }
    function reject_idcard(id){
        // var spinner=document.getElementById("ajax-loader");
    //  spinner.style.display='block';
     var code=146;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,id:id
              },
              success: function(response) 
              {
               
            //    spinner.style.display='none';
               if(response=='1')
               {
                   SuccessToast('Successfully Rejected');
                   reject_show_idcard();
                   set_count_pending();
                   set_count_reject();
               }
               else
               {

               }
                
              }
           });
          
    }
    function pending_show_idcard(){
        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=147;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
               spinner.style.display='none';
               set_count_pending();
               set_count_reject();
               document.getElementById("pending_record").innerHTML=response;
               $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
              }
           });
          
    }
    function reject_show_idcard(){
        var spinner=document.getElementById("ajax-loader");
     spinner.style.display='block';
     var code=148;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
               spinner.style.display='none';
               set_count_pending();
               set_count_reject();
               document.getElementById("reject_record").innerHTML=response;
               $('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
              }
           });
          
    }
    function set_count_pending(){
     var code=149;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
              
               document.getElementById("pending_count").innerHTML=response;
               
              }
           });
          
    }
    function set_count_reject(){
     var code=150;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code
              },
              success: function(response) 
              {
              
              
               document.getElementById("reject_count").innerHTML=response;
               
              }
           });
          
    }
    pending_show_idcard();
    reject_show_idcard();

function show_all() {
    // alert();
    var currentPage = 1;
                  var code = 151;
                  var searchQuery = '';
  
                  // $(document).ready(function() {
                     loadData(currentPage);

                     function loadData(page) {
                        // alert(page);
                        $.ajax({
                           url: 'action_g.php',
                           type: 'POST',
                           dataType: 'json',
                           data: {
                              page: page,
                              code: code,
                              search: searchQuery // Pass the search query to the server
                           },
                           success: function(data) {
                               buildTable(data);
                               console.log(data);
                            //   updatePagination(page);
                           },
                           error: function() {
                            //   Handle error response
                           }
                        });
                     }
                     function buildTable(data) {
                        for (var i = 0; i < data.length; i++) {
                           var unirollno = data[i];
                        document.getElementById("div_all").innerHTML = '<div id="pagination">'+unirollno+'<center><button id="prev-btn" class="btn btn-primary " disabled>Previous</button><button id="next-btn" class="btn btn-primary ">Next</button></center></div><div class="container"><div class="container-fluid"><div class="card card-primary"><div class="card-header"><h5>Smart Card View</h5></div><div class="card-body"><div class="row">           <div class="col-lg-6 text-center text-bold"><img src="dist/img/new-logo.png" alt="logo" width="210"> <br><br> <h5 style="background-color: #223260; color: white">    <span id="CollegeName" readonly="true"></span> </h5>  <br> Name: <span id="StudentName" readonly="true"></span> <br> RollNo: <span id="ClassRollNo" readonly="true"></span> <br> Course: <span id="Course" readonly="true"></span> <br> Batch: <span id="Batch" readonly="true"></span><br> Valid upto: <span id="ValidUpto" readonly="true"></span><br> <br> <h5 style="background-color: #223260; color: white">Authourity Signature</h5></div><div class="col-lg-6 text-center" > <b>This is a property of Guru Kashi University</b> <hr> FatherName: <span id="FatherName" readonly="true"></span> <br> Mobile: <span id="StudetMobileNo" readonly="true"></span> <br> DOB: <span id="DOB" readonly="true"></span> <br> <b><span>Address</span></b><br> <span id="PermanentAddress" readonly="true"></span> <br> <span id="State" readonly="true"></span> <br> <span id="State" readonly="true"></span> PIN- <span id="PIN" readonly="true"></span> <br>  <textarea name="" rows="2" cols="20" id="" class="form-control" placeholder="Rejected Reason"></textarea> <br> <input type="submit" name="" value="Verify" onclick="verify_idcard();" class="btn btn-success"> <input type="submit" name="" value="Reject" onclick="reject_idcard();" class="btn btn-danger"></div></div></div>    </div></div></div>';  
                        
                        }
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        // var table = '<table class="table table-bordered">';
                        // table += '<tr>';
                        // table += '<div id="pagination"><center><td> <button id="prev-btn" class="btn btn-primary " disabled>Previous</button></td><td colspan="2"></td><td colspan=""><input type="date" id="date" class="form-control" value="2023-07-14"></td><td> <button onclick="printSelectedRows();" class="btn btn-success " >Diploma Print </button> </td><td colspan="2"> <button onclick="printSelectedRows_all_course();" class="btn btn-success " >Other </button> </td><td><button id="next-btn" class="btn btn-primary ">Next</button></center></td></div>';
                        // table += '</tr>';
                        // table += '<tr><th><input type="checkbox" id="selectAllCheckbox" class="selectAllCheckbox" onchange="toggleSelectAll(this)"></th><th>ID</th><th>Name</th><th>UniRolNo</th><th>FatherName</th><th>Examination</th><th>Course</th><th>Action</th></tr>';
                        // for (var i = 0; i < data.length; i++) {
                        //    var unirollno = data[i][2];
                        //    table += '<tr>';
                        //    table += '<td><input type="checkbox" name="selectedRows[]" value="' + data[i][0] + '"></td>';
                        //    table += '<td>' + data[i][0] + '</td>';
                        //    table += '<td>' + data[i][1] + '</td>';
                        //    table += '<td data-toggle="modal" data-target="#exampleModal" onclick="view_image(\'' + unirollno + '\');">' + unirollno + '</td>';
                        //    table += '<td>' + data[i][3] + '</td>';
                        //    table += '<td>' + data[i][5] + '</td>';
                        //    table += '<td>' + data[i][6] + '</td>';
                        //    table += '<td><button onclick="edit_student('+ data[i][0] +');" data-toggle="modal" data-target="#for_edit" class="btn btn-success btn-xs " ><i class="fa fa-edit"></i></button ></td>';
                          
                        //    table += '</tr>';
                        // }
                      
                        // table += '</table>';

                        $('#data-table').html(table);
                     }

                     function updatePagination(page) {
                        var totalPages = Math.ceil(100000 / 100);

                        if (page == 1) {
                           $('#prev-btn').prop('disabled', true);
                        } else {
                           $('#prev-btn').prop('disabled', false);
                        }

                        if (page+1 == totalPages) {
                           $('#next-btn').prop('disabled', true);
                        } else {
                           $('#next-btn').prop('disabled', false);
                        }
                     }

                     $(document).on('click', '.pagination-button', function() {
                        var page = $(this).data('page');
                        currentPage = page;
                        loadData(currentPage);
                     });

                     $(document).on('click', '#prev-btn', function() {
                        if (currentPage > 1) {
                           currentPage--;
                           loadData(currentPage);
                        }
                     });

                     $(document).on('click', '#next-btn', function() {
                        var totalPages = Math.ceil(100000 / 1);
                        if (currentPage < totalPages) {
                           currentPage++;
                           loadData(currentPage);
                        }
                     });
}
</script>


<?php include "footer.php";  ?>