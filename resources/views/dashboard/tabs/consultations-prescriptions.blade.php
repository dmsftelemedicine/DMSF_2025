<div id="consultation-tab" class="tab-content hidden">
    <!-- Consultations and Prescriptions Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <!-- Consultation Trends -->
        <div>
            <h4 class="text-sm font-medium mb-2">Monthly Consultations</h4>
            <div class="h-40">
                <canvas id="consultationsChart"></canvas>
            </div>
        </div>

        <!-- Prescriptions Given -->
        <div>
            <h4 class="text-sm font-medium mb-2">Prescriptions Given</h4>
            <div class="h-40">
                <canvas id="prescriptionsChart"></canvas>
            </div>
        </div>

        <!-- Diagnostic Requests -->
        <div>
            <h4 class="text-sm font-medium mb-2">Monthly Diagnostic Requests</h4>
            <div class="h-40">
                <canvas id="diagnosticsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Larger Charts for Detailed Analysis -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Prescription Distribution -->
        <div>
            <h4 class="text-md font-medium mb-3">Prescription Trends</h4>
            <div class="h-64">
                <canvas id="prescriptionDistributionChart"></canvas>
            </div>
        </div>

        <!-- Diagnostic Types -->
        <div>
            <h4 class="text-md font-medium mb-3">Diagnostic Types</h4>
            <div class="h-64">
                <canvas id="diagnosticTypesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Latest Medicine Prescriptions Table -->
    <div class="mt-6">
        <h4 class="text-md font-medium mb-3">Latest Medicine Prescriptions</h4>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div id="latestMedicinesTable">
                <!-- Table will be populated by JavaScript -->
                <div class="text-center py-8 text-gray-500">
                    <p>Loading latest prescriptions...</p>
                </div>
            </div>
        </div>
    </div>
</div>
