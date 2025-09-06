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
                <!-- Date Range Filter -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                            <h3 class="text-lg font-semibold text-gray-900">Dashboard Analytics</h3>
                            
                            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                                <!-- Quick Filters -->
                                <div class="flex flex-wrap gap-2">
                                    <button onclick="setDateRange('currentMonth')" 
                                            class="date-filter-btn px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors">
                                        Current Month
                                    </button>
                                    <button onclick="setDateRange('last3Months')" 
                                            class="date-filter-btn px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors">
                                        Last 3 Months
                                    </button>
                                    <button onclick="setDateRange('currentYear')" 
                                            class="date-filter-btn active px-3 py-1 text-sm bg-blue-500 text-white rounded-md transition-colors">
                                        Current Year
                                    </button>
                                    <button onclick="setDateRange('lastYear')" 
                                            class="date-filter-btn px-3 py-1 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors">
                                        Last Year
                                    </button>
                                </div>
                                
                                <!-- Custom Date Range -->
                                <div class="flex items-center space-x-2">
                                    <input type="date" id="startDate" class="px-3 py-1 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <span class="text-gray-500">to</span>
                                    <input type="date" id="endDate" class="px-3 py-1 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <button onclick="applyCustomDateRange()" 
                                            class="px-4 py-1 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Current Date Range Display -->
                        <div class="mt-2">
                            <span class="text-sm text-gray-500">Showing data for: </span>
                            <span id="currentDateRange" class="text-sm font-medium text-gray-700">Current Year (2025)</span>
                        </div>
                    </div>
                </div>

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
