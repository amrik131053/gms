@include ('css')
<div class="page">
    @include('header')

    <div class="container-xl">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-status-top bg-primary"></div>
                <div class="card-header">
                    <h4 class="card-title">All Documents</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
                        <div id="table-default" class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>SrNo</th>
                                            <th>Documents Required</th>
                                            <th>View</th>
                                            <th width="300px;">File</th>
                                            <!-- <th>View</th> -->
                                        </tr>
                                    </thead>
                                    <tbody class="table-tbody">
                                        @if (!empty($documentsList))
                                        @foreach ($documentsList as $showDocumentLitst)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $showDocumentLitst['DocumentsRequired'] }}</td>

                                            <td>
                                                @if (!empty($showDocumentLitst['Original']))
                                                <a href="{{ asset('http://erp.gku.ac.in:86/StudentDocument/' . $showDocumentLitst['Original']) }}"
                                                    target="_blank" class="btn btn-warning btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg>&nbsp;Preview
                                                </a>
                                                @if($showDocumentLitst['Action']==2)
                                                <b class="text-danger">&nbsp;Rejected </b>
                                                <b>Due to: </b><small>{{ $showDocumentLitst['Remarks'] }}</small>

                                                @endif


                                                @else
                                                <span class="text-muted"></span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($showDocumentLitst['Action']==0 || $showDocumentLitst['Action']==2)
                                                <form action="{{ route('documentupload') }}" method="POST"
                                                    enctype="multipart/form-data"
                                                    class="d-flex align-items-center w-100">
                                                    @csrf
                                                    <input type="hidden" name="DocumentType"
                                                        value="{{ $showDocumentLitst['SerialNo'] }}">
                                                    <input type="hidden" name="IDNo"
                                                        value="{{ $showDocumentLitst['IDNo'] }}">
                                                    <input type="file" class="form-control form-control-sm me-2"
                                                        name="document" style="max-width: 250px;">
                                                    <button type="submit" class="btn btn-success btn-sm">Upload</button>
                                                </form>
                                                @elseif($showDocumentLitst['Action']==1)
                                                <b class="text-success">Documents Verified</b>
                                                @else
                                                <b class="text-danger">Rejected</b>
                                                {{ $showDocumentLitst['Remarks'] }}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="7" class="text-danger text-center">---No Record---</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
@include('footer')
</div>
@include('script')