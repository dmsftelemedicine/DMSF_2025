<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" autocomplete="given-name" />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>
            <div>
                <x-input-label for="middle_name" :value="__('Middle Name')" />
                <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" :value="old('middle_name', $user->middle_name)" autocomplete="additional-name" />
                <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
            </div>
            <div>
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" autocomplete="family-name" />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>
            <div>
                <x-input-label for="suffix" :value="__('Suffix')" />
                <x-text-input id="suffix" name="suffix" type="text" class="mt-1 block w-full" :value="old('suffix', $user->suffix)" />
                <x-input-error class="mt-2" :messages="$errors->get('suffix')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if(in_array(auth()->user()->role, ['doctor','admin']))
        <div>
            <x-input-label for="signature" :value="__('Digital Signature (PNG/JPG, max 2MB)')" />
            <input id="signature" name="signature" type="file" accept="image/png,image/jpeg" class="mt-1 block w-full border rounded p-2" />
            <x-input-error class="mt-2" :messages="$errors->get('signature')" />
            @if($user->signature_path)
                <div class="mt-2">
                    <span class="text-sm text-gray-600">Current signature:</span>
                    <img src="{{ asset('storage/' . $user->signature_path) }}" alt="Signature" class="mt-1" style="max-width: 250px; height: auto;" />
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="license_number" :value="__('License Number')" />
            <x-text-input id="license_number" name="license_number" type="text" class="mt-1 block w-full" :value="old('license_number', $user->license_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('license_number')" />
            <p class="text-xs text-gray-500 mt-1">Shown on prescriptions as: "License No.: {{ $user->license_number }}"</p>
        </div>

        <div>
            <x-input-label for="ptr_number" :value="__('PTR Number')" />
            <x-text-input id="ptr_number" name="ptr_number" type="text" class="mt-1 block w-full" :value="old('ptr_number', $user->ptr_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('ptr_number')" />
            <p class="text-xs text-gray-500 mt-1">Shown on medical certificates as: "PTR No.: {{ $user->ptr_number }}"</p>
        </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
