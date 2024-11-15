<?php

namespace App\Policies\Cjip;

use App\Models\User;
use App\Models\Cjip\ProyekInvestasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProyekInvestasiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_proyek::investasi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProyekInvestasi $proyekInvestasi): bool
    {
        return $user->can('view_proyek::investasi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_proyek::investasi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProyekInvestasi $proyekInvestasi): bool
    {
        return $user->can('update_proyek::investasi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProyekInvestasi $proyekInvestasi): bool
    {
        return $user->can('delete_proyek::investasi');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_proyek::investasi');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, ProyekInvestasi $proyekInvestasi): bool
    {
        return $user->can('force_delete_proyek::investasi');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_proyek::investasi');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, ProyekInvestasi $proyekInvestasi): bool
    {
        return $user->can('restore_proyek::investasi');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_proyek::investasi');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, ProyekInvestasi $proyekInvestasi): bool
    {
        return $user->can('replicate_proyek::investasi');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_proyek::investasi');
    }
}
