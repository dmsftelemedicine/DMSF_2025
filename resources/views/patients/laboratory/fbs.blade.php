<div class="mt-6 p-4 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-bold">Add Fasting Blood Sugar (FBS) Result</h2>

    <!-- Display errors if there are any -->
    @if ($errors->any())
        <div class="text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patients.laboratory.store', $patient->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Date</label>
            <input type="date" name="date" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">FBS Level (mg/dL)</label>
            <input type="number" step="0.1" name="fbs_level" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-bold rounded-lg shadow-md hover:bg-blue-600">
            Submit FBS Result
        </button>
    </form>
</div>
