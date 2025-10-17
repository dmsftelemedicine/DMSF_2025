<style>
    .scoring-guide-table, .scoring-guide-table tr, .scoring-guide-table td, .scoring-guide-table th {
        border-color: transparent !important;
        border-width: 1px;
        border-style: solid;
    }
</style>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('nutritionTab', () => ({
            open: false, // SHEI-22
            openRecall: false,
            openBMR: false,
            openTDEE: false,
            openKcalorie: false,
            showForm: false,
            hasNutritionData: false,
            isSubmitting: false,
            nutritionData: null,
            nutritionFormScore: null,
            patientId: {{ $patient->id ?? 'null' }},
            consultationId: {{ $consultationId ?? 'null' }},
            init() {
                window.addEventListener('nutrition-form-saved', () => {
                    this.showForm = false;
                    // Refresh nutrition data after save
                    this.loadLatestNutrition();
                });
                window.addEventListener('close-nutrition-modal', () => {
                    this.showForm = false;
                });
                // Expose submission state control
                window.addEventListener('nutrition-submitting', (e) => {
                    this.isSubmitting = e.detail.isSubmitting;
                });
                // Load nutrition data on init
                this.loadLatestNutrition();
            },
            openNutritionForm() {
                this.showForm = true;
                // Set consultation_id in form
                setTimeout(() => {
                    const consultationInput = document.getElementById('nutrition_consultation_id');
                    if (consultationInput && this.consultationId) {
                        consultationInput.value = this.consultationId;
                    }
                    
                    // Load existing data into form if available
                    if (this.hasNutritionData && this.nutritionData) {
                        this.loadNutritionIntoForm();
                    }
                }, 50);
            },
            loadLatestNutrition() {
                // Fetch latest nutrition data, prefer by consultation
                const url = this.consultationId ? `/api/consultations/${this.consultationId}/nutrition/latest` : `/api/patients/${this.patientId}/nutrition/latest`;
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data && data.id) {
                        // Store nutrition data for form editing
                        this.nutritionData = data;
                        this.hasNutritionData = true;
                        
                        // Populate score
                        this.nutritionFormScore = data.dq_score;
                        // Populate details
                        document.getElementById('nutrition-fruit').textContent = data.fruit || '';
                        document.getElementById('nutrition-fruit-juice').textContent = data.fruit_juice || '';
                        document.getElementById('nutrition-vegetables').textContent = data.vegetables || '';
                        document.getElementById('nutrition-green-vegetables').textContent = data.green_vegetables || '';
                        document.getElementById('nutrition-starchy-vegetables').textContent = data.starchy_vegetables || '';
                        document.getElementById('nutrition-beans').textContent = data.beans || '';
                        document.getElementById('nutrition-nuts-seeds').textContent = data.nuts_seeds || '';
                        document.getElementById('nutrition-seafood').textContent = data.seafood || '';
                        document.getElementById('nutrition-seafood-frequency').textContent = data.seafood_frequency || '';
                        document.getElementById('nutrition-grains').textContent = data.grains || '';
                        document.getElementById('nutrition-grains-frequency').textContent = data.grains_frequency || '';
                        document.getElementById('nutrition-whole-grains').textContent = data.whole_grains || '';
                        document.getElementById('nutrition-whole-grains-frequency').textContent = data.whole_grains_frequency || '';
                        document.getElementById('nutrition-milk').textContent = data.milk || '';
                        document.getElementById('nutrition-milk-frequency').textContent = data.milk_frequency || '';
                        document.getElementById('nutrition-low-fat-milk').textContent = data.low_fat_milk || '';
                        document.getElementById('nutrition-low-fat-milk-frequency').textContent = data.low_fat_milk_frequency || '';
                        document.getElementById('nutrition-ssb').textContent = data.ssb || '';
                        document.getElementById('nutrition-ssb-frequency').textContent = data.ssb_frequency || '';
                        document.getElementById('nutrition-water').textContent = data.water || '';
                        document.getElementById('nutrition-added-sugars').textContent = data.added_sugars || '';
                    } else {
                        this.nutritionData = null;
                        this.hasNutritionData = false;
                        this.nutritionFormScore = null;
                    }
                })
                .catch(error => {
                    console.error('Error loading nutrition data:', error);
                    this.nutritionData = null;
                    this.hasNutritionData = false;
                    this.nutritionFormScore = null;
                });
            },
            loadNutritionIntoForm() {
                if (!this.nutritionData) return;
                
                const data = this.nutritionData;
                const fieldNames = [
                    'fruit', 'fruit_juice', 'vegetables', 'green_vegetables', 'starchy_vegetables',
                    'grains', 'grains_frequency', 'whole_grains', 'whole_grains_frequency',
                    'milk', 'milk_frequency', 'low_fat_milk', 'low_fat_milk_frequency',
                    'beans', 'nuts_seeds', 'seafood', 'seafood_frequency',
                    'ssb', 'ssb_frequency', 'added_sugars', 'saturated_fat', 'water'
                ];
                
                // Wait for form to be visible, then populate
                setTimeout(() => {
                    fieldNames.forEach(fieldName => {
                        const value = data[fieldName];
                        if (value !== null && value !== undefined) {
                            const inputs = document.querySelectorAll(`input[name="${fieldName}"]`);
                            inputs.forEach(input => {
                                if (input.type === 'radio' && input.value === String(value)) {
                                    input.checked = true;
                                    // Trigger change event to show conditional questions
                                    input.dispatchEvent(new Event('change'));
                                }
                            });
                        }
                    });
                }, 100);
            }
        }));
    });

    document.addEventListener('DOMContentLoaded', function () {
        const foodRecallForm = document.getElementById('foodRecallForm');
        if (foodRecallForm) {
            foodRecallForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const data = {
                    nutrition_id: document.getElementById('nutrition_id').value,
                    breakfast: foodRecallForm.elements['breakfast'].value,
                    am_snack: foodRecallForm.elements['am_snack'].value,
                    lunch: foodRecallForm.elements['lunch'].value,
                    pm_snack: foodRecallForm.elements['pm_snack'].value,
                    dinner: foodRecallForm.elements['dinner'].value,
                    midnight_snack: foodRecallForm.elements['midnight_snack'].value,
                    _token: foodRecallForm.querySelector('input[name="_token"]').value
                };

                fetch('/api/food-recall', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': data._token
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Food recall saved successfully!');
                        // Optionally reset the form
                        foodRecallForm.reset();
                        // Hide the modal (Bootstrap 5)
                        const modal = bootstrap.Modal.getInstance(document.getElementById('foodRecallModal'));
                        if (modal) modal.hide();
                    } else {
                        alert('Failed to save food recall.');
                    }
                })
                .catch(() => {
                    alert('An error occurred while saving.');
                });
            });
        }
    });
