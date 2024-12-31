<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #dff0d8;
            color: #3c763d;
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
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    
    <h2>Payment Successful</h2>
<p>Transaction ID: {{ $payment->txnid }}</p>
<p>Amount: ₹{{ $payment->amount }}</p>
<p>Status: {{ $payment->status }}</p>

    <p>Thank you for your payment! Your transaction was successful.</p>
    <a href="/" class="button">Go to Home</a>
</body>
</html>
