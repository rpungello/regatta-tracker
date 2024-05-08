<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Gender extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'color',
        'pluralize',
    ];

    protected $casts = [
        'pluralize' => 'boolean',
    ];

    public function getPluralName(): string
    {
        return $this->pluralize ? Str::plural($this->name) : $this->name;
    }
}
