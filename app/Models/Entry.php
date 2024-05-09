<?php

namespace App\Models;

use App\Enums\Priority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'bow_number' => 'integer',
        'priority' => Priority::class,
        'complete' => 'boolean',
    ];

    protected $fillable = [
        'event_id',
        'team_id',
        'bow_number',
        'priority',
        'notes',
        'complete',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function athletes(): BelongsToMany
    {
        return $this->belongsToMany(Athlete::class);
    }
}
