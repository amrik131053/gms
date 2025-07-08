@include ('css')
    <div class="page">
 @include('header')

       <div class="container-xl">
            <div class="row justify-content-center">
              <div class="col-lg-8 col-sm-12">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                Payment Successful
            </div>
            <div class="card-body">
                <p><strong>Transaction ID:</strong> {{ $txnid }}</p>
                <p><strong>PayU Payment ID:</strong> {{ $mihpayid }}</p>
                <p><strong>Amount:</strong> ₹{{ $amount }}</p>
                
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
      @include('footer')
    </div>
@include('script')


