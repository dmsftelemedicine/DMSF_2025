<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }
        .page {
            page-break-after: always;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .header, .footer {
            text-align: center;
        }
        .rx-title {
            font-size: 24pt;
            font-weight: bold;
            margin: 10px 0;
        }
        .medicine-table {
            width: 100%;
            border-collapse: collapse;
        }
        .medicine-table td {
            padding: 4px;
            vertical-align: top;
        }
    </style>
    <style>
        @page {
            margin: 10px;
        }

        body {
            font-family: sans-serif;
            font-size: 10pt;
            background-image: url('{{ public_path("images/pdf-bg.png") }}');
            background-repeat: repeat;
            background-position: center;
            background-size: 350px 350px;
        }

        .page {
            page-break-after: always;
            padding: 10px;
        }

        /* Optional: add white background for text blocks if needed for readability */
        .white-box {
            background: white;
            padding: 10px;
            border-radius: 5px;
        }
    </style>



</head>
<body>
    @php
        $chunks = $prescription->details->chunk(4);
        $patient = $prescription->patient;
    @endphp

    @foreach ($chunks as $index => $chunk)
    <div class="page">
        <table width="100%" style="margin-bottom: 10px;">
            <tr>
                {{-- Left Logo --}}
                <td width="20%" style="text-align: left;">
                    <img src="{{ public_path('images/dmsf_logo_transparent.png') }}" width="60">
                </td>

                {{-- Center Info --}}
                <td width="60%" style="text-align: center;">
                    <strong style="font-size: 12pt;">DAVAO MEDICAL SCHOOL FOUNDATION, INC.</strong><br>
                    <span style="font-size: 10pt;">Medical School Drive, Bajada, Davao City</span><br>
                    <span style="font-size: 10pt;">Tel No: (082) 225-7278</span><br>
                    <strong style="font-size: 10pt;">PRESCRYB Project</strong>
                </td>

                {{-- Right Logo --}}
                <td width="20%" style="text-align: right;">
                    <img src="{{ public_path('images/system_logo.png') }}" width="60">
                </td>
            </tr>
        </table>



        <table width="100%" style="margin-top:10px;">
            <tr>
                <td><strong>NAME:</strong> {{ $prescription->patient->last_name }}, {{ $prescription->patient->first_name }} {{ $prescription->patient->middle_name }}</td>
                <td style="text-align:right;"><strong>DATE:</strong> {{ \Carbon\Carbon::parse($prescription->created_at)->format('F j, Y') }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>AGE/SEX:</strong> {{ $patient->age }} / {{ strtoupper($patient->sex) }}</td>
            </tr>
        </table>

        <div class="rx-title">Rx</div>

        <table class="medicine-table">
            @foreach ($chunk as $i => $detail)
                <tr>
                    <td width="5%">{{ $i + 1 }}</td>
                    <td width="65%">
                        <strong>{{ $detail->medicine->name }}</strong><br>
                        Sig. {{ $detail->medicine->rx_english_instructions }}
                    </td>
                    <td width="10%">#{{ $detail->medicine->quantity ?? '—' }}</td>
                </tr>
            @endforeach
        </table>

        <div class="footer" style="margin-top:30px;">
            <strong>{{ strtoupper('Maria Angelica C. Plata, RN, MD') }}</strong><br>
            School Clinic Physician<br>
            License No.: 0152324
        </div>
    </div>
    @endforeach
</body>
</html>
