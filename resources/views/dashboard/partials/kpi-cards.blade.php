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
