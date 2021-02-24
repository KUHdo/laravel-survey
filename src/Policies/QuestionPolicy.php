<?php

namespace KUHdo\Survey\Policies;

use App\User;
use KUHdo\Survey\Models\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any questions.
     *
     * @param  $user
     * @return mixed
     */
    public function viewAny($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can view the question.
     *
     * @param  $user
     * @param  Question  $question
     * @return mixed
     */
    public function view($user, Question $question)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can create questions.
     *
     * @param   $user
     * @return mixed
     */
    public function create($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can update the question.
     *
     * @param    $user
     * @param  uestion  $question
     * @return mixed
     */
    public function update($user, Question $question)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can delete the question.
     *
     * @param   $user
     * @param  Question  $question
     * @return mixed
     */
    public function delete($user, Question $question)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can restore the question.
     *
     * @param  $user
     * @param  Question  $question
     * @return mixed
     */
    public function restore($user, Question $question)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can permanently delete the question.
     *
     * @param  $user
     * @param  Question  $question
     * @return mixed
     */
    public function forceDelete($user, Question $question)
    {
        return $user->exists();
    }
}
