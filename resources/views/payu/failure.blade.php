@include ('css')
<div class="page">
    @include('header')

    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-12">
                <div class="container py-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-danger text-white">
                            Payment Failed
                        </div>
                        <div class="card-body">
                            <p><strong>Transaction ID:</strong> {{ $txnid }}</p>
                            <p><strong>Status:</strong> {{ $status }}</p>
                            <p><strong>Amount:</strong> ₹{{ $amount }}</p>
                            <p><strong>Error Message:</strong> {{ $error_message }}</p>
                            <!-- <a href="{{ url('/') }}" class="btn btn-danger">Go to Home</a> -->
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