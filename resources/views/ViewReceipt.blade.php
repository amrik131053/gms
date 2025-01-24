<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            /* padding: 20px; */
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header img {
            width: 70px;
            height: auto;
            padding-top:-200px;
            position: relative;
        }

        .header h5 {
            margin-top: -50;
            font-size: 1.25rem;
            line-height: 1.2;
            text-align: center;
            flex: 1;

        }

        .header small {
            display: block;
            font-size: 0.9rem;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .details td {
            padding: 5px;
            font-size: 12px;
        }

        .table table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .table th, .table td {
            padding: 8px;
            font-size: 12px;
            border: 1px solid #000;
        }

        .table th {
            text-align: left;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
        }

        .footer .cashier {
            float: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="admin/img/applogo.png" alt="University Logo" >
        <h5>Guru Kashi University<br><small>{{$CollegeName;}}</small></h5>
        <div style="width: 70px;"></div> <!-- Placeholder to balance the flex alignment -->
    </div>

    <div class="details">
       <table>
            <tr>
                <td colspan="3" ><strong>Receipt No: {{$ReceiptNo;}}</strong></td>
                <td colspan="1"style="text-align:right;"><strong >Date: {{ \Carbon\Carbon::parse($DateEntry)->format('d-m-Y') }}</strong></td>
            </tr>
            <tr>
              <td><strong>Received From:</strong></td>
                <td colspan="3" style="border-bottom:1.5pt solid black;"><strong><span> {{$StudentName}} {{$genderDSo}} {{$FatherName}}, Mrs.</span></strong></td>
            </tr>
            <tr>
              <td><strong>Course:</strong></td>
                <td style="border-bottom:1.5pt solid black;"><strong><span> {{$Course;}}</span></strong></td>
                <td><strong>Batch:</strong></td>
                <td style="border-bottom:1.5pt solid black;"><strong><span> {{$Batch}}</span></strong></td>
            </tr>
            <tr>
                <td><strong>Class Roll No:</strong></td>
                <td style="border-bottom:1.5pt solid black;"><strong><span> {{$ClassRollNo}}</span></strong></td>
                <td><strong>ID/Reg. No: </strong></td>
               <td style="border-bottom:1.5pt solid black;"><strong><span>{{$IDNo}}</span></strong></td>
            </tr>
            <tr>
              <td><strong>On Account of:</strong></td>
                <td style="border-bottom:1.5pt solid black;"><strong><span>{{$OnAccountof}}</span></strong></td>
                <td><strong>Uni Roll No:</strong></td>
                <td style="border-bottom:1.5pt solid black;"><strong><span>{{$UniRollNo}}</span></strong></td>
            </tr>
        </table>
    </div>

    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>S. No.</th>
                    <th>Particulars</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>1</th>
                    @if ($ModeOfPayment!='Cash')
                    <th>
                        
                        Cheque/draft no.: <span style="border-bottom:1.5pt solid black;">{{$ChequeDraftNo}}</span><br>
                        Date: <span style="border-bottom:1.5pt solid black;">{{$ChequeDraftDate}}</span><br>
                        Bank: <span style="border-bottom:1.5pt solid black;">{{$ChequeDraftBank}}</span>
                            
                    </th>
                    @else
                    <th>
                        ______________________________________________________________
    </th>
                    @endif
                    <th>{{$credit}}</th>
                </tr>
                <tr>
                    <th colspan="2"><strong style="float:right;">Total:</strong></th>
                    <th><strong>{{$credit}}</strong></th>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <div>
            <strong>Received Rs. <span style="border-bottom:1.5pt dotted black;">{{$amountInWords}} <strong>By</strong> ({{$ModeOfPayment}})</span></strong>
        </div>
       
    </div>
</div>

</body>
</html>