</script>

<div class="w-full" x-data="nutritionTab" x-init="init()">
    <!-- SHEI-22 Section (not an accordion) -->
        <div>
                <!-- Header and Brief Description in One Column -->
                <div class="flex flex-col gap-2 px-0 mb-2">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col">
                            <h2 class="text-xl font-bold">Short Healthy Eating Index (SHEI-22)</h2>
                            <p class="mt-1">This survey estimates overall diet quality; higher scores mean healthier patterns.</p>
                        </div>
                        <button type="button" class="text-white px-4 py-2 rounded-full shadow transition-colors flex items-center justify-center gap-2 text-center"
                            style="background-color: #4A6C2F;"
                            @click="openNutritionForm()">
                            <span class="flex items-center justify-center">
                                <!-- Show Edit icon if data exists, otherwise Plus icon -->
                                <svg x-show="!hasNutritionData" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                <svg x-show="hasNutritionData" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                                <span class="ml-1" x-text="hasNutritionData ? 'Edit Nutrition Intake' : 'Add Nutrition Intake'"></span>
                            </span>
                        </button>
                    </div>
                    
                    <div class="border border-blue-300 bg-[#E0F8FF] text-[#236477] p-4 mt-2" style="border-width:2px; border-radius:4px;">
                        <span class="font-bold" style="display:inline-block; margin-bottom:4px;">Brief Description</span><br>
                        <span style="font-size:12px; line-height:1.2; margin-top:4px; display:inline-block;">
                            The <b>SHEI-22</b> is a concise, 22-item dietary quality assessment tool designed to efficiently and user-friendly estimate individuals’ adherence to healthy eating patterns. Developed through expert panels and decision-tree algorithms, it demonstrates a strong correlation with the full Healthy Eating Index derived from 24-hour dietary recalls (r = 0.79). The tool also exhibits moderate to strong validity for key food group intake estimates (r = 0.44–0.64), along with high content validity, internal consistency (Cronbach’s α ≈ 0.80–0.81), and structural validity across diverse populations, including college students and international samples.
                        </span>
                    </div>
                </div>

                <!-- Scoring Guide and Score Display -->
                <div class="flex flex-row mt-0 gap-4 px-0 mb-2">
                    <div class="w-3/4 rounded-xl bg-[#F7F7F7] h-[250px] flex flex-start px-4 shadow-sm p-4 mt-2">
                        <!-- Scoring Guide -->
                        <div>
                            <h3 class="text-xs font-bold mb-2">Scoring guide:</h3>
                            <div class="text-xs text-gray-700 mb-4">
                                <span class="font-medium">Total DQ Score (0–100) =</span> total_fruits + whole_fruits + tot_veg + greens_beans + whole_grains + dairy + tot_proteins + seafood_plant + fatty_acid + refined_grains + sodium + added_sugars + sat_fat
                            </div>
                            <div class="overflow-x-auto">
                                <table class="scoring-guide-table min-w-full text-xs border border-transparent rounded-lg">
                                    <thead>
                                        <tr>
                                            <th class="px-2 py-1 font-semibold text-left">Total DQ Score</th>
                                            <th class="px-2 py-1 font-semibold text-left">Diet Quality Category</th>
                                            <th class="px-2 py-1 font-semibold text-left">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="px-2 py-1">0–49</td>
                                            <td class="px-2 py-1">Poor diet quality</td>
                                            <td class="px-2 py-1">Reflects low intake of recommended foods and high intake of unhealthy components.</td>
                                        </tr>
                                        <tr>
                                            <td class="px-2 py-1">50–79</td>
                                            <td class="px-2 py-1">Moderate diet quality</td>
                                            <td class="px-2 py-1">Partial adherence; improvement needed in targeted food groups.</td>
                                        </tr>
                                        <tr>
                                            <td class="px-2 py-1">80–100</td>
                                            <td class="px-2 py-1">High diet quality</td>
                                            <td class="px-2 py-1">Strong alignment with healthy eating guidelines.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-[10px] text-[#383838] pt-2 italic">
                                For the specific scoring of each food group, refer to <a href="https://pmc.ncbi.nlm.nih.gov/articles/PMC7551037/table/array1/" class="bg-white text-black font-bold underline">Colby, 2020, Table S1</a>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/4 flex items-center justify-center"> 
                        @php 
                            $nutritionFormScore = $nutritionFormScore ?? null;
                        @endphp
                        <div 
                            class="h-[250px] w-full rounded-xl flex flex-col items-center justify-evenly text-center shadow-sm"
                            :class="{
                                'bg-red-100': nutritionFormScore < 50 && nutritionFormScore !== null,
                                'bg-yellow-100': nutritionFormScore >= 50 && nutritionFormScore < 80,
                                'bg-gray-100': nutritionFormScore === null,
                                'bg-green-100': nutritionFormScore >= 80
                            }"
                        >
                            <span class="text-2xl font-semibold"
                                :class="{
                                    'text-red-700': nutritionFormScore < 50 && nutritionFormScore !== null,
                                    'text-yellow-700': nutritionFormScore >= 50 && nutritionFormScore < 80,
                                    'text-gray-700': nutritionFormScore === null,
                                    'text-green-700': nutritionFormScore >= 80
                                }">SHEI-22 Score</span>
                            <span class="text-6xl font-bold"
                                :class="{
                                    'text-red-700': nutritionFormScore < 50 && nutritionFormScore !== null,
                                    'text-yellow-700': nutritionFormScore >= 50 && nutritionFormScore < 80,
                                    'text-gray-700': nutritionFormScore === null,
                                    'text-green-700': nutritionFormScore >= 80
                                }">
                                <span x-text="nutritionFormScore || '--.--'"></span>
                            </span>
                            <span class="text-xl font-medium"
                                :class="{
                                    'text-red-700': nutritionFormScore < 50 && nutritionFormScore !== null,
                                    'text-yellow-700': nutritionFormScore >= 50 && nutritionFormScore < 80,
                                    'text-gray-700': nutritionFormScore === null,
                                    'text-green-700': nutritionFormScore >= 80
                                }">
                                <span x-text="nutritionFormScore < 50 && nutritionFormScore !== null ? 'Poor diet quality' : (nutritionFormScore >= 50 && nutritionFormScore < 80 ? 'Moderate diet quality' : (nutritionFormScore >= 80 ? 'High diet quality' : 'N/A'))"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Diet Summary Card Grid -->
                <div x-show="nutritionFormScore !== null" class="bg-[#F7F7F7] rounded-xl shadow-sm border mt-3 mb-8 px-0 pt-0 pb-4">
                    <div class="bg-gray-800 text-white rounded-t-lg px-6 py-3 text-lg font-bold">Diet Summary</div>
                    <div class="flex flex-col gap-0 px-6 pt-6">
                        <!-- First Row: Fruits & Vegetables, Protein, Grains -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-0">
                            <!-- Fruits & Vegetables -->
                            <div>
                                <div class="font-bold text-base mb-0 flex items-center gap-2 pr-4 pb-2"><span>🍎</span> Fruits &amp; Vegetables</div>
                                <div class="flex flex-col gap-1 text-[15px] pr-4 pb-4">
                                    <div class="flex justify-between"><span>Fruit Consumption</span><span id="nutrition-fruit" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Fruit Juice</span><span id="nutrition-fruit-juice" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Vegetable Consumption</span><span id="nutrition-vegetables" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Green Vegetables</span><span id="nutrition-green-vegetables" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Starchy Vegetables</span><span id="nutrition-starchy-vegetables" class="font-semibold"></span></div>
                                </div>
                            </div>
                            <!-- Protein -->
                            <div>
                                <div class="font-bold text-base mb-0 flex items-center gap-2 pr-4 pb-2"><span>🥩</span> Protein</div>
                                <div class="flex flex-col gap-1 text-[15px] pr-4 pb-4">
                                    <div class="flex justify-between"><span>Beans Consumption</span><span id="nutrition-beans" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Nuts &amp; Seeds Consumption</span><span id="nutrition-nuts-seeds" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Seafood Consumption</span><span id="nutrition-seafood" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Seafood Frequency</span><span id="nutrition-seafood-frequency" class="font-semibold"></span></div>
                                </div>
                            </div>
                            <!-- Grains -->
                            <div>
                                <div class="font-bold text-base mb-0 flex items-center gap-2 pr-4 pb-2"><span>🌾</span> Grains</div>
                                <div class="flex flex-col gap-1 text-[15px] pr-4 pb-4">
                                    <div class="flex justify-between"><span>Grain Consumption</span><span id="nutrition-grains" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Grain Frequency</span><span id="nutrition-grains-frequency" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Whole Grain Consumption</span><span id="nutrition-whole-grains" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Whole Grain Frequency</span><span id="nutrition-whole-grains-frequency" class="font-semibold"></span></div>
                                </div>
                            </div>
                        </div>
                        <!-- Second Row: Beverages, Dairy, Limit These -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-4 gap-y-0">
                            <!-- Beverages -->
                            <div>
                                <div class="font-bold text-base mb-0 flex items-center gap-2 pr-4 pb-2 mt-2"><span>🥤</span> Beverages</div>
                                <div class="flex flex-col gap-1 text-[15px] pr-4 pb-4">
                                    <div class="flex justify-between"><span>Sugar-Sweetened Beverages</span><span id="nutrition-ssb" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Sugar-Sweetened Frequency</span><span id="nutrition-ssb-frequency" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Water Consumption</span><span id="nutrition-water" class="font-semibold"></span></div>
                                </div>
                            </div>
                            <!-- Dairy -->
                            <div>
                                <div class="font-bold text-base mb-0 flex items-center gap-2 pr-4 pb-2 mt-2"><span>🥛</span> Dairy</div>
                                <div class="flex flex-col gap-1 text-[15px] pr-4 pb-4">
                                    <div class="flex justify-between"><span>Milk Consumption</span><span id="nutrition-milk" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Milk Frequency</span><span id="nutrition-milk-frequency" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Low-Fat Milk Consumption</span><span id="nutrition-low-fat-milk" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Low-Fat Milk Frequency</span><span id="nutrition-low-fat-milk-frequency" class="font-semibold"></span></div>
                                </div>
                            </div>
                            <!-- Limit These -->
                            <div>
                                <div class="font-bold text-base mb-0 flex items-center gap-2 pr-4 pb-2 mt-2"><span>⚠️</span> Limit These</div>
                                <div class="flex flex-col gap-1 text-[15px] pr-4 pb-4">
                                    <div class="flex justify-between"><span>Added Sugars</span><span id="nutrition-added-sugars" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Sugar-Sweetened Frequency</span><span id="nutrition-ssb-frequency" class="font-semibold"></span></div>
                                    <div class="flex justify-between"><span>Water Consumption</span><span id="nutrition-water" class="font-semibold"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Nutrition Form Modal -->
    <div x-show="showForm" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;"
         @click.self="showForm = false">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="showForm = false"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Short Healthy Eating Index (SHEI-22)</h3>
                            <p class="text-sm text-gray-500 mt-1" x-text="hasNutritionData ? 'Update the nutrition assessment for this consultation' : 'Add a new nutrition assessment for this consultation'"></p>
                        </div>
                        <button type="button" 
                                class="text-gray-400 hover:text-gray-500" 
                                @click="showForm = false">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Include the form content -->
                    <div class="max-h-[70vh] overflow-y-auto">
                        @include('patients.screeningtool.forms.nutrition_form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Related Forms Section -->
    <h2 class="text-xl font-bold mb-2 mt-4">Other Related Forms</h2>
    <div class="flex flex-col gap-3">

    <!-- 24-hr Food Recall Accordion -->
        <button class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-[#236477] text-left transition-colors rounded-t-lg"
            @click="openRecall = !openRecall"
            :class="{ 'text-black hover:text-white hover:bg-[#236477] rounded-lg': !openRecall, 'rounded-b-none': openRecall }"
            :style="openRecall ? 'background-color: #236477; color: white;' : ''">
            <div class="flex flex-col">
                <span class="font-medium">24-hr Food Recall</span>
                <span class="text-sm opacity-75">View Details</span>
            </div>
            <div class="text-white" x-show="openRecall">
                <span>Expand</span>
            </div>
        </button>

        <!-- 24-hr Food Recall Details -->
        <div x-show="openRecall" class="border-x border-b rounded-b-lg shadow-sm bg-white">
            <div class="p-4 text-black">
                <div x-data="{
                    breakfast: [], breakfastInput: '',
                    amSnack: [], amSnackInput: '',
                    lunch: [], lunchInput: '',
                    pmSnack: [], pmSnackInput: '',
                    dinner: [], dinnerInput: '',
                    midnightSnack: [], midnightSnackInput: '',
                    addFood(meal) {
                        const val = this[meal + 'Input'].trim();
                        if (val && !this[meal].includes(val)) {
                            this[meal].push(val);
                        }
                        this[meal + 'Input'] = '';
                    },
                    removeFood(meal, idx) {
                        this[meal].splice(idx, 1);
                    },
                    saveFoods() {
                        // Prepare data as comma-separated strings for each meal/snack
                        const data = {
                            breakfast: this.breakfast.join(', '),
                            am_snack: this.amSnack.join(', '),
                            lunch: this.lunch.join(', '),
                            pm_snack: this.pmSnack.join(', '),
                            dinner: this.dinner.join(', '),
                            midnight_snack: this.midnightSnack.join(', '),
                            _token: document.querySelector('meta[name=quot]').getAttribute('content')
                        };
                        fetch('/api/food-recall', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': data._token
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                alert('Food recall saved successfully!');
                                // Optionally clear fields
                                this.breakfast = [];
                                this.amSnack = [];
                                this.lunch = [];
                                this.pmSnack = [];
                                this.dinner = [];
                                this.midnightSnack = [];
                            } else {
                                alert('Failed to save food recall.');
                            }
                        })
                        .catch(() => {
                            alert('An error occurred while saving.');
                        });
                    }
                }" class="w-full">
                    <p class="mb-4 text-gray-700 text-sm">This form records all foods and drinks consumed by the resident in the past 24 hours.</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Column 1 -->
                        <div class="flex flex-col gap-4">
                            <!-- Breakfast -->
                            <div>
                                <label class="block font-semibold text-lg mb-2">Breakfast</label>
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <template x-for="(food, idx) in breakfast" :key="food">
                                        <span class="bg-[#3197b7] text-white rounded px-3 py-1 text-sm flex items-center gap-1">
                                            <span x-text="food"></span>
                                            <button type="button" class="ml-1 text-white hover:text-gray-200" @click="removeFood('breakfast', idx)">&times;</button>
                                        </span>
                                    </template>
                                </div>
                                <input
                                    type="text"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-[#3197b7]"
                                    placeholder="Add Breakfast"
                                    x-model="breakfastInput"
                                    @keydown.enter.prevent="addFood('breakfast')"
                                >
                            </div>
                            <!-- AM Snack -->
                            <div>
                                <label class="block font-semibold text-lg mb-2">A.M. Snack</label>
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <template x-for="(food, idx) in amSnack" :key="food">
                                        <span class="bg-[#3197b7] text-white rounded px-3 py-1 text-sm flex items-center gap-1">
                                            <span x-text="food"></span>
                                            <button type="button" class="ml-1 text-white hover:text-gray-200" @click="removeFood('amSnack', idx)">&times;</button>
                                        </span>
                                    </template>
                                </div>
                                <input
                                    type="text"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-[#3197b7]"
                                    placeholder="Add A.M. Snack"
                                    x-model="amSnackInput"
                                    @keydown.enter.prevent="addFood('amSnack')"
                                >
                            </div>
                        </div>
                        <!-- Column 2 -->
                        <div class="flex flex-col gap-4">
                            <!-- Lunch -->
                            <div>
                                <label class="block font-semibold text-lg mb-2">Lunch</label>
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <template x-for="(food, idx) in lunch" :key="food">
                                        <span class="bg-[#3197b7] text-white rounded px-3 py-1 text-sm flex items-center gap-1">
                                            <span x-text="food"></span>
                                            <button type="button" class="ml-1 text-white hover:text-gray-200" @click="removeFood('lunch', idx)">&times;</button>
                                        </span>
                                    </template>
                                </div>
                                <input
                                    type="text"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-[#3197b7]"
                                    placeholder="Add Lunch"
                                    x-model="lunchInput"
                                    @keydown.enter.prevent="addFood('lunch')"
                                >
                            </div>
                            <!-- PM Snack -->
                            <div>
                                <label class="block font-semibold text-lg mb-2">P.M. Snack</label>
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <template x-for="(food, idx) in pmSnack" :key="food">
                                        <span class="bg-[#3197b7] text-white rounded px-3 py-1 text-sm flex items-center gap-1">
                                            <span x-text="food"></span>
                                            <button type="button" class="ml-1 text-white hover:text-gray-200" @click="removeFood('pmSnack', idx)">&times;</button>
                                        </span>
                                    </template>
                                </div>
                                <input
                                    type="text"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-[#3197b7]"
                                    placeholder="Add P.M. Snack"
                                    x-model="pmSnackInput"
                                    @keydown.enter.prevent="addFood('pmSnack')"
                                >
                            </div>
                        </div>
                        <!-- Column 3 -->
                        <div class="flex flex-col gap-4">
                            <!-- Dinner -->
                            <div>
                                <label class="block font-semibold text-lg mb-2">Dinner</label>
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <template x-for="(food, idx) in dinner" :key="food">
                                        <span class="bg-[#3197b7] text-white rounded px-3 py-1 text-sm flex items-center gap-1">
                                            <span x-text="food"></span>
                                            <button type="button" class="ml-1 text-white hover:text-gray-200" @click="removeFood('dinner', idx)">&times;</button>
                                        </span>
                                    </template>
                                </div>
                                <input
                                    type="text"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-[#3197b7]"
                                    placeholder="Add Dinner"
                                    x-model="dinnerInput"
                                    @keydown.enter.prevent="addFood('dinner')"
                                >
                            </div>
                            <!-- Midnight Snack -->
                            <div>
                                <label class="block font-semibold text-lg mb-2">Midnight Snack</label>
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <template x-for="(food, idx) in midnightSnack" :key="food">
                                        <span class="bg-[#3197b7] text-white rounded px-3 py-1 text-sm flex items-center gap-1">
                                            <span x-text="food"></span>
                                            <button type="button" class="ml-1 text-white hover:text-gray-200" @click="removeFood('midnightSnack', idx)">&times;</button>
                                        </span>
                                    </template>
                                </div>
                                <input
                                    type="text"
                                    class="w-full border border-gray-300 rounded px-3 py-2 text-base focus:outline-none focus:ring-2 focus:ring-[#3197b7]"
                                    placeholder="Add Midnight Snack"
                                    x-model="midnightSnackInput"
                                    @keydown.enter.prevent="addFood('midnightSnack')"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="button" @click="saveFoods()" class="bg-[#4A6C2F] text-white px-6 py-2 rounded-full flex items-center gap-2 font-semibold">
                            Save
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                <path d="M11 2H9v3h2z"/>
                                <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Basal Metabolic Rate (BMR) Accordion -->
        <button class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-[#236477] text-left transition-colors rounded-t-lg"
            @click="openBMR = !openBMR"
            :class="{ 'text-black hover:text-white hover:bg-[#236477] rounded-lg': !openBMR, 'rounded-b-none': openBMR }"
            :style="openBMR ? 'background-color: #236477; color: white;' : ''">
            <div class="flex flex-col">
                <span class="font-medium">Basal Metabolic Rate (BMR)</span>
                <span class="text-sm opacity-75">View Details</span>
            </div>
            <div class="text-white" x-show="openBMR">
                <span>Expand</span>
            </div>
        </button>
        <div x-show="openBMR" class="border-x border-b rounded-b-lg shadow-sm bg-white">
            <div class="p-4 text-black">Test content for BMR.</div>
        </div>
        <!-- Total Daily Energy Expenditure (TDEE) Accordion -->
        <button class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-[#236477] text-left transition-colors rounded-t-lg"
            @click="openTDEE = !openTDEE"
            :class="{ 'text-black hover:text-white hover:bg-[#236477] rounded-lg': !openTDEE, 'rounded-b-none': openTDEE }"
            :style="openTDEE ? 'background-color: #236477; color: white;' : ''">
            <div class="flex flex-col">
                <span class="font-medium">Total Daily Energy Expenditure (TDEE)</span>
                <span class="text-sm opacity-75">View Details</span>
            </div>
            <div class="text-white" x-show="openTDEE">
                <span>Expand</span>
            </div>
        </button>
        <div x-show="openTDEE" class="border-x border-b rounded-b-lg shadow-sm bg-white">
            <div class="p-4 text-black">Test content for TDEE.</div>
        </div>
        <!-- Ideal Kcalorie Accordion -->
        <button class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-[#236477] text-left transition-colors rounded-t-lg"
            @click="openKcalorie = !openKcalorie"
            :class="{ 'text-black hover:text-white hover:bg-[#236477] rounded-lg': !openKcalorie, 'rounded-b-none': openKcalorie }"
            :style="openKcalorie ? 'background-color: #236477; color: white;' : ''">
            <div class="flex flex-col">
                <span class="font-medium">Ideal Kcalorie</span>
                <span class="text-sm opacity-75">View Details</span>
            </div>
            <div class="text-white" x-show="openKcalorie">
                <span>Expand</span>
            </div>
        </button>
        <div x-show="openKcalorie" class="border-x border-b rounded-b-lg shadow-sm bg-white">
            <div class="p-4 text-black">Test content for Ideal Kcalorie.</div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const foodRecallForm = document.getElementById('foodRecallForm');
    if (foodRecallForm) {
        foodRecallForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Compile all textarea values into a single string, separated by tabs
            const fields = [
                foodRecallForm.elements['breakfast'].value,
                foodRecallForm.elements['am_snack'].value,
                foodRecallForm.elements['lunch'].value,
                foodRecallForm.elements['pm_snack'].value,
                foodRecallForm.elements['dinner'].value,
                foodRecallForm.elements['midnight_snack'].value
            ];
            // Remove commas and join with tabs
            const compiledRecall = fields.map(f => f.replace(/,/g, '').trim()).join('\t');

            const data = {
                nutrition_id: document.getElementById('nutrition_id').value,
                food_recall: compiledRecall,
                _token: foodRecallForm.querySelector('input[name="_token"]').value
            };

            fetch('/api/food-recall', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': data._token
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Food recall saved successfully!');
                    foodRecallForm.reset();
                    // Hide the modal (Bootstrap 5)
                    const modal = bootstrap.Modal.getInstance(document.getElementById('foodRecallModal'));
                    if (modal) modal.hide();
                } else {
                    alert('Failed to save food recall.');
                }
            })
            .catch(() => {
                alert('An error occurred while saving.');
            });
        });
    }
});
</script>