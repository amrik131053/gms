<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <style>
                    *{
                        margin: 0;
                        padding: 0;
                        font-family: arial, sans-serif;
                    }
                    .layout{
                        margin-top:24px;
                    }
                    .logo{
                        height: 70px;
                        width: 70px;
                    }
                    .topOfPage{
                        display: flex;
                        align-items: center;
                        flex-direction: column;
                    }
                    .heading{
                        font-size: 20px;
                        font-weight: 600;
                    }.heading2{
                        font-size: 12px;
                        margin-top: 4px;
                    }.establishment{
                        font-size: 12px;
                        margin-top: 4px;
                    }.tableOuter{
                        padding: 0 20px;
                    }
                    table {
                        border:1px solid black;
                        border-collapse:collapse;
                        padding:5px;
                        width:100%;
                        margin: 16px 0px;
                        background-color: transparent;
                    }
                    table th {
                        border:1px solid black;
                        text-align:center;
                        padding:5px;
                        background: #ffffff;
                        color: black;
                        font-size: 14px;
                        font-weight: 600;
                        background-color: transparent;
                    }
                    table td {
                        border:1px solid black;
                        text-align:left;
                        padding:5px;
                        background: #ffffff;
                        color: black;
                        font-size: 14px;
                        font-weight: 600;
                        background-color: transparent;
                    }
                    .bottomTable td{
                        text-align: center;
                        font-weight: 400;
                        margin-bottom: 16px;
                    }
                    .watermark::after{
                        content: 'Internet Result Copy';
                        transform: rotate(340deg);
                        font-size: 100px;
                        z-index: -1;
                        position: absolute;
                        top: 320px;
                        opacity: 0.2;
                        text-align: center;
                    }
                    
                </style>
       </head>
            <body>
                <div class="layout">
                    <center>
                    <div class="topOfPage">
                    <img class="logo" src="admin/img/logo-login.png" alt="uniLogo">
                        <p class="heading">GURU KASHI UNIVERSITY</p>
                        <h4 class="heading2">TALWANDI SABO BATHINDA,PUNJAB -151302</h4>
                        <p class="establishment">(Established by Government of Punjab Act No. 37 of 2011 as per Section 2(f) of UGC Act. 1956)</p>
                        <h4 class="heading2">(Internet Result Copy)</h4>
                    </div>
                   </center>
                    <div class="tableOuter watermark">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Roll No.:   {{$UniRollNo}}</td>
                                    <td>Name: {{$StudentName}}</td>
                                </tr>
                                <tr>
                                    <td>Father's Name: {{$FatherName}}</td>
                                    <td>Course: {{$Course}}</td>
                                </tr>
                                <tr>
                                    <td>Semester: {{$Semester}}</td>
                                    <td>Examination: {{$Examination}} ({{$Type}}@if($DeclareType!='') {{ $DeclareType }} @endif)  </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="bottomTable">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">Sr. No. </th>
                                    <th style="width: 50%;">Subjects/Subject Code</th>
                                    <th style="width: 20%;">Grade(Total)</th>
                                    <th style="width: 20%;">SGPA</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($SubjectsResult as $row)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $row['SubjectName'] }}/{{ $row['SubjectCode'] }}</td>
        <td>{{ $row['SubjectGradePoint'] }}</td>
        <td>{{ $row['SubjectGrade'] }}</td>
    </tr>
@endforeach

                    <tr>
                        <td colspan="2" style="font-weight: 600;">Total Number of Credit: {{$TotalCredit}}</td>
                        <td colspan="2" style="font-weight: 600;">SGPA: {{$Sgpa}}</td>
                    </tr>
                </tbody>
                        </table>
                        <p>Declare date : {{$DeclareDate}}</p>
                    </div>
                </div>
            </body>
            </html>