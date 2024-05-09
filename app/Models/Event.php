<?php

namespace App\Models;

use App\Enums\Priority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'regatta_id',
        'gender_id',
        'event_class_id',
        'boat_class_id',
        'time',
        'name',
        'code',
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    public function regatta(): BelongsTo
    {
        return $this->belongsTo(Regatta::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function eventClass(): BelongsTo
    {
        return $this->belongsTo(EventClass::class);
    }

    public function boatClass(): BelongsTo
    {
        return $this->belongsTo(BoatClass::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public function getDescription(): string
    {
        return implode(' ', $this->getDescriptionComponents());
    }

    public function getPriority(): Priority
    {
        $priority = Priority::Low;
        foreach ($this->entries as $entry) {
            if ($entry->priority === Priority::High) {
                return Priority::High;
            } elseif ($entry->priority === Priority::Normal) {
                $priority = Priority::Normal;
            }
        }

        return $priority;
    }

    public function getDescriptionComponents(): array
    {
        return [
            $this->gender->getPluralName(),
            $this->eventClass->name,
            $this->boatClass->code,
        ];
    }

    public function isLastEvent(): bool
    {
        return $this->regatta->events()->where('time', '>', $this->time)->doesntExist();
    }

    public function getTimeUntilNextEvent(): ?string
    {
        /** @var Event|null $nextEvent */
        $nextEvent = $this->regatta->events()->where('time', '>', $this->time)->orderBy('time')->first();

        if (is_null($nextEvent)) {
            return null;
        }

        return $this->time->diffForHumans($nextEvent->time, true, parts: 2);
    }
}
