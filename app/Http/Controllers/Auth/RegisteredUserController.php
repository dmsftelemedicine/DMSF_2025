<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PendingRegistration;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     * Creates a pending registration that requires admin approval.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Determine phone validation based on user's likely location
        $isFromPhilippines = $this->isUserFromPhilippines($request);
        
        $phoneRegex = $isFromPhilippines 
            ? '/^(\+63|0)9\d{9}$/' 
            : '/^(\+?[1-9]\d{1,14}|0\d{9,14})$/';
            
        $phoneErrorMessage = $isFromPhilippines
            ? 'Please enter a valid Philippine mobile number (e.g., +639123456789 or 09123456789).'
            : 'Please enter a valid phone number (e.g., +12345678900 or 09123456789).';

        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s\.-]+$/'],
            'phone_number' => ['required', 'string', 'regex:' . $phoneRegex],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:'.User::class,
                'unique:'.PendingRegistration::class.',email'
            ],
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'first_name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s\.-]+$/'],
            'last_name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s\.-]+$/'],
            'suffix' => ['nullable', 'string', 'max:10', 'regex:/^[a-zA-Z\s\.-]+$/'],
            'role' => ['required', Rule::in(User::ROLES)],
        ], [
            'name.regex' => 'The nickname may only contain letters, spaces, dots, and hyphens.',
            'first_name.regex' => 'The first name may only contain letters, spaces, dots, and hyphens.',
            'last_name.regex' => 'The last name may only contain letters, spaces, dots, and hyphens.',
            'suffix.regex' => 'The suffix may only contain letters, spaces, dots, and hyphens.',
            'phone_number.regex' => $phoneErrorMessage,
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one number.',
            'email.unique' => 'This email is already registered or has a pending registration.',
        ]);

        // Create pending registration
        PendingRegistration::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        return redirect()->route('login')->with('status', 
            'Registration submitted successfully! Your account is pending admin approval. You will be notified once your account is reviewed.'
        );
    }

    /**
     * Determine if user is likely from Philippines based on request data
     */
    private function isUserFromPhilippines(Request $request): bool
    {
        // Check Accept-Language header for Filipino/Tagalog indicators
        $acceptLanguage = $request->header('Accept-Language', '');
        if (str_contains(strtolower($acceptLanguage), 'fil') || 
            str_contains(strtolower($acceptLanguage), 'tl') ||
            str_contains(strtolower($acceptLanguage), 'ph')) {
            return true;
        }

        // Check if IP is from Philippines (basic country detection)
        $userIP = $request->ip();
        
        // You can integrate with a proper GeoIP service here
        // For now, we'll use a simple approach or default to true since this is a PH system
        
        // If it's a local IP or we can't determine, default to Philippines
        if ($this->isLocalIP($userIP)) {
            return true;
        }

        // Default to Philippines since this is primarily a Philippine healthcare system
        return true;
    }

    /**
     * Check if IP is a local/private IP address
     */
    private function isLocalIP(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false;
    }
}
