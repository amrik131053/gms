<?php
include "header.php";
?>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class=" card-header">
                    Shift Manage
                </div>

                <div class="card card-body">
                <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card-tools">
                        <div class="input-group">
                            <button type="button" data-toggle="modal" data-target="#NewDepartmentModal"
                                value="New Designation" class="btn btn-primary btn-xs"><i class="fa fa-plus"> New
                                    Shift</i> </button>
                            &nbsp;
                            &nbsp;
                            <select name="College" id='CollegeID_For_Department' class="form-control form-control-sm"
                                required="">
                                <option value=''>Select Shift</option>
                                <?php
                        $sql="SELECT * from MasterShift ";
                                $stmt2 = sqlsrv_query($conntest,$sql);
                            while($row1 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC) )
                                {
                            $ShiftName = $row1['ShiftName']; 
                            $Id = $row1['Id'];
                            ?>
                                <option value="<?=$Id;?>"><?= $ShiftName;?></option>
                                <?php    }

                                                    ?>
                            </select>
                            <input type="button" onclick="search();" value="Search" class="btn btn-success btn-xs">
                        </div>
                    </div>
                    </div>
                    </div>


                    <div class="card-body table-responsive " id="tab_data">
                    </div>
                </div>
            </div>
        </div>
        </div>

</section>

<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">View  Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  id='update_data'>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="UpdateDesignationModalCenter2" tabindex="-1" role="dialog" aria-labelledby="UpdateDesignationModalCenter2" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">edit Designaion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  id='update_data_designation'>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="NewDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="NewDepartmentModal" aria-hidden="true" >
   <div class="modal-dialog " role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
           <h5 class="modal-title" id="NewDepartmentModal">New Shift</h5> 
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
  
     <div class="row">
      <div class="col-lg-10"> 
      	
    <label>Name</label>
    <input type="text"  id="shiftName" class="form-control" required>
    <br>
    <input type="submit"  onclick="save_designation();"  value="save" class="btn btn-secondary"> 

    </div>
    <div class="col-lg-1"></div>

    </div>
<br>
   
     
     
                
      </div>
   </div>
</div>
<script>
         	function save_designation()
	{
		var code=254;
       var shiftName=document.getElementById('shiftName').value;
    
         var spinner=document.getElementById('ajax-loader');

         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code,shiftName:shiftName},
                success: function(response) 
               { 
                search();
               spinner.style.display='none';
                SuccessToast('Successfully Added');
               }
         });



	}
    function delete_dep(id)
{
   var a=confirm('Are you sure you want to delete');
//    alert(id);
   if (a==true) {
var code=251;
 var spinner=document.getElementById('ajax-loader');

         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code,id:id},
                success: function(response) 
               { 
               	console.log(response);
               spinner.style.display='none';
               search();
                SuccessToast('Successfully Deleted');
              // document.getElementById("tab_data").innerHTML=response;
               }
         });
      }
      else
      {

      }
}
function update_dep(id)
          {
       var code=252;

       
    
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
   $.ajax({
                url:'action_g.php',
                type:'POST',
                data:{code:code,id:id},
                success: function(response) 
               { 
               spinner.style.display='none';
               search();
               document.getElementById("update_data").innerHTML=response;
               }
         });

     }
function search() {
    var code = 250;

    var college = document.getElementById('CollegeID_For_Department').value;

    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code,
            college: college
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("tab_data").innerHTML = response;
        }
    });

}
function Updatedepdata(id)
{
    var code=253;
var shiftName=document.getElementById('shiftName').value;

   
 
      var spinner=document.getElementById('ajax-loader');
      spinner.style.display='block';
$.ajax({
             url:'action_g.php',
             type:'POST',
             data:{code:code,id:id,shiftName:shiftName},
             success: function(response) 
            { 
            spinner.style.display='none';
              search();
             SuccessToast('Successfully Updated');

            }
      });

  }

</script>


<?php include "footer.php";?>