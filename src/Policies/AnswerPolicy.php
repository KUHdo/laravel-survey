<?php

namespace Kuhdo\Survey\Policies;

use Kuhdo\Survey\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any answers.
     *
     * @param  $user
     * @return mixed
     */
    public function viewAny($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can view the answer.
     *
     * @param  $user
     * @param  Answer  $answer
     * @return mixed
     */
    public function view($user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can create answers.
     *
     * @param  $user
     * @return mixed
     */
    public function create($user)
    {
        //
    }

    /**
     * Determine whether the user can update the answer.
     *
     * @param  $user
     * @param  Answer  $answer
     * @return mixed
     */
    public function update($user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can delete the answer.
     *
     * @param  $user
     * @param  Answer  $answer
     * @return mixed
     */
    public function delete($user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can restore the answer.
     *
     * @param  $user
     * @param  Answer  $answer
     * @return mixed
     */
    public function restore($user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the answer.
     *
     * @param  $user
     * @param  Answer  $answer
     * @return mixed
     */
    public function forceDelete($user, Answer $answer)
    {
        //
    }
}
