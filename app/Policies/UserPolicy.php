<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Policy defining user authorisations for users
 */
class UserPolicy
{
    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user): bool
    {
        return true; // Users should generally be able to see users
    }

    /**
     * Determine whether the user can view a user.
     */
    public function view(User $user, User $model): bool
    {
        return $user == $model || $user->household_id == $model->household_id; // Users can only see themselves and other users in their household
    }

    /**
     * Determine whether the user can create users.
     * 
     * @deprecated Not used
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update a user.
     */
    public function update(User $user, User $model): bool
    {
        return $user == $model || ($user->is_household_admin && $user->household_id == $model->household_id); // Any user can update themselves, admins can update other users in their household
    }

    /**
     * Determine whether the user can delete a user.
     */
    public function delete(User $user, User $model): bool
    {
        return $user == $model || ($user->is_household_admin && $user->household_id == $model->household_id); // Any user can delete themselves, admins can delete other users in their household
    }

    /**
     * Determine whether the user can restore a user.
     * 
     * @deprecated Not used
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete a user.
     * 
     * @deprecated Not used
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
