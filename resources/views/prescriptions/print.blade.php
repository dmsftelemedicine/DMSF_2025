<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Prescription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }
        .logo-left {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
        }
        .logo-right {
            position: absolute;
            right: 0;
            top: 0;
            width: 80px;
        }
        .info-table {
            width: 100%;
            margin-top: 20px;
        }
        .prescription-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .prescription-table td, .prescription-table th {
            border: 1px solid white;
            padding: 5px;
            vertical-align: top;
        }
        .col-index {
            width: 10%;
            text-align: center;
        }
        .col-name {
            width: 80%;
            word-wrap: break-word;
            word-break: break-all;
        }
        .col-qty {
            width: 20%;
            text-align: center;
        }
        .footer {
            margin-top: 50px;
            width: 100%;
        }
        .doctor {
            float: right;
            text-align: right;
        }
        .date {
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/dmsf_logo_transparent.png') }}" class="logo-left">
        <img src="{{ public_path('images/system_logo.png') }}" class="logo-right">

        <h3>DAVAO MEDICAL SCHOOL FOUNDATION, INC.</h3>
        <p>Medical School Drive, Bajada, Davao City<br>
        Tel No.: (082) 225-7278</p>
        <h4>PRESCRYB Project</h4>
        <p class="date">DATE: {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
    </div>
    <hr>
    <table class="info-table">
        <tr>
            <td><strong>NAME:</strong> {{ $prescription->patient->last_name }}, {{ $prescription->patient->first_name }} {{ $prescription->patient->middle_name }} </td>
        </tr>
        <tr>
            <td><strong>AGE/SEX:</strong> {{ $prescription->patient->age }} / {{ $prescription->patient->gender }}</td>
        </tr>
    </table>
    <br/><br/>
    <span style="font-size: 3rem;">Rx</span>
    <table class="prescription-table">
       <!--  <thead>
            <tr>
                <th class="col-index">#</th>
                <th class="col-name">Medicine Name / Sig</th>
                <th class="col-qty">Qty</th>
            </tr>
        </thead> -->
        <tbody>
            @foreach ($prescription->details as $index => $detail)
                <tr>
                    <td class="col-index">{{ $index + 1 }}</td>
                    <td class="col-name">
                        <strong>{{ $detail->medicine->name }}</strong><br>
                        <!-- Sig. {{ $detail->medicine->dosage }} -->
                    </td>
                    <!-- <td class="col-qty">#{{ $detail->medicine->quantity }}</td> -->
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="footer">
        <div class="doctor">
           <div style="text-align: right; margin-top: 50px;">
            <img src="{{ public_path('images/esignature.png') }}" style="width: 150px; height: auto;">
            <div style="font-weight: bold;">Dr. {{ $prescription->doctor_name }}</div>
        </div>
            School Clinic Physician<br>
            License No.: 0152234</p>
        </div>
    </div>

</body>
</html>
