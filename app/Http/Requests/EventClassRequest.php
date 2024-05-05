<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventClassRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:event_classes,name'],
            'color' => ['required'],
        ];
    }
}
