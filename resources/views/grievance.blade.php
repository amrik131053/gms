@include('css')

<div class="page">
    @include('header')
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="tablerToastSuccess" class="toast align-items-center text-bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="tablerToastWarning" class="toast align-items-center text-bg-warning border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="container-xl">
        <div class="row row-cards">


            <div class="col-lg-5 col-sm-12 card">
                <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h4 class="card-title">Complaint Form</h4>
                </div>

                <div class="card-body">
                    <form id="smartCardForm" action="{{ url('submitGrievanceData') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <meta name="csrf-token" content="{{ csrf_token() }}">


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

                        
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="text-start align-top" width="10%">To</th>
                                        <th class="text-start align-top" width="90%"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-start align-top" width="50%"></th>
                                        <td colspan="3" width="50%">
                                            <select name="application_to" id="" class="form-select">
                                                <option value="170976">Sic</option>
                                                <option value="2">Account</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <th colspan="3" class="text-start">
                                            Guru Kashi University<br>
                                            Talwandi Sabo
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                        <div class="col-md-12 mb-12">
                            <label for="mother_name" class="form-label">Subject<small class="text-red">*</small></label>
                            <textarea name="application_subject" class="form-control"
                                placeholder="Write Subject Here (ਕਿਸੇ ਵੀ ਭਾਸ਼ਾ ਵਿੱਚ ਟਾਈਪ ਕਰੋ)"
                                id="remarks">{{ old('application_subject') }}</textarea>
                            @error('application_subject')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-12">
                            <label for="gender" class="form-label">Respected Sir/Madam,<small
                                    class="text-red">*</small></label>
                            <textarea name="application_details" class="form-control"
                                placeholder="Application in Detail (ਕਿਸੇ ਵੀ ਭਾਸ਼ਾ ਵਿੱਚ ਟਾਈਪ ਕਰੋ)"
                                id="remarks">{{ old('application_details') }}</textarea>
                            @error('application_details')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-md-12 mb-12">
                            <label for="fileName" class="form-label">Attachment File(Optional)</label>
                            <input type="file" name="application_file" id="fileName" class="form-control">
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th class="text-start align-top" width="80%">Date:<br>
                                            {{ \Carbon\Carbon::now()->format('d-M-Y') }}

                                        </th>
                                        <th colspan="3" width="20%">
                                            Your Faithfully,<br>
                                            {{$grievanceData['StudentName']}}
                                            UniRollNo:{{$grievanceData['UniRollNo']}}
                                            ClassRollNo:{{$grievanceData['ClassRollNo']}}
                                        </th>
                                    </tr>

                                </tbody>
                            </table>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Application Track</h4>
                        <div class="d-flex align-items-center">
                            <select name="complaint_no" id="complaint_no" class="form-select me-2">
                                @foreach ($dropDownTrak as $dropDownTrakName)
                                <option value="{{$dropDownTrakName['TokenNo']}}">
                                    {{$dropDownTrakName['TokenNo']}}</option>
                                @endforeach
                            </select>
                            <a href="#" onclick="trackComplaint();" class="btn btn-primary d-flex align-items-center">
                             
                                Track Now
                            </a>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="row">
                            <div id="trackedApplicationShow" class="table table-borderless">

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