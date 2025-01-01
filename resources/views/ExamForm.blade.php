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
               
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="card-header">
                        <h4 class="card-title">Exam Form</h4>
                    </div>
                    
                    <input type="hidden" id="typeForm" name="typeForm" value="{{$DataButtonsExam ?? ''}}">
                    <input type="hidden" id="eID" name="eID" value="{{$eID ?? ''}}">
                    <input type="hidden" id="examType" value="{{$DataAfterPermissions['examtype'] ?? ''}}">
                    <input type="hidden" id="examination" value="{{$DataAfterPermissions['examination'] ?? ''}}">

                    <div class="card-body">
                        @if ($DataAfterPermissions['formstatus'] == 2)
                            <b class="text-danger">{{ $DataAfterPermissions['message'] }}</b>
                        @else
                            @if ($DataAfterPermissions['formstatus'] == 1)
                                <b class="text-danger">Examination date Over. Last date was {{ $DataAfterPermissions['enddate'] }}</b>
                            @elseif ($DataAfterPermissions['formstatus'] == 0)


                                <div class="row">
                                <div id="alertContainer">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
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

                                   
                                @if ($DataButtonsExam==0)
                                <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="form-label">Semester</div>
                                            <select class="form-select" id="semID" name="semID" >
                                                <option value="">Select</option>
                                                @foreach ($responseSemester as $showsem)
                                <option value="{{$showsem['SemesterID']}}">{{$showsem['SemesterID']}}</option>
                              @endforeach


                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="form-label">Group</div>
                                            <select class="form-select" id="Group" name="Group">
                                                <option value="">Select</option>
                                                @foreach ($responseGroup as $showgroup)
                                <option value="{{$showgroup['Sgroup']}}">{{$showgroup['Sgroup']}}</option>
                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @elseif ($DataButtonsExam==1) 
                                <div class="col-lg-4">
                                        <div class="mb-4">
                                            <div class="form-label">Semester</div>
                                            <select class="form-select" id="semID" name="semID" >
                                            @foreach(range(1, 20) as $number)
                                                <option value="{{ $number }}">{{ $number }}</option>
                                            @endforeach
                                               
                                            </select>
                                           <input type="hidden"  id="Group" name="Group" value="NA">
                                        </div>
                                    </div>
                                @elseif ($DataButtonsExam==2)   
                                <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="form-label">Semester</div>
                                            <select class="form-select" id="semID" name="semID" >
                                                <option value="">Select</option>
                                                @foreach ($responseSemester as $showsem)
                                <option value="{{$showsem['SemesterID']}}">{{$showsem['SemesterID']}}</option>
                              @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="form-label">Group</div>
                                            <select class="form-select" id="Group" name="Group">
                                                <option value="">Select</option>
                                                @foreach ($responseGroup as $showgroup)
                                <option value="{{$showgroup['Sgroup']}}">{{$showgroup['Sgroup']}}</option>
                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                    

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="form-label">Action</div>
                                            <button type="button" onclick="searchSubjectsForExam();" class="btn btn-primary ms-auto"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>Search</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="col-lg-12 " id="subjectsTableDivForm">
                            
                        </div>
                    </div>
                
            </div>
            <!-- <div id="subjectsTableDiv"></div> -->

            <div class="col-lg-7 col-sm-12">
                <form action="#" method="post" class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Exam Forms</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><button class="table-sort">Course</button></th>
                        <th><button class="table-sort">Sem/Type</button></th>
                        <th><button class="table-sort">Examination</button></th>
                       
                        <th><button class="table-sort">Status</button></th>
                        
                        <th><button class="table-sort">Action</button></th>
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                    @if (!empty($AllExamForms))
                    @foreach ($AllExamForms as $allExamShows)
                        <tr>
                            <td class="sort-session">{{ $allExamShows['Course'] }}</td>
                            <td class="sort-session">{{ $allExamShows['Semesterid'] }}({{$allExamShows['Type']}})</td>
                            <td class="sort-date">{{ $allExamShows['Examination'] }}</td>
                    
                            <td class="sort-date">
                            @if ($allExamShows['Status']=='-1')
                              <b class="text-primary">Forward to Registration Branch</b>
                              @elseif ($allExamShows['Status']=='0')
                              <b class="text-primary">Forward To Department</b>
                              @elseif ($allExamShows['Status']=='1')
                              <b class="text-warning">Forward To Department</b>
                              @elseif ($allExamShows['Status']=='2')
                              <b class="text-danger">Reject By Department</b>
                              @elseif ($allExamShows['Status']=='3')
                              <b class="text-danger">Reject By Dean</b>
                              @elseif ($allExamShows['Status']=='4')
                              <b class="text-warning">Forward To Account</b>
                              @elseif ($allExamShows['Status']=='5')
                              <b class="text-warning">Forward To Examination</b>
                              @elseif ($allExamShows['Status']=='6')
                              <b class="text-danger">Rejected By Account</b>
                              @elseif ($allExamShows['Status']=='7')
                              <b class="text-danger">Rejected By Examination</b>
                              
                              @else
                              <b class="text-success">Accepted</b>
                            @endif  
                           </td>
                            
                            <td class="sort-transaction">
                            <svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#modal-view-examForms" onclick="viewExamForm({{ $allExamShows['ID'] }});" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                  <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                </svg>     </td>
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
