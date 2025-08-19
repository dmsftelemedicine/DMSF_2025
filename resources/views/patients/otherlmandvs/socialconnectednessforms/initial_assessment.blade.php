<div class="container-fluid">
    <!-- Initial Social Connectedness Assessment -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-users me-2"></i>Initial Social Connectedness Assessment</h4>
        </div>
        <div class="card-body">
            <!-- Relationship Questions -->
            <div class="mb-4">
                <h5 class="mb-3">How are your relationships?</h5>
                
                <!-- Family Relationship -->
                <div class="mb-4">
                    <label class="form-label">How is your relationship with your immediate family?</label>
                    <div class="row">
                        <div class="col-md-8">
                            <input type="range" class="form-range" id="family_rating" min="1" max="10" value="5">
                            <div class="d-flex justify-content-between mt-2">
                                <small class="text-muted">1 - Worst</small>
                                <small class="text-muted">10 - Excellent</small>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-primary fs-6">Current Level: <span id="family_display">5</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Friends Relationship -->
                <div class="mb-4">
                    <label class="form-label">How is your relationship with your friends?</label>
                    <div class="row">
                        <div class="col-md-8">
                            <input type="range" class="form-range" id="friends_rating" min="1" max="10" value="5">
                            <div class="d-flex justify-content-between mt-2">
                                <small class="text-muted">1 - Worst</small>
                                <small class="text-muted">10 - Excellent</small>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-primary fs-6">Current Level: <span id="friends_display">5</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colleagues Relationship -->
                <div class="mb-4">
                    <label class="form-label">How is your relationship with your classmates/workmates?</label>
                    <div class="row">
                        <div class="col-md-8">
                            <input type="range" class="form-range" id="colleagues_rating" min="1" max="10" value="5">
                            <div class="d-flex justify-content-between mt-2">
                                <small class="text-muted">1 - Worst</small>
                                <small class="text-muted">10 - Excellent</small>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-primary fs-6">Current Level: <span id="colleagues_display">5</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary" onclick="saveSocialRatings()">
                            <i class="fas fa-save me-1"></i>Save Ratings
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recommendation Area -->
            <div id="social_recommendation_area" class="mt-4">
                <!-- Dynamic recommendations will be populated here -->
            </div>

            <!-- Action Buttons for Screeners -->
            <div id="social_screener_buttons" class="mt-4" style="display: none;">
                <h6 class="mb-3">Recommended Screeners:</h6>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <button type="button" class="btn btn-info w-100" onclick="showSCS8()">
                            <i class="fas fa-network-wired me-2"></i>Start Social Connectedness Screener (SCS-8)
                        </button>
                    </div>
                    <div class="col-md-6 mb-2">
                        <button type="button" class="btn btn-warning w-100" onclick="showFamilyAPGAR()">
                            <i class="fas fa-home me-2"></i>Start Family APGAR Screener
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Relationship rating sliders functionality
    $('#family_rating').on('input', function() {
        const value = $(this).val();
        $('#family_display').text(value);
        updateSocialRecommendations();
    });

    $('#friends_rating').on('input', function() {
        const value = $(this).val();
        $('#friends_display').text(value);
        updateSocialRecommendations();
    });

    $('#colleagues_rating').on('input', function() {
        const value = $(this).val();
        $('#colleagues_display').text(value);
        updateSocialRecommendations();
    });

    // Load existing data
    if (typeof loadSocialData === 'function') { loadSocialData(); }
});

function updateSocialRecommendations() {
    const recommendationArea = $('#social_recommendation_area');
    const screenerButtons = $('#social_screener_buttons');
    
    // Clear previous recommendations
    recommendationArea.empty();
    
    let recommendations = [];
    
    // Check family rating
    const familyRating = parseInt($('#family_rating').val());
    if (familyRating < 6) {
        recommendations.push({
            type: 'warning',
            message: 'Suggest to screen for family functioning with the Family APGAR Questionnaire.',
            showFamilyAPGAR: true
        });
    }
    
    // Check friends and colleagues ratings
    const friendsRating = parseInt($('#friends_rating').val());
    const colleaguesRating = parseInt($('#colleagues_rating').val());
    
    if (friendsRating < 6 || colleaguesRating < 6) {
        recommendations.push({
            type: 'info',
            message: 'Suggest to screen for social connectedness with the Social Connectedness Scale (SCS-8).',
            showSCS8: true
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

function saveSocialRatings() {
    const familyRating = $('#family_rating').val();
    const friendsRating = $('#friends_rating').val();
    const colleaguesRating = $('#colleagues_rating').val();
    
    $.ajax({
        url: '{{ route("social-initial-assessments.store") }}',
        method: 'POST',
        data: {
            patient_id: {{ $patient->id }},
            family_rating: familyRating,
            friends_rating: friendsRating,
            colleagues_rating: colleaguesRating,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Social ratings saved');
            alert('Social connectedness ratings saved successfully!');
        },
        error: function(xhr) {
            console.error('Error saving social ratings:', xhr.responseText);
            alert('Error saving social ratings. Please try again.');
        }
    });
}

window.loadSocialData = function() {
    $.ajax({
        url: '{{ route("social-initial-assessments.show", $patient->id) }}',
        method: 'GET',
        success: function(resp) {
            if (resp && resp.success && resp.data) {
                const data = resp.data;
                if (data.family_rating) { $('#family_rating').val(data.family_rating); $('#family_display').text(data.family_rating); }
                if (data.friends_rating) { $('#friends_rating').val(data.friends_rating); $('#friends_display').text(data.friends_rating); }
                if (data.colleagues_rating) { $('#colleagues_rating').val(data.colleagues_rating); $('#colleagues_display').text(data.colleagues_rating); }
            }
            updateSocialRecommendations();
        },
        error: function(xhr) {
            console.log('No existing social data found');
        }
    });
}
</script> 