<x-app-layout>
    <div class="container py-4">
        <!-- Form Container with Border and Shadow -->
        <div class="card shadow-lg p-4 border">
            <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                @csrf
                @method('PUT')

                <legend>Edit Patient Details</legend>
                <hr>

                <!-- First Row: Personal Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name', $patient->first_name) }}" required>
                            @error('first_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name', $patient->last_name) }}" required>
                            @error('last_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name" value="{{ old('middle_name', $patient->middle_name) }}">
                            @error('middle_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Second Row: Health Information -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{ old('birth_date', $patient->birth_date) }}" required>
                            @error('birth_date')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="blood_type">Blood Type</label>
                            <select name="blood_type" id="blood_type" class="form-control @error('blood_type') is-invalid @enderror" required>
                                <option value="">Select Blood Type</option>
                                <option value="A+" {{ old('blood_type', $patient->blood_type) == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_type', $patient->blood_type) == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_type', $patient->blood_type) == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_type', $patient->blood_type) == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_type', $patient->blood_type) == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_type', $patient->blood_type) == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_type', $patient->blood_type) == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_type', $patient->blood_type) == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                            @error('blood_type')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <!-- Marital Status Field -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror" required>
                                <option value="">Select Marital Status</option>
                                <option value="single" {{ old('marital_status', $patient->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ old('marital_status', $patient->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                <option value="divorced" {{ old('marital_status', $patient->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="widowed" {{ old('marital_status', $patient->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                            </select>
                            @error('marital_status')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="diagnosis">Diagnosis</label>
                            <textarea class="form-control @error('diagnosis') is-invalid @enderror" 
                                      name="diagnosis" id="diagnosis" rows="4" required>{{ old('diagnosis', $patient->diagnosis) }}</textarea>
                            @error('diagnosis')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <legend>Address Information</legend>
                <hr>

                <!-- Address Fields -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="house_no">House No</label>
                            <input type="text" class="form-control" name="house_no" id="house_no" value="{{ old('house_no', $patient->house_no) }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" name="street" id="street" value="{{ old('street', $patient->street) }}" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" name="province" id="province" class="form-control" value="{{ old('province', $patient->province) }}" required>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city_municipality">City/Municipality</label>
                            <input type="text" name="city_municipality" id="city_municipality" class="form-control" value="{{ old('city_municipality', $patient->city_municipality) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="barangay">Barangay</label>
                            <input type="text" name="barangay" id="barangay" class="form-control" value="{{ old('barangay', $patient->barangay) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" class="form-control" name="zip_code" id="zip_code" value="{{ old('zip_code', $patient->zip_code) }}">
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <legend>Other Information</legend>
                <hr>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="height">Height (cm)</label>
                            <input type="text" class="form-control" name="height" id="height" value="{{ old('height', $patient->height) }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="weight">Weight (kg)</label>
                            <input type="text" class="form-control" name="weight_kg" id="weight_kg" value="{{ old('weight_kg', $patient->weight_kg) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" class="form-control" name="occupation" id="occupation" value="{{ old('occupation', $patient->occupation) }}">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary mt-4">Update Patient</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
