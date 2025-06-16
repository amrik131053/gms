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
                    <h4 class="card-title">Apply Leave</h4>
                </div>

                <div class="card-body">
                    <form id="smartCardForm" action="{{ url('submitHostelLeaveData') }}" method="POST"
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

                        <div class="col-lg-12 col-md-12 col-12">
                            <label class="form-label">Start Date<small class="text-red">*</small></label>
                            <input type="date" class="form-control" name="startDate" id="startDate">

                            <label class="form-label">End Date<small class="text-red">*</small></label>
                            <input type="date" class="form-control" name="endDate" id="endDate">

                        </div>



                        <div class="col-md-12 mb-12">
                            <label for="mother_name" class="form-label">Remakrs<small class="text-red">*</small></label>
                            <textarea name="application_subject" class="form-control"
                                placeholder="Write Remakrs Here (ਕਿਸੇ ਵੀ ਭਾਸ਼ਾ ਵਿੱਚ ਟਾਈਪ ਕਰੋ)"
                                id="remarks">{{ old('application_subject') }}</textarea>

                        </div>




                        <!-- <div class="col-md-12 mb-12">
                            <label for="fileName" class="form-label">Attachment File(Optional)</label>
                            <input type="file" name="application_file" id="fileName" class="form-control">
                        </div> -->


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
            <div class="col-lg-7 col-sm-12">
                <form action="#" method="post" class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">All Leaves</h4>
                    </div>


                    <div class="card-body">
                        <div class="row">
                            <div id="trackedApplicationShow" class="table table-borderless">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-tbody">
                                        @php $srNo = 1; @endphp
                                        @foreach ($leaveHistory as $index => $showleaveHistory)
                                        @php
                                        $truncated = Str::limit($showleaveHistory['remarks'], 40); // Show 30 characters
                                        $fullText = $showleaveHistory['remarks'];
                                        @endphp
                                        <tr>
                                            <td>{{ $srNo++ }}</td>
                                            <td>{{ \Carbon\Carbon::parse($showleaveHistory['start_date'])->format('d-m-Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($showleaveHistory['end_date'])->format('d-m-Y') }}
                                            </td>
                                            <td class="sort-date">
                                                <span id="short-{{ $index }}">{{ $truncated }}
                                                    @if(strlen($fullText) > 40)
                                                    <a href="javascript:void(0);"
                                                        onclick="toggleRemark({{ $index }})">More</a>
                                                    @endif
                                                </span>
                                                <span id="full-{{ $index }}" style="display:none;">
                                                    {{ $fullText }}
                                                    <a href="javascript:void(0);"
                                                        onclick="toggleRemark({{ $index }})">Less</a>
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
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
<script>
function toggleRemark(index) {
    const shortSpan = document.getElementById('short-' + index);
    const fullSpan = document.getElementById('full-' + index);
    if (shortSpan.style.display === 'none') {
        shortSpan.style.display = 'inline';
        fullSpan.style.display = 'none';
    } else {
        shortSpan.style.display = 'none';
        fullSpan.style.display = 'inline';
    }
}
</script>


@include('script')