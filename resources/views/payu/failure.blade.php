<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f2dede;
            color: #a94442;
        }
        h1 {
            font-size: 2em;
        }
        p {
            font-size: 1.2em;
        }
        .button {
            margin-top: 20px;
            text-decoration: none;
            background-color: #d9534f;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Payment Failed</h1>

<p>Transaction ID: {{ $payment->txnid }}</p>
<p>Amount: ₹{{ $payment->amount }}</p>
<p>Status: {{ $payment->status }}</p>

    <p>Unfortunately, your payment could not be processed.</p>
    <a href="/" class="button">Try Again</a>
</body>
</html>
