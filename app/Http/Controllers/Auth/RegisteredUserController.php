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
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[a-zA-Z\s\.-]+$/'],
            'phone_number' => ['required', 'string', 'regex:/^(\+63|0)9\d{9}$/'],
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
            'phone_number.regex' => 'Please enter a valid Philippine mobile number (e.g., +639123456789 or 09123456789).',
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
}
