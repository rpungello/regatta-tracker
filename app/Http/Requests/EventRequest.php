<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'regatta_id' => ['required', 'exists:regattas'],
            'gender_id' => ['required', 'exists:genders'],
            'event_class_id' => ['required', 'exists:event_classes'],
            'boat_class_id' => ['required', 'exists:boat_classes'],
            'name' => ['required', 'unique:events,name'],
            'code' => ['nullable', 'unique:events,code'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
