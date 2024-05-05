<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AthleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'team_id' => ['required', 'exists:teams'],
            'gender_id' => ['required', 'exists:genders'],
            'name_first' => ['required'],
            'name_last' => ['required'],
        ];
    }
}
