<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medical Certificate</title>
    <style>
        @page {
            size: A5 landscape; 
            margin: 0;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 11pt;
            position: relative;
            padding: 0;
            margin: 0;
            line-height: 1;
        }

        .certificate-page {
            padding: 25px 45px;
            box-sizing: border-box;
        }

        .header {
            display: flex;
            justify-items: center;
            align-items: center;
            padding-bottom: 8px;
            position: relative; 
        }

        .logo {
            width: 65px;
            height: 65px;
            flex-shrink: 0;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-text {
            width: 400px;
            flex: 1;
            text-align: center;
        }

        .header-text h2 {
            margin: 0;
            font-size: 13pt;
            font-weight: bold;
            letter-spacing: 1px;
            line-height: 1;
        }

        .header-text h3 {
            margin: 2px 0;
            font-size: 11pt;
            font-weight: bold;
            line-height: 1;
        }

        .header-text h1 {
            margin: 6px 0 0 0;
            font-size: 15pt;
            font-weight: bold;
            letter-spacing: 2px;
            line-height: 1;
        }

        .date-box {
            width: 110px;
            text-align: center;
            flex-shrink: 0;
        }

        .date-value {
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            margin-bottom: 2px;
            font-size: 10pt;
            line-height: 1;
        }

        .date-label {
            font-size: 9pt;
            line-height: 1;
        }

        .to-whom {
            font-weight: bold;
            margin: 8px 0 6px 0;
            font-size: 10pt;
            line-height: 1;
        }

        .cert-body {
            margin-left: 70px;
            line-height: 1.2;
            font-size: 10pt;
        }

        .cert-body p {
            margin: 4px 0;
            line-height: 1.2;
        }

        .field-value {
            display: inline-block;
            border-bottom: 1px solid #000;
            min-width: 250px;
            text-align: center;
            font-weight: bold;
            padding: 0 8px 1px 8px;
        }

        .field-value.age {
            min-width: 35px;
            width: 35px;
        }

        .field-value.address {
            min-width: 320px;
        }

        .field-value.date {
            min-width: 100px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 8px;
            margin-bottom: 2px;
            font-size: 10pt;
            line-height: 1;
        }

        .section-content {
            border-bottom: 1px solid #000;
            min-height: 14px;
            margin-bottom: 3px;
            padding: 0;
            font-size: 9pt;
            line-height: 1.1;
        }

        .signature-section {
            margin-top: 15px;
            text-align: right;
            padding-right: 25px;
        }

        .signature-box {
            display: inline-block;
            text-align: center;
        }

        .signature-line {
            min-width: 160px;
            margin-bottom: 2px;
            padding-bottom: 1px;
            font-size: 9pt;
            line-height: 1;
        }

        .credentials {
            text-align: left;
            margin-top: 4px;
            font-size: 8pt;
            line-height: 1.1;
        }

        .credential-row {
            margin: 0;
            line-height: 1.1;
        }

        .credential-label {
            display: inline-block;
            width: 65px;
        }

        .credential-value {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 90px;
        }
    </style>
</head>

<body>
    <div class="certificate-page">
        <div class="header">
            <div class="logo">
                <img src="{{ public_path('images/dmsf_logo_transparent.png') }}" alt="DMSF Logo">
            </div>

            <div class="header-text">
                <h2>DAVAO MEDICAL SCHOOL FOUNDATION</h2>
                <h3>DAVAO CITY</h3>
                <h1>MEDICAL CERTIFICATE</h1>
            </div>

            <div class="date-box">
                <div class="date-value">{{ \Carbon\Carbon::parse($certificate->date_issued)->format('F j, Y') }}</div>
                <div class="date-label">Date</div>
            </div>
        </div>

        <div class="to-whom">TO WHOM IT MAY CONCERN:</div>

        <div class="cert-body">
            <p style="text-indent: 0; margin: 0;">
                This is to certify that 
                <span class="field-value">{{ $certificate->patient->first_name }} {{ $certificate->patient->middle_name }} {{ $certificate->patient->last_name }}</span>, 
                <span class="field-value age">{{ $certificate->patient->age ?? '' }}</span> years old
            </p>
            <p style="margin: 5px 0 0 0;">
                of <span class="field-value address">{{ $certificate->patient_address ?? $certificate->patient->address ?? '' }}</span> has been treated/examined last 
                <span class="field-value date">{{ \Carbon\Carbon::parse($certificate->date_issued)->format('m-d-Y') }}</span>
            </p>

            <div class="section-title">DIAGNOSIS:</div>
            <div class="section-content">{{ $certificate->medical_findings ?? '' }}</div>
            <div class="section-content">&nbsp;</div>

            <div class="section-title">REMARKS:</div>
            <div class="section-content">{{ $certificate->recommendations ?? '' }}</div>
            <div class="section-content">&nbsp;</div>
            <div class="section-content">&nbsp;</div>
        </div>

        <div class="signature-section">
            <div class="signature-box">
                <div style="position: relative; min-height: 40px;">
                    @if($certificate->createdBy && $certificate->createdBy->signature_path)
                        <img src="{{ public_path('storage/' . $certificate->createdBy->signature_path) }}" 
                             style="position: absolute; top: -30px; left: 50%; transform: translateX(-50%); width: 110px; height: auto; z-index: 1;" />
                    @endif
                    <div style="position: relative; z-index: 0; border-bottom: 1px solid #000; min-width: 160px; padding-bottom: 1px; font-size: 9pt; display: inline-block;">
                        {{ $certificate->createdBy->display_name ?? $certificate->createdBy->name ?? $certificate->issuing_doctor ?? 'N/A' }}
                    </div>
                </div>
                <div style="font-size: 8pt; margin-top: 2px;">Physician</div>
            </div>

            <div class="credentials">
                <div class="credential-row">
                    <span class="credential-label">License No.</span>
                    <span class="credential-value">
                        {{ $certificate->createdBy->license_number ?? $certificate->license_number ?? 'N/A' }}
                    </span>
                </div>
                <div class="credential-row">
                    <span class="credential-label">PTR No.</span>
                    <span class="credential-value">
                        {{ $certificate->ptr_number ?? 'N/A' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>