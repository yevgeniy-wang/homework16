<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AdPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     *
     * @return mixed
     */
    public function view(User $user, Ad $ad)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     *
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     *
     * @return mixed
     */
    public function update(User $user, Ad $ad)
    {
        return $user->id === $ad->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     *
     * @return mixed
     */
    public function delete(User $user, Ad $ad)
    {
        return $user->id === $ad->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     *
     * @return mixed
     */
    public function restore(User $user, Ad $ad)
    {
        return $user->id === $ad->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     *
     * @return mixed
     */
    public function forceDelete(User $user, Ad $ad)
    {
        return $user->id === $ad->user_id;
    }
}
