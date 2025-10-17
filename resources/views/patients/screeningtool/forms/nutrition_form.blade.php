<div class="bg-white rounded-xl shadow-lg w-full p-8 relative"">
	<form id="nutrition-form">
		@csrf
		<input type="hidden" name="patient_id" value="{{ $patient->id }}">
		<input type="hidden" name="consultation_id" id="nutrition_consultation_id" value="">
		<h2 class="text-2xl font-bold mb-2">Short Healthy Eating Index (SHEI-22)</h2>
		<p class="mb-4 text-gray-600">This survey estimates overall diet quality; higher scores mean healthier patterns.</p>
		<!-- Score Selector -->
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">1. (Fruits) On average, how many servings of fruit (not including juice) do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg justify-center">
				<label><input type="radio" name="fruit" value="1" class="mr-1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit" value="2" class="mr-1"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit" value="3" class="mr-1"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit" value="4" class="mr-1"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit" value="5" class="mr-1"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit" value="6" class="mr-1"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit" value="7" class="mr-1"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit" value="na" class="mr-1"> Choose Not to Answer</label>
			</div>
		</div>
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">2. (Fruit Juice) On average, how many servings of 100% fruit juice do you drink per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg justify-center">
				<label><input type="radio" name="fruit_juice" value="1" class="mr-1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit_juice" value="2" class="mr-1"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit_juice" value="3" class="mr-1"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit_juice" value="4" class="mr-1"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit_juice" value="5" class="mr-1"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit_juice" value="6" class="mr-1"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit_juice" value="7" class="mr-1"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="fruit_juice" value="na" class="mr-1"> Choose Not to Answer</label>
			</div>
		</div>
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">3. (Vegetables) On average, how many servings of vegetables do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg justify-center">
				<label><input type="radio" name="vegetables" value="1" class="mr-1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="vegetables" value="2" class="mr-1"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="vegetables" value="3" class="mr-1"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="vegetables" value="4" class="mr-1"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="vegetables" value="5" class="mr-1"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="vegetables" value="6" class="mr-1"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="vegetables" value="7" class="mr-1"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="vegetables" value="na" class="mr-1"> Choose Not to Answer</label>
			</div>
		</div>
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">4. (Green Vegetables) On average, how many servings of green vegetables do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="green_vegetables" value="1" class="mr-1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="green_vegetables" value="2" class="mr-1"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="green_vegetables" value="3" class="mr-1"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="green_vegetables" value="4" class="mr-1"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="green_vegetables" value="5" class="mr-1"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="green_vegetables" value="6" class="mr-1"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="green_vegetables" value="7" class="mr-1"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="green_vegetables" value="na" class="mr-1"> Choose Not to Answer</label>
			</div>
		</div>
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">5. (Starchy Vegetables) On average, how many servings of starchy vegetables do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="starchy_vegetables" value="1" class="mr-1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="starchy_vegetables" value="2" class="mr-1"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="starchy_vegetables" value="3" class="mr-1"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="starchy_vegetables" value="4" class="mr-1"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="starchy_vegetables" value="5" class="mr-1"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="starchy_vegetables" value="6" class="mr-1"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="starchy_vegetables" value="7" class="mr-1"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="starchy_vegetables" value="na" class="mr-1"> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">6. (Grains) On average, how many servings of grains do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="grains" value="1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains" value="2"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains" value="3"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains" value="4"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains" value="5"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains" value="6"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains" value="7"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6" id="grains2-question" style="display: none;">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">7. (Grains 2) On average, how often do you eat grains?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-1 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg justify-center">
				<label><input type="radio" name="grains_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains_frequency" value="never"> Never</label>&nbsp;&nbsp;
				<label><input type="radio" name="grains_frequency" value="N/A" checked> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">8. (Whole Grains) On average, how many servings of whole grains do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="whole_grains" value="1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains" value="2"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains" value="3"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains" value="4"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains" value="5"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains" value="6"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains" value="7"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6" id="whole-grains2-question" style="display: none;">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">9. (Whole Grains 2) On average, how often do you eat whole grains?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-1 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg justify-center">
				<label><input type="radio" name="whole_grains_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains_frequency" value="never"> Never</label>&nbsp;&nbsp;
				<label><input type="radio" name="whole_grains_frequency" value="N/A" checked> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">10. (Milk) On average, how many servings of milk do you eat or drink per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="milk" value="1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk" value="2"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk" value="3"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk" value="4"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk" value="5"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk" value="6"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk" value="7"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6" id="milk2-question" style="display: none;">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">11. (Milk 2) On average, how often do you drink or eat milk products?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-1 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="milk_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk_frequency" value="never"> Never</label>&nbsp;&nbsp;
				<label><input type="radio" name="milk_frequency" value="N/A" checked> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">12. (Low-Fat Milk) On average, how many servings of low-fat milk products do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="low_fat_milk" value="1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk" value="2"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk" value="3"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk" value="4"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk" value="5"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk" value="6"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk" value="7"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6" id="low-fat-milk2-question" style="display: none;">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">13. (Low-Fat Milk 2) On average, how often do you drink or eat low-fat milk products?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-1 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg">
				<label><input type="radio" name="low_fat_milk_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk_frequency" value="never"> Never</label>&nbsp;&nbsp;
				<label><input type="radio" name="low_fat_milk_frequency" value="N/A" checked> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">14. (Beans) On average, how many servings of beans (legumes) do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="beans" value="1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="beans" value="2"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="beans" value="3"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="beans" value="4"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="beans" value="5"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="beans" value="6"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="beans" value="7"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="beans" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">15. (Nuts & Seeds) On average, how many servings of nuts or seeds do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="nuts_seeds" value="1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="nuts_seeds" value="2"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="nuts_seeds" value="3"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="nuts_seeds" value="4"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="nuts_seeds" value="5"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="nuts_seeds" value="6"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="nuts_seeds" value="7"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="nuts_seeds" value="na"> Choose Not to Answer</label>
			</div>
		</div>
		
		<!-- Question 16 -->
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">16. (Seafood) On average, how many servings of seafood do you eat per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="seafood" value="1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood" value="2"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood" value="3"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood" value="4"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood" value="5"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood" value="6"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood" value="7"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<!-- Question 17 -->
		<div class="mb-6" id="seafood2-question" style="display: none;">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">17. (Seafood 2) On average, how often do you eat seafood?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-1 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="seafood_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood_frequency" value="never"> Never</label>&nbsp;&nbsp;
				<label><input type="radio" name="seafood_frequency" value="N/A" checked> Choose Not to Answer</label>
			</div>
		</div>

		<!-- Question 18 -->
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">18. (SSB) On average, how many sugar-sweetened beverages do you drink per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="ssb" value="1"> &lt;1</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb" value="2"> 1</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb" value="3"> 2</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb" value="4"> 3</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb" value="5"> 4</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb" value="6"> 5</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb" value="7"> &gt;6</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<!-- Question 19 -->
		<div class="mb-6" id="ssb2-question" style="display: none;">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">19. (SSB2) On average, how often do you drink sugar-sweetened beverages?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-1 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="ssb_frequency" value="weekly"> A couple times per week</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb_frequency" value="monthly"> A couple times per month</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb_frequency" value="yearly"> A couple times per year</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb_frequency" value="almost_never"> Almost never</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb_frequency" value="never"> Never</label>&nbsp;&nbsp;
				<label><input type="radio" name="ssb_frequency" value="N/A" checked> Choose Not to Answer</label>
			</div>
		</div>

		<!-- Question 20 -->
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">20. (Added Sugars) On average, how much added sugar do you consume per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="added_sugars" value="none"> None / Almost None</label>&nbsp;&nbsp;
				<label><input type="radio" name="added_sugars" value="some"> Some</label>&nbsp;&nbsp;
				<label><input type="radio" name="added_sugars" value="a_lot"> A Lot</label>&nbsp;&nbsp;
				<label><input type="radio" name="added_sugars" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<!-- Question 21 -->
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">21. (Saturated Fat) How many servings of saturated fat do you consume on average per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="saturated_fat" value="none"> None / Almost None</label>&nbsp;&nbsp;
				<label><input type="radio" name="saturated_fat" value="some"> Some</label>&nbsp;&nbsp;
				<label><input type="radio" name="saturated_fat" value="a_lot"> A Lot</label>&nbsp;&nbsp;
				<label><input type="radio" name="saturated_fat" value="na"> Choose Not to Answer</label>
			</div>
		</div>

		<!-- Question 22 -->
		<div class="mb-6">
			<div class="w-full bg-white flex items-center justify-between px-2 py-2 rounded-t-lg border-b border-gray-200">
				<label class="block mb-0 font-semibold text-gray-800">22. (Water) On average, how much water do you drink per day?</label>
				<span class="ml-2 flex-shrink-0">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-circle text-gray-400" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
						<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94"/>
					</svg>
				</span>
			</div>
			<div class="flex gap-2 flex-wrap w-full bg-gray-100 p-2 rounded-b-lg  justify-center">
				<label><input type="radio" name="water" value="none"> None / Almost None</label>&nbsp;&nbsp;
				<label><input type="radio" name="water" value="some"> Some</label>&nbsp;&nbsp;
				<label><input type="radio" name="water" value="a_lot"> A Lot</label>&nbsp;&nbsp;
				<label><input type="radio" name="water" value="na"> Choose Not to Answer</label>
			</div>
		</div>
		<!-- Submit Button -->
		<div class="flex justify-end mt-8">
			<button type="submit" class="bg-[#4A6C2F] text-white px-6 py-2 rounded-full flex items-center gap-2 font-semibold">
				Save
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
					<path d="M11 2H9v3h2z"/>
					<path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
				</svg>
			</button>
		</div>
	</form>
