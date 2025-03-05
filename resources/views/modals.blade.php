
<div class="modal modal-blur fade" id="modal-view-busspass" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bus Pass Track</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <ul class="steps steps-vertical">
            <li class="step-item">
              <div class="text-secondary">Sesion <b id="sessionBusPass"></b> Route Name: <b id="routeBusPass"></b> to <b
                  id="spotBusPass"></b> Apply Date: <b id="applyDateBusPass"></b> </div>
            </li>
          </ul>
          <div class="progress-container-vertical  ">
            <div class="step" id="step-1">Pending </div>
            <div class="step hidden" id="step-2">Rejected By IT</div>
            <div class="step" id="step-3">Forward to Account</div>
            <div class="step hidden" id="step-4">Rejected By Account</div>
            <div class="step" id="step-5">Ready to Print</div>
            <div class="step" id="step-6">Printed</div>
          </div>
          <div id="rejectReason" class="hidden" style="color: red; font-weight: bold;"></div>
        </div>


      </div>

      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
      </div>
    </div>
  </div>
</div>
<!-- <div class="modal modal-blur fade" id="modal-view-examForms" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Exam Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="table-default" class="table-responsive">
          <div id="subjectsTableDiv"></div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
          Cancel
        </a>
      </div>
    </div>
  </div>
</div> -->
<div class="modal fade" id="examModal" tabindex="-1" aria-labelledby="examModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examModalLabel">Exam Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead >
                                <tr >
                                    <th style="background-color:#223260;color:white;">Subject Code</th>
                                    <th style="background-color:#223260;color:white;">Subject Name</th>
                                    <th style="background-color:#223260;color:white;">Y/N</th>
                                </tr>
                            </thead>
                            <tbody id="subjectsTableDiv">
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  
                </div>
            </div>
        </div>
    </div>

<!-- Modal for Uploading ping Image -->
<div class="modal fade" id="modal-view-upload-image" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Upload  Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Image preview ping area -->
        <form action="{{url('upload-student-image')}}" method="post" enctype="multipart/form-data">
        @csrf
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                 
                
        <!-- Input for selecting a file -->
        <input type="file" name="inputImage" class="form-control mt-3">
        <strong class="text-danger">Note:</strong><br><b>The image must be less than or equal to 500 KB</b><br>
        <!-- <b>The image width:270px and height:300px.</b><br> -->
        <b>The image must be a file of type: jpg, jpeg, png.</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="crop"> Upload</button>
      </div>
     </form>
    </div>
  </div>
</div>
<!-- Modal for Uploading ping Image -->
<div class="modal fade" id="modal-view-upload-signature" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Upload  signature</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Image preview ping area -->
        <form action="{{url('upload-student-signature')}}" method="post" enctype="multipart/form-data">
        @csrf
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                 
                
        <!-- Input for selecting a file -->
        <input type="file" name="inputSign" class="form-control mt-3">
        <strong class="text-danger">Note:</strong><br><b>The image must be less than or equal to 500 KB</b><br>
        <!-- <b>The image width:300px and height:100px.</b><br> -->
        <b>The image must be a file of type: jpg, jpeg, png.</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="crop"> Upload</button>
      </div>
     </form>
    </div>
  </div>
</div>