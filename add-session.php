<?php 
  include "header.php";   
?>
<section class="content">
   <div class="container-fluid">
      <div class="card card-info">
         <div class="card-header">
            <h3 class="card-title">Add Session</h3>                  
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-lg-4">
                  <div class="card">
                     <div class="card-body">
                        <div class="row">                      
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <label> Month </label>
                              <select name="month" id='month' required class="form-control">
                                <option value="">Choose</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                              </select>
                        
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                              <label> Year </label>
                              <select name="year" id="year" required class="form-control">
                                <option value="">Choose</option>
                                <?php
                                for ($i=2022; $i <= 2030; $i++) 
                                {
                                ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                                <?php
                                }
                                ?>
                              </select>
                        
                            </div>
                            
                            
                            <div class="col-lg-12 col-md-6 col-sm-6">
                              <label>&nbsp;</label>
                              <input type="submit" onclick="addSession()" name="test_submit" value="Create" style="background-color:#223260;" class="form-control btn btn-primary ">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                      
                          
                            <?php
                            $count=0;
                            $sql="SELECT * FROM question_session ORDER BY id desc";
                            if($data=mysqli_fetch_array(mysqli_query($conn,$sql)))
                            {
                              ?>  
                              <div class="col-lg-8">
                              <div class="card">
                        <div class="card-body">
                              <div class="row">
                                <div class="col-lg-12" style="overflow-x:auto;" id="table-scroll">
                                  <table class="table">
                                    <tr>
                                      <th>Sr. No.</th>
                                      
                                      <th>Session</th>
                                     
                                      <th>Status</th>
                                    </tr>
                              <?php
                            $run=mysqli_query($conn,$sql);
                            while($data=mysqli_fetch_array($run))
                            { $count++;
                              ?>
                              <tr>
                                 <td><?=$count;?></td>  
                                 <td><?=$data['session_name'];?></td>  
                                <td><?=$data['session_status'];?></td>  
                              </tr> 
                              <?php
                            }
                            ?>
                          </table>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                      <?php
                      }
                      ?>
                      
                    
                  </div>
         </form>
         </div>
         <div class="card-footer" style="text-align: right;">
         </div>
      </div>
   </div>
</section>
  

<p id="ajax-loader"></p>
<script>
   function addSession() 
   {
      var year=document.getElementById("year").value;
      var month=document.getElementById("month").value;
      var code=129;
      $.ajax({
            url:'action.php',
            type:'POST',
            data:{
               code:code,year:year,month:month
            },
            success: function(response) 
            {
               console.log(response);
               location.reload(true);
            }
         });

   }
</script>

<?php include "footer.php";  ?>