<x-app-layout>
    <div class="container py-4">
        <!-- Form Container with Border and Shadow -->
        <div class="card shadow-lg p-4 border">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf

                <legend>Create Patient</legend>
                <hr>
                <!-- First Row: Personal Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reference_number">Reference Number</label>
                            <div class="d-flex gap-2">
                                <!-- Numeric part (read-only) -->
                                <input type="text" class="form-control @error('reference_number') is-invalid @enderror"
                                    name="reference_number_number" id="reference_number_number"
                                    value="{{ old('reference_number_number', $numericPart) }}" maxlength="5" placeholder="00001" readonly>

                                <!-- Suffix part (read-only) -->
                                <input type="text" class="form-control @error('reference_number_suffix') is-invalid @enderror"
                                    name="reference_number_suffix" id="reference_number_suffix"
                                    value="{{ old('reference_number_suffix', $suffixPart) }}" maxlength="3" placeholder="ABC" readonly>
                            </div>
                            @error('reference_number_number')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            @error('reference_number_suffix')
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
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
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

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birth_date">Birthdate</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
                            @error('birth_date')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" class="form-control" id="age" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sex</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            @error('gender')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <legend>Address</legend>
                <hr>
                <!-- Second Row: Address Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="street">Street Address</label>
                            <input type="text" class="form-control @error('street') is-invalid @enderror" name="street" id="street" value="{{ old('street') }}" required>
                            @error('street')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brgy_address">Brgy Address</label>
                            <select class="form-control @error('brgy_address') is-invalid @enderror" name="brgy_address" id="brgy_address" required>
                                <option value="">Select Barangay</option>
                                <option value="Sitio Balite, Brgy Marilog, Davao City" {{ old('brgy_address') == 'Sitio Balite, Brgy Marilog, Davao City' ? 'selected' : '' }}>Sitio Balite, Brgy Marilog, Davao City</option>
                                <option value="Brgy Cogon, Babak District, IGACOS" {{ old('brgy_address') == 'Brgy Cogon, Babak District, IGACOS' ? 'selected' : '' }}>Brgy Cogon, Babak District, IGACOS</option>
                                <option value="other" {{ old('brgy_address') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('brgy_address')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <input type="text" class="form-control mt-2" name="brgy_address_other" id="brgy_address_other" placeholder="If Other, specify" style="display:none;">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_landmark">Address Landmark</label>
                            <input type="text" class="form-control @error('address_landmark') is-invalid @enderror" name="address_landmark" id="address_landmark" value="{{ old('address_landmark') }}">
                            @error('address_landmark')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" class="form-control @error('occupation') is-invalid @enderror" name="occupation" id="occupation" value="{{ old('occupation') }}">
                            @error('occupation')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <legend>Other Information</legend>
                <hr>
                <!-- Fifth Row: Additional Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="highest_educational_attainment">Highest Educational Attainment</label>
                            <select class="form-control @error('highest_educational_attainment') is-invalid @enderror" name="highest_educational_attainment" id="highest_educational_attainment" required>
                                <option value="">Select</option>
                                <option value="No formal education" {{ old('highest_educational_attainment') == 'No formal education' ? 'selected' : '' }}>No formal education</option>
                                <option value="Elementary level" {{ old('highest_educational_attainment') == 'Elementary level' ? 'selected' : '' }}>Elementary level</option>
                                <option value="Elementary graduate" {{ old('highest_educational_attainment') == 'Elementary graduate' ? 'selected' : '' }}>Elementary graduate</option>
                                <option value="Junior HS level" {{ old('highest_educational_attainment') == 'Junior HS level' ? 'selected' : '' }}>Junior HS level</option>
                                <option value="Junior HS graduate" {{ old('highest_educational_attainment') == 'Junior HS graduate' ? 'selected' : '' }}>Junior HS graduate</option>
                                <option value="Senior HS level" {{ old('highest_educational_attainment') == 'Senior HS level' ? 'selected' : '' }}>Senior HS level</option>
                                <option value="Senior HS graduate" {{ old('highest_educational_attainment') == 'Senior HS graduate' ? 'selected' : '' }}>Senior HS graduate</option>
                                <option value="Vocational course" {{ old('highest_educational_attainment') == 'Vocational course' ? 'selected' : '' }}>Vocational course</option>
                                <option value="College level" {{ old('highest_educational_attainment') == 'College level' ? 'selected' : '' }}>College level</option>
                                <option value="College graduate" {{ old('highest_educational_attainment') == 'College graduate' ? 'selected' : '' }}>College graduate</option>
                                <option value="Doctoral level" {{ old('highest_educational_attainment') == 'Doctoral level' ? 'selected' : '' }}>Doctoral level</option>
                                <option value="Postdoctoral level" {{ old('highest_educational_attainment') == 'Postdoctoral level' ? 'selected' : '' }}>Postdoctoral level</option>
                                <option value="Postdoctoral graduate" {{ old('highest_educational_attainment') == 'Postdoctoral graduate' ? 'selected' : '' }}>Postdoctoral graduate</option>
                            </select>
                            @error('highest_educational_attainment')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marital_status">Marital Status</label>
                            <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" id="marital_status" required>
                                <option value="">Select</option>
                                <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Live-in" {{ old('marital_status') == 'Live-in' ? 'selected' : '' }}>Live-in</option>
                                <option value="Separated" {{ old('marital_status') == 'Separated' ? 'selected' : '' }}>Separated</option>
                                <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            </select>
                            @error('marital_status')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="monthly_household_income">Monthly Household Income (Php)</label>
                            <select class="form-control @error('monthly_household_income') is-invalid @enderror" name="monthly_household_income" id="monthly_household_income" required>
                                <option value="">Select</option>
                                <option value="<10,000" {{ old('monthly_household_income') == '<10,000' ? 'selected' : '' }}>&lt;10,000</option>
                                <option value="10,000-20,000" {{ old('monthly_household_income') == '10,000-20,000' ? 'selected' : '' }}>10,000-20,000</option>
                                <option value="20,000-40,000" {{ old('monthly_household_income') == '20,000-40,000' ? 'selected' : '' }}>20,000-40,000</option>
                                <option value="40,000-70,000" {{ old('monthly_household_income') == '40,000-70,000' ? 'selected' : '' }}>40,000-70,000</option>
                                <option value="70,000-100,000" {{ old('monthly_household_income') == '70,000-100,000' ? 'selected' : '' }}>70,000-100,000</option>
                                <option value=">100,000" {{ old('monthly_household_income') == '>100,000' ? 'selected' : '' }}>>&nbsp;100,000</option>
                            </select>
                            @error('monthly_household_income')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="religion">Religion</label>
                            <select class="form-control @error('religion') is-invalid @enderror" name="religion" id="religion" required>
                                <option value="">Select</option>
                                <option value="Christian" {{ old('religion') == 'Christian' ? 'selected' : '' }}>Christian</option>
                                <option value="Muslim" {{ old('religion') == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                                <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>Other</option>
                                <option value="None" {{ old('religion') == 'None' ? 'selected' : '' }}>None</option>
                            </select>
                            @error('religion')
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Auto-calculate age from birthdate
        document.getElementById('birth_date').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            document.getElementById('age').value = isNaN(age) ? '' : age;
        });
        // Show/hide other barangay field
        document.getElementById('brgy_address').addEventListener('change', function() {
            document.getElementById('brgy_address_other').style.display = this.value === 'other' ? 'block' : 'none';
        });

        $(document).ready(function() {
            // Fetch the next reference number when the page loads
            $.get('/patient/latest-reference-number', function(response) {
                // Set the numeric part of the reference number
                $('#reference_number').val(response.next_reference_number);

                // Optionally, set the suffix to a default value (e.g., "ABC")
                $('#reference_number_suffix').val('ABC');
            });
        });

    </script>
</x-app-layout>
