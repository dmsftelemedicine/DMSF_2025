<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Loading State -->
            <div id="dashboard-loading" class="flex justify-center items-center h-64 mb-8">
                <div class="text-center">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                    <p class="mt-2 text-gray-600">Loading dashboard...</p>
                </div>
            </div>

            <!-- Dashboard Content (initially hidden) -->
            <div id="dashboard-content" style="display: none;">
                <!-- KPI Cards -->
                @include('dashboard.partials.kpi-cards')

                <!-- Chart Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">{{ __("Analytics Overview") }}</h3>
                        
                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200 mb-6">
                            <nav class="-mb-px flex space-x-8">
                                <button onclick="switchTab('patient-tab')" id="patient-tab-btn" class="tab-button active whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                    Patient Demographics
                                </button>
                                <button onclick="switchTab('consultation-tab')" id="consultation-tab-btn" class="tab-button whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                                    Consultations & Prescriptions
                                </button>
                            </nav>
                        </div>

                        <!-- Patient Demographics Tab -->
                        @include('dashboard.tabs.patient-demographics')

                        <!-- Consultations & Prescriptions Tab -->
                        @include('dashboard.tabs.consultations-prescriptions')
                    </div>
                </div>
            </div> <!-- End dashboard-content -->
        </div>
    </div>

    @include('dashboard.scripts.main-scripts')
    @include('dashboard.scripts.demographics-charts')
    @include('dashboard.scripts.consultation-charts')
</x-app-layout>
