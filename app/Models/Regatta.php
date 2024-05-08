<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regatta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'venue_id',
        'name',
        'date',
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class)->orderBy('time');
    }

    public function getShortDateAttribute(): string
    {
        return $this->date->format('D, F j, Y');
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
