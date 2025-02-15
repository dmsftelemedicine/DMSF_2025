<x-app-layout>
    <style type="text/css">
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>

    <div class="container mx-auto p-4">
        <div class="card shadow-lg p-4 border-0" style="width: 100%; border-radius: 2rem;">
            <div class="row g-4">
                <!-- Left Section (Profile Image & Basic Info) -->
                <div class="col-md-3 text-left border-end ">
                    <!-- <img src="{{ asset('images/default_picture.jpg') }}" class="rounded-circle mb-3 text-center max-w-1/3 max-h-1/4" style="max-height: 5rem; margin: auto; border: 1px solid;" alt="Profile"> -->
                    <a href="{{ route('patients.index') }}"> <button  type="button" class="btn btn-outline-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i></button></a>
                    <button class="btn btn-outline-danger btn-sm text-center" style="float:right;">Edit Profile</button>
                    <h5 class="fw-bold mb-1 mt-5" style="text-align: center;">{{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}</h5>
                    <p class="text-muted mb-2" style="text-align: center;">{{ $patient->email }}</p>
                    
                </div>

    
                <div class="col-md-9" style="border-left: 1px solid black;">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Gender</p>
                            <p class="fw-bold">{{ $patient->gender }}</p>
                        </div>
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Age</p>
                            <p class="fw-bold ">{{ $patient->age }}</p>
                        </div>
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Blood</p>
                            <p class="fw-bold">{{ $patient->blood_type }}</p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted mb-1">Martila Status</p>
                            <p class="fw-bold text-success">{{ $patient->marital_status }}</p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted mb-1">Height</p>
                            <p class="fw-bold">{{ $patient->height }}</p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted mb-1">Occupation</p>
                            <p class="fw-bold">{{ $patient->occupation }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <!-- Chart Section -->
                <div class="col-md-7 ">
                    <div class="card shadow-lg p-4 border-0">
                        <h5>Diabetics Results</h5>
                        
                    </div>
                </div>

                <!-- Appointment List -->
                <div class="col-md-5">
                    <div class="card shadow-lg p-4 border-0">
                        <h5>Prescription Lists</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
