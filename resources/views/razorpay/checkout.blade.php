<form id="razorpay-form" action="https://payment.gku.ac.in/api/razorpay/payment-response-web-razorpay" method="POST">
    @csrf 
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    <input type="hidden" name="semester" value="{{ $semester }}">
    <input type="hidden" name="remarks" value="{{ $remarks }}">
    <input type="hidden" name="idno" value="{{ $idno }}">
    <input type="hidden" name="name" value="{{ $name }}">
    <input type="hidden" name="requestid" value="{{ $requestid }}">
</form>
<button id="rzp-button1" style='display:none'></button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ env('RAZORPAY_KEY') }}",
        "amount": "{{ $amount }}", // in paise
        "currency": "INR",
        "name": "Guru Kashi University",
        "description": "{{ $productinfo }}",
        "image": "{{ asset('admin/img/logo-login.png') }}",
        "order_id": "{{ $order_id }}", // MUST be valid
        "handler": function (response) {
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
            document.getElementById('razorpay_signature').value = response.razorpay_signature;
            document.getElementById('razorpay-form').submit();
        },
        "prefill": {
            "name": "{{ $name }}",
            "email": "{{ $email }}",
            "contact": "{{ $phone }}"
        },
        "modal": {
            "ondismiss": function () {
                window.location.href = "{{ url('/payu/form') }}";
            }
        }
    };
    var rzp1 = new Razorpay(options);
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    };
    window.onload = function () {
        document.getElementById('rzp-button1').click();
    };
</script>


