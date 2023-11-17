<?php

namespace KUHdo\Survey\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use KUHdo\Survey\Models\Question;

class QuestionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any questions.
     *
     * @return mixed
     */
    public function viewAny($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can view the question.
     *
     * @return mixed
     */
    public function view($user, Question $question)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can create questions.
     *
     * @return mixed
     */
    public function create($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can update the question.
     *
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
     * @return mixed
     */
    public function delete($user, Question $question)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can restore the question.
     *
     * @return mixed
     */
    public function restore($user, Question $question)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can permanently delete the question.
     *
     * @return mixed
     */
    public function forceDelete($user, Question $question)
    {
        return $user->exists();
    }
}
