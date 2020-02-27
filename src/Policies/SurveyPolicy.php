<?php

namespace Kuhdo\Survey\Policies;

use Kuhdo\Survey\Survey;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any surveys.
     *
     * @param  $user
     * @return mixed
     */
    public function viewAny($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can view the survey.
     *
     * @param  $user
     * @param  Survey  $survey
     * @return mixed
     */
    public function view($user, Survey $survey)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can create surveys.
     *
     * @param  $user
     * @return mixed
     */
    public function create($user)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can update the survey.
     *
     * @param  $user
     * @param  Survey  $survey
     * @return mixed
     */
    public function update($user, Survey $survey)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can delete the survey.
     *
     * @param  $user
     * @param  Survey  $survey
     * @return mixed
     */
    public function delete($user, Survey $survey)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can restore the survey.
     *
     * @param  $user
     * @param  Survey  $survey
     * @return mixed
     */
    public function restore($user, Survey $survey)
    {
        return $user->exists();
    }

    /**
     * Determine whether the user can permanently delete the survey.
     *
     * @param  $user
     * @param  Survey  $survey
     * @return mixed
     */
    public function forceDelete($user, Survey $survey)
    {
        return $user->exists();
    }
}
