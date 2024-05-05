<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoatClassRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:boat_classes,name'],
            'code' => ['required', 'unique:boat_classes,code'],
        ];
    }
}
