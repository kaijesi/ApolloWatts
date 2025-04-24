<?php

namespace App\Policies;

use App\Models\Installation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Policy defining user authorisations for installations
 */
class InstallationPolicy
{
    /**
     * Determine whether the user can view any installations.
     */
    public function viewAny(User $user): bool
    {
        return true; // Users should generally be able to see installations
    }

    /**
     * Determine whether the user can view an installation.
     */
    public function view(User $user, Installation $installation): bool
    {
        return $user->household_id === $installation->household_id; // Users can only see installations for their own household
    }

    /**
     * Determine whether the user can create an installation.
     */
    public function create(User $user): bool
    {
        return $user->is_household_admin; // Admin only
    }

    /**
     * Determine whether the user can update an installation.
     */
    public function update(User $user, Installation $installation): bool
    {
        return $user->household_id === $installation->household_id && $user->is_household_admin; // Admin only
    }

    /**
     * Determine whether the user can delete an installation.
     */
    public function delete(User $user, Installation $installation): bool
    {
        return $user->household_id === $installation->household_id && $user->is_household_admin; // Admin only
    }

    /**
     * Determine whether the user can restore an installation.
     * 
     * @deprecated Not used
     */
    public function restore(User $user, Installation $installation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete an installation.
     * 
     * @deprecated Not used
     */
    public function forceDelete(User $user, Installation $installation): bool
    {
        return false;
    }
}
