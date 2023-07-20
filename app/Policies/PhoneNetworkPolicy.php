<?php

namespace App\Policies;

use App\Models\PhoneNetwork;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PhoneNetworkPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PhoneNetwork $phoneNetwork): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PhoneNetwork $phoneNetwork): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PhoneNetwork $phoneNetwork): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PhoneNetwork $phoneNetwork): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PhoneNetwork $phoneNetwork): bool
    {
        //
    }
}
