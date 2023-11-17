<?php

namespace KUHdo\Survey\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use KUHdo\Survey\Models\Survey;

class SurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any surveys.
     *
     * @return mixed
     */
    public function viewAny($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can view the survey.
     *
     * @return mixed
     */
    public function view($user, Survey $survey)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can create surveys.
     *
     * @return mixed
     */
    public function create($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can update the survey.
     *
     * @return mixed
     */
    public function update($user, Survey $survey)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can delete the survey.
     *
     * @return mixed
     */
    public function delete($user, Survey $survey)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can restore the survey.
     *
     * @return mixed
     */
    public function restore($user, Survey $survey)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can permanently delete the survey.
     *
     * @return mixed
     */
    public function forceDelete($user, Survey $survey)
    {
        return $user->exists();
    }
}
