<?php

namespace App\Policies\Cjibf;

use App\Models\User;
use App\Models\Cjibf\CjibfRegisterO3m;
use Illuminate\Auth\Access\HandlesAuthorization;

class CjibfRegisterO3mPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_o3::metting');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CjibfRegisterO3m $cjibfRegisterO3m): bool
    {
        return $user->can('view_o3::metting');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_o3::metting');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CjibfRegisterO3m $cjibfRegisterO3m): bool
    {
        return $user->can('update_o3::metting');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CjibfRegisterO3m $cjibfRegisterO3m): bool
    {
        return $user->can('delete_o3::metting');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_o3::metting');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, CjibfRegisterO3m $cjibfRegisterO3m): bool
    {
        return $user->can('force_delete_o3::metting');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_o3::metting');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, CjibfRegisterO3m $cjibfRegisterO3m): bool
    {
        return $user->can('restore_o3::metting');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_o3::metting');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, CjibfRegisterO3m $cjibfRegisterO3m): bool
    {
        return $user->can('replicate_o3::metting');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_o3::metting');
    }
}
