<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendingRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingRegistrationController extends Controller
{
    /**
     * Display a listing of pending registrations.
     */
    public function index()
    {
        $pendingRegistrations = PendingRegistration::pending()
            ->orderBy('submitted_at', 'desc')
            ->paginate(15);

        $recentlyReviewed = PendingRegistration::whereIn('status', ['approved', 'rejected'])
            ->with('approvedBy')
            ->orderBy('reviewed_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.pending-registrations.index', compact('pendingRegistrations', 'recentlyReviewed'));
    }

    /**
     * Show the specified pending registration.
     */
    public function show(PendingRegistration $pendingRegistration)
    {
        $pendingRegistration->load('approvedBy');
        
        return view('admin.pending-registrations.show', compact('pendingRegistration'));
    }

    /**
     * Approve a pending registration.
     */
    public function approve(Request $request, PendingRegistration $pendingRegistration)
    {
        if (!$pendingRegistration->isPending()) {
            return redirect()->back()->with('error', 'This registration has already been reviewed.');
        }

        // Check if email is still unique (in case someone else registered with same email)
        if (User::where('email', $pendingRegistration->email)->exists()) {
            return redirect()->back()->with('error', 'A user with this email already exists.');
        }

        // Create the user account
        $user = User::create([
            'name' => $pendingRegistration->name,
            'first_name' => $pendingRegistration->first_name,
            'last_name' => $pendingRegistration->last_name,
            'suffix' => $pendingRegistration->suffix,
            'phone_number' => $pendingRegistration->phone_number,
            'email' => $pendingRegistration->email,
            'password' => $pendingRegistration->password, // Already hashed
            'role' => $pendingRegistration->role,
            'email_verified_at' => now(), // Auto-verify approved accounts
        ]);

        // Update pending registration status
        $pendingRegistration->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()->with('success', 
            "Registration approved! User account created for {$pendingRegistration->full_name}."
        );
    }

    /**
     * Reject a pending registration.
     */
    public function reject(Request $request, PendingRegistration $pendingRegistration)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        if (!$pendingRegistration->isPending()) {
            return redirect()->back()->with('error', 'This registration has already been reviewed.');
        }

        $pendingRegistration->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()->with('success', 
            "Registration rejected for {$pendingRegistration->full_name}."
        );
    }

    /**
     * Delete a pending registration (for cleanup).
     */
    public function destroy(PendingRegistration $pendingRegistration)
    {
        $name = $pendingRegistration->full_name;
        $pendingRegistration->delete();

        return redirect()->back()->with('success', 
            "Registration record deleted for {$name}."
        );
    }

    /**
     * Get pending registrations count for dashboard/notifications.
     */
    public function getPendingCount()
    {
        return response()->json([
            'count' => PendingRegistration::pending()->count()
        ]);
    }
}