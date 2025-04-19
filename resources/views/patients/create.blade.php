<x-app-layout>
    <div class="container py-4">
        <!-- Form Container with Border and Shadow -->
        <div class="card shadow-lg p-4 border">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf

                <legend>Patient Details</legend>
                <hr>
                <!-- First Row: Personal Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
                            @error('middle_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Fourth Row: Health Information -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
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
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
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
                                <option value="A+" {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                            @error('blood_type')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Fourth Row: Health Information -->
                <div class="row mb-4">
                    <!-- Marital Status Field -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror" required>
                                <option value="">Select Marital Status</option>
                                <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
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
                                      name="diagnosis" id="diagnosis" rows="4" required>{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <legend>Patient Address</legend>
                <hr>
                <!-- Second Row: Address Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="house_no">House No</label>
                            <input type="text" class="form-control @error('house_no') is-invalid @enderror" name="house_no" id="house_no" value="{{ old('house_no') }}" required>
                            @error('house_no')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="street">Street</label>
                            <input type="text" class="form-control @error('street') is-invalid @enderror" name="street" id="street" value="{{ old('street') }}" required>
                            @error('street')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form-group">
                            <label for="barangay">Barangay</label>
                            <input type="text" name="barangay" id="barangay" class="form-control @error('barangay') is-invalid @enderror" value="{{ old('barangay') }}" placeholder="Enter Barangay" required>
                            @error('barangay')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    

                    
                </div>

                <!-- Third Row: More Address Information -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city_municipality">City/Municipality</label>
                            <input type="text" name="city_municipality" id="city_municipality" class="form-control @error('city') is-invalid @enderror" value="{{ old('city_municipality') }}" placeholder="Enter City/Municipality" required>
                            <input type="hidden" id="city_code">
                            @error('city_municipality')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" name="province" id="province" class="form-control @error('province') is-invalid @enderror" value="{{ old('province') }}"  placeholder="Enter Province" required>
                            <input type="hidden" id="province_code">
                            @error('province')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zip_code">Zip Code</label>
                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" id="zip_code" value="{{ old('zip_code') }}">
                            @error('zip_code')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                
                <legend>Other Information</legend>
                <hr>
                <!-- Fifth Row: Additional Info -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="height">Height (meters)</label>
                            <input type="text" class="form-control @error('height') is-invalid @enderror" name="height" id="height" value="{{ old('height') }}">
                            @error('height')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="weight_kg">Weight (kg)</label>
                            <input type="text" class="form-control @error('weight_kg') is-invalid @enderror" name="weight_kg" id="weight_kg" value="{{ old('weight_kg') }}">
                            @error('weight_kg')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" id="occupation" value="{{ old('occupation') }}">
                            @error('occupation')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success mt-4">Save Patient</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
