<h2 class="text-xl font-bold mb-2">Nutrition</h2>
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
            init() {
                window.addEventListener('nutrition-form-saved', () => {
                    this.showForm = false;
                    // Refresh nutrition data after save
                    this.loadLatestNutrition();
                });
                // Load nutrition data on init
                this.loadLatestNutrition();
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
                        // Populate score
                        this.nutritionFormScore = data.dq_score;
                        // Populate details
                        document.getElementById('nutrition-fruit').textContent = data.fruit || '--';
                        document.getElementById('nutrition-fruit-juice').textContent = data.fruit_juice || '--';
                        document.getElementById('nutrition-vegetables').textContent = data.vegetables || '--';
                        document.getElementById('nutrition-green-vegetables').textContent = data.green_vegetables || '--';
                        document.getElementById('nutrition-starchy-vegetables').textContent = data.starchy_vegetables || '--';
                        document.getElementById('nutrition-beans').textContent = data.beans || '--';
                        document.getElementById('nutrition-nuts-seeds').textContent = data.nuts_seeds || '--';
                        document.getElementById('nutrition-seafood').textContent = data.seafood || '--';
                        document.getElementById('nutrition-seafood-frequency').textContent = data.seafood_frequency || '--';
                        document.getElementById('nutrition-grains').textContent = data.grains || '--';
                        document.getElementById('nutrition-grains-frequency').textContent = data.grains_frequency || '--';
                        document.getElementById('nutrition-whole-grains').textContent = data.whole_grains || '--';
                        document.getElementById('nutrition-whole-grains-frequency').textContent = data.whole_grains_frequency || '--';
                        document.getElementById('nutrition-milk').textContent = data.milk || '--';
                        document.getElementById('nutrition-milk-frequency').textContent = data.milk_frequency || '--';
                        document.getElementById('nutrition-low-fat-milk').textContent = data.low_fat_milk || '--';
                        document.getElementById('nutrition-low-fat-milk-frequency').textContent = data.low_fat_milk_frequency || '--';
                        document.getElementById('nutrition-ssb').textContent = data.ssb || '--';
                        document.getElementById('nutrition-ssb-frequency').textContent = data.ssb_frequency || '--';
                        document.getElementById('nutrition-water').textContent = data.water || '--';
                        document.getElementById('nutrition-added-sugars').textContent = data.added_sugars || '--';
                    } else {
                        this.nutritionFormScore = null;
                        // Reset all spans to '--'
                        const spans = document.querySelectorAll('[id^="nutrition-"]');
                        spans.forEach(span => span.textContent = '--');
                    }
                })
                .catch(error => {
                    console.error('Error loading nutrition data:', error);
                    this.nutritionFormScore = null;
                });
            },
            patientId: {{ $patient->id ?? 'null' }},
            consultationId: {{ $consultation->id ?? 'null' }},
            nutritionFormScore: null
        }));
    });
</script>

