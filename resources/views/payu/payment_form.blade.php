@include ('css')
<div class="page">
    @include('header')

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


                            <div class="form-label">Fee Type</div>
                            <select name="fee_type" class="form-control" id="fee_type" required>
                                <option value="">Select Fee Type</option>
                                @foreach ($dropDownHead as $dropDownHeadValue)
                                <option value="{{$dropDownHeadValue['Head']}}">{{$dropDownHeadValue['Head']}}</option>
                                @endforeach
                            </select>

                            <div class="form-label">Semester</div>
                            <select name="semester" class="form-control" id="semester" required>
                                <option value="">Select Semester</option>
                                @for ($i = 1; $i <= 12; $i++)
                                 <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                            </select>


                            <div class="form-label">Amount</div>
                            <input type="number" class="form-control" name="amount" id="amount" required>

                            <div class="form-label">Remarks</div>
                            <textarea name="remarks" class="form-control" id="remarks" rows="3"></textarea>
                            <div class="form-label"></div>
                            <button type="submit" class="btn btn-success">Submit</button>
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
                    <div class="row">
                        <div id="table-default" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <!-- <tr>
                        <th><button class="table-sort">Session</button></th>
                        <th><button class="table-sort">Route</button></th>
                        <th><button class="table-sort">Spot</button></th>
                        <th><button class="table-sort">Submit Date</button></th>
                        <th><button class="table-sort">Status</button></th>
                        
                        <th><button class="table-sort">Action</button></th>
                      </tr> -->
                                </thead>
                                <tbody class="table-tbody">

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