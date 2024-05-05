<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id' => ['required', 'exists:events'],
            'team_id' => ['required', 'exists:teams'],
            'bow_number' => ['required', 'integer', 'between:1,9999'],
        ];
    }
}
