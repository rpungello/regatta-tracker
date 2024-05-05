<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:team_types'],
        ];
    }
}
