<div class="container-fluid">
    <!-- Initial Stress & Mood Assessment -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fas fa-brain me-2"></i>Initial Stress & Mood Assessment</h4>
        </div>
        <div class="card-body">
            <!-- Stress Rating Section -->
            <div class="mb-4">
                <h5 class="mb-3">How stressed are you?</h5>
                <div class="row">
                    <div class="col-md-8">
                        <input type="range" class="form-range" id="stress_rating" min="1" max="10" value="1">
                        <div class="d-flex justify-content-between mt-2">
                            <small class="text-muted">1 - No stress at all</small>
                            <small class="text-muted">10 - Worst stress of my life</small>
                        </div>
                        <div class="mt-2">
                            <span class="badge bg-primary fs-6">Current Level: <span id="stress_display">1</span></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary" onclick="saveStressRating()">
                            <i class="fas fa-save me-1"></i>Save Rating
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recommendation Area -->
            <div id="recommendation_area" class="mt-4">
                <!-- Dynamic recommendations will be populated here -->
            </div>

            <!-- Action Buttons for Screeners -->
            <div id="screener_buttons" class="mt-4" style="display: none;">
                <h6 class="mb-3">Recommended Screeners:</h6>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <button type="button" class="btn btn-info w-100" onclick="showGAD7()">
                            <i class="fas fa-clipboard-list me-2"></i>Start GAD-7 Screener
                        </button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="button" class="btn btn-warning w-100" onclick="showPHQ9()">
                            <i class="fas fa-heart me-2"></i>Start PHQ-9 Screener
                        </button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button type="button" class="btn btn-success w-100" onclick="showPSS4()">
                            <i class="fas fa-chart-line me-2"></i>Start PSS-4 Screener
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Stress rating slider functionality
    $('#stress_rating').on('input', function() {
        const value = $(this).val();
        $('#stress_display').text(value);
        updateRecommendations(value);
    });

    // Load existing data
    loadStressData();
});

function updateRecommendations(stressRating) {
    const recommendationArea = $('#recommendation_area');
    const screenerButtons = $('#screener_buttons');
    
    // Clear previous recommendations
    recommendationArea.empty();
    
    let recommendations = [];
    
    // Check for EQ-5D-5L anxiety/depression score (if available)
    // This would typically come from another assessment
    const eq5dAnxietyDepression = getEQ5DAnxietyDepressionScore(); // Placeholder function
    
    if (eq5dAnxietyDepression === 'moderate' || eq5dAnxietyDepression === 'severe') {
        recommendations.push({
            type: 'info',
            message: 'We suggest you screen for anxiety with the Generalized Anxiety Disorder Questionnaire (GAD-7) and/or for depression with the Patient Health Questionnaire-9 (PHQ-9).',
            showGAD7: true,
            showPHQ9: true
        });
    }
    
    // Check stress rating
    if (stressRating > 5) {
        recommendations.push({
            type: 'warning',
            message: 'Because your stress rating is above 5, we suggest you also screen your stress with the Perceived Stress Scale (PSS-4).',
            showPSS4: true
        });
    }
    
    // Display recommendations
    if (recommendations.length > 0) {
        recommendations.forEach(function(rec) {
            const alertClass = rec.type === 'info' ? 'alert-info' : 'alert-warning';
            const icon = rec.type === 'info' ? 'info-circle' : 'exclamation-triangle';
            
            const alertHtml = `
                <div class="alert ${alertClass}">
                    <i class="fas fa-${icon} me-2"></i>
                    <strong>Recommendation:</strong> ${rec.message}
                </div>
            `;
            recommendationArea.append(alertHtml);
        });
        
        // Show screener buttons
        screenerButtons.show();
    } else {
        screenerButtons.hide();
    }
}

function saveStressRating() {
    const rating = $('#stress_rating').val();
    
    $.ajax({
        url: '{{ route("stress-initial-assessments.store") }}',
        method: 'POST',
        data: {
            patient_id: {{ $patient->id }},
            stress_rating: rating,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Stress rating saved');
            alert('Stress rating saved successfully!');
        },
        error: function(xhr) {
            console.error('Error saving stress rating:', xhr.responseText);
            alert('Error saving stress rating. Please try again.');
        }
    });
}

// Navigation functions are handled by the parent stress_management.blade.php

window.loadStressData = function() {
    $.ajax({
        url: '{{ route("stress-initial-assessments.show", $patient->id) }}',
        method: 'GET',
        success: function(data) {
            if (data && data.success && data.data) {
                const rec = data.data;
                if (rec.stress_rating) {
                    $('#stress_rating').val(rec.stress_rating);
                    $('#stress_display').text(rec.stress_rating);
                    updateRecommendations(rec.stress_rating);
                }
            }
        },
        error: function(xhr) {
            console.log('No existing stress data found');
        }
    });
}

// Placeholder function - would need to be implemented based on your EQ-5D data
function getEQ5DAnxietyDepressionScore() {
    // This should return the actual EQ-5D anxiety/depression score
    // For now, returning null to simulate no data
    return null;
}
</script> 