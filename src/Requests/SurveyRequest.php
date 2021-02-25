<?php


namespace KUHdo\Survey\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurveyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->registerRules();
    }

    /**
     * Validation rules of a survey.
     *
     * @return string[]
     */
    protected function registerRules(): array
    {
        return [
            'title' => 'required|string',
        ];
    }

    /**
     * custom error messages for request validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => __('Der Titel ist ein Pflichtfeld'),
        ];
    }
}
