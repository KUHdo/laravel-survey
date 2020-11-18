<?php


namespace Kuhdo\Survey\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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

    protected function registerRules()
    {
        return [
            'question' => 'required|string',
            'category' => 'required|string',
            'survey_id' => 'sometimes|required|integer',
        ];
    }

    /**
     * custom error messages for request validation
     * @return array
     */
    public function messages()
    {
        return [
            'question' => __('Question'),
            'category' => __('Category'),
        ];
    }
}
