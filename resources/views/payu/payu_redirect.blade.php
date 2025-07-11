<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting to PayU...</title>
</head>
<body>
    <p>Redirecting to PayU. Please wait...</p>

    <form id="payuForm" action="https://test.payu.in/_payment" method="post">
        @foreach ($payuData as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>

    <script>
        document.getElementById('payuForm').submit();
    </script>
</body>
</html>
