<?php

namespace App\Policies;

use App\PrivateRoom;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrivateRoomPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\PrivateRoom  $privateRoom
     * @return mixed
     */
    public function view(User $user, PrivateRoom $privateRoom)
    {
        //
        return $user->is($privateRoom->owner) || $privateRoom->participants->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\PrivateRoom  $privateRoom
     * @return mixed
     */
    public function update(User $user, PrivateRoom $privateRoom)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\PrivateRoom  $privateRoom
     * @return mixed
     */
    public function delete(User $user, PrivateRoom $privateRoom)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\PrivateRoom  $privateRoom
     * @return mixed
     */
    public function restore(User $user, PrivateRoom $privateRoom)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\PrivateRoom  $privateRoom
     * @return mixed
     */
    public function forceDelete(User $user, PrivateRoom $privateRoom)
    {
        //
    }
}
