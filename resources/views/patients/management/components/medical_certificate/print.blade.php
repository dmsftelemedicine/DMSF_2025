<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medical Certificate</title>
    <style>
        @page {
            margin: 0px;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            position: relative;
            padding: 40px 60px;
            margin: 0;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100px;
        }

        .header-text {
            text-align: center;
        }

        .header-text h2 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .header-text h3 {
            margin: 5px 0;
            font-size: 12pt;
            font-weight: bold;
        }

        .header-text h1 {
            margin: 15px 0;
            font-size: 16pt;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .date-box {
            position: absolute;
            right: 0;
            top: 0;
            text-align: center;
            width: 150px;
        }

        .date-value {
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
            margin-bottom: 3px;
            font-size: 11pt;
        }

        .date-label {
            font-size: 10pt;
        }

        .to-whom {
            font-weight: bold;
            margin: 30px 0 20px 0;
        }

        .cert-body {
            margin-left: 100px;
            line-height: 1.8;
        }

        .field-value {
            display: inline-block;
            border-bottom: 1px solid #000;
            min-width: 300px;
            text-align: center;
            font-weight: bold;
            padding: 0 10px 2px 10px;
        }

        .field-value.age {
            min-width: 40px;
            width: 40px;
        }

        .field-value.address {
            min-width: 400px;
        }

        .field-value.date {
            min-width: 150px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        .section-content {
            border-bottom: 1px solid #000;
            min-height: 20px;
            margin-bottom: 8px;
            padding: 2px 0;
        }

        .signature-section {
            margin-top: 60px;
            text-align: right;
            padding-right: 50px;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            min-width: 200px;
            margin-bottom: 3px;
            padding-bottom: 2px;
        }

        .credentials {
            text-align: left;
            margin-top: 10px;
            font-size: 10pt;
        }

        .credential-row {
            margin: 3px 0;
        }

        .credential-label {
            display: inline-block;
            width: 80px;
        }

        .credential-value {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 120px;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('images/dmsf_logo_transparent.png') }}" class="logo">

        <div class="date-box">
            <div class="date-value">{{ \Carbon\Carbon::parse($certificate->date_issued)->format('F j, Y') }}</div>
            <div class="date-label">Date</div>
        </div>

        <div class="header-text">
            <h2>DAVAO MEDICAL SCHOOL FOUNDATION</h2>
            <h3>DAVAO CITY</h3>
            <h1>MEDICAL CERTIFICATE</h1>
        </div>
    </div>

    <div class="to-whom">TO WHOM IT MAY CONCERN:</div>

    <div class="cert-body">
        <p style="text-indent: 0;">
            This is to certify that 
            <span class="field-value">{{ $certificate->patient->first_name }} {{ $certificate->patient->middle_name }} {{ $certificate->patient->last_name }}</span>, 
            <span class="field-value age">{{ $certificate->patient->age ?? '' }}</span> years old
        </p>
        <p style="margin-top: 15px;">
            of <span class="field-value address">{{ $certificate->patient_address ?? $certificate->patient->address ?? '' }}</span> has been treated/examined last 
            <span class="field-value date">{{ \Carbon\Carbon::parse($certificate->date_issued)->format('F j, Y') }}</span>
        </p>

        <div class="section-title">DIAGNOSIS:</div>
        <div class="section-content">{{ $certificate->medical_findings ?? '' }}</div>
        <div class="section-content">&nbsp;</div>
        <div class="section-content">&nbsp;</div>

        <div class="section-title">REMARKS:</div>
        <div class="section-content">{{ $certificate->recommendations ?? '' }}</div>
        <div class="section-content">&nbsp;</div>
        <div class="section-content">&nbsp;</div>
        <div class="section-content">&nbsp;</div>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            @if($certificate->createdBy && $certificate->createdBy->signature_path)
                <div style="margin-bottom: 5px;">
                    <img src="{{ public_path('storage/' . $certificate->createdBy->signature_path) }}" style="width: 150px; height: auto;" />
                </div>
            @endif
            <div class="signature-line">{{ $certificate->createdBy->display_name ?? $certificate->createdBy->name ?? $certificate->issuing_doctor ?? 'Test User' }}</div>
            <div style="font-size: 10pt; margin-top: 3px;">Physician</div>
        </div>

        <div class="credentials">
            <div class="credential-row">
                <span class="credential-label">License No.</span>
                <span class="credential-value">
                    {{ $certificate->createdBy->license_number ?? $certificate->license_number ?? '123' }}
                </span>
            </div>
            <div class="credential-row">
                <span class="credential-label">PTR No.</span>
                <span class="credential-value">
                    {{ $certificate->ptr_number ?? '123' }}
                </span>
            </div>
        </div>
    </div>

</body>

</html>