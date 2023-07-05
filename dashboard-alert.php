
<?php 

$Notification="SELECT * FROM movement where Status='draft' and superwiser_id='$EmployeeID'";
$Notification_run=mysqli_query($conn,$Notification);
$count=mysqli_num_rows($Notification_run);
while($row=mysqli_fetch_array($Notification_run))
{
  if ($count>0)
   {?>
<div class="modal fade" id="modal-lg-notification">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <!-- <div class="modal-header">
              <h4 class="modal-title">Pending Notification</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> -->
            <div class="modal-body">
                  <div class="col-lg-12">
                    <div class="position-relative p-3 bg-gray" style="height: 180px">
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-warning text-xl">
                          Pending
                        </div>
                      </div>
                      <h5>Number of Request for Movement:&nbsp;<?=$count;?></h5>
                   <a href="movement-admin.php"> <input type="button" class="btn btn-success btn-xs" value="Click here" ></a>
                    </div>
                  </div>
            </div>
           <!--  <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

  <?php 
}
  else
  {

  }
}
?>
      