<div class="w-full" x-data="nutritionTab" x-init="init()">
    <!-- Accordion Header -->
    <button class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-[#236477] text-left transition-colors rounded-t-lg" 
            @click="open = !open"
            :class="{ 'text-black hover:text-white hover:bg-[#236477] rounded-lg': !open, 'rounded-b-none': open }"
            :style="open ? 'background-color: #236477; color: white;' : ''">
        
        <!-- Left side content -->
        <div class="flex flex-col">
            <span class="font-medium">Short Healthy Eating Index (SHEI-22)</span>
            <span class="text-sm opacity-75">View Details</span>
        </div>

        <!-- Right side score -->
        <div class="text-white" x-show="open">
            <template x-if="nutritionFormScore !== null">
                <span>Score: <span x-text="nutritionFormScore"></span></span>
            </template>
            <template x-if="nutritionFormScore === null">
                <span>Score: N/A</span>
            </template>
        </div>
    </button>

    <!-- Tab Panel Content -->
    <div x-show="open" class="border-x border-b rounded-b-lg shadow-sm bg-white">
        <template x-if="!showForm">
            <div>
                <div class="flex flex-row items-center justify-between p-4">
                    <div>
                        <p>This survey estimates overall diet quality; higher scores mean healthier patterns.</p>
                    </div>
                    <div>
                        <button type="button" class="text-white px-4 py-2 rounded-full shadow transition-colors flex items-center justify-center gap-2 text-center"
                            style="background-color: #4A6C2F;"
                            @click="showForm = true">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                <span class="ml-1">Add intake</span>
                            </span>
                        </button>
                    </div>
                </div>
                <!-- Scoring Guide and Score Display -->
                <div class="flex flex-row mt-0 gap-4 px-4 mb-4">
                    <div class="w-3/4 rounded-xl bg-[#f7f6f2] h-[250px] flex items-center px-6 shadow-sm p-4 m-2">
                        <!-- Scoring Guide -->
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Scoring guide:</h3>
                            <div class="text-sm text-gray-700 mb-4">
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

                <!-- Nutrition Details Card Grid -->
                <div x-show="nutritionFormScore !== null" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6 mb-8 px-4">
                    <!-- Fruits & Vegetables -->
                    <div class="rounded-xl p-5" style="background-color: #f7f6f2;">
                        <h6 class="font-bold mb-2">🍎 Fruits & Vegetables</h6>
                        <div class="flex flex-col gap-1 text-sm pl-6">
                            <div class="flex justify-between"><span>Fruit Consumption</span><span id="nutrition-fruit" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Fruit Juice</span><span id="nutrition-fruit-juice" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Vegetable Consumption</span><span id="nutrition-vegetables" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Green Vegetables</span><span id="nutrition-green-vegetables" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Starchy Vegetables</span><span id="nutrition-starchy-vegetables" class="font-semibold"></span></div>
                        </div>
                    </div>
                    <!-- Protein -->
                    <div class="rounded-xl p-5" style="background-color: #f7f6f2;">
                        <h6 class="font-bold mb-2">🥜 Protein</h6>
                        <div class="flex flex-col gap-1 text-sm pl-6">
                            <div class="flex justify-between"><span>Beans Consumption</span><span id="nutrition-beans" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Nuts & Seeds Consumption</span><span id="nutrition-nuts-seeds" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Seafood Consumption</span><span id="nutrition-seafood" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Seafood Frequency</span><span id="nutrition-seafood-frequency" class="font-semibold"></span></div>
                        </div>
                    </div>
                    <!-- Grains -->
                    <div class="rounded-xl p-5" style="background-color: #f7f6f2;">
                        <h6 class="font-bold mb-2">🌾 Grains</h6>
                        <div class="flex flex-col gap-1 text-sm pl-6">
                            <div class="flex justify-between"><span>Grain Consumption</span><span id="nutrition-grains" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Grain Frequency</span><span id="nutrition-grains-frequency" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Whole Grain Consumption</span><span id="nutrition-whole-grains" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Whole Grain Frequency</span><span id="nutrition-whole-grains-frequency" class="font-semibold"></span></div>
                        </div>
                    </div>
                    <!-- Dairy -->
                    <div class="rounded-xl p-5" style="background-color: #f7f6f2;">
                        <h6 class="font-bold mb-2">🥛 Dairy</h6>
                        <div class="flex flex-col gap-1 text-sm pl-6">
                            <div class="flex justify-between"><span>Milk Consumption</span><span id="nutrition-milk" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Milk Frequency</span><span id="nutrition-milk-frequency" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Low-Fat Milk Consumption</span><span id="nutrition-low-fat-milk" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Low-Fat Milk Frequency</span><span id="nutrition-low-fat-milk-frequency" class="font-semibold"></span></div>
                        </div>
                    </div>
                    <!-- Beverages -->
                    <div class="rounded-xl p-5" style="background-color: #f7f6f2;">
                        <h6 class="font-bold mb-2">🥤 Beverages</h6>
                        <div class="flex flex-col gap-1 text-sm pl-6">
                            <div class="flex justify-between"><span>Sugar-Sweetened Beverages</span><span id="nutrition-ssb" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Sugar-Sweetened Frequency</span><span id="nutrition-ssb-frequency" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Water Consumption</span><span id="nutrition-water" class="font-semibold"></span></div>
                        </div>
                    </div>
                    <!-- Limit These -->
                    <div class="rounded-xl p-5" style="background-color: #f7f6f2;">
                        <h6 class="font-bold mb-2">⚠️ Limit These</h6>
                        <div class="flex flex-col gap-1 text-sm pl-6">
                            <div class="flex justify-between"><span>Added Sugars</span><span id="nutrition-added-sugars" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Sugar-Sweetened Frequency</span><span id="nutrition-ssb-frequency" class="font-semibold"></span></div>
                            <div class="flex justify-between"><span>Water Consumption</span><span id="nutrition-water" class="font-semibold"></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template x-if="showForm">
            <div>
                @include('patients.screeningtool.forms.nutrition_form')
            </div>
        </template>
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
        <div x-show="openRecall" class="border-x border-b rounded-b-lg shadow-sm bg-white">
            <div class="p-4 text-black">Test content for 24-hr Food Recall.</div>
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