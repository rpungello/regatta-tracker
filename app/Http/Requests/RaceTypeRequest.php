<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaceTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
        ];
    }
}
