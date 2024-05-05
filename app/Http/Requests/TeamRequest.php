<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'team_type_id' => ['required', 'exists:team_types'],
            'brand_color_primary' => ['nullable'],
            'brand_color_secondary' => ['nullable'],
        ];
    }
}
