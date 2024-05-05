<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'state' => ['required'],
        ];
    }
}
