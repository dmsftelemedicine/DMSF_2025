<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nickname')" /><span class="text-red-500 ml-1">*</span>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" /><span class="text-red-500 ml-1">*</span>
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first-name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="last_name" :value="__('Last name')" /><span class="text-red-500 ml-1">*</span>
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last-name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Suffix -->
        <div>
            <x-input-label for="suffix" :value="__('Suffix')" />
            <x-text-input id="suffix" class="block mt-1 w-full" type="text" name="suffix" :value="old('suffix')" autofocus autocomplete="suffix" />
            <x-input-error :messages="$errors->get('suffix')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" /><span class="text-red-500 ml-1">*</span>
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone-number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" /><span class="text-red-500 ml-1">*</span>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" /><span class="text-red-500 ml-1">*</span>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" /><span class="text-red-500 ml-1">*</span>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" /><span class="text-red-500 ml-1">*</span>
            <select id="role" name="role"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>— Select a role —</option>

                <option value="bhw_s1"   {{ old('role')==='bhw_s1' ? 'selected' : '' }}>BHW Station 1</option>
                <option value="bhw_s3"   {{ old('role')==='bhw_s3' ? 'selected' : '' }}>BHW Station 3</option>
                <option value="bhw_s4"   {{ old('role')==='bhw_s4' ? 'selected' : '' }}>BHW Station 4</option>
                <option value="bhw_s5"   {{ old('role')==='bhw_s5' ? 'selected' : '' }}>BHW Station 5</option>
                <option value="bhw_s6"   {{ old('role')==='bhw_s6' ? 'selected' : '' }}>BHW Station 6</option>
                <option value="doctor"   {{ old('role')==='doctor' ? 'selected' : '' }}>Doctor</option>
                <option value="admin"    {{ old('role')==='admin' ? 'selected' : '' }}>Admin</option>
                <option value="user"     {{ old('role')==='user' ? 'selected' : '' }}>Standard User</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input, select');

            // Real-time validation functions
            function validateName(input) {
                const value = input.value.trim();
                const minLength = 2;
                const maxLength = 50;
                const namePattern = /^[a-zA-Z\s\.-]+$/;
                
                if (!value) {
                    return 'This field is required.';
                } else if (value.length < minLength) {
                    return `Must be at least ${minLength} characters.`;
                } else if (value.length > maxLength) {
                    return `Must not exceed ${maxLength} characters.`;
                } else if (!namePattern.test(value)) {
                    return 'Only letters, spaces, dots, and hyphens are allowed.';
                }
                return '';
            }

            function validatePhone(input) {
                const value = input.value.trim();
                const phonePattern = /^(\+63|0)9\d{9}$/;
                
                if (!value) {
                    return 'Phone number is required.';
                } else if (!phonePattern.test(value)) {
                    return 'Please enter a valid Philippine mobile number (e.g., +639123456789 or 09123456789).';
                }
                return '';
            }

            function validateEmail(input) {
                const value = input.value.trim();
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                
                if (!value) {
                    return 'Email is required.';
                } else if (!emailPattern.test(value)) {
                    return 'Please enter a valid email address.';
                }
                return '';
            }

            function validatePassword(input) {
                const value = input.value;
                const minLength = 8;
                
                if (!value) {
                    return 'Password is required.';
                } else if (value.length < minLength) {
                    return `Password must be at least ${minLength} characters long.`;
                } else if (!/(?=.*[a-z])/.test(value)) {
                    return 'Password must contain at least one lowercase letter.';
                } else if (!/(?=.*[A-Z])/.test(value)) {
                    return 'Password must contain at least one uppercase letter.';
                } else if (!/(?=.*\d)/.test(value)) {
                    return 'Password must contain at least one number.';
                }
                return '';
            }

            function validatePasswordConfirmation(input) {
                const value = input.value;
                const password = document.getElementById('password').value;
                
                if (!value) {
                    return 'Please confirm your password.';
                } else if (value !== password) {
                    return 'Passwords do not match.';
                }
                return '';
            }

            function validateRole(input) {
                const value = input.value;
                
                if (!value) {
                    return 'Please select a role.';
                }
                return '';
            }

            function showError(input, message) {
                const errorElement = input.parentNode.querySelector('.validation-error') || document.createElement('div');
                errorElement.className = 'validation-error text-sm text-red-600 mt-1';
                errorElement.textContent = message;
                
                if (!input.parentNode.querySelector('.validation-error')) {
                    input.parentNode.appendChild(errorElement);
                }
                
                input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                input.classList.remove('border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
            }

            function showSuccess(input) {
                const errorElement = input.parentNode.querySelector('.validation-error');
                if (errorElement) {
                    errorElement.remove();
                }
                
                input.classList.add('border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
                input.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
            }

            function clearValidation(input) {
                const errorElement = input.parentNode.querySelector('.validation-error');
                if (errorElement) {
                    errorElement.remove();
                }
                
                input.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                input.classList.remove('border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
            }

            // Add real-time validation
            document.getElementById('name').addEventListener('blur', function() {
                const error = validateName(this);
                if (error) {
                    showError(this, error);
                } else {
                    showSuccess(this);
                }
            });

            document.getElementById('first_name').addEventListener('blur', function() {
                const error = validateName(this);
                if (error) {
                    showError(this, error);
                } else {
                    showSuccess(this);
                }
            });

            document.getElementById('last_name').addEventListener('blur', function() {
                const error = validateName(this);
                if (error) {
                    showError(this, error);
                } else {
                    showSuccess(this);
                }
            });

            document.getElementById('phone_number').addEventListener('blur', function() {
                const error = validatePhone(this);
                if (error) {
                    showError(this, error);
                } else {
                    showSuccess(this);
                }
            });

            document.getElementById('email').addEventListener('blur', function() {
                const error = validateEmail(this);
                if (error) {
                    showError(this, error);
                } else {
                    showSuccess(this);
                }
            });

            document.getElementById('password').addEventListener('input', function() {
                const error = validatePassword(this);
                if (error) {
                    showError(this, error);
                } else {
                    showSuccess(this);
                }
                
                // Also revalidate password confirmation if it has a value
                const confirmInput = document.getElementById('password_confirmation');
                if (confirmInput.value) {
                    const confirmError = validatePasswordConfirmation(confirmInput);
                    if (confirmError) {
                        showError(confirmInput, confirmError);
                    } else {
                        showSuccess(confirmInput);
                    }
                }
            });

            document.getElementById('password_confirmation').addEventListener('input', function() {
                const error = validatePasswordConfirmation(this);
                if (error) {
                    showError(this, error);
                } else {
                    showSuccess(this);
                }
            });

            document.getElementById('role').addEventListener('change', function() {
                const error = validateRole(this);
                if (error) {
                    showError(this, error);
                } else {
                    showSuccess(this);
                }
            });

            // Form submission validation
            form.addEventListener('submit', function(e) {
                let hasErrors = false;
                
                // Validate all fields
                const nameError = validateName(document.getElementById('name'));
                const firstNameError = validateName(document.getElementById('first_name'));
                const lastNameError = validateName(document.getElementById('last_name'));
                const phoneError = validatePhone(document.getElementById('phone_number'));
                const emailError = validateEmail(document.getElementById('email'));
                const passwordError = validatePassword(document.getElementById('password'));
                const passwordConfirmError = validatePasswordConfirmation(document.getElementById('password_confirmation'));
                const roleError = validateRole(document.getElementById('role'));

                // Show errors
                if (nameError) {
                    showError(document.getElementById('name'), nameError);
                    hasErrors = true;
                }
                if (firstNameError) {
                    showError(document.getElementById('first_name'), firstNameError);
                    hasErrors = true;
                }
                if (lastNameError) {
                    showError(document.getElementById('last_name'), lastNameError);
                    hasErrors = true;
                }
                if (phoneError) {
                    showError(document.getElementById('phone_number'), phoneError);
                    hasErrors = true;
                }
                if (emailError) {
                    showError(document.getElementById('email'), emailError);
                    hasErrors = true;
                }
                if (passwordError) {
                    showError(document.getElementById('password'), passwordError);
                    hasErrors = true;
                }
                if (passwordConfirmError) {
                    showError(document.getElementById('password_confirmation'), passwordConfirmError);
                    hasErrors = true;
                }
                if (roleError) {
                    showError(document.getElementById('role'), roleError);
                    hasErrors = true;
                }

                if (hasErrors) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = form.querySelector('.border-red-500');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }
                }
            });

            // Clear validation on input focus
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    if (!this.classList.contains('border-green-500')) {
                        clearValidation(this);
                    }
                });
            });
        });
    </script>
</x-guest-layout>
