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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Patients -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-users text-3xl text-blue-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total Patients</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $totalPatients }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Consultations -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-calendar-check text-3xl text-green-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total Consultations</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $totalConsultations }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Patients This Month -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-plus text-3xl text-purple-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">New Patients This Month</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $newPatientsThisMonth }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Consultations This Month -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-stethoscope text-3xl text-orange-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Consultations This Month</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $consultationsThisMonth }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <h3 class="text-lg font-semibold mb-3">{{ __("Analytics Overview") }}</h3>
                    
                    <!-- Top Row: Monthly Patients (full width) -->
                    <div class="mb-4">
                        <h4 class="text-sm font-medium mb-2">Monthly Patient Registrations</h4>
                        <div class="h-48">
                            <canvas id="patientsChart"></canvas>
                        </div>
                    </div>

                    <!-- Middle Row: Three smaller charts -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- Medications Prescribed Chart (Donut) -->
                        <div>
                            <h4 class="text-sm font-medium mb-2">Prescriptions</h4>
                            <div class="h-40">
                                <canvas id="medicationsChart"></canvas>
                            </div>
                        </div>

                        <!-- Diagnostic Requests Chart (Bar) -->
                        <div>
                            <h4 class="text-sm font-medium mb-2">Diagnostic Requests</h4>
                            <div class="h-40">
                                <canvas id="diagnosticsChart"></canvas>
                            </div>
                        </div>

                        <!-- Diabetes Cases Chart (Pie) -->
                        <div>
                            <h4 class="text-sm font-medium mb-2">Diabetes Cases</h4>
                            <div class="h-40">
                                <canvas id="diabetesChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Row: Combined Chart -->
                    <div>
                        <h4 class="text-sm font-medium mb-2">Combined Patient Metrics</h4>
                        <div class="h-48">
                            <canvas id="combinedChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            </div> <!-- End dashboard-content -->
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Hide loading and show content when page loads
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('dashboard-loading').style.display = 'none';
            document.getElementById('dashboard-content').style.display = 'block';
        });

        // Get data passed from the controller
        const monthlyPatientsData = @json($monthlyPatientsData);
        const prescribedCount = {{ $prescribedCount }};
        const notPrescribedCount = {{ $notPrescribedCount }};
        const diagnosticRequests = {{ $diagnosticRequests }};
        const noDiagnosticRequests = {{ $noDiagnosticRequests }};
        const diabeticPatients = {{ $diabeticPatients }};
        const nonDiabeticPatients = {{ $nonDiabeticPatients }};

        // 1. Patient Registrations Chart (Line)
        const patientsCtx = document.getElementById('patientsChart').getContext('2d');
        new Chart(patientsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'New Patients',
                    data: monthlyPatientsData,
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: 10 } }
                    },
                    x: {
                        ticks: { font: { size: 10 } }
                    }
                },
                plugins: {
                    title: { display: false },
                    legend: { display: false }
                }
            }
        });

        // 2. Medications Prescribed Chart (Donut)
        const medicationsCtx = document.getElementById('medicationsChart').getContext('2d');
        new Chart(medicationsCtx, {
            type: 'doughnut',
            data: {
                labels: ['Prescribed', 'Not Prescribed'],
                datasets: [{
                    data: [prescribedCount, notPrescribedCount],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(156, 163, 175, 0.8)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(156, 163, 175, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: { display: false },
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 10 }, padding: 10 }
                    }
                }
            }
        });

        // 3. Diagnostic Requests Chart (Bar)
        const diagnosticsCtx = document.getElementById('diagnosticsChart').getContext('2d');
        new Chart(diagnosticsCtx, {
            type: 'bar',
            data: {
                labels: ['With Requests', 'No Requests'],
                datasets: [{
                    label: 'Patients',
                    data: [diagnosticRequests, noDiagnosticRequests],
                    backgroundColor: [
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(203, 213, 225, 0.8)'
                    ],
                    borderColor: [
                        'rgba(168, 85, 247, 1)',
                        'rgba(203, 213, 225, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: 10 } }
                    },
                    x: {
                        ticks: { font: { size: 10 } }
                    }
                },
                plugins: {
                    title: { display: false },
                    legend: { display: false }
                }
            }
        });

        // 4. Diabetes Cases Chart (Pie)
        const diabetesCtx = document.getElementById('diabetesChart').getContext('2d');
        new Chart(diabetesCtx, {
            type: 'pie',
            data: {
                labels: ['Diabetic', 'Non-Diabetic'],
                datasets: [{
                    data: [diabeticPatients, nonDiabeticPatients],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(34, 197, 94, 0.8)'
                    ],
                    borderColor: [
                        'rgba(239, 68, 68, 1)',
                        'rgba(34, 197, 94, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: { display: false },
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 10 }, padding: 10 }
                    }
                }
            }
        });

        // 5. Combined Stacked Bar Chart
        const combinedCtx = document.getElementById('combinedChart').getContext('2d');
        new Chart(combinedCtx, {
            type: 'bar',
            data: {
                labels: ['Prescriptions', 'Diagnostics', 'Diabetes'],
                datasets: [{
                    label: 'Yes/Have',
                    data: [prescribedCount, diagnosticRequests, diabeticPatients],
                    backgroundColor: 'rgba(34, 197, 94, 0.8)',
                    borderColor: 'rgba(34, 197, 94, 1)',
                    borderWidth: 1
                }, {
                    label: 'No/None',
                    data: [notPrescribedCount, noDiagnosticRequests, nonDiabeticPatients],
                    backgroundColor: 'rgba(156, 163, 175, 0.8)',
                    borderColor: 'rgba(156, 163, 175, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { 
                        stacked: true,
                        ticks: { font: { size: 10 } }
                    },
                    y: { 
                        stacked: true,
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: 10 } }
                    }
                },
                plugins: {
                    title: { display: false },
                    legend: {
                        position: 'top',
                        labels: { font: { size: 10 }, padding: 10 }
                    }
                }
            }
        });
    </script>
</x-app-layout>
