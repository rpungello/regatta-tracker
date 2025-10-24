<?php

namespace App\Models;

use App\Enums\Priority;
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
        'default_race_type_id',
        'default_event_class_id',
        'default_distance',
    ];

    protected $casts = [
        'default_distance' => 'int',
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function defaultRaceType(): BelongsTo
    {
        return $this->belongsTo(RaceType::class);
    }

    public function defaultEventClass(): BelongsTo
    {
        return $this->belongsTo(EventClass::class);
    }

    public function events(bool $excludeLowPriority = false): HasMany
    {
        if ($excludeLowPriority) {
            return $this->hasMany(Event::class)
                ->whereHas('entries', function ($query) {
                    $query->where('priority', '!=', Priority::Low);
                })
                ->orderBy('time');
        } else {
            return $this->hasMany(Event::class)->orderBy('time');
        }
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
