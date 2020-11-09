<?php


namespace Kuhdo\Survey\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
            'value' => 'required|string',
            'type' => 'required|string',
            'question_id' => 'sometimes|required|integer',
        ];
    }

    /**
     * custom error messages for request validation
     * @return array
     */
    public function messages()
    {
        return [
            'value' => __('Value'),
            'type' => __('Type'),
            'question_id.required' => __('Related question is not given'),
        ];
    }
}
