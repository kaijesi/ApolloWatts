<?php

namespace App\Policies;

use App\Models\Household;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Policy defining user authorisations for households.
 */
class HouseholdPolicy
{
    /**
     * Determine whether the user can view any households.
     */
    public function viewAny(User $user): bool
    {
        return true; // Users should generally be able to see households
    }

    /**
     * Determine whether the user can view a household.
     */
    public function view(User $user, Household $household): bool
    {
        return $user->household == $household; // Users can only see their household specifically
    }

    /**
     * Determine whether the user can create a household.
     */
    public function create(User $user): bool
    {
        return false; // Households are only created through initial user creation.
    }

    /**
     * Determine whether the user can update a household.
     */
    public function update(User $user, Household $household): bool
    {
        return $user->household == $household && $user->is_household_admin; // Admin only
    }

    /**
     * Determine whether the user can delete a household.
     */
    public function delete(User $user, Household $household): bool
    {
        return $user->household == $household && $user->is_household_admin; // Admin only
    }

    /**
     * Determine whether the user can restore a household.
     * 
     * @deprecated Not used
     */
    public function restore(User $user, Household $household): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete a household.
     * 
     * @deprecated Not used
     */
    public function forceDelete(User $user, Household $household): bool
    {
        return false;
    }
}
