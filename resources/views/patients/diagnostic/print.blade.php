<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Diagnostic Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }
        .bold-text {
            font-weight: bold;
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
        .diagnostic-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .diagnostic-table td, .diagnostic-table th {
            border: 1px solid #ccc;
            padding: 8px;
            vertical-align: top;
        }
        .diagnostic-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .category-header {
            background-color: #e8f4f8;
            font-weight: bold;
            text-align: center;
        }
        .test-list {
            padding-left: 10px;
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

        <h3>LANTAW-DABAW PROJECT</h3>
        <h3>A Telelifestyle Monitoring Project for Dabawenyos</h3>
        <p>Medical School Drive, Bajada, Davao City<br>
        Tel No.: (082) 225-7278</p>
        <h4>DIAGNOSTIC REQUEST</h4>
        <p class="date">DATE: {{ \Carbon\Carbon::parse($diagnostic->diagnostic_date)->format('F j, Y') }}</p>
    </div>
    <hr>
    <table class="info-table">
        <tr>
            <td><strong>NAME:</strong> {{ $diagnostic->patient->last_name }}, {{ $diagnostic->patient->first_name }} {{ $diagnostic->patient->middle_name ?? '' }} </td>
        </tr>
        <tr>
            <td><strong>AGE/SEX:</strong> {{ $diagnostic->patient->age }} / {{ $diagnostic->patient->sex ?? $diagnostic->patient->gender }}</td>
        </tr>
        <tr>
            <td><strong>REQUESTING PHYSICIAN:</strong> {{ $diagnostic->requesting_physician }}</td>
        </tr>
    </table>
    
    <br/>
    
    <table class="diagnostic-table">
        @if(!empty($diagnostic->hematology) && count($diagnostic->hematology) > 0)
        <tr>
            <td class="category-header">HEMATOLOGY</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->hematology as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>

                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan mag-puasa (fasting).</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Likayi ang kusog nga lihok o ehersisyo sa wala pa ang test.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Mas maayo magpa-test buntag.</p>

            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->clinical_microscopy) && count($diagnostic->clinical_microscopy) > 0)
        <tr>
            <td class="category-header">CLINICAL MICROSCOPY</td>
        </tr>
        <tr>
            <td class="test-list">
                • 
                @foreach($diagnostic->clinical_microscopy as $test)
                    {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br><br>
            @if(in_array('urinalysis', $diagnostic->clinical_microscopy))
            <p class="bold-text">• Urinalysis:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Kolektaha ang" midstream" o tunga tunga nga ihi gamit ang limpyo ug sterile nga botelya.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Mas maayo kung unang ihi sa buntag ang gamiton.</p>
            @endif

            @if(in_array('pregnancy_test', $diagnostic->clinical_microscopy))
            <p class="bold-text">• Pregnancy Test:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Gamiton ang unang ihi sa buntag para mas klaro ang resulta.</p>
            @endif

            @if(in_array('semenalysis', $diagnostic->clinical_microscopy))
            <p class="bold-text">• Semen Analysis:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Likayi ang pakighilawas sulod sa 2–7 ka adlaw sa wala pa ang test.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Kolektahi ang semilya sa sterile nga botelya.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dalha dayon sa laboratoryo sulod sa 30–60 minutos, itipig sa lawas nga temperatura.</p>
            @endif
            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->blood_chemistry) && count($diagnostic->blood_chemistry) > 0)
        <tr>
            <td class="category-header">BLOOD CHEMISTRY</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->blood_chemistry as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>
                
                <table style="width: 100%; border: none;">
                    <tr>
                        <td style="width: 50%; vertical-align: top; border: none; padding-right: 10px;">
                            @if(in_array('fbs_rbs', $diagnostic->blood_chemistry))
                            <p class="bold-text">• FBS/RBS (Fasting/Random Blood Sugar):</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Fasting: Walay kaon o imnon (gawas sa tubig) sulod sa 8–10 ka oras.</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Random: Dili kinahanglan mag-fasting.</p>
                            @endif

                            @if(in_array('lipid_profile', $diagnostic->blood_chemistry))
                            <p class="bold-text">• Lipid Profile:</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Mag-fasting sulod sa 10–12 ka oras.</p>
                            @endif

                            @if(in_array('bun', $diagnostic->blood_chemistry) || in_array('creatinine', $diagnostic->blood_chemistry) || in_array('serum_uric_acid', $diagnostic->blood_chemistry))
                            <p class="bold-text">• BUN / Creatinine / SUA (Uric Acid):</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Mag-fasting sulod sa 8–10 ka oras.</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Imna og tubig kung tugutan sa health worker.</p>
                            @endif

                            @if(in_array('sgot_ast', $diagnostic->blood_chemistry) || in_array('sgpt_alt', $diagnostic->blood_chemistry))
                            <p class="bold-text">• SGOT / AST ug SGPT / ALT:</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Wala'y espesyal nga preparasyon.</p>
                            @endif
                        </td>
                        
                        <td style="width: 50%; vertical-align: top; border: none; padding-left: 10px;">
                            @if(in_array('hba1c', $diagnostic->blood_chemistry))
                            <p class="bold-text">• HbA1c:</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan og fasting.</p>
                            @endif

                            @if(in_array('ogtt', $diagnostic->blood_chemistry))
                            <p class="bold-text">• OGTT (Oral Glucose Tolerance Test):</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Mag-fasting sulod sa 8–10 ka oras.</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Human kuhaan og dugo, painmon og glucose solution.</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Sunod nga kuha sa dugo human sa 1 ug 2 ka oras.</p>
                            @endif

                            @if(in_array('serum_electrolytes', $diagnostic->blood_chemistry))
                            <p class="bold-text">• Serum Electrolytes:</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan og fasting.</p>
                            @endif
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->microbiology) && count($diagnostic->microbiology) > 0)
        <tr>
            <td class="category-header">MICROBIOLOGY</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->microbiology as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>
                
                @if(in_array('gram_stain', $diagnostic->microbiology))
                <p class="bold-text">• Gram Stain:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Depende sa sample (e.g., tutunlan, samad, uban pa).</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Sundon ang tukmang instruction sa health worker.</p>
                @endif

                @if(in_array('sputum_genexpert', $diagnostic->microbiology))
                <p class="bold-text">• Sputum AFB / GeneXpert:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Kolektahi ang plema buntag sa wala pa mag-toothbrush o mokaon.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Pahiran ang baba gamit tubig, dayon hikapa og lalom ang ubo aron mogawas ang plema (dili laway).</p>
                @endif

                @if(in_array('koh', $diagnostic->microbiology))
                <p class="bold-text">• KOH Test / SSS (Slit Skin Smear):</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Wala'y kinahanglan nga preparasyon.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Ang health worker ang mukuha sa sample sa panit.</p>
                @endif

            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->immunology_serology) && count($diagnostic->immunology_serology) > 0)
        <tr>
            <td class="category-header">IMMUNOLOGY/SEROLOGY</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->immunology_serology as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>
                <p class="bold-text">• HBsAg Qualitative / HIV 1/2 Qualitative / Syphilis / RPR:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan og fasting.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Naay pre ug post-test counseling depende sa test.</p>
                <p class="bold-text">• Dengue RDT / Malaria RDT:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan og fasting.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Ingna ang staff kung naay hilanat, kalibanga, rashes, o kasukaon.</p>
            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->others))
        <tr>
            <td class="category-header">OTHERS</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                {{ $diagnostic->others }}
            </td>
        </tr>
        @endif
    </table>

    <div class="footer">
        <div class="doctor">
           <div style="text-align: right; margin-top: 50px;">
            <img src="{{ public_path('images/esignature.png') }}" style="width: 150px; height: auto;">
            <div style="font-weight: bold;">{{ $diagnostic->requesting_physician }}</div>
        </div>
            School Clinic Physician<br>
            License No.: 0152234</p>
        </div>
    </div>

</body>
</html>
