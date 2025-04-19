<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
   
        }
        .container {
            width: 100%;
            margin: auto;
        }
        .header {
            text-align: center;
            /* margin-bottom: 5px; */
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header h1 {
            font-size: 20px;
            /* margin: 5px 0; */
        }
        .header h2 {
            font-size: 12px;
            /* padding: 2px; */
        }
        .admit-card-info, .subjects-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .admit-card-info td {
            padding: 1px;
        }
        .admit-card-info td:first-child {
            font-weight: bold;
        }
        .subjects-table th, .subjects-table td {
            border: 2px solid #000;
            text-align: center;
            padding: 2px;
            
        }
        .basic-table th, .basic-table td {
            border: 2px solid #000;
            text-align: left;
            border-collapse: collapse;
            padding: 0px;
        }
        .footer {
            margin-top: 20px;
        }
        .footer p {
            font-size: 12px;
            margin: 5px 0;
        }
        .signature {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .signature div {
            text-align: left;
        }
    </style>
    <style>
    .signature-table {
        border-bottom: 2px solid #000;
        border-collapse: collapse;
    }
    .signature-table td {
        padding: 5px;   
    }
</style>
</head>
<body>
<div class="container">

    <table class="subjects-table">
    <tr>
            <td colspan="5" style="text-align: left; width: 100%;">
                <img src="admin/img/logo-join.png" alt="Left Logo" width="100%" height="70">
            </td>
        </tr>
    <tr>
            <td colspan="5" style="text-align: center; width: 100%;">
                <div class="header">
                    <h2>ADMIT CARD FOR (<strong>{{ $data['Examination'] }}</strong>) EXAMINATION</h2>
                    <!-- <p>{{ $data['UniRollNo'] }}</p> -->
                </div>
            </td>
        </tr>
        <tr>
            <td rowspan="4" style="text-align: left; width: 15%;text-align: center;font-size:10px;margin:0px;">
                <span>Affix the latest photo of the candidate here,<br> duly attested by the college/department dean with a stamp.
</span>
            </td>
            <td colspan="2" style="text-align: left; width: 35%;"><b>&nbsp;Name:</b> {{ $data['StudentName'] }}</td>
            <td colspan="1" style="text-align: left; width: 35%;"><b>&nbsp;Roll No:</b> {{ $data['UniRollNo'] }}</td>
            <td rowspan="4" style="text-align: center; width: 15%;">
                <img src="{{ isset($data['Image']) ? 'http://erp.gku.ac.in:86/Images/Students/'.$data['Image'] : 'default-image-url.jpg' }}" 
                    width="90" 
                    height="100" 
                    alt="Student Image" 
                    >
            </td>

        </tr>
        <tr>
            <td colspan="2" style="text-align: left; "><b>&nbsp;Father Name:</b> {{ $data['FatherName'] }}</td>
            <td colspan="1" style="text-align: left; "><b>&nbsp;Mother Name:</b> {{ $data['MotherName'] }}</td>
        </tr>
        <tr>
            <td colspan="2 " style="text-align: left; "><b>&nbsp;Semester:</b> {{ $data['Semester'] }}({{ $data['Type'] }})  {{ $data['Batch'] }}</td>
            <!-- <td colspan="1" style="text-align: left;"><b>&nbsp;Batch:</b> {{ $data['Batch'] }}</td> -->
            <td colspan="1" style="text-align: left;"><b>&nbsp;ABC ID:</b> {{ $data['ABCID'] }}</td>
        </tr>
        <tr>
            <td colspan="3 " style="text-align: left; "><b>&nbsp;Course:</b> {{ $data['Course'] }}</td>
            <!-- <td colspan="1" style="text-align: left;"><b>&nbsp;Batch:</b> {{ $data['Batch'] }}</td> -->
            <!-- <td colspan="1" style="text-align: left;"><b>&nbsp;IDNo:</b> {{ $data['IDNo'] }}</td> -->
        </tr>
    </table>
<!-- <center><b style="font-size:12px;padding:0px;">Subjects in which appearing</b></center> -->
    <table class="subjects-table">
        <thead>
        <tr>
            <th>Sr No</th>
            <th>Subject Name / Subject Code</th>
            <th>External</th>
            <th>T/P</th>
            <th>Sign. of Invigilator</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data['SubjectsResult'] as $index => $subject)
    @if ($subject['ExternalExam'] == 'Y')
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $subject['SubjectName'] }} / {{ $subject['SubjectCode'] }}</td>
            <td>{{ $subject['ExternalExam'] }}</td>
            <td>{{ $subject['SubjectType'] }}</td>
            <td></td>
        </tr>
    @endif
@endforeach
        </tbody>
    </table>
 <table class="subjects-table">
        <tr>
            <td colspan="5" style="text-align: justify;">I have read all the regulations and it's amendments in regard to examination. I found myself eligible to appear in examination. In case university declare me
ineligible due to any wrong information submitted in examination form by me, i shall be responsible for its consequences.<br><span><b>Note:</b> Check your Name, Father's Name, Mother's Name, and ABC ID carefully.
If you find any discrepancy, contact the Registration Branch at the earliest.</span>  </td>      
</tr>
<tr>
<td colspan="3" style="text-align: left; vertical-align: middle; padding: 10px;">
    <div style="display: flex; align-items: center; gap: 10px;">
        <strong style="white-space: nowrap;">Candidate Sign:</strong>
        @if($data['SignaturePath'] != '')
            <img src="{{ 'http://erp.gku.ac.in:86/Images/Signature/'.$data['SignaturePath'] }}" 
                 alt="Signature" 
                 style="height: 40px; width: 150px; padding: 2px;">
        @else
            <span style="color: red;"></span>
        @endif
    </div>
</td>


           <td colspan="2"><b>Date: {{$data['SubmitFormDate']}}</b></td>
        </tr>
    </table>
    

    <table class="subjects-table">
        
        <tr>
            <td colspan="5" style="text-align: justify;">Certified that the Candidate has completed the prescribed course of study and fulfilled all the conditions laid down in tne regulations for the examinations
and is eligible to appear in the examination as a regular student of Guru Kashi University. The candidate bears a good moral character and particulars filled
by him/her are correct. Nothing is due to towards this student</td>
           
        </tr>
        
       
    </table>
 <br><br>
    <table class="signature-table" style="text-align: center; width: 100%;">
    <tr>
    <th style="text-align: left; width: 33%;"></th>
        <th style="text-align: center; width: 33%;"></th>
        <th style="text-align: right; width: 33%;" >
        <img src="admin/img/examcontrollor.png" alt="Left Logo" width="180" height="50">
</th>
    </tr>
    <tr>
        <th style="text-align: left; width: 33%;">Dean/HOD</th>
        <th style="text-align: center; width: 33%;">&nbsp;</th>
        
    </th>
    <th style="text-align: right; width: 33%;">
       
        Controller of Examination</th>
    </tr>
</table>

</div>
</body>
</html>
