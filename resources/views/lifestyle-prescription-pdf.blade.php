<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lifestyle Prescription - {{ $patient->first_name }} {{ $patient->last_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #28a745;
            margin-bottom: 30px;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #28a745;
            font-size: 24px;
            margin: 0 0 10px 0;
        }
        
        .header h2 {
            font-size: 18px;
            margin: 5px 0;
            color: #555;
        }
        
        .header p {
            margin: 5px 0;
            color: #777;
        }
        
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section h3 {
            color: #28a745;
            font-size: 16px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 5px;
        }
        
        .section-content {
            padding: 10px;
            background-color: #f9f9f9;
            border-left: 4px solid #28a745;
            margin-bottom: 15px;
        }
        
        .field-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        
        .field-value {
            margin-bottom: 15px;
            padding-left: 10px;
        }
        
        .two-column {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        
        .column {
            display: table-cell;
            width: 48%;
            vertical-align: top;
            padding-right: 15px;
        }
        
        .monitoring-grid {
            display: table;
            width: 100%;
        }
        
        .monitoring-item {
            display: table-cell;
            width: 33.33%;
            vertical-align: top;
            padding-right: 15px;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #777;
            font-size: 10px;
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
        }
        
        .no-content {
            color: #999;
            font-style: italic;
        }
        
        @page {
            margin: 25mm;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏥 Lifestyle Prescription</h1>
        <h2>Patient: {{ $patient->first_name }} {{ $patient->last_name }}</h2>
        <p>Patient ID: {{ $patient->id }}</p>
        <p>Date Generated: {{ date('F j, Y') }}</p>
        @if($prescription->created_at)
            <p>Prescription Date: {{ $prescription->created_at->format('F j, Y') }}</p>
        @endif
    </div>

    <!-- Dietary Recommendations Section -->
    <div class="section">
        <h3>🍽️ Dietary Recommendations</h3>
        <div class="section-content">
            <div class="field-label">Diet Type:</div>
            <div class="field-value">
                {{ $prescription->diet_type ? ucfirst(str_replace('_', ' ', $prescription->diet_type)) : 'Not specified' }}
            </div>
            
            <div class="field-label">Dietary Notes:</div>
            <div class="field-value">
                @if($prescription->diet_notes)
                    {!! nl2br(e($prescription->diet_notes)) !!}
                @else
                    <span class="no-content">No dietary notes available</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Exercise Recommendations Section -->
    <div class="section">
        <h3>🏃 Exercise Recommendations</h3>
        <div class="section-content">
            <div class="field-label">Exercise Type:</div>
            <div class="field-value">
                {{ $prescription->exercise_type ? ucfirst(str_replace('_', ' ', $prescription->exercise_type)) : 'Not specified' }}
            </div>
            
            <div class="field-label">Exercise Notes:</div>
            <div class="field-value">
                @if($prescription->exercise_notes)
                    {!! nl2br(e($prescription->exercise_notes)) !!}
                @else
                    <span class="no-content">No exercise notes available</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Monitoring Guidelines Section -->
    <div class="section">
        <h3>📊 Monitoring Guidelines</h3>
        <div class="section-content">
            <div class="monitoring-grid">
                <div class="monitoring-item">
                    <div class="field-label">Blood Sugar Monitoring:</div>
                    <div class="field-value">
                        @if($prescription->blood_sugar_monitoring)
                            {!! nl2br(e($prescription->blood_sugar_monitoring)) !!}
                        @else
                            <span class="no-content">Not specified</span>
                        @endif
                    </div>
                </div>
                
                <div class="monitoring-item">
                    <div class="field-label">Weight Management:</div>
                    <div class="field-value">
                        @if($prescription->weight_management)
                            {!! nl2br(e($prescription->weight_management)) !!}
                        @else
                            <span class="no-content">Not specified</span>
                        @endif
                    </div>
                </div>
                
                <div class="monitoring-item">
                    <div class="field-label">Follow-up Schedule:</div>
                    <div class="field-value">
                        @if($prescription->follow_up_schedule)
                            {!! nl2br(e($prescription->follow_up_schedule)) !!}
                        @else
                            <span class="no-content">Not specified</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>This lifestyle prescription was generated digitally on {{ date('F j, Y \a\t g:i A') }}</p>
        <p>DMSF 2025 - Digital Medical System Framework</p>
    </div>
</body>
</html>