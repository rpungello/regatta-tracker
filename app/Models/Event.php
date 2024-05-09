<?php

namespace App\Models;

use App\Enums\Priority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'regatta_id',
        'race_type_id',
        'gender_id',
        'event_class_id',
        'boat_class_id',
        'time',
        'name',
        'code',
        'distance',
    ];

    protected $casts = [
        'time' => 'datetime',
        'distance' => 'int',
    ];

    public function regatta(): BelongsTo
    {
        return $this->belongsTo(Regatta::class);
    }

    public function raceType(): BelongsTo
    {
        return $this->belongsTo(RaceType::class);
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

    public function getDescriptionComponents(): array
    {
        return [
            $this->gender->getPluralName(),
            $this->eventClass->name,
            $this->boatClass->code,
        ];
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

    public function isLastEvent(): bool
    {
        return $this->regatta->events()->where('time', '>', $this->time)->doesntExist();
    }

    public function getTimeUntilNextEvent(): ?string
    {
        /** @var Event|null $nextEvent */
        $nextEvent = $this->getNextEvent();

        if (is_null($nextEvent)) {
            return null;
        }

        return $this->time->diffForHumans($nextEvent->time, true, parts: 2);
    }

    private function getNextEvent(): ?Event
    {
        if ($this->hasParallelEvents()) {
            try {
                return $this
                    ->regatta
                    ->events()
                    ->where('time', '=', $this->time)
                    ->where('id', '>', $this->getKey())
                    ->orderBy('time')
                    ->firstOrFail();
            } catch (ModelNotFoundException) {
            }
        }

        return $this
            ->regatta
            ->events()
            ->where('time', '>', $this->time)
            ->orderBy('time')
            ->firstOrFail();
    }

    public function hasParallelEvents(): bool
    {
        return $this->regatta->events()->where('time', '=', $this->time)->count() > 1;
    }

    public function getMinutesUntilNextEvent(): ?int
    {
        /** @var Event|null $nextEvent */
        $nextEvent = $this->getNextEvent();

        if (is_null($nextEvent)) {
            return null;
        }

        return $this->time->diffInMinutes($nextEvent->time);
    }
}
