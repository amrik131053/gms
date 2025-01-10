@include('css')

<div class="page">
    @include('header')
    <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="tablerToastSuccess" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
    <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="tablerToastWarning" class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
    <div class="container-xl">
        <div class="row row-cards">
    
                               
            <div class="col-lg-5 col-sm-12 card">
                <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h4 class="card-title">Correction Form</h4>
                    </div>
                    
                    <div class="card-body">
                    <div id="alertContainer">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                    <form id="smartCardForm" action="{{ url('submitCorrectionData') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <meta name="csrf-token" content="{{ csrf_token() }}">
                                        
                    <div class="row">
                        
                          <!-- Father Name -->
                           <input type="hidden" name="mobile" value="{{$correctionData['StudentMobileNo']}}">
                           <input type="hidden" name="email" value="{{$correctionData['EmailID']}}">
                           <input type="hidden" name="address" value="{{$correctionData['PermanentAddress']}}">
                                                            <div class="col-md-6 mb-3">
                                                                <label for="student_name" class="form-label">Student
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="student_name"
                                                                    name="student_name"
                                                                    value="{{$correctionData['StudentName']}}" >
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label for="father_name" class="form-label">Father
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="father_name"
                                                                    name="father_name"
                                                                    value="{{$correctionData['FatherName']}}" >
                                                            </div>

                                                            <!-- Mother Name -->
                                                            <div class="col-md-6 mb-3">
                                                                <label for="mother_name" class="form-label">Mother
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="mother_name"
                                                                    name="mother_name"
                                                                    value="{{$correctionData['MotherName']}}" >
                                                            </div>

                                                            <!-- Gender -->
                                                            <div class="col-md-3 mb-3">
                                                                <label for="gender" class="form-label">Gender</label>
                                                                <select class="form-select" id="gender" name="gender"
                                                                    required>
                                                                    <option value="{{$correctionData['Sex']}}">
                                                                        {{$correctionData['Sex']}}</option>
                                                                    <option value="Female">Female</option>
                                                                    <option value="Male">Male</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-3 mb-3">
                                                                <label for="dob" class="form-label">Date of
                                                                    Birth</label>
                                                                <input type="text" class="form-control" id="dob"
                                                                    name="dob"
                                                                    value="{{ \Carbon\Carbon::parse($correctionData['DOB'])->format('d-m-Y') }}"
                                                                    >
                                                            </div>
                                                            <div class="col-md-12 mb-12">
                                                                <label for="remarks" class="form-label">Remarks</label>
                                                               <textarea name="remarks" class="form-control" id="remarks"></textarea>
                                                            </div>
                                                            <div class="col-md-12 mb-12">
                                                                <label for="fileName" class="form-label">Attachment File</label>
                                                               <input type="file" name="correction" id="fileName" class="form-control">
                                                            </div>
                                                            </div>
                                
                       
                       
                    </div>
                                                <div class="card-footer">
                                                    <div class="row align-items-right">
                                                        <div class="col-lg-10"></div>
                                                        <div class="col-auto">
                                                            <button class="btn btn-primary">
                                                                Submit
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
</form>
                
            </div>
            <!-- <div id="subjectsTableDiv"></div> -->

            <div class="col-lg-7 col-sm-12">
                <form action="#" method="post" class="card">
                <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h4 class="card-title">All Requests</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sr No</th>
                        <th>Request No</th>
                        <th>Submit Date</th>
                        
                        <th>Status</th>
                      
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                      
                    @if (!empty($correctionDataHistory))
                    @foreach ($correctionDataHistory as $correctionDataHistoryShows)
                    
                        <tr>
                        <td>{{ $loop->iteration }}</td>
                            <td>{{ $correctionDataHistoryShows['ID']}}</td>
                            <td>{{ \Carbon\Carbon::parse($correctionDataHistoryShows['SubmitDate'])->format('d-m-Y') }}</td>
              
                            <td >
                            @if ($correctionDataHistoryShows['Status']=='1')
                              <b class="text-success">Completed</b>
                              @elseif ($correctionDataHistoryShows['Status']=='0')
                              <b class="text-primary">In Process</b>
                              @elseif ($correctionDataHistoryShows['Status']=='2')
                              <b class="text-danger">Rejected</b>
                              due to: <b class="text-danger">{{ $correctionDataHistoryShows['Remarks']}}</b>
                              @else
                              <b class="text-danger">--</b>
                            @endif  
                           </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center text-danger">---No Record---</td>
                    </tr>
                    @endif
                    </tbody>
                  </table>
                        </div>   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('footer')
</div>

@include('script')
