<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'color' => ['required'],
        ];
    }
}