</div>

<script>
    document.querySelectorAll('input[name="grains"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var grains2Question = document.getElementById('grains2-question');
        grains2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="whole_grains"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var wholeGrains2Question = document.getElementById('whole-grains2-question');
        wholeGrains2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="milk"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var milk2Question = document.getElementById('milk2-question');
        milk2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="low_fat_milk"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var lowFatMilk2Question = document.getElementById('low-fat-milk2-question');
        lowFatMilk2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="seafood"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var seafood2Question = document.getElementById('seafood2-question');
        seafood2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

document.querySelectorAll('input[name="ssb"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        var ssb2Question = document.getElementById('ssb2-question');
        ssb2Question.style.display = this.value === "1" ? "block" : "none";
    });
});

// Handle form submission
document.getElementById('nutrition-form').addEventListener('submit', function(e) {
	e.preventDefault();

	// Set consultation_id from global or selected context if available
	var selectedConsultationId = null;
	if (window.consultationMode && document.getElementById('consultation_id')) {
		selectedConsultationId = document.getElementById('consultation_id').value;
	}
	if (selectedConsultationId) {
		document.getElementById('nutrition_consultation_id').value = selectedConsultationId;
	}

	const formData = new FormData(this);
	const data = Object.fromEntries(formData.entries());

	// Convert 'na' to null or handle as needed
	Object.keys(data).forEach(key => {
		if (data[key] === 'na') {
			data[key] = null;
		}
	});

	fetch('/nutrition/store', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
			'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			'Accept': 'application/json',
		},
		body: JSON.stringify(data)
	})
	.then(response => response.json())
	.then(data => {
		if (data.success) {
			// Dispatch event to notify parent component
			window.dispatchEvent(new CustomEvent('nutrition-form-saved', { detail: data.data }));
			// Show success message
			alert('Nutrition data saved successfully!');
		} else {
			alert('Error saving nutrition data: ' + (data.message || 'Unknown error'));
		}
	})
	.catch(error => {
		console.error('Error:', error);
		alert('Error saving nutrition data. Please try again.');
	});
});

</script>


