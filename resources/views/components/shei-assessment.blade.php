
@if(empty($nutritionFormScore))
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl mx-auto p-8 relative" style="max-height: 90vh; overflow-y: auto;">
        <h2 class="text-2xl font-bold mb-2">Short Healthy Eating Index (SHEI-22)</h2>
        <p class="mb-4 text-gray-600">This survey estimates overall diet quality; higher scores mean healthier patterns.</p>
        <form>
            {{-- Fruits --}}
            <div class="mb-6">
                <label class="block font-semibold mb-2">1. (Fruits) On average, how many servings of fruit (not including juice) do you eat per day?</label>
                <x-shei-answer-group :answers="['<1', '1', '2', '3', '4', '5', '>6', 'Choose Not to Answer']" />
            </div>

            {{-- Fruit Juice --}}
            <div class="mb-6">
                <label class="block font-semibold mb-2">2. (Fruit Juice) On average, how many servings of 100% fruit juice do you drink per day?</label>
                <x-shei-answer-group :answers="['<1', '1', '2', '3', '4', '5', '>6', 'Choose Not to Answer']" />
            </div>

            {{-- Vegetables --}}
            <div class="mb-6">
                <label class="block font-semibold mb-2">3. (Vegetables) On average, how many servings of vegetables do you eat per day?</label>
                <x-shei-answer-group :answers="['<1', '1', '2', '3', '4', '5', '>6', 'Choose Not to Answer']" />
            </div>

            {{-- Green Vegetables --}}
            <div class="mb-6">
                <label class="block font-semibold mb-2">4. (Green Vegetables) On average, how many servings of green vegetables do you eat per day?</label>
                <x-shei-answer-group :answers="['<1', '1', '2', '3', '4', '5', '>6', 'Choose Not to Answer']" />
            </div>

            {{-- Starchy Vegetables --}}
            <div class="mb-6">
                <label class="block font-semibold mb-2">5. (Starchy Vegetables) On average, how many servings of starchy vegetables do you eat per day?</label>
                <x-shei-answer-group :answers="['<1', '1', '2', '3', '4', '5', '>6', 'Choose Not to Answer']" />
            </div>

            {{-- Grains --}}
            <div class="mb-6">
                <label class="block font-semibold mb-2">6. (Grains) On average, how many servings of grains do you eat per day?</label>
                <x-shei-answer-group :answers="['<1', '1', '2', '3', '4', '5', '>6', 'Choose Not to Answer']" />
            </div>
            {{-- ...continue for all other nutrition questions as in nutrition_form.blade.php... --}}
            <!-- ...repeat for all questions, use image as reference for layout... -->

            <div class="flex justify-end mt-8">
                <button type="submit" class="bg-[#4A6C2F] text-white px-6 py-2 rounded-full flex items-center gap-2 font-semibold">
                    Save
                    <!-- Floppy Disk Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                        <path d="M11 2H9v3h2z"/>
                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
@endif
