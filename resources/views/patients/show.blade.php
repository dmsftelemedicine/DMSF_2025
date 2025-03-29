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
                <div class="col-md-3 text-left border-end">
                    <a href="{{ route('patients.index') }}">
                        <button type="button" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </button>
                    </a>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Edit Patient</a>
                    <h5 class="fw-bold mb-1 mt-5 text-center">
                        {{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}
                    </h5>
                    <p class="text-muted mb-2 text-center">{{ $patient->email }}</p>
                </div>

                <!-- Right Section -->
                <div class="col-md-9" style="border-left: 1px solid black;">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Gender</p>
                            <p class="fw-bold">{{ $patient->gender }}</p>
                        </div>
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Age</p>
                            <p class="fw-bold">{{ $patient->age }}</p>
                        </div>
                        <div class="col-4 mb-3">
                            <p class="text-muted mb-1">Blood</p>
                            <p class="fw-bold">{{ $patient->blood_type }}</p>
                        </div>
                        <div class="col-4">
                            <p class="text-muted mb-1">Marital Status</p>
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
        <br/>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="laboratory-tab" data-bs-toggle="tab" data-bs-target="#laboratory-tab-pane" type="button" role="tab" aria-controls="laboratory-tab-pane" aria-selected="true">Laboratory</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Screening Tool</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="laboratory-tab-pane" role="tabpanel" aria-labelledby="laboratory-tab" tabindex="0">
                <br/>
                @include('patients.laboratory.laboratory', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <br/>
                @include('patients.screeningtool.screeningtool', ['patient' => $patient])
            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
        </div>
    </div>


     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>

php artisan make:migration create_telemedicine_perception_table
