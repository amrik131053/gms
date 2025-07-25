@include ('css')
<div class="page">
    @include('header')
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-12">
                <form action="{{ route('payu.initiate') }}" method="POST" class="card">
                    @csrf
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="card-header">
                        <h4 class="card-title">Confirmation Payment
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

                            <div class="form-group">
                                <input type="hidden" class="form-control" name="idno" id="idno"
                                    value="{{ Crypt::encrypt($details['IDNo']) }}" required>
                                <input type="hidden" class="form-control" name="semester" id="semester" value="0"
                                    required>
                                <div class="form-label">Student Name</div>
                                <input type="text" class="form-control" name="firstname" id="student_name"
                                    value="{{ $details['StudentName'] }}" readonly required>
                                <input type="hidden" class="form-control" name="productinfo" id="productinfo"
                                    value="Document Fee" required>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Father Name</div>
                                <input type="text" class="form-control" name="father_name" id="father_name"
                                    value="{{ $details['FatherName'] }}" readonly required>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Mobile No</div>
                                <input type="mobile" class="form-control" name="phone" id="mobile"
                                    value="{{ $details['StudentMobileNo'] }}" readonly required>
                            </div>
                            <div class="form-group">
                                <div class="form-label">Email</div>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ $details['EmailID'] }}" readonly required>
                            </div>
                            <div class="form-group">

                                <div class="form-group">
                                    <div class="form-label">Amount</div>

                                    <input type="hidden" class="form-control" name="requestid" id="requestid"
                                        value="{{ Crypt::encrypt($submit_details['Id']) }}" readonly required>
                                    <input type="text" class="form-control" name="amount" id="amount"
                                        value="{{ $submit_details['TotalAmount'] }}" readonly required>
                                </div>
                                <div class="form-group">
                                    <div class="form-label">Remarks</div>
                                    <textarea name="remarks" class="form-control" id="remarks"
                                        readonly>{{ $submit_details['AppliedDoc'] }}</textarea>
                                </div>
                                <div class="form-label"><br></div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Confirm and Pay</button>

                                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@include('footer')
</div>
@include('script')