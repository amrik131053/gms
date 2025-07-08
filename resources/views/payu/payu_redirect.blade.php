<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to PayU...</title>
</head>
<body>
    <p>Redirecting to payment gateway. Please wait...</p>

    <form id="payuForm" action="{{ $payu_url }}" method="POST">
        @foreach($params as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script>
        document.getElementById('payuForm').submit();
    </script>
</body>
</html>
