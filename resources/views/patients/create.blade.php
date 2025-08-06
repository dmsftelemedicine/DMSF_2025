<x-app-layout>
    <div class="container py-4">
        <!-- Form Container with Border and Shadow -->
        <div class="card shadow-lg p-4 border rounded-lg">
            <form action="{{ route('patients.store') }}" method="POST">
                @csrf
                <legend>Patient Identifying Record</legend>
                <hr>
                <!-- First Row: Personal Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name*</label>
                            <input type="text" class="form-control rounded-lg @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" required pattern="[A-Za-z\s\-\.']+" title="Only letters, spaces, hyphens, dots, and apostrophes are allowed">
                            @error('last_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="last_name_error" style="display: none;">
                                Please enter a valid last name (letters only).
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name*</label>
                            <input type="text" class="form-control rounded-lg @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" required pattern="[A-Za-z\s\-\.']+" title="Only letters, spaces, hyphens, dots, and apostrophes are allowed">
                            @error('first_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="first_name_error" style="display: none;">
                                Please enter a valid first name (letters only).
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control rounded-lg" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birth_date">Birthdate*</label>
                            <input type="date" class="form-control rounded-lg @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
                            @error('birth_date')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="birth_date_error" style="display: none;">
                                Please select a birthdate.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" class="form-control rounded-lg" id="age" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sex*</label><br>
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
                            <div class="invalid-feedback" id="gender_error" style="display: none;">
                                Please select your sex.
                            </div>
                        </div>
                    </div>
                </div>

                <legend>Address</legend>
                <hr>
                <!-- Second Row: Address Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="street">Street Address*</label>
                            <input type="text" class="form-control rounded-lg @error('street') is-invalid @enderror" name="street" id="street" value="{{ old('street') }}" required>
                            @error('street')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="street_error" style="display: none;">
                                Please enter a street address.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brgy_address">Brgy Address*</label>
                            <select class="form-control @error('brgy_address') is-invalid @enderror" name="brgy_address" id="brgy_address" required>
                                <option value="">Select Barangay</option>
                                <option value="Sitio Balite, Brgy Marilog, Davao City" {{ old('brgy_address') == 'Sitio Balite, Brgy Marilog, Davao City' ? 'selected' : '' }}>Sitio Balite, Brgy Marilog, Davao City</option>
                                <option value="Brgy Cogon, Babak District, IGACOS" {{ old('brgy_address') == 'Brgy Cogon, Babak District, IGACOS' ? 'selected' : '' }}>Brgy Cogon, Babak District, IGACOS</option>
                                <option value="other" {{ old('brgy_address') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('brgy_address')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="brgy_address_error" style="display: none;">
                                Please select a barangay.
                            </div>
                            <input type="text" class="form-control mt-2" name="brgy_address_other" id="brgy_address_other" placeholder="If Other, specify" style="display:none;">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_landmark">Address Landmark</label>
                            <input type="text" class="form-control rounded-lg @error('address_landmark') is-invalid @enderror" name="address_landmark" id="address_landmark" value="{{ old('address_landmark') }}">
                            @error('address_landmark')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" class="form-control rounded-lg @error('occupation') is-invalid @enderror" name="occupation" id="occupation" value="{{ old('occupation') }}">
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
                            <label for="highest_educational_attainment">Highest Educational Attainment*</label>
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
                            <div class="invalid-feedback" id="highest_educational_attainment_error" style="display: none;">
                                Please select your highest educational attainment.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marital_status">Marital Status*</label>
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
                            <div class="invalid-feedback" id="marital_status_error" style="display: none;">
                                Please select your marital status.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="monthly_household_income">Monthly Household Income (Php)*</label>
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
                            <div class="invalid-feedback" id="monthly_household_income_error" style="display: none;">
                                Please select your monthly household income.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="religion">Religion*</label>
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
                            <div class="invalid-feedback" id="religion_error" style="display: none;">
                                Please select your religion.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success mt-4 me-2">Save Patient</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary mt-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Show/hide other barangay field
        document.getElementById('brgy_address').addEventListener('change', function() {
            document.getElementById('brgy_address_other').style.display = this.value === 'other' ? 'block' : 'none';
        });

        // Auto-calculate age from birthdate
        function calculateAge() {
            const birthDateField = document.getElementById('birth_date');
            const ageField = document.getElementById('age');
            
            if (birthDateField.value) {
                const birthDate = new Date(birthDateField.value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                ageField.value = isNaN(age) ? '' : age;
            } else {
                ageField.value = '';
            }
        }

        // Real-time validation for name fields
        function validateNameField(fieldId) {
            const field = document.getElementById(fieldId);
            const value = field.value.trim();
            const namePattern = /^[A-Za-z\s\-\.']+$/;
            const errorDiv = document.getElementById(fieldId + '_error');
            
            // Remove existing validation classes
            field.classList.remove('is-invalid', 'is-valid');
            
            if (value === '') {
                // Empty field
                field.classList.add('is-invalid');
                errorDiv.textContent = 'This field is required.';
                errorDiv.style.display = 'block';
                return false;
            } else if (!namePattern.test(value)) {
                // Invalid characters
                field.classList.add('is-invalid');
                errorDiv.textContent = 'Only letters, spaces, hyphens, dots, and apostrophes are allowed.';
                errorDiv.style.display = 'block';
                return false;
            } else {
                // Valid
                field.classList.add('is-valid');
                errorDiv.style.display = 'none';
                return true;
            }
        }

        // Validation for birth date field (includes age calculation)
        function validateBirthDate() {
            const field = document.getElementById('birth_date');
            const value = field.value;
            const errorDiv = document.getElementById('birth_date_error');
            
            // Remove existing validation classes
            field.classList.remove('is-invalid', 'is-valid');
            
            if (value === '') {
                // Empty field
                field.classList.add('is-invalid');
                errorDiv.textContent = 'Please select a birthdate.';
                errorDiv.style.display = 'block';
                document.getElementById('age').value = '';
                return false;
            } else {
                // Check if date is valid and not in the future
                const selectedDate = new Date(value);
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Reset time to compare dates only
                
                if (selectedDate > today) {
                    field.classList.add('is-invalid');
                    errorDiv.textContent = 'Birthdate cannot be in the future.';
                    errorDiv.style.display = 'block';
                    document.getElementById('age').value = '';
                    return false;
                } else {
                    // Valid - calculate age
                    field.classList.add('is-valid');
                    errorDiv.style.display = 'none';
                    calculateAge();
                    return true;
                }
            }
        }

        // Validation for select fields
        function validateSelectField(fieldId) {
            const field = document.getElementById(fieldId);
            const value = field.value;
            const errorDiv = document.getElementById(fieldId + '_error');
            
            // Remove existing validation classes
            field.classList.remove('is-invalid', 'is-valid');
            
            if (value === '' || value === null) {
                // Empty field
                field.classList.add('is-invalid');
                errorDiv.style.display = 'block';
                return false;
            } else {
                // Valid
                field.classList.add('is-valid');
                errorDiv.style.display = 'none';
                return true;
            }
        }

        // Validation for text input fields
        function validateTextInputField(fieldId) {
            const field = document.getElementById(fieldId);
            const value = field.value.trim();
            const errorDiv = document.getElementById(fieldId + '_error');
            
            // Remove existing validation classes
            field.classList.remove('is-invalid', 'is-valid');
            
            if (value === '') {
                // Empty field
                field.classList.add('is-invalid');
                errorDiv.style.display = 'block';
                return false;
            } else {
                // Valid
                field.classList.add('is-valid');
                errorDiv.style.display = 'none';
                return true;
            }
        }

        // Validation for radio button groups
        function validateRadioField(fieldName) {
            const radios = document.querySelectorAll(`input[name="${fieldName}"]`);
            const errorDiv = document.getElementById(fieldName + '_error');
            let isChecked = false;
            
            // Check if any radio is selected
            radios.forEach(radio => {
                if (radio.checked) {
                    isChecked = true;
                }
            });
            
            // Remove existing validation classes from all radios
            radios.forEach(radio => {
                radio.classList.remove('is-invalid', 'is-valid');
            });
            
            if (!isChecked) {
                // No radio selected
                radios.forEach(radio => {
                    radio.classList.add('is-invalid');
                });
                errorDiv.style.display = 'block';
                return false;
            } else {
                // Only add is-valid to the checked radio
                radios.forEach(radio => {
                    if (radio.checked) {
                        radio.classList.add('is-valid');
                    } else {
                        radio.classList.remove('is-valid');
                    }
                });
                errorDiv.style.display = 'none';
                return true;
            }
        }

        // Update form error state
        function updateFormErrorState() {
            const form = document.querySelector('form');
            const card = form.closest('.card');
            const invalidFields = document.querySelectorAll('.is-invalid');
            const errorMessages = document.querySelectorAll('.text-danger, .invalid-feedback[style*="block"]');
            
            if (invalidFields.length > 0 || errorMessages.length > 0) {
                card.classList.add('has-errors');
            } else {
                card.classList.remove('has-errors');
            }
        }

        // Add event listeners for real-time validation
        document.addEventListener('DOMContentLoaded', function() {
            const nameFields = ['last_name', 'first_name'];
            const selectFields = ['brgy_address', 'highest_educational_attainment', 'marital_status', 'monthly_household_income', 'religion'];
            const textInputFields = ['street'];
            const radioFields = ['gender'];
            
            // Name fields validation
            nameFields.forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                
                if (field) {
                    // Validate on input (real-time)
                    field.addEventListener('input', function() {
                        validateNameField(fieldId);
                        updateFormErrorState();
                    });
                    
                    // Validate on blur (when user leaves the field)
                    field.addEventListener('blur', function() {
                        validateNameField(fieldId);
                        updateFormErrorState();
                    });
                    
                    // Prevent invalid characters from being typed
                    field.addEventListener('keypress', function(e) {
                        const char = String.fromCharCode(e.which);
                        const namePattern = /[A-Za-z\s\-\.']/;
                        
                        if (!namePattern.test(char) && e.which !== 8 && e.which !== 0) {
                            e.preventDefault();
                        }
                    });
                }
            });

            // Select fields validation
            selectFields.forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                
                if (field) {
                    field.addEventListener('change', function() {
                        validateSelectField(fieldId);
                        updateFormErrorState();
                    });
                    
                    field.addEventListener('blur', function() {
                        validateSelectField(fieldId);
                        updateFormErrorState();
                    });
                }
            });

            // Text input fields validation
            textInputFields.forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                
                if (field) {
                    field.addEventListener('input', function() {
                        validateTextInputField(fieldId);
                        updateFormErrorState();
                    });
                    
                    field.addEventListener('blur', function() {
                        validateTextInputField(fieldId);
                        updateFormErrorState();
                    });
                }
            });

            // Radio fields validation
            radioFields.forEach(function(fieldName) {
                const radios = document.querySelectorAll(`input[name="${fieldName}"]`);
                
                radios.forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        validateRadioField(fieldName);
                        updateFormErrorState();
                    });
                });
            });

            // Add validation for birth_date field
            const birthDateField = document.getElementById('birth_date');
            if (birthDateField) {
                birthDateField.addEventListener('change', function() {
                    validateBirthDate();
                    updateFormErrorState();
                });
                birthDateField.addEventListener('blur', function() {
                    validateBirthDate();
                    updateFormErrorState();
                });
            }
            
            // Form submission validation
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    let isValid = true;
                    
                    nameFields.forEach(function(fieldId) {
                        if (!validateNameField(fieldId)) {
                            isValid = false;
                        }
                    });

                    selectFields.forEach(function(fieldId) {
                        if (!validateSelectField(fieldId)) {
                            isValid = false;
                        }
                    });

                    textInputFields.forEach(function(fieldId) {
                        if (!validateTextInputField(fieldId)) {
                            isValid = false;
                        }
                    });

                    radioFields.forEach(function(fieldName) {
                        if (!validateRadioField(fieldName)) {
                            isValid = false;
                        }
                    });

                    // Validate birth date on submit
                    if (!validateBirthDate()) {
                        isValid = false;
                    }
                    
                    if (!isValid) {
                        e.preventDefault();
                        updateFormErrorState();
                        alert('Please fill in all required fields correctly.');
                    }
                });
            }
        });

    </script>

    <style>
        /* Enhanced validation styling */
        .is-invalid {
            border-color: #dc3545 !important;
            background-color: #fff5f5 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            border-width: 3px !important;
        }
        
        .is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.3rem rgba(220, 53, 69, 0.4) !important;
            background-color: #fff5f5 !important;
            border-width: 3px !important;
        }
        
        .is-valid {
            border-color: #28a745 !important;
            background-color: #f8fff9 !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
            border-width: 2px !important;
        }
        
        .form-control.is-invalid {
            border: 3px solid #dc3545 !important;
            animation: shake 0.5s ease-in-out;
        }

        /* Shake animation for invalid fields */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Form error styling - makes entire form have red theme when errors exist */
        .has-errors {
            border: 4px solid #dc3545 !important;
            background-color: #fdf2f2 !important;
            box-shadow: 0 0 20px rgba(220, 53, 69, 0.4) !important;
            animation: pulse-red 2s ease-in-out;
        }
        
        @keyframes pulse-red {
            0%, 100% { box-shadow: 0 0 20px rgba(220, 53, 69, 0.4); }
            50% { box-shadow: 0 0 30px rgba(220, 53, 69, 0.6); }
        }
        
        .has-errors legend {
            color: #dc3545 !important;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(220, 53, 69, 0.3);
        }
        
        .has-errors hr {
            border-color: #dc3545 !important;
            border-width: 3px !important;
        }
        
        .has-errors .card {
            border-color: #dc3545 !important;
        }

        /* Enhanced error message styling */
        .invalid-feedback {
            display: none !important;
            font-weight: bold;
            color: #dc3545 !important;
            background-color: #fff5f5;
            padding: 8px;
            border-radius: 4px;
            border-left: 4px solid #dc3545;
            margin-top: 5px;
        }

        /* Only show invalid-feedback when there's an error */
        .invalid-feedback[style*="display: block"] {
            display: block !important;
        }

        /* Radio button validation styling */
        .form-check-input.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }

        /* Use accent-color for green dot inside radio when valid */
        .form-check-input.is-valid[type="radio"] {
            accent-color: #28a745 !important;
            border-color: #28a745 !important;
            box-shadow: none !important;
        }
        .form-check-input.is-valid[type="radio"]:checked {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            accent-color: #28a745 !important;
        }

        /* Special styling for select fields */
        select.is-invalid {
            border-color: #dc3545 !important;
            background-color: #fff5f5 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            border-width: 3px !important;
        }

        select.is-valid {
            border-color: #28a745 !important;
            background-color: #f8fff9 !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
            border-width: 2px !important;
        }
    </style>
</x-app-layout>
