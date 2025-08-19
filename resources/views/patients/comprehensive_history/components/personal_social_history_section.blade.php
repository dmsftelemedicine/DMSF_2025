<!-- Personal-Social History Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Personal-Social History</h5>

    <!-- Cigarette User -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="form-check">
                <input type="hidden" name="cigarette_user" value="0">
                <input class="form-check-input" type="checkbox" id="cigarette_user" name="cigarette_user" value="1">
                <label class="form-check-label" for="cigarette_user">Cigarette User</label>
            </div>
        </div>
        <div class="card-body" id="cigarette-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Started</label>
                    <input type="text" class="form-control" name="cigarette_year_started">
                </div>
                <div class="col-md-4 mb-3" id="cigarette-discontinued-container">
                    <label class="form-label">Year Discontinued</label>
                    <input type="text" class="form-control" name="cigarette_year_discontinued">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input type="hidden" name="current_smoker" value="0">
                        <input class="form-check-input" type="checkbox" id="current_smoker" name="current_smoker" value="1">
                        <label class="form-check-label" for="current_smoker">Current Smoker</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Sticks Per Day</label>
                    <input type="number" class="form-control" id="sticks_per_day" name="sticks_per_day">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Years Smoking</label>
                    <input type="text" class="form-control" id="years_smoking" name="years_smoking" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Pack Years</label>
                    <input type="text" class="form-control" id="pack_years" name="pack_years" readonly>
                </div>
            </div>
        </div>
    </div>

    <!-- Alcohol Beverage Drinker -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="form-check">
                <input type="hidden" name="alcohol_drinker" value="0">
                <input class="form-check-input" type="checkbox" id="alcohol_drinker" name="alcohol_drinker" value="1">
                <label class="form-check-label" for="alcohol_drinker">Alcohol Beverage Drinker</label>
            </div>
        </div>
        <div class="card-body" id="alcohol-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Started</label>
                    <input type="text" class="form-control" name="alcohol_year_started">
                </div>
                <div class="col-md-4 mb-3" id="alcohol-discontinued-container">
                    <label class="form-label">Year Discontinued</label>
                    <input type="text" class="form-control" name="alcohol_year_discontinued">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input type="hidden" name="current_drinker" value="0">
                        <input class="form-check-input" type="checkbox" id="current_drinker" name="current_drinker" value="1">
                        <label class="form-check-label" for="current_drinker">Current Drinker</label>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="alcohol_type">
                        <option value="">Select</option>
                        <option value="tuba">Tuba</option>
                        <option value="beer">Beer</option>
                        <option value="wine">Wine</option>
                        <option value="shots">Shots</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Standard Drinks</label>
                    <input type="number" class="form-control" name="alcohol_sd" placeholder="Amount">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Frequency</label>
                    <select class="form-select" name="alcohol_frequency">
                        <option value="">Select</option>
                        <option value="per_day">Per Day</option>
                        <option value="per_week">Per Week</option>
                        <option value="per_session">Per Session</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Illicit Drug User -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="form-check">
                <input type="hidden" name="drug_user" value="0">
                <input class="form-check-input" type="checkbox" id="drug_user" name="drug_user" value="1">
                <label class="form-check-label" for="drug_user">Illicit Drug User</label>
            </div>
        </div>
        <div class="card-body" id="drug-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Type</label>
                    <input type="text" class="form-control" name="drug_type">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Started</label>
                    <input type="text" class="form-control" name="drug_year_started">
                </div>
                <div class="col-md-4 mb-3" id="drug-discontinued-container">
                    <label class="form-label">Year Discontinued</label>
                    <input type="text" class="form-control" name="drug_year_discontinued">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input type="hidden" name="current_drug_user" value="0">
                        <input class="form-check-input" type="checkbox" id="current_drug_user" name="current_drug_user" value="1">
                        <label class="form-check-label" for="current_drug_user">Current Drug User</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coffee User -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="form-check">
                <input type="hidden" name="coffee_user" value="0">
                <input class="form-check-input" type="checkbox" id="coffee_user" name="coffee_user" value="1">
                <label class="form-check-label" for="coffee_user">Coffee User</label>
            </div>
        </div>
        <div class="card-body" id="coffee-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="coffee_type">
                        <option value="">Select</option>
                        <option value="instant">Instant</option>
                        <option value="brewed">Brewed</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Amount</label>
                    <select class="form-select" name="coffee_amount">
                        <option value="">Select</option>
                        <option value="240ml">240ml</option>
                        <option value="360ml">360ml</option>
                        <option value="500ml">500ml</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Cups Per Day</label>
                    <select class="form-select" name="coffee_cups">
                        <option value="">Select</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5+">5+</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to toggle year discontinued field visibility
    function toggleYearDiscontinued(checkboxId, containerId) {
        const checkbox = document.getElementById(checkboxId);
        const container = document.getElementById(containerId);
        
        if (checkbox && container) {
            // Initial state
            if (checkbox.checked) {
                container.style.display = 'none';
            }
            
            // Add event listener
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    container.style.display = 'none';
                } else {
                    container.style.display = 'block';
                }
            });
        }
    }
    
    // Initialize the toggle functionality for each section
    toggleYearDiscontinued('current_smoker', 'cigarette-discontinued-container');
    toggleYearDiscontinued('current_drinker', 'alcohol-discontinued-container');
    toggleYearDiscontinued('current_drug_user', 'drug-discontinued-container');
});
</script>
