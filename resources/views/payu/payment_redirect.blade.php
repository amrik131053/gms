@include ('css')
    <div class="page">
 @include('header')

       <div class="container-xl">
            <div class="row row-cards">
              <div class="col-lg-5 col-sm-12">
                
    <h3>Redirecting to PayU Payment Gateway...</h3>
    <form id="payuForm" method="POST" action="{{ $payuUrl }}">
        @foreach($paymentData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <noscript>
            <p>Please click the submit button to proceed.</p>
            <button type="submit">Submit</button>
        </noscript>
    </form>

    <script>
        // Auto-submit the form to PayU
        document.getElementById('payuForm').submit();
    </script>

</div>
        </div>


      </div>
      @include('footer')
    </div>
@include('script')
