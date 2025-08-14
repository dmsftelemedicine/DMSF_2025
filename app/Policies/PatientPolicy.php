<?php

namespace App\Policies;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // All authenticated users can view patients list
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Patient $patient)
    {
        // All authenticated users can view individual patients
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        // All authenticated users can create patients
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Patient $patient)
    {
        // Check if user has admin or clinician role
        return $this->isAdminOrClinician($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Patient $patient)
    {
        // Only admins can delete patients
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Patient $patient)
    {
        // Only admins can restore patients
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Patient $patient)
    {
        // Only admins can permanently delete patients
        return $this->isAdmin($user);
    }

    /**
     * Check if user is admin
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    private function isAdmin(User $user)
    {
        // For now, check if email contains 'admin' - replace with proper role system
        return str_contains($user->email, 'admin');
    }

    /**
     * Check if user is admin or clinician
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    private function isAdminOrClinician(User $user)
    {
        // For now, check email patterns - replace with proper role system
        return str_contains($user->email, 'admin') || 
               str_contains($user->name, 'Dr.') ||
               str_contains($user->suffix, 'MD') ||
               str_contains($user->suffix, 'RN') ||
               str_contains($user->suffix, 'NP');
    }
}