<?php

namespace App\Policies\Cjip;

use App\Models\User;
use App\Models\Cjip\UpahMinimum;
use Illuminate\Auth\Access\HandlesAuthorization;

class UpahMinimumPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_upah::minimum');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UpahMinimum $upahMinimum): bool
    {
        return $user->can('view_upah::minimum');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_upah::minimum');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UpahMinimum $upahMinimum): bool
    {
        return $user->can('update_upah::minimum');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UpahMinimum $upahMinimum): bool
    {
        return $user->can('delete_upah::minimum');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_upah::minimum');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, UpahMinimum $upahMinimum): bool
    {
        return $user->can('force_delete_upah::minimum');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_upah::minimum');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, UpahMinimum $upahMinimum): bool
    {
        return $user->can('restore_upah::minimum');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_upah::minimum');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, UpahMinimum $upahMinimum): bool
    {
        return $user->can('replicate_upah::minimum');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_upah::minimum');
    }
}
