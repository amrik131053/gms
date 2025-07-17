@include ('css')
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
            <div class="col-lg-5 col-sm-12">

                <form action="{{ route('payu.confirm-fee', $encryptedId) }}" method="POST" class="card">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="card-header">
                        <h4 class="card-title">Payment Form
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

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


                            <div class="form-label">Fee Type <span class="text-danger">*</span></div>
                            <select name="fee_type" class="form-select" id="fee_type" required>
                                <option value="">Select Fee Type</option>
                                @foreach ($dropDownHead as $dropDownHeadValue)
                                <option value="{{$dropDownHeadValue['Head']}}">{{$dropDownHeadValue['Head']}}</option>
                                @endforeach
                            </select>

                            <div class="form-label">Semester <span class="text-danger">*</span></div>
                            <select name="semester" class="form-select" id="semester" required>
                                <option value="">Select Semester</option>
                                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>


                            <div class="form-label">Amount <span class="text-danger">*</span></div>
                            <input type="number" class="form-control" name="amount" id="amount" required>

                            <div class="form-label">Remarks</div>
                            <textarea name="remarks" class="form-control" id="remarks" rows="3"></textarea>

                            <div class=" card-footer">
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-success">Submit</button>

                                </div>
                            </div>

                        </div>
                </form>

            </div>

        </div>
        <div class="col-lg-7 col-sm-12">
            <form action="" method="post" class="card">
                <div class="card-header">
                    <h4 class="card-title">Payment history</h4>
                </div>
                <div class="card-body">
                <b class="text-danger">Important:</b>  <small class="text-danger">If you see that the payment amount has been deducted from your bank account but you have not received your receipt, don’t worry. Click the Sync button below to synchronize your transaction and generate your receipt.<br></small>
                    <div class="row">
                        <div id="table-default" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>Paymentdate</th>
                                        <th>Amount</th>
                                        <th>FeeType</th>
                                        <th>sem</th>
                                        <!-- <th>Remarks</th> -->
                                        <th>ReeferenceNo</th>
                                        <th>Status</th>
                                    </tr>

                                </thead>
                                <tbody class="table-tbody">
                                    @foreach ($recentTranscations as $recent)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ \Carbon\Carbon::parse($recent['Paymentdate'])->format('d-m-Y') }}</td>
                                        <td>{{ $recent['Amount'] }}</td>
                                        <td>{{ $recent['FeeType'] }}</td>
                                        <td>{{ $recent['sem'] }}</td>
                                        <!-- <td>{{ $recent['Remarks'] }}</td> -->
                                        <td>{{ $recent['mihpayid'] }}</td>
                                        <td>

                                        @if($recent['Status'] != 'success')
                                        <button
                                            type="button"
                                            class="btn btn-primary btn-sm"
                                            onclick="syncFee(`{{ $recent['txnid'] }}`)">
                                            ReSync
                                        </button>
                                        @else
                                        <b class="text-success">{{ $recent['Status'] }}</b>
                                    @endif
                                        </td>

                                      
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
            </form>
        </div>

    </div>
</div>


</div>
@include('footer')
</div>
@include('script')

<script>
function syncFee(encryptedId) {
 
    showLoader();
    fetch("{{ url('sync-fee') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            encryptedId: encryptedId
        })
    })
    .then(response => response.json())
    .then(data => {
        hideLoader();
        console.log(data);
        if (data.status === 'failure') {
            showErrorMessage(data.message);
            // alert(data.message || 'Payment failed!');
        } else if (data.status === 'success') {
            showSuccessMessage(data.message);
            // alert(data.message || 'ReSync successful!');
            location.reload();
        } else {
            showErrorMessage('Unexpected response!');
            // alert('Unexpected response!');
        }
    })
    .catch(error => {
        hideLoader();
        console.error(error);
        showErrorMessage('ReSync failed due to a network or server error!');
        // alert('ReSync failed due to a network or server error!');
    });
}

</script>
