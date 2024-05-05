<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegattaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'venue_id' => ['required', 'exists:venues'],
            'name' => ['required', 'unique:regattas,name'],
            'date' => ['required', 'date'],
        ];
    }
}
