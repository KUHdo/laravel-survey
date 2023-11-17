<?php

namespace KUHdo\Survey\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use KUHdo\Survey\Models\Answer;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any answers.
     *
     * @return mixed
     */
    public function viewAny($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can view the answer.
     *
     * @return mixed
     */
    public function view($user, Answer $answer)
    {
        return $answer->model()->first()->is($user);
    }

    /**
     * Determine whether the user can create answers.
     *
     * @return mixed
     */
    public function create($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can update the answer.
     *
     * @return mixed
     */
    public function update($user, Answer $answer)
    {
        return $answer->model()->first()->is($user);
    }

    /**
     * Determine whether the user can delete the answer.
     *
     * @return mixed
     */
    public function delete($user, Answer $answer)
    {
        return $answer->model()->first()->is($user);
    }

    /**
     * Determine whether the user can restore the answer.
     *
     * @return mixed
     */
    public function restore($user, Answer $answer)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the answer.
     *
     * @return mixed
     */
    public function forceDelete($user, Answer $answer)
    {
        return false;
    }
}
