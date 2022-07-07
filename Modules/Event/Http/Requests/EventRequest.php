<?php

namespace Modules\Event\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'event_time' => ['required', 'date_format:d/m/Y H:i'],
            'email_to_notification' => ['required', 'email']
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo name é obrigatório',
            'description.required' => 'O campo description é obrigatório',
            'event_time' => 'O campo event_time é obrigatório',
            'email_to_notification' => 'O campo email_to_notification é obrigatório'
        ];
    }
}
