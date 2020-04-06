<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function collection(User $user)
    {
        return $user->tasks()->orderBy('id','desc')->get();
    }
}
