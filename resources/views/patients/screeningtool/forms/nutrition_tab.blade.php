<h2 class="text-xl font-bold mb-4">Nutrition</h2>
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
            open: false,
            showForm: false,
            init() {
                window.addEventListener('nutrition-form-saved', () => {
                    this.showForm = false;
                });
            }
        }));
    });
</script>

<div class="w-full" x-data="nutritionTab" x-init="init()">
    <!-- Accordion Header -->
    <button class="w-full flex justify-between items-center p-4 bg-gray-100 hover:bg-gray-200 text-left transition-colors rounded-t-lg" 
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
            Score: {{ $nutritionFormScore ?? 'N/A' }}
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
                            class="h-[250px] w-full rounded-xl flex flex-col items-center justify-evenly text-center shadow-sm
                                @if($nutritionFormScore < 50 && $nutritionFormScore !== null)
                                    bg-red-100
                                @elseif($nutritionFormScore >= 50 && $nutritionFormScore < 80)
                                    bg-yellow-100
                                @elseif($nutritionFormScore === null)
                                    bg-gray-100
                                @else
                                    bg-green-100
                                @endif"
                        >
                            <span class="text-2xl font-semibold
                                @if($nutritionFormScore < 50 && $nutritionFormScore !== null)
                                    text-red-700
                                @elseif($nutritionFormScore >= 50 && $nutritionFormScore < 80)
                                    text-yellow-700
                                @elseif($nutritionFormScore >= 80)
                                    text-green-700
                                @elseif($nutritionFormScore === null)
                                    text-gray-700
                                @else
                                    text-green-700
                                @endif">SHEI-22 Score</span>
                            <span class="text-6xl font-bold
                                @if($nutritionFormScore < 50 && $nutritionFormScore !== null)
                                    text-red-700
                                @elseif($nutritionFormScore >= 50 && $nutritionFormScore < 80)
                                    text-yellow-700
                                @elseif($nutritionFormScore >= 80 && $nutritionFormScore <= 100)
                                    text-green-700
                                @elseif($nutritionFormScore === null)
                                    text-gray-700
                                @endif">
                                {{ $nutritionFormScore ?? '--.--' }}
                            </span>
                            <span class="text-xl font-medium
                                @if($nutritionFormScore < 50  && $nutritionFormScore !== null)
                                    text-red-700
                                @elseif($nutritionFormScore >= 50 && $nutritionFormScore < 80)
                                    text-yellow-700
                                @elseif($nutritionFormScore >= 80)
                                    text-green-700
                                @elseif($nutritionFormScore === null)
                                    text-gray-700
                                @else
                                    text-green-700
                                @endif">
                                @if($nutritionFormScore < 50 && $nutritionFormScore !== null)
                                    Poor diet quality
                                @elseif($nutritionFormScore >= 50 && $nutritionFormScore < 80)
                                    Moderate diet quality
                                @elseif($nutritionFormScore >= 80)
                                    High diet quality
                                @elseif($nutritionFormScore === null)
                                    N/A
                                @else
                                    High diet quality
                                @endif
                            </span>
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

</div>